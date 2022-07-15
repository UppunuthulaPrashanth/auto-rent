<?php

class admin {

	protected static $instance = null;

	// Getting single instance
	public static function getInstance() {
		if (!isset(static::$instance)) {
			static::$instance = new static;
		}
		return static::$instance;
	}

	public function addAdmin($fname, $lname, $email, $password) {

		$mdpass = md5($password);
		$pass = crypt($password, $mdpass);

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "insert into admin set fname=:fname,lname=:lname,email=:email,password=:password,role=2";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':fname', $fname, PDO::PARAM_STR);
		$stmt->bindparam(':lname', $lname, PDO::PARAM_STR);
		$stmt->bindparam(':email', $email, PDO::PARAM_STR);
		$stmt->bindparam(':password', $pass, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function updateprofile($id, $fname, $lname, $img_url) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update admin set fname=:fname,lname=:lname,img_url=:img_url where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':fname', $fname, PDO::PARAM_STR);
		$stmt->bindparam(':lname', $lname, PDO::PARAM_STR);
		$stmt->bindparam(':img_url', $img_url, PDO::PARAM_STR);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function Change_Password($id, $oldpass, $npass) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update admin set password=:npass where password=:pass and id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':npass', $npass, PDO::PARAM_STR);
		$stmt->bindparam(':pass', $oldpass, PDO::PARAM_STR);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function adminExists($email) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from admin where email=:email";
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

	public function checkAdmin($email, $password) {
		$mdpass = md5($password);
		$pass = crypt($password, $mdpass);

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from admin where email=:email AND password=:password";
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
	public function getadminIDfromSession() {
		if (isset($_SESSION['aid'])) {
			return $_SESSION['aid'];
		}
	}
	public function Verify_Password($id, $oldpass) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select password from admin where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$pass = $row['password'];
		return $pass;
	}
	public function getAllAdmin() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from admin";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}

	public function deleteAdmin($admin_id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "delete from admin where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $admin_id, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getAdmin($a_id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from admin where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $a_id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}

	public function getadminID($email) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select id from admin where email=:email";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['id'];
	}

	public function checkLogin() {
		if (isset($_COOKIE['aid'])) {
			$_SESSION['aid'] = $_COOKIE['aid'];
		}

		if (isset($_SESSION['aid'])) {
			return true;
		} else {
			return false;
		}
	}
	public function logout() {
		if (isset($_COOKIE['aid'])) {
			setcookie("aid", $_SESSION['aid'], time() - 606024 * 7, "/");
		}
		unset($_SESSION['aid']);
	}
	public function isSuperAdmin($aid) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from admin where id=:id AND role=1";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $aid, PDO::PARAM_STR);
		$stmt->execute();
		$number_of_rows = $stmt->fetchColumn();
		if ($number_of_rows) {
			return true;
		} else {
			return false;
		}
	}
	public function fetch_profile($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from admin where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	public function delete_Admin($del_admin) {

		foreach ($del_admin as $ad) {

			$db = new dbconnect();
			$con = $db->Connect();
			$query = "delete from admin where id=:id";
			$stmt = $con->prepare($query);
			$stmt->bindparam(':id', $ad, PDO::PARAM_STR);
			$count = $stmt->execute();

		}
		if ($count > 0) {
			return true;
		} else {
			return false;
		}

	}

	public function changeRoles($a_arr, $a_role) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update admin set role=:role where id in($a_arr)";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':role', $a_role, PDO::PARAM_STR);
		$stmt->execute();

		return true;
	}
}

?>