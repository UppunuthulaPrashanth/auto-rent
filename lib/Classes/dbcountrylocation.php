<?php

class dbcountrylocation {
	// for single instance
	protected static $instance = null;

	// Getting single instance
	public static function getInstance() {
		if (!isset(static::$instance)) {
			static::$instance = new static;
		}
		return static::$instance;
	}

	public function Add_Country($name,$ar_name,$currency) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "insert into country set name=:name,ar_name=:ar_name,currency=:currency";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':name', $name, PDO::PARAM_STR);
		$stmt->bindparam(':ar_name', $ar_name, PDO::PARAM_STR);
        $stmt->bindparam(':currency', $currency, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}
    
    	public function checkcountry($id) {


		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from country where id=:id";
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
    
	public function Add_Location($name,$address,$cname,$ar_name,$ar_address,$ar_cname,$phone,$email, $cid,$latitude,$longitude) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "insert into location set name=:name,city=:city,address=:address,ar_name=:ar_name,ar_city=:ar_cname,ar_address=:ar_address,phone=:phone,email=:email,cid=:cid,latitude=:latitude,longitude=:longitude";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':name', $name, PDO::PARAM_STR);
        $stmt->bindparam(':city', $cname, PDO::PARAM_STR);
        $stmt->bindparam(':address', $address, PDO::PARAM_STR);
        $stmt->bindparam(':ar_name', $ar_name, PDO::PARAM_STR);
        $stmt->bindparam(':ar_cname', $ar_cname, PDO::PARAM_STR);
        $stmt->bindparam(':ar_address', $ar_address, PDO::PARAM_STR);
        $stmt->bindparam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindparam(':email', $email, PDO::PARAM_STR);
        $stmt->bindparam(':latitude', $latitude, PDO::PARAM_STR);
        $stmt->bindparam(':longitude', $longitude, PDO::PARAM_STR);
		$stmt->bindparam(':cid', $cid, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function fetch_Country($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from country where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}

	public function check_location_byname($name) {


		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from location where name=:name";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':name', $name, PDO::PARAM_STR);
		$stmt->execute();
		$number_of_rows = $stmt->fetchColumn();
		if ($number_of_rows) {
			return true;
		} else {
			return false;
		}
	}
    
   	public function check_location_by_arabicname($name) {


		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from location where ar_name=:name";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':name', $name, PDO::PARAM_STR);
		$stmt->execute();
		$number_of_rows = $stmt->fetchColumn();
		if ($number_of_rows) {
			return true;
		} else {
			return false;
		}
	}


		public function fetch_Countrybyname($name) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from country where name=:name";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':name', $name, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
    
	public function fetch_Countryby_arabicname($name) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from country where ar_name=:name";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':name', $name, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}

	public function fetch_locationbyname($name) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from location where name=:name";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':name', $name, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
    
    public function fetch_locationby_arabicname($name) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from location where ar_name=:name";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':name', $name, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}


	public function fetch_Country_all() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from country";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
    public function fetchCountrybyLocation($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select cid from location where id=:id";
		$stmt = $con->prepare($query);
        $stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['cid'];
	}
    	public function fetch_first_country() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from country order by id asc limit 1";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}

	public function Country_Name($id) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select name from country where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;

	}
    	public function Country_Currency($id) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select currency from country where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;

	}
        	public function country_id_bynamme($name) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select id from country where name=:name";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':name', $name, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;

	}

	public function deleteCountry($del) {
		foreach ($del as $d) {
			//
			$db = new dbconnect();
			$con = $db->Connect();
			$query = "delete from country where id=:id";
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

	public function fetch_Location($id) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from location where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
	public function fetch_Locations() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from location";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}

	public function fetch_Locations_ById($cid) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from location where cid=:id and status=1";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $cid, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt;
	}

	public function fetch_Locations_Bycities($cid,$cname) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from location where cid=:id and city=:city and status=1";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $cid, PDO::PARAM_STR);
		$stmt->bindparam(':city', $cname, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt;
	}
    
    public function fetch_Locations_Byarabic_cities($cid,$cname) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from location where cid=:id and ar_city=:city and status=1";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $cid, PDO::PARAM_STR);
		$stmt->bindparam(':city', $cname, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt;
	}

		public function fetch_cities($cid) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select distinct(city) from location where cid=:id and status=1";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $cid, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt;
	}
    
	public function fetch_arabic_cities($cid) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select distinct(ar_city) from location where cid=:id and status=1";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $cid, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt;
	}

	public function Delete_Location($del) {
		foreach ($del as $d) {
			$db = new dbconnect();
			$con = $db->Connect();
			$query = "delete from location where id=:id";
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

	public function getLocationName($loc_id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select name from location where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $loc_id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['name'];

	}
	public function updateCountry($name,$ar_name,$currency,$c_id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update country set name=:name,ar_name=:ar_name,currency=:currency where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':name', $name, PDO::PARAM_STR);
		$stmt->bindparam(':ar_name', $ar_name, PDO::PARAM_STR);
        $stmt->bindparam(':currency', $currency, PDO::PARAM_STR);
		$stmt->bindparam(':id', $c_id, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}

	}
	public function updateLocation($name,$address,$cname,$ar_name,$ar_address,$ar_cname,$phone,$email, $cid, $l_id,$latitude,$longitude){

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update location set name=:name,city=:city,address=:address,ar_name=:ar_name,ar_city=:ar_cname,ar_address=:ar_address,phone=:phone,email=:email,cid=:cid,latitude=:latitude,longitude=:longitude where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':name', $name, PDO::PARAM_STR);
        $stmt->bindparam(':city', $cname, PDO::PARAM_STR);
        $stmt->bindparam(':address', $address, PDO::PARAM_STR);
        $stmt->bindparam(':ar_name', $ar_name, PDO::PARAM_STR);
        $stmt->bindparam(':ar_cname', $ar_cname, PDO::PARAM_STR);
        $stmt->bindparam(':ar_address', $ar_address, PDO::PARAM_STR);
        $stmt->bindparam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindparam(':email', $email, PDO::PARAM_STR);   
        $stmt->bindparam(':latitude', $latitude, PDO::PARAM_STR);
        $stmt->bindparam(':longitude', $longitude, PDO::PARAM_STR);     
		$stmt->bindparam(':cid', $cid, PDO::PARAM_STR);
		$stmt->bindparam(':id', $l_id, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}

	}
    	public function changelocationstatus($id,$status) {
		$db = new dbconnect();
		$con = $db->Connect();

		$query = "update location set status=:status where id=:id";
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