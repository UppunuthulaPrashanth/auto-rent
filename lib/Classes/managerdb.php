<?php

class managerdb {

	protected static $instance = null;

	// Getting single instance
	public static function getInstance() {
		if (!isset(static::$instance)) {
			static::$instance = new static;
		}
		return static::$instance;
	}

	public function addManager($fname, $lname, $email, $password) {

		$mdpass = md5($password);
		$pass = crypt($password, $mdpass);

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "insert into manager set fname=:fname,lname=:lname,email=:email,password=:password";
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
		$query = "update manager set fname=:fname,lname=:lname,img_url=:img_url where id=:id";
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
		$query = "update manager set password=:npass where password=:pass and id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':npass', $npass, PDO::PARAM_STR);
		$stmt->bindparam(':pass', $oldpass, PDO::PARAM_STR);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
	}

	public function managerExists($email) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from manager where email=:email";
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

	public function checkmanager($email, $password) {
		$mdpass = md5($password);
		$pass = crypt($password, $mdpass);
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from manager where email=:email AND password=:password";
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
	public function getmanagerIDfromSession() {
		if (isset($_SESSION['mid'])) {
			return $_SESSION['mid'];
		}
	}
	public function Verify_Password($id, $oldpass) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select password from manager where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$pass = $row['password'];
		return $pass;
	}
	public function getmanager() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from manager";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}

	public function getManagerImage($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select img_url from manager where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row->img_url;
	}

	public function delete_Manager($manager_id) {
		foreach ($manager_id as $m) {
			$img = $this->getManagerImage($m);

			if (file_exists(PATH . BASE_URL . "images/manager_images/profile/" . $img)) {
				unlink(PATH . BASE_URL . "images/manager_images/profile/" . $img);
			}

			$db = new dbconnect();
			$con = $db->Connect();
			$query = "delete from manager where id=:id";
			$stmt = $con->prepare($query);
			$stmt->bindparam(':id', $m, PDO::PARAM_STR);
			$count = $stmt->execute();

		}

		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function FetchManager($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from manager where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}

	public function getmanagerID($email) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select id from manager where email=:email";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['id'];
	}

	public function checkLogin() {
		if (isset($_COOKIE['mid'])) {
			$_SESSION['mid'] = $_COOKIE['mid'];
		}

		if (isset($_SESSION['mid'])) {
			return true;
		} else {
			return false;
		}
	}
	public function logout() {
		if (isset($_COOKIE['mid'])) {
			setcookie("mid", $_SESSION['mid'], time() - 606024 * 7, "/");
		}
		unset($_SESSION['mid']);
	}

	public function fetch_profile($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from manager where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}

}

?>