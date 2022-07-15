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

$pay_as_you_drive_list = NULL; // Initialize page object first

class cpay_as_you_drive_list extends cpay_as_you_drive {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'pay_as_you_drive';

	// Page object name
	var $PageObjName = 'pay_as_you_drive_list';

	// Grid form hidden field names
	var $FormName = 'fpay_as_you_drivelist';
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

		// Table object (pay_as_you_drive)
		if (!isset($GLOBALS["pay_as_you_drive"]) || get_class($GLOBALS["pay_as_you_drive"]) == "cpay_as_you_drive") {
			$GLOBALS["pay_as_you_drive"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["pay_as_you_drive"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "pay_as_you_driveadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "pay_as_you_drivedelete.php";
		$this->MultiUpdateUrl = "pay_as_you_driveupdate.php";

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption fpay_as_you_drivelistsrch";

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
		$this->payDriveCarID->SetVisibility();
		$this->payDriveCarID->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
		$this->bodyTypeID->SetVisibility();
		$this->carTitle->SetVisibility();
		$this->image->SetVisibility();
		$this->noOfSeats->SetVisibility();
		$this->transmissionID->SetVisibility();
		$this->active->SetVisibility();

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

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Process filter list
			$this->ProcessFilterList();

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
			$this->payDriveCarID->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->payDriveCarID->FormValue))
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
			$sSavedFilterList = $UserProfile->GetSearchFilters(CurrentUserName(), "fpay_as_you_drivelistsrch");
		$sFilterList = ew_Concat($sFilterList, $this->payDriveCarID->AdvancedSearch->ToJson(), ","); // Field payDriveCarID
		$sFilterList = ew_Concat($sFilterList, $this->bodyTypeID->AdvancedSearch->ToJson(), ","); // Field bodyTypeID
		$sFilterList = ew_Concat($sFilterList, $this->carTitle->AdvancedSearch->ToJson(), ","); // Field carTitle
		$sFilterList = ew_Concat($sFilterList, $this->slug->AdvancedSearch->ToJson(), ","); // Field slug
		$sFilterList = ew_Concat($sFilterList, $this->image->AdvancedSearch->ToJson(), ","); // Field image
		$sFilterList = ew_Concat($sFilterList, $this->extraFeatures->AdvancedSearch->ToJson(), ","); // Field extraFeatures
		$sFilterList = ew_Concat($sFilterList, $this->noOfSeats->AdvancedSearch->ToJson(), ","); // Field noOfSeats
		$sFilterList = ew_Concat($sFilterList, $this->luggage->AdvancedSearch->ToJson(), ","); // Field luggage
		$sFilterList = ew_Concat($sFilterList, $this->transmissionID->AdvancedSearch->ToJson(), ","); // Field transmissionID
		$sFilterList = ew_Concat($sFilterList, $this->ac->AdvancedSearch->ToJson(), ","); // Field ac
		$sFilterList = ew_Concat($sFilterList, $this->noOfDoors->AdvancedSearch->ToJson(), ","); // Field noOfDoors
		$sFilterList = ew_Concat($sFilterList, $this->s1DailyAED->AdvancedSearch->ToJson(), ","); // Field s1DailyAED
		$sFilterList = ew_Concat($sFilterList, $this->s1DailyKM->AdvancedSearch->ToJson(), ","); // Field s1DailyKM
		$sFilterList = ew_Concat($sFilterList, $this->s2DailyAED->AdvancedSearch->ToJson(), ","); // Field s2DailyAED
		$sFilterList = ew_Concat($sFilterList, $this->s2DailyKM->AdvancedSearch->ToJson(), ","); // Field s2DailyKM
		$sFilterList = ew_Concat($sFilterList, $this->s3DailyAED->AdvancedSearch->ToJson(), ","); // Field s3DailyAED
		$sFilterList = ew_Concat($sFilterList, $this->s3DailyKM->AdvancedSearch->ToJson(), ","); // Field s3DailyKM
		$sFilterList = ew_Concat($sFilterList, $this->s4DailyAED->AdvancedSearch->ToJson(), ","); // Field s4DailyAED
		$sFilterList = ew_Concat($sFilterList, $this->s4DailyKM->AdvancedSearch->ToJson(), ","); // Field s4DailyKM
		$sFilterList = ew_Concat($sFilterList, $this->s5DailyAED->AdvancedSearch->ToJson(), ","); // Field s5DailyAED
		$sFilterList = ew_Concat($sFilterList, $this->s5DailyKM->AdvancedSearch->ToJson(), ","); // Field s5DailyKM
		$sFilterList = ew_Concat($sFilterList, $this->s1WeeklyAED->AdvancedSearch->ToJson(), ","); // Field s1WeeklyAED
		$sFilterList = ew_Concat($sFilterList, $this->s1WeeklyKM->AdvancedSearch->ToJson(), ","); // Field s1WeeklyKM
		$sFilterList = ew_Concat($sFilterList, $this->s2WeeklyAED->AdvancedSearch->ToJson(), ","); // Field s2WeeklyAED
		$sFilterList = ew_Concat($sFilterList, $this->s2WeeklyKM->AdvancedSearch->ToJson(), ","); // Field s2WeeklyKM
		$sFilterList = ew_Concat($sFilterList, $this->s3WeeklyAED->AdvancedSearch->ToJson(), ","); // Field s3WeeklyAED
		$sFilterList = ew_Concat($sFilterList, $this->s3WeeklyKM->AdvancedSearch->ToJson(), ","); // Field s3WeeklyKM
		$sFilterList = ew_Concat($sFilterList, $this->s4WeeklyAED->AdvancedSearch->ToJson(), ","); // Field s4WeeklyAED
		$sFilterList = ew_Concat($sFilterList, $this->s4WeeklyKM->AdvancedSearch->ToJson(), ","); // Field s4WeeklyKM
		$sFilterList = ew_Concat($sFilterList, $this->s5WeeklyAED->AdvancedSearch->ToJson(), ","); // Field s5WeeklyAED
		$sFilterList = ew_Concat($sFilterList, $this->s5WeeklyKM->AdvancedSearch->ToJson(), ","); // Field s5WeeklyKM
		$sFilterList = ew_Concat($sFilterList, $this->s1MonthlyAED->AdvancedSearch->ToJson(), ","); // Field s1MonthlyAED
		$sFilterList = ew_Concat($sFilterList, $this->s1MonthlyKM->AdvancedSearch->ToJson(), ","); // Field s1MonthlyKM
		$sFilterList = ew_Concat($sFilterList, $this->s2MonthlyAED->AdvancedSearch->ToJson(), ","); // Field s2MonthlyAED
		$sFilterList = ew_Concat($sFilterList, $this->s2MonthlyKM->AdvancedSearch->ToJson(), ","); // Field s2MonthlyKM
		$sFilterList = ew_Concat($sFilterList, $this->s3MonthlyAED->AdvancedSearch->ToJson(), ","); // Field s3MonthlyAED
		$sFilterList = ew_Concat($sFilterList, $this->s3MonthlyKM->AdvancedSearch->ToJson(), ","); // Field s3MonthlyKM
		$sFilterList = ew_Concat($sFilterList, $this->s4MonthlyAED->AdvancedSearch->ToJson(), ","); // Field s4MonthlyAED
		$sFilterList = ew_Concat($sFilterList, $this->s4MonthlyKM->AdvancedSearch->ToJson(), ","); // Field s4MonthlyKM
		$sFilterList = ew_Concat($sFilterList, $this->s5MonthlyAED->AdvancedSearch->ToJson(), ","); // Field s5MonthlyAED
		$sFilterList = ew_Concat($sFilterList, $this->s5MonthlyKM->AdvancedSearch->ToJson(), ","); // Field s5MonthlyKM
		$sFilterList = ew_Concat($sFilterList, $this->active->AdvancedSearch->ToJson(), ","); // Field active
		$sFilterList = ew_Concat($sFilterList, $this->phase1OrangeCard->AdvancedSearch->ToJson(), ","); // Field phase1OrangeCard
		$sFilterList = ew_Concat($sFilterList, $this->phase1GPS->AdvancedSearch->ToJson(), ","); // Field phase1GPS
		$sFilterList = ew_Concat($sFilterList, $this->phase1DeliveryCharges->AdvancedSearch->ToJson(), ","); // Field phase1DeliveryCharges
		$sFilterList = ew_Concat($sFilterList, $this->phase1CollectionCharges->AdvancedSearch->ToJson(), ","); // Field phase1CollectionCharges
		$sFilterList = ew_Concat($sFilterList, $this->addon01KM->AdvancedSearch->ToJson(), ","); // Field addon01KM
		$sFilterList = ew_Concat($sFilterList, $this->addon01Price->AdvancedSearch->ToJson(), ","); // Field addon01Price
		$sFilterList = ew_Concat($sFilterList, $this->addon02KM->AdvancedSearch->ToJson(), ","); // Field addon02KM
		$sFilterList = ew_Concat($sFilterList, $this->addon02Price->AdvancedSearch->ToJson(), ","); // Field addon02Price
		$sFilterList = ew_Concat($sFilterList, $this->addon03KM->AdvancedSearch->ToJson(), ","); // Field addon03KM
		$sFilterList = ew_Concat($sFilterList, $this->addon03Price->AdvancedSearch->ToJson(), ","); // Field addon03Price
		$sFilterList = ew_Concat($sFilterList, $this->addon04KM->AdvancedSearch->ToJson(), ","); // Field addon04KM
		$sFilterList = ew_Concat($sFilterList, $this->addon04Price->AdvancedSearch->ToJson(), ","); // Field addon04Price
		$sFilterList = ew_Concat($sFilterList, $this->addon05KM->AdvancedSearch->ToJson(), ","); // Field addon05KM
		$sFilterList = ew_Concat($sFilterList, $this->addon05Price->AdvancedSearch->ToJson(), ","); // Field addon05Price
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
			$UserProfile->SetSearchFilters(CurrentUserName(), "fpay_as_you_drivelistsrch", $filters);

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

		// Field payDriveCarID
		$this->payDriveCarID->AdvancedSearch->SearchValue = @$filter["x_payDriveCarID"];
		$this->payDriveCarID->AdvancedSearch->SearchOperator = @$filter["z_payDriveCarID"];
		$this->payDriveCarID->AdvancedSearch->SearchCondition = @$filter["v_payDriveCarID"];
		$this->payDriveCarID->AdvancedSearch->SearchValue2 = @$filter["y_payDriveCarID"];
		$this->payDriveCarID->AdvancedSearch->SearchOperator2 = @$filter["w_payDriveCarID"];
		$this->payDriveCarID->AdvancedSearch->Save();

		// Field bodyTypeID
		$this->bodyTypeID->AdvancedSearch->SearchValue = @$filter["x_bodyTypeID"];
		$this->bodyTypeID->AdvancedSearch->SearchOperator = @$filter["z_bodyTypeID"];
		$this->bodyTypeID->AdvancedSearch->SearchCondition = @$filter["v_bodyTypeID"];
		$this->bodyTypeID->AdvancedSearch->SearchValue2 = @$filter["y_bodyTypeID"];
		$this->bodyTypeID->AdvancedSearch->SearchOperator2 = @$filter["w_bodyTypeID"];
		$this->bodyTypeID->AdvancedSearch->Save();

		// Field carTitle
		$this->carTitle->AdvancedSearch->SearchValue = @$filter["x_carTitle"];
		$this->carTitle->AdvancedSearch->SearchOperator = @$filter["z_carTitle"];
		$this->carTitle->AdvancedSearch->SearchCondition = @$filter["v_carTitle"];
		$this->carTitle->AdvancedSearch->SearchValue2 = @$filter["y_carTitle"];
		$this->carTitle->AdvancedSearch->SearchOperator2 = @$filter["w_carTitle"];
		$this->carTitle->AdvancedSearch->Save();

		// Field slug
		$this->slug->AdvancedSearch->SearchValue = @$filter["x_slug"];
		$this->slug->AdvancedSearch->SearchOperator = @$filter["z_slug"];
		$this->slug->AdvancedSearch->SearchCondition = @$filter["v_slug"];
		$this->slug->AdvancedSearch->SearchValue2 = @$filter["y_slug"];
		$this->slug->AdvancedSearch->SearchOperator2 = @$filter["w_slug"];
		$this->slug->AdvancedSearch->Save();

		// Field image
		$this->image->AdvancedSearch->SearchValue = @$filter["x_image"];
		$this->image->AdvancedSearch->SearchOperator = @$filter["z_image"];
		$this->image->AdvancedSearch->SearchCondition = @$filter["v_image"];
		$this->image->AdvancedSearch->SearchValue2 = @$filter["y_image"];
		$this->image->AdvancedSearch->SearchOperator2 = @$filter["w_image"];
		$this->image->AdvancedSearch->Save();

		// Field extraFeatures
		$this->extraFeatures->AdvancedSearch->SearchValue = @$filter["x_extraFeatures"];
		$this->extraFeatures->AdvancedSearch->SearchOperator = @$filter["z_extraFeatures"];
		$this->extraFeatures->AdvancedSearch->SearchCondition = @$filter["v_extraFeatures"];
		$this->extraFeatures->AdvancedSearch->SearchValue2 = @$filter["y_extraFeatures"];
		$this->extraFeatures->AdvancedSearch->SearchOperator2 = @$filter["w_extraFeatures"];
		$this->extraFeatures->AdvancedSearch->Save();

		// Field noOfSeats
		$this->noOfSeats->AdvancedSearch->SearchValue = @$filter["x_noOfSeats"];
		$this->noOfSeats->AdvancedSearch->SearchOperator = @$filter["z_noOfSeats"];
		$this->noOfSeats->AdvancedSearch->SearchCondition = @$filter["v_noOfSeats"];
		$this->noOfSeats->AdvancedSearch->SearchValue2 = @$filter["y_noOfSeats"];
		$this->noOfSeats->AdvancedSearch->SearchOperator2 = @$filter["w_noOfSeats"];
		$this->noOfSeats->AdvancedSearch->Save();

		// Field luggage
		$this->luggage->AdvancedSearch->SearchValue = @$filter["x_luggage"];
		$this->luggage->AdvancedSearch->SearchOperator = @$filter["z_luggage"];
		$this->luggage->AdvancedSearch->SearchCondition = @$filter["v_luggage"];
		$this->luggage->AdvancedSearch->SearchValue2 = @$filter["y_luggage"];
		$this->luggage->AdvancedSearch->SearchOperator2 = @$filter["w_luggage"];
		$this->luggage->AdvancedSearch->Save();

		// Field transmissionID
		$this->transmissionID->AdvancedSearch->SearchValue = @$filter["x_transmissionID"];
		$this->transmissionID->AdvancedSearch->SearchOperator = @$filter["z_transmissionID"];
		$this->transmissionID->AdvancedSearch->SearchCondition = @$filter["v_transmissionID"];
		$this->transmissionID->AdvancedSearch->SearchValue2 = @$filter["y_transmissionID"];
		$this->transmissionID->AdvancedSearch->SearchOperator2 = @$filter["w_transmissionID"];
		$this->transmissionID->AdvancedSearch->Save();

		// Field ac
		$this->ac->AdvancedSearch->SearchValue = @$filter["x_ac"];
		$this->ac->AdvancedSearch->SearchOperator = @$filter["z_ac"];
		$this->ac->AdvancedSearch->SearchCondition = @$filter["v_ac"];
		$this->ac->AdvancedSearch->SearchValue2 = @$filter["y_ac"];
		$this->ac->AdvancedSearch->SearchOperator2 = @$filter["w_ac"];
		$this->ac->AdvancedSearch->Save();

		// Field noOfDoors
		$this->noOfDoors->AdvancedSearch->SearchValue = @$filter["x_noOfDoors"];
		$this->noOfDoors->AdvancedSearch->SearchOperator = @$filter["z_noOfDoors"];
		$this->noOfDoors->AdvancedSearch->SearchCondition = @$filter["v_noOfDoors"];
		$this->noOfDoors->AdvancedSearch->SearchValue2 = @$filter["y_noOfDoors"];
		$this->noOfDoors->AdvancedSearch->SearchOperator2 = @$filter["w_noOfDoors"];
		$this->noOfDoors->AdvancedSearch->Save();

		// Field s1DailyAED
		$this->s1DailyAED->AdvancedSearch->SearchValue = @$filter["x_s1DailyAED"];
		$this->s1DailyAED->AdvancedSearch->SearchOperator = @$filter["z_s1DailyAED"];
		$this->s1DailyAED->AdvancedSearch->SearchCondition = @$filter["v_s1DailyAED"];
		$this->s1DailyAED->AdvancedSearch->SearchValue2 = @$filter["y_s1DailyAED"];
		$this->s1DailyAED->AdvancedSearch->SearchOperator2 = @$filter["w_s1DailyAED"];
		$this->s1DailyAED->AdvancedSearch->Save();

		// Field s1DailyKM
		$this->s1DailyKM->AdvancedSearch->SearchValue = @$filter["x_s1DailyKM"];
		$this->s1DailyKM->AdvancedSearch->SearchOperator = @$filter["z_s1DailyKM"];
		$this->s1DailyKM->AdvancedSearch->SearchCondition = @$filter["v_s1DailyKM"];
		$this->s1DailyKM->AdvancedSearch->SearchValue2 = @$filter["y_s1DailyKM"];
		$this->s1DailyKM->AdvancedSearch->SearchOperator2 = @$filter["w_s1DailyKM"];
		$this->s1DailyKM->AdvancedSearch->Save();

		// Field s2DailyAED
		$this->s2DailyAED->AdvancedSearch->SearchValue = @$filter["x_s2DailyAED"];
		$this->s2DailyAED->AdvancedSearch->SearchOperator = @$filter["z_s2DailyAED"];
		$this->s2DailyAED->AdvancedSearch->SearchCondition = @$filter["v_s2DailyAED"];
		$this->s2DailyAED->AdvancedSearch->SearchValue2 = @$filter["y_s2DailyAED"];
		$this->s2DailyAED->AdvancedSearch->SearchOperator2 = @$filter["w_s2DailyAED"];
		$this->s2DailyAED->AdvancedSearch->Save();

		// Field s2DailyKM
		$this->s2DailyKM->AdvancedSearch->SearchValue = @$filter["x_s2DailyKM"];
		$this->s2DailyKM->AdvancedSearch->SearchOperator = @$filter["z_s2DailyKM"];
		$this->s2DailyKM->AdvancedSearch->SearchCondition = @$filter["v_s2DailyKM"];
		$this->s2DailyKM->AdvancedSearch->SearchValue2 = @$filter["y_s2DailyKM"];
		$this->s2DailyKM->AdvancedSearch->SearchOperator2 = @$filter["w_s2DailyKM"];
		$this->s2DailyKM->AdvancedSearch->Save();

		// Field s3DailyAED
		$this->s3DailyAED->AdvancedSearch->SearchValue = @$filter["x_s3DailyAED"];
		$this->s3DailyAED->AdvancedSearch->SearchOperator = @$filter["z_s3DailyAED"];
		$this->s3DailyAED->AdvancedSearch->SearchCondition = @$filter["v_s3DailyAED"];
		$this->s3DailyAED->AdvancedSearch->SearchValue2 = @$filter["y_s3DailyAED"];
		$this->s3DailyAED->AdvancedSearch->SearchOperator2 = @$filter["w_s3DailyAED"];
		$this->s3DailyAED->AdvancedSearch->Save();

		// Field s3DailyKM
		$this->s3DailyKM->AdvancedSearch->SearchValue = @$filter["x_s3DailyKM"];
		$this->s3DailyKM->AdvancedSearch->SearchOperator = @$filter["z_s3DailyKM"];
		$this->s3DailyKM->AdvancedSearch->SearchCondition = @$filter["v_s3DailyKM"];
		$this->s3DailyKM->AdvancedSearch->SearchValue2 = @$filter["y_s3DailyKM"];
		$this->s3DailyKM->AdvancedSearch->SearchOperator2 = @$filter["w_s3DailyKM"];
		$this->s3DailyKM->AdvancedSearch->Save();

		// Field s4DailyAED
		$this->s4DailyAED->AdvancedSearch->SearchValue = @$filter["x_s4DailyAED"];
		$this->s4DailyAED->AdvancedSearch->SearchOperator = @$filter["z_s4DailyAED"];
		$this->s4DailyAED->AdvancedSearch->SearchCondition = @$filter["v_s4DailyAED"];
		$this->s4DailyAED->AdvancedSearch->SearchValue2 = @$filter["y_s4DailyAED"];
		$this->s4DailyAED->AdvancedSearch->SearchOperator2 = @$filter["w_s4DailyAED"];
		$this->s4DailyAED->AdvancedSearch->Save();

		// Field s4DailyKM
		$this->s4DailyKM->AdvancedSearch->SearchValue = @$filter["x_s4DailyKM"];
		$this->s4DailyKM->AdvancedSearch->SearchOperator = @$filter["z_s4DailyKM"];
		$this->s4DailyKM->AdvancedSearch->SearchCondition = @$filter["v_s4DailyKM"];
		$this->s4DailyKM->AdvancedSearch->SearchValue2 = @$filter["y_s4DailyKM"];
		$this->s4DailyKM->AdvancedSearch->SearchOperator2 = @$filter["w_s4DailyKM"];
		$this->s4DailyKM->AdvancedSearch->Save();

		// Field s5DailyAED
		$this->s5DailyAED->AdvancedSearch->SearchValue = @$filter["x_s5DailyAED"];
		$this->s5DailyAED->AdvancedSearch->SearchOperator = @$filter["z_s5DailyAED"];
		$this->s5DailyAED->AdvancedSearch->SearchCondition = @$filter["v_s5DailyAED"];
		$this->s5DailyAED->AdvancedSearch->SearchValue2 = @$filter["y_s5DailyAED"];
		$this->s5DailyAED->AdvancedSearch->SearchOperator2 = @$filter["w_s5DailyAED"];
		$this->s5DailyAED->AdvancedSearch->Save();

		// Field s5DailyKM
		$this->s5DailyKM->AdvancedSearch->SearchValue = @$filter["x_s5DailyKM"];
		$this->s5DailyKM->AdvancedSearch->SearchOperator = @$filter["z_s5DailyKM"];
		$this->s5DailyKM->AdvancedSearch->SearchCondition = @$filter["v_s5DailyKM"];
		$this->s5DailyKM->AdvancedSearch->SearchValue2 = @$filter["y_s5DailyKM"];
		$this->s5DailyKM->AdvancedSearch->SearchOperator2 = @$filter["w_s5DailyKM"];
		$this->s5DailyKM->AdvancedSearch->Save();

		// Field s1WeeklyAED
		$this->s1WeeklyAED->AdvancedSearch->SearchValue = @$filter["x_s1WeeklyAED"];
		$this->s1WeeklyAED->AdvancedSearch->SearchOperator = @$filter["z_s1WeeklyAED"];
		$this->s1WeeklyAED->AdvancedSearch->SearchCondition = @$filter["v_s1WeeklyAED"];
		$this->s1WeeklyAED->AdvancedSearch->SearchValue2 = @$filter["y_s1WeeklyAED"];
		$this->s1WeeklyAED->AdvancedSearch->SearchOperator2 = @$filter["w_s1WeeklyAED"];
		$this->s1WeeklyAED->AdvancedSearch->Save();

		// Field s1WeeklyKM
		$this->s1WeeklyKM->AdvancedSearch->SearchValue = @$filter["x_s1WeeklyKM"];
		$this->s1WeeklyKM->AdvancedSearch->SearchOperator = @$filter["z_s1WeeklyKM"];
		$this->s1WeeklyKM->AdvancedSearch->SearchCondition = @$filter["v_s1WeeklyKM"];
		$this->s1WeeklyKM->AdvancedSearch->SearchValue2 = @$filter["y_s1WeeklyKM"];
		$this->s1WeeklyKM->AdvancedSearch->SearchOperator2 = @$filter["w_s1WeeklyKM"];
		$this->s1WeeklyKM->AdvancedSearch->Save();

		// Field s2WeeklyAED
		$this->s2WeeklyAED->AdvancedSearch->SearchValue = @$filter["x_s2WeeklyAED"];
		$this->s2WeeklyAED->AdvancedSearch->SearchOperator = @$filter["z_s2WeeklyAED"];
		$this->s2WeeklyAED->AdvancedSearch->SearchCondition = @$filter["v_s2WeeklyAED"];
		$this->s2WeeklyAED->AdvancedSearch->SearchValue2 = @$filter["y_s2WeeklyAED"];
		$this->s2WeeklyAED->AdvancedSearch->SearchOperator2 = @$filter["w_s2WeeklyAED"];
		$this->s2WeeklyAED->AdvancedSearch->Save();

		// Field s2WeeklyKM
		$this->s2WeeklyKM->AdvancedSearch->SearchValue = @$filter["x_s2WeeklyKM"];
		$this->s2WeeklyKM->AdvancedSearch->SearchOperator = @$filter["z_s2WeeklyKM"];
		$this->s2WeeklyKM->AdvancedSearch->SearchCondition = @$filter["v_s2WeeklyKM"];
		$this->s2WeeklyKM->AdvancedSearch->SearchValue2 = @$filter["y_s2WeeklyKM"];
		$this->s2WeeklyKM->AdvancedSearch->SearchOperator2 = @$filter["w_s2WeeklyKM"];
		$this->s2WeeklyKM->AdvancedSearch->Save();

		// Field s3WeeklyAED
		$this->s3WeeklyAED->AdvancedSearch->SearchValue = @$filter["x_s3WeeklyAED"];
		$this->s3WeeklyAED->AdvancedSearch->SearchOperator = @$filter["z_s3WeeklyAED"];
		$this->s3WeeklyAED->AdvancedSearch->SearchCondition = @$filter["v_s3WeeklyAED"];
		$this->s3WeeklyAED->AdvancedSearch->SearchValue2 = @$filter["y_s3WeeklyAED"];
		$this->s3WeeklyAED->AdvancedSearch->SearchOperator2 = @$filter["w_s3WeeklyAED"];
		$this->s3WeeklyAED->AdvancedSearch->Save();

		// Field s3WeeklyKM
		$this->s3WeeklyKM->AdvancedSearch->SearchValue = @$filter["x_s3WeeklyKM"];
		$this->s3WeeklyKM->AdvancedSearch->SearchOperator = @$filter["z_s3WeeklyKM"];
		$this->s3WeeklyKM->AdvancedSearch->SearchCondition = @$filter["v_s3WeeklyKM"];
		$this->s3WeeklyKM->AdvancedSearch->SearchValue2 = @$filter["y_s3WeeklyKM"];
		$this->s3WeeklyKM->AdvancedSearch->SearchOperator2 = @$filter["w_s3WeeklyKM"];
		$this->s3WeeklyKM->AdvancedSearch->Save();

		// Field s4WeeklyAED
		$this->s4WeeklyAED->AdvancedSearch->SearchValue = @$filter["x_s4WeeklyAED"];
		$this->s4WeeklyAED->AdvancedSearch->SearchOperator = @$filter["z_s4WeeklyAED"];
		$this->s4WeeklyAED->AdvancedSearch->SearchCondition = @$filter["v_s4WeeklyAED"];
		$this->s4WeeklyAED->AdvancedSearch->SearchValue2 = @$filter["y_s4WeeklyAED"];
		$this->s4WeeklyAED->AdvancedSearch->SearchOperator2 = @$filter["w_s4WeeklyAED"];
		$this->s4WeeklyAED->AdvancedSearch->Save();

		// Field s4WeeklyKM
		$this->s4WeeklyKM->AdvancedSearch->SearchValue = @$filter["x_s4WeeklyKM"];
		$this->s4WeeklyKM->AdvancedSearch->SearchOperator = @$filter["z_s4WeeklyKM"];
		$this->s4WeeklyKM->AdvancedSearch->SearchCondition = @$filter["v_s4WeeklyKM"];
		$this->s4WeeklyKM->AdvancedSearch->SearchValue2 = @$filter["y_s4WeeklyKM"];
		$this->s4WeeklyKM->AdvancedSearch->SearchOperator2 = @$filter["w_s4WeeklyKM"];
		$this->s4WeeklyKM->AdvancedSearch->Save();

		// Field s5WeeklyAED
		$this->s5WeeklyAED->AdvancedSearch->SearchValue = @$filter["x_s5WeeklyAED"];
		$this->s5WeeklyAED->AdvancedSearch->SearchOperator = @$filter["z_s5WeeklyAED"];
		$this->s5WeeklyAED->AdvancedSearch->SearchCondition = @$filter["v_s5WeeklyAED"];
		$this->s5WeeklyAED->AdvancedSearch->SearchValue2 = @$filter["y_s5WeeklyAED"];
		$this->s5WeeklyAED->AdvancedSearch->SearchOperator2 = @$filter["w_s5WeeklyAED"];
		$this->s5WeeklyAED->AdvancedSearch->Save();

		// Field s5WeeklyKM
		$this->s5WeeklyKM->AdvancedSearch->SearchValue = @$filter["x_s5WeeklyKM"];
		$this->s5WeeklyKM->AdvancedSearch->SearchOperator = @$filter["z_s5WeeklyKM"];
		$this->s5WeeklyKM->AdvancedSearch->SearchCondition = @$filter["v_s5WeeklyKM"];
		$this->s5WeeklyKM->AdvancedSearch->SearchValue2 = @$filter["y_s5WeeklyKM"];
		$this->s5WeeklyKM->AdvancedSearch->SearchOperator2 = @$filter["w_s5WeeklyKM"];
		$this->s5WeeklyKM->AdvancedSearch->Save();

		// Field s1MonthlyAED
		$this->s1MonthlyAED->AdvancedSearch->SearchValue = @$filter["x_s1MonthlyAED"];
		$this->s1MonthlyAED->AdvancedSearch->SearchOperator = @$filter["z_s1MonthlyAED"];
		$this->s1MonthlyAED->AdvancedSearch->SearchCondition = @$filter["v_s1MonthlyAED"];
		$this->s1MonthlyAED->AdvancedSearch->SearchValue2 = @$filter["y_s1MonthlyAED"];
		$this->s1MonthlyAED->AdvancedSearch->SearchOperator2 = @$filter["w_s1MonthlyAED"];
		$this->s1MonthlyAED->AdvancedSearch->Save();

		// Field s1MonthlyKM
		$this->s1MonthlyKM->AdvancedSearch->SearchValue = @$filter["x_s1MonthlyKM"];
		$this->s1MonthlyKM->AdvancedSearch->SearchOperator = @$filter["z_s1MonthlyKM"];
		$this->s1MonthlyKM->AdvancedSearch->SearchCondition = @$filter["v_s1MonthlyKM"];
		$this->s1MonthlyKM->AdvancedSearch->SearchValue2 = @$filter["y_s1MonthlyKM"];
		$this->s1MonthlyKM->AdvancedSearch->SearchOperator2 = @$filter["w_s1MonthlyKM"];
		$this->s1MonthlyKM->AdvancedSearch->Save();

		// Field s2MonthlyAED
		$this->s2MonthlyAED->AdvancedSearch->SearchValue = @$filter["x_s2MonthlyAED"];
		$this->s2MonthlyAED->AdvancedSearch->SearchOperator = @$filter["z_s2MonthlyAED"];
		$this->s2MonthlyAED->AdvancedSearch->SearchCondition = @$filter["v_s2MonthlyAED"];
		$this->s2MonthlyAED->AdvancedSearch->SearchValue2 = @$filter["y_s2MonthlyAED"];
		$this->s2MonthlyAED->AdvancedSearch->SearchOperator2 = @$filter["w_s2MonthlyAED"];
		$this->s2MonthlyAED->AdvancedSearch->Save();

		// Field s2MonthlyKM
		$this->s2MonthlyKM->AdvancedSearch->SearchValue = @$filter["x_s2MonthlyKM"];
		$this->s2MonthlyKM->AdvancedSearch->SearchOperator = @$filter["z_s2MonthlyKM"];
		$this->s2MonthlyKM->AdvancedSearch->SearchCondition = @$filter["v_s2MonthlyKM"];
		$this->s2MonthlyKM->AdvancedSearch->SearchValue2 = @$filter["y_s2MonthlyKM"];
		$this->s2MonthlyKM->AdvancedSearch->SearchOperator2 = @$filter["w_s2MonthlyKM"];
		$this->s2MonthlyKM->AdvancedSearch->Save();

		// Field s3MonthlyAED
		$this->s3MonthlyAED->AdvancedSearch->SearchValue = @$filter["x_s3MonthlyAED"];
		$this->s3MonthlyAED->AdvancedSearch->SearchOperator = @$filter["z_s3MonthlyAED"];
		$this->s3MonthlyAED->AdvancedSearch->SearchCondition = @$filter["v_s3MonthlyAED"];
		$this->s3MonthlyAED->AdvancedSearch->SearchValue2 = @$filter["y_s3MonthlyAED"];
		$this->s3MonthlyAED->AdvancedSearch->SearchOperator2 = @$filter["w_s3MonthlyAED"];
		$this->s3MonthlyAED->AdvancedSearch->Save();

		// Field s3MonthlyKM
		$this->s3MonthlyKM->AdvancedSearch->SearchValue = @$filter["x_s3MonthlyKM"];
		$this->s3MonthlyKM->AdvancedSearch->SearchOperator = @$filter["z_s3MonthlyKM"];
		$this->s3MonthlyKM->AdvancedSearch->SearchCondition = @$filter["v_s3MonthlyKM"];
		$this->s3MonthlyKM->AdvancedSearch->SearchValue2 = @$filter["y_s3MonthlyKM"];
		$this->s3MonthlyKM->AdvancedSearch->SearchOperator2 = @$filter["w_s3MonthlyKM"];
		$this->s3MonthlyKM->AdvancedSearch->Save();

		// Field s4MonthlyAED
		$this->s4MonthlyAED->AdvancedSearch->SearchValue = @$filter["x_s4MonthlyAED"];
		$this->s4MonthlyAED->AdvancedSearch->SearchOperator = @$filter["z_s4MonthlyAED"];
		$this->s4MonthlyAED->AdvancedSearch->SearchCondition = @$filter["v_s4MonthlyAED"];
		$this->s4MonthlyAED->AdvancedSearch->SearchValue2 = @$filter["y_s4MonthlyAED"];
		$this->s4MonthlyAED->AdvancedSearch->SearchOperator2 = @$filter["w_s4MonthlyAED"];
		$this->s4MonthlyAED->AdvancedSearch->Save();

		// Field s4MonthlyKM
		$this->s4MonthlyKM->AdvancedSearch->SearchValue = @$filter["x_s4MonthlyKM"];
		$this->s4MonthlyKM->AdvancedSearch->SearchOperator = @$filter["z_s4MonthlyKM"];
		$this->s4MonthlyKM->AdvancedSearch->SearchCondition = @$filter["v_s4MonthlyKM"];
		$this->s4MonthlyKM->AdvancedSearch->SearchValue2 = @$filter["y_s4MonthlyKM"];
		$this->s4MonthlyKM->AdvancedSearch->SearchOperator2 = @$filter["w_s4MonthlyKM"];
		$this->s4MonthlyKM->AdvancedSearch->Save();

		// Field s5MonthlyAED
		$this->s5MonthlyAED->AdvancedSearch->SearchValue = @$filter["x_s5MonthlyAED"];
		$this->s5MonthlyAED->AdvancedSearch->SearchOperator = @$filter["z_s5MonthlyAED"];
		$this->s5MonthlyAED->AdvancedSearch->SearchCondition = @$filter["v_s5MonthlyAED"];
		$this->s5MonthlyAED->AdvancedSearch->SearchValue2 = @$filter["y_s5MonthlyAED"];
		$this->s5MonthlyAED->AdvancedSearch->SearchOperator2 = @$filter["w_s5MonthlyAED"];
		$this->s5MonthlyAED->AdvancedSearch->Save();

		// Field s5MonthlyKM
		$this->s5MonthlyKM->AdvancedSearch->SearchValue = @$filter["x_s5MonthlyKM"];
		$this->s5MonthlyKM->AdvancedSearch->SearchOperator = @$filter["z_s5MonthlyKM"];
		$this->s5MonthlyKM->AdvancedSearch->SearchCondition = @$filter["v_s5MonthlyKM"];
		$this->s5MonthlyKM->AdvancedSearch->SearchValue2 = @$filter["y_s5MonthlyKM"];
		$this->s5MonthlyKM->AdvancedSearch->SearchOperator2 = @$filter["w_s5MonthlyKM"];
		$this->s5MonthlyKM->AdvancedSearch->Save();

		// Field active
		$this->active->AdvancedSearch->SearchValue = @$filter["x_active"];
		$this->active->AdvancedSearch->SearchOperator = @$filter["z_active"];
		$this->active->AdvancedSearch->SearchCondition = @$filter["v_active"];
		$this->active->AdvancedSearch->SearchValue2 = @$filter["y_active"];
		$this->active->AdvancedSearch->SearchOperator2 = @$filter["w_active"];
		$this->active->AdvancedSearch->Save();

		// Field phase1OrangeCard
		$this->phase1OrangeCard->AdvancedSearch->SearchValue = @$filter["x_phase1OrangeCard"];
		$this->phase1OrangeCard->AdvancedSearch->SearchOperator = @$filter["z_phase1OrangeCard"];
		$this->phase1OrangeCard->AdvancedSearch->SearchCondition = @$filter["v_phase1OrangeCard"];
		$this->phase1OrangeCard->AdvancedSearch->SearchValue2 = @$filter["y_phase1OrangeCard"];
		$this->phase1OrangeCard->AdvancedSearch->SearchOperator2 = @$filter["w_phase1OrangeCard"];
		$this->phase1OrangeCard->AdvancedSearch->Save();

		// Field phase1GPS
		$this->phase1GPS->AdvancedSearch->SearchValue = @$filter["x_phase1GPS"];
		$this->phase1GPS->AdvancedSearch->SearchOperator = @$filter["z_phase1GPS"];
		$this->phase1GPS->AdvancedSearch->SearchCondition = @$filter["v_phase1GPS"];
		$this->phase1GPS->AdvancedSearch->SearchValue2 = @$filter["y_phase1GPS"];
		$this->phase1GPS->AdvancedSearch->SearchOperator2 = @$filter["w_phase1GPS"];
		$this->phase1GPS->AdvancedSearch->Save();

		// Field phase1DeliveryCharges
		$this->phase1DeliveryCharges->AdvancedSearch->SearchValue = @$filter["x_phase1DeliveryCharges"];
		$this->phase1DeliveryCharges->AdvancedSearch->SearchOperator = @$filter["z_phase1DeliveryCharges"];
		$this->phase1DeliveryCharges->AdvancedSearch->SearchCondition = @$filter["v_phase1DeliveryCharges"];
		$this->phase1DeliveryCharges->AdvancedSearch->SearchValue2 = @$filter["y_phase1DeliveryCharges"];
		$this->phase1DeliveryCharges->AdvancedSearch->SearchOperator2 = @$filter["w_phase1DeliveryCharges"];
		$this->phase1DeliveryCharges->AdvancedSearch->Save();

		// Field phase1CollectionCharges
		$this->phase1CollectionCharges->AdvancedSearch->SearchValue = @$filter["x_phase1CollectionCharges"];
		$this->phase1CollectionCharges->AdvancedSearch->SearchOperator = @$filter["z_phase1CollectionCharges"];
		$this->phase1CollectionCharges->AdvancedSearch->SearchCondition = @$filter["v_phase1CollectionCharges"];
		$this->phase1CollectionCharges->AdvancedSearch->SearchValue2 = @$filter["y_phase1CollectionCharges"];
		$this->phase1CollectionCharges->AdvancedSearch->SearchOperator2 = @$filter["w_phase1CollectionCharges"];
		$this->phase1CollectionCharges->AdvancedSearch->Save();

		// Field addon01KM
		$this->addon01KM->AdvancedSearch->SearchValue = @$filter["x_addon01KM"];
		$this->addon01KM->AdvancedSearch->SearchOperator = @$filter["z_addon01KM"];
		$this->addon01KM->AdvancedSearch->SearchCondition = @$filter["v_addon01KM"];
		$this->addon01KM->AdvancedSearch->SearchValue2 = @$filter["y_addon01KM"];
		$this->addon01KM->AdvancedSearch->SearchOperator2 = @$filter["w_addon01KM"];
		$this->addon01KM->AdvancedSearch->Save();

		// Field addon01Price
		$this->addon01Price->AdvancedSearch->SearchValue = @$filter["x_addon01Price"];
		$this->addon01Price->AdvancedSearch->SearchOperator = @$filter["z_addon01Price"];
		$this->addon01Price->AdvancedSearch->SearchCondition = @$filter["v_addon01Price"];
		$this->addon01Price->AdvancedSearch->SearchValue2 = @$filter["y_addon01Price"];
		$this->addon01Price->AdvancedSearch->SearchOperator2 = @$filter["w_addon01Price"];
		$this->addon01Price->AdvancedSearch->Save();

		// Field addon02KM
		$this->addon02KM->AdvancedSearch->SearchValue = @$filter["x_addon02KM"];
		$this->addon02KM->AdvancedSearch->SearchOperator = @$filter["z_addon02KM"];
		$this->addon02KM->AdvancedSearch->SearchCondition = @$filter["v_addon02KM"];
		$this->addon02KM->AdvancedSearch->SearchValue2 = @$filter["y_addon02KM"];
		$this->addon02KM->AdvancedSearch->SearchOperator2 = @$filter["w_addon02KM"];
		$this->addon02KM->AdvancedSearch->Save();

		// Field addon02Price
		$this->addon02Price->AdvancedSearch->SearchValue = @$filter["x_addon02Price"];
		$this->addon02Price->AdvancedSearch->SearchOperator = @$filter["z_addon02Price"];
		$this->addon02Price->AdvancedSearch->SearchCondition = @$filter["v_addon02Price"];
		$this->addon02Price->AdvancedSearch->SearchValue2 = @$filter["y_addon02Price"];
		$this->addon02Price->AdvancedSearch->SearchOperator2 = @$filter["w_addon02Price"];
		$this->addon02Price->AdvancedSearch->Save();

		// Field addon03KM
		$this->addon03KM->AdvancedSearch->SearchValue = @$filter["x_addon03KM"];
		$this->addon03KM->AdvancedSearch->SearchOperator = @$filter["z_addon03KM"];
		$this->addon03KM->AdvancedSearch->SearchCondition = @$filter["v_addon03KM"];
		$this->addon03KM->AdvancedSearch->SearchValue2 = @$filter["y_addon03KM"];
		$this->addon03KM->AdvancedSearch->SearchOperator2 = @$filter["w_addon03KM"];
		$this->addon03KM->AdvancedSearch->Save();

		// Field addon03Price
		$this->addon03Price->AdvancedSearch->SearchValue = @$filter["x_addon03Price"];
		$this->addon03Price->AdvancedSearch->SearchOperator = @$filter["z_addon03Price"];
		$this->addon03Price->AdvancedSearch->SearchCondition = @$filter["v_addon03Price"];
		$this->addon03Price->AdvancedSearch->SearchValue2 = @$filter["y_addon03Price"];
		$this->addon03Price->AdvancedSearch->SearchOperator2 = @$filter["w_addon03Price"];
		$this->addon03Price->AdvancedSearch->Save();

		// Field addon04KM
		$this->addon04KM->AdvancedSearch->SearchValue = @$filter["x_addon04KM"];
		$this->addon04KM->AdvancedSearch->SearchOperator = @$filter["z_addon04KM"];
		$this->addon04KM->AdvancedSearch->SearchCondition = @$filter["v_addon04KM"];
		$this->addon04KM->AdvancedSearch->SearchValue2 = @$filter["y_addon04KM"];
		$this->addon04KM->AdvancedSearch->SearchOperator2 = @$filter["w_addon04KM"];
		$this->addon04KM->AdvancedSearch->Save();

		// Field addon04Price
		$this->addon04Price->AdvancedSearch->SearchValue = @$filter["x_addon04Price"];
		$this->addon04Price->AdvancedSearch->SearchOperator = @$filter["z_addon04Price"];
		$this->addon04Price->AdvancedSearch->SearchCondition = @$filter["v_addon04Price"];
		$this->addon04Price->AdvancedSearch->SearchValue2 = @$filter["y_addon04Price"];
		$this->addon04Price->AdvancedSearch->SearchOperator2 = @$filter["w_addon04Price"];
		$this->addon04Price->AdvancedSearch->Save();

		// Field addon05KM
		$this->addon05KM->AdvancedSearch->SearchValue = @$filter["x_addon05KM"];
		$this->addon05KM->AdvancedSearch->SearchOperator = @$filter["z_addon05KM"];
		$this->addon05KM->AdvancedSearch->SearchCondition = @$filter["v_addon05KM"];
		$this->addon05KM->AdvancedSearch->SearchValue2 = @$filter["y_addon05KM"];
		$this->addon05KM->AdvancedSearch->SearchOperator2 = @$filter["w_addon05KM"];
		$this->addon05KM->AdvancedSearch->Save();

		// Field addon05Price
		$this->addon05Price->AdvancedSearch->SearchValue = @$filter["x_addon05Price"];
		$this->addon05Price->AdvancedSearch->SearchOperator = @$filter["z_addon05Price"];
		$this->addon05Price->AdvancedSearch->SearchCondition = @$filter["v_addon05Price"];
		$this->addon05Price->AdvancedSearch->SearchValue2 = @$filter["y_addon05Price"];
		$this->addon05Price->AdvancedSearch->SearchOperator2 = @$filter["w_addon05Price"];
		$this->addon05Price->AdvancedSearch->Save();
		$this->BasicSearch->setKeyword(@$filter[EW_TABLE_BASIC_SEARCH]);
		$this->BasicSearch->setType(@$filter[EW_TABLE_BASIC_SEARCH_TYPE]);
	}

