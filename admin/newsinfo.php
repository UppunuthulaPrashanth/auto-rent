<?php

// Global variable for table object
$news = NULL;

//
// Table class for news
//
class cnews extends cTable {
	var $newsID;
	var $title;
	var $slug;
	var $summary;
	var $_thumbnail;
	var $largeImage;
	var $homeImage;
	var $description;
	var $postDate;
	var $active;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'news';
		$this->TableName = 'news';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`news`";
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

		// newsID
		$this->newsID = new cField('news', 'news', 'x_newsID', 'newsID', '`newsID`', '`newsID`', 3, -1, FALSE, '`newsID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->newsID->Sortable = TRUE; // Allow sort
		$this->newsID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['newsID'] = &$this->newsID;

		// title
		$this->title = new cField('news', 'news', 'x_title', 'title', '`title`', '`title`', 200, -1, FALSE, '`title`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->title->Sortable = TRUE; // Allow sort
		$this->fields['title'] = &$this->title;

		// slug
		$this->slug = new cField('news', 'news', 'x_slug', 'slug', '`slug`', '`slug`', 200, -1, FALSE, '`slug`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->slug->Sortable = TRUE; // Allow sort
		$this->fields['slug'] = &$this->slug;

		// summary
		$this->summary = new cField('news', 'news', 'x_summary', 'summary', '`summary`', '`summary`', 200, -1, FALSE, '`summary`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->summary->Sortable = TRUE; // Allow sort
		$this->fields['summary'] = &$this->summary;

		// thumbnail
		$this->_thumbnail = new cField('news', 'news', 'x__thumbnail', 'thumbnail', '`thumbnail`', '`thumbnail`', 200, -1, TRUE, '`thumbnail`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->_thumbnail->Sortable = TRUE; // Allow sort
		$this->fields['thumbnail'] = &$this->_thumbnail;

		// largeImage
		$this->largeImage = new cField('news', 'news', 'x_largeImage', 'largeImage', '`largeImage`', '`largeImage`', 200, -1, TRUE, '`largeImage`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->largeImage->Sortable = TRUE; // Allow sort
		$this->fields['largeImage'] = &$this->largeImage;

		// homeImage
		$this->homeImage = new cField('news', 'news', 'x_homeImage', 'homeImage', '`homeImage`', '`homeImage`', 200, -1, TRUE, '`homeImage`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->homeImage->Sortable = TRUE; // Allow sort
		$this->fields['homeImage'] = &$this->homeImage;

		// description
		$this->description = new cField('news', 'news', 'x_description', 'description', '`description`', '`description`', 201, -1, FALSE, '`description`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->description->Sortable = TRUE; // Allow sort
		$this->fields['description'] = &$this->description;

		// postDate
		$this->postDate = new cField('news', 'news', 'x_postDate', 'postDate', '`postDate`', ew_CastDateFieldForLike('`postDate`', 7, "DB"), 135, 7, FALSE, '`postDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->postDate->Sortable = TRUE; // Allow sort
		$this->postDate->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['postDate'] = &$this->postDate;

		// active
		$this->active = new cField('news', 'news', 'x_active', 'active', '`active`', '`active`', 16, -1, FALSE, '`active`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`news`";
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
			$this->newsID->setDbValue($conn->Insert_ID());
			$rs['newsID'] = $this->newsID->DbValue;
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
			if (array_key_exists('newsID', $rs))
				ew_AddFilter($where, ew_QuotedName('newsID', $this->DBID) . '=' . ew_QuotedValue($rs['newsID'], $this->newsID->FldDataType, $this->DBID));
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
		return "`newsID` = @newsID@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->newsID->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->newsID->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@newsID@", ew_AdjustSql($this->newsID->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "newslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "newsview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "newsedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "newsadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "newslist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("newsview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("newsview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "newsadd.php?" . $this->UrlParm($parm);
		else
			$url = "newsadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("newsedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("newsadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("newsdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "newsID:" . ew_VarToJson($this->newsID->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->newsID->CurrentValue)) {
			$sUrl .= "newsID=" . urlencode($this->newsID->CurrentValue);
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
			if ($isPost && isset($_POST["newsID"]))
				$arKeys[] = $_POST["newsID"];
			elseif (isset($_GET["newsID"]))
				$arKeys[] = $_GET["newsID"];
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
			$this->newsID->CurrentValue = $key;
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
		$this->newsID->setDbValue($rs->fields('newsID'));
		$this->title->setDbValue($rs->fields('title'));
		$this->slug->setDbValue($rs->fields('slug'));
		$this->summary->setDbValue($rs->fields('summary'));
		$this->_thumbnail->Upload->DbValue = $rs->fields('thumbnail');
		$this->largeImage->Upload->DbValue = $rs->fields('largeImage');
		$this->homeImage->Upload->DbValue = $rs->fields('homeImage');
		$this->description->setDbValue($rs->fields('description'));
		$this->postDate->setDbValue($rs->fields('postDate'));
		$this->active->setDbValue($rs->fields('active'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// newsID
		// title
		// slug
		// summary
		// thumbnail
		// largeImage
		// homeImage
		// description
		// postDate
		// active
		// newsID

		$this->newsID->ViewValue = $this->newsID->CurrentValue;
		$this->newsID->ViewCustomAttributes = "";

		// title
		$this->title->ViewValue = $this->title->CurrentValue;
		$this->title->ViewCustomAttributes = "";

		// slug
		$this->slug->ViewValue = $this->slug->CurrentValue;
		$this->slug->ViewCustomAttributes = "";

		// summary
		$this->summary->ViewValue = $this->summary->CurrentValue;
		$this->summary->ViewCustomAttributes = "";

		// thumbnail
		$this->_thumbnail->UploadPath = 'uploads/news';
		if (!ew_Empty($this->_thumbnail->Upload->DbValue)) {
			$this->_thumbnail->ImageWidth = 100;
			$this->_thumbnail->ImageHeight = 0;
			$this->_thumbnail->ImageAlt = $this->_thumbnail->FldAlt();
			$this->_thumbnail->ViewValue = $this->_thumbnail->Upload->DbValue;
		} else {
			$this->_thumbnail->ViewValue = "";
		}
		$this->_thumbnail->ViewCustomAttributes = "";

		// largeImage
		$this->largeImage->UploadPath = 'uploads/news';
		if (!ew_Empty($this->largeImage->Upload->DbValue)) {
			$this->largeImage->ImageWidth = 100;
			$this->largeImage->ImageHeight = 0;
			$this->largeImage->ImageAlt = $this->largeImage->FldAlt();
			$this->largeImage->ViewValue = $this->largeImage->Upload->DbValue;
		} else {
			$this->largeImage->ViewValue = "";
		}
		$this->largeImage->ViewCustomAttributes = "";

		// homeImage
		$this->homeImage->UploadPath = 'uploads/news';
		if (!ew_Empty($this->homeImage->Upload->DbValue)) {
			$this->homeImage->ImageWidth = 100;
			$this->homeImage->ImageHeight = 0;
			$this->homeImage->ImageAlt = $this->homeImage->FldAlt();
			$this->homeImage->ViewValue = $this->homeImage->Upload->DbValue;
		} else {
			$this->homeImage->ViewValue = "";
		}
		$this->homeImage->ViewCustomAttributes = "";

		// description
		$this->description->ViewValue = $this->description->CurrentValue;
		$this->description->ViewCustomAttributes = "";

		// postDate
		$this->postDate->ViewValue = $this->postDate->CurrentValue;
		$this->postDate->ViewValue = ew_FormatDateTime($this->postDate->ViewValue, 7);
		$this->postDate->ViewCustomAttributes = "";

		// active
		if (strval($this->active->CurrentValue) <> "") {
			$this->active->ViewValue = $this->active->OptionCaption($this->active->CurrentValue);
		} else {
			$this->active->ViewValue = NULL;
		}
		$this->active->ViewCustomAttributes = "";

		// newsID
		$this->newsID->LinkCustomAttributes = "";
		$this->newsID->HrefValue = "";
		$this->newsID->TooltipValue = "";

		// title
		$this->title->LinkCustomAttributes = "";
		$this->title->HrefValue = "";
		$this->title->TooltipValue = "";

		// slug
		$this->slug->LinkCustomAttributes = "";
		$this->slug->HrefValue = "";
		$this->slug->TooltipValue = "";

		// summary
		$this->summary->LinkCustomAttributes = "";
		$this->summary->HrefValue = "";
		$this->summary->TooltipValue = "";

		// thumbnail
		$this->_thumbnail->LinkCustomAttributes = "";
		$this->_thumbnail->UploadPath = 'uploads/news';
		if (!ew_Empty($this->_thumbnail->Upload->DbValue)) {
			$this->_thumbnail->HrefValue = ew_GetFileUploadUrl($this->_thumbnail, $this->_thumbnail->Upload->DbValue); // Add prefix/suffix
			$this->_thumbnail->LinkAttrs["target"] = ""; // Add target
			if ($this->Export <> "") $this->_thumbnail->HrefValue = ew_FullUrl($this->_thumbnail->HrefValue, "href");
		} else {
			$this->_thumbnail->HrefValue = "";
		}
		$this->_thumbnail->HrefValue2 = $this->_thumbnail->UploadPath . $this->_thumbnail->Upload->DbValue;
		$this->_thumbnail->TooltipValue = "";
		if ($this->_thumbnail->UseColorbox) {
			if (ew_Empty($this->_thumbnail->TooltipValue))
				$this->_thumbnail->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
			$this->_thumbnail->LinkAttrs["data-rel"] = "news_x__thumbnail";
			ew_AppendClass($this->_thumbnail->LinkAttrs["class"], "ewLightbox");
		}

		// largeImage
		$this->largeImage->LinkCustomAttributes = "";
		$this->largeImage->UploadPath = 'uploads/news';
		if (!ew_Empty($this->largeImage->Upload->DbValue)) {
			$this->largeImage->HrefValue = ew_GetFileUploadUrl($this->largeImage, $this->largeImage->Upload->DbValue); // Add prefix/suffix
			$this->largeImage->LinkAttrs["target"] = ""; // Add target
			if ($this->Export <> "") $this->largeImage->HrefValue = ew_FullUrl($this->largeImage->HrefValue, "href");
		} else {
			$this->largeImage->HrefValue = "";
		}
		$this->largeImage->HrefValue2 = $this->largeImage->UploadPath . $this->largeImage->Upload->DbValue;
		$this->largeImage->TooltipValue = "";
		if ($this->largeImage->UseColorbox) {
			if (ew_Empty($this->largeImage->TooltipValue))
				$this->largeImage->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
			$this->largeImage->LinkAttrs["data-rel"] = "news_x_largeImage";
			ew_AppendClass($this->largeImage->LinkAttrs["class"], "ewLightbox");
		}

		// homeImage
		$this->homeImage->LinkCustomAttributes = "";
		$this->homeImage->UploadPath = 'uploads/news';
		if (!ew_Empty($this->homeImage->Upload->DbValue)) {
			$this->homeImage->HrefValue = ew_GetFileUploadUrl($this->homeImage, $this->homeImage->Upload->DbValue); // Add prefix/suffix
			$this->homeImage->LinkAttrs["target"] = ""; // Add target
			if ($this->Export <> "") $this->homeImage->HrefValue = ew_FullUrl($this->homeImage->HrefValue, "href");
		} else {
			$this->homeImage->HrefValue = "";
		}
		$this->homeImage->HrefValue2 = $this->homeImage->UploadPath . $this->homeImage->Upload->DbValue;
		$this->homeImage->TooltipValue = "";
		if ($this->homeImage->UseColorbox) {
			if (ew_Empty($this->homeImage->TooltipValue))
				$this->homeImage->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
			$this->homeImage->LinkAttrs["data-rel"] = "news_x_homeImage";
			ew_AppendClass($this->homeImage->LinkAttrs["class"], "ewLightbox");
		}

		// description
		$this->description->LinkCustomAttributes = "";
		$this->description->HrefValue = "";
		$this->description->TooltipValue = "";

		// postDate
		$this->postDate->LinkCustomAttributes = "";
		$this->postDate->HrefValue = "";
		$this->postDate->TooltipValue = "";

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

		// newsID
		$this->newsID->EditAttrs["class"] = "form-control";
		$this->newsID->EditCustomAttributes = "";
		$this->newsID->EditValue = $this->newsID->CurrentValue;
		$this->newsID->ViewCustomAttributes = "";

		// title
		$this->title->EditAttrs["class"] = "form-control";
		$this->title->EditCustomAttributes = "";
		$this->title->EditValue = $this->title->CurrentValue;
		$this->title->PlaceHolder = ew_RemoveHtml($this->title->FldCaption());

		// slug
		$this->slug->EditAttrs["class"] = "form-control";
		$this->slug->EditCustomAttributes = "";
		$this->slug->EditValue = $this->slug->CurrentValue;
		$this->slug->PlaceHolder = ew_RemoveHtml($this->slug->FldCaption());

		// summary
		$this->summary->EditAttrs["class"] = "form-control";
		$this->summary->EditCustomAttributes = "";
		$this->summary->EditValue = $this->summary->CurrentValue;
		$this->summary->PlaceHolder = ew_RemoveHtml($this->summary->FldCaption());

		// thumbnail
		$this->_thumbnail->EditAttrs["class"] = "form-control";
		$this->_thumbnail->EditCustomAttributes = "";
		$this->_thumbnail->UploadPath = 'uploads/news';
		if (!ew_Empty($this->_thumbnail->Upload->DbValue)) {
			$this->_thumbnail->ImageWidth = 100;
			$this->_thumbnail->ImageHeight = 0;
			$this->_thumbnail->ImageAlt = $this->_thumbnail->FldAlt();
			$this->_thumbnail->EditValue = $this->_thumbnail->Upload->DbValue;
		} else {
			$this->_thumbnail->EditValue = "";
		}
		if (!ew_Empty($this->_thumbnail->CurrentValue))
				$this->_thumbnail->Upload->FileName = $this->_thumbnail->CurrentValue;

		// largeImage
		$this->largeImage->EditAttrs["class"] = "form-control";
		$this->largeImage->EditCustomAttributes = "";
		$this->largeImage->UploadPath = 'uploads/news';
		if (!ew_Empty($this->largeImage->Upload->DbValue)) {
			$this->largeImage->ImageWidth = 100;
			$this->largeImage->ImageHeight = 0;
			$this->largeImage->ImageAlt = $this->largeImage->FldAlt();
			$this->largeImage->EditValue = $this->largeImage->Upload->DbValue;
		} else {
			$this->largeImage->EditValue = "";
		}
		if (!ew_Empty($this->largeImage->CurrentValue))
				$this->largeImage->Upload->FileName = $this->largeImage->CurrentValue;

		// homeImage
		$this->homeImage->EditAttrs["class"] = "form-control";
		$this->homeImage->EditCustomAttributes = "";
		$this->homeImage->UploadPath = 'uploads/news';
		if (!ew_Empty($this->homeImage->Upload->DbValue)) {
			$this->homeImage->ImageWidth = 100;
			$this->homeImage->ImageHeight = 0;
			$this->homeImage->ImageAlt = $this->homeImage->FldAlt();
			$this->homeImage->EditValue = $this->homeImage->Upload->DbValue;
		} else {
			$this->homeImage->EditValue = "";
		}
		if (!ew_Empty($this->homeImage->CurrentValue))
				$this->homeImage->Upload->FileName = $this->homeImage->CurrentValue;

		// description
		$this->description->EditAttrs["class"] = "form-control";
		$this->description->EditCustomAttributes = "";
		$this->description->EditValue = $this->description->CurrentValue;
		$this->description->PlaceHolder = ew_RemoveHtml($this->description->FldCaption());

		// postDate
		$this->postDate->EditAttrs["class"] = "form-control";
		$this->postDate->EditCustomAttributes = "";
		$this->postDate->EditValue = ew_FormatDateTime($this->postDate->CurrentValue, 7);
		$this->postDate->PlaceHolder = ew_RemoveHtml($this->postDate->FldCaption());

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
					if ($this->newsID->Exportable) $Doc->ExportCaption($this->newsID);
					if ($this->title->Exportable) $Doc->ExportCaption($this->title);
					if ($this->slug->Exportable) $Doc->ExportCaption($this->slug);
					if ($this->summary->Exportable) $Doc->ExportCaption($this->summary);
					if ($this->_thumbnail->Exportable) $Doc->ExportCaption($this->_thumbnail);
					if ($this->largeImage->Exportable) $Doc->ExportCaption($this->largeImage);
					if ($this->homeImage->Exportable) $Doc->ExportCaption($this->homeImage);
					if ($this->description->Exportable) $Doc->ExportCaption($this->description);
					if ($this->postDate->Exportable) $Doc->ExportCaption($this->postDate);
					if ($this->active->Exportable) $Doc->ExportCaption($this->active);
				} else {
					if ($this->newsID->Exportable) $Doc->ExportCaption($this->newsID);
					if ($this->title->Exportable) $Doc->ExportCaption($this->title);
					if ($this->slug->Exportable) $Doc->ExportCaption($this->slug);
					if ($this->summary->Exportable) $Doc->ExportCaption($this->summary);
					if ($this->_thumbnail->Exportable) $Doc->ExportCaption($this->_thumbnail);
					if ($this->largeImage->Exportable) $Doc->ExportCaption($this->largeImage);
					if ($this->homeImage->Exportable) $Doc->ExportCaption($this->homeImage);
					if ($this->postDate->Exportable) $Doc->ExportCaption($this->postDate);
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
						if ($this->newsID->Exportable) $Doc->ExportField($this->newsID);
						if ($this->title->Exportable) $Doc->ExportField($this->title);
						if ($this->slug->Exportable) $Doc->ExportField($this->slug);
						if ($this->summary->Exportable) $Doc->ExportField($this->summary);
						if ($this->_thumbnail->Exportable) $Doc->ExportField($this->_thumbnail);
						if ($this->largeImage->Exportable) $Doc->ExportField($this->largeImage);
						if ($this->homeImage->Exportable) $Doc->ExportField($this->homeImage);
						if ($this->description->Exportable) $Doc->ExportField($this->description);
						if ($this->postDate->Exportable) $Doc->ExportField($this->postDate);
						if ($this->active->Exportable) $Doc->ExportField($this->active);
					} else {
						if ($this->newsID->Exportable) $Doc->ExportField($this->newsID);
						if ($this->title->Exportable) $Doc->ExportField($this->title);
						if ($this->slug->Exportable) $Doc->ExportField($this->slug);
						if ($this->summary->Exportable) $Doc->ExportField($this->summary);
						if ($this->_thumbnail->Exportable) $Doc->ExportField($this->_thumbnail);
						if ($this->largeImage->Exportable) $Doc->ExportField($this->largeImage);
						if ($this->homeImage->Exportable) $Doc->ExportField($this->homeImage);
						if ($this->postDate->Exportable) $Doc->ExportField($this->postDate);
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
