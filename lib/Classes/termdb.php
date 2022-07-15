<?php
error_reporting(E_ALL);
class termdb {

	// for single instance
	protected static $instance = null;

	// Getting single instance
	public static function getInstance() {
		if (!isset(static::$instance)) {
			static::$instance = new static;
		}
		return static::$instance;
	}
	public function addterm($name, $slug, $parent, $description) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "insert into term set name=:name,slug=:slug,description=:description,parent=:parent";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':name', $name, PDO::PARAM_STR);
		$stmt->bindparam(':slug', $slug, PDO::PARAM_STR);
		$stmt->bindparam(':description', $description, PDO::PARAM_STR);
		$stmt->bindparam(':parent', $parent, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function checkTerm($term) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from term where name=:name";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':name', $term, PDO::PARAM_STR);
		$stmt->execute();
		$number_of_rows = $stmt->fetchColumn();
		if ($number_of_rows) {
			return true;
		} else {
			return false;
		}
	}
	public function fetchterms() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from term";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
	public function fetchterm($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from term where term_id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}

	public function fetchtermname($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from term where term_id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['name'];
	}

	public function update_category($name, $slug, $parent, $description, $id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update term set name=:name,slug=:slug,description=:description,parent=:parent where term_id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':name', $name, PDO::PARAM_STR);
		$stmt->bindparam(':slug', $slug, PDO::PARAM_STR);
		$stmt->bindparam(':description', $description, PDO::PARAM_STR);
		$stmt->bindparam(':parent', $parent, PDO::PARAM_STR);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$count = $stmt->execute();

		if ($count > 0) {
			return true;
		} else {
			return false;
		}

	}

	public function Delete_category($del) {
		foreach ($del as $d) {
			$db = new dbconnect();
			$con = $db->Connect();
			$query = "delete from term where term_id=:id";
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
}
?>