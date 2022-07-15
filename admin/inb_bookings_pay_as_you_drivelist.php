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

$inb_bookings_pay_as_you_drive_list = NULL; // Initialize page object first

class cinb_bookings_pay_as_you_drive_list extends cinb_bookings_pay_as_you_drive {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'inb_bookings_pay_as_you_drive';

	// Page object name
	var $PageObjName = 'inb_bookings_pay_as_you_drive_list';

	// Grid form hidden field names
	var $FormName = 'finb_bookings_pay_as_you_drivelist';
	var $FormActionName = 'k_action';
	var $FormKeyName = 'k_key';
	var $FormOldKeyName = 'k_oldkey';
	var $FormBlankRowName = 'k_blankrow';
	var $FormKeyCountName = 'key_count';

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

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "inb_bookings_pay_as_you_driveadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "inb_bookings_pay_as_you_drivedelete.php";
		$this->MultiUpdateUrl = "inb_bookings_pay_as_you_driveupdate.php";

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

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

		// List options
		$this->ListOptions = new cListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ewExportOption";

		// Other options
		$this->OtherOptions['addedit'] = new cListOptions();
		$this->OtherOptions['addedit']->Tag = "div";
		$this->OtherOptions['addedit']->TagClassName = "ewAddEditOption";
		$this->OtherOptions['detail'] = new cListOptions();
		$this->OtherOptions['detail']->Tag = "div";
		$this->OtherOptions['detail']->TagClassName = "ewDetailOption";
		$this->OtherOptions['action'] = new cListOptions();
		$this->OtherOptions['action']->Tag = "div";
		$this->OtherOptions['action']->TagClassName = "ewActionOption";

		// Filter options
		$this->FilterOptions = new cListOptions();
		$this->FilterOptions->Tag = "div";
		$this->FilterOptions->TagClassName = "ewFilterOption finb_bookings_pay_as_you_drivelistsrch";

		// List actions
		$this->ListActions = new cListActions();
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
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			$this->Page_Terminate(ew_GetUrl("index.php"));
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

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();

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
		$this->rentalAmount->SetVisibility();
		$this->totalAmount->SetVisibility();
		$this->grandTotal->SetVisibility();
		$this->paymentMethod->SetVisibility();
		$this->dateCreated->SetVisibility();

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

