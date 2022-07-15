<?php
class user_documents {
	public function Add_Document($type, $country, $dno, $url, $id) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "insert into document set name=:type,country=:country,doc_no=:dno,img_url=:url,user_id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':type', $type, PDO::PARAM_STR);
		$stmt->bindparam(':country', $country, PDO::PARAM_STR);
		$stmt->bindparam(':dno', $dno, PDO::PARAM_STR);
		$stmt->bindparam(':url', $url, PDO::PARAM_STR);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function fetch_Document($user_id) {
		$result = array();
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from document where user_id=:id order by did desc";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $user_id, PDO::PARAM_STR);
		$stmt->execute();
		$i = 0;
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[$i] = $row;
			$i++;
		}
		return $result;
	}
	public function Document_Record($user_id) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from document where did=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $user_id, PDO::PARAM_STR);
		$stmt->execute();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result = $row;
		}
		return $result;
	}
	public function Delete_Document($id) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "delete from document where did=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
	}
	public function Update_Document($id, $type, $country, $dno, $img_url) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update document set name=:name,doc_no=:dno,img_url=:img,country=:country where did=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->bindparam(':name', $type, PDO::PARAM_STR);
		$stmt->bindparam(':dno', $dno, PDO::PARAM_STR);
		$stmt->bindparam(':img', $img_url, PDO::PARAM_STR);
		$stmt->bindparam(':country', $country, PDO::PARAM_STR);
		$stmt->execute();
	}
}
?>