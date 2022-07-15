<?php

// Global variable for table object
$rental_guide = NULL;

//
// Table class for rental_guide
//
class crental_guide extends cTable {
	var $rentalGuideID;
	var $title;
	var $subTitle;
	var $slug;
	var $image;
	var $headerImage;
	var $description;
	var $so;
	var $active;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'rental_guide';
		$this->TableName = 'rental_guide';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`rental_guide`";
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

		// rentalGuideID
		$this->rentalGuideID = new cField('rental_guide', 'rental_guide', 'x_rentalGuideID', 'rentalGuideID', '`rentalGuideID`', '`rentalGuideID`', 3, -1, FALSE, '`rentalGuideID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->rentalGuideID->Sortable = TRUE; // Allow sort
		$this->rentalGuideID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['rentalGuideID'] = &$this->rentalGuideID;

		// title
		$this->title = new cField('rental_guide', 'rental_guide', 'x_title', 'title', '`title`', '`title`', 200, -1, FALSE, '`title`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->title->Sortable = TRUE; // Allow sort
		$this->fields['title'] = &$this->title;

		// subTitle
		$this->subTitle = new cField('rental_guide', 'rental_guide', 'x_subTitle', 'subTitle', '`subTitle`', '`subTitle`', 200, -1, FALSE, '`subTitle`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->subTitle->Sortable = TRUE; // Allow sort
		$this->fields['subTitle'] = &$this->subTitle;

		// slug
		$this->slug = new cField('rental_guide', 'rental_guide', 'x_slug', 'slug', '`slug`', '`slug`', 200, -1, FALSE, '`slug`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->slug->Sortable = TRUE; // Allow sort
		$this->fields['slug'] = &$this->slug;

		// image
		$this->image = new cField('rental_guide', 'rental_guide', 'x_image', 'image', '`image`', '`image`', 200, -1, TRUE, '`image`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->image->Sortable = TRUE; // Allow sort
		$this->fields['image'] = &$this->image;

		// headerImage
		$this->headerImage = new cField('rental_guide', 'rental_guide', 'x_headerImage', 'headerImage', '`headerImage`', '`headerImage`', 200, -1, TRUE, '`headerImage`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->headerImage->Sortable = TRUE; // Allow sort
		$this->fields['headerImage'] = &$this->headerImage;

		// description
		$this->description = new cField('rental_guide', 'rental_guide', 'x_description', 'description', '`description`', '`description`', 201, -1, FALSE, '`description`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->description->Sortable = TRUE; // Allow sort
		$this->fields['description'] = &$this->description;

		// so
		$this->so = new cField('rental_guide', 'rental_guide', 'x_so', 'so', '`so`', '`so`', 16, -1, FALSE, '`so`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->so->Sortable = TRUE; // Allow sort
		$this->so->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['so'] = &$this->so;

		// active
		$this->active = new cField('rental_guide', 'rental_guide', 'x_active', 'active', '`active`', '`active`', 16, -1, FALSE, '`active`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`rental_guide`";
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
			$this->rentalGuideID->setDbValue($conn->Insert_ID());
			$rs['rentalGuideID'] = $this->rentalGuideID->DbValue;
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
			if (array_key_exists('rentalGuideID', $rs))
				ew_AddFilter($where, ew_QuotedName('rentalGuideID', $this->DBID) . '=' . ew_QuotedValue($rs['rentalGuideID'], $this->rentalGuideID->FldDataType, $this->DBID));
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
		return "`rentalGuideID` = @rentalGuideID@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->rentalGuideID->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->rentalGuideID->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@rentalGuideID@", ew_AdjustSql($this->rentalGuideID->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "rental_guidelist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "rental_guideview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "rental_guideedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "rental_guideadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "rental_guidelist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("rental_guideview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("rental_guideview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "rental_guideadd.php?" . $this->UrlParm($parm);
		else
			$url = "rental_guideadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("rental_guideedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("rental_guideadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("rental_guidedelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "rentalGuideID:" . ew_VarToJson($this->rentalGuideID->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->rentalGuideID->CurrentValue)) {
			$sUrl .= "rentalGuideID=" . urlencode($this->rentalGuideID->CurrentValue);
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
			if ($isPost && isset($_POST["rentalGuideID"]))
				$arKeys[] = $_POST["rentalGuideID"];
			elseif (isset($_GET["rentalGuideID"]))
				$arKeys[] = $_GET["rentalGuideID"];
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
			$this->rentalGuideID->CurrentValue = $key;
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
		$this->rentalGuideID->setDbValue($rs->fields('rentalGuideID'));
		$this->title->setDbValue($rs->fields('title'));
		$this->subTitle->setDbValue($rs->fields('subTitle'));
		$this->slug->setDbValue($rs->fields('slug'));
		$this->image->Upload->DbValue = $rs->fields('image');
		$this->headerImage->Upload->DbValue = $rs->fields('headerImage');
		$this->description->setDbValue($rs->fields('description'));
		$this->so->setDbValue($rs->fields('so'));
		$this->active->setDbValue($rs->fields('active'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// rentalGuideID
		// title
		// subTitle
		// slug
		// image
		// headerImage
		// description
		// so
		// active
		// rentalGuideID

		$this->rentalGuideID->ViewValue = $this->rentalGuideID->CurrentValue;
		$this->rentalGuideID->ViewCustomAttributes = "";

		// title
		$this->title->ViewValue = $this->title->CurrentValue;
		$this->title->ViewCustomAttributes = "";

		// subTitle
		$this->subTitle->ViewValue = $this->subTitle->CurrentValue;
		$this->subTitle->ViewCustomAttributes = "";

		// slug
		$this->slug->ViewValue = $this->slug->CurrentValue;
		$this->slug->ViewCustomAttributes = "";

		// image
		$this->image->UploadPath = 'uploads/rental_guide';
		if (!ew_Empty($this->image->Upload->DbValue)) {
			$this->image->ImageWidth = 100;
			$this->image->ImageHeight = 0;
			$this->image->ImageAlt = $this->image->FldAlt();
			$this->image->ViewValue = $this->image->Upload->DbValue;
		} else {
			$this->image->ViewValue = "";
		}
		$this->image->ViewCustomAttributes = "";

		// headerImage
		$this->headerImage->UploadPath = 'uploads/rental_guide';
		if (!ew_Empty($this->headerImage->Upload->DbValue)) {
			$this->headerImage->ImageWidth = 100;
			$this->headerImage->ImageHeight = 0;
			$this->headerImage->ImageAlt = $this->headerImage->FldAlt();
			$this->headerImage->ViewValue = $this->headerImage->Upload->DbValue;
		} else {
			$this->headerImage->ViewValue = "";
		}
		$this->headerImage->ViewCustomAttributes = "";

		// description
		$this->description->ViewValue = $this->description->CurrentValue;
		$this->description->ViewCustomAttributes = "";

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

		// rentalGuideID
		$this->rentalGuideID->LinkCustomAttributes = "";
		$this->rentalGuideID->HrefValue = "";
		$this->rentalGuideID->TooltipValue = "";

		// title
		$this->title->LinkCustomAttributes = "";
		$this->title->HrefValue = "";
		$this->title->TooltipValue = "";

		// subTitle
		$this->subTitle->LinkCustomAttributes = "";
		$this->subTitle->HrefValue = "";
		$this->subTitle->TooltipValue = "";

		// slug
		$this->slug->LinkCustomAttributes = "";
		$this->slug->HrefValue = "";
		$this->slug->TooltipValue = "";

		// image
		$this->image->LinkCustomAttributes = "";
		$this->image->UploadPath = 'uploads/rental_guide';
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
			$this->image->LinkAttrs["data-rel"] = "rental_guide_x_image";
			ew_AppendClass($this->image->LinkAttrs["class"], "ewLightbox");
		}

		// headerImage
		$this->headerImage->LinkCustomAttributes = "";
		$this->headerImage->UploadPath = 'uploads/rental_guide';
		if (!ew_Empty($this->headerImage->Upload->DbValue)) {
			$this->headerImage->HrefValue = ew_GetFileUploadUrl($this->headerImage, $this->headerImage->Upload->DbValue); // Add prefix/suffix
			$this->headerImage->LinkAttrs["target"] = ""; // Add target
			if ($this->Export <> "") $this->headerImage->HrefValue = ew_FullUrl($this->headerImage->HrefValue, "href");
		} else {
			$this->headerImage->HrefValue = "";
		}
		$this->headerImage->HrefValue2 = $this->headerImage->UploadPath . $this->headerImage->Upload->DbValue;
		$this->headerImage->TooltipValue = "";
		if ($this->headerImage->UseColorbox) {
			if (ew_Empty($this->headerImage->TooltipValue))
				$this->headerImage->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
			$this->headerImage->LinkAttrs["data-rel"] = "rental_guide_x_headerImage";
			ew_AppendClass($this->headerImage->LinkAttrs["class"], "ewLightbox");
		}

		// description
		$this->description->LinkCustomAttributes = "";
		$this->description->HrefValue = "";
		$this->description->TooltipValue = "";

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

		// rentalGuideID
		$this->rentalGuideID->EditAttrs["class"] = "form-control";
		$this->rentalGuideID->EditCustomAttributes = "";
		$this->rentalGuideID->EditValue = $this->rentalGuideID->CurrentValue;
		$this->rentalGuideID->ViewCustomAttributes = "";

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

		// slug
		$this->slug->EditAttrs["class"] = "form-control";
		$this->slug->EditCustomAttributes = "";
		$this->slug->EditValue = $this->slug->CurrentValue;
		$this->slug->PlaceHolder = ew_RemoveHtml($this->slug->FldCaption());

		// image
		$this->image->EditAttrs["class"] = "form-control";
		$this->image->EditCustomAttributes = "";
		$this->image->UploadPath = 'uploads/rental_guide';
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

		// headerImage
		$this->headerImage->EditAttrs["class"] = "form-control";
		$this->headerImage->EditCustomAttributes = "";
		$this->headerImage->UploadPath = 'uploads/rental_guide';
		if (!ew_Empty($this->headerImage->Upload->DbValue)) {
			$this->headerImage->ImageWidth = 100;
			$this->headerImage->ImageHeight = 0;
			$this->headerImage->ImageAlt = $this->headerImage->FldAlt();
			$this->headerImage->EditValue = $this->headerImage->Upload->DbValue;
		} else {
			$this->headerImage->EditValue = "";
		}
		if (!ew_Empty($this->headerImage->CurrentValue))
				$this->headerImage->Upload->FileName = $this->headerImage->CurrentValue;

		// description
		$this->description->EditAttrs["class"] = "form-control";
		$this->description->EditCustomAttributes = "";
		$this->description->EditValue = $this->description->CurrentValue;
		$this->description->PlaceHolder = ew_RemoveHtml($this->description->FldCaption());

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
					if ($this->rentalGuideID->Exportable) $Doc->ExportCaption($this->rentalGuideID);
					if ($this->title->Exportable) $Doc->ExportCaption($this->title);
					if ($this->subTitle->Exportable) $Doc->ExportCaption($this->subTitle);
					if ($this->slug->Exportable) $Doc->ExportCaption($this->slug);
					if ($this->image->Exportable) $Doc->ExportCaption($this->image);
					if ($this->headerImage->Exportable) $Doc->ExportCaption($this->headerImage);
					if ($this->description->Exportable) $Doc->ExportCaption($this->description);
					if ($this->so->Exportable) $Doc->ExportCaption($this->so);
					if ($this->active->Exportable) $Doc->ExportCaption($this->active);
				} else {
					if ($this->rentalGuideID->Exportable) $Doc->ExportCaption($this->rentalGuideID);
					if ($this->title->Exportable) $Doc->ExportCaption($this->title);
					if ($this->subTitle->Exportable) $Doc->ExportCaption($this->subTitle);
					if ($this->slug->Exportable) $Doc->ExportCaption($this->slug);
					if ($this->image->Exportable) $Doc->ExportCaption($this->image);
					if ($this->headerImage->Exportable) $Doc->ExportCaption($this->headerImage);
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
						if ($this->rentalGuideID->Exportable) $Doc->ExportField($this->rentalGuideID);
						if ($this->title->Exportable) $Doc->ExportField($this->title);
						if ($this->subTitle->Exportable) $Doc->ExportField($this->subTitle);
						if ($this->slug->Exportable) $Doc->ExportField($this->slug);
						if ($this->image->Exportable) $Doc->ExportField($this->image);
						if ($this->headerImage->Exportable) $Doc->ExportField($this->headerImage);
						if ($this->description->Exportable) $Doc->ExportField($this->description);
						if ($this->so->Exportable) $Doc->ExportField($this->so);
						if ($this->active->Exportable) $Doc->ExportField($this->active);
					} else {
						if ($this->rentalGuideID->Exportable) $Doc->ExportField($this->rentalGuideID);
						if ($this->title->Exportable) $Doc->ExportField($this->title);
						if ($this->subTitle->Exportable) $Doc->ExportField($this->subTitle);
						if ($this->slug->Exportable) $Doc->ExportField($this->slug);
						if ($this->image->Exportable) $Doc->ExportField($this->image);
						if ($this->headerImage->Exportable) $Doc->ExportField($this->headerImage);
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
