<?php
error_reporting(E_ALL);
class enquiriesdb {

	// for single instance
	protected static $instance = null;

	// Getting single instance
	public static function getInstance() {
		if (!isset(static::$instance)) {
			static::$instance = new static;
		}
		return static::$instance;
	}
	public function add_enquiries($name, $subject, $email, $cell, $address, $msg) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "insert into enquiries set name=:name,subject=:subject,email=:email,cell=:cell,address=:address,msg=:msg";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':name', $name, PDO::PARAM_STR);
		$stmt->bindparam(':subject', $subject, PDO::PARAM_STR);
		$stmt->bindparam(':email', $email, PDO::PARAM_STR);
		$stmt->bindparam(':cell', $cell, PDO::PARAM_STR);
		$stmt->bindparam(':address', $address, PDO::PARAM_STR);
		$stmt->bindparam(':msg', $msg, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}
    
    public function add_deal_enquiries($name, $subject, $email, $cell, $address, $msg,$pd,$dd,$pickup,$drop,$deal) {
        
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "insert into deal_enquiries set pd=:pd,dd=:dd,pickup=:pickup,droploc=:drop,name=:name,subject=:subject,email=:email,cell=:cell,address=:address,msg=:msg,deal=:deal";
        $stmt = $con->prepare($query);
        $stmt->bindparam(':pd', $pd, PDO::PARAM_STR);
        $stmt->bindparam(':dd', $dd, PDO::PARAM_STR);
        $stmt->bindparam(':pickup', $pickup, PDO::PARAM_STR);
        $stmt->bindparam(':drop', $drop, PDO::PARAM_STR);        
		$stmt->bindparam(':name', $name, PDO::PARAM_STR);
		$stmt->bindparam(':subject', $subject, PDO::PARAM_STR);
		$stmt->bindparam(':email', $email, PDO::PARAM_STR);
		$stmt->bindparam(':cell', $cell, PDO::PARAM_STR);
		$stmt->bindparam(':address', $address, PDO::PARAM_STR);
		$stmt->bindparam(':msg', $msg, PDO::PARAM_STR);
        $stmt->bindparam(':deal', $deal, PDO::PARAM_STR);
		$count = $stmt->execute();
        
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}
    
    
    public function add_lease_enquiries($name, $subject, $email, $cell,$msg) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "insert into lease_enquiries set name=:name,subject=:subject,email=:email,cell=:cell,msg=:msg";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':name', $name, PDO::PARAM_STR);
		$stmt->bindparam(':subject', $subject, PDO::PARAM_STR);
		$stmt->bindparam(':email', $email, PDO::PARAM_STR);
		$stmt->bindparam(':cell', $cell, PDO::PARAM_STR);
		$stmt->bindparam(':msg', $msg, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}
    
    
    public function add_buy_cars_enquiries($name, $subject, $email, $cell,$msg) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "insert into buy_cars_enquiries set name=:name,subject=:subject,email=:email,cell=:cell,msg=:msg";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':name', $name, PDO::PARAM_STR);
		$stmt->bindparam(':subject', $subject, PDO::PARAM_STR);
		$stmt->bindparam(':email', $email, PDO::PARAM_STR);
		$stmt->bindparam(':cell', $cell, PDO::PARAM_STR);
		$stmt->bindparam(':msg', $msg, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}

		public function fetch_enquiries() {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from enquiries";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;

	}
    
	public function fetch_deal_enquiries() {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from deal_enquiries";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;

	}
    
   	public function fetch_lease_deal_enquiries() {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from lease_enquiries";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;

	}
    
   	public function buy_car_deal_enquiries() {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from buy_cars_enquiries";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;

	}

		public function delete_enquiries($del) {
		foreach ($del as $d) {
			$db = new dbconnect();
			$con = $db->Connect();
			$query = "delete from enquiries where id=:id";
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
    
    
   	public function delete_deal_enquiries($del) {
		foreach ($del as $d) {
			$db = new dbconnect();
			$con = $db->Connect();
			$query = "delete from deal_enquiries where id=:id";
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
    
    public function delete_lease_enquiries($del) {
		foreach ($del as $d) {
			$db = new dbconnect();
			$con = $db->Connect();
			$query = "delete from lease_enquiries where id=:id";
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
    
    public function delete_buy_cars_enquiries($del) {
		foreach ($del as $d) {
			$db = new dbconnect();
			$con = $db->Connect();
			$query = "delete from buy_cars_enquiries where id=:id";
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