<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "used_carsinfo.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$used_cars_list = NULL; // Initialize page object first

class cused_cars_list extends cused_cars {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'used_cars';

	// Page object name
	var $PageObjName = 'used_cars_list';

	// Grid form hidden field names
	var $FormName = 'fused_carslist';
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

		// Table object (used_cars)
		if (!isset($GLOBALS["used_cars"]) || get_class($GLOBALS["used_cars"]) == "cused_cars") {
			$GLOBALS["used_cars"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["used_cars"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "used_carsadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "used_carsdelete.php";
		$this->MultiUpdateUrl = "used_carsupdate.php";

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'used_cars', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption fused_carslistsrch";

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
		$this->userCarID->SetVisibility();
		if ($this->IsAdd() || $this->IsCopy() || $this->IsGridAdd())
			$this->userCarID->Visible = FALSE;
		$this->makeID->SetVisibility();
		$this->modelID->SetVisibility();
		$this->slug->SetVisibility();
		$this->yearID->SetVisibility();
		$this->kilometers->SetVisibility();
		$this->priceAED->SetVisibility();
		$this->transmissionTypeID->SetVisibility();
		$this->_thumbnail->SetVisibility();
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
		global $EW_EXPORT, $used_cars;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($used_cars);
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
			$this->userCarID->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->userCarID->FormValue))
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
			$sSavedFilterList = $UserProfile->GetSearchFilters(CurrentUserName(), "fused_carslistsrch");
		$sFilterList = ew_Concat($sFilterList, $this->userCarID->AdvancedSearch->ToJson(), ","); // Field userCarID
		$sFilterList = ew_Concat($sFilterList, $this->makeID->AdvancedSearch->ToJson(), ","); // Field makeID
		$sFilterList = ew_Concat($sFilterList, $this->modelID->AdvancedSearch->ToJson(), ","); // Field modelID
		$sFilterList = ew_Concat($sFilterList, $this->slug->AdvancedSearch->ToJson(), ","); // Field slug
		$sFilterList = ew_Concat($sFilterList, $this->yearID->AdvancedSearch->ToJson(), ","); // Field yearID
		$sFilterList = ew_Concat($sFilterList, $this->kilometers->AdvancedSearch->ToJson(), ","); // Field kilometers
		$sFilterList = ew_Concat($sFilterList, $this->priceAED->AdvancedSearch->ToJson(), ","); // Field priceAED
		$sFilterList = ew_Concat($sFilterList, $this->priceUSD->AdvancedSearch->ToJson(), ","); // Field priceUSD
		$sFilterList = ew_Concat($sFilterList, $this->priceOMR->AdvancedSearch->ToJson(), ","); // Field priceOMR
		$sFilterList = ew_Concat($sFilterList, $this->priceSAR->AdvancedSearch->ToJson(), ","); // Field priceSAR
		$sFilterList = ew_Concat($sFilterList, $this->description->AdvancedSearch->ToJson(), ","); // Field description
		$sFilterList = ew_Concat($sFilterList, $this->fuelTypeID->AdvancedSearch->ToJson(), ","); // Field fuelTypeID
		$sFilterList = ew_Concat($sFilterList, $this->regionalID->AdvancedSearch->ToJson(), ","); // Field regionalID
		$sFilterList = ew_Concat($sFilterList, $this->warrantyID->AdvancedSearch->ToJson(), ","); // Field warrantyID
		$sFilterList = ew_Concat($sFilterList, $this->noOfDoors->AdvancedSearch->ToJson(), ","); // Field noOfDoors
		$sFilterList = ew_Concat($sFilterList, $this->transmissionTypeID->AdvancedSearch->ToJson(), ","); // Field transmissionTypeID
		$sFilterList = ew_Concat($sFilterList, $this->cylinderID->AdvancedSearch->ToJson(), ","); // Field cylinderID
		$sFilterList = ew_Concat($sFilterList, $this->engine->AdvancedSearch->ToJson(), ","); // Field engine
		$sFilterList = ew_Concat($sFilterList, $this->colorID->AdvancedSearch->ToJson(), ","); // Field colorID
		$sFilterList = ew_Concat($sFilterList, $this->bodyConditionID->AdvancedSearch->ToJson(), ","); // Field bodyConditionID
		$sFilterList = ew_Concat($sFilterList, $this->summary->AdvancedSearch->ToJson(), ","); // Field summary
		$sFilterList = ew_Concat($sFilterList, $this->term->AdvancedSearch->ToJson(), ","); // Field term
		$sFilterList = ew_Concat($sFilterList, $this->_thumbnail->AdvancedSearch->ToJson(), ","); // Field thumbnail
		$sFilterList = ew_Concat($sFilterList, $this->img_01->AdvancedSearch->ToJson(), ","); // Field img_01
		$sFilterList = ew_Concat($sFilterList, $this->img_02->AdvancedSearch->ToJson(), ","); // Field img_02
		$sFilterList = ew_Concat($sFilterList, $this->img_03->AdvancedSearch->ToJson(), ","); // Field img_03
		$sFilterList = ew_Concat($sFilterList, $this->img_04->AdvancedSearch->ToJson(), ","); // Field img_04
		$sFilterList = ew_Concat($sFilterList, $this->img_05->AdvancedSearch->ToJson(), ","); // Field img_05
		$sFilterList = ew_Concat($sFilterList, $this->img_06->AdvancedSearch->ToJson(), ","); // Field img_06
		$sFilterList = ew_Concat($sFilterList, $this->img_07->AdvancedSearch->ToJson(), ","); // Field img_07
		$sFilterList = ew_Concat($sFilterList, $this->img_08->AdvancedSearch->ToJson(), ","); // Field img_08
		$sFilterList = ew_Concat($sFilterList, $this->img_09->AdvancedSearch->ToJson(), ","); // Field img_09
		$sFilterList = ew_Concat($sFilterList, $this->img_10->AdvancedSearch->ToJson(), ","); // Field img_10
		$sFilterList = ew_Concat($sFilterList, $this->img_11->AdvancedSearch->ToJson(), ","); // Field img_11
		$sFilterList = ew_Concat($sFilterList, $this->img_12->AdvancedSearch->ToJson(), ","); // Field img_12
		$sFilterList = ew_Concat($sFilterList, $this->extra_features->AdvancedSearch->ToJson(), ","); // Field extra_features
		$sFilterList = ew_Concat($sFilterList, $this->so->AdvancedSearch->ToJson(), ","); // Field so
		$sFilterList = ew_Concat($sFilterList, $this->active->AdvancedSearch->ToJson(), ","); // Field active
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
			$UserProfile->SetSearchFilters(CurrentUserName(), "fused_carslistsrch", $filters);

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

		// Field userCarID
		$this->userCarID->AdvancedSearch->SearchValue = @$filter["x_userCarID"];
		$this->userCarID->AdvancedSearch->SearchOperator = @$filter["z_userCarID"];
		$this->userCarID->AdvancedSearch->SearchCondition = @$filter["v_userCarID"];
		$this->userCarID->AdvancedSearch->SearchValue2 = @$filter["y_userCarID"];
		$this->userCarID->AdvancedSearch->SearchOperator2 = @$filter["w_userCarID"];
		$this->userCarID->AdvancedSearch->Save();

		// Field makeID
		$this->makeID->AdvancedSearch->SearchValue = @$filter["x_makeID"];
		$this->makeID->AdvancedSearch->SearchOperator = @$filter["z_makeID"];
		$this->makeID->AdvancedSearch->SearchCondition = @$filter["v_makeID"];
		$this->makeID->AdvancedSearch->SearchValue2 = @$filter["y_makeID"];
		$this->makeID->AdvancedSearch->SearchOperator2 = @$filter["w_makeID"];
		$this->makeID->AdvancedSearch->Save();

		// Field modelID
		$this->modelID->AdvancedSearch->SearchValue = @$filter["x_modelID"];
		$this->modelID->AdvancedSearch->SearchOperator = @$filter["z_modelID"];
		$this->modelID->AdvancedSearch->SearchCondition = @$filter["v_modelID"];
		$this->modelID->AdvancedSearch->SearchValue2 = @$filter["y_modelID"];
		$this->modelID->AdvancedSearch->SearchOperator2 = @$filter["w_modelID"];
		$this->modelID->AdvancedSearch->Save();

		// Field slug
		$this->slug->AdvancedSearch->SearchValue = @$filter["x_slug"];
		$this->slug->AdvancedSearch->SearchOperator = @$filter["z_slug"];
		$this->slug->AdvancedSearch->SearchCondition = @$filter["v_slug"];
		$this->slug->AdvancedSearch->SearchValue2 = @$filter["y_slug"];
		$this->slug->AdvancedSearch->SearchOperator2 = @$filter["w_slug"];
		$this->slug->AdvancedSearch->Save();

		// Field yearID
		$this->yearID->AdvancedSearch->SearchValue = @$filter["x_yearID"];
		$this->yearID->AdvancedSearch->SearchOperator = @$filter["z_yearID"];
		$this->yearID->AdvancedSearch->SearchCondition = @$filter["v_yearID"];
		$this->yearID->AdvancedSearch->SearchValue2 = @$filter["y_yearID"];
		$this->yearID->AdvancedSearch->SearchOperator2 = @$filter["w_yearID"];
		$this->yearID->AdvancedSearch->Save();

		// Field kilometers
		$this->kilometers->AdvancedSearch->SearchValue = @$filter["x_kilometers"];
		$this->kilometers->AdvancedSearch->SearchOperator = @$filter["z_kilometers"];
		$this->kilometers->AdvancedSearch->SearchCondition = @$filter["v_kilometers"];
		$this->kilometers->AdvancedSearch->SearchValue2 = @$filter["y_kilometers"];
		$this->kilometers->AdvancedSearch->SearchOperator2 = @$filter["w_kilometers"];
		$this->kilometers->AdvancedSearch->Save();

		// Field priceAED
		$this->priceAED->AdvancedSearch->SearchValue = @$filter["x_priceAED"];
		$this->priceAED->AdvancedSearch->SearchOperator = @$filter["z_priceAED"];
		$this->priceAED->AdvancedSearch->SearchCondition = @$filter["v_priceAED"];
		$this->priceAED->AdvancedSearch->SearchValue2 = @$filter["y_priceAED"];
		$this->priceAED->AdvancedSearch->SearchOperator2 = @$filter["w_priceAED"];
		$this->priceAED->AdvancedSearch->Save();

		// Field priceUSD
		$this->priceUSD->AdvancedSearch->SearchValue = @$filter["x_priceUSD"];
		$this->priceUSD->AdvancedSearch->SearchOperator = @$filter["z_priceUSD"];
		$this->priceUSD->AdvancedSearch->SearchCondition = @$filter["v_priceUSD"];
		$this->priceUSD->AdvancedSearch->SearchValue2 = @$filter["y_priceUSD"];
		$this->priceUSD->AdvancedSearch->SearchOperator2 = @$filter["w_priceUSD"];
		$this->priceUSD->AdvancedSearch->Save();

		// Field priceOMR
		$this->priceOMR->AdvancedSearch->SearchValue = @$filter["x_priceOMR"];
		$this->priceOMR->AdvancedSearch->SearchOperator = @$filter["z_priceOMR"];
		$this->priceOMR->AdvancedSearch->SearchCondition = @$filter["v_priceOMR"];
		$this->priceOMR->AdvancedSearch->SearchValue2 = @$filter["y_priceOMR"];
		$this->priceOMR->AdvancedSearch->SearchOperator2 = @$filter["w_priceOMR"];
		$this->priceOMR->AdvancedSearch->Save();

		// Field priceSAR
		$this->priceSAR->AdvancedSearch->SearchValue = @$filter["x_priceSAR"];
		$this->priceSAR->AdvancedSearch->SearchOperator = @$filter["z_priceSAR"];
		$this->priceSAR->AdvancedSearch->SearchCondition = @$filter["v_priceSAR"];
		$this->priceSAR->AdvancedSearch->SearchValue2 = @$filter["y_priceSAR"];
		$this->priceSAR->AdvancedSearch->SearchOperator2 = @$filter["w_priceSAR"];
		$this->priceSAR->AdvancedSearch->Save();

		// Field description
		$this->description->AdvancedSearch->SearchValue = @$filter["x_description"];
		$this->description->AdvancedSearch->SearchOperator = @$filter["z_description"];
		$this->description->AdvancedSearch->SearchCondition = @$filter["v_description"];
		$this->description->AdvancedSearch->SearchValue2 = @$filter["y_description"];
		$this->description->AdvancedSearch->SearchOperator2 = @$filter["w_description"];
		$this->description->AdvancedSearch->Save();

		// Field fuelTypeID
		$this->fuelTypeID->AdvancedSearch->SearchValue = @$filter["x_fuelTypeID"];
		$this->fuelTypeID->AdvancedSearch->SearchOperator = @$filter["z_fuelTypeID"];
		$this->fuelTypeID->AdvancedSearch->SearchCondition = @$filter["v_fuelTypeID"];
		$this->fuelTypeID->AdvancedSearch->SearchValue2 = @$filter["y_fuelTypeID"];
		$this->fuelTypeID->AdvancedSearch->SearchOperator2 = @$filter["w_fuelTypeID"];
		$this->fuelTypeID->AdvancedSearch->Save();

		// Field regionalID
		$this->regionalID->AdvancedSearch->SearchValue = @$filter["x_regionalID"];
		$this->regionalID->AdvancedSearch->SearchOperator = @$filter["z_regionalID"];
		$this->regionalID->AdvancedSearch->SearchCondition = @$filter["v_regionalID"];
		$this->regionalID->AdvancedSearch->SearchValue2 = @$filter["y_regionalID"];
		$this->regionalID->AdvancedSearch->SearchOperator2 = @$filter["w_regionalID"];
		$this->regionalID->AdvancedSearch->Save();

		// Field warrantyID
		$this->warrantyID->AdvancedSearch->SearchValue = @$filter["x_warrantyID"];
		$this->warrantyID->AdvancedSearch->SearchOperator = @$filter["z_warrantyID"];
		$this->warrantyID->AdvancedSearch->SearchCondition = @$filter["v_warrantyID"];
		$this->warrantyID->AdvancedSearch->SearchValue2 = @$filter["y_warrantyID"];
		$this->warrantyID->AdvancedSearch->SearchOperator2 = @$filter["w_warrantyID"];
		$this->warrantyID->AdvancedSearch->Save();

		// Field noOfDoors
		$this->noOfDoors->AdvancedSearch->SearchValue = @$filter["x_noOfDoors"];
		$this->noOfDoors->AdvancedSearch->SearchOperator = @$filter["z_noOfDoors"];
		$this->noOfDoors->AdvancedSearch->SearchCondition = @$filter["v_noOfDoors"];
		$this->noOfDoors->AdvancedSearch->SearchValue2 = @$filter["y_noOfDoors"];
		$this->noOfDoors->AdvancedSearch->SearchOperator2 = @$filter["w_noOfDoors"];
		$this->noOfDoors->AdvancedSearch->Save();

		// Field transmissionTypeID
		$this->transmissionTypeID->AdvancedSearch->SearchValue = @$filter["x_transmissionTypeID"];
		$this->transmissionTypeID->AdvancedSearch->SearchOperator = @$filter["z_transmissionTypeID"];
		$this->transmissionTypeID->AdvancedSearch->SearchCondition = @$filter["v_transmissionTypeID"];
		$this->transmissionTypeID->AdvancedSearch->SearchValue2 = @$filter["y_transmissionTypeID"];
		$this->transmissionTypeID->AdvancedSearch->SearchOperator2 = @$filter["w_transmissionTypeID"];
		$this->transmissionTypeID->AdvancedSearch->Save();

		// Field cylinderID
		$this->cylinderID->AdvancedSearch->SearchValue = @$filter["x_cylinderID"];
		$this->cylinderID->AdvancedSearch->SearchOperator = @$filter["z_cylinderID"];
		$this->cylinderID->AdvancedSearch->SearchCondition = @$filter["v_cylinderID"];
		$this->cylinderID->AdvancedSearch->SearchValue2 = @$filter["y_cylinderID"];
		$this->cylinderID->AdvancedSearch->SearchOperator2 = @$filter["w_cylinderID"];
		$this->cylinderID->AdvancedSearch->Save();

		// Field engine
		$this->engine->AdvancedSearch->SearchValue = @$filter["x_engine"];
		$this->engine->AdvancedSearch->SearchOperator = @$filter["z_engine"];
		$this->engine->AdvancedSearch->SearchCondition = @$filter["v_engine"];
		$this->engine->AdvancedSearch->SearchValue2 = @$filter["y_engine"];
		$this->engine->AdvancedSearch->SearchOperator2 = @$filter["w_engine"];
		$this->engine->AdvancedSearch->Save();

		// Field colorID
		$this->colorID->AdvancedSearch->SearchValue = @$filter["x_colorID"];
		$this->colorID->AdvancedSearch->SearchOperator = @$filter["z_colorID"];
		$this->colorID->AdvancedSearch->SearchCondition = @$filter["v_colorID"];
		$this->colorID->AdvancedSearch->SearchValue2 = @$filter["y_colorID"];
		$this->colorID->AdvancedSearch->SearchOperator2 = @$filter["w_colorID"];
		$this->colorID->AdvancedSearch->Save();

		// Field bodyConditionID
		$this->bodyConditionID->AdvancedSearch->SearchValue = @$filter["x_bodyConditionID"];
		$this->bodyConditionID->AdvancedSearch->SearchOperator = @$filter["z_bodyConditionID"];
		$this->bodyConditionID->AdvancedSearch->SearchCondition = @$filter["v_bodyConditionID"];
		$this->bodyConditionID->AdvancedSearch->SearchValue2 = @$filter["y_bodyConditionID"];
		$this->bodyConditionID->AdvancedSearch->SearchOperator2 = @$filter["w_bodyConditionID"];
		$this->bodyConditionID->AdvancedSearch->Save();

		// Field summary
		$this->summary->AdvancedSearch->SearchValue = @$filter["x_summary"];
		$this->summary->AdvancedSearch->SearchOperator = @$filter["z_summary"];
		$this->summary->AdvancedSearch->SearchCondition = @$filter["v_summary"];
		$this->summary->AdvancedSearch->SearchValue2 = @$filter["y_summary"];
		$this->summary->AdvancedSearch->SearchOperator2 = @$filter["w_summary"];
		$this->summary->AdvancedSearch->Save();

		// Field term
		$this->term->AdvancedSearch->SearchValue = @$filter["x_term"];
		$this->term->AdvancedSearch->SearchOperator = @$filter["z_term"];
		$this->term->AdvancedSearch->SearchCondition = @$filter["v_term"];
		$this->term->AdvancedSearch->SearchValue2 = @$filter["y_term"];
		$this->term->AdvancedSearch->SearchOperator2 = @$filter["w_term"];
		$this->term->AdvancedSearch->Save();

		// Field thumbnail
		$this->_thumbnail->AdvancedSearch->SearchValue = @$filter["x__thumbnail"];
		$this->_thumbnail->AdvancedSearch->SearchOperator = @$filter["z__thumbnail"];
		$this->_thumbnail->AdvancedSearch->SearchCondition = @$filter["v__thumbnail"];
		$this->_thumbnail->AdvancedSearch->SearchValue2 = @$filter["y__thumbnail"];
		$this->_thumbnail->AdvancedSearch->SearchOperator2 = @$filter["w__thumbnail"];
		$this->_thumbnail->AdvancedSearch->Save();

		// Field img_01
		$this->img_01->AdvancedSearch->SearchValue = @$filter["x_img_01"];
		$this->img_01->AdvancedSearch->SearchOperator = @$filter["z_img_01"];
		$this->img_01->AdvancedSearch->SearchCondition = @$filter["v_img_01"];
		$this->img_01->AdvancedSearch->SearchValue2 = @$filter["y_img_01"];
		$this->img_01->AdvancedSearch->SearchOperator2 = @$filter["w_img_01"];
		$this->img_01->AdvancedSearch->Save();

		// Field img_02
		$this->img_02->AdvancedSearch->SearchValue = @$filter["x_img_02"];
		$this->img_02->AdvancedSearch->SearchOperator = @$filter["z_img_02"];
		$this->img_02->AdvancedSearch->SearchCondition = @$filter["v_img_02"];
		$this->img_02->AdvancedSearch->SearchValue2 = @$filter["y_img_02"];
		$this->img_02->AdvancedSearch->SearchOperator2 = @$filter["w_img_02"];
		$this->img_02->AdvancedSearch->Save();

		// Field img_03
		$this->img_03->AdvancedSearch->SearchValue = @$filter["x_img_03"];
		$this->img_03->AdvancedSearch->SearchOperator = @$filter["z_img_03"];
		$this->img_03->AdvancedSearch->SearchCondition = @$filter["v_img_03"];
		$this->img_03->AdvancedSearch->SearchValue2 = @$filter["y_img_03"];
		$this->img_03->AdvancedSearch->SearchOperator2 = @$filter["w_img_03"];
		$this->img_03->AdvancedSearch->Save();

		// Field img_04
		$this->img_04->AdvancedSearch->SearchValue = @$filter["x_img_04"];
		$this->img_04->AdvancedSearch->SearchOperator = @$filter["z_img_04"];
		$this->img_04->AdvancedSearch->SearchCondition = @$filter["v_img_04"];
		$this->img_04->AdvancedSearch->SearchValue2 = @$filter["y_img_04"];
		$this->img_04->AdvancedSearch->SearchOperator2 = @$filter["w_img_04"];
		$this->img_04->AdvancedSearch->Save();

		// Field img_05
		$this->img_05->AdvancedSearch->SearchValue = @$filter["x_img_05"];
		$this->img_05->AdvancedSearch->SearchOperator = @$filter["z_img_05"];
		$this->img_05->AdvancedSearch->SearchCondition = @$filter["v_img_05"];
		$this->img_05->AdvancedSearch->SearchValue2 = @$filter["y_img_05"];
		$this->img_05->AdvancedSearch->SearchOperator2 = @$filter["w_img_05"];
		$this->img_05->AdvancedSearch->Save();

		// Field img_06
		$this->img_06->AdvancedSearch->SearchValue = @$filter["x_img_06"];
		$this->img_06->AdvancedSearch->SearchOperator = @$filter["z_img_06"];
		$this->img_06->AdvancedSearch->SearchCondition = @$filter["v_img_06"];
		$this->img_06->AdvancedSearch->SearchValue2 = @$filter["y_img_06"];
		$this->img_06->AdvancedSearch->SearchOperator2 = @$filter["w_img_06"];
		$this->img_06->AdvancedSearch->Save();

		// Field img_07
		$this->img_07->AdvancedSearch->SearchValue = @$filter["x_img_07"];
		$this->img_07->AdvancedSearch->SearchOperator = @$filter["z_img_07"];
		$this->img_07->AdvancedSearch->SearchCondition = @$filter["v_img_07"];
		$this->img_07->AdvancedSearch->SearchValue2 = @$filter["y_img_07"];
		$this->img_07->AdvancedSearch->SearchOperator2 = @$filter["w_img_07"];
		$this->img_07->AdvancedSearch->Save();

		// Field img_08
		$this->img_08->AdvancedSearch->SearchValue = @$filter["x_img_08"];
		$this->img_08->AdvancedSearch->SearchOperator = @$filter["z_img_08"];
		$this->img_08->AdvancedSearch->SearchCondition = @$filter["v_img_08"];
		$this->img_08->AdvancedSearch->SearchValue2 = @$filter["y_img_08"];
		$this->img_08->AdvancedSearch->SearchOperator2 = @$filter["w_img_08"];
		$this->img_08->AdvancedSearch->Save();

		// Field img_09
		$this->img_09->AdvancedSearch->SearchValue = @$filter["x_img_09"];
		$this->img_09->AdvancedSearch->SearchOperator = @$filter["z_img_09"];
		$this->img_09->AdvancedSearch->SearchCondition = @$filter["v_img_09"];
		$this->img_09->AdvancedSearch->SearchValue2 = @$filter["y_img_09"];
		$this->img_09->AdvancedSearch->SearchOperator2 = @$filter["w_img_09"];
		$this->img_09->AdvancedSearch->Save();

		// Field img_10
		$this->img_10->AdvancedSearch->SearchValue = @$filter["x_img_10"];
		$this->img_10->AdvancedSearch->SearchOperator = @$filter["z_img_10"];
		$this->img_10->AdvancedSearch->SearchCondition = @$filter["v_img_10"];
		$this->img_10->AdvancedSearch->SearchValue2 = @$filter["y_img_10"];
		$this->img_10->AdvancedSearch->SearchOperator2 = @$filter["w_img_10"];
		$this->img_10->AdvancedSearch->Save();

		// Field img_11
		$this->img_11->AdvancedSearch->SearchValue = @$filter["x_img_11"];
		$this->img_11->AdvancedSearch->SearchOperator = @$filter["z_img_11"];
		$this->img_11->AdvancedSearch->SearchCondition = @$filter["v_img_11"];
		$this->img_11->AdvancedSearch->SearchValue2 = @$filter["y_img_11"];
		$this->img_11->AdvancedSearch->SearchOperator2 = @$filter["w_img_11"];
		$this->img_11->AdvancedSearch->Save();

		// Field img_12
		$this->img_12->AdvancedSearch->SearchValue = @$filter["x_img_12"];
		$this->img_12->AdvancedSearch->SearchOperator = @$filter["z_img_12"];
		$this->img_12->AdvancedSearch->SearchCondition = @$filter["v_img_12"];
		$this->img_12->AdvancedSearch->SearchValue2 = @$filter["y_img_12"];
		$this->img_12->AdvancedSearch->SearchOperator2 = @$filter["w_img_12"];
		$this->img_12->AdvancedSearch->Save();

		// Field extra_features
		$this->extra_features->AdvancedSearch->SearchValue = @$filter["x_extra_features"];
		$this->extra_features->AdvancedSearch->SearchOperator = @$filter["z_extra_features"];
		$this->extra_features->AdvancedSearch->SearchCondition = @$filter["v_extra_features"];
		$this->extra_features->AdvancedSearch->SearchValue2 = @$filter["y_extra_features"];
		$this->extra_features->AdvancedSearch->SearchOperator2 = @$filter["w_extra_features"];
		$this->extra_features->AdvancedSearch->Save();

		// Field so
		$this->so->AdvancedSearch->SearchValue = @$filter["x_so"];
		$this->so->AdvancedSearch->SearchOperator = @$filter["z_so"];
		$this->so->AdvancedSearch->SearchCondition = @$filter["v_so"];
		$this->so->AdvancedSearch->SearchValue2 = @$filter["y_so"];
		$this->so->AdvancedSearch->SearchOperator2 = @$filter["w_so"];
		$this->so->AdvancedSearch->Save();

		// Field active
		$this->active->AdvancedSearch->SearchValue = @$filter["x_active"];
		$this->active->AdvancedSearch->SearchOperator = @$filter["z_active"];
		$this->active->AdvancedSearch->SearchCondition = @$filter["v_active"];
		$this->active->AdvancedSearch->SearchValue2 = @$filter["y_active"];
		$this->active->AdvancedSearch->SearchOperator2 = @$filter["w_active"];
		$this->active->AdvancedSearch->Save();
		$this->BasicSearch->setKeyword(@$filter[EW_TABLE_BASIC_SEARCH]);
		$this->BasicSearch->setType(@$filter[EW_TABLE_BASIC_SEARCH_TYPE]);
	}

