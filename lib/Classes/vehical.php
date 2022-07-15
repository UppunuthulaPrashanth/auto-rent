<?php
error_reporting(E_ALL);
class vehical
{
    
    // for single instance
    protected static $instance = null;
    
    // Getting single instance
    public static function getInstance()
    {
        if (!isset(static::$instance)) {
            static::$instance = new static;
        }
        return static::$instance;
    }
    
    public function addVehicle($name, $make, $ar_name, $ar_make, $model, $engine, $passenger, $luggage, $door, $fuel_capacity, $airbags, $tranmision, $anti_brake, $cruise_control, $four_wheel_drive, $feature, $vt_id, $img_url, $terms, $ar_terms)
    {
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "insert into vehicle set name=:name,make=:make,ar_name=:ar_name,ar_make=:ar_make,model=:model,engine=:engine,img_url=:img_url,passenger=:passenger,luggage=:luggage,door=:door,fuel_capacity=:fuel_capacity,airbags=:airbags,tranmision=:tranmision,anti_brake=:anti_brake,cruise_control=:cruise_control,four_wheel_drive=:four_wheel_drive,feature=:feature,vt_id=:vt_id,terms_condition=:terms,ar_terms_condition=:ar_terms";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':name', $name, PDO::PARAM_STR);
        $stmt->bindparam(':make', $make, PDO::PARAM_STR);
        $stmt->bindparam(':ar_name', $ar_name, PDO::PARAM_STR);
        $stmt->bindparam(':ar_make', $ar_make, PDO::PARAM_STR);
        $stmt->bindparam(':model', $model, PDO::PARAM_STR);
        $stmt->bindparam(':engine', $engine, PDO::PARAM_STR);
        $stmt->bindparam(':img_url', $img_url, PDO::PARAM_STR);
        $stmt->bindparam(':passenger', $passenger, PDO::PARAM_STR);
        $stmt->bindparam(':luggage', $luggage, PDO::PARAM_STR);
        $stmt->bindparam(':door', $door, PDO::PARAM_STR);
        $stmt->bindparam(':fuel_capacity', $fuel_capacity, PDO::PARAM_STR);
        $stmt->bindparam(':airbags', $airbags, PDO::PARAM_STR);
        $stmt->bindparam(':tranmision', $tranmision, PDO::PARAM_STR);
        $stmt->bindparam(':anti_brake', $anti_brake, PDO::PARAM_STR);
        $stmt->bindparam(':cruise_control', $cruise_control, PDO::PARAM_STR);
        $stmt->bindparam(':four_wheel_drive', $four_wheel_drive, PDO::PARAM_STR);
        $stmt->bindparam(':feature', $feature, PDO::PARAM_STR);
        $stmt->bindparam(':vt_id', $vt_id, PDO::PARAM_STR);
        $stmt->bindparam(':terms', $terms, PDO::PARAM_STR);
        $stmt->bindparam(':ar_terms', $ar_terms, PDO::PARAM_STR);
        $result = $stmt->execute();
        
        $id = $con->lastInsertId();
        
