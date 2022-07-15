<?php
error_reporting(E_ALL);
class userdb {

	// for single instance
	protected static $instance = null;

	// Getting single instance
	public static function getInstance() {
		if (!isset(static::$instance)) {
			static::$instance = new static;
		}
		return static::$instance;
	}

//	public function Create_Account($fname, $lname, $address, $city, $postal_code, $email, $password, $dob, $gender, $country, $countrycode, $ipnumber, $ref) {
public function Create_Account($email, $password,$ref) {

		$db = new dbconnect();
		$con = $db->Connect();
		//$query = "insert into user set fname=:fname,lname=:lname,address=:address,city=:city,postal_code=:postal_code,email=:email,password=:password,dob=:dob,gender=:gender,country=:country,countryCode=:countryCode,ipNumber=:ipNumber,ref=:ref";
		$query = "insert into user set email=:email,password=:password,ref=:ref";
        $stmt = $con->prepare($query);
		//$stmt->bindparam(':fname', $fname, PDO::PARAM_STR);
		//$stmt->bindparam(':lname', $lname, PDO::PARAM_STR);
		//$stmt->bindparam(':address', $address, PDO::PARAM_STR);
		//$stmt->bindparam(':city', $city, PDO::PARAM_STR);
		//$stmt->bindparam(':postal_code', $postal_code, PDO::PARAM_INT);
		$stmt->bindparam(':email', $email, PDO::PARAM_STR);
		$stmt->bindparam(':password', $password, PDO::PARAM_STR);
		//$stmt->bindparam(':dob', $dob, PDO::PARAM_STR);
		//$stmt->bindparam(':gender', "2", PDO::PARAM_INT);
		//$stmt->bindparam(':country', $country, PDO::PARAM_STR);
		//$stmt->bindparam(':countryCode', $countrycode, PDO::PARAM_STR);
		//$stmt->bindparam(':ipNumber', $ipnumber, PDO::PARAM_STR);
		$stmt->bindparam(':ref', $ref, PDO::PARAM_STR);
		$count = $stmt->execute();
		$id = $con->lastInsertId();
		return $id;

	}
    
