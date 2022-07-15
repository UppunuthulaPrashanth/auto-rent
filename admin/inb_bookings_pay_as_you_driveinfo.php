<?php

// Global variable for table object
$inb_bookings_pay_as_you_drive = NULL;

//
// Table class for inb_bookings_pay_as_you_drive
//
class cinb_bookings_pay_as_you_drive extends cTable {
	var $bookingID;
	var $bookingNumber;
	var $_userID;
	var $payDriveCarID;
	var $pickUpLocation;
	var $dropLocation;
	var $pickUpDate;
	var $dropDate;
	var $noOfDays;
	var $bookingTerm;
	var $slab;
	var $orangeCard;
	var $gps;
	var $deliveryCharge;
	var $collectionCharge;
	var $rentalAmount;
	var $totalAmount;
	var $vat;
	var $grandTotal;
	var $deliveryAddress;
	var $paymentMethod;
	var $dateCreated;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'inb_bookings_pay_as_you_drive';
		$this->TableName = 'inb_bookings_pay_as_you_drive';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`inb_bookings_pay_as_you_drive`";
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

		// bookingID
		$this->bookingID = new cField('inb_bookings_pay_as_you_drive', 'inb_bookings_pay_as_you_drive', 'x_bookingID', 'bookingID', '`bookingID`', '`bookingID`', 3, -1, FALSE, '`bookingID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->bookingID->Sortable = TRUE; // Allow sort
		$this->bookingID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['bookingID'] = &$this->bookingID;

		// bookingNumber
		$this->bookingNumber = new cField('inb_bookings_pay_as_you_drive', 'inb_bookings_pay_as_you_drive', 'x_bookingNumber', 'bookingNumber', '`bookingNumber`', '`bookingNumber`', 19, -1, FALSE, '`bookingNumber`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->bookingNumber->Sortable = TRUE; // Allow sort
		$this->bookingNumber->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['bookingNumber'] = &$this->bookingNumber;

		// userID
		$this->_userID = new cField('inb_bookings_pay_as_you_drive', 'inb_bookings_pay_as_you_drive', 'x__userID', 'userID', '`userID`', '`userID`', 3, -1, FALSE, '`userID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->_userID->Sortable = TRUE; // Allow sort
		$this->_userID->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->_userID->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->_userID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['userID'] = &$this->_userID;

		// payDriveCarID
		$this->payDriveCarID = new cField('inb_bookings_pay_as_you_drive', 'inb_bookings_pay_as_you_drive', 'x_payDriveCarID', 'payDriveCarID', '`payDriveCarID`', '`payDriveCarID`', 3, -1, FALSE, '`payDriveCarID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->payDriveCarID->Sortable = TRUE; // Allow sort
		$this->payDriveCarID->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->payDriveCarID->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->payDriveCarID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['payDriveCarID'] = &$this->payDriveCarID;

		// pickUpLocation
		$this->pickUpLocation = new cField('inb_bookings_pay_as_you_drive', 'inb_bookings_pay_as_you_drive', 'x_pickUpLocation', 'pickUpLocation', '`pickUpLocation`', '`pickUpLocation`', 3, -1, FALSE, '`pickUpLocation`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->pickUpLocation->Sortable = TRUE; // Allow sort
		$this->pickUpLocation->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->pickUpLocation->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->pickUpLocation->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['pickUpLocation'] = &$this->pickUpLocation;

		// dropLocation
		$this->dropLocation = new cField('inb_bookings_pay_as_you_drive', 'inb_bookings_pay_as_you_drive', 'x_dropLocation', 'dropLocation', '`dropLocation`', '`dropLocation`', 3, -1, FALSE, '`dropLocation`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->dropLocation->Sortable = TRUE; // Allow sort
		$this->dropLocation->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->dropLocation->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->dropLocation->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['dropLocation'] = &$this->dropLocation;

		// pickUpDate
		$this->pickUpDate = new cField('inb_bookings_pay_as_you_drive', 'inb_bookings_pay_as_you_drive', 'x_pickUpDate', 'pickUpDate', '`pickUpDate`', ew_CastDateFieldForLike('`pickUpDate`', 7, "DB"), 135, 7, FALSE, '`pickUpDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pickUpDate->Sortable = TRUE; // Allow sort
		$this->pickUpDate->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['pickUpDate'] = &$this->pickUpDate;

		// dropDate
		$this->dropDate = new cField('inb_bookings_pay_as_you_drive', 'inb_bookings_pay_as_you_drive', 'x_dropDate', 'dropDate', '`dropDate`', ew_CastDateFieldForLike('`dropDate`', 7, "DB"), 135, 7, FALSE, '`dropDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->dropDate->Sortable = TRUE; // Allow sort
		$this->dropDate->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['dropDate'] = &$this->dropDate;

		// noOfDays
		$this->noOfDays = new cField('inb_bookings_pay_as_you_drive', 'inb_bookings_pay_as_you_drive', 'x_noOfDays', 'noOfDays', '`noOfDays`', '`noOfDays`', 3, -1, FALSE, '`noOfDays`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->noOfDays->Sortable = TRUE; // Allow sort
		$this->noOfDays->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['noOfDays'] = &$this->noOfDays;

		// bookingTerm
		$this->bookingTerm = new cField('inb_bookings_pay_as_you_drive', 'inb_bookings_pay_as_you_drive', 'x_bookingTerm', 'bookingTerm', '`bookingTerm`', '`bookingTerm`', 200, -1, FALSE, '`bookingTerm`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->bookingTerm->Sortable = TRUE; // Allow sort
		$this->fields['bookingTerm'] = &$this->bookingTerm;

		// slab
		$this->slab = new cField('inb_bookings_pay_as_you_drive', 'inb_bookings_pay_as_you_drive', 'x_slab', 'slab', '`slab`', '`slab`', 200, -1, FALSE, '`slab`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->slab->Sortable = TRUE; // Allow sort
		$this->fields['slab'] = &$this->slab;

		// orangeCard
		$this->orangeCard = new cField('inb_bookings_pay_as_you_drive', 'inb_bookings_pay_as_you_drive', 'x_orangeCard', 'orangeCard', '`orangeCard`', '`orangeCard`', 5, -1, FALSE, '`orangeCard`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->orangeCard->Sortable = TRUE; // Allow sort
		$this->orangeCard->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['orangeCard'] = &$this->orangeCard;

		// gps
		$this->gps = new cField('inb_bookings_pay_as_you_drive', 'inb_bookings_pay_as_you_drive', 'x_gps', 'gps', '`gps`', '`gps`', 200, -1, FALSE, '`gps`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->gps->Sortable = TRUE; // Allow sort
		$this->fields['gps'] = &$this->gps;

		// deliveryCharge
		$this->deliveryCharge = new cField('inb_bookings_pay_as_you_drive', 'inb_bookings_pay_as_you_drive', 'x_deliveryCharge', 'deliveryCharge', '`deliveryCharge`', '`deliveryCharge`', 5, -1, FALSE, '`deliveryCharge`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->deliveryCharge->Sortable = TRUE; // Allow sort
		$this->deliveryCharge->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['deliveryCharge'] = &$this->deliveryCharge;

		// collectionCharge
		$this->collectionCharge = new cField('inb_bookings_pay_as_you_drive', 'inb_bookings_pay_as_you_drive', 'x_collectionCharge', 'collectionCharge', '`collectionCharge`', '`collectionCharge`', 5, -1, FALSE, '`collectionCharge`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->collectionCharge->Sortable = TRUE; // Allow sort
		$this->collectionCharge->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['collectionCharge'] = &$this->collectionCharge;

		// rentalAmount
		$this->rentalAmount = new cField('inb_bookings_pay_as_you_drive', 'inb_bookings_pay_as_you_drive', 'x_rentalAmount', 'rentalAmount', '`rentalAmount`', '`rentalAmount`', 5, -1, FALSE, '`rentalAmount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rentalAmount->Sortable = TRUE; // Allow sort
		$this->rentalAmount->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['rentalAmount'] = &$this->rentalAmount;

		// totalAmount
		$this->totalAmount = new cField('inb_bookings_pay_as_you_drive', 'inb_bookings_pay_as_you_drive', 'x_totalAmount', 'totalAmount', '`totalAmount`', '`totalAmount`', 5, -1, FALSE, '`totalAmount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->totalAmount->Sortable = TRUE; // Allow sort
		$this->totalAmount->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['totalAmount'] = &$this->totalAmount;

		// vat
		$this->vat = new cField('inb_bookings_pay_as_you_drive', 'inb_bookings_pay_as_you_drive', 'x_vat', 'vat', '`vat`', '`vat`', 5, -1, FALSE, '`vat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->vat->Sortable = TRUE; // Allow sort
		$this->vat->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['vat'] = &$this->vat;

		// grandTotal
		$this->grandTotal = new cField('inb_bookings_pay_as_you_drive', 'inb_bookings_pay_as_you_drive', 'x_grandTotal', 'grandTotal', '`grandTotal`', '`grandTotal`', 5, -1, FALSE, '`grandTotal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->grandTotal->Sortable = TRUE; // Allow sort
		$this->grandTotal->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['grandTotal'] = &$this->grandTotal;

		// deliveryAddress
		$this->deliveryAddress = new cField('inb_bookings_pay_as_you_drive', 'inb_bookings_pay_as_you_drive', 'x_deliveryAddress', 'deliveryAddress', '`deliveryAddress`', '`deliveryAddress`', 200, -1, FALSE, '`deliveryAddress`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->deliveryAddress->Sortable = TRUE; // Allow sort
		$this->fields['deliveryAddress'] = &$this->deliveryAddress;

		// paymentMethod
		$this->paymentMethod = new cField('inb_bookings_pay_as_you_drive', 'inb_bookings_pay_as_you_drive', 'x_paymentMethod', 'paymentMethod', '`paymentMethod`', '`paymentMethod`', 202, -1, FALSE, '`paymentMethod`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->paymentMethod->Sortable = TRUE; // Allow sort
		$this->paymentMethod->OptionCount = 2;
		$this->fields['paymentMethod'] = &$this->paymentMethod;

		// dateCreated
		$this->dateCreated = new cField('inb_bookings_pay_as_you_drive', 'inb_bookings_pay_as_you_drive', 'x_dateCreated', 'dateCreated', '`dateCreated`', ew_CastDateFieldForLike('`dateCreated`', 7, "DB"), 135, 7, FALSE, '`dateCreated`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->dateCreated->Sortable = TRUE; // Allow sort
		$this->dateCreated->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`inb_bookings_pay_as_you_drive`";
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
			$this->bookingID->setDbValue($conn->Insert_ID());
			$rs['bookingID'] = $this->bookingID->DbValue;
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
			if (array_key_exists('bookingID', $rs))
				ew_AddFilter($where, ew_QuotedName('bookingID', $this->DBID) . '=' . ew_QuotedValue($rs['bookingID'], $this->bookingID->FldDataType, $this->DBID));
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
		return "`bookingID` = @bookingID@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->bookingID->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->bookingID->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@bookingID@", ew_AdjustSql($this->bookingID->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "inb_bookings_pay_as_you_drivelist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "inb_bookings_pay_as_you_driveview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "inb_bookings_pay_as_you_driveedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "inb_bookings_pay_as_you_driveadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "inb_bookings_pay_as_you_drivelist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("inb_bookings_pay_as_you_driveview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("inb_bookings_pay_as_you_driveview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "inb_bookings_pay_as_you_driveadd.php?" . $this->UrlParm($parm);
		else
			$url = "inb_bookings_pay_as_you_driveadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("inb_bookings_pay_as_you_driveedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("inb_bookings_pay_as_you_driveadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("inb_bookings_pay_as_you_drivedelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "bookingID:" . ew_VarToJson($this->bookingID->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->bookingID->CurrentValue)) {
			$sUrl .= "bookingID=" . urlencode($this->bookingID->CurrentValue);
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
			if ($isPost && isset($_POST["bookingID"]))
				$arKeys[] = $_POST["bookingID"];
			elseif (isset($_GET["bookingID"]))
				$arKeys[] = $_GET["bookingID"];
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
			$this->bookingID->CurrentValue = $key;
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
		$this->bookingID->setDbValue($rs->fields('bookingID'));
		$this->bookingNumber->setDbValue($rs->fields('bookingNumber'));
		$this->_userID->setDbValue($rs->fields('userID'));
		$this->payDriveCarID->setDbValue($rs->fields('payDriveCarID'));
		$this->pickUpLocation->setDbValue($rs->fields('pickUpLocation'));
		$this->dropLocation->setDbValue($rs->fields('dropLocation'));
		$this->pickUpDate->setDbValue($rs->fields('pickUpDate'));
		$this->dropDate->setDbValue($rs->fields('dropDate'));
		$this->noOfDays->setDbValue($rs->fields('noOfDays'));
		$this->bookingTerm->setDbValue($rs->fields('bookingTerm'));
		$this->slab->setDbValue($rs->fields('slab'));
		$this->orangeCard->setDbValue($rs->fields('orangeCard'));
		$this->gps->setDbValue($rs->fields('gps'));
		$this->deliveryCharge->setDbValue($rs->fields('deliveryCharge'));
		$this->collectionCharge->setDbValue($rs->fields('collectionCharge'));
		$this->rentalAmount->setDbValue($rs->fields('rentalAmount'));
		$this->totalAmount->setDbValue($rs->fields('totalAmount'));
		$this->vat->setDbValue($rs->fields('vat'));
		$this->grandTotal->setDbValue($rs->fields('grandTotal'));
		$this->deliveryAddress->setDbValue($rs->fields('deliveryAddress'));
		$this->paymentMethod->setDbValue($rs->fields('paymentMethod'));
		$this->dateCreated->setDbValue($rs->fields('dateCreated'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// bookingID
		// bookingNumber
		// userID
		// payDriveCarID
		// pickUpLocation
		// dropLocation
		// pickUpDate
		// dropDate
		// noOfDays
		// bookingTerm
		// slab
		// orangeCard
		// gps
		// deliveryCharge
		// collectionCharge
		// rentalAmount
		// totalAmount
		// vat
		// grandTotal
		// deliveryAddress
		// paymentMethod
		// dateCreated
		// bookingID

		$this->bookingID->ViewValue = $this->bookingID->CurrentValue;
		$this->bookingID->ViewCustomAttributes = "";

		// bookingNumber
		$this->bookingNumber->ViewValue = $this->bookingNumber->CurrentValue;
		$this->bookingNumber->ViewCustomAttributes = "";

		// userID
		if (strval($this->_userID->CurrentValue) <> "") {
			$sFilterWrk = "`userID`" . ew_SearchString("=", $this->_userID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `userID`, `firstName` AS `DispFld`, `lastName` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `users`";
		$sWhereWrk = "";
		$this->_userID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->_userID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->_userID->ViewValue = $this->_userID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->_userID->ViewValue = $this->_userID->CurrentValue;
			}
		} else {
			$this->_userID->ViewValue = NULL;
		}
		$this->_userID->ViewCustomAttributes = "";

		// payDriveCarID
		if (strval($this->payDriveCarID->CurrentValue) <> "") {
			$sFilterWrk = "`payDriveCarID`" . ew_SearchString("=", $this->payDriveCarID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `payDriveCarID`, `carTitle` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `pay_as_you_drive`";
		$sWhereWrk = "";
		$this->payDriveCarID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->payDriveCarID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->payDriveCarID->ViewValue = $this->payDriveCarID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->payDriveCarID->ViewValue = $this->payDriveCarID->CurrentValue;
			}
		} else {
			$this->payDriveCarID->ViewValue = NULL;
		}
		$this->payDriveCarID->ViewCustomAttributes = "";

		// pickUpLocation
		if (strval($this->pickUpLocation->CurrentValue) <> "") {
			$sFilterWrk = "`pdLocationID`" . ew_SearchString("=", $this->pickUpLocation->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `pdLocationID`, `location` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `pickup_drop_locations`";
		$sWhereWrk = "";
		$this->pickUpLocation->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->pickUpLocation, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->pickUpLocation->ViewValue = $this->pickUpLocation->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->pickUpLocation->ViewValue = $this->pickUpLocation->CurrentValue;
			}
		} else {
			$this->pickUpLocation->ViewValue = NULL;
		}
		$this->pickUpLocation->ViewCustomAttributes = "";

		// dropLocation
		if (strval($this->dropLocation->CurrentValue) <> "") {
			$sFilterWrk = "`pdLocationID`" . ew_SearchString("=", $this->dropLocation->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `pdLocationID`, `location` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `pickup_drop_locations`";
		$sWhereWrk = "";
		$this->dropLocation->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->dropLocation, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->dropLocation->ViewValue = $this->dropLocation->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->dropLocation->ViewValue = $this->dropLocation->CurrentValue;
			}
		} else {
			$this->dropLocation->ViewValue = NULL;
		}
		$this->dropLocation->ViewCustomAttributes = "";

		// pickUpDate
		$this->pickUpDate->ViewValue = $this->pickUpDate->CurrentValue;
		$this->pickUpDate->ViewValue = ew_FormatDateTime($this->pickUpDate->ViewValue, 7);
		$this->pickUpDate->ViewCustomAttributes = "";

		// dropDate
		$this->dropDate->ViewValue = $this->dropDate->CurrentValue;
		$this->dropDate->ViewValue = ew_FormatDateTime($this->dropDate->ViewValue, 7);
		$this->dropDate->ViewCustomAttributes = "";

		// noOfDays
		$this->noOfDays->ViewValue = $this->noOfDays->CurrentValue;
		$this->noOfDays->ViewCustomAttributes = "";

		// bookingTerm
		$this->bookingTerm->ViewValue = $this->bookingTerm->CurrentValue;
		$this->bookingTerm->ViewCustomAttributes = "";

		// slab
		$this->slab->ViewValue = $this->slab->CurrentValue;
		$this->slab->ViewCustomAttributes = "";

		// orangeCard
		$this->orangeCard->ViewValue = $this->orangeCard->CurrentValue;
		$this->orangeCard->ViewCustomAttributes = "";

		// gps
		$this->gps->ViewValue = $this->gps->CurrentValue;
		$this->gps->ViewCustomAttributes = "";

		// deliveryCharge
		$this->deliveryCharge->ViewValue = $this->deliveryCharge->CurrentValue;
		$this->deliveryCharge->ViewCustomAttributes = "";

		// collectionCharge
		$this->collectionCharge->ViewValue = $this->collectionCharge->CurrentValue;
		$this->collectionCharge->ViewCustomAttributes = "";

		// rentalAmount
		$this->rentalAmount->ViewValue = $this->rentalAmount->CurrentValue;
		$this->rentalAmount->ViewCustomAttributes = "";

		// totalAmount
		$this->totalAmount->ViewValue = $this->totalAmount->CurrentValue;
		$this->totalAmount->ViewCustomAttributes = "";

		// vat
		$this->vat->ViewValue = $this->vat->CurrentValue;
		$this->vat->ViewCustomAttributes = "";

		// grandTotal
		$this->grandTotal->ViewValue = $this->grandTotal->CurrentValue;
		$this->grandTotal->ViewCustomAttributes = "";

		// deliveryAddress
		$this->deliveryAddress->ViewValue = $this->deliveryAddress->CurrentValue;
		$this->deliveryAddress->ViewCustomAttributes = "";

		// paymentMethod
		if (strval($this->paymentMethod->CurrentValue) <> "") {
			$this->paymentMethod->ViewValue = $this->paymentMethod->OptionCaption($this->paymentMethod->CurrentValue);
		} else {
			$this->paymentMethod->ViewValue = NULL;
		}
		$this->paymentMethod->ViewCustomAttributes = "";

		// dateCreated
		$this->dateCreated->ViewValue = $this->dateCreated->CurrentValue;
		$this->dateCreated->ViewValue = ew_FormatDateTime($this->dateCreated->ViewValue, 7);
		$this->dateCreated->ViewCustomAttributes = "";

		// bookingID
		$this->bookingID->LinkCustomAttributes = "";
		$this->bookingID->HrefValue = "";
		$this->bookingID->TooltipValue = "";

		// bookingNumber
		$this->bookingNumber->LinkCustomAttributes = "";
		$this->bookingNumber->HrefValue = "";
		$this->bookingNumber->TooltipValue = "";

		// userID
		$this->_userID->LinkCustomAttributes = "";
		$this->_userID->HrefValue = "";
		$this->_userID->TooltipValue = "";

		// payDriveCarID
		$this->payDriveCarID->LinkCustomAttributes = "";
		$this->payDriveCarID->HrefValue = "";
		$this->payDriveCarID->TooltipValue = "";

		// pickUpLocation
		$this->pickUpLocation->LinkCustomAttributes = "";
		$this->pickUpLocation->HrefValue = "";
		$this->pickUpLocation->TooltipValue = "";

		// dropLocation
		$this->dropLocation->LinkCustomAttributes = "";
		$this->dropLocation->HrefValue = "";
		$this->dropLocation->TooltipValue = "";

		// pickUpDate
		$this->pickUpDate->LinkCustomAttributes = "";
		$this->pickUpDate->HrefValue = "";
		$this->pickUpDate->TooltipValue = "";

		// dropDate
		$this->dropDate->LinkCustomAttributes = "";
		$this->dropDate->HrefValue = "";
		$this->dropDate->TooltipValue = "";

		// noOfDays
		$this->noOfDays->LinkCustomAttributes = "";
		$this->noOfDays->HrefValue = "";
		$this->noOfDays->TooltipValue = "";

		// bookingTerm
		$this->bookingTerm->LinkCustomAttributes = "";
		$this->bookingTerm->HrefValue = "";
		$this->bookingTerm->TooltipValue = "";

		// slab
		$this->slab->LinkCustomAttributes = "";
		$this->slab->HrefValue = "";
		$this->slab->TooltipValue = "";

		// orangeCard
		$this->orangeCard->LinkCustomAttributes = "";
		$this->orangeCard->HrefValue = "";
		$this->orangeCard->TooltipValue = "";

		// gps
		$this->gps->LinkCustomAttributes = "";
		$this->gps->HrefValue = "";
		$this->gps->TooltipValue = "";

		// deliveryCharge
		$this->deliveryCharge->LinkCustomAttributes = "";
		$this->deliveryCharge->HrefValue = "";
		$this->deliveryCharge->TooltipValue = "";

		// collectionCharge
		$this->collectionCharge->LinkCustomAttributes = "";
		$this->collectionCharge->HrefValue = "";
		$this->collectionCharge->TooltipValue = "";

		// rentalAmount
		$this->rentalAmount->LinkCustomAttributes = "";
		$this->rentalAmount->HrefValue = "";
		$this->rentalAmount->TooltipValue = "";

		// totalAmount
		$this->totalAmount->LinkCustomAttributes = "";
		$this->totalAmount->HrefValue = "";
		$this->totalAmount->TooltipValue = "";

		// vat
		$this->vat->LinkCustomAttributes = "";
		$this->vat->HrefValue = "";
		$this->vat->TooltipValue = "";

		// grandTotal
		$this->grandTotal->LinkCustomAttributes = "";
		$this->grandTotal->HrefValue = "";
		$this->grandTotal->TooltipValue = "";

		// deliveryAddress
		$this->deliveryAddress->LinkCustomAttributes = "";
		$this->deliveryAddress->HrefValue = "";
		$this->deliveryAddress->TooltipValue = "";

		// paymentMethod
		$this->paymentMethod->LinkCustomAttributes = "";
		$this->paymentMethod->HrefValue = "";
		$this->paymentMethod->TooltipValue = "";

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

		// bookingID
		$this->bookingID->EditAttrs["class"] = "form-control";
		$this->bookingID->EditCustomAttributes = "";
		$this->bookingID->EditValue = $this->bookingID->CurrentValue;
		$this->bookingID->ViewCustomAttributes = "";

		// bookingNumber
		$this->bookingNumber->EditAttrs["class"] = "form-control";
		$this->bookingNumber->EditCustomAttributes = "";
		$this->bookingNumber->EditValue = $this->bookingNumber->CurrentValue;
		$this->bookingNumber->PlaceHolder = ew_RemoveHtml($this->bookingNumber->FldCaption());

		// userID
		$this->_userID->EditAttrs["class"] = "form-control";
		$this->_userID->EditCustomAttributes = "";

		// payDriveCarID
		$this->payDriveCarID->EditAttrs["class"] = "form-control";
		$this->payDriveCarID->EditCustomAttributes = "";

		// pickUpLocation
		$this->pickUpLocation->EditAttrs["class"] = "form-control";
		$this->pickUpLocation->EditCustomAttributes = "";

		// dropLocation
		$this->dropLocation->EditAttrs["class"] = "form-control";
		$this->dropLocation->EditCustomAttributes = "";

		// pickUpDate
		$this->pickUpDate->EditAttrs["class"] = "form-control";
		$this->pickUpDate->EditCustomAttributes = "";
		$this->pickUpDate->EditValue = ew_FormatDateTime($this->pickUpDate->CurrentValue, 7);
		$this->pickUpDate->PlaceHolder = ew_RemoveHtml($this->pickUpDate->FldCaption());

		// dropDate
		$this->dropDate->EditAttrs["class"] = "form-control";
		$this->dropDate->EditCustomAttributes = "";
		$this->dropDate->EditValue = ew_FormatDateTime($this->dropDate->CurrentValue, 7);
		$this->dropDate->PlaceHolder = ew_RemoveHtml($this->dropDate->FldCaption());

		// noOfDays
		$this->noOfDays->EditAttrs["class"] = "form-control";
		$this->noOfDays->EditCustomAttributes = "";
		$this->noOfDays->EditValue = $this->noOfDays->CurrentValue;
		$this->noOfDays->PlaceHolder = ew_RemoveHtml($this->noOfDays->FldCaption());

		// bookingTerm
		$this->bookingTerm->EditAttrs["class"] = "form-control";
		$this->bookingTerm->EditCustomAttributes = "";
		$this->bookingTerm->EditValue = $this->bookingTerm->CurrentValue;
		$this->bookingTerm->PlaceHolder = ew_RemoveHtml($this->bookingTerm->FldCaption());

		// slab
		$this->slab->EditAttrs["class"] = "form-control";
		$this->slab->EditCustomAttributes = "";
		$this->slab->EditValue = $this->slab->CurrentValue;
		$this->slab->PlaceHolder = ew_RemoveHtml($this->slab->FldCaption());

		// orangeCard
		$this->orangeCard->EditAttrs["class"] = "form-control";
		$this->orangeCard->EditCustomAttributes = "";
		$this->orangeCard->EditValue = $this->orangeCard->CurrentValue;
		$this->orangeCard->PlaceHolder = ew_RemoveHtml($this->orangeCard->FldCaption());
		if (strval($this->orangeCard->EditValue) <> "" && is_numeric($this->orangeCard->EditValue)) $this->orangeCard->EditValue = ew_FormatNumber($this->orangeCard->EditValue, -2, -1, -2, 0);

		// gps
		$this->gps->EditAttrs["class"] = "form-control";
		$this->gps->EditCustomAttributes = "";
		$this->gps->EditValue = $this->gps->CurrentValue;
		$this->gps->PlaceHolder = ew_RemoveHtml($this->gps->FldCaption());

		// deliveryCharge
		$this->deliveryCharge->EditAttrs["class"] = "form-control";
		$this->deliveryCharge->EditCustomAttributes = "";
		$this->deliveryCharge->EditValue = $this->deliveryCharge->CurrentValue;
		$this->deliveryCharge->PlaceHolder = ew_RemoveHtml($this->deliveryCharge->FldCaption());
		if (strval($this->deliveryCharge->EditValue) <> "" && is_numeric($this->deliveryCharge->EditValue)) $this->deliveryCharge->EditValue = ew_FormatNumber($this->deliveryCharge->EditValue, -2, -1, -2, 0);

		// collectionCharge
		$this->collectionCharge->EditAttrs["class"] = "form-control";
		$this->collectionCharge->EditCustomAttributes = "";
		$this->collectionCharge->EditValue = $this->collectionCharge->CurrentValue;
		$this->collectionCharge->PlaceHolder = ew_RemoveHtml($this->collectionCharge->FldCaption());
		if (strval($this->collectionCharge->EditValue) <> "" && is_numeric($this->collectionCharge->EditValue)) $this->collectionCharge->EditValue = ew_FormatNumber($this->collectionCharge->EditValue, -2, -1, -2, 0);

		// rentalAmount
		$this->rentalAmount->EditAttrs["class"] = "form-control";
		$this->rentalAmount->EditCustomAttributes = "";
		$this->rentalAmount->EditValue = $this->rentalAmount->CurrentValue;
		$this->rentalAmount->PlaceHolder = ew_RemoveHtml($this->rentalAmount->FldCaption());
		if (strval($this->rentalAmount->EditValue) <> "" && is_numeric($this->rentalAmount->EditValue)) $this->rentalAmount->EditValue = ew_FormatNumber($this->rentalAmount->EditValue, -2, -1, -2, 0);

		// totalAmount
		$this->totalAmount->EditAttrs["class"] = "form-control";
		$this->totalAmount->EditCustomAttributes = "";
		$this->totalAmount->EditValue = $this->totalAmount->CurrentValue;
		$this->totalAmount->PlaceHolder = ew_RemoveHtml($this->totalAmount->FldCaption());
		if (strval($this->totalAmount->EditValue) <> "" && is_numeric($this->totalAmount->EditValue)) $this->totalAmount->EditValue = ew_FormatNumber($this->totalAmount->EditValue, -2, -1, -2, 0);

		// vat
		$this->vat->EditAttrs["class"] = "form-control";
		$this->vat->EditCustomAttributes = "";
		$this->vat->EditValue = $this->vat->CurrentValue;
		$this->vat->PlaceHolder = ew_RemoveHtml($this->vat->FldCaption());
		if (strval($this->vat->EditValue) <> "" && is_numeric($this->vat->EditValue)) $this->vat->EditValue = ew_FormatNumber($this->vat->EditValue, -2, -1, -2, 0);

		// grandTotal
		$this->grandTotal->EditAttrs["class"] = "form-control";
		$this->grandTotal->EditCustomAttributes = "";
		$this->grandTotal->EditValue = $this->grandTotal->CurrentValue;
		$this->grandTotal->PlaceHolder = ew_RemoveHtml($this->grandTotal->FldCaption());
		if (strval($this->grandTotal->EditValue) <> "" && is_numeric($this->grandTotal->EditValue)) $this->grandTotal->EditValue = ew_FormatNumber($this->grandTotal->EditValue, -2, -1, -2, 0);

		// deliveryAddress
		$this->deliveryAddress->EditAttrs["class"] = "form-control";
		$this->deliveryAddress->EditCustomAttributes = "";
		$this->deliveryAddress->EditValue = $this->deliveryAddress->CurrentValue;
		$this->deliveryAddress->PlaceHolder = ew_RemoveHtml($this->deliveryAddress->FldCaption());

		// paymentMethod
		$this->paymentMethod->EditCustomAttributes = "";
		$this->paymentMethod->EditValue = $this->paymentMethod->Options(FALSE);

		// dateCreated
		$this->dateCreated->EditAttrs["class"] = "form-control";
		$this->dateCreated->EditCustomAttributes = "";
		$this->dateCreated->EditValue = ew_FormatDateTime($this->dateCreated->CurrentValue, 7);
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
					if ($this->bookingID->Exportable) $Doc->ExportCaption($this->bookingID);
					if ($this->bookingNumber->Exportable) $Doc->ExportCaption($this->bookingNumber);
					if ($this->_userID->Exportable) $Doc->ExportCaption($this->_userID);
					if ($this->payDriveCarID->Exportable) $Doc->ExportCaption($this->payDriveCarID);
					if ($this->pickUpLocation->Exportable) $Doc->ExportCaption($this->pickUpLocation);
					if ($this->dropLocation->Exportable) $Doc->ExportCaption($this->dropLocation);
					if ($this->pickUpDate->Exportable) $Doc->ExportCaption($this->pickUpDate);
					if ($this->dropDate->Exportable) $Doc->ExportCaption($this->dropDate);
					if ($this->noOfDays->Exportable) $Doc->ExportCaption($this->noOfDays);
					if ($this->bookingTerm->Exportable) $Doc->ExportCaption($this->bookingTerm);
					if ($this->slab->Exportable) $Doc->ExportCaption($this->slab);
					if ($this->orangeCard->Exportable) $Doc->ExportCaption($this->orangeCard);
					if ($this->gps->Exportable) $Doc->ExportCaption($this->gps);
					if ($this->deliveryCharge->Exportable) $Doc->ExportCaption($this->deliveryCharge);
					if ($this->collectionCharge->Exportable) $Doc->ExportCaption($this->collectionCharge);
					if ($this->rentalAmount->Exportable) $Doc->ExportCaption($this->rentalAmount);
					if ($this->totalAmount->Exportable) $Doc->ExportCaption($this->totalAmount);
					if ($this->vat->Exportable) $Doc->ExportCaption($this->vat);
					if ($this->grandTotal->Exportable) $Doc->ExportCaption($this->grandTotal);
					if ($this->deliveryAddress->Exportable) $Doc->ExportCaption($this->deliveryAddress);
					if ($this->paymentMethod->Exportable) $Doc->ExportCaption($this->paymentMethod);
					if ($this->dateCreated->Exportable) $Doc->ExportCaption($this->dateCreated);
				} else {
					if ($this->bookingID->Exportable) $Doc->ExportCaption($this->bookingID);
					if ($this->bookingNumber->Exportable) $Doc->ExportCaption($this->bookingNumber);
					if ($this->_userID->Exportable) $Doc->ExportCaption($this->_userID);
					if ($this->payDriveCarID->Exportable) $Doc->ExportCaption($this->payDriveCarID);
					if ($this->pickUpLocation->Exportable) $Doc->ExportCaption($this->pickUpLocation);
					if ($this->dropLocation->Exportable) $Doc->ExportCaption($this->dropLocation);
					if ($this->pickUpDate->Exportable) $Doc->ExportCaption($this->pickUpDate);
					if ($this->dropDate->Exportable) $Doc->ExportCaption($this->dropDate);
					if ($this->noOfDays->Exportable) $Doc->ExportCaption($this->noOfDays);
					if ($this->bookingTerm->Exportable) $Doc->ExportCaption($this->bookingTerm);
					if ($this->slab->Exportable) $Doc->ExportCaption($this->slab);
					if ($this->orangeCard->Exportable) $Doc->ExportCaption($this->orangeCard);
					if ($this->gps->Exportable) $Doc->ExportCaption($this->gps);
					if ($this->deliveryCharge->Exportable) $Doc->ExportCaption($this->deliveryCharge);
					if ($this->collectionCharge->Exportable) $Doc->ExportCaption($this->collectionCharge);
					if ($this->rentalAmount->Exportable) $Doc->ExportCaption($this->rentalAmount);
					if ($this->totalAmount->Exportable) $Doc->ExportCaption($this->totalAmount);
					if ($this->vat->Exportable) $Doc->ExportCaption($this->vat);
					if ($this->grandTotal->Exportable) $Doc->ExportCaption($this->grandTotal);
					if ($this->deliveryAddress->Exportable) $Doc->ExportCaption($this->deliveryAddress);
					if ($this->paymentMethod->Exportable) $Doc->ExportCaption($this->paymentMethod);
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
						if ($this->bookingID->Exportable) $Doc->ExportField($this->bookingID);
						if ($this->bookingNumber->Exportable) $Doc->ExportField($this->bookingNumber);
						if ($this->_userID->Exportable) $Doc->ExportField($this->_userID);
						if ($this->payDriveCarID->Exportable) $Doc->ExportField($this->payDriveCarID);
						if ($this->pickUpLocation->Exportable) $Doc->ExportField($this->pickUpLocation);
						if ($this->dropLocation->Exportable) $Doc->ExportField($this->dropLocation);
						if ($this->pickUpDate->Exportable) $Doc->ExportField($this->pickUpDate);
						if ($this->dropDate->Exportable) $Doc->ExportField($this->dropDate);
						if ($this->noOfDays->Exportable) $Doc->ExportField($this->noOfDays);
						if ($this->bookingTerm->Exportable) $Doc->ExportField($this->bookingTerm);
						if ($this->slab->Exportable) $Doc->ExportField($this->slab);
						if ($this->orangeCard->Exportable) $Doc->ExportField($this->orangeCard);
						if ($this->gps->Exportable) $Doc->ExportField($this->gps);
						if ($this->deliveryCharge->Exportable) $Doc->ExportField($this->deliveryCharge);
						if ($this->collectionCharge->Exportable) $Doc->ExportField($this->collectionCharge);
						if ($this->rentalAmount->Exportable) $Doc->ExportField($this->rentalAmount);
						if ($this->totalAmount->Exportable) $Doc->ExportField($this->totalAmount);
						if ($this->vat->Exportable) $Doc->ExportField($this->vat);
						if ($this->grandTotal->Exportable) $Doc->ExportField($this->grandTotal);
						if ($this->deliveryAddress->Exportable) $Doc->ExportField($this->deliveryAddress);
						if ($this->paymentMethod->Exportable) $Doc->ExportField($this->paymentMethod);
						if ($this->dateCreated->Exportable) $Doc->ExportField($this->dateCreated);
					} else {
						if ($this->bookingID->Exportable) $Doc->ExportField($this->bookingID);
						if ($this->bookingNumber->Exportable) $Doc->ExportField($this->bookingNumber);
						if ($this->_userID->Exportable) $Doc->ExportField($this->_userID);
						if ($this->payDriveCarID->Exportable) $Doc->ExportField($this->payDriveCarID);
						if ($this->pickUpLocation->Exportable) $Doc->ExportField($this->pickUpLocation);
						if ($this->dropLocation->Exportable) $Doc->ExportField($this->dropLocation);
						if ($this->pickUpDate->Exportable) $Doc->ExportField($this->pickUpDate);
						if ($this->dropDate->Exportable) $Doc->ExportField($this->dropDate);
						if ($this->noOfDays->Exportable) $Doc->ExportField($this->noOfDays);
						if ($this->bookingTerm->Exportable) $Doc->ExportField($this->bookingTerm);
						if ($this->slab->Exportable) $Doc->ExportField($this->slab);
						if ($this->orangeCard->Exportable) $Doc->ExportField($this->orangeCard);
						if ($this->gps->Exportable) $Doc->ExportField($this->gps);
						if ($this->deliveryCharge->Exportable) $Doc->ExportField($this->deliveryCharge);
						if ($this->collectionCharge->Exportable) $Doc->ExportField($this->collectionCharge);
						if ($this->rentalAmount->Exportable) $Doc->ExportField($this->rentalAmount);
						if ($this->totalAmount->Exportable) $Doc->ExportField($this->totalAmount);
						if ($this->vat->Exportable) $Doc->ExportField($this->vat);
						if ($this->grandTotal->Exportable) $Doc->ExportField($this->grandTotal);
						if ($this->deliveryAddress->Exportable) $Doc->ExportField($this->deliveryAddress);
						if ($this->paymentMethod->Exportable) $Doc->ExportField($this->paymentMethod);
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
