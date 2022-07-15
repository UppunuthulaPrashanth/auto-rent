<?php
error_reporting(E_ALL);
class partnerdb {

	// for single instance
	protected static $instance = null;

	// Getting single instance
	public static function getInstance() {
		if (!isset(static::$instance)) {
			static::$instance = new static;
		}
		return static::$instance;
	}

	public function Create_Partner($company, $name, $des, $cell, $username, $email,$address, $img_url) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "insert into partner set company=:company,pname=:pname,designation=:designation,phone=:phone,username=:username,email=:email,address=:address,license_url=:license_url";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':company', $company, PDO::PARAM_STR);
		$stmt->bindparam(':pname', $name, PDO::PARAM_STR);
		$stmt->bindparam(':designation', $des, PDO::PARAM_STR);
		$stmt->bindparam(':phone', $cell, PDO::PARAM_STR);
		$stmt->bindparam(':username', $username, PDO::PARAM_STR);
		$stmt->bindparam(':email', $email, PDO::PARAM_STR);
        $stmt->bindparam(':address', $address, PDO::PARAM_STR);
		$stmt->bindparam(':license_url', $img_url, PDO::PARAM_STR);
		$count = $stmt->execute();

		$id = $con->lastInsertId();
		return $id;
	}
	public function fetch_partners() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from partner";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}

	public function deletepartner($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from partner where id in($id)";
		$stmt = $con->prepare($query);
		$result = $stmt->execute();
		$results = $stmt->fetchAll();
		foreach ($results as $r) {
			if (file_exists(PATH . BASE_URL . "images/partner_images/profile/" . $r['img_url'])) {
				unlink(PATH . BASE_URL . "images/partner_images/profile/" . $r['img_url']);
			}
			if (file_exists(PATH . BASE_URL . "images/partner_images/license/" . $r['license_url'])) {
				unlink(PATH . BASE_URL . "images/partner_images/license/" . $r['license_url']);
			}
		}
		$query = "delete from partner where id in($id)";
		$stmt = $con->prepare($query);
		$del = $stmt->execute();
		return $del;

	}

	public function changepartnerStatus($id, $status) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update partner set status=$status where id in($id)";

		$stmt = $con->prepare($query);
		$stmt->execute();
		return true;

	}

		public function reset_password($pass,$id) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update partner set password=:password,resetpasstoken='',resetdate='' where id=:id";
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

	public function fetch_profile($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from partner where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	public function totalrefferedUser($username) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from user where ref=:ref";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':ref', $username, PDO::PARAM_STR);
		$stmt->execute();
		$number_of_rows = $stmt->fetchColumn();
		if ($number_of_rows) {
			return $number_of_rows;
		} else {
			return false;
		}

	}
	public function totalbookings($username) {
		$count = 0;

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from user where ref=:ref";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':ref', $username, PDO::PARAM_STR);
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

		foreach ($rows as $r) {
			$id = $r['id'];
			$db = new dbconnect();
			$con = $db->Connect();
			$query = "select count(*) from booking where user_id=:id";
			$stmt = $con->prepare($query);
			$stmt->bindparam(':id', $id, PDO::PARAM_STR);
			$stmt->execute();
			$number_of_rows = $stmt->fetchColumn();
			$count += $number_of_rows;

		}
		return $count;

	}
	public function totalcommision($username) {
		$earning = 0;
        
        $AED_earning = 0;
        $SAR_earning = 0;
        $OMR_earning = 0;
        
        $db = new dbconnect();
		$con = $db->Connect();

		$query2 = "select * from user where ref=:username";
		$stmt2 = $con->prepare($query2);
		$stmt2->bindparam(':username', $username, PDO::PARAM_STR);
		$stmt2->execute();
		$users = $stmt2->fetchAll(PDO::FETCH_ASSOC);

		foreach ($users as $u) {

			$query3 = "select * from transaction where user=:username";
			$stmt3 = $con->prepare($query3);
			$stmt3->bindparam(':username', $u['id'], PDO::PARAM_STR);
			$stmt3->execute();
			$transactions = $stmt3->fetchAll(PDO::FETCH_ASSOC);

			foreach ($transactions as $t) {

				$query4 = "select * from booking where id=:id";
				$stmt4 = $con->prepare($query4);
				$stmt4->bindparam(':id', $t['bid'], PDO::PARAM_STR);
				$stmt4->execute();
				$bookings = $stmt4->fetchAll(PDO::FETCH_ASSOC);
				foreach ($bookings as $b) {
				    if($b['currency']=="AED")
                    {
                        $AED_earning += $b['commision'];
                    }
                    else if($b['currency']=="SAR")
                    {
                        $SAR_earning += $b['commision'];
                    }
                    else if($b['currency']=="OMR")
                    {
                        $OMR_earning += $b['commision'];
                    }
                    
                }    
                    
					
				
			}

		}
        $earning=$AED_earning.' AED , '.$SAR_earning.' SAR , '.$OMR_earning .' OMR ';
		return $earning;

	}
	public function fetchbyusername($username) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from partner where username=:username";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':username', $username, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;

	}



	public function recover_pass_update($resetpasstoken, $email) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update partner set resetpasstoken=:resetpasstoken ,resetdate=NOW() where email=:email";
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
	public function setCommision($vid, $pid, $price) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from vehicle_commision where vid=:vid AND pid=:pid";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':vid', $vid, PDO::PARAM_STR);
		$stmt->bindparam(':pid', $pid, PDO::PARAM_STR);
		$stmt->execute();
		$check = $stmt->fetchColumn();

		if ($check > 0) {

			$db = new dbconnect();
			$con = $db->Connect();
			$query = "update vehicle_commision set price=:price where vid=:vid and pid=:pid";
			$stmt = $con->prepare($query);
			$stmt->bindparam(':price', $price, PDO::PARAM_STR);
			$stmt->bindparam(':vid', $vid, PDO::PARAM_STR);
			$stmt->bindparam(':pid', $pid, PDO::PARAM_STR);
			$count = $stmt->execute();
			if ($count > 0) {
				return true;
			} else {
				return false;
			}

		} else {

			$db = new dbconnect();
			$con = $db->Connect();
			$query = "insert into vehicle_commision set vid=:vid,pid=:pid,price=:price";
			$stmt = $con->prepare($query);
			$stmt->bindparam(':vid', $vid, PDO::PARAM_STR);
			$stmt->bindparam(':pid', $pid, PDO::PARAM_STR);
			$stmt->bindparam(':price', $price, PDO::PARAM_STR);
			$count = $stmt->execute();
			if ($count > 0) {
				return true;
			} else {
				return false;
			}
		}
		return $check2;

	}

	public function getVehicleCommision($vid, $pid) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select price from vehicle_commision where vid=:vid and pid=:pid";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':vid', $vid, PDO::PARAM_STR);
		$stmt->bindparam(':pid', $pid, PDO::PARAM_STR);
		$stmt->execute();
		$check = $stmt->fetchColumn();
		if ($check) {
			return $check;
		} else {
			return 0;
		}

	}

	public function usernameExists($username) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from partner where username=:username";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':username', $username, PDO::PARAM_STR);
		$stmt->execute();
		$number_of_rows = $stmt->fetchColumn();
		if ($number_of_rows) {
			return true;
		} else {
			return false;
		}
	}
	public function PartnerExists($email) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from partner where email=:email";
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



		public function reset_pass_update($token, $email) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update partner set resetpasstoken=:token ,resetdate=NOW() where email=:email";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':token', $token, PDO::PARAM_STR);
		$stmt->bindparam(':email', $email, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}


	public function fetch_profilebyemail($email) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from partner where email=:email";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
    
    	public function checkPartnerbyId($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from partner where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$number_of_rows = $stmt->fetchColumn();
		if ($number_of_rows) {
			return true;
		} else {
			return false;
		}

	}

	public function Verify_Password($id, $oldpass) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select password from partner where id=:id";
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
		$query = "update partner set password=:npass where password=:pass and id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':npass', $npass, PDO::PARAM_STR);
		$stmt->bindparam(':pass', $oldpass, PDO::PARAM_STR);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
	}
	// // Check User with email and password.
	public function checkPartner($email, $password) {
		$check = 0;
		$mdpass = md5($password);
		$pass = crypt($password, $mdpass);

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from partner where email=:email AND password=:password";
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

	// // Get user id by email
	public function getPartnerID($email) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select id from partner where email=:email";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['id'];
	}

	// //Get user email by id
	public function getPartnerEmail($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select email from partner where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['email'];
	}

	// // Check Login
	public function checkLogin() {

		if (isset($_COOKIE['pid'])) {
			$_SESSION['pid'] = $_COOKIE['pid'];
		}

		if (isset($_SESSION['pid'])) {
			return true;
		} else {
			return false;
		}
	}
	// //Get user id from session
	public function getPartnerIDfromSession() {
		if (isset($_SESSION['pid'])) {
			return $_SESSION['pid'];
		}
	}

	public function updateprofile($id, $company, $pname, $des, $phone, $img_url) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update partner set company=:company,pname=:pname,designation=:designation,phone=:phone,img_url=:img_url where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':company', $company, PDO::PARAM_STR);
		$stmt->bindparam(':pname', $pname, PDO::PARAM_STR);
		$stmt->bindparam(':designation', $des, PDO::PARAM_STR);
		$stmt->bindparam(':phone', $phone, PDO::PARAM_STR);
		$stmt->bindparam(':img_url', $img_url, PDO::PARAM_STR);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}

	}
	// // User Logout
	public function logout() {
		if (isset($_COOKIE['pid'])) {
			setcookie("pid", $_SESSION['pid'], time() - 606024 * 7, "/");
		}
		unset($_SESSION['pid']);
	}

}
?>