        return $id;
    }
    
    
    public function checkvehicle($id)
    {
        
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select count(*) from vehicle where id=:id";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $number_of_rows = $stmt->fetchColumn();
        if ($number_of_rows) {
            return true;
        } else {
            return false;
        }
    }
    
    
    public function addVehicletariff($vid, $cid, $drent, $dcdw, $dpai, $dhc, $dcsc, $dgpsc, $ddc, $dic, $doic, $dekmc, $wrent, $wcdw, $wpai, $whc, $wcsc, $wgpsc, $wdc, $wic, $woic, $wekmc, $mrent, $mcdw, $mpai, $mhc, $mcsc, $mgpsc, $mdc, $mic, $moic, $mekmc)
    {
        
        $db  = new dbconnect();
        $con = $db->Connect();
        
        $query = "insert into vehicles_tariff set rent=:rent,cdw=:cdw,pai=:pai,hc=:hc,csc=:csc,gpsc=:gpsc,dc=:dc,ic=:ic,oic=:oic,ekmc=:ekmc,vid=:vid,cid=:cid,type=:type";
        
        $daily = 1;
        $stmt1 = $con->prepare($query);
        $stmt1->bindparam(':rent', $drent, PDO::PARAM_STR);
        $stmt1->bindparam(':cdw', $dcdw, PDO::PARAM_STR);
        $stmt1->bindparam(':pai', $dpai, PDO::PARAM_STR);
        $stmt1->bindparam(':hc', $dhc, PDO::PARAM_STR);
        $stmt1->bindparam(':csc', $dcsc, PDO::PARAM_STR);
        $stmt1->bindparam(':gpsc', $dgpsc, PDO::PARAM_STR);
        $stmt1->bindparam(':dc', $ddc, PDO::PARAM_STR);
        $stmt1->bindparam(':ic', $dic, PDO::PARAM_STR);
        $stmt1->bindparam(':oic', $doic, PDO::PARAM_STR);
        $stmt1->bindparam(':ekmc', $dekmc, PDO::PARAM_STR);
        $stmt1->bindparam(':vid', $vid, PDO::PARAM_STR);
        $stmt1->bindparam(':cid', $cid, PDO::PARAM_STR);
        $stmt1->bindparam(':type', $daily, PDO::PARAM_STR);
        
        $weekly = 2;
        $stmt2  = $con->prepare($query);
        $stmt2->bindparam(':rent', $wrent, PDO::PARAM_STR);
        $stmt2->bindparam(':cdw', $wcdw, PDO::PARAM_STR);
        $stmt2->bindparam(':pai', $wpai, PDO::PARAM_STR);
        $stmt2->bindparam(':hc', $whc, PDO::PARAM_STR);
        $stmt2->bindparam(':csc', $wcsc, PDO::PARAM_STR);
        $stmt2->bindparam(':gpsc', $wgpsc, PDO::PARAM_STR);
        $stmt2->bindparam(':dc', $wdc, PDO::PARAM_STR);
        $stmt2->bindparam(':ic', $wic, PDO::PARAM_STR);
        $stmt2->bindparam(':oic', $woic, PDO::PARAM_STR);
        $stmt2->bindparam(':ekmc', $wekmc, PDO::PARAM_STR);
        $stmt2->bindparam(':vid', $vid, PDO::PARAM_STR);
        $stmt2->bindparam(':cid', $cid, PDO::PARAM_STR);
        $stmt2->bindparam(':type', $weekly, PDO::PARAM_STR);
        
        $monthly = 3;
        $stmt3   = $con->prepare($query);
        $stmt3->bindparam(':rent', $mrent, PDO::PARAM_STR);
        $stmt3->bindparam(':cdw', $mcdw, PDO::PARAM_STR);
        $stmt3->bindparam(':pai', $mpai, PDO::PARAM_STR);
        $stmt3->bindparam(':hc', $mhc, PDO::PARAM_STR);
        $stmt3->bindparam(':csc', $mcsc, PDO::PARAM_STR);
        $stmt3->bindparam(':gpsc', $mgpsc, PDO::PARAM_STR);
        $stmt3->bindparam(':dc', $mdc, PDO::PARAM_STR);
        $stmt3->bindparam(':ic', $mic, PDO::PARAM_STR);
        $stmt3->bindparam(':oic', $moic, PDO::PARAM_STR);
        $stmt3->bindparam(':ekmc', $mekmc, PDO::PARAM_STR);
        $stmt3->bindparam(':vid', $vid, PDO::PARAM_STR);
        $stmt3->bindparam(':cid', $cid, PDO::PARAM_STR);
        $stmt3->bindparam(':type', $monthly, PDO::PARAM_STR);
        
        $result = $stmt1->execute();
        $result = $stmt2->execute();
        $result = $stmt3->execute();
        
        $id = $con->lastInsertId();
        return $id;
    }
    
    
    public function editVehicletariff($vid, $cid, $drent, $dcdw, $dpai, $dhc, $dcsc, $dgpsc, $ddc, $dic, $doic, $dekmc, $wrent, $wcdw, $wpai, $whc, $wcsc, $wgpsc, $wdc, $wic, $woic, $wekmc, $mrent, $mcdw, $mpai, $mhc, $mcsc, $mgpsc, $mdc, $mic, $moic, $mekmc)
    {
        
        $db  = new dbconnect();
        $con = $db->Connect();
        
        $query = "update vehicles_tariff set rent=:rent,cdw=:cdw,pai=:pai,hc=:hc,csc=:csc,gpsc=:gpsc,dc=:dc,ic=:ic,oic=:oic,ekmc=:ekmc where vid=:vid and cid=:cid and type=:type";
        
        $daily = 1;
        $stmt1 = $con->prepare($query);
        $stmt1->bindparam(':rent', $drent, PDO::PARAM_STR);
        $stmt1->bindparam(':cdw', $dcdw, PDO::PARAM_STR);
        $stmt1->bindparam(':pai', $dpai, PDO::PARAM_STR);
        $stmt1->bindparam(':hc', $dhc, PDO::PARAM_STR);
        $stmt1->bindparam(':csc', $dcsc, PDO::PARAM_STR);
        $stmt1->bindparam(':gpsc', $dgpsc, PDO::PARAM_STR);
        $stmt1->bindparam(':dc', $ddc, PDO::PARAM_STR);
        $stmt1->bindparam(':ic', $dic, PDO::PARAM_STR);
        $stmt1->bindparam(':oic', $doic, PDO::PARAM_STR);
        $stmt1->bindparam(':ekmc', $dekmc, PDO::PARAM_STR);
        $stmt1->bindparam(':vid', $vid, PDO::PARAM_STR);
        $stmt1->bindparam(':cid', $cid, PDO::PARAM_STR);
        $stmt1->bindparam(':type', $daily, PDO::PARAM_STR);
        
        $weekly = 2;
        $stmt2  = $con->prepare($query);
        $stmt2->bindparam(':rent', $wrent, PDO::PARAM_STR);
        $stmt2->bindparam(':cdw', $wcdw, PDO::PARAM_STR);
        $stmt2->bindparam(':pai', $wpai, PDO::PARAM_STR);
        $stmt2->bindparam(':hc', $whc, PDO::PARAM_STR);
        $stmt2->bindparam(':csc', $wcsc, PDO::PARAM_STR);
        $stmt2->bindparam(':gpsc', $wgpsc, PDO::PARAM_STR);
        $stmt2->bindparam(':dc', $wdc, PDO::PARAM_STR);
        $stmt2->bindparam(':ic', $wic, PDO::PARAM_STR);
        $stmt2->bindparam(':oic', $woic, PDO::PARAM_STR);
        $stmt2->bindparam(':ekmc', $wekmc, PDO::PARAM_STR);
        $stmt2->bindparam(':vid', $vid, PDO::PARAM_STR);
        $stmt2->bindparam(':cid', $cid, PDO::PARAM_STR);
        $stmt2->bindparam(':type', $weekly, PDO::PARAM_STR);
        
        $monthly = 3;
        $stmt3   = $con->prepare($query);
        $stmt3->bindparam(':rent', $mrent, PDO::PARAM_STR);
        $stmt3->bindparam(':cdw', $mcdw, PDO::PARAM_STR);
        $stmt3->bindparam(':pai', $mpai, PDO::PARAM_STR);
        $stmt3->bindparam(':hc', $mhc, PDO::PARAM_STR);
        $stmt3->bindparam(':csc', $mcsc, PDO::PARAM_STR);
        $stmt3->bindparam(':gpsc', $mgpsc, PDO::PARAM_STR);
        $stmt3->bindparam(':dc', $mdc, PDO::PARAM_STR);
        $stmt3->bindparam(':ic', $mic, PDO::PARAM_STR);
        $stmt3->bindparam(':oic', $moic, PDO::PARAM_STR);
        $stmt3->bindparam(':ekmc', $mekmc, PDO::PARAM_STR);
        $stmt3->bindparam(':vid', $vid, PDO::PARAM_STR);
        $stmt3->bindparam(':cid', $cid, PDO::PARAM_STR);
        $stmt3->bindparam(':type', $monthly, PDO::PARAM_STR);
        
        $result = $stmt1->execute();
        $result = $stmt2->execute();
        $result = $stmt3->execute();
        return $result;
    }
    
    
    
    public function edit_partner_tariff($vid, $cid, $pid, $prateid, $drent, $dcdw, $dpai, $dhc, $dcsc, $dgpsc, $ddc, $dic, $doic, $dekmc, $wrent, $wcdw, $wpai, $whc, $wcsc, $wgpsc, $wdc, $wic, $woic, $wekmc, $mrent, $mcdw, $mpai, $mhc, $mcsc, $mgpsc, $mdc, $mic, $moic, $mekmc)
    {
        
        $db  = new dbconnect();
        $con = $db->Connect();
        
        if ($prateid == 0) {
            $query = "insert into vehicles_partner_tariff set rent=:rent,cdw=:cdw,pai=:pai,hc=:hc,csc=:csc,gpsc=:gpsc,dc=:dc,ic=:ic,oic=:oic,ekmc=:ekmc,vid=:vid,cid=:cid,pid=:pid,type=:type";
        } else {
            $query = "update vehicles_partner_tariff set rent=:rent,cdw=:cdw,pai=:pai,hc=:hc,csc=:csc,gpsc=:gpsc,dc=:dc,ic=:ic,oic=:oic,ekmc=:ekmc where vid=:vid and cid=:cid and pid=:pid and type=:type";
        }
        
        $daily = 1;
        $stmt1 = $con->prepare($query);
        $stmt1->bindparam(':rent', $drent, PDO::PARAM_STR);
        $stmt1->bindparam(':cdw', $dcdw, PDO::PARAM_STR);
        $stmt1->bindparam(':pai', $dpai, PDO::PARAM_STR);
        $stmt1->bindparam(':hc', $dhc, PDO::PARAM_STR);
        $stmt1->bindparam(':csc', $dcsc, PDO::PARAM_STR);
        $stmt1->bindparam(':gpsc', $dgpsc, PDO::PARAM_STR);
        $stmt1->bindparam(':dc', $ddc, PDO::PARAM_STR);
        $stmt1->bindparam(':ic', $dic, PDO::PARAM_STR);
        $stmt1->bindparam(':oic', $doic, PDO::PARAM_STR);
        $stmt1->bindparam(':ekmc', $dekmc, PDO::PARAM_STR);
        $stmt1->bindparam(':vid', $vid, PDO::PARAM_STR);
        $stmt1->bindparam(':cid', $cid, PDO::PARAM_STR);
        $stmt1->bindparam(':pid', $pid, PDO::PARAM_STR);
        $stmt1->bindparam(':type', $daily, PDO::PARAM_STR);
        
        $weekly = 2;
        $stmt2  = $con->prepare($query);
        $stmt2->bindparam(':rent', $wrent, PDO::PARAM_STR);
        $stmt2->bindparam(':cdw', $wcdw, PDO::PARAM_STR);
        $stmt2->bindparam(':pai', $wpai, PDO::PARAM_STR);
        $stmt2->bindparam(':hc', $whc, PDO::PARAM_STR);
        $stmt2->bindparam(':csc', $wcsc, PDO::PARAM_STR);
        $stmt2->bindparam(':gpsc', $wgpsc, PDO::PARAM_STR);
        $stmt2->bindparam(':dc', $wdc, PDO::PARAM_STR);
        $stmt2->bindparam(':ic', $wic, PDO::PARAM_STR);
        $stmt2->bindparam(':oic', $woic, PDO::PARAM_STR);
        $stmt2->bindparam(':ekmc', $wekmc, PDO::PARAM_STR);
        $stmt2->bindparam(':vid', $vid, PDO::PARAM_STR);
        $stmt2->bindparam(':cid', $cid, PDO::PARAM_STR);
        $stmt2->bindparam(':pid', $pid, PDO::PARAM_STR);
        $stmt2->bindparam(':type', $weekly, PDO::PARAM_STR);
        
        $monthly = 3;
        $stmt3   = $con->prepare($query);
        $stmt3->bindparam(':rent', $mrent, PDO::PARAM_STR);
        $stmt3->bindparam(':cdw', $mcdw, PDO::PARAM_STR);
        $stmt3->bindparam(':pai', $mpai, PDO::PARAM_STR);
        $stmt3->bindparam(':hc', $mhc, PDO::PARAM_STR);
        $stmt3->bindparam(':csc', $mcsc, PDO::PARAM_STR);
        $stmt3->bindparam(':gpsc', $mgpsc, PDO::PARAM_STR);
        $stmt3->bindparam(':dc', $mdc, PDO::PARAM_STR);
        $stmt3->bindparam(':ic', $mic, PDO::PARAM_STR);
        $stmt3->bindparam(':oic', $moic, PDO::PARAM_STR);
        $stmt3->bindparam(':ekmc', $mekmc, PDO::PARAM_STR);
        $stmt3->bindparam(':vid', $vid, PDO::PARAM_STR);
        $stmt3->bindparam(':cid', $cid, PDO::PARAM_STR);
        $stmt3->bindparam(':pid', $pid, PDO::PARAM_STR);
        $stmt3->bindparam(':type', $monthly, PDO::PARAM_STR);
        
        $result = $stmt1->execute();
        $result = $stmt2->execute();
        $result = $stmt3->execute();
        return $result;
        
    }
    
    
    
    public function edit_sale_tariff($vid, $cid, $pid, $srateid, $drent, $dcdw, $dpai, $dhc, $dcsc, $dgpsc, $ddc, $dic, $doic, $dekmc, $wrent, $wcdw, $wpai, $whc, $wcsc, $wgpsc, $wdc, $wic, $woic, $wekmc, $mrent, $mcdw, $mpai, $mhc, $mcsc, $mgpsc, $mdc, $mic, $moic, $mekmc)
    {
        
        $db  = new dbconnect();
        $con = $db->Connect();
        
        if ($srateid == 0) {
            $query = "insert into vehicles_sale_price set rent=:rent,cdw=:cdw,pai=:pai,hc=:hc,csc=:csc,gpsc=:gpsc,dc=:dc,ic=:ic,oic=:oic,ekmc=:ekmc,vid=:vid,cid=:cid,pid=:pid,type=:type";
        } else {
            $query = "update vehicles_sale_price set rent=:rent,cdw=:cdw,pai=:pai,hc=:hc,csc=:csc,gpsc=:gpsc,dc=:dc,ic=:ic,oic=:oic,ekmc=:ekmc where vid=:vid and cid=:cid and pid=:pid and type=:type";
        }
        
        $daily = 1;
        $stmt1 = $con->prepare($query);
        $stmt1->bindparam(':rent', $drent, PDO::PARAM_STR);
        $stmt1->bindparam(':cdw', $dcdw, PDO::PARAM_STR);
        $stmt1->bindparam(':pai', $dpai, PDO::PARAM_STR);
        $stmt1->bindparam(':hc', $dhc, PDO::PARAM_STR);
        $stmt1->bindparam(':csc', $dcsc, PDO::PARAM_STR);
        $stmt1->bindparam(':gpsc', $dgpsc, PDO::PARAM_STR);
        $stmt1->bindparam(':dc', $ddc, PDO::PARAM_STR);
        $stmt1->bindparam(':ic', $dic, PDO::PARAM_STR);
        $stmt1->bindparam(':oic', $doic, PDO::PARAM_STR);
        $stmt1->bindparam(':ekmc', $dekmc, PDO::PARAM_STR);
        $stmt1->bindparam(':vid', $vid, PDO::PARAM_STR);
        $stmt1->bindparam(':cid', $cid, PDO::PARAM_STR);
        $stmt1->bindparam(':pid', $pid, PDO::PARAM_STR);
        $stmt1->bindparam(':type', $daily, PDO::PARAM_STR);
        
        $weekly = 2;
        $stmt2  = $con->prepare($query);
        $stmt2->bindparam(':rent', $wrent, PDO::PARAM_STR);
        $stmt2->bindparam(':cdw', $wcdw, PDO::PARAM_STR);
        $stmt2->bindparam(':pai', $wpai, PDO::PARAM_STR);
        $stmt2->bindparam(':hc', $whc, PDO::PARAM_STR);
        $stmt2->bindparam(':csc', $wcsc, PDO::PARAM_STR);
        $stmt2->bindparam(':gpsc', $wgpsc, PDO::PARAM_STR);
        $stmt2->bindparam(':dc', $wdc, PDO::PARAM_STR);
        $stmt2->bindparam(':ic', $wic, PDO::PARAM_STR);
        $stmt2->bindparam(':oic', $woic, PDO::PARAM_STR);
        $stmt2->bindparam(':ekmc', $wekmc, PDO::PARAM_STR);
        $stmt2->bindparam(':vid', $vid, PDO::PARAM_STR);
        $stmt2->bindparam(':cid', $cid, PDO::PARAM_STR);
        $stmt2->bindparam(':pid', $pid, PDO::PARAM_STR);
        $stmt2->bindparam(':type', $weekly, PDO::PARAM_STR);
        
        $monthly = 3;
        $stmt3   = $con->prepare($query);
        $stmt3->bindparam(':rent', $mrent, PDO::PARAM_STR);
        $stmt3->bindparam(':cdw', $mcdw, PDO::PARAM_STR);
        $stmt3->bindparam(':pai', $mpai, PDO::PARAM_STR);
        $stmt3->bindparam(':hc', $mhc, PDO::PARAM_STR);
        $stmt3->bindparam(':csc', $mcsc, PDO::PARAM_STR);
        $stmt3->bindparam(':gpsc', $mgpsc, PDO::PARAM_STR);
        $stmt3->bindparam(':dc', $mdc, PDO::PARAM_STR);
        $stmt3->bindparam(':ic', $mic, PDO::PARAM_STR);
        $stmt3->bindparam(':oic', $moic, PDO::PARAM_STR);
        $stmt3->bindparam(':ekmc', $mekmc, PDO::PARAM_STR);
        $stmt3->bindparam(':vid', $vid, PDO::PARAM_STR);
        $stmt3->bindparam(':cid', $cid, PDO::PARAM_STR);
        $stmt3->bindparam(':pid', $pid, PDO::PARAM_STR);
        $stmt3->bindparam(':type', $monthly, PDO::PARAM_STR);
        
        $result = $stmt1->execute();
        $result = $stmt2->execute();
        $result = $stmt3->execute();
        return $result;
        
    }
    
    
    
    
    
    public function check_vehicle_tariff($vid, $cid)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select count(*) from vehicles_tariff where vid=:vid and cid=:cid";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':vid', $vid, PDO::PARAM_STR);
        $stmt->bindparam(':cid', $cid, PDO::PARAM_STR);
        $stmt->execute();
        $number_of_rows = $stmt->fetchColumn();
        return $number_of_rows;
        
    }
    
    public function vehical_daily_tariff($vid, $cid)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from vehicles_tariff where vid=:vid and cid=:cid and type=1";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':vid', $vid, PDO::PARAM_STR);
        $stmt->bindparam(':cid', $cid, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
        
    }
    public function vehical_weekly_tariff($vid, $cid)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from vehicles_tariff where vid=:vid and cid=:cid and type=2";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':vid', $vid, PDO::PARAM_STR);
        $stmt->bindparam(':cid', $cid, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
        
    }
    public function vehical_monthly_tariff($vid, $cid)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from vehicles_tariff where vid=:vid and cid=:cid and type=3";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':vid', $vid, PDO::PARAM_STR);
        $stmt->bindparam(':cid', $cid, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
        
    }
    
    
    
    
    public function partner_tariff_check($vid, $cid, $pid)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select count(*) from vehicles_partner_tariff where vid=:vid and cid=:cid and pid=:pid";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':vid', $vid, PDO::PARAM_STR);
        $stmt->bindparam(':cid', $cid, PDO::PARAM_STR);
        $stmt->bindparam(':pid', $pid, PDO::PARAM_STR);
        $stmt->execute();
        $number_of_rows = $stmt->fetchColumn();
        return $number_of_rows;
        
    }
    
    public function partner_daily_tariff($vid, $cid, $pid)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from vehicles_partner_tariff where vid=:vid and cid=:cid and pid=:pid and type=1";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':vid', $vid, PDO::PARAM_STR);
        $stmt->bindparam(':cid', $cid, PDO::PARAM_STR);
        $stmt->bindparam(':pid', $pid, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
        
    }
    public function partner_weekly_tariff($vid, $cid, $pid)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from vehicles_partner_tariff where vid=:vid and cid=:cid and pid=:pid and type=2";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':vid', $vid, PDO::PARAM_STR);
        $stmt->bindparam(':cid', $cid, PDO::PARAM_STR);
        $stmt->bindparam(':pid', $pid, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
        
    }
    public function partner_monthly_tariff($vid, $cid, $pid)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from vehicles_partner_tariff where vid=:vid and cid=:cid and pid=:pid and type=3";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':vid', $vid, PDO::PARAM_STR);
        $stmt->bindparam(':cid', $cid, PDO::PARAM_STR);
        $stmt->bindparam(':pid', $pid, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
        
    }
    
    public function sale_tariff_check($vid, $cid, $pid)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select count(*) from vehicles_sale_price where vid=:vid and cid=:cid and pid=:pid";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':vid', $vid, PDO::PARAM_STR);
        $stmt->bindparam(':cid', $cid, PDO::PARAM_STR);
        $stmt->bindparam(':pid', $pid, PDO::PARAM_STR);
        $stmt->execute();
        $number_of_rows = $stmt->fetchColumn();
        return $number_of_rows;
        
    }
    
    public function sale_daily_tariff($vid, $cid, $pid)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from vehicles_sale_price where vid=:vid and cid=:cid and pid=:pid and type=1";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':vid', $vid, PDO::PARAM_STR);
        $stmt->bindparam(':cid', $cid, PDO::PARAM_STR);
        $stmt->bindparam(':pid', $pid, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
        
    }
    public function sale_weekly_tariff($vid, $cid, $pid)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from vehicles_sale_price where vid=:vid and cid=:cid and pid=:pid and type=2";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':vid', $vid, PDO::PARAM_STR);
        $stmt->bindparam(':cid', $cid, PDO::PARAM_STR);
        $stmt->bindparam(':pid', $pid, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
        
    }
    public function sale_monthly_tariff($vid, $cid, $pid)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from vehicles_sale_price where vid=:vid and cid=:cid and pid=:pid and type=3";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':vid', $vid, PDO::PARAM_STR);
        $stmt->bindparam(':cid', $cid, PDO::PARAM_STR);
        $stmt->bindparam(':pid', $pid, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
        
    }
    
    
    public function addVehicleType($type, $ar_type)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "insert into vehicle_type set type=:type,ar_type=:ar_type";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':type', $type, PDO::PARAM_STR);
        $stmt->bindparam(':ar_type', $ar_type, PDO::PARAM_STR);
        $count = $stmt->execute();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
        
    }
    
    public function updateVehicle($v_id, $name, $make, $ar_name, $ar_make, $model, $engine, $passenger, $luggage, $door, $fuel_capacity, $airbags, $tranmision, $anti_brake, $cruise_control, $four_wheel_drive, $feature, $vt_id, $img_url, $terms, $ar_terms)
    {
        
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "update vehicle set name=:name,make=:make,ar_name=:ar_name,ar_make=:ar_make,model=:model,engine=:engine,img_url=:img_url,passenger=:passenger,luggage=:luggage,door=:door,fuel_capacity=:fuel_capacity,airbags=:airbags,tranmision=:tranmision,anti_brake=:anti_brake,cruise_control=:cruise_control,four_wheel_drive=:four_wheel_drive,feature=:feature,vt_id=:vt_id,terms_condition=:terms,ar_terms_condition=:ar_terms where id=:v_id";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':name', $name, PDO::PARAM_STR);
        $stmt->bindparam(':make', $make, PDO::PARAM_STR);
        $stmt->bindparam(':ar_name', $ar_name, PDO::PARAM_STR);
        $stmt->bindparam(':ar_make', $ar_make, PDO::PARAM_STR);
        $stmt->bindparam(':model', $model, PDO::PARAM_STR);
        $stmt->bindparam(':engine', $engine, PDO::PARAM_STR);
        $stmt->bindparam(':img_url', $img_url, PDO::PARAM_STR);
        $stmt->bindparam(':passenger', $passenger, PDO::PARAM_STR);
        $stmt->bindparam(':luggage', $luggage, PDO::PARAM_STR);
        $stmt->bindparam(':door', $door, PDO::PARAM_STR);
        $stmt->bindparam(':fuel_capacity', $fuel_capacity, PDO::PARAM_STR);
        $stmt->bindparam(':airbags', $airbags, PDO::PARAM_STR);
        $stmt->bindparam(':tranmision', $tranmision, PDO::PARAM_STR);
        $stmt->bindparam(':anti_brake', $anti_brake, PDO::PARAM_STR);
        $stmt->bindparam(':cruise_control', $cruise_control, PDO::PARAM_STR);
        $stmt->bindparam(':four_wheel_drive', $four_wheel_drive, PDO::PARAM_STR);
        $stmt->bindparam(':feature', $feature, PDO::PARAM_STR);
        $stmt->bindparam(':vt_id', $vt_id, PDO::PARAM_STR);
        $stmt->bindparam(':v_id', $v_id, PDO::PARAM_STR);
        $stmt->bindparam(':terms', $terms, PDO::PARAM_STR);
        $stmt->bindparam(':ar_terms', $ar_terms, PDO::PARAM_STR);
        $count = $stmt->execute();
        
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
        
    }
    
    public function updateVehicleType($t_id, $type, $ar_type)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "update vehicle_type set type=:type,ar_type=:ar_type where id=:id";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':type', $type, PDO::PARAM_STR);
        $stmt->bindparam(':ar_type', $ar_type, PDO::PARAM_STR);
        $stmt->bindparam(':id', $t_id, PDO::PARAM_STR);
        $count = $stmt->execute();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
        
    }
    
    public function getVehicalTypes()
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from vehicle_type";
        $stmt  = $con->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
        
    }
    
    public function getVehicalModels()
    {

        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from vehicle_model";
        $stmt  = $con->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
        
    }
    
    
    public function getType($type)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select type from vehicle_type where id=:id";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':id', $type, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['type'];
        
    }
        
    public function get_arabic_Type($type)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select ar_type from vehicle_type where id=:id";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':id', $type, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['ar_type'];
        
    }
    
        public function get_typeid_byname($type)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select id from vehicle_type where type=:type";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':type', $type, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['id'];
        
    }
    
    public function getTypebyid($id)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from vehicle_type where id=:id";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
        
    }

    public function getVehicles()
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from vehicle order by name asc";
        $stmt  = $con->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
        
    }
    
    
    public function getVehiclesmakes()
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select distinct(make) from vehicle where make!='' order by make asc ";
        $stmt  = $con->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
        
    }
    
     public function getVehicles_arabic_makes()
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select distinct(ar_make) from vehicle where make!='' order by make asc ";
        $stmt  = $con->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
        
    }
    
    public function totalfeaturedvehicle()
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select count(*) from vehicle where feature=1";
        $stmt  = $con->prepare($query);
        $stmt->execute();
        $number_of_rows = $stmt->fetchColumn();
        if ($number_of_rows) {
            return $number_of_rows;
        } else {
            return false;
        }
        
    }
    
    public function getFeaturedVehicles($totalvehicle)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from vehicle where feature='1' LIMIT {$totalvehicle}";
        $stmt  = $con->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    
    public function getVehicle($v_id)
    {
                
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from vehicle where id=:id";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':id', $v_id, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    
    public function filter_result($type, $make,$model, $from, $to, $airbags, $transmission, $anti_brake, $cruise_control, $fwd, $id)
    {
        if ($airbags == "") {
            $condition1 = "airbags" . ">=" . "0";
        } else {
            $condition1 = "airbags" . "=" . $airbags;
        }
        if ($transmission == "") {
            $condition2 = "tranmision" . ">=" . "0";
        } else {
            $condition2 = "tranmision" . "=" . $transmission;
        }
        if ($anti_brake == "") {
            $condition3 = "anti_brake" . ">=" . "0";
        } else {
            $condition3 = "anti_brake" . "=" . $anti_brake;
        }
        if ($cruise_control == "") {
            $condition4 = "cruise_control" . ">=" . "0";
        } else {
            $condition4 = "cruise_control" . "=" . $cruise_control;
        }
        if ($fwd == "") {
            $condition5 = "four_wheel_drive" . ">=" . "0";
        } else {
            $condition5 = "four_wheel_drive" . "=" . $fwd;
        }
        
        if ($type == 0) {
            $condition6 = "vt_id" . ">" . "0";
        } else {
            $condition6 = "vt_id" . "=" . $type;
        }
        if ($make == "0") {
            $condition7 = "make" . "!=" . "''";
        } else {
            $condition7 = "make" . "=" . "'" . $make . "'";
        }
        
        if ($model == "0") {
            $condition8 = "model" . "!=" . "''";
        } else {
            $condition8 = "model" . "=" . "'" . $model . "'";
        }
        
        $condition9 = "id in ($id)";
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from vehicle where $condition1 and $condition2 and $condition3 and $condition4 and $condition5 and $condition6 and $condition7 and $condition8 and $condition9";
        $stmt  = $con->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $row;
        
    }
    
    
    public function filter_result_arabic($type, $make,$model, $from, $to, $airbags, $transmission, $anti_brake, $cruise_control, $fwd, $id)
    {
        if ($airbags == "") {
            $condition1 = "airbags" . ">=" . "0";
        } else {
            $condition1 = "airbags" . "=" . $airbags;
        }
        if ($transmission == "") {
            $condition2 = "tranmision" . ">=" . "0";
        } else {
            $condition2 = "tranmision" . "=" . $transmission;
        }
        if ($anti_brake == "") {
            $condition3 = "anti_brake" . ">=" . "0";
        } else {
            $condition3 = "anti_brake" . "=" . $anti_brake;
        }
        if ($cruise_control == "") {
            $condition4 = "cruise_control" . ">=" . "0";
        } else {
            $condition4 = "cruise_control" . "=" . $cruise_control;
        }
        if ($fwd == "") {
            $condition5 = "four_wheel_drive" . ">=" . "0";
        } else {
            $condition5 = "four_wheel_drive" . "=" . $fwd;
        }
        
        if ($type == 0) {
            $condition6 = "vt_id" . ">" . "0";
        } else {
            $condition6 = "vt_id" . "=" . $type;
        }
        if ($make == "0") {
            $condition7 = "ar_make" . "!=" . "''";
        } else {
            $condition7 = "ar_make" . "=" . "'" . $make . "'";
        }
        
        if ($model == "0") {
            $condition8 = "model" . "!=" . "''";
        } else {
            $condition8 = "model" . "=" . "'" . $model . "'";
        }
        
        $condition9 = "id in ($id)";
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from vehicle where $condition1 and $condition2 and $condition3 and $condition4 and $condition5 and $condition6 and $condition7 and $condition8 and $condition9";
        $stmt  = $con->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $row;
        
    }
    
    public function getVehiclesById($id, $v_type)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from vehicle where id in (:id) and vt_id=:v_type";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':id', $id, PDO::PARAM_STR);
        $stmt->bindparam(':v_type', $v_type, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
        
    }
    
    
    public function vehicles_sorted_bytariff($v_id, $diff, $ref)
    {
        
        $vehicle             = vehical::getInstance();
        $location            = new dbcountrylocation;
        $vehicle_array       = array();
        $sorted_vehicles_ids = array();
        
        $i       = 0;
        $country = $location->fetch_Country($_SESSION['country']);
        $db      = new dbconnect();
        $con     = $db->Connect();
        $query   = "select * from vehicle where id in($v_id)";
        $stmt    = $con->prepare($query);
        $stmt->bindparam(':id', $v_id, PDO::PARAM_STR);
        $stmt->execute();
        $vehicle = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($vehicle as $v) {
            if ($ref != "") {
                $part = partnerdb::getInstance();
                $partner      = $part->fetchbyusername($ref);
                $check        = $this->sale_tariff_check($v['id'], $country['id'], $partner['id']);
                $perday_price = '0.00';
                if ($check > 0) {
                    if ($diff > 29) {
                        
                        $tariff_result = $this->sale_monthly_tariff($v['id'], $country['id'], $partner['id']);
                        $perday_price  = $tariff_result['rent'] / 30;
                        
                    }
                    
                    elseif ($diff > 6) {
                        
                        $tariff_result = $this->sale_weekly_tariff($v['id'], $country['id'], $partner['id']);
                        $perday_price  = $tariff_result['rent'] / 7;
                    }
                    
                    else {
                        
                        $tariff_result = $this->sale_daily_tariff($v['id'], $country['id'], $partner['id']);
                        $perday_price  = $tariff_result['rent'];
                        
                        
                        
                    }
                } else {
                    $check        = $this->check_vehicle_tariff($v['id'], $country['id']);
                    $perday_price = '0.00';
                    if ($check > 0) {
                        if ($diff > 29) {
                            
                            $tariff_result = $this->vehical_monthly_tariff($v['id'], $country['id']);
                            $perday_price  = $tariff_result['rent'] / 30;
                            
                        }
                        
                        elseif ($diff > 6) {
                            
                            $tariff_result = $this->vehical_weekly_tariff($v['id'], $country['id']);
                            $perday_price  = $tariff_result['rent'] / 7;
                        }
                        
                        else {
                            
                            $tariff_result = $this->vehical_daily_tariff($v['id'], $country['id']);
                            $perday_price  = $tariff_result['rent'];
                            
                            
                            
                        }
                    }
                }
            } else {
                $check        = $this->check_vehicle_tariff($v['id'], $country['id']);
                $perday_price = '0.00';
                if ($check > 0) {
                    if ($diff > 29) {
                        
                        $tariff_result = $this->vehical_monthly_tariff($v['id'], $country['id']);
                        $perday_price  = $tariff_result['rent'] / 30;
                        
                    }
                    
                    elseif ($diff > 6) {
                        
                        $tariff_result = $this->vehical_weekly_tariff($v['id'], $country['id']);
                        $perday_price  = $tariff_result['rent'] / 7;
                    }
                    
                    else {
                        
                        $tariff_result = $this->vehical_daily_tariff($v['id'], $country['id']);
                        $perday_price  = $tariff_result['rent'];
                        
                        
                        
                    }
                }
            }
            
            $vehicle_array[$i] = array(
                'id' => $v['id'],
                'price' => $perday_price
            );
            $i                 = $i + 1;
        }
        
        
        //define a comparison function
        function cmp($a, $b)
        {
            if ($a['price'] == $b['price'])
                return 0;
            return ($a['price'] < $b['price']) ? -1 : 1;
        }
        
        uasort($vehicle_array, 'cmp');
        
        $ids = implode(', ', array_map(function($entry)
        {
            return $entry['id'];
        }, $vehicle_array));
        
        
        $v_id = explode(',', $ids);
        
        $final_result = array();
        foreach ($v_id as $id) {
            $db    = new dbconnect();
            $con   = $db->Connect();
            $query = "select * from vehicle where id=:id";
            $stmt  = $con->prepare($query);
            $stmt->bindparam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $final_result[] = $row;
        }
        
        return $final_result;
    }
    
    
    
    public function vehicles_des_sorted_bytariff($v_id, $diff, $ref)
    {
        
        $vehicle             = vehical::getInstance();
        $location            = new dbcountrylocation;
        $vehicle_array       = array();
        $sorted_vehicles_ids = array();
        
        $i       = 0;
        $country = $location->fetch_Country($_SESSION['country']);
        $db      = new dbconnect();
        $con     = $db->Connect();
        $query   = "select * from vehicle where id in($v_id)";
        $stmt    = $con->prepare($query);
        $stmt->bindparam(':id', $v_id, PDO::PARAM_STR);
        $stmt->execute();
        $vehicle = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($vehicle as $v) {
            if ($ref != "") {
                $part = partnerdb::getInstance();
                $partner      = $part->fetchbyusername($profile['ref']);
                $check        = $this->sale_tariff_check($v['id'], $country['id'], $partner['id']);
                $perday_price = '0.00';
                if ($check > 0) {
                    if ($diff > 29) {
                        
                        $tariff_result = $this->sale_monthly_tariff($v['id'], $country['id'], $partner['id']);
                        $perday_price  = $tariff_result['rent'] / 30;
                        
                    }
                    
                    elseif ($diff > 6) {
                        
                        $tariff_result = $this->sale_weekly_tariff($v['id'], $country['id'], $partner['id']);
                        $perday_price  = $tariff_result['rent'] / 7;
                    }
                    
                    else {
                        
                        $tariff_result = $this->sale_daily_tariff($v['id'], $country['id'], $partner['id']);
                        $perday_price  = $tariff_result['rent'];
                        
                        
                        
                    }
                } else {
                    $check        = $this->check_vehicle_tariff($v['id'], $country['id']);
                    $perday_price = '0.00';
                    if ($check > 0) {
                        if ($diff > 29) {
                            
                            $tariff_result = $this->vehical_monthly_tariff($v['id'], $country['id']);
                            $perday_price  = $tariff_result['rent'] / 30;
                            
                        }
                        
                        elseif ($diff > 6) {
                            
                            $tariff_result = $this->vehical_weekly_tariff($v['id'], $country['id']);
                            $perday_price  = $tariff_result['rent'] / 7;
                        }
                        
                        else {
                            
                            $tariff_result = $this->vehical_daily_tariff($v['id'], $country['id']);
                            $perday_price  = $tariff_result['rent'];
                            
                            
                            
                        }
                    }
                }
            } else {
                $check        = $this->check_vehicle_tariff($v['id'], $country['id']);
                $perday_price = '0.00';
                if ($check > 0) {
                    if ($diff > 29) {
                        
                        $tariff_result = $this->vehical_monthly_tariff($v['id'], $country['id']);
                        $perday_price  = $tariff_result['rent'] / 30;
                        
                    }
                    
                    elseif ($diff > 6) {
                        
                        $tariff_result = $this->vehical_weekly_tariff($v['id'], $country['id']);
                        $perday_price  = $tariff_result['rent'] / 7;
                    }
                    
                    else {
                        
                        $tariff_result = $this->vehical_daily_tariff($v['id'], $country['id']);
                        $perday_price  = $tariff_result['rent'];
                        
                        
                        
                    }
                }
            }
            
            $vehicle_array[$i] = array(
                'id' => $v['id'],
                'price' => $perday_price
            );
            $i                 = $i + 1;
        }
        
        
        //define a comparison function
        function cmp($a, $b)
        {
            if ($a['price'] == $b['price'])
                return 0;
            return ($a['price'] > $b['price']) ? -1 : 1;
        }
        
        uasort($vehicle_array, 'cmp');
        
        $ids = implode(', ', array_map(function($entry)
        {
            return $entry['id'];
        }, $vehicle_array));
        
        
        $v_id = explode(',', $ids);
        
        $final_result = array();
        foreach ($v_id as $id) {
            $db    = new dbconnect();
            $con   = $db->Connect();
            $query = "select * from vehicle where id=:id";
            $stmt  = $con->prepare($query);
            $stmt->bindparam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $final_result[] = $row;
        }
        
        return $final_result;
    }
    
    
    public function getVehiclesById2($v_id)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from vehicle where id in($v_id)";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':id', $v_id, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    
        public function filter_fleet_guide_vehicles($v_id,$make,$type)
    {

        if($make=="0")
        {
            $condition2='1=1';
        }
        else
        {
            $condition2="make='".$make . "'";
        }
        
        if($type==0)
        {
            $condition3='1=1';
        }
        else
        {
            $condition3='vt_id='.$type;
        }

        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from vehicle where id in($v_id) and $condition2 and $condition3";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':id', $v_id, PDO::PARAM_STR);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    
    
    public function arabic_filter_fleet_guide_vehicles($v_id,$make,$type)
    {

        if($make=="0")
        {
            $condition2='1=1';
        }
        else
        {
            $condition2="ar_make='".$make . "'";
        }
        
        if($type==0)
        {
            $condition3='1=1';
        }
        else
        {
            $condition3='vt_id='.$type;
        }

        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from vehicle where id in($v_id) and $condition2 and $condition3";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':id', $v_id, PDO::PARAM_STR);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    
    public function getVehicleImage($v_id)
    {

        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select img_url from vehicle where id=:id";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':id', $v_id, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['img_url'];
    }
    
    public function deleteVehicle($del_veh)
    {
        
        foreach ($del_veh as $veh) {
            $img = $this->getVehicleImage($veh);
            
            if (file_exists(PATH . BASE_URL . "images/admin_images/vehicle_images/" . $img)) {
                unlink(PATH . BASE_URL . "images/admin_images/vehicle_images/" . $img);
            }
                  
            $db    = new dbconnect();
            $con   = $db->Connect();
            $query = "delete from vehicle where id=:id";
            $stmt  = $con->prepare($query);
            $stmt->bindparam(':id', $veh, PDO::PARAM_STR);
            $count = $stmt->execute();
            
            $query = "delete from country_vehicle where v_id=:vid";
            $stmt  = $con->prepare($query);
            $stmt->bindparam(':vid', $veh, PDO::PARAM_STR);
            $count = $stmt->execute();
            
            $query = "delete from vehicles_tariff where vid=:vid";
            $stmt  = $con->prepare($query);
            $stmt->bindparam(':vid', $veh, PDO::PARAM_STR);
            $count = $stmt->execute();
            
            $query = "delete from vehicles_partner_tariff where vid=:vid";
            $stmt  = $con->prepare($query);
            $stmt->bindparam(':vid', $veh, PDO::PARAM_STR);
            $count = $stmt->execute();
            
            $query = "delete from vehicles_sale_price where vid=:vid";
            $stmt  = $con->prepare($query);
            $stmt->bindparam(':vid', $veh, PDO::PARAM_STR);
            $count = $stmt->execute();
            
        }
        
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function deleteVehicleType($del)
    {
        
        foreach ($del as $d) {
            
            $db    = new dbconnect();
            $con   = $db->Connect();
            $query = "delete from vehicle_type where id=:id";
            $stmt  = $con->prepare($query);
            $stmt->bindparam(':id', $d, PDO::PARAM_STR);
            $count = $stmt->execute();
            
        }
        
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
        
    }
    
    public function delete_vehicle_tariff($vid, $cid)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "delete from vehicles_tariff where cid=:cid and vid=:vid";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':cid', $cid, PDO::PARAM_STR);
        $stmt->bindparam(':vid', $vid, PDO::PARAM_STR);
        $count = $stmt->execute();
        
        
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
        
    }
    
    public function getCountries()
    {

        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from country";
        $stmt  = $con->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    
    public function addVehicleCountry($country, $vehicle)
    {
                
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "insert into country_vehicle set c_id=:c_id,v_id=:v_id";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':c_id', $country, PDO::PARAM_STR);
        $stmt->bindparam(':v_id', $vehicle, PDO::PARAM_STR);
        $count = $stmt->execute();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getVehicalesCountries()
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from country_vehicle order by c_id";
        $stmt  = $con->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    
    public function getVehicalesCountriesByCId($cid)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from country_vehicle where c_id=:id and status=1";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':id', $cid, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
        
    }
    
    public function VehicalesCountriesbyid($vid)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from country_vehicle where v_id=:id";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':id', $vid, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
        
    }
    
    public function getCounry($c_id)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from country where id=:id";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':id', $c_id, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    
    public function deleteVehicleCountry($id)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "delete from country_vehicle where id=:id";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':id', $id, PDO::PARAM_STR);
        $count = $stmt->execute();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
        
    }
    public function getVehiclaName($v_id)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select name from vehicle where id=:id";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':id', $v_id, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['name'];
    }
    public function getVehicleCountry($id)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from country_vehicle where id=:id";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    public function changeVehicleStatus($id, $status)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "update country_vehicle set status=$status where id in($id)";
        $stmt  = $con->prepare($query);
        $stmt->execute();
        return true;
        
    }
    public function editVehicleCountry($id, $cid, $vid, $status)
    {
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "update country_vehicle set c_id=:c_id,v_id=:v_id,status=:status where id=:id";
        $stmt  = $con->prepare($query);
        $stmt->bindparam(':c_id', $cid, PDO::PARAM_STR);
        $stmt->bindparam(':v_id', $vid, PDO::PARAM_STR);
        $stmt->bindparam(':status', $status, PDO::PARAM_STR);
        $stmt->bindparam(':id', $id, PDO::PARAM_STR);
        $count = $stmt->execute();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
        
    }
    public function totalvehicle()
    {        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select count(*) from country_vehicle";
        $stmt  = $con->prepare($query);
        $stmt->execute();
        $number_of_rows = $stmt->fetchColumn();
        if ($number_of_rows) {
            return $number_of_rows;
        } else {
            return false;
        }
    }
    
    
    public function delete_filter_vehicles()
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query1 = "delete from filter_vehicles";
        $stmt1  = $con->prepare($query1);
        $count = $stmt1->execute();
        
        return $count;
    }
    
    
    
    public function filter_vehicles($vname, $passengers, $luggage, $door, $capacity, $transmission, $type, $engine, $model, $airbags, $anti_brake,$cruise_control, $perday_price, $deal_price, $sorting_price, $currency,$vid,$coupon,$img)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();      

        $query = "insert into filter_vehicles set vname=:vname,passengers=:passengers,luggage=:luggage,door=:door,capacity=:capacity,transmission=:transmission,type=:type,engine=:engine,model=:model,airbags=:airbags,anti_brake=:anti_brake,cruise_control=:cruise_control,perday_price=:perday_price,deal_price=:deal_price,sorting_price=:sorting_price,currency=:currency,vid=:vid,coupon=:coupon,img=:img";
        $stmt  = $con->prepare($query);
        
        $stmt->bindparam(':vname', $vname, PDO::PARAM_STR);
        $stmt->bindparam(':passengers', $passengers, PDO::PARAM_STR);
        $stmt->bindparam(':luggage', $luggage, PDO::PARAM_STR);
        $stmt->bindparam(':door', $door, PDO::PARAM_STR);
        $stmt->bindparam(':capacity', $capacity, PDO::PARAM_STR);
        $stmt->bindparam(':transmission', $transmission, PDO::PARAM_STR);
        $stmt->bindparam(':type', $type, PDO::PARAM_STR);
        $stmt->bindparam(':engine', $engine, PDO::PARAM_STR);
        $stmt->bindparam(':model', $model, PDO::PARAM_STR);
        $stmt->bindparam(':airbags', $airbags, PDO::PARAM_STR);
        $stmt->bindparam(':anti_brake', $anti_brake, PDO::PARAM_STR);
        $stmt->bindparam(':cruise_control', $cruise_control, PDO::PARAM_STR);
        $stmt->bindparam(':perday_price', $perday_price, PDO::PARAM_STR);
        $stmt->bindparam(':deal_price', $deal_price, PDO::PARAM_STR);
        $stmt->bindparam(':sorting_price', $sorting_price, PDO::PARAM_STR);
        $stmt->bindparam(':currency', $currency, PDO::PARAM_STR);
        $stmt->bindparam(':vid', $vid, PDO::PARAM_STR);
        $stmt->bindparam(':coupon', $coupon, PDO::PARAM_STR);
        $stmt->bindparam(':img', $img, PDO::PARAM_STR);

        $result = $stmt->execute();
        
        $id = $con->lastInsertId();
        
        return $id;
    }
    
    public function fetch_filter_vehicles()
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        $query = "select * from filter_vehicles order by sorting_price";
        $stmt  = $con->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
        
    }
    
    public function fetch_sorted_filter_vehicles($sort,$records_type)
    {
        
        $db    = new dbconnect();
        $con   = $db->Connect();
        
        
        
        if($sort==0)
        {
            if($records_type==0)
            {
                $query = "select * from filter_vehicles order by sorting_price";
            }
            else
            {
                $query = "select * from filter_vehicles where deal_price>0 order by sorting_price";
            }
            
        }
        else
        {
            if($records_type==0)
            {
                $query = "select * from filter_vehicles order by sorting_price desc";
            }
            else
            {
                $query = "select * from filter_vehicles where deal_price>0 order by sorting_price desc";
            }
        }
        
        $stmt  = $con->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
        
    }
}

?>