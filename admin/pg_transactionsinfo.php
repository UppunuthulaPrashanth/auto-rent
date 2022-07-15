<?php

// Global variable for table object
$pg_transactions = NULL;

//
// Table class for pg_transactions
//
class cpg_transactions extends cTable {
	var $transactionID;
	var $_userID;
	var $bookingNumber;
	var $bookingModule;
	var $order_id;
	var $tracking_id;
	var $bank_ref_no;
	var $order_status;
	var $failure_message;
	var $payment_mode;
	var $card_name;
	var $status_code;
	var $status_message;
	var $currency;
	var $amount;
	var $billing_name;
	var $billing_address;
	var $billing_city;
	var $billing_state;
	var $billing_zip;
	var $billing_country;
	var $billing_tel;
	var $billing_email;
	var $delivery_name;
	var $delivery_address;
	var $delivery_city;
	var $delivery_state;
	var $delivery_zip;
	var $delivery_country;
	var $delivery_tel;
	var $merchant_param1;
	var $merchant_param2;
	var $merchant_param3;
	var $merchant_param4;
	var $merchant_param5;
	var $vault;
	var $offer_type;
	var $offer_code;
	var $discount_value;
	var $mer_amount;
	var $eci_value;
	var $card_holder_name;
	var $bank_qsi_no;
	var $bank_receipt_no;
	var $merchant_param6;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'pg_transactions';
		$this->TableName = 'pg_transactions';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`pg_transactions`";
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

