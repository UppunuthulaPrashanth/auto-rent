<?php

// Global variable for table object
$inb_new_vehicle_enquiry = NULL;

//
// Table class for inb_new_vehicle_enquiry
//
class cinb_new_vehicle_enquiry extends cTable {
	var $id;
	var $selectedType;
	var $individualFirstName;
	var $corporateCompanyName;
	var $corporateFullName;
	var $individualLastName;
	var $individualVehicle;
	var $corporateVehicle;
	var $corporateNoOfVehicle;
	var $_email;
	var $phone;
	var $country;
	var $city;
	var $individualSpecificRequirement;
	var $corporateSpecificRequirement;
	var $dateCreated;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'inb_new_vehicle_enquiry';
		$this->TableName = 'inb_new_vehicle_enquiry';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`inb_new_vehicle_enquiry`";
		$this->DBID = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = PHPExcel_Worksheet_PageSetup::ORIENTATION_DEFAULT; // Page orientation (PHPExcel only)
		$this->ExportExcelPageSize = PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4; // Page size (PHPExcel only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new cBasicSearch($this->TableVar);

		// id
		$this->id = new cField('inb_new_vehicle_enquiry', 'inb_new_vehicle_enquiry', 'x_id', 'id', '`id`', '`id`', 3, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// selectedType
		$this->selectedType = new cField('inb_new_vehicle_enquiry', 'inb_new_vehicle_enquiry', 'x_selectedType', 'selectedType', '`selectedType`', '`selectedType`', 200, -1, FALSE, '`selectedType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->selectedType->Sortable = TRUE; // Allow sort
		$this->fields['selectedType'] = &$this->selectedType;

		// individualFirstName
		$this->individualFirstName = new cField('inb_new_vehicle_enquiry', 'inb_new_vehicle_enquiry', 'x_individualFirstName', 'individualFirstName', '`individualFirstName`', '`individualFirstName`', 200, -1, FALSE, '`individualFirstName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->individualFirstName->Sortable = TRUE; // Allow sort
		$this->fields['individualFirstName'] = &$this->individualFirstName;

		// corporateCompanyName
		$this->corporateCompanyName = new cField('inb_new_vehicle_enquiry', 'inb_new_vehicle_enquiry', 'x_corporateCompanyName', 'corporateCompanyName', '`corporateCompanyName`', '`corporateCompanyName`', 200, -1, FALSE, '`corporateCompanyName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->corporateCompanyName->Sortable = TRUE; // Allow sort
		$this->fields['corporateCompanyName'] = &$this->corporateCompanyName;

		// corporateFullName
		$this->corporateFullName = new cField('inb_new_vehicle_enquiry', 'inb_new_vehicle_enquiry', 'x_corporateFullName', 'corporateFullName', '`corporateFullName`', '`corporateFullName`', 200, -1, FALSE, '`corporateFullName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->corporateFullName->Sortable = TRUE; // Allow sort
		$this->fields['corporateFullName'] = &$this->corporateFullName;

		// individualLastName
		$this->individualLastName = new cField('inb_new_vehicle_enquiry', 'inb_new_vehicle_enquiry', 'x_individualLastName', 'individualLastName', '`individualLastName`', '`individualLastName`', 200, -1, FALSE, '`individualLastName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->individualLastName->Sortable = TRUE; // Allow sort
		$this->fields['individualLastName'] = &$this->individualLastName;

		// individualVehicle
		$this->individualVehicle = new cField('inb_new_vehicle_enquiry', 'inb_new_vehicle_enquiry', 'x_individualVehicle', 'individualVehicle', '`individualVehicle`', '`individualVehicle`', 200, -1, FALSE, '`individualVehicle`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->individualVehicle->Sortable = TRUE; // Allow sort
		$this->fields['individualVehicle'] = &$this->individualVehicle;

		// corporateVehicle
		$this->corporateVehicle = new cField('inb_new_vehicle_enquiry', 'inb_new_vehicle_enquiry', 'x_corporateVehicle', 'corporateVehicle', '`corporateVehicle`', '`corporateVehicle`', 200, -1, FALSE, '`corporateVehicle`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->corporateVehicle->Sortable = TRUE; // Allow sort
		$this->fields['corporateVehicle'] = &$this->corporateVehicle;

		// corporateNoOfVehicle
		$this->corporateNoOfVehicle = new cField('inb_new_vehicle_enquiry', 'inb_new_vehicle_enquiry', 'x_corporateNoOfVehicle', 'corporateNoOfVehicle', '`corporateNoOfVehicle`', '`corporateNoOfVehicle`', 200, -1, FALSE, '`corporateNoOfVehicle`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->corporateNoOfVehicle->Sortable = TRUE; // Allow sort
		$this->fields['corporateNoOfVehicle'] = &$this->corporateNoOfVehicle;

		// email
		$this->_email = new cField('inb_new_vehicle_enquiry', 'inb_new_vehicle_enquiry', 'x__email', 'email', '`email`', '`email`', 200, -1, FALSE, '`email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_email->Sortable = TRUE; // Allow sort
		$this->fields['email'] = &$this->_email;

		// phone
		$this->phone = new cField('inb_new_vehicle_enquiry', 'inb_new_vehicle_enquiry', 'x_phone', 'phone', '`phone`', '`phone`', 200, -1, FALSE, '`phone`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->phone->Sortable = TRUE; // Allow sort
		$this->fields['phone'] = &$this->phone;

		// country
		$this->country = new cField('inb_new_vehicle_enquiry', 'inb_new_vehicle_enquiry', 'x_country', 'country', '`country`', '`country`', 200, -1, FALSE, '`country`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->country->Sortable = TRUE; // Allow sort
		$this->fields['country'] = &$this->country;

		// city
		$this->city = new cField('inb_new_vehicle_enquiry', 'inb_new_vehicle_enquiry', 'x_city', 'city', '`city`', '`city`', 200, -1, FALSE, '`city`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->city->Sortable = TRUE; // Allow sort
		$this->fields['city'] = &$this->city;

		// individualSpecificRequirement
		$this->individualSpecificRequirement = new cField('inb_new_vehicle_enquiry', 'inb_new_vehicle_enquiry', 'x_individualSpecificRequirement', 'individualSpecificRequirement', '`individualSpecificRequirement`', '`individualSpecificRequirement`', 201, -1, FALSE, '`individualSpecificRequirement`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->individualSpecificRequirement->Sortable = TRUE; // Allow sort
		$this->fields['individualSpecificRequirement'] = &$this->individualSpecificRequirement;

		// corporateSpecificRequirement
		$this->corporateSpecificRequirement = new cField('inb_new_vehicle_enquiry', 'inb_new_vehicle_enquiry', 'x_corporateSpecificRequirement', 'corporateSpecificRequirement', '`corporateSpecificRequirement`', '`corporateSpecificRequirement`', 201, -1, FALSE, '`corporateSpecificRequirement`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->corporateSpecificRequirement->Sortable = TRUE; // Allow sort
		$this->fields['corporateSpecificRequirement'] = &$this->corporateSpecificRequirement;

		// dateCreated
		$this->dateCreated = new cField('inb_new_vehicle_enquiry', 'inb_new_vehicle_enquiry', 'x_dateCreated', 'dateCreated', '`dateCreated`', ew_CastDateFieldForLike('`dateCreated`', 0, "DB"), 135, 0, FALSE, '`dateCreated`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->dateCreated->Sortable = TRUE; // Allow sort
		$this->dateCreated->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['dateCreated'] = &$this->dateCreated;
	}

	// Set Field Visibility
	function SetFieldVisibility($fldparm) {
		global $Security;
		return $this->$fldparm->Visible; // Returns original value
	}

	// Column CSS classes
	var $LeftColumnClass = "col-sm-2 control-label ewLabel";
	var $RightColumnClass = "col-sm-10";
	var $OffsetColumnClass = "col-sm-10 col-sm-offset-2";

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function SetLeftColumnClass($class) {
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " control-label ewLabel";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - intval($match[2]));
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace($match[1], $match[1] + "-offset", $class);
		}
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`inb_new_vehicle_enquiry`";
	}

	function SqlFrom() { // For backward compatibility
		return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
		$this->_SqlFrom = $v;
	}
	var $_SqlSelect = "";

	function getSqlSelect() { // Select
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}

	function SqlSelect() { // For backward compatibility
		return $this->getSqlSelect();
	}

	function setSqlSelect($v) {
		$this->_SqlSelect = $v;
	}
	var $_SqlWhere = "";

	function getSqlWhere() { // Where
		$sWhere = ($this->_SqlWhere <> "") ? $this->_SqlWhere : "";
		$this->TableFilter = "";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
	}

	function SqlWhere() { // For backward compatibility
		return $this->getSqlWhere();
	}

	function setSqlWhere($v) {
		$this->_SqlWhere = $v;
	}
	var $_SqlGroupBy = "";

	function getSqlGroupBy() { // Group By
		return ($this->_SqlGroupBy <> "") ? $this->_SqlGroupBy : "";
	}

	function SqlGroupBy() { // For backward compatibility
		return $this->getSqlGroupBy();
	}

	function setSqlGroupBy($v) {
		$this->_SqlGroupBy = $v;
	}
	var $_SqlHaving = "";

	function getSqlHaving() { // Having
		return ($this->_SqlHaving <> "") ? $this->_SqlHaving : "";
	}

	function SqlHaving() { // For backward compatibility
		return $this->getSqlHaving();
	}

	function setSqlHaving($v) {
		$this->_SqlHaving = $v;
	}
	var $_SqlOrderBy = "";

	function getSqlOrderBy() { // Order By
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "";
	}

	function SqlOrderBy() { // For backward compatibility
		return $this->getSqlOrderBy();
	}

	function setSqlOrderBy($v) {
		$this->_SqlOrderBy = $v;
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Check if User ID security allows view all
	function UserIDAllow($id = "") {
		$allow = EW_USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$filter = $this->CurrentFilter;
		$filter = $this->ApplyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->GetSQL($filter, $sort);
	}

	// Table SQL with List page filter
	var $UseSessionForListSQL = TRUE;

	function ListSQL() {
		$sFilter = $this->UseSessionForListSQL ? $this->getSessionWhere() : "";
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$this->Recordset_Selecting($sFilter);
		$sSelect = $this->getSqlSelect();
		$sSort = $this->UseSessionForListSQL ? $this->getSessionOrderBy() : "";
		return ew_BuildSelectSql($sSelect, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
	}

	// Get ORDER BY clause
	function GetOrderBy() {
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sql) {
		$cnt = -1;
		$pattern = "/^SELECT \* FROM/i";
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') && preg_match($pattern, $sql)) {
			$sql = "SELECT COUNT(*) FROM" . preg_replace($pattern, "", $sql);
		} else {
			$sql = "SELECT COUNT(*) FROM (" . $sql . ") EW_COUNT_TABLE";
		}
		$conn = &$this->Connection();
		if ($rs = $conn->Execute($sql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($filter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sql = ew_BuildSelectSql("SELECT * FROM " . $this->getSqlFrom(), $this->getSqlWhere(), "", "", "", $this->CurrentFilter, "");
		$cnt = $this->TryGetRecordCount($sql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function ListRecordCount() {
		$filter = $this->getSessionWhere();
		ew_AddFilter($filter, $this->CurrentFilter);
		$filter = $this->ApplyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$sql = ew_BuildSelectSql("SELECT * FROM " . $this->getSqlFrom(), $this->getSqlWhere(), "", "", "", $filter, "");
		$cnt = $this->TryGetRecordCount($sql);
		if ($cnt == -1) {
			$conn = &$this->Connection();
			if ($rs = $conn->Execute($sql)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	function Insert(&$rs) {
		$conn = &$this->Connection();
		$bInsert = $conn->Execute($this->InsertSQL($rs));
		if ($bInsert) {

			// Get insert id if necessary
			$this->id->setDbValue($conn->Insert_ID());
			$rs['id'] = $this->id->DbValue;
		}
		return $bInsert;
	}

	// UPDATE statement
	function UpdateSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$sql .= $this->fields[$name]->FldExpression . "=";
			$sql .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		ew_AddFilter($filter, $where);
		if ($filter <> "")	$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	function Update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE) {
		$conn = &$this->Connection();
		$bUpdate = $conn->Execute($this->UpdateSQL($rs, $where, $curfilter));
		return $bUpdate;
	}

	// DELETE statement
	function DeleteSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		if ($rs) {
			if (array_key_exists('id', $rs))
				ew_AddFilter($where, ew_QuotedName('id', $this->DBID) . '=' . ew_QuotedValue($rs['id'], $this->id->FldDataType, $this->DBID));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		ew_AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	function Delete(&$rs, $where = "", $curfilter = TRUE) {
		$bDelete = TRUE;
		$conn = &$this->Connection();
		if ($bDelete)
			$bDelete = $conn->Execute($this->DeleteSQL($rs, $where, $curfilter));
		return $bDelete;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`id` = @id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@id@", ew_AdjustSql($this->id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "inb_new_vehicle_enquirylist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "inb_new_vehicle_enquiryview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "inb_new_vehicle_enquiryedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "inb_new_vehicle_enquiryadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "inb_new_vehicle_enquirylist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("inb_new_vehicle_enquiryview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("inb_new_vehicle_enquiryview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "inb_new_vehicle_enquiryadd.php?" . $this->UrlParm($parm);
		else
			$url = "inb_new_vehicle_enquiryadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("inb_new_vehicle_enquiryedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("inb_new_vehicle_enquiryadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("inb_new_vehicle_enquirydelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "id:" . ew_VarToJson($this->id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->id->CurrentValue)) {
			$sUrl .= "id=" . urlencode($this->id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&amp;ordertype=" . $fld->ReverseSort());
			return $this->AddMasterUrl(ew_CurrentPage() . "?" . $sUrlParm);
		} else {
			return "";
		}
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		global $EW_COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = $_POST["key_m"];
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = $_GET["key_m"];
			$cnt = count($arKeys);
		} elseif (!empty($_GET) || !empty($_POST)) {
			$isPost = ew_IsPost();
			if ($isPost && isset($_POST["id"]))
				$arKeys[] = $_POST["id"];
			elseif (isset($_GET["id"]))
				$arKeys[] = $_GET["id"];
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$this->id->CurrentValue = $key;
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($filter) {

		// Set up filter (SQL WHERE clause) and get return SQL
		//$this->CurrentFilter = $filter;
		//$sql = $this->SQL();

		$sql = $this->GetSQL($filter, "");
		$conn = &$this->Connection();
		$rs = $conn->Execute($sql);
		return $rs;
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->id->setDbValue($rs->fields('id'));
		$this->selectedType->setDbValue($rs->fields('selectedType'));
		$this->individualFirstName->setDbValue($rs->fields('individualFirstName'));
		$this->corporateCompanyName->setDbValue($rs->fields('corporateCompanyName'));
		$this->corporateFullName->setDbValue($rs->fields('corporateFullName'));
		$this->individualLastName->setDbValue($rs->fields('individualLastName'));
		$this->individualVehicle->setDbValue($rs->fields('individualVehicle'));
		$this->corporateVehicle->setDbValue($rs->fields('corporateVehicle'));
		$this->corporateNoOfVehicle->setDbValue($rs->fields('corporateNoOfVehicle'));
		$this->_email->setDbValue($rs->fields('email'));
		$this->phone->setDbValue($rs->fields('phone'));
		$this->country->setDbValue($rs->fields('country'));
		$this->city->setDbValue($rs->fields('city'));
		$this->individualSpecificRequirement->setDbValue($rs->fields('individualSpecificRequirement'));
		$this->corporateSpecificRequirement->setDbValue($rs->fields('corporateSpecificRequirement'));
		$this->dateCreated->setDbValue($rs->fields('dateCreated'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// id
		// selectedType
		// individualFirstName
		// corporateCompanyName
		// corporateFullName
		// individualLastName
		// individualVehicle
		// corporateVehicle
		// corporateNoOfVehicle
		// email
		// phone
		// country
		// city
		// individualSpecificRequirement
		// corporateSpecificRequirement
		// dateCreated
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// selectedType
		$this->selectedType->ViewValue = $this->selectedType->CurrentValue;
		$this->selectedType->ViewCustomAttributes = "";

		// individualFirstName
		$this->individualFirstName->ViewValue = $this->individualFirstName->CurrentValue;
		$this->individualFirstName->ViewCustomAttributes = "";

		// corporateCompanyName
		$this->corporateCompanyName->ViewValue = $this->corporateCompanyName->CurrentValue;
		$this->corporateCompanyName->ViewCustomAttributes = "";

		// corporateFullName
		$this->corporateFullName->ViewValue = $this->corporateFullName->CurrentValue;
		$this->corporateFullName->ViewCustomAttributes = "";

		// individualLastName
		$this->individualLastName->ViewValue = $this->individualLastName->CurrentValue;
		$this->individualLastName->ViewCustomAttributes = "";

		// individualVehicle
		$this->individualVehicle->ViewValue = $this->individualVehicle->CurrentValue;
		$this->individualVehicle->ViewCustomAttributes = "";

		// corporateVehicle
		$this->corporateVehicle->ViewValue = $this->corporateVehicle->CurrentValue;
		$this->corporateVehicle->ViewCustomAttributes = "";

		// corporateNoOfVehicle
		$this->corporateNoOfVehicle->ViewValue = $this->corporateNoOfVehicle->CurrentValue;
		$this->corporateNoOfVehicle->ViewCustomAttributes = "";

		// email
		$this->_email->ViewValue = $this->_email->CurrentValue;
		$this->_email->ViewCustomAttributes = "";

		// phone
		$this->phone->ViewValue = $this->phone->CurrentValue;
		$this->phone->ViewCustomAttributes = "";

		// country
		$this->country->ViewValue = $this->country->CurrentValue;
		$this->country->ViewCustomAttributes = "";

		// city
		$this->city->ViewValue = $this->city->CurrentValue;
		$this->city->ViewCustomAttributes = "";

		// individualSpecificRequirement
		$this->individualSpecificRequirement->ViewValue = $this->individualSpecificRequirement->CurrentValue;
		$this->individualSpecificRequirement->ViewCustomAttributes = "";

		// corporateSpecificRequirement
		$this->corporateSpecificRequirement->ViewValue = $this->corporateSpecificRequirement->CurrentValue;
		$this->corporateSpecificRequirement->ViewCustomAttributes = "";

		// dateCreated
		$this->dateCreated->ViewValue = $this->dateCreated->CurrentValue;
		$this->dateCreated->ViewValue = ew_FormatDateTime($this->dateCreated->ViewValue, 0);
		$this->dateCreated->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// selectedType
		$this->selectedType->LinkCustomAttributes = "";
		$this->selectedType->HrefValue = "";
		$this->selectedType->TooltipValue = "";

		// individualFirstName
		$this->individualFirstName->LinkCustomAttributes = "";
		$this->individualFirstName->HrefValue = "";
		$this->individualFirstName->TooltipValue = "";

		// corporateCompanyName
		$this->corporateCompanyName->LinkCustomAttributes = "";
		$this->corporateCompanyName->HrefValue = "";
		$this->corporateCompanyName->TooltipValue = "";

		// corporateFullName
		$this->corporateFullName->LinkCustomAttributes = "";
		$this->corporateFullName->HrefValue = "";
		$this->corporateFullName->TooltipValue = "";

		// individualLastName
		$this->individualLastName->LinkCustomAttributes = "";
		$this->individualLastName->HrefValue = "";
		$this->individualLastName->TooltipValue = "";

		// individualVehicle
		$this->individualVehicle->LinkCustomAttributes = "";
		$this->individualVehicle->HrefValue = "";
		$this->individualVehicle->TooltipValue = "";

		// corporateVehicle
		$this->corporateVehicle->LinkCustomAttributes = "";
		$this->corporateVehicle->HrefValue = "";
		$this->corporateVehicle->TooltipValue = "";

		// corporateNoOfVehicle
		$this->corporateNoOfVehicle->LinkCustomAttributes = "";
		$this->corporateNoOfVehicle->HrefValue = "";
		$this->corporateNoOfVehicle->TooltipValue = "";

		// email
		$this->_email->LinkCustomAttributes = "";
		$this->_email->HrefValue = "";
		$this->_email->TooltipValue = "";

		// phone
		$this->phone->LinkCustomAttributes = "";
		$this->phone->HrefValue = "";
		$this->phone->TooltipValue = "";

		// country
		$this->country->LinkCustomAttributes = "";
		$this->country->HrefValue = "";
		$this->country->TooltipValue = "";

		// city
		$this->city->LinkCustomAttributes = "";
		$this->city->HrefValue = "";
		$this->city->TooltipValue = "";

		// individualSpecificRequirement
		$this->individualSpecificRequirement->LinkCustomAttributes = "";
		$this->individualSpecificRequirement->HrefValue = "";
		$this->individualSpecificRequirement->TooltipValue = "";

		// corporateSpecificRequirement
		$this->corporateSpecificRequirement->LinkCustomAttributes = "";
		$this->corporateSpecificRequirement->HrefValue = "";
		$this->corporateSpecificRequirement->TooltipValue = "";

		// dateCreated
		$this->dateCreated->LinkCustomAttributes = "";
		$this->dateCreated->HrefValue = "";
		$this->dateCreated->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->CustomTemplateFieldValues();
	}

	// Render edit row values
	function RenderEditRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// id
		$this->id->EditAttrs["class"] = "form-control";
		$this->id->EditCustomAttributes = "";
		$this->id->EditValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// selectedType
		$this->selectedType->EditAttrs["class"] = "form-control";
		$this->selectedType->EditCustomAttributes = "";
		$this->selectedType->EditValue = $this->selectedType->CurrentValue;
		$this->selectedType->PlaceHolder = ew_RemoveHtml($this->selectedType->FldCaption());

		// individualFirstName
		$this->individualFirstName->EditAttrs["class"] = "form-control";
		$this->individualFirstName->EditCustomAttributes = "";
		$this->individualFirstName->EditValue = $this->individualFirstName->CurrentValue;
		$this->individualFirstName->PlaceHolder = ew_RemoveHtml($this->individualFirstName->FldCaption());

		// corporateCompanyName
		$this->corporateCompanyName->EditAttrs["class"] = "form-control";
		$this->corporateCompanyName->EditCustomAttributes = "";
		$this->corporateCompanyName->EditValue = $this->corporateCompanyName->CurrentValue;
		$this->corporateCompanyName->PlaceHolder = ew_RemoveHtml($this->corporateCompanyName->FldCaption());

		// corporateFullName
		$this->corporateFullName->EditAttrs["class"] = "form-control";
		$this->corporateFullName->EditCustomAttributes = "";
		$this->corporateFullName->EditValue = $this->corporateFullName->CurrentValue;
		$this->corporateFullName->PlaceHolder = ew_RemoveHtml($this->corporateFullName->FldCaption());

		// individualLastName
		$this->individualLastName->EditAttrs["class"] = "form-control";
		$this->individualLastName->EditCustomAttributes = "";
		$this->individualLastName->EditValue = $this->individualLastName->CurrentValue;
		$this->individualLastName->PlaceHolder = ew_RemoveHtml($this->individualLastName->FldCaption());

		// individualVehicle
		$this->individualVehicle->EditAttrs["class"] = "form-control";
		$this->individualVehicle->EditCustomAttributes = "";
		$this->individualVehicle->EditValue = $this->individualVehicle->CurrentValue;
		$this->individualVehicle->PlaceHolder = ew_RemoveHtml($this->individualVehicle->FldCaption());

		// corporateVehicle
		$this->corporateVehicle->EditAttrs["class"] = "form-control";
		$this->corporateVehicle->EditCustomAttributes = "";
		$this->corporateVehicle->EditValue = $this->corporateVehicle->CurrentValue;
		$this->corporateVehicle->PlaceHolder = ew_RemoveHtml($this->corporateVehicle->FldCaption());

		// corporateNoOfVehicle
		$this->corporateNoOfVehicle->EditAttrs["class"] = "form-control";
		$this->corporateNoOfVehicle->EditCustomAttributes = "";
		$this->corporateNoOfVehicle->EditValue = $this->corporateNoOfVehicle->CurrentValue;
		$this->corporateNoOfVehicle->PlaceHolder = ew_RemoveHtml($this->corporateNoOfVehicle->FldCaption());

		// email
		$this->_email->EditAttrs["class"] = "form-control";
		$this->_email->EditCustomAttributes = "";
		$this->_email->EditValue = $this->_email->CurrentValue;
		$this->_email->PlaceHolder = ew_RemoveHtml($this->_email->FldCaption());

		// phone
		$this->phone->EditAttrs["class"] = "form-control";
		$this->phone->EditCustomAttributes = "";
		$this->phone->EditValue = $this->phone->CurrentValue;
		$this->phone->PlaceHolder = ew_RemoveHtml($this->phone->FldCaption());

		// country
		$this->country->EditAttrs["class"] = "form-control";
		$this->country->EditCustomAttributes = "";
		$this->country->EditValue = $this->country->CurrentValue;
		$this->country->PlaceHolder = ew_RemoveHtml($this->country->FldCaption());

		// city
		$this->city->EditAttrs["class"] = "form-control";
		$this->city->EditCustomAttributes = "";
		$this->city->EditValue = $this->city->CurrentValue;
		$this->city->PlaceHolder = ew_RemoveHtml($this->city->FldCaption());

		// individualSpecificRequirement
		$this->individualSpecificRequirement->EditAttrs["class"] = "form-control";
		$this->individualSpecificRequirement->EditCustomAttributes = "";
		$this->individualSpecificRequirement->EditValue = $this->individualSpecificRequirement->CurrentValue;
		$this->individualSpecificRequirement->PlaceHolder = ew_RemoveHtml($this->individualSpecificRequirement->FldCaption());

		// corporateSpecificRequirement
		$this->corporateSpecificRequirement->EditAttrs["class"] = "form-control";
		$this->corporateSpecificRequirement->EditCustomAttributes = "";
		$this->corporateSpecificRequirement->EditValue = $this->corporateSpecificRequirement->CurrentValue;
		$this->corporateSpecificRequirement->PlaceHolder = ew_RemoveHtml($this->corporateSpecificRequirement->FldCaption());

		// dateCreated
		$this->dateCreated->EditAttrs["class"] = "form-control";
		$this->dateCreated->EditCustomAttributes = "";
		$this->dateCreated->EditValue = ew_FormatDateTime($this->dateCreated->CurrentValue, 8);
		$this->dateCreated->PlaceHolder = ew_RemoveHtml($this->dateCreated->FldCaption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {

		// Call Row Rendered event
		$this->Row_Rendered();
	}
	var $ExportDoc;

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;
		if (!$Doc->ExportCustom) {

			// Write header
			$Doc->ExportTableHeader();
			if ($Doc->Horizontal) { // Horizontal format, write header
				$Doc->BeginExportRow();
				if ($ExportPageType == "view") {
					if ($this->id->Exportable) $Doc->ExportCaption($this->id);
					if ($this->selectedType->Exportable) $Doc->ExportCaption($this->selectedType);
					if ($this->individualFirstName->Exportable) $Doc->ExportCaption($this->individualFirstName);
					if ($this->corporateCompanyName->Exportable) $Doc->ExportCaption($this->corporateCompanyName);
					if ($this->corporateFullName->Exportable) $Doc->ExportCaption($this->corporateFullName);
					if ($this->individualLastName->Exportable) $Doc->ExportCaption($this->individualLastName);
					if ($this->individualVehicle->Exportable) $Doc->ExportCaption($this->individualVehicle);
					if ($this->corporateVehicle->Exportable) $Doc->ExportCaption($this->corporateVehicle);
					if ($this->corporateNoOfVehicle->Exportable) $Doc->ExportCaption($this->corporateNoOfVehicle);
					if ($this->_email->Exportable) $Doc->ExportCaption($this->_email);
					if ($this->phone->Exportable) $Doc->ExportCaption($this->phone);
					if ($this->country->Exportable) $Doc->ExportCaption($this->country);
					if ($this->city->Exportable) $Doc->ExportCaption($this->city);
					if ($this->individualSpecificRequirement->Exportable) $Doc->ExportCaption($this->individualSpecificRequirement);
					if ($this->corporateSpecificRequirement->Exportable) $Doc->ExportCaption($this->corporateSpecificRequirement);
					if ($this->dateCreated->Exportable) $Doc->ExportCaption($this->dateCreated);
				} else {
					if ($this->id->Exportable) $Doc->ExportCaption($this->id);
					if ($this->selectedType->Exportable) $Doc->ExportCaption($this->selectedType);
					if ($this->individualFirstName->Exportable) $Doc->ExportCaption($this->individualFirstName);
					if ($this->corporateCompanyName->Exportable) $Doc->ExportCaption($this->corporateCompanyName);
					if ($this->corporateFullName->Exportable) $Doc->ExportCaption($this->corporateFullName);
					if ($this->individualLastName->Exportable) $Doc->ExportCaption($this->individualLastName);
					if ($this->individualVehicle->Exportable) $Doc->ExportCaption($this->individualVehicle);
					if ($this->corporateVehicle->Exportable) $Doc->ExportCaption($this->corporateVehicle);
					if ($this->corporateNoOfVehicle->Exportable) $Doc->ExportCaption($this->corporateNoOfVehicle);
					if ($this->_email->Exportable) $Doc->ExportCaption($this->_email);
					if ($this->phone->Exportable) $Doc->ExportCaption($this->phone);
					if ($this->country->Exportable) $Doc->ExportCaption($this->country);
					if ($this->city->Exportable) $Doc->ExportCaption($this->city);
					if ($this->dateCreated->Exportable) $Doc->ExportCaption($this->dateCreated);
				}
				$Doc->EndExportRow();
			}
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				if (!$Doc->ExportCustom) {
					$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
					if ($ExportPageType == "view") {
						if ($this->id->Exportable) $Doc->ExportField($this->id);
						if ($this->selectedType->Exportable) $Doc->ExportField($this->selectedType);
						if ($this->individualFirstName->Exportable) $Doc->ExportField($this->individualFirstName);
						if ($this->corporateCompanyName->Exportable) $Doc->ExportField($this->corporateCompanyName);
						if ($this->corporateFullName->Exportable) $Doc->ExportField($this->corporateFullName);
						if ($this->individualLastName->Exportable) $Doc->ExportField($this->individualLastName);
						if ($this->individualVehicle->Exportable) $Doc->ExportField($this->individualVehicle);
						if ($this->corporateVehicle->Exportable) $Doc->ExportField($this->corporateVehicle);
						if ($this->corporateNoOfVehicle->Exportable) $Doc->ExportField($this->corporateNoOfVehicle);
						if ($this->_email->Exportable) $Doc->ExportField($this->_email);
						if ($this->phone->Exportable) $Doc->ExportField($this->phone);
						if ($this->country->Exportable) $Doc->ExportField($this->country);
						if ($this->city->Exportable) $Doc->ExportField($this->city);
						if ($this->individualSpecificRequirement->Exportable) $Doc->ExportField($this->individualSpecificRequirement);
						if ($this->corporateSpecificRequirement->Exportable) $Doc->ExportField($this->corporateSpecificRequirement);
						if ($this->dateCreated->Exportable) $Doc->ExportField($this->dateCreated);
					} else {
						if ($this->id->Exportable) $Doc->ExportField($this->id);
						if ($this->selectedType->Exportable) $Doc->ExportField($this->selectedType);
						if ($this->individualFirstName->Exportable) $Doc->ExportField($this->individualFirstName);
						if ($this->corporateCompanyName->Exportable) $Doc->ExportField($this->corporateCompanyName);
						if ($this->corporateFullName->Exportable) $Doc->ExportField($this->corporateFullName);
						if ($this->individualLastName->Exportable) $Doc->ExportField($this->individualLastName);
						if ($this->individualVehicle->Exportable) $Doc->ExportField($this->individualVehicle);
						if ($this->corporateVehicle->Exportable) $Doc->ExportField($this->corporateVehicle);
						if ($this->corporateNoOfVehicle->Exportable) $Doc->ExportField($this->corporateNoOfVehicle);
						if ($this->_email->Exportable) $Doc->ExportField($this->_email);
						if ($this->phone->Exportable) $Doc->ExportField($this->phone);
						if ($this->country->Exportable) $Doc->ExportField($this->country);
						if ($this->city->Exportable) $Doc->ExportField($this->city);
						if ($this->dateCreated->Exportable) $Doc->ExportField($this->dateCreated);
					}
					$Doc->EndExportRow($RowCnt);
				}
			}

			// Call Row Export server event
			if ($Doc->ExportCustom)
				$this->Row_Export($Recordset->fields);
			$Recordset->MoveNext();
		}
		if (!$Doc->ExportCustom) {
			$Doc->ExportTableFooter();
		}
	}

	// Get auto fill value
	function GetAutoFill($id, $val) {
		$rsarr = array();
		$rowcnt = 0;

		// Output
		if (is_array($rsarr) && $rowcnt > 0) {
			$fldcnt = count($rsarr[0]);
			for ($i = 0; $i < $rowcnt; $i++) {
				for ($j = 0; $j < $fldcnt; $j++) {
					$str = strval($rsarr[$i][$j]);
					$str = ew_ConvertToUtf8($str);
					if (isset($post["keepCRLF"])) {
						$str = str_replace(array("\r", "\n"), array("\\r", "\\n"), $str);
					} else {
						$str = str_replace(array("\r", "\n"), array(" ", " "), $str);
					}
					$rsarr[$i][$j] = $str;
				}
			}
			return ew_ArrayToJson($rsarr);
		} else {
			return FALSE;
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->FldName, $fld->LookupFilters, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>