	// Return basic search SQL
	function BasicSearchSQL($arKeywords, $type) {
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $this->slug, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->description, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->engine, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->colorID, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->summary, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->term, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->_thumbnail, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->img_01, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->img_02, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->img_03, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->img_04, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->img_05, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->img_06, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->img_07, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->img_08, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->img_09, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->img_10, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->img_11, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->img_12, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->extra_features, $arKeywords, $type);
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
			$this->UpdateSort($this->userCarID); // userCarID
			$this->UpdateSort($this->makeID); // makeID
			$this->UpdateSort($this->modelID); // modelID
			$this->UpdateSort($this->slug); // slug
			$this->UpdateSort($this->yearID); // yearID
			$this->UpdateSort($this->kilometers); // kilometers
			$this->UpdateSort($this->priceAED); // priceAED
			$this->UpdateSort($this->transmissionTypeID); // transmissionTypeID
			$this->UpdateSort($this->_thumbnail); // thumbnail
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
				$this->userCarID->setSort("");
				$this->makeID->setSort("");
				$this->modelID->setSort("");
				$this->slug->setSort("");
				$this->yearID->setSort("");
				$this->kilometers->setSort("");
				$this->priceAED->setSort("");
				$this->transmissionTypeID->setSort("");
				$this->_thumbnail->setSort("");
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
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ewMultiSelect\" value=\"" . ew_HtmlEncode($this->userCarID->CurrentValue) . "\" onclick=\"ew_ClickMultiCheckbox(event);\">";
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fused_carslistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fused_carslistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.fused_carslist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fused_carslistsrch\">" . $Language->Phrase("SearchLink") . "</button>";
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
		$this->userCarID->setDbValue($row['userCarID']);
		$this->makeID->setDbValue($row['makeID']);
		$this->modelID->setDbValue($row['modelID']);
		$this->slug->setDbValue($row['slug']);
		$this->yearID->setDbValue($row['yearID']);
		$this->kilometers->setDbValue($row['kilometers']);
		$this->priceAED->setDbValue($row['priceAED']);
		$this->priceUSD->setDbValue($row['priceUSD']);
		$this->priceOMR->setDbValue($row['priceOMR']);
		$this->priceSAR->setDbValue($row['priceSAR']);
		$this->description->setDbValue($row['description']);
		$this->fuelTypeID->setDbValue($row['fuelTypeID']);
		$this->regionalID->setDbValue($row['regionalID']);
		$this->warrantyID->setDbValue($row['warrantyID']);
		$this->noOfDoors->setDbValue($row['noOfDoors']);
		$this->transmissionTypeID->setDbValue($row['transmissionTypeID']);
		$this->cylinderID->setDbValue($row['cylinderID']);
		$this->engine->setDbValue($row['engine']);
		$this->colorID->setDbValue($row['colorID']);
		$this->bodyConditionID->setDbValue($row['bodyConditionID']);
		$this->summary->setDbValue($row['summary']);
		$this->term->setDbValue($row['term']);
		$this->_thumbnail->Upload->DbValue = $row['thumbnail'];
		$this->_thumbnail->setDbValue($this->_thumbnail->Upload->DbValue);
		$this->img_01->Upload->DbValue = $row['img_01'];
		$this->img_01->setDbValue($this->img_01->Upload->DbValue);
		$this->img_02->Upload->DbValue = $row['img_02'];
		$this->img_02->setDbValue($this->img_02->Upload->DbValue);
		$this->img_03->Upload->DbValue = $row['img_03'];
		$this->img_03->setDbValue($this->img_03->Upload->DbValue);
		$this->img_04->Upload->DbValue = $row['img_04'];
		$this->img_04->setDbValue($this->img_04->Upload->DbValue);
		$this->img_05->Upload->DbValue = $row['img_05'];
		$this->img_05->setDbValue($this->img_05->Upload->DbValue);
		$this->img_06->Upload->DbValue = $row['img_06'];
		$this->img_06->setDbValue($this->img_06->Upload->DbValue);
		$this->img_07->Upload->DbValue = $row['img_07'];
		$this->img_07->setDbValue($this->img_07->Upload->DbValue);
		$this->img_08->Upload->DbValue = $row['img_08'];
		$this->img_08->setDbValue($this->img_08->Upload->DbValue);
		$this->img_09->Upload->DbValue = $row['img_09'];
		$this->img_09->setDbValue($this->img_09->Upload->DbValue);
		$this->img_10->Upload->DbValue = $row['img_10'];
		$this->img_10->setDbValue($this->img_10->Upload->DbValue);
		$this->img_11->Upload->DbValue = $row['img_11'];
		$this->img_11->setDbValue($this->img_11->Upload->DbValue);
		$this->img_12->Upload->DbValue = $row['img_12'];
		$this->img_12->setDbValue($this->img_12->Upload->DbValue);
		$this->extra_features->setDbValue($row['extra_features']);
		$this->so->setDbValue($row['so']);
		$this->active->setDbValue($row['active']);
		$this->regionalSpec->setDbValue($row['regionalSpec']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['userCarID'] = NULL;
		$row['makeID'] = NULL;
		$row['modelID'] = NULL;
		$row['slug'] = NULL;
		$row['yearID'] = NULL;
		$row['kilometers'] = NULL;
		$row['priceAED'] = NULL;
		$row['priceUSD'] = NULL;
		$row['priceOMR'] = NULL;
		$row['priceSAR'] = NULL;
		$row['description'] = NULL;
		$row['fuelTypeID'] = NULL;
		$row['regionalID'] = NULL;
		$row['warrantyID'] = NULL;
		$row['noOfDoors'] = NULL;
		$row['transmissionTypeID'] = NULL;
		$row['cylinderID'] = NULL;
		$row['engine'] = NULL;
		$row['colorID'] = NULL;
		$row['bodyConditionID'] = NULL;
		$row['summary'] = NULL;
		$row['term'] = NULL;
		$row['thumbnail'] = NULL;
		$row['img_01'] = NULL;
		$row['img_02'] = NULL;
		$row['img_03'] = NULL;
		$row['img_04'] = NULL;
		$row['img_05'] = NULL;
		$row['img_06'] = NULL;
		$row['img_07'] = NULL;
		$row['img_08'] = NULL;
		$row['img_09'] = NULL;
		$row['img_10'] = NULL;
		$row['img_11'] = NULL;
		$row['img_12'] = NULL;
		$row['extra_features'] = NULL;
		$row['so'] = NULL;
		$row['active'] = NULL;
		$row['regionalSpec'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->userCarID->DbValue = $row['userCarID'];
		$this->makeID->DbValue = $row['makeID'];
		$this->modelID->DbValue = $row['modelID'];
		$this->slug->DbValue = $row['slug'];
		$this->yearID->DbValue = $row['yearID'];
		$this->kilometers->DbValue = $row['kilometers'];
		$this->priceAED->DbValue = $row['priceAED'];
		$this->priceUSD->DbValue = $row['priceUSD'];
		$this->priceOMR->DbValue = $row['priceOMR'];
		$this->priceSAR->DbValue = $row['priceSAR'];
		$this->description->DbValue = $row['description'];
		$this->fuelTypeID->DbValue = $row['fuelTypeID'];
		$this->regionalID->DbValue = $row['regionalID'];
		$this->warrantyID->DbValue = $row['warrantyID'];
		$this->noOfDoors->DbValue = $row['noOfDoors'];
		$this->transmissionTypeID->DbValue = $row['transmissionTypeID'];
		$this->cylinderID->DbValue = $row['cylinderID'];
		$this->engine->DbValue = $row['engine'];
		$this->colorID->DbValue = $row['colorID'];
		$this->bodyConditionID->DbValue = $row['bodyConditionID'];
		$this->summary->DbValue = $row['summary'];
		$this->term->DbValue = $row['term'];
		$this->_thumbnail->Upload->DbValue = $row['thumbnail'];
		$this->img_01->Upload->DbValue = $row['img_01'];
		$this->img_02->Upload->DbValue = $row['img_02'];
		$this->img_03->Upload->DbValue = $row['img_03'];
		$this->img_04->Upload->DbValue = $row['img_04'];
		$this->img_05->Upload->DbValue = $row['img_05'];
		$this->img_06->Upload->DbValue = $row['img_06'];
		$this->img_07->Upload->DbValue = $row['img_07'];
		$this->img_08->Upload->DbValue = $row['img_08'];
		$this->img_09->Upload->DbValue = $row['img_09'];
		$this->img_10->Upload->DbValue = $row['img_10'];
		$this->img_11->Upload->DbValue = $row['img_11'];
		$this->img_12->Upload->DbValue = $row['img_12'];
		$this->extra_features->DbValue = $row['extra_features'];
		$this->so->DbValue = $row['so'];
		$this->active->DbValue = $row['active'];
		$this->regionalSpec->DbValue = $row['regionalSpec'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("userCarID")) <> "")
			$this->userCarID->CurrentValue = $this->getKey("userCarID"); // userCarID
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
		// userCarID
		// makeID
		// modelID
		// slug
		// yearID
		// kilometers
		// priceAED
		// priceUSD
		// priceOMR
		// priceSAR
		// description
		// fuelTypeID
		// regionalID
		// warrantyID
		// noOfDoors
		// transmissionTypeID
		// cylinderID
		// engine
		// colorID
		// bodyConditionID
		// summary
		// term
		// thumbnail
		// img_01
		// img_02
		// img_03
		// img_04
		// img_05
		// img_06
		// img_07
		// img_08
		// img_09
		// img_10
		// img_11
		// img_12
		// extra_features
		// so
		// active
		// regionalSpec

		$this->regionalSpec->CellCssStyle = "white-space: nowrap;";
		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// userCarID
		$this->userCarID->ViewValue = $this->userCarID->CurrentValue;
		$this->userCarID->ViewCustomAttributes = "";

		// makeID
		if (strval($this->makeID->CurrentValue) <> "") {
			$sFilterWrk = "`makeID`" . ew_SearchString("=", $this->makeID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `makeID`, `make` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_make`";
		$sWhereWrk = "";
		$this->makeID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->makeID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->makeID->ViewValue = $this->makeID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->makeID->ViewValue = $this->makeID->CurrentValue;
			}
		} else {
			$this->makeID->ViewValue = NULL;
		}
		$this->makeID->ViewCustomAttributes = "";

		// modelID
		if (strval($this->modelID->CurrentValue) <> "") {
			$sFilterWrk = "`modelID`" . ew_SearchString("=", $this->modelID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `modelID`, `model` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_model`";
		$sWhereWrk = "";
		$this->modelID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->modelID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->modelID->ViewValue = $this->modelID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->modelID->ViewValue = $this->modelID->CurrentValue;
			}
		} else {
			$this->modelID->ViewValue = NULL;
		}
		$this->modelID->ViewCustomAttributes = "";

		// slug
		$this->slug->ViewValue = $this->slug->CurrentValue;
		$this->slug->ViewCustomAttributes = "";

		// yearID
		if (strval($this->yearID->CurrentValue) <> "") {
			$sFilterWrk = "`yearID`" . ew_SearchString("=", $this->yearID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `yearID`, `year` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_year`";
		$sWhereWrk = "";
		$this->yearID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->yearID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->yearID->ViewValue = $this->yearID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->yearID->ViewValue = $this->yearID->CurrentValue;
			}
		} else {
			$this->yearID->ViewValue = NULL;
		}
		$this->yearID->ViewCustomAttributes = "";

		// kilometers
		$this->kilometers->ViewValue = $this->kilometers->CurrentValue;
		$this->kilometers->ViewCustomAttributes = "";

		// priceAED
		$this->priceAED->ViewValue = $this->priceAED->CurrentValue;
		$this->priceAED->ViewCustomAttributes = "";

		// priceUSD
		$this->priceUSD->ViewValue = $this->priceUSD->CurrentValue;
		$this->priceUSD->ViewCustomAttributes = "";

		// priceOMR
		$this->priceOMR->ViewValue = $this->priceOMR->CurrentValue;
		$this->priceOMR->ViewCustomAttributes = "";

		// priceSAR
		$this->priceSAR->ViewValue = $this->priceSAR->CurrentValue;
		$this->priceSAR->ViewCustomAttributes = "";

		// description
		$this->description->ViewValue = $this->description->CurrentValue;
		$this->description->ViewCustomAttributes = "";

		// fuelTypeID
		if (strval($this->fuelTypeID->CurrentValue) <> "") {
			$sFilterWrk = "`fuelTypeID`" . ew_SearchString("=", $this->fuelTypeID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `fuelTypeID`, `fuelType` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_fuel_type`";
		$sWhereWrk = "";
		$this->fuelTypeID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->fuelTypeID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->fuelTypeID->ViewValue = $this->fuelTypeID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->fuelTypeID->ViewValue = $this->fuelTypeID->CurrentValue;
			}
		} else {
			$this->fuelTypeID->ViewValue = NULL;
		}
		$this->fuelTypeID->ViewCustomAttributes = "";

		// regionalID
		if (strval($this->regionalID->CurrentValue) <> "") {
			$sFilterWrk = "`regionalID`" . ew_SearchString("=", $this->regionalID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `regionalID`, `regionalSpecs` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_regional_spec`";
		$sWhereWrk = "";
		$this->regionalID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->regionalID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->regionalID->ViewValue = $this->regionalID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->regionalID->ViewValue = $this->regionalID->CurrentValue;
			}
		} else {
			$this->regionalID->ViewValue = NULL;
		}
		$this->regionalID->ViewCustomAttributes = "";

		// warrantyID
		if (strval($this->warrantyID->CurrentValue) <> "") {
			$sFilterWrk = "`warrantyID`" . ew_SearchString("=", $this->warrantyID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `warrantyID`, `warrantyName` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_warranty`";
		$sWhereWrk = "";
		$this->warrantyID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->warrantyID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->warrantyID->ViewValue = $this->warrantyID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->warrantyID->ViewValue = $this->warrantyID->CurrentValue;
			}
		} else {
			$this->warrantyID->ViewValue = NULL;
		}
		$this->warrantyID->ViewCustomAttributes = "";

		// noOfDoors
		$this->noOfDoors->ViewValue = $this->noOfDoors->CurrentValue;
		$this->noOfDoors->ViewCustomAttributes = "";

		// transmissionTypeID
		if (strval($this->transmissionTypeID->CurrentValue) <> "") {
			$sFilterWrk = "`transmissionID`" . ew_SearchString("=", $this->transmissionTypeID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `transmissionID`, `transmission` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_transmission`";
		$sWhereWrk = "";
		$this->transmissionTypeID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->transmissionTypeID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->transmissionTypeID->ViewValue = $this->transmissionTypeID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->transmissionTypeID->ViewValue = $this->transmissionTypeID->CurrentValue;
			}
		} else {
			$this->transmissionTypeID->ViewValue = NULL;
		}
		$this->transmissionTypeID->ViewCustomAttributes = "";

		// cylinderID
		if (strval($this->cylinderID->CurrentValue) <> "") {
			$sFilterWrk = "`cylinderID`" . ew_SearchString("=", $this->cylinderID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `cylinderID`, `cylinder` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_cylinder`";
		$sWhereWrk = "";
		$this->cylinderID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->cylinderID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->cylinderID->ViewValue = $this->cylinderID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->cylinderID->ViewValue = $this->cylinderID->CurrentValue;
			}
		} else {
			$this->cylinderID->ViewValue = NULL;
		}
		$this->cylinderID->ViewCustomAttributes = "";

		// engine
		$this->engine->ViewValue = $this->engine->CurrentValue;
		$this->engine->ViewCustomAttributes = "";

		// colorID
		if (strval($this->colorID->CurrentValue) <> "") {
			$sFilterWrk = "`colorID`" . ew_SearchString("=", $this->colorID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `colorID`, `color` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_color`";
		$sWhereWrk = "";
		$this->colorID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->colorID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->colorID->ViewValue = $this->colorID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->colorID->ViewValue = $this->colorID->CurrentValue;
			}
		} else {
			$this->colorID->ViewValue = NULL;
		}
		$this->colorID->ViewCustomAttributes = "";

		// bodyConditionID
		if (strval($this->bodyConditionID->CurrentValue) <> "") {
			$sFilterWrk = "`bodyConditionID`" . ew_SearchString("=", $this->bodyConditionID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `bodyConditionID`, `bodyCondition` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_body_condition`";
		$sWhereWrk = "";
		$this->bodyConditionID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->bodyConditionID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->bodyConditionID->ViewValue = $this->bodyConditionID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->bodyConditionID->ViewValue = $this->bodyConditionID->CurrentValue;
			}
		} else {
			$this->bodyConditionID->ViewValue = NULL;
		}
		$this->bodyConditionID->ViewCustomAttributes = "";

		// term
		if (strval($this->term->CurrentValue) <> "") {
			$sFilterWrk = "`termID`" . ew_SearchString("=", $this->term->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `termID`, `term` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_term`";
		$sWhereWrk = "";
		$this->term->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->term, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->term->ViewValue = $this->term->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->term->ViewValue = $this->term->CurrentValue;
			}
		} else {
			$this->term->ViewValue = NULL;
		}
		$this->term->ViewCustomAttributes = "";

		// thumbnail
		$this->_thumbnail->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->_thumbnail->Upload->DbValue)) {
			$this->_thumbnail->ImageWidth = 100;
			$this->_thumbnail->ImageHeight = 0;
			$this->_thumbnail->ImageAlt = $this->_thumbnail->FldAlt();
			$this->_thumbnail->ViewValue = $this->_thumbnail->Upload->DbValue;
		} else {
			$this->_thumbnail->ViewValue = "";
		}
		$this->_thumbnail->ViewCustomAttributes = "";

		// img_01
		$this->img_01->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_01->Upload->DbValue)) {
			$this->img_01->ImageWidth = 100;
			$this->img_01->ImageHeight = 0;
			$this->img_01->ImageAlt = $this->img_01->FldAlt();
			$this->img_01->ViewValue = $this->img_01->Upload->DbValue;
		} else {
			$this->img_01->ViewValue = "";
		}
		$this->img_01->ViewCustomAttributes = "";

		// img_02
		$this->img_02->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_02->Upload->DbValue)) {
			$this->img_02->ImageWidth = 100;
			$this->img_02->ImageHeight = 0;
			$this->img_02->ImageAlt = $this->img_02->FldAlt();
			$this->img_02->ViewValue = $this->img_02->Upload->DbValue;
		} else {
			$this->img_02->ViewValue = "";
		}
		$this->img_02->ViewCustomAttributes = "";

		// img_03
		$this->img_03->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_03->Upload->DbValue)) {
			$this->img_03->ImageWidth = 100;
			$this->img_03->ImageHeight = 0;
			$this->img_03->ImageAlt = $this->img_03->FldAlt();
			$this->img_03->ViewValue = $this->img_03->Upload->DbValue;
		} else {
			$this->img_03->ViewValue = "";
		}
		$this->img_03->ViewCustomAttributes = "";

		// img_04
		$this->img_04->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_04->Upload->DbValue)) {
			$this->img_04->ImageWidth = 100;
			$this->img_04->ImageHeight = 0;
			$this->img_04->ImageAlt = $this->img_04->FldAlt();
			$this->img_04->ViewValue = $this->img_04->Upload->DbValue;
		} else {
			$this->img_04->ViewValue = "";
		}
		$this->img_04->ViewCustomAttributes = "";

		// img_05
		$this->img_05->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_05->Upload->DbValue)) {
			$this->img_05->ImageWidth = 100;
			$this->img_05->ImageHeight = 0;
			$this->img_05->ImageAlt = $this->img_05->FldAlt();
			$this->img_05->ViewValue = $this->img_05->Upload->DbValue;
		} else {
			$this->img_05->ViewValue = "";
		}
		$this->img_05->ViewCustomAttributes = "";

		// img_06
		$this->img_06->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_06->Upload->DbValue)) {
			$this->img_06->ImageWidth = 100;
			$this->img_06->ImageHeight = 0;
			$this->img_06->ImageAlt = $this->img_06->FldAlt();
			$this->img_06->ViewValue = $this->img_06->Upload->DbValue;
		} else {
			$this->img_06->ViewValue = "";
		}
		$this->img_06->ViewCustomAttributes = "";

		// img_07
		$this->img_07->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_07->Upload->DbValue)) {
			$this->img_07->ImageWidth = 100;
			$this->img_07->ImageHeight = 0;
			$this->img_07->ImageAlt = $this->img_07->FldAlt();
			$this->img_07->ViewValue = $this->img_07->Upload->DbValue;
		} else {
			$this->img_07->ViewValue = "";
		}
		$this->img_07->ViewCustomAttributes = "";

		// img_08
		$this->img_08->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_08->Upload->DbValue)) {
			$this->img_08->ImageWidth = 100;
			$this->img_08->ImageHeight = 0;
			$this->img_08->ImageAlt = $this->img_08->FldAlt();
			$this->img_08->ViewValue = $this->img_08->Upload->DbValue;
		} else {
			$this->img_08->ViewValue = "";
		}
		$this->img_08->ViewCustomAttributes = "";

		// img_09
		$this->img_09->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_09->Upload->DbValue)) {
			$this->img_09->ImageWidth = 100;
			$this->img_09->ImageHeight = 0;
			$this->img_09->ImageAlt = $this->img_09->FldAlt();
			$this->img_09->ViewValue = $this->img_09->Upload->DbValue;
		} else {
			$this->img_09->ViewValue = "";
		}
		$this->img_09->ViewCustomAttributes = "";

		// img_10
		$this->img_10->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_10->Upload->DbValue)) {
			$this->img_10->ImageWidth = 100;
			$this->img_10->ImageHeight = 0;
			$this->img_10->ImageAlt = $this->img_10->FldAlt();
			$this->img_10->ViewValue = $this->img_10->Upload->DbValue;
		} else {
			$this->img_10->ViewValue = "";
		}
		$this->img_10->ViewCustomAttributes = "";

		// img_11
		$this->img_11->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_11->Upload->DbValue)) {
			$this->img_11->ImageWidth = 100;
			$this->img_11->ImageHeight = 0;
			$this->img_11->ImageAlt = $this->img_11->FldAlt();
			$this->img_11->ViewValue = $this->img_11->Upload->DbValue;
		} else {
			$this->img_11->ViewValue = "";
		}
		$this->img_11->ViewCustomAttributes = "";

		// img_12
		$this->img_12->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_12->Upload->DbValue)) {
			$this->img_12->ImageWidth = 100;
			$this->img_12->ImageHeight = 0;
			$this->img_12->ImageAlt = $this->img_12->FldAlt();
			$this->img_12->ViewValue = $this->img_12->Upload->DbValue;
		} else {
			$this->img_12->ViewValue = "";
		}
		$this->img_12->ViewCustomAttributes = "";

		// so
		$this->so->ViewValue = $this->so->CurrentValue;
		$this->so->ViewCustomAttributes = "";

		// active
		if (strval($this->active->CurrentValue) <> "") {
			$this->active->ViewValue = $this->active->OptionCaption($this->active->CurrentValue);
		} else {
			$this->active->ViewValue = NULL;
		}
		$this->active->ViewCustomAttributes = "";

			// userCarID
			$this->userCarID->LinkCustomAttributes = "";
			$this->userCarID->HrefValue = "";
			$this->userCarID->TooltipValue = "";

			// makeID
			$this->makeID->LinkCustomAttributes = "";
			$this->makeID->HrefValue = "";
			$this->makeID->TooltipValue = "";

			// modelID
			$this->modelID->LinkCustomAttributes = "";
			$this->modelID->HrefValue = "";
			$this->modelID->TooltipValue = "";

			// slug
			$this->slug->LinkCustomAttributes = "";
			$this->slug->HrefValue = "";
			$this->slug->TooltipValue = "";

			// yearID
			$this->yearID->LinkCustomAttributes = "";
			$this->yearID->HrefValue = "";
			$this->yearID->TooltipValue = "";

			// kilometers
			$this->kilometers->LinkCustomAttributes = "";
			$this->kilometers->HrefValue = "";
			$this->kilometers->TooltipValue = "";

			// priceAED
			$this->priceAED->LinkCustomAttributes = "";
			$this->priceAED->HrefValue = "";
			$this->priceAED->TooltipValue = "";

			// transmissionTypeID
			$this->transmissionTypeID->LinkCustomAttributes = "";
			$this->transmissionTypeID->HrefValue = "";
			$this->transmissionTypeID->TooltipValue = "";

			// thumbnail
			$this->_thumbnail->LinkCustomAttributes = "";
			$this->_thumbnail->UploadPath = 'uploads/usedcars';
			if (!ew_Empty($this->_thumbnail->Upload->DbValue)) {
				$this->_thumbnail->HrefValue = ew_GetFileUploadUrl($this->_thumbnail, $this->_thumbnail->Upload->DbValue); // Add prefix/suffix
				$this->_thumbnail->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->_thumbnail->HrefValue = ew_FullUrl($this->_thumbnail->HrefValue, "href");
			} else {
				$this->_thumbnail->HrefValue = "";
			}
			$this->_thumbnail->HrefValue2 = $this->_thumbnail->UploadPath . $this->_thumbnail->Upload->DbValue;
			$this->_thumbnail->TooltipValue = "";
			if ($this->_thumbnail->UseColorbox) {
				if (ew_Empty($this->_thumbnail->TooltipValue))
					$this->_thumbnail->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->_thumbnail->LinkAttrs["data-rel"] = "used_cars_x" . $this->RowCnt . "__thumbnail";
				ew_AppendClass($this->_thumbnail->LinkAttrs["class"], "ewLightbox");
			}

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
		$item->Body = "<button id=\"emf_used_cars\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_used_cars',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.fused_carslist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
if (!isset($used_cars_list)) $used_cars_list = new cused_cars_list();

// Page init
$used_cars_list->Page_Init();

// Page main
$used_cars_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$used_cars_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($used_cars->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = fused_carslist = new ew_Form("fused_carslist", "list");
fused_carslist.FormKeyCountName = '<?php echo $used_cars_list->FormKeyCountName ?>';

// Form_CustomValidate event
fused_carslist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fused_carslist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fused_carslist.Lists["x_makeID"] = {"LinkField":"x_makeID","Ajax":true,"AutoFill":false,"DisplayFields":["x_make","","",""],"ParentFields":[],"ChildFields":["x_modelID"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_make"};
fused_carslist.Lists["x_makeID"].Data = "<?php echo $used_cars_list->makeID->LookupFilterQuery(FALSE, "list") ?>";
fused_carslist.Lists["x_modelID"] = {"LinkField":"x_modelID","Ajax":true,"AutoFill":false,"DisplayFields":["x_model","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_model"};
fused_carslist.Lists["x_modelID"].Data = "<?php echo $used_cars_list->modelID->LookupFilterQuery(FALSE, "list") ?>";
fused_carslist.Lists["x_yearID"] = {"LinkField":"x_yearID","Ajax":true,"AutoFill":false,"DisplayFields":["x_year","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_year"};
fused_carslist.Lists["x_yearID"].Data = "<?php echo $used_cars_list->yearID->LookupFilterQuery(FALSE, "list") ?>";
fused_carslist.Lists["x_transmissionTypeID"] = {"LinkField":"x_transmissionID","Ajax":true,"AutoFill":false,"DisplayFields":["x_transmission","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_transmission"};
fused_carslist.Lists["x_transmissionTypeID"].Data = "<?php echo $used_cars_list->transmissionTypeID->LookupFilterQuery(FALSE, "list") ?>";
fused_carslist.Lists["x_active"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fused_carslist.Lists["x_active"].Options = <?php echo json_encode($used_cars_list->active->Options()) ?>;

// Form object for search
var CurrentSearchForm = fused_carslistsrch = new ew_Form("fused_carslistsrch");
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
<?php if ($used_cars->Export == "") { ?>
<div class="ewToolbar">
<?php if ($used_cars_list->TotalRecs > 0 && $used_cars_list->ExportOptions->Visible()) { ?>
<?php $used_cars_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($used_cars_list->SearchOptions->Visible()) { ?>
<?php $used_cars_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($used_cars_list->FilterOptions->Visible()) { ?>
<?php $used_cars_list->FilterOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
	$bSelectLimit = $used_cars_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($used_cars_list->TotalRecs <= 0)
			$used_cars_list->TotalRecs = $used_cars->ListRecordCount();
	} else {
		if (!$used_cars_list->Recordset && ($used_cars_list->Recordset = $used_cars_list->LoadRecordset()))
			$used_cars_list->TotalRecs = $used_cars_list->Recordset->RecordCount();
	}
	$used_cars_list->StartRec = 1;
	if ($used_cars_list->DisplayRecs <= 0 || ($used_cars->Export <> "" && $used_cars->ExportAll)) // Display all records
		$used_cars_list->DisplayRecs = $used_cars_list->TotalRecs;
	if (!($used_cars->Export <> "" && $used_cars->ExportAll))
		$used_cars_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$used_cars_list->Recordset = $used_cars_list->LoadRecordset($used_cars_list->StartRec-1, $used_cars_list->DisplayRecs);

	// Set no record found message
	if ($used_cars->CurrentAction == "" && $used_cars_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$used_cars_list->setWarningMessage(ew_DeniedMsg());
		if ($used_cars_list->SearchWhere == "0=101")
			$used_cars_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$used_cars_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$used_cars_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($used_cars->Export == "" && $used_cars->CurrentAction == "") { ?>
<form name="fused_carslistsrch" id="fused_carslistsrch" class="form-inline ewForm ewExtSearchForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($used_cars_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="fused_carslistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="used_cars">
	<div class="ewBasicSearch">
<div id="xsr_1" class="ewRow">
	<div class="ewQuickSearch input-group">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo ew_HtmlEncode($used_cars_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo ew_HtmlEncode($Language->Phrase("Search")) ?>">
	<input type="hidden" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo ew_HtmlEncode($used_cars_list->BasicSearch->getType()) ?>">
	<div class="input-group-btn">
		<button type="button" data-toggle="dropdown" class="btn btn-default"><span id="searchtype"><?php echo $used_cars_list->BasicSearch->getTypeNameShort() ?></span><span class="caret"></span></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li<?php if ($used_cars_list->BasicSearch->getType() == "") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a></li>
			<li<?php if ($used_cars_list->BasicSearch->getType() == "=") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a></li>
			<li<?php if ($used_cars_list->BasicSearch->getType() == "AND") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a></li>
			<li<?php if ($used_cars_list->BasicSearch->getType() == "OR") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a></li>
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
<?php $used_cars_list->ShowPageHeader(); ?>
<?php
$used_cars_list->ShowMessage();
?>
<?php if ($used_cars_list->TotalRecs > 0 || $used_cars->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($used_cars_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> used_cars">
<?php if ($used_cars->Export == "") { ?>
<div class="box-header ewGridUpperPanel">
<?php if ($used_cars->CurrentAction <> "gridadd" && $used_cars->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($used_cars_list->Pager)) $used_cars_list->Pager = new cPrevNextPager($used_cars_list->StartRec, $used_cars_list->DisplayRecs, $used_cars_list->TotalRecs, $used_cars_list->AutoHidePager) ?>
<?php if ($used_cars_list->Pager->RecordCount > 0 && $used_cars_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($used_cars_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $used_cars_list->PageUrl() ?>start=<?php echo $used_cars_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($used_cars_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $used_cars_list->PageUrl() ?>start=<?php echo $used_cars_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $used_cars_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($used_cars_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $used_cars_list->PageUrl() ?>start=<?php echo $used_cars_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($used_cars_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $used_cars_list->PageUrl() ?>start=<?php echo $used_cars_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $used_cars_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($used_cars_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $used_cars_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $used_cars_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $used_cars_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($used_cars_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fused_carslist" id="fused_carslist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($used_cars_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $used_cars_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="used_cars">
<div id="gmp_used_cars" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($used_cars_list->TotalRecs > 0 || $used_cars->CurrentAction == "gridedit") { ?>
<table id="tbl_used_carslist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$used_cars_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$used_cars_list->RenderListOptions();

// Render list options (header, left)
$used_cars_list->ListOptions->Render("header", "left");
?>
<?php if ($used_cars->userCarID->Visible) { // userCarID ?>
	<?php if ($used_cars->SortUrl($used_cars->userCarID) == "") { ?>
		<th data-name="userCarID" class="<?php echo $used_cars->userCarID->HeaderCellClass() ?>"><div id="elh_used_cars_userCarID" class="used_cars_userCarID"><div class="ewTableHeaderCaption"><?php echo $used_cars->userCarID->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="userCarID" class="<?php echo $used_cars->userCarID->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $used_cars->SortUrl($used_cars->userCarID) ?>',1);"><div id="elh_used_cars_userCarID" class="used_cars_userCarID">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $used_cars->userCarID->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($used_cars->userCarID->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($used_cars->userCarID->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($used_cars->makeID->Visible) { // makeID ?>
	<?php if ($used_cars->SortUrl($used_cars->makeID) == "") { ?>
		<th data-name="makeID" class="<?php echo $used_cars->makeID->HeaderCellClass() ?>"><div id="elh_used_cars_makeID" class="used_cars_makeID"><div class="ewTableHeaderCaption"><?php echo $used_cars->makeID->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="makeID" class="<?php echo $used_cars->makeID->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $used_cars->SortUrl($used_cars->makeID) ?>',1);"><div id="elh_used_cars_makeID" class="used_cars_makeID">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $used_cars->makeID->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($used_cars->makeID->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($used_cars->makeID->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($used_cars->modelID->Visible) { // modelID ?>
	<?php if ($used_cars->SortUrl($used_cars->modelID) == "") { ?>
		<th data-name="modelID" class="<?php echo $used_cars->modelID->HeaderCellClass() ?>"><div id="elh_used_cars_modelID" class="used_cars_modelID"><div class="ewTableHeaderCaption"><?php echo $used_cars->modelID->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="modelID" class="<?php echo $used_cars->modelID->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $used_cars->SortUrl($used_cars->modelID) ?>',1);"><div id="elh_used_cars_modelID" class="used_cars_modelID">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $used_cars->modelID->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($used_cars->modelID->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($used_cars->modelID->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($used_cars->slug->Visible) { // slug ?>
	<?php if ($used_cars->SortUrl($used_cars->slug) == "") { ?>
		<th data-name="slug" class="<?php echo $used_cars->slug->HeaderCellClass() ?>"><div id="elh_used_cars_slug" class="used_cars_slug"><div class="ewTableHeaderCaption"><?php echo $used_cars->slug->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="slug" class="<?php echo $used_cars->slug->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $used_cars->SortUrl($used_cars->slug) ?>',1);"><div id="elh_used_cars_slug" class="used_cars_slug">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $used_cars->slug->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($used_cars->slug->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($used_cars->slug->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($used_cars->yearID->Visible) { // yearID ?>
	<?php if ($used_cars->SortUrl($used_cars->yearID) == "") { ?>
		<th data-name="yearID" class="<?php echo $used_cars->yearID->HeaderCellClass() ?>"><div id="elh_used_cars_yearID" class="used_cars_yearID"><div class="ewTableHeaderCaption"><?php echo $used_cars->yearID->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="yearID" class="<?php echo $used_cars->yearID->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $used_cars->SortUrl($used_cars->yearID) ?>',1);"><div id="elh_used_cars_yearID" class="used_cars_yearID">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $used_cars->yearID->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($used_cars->yearID->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($used_cars->yearID->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($used_cars->kilometers->Visible) { // kilometers ?>
	<?php if ($used_cars->SortUrl($used_cars->kilometers) == "") { ?>
		<th data-name="kilometers" class="<?php echo $used_cars->kilometers->HeaderCellClass() ?>"><div id="elh_used_cars_kilometers" class="used_cars_kilometers"><div class="ewTableHeaderCaption"><?php echo $used_cars->kilometers->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kilometers" class="<?php echo $used_cars->kilometers->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $used_cars->SortUrl($used_cars->kilometers) ?>',1);"><div id="elh_used_cars_kilometers" class="used_cars_kilometers">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $used_cars->kilometers->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($used_cars->kilometers->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($used_cars->kilometers->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($used_cars->priceAED->Visible) { // priceAED ?>
	<?php if ($used_cars->SortUrl($used_cars->priceAED) == "") { ?>
		<th data-name="priceAED" class="<?php echo $used_cars->priceAED->HeaderCellClass() ?>"><div id="elh_used_cars_priceAED" class="used_cars_priceAED"><div class="ewTableHeaderCaption"><?php echo $used_cars->priceAED->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="priceAED" class="<?php echo $used_cars->priceAED->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $used_cars->SortUrl($used_cars->priceAED) ?>',1);"><div id="elh_used_cars_priceAED" class="used_cars_priceAED">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $used_cars->priceAED->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($used_cars->priceAED->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($used_cars->priceAED->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($used_cars->transmissionTypeID->Visible) { // transmissionTypeID ?>
	<?php if ($used_cars->SortUrl($used_cars->transmissionTypeID) == "") { ?>
		<th data-name="transmissionTypeID" class="<?php echo $used_cars->transmissionTypeID->HeaderCellClass() ?>"><div id="elh_used_cars_transmissionTypeID" class="used_cars_transmissionTypeID"><div class="ewTableHeaderCaption"><?php echo $used_cars->transmissionTypeID->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmissionTypeID" class="<?php echo $used_cars->transmissionTypeID->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $used_cars->SortUrl($used_cars->transmissionTypeID) ?>',1);"><div id="elh_used_cars_transmissionTypeID" class="used_cars_transmissionTypeID">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $used_cars->transmissionTypeID->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($used_cars->transmissionTypeID->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($used_cars->transmissionTypeID->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($used_cars->_thumbnail->Visible) { // thumbnail ?>
	<?php if ($used_cars->SortUrl($used_cars->_thumbnail) == "") { ?>
		<th data-name="_thumbnail" class="<?php echo $used_cars->_thumbnail->HeaderCellClass() ?>"><div id="elh_used_cars__thumbnail" class="used_cars__thumbnail"><div class="ewTableHeaderCaption"><?php echo $used_cars->_thumbnail->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_thumbnail" class="<?php echo $used_cars->_thumbnail->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $used_cars->SortUrl($used_cars->_thumbnail) ?>',1);"><div id="elh_used_cars__thumbnail" class="used_cars__thumbnail">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $used_cars->_thumbnail->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($used_cars->_thumbnail->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($used_cars->_thumbnail->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($used_cars->active->Visible) { // active ?>
	<?php if ($used_cars->SortUrl($used_cars->active) == "") { ?>
		<th data-name="active" class="<?php echo $used_cars->active->HeaderCellClass() ?>"><div id="elh_used_cars_active" class="used_cars_active"><div class="ewTableHeaderCaption"><?php echo $used_cars->active->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="active" class="<?php echo $used_cars->active->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $used_cars->SortUrl($used_cars->active) ?>',1);"><div id="elh_used_cars_active" class="used_cars_active">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $used_cars->active->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($used_cars->active->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($used_cars->active->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$used_cars_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($used_cars->ExportAll && $used_cars->Export <> "") {
	$used_cars_list->StopRec = $used_cars_list->TotalRecs;
} else {

	// Set the last record to display
	if ($used_cars_list->TotalRecs > $used_cars_list->StartRec + $used_cars_list->DisplayRecs - 1)
		$used_cars_list->StopRec = $used_cars_list->StartRec + $used_cars_list->DisplayRecs - 1;
	else
		$used_cars_list->StopRec = $used_cars_list->TotalRecs;
}
$used_cars_list->RecCnt = $used_cars_list->StartRec - 1;
if ($used_cars_list->Recordset && !$used_cars_list->Recordset->EOF) {
	$used_cars_list->Recordset->MoveFirst();
	$bSelectLimit = $used_cars_list->UseSelectLimit;
	if (!$bSelectLimit && $used_cars_list->StartRec > 1)
		$used_cars_list->Recordset->Move($used_cars_list->StartRec - 1);
} elseif (!$used_cars->AllowAddDeleteRow && $used_cars_list->StopRec == 0) {
	$used_cars_list->StopRec = $used_cars->GridAddRowCount;
}

// Initialize aggregate
$used_cars->RowType = EW_ROWTYPE_AGGREGATEINIT;
$used_cars->ResetAttrs();
$used_cars_list->RenderRow();
while ($used_cars_list->RecCnt < $used_cars_list->StopRec) {
	$used_cars_list->RecCnt++;
	if (intval($used_cars_list->RecCnt) >= intval($used_cars_list->StartRec)) {
		$used_cars_list->RowCnt++;

		// Set up key count
		$used_cars_list->KeyCount = $used_cars_list->RowIndex;

		// Init row class and style
		$used_cars->ResetAttrs();
		$used_cars->CssClass = "";
		if ($used_cars->CurrentAction == "gridadd") {
		} else {
			$used_cars_list->LoadRowValues($used_cars_list->Recordset); // Load row values
		}
		$used_cars->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$used_cars->RowAttrs = array_merge($used_cars->RowAttrs, array('data-rowindex'=>$used_cars_list->RowCnt, 'id'=>'r' . $used_cars_list->RowCnt . '_used_cars', 'data-rowtype'=>$used_cars->RowType));

		// Render row
		$used_cars_list->RenderRow();

		// Render list options
		$used_cars_list->RenderListOptions();
?>
	<tr<?php echo $used_cars->RowAttributes() ?>>
<?php

// Render list options (body, left)
$used_cars_list->ListOptions->Render("body", "left", $used_cars_list->RowCnt);
?>
	<?php if ($used_cars->userCarID->Visible) { // userCarID ?>
		<td data-name="userCarID"<?php echo $used_cars->userCarID->CellAttributes() ?>>
<span id="el<?php echo $used_cars_list->RowCnt ?>_used_cars_userCarID" class="used_cars_userCarID">
<span<?php echo $used_cars->userCarID->ViewAttributes() ?>>
<?php echo $used_cars->userCarID->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($used_cars->makeID->Visible) { // makeID ?>
		<td data-name="makeID"<?php echo $used_cars->makeID->CellAttributes() ?>>
<span id="el<?php echo $used_cars_list->RowCnt ?>_used_cars_makeID" class="used_cars_makeID">
<span<?php echo $used_cars->makeID->ViewAttributes() ?>>
<?php echo $used_cars->makeID->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($used_cars->modelID->Visible) { // modelID ?>
		<td data-name="modelID"<?php echo $used_cars->modelID->CellAttributes() ?>>
<span id="el<?php echo $used_cars_list->RowCnt ?>_used_cars_modelID" class="used_cars_modelID">
<span<?php echo $used_cars->modelID->ViewAttributes() ?>>
<?php echo $used_cars->modelID->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($used_cars->slug->Visible) { // slug ?>
		<td data-name="slug"<?php echo $used_cars->slug->CellAttributes() ?>>
<span id="el<?php echo $used_cars_list->RowCnt ?>_used_cars_slug" class="used_cars_slug">
<span<?php echo $used_cars->slug->ViewAttributes() ?>>
<?php echo $used_cars->slug->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($used_cars->yearID->Visible) { // yearID ?>
		<td data-name="yearID"<?php echo $used_cars->yearID->CellAttributes() ?>>
<span id="el<?php echo $used_cars_list->RowCnt ?>_used_cars_yearID" class="used_cars_yearID">
<span<?php echo $used_cars->yearID->ViewAttributes() ?>>
<?php echo $used_cars->yearID->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($used_cars->kilometers->Visible) { // kilometers ?>
		<td data-name="kilometers"<?php echo $used_cars->kilometers->CellAttributes() ?>>
<span id="el<?php echo $used_cars_list->RowCnt ?>_used_cars_kilometers" class="used_cars_kilometers">
<span<?php echo $used_cars->kilometers->ViewAttributes() ?>>
<?php echo $used_cars->kilometers->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($used_cars->priceAED->Visible) { // priceAED ?>
		<td data-name="priceAED"<?php echo $used_cars->priceAED->CellAttributes() ?>>
<span id="el<?php echo $used_cars_list->RowCnt ?>_used_cars_priceAED" class="used_cars_priceAED">
<span<?php echo $used_cars->priceAED->ViewAttributes() ?>>
<?php echo $used_cars->priceAED->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($used_cars->transmissionTypeID->Visible) { // transmissionTypeID ?>
		<td data-name="transmissionTypeID"<?php echo $used_cars->transmissionTypeID->CellAttributes() ?>>
<span id="el<?php echo $used_cars_list->RowCnt ?>_used_cars_transmissionTypeID" class="used_cars_transmissionTypeID">
<span<?php echo $used_cars->transmissionTypeID->ViewAttributes() ?>>
<?php echo $used_cars->transmissionTypeID->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($used_cars->_thumbnail->Visible) { // thumbnail ?>
		<td data-name="_thumbnail"<?php echo $used_cars->_thumbnail->CellAttributes() ?>>
<span id="el<?php echo $used_cars_list->RowCnt ?>_used_cars__thumbnail" class="used_cars__thumbnail">
<span>
<?php echo ew_GetFileViewTag($used_cars->_thumbnail, $used_cars->_thumbnail->ListViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($used_cars->active->Visible) { // active ?>
		<td data-name="active"<?php echo $used_cars->active->CellAttributes() ?>>
<span id="el<?php echo $used_cars_list->RowCnt ?>_used_cars_active" class="used_cars_active">
<span<?php echo $used_cars->active->ViewAttributes() ?>>
<?php echo $used_cars->active->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$used_cars_list->ListOptions->Render("body", "right", $used_cars_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($used_cars->CurrentAction <> "gridadd")
		$used_cars_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($used_cars->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($used_cars_list->Recordset)
	$used_cars_list->Recordset->Close();
?>
<?php if ($used_cars->Export == "") { ?>
<div class="box-footer ewGridLowerPanel">
<?php if ($used_cars->CurrentAction <> "gridadd" && $used_cars->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($used_cars_list->Pager)) $used_cars_list->Pager = new cPrevNextPager($used_cars_list->StartRec, $used_cars_list->DisplayRecs, $used_cars_list->TotalRecs, $used_cars_list->AutoHidePager) ?>
<?php if ($used_cars_list->Pager->RecordCount > 0 && $used_cars_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($used_cars_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $used_cars_list->PageUrl() ?>start=<?php echo $used_cars_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($used_cars_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $used_cars_list->PageUrl() ?>start=<?php echo $used_cars_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $used_cars_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($used_cars_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $used_cars_list->PageUrl() ?>start=<?php echo $used_cars_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($used_cars_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $used_cars_list->PageUrl() ?>start=<?php echo $used_cars_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $used_cars_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($used_cars_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $used_cars_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $used_cars_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $used_cars_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($used_cars_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($used_cars_list->TotalRecs == 0 && $used_cars->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($used_cars_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($used_cars->Export == "") { ?>
<script type="text/javascript">
fused_carslistsrch.FilterList = <?php echo $used_cars_list->GetFilterList() ?>;
fused_carslistsrch.Init();
fused_carslist.Init();
</script>
<?php } ?>
<?php
$used_cars_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($used_cars->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$used_cars_list->Page_Terminate();
?>