    	public function Create_Account_Social($fname, $lname, $address, $city, $postal_code, $email, $password, $gender, $country, $countrycode, $ipnumber, $ref) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "insert into user set fname=:fname,lname=:lname,address=:address,city=:city,postal_code=:postal_code,email=:email,password=:password,gender=:gender,country=:country,countryCode=:countryCode,ipNumber=:ipNumber,ref=:ref";
        $stmt = $con->prepare($query);
		$stmt->bindparam(':fname', $fname, PDO::PARAM_STR);
		$stmt->bindparam(':lname', $lname, PDO::PARAM_STR);
		$stmt->bindparam(':address', $address, PDO::PARAM_STR);
		$stmt->bindparam(':city', $city, PDO::PARAM_STR);
		$stmt->bindparam(':postal_code', $postal_code, PDO::PARAM_INT);
		$stmt->bindparam(':email', $email, PDO::PARAM_STR);
		$stmt->bindparam(':password', $password, PDO::PARAM_STR);
		$stmt->bindparam(':gender', $gender, PDO::PARAM_INT);
		$stmt->bindparam(':country', $country, PDO::PARAM_STR);
		$stmt->bindparam(':countryCode', $countrycode, PDO::PARAM_STR);
		$stmt->bindparam(':ipNumber', $ipnumber, PDO::PARAM_STR);
		$stmt->bindparam(':ref', $ref, PDO::PARAM_STR);
		$count = $stmt->execute();
		$id = $con->lastInsertId();
		return $id;

	}
	public function fetch_profile($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from user where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	public function fetch_profilebyemail($email) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from user where email=:email";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}

	public function Update_profile($fname, $lname, $address, $city, $postcode, $email, $dob, $gender, $country, $img_url, $id) {
		$db = new dbconnect();
		$con = $db->Connect();

		$dob = date("Y-m-d", strtotime($dob));

		$query = "Update user set fname=:fname,lname=:lname,address=:address,city=:city,postal_code=:postcode,country=:country,email=:email,dob=:dob,gender=:gender,img_url=:img_url where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':fname', $fname, PDO::PARAM_STR);
		$stmt->bindparam(':lname', $lname, PDO::PARAM_STR);
		$stmt->bindparam(':address', $address, PDO::PARAM_STR);
		$stmt->bindparam(':city', $city, PDO::PARAM_STR);
		$stmt->bindparam(':postcode', $postcode, PDO::PARAM_STR);
		$stmt->bindparam(':country', $country, PDO::PARAM_STR);
		$stmt->bindparam(':email', $email, PDO::PARAM_STR);
		$stmt->bindparam(':dob', $dob, PDO::PARAM_STR);
		$stmt->bindparam(':gender', $gender, PDO::PARAM_STR);
		$stmt->bindParam(':img_url', $img_url, PDO::PARAM_STR);
		$stmt->bindParam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();

	}

	public function updateUser($token, $email) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update user set confirmtoken=:confirmtoken ,confirmmaildate=NOW() where email=:email";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':confirmtoken', $token, PDO::PARAM_STR);
		$stmt->bindparam(':email', $email, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function reset_password($pass,$id) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update user set password=:password,forgettoken='',forgetmaildate='' where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':password', $pass, PDO::PARAM_STR);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}

		public function forget_pass_update($forgettoken, $email) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update user set forgettoken=:forgettoken ,forgetmaildate=NOW() where email=:email";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':forgettoken', $forgettoken, PDO::PARAM_STR);
		$stmt->bindparam(':email', $email, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}



	public function varifyUser($id) {


		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update user set varified=1,confirmtoken='' ,confirmmaildate='' where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function varify_document($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update document set status='1'where did=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}

	}

	public function deleteUser($del) {
		foreach ($del as $d) {

			$db = new dbconnect();
			$con = $db->Connect();
			$query = "delete from user where id=:id";
			$stmt = $con->prepare($query);
			$stmt->bindparam(':id', $d, PDO::PARAM_STR);
			$count = $stmt->execute();

		}
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function deleteUserDocument($del) {
		foreach ($del as $d) {

			$db = new dbconnect();
			$con = $db->Connect();
			$query = "delete from document where did=:id";
			$stmt = $con->prepare($query);
			$stmt->bindparam(':id', $d, PDO::PARAM_STR);
			$count = $stmt->execute();

		}
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function userExists($email) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from user where email=:email";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();
		$number_of_rows = $stmt->fetchColumn();

		if ($number_of_rows) {
			return true;
		} else {
			return false;
		}

	}

	// Check User with email and password.
	public function checkUser($email, $password) {
		$check = 0;
		$mdpass = md5($password);
		$pass = crypt($password, $mdpass);

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from user where email=:email AND password=:password";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':email', $email, PDO::PARAM_STR);
		$stmt->bindparam(':password', $pass, PDO::PARAM_STR);
		$stmt->execute();
		$number_of_rows = $stmt->fetchColumn();
		if ($number_of_rows) {
			return true;
		} else {
			return false;
		}
	}

	// Get user id by email
	public function getUserID($email) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select id from user where email=:email";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['id'];
	}

	//fetch user country name
	public function getUserCountry($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select name from country where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row->name;
	}

	public function download_document($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select img_url from document where did=:did";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':did', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['img_url'];
	}

	//fetch all countries
	public function fetch_Countries() {
		$result = array();
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "Select id,name from country";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$i = 0;
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[$i] = $row;
			$i++;
		}
		return $result;
	}

	//Get user email by id
	public function getUserEmail($id) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select email from user where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['email']; //
	}
	public function getUserDocument($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from document where user_id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}

	public function updateprofile($id, $fname, $lname, $address, $city, $postal_code, $country, $gen, $dob, $img_url,$cell='',$email='') {

		$db = new dbconnect();
		$con = $db->Connect();

		if ($cell) 
		{
		  if($email)
          {
            $query = "update user set fname=:fname,lname=:lname,email=:email,address=:address,city=:city,postal_code=:postal_code,country=:country,dob=:dob,gender=:gender,cell=:cell,img_url=:img_url where id=:id";
          }
          else
          {
            $query = "update user set fname=:fname,lname=:lname,address=:address,city=:city,postal_code=:postal_code,country=:country,dob=:dob,gender=:gender,cell=:cell,img_url=:img_url where id=:id";
          }
			
		}
		else
		{
		  if($email)
          {
            $query = "update user set fname=:fname,lname=:lname,email=:email,address=:address,city=:city,postal_code=:postal_code,country=:country,dob=:dob,gender=:gender,img_url=:img_url where id=:id";
          }
          else
          {
            $query = "update user set fname=:fname,lname=:lname,address=:address,city=:city,postal_code=:postal_code,country=:country,dob=:dob,gender=:gender,img_url=:img_url where id=:id";
          }
			
		}
		
		$stmt = $con->prepare($query);
		$stmt->bindparam(':fname', $fname, PDO::PARAM_STR);
		$stmt->bindparam(':lname', $lname, PDO::PARAM_STR);
        if($email)
        {
           $stmt->bindparam(':email', $email, PDO::PARAM_STR); 
        }
        
		$stmt->bindparam(':address', $address, PDO::PARAM_STR);
		$stmt->bindparam(':city', $city, PDO::PARAM_STR);
		$stmt->bindparam(':postal_code', $postal_code, PDO::PARAM_STR);
		$stmt->bindparam(':country', $country, PDO::PARAM_STR);
		$stmt->bindparam(':dob', $dob, PDO::PARAM_STR);
		$stmt->bindparam(':gender', $gen, PDO::PARAM_STR);
		$stmt->bindparam(':img_url', $img_url, PDO::PARAM_STR);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);

		if ($cell) 
		{
			$stmt->bindparam(':cell', $cell, PDO::PARAM_STR);
		}

		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}

	}
    
    
    public function updatesocialprofile($fname,$lname,$gender,$email) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update user set fname=:fname,lname=:lname,gender=:gender where email=:email";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':fname', $fname, PDO::PARAM_STR);
		$stmt->bindparam(':lname', $lname, PDO::PARAM_STR);
		$stmt->bindparam(':gender', $gender, PDO::PARAM_STR);
		$stmt->bindparam(':email', $email, PDO::PARAM_STR);
		$count = $stmt->execute();

		if ($count > 0) {
			return true;
		} else {
			return false;
		}

	}

	// Check Login
	public function checkLogin() {

		if (isset($_COOKIE['uid'])) {
			$_SESSION['uid'] = $_COOKIE['uid'];
		}

		if (isset($_SESSION['uid'])) {
			return true;
		} else {
			return false;
		}
	}
	//Get user id from session
	public function getUseerIDfromSession() {
		if (isset($_SESSION['uid'])) {
			return $_SESSION['uid'];
		}
	}
	public function Verify_Password($id, $oldpass) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select password from user where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$pass = $row['password'];
		return $pass;
	}
	public function Change_Password($id, $oldpass, $npass) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update user set password=:npass where password=:pass and id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':npass', $npass, PDO::PARAM_STR);
		$stmt->bindparam(':pass', $oldpass, PDO::PARAM_STR);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
	}

	// User Logout
	public function logout() {
		if (isset($_COOKIE['uid'])) {
			setcookie("uid", $_SESSION['uid'], time() - 606024 * 7, "/");
		}
		unset($_SESSION['uid']);
	}
	public function getUserName($uid) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select fname,lname from user where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $uid, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$name = $row['fname'] . " " . $row['lname'];
		return $name;

	}
    
    public function getUsersbyname($name) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select id from user where fname=:name";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':name', $name, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;

	}
	public function getUserRef($uid) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select ref from user where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $uid, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$name = $row['ref'];
		return $name;

	}
    
    public function getUserAddress($uid) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select address from user where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $uid, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$name = $row['address'];
		return $name;

	}
	public function getUsers() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from user";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;

	}
	public function getreffedUsers($username) {


		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from user where ref=:ref";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':ref', $username, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;

	}
	public function totalUsers() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from user";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$number_of_rows = $stmt->fetchColumn();
		if ($number_of_rows) {
			return $number_of_rows;
		} else {
			return false;
		}
	}

	public function validated_document($user_id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from document where user_id=:user_id and status=1";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':user_id', $user_id, PDO::PARAM_STR);
		$stmt->execute();
		$number_of_rows = $stmt->fetchColumn();

		if ($number_of_rows) {
			return true;
		} else {
			return false;
		}
	}

}
?>