<?php

// Global variable for table object
$home_apps = NULL;

//
// Table class for home_apps
//
class chome_apps extends cTable {
	var $appsID;
	var $title;
	var $subTitle;
	var $buttonIcon1;
	var $buttonLinkLabel1;
	var $buttonLink1;
	var $buttonIcon2;
	var $buttonLinkLabel2;
	var $buttonLink2;
	var $image;
	var $backgroundImage;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'home_apps';
		$this->TableName = 'home_apps';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`home_apps`";
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

		// appsID
		$this->appsID = new cField('home_apps', 'home_apps', 'x_appsID', 'appsID', '`appsID`', '`appsID`', 3, -1, FALSE, '`appsID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->appsID->Sortable = TRUE; // Allow sort
		$this->appsID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['appsID'] = &$this->appsID;

		// title
		$this->title = new cField('home_apps', 'home_apps', 'x_title', 'title', '`title`', '`title`', 200, -1, FALSE, '`title`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->title->Sortable = TRUE; // Allow sort
		$this->fields['title'] = &$this->title;

		// subTitle
		$this->subTitle = new cField('home_apps', 'home_apps', 'x_subTitle', 'subTitle', '`subTitle`', '`subTitle`', 200, -1, FALSE, '`subTitle`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->subTitle->Sortable = TRUE; // Allow sort
		$this->fields['subTitle'] = &$this->subTitle;

		// buttonIcon1
		$this->buttonIcon1 = new cField('home_apps', 'home_apps', 'x_buttonIcon1', 'buttonIcon1', '`buttonIcon1`', '`buttonIcon1`', 200, -1, TRUE, '`buttonIcon1`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->buttonIcon1->Sortable = TRUE; // Allow sort
		$this->fields['buttonIcon1'] = &$this->buttonIcon1;

		// buttonLinkLabel1
		$this->buttonLinkLabel1 = new cField('home_apps', 'home_apps', 'x_buttonLinkLabel1', 'buttonLinkLabel1', '`buttonLinkLabel1`', '`buttonLinkLabel1`', 200, -1, FALSE, '`buttonLinkLabel1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->buttonLinkLabel1->Sortable = TRUE; // Allow sort
		$this->fields['buttonLinkLabel1'] = &$this->buttonLinkLabel1;

		// buttonLink1
		$this->buttonLink1 = new cField('home_apps', 'home_apps', 'x_buttonLink1', 'buttonLink1', '`buttonLink1`', '`buttonLink1`', 200, -1, FALSE, '`buttonLink1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->buttonLink1->Sortable = TRUE; // Allow sort
		$this->fields['buttonLink1'] = &$this->buttonLink1;

		// buttonIcon2
		$this->buttonIcon2 = new cField('home_apps', 'home_apps', 'x_buttonIcon2', 'buttonIcon2', '`buttonIcon2`', '`buttonIcon2`', 200, -1, TRUE, '`buttonIcon2`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->buttonIcon2->Sortable = TRUE; // Allow sort
		$this->fields['buttonIcon2'] = &$this->buttonIcon2;

		// buttonLinkLabel2
		$this->buttonLinkLabel2 = new cField('home_apps', 'home_apps', 'x_buttonLinkLabel2', 'buttonLinkLabel2', '`buttonLinkLabel2`', '`buttonLinkLabel2`', 200, -1, FALSE, '`buttonLinkLabel2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->buttonLinkLabel2->Sortable = TRUE; // Allow sort
		$this->fields['buttonLinkLabel2'] = &$this->buttonLinkLabel2;

		// buttonLink2
		$this->buttonLink2 = new cField('home_apps', 'home_apps', 'x_buttonLink2', 'buttonLink2', '`buttonLink2`', '`buttonLink2`', 200, -1, FALSE, '`buttonLink2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->buttonLink2->Sortable = TRUE; // Allow sort
		$this->fields['buttonLink2'] = &$this->buttonLink2;

		// image
		$this->image = new cField('home_apps', 'home_apps', 'x_image', 'image', '`image`', '`image`', 200, -1, TRUE, '`image`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->image->Sortable = TRUE; // Allow sort
		$this->fields['image'] = &$this->image;

		// backgroundImage
		$this->backgroundImage = new cField('home_apps', 'home_apps', 'x_backgroundImage', 'backgroundImage', '`backgroundImage`', '`backgroundImage`', 200, -1, TRUE, '`backgroundImage`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->backgroundImage->Sortable = TRUE; // Allow sort
		$this->fields['backgroundImage'] = &$this->backgroundImage;
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`home_apps`";
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
			$this->appsID->setDbValue($conn->Insert_ID());
			$rs['appsID'] = $this->appsID->DbValue;
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
			if (array_key_exists('appsID', $rs))
				ew_AddFilter($where, ew_QuotedName('appsID', $this->DBID) . '=' . ew_QuotedValue($rs['appsID'], $this->appsID->FldDataType, $this->DBID));
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
		return "`appsID` = @appsID@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->appsID->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->appsID->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@appsID@", ew_AdjustSql($this->appsID->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "home_appslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "home_appsview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "home_appsedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "home_appsadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "home_appslist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("home_appsview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("home_appsview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "home_appsadd.php?" . $this->UrlParm($parm);
		else
			$url = "home_appsadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("home_appsedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("home_appsadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("home_appsdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "appsID:" . ew_VarToJson($this->appsID->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->appsID->CurrentValue)) {
			$sUrl .= "appsID=" . urlencode($this->appsID->CurrentValue);
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
			if ($isPost && isset($_POST["appsID"]))
				$arKeys[] = $_POST["appsID"];
			elseif (isset($_GET["appsID"]))
				$arKeys[] = $_GET["appsID"];
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
			$this->appsID->CurrentValue = $key;
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
		$this->appsID->setDbValue($rs->fields('appsID'));
		$this->title->setDbValue($rs->fields('title'));
		$this->subTitle->setDbValue($rs->fields('subTitle'));
		$this->buttonIcon1->Upload->DbValue = $rs->fields('buttonIcon1');
		$this->buttonLinkLabel1->setDbValue($rs->fields('buttonLinkLabel1'));
		$this->buttonLink1->setDbValue($rs->fields('buttonLink1'));
		$this->buttonIcon2->Upload->DbValue = $rs->fields('buttonIcon2');
		$this->buttonLinkLabel2->setDbValue($rs->fields('buttonLinkLabel2'));
		$this->buttonLink2->setDbValue($rs->fields('buttonLink2'));
		$this->image->Upload->DbValue = $rs->fields('image');
		$this->backgroundImage->Upload->DbValue = $rs->fields('backgroundImage');
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// appsID
		// title
		// subTitle
		// buttonIcon1
		// buttonLinkLabel1
		// buttonLink1
		// buttonIcon2
		// buttonLinkLabel2
		// buttonLink2
		// image
		// backgroundImage
		// appsID

		$this->appsID->ViewValue = $this->appsID->CurrentValue;
		$this->appsID->ViewCustomAttributes = "";

		// title
		$this->title->ViewValue = $this->title->CurrentValue;
		$this->title->ViewCustomAttributes = "";

		// subTitle
		$this->subTitle->ViewValue = $this->subTitle->CurrentValue;
		$this->subTitle->ViewCustomAttributes = "";

		// buttonIcon1
		$this->buttonIcon1->UploadPath = 'uploads/pages';
		if (!ew_Empty($this->buttonIcon1->Upload->DbValue)) {
			$this->buttonIcon1->ImageWidth = 50;
			$this->buttonIcon1->ImageHeight = 0;
			$this->buttonIcon1->ImageAlt = $this->buttonIcon1->FldAlt();
			$this->buttonIcon1->ViewValue = $this->buttonIcon1->Upload->DbValue;
		} else {
			$this->buttonIcon1->ViewValue = "";
		}
		$this->buttonIcon1->ViewCustomAttributes = "";

		// buttonLinkLabel1
		$this->buttonLinkLabel1->ViewValue = $this->buttonLinkLabel1->CurrentValue;
		$this->buttonLinkLabel1->ViewCustomAttributes = "";

		// buttonLink1
		$this->buttonLink1->ViewValue = $this->buttonLink1->CurrentValue;
		$this->buttonLink1->ViewCustomAttributes = "";

		// buttonIcon2
		$this->buttonIcon2->UploadPath = 'uploads/pages';
		if (!ew_Empty($this->buttonIcon2->Upload->DbValue)) {
			$this->buttonIcon2->ImageWidth = 50;
			$this->buttonIcon2->ImageHeight = 0;
			$this->buttonIcon2->ImageAlt = $this->buttonIcon2->FldAlt();
			$this->buttonIcon2->ViewValue = $this->buttonIcon2->Upload->DbValue;
		} else {
			$this->buttonIcon2->ViewValue = "";
		}
		$this->buttonIcon2->ViewCustomAttributes = "";

		// buttonLinkLabel2
		$this->buttonLinkLabel2->ViewValue = $this->buttonLinkLabel2->CurrentValue;
		$this->buttonLinkLabel2->ViewCustomAttributes = "";

		// buttonLink2
		$this->buttonLink2->ViewValue = $this->buttonLink2->CurrentValue;
		$this->buttonLink2->ViewCustomAttributes = "";

		// image
		$this->image->UploadPath = 'uploads/pages';
		if (!ew_Empty($this->image->Upload->DbValue)) {
			$this->image->ImageWidth = 100;
			$this->image->ImageHeight = 0;
			$this->image->ImageAlt = $this->image->FldAlt();
			$this->image->ViewValue = $this->image->Upload->DbValue;
		} else {
			$this->image->ViewValue = "";
		}
		$this->image->ViewCustomAttributes = "";

		// backgroundImage
		$this->backgroundImage->UploadPath = 'uploads/pages';
		if (!ew_Empty($this->backgroundImage->Upload->DbValue)) {
			$this->backgroundImage->ImageWidth = 100;
			$this->backgroundImage->ImageHeight = 0;
			$this->backgroundImage->ImageAlt = $this->backgroundImage->FldAlt();
			$this->backgroundImage->ViewValue = $this->backgroundImage->Upload->DbValue;
		} else {
			$this->backgroundImage->ViewValue = "";
		}
		$this->backgroundImage->ViewCustomAttributes = "";

		// appsID
		$this->appsID->LinkCustomAttributes = "";
		$this->appsID->HrefValue = "";
		$this->appsID->TooltipValue = "";

		// title
		$this->title->LinkCustomAttributes = "";
		$this->title->HrefValue = "";
		$this->title->TooltipValue = "";

		// subTitle
		$this->subTitle->LinkCustomAttributes = "";
		$this->subTitle->HrefValue = "";
		$this->subTitle->TooltipValue = "";

		// buttonIcon1
		$this->buttonIcon1->LinkCustomAttributes = "";
		$this->buttonIcon1->UploadPath = 'uploads/pages';
		if (!ew_Empty($this->buttonIcon1->Upload->DbValue)) {
			$this->buttonIcon1->HrefValue = ew_GetFileUploadUrl($this->buttonIcon1, $this->buttonIcon1->Upload->DbValue); // Add prefix/suffix
			$this->buttonIcon1->LinkAttrs["target"] = ""; // Add target
			if ($this->Export <> "") $this->buttonIcon1->HrefValue = ew_FullUrl($this->buttonIcon1->HrefValue, "href");
		} else {
			$this->buttonIcon1->HrefValue = "";
		}
		$this->buttonIcon1->HrefValue2 = $this->buttonIcon1->UploadPath . $this->buttonIcon1->Upload->DbValue;
		$this->buttonIcon1->TooltipValue = "";
		if ($this->buttonIcon1->UseColorbox) {
			if (ew_Empty($this->buttonIcon1->TooltipValue))
				$this->buttonIcon1->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
			$this->buttonIcon1->LinkAttrs["data-rel"] = "home_apps_x_buttonIcon1";
			ew_AppendClass($this->buttonIcon1->LinkAttrs["class"], "ewLightbox");
		}

		// buttonLinkLabel1
		$this->buttonLinkLabel1->LinkCustomAttributes = "";
		$this->buttonLinkLabel1->HrefValue = "";
		$this->buttonLinkLabel1->TooltipValue = "";

		// buttonLink1
		$this->buttonLink1->LinkCustomAttributes = "";
		$this->buttonLink1->HrefValue = "";
		$this->buttonLink1->TooltipValue = "";

		// buttonIcon2
		$this->buttonIcon2->LinkCustomAttributes = "";
		$this->buttonIcon2->UploadPath = 'uploads/pages';
		if (!ew_Empty($this->buttonIcon2->Upload->DbValue)) {
			$this->buttonIcon2->HrefValue = ew_GetFileUploadUrl($this->buttonIcon2, $this->buttonIcon2->Upload->DbValue); // Add prefix/suffix
			$this->buttonIcon2->LinkAttrs["target"] = ""; // Add target
			if ($this->Export <> "") $this->buttonIcon2->HrefValue = ew_FullUrl($this->buttonIcon2->HrefValue, "href");
		} else {
			$this->buttonIcon2->HrefValue = "";
		}
		$this->buttonIcon2->HrefValue2 = $this->buttonIcon2->UploadPath . $this->buttonIcon2->Upload->DbValue;
		$this->buttonIcon2->TooltipValue = "";
		if ($this->buttonIcon2->UseColorbox) {
			if (ew_Empty($this->buttonIcon2->TooltipValue))
				$this->buttonIcon2->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
			$this->buttonIcon2->LinkAttrs["data-rel"] = "home_apps_x_buttonIcon2";
			ew_AppendClass($this->buttonIcon2->LinkAttrs["class"], "ewLightbox");
		}

		// buttonLinkLabel2
		$this->buttonLinkLabel2->LinkCustomAttributes = "";
		$this->buttonLinkLabel2->HrefValue = "";
		$this->buttonLinkLabel2->TooltipValue = "";

		// buttonLink2
		$this->buttonLink2->LinkCustomAttributes = "";
		$this->buttonLink2->HrefValue = "";
		$this->buttonLink2->TooltipValue = "";

		// image
		$this->image->LinkCustomAttributes = "";
		$this->image->UploadPath = 'uploads/pages';
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
			$this->image->LinkAttrs["data-rel"] = "home_apps_x_image";
			ew_AppendClass($this->image->LinkAttrs["class"], "ewLightbox");
		}

		// backgroundImage
		$this->backgroundImage->LinkCustomAttributes = "";
		$this->backgroundImage->UploadPath = 'uploads/pages';
		if (!ew_Empty($this->backgroundImage->Upload->DbValue)) {
			$this->backgroundImage->HrefValue = ew_GetFileUploadUrl($this->backgroundImage, $this->backgroundImage->Upload->DbValue); // Add prefix/suffix
			$this->backgroundImage->LinkAttrs["target"] = ""; // Add target
			if ($this->Export <> "") $this->backgroundImage->HrefValue = ew_FullUrl($this->backgroundImage->HrefValue, "href");
		} else {
			$this->backgroundImage->HrefValue = "";
		}
		$this->backgroundImage->HrefValue2 = $this->backgroundImage->UploadPath . $this->backgroundImage->Upload->DbValue;
		$this->backgroundImage->TooltipValue = "";
		if ($this->backgroundImage->UseColorbox) {
			if (ew_Empty($this->backgroundImage->TooltipValue))
				$this->backgroundImage->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
			$this->backgroundImage->LinkAttrs["data-rel"] = "home_apps_x_backgroundImage";
			ew_AppendClass($this->backgroundImage->LinkAttrs["class"], "ewLightbox");
		}

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

		// appsID
		$this->appsID->EditAttrs["class"] = "form-control";
		$this->appsID->EditCustomAttributes = "";
		$this->appsID->EditValue = $this->appsID->CurrentValue;
		$this->appsID->ViewCustomAttributes = "";

		// title
		$this->title->EditAttrs["class"] = "form-control";
		$this->title->EditCustomAttributes = "";
		$this->title->EditValue = $this->title->CurrentValue;
		$this->title->PlaceHolder = ew_RemoveHtml($this->title->FldCaption());

		// subTitle
		$this->subTitle->EditAttrs["class"] = "form-control";
		$this->subTitle->EditCustomAttributes = "";
		$this->subTitle->EditValue = $this->subTitle->CurrentValue;
		$this->subTitle->PlaceHolder = ew_RemoveHtml($this->subTitle->FldCaption());

		// buttonIcon1
		$this->buttonIcon1->EditAttrs["class"] = "form-control";
		$this->buttonIcon1->EditCustomAttributes = "";
		$this->buttonIcon1->UploadPath = 'uploads/pages';
		if (!ew_Empty($this->buttonIcon1->Upload->DbValue)) {
			$this->buttonIcon1->ImageWidth = 50;
			$this->buttonIcon1->ImageHeight = 0;
			$this->buttonIcon1->ImageAlt = $this->buttonIcon1->FldAlt();
			$this->buttonIcon1->EditValue = $this->buttonIcon1->Upload->DbValue;
		} else {
			$this->buttonIcon1->EditValue = "";
		}
		if (!ew_Empty($this->buttonIcon1->CurrentValue))
				$this->buttonIcon1->Upload->FileName = $this->buttonIcon1->CurrentValue;

		// buttonLinkLabel1
		$this->buttonLinkLabel1->EditAttrs["class"] = "form-control";
		$this->buttonLinkLabel1->EditCustomAttributes = "";
		$this->buttonLinkLabel1->EditValue = $this->buttonLinkLabel1->CurrentValue;
		$this->buttonLinkLabel1->PlaceHolder = ew_RemoveHtml($this->buttonLinkLabel1->FldCaption());

		// buttonLink1
		$this->buttonLink1->EditAttrs["class"] = "form-control";
		$this->buttonLink1->EditCustomAttributes = "";
		$this->buttonLink1->EditValue = $this->buttonLink1->CurrentValue;
		$this->buttonLink1->PlaceHolder = ew_RemoveHtml($this->buttonLink1->FldCaption());

		// buttonIcon2
		$this->buttonIcon2->EditAttrs["class"] = "form-control";
		$this->buttonIcon2->EditCustomAttributes = "";
		$this->buttonIcon2->UploadPath = 'uploads/pages';
		if (!ew_Empty($this->buttonIcon2->Upload->DbValue)) {
			$this->buttonIcon2->ImageWidth = 50;
			$this->buttonIcon2->ImageHeight = 0;
			$this->buttonIcon2->ImageAlt = $this->buttonIcon2->FldAlt();
			$this->buttonIcon2->EditValue = $this->buttonIcon2->Upload->DbValue;
		} else {
			$this->buttonIcon2->EditValue = "";
		}
		if (!ew_Empty($this->buttonIcon2->CurrentValue))
				$this->buttonIcon2->Upload->FileName = $this->buttonIcon2->CurrentValue;

		// buttonLinkLabel2
		$this->buttonLinkLabel2->EditAttrs["class"] = "form-control";
		$this->buttonLinkLabel2->EditCustomAttributes = "";
		$this->buttonLinkLabel2->EditValue = $this->buttonLinkLabel2->CurrentValue;
		$this->buttonLinkLabel2->PlaceHolder = ew_RemoveHtml($this->buttonLinkLabel2->FldCaption());

		// buttonLink2
		$this->buttonLink2->EditAttrs["class"] = "form-control";
		$this->buttonLink2->EditCustomAttributes = "";
		$this->buttonLink2->EditValue = $this->buttonLink2->CurrentValue;
		$this->buttonLink2->PlaceHolder = ew_RemoveHtml($this->buttonLink2->FldCaption());

		// image
		$this->image->EditAttrs["class"] = "form-control";
		$this->image->EditCustomAttributes = "";
		$this->image->UploadPath = 'uploads/pages';
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

		// backgroundImage
		$this->backgroundImage->EditAttrs["class"] = "form-control";
		$this->backgroundImage->EditCustomAttributes = "";
		$this->backgroundImage->UploadPath = 'uploads/pages';
		if (!ew_Empty($this->backgroundImage->Upload->DbValue)) {
			$this->backgroundImage->ImageWidth = 100;
			$this->backgroundImage->ImageHeight = 0;
			$this->backgroundImage->ImageAlt = $this->backgroundImage->FldAlt();
			$this->backgroundImage->EditValue = $this->backgroundImage->Upload->DbValue;
		} else {
			$this->backgroundImage->EditValue = "";
		}
		if (!ew_Empty($this->backgroundImage->CurrentValue))
				$this->backgroundImage->Upload->FileName = $this->backgroundImage->CurrentValue;

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
					if ($this->appsID->Exportable) $Doc->ExportCaption($this->appsID);
					if ($this->title->Exportable) $Doc->ExportCaption($this->title);
					if ($this->subTitle->Exportable) $Doc->ExportCaption($this->subTitle);
					if ($this->buttonIcon1->Exportable) $Doc->ExportCaption($this->buttonIcon1);
					if ($this->buttonLinkLabel1->Exportable) $Doc->ExportCaption($this->buttonLinkLabel1);
					if ($this->buttonLink1->Exportable) $Doc->ExportCaption($this->buttonLink1);
					if ($this->buttonIcon2->Exportable) $Doc->ExportCaption($this->buttonIcon2);
					if ($this->buttonLinkLabel2->Exportable) $Doc->ExportCaption($this->buttonLinkLabel2);
					if ($this->buttonLink2->Exportable) $Doc->ExportCaption($this->buttonLink2);
					if ($this->image->Exportable) $Doc->ExportCaption($this->image);
					if ($this->backgroundImage->Exportable) $Doc->ExportCaption($this->backgroundImage);
				} else {
					if ($this->appsID->Exportable) $Doc->ExportCaption($this->appsID);
					if ($this->title->Exportable) $Doc->ExportCaption($this->title);
					if ($this->subTitle->Exportable) $Doc->ExportCaption($this->subTitle);
					if ($this->buttonIcon1->Exportable) $Doc->ExportCaption($this->buttonIcon1);
					if ($this->buttonLinkLabel1->Exportable) $Doc->ExportCaption($this->buttonLinkLabel1);
					if ($this->buttonLink1->Exportable) $Doc->ExportCaption($this->buttonLink1);
					if ($this->buttonIcon2->Exportable) $Doc->ExportCaption($this->buttonIcon2);
					if ($this->buttonLinkLabel2->Exportable) $Doc->ExportCaption($this->buttonLinkLabel2);
					if ($this->buttonLink2->Exportable) $Doc->ExportCaption($this->buttonLink2);
					if ($this->image->Exportable) $Doc->ExportCaption($this->image);
					if ($this->backgroundImage->Exportable) $Doc->ExportCaption($this->backgroundImage);
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
						if ($this->appsID->Exportable) $Doc->ExportField($this->appsID);
						if ($this->title->Exportable) $Doc->ExportField($this->title);
						if ($this->subTitle->Exportable) $Doc->ExportField($this->subTitle);
						if ($this->buttonIcon1->Exportable) $Doc->ExportField($this->buttonIcon1);
						if ($this->buttonLinkLabel1->Exportable) $Doc->ExportField($this->buttonLinkLabel1);
						if ($this->buttonLink1->Exportable) $Doc->ExportField($this->buttonLink1);
						if ($this->buttonIcon2->Exportable) $Doc->ExportField($this->buttonIcon2);
						if ($this->buttonLinkLabel2->Exportable) $Doc->ExportField($this->buttonLinkLabel2);
						if ($this->buttonLink2->Exportable) $Doc->ExportField($this->buttonLink2);
						if ($this->image->Exportable) $Doc->ExportField($this->image);
						if ($this->backgroundImage->Exportable) $Doc->ExportField($this->backgroundImage);
					} else {
						if ($this->appsID->Exportable) $Doc->ExportField($this->appsID);
						if ($this->title->Exportable) $Doc->ExportField($this->title);
						if ($this->subTitle->Exportable) $Doc->ExportField($this->subTitle);
						if ($this->buttonIcon1->Exportable) $Doc->ExportField($this->buttonIcon1);
						if ($this->buttonLinkLabel1->Exportable) $Doc->ExportField($this->buttonLinkLabel1);
						if ($this->buttonLink1->Exportable) $Doc->ExportField($this->buttonLink1);
						if ($this->buttonIcon2->Exportable) $Doc->ExportField($this->buttonIcon2);
						if ($this->buttonLinkLabel2->Exportable) $Doc->ExportField($this->buttonLinkLabel2);
						if ($this->buttonLink2->Exportable) $Doc->ExportField($this->buttonLink2);
						if ($this->image->Exportable) $Doc->ExportField($this->image);
						if ($this->backgroundImage->Exportable) $Doc->ExportField($this->backgroundImage);
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
