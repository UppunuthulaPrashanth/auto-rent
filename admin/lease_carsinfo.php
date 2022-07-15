<?php

// Global variable for table object
$lease_cars = NULL;

//
// Table class for lease_cars
//
class clease_cars extends cTable {
	var $leaseCarID;
	var $makeID;
	var $modelID;
	var $bodyTypeID;
	var $slug;
	var $image;
	var $extraFeatures;
	var $noOfSeats;
	var $luggage;
	var $transmissionID;
	var $ac;
	var $noOfDoors;
	var $monthlyAED;
	var $deliveryAED;
	var $so;
	var $active;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'lease_cars';
		$this->TableName = 'lease_cars';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`lease_cars`";
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

		// leaseCarID
		$this->leaseCarID = new cField('lease_cars', 'lease_cars', 'x_leaseCarID', 'leaseCarID', '`leaseCarID`', '`leaseCarID`', 3, -1, FALSE, '`leaseCarID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->leaseCarID->Sortable = TRUE; // Allow sort
		$this->leaseCarID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['leaseCarID'] = &$this->leaseCarID;

		// makeID
		$this->makeID = new cField('lease_cars', 'lease_cars', 'x_makeID', 'makeID', '`makeID`', '`makeID`', 3, -1, FALSE, '`makeID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->makeID->Sortable = TRUE; // Allow sort
		$this->makeID->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->makeID->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->makeID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['makeID'] = &$this->makeID;

		// modelID
		$this->modelID = new cField('lease_cars', 'lease_cars', 'x_modelID', 'modelID', '`modelID`', '`modelID`', 3, -1, FALSE, '`modelID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->modelID->Sortable = TRUE; // Allow sort
		$this->modelID->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->modelID->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->modelID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['modelID'] = &$this->modelID;

		// bodyTypeID
		$this->bodyTypeID = new cField('lease_cars', 'lease_cars', 'x_bodyTypeID', 'bodyTypeID', '`bodyTypeID`', '`bodyTypeID`', 3, -1, FALSE, '`bodyTypeID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->bodyTypeID->Sortable = TRUE; // Allow sort
		$this->bodyTypeID->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->bodyTypeID->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->bodyTypeID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['bodyTypeID'] = &$this->bodyTypeID;

		// slug
		$this->slug = new cField('lease_cars', 'lease_cars', 'x_slug', 'slug', '`slug`', '`slug`', 200, -1, FALSE, '`slug`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->slug->Sortable = TRUE; // Allow sort
		$this->fields['slug'] = &$this->slug;

		// image
		$this->image = new cField('lease_cars', 'lease_cars', 'x_image', 'image', '`image`', '`image`', 200, -1, TRUE, '`image`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->image->Sortable = TRUE; // Allow sort
		$this->fields['image'] = &$this->image;

		// extraFeatures
		$this->extraFeatures = new cField('lease_cars', 'lease_cars', 'x_extraFeatures', 'extraFeatures', '`extraFeatures`', '`extraFeatures`', 200, -1, FALSE, '`extraFeatures`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->extraFeatures->Sortable = TRUE; // Allow sort
		$this->fields['extraFeatures'] = &$this->extraFeatures;

		// noOfSeats
		$this->noOfSeats = new cField('lease_cars', 'lease_cars', 'x_noOfSeats', 'noOfSeats', '`noOfSeats`', '`noOfSeats`', 3, -1, FALSE, '`noOfSeats`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->noOfSeats->Sortable = TRUE; // Allow sort
		$this->noOfSeats->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['noOfSeats'] = &$this->noOfSeats;

		// luggage
		$this->luggage = new cField('lease_cars', 'lease_cars', 'x_luggage', 'luggage', '`luggage`', '`luggage`', 3, -1, FALSE, '`luggage`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->luggage->Sortable = TRUE; // Allow sort
		$this->luggage->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['luggage'] = &$this->luggage;

		// transmissionID
		$this->transmissionID = new cField('lease_cars', 'lease_cars', 'x_transmissionID', 'transmissionID', '`transmissionID`', '`transmissionID`', 3, -1, FALSE, '`transmissionID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->transmissionID->Sortable = TRUE; // Allow sort
		$this->transmissionID->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->transmissionID->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->transmissionID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['transmissionID'] = &$this->transmissionID;

		// ac
		$this->ac = new cField('lease_cars', 'lease_cars', 'x_ac', 'ac', '`ac`', '`ac`', 202, -1, FALSE, '`ac`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->ac->Sortable = TRUE; // Allow sort
		$this->ac->FldDataType = EW_DATATYPE_BOOLEAN;
		$this->ac->TrueValue = 'Y';
		$this->ac->FalseValue = 'N';
		$this->ac->OptionCount = 2;
		$this->fields['ac'] = &$this->ac;

		// noOfDoors
		$this->noOfDoors = new cField('lease_cars', 'lease_cars', 'x_noOfDoors', 'noOfDoors', '`noOfDoors`', '`noOfDoors`', 3, -1, FALSE, '`noOfDoors`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->noOfDoors->Sortable = TRUE; // Allow sort
		$this->noOfDoors->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['noOfDoors'] = &$this->noOfDoors;

		// monthlyAED
		$this->monthlyAED = new cField('lease_cars', 'lease_cars', 'x_monthlyAED', 'monthlyAED', '`monthlyAED`', '`monthlyAED`', 131, -1, FALSE, '`monthlyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->monthlyAED->Sortable = TRUE; // Allow sort
		$this->monthlyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['monthlyAED'] = &$this->monthlyAED;

		// deliveryAED
		$this->deliveryAED = new cField('lease_cars', 'lease_cars', 'x_deliveryAED', 'deliveryAED', '`deliveryAED`', '`deliveryAED`', 131, -1, FALSE, '`deliveryAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->deliveryAED->Sortable = TRUE; // Allow sort
		$this->deliveryAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['deliveryAED'] = &$this->deliveryAED;

		// so
		$this->so = new cField('lease_cars', 'lease_cars', 'x_so', 'so', '`so`', '`so`', 16, -1, FALSE, '`so`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->so->Sortable = TRUE; // Allow sort
		$this->so->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['so'] = &$this->so;

		// active
		$this->active = new cField('lease_cars', 'lease_cars', 'x_active', 'active', '`active`', '`active`', 16, -1, FALSE, '`active`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->active->Sortable = TRUE; // Allow sort
		$this->active->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->active->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->active->OptionCount = 2;
		$this->active->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['active'] = &$this->active;
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`lease_cars`";
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
			$this->leaseCarID->setDbValue($conn->Insert_ID());
			$rs['leaseCarID'] = $this->leaseCarID->DbValue;
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
			if (array_key_exists('leaseCarID', $rs))
				ew_AddFilter($where, ew_QuotedName('leaseCarID', $this->DBID) . '=' . ew_QuotedValue($rs['leaseCarID'], $this->leaseCarID->FldDataType, $this->DBID));
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
		return "`leaseCarID` = @leaseCarID@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->leaseCarID->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->leaseCarID->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@leaseCarID@", ew_AdjustSql($this->leaseCarID->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "lease_carslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "lease_carsview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "lease_carsedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "lease_carsadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "lease_carslist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("lease_carsview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("lease_carsview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "lease_carsadd.php?" . $this->UrlParm($parm);
		else
			$url = "lease_carsadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("lease_carsedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("lease_carsadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("lease_carsdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "leaseCarID:" . ew_VarToJson($this->leaseCarID->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->leaseCarID->CurrentValue)) {
			$sUrl .= "leaseCarID=" . urlencode($this->leaseCarID->CurrentValue);
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
			if ($isPost && isset($_POST["leaseCarID"]))
				$arKeys[] = $_POST["leaseCarID"];
			elseif (isset($_GET["leaseCarID"]))
				$arKeys[] = $_GET["leaseCarID"];
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
			$this->leaseCarID->CurrentValue = $key;
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
		$this->leaseCarID->setDbValue($rs->fields('leaseCarID'));
		$this->makeID->setDbValue($rs->fields('makeID'));
		$this->modelID->setDbValue($rs->fields('modelID'));
		$this->bodyTypeID->setDbValue($rs->fields('bodyTypeID'));
		$this->slug->setDbValue($rs->fields('slug'));
		$this->image->Upload->DbValue = $rs->fields('image');
		$this->extraFeatures->setDbValue($rs->fields('extraFeatures'));
		$this->noOfSeats->setDbValue($rs->fields('noOfSeats'));
		$this->luggage->setDbValue($rs->fields('luggage'));
		$this->transmissionID->setDbValue($rs->fields('transmissionID'));
		$this->ac->setDbValue($rs->fields('ac'));
		$this->noOfDoors->setDbValue($rs->fields('noOfDoors'));
		$this->monthlyAED->setDbValue($rs->fields('monthlyAED'));
		$this->deliveryAED->setDbValue($rs->fields('deliveryAED'));
		$this->so->setDbValue($rs->fields('so'));
		$this->active->setDbValue($rs->fields('active'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// leaseCarID
		// makeID
		// modelID
		// bodyTypeID
		// slug
		// image
		// extraFeatures
		// noOfSeats
		// luggage
		// transmissionID
		// ac
		// noOfDoors
		// monthlyAED
		// deliveryAED
		// so
		// active
		// leaseCarID

		$this->leaseCarID->ViewValue = $this->leaseCarID->CurrentValue;
		$this->leaseCarID->ViewCustomAttributes = "";

		// makeID
		if (strval($this->makeID->CurrentValue) <> "") {
			$sFilterWrk = "`makeID`" . ew_SearchString("=", $this->makeID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `makeID`, `make` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_make`";
		$sWhereWrk = "";
		$this->makeID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->makeID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `make` ASC";
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->makeID->ViewValue = $this->makeID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->makeID->ViewValue = $this->makeID->CurrentValue;
			}
		} else {
			$this->makeID->ViewValue = NULL;
		}
		$this->makeID->ViewCustomAttributes = "";

		// modelID
		if (strval($this->modelID->CurrentValue) <> "") {
			$sFilterWrk = "`modelID`" . ew_SearchString("=", $this->modelID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `modelID`, `model` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_model`";
		$sWhereWrk = "";
		$this->modelID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->modelID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->modelID->ViewValue = $this->modelID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->modelID->ViewValue = $this->modelID->CurrentValue;
			}
		} else {
			$this->modelID->ViewValue = NULL;
		}
		$this->modelID->ViewCustomAttributes = "";

		// bodyTypeID
		if (strval($this->bodyTypeID->CurrentValue) <> "") {
			$sFilterWrk = "`bodyTypeID`" . ew_SearchString("=", $this->bodyTypeID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `bodyTypeID`, `bodytype` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_bodytype`";
		$sWhereWrk = "";
		$this->bodyTypeID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->bodyTypeID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->bodyTypeID->ViewValue = $this->bodyTypeID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->bodyTypeID->ViewValue = $this->bodyTypeID->CurrentValue;
			}
		} else {
			$this->bodyTypeID->ViewValue = NULL;
		}
		$this->bodyTypeID->ViewCustomAttributes = "";

		// slug
		$this->slug->ViewValue = $this->slug->CurrentValue;
		$this->slug->ViewCustomAttributes = "";

		// image
		$this->image->UploadPath = 'uploads/rentlease';
		if (!ew_Empty($this->image->Upload->DbValue)) {
			$this->image->ImageWidth = 100;
			$this->image->ImageHeight = 0;
			$this->image->ImageAlt = $this->image->FldAlt();
			$this->image->ViewValue = $this->image->Upload->DbValue;
		} else {
			$this->image->ViewValue = "";
		}
		$this->image->ViewCustomAttributes = "";

		// extraFeatures
		if (strval($this->extraFeatures->CurrentValue) <> "") {
			$arwrk = explode(",", $this->extraFeatures->CurrentValue);
			$sFilterWrk = "";
			foreach ($arwrk as $wrk) {
				if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
				$sFilterWrk .= "`featureID`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_NUMBER, "");
			}
		$sSqlWrk = "SELECT `featureID`, `extraFeatures` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_extra_features`";
		$sWhereWrk = "";
		$this->extraFeatures->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->extraFeatures, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->extraFeatures->ViewValue = "";
				$ari = 0;
				while (!$rswrk->EOF) {
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->extraFeatures->ViewValue .= $this->extraFeatures->DisplayValue($arwrk);
					$rswrk->MoveNext();
					if (!$rswrk->EOF) $this->extraFeatures->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
					$ari++;
				}
				$rswrk->Close();
			} else {
				$this->extraFeatures->ViewValue = $this->extraFeatures->CurrentValue;
			}
		} else {
			$this->extraFeatures->ViewValue = NULL;
		}
		$this->extraFeatures->ViewCustomAttributes = "";

		// noOfSeats
		$this->noOfSeats->ViewValue = $this->noOfSeats->CurrentValue;
		$this->noOfSeats->ViewCustomAttributes = "";

		// luggage
		$this->luggage->ViewValue = $this->luggage->CurrentValue;
		$this->luggage->ViewCustomAttributes = "";

		// transmissionID
		if (strval($this->transmissionID->CurrentValue) <> "") {
			$sFilterWrk = "`transmissionID`" . ew_SearchString("=", $this->transmissionID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `transmissionID`, `transmission` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_transmission`";
		$sWhereWrk = "";
		$this->transmissionID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->transmissionID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->transmissionID->ViewValue = $this->transmissionID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->transmissionID->ViewValue = $this->transmissionID->CurrentValue;
			}
		} else {
			$this->transmissionID->ViewValue = NULL;
		}
		$this->transmissionID->ViewCustomAttributes = "";

		// ac
		if (ew_ConvertToBool($this->ac->CurrentValue)) {
			$this->ac->ViewValue = $this->ac->FldTagCaption(1) <> "" ? $this->ac->FldTagCaption(1) : "Y";
		} else {
			$this->ac->ViewValue = $this->ac->FldTagCaption(2) <> "" ? $this->ac->FldTagCaption(2) : "N";
		}
		$this->ac->ViewCustomAttributes = "";

		// noOfDoors
		$this->noOfDoors->ViewValue = $this->noOfDoors->CurrentValue;
		$this->noOfDoors->ViewCustomAttributes = "";

		// monthlyAED
		$this->monthlyAED->ViewValue = $this->monthlyAED->CurrentValue;
		$this->monthlyAED->ViewCustomAttributes = "";

		// deliveryAED
		$this->deliveryAED->ViewValue = $this->deliveryAED->CurrentValue;
		$this->deliveryAED->ViewCustomAttributes = "";

		// so
		$this->so->ViewValue = $this->so->CurrentValue;
		$this->so->ViewCustomAttributes = "";

		// active
		if (strval($this->active->CurrentValue) <> "") {
			$this->active->ViewValue = $this->active->OptionCaption($this->active->CurrentValue);
		} else {
			$this->active->ViewValue = NULL;
		}
		$this->active->ViewCustomAttributes = "";

		// leaseCarID
		$this->leaseCarID->LinkCustomAttributes = "";
		$this->leaseCarID->HrefValue = "";
		$this->leaseCarID->TooltipValue = "";

		// makeID
		$this->makeID->LinkCustomAttributes = "";
		$this->makeID->HrefValue = "";
		$this->makeID->TooltipValue = "";

		// modelID
		$this->modelID->LinkCustomAttributes = "";
		$this->modelID->HrefValue = "";
		$this->modelID->TooltipValue = "";

		// bodyTypeID
		$this->bodyTypeID->LinkCustomAttributes = "";
		$this->bodyTypeID->HrefValue = "";
		$this->bodyTypeID->TooltipValue = "";

		// slug
		$this->slug->LinkCustomAttributes = "";
		$this->slug->HrefValue = "";
		$this->slug->TooltipValue = "";

		// image
		$this->image->LinkCustomAttributes = "";
		$this->image->UploadPath = 'uploads/rentlease';
		if (!ew_Empty($this->image->Upload->DbValue)) {
			$this->image->HrefValue = ew_GetFileUploadUrl($this->image, $this->image->Upload->DbValue); // Add prefix/suffix
			$this->image->LinkAttrs["target"] = ""; // Add target
			if ($this->Export <> "") $this->image->HrefValue = ew_FullUrl($this->image->HrefValue, "href");
		} else {
			$this->image->HrefValue = "";
		}
		$this->image->HrefValue2 = $this->image->UploadPath . $this->image->Upload->DbValue;
		$this->image->TooltipValue = "";
		if ($this->image->UseColorbox) {
			if (ew_Empty($this->image->TooltipValue))
				$this->image->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
			$this->image->LinkAttrs["data-rel"] = "lease_cars_x_image";
			ew_AppendClass($this->image->LinkAttrs["class"], "ewLightbox");
		}

		// extraFeatures
		$this->extraFeatures->LinkCustomAttributes = "";
		$this->extraFeatures->HrefValue = "";
		$this->extraFeatures->TooltipValue = "";

		// noOfSeats
		$this->noOfSeats->LinkCustomAttributes = "";
		$this->noOfSeats->HrefValue = "";
		$this->noOfSeats->TooltipValue = "";

		// luggage
		$this->luggage->LinkCustomAttributes = "";
		$this->luggage->HrefValue = "";
		$this->luggage->TooltipValue = "";

		// transmissionID
		$this->transmissionID->LinkCustomAttributes = "";
		$this->transmissionID->HrefValue = "";
		$this->transmissionID->TooltipValue = "";

		// ac
		$this->ac->LinkCustomAttributes = "";
		$this->ac->HrefValue = "";
		$this->ac->TooltipValue = "";

		// noOfDoors
		$this->noOfDoors->LinkCustomAttributes = "";
		$this->noOfDoors->HrefValue = "";
		$this->noOfDoors->TooltipValue = "";

		// monthlyAED
		$this->monthlyAED->LinkCustomAttributes = "";
		$this->monthlyAED->HrefValue = "";
		$this->monthlyAED->TooltipValue = "";

		// deliveryAED
		$this->deliveryAED->LinkCustomAttributes = "";
		$this->deliveryAED->HrefValue = "";
		$this->deliveryAED->TooltipValue = "";

		// so
		$this->so->LinkCustomAttributes = "";
		$this->so->HrefValue = "";
		$this->so->TooltipValue = "";

		// active
		$this->active->LinkCustomAttributes = "";
		$this->active->HrefValue = "";
		$this->active->TooltipValue = "";

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

		// leaseCarID
		$this->leaseCarID->EditAttrs["class"] = "form-control";
		$this->leaseCarID->EditCustomAttributes = "";
		$this->leaseCarID->EditValue = $this->leaseCarID->CurrentValue;
		$this->leaseCarID->ViewCustomAttributes = "";

		// makeID
		$this->makeID->EditAttrs["class"] = "form-control";
		$this->makeID->EditCustomAttributes = "";

		// modelID
		$this->modelID->EditAttrs["class"] = "form-control";
		$this->modelID->EditCustomAttributes = "";

		// bodyTypeID
		$this->bodyTypeID->EditAttrs["class"] = "form-control";
		$this->bodyTypeID->EditCustomAttributes = "";

		// slug
		$this->slug->EditAttrs["class"] = "form-control";
		$this->slug->EditCustomAttributes = "";
		$this->slug->EditValue = $this->slug->CurrentValue;
		$this->slug->PlaceHolder = ew_RemoveHtml($this->slug->FldCaption());

		// image
		$this->image->EditAttrs["class"] = "form-control";
		$this->image->EditCustomAttributes = "";
		$this->image->UploadPath = 'uploads/rentlease';
		if (!ew_Empty($this->image->Upload->DbValue)) {
			$this->image->ImageWidth = 100;
			$this->image->ImageHeight = 0;
			$this->image->ImageAlt = $this->image->FldAlt();
			$this->image->EditValue = $this->image->Upload->DbValue;
		} else {
			$this->image->EditValue = "";
		}
		if (!ew_Empty($this->image->CurrentValue))
				$this->image->Upload->FileName = $this->image->CurrentValue;

		// extraFeatures
		$this->extraFeatures->EditCustomAttributes = "";

		// noOfSeats
		$this->noOfSeats->EditAttrs["class"] = "form-control";
		$this->noOfSeats->EditCustomAttributes = "";
		$this->noOfSeats->EditValue = $this->noOfSeats->CurrentValue;
		$this->noOfSeats->PlaceHolder = ew_RemoveHtml($this->noOfSeats->FldCaption());

		// luggage
		$this->luggage->EditAttrs["class"] = "form-control";
		$this->luggage->EditCustomAttributes = "";
		$this->luggage->EditValue = $this->luggage->CurrentValue;
		$this->luggage->PlaceHolder = ew_RemoveHtml($this->luggage->FldCaption());

		// transmissionID
		$this->transmissionID->EditAttrs["class"] = "form-control";
		$this->transmissionID->EditCustomAttributes = "";

		// ac
		$this->ac->EditCustomAttributes = "";
		$this->ac->EditValue = $this->ac->Options(FALSE);

		// noOfDoors
		$this->noOfDoors->EditAttrs["class"] = "form-control";
		$this->noOfDoors->EditCustomAttributes = "";
		$this->noOfDoors->EditValue = $this->noOfDoors->CurrentValue;
		$this->noOfDoors->PlaceHolder = ew_RemoveHtml($this->noOfDoors->FldCaption());

		// monthlyAED
		$this->monthlyAED->EditAttrs["class"] = "form-control";
		$this->monthlyAED->EditCustomAttributes = "";
		$this->monthlyAED->EditValue = $this->monthlyAED->CurrentValue;
		$this->monthlyAED->PlaceHolder = ew_RemoveHtml($this->monthlyAED->FldCaption());
		if (strval($this->monthlyAED->EditValue) <> "" && is_numeric($this->monthlyAED->EditValue)) $this->monthlyAED->EditValue = ew_FormatNumber($this->monthlyAED->EditValue, -2, -1, -2, 0);

		// deliveryAED
		$this->deliveryAED->EditAttrs["class"] = "form-control";
		$this->deliveryAED->EditCustomAttributes = "";
		$this->deliveryAED->EditValue = $this->deliveryAED->CurrentValue;
		$this->deliveryAED->PlaceHolder = ew_RemoveHtml($this->deliveryAED->FldCaption());
		if (strval($this->deliveryAED->EditValue) <> "" && is_numeric($this->deliveryAED->EditValue)) $this->deliveryAED->EditValue = ew_FormatNumber($this->deliveryAED->EditValue, -2, -1, -2, 0);

		// so
		$this->so->EditAttrs["class"] = "form-control";
		$this->so->EditCustomAttributes = "";
		$this->so->EditValue = $this->so->CurrentValue;
		$this->so->PlaceHolder = ew_RemoveHtml($this->so->FldCaption());

		// active
		$this->active->EditAttrs["class"] = "form-control";
		$this->active->EditCustomAttributes = "";
		$this->active->EditValue = $this->active->Options(TRUE);

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
					if ($this->leaseCarID->Exportable) $Doc->ExportCaption($this->leaseCarID);
					if ($this->makeID->Exportable) $Doc->ExportCaption($this->makeID);
					if ($this->modelID->Exportable) $Doc->ExportCaption($this->modelID);
					if ($this->bodyTypeID->Exportable) $Doc->ExportCaption($this->bodyTypeID);
					if ($this->slug->Exportable) $Doc->ExportCaption($this->slug);
					if ($this->image->Exportable) $Doc->ExportCaption($this->image);
					if ($this->extraFeatures->Exportable) $Doc->ExportCaption($this->extraFeatures);
					if ($this->noOfSeats->Exportable) $Doc->ExportCaption($this->noOfSeats);
					if ($this->luggage->Exportable) $Doc->ExportCaption($this->luggage);
					if ($this->transmissionID->Exportable) $Doc->ExportCaption($this->transmissionID);
					if ($this->ac->Exportable) $Doc->ExportCaption($this->ac);
					if ($this->noOfDoors->Exportable) $Doc->ExportCaption($this->noOfDoors);
					if ($this->monthlyAED->Exportable) $Doc->ExportCaption($this->monthlyAED);
					if ($this->deliveryAED->Exportable) $Doc->ExportCaption($this->deliveryAED);
					if ($this->so->Exportable) $Doc->ExportCaption($this->so);
					if ($this->active->Exportable) $Doc->ExportCaption($this->active);
				} else {
					if ($this->leaseCarID->Exportable) $Doc->ExportCaption($this->leaseCarID);
					if ($this->makeID->Exportable) $Doc->ExportCaption($this->makeID);
					if ($this->modelID->Exportable) $Doc->ExportCaption($this->modelID);
					if ($this->bodyTypeID->Exportable) $Doc->ExportCaption($this->bodyTypeID);
					if ($this->slug->Exportable) $Doc->ExportCaption($this->slug);
					if ($this->image->Exportable) $Doc->ExportCaption($this->image);
					if ($this->extraFeatures->Exportable) $Doc->ExportCaption($this->extraFeatures);
					if ($this->noOfSeats->Exportable) $Doc->ExportCaption($this->noOfSeats);
					if ($this->luggage->Exportable) $Doc->ExportCaption($this->luggage);
					if ($this->transmissionID->Exportable) $Doc->ExportCaption($this->transmissionID);
					if ($this->ac->Exportable) $Doc->ExportCaption($this->ac);
					if ($this->noOfDoors->Exportable) $Doc->ExportCaption($this->noOfDoors);
					if ($this->monthlyAED->Exportable) $Doc->ExportCaption($this->monthlyAED);
					if ($this->deliveryAED->Exportable) $Doc->ExportCaption($this->deliveryAED);
					if ($this->so->Exportable) $Doc->ExportCaption($this->so);
					if ($this->active->Exportable) $Doc->ExportCaption($this->active);
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
						if ($this->leaseCarID->Exportable) $Doc->ExportField($this->leaseCarID);
						if ($this->makeID->Exportable) $Doc->ExportField($this->makeID);
						if ($this->modelID->Exportable) $Doc->ExportField($this->modelID);
						if ($this->bodyTypeID->Exportable) $Doc->ExportField($this->bodyTypeID);
						if ($this->slug->Exportable) $Doc->ExportField($this->slug);
						if ($this->image->Exportable) $Doc->ExportField($this->image);
						if ($this->extraFeatures->Exportable) $Doc->ExportField($this->extraFeatures);
						if ($this->noOfSeats->Exportable) $Doc->ExportField($this->noOfSeats);
						if ($this->luggage->Exportable) $Doc->ExportField($this->luggage);
						if ($this->transmissionID->Exportable) $Doc->ExportField($this->transmissionID);
						if ($this->ac->Exportable) $Doc->ExportField($this->ac);
						if ($this->noOfDoors->Exportable) $Doc->ExportField($this->noOfDoors);
						if ($this->monthlyAED->Exportable) $Doc->ExportField($this->monthlyAED);
						if ($this->deliveryAED->Exportable) $Doc->ExportField($this->deliveryAED);
						if ($this->so->Exportable) $Doc->ExportField($this->so);
						if ($this->active->Exportable) $Doc->ExportField($this->active);
					} else {
						if ($this->leaseCarID->Exportable) $Doc->ExportField($this->leaseCarID);
						if ($this->makeID->Exportable) $Doc->ExportField($this->makeID);
						if ($this->modelID->Exportable) $Doc->ExportField($this->modelID);
						if ($this->bodyTypeID->Exportable) $Doc->ExportField($this->bodyTypeID);
						if ($this->slug->Exportable) $Doc->ExportField($this->slug);
						if ($this->image->Exportable) $Doc->ExportField($this->image);
						if ($this->extraFeatures->Exportable) $Doc->ExportField($this->extraFeatures);
						if ($this->noOfSeats->Exportable) $Doc->ExportField($this->noOfSeats);
						if ($this->luggage->Exportable) $Doc->ExportField($this->luggage);
						if ($this->transmissionID->Exportable) $Doc->ExportField($this->transmissionID);
						if ($this->ac->Exportable) $Doc->ExportField($this->ac);
						if ($this->noOfDoors->Exportable) $Doc->ExportField($this->noOfDoors);
						if ($this->monthlyAED->Exportable) $Doc->ExportField($this->monthlyAED);
						if ($this->deliveryAED->Exportable) $Doc->ExportField($this->deliveryAED);
						if ($this->so->Exportable) $Doc->ExportField($this->so);
						if ($this->active->Exportable) $Doc->ExportField($this->active);
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
