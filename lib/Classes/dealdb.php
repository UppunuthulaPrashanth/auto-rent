<?php
error_reporting(E_ALL);
class dealdb {

	// for single instance
	protected static $instance = null;

	// Getting single instance
	public static function getInstance() {
		if (!isset(static::$instance)) {
			static::$instance = new static;
		}
		return static::$instance;
	}
	public function adddeal($name,$ar_name,$des,$ar_des,$coupon,$from,$to,$fp,$dp,$manual,$indexing,$promotion,$search_page,$featured_img,$deal_img) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "insert into deal set name=:name,ar_name=:ar_name,des=:des,ar_des=:ar_des,coupon=:coupon,deal_from=:from,deal_to=:to,fixed_price=:fp,discount_price=:dp,manual=:manual,indexing=:indexing,promotion=:promotion,search_page=:search_page,featured_img=:featured_img,deal_img=:deal_img";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':name', $name, PDO::PARAM_STR);
        $stmt->bindparam(':ar_name', $ar_name, PDO::PARAM_STR);
        $stmt->bindparam(':des', $des, PDO::PARAM_STR);
        $stmt->bindparam(':ar_des', $ar_des, PDO::PARAM_STR);
        $stmt->bindparam(':coupon', $coupon, PDO::PARAM_STR);
        $stmt->bindparam(':from', $from, PDO::PARAM_STR);
        $stmt->bindparam(':to', $to, PDO::PARAM_STR);
        $stmt->bindparam(':fp', $fp, PDO::PARAM_STR);
        $stmt->bindparam(':dp', $dp, PDO::PARAM_STR);
        $stmt->bindparam(':manual', $manual, PDO::PARAM_STR);
        $stmt->bindparam(':featured_img', $featured_img, PDO::PARAM_STR);
        $stmt->bindparam(':deal_img', $deal_img, PDO::PARAM_STR);
        $stmt->bindparam(':indexing', $indexing, PDO::PARAM_STR);
        $stmt->bindparam(':search_page', $search_page, PDO::PARAM_STR);
        $stmt->bindparam(':promotion', $promotion, PDO::PARAM_STR);
		$count = $stmt->execute(); 
		$id = $con->lastInsertId();
		return $id;
	}
	public function fetchdeals() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from deal";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
    
    public function country_deals($cid)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from deal where NOW()>=deal_from && NOW()<=deal_to";
        $stmt  = $con->prepare($query);
        $stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $id=array();
		foreach($row as $r)
        {
            $id[]=$r['id'];
        }

        $ids = implode(',', $id);
        
            $query = "select DISTINCT(did) from deal_vehicles where did in($ids) and cid=:cid";
            $stmt  = $con->prepare($query);
            $stmt->bindparam(':cid', $cid, PDO::PARAM_STR);
            $stmt->execute();
            
            $row2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return($row2);
    }
    
    
    public function country_index_deals($cid)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from deal where NOW()>=deal_from && NOW()<=deal_to and indexing=1";
        $stmt  = $con->prepare($query);
        $stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $id=array();
		foreach($row as $r)
        {
            $id[]=$r['id'];
        }

        
        $ids = implode(',', $id);

            $query = "select DISTINCT(did) from deal_vehicles where did in($ids) and cid=:cid";
            $stmt  = $con->prepare($query);
            $stmt->bindparam(':cid', $cid, PDO::PARAM_STR);
            $stmt->execute();
            
            $row2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return($row2);
    }
    
   	public function check_deal($id,$cid) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from deal_vehicles where did=:id and cid=:cid";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
        $stmt->bindparam(':cid', $cid, PDO::PARAM_STR);
		$stmt->execute();
		$number_of_rows = $stmt->fetchColumn();

		if ($number_of_rows) {
			return true;
		} else {
			return false;
		}

	}
    
    
    public function fetch_country_promotion($cid) {

		 $db    = new dbconnect();
        $con   = $db->Connect();
         $query = "select DISTINCT(did) from deal_vehicles where cid=:cid";
         $stmt  = $con->prepare($query);
         $stmt->bindparam(':cid', $cid, PDO::PARAM_STR);
         $stmt->execute();
         $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
         
         
         $id=array();
		foreach($row as $r)
        {
            $id[]=$r['did'];
        }

        $ids = implode(',', $id);
        
        
		$query = "select * from deal where id in($ids) and NOW()>=deal_from and NOW()<=deal_to";
        $stmt  = $con->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
    
    //public function getdeals($limit,$cid,$ids)
    public function getdeals($cid,$ids)
    {
        $db    = new dbconnect();
        $con   = $db->Connect();
        //$query = "select * from deal where id in($ids)  order by id desc LIMIT $limit ";
        $query = "select * from deal where id in($ids)  order by id desc";
        $stmt  = $con->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    
       public function deal_country($id)
    {
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select DISTINCT(cid) from deal_vehicles where did=:id";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetchColumn();
		return $row;
       
    }
    
    public function deals_vehicle_check($id)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select count(*) from deal_vehicles where did=:id";
        $stmt  = $con->prepare($query);
        
        $stmt->bindparam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $number_of_rows = $stmt->fetchColumn();
        if ($number_of_rows) {
            return $number_of_rows;
        } else {
            return false;
        }
    }
    
       public function get_deal_vehicle($did)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from deal_vehicles where did=:did";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':did', $did, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);    
        
        $query2 = "select * from vehicle where id=:id";
        $stmt2  = $con->prepare($query2);
        $stmt2->bindparam(':id', $row['vid'], PDO::PARAM_STR);
        $stmt2->execute();
        $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        return $row2;
        
    }
    

    
