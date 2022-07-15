<?php
error_reporting(E_All);
// added in v4.0.0

require_once 'autoload.php';
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookRequestException;
use Facebook\FacebookSession;
require '../../config/config.php';
require '../../config/autoload.php';

// init app with app id and secret
FacebookSession::setDefaultApplication('1517476561907023', '44304775f2a740b9120b95e2dd305713');
$required_scope = 'public_profile, email, user_birthday, user_location';
// login helper with redirect_uri
$helper = new FacebookRedirectLoginHelper('http://autorent-me.com/lib/sociallogin/fb/fbconfig.php');

try {
    $session = $helper->getSessionFromRedirect();

} catch (FacebookRequestException $ex) {
	// When Facebook returns an error
} catch (Exception $ex) {
	// When validation fails or other local issues
}
// see if we have a session
if (isset($session)) {
	// graph api request for user data
	$request = new FacebookRequest($session, 'GET', '/me?fields=id,name,first_name,last_name,email,gender,birthday,location');
	$response = $request->execute();

	$graphObject = $response->getGraphObject();
	$fbid = $graphObject->getProperty('id'); // To Get Facebook ID
	$fbfname = $graphObject->getProperty('first_name'); // To Get Facebook first name
	$fblname = $graphObject->getProperty('last_name'); // To Get Facebook first name
	$fbemail = $graphObject->getProperty('email');
	$fbgender = $graphObject->getProperty('gender');
    
    if($fbgender=="male")
    {
        $fbgender="0";
    }
    else
    {
        $fbgender="1";
    }
    
	//$fbdob = $graphObject->getProperty('birthday');
    //$fbdob = date('Y-m-d', strtotime($fbdob));
	//$fbloc = $graphObject->getProperty('location');  
	//$current_loc = $fbloc->getProperty('name');
	//$c = explode(",", $current_loc);
	//$fbcountry = trim($c[1]);
	$user = userdb::getInstance();
	if ($user->userExists($fbemail)) {
		$check=$user->updatesocialprofile($fbfname,$fblname,$fbgender,$fbemail);
        
	} else {
		$user->Create_Account_Social($fbfname, $fblname, "", "", "", $fbemail, "", $fbgender, "","","","");
	}

	$user_id = $user->getUserID($fbemail);

	$_SESSION['uid'] = $user_id;
	/* ---- header location after session ----*/

	if(isset($_SESSION['lang']) && $_SESSION['lang']=="ar")
	{
	    $language="2";
	}
	else
	{
	    $language="1";
	}


	if($language==1)
    {
    	if(empty($_SESSION['country']) || empty($_SESSION['pd']) || empty($_SESSION['dd']) || empty($_SESSION['city1']) || empty($_SESSION['city2']) || empty($_SESSION['days']) || empty($_SESSION['v_id']))
	   {
	        header('Location:../../../index.php');
	        exit();
	   }
	   else
	   {
			header('Location:../../../car_booking.php');
	        exit();
	   }
    }
    else
    {
    	if(empty($_SESSION['country']) || empty($_SESSION['pd']) || empty($_SESSION['dd']) || empty($_SESSION['city1']) || empty($_SESSION['city2']) || empty($_SESSION['days']) || empty($_SESSION['v_id']))
	   {
	        header('Location:../../../arabic/index.php');
	        exit();
	   }
	   else
	   {
			header('Location:../../../arabic/car_booking.php');
	        exit();
	   }
    }

} else {
	$loginUrl = $helper->getLoginUrl(array('scope' => $required_scope));
	header("Location: " . $loginUrl);
}
?>
