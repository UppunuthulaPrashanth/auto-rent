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

$pg_transactions_view = NULL; // Initialize page object first

class cpg_transactions_view extends cpg_transactions {

	// Page ID
	var $PageID = 'view';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'pg_transactions';

	// Page object name
	var $PageObjName = 'pg_transactions_view';

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

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Custom export
	var $ExportExcelCustom = FALSE;
	var $ExportWordCustom = FALSE;
	var $ExportPdfCustom = FALSE;
	var $ExportEmailCustom = FALSE;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

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
		$KeyUrl = "";
		if (@$_GET["transactionID"] <> "") {
			$this->RecKey["transactionID"] = $_GET["transactionID"];
			$KeyUrl .= "&amp;transactionID=" . urlencode($this->RecKey["transactionID"]);
		}
		$this->ExportPrintUrl = $this->PageUrl() . "export=print" . $KeyUrl;
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html" . $KeyUrl;
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel" . $KeyUrl;
		$this->ExportWordUrl = $this->PageUrl() . "export=word" . $KeyUrl;
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml" . $KeyUrl;
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv" . $KeyUrl;
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf" . $KeyUrl;

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ewExportOption";

		// Other options
		$this->OtherOptions['action'] = new cListOptions();
		$this->OtherOptions['action']->Tag = "div";
		$this->OtherOptions['action']->TagClassName = "ewActionOption";
		$this->OtherOptions['detail'] = new cListOptions();
		$this->OtherOptions['detail']->Tag = "div";
		$this->OtherOptions['detail']->TagClassName = "ewDetailOption";
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
		if (!$Security->CanView()) {
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
		// Get export parameters

		$custom = "";
		if (@$_GET["export"] <> "") {
			$this->Export = $_GET["export"];
			$custom = @$_GET["custom"];
		} elseif (@$_POST["export"] <> "") {
			$this->Export = $_POST["export"];
			$custom = @$_POST["custom"];
		} elseif (ew_IsPost()) {
			if (@$_POST["exporttype"] <> "")
				$this->Export = $_POST["exporttype"];
			$custom = @$_POST["custom"];
		} elseif (@$_GET["cmd"] == "json") {
			$this->Export = $_GET["cmd"];
		} else {
			$this->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExportFile = $this->TableVar; // Get export file, used in header
		if (@$_GET["transactionID"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= $_GET["transactionID"];
		}

		// Get custom export parameters
		if ($this->Export <> "" && $custom <> "") {
			$this->CustomExport = $this->Export;
			$this->Export = "print";
		}
		$gsCustomExport = $this->CustomExport;
		$gsExport = $this->Export; // Get export parameter, used in header

		// Update Export URLs
		if (defined("EW_USE_PHPEXCEL"))
			$this->ExportExcelCustom = FALSE;
		if ($this->ExportExcelCustom)
			$this->ExportExcelUrl .= "&amp;custom=1";
		if (defined("EW_USE_PHPWORD"))
			$this->ExportWordCustom = FALSE;
		if ($this->ExportWordCustom)
			$this->ExportWordUrl .= "&amp;custom=1";
		if ($this->ExportPdfCustom)
			$this->ExportPdfUrl .= "&amp;custom=1";
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action

		// Setup export options
		$this->SetupExportOptions();
		$this->transactionID->SetVisibility();
		$this->transactionID->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
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
	var $ExportOptions; // Export options
	var $OtherOptions = array(); // Other options
	var $DisplayRecs = 1;
	var $DbMasterFilter;
	var $DbDetailFilter;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $RecCnt;
	var $RecKey = array();
	var $IsModal = FALSE;
	var $Recordset;
	var $MultiPages; // Multi pages object

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $gbSkipHeaderFooter, $EW_EXPORT;

		// Check modal
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["transactionID"] <> "") {
				$this->transactionID->setQueryStringValue($_GET["transactionID"]);
				$this->RecKey["transactionID"] = $this->transactionID->QueryStringValue;
			} elseif (@$_POST["transactionID"] <> "") {
				$this->transactionID->setFormValue($_POST["transactionID"]);
				$this->RecKey["transactionID"] = $this->transactionID->FormValue;
			} else {
				$sReturnUrl = "pg_transactionslist.php"; // Return to list
			}

			// Get action
			$this->CurrentAction = "I"; // Display form
			switch ($this->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "pg_transactionslist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if ($this->CustomExport == "" && in_array($this->Export, array_keys($EW_EXPORT))) {
				$this->ExportData();
				$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "pg_transactionslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Set up Breadcrumb
		if ($this->Export == "")
			$this->SetupBreadcrumb();

		// Render row
		$this->RowType = EW_ROWTYPE_VIEW;
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = &$options["action"];

		// Set up action default
		$option = &$options["action"];
		$option->DropDownButtonPhrase = $Language->Phrase("ButtonActions");
		$option->UseImageAndText = TRUE;
		$option->UseDropDownButton = FALSE;
		$option->UseButtonGroup = TRUE;
		$item = &$option->Add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Set up starting record parameters
	function SetupStartRec() {
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$this->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
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
		$this->AddUrl = $this->GetAddUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();
		$this->ListUrl = $this->GetListUrl();
		$this->SetupOtherOptions();

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
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language;

		// Printer friendly
		$item = &$this->ExportOptions->Add("print");
		$item->Body = "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ewExportLink ewPrint\" title=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendlyText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendlyText")) . "\">" . $Language->Phrase("PrinterFriendly") . "</a>";
		$item->Visible = TRUE;

		// Export to Excel
		$item = &$this->ExportOptions->Add("excel");
		$item->Body = "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ewExportLink ewExcel\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcelText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcelText")) . "\">" . $Language->Phrase("ExportToExcel") . "</a>";
		$item->Visible = TRUE;