/**
 *     public function fetch_active_deals() {

 * 		$db = new dbconnect();
 * 		$con = $db->Connect();
 * 		$query = "select * from deal where NOW()>=deal_from && NOW()<=deal_to";
 * 		$stmt = $con->prepare($query);
 * 		$stmt->execute();
 * 		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
 * 		return $row;
 * 	}
 */
 
    
    public function deal_vehicles($did) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from deal_vehicles where did=:id";
		$stmt = $con->prepare($query);
        $stmt->bindparam(':id', $did, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}


   	public function updatedeal($id,$name,$ar_name,$des,$ar_des,$coupon,$from,$to,$fp,$dp,$manual,$indexing,$promotion,$search_page,$featured_img,$deal_img) {
   	    
        
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update deal set name=:name,ar_name=:ar_name,des=:des,ar_des=:ar_des,coupon=:coupon,deal_from=:from,deal_to=:to,fixed_price=:fp,discount_price=:dp,manual=:manual,indexing=:indexing,promotion=:promotion,search_page=:search_page,featured_img=:featured_img,deal_img=:deal_img where id=:id";

		$stmt = $con->prepare($query);
        $stmt->bindparam(':name', $name, PDO::PARAM_STR);
        $stmt->bindparam(':ar_name', $ar_name, PDO::PARAM_STR);
        $stmt->bindparam(':des', $des, PDO::PARAM_STR);
        $stmt->bindparam(':ar_des', $ar_des, PDO::PARAM_STR);
        $stmt->bindparam(':coupon', $coupon, PDO::PARAM_STR);
        $stmt->bindparam(':from', $from, PDO::PARAM_STR);
        $stmt->bindparam(':to', $to, PDO::PARAM_STR);
        $stmt->bindparam(':fp', $fp, PDO::PARAM_STR);
        $stmt->bindparam(':dp', $dp, PDO::PARAM_STR);
        $stmt->bindparam(':manual', $manual, PDO::PARAM_STR);
        $stmt->bindparam(':featured_img', $featured_img, PDO::PARAM_STR);
        $stmt->bindparam(':deal_img', $deal_img, PDO::PARAM_STR);
        $stmt->bindparam(':indexing', $indexing, PDO::PARAM_STR);
        $stmt->bindparam(':promotion', $promotion, PDO::PARAM_STR);
        $stmt->bindparam(':search_page', $search_page, PDO::PARAM_STR);
        $stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$result=$stmt->execute();

		return true;

	}
    
    
	public function setdealvehicles($did, $vid, $cid) {

			$db = new dbconnect();
			$con = $db->Connect();
			$query = "insert into deal_vehicles set did=:did,vid=:vid,cid=:cid";
			$stmt = $con->prepare($query);
			$stmt->bindparam(':did', $did, PDO::PARAM_STR);
			$stmt->bindparam(':vid', $vid, PDO::PARAM_STR);
			$stmt->bindparam(':cid', $cid, PDO::PARAM_STR);
			$count = $stmt->execute();
			if ($count > 0) {
				return true;
			} else {
				return false;
			}

	}
    
        public function getdealImage($id)
    {

        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select deal_img from deal where id=:id";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['deal_img'];
    }

	public function deletedeals($del) {
	   $db = new dbconnect();
	   $con = $db->Connect();
		foreach ($del as $d) {
			
            
            $img = $this->getdealImage($d);
            
            if (file_exists(PATH . BASE_URL . "images/admin_images/deals/" . $img)) {
                unlink(PATH . BASE_URL . "images/admin_images/deals/" . $img);
            }
            
            
			$query = "delete from deal where id=:id";
			$stmt = $con->prepare($query);
			$stmt->bindparam(':id', $d, PDO::PARAM_STR);
			$count = $stmt->execute();
            
            $query2 = "delete from deal_vehicles where did=:id";
			$stmt2 = $con->prepare($query2);
			$stmt2->bindparam(':id', $d, PDO::PARAM_STR);
			$count = $stmt2->execute();
            
            $query3 = "delete from deal_fix_price where did=:id";
			$stmt3 = $con->prepare($query3);
			$stmt3->bindparam(':id', $d, PDO::PARAM_STR);
			$count = $stmt3->execute();

		}
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function dealExists($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from deal where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$number_of_rows = $stmt->fetchColumn();
		return $number_of_rows;

	}
	public function getdeal($did) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from deal where id=:did";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':did', $did, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);


		if ($row) {
			return $row;
		} else {
			return 0;
		}

	}
    public function getdealbycoupon($coupon,$pd,$dd) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from deal where coupon=:coupon and :pd>=deal_from and :dd<=deal_to";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':coupon', $coupon, PDO::PARAM_STR);
        $stmt->bindparam(':pd', $pd, PDO::PARAM_STR);
        $stmt->bindparam(':dd', $dd, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);


		if ($row) {
			return $row;
		} else {
			return 0;
		}

	}
    
    public function deal_promotion_by_coupon($coupon) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select promotion from deal where coupon=:coupon";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':coupon', $coupon, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($row) {
			return $row['promotion'];
		} else {
			return 0;
		}

	}
    
    	public function checkdealvehicle($did,$vid,$cid) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from deal_vehicles where did=:did and vid=:vid and cid=:cid";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':did', $did, PDO::PARAM_STR);
        $stmt->bindparam(':vid', $vid, PDO::PARAM_STR);
        $stmt->bindparam(':cid', $cid, PDO::PARAM_STR);
		$stmt->execute();
		$number_of_rows = $stmt->fetchColumn();
		return $number_of_rows;

	}
    
   	public function fetch_vehicles_deals($vid,$cid) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select did from deal_vehicles where vid=:vid and cid=:cid";
		$stmt = $con->prepare($query);
        $stmt->bindparam(':vid', $vid, PDO::PARAM_STR);
        $stmt->bindparam(':cid', $cid, PDO::PARAM_STR);
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $rows;

	}
    
   	public function deal_existance($did,$pd,$dd) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from deal where manual='' and id=:did and :pd>=deal_from and :dd<=deal_to";
		$stmt = $con->prepare($query);
        $stmt->bindparam(':did', $did, PDO::PARAM_STR);
        $stmt->bindparam(':pd', $pd, PDO::PARAM_STR);
        $stmt->bindparam(':dd', $dd, PDO::PARAM_STR);
		$stmt->execute();
		$number_of_rows = $stmt->fetchColumn();
		return $number_of_rows;

	}
    
   	public function check_deal_existance($did,$pd,$dd) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from deal where id=:did and :pd>=deal_from and :dd<=deal_to";
		$stmt = $con->prepare($query);
        $stmt->bindparam(':did', $did, PDO::PARAM_STR);
        $stmt->bindparam(':pd', $pd, PDO::PARAM_STR);
        $stmt->bindparam(':dd', $dd, PDO::PARAM_STR);
		$stmt->execute();
		$number_of_rows = $stmt->fetchColumn();
		return $number_of_rows;

	}
    
    public function fetch_fix_deal_price($did,$vid) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select price from deal_fix_price where did=:did and vid=:vid";
		$stmt = $con->prepare($query);
        $stmt->bindparam(':did', $did, PDO::PARAM_STR);
        $stmt->bindparam(':vid', $vid, PDO::PARAM_STR);
		$stmt->execute();        
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($row) {
			return $row['price'];
		} else {
			return 0;
		}

	}
    
    public function fetch_fix_deal_price_row($did,$vid) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from deal_fix_price where did=:did and vid=:vid";
		$stmt = $con->prepare($query);
        $stmt->bindparam(':did', $did, PDO::PARAM_STR);
        $stmt->bindparam(':vid', $vid, PDO::PARAM_STR);
		$stmt->execute();        
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($row) {
			return $row;
		} else {
			return 0;
		}

	}
    
    public function setdealvehiclesPrices($did, $vid, $price) {

			$db = new dbconnect();
			$con = $db->Connect();
			$query = "insert into deal_fix_price set did=:did,vid=:vid,price=:price";
			$stmt = $con->prepare($query);
			$stmt->bindparam(':did', $did, PDO::PARAM_STR);
			$stmt->bindparam(':vid', $vid, PDO::PARAM_STR);
			$stmt->bindparam(':price', $price, PDO::PARAM_STR);
			$count = $stmt->execute();
			if ($count > 0) {
				return true;
			} else {
				return false;
			}

	}
    
    public function update_fix_result_record($id,$price) {
   	    
        
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update deal_fix_price set price=:price where id=:id";

		$stmt = $con->prepare($query);
        $stmt->bindparam(':price', $price, PDO::PARAM_STR);
        $stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$result=$stmt->execute();

		return true;

	}
    
    public function fetch_lowest_Price($did) {
        $db = new dbconnect();
		$con = $db->Connect();
		$query = "select MIN(price) from deal_fix_price where did=:did";
		$stmt = $con->prepare($query);
        $stmt->bindparam(':did', $did, PDO::PARAM_STR);
		$stmt->execute();        
		$lowest = $stmt->fetchColumn();
		return $lowest;
	}

}
?>