		// transactionID
		$this->transactionID = new cField('pg_transactions', 'pg_transactions', 'x_transactionID', 'transactionID', '`transactionID`', '`transactionID`', 3, -1, FALSE, '`transactionID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->transactionID->Sortable = TRUE; // Allow sort
		$this->transactionID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['transactionID'] = &$this->transactionID;

		// userID
		$this->_userID = new cField('pg_transactions', 'pg_transactions', 'x__userID', 'userID', '`userID`', '`userID`', 3, -1, FALSE, '`userID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->_userID->Sortable = TRUE; // Allow sort
		$this->_userID->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->_userID->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->_userID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['userID'] = &$this->_userID;

		// bookingNumber
		$this->bookingNumber = new cField('pg_transactions', 'pg_transactions', 'x_bookingNumber', 'bookingNumber', '`bookingNumber`', '`bookingNumber`', 200, -1, FALSE, '`bookingNumber`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->bookingNumber->Sortable = TRUE; // Allow sort
		$this->fields['bookingNumber'] = &$this->bookingNumber;

		// bookingModule
		$this->bookingModule = new cField('pg_transactions', 'pg_transactions', 'x_bookingModule', 'bookingModule', '`bookingModule`', '`bookingModule`', 202, -1, FALSE, '`bookingModule`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->bookingModule->Sortable = TRUE; // Allow sort
		$this->bookingModule->OptionCount = 2;
		$this->fields['bookingModule'] = &$this->bookingModule;

		// order_id
		$this->order_id = new cField('pg_transactions', 'pg_transactions', 'x_order_id', 'order_id', '`order_id`', '`order_id`', 200, -1, FALSE, '`order_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->order_id->Sortable = TRUE; // Allow sort
		$this->fields['order_id'] = &$this->order_id;

		// tracking_id
		$this->tracking_id = new cField('pg_transactions', 'pg_transactions', 'x_tracking_id', 'tracking_id', '`tracking_id`', '`tracking_id`', 200, -1, FALSE, '`tracking_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tracking_id->Sortable = TRUE; // Allow sort
		$this->fields['tracking_id'] = &$this->tracking_id;

		// bank_ref_no
		$this->bank_ref_no = new cField('pg_transactions', 'pg_transactions', 'x_bank_ref_no', 'bank_ref_no', '`bank_ref_no`', '`bank_ref_no`', 200, -1, FALSE, '`bank_ref_no`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->bank_ref_no->Sortable = TRUE; // Allow sort
		$this->fields['bank_ref_no'] = &$this->bank_ref_no;

		// order_status
		$this->order_status = new cField('pg_transactions', 'pg_transactions', 'x_order_status', 'order_status', '`order_status`', '`order_status`', 200, -1, FALSE, '`order_status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->order_status->Sortable = TRUE; // Allow sort
		$this->fields['order_status'] = &$this->order_status;

		// failure_message
		$this->failure_message = new cField('pg_transactions', 'pg_transactions', 'x_failure_message', 'failure_message', '`failure_message`', '`failure_message`', 200, -1, FALSE, '`failure_message`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->failure_message->Sortable = TRUE; // Allow sort
		$this->fields['failure_message'] = &$this->failure_message;

		// payment_mode
		$this->payment_mode = new cField('pg_transactions', 'pg_transactions', 'x_payment_mode', 'payment_mode', '`payment_mode`', '`payment_mode`', 200, -1, FALSE, '`payment_mode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->payment_mode->Sortable = TRUE; // Allow sort
		$this->fields['payment_mode'] = &$this->payment_mode;

		// card_name
		$this->card_name = new cField('pg_transactions', 'pg_transactions', 'x_card_name', 'card_name', '`card_name`', '`card_name`', 200, -1, FALSE, '`card_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->card_name->Sortable = TRUE; // Allow sort
		$this->fields['card_name'] = &$this->card_name;

		// status_code
		$this->status_code = new cField('pg_transactions', 'pg_transactions', 'x_status_code', 'status_code', '`status_code`', '`status_code`', 200, -1, FALSE, '`status_code`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->status_code->Sortable = TRUE; // Allow sort
		$this->fields['status_code'] = &$this->status_code;

		// status_message
		$this->status_message = new cField('pg_transactions', 'pg_transactions', 'x_status_message', 'status_message', '`status_message`', '`status_message`', 200, -1, FALSE, '`status_message`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->status_message->Sortable = TRUE; // Allow sort
		$this->fields['status_message'] = &$this->status_message;

		// currency
		$this->currency = new cField('pg_transactions', 'pg_transactions', 'x_currency', 'currency', '`currency`', '`currency`', 200, -1, FALSE, '`currency`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->currency->Sortable = TRUE; // Allow sort
		$this->fields['currency'] = &$this->currency;

		// amount
		$this->amount = new cField('pg_transactions', 'pg_transactions', 'x_amount', 'amount', '`amount`', '`amount`', 200, -1, FALSE, '`amount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->amount->Sortable = TRUE; // Allow sort
		$this->fields['amount'] = &$this->amount;

		// billing_name
		$this->billing_name = new cField('pg_transactions', 'pg_transactions', 'x_billing_name', 'billing_name', '`billing_name`', '`billing_name`', 200, -1, FALSE, '`billing_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->billing_name->Sortable = TRUE; // Allow sort
		$this->fields['billing_name'] = &$this->billing_name;

		// billing_address
		$this->billing_address = new cField('pg_transactions', 'pg_transactions', 'x_billing_address', 'billing_address', '`billing_address`', '`billing_address`', 201, -1, FALSE, '`billing_address`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->billing_address->Sortable = TRUE; // Allow sort
		$this->fields['billing_address'] = &$this->billing_address;

		// billing_city
		$this->billing_city = new cField('pg_transactions', 'pg_transactions', 'x_billing_city', 'billing_city', '`billing_city`', '`billing_city`', 200, -1, FALSE, '`billing_city`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->billing_city->Sortable = TRUE; // Allow sort
		$this->fields['billing_city'] = &$this->billing_city;

		// billing_state
		$this->billing_state = new cField('pg_transactions', 'pg_transactions', 'x_billing_state', 'billing_state', '`billing_state`', '`billing_state`', 200, -1, FALSE, '`billing_state`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->billing_state->Sortable = TRUE; // Allow sort
		$this->fields['billing_state'] = &$this->billing_state;

		// billing_zip
		$this->billing_zip = new cField('pg_transactions', 'pg_transactions', 'x_billing_zip', 'billing_zip', '`billing_zip`', '`billing_zip`', 200, -1, FALSE, '`billing_zip`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->billing_zip->Sortable = TRUE; // Allow sort
		$this->fields['billing_zip'] = &$this->billing_zip;

		// billing_country
		$this->billing_country = new cField('pg_transactions', 'pg_transactions', 'x_billing_country', 'billing_country', '`billing_country`', '`billing_country`', 200, -1, FALSE, '`billing_country`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->billing_country->Sortable = TRUE; // Allow sort
		$this->fields['billing_country'] = &$this->billing_country;

		// billing_tel
		$this->billing_tel = new cField('pg_transactions', 'pg_transactions', 'x_billing_tel', 'billing_tel', '`billing_tel`', '`billing_tel`', 200, -1, FALSE, '`billing_tel`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->billing_tel->Sortable = TRUE; // Allow sort
		$this->fields['billing_tel'] = &$this->billing_tel;

		// billing_email
		$this->billing_email = new cField('pg_transactions', 'pg_transactions', 'x_billing_email', 'billing_email', '`billing_email`', '`billing_email`', 200, -1, FALSE, '`billing_email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->billing_email->Sortable = TRUE; // Allow sort
		$this->fields['billing_email'] = &$this->billing_email;

		// delivery_name
		$this->delivery_name = new cField('pg_transactions', 'pg_transactions', 'x_delivery_name', 'delivery_name', '`delivery_name`', '`delivery_name`', 200, -1, FALSE, '`delivery_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->delivery_name->Sortable = TRUE; // Allow sort
		$this->fields['delivery_name'] = &$this->delivery_name;

		// delivery_address
		$this->delivery_address = new cField('pg_transactions', 'pg_transactions', 'x_delivery_address', 'delivery_address', '`delivery_address`', '`delivery_address`', 201, -1, FALSE, '`delivery_address`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->delivery_address->Sortable = TRUE; // Allow sort
		$this->fields['delivery_address'] = &$this->delivery_address;

		// delivery_city
		$this->delivery_city = new cField('pg_transactions', 'pg_transactions', 'x_delivery_city', 'delivery_city', '`delivery_city`', '`delivery_city`', 200, -1, FALSE, '`delivery_city`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->delivery_city->Sortable = TRUE; // Allow sort
		$this->fields['delivery_city'] = &$this->delivery_city;

		// delivery_state
		$this->delivery_state = new cField('pg_transactions', 'pg_transactions', 'x_delivery_state', 'delivery_state', '`delivery_state`', '`delivery_state`', 200, -1, FALSE, '`delivery_state`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->delivery_state->Sortable = TRUE; // Allow sort
		$this->fields['delivery_state'] = &$this->delivery_state;

		// delivery_zip
		$this->delivery_zip = new cField('pg_transactions', 'pg_transactions', 'x_delivery_zip', 'delivery_zip', '`delivery_zip`', '`delivery_zip`', 200, -1, FALSE, '`delivery_zip`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->delivery_zip->Sortable = TRUE; // Allow sort
		$this->fields['delivery_zip'] = &$this->delivery_zip;

		// delivery_country
		$this->delivery_country = new cField('pg_transactions', 'pg_transactions', 'x_delivery_country', 'delivery_country', '`delivery_country`', '`delivery_country`', 200, -1, FALSE, '`delivery_country`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->delivery_country->Sortable = TRUE; // Allow sort
		$this->fields['delivery_country'] = &$this->delivery_country;

		// delivery_tel
		$this->delivery_tel = new cField('pg_transactions', 'pg_transactions', 'x_delivery_tel', 'delivery_tel', '`delivery_tel`', '`delivery_tel`', 200, -1, FALSE, '`delivery_tel`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->delivery_tel->Sortable = TRUE; // Allow sort
		$this->fields['delivery_tel'] = &$this->delivery_tel;

		// merchant_param1
		$this->merchant_param1 = new cField('pg_transactions', 'pg_transactions', 'x_merchant_param1', 'merchant_param1', '`merchant_param1`', '`merchant_param1`', 201, -1, FALSE, '`merchant_param1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->merchant_param1->Sortable = TRUE; // Allow sort
		$this->fields['merchant_param1'] = &$this->merchant_param1;

		// merchant_param2
		$this->merchant_param2 = new cField('pg_transactions', 'pg_transactions', 'x_merchant_param2', 'merchant_param2', '`merchant_param2`', '`merchant_param2`', 201, -1, FALSE, '`merchant_param2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->merchant_param2->Sortable = TRUE; // Allow sort
		$this->fields['merchant_param2'] = &$this->merchant_param2;

		// merchant_param3
		$this->merchant_param3 = new cField('pg_transactions', 'pg_transactions', 'x_merchant_param3', 'merchant_param3', '`merchant_param3`', '`merchant_param3`', 201, -1, FALSE, '`merchant_param3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->merchant_param3->Sortable = TRUE; // Allow sort
		$this->fields['merchant_param3'] = &$this->merchant_param3;

		// merchant_param4
		$this->merchant_param4 = new cField('pg_transactions', 'pg_transactions', 'x_merchant_param4', 'merchant_param4', '`merchant_param4`', '`merchant_param4`', 201, -1, FALSE, '`merchant_param4`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->merchant_param4->Sortable = TRUE; // Allow sort
		$this->fields['merchant_param4'] = &$this->merchant_param4;

		// merchant_param5
		$this->merchant_param5 = new cField('pg_transactions', 'pg_transactions', 'x_merchant_param5', 'merchant_param5', '`merchant_param5`', '`merchant_param5`', 201, -1, FALSE, '`merchant_param5`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->merchant_param5->Sortable = TRUE; // Allow sort
		$this->fields['merchant_param5'] = &$this->merchant_param5;

		// vault
		$this->vault = new cField('pg_transactions', 'pg_transactions', 'x_vault', 'vault', '`vault`', '`vault`', 200, -1, FALSE, '`vault`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->vault->Sortable = TRUE; // Allow sort
		$this->fields['vault'] = &$this->vault;

		// offer_type
		$this->offer_type = new cField('pg_transactions', 'pg_transactions', 'x_offer_type', 'offer_type', '`offer_type`', '`offer_type`', 200, -1, FALSE, '`offer_type`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->offer_type->Sortable = TRUE; // Allow sort
		$this->fields['offer_type'] = &$this->offer_type;

		// offer_code
		$this->offer_code = new cField('pg_transactions', 'pg_transactions', 'x_offer_code', 'offer_code', '`offer_code`', '`offer_code`', 200, -1, FALSE, '`offer_code`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->offer_code->Sortable = TRUE; // Allow sort
		$this->fields['offer_code'] = &$this->offer_code;

		// discount_value
		$this->discount_value = new cField('pg_transactions', 'pg_transactions', 'x_discount_value', 'discount_value', '`discount_value`', '`discount_value`', 200, -1, FALSE, '`discount_value`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->discount_value->Sortable = TRUE; // Allow sort
		$this->fields['discount_value'] = &$this->discount_value;

		// mer_amount
		$this->mer_amount = new cField('pg_transactions', 'pg_transactions', 'x_mer_amount', 'mer_amount', '`mer_amount`', '`mer_amount`', 200, -1, FALSE, '`mer_amount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->mer_amount->Sortable = TRUE; // Allow sort
		$this->fields['mer_amount'] = &$this->mer_amount;

		// eci_value
		$this->eci_value = new cField('pg_transactions', 'pg_transactions', 'x_eci_value', 'eci_value', '`eci_value`', '`eci_value`', 200, -1, FALSE, '`eci_value`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->eci_value->Sortable = TRUE; // Allow sort
		$this->fields['eci_value'] = &$this->eci_value;

		// card_holder_name
		$this->card_holder_name = new cField('pg_transactions', 'pg_transactions', 'x_card_holder_name', 'card_holder_name', '`card_holder_name`', '`card_holder_name`', 200, -1, FALSE, '`card_holder_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->card_holder_name->Sortable = TRUE; // Allow sort
		$this->fields['card_holder_name'] = &$this->card_holder_name;

		// bank_qsi_no
		$this->bank_qsi_no = new cField('pg_transactions', 'pg_transactions', 'x_bank_qsi_no', 'bank_qsi_no', '`bank_qsi_no`', '`bank_qsi_no`', 200, -1, FALSE, '`bank_qsi_no`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->bank_qsi_no->Sortable = TRUE; // Allow sort
		$this->fields['bank_qsi_no'] = &$this->bank_qsi_no;

		// bank_receipt_no
		$this->bank_receipt_no = new cField('pg_transactions', 'pg_transactions', 'x_bank_receipt_no', 'bank_receipt_no', '`bank_receipt_no`', '`bank_receipt_no`', 200, -1, FALSE, '`bank_receipt_no`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->bank_receipt_no->Sortable = TRUE; // Allow sort
		$this->fields['bank_receipt_no'] = &$this->bank_receipt_no;

		// merchant_param6
		$this->merchant_param6 = new cField('pg_transactions', 'pg_transactions', 'x_merchant_param6', 'merchant_param6', '`merchant_param6`', '`merchant_param6`', 200, -1, FALSE, '`merchant_param6`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->merchant_param6->Sortable = TRUE; // Allow sort
		$this->fields['merchant_param6'] = &$this->merchant_param6;
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`pg_transactions`";
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
			$this->transactionID->setDbValue($conn->Insert_ID());
			$rs['transactionID'] = $this->transactionID->DbValue;
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
			if (array_key_exists('transactionID', $rs))
				ew_AddFilter($where, ew_QuotedName('transactionID', $this->DBID) . '=' . ew_QuotedValue($rs['transactionID'], $this->transactionID->FldDataType, $this->DBID));
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
		return "`transactionID` = @transactionID@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->transactionID->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->transactionID->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@transactionID@", ew_AdjustSql($this->transactionID->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "pg_transactionslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "pg_transactionsview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "pg_transactionsedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "pg_transactionsadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "pg_transactionslist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("pg_transactionsview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("pg_transactionsview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "pg_transactionsadd.php?" . $this->UrlParm($parm);
		else
			$url = "pg_transactionsadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("pg_transactionsedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("pg_transactionsadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("pg_transactionsdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "transactionID:" . ew_VarToJson($this->transactionID->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->transactionID->CurrentValue)) {
			$sUrl .= "transactionID=" . urlencode($this->transactionID->CurrentValue);
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
			if ($isPost && isset($_POST["transactionID"]))
				$arKeys[] = $_POST["transactionID"];
			elseif (isset($_GET["transactionID"]))
				$arKeys[] = $_GET["transactionID"];
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
			$this->transactionID->CurrentValue = $key;
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
		$this->transactionID->setDbValue($rs->fields('transactionID'));
		$this->_userID->setDbValue($rs->fields('userID'));
		$this->bookingNumber->setDbValue($rs->fields('bookingNumber'));
		$this->bookingModule->setDbValue($rs->fields('bookingModule'));
		$this->order_id->setDbValue($rs->fields('order_id'));
		$this->tracking_id->setDbValue($rs->fields('tracking_id'));
		$this->bank_ref_no->setDbValue($rs->fields('bank_ref_no'));
		$this->order_status->setDbValue($rs->fields('order_status'));
		$this->failure_message->setDbValue($rs->fields('failure_message'));
		$this->payment_mode->setDbValue($rs->fields('payment_mode'));
		$this->card_name->setDbValue($rs->fields('card_name'));
		$this->status_code->setDbValue($rs->fields('status_code'));
		$this->status_message->setDbValue($rs->fields('status_message'));
		$this->currency->setDbValue($rs->fields('currency'));
		$this->amount->setDbValue($rs->fields('amount'));
		$this->billing_name->setDbValue($rs->fields('billing_name'));
		$this->billing_address->setDbValue($rs->fields('billing_address'));
		$this->billing_city->setDbValue($rs->fields('billing_city'));
		$this->billing_state->setDbValue($rs->fields('billing_state'));
		$this->billing_zip->setDbValue($rs->fields('billing_zip'));
		$this->billing_country->setDbValue($rs->fields('billing_country'));
		$this->billing_tel->setDbValue($rs->fields('billing_tel'));
		$this->billing_email->setDbValue($rs->fields('billing_email'));
		$this->delivery_name->setDbValue($rs->fields('delivery_name'));
		$this->delivery_address->setDbValue($rs->fields('delivery_address'));
		$this->delivery_city->setDbValue($rs->fields('delivery_city'));
		$this->delivery_state->setDbValue($rs->fields('delivery_state'));
		$this->delivery_zip->setDbValue($rs->fields('delivery_zip'));
		$this->delivery_country->setDbValue($rs->fields('delivery_country'));
		$this->delivery_tel->setDbValue($rs->fields('delivery_tel'));
		$this->merchant_param1->setDbValue($rs->fields('merchant_param1'));
		$this->merchant_param2->setDbValue($rs->fields('merchant_param2'));
		$this->merchant_param3->setDbValue($rs->fields('merchant_param3'));
		$this->merchant_param4->setDbValue($rs->fields('merchant_param4'));
		$this->merchant_param5->setDbValue($rs->fields('merchant_param5'));
		$this->vault->setDbValue($rs->fields('vault'));
		$this->offer_type->setDbValue($rs->fields('offer_type'));
		$this->offer_code->setDbValue($rs->fields('offer_code'));
		$this->discount_value->setDbValue($rs->fields('discount_value'));
		$this->mer_amount->setDbValue($rs->fields('mer_amount'));
		$this->eci_value->setDbValue($rs->fields('eci_value'));
		$this->card_holder_name->setDbValue($rs->fields('card_holder_name'));
		$this->bank_qsi_no->setDbValue($rs->fields('bank_qsi_no'));
		$this->bank_receipt_no->setDbValue($rs->fields('bank_receipt_no'));
		$this->merchant_param6->setDbValue($rs->fields('merchant_param6'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// transactionID
		// userID
		// bookingNumber
		// bookingModule
		// order_id
		// tracking_id
		// bank_ref_no
		// order_status
		// failure_message
		// payment_mode
		// card_name
		// status_code
		// status_message
		// currency
		// amount
		// billing_name
		// billing_address
		// billing_city
		// billing_state
		// billing_zip
		// billing_country
		// billing_tel
		// billing_email
		// delivery_name
		// delivery_address
		// delivery_city
		// delivery_state
		// delivery_zip
		// delivery_country
		// delivery_tel
		// merchant_param1
		// merchant_param2
		// merchant_param3
		// merchant_param4
		// merchant_param5
		// vault
		// offer_type
		// offer_code
		// discount_value
		// mer_amount
		// eci_value
		// card_holder_name
		// bank_qsi_no
		// bank_receipt_no
		// merchant_param6
		// transactionID

		$this->transactionID->ViewValue = $this->transactionID->CurrentValue;
		$this->transactionID->ViewCustomAttributes = "";

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

		// bookingNumber
		$this->bookingNumber->ViewValue = $this->bookingNumber->CurrentValue;
		$this->bookingNumber->ViewCustomAttributes = "";

		// bookingModule
		if (strval($this->bookingModule->CurrentValue) <> "") {
			$this->bookingModule->ViewValue = $this->bookingModule->OptionCaption($this->bookingModule->CurrentValue);
		} else {
			$this->bookingModule->ViewValue = NULL;
		}
		$this->bookingModule->ViewCustomAttributes = "";

		// order_id
		$this->order_id->ViewValue = $this->order_id->CurrentValue;
		$this->order_id->ViewCustomAttributes = "";

		// tracking_id
		$this->tracking_id->ViewValue = $this->tracking_id->CurrentValue;
		$this->tracking_id->ViewCustomAttributes = "";

		// bank_ref_no
		$this->bank_ref_no->ViewValue = $this->bank_ref_no->CurrentValue;
		$this->bank_ref_no->ViewCustomAttributes = "";

		// order_status
		$this->order_status->ViewValue = $this->order_status->CurrentValue;
		$this->order_status->ViewCustomAttributes = "";

		// failure_message
		$this->failure_message->ViewValue = $this->failure_message->CurrentValue;
		$this->failure_message->ViewCustomAttributes = "";

		// payment_mode
		$this->payment_mode->ViewValue = $this->payment_mode->CurrentValue;
		$this->payment_mode->ViewCustomAttributes = "";

		// card_name
		$this->card_name->ViewValue = $this->card_name->CurrentValue;
		$this->card_name->ViewCustomAttributes = "";

		// status_code
		$this->status_code->ViewValue = $this->status_code->CurrentValue;
		$this->status_code->ViewCustomAttributes = "";

		// status_message
		$this->status_message->ViewValue = $this->status_message->CurrentValue;
		$this->status_message->ViewCustomAttributes = "";

		// currency
		$this->currency->ViewValue = $this->currency->CurrentValue;
		$this->currency->ViewCustomAttributes = "";

		// amount
		$this->amount->ViewValue = $this->amount->CurrentValue;
		$this->amount->ViewCustomAttributes = "";

		// billing_name
		$this->billing_name->ViewValue = $this->billing_name->CurrentValue;
		$this->billing_name->ViewCustomAttributes = "";

		// billing_address
		$this->billing_address->ViewValue = $this->billing_address->CurrentValue;
		$this->billing_address->ViewCustomAttributes = "";

		// billing_city
		$this->billing_city->ViewValue = $this->billing_city->CurrentValue;
		$this->billing_city->ViewCustomAttributes = "";

		// billing_state
		$this->billing_state->ViewValue = $this->billing_state->CurrentValue;
		$this->billing_state->ViewCustomAttributes = "";

		// billing_zip
		$this->billing_zip->ViewValue = $this->billing_zip->CurrentValue;
		$this->billing_zip->ViewCustomAttributes = "";

		// billing_country
		$this->billing_country->ViewValue = $this->billing_country->CurrentValue;
		$this->billing_country->ViewCustomAttributes = "";

		// billing_tel
		$this->billing_tel->ViewValue = $this->billing_tel->CurrentValue;
		$this->billing_tel->ViewCustomAttributes = "";

		// billing_email
		$this->billing_email->ViewValue = $this->billing_email->CurrentValue;
		$this->billing_email->ViewCustomAttributes = "";

		// delivery_name
		$this->delivery_name->ViewValue = $this->delivery_name->CurrentValue;
		$this->delivery_name->ViewCustomAttributes = "";

		// delivery_address
		$this->delivery_address->ViewValue = $this->delivery_address->CurrentValue;
		$this->delivery_address->ViewCustomAttributes = "";

		// delivery_city
		$this->delivery_city->ViewValue = $this->delivery_city->CurrentValue;
		$this->delivery_city->ViewCustomAttributes = "";

		// delivery_state
		$this->delivery_state->ViewValue = $this->delivery_state->CurrentValue;
		$this->delivery_state->ViewCustomAttributes = "";

		// delivery_zip
		$this->delivery_zip->ViewValue = $this->delivery_zip->CurrentValue;
		$this->delivery_zip->ViewCustomAttributes = "";

		// delivery_country
		$this->delivery_country->ViewValue = $this->delivery_country->CurrentValue;
		$this->delivery_country->ViewCustomAttributes = "";

		// delivery_tel
		$this->delivery_tel->ViewValue = $this->delivery_tel->CurrentValue;
		$this->delivery_tel->ViewCustomAttributes = "";

		// merchant_param1
		$this->merchant_param1->ViewValue = $this->merchant_param1->CurrentValue;
		$this->merchant_param1->ViewCustomAttributes = "";

		// merchant_param2
		$this->merchant_param2->ViewValue = $this->merchant_param2->CurrentValue;
		$this->merchant_param2->ViewCustomAttributes = "";

		// merchant_param3
		$this->merchant_param3->ViewValue = $this->merchant_param3->CurrentValue;
		$this->merchant_param3->ViewCustomAttributes = "";

		// merchant_param4
		$this->merchant_param4->ViewValue = $this->merchant_param4->CurrentValue;
		$this->merchant_param4->ViewCustomAttributes = "";

		// merchant_param5
		$this->merchant_param5->ViewValue = $this->merchant_param5->CurrentValue;
		$this->merchant_param5->ViewCustomAttributes = "";

		// vault
		$this->vault->ViewValue = $this->vault->CurrentValue;
		$this->vault->ViewCustomAttributes = "";

		// offer_type
		$this->offer_type->ViewValue = $this->offer_type->CurrentValue;
		$this->offer_type->ViewCustomAttributes = "";

		// offer_code
		$this->offer_code->ViewValue = $this->offer_code->CurrentValue;
		$this->offer_code->ViewCustomAttributes = "";

		// discount_value
		$this->discount_value->ViewValue = $this->discount_value->CurrentValue;
		$this->discount_value->ViewCustomAttributes = "";

		// mer_amount
		$this->mer_amount->ViewValue = $this->mer_amount->CurrentValue;
		$this->mer_amount->ViewCustomAttributes = "";

		// eci_value
		$this->eci_value->ViewValue = $this->eci_value->CurrentValue;
		$this->eci_value->ViewCustomAttributes = "";

		// card_holder_name
		$this->card_holder_name->ViewValue = $this->card_holder_name->CurrentValue;
		$this->card_holder_name->ViewCustomAttributes = "";

		// bank_qsi_no
		$this->bank_qsi_no->ViewValue = $this->bank_qsi_no->CurrentValue;
		$this->bank_qsi_no->ViewCustomAttributes = "";

		// bank_receipt_no
		$this->bank_receipt_no->ViewValue = $this->bank_receipt_no->CurrentValue;
		$this->bank_receipt_no->ViewCustomAttributes = "";

		// merchant_param6
		$this->merchant_param6->ViewValue = $this->merchant_param6->CurrentValue;
		$this->merchant_param6->ViewCustomAttributes = "";

		// transactionID
		$this->transactionID->LinkCustomAttributes = "";
		$this->transactionID->HrefValue = "";
		$this->transactionID->TooltipValue = "";

		// userID
		$this->_userID->LinkCustomAttributes = "";
		$this->_userID->HrefValue = "";
		$this->_userID->TooltipValue = "";

		// bookingNumber
		$this->bookingNumber->LinkCustomAttributes = "";
		$this->bookingNumber->HrefValue = "";
		$this->bookingNumber->TooltipValue = "";

		// bookingModule
		$this->bookingModule->LinkCustomAttributes = "";
		$this->bookingModule->HrefValue = "";
		$this->bookingModule->TooltipValue = "";

		// order_id
		$this->order_id->LinkCustomAttributes = "";
		$this->order_id->HrefValue = "";
		$this->order_id->TooltipValue = "";

		// tracking_id
		$this->tracking_id->LinkCustomAttributes = "";
		$this->tracking_id->HrefValue = "";
		$this->tracking_id->TooltipValue = "";

		// bank_ref_no
		$this->bank_ref_no->LinkCustomAttributes = "";
		$this->bank_ref_no->HrefValue = "";
		$this->bank_ref_no->TooltipValue = "";

		// order_status
		$this->order_status->LinkCustomAttributes = "";
		$this->order_status->HrefValue = "";
		$this->order_status->TooltipValue = "";

		// failure_message
		$this->failure_message->LinkCustomAttributes = "";
		$this->failure_message->HrefValue = "";
		$this->failure_message->TooltipValue = "";

		// payment_mode
		$this->payment_mode->LinkCustomAttributes = "";
		$this->payment_mode->HrefValue = "";
		$this->payment_mode->TooltipValue = "";

		// card_name
		$this->card_name->LinkCustomAttributes = "";
		$this->card_name->HrefValue = "";
		$this->card_name->TooltipValue = "";

		// status_code
		$this->status_code->LinkCustomAttributes = "";
		$this->status_code->HrefValue = "";
		$this->status_code->TooltipValue = "";

		// status_message
		$this->status_message->LinkCustomAttributes = "";
		$this->status_message->HrefValue = "";
		$this->status_message->TooltipValue = "";

		// currency
		$this->currency->LinkCustomAttributes = "";
		$this->currency->HrefValue = "";
		$this->currency->TooltipValue = "";

		// amount
		$this->amount->LinkCustomAttributes = "";
		$this->amount->HrefValue = "";
		$this->amount->TooltipValue = "";

		// billing_name
		$this->billing_name->LinkCustomAttributes = "";
		$this->billing_name->HrefValue = "";
		$this->billing_name->TooltipValue = "";

		// billing_address
		$this->billing_address->LinkCustomAttributes = "";
		$this->billing_address->HrefValue = "";
		$this->billing_address->TooltipValue = "";

		// billing_city
		$this->billing_city->LinkCustomAttributes = "";
		$this->billing_city->HrefValue = "";
		$this->billing_city->TooltipValue = "";

		// billing_state
		$this->billing_state->LinkCustomAttributes = "";
		$this->billing_state->HrefValue = "";
		$this->billing_state->TooltipValue = "";

		// billing_zip
		$this->billing_zip->LinkCustomAttributes = "";
		$this->billing_zip->HrefValue = "";
		$this->billing_zip->TooltipValue = "";

		// billing_country
		$this->billing_country->LinkCustomAttributes = "";
		$this->billing_country->HrefValue = "";
		$this->billing_country->TooltipValue = "";

		// billing_tel
		$this->billing_tel->LinkCustomAttributes = "";
		$this->billing_tel->HrefValue = "";
		$this->billing_tel->TooltipValue = "";

		// billing_email
		$this->billing_email->LinkCustomAttributes = "";
		$this->billing_email->HrefValue = "";
		$this->billing_email->TooltipValue = "";

		// delivery_name
		$this->delivery_name->LinkCustomAttributes = "";
		$this->delivery_name->HrefValue = "";
		$this->delivery_name->TooltipValue = "";

		// delivery_address
		$this->delivery_address->LinkCustomAttributes = "";
		$this->delivery_address->HrefValue = "";
		$this->delivery_address->TooltipValue = "";

		// delivery_city
		$this->delivery_city->LinkCustomAttributes = "";
		$this->delivery_city->HrefValue = "";
		$this->delivery_city->TooltipValue = "";

		// delivery_state
		$this->delivery_state->LinkCustomAttributes = "";
		$this->delivery_state->HrefValue = "";
		$this->delivery_state->TooltipValue = "";

		// delivery_zip
		$this->delivery_zip->LinkCustomAttributes = "";
		$this->delivery_zip->HrefValue = "";
		$this->delivery_zip->TooltipValue = "";

		// delivery_country
		$this->delivery_country->LinkCustomAttributes = "";
		$this->delivery_country->HrefValue = "";
		$this->delivery_country->TooltipValue = "";

		// delivery_tel
		$this->delivery_tel->LinkCustomAttributes = "";
		$this->delivery_tel->HrefValue = "";
		$this->delivery_tel->TooltipValue = "";

		// merchant_param1
		$this->merchant_param1->LinkCustomAttributes = "";
		$this->merchant_param1->HrefValue = "";
		$this->merchant_param1->TooltipValue = "";

		// merchant_param2
		$this->merchant_param2->LinkCustomAttributes = "";
		$this->merchant_param2->HrefValue = "";
		$this->merchant_param2->TooltipValue = "";

		// merchant_param3
		$this->merchant_param3->LinkCustomAttributes = "";
		$this->merchant_param3->HrefValue = "";
		$this->merchant_param3->TooltipValue = "";

		// merchant_param4
		$this->merchant_param4->LinkCustomAttributes = "";
		$this->merchant_param4->HrefValue = "";
		$this->merchant_param4->TooltipValue = "";

		// merchant_param5
		$this->merchant_param5->LinkCustomAttributes = "";
		$this->merchant_param5->HrefValue = "";
		$this->merchant_param5->TooltipValue = "";

		// vault
		$this->vault->LinkCustomAttributes = "";
		$this->vault->HrefValue = "";
		$this->vault->TooltipValue = "";

		// offer_type
		$this->offer_type->LinkCustomAttributes = "";
		$this->offer_type->HrefValue = "";
		$this->offer_type->TooltipValue = "";

		// offer_code
		$this->offer_code->LinkCustomAttributes = "";
		$this->offer_code->HrefValue = "";
		$this->offer_code->TooltipValue = "";

		// discount_value
		$this->discount_value->LinkCustomAttributes = "";
		$this->discount_value->HrefValue = "";
		$this->discount_value->TooltipValue = "";

		// mer_amount
		$this->mer_amount->LinkCustomAttributes = "";
		$this->mer_amount->HrefValue = "";
		$this->mer_amount->TooltipValue = "";

		// eci_value
		$this->eci_value->LinkCustomAttributes = "";
		$this->eci_value->HrefValue = "";
		$this->eci_value->TooltipValue = "";

		// card_holder_name
		$this->card_holder_name->LinkCustomAttributes = "";
		$this->card_holder_name->HrefValue = "";
		$this->card_holder_name->TooltipValue = "";

		// bank_qsi_no
		$this->bank_qsi_no->LinkCustomAttributes = "";
		$this->bank_qsi_no->HrefValue = "";
		$this->bank_qsi_no->TooltipValue = "";

		// bank_receipt_no
		$this->bank_receipt_no->LinkCustomAttributes = "";
		$this->bank_receipt_no->HrefValue = "";
		$this->bank_receipt_no->TooltipValue = "";

		// merchant_param6
		$this->merchant_param6->LinkCustomAttributes = "";
		$this->merchant_param6->HrefValue = "";
		$this->merchant_param6->TooltipValue = "";

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

		// transactionID
		$this->transactionID->EditAttrs["class"] = "form-control";
		$this->transactionID->EditCustomAttributes = "";
		$this->transactionID->EditValue = $this->transactionID->CurrentValue;
		$this->transactionID->ViewCustomAttributes = "";

		// userID
		$this->_userID->EditAttrs["class"] = "form-control";
		$this->_userID->EditCustomAttributes = "";

		// bookingNumber
		$this->bookingNumber->EditAttrs["class"] = "form-control";
		$this->bookingNumber->EditCustomAttributes = "";
		$this->bookingNumber->EditValue = $this->bookingNumber->CurrentValue;
		$this->bookingNumber->PlaceHolder = ew_RemoveHtml($this->bookingNumber->FldCaption());

		// bookingModule
		$this->bookingModule->EditCustomAttributes = "";
		$this->bookingModule->EditValue = $this->bookingModule->Options(FALSE);

		// order_id
		$this->order_id->EditAttrs["class"] = "form-control";
		$this->order_id->EditCustomAttributes = "";
		$this->order_id->EditValue = $this->order_id->CurrentValue;
		$this->order_id->PlaceHolder = ew_RemoveHtml($this->order_id->FldCaption());

		// tracking_id
		$this->tracking_id->EditAttrs["class"] = "form-control";
		$this->tracking_id->EditCustomAttributes = "";
		$this->tracking_id->EditValue = $this->tracking_id->CurrentValue;
		$this->tracking_id->PlaceHolder = ew_RemoveHtml($this->tracking_id->FldCaption());

		// bank_ref_no
		$this->bank_ref_no->EditAttrs["class"] = "form-control";
		$this->bank_ref_no->EditCustomAttributes = "";
		$this->bank_ref_no->EditValue = $this->bank_ref_no->CurrentValue;
		$this->bank_ref_no->PlaceHolder = ew_RemoveHtml($this->bank_ref_no->FldCaption());

		// order_status
		$this->order_status->EditAttrs["class"] = "form-control";
		$this->order_status->EditCustomAttributes = "";
		$this->order_status->EditValue = $this->order_status->CurrentValue;
		$this->order_status->PlaceHolder = ew_RemoveHtml($this->order_status->FldCaption());

		// failure_message
		$this->failure_message->EditAttrs["class"] = "form-control";
		$this->failure_message->EditCustomAttributes = "";
		$this->failure_message->EditValue = $this->failure_message->CurrentValue;
		$this->failure_message->PlaceHolder = ew_RemoveHtml($this->failure_message->FldCaption());

		// payment_mode
		$this->payment_mode->EditAttrs["class"] = "form-control";
		$this->payment_mode->EditCustomAttributes = "";
		$this->payment_mode->EditValue = $this->payment_mode->CurrentValue;
		$this->payment_mode->PlaceHolder = ew_RemoveHtml($this->payment_mode->FldCaption());

		// card_name
		$this->card_name->EditAttrs["class"] = "form-control";
		$this->card_name->EditCustomAttributes = "";
		$this->card_name->EditValue = $this->card_name->CurrentValue;
		$this->card_name->PlaceHolder = ew_RemoveHtml($this->card_name->FldCaption());

		// status_code
		$this->status_code->EditAttrs["class"] = "form-control";
		$this->status_code->EditCustomAttributes = "";
		$this->status_code->EditValue = $this->status_code->CurrentValue;
		$this->status_code->PlaceHolder = ew_RemoveHtml($this->status_code->FldCaption());

		// status_message
		$this->status_message->EditAttrs["class"] = "form-control";
		$this->status_message->EditCustomAttributes = "";
		$this->status_message->EditValue = $this->status_message->CurrentValue;
		$this->status_message->PlaceHolder = ew_RemoveHtml($this->status_message->FldCaption());

		// currency
		$this->currency->EditAttrs["class"] = "form-control";
		$this->currency->EditCustomAttributes = "";
		$this->currency->EditValue = $this->currency->CurrentValue;
		$this->currency->PlaceHolder = ew_RemoveHtml($this->currency->FldCaption());

		// amount
		$this->amount->EditAttrs["class"] = "form-control";
		$this->amount->EditCustomAttributes = "";
		$this->amount->EditValue = $this->amount->CurrentValue;
		$this->amount->PlaceHolder = ew_RemoveHtml($this->amount->FldCaption());

		// billing_name
		$this->billing_name->EditAttrs["class"] = "form-control";
		$this->billing_name->EditCustomAttributes = "";
		$this->billing_name->EditValue = $this->billing_name->CurrentValue;
		$this->billing_name->PlaceHolder = ew_RemoveHtml($this->billing_name->FldCaption());

		// billing_address
		$this->billing_address->EditAttrs["class"] = "form-control";
		$this->billing_address->EditCustomAttributes = "";
		$this->billing_address->EditValue = $this->billing_address->CurrentValue;
		$this->billing_address->PlaceHolder = ew_RemoveHtml($this->billing_address->FldCaption());

		// billing_city
		$this->billing_city->EditAttrs["class"] = "form-control";
		$this->billing_city->EditCustomAttributes = "";
		$this->billing_city->EditValue = $this->billing_city->CurrentValue;
		$this->billing_city->PlaceHolder = ew_RemoveHtml($this->billing_city->FldCaption());

		// billing_state
		$this->billing_state->EditAttrs["class"] = "form-control";
		$this->billing_state->EditCustomAttributes = "";
		$this->billing_state->EditValue = $this->billing_state->CurrentValue;
		$this->billing_state->PlaceHolder = ew_RemoveHtml($this->billing_state->FldCaption());

		// billing_zip
		$this->billing_zip->EditAttrs["class"] = "form-control";
		$this->billing_zip->EditCustomAttributes = "";
		$this->billing_zip->EditValue = $this->billing_zip->CurrentValue;
		$this->billing_zip->PlaceHolder = ew_RemoveHtml($this->billing_zip->FldCaption());

		// billing_country
		$this->billing_country->EditAttrs["class"] = "form-control";
		$this->billing_country->EditCustomAttributes = "";
		$this->billing_country->EditValue = $this->billing_country->CurrentValue;
		$this->billing_country->PlaceHolder = ew_RemoveHtml($this->billing_country->FldCaption());

		// billing_tel
		$this->billing_tel->EditAttrs["class"] = "form-control";
		$this->billing_tel->EditCustomAttributes = "";
		$this->billing_tel->EditValue = $this->billing_tel->CurrentValue;
		$this->billing_tel->PlaceHolder = ew_RemoveHtml($this->billing_tel->FldCaption());

		// billing_email
		$this->billing_email->EditAttrs["class"] = "form-control";
		$this->billing_email->EditCustomAttributes = "";
		$this->billing_email->EditValue = $this->billing_email->CurrentValue;
		$this->billing_email->PlaceHolder = ew_RemoveHtml($this->billing_email->FldCaption());

		// delivery_name
		$this->delivery_name->EditAttrs["class"] = "form-control";
		$this->delivery_name->EditCustomAttributes = "";
		$this->delivery_name->EditValue = $this->delivery_name->CurrentValue;
		$this->delivery_name->PlaceHolder = ew_RemoveHtml($this->delivery_name->FldCaption());

		// delivery_address
		$this->delivery_address->EditAttrs["class"] = "form-control";
		$this->delivery_address->EditCustomAttributes = "";
		$this->delivery_address->EditValue = $this->delivery_address->CurrentValue;
		$this->delivery_address->PlaceHolder = ew_RemoveHtml($this->delivery_address->FldCaption());

		// delivery_city
		$this->delivery_city->EditAttrs["class"] = "form-control";
		$this->delivery_city->EditCustomAttributes = "";
		$this->delivery_city->EditValue = $this->delivery_city->CurrentValue;
		$this->delivery_city->PlaceHolder = ew_RemoveHtml($this->delivery_city->FldCaption());

		// delivery_state
		$this->delivery_state->EditAttrs["class"] = "form-control";
		$this->delivery_state->EditCustomAttributes = "";
		$this->delivery_state->EditValue = $this->delivery_state->CurrentValue;
		$this->delivery_state->PlaceHolder = ew_RemoveHtml($this->delivery_state->FldCaption());

		// delivery_zip
		$this->delivery_zip->EditAttrs["class"] = "form-control";
		$this->delivery_zip->EditCustomAttributes = "";
		$this->delivery_zip->EditValue = $this->delivery_zip->CurrentValue;
		$this->delivery_zip->PlaceHolder = ew_RemoveHtml($this->delivery_zip->FldCaption());

		// delivery_country
		$this->delivery_country->EditAttrs["class"] = "form-control";
		$this->delivery_country->EditCustomAttributes = "";
		$this->delivery_country->EditValue = $this->delivery_country->CurrentValue;
		$this->delivery_country->PlaceHolder = ew_RemoveHtml($this->delivery_country->FldCaption());

		// delivery_tel
		$this->delivery_tel->EditAttrs["class"] = "form-control";
		$this->delivery_tel->EditCustomAttributes = "";
		$this->delivery_tel->EditValue = $this->delivery_tel->CurrentValue;
		$this->delivery_tel->PlaceHolder = ew_RemoveHtml($this->delivery_tel->FldCaption());

		// merchant_param1
		$this->merchant_param1->EditAttrs["class"] = "form-control";
		$this->merchant_param1->EditCustomAttributes = "";
		$this->merchant_param1->EditValue = $this->merchant_param1->CurrentValue;
		$this->merchant_param1->PlaceHolder = ew_RemoveHtml($this->merchant_param1->FldCaption());

		// merchant_param2
		$this->merchant_param2->EditAttrs["class"] = "form-control";
		$this->merchant_param2->EditCustomAttributes = "";
		$this->merchant_param2->EditValue = $this->merchant_param2->CurrentValue;
		$this->merchant_param2->PlaceHolder = ew_RemoveHtml($this->merchant_param2->FldCaption());

		// merchant_param3
		$this->merchant_param3->EditAttrs["class"] = "form-control";
		$this->merchant_param3->EditCustomAttributes = "";
		$this->merchant_param3->EditValue = $this->merchant_param3->CurrentValue;
		$this->merchant_param3->PlaceHolder = ew_RemoveHtml($this->merchant_param3->FldCaption());

		// merchant_param4
		$this->merchant_param4->EditAttrs["class"] = "form-control";
		$this->merchant_param4->EditCustomAttributes = "";
		$this->merchant_param4->EditValue = $this->merchant_param4->CurrentValue;
		$this->merchant_param4->PlaceHolder = ew_RemoveHtml($this->merchant_param4->FldCaption());

		// merchant_param5
		$this->merchant_param5->EditAttrs["class"] = "form-control";
		$this->merchant_param5->EditCustomAttributes = "";
		$this->merchant_param5->EditValue = $this->merchant_param5->CurrentValue;
		$this->merchant_param5->PlaceHolder = ew_RemoveHtml($this->merchant_param5->FldCaption());

		// vault
		$this->vault->EditAttrs["class"] = "form-control";
		$this->vault->EditCustomAttributes = "";
		$this->vault->EditValue = $this->vault->CurrentValue;
		$this->vault->PlaceHolder = ew_RemoveHtml($this->vault->FldCaption());

		// offer_type
		$this->offer_type->EditAttrs["class"] = "form-control";
		$this->offer_type->EditCustomAttributes = "";
		$this->offer_type->EditValue = $this->offer_type->CurrentValue;
		$this->offer_type->PlaceHolder = ew_RemoveHtml($this->offer_type->FldCaption());

		// offer_code
		$this->offer_code->EditAttrs["class"] = "form-control";
		$this->offer_code->EditCustomAttributes = "";
		$this->offer_code->EditValue = $this->offer_code->CurrentValue;
		$this->offer_code->PlaceHolder = ew_RemoveHtml($this->offer_code->FldCaption());

		// discount_value
		$this->discount_value->EditAttrs["class"] = "form-control";
		$this->discount_value->EditCustomAttributes = "";
		$this->discount_value->EditValue = $this->discount_value->CurrentValue;
		$this->discount_value->PlaceHolder = ew_RemoveHtml($this->discount_value->FldCaption());

		// mer_amount
		$this->mer_amount->EditAttrs["class"] = "form-control";
		$this->mer_amount->EditCustomAttributes = "";
		$this->mer_amount->EditValue = $this->mer_amount->CurrentValue;
		$this->mer_amount->PlaceHolder = ew_RemoveHtml($this->mer_amount->FldCaption());

		// eci_value
		$this->eci_value->EditAttrs["class"] = "form-control";
		$this->eci_value->EditCustomAttributes = "";
		$this->eci_value->EditValue = $this->eci_value->CurrentValue;
		$this->eci_value->PlaceHolder = ew_RemoveHtml($this->eci_value->FldCaption());

		// card_holder_name
		$this->card_holder_name->EditAttrs["class"] = "form-control";
		$this->card_holder_name->EditCustomAttributes = "";
		$this->card_holder_name->EditValue = $this->card_holder_name->CurrentValue;
		$this->card_holder_name->PlaceHolder = ew_RemoveHtml($this->card_holder_name->FldCaption());

		// bank_qsi_no
		$this->bank_qsi_no->EditAttrs["class"] = "form-control";
		$this->bank_qsi_no->EditCustomAttributes = "";
		$this->bank_qsi_no->EditValue = $this->bank_qsi_no->CurrentValue;
		$this->bank_qsi_no->PlaceHolder = ew_RemoveHtml($this->bank_qsi_no->FldCaption());

		// bank_receipt_no
		$this->bank_receipt_no->EditAttrs["class"] = "form-control";
		$this->bank_receipt_no->EditCustomAttributes = "";
		$this->bank_receipt_no->EditValue = $this->bank_receipt_no->CurrentValue;
		$this->bank_receipt_no->PlaceHolder = ew_RemoveHtml($this->bank_receipt_no->FldCaption());

		// merchant_param6
		$this->merchant_param6->EditAttrs["class"] = "form-control";
		$this->merchant_param6->EditCustomAttributes = "";
		$this->merchant_param6->EditValue = $this->merchant_param6->CurrentValue;
		$this->merchant_param6->PlaceHolder = ew_RemoveHtml($this->merchant_param6->FldCaption());

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
					if ($this->transactionID->Exportable) $Doc->ExportCaption($this->transactionID);
					if ($this->_userID->Exportable) $Doc->ExportCaption($this->_userID);
					if ($this->bookingNumber->Exportable) $Doc->ExportCaption($this->bookingNumber);
					if ($this->bookingModule->Exportable) $Doc->ExportCaption($this->bookingModule);
					if ($this->order_id->Exportable) $Doc->ExportCaption($this->order_id);
					if ($this->tracking_id->Exportable) $Doc->ExportCaption($this->tracking_id);
					if ($this->bank_ref_no->Exportable) $Doc->ExportCaption($this->bank_ref_no);
					if ($this->order_status->Exportable) $Doc->ExportCaption($this->order_status);
					if ($this->failure_message->Exportable) $Doc->ExportCaption($this->failure_message);
					if ($this->payment_mode->Exportable) $Doc->ExportCaption($this->payment_mode);
					if ($this->card_name->Exportable) $Doc->ExportCaption($this->card_name);
					if ($this->status_code->Exportable) $Doc->ExportCaption($this->status_code);
					if ($this->status_message->Exportable) $Doc->ExportCaption($this->status_message);
					if ($this->currency->Exportable) $Doc->ExportCaption($this->currency);
					if ($this->amount->Exportable) $Doc->ExportCaption($this->amount);
					if ($this->billing_name->Exportable) $Doc->ExportCaption($this->billing_name);
					if ($this->billing_address->Exportable) $Doc->ExportCaption($this->billing_address);
					if ($this->billing_city->Exportable) $Doc->ExportCaption($this->billing_city);
					if ($this->billing_state->Exportable) $Doc->ExportCaption($this->billing_state);
					if ($this->billing_zip->Exportable) $Doc->ExportCaption($this->billing_zip);
					if ($this->billing_country->Exportable) $Doc->ExportCaption($this->billing_country);
					if ($this->billing_tel->Exportable) $Doc->ExportCaption($this->billing_tel);
					if ($this->billing_email->Exportable) $Doc->ExportCaption($this->billing_email);
					if ($this->delivery_name->Exportable) $Doc->ExportCaption($this->delivery_name);
					if ($this->delivery_address->Exportable) $Doc->ExportCaption($this->delivery_address);
					if ($this->delivery_city->Exportable) $Doc->ExportCaption($this->delivery_city);
					if ($this->delivery_state->Exportable) $Doc->ExportCaption($this->delivery_state);
					if ($this->delivery_zip->Exportable) $Doc->ExportCaption($this->delivery_zip);
					if ($this->delivery_country->Exportable) $Doc->ExportCaption($this->delivery_country);
					if ($this->delivery_tel->Exportable) $Doc->ExportCaption($this->delivery_tel);
					if ($this->merchant_param1->Exportable) $Doc->ExportCaption($this->merchant_param1);
					if ($this->merchant_param2->Exportable) $Doc->ExportCaption($this->merchant_param2);
					if ($this->merchant_param3->Exportable) $Doc->ExportCaption($this->merchant_param3);
					if ($this->merchant_param4->Exportable) $Doc->ExportCaption($this->merchant_param4);
					if ($this->merchant_param5->Exportable) $Doc->ExportCaption($this->merchant_param5);
					if ($this->vault->Exportable) $Doc->ExportCaption($this->vault);
					if ($this->offer_type->Exportable) $Doc->ExportCaption($this->offer_type);
					if ($this->offer_code->Exportable) $Doc->ExportCaption($this->offer_code);
					if ($this->discount_value->Exportable) $Doc->ExportCaption($this->discount_value);
					if ($this->mer_amount->Exportable) $Doc->ExportCaption($this->mer_amount);
					if ($this->eci_value->Exportable) $Doc->ExportCaption($this->eci_value);
					if ($this->card_holder_name->Exportable) $Doc->ExportCaption($this->card_holder_name);
					if ($this->bank_qsi_no->Exportable) $Doc->ExportCaption($this->bank_qsi_no);
					if ($this->bank_receipt_no->Exportable) $Doc->ExportCaption($this->bank_receipt_no);
					if ($this->merchant_param6->Exportable) $Doc->ExportCaption($this->merchant_param6);
				} else {
					if ($this->transactionID->Exportable) $Doc->ExportCaption($this->transactionID);
					if ($this->_userID->Exportable) $Doc->ExportCaption($this->_userID);
					if ($this->bookingNumber->Exportable) $Doc->ExportCaption($this->bookingNumber);
					if ($this->bookingModule->Exportable) $Doc->ExportCaption($this->bookingModule);
					if ($this->order_id->Exportable) $Doc->ExportCaption($this->order_id);
					if ($this->tracking_id->Exportable) $Doc->ExportCaption($this->tracking_id);
					if ($this->bank_ref_no->Exportable) $Doc->ExportCaption($this->bank_ref_no);
					if ($this->order_status->Exportable) $Doc->ExportCaption($this->order_status);
					if ($this->failure_message->Exportable) $Doc->ExportCaption($this->failure_message);
					if ($this->payment_mode->Exportable) $Doc->ExportCaption($this->payment_mode);
					if ($this->card_name->Exportable) $Doc->ExportCaption($this->card_name);
					if ($this->status_code->Exportable) $Doc->ExportCaption($this->status_code);
					if ($this->status_message->Exportable) $Doc->ExportCaption($this->status_message);
					if ($this->currency->Exportable) $Doc->ExportCaption($this->currency);
					if ($this->amount->Exportable) $Doc->ExportCaption($this->amount);
					if ($this->billing_name->Exportable) $Doc->ExportCaption($this->billing_name);
					if ($this->billing_city->Exportable) $Doc->ExportCaption($this->billing_city);
					if ($this->billing_state->Exportable) $Doc->ExportCaption($this->billing_state);
					if ($this->billing_zip->Exportable) $Doc->ExportCaption($this->billing_zip);
					if ($this->billing_country->Exportable) $Doc->ExportCaption($this->billing_country);
					if ($this->billing_tel->Exportable) $Doc->ExportCaption($this->billing_tel);
					if ($this->billing_email->Exportable) $Doc->ExportCaption($this->billing_email);
					if ($this->delivery_name->Exportable) $Doc->ExportCaption($this->delivery_name);
					if ($this->delivery_city->Exportable) $Doc->ExportCaption($this->delivery_city);
					if ($this->delivery_state->Exportable) $Doc->ExportCaption($this->delivery_state);
					if ($this->delivery_zip->Exportable) $Doc->ExportCaption($this->delivery_zip);
					if ($this->delivery_country->Exportable) $Doc->ExportCaption($this->delivery_country);
					if ($this->delivery_tel->Exportable) $Doc->ExportCaption($this->delivery_tel);
					if ($this->vault->Exportable) $Doc->ExportCaption($this->vault);
					if ($this->offer_type->Exportable) $Doc->ExportCaption($this->offer_type);
					if ($this->offer_code->Exportable) $Doc->ExportCaption($this->offer_code);
					if ($this->discount_value->Exportable) $Doc->ExportCaption($this->discount_value);
					if ($this->mer_amount->Exportable) $Doc->ExportCaption($this->mer_amount);
					if ($this->eci_value->Exportable) $Doc->ExportCaption($this->eci_value);
					if ($this->card_holder_name->Exportable) $Doc->ExportCaption($this->card_holder_name);
					if ($this->bank_qsi_no->Exportable) $Doc->ExportCaption($this->bank_qsi_no);
					if ($this->bank_receipt_no->Exportable) $Doc->ExportCaption($this->bank_receipt_no);
					if ($this->merchant_param6->Exportable) $Doc->ExportCaption($this->merchant_param6);
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
						if ($this->transactionID->Exportable) $Doc->ExportField($this->transactionID);
						if ($this->_userID->Exportable) $Doc->ExportField($this->_userID);
						if ($this->bookingNumber->Exportable) $Doc->ExportField($this->bookingNumber);
						if ($this->bookingModule->Exportable) $Doc->ExportField($this->bookingModule);
						if ($this->order_id->Exportable) $Doc->ExportField($this->order_id);
						if ($this->tracking_id->Exportable) $Doc->ExportField($this->tracking_id);
						if ($this->bank_ref_no->Exportable) $Doc->ExportField($this->bank_ref_no);
						if ($this->order_status->Exportable) $Doc->ExportField($this->order_status);
						if ($this->failure_message->Exportable) $Doc->ExportField($this->failure_message);
						if ($this->payment_mode->Exportable) $Doc->ExportField($this->payment_mode);
						if ($this->card_name->Exportable) $Doc->ExportField($this->card_name);
						if ($this->status_code->Exportable) $Doc->ExportField($this->status_code);
						if ($this->status_message->Exportable) $Doc->ExportField($this->status_message);
						if ($this->currency->Exportable) $Doc->ExportField($this->currency);
						if ($this->amount->Exportable) $Doc->ExportField($this->amount);
						if ($this->billing_name->Exportable) $Doc->ExportField($this->billing_name);
						if ($this->billing_address->Exportable) $Doc->ExportField($this->billing_address);
						if ($this->billing_city->Exportable) $Doc->ExportField($this->billing_city);
						if ($this->billing_state->Exportable) $Doc->ExportField($this->billing_state);
						if ($this->billing_zip->Exportable) $Doc->ExportField($this->billing_zip);
						if ($this->billing_country->Exportable) $Doc->ExportField($this->billing_country);
						if ($this->billing_tel->Exportable) $Doc->ExportField($this->billing_tel);
						if ($this->billing_email->Exportable) $Doc->ExportField($this->billing_email);
						if ($this->delivery_name->Exportable) $Doc->ExportField($this->delivery_name);
						if ($this->delivery_address->Exportable) $Doc->ExportField($this->delivery_address);
						if ($this->delivery_city->Exportable) $Doc->ExportField($this->delivery_city);
						if ($this->delivery_state->Exportable) $Doc->ExportField($this->delivery_state);
						if ($this->delivery_zip->Exportable) $Doc->ExportField($this->delivery_zip);
						if ($this->delivery_country->Exportable) $Doc->ExportField($this->delivery_country);
						if ($this->delivery_tel->Exportable) $Doc->ExportField($this->delivery_tel);
						if ($this->merchant_param1->Exportable) $Doc->ExportField($this->merchant_param1);
						if ($this->merchant_param2->Exportable) $Doc->ExportField($this->merchant_param2);
						if ($this->merchant_param3->Exportable) $Doc->ExportField($this->merchant_param3);
						if ($this->merchant_param4->Exportable) $Doc->ExportField($this->merchant_param4);
						if ($this->merchant_param5->Exportable) $Doc->ExportField($this->merchant_param5);
						if ($this->vault->Exportable) $Doc->ExportField($this->vault);
						if ($this->offer_type->Exportable) $Doc->ExportField($this->offer_type);
						if ($this->offer_code->Exportable) $Doc->ExportField($this->offer_code);
						if ($this->discount_value->Exportable) $Doc->ExportField($this->discount_value);
						if ($this->mer_amount->Exportable) $Doc->ExportField($this->mer_amount);
						if ($this->eci_value->Exportable) $Doc->ExportField($this->eci_value);
						if ($this->card_holder_name->Exportable) $Doc->ExportField($this->card_holder_name);
						if ($this->bank_qsi_no->Exportable) $Doc->ExportField($this->bank_qsi_no);
						if ($this->bank_receipt_no->Exportable) $Doc->ExportField($this->bank_receipt_no);
						if ($this->merchant_param6->Exportable) $Doc->ExportField($this->merchant_param6);
					} else {
						if ($this->transactionID->Exportable) $Doc->ExportField($this->transactionID);
						if ($this->_userID->Exportable) $Doc->ExportField($this->_userID);
						if ($this->bookingNumber->Exportable) $Doc->ExportField($this->bookingNumber);
						if ($this->bookingModule->Exportable) $Doc->ExportField($this->bookingModule);
						if ($this->order_id->Exportable) $Doc->ExportField($this->order_id);
						if ($this->tracking_id->Exportable) $Doc->ExportField($this->tracking_id);
						if ($this->bank_ref_no->Exportable) $Doc->ExportField($this->bank_ref_no);
						if ($this->order_status->Exportable) $Doc->ExportField($this->order_status);
						if ($this->failure_message->Exportable) $Doc->ExportField($this->failure_message);
						if ($this->payment_mode->Exportable) $Doc->ExportField($this->payment_mode);
						if ($this->card_name->Exportable) $Doc->ExportField($this->card_name);
						if ($this->status_code->Exportable) $Doc->ExportField($this->status_code);
						if ($this->status_message->Exportable) $Doc->ExportField($this->status_message);
						if ($this->currency->Exportable) $Doc->ExportField($this->currency);
						if ($this->amount->Exportable) $Doc->ExportField($this->amount);
						if ($this->billing_name->Exportable) $Doc->ExportField($this->billing_name);
						if ($this->billing_city->Exportable) $Doc->ExportField($this->billing_city);
						if ($this->billing_state->Exportable) $Doc->ExportField($this->billing_state);
						if ($this->billing_zip->Exportable) $Doc->ExportField($this->billing_zip);
						if ($this->billing_country->Exportable) $Doc->ExportField($this->billing_country);
						if ($this->billing_tel->Exportable) $Doc->ExportField($this->billing_tel);
						if ($this->billing_email->Exportable) $Doc->ExportField($this->billing_email);
						if ($this->delivery_name->Exportable) $Doc->ExportField($this->delivery_name);
						if ($this->delivery_city->Exportable) $Doc->ExportField($this->delivery_city);
						if ($this->delivery_state->Exportable) $Doc->ExportField($this->delivery_state);
						if ($this->delivery_zip->Exportable) $Doc->ExportField($this->delivery_zip);
						if ($this->delivery_country->Exportable) $Doc->ExportField($this->delivery_country);
						if ($this->delivery_tel->Exportable) $Doc->ExportField($this->delivery_tel);
						if ($this->vault->Exportable) $Doc->ExportField($this->vault);
						if ($this->offer_type->Exportable) $Doc->ExportField($this->offer_type);
						if ($this->offer_code->Exportable) $Doc->ExportField($this->offer_code);
						if ($this->discount_value->Exportable) $Doc->ExportField($this->discount_value);
						if ($this->mer_amount->Exportable) $Doc->ExportField($this->mer_amount);
						if ($this->eci_value->Exportable) $Doc->ExportField($this->eci_value);
						if ($this->card_holder_name->Exportable) $Doc->ExportField($this->card_holder_name);
						if ($this->bank_qsi_no->Exportable) $Doc->ExportField($this->bank_qsi_no);
						if ($this->bank_receipt_no->Exportable) $Doc->ExportField($this->bank_receipt_no);
						if ($this->merchant_param6->Exportable) $Doc->ExportField($this->merchant_param6);
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
