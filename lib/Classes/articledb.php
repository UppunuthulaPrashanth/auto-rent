<?php
error_reporting(E_ALL);
class articledb {

	// for single instance
	protected static $instance = null;

	// Getting single instance
	public static function getInstance() {
		if (!isset(static::$instance)) {
			static::$instance = new static;
		}
		return static::$instance;
	}
	public function addarticle($title, $slug, $catgory, $description, $img_url) {
		$user = $_SESSION['aid'];

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "insert into article set title=:title,slug=:slug,category=:category,description=:description,img_url=:img_url,date=NOW(),uid=:uid";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':title', $title, PDO::PARAM_STR);
		$stmt->bindparam(':slug', $slug, PDO::PARAM_STR);
		$stmt->bindparam(':category', $catgory, PDO::PARAM_STR);
		$stmt->bindparam(':description', $description, PDO::PARAM_STR);
		$stmt->bindparam(':img_url', $img_url, PDO::PARAM_STR);
		$stmt->bindparam(':uid', $user, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function fetcharticles() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from article";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
	public function fetcharticlesbycategory($cat) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select term_id from term where name=:name";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':name', $cat, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$query2 = "select * from article where category=:category";
		$stmt2 = $con->prepare($query2);
		$stmt2->bindparam(':category', $row['term_id'], PDO::PARAM_STR);
		$stmt2->execute();
		$row = $stmt2->fetchAll(PDO::FETCH_ASSOC);

		return $row;
	}
	public function fetcharticle($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from article where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	public function checkarticle($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from article where id=:id";
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

	public function fetchlatestarticle() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from article LIMIT 5";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;

	}

	public function updatearticle($id, $title, $slug, $description, $catgory, $img_url) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update article set title=:title,slug=:slug,description=:description,category=:category,img_url=:img_url where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':title', $title, PDO::PARAM_STR);
		$stmt->bindparam(':slug', $slug, PDO::PARAM_STR);
		$stmt->bindparam(':description', $description, PDO::PARAM_STR);
		$stmt->bindparam(':category', $catgory, PDO::PARAM_STR);
		$stmt->bindparam(':img_url', $img_url, PDO::PARAM_STR);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$count = $stmt->execute();

		if ($count > 0) {
			return true;
		} else {
			return false;
		}

	}

	public function deletearticle($del) {
		foreach ($del as $d) {
			$img = $this->fetcharticle($d)->img_url;

			if (file_exists(PATH . BASE_URL . "images/admin_images/artilces/" . $img)) {
				unlink(PATH . BASE_URL . "images/admin_images/artilces/" . $img);
			}

			$db = new dbconnect();
			$con = $db->Connect();
			$query = "delete from article where id=:id";
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