	// Return basic search SQL
	function BasicSearchSQL($arKeywords, $type) {
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $this->carTitle, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->slug, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->image, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->extraFeatures, $arKeywords, $type);
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
		return FALSE;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Load advanced search default values
	function LoadAdvancedSearchDefault() {
		return FALSE;
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		$this->BasicSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->Load();
	}

	// Set up sort parameters
	function SetupSortOrder() {

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = @$_GET["order"];
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->payDriveCarID); // payDriveCarID
			$this->UpdateSort($this->bodyTypeID); // bodyTypeID
			$this->UpdateSort($this->carTitle); // carTitle
			$this->UpdateSort($this->image); // image
			$this->UpdateSort($this->noOfSeats); // noOfSeats
			$this->UpdateSort($this->transmissionID); // transmissionID
			$this->UpdateSort($this->active); // active
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
				$this->payDriveCarID->setSort("");
				$this->bodyTypeID->setSort("");
				$this->carTitle->setSort("");
				$this->image->setSort("");
				$this->noOfSeats->setSort("");
				$this->transmissionID->setSort("");
				$this->active->setSort("");
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

		// "edit"
		$item = &$this->ListOptions->Add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->CanEdit();
		$item->OnLeft = FALSE;

		// "delete"
		$item = &$this->ListOptions->Add("delete");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->CanDelete();
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

