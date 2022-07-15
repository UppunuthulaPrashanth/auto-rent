<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "pay_as_you_driveinfo.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$pay_as_you_drive_view = NULL; // Initialize page object first

class cpay_as_you_drive_view extends cpay_as_you_drive {

	// Page ID
	var $PageID = 'view';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'pay_as_you_drive';

	// Page object name
	var $PageObjName = 'pay_as_you_drive_view';

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

		// Table object (pay_as_you_drive)
		if (!isset($GLOBALS["pay_as_you_drive"]) || get_class($GLOBALS["pay_as_you_drive"]) == "cpay_as_you_drive") {
			$GLOBALS["pay_as_you_drive"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["pay_as_you_drive"];
		}
		$KeyUrl = "";
		if (@$_GET["payDriveCarID"] <> "") {
			$this->RecKey["payDriveCarID"] = $_GET["payDriveCarID"];
			$KeyUrl .= "&amp;payDriveCarID=" . urlencode($this->RecKey["payDriveCarID"]);
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
			define("EW_TABLE_NAME", 'pay_as_you_drive', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("pay_as_you_drivelist.php"));
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
		if (@$_GET["payDriveCarID"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= $_GET["payDriveCarID"];
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
		$this->payDriveCarID->SetVisibility();
		$this->payDriveCarID->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
		$this->bodyTypeID->SetVisibility();
		$this->carTitle->SetVisibility();
		$this->slug->SetVisibility();
		$this->image->SetVisibility();
		$this->extraFeatures->SetVisibility();
		$this->noOfSeats->SetVisibility();
		$this->luggage->SetVisibility();
		$this->transmissionID->SetVisibility();
		$this->ac->SetVisibility();
		$this->noOfDoors->SetVisibility();
		$this->s1DailyAED->SetVisibility();
		$this->s1DailyKM->SetVisibility();
		$this->s2DailyAED->SetVisibility();
		$this->s2DailyKM->SetVisibility();
		$this->s3DailyAED->SetVisibility();
		$this->s3DailyKM->SetVisibility();
		$this->s4DailyAED->SetVisibility();
		$this->s4DailyKM->SetVisibility();
		$this->s5DailyAED->SetVisibility();
		$this->s5DailyKM->SetVisibility();
		$this->s1WeeklyAED->SetVisibility();
		$this->s1WeeklyKM->SetVisibility();
		$this->s2WeeklyAED->SetVisibility();
		$this->s2WeeklyKM->SetVisibility();
		$this->s3WeeklyAED->SetVisibility();
		$this->s3WeeklyKM->SetVisibility();
		$this->s4WeeklyAED->SetVisibility();
		$this->s4WeeklyKM->SetVisibility();
		$this->s5WeeklyAED->SetVisibility();
		$this->s5WeeklyKM->SetVisibility();
		$this->s1MonthlyAED->SetVisibility();
		$this->s1MonthlyKM->SetVisibility();
		$this->s2MonthlyAED->SetVisibility();
		$this->s2MonthlyKM->SetVisibility();
		$this->s3MonthlyAED->SetVisibility();
		$this->s3MonthlyKM->SetVisibility();
		$this->s4MonthlyAED->SetVisibility();
		$this->s4MonthlyKM->SetVisibility();
		$this->s5MonthlyAED->SetVisibility();
		$this->s5MonthlyKM->SetVisibility();
		$this->active->SetVisibility();
		$this->phase1OrangeCard->SetVisibility();
		$this->phase1GPS->SetVisibility();
		$this->phase1DeliveryCharges->SetVisibility();
		$this->phase1CollectionCharges->SetVisibility();
		$this->addon01KM->SetVisibility();
		$this->addon01Price->SetVisibility();
		$this->addon02KM->SetVisibility();
		$this->addon02Price->SetVisibility();
		$this->addon03KM->SetVisibility();
		$this->addon03Price->SetVisibility();
		$this->addon04KM->SetVisibility();
		$this->addon04Price->SetVisibility();
		$this->addon05KM->SetVisibility();
		$this->addon05Price->SetVisibility();

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
		global $EW_EXPORT, $pay_as_you_drive;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($pay_as_you_drive);
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
					if ($pageName == "pay_as_you_driveview.php")
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
			if (@$_GET["payDriveCarID"] <> "") {
				$this->payDriveCarID->setQueryStringValue($_GET["payDriveCarID"]);
				$this->RecKey["payDriveCarID"] = $this->payDriveCarID->QueryStringValue;
			} elseif (@$_POST["payDriveCarID"] <> "") {
				$this->payDriveCarID->setFormValue($_POST["payDriveCarID"]);
				$this->RecKey["payDriveCarID"] = $this->payDriveCarID->FormValue;
			} else {
				$sReturnUrl = "pay_as_you_drivelist.php"; // Return to list
			}

			// Get action
			$this->CurrentAction = "I"; // Display form
			switch ($this->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "pay_as_you_drivelist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if ($this->CustomExport == "" && in_array($this->Export, array_keys($EW_EXPORT))) {
				$this->ExportData();
				$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "pay_as_you_drivelist.php"; // Not page request, return to list
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

		// Add
		$item = &$option->Add("add");
		$addcaption = ew_HtmlTitle($Language->Phrase("ViewPageAddLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ewAction ewAdd\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"javascript:void(0);\" onclick=\"ew_ModalDialogShow({lnk:this,url:'" . ew_HtmlEncode($this->AddUrl) . "'});\">" . $Language->Phrase("ViewPageAddLink") . "</a>";
		else
			$item->Body = "<a class=\"ewAction ewAdd\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . ew_HtmlEncode($this->AddUrl) . "\">" . $Language->Phrase("ViewPageAddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "" && $Security->CanAdd());

		// Edit
		$item = &$option->Add("edit");
		$editcaption = ew_HtmlTitle($Language->Phrase("ViewPageEditLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ewAction ewEdit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"javascript:void(0);\" onclick=\"ew_ModalDialogShow({lnk:this,url:'" . ew_HtmlEncode($this->EditUrl) . "'});\">" . $Language->Phrase("ViewPageEditLink") . "</a>";
		else
			$item->Body = "<a class=\"ewAction ewEdit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . ew_HtmlEncode($this->EditUrl) . "\">" . $Language->Phrase("ViewPageEditLink") . "</a>";
		$item->Visible = ($this->EditUrl <> "" && $Security->CanEdit());

		// Delete
		$item = &$option->Add("delete");
		if ($this->IsModal) // Handle as inline delete
			$item->Body = "<a onclick=\"return ew_ConfirmDelete(this);\" class=\"ewAction ewDelete\" title=\"" . ew_HtmlTitle($Language->Phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("ViewPageDeleteLink")) . "\" href=\"" . ew_HtmlEncode(ew_UrlAddQuery($this->DeleteUrl, "a_delete=1")) . "\">" . $Language->Phrase("ViewPageDeleteLink") . "</a>";
		else
			$item->Body = "<a class=\"ewAction ewDelete\" title=\"" . ew_HtmlTitle($Language->Phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("ViewPageDeleteLink")) . "\" href=\"" . ew_HtmlEncode($this->DeleteUrl) . "\">" . $Language->Phrase("ViewPageDeleteLink") . "</a>";
		$item->Visible = ($this->DeleteUrl <> "" && $Security->CanDelete());

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
		$this->payDriveCarID->setDbValue($row['payDriveCarID']);
		$this->bodyTypeID->setDbValue($row['bodyTypeID']);
		$this->carTitle->setDbValue($row['carTitle']);
		$this->slug->setDbValue($row['slug']);
		$this->image->Upload->DbValue = $row['image'];
		$this->image->setDbValue($this->image->Upload->DbValue);
		$this->extraFeatures->setDbValue($row['extraFeatures']);
		$this->noOfSeats->setDbValue($row['noOfSeats']);
		$this->luggage->setDbValue($row['luggage']);
		$this->transmissionID->setDbValue($row['transmissionID']);
		$this->ac->setDbValue($row['ac']);
		$this->noOfDoors->setDbValue($row['noOfDoors']);
		$this->s1DailyAED->setDbValue($row['s1DailyAED']);
		$this->s1DailyKM->setDbValue($row['s1DailyKM']);
		$this->s2DailyAED->setDbValue($row['s2DailyAED']);
		$this->s2DailyKM->setDbValue($row['s2DailyKM']);
		$this->s3DailyAED->setDbValue($row['s3DailyAED']);
		$this->s3DailyKM->setDbValue($row['s3DailyKM']);
		$this->s4DailyAED->setDbValue($row['s4DailyAED']);
		$this->s4DailyKM->setDbValue($row['s4DailyKM']);
		$this->s5DailyAED->setDbValue($row['s5DailyAED']);
		$this->s5DailyKM->setDbValue($row['s5DailyKM']);
		$this->s1WeeklyAED->setDbValue($row['s1WeeklyAED']);
		$this->s1WeeklyKM->setDbValue($row['s1WeeklyKM']);
		$this->s2WeeklyAED->setDbValue($row['s2WeeklyAED']);
		$this->s2WeeklyKM->setDbValue($row['s2WeeklyKM']);
		$this->s3WeeklyAED->setDbValue($row['s3WeeklyAED']);
		$this->s3WeeklyKM->setDbValue($row['s3WeeklyKM']);
		$this->s4WeeklyAED->setDbValue($row['s4WeeklyAED']);
		$this->s4WeeklyKM->setDbValue($row['s4WeeklyKM']);
		$this->s5WeeklyAED->setDbValue($row['s5WeeklyAED']);
		$this->s5WeeklyKM->setDbValue($row['s5WeeklyKM']);
		$this->s1MonthlyAED->setDbValue($row['s1MonthlyAED']);
		$this->s1MonthlyKM->setDbValue($row['s1MonthlyKM']);
		$this->s2MonthlyAED->setDbValue($row['s2MonthlyAED']);
		$this->s2MonthlyKM->setDbValue($row['s2MonthlyKM']);
		$this->s3MonthlyAED->setDbValue($row['s3MonthlyAED']);
		$this->s3MonthlyKM->setDbValue($row['s3MonthlyKM']);
		$this->s4MonthlyAED->setDbValue($row['s4MonthlyAED']);
		$this->s4MonthlyKM->setDbValue($row['s4MonthlyKM']);
		$this->s5MonthlyAED->setDbValue($row['s5MonthlyAED']);
		$this->s5MonthlyKM->setDbValue($row['s5MonthlyKM']);
		$this->scdwDailyAED->setDbValue($row['scdwDailyAED']);
		$this->scdwWeeklyAED->setDbValue($row['scdwWeeklyAED']);
		$this->scdwMonthlyAED->setDbValue($row['scdwMonthlyAED']);
		$this->cdwDailyAED->setDbValue($row['cdwDailyAED']);
		$this->cdwWeeklyAED->setDbValue($row['cdwWeeklyAED']);
		$this->cdwMonthlyAED->setDbValue($row['cdwMonthlyAED']);
		$this->paiDailyAED->setDbValue($row['paiDailyAED']);
		$this->paiWeeklyAED->setDbValue($row['paiWeeklyAED']);
		$this->paiMonthlyAED->setDbValue($row['paiMonthlyAED']);
		$this->gpsDailyAED->setDbValue($row['gpsDailyAED']);
		$this->gpsWeeklyAED->setDbValue($row['gpsWeeklyAED']);
		$this->gpsMonthlyAED->setDbValue($row['gpsMonthlyAED']);
		$this->additionalDriverDailyAED->setDbValue($row['additionalDriverDailyAED']);
		$this->additionalDriverWeeklyAED->setDbValue($row['additionalDriverWeeklyAED']);
		$this->additionalDriverMonthlyAED->setDbValue($row['additionalDriverMonthlyAED']);
		$this->babySafetySeatDailyAED->setDbValue($row['babySafetySeatDailyAED']);
		$this->babySafetySeatWeeklyAED->setDbValue($row['babySafetySeatWeeklyAED']);
		$this->babySafetySeatMonthlyAED->setDbValue($row['babySafetySeatMonthlyAED']);
		$this->addBabySafetySeatDailyAED->setDbValue($row['addBabySafetySeatDailyAED']);
		$this->addBabySafetySeatWeeklyAED->setDbValue($row['addBabySafetySeatWeeklyAED']);
		$this->addBabySafetySeatMonthlyAED->setDbValue($row['addBabySafetySeatMonthlyAED']);
		$this->deliveryAED->setDbValue($row['deliveryAED']);
		$this->active->setDbValue($row['active']);
		$this->phase1OrangeCard->setDbValue($row['phase1OrangeCard']);
		$this->phase1GPS->setDbValue($row['phase1GPS']);
		$this->phase1DeliveryCharges->setDbValue($row['phase1DeliveryCharges']);
		$this->phase1CollectionCharges->setDbValue($row['phase1CollectionCharges']);
		$this->addon01KM->setDbValue($row['addon01KM']);
		$this->addon01Price->setDbValue($row['addon01Price']);
		$this->addon02KM->setDbValue($row['addon02KM']);
		$this->addon02Price->setDbValue($row['addon02Price']);
		$this->addon03KM->setDbValue($row['addon03KM']);
		$this->addon03Price->setDbValue($row['addon03Price']);
		$this->addon04KM->setDbValue($row['addon04KM']);
		$this->addon04Price->setDbValue($row['addon04Price']);
		$this->addon05KM->setDbValue($row['addon05KM']);
		$this->addon05Price->setDbValue($row['addon05Price']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['payDriveCarID'] = NULL;
		$row['bodyTypeID'] = NULL;
		$row['carTitle'] = NULL;
		$row['slug'] = NULL;
		$row['image'] = NULL;
		$row['extraFeatures'] = NULL;
		$row['noOfSeats'] = NULL;
		$row['luggage'] = NULL;
		$row['transmissionID'] = NULL;
		$row['ac'] = NULL;
		$row['noOfDoors'] = NULL;
		$row['s1DailyAED'] = NULL;
		$row['s1DailyKM'] = NULL;
		$row['s2DailyAED'] = NULL;
		$row['s2DailyKM'] = NULL;
		$row['s3DailyAED'] = NULL;
		$row['s3DailyKM'] = NULL;
		$row['s4DailyAED'] = NULL;
		$row['s4DailyKM'] = NULL;
		$row['s5DailyAED'] = NULL;
		$row['s5DailyKM'] = NULL;
		$row['s1WeeklyAED'] = NULL;
		$row['s1WeeklyKM'] = NULL;
		$row['s2WeeklyAED'] = NULL;
		$row['s2WeeklyKM'] = NULL;
		$row['s3WeeklyAED'] = NULL;
		$row['s3WeeklyKM'] = NULL;
		$row['s4WeeklyAED'] = NULL;
		$row['s4WeeklyKM'] = NULL;
		$row['s5WeeklyAED'] = NULL;
		$row['s5WeeklyKM'] = NULL;
		$row['s1MonthlyAED'] = NULL;
		$row['s1MonthlyKM'] = NULL;
		$row['s2MonthlyAED'] = NULL;
		$row['s2MonthlyKM'] = NULL;
		$row['s3MonthlyAED'] = NULL;
		$row['s3MonthlyKM'] = NULL;
		$row['s4MonthlyAED'] = NULL;
		$row['s4MonthlyKM'] = NULL;
		$row['s5MonthlyAED'] = NULL;
		$row['s5MonthlyKM'] = NULL;
		$row['scdwDailyAED'] = NULL;
		$row['scdwWeeklyAED'] = NULL;
		$row['scdwMonthlyAED'] = NULL;
		$row['cdwDailyAED'] = NULL;
		$row['cdwWeeklyAED'] = NULL;
		$row['cdwMonthlyAED'] = NULL;
		$row['paiDailyAED'] = NULL;
		$row['paiWeeklyAED'] = NULL;
		$row['paiMonthlyAED'] = NULL;
		$row['gpsDailyAED'] = NULL;
		$row['gpsWeeklyAED'] = NULL;
		$row['gpsMonthlyAED'] = NULL;
		$row['additionalDriverDailyAED'] = NULL;
		$row['additionalDriverWeeklyAED'] = NULL;
		$row['additionalDriverMonthlyAED'] = NULL;
		$row['babySafetySeatDailyAED'] = NULL;
		$row['babySafetySeatWeeklyAED'] = NULL;
		$row['babySafetySeatMonthlyAED'] = NULL;
		$row['addBabySafetySeatDailyAED'] = NULL;
		$row['addBabySafetySeatWeeklyAED'] = NULL;
		$row['addBabySafetySeatMonthlyAED'] = NULL;
		$row['deliveryAED'] = NULL;
		$row['active'] = NULL;
		$row['phase1OrangeCard'] = NULL;
		$row['phase1GPS'] = NULL;
		$row['phase1DeliveryCharges'] = NULL;
		$row['phase1CollectionCharges'] = NULL;
		$row['addon01KM'] = NULL;
		$row['addon01Price'] = NULL;
		$row['addon02KM'] = NULL;
		$row['addon02Price'] = NULL;
		$row['addon03KM'] = NULL;
		$row['addon03Price'] = NULL;
		$row['addon04KM'] = NULL;
		$row['addon04Price'] = NULL;
		$row['addon05KM'] = NULL;
		$row['addon05Price'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->payDriveCarID->DbValue = $row['payDriveCarID'];
		$this->bodyTypeID->DbValue = $row['bodyTypeID'];
		$this->carTitle->DbValue = $row['carTitle'];
		$this->slug->DbValue = $row['slug'];
		$this->image->Upload->DbValue = $row['image'];
		$this->extraFeatures->DbValue = $row['extraFeatures'];
		$this->noOfSeats->DbValue = $row['noOfSeats'];
		$this->luggage->DbValue = $row['luggage'];
		$this->transmissionID->DbValue = $row['transmissionID'];
		$this->ac->DbValue = $row['ac'];
		$this->noOfDoors->DbValue = $row['noOfDoors'];
		$this->s1DailyAED->DbValue = $row['s1DailyAED'];
		$this->s1DailyKM->DbValue = $row['s1DailyKM'];
		$this->s2DailyAED->DbValue = $row['s2DailyAED'];
		$this->s2DailyKM->DbValue = $row['s2DailyKM'];
		$this->s3DailyAED->DbValue = $row['s3DailyAED'];
		$this->s3DailyKM->DbValue = $row['s3DailyKM'];
		$this->s4DailyAED->DbValue = $row['s4DailyAED'];
		$this->s4DailyKM->DbValue = $row['s4DailyKM'];
		$this->s5DailyAED->DbValue = $row['s5DailyAED'];
		$this->s5DailyKM->DbValue = $row['s5DailyKM'];
		$this->s1WeeklyAED->DbValue = $row['s1WeeklyAED'];
		$this->s1WeeklyKM->DbValue = $row['s1WeeklyKM'];
		$this->s2WeeklyAED->DbValue = $row['s2WeeklyAED'];
		$this->s2WeeklyKM->DbValue = $row['s2WeeklyKM'];
		$this->s3WeeklyAED->DbValue = $row['s3WeeklyAED'];
		$this->s3WeeklyKM->DbValue = $row['s3WeeklyKM'];
		$this->s4WeeklyAED->DbValue = $row['s4WeeklyAED'];
		$this->s4WeeklyKM->DbValue = $row['s4WeeklyKM'];
		$this->s5WeeklyAED->DbValue = $row['s5WeeklyAED'];
		$this->s5WeeklyKM->DbValue = $row['s5WeeklyKM'];
		$this->s1MonthlyAED->DbValue = $row['s1MonthlyAED'];
		$this->s1MonthlyKM->DbValue = $row['s1MonthlyKM'];
		$this->s2MonthlyAED->DbValue = $row['s2MonthlyAED'];
		$this->s2MonthlyKM->DbValue = $row['s2MonthlyKM'];
		$this->s3MonthlyAED->DbValue = $row['s3MonthlyAED'];
		$this->s3MonthlyKM->DbValue = $row['s3MonthlyKM'];
		$this->s4MonthlyAED->DbValue = $row['s4MonthlyAED'];
		$this->s4MonthlyKM->DbValue = $row['s4MonthlyKM'];
		$this->s5MonthlyAED->DbValue = $row['s5MonthlyAED'];
		$this->s5MonthlyKM->DbValue = $row['s5MonthlyKM'];
		$this->scdwDailyAED->DbValue = $row['scdwDailyAED'];
		$this->scdwWeeklyAED->DbValue = $row['scdwWeeklyAED'];
		$this->scdwMonthlyAED->DbValue = $row['scdwMonthlyAED'];
		$this->cdwDailyAED->DbValue = $row['cdwDailyAED'];
		$this->cdwWeeklyAED->DbValue = $row['cdwWeeklyAED'];
		$this->cdwMonthlyAED->DbValue = $row['cdwMonthlyAED'];
		$this->paiDailyAED->DbValue = $row['paiDailyAED'];
		$this->paiWeeklyAED->DbValue = $row['paiWeeklyAED'];
		$this->paiMonthlyAED->DbValue = $row['paiMonthlyAED'];
		$this->gpsDailyAED->DbValue = $row['gpsDailyAED'];
		$this->gpsWeeklyAED->DbValue = $row['gpsWeeklyAED'];
		$this->gpsMonthlyAED->DbValue = $row['gpsMonthlyAED'];
		$this->additionalDriverDailyAED->DbValue = $row['additionalDriverDailyAED'];
		$this->additionalDriverWeeklyAED->DbValue = $row['additionalDriverWeeklyAED'];
		$this->additionalDriverMonthlyAED->DbValue = $row['additionalDriverMonthlyAED'];
		$this->babySafetySeatDailyAED->DbValue = $row['babySafetySeatDailyAED'];
		$this->babySafetySeatWeeklyAED->DbValue = $row['babySafetySeatWeeklyAED'];
		$this->babySafetySeatMonthlyAED->DbValue = $row['babySafetySeatMonthlyAED'];
		$this->addBabySafetySeatDailyAED->DbValue = $row['addBabySafetySeatDailyAED'];
		$this->addBabySafetySeatWeeklyAED->DbValue = $row['addBabySafetySeatWeeklyAED'];
		$this->addBabySafetySeatMonthlyAED->DbValue = $row['addBabySafetySeatMonthlyAED'];
		$this->deliveryAED->DbValue = $row['deliveryAED'];
		$this->active->DbValue = $row['active'];
		$this->phase1OrangeCard->DbValue = $row['phase1OrangeCard'];
		$this->phase1GPS->DbValue = $row['phase1GPS'];
		$this->phase1DeliveryCharges->DbValue = $row['phase1DeliveryCharges'];
		$this->phase1CollectionCharges->DbValue = $row['phase1CollectionCharges'];
		$this->addon01KM->DbValue = $row['addon01KM'];
		$this->addon01Price->DbValue = $row['addon01Price'];
		$this->addon02KM->DbValue = $row['addon02KM'];
		$this->addon02Price->DbValue = $row['addon02Price'];
		$this->addon03KM->DbValue = $row['addon03KM'];
		$this->addon03Price->DbValue = $row['addon03Price'];
		$this->addon04KM->DbValue = $row['addon04KM'];
		$this->addon04Price->DbValue = $row['addon04Price'];
		$this->addon05KM->DbValue = $row['addon05KM'];
		$this->addon05Price->DbValue = $row['addon05Price'];
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
		if ($this->s1DailyAED->FormValue == $this->s1DailyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s1DailyAED->CurrentValue)))
			$this->s1DailyAED->CurrentValue = ew_StrToFloat($this->s1DailyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->s2DailyAED->FormValue == $this->s2DailyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s2DailyAED->CurrentValue)))
			$this->s2DailyAED->CurrentValue = ew_StrToFloat($this->s2DailyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->s3DailyAED->FormValue == $this->s3DailyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s3DailyAED->CurrentValue)))
			$this->s3DailyAED->CurrentValue = ew_StrToFloat($this->s3DailyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->s4DailyAED->FormValue == $this->s4DailyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s4DailyAED->CurrentValue)))
			$this->s4DailyAED->CurrentValue = ew_StrToFloat($this->s4DailyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->s5DailyAED->FormValue == $this->s5DailyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s5DailyAED->CurrentValue)))
			$this->s5DailyAED->CurrentValue = ew_StrToFloat($this->s5DailyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->s1WeeklyAED->FormValue == $this->s1WeeklyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s1WeeklyAED->CurrentValue)))
			$this->s1WeeklyAED->CurrentValue = ew_StrToFloat($this->s1WeeklyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->s2WeeklyAED->FormValue == $this->s2WeeklyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s2WeeklyAED->CurrentValue)))
			$this->s2WeeklyAED->CurrentValue = ew_StrToFloat($this->s2WeeklyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->s3WeeklyAED->FormValue == $this->s3WeeklyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s3WeeklyAED->CurrentValue)))
			$this->s3WeeklyAED->CurrentValue = ew_StrToFloat($this->s3WeeklyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->s4WeeklyAED->FormValue == $this->s4WeeklyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s4WeeklyAED->CurrentValue)))
			$this->s4WeeklyAED->CurrentValue = ew_StrToFloat($this->s4WeeklyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->s5WeeklyAED->FormValue == $this->s5WeeklyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s5WeeklyAED->CurrentValue)))
			$this->s5WeeklyAED->CurrentValue = ew_StrToFloat($this->s5WeeklyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->s1MonthlyAED->FormValue == $this->s1MonthlyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s1MonthlyAED->CurrentValue)))
			$this->s1MonthlyAED->CurrentValue = ew_StrToFloat($this->s1MonthlyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->s2MonthlyAED->FormValue == $this->s2MonthlyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s2MonthlyAED->CurrentValue)))
			$this->s2MonthlyAED->CurrentValue = ew_StrToFloat($this->s2MonthlyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->s3MonthlyAED->FormValue == $this->s3MonthlyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s3MonthlyAED->CurrentValue)))
			$this->s3MonthlyAED->CurrentValue = ew_StrToFloat($this->s3MonthlyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->s4MonthlyAED->FormValue == $this->s4MonthlyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s4MonthlyAED->CurrentValue)))
			$this->s4MonthlyAED->CurrentValue = ew_StrToFloat($this->s4MonthlyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->s5MonthlyAED->FormValue == $this->s5MonthlyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s5MonthlyAED->CurrentValue)))
			$this->s5MonthlyAED->CurrentValue = ew_StrToFloat($this->s5MonthlyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->phase1OrangeCard->FormValue == $this->phase1OrangeCard->CurrentValue && is_numeric(ew_StrToFloat($this->phase1OrangeCard->CurrentValue)))
			$this->phase1OrangeCard->CurrentValue = ew_StrToFloat($this->phase1OrangeCard->CurrentValue);

		// Convert decimal values if posted back
		if ($this->phase1GPS->FormValue == $this->phase1GPS->CurrentValue && is_numeric(ew_StrToFloat($this->phase1GPS->CurrentValue)))
			$this->phase1GPS->CurrentValue = ew_StrToFloat($this->phase1GPS->CurrentValue);

		// Convert decimal values if posted back
		if ($this->phase1DeliveryCharges->FormValue == $this->phase1DeliveryCharges->CurrentValue && is_numeric(ew_StrToFloat($this->phase1DeliveryCharges->CurrentValue)))
			$this->phase1DeliveryCharges->CurrentValue = ew_StrToFloat($this->phase1DeliveryCharges->CurrentValue);

		// Convert decimal values if posted back
		if ($this->phase1CollectionCharges->FormValue == $this->phase1CollectionCharges->CurrentValue && is_numeric(ew_StrToFloat($this->phase1CollectionCharges->CurrentValue)))
			$this->phase1CollectionCharges->CurrentValue = ew_StrToFloat($this->phase1CollectionCharges->CurrentValue);

		// Convert decimal values if posted back
		if ($this->addon01KM->FormValue == $this->addon01KM->CurrentValue && is_numeric(ew_StrToFloat($this->addon01KM->CurrentValue)))
			$this->addon01KM->CurrentValue = ew_StrToFloat($this->addon01KM->CurrentValue);

		// Convert decimal values if posted back
		if ($this->addon01Price->FormValue == $this->addon01Price->CurrentValue && is_numeric(ew_StrToFloat($this->addon01Price->CurrentValue)))
			$this->addon01Price->CurrentValue = ew_StrToFloat($this->addon01Price->CurrentValue);

		// Convert decimal values if posted back
		if ($this->addon02KM->FormValue == $this->addon02KM->CurrentValue && is_numeric(ew_StrToFloat($this->addon02KM->CurrentValue)))
			$this->addon02KM->CurrentValue = ew_StrToFloat($this->addon02KM->CurrentValue);

		// Convert decimal values if posted back
		if ($this->addon02Price->FormValue == $this->addon02Price->CurrentValue && is_numeric(ew_StrToFloat($this->addon02Price->CurrentValue)))
			$this->addon02Price->CurrentValue = ew_StrToFloat($this->addon02Price->CurrentValue);

		// Convert decimal values if posted back
		if ($this->addon03KM->FormValue == $this->addon03KM->CurrentValue && is_numeric(ew_StrToFloat($this->addon03KM->CurrentValue)))
			$this->addon03KM->CurrentValue = ew_StrToFloat($this->addon03KM->CurrentValue);

		// Convert decimal values if posted back
		if ($this->addon03Price->FormValue == $this->addon03Price->CurrentValue && is_numeric(ew_StrToFloat($this->addon03Price->CurrentValue)))
			$this->addon03Price->CurrentValue = ew_StrToFloat($this->addon03Price->CurrentValue);

		// Convert decimal values if posted back
		if ($this->addon04KM->FormValue == $this->addon04KM->CurrentValue && is_numeric(ew_StrToFloat($this->addon04KM->CurrentValue)))
			$this->addon04KM->CurrentValue = ew_StrToFloat($this->addon04KM->CurrentValue);

		// Convert decimal values if posted back
		if ($this->addon04Price->FormValue == $this->addon04Price->CurrentValue && is_numeric(ew_StrToFloat($this->addon04Price->CurrentValue)))
			$this->addon04Price->CurrentValue = ew_StrToFloat($this->addon04Price->CurrentValue);

		// Convert decimal values if posted back
		if ($this->addon05KM->FormValue == $this->addon05KM->CurrentValue && is_numeric(ew_StrToFloat($this->addon05KM->CurrentValue)))
			$this->addon05KM->CurrentValue = ew_StrToFloat($this->addon05KM->CurrentValue);

		// Convert decimal values if posted back
		if ($this->addon05Price->FormValue == $this->addon05Price->CurrentValue && is_numeric(ew_StrToFloat($this->addon05Price->CurrentValue)))
			$this->addon05Price->CurrentValue = ew_StrToFloat($this->addon05Price->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// payDriveCarID
		// bodyTypeID
		// carTitle
		// slug
		// image
		// extraFeatures
		// noOfSeats
		// luggage
		// transmissionID
		// ac
		// noOfDoors
		// s1DailyAED
		// s1DailyKM
		// s2DailyAED
		// s2DailyKM
		// s3DailyAED
		// s3DailyKM
		// s4DailyAED
		// s4DailyKM
		// s5DailyAED
		// s5DailyKM
		// s1WeeklyAED
		// s1WeeklyKM
		// s2WeeklyAED
		// s2WeeklyKM
		// s3WeeklyAED
		// s3WeeklyKM
		// s4WeeklyAED
		// s4WeeklyKM
		// s5WeeklyAED
		// s5WeeklyKM
		// s1MonthlyAED
		// s1MonthlyKM
		// s2MonthlyAED
		// s2MonthlyKM
		// s3MonthlyAED
		// s3MonthlyKM
		// s4MonthlyAED
		// s4MonthlyKM
		// s5MonthlyAED
		// s5MonthlyKM
		// scdwDailyAED
		// scdwWeeklyAED
		// scdwMonthlyAED
		// cdwDailyAED
		// cdwWeeklyAED
		// cdwMonthlyAED
		// paiDailyAED
		// paiWeeklyAED
		// paiMonthlyAED
		// gpsDailyAED
		// gpsWeeklyAED
		// gpsMonthlyAED
		// additionalDriverDailyAED
		// additionalDriverWeeklyAED
		// additionalDriverMonthlyAED
		// babySafetySeatDailyAED
		// babySafetySeatWeeklyAED
		// babySafetySeatMonthlyAED
		// addBabySafetySeatDailyAED
		// addBabySafetySeatWeeklyAED
		// addBabySafetySeatMonthlyAED
		// deliveryAED
		// active
		// phase1OrangeCard
		// phase1GPS
		// phase1DeliveryCharges
		// phase1CollectionCharges
		// addon01KM
		// addon01Price
		// addon02KM
		// addon02Price
		// addon03KM
		// addon03Price
		// addon04KM
		// addon04Price
		// addon05KM
		// addon05Price

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// payDriveCarID
		$this->payDriveCarID->ViewValue = $this->payDriveCarID->CurrentValue;
		$this->payDriveCarID->ViewCustomAttributes = "";

		// bodyTypeID
		if (strval($this->bodyTypeID->CurrentValue) <> "") {
			$sFilterWrk = "`bodyTypeID`" . ew_SearchString("=", $this->bodyTypeID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `bodyTypeID`, `bodytype` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_bodytype`";
		$sWhereWrk = "";
		$this->bodyTypeID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->bodyTypeID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->bodyTypeID->ViewValue = $this->bodyTypeID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->bodyTypeID->ViewValue = $this->bodyTypeID->CurrentValue;
			}
		} else {
			$this->bodyTypeID->ViewValue = NULL;
		}
		$this->bodyTypeID->ViewCustomAttributes = "";

		// carTitle
		$this->carTitle->ViewValue = $this->carTitle->CurrentValue;
		$this->carTitle->ViewCustomAttributes = "";

		// slug
		$this->slug->ViewValue = $this->slug->CurrentValue;
		$this->slug->ViewCustomAttributes = "";

		// image
		$this->image->UploadPath = 'uploads/rentlease';
		if (!ew_Empty($this->image->Upload->DbValue)) {
			$this->image->ImageWidth = 100;
			$this->image->ImageHeight = 0;
			$this->image->ImageAlt = $this->image->FldAlt();
			$this->image->ViewValue = $this->image->Upload->DbValue;
		} else {
			$this->image->ViewValue = "";
		}
		$this->image->ViewCustomAttributes = "";

		// extraFeatures
		if (strval($this->extraFeatures->CurrentValue) <> "") {
			$arwrk = explode(",", $this->extraFeatures->CurrentValue);
			$sFilterWrk = "";
			foreach ($arwrk as $wrk) {
				if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
				$sFilterWrk .= "`featureID`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_NUMBER, "");
			}
		$sSqlWrk = "SELECT `featureID`, `extraFeatures` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_extra_features`";
		$sWhereWrk = "";
		$this->extraFeatures->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->extraFeatures, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->extraFeatures->ViewValue = "";
				$ari = 0;
				while (!$rswrk->EOF) {
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->extraFeatures->ViewValue .= $this->extraFeatures->DisplayValue($arwrk);
					$rswrk->MoveNext();
					if (!$rswrk->EOF) $this->extraFeatures->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
					$ari++;
				}
				$rswrk->Close();
			} else {
				$this->extraFeatures->ViewValue = $this->extraFeatures->CurrentValue;
			}
		} else {
			$this->extraFeatures->ViewValue = NULL;
		}
		$this->extraFeatures->ViewCustomAttributes = "";

		// noOfSeats
		$this->noOfSeats->ViewValue = $this->noOfSeats->CurrentValue;
		$this->noOfSeats->ViewCustomAttributes = "";

		// luggage
		$this->luggage->ViewValue = $this->luggage->CurrentValue;
		$this->luggage->ViewCustomAttributes = "";

		// transmissionID
		if (strval($this->transmissionID->CurrentValue) <> "") {
			$sFilterWrk = "`transmissionID`" . ew_SearchString("=", $this->transmissionID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `transmissionID`, `transmission` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_transmission`";
		$sWhereWrk = "";
		$this->transmissionID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->transmissionID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->transmissionID->ViewValue = $this->transmissionID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->transmissionID->ViewValue = $this->transmissionID->CurrentValue;
			}
		} else {
			$this->transmissionID->ViewValue = NULL;
		}
		$this->transmissionID->ViewCustomAttributes = "";

		// ac
		if (ew_ConvertToBool($this->ac->CurrentValue)) {
			$this->ac->ViewValue = $this->ac->FldTagCaption(1) <> "" ? $this->ac->FldTagCaption(1) : "Y";
		} else {
			$this->ac->ViewValue = $this->ac->FldTagCaption(2) <> "" ? $this->ac->FldTagCaption(2) : "N";
		}
		$this->ac->ViewCustomAttributes = "";

		// noOfDoors
		$this->noOfDoors->ViewValue = $this->noOfDoors->CurrentValue;
		$this->noOfDoors->ViewCustomAttributes = "";

		// s1DailyAED
		$this->s1DailyAED->ViewValue = $this->s1DailyAED->CurrentValue;
		$this->s1DailyAED->ViewCustomAttributes = "";

		// s1DailyKM
		$this->s1DailyKM->ViewValue = $this->s1DailyKM->CurrentValue;
		$this->s1DailyKM->ViewCustomAttributes = "";

		// s2DailyAED
		$this->s2DailyAED->ViewValue = $this->s2DailyAED->CurrentValue;
		$this->s2DailyAED->ViewCustomAttributes = "";

		// s2DailyKM
		$this->s2DailyKM->ViewValue = $this->s2DailyKM->CurrentValue;
		$this->s2DailyKM->ViewCustomAttributes = "";

		// s3DailyAED
		$this->s3DailyAED->ViewValue = $this->s3DailyAED->CurrentValue;
		$this->s3DailyAED->ViewCustomAttributes = "";

		// s3DailyKM
		$this->s3DailyKM->ViewValue = $this->s3DailyKM->CurrentValue;
		$this->s3DailyKM->ViewCustomAttributes = "";

		// s4DailyAED
		$this->s4DailyAED->ViewValue = $this->s4DailyAED->CurrentValue;
		$this->s4DailyAED->ViewCustomAttributes = "";

		// s4DailyKM
		$this->s4DailyKM->ViewValue = $this->s4DailyKM->CurrentValue;
		$this->s4DailyKM->ViewCustomAttributes = "";

		// s5DailyAED
		$this->s5DailyAED->ViewValue = $this->s5DailyAED->CurrentValue;
		$this->s5DailyAED->ViewCustomAttributes = "";

		// s5DailyKM
		$this->s5DailyKM->ViewValue = $this->s5DailyKM->CurrentValue;
		$this->s5DailyKM->ViewCustomAttributes = "";

		// s1WeeklyAED
		$this->s1WeeklyAED->ViewValue = $this->s1WeeklyAED->CurrentValue;
		$this->s1WeeklyAED->ViewCustomAttributes = "";

		// s1WeeklyKM
		$this->s1WeeklyKM->ViewValue = $this->s1WeeklyKM->CurrentValue;
		$this->s1WeeklyKM->ViewCustomAttributes = "";

		// s2WeeklyAED
		$this->s2WeeklyAED->ViewValue = $this->s2WeeklyAED->CurrentValue;
		$this->s2WeeklyAED->ViewCustomAttributes = "";

		// s2WeeklyKM
		$this->s2WeeklyKM->ViewValue = $this->s2WeeklyKM->CurrentValue;
		$this->s2WeeklyKM->ViewCustomAttributes = "";

		// s3WeeklyAED
		$this->s3WeeklyAED->ViewValue = $this->s3WeeklyAED->CurrentValue;
		$this->s3WeeklyAED->ViewCustomAttributes = "";

		// s3WeeklyKM
		$this->s3WeeklyKM->ViewValue = $this->s3WeeklyKM->CurrentValue;
		$this->s3WeeklyKM->ViewCustomAttributes = "";

		// s4WeeklyAED
		$this->s4WeeklyAED->ViewValue = $this->s4WeeklyAED->CurrentValue;
		$this->s4WeeklyAED->ViewCustomAttributes = "";

		// s4WeeklyKM
		$this->s4WeeklyKM->ViewValue = $this->s4WeeklyKM->CurrentValue;
		$this->s4WeeklyKM->ViewCustomAttributes = "";

		// s5WeeklyAED
		$this->s5WeeklyAED->ViewValue = $this->s5WeeklyAED->CurrentValue;
		$this->s5WeeklyAED->ViewCustomAttributes = "";

		// s5WeeklyKM
		$this->s5WeeklyKM->ViewValue = $this->s5WeeklyKM->CurrentValue;
		$this->s5WeeklyKM->ViewCustomAttributes = "";

		// s1MonthlyAED
		$this->s1MonthlyAED->ViewValue = $this->s1MonthlyAED->CurrentValue;
		$this->s1MonthlyAED->ViewCustomAttributes = "";

		// s1MonthlyKM
		$this->s1MonthlyKM->ViewValue = $this->s1MonthlyKM->CurrentValue;
		$this->s1MonthlyKM->ViewCustomAttributes = "";

		// s2MonthlyAED
		$this->s2MonthlyAED->ViewValue = $this->s2MonthlyAED->CurrentValue;
		$this->s2MonthlyAED->ViewCustomAttributes = "";

		// s2MonthlyKM
		$this->s2MonthlyKM->ViewValue = $this->s2MonthlyKM->CurrentValue;
		$this->s2MonthlyKM->ViewCustomAttributes = "";

		// s3MonthlyAED
		$this->s3MonthlyAED->ViewValue = $this->s3MonthlyAED->CurrentValue;
		$this->s3MonthlyAED->ViewCustomAttributes = "";

		// s3MonthlyKM
		$this->s3MonthlyKM->ViewValue = $this->s3MonthlyKM->CurrentValue;
		$this->s3MonthlyKM->ViewCustomAttributes = "";

		// s4MonthlyAED
		$this->s4MonthlyAED->ViewValue = $this->s4MonthlyAED->CurrentValue;
		$this->s4MonthlyAED->ViewCustomAttributes = "";

		// s4MonthlyKM
		$this->s4MonthlyKM->ViewValue = $this->s4MonthlyKM->CurrentValue;
		$this->s4MonthlyKM->ViewCustomAttributes = "";

		// s5MonthlyAED
		$this->s5MonthlyAED->ViewValue = $this->s5MonthlyAED->CurrentValue;
		$this->s5MonthlyAED->ViewCustomAttributes = "";

		// s5MonthlyKM
		$this->s5MonthlyKM->ViewValue = $this->s5MonthlyKM->CurrentValue;
		$this->s5MonthlyKM->ViewCustomAttributes = "";

		// active
		if (strval($this->active->CurrentValue) <> "") {
			$this->active->ViewValue = $this->active->OptionCaption($this->active->CurrentValue);
		} else {
			$this->active->ViewValue = NULL;
		}
		$this->active->ViewCustomAttributes = "";

		// phase1OrangeCard
		$this->phase1OrangeCard->ViewValue = $this->phase1OrangeCard->CurrentValue;
		$this->phase1OrangeCard->ViewCustomAttributes = "";

		// phase1GPS
		$this->phase1GPS->ViewValue = $this->phase1GPS->CurrentValue;
		$this->phase1GPS->ViewCustomAttributes = "";

		// phase1DeliveryCharges
		$this->phase1DeliveryCharges->ViewValue = $this->phase1DeliveryCharges->CurrentValue;
		$this->phase1DeliveryCharges->ViewCustomAttributes = "";

		// phase1CollectionCharges
		$this->phase1CollectionCharges->ViewValue = $this->phase1CollectionCharges->CurrentValue;
		$this->phase1CollectionCharges->ViewCustomAttributes = "";

		// addon01KM
		$this->addon01KM->ViewValue = $this->addon01KM->CurrentValue;
		$this->addon01KM->ViewCustomAttributes = "";

		// addon01Price
		$this->addon01Price->ViewValue = $this->addon01Price->CurrentValue;
		$this->addon01Price->ViewCustomAttributes = "";

		// addon02KM
		$this->addon02KM->ViewValue = $this->addon02KM->CurrentValue;
		$this->addon02KM->ViewCustomAttributes = "";

		// addon02Price
		$this->addon02Price->ViewValue = $this->addon02Price->CurrentValue;
		$this->addon02Price->ViewCustomAttributes = "";

		// addon03KM
		$this->addon03KM->ViewValue = $this->addon03KM->CurrentValue;
		$this->addon03KM->ViewCustomAttributes = "";

		// addon03Price
		$this->addon03Price->ViewValue = $this->addon03Price->CurrentValue;
		$this->addon03Price->ViewCustomAttributes = "";

		// addon04KM
		$this->addon04KM->ViewValue = $this->addon04KM->CurrentValue;
		$this->addon04KM->ViewCustomAttributes = "";

		// addon04Price
		$this->addon04Price->ViewValue = $this->addon04Price->CurrentValue;
		$this->addon04Price->ViewCustomAttributes = "";

		// addon05KM
		$this->addon05KM->ViewValue = $this->addon05KM->CurrentValue;
		$this->addon05KM->ViewCustomAttributes = "";

		// addon05Price
		$this->addon05Price->ViewValue = $this->addon05Price->CurrentValue;
		$this->addon05Price->ViewCustomAttributes = "";

			// payDriveCarID
			$this->payDriveCarID->LinkCustomAttributes = "";
			$this->payDriveCarID->HrefValue = "";
			$this->payDriveCarID->TooltipValue = "";

			// bodyTypeID
			$this->bodyTypeID->LinkCustomAttributes = "";
			$this->bodyTypeID->HrefValue = "";
			$this->bodyTypeID->TooltipValue = "";

			// carTitle
			$this->carTitle->LinkCustomAttributes = "";
			$this->carTitle->HrefValue = "";
			$this->carTitle->TooltipValue = "";

			// slug
			$this->slug->LinkCustomAttributes = "";
			$this->slug->HrefValue = "";
			$this->slug->TooltipValue = "";

			// image
			$this->image->LinkCustomAttributes = "";
			$this->image->UploadPath = 'uploads/rentlease';
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
				$this->image->LinkAttrs["data-rel"] = "pay_as_you_drive_x_image";
				ew_AppendClass($this->image->LinkAttrs["class"], "ewLightbox");
			}

			// extraFeatures
			$this->extraFeatures->LinkCustomAttributes = "";
			$this->extraFeatures->HrefValue = "";
			$this->extraFeatures->TooltipValue = "";

			// noOfSeats
			$this->noOfSeats->LinkCustomAttributes = "";
			$this->noOfSeats->HrefValue = "";
			$this->noOfSeats->TooltipValue = "";

			// luggage
			$this->luggage->LinkCustomAttributes = "";
			$this->luggage->HrefValue = "";
			$this->luggage->TooltipValue = "";

			// transmissionID
			$this->transmissionID->LinkCustomAttributes = "";
			$this->transmissionID->HrefValue = "";
			$this->transmissionID->TooltipValue = "";

			// ac
			$this->ac->LinkCustomAttributes = "";
			$this->ac->HrefValue = "";
			$this->ac->TooltipValue = "";

			// noOfDoors
			$this->noOfDoors->LinkCustomAttributes = "";
			$this->noOfDoors->HrefValue = "";
			$this->noOfDoors->TooltipValue = "";

			// s1DailyAED
			$this->s1DailyAED->LinkCustomAttributes = "";
			$this->s1DailyAED->HrefValue = "";
			$this->s1DailyAED->TooltipValue = "";

			// s1DailyKM
			$this->s1DailyKM->LinkCustomAttributes = "";
			$this->s1DailyKM->HrefValue = "";
			$this->s1DailyKM->TooltipValue = "";

			// s2DailyAED
			$this->s2DailyAED->LinkCustomAttributes = "";
			$this->s2DailyAED->HrefValue = "";
			$this->s2DailyAED->TooltipValue = "";

			// s2DailyKM
			$this->s2DailyKM->LinkCustomAttributes = "";
			$this->s2DailyKM->HrefValue = "";
			$this->s2DailyKM->TooltipValue = "";

			// s3DailyAED
			$this->s3DailyAED->LinkCustomAttributes = "";
			$this->s3DailyAED->HrefValue = "";
			$this->s3DailyAED->TooltipValue = "";

			// s3DailyKM
			$this->s3DailyKM->LinkCustomAttributes = "";
			$this->s3DailyKM->HrefValue = "";
			$this->s3DailyKM->TooltipValue = "";

			// s4DailyAED
			$this->s4DailyAED->LinkCustomAttributes = "";
			$this->s4DailyAED->HrefValue = "";
			$this->s4DailyAED->TooltipValue = "";

			// s4DailyKM
			$this->s4DailyKM->LinkCustomAttributes = "";
			$this->s4DailyKM->HrefValue = "";
			$this->s4DailyKM->TooltipValue = "";

			// s5DailyAED
			$this->s5DailyAED->LinkCustomAttributes = "";
			$this->s5DailyAED->HrefValue = "";
			$this->s5DailyAED->TooltipValue = "";

			// s5DailyKM
			$this->s5DailyKM->LinkCustomAttributes = "";
			$this->s5DailyKM->HrefValue = "";
			$this->s5DailyKM->TooltipValue = "";

			// s1WeeklyAED
			$this->s1WeeklyAED->LinkCustomAttributes = "";
			$this->s1WeeklyAED->HrefValue = "";
			$this->s1WeeklyAED->TooltipValue = "";

			// s1WeeklyKM
			$this->s1WeeklyKM->LinkCustomAttributes = "";
			$this->s1WeeklyKM->HrefValue = "";
			$this->s1WeeklyKM->TooltipValue = "";

			// s2WeeklyAED
			$this->s2WeeklyAED->LinkCustomAttributes = "";
			$this->s2WeeklyAED->HrefValue = "";
			$this->s2WeeklyAED->TooltipValue = "";

			// s2WeeklyKM
			$this->s2WeeklyKM->LinkCustomAttributes = "";
			$this->s2WeeklyKM->HrefValue = "";
			$this->s2WeeklyKM->TooltipValue = "";

			// s3WeeklyAED
			$this->s3WeeklyAED->LinkCustomAttributes = "";
			$this->s3WeeklyAED->HrefValue = "";
			$this->s3WeeklyAED->TooltipValue = "";

			// s3WeeklyKM
			$this->s3WeeklyKM->LinkCustomAttributes = "";
			$this->s3WeeklyKM->HrefValue = "";
			$this->s3WeeklyKM->TooltipValue = "";

			// s4WeeklyAED
			$this->s4WeeklyAED->LinkCustomAttributes = "";
			$this->s4WeeklyAED->HrefValue = "";
			$this->s4WeeklyAED->TooltipValue = "";

			// s4WeeklyKM
			$this->s4WeeklyKM->LinkCustomAttributes = "";
			$this->s4WeeklyKM->HrefValue = "";
			$this->s4WeeklyKM->TooltipValue = "";

			// s5WeeklyAED
			$this->s5WeeklyAED->LinkCustomAttributes = "";
			$this->s5WeeklyAED->HrefValue = "";
			$this->s5WeeklyAED->TooltipValue = "";

			// s5WeeklyKM
			$this->s5WeeklyKM->LinkCustomAttributes = "";
			$this->s5WeeklyKM->HrefValue = "";
			$this->s5WeeklyKM->TooltipValue = "";

			// s1MonthlyAED
			$this->s1MonthlyAED->LinkCustomAttributes = "";
			$this->s1MonthlyAED->HrefValue = "";
			$this->s1MonthlyAED->TooltipValue = "";

			// s1MonthlyKM
			$this->s1MonthlyKM->LinkCustomAttributes = "";
			$this->s1MonthlyKM->HrefValue = "";
			$this->s1MonthlyKM->TooltipValue = "";

			// s2MonthlyAED
			$this->s2MonthlyAED->LinkCustomAttributes = "";
			$this->s2MonthlyAED->HrefValue = "";
			$this->s2MonthlyAED->TooltipValue = "";

			// s2MonthlyKM
			$this->s2MonthlyKM->LinkCustomAttributes = "";
			$this->s2MonthlyKM->HrefValue = "";
			$this->s2MonthlyKM->TooltipValue = "";

			// s3MonthlyAED
			$this->s3MonthlyAED->LinkCustomAttributes = "";
			$this->s3MonthlyAED->HrefValue = "";
			$this->s3MonthlyAED->TooltipValue = "";

			// s3MonthlyKM
			$this->s3MonthlyKM->LinkCustomAttributes = "";
			$this->s3MonthlyKM->HrefValue = "";
			$this->s3MonthlyKM->TooltipValue = "";

			// s4MonthlyAED
			$this->s4MonthlyAED->LinkCustomAttributes = "";
			$this->s4MonthlyAED->HrefValue = "";
			$this->s4MonthlyAED->TooltipValue = "";

			// s4MonthlyKM
			$this->s4MonthlyKM->LinkCustomAttributes = "";
			$this->s4MonthlyKM->HrefValue = "";
			$this->s4MonthlyKM->TooltipValue = "";

			// s5MonthlyAED
			$this->s5MonthlyAED->LinkCustomAttributes = "";
			$this->s5MonthlyAED->HrefValue = "";
			$this->s5MonthlyAED->TooltipValue = "";

			// s5MonthlyKM
			$this->s5MonthlyKM->LinkCustomAttributes = "";
			$this->s5MonthlyKM->HrefValue = "";
			$this->s5MonthlyKM->TooltipValue = "";

			// active
			$this->active->LinkCustomAttributes = "";
			$this->active->HrefValue = "";
			$this->active->TooltipValue = "";

			// phase1OrangeCard
			$this->phase1OrangeCard->LinkCustomAttributes = "";
			$this->phase1OrangeCard->HrefValue = "";
			$this->phase1OrangeCard->TooltipValue = "";

			// phase1GPS
			$this->phase1GPS->LinkCustomAttributes = "";
			$this->phase1GPS->HrefValue = "";
			$this->phase1GPS->TooltipValue = "";

			// phase1DeliveryCharges
			$this->phase1DeliveryCharges->LinkCustomAttributes = "";
			$this->phase1DeliveryCharges->HrefValue = "";
			$this->phase1DeliveryCharges->TooltipValue = "";

			// phase1CollectionCharges
			$this->phase1CollectionCharges->LinkCustomAttributes = "";
			$this->phase1CollectionCharges->HrefValue = "";
			$this->phase1CollectionCharges->TooltipValue = "";

			// addon01KM
			$this->addon01KM->LinkCustomAttributes = "";
			$this->addon01KM->HrefValue = "";
			$this->addon01KM->TooltipValue = "";

			// addon01Price
			$this->addon01Price->LinkCustomAttributes = "";
			$this->addon01Price->HrefValue = "";
			$this->addon01Price->TooltipValue = "";

			// addon02KM
			$this->addon02KM->LinkCustomAttributes = "";
			$this->addon02KM->HrefValue = "";
			$this->addon02KM->TooltipValue = "";

			// addon02Price
			$this->addon02Price->LinkCustomAttributes = "";
			$this->addon02Price->HrefValue = "";
			$this->addon02Price->TooltipValue = "";

			// addon03KM
			$this->addon03KM->LinkCustomAttributes = "";
			$this->addon03KM->HrefValue = "";
			$this->addon03KM->TooltipValue = "";

			// addon03Price
			$this->addon03Price->LinkCustomAttributes = "";
			$this->addon03Price->HrefValue = "";
			$this->addon03Price->TooltipValue = "";

			// addon04KM
			$this->addon04KM->LinkCustomAttributes = "";
			$this->addon04KM->HrefValue = "";
			$this->addon04KM->TooltipValue = "";

			// addon04Price
			$this->addon04Price->LinkCustomAttributes = "";
			$this->addon04Price->HrefValue = "";
			$this->addon04Price->TooltipValue = "";

			// addon05KM
			$this->addon05KM->LinkCustomAttributes = "";
			$this->addon05KM->HrefValue = "";
			$this->addon05KM->TooltipValue = "";

			// addon05Price
			$this->addon05Price->LinkCustomAttributes = "";
			$this->addon05Price->HrefValue = "";
			$this->addon05Price->TooltipValue = "";
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
		$item->Body = "<button id=\"emf_pay_as_you_drive\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_pay_as_you_drive',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.fpay_as_you_driveview,key:" . ew_ArrayToJsonAttr($this->RecKey) . ",sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("pay_as_you_drivelist.php"), "", $this->TableVar, TRUE);
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
		$pages->Add(5);
		$pages->Add(6);
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
if (!isset($pay_as_you_drive_view)) $pay_as_you_drive_view = new cpay_as_you_drive_view();

// Page init
$pay_as_you_drive_view->Page_Init();

// Page main
$pay_as_you_drive_view->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pay_as_you_drive_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($pay_as_you_drive->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "view";
var CurrentForm = fpay_as_you_driveview = new ew_Form("fpay_as_you_driveview", "view");

// Form_CustomValidate event
fpay_as_you_driveview.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fpay_as_you_driveview.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Multi-Page
fpay_as_you_driveview.MultiPage = new ew_MultiPage("fpay_as_you_driveview");

// Dynamic selection lists
fpay_as_you_driveview.Lists["x_bodyTypeID"] = {"LinkField":"x_bodyTypeID","Ajax":true,"AutoFill":false,"DisplayFields":["x_bodytype","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_bodytype"};
fpay_as_you_driveview.Lists["x_bodyTypeID"].Data = "<?php echo $pay_as_you_drive_view->bodyTypeID->LookupFilterQuery(FALSE, "view") ?>";
fpay_as_you_driveview.Lists["x_extraFeatures[]"] = {"LinkField":"x_featureID","Ajax":true,"AutoFill":false,"DisplayFields":["x_extraFeatures","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_extra_features"};
fpay_as_you_driveview.Lists["x_extraFeatures[]"].Data = "<?php echo $pay_as_you_drive_view->extraFeatures->LookupFilterQuery(FALSE, "view") ?>";
fpay_as_you_driveview.Lists["x_transmissionID"] = {"LinkField":"x_transmissionID","Ajax":true,"AutoFill":false,"DisplayFields":["x_transmission","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_transmission"};
fpay_as_you_driveview.Lists["x_transmissionID"].Data = "<?php echo $pay_as_you_drive_view->transmissionID->LookupFilterQuery(FALSE, "view") ?>";
fpay_as_you_driveview.Lists["x_ac[]"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fpay_as_you_driveview.Lists["x_ac[]"].Options = <?php echo json_encode($pay_as_you_drive_view->ac->Options()) ?>;
fpay_as_you_driveview.Lists["x_active"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fpay_as_you_driveview.Lists["x_active"].Options = <?php echo json_encode($pay_as_you_drive_view->active->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($pay_as_you_drive->Export == "") { ?>
<div class="ewToolbar">
<?php $pay_as_you_drive_view->ExportOptions->Render("body") ?>
<?php
	foreach ($pay_as_you_drive_view->OtherOptions as &$option)
		$option->Render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $pay_as_you_drive_view->ShowPageHeader(); ?>
<?php
$pay_as_you_drive_view->ShowMessage();
?>
<form name="fpay_as_you_driveview" id="fpay_as_you_driveview" class="form-inline ewForm ewViewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($pay_as_you_drive_view->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $pay_as_you_drive_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pay_as_you_drive">
<input type="hidden" name="modal" value="<?php echo intval($pay_as_you_drive_view->IsModal) ?>">
<?php if ($pay_as_you_drive->Export == "") { ?>
<div class="ewMultiPage">
<div class="nav-tabs-custom" id="pay_as_you_drive_view">
	<ul class="nav<?php echo $pay_as_you_drive_view->MultiPages->NavStyle() ?>">
		<li<?php echo $pay_as_you_drive_view->MultiPages->TabStyle("1") ?>><a href="#tab_pay_as_you_drive1" data-toggle="tab"><?php echo $pay_as_you_drive->PageCaption(1) ?></a></li>
		<li<?php echo $pay_as_you_drive_view->MultiPages->TabStyle("2") ?>><a href="#tab_pay_as_you_drive2" data-toggle="tab"><?php echo $pay_as_you_drive->PageCaption(2) ?></a></li>
		<li<?php echo $pay_as_you_drive_view->MultiPages->TabStyle("3") ?>><a href="#tab_pay_as_you_drive3" data-toggle="tab"><?php echo $pay_as_you_drive->PageCaption(3) ?></a></li>
		<li<?php echo $pay_as_you_drive_view->MultiPages->TabStyle("4") ?>><a href="#tab_pay_as_you_drive4" data-toggle="tab"><?php echo $pay_as_you_drive->PageCaption(4) ?></a></li>
		<li<?php echo $pay_as_you_drive_view->MultiPages->TabStyle("5") ?>><a href="#tab_pay_as_you_drive5" data-toggle="tab"><?php echo $pay_as_you_drive->PageCaption(5) ?></a></li>
		<li<?php echo $pay_as_you_drive_view->MultiPages->TabStyle("6") ?>><a href="#tab_pay_as_you_drive6" data-toggle="tab"><?php echo $pay_as_you_drive->PageCaption(6) ?></a></li>
	</ul>
	<div class="tab-content">
<?php } ?>
<?php if ($pay_as_you_drive->Export == "") { ?>
		<div class="tab-pane<?php echo $pay_as_you_drive_view->MultiPages->PageStyle("1") ?>" id="tab_pay_as_you_drive1">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($pay_as_you_drive->payDriveCarID->Visible) { // payDriveCarID ?>
	<tr id="r_payDriveCarID">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_payDriveCarID"><?php echo $pay_as_you_drive->payDriveCarID->FldCaption() ?></span></td>
		<td data-name="payDriveCarID"<?php echo $pay_as_you_drive->payDriveCarID->CellAttributes() ?>>
<span id="el_pay_as_you_drive_payDriveCarID" data-page="1">
<span<?php echo $pay_as_you_drive->payDriveCarID->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->payDriveCarID->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->bodyTypeID->Visible) { // bodyTypeID ?>
	<tr id="r_bodyTypeID">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_bodyTypeID"><?php echo $pay_as_you_drive->bodyTypeID->FldCaption() ?></span></td>
		<td data-name="bodyTypeID"<?php echo $pay_as_you_drive->bodyTypeID->CellAttributes() ?>>
<span id="el_pay_as_you_drive_bodyTypeID" data-page="1">
<span<?php echo $pay_as_you_drive->bodyTypeID->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->bodyTypeID->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->carTitle->Visible) { // carTitle ?>
	<tr id="r_carTitle">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_carTitle"><?php echo $pay_as_you_drive->carTitle->FldCaption() ?></span></td>
		<td data-name="carTitle"<?php echo $pay_as_you_drive->carTitle->CellAttributes() ?>>
<span id="el_pay_as_you_drive_carTitle" data-page="1">
<span<?php echo $pay_as_you_drive->carTitle->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->carTitle->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->slug->Visible) { // slug ?>
	<tr id="r_slug">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_slug"><?php echo $pay_as_you_drive->slug->FldCaption() ?></span></td>
		<td data-name="slug"<?php echo $pay_as_you_drive->slug->CellAttributes() ?>>
<span id="el_pay_as_you_drive_slug" data-page="1">
<span<?php echo $pay_as_you_drive->slug->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->slug->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->image->Visible) { // image ?>
	<tr id="r_image">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_image"><?php echo $pay_as_you_drive->image->FldCaption() ?></span></td>
		<td data-name="image"<?php echo $pay_as_you_drive->image->CellAttributes() ?>>
<span id="el_pay_as_you_drive_image" data-page="1">
<span>
<?php echo ew_GetFileViewTag($pay_as_you_drive->image, $pay_as_you_drive->image->ViewValue) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->extraFeatures->Visible) { // extraFeatures ?>
	<tr id="r_extraFeatures">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_extraFeatures"><?php echo $pay_as_you_drive->extraFeatures->FldCaption() ?></span></td>
		<td data-name="extraFeatures"<?php echo $pay_as_you_drive->extraFeatures->CellAttributes() ?>>
<span id="el_pay_as_you_drive_extraFeatures" data-page="1">
<span<?php echo $pay_as_you_drive->extraFeatures->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->extraFeatures->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->noOfSeats->Visible) { // noOfSeats ?>
	<tr id="r_noOfSeats">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_noOfSeats"><?php echo $pay_as_you_drive->noOfSeats->FldCaption() ?></span></td>
		<td data-name="noOfSeats"<?php echo $pay_as_you_drive->noOfSeats->CellAttributes() ?>>
<span id="el_pay_as_you_drive_noOfSeats" data-page="1">
<span<?php echo $pay_as_you_drive->noOfSeats->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->noOfSeats->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->luggage->Visible) { // luggage ?>
	<tr id="r_luggage">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_luggage"><?php echo $pay_as_you_drive->luggage->FldCaption() ?></span></td>
		<td data-name="luggage"<?php echo $pay_as_you_drive->luggage->CellAttributes() ?>>
<span id="el_pay_as_you_drive_luggage" data-page="1">
<span<?php echo $pay_as_you_drive->luggage->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->luggage->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->transmissionID->Visible) { // transmissionID ?>
	<tr id="r_transmissionID">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_transmissionID"><?php echo $pay_as_you_drive->transmissionID->FldCaption() ?></span></td>
		<td data-name="transmissionID"<?php echo $pay_as_you_drive->transmissionID->CellAttributes() ?>>
<span id="el_pay_as_you_drive_transmissionID" data-page="1">
<span<?php echo $pay_as_you_drive->transmissionID->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->transmissionID->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->ac->Visible) { // ac ?>
	<tr id="r_ac">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_ac"><?php echo $pay_as_you_drive->ac->FldCaption() ?></span></td>
		<td data-name="ac"<?php echo $pay_as_you_drive->ac->CellAttributes() ?>>
<span id="el_pay_as_you_drive_ac" data-page="1">
<span<?php echo $pay_as_you_drive->ac->ViewAttributes() ?>>
<?php if (ew_ConvertToBool($pay_as_you_drive->ac->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $pay_as_you_drive->ac->ViewValue ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $pay_as_you_drive->ac->ViewValue ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->noOfDoors->Visible) { // noOfDoors ?>
	<tr id="r_noOfDoors">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_noOfDoors"><?php echo $pay_as_you_drive->noOfDoors->FldCaption() ?></span></td>
		<td data-name="noOfDoors"<?php echo $pay_as_you_drive->noOfDoors->CellAttributes() ?>>
<span id="el_pay_as_you_drive_noOfDoors" data-page="1">
<span<?php echo $pay_as_you_drive->noOfDoors->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->noOfDoors->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->active->Visible) { // active ?>
	<tr id="r_active">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_active"><?php echo $pay_as_you_drive->active->FldCaption() ?></span></td>
		<td data-name="active"<?php echo $pay_as_you_drive->active->CellAttributes() ?>>
<span id="el_pay_as_you_drive_active" data-page="1">
<span<?php echo $pay_as_you_drive->active->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->active->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($pay_as_you_drive->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($pay_as_you_drive->Export == "") { ?>
		<div class="tab-pane<?php echo $pay_as_you_drive_view->MultiPages->PageStyle("2") ?>" id="tab_pay_as_you_drive2">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($pay_as_you_drive->s1DailyAED->Visible) { // s1DailyAED ?>
	<tr id="r_s1DailyAED">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s1DailyAED"><?php echo $pay_as_you_drive->s1DailyAED->FldCaption() ?></span></td>
		<td data-name="s1DailyAED"<?php echo $pay_as_you_drive->s1DailyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s1DailyAED" data-page="2">
<span<?php echo $pay_as_you_drive->s1DailyAED->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s1DailyAED->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->s1DailyKM->Visible) { // s1DailyKM ?>
	<tr id="r_s1DailyKM">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s1DailyKM"><?php echo $pay_as_you_drive->s1DailyKM->FldCaption() ?></span></td>
		<td data-name="s1DailyKM"<?php echo $pay_as_you_drive->s1DailyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s1DailyKM" data-page="2">
<span<?php echo $pay_as_you_drive->s1DailyKM->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s1DailyKM->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->s2DailyAED->Visible) { // s2DailyAED ?>
	<tr id="r_s2DailyAED">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s2DailyAED"><?php echo $pay_as_you_drive->s2DailyAED->FldCaption() ?></span></td>
		<td data-name="s2DailyAED"<?php echo $pay_as_you_drive->s2DailyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s2DailyAED" data-page="2">
<span<?php echo $pay_as_you_drive->s2DailyAED->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s2DailyAED->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->s2DailyKM->Visible) { // s2DailyKM ?>
	<tr id="r_s2DailyKM">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s2DailyKM"><?php echo $pay_as_you_drive->s2DailyKM->FldCaption() ?></span></td>
		<td data-name="s2DailyKM"<?php echo $pay_as_you_drive->s2DailyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s2DailyKM" data-page="2">
<span<?php echo $pay_as_you_drive->s2DailyKM->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s2DailyKM->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->s3DailyAED->Visible) { // s3DailyAED ?>
	<tr id="r_s3DailyAED">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s3DailyAED"><?php echo $pay_as_you_drive->s3DailyAED->FldCaption() ?></span></td>
		<td data-name="s3DailyAED"<?php echo $pay_as_you_drive->s3DailyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s3DailyAED" data-page="2">
<span<?php echo $pay_as_you_drive->s3DailyAED->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s3DailyAED->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->s3DailyKM->Visible) { // s3DailyKM ?>
	<tr id="r_s3DailyKM">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s3DailyKM"><?php echo $pay_as_you_drive->s3DailyKM->FldCaption() ?></span></td>
		<td data-name="s3DailyKM"<?php echo $pay_as_you_drive->s3DailyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s3DailyKM" data-page="2">
<span<?php echo $pay_as_you_drive->s3DailyKM->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s3DailyKM->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->s4DailyAED->Visible) { // s4DailyAED ?>
	<tr id="r_s4DailyAED">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s4DailyAED"><?php echo $pay_as_you_drive->s4DailyAED->FldCaption() ?></span></td>
		<td data-name="s4DailyAED"<?php echo $pay_as_you_drive->s4DailyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s4DailyAED" data-page="2">
<span<?php echo $pay_as_you_drive->s4DailyAED->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s4DailyAED->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->s4DailyKM->Visible) { // s4DailyKM ?>
	<tr id="r_s4DailyKM">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s4DailyKM"><?php echo $pay_as_you_drive->s4DailyKM->FldCaption() ?></span></td>
		<td data-name="s4DailyKM"<?php echo $pay_as_you_drive->s4DailyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s4DailyKM" data-page="2">
<span<?php echo $pay_as_you_drive->s4DailyKM->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s4DailyKM->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->s5DailyAED->Visible) { // s5DailyAED ?>
	<tr id="r_s5DailyAED">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s5DailyAED"><?php echo $pay_as_you_drive->s5DailyAED->FldCaption() ?></span></td>
		<td data-name="s5DailyAED"<?php echo $pay_as_you_drive->s5DailyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s5DailyAED" data-page="2">
<span<?php echo $pay_as_you_drive->s5DailyAED->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s5DailyAED->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->s5DailyKM->Visible) { // s5DailyKM ?>
	<tr id="r_s5DailyKM">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s5DailyKM"><?php echo $pay_as_you_drive->s5DailyKM->FldCaption() ?></span></td>
		<td data-name="s5DailyKM"<?php echo $pay_as_you_drive->s5DailyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s5DailyKM" data-page="2">
<span<?php echo $pay_as_you_drive->s5DailyKM->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s5DailyKM->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($pay_as_you_drive->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($pay_as_you_drive->Export == "") { ?>
		<div class="tab-pane<?php echo $pay_as_you_drive_view->MultiPages->PageStyle("3") ?>" id="tab_pay_as_you_drive3">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($pay_as_you_drive->s1WeeklyAED->Visible) { // s1WeeklyAED ?>
	<tr id="r_s1WeeklyAED">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s1WeeklyAED"><?php echo $pay_as_you_drive->s1WeeklyAED->FldCaption() ?></span></td>
		<td data-name="s1WeeklyAED"<?php echo $pay_as_you_drive->s1WeeklyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s1WeeklyAED" data-page="3">
<span<?php echo $pay_as_you_drive->s1WeeklyAED->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s1WeeklyAED->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->s1WeeklyKM->Visible) { // s1WeeklyKM ?>
	<tr id="r_s1WeeklyKM">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s1WeeklyKM"><?php echo $pay_as_you_drive->s1WeeklyKM->FldCaption() ?></span></td>
		<td data-name="s1WeeklyKM"<?php echo $pay_as_you_drive->s1WeeklyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s1WeeklyKM" data-page="3">
<span<?php echo $pay_as_you_drive->s1WeeklyKM->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s1WeeklyKM->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->s2WeeklyAED->Visible) { // s2WeeklyAED ?>
	<tr id="r_s2WeeklyAED">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s2WeeklyAED"><?php echo $pay_as_you_drive->s2WeeklyAED->FldCaption() ?></span></td>
		<td data-name="s2WeeklyAED"<?php echo $pay_as_you_drive->s2WeeklyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s2WeeklyAED" data-page="3">
<span<?php echo $pay_as_you_drive->s2WeeklyAED->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s2WeeklyAED->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->s2WeeklyKM->Visible) { // s2WeeklyKM ?>
	<tr id="r_s2WeeklyKM">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s2WeeklyKM"><?php echo $pay_as_you_drive->s2WeeklyKM->FldCaption() ?></span></td>
		<td data-name="s2WeeklyKM"<?php echo $pay_as_you_drive->s2WeeklyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s2WeeklyKM" data-page="3">
<span<?php echo $pay_as_you_drive->s2WeeklyKM->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s2WeeklyKM->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->s3WeeklyAED->Visible) { // s3WeeklyAED ?>
	<tr id="r_s3WeeklyAED">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s3WeeklyAED"><?php echo $pay_as_you_drive->s3WeeklyAED->FldCaption() ?></span></td>
		<td data-name="s3WeeklyAED"<?php echo $pay_as_you_drive->s3WeeklyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s3WeeklyAED" data-page="3">
<span<?php echo $pay_as_you_drive->s3WeeklyAED->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s3WeeklyAED->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->s3WeeklyKM->Visible) { // s3WeeklyKM ?>
	<tr id="r_s3WeeklyKM">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s3WeeklyKM"><?php echo $pay_as_you_drive->s3WeeklyKM->FldCaption() ?></span></td>
		<td data-name="s3WeeklyKM"<?php echo $pay_as_you_drive->s3WeeklyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s3WeeklyKM" data-page="3">
<span<?php echo $pay_as_you_drive->s3WeeklyKM->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s3WeeklyKM->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->s4WeeklyAED->Visible) { // s4WeeklyAED ?>
	<tr id="r_s4WeeklyAED">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s4WeeklyAED"><?php echo $pay_as_you_drive->s4WeeklyAED->FldCaption() ?></span></td>
		<td data-name="s4WeeklyAED"<?php echo $pay_as_you_drive->s4WeeklyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s4WeeklyAED" data-page="3">
<span<?php echo $pay_as_you_drive->s4WeeklyAED->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s4WeeklyAED->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->s4WeeklyKM->Visible) { // s4WeeklyKM ?>
	<tr id="r_s4WeeklyKM">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s4WeeklyKM"><?php echo $pay_as_you_drive->s4WeeklyKM->FldCaption() ?></span></td>
		<td data-name="s4WeeklyKM"<?php echo $pay_as_you_drive->s4WeeklyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s4WeeklyKM" data-page="3">
<span<?php echo $pay_as_you_drive->s4WeeklyKM->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s4WeeklyKM->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->s5WeeklyAED->Visible) { // s5WeeklyAED ?>
	<tr id="r_s5WeeklyAED">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s5WeeklyAED"><?php echo $pay_as_you_drive->s5WeeklyAED->FldCaption() ?></span></td>
		<td data-name="s5WeeklyAED"<?php echo $pay_as_you_drive->s5WeeklyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s5WeeklyAED" data-page="3">
<span<?php echo $pay_as_you_drive->s5WeeklyAED->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s5WeeklyAED->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->s5WeeklyKM->Visible) { // s5WeeklyKM ?>
	<tr id="r_s5WeeklyKM">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s5WeeklyKM"><?php echo $pay_as_you_drive->s5WeeklyKM->FldCaption() ?></span></td>
		<td data-name="s5WeeklyKM"<?php echo $pay_as_you_drive->s5WeeklyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s5WeeklyKM" data-page="3">
<span<?php echo $pay_as_you_drive->s5WeeklyKM->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s5WeeklyKM->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($pay_as_you_drive->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($pay_as_you_drive->Export == "") { ?>
		<div class="tab-pane<?php echo $pay_as_you_drive_view->MultiPages->PageStyle("4") ?>" id="tab_pay_as_you_drive4">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($pay_as_you_drive->s1MonthlyAED->Visible) { // s1MonthlyAED ?>
	<tr id="r_s1MonthlyAED">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s1MonthlyAED"><?php echo $pay_as_you_drive->s1MonthlyAED->FldCaption() ?></span></td>
		<td data-name="s1MonthlyAED"<?php echo $pay_as_you_drive->s1MonthlyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s1MonthlyAED" data-page="4">
<span<?php echo $pay_as_you_drive->s1MonthlyAED->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s1MonthlyAED->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->s1MonthlyKM->Visible) { // s1MonthlyKM ?>
	<tr id="r_s1MonthlyKM">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s1MonthlyKM"><?php echo $pay_as_you_drive->s1MonthlyKM->FldCaption() ?></span></td>
		<td data-name="s1MonthlyKM"<?php echo $pay_as_you_drive->s1MonthlyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s1MonthlyKM" data-page="4">
<span<?php echo $pay_as_you_drive->s1MonthlyKM->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s1MonthlyKM->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->s2MonthlyAED->Visible) { // s2MonthlyAED ?>
	<tr id="r_s2MonthlyAED">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s2MonthlyAED"><?php echo $pay_as_you_drive->s2MonthlyAED->FldCaption() ?></span></td>
		<td data-name="s2MonthlyAED"<?php echo $pay_as_you_drive->s2MonthlyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s2MonthlyAED" data-page="4">
<span<?php echo $pay_as_you_drive->s2MonthlyAED->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s2MonthlyAED->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->s2MonthlyKM->Visible) { // s2MonthlyKM ?>
	<tr id="r_s2MonthlyKM">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s2MonthlyKM"><?php echo $pay_as_you_drive->s2MonthlyKM->FldCaption() ?></span></td>
		<td data-name="s2MonthlyKM"<?php echo $pay_as_you_drive->s2MonthlyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s2MonthlyKM" data-page="4">
<span<?php echo $pay_as_you_drive->s2MonthlyKM->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s2MonthlyKM->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->s3MonthlyAED->Visible) { // s3MonthlyAED ?>
	<tr id="r_s3MonthlyAED">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s3MonthlyAED"><?php echo $pay_as_you_drive->s3MonthlyAED->FldCaption() ?></span></td>
		<td data-name="s3MonthlyAED"<?php echo $pay_as_you_drive->s3MonthlyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s3MonthlyAED" data-page="4">
<span<?php echo $pay_as_you_drive->s3MonthlyAED->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s3MonthlyAED->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->s3MonthlyKM->Visible) { // s3MonthlyKM ?>
	<tr id="r_s3MonthlyKM">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s3MonthlyKM"><?php echo $pay_as_you_drive->s3MonthlyKM->FldCaption() ?></span></td>
		<td data-name="s3MonthlyKM"<?php echo $pay_as_you_drive->s3MonthlyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s3MonthlyKM" data-page="4">
<span<?php echo $pay_as_you_drive->s3MonthlyKM->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s3MonthlyKM->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->s4MonthlyAED->Visible) { // s4MonthlyAED ?>
	<tr id="r_s4MonthlyAED">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s4MonthlyAED"><?php echo $pay_as_you_drive->s4MonthlyAED->FldCaption() ?></span></td>
		<td data-name="s4MonthlyAED"<?php echo $pay_as_you_drive->s4MonthlyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s4MonthlyAED" data-page="4">
<span<?php echo $pay_as_you_drive->s4MonthlyAED->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s4MonthlyAED->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->s4MonthlyKM->Visible) { // s4MonthlyKM ?>
	<tr id="r_s4MonthlyKM">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s4MonthlyKM"><?php echo $pay_as_you_drive->s4MonthlyKM->FldCaption() ?></span></td>
		<td data-name="s4MonthlyKM"<?php echo $pay_as_you_drive->s4MonthlyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s4MonthlyKM" data-page="4">
<span<?php echo $pay_as_you_drive->s4MonthlyKM->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s4MonthlyKM->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->s5MonthlyAED->Visible) { // s5MonthlyAED ?>
	<tr id="r_s5MonthlyAED">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s5MonthlyAED"><?php echo $pay_as_you_drive->s5MonthlyAED->FldCaption() ?></span></td>
		<td data-name="s5MonthlyAED"<?php echo $pay_as_you_drive->s5MonthlyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s5MonthlyAED" data-page="4">
<span<?php echo $pay_as_you_drive->s5MonthlyAED->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s5MonthlyAED->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->s5MonthlyKM->Visible) { // s5MonthlyKM ?>
	<tr id="r_s5MonthlyKM">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_s5MonthlyKM"><?php echo $pay_as_you_drive->s5MonthlyKM->FldCaption() ?></span></td>
		<td data-name="s5MonthlyKM"<?php echo $pay_as_you_drive->s5MonthlyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s5MonthlyKM" data-page="4">
<span<?php echo $pay_as_you_drive->s5MonthlyKM->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->s5MonthlyKM->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($pay_as_you_drive->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($pay_as_you_drive->Export == "") { ?>
		<div class="tab-pane<?php echo $pay_as_you_drive_view->MultiPages->PageStyle("5") ?>" id="tab_pay_as_you_drive5">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($pay_as_you_drive->phase1OrangeCard->Visible) { // phase1OrangeCard ?>
	<tr id="r_phase1OrangeCard">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_phase1OrangeCard"><?php echo $pay_as_you_drive->phase1OrangeCard->FldCaption() ?></span></td>
		<td data-name="phase1OrangeCard"<?php echo $pay_as_you_drive->phase1OrangeCard->CellAttributes() ?>>
<span id="el_pay_as_you_drive_phase1OrangeCard" data-page="5">
<span<?php echo $pay_as_you_drive->phase1OrangeCard->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->phase1OrangeCard->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->phase1GPS->Visible) { // phase1GPS ?>
	<tr id="r_phase1GPS">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_phase1GPS"><?php echo $pay_as_you_drive->phase1GPS->FldCaption() ?></span></td>
		<td data-name="phase1GPS"<?php echo $pay_as_you_drive->phase1GPS->CellAttributes() ?>>
<span id="el_pay_as_you_drive_phase1GPS" data-page="5">
<span<?php echo $pay_as_you_drive->phase1GPS->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->phase1GPS->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->phase1DeliveryCharges->Visible) { // phase1DeliveryCharges ?>
	<tr id="r_phase1DeliveryCharges">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_phase1DeliveryCharges"><?php echo $pay_as_you_drive->phase1DeliveryCharges->FldCaption() ?></span></td>
		<td data-name="phase1DeliveryCharges"<?php echo $pay_as_you_drive->phase1DeliveryCharges->CellAttributes() ?>>
<span id="el_pay_as_you_drive_phase1DeliveryCharges" data-page="5">
<span<?php echo $pay_as_you_drive->phase1DeliveryCharges->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->phase1DeliveryCharges->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->phase1CollectionCharges->Visible) { // phase1CollectionCharges ?>
	<tr id="r_phase1CollectionCharges">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_phase1CollectionCharges"><?php echo $pay_as_you_drive->phase1CollectionCharges->FldCaption() ?></span></td>
		<td data-name="phase1CollectionCharges"<?php echo $pay_as_you_drive->phase1CollectionCharges->CellAttributes() ?>>
<span id="el_pay_as_you_drive_phase1CollectionCharges" data-page="5">
<span<?php echo $pay_as_you_drive->phase1CollectionCharges->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->phase1CollectionCharges->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($pay_as_you_drive->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($pay_as_you_drive->Export == "") { ?>
		<div class="tab-pane<?php echo $pay_as_you_drive_view->MultiPages->PageStyle("6") ?>" id="tab_pay_as_you_drive6">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($pay_as_you_drive->addon01KM->Visible) { // addon01KM ?>
	<tr id="r_addon01KM">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_addon01KM"><?php echo $pay_as_you_drive->addon01KM->FldCaption() ?></span></td>
		<td data-name="addon01KM"<?php echo $pay_as_you_drive->addon01KM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_addon01KM" data-page="6">
<span<?php echo $pay_as_you_drive->addon01KM->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->addon01KM->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->addon01Price->Visible) { // addon01Price ?>
	<tr id="r_addon01Price">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_addon01Price"><?php echo $pay_as_you_drive->addon01Price->FldCaption() ?></span></td>
		<td data-name="addon01Price"<?php echo $pay_as_you_drive->addon01Price->CellAttributes() ?>>
<span id="el_pay_as_you_drive_addon01Price" data-page="6">
<span<?php echo $pay_as_you_drive->addon01Price->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->addon01Price->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->addon02KM->Visible) { // addon02KM ?>
	<tr id="r_addon02KM">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_addon02KM"><?php echo $pay_as_you_drive->addon02KM->FldCaption() ?></span></td>
		<td data-name="addon02KM"<?php echo $pay_as_you_drive->addon02KM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_addon02KM" data-page="6">
<span<?php echo $pay_as_you_drive->addon02KM->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->addon02KM->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->addon02Price->Visible) { // addon02Price ?>
	<tr id="r_addon02Price">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_addon02Price"><?php echo $pay_as_you_drive->addon02Price->FldCaption() ?></span></td>
		<td data-name="addon02Price"<?php echo $pay_as_you_drive->addon02Price->CellAttributes() ?>>
<span id="el_pay_as_you_drive_addon02Price" data-page="6">
<span<?php echo $pay_as_you_drive->addon02Price->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->addon02Price->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->addon03KM->Visible) { // addon03KM ?>
	<tr id="r_addon03KM">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_addon03KM"><?php echo $pay_as_you_drive->addon03KM->FldCaption() ?></span></td>
		<td data-name="addon03KM"<?php echo $pay_as_you_drive->addon03KM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_addon03KM" data-page="6">
<span<?php echo $pay_as_you_drive->addon03KM->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->addon03KM->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->addon03Price->Visible) { // addon03Price ?>
	<tr id="r_addon03Price">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_addon03Price"><?php echo $pay_as_you_drive->addon03Price->FldCaption() ?></span></td>
		<td data-name="addon03Price"<?php echo $pay_as_you_drive->addon03Price->CellAttributes() ?>>
<span id="el_pay_as_you_drive_addon03Price" data-page="6">
<span<?php echo $pay_as_you_drive->addon03Price->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->addon03Price->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->addon04KM->Visible) { // addon04KM ?>
	<tr id="r_addon04KM">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_addon04KM"><?php echo $pay_as_you_drive->addon04KM->FldCaption() ?></span></td>
		<td data-name="addon04KM"<?php echo $pay_as_you_drive->addon04KM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_addon04KM" data-page="6">
<span<?php echo $pay_as_you_drive->addon04KM->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->addon04KM->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->addon04Price->Visible) { // addon04Price ?>
	<tr id="r_addon04Price">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_addon04Price"><?php echo $pay_as_you_drive->addon04Price->FldCaption() ?></span></td>
		<td data-name="addon04Price"<?php echo $pay_as_you_drive->addon04Price->CellAttributes() ?>>
<span id="el_pay_as_you_drive_addon04Price" data-page="6">
<span<?php echo $pay_as_you_drive->addon04Price->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->addon04Price->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->addon05KM->Visible) { // addon05KM ?>
	<tr id="r_addon05KM">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_addon05KM"><?php echo $pay_as_you_drive->addon05KM->FldCaption() ?></span></td>
		<td data-name="addon05KM"<?php echo $pay_as_you_drive->addon05KM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_addon05KM" data-page="6">
<span<?php echo $pay_as_you_drive->addon05KM->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->addon05KM->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pay_as_you_drive->addon05Price->Visible) { // addon05Price ?>
	<tr id="r_addon05Price">
		<td class="col-sm-2"><span id="elh_pay_as_you_drive_addon05Price"><?php echo $pay_as_you_drive->addon05Price->FldCaption() ?></span></td>
		<td data-name="addon05Price"<?php echo $pay_as_you_drive->addon05Price->CellAttributes() ?>>
<span id="el_pay_as_you_drive_addon05Price" data-page="6">
<span<?php echo $pay_as_you_drive->addon05Price->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->addon05Price->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($pay_as_you_drive->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($pay_as_you_drive->Export == "") { ?>
	</div>
</div>
</div>
<?php } ?>
</form>
<?php if ($pay_as_you_drive->Export == "") { ?>
<script type="text/javascript">
fpay_as_you_driveview.Init();
</script>
<?php } ?>
<?php
$pay_as_you_drive_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($pay_as_you_drive->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$pay_as_you_drive_view->Page_Terminate();
?>
