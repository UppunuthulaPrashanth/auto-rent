<?php
class tokendb {

	// for single instance
	protected static $instance = null;

	// Getting single instance
	public static function getInstance() {
		if (!isset(static::$instance)) {
			static::$instance = new static;
		}
		return static::$instance;
	}
	function generateToken($length = 20) {
		if (function_exists('openssl_random_pseudo_bytes')) {
			$token = base64_encode(openssl_random_pseudo_bytes($length, $strong));
			if ($strong == TRUE) {
				return strtr(substr($token, 0, $length), '+/=', '-_,');
			}
			//base64 is about 33% longer, so we need to truncate the result
		}

		//fallback to mt_rand if php < 5.3 or no openssl available
		$characters = '0123456789';
		$characters .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz/+';
		$charactersLength = strlen($characters) - 1;
		$token = '';

		//select some random characters
		for ($i = 0; $i < $length; $i++) {
			$token .= $characters[mt_rand(0, $charactersLength)];
		}

		return $token;
	}
	public function checktoken($id, $token,$type) {

		if ($type=="individual") {
			$db = new dbconnect();
			$con = $db->Connect();
			$query = "select count(*) from user where id=:id AND forgettoken=:token";
			$stmt = $con->prepare($query);
			$stmt->bindparam(':id', $id, PDO::PARAM_STR);
			$stmt->bindparam(':token', $token, PDO::PARAM_STR);
			$stmt->execute();
			$number_of_rows = $stmt->fetchColumn();
			if ($number_of_rows) {
				return true;
			} else {
				return false;
			}
		}
		else if($type=="partner")
		{
			$db = new dbconnect();
			$con = $db->Connect();
			$query = "select count(*) from partner where id=:id AND resetpasstoken=:token";
			$stmt = $con->prepare($query);
			$stmt->bindparam(':id', $id, PDO::PARAM_STR);
			$stmt->bindparam(':token', $token, PDO::PARAM_STR);
			$stmt->execute();
			$number_of_rows = $stmt->fetchColumn();
			if ($number_of_rows) {
				return true;
			} else {
				return false;
			}
		}
		

	}
	public function checkConfirmationtoken($id, $token) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from user where id=:id AND confirmtoken=:token";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->bindparam(':token', $token, PDO::PARAM_STR);
		$stmt->execute();
		$number_of_rows = $stmt->fetchColumn();
		if ($number_of_rows) {
			return true;
		} else {
			return false;
		}

	}
	public function partnerresettoken($id, $token) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from partner where id=:id AND resetpasstoken=:token";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->bindparam(':token', $token, PDO::PARAM_STR);
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