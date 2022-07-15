<?php
error_reporting(E_ALL);
class careerdb {

	// for single instance
	protected static $instance = null;

	// Getting single instance
	public static function getInstance() {
		if (!isset(static::$instance)) {
			static::$instance = new static;
		}
		return static::$instance;
	}
	public function addcareer($title,$cid, $city,$description){

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "insert into career set title=:title,location=:location,country=:country,description=:description,status=1";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':title', $title, PDO::PARAM_STR);
		$stmt->bindparam(':location', $city, PDO::PARAM_STR);
		$stmt->bindparam(':country', $cid, PDO::PARAM_STR);
		$stmt->bindparam(':description', $description, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function add_job_application($id,$fname, $lname, $email, $massage, $file_source){

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "insert into application set fname=:fname,lname=:lname,email=:email,massage=:massage,file_source=:file_source,cid=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':fname', $fname, PDO::PARAM_STR);
		$stmt->bindparam(':lname', $lname, PDO::PARAM_STR);
		$stmt->bindparam(':email', $email, PDO::PARAM_STR);
		$stmt->bindparam(':massage', $massage, PDO::PARAM_STR);
		$stmt->bindparam(':file_source', $file_source, PDO::PARAM_STR);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}

		public function fetch_job_applications($id){
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from application where cid=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}

	public function fetchcareers() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from career";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}

	public function fetch_active_careers() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from career where status=1";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}


	public function fetchcareer($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from career where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}

	public function update_career($id,$title,$cid, $city,$description) {

		$query = "update term set name=:name,slug=:slug,description=:description,parent=:parent where term_id=:id";
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update career set title=:title,location=:location,country=:country,description=:description where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':title', $title, PDO::PARAM_STR);
		$stmt->bindparam(':location', $city, PDO::PARAM_STR);
		$stmt->bindparam(':country', $cid, PDO::PARAM_STR);
		$stmt->bindparam(':description', $description, PDO::PARAM_STR);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}

	}

	public function delete_career($del) {
		foreach ($del as $d) {
			$db = new dbconnect();
			$con = $db->Connect();
			$query = "delete from career where id=:id";
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


		public function delete_applications($del) {
		foreach ($del as $d) {
			$db = new dbconnect();
			$con = $db->Connect();
			$query = "delete from application where id=:id";
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

		public function change_carrer_status($id,$status) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update career set status=:status where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->bindparam(':status', $status, PDO::PARAM_STR);
		$count = $stmt->execute();

		if ($count > 0) {
			return true;
		} else {
			return false;
		}

	}
}
?>