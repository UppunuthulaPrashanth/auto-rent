<?php

// Global variable for table object
$users = NULL;

//
// Table class for users
//
class cusers extends cTable {
	var $_userID;
	var $firstName;
	var $lastName;
	var $emailID;
	var $mobileNo;
	var $country;
	var $city;
	var $nationality;
	var $address;
	var $state;
	var $pincode;
	var $emiratesID;
	var $visaStatus;
	var $licenseNumber;
	var $licenseExpiry;
	var $licensePlaceOfIssue;
	var $licenseAttachment;
	var $passportNumber;
	var $passportExpiry;
	var $passportPlaceOfIssue;
	var $passportAttachment;
	var $signUpNewsletter;
	var $password;
	var $currentCurrency;
	var $currentLanguage;
	var $createdDate;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'users';
		$this->TableName = 'users';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`users`";
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

		// userID
		$this->_userID = new cField('users', 'users', 'x__userID', 'userID', '`userID`', '`userID`', 3, -1, FALSE, '`userID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->_userID->Sortable = TRUE; // Allow sort
		$this->_userID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['userID'] = &$this->_userID;

		// firstName
		$this->firstName = new cField('users', 'users', 'x_firstName', 'firstName', '`firstName`', '`firstName`', 200, -1, FALSE, '`firstName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->firstName->Sortable = TRUE; // Allow sort
		$this->fields['firstName'] = &$this->firstName;

		// lastName
		$this->lastName = new cField('users', 'users', 'x_lastName', 'lastName', '`lastName`', '`lastName`', 200, -1, FALSE, '`lastName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->lastName->Sortable = TRUE; // Allow sort
		$this->fields['lastName'] = &$this->lastName;

		// emailID
		$this->emailID = new cField('users', 'users', 'x_emailID', 'emailID', '`emailID`', '`emailID`', 200, -1, FALSE, '`emailID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->emailID->Sortable = TRUE; // Allow sort
		$this->fields['emailID'] = &$this->emailID;

		// mobileNo
		$this->mobileNo = new cField('users', 'users', 'x_mobileNo', 'mobileNo', '`mobileNo`', '`mobileNo`', 200, -1, FALSE, '`mobileNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->mobileNo->Sortable = TRUE; // Allow sort
		$this->mobileNo->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['mobileNo'] = &$this->mobileNo;

		// country
		$this->country = new cField('users', 'users', 'x_country', 'country', '`country`', '`country`', 200, -1, FALSE, '`country`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->country->Sortable = TRUE; // Allow sort
		$this->fields['country'] = &$this->country;

		// city
		$this->city = new cField('users', 'users', 'x_city', 'city', '`city`', '`city`', 200, -1, FALSE, '`city`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->city->Sortable = TRUE; // Allow sort
		$this->fields['city'] = &$this->city;

		// nationality
		$this->nationality = new cField('users', 'users', 'x_nationality', 'nationality', '`nationality`', '`nationality`', 3, -1, FALSE, '`nationality`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->nationality->Sortable = TRUE; // Allow sort
		$this->nationality->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->nationality->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->nationality->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['nationality'] = &$this->nationality;

		// address
		$this->address = new cField('users', 'users', 'x_address', 'address', '`address`', '`address`', 200, -1, FALSE, '`address`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->address->Sortable = TRUE; // Allow sort
		$this->fields['address'] = &$this->address;

		// state
		$this->state = new cField('users', 'users', 'x_state', 'state', '`state`', '`state`', 200, -1, FALSE, '`state`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->state->Sortable = TRUE; // Allow sort
		$this->fields['state'] = &$this->state;

		// pincode
		$this->pincode = new cField('users', 'users', 'x_pincode', 'pincode', '`pincode`', '`pincode`', 200, -1, FALSE, '`pincode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pincode->Sortable = TRUE; // Allow sort
		$this->fields['pincode'] = &$this->pincode;

		// emiratesID
		$this->emiratesID = new cField('users', 'users', 'x_emiratesID', 'emiratesID', '`emiratesID`', '`emiratesID`', 200, -1, FALSE, '`emiratesID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->emiratesID->Sortable = TRUE; // Allow sort
		$this->fields['emiratesID'] = &$this->emiratesID;

		// visaStatus
		$this->visaStatus = new cField('users', 'users', 'x_visaStatus', 'visaStatus', '`visaStatus`', '`visaStatus`', 200, -1, FALSE, '`visaStatus`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->visaStatus->Sortable = TRUE; // Allow sort
		$this->fields['visaStatus'] = &$this->visaStatus;

		// licenseNumber
		$this->licenseNumber = new cField('users', 'users', 'x_licenseNumber', 'licenseNumber', '`licenseNumber`', '`licenseNumber`', 200, -1, FALSE, '`licenseNumber`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->licenseNumber->Sortable = TRUE; // Allow sort
		$this->fields['licenseNumber'] = &$this->licenseNumber;

		// licenseExpiry
		$this->licenseExpiry = new cField('users', 'users', 'x_licenseExpiry', 'licenseExpiry', '`licenseExpiry`', ew_CastDateFieldForLike('`licenseExpiry`', 7, "DB"), 133, 7, FALSE, '`licenseExpiry`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->licenseExpiry->Sortable = TRUE; // Allow sort
		$this->licenseExpiry->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['licenseExpiry'] = &$this->licenseExpiry;

		// licensePlaceOfIssue
		$this->licensePlaceOfIssue = new cField('users', 'users', 'x_licensePlaceOfIssue', 'licensePlaceOfIssue', '`licensePlaceOfIssue`', '`licensePlaceOfIssue`', 200, -1, FALSE, '`licensePlaceOfIssue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->licensePlaceOfIssue->Sortable = TRUE; // Allow sort
		$this->fields['licensePlaceOfIssue'] = &$this->licensePlaceOfIssue;

		// licenseAttachment
		$this->licenseAttachment = new cField('users', 'users', 'x_licenseAttachment', 'licenseAttachment', '`licenseAttachment`', '`licenseAttachment`', 200, -1, TRUE, '`licenseAttachment`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->licenseAttachment->Sortable = TRUE; // Allow sort
		$this->fields['licenseAttachment'] = &$this->licenseAttachment;

		// passportNumber
		$this->passportNumber = new cField('users', 'users', 'x_passportNumber', 'passportNumber', '`passportNumber`', '`passportNumber`', 200, -1, FALSE, '`passportNumber`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->passportNumber->Sortable = TRUE; // Allow sort
		$this->fields['passportNumber'] = &$this->passportNumber;

		// passportExpiry
		$this->passportExpiry = new cField('users', 'users', 'x_passportExpiry', 'passportExpiry', '`passportExpiry`', ew_CastDateFieldForLike('`passportExpiry`', 7, "DB"), 133, 7, FALSE, '`passportExpiry`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->passportExpiry->Sortable = TRUE; // Allow sort
		$this->passportExpiry->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['passportExpiry'] = &$this->passportExpiry;

		// passportPlaceOfIssue
		$this->passportPlaceOfIssue = new cField('users', 'users', 'x_passportPlaceOfIssue', 'passportPlaceOfIssue', '`passportPlaceOfIssue`', '`passportPlaceOfIssue`', 200, -1, FALSE, '`passportPlaceOfIssue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->passportPlaceOfIssue->Sortable = TRUE; // Allow sort
		$this->fields['passportPlaceOfIssue'] = &$this->passportPlaceOfIssue;

		// passportAttachment
		$this->passportAttachment = new cField('users', 'users', 'x_passportAttachment', 'passportAttachment', '`passportAttachment`', '`passportAttachment`', 200, -1, TRUE, '`passportAttachment`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->passportAttachment->Sortable = TRUE; // Allow sort
		$this->fields['passportAttachment'] = &$this->passportAttachment;

		// signUpNewsletter
		$this->signUpNewsletter = new cField('users', 'users', 'x_signUpNewsletter', 'signUpNewsletter', '`signUpNewsletter`', '`signUpNewsletter`', 3, -1, FALSE, '`signUpNewsletter`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->signUpNewsletter->Sortable = TRUE; // Allow sort
		$this->signUpNewsletter->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->signUpNewsletter->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->signUpNewsletter->OptionCount = 2;
		$this->signUpNewsletter->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['signUpNewsletter'] = &$this->signUpNewsletter;

		// password
		$this->password = new cField('users', 'users', 'x_password', 'password', '`password`', '`password`', 200, -1, FALSE, '`password`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->password->Sortable = TRUE; // Allow sort
		$this->fields['password'] = &$this->password;

		// currentCurrency
		$this->currentCurrency = new cField('users', 'users', 'x_currentCurrency', 'currentCurrency', '`currentCurrency`', '`currentCurrency`', 200, -1, FALSE, '`currentCurrency`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->currentCurrency->Sortable = TRUE; // Allow sort
		$this->fields['currentCurrency'] = &$this->currentCurrency;

		// currentLanguage
		$this->currentLanguage = new cField('users', 'users', 'x_currentLanguage', 'currentLanguage', '`currentLanguage`', '`currentLanguage`', 200, -1, FALSE, '`currentLanguage`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->currentLanguage->Sortable = TRUE; // Allow sort
		$this->fields['currentLanguage'] = &$this->currentLanguage;

		// createdDate
		$this->createdDate = new cField('users', 'users', 'x_createdDate', 'createdDate', '`createdDate`', ew_CastDateFieldForLike('`createdDate`', 7, "DB"), 135, 7, FALSE, '`createdDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->createdDate->Sortable = TRUE; // Allow sort
		$this->createdDate->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['createdDate'] = &$this->createdDate;
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`users`";
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
			$this->_userID->setDbValue($conn->Insert_ID());
			$rs['userID'] = $this->_userID->DbValue;
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
			if (array_key_exists('userID', $rs))
				ew_AddFilter($where, ew_QuotedName('userID', $this->DBID) . '=' . ew_QuotedValue($rs['userID'], $this->_userID->FldDataType, $this->DBID));
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
		return "`userID` = @_userID@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->_userID->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->_userID->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@_userID@", ew_AdjustSql($this->_userID->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "userslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "usersview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "usersedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "usersadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "userslist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("usersview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("usersview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "usersadd.php?" . $this->UrlParm($parm);
		else
			$url = "usersadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("usersedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("usersadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("usersdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "_userID:" . ew_VarToJson($this->_userID->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->_userID->CurrentValue)) {
			$sUrl .= "_userID=" . urlencode($this->_userID->CurrentValue);
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
			if ($isPost && isset($_POST["_userID"]))
				$arKeys[] = $_POST["_userID"];
			elseif (isset($_GET["_userID"]))
				$arKeys[] = $_GET["_userID"];
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
			$this->_userID->CurrentValue = $key;
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
		$this->_userID->setDbValue($rs->fields('userID'));
		$this->firstName->setDbValue($rs->fields('firstName'));
		$this->lastName->setDbValue($rs->fields('lastName'));
		$this->emailID->setDbValue($rs->fields('emailID'));
		$this->mobileNo->setDbValue($rs->fields('mobileNo'));
		$this->country->setDbValue($rs->fields('country'));
		$this->city->setDbValue($rs->fields('city'));
		$this->nationality->setDbValue($rs->fields('nationality'));
		$this->address->setDbValue($rs->fields('address'));
		$this->state->setDbValue($rs->fields('state'));
		$this->pincode->setDbValue($rs->fields('pincode'));
		$this->emiratesID->setDbValue($rs->fields('emiratesID'));
		$this->visaStatus->setDbValue($rs->fields('visaStatus'));
		$this->licenseNumber->setDbValue($rs->fields('licenseNumber'));
		$this->licenseExpiry->setDbValue($rs->fields('licenseExpiry'));
		$this->licensePlaceOfIssue->setDbValue($rs->fields('licensePlaceOfIssue'));
		$this->licenseAttachment->Upload->DbValue = $rs->fields('licenseAttachment');
		$this->passportNumber->setDbValue($rs->fields('passportNumber'));
		$this->passportExpiry->setDbValue($rs->fields('passportExpiry'));
		$this->passportPlaceOfIssue->setDbValue($rs->fields('passportPlaceOfIssue'));
		$this->passportAttachment->Upload->DbValue = $rs->fields('passportAttachment');
		$this->signUpNewsletter->setDbValue($rs->fields('signUpNewsletter'));
		$this->password->setDbValue($rs->fields('password'));
		$this->currentCurrency->setDbValue($rs->fields('currentCurrency'));
		$this->currentLanguage->setDbValue($rs->fields('currentLanguage'));
		$this->createdDate->setDbValue($rs->fields('createdDate'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// userID
		// firstName
		// lastName
		// emailID
		// mobileNo
		// country
		// city
		// nationality
		// address
		// state
		// pincode
		// emiratesID
		// visaStatus
		// licenseNumber
		// licenseExpiry
		// licensePlaceOfIssue
		// licenseAttachment
		// passportNumber
		// passportExpiry
		// passportPlaceOfIssue
		// passportAttachment
		// signUpNewsletter
		// password
		// currentCurrency
		// currentLanguage
		// createdDate
		// userID

		$this->_userID->ViewValue = $this->_userID->CurrentValue;
		$this->_userID->ViewCustomAttributes = "";

		// firstName
		$this->firstName->ViewValue = $this->firstName->CurrentValue;
		$this->firstName->ViewCustomAttributes = "";

		// lastName
		$this->lastName->ViewValue = $this->lastName->CurrentValue;
		$this->lastName->ViewCustomAttributes = "";

		// emailID
		$this->emailID->ViewValue = $this->emailID->CurrentValue;
		$this->emailID->ViewCustomAttributes = "";

		// mobileNo
		$this->mobileNo->ViewValue = $this->mobileNo->CurrentValue;
		$this->mobileNo->ViewCustomAttributes = "";

		// country
		$this->country->ViewValue = $this->country->CurrentValue;
		$this->country->ViewCustomAttributes = "";

		// city
		$this->city->ViewValue = $this->city->CurrentValue;
		$this->city->ViewCustomAttributes = "";

		// nationality
		if (strval($this->nationality->CurrentValue) <> "") {
			$sFilterWrk = "`nationalityID`" . ew_SearchString("=", $this->nationality->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `nationalityID`, `nationalityName` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_nationality`";
		$sWhereWrk = "";
		$this->nationality->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->nationality, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->nationality->ViewValue = $this->nationality->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->nationality->ViewValue = $this->nationality->CurrentValue;
			}
		} else {
			$this->nationality->ViewValue = NULL;
		}
		$this->nationality->ViewCustomAttributes = "";

		// address
		$this->address->ViewValue = $this->address->CurrentValue;
		$this->address->ViewCustomAttributes = "";

		// state
		$this->state->ViewValue = $this->state->CurrentValue;
		$this->state->ViewCustomAttributes = "";

		// pincode
		$this->pincode->ViewValue = $this->pincode->CurrentValue;
		$this->pincode->ViewCustomAttributes = "";

		// emiratesID
		$this->emiratesID->ViewValue = $this->emiratesID->CurrentValue;
		$this->emiratesID->ViewCustomAttributes = "";

		// visaStatus
		$this->visaStatus->ViewValue = $this->visaStatus->CurrentValue;
		$this->visaStatus->ViewCustomAttributes = "";

		// licenseNumber
		$this->licenseNumber->ViewValue = $this->licenseNumber->CurrentValue;
		$this->licenseNumber->ViewCustomAttributes = "";

		// licenseExpiry
		$this->licenseExpiry->ViewValue = $this->licenseExpiry->CurrentValue;
		$this->licenseExpiry->ViewValue = ew_FormatDateTime($this->licenseExpiry->ViewValue, 7);
		$this->licenseExpiry->ViewCustomAttributes = "";

		// licensePlaceOfIssue
		$this->licensePlaceOfIssue->ViewValue = $this->licensePlaceOfIssue->CurrentValue;
		$this->licensePlaceOfIssue->ViewCustomAttributes = "";

		// licenseAttachment
		$this->licenseAttachment->UploadPath = 'uploads/documents';
		if (!ew_Empty($this->licenseAttachment->Upload->DbValue)) {
			$this->licenseAttachment->ViewValue = $this->licenseAttachment->Upload->DbValue;
		} else {
			$this->licenseAttachment->ViewValue = "";
		}
		$this->licenseAttachment->ViewCustomAttributes = "";

		// passportNumber
		$this->passportNumber->ViewValue = $this->passportNumber->CurrentValue;
		$this->passportNumber->ViewCustomAttributes = "";

		// passportExpiry
		$this->passportExpiry->ViewValue = $this->passportExpiry->CurrentValue;
		$this->passportExpiry->ViewValue = ew_FormatDateTime($this->passportExpiry->ViewValue, 7);
		$this->passportExpiry->ViewCustomAttributes = "";

		// passportPlaceOfIssue
		$this->passportPlaceOfIssue->ViewValue = $this->passportPlaceOfIssue->CurrentValue;
		$this->passportPlaceOfIssue->ViewCustomAttributes = "";

		// passportAttachment
		$this->passportAttachment->UploadPath = 'uploads/documents';
		if (!ew_Empty($this->passportAttachment->Upload->DbValue)) {
			$this->passportAttachment->ViewValue = $this->passportAttachment->Upload->DbValue;
		} else {
			$this->passportAttachment->ViewValue = "";
		}
		$this->passportAttachment->ViewCustomAttributes = "";

		// signUpNewsletter
		if (strval($this->signUpNewsletter->CurrentValue) <> "") {
			$this->signUpNewsletter->ViewValue = $this->signUpNewsletter->OptionCaption($this->signUpNewsletter->CurrentValue);
		} else {
			$this->signUpNewsletter->ViewValue = NULL;
		}
		$this->signUpNewsletter->ViewCustomAttributes = "";

		// password
		$this->password->ViewValue = $this->password->CurrentValue;
		$this->password->ViewCustomAttributes = "";

		// currentCurrency
		$this->currentCurrency->ViewValue = $this->currentCurrency->CurrentValue;
		$this->currentCurrency->ViewCustomAttributes = "";

		// currentLanguage
		$this->currentLanguage->ViewValue = $this->currentLanguage->CurrentValue;
		$this->currentLanguage->ViewCustomAttributes = "";

		// createdDate
		$this->createdDate->ViewValue = $this->createdDate->CurrentValue;
		$this->createdDate->ViewValue = ew_FormatDateTime($this->createdDate->ViewValue, 7);
		$this->createdDate->ViewCustomAttributes = "";

		// userID
		$this->_userID->LinkCustomAttributes = "";
		$this->_userID->HrefValue = "";
		$this->_userID->TooltipValue = "";

		// firstName
		$this->firstName->LinkCustomAttributes = "";
		$this->firstName->HrefValue = "";
		$this->firstName->TooltipValue = "";

		// lastName
		$this->lastName->LinkCustomAttributes = "";
		$this->lastName->HrefValue = "";
		$this->lastName->TooltipValue = "";

		// emailID
		$this->emailID->LinkCustomAttributes = "";
		$this->emailID->HrefValue = "";
		$this->emailID->TooltipValue = "";

		// mobileNo
		$this->mobileNo->LinkCustomAttributes = "";
		$this->mobileNo->HrefValue = "";
		$this->mobileNo->TooltipValue = "";

		// country
		$this->country->LinkCustomAttributes = "";
		$this->country->HrefValue = "";
		$this->country->TooltipValue = "";

		// city
		$this->city->LinkCustomAttributes = "";
		$this->city->HrefValue = "";
		$this->city->TooltipValue = "";

		// nationality
		$this->nationality->LinkCustomAttributes = "";
		$this->nationality->HrefValue = "";
		$this->nationality->TooltipValue = "";

		// address
		$this->address->LinkCustomAttributes = "";
		$this->address->HrefValue = "";
		$this->address->TooltipValue = "";

		// state
		$this->state->LinkCustomAttributes = "";
		$this->state->HrefValue = "";
		$this->state->TooltipValue = "";

		// pincode
		$this->pincode->LinkCustomAttributes = "";
		$this->pincode->HrefValue = "";
		$this->pincode->TooltipValue = "";

		// emiratesID
		$this->emiratesID->LinkCustomAttributes = "";
		$this->emiratesID->HrefValue = "";
		$this->emiratesID->TooltipValue = "";

		// visaStatus
		$this->visaStatus->LinkCustomAttributes = "";
		$this->visaStatus->HrefValue = "";
		$this->visaStatus->TooltipValue = "";

		// licenseNumber
		$this->licenseNumber->LinkCustomAttributes = "";
		$this->licenseNumber->HrefValue = "";
		$this->licenseNumber->TooltipValue = "";

		// licenseExpiry
		$this->licenseExpiry->LinkCustomAttributes = "";
		$this->licenseExpiry->HrefValue = "";
		$this->licenseExpiry->TooltipValue = "";

		// licensePlaceOfIssue
		$this->licensePlaceOfIssue->LinkCustomAttributes = "";
		$this->licensePlaceOfIssue->HrefValue = "";
		$this->licensePlaceOfIssue->TooltipValue = "";

		// licenseAttachment
		$this->licenseAttachment->LinkCustomAttributes = "";
		$this->licenseAttachment->UploadPath = 'uploads/documents';
		if (!ew_Empty($this->licenseAttachment->Upload->DbValue)) {
			$this->licenseAttachment->HrefValue = ew_GetFileUploadUrl($this->licenseAttachment, $this->licenseAttachment->Upload->DbValue); // Add prefix/suffix
			$this->licenseAttachment->LinkAttrs["target"] = ""; // Add target
			if ($this->Export <> "") $this->licenseAttachment->HrefValue = ew_FullUrl($this->licenseAttachment->HrefValue, "href");
		} else {
			$this->licenseAttachment->HrefValue = "";
		}
		$this->licenseAttachment->HrefValue2 = $this->licenseAttachment->UploadPath . $this->licenseAttachment->Upload->DbValue;
		$this->licenseAttachment->TooltipValue = "";

		// passportNumber
		$this->passportNumber->LinkCustomAttributes = "";
		$this->passportNumber->HrefValue = "";
		$this->passportNumber->TooltipValue = "";

		// passportExpiry
		$this->passportExpiry->LinkCustomAttributes = "";
		$this->passportExpiry->HrefValue = "";
		$this->passportExpiry->TooltipValue = "";

		// passportPlaceOfIssue
		$this->passportPlaceOfIssue->LinkCustomAttributes = "";
		$this->passportPlaceOfIssue->HrefValue = "";
		$this->passportPlaceOfIssue->TooltipValue = "";

		// passportAttachment
		$this->passportAttachment->LinkCustomAttributes = "";
		$this->passportAttachment->UploadPath = 'uploads/documents';
		if (!ew_Empty($this->passportAttachment->Upload->DbValue)) {
			$this->passportAttachment->HrefValue = ew_GetFileUploadUrl($this->passportAttachment, $this->passportAttachment->Upload->DbValue); // Add prefix/suffix
			$this->passportAttachment->LinkAttrs["target"] = ""; // Add target
			if ($this->Export <> "") $this->passportAttachment->HrefValue = ew_FullUrl($this->passportAttachment->HrefValue, "href");
		} else {
			$this->passportAttachment->HrefValue = "";
		}
		$this->passportAttachment->HrefValue2 = $this->passportAttachment->UploadPath . $this->passportAttachment->Upload->DbValue;
		$this->passportAttachment->TooltipValue = "";

		// signUpNewsletter
		$this->signUpNewsletter->LinkCustomAttributes = "";
		$this->signUpNewsletter->HrefValue = "";
		$this->signUpNewsletter->TooltipValue = "";

		// password
		$this->password->LinkCustomAttributes = "";
		$this->password->HrefValue = "";
		$this->password->TooltipValue = "";

		// currentCurrency
		$this->currentCurrency->LinkCustomAttributes = "";
		$this->currentCurrency->HrefValue = "";
		$this->currentCurrency->TooltipValue = "";

		// currentLanguage
		$this->currentLanguage->LinkCustomAttributes = "";
		$this->currentLanguage->HrefValue = "";
		$this->currentLanguage->TooltipValue = "";

		// createdDate
		$this->createdDate->LinkCustomAttributes = "";
		$this->createdDate->HrefValue = "";
		$this->createdDate->TooltipValue = "";

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

		// userID
		$this->_userID->EditAttrs["class"] = "form-control";
		$this->_userID->EditCustomAttributes = "";
		$this->_userID->EditValue = $this->_userID->CurrentValue;
		$this->_userID->ViewCustomAttributes = "";

		// firstName
		$this->firstName->EditAttrs["class"] = "form-control";
		$this->firstName->EditCustomAttributes = "";
		$this->firstName->EditValue = $this->firstName->CurrentValue;
		$this->firstName->PlaceHolder = ew_RemoveHtml($this->firstName->FldCaption());

		// lastName
		$this->lastName->EditAttrs["class"] = "form-control";
		$this->lastName->EditCustomAttributes = "";
		$this->lastName->EditValue = $this->lastName->CurrentValue;
		$this->lastName->PlaceHolder = ew_RemoveHtml($this->lastName->FldCaption());

		// emailID
		$this->emailID->EditAttrs["class"] = "form-control";
		$this->emailID->EditCustomAttributes = "";
		$this->emailID->EditValue = $this->emailID->CurrentValue;
		$this->emailID->PlaceHolder = ew_RemoveHtml($this->emailID->FldCaption());

		// mobileNo
		$this->mobileNo->EditAttrs["class"] = "form-control";
		$this->mobileNo->EditCustomAttributes = "";
		$this->mobileNo->EditValue = $this->mobileNo->CurrentValue;
		$this->mobileNo->PlaceHolder = ew_RemoveHtml($this->mobileNo->FldCaption());

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

		// nationality
		$this->nationality->EditAttrs["class"] = "form-control";
		$this->nationality->EditCustomAttributes = "";

		// address
		$this->address->EditAttrs["class"] = "form-control";
		$this->address->EditCustomAttributes = "";
		$this->address->EditValue = $this->address->CurrentValue;
		$this->address->PlaceHolder = ew_RemoveHtml($this->address->FldCaption());

		// state
		$this->state->EditAttrs["class"] = "form-control";
		$this->state->EditCustomAttributes = "";
		$this->state->EditValue = $this->state->CurrentValue;
		$this->state->PlaceHolder = ew_RemoveHtml($this->state->FldCaption());

		// pincode
		$this->pincode->EditAttrs["class"] = "form-control";
		$this->pincode->EditCustomAttributes = "";
		$this->pincode->EditValue = $this->pincode->CurrentValue;
		$this->pincode->PlaceHolder = ew_RemoveHtml($this->pincode->FldCaption());

		// emiratesID
		$this->emiratesID->EditAttrs["class"] = "form-control";
		$this->emiratesID->EditCustomAttributes = "";
		$this->emiratesID->EditValue = $this->emiratesID->CurrentValue;
		$this->emiratesID->PlaceHolder = ew_RemoveHtml($this->emiratesID->FldCaption());

		// visaStatus
		$this->visaStatus->EditAttrs["class"] = "form-control";
		$this->visaStatus->EditCustomAttributes = "";
		$this->visaStatus->EditValue = $this->visaStatus->CurrentValue;
		$this->visaStatus->PlaceHolder = ew_RemoveHtml($this->visaStatus->FldCaption());

		// licenseNumber
		$this->licenseNumber->EditAttrs["class"] = "form-control";
		$this->licenseNumber->EditCustomAttributes = "";
		$this->licenseNumber->EditValue = $this->licenseNumber->CurrentValue;
		$this->licenseNumber->PlaceHolder = ew_RemoveHtml($this->licenseNumber->FldCaption());

		// licenseExpiry
		$this->licenseExpiry->EditAttrs["class"] = "form-control";
		$this->licenseExpiry->EditCustomAttributes = "";
		$this->licenseExpiry->EditValue = ew_FormatDateTime($this->licenseExpiry->CurrentValue, 7);
		$this->licenseExpiry->PlaceHolder = ew_RemoveHtml($this->licenseExpiry->FldCaption());

		// licensePlaceOfIssue
		$this->licensePlaceOfIssue->EditAttrs["class"] = "form-control";
		$this->licensePlaceOfIssue->EditCustomAttributes = "";
		$this->licensePlaceOfIssue->EditValue = $this->licensePlaceOfIssue->CurrentValue;
		$this->licensePlaceOfIssue->PlaceHolder = ew_RemoveHtml($this->licensePlaceOfIssue->FldCaption());

		// licenseAttachment
		$this->licenseAttachment->EditAttrs["class"] = "form-control";
		$this->licenseAttachment->EditCustomAttributes = "";
		$this->licenseAttachment->UploadPath = 'uploads/documents';
		if (!ew_Empty($this->licenseAttachment->Upload->DbValue)) {
			$this->licenseAttachment->EditValue = $this->licenseAttachment->Upload->DbValue;
		} else {
			$this->licenseAttachment->EditValue = "";
		}
		if (!ew_Empty($this->licenseAttachment->CurrentValue))
				$this->licenseAttachment->Upload->FileName = $this->licenseAttachment->CurrentValue;

		// passportNumber
		$this->passportNumber->EditAttrs["class"] = "form-control";
		$this->passportNumber->EditCustomAttributes = "";
		$this->passportNumber->EditValue = $this->passportNumber->CurrentValue;
		$this->passportNumber->PlaceHolder = ew_RemoveHtml($this->passportNumber->FldCaption());

		// passportExpiry
		$this->passportExpiry->EditAttrs["class"] = "form-control";
		$this->passportExpiry->EditCustomAttributes = "";
		$this->passportExpiry->EditValue = ew_FormatDateTime($this->passportExpiry->CurrentValue, 7);
		$this->passportExpiry->PlaceHolder = ew_RemoveHtml($this->passportExpiry->FldCaption());

		// passportPlaceOfIssue
		$this->passportPlaceOfIssue->EditAttrs["class"] = "form-control";
		$this->passportPlaceOfIssue->EditCustomAttributes = "";
		$this->passportPlaceOfIssue->EditValue = $this->passportPlaceOfIssue->CurrentValue;
		$this->passportPlaceOfIssue->PlaceHolder = ew_RemoveHtml($this->passportPlaceOfIssue->FldCaption());

		// passportAttachment
		$this->passportAttachment->EditAttrs["class"] = "form-control";
		$this->passportAttachment->EditCustomAttributes = "";
		$this->passportAttachment->UploadPath = 'uploads/documents';
		if (!ew_Empty($this->passportAttachment->Upload->DbValue)) {
			$this->passportAttachment->EditValue = $this->passportAttachment->Upload->DbValue;
		} else {
			$this->passportAttachment->EditValue = "";
		}
		if (!ew_Empty($this->passportAttachment->CurrentValue))
				$this->passportAttachment->Upload->FileName = $this->passportAttachment->CurrentValue;

		// signUpNewsletter
		$this->signUpNewsletter->EditAttrs["class"] = "form-control";
		$this->signUpNewsletter->EditCustomAttributes = "";
		$this->signUpNewsletter->EditValue = $this->signUpNewsletter->Options(TRUE);

		// password
		$this->password->EditAttrs["class"] = "form-control";
		$this->password->EditCustomAttributes = "";
		$this->password->EditValue = $this->password->CurrentValue;
		$this->password->PlaceHolder = ew_RemoveHtml($this->password->FldCaption());

		// currentCurrency
		$this->currentCurrency->EditAttrs["class"] = "form-control";
		$this->currentCurrency->EditCustomAttributes = "";
		$this->currentCurrency->EditValue = $this->currentCurrency->CurrentValue;
		$this->currentCurrency->PlaceHolder = ew_RemoveHtml($this->currentCurrency->FldCaption());

		// currentLanguage
		$this->currentLanguage->EditAttrs["class"] = "form-control";
		$this->currentLanguage->EditCustomAttributes = "";
		$this->currentLanguage->EditValue = $this->currentLanguage->CurrentValue;
		$this->currentLanguage->PlaceHolder = ew_RemoveHtml($this->currentLanguage->FldCaption());

		// createdDate
		$this->createdDate->EditAttrs["class"] = "form-control";
		$this->createdDate->EditCustomAttributes = "";
		$this->createdDate->EditValue = ew_FormatDateTime($this->createdDate->CurrentValue, 7);
		$this->createdDate->PlaceHolder = ew_RemoveHtml($this->createdDate->FldCaption());

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
					if ($this->_userID->Exportable) $Doc->ExportCaption($this->_userID);
					if ($this->firstName->Exportable) $Doc->ExportCaption($this->firstName);
					if ($this->lastName->Exportable) $Doc->ExportCaption($this->lastName);
					if ($this->emailID->Exportable) $Doc->ExportCaption($this->emailID);
					if ($this->mobileNo->Exportable) $Doc->ExportCaption($this->mobileNo);
					if ($this->country->Exportable) $Doc->ExportCaption($this->country);
					if ($this->city->Exportable) $Doc->ExportCaption($this->city);
					if ($this->nationality->Exportable) $Doc->ExportCaption($this->nationality);
					if ($this->address->Exportable) $Doc->ExportCaption($this->address);
					if ($this->state->Exportable) $Doc->ExportCaption($this->state);
					if ($this->pincode->Exportable) $Doc->ExportCaption($this->pincode);
					if ($this->emiratesID->Exportable) $Doc->ExportCaption($this->emiratesID);
					if ($this->visaStatus->Exportable) $Doc->ExportCaption($this->visaStatus);
					if ($this->licenseNumber->Exportable) $Doc->ExportCaption($this->licenseNumber);
					if ($this->licenseExpiry->Exportable) $Doc->ExportCaption($this->licenseExpiry);
					if ($this->licensePlaceOfIssue->Exportable) $Doc->ExportCaption($this->licensePlaceOfIssue);
					if ($this->licenseAttachment->Exportable) $Doc->ExportCaption($this->licenseAttachment);
					if ($this->passportNumber->Exportable) $Doc->ExportCaption($this->passportNumber);
					if ($this->passportExpiry->Exportable) $Doc->ExportCaption($this->passportExpiry);
					if ($this->passportPlaceOfIssue->Exportable) $Doc->ExportCaption($this->passportPlaceOfIssue);
					if ($this->passportAttachment->Exportable) $Doc->ExportCaption($this->passportAttachment);
					if ($this->signUpNewsletter->Exportable) $Doc->ExportCaption($this->signUpNewsletter);
					if ($this->password->Exportable) $Doc->ExportCaption($this->password);
					if ($this->currentCurrency->Exportable) $Doc->ExportCaption($this->currentCurrency);
					if ($this->currentLanguage->Exportable) $Doc->ExportCaption($this->currentLanguage);
					if ($this->createdDate->Exportable) $Doc->ExportCaption($this->createdDate);
				} else {
					if ($this->_userID->Exportable) $Doc->ExportCaption($this->_userID);
					if ($this->firstName->Exportable) $Doc->ExportCaption($this->firstName);
					if ($this->lastName->Exportable) $Doc->ExportCaption($this->lastName);
					if ($this->emailID->Exportable) $Doc->ExportCaption($this->emailID);
					if ($this->mobileNo->Exportable) $Doc->ExportCaption($this->mobileNo);
					if ($this->country->Exportable) $Doc->ExportCaption($this->country);
					if ($this->city->Exportable) $Doc->ExportCaption($this->city);
					if ($this->nationality->Exportable) $Doc->ExportCaption($this->nationality);
					if ($this->address->Exportable) $Doc->ExportCaption($this->address);
					if ($this->state->Exportable) $Doc->ExportCaption($this->state);
					if ($this->pincode->Exportable) $Doc->ExportCaption($this->pincode);
					if ($this->emiratesID->Exportable) $Doc->ExportCaption($this->emiratesID);
					if ($this->visaStatus->Exportable) $Doc->ExportCaption($this->visaStatus);
					if ($this->licenseNumber->Exportable) $Doc->ExportCaption($this->licenseNumber);
					if ($this->licenseExpiry->Exportable) $Doc->ExportCaption($this->licenseExpiry);
					if ($this->licensePlaceOfIssue->Exportable) $Doc->ExportCaption($this->licensePlaceOfIssue);
					if ($this->licenseAttachment->Exportable) $Doc->ExportCaption($this->licenseAttachment);
					if ($this->passportNumber->Exportable) $Doc->ExportCaption($this->passportNumber);
					if ($this->passportExpiry->Exportable) $Doc->ExportCaption($this->passportExpiry);
					if ($this->passportPlaceOfIssue->Exportable) $Doc->ExportCaption($this->passportPlaceOfIssue);
					if ($this->passportAttachment->Exportable) $Doc->ExportCaption($this->passportAttachment);
					if ($this->signUpNewsletter->Exportable) $Doc->ExportCaption($this->signUpNewsletter);
					if ($this->password->Exportable) $Doc->ExportCaption($this->password);
					if ($this->currentCurrency->Exportable) $Doc->ExportCaption($this->currentCurrency);
					if ($this->currentLanguage->Exportable) $Doc->ExportCaption($this->currentLanguage);
					if ($this->createdDate->Exportable) $Doc->ExportCaption($this->createdDate);
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
						if ($this->_userID->Exportable) $Doc->ExportField($this->_userID);
						if ($this->firstName->Exportable) $Doc->ExportField($this->firstName);
						if ($this->lastName->Exportable) $Doc->ExportField($this->lastName);
						if ($this->emailID->Exportable) $Doc->ExportField($this->emailID);
						if ($this->mobileNo->Exportable) $Doc->ExportField($this->mobileNo);
						if ($this->country->Exportable) $Doc->ExportField($this->country);
						if ($this->city->Exportable) $Doc->ExportField($this->city);
						if ($this->nationality->Exportable) $Doc->ExportField($this->nationality);
						if ($this->address->Exportable) $Doc->ExportField($this->address);
						if ($this->state->Exportable) $Doc->ExportField($this->state);
						if ($this->pincode->Exportable) $Doc->ExportField($this->pincode);
						if ($this->emiratesID->Exportable) $Doc->ExportField($this->emiratesID);
						if ($this->visaStatus->Exportable) $Doc->ExportField($this->visaStatus);
						if ($this->licenseNumber->Exportable) $Doc->ExportField($this->licenseNumber);
						if ($this->licenseExpiry->Exportable) $Doc->ExportField($this->licenseExpiry);
						if ($this->licensePlaceOfIssue->Exportable) $Doc->ExportField($this->licensePlaceOfIssue);
						if ($this->licenseAttachment->Exportable) $Doc->ExportField($this->licenseAttachment);
						if ($this->passportNumber->Exportable) $Doc->ExportField($this->passportNumber);
						if ($this->passportExpiry->Exportable) $Doc->ExportField($this->passportExpiry);
						if ($this->passportPlaceOfIssue->Exportable) $Doc->ExportField($this->passportPlaceOfIssue);
						if ($this->passportAttachment->Exportable) $Doc->ExportField($this->passportAttachment);
						if ($this->signUpNewsletter->Exportable) $Doc->ExportField($this->signUpNewsletter);
						if ($this->password->Exportable) $Doc->ExportField($this->password);
						if ($this->currentCurrency->Exportable) $Doc->ExportField($this->currentCurrency);
						if ($this->currentLanguage->Exportable) $Doc->ExportField($this->currentLanguage);
						if ($this->createdDate->Exportable) $Doc->ExportField($this->createdDate);
					} else {
						if ($this->_userID->Exportable) $Doc->ExportField($this->_userID);
						if ($this->firstName->Exportable) $Doc->ExportField($this->firstName);
						if ($this->lastName->Exportable) $Doc->ExportField($this->lastName);
						if ($this->emailID->Exportable) $Doc->ExportField($this->emailID);
						if ($this->mobileNo->Exportable) $Doc->ExportField($this->mobileNo);
						if ($this->country->Exportable) $Doc->ExportField($this->country);
						if ($this->city->Exportable) $Doc->ExportField($this->city);
						if ($this->nationality->Exportable) $Doc->ExportField($this->nationality);
						if ($this->address->Exportable) $Doc->ExportField($this->address);
						if ($this->state->Exportable) $Doc->ExportField($this->state);
						if ($this->pincode->Exportable) $Doc->ExportField($this->pincode);
						if ($this->emiratesID->Exportable) $Doc->ExportField($this->emiratesID);
						if ($this->visaStatus->Exportable) $Doc->ExportField($this->visaStatus);
						if ($this->licenseNumber->Exportable) $Doc->ExportField($this->licenseNumber);
						if ($this->licenseExpiry->Exportable) $Doc->ExportField($this->licenseExpiry);
						if ($this->licensePlaceOfIssue->Exportable) $Doc->ExportField($this->licensePlaceOfIssue);
						if ($this->licenseAttachment->Exportable) $Doc->ExportField($this->licenseAttachment);
						if ($this->passportNumber->Exportable) $Doc->ExportField($this->passportNumber);
						if ($this->passportExpiry->Exportable) $Doc->ExportField($this->passportExpiry);
						if ($this->passportPlaceOfIssue->Exportable) $Doc->ExportField($this->passportPlaceOfIssue);
						if ($this->passportAttachment->Exportable) $Doc->ExportField($this->passportAttachment);
						if ($this->signUpNewsletter->Exportable) $Doc->ExportField($this->signUpNewsletter);
						if ($this->password->Exportable) $Doc->ExportField($this->password);
						if ($this->currentCurrency->Exportable) $Doc->ExportField($this->currentCurrency);
						if ($this->currentLanguage->Exportable) $Doc->ExportField($this->currentLanguage);
						if ($this->createdDate->Exportable) $Doc->ExportField($this->createdDate);
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
