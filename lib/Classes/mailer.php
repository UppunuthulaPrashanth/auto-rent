<?php
error_reporting(E_ALL);
class mailer {

	// for single instance
	protected static $instance = null;

	// Getting single instance
	public static function getInstance() {
		if (!isset(static::$instance)) {
			static::$instance = new static;
		}
		return static::$instance;
	}
	public function fetch_activemailer() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from mailer where status=1";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	public function fetch_allmailers() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from mailer";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
	public function fetch_mailer($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from mailer where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	public function update_mailer($id, $key, $password, $status) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update mailer set key_id=:key_id,password=:password,status=:status where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':key_id', $key, PDO::PARAM_STR);
		$stmt->bindparam(':password', $password, PDO::PARAM_STR);
		$stmt->bindparam(':status', $status, PDO::PARAM_STR);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$check = $stmt->execute();

		if ($check && $status == 1) {
			$db = new dbconnect();
			$con = $db->Connect();
			$query = "update mailer set status=0 where id!=:id";
			$stmt = $con->prepare($query);
			$stmt->bindparam(':id', $id, PDO::PARAM_STR);
			$check = $stmt->execute();
		}
		return $check;
	}

}
?>