<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "pg_transactionsinfo.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$pg_transactions_delete = NULL; // Initialize page object first

class cpg_transactions_delete extends cpg_transactions {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'pg_transactions';

	// Page object name
	var $PageObjName = 'pg_transactions_delete';

	// Page headings
	var $Heading = '';
	var $Subheading = '';

	// Page heading
	function PageHeading() {
		global $Language;
		if ($this->Heading <> "")
			return $this->Heading;
		if (method_exists($this, "TableCaption"))
			return $this->TableCaption();
		return "";
	}

	// Page subheading
	function PageSubheading() {
		global $Language;
		if ($this->Subheading <> "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->Phrase($this->PageID);
		return "";
	}

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EW_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_WARNING_MESSAGE], $v);
	}

	// Methods to clear message
	function ClearMessage() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
	}

	function ClearFailureMessage() {
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
	}

	function ClearSuccessMessage() {
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
	}

	function ClearWarningMessage() {
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	function ClearMessages() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	// Show message
	function ShowMessage() {
		$hidden = FALSE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-info ewInfo\">" . $sMessage . "</div>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EW_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-danger ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<div class=\"ewMessageDialog\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p>" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Footer exists, display
			echo "<p>" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm;
		if ($this->UseTokenInUrl) {
			if ($objForm)
				return ($this->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}
	var $Token = "";
	var $TokenTimeout = 0;
	var $CheckToken = EW_CHECK_TOKEN;
	var $CheckTokenFn = "ew_CheckToken";
	var $CreateTokenFn = "ew_CreateToken";

	// Valid Post
	function ValidPost() {
		if (!$this->CheckToken || !ew_IsPost())
			return TRUE;
		if (!isset($_POST[EW_TOKEN_NAME]))
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn($_POST[EW_TOKEN_NAME], $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	function CreateToken() {
		global $gsToken;
		if ($this->CheckToken) {
			$fn = $this->CreateTokenFn;
			if ($this->Token == "" && is_callable($fn)) // Create token
				$this->Token = $fn();
			$gsToken = $this->Token; // Save to global variable
		}
	}

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $Language;
		global $UserTable, $UserTableConn;
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = ew_SessionTimeoutTime();

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (pg_transactions)
		if (!isset($GLOBALS["pg_transactions"]) || get_class($GLOBALS["pg_transactions"]) == "cpg_transactions") {
			$GLOBALS["pg_transactions"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["pg_transactions"];
		}

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pg_transactions', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"]))
			$GLOBALS["gTimer"] = new cTimer();

		// Debug message
		ew_LoadDebugMsg();

		// Open connection
		if (!isset($conn))
			$conn = ew_Connect($this->DBID);

		// User table object (cms_users)
		if (!isset($UserTable)) {
			$UserTable = new ccms_users();
			$UserTableConn = Conn($UserTable->DBID);
		}
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// User profile
		$UserProfile = new cUserProfile();

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->CanDelete()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("pg_transactionslist.php"));
			else
				$this->Page_Terminate(ew_GetUrl("login.php"));
		}

		// NOTE: Security object may be needed in other part of the script, skip set to Nothing
		// 
		// Security = null;
		// 

		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->transactionID->SetVisibility();
		$this->transactionID->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
		$this->_userID->SetVisibility();
		$this->bookingNumber->SetVisibility();
		$this->bookingModule->SetVisibility();
		$this->order_id->SetVisibility();
		$this->order_status->SetVisibility();
		$this->payment_mode->SetVisibility();
		$this->amount->SetVisibility();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->ValidPost()) {
			echo $Language->Phrase("InvalidPostRequest");
			$this->Page_Terminate();
			exit();
		}

		// Create Token
		$this->CreateToken();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $gsExportFile, $gTmpImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EW_EXPORT, $pg_transactions;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($pg_transactions);
				$doc->Text = $sContent;
				if ($this->Export == "email")
					echo $this->ExportEmail($doc->Text);
				else
					$doc->Export();
				ew_DeleteTmpImages(); // Delete temp images
				exit();
			}
		}
		$this->Page_Redirecting($url);

		// Close connection
		ew_CloseConn();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			ew_SaveDebugMsg();
			header("Location: " . $url);
		}
		exit();
	}
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;
	var $StartRowCnt = 1;
	var $RowCnt = 0;

	//
	// Page main
	//
	function Page_Main() {
		global $Language;

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->GetRecordKeys(); // Load record keys
		$sFilter = $this->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("pg_transactionslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in pg_transactions class, pg_transactionsinfo.php

		$this->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$this->CurrentAction = $_POST["a_delete"];
		} elseif (@$_GET["a_delete"] == "1") {
			$this->CurrentAction = "D"; // Delete record directly
		} else {
			$this->CurrentAction = "I"; // Display record
		}
		if ($this->CurrentAction == "D") {
			$this->SendEmail = TRUE; // Send email on delete success
			if ($this->DeleteRows()) { // Delete rows
				if ($this->getSuccessMessage() == "")
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
				$this->Page_Terminate($this->getReturnUrl()); // Return to caller
			} else { // Delete failed
				$this->CurrentAction = "I"; // Display record
			}
		}
		if ($this->CurrentAction == "I") { // Load records for display
			if ($this->Recordset = $this->LoadRecordset())
				$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
			if ($this->TotalRecs <= 0) { // No record found, exit
				if ($this->Recordset)
					$this->Recordset->Close();
				$this->Page_Terminate("pg_transactionslist.php"); // Return to list
			}
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {

		// Load List page SQL
		$sSql = $this->ListSQL();
		$conn = &$this->Connection();

		// Load recordset
		$dbtype = ew_GetConnectionType($this->DBID);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			if ($dbtype == "MSSQL") {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset, array("_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())));
			} else {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = '';
		} else {
			$rs = ew_LoadRecordset($sSql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();

		// Call Row Selecting event
		$this->Row_Selecting($sFilter);

		// Load SQL based on filter
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues($rs = NULL) {
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->NewRow(); 

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->transactionID->setDbValue($row['transactionID']);
		$this->_userID->setDbValue($row['userID']);
		$this->bookingNumber->setDbValue($row['bookingNumber']);
		$this->bookingModule->setDbValue($row['bookingModule']);
		$this->order_id->setDbValue($row['order_id']);
		$this->tracking_id->setDbValue($row['tracking_id']);
		$this->bank_ref_no->setDbValue($row['bank_ref_no']);
		$this->order_status->setDbValue($row['order_status']);
		$this->failure_message->setDbValue($row['failure_message']);
		$this->payment_mode->setDbValue($row['payment_mode']);
		$this->card_name->setDbValue($row['card_name']);
		$this->status_code->setDbValue($row['status_code']);
		$this->status_message->setDbValue($row['status_message']);
		$this->currency->setDbValue($row['currency']);
		$this->amount->setDbValue($row['amount']);
		$this->billing_name->setDbValue($row['billing_name']);
		$this->billing_address->setDbValue($row['billing_address']);
		$this->billing_city->setDbValue($row['billing_city']);
		$this->billing_state->setDbValue($row['billing_state']);
		$this->billing_zip->setDbValue($row['billing_zip']);
		$this->billing_country->setDbValue($row['billing_country']);
		$this->billing_tel->setDbValue($row['billing_tel']);
		$this->billing_email->setDbValue($row['billing_email']);
		$this->delivery_name->setDbValue($row['delivery_name']);
		$this->delivery_address->setDbValue($row['delivery_address']);
		$this->delivery_city->setDbValue($row['delivery_city']);
		$this->delivery_state->setDbValue($row['delivery_state']);
		$this->delivery_zip->setDbValue($row['delivery_zip']);
		$this->delivery_country->setDbValue($row['delivery_country']);
		$this->delivery_tel->setDbValue($row['delivery_tel']);
		$this->merchant_param1->setDbValue($row['merchant_param1']);
		$this->merchant_param2->setDbValue($row['merchant_param2']);
		$this->merchant_param3->setDbValue($row['merchant_param3']);
		$this->merchant_param4->setDbValue($row['merchant_param4']);
		$this->merchant_param5->setDbValue($row['merchant_param5']);
		$this->vault->setDbValue($row['vault']);
		$this->offer_type->setDbValue($row['offer_type']);
		$this->offer_code->setDbValue($row['offer_code']);
		$this->discount_value->setDbValue($row['discount_value']);
		$this->mer_amount->setDbValue($row['mer_amount']);
		$this->eci_value->setDbValue($row['eci_value']);
		$this->card_holder_name->setDbValue($row['card_holder_name']);
		$this->bank_qsi_no->setDbValue($row['bank_qsi_no']);
		$this->bank_receipt_no->setDbValue($row['bank_receipt_no']);
		$this->merchant_param6->setDbValue($row['merchant_param6']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['transactionID'] = NULL;
		$row['userID'] = NULL;
		$row['bookingNumber'] = NULL;
		$row['bookingModule'] = NULL;
		$row['order_id'] = NULL;
		$row['tracking_id'] = NULL;
		$row['bank_ref_no'] = NULL;
		$row['order_status'] = NULL;
		$row['failure_message'] = NULL;
		$row['payment_mode'] = NULL;
		$row['card_name'] = NULL;
		$row['status_code'] = NULL;
		$row['status_message'] = NULL;
		$row['currency'] = NULL;
		$row['amount'] = NULL;
		$row['billing_name'] = NULL;
		$row['billing_address'] = NULL;
		$row['billing_city'] = NULL;
		$row['billing_state'] = NULL;
		$row['billing_zip'] = NULL;
		$row['billing_country'] = NULL;
		$row['billing_tel'] = NULL;
		$row['billing_email'] = NULL;
		$row['delivery_name'] = NULL;
		$row['delivery_address'] = NULL;
		$row['delivery_city'] = NULL;
		$row['delivery_state'] = NULL;
		$row['delivery_zip'] = NULL;
		$row['delivery_country'] = NULL;
		$row['delivery_tel'] = NULL;
		$row['merchant_param1'] = NULL;
		$row['merchant_param2'] = NULL;
		$row['merchant_param3'] = NULL;
		$row['merchant_param4'] = NULL;
		$row['merchant_param5'] = NULL;
		$row['vault'] = NULL;
		$row['offer_type'] = NULL;
		$row['offer_code'] = NULL;
		$row['discount_value'] = NULL;
		$row['mer_amount'] = NULL;
		$row['eci_value'] = NULL;
		$row['card_holder_name'] = NULL;
		$row['bank_qsi_no'] = NULL;
		$row['bank_receipt_no'] = NULL;
		$row['merchant_param6'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->transactionID->DbValue = $row['transactionID'];
		$this->_userID->DbValue = $row['userID'];
		$this->bookingNumber->DbValue = $row['bookingNumber'];
		$this->bookingModule->DbValue = $row['bookingModule'];
		$this->order_id->DbValue = $row['order_id'];
		$this->tracking_id->DbValue = $row['tracking_id'];
		$this->bank_ref_no->DbValue = $row['bank_ref_no'];
		$this->order_status->DbValue = $row['order_status'];
		$this->failure_message->DbValue = $row['failure_message'];
		$this->payment_mode->DbValue = $row['payment_mode'];
		$this->card_name->DbValue = $row['card_name'];
		$this->status_code->DbValue = $row['status_code'];
		$this->status_message->DbValue = $row['status_message'];
		$this->currency->DbValue = $row['currency'];
		$this->amount->DbValue = $row['amount'];
		$this->billing_name->DbValue = $row['billing_name'];
		$this->billing_address->DbValue = $row['billing_address'];
		$this->billing_city->DbValue = $row['billing_city'];
		$this->billing_state->DbValue = $row['billing_state'];
		$this->billing_zip->DbValue = $row['billing_zip'];
		$this->billing_country->DbValue = $row['billing_country'];
		$this->billing_tel->DbValue = $row['billing_tel'];
		$this->billing_email->DbValue = $row['billing_email'];
		$this->delivery_name->DbValue = $row['delivery_name'];
		$this->delivery_address->DbValue = $row['delivery_address'];
		$this->delivery_city->DbValue = $row['delivery_city'];
		$this->delivery_state->DbValue = $row['delivery_state'];
		$this->delivery_zip->DbValue = $row['delivery_zip'];
		$this->delivery_country->DbValue = $row['delivery_country'];
		$this->delivery_tel->DbValue = $row['delivery_tel'];
		$this->merchant_param1->DbValue = $row['merchant_param1'];
		$this->merchant_param2->DbValue = $row['merchant_param2'];
		$this->merchant_param3->DbValue = $row['merchant_param3'];
		$this->merchant_param4->DbValue = $row['merchant_param4'];
		$this->merchant_param5->DbValue = $row['merchant_param5'];
		$this->vault->DbValue = $row['vault'];
		$this->offer_type->DbValue = $row['offer_type'];
		$this->offer_code->DbValue = $row['offer_code'];
		$this->discount_value->DbValue = $row['discount_value'];
		$this->mer_amount->DbValue = $row['mer_amount'];
		$this->eci_value->DbValue = $row['eci_value'];
		$this->card_holder_name->DbValue = $row['card_holder_name'];
		$this->bank_qsi_no->DbValue = $row['bank_qsi_no'];
		$this->bank_receipt_no->DbValue = $row['bank_receipt_no'];
		$this->merchant_param6->DbValue = $row['merchant_param6'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
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

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

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

			// order_status
			$this->order_status->LinkCustomAttributes = "";
			$this->order_status->HrefValue = "";
			$this->order_status->TooltipValue = "";

			// payment_mode
			$this->payment_mode->LinkCustomAttributes = "";
			$this->payment_mode->HrefValue = "";
			$this->payment_mode->TooltipValue = "";

			// amount
			$this->amount->LinkCustomAttributes = "";
			$this->amount->HrefValue = "";
			$this->amount->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $Language, $Security;
		if (!$Security->CanDelete()) {
			$this->setFailureMessage($Language->Phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$DeleteRows = TRUE;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->GetRows() : array();
		$conn->BeginTrans();

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $this->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
				$sThisKey .= $row['transactionID'];

				// Delete old files
				$this->LoadDbValues($row);
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				$DeleteRows = $this->Delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		}
		if (!$DeleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("pg_transactionslist.php"), "", $this->TableVar, TRUE);
		$PageId = "delete";
		$Breadcrumb->Add("delete", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($pg_transactions_delete)) $pg_transactions_delete = new cpg_transactions_delete();

// Page init
$pg_transactions_delete->Page_Init();

// Page main
$pg_transactions_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pg_transactions_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = fpg_transactionsdelete = new ew_Form("fpg_transactionsdelete", "delete");

// Form_CustomValidate event
fpg_transactionsdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fpg_transactionsdelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fpg_transactionsdelete.Lists["x__userID"] = {"LinkField":"x__userID","Ajax":true,"AutoFill":false,"DisplayFields":["x_firstName","x_lastName","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"users"};
fpg_transactionsdelete.Lists["x__userID"].Data = "<?php echo $pg_transactions_delete->_userID->LookupFilterQuery(FALSE, "delete") ?>";
fpg_transactionsdelete.Lists["x_bookingModule"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fpg_transactionsdelete.Lists["x_bookingModule"].Options = <?php echo json_encode($pg_transactions_delete->bookingModule->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $pg_transactions_delete->ShowPageHeader(); ?>
<?php
$pg_transactions_delete->ShowMessage();
?>
<form name="fpg_transactionsdelete" id="fpg_transactionsdelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($pg_transactions_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $pg_transactions_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pg_transactions">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($pg_transactions_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($pg_transactions->transactionID->Visible) { // transactionID ?>
		<th class="<?php echo $pg_transactions->transactionID->HeaderCellClass() ?>"><span id="elh_pg_transactions_transactionID" class="pg_transactions_transactionID"><?php echo $pg_transactions->transactionID->FldCaption() ?></span></th>
<?php } ?>
<?php if ($pg_transactions->_userID->Visible) { // userID ?>
		<th class="<?php echo $pg_transactions->_userID->HeaderCellClass() ?>"><span id="elh_pg_transactions__userID" class="pg_transactions__userID"><?php echo $pg_transactions->_userID->FldCaption() ?></span></th>
<?php } ?>
<?php if ($pg_transactions->bookingNumber->Visible) { // bookingNumber ?>
		<th class="<?php echo $pg_transactions->bookingNumber->HeaderCellClass() ?>"><span id="elh_pg_transactions_bookingNumber" class="pg_transactions_bookingNumber"><?php echo $pg_transactions->bookingNumber->FldCaption() ?></span></th>
<?php } ?>
<?php if ($pg_transactions->bookingModule->Visible) { // bookingModule ?>
		<th class="<?php echo $pg_transactions->bookingModule->HeaderCellClass() ?>"><span id="elh_pg_transactions_bookingModule" class="pg_transactions_bookingModule"><?php echo $pg_transactions->bookingModule->FldCaption() ?></span></th>
<?php } ?>
<?php if ($pg_transactions->order_id->Visible) { // order_id ?>
		<th class="<?php echo $pg_transactions->order_id->HeaderCellClass() ?>"><span id="elh_pg_transactions_order_id" class="pg_transactions_order_id"><?php echo $pg_transactions->order_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($pg_transactions->order_status->Visible) { // order_status ?>
		<th class="<?php echo $pg_transactions->order_status->HeaderCellClass() ?>"><span id="elh_pg_transactions_order_status" class="pg_transactions_order_status"><?php echo $pg_transactions->order_status->FldCaption() ?></span></th>
<?php } ?>
<?php if ($pg_transactions->payment_mode->Visible) { // payment_mode ?>
		<th class="<?php echo $pg_transactions->payment_mode->HeaderCellClass() ?>"><span id="elh_pg_transactions_payment_mode" class="pg_transactions_payment_mode"><?php echo $pg_transactions->payment_mode->FldCaption() ?></span></th>
<?php } ?>
<?php if ($pg_transactions->amount->Visible) { // amount ?>
		<th class="<?php echo $pg_transactions->amount->HeaderCellClass() ?>"><span id="elh_pg_transactions_amount" class="pg_transactions_amount"><?php echo $pg_transactions->amount->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$pg_transactions_delete->RecCnt = 0;
$i = 0;
while (!$pg_transactions_delete->Recordset->EOF) {
	$pg_transactions_delete->RecCnt++;
	$pg_transactions_delete->RowCnt++;

	// Set row properties
	$pg_transactions->ResetAttrs();
	$pg_transactions->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$pg_transactions_delete->LoadRowValues($pg_transactions_delete->Recordset);

	// Render row
	$pg_transactions_delete->RenderRow();
?>
	<tr<?php echo $pg_transactions->RowAttributes() ?>>
<?php if ($pg_transactions->transactionID->Visible) { // transactionID ?>
		<td<?php echo $pg_transactions->transactionID->CellAttributes() ?>>
<span id="el<?php echo $pg_transactions_delete->RowCnt ?>_pg_transactions_transactionID" class="pg_transactions_transactionID">
<span<?php echo $pg_transactions->transactionID->ViewAttributes() ?>>
<?php echo $pg_transactions->transactionID->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pg_transactions->_userID->Visible) { // userID ?>
		<td<?php echo $pg_transactions->_userID->CellAttributes() ?>>
<span id="el<?php echo $pg_transactions_delete->RowCnt ?>_pg_transactions__userID" class="pg_transactions__userID">
<span<?php echo $pg_transactions->_userID->ViewAttributes() ?>>
<?php echo $pg_transactions->_userID->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pg_transactions->bookingNumber->Visible) { // bookingNumber ?>
		<td<?php echo $pg_transactions->bookingNumber->CellAttributes() ?>>
<span id="el<?php echo $pg_transactions_delete->RowCnt ?>_pg_transactions_bookingNumber" class="pg_transactions_bookingNumber">
<span<?php echo $pg_transactions->bookingNumber->ViewAttributes() ?>>
<?php echo $pg_transactions->bookingNumber->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pg_transactions->bookingModule->Visible) { // bookingModule ?>
		<td<?php echo $pg_transactions->bookingModule->CellAttributes() ?>>
<span id="el<?php echo $pg_transactions_delete->RowCnt ?>_pg_transactions_bookingModule" class="pg_transactions_bookingModule">
<span<?php echo $pg_transactions->bookingModule->ViewAttributes() ?>>
<?php echo $pg_transactions->bookingModule->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pg_transactions->order_id->Visible) { // order_id ?>
		<td<?php echo $pg_transactions->order_id->CellAttributes() ?>>
<span id="el<?php echo $pg_transactions_delete->RowCnt ?>_pg_transactions_order_id" class="pg_transactions_order_id">
<span<?php echo $pg_transactions->order_id->ViewAttributes() ?>>
<?php echo $pg_transactions->order_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pg_transactions->order_status->Visible) { // order_status ?>
		<td<?php echo $pg_transactions->order_status->CellAttributes() ?>>
<span id="el<?php echo $pg_transactions_delete->RowCnt ?>_pg_transactions_order_status" class="pg_transactions_order_status">
<span<?php echo $pg_transactions->order_status->ViewAttributes() ?>>
<?php echo $pg_transactions->order_status->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pg_transactions->payment_mode->Visible) { // payment_mode ?>
		<td<?php echo $pg_transactions->payment_mode->CellAttributes() ?>>
<span id="el<?php echo $pg_transactions_delete->RowCnt ?>_pg_transactions_payment_mode" class="pg_transactions_payment_mode">
<span<?php echo $pg_transactions->payment_mode->ViewAttributes() ?>>
<?php echo $pg_transactions->payment_mode->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pg_transactions->amount->Visible) { // amount ?>
		<td<?php echo $pg_transactions->amount->CellAttributes() ?>>
<span id="el<?php echo $pg_transactions_delete->RowCnt ?>_pg_transactions_amount" class="pg_transactions_amount">
<span<?php echo $pg_transactions->amount->ViewAttributes() ?>>
<?php echo $pg_transactions->amount->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$pg_transactions_delete->Recordset->MoveNext();
}
$pg_transactions_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $pg_transactions_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
fpg_transactionsdelete.Init();
</script>
<?php
$pg_transactions_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$pg_transactions_delete->Page_Terminate();
?>
