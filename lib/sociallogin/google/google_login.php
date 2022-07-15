<?php
require 'http.php';
require 'oauth_client.php';
require 'config.php';

require '../../config/config.php';
require '../../config/autoload.php';

$client = new oauth_client_class;
//$client->access_token = $client->ResetAccessToken();
//echo $client->getAccessToken();

// set the offline access only if you need to call an API
// when the user is not present and the token may expire
$client->offline = true;

$client->debug = false;
$client->debug_http = true;
$client->redirect_uri = REDIRECT_URL;

$client->client_id = CLIENT_ID;
$application_line = __LINE__;
$client->client_secret = CLIENT_SECRET;

if (strlen($client->client_id) == 0 || strlen($client->client_secret) == 0) {
	die('Please go to Google APIs console page ' .
		'http://code.google.com/apis/console in the API access tab, ' .
		'create a new client ID, and in the line ' . $application_line .
		' set the client_id to Client ID and client_secret with Client Secret. ' .
		'The callback URL must be ' . $client->redirect_uri . ' but make sure ' .
		'the domain is valid and can be resolved by a public DNS.');
}

/* API permissions
 */
$client->scope = SCOPE;
if (($success = $client->Initialize())) {

	if (($success = $client->Process())) {

		if (strlen($client->authorization_error)) {

			$client->error = $client->authorization_error;
			$success = false;

			$client = $client->ResetAccessToken();

		} elseif (strlen($client->access_token)) {

			$success = $client->CallAPI(
				'https://www.googleapis.com/oauth2/v1/userinfo', 'GET', array(), array('FailOnAccessError' => true), $user);

		}
	}
	$success = $client->Finalize($success);

}
if ($client->exit) {
	exit;
}

if ($success) {

	$g_email = $user->email;
	$g_fname = $user->given_name;
	$g_lname = $user->family_name;
	$g_gender = $user->gender;
	//$g_dob = $user->birthday;

    if($g_gender=="male")
    {
        $g_gender="0";
    }
    else
    {
        $g_gender="1";
    }
    
	$user_db = userdb::getInstance();
	if ($user_db->userExists($g_email)) {
	   $check=$user_db->updatesocialprofile($g_fname,$g_lname,$g_gender,$g_email);

	} else {
		$user_db->Create_Account_Social($g_fname, $g_lname, "", "", "", $g_email, "", $g_gender, "","","","");
	}

	$user_id = $user_db->getUserID($g_email);

	$_SESSION['uid'] = $user_id;

} else {

	//echo 'error';
	$_SESSION["e_msg"] = $client->error;
}

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
?>