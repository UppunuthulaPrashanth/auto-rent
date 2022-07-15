<?php

class bookingdb {

	// for single instance
	protected static $instance = null;

	// Getting single instance
	public static function getInstance() {
		if (!isset(static::$instance)) {
			static::$instance = new static;
		}
		return static::$instance;
	}

		
	public function createBooking($pickDate, $dropDate,$driver, $gps, $bs, $cdw, $pai,$hc,$ic,$oic,$ekmc,$driver_cost,$gps_cost,$bs_cost,$cdw_cost,$pai_cost,$hc_cost,$ic_cost,$oic_cost,$ekmc_cost,$per_day_cost,$days,$rent,$doller_rent,$deal,$commision,$currency, $locId1, $locId2, $vId,$userId,$status) {

   
		$db = new dbconnect();
		$con = $db->Connect();

		$query = "insert into booking set booking_date=CURDATE(),pick_date=:pick_date,drop_date=:drop_date,driver=:driver,gps=:gps,bs=:bs,cdw=:cdw,pai=:pai,hiring=:hiring,insurance=:insurance,off_insurance=:off_insurance,ekm=:ekm,driver_cost=:driver_cost,gps_cost=:gps_cost,bs_cost=:bs_cost,cdw_cost=:cdw_cost,pai_cost=:pai_cost,hc_cost=:hc_cost,ic_cost=:ic_cost,oic_cost=:oic_cost,ekmc_cost=:ekmc_cost,per_day_cost=:per_day_cost,days=:days,total=:total,usd_total=:usd_total,deal=:deal,commision=:commision,currency=:currency,loc_id=:loc_id,loc_id2=:loc_id2,v_id=:v_id,user_id=:user_id,status=:status";


		$stmt = $con->prepare($query);
		$stmt->bindparam(':pick_date', $pickDate, PDO::PARAM_STR);
		$stmt->bindparam(':drop_date', $dropDate, PDO::PARAM_STR);
		$stmt->bindparam(':driver', $driver, PDO::PARAM_STR);
		$stmt->bindparam(':gps', $gps, PDO::PARAM_STR);
		$stmt->bindparam(':bs', $bs, PDO::PARAM_STR);
		$stmt->bindparam(':cdw', $cdw, PDO::PARAM_STR);
		$stmt->bindparam(':pai', $pai, PDO::PARAM_STR);
		$stmt->bindparam(':hiring', $hc, PDO::PARAM_STR);
		$stmt->bindparam(':insurance', $ic, PDO::PARAM_STR);
		$stmt->bindparam(':off_insurance', $oic, PDO::PARAM_STR);
		$stmt->bindparam(':ekm', $ekmc, PDO::PARAM_STR);
		$stmt->bindparam(':driver_cost', $driver_cost, PDO::PARAM_STR);
		$stmt->bindparam(':gps_cost', $gps_cost, PDO::PARAM_STR);
		$stmt->bindparam(':bs_cost', $bs_cost, PDO::PARAM_STR);
		$stmt->bindparam(':cdw_cost', $cdw_cost, PDO::PARAM_STR);
		$stmt->bindparam(':pai_cost', $pai_cost, PDO::PARAM_STR);
		$stmt->bindparam(':hc_cost', $hc_cost, PDO::PARAM_STR);
		$stmt->bindparam(':ic_cost', $ic_cost, PDO::PARAM_STR);
		$stmt->bindparam(':oic_cost', $oic_cost, PDO::PARAM_STR);
		$stmt->bindparam(':ekmc_cost', $ekmc_cost, PDO::PARAM_STR);
		$stmt->bindparam(':per_day_cost', $per_day_cost, PDO::PARAM_STR);
		$stmt->bindparam(':days', $days, PDO::PARAM_STR);
		$stmt->bindparam(':total', $rent, PDO::PARAM_STR);
		$stmt->bindparam(':usd_total', $doller_rent, PDO::PARAM_STR);
        $stmt->bindparam(':deal', $deal, PDO::PARAM_STR);  
        $stmt->bindparam(':commision', $commision, PDO::PARAM_STR);
        $stmt->bindparam(':currency', $currency, PDO::PARAM_STR);               
		$stmt->bindparam(':loc_id', $locId1, PDO::PARAM_STR);
		$stmt->bindparam(':loc_id2', $locId2, PDO::PARAM_STR);
		$stmt->bindparam(':v_id', $vId, PDO::PARAM_STR);
		$stmt->bindparam(':user_id', $userId, PDO::PARAM_STR);
		$stmt->bindparam(':status', $status, PDO::PARAM_STR);


		$result = $stmt->execute(); 

		$id = $con->lastInsertId();

		return $id;
	}

	public function getAllBooking() {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from booking order by id desc";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;

	}

