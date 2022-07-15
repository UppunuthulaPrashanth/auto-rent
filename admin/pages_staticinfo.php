<?php

// Global variable for table object
$pages_static = NULL;

//
// Table class for pages_static
//
class cpages_static extends cTable {
	var $_pageID;
	var $pageTitle;
	var $subTitle;
	var $headerBG;
	var $summary;
	var $image;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'pages_static';
		$this->TableName = 'pages_static';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`pages_static`";
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

		// pageID
		$this->_pageID = new cField('pages_static', 'pages_static', 'x__pageID', 'pageID', '`pageID`', '`pageID`', 3, -1, FALSE, '`pageID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->_pageID->Sortable = TRUE; // Allow sort
		$this->_pageID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['pageID'] = &$this->_pageID;

		// pageTitle
		$this->pageTitle = new cField('pages_static', 'pages_static', 'x_pageTitle', 'pageTitle', '`pageTitle`', '`pageTitle`', 200, -1, FALSE, '`pageTitle`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pageTitle->Sortable = TRUE; // Allow sort
		$this->fields['pageTitle'] = &$this->pageTitle;

		// subTitle
		$this->subTitle = new cField('pages_static', 'pages_static', 'x_subTitle', 'subTitle', '`subTitle`', '`subTitle`', 200, -1, FALSE, '`subTitle`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->subTitle->Sortable = TRUE; // Allow sort
		$this->fields['subTitle'] = &$this->subTitle;

		// headerBG
		$this->headerBG = new cField('pages_static', 'pages_static', 'x_headerBG', 'headerBG', '`headerBG`', '`headerBG`', 200, -1, TRUE, '`headerBG`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->headerBG->Sortable = TRUE; // Allow sort
		$this->fields['headerBG'] = &$this->headerBG;

		// summary
		$this->summary = new cField('pages_static', 'pages_static', 'x_summary', 'summary', '`summary`', '`summary`', 201, -1, FALSE, '`summary`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->summary->Sortable = TRUE; // Allow sort
		$this->fields['summary'] = &$this->summary;

		// image
		$this->image = new cField('pages_static', 'pages_static', 'x_image', 'image', '`image`', '`image`', 200, -1, FALSE, '`image`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->image->Sortable = TRUE; // Allow sort
		$this->fields['image'] = &$this->image;
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`pages_static`";
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
			$this->_pageID->setDbValue($conn->Insert_ID());
			$rs['pageID'] = $this->_pageID->DbValue;
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
			if (array_key_exists('pageID', $rs))
				ew_AddFilter($where, ew_QuotedName('pageID', $this->DBID) . '=' . ew_QuotedValue($rs['pageID'], $this->_pageID->FldDataType, $this->DBID));
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
		return "`pageID` = @_pageID@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->_pageID->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->_pageID->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@_pageID@", ew_AdjustSql($this->_pageID->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "pages_staticlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "pages_staticview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "pages_staticedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "pages_staticadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "pages_staticlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("pages_staticview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("pages_staticview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "pages_staticadd.php?" . $this->UrlParm($parm);
		else
			$url = "pages_staticadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("pages_staticedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("pages_staticadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("pages_staticdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "_pageID:" . ew_VarToJson($this->_pageID->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->_pageID->CurrentValue)) {
			$sUrl .= "_pageID=" . urlencode($this->_pageID->CurrentValue);
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
			if ($isPost && isset($_POST["_pageID"]))
				$arKeys[] = $_POST["_pageID"];
			elseif (isset($_GET["_pageID"]))
				$arKeys[] = $_GET["_pageID"];
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
			$this->_pageID->CurrentValue = $key;
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
		$this->_pageID->setDbValue($rs->fields('pageID'));
		$this->pageTitle->setDbValue($rs->fields('pageTitle'));
		$this->subTitle->setDbValue($rs->fields('subTitle'));
		$this->headerBG->Upload->DbValue = $rs->fields('headerBG');
		$this->summary->setDbValue($rs->fields('summary'));
		$this->image->setDbValue($rs->fields('image'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// pageID
		// pageTitle
		// subTitle
		// headerBG
		// summary
		// image
		// pageID

		$this->_pageID->ViewValue = $this->_pageID->CurrentValue;
		$this->_pageID->ViewCustomAttributes = "";

		// pageTitle
		$this->pageTitle->ViewValue = $this->pageTitle->CurrentValue;
		$this->pageTitle->ViewCustomAttributes = "";

		// subTitle
		$this->subTitle->ViewValue = $this->subTitle->CurrentValue;
		$this->subTitle->ViewCustomAttributes = "";

		// headerBG
		$this->headerBG->UploadPath = 'uploads/pages';
		if (!ew_Empty($this->headerBG->Upload->DbValue)) {
			$this->headerBG->ImageWidth = 100;
			$this->headerBG->ImageHeight = 0;
			$this->headerBG->ImageAlt = $this->headerBG->FldAlt();
			$this->headerBG->ViewValue = $this->headerBG->Upload->DbValue;
		} else {
			$this->headerBG->ViewValue = "";
		}
		$this->headerBG->ViewCustomAttributes = "";

		// summary
		$this->summary->ViewValue = $this->summary->CurrentValue;
		$this->summary->ViewCustomAttributes = "";

		// image
		$this->image->ViewValue = $this->image->CurrentValue;
		$this->image->ViewCustomAttributes = "";

		// pageID
		$this->_pageID->LinkCustomAttributes = "";
		$this->_pageID->HrefValue = "";
		$this->_pageID->TooltipValue = "";

		// pageTitle
		$this->pageTitle->LinkCustomAttributes = "";
		$this->pageTitle->HrefValue = "";
		$this->pageTitle->TooltipValue = "";

		// subTitle
		$this->subTitle->LinkCustomAttributes = "";
		$this->subTitle->HrefValue = "";
		$this->subTitle->TooltipValue = "";

		// headerBG
		$this->headerBG->LinkCustomAttributes = "";
		$this->headerBG->UploadPath = 'uploads/pages';
		if (!ew_Empty($this->headerBG->Upload->DbValue)) {
			$this->headerBG->HrefValue = ew_GetFileUploadUrl($this->headerBG, $this->headerBG->Upload->DbValue); // Add prefix/suffix
			$this->headerBG->LinkAttrs["target"] = ""; // Add target
			if ($this->Export <> "") $this->headerBG->HrefValue = ew_FullUrl($this->headerBG->HrefValue, "href");
		} else {
			$this->headerBG->HrefValue = "";
		}
		$this->headerBG->HrefValue2 = $this->headerBG->UploadPath . $this->headerBG->Upload->DbValue;
		$this->headerBG->TooltipValue = "";
		if ($this->headerBG->UseColorbox) {
			if (ew_Empty($this->headerBG->TooltipValue))
				$this->headerBG->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
			$this->headerBG->LinkAttrs["data-rel"] = "pages_static_x_headerBG";
			ew_AppendClass($this->headerBG->LinkAttrs["class"], "ewLightbox");
		}

		// summary
		$this->summary->LinkCustomAttributes = "";
		$this->summary->HrefValue = "";
		$this->summary->TooltipValue = "";

		// image
		$this->image->LinkCustomAttributes = "";
		$this->image->HrefValue = "";
		$this->image->TooltipValue = "";

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

		// pageID
		$this->_pageID->EditAttrs["class"] = "form-control";
		$this->_pageID->EditCustomAttributes = "";
		$this->_pageID->EditValue = $this->_pageID->CurrentValue;
		$this->_pageID->ViewCustomAttributes = "";

		// pageTitle
		$this->pageTitle->EditAttrs["class"] = "form-control";
		$this->pageTitle->EditCustomAttributes = "";
		$this->pageTitle->EditValue = $this->pageTitle->CurrentValue;
		$this->pageTitle->PlaceHolder = ew_RemoveHtml($this->pageTitle->FldCaption());

		// subTitle
		$this->subTitle->EditAttrs["class"] = "form-control";
		$this->subTitle->EditCustomAttributes = "";
		$this->subTitle->EditValue = $this->subTitle->CurrentValue;
		$this->subTitle->PlaceHolder = ew_RemoveHtml($this->subTitle->FldCaption());

		// headerBG
		$this->headerBG->EditAttrs["class"] = "form-control";
		$this->headerBG->EditCustomAttributes = "";
		$this->headerBG->UploadPath = 'uploads/pages';
		if (!ew_Empty($this->headerBG->Upload->DbValue)) {
			$this->headerBG->ImageWidth = 100;
			$this->headerBG->ImageHeight = 0;
			$this->headerBG->ImageAlt = $this->headerBG->FldAlt();
			$this->headerBG->EditValue = $this->headerBG->Upload->DbValue;
		} else {
			$this->headerBG->EditValue = "";
		}
		if (!ew_Empty($this->headerBG->CurrentValue))
				$this->headerBG->Upload->FileName = $this->headerBG->CurrentValue;

		// summary
		$this->summary->EditAttrs["class"] = "form-control";
		$this->summary->EditCustomAttributes = "";
		$this->summary->EditValue = $this->summary->CurrentValue;
		$this->summary->PlaceHolder = ew_RemoveHtml($this->summary->FldCaption());

		// image
		$this->image->EditAttrs["class"] = "form-control";
		$this->image->EditCustomAttributes = "";
		$this->image->EditValue = $this->image->CurrentValue;
		$this->image->PlaceHolder = ew_RemoveHtml($this->image->FldCaption());

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
					if ($this->_pageID->Exportable) $Doc->ExportCaption($this->_pageID);
					if ($this->pageTitle->Exportable) $Doc->ExportCaption($this->pageTitle);
					if ($this->subTitle->Exportable) $Doc->ExportCaption($this->subTitle);
					if ($this->headerBG->Exportable) $Doc->ExportCaption($this->headerBG);
					if ($this->summary->Exportable) $Doc->ExportCaption($this->summary);
					if ($this->image->Exportable) $Doc->ExportCaption($this->image);
				} else {
					if ($this->_pageID->Exportable) $Doc->ExportCaption($this->_pageID);
					if ($this->pageTitle->Exportable) $Doc->ExportCaption($this->pageTitle);
					if ($this->subTitle->Exportable) $Doc->ExportCaption($this->subTitle);
					if ($this->headerBG->Exportable) $Doc->ExportCaption($this->headerBG);
					if ($this->image->Exportable) $Doc->ExportCaption($this->image);
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
						if ($this->_pageID->Exportable) $Doc->ExportField($this->_pageID);
						if ($this->pageTitle->Exportable) $Doc->ExportField($this->pageTitle);
						if ($this->subTitle->Exportable) $Doc->ExportField($this->subTitle);
						if ($this->headerBG->Exportable) $Doc->ExportField($this->headerBG);
						if ($this->summary->Exportable) $Doc->ExportField($this->summary);
						if ($this->image->Exportable) $Doc->ExportField($this->image);
					} else {
						if ($this->_pageID->Exportable) $Doc->ExportField($this->_pageID);
						if ($this->pageTitle->Exportable) $Doc->ExportField($this->pageTitle);
						if ($this->subTitle->Exportable) $Doc->ExportField($this->subTitle);
						if ($this->headerBG->Exportable) $Doc->ExportField($this->headerBG);
						if ($this->image->Exportable) $Doc->ExportField($this->image);
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
