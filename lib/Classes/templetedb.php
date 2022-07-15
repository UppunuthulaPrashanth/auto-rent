<?php
error_reporting(E_ALL);
class templetedb {

	// for single instance
	protected static $instance = null;

	// Getting single instance
	public static function getInstance() {
		if (!isset(static::$instance)) {
			static::$instance = new static;
		}
		return static::$instance;
	}

	public function fetchtemplete() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from templete";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
	public function changetemplete($tem) {
		$db = new dbconnect();
		$con = $db->Connect();

		$query = "update templete set status=1 where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $tem, PDO::PARAM_STR);
		$count = $stmt->execute();

		$query = "update templete set status=0 where id!=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $tem, PDO::PARAM_STR);
		$count = $stmt->execute();

		if ($count > 0) {
			return true;
		} else {
			return false;
		}

	}
	public function activetemplete() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from templete where status=1";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
}
?>