	public function totalBookings() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from booking";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$number_of_rows = $stmt->fetchColumn();
		if ($number_of_rows) {
			return $number_of_rows;
		} else {
			return false;
		}

	}
	public function getreffedbooking($username) {

		  $db = new dbconnect();
		$con = $db->Connect();
		$query = "select id from user where ref=:ref";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':ref', $username, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$id = array();
        $result=array();
        $i=0;
		foreach ($row as $id2) {            
            $db = new dbconnect();
    		$con = $db->Connect();
    		$query2 = "select * from booking where user_id in(:id) order by id desc";
    		$stmt2 = $con->prepare($query2);
    		$stmt2->bindparam(':id', $id2['id'], PDO::PARAM_STR);
    		$stmt2->execute();
    		$row2= $stmt2->fetchAll(PDO::FETCH_ASSOC);
            $result=$result+$row2;
            
		}

		return $result;

	}
    
    
    	public function getpartnersbooking() {
    	   
           $db = new dbconnect();
		$con = $db->Connect();
		$query = "select id from user where ref!=''";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':ref', $username, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$id = array();
        $result=array();
        $i=0;
		foreach ($row as $id2) {            
            $db = new dbconnect();
    		$con = $db->Connect();
    		$query2 = "select * from booking where user_id in(:id) order by id desc";
    		$stmt2 = $con->prepare($query2);
    		$stmt2->bindparam(':id', $id2['id'], PDO::PARAM_STR);
    		$stmt2->execute();
    		$row2= $stmt2->fetchAll(PDO::FETCH_ASSOC);
            $result=$result+$row2;
            
		}
        return $result;
  	}
	public function fetchBooking($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from booking where id=:id order by id desc";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;

	}
    
	public function changeBookingStatus($b_id, $status) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update booking set status=:status where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':status', $status, PDO::PARAM_STR);
		$stmt->bindparam(':id', $b_id, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function changeBookingsStatus($status, $bookings) {

		foreach ($bookings as $bk) {

			$db = new dbconnect();
			$con = $db->Connect();
			$query = "update booking set status=:status where id=:id";
			$stmt = $con->prepare($query);
			$stmt->bindparam(':status', $status, PDO::PARAM_STR);
			$stmt->bindparam(':id', $bk, PDO::PARAM_STR);
			$count = $stmt->execute();

		}
		if ($count > 0) {
			return true;
		} else {
			return false;
		}

	}

	public function deletebooking($id) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "delete from booking where id in($id)";
		$stmt = $con->prepare($query);
		$result = $stmt->execute();
		return $result;
	}

	public function confirmbooking($id) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from booking where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
		if (!empty($row)) {

			$db = new dbconnect();
			$con = $db->Connect();
			$query = "update booking set status=1 where id=:id";
			$stmt = $con->prepare($query);
			$stmt->bindparam(':id', $id, PDO::PARAM_STR);
			$count = $stmt->execute();


			$db = new dbconnect();
			$con = $db->Connect();
			$query = "insert into transaction set user=:user,bid=:bid,amount=:amount,date=NOW(),processor='Manual',status=1";
			$stmt = $con->prepare($query);
			$stmt->bindparam(':user', $row['user_id'], PDO::PARAM_STR);
			$stmt->bindparam(':bid', $id, PDO::PARAM_STR);
			$stmt->bindparam(':amount', $row['total'], PDO::PARAM_STR);
			$count = $stmt->execute();
			if ($count > 0) {
				return true;
			} else {
				return false;
			}
		}
		else
		{
			return false;
		}

		
	}


	public function invoice_statusbooking($status) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from booking where status=:status order by id desc";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':status', $status, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
	public function invoice_userbooking($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from booking where user_id=:id order by id desc order by id desc";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}

	public function upcomming_booking($id) {
        $now=date("Y-m-d h:i:s");
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from booking where user_id=:id AND pick_date>='$now' AND status!=3 AND status!=4 AND status!=5 order by id desc";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
    	public function past_booking($id) {
        $now=date("Y-m-d h:i:s");
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from booking where user_id=:id AND pick_date<='$now' AND status!=3 AND status!=4 order by id desc";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
     	public function reserved_booking($id) {
        $now=date("Y-m-d h:i:s");
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from booking where user_id=:id AND pick_date>='$now' AND status=5 order by id desc";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
    	public function filter_booking($id, $status) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from booking where user_id=:id AND status=:status order by id desc";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->bindparam(':status', $status, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}

	public function Cancel_Booking($id) {
		foreach ($id as $i) {

			$db = new dbconnect();
			$con = $db->Connect();
			$query = "update booking set status=3 where id=:id ";
			$stmt = $con->prepare($query);
			$stmt->bindparam(':id', $i, PDO::PARAM_STR);
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