<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "rent_lease_carsinfo.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$rent_lease_cars_list = NULL; // Initialize page object first

class crent_lease_cars_list extends crent_lease_cars {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'rent_lease_cars';

	// Page object name
	var $PageObjName = 'rent_lease_cars_list';

	// Grid form hidden field names
	var $FormName = 'frent_lease_carslist';
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

		// Table object (rent_lease_cars)
		if (!isset($GLOBALS["rent_lease_cars"]) || get_class($GLOBALS["rent_lease_cars"]) == "crent_lease_cars") {
			$GLOBALS["rent_lease_cars"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["rent_lease_cars"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "rent_lease_carsadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "rent_lease_carsdelete.php";
		$this->MultiUpdateUrl = "rent_lease_carsupdate.php";

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'rent_lease_cars', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption frent_lease_carslistsrch";

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
		$this->rentLeaseCarID->SetVisibility();
		$this->rentLeaseCarID->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
		$this->bodyTypeID->SetVisibility();
		$this->carTitle->SetVisibility();
		$this->image->SetVisibility();
		$this->active->SetVisibility();
		$this->weeklyDeals->SetVisibility();

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
		global $EW_EXPORT, $rent_lease_cars;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($rent_lease_cars);
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
			$this->rentLeaseCarID->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->rentLeaseCarID->FormValue))
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
			$sSavedFilterList = $UserProfile->GetSearchFilters(CurrentUserName(), "frent_lease_carslistsrch");
		$sFilterList = ew_Concat($sFilterList, $this->rentLeaseCarID->AdvancedSearch->ToJson(), ","); // Field rentLeaseCarID
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
		$sFilterList = ew_Concat($sFilterList, $this->deliveryAED->AdvancedSearch->ToJson(), ","); // Field deliveryAED
		$sFilterList = ew_Concat($sFilterList, $this->dailyAED->AdvancedSearch->ToJson(), ","); // Field dailyAED
		$sFilterList = ew_Concat($sFilterList, $this->dailyDummyAED->AdvancedSearch->ToJson(), ","); // Field dailyDummyAED
		$sFilterList = ew_Concat($sFilterList, $this->weeklyAED->AdvancedSearch->ToJson(), ","); // Field weeklyAED
		$sFilterList = ew_Concat($sFilterList, $this->weeklyDummyAED->AdvancedSearch->ToJson(), ","); // Field weeklyDummyAED
		$sFilterList = ew_Concat($sFilterList, $this->monthlyAED->AdvancedSearch->ToJson(), ","); // Field monthlyAED
		$sFilterList = ew_Concat($sFilterList, $this->monthlyDummyAED->AdvancedSearch->ToJson(), ","); // Field monthlyDummyAED
		$sFilterList = ew_Concat($sFilterList, $this->active->AdvancedSearch->ToJson(), ","); // Field active
		$sFilterList = ew_Concat($sFilterList, $this->phase1OrangeCard->AdvancedSearch->ToJson(), ","); // Field phase1OrangeCard
		$sFilterList = ew_Concat($sFilterList, $this->phase1GPS->AdvancedSearch->ToJson(), ","); // Field phase1GPS
		$sFilterList = ew_Concat($sFilterList, $this->phase1DeliveryCharges->AdvancedSearch->ToJson(), ","); // Field phase1DeliveryCharges
		$sFilterList = ew_Concat($sFilterList, $this->phase1CollectionCharges->AdvancedSearch->ToJson(), ","); // Field phase1CollectionCharges
		$sFilterList = ew_Concat($sFilterList, $this->weeklyDeals->AdvancedSearch->ToJson(), ","); // Field weeklyDeals
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
			$UserProfile->SetSearchFilters(CurrentUserName(), "frent_lease_carslistsrch", $filters);

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

		// Field rentLeaseCarID
		$this->rentLeaseCarID->AdvancedSearch->SearchValue = @$filter["x_rentLeaseCarID"];
		$this->rentLeaseCarID->AdvancedSearch->SearchOperator = @$filter["z_rentLeaseCarID"];
		$this->rentLeaseCarID->AdvancedSearch->SearchCondition = @$filter["v_rentLeaseCarID"];
		$this->rentLeaseCarID->AdvancedSearch->SearchValue2 = @$filter["y_rentLeaseCarID"];
		$this->rentLeaseCarID->AdvancedSearch->SearchOperator2 = @$filter["w_rentLeaseCarID"];
		$this->rentLeaseCarID->AdvancedSearch->Save();

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

		// Field deliveryAED
		$this->deliveryAED->AdvancedSearch->SearchValue = @$filter["x_deliveryAED"];
		$this->deliveryAED->AdvancedSearch->SearchOperator = @$filter["z_deliveryAED"];
		$this->deliveryAED->AdvancedSearch->SearchCondition = @$filter["v_deliveryAED"];
		$this->deliveryAED->AdvancedSearch->SearchValue2 = @$filter["y_deliveryAED"];
		$this->deliveryAED->AdvancedSearch->SearchOperator2 = @$filter["w_deliveryAED"];
		$this->deliveryAED->AdvancedSearch->Save();

		// Field dailyAED
		$this->dailyAED->AdvancedSearch->SearchValue = @$filter["x_dailyAED"];
		$this->dailyAED->AdvancedSearch->SearchOperator = @$filter["z_dailyAED"];
		$this->dailyAED->AdvancedSearch->SearchCondition = @$filter["v_dailyAED"];
		$this->dailyAED->AdvancedSearch->SearchValue2 = @$filter["y_dailyAED"];
		$this->dailyAED->AdvancedSearch->SearchOperator2 = @$filter["w_dailyAED"];
		$this->dailyAED->AdvancedSearch->Save();

		// Field dailyDummyAED
		$this->dailyDummyAED->AdvancedSearch->SearchValue = @$filter["x_dailyDummyAED"];
		$this->dailyDummyAED->AdvancedSearch->SearchOperator = @$filter["z_dailyDummyAED"];
		$this->dailyDummyAED->AdvancedSearch->SearchCondition = @$filter["v_dailyDummyAED"];
		$this->dailyDummyAED->AdvancedSearch->SearchValue2 = @$filter["y_dailyDummyAED"];
		$this->dailyDummyAED->AdvancedSearch->SearchOperator2 = @$filter["w_dailyDummyAED"];
		$this->dailyDummyAED->AdvancedSearch->Save();

		// Field weeklyAED
		$this->weeklyAED->AdvancedSearch->SearchValue = @$filter["x_weeklyAED"];
		$this->weeklyAED->AdvancedSearch->SearchOperator = @$filter["z_weeklyAED"];
		$this->weeklyAED->AdvancedSearch->SearchCondition = @$filter["v_weeklyAED"];
		$this->weeklyAED->AdvancedSearch->SearchValue2 = @$filter["y_weeklyAED"];
		$this->weeklyAED->AdvancedSearch->SearchOperator2 = @$filter["w_weeklyAED"];
		$this->weeklyAED->AdvancedSearch->Save();

		// Field weeklyDummyAED
		$this->weeklyDummyAED->AdvancedSearch->SearchValue = @$filter["x_weeklyDummyAED"];
		$this->weeklyDummyAED->AdvancedSearch->SearchOperator = @$filter["z_weeklyDummyAED"];
		$this->weeklyDummyAED->AdvancedSearch->SearchCondition = @$filter["v_weeklyDummyAED"];
		$this->weeklyDummyAED->AdvancedSearch->SearchValue2 = @$filter["y_weeklyDummyAED"];
		$this->weeklyDummyAED->AdvancedSearch->SearchOperator2 = @$filter["w_weeklyDummyAED"];
		$this->weeklyDummyAED->AdvancedSearch->Save();

		// Field monthlyAED
		$this->monthlyAED->AdvancedSearch->SearchValue = @$filter["x_monthlyAED"];
		$this->monthlyAED->AdvancedSearch->SearchOperator = @$filter["z_monthlyAED"];
		$this->monthlyAED->AdvancedSearch->SearchCondition = @$filter["v_monthlyAED"];
		$this->monthlyAED->AdvancedSearch->SearchValue2 = @$filter["y_monthlyAED"];
		$this->monthlyAED->AdvancedSearch->SearchOperator2 = @$filter["w_monthlyAED"];
		$this->monthlyAED->AdvancedSearch->Save();

		// Field monthlyDummyAED
		$this->monthlyDummyAED->AdvancedSearch->SearchValue = @$filter["x_monthlyDummyAED"];
		$this->monthlyDummyAED->AdvancedSearch->SearchOperator = @$filter["z_monthlyDummyAED"];
		$this->monthlyDummyAED->AdvancedSearch->SearchCondition = @$filter["v_monthlyDummyAED"];
		$this->monthlyDummyAED->AdvancedSearch->SearchValue2 = @$filter["y_monthlyDummyAED"];
		$this->monthlyDummyAED->AdvancedSearch->SearchOperator2 = @$filter["w_monthlyDummyAED"];
		$this->monthlyDummyAED->AdvancedSearch->Save();

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

		// Field weeklyDeals
		$this->weeklyDeals->AdvancedSearch->SearchValue = @$filter["x_weeklyDeals"];
		$this->weeklyDeals->AdvancedSearch->SearchOperator = @$filter["z_weeklyDeals"];
		$this->weeklyDeals->AdvancedSearch->SearchCondition = @$filter["v_weeklyDeals"];
		$this->weeklyDeals->AdvancedSearch->SearchValue2 = @$filter["y_weeklyDeals"];
		$this->weeklyDeals->AdvancedSearch->SearchOperator2 = @$filter["w_weeklyDeals"];
		$this->weeklyDeals->AdvancedSearch->Save();
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
			$this->UpdateSort($this->rentLeaseCarID); // rentLeaseCarID
			$this->UpdateSort($this->bodyTypeID); // bodyTypeID
			$this->UpdateSort($this->carTitle); // carTitle
			$this->UpdateSort($this->image); // image
			$this->UpdateSort($this->active); // active
			$this->UpdateSort($this->weeklyDeals); // weeklyDeals
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
				$this->rentLeaseCarID->setSort("");
				$this->bodyTypeID->setSort("");
				$this->carTitle->setSort("");
				$this->image->setSort("");
				$this->active->setSort("");
				$this->weeklyDeals->setSort("");
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
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ewMultiSelect\" value=\"" . ew_HtmlEncode($this->rentLeaseCarID->CurrentValue) . "\" onclick=\"ew_ClickMultiCheckbox(event);\">";
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"frent_lease_carslistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"frent_lease_carslistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.frent_lease_carslist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"frent_lease_carslistsrch\">" . $Language->Phrase("SearchLink") . "</button>";
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
		$this->rentLeaseCarID->setDbValue($row['rentLeaseCarID']);
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
		$this->deliveryAED->setDbValue($row['deliveryAED']);
		$this->dailyAED->setDbValue($row['dailyAED']);
		$this->dailyDummyAED->setDbValue($row['dailyDummyAED']);
		$this->weeklyAED->setDbValue($row['weeklyAED']);
		$this->weeklyDummyAED->setDbValue($row['weeklyDummyAED']);
		$this->monthlyAED->setDbValue($row['monthlyAED']);
		$this->monthlyDummyAED->setDbValue($row['monthlyDummyAED']);
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
		$this->active->setDbValue($row['active']);
		$this->phase1OrangeCard->setDbValue($row['phase1OrangeCard']);
		$this->phase1GPS->setDbValue($row['phase1GPS']);
		$this->phase1DeliveryCharges->setDbValue($row['phase1DeliveryCharges']);
		$this->phase1CollectionCharges->setDbValue($row['phase1CollectionCharges']);
		$this->weeklyDeals->setDbValue($row['weeklyDeals']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['rentLeaseCarID'] = NULL;
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
		$row['deliveryAED'] = NULL;
		$row['dailyAED'] = NULL;
		$row['dailyDummyAED'] = NULL;
		$row['weeklyAED'] = NULL;
		$row['weeklyDummyAED'] = NULL;
		$row['monthlyAED'] = NULL;
		$row['monthlyDummyAED'] = NULL;
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
		$row['active'] = NULL;
		$row['phase1OrangeCard'] = NULL;
		$row['phase1GPS'] = NULL;
		$row['phase1DeliveryCharges'] = NULL;
		$row['phase1CollectionCharges'] = NULL;
		$row['weeklyDeals'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->rentLeaseCarID->DbValue = $row['rentLeaseCarID'];
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
		$this->deliveryAED->DbValue = $row['deliveryAED'];
		$this->dailyAED->DbValue = $row['dailyAED'];
		$this->dailyDummyAED->DbValue = $row['dailyDummyAED'];
		$this->weeklyAED->DbValue = $row['weeklyAED'];
		$this->weeklyDummyAED->DbValue = $row['weeklyDummyAED'];
		$this->monthlyAED->DbValue = $row['monthlyAED'];
		$this->monthlyDummyAED->DbValue = $row['monthlyDummyAED'];
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
		$this->active->DbValue = $row['active'];
		$this->phase1OrangeCard->DbValue = $row['phase1OrangeCard'];
		$this->phase1GPS->DbValue = $row['phase1GPS'];
		$this->phase1DeliveryCharges->DbValue = $row['phase1DeliveryCharges'];
		$this->phase1CollectionCharges->DbValue = $row['phase1CollectionCharges'];
		$this->weeklyDeals->DbValue = $row['weeklyDeals'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("rentLeaseCarID")) <> "")
			$this->rentLeaseCarID->CurrentValue = $this->getKey("rentLeaseCarID"); // rentLeaseCarID
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
		// rentLeaseCarID
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
		// deliveryAED
		// dailyAED
		// dailyDummyAED
		// weeklyAED
		// weeklyDummyAED
		// monthlyAED
		// monthlyDummyAED
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

		// active
		// phase1OrangeCard
		// phase1GPS
		// phase1DeliveryCharges
		// phase1CollectionCharges
		// weeklyDeals

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// rentLeaseCarID
		$this->rentLeaseCarID->ViewValue = $this->rentLeaseCarID->CurrentValue;
		$this->rentLeaseCarID->ViewCustomAttributes = "";

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

		// deliveryAED
		$this->deliveryAED->ViewValue = $this->deliveryAED->CurrentValue;
		$this->deliveryAED->ViewCustomAttributes = "";

		// dailyAED
		$this->dailyAED->ViewValue = $this->dailyAED->CurrentValue;
		$this->dailyAED->ViewCustomAttributes = "";

		// dailyDummyAED
		$this->dailyDummyAED->ViewValue = $this->dailyDummyAED->CurrentValue;
		$this->dailyDummyAED->ViewCustomAttributes = "";

		// weeklyAED
		$this->weeklyAED->ViewValue = $this->weeklyAED->CurrentValue;
		$this->weeklyAED->ViewCustomAttributes = "";

		// weeklyDummyAED
		$this->weeklyDummyAED->ViewValue = $this->weeklyDummyAED->CurrentValue;
		$this->weeklyDummyAED->ViewCustomAttributes = "";

		// monthlyAED
		$this->monthlyAED->ViewValue = $this->monthlyAED->CurrentValue;
		$this->monthlyAED->ViewCustomAttributes = "";

		// monthlyDummyAED
		$this->monthlyDummyAED->ViewValue = $this->monthlyDummyAED->CurrentValue;
		$this->monthlyDummyAED->ViewCustomAttributes = "";

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

		// weeklyDeals
		if (strval($this->weeklyDeals->CurrentValue) <> "") {
			$this->weeklyDeals->ViewValue = $this->weeklyDeals->OptionCaption($this->weeklyDeals->CurrentValue);
		} else {
			$this->weeklyDeals->ViewValue = NULL;
		}
		$this->weeklyDeals->ViewCustomAttributes = "";

			// rentLeaseCarID
			$this->rentLeaseCarID->LinkCustomAttributes = "";
			$this->rentLeaseCarID->HrefValue = "";
			$this->rentLeaseCarID->TooltipValue = "";

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
				$this->image->LinkAttrs["data-rel"] = "rent_lease_cars_x" . $this->RowCnt . "_image";
				ew_AppendClass($this->image->LinkAttrs["class"], "ewLightbox");
			}

			// active
			$this->active->LinkCustomAttributes = "";
			$this->active->HrefValue = "";
			$this->active->TooltipValue = "";

			// weeklyDeals
			$this->weeklyDeals->LinkCustomAttributes = "";
			$this->weeklyDeals->HrefValue = "";
			$this->weeklyDeals->TooltipValue = "";
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
		$item->Body = "<button id=\"emf_rent_lease_cars\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_rent_lease_cars',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.frent_lease_carslist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
if (!isset($rent_lease_cars_list)) $rent_lease_cars_list = new crent_lease_cars_list();

// Page init
$rent_lease_cars_list->Page_Init();

// Page main
$rent_lease_cars_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rent_lease_cars_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($rent_lease_cars->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = frent_lease_carslist = new ew_Form("frent_lease_carslist", "list");
frent_lease_carslist.FormKeyCountName = '<?php echo $rent_lease_cars_list->FormKeyCountName ?>';

// Form_CustomValidate event
frent_lease_carslist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frent_lease_carslist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
frent_lease_carslist.Lists["x_bodyTypeID"] = {"LinkField":"x_bodyTypeID","Ajax":true,"AutoFill":false,"DisplayFields":["x_bodytype","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_bodytype"};
frent_lease_carslist.Lists["x_bodyTypeID"].Data = "<?php echo $rent_lease_cars_list->bodyTypeID->LookupFilterQuery(FALSE, "list") ?>";
frent_lease_carslist.Lists["x_active"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
frent_lease_carslist.Lists["x_active"].Options = <?php echo json_encode($rent_lease_cars_list->active->Options()) ?>;
frent_lease_carslist.Lists["x_weeklyDeals"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
frent_lease_carslist.Lists["x_weeklyDeals"].Options = <?php echo json_encode($rent_lease_cars_list->weeklyDeals->Options()) ?>;

// Form object for search
var CurrentSearchForm = frent_lease_carslistsrch = new ew_Form("frent_lease_carslistsrch");
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
<?php if ($rent_lease_cars->Export == "") { ?>
<div class="ewToolbar">
<?php if ($rent_lease_cars_list->TotalRecs > 0 && $rent_lease_cars_list->ExportOptions->Visible()) { ?>
<?php $rent_lease_cars_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($rent_lease_cars_list->SearchOptions->Visible()) { ?>
<?php $rent_lease_cars_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($rent_lease_cars_list->FilterOptions->Visible()) { ?>
<?php $rent_lease_cars_list->FilterOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
	$bSelectLimit = $rent_lease_cars_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($rent_lease_cars_list->TotalRecs <= 0)
			$rent_lease_cars_list->TotalRecs = $rent_lease_cars->ListRecordCount();
	} else {
		if (!$rent_lease_cars_list->Recordset && ($rent_lease_cars_list->Recordset = $rent_lease_cars_list->LoadRecordset()))
			$rent_lease_cars_list->TotalRecs = $rent_lease_cars_list->Recordset->RecordCount();
	}
	$rent_lease_cars_list->StartRec = 1;
	if ($rent_lease_cars_list->DisplayRecs <= 0 || ($rent_lease_cars->Export <> "" && $rent_lease_cars->ExportAll)) // Display all records
		$rent_lease_cars_list->DisplayRecs = $rent_lease_cars_list->TotalRecs;
	if (!($rent_lease_cars->Export <> "" && $rent_lease_cars->ExportAll))
		$rent_lease_cars_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rent_lease_cars_list->Recordset = $rent_lease_cars_list->LoadRecordset($rent_lease_cars_list->StartRec-1, $rent_lease_cars_list->DisplayRecs);

	// Set no record found message
	if ($rent_lease_cars->CurrentAction == "" && $rent_lease_cars_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$rent_lease_cars_list->setWarningMessage(ew_DeniedMsg());
		if ($rent_lease_cars_list->SearchWhere == "0=101")
			$rent_lease_cars_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$rent_lease_cars_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$rent_lease_cars_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($rent_lease_cars->Export == "" && $rent_lease_cars->CurrentAction == "") { ?>
<form name="frent_lease_carslistsrch" id="frent_lease_carslistsrch" class="form-inline ewForm ewExtSearchForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($rent_lease_cars_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="frent_lease_carslistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="rent_lease_cars">
	<div class="ewBasicSearch">
<div id="xsr_1" class="ewRow">
	<div class="ewQuickSearch input-group">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo ew_HtmlEncode($rent_lease_cars_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo ew_HtmlEncode($Language->Phrase("Search")) ?>">
	<input type="hidden" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo ew_HtmlEncode($rent_lease_cars_list->BasicSearch->getType()) ?>">
	<div class="input-group-btn">
		<button type="button" data-toggle="dropdown" class="btn btn-default"><span id="searchtype"><?php echo $rent_lease_cars_list->BasicSearch->getTypeNameShort() ?></span><span class="caret"></span></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li<?php if ($rent_lease_cars_list->BasicSearch->getType() == "") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a></li>
			<li<?php if ($rent_lease_cars_list->BasicSearch->getType() == "=") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a></li>
			<li<?php if ($rent_lease_cars_list->BasicSearch->getType() == "AND") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a></li>
			<li<?php if ($rent_lease_cars_list->BasicSearch->getType() == "OR") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a></li>
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
<?php $rent_lease_cars_list->ShowPageHeader(); ?>
<?php
$rent_lease_cars_list->ShowMessage();
?>
<?php if ($rent_lease_cars_list->TotalRecs > 0 || $rent_lease_cars->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($rent_lease_cars_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> rent_lease_cars">
<?php if ($rent_lease_cars->Export == "") { ?>
<div class="box-header ewGridUpperPanel">
<?php if ($rent_lease_cars->CurrentAction <> "gridadd" && $rent_lease_cars->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($rent_lease_cars_list->Pager)) $rent_lease_cars_list->Pager = new cPrevNextPager($rent_lease_cars_list->StartRec, $rent_lease_cars_list->DisplayRecs, $rent_lease_cars_list->TotalRecs, $rent_lease_cars_list->AutoHidePager) ?>
<?php if ($rent_lease_cars_list->Pager->RecordCount > 0 && $rent_lease_cars_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($rent_lease_cars_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $rent_lease_cars_list->PageUrl() ?>start=<?php echo $rent_lease_cars_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($rent_lease_cars_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $rent_lease_cars_list->PageUrl() ?>start=<?php echo $rent_lease_cars_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $rent_lease_cars_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($rent_lease_cars_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $rent_lease_cars_list->PageUrl() ?>start=<?php echo $rent_lease_cars_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($rent_lease_cars_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $rent_lease_cars_list->PageUrl() ?>start=<?php echo $rent_lease_cars_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $rent_lease_cars_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $rent_lease_cars_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $rent_lease_cars_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $rent_lease_cars_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($rent_lease_cars_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="frent_lease_carslist" id="frent_lease_carslist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($rent_lease_cars_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $rent_lease_cars_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rent_lease_cars">
<div id="gmp_rent_lease_cars" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($rent_lease_cars_list->TotalRecs > 0 || $rent_lease_cars->CurrentAction == "gridedit") { ?>
<table id="tbl_rent_lease_carslist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$rent_lease_cars_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$rent_lease_cars_list->RenderListOptions();

// Render list options (header, left)
$rent_lease_cars_list->ListOptions->Render("header", "left");
?>
<?php if ($rent_lease_cars->rentLeaseCarID->Visible) { // rentLeaseCarID ?>
	<?php if ($rent_lease_cars->SortUrl($rent_lease_cars->rentLeaseCarID) == "") { ?>
		<th data-name="rentLeaseCarID" class="<?php echo $rent_lease_cars->rentLeaseCarID->HeaderCellClass() ?>"><div id="elh_rent_lease_cars_rentLeaseCarID" class="rent_lease_cars_rentLeaseCarID"><div class="ewTableHeaderCaption"><?php echo $rent_lease_cars->rentLeaseCarID->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rentLeaseCarID" class="<?php echo $rent_lease_cars->rentLeaseCarID->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $rent_lease_cars->SortUrl($rent_lease_cars->rentLeaseCarID) ?>',1);"><div id="elh_rent_lease_cars_rentLeaseCarID" class="rent_lease_cars_rentLeaseCarID">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $rent_lease_cars->rentLeaseCarID->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rent_lease_cars->rentLeaseCarID->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rent_lease_cars->rentLeaseCarID->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rent_lease_cars->bodyTypeID->Visible) { // bodyTypeID ?>
	<?php if ($rent_lease_cars->SortUrl($rent_lease_cars->bodyTypeID) == "") { ?>
		<th data-name="bodyTypeID" class="<?php echo $rent_lease_cars->bodyTypeID->HeaderCellClass() ?>"><div id="elh_rent_lease_cars_bodyTypeID" class="rent_lease_cars_bodyTypeID"><div class="ewTableHeaderCaption"><?php echo $rent_lease_cars->bodyTypeID->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bodyTypeID" class="<?php echo $rent_lease_cars->bodyTypeID->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $rent_lease_cars->SortUrl($rent_lease_cars->bodyTypeID) ?>',1);"><div id="elh_rent_lease_cars_bodyTypeID" class="rent_lease_cars_bodyTypeID">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $rent_lease_cars->bodyTypeID->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rent_lease_cars->bodyTypeID->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rent_lease_cars->bodyTypeID->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rent_lease_cars->carTitle->Visible) { // carTitle ?>
	<?php if ($rent_lease_cars->SortUrl($rent_lease_cars->carTitle) == "") { ?>
		<th data-name="carTitle" class="<?php echo $rent_lease_cars->carTitle->HeaderCellClass() ?>"><div id="elh_rent_lease_cars_carTitle" class="rent_lease_cars_carTitle"><div class="ewTableHeaderCaption"><?php echo $rent_lease_cars->carTitle->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="carTitle" class="<?php echo $rent_lease_cars->carTitle->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $rent_lease_cars->SortUrl($rent_lease_cars->carTitle) ?>',1);"><div id="elh_rent_lease_cars_carTitle" class="rent_lease_cars_carTitle">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $rent_lease_cars->carTitle->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($rent_lease_cars->carTitle->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rent_lease_cars->carTitle->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rent_lease_cars->image->Visible) { // image ?>
	<?php if ($rent_lease_cars->SortUrl($rent_lease_cars->image) == "") { ?>
		<th data-name="image" class="<?php echo $rent_lease_cars->image->HeaderCellClass() ?>"><div id="elh_rent_lease_cars_image" class="rent_lease_cars_image"><div class="ewTableHeaderCaption"><?php echo $rent_lease_cars->image->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="image" class="<?php echo $rent_lease_cars->image->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $rent_lease_cars->SortUrl($rent_lease_cars->image) ?>',1);"><div id="elh_rent_lease_cars_image" class="rent_lease_cars_image">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $rent_lease_cars->image->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($rent_lease_cars->image->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rent_lease_cars->image->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rent_lease_cars->active->Visible) { // active ?>
	<?php if ($rent_lease_cars->SortUrl($rent_lease_cars->active) == "") { ?>
		<th data-name="active" class="<?php echo $rent_lease_cars->active->HeaderCellClass() ?>"><div id="elh_rent_lease_cars_active" class="rent_lease_cars_active"><div class="ewTableHeaderCaption"><?php echo $rent_lease_cars->active->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="active" class="<?php echo $rent_lease_cars->active->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $rent_lease_cars->SortUrl($rent_lease_cars->active) ?>',1);"><div id="elh_rent_lease_cars_active" class="rent_lease_cars_active">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $rent_lease_cars->active->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rent_lease_cars->active->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rent_lease_cars->active->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rent_lease_cars->weeklyDeals->Visible) { // weeklyDeals ?>
	<?php if ($rent_lease_cars->SortUrl($rent_lease_cars->weeklyDeals) == "") { ?>
		<th data-name="weeklyDeals" class="<?php echo $rent_lease_cars->weeklyDeals->HeaderCellClass() ?>"><div id="elh_rent_lease_cars_weeklyDeals" class="rent_lease_cars_weeklyDeals"><div class="ewTableHeaderCaption"><?php echo $rent_lease_cars->weeklyDeals->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="weeklyDeals" class="<?php echo $rent_lease_cars->weeklyDeals->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $rent_lease_cars->SortUrl($rent_lease_cars->weeklyDeals) ?>',1);"><div id="elh_rent_lease_cars_weeklyDeals" class="rent_lease_cars_weeklyDeals">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $rent_lease_cars->weeklyDeals->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rent_lease_cars->weeklyDeals->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rent_lease_cars->weeklyDeals->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$rent_lease_cars_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($rent_lease_cars->ExportAll && $rent_lease_cars->Export <> "") {
	$rent_lease_cars_list->StopRec = $rent_lease_cars_list->TotalRecs;
} else {

	// Set the last record to display
	if ($rent_lease_cars_list->TotalRecs > $rent_lease_cars_list->StartRec + $rent_lease_cars_list->DisplayRecs - 1)
		$rent_lease_cars_list->StopRec = $rent_lease_cars_list->StartRec + $rent_lease_cars_list->DisplayRecs - 1;
	else
		$rent_lease_cars_list->StopRec = $rent_lease_cars_list->TotalRecs;
}
$rent_lease_cars_list->RecCnt = $rent_lease_cars_list->StartRec - 1;
if ($rent_lease_cars_list->Recordset && !$rent_lease_cars_list->Recordset->EOF) {
	$rent_lease_cars_list->Recordset->MoveFirst();
	$bSelectLimit = $rent_lease_cars_list->UseSelectLimit;
	if (!$bSelectLimit && $rent_lease_cars_list->StartRec > 1)
		$rent_lease_cars_list->Recordset->Move($rent_lease_cars_list->StartRec - 1);
} elseif (!$rent_lease_cars->AllowAddDeleteRow && $rent_lease_cars_list->StopRec == 0) {
	$rent_lease_cars_list->StopRec = $rent_lease_cars->GridAddRowCount;
}

// Initialize aggregate
$rent_lease_cars->RowType = EW_ROWTYPE_AGGREGATEINIT;
$rent_lease_cars->ResetAttrs();
$rent_lease_cars_list->RenderRow();
while ($rent_lease_cars_list->RecCnt < $rent_lease_cars_list->StopRec) {
	$rent_lease_cars_list->RecCnt++;
	if (intval($rent_lease_cars_list->RecCnt) >= intval($rent_lease_cars_list->StartRec)) {
		$rent_lease_cars_list->RowCnt++;

		// Set up key count
		$rent_lease_cars_list->KeyCount = $rent_lease_cars_list->RowIndex;

		// Init row class and style
		$rent_lease_cars->ResetAttrs();
		$rent_lease_cars->CssClass = "";
		if ($rent_lease_cars->CurrentAction == "gridadd") {
		} else {
			$rent_lease_cars_list->LoadRowValues($rent_lease_cars_list->Recordset); // Load row values
		}
		$rent_lease_cars->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$rent_lease_cars->RowAttrs = array_merge($rent_lease_cars->RowAttrs, array('data-rowindex'=>$rent_lease_cars_list->RowCnt, 'id'=>'r' . $rent_lease_cars_list->RowCnt . '_rent_lease_cars', 'data-rowtype'=>$rent_lease_cars->RowType));

		// Render row
		$rent_lease_cars_list->RenderRow();

		// Render list options
		$rent_lease_cars_list->RenderListOptions();
?>
	<tr<?php echo $rent_lease_cars->RowAttributes() ?>>
<?php

// Render list options (body, left)
$rent_lease_cars_list->ListOptions->Render("body", "left", $rent_lease_cars_list->RowCnt);
?>
	<?php if ($rent_lease_cars->rentLeaseCarID->Visible) { // rentLeaseCarID ?>
		<td data-name="rentLeaseCarID"<?php echo $rent_lease_cars->rentLeaseCarID->CellAttributes() ?>>
<span id="el<?php echo $rent_lease_cars_list->RowCnt ?>_rent_lease_cars_rentLeaseCarID" class="rent_lease_cars_rentLeaseCarID">
<span<?php echo $rent_lease_cars->rentLeaseCarID->ViewAttributes() ?>>
<?php echo $rent_lease_cars->rentLeaseCarID->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rent_lease_cars->bodyTypeID->Visible) { // bodyTypeID ?>
		<td data-name="bodyTypeID"<?php echo $rent_lease_cars->bodyTypeID->CellAttributes() ?>>
<span id="el<?php echo $rent_lease_cars_list->RowCnt ?>_rent_lease_cars_bodyTypeID" class="rent_lease_cars_bodyTypeID">
<span<?php echo $rent_lease_cars->bodyTypeID->ViewAttributes() ?>>
<?php echo $rent_lease_cars->bodyTypeID->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rent_lease_cars->carTitle->Visible) { // carTitle ?>
		<td data-name="carTitle"<?php echo $rent_lease_cars->carTitle->CellAttributes() ?>>
<span id="el<?php echo $rent_lease_cars_list->RowCnt ?>_rent_lease_cars_carTitle" class="rent_lease_cars_carTitle">
<span<?php echo $rent_lease_cars->carTitle->ViewAttributes() ?>>
<?php echo $rent_lease_cars->carTitle->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rent_lease_cars->image->Visible) { // image ?>
		<td data-name="image"<?php echo $rent_lease_cars->image->CellAttributes() ?>>
<span id="el<?php echo $rent_lease_cars_list->RowCnt ?>_rent_lease_cars_image" class="rent_lease_cars_image">
<span>
<?php echo ew_GetFileViewTag($rent_lease_cars->image, $rent_lease_cars->image->ListViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($rent_lease_cars->active->Visible) { // active ?>
		<td data-name="active"<?php echo $rent_lease_cars->active->CellAttributes() ?>>
<span id="el<?php echo $rent_lease_cars_list->RowCnt ?>_rent_lease_cars_active" class="rent_lease_cars_active">
<span<?php echo $rent_lease_cars->active->ViewAttributes() ?>>
<?php echo $rent_lease_cars->active->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rent_lease_cars->weeklyDeals->Visible) { // weeklyDeals ?>
		<td data-name="weeklyDeals"<?php echo $rent_lease_cars->weeklyDeals->CellAttributes() ?>>
<span id="el<?php echo $rent_lease_cars_list->RowCnt ?>_rent_lease_cars_weeklyDeals" class="rent_lease_cars_weeklyDeals">
<span<?php echo $rent_lease_cars->weeklyDeals->ViewAttributes() ?>>
<?php echo $rent_lease_cars->weeklyDeals->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rent_lease_cars_list->ListOptions->Render("body", "right", $rent_lease_cars_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($rent_lease_cars->CurrentAction <> "gridadd")
		$rent_lease_cars_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($rent_lease_cars->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rent_lease_cars_list->Recordset)
	$rent_lease_cars_list->Recordset->Close();
?>
<?php if ($rent_lease_cars->Export == "") { ?>
<div class="box-footer ewGridLowerPanel">
<?php if ($rent_lease_cars->CurrentAction <> "gridadd" && $rent_lease_cars->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($rent_lease_cars_list->Pager)) $rent_lease_cars_list->Pager = new cPrevNextPager($rent_lease_cars_list->StartRec, $rent_lease_cars_list->DisplayRecs, $rent_lease_cars_list->TotalRecs, $rent_lease_cars_list->AutoHidePager) ?>
<?php if ($rent_lease_cars_list->Pager->RecordCount > 0 && $rent_lease_cars_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($rent_lease_cars_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $rent_lease_cars_list->PageUrl() ?>start=<?php echo $rent_lease_cars_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($rent_lease_cars_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $rent_lease_cars_list->PageUrl() ?>start=<?php echo $rent_lease_cars_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $rent_lease_cars_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($rent_lease_cars_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $rent_lease_cars_list->PageUrl() ?>start=<?php echo $rent_lease_cars_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($rent_lease_cars_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $rent_lease_cars_list->PageUrl() ?>start=<?php echo $rent_lease_cars_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $rent_lease_cars_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $rent_lease_cars_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $rent_lease_cars_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $rent_lease_cars_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($rent_lease_cars_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($rent_lease_cars_list->TotalRecs == 0 && $rent_lease_cars->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($rent_lease_cars_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($rent_lease_cars->Export == "") { ?>
<script type="text/javascript">
frent_lease_carslistsrch.FilterList = <?php echo $rent_lease_cars_list->GetFilterList() ?>;
frent_lease_carslistsrch.Init();
frent_lease_carslist.Init();
</script>
<?php } ?>
<?php
$rent_lease_cars_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($rent_lease_cars->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$rent_lease_cars_list->Page_Terminate();
?>