		// "edit"
		$oListOpt = &$this->ListOptions->Items["edit"];
		$editcaption = ew_HtmlTitle($Language->Phrase("EditLink"));
		if ($Security->CanEdit()) {
			$oListOpt->Body = "<a class=\"ewRowLink ewEdit\" title=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" href=\"" . ew_HtmlEncode($this->EditUrl) . "\">" . $Language->Phrase("EditLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// "delete"
		$oListOpt = &$this->ListOptions->Items["delete"];
		if ($Security->CanDelete())
			$oListOpt->Body = "<a class=\"ewRowLink ewDelete\"" . "" . " title=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" href=\"" . ew_HtmlEncode($this->DeleteUrl) . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		else
			$oListOpt->Body = "";

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
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ewMultiSelect\" value=\"" . ew_HtmlEncode($this->payDriveCarID->CurrentValue) . "\" onclick=\"ew_ClickMultiCheckbox(event);\">";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["addedit"];

		// Add
		$item = &$option->Add("add");
		$addcaption = ew_HtmlTitle($Language->Phrase("AddLink"));
		$item->Body = "<a class=\"ewAddEdit ewAdd\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . ew_HtmlEncode($this->AddUrl) . "\">" . $Language->Phrase("AddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "" && $Security->CanAdd());
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fpay_as_you_drivelistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fpay_as_you_drivelistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.fpay_as_you_drivelist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fpay_as_you_drivelistsrch\">" . $Language->Phrase("SearchLink") . "</button>";
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

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("payDriveCarID")) <> "")
			$this->payDriveCarID->CurrentValue = $this->getKey("payDriveCarID"); // payDriveCarID
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

		$this->scdwDailyAED->CellCssStyle = "white-space: nowrap;";

		// scdwWeeklyAED
		$this->scdwWeeklyAED->CellCssStyle = "white-space: nowrap;";

		// scdwMonthlyAED
		$this->scdwMonthlyAED->CellCssStyle = "white-space: nowrap;";

		// cdwDailyAED
		$this->cdwDailyAED->CellCssStyle = "white-space: nowrap;";

		// cdwWeeklyAED
		$this->cdwWeeklyAED->CellCssStyle = "white-space: nowrap;";

		// cdwMonthlyAED
		$this->cdwMonthlyAED->CellCssStyle = "white-space: nowrap;";

		// paiDailyAED
		$this->paiDailyAED->CellCssStyle = "white-space: nowrap;";

		// paiWeeklyAED
		$this->paiWeeklyAED->CellCssStyle = "white-space: nowrap;";

		// paiMonthlyAED
		$this->paiMonthlyAED->CellCssStyle = "white-space: nowrap;";

		// gpsDailyAED
		$this->gpsDailyAED->CellCssStyle = "white-space: nowrap;";

		// gpsWeeklyAED
		$this->gpsWeeklyAED->CellCssStyle = "white-space: nowrap;";

		// gpsMonthlyAED
		$this->gpsMonthlyAED->CellCssStyle = "white-space: nowrap;";

		// additionalDriverDailyAED
		$this->additionalDriverDailyAED->CellCssStyle = "white-space: nowrap;";

		// additionalDriverWeeklyAED
		$this->additionalDriverWeeklyAED->CellCssStyle = "white-space: nowrap;";

		// additionalDriverMonthlyAED
		$this->additionalDriverMonthlyAED->CellCssStyle = "white-space: nowrap;";

		// babySafetySeatDailyAED
		$this->babySafetySeatDailyAED->CellCssStyle = "white-space: nowrap;";

		// babySafetySeatWeeklyAED
		$this->babySafetySeatWeeklyAED->CellCssStyle = "white-space: nowrap;";

		// babySafetySeatMonthlyAED
		$this->babySafetySeatMonthlyAED->CellCssStyle = "white-space: nowrap;";

		// addBabySafetySeatDailyAED
		$this->addBabySafetySeatDailyAED->CellCssStyle = "white-space: nowrap;";

		// addBabySafetySeatWeeklyAED
		$this->addBabySafetySeatWeeklyAED->CellCssStyle = "white-space: nowrap;";

		// addBabySafetySeatMonthlyAED
		$this->addBabySafetySeatMonthlyAED->CellCssStyle = "white-space: nowrap;";

		// deliveryAED
		$this->deliveryAED->CellCssStyle = "white-space: nowrap;";

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
				$this->image->LinkAttrs["data-rel"] = "pay_as_you_drive_x" . $this->RowCnt . "_image";
				ew_AppendClass($this->image->LinkAttrs["class"], "ewLightbox");
			}

