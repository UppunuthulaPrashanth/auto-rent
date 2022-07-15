<?php
error_reporting(E_ALL);
class languagedb {

	// for single instance
	protected static $instance = null;

	// Getting single instance
	public static function getInstance() {
		if (!isset(static::$instance)) {
			static::$instance = new static;
		}
		return static::$instance;
	}

	public function fetchlanguages() {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from language";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;

	}
	public function changelanguage($id) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update language set status=1 where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$count = $stmt->execute();

		$query2 = "update language set status=0 where id!=:id";
		$stmt2 = $con->prepare($query2);
		$stmt2->bindparam(':id', $id, PDO::PARAM_STR);
		$count = $stmt2->execute();

		if ($count > 0) {
			return true;
		} else {
			return false;
		}

	}
	public function activelanguage() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from lanuguage where status=1";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
}
?>