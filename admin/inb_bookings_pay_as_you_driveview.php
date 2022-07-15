<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "inb_bookings_pay_as_you_driveinfo.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$inb_bookings_pay_as_you_drive_view = NULL; // Initialize page object first

class cinb_bookings_pay_as_you_drive_view extends cinb_bookings_pay_as_you_drive {

	// Page ID
	var $PageID = 'view';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'inb_bookings_pay_as_you_drive';

	// Page object name
	var $PageObjName = 'inb_bookings_pay_as_you_drive_view';

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

		// Table object (inb_bookings_pay_as_you_drive)
		if (!isset($GLOBALS["inb_bookings_pay_as_you_drive"]) || get_class($GLOBALS["inb_bookings_pay_as_you_drive"]) == "cinb_bookings_pay_as_you_drive") {
			$GLOBALS["inb_bookings_pay_as_you_drive"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["inb_bookings_pay_as_you_drive"];
		}
		$KeyUrl = "";
		if (@$_GET["bookingID"] <> "") {
			$this->RecKey["bookingID"] = $_GET["bookingID"];
			$KeyUrl .= "&amp;bookingID=" . urlencode($this->RecKey["bookingID"]);
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
			define("EW_TABLE_NAME", 'inb_bookings_pay_as_you_drive', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("inb_bookings_pay_as_you_drivelist.php"));
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
		if (@$_GET["bookingID"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= $_GET["bookingID"];
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
		$this->bookingID->SetVisibility();
		$this->bookingID->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
		$this->bookingNumber->SetVisibility();
		$this->_userID->SetVisibility();
		$this->payDriveCarID->SetVisibility();
		$this->pickUpLocation->SetVisibility();
		$this->dropLocation->SetVisibility();
		$this->pickUpDate->SetVisibility();
		$this->dropDate->SetVisibility();
		$this->noOfDays->SetVisibility();
		$this->bookingTerm->SetVisibility();
		$this->slab->SetVisibility();
		$this->orangeCard->SetVisibility();
		$this->gps->SetVisibility();
		$this->deliveryCharge->SetVisibility();
		$this->collectionCharge->SetVisibility();
		$this->rentalAmount->SetVisibility();
		$this->totalAmount->SetVisibility();
		$this->vat->SetVisibility();
		$this->grandTotal->SetVisibility();
		$this->deliveryAddress->SetVisibility();
		$this->paymentMethod->SetVisibility();
		$this->dateCreated->SetVisibility();

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
		global $EW_EXPORT, $inb_bookings_pay_as_you_drive;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($inb_bookings_pay_as_you_drive);
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
					if ($pageName == "inb_bookings_pay_as_you_driveview.php")
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
			if (@$_GET["bookingID"] <> "") {
				$this->bookingID->setQueryStringValue($_GET["bookingID"]);
				$this->RecKey["bookingID"] = $this->bookingID->QueryStringValue;
			} elseif (@$_POST["bookingID"] <> "") {
				$this->bookingID->setFormValue($_POST["bookingID"]);
				$this->RecKey["bookingID"] = $this->bookingID->FormValue;
			} else {
				$sReturnUrl = "inb_bookings_pay_as_you_drivelist.php"; // Return to list
			}

			// Get action
			$this->CurrentAction = "I"; // Display form
			switch ($this->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "inb_bookings_pay_as_you_drivelist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if ($this->CustomExport == "" && in_array($this->Export, array_keys($EW_EXPORT))) {
				$this->ExportData();
				$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "inb_bookings_pay_as_you_drivelist.php"; // Not page request, return to list
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
		$this->bookingID->setDbValue($row['bookingID']);
		$this->bookingNumber->setDbValue($row['bookingNumber']);
		$this->_userID->setDbValue($row['userID']);
		$this->payDriveCarID->setDbValue($row['payDriveCarID']);
		$this->pickUpLocation->setDbValue($row['pickUpLocation']);
		$this->dropLocation->setDbValue($row['dropLocation']);
		$this->pickUpDate->setDbValue($row['pickUpDate']);
		$this->dropDate->setDbValue($row['dropDate']);
		$this->noOfDays->setDbValue($row['noOfDays']);
		$this->bookingTerm->setDbValue($row['bookingTerm']);
		$this->slab->setDbValue($row['slab']);
		$this->orangeCard->setDbValue($row['orangeCard']);
		$this->gps->setDbValue($row['gps']);
		$this->deliveryCharge->setDbValue($row['deliveryCharge']);
		$this->collectionCharge->setDbValue($row['collectionCharge']);
		$this->rentalAmount->setDbValue($row['rentalAmount']);
		$this->totalAmount->setDbValue($row['totalAmount']);
		$this->vat->setDbValue($row['vat']);
		$this->grandTotal->setDbValue($row['grandTotal']);
		$this->deliveryAddress->setDbValue($row['deliveryAddress']);
		$this->paymentMethod->setDbValue($row['paymentMethod']);
		$this->dateCreated->setDbValue($row['dateCreated']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['bookingID'] = NULL;
		$row['bookingNumber'] = NULL;
		$row['userID'] = NULL;
		$row['payDriveCarID'] = NULL;
		$row['pickUpLocation'] = NULL;
		$row['dropLocation'] = NULL;
		$row['pickUpDate'] = NULL;
		$row['dropDate'] = NULL;
		$row['noOfDays'] = NULL;
		$row['bookingTerm'] = NULL;
		$row['slab'] = NULL;
		$row['orangeCard'] = NULL;
		$row['gps'] = NULL;
		$row['deliveryCharge'] = NULL;
		$row['collectionCharge'] = NULL;
		$row['rentalAmount'] = NULL;
		$row['totalAmount'] = NULL;
		$row['vat'] = NULL;
		$row['grandTotal'] = NULL;
		$row['deliveryAddress'] = NULL;
		$row['paymentMethod'] = NULL;
		$row['dateCreated'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->bookingID->DbValue = $row['bookingID'];
		$this->bookingNumber->DbValue = $row['bookingNumber'];
		$this->_userID->DbValue = $row['userID'];
		$this->payDriveCarID->DbValue = $row['payDriveCarID'];
		$this->pickUpLocation->DbValue = $row['pickUpLocation'];
		$this->dropLocation->DbValue = $row['dropLocation'];
		$this->pickUpDate->DbValue = $row['pickUpDate'];
		$this->dropDate->DbValue = $row['dropDate'];
		$this->noOfDays->DbValue = $row['noOfDays'];
		$this->bookingTerm->DbValue = $row['bookingTerm'];
		$this->slab->DbValue = $row['slab'];
		$this->orangeCard->DbValue = $row['orangeCard'];
		$this->gps->DbValue = $row['gps'];
		$this->deliveryCharge->DbValue = $row['deliveryCharge'];
		$this->collectionCharge->DbValue = $row['collectionCharge'];
		$this->rentalAmount->DbValue = $row['rentalAmount'];
		$this->totalAmount->DbValue = $row['totalAmount'];
		$this->vat->DbValue = $row['vat'];
		$this->grandTotal->DbValue = $row['grandTotal'];
		$this->deliveryAddress->DbValue = $row['deliveryAddress'];
		$this->paymentMethod->DbValue = $row['paymentMethod'];
		$this->dateCreated->DbValue = $row['dateCreated'];
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

		// Convert decimal values if posted back
		if ($this->orangeCard->FormValue == $this->orangeCard->CurrentValue && is_numeric(ew_StrToFloat($this->orangeCard->CurrentValue)))
			$this->orangeCard->CurrentValue = ew_StrToFloat($this->orangeCard->CurrentValue);

		// Convert decimal values if posted back
		if ($this->deliveryCharge->FormValue == $this->deliveryCharge->CurrentValue && is_numeric(ew_StrToFloat($this->deliveryCharge->CurrentValue)))
			$this->deliveryCharge->CurrentValue = ew_StrToFloat($this->deliveryCharge->CurrentValue);

		// Convert decimal values if posted back
		if ($this->collectionCharge->FormValue == $this->collectionCharge->CurrentValue && is_numeric(ew_StrToFloat($this->collectionCharge->CurrentValue)))
			$this->collectionCharge->CurrentValue = ew_StrToFloat($this->collectionCharge->CurrentValue);

		// Convert decimal values if posted back
		if ($this->rentalAmount->FormValue == $this->rentalAmount->CurrentValue && is_numeric(ew_StrToFloat($this->rentalAmount->CurrentValue)))
			$this->rentalAmount->CurrentValue = ew_StrToFloat($this->rentalAmount->CurrentValue);

		// Convert decimal values if posted back
		if ($this->totalAmount->FormValue == $this->totalAmount->CurrentValue && is_numeric(ew_StrToFloat($this->totalAmount->CurrentValue)))
			$this->totalAmount->CurrentValue = ew_StrToFloat($this->totalAmount->CurrentValue);

		// Convert decimal values if posted back
		if ($this->vat->FormValue == $this->vat->CurrentValue && is_numeric(ew_StrToFloat($this->vat->CurrentValue)))
			$this->vat->CurrentValue = ew_StrToFloat($this->vat->CurrentValue);

		// Convert decimal values if posted back
		if ($this->grandTotal->FormValue == $this->grandTotal->CurrentValue && is_numeric(ew_StrToFloat($this->grandTotal->CurrentValue)))
			$this->grandTotal->CurrentValue = ew_StrToFloat($this->grandTotal->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
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

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

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
		$item->Body = "<button id=\"emf_inb_bookings_pay_as_you_drive\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_inb_bookings_pay_as_you_drive',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.finb_bookings_pay_as_you_driveview,key:" . ew_ArrayToJsonAttr($this->RecKey) . ",sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("inb_bookings_pay_as_you_drivelist.php"), "", $this->TableVar, TRUE);
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
if (!isset($inb_bookings_pay_as_you_drive_view)) $inb_bookings_pay_as_you_drive_view = new cinb_bookings_pay_as_you_drive_view();

// Page init
$inb_bookings_pay_as_you_drive_view->Page_Init();

// Page main
$inb_bookings_pay_as_you_drive_view->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inb_bookings_pay_as_you_drive_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($inb_bookings_pay_as_you_drive->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "view";
var CurrentForm = finb_bookings_pay_as_you_driveview = new ew_Form("finb_bookings_pay_as_you_driveview", "view");

// Form_CustomValidate event
finb_bookings_pay_as_you_driveview.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
finb_bookings_pay_as_you_driveview.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Multi-Page
finb_bookings_pay_as_you_driveview.MultiPage = new ew_MultiPage("finb_bookings_pay_as_you_driveview");

// Dynamic selection lists
finb_bookings_pay_as_you_driveview.Lists["x__userID"] = {"LinkField":"x__userID","Ajax":true,"AutoFill":false,"DisplayFields":["x_firstName","x_lastName","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"users"};
finb_bookings_pay_as_you_driveview.Lists["x__userID"].Data = "<?php echo $inb_bookings_pay_as_you_drive_view->_userID->LookupFilterQuery(FALSE, "view") ?>";
finb_bookings_pay_as_you_driveview.Lists["x_payDriveCarID"] = {"LinkField":"x_payDriveCarID","Ajax":true,"AutoFill":false,"DisplayFields":["x_carTitle","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"pay_as_you_drive"};
finb_bookings_pay_as_you_driveview.Lists["x_payDriveCarID"].Data = "<?php echo $inb_bookings_pay_as_you_drive_view->payDriveCarID->LookupFilterQuery(FALSE, "view") ?>";
finb_bookings_pay_as_you_driveview.Lists["x_pickUpLocation"] = {"LinkField":"x_pdLocationID","Ajax":true,"AutoFill":false,"DisplayFields":["x_location","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"pickup_drop_locations"};
finb_bookings_pay_as_you_driveview.Lists["x_pickUpLocation"].Data = "<?php echo $inb_bookings_pay_as_you_drive_view->pickUpLocation->LookupFilterQuery(FALSE, "view") ?>";
finb_bookings_pay_as_you_driveview.Lists["x_dropLocation"] = {"LinkField":"x_pdLocationID","Ajax":true,"AutoFill":false,"DisplayFields":["x_location","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"pickup_drop_locations"};
finb_bookings_pay_as_you_driveview.Lists["x_dropLocation"].Data = "<?php echo $inb_bookings_pay_as_you_drive_view->dropLocation->LookupFilterQuery(FALSE, "view") ?>";
finb_bookings_pay_as_you_driveview.Lists["x_paymentMethod"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
finb_bookings_pay_as_you_driveview.Lists["x_paymentMethod"].Options = <?php echo json_encode($inb_bookings_pay_as_you_drive_view->paymentMethod->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->Export == "") { ?>
<div class="ewToolbar">
<?php $inb_bookings_pay_as_you_drive_view->ExportOptions->Render("body") ?>
<?php
	foreach ($inb_bookings_pay_as_you_drive_view->OtherOptions as &$option)
		$option->Render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $inb_bookings_pay_as_you_drive_view->ShowPageHeader(); ?>
<?php
$inb_bookings_pay_as_you_drive_view->ShowMessage();
?>
<form name="finb_bookings_pay_as_you_driveview" id="finb_bookings_pay_as_you_driveview" class="form-inline ewForm ewViewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($inb_bookings_pay_as_you_drive_view->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $inb_bookings_pay_as_you_drive_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inb_bookings_pay_as_you_drive">
<input type="hidden" name="modal" value="<?php echo intval($inb_bookings_pay_as_you_drive_view->IsModal) ?>">
<?php if ($inb_bookings_pay_as_you_drive->Export == "") { ?>
<div class="ewMultiPage">
<div class="nav-tabs-custom" id="inb_bookings_pay_as_you_drive_view">
	<ul class="nav<?php echo $inb_bookings_pay_as_you_drive_view->MultiPages->NavStyle() ?>">
		<li<?php echo $inb_bookings_pay_as_you_drive_view->MultiPages->TabStyle("1") ?>><a href="#tab_inb_bookings_pay_as_you_drive1" data-toggle="tab"><?php echo $inb_bookings_pay_as_you_drive->PageCaption(1) ?></a></li>
		<li<?php echo $inb_bookings_pay_as_you_drive_view->MultiPages->TabStyle("2") ?>><a href="#tab_inb_bookings_pay_as_you_drive2" data-toggle="tab"><?php echo $inb_bookings_pay_as_you_drive->PageCaption(2) ?></a></li>
	</ul>
	<div class="tab-content">
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->Export == "") { ?>
		<div class="tab-pane<?php echo $inb_bookings_pay_as_you_drive_view->MultiPages->PageStyle("1") ?>" id="tab_inb_bookings_pay_as_you_drive1">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($inb_bookings_pay_as_you_drive->bookingID->Visible) { // bookingID ?>
	<tr id="r_bookingID">
		<td class="col-sm-2"><span id="elh_inb_bookings_pay_as_you_drive_bookingID"><?php echo $inb_bookings_pay_as_you_drive->bookingID->FldCaption() ?></span></td>
		<td data-name="bookingID"<?php echo $inb_bookings_pay_as_you_drive->bookingID->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_bookingID" data-page="1">
<span<?php echo $inb_bookings_pay_as_you_drive->bookingID->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->bookingID->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->bookingNumber->Visible) { // bookingNumber ?>
	<tr id="r_bookingNumber">
		<td class="col-sm-2"><span id="elh_inb_bookings_pay_as_you_drive_bookingNumber"><?php echo $inb_bookings_pay_as_you_drive->bookingNumber->FldCaption() ?></span></td>
		<td data-name="bookingNumber"<?php echo $inb_bookings_pay_as_you_drive->bookingNumber->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_bookingNumber" data-page="1">
<span<?php echo $inb_bookings_pay_as_you_drive->bookingNumber->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->bookingNumber->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->_userID->Visible) { // userID ?>
	<tr id="r__userID">
		<td class="col-sm-2"><span id="elh_inb_bookings_pay_as_you_drive__userID"><?php echo $inb_bookings_pay_as_you_drive->_userID->FldCaption() ?></span></td>
		<td data-name="_userID"<?php echo $inb_bookings_pay_as_you_drive->_userID->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive__userID" data-page="1">
<span<?php echo $inb_bookings_pay_as_you_drive->_userID->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->_userID->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->payDriveCarID->Visible) { // payDriveCarID ?>
	<tr id="r_payDriveCarID">
		<td class="col-sm-2"><span id="elh_inb_bookings_pay_as_you_drive_payDriveCarID"><?php echo $inb_bookings_pay_as_you_drive->payDriveCarID->FldCaption() ?></span></td>
		<td data-name="payDriveCarID"<?php echo $inb_bookings_pay_as_you_drive->payDriveCarID->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_payDriveCarID" data-page="1">
<span<?php echo $inb_bookings_pay_as_you_drive->payDriveCarID->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->payDriveCarID->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->pickUpLocation->Visible) { // pickUpLocation ?>
	<tr id="r_pickUpLocation">
		<td class="col-sm-2"><span id="elh_inb_bookings_pay_as_you_drive_pickUpLocation"><?php echo $inb_bookings_pay_as_you_drive->pickUpLocation->FldCaption() ?></span></td>
		<td data-name="pickUpLocation"<?php echo $inb_bookings_pay_as_you_drive->pickUpLocation->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_pickUpLocation" data-page="1">
<span<?php echo $inb_bookings_pay_as_you_drive->pickUpLocation->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->pickUpLocation->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->dropLocation->Visible) { // dropLocation ?>
	<tr id="r_dropLocation">
		<td class="col-sm-2"><span id="elh_inb_bookings_pay_as_you_drive_dropLocation"><?php echo $inb_bookings_pay_as_you_drive->dropLocation->FldCaption() ?></span></td>
		<td data-name="dropLocation"<?php echo $inb_bookings_pay_as_you_drive->dropLocation->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_dropLocation" data-page="1">
<span<?php echo $inb_bookings_pay_as_you_drive->dropLocation->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->dropLocation->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->pickUpDate->Visible) { // pickUpDate ?>
	<tr id="r_pickUpDate">
		<td class="col-sm-2"><span id="elh_inb_bookings_pay_as_you_drive_pickUpDate"><?php echo $inb_bookings_pay_as_you_drive->pickUpDate->FldCaption() ?></span></td>
		<td data-name="pickUpDate"<?php echo $inb_bookings_pay_as_you_drive->pickUpDate->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_pickUpDate" data-page="1">
<span<?php echo $inb_bookings_pay_as_you_drive->pickUpDate->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->pickUpDate->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->dropDate->Visible) { // dropDate ?>
	<tr id="r_dropDate">
		<td class="col-sm-2"><span id="elh_inb_bookings_pay_as_you_drive_dropDate"><?php echo $inb_bookings_pay_as_you_drive->dropDate->FldCaption() ?></span></td>
		<td data-name="dropDate"<?php echo $inb_bookings_pay_as_you_drive->dropDate->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_dropDate" data-page="1">
<span<?php echo $inb_bookings_pay_as_you_drive->dropDate->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->dropDate->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->noOfDays->Visible) { // noOfDays ?>
	<tr id="r_noOfDays">
		<td class="col-sm-2"><span id="elh_inb_bookings_pay_as_you_drive_noOfDays"><?php echo $inb_bookings_pay_as_you_drive->noOfDays->FldCaption() ?></span></td>
		<td data-name="noOfDays"<?php echo $inb_bookings_pay_as_you_drive->noOfDays->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_noOfDays" data-page="1">
<span<?php echo $inb_bookings_pay_as_you_drive->noOfDays->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->noOfDays->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->bookingTerm->Visible) { // bookingTerm ?>
	<tr id="r_bookingTerm">
		<td class="col-sm-2"><span id="elh_inb_bookings_pay_as_you_drive_bookingTerm"><?php echo $inb_bookings_pay_as_you_drive->bookingTerm->FldCaption() ?></span></td>
		<td data-name="bookingTerm"<?php echo $inb_bookings_pay_as_you_drive->bookingTerm->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_bookingTerm" data-page="1">
<span<?php echo $inb_bookings_pay_as_you_drive->bookingTerm->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->bookingTerm->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->slab->Visible) { // slab ?>
	<tr id="r_slab">
		<td class="col-sm-2"><span id="elh_inb_bookings_pay_as_you_drive_slab"><?php echo $inb_bookings_pay_as_you_drive->slab->FldCaption() ?></span></td>
		<td data-name="slab"<?php echo $inb_bookings_pay_as_you_drive->slab->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_slab" data-page="1">
<span<?php echo $inb_bookings_pay_as_you_drive->slab->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->slab->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->rentalAmount->Visible) { // rentalAmount ?>
	<tr id="r_rentalAmount">
		<td class="col-sm-2"><span id="elh_inb_bookings_pay_as_you_drive_rentalAmount"><?php echo $inb_bookings_pay_as_you_drive->rentalAmount->FldCaption() ?></span></td>
		<td data-name="rentalAmount"<?php echo $inb_bookings_pay_as_you_drive->rentalAmount->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_rentalAmount" data-page="1">
<span<?php echo $inb_bookings_pay_as_you_drive->rentalAmount->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->rentalAmount->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->totalAmount->Visible) { // totalAmount ?>
	<tr id="r_totalAmount">
		<td class="col-sm-2"><span id="elh_inb_bookings_pay_as_you_drive_totalAmount"><?php echo $inb_bookings_pay_as_you_drive->totalAmount->FldCaption() ?></span></td>
		<td data-name="totalAmount"<?php echo $inb_bookings_pay_as_you_drive->totalAmount->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_totalAmount" data-page="1">
<span<?php echo $inb_bookings_pay_as_you_drive->totalAmount->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->totalAmount->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->vat->Visible) { // vat ?>
	<tr id="r_vat">
		<td class="col-sm-2"><span id="elh_inb_bookings_pay_as_you_drive_vat"><?php echo $inb_bookings_pay_as_you_drive->vat->FldCaption() ?></span></td>
		<td data-name="vat"<?php echo $inb_bookings_pay_as_you_drive->vat->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_vat" data-page="1">
<span<?php echo $inb_bookings_pay_as_you_drive->vat->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->vat->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->grandTotal->Visible) { // grandTotal ?>
	<tr id="r_grandTotal">
		<td class="col-sm-2"><span id="elh_inb_bookings_pay_as_you_drive_grandTotal"><?php echo $inb_bookings_pay_as_you_drive->grandTotal->FldCaption() ?></span></td>
		<td data-name="grandTotal"<?php echo $inb_bookings_pay_as_you_drive->grandTotal->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_grandTotal" data-page="1">
<span<?php echo $inb_bookings_pay_as_you_drive->grandTotal->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->grandTotal->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->deliveryAddress->Visible) { // deliveryAddress ?>
	<tr id="r_deliveryAddress">
		<td class="col-sm-2"><span id="elh_inb_bookings_pay_as_you_drive_deliveryAddress"><?php echo $inb_bookings_pay_as_you_drive->deliveryAddress->FldCaption() ?></span></td>
		<td data-name="deliveryAddress"<?php echo $inb_bookings_pay_as_you_drive->deliveryAddress->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_deliveryAddress" data-page="1">
<span<?php echo $inb_bookings_pay_as_you_drive->deliveryAddress->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->deliveryAddress->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->paymentMethod->Visible) { // paymentMethod ?>
	<tr id="r_paymentMethod">
		<td class="col-sm-2"><span id="elh_inb_bookings_pay_as_you_drive_paymentMethod"><?php echo $inb_bookings_pay_as_you_drive->paymentMethod->FldCaption() ?></span></td>
		<td data-name="paymentMethod"<?php echo $inb_bookings_pay_as_you_drive->paymentMethod->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_paymentMethod" data-page="1">
<span<?php echo $inb_bookings_pay_as_you_drive->paymentMethod->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->paymentMethod->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->dateCreated->Visible) { // dateCreated ?>
	<tr id="r_dateCreated">
		<td class="col-sm-2"><span id="elh_inb_bookings_pay_as_you_drive_dateCreated"><?php echo $inb_bookings_pay_as_you_drive->dateCreated->FldCaption() ?></span></td>
		<td data-name="dateCreated"<?php echo $inb_bookings_pay_as_you_drive->dateCreated->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_dateCreated" data-page="1">
<span<?php echo $inb_bookings_pay_as_you_drive->dateCreated->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->dateCreated->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($inb_bookings_pay_as_you_drive->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->Export == "") { ?>
		<div class="tab-pane<?php echo $inb_bookings_pay_as_you_drive_view->MultiPages->PageStyle("2") ?>" id="tab_inb_bookings_pay_as_you_drive2">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($inb_bookings_pay_as_you_drive->orangeCard->Visible) { // orangeCard ?>
	<tr id="r_orangeCard">
		<td class="col-sm-2"><span id="elh_inb_bookings_pay_as_you_drive_orangeCard"><?php echo $inb_bookings_pay_as_you_drive->orangeCard->FldCaption() ?></span></td>
		<td data-name="orangeCard"<?php echo $inb_bookings_pay_as_you_drive->orangeCard->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_orangeCard" data-page="2">
<span<?php echo $inb_bookings_pay_as_you_drive->orangeCard->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->orangeCard->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->gps->Visible) { // gps ?>
	<tr id="r_gps">
		<td class="col-sm-2"><span id="elh_inb_bookings_pay_as_you_drive_gps"><?php echo $inb_bookings_pay_as_you_drive->gps->FldCaption() ?></span></td>
		<td data-name="gps"<?php echo $inb_bookings_pay_as_you_drive->gps->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_gps" data-page="2">
<span<?php echo $inb_bookings_pay_as_you_drive->gps->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->gps->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->deliveryCharge->Visible) { // deliveryCharge ?>
	<tr id="r_deliveryCharge">
		<td class="col-sm-2"><span id="elh_inb_bookings_pay_as_you_drive_deliveryCharge"><?php echo $inb_bookings_pay_as_you_drive->deliveryCharge->FldCaption() ?></span></td>
		<td data-name="deliveryCharge"<?php echo $inb_bookings_pay_as_you_drive->deliveryCharge->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_deliveryCharge" data-page="2">
<span<?php echo $inb_bookings_pay_as_you_drive->deliveryCharge->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->deliveryCharge->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->collectionCharge->Visible) { // collectionCharge ?>
	<tr id="r_collectionCharge">
		<td class="col-sm-2"><span id="elh_inb_bookings_pay_as_you_drive_collectionCharge"><?php echo $inb_bookings_pay_as_you_drive->collectionCharge->FldCaption() ?></span></td>
		<td data-name="collectionCharge"<?php echo $inb_bookings_pay_as_you_drive->collectionCharge->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_collectionCharge" data-page="2">
<span<?php echo $inb_bookings_pay_as_you_drive->collectionCharge->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->collectionCharge->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($inb_bookings_pay_as_you_drive->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->Export == "") { ?>
	</div>
</div>
</div>
<?php } ?>
</form>
<?php if ($inb_bookings_pay_as_you_drive->Export == "") { ?>
<script type="text/javascript">
finb_bookings_pay_as_you_driveview.Init();
</script>
<?php } ?>
<?php
$inb_bookings_pay_as_you_drive_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($inb_bookings_pay_as_you_drive->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$inb_bookings_pay_as_you_drive_view->Page_Terminate();
?>