			// noOfSeats
			$this->noOfSeats->LinkCustomAttributes = "";
			$this->noOfSeats->HrefValue = "";
			$this->noOfSeats->TooltipValue = "";

			// transmissionID
			$this->transmissionID->LinkCustomAttributes = "";
			$this->transmissionID->HrefValue = "";
			$this->transmissionID->TooltipValue = "";

			// active
			$this->active->LinkCustomAttributes = "";
			$this->active->HrefValue = "";
			$this->active->TooltipValue = "";
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
		$item->Visible = FALSE;

		// Export to Email
		$item = &$this->ExportOptions->Add("email");
		$url = "";
		$item->Body = "<button id=\"emf_pay_as_you_drive\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_pay_as_you_drive',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.fpay_as_you_drivelist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
if (!isset($pay_as_you_drive_list)) $pay_as_you_drive_list = new cpay_as_you_drive_list();

// Page init
$pay_as_you_drive_list->Page_Init();

// Page main
$pay_as_you_drive_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pay_as_you_drive_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($pay_as_you_drive->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = fpay_as_you_drivelist = new ew_Form("fpay_as_you_drivelist", "list");
fpay_as_you_drivelist.FormKeyCountName = '<?php echo $pay_as_you_drive_list->FormKeyCountName ?>';

// Form_CustomValidate event
fpay_as_you_drivelist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fpay_as_you_drivelist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fpay_as_you_drivelist.Lists["x_bodyTypeID"] = {"LinkField":"x_bodyTypeID","Ajax":true,"AutoFill":false,"DisplayFields":["x_bodytype","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_bodytype"};
fpay_as_you_drivelist.Lists["x_bodyTypeID"].Data = "<?php echo $pay_as_you_drive_list->bodyTypeID->LookupFilterQuery(FALSE, "list") ?>";
fpay_as_you_drivelist.Lists["x_transmissionID"] = {"LinkField":"x_transmissionID","Ajax":true,"AutoFill":false,"DisplayFields":["x_transmission","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_transmission"};
fpay_as_you_drivelist.Lists["x_transmissionID"].Data = "<?php echo $pay_as_you_drive_list->transmissionID->LookupFilterQuery(FALSE, "list") ?>";
fpay_as_you_drivelist.Lists["x_active"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fpay_as_you_drivelist.Lists["x_active"].Options = <?php echo json_encode($pay_as_you_drive_list->active->Options()) ?>;

// Form object for search
var CurrentSearchForm = fpay_as_you_drivelistsrch = new ew_Form("fpay_as_you_drivelistsrch");
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
<?php if ($pay_as_you_drive->Export == "") { ?>
<div class="ewToolbar">
<?php if ($pay_as_you_drive_list->TotalRecs > 0 && $pay_as_you_drive_list->ExportOptions->Visible()) { ?>
<?php $pay_as_you_drive_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($pay_as_you_drive_list->SearchOptions->Visible()) { ?>
<?php $pay_as_you_drive_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($pay_as_you_drive_list->FilterOptions->Visible()) { ?>
<?php $pay_as_you_drive_list->FilterOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
	$bSelectLimit = $pay_as_you_drive_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($pay_as_you_drive_list->TotalRecs <= 0)
			$pay_as_you_drive_list->TotalRecs = $pay_as_you_drive->ListRecordCount();
	} else {
		if (!$pay_as_you_drive_list->Recordset && ($pay_as_you_drive_list->Recordset = $pay_as_you_drive_list->LoadRecordset()))
			$pay_as_you_drive_list->TotalRecs = $pay_as_you_drive_list->Recordset->RecordCount();
	}
	$pay_as_you_drive_list->StartRec = 1;
	if ($pay_as_you_drive_list->DisplayRecs <= 0 || ($pay_as_you_drive->Export <> "" && $pay_as_you_drive->ExportAll)) // Display all records
		$pay_as_you_drive_list->DisplayRecs = $pay_as_you_drive_list->TotalRecs;
	if (!($pay_as_you_drive->Export <> "" && $pay_as_you_drive->ExportAll))
		$pay_as_you_drive_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$pay_as_you_drive_list->Recordset = $pay_as_you_drive_list->LoadRecordset($pay_as_you_drive_list->StartRec-1, $pay_as_you_drive_list->DisplayRecs);

	// Set no record found message
	if ($pay_as_you_drive->CurrentAction == "" && $pay_as_you_drive_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$pay_as_you_drive_list->setWarningMessage(ew_DeniedMsg());
		if ($pay_as_you_drive_list->SearchWhere == "0=101")
			$pay_as_you_drive_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$pay_as_you_drive_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$pay_as_you_drive_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($pay_as_you_drive->Export == "" && $pay_as_you_drive->CurrentAction == "") { ?>
<form name="fpay_as_you_drivelistsrch" id="fpay_as_you_drivelistsrch" class="form-inline ewForm ewExtSearchForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($pay_as_you_drive_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="fpay_as_you_drivelistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="pay_as_you_drive">
	<div class="ewBasicSearch">
<div id="xsr_1" class="ewRow">
	<div class="ewQuickSearch input-group">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo ew_HtmlEncode($pay_as_you_drive_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo ew_HtmlEncode($Language->Phrase("Search")) ?>">
	<input type="hidden" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo ew_HtmlEncode($pay_as_you_drive_list->BasicSearch->getType()) ?>">
	<div class="input-group-btn">
		<button type="button" data-toggle="dropdown" class="btn btn-default"><span id="searchtype"><?php echo $pay_as_you_drive_list->BasicSearch->getTypeNameShort() ?></span><span class="caret"></span></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li<?php if ($pay_as_you_drive_list->BasicSearch->getType() == "") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a></li>
			<li<?php if ($pay_as_you_drive_list->BasicSearch->getType() == "=") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a></li>
			<li<?php if ($pay_as_you_drive_list->BasicSearch->getType() == "AND") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a></li>
			<li<?php if ($pay_as_you_drive_list->BasicSearch->getType() == "OR") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a></li>
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
<?php $pay_as_you_drive_list->ShowPageHeader(); ?>
<?php
$pay_as_you_drive_list->ShowMessage();
?>
<?php if ($pay_as_you_drive_list->TotalRecs > 0 || $pay_as_you_drive->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($pay_as_you_drive_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> pay_as_you_drive">
<?php if ($pay_as_you_drive->Export == "") { ?>
<div class="box-header ewGridUpperPanel">
<?php if ($pay_as_you_drive->CurrentAction <> "gridadd" && $pay_as_you_drive->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($pay_as_you_drive_list->Pager)) $pay_as_you_drive_list->Pager = new cPrevNextPager($pay_as_you_drive_list->StartRec, $pay_as_you_drive_list->DisplayRecs, $pay_as_you_drive_list->TotalRecs, $pay_as_you_drive_list->AutoHidePager) ?>
<?php if ($pay_as_you_drive_list->Pager->RecordCount > 0 && $pay_as_you_drive_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($pay_as_you_drive_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $pay_as_you_drive_list->PageUrl() ?>start=<?php echo $pay_as_you_drive_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($pay_as_you_drive_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $pay_as_you_drive_list->PageUrl() ?>start=<?php echo $pay_as_you_drive_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $pay_as_you_drive_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($pay_as_you_drive_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $pay_as_you_drive_list->PageUrl() ?>start=<?php echo $pay_as_you_drive_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($pay_as_you_drive_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $pay_as_you_drive_list->PageUrl() ?>start=<?php echo $pay_as_you_drive_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $pay_as_you_drive_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $pay_as_you_drive_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $pay_as_you_drive_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $pay_as_you_drive_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($pay_as_you_drive_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpay_as_you_drivelist" id="fpay_as_you_drivelist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($pay_as_you_drive_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $pay_as_you_drive_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pay_as_you_drive">
<div id="gmp_pay_as_you_drive" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($pay_as_you_drive_list->TotalRecs > 0 || $pay_as_you_drive->CurrentAction == "gridedit") { ?>
<table id="tbl_pay_as_you_drivelist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$pay_as_you_drive_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$pay_as_you_drive_list->RenderListOptions();

// Render list options (header, left)
$pay_as_you_drive_list->ListOptions->Render("header", "left");
?>
<?php if ($pay_as_you_drive->payDriveCarID->Visible) { // payDriveCarID ?>
	<?php if ($pay_as_you_drive->SortUrl($pay_as_you_drive->payDriveCarID) == "") { ?>
		<th data-name="payDriveCarID" class="<?php echo $pay_as_you_drive->payDriveCarID->HeaderCellClass() ?>"><div id="elh_pay_as_you_drive_payDriveCarID" class="pay_as_you_drive_payDriveCarID"><div class="ewTableHeaderCaption"><?php echo $pay_as_you_drive->payDriveCarID->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="payDriveCarID" class="<?php echo $pay_as_you_drive->payDriveCarID->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pay_as_you_drive->SortUrl($pay_as_you_drive->payDriveCarID) ?>',1);"><div id="elh_pay_as_you_drive_payDriveCarID" class="pay_as_you_drive_payDriveCarID">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pay_as_you_drive->payDriveCarID->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($pay_as_you_drive->payDriveCarID->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pay_as_you_drive->payDriveCarID->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pay_as_you_drive->bodyTypeID->Visible) { // bodyTypeID ?>
	<?php if ($pay_as_you_drive->SortUrl($pay_as_you_drive->bodyTypeID) == "") { ?>
		<th data-name="bodyTypeID" class="<?php echo $pay_as_you_drive->bodyTypeID->HeaderCellClass() ?>"><div id="elh_pay_as_you_drive_bodyTypeID" class="pay_as_you_drive_bodyTypeID"><div class="ewTableHeaderCaption"><?php echo $pay_as_you_drive->bodyTypeID->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bodyTypeID" class="<?php echo $pay_as_you_drive->bodyTypeID->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pay_as_you_drive->SortUrl($pay_as_you_drive->bodyTypeID) ?>',1);"><div id="elh_pay_as_you_drive_bodyTypeID" class="pay_as_you_drive_bodyTypeID">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pay_as_you_drive->bodyTypeID->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($pay_as_you_drive->bodyTypeID->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pay_as_you_drive->bodyTypeID->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pay_as_you_drive->carTitle->Visible) { // carTitle ?>
	<?php if ($pay_as_you_drive->SortUrl($pay_as_you_drive->carTitle) == "") { ?>
		<th data-name="carTitle" class="<?php echo $pay_as_you_drive->carTitle->HeaderCellClass() ?>"><div id="elh_pay_as_you_drive_carTitle" class="pay_as_you_drive_carTitle"><div class="ewTableHeaderCaption"><?php echo $pay_as_you_drive->carTitle->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="carTitle" class="<?php echo $pay_as_you_drive->carTitle->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pay_as_you_drive->SortUrl($pay_as_you_drive->carTitle) ?>',1);"><div id="elh_pay_as_you_drive_carTitle" class="pay_as_you_drive_carTitle">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pay_as_you_drive->carTitle->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pay_as_you_drive->carTitle->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pay_as_you_drive->carTitle->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pay_as_you_drive->image->Visible) { // image ?>
	<?php if ($pay_as_you_drive->SortUrl($pay_as_you_drive->image) == "") { ?>
		<th data-name="image" class="<?php echo $pay_as_you_drive->image->HeaderCellClass() ?>"><div id="elh_pay_as_you_drive_image" class="pay_as_you_drive_image"><div class="ewTableHeaderCaption"><?php echo $pay_as_you_drive->image->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="image" class="<?php echo $pay_as_you_drive->image->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pay_as_you_drive->SortUrl($pay_as_you_drive->image) ?>',1);"><div id="elh_pay_as_you_drive_image" class="pay_as_you_drive_image">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pay_as_you_drive->image->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pay_as_you_drive->image->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pay_as_you_drive->image->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pay_as_you_drive->noOfSeats->Visible) { // noOfSeats ?>
	<?php if ($pay_as_you_drive->SortUrl($pay_as_you_drive->noOfSeats) == "") { ?>
		<th data-name="noOfSeats" class="<?php echo $pay_as_you_drive->noOfSeats->HeaderCellClass() ?>"><div id="elh_pay_as_you_drive_noOfSeats" class="pay_as_you_drive_noOfSeats"><div class="ewTableHeaderCaption"><?php echo $pay_as_you_drive->noOfSeats->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="noOfSeats" class="<?php echo $pay_as_you_drive->noOfSeats->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pay_as_you_drive->SortUrl($pay_as_you_drive->noOfSeats) ?>',1);"><div id="elh_pay_as_you_drive_noOfSeats" class="pay_as_you_drive_noOfSeats">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pay_as_you_drive->noOfSeats->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($pay_as_you_drive->noOfSeats->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pay_as_you_drive->noOfSeats->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pay_as_you_drive->transmissionID->Visible) { // transmissionID ?>
	<?php if ($pay_as_you_drive->SortUrl($pay_as_you_drive->transmissionID) == "") { ?>
		<th data-name="transmissionID" class="<?php echo $pay_as_you_drive->transmissionID->HeaderCellClass() ?>"><div id="elh_pay_as_you_drive_transmissionID" class="pay_as_you_drive_transmissionID"><div class="ewTableHeaderCaption"><?php echo $pay_as_you_drive->transmissionID->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmissionID" class="<?php echo $pay_as_you_drive->transmissionID->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pay_as_you_drive->SortUrl($pay_as_you_drive->transmissionID) ?>',1);"><div id="elh_pay_as_you_drive_transmissionID" class="pay_as_you_drive_transmissionID">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pay_as_you_drive->transmissionID->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($pay_as_you_drive->transmissionID->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pay_as_you_drive->transmissionID->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pay_as_you_drive->active->Visible) { // active ?>
	<?php if ($pay_as_you_drive->SortUrl($pay_as_you_drive->active) == "") { ?>
		<th data-name="active" class="<?php echo $pay_as_you_drive->active->HeaderCellClass() ?>"><div id="elh_pay_as_you_drive_active" class="pay_as_you_drive_active"><div class="ewTableHeaderCaption"><?php echo $pay_as_you_drive->active->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="active" class="<?php echo $pay_as_you_drive->active->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pay_as_you_drive->SortUrl($pay_as_you_drive->active) ?>',1);"><div id="elh_pay_as_you_drive_active" class="pay_as_you_drive_active">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pay_as_you_drive->active->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($pay_as_you_drive->active->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pay_as_you_drive->active->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$pay_as_you_drive_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($pay_as_you_drive->ExportAll && $pay_as_you_drive->Export <> "") {
	$pay_as_you_drive_list->StopRec = $pay_as_you_drive_list->TotalRecs;
} else {

	// Set the last record to display
	if ($pay_as_you_drive_list->TotalRecs > $pay_as_you_drive_list->StartRec + $pay_as_you_drive_list->DisplayRecs - 1)
		$pay_as_you_drive_list->StopRec = $pay_as_you_drive_list->StartRec + $pay_as_you_drive_list->DisplayRecs - 1;
	else
		$pay_as_you_drive_list->StopRec = $pay_as_you_drive_list->TotalRecs;
}
$pay_as_you_drive_list->RecCnt = $pay_as_you_drive_list->StartRec - 1;
if ($pay_as_you_drive_list->Recordset && !$pay_as_you_drive_list->Recordset->EOF) {
	$pay_as_you_drive_list->Recordset->MoveFirst();
	$bSelectLimit = $pay_as_you_drive_list->UseSelectLimit;
	if (!$bSelectLimit && $pay_as_you_drive_list->StartRec > 1)
		$pay_as_you_drive_list->Recordset->Move($pay_as_you_drive_list->StartRec - 1);
} elseif (!$pay_as_you_drive->AllowAddDeleteRow && $pay_as_you_drive_list->StopRec == 0) {
	$pay_as_you_drive_list->StopRec = $pay_as_you_drive->GridAddRowCount;
}

// Initialize aggregate
$pay_as_you_drive->RowType = EW_ROWTYPE_AGGREGATEINIT;
$pay_as_you_drive->ResetAttrs();
$pay_as_you_drive_list->RenderRow();
while ($pay_as_you_drive_list->RecCnt < $pay_as_you_drive_list->StopRec) {
	$pay_as_you_drive_list->RecCnt++;
	if (intval($pay_as_you_drive_list->RecCnt) >= intval($pay_as_you_drive_list->StartRec)) {
		$pay_as_you_drive_list->RowCnt++;

		// Set up key count
		$pay_as_you_drive_list->KeyCount = $pay_as_you_drive_list->RowIndex;

		// Init row class and style
		$pay_as_you_drive->ResetAttrs();
		$pay_as_you_drive->CssClass = "";
		if ($pay_as_you_drive->CurrentAction == "gridadd") {
		} else {
			$pay_as_you_drive_list->LoadRowValues($pay_as_you_drive_list->Recordset); // Load row values
		}
		$pay_as_you_drive->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$pay_as_you_drive->RowAttrs = array_merge($pay_as_you_drive->RowAttrs, array('data-rowindex'=>$pay_as_you_drive_list->RowCnt, 'id'=>'r' . $pay_as_you_drive_list->RowCnt . '_pay_as_you_drive', 'data-rowtype'=>$pay_as_you_drive->RowType));

		// Render row
		$pay_as_you_drive_list->RenderRow();

		// Render list options
		$pay_as_you_drive_list->RenderListOptions();
?>
	<tr<?php echo $pay_as_you_drive->RowAttributes() ?>>
<?php

// Render list options (body, left)
$pay_as_you_drive_list->ListOptions->Render("body", "left", $pay_as_you_drive_list->RowCnt);
?>
	<?php if ($pay_as_you_drive->payDriveCarID->Visible) { // payDriveCarID ?>
		<td data-name="payDriveCarID"<?php echo $pay_as_you_drive->payDriveCarID->CellAttributes() ?>>
<span id="el<?php echo $pay_as_you_drive_list->RowCnt ?>_pay_as_you_drive_payDriveCarID" class="pay_as_you_drive_payDriveCarID">
<span<?php echo $pay_as_you_drive->payDriveCarID->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->payDriveCarID->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pay_as_you_drive->bodyTypeID->Visible) { // bodyTypeID ?>
		<td data-name="bodyTypeID"<?php echo $pay_as_you_drive->bodyTypeID->CellAttributes() ?>>
<span id="el<?php echo $pay_as_you_drive_list->RowCnt ?>_pay_as_you_drive_bodyTypeID" class="pay_as_you_drive_bodyTypeID">
<span<?php echo $pay_as_you_drive->bodyTypeID->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->bodyTypeID->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pay_as_you_drive->carTitle->Visible) { // carTitle ?>
		<td data-name="carTitle"<?php echo $pay_as_you_drive->carTitle->CellAttributes() ?>>
<span id="el<?php echo $pay_as_you_drive_list->RowCnt ?>_pay_as_you_drive_carTitle" class="pay_as_you_drive_carTitle">
<span<?php echo $pay_as_you_drive->carTitle->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->carTitle->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pay_as_you_drive->image->Visible) { // image ?>
		<td data-name="image"<?php echo $pay_as_you_drive->image->CellAttributes() ?>>
<span id="el<?php echo $pay_as_you_drive_list->RowCnt ?>_pay_as_you_drive_image" class="pay_as_you_drive_image">
<span>
<?php echo ew_GetFileViewTag($pay_as_you_drive->image, $pay_as_you_drive->image->ListViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($pay_as_you_drive->noOfSeats->Visible) { // noOfSeats ?>
		<td data-name="noOfSeats"<?php echo $pay_as_you_drive->noOfSeats->CellAttributes() ?>>
<span id="el<?php echo $pay_as_you_drive_list->RowCnt ?>_pay_as_you_drive_noOfSeats" class="pay_as_you_drive_noOfSeats">
<span<?php echo $pay_as_you_drive->noOfSeats->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->noOfSeats->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pay_as_you_drive->transmissionID->Visible) { // transmissionID ?>
		<td data-name="transmissionID"<?php echo $pay_as_you_drive->transmissionID->CellAttributes() ?>>
<span id="el<?php echo $pay_as_you_drive_list->RowCnt ?>_pay_as_you_drive_transmissionID" class="pay_as_you_drive_transmissionID">
<span<?php echo $pay_as_you_drive->transmissionID->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->transmissionID->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pay_as_you_drive->active->Visible) { // active ?>
		<td data-name="active"<?php echo $pay_as_you_drive->active->CellAttributes() ?>>
<span id="el<?php echo $pay_as_you_drive_list->RowCnt ?>_pay_as_you_drive_active" class="pay_as_you_drive_active">
<span<?php echo $pay_as_you_drive->active->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->active->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pay_as_you_drive_list->ListOptions->Render("body", "right", $pay_as_you_drive_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($pay_as_you_drive->CurrentAction <> "gridadd")
		$pay_as_you_drive_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($pay_as_you_drive->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($pay_as_you_drive_list->Recordset)
	$pay_as_you_drive_list->Recordset->Close();
?>
<?php if ($pay_as_you_drive->Export == "") { ?>
<div class="box-footer ewGridLowerPanel">
<?php if ($pay_as_you_drive->CurrentAction <> "gridadd" && $pay_as_you_drive->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($pay_as_you_drive_list->Pager)) $pay_as_you_drive_list->Pager = new cPrevNextPager($pay_as_you_drive_list->StartRec, $pay_as_you_drive_list->DisplayRecs, $pay_as_you_drive_list->TotalRecs, $pay_as_you_drive_list->AutoHidePager) ?>
<?php if ($pay_as_you_drive_list->Pager->RecordCount > 0 && $pay_as_you_drive_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($pay_as_you_drive_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $pay_as_you_drive_list->PageUrl() ?>start=<?php echo $pay_as_you_drive_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($pay_as_you_drive_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $pay_as_you_drive_list->PageUrl() ?>start=<?php echo $pay_as_you_drive_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $pay_as_you_drive_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($pay_as_you_drive_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $pay_as_you_drive_list->PageUrl() ?>start=<?php echo $pay_as_you_drive_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($pay_as_you_drive_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $pay_as_you_drive_list->PageUrl() ?>start=<?php echo $pay_as_you_drive_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $pay_as_you_drive_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $pay_as_you_drive_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $pay_as_you_drive_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $pay_as_you_drive_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($pay_as_you_drive_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($pay_as_you_drive_list->TotalRecs == 0 && $pay_as_you_drive->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($pay_as_you_drive_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($pay_as_you_drive->Export == "") { ?>
<script type="text/javascript">
fpay_as_you_drivelistsrch.FilterList = <?php echo $pay_as_you_drive_list->GetFilterList() ?>;
fpay_as_you_drivelistsrch.Init();
fpay_as_you_drivelist.Init();
</script>
<?php } ?>
<?php
$pay_as_you_drive_list->ShowPageFooter();
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
$pay_as_you_drive_list->Page_Terminate();
?>
