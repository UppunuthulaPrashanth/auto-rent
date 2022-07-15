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

$pg_transactions_add = NULL; // Initialize page object first

class cpg_transactions_add extends cpg_transactions {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'pg_transactions';

	// Page object name
	var $PageObjName = 'pg_transactions_add';

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
			define("EW_PAGE_ID", 'add', TRUE);

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

		// Is modal
		$this->IsModal = (@$_GET["modal"] == "1" || @$_POST["modal"] == "1");

		// User profile
		$UserProfile = new cUserProfile();

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->CanAdd()) {
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
		// Create form object

		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->_userID->SetVisibility();
		$this->bookingNumber->SetVisibility();
		$this->bookingModule->SetVisibility();
		$this->order_id->SetVisibility();
		$this->tracking_id->SetVisibility();
		$this->bank_ref_no->SetVisibility();
		$this->order_status->SetVisibility();
		$this->failure_message->SetVisibility();
		$this->payment_mode->SetVisibility();
		$this->card_name->SetVisibility();
		$this->status_code->SetVisibility();
		$this->status_message->SetVisibility();
		$this->currency->SetVisibility();
		$this->amount->SetVisibility();
		$this->billing_name->SetVisibility();
		$this->billing_address->SetVisibility();
		$this->billing_city->SetVisibility();
		$this->billing_state->SetVisibility();
		$this->billing_zip->SetVisibility();
		$this->billing_country->SetVisibility();
		$this->billing_tel->SetVisibility();
		$this->billing_email->SetVisibility();
		$this->delivery_name->SetVisibility();
		$this->delivery_address->SetVisibility();
		$this->delivery_city->SetVisibility();
		$this->delivery_state->SetVisibility();
		$this->delivery_zip->SetVisibility();
		$this->delivery_country->SetVisibility();
		$this->delivery_tel->SetVisibility();
		$this->merchant_param1->SetVisibility();
		$this->merchant_param2->SetVisibility();
		$this->merchant_param3->SetVisibility();
		$this->merchant_param4->SetVisibility();
		$this->merchant_param5->SetVisibility();
		$this->vault->SetVisibility();
		$this->offer_type->SetVisibility();
		$this->offer_code->SetVisibility();
		$this->discount_value->SetVisibility();
		$this->mer_amount->SetVisibility();
		$this->eci_value->SetVisibility();
		$this->card_holder_name->SetVisibility();
		$this->bank_qsi_no->SetVisibility();
		$this->bank_receipt_no->SetVisibility();
		$this->merchant_param6->SetVisibility();

		// Set up multi page object
		$this->SetupMultiPages();

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

		// Process auto fill
		if (@$_POST["ajax"] == "autofill") {
			$results = $this->GetAutoFill(@$_POST["name"], @$_POST["q"]);
			if ($results) {

				// Clean output buffer
				if (!EW_DEBUG_ENABLED && ob_get_length())
					ob_end_clean();
				echo $results;
				$this->Page_Terminate();
				exit();
			}
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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = ew_GetPageName($url);
				if ($pageName != $this->GetListUrl()) { // Not List page
					$row["caption"] = $this->GetModalCaption($pageName);
					if ($pageName == "pg_transactionsview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				header("Content-Type: application/json; charset=utf-8");
				echo ew_ConvertToUtf8(ew_ArrayToJson(array($row)));
			} else {
				ew_SaveDebugMsg();
				header("Location: " . $url);
			}
		}
		exit();
	}
	var $FormClassName = "form-horizontal ewForm ewAddForm";
	var $IsModal = FALSE;
	var $IsMobileOrModal = FALSE;
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;
	var $MultiPages; // Multi pages object

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError;
		global $gbSkipHeaderFooter;

		// Check modal
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = ew_IsMobile() || $this->IsModal;
		$this->FormClassName = "ewForm ewAddForm form-horizontal";

		// Set up current action
		if (@$_POST["a_add"] <> "") {
			$this->CurrentAction = $_POST["a_add"]; // Get form action
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["transactionID"] != "") {
				$this->transactionID->setQueryStringValue($_GET["transactionID"]);
				$this->setKey("transactionID", $this->transactionID->CurrentValue); // Set up key
			} else {
				$this->setKey("transactionID", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "C"; // Copy record
			} else {
				$this->CurrentAction = "I"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->LoadOldRecord();

		// Load form values
		if (@$_POST["a_add"] <> "") {
			$this->LoadFormValues(); // Load form values
		}

		// Validate form if post back
		if (@$_POST["a_add"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = "I"; // Form error, reset action
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "I": // Blank record
				break;
			case "C": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "") $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("pg_transactionslist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "pg_transactionslist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "pg_transactionsview.php")
						$sReturnUrl = $this->GetViewUrl(); // View page, return to View page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Render row based on row type
		$this->RowType = EW_ROWTYPE_ADD; // Render add type

		// Render row
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		$this->transactionID->CurrentValue = NULL;
		$this->transactionID->OldValue = $this->transactionID->CurrentValue;
		$this->_userID->CurrentValue = 0;
		$this->bookingNumber->CurrentValue = NULL;
		$this->bookingNumber->OldValue = $this->bookingNumber->CurrentValue;
		$this->bookingModule->CurrentValue = NULL;
		$this->bookingModule->OldValue = $this->bookingModule->CurrentValue;
		$this->order_id->CurrentValue = NULL;
		$this->order_id->OldValue = $this->order_id->CurrentValue;
		$this->tracking_id->CurrentValue = NULL;
		$this->tracking_id->OldValue = $this->tracking_id->CurrentValue;
		$this->bank_ref_no->CurrentValue = NULL;
		$this->bank_ref_no->OldValue = $this->bank_ref_no->CurrentValue;
		$this->order_status->CurrentValue = NULL;
		$this->order_status->OldValue = $this->order_status->CurrentValue;
		$this->failure_message->CurrentValue = NULL;
		$this->failure_message->OldValue = $this->failure_message->CurrentValue;
		$this->payment_mode->CurrentValue = NULL;
		$this->payment_mode->OldValue = $this->payment_mode->CurrentValue;
		$this->card_name->CurrentValue = NULL;
		$this->card_name->OldValue = $this->card_name->CurrentValue;
		$this->status_code->CurrentValue = NULL;
		$this->status_code->OldValue = $this->status_code->CurrentValue;
		$this->status_message->CurrentValue = NULL;
		$this->status_message->OldValue = $this->status_message->CurrentValue;
		$this->currency->CurrentValue = NULL;
		$this->currency->OldValue = $this->currency->CurrentValue;
		$this->amount->CurrentValue = NULL;
		$this->amount->OldValue = $this->amount->CurrentValue;
		$this->billing_name->CurrentValue = NULL;
		$this->billing_name->OldValue = $this->billing_name->CurrentValue;
		$this->billing_address->CurrentValue = NULL;
		$this->billing_address->OldValue = $this->billing_address->CurrentValue;
		$this->billing_city->CurrentValue = NULL;
		$this->billing_city->OldValue = $this->billing_city->CurrentValue;
		$this->billing_state->CurrentValue = NULL;
		$this->billing_state->OldValue = $this->billing_state->CurrentValue;
		$this->billing_zip->CurrentValue = NULL;
		$this->billing_zip->OldValue = $this->billing_zip->CurrentValue;
		$this->billing_country->CurrentValue = NULL;
		$this->billing_country->OldValue = $this->billing_country->CurrentValue;
		$this->billing_tel->CurrentValue = NULL;
		$this->billing_tel->OldValue = $this->billing_tel->CurrentValue;
		$this->billing_email->CurrentValue = NULL;
		$this->billing_email->OldValue = $this->billing_email->CurrentValue;
		$this->delivery_name->CurrentValue = NULL;
		$this->delivery_name->OldValue = $this->delivery_name->CurrentValue;
		$this->delivery_address->CurrentValue = NULL;
		$this->delivery_address->OldValue = $this->delivery_address->CurrentValue;
		$this->delivery_city->CurrentValue = NULL;
		$this->delivery_city->OldValue = $this->delivery_city->CurrentValue;
		$this->delivery_state->CurrentValue = NULL;
		$this->delivery_state->OldValue = $this->delivery_state->CurrentValue;
		$this->delivery_zip->CurrentValue = NULL;
		$this->delivery_zip->OldValue = $this->delivery_zip->CurrentValue;
		$this->delivery_country->CurrentValue = NULL;
		$this->delivery_country->OldValue = $this->delivery_country->CurrentValue;
		$this->delivery_tel->CurrentValue = NULL;
		$this->delivery_tel->OldValue = $this->delivery_tel->CurrentValue;
		$this->merchant_param1->CurrentValue = NULL;
		$this->merchant_param1->OldValue = $this->merchant_param1->CurrentValue;
		$this->merchant_param2->CurrentValue = NULL;
		$this->merchant_param2->OldValue = $this->merchant_param2->CurrentValue;
		$this->merchant_param3->CurrentValue = NULL;
		$this->merchant_param3->OldValue = $this->merchant_param3->CurrentValue;
		$this->merchant_param4->CurrentValue = NULL;
		$this->merchant_param4->OldValue = $this->merchant_param4->CurrentValue;
		$this->merchant_param5->CurrentValue = NULL;
		$this->merchant_param5->OldValue = $this->merchant_param5->CurrentValue;
		$this->vault->CurrentValue = NULL;
		$this->vault->OldValue = $this->vault->CurrentValue;
		$this->offer_type->CurrentValue = NULL;
		$this->offer_type->OldValue = $this->offer_type->CurrentValue;
		$this->offer_code->CurrentValue = NULL;
		$this->offer_code->OldValue = $this->offer_code->CurrentValue;
		$this->discount_value->CurrentValue = NULL;
		$this->discount_value->OldValue = $this->discount_value->CurrentValue;
		$this->mer_amount->CurrentValue = NULL;
		$this->mer_amount->OldValue = $this->mer_amount->CurrentValue;
		$this->eci_value->CurrentValue = NULL;
		$this->eci_value->OldValue = $this->eci_value->CurrentValue;
		$this->card_holder_name->CurrentValue = NULL;
		$this->card_holder_name->OldValue = $this->card_holder_name->CurrentValue;
		$this->bank_qsi_no->CurrentValue = NULL;
		$this->bank_qsi_no->OldValue = $this->bank_qsi_no->CurrentValue;
		$this->bank_receipt_no->CurrentValue = NULL;
		$this->bank_receipt_no->OldValue = $this->bank_receipt_no->CurrentValue;
		$this->merchant_param6->CurrentValue = NULL;
		$this->merchant_param6->OldValue = $this->merchant_param6->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->_userID->FldIsDetailKey) {
			$this->_userID->setFormValue($objForm->GetValue("x__userID"));
		}
		if (!$this->bookingNumber->FldIsDetailKey) {
			$this->bookingNumber->setFormValue($objForm->GetValue("x_bookingNumber"));
		}
		if (!$this->bookingModule->FldIsDetailKey) {
			$this->bookingModule->setFormValue($objForm->GetValue("x_bookingModule"));
		}
		if (!$this->order_id->FldIsDetailKey) {
			$this->order_id->setFormValue($objForm->GetValue("x_order_id"));
		}
		if (!$this->tracking_id->FldIsDetailKey) {
			$this->tracking_id->setFormValue($objForm->GetValue("x_tracking_id"));
		}
		if (!$this->bank_ref_no->FldIsDetailKey) {
			$this->bank_ref_no->setFormValue($objForm->GetValue("x_bank_ref_no"));
		}
		if (!$this->order_status->FldIsDetailKey) {
			$this->order_status->setFormValue($objForm->GetValue("x_order_status"));
		}
		if (!$this->failure_message->FldIsDetailKey) {
			$this->failure_message->setFormValue($objForm->GetValue("x_failure_message"));
		}
		if (!$this->payment_mode->FldIsDetailKey) {
			$this->payment_mode->setFormValue($objForm->GetValue("x_payment_mode"));
		}
		if (!$this->card_name->FldIsDetailKey) {
			$this->card_name->setFormValue($objForm->GetValue("x_card_name"));
		}
		if (!$this->status_code->FldIsDetailKey) {
			$this->status_code->setFormValue($objForm->GetValue("x_status_code"));
		}
		if (!$this->status_message->FldIsDetailKey) {
			$this->status_message->setFormValue($objForm->GetValue("x_status_message"));
		}
		if (!$this->currency->FldIsDetailKey) {
			$this->currency->setFormValue($objForm->GetValue("x_currency"));
		}
		if (!$this->amount->FldIsDetailKey) {
			$this->amount->setFormValue($objForm->GetValue("x_amount"));
		}
		if (!$this->billing_name->FldIsDetailKey) {
			$this->billing_name->setFormValue($objForm->GetValue("x_billing_name"));
		}
		if (!$this->billing_address->FldIsDetailKey) {
			$this->billing_address->setFormValue($objForm->GetValue("x_billing_address"));
		}
		if (!$this->billing_city->FldIsDetailKey) {
			$this->billing_city->setFormValue($objForm->GetValue("x_billing_city"));
		}
		if (!$this->billing_state->FldIsDetailKey) {
			$this->billing_state->setFormValue($objForm->GetValue("x_billing_state"));
		}
		if (!$this->billing_zip->FldIsDetailKey) {
			$this->billing_zip->setFormValue($objForm->GetValue("x_billing_zip"));
		}
		if (!$this->billing_country->FldIsDetailKey) {
			$this->billing_country->setFormValue($objForm->GetValue("x_billing_country"));
		}
		if (!$this->billing_tel->FldIsDetailKey) {
			$this->billing_tel->setFormValue($objForm->GetValue("x_billing_tel"));
		}
		if (!$this->billing_email->FldIsDetailKey) {
			$this->billing_email->setFormValue($objForm->GetValue("x_billing_email"));
		}
		if (!$this->delivery_name->FldIsDetailKey) {
			$this->delivery_name->setFormValue($objForm->GetValue("x_delivery_name"));
		}
		if (!$this->delivery_address->FldIsDetailKey) {
			$this->delivery_address->setFormValue($objForm->GetValue("x_delivery_address"));
		}
		if (!$this->delivery_city->FldIsDetailKey) {
			$this->delivery_city->setFormValue($objForm->GetValue("x_delivery_city"));
		}
		if (!$this->delivery_state->FldIsDetailKey) {
			$this->delivery_state->setFormValue($objForm->GetValue("x_delivery_state"));
		}
		if (!$this->delivery_zip->FldIsDetailKey) {
			$this->delivery_zip->setFormValue($objForm->GetValue("x_delivery_zip"));
		}
		if (!$this->delivery_country->FldIsDetailKey) {
			$this->delivery_country->setFormValue($objForm->GetValue("x_delivery_country"));
		}
		if (!$this->delivery_tel->FldIsDetailKey) {
			$this->delivery_tel->setFormValue($objForm->GetValue("x_delivery_tel"));
		}
		if (!$this->merchant_param1->FldIsDetailKey) {
			$this->merchant_param1->setFormValue($objForm->GetValue("x_merchant_param1"));
		}
		if (!$this->merchant_param2->FldIsDetailKey) {
			$this->merchant_param2->setFormValue($objForm->GetValue("x_merchant_param2"));
		}
		if (!$this->merchant_param3->FldIsDetailKey) {
			$this->merchant_param3->setFormValue($objForm->GetValue("x_merchant_param3"));
		}
		if (!$this->merchant_param4->FldIsDetailKey) {
			$this->merchant_param4->setFormValue($objForm->GetValue("x_merchant_param4"));
		}
		if (!$this->merchant_param5->FldIsDetailKey) {
			$this->merchant_param5->setFormValue($objForm->GetValue("x_merchant_param5"));
		}
		if (!$this->vault->FldIsDetailKey) {
			$this->vault->setFormValue($objForm->GetValue("x_vault"));
		}
		if (!$this->offer_type->FldIsDetailKey) {
			$this->offer_type->setFormValue($objForm->GetValue("x_offer_type"));
		}
		if (!$this->offer_code->FldIsDetailKey) {
			$this->offer_code->setFormValue($objForm->GetValue("x_offer_code"));
		}
		if (!$this->discount_value->FldIsDetailKey) {
			$this->discount_value->setFormValue($objForm->GetValue("x_discount_value"));
		}
		if (!$this->mer_amount->FldIsDetailKey) {
			$this->mer_amount->setFormValue($objForm->GetValue("x_mer_amount"));
		}
		if (!$this->eci_value->FldIsDetailKey) {
			$this->eci_value->setFormValue($objForm->GetValue("x_eci_value"));
		}
		if (!$this->card_holder_name->FldIsDetailKey) {
			$this->card_holder_name->setFormValue($objForm->GetValue("x_card_holder_name"));
		}
		if (!$this->bank_qsi_no->FldIsDetailKey) {
			$this->bank_qsi_no->setFormValue($objForm->GetValue("x_bank_qsi_no"));
		}
		if (!$this->bank_receipt_no->FldIsDetailKey) {
			$this->bank_receipt_no->setFormValue($objForm->GetValue("x_bank_receipt_no"));
		}
		if (!$this->merchant_param6->FldIsDetailKey) {
			$this->merchant_param6->setFormValue($objForm->GetValue("x_merchant_param6"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->_userID->CurrentValue = $this->_userID->FormValue;
		$this->bookingNumber->CurrentValue = $this->bookingNumber->FormValue;
		$this->bookingModule->CurrentValue = $this->bookingModule->FormValue;
		$this->order_id->CurrentValue = $this->order_id->FormValue;
		$this->tracking_id->CurrentValue = $this->tracking_id->FormValue;
		$this->bank_ref_no->CurrentValue = $this->bank_ref_no->FormValue;
		$this->order_status->CurrentValue = $this->order_status->FormValue;
		$this->failure_message->CurrentValue = $this->failure_message->FormValue;
		$this->payment_mode->CurrentValue = $this->payment_mode->FormValue;
		$this->card_name->CurrentValue = $this->card_name->FormValue;
		$this->status_code->CurrentValue = $this->status_code->FormValue;
		$this->status_message->CurrentValue = $this->status_message->FormValue;
		$this->currency->CurrentValue = $this->currency->FormValue;
		$this->amount->CurrentValue = $this->amount->FormValue;
		$this->billing_name->CurrentValue = $this->billing_name->FormValue;
		$this->billing_address->CurrentValue = $this->billing_address->FormValue;
		$this->billing_city->CurrentValue = $this->billing_city->FormValue;
		$this->billing_state->CurrentValue = $this->billing_state->FormValue;
		$this->billing_zip->CurrentValue = $this->billing_zip->FormValue;
		$this->billing_country->CurrentValue = $this->billing_country->FormValue;
		$this->billing_tel->CurrentValue = $this->billing_tel->FormValue;
		$this->billing_email->CurrentValue = $this->billing_email->FormValue;
		$this->delivery_name->CurrentValue = $this->delivery_name->FormValue;
		$this->delivery_address->CurrentValue = $this->delivery_address->FormValue;
		$this->delivery_city->CurrentValue = $this->delivery_city->FormValue;
		$this->delivery_state->CurrentValue = $this->delivery_state->FormValue;
		$this->delivery_zip->CurrentValue = $this->delivery_zip->FormValue;
		$this->delivery_country->CurrentValue = $this->delivery_country->FormValue;
		$this->delivery_tel->CurrentValue = $this->delivery_tel->FormValue;
		$this->merchant_param1->CurrentValue = $this->merchant_param1->FormValue;
		$this->merchant_param2->CurrentValue = $this->merchant_param2->FormValue;
		$this->merchant_param3->CurrentValue = $this->merchant_param3->FormValue;
		$this->merchant_param4->CurrentValue = $this->merchant_param4->FormValue;
		$this->merchant_param5->CurrentValue = $this->merchant_param5->FormValue;
		$this->vault->CurrentValue = $this->vault->FormValue;
		$this->offer_type->CurrentValue = $this->offer_type->FormValue;
		$this->offer_code->CurrentValue = $this->offer_code->FormValue;
		$this->discount_value->CurrentValue = $this->discount_value->FormValue;
		$this->mer_amount->CurrentValue = $this->mer_amount->FormValue;
		$this->eci_value->CurrentValue = $this->eci_value->FormValue;
		$this->card_holder_name->CurrentValue = $this->card_holder_name->FormValue;
		$this->bank_qsi_no->CurrentValue = $this->bank_qsi_no->FormValue;
		$this->bank_receipt_no->CurrentValue = $this->bank_receipt_no->FormValue;
		$this->merchant_param6->CurrentValue = $this->merchant_param6->FormValue;
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
		$this->LoadDefaultValues();
		$row = array();
		$row['transactionID'] = $this->transactionID->CurrentValue;
		$row['userID'] = $this->_userID->CurrentValue;
		$row['bookingNumber'] = $this->bookingNumber->CurrentValue;
		$row['bookingModule'] = $this->bookingModule->CurrentValue;
		$row['order_id'] = $this->order_id->CurrentValue;
		$row['tracking_id'] = $this->tracking_id->CurrentValue;
		$row['bank_ref_no'] = $this->bank_ref_no->CurrentValue;
		$row['order_status'] = $this->order_status->CurrentValue;
		$row['failure_message'] = $this->failure_message->CurrentValue;
		$row['payment_mode'] = $this->payment_mode->CurrentValue;
		$row['card_name'] = $this->card_name->CurrentValue;
		$row['status_code'] = $this->status_code->CurrentValue;
		$row['status_message'] = $this->status_message->CurrentValue;
		$row['currency'] = $this->currency->CurrentValue;
		$row['amount'] = $this->amount->CurrentValue;
		$row['billing_name'] = $this->billing_name->CurrentValue;
		$row['billing_address'] = $this->billing_address->CurrentValue;
		$row['billing_city'] = $this->billing_city->CurrentValue;
		$row['billing_state'] = $this->billing_state->CurrentValue;
		$row['billing_zip'] = $this->billing_zip->CurrentValue;
		$row['billing_country'] = $this->billing_country->CurrentValue;
		$row['billing_tel'] = $this->billing_tel->CurrentValue;
		$row['billing_email'] = $this->billing_email->CurrentValue;
		$row['delivery_name'] = $this->delivery_name->CurrentValue;
		$row['delivery_address'] = $this->delivery_address->CurrentValue;
		$row['delivery_city'] = $this->delivery_city->CurrentValue;
		$row['delivery_state'] = $this->delivery_state->CurrentValue;
		$row['delivery_zip'] = $this->delivery_zip->CurrentValue;
		$row['delivery_country'] = $this->delivery_country->CurrentValue;
		$row['delivery_tel'] = $this->delivery_tel->CurrentValue;
		$row['merchant_param1'] = $this->merchant_param1->CurrentValue;
		$row['merchant_param2'] = $this->merchant_param2->CurrentValue;
		$row['merchant_param3'] = $this->merchant_param3->CurrentValue;
		$row['merchant_param4'] = $this->merchant_param4->CurrentValue;
		$row['merchant_param5'] = $this->merchant_param5->CurrentValue;
		$row['vault'] = $this->vault->CurrentValue;
		$row['offer_type'] = $this->offer_type->CurrentValue;
		$row['offer_code'] = $this->offer_code->CurrentValue;
		$row['discount_value'] = $this->discount_value->CurrentValue;
		$row['mer_amount'] = $this->mer_amount->CurrentValue;
		$row['eci_value'] = $this->eci_value->CurrentValue;
		$row['card_holder_name'] = $this->card_holder_name->CurrentValue;
		$row['bank_qsi_no'] = $this->bank_qsi_no->CurrentValue;
		$row['bank_receipt_no'] = $this->bank_receipt_no->CurrentValue;
		$row['merchant_param6'] = $this->merchant_param6->CurrentValue;
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

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("transactionID")) <> "")
			$this->transactionID->CurrentValue = $this->getKey("transactionID"); // transactionID
		else
			$bValidKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($bValidKey) {
			$this->CurrentFilter = $this->KeyFilter();
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$this->OldRecordset = ew_LoadRecordset($sSql, $conn);
		}
		$this->LoadRowValues($this->OldRecordset); // Load row values
		return $bValidKey;
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
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// userID
			$this->_userID->EditAttrs["class"] = "form-control";
			$this->_userID->EditCustomAttributes = "";
			if (trim(strval($this->_userID->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`userID`" . ew_SearchString("=", $this->_userID->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `userID`, `firstName` AS `DispFld`, `lastName` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `users`";
			$sWhereWrk = "";
			$this->_userID->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->_userID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->_userID->EditValue = $arwrk;

			// bookingNumber
			$this->bookingNumber->EditAttrs["class"] = "form-control";
			$this->bookingNumber->EditCustomAttributes = "";
			$this->bookingNumber->EditValue = ew_HtmlEncode($this->bookingNumber->CurrentValue);
			$this->bookingNumber->PlaceHolder = ew_RemoveHtml($this->bookingNumber->FldCaption());

			// bookingModule
			$this->bookingModule->EditCustomAttributes = "";
			$this->bookingModule->EditValue = $this->bookingModule->Options(FALSE);

			// order_id
			$this->order_id->EditAttrs["class"] = "form-control";
			$this->order_id->EditCustomAttributes = "";
			$this->order_id->EditValue = ew_HtmlEncode($this->order_id->CurrentValue);
			$this->order_id->PlaceHolder = ew_RemoveHtml($this->order_id->FldCaption());

			// tracking_id
			$this->tracking_id->EditAttrs["class"] = "form-control";
			$this->tracking_id->EditCustomAttributes = "";
			$this->tracking_id->EditValue = ew_HtmlEncode($this->tracking_id->CurrentValue);
			$this->tracking_id->PlaceHolder = ew_RemoveHtml($this->tracking_id->FldCaption());

			// bank_ref_no
			$this->bank_ref_no->EditAttrs["class"] = "form-control";
			$this->bank_ref_no->EditCustomAttributes = "";
			$this->bank_ref_no->EditValue = ew_HtmlEncode($this->bank_ref_no->CurrentValue);
			$this->bank_ref_no->PlaceHolder = ew_RemoveHtml($this->bank_ref_no->FldCaption());

			// order_status
			$this->order_status->EditAttrs["class"] = "form-control";
			$this->order_status->EditCustomAttributes = "";
			$this->order_status->EditValue = ew_HtmlEncode($this->order_status->CurrentValue);
			$this->order_status->PlaceHolder = ew_RemoveHtml($this->order_status->FldCaption());

			// failure_message
			$this->failure_message->EditAttrs["class"] = "form-control";
			$this->failure_message->EditCustomAttributes = "";
			$this->failure_message->EditValue = ew_HtmlEncode($this->failure_message->CurrentValue);
			$this->failure_message->PlaceHolder = ew_RemoveHtml($this->failure_message->FldCaption());

			// payment_mode
			$this->payment_mode->EditAttrs["class"] = "form-control";
			$this->payment_mode->EditCustomAttributes = "";
			$this->payment_mode->EditValue = ew_HtmlEncode($this->payment_mode->CurrentValue);
			$this->payment_mode->PlaceHolder = ew_RemoveHtml($this->payment_mode->FldCaption());

			// card_name
			$this->card_name->EditAttrs["class"] = "form-control";
			$this->card_name->EditCustomAttributes = "";
			$this->card_name->EditValue = ew_HtmlEncode($this->card_name->CurrentValue);
			$this->card_name->PlaceHolder = ew_RemoveHtml($this->card_name->FldCaption());

			// status_code
			$this->status_code->EditAttrs["class"] = "form-control";
			$this->status_code->EditCustomAttributes = "";
			$this->status_code->EditValue = ew_HtmlEncode($this->status_code->CurrentValue);
			$this->status_code->PlaceHolder = ew_RemoveHtml($this->status_code->FldCaption());

			// status_message
			$this->status_message->EditAttrs["class"] = "form-control";
			$this->status_message->EditCustomAttributes = "";
			$this->status_message->EditValue = ew_HtmlEncode($this->status_message->CurrentValue);
			$this->status_message->PlaceHolder = ew_RemoveHtml($this->status_message->FldCaption());

			// currency
			$this->currency->EditAttrs["class"] = "form-control";
			$this->currency->EditCustomAttributes = "";
			$this->currency->EditValue = ew_HtmlEncode($this->currency->CurrentValue);
			$this->currency->PlaceHolder = ew_RemoveHtml($this->currency->FldCaption());

			// amount
			$this->amount->EditAttrs["class"] = "form-control";
			$this->amount->EditCustomAttributes = "";
			$this->amount->EditValue = ew_HtmlEncode($this->amount->CurrentValue);
			$this->amount->PlaceHolder = ew_RemoveHtml($this->amount->FldCaption());

			// billing_name
			$this->billing_name->EditAttrs["class"] = "form-control";
			$this->billing_name->EditCustomAttributes = "";
			$this->billing_name->EditValue = ew_HtmlEncode($this->billing_name->CurrentValue);
			$this->billing_name->PlaceHolder = ew_RemoveHtml($this->billing_name->FldCaption());

			// billing_address
			$this->billing_address->EditAttrs["class"] = "form-control";
			$this->billing_address->EditCustomAttributes = "";
			$this->billing_address->EditValue = ew_HtmlEncode($this->billing_address->CurrentValue);
			$this->billing_address->PlaceHolder = ew_RemoveHtml($this->billing_address->FldCaption());

			// billing_city
			$this->billing_city->EditAttrs["class"] = "form-control";
			$this->billing_city->EditCustomAttributes = "";
			$this->billing_city->EditValue = ew_HtmlEncode($this->billing_city->CurrentValue);
			$this->billing_city->PlaceHolder = ew_RemoveHtml($this->billing_city->FldCaption());

			// billing_state
			$this->billing_state->EditAttrs["class"] = "form-control";
			$this->billing_state->EditCustomAttributes = "";
			$this->billing_state->EditValue = ew_HtmlEncode($this->billing_state->CurrentValue);
			$this->billing_state->PlaceHolder = ew_RemoveHtml($this->billing_state->FldCaption());

			// billing_zip
			$this->billing_zip->EditAttrs["class"] = "form-control";
			$this->billing_zip->EditCustomAttributes = "";
			$this->billing_zip->EditValue = ew_HtmlEncode($this->billing_zip->CurrentValue);
			$this->billing_zip->PlaceHolder = ew_RemoveHtml($this->billing_zip->FldCaption());

			// billing_country
			$this->billing_country->EditAttrs["class"] = "form-control";
			$this->billing_country->EditCustomAttributes = "";
			$this->billing_country->EditValue = ew_HtmlEncode($this->billing_country->CurrentValue);
			$this->billing_country->PlaceHolder = ew_RemoveHtml($this->billing_country->FldCaption());

			// billing_tel
			$this->billing_tel->EditAttrs["class"] = "form-control";
			$this->billing_tel->EditCustomAttributes = "";
			$this->billing_tel->EditValue = ew_HtmlEncode($this->billing_tel->CurrentValue);
			$this->billing_tel->PlaceHolder = ew_RemoveHtml($this->billing_tel->FldCaption());

			// billing_email
			$this->billing_email->EditAttrs["class"] = "form-control";
			$this->billing_email->EditCustomAttributes = "";
			$this->billing_email->EditValue = ew_HtmlEncode($this->billing_email->CurrentValue);
			$this->billing_email->PlaceHolder = ew_RemoveHtml($this->billing_email->FldCaption());

			// delivery_name
			$this->delivery_name->EditAttrs["class"] = "form-control";
			$this->delivery_name->EditCustomAttributes = "";
			$this->delivery_name->EditValue = ew_HtmlEncode($this->delivery_name->CurrentValue);
			$this->delivery_name->PlaceHolder = ew_RemoveHtml($this->delivery_name->FldCaption());

			// delivery_address
			$this->delivery_address->EditAttrs["class"] = "form-control";
			$this->delivery_address->EditCustomAttributes = "";
			$this->delivery_address->EditValue = ew_HtmlEncode($this->delivery_address->CurrentValue);
			$this->delivery_address->PlaceHolder = ew_RemoveHtml($this->delivery_address->FldCaption());

			// delivery_city
			$this->delivery_city->EditAttrs["class"] = "form-control";
			$this->delivery_city->EditCustomAttributes = "";
			$this->delivery_city->EditValue = ew_HtmlEncode($this->delivery_city->CurrentValue);
			$this->delivery_city->PlaceHolder = ew_RemoveHtml($this->delivery_city->FldCaption());

			// delivery_state
			$this->delivery_state->EditAttrs["class"] = "form-control";
			$this->delivery_state->EditCustomAttributes = "";
			$this->delivery_state->EditValue = ew_HtmlEncode($this->delivery_state->CurrentValue);
			$this->delivery_state->PlaceHolder = ew_RemoveHtml($this->delivery_state->FldCaption());

			// delivery_zip
			$this->delivery_zip->EditAttrs["class"] = "form-control";
			$this->delivery_zip->EditCustomAttributes = "";
			$this->delivery_zip->EditValue = ew_HtmlEncode($this->delivery_zip->CurrentValue);
			$this->delivery_zip->PlaceHolder = ew_RemoveHtml($this->delivery_zip->FldCaption());

			// delivery_country
			$this->delivery_country->EditAttrs["class"] = "form-control";
			$this->delivery_country->EditCustomAttributes = "";
			$this->delivery_country->EditValue = ew_HtmlEncode($this->delivery_country->CurrentValue);
			$this->delivery_country->PlaceHolder = ew_RemoveHtml($this->delivery_country->FldCaption());

			// delivery_tel
			$this->delivery_tel->EditAttrs["class"] = "form-control";
			$this->delivery_tel->EditCustomAttributes = "";
			$this->delivery_tel->EditValue = ew_HtmlEncode($this->delivery_tel->CurrentValue);
			$this->delivery_tel->PlaceHolder = ew_RemoveHtml($this->delivery_tel->FldCaption());

			// merchant_param1
			$this->merchant_param1->EditAttrs["class"] = "form-control";
			$this->merchant_param1->EditCustomAttributes = "";
			$this->merchant_param1->EditValue = ew_HtmlEncode($this->merchant_param1->CurrentValue);
			$this->merchant_param1->PlaceHolder = ew_RemoveHtml($this->merchant_param1->FldCaption());

			// merchant_param2
			$this->merchant_param2->EditAttrs["class"] = "form-control";
			$this->merchant_param2->EditCustomAttributes = "";
			$this->merchant_param2->EditValue = ew_HtmlEncode($this->merchant_param2->CurrentValue);
			$this->merchant_param2->PlaceHolder = ew_RemoveHtml($this->merchant_param2->FldCaption());

			// merchant_param3
			$this->merchant_param3->EditAttrs["class"] = "form-control";
			$this->merchant_param3->EditCustomAttributes = "";
			$this->merchant_param3->EditValue = ew_HtmlEncode($this->merchant_param3->CurrentValue);
			$this->merchant_param3->PlaceHolder = ew_RemoveHtml($this->merchant_param3->FldCaption());

			// merchant_param4
			$this->merchant_param4->EditAttrs["class"] = "form-control";
			$this->merchant_param4->EditCustomAttributes = "";
			$this->merchant_param4->EditValue = ew_HtmlEncode($this->merchant_param4->CurrentValue);
			$this->merchant_param4->PlaceHolder = ew_RemoveHtml($this->merchant_param4->FldCaption());

			// merchant_param5
			$this->merchant_param5->EditAttrs["class"] = "form-control";
			$this->merchant_param5->EditCustomAttributes = "";
			$this->merchant_param5->EditValue = ew_HtmlEncode($this->merchant_param5->CurrentValue);
			$this->merchant_param5->PlaceHolder = ew_RemoveHtml($this->merchant_param5->FldCaption());

			// vault
			$this->vault->EditAttrs["class"] = "form-control";
			$this->vault->EditCustomAttributes = "";
			$this->vault->EditValue = ew_HtmlEncode($this->vault->CurrentValue);
			$this->vault->PlaceHolder = ew_RemoveHtml($this->vault->FldCaption());

			// offer_type
			$this->offer_type->EditAttrs["class"] = "form-control";
			$this->offer_type->EditCustomAttributes = "";
			$this->offer_type->EditValue = ew_HtmlEncode($this->offer_type->CurrentValue);
			$this->offer_type->PlaceHolder = ew_RemoveHtml($this->offer_type->FldCaption());

			// offer_code
			$this->offer_code->EditAttrs["class"] = "form-control";
			$this->offer_code->EditCustomAttributes = "";
			$this->offer_code->EditValue = ew_HtmlEncode($this->offer_code->CurrentValue);
			$this->offer_code->PlaceHolder = ew_RemoveHtml($this->offer_code->FldCaption());

			// discount_value
			$this->discount_value->EditAttrs["class"] = "form-control";
			$this->discount_value->EditCustomAttributes = "";
			$this->discount_value->EditValue = ew_HtmlEncode($this->discount_value->CurrentValue);
			$this->discount_value->PlaceHolder = ew_RemoveHtml($this->discount_value->FldCaption());

			// mer_amount
			$this->mer_amount->EditAttrs["class"] = "form-control";
			$this->mer_amount->EditCustomAttributes = "";
			$this->mer_amount->EditValue = ew_HtmlEncode($this->mer_amount->CurrentValue);
			$this->mer_amount->PlaceHolder = ew_RemoveHtml($this->mer_amount->FldCaption());

			// eci_value
			$this->eci_value->EditAttrs["class"] = "form-control";
			$this->eci_value->EditCustomAttributes = "";
			$this->eci_value->EditValue = ew_HtmlEncode($this->eci_value->CurrentValue);
			$this->eci_value->PlaceHolder = ew_RemoveHtml($this->eci_value->FldCaption());

			// card_holder_name
			$this->card_holder_name->EditAttrs["class"] = "form-control";
			$this->card_holder_name->EditCustomAttributes = "";
			$this->card_holder_name->EditValue = ew_HtmlEncode($this->card_holder_name->CurrentValue);
			$this->card_holder_name->PlaceHolder = ew_RemoveHtml($this->card_holder_name->FldCaption());

			// bank_qsi_no
			$this->bank_qsi_no->EditAttrs["class"] = "form-control";
			$this->bank_qsi_no->EditCustomAttributes = "";
			$this->bank_qsi_no->EditValue = ew_HtmlEncode($this->bank_qsi_no->CurrentValue);
			$this->bank_qsi_no->PlaceHolder = ew_RemoveHtml($this->bank_qsi_no->FldCaption());

			// bank_receipt_no
			$this->bank_receipt_no->EditAttrs["class"] = "form-control";
			$this->bank_receipt_no->EditCustomAttributes = "";
			$this->bank_receipt_no->EditValue = ew_HtmlEncode($this->bank_receipt_no->CurrentValue);
			$this->bank_receipt_no->PlaceHolder = ew_RemoveHtml($this->bank_receipt_no->FldCaption());

			// merchant_param6
			$this->merchant_param6->EditAttrs["class"] = "form-control";
			$this->merchant_param6->EditCustomAttributes = "";
			$this->merchant_param6->EditValue = ew_HtmlEncode($this->merchant_param6->CurrentValue);
			$this->merchant_param6->PlaceHolder = ew_RemoveHtml($this->merchant_param6->FldCaption());

			// Add refer script
			// userID

			$this->_userID->LinkCustomAttributes = "";
			$this->_userID->HrefValue = "";

			// bookingNumber
			$this->bookingNumber->LinkCustomAttributes = "";
			$this->bookingNumber->HrefValue = "";

			// bookingModule
			$this->bookingModule->LinkCustomAttributes = "";
			$this->bookingModule->HrefValue = "";

			// order_id
			$this->order_id->LinkCustomAttributes = "";
			$this->order_id->HrefValue = "";

			// tracking_id
			$this->tracking_id->LinkCustomAttributes = "";
			$this->tracking_id->HrefValue = "";

			// bank_ref_no
			$this->bank_ref_no->LinkCustomAttributes = "";
			$this->bank_ref_no->HrefValue = "";

			// order_status
			$this->order_status->LinkCustomAttributes = "";
			$this->order_status->HrefValue = "";

			// failure_message
			$this->failure_message->LinkCustomAttributes = "";
			$this->failure_message->HrefValue = "";

			// payment_mode
			$this->payment_mode->LinkCustomAttributes = "";
			$this->payment_mode->HrefValue = "";

			// card_name
			$this->card_name->LinkCustomAttributes = "";
			$this->card_name->HrefValue = "";

			// status_code
			$this->status_code->LinkCustomAttributes = "";
			$this->status_code->HrefValue = "";

			// status_message
			$this->status_message->LinkCustomAttributes = "";
			$this->status_message->HrefValue = "";

			// currency
			$this->currency->LinkCustomAttributes = "";
			$this->currency->HrefValue = "";

			// amount
			$this->amount->LinkCustomAttributes = "";
			$this->amount->HrefValue = "";

			// billing_name
			$this->billing_name->LinkCustomAttributes = "";
			$this->billing_name->HrefValue = "";

			// billing_address
			$this->billing_address->LinkCustomAttributes = "";
			$this->billing_address->HrefValue = "";

			// billing_city
			$this->billing_city->LinkCustomAttributes = "";
			$this->billing_city->HrefValue = "";

			// billing_state
			$this->billing_state->LinkCustomAttributes = "";
			$this->billing_state->HrefValue = "";

			// billing_zip
			$this->billing_zip->LinkCustomAttributes = "";
			$this->billing_zip->HrefValue = "";

			// billing_country
			$this->billing_country->LinkCustomAttributes = "";
			$this->billing_country->HrefValue = "";

			// billing_tel
			$this->billing_tel->LinkCustomAttributes = "";
			$this->billing_tel->HrefValue = "";

			// billing_email
			$this->billing_email->LinkCustomAttributes = "";
			$this->billing_email->HrefValue = "";

			// delivery_name
			$this->delivery_name->LinkCustomAttributes = "";
			$this->delivery_name->HrefValue = "";

			// delivery_address
			$this->delivery_address->LinkCustomAttributes = "";
			$this->delivery_address->HrefValue = "";

			// delivery_city
			$this->delivery_city->LinkCustomAttributes = "";
			$this->delivery_city->HrefValue = "";

			// delivery_state
			$this->delivery_state->LinkCustomAttributes = "";
			$this->delivery_state->HrefValue = "";

			// delivery_zip
			$this->delivery_zip->LinkCustomAttributes = "";
			$this->delivery_zip->HrefValue = "";

			// delivery_country
			$this->delivery_country->LinkCustomAttributes = "";
			$this->delivery_country->HrefValue = "";

			// delivery_tel
			$this->delivery_tel->LinkCustomAttributes = "";
			$this->delivery_tel->HrefValue = "";

			// merchant_param1
			$this->merchant_param1->LinkCustomAttributes = "";
			$this->merchant_param1->HrefValue = "";

			// merchant_param2
			$this->merchant_param2->LinkCustomAttributes = "";
			$this->merchant_param2->HrefValue = "";

			// merchant_param3
			$this->merchant_param3->LinkCustomAttributes = "";
			$this->merchant_param3->HrefValue = "";

			// merchant_param4
			$this->merchant_param4->LinkCustomAttributes = "";
			$this->merchant_param4->HrefValue = "";

			// merchant_param5
			$this->merchant_param5->LinkCustomAttributes = "";
			$this->merchant_param5->HrefValue = "";

			// vault
			$this->vault->LinkCustomAttributes = "";
			$this->vault->HrefValue = "";

			// offer_type
			$this->offer_type->LinkCustomAttributes = "";
			$this->offer_type->HrefValue = "";

			// offer_code
			$this->offer_code->LinkCustomAttributes = "";
			$this->offer_code->HrefValue = "";

			// discount_value
			$this->discount_value->LinkCustomAttributes = "";
			$this->discount_value->HrefValue = "";

			// mer_amount
			$this->mer_amount->LinkCustomAttributes = "";
			$this->mer_amount->HrefValue = "";

			// eci_value
			$this->eci_value->LinkCustomAttributes = "";
			$this->eci_value->HrefValue = "";

			// card_holder_name
			$this->card_holder_name->LinkCustomAttributes = "";
			$this->card_holder_name->HrefValue = "";

			// bank_qsi_no
			$this->bank_qsi_no->LinkCustomAttributes = "";
			$this->bank_qsi_no->HrefValue = "";

			// bank_receipt_no
			$this->bank_receipt_no->LinkCustomAttributes = "";
			$this->bank_receipt_no->HrefValue = "";

			// merchant_param6
			$this->merchant_param6->LinkCustomAttributes = "";
			$this->merchant_param6->HrefValue = "";
		}
		if ($this->RowType == EW_ROWTYPE_ADD || $this->RowType == EW_ROWTYPE_EDIT || $this->RowType == EW_ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->SetupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!$this->_userID->FldIsDetailKey && !is_null($this->_userID->FormValue) && $this->_userID->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->_userID->FldCaption(), $this->_userID->ReqErrMsg));
		}
		if (!$this->billing_name->FldIsDetailKey && !is_null($this->billing_name->FormValue) && $this->billing_name->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->billing_name->FldCaption(), $this->billing_name->ReqErrMsg));
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;
		$conn = &$this->Connection();

		// Load db values from rsold
		$this->LoadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = array();

		// userID
		$this->_userID->SetDbValueDef($rsnew, $this->_userID->CurrentValue, 0, strval($this->_userID->CurrentValue) == "");

		// bookingNumber
		$this->bookingNumber->SetDbValueDef($rsnew, $this->bookingNumber->CurrentValue, NULL, FALSE);

		// bookingModule
		$this->bookingModule->SetDbValueDef($rsnew, $this->bookingModule->CurrentValue, NULL, FALSE);

		// order_id
		$this->order_id->SetDbValueDef($rsnew, $this->order_id->CurrentValue, NULL, FALSE);

		// tracking_id
		$this->tracking_id->SetDbValueDef($rsnew, $this->tracking_id->CurrentValue, NULL, FALSE);

		// bank_ref_no
		$this->bank_ref_no->SetDbValueDef($rsnew, $this->bank_ref_no->CurrentValue, NULL, FALSE);

		// order_status
		$this->order_status->SetDbValueDef($rsnew, $this->order_status->CurrentValue, NULL, FALSE);

		// failure_message
		$this->failure_message->SetDbValueDef($rsnew, $this->failure_message->CurrentValue, NULL, FALSE);

		// payment_mode
		$this->payment_mode->SetDbValueDef($rsnew, $this->payment_mode->CurrentValue, NULL, FALSE);

		// card_name
		$this->card_name->SetDbValueDef($rsnew, $this->card_name->CurrentValue, NULL, FALSE);

		// status_code
		$this->status_code->SetDbValueDef($rsnew, $this->status_code->CurrentValue, NULL, FALSE);

		// status_message
		$this->status_message->SetDbValueDef($rsnew, $this->status_message->CurrentValue, NULL, FALSE);

		// currency
		$this->currency->SetDbValueDef($rsnew, $this->currency->CurrentValue, NULL, FALSE);

		// amount
		$this->amount->SetDbValueDef($rsnew, $this->amount->CurrentValue, NULL, FALSE);

		// billing_name
		$this->billing_name->SetDbValueDef($rsnew, $this->billing_name->CurrentValue, "", FALSE);

		// billing_address
		$this->billing_address->SetDbValueDef($rsnew, $this->billing_address->CurrentValue, NULL, FALSE);

		// billing_city
		$this->billing_city->SetDbValueDef($rsnew, $this->billing_city->CurrentValue, NULL, FALSE);

		// billing_state
		$this->billing_state->SetDbValueDef($rsnew, $this->billing_state->CurrentValue, NULL, FALSE);

		// billing_zip
		$this->billing_zip->SetDbValueDef($rsnew, $this->billing_zip->CurrentValue, NULL, FALSE);

		// billing_country
		$this->billing_country->SetDbValueDef($rsnew, $this->billing_country->CurrentValue, NULL, FALSE);

		// billing_tel
		$this->billing_tel->SetDbValueDef($rsnew, $this->billing_tel->CurrentValue, NULL, FALSE);

		// billing_email
		$this->billing_email->SetDbValueDef($rsnew, $this->billing_email->CurrentValue, NULL, FALSE);

		// delivery_name
		$this->delivery_name->SetDbValueDef($rsnew, $this->delivery_name->CurrentValue, NULL, FALSE);

		// delivery_address
		$this->delivery_address->SetDbValueDef($rsnew, $this->delivery_address->CurrentValue, NULL, FALSE);

		// delivery_city
		$this->delivery_city->SetDbValueDef($rsnew, $this->delivery_city->CurrentValue, NULL, FALSE);

		// delivery_state
		$this->delivery_state->SetDbValueDef($rsnew, $this->delivery_state->CurrentValue, NULL, FALSE);

		// delivery_zip
		$this->delivery_zip->SetDbValueDef($rsnew, $this->delivery_zip->CurrentValue, NULL, FALSE);

		// delivery_country
		$this->delivery_country->SetDbValueDef($rsnew, $this->delivery_country->CurrentValue, NULL, FALSE);

		// delivery_tel
		$this->delivery_tel->SetDbValueDef($rsnew, $this->delivery_tel->CurrentValue, NULL, FALSE);

		// merchant_param1
		$this->merchant_param1->SetDbValueDef($rsnew, $this->merchant_param1->CurrentValue, NULL, FALSE);

		// merchant_param2
		$this->merchant_param2->SetDbValueDef($rsnew, $this->merchant_param2->CurrentValue, NULL, FALSE);

		// merchant_param3
		$this->merchant_param3->SetDbValueDef($rsnew, $this->merchant_param3->CurrentValue, NULL, FALSE);

		// merchant_param4
		$this->merchant_param4->SetDbValueDef($rsnew, $this->merchant_param4->CurrentValue, NULL, FALSE);

		// merchant_param5
		$this->merchant_param5->SetDbValueDef($rsnew, $this->merchant_param5->CurrentValue, NULL, FALSE);

		// vault
		$this->vault->SetDbValueDef($rsnew, $this->vault->CurrentValue, NULL, FALSE);

		// offer_type
		$this->offer_type->SetDbValueDef($rsnew, $this->offer_type->CurrentValue, NULL, FALSE);

		// offer_code
		$this->offer_code->SetDbValueDef($rsnew, $this->offer_code->CurrentValue, NULL, FALSE);

		// discount_value
		$this->discount_value->SetDbValueDef($rsnew, $this->discount_value->CurrentValue, NULL, FALSE);

		// mer_amount
		$this->mer_amount->SetDbValueDef($rsnew, $this->mer_amount->CurrentValue, NULL, FALSE);

		// eci_value
		$this->eci_value->SetDbValueDef($rsnew, $this->eci_value->CurrentValue, NULL, FALSE);

		// card_holder_name
		$this->card_holder_name->SetDbValueDef($rsnew, $this->card_holder_name->CurrentValue, NULL, FALSE);

		// bank_qsi_no
		$this->bank_qsi_no->SetDbValueDef($rsnew, $this->bank_qsi_no->CurrentValue, NULL, FALSE);

		// bank_receipt_no
		$this->bank_receipt_no->SetDbValueDef($rsnew, $this->bank_receipt_no->CurrentValue, NULL, FALSE);

		// merchant_param6
		$this->merchant_param6->SetDbValueDef($rsnew, $this->merchant_param6->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$AddRow = $this->Insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($AddRow) {
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("pg_transactionslist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Set up multi pages
	function SetupMultiPages() {
		$pages = new cSubPages();
		$pages->Style = "tabs";
		$pages->Add(0);
		$pages->Add(1);
		$pages->Add(2);
		$pages->Add(3);
		$pages->Add(4);
		$this->MultiPages = $pages;
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x__userID":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `userID` AS `LinkFld`, `firstName` AS `DispFld`, `lastName` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `users`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`userID` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->_userID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($pg_transactions_add)) $pg_transactions_add = new cpg_transactions_add();

// Page init
$pg_transactions_add->Page_Init();

// Page main
$pg_transactions_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pg_transactions_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = fpg_transactionsadd = new ew_Form("fpg_transactionsadd", "add");

// Validate form
fpg_transactionsadd.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
			elm = this.GetElements("x" + infix + "__userID");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pg_transactions->_userID->FldCaption(), $pg_transactions->_userID->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_billing_name");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pg_transactions->billing_name->FldCaption(), $pg_transactions->billing_name->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ewForms[val])
			if (!ewForms[val].Validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
fpg_transactionsadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fpg_transactionsadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Multi-Page
fpg_transactionsadd.MultiPage = new ew_MultiPage("fpg_transactionsadd");

// Dynamic selection lists
fpg_transactionsadd.Lists["x__userID"] = {"LinkField":"x__userID","Ajax":true,"AutoFill":false,"DisplayFields":["x_firstName","x_lastName","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"users"};
fpg_transactionsadd.Lists["x__userID"].Data = "<?php echo $pg_transactions_add->_userID->LookupFilterQuery(FALSE, "add") ?>";
fpg_transactionsadd.Lists["x_bookingModule"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fpg_transactionsadd.Lists["x_bookingModule"].Options = <?php echo json_encode($pg_transactions_add->bookingModule->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $pg_transactions_add->ShowPageHeader(); ?>
<?php
$pg_transactions_add->ShowMessage();
?>
<form name="fpg_transactionsadd" id="fpg_transactionsadd" class="<?php echo $pg_transactions_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($pg_transactions_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $pg_transactions_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pg_transactions">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($pg_transactions_add->IsModal) ?>">
<div class="ewMultiPage"><!-- multi-page -->
<div class="nav-tabs-custom" id="pg_transactions_add"><!-- multi-page .nav-tabs-custom -->
	<ul class="nav<?php echo $pg_transactions_add->MultiPages->NavStyle() ?>">
		<li<?php echo $pg_transactions_add->MultiPages->TabStyle("1") ?>><a href="#tab_pg_transactions1" data-toggle="tab"><?php echo $pg_transactions->PageCaption(1) ?></a></li>
		<li<?php echo $pg_transactions_add->MultiPages->TabStyle("2") ?>><a href="#tab_pg_transactions2" data-toggle="tab"><?php echo $pg_transactions->PageCaption(2) ?></a></li>
		<li<?php echo $pg_transactions_add->MultiPages->TabStyle("3") ?>><a href="#tab_pg_transactions3" data-toggle="tab"><?php echo $pg_transactions->PageCaption(3) ?></a></li>
		<li<?php echo $pg_transactions_add->MultiPages->TabStyle("4") ?>><a href="#tab_pg_transactions4" data-toggle="tab"><?php echo $pg_transactions->PageCaption(4) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page .nav-tabs-custom .tab-content -->
		<div class="tab-pane<?php echo $pg_transactions_add->MultiPages->PageStyle("1") ?>" id="tab_pg_transactions1"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($pg_transactions->_userID->Visible) { // userID ?>
	<div id="r__userID" class="form-group">
		<label id="elh_pg_transactions__userID" for="x__userID" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->_userID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->_userID->CellAttributes() ?>>
<span id="el_pg_transactions__userID">
<select data-table="pg_transactions" data-field="x__userID" data-page="1" data-value-separator="<?php echo $pg_transactions->_userID->DisplayValueSeparatorAttribute() ?>" id="x__userID" name="x__userID"<?php echo $pg_transactions->_userID->EditAttributes() ?>>
<?php echo $pg_transactions->_userID->SelectOptionListHtml("x__userID") ?>
</select>
</span>
<?php echo $pg_transactions->_userID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->bookingNumber->Visible) { // bookingNumber ?>
	<div id="r_bookingNumber" class="form-group">
		<label id="elh_pg_transactions_bookingNumber" for="x_bookingNumber" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->bookingNumber->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->bookingNumber->CellAttributes() ?>>
<span id="el_pg_transactions_bookingNumber">
<input type="text" data-table="pg_transactions" data-field="x_bookingNumber" data-page="1" name="x_bookingNumber" id="x_bookingNumber" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->bookingNumber->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->bookingNumber->EditValue ?>"<?php echo $pg_transactions->bookingNumber->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->bookingNumber->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->bookingModule->Visible) { // bookingModule ?>
	<div id="r_bookingModule" class="form-group">
		<label id="elh_pg_transactions_bookingModule" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->bookingModule->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->bookingModule->CellAttributes() ?>>
<span id="el_pg_transactions_bookingModule">
<div id="tp_x_bookingModule" class="ewTemplate"><input type="radio" data-table="pg_transactions" data-field="x_bookingModule" data-page="1" data-value-separator="<?php echo $pg_transactions->bookingModule->DisplayValueSeparatorAttribute() ?>" name="x_bookingModule" id="x_bookingModule" value="{value}"<?php echo $pg_transactions->bookingModule->EditAttributes() ?>></div>
<div id="dsl_x_bookingModule" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $pg_transactions->bookingModule->RadioButtonListHtml(FALSE, "x_bookingModule", 1) ?>
</div></div>
</span>
<?php echo $pg_transactions->bookingModule->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->order_id->Visible) { // order_id ?>
	<div id="r_order_id" class="form-group">
		<label id="elh_pg_transactions_order_id" for="x_order_id" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->order_id->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->order_id->CellAttributes() ?>>
<span id="el_pg_transactions_order_id">
<input type="text" data-table="pg_transactions" data-field="x_order_id" data-page="1" name="x_order_id" id="x_order_id" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->order_id->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->order_id->EditValue ?>"<?php echo $pg_transactions->order_id->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->order_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->tracking_id->Visible) { // tracking_id ?>
	<div id="r_tracking_id" class="form-group">
		<label id="elh_pg_transactions_tracking_id" for="x_tracking_id" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->tracking_id->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->tracking_id->CellAttributes() ?>>
<span id="el_pg_transactions_tracking_id">
<input type="text" data-table="pg_transactions" data-field="x_tracking_id" data-page="1" name="x_tracking_id" id="x_tracking_id" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->tracking_id->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->tracking_id->EditValue ?>"<?php echo $pg_transactions->tracking_id->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->tracking_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->bank_ref_no->Visible) { // bank_ref_no ?>
	<div id="r_bank_ref_no" class="form-group">
		<label id="elh_pg_transactions_bank_ref_no" for="x_bank_ref_no" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->bank_ref_no->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->bank_ref_no->CellAttributes() ?>>
<span id="el_pg_transactions_bank_ref_no">
<input type="text" data-table="pg_transactions" data-field="x_bank_ref_no" data-page="1" name="x_bank_ref_no" id="x_bank_ref_no" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->bank_ref_no->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->bank_ref_no->EditValue ?>"<?php echo $pg_transactions->bank_ref_no->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->bank_ref_no->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->order_status->Visible) { // order_status ?>
	<div id="r_order_status" class="form-group">
		<label id="elh_pg_transactions_order_status" for="x_order_status" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->order_status->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->order_status->CellAttributes() ?>>
<span id="el_pg_transactions_order_status">
<input type="text" data-table="pg_transactions" data-field="x_order_status" data-page="1" name="x_order_status" id="x_order_status" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->order_status->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->order_status->EditValue ?>"<?php echo $pg_transactions->order_status->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->order_status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->failure_message->Visible) { // failure_message ?>
	<div id="r_failure_message" class="form-group">
		<label id="elh_pg_transactions_failure_message" for="x_failure_message" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->failure_message->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->failure_message->CellAttributes() ?>>
<span id="el_pg_transactions_failure_message">
<input type="text" data-table="pg_transactions" data-field="x_failure_message" data-page="1" name="x_failure_message" id="x_failure_message" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->failure_message->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->failure_message->EditValue ?>"<?php echo $pg_transactions->failure_message->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->failure_message->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->payment_mode->Visible) { // payment_mode ?>
	<div id="r_payment_mode" class="form-group">
		<label id="elh_pg_transactions_payment_mode" for="x_payment_mode" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->payment_mode->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->payment_mode->CellAttributes() ?>>
<span id="el_pg_transactions_payment_mode">
<input type="text" data-table="pg_transactions" data-field="x_payment_mode" data-page="1" name="x_payment_mode" id="x_payment_mode" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->payment_mode->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->payment_mode->EditValue ?>"<?php echo $pg_transactions->payment_mode->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->payment_mode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->card_name->Visible) { // card_name ?>
	<div id="r_card_name" class="form-group">
		<label id="elh_pg_transactions_card_name" for="x_card_name" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->card_name->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->card_name->CellAttributes() ?>>
<span id="el_pg_transactions_card_name">
<input type="text" data-table="pg_transactions" data-field="x_card_name" data-page="1" name="x_card_name" id="x_card_name" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->card_name->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->card_name->EditValue ?>"<?php echo $pg_transactions->card_name->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->card_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->status_code->Visible) { // status_code ?>
	<div id="r_status_code" class="form-group">
		<label id="elh_pg_transactions_status_code" for="x_status_code" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->status_code->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->status_code->CellAttributes() ?>>
<span id="el_pg_transactions_status_code">
<input type="text" data-table="pg_transactions" data-field="x_status_code" data-page="1" name="x_status_code" id="x_status_code" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->status_code->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->status_code->EditValue ?>"<?php echo $pg_transactions->status_code->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->status_code->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->status_message->Visible) { // status_message ?>
	<div id="r_status_message" class="form-group">
		<label id="elh_pg_transactions_status_message" for="x_status_message" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->status_message->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->status_message->CellAttributes() ?>>
<span id="el_pg_transactions_status_message">
<input type="text" data-table="pg_transactions" data-field="x_status_message" data-page="1" name="x_status_message" id="x_status_message" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->status_message->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->status_message->EditValue ?>"<?php echo $pg_transactions->status_message->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->status_message->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->currency->Visible) { // currency ?>
	<div id="r_currency" class="form-group">
		<label id="elh_pg_transactions_currency" for="x_currency" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->currency->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->currency->CellAttributes() ?>>
<span id="el_pg_transactions_currency">
<input type="text" data-table="pg_transactions" data-field="x_currency" data-page="1" name="x_currency" id="x_currency" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->currency->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->currency->EditValue ?>"<?php echo $pg_transactions->currency->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->currency->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->amount->Visible) { // amount ?>
	<div id="r_amount" class="form-group">
		<label id="elh_pg_transactions_amount" for="x_amount" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->amount->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->amount->CellAttributes() ?>>
<span id="el_pg_transactions_amount">
<input type="text" data-table="pg_transactions" data-field="x_amount" data-page="1" name="x_amount" id="x_amount" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->amount->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->amount->EditValue ?>"<?php echo $pg_transactions->amount->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->amount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->vault->Visible) { // vault ?>
	<div id="r_vault" class="form-group">
		<label id="elh_pg_transactions_vault" for="x_vault" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->vault->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->vault->CellAttributes() ?>>
<span id="el_pg_transactions_vault">
<input type="text" data-table="pg_transactions" data-field="x_vault" data-page="1" name="x_vault" id="x_vault" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->vault->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->vault->EditValue ?>"<?php echo $pg_transactions->vault->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->vault->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->offer_type->Visible) { // offer_type ?>
	<div id="r_offer_type" class="form-group">
		<label id="elh_pg_transactions_offer_type" for="x_offer_type" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->offer_type->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->offer_type->CellAttributes() ?>>
<span id="el_pg_transactions_offer_type">
<input type="text" data-table="pg_transactions" data-field="x_offer_type" data-page="1" name="x_offer_type" id="x_offer_type" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->offer_type->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->offer_type->EditValue ?>"<?php echo $pg_transactions->offer_type->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->offer_type->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->offer_code->Visible) { // offer_code ?>
	<div id="r_offer_code" class="form-group">
		<label id="elh_pg_transactions_offer_code" for="x_offer_code" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->offer_code->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->offer_code->CellAttributes() ?>>
<span id="el_pg_transactions_offer_code">
<input type="text" data-table="pg_transactions" data-field="x_offer_code" data-page="1" name="x_offer_code" id="x_offer_code" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->offer_code->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->offer_code->EditValue ?>"<?php echo $pg_transactions->offer_code->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->offer_code->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->discount_value->Visible) { // discount_value ?>
	<div id="r_discount_value" class="form-group">
		<label id="elh_pg_transactions_discount_value" for="x_discount_value" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->discount_value->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->discount_value->CellAttributes() ?>>
<span id="el_pg_transactions_discount_value">
<input type="text" data-table="pg_transactions" data-field="x_discount_value" data-page="1" name="x_discount_value" id="x_discount_value" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->discount_value->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->discount_value->EditValue ?>"<?php echo $pg_transactions->discount_value->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->discount_value->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->mer_amount->Visible) { // mer_amount ?>
	<div id="r_mer_amount" class="form-group">
		<label id="elh_pg_transactions_mer_amount" for="x_mer_amount" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->mer_amount->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->mer_amount->CellAttributes() ?>>
<span id="el_pg_transactions_mer_amount">
<input type="text" data-table="pg_transactions" data-field="x_mer_amount" data-page="1" name="x_mer_amount" id="x_mer_amount" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->mer_amount->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->mer_amount->EditValue ?>"<?php echo $pg_transactions->mer_amount->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->mer_amount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->eci_value->Visible) { // eci_value ?>
	<div id="r_eci_value" class="form-group">
		<label id="elh_pg_transactions_eci_value" for="x_eci_value" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->eci_value->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->eci_value->CellAttributes() ?>>
<span id="el_pg_transactions_eci_value">
<input type="text" data-table="pg_transactions" data-field="x_eci_value" data-page="1" name="x_eci_value" id="x_eci_value" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->eci_value->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->eci_value->EditValue ?>"<?php echo $pg_transactions->eci_value->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->eci_value->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->card_holder_name->Visible) { // card_holder_name ?>
	<div id="r_card_holder_name" class="form-group">
		<label id="elh_pg_transactions_card_holder_name" for="x_card_holder_name" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->card_holder_name->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->card_holder_name->CellAttributes() ?>>
<span id="el_pg_transactions_card_holder_name">
<input type="text" data-table="pg_transactions" data-field="x_card_holder_name" data-page="1" name="x_card_holder_name" id="x_card_holder_name" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->card_holder_name->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->card_holder_name->EditValue ?>"<?php echo $pg_transactions->card_holder_name->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->card_holder_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->bank_qsi_no->Visible) { // bank_qsi_no ?>
	<div id="r_bank_qsi_no" class="form-group">
		<label id="elh_pg_transactions_bank_qsi_no" for="x_bank_qsi_no" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->bank_qsi_no->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->bank_qsi_no->CellAttributes() ?>>
<span id="el_pg_transactions_bank_qsi_no">
<input type="text" data-table="pg_transactions" data-field="x_bank_qsi_no" data-page="1" name="x_bank_qsi_no" id="x_bank_qsi_no" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->bank_qsi_no->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->bank_qsi_no->EditValue ?>"<?php echo $pg_transactions->bank_qsi_no->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->bank_qsi_no->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->bank_receipt_no->Visible) { // bank_receipt_no ?>
	<div id="r_bank_receipt_no" class="form-group">
		<label id="elh_pg_transactions_bank_receipt_no" for="x_bank_receipt_no" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->bank_receipt_no->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->bank_receipt_no->CellAttributes() ?>>
<span id="el_pg_transactions_bank_receipt_no">
<input type="text" data-table="pg_transactions" data-field="x_bank_receipt_no" data-page="1" name="x_bank_receipt_no" id="x_bank_receipt_no" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->bank_receipt_no->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->bank_receipt_no->EditValue ?>"<?php echo $pg_transactions->bank_receipt_no->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->bank_receipt_no->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $pg_transactions_add->MultiPages->PageStyle("2") ?>" id="tab_pg_transactions2"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($pg_transactions->billing_name->Visible) { // billing_name ?>
	<div id="r_billing_name" class="form-group">
		<label id="elh_pg_transactions_billing_name" for="x_billing_name" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->billing_name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->billing_name->CellAttributes() ?>>
<span id="el_pg_transactions_billing_name">
<input type="text" data-table="pg_transactions" data-field="x_billing_name" data-page="2" name="x_billing_name" id="x_billing_name" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->billing_name->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->billing_name->EditValue ?>"<?php echo $pg_transactions->billing_name->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->billing_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->billing_address->Visible) { // billing_address ?>
	<div id="r_billing_address" class="form-group">
		<label id="elh_pg_transactions_billing_address" for="x_billing_address" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->billing_address->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->billing_address->CellAttributes() ?>>
<span id="el_pg_transactions_billing_address">
<textarea data-table="pg_transactions" data-field="x_billing_address" data-page="2" name="x_billing_address" id="x_billing_address" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($pg_transactions->billing_address->getPlaceHolder()) ?>"<?php echo $pg_transactions->billing_address->EditAttributes() ?>><?php echo $pg_transactions->billing_address->EditValue ?></textarea>
</span>
<?php echo $pg_transactions->billing_address->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->billing_city->Visible) { // billing_city ?>
	<div id="r_billing_city" class="form-group">
		<label id="elh_pg_transactions_billing_city" for="x_billing_city" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->billing_city->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->billing_city->CellAttributes() ?>>
<span id="el_pg_transactions_billing_city">
<input type="text" data-table="pg_transactions" data-field="x_billing_city" data-page="2" name="x_billing_city" id="x_billing_city" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->billing_city->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->billing_city->EditValue ?>"<?php echo $pg_transactions->billing_city->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->billing_city->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->billing_state->Visible) { // billing_state ?>
	<div id="r_billing_state" class="form-group">
		<label id="elh_pg_transactions_billing_state" for="x_billing_state" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->billing_state->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->billing_state->CellAttributes() ?>>
<span id="el_pg_transactions_billing_state">
<input type="text" data-table="pg_transactions" data-field="x_billing_state" data-page="2" name="x_billing_state" id="x_billing_state" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->billing_state->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->billing_state->EditValue ?>"<?php echo $pg_transactions->billing_state->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->billing_state->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->billing_zip->Visible) { // billing_zip ?>
	<div id="r_billing_zip" class="form-group">
		<label id="elh_pg_transactions_billing_zip" for="x_billing_zip" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->billing_zip->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->billing_zip->CellAttributes() ?>>
<span id="el_pg_transactions_billing_zip">
<input type="text" data-table="pg_transactions" data-field="x_billing_zip" data-page="2" name="x_billing_zip" id="x_billing_zip" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->billing_zip->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->billing_zip->EditValue ?>"<?php echo $pg_transactions->billing_zip->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->billing_zip->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->billing_country->Visible) { // billing_country ?>
	<div id="r_billing_country" class="form-group">
		<label id="elh_pg_transactions_billing_country" for="x_billing_country" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->billing_country->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->billing_country->CellAttributes() ?>>
<span id="el_pg_transactions_billing_country">
<input type="text" data-table="pg_transactions" data-field="x_billing_country" data-page="2" name="x_billing_country" id="x_billing_country" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->billing_country->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->billing_country->EditValue ?>"<?php echo $pg_transactions->billing_country->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->billing_country->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->billing_tel->Visible) { // billing_tel ?>
	<div id="r_billing_tel" class="form-group">
		<label id="elh_pg_transactions_billing_tel" for="x_billing_tel" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->billing_tel->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->billing_tel->CellAttributes() ?>>
<span id="el_pg_transactions_billing_tel">
<input type="text" data-table="pg_transactions" data-field="x_billing_tel" data-page="2" name="x_billing_tel" id="x_billing_tel" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->billing_tel->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->billing_tel->EditValue ?>"<?php echo $pg_transactions->billing_tel->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->billing_tel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->billing_email->Visible) { // billing_email ?>
	<div id="r_billing_email" class="form-group">
		<label id="elh_pg_transactions_billing_email" for="x_billing_email" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->billing_email->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->billing_email->CellAttributes() ?>>
<span id="el_pg_transactions_billing_email">
<input type="text" data-table="pg_transactions" data-field="x_billing_email" data-page="2" name="x_billing_email" id="x_billing_email" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->billing_email->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->billing_email->EditValue ?>"<?php echo $pg_transactions->billing_email->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->billing_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $pg_transactions_add->MultiPages->PageStyle("3") ?>" id="tab_pg_transactions3"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($pg_transactions->delivery_name->Visible) { // delivery_name ?>
	<div id="r_delivery_name" class="form-group">
		<label id="elh_pg_transactions_delivery_name" for="x_delivery_name" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->delivery_name->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->delivery_name->CellAttributes() ?>>
<span id="el_pg_transactions_delivery_name">
<input type="text" data-table="pg_transactions" data-field="x_delivery_name" data-page="3" name="x_delivery_name" id="x_delivery_name" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->delivery_name->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->delivery_name->EditValue ?>"<?php echo $pg_transactions->delivery_name->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->delivery_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->delivery_address->Visible) { // delivery_address ?>
	<div id="r_delivery_address" class="form-group">
		<label id="elh_pg_transactions_delivery_address" for="x_delivery_address" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->delivery_address->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->delivery_address->CellAttributes() ?>>
<span id="el_pg_transactions_delivery_address">
<textarea data-table="pg_transactions" data-field="x_delivery_address" data-page="3" name="x_delivery_address" id="x_delivery_address" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($pg_transactions->delivery_address->getPlaceHolder()) ?>"<?php echo $pg_transactions->delivery_address->EditAttributes() ?>><?php echo $pg_transactions->delivery_address->EditValue ?></textarea>
</span>
<?php echo $pg_transactions->delivery_address->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->delivery_city->Visible) { // delivery_city ?>
	<div id="r_delivery_city" class="form-group">
		<label id="elh_pg_transactions_delivery_city" for="x_delivery_city" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->delivery_city->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->delivery_city->CellAttributes() ?>>
<span id="el_pg_transactions_delivery_city">
<input type="text" data-table="pg_transactions" data-field="x_delivery_city" data-page="3" name="x_delivery_city" id="x_delivery_city" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->delivery_city->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->delivery_city->EditValue ?>"<?php echo $pg_transactions->delivery_city->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->delivery_city->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->delivery_state->Visible) { // delivery_state ?>
	<div id="r_delivery_state" class="form-group">
		<label id="elh_pg_transactions_delivery_state" for="x_delivery_state" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->delivery_state->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->delivery_state->CellAttributes() ?>>
<span id="el_pg_transactions_delivery_state">
<input type="text" data-table="pg_transactions" data-field="x_delivery_state" data-page="3" name="x_delivery_state" id="x_delivery_state" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->delivery_state->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->delivery_state->EditValue ?>"<?php echo $pg_transactions->delivery_state->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->delivery_state->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->delivery_zip->Visible) { // delivery_zip ?>
	<div id="r_delivery_zip" class="form-group">
		<label id="elh_pg_transactions_delivery_zip" for="x_delivery_zip" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->delivery_zip->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->delivery_zip->CellAttributes() ?>>
<span id="el_pg_transactions_delivery_zip">
<input type="text" data-table="pg_transactions" data-field="x_delivery_zip" data-page="3" name="x_delivery_zip" id="x_delivery_zip" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->delivery_zip->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->delivery_zip->EditValue ?>"<?php echo $pg_transactions->delivery_zip->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->delivery_zip->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->delivery_country->Visible) { // delivery_country ?>
	<div id="r_delivery_country" class="form-group">
		<label id="elh_pg_transactions_delivery_country" for="x_delivery_country" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->delivery_country->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->delivery_country->CellAttributes() ?>>
<span id="el_pg_transactions_delivery_country">
<input type="text" data-table="pg_transactions" data-field="x_delivery_country" data-page="3" name="x_delivery_country" id="x_delivery_country" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->delivery_country->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->delivery_country->EditValue ?>"<?php echo $pg_transactions->delivery_country->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->delivery_country->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->delivery_tel->Visible) { // delivery_tel ?>
	<div id="r_delivery_tel" class="form-group">
		<label id="elh_pg_transactions_delivery_tel" for="x_delivery_tel" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->delivery_tel->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->delivery_tel->CellAttributes() ?>>
<span id="el_pg_transactions_delivery_tel">
<input type="text" data-table="pg_transactions" data-field="x_delivery_tel" data-page="3" name="x_delivery_tel" id="x_delivery_tel" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->delivery_tel->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->delivery_tel->EditValue ?>"<?php echo $pg_transactions->delivery_tel->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->delivery_tel->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $pg_transactions_add->MultiPages->PageStyle("4") ?>" id="tab_pg_transactions4"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($pg_transactions->merchant_param1->Visible) { // merchant_param1 ?>
	<div id="r_merchant_param1" class="form-group">
		<label id="elh_pg_transactions_merchant_param1" for="x_merchant_param1" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->merchant_param1->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->merchant_param1->CellAttributes() ?>>
<span id="el_pg_transactions_merchant_param1">
<textarea data-table="pg_transactions" data-field="x_merchant_param1" data-page="4" name="x_merchant_param1" id="x_merchant_param1" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($pg_transactions->merchant_param1->getPlaceHolder()) ?>"<?php echo $pg_transactions->merchant_param1->EditAttributes() ?>><?php echo $pg_transactions->merchant_param1->EditValue ?></textarea>
</span>
<?php echo $pg_transactions->merchant_param1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->merchant_param2->Visible) { // merchant_param2 ?>
	<div id="r_merchant_param2" class="form-group">
		<label id="elh_pg_transactions_merchant_param2" for="x_merchant_param2" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->merchant_param2->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->merchant_param2->CellAttributes() ?>>
<span id="el_pg_transactions_merchant_param2">
<textarea data-table="pg_transactions" data-field="x_merchant_param2" data-page="4" name="x_merchant_param2" id="x_merchant_param2" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($pg_transactions->merchant_param2->getPlaceHolder()) ?>"<?php echo $pg_transactions->merchant_param2->EditAttributes() ?>><?php echo $pg_transactions->merchant_param2->EditValue ?></textarea>
</span>
<?php echo $pg_transactions->merchant_param2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->merchant_param3->Visible) { // merchant_param3 ?>
	<div id="r_merchant_param3" class="form-group">
		<label id="elh_pg_transactions_merchant_param3" for="x_merchant_param3" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->merchant_param3->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->merchant_param3->CellAttributes() ?>>
<span id="el_pg_transactions_merchant_param3">
<textarea data-table="pg_transactions" data-field="x_merchant_param3" data-page="4" name="x_merchant_param3" id="x_merchant_param3" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($pg_transactions->merchant_param3->getPlaceHolder()) ?>"<?php echo $pg_transactions->merchant_param3->EditAttributes() ?>><?php echo $pg_transactions->merchant_param3->EditValue ?></textarea>
</span>
<?php echo $pg_transactions->merchant_param3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->merchant_param4->Visible) { // merchant_param4 ?>
	<div id="r_merchant_param4" class="form-group">
		<label id="elh_pg_transactions_merchant_param4" for="x_merchant_param4" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->merchant_param4->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->merchant_param4->CellAttributes() ?>>
<span id="el_pg_transactions_merchant_param4">
<textarea data-table="pg_transactions" data-field="x_merchant_param4" data-page="4" name="x_merchant_param4" id="x_merchant_param4" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($pg_transactions->merchant_param4->getPlaceHolder()) ?>"<?php echo $pg_transactions->merchant_param4->EditAttributes() ?>><?php echo $pg_transactions->merchant_param4->EditValue ?></textarea>
</span>
<?php echo $pg_transactions->merchant_param4->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->merchant_param5->Visible) { // merchant_param5 ?>
	<div id="r_merchant_param5" class="form-group">
		<label id="elh_pg_transactions_merchant_param5" for="x_merchant_param5" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->merchant_param5->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->merchant_param5->CellAttributes() ?>>
<span id="el_pg_transactions_merchant_param5">
<textarea data-table="pg_transactions" data-field="x_merchant_param5" data-page="4" name="x_merchant_param5" id="x_merchant_param5" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($pg_transactions->merchant_param5->getPlaceHolder()) ?>"<?php echo $pg_transactions->merchant_param5->EditAttributes() ?>><?php echo $pg_transactions->merchant_param5->EditValue ?></textarea>
</span>
<?php echo $pg_transactions->merchant_param5->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pg_transactions->merchant_param6->Visible) { // merchant_param6 ?>
	<div id="r_merchant_param6" class="form-group">
		<label id="elh_pg_transactions_merchant_param6" for="x_merchant_param6" class="<?php echo $pg_transactions_add->LeftColumnClass ?>"><?php echo $pg_transactions->merchant_param6->FldCaption() ?></label>
		<div class="<?php echo $pg_transactions_add->RightColumnClass ?>"><div<?php echo $pg_transactions->merchant_param6->CellAttributes() ?>>
<span id="el_pg_transactions_merchant_param6">
<input type="text" data-table="pg_transactions" data-field="x_merchant_param6" data-page="4" name="x_merchant_param6" id="x_merchant_param6" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pg_transactions->merchant_param6->getPlaceHolder()) ?>" value="<?php echo $pg_transactions->merchant_param6->EditValue ?>"<?php echo $pg_transactions->merchant_param6->EditAttributes() ?>>
</span>
<?php echo $pg_transactions->merchant_param6->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page .nav-tabs-custom .tab-content -->
</div><!-- /multi-page .nav-tabs-custom -->
</div><!-- /multi-page -->
<?php if (!$pg_transactions_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $pg_transactions_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $pg_transactions_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fpg_transactionsadd.Init();
</script>
<?php
$pg_transactions_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$pg_transactions_add->Page_Terminate();
?>
