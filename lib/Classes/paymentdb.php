<?php
error_reporting(E_ALL);
class paymentdb {

	// for single instance
	protected static $instance = null;

	// Getting single instance
	public static function getInstance() {
		if (!isset(static::$instance)) {
			static::$instance = new static;
		}
		return static::$instance;
	}
	public function fetch_gateways() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from gateways where active=1 limit 1";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	public function fetch_allgateways() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from gateways";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
	public function fetch_gateway($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from gateways where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	public function update_gateway($id, $email, $mid, $skey, $pkey, $sig, $cur, $status) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update gateways set email=:email,marchent_id=:marchent_id,secret_key=:secret_key,public_key=:public_key,signature=:signature,currency=:currency,active=:active where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':email', $email, PDO::PARAM_STR);
		$stmt->bindparam(':marchent_id', $mid, PDO::PARAM_STR);
		$stmt->bindparam(':secret_key', $skey, PDO::PARAM_STR);
		$stmt->bindparam(':public_key', $pkey, PDO::PARAM_STR);
		$stmt->bindparam(':signature', $sig, PDO::PARAM_STR);
		$stmt->bindparam(':currency', $cur, PDO::PARAM_STR);
		$stmt->bindparam(':active', $status, PDO::PARAM_STR);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$check = $stmt->execute();

		if ($check && $status == 1) {

			$db = new dbconnect();
			$con = $db->Connect();
			$query = "update gateways set active=0 where id!=:id";
			$stmt = $con->prepare($query);
			$stmt->bindparam(':id', $id, PDO::PARAM_STR);
			$count = $stmt->execute();
			if ($count > 0) {
				return true;
			} else {
				return false;
			}
		}
		return $check;
	}
	public function insert_transactions($user, $bid, $price, $processor,$paypalid) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "insert into transaction set user=:user,bid=:bid,amount=:amount,date=NOW(),processor=:processor,paypalid=:paypalid,status=1";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':user', $user, PDO::PARAM_STR);
		$stmt->bindparam(':bid', $bid, PDO::PARAM_STR);
		$stmt->bindparam(':amount', $price, PDO::PARAM_STR);
		$stmt->bindparam(':paypalid', $paypalid, PDO::PARAM_STR);
		$stmt->bindparam(':processor', $processor, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function currency_converter($amount,$from,$to)
	{

		/*$from_Currency = urlencode($from);
		$to_Currency = urlencode($to);
		$get = file_get_contents("https://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency");
		$get = explode("<span class=bld>",$get);
		$get = explode("</span>",$get[1]);  
		$converted_amount = preg_replace("/[^0-9\.]/", null, $get[0]);
		return round($converted_amount,2);*/

		//https://www.google.com.ar/search?q=1+usd+to+inr
		//<span class="DFlfde SwHCTb" data-precision="2" data-value="70.991">70.99</span>

		return "";
/*

		$from_Currency = urlencode($from);
		$to_Currency = urlencode($to);
		$get = file_get_contents("https://www.google.com.ar/search?q=$amount+$from_Currency+to+$to_Currency");

		$get = explode('<span class=\"DFlfde SwHCTb\" data-precision=\"2\"',$get);
		echo "<pre>";
		print_r($get);
		echo "</pre>";

		$get = explode("</span>",$get[0]);
		$converted_amount = preg_replace("/[^0-9\.]/", null, $get[0]);


		return round($converted_amount,2);
*/
	}
	public function fetch_transactions() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from transaction";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}

	public function deletetransaction($del) {
		foreach ($del as $d) {
			
			$db = new dbconnect();
			$con = $db->Connect();
			$query = "delete from transaction where id=:id";
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
	public function fetch_transactionbyuser($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from transaction where user=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
	public function fetch_transactionbybid($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from transaction where bid=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
}
?>