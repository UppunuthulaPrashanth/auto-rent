<?php

class options {

	// for single instance
	protected static $instance = null;

	// Getting single instance
	public static function getInstance() {
		if (!isset(static::$instance)) {
			static::$instance = new static;
		}
		return static::$instance;
	}

	public function getOptions() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from extra_options where id=1";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}

	public function checksubscriber($email) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from newsletter where email=:email";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();
		$number_of_rows = $stmt->fetchColumn();
		if ($number_of_rows) {
			return true;
		} else {
			return false;
		}

	}
    
    function dateDiff($time1, $time2, $precision = 6) {
    // If not numeric then convert texts to unix timestamps
    if (!is_int($time1)) {
      $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
      $time2 = strtotime($time2);
    }

    // If time1 is bigger than time2
    // Then swap time1 and time2
    if ($time1 > $time2) {
      $ttime = $time1;
      $time1 = $time2;
      $time2 = $ttime;
    }

    // Set up intervals and diffs arrays
    $intervals = array('year','month','day','hour','minute','second');
    $diffs = array();

    // Loop thru all intervals
    foreach ($intervals as $interval) {
      // Create temp time from time1 and interval
      $ttime = strtotime('+1 ' . $interval, $time1);
      // Set initial values
      $add = 1;
      $looped = 0;
      // Loop until temp time is smaller than time2
      while ($time2 >= $ttime) {
        // Create new temp time from time1 and interval
        $add++;
        $ttime = strtotime("+" . $add . " " . $interval, $time1);
        $looped++;
      }
 
      $time1 = strtotime("+" . $looped . " " . $interval, $time1);
      $diffs[$interval] = $looped;
    }
    
    $count = 0;
    $times = array();
    // Loop thru all diffs
    foreach ($diffs as $interval => $value) {
      // Break if we have needed precission
      if ($count >= $precision) {
	break;
      }
      // Add value and interval 
      // if value is bigger than 0
      //if ($value > 0) {
	// Add s if value is not 1
	if ($value != 1) {
	  $interval .= "s";
	}
	// Add value and interval to times array
	$times[] = $value . " " . $interval;
	$count++;
      //}
    }
    // Return string with times
    //return implode(", ", $times);
    return $times;
  }


    function getAge($then) {
        $then_ts = strtotime($then);
        $then_year = date('Y', $then_ts);
        $age = date('Y') - $then_year;
        if(strtotime('+' . $age . ' years', $then_ts) > time()) $age--;
        return $age;
    }

	public function subscribe($name, $email) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "insert into newsletter set name=:name,email=:email";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':name', $name, PDO::PARAM_STR);
		$stmt->bindparam(':email', $email, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function testimonial($name,$company, $content) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "insert into testimonial set name=:name,company=:company,content=:content";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':name', $name, PDO::PARAM_STR);
        $stmt->bindparam(':company', $company, PDO::PARAM_STR);
		$stmt->bindparam(':content', $content, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function gettestimonial() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from testimonial";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
    
      	public function get_deal($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from deal where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;

	}
     	public function get_dealvehicles($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from deal_vehicles where did=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;

	}
    
	public function getactivetestimonial() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from testimonial where status=1";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
    
    public function get_index_testimonial() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from testimonial where status=1 AND LENGTH(content) >= 200 ORDER BY id DESC";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
    
      public function get_testimonial($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from testimonial where id=:id";
		$stmt = $con->prepare($query);
        $stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
    
    public function getaboutuscontent() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from aboutus where id=1";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
    
    public function get_team() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from team";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
    
    public function add_member($name,$designation,$description,$ar_name,$ar_designation,$ar_description) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "insert into team set name=:name,ar_name=:ar_name,designation=:designation,ar_designation=:ar_designation,description=:description,ar_description=:ar_description";

		$stmt = $con->prepare($query);
        $stmt->bindparam(':name', $name, PDO::PARAM_STR);
		$stmt->bindparam(':designation', $designation, PDO::PARAM_STR);
        $stmt->bindparam(':description', $description, PDO::PARAM_STR);
        
        $stmt->bindparam(':ar_name', $ar_name, PDO::PARAM_STR);
		$stmt->bindparam(':ar_designation', $ar_designation, PDO::PARAM_STR);
        $stmt->bindparam(':ar_description', $ar_description, PDO::PARAM_STR);
		$stmt->execute();
		return true;
	}
    
    	public function delete_members($del) {
		foreach ($del as $d) {
			$db = new dbconnect();
			$con = $db->Connect();
			$query = "delete from team where id=:id";
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
    
    public function fetch_member($id) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from team where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
    
    public function updatemember($name,$designation,$desc,$ar_name,$ar_designation,$ar_desc,$id){

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update team set name=:name,designation=:designation,description=:description,ar_name=:ar_name,ar_designation=:ar_designation,ar_description=:ar_description where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':name', $name, PDO::PARAM_STR);
		$stmt->bindparam(':designation', $designation, PDO::PARAM_STR);
        $stmt->bindparam(':description', $desc, PDO::PARAM_STR);
        
        $stmt->bindparam(':ar_name', $ar_name, PDO::PARAM_STR);
		$stmt->bindparam(':ar_designation', $ar_designation, PDO::PARAM_STR);
        $stmt->bindparam(':ar_description', $ar_desc, PDO::PARAM_STR);
        
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}

	}
    
    
    public function update_about_us($vision,$ar_vision, $img_url1,$values,$ar_values,$img_url2,$mission,$ar_mission,$img_url3,$years,$bookings,$fleet,$customers){
        
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update aboutus set vision=:vision,ar_vision=:ar_vision,vision_img=:vision_img,val=:values,ar_val=:ar_values,values_img=:values_img,mission=:mission,ar_mission=:ar_mission,mission_img=:mission_img,years=:years,bookings=:bookings,fleet=:fleet,customers=:customers where id=1";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':vision', $vision, PDO::PARAM_STR);
        $stmt->bindparam(':ar_vision', $ar_vision, PDO::PARAM_STR);
		$stmt->bindparam(':vision_img', $img_url1, PDO::PARAM_STR);
        $stmt->bindparam(':values', $values, PDO::PARAM_STR);
        $stmt->bindparam(':ar_values', $ar_values, PDO::PARAM_STR);
		$stmt->bindparam(':values_img', $img_url2, PDO::PARAM_STR);
        $stmt->bindparam(':mission', $mission, PDO::PARAM_STR);
        $stmt->bindparam(':ar_mission', $ar_mission, PDO::PARAM_STR);
		$stmt->bindparam(':mission_img', $img_url3, PDO::PARAM_STR);
        $stmt->bindparam(':years', $years, PDO::PARAM_STR);
		$stmt->bindparam(':bookings', $bookings, PDO::PARAM_STR);
        $stmt->bindparam(':fleet', $fleet, PDO::PARAM_STR);
		$stmt->bindparam(':customers', $customers, PDO::PARAM_STR);
        
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}

	}
    
	public function changeTestimonialStatus($id, $status) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update testimonial set status=$status where id in($id)";
		$stmt = $con->prepare($query);
		$stmt->execute();
		return true;

	}
    
    
    public function checkhomecontentbyid($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from hometext where id=:id";
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
    
        public function gethomecontentbyid($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from hometext where id=:id";
		$stmt = $con->prepare($query);
        $stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
    
    public function getsitemapurlbyid($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from sitemap where id=:id";
		$stmt = $con->prepare($query);
        $stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
    
            public function getcountrycontent($id,$language) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from hometext where country=:id and language=:language";
		$stmt = $con->prepare($query);
        $stmt->bindparam(':id', $id, PDO::PARAM_STR);
        $stmt->bindparam(':language', $language, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
    
    public function checkhomecontent($country,$language) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from hometext where country=:country and language=:language";
		$stmt = $con->prepare($query);
        $stmt->bindparam(':country', $country, PDO::PARAM_STR);
		$stmt->bindparam(':language', $language, PDO::PARAM_STR);
		$stmt->execute();
		$number_of_rows = $stmt->fetchColumn();
 
		if ($number_of_rows) {
			return true;
		} else {
			return false;
		}
	}
    
    
    
    
    public function gethomecontent() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from hometext";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
    
    public function sitemap_urls() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from sitemap";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $rows;
	}
    
    public function get_sitemap_url($slug) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from sitemap where slug=:slug";
		$stmt = $con->prepare($query);
        $stmt->bindparam(':slug', $slug, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
    
    public function filtered_sitemap_urls($cid,$lang) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from sitemap where country=:country and language=:language";
		$stmt = $con->prepare($query);
        $stmt->bindparam(':country', $cid, PDO::PARAM_STR);
		$stmt->bindparam(':language', $lang, PDO::PARAM_STR);
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $rows;
	}
    
   	public function add_sitemap_url($page_title,$meta_title,$meta_keywords,$meta_description,$slug,$content,$cid,$lang) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "insert into sitemap set page_title=:page_title,meta_title=:meta_title,meta_keywords=:meta_keywords,meta_description=:meta_description,content=:content,slug=:slug,country=:country,language=:language";
		$stmt = $con->prepare($query);
        $stmt->bindparam(':page_title', $page_title, PDO::PARAM_STR);
		$stmt->bindparam(':meta_title', $meta_title, PDO::PARAM_STR);
        $stmt->bindparam(':meta_keywords', $meta_keywords, PDO::PARAM_STR);
        $stmt->bindparam(':meta_description', $meta_description, PDO::PARAM_STR);
        $stmt->bindparam(':content', $content, PDO::PARAM_STR);        
        $stmt->bindparam(':slug', $slug, PDO::PARAM_STR);
        $stmt->bindparam(':country', $cid, PDO::PARAM_STR);
        $stmt->bindparam(':language', $lang, PDO::PARAM_STR);
        
		$stmt->execute();
		return true;

	}
    
   	public function update_sitemap_url($page_title,$meta_title,$meta_keywords,$meta_description,$content,$id) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update sitemap set page_title=:page_title,meta_title=:meta_title,meta_keywords=:meta_keywords,meta_description=:meta_description,content=:content where id=:id";

		$stmt = $con->prepare($query);
        
        $stmt->bindparam(':id', $id, PDO::PARAM_STR);
        $stmt->bindparam(':page_title', $page_title, PDO::PARAM_STR);
		$stmt->bindparam(':meta_title', $meta_title, PDO::PARAM_STR);
        $stmt->bindparam(':meta_keywords', $meta_keywords, PDO::PARAM_STR);
        $stmt->bindparam(':meta_description', $meta_description, PDO::PARAM_STR);
        $stmt->bindparam(':content', $content, PDO::PARAM_STR);        
  
		$check=$stmt->execute();
		return true;

	}
    
    
   	public function addhomecontent($heading,$sub_heading,$country,$language,$img_url,$page_title,$meta_title,$meta_keywords,$meta_description) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "insert into hometext set heading=:heading,sub_heading=:sub_heading,country=:country,language=:language,img_url=:img_url,page_title=:page_title,meta_title=:meta_title,meta_keywords=:meta_keywords,meta_description=:meta_description";
		$stmt = $con->prepare($query);
        $stmt->bindparam(':heading', $heading, PDO::PARAM_STR);
		$stmt->bindparam(':sub_heading', $sub_heading, PDO::PARAM_STR);
        $stmt->bindparam(':country', $country, PDO::PARAM_STR);
        $stmt->bindparam(':language', $language, PDO::PARAM_STR);
        $stmt->bindparam(':img_url', $img_url, PDO::PARAM_STR);
        
        $stmt->bindparam(':page_title', $page_title, PDO::PARAM_STR);
        $stmt->bindparam(':meta_title', $meta_title, PDO::PARAM_STR);
        $stmt->bindparam(':meta_keywords', $meta_keywords, PDO::PARAM_STR);
        $stmt->bindparam(':meta_description', $meta_description, PDO::PARAM_STR);
        
		$stmt->execute();
		return true;

	}
    
    
    
   	public function updatehomecontent($id,$heading, $sub_heading,$img_url,$page_title,$meta_title,$meta_keywords,$meta_description) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update hometext set heading=:heading,sub_heading=:sub_heading,img_url=:img_url,page_title=:page_title,meta_title=:meta_title,meta_keywords=:meta_keywords,meta_description=:meta_description where id=:id";

		$stmt = $con->prepare($query);
        $stmt->bindparam(':heading', $heading, PDO::PARAM_STR);
		$stmt->bindparam(':sub_heading', $sub_heading, PDO::PARAM_STR);
        $stmt->bindparam(':img_url', $img_url, PDO::PARAM_STR);
        $stmt->bindparam(':id', $id, PDO::PARAM_STR);
        
        $stmt->bindparam(':page_title', $page_title, PDO::PARAM_STR);
        $stmt->bindparam(':meta_title', $meta_title, PDO::PARAM_STR);
        $stmt->bindparam(':meta_keywords', $meta_keywords, PDO::PARAM_STR);
        $stmt->bindparam(':meta_description', $meta_description, PDO::PARAM_STR);
        
        
		$stmt->execute();
		return true;

	}
    
    
     public function getcontentImage($id)
    {

        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select img_url from hometext where id=:id";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    
    
    
       public function deletecontent($del_content)
    {
        foreach ($del_content as $content) {
            $img_result = $this->getcontentImage($content);
            $img=$img_result['img_url'];
            
            if (file_exists(PATH . BASE_URL . "images/homepage/" . $img)) {
               
                unlink(PATH . BASE_URL . "images/homepage/" . $img);
            }
                  
            $db    = new dbconnect();
            $con   = $db->Connect();
            $query = "delete from hometext where id=:id";
            $stmt  = $con->prepare($query);
            $stmt->bindparam(':id', $content, PDO::PARAM_STR);
            $count = $stmt->execute();
            
        }
        
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    
     public function get_slug($id)
    {

        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select slug from sitemap where id=:id";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    
    
    public function delete_map_url($del_content)
    {
        foreach ($del_content as $content) {
            $slug = $this->get_slug($content);
            $slug=$slug['slug'];
            
            if (file_exists(PATH . BASE_URL. $slug.".php")) {
                unlink(PATH . BASE_URL  . $slug.".php");
            }
            if (file_exists(PATH . BASE_URL.'arabic/'. $slug.".php")) {
                unlink(PATH . BASE_URL .'arabic/' . $slug.".php");
            }
                  
            $db    = new dbconnect();
            $con   = $db->Connect();
            $query = "delete from sitemap where id=:id";
            $stmt  = $con->prepare($query);
            $stmt->bindparam(':id', $content, PDO::PARAM_STR);
            $count = $stmt->execute();
            
        }
        
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

	public function insert_page($title,$ar_title,$page_title,$page_ar_title,$slug,$category,$parent,$status,$meta_keyword,$meta_des,$indexing,$content, $ar_content,$created_date) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "insert into custompage set title=:title,ar_title=:ar_title,page_title=:page_title,page_ar_title=:page_ar_title,slug=:slug,category=:category,parent=:parent,status=:status,meta_keyword=:meta_keyword,meta_des=:meta_des,indexing=:indexing,content=:content,ar_content=:ar_content,create_date=:create_date";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':title', $title, PDO::PARAM_STR);
		$stmt->bindparam(':ar_title', $ar_title, PDO::PARAM_STR);
        $stmt->bindparam(':page_title', $page_title, PDO::PARAM_STR);
        $stmt->bindparam(':page_ar_title', $page_ar_title, PDO::PARAM_STR);
        $stmt->bindparam(':slug', $slug, PDO::PARAM_STR);
        $stmt->bindparam(':category', $category, PDO::PARAM_STR);
        $stmt->bindparam(':parent', $parent, PDO::PARAM_STR);
        $stmt->bindparam(':status', $status, PDO::PARAM_STR);
        $stmt->bindparam(':meta_keyword', $meta_keyword, PDO::PARAM_STR);
        $stmt->bindparam(':meta_des', $meta_des, PDO::PARAM_STR);
        $stmt->bindparam(':indexing', $indexing, PDO::PARAM_STR);
        $stmt->bindparam(':content', $content, PDO::PARAM_STR);
        $stmt->bindparam(':ar_content', $ar_content, PDO::PARAM_STR);
        $stmt->bindparam(':create_date', $created_date, PDO::PARAM_STR);
        
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}
    
    	public function changepagestatus($id,$status) {
		$db = new dbconnect();
		$con = $db->Connect();

		$query = "update custompage set status=:status where id=:id";
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

	public function insert_acheivements($name, $content) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "insert into acheivements set title=:title,content=:content";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':title', $name, PDO::PARAM_STR);
		$stmt->bindparam(':content', $content, PDO::PARAM_STR);
		$count = $stmt->execute();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function getcustompage() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from custompage";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
    	public function getnews() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from custompage where category='latest news' order by id desc";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
    
   	public function get_latest_news() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from custompage where category='latest news' order by id desc limit 3";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
    
    public function checkpage($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from custompage where id=:id";
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
       public function checknews($slug) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from custompage where slug=:slug";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':slug', $slug, PDO::PARAM_STR);
		$stmt->execute();
		$number_of_rows = $stmt->fetchColumn();
		if ($number_of_rows) {
			return true;
		} else {
			return false;
		}
	}
    
    public function get_services() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from custompage where category='product & Services' and parent=0";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
    public function get_other_pages() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from custompage where category='Others' and parent=0";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
    public function get_partners_pages() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from custompage where category='Partners' and parent=0";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
     public function get_terms_pages() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from custompage where category='terms' and parent=0";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
    
    public function get_other_child_pages($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from custompage where category='Others' and parent=:id";
		$stmt = $con->prepare($query);
        $stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
    public function get_partners_child_pages($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from custompage where category='Partners' and parent=:id";
		$stmt = $con->prepare($query);
        $stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
    public function get_terms_child_pages($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from custompage where category='terms' and parent=:id";
		$stmt = $con->prepare($query);
        $stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
    
    public function get_custom_page($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from custompage where id=:id";
		$stmt = $con->prepare($query);
        $stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
    public function get_page($slug) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from custompage where slug=:slug";
		$stmt = $con->prepare($query);
        $stmt->bindparam(':slug', $slug, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
    
        public function get_news($slug) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from custompage where slug=:slug";
		$stmt = $con->prepare($query);
        $stmt->bindparam(':slug', $slug, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
    
    public function get_products($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from custompage where category='product & Services' and parent=:id";
		$stmt = $con->prepare($query);
        $stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
    	public function getpageparent($id) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select title from custompage where id=:id";
		$stmt = $con->prepare($query);
        $stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['title'];
	}
	public function getpagecontent($pno) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from custompage where id=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $pno, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
    
    	public function updatepage($id,$title,$ar_title,$page_title,$page_ar_title,$parent,$status,$meta_keyword,$meta_des,$indexing,$content, $ar_content,$create_date) {
		$db = new dbconnect();
		$con = $db->Connect();
		$query = "update custompage set title=:title,ar_title=:ar_title,page_title=:page_title,page_ar_title=:page_ar_title,parent=:parent,status=:status,meta_keyword=:meta_keyword,meta_des=:meta_des,indexing=:indexing,content=:content,ar_content=:ar_content,create_date=:create_date where id=:id";

		$stmt = $con->prepare($query);
        
        $stmt->bindparam(':id', $id, PDO::PARAM_STR);
        $stmt->bindparam(':title', $title, PDO::PARAM_STR);
		$stmt->bindparam(':ar_title', $ar_title, PDO::PARAM_STR);
        $stmt->bindparam(':page_title', $page_title, PDO::PARAM_STR);
        $stmt->bindparam(':page_ar_title', $page_ar_title, PDO::PARAM_STR);
        $stmt->bindparam(':parent', $parent, PDO::PARAM_STR);
        $stmt->bindparam(':status', $status, PDO::PARAM_STR);
        $stmt->bindparam(':meta_keyword', $meta_keyword, PDO::PARAM_STR);
        $stmt->bindparam(':meta_des', $meta_des, PDO::PARAM_STR);
        $stmt->bindparam(':indexing', $indexing, PDO::PARAM_STR);
        $stmt->bindparam(':content', $content, PDO::PARAM_STR);
        $stmt->bindparam(':ar_content', $ar_content, PDO::PARAM_STR);
        $stmt->bindparam(':create_date', $create_date, PDO::PARAM_STR);
  
		$check=$stmt->execute();
		return true;

	}

	public function totalacheivements() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from acheivements";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$number_of_rows = $stmt->fetchColumn();
		if ($number_of_rows) {
			return $number_of_rows;
		} else {
			return false;
		}

	}
	public function getallacheivements() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from acheivements";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}

	public function getacheivements($totalachev) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from acheivements LIMIT {$totalachev}";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}

	public function deleteacheivements($del) {
		foreach ($del as $d) {
		  
            
            
            

			$db = new dbconnect();
			$con = $db->Connect();
			$query = "delete from acheivements where id=:id";
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
	public function deletepage($del) {
		foreach ($del as $d) {
		  
          
            $db = new dbconnect();
    		$con = $db->Connect();
    		$query = "select * from custompage where id=:id";
    		$stmt = $con->prepare($query);
    		$stmt->bindparam(':id', $d, PDO::PARAM_STR);
    		$stmt->execute();
    		$row = $stmt->fetch(PDO::FETCH_ASSOC);
    		
             if (file_exists(PATH . BASE_URL . $row['slug'].'.php')) {
        		unlink(PATH . BASE_URL . $row['slug'].'.php');
        	}
            if (file_exists(PATH . BASE_URL .'arabic/'. $row['slug'].'.php')) {
        		unlink(PATH . BASE_URL .'arabic/'. $row['slug'].'.php');
        	}
            
            
			$db = new dbconnect();
			$con = $db->Connect();
			$query = "delete from custompage where id=:id";
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

	public function getpartnerOptions($pid) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from extra_options where pid=:id";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':id', $pid, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	public function setpartnerOptions($opt, $pid, $price) {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select count(*) from extra_options where pid=:pid";
		$stmt = $con->prepare($query);
		$stmt->bindparam(':pid', $pid, PDO::PARAM_STR);
		$stmt->execute();
		$check = $stmt->fetchColumn();

		if ($opt == 1) {
			$option = "driver";
		} elseif ($opt == 2) {
			$option = "gps";
		} elseif ($opt == 3) {
			$option = "baby_seat";
		} elseif ($opt == 4) {
			$option = "cdw";
		} elseif ($opt == 5) {
			$option = "pai";
		}

		if ($check > 0) {

			$db = new dbconnect();
			$con = $db->Connect();
			$query = "update extra_options set $option=:option where pid=:id";
			$stmt = $con->prepare($query);
			$stmt->bindparam(':option', $price, PDO::PARAM_STR);
			$stmt->bindparam(':id', $pid, PDO::PARAM_STR);
			$count = $stmt->execute();
			if ($count > 0) {
				return true;

			} else {
				return false;
			}

		} else {

			$db = new dbconnect();
			$con = $db->Connect();
			$query = "insert into extra_options set option=:option,pid=:pid";
			$stmt = $con->prepare($query);
			$stmt->bindparam(':option', $price, PDO::PARAM_STR);
			$stmt->bindparam(':pid', $pid, PDO::PARAM_STR);
			$count = $stmt->execute();
			if ($count > 0) {
				return true;
			} else {
				return false;
			}
		}

		return $check2;
	}
    
         public function get_header_linking() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from custompage where indexing=1";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
    public function get_footer_linking() {

		$db = new dbconnect();
		$con = $db->Connect();
		$query = "select * from custompage where indexing=2";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
}