		// Setup other options
		$this->SetupOtherOptions();

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->Add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == EW_ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions->Items["checkbox"]->Visible = TRUE;
				break;
			}
		}
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
			ew_SaveDebugMsg();
			header("Location: " . $url);
		}
		exit();
	}

	// Class variables
	var $ListOptions; // List options
	var $ExportOptions; // Export options
	var $SearchOptions; // Search options
	var $OtherOptions = array(); // Other options
	var $FilterOptions; // Filter options
	var $ListActions; // List actions
	var $SelectedCount = 0;
	var $SelectedIndex = 0;
	var $DisplayRecs = 30;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $Pager;
	var $AutoHidePager = EW_AUTO_HIDE_PAGER;
	var $AutoHidePageSizeSelector = EW_AUTO_HIDE_PAGE_SIZE_SELECTOR;
	var $DefaultSearchWhere = ""; // Default search WHERE clause
	var $SearchWhere = ""; // Search WHERE clause
	var $RecCnt = 0; // Record count
	var $EditRowCnt;
	var $StartRowCnt = 1;
	var $RowCnt = 0;
	var $Attrs = array(); // Row attributes and cell attributes
	var $RowIndex = 0; // Row index
	var $KeyCount = 0; // Key count
	var $RowAction = ""; // Row action
	var $RowOldKey = ""; // Row old key (for copy)
	var $RecPerRow = 0;
	var $MultiColumnClass;
	var $MultiColumnEditClass = "col-sm-12";
	var $MultiColumnCnt = 12;
	var $MultiColumnEditCnt = 12;
	var $GridCnt = 0;
	var $ColCnt = 0;
	var $DbMasterFilter = ""; // Master filter
	var $DbDetailFilter = ""; // Detail filter
	var $MasterRecordExists;
	var $MultiSelectKey;
	var $Command;
	var $RestoreSearch = FALSE;
	var $DetailPages;
	var $Recordset;
	var $OldRecordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $EW_EXPORT;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";

		// Get command
		$this->Command = strtolower(@$_GET["cmd"]);
		if ($this->IsPageRequest()) { // Validate request

			// Process list action first
			if ($this->ProcessListAction()) // Ajax request
				$this->Page_Terminate();

			// Handle reset command
			$this->ResetCmd();

			// Set up Breadcrumb
			if ($this->Export == "")
				$this->SetupBreadcrumb();

			// Hide list options
			if ($this->Export <> "") {
				$this->ListOptions->HideAllOptions(array("sequence"));
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Hide options
			if ($this->Export <> "" || $this->CurrentAction <> "") {
				$this->ExportOptions->HideAllOptions();
				$this->FilterOptions->HideAllOptions();
			}

			// Hide other options
			if ($this->Export <> "") {
				foreach ($this->OtherOptions as &$option)
					$option->HideAllOptions();
			}

			// Get default search criteria
			ew_AddFilter($this->DefaultSearchWhere, $this->BasicSearchWhere(TRUE));
			ew_AddFilter($this->DefaultSearchWhere, $this->AdvancedSearchWhere(TRUE));

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values

			// Process filter list
			$this->ProcessFilterList();
			if (!$this->ValidateSearch())
				$this->setFailureMessage($gsSearchError);

			// Restore search parms from Session if not searching / reset / export
			if (($this->Export <> "" || $this->Command <> "search" && $this->Command <> "reset" && $this->Command <> "resetall") && $this->Command <> "json" && $this->CheckSearchParms())
				$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetupSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($this->Command <> "json" && $this->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 30; // Load default
		}

		// Load Sorting Order
		if ($this->Command <> "json")
			$this->LoadSortOrder();

		// Load search default if no existing search criteria
		if (!$this->CheckSearchParms()) {

			// Load basic search from default
			$this->BasicSearch->LoadDefault();
			if ($this->BasicSearch->Keyword != "")
				$sSrchBasic = $this->BasicSearchWhere();

			// Load advanced search from default
			if ($this->LoadAdvancedSearchDefault()) {
				$sSrchAdvanced = $this->AdvancedSearchWhere();
			}
		}

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif ($this->Command <> "json") {
			$this->SearchWhere = $this->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSQL = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $sFilter;
		} else {
			$this->setSessionWhere($sFilter);
			$this->CurrentFilter = "";
		}

		// Export data only
		if ($this->CustomExport == "" && in_array($this->Export, array_keys($EW_EXPORT))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}

		// Load record count first
		if (!$this->IsAddOrEdit()) {
			$bSelectLimit = $this->UseSelectLimit;
			if ($bSelectLimit) {
				$this->TotalRecs = $this->ListRecordCount();
			} else {
				if ($this->Recordset = $this->LoadRecordset())
					$this->TotalRecs = $this->Recordset->RecordCount();
			}
		}

		// Search options
		$this->SetupSearchOptions();
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue($this->FormKeyName));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $this->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue($this->FormKeyName));
		}
		return $sWrkFilter;
	}

	// Set up key values
	function SetupKeyValues($key) {
		$arrKeyFlds = explode($GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"], $key);
		if (count($arrKeyFlds) >= 1) {
			$this->bookingID->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->bookingID->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Get list of filters
	function GetFilterList() {
		global $UserProfile;

		// Initialize
		$sFilterList = "";
		$sSavedFilterList = "";

		// Load server side filters
		if (EW_SEARCH_FILTER_OPTION == "Server" && isset($UserProfile))
			$sSavedFilterList = $UserProfile->GetSearchFilters(CurrentUserName(), "finb_bookings_pay_as_you_drivelistsrch");
		$sFilterList = ew_Concat($sFilterList, $this->bookingID->AdvancedSearch->ToJson(), ","); // Field bookingID
		$sFilterList = ew_Concat($sFilterList, $this->bookingNumber->AdvancedSearch->ToJson(), ","); // Field bookingNumber
		$sFilterList = ew_Concat($sFilterList, $this->_userID->AdvancedSearch->ToJson(), ","); // Field userID
		$sFilterList = ew_Concat($sFilterList, $this->payDriveCarID->AdvancedSearch->ToJson(), ","); // Field payDriveCarID
		$sFilterList = ew_Concat($sFilterList, $this->pickUpLocation->AdvancedSearch->ToJson(), ","); // Field pickUpLocation
		$sFilterList = ew_Concat($sFilterList, $this->dropLocation->AdvancedSearch->ToJson(), ","); // Field dropLocation
		$sFilterList = ew_Concat($sFilterList, $this->pickUpDate->AdvancedSearch->ToJson(), ","); // Field pickUpDate
		$sFilterList = ew_Concat($sFilterList, $this->dropDate->AdvancedSearch->ToJson(), ","); // Field dropDate
		$sFilterList = ew_Concat($sFilterList, $this->noOfDays->AdvancedSearch->ToJson(), ","); // Field noOfDays
		$sFilterList = ew_Concat($sFilterList, $this->bookingTerm->AdvancedSearch->ToJson(), ","); // Field bookingTerm
		$sFilterList = ew_Concat($sFilterList, $this->slab->AdvancedSearch->ToJson(), ","); // Field slab
		$sFilterList = ew_Concat($sFilterList, $this->orangeCard->AdvancedSearch->ToJson(), ","); // Field orangeCard
		$sFilterList = ew_Concat($sFilterList, $this->gps->AdvancedSearch->ToJson(), ","); // Field gps
		$sFilterList = ew_Concat($sFilterList, $this->deliveryCharge->AdvancedSearch->ToJson(), ","); // Field deliveryCharge
		$sFilterList = ew_Concat($sFilterList, $this->collectionCharge->AdvancedSearch->ToJson(), ","); // Field collectionCharge
		$sFilterList = ew_Concat($sFilterList, $this->rentalAmount->AdvancedSearch->ToJson(), ","); // Field rentalAmount
		$sFilterList = ew_Concat($sFilterList, $this->totalAmount->AdvancedSearch->ToJson(), ","); // Field totalAmount
		$sFilterList = ew_Concat($sFilterList, $this->vat->AdvancedSearch->ToJson(), ","); // Field vat
		$sFilterList = ew_Concat($sFilterList, $this->grandTotal->AdvancedSearch->ToJson(), ","); // Field grandTotal
		$sFilterList = ew_Concat($sFilterList, $this->deliveryAddress->AdvancedSearch->ToJson(), ","); // Field deliveryAddress
		$sFilterList = ew_Concat($sFilterList, $this->paymentMethod->AdvancedSearch->ToJson(), ","); // Field paymentMethod
		$sFilterList = ew_Concat($sFilterList, $this->dateCreated->AdvancedSearch->ToJson(), ","); // Field dateCreated
		if ($this->BasicSearch->Keyword <> "") {
			$sWrk = "\"" . EW_TABLE_BASIC_SEARCH . "\":\"" . ew_JsEncode2($this->BasicSearch->Keyword) . "\",\"" . EW_TABLE_BASIC_SEARCH_TYPE . "\":\"" . ew_JsEncode2($this->BasicSearch->Type) . "\"";
			$sFilterList = ew_Concat($sFilterList, $sWrk, ",");
		}
		$sFilterList = preg_replace('/,$/', "", $sFilterList);

		// Return filter list in json
		if ($sFilterList <> "")
			$sFilterList = "\"data\":{" . $sFilterList . "}";
		if ($sSavedFilterList <> "") {
			if ($sFilterList <> "")
				$sFilterList .= ",";
			$sFilterList .= "\"filters\":" . $sSavedFilterList;
		}
		return ($sFilterList <> "") ? "{" . $sFilterList . "}" : "null";
	}

	// Process filter list
	function ProcessFilterList() {
		global $UserProfile;
		if (@$_POST["ajax"] == "savefilters") { // Save filter request (Ajax)
			$filters = @$_POST["filters"];
			$UserProfile->SetSearchFilters(CurrentUserName(), "finb_bookings_pay_as_you_drivelistsrch", $filters);

			// Clean output buffer
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			echo ew_ArrayToJson(array(array("success" => TRUE))); // Success
			$this->Page_Terminate();
			exit();
		} elseif (@$_POST["cmd"] == "resetfilter") {
			$this->RestoreFilterList();
		}
	}

	// Restore list of filters
	function RestoreFilterList() {

		// Return if not reset filter
		if (@$_POST["cmd"] <> "resetfilter")
			return FALSE;
		$filter = json_decode(@$_POST["filter"], TRUE);
		$this->Command = "search";

		// Field bookingID
		$this->bookingID->AdvancedSearch->SearchValue = @$filter["x_bookingID"];
		$this->bookingID->AdvancedSearch->SearchOperator = @$filter["z_bookingID"];
		$this->bookingID->AdvancedSearch->SearchCondition = @$filter["v_bookingID"];
		$this->bookingID->AdvancedSearch->SearchValue2 = @$filter["y_bookingID"];
		$this->bookingID->AdvancedSearch->SearchOperator2 = @$filter["w_bookingID"];
		$this->bookingID->AdvancedSearch->Save();

		// Field bookingNumber
		$this->bookingNumber->AdvancedSearch->SearchValue = @$filter["x_bookingNumber"];
		$this->bookingNumber->AdvancedSearch->SearchOperator = @$filter["z_bookingNumber"];
		$this->bookingNumber->AdvancedSearch->SearchCondition = @$filter["v_bookingNumber"];
		$this->bookingNumber->AdvancedSearch->SearchValue2 = @$filter["y_bookingNumber"];
		$this->bookingNumber->AdvancedSearch->SearchOperator2 = @$filter["w_bookingNumber"];
		$this->bookingNumber->AdvancedSearch->Save();

		// Field userID
		$this->_userID->AdvancedSearch->SearchValue = @$filter["x__userID"];
		$this->_userID->AdvancedSearch->SearchOperator = @$filter["z__userID"];
		$this->_userID->AdvancedSearch->SearchCondition = @$filter["v__userID"];
		$this->_userID->AdvancedSearch->SearchValue2 = @$filter["y__userID"];
		$this->_userID->AdvancedSearch->SearchOperator2 = @$filter["w__userID"];
		$this->_userID->AdvancedSearch->Save();

		// Field payDriveCarID
		$this->payDriveCarID->AdvancedSearch->SearchValue = @$filter["x_payDriveCarID"];
		$this->payDriveCarID->AdvancedSearch->SearchOperator = @$filter["z_payDriveCarID"];
		$this->payDriveCarID->AdvancedSearch->SearchCondition = @$filter["v_payDriveCarID"];
		$this->payDriveCarID->AdvancedSearch->SearchValue2 = @$filter["y_payDriveCarID"];
		$this->payDriveCarID->AdvancedSearch->SearchOperator2 = @$filter["w_payDriveCarID"];
		$this->payDriveCarID->AdvancedSearch->Save();

		// Field pickUpLocation
		$this->pickUpLocation->AdvancedSearch->SearchValue = @$filter["x_pickUpLocation"];
		$this->pickUpLocation->AdvancedSearch->SearchOperator = @$filter["z_pickUpLocation"];
		$this->pickUpLocation->AdvancedSearch->SearchCondition = @$filter["v_pickUpLocation"];
		$this->pickUpLocation->AdvancedSearch->SearchValue2 = @$filter["y_pickUpLocation"];
		$this->pickUpLocation->AdvancedSearch->SearchOperator2 = @$filter["w_pickUpLocation"];
		$this->pickUpLocation->AdvancedSearch->Save();

		// Field dropLocation
		$this->dropLocation->AdvancedSearch->SearchValue = @$filter["x_dropLocation"];
		$this->dropLocation->AdvancedSearch->SearchOperator = @$filter["z_dropLocation"];
		$this->dropLocation->AdvancedSearch->SearchCondition = @$filter["v_dropLocation"];
		$this->dropLocation->AdvancedSearch->SearchValue2 = @$filter["y_dropLocation"];
		$this->dropLocation->AdvancedSearch->SearchOperator2 = @$filter["w_dropLocation"];
		$this->dropLocation->AdvancedSearch->Save();

		// Field pickUpDate
		$this->pickUpDate->AdvancedSearch->SearchValue = @$filter["x_pickUpDate"];
		$this->pickUpDate->AdvancedSearch->SearchOperator = @$filter["z_pickUpDate"];
		$this->pickUpDate->AdvancedSearch->SearchCondition = @$filter["v_pickUpDate"];
		$this->pickUpDate->AdvancedSearch->SearchValue2 = @$filter["y_pickUpDate"];
		$this->pickUpDate->AdvancedSearch->SearchOperator2 = @$filter["w_pickUpDate"];
		$this->pickUpDate->AdvancedSearch->Save();

		// Field dropDate
		$this->dropDate->AdvancedSearch->SearchValue = @$filter["x_dropDate"];
		$this->dropDate->AdvancedSearch->SearchOperator = @$filter["z_dropDate"];
		$this->dropDate->AdvancedSearch->SearchCondition = @$filter["v_dropDate"];
		$this->dropDate->AdvancedSearch->SearchValue2 = @$filter["y_dropDate"];
		$this->dropDate->AdvancedSearch->SearchOperator2 = @$filter["w_dropDate"];
		$this->dropDate->AdvancedSearch->Save();

		// Field noOfDays
		$this->noOfDays->AdvancedSearch->SearchValue = @$filter["x_noOfDays"];
		$this->noOfDays->AdvancedSearch->SearchOperator = @$filter["z_noOfDays"];
		$this->noOfDays->AdvancedSearch->SearchCondition = @$filter["v_noOfDays"];
		$this->noOfDays->AdvancedSearch->SearchValue2 = @$filter["y_noOfDays"];
		$this->noOfDays->AdvancedSearch->SearchOperator2 = @$filter["w_noOfDays"];
		$this->noOfDays->AdvancedSearch->Save();

		// Field bookingTerm
		$this->bookingTerm->AdvancedSearch->SearchValue = @$filter["x_bookingTerm"];
		$this->bookingTerm->AdvancedSearch->SearchOperator = @$filter["z_bookingTerm"];
		$this->bookingTerm->AdvancedSearch->SearchCondition = @$filter["v_bookingTerm"];
		$this->bookingTerm->AdvancedSearch->SearchValue2 = @$filter["y_bookingTerm"];
		$this->bookingTerm->AdvancedSearch->SearchOperator2 = @$filter["w_bookingTerm"];
		$this->bookingTerm->AdvancedSearch->Save();

		// Field slab
		$this->slab->AdvancedSearch->SearchValue = @$filter["x_slab"];
		$this->slab->AdvancedSearch->SearchOperator = @$filter["z_slab"];
		$this->slab->AdvancedSearch->SearchCondition = @$filter["v_slab"];
		$this->slab->AdvancedSearch->SearchValue2 = @$filter["y_slab"];
		$this->slab->AdvancedSearch->SearchOperator2 = @$filter["w_slab"];
		$this->slab->AdvancedSearch->Save();

		// Field orangeCard
		$this->orangeCard->AdvancedSearch->SearchValue = @$filter["x_orangeCard"];
		$this->orangeCard->AdvancedSearch->SearchOperator = @$filter["z_orangeCard"];
		$this->orangeCard->AdvancedSearch->SearchCondition = @$filter["v_orangeCard"];
		$this->orangeCard->AdvancedSearch->SearchValue2 = @$filter["y_orangeCard"];
		$this->orangeCard->AdvancedSearch->SearchOperator2 = @$filter["w_orangeCard"];
		$this->orangeCard->AdvancedSearch->Save();

		// Field gps
		$this->gps->AdvancedSearch->SearchValue = @$filter["x_gps"];
		$this->gps->AdvancedSearch->SearchOperator = @$filter["z_gps"];
		$this->gps->AdvancedSearch->SearchCondition = @$filter["v_gps"];
		$this->gps->AdvancedSearch->SearchValue2 = @$filter["y_gps"];
		$this->gps->AdvancedSearch->SearchOperator2 = @$filter["w_gps"];
		$this->gps->AdvancedSearch->Save();

		// Field deliveryCharge
		$this->deliveryCharge->AdvancedSearch->SearchValue = @$filter["x_deliveryCharge"];
		$this->deliveryCharge->AdvancedSearch->SearchOperator = @$filter["z_deliveryCharge"];
		$this->deliveryCharge->AdvancedSearch->SearchCondition = @$filter["v_deliveryCharge"];
		$this->deliveryCharge->AdvancedSearch->SearchValue2 = @$filter["y_deliveryCharge"];
		$this->deliveryCharge->AdvancedSearch->SearchOperator2 = @$filter["w_deliveryCharge"];
		$this->deliveryCharge->AdvancedSearch->Save();

		// Field collectionCharge
		$this->collectionCharge->AdvancedSearch->SearchValue = @$filter["x_collectionCharge"];
		$this->collectionCharge->AdvancedSearch->SearchOperator = @$filter["z_collectionCharge"];
		$this->collectionCharge->AdvancedSearch->SearchCondition = @$filter["v_collectionCharge"];
		$this->collectionCharge->AdvancedSearch->SearchValue2 = @$filter["y_collectionCharge"];
		$this->collectionCharge->AdvancedSearch->SearchOperator2 = @$filter["w_collectionCharge"];
		$this->collectionCharge->AdvancedSearch->Save();

		// Field rentalAmount
		$this->rentalAmount->AdvancedSearch->SearchValue = @$filter["x_rentalAmount"];
		$this->rentalAmount->AdvancedSearch->SearchOperator = @$filter["z_rentalAmount"];
		$this->rentalAmount->AdvancedSearch->SearchCondition = @$filter["v_rentalAmount"];
		$this->rentalAmount->AdvancedSearch->SearchValue2 = @$filter["y_rentalAmount"];
		$this->rentalAmount->AdvancedSearch->SearchOperator2 = @$filter["w_rentalAmount"];
		$this->rentalAmount->AdvancedSearch->Save();

		// Field totalAmount
		$this->totalAmount->AdvancedSearch->SearchValue = @$filter["x_totalAmount"];
		$this->totalAmount->AdvancedSearch->SearchOperator = @$filter["z_totalAmount"];
		$this->totalAmount->AdvancedSearch->SearchCondition = @$filter["v_totalAmount"];
		$this->totalAmount->AdvancedSearch->SearchValue2 = @$filter["y_totalAmount"];
		$this->totalAmount->AdvancedSearch->SearchOperator2 = @$filter["w_totalAmount"];
		$this->totalAmount->AdvancedSearch->Save();

		// Field vat
		$this->vat->AdvancedSearch->SearchValue = @$filter["x_vat"];
		$this->vat->AdvancedSearch->SearchOperator = @$filter["z_vat"];
		$this->vat->AdvancedSearch->SearchCondition = @$filter["v_vat"];
		$this->vat->AdvancedSearch->SearchValue2 = @$filter["y_vat"];
		$this->vat->AdvancedSearch->SearchOperator2 = @$filter["w_vat"];
		$this->vat->AdvancedSearch->Save();

		// Field grandTotal
		$this->grandTotal->AdvancedSearch->SearchValue = @$filter["x_grandTotal"];
		$this->grandTotal->AdvancedSearch->SearchOperator = @$filter["z_grandTotal"];
		$this->grandTotal->AdvancedSearch->SearchCondition = @$filter["v_grandTotal"];
		$this->grandTotal->AdvancedSearch->SearchValue2 = @$filter["y_grandTotal"];
		$this->grandTotal->AdvancedSearch->SearchOperator2 = @$filter["w_grandTotal"];
		$this->grandTotal->AdvancedSearch->Save();

		// Field deliveryAddress
		$this->deliveryAddress->AdvancedSearch->SearchValue = @$filter["x_deliveryAddress"];
		$this->deliveryAddress->AdvancedSearch->SearchOperator = @$filter["z_deliveryAddress"];
		$this->deliveryAddress->AdvancedSearch->SearchCondition = @$filter["v_deliveryAddress"];
		$this->deliveryAddress->AdvancedSearch->SearchValue2 = @$filter["y_deliveryAddress"];
		$this->deliveryAddress->AdvancedSearch->SearchOperator2 = @$filter["w_deliveryAddress"];
		$this->deliveryAddress->AdvancedSearch->Save();

		// Field paymentMethod
		$this->paymentMethod->AdvancedSearch->SearchValue = @$filter["x_paymentMethod"];
		$this->paymentMethod->AdvancedSearch->SearchOperator = @$filter["z_paymentMethod"];
		$this->paymentMethod->AdvancedSearch->SearchCondition = @$filter["v_paymentMethod"];
		$this->paymentMethod->AdvancedSearch->SearchValue2 = @$filter["y_paymentMethod"];
		$this->paymentMethod->AdvancedSearch->SearchOperator2 = @$filter["w_paymentMethod"];
		$this->paymentMethod->AdvancedSearch->Save();

		// Field dateCreated
		$this->dateCreated->AdvancedSearch->SearchValue = @$filter["x_dateCreated"];
		$this->dateCreated->AdvancedSearch->SearchOperator = @$filter["z_dateCreated"];
		$this->dateCreated->AdvancedSearch->SearchCondition = @$filter["v_dateCreated"];
		$this->dateCreated->AdvancedSearch->SearchValue2 = @$filter["y_dateCreated"];
		$this->dateCreated->AdvancedSearch->SearchOperator2 = @$filter["w_dateCreated"];
		$this->dateCreated->AdvancedSearch->Save();
		$this->BasicSearch->setKeyword(@$filter[EW_TABLE_BASIC_SEARCH]);
		$this->BasicSearch->setType(@$filter[EW_TABLE_BASIC_SEARCH_TYPE]);
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere($Default = FALSE) {
		global $Security;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $this->bookingID, $Default, FALSE); // bookingID
		$this->BuildSearchSql($sWhere, $this->bookingNumber, $Default, FALSE); // bookingNumber
		$this->BuildSearchSql($sWhere, $this->_userID, $Default, FALSE); // userID
		$this->BuildSearchSql($sWhere, $this->payDriveCarID, $Default, FALSE); // payDriveCarID
		$this->BuildSearchSql($sWhere, $this->pickUpLocation, $Default, FALSE); // pickUpLocation
		$this->BuildSearchSql($sWhere, $this->dropLocation, $Default, FALSE); // dropLocation
		$this->BuildSearchSql($sWhere, $this->pickUpDate, $Default, FALSE); // pickUpDate
		$this->BuildSearchSql($sWhere, $this->dropDate, $Default, FALSE); // dropDate
		$this->BuildSearchSql($sWhere, $this->noOfDays, $Default, FALSE); // noOfDays
		$this->BuildSearchSql($sWhere, $this->bookingTerm, $Default, FALSE); // bookingTerm
		$this->BuildSearchSql($sWhere, $this->slab, $Default, FALSE); // slab
		$this->BuildSearchSql($sWhere, $this->orangeCard, $Default, FALSE); // orangeCard
		$this->BuildSearchSql($sWhere, $this->gps, $Default, FALSE); // gps
		$this->BuildSearchSql($sWhere, $this->deliveryCharge, $Default, FALSE); // deliveryCharge
		$this->BuildSearchSql($sWhere, $this->collectionCharge, $Default, FALSE); // collectionCharge
		$this->BuildSearchSql($sWhere, $this->rentalAmount, $Default, FALSE); // rentalAmount
		$this->BuildSearchSql($sWhere, $this->totalAmount, $Default, FALSE); // totalAmount
		$this->BuildSearchSql($sWhere, $this->vat, $Default, FALSE); // vat
		$this->BuildSearchSql($sWhere, $this->grandTotal, $Default, FALSE); // grandTotal
		$this->BuildSearchSql($sWhere, $this->deliveryAddress, $Default, FALSE); // deliveryAddress
		$this->BuildSearchSql($sWhere, $this->paymentMethod, $Default, FALSE); // paymentMethod
		$this->BuildSearchSql($sWhere, $this->dateCreated, $Default, FALSE); // dateCreated

		// Set up search parm
		if (!$Default && $sWhere <> "" && in_array($this->Command, array("", "reset", "resetall"))) {
			$this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->bookingID->AdvancedSearch->Save(); // bookingID
			$this->bookingNumber->AdvancedSearch->Save(); // bookingNumber
			$this->_userID->AdvancedSearch->Save(); // userID
			$this->payDriveCarID->AdvancedSearch->Save(); // payDriveCarID
			$this->pickUpLocation->AdvancedSearch->Save(); // pickUpLocation
			$this->dropLocation->AdvancedSearch->Save(); // dropLocation
			$this->pickUpDate->AdvancedSearch->Save(); // pickUpDate
			$this->dropDate->AdvancedSearch->Save(); // dropDate
			$this->noOfDays->AdvancedSearch->Save(); // noOfDays
			$this->bookingTerm->AdvancedSearch->Save(); // bookingTerm
			$this->slab->AdvancedSearch->Save(); // slab
			$this->orangeCard->AdvancedSearch->Save(); // orangeCard
			$this->gps->AdvancedSearch->Save(); // gps
			$this->deliveryCharge->AdvancedSearch->Save(); // deliveryCharge
			$this->collectionCharge->AdvancedSearch->Save(); // collectionCharge
			$this->rentalAmount->AdvancedSearch->Save(); // rentalAmount
			$this->totalAmount->AdvancedSearch->Save(); // totalAmount
			$this->vat->AdvancedSearch->Save(); // vat
			$this->grandTotal->AdvancedSearch->Save(); // grandTotal
			$this->deliveryAddress->AdvancedSearch->Save(); // deliveryAddress
			$this->paymentMethod->AdvancedSearch->Save(); // paymentMethod
			$this->dateCreated->AdvancedSearch->Save(); // dateCreated
		}
		return $sWhere;
	}

	// Build search SQL
	function BuildSearchSql(&$Where, &$Fld, $Default, $MultiValue) {
		$FldParm = $Fld->FldParm();
		$FldVal = ($Default) ? $Fld->AdvancedSearch->SearchValueDefault : $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldOpr = ($Default) ? $Fld->AdvancedSearch->SearchOperatorDefault : $Fld->AdvancedSearch->SearchOperator; // @$_GET["z_$FldParm"]
		$FldCond = ($Default) ? $Fld->AdvancedSearch->SearchConditionDefault : $Fld->AdvancedSearch->SearchCondition; // @$_GET["v_$FldParm"]
		$FldVal2 = ($Default) ? $Fld->AdvancedSearch->SearchValue2Default : $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldOpr2 = ($Default) ? $Fld->AdvancedSearch->SearchOperator2Default : $Fld->AdvancedSearch->SearchOperator2; // @$_GET["w_$FldParm"]
		$sWrk = "";
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		if ($FldOpr == "") $FldOpr = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		if (EW_SEARCH_MULTI_VALUE_OPTION == 1)
			$MultiValue = FALSE;
		if ($MultiValue) {
			$sWrk1 = ($FldVal <> "") ? ew_GetMultiSearchSql($Fld, $FldOpr, $FldVal, $this->DBID) : ""; // Field value 1
			$sWrk2 = ($FldVal2 <> "") ? ew_GetMultiSearchSql($Fld, $FldOpr2, $FldVal2, $this->DBID) : ""; // Field value 2
			$sWrk = $sWrk1; // Build final SQL
			if ($sWrk2 <> "")
				$sWrk = ($sWrk <> "") ? "($sWrk) $FldCond ($sWrk2)" : $sWrk2;
		} else {
			$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			$sWrk = ew_GetSearchSql($Fld, $FldVal, $FldOpr, $FldCond, $FldVal2, $FldOpr2, $this->DBID);
		}
		ew_AddFilter($Where, $sWrk);
	}

	// Convert search value
	function ConvertSearchValue(&$Fld, $FldVal) {
		if ($FldVal == EW_NULL_VALUE || $FldVal == EW_NOT_NULL_VALUE)
			return $FldVal;
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_BOOLEAN) {
			if ($FldVal <> "") $Value = ($FldVal == "1" || strtolower(strval($FldVal)) == "y" || strtolower(strval($FldVal)) == "t") ? $Fld->TrueValue : $Fld->FalseValue;
		} elseif ($Fld->FldDataType == EW_DATATYPE_DATE || $Fld->FldDataType == EW_DATATYPE_TIME) {
			if ($FldVal <> "") $Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		}
		return $Value;
	}

	// Return basic search SQL
	function BasicSearchSQL($arKeywords, $type) {
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $this->bookingTerm, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->slab, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->gps, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->deliveryAddress, $arKeywords, $type);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSQL(&$Where, &$Fld, $arKeywords, $type) {
		global $EW_BASIC_SEARCH_IGNORE_PATTERN;
		$sDefCond = ($type == "OR") ? "OR" : "AND";
		$arSQL = array(); // Array for SQL parts
		$arCond = array(); // Array for search conditions
		$cnt = count($arKeywords);
		$j = 0; // Number of SQL parts
		for ($i = 0; $i < $cnt; $i++) {
			$Keyword = $arKeywords[$i];
			$Keyword = trim($Keyword);
			if ($EW_BASIC_SEARCH_IGNORE_PATTERN <> "") {
				$Keyword = preg_replace($EW_BASIC_SEARCH_IGNORE_PATTERN, "\\", $Keyword);
				$ar = explode("\\", $Keyword);
			} else {
				$ar = array($Keyword);
			}
			foreach ($ar as $Keyword) {
				if ($Keyword <> "") {
					$sWrk = "";
					if ($Keyword == "OR" && $type == "") {
						if ($j > 0)
							$arCond[$j-1] = "OR";
					} elseif ($Keyword == EW_NULL_VALUE) {
						$sWrk = $Fld->FldExpression . " IS NULL";
					} elseif ($Keyword == EW_NOT_NULL_VALUE) {
						$sWrk = $Fld->FldExpression . " IS NOT NULL";
					} elseif ($Fld->FldIsVirtual) {
						$sWrk = $Fld->FldVirtualExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", EW_DATATYPE_STRING, $this->DBID), $this->DBID);
					} elseif ($Fld->FldDataType != EW_DATATYPE_NUMBER || is_numeric($Keyword)) {
						$sWrk = $Fld->FldBasicSearchExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", EW_DATATYPE_STRING, $this->DBID), $this->DBID);
					}
					if ($sWrk <> "") {
						$arSQL[$j] = $sWrk;
						$arCond[$j] = $sDefCond;
						$j += 1;
					}
				}
			}
		}
		$cnt = count($arSQL);
		$bQuoted = FALSE;
		$sSql = "";
		if ($cnt > 0) {
			for ($i = 0; $i < $cnt-1; $i++) {
				if ($arCond[$i] == "OR") {
					if (!$bQuoted) $sSql .= "(";
					$bQuoted = TRUE;
				}
				$sSql .= $arSQL[$i];
				if ($bQuoted && $arCond[$i] <> "OR") {
					$sSql .= ")";
					$bQuoted = FALSE;
				}
				$sSql .= " " . $arCond[$i] . " ";
			}
			$sSql .= $arSQL[$cnt-1];
			if ($bQuoted)
				$sSql .= ")";
		}
		if ($sSql <> "") {
			if ($Where <> "") $Where .= " OR ";
			$Where .= "(" . $sSql . ")";
		}
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere($Default = FALSE) {
		global $Security;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = ($Default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
		$sSearchType = ($Default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

		// Get search SQL
		if ($sSearchKeyword <> "") {
			$ar = $this->BasicSearch->KeywordList($Default);

			// Search keyword in any fields
			if (($sSearchType == "OR" || $sSearchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
				foreach ($ar as $sKeyword) {
					if ($sKeyword <> "") {
						if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
						$sSearchStr .= "(" . $this->BasicSearchSQL(array($sKeyword), $sSearchType) . ")";
					}
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($ar, $sSearchType);
			}
			if (!$Default && in_array($this->Command, array("", "reset", "resetall"))) $this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->BasicSearch->setKeyword($sSearchKeyword);
			$this->BasicSearch->setType($sSearchType);
		}
		return $sSearchStr;
	}

	// Check if search parm exists
	function CheckSearchParms() {

		// Check basic search
		if ($this->BasicSearch->IssetSession())
			return TRUE;
		if ($this->bookingID->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->bookingNumber->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->_userID->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->payDriveCarID->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->pickUpLocation->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->dropLocation->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->pickUpDate->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->dropDate->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->noOfDays->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->bookingTerm->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->slab->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->orangeCard->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->gps->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->deliveryCharge->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->collectionCharge->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->rentalAmount->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->totalAmount->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->vat->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->grandTotal->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->deliveryAddress->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->paymentMethod->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->dateCreated->AdvancedSearch->IssetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Load advanced search default values
	function LoadAdvancedSearchDefault() {
		return FALSE;
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		$this->BasicSearch->UnsetSession();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		$this->bookingID->AdvancedSearch->UnsetSession();
		$this->bookingNumber->AdvancedSearch->UnsetSession();
		$this->_userID->AdvancedSearch->UnsetSession();
		$this->payDriveCarID->AdvancedSearch->UnsetSession();
		$this->pickUpLocation->AdvancedSearch->UnsetSession();
		$this->dropLocation->AdvancedSearch->UnsetSession();
		$this->pickUpDate->AdvancedSearch->UnsetSession();
		$this->dropDate->AdvancedSearch->UnsetSession();
		$this->noOfDays->AdvancedSearch->UnsetSession();
		$this->bookingTerm->AdvancedSearch->UnsetSession();
		$this->slab->AdvancedSearch->UnsetSession();
		$this->orangeCard->AdvancedSearch->UnsetSession();
		$this->gps->AdvancedSearch->UnsetSession();
		$this->deliveryCharge->AdvancedSearch->UnsetSession();
		$this->collectionCharge->AdvancedSearch->UnsetSession();
		$this->rentalAmount->AdvancedSearch->UnsetSession();
		$this->totalAmount->AdvancedSearch->UnsetSession();
		$this->vat->AdvancedSearch->UnsetSession();
		$this->grandTotal->AdvancedSearch->UnsetSession();
		$this->deliveryAddress->AdvancedSearch->UnsetSession();
		$this->paymentMethod->AdvancedSearch->UnsetSession();
		$this->dateCreated->AdvancedSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->Load();

		// Restore advanced search values
		$this->bookingID->AdvancedSearch->Load();
		$this->bookingNumber->AdvancedSearch->Load();
		$this->_userID->AdvancedSearch->Load();
		$this->payDriveCarID->AdvancedSearch->Load();
		$this->pickUpLocation->AdvancedSearch->Load();
		$this->dropLocation->AdvancedSearch->Load();
		$this->pickUpDate->AdvancedSearch->Load();
		$this->dropDate->AdvancedSearch->Load();
		$this->noOfDays->AdvancedSearch->Load();
		$this->bookingTerm->AdvancedSearch->Load();
		$this->slab->AdvancedSearch->Load();
		$this->orangeCard->AdvancedSearch->Load();
		$this->gps->AdvancedSearch->Load();
		$this->deliveryCharge->AdvancedSearch->Load();
		$this->collectionCharge->AdvancedSearch->Load();
		$this->rentalAmount->AdvancedSearch->Load();
		$this->totalAmount->AdvancedSearch->Load();
		$this->vat->AdvancedSearch->Load();
		$this->grandTotal->AdvancedSearch->Load();
		$this->deliveryAddress->AdvancedSearch->Load();
		$this->paymentMethod->AdvancedSearch->Load();
		$this->dateCreated->AdvancedSearch->Load();
	}

	// Set up sort parameters
	function SetupSortOrder() {

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = @$_GET["order"];
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->bookingID); // bookingID
			$this->UpdateSort($this->bookingNumber); // bookingNumber
			$this->UpdateSort($this->_userID); // userID
			$this->UpdateSort($this->payDriveCarID); // payDriveCarID
			$this->UpdateSort($this->pickUpLocation); // pickUpLocation
			$this->UpdateSort($this->dropLocation); // dropLocation
			$this->UpdateSort($this->pickUpDate); // pickUpDate
			$this->UpdateSort($this->dropDate); // dropDate
			$this->UpdateSort($this->noOfDays); // noOfDays
			$this->UpdateSort($this->bookingTerm); // bookingTerm
			$this->UpdateSort($this->rentalAmount); // rentalAmount
			$this->UpdateSort($this->totalAmount); // totalAmount
			$this->UpdateSort($this->grandTotal); // grandTotal
			$this->UpdateSort($this->paymentMethod); // paymentMethod
			$this->UpdateSort($this->dateCreated); // dateCreated
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		$sOrderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($this->getSqlOrderBy() <> "") {
				$sOrderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)
	function ResetCmd() {

		// Check if reset command
		if (substr($this->Command,0,5) == "reset") {

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->bookingID->setSort("");
				$this->bookingNumber->setSort("");
				$this->_userID->setSort("");
				$this->payDriveCarID->setSort("");
				$this->pickUpLocation->setSort("");
				$this->dropLocation->setSort("");
				$this->pickUpDate->setSort("");
				$this->dropDate->setSort("");
				$this->noOfDays->setSort("");
				$this->bookingTerm->setSort("");
				$this->rentalAmount->setSort("");
				$this->totalAmount->setSort("");
				$this->grandTotal->setSort("");
				$this->paymentMethod->setSort("");
				$this->dateCreated->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language;

		// Add group option item
		$item = &$this->ListOptions->Add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = FALSE;
		$item->Visible = FALSE;

		// "view"
		$item = &$this->ListOptions->Add("view");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->CanView();
		$item->OnLeft = FALSE;

		// List actions
		$item = &$this->ListOptions->Add("listactions");
		$item->CssClass = "text-nowrap";
		$item->OnLeft = FALSE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->Add("checkbox");
		$item->Visible = FALSE;
		$item->OnLeft = FALSE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" onclick=\"ew_SelectAllKey(this);\">";
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseImageAndText = TRUE;
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->Phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && ew_IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;
		$this->ListOptions->ButtonClass = "btn-sm"; // Class for button group

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		$this->SetupListOptionsExt();
		$item = &$this->ListOptions->GetItem($this->ListOptions->GroupOptionName);
		$item->Visible = $this->ListOptions->GroupOptionVisible();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $objForm;
		$this->ListOptions->LoadDefault();

		// Call ListOptions_Rendering event
		$this->ListOptions_Rendering();

		// "view"
		$oListOpt = &$this->ListOptions->Items["view"];
		$viewcaption = ew_HtmlTitle($Language->Phrase("ViewLink"));
		if ($Security->CanView()) {
			$oListOpt->Body = "<a class=\"ewRowLink ewView\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . ew_HtmlEncode($this->ViewUrl) . "\">" . $Language->Phrase("ViewLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// Set up list action buttons
		$oListOpt = &$this->ListOptions->GetItem("listactions");
		if ($oListOpt && $this->Export == "" && $this->CurrentAction == "") {
			$body = "";
			$links = array();
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode(str_replace(" ewIcon", "", $listaction->Icon)) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\"></span> " : "";
					$links[] = "<li><a class=\"ewAction ewListAction\" data-action=\"" . ew_HtmlEncode($action) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({key:" . $this->KeyToJson() . "}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ewAction ewListAction\" data-action=\"" . ew_HtmlEncode($action) . "\" title=\"" . ew_HtmlTitle($caption) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({key:" . $this->KeyToJson() . "}," . $listaction->ToJson(TRUE) . "));return false;\">" . $Language->Phrase("ListActionButton") . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default btn-sm ewActions\" title=\"" . ew_HtmlTitle($Language->Phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->Phrase("ListActionButton") . "<b class=\"caret\"></b></button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($oListOpt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$oListOpt->Body = $body;
				$oListOpt->Visible = TRUE;
			}
		}

		// "checkbox"
		$oListOpt = &$this->ListOptions->Items["checkbox"];
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ewMultiSelect\" value=\"" . ew_HtmlEncode($this->bookingID->CurrentValue) . "\" onclick=\"ew_ClickMultiCheckbox(event);\">";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["action"];

		// Set up options default
		foreach ($options as &$option) {
			$option->UseImageAndText = TRUE;
			$option->UseDropDownButton = FALSE;
			$option->UseButtonGroup = TRUE;
			$option->ButtonClass = "btn-sm"; // Class for button group
			$item = &$option->Add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->Phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->Phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->Phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->Add("savecurrentfilter");
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"finb_bookings_pay_as_you_drivelistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"finb_bookings_pay_as_you_drivelistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->Phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->Add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	function RenderOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_MULTIPLE) {
					$item = &$option->Add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode($listaction->Icon) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\"></span> " : $caption;
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.finb_bookings_pay_as_you_drivelist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecs <= 0) {
				$option = &$options["addedit"];
				$item = &$option->GetItem("gridedit");
				if ($item) $item->Visible = FALSE;
				$option = &$options["action"];
				$option->HideAllOptions();
			}
	}

	// Process list action
	function ProcessListAction() {
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$sFilter = $this->GetKeyFilter();
		$UserAction = @$_POST["useraction"];
		if ($sFilter <> "" && $UserAction <> "") {

			// Check permission first
			$ActionCaption = $UserAction;
			if (array_key_exists($UserAction, $this->ListActions->Items)) {
				$ActionCaption = $this->ListActions->Items[$UserAction]->Caption;
				if (!$this->ListActions->Items[$UserAction]->Allow) {
					$errmsg = str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionNotAllowed"));
					if (@$_POST["ajax"] == $UserAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $sFilter;
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$rs = $conn->Execute($sSql);
			$conn->raiseErrorFn = '';
			$this->CurrentAction = $UserAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->BeginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$Processed = $this->Row_CustomAction($UserAction, $row);
					if (!$Processed) break;
					$rs->MoveNext();
				}
				if ($Processed) {
					$conn->CommitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage(str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->RollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage <> "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->Close();
			$this->CurrentAction = ""; // Clear action
			if (@$_POST["ajax"] == $UserAction) { // Ajax
				if ($this->getSuccessMessage() <> "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->ClearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() <> "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->ClearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
	}

	// Set up search options
	function SetupSearchOptions() {
		global $Language;
		$this->SearchOptions = new cListOptions();
		$this->SearchOptions->Tag = "div";
		$this->SearchOptions->TagClassName = "ewSearchOption";

		// Search button
		$item = &$this->SearchOptions->Add("searchtoggle");
		$SearchToggleClass = ($this->SearchWhere <> "") ? " active" : " active";
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"finb_bookings_pay_as_you_drivelistsrch\">" . $Language->Phrase("SearchLink") . "</button>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->Add("showall");
		$item->Body = "<a class=\"btn btn-default ewShowAll\" title=\"" . $Language->Phrase("ShowAll") . "\" data-caption=\"" . $Language->Phrase("ShowAll") . "\" href=\"" . $this->PageUrl() . "cmd=reset\">" . $Language->Phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere <> $this->DefaultSearchWhere && $this->SearchWhere <> "0=101");

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseImageAndText = TRUE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->Phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->Add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->Export <> "" || $this->CurrentAction <> "")
			$this->SearchOptions->HideAllOptions();
		global $Security;
		if (!$Security->CanSearch()) {
			$this->SearchOptions->HideAllOptions();
			$this->FilterOptions->HideAllOptions();
		}
	}

	function SetupListOptionsExt() {
		global $Security, $Language;

		// Hide detail items for dropdown if necessary
		$this->ListOptions->HideDetailItemsForDropDown();
	}

	function RenderListOptionsExt() {
		global $Security, $Language;
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

	// Load basic search values
	function LoadBasicSearchValues() {
		$this->BasicSearch->Keyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		if ($this->BasicSearch->Keyword <> "" && $this->Command == "") $this->Command = "search";
		$this->BasicSearch->Type = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load search values for validation
	function LoadSearchValues() {
		global $objForm;

		// Load search values
		// bookingID

		$this->bookingID->AdvancedSearch->SearchValue = @$_GET["x_bookingID"];
		if ($this->bookingID->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->bookingID->AdvancedSearch->SearchOperator = @$_GET["z_bookingID"];

		// bookingNumber
		$this->bookingNumber->AdvancedSearch->SearchValue = @$_GET["x_bookingNumber"];
		if ($this->bookingNumber->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->bookingNumber->AdvancedSearch->SearchOperator = @$_GET["z_bookingNumber"];

		// userID
		$this->_userID->AdvancedSearch->SearchValue = @$_GET["x__userID"];
		if ($this->_userID->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->_userID->AdvancedSearch->SearchOperator = @$_GET["z__userID"];

		// payDriveCarID
		$this->payDriveCarID->AdvancedSearch->SearchValue = @$_GET["x_payDriveCarID"];
		if ($this->payDriveCarID->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->payDriveCarID->AdvancedSearch->SearchOperator = @$_GET["z_payDriveCarID"];

		// pickUpLocation
		$this->pickUpLocation->AdvancedSearch->SearchValue = @$_GET["x_pickUpLocation"];
		if ($this->pickUpLocation->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->pickUpLocation->AdvancedSearch->SearchOperator = @$_GET["z_pickUpLocation"];

		// dropLocation
		$this->dropLocation->AdvancedSearch->SearchValue = @$_GET["x_dropLocation"];
		if ($this->dropLocation->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->dropLocation->AdvancedSearch->SearchOperator = @$_GET["z_dropLocation"];

		// pickUpDate
		$this->pickUpDate->AdvancedSearch->SearchValue = @$_GET["x_pickUpDate"];
		if ($this->pickUpDate->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->pickUpDate->AdvancedSearch->SearchOperator = @$_GET["z_pickUpDate"];

		// dropDate
		$this->dropDate->AdvancedSearch->SearchValue = @$_GET["x_dropDate"];
		if ($this->dropDate->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->dropDate->AdvancedSearch->SearchOperator = @$_GET["z_dropDate"];

		// noOfDays
		$this->noOfDays->AdvancedSearch->SearchValue = @$_GET["x_noOfDays"];
		if ($this->noOfDays->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->noOfDays->AdvancedSearch->SearchOperator = @$_GET["z_noOfDays"];

		// bookingTerm
		$this->bookingTerm->AdvancedSearch->SearchValue = @$_GET["x_bookingTerm"];
		if ($this->bookingTerm->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->bookingTerm->AdvancedSearch->SearchOperator = @$_GET["z_bookingTerm"];

		// slab
		$this->slab->AdvancedSearch->SearchValue = @$_GET["x_slab"];
		if ($this->slab->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->slab->AdvancedSearch->SearchOperator = @$_GET["z_slab"];

		// orangeCard
		$this->orangeCard->AdvancedSearch->SearchValue = @$_GET["x_orangeCard"];
		if ($this->orangeCard->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->orangeCard->AdvancedSearch->SearchOperator = @$_GET["z_orangeCard"];

		// gps
		$this->gps->AdvancedSearch->SearchValue = @$_GET["x_gps"];
		if ($this->gps->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->gps->AdvancedSearch->SearchOperator = @$_GET["z_gps"];

		// deliveryCharge
		$this->deliveryCharge->AdvancedSearch->SearchValue = @$_GET["x_deliveryCharge"];
		if ($this->deliveryCharge->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->deliveryCharge->AdvancedSearch->SearchOperator = @$_GET["z_deliveryCharge"];

		// collectionCharge
		$this->collectionCharge->AdvancedSearch->SearchValue = @$_GET["x_collectionCharge"];
		if ($this->collectionCharge->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->collectionCharge->AdvancedSearch->SearchOperator = @$_GET["z_collectionCharge"];

		// rentalAmount
		$this->rentalAmount->AdvancedSearch->SearchValue = @$_GET["x_rentalAmount"];
		if ($this->rentalAmount->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->rentalAmount->AdvancedSearch->SearchOperator = @$_GET["z_rentalAmount"];

		// totalAmount
		$this->totalAmount->AdvancedSearch->SearchValue = @$_GET["x_totalAmount"];
		if ($this->totalAmount->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->totalAmount->AdvancedSearch->SearchOperator = @$_GET["z_totalAmount"];

		// vat
		$this->vat->AdvancedSearch->SearchValue = @$_GET["x_vat"];
		if ($this->vat->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->vat->AdvancedSearch->SearchOperator = @$_GET["z_vat"];

		// grandTotal
		$this->grandTotal->AdvancedSearch->SearchValue = @$_GET["x_grandTotal"];
		if ($this->grandTotal->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->grandTotal->AdvancedSearch->SearchOperator = @$_GET["z_grandTotal"];

		// deliveryAddress
		$this->deliveryAddress->AdvancedSearch->SearchValue = @$_GET["x_deliveryAddress"];
		if ($this->deliveryAddress->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->deliveryAddress->AdvancedSearch->SearchOperator = @$_GET["z_deliveryAddress"];

		// paymentMethod
		$this->paymentMethod->AdvancedSearch->SearchValue = @$_GET["x_paymentMethod"];
		if ($this->paymentMethod->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->paymentMethod->AdvancedSearch->SearchOperator = @$_GET["z_paymentMethod"];

		// dateCreated
		$this->dateCreated->AdvancedSearch->SearchValue = @$_GET["x_dateCreated"];
		if ($this->dateCreated->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->dateCreated->AdvancedSearch->SearchOperator = @$_GET["z_dateCreated"];
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

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("bookingID")) <> "")
			$this->bookingID->CurrentValue = $this->getKey("bookingID"); // bookingID
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
		$this->ViewUrl = $this->GetViewUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->InlineEditUrl = $this->GetInlineEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->InlineCopyUrl = $this->GetInlineCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();

		// Convert decimal values if posted back
		if ($this->rentalAmount->FormValue == $this->rentalAmount->CurrentValue && is_numeric(ew_StrToFloat($this->rentalAmount->CurrentValue)))
			$this->rentalAmount->CurrentValue = ew_StrToFloat($this->rentalAmount->CurrentValue);

		// Convert decimal values if posted back
		if ($this->totalAmount->FormValue == $this->totalAmount->CurrentValue && is_numeric(ew_StrToFloat($this->totalAmount->CurrentValue)))
			$this->totalAmount->CurrentValue = ew_StrToFloat($this->totalAmount->CurrentValue);

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

			// rentalAmount
			$this->rentalAmount->LinkCustomAttributes = "";
			$this->rentalAmount->HrefValue = "";
			$this->rentalAmount->TooltipValue = "";

			// totalAmount
			$this->totalAmount->LinkCustomAttributes = "";
			$this->totalAmount->HrefValue = "";
			$this->totalAmount->TooltipValue = "";

			// grandTotal
			$this->grandTotal->LinkCustomAttributes = "";
			$this->grandTotal->HrefValue = "";
			$this->grandTotal->TooltipValue = "";

			// paymentMethod
			$this->paymentMethod->LinkCustomAttributes = "";
			$this->paymentMethod->HrefValue = "";
			$this->paymentMethod->TooltipValue = "";

			// dateCreated
			$this->dateCreated->LinkCustomAttributes = "";
			$this->dateCreated->HrefValue = "";
			$this->dateCreated->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// bookingID
			$this->bookingID->EditAttrs["class"] = "form-control";
			$this->bookingID->EditCustomAttributes = "";
			$this->bookingID->EditValue = ew_HtmlEncode($this->bookingID->AdvancedSearch->SearchValue);
			$this->bookingID->PlaceHolder = ew_RemoveHtml($this->bookingID->FldCaption());

			// bookingNumber
			$this->bookingNumber->EditAttrs["class"] = "form-control";
			$this->bookingNumber->EditCustomAttributes = "";
			$this->bookingNumber->EditValue = ew_HtmlEncode($this->bookingNumber->AdvancedSearch->SearchValue);
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
			$this->pickUpDate->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($this->pickUpDate->AdvancedSearch->SearchValue, 7), 7));
			$this->pickUpDate->PlaceHolder = ew_RemoveHtml($this->pickUpDate->FldCaption());

			// dropDate
			$this->dropDate->EditAttrs["class"] = "form-control";
			$this->dropDate->EditCustomAttributes = "";
			$this->dropDate->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($this->dropDate->AdvancedSearch->SearchValue, 7), 7));
			$this->dropDate->PlaceHolder = ew_RemoveHtml($this->dropDate->FldCaption());

			// noOfDays
			$this->noOfDays->EditAttrs["class"] = "form-control";
			$this->noOfDays->EditCustomAttributes = "";
			$this->noOfDays->EditValue = ew_HtmlEncode($this->noOfDays->AdvancedSearch->SearchValue);
			$this->noOfDays->PlaceHolder = ew_RemoveHtml($this->noOfDays->FldCaption());

			// bookingTerm
			$this->bookingTerm->EditAttrs["class"] = "form-control";
			$this->bookingTerm->EditCustomAttributes = "";
			$this->bookingTerm->EditValue = ew_HtmlEncode($this->bookingTerm->AdvancedSearch->SearchValue);
			$this->bookingTerm->PlaceHolder = ew_RemoveHtml($this->bookingTerm->FldCaption());

			// rentalAmount
			$this->rentalAmount->EditAttrs["class"] = "form-control";
			$this->rentalAmount->EditCustomAttributes = "";
			$this->rentalAmount->EditValue = ew_HtmlEncode($this->rentalAmount->AdvancedSearch->SearchValue);
			$this->rentalAmount->PlaceHolder = ew_RemoveHtml($this->rentalAmount->FldCaption());

			// totalAmount
			$this->totalAmount->EditAttrs["class"] = "form-control";
			$this->totalAmount->EditCustomAttributes = "";
			$this->totalAmount->EditValue = ew_HtmlEncode($this->totalAmount->AdvancedSearch->SearchValue);
			$this->totalAmount->PlaceHolder = ew_RemoveHtml($this->totalAmount->FldCaption());

			// grandTotal
			$this->grandTotal->EditAttrs["class"] = "form-control";
			$this->grandTotal->EditCustomAttributes = "";
			$this->grandTotal->EditValue = ew_HtmlEncode($this->grandTotal->AdvancedSearch->SearchValue);
			$this->grandTotal->PlaceHolder = ew_RemoveHtml($this->grandTotal->FldCaption());

			// paymentMethod
			$this->paymentMethod->EditCustomAttributes = "";
			$this->paymentMethod->EditValue = $this->paymentMethod->Options(FALSE);

			// dateCreated
			$this->dateCreated->EditAttrs["class"] = "form-control";
			$this->dateCreated->EditCustomAttributes = "";
			$this->dateCreated->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($this->dateCreated->AdvancedSearch->SearchValue, 7), 7));
			$this->dateCreated->PlaceHolder = ew_RemoveHtml($this->dateCreated->FldCaption());
		}
		if ($this->RowType == EW_ROWTYPE_ADD || $this->RowType == EW_ROWTYPE_EDIT || $this->RowType == EW_ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->SetupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsSearchError, $sFormCustomError);
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		$this->bookingID->AdvancedSearch->Load();
		$this->bookingNumber->AdvancedSearch->Load();
		$this->_userID->AdvancedSearch->Load();
		$this->payDriveCarID->AdvancedSearch->Load();
		$this->pickUpLocation->AdvancedSearch->Load();
		$this->dropLocation->AdvancedSearch->Load();
		$this->pickUpDate->AdvancedSearch->Load();
		$this->dropDate->AdvancedSearch->Load();
		$this->noOfDays->AdvancedSearch->Load();
		$this->bookingTerm->AdvancedSearch->Load();
		$this->slab->AdvancedSearch->Load();
		$this->orangeCard->AdvancedSearch->Load();
		$this->gps->AdvancedSearch->Load();
		$this->deliveryCharge->AdvancedSearch->Load();
		$this->collectionCharge->AdvancedSearch->Load();
		$this->rentalAmount->AdvancedSearch->Load();
		$this->totalAmount->AdvancedSearch->Load();
		$this->vat->AdvancedSearch->Load();
		$this->grandTotal->AdvancedSearch->Load();
		$this->deliveryAddress->AdvancedSearch->Load();
		$this->paymentMethod->AdvancedSearch->Load();
		$this->dateCreated->AdvancedSearch->Load();
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
		$item->Visible = FALSE;

		// Export to Email
		$item = &$this->ExportOptions->Add("email");
		$url = "";
		$item->Body = "<button id=\"emf_inb_bookings_pay_as_you_drive\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_inb_bookings_pay_as_you_drive',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.finb_bookings_pay_as_you_drivelist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = $this->UseSelectLimit;

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

		// Export all
		if ($this->ExportAll) {
			set_time_limit(EW_EXPORT_ALL_TIME_LIMIT);
			$this->DisplayRecs = $this->TotalRecs;
			$this->StopRec = $this->TotalRecs;
		} else { // Export one page only
			$this->SetupStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->DisplayRecs <= 0) {
				$this->StopRec = $this->TotalRecs;
			} else {
				$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
			}
		}
		if ($bSelectLimit)
			$rs = $this->LoadRecordset($this->StartRec-1, $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs);
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		$this->ExportDoc = ew_ExportDocument($this, "h");
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
		$this->ExportDocument($Doc, $rs, $this->StartRec, $this->StopRec, "");
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

		// Build QueryString for search
		if ($this->BasicSearch->getKeyword() <> "") {
			$sQry .= "&" . EW_TABLE_BASIC_SEARCH . "=" . urlencode($this->BasicSearch->getKeyword()) . "&" . EW_TABLE_BASIC_SEARCH_TYPE . "=" . urlencode($this->BasicSearch->getType());
		}
		$this->AddSearchQueryString($sQry, $this->bookingID); // bookingID
		$this->AddSearchQueryString($sQry, $this->bookingNumber); // bookingNumber
		$this->AddSearchQueryString($sQry, $this->_userID); // userID
		$this->AddSearchQueryString($sQry, $this->payDriveCarID); // payDriveCarID
		$this->AddSearchQueryString($sQry, $this->pickUpLocation); // pickUpLocation
		$this->AddSearchQueryString($sQry, $this->dropLocation); // dropLocation
		$this->AddSearchQueryString($sQry, $this->pickUpDate); // pickUpDate
		$this->AddSearchQueryString($sQry, $this->dropDate); // dropDate
		$this->AddSearchQueryString($sQry, $this->noOfDays); // noOfDays
		$this->AddSearchQueryString($sQry, $this->bookingTerm); // bookingTerm
		$this->AddSearchQueryString($sQry, $this->slab); // slab
		$this->AddSearchQueryString($sQry, $this->orangeCard); // orangeCard
		$this->AddSearchQueryString($sQry, $this->gps); // gps
		$this->AddSearchQueryString($sQry, $this->deliveryCharge); // deliveryCharge
		$this->AddSearchQueryString($sQry, $this->collectionCharge); // collectionCharge
		$this->AddSearchQueryString($sQry, $this->rentalAmount); // rentalAmount
		$this->AddSearchQueryString($sQry, $this->totalAmount); // totalAmount
		$this->AddSearchQueryString($sQry, $this->vat); // vat
		$this->AddSearchQueryString($sQry, $this->grandTotal); // grandTotal
		$this->AddSearchQueryString($sQry, $this->deliveryAddress); // deliveryAddress
		$this->AddSearchQueryString($sQry, $this->paymentMethod); // paymentMethod
		$this->AddSearchQueryString($sQry, $this->dateCreated); // dateCreated

		// Build QueryString for pager
		$sQry .= "&" . EW_TABLE_REC_PER_PAGE . "=" . urlencode($this->getRecordsPerPage()) . "&" . EW_TABLE_START_REC . "=" . urlencode($this->getStartRecordNumber());
		return $sQry;
	}

	// Add search QueryString
	function AddSearchQueryString(&$Qry, &$Fld) {
		$FldSearchValue = $Fld->AdvancedSearch->getValue("x");
		$FldParm = substr($Fld->FldVar,2);
		if (strval($FldSearchValue) <> "") {
			$Qry .= "&x_" . $FldParm . "=" . urlencode($FldSearchValue) .
				"&z_" . $FldParm . "=" . urlencode($Fld->AdvancedSearch->getValue("z"));
		}
		$FldSearchValue2 = $Fld->AdvancedSearch->getValue("y");
		if (strval($FldSearchValue2) <> "") {
			$Qry .= "&v_" . $FldParm . "=" . urlencode($Fld->AdvancedSearch->getValue("v")) .
				"&y_" . $FldParm . "=" . urlencode($FldSearchValue2) .
				"&w_" . $FldParm . "=" . urlencode($Fld->AdvancedSearch->getValue("w"));
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->Add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		if ($pageId == "list") {
			switch ($fld->FldVar) {
			}
		} elseif ($pageId == "extbs") {
			switch ($fld->FldVar) {
			}
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		if ($pageId == "list") {
			switch ($fld->FldVar) {
			}
		} elseif ($pageId == "extbs") {
			switch ($fld->FldVar) {
			}
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

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendering event
	function ListOptions_Rendering() {

		//$GLOBALS["xxx_grid"]->DetailAdd = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailEdit = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailView = (...condition...); // Set to TRUE or FALSE conditionally

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example:
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
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
if (!isset($inb_bookings_pay_as_you_drive_list)) $inb_bookings_pay_as_you_drive_list = new cinb_bookings_pay_as_you_drive_list();

// Page init
$inb_bookings_pay_as_you_drive_list->Page_Init();

// Page main
$inb_bookings_pay_as_you_drive_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inb_bookings_pay_as_you_drive_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($inb_bookings_pay_as_you_drive->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = finb_bookings_pay_as_you_drivelist = new ew_Form("finb_bookings_pay_as_you_drivelist", "list");
finb_bookings_pay_as_you_drivelist.FormKeyCountName = '<?php echo $inb_bookings_pay_as_you_drive_list->FormKeyCountName ?>';

// Form_CustomValidate event
finb_bookings_pay_as_you_drivelist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
finb_bookings_pay_as_you_drivelist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
finb_bookings_pay_as_you_drivelist.Lists["x__userID"] = {"LinkField":"x__userID","Ajax":true,"AutoFill":false,"DisplayFields":["x_firstName","x_lastName","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"users"};
finb_bookings_pay_as_you_drivelist.Lists["x__userID"].Data = "<?php echo $inb_bookings_pay_as_you_drive_list->_userID->LookupFilterQuery(FALSE, "list") ?>";
finb_bookings_pay_as_you_drivelist.Lists["x_payDriveCarID"] = {"LinkField":"x_payDriveCarID","Ajax":true,"AutoFill":false,"DisplayFields":["x_carTitle","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"pay_as_you_drive"};
finb_bookings_pay_as_you_drivelist.Lists["x_payDriveCarID"].Data = "<?php echo $inb_bookings_pay_as_you_drive_list->payDriveCarID->LookupFilterQuery(FALSE, "list") ?>";
finb_bookings_pay_as_you_drivelist.Lists["x_pickUpLocation"] = {"LinkField":"x_pdLocationID","Ajax":true,"AutoFill":false,"DisplayFields":["x_location","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"pickup_drop_locations"};
finb_bookings_pay_as_you_drivelist.Lists["x_pickUpLocation"].Data = "<?php echo $inb_bookings_pay_as_you_drive_list->pickUpLocation->LookupFilterQuery(FALSE, "list") ?>";
finb_bookings_pay_as_you_drivelist.Lists["x_dropLocation"] = {"LinkField":"x_pdLocationID","Ajax":true,"AutoFill":false,"DisplayFields":["x_location","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"pickup_drop_locations"};
finb_bookings_pay_as_you_drivelist.Lists["x_dropLocation"].Data = "<?php echo $inb_bookings_pay_as_you_drive_list->dropLocation->LookupFilterQuery(FALSE, "list") ?>";
finb_bookings_pay_as_you_drivelist.Lists["x_paymentMethod"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
finb_bookings_pay_as_you_drivelist.Lists["x_paymentMethod"].Options = <?php echo json_encode($inb_bookings_pay_as_you_drive_list->paymentMethod->Options()) ?>;

// Form object for search
var CurrentSearchForm = finb_bookings_pay_as_you_drivelistsrch = new ew_Form("finb_bookings_pay_as_you_drivelistsrch");

// Validate function for search
finb_bookings_pay_as_you_drivelistsrch.Validate = function(fobj) {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	fobj = fobj || this.Form;
	var infix = "";

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
finb_bookings_pay_as_you_drivelistsrch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
finb_bookings_pay_as_you_drivelistsrch.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
finb_bookings_pay_as_you_drivelistsrch.Lists["x_paymentMethod"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
finb_bookings_pay_as_you_drivelistsrch.Lists["x_paymentMethod"].Options = <?php echo json_encode($inb_bookings_pay_as_you_drive_list->paymentMethod->Options()) ?>;
</script>
<style type="text/css">
.ewTablePreviewRow { /* main table preview row color */
	background-color: #FFFFFF; /* preview row color */
}
.ewTablePreviewRow .ewGrid {
	display: table;
}
</style>
<div id="ewPreview" class="hide"><!-- preview -->
	<div class="nav-tabs-custom"><!-- .nav-tabs-custom -->
		<ul class="nav nav-tabs"></ul>
		<div class="tab-content"><!-- .tab-content -->
			<div class="tab-pane fade"></div>
		</div><!-- /.tab-content -->
	</div><!-- /.nav-tabs-custom -->
</div><!-- /preview -->
<script type="text/javascript" src="phpjs/ewpreview.js"></script>
<script type="text/javascript">
var EW_PREVIEW_PLACEMENT = EW_CSS_FLIP ? "right" : "left";
var EW_PREVIEW_SINGLE_ROW = false;
var EW_PREVIEW_OVERLAY = false;
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->Export == "") { ?>
<div class="ewToolbar">
<?php if ($inb_bookings_pay_as_you_drive_list->TotalRecs > 0 && $inb_bookings_pay_as_you_drive_list->ExportOptions->Visible()) { ?>
<?php $inb_bookings_pay_as_you_drive_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive_list->SearchOptions->Visible()) { ?>
<?php $inb_bookings_pay_as_you_drive_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive_list->FilterOptions->Visible()) { ?>
<?php $inb_bookings_pay_as_you_drive_list->FilterOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
	$bSelectLimit = $inb_bookings_pay_as_you_drive_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($inb_bookings_pay_as_you_drive_list->TotalRecs <= 0)
			$inb_bookings_pay_as_you_drive_list->TotalRecs = $inb_bookings_pay_as_you_drive->ListRecordCount();
	} else {
		if (!$inb_bookings_pay_as_you_drive_list->Recordset && ($inb_bookings_pay_as_you_drive_list->Recordset = $inb_bookings_pay_as_you_drive_list->LoadRecordset()))
			$inb_bookings_pay_as_you_drive_list->TotalRecs = $inb_bookings_pay_as_you_drive_list->Recordset->RecordCount();
	}
	$inb_bookings_pay_as_you_drive_list->StartRec = 1;
	if ($inb_bookings_pay_as_you_drive_list->DisplayRecs <= 0 || ($inb_bookings_pay_as_you_drive->Export <> "" && $inb_bookings_pay_as_you_drive->ExportAll)) // Display all records
		$inb_bookings_pay_as_you_drive_list->DisplayRecs = $inb_bookings_pay_as_you_drive_list->TotalRecs;
	if (!($inb_bookings_pay_as_you_drive->Export <> "" && $inb_bookings_pay_as_you_drive->ExportAll))
		$inb_bookings_pay_as_you_drive_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$inb_bookings_pay_as_you_drive_list->Recordset = $inb_bookings_pay_as_you_drive_list->LoadRecordset($inb_bookings_pay_as_you_drive_list->StartRec-1, $inb_bookings_pay_as_you_drive_list->DisplayRecs);

	// Set no record found message
	if ($inb_bookings_pay_as_you_drive->CurrentAction == "" && $inb_bookings_pay_as_you_drive_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$inb_bookings_pay_as_you_drive_list->setWarningMessage(ew_DeniedMsg());
		if ($inb_bookings_pay_as_you_drive_list->SearchWhere == "0=101")
			$inb_bookings_pay_as_you_drive_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$inb_bookings_pay_as_you_drive_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$inb_bookings_pay_as_you_drive_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($inb_bookings_pay_as_you_drive->Export == "" && $inb_bookings_pay_as_you_drive->CurrentAction == "") { ?>
<form name="finb_bookings_pay_as_you_drivelistsrch" id="finb_bookings_pay_as_you_drivelistsrch" class="form-inline ewForm ewExtSearchForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($inb_bookings_pay_as_you_drive_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="finb_bookings_pay_as_you_drivelistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="inb_bookings_pay_as_you_drive">
	<div class="ewBasicSearch">
<?php
if ($gsSearchError == "")
	$inb_bookings_pay_as_you_drive_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$inb_bookings_pay_as_you_drive->RowType = EW_ROWTYPE_SEARCH;

// Render row
$inb_bookings_pay_as_you_drive->ResetAttrs();
$inb_bookings_pay_as_you_drive_list->RenderRow();
?>
<div id="xsr_1" class="ewRow">
<?php if ($inb_bookings_pay_as_you_drive->paymentMethod->Visible) { // paymentMethod ?>
	<div id="xsc_paymentMethod" class="ewCell form-group">
		<label class="ewSearchCaption ewLabel"><?php echo $inb_bookings_pay_as_you_drive->paymentMethod->FldCaption() ?></label>
		<span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_paymentMethod" id="z_paymentMethod" value="="></span>
		<span class="ewSearchField">
<div id="tp_x_paymentMethod" class="ewTemplate"><input type="radio" data-table="inb_bookings_pay_as_you_drive" data-field="x_paymentMethod" data-value-separator="<?php echo $inb_bookings_pay_as_you_drive->paymentMethod->DisplayValueSeparatorAttribute() ?>" name="x_paymentMethod" id="x_paymentMethod" value="{value}"<?php echo $inb_bookings_pay_as_you_drive->paymentMethod->EditAttributes() ?>></div>
<div id="dsl_x_paymentMethod" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $inb_bookings_pay_as_you_drive->paymentMethod->RadioButtonListHtml(FALSE, "x_paymentMethod") ?>
</div></div>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ewRow">
	<div class="ewQuickSearch input-group">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo ew_HtmlEncode($inb_bookings_pay_as_you_drive_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo ew_HtmlEncode($Language->Phrase("Search")) ?>">
	<input type="hidden" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo ew_HtmlEncode($inb_bookings_pay_as_you_drive_list->BasicSearch->getType()) ?>">
	<div class="input-group-btn">
		<button type="button" data-toggle="dropdown" class="btn btn-default"><span id="searchtype"><?php echo $inb_bookings_pay_as_you_drive_list->BasicSearch->getTypeNameShort() ?></span><span class="caret"></span></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li<?php if ($inb_bookings_pay_as_you_drive_list->BasicSearch->getType() == "") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a></li>
			<li<?php if ($inb_bookings_pay_as_you_drive_list->BasicSearch->getType() == "=") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a></li>
			<li<?php if ($inb_bookings_pay_as_you_drive_list->BasicSearch->getType() == "AND") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a></li>
			<li<?php if ($inb_bookings_pay_as_you_drive_list->BasicSearch->getType() == "OR") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a></li>
		</ul>
	<button class="btn btn-primary ewButton" name="btnsubmit" id="btnsubmit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
	</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $inb_bookings_pay_as_you_drive_list->ShowPageHeader(); ?>
<?php
$inb_bookings_pay_as_you_drive_list->ShowMessage();
?>
<?php if ($inb_bookings_pay_as_you_drive_list->TotalRecs > 0 || $inb_bookings_pay_as_you_drive->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($inb_bookings_pay_as_you_drive_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> inb_bookings_pay_as_you_drive">
<?php if ($inb_bookings_pay_as_you_drive->Export == "") { ?>
<div class="box-header ewGridUpperPanel">
<?php if ($inb_bookings_pay_as_you_drive->CurrentAction <> "gridadd" && $inb_bookings_pay_as_you_drive->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($inb_bookings_pay_as_you_drive_list->Pager)) $inb_bookings_pay_as_you_drive_list->Pager = new cPrevNextPager($inb_bookings_pay_as_you_drive_list->StartRec, $inb_bookings_pay_as_you_drive_list->DisplayRecs, $inb_bookings_pay_as_you_drive_list->TotalRecs, $inb_bookings_pay_as_you_drive_list->AutoHidePager) ?>
<?php if ($inb_bookings_pay_as_you_drive_list->Pager->RecordCount > 0 && $inb_bookings_pay_as_you_drive_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($inb_bookings_pay_as_you_drive_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $inb_bookings_pay_as_you_drive_list->PageUrl() ?>start=<?php echo $inb_bookings_pay_as_you_drive_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($inb_bookings_pay_as_you_drive_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $inb_bookings_pay_as_you_drive_list->PageUrl() ?>start=<?php echo $inb_bookings_pay_as_you_drive_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $inb_bookings_pay_as_you_drive_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($inb_bookings_pay_as_you_drive_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $inb_bookings_pay_as_you_drive_list->PageUrl() ?>start=<?php echo $inb_bookings_pay_as_you_drive_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($inb_bookings_pay_as_you_drive_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $inb_bookings_pay_as_you_drive_list->PageUrl() ?>start=<?php echo $inb_bookings_pay_as_you_drive_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $inb_bookings_pay_as_you_drive_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $inb_bookings_pay_as_you_drive_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $inb_bookings_pay_as_you_drive_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $inb_bookings_pay_as_you_drive_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($inb_bookings_pay_as_you_drive_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="finb_bookings_pay_as_you_drivelist" id="finb_bookings_pay_as_you_drivelist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($inb_bookings_pay_as_you_drive_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $inb_bookings_pay_as_you_drive_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inb_bookings_pay_as_you_drive">
<div id="gmp_inb_bookings_pay_as_you_drive" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($inb_bookings_pay_as_you_drive_list->TotalRecs > 0 || $inb_bookings_pay_as_you_drive->CurrentAction == "gridedit") { ?>
<table id="tbl_inb_bookings_pay_as_you_drivelist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$inb_bookings_pay_as_you_drive_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$inb_bookings_pay_as_you_drive_list->RenderListOptions();

// Render list options (header, left)
$inb_bookings_pay_as_you_drive_list->ListOptions->Render("header", "left");
?>
<?php if ($inb_bookings_pay_as_you_drive->bookingID->Visible) { // bookingID ?>
	<?php if ($inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->bookingID) == "") { ?>
		<th data-name="bookingID" class="<?php echo $inb_bookings_pay_as_you_drive->bookingID->HeaderCellClass() ?>"><div id="elh_inb_bookings_pay_as_you_drive_bookingID" class="inb_bookings_pay_as_you_drive_bookingID"><div class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->bookingID->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bookingID" class="<?php echo $inb_bookings_pay_as_you_drive->bookingID->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->bookingID) ?>',1);"><div id="elh_inb_bookings_pay_as_you_drive_bookingID" class="inb_bookings_pay_as_you_drive_bookingID">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->bookingID->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($inb_bookings_pay_as_you_drive->bookingID->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inb_bookings_pay_as_you_drive->bookingID->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->bookingNumber->Visible) { // bookingNumber ?>
	<?php if ($inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->bookingNumber) == "") { ?>
		<th data-name="bookingNumber" class="<?php echo $inb_bookings_pay_as_you_drive->bookingNumber->HeaderCellClass() ?>"><div id="elh_inb_bookings_pay_as_you_drive_bookingNumber" class="inb_bookings_pay_as_you_drive_bookingNumber"><div class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->bookingNumber->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bookingNumber" class="<?php echo $inb_bookings_pay_as_you_drive->bookingNumber->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->bookingNumber) ?>',1);"><div id="elh_inb_bookings_pay_as_you_drive_bookingNumber" class="inb_bookings_pay_as_you_drive_bookingNumber">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->bookingNumber->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($inb_bookings_pay_as_you_drive->bookingNumber->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inb_bookings_pay_as_you_drive->bookingNumber->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->_userID->Visible) { // userID ?>
	<?php if ($inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->_userID) == "") { ?>
		<th data-name="_userID" class="<?php echo $inb_bookings_pay_as_you_drive->_userID->HeaderCellClass() ?>"><div id="elh_inb_bookings_pay_as_you_drive__userID" class="inb_bookings_pay_as_you_drive__userID"><div class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->_userID->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_userID" class="<?php echo $inb_bookings_pay_as_you_drive->_userID->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->_userID) ?>',1);"><div id="elh_inb_bookings_pay_as_you_drive__userID" class="inb_bookings_pay_as_you_drive__userID">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->_userID->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($inb_bookings_pay_as_you_drive->_userID->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inb_bookings_pay_as_you_drive->_userID->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->payDriveCarID->Visible) { // payDriveCarID ?>
	<?php if ($inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->payDriveCarID) == "") { ?>
		<th data-name="payDriveCarID" class="<?php echo $inb_bookings_pay_as_you_drive->payDriveCarID->HeaderCellClass() ?>"><div id="elh_inb_bookings_pay_as_you_drive_payDriveCarID" class="inb_bookings_pay_as_you_drive_payDriveCarID"><div class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->payDriveCarID->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="payDriveCarID" class="<?php echo $inb_bookings_pay_as_you_drive->payDriveCarID->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->payDriveCarID) ?>',1);"><div id="elh_inb_bookings_pay_as_you_drive_payDriveCarID" class="inb_bookings_pay_as_you_drive_payDriveCarID">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->payDriveCarID->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($inb_bookings_pay_as_you_drive->payDriveCarID->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inb_bookings_pay_as_you_drive->payDriveCarID->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->pickUpLocation->Visible) { // pickUpLocation ?>
	<?php if ($inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->pickUpLocation) == "") { ?>
		<th data-name="pickUpLocation" class="<?php echo $inb_bookings_pay_as_you_drive->pickUpLocation->HeaderCellClass() ?>"><div id="elh_inb_bookings_pay_as_you_drive_pickUpLocation" class="inb_bookings_pay_as_you_drive_pickUpLocation"><div class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->pickUpLocation->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pickUpLocation" class="<?php echo $inb_bookings_pay_as_you_drive->pickUpLocation->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->pickUpLocation) ?>',1);"><div id="elh_inb_bookings_pay_as_you_drive_pickUpLocation" class="inb_bookings_pay_as_you_drive_pickUpLocation">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->pickUpLocation->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($inb_bookings_pay_as_you_drive->pickUpLocation->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inb_bookings_pay_as_you_drive->pickUpLocation->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->dropLocation->Visible) { // dropLocation ?>
	<?php if ($inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->dropLocation) == "") { ?>
		<th data-name="dropLocation" class="<?php echo $inb_bookings_pay_as_you_drive->dropLocation->HeaderCellClass() ?>"><div id="elh_inb_bookings_pay_as_you_drive_dropLocation" class="inb_bookings_pay_as_you_drive_dropLocation"><div class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->dropLocation->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="dropLocation" class="<?php echo $inb_bookings_pay_as_you_drive->dropLocation->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->dropLocation) ?>',1);"><div id="elh_inb_bookings_pay_as_you_drive_dropLocation" class="inb_bookings_pay_as_you_drive_dropLocation">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->dropLocation->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($inb_bookings_pay_as_you_drive->dropLocation->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inb_bookings_pay_as_you_drive->dropLocation->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->pickUpDate->Visible) { // pickUpDate ?>
	<?php if ($inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->pickUpDate) == "") { ?>
		<th data-name="pickUpDate" class="<?php echo $inb_bookings_pay_as_you_drive->pickUpDate->HeaderCellClass() ?>"><div id="elh_inb_bookings_pay_as_you_drive_pickUpDate" class="inb_bookings_pay_as_you_drive_pickUpDate"><div class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->pickUpDate->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pickUpDate" class="<?php echo $inb_bookings_pay_as_you_drive->pickUpDate->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->pickUpDate) ?>',1);"><div id="elh_inb_bookings_pay_as_you_drive_pickUpDate" class="inb_bookings_pay_as_you_drive_pickUpDate">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->pickUpDate->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($inb_bookings_pay_as_you_drive->pickUpDate->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inb_bookings_pay_as_you_drive->pickUpDate->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->dropDate->Visible) { // dropDate ?>
	<?php if ($inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->dropDate) == "") { ?>
		<th data-name="dropDate" class="<?php echo $inb_bookings_pay_as_you_drive->dropDate->HeaderCellClass() ?>"><div id="elh_inb_bookings_pay_as_you_drive_dropDate" class="inb_bookings_pay_as_you_drive_dropDate"><div class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->dropDate->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="dropDate" class="<?php echo $inb_bookings_pay_as_you_drive->dropDate->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->dropDate) ?>',1);"><div id="elh_inb_bookings_pay_as_you_drive_dropDate" class="inb_bookings_pay_as_you_drive_dropDate">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->dropDate->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($inb_bookings_pay_as_you_drive->dropDate->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inb_bookings_pay_as_you_drive->dropDate->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->noOfDays->Visible) { // noOfDays ?>
	<?php if ($inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->noOfDays) == "") { ?>
		<th data-name="noOfDays" class="<?php echo $inb_bookings_pay_as_you_drive->noOfDays->HeaderCellClass() ?>"><div id="elh_inb_bookings_pay_as_you_drive_noOfDays" class="inb_bookings_pay_as_you_drive_noOfDays"><div class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->noOfDays->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="noOfDays" class="<?php echo $inb_bookings_pay_as_you_drive->noOfDays->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->noOfDays) ?>',1);"><div id="elh_inb_bookings_pay_as_you_drive_noOfDays" class="inb_bookings_pay_as_you_drive_noOfDays">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->noOfDays->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($inb_bookings_pay_as_you_drive->noOfDays->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inb_bookings_pay_as_you_drive->noOfDays->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->bookingTerm->Visible) { // bookingTerm ?>
	<?php if ($inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->bookingTerm) == "") { ?>
		<th data-name="bookingTerm" class="<?php echo $inb_bookings_pay_as_you_drive->bookingTerm->HeaderCellClass() ?>"><div id="elh_inb_bookings_pay_as_you_drive_bookingTerm" class="inb_bookings_pay_as_you_drive_bookingTerm"><div class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->bookingTerm->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bookingTerm" class="<?php echo $inb_bookings_pay_as_you_drive->bookingTerm->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->bookingTerm) ?>',1);"><div id="elh_inb_bookings_pay_as_you_drive_bookingTerm" class="inb_bookings_pay_as_you_drive_bookingTerm">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->bookingTerm->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($inb_bookings_pay_as_you_drive->bookingTerm->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inb_bookings_pay_as_you_drive->bookingTerm->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->rentalAmount->Visible) { // rentalAmount ?>
	<?php if ($inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->rentalAmount) == "") { ?>
		<th data-name="rentalAmount" class="<?php echo $inb_bookings_pay_as_you_drive->rentalAmount->HeaderCellClass() ?>"><div id="elh_inb_bookings_pay_as_you_drive_rentalAmount" class="inb_bookings_pay_as_you_drive_rentalAmount"><div class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->rentalAmount->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rentalAmount" class="<?php echo $inb_bookings_pay_as_you_drive->rentalAmount->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->rentalAmount) ?>',1);"><div id="elh_inb_bookings_pay_as_you_drive_rentalAmount" class="inb_bookings_pay_as_you_drive_rentalAmount">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->rentalAmount->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($inb_bookings_pay_as_you_drive->rentalAmount->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inb_bookings_pay_as_you_drive->rentalAmount->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->totalAmount->Visible) { // totalAmount ?>
	<?php if ($inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->totalAmount) == "") { ?>
		<th data-name="totalAmount" class="<?php echo $inb_bookings_pay_as_you_drive->totalAmount->HeaderCellClass() ?>"><div id="elh_inb_bookings_pay_as_you_drive_totalAmount" class="inb_bookings_pay_as_you_drive_totalAmount"><div class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->totalAmount->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="totalAmount" class="<?php echo $inb_bookings_pay_as_you_drive->totalAmount->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->totalAmount) ?>',1);"><div id="elh_inb_bookings_pay_as_you_drive_totalAmount" class="inb_bookings_pay_as_you_drive_totalAmount">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->totalAmount->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($inb_bookings_pay_as_you_drive->totalAmount->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inb_bookings_pay_as_you_drive->totalAmount->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->grandTotal->Visible) { // grandTotal ?>
	<?php if ($inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->grandTotal) == "") { ?>
		<th data-name="grandTotal" class="<?php echo $inb_bookings_pay_as_you_drive->grandTotal->HeaderCellClass() ?>"><div id="elh_inb_bookings_pay_as_you_drive_grandTotal" class="inb_bookings_pay_as_you_drive_grandTotal"><div class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->grandTotal->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="grandTotal" class="<?php echo $inb_bookings_pay_as_you_drive->grandTotal->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->grandTotal) ?>',1);"><div id="elh_inb_bookings_pay_as_you_drive_grandTotal" class="inb_bookings_pay_as_you_drive_grandTotal">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->grandTotal->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($inb_bookings_pay_as_you_drive->grandTotal->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inb_bookings_pay_as_you_drive->grandTotal->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->paymentMethod->Visible) { // paymentMethod ?>
	<?php if ($inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->paymentMethod) == "") { ?>
		<th data-name="paymentMethod" class="<?php echo $inb_bookings_pay_as_you_drive->paymentMethod->HeaderCellClass() ?>"><div id="elh_inb_bookings_pay_as_you_drive_paymentMethod" class="inb_bookings_pay_as_you_drive_paymentMethod"><div class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->paymentMethod->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="paymentMethod" class="<?php echo $inb_bookings_pay_as_you_drive->paymentMethod->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->paymentMethod) ?>',1);"><div id="elh_inb_bookings_pay_as_you_drive_paymentMethod" class="inb_bookings_pay_as_you_drive_paymentMethod">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->paymentMethod->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($inb_bookings_pay_as_you_drive->paymentMethod->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inb_bookings_pay_as_you_drive->paymentMethod->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->dateCreated->Visible) { // dateCreated ?>
	<?php if ($inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->dateCreated) == "") { ?>
		<th data-name="dateCreated" class="<?php echo $inb_bookings_pay_as_you_drive->dateCreated->HeaderCellClass() ?>"><div id="elh_inb_bookings_pay_as_you_drive_dateCreated" class="inb_bookings_pay_as_you_drive_dateCreated"><div class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->dateCreated->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="dateCreated" class="<?php echo $inb_bookings_pay_as_you_drive->dateCreated->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inb_bookings_pay_as_you_drive->SortUrl($inb_bookings_pay_as_you_drive->dateCreated) ?>',1);"><div id="elh_inb_bookings_pay_as_you_drive_dateCreated" class="inb_bookings_pay_as_you_drive_dateCreated">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inb_bookings_pay_as_you_drive->dateCreated->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($inb_bookings_pay_as_you_drive->dateCreated->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inb_bookings_pay_as_you_drive->dateCreated->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$inb_bookings_pay_as_you_drive_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($inb_bookings_pay_as_you_drive->ExportAll && $inb_bookings_pay_as_you_drive->Export <> "") {
	$inb_bookings_pay_as_you_drive_list->StopRec = $inb_bookings_pay_as_you_drive_list->TotalRecs;
} else {

	// Set the last record to display
	if ($inb_bookings_pay_as_you_drive_list->TotalRecs > $inb_bookings_pay_as_you_drive_list->StartRec + $inb_bookings_pay_as_you_drive_list->DisplayRecs - 1)
		$inb_bookings_pay_as_you_drive_list->StopRec = $inb_bookings_pay_as_you_drive_list->StartRec + $inb_bookings_pay_as_you_drive_list->DisplayRecs - 1;
	else
		$inb_bookings_pay_as_you_drive_list->StopRec = $inb_bookings_pay_as_you_drive_list->TotalRecs;
}
$inb_bookings_pay_as_you_drive_list->RecCnt = $inb_bookings_pay_as_you_drive_list->StartRec - 1;
if ($inb_bookings_pay_as_you_drive_list->Recordset && !$inb_bookings_pay_as_you_drive_list->Recordset->EOF) {
	$inb_bookings_pay_as_you_drive_list->Recordset->MoveFirst();
	$bSelectLimit = $inb_bookings_pay_as_you_drive_list->UseSelectLimit;
	if (!$bSelectLimit && $inb_bookings_pay_as_you_drive_list->StartRec > 1)
		$inb_bookings_pay_as_you_drive_list->Recordset->Move($inb_bookings_pay_as_you_drive_list->StartRec - 1);
} elseif (!$inb_bookings_pay_as_you_drive->AllowAddDeleteRow && $inb_bookings_pay_as_you_drive_list->StopRec == 0) {
	$inb_bookings_pay_as_you_drive_list->StopRec = $inb_bookings_pay_as_you_drive->GridAddRowCount;
}

// Initialize aggregate
$inb_bookings_pay_as_you_drive->RowType = EW_ROWTYPE_AGGREGATEINIT;
$inb_bookings_pay_as_you_drive->ResetAttrs();
$inb_bookings_pay_as_you_drive_list->RenderRow();
while ($inb_bookings_pay_as_you_drive_list->RecCnt < $inb_bookings_pay_as_you_drive_list->StopRec) {
	$inb_bookings_pay_as_you_drive_list->RecCnt++;
	if (intval($inb_bookings_pay_as_you_drive_list->RecCnt) >= intval($inb_bookings_pay_as_you_drive_list->StartRec)) {
		$inb_bookings_pay_as_you_drive_list->RowCnt++;

		// Set up key count
		$inb_bookings_pay_as_you_drive_list->KeyCount = $inb_bookings_pay_as_you_drive_list->RowIndex;

		// Init row class and style
		$inb_bookings_pay_as_you_drive->ResetAttrs();
		$inb_bookings_pay_as_you_drive->CssClass = "";
		if ($inb_bookings_pay_as_you_drive->CurrentAction == "gridadd") {
		} else {
			$inb_bookings_pay_as_you_drive_list->LoadRowValues($inb_bookings_pay_as_you_drive_list->Recordset); // Load row values
		}
		$inb_bookings_pay_as_you_drive->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$inb_bookings_pay_as_you_drive->RowAttrs = array_merge($inb_bookings_pay_as_you_drive->RowAttrs, array('data-rowindex'=>$inb_bookings_pay_as_you_drive_list->RowCnt, 'id'=>'r' . $inb_bookings_pay_as_you_drive_list->RowCnt . '_inb_bookings_pay_as_you_drive', 'data-rowtype'=>$inb_bookings_pay_as_you_drive->RowType));

		// Render row
		$inb_bookings_pay_as_you_drive_list->RenderRow();

		// Render list options
		$inb_bookings_pay_as_you_drive_list->RenderListOptions();
?>
	<tr<?php echo $inb_bookings_pay_as_you_drive->RowAttributes() ?>>
<?php

// Render list options (body, left)
$inb_bookings_pay_as_you_drive_list->ListOptions->Render("body", "left", $inb_bookings_pay_as_you_drive_list->RowCnt);
?>
	<?php if ($inb_bookings_pay_as_you_drive->bookingID->Visible) { // bookingID ?>
		<td data-name="bookingID"<?php echo $inb_bookings_pay_as_you_drive->bookingID->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_list->RowCnt ?>_inb_bookings_pay_as_you_drive_bookingID" class="inb_bookings_pay_as_you_drive_bookingID">
<span<?php echo $inb_bookings_pay_as_you_drive->bookingID->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->bookingID->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inb_bookings_pay_as_you_drive->bookingNumber->Visible) { // bookingNumber ?>
		<td data-name="bookingNumber"<?php echo $inb_bookings_pay_as_you_drive->bookingNumber->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_list->RowCnt ?>_inb_bookings_pay_as_you_drive_bookingNumber" class="inb_bookings_pay_as_you_drive_bookingNumber">
<span<?php echo $inb_bookings_pay_as_you_drive->bookingNumber->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->bookingNumber->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inb_bookings_pay_as_you_drive->_userID->Visible) { // userID ?>
		<td data-name="_userID"<?php echo $inb_bookings_pay_as_you_drive->_userID->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_list->RowCnt ?>_inb_bookings_pay_as_you_drive__userID" class="inb_bookings_pay_as_you_drive__userID">
<span<?php echo $inb_bookings_pay_as_you_drive->_userID->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->_userID->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inb_bookings_pay_as_you_drive->payDriveCarID->Visible) { // payDriveCarID ?>
		<td data-name="payDriveCarID"<?php echo $inb_bookings_pay_as_you_drive->payDriveCarID->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_list->RowCnt ?>_inb_bookings_pay_as_you_drive_payDriveCarID" class="inb_bookings_pay_as_you_drive_payDriveCarID">
<span<?php echo $inb_bookings_pay_as_you_drive->payDriveCarID->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->payDriveCarID->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inb_bookings_pay_as_you_drive->pickUpLocation->Visible) { // pickUpLocation ?>
		<td data-name="pickUpLocation"<?php echo $inb_bookings_pay_as_you_drive->pickUpLocation->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_list->RowCnt ?>_inb_bookings_pay_as_you_drive_pickUpLocation" class="inb_bookings_pay_as_you_drive_pickUpLocation">
<span<?php echo $inb_bookings_pay_as_you_drive->pickUpLocation->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->pickUpLocation->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inb_bookings_pay_as_you_drive->dropLocation->Visible) { // dropLocation ?>
		<td data-name="dropLocation"<?php echo $inb_bookings_pay_as_you_drive->dropLocation->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_list->RowCnt ?>_inb_bookings_pay_as_you_drive_dropLocation" class="inb_bookings_pay_as_you_drive_dropLocation">
<span<?php echo $inb_bookings_pay_as_you_drive->dropLocation->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->dropLocation->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inb_bookings_pay_as_you_drive->pickUpDate->Visible) { // pickUpDate ?>
		<td data-name="pickUpDate"<?php echo $inb_bookings_pay_as_you_drive->pickUpDate->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_list->RowCnt ?>_inb_bookings_pay_as_you_drive_pickUpDate" class="inb_bookings_pay_as_you_drive_pickUpDate">
<span<?php echo $inb_bookings_pay_as_you_drive->pickUpDate->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->pickUpDate->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inb_bookings_pay_as_you_drive->dropDate->Visible) { // dropDate ?>
		<td data-name="dropDate"<?php echo $inb_bookings_pay_as_you_drive->dropDate->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_list->RowCnt ?>_inb_bookings_pay_as_you_drive_dropDate" class="inb_bookings_pay_as_you_drive_dropDate">
<span<?php echo $inb_bookings_pay_as_you_drive->dropDate->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->dropDate->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inb_bookings_pay_as_you_drive->noOfDays->Visible) { // noOfDays ?>
		<td data-name="noOfDays"<?php echo $inb_bookings_pay_as_you_drive->noOfDays->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_list->RowCnt ?>_inb_bookings_pay_as_you_drive_noOfDays" class="inb_bookings_pay_as_you_drive_noOfDays">
<span<?php echo $inb_bookings_pay_as_you_drive->noOfDays->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->noOfDays->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inb_bookings_pay_as_you_drive->bookingTerm->Visible) { // bookingTerm ?>
		<td data-name="bookingTerm"<?php echo $inb_bookings_pay_as_you_drive->bookingTerm->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_list->RowCnt ?>_inb_bookings_pay_as_you_drive_bookingTerm" class="inb_bookings_pay_as_you_drive_bookingTerm">
<span<?php echo $inb_bookings_pay_as_you_drive->bookingTerm->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->bookingTerm->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inb_bookings_pay_as_you_drive->rentalAmount->Visible) { // rentalAmount ?>
		<td data-name="rentalAmount"<?php echo $inb_bookings_pay_as_you_drive->rentalAmount->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_list->RowCnt ?>_inb_bookings_pay_as_you_drive_rentalAmount" class="inb_bookings_pay_as_you_drive_rentalAmount">
<span<?php echo $inb_bookings_pay_as_you_drive->rentalAmount->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->rentalAmount->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inb_bookings_pay_as_you_drive->totalAmount->Visible) { // totalAmount ?>
		<td data-name="totalAmount"<?php echo $inb_bookings_pay_as_you_drive->totalAmount->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_list->RowCnt ?>_inb_bookings_pay_as_you_drive_totalAmount" class="inb_bookings_pay_as_you_drive_totalAmount">
<span<?php echo $inb_bookings_pay_as_you_drive->totalAmount->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->totalAmount->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inb_bookings_pay_as_you_drive->grandTotal->Visible) { // grandTotal ?>
		<td data-name="grandTotal"<?php echo $inb_bookings_pay_as_you_drive->grandTotal->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_list->RowCnt ?>_inb_bookings_pay_as_you_drive_grandTotal" class="inb_bookings_pay_as_you_drive_grandTotal">
<span<?php echo $inb_bookings_pay_as_you_drive->grandTotal->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->grandTotal->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inb_bookings_pay_as_you_drive->paymentMethod->Visible) { // paymentMethod ?>
		<td data-name="paymentMethod"<?php echo $inb_bookings_pay_as_you_drive->paymentMethod->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_list->RowCnt ?>_inb_bookings_pay_as_you_drive_paymentMethod" class="inb_bookings_pay_as_you_drive_paymentMethod">
<span<?php echo $inb_bookings_pay_as_you_drive->paymentMethod->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->paymentMethod->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inb_bookings_pay_as_you_drive->dateCreated->Visible) { // dateCreated ?>
		<td data-name="dateCreated"<?php echo $inb_bookings_pay_as_you_drive->dateCreated->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_list->RowCnt ?>_inb_bookings_pay_as_you_drive_dateCreated" class="inb_bookings_pay_as_you_drive_dateCreated">
<span<?php echo $inb_bookings_pay_as_you_drive->dateCreated->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->dateCreated->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$inb_bookings_pay_as_you_drive_list->ListOptions->Render("body", "right", $inb_bookings_pay_as_you_drive_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($inb_bookings_pay_as_you_drive->CurrentAction <> "gridadd")
		$inb_bookings_pay_as_you_drive_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($inb_bookings_pay_as_you_drive_list->Recordset)
	$inb_bookings_pay_as_you_drive_list->Recordset->Close();
?>
<?php if ($inb_bookings_pay_as_you_drive->Export == "") { ?>
<div class="box-footer ewGridLowerPanel">
<?php if ($inb_bookings_pay_as_you_drive->CurrentAction <> "gridadd" && $inb_bookings_pay_as_you_drive->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($inb_bookings_pay_as_you_drive_list->Pager)) $inb_bookings_pay_as_you_drive_list->Pager = new cPrevNextPager($inb_bookings_pay_as_you_drive_list->StartRec, $inb_bookings_pay_as_you_drive_list->DisplayRecs, $inb_bookings_pay_as_you_drive_list->TotalRecs, $inb_bookings_pay_as_you_drive_list->AutoHidePager) ?>
<?php if ($inb_bookings_pay_as_you_drive_list->Pager->RecordCount > 0 && $inb_bookings_pay_as_you_drive_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($inb_bookings_pay_as_you_drive_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $inb_bookings_pay_as_you_drive_list->PageUrl() ?>start=<?php echo $inb_bookings_pay_as_you_drive_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($inb_bookings_pay_as_you_drive_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $inb_bookings_pay_as_you_drive_list->PageUrl() ?>start=<?php echo $inb_bookings_pay_as_you_drive_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $inb_bookings_pay_as_you_drive_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($inb_bookings_pay_as_you_drive_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $inb_bookings_pay_as_you_drive_list->PageUrl() ?>start=<?php echo $inb_bookings_pay_as_you_drive_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($inb_bookings_pay_as_you_drive_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $inb_bookings_pay_as_you_drive_list->PageUrl() ?>start=<?php echo $inb_bookings_pay_as_you_drive_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $inb_bookings_pay_as_you_drive_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $inb_bookings_pay_as_you_drive_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $inb_bookings_pay_as_you_drive_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $inb_bookings_pay_as_you_drive_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($inb_bookings_pay_as_you_drive_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive_list->TotalRecs == 0 && $inb_bookings_pay_as_you_drive->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($inb_bookings_pay_as_you_drive_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->Export == "") { ?>
<script type="text/javascript">
finb_bookings_pay_as_you_drivelistsrch.FilterList = <?php echo $inb_bookings_pay_as_you_drive_list->GetFilterList() ?>;
finb_bookings_pay_as_you_drivelistsrch.Init();
finb_bookings_pay_as_you_drivelist.Init();
</script>
<?php } ?>
<?php
$inb_bookings_pay_as_you_drive_list->ShowPageFooter();
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
$inb_bookings_pay_as_you_drive_list->Page_Terminate();
?>