		// Export to Word
		$item = &$this->ExportOptions->Add("word");
		$item->Body = "<a href=\"" . $this->ExportWordUrl . "\" class=\"ewExportLink ewWord\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToWordText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToWordText")) . "\">" . $Language->Phrase("ExportToWord") . "</a>";
		$item->Visible = TRUE;

		// Export to Html
		$item = &$this->ExportOptions->Add("html");
		$item->Body = "<a href=\"" . $this->ExportHtmlUrl . "\" class=\"ewExportLink ewHtml\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtmlText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtmlText")) . "\">" . $Language->Phrase("ExportToHtml") . "</a>";
		$item->Visible = TRUE;

		// Export to Xml
		$item = &$this->ExportOptions->Add("xml");
		$item->Body = "<a href=\"" . $this->ExportXmlUrl . "\" class=\"ewExportLink ewXml\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToXmlText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToXmlText")) . "\">" . $Language->Phrase("ExportToXml") . "</a>";
		$item->Visible = FALSE;

		// Export to Csv
		$item = &$this->ExportOptions->Add("csv");
		$item->Body = "<a href=\"" . $this->ExportCsvUrl . "\" class=\"ewExportLink ewCsv\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsvText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsvText")) . "\">" . $Language->Phrase("ExportToCsv") . "</a>";
		$item->Visible = TRUE;

		// Export to Pdf
		$item = &$this->ExportOptions->Add("pdf");
		$item->Body = "<a href=\"" . $this->ExportPdfUrl . "\" class=\"ewExportLink ewPdf\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToPDFText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToPDFText")) . "\">" . $Language->Phrase("ExportToPDF") . "</a>";
		$item->Visible = TRUE;

		// Export to Email
		$item = &$this->ExportOptions->Add("email");
		$url = "";
		$item->Body = "<button id=\"emf_pg_transactions\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_pg_transactions',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.fpg_transactionsview,key:" . ew_ArrayToJsonAttr($this->RecKey) . ",sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
		$item->Visible = TRUE;

		// Drop down button for export
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseImageAndText = TRUE;
		$this->ExportOptions->UseDropDownButton = TRUE;
		if ($this->ExportOptions->UseButtonGroup && ew_IsMobile())
			$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->DropDownButtonPhrase = $Language->Phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->Add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide options for export
		if ($this->Export <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $this->ListRecordCount();
		} else {
			if (!$this->Recordset)
				$this->Recordset = $this->LoadRecordset();
			$rs = &$this->Recordset;
			if ($rs)
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;
		$this->SetupStartRec(); // Set up start record position

		// Set the last record to display
		if ($this->DisplayRecs <= 0) {
			$this->StopRec = $this->TotalRecs;
		} else {
			$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
		}
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		$this->ExportDoc = ew_ExportDocument($this, "v");
		$Doc = &$this->ExportDoc;
		if ($bSelectLimit) {
			$this->StartRec = 1;
			$this->StopRec = $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs;
		} else {

			//$this->StartRec = $this->StartRec;
			//$this->StopRec = $this->StopRec;

		}

		// Call Page Exporting server event
		$this->ExportDoc->ExportCustom = !$this->Page_Exporting();
		$ParentTable = "";
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		$Doc->Text .= $sHeader;
		$this->ExportDocument($Doc, $rs, $this->StartRec, $this->StopRec, "view");
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		$Doc->Text .= $sFooter;

		// Close recordset
		$rs->Close();

		// Call Page Exported server event
		$this->Page_Exported();

		// Export header and footer
		$Doc->ExportHeaderAndFooter();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED && $this->Export <> "pdf")
			echo ew_DebugMsg();

		// Output data
		if ($this->Export == "email") {
			echo $this->ExportEmail($Doc->Text);
		} else {
			$Doc->Export();
		}
	}

	// Export email
	function ExportEmail($EmailContent) {
		global $gTmpImages, $Language;
		$sSender = @$_POST["sender"];
		$sRecipient = @$_POST["recipient"];
		$sCc = @$_POST["cc"];
		$sBcc = @$_POST["bcc"];

		// Subject
		$sSubject = @$_POST["subject"];
		$sEmailSubject = $sSubject;

		// Message
		$sContent = @$_POST["message"];
		$sEmailMessage = $sContent;

		// Check sender
		if ($sSender == "") {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterSenderEmail") . "</p>";
		}
		if (!ew_CheckEmail($sSender)) {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterProperSenderEmail") . "</p>";
		}

		// Check recipient
		if (!ew_CheckEmailList($sRecipient, EW_MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterProperRecipientEmail") . "</p>";
		}

		// Check cc
		if (!ew_CheckEmailList($sCc, EW_MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterProperCcEmail") . "</p>";
		}

		// Check bcc
		if (!ew_CheckEmailList($sBcc, EW_MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterProperBccEmail") . "</p>";
		}

		// Check email sent count
		if (!isset($_SESSION[EW_EXPORT_EMAIL_COUNTER]))
			$_SESSION[EW_EXPORT_EMAIL_COUNTER] = 0;
		if (intval($_SESSION[EW_EXPORT_EMAIL_COUNTER]) > EW_MAX_EMAIL_SENT_COUNT) {
			return "<p class=\"text-danger\">" . $Language->Phrase("ExceedMaxEmailExport") . "</p>";
		}

		// Send email
		$Email = new cEmail();
		$Email->Sender = $sSender; // Sender
		$Email->Recipient = $sRecipient; // Recipient
		$Email->Cc = $sCc; // Cc
		$Email->Bcc = $sBcc; // Bcc
		$Email->Subject = $sEmailSubject; // Subject
		$Email->Format = "html";
		if ($sEmailMessage <> "")
			$sEmailMessage = ew_RemoveXSS($sEmailMessage) . "<br><br>";
		foreach ($gTmpImages as $tmpimage)
			$Email->AddEmbeddedImage($tmpimage);
		$Email->Content = $sEmailMessage . ew_CleanEmailContent($EmailContent); // Content
		$EventArgs = array();
		if ($this->Recordset) {
			$this->RecCnt = $this->StartRec - 1;
			$this->Recordset->MoveFirst();
			if ($this->StartRec > 1)
				$this->Recordset->Move($this->StartRec - 1);
			$EventArgs["rs"] = &$this->Recordset;
		}
		$bEmailSent = FALSE;
		if ($this->Email_Sending($Email, $EventArgs))
			$bEmailSent = $Email->Send();

		// Check email sent status
		if ($bEmailSent) {

			// Update email sent count
			$_SESSION[EW_EXPORT_EMAIL_COUNTER]++;

			// Sent email success
			return "<p class=\"text-success\">" . $Language->Phrase("SendEmailSuccess") . "</p>"; // Set up success message
		} else {

			// Sent email failure
			return "<p class=\"text-danger\">" . $Email->SendErrDescription . "</p>";
		}
	}

	// Export QueryString
	function ExportQueryString() {

		// Initialize
		$sQry = "export=html";

		// Add record key QueryString
		$sQry .= "&" . substr($this->KeyUrl("", ""), 1);
		return $sQry;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("pg_transactionslist.php"), "", $this->TableVar, TRUE);
		$PageId = "view";
		$Breadcrumb->Add("view", $PageId, $url);
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

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($pg_transactions_view)) $pg_transactions_view = new cpg_transactions_view();

// Page init
$pg_transactions_view->Page_Init();

// Page main
$pg_transactions_view->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pg_transactions_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($pg_transactions->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "view";
var CurrentForm = fpg_transactionsview = new ew_Form("fpg_transactionsview", "view");

// Form_CustomValidate event
fpg_transactionsview.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fpg_transactionsview.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Multi-Page
fpg_transactionsview.MultiPage = new ew_MultiPage("fpg_transactionsview");

// Dynamic selection lists
fpg_transactionsview.Lists["x__userID"] = {"LinkField":"x__userID","Ajax":true,"AutoFill":false,"DisplayFields":["x_firstName","x_lastName","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"users"};
fpg_transactionsview.Lists["x__userID"].Data = "<?php echo $pg_transactions_view->_userID->LookupFilterQuery(FALSE, "view") ?>";
fpg_transactionsview.Lists["x_bookingModule"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fpg_transactionsview.Lists["x_bookingModule"].Options = <?php echo json_encode($pg_transactions_view->bookingModule->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($pg_transactions->Export == "") { ?>
<div class="ewToolbar">
<?php $pg_transactions_view->ExportOptions->Render("body") ?>
<?php
	foreach ($pg_transactions_view->OtherOptions as &$option)
		$option->Render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $pg_transactions_view->ShowPageHeader(); ?>
<?php
$pg_transactions_view->ShowMessage();
?>
<form name="fpg_transactionsview" id="fpg_transactionsview" class="form-inline ewForm ewViewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($pg_transactions_view->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $pg_transactions_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pg_transactions">
<input type="hidden" name="modal" value="<?php echo intval($pg_transactions_view->IsModal) ?>">
<?php if ($pg_transactions->Export == "") { ?>
<div class="ewMultiPage">
<div class="nav-tabs-custom" id="pg_transactions_view">
	<ul class="nav<?php echo $pg_transactions_view->MultiPages->NavStyle() ?>">
		<li<?php echo $pg_transactions_view->MultiPages->TabStyle("1") ?>><a href="#tab_pg_transactions1" data-toggle="tab"><?php echo $pg_transactions->PageCaption(1) ?></a></li>
		<li<?php echo $pg_transactions_view->MultiPages->TabStyle("2") ?>><a href="#tab_pg_transactions2" data-toggle="tab"><?php echo $pg_transactions->PageCaption(2) ?></a></li>
		<li<?php echo $pg_transactions_view->MultiPages->TabStyle("3") ?>><a href="#tab_pg_transactions3" data-toggle="tab"><?php echo $pg_transactions->PageCaption(3) ?></a></li>
		<li<?php echo $pg_transactions_view->MultiPages->TabStyle("4") ?>><a href="#tab_pg_transactions4" data-toggle="tab"><?php echo $pg_transactions->PageCaption(4) ?></a></li>
	</ul>
	<div class="tab-content">
<?php } ?>
<?php if ($pg_transactions->Export == "") { ?>
		<div class="tab-pane<?php echo $pg_transactions_view->MultiPages->PageStyle("1") ?>" id="tab_pg_transactions1">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($pg_transactions->transactionID->Visible) { // transactionID ?>
	<tr id="r_transactionID">
		<td class="col-sm-2"><span id="elh_pg_transactions_transactionID"><?php echo $pg_transactions->transactionID->FldCaption() ?></span></td>
		<td data-name="transactionID"<?php echo $pg_transactions->transactionID->CellAttributes() ?>>
<span id="el_pg_transactions_transactionID" data-page="1">
<span<?php echo $pg_transactions->transactionID->ViewAttributes() ?>>
<?php echo $pg_transactions->transactionID->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->_userID->Visible) { // userID ?>
	<tr id="r__userID">
		<td class="col-sm-2"><span id="elh_pg_transactions__userID"><?php echo $pg_transactions->_userID->FldCaption() ?></span></td>
		<td data-name="_userID"<?php echo $pg_transactions->_userID->CellAttributes() ?>>
<span id="el_pg_transactions__userID" data-page="1">
<span<?php echo $pg_transactions->_userID->ViewAttributes() ?>>
<?php echo $pg_transactions->_userID->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->bookingNumber->Visible) { // bookingNumber ?>
	<tr id="r_bookingNumber">
		<td class="col-sm-2"><span id="elh_pg_transactions_bookingNumber"><?php echo $pg_transactions->bookingNumber->FldCaption() ?></span></td>
		<td data-name="bookingNumber"<?php echo $pg_transactions->bookingNumber->CellAttributes() ?>>
<span id="el_pg_transactions_bookingNumber" data-page="1">
<span<?php echo $pg_transactions->bookingNumber->ViewAttributes() ?>>
<?php echo $pg_transactions->bookingNumber->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->bookingModule->Visible) { // bookingModule ?>
	<tr id="r_bookingModule">
		<td class="col-sm-2"><span id="elh_pg_transactions_bookingModule"><?php echo $pg_transactions->bookingModule->FldCaption() ?></span></td>
		<td data-name="bookingModule"<?php echo $pg_transactions->bookingModule->CellAttributes() ?>>
<span id="el_pg_transactions_bookingModule" data-page="1">
<span<?php echo $pg_transactions->bookingModule->ViewAttributes() ?>>
<?php echo $pg_transactions->bookingModule->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->order_id->Visible) { // order_id ?>
	<tr id="r_order_id">
		<td class="col-sm-2"><span id="elh_pg_transactions_order_id"><?php echo $pg_transactions->order_id->FldCaption() ?></span></td>
		<td data-name="order_id"<?php echo $pg_transactions->order_id->CellAttributes() ?>>
<span id="el_pg_transactions_order_id" data-page="1">
<span<?php echo $pg_transactions->order_id->ViewAttributes() ?>>
<?php echo $pg_transactions->order_id->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->tracking_id->Visible) { // tracking_id ?>
	<tr id="r_tracking_id">
		<td class="col-sm-2"><span id="elh_pg_transactions_tracking_id"><?php echo $pg_transactions->tracking_id->FldCaption() ?></span></td>
		<td data-name="tracking_id"<?php echo $pg_transactions->tracking_id->CellAttributes() ?>>
<span id="el_pg_transactions_tracking_id" data-page="1">
<span<?php echo $pg_transactions->tracking_id->ViewAttributes() ?>>
<?php echo $pg_transactions->tracking_id->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->bank_ref_no->Visible) { // bank_ref_no ?>
	<tr id="r_bank_ref_no">
		<td class="col-sm-2"><span id="elh_pg_transactions_bank_ref_no"><?php echo $pg_transactions->bank_ref_no->FldCaption() ?></span></td>
		<td data-name="bank_ref_no"<?php echo $pg_transactions->bank_ref_no->CellAttributes() ?>>
<span id="el_pg_transactions_bank_ref_no" data-page="1">
<span<?php echo $pg_transactions->bank_ref_no->ViewAttributes() ?>>
<?php echo $pg_transactions->bank_ref_no->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->order_status->Visible) { // order_status ?>
	<tr id="r_order_status">
		<td class="col-sm-2"><span id="elh_pg_transactions_order_status"><?php echo $pg_transactions->order_status->FldCaption() ?></span></td>
		<td data-name="order_status"<?php echo $pg_transactions->order_status->CellAttributes() ?>>
<span id="el_pg_transactions_order_status" data-page="1">
<span<?php echo $pg_transactions->order_status->ViewAttributes() ?>>
<?php echo $pg_transactions->order_status->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->failure_message->Visible) { // failure_message ?>
	<tr id="r_failure_message">
		<td class="col-sm-2"><span id="elh_pg_transactions_failure_message"><?php echo $pg_transactions->failure_message->FldCaption() ?></span></td>
		<td data-name="failure_message"<?php echo $pg_transactions->failure_message->CellAttributes() ?>>
<span id="el_pg_transactions_failure_message" data-page="1">
<span<?php echo $pg_transactions->failure_message->ViewAttributes() ?>>
<?php echo $pg_transactions->failure_message->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->payment_mode->Visible) { // payment_mode ?>
	<tr id="r_payment_mode">
		<td class="col-sm-2"><span id="elh_pg_transactions_payment_mode"><?php echo $pg_transactions->payment_mode->FldCaption() ?></span></td>
		<td data-name="payment_mode"<?php echo $pg_transactions->payment_mode->CellAttributes() ?>>
<span id="el_pg_transactions_payment_mode" data-page="1">
<span<?php echo $pg_transactions->payment_mode->ViewAttributes() ?>>
<?php echo $pg_transactions->payment_mode->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->card_name->Visible) { // card_name ?>
	<tr id="r_card_name">
		<td class="col-sm-2"><span id="elh_pg_transactions_card_name"><?php echo $pg_transactions->card_name->FldCaption() ?></span></td>
		<td data-name="card_name"<?php echo $pg_transactions->card_name->CellAttributes() ?>>
<span id="el_pg_transactions_card_name" data-page="1">
<span<?php echo $pg_transactions->card_name->ViewAttributes() ?>>
<?php echo $pg_transactions->card_name->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->status_code->Visible) { // status_code ?>
	<tr id="r_status_code">
		<td class="col-sm-2"><span id="elh_pg_transactions_status_code"><?php echo $pg_transactions->status_code->FldCaption() ?></span></td>
		<td data-name="status_code"<?php echo $pg_transactions->status_code->CellAttributes() ?>>
<span id="el_pg_transactions_status_code" data-page="1">
<span<?php echo $pg_transactions->status_code->ViewAttributes() ?>>
<?php echo $pg_transactions->status_code->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->status_message->Visible) { // status_message ?>
	<tr id="r_status_message">
		<td class="col-sm-2"><span id="elh_pg_transactions_status_message"><?php echo $pg_transactions->status_message->FldCaption() ?></span></td>
		<td data-name="status_message"<?php echo $pg_transactions->status_message->CellAttributes() ?>>
<span id="el_pg_transactions_status_message" data-page="1">
<span<?php echo $pg_transactions->status_message->ViewAttributes() ?>>
<?php echo $pg_transactions->status_message->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->currency->Visible) { // currency ?>
	<tr id="r_currency">
		<td class="col-sm-2"><span id="elh_pg_transactions_currency"><?php echo $pg_transactions->currency->FldCaption() ?></span></td>
		<td data-name="currency"<?php echo $pg_transactions->currency->CellAttributes() ?>>
<span id="el_pg_transactions_currency" data-page="1">
<span<?php echo $pg_transactions->currency->ViewAttributes() ?>>
<?php echo $pg_transactions->currency->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->amount->Visible) { // amount ?>
	<tr id="r_amount">
		<td class="col-sm-2"><span id="elh_pg_transactions_amount"><?php echo $pg_transactions->amount->FldCaption() ?></span></td>
		<td data-name="amount"<?php echo $pg_transactions->amount->CellAttributes() ?>>
<span id="el_pg_transactions_amount" data-page="1">
<span<?php echo $pg_transactions->amount->ViewAttributes() ?>>
<?php echo $pg_transactions->amount->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->vault->Visible) { // vault ?>
	<tr id="r_vault">
		<td class="col-sm-2"><span id="elh_pg_transactions_vault"><?php echo $pg_transactions->vault->FldCaption() ?></span></td>
		<td data-name="vault"<?php echo $pg_transactions->vault->CellAttributes() ?>>
<span id="el_pg_transactions_vault" data-page="1">
<span<?php echo $pg_transactions->vault->ViewAttributes() ?>>
<?php echo $pg_transactions->vault->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->offer_type->Visible) { // offer_type ?>
	<tr id="r_offer_type">
		<td class="col-sm-2"><span id="elh_pg_transactions_offer_type"><?php echo $pg_transactions->offer_type->FldCaption() ?></span></td>
		<td data-name="offer_type"<?php echo $pg_transactions->offer_type->CellAttributes() ?>>
<span id="el_pg_transactions_offer_type" data-page="1">
<span<?php echo $pg_transactions->offer_type->ViewAttributes() ?>>
<?php echo $pg_transactions->offer_type->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->offer_code->Visible) { // offer_code ?>
	<tr id="r_offer_code">
		<td class="col-sm-2"><span id="elh_pg_transactions_offer_code"><?php echo $pg_transactions->offer_code->FldCaption() ?></span></td>
		<td data-name="offer_code"<?php echo $pg_transactions->offer_code->CellAttributes() ?>>
<span id="el_pg_transactions_offer_code" data-page="1">
<span<?php echo $pg_transactions->offer_code->ViewAttributes() ?>>
<?php echo $pg_transactions->offer_code->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->discount_value->Visible) { // discount_value ?>
	<tr id="r_discount_value">
		<td class="col-sm-2"><span id="elh_pg_transactions_discount_value"><?php echo $pg_transactions->discount_value->FldCaption() ?></span></td>
		<td data-name="discount_value"<?php echo $pg_transactions->discount_value->CellAttributes() ?>>
<span id="el_pg_transactions_discount_value" data-page="1">
<span<?php echo $pg_transactions->discount_value->ViewAttributes() ?>>
<?php echo $pg_transactions->discount_value->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->mer_amount->Visible) { // mer_amount ?>
	<tr id="r_mer_amount">
		<td class="col-sm-2"><span id="elh_pg_transactions_mer_amount"><?php echo $pg_transactions->mer_amount->FldCaption() ?></span></td>
		<td data-name="mer_amount"<?php echo $pg_transactions->mer_amount->CellAttributes() ?>>
<span id="el_pg_transactions_mer_amount" data-page="1">
<span<?php echo $pg_transactions->mer_amount->ViewAttributes() ?>>
<?php echo $pg_transactions->mer_amount->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->eci_value->Visible) { // eci_value ?>
	<tr id="r_eci_value">
		<td class="col-sm-2"><span id="elh_pg_transactions_eci_value"><?php echo $pg_transactions->eci_value->FldCaption() ?></span></td>
		<td data-name="eci_value"<?php echo $pg_transactions->eci_value->CellAttributes() ?>>
<span id="el_pg_transactions_eci_value" data-page="1">
<span<?php echo $pg_transactions->eci_value->ViewAttributes() ?>>
<?php echo $pg_transactions->eci_value->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->card_holder_name->Visible) { // card_holder_name ?>
	<tr id="r_card_holder_name">
		<td class="col-sm-2"><span id="elh_pg_transactions_card_holder_name"><?php echo $pg_transactions->card_holder_name->FldCaption() ?></span></td>
		<td data-name="card_holder_name"<?php echo $pg_transactions->card_holder_name->CellAttributes() ?>>
<span id="el_pg_transactions_card_holder_name" data-page="1">
<span<?php echo $pg_transactions->card_holder_name->ViewAttributes() ?>>
<?php echo $pg_transactions->card_holder_name->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->bank_qsi_no->Visible) { // bank_qsi_no ?>
	<tr id="r_bank_qsi_no">
		<td class="col-sm-2"><span id="elh_pg_transactions_bank_qsi_no"><?php echo $pg_transactions->bank_qsi_no->FldCaption() ?></span></td>
		<td data-name="bank_qsi_no"<?php echo $pg_transactions->bank_qsi_no->CellAttributes() ?>>
<span id="el_pg_transactions_bank_qsi_no" data-page="1">
<span<?php echo $pg_transactions->bank_qsi_no->ViewAttributes() ?>>
<?php echo $pg_transactions->bank_qsi_no->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->bank_receipt_no->Visible) { // bank_receipt_no ?>
	<tr id="r_bank_receipt_no">
		<td class="col-sm-2"><span id="elh_pg_transactions_bank_receipt_no"><?php echo $pg_transactions->bank_receipt_no->FldCaption() ?></span></td>
		<td data-name="bank_receipt_no"<?php echo $pg_transactions->bank_receipt_no->CellAttributes() ?>>
<span id="el_pg_transactions_bank_receipt_no" data-page="1">
<span<?php echo $pg_transactions->bank_receipt_no->ViewAttributes() ?>>
<?php echo $pg_transactions->bank_receipt_no->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($pg_transactions->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($pg_transactions->Export == "") { ?>
		<div class="tab-pane<?php echo $pg_transactions_view->MultiPages->PageStyle("2") ?>" id="tab_pg_transactions2">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($pg_transactions->billing_name->Visible) { // billing_name ?>
	<tr id="r_billing_name">
		<td class="col-sm-2"><span id="elh_pg_transactions_billing_name"><?php echo $pg_transactions->billing_name->FldCaption() ?></span></td>
		<td data-name="billing_name"<?php echo $pg_transactions->billing_name->CellAttributes() ?>>
<span id="el_pg_transactions_billing_name" data-page="2">
<span<?php echo $pg_transactions->billing_name->ViewAttributes() ?>>
<?php echo $pg_transactions->billing_name->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->billing_address->Visible) { // billing_address ?>
	<tr id="r_billing_address">
		<td class="col-sm-2"><span id="elh_pg_transactions_billing_address"><?php echo $pg_transactions->billing_address->FldCaption() ?></span></td>
		<td data-name="billing_address"<?php echo $pg_transactions->billing_address->CellAttributes() ?>>
<span id="el_pg_transactions_billing_address" data-page="2">
<span<?php echo $pg_transactions->billing_address->ViewAttributes() ?>>
<?php echo $pg_transactions->billing_address->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->billing_city->Visible) { // billing_city ?>
	<tr id="r_billing_city">
		<td class="col-sm-2"><span id="elh_pg_transactions_billing_city"><?php echo $pg_transactions->billing_city->FldCaption() ?></span></td>
		<td data-name="billing_city"<?php echo $pg_transactions->billing_city->CellAttributes() ?>>
<span id="el_pg_transactions_billing_city" data-page="2">
<span<?php echo $pg_transactions->billing_city->ViewAttributes() ?>>
<?php echo $pg_transactions->billing_city->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->billing_state->Visible) { // billing_state ?>
	<tr id="r_billing_state">
		<td class="col-sm-2"><span id="elh_pg_transactions_billing_state"><?php echo $pg_transactions->billing_state->FldCaption() ?></span></td>
		<td data-name="billing_state"<?php echo $pg_transactions->billing_state->CellAttributes() ?>>
<span id="el_pg_transactions_billing_state" data-page="2">
<span<?php echo $pg_transactions->billing_state->ViewAttributes() ?>>
<?php echo $pg_transactions->billing_state->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->billing_zip->Visible) { // billing_zip ?>
	<tr id="r_billing_zip">
		<td class="col-sm-2"><span id="elh_pg_transactions_billing_zip"><?php echo $pg_transactions->billing_zip->FldCaption() ?></span></td>
		<td data-name="billing_zip"<?php echo $pg_transactions->billing_zip->CellAttributes() ?>>
<span id="el_pg_transactions_billing_zip" data-page="2">
<span<?php echo $pg_transactions->billing_zip->ViewAttributes() ?>>
<?php echo $pg_transactions->billing_zip->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->billing_country->Visible) { // billing_country ?>
	<tr id="r_billing_country">
		<td class="col-sm-2"><span id="elh_pg_transactions_billing_country"><?php echo $pg_transactions->billing_country->FldCaption() ?></span></td>
		<td data-name="billing_country"<?php echo $pg_transactions->billing_country->CellAttributes() ?>>
<span id="el_pg_transactions_billing_country" data-page="2">
<span<?php echo $pg_transactions->billing_country->ViewAttributes() ?>>
<?php echo $pg_transactions->billing_country->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->billing_tel->Visible) { // billing_tel ?>
	<tr id="r_billing_tel">
		<td class="col-sm-2"><span id="elh_pg_transactions_billing_tel"><?php echo $pg_transactions->billing_tel->FldCaption() ?></span></td>
		<td data-name="billing_tel"<?php echo $pg_transactions->billing_tel->CellAttributes() ?>>
<span id="el_pg_transactions_billing_tel" data-page="2">
<span<?php echo $pg_transactions->billing_tel->ViewAttributes() ?>>
<?php echo $pg_transactions->billing_tel->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->billing_email->Visible) { // billing_email ?>
	<tr id="r_billing_email">
		<td class="col-sm-2"><span id="elh_pg_transactions_billing_email"><?php echo $pg_transactions->billing_email->FldCaption() ?></span></td>
		<td data-name="billing_email"<?php echo $pg_transactions->billing_email->CellAttributes() ?>>
<span id="el_pg_transactions_billing_email" data-page="2">
<span<?php echo $pg_transactions->billing_email->ViewAttributes() ?>>
<?php echo $pg_transactions->billing_email->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($pg_transactions->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($pg_transactions->Export == "") { ?>
		<div class="tab-pane<?php echo $pg_transactions_view->MultiPages->PageStyle("3") ?>" id="tab_pg_transactions3">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($pg_transactions->delivery_name->Visible) { // delivery_name ?>
	<tr id="r_delivery_name">
		<td class="col-sm-2"><span id="elh_pg_transactions_delivery_name"><?php echo $pg_transactions->delivery_name->FldCaption() ?></span></td>
		<td data-name="delivery_name"<?php echo $pg_transactions->delivery_name->CellAttributes() ?>>
<span id="el_pg_transactions_delivery_name" data-page="3">
<span<?php echo $pg_transactions->delivery_name->ViewAttributes() ?>>
<?php echo $pg_transactions->delivery_name->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->delivery_address->Visible) { // delivery_address ?>
	<tr id="r_delivery_address">
		<td class="col-sm-2"><span id="elh_pg_transactions_delivery_address"><?php echo $pg_transactions->delivery_address->FldCaption() ?></span></td>
		<td data-name="delivery_address"<?php echo $pg_transactions->delivery_address->CellAttributes() ?>>
<span id="el_pg_transactions_delivery_address" data-page="3">
<span<?php echo $pg_transactions->delivery_address->ViewAttributes() ?>>
<?php echo $pg_transactions->delivery_address->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->delivery_city->Visible) { // delivery_city ?>
	<tr id="r_delivery_city">
		<td class="col-sm-2"><span id="elh_pg_transactions_delivery_city"><?php echo $pg_transactions->delivery_city->FldCaption() ?></span></td>
		<td data-name="delivery_city"<?php echo $pg_transactions->delivery_city->CellAttributes() ?>>
<span id="el_pg_transactions_delivery_city" data-page="3">
<span<?php echo $pg_transactions->delivery_city->ViewAttributes() ?>>
<?php echo $pg_transactions->delivery_city->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->delivery_state->Visible) { // delivery_state ?>
	<tr id="r_delivery_state">
		<td class="col-sm-2"><span id="elh_pg_transactions_delivery_state"><?php echo $pg_transactions->delivery_state->FldCaption() ?></span></td>
		<td data-name="delivery_state"<?php echo $pg_transactions->delivery_state->CellAttributes() ?>>
<span id="el_pg_transactions_delivery_state" data-page="3">
<span<?php echo $pg_transactions->delivery_state->ViewAttributes() ?>>
<?php echo $pg_transactions->delivery_state->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->delivery_zip->Visible) { // delivery_zip ?>
	<tr id="r_delivery_zip">
		<td class="col-sm-2"><span id="elh_pg_transactions_delivery_zip"><?php echo $pg_transactions->delivery_zip->FldCaption() ?></span></td>
		<td data-name="delivery_zip"<?php echo $pg_transactions->delivery_zip->CellAttributes() ?>>
<span id="el_pg_transactions_delivery_zip" data-page="3">
<span<?php echo $pg_transactions->delivery_zip->ViewAttributes() ?>>
<?php echo $pg_transactions->delivery_zip->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->delivery_country->Visible) { // delivery_country ?>
	<tr id="r_delivery_country">
		<td class="col-sm-2"><span id="elh_pg_transactions_delivery_country"><?php echo $pg_transactions->delivery_country->FldCaption() ?></span></td>
		<td data-name="delivery_country"<?php echo $pg_transactions->delivery_country->CellAttributes() ?>>
<span id="el_pg_transactions_delivery_country" data-page="3">
<span<?php echo $pg_transactions->delivery_country->ViewAttributes() ?>>
<?php echo $pg_transactions->delivery_country->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->delivery_tel->Visible) { // delivery_tel ?>
	<tr id="r_delivery_tel">
		<td class="col-sm-2"><span id="elh_pg_transactions_delivery_tel"><?php echo $pg_transactions->delivery_tel->FldCaption() ?></span></td>
		<td data-name="delivery_tel"<?php echo $pg_transactions->delivery_tel->CellAttributes() ?>>
<span id="el_pg_transactions_delivery_tel" data-page="3">
<span<?php echo $pg_transactions->delivery_tel->ViewAttributes() ?>>
<?php echo $pg_transactions->delivery_tel->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($pg_transactions->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($pg_transactions->Export == "") { ?>
		<div class="tab-pane<?php echo $pg_transactions_view->MultiPages->PageStyle("4") ?>" id="tab_pg_transactions4">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($pg_transactions->merchant_param1->Visible) { // merchant_param1 ?>
	<tr id="r_merchant_param1">
		<td class="col-sm-2"><span id="elh_pg_transactions_merchant_param1"><?php echo $pg_transactions->merchant_param1->FldCaption() ?></span></td>
		<td data-name="merchant_param1"<?php echo $pg_transactions->merchant_param1->CellAttributes() ?>>
<span id="el_pg_transactions_merchant_param1" data-page="4">
<span<?php echo $pg_transactions->merchant_param1->ViewAttributes() ?>>
<?php echo $pg_transactions->merchant_param1->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->merchant_param2->Visible) { // merchant_param2 ?>
	<tr id="r_merchant_param2">
		<td class="col-sm-2"><span id="elh_pg_transactions_merchant_param2"><?php echo $pg_transactions->merchant_param2->FldCaption() ?></span></td>
		<td data-name="merchant_param2"<?php echo $pg_transactions->merchant_param2->CellAttributes() ?>>
<span id="el_pg_transactions_merchant_param2" data-page="4">
<span<?php echo $pg_transactions->merchant_param2->ViewAttributes() ?>>
<?php echo $pg_transactions->merchant_param2->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->merchant_param3->Visible) { // merchant_param3 ?>
	<tr id="r_merchant_param3">
		<td class="col-sm-2"><span id="elh_pg_transactions_merchant_param3"><?php echo $pg_transactions->merchant_param3->FldCaption() ?></span></td>
		<td data-name="merchant_param3"<?php echo $pg_transactions->merchant_param3->CellAttributes() ?>>
<span id="el_pg_transactions_merchant_param3" data-page="4">
<span<?php echo $pg_transactions->merchant_param3->ViewAttributes() ?>>
<?php echo $pg_transactions->merchant_param3->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->merchant_param4->Visible) { // merchant_param4 ?>
	<tr id="r_merchant_param4">
		<td class="col-sm-2"><span id="elh_pg_transactions_merchant_param4"><?php echo $pg_transactions->merchant_param4->FldCaption() ?></span></td>
		<td data-name="merchant_param4"<?php echo $pg_transactions->merchant_param4->CellAttributes() ?>>
<span id="el_pg_transactions_merchant_param4" data-page="4">
<span<?php echo $pg_transactions->merchant_param4->ViewAttributes() ?>>
<?php echo $pg_transactions->merchant_param4->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->merchant_param5->Visible) { // merchant_param5 ?>
	<tr id="r_merchant_param5">
		<td class="col-sm-2"><span id="elh_pg_transactions_merchant_param5"><?php echo $pg_transactions->merchant_param5->FldCaption() ?></span></td>
		<td data-name="merchant_param5"<?php echo $pg_transactions->merchant_param5->CellAttributes() ?>>
<span id="el_pg_transactions_merchant_param5" data-page="4">
<span<?php echo $pg_transactions->merchant_param5->ViewAttributes() ?>>
<?php echo $pg_transactions->merchant_param5->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pg_transactions->merchant_param6->Visible) { // merchant_param6 ?>
	<tr id="r_merchant_param6">
		<td class="col-sm-2"><span id="elh_pg_transactions_merchant_param6"><?php echo $pg_transactions->merchant_param6->FldCaption() ?></span></td>
		<td data-name="merchant_param6"<?php echo $pg_transactions->merchant_param6->CellAttributes() ?>>
<span id="el_pg_transactions_merchant_param6" data-page="4">
<span<?php echo $pg_transactions->merchant_param6->ViewAttributes() ?>>
<?php echo $pg_transactions->merchant_param6->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($pg_transactions->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($pg_transactions->Export == "") { ?>
	</div>
</div>
</div>
<?php } ?>
</form>
<?php if ($pg_transactions->Export == "") { ?>
<script type="text/javascript">
fpg_transactionsview.Init();
</script>
<?php } ?>
<?php
$pg_transactions_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($pg_transactions->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$pg_transactions_view->Page_Terminate();
?>
