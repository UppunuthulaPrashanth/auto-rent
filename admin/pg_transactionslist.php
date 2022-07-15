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

$pg_transactions_list = NULL; // Initialize page object first

class cpg_transactions_list extends cpg_transactions {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'pg_transactions';

	// Page object name
	var $PageObjName = 'pg_transactions_list';

	// Grid form hidden field names
	var $FormName = 'fpg_transactionslist';
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

		// Table object (pg_transactions)
		if (!isset($GLOBALS["pg_transactions"]) || get_class($GLOBALS["pg_transactions"]) == "cpg_transactions") {
			$GLOBALS["pg_transactions"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["pg_transactions"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "pg_transactionsadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "pg_transactionsdelete.php";
		$this->MultiUpdateUrl = "pg_transactionsupdate.php";

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption fpg_transactionslistsrch";

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
			$this->transactionID->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->transactionID->FormValue))
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
			$sSavedFilterList = $UserProfile->GetSearchFilters(CurrentUserName(), "fpg_transactionslistsrch");
		$sFilterList = ew_Concat($sFilterList, $this->transactionID->AdvancedSearch->ToJson(), ","); // Field transactionID
		$sFilterList = ew_Concat($sFilterList, $this->_userID->AdvancedSearch->ToJson(), ","); // Field userID
		$sFilterList = ew_Concat($sFilterList, $this->bookingNumber->AdvancedSearch->ToJson(), ","); // Field bookingNumber
		$sFilterList = ew_Concat($sFilterList, $this->bookingModule->AdvancedSearch->ToJson(), ","); // Field bookingModule
		$sFilterList = ew_Concat($sFilterList, $this->order_id->AdvancedSearch->ToJson(), ","); // Field order_id
		$sFilterList = ew_Concat($sFilterList, $this->tracking_id->AdvancedSearch->ToJson(), ","); // Field tracking_id
		$sFilterList = ew_Concat($sFilterList, $this->bank_ref_no->AdvancedSearch->ToJson(), ","); // Field bank_ref_no
		$sFilterList = ew_Concat($sFilterList, $this->order_status->AdvancedSearch->ToJson(), ","); // Field order_status
		$sFilterList = ew_Concat($sFilterList, $this->failure_message->AdvancedSearch->ToJson(), ","); // Field failure_message
		$sFilterList = ew_Concat($sFilterList, $this->payment_mode->AdvancedSearch->ToJson(), ","); // Field payment_mode
		$sFilterList = ew_Concat($sFilterList, $this->card_name->AdvancedSearch->ToJson(), ","); // Field card_name
		$sFilterList = ew_Concat($sFilterList, $this->status_code->AdvancedSearch->ToJson(), ","); // Field status_code
		$sFilterList = ew_Concat($sFilterList, $this->status_message->AdvancedSearch->ToJson(), ","); // Field status_message
		$sFilterList = ew_Concat($sFilterList, $this->currency->AdvancedSearch->ToJson(), ","); // Field currency
		$sFilterList = ew_Concat($sFilterList, $this->amount->AdvancedSearch->ToJson(), ","); // Field amount
		$sFilterList = ew_Concat($sFilterList, $this->billing_name->AdvancedSearch->ToJson(), ","); // Field billing_name
		$sFilterList = ew_Concat($sFilterList, $this->billing_address->AdvancedSearch->ToJson(), ","); // Field billing_address
		$sFilterList = ew_Concat($sFilterList, $this->billing_city->AdvancedSearch->ToJson(), ","); // Field billing_city
		$sFilterList = ew_Concat($sFilterList, $this->billing_state->AdvancedSearch->ToJson(), ","); // Field billing_state
		$sFilterList = ew_Concat($sFilterList, $this->billing_zip->AdvancedSearch->ToJson(), ","); // Field billing_zip
		$sFilterList = ew_Concat($sFilterList, $this->billing_country->AdvancedSearch->ToJson(), ","); // Field billing_country
		$sFilterList = ew_Concat($sFilterList, $this->billing_tel->AdvancedSearch->ToJson(), ","); // Field billing_tel
		$sFilterList = ew_Concat($sFilterList, $this->billing_email->AdvancedSearch->ToJson(), ","); // Field billing_email
		$sFilterList = ew_Concat($sFilterList, $this->delivery_name->AdvancedSearch->ToJson(), ","); // Field delivery_name
		$sFilterList = ew_Concat($sFilterList, $this->delivery_address->AdvancedSearch->ToJson(), ","); // Field delivery_address
		$sFilterList = ew_Concat($sFilterList, $this->delivery_city->AdvancedSearch->ToJson(), ","); // Field delivery_city
		$sFilterList = ew_Concat($sFilterList, $this->delivery_state->AdvancedSearch->ToJson(), ","); // Field delivery_state
		$sFilterList = ew_Concat($sFilterList, $this->delivery_zip->AdvancedSearch->ToJson(), ","); // Field delivery_zip
		$sFilterList = ew_Concat($sFilterList, $this->delivery_country->AdvancedSearch->ToJson(), ","); // Field delivery_country
		$sFilterList = ew_Concat($sFilterList, $this->delivery_tel->AdvancedSearch->ToJson(), ","); // Field delivery_tel
		$sFilterList = ew_Concat($sFilterList, $this->merchant_param1->AdvancedSearch->ToJson(), ","); // Field merchant_param1
		$sFilterList = ew_Concat($sFilterList, $this->merchant_param2->AdvancedSearch->ToJson(), ","); // Field merchant_param2
		$sFilterList = ew_Concat($sFilterList, $this->merchant_param3->AdvancedSearch->ToJson(), ","); // Field merchant_param3
		$sFilterList = ew_Concat($sFilterList, $this->merchant_param4->AdvancedSearch->ToJson(), ","); // Field merchant_param4
		$sFilterList = ew_Concat($sFilterList, $this->merchant_param5->AdvancedSearch->ToJson(), ","); // Field merchant_param5
		$sFilterList = ew_Concat($sFilterList, $this->vault->AdvancedSearch->ToJson(), ","); // Field vault
		$sFilterList = ew_Concat($sFilterList, $this->offer_type->AdvancedSearch->ToJson(), ","); // Field offer_type
		$sFilterList = ew_Concat($sFilterList, $this->offer_code->AdvancedSearch->ToJson(), ","); // Field offer_code
		$sFilterList = ew_Concat($sFilterList, $this->discount_value->AdvancedSearch->ToJson(), ","); // Field discount_value
		$sFilterList = ew_Concat($sFilterList, $this->mer_amount->AdvancedSearch->ToJson(), ","); // Field mer_amount
		$sFilterList = ew_Concat($sFilterList, $this->eci_value->AdvancedSearch->ToJson(), ","); // Field eci_value
		$sFilterList = ew_Concat($sFilterList, $this->card_holder_name->AdvancedSearch->ToJson(), ","); // Field card_holder_name
		$sFilterList = ew_Concat($sFilterList, $this->bank_qsi_no->AdvancedSearch->ToJson(), ","); // Field bank_qsi_no
		$sFilterList = ew_Concat($sFilterList, $this->bank_receipt_no->AdvancedSearch->ToJson(), ","); // Field bank_receipt_no
		$sFilterList = ew_Concat($sFilterList, $this->merchant_param6->AdvancedSearch->ToJson(), ","); // Field merchant_param6
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
			$UserProfile->SetSearchFilters(CurrentUserName(), "fpg_transactionslistsrch", $filters);

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

		// Field transactionID
		$this->transactionID->AdvancedSearch->SearchValue = @$filter["x_transactionID"];
		$this->transactionID->AdvancedSearch->SearchOperator = @$filter["z_transactionID"];
		$this->transactionID->AdvancedSearch->SearchCondition = @$filter["v_transactionID"];
		$this->transactionID->AdvancedSearch->SearchValue2 = @$filter["y_transactionID"];
		$this->transactionID->AdvancedSearch->SearchOperator2 = @$filter["w_transactionID"];
		$this->transactionID->AdvancedSearch->Save();

		// Field userID
		$this->_userID->AdvancedSearch->SearchValue = @$filter["x__userID"];
		$this->_userID->AdvancedSearch->SearchOperator = @$filter["z__userID"];
		$this->_userID->AdvancedSearch->SearchCondition = @$filter["v__userID"];
		$this->_userID->AdvancedSearch->SearchValue2 = @$filter["y__userID"];
		$this->_userID->AdvancedSearch->SearchOperator2 = @$filter["w__userID"];
		$this->_userID->AdvancedSearch->Save();

		// Field bookingNumber
		$this->bookingNumber->AdvancedSearch->SearchValue = @$filter["x_bookingNumber"];
		$this->bookingNumber->AdvancedSearch->SearchOperator = @$filter["z_bookingNumber"];
		$this->bookingNumber->AdvancedSearch->SearchCondition = @$filter["v_bookingNumber"];
		$this->bookingNumber->AdvancedSearch->SearchValue2 = @$filter["y_bookingNumber"];
		$this->bookingNumber->AdvancedSearch->SearchOperator2 = @$filter["w_bookingNumber"];
		$this->bookingNumber->AdvancedSearch->Save();

		// Field bookingModule
		$this->bookingModule->AdvancedSearch->SearchValue = @$filter["x_bookingModule"];
		$this->bookingModule->AdvancedSearch->SearchOperator = @$filter["z_bookingModule"];
		$this->bookingModule->AdvancedSearch->SearchCondition = @$filter["v_bookingModule"];
		$this->bookingModule->AdvancedSearch->SearchValue2 = @$filter["y_bookingModule"];
		$this->bookingModule->AdvancedSearch->SearchOperator2 = @$filter["w_bookingModule"];
		$this->bookingModule->AdvancedSearch->Save();

		// Field order_id
		$this->order_id->AdvancedSearch->SearchValue = @$filter["x_order_id"];
		$this->order_id->AdvancedSearch->SearchOperator = @$filter["z_order_id"];
		$this->order_id->AdvancedSearch->SearchCondition = @$filter["v_order_id"];
		$this->order_id->AdvancedSearch->SearchValue2 = @$filter["y_order_id"];
		$this->order_id->AdvancedSearch->SearchOperator2 = @$filter["w_order_id"];
		$this->order_id->AdvancedSearch->Save();

		// Field tracking_id
		$this->tracking_id->AdvancedSearch->SearchValue = @$filter["x_tracking_id"];
		$this->tracking_id->AdvancedSearch->SearchOperator = @$filter["z_tracking_id"];
		$this->tracking_id->AdvancedSearch->SearchCondition = @$filter["v_tracking_id"];
		$this->tracking_id->AdvancedSearch->SearchValue2 = @$filter["y_tracking_id"];
		$this->tracking_id->AdvancedSearch->SearchOperator2 = @$filter["w_tracking_id"];
		$this->tracking_id->AdvancedSearch->Save();

		// Field bank_ref_no
		$this->bank_ref_no->AdvancedSearch->SearchValue = @$filter["x_bank_ref_no"];
		$this->bank_ref_no->AdvancedSearch->SearchOperator = @$filter["z_bank_ref_no"];
		$this->bank_ref_no->AdvancedSearch->SearchCondition = @$filter["v_bank_ref_no"];
		$this->bank_ref_no->AdvancedSearch->SearchValue2 = @$filter["y_bank_ref_no"];
		$this->bank_ref_no->AdvancedSearch->SearchOperator2 = @$filter["w_bank_ref_no"];
		$this->bank_ref_no->AdvancedSearch->Save();

		// Field order_status
		$this->order_status->AdvancedSearch->SearchValue = @$filter["x_order_status"];
		$this->order_status->AdvancedSearch->SearchOperator = @$filter["z_order_status"];
		$this->order_status->AdvancedSearch->SearchCondition = @$filter["v_order_status"];
		$this->order_status->AdvancedSearch->SearchValue2 = @$filter["y_order_status"];
		$this->order_status->AdvancedSearch->SearchOperator2 = @$filter["w_order_status"];
		$this->order_status->AdvancedSearch->Save();

		// Field failure_message
		$this->failure_message->AdvancedSearch->SearchValue = @$filter["x_failure_message"];
		$this->failure_message->AdvancedSearch->SearchOperator = @$filter["z_failure_message"];
		$this->failure_message->AdvancedSearch->SearchCondition = @$filter["v_failure_message"];
		$this->failure_message->AdvancedSearch->SearchValue2 = @$filter["y_failure_message"];
		$this->failure_message->AdvancedSearch->SearchOperator2 = @$filter["w_failure_message"];
		$this->failure_message->AdvancedSearch->Save();

		// Field payment_mode
		$this->payment_mode->AdvancedSearch->SearchValue = @$filter["x_payment_mode"];
		$this->payment_mode->AdvancedSearch->SearchOperator = @$filter["z_payment_mode"];
		$this->payment_mode->AdvancedSearch->SearchCondition = @$filter["v_payment_mode"];
		$this->payment_mode->AdvancedSearch->SearchValue2 = @$filter["y_payment_mode"];
		$this->payment_mode->AdvancedSearch->SearchOperator2 = @$filter["w_payment_mode"];
		$this->payment_mode->AdvancedSearch->Save();

		// Field card_name
		$this->card_name->AdvancedSearch->SearchValue = @$filter["x_card_name"];
		$this->card_name->AdvancedSearch->SearchOperator = @$filter["z_card_name"];
		$this->card_name->AdvancedSearch->SearchCondition = @$filter["v_card_name"];
		$this->card_name->AdvancedSearch->SearchValue2 = @$filter["y_card_name"];
		$this->card_name->AdvancedSearch->SearchOperator2 = @$filter["w_card_name"];
		$this->card_name->AdvancedSearch->Save();

		// Field status_code
		$this->status_code->AdvancedSearch->SearchValue = @$filter["x_status_code"];
		$this->status_code->AdvancedSearch->SearchOperator = @$filter["z_status_code"];
		$this->status_code->AdvancedSearch->SearchCondition = @$filter["v_status_code"];
		$this->status_code->AdvancedSearch->SearchValue2 = @$filter["y_status_code"];
		$this->status_code->AdvancedSearch->SearchOperator2 = @$filter["w_status_code"];
		$this->status_code->AdvancedSearch->Save();

		// Field status_message
		$this->status_message->AdvancedSearch->SearchValue = @$filter["x_status_message"];
		$this->status_message->AdvancedSearch->SearchOperator = @$filter["z_status_message"];
		$this->status_message->AdvancedSearch->SearchCondition = @$filter["v_status_message"];
		$this->status_message->AdvancedSearch->SearchValue2 = @$filter["y_status_message"];
		$this->status_message->AdvancedSearch->SearchOperator2 = @$filter["w_status_message"];
		$this->status_message->AdvancedSearch->Save();

		// Field currency
		$this->currency->AdvancedSearch->SearchValue = @$filter["x_currency"];
		$this->currency->AdvancedSearch->SearchOperator = @$filter["z_currency"];
		$this->currency->AdvancedSearch->SearchCondition = @$filter["v_currency"];
		$this->currency->AdvancedSearch->SearchValue2 = @$filter["y_currency"];
		$this->currency->AdvancedSearch->SearchOperator2 = @$filter["w_currency"];
		$this->currency->AdvancedSearch->Save();

		// Field amount
		$this->amount->AdvancedSearch->SearchValue = @$filter["x_amount"];
		$this->amount->AdvancedSearch->SearchOperator = @$filter["z_amount"];
		$this->amount->AdvancedSearch->SearchCondition = @$filter["v_amount"];
		$this->amount->AdvancedSearch->SearchValue2 = @$filter["y_amount"];
		$this->amount->AdvancedSearch->SearchOperator2 = @$filter["w_amount"];
		$this->amount->AdvancedSearch->Save();

		// Field billing_name
		$this->billing_name->AdvancedSearch->SearchValue = @$filter["x_billing_name"];
		$this->billing_name->AdvancedSearch->SearchOperator = @$filter["z_billing_name"];
		$this->billing_name->AdvancedSearch->SearchCondition = @$filter["v_billing_name"];
		$this->billing_name->AdvancedSearch->SearchValue2 = @$filter["y_billing_name"];
		$this->billing_name->AdvancedSearch->SearchOperator2 = @$filter["w_billing_name"];
		$this->billing_name->AdvancedSearch->Save();

		// Field billing_address
		$this->billing_address->AdvancedSearch->SearchValue = @$filter["x_billing_address"];
		$this->billing_address->AdvancedSearch->SearchOperator = @$filter["z_billing_address"];
		$this->billing_address->AdvancedSearch->SearchCondition = @$filter["v_billing_address"];
		$this->billing_address->AdvancedSearch->SearchValue2 = @$filter["y_billing_address"];
		$this->billing_address->AdvancedSearch->SearchOperator2 = @$filter["w_billing_address"];
		$this->billing_address->AdvancedSearch->Save();

		// Field billing_city
		$this->billing_city->AdvancedSearch->SearchValue = @$filter["x_billing_city"];
		$this->billing_city->AdvancedSearch->SearchOperator = @$filter["z_billing_city"];
		$this->billing_city->AdvancedSearch->SearchCondition = @$filter["v_billing_city"];
		$this->billing_city->AdvancedSearch->SearchValue2 = @$filter["y_billing_city"];
		$this->billing_city->AdvancedSearch->SearchOperator2 = @$filter["w_billing_city"];
		$this->billing_city->AdvancedSearch->Save();

		// Field billing_state
		$this->billing_state->AdvancedSearch->SearchValue = @$filter["x_billing_state"];
		$this->billing_state->AdvancedSearch->SearchOperator = @$filter["z_billing_state"];
		$this->billing_state->AdvancedSearch->SearchCondition = @$filter["v_billing_state"];
		$this->billing_state->AdvancedSearch->SearchValue2 = @$filter["y_billing_state"];
		$this->billing_state->AdvancedSearch->SearchOperator2 = @$filter["w_billing_state"];
		$this->billing_state->AdvancedSearch->Save();

		// Field billing_zip
		$this->billing_zip->AdvancedSearch->SearchValue = @$filter["x_billing_zip"];
		$this->billing_zip->AdvancedSearch->SearchOperator = @$filter["z_billing_zip"];
		$this->billing_zip->AdvancedSearch->SearchCondition = @$filter["v_billing_zip"];
		$this->billing_zip->AdvancedSearch->SearchValue2 = @$filter["y_billing_zip"];
		$this->billing_zip->AdvancedSearch->SearchOperator2 = @$filter["w_billing_zip"];
		$this->billing_zip->AdvancedSearch->Save();

		// Field billing_country
		$this->billing_country->AdvancedSearch->SearchValue = @$filter["x_billing_country"];
		$this->billing_country->AdvancedSearch->SearchOperator = @$filter["z_billing_country"];
		$this->billing_country->AdvancedSearch->SearchCondition = @$filter["v_billing_country"];
		$this->billing_country->AdvancedSearch->SearchValue2 = @$filter["y_billing_country"];
		$this->billing_country->AdvancedSearch->SearchOperator2 = @$filter["w_billing_country"];
		$this->billing_country->AdvancedSearch->Save();

		// Field billing_tel
		$this->billing_tel->AdvancedSearch->SearchValue = @$filter["x_billing_tel"];
		$this->billing_tel->AdvancedSearch->SearchOperator = @$filter["z_billing_tel"];
		$this->billing_tel->AdvancedSearch->SearchCondition = @$filter["v_billing_tel"];
		$this->billing_tel->AdvancedSearch->SearchValue2 = @$filter["y_billing_tel"];
		$this->billing_tel->AdvancedSearch->SearchOperator2 = @$filter["w_billing_tel"];
		$this->billing_tel->AdvancedSearch->Save();

		// Field billing_email
		$this->billing_email->AdvancedSearch->SearchValue = @$filter["x_billing_email"];
		$this->billing_email->AdvancedSearch->SearchOperator = @$filter["z_billing_email"];
		$this->billing_email->AdvancedSearch->SearchCondition = @$filter["v_billing_email"];
		$this->billing_email->AdvancedSearch->SearchValue2 = @$filter["y_billing_email"];
		$this->billing_email->AdvancedSearch->SearchOperator2 = @$filter["w_billing_email"];
		$this->billing_email->AdvancedSearch->Save();

		// Field delivery_name
		$this->delivery_name->AdvancedSearch->SearchValue = @$filter["x_delivery_name"];
		$this->delivery_name->AdvancedSearch->SearchOperator = @$filter["z_delivery_name"];
		$this->delivery_name->AdvancedSearch->SearchCondition = @$filter["v_delivery_name"];
		$this->delivery_name->AdvancedSearch->SearchValue2 = @$filter["y_delivery_name"];
		$this->delivery_name->AdvancedSearch->SearchOperator2 = @$filter["w_delivery_name"];
		$this->delivery_name->AdvancedSearch->Save();

		// Field delivery_address
		$this->delivery_address->AdvancedSearch->SearchValue = @$filter["x_delivery_address"];
		$this->delivery_address->AdvancedSearch->SearchOperator = @$filter["z_delivery_address"];
		$this->delivery_address->AdvancedSearch->SearchCondition = @$filter["v_delivery_address"];
		$this->delivery_address->AdvancedSearch->SearchValue2 = @$filter["y_delivery_address"];
		$this->delivery_address->AdvancedSearch->SearchOperator2 = @$filter["w_delivery_address"];
		$this->delivery_address->AdvancedSearch->Save();

		// Field delivery_city
		$this->delivery_city->AdvancedSearch->SearchValue = @$filter["x_delivery_city"];
		$this->delivery_city->AdvancedSearch->SearchOperator = @$filter["z_delivery_city"];
		$this->delivery_city->AdvancedSearch->SearchCondition = @$filter["v_delivery_city"];
		$this->delivery_city->AdvancedSearch->SearchValue2 = @$filter["y_delivery_city"];
		$this->delivery_city->AdvancedSearch->SearchOperator2 = @$filter["w_delivery_city"];
		$this->delivery_city->AdvancedSearch->Save();

		// Field delivery_state
		$this->delivery_state->AdvancedSearch->SearchValue = @$filter["x_delivery_state"];
		$this->delivery_state->AdvancedSearch->SearchOperator = @$filter["z_delivery_state"];
		$this->delivery_state->AdvancedSearch->SearchCondition = @$filter["v_delivery_state"];
		$this->delivery_state->AdvancedSearch->SearchValue2 = @$filter["y_delivery_state"];
		$this->delivery_state->AdvancedSearch->SearchOperator2 = @$filter["w_delivery_state"];
		$this->delivery_state->AdvancedSearch->Save();

		// Field delivery_zip
		$this->delivery_zip->AdvancedSearch->SearchValue = @$filter["x_delivery_zip"];
		$this->delivery_zip->AdvancedSearch->SearchOperator = @$filter["z_delivery_zip"];
		$this->delivery_zip->AdvancedSearch->SearchCondition = @$filter["v_delivery_zip"];
		$this->delivery_zip->AdvancedSearch->SearchValue2 = @$filter["y_delivery_zip"];
		$this->delivery_zip->AdvancedSearch->SearchOperator2 = @$filter["w_delivery_zip"];
		$this->delivery_zip->AdvancedSearch->Save();

		// Field delivery_country
		$this->delivery_country->AdvancedSearch->SearchValue = @$filter["x_delivery_country"];
		$this->delivery_country->AdvancedSearch->SearchOperator = @$filter["z_delivery_country"];
		$this->delivery_country->AdvancedSearch->SearchCondition = @$filter["v_delivery_country"];
		$this->delivery_country->AdvancedSearch->SearchValue2 = @$filter["y_delivery_country"];
		$this->delivery_country->AdvancedSearch->SearchOperator2 = @$filter["w_delivery_country"];
		$this->delivery_country->AdvancedSearch->Save();

		// Field delivery_tel
		$this->delivery_tel->AdvancedSearch->SearchValue = @$filter["x_delivery_tel"];
		$this->delivery_tel->AdvancedSearch->SearchOperator = @$filter["z_delivery_tel"];
		$this->delivery_tel->AdvancedSearch->SearchCondition = @$filter["v_delivery_tel"];
		$this->delivery_tel->AdvancedSearch->SearchValue2 = @$filter["y_delivery_tel"];
		$this->delivery_tel->AdvancedSearch->SearchOperator2 = @$filter["w_delivery_tel"];
		$this->delivery_tel->AdvancedSearch->Save();

		// Field merchant_param1
		$this->merchant_param1->AdvancedSearch->SearchValue = @$filter["x_merchant_param1"];
		$this->merchant_param1->AdvancedSearch->SearchOperator = @$filter["z_merchant_param1"];
		$this->merchant_param1->AdvancedSearch->SearchCondition = @$filter["v_merchant_param1"];
		$this->merchant_param1->AdvancedSearch->SearchValue2 = @$filter["y_merchant_param1"];
		$this->merchant_param1->AdvancedSearch->SearchOperator2 = @$filter["w_merchant_param1"];
		$this->merchant_param1->AdvancedSearch->Save();

		// Field merchant_param2
		$this->merchant_param2->AdvancedSearch->SearchValue = @$filter["x_merchant_param2"];
		$this->merchant_param2->AdvancedSearch->SearchOperator = @$filter["z_merchant_param2"];
		$this->merchant_param2->AdvancedSearch->SearchCondition = @$filter["v_merchant_param2"];
		$this->merchant_param2->AdvancedSearch->SearchValue2 = @$filter["y_merchant_param2"];
		$this->merchant_param2->AdvancedSearch->SearchOperator2 = @$filter["w_merchant_param2"];
		$this->merchant_param2->AdvancedSearch->Save();

		// Field merchant_param3
		$this->merchant_param3->AdvancedSearch->SearchValue = @$filter["x_merchant_param3"];
		$this->merchant_param3->AdvancedSearch->SearchOperator = @$filter["z_merchant_param3"];
		$this->merchant_param3->AdvancedSearch->SearchCondition = @$filter["v_merchant_param3"];
		$this->merchant_param3->AdvancedSearch->SearchValue2 = @$filter["y_merchant_param3"];
		$this->merchant_param3->AdvancedSearch->SearchOperator2 = @$filter["w_merchant_param3"];
		$this->merchant_param3->AdvancedSearch->Save();

		// Field merchant_param4
		$this->merchant_param4->AdvancedSearch->SearchValue = @$filter["x_merchant_param4"];
		$this->merchant_param4->AdvancedSearch->SearchOperator = @$filter["z_merchant_param4"];
		$this->merchant_param4->AdvancedSearch->SearchCondition = @$filter["v_merchant_param4"];
		$this->merchant_param4->AdvancedSearch->SearchValue2 = @$filter["y_merchant_param4"];
		$this->merchant_param4->AdvancedSearch->SearchOperator2 = @$filter["w_merchant_param4"];
		$this->merchant_param4->AdvancedSearch->Save();

		// Field merchant_param5
		$this->merchant_param5->AdvancedSearch->SearchValue = @$filter["x_merchant_param5"];
		$this->merchant_param5->AdvancedSearch->SearchOperator = @$filter["z_merchant_param5"];
		$this->merchant_param5->AdvancedSearch->SearchCondition = @$filter["v_merchant_param5"];
		$this->merchant_param5->AdvancedSearch->SearchValue2 = @$filter["y_merchant_param5"];
		$this->merchant_param5->AdvancedSearch->SearchOperator2 = @$filter["w_merchant_param5"];
		$this->merchant_param5->AdvancedSearch->Save();

		// Field vault
		$this->vault->AdvancedSearch->SearchValue = @$filter["x_vault"];
		$this->vault->AdvancedSearch->SearchOperator = @$filter["z_vault"];
		$this->vault->AdvancedSearch->SearchCondition = @$filter["v_vault"];
		$this->vault->AdvancedSearch->SearchValue2 = @$filter["y_vault"];
		$this->vault->AdvancedSearch->SearchOperator2 = @$filter["w_vault"];
		$this->vault->AdvancedSearch->Save();

		// Field offer_type
		$this->offer_type->AdvancedSearch->SearchValue = @$filter["x_offer_type"];
		$this->offer_type->AdvancedSearch->SearchOperator = @$filter["z_offer_type"];
		$this->offer_type->AdvancedSearch->SearchCondition = @$filter["v_offer_type"];
		$this->offer_type->AdvancedSearch->SearchValue2 = @$filter["y_offer_type"];
		$this->offer_type->AdvancedSearch->SearchOperator2 = @$filter["w_offer_type"];
		$this->offer_type->AdvancedSearch->Save();

		// Field offer_code
		$this->offer_code->AdvancedSearch->SearchValue = @$filter["x_offer_code"];
		$this->offer_code->AdvancedSearch->SearchOperator = @$filter["z_offer_code"];
		$this->offer_code->AdvancedSearch->SearchCondition = @$filter["v_offer_code"];
		$this->offer_code->AdvancedSearch->SearchValue2 = @$filter["y_offer_code"];
		$this->offer_code->AdvancedSearch->SearchOperator2 = @$filter["w_offer_code"];
		$this->offer_code->AdvancedSearch->Save();

		// Field discount_value
		$this->discount_value->AdvancedSearch->SearchValue = @$filter["x_discount_value"];
		$this->discount_value->AdvancedSearch->SearchOperator = @$filter["z_discount_value"];
		$this->discount_value->AdvancedSearch->SearchCondition = @$filter["v_discount_value"];
		$this->discount_value->AdvancedSearch->SearchValue2 = @$filter["y_discount_value"];
		$this->discount_value->AdvancedSearch->SearchOperator2 = @$filter["w_discount_value"];
		$this->discount_value->AdvancedSearch->Save();

		// Field mer_amount
		$this->mer_amount->AdvancedSearch->SearchValue = @$filter["x_mer_amount"];
		$this->mer_amount->AdvancedSearch->SearchOperator = @$filter["z_mer_amount"];
		$this->mer_amount->AdvancedSearch->SearchCondition = @$filter["v_mer_amount"];
		$this->mer_amount->AdvancedSearch->SearchValue2 = @$filter["y_mer_amount"];
		$this->mer_amount->AdvancedSearch->SearchOperator2 = @$filter["w_mer_amount"];
		$this->mer_amount->AdvancedSearch->Save();

		// Field eci_value
		$this->eci_value->AdvancedSearch->SearchValue = @$filter["x_eci_value"];
		$this->eci_value->AdvancedSearch->SearchOperator = @$filter["z_eci_value"];
		$this->eci_value->AdvancedSearch->SearchCondition = @$filter["v_eci_value"];
		$this->eci_value->AdvancedSearch->SearchValue2 = @$filter["y_eci_value"];
		$this->eci_value->AdvancedSearch->SearchOperator2 = @$filter["w_eci_value"];
		$this->eci_value->AdvancedSearch->Save();

		// Field card_holder_name
		$this->card_holder_name->AdvancedSearch->SearchValue = @$filter["x_card_holder_name"];
		$this->card_holder_name->AdvancedSearch->SearchOperator = @$filter["z_card_holder_name"];
		$this->card_holder_name->AdvancedSearch->SearchCondition = @$filter["v_card_holder_name"];
		$this->card_holder_name->AdvancedSearch->SearchValue2 = @$filter["y_card_holder_name"];
		$this->card_holder_name->AdvancedSearch->SearchOperator2 = @$filter["w_card_holder_name"];
		$this->card_holder_name->AdvancedSearch->Save();

		// Field bank_qsi_no
		$this->bank_qsi_no->AdvancedSearch->SearchValue = @$filter["x_bank_qsi_no"];
		$this->bank_qsi_no->AdvancedSearch->SearchOperator = @$filter["z_bank_qsi_no"];
		$this->bank_qsi_no->AdvancedSearch->SearchCondition = @$filter["v_bank_qsi_no"];
		$this->bank_qsi_no->AdvancedSearch->SearchValue2 = @$filter["y_bank_qsi_no"];
		$this->bank_qsi_no->AdvancedSearch->SearchOperator2 = @$filter["w_bank_qsi_no"];
		$this->bank_qsi_no->AdvancedSearch->Save();

		// Field bank_receipt_no
		$this->bank_receipt_no->AdvancedSearch->SearchValue = @$filter["x_bank_receipt_no"];
		$this->bank_receipt_no->AdvancedSearch->SearchOperator = @$filter["z_bank_receipt_no"];
		$this->bank_receipt_no->AdvancedSearch->SearchCondition = @$filter["v_bank_receipt_no"];
		$this->bank_receipt_no->AdvancedSearch->SearchValue2 = @$filter["y_bank_receipt_no"];
		$this->bank_receipt_no->AdvancedSearch->SearchOperator2 = @$filter["w_bank_receipt_no"];
		$this->bank_receipt_no->AdvancedSearch->Save();

		// Field merchant_param6
		$this->merchant_param6->AdvancedSearch->SearchValue = @$filter["x_merchant_param6"];
		$this->merchant_param6->AdvancedSearch->SearchOperator = @$filter["z_merchant_param6"];
		$this->merchant_param6->AdvancedSearch->SearchCondition = @$filter["v_merchant_param6"];
		$this->merchant_param6->AdvancedSearch->SearchValue2 = @$filter["y_merchant_param6"];
		$this->merchant_param6->AdvancedSearch->SearchOperator2 = @$filter["w_merchant_param6"];
		$this->merchant_param6->AdvancedSearch->Save();
		$this->BasicSearch->setKeyword(@$filter[EW_TABLE_BASIC_SEARCH]);
		$this->BasicSearch->setType(@$filter[EW_TABLE_BASIC_SEARCH_TYPE]);
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere($Default = FALSE) {
		global $Security;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $this->transactionID, $Default, FALSE); // transactionID
		$this->BuildSearchSql($sWhere, $this->_userID, $Default, FALSE); // userID
		$this->BuildSearchSql($sWhere, $this->bookingNumber, $Default, FALSE); // bookingNumber
		$this->BuildSearchSql($sWhere, $this->bookingModule, $Default, FALSE); // bookingModule
		$this->BuildSearchSql($sWhere, $this->order_id, $Default, FALSE); // order_id
		$this->BuildSearchSql($sWhere, $this->tracking_id, $Default, FALSE); // tracking_id
		$this->BuildSearchSql($sWhere, $this->bank_ref_no, $Default, FALSE); // bank_ref_no
		$this->BuildSearchSql($sWhere, $this->order_status, $Default, FALSE); // order_status
		$this->BuildSearchSql($sWhere, $this->failure_message, $Default, FALSE); // failure_message
		$this->BuildSearchSql($sWhere, $this->payment_mode, $Default, FALSE); // payment_mode
		$this->BuildSearchSql($sWhere, $this->card_name, $Default, FALSE); // card_name
		$this->BuildSearchSql($sWhere, $this->status_code, $Default, FALSE); // status_code
		$this->BuildSearchSql($sWhere, $this->status_message, $Default, FALSE); // status_message
		$this->BuildSearchSql($sWhere, $this->currency, $Default, FALSE); // currency
		$this->BuildSearchSql($sWhere, $this->amount, $Default, FALSE); // amount
		$this->BuildSearchSql($sWhere, $this->billing_name, $Default, FALSE); // billing_name
		$this->BuildSearchSql($sWhere, $this->billing_address, $Default, FALSE); // billing_address
		$this->BuildSearchSql($sWhere, $this->billing_city, $Default, FALSE); // billing_city
		$this->BuildSearchSql($sWhere, $this->billing_state, $Default, FALSE); // billing_state
		$this->BuildSearchSql($sWhere, $this->billing_zip, $Default, FALSE); // billing_zip
		$this->BuildSearchSql($sWhere, $this->billing_country, $Default, FALSE); // billing_country
		$this->BuildSearchSql($sWhere, $this->billing_tel, $Default, FALSE); // billing_tel
		$this->BuildSearchSql($sWhere, $this->billing_email, $Default, FALSE); // billing_email
		$this->BuildSearchSql($sWhere, $this->delivery_name, $Default, FALSE); // delivery_name
		$this->BuildSearchSql($sWhere, $this->delivery_address, $Default, FALSE); // delivery_address
		$this->BuildSearchSql($sWhere, $this->delivery_city, $Default, FALSE); // delivery_city
		$this->BuildSearchSql($sWhere, $this->delivery_state, $Default, FALSE); // delivery_state
		$this->BuildSearchSql($sWhere, $this->delivery_zip, $Default, FALSE); // delivery_zip
		$this->BuildSearchSql($sWhere, $this->delivery_country, $Default, FALSE); // delivery_country
		$this->BuildSearchSql($sWhere, $this->delivery_tel, $Default, FALSE); // delivery_tel
		$this->BuildSearchSql($sWhere, $this->merchant_param1, $Default, FALSE); // merchant_param1
		$this->BuildSearchSql($sWhere, $this->merchant_param2, $Default, FALSE); // merchant_param2
		$this->BuildSearchSql($sWhere, $this->merchant_param3, $Default, FALSE); // merchant_param3
		$this->BuildSearchSql($sWhere, $this->merchant_param4, $Default, FALSE); // merchant_param4
		$this->BuildSearchSql($sWhere, $this->merchant_param5, $Default, FALSE); // merchant_param5
		$this->BuildSearchSql($sWhere, $this->vault, $Default, FALSE); // vault
		$this->BuildSearchSql($sWhere, $this->offer_type, $Default, FALSE); // offer_type
		$this->BuildSearchSql($sWhere, $this->offer_code, $Default, FALSE); // offer_code
		$this->BuildSearchSql($sWhere, $this->discount_value, $Default, FALSE); // discount_value
		$this->BuildSearchSql($sWhere, $this->mer_amount, $Default, FALSE); // mer_amount
		$this->BuildSearchSql($sWhere, $this->eci_value, $Default, FALSE); // eci_value
		$this->BuildSearchSql($sWhere, $this->card_holder_name, $Default, FALSE); // card_holder_name
		$this->BuildSearchSql($sWhere, $this->bank_qsi_no, $Default, FALSE); // bank_qsi_no
		$this->BuildSearchSql($sWhere, $this->bank_receipt_no, $Default, FALSE); // bank_receipt_no
		$this->BuildSearchSql($sWhere, $this->merchant_param6, $Default, FALSE); // merchant_param6

		// Set up search parm
		if (!$Default && $sWhere <> "" && in_array($this->Command, array("", "reset", "resetall"))) {
			$this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->transactionID->AdvancedSearch->Save(); // transactionID
			$this->_userID->AdvancedSearch->Save(); // userID
			$this->bookingNumber->AdvancedSearch->Save(); // bookingNumber
			$this->bookingModule->AdvancedSearch->Save(); // bookingModule
			$this->order_id->AdvancedSearch->Save(); // order_id
			$this->tracking_id->AdvancedSearch->Save(); // tracking_id
			$this->bank_ref_no->AdvancedSearch->Save(); // bank_ref_no
			$this->order_status->AdvancedSearch->Save(); // order_status
			$this->failure_message->AdvancedSearch->Save(); // failure_message
			$this->payment_mode->AdvancedSearch->Save(); // payment_mode
			$this->card_name->AdvancedSearch->Save(); // card_name
			$this->status_code->AdvancedSearch->Save(); // status_code
			$this->status_message->AdvancedSearch->Save(); // status_message
			$this->currency->AdvancedSearch->Save(); // currency
			$this->amount->AdvancedSearch->Save(); // amount
			$this->billing_name->AdvancedSearch->Save(); // billing_name
			$this->billing_address->AdvancedSearch->Save(); // billing_address
			$this->billing_city->AdvancedSearch->Save(); // billing_city
			$this->billing_state->AdvancedSearch->Save(); // billing_state
			$this->billing_zip->AdvancedSearch->Save(); // billing_zip
			$this->billing_country->AdvancedSearch->Save(); // billing_country
			$this->billing_tel->AdvancedSearch->Save(); // billing_tel
			$this->billing_email->AdvancedSearch->Save(); // billing_email
			$this->delivery_name->AdvancedSearch->Save(); // delivery_name
			$this->delivery_address->AdvancedSearch->Save(); // delivery_address
			$this->delivery_city->AdvancedSearch->Save(); // delivery_city
			$this->delivery_state->AdvancedSearch->Save(); // delivery_state
			$this->delivery_zip->AdvancedSearch->Save(); // delivery_zip
			$this->delivery_country->AdvancedSearch->Save(); // delivery_country
			$this->delivery_tel->AdvancedSearch->Save(); // delivery_tel
			$this->merchant_param1->AdvancedSearch->Save(); // merchant_param1
			$this->merchant_param2->AdvancedSearch->Save(); // merchant_param2
			$this->merchant_param3->AdvancedSearch->Save(); // merchant_param3
			$this->merchant_param4->AdvancedSearch->Save(); // merchant_param4
			$this->merchant_param5->AdvancedSearch->Save(); // merchant_param5
			$this->vault->AdvancedSearch->Save(); // vault
			$this->offer_type->AdvancedSearch->Save(); // offer_type
			$this->offer_code->AdvancedSearch->Save(); // offer_code
			$this->discount_value->AdvancedSearch->Save(); // discount_value
			$this->mer_amount->AdvancedSearch->Save(); // mer_amount
			$this->eci_value->AdvancedSearch->Save(); // eci_value
			$this->card_holder_name->AdvancedSearch->Save(); // card_holder_name
			$this->bank_qsi_no->AdvancedSearch->Save(); // bank_qsi_no
			$this->bank_receipt_no->AdvancedSearch->Save(); // bank_receipt_no
			$this->merchant_param6->AdvancedSearch->Save(); // merchant_param6
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
		$this->BuildBasicSearchSQL($sWhere, $this->bookingNumber, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->order_id, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->tracking_id, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->bank_ref_no, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->order_status, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->failure_message, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->payment_mode, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->card_name, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->status_code, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->status_message, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->currency, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->amount, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->billing_name, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->billing_address, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->billing_city, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->billing_state, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->billing_zip, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->billing_country, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->billing_tel, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->billing_email, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->delivery_name, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->delivery_address, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->delivery_city, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->delivery_state, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->delivery_zip, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->delivery_country, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->delivery_tel, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->merchant_param1, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->merchant_param2, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->merchant_param3, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->merchant_param4, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->merchant_param5, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->vault, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->offer_type, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->offer_code, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->discount_value, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->mer_amount, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->eci_value, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->card_holder_name, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->bank_qsi_no, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->bank_receipt_no, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->merchant_param6, $arKeywords, $type);
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
		if ($this->transactionID->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->_userID->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->bookingNumber->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->bookingModule->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->order_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->tracking_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->bank_ref_no->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->order_status->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->failure_message->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->payment_mode->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->card_name->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->status_code->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->status_message->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->currency->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->amount->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->billing_name->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->billing_address->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->billing_city->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->billing_state->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->billing_zip->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->billing_country->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->billing_tel->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->billing_email->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->delivery_name->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->delivery_address->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->delivery_city->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->delivery_state->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->delivery_zip->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->delivery_country->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->delivery_tel->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->merchant_param1->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->merchant_param2->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->merchant_param3->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->merchant_param4->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->merchant_param5->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->vault->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->offer_type->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->offer_code->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->discount_value->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->mer_amount->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->eci_value->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->card_holder_name->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->bank_qsi_no->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->bank_receipt_no->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->merchant_param6->AdvancedSearch->IssetSession())
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
		$this->transactionID->AdvancedSearch->UnsetSession();
		$this->_userID->AdvancedSearch->UnsetSession();
		$this->bookingNumber->AdvancedSearch->UnsetSession();
		$this->bookingModule->AdvancedSearch->UnsetSession();
		$this->order_id->AdvancedSearch->UnsetSession();
		$this->tracking_id->AdvancedSearch->UnsetSession();
		$this->bank_ref_no->AdvancedSearch->UnsetSession();
		$this->order_status->AdvancedSearch->UnsetSession();
		$this->failure_message->AdvancedSearch->UnsetSession();
		$this->payment_mode->AdvancedSearch->UnsetSession();
		$this->card_name->AdvancedSearch->UnsetSession();
		$this->status_code->AdvancedSearch->UnsetSession();
		$this->status_message->AdvancedSearch->UnsetSession();
		$this->currency->AdvancedSearch->UnsetSession();
		$this->amount->AdvancedSearch->UnsetSession();
		$this->billing_name->AdvancedSearch->UnsetSession();
		$this->billing_address->AdvancedSearch->UnsetSession();
		$this->billing_city->AdvancedSearch->UnsetSession();
		$this->billing_state->AdvancedSearch->UnsetSession();
		$this->billing_zip->AdvancedSearch->UnsetSession();
		$this->billing_country->AdvancedSearch->UnsetSession();
		$this->billing_tel->AdvancedSearch->UnsetSession();
		$this->billing_email->AdvancedSearch->UnsetSession();
		$this->delivery_name->AdvancedSearch->UnsetSession();
		$this->delivery_address->AdvancedSearch->UnsetSession();
		$this->delivery_city->AdvancedSearch->UnsetSession();
		$this->delivery_state->AdvancedSearch->UnsetSession();
		$this->delivery_zip->AdvancedSearch->UnsetSession();
		$this->delivery_country->AdvancedSearch->UnsetSession();
		$this->delivery_tel->AdvancedSearch->UnsetSession();
		$this->merchant_param1->AdvancedSearch->UnsetSession();
		$this->merchant_param2->AdvancedSearch->UnsetSession();
		$this->merchant_param3->AdvancedSearch->UnsetSession();
		$this->merchant_param4->AdvancedSearch->UnsetSession();
		$this->merchant_param5->AdvancedSearch->UnsetSession();
		$this->vault->AdvancedSearch->UnsetSession();
		$this->offer_type->AdvancedSearch->UnsetSession();
		$this->offer_code->AdvancedSearch->UnsetSession();
		$this->discount_value->AdvancedSearch->UnsetSession();
		$this->mer_amount->AdvancedSearch->UnsetSession();
		$this->eci_value->AdvancedSearch->UnsetSession();
		$this->card_holder_name->AdvancedSearch->UnsetSession();
		$this->bank_qsi_no->AdvancedSearch->UnsetSession();
		$this->bank_receipt_no->AdvancedSearch->UnsetSession();
		$this->merchant_param6->AdvancedSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->Load();

		// Restore advanced search values
		$this->transactionID->AdvancedSearch->Load();
		$this->_userID->AdvancedSearch->Load();
		$this->bookingNumber->AdvancedSearch->Load();
		$this->bookingModule->AdvancedSearch->Load();
		$this->order_id->AdvancedSearch->Load();
		$this->tracking_id->AdvancedSearch->Load();
		$this->bank_ref_no->AdvancedSearch->Load();
		$this->order_status->AdvancedSearch->Load();
		$this->failure_message->AdvancedSearch->Load();
		$this->payment_mode->AdvancedSearch->Load();
		$this->card_name->AdvancedSearch->Load();
		$this->status_code->AdvancedSearch->Load();
		$this->status_message->AdvancedSearch->Load();
		$this->currency->AdvancedSearch->Load();
		$this->amount->AdvancedSearch->Load();
		$this->billing_name->AdvancedSearch->Load();
		$this->billing_address->AdvancedSearch->Load();
		$this->billing_city->AdvancedSearch->Load();
		$this->billing_state->AdvancedSearch->Load();
		$this->billing_zip->AdvancedSearch->Load();
		$this->billing_country->AdvancedSearch->Load();
		$this->billing_tel->AdvancedSearch->Load();
		$this->billing_email->AdvancedSearch->Load();
		$this->delivery_name->AdvancedSearch->Load();
		$this->delivery_address->AdvancedSearch->Load();
		$this->delivery_city->AdvancedSearch->Load();
		$this->delivery_state->AdvancedSearch->Load();
		$this->delivery_zip->AdvancedSearch->Load();
		$this->delivery_country->AdvancedSearch->Load();
		$this->delivery_tel->AdvancedSearch->Load();
		$this->merchant_param1->AdvancedSearch->Load();
		$this->merchant_param2->AdvancedSearch->Load();
		$this->merchant_param3->AdvancedSearch->Load();
		$this->merchant_param4->AdvancedSearch->Load();
		$this->merchant_param5->AdvancedSearch->Load();
		$this->vault->AdvancedSearch->Load();
		$this->offer_type->AdvancedSearch->Load();
		$this->offer_code->AdvancedSearch->Load();
		$this->discount_value->AdvancedSearch->Load();
		$this->mer_amount->AdvancedSearch->Load();
		$this->eci_value->AdvancedSearch->Load();
		$this->card_holder_name->AdvancedSearch->Load();
		$this->bank_qsi_no->AdvancedSearch->Load();
		$this->bank_receipt_no->AdvancedSearch->Load();
		$this->merchant_param6->AdvancedSearch->Load();
	}

	// Set up sort parameters
	function SetupSortOrder() {

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = @$_GET["order"];
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->transactionID); // transactionID
			$this->UpdateSort($this->_userID); // userID
			$this->UpdateSort($this->bookingNumber); // bookingNumber
			$this->UpdateSort($this->bookingModule); // bookingModule
			$this->UpdateSort($this->order_id); // order_id
			$this->UpdateSort($this->order_status); // order_status
			$this->UpdateSort($this->payment_mode); // payment_mode
			$this->UpdateSort($this->amount); // amount
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
				$this->transactionID->setSort("");
				$this->_userID->setSort("");
				$this->bookingNumber->setSort("");
				$this->bookingModule->setSort("");
				$this->order_id->setSort("");
				$this->order_status->setSort("");
				$this->payment_mode->setSort("");
				$this->amount->setSort("");
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
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ewMultiSelect\" value=\"" . ew_HtmlEncode($this->transactionID->CurrentValue) . "\" onclick=\"ew_ClickMultiCheckbox(event);\">";
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fpg_transactionslistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fpg_transactionslistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.fpg_transactionslist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fpg_transactionslistsrch\">" . $Language->Phrase("SearchLink") . "</button>";
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
		// transactionID

		$this->transactionID->AdvancedSearch->SearchValue = @$_GET["x_transactionID"];
		if ($this->transactionID->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->transactionID->AdvancedSearch->SearchOperator = @$_GET["z_transactionID"];

		// userID
		$this->_userID->AdvancedSearch->SearchValue = @$_GET["x__userID"];
		if ($this->_userID->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->_userID->AdvancedSearch->SearchOperator = @$_GET["z__userID"];

		// bookingNumber
		$this->bookingNumber->AdvancedSearch->SearchValue = @$_GET["x_bookingNumber"];
		if ($this->bookingNumber->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->bookingNumber->AdvancedSearch->SearchOperator = @$_GET["z_bookingNumber"];

		// bookingModule
		$this->bookingModule->AdvancedSearch->SearchValue = @$_GET["x_bookingModule"];
		if ($this->bookingModule->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->bookingModule->AdvancedSearch->SearchOperator = @$_GET["z_bookingModule"];

		// order_id
		$this->order_id->AdvancedSearch->SearchValue = @$_GET["x_order_id"];
		if ($this->order_id->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->order_id->AdvancedSearch->SearchOperator = @$_GET["z_order_id"];

		// tracking_id
		$this->tracking_id->AdvancedSearch->SearchValue = @$_GET["x_tracking_id"];
		if ($this->tracking_id->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->tracking_id->AdvancedSearch->SearchOperator = @$_GET["z_tracking_id"];

		// bank_ref_no
		$this->bank_ref_no->AdvancedSearch->SearchValue = @$_GET["x_bank_ref_no"];
		if ($this->bank_ref_no->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->bank_ref_no->AdvancedSearch->SearchOperator = @$_GET["z_bank_ref_no"];

		// order_status
		$this->order_status->AdvancedSearch->SearchValue = @$_GET["x_order_status"];
		if ($this->order_status->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->order_status->AdvancedSearch->SearchOperator = @$_GET["z_order_status"];

		// failure_message
		$this->failure_message->AdvancedSearch->SearchValue = @$_GET["x_failure_message"];
		if ($this->failure_message->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->failure_message->AdvancedSearch->SearchOperator = @$_GET["z_failure_message"];

		// payment_mode
		$this->payment_mode->AdvancedSearch->SearchValue = @$_GET["x_payment_mode"];
		if ($this->payment_mode->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->payment_mode->AdvancedSearch->SearchOperator = @$_GET["z_payment_mode"];

		// card_name
		$this->card_name->AdvancedSearch->SearchValue = @$_GET["x_card_name"];
		if ($this->card_name->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->card_name->AdvancedSearch->SearchOperator = @$_GET["z_card_name"];

		// status_code
		$this->status_code->AdvancedSearch->SearchValue = @$_GET["x_status_code"];
		if ($this->status_code->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->status_code->AdvancedSearch->SearchOperator = @$_GET["z_status_code"];

		// status_message
		$this->status_message->AdvancedSearch->SearchValue = @$_GET["x_status_message"];
		if ($this->status_message->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->status_message->AdvancedSearch->SearchOperator = @$_GET["z_status_message"];

		// currency
		$this->currency->AdvancedSearch->SearchValue = @$_GET["x_currency"];
		if ($this->currency->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->currency->AdvancedSearch->SearchOperator = @$_GET["z_currency"];

		// amount
		$this->amount->AdvancedSearch->SearchValue = @$_GET["x_amount"];
		if ($this->amount->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->amount->AdvancedSearch->SearchOperator = @$_GET["z_amount"];

		// billing_name
		$this->billing_name->AdvancedSearch->SearchValue = @$_GET["x_billing_name"];
		if ($this->billing_name->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->billing_name->AdvancedSearch->SearchOperator = @$_GET["z_billing_name"];

		// billing_address
		$this->billing_address->AdvancedSearch->SearchValue = @$_GET["x_billing_address"];
		if ($this->billing_address->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->billing_address->AdvancedSearch->SearchOperator = @$_GET["z_billing_address"];

		// billing_city
		$this->billing_city->AdvancedSearch->SearchValue = @$_GET["x_billing_city"];
		if ($this->billing_city->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->billing_city->AdvancedSearch->SearchOperator = @$_GET["z_billing_city"];

		// billing_state
		$this->billing_state->AdvancedSearch->SearchValue = @$_GET["x_billing_state"];
		if ($this->billing_state->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->billing_state->AdvancedSearch->SearchOperator = @$_GET["z_billing_state"];

		// billing_zip
		$this->billing_zip->AdvancedSearch->SearchValue = @$_GET["x_billing_zip"];
		if ($this->billing_zip->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->billing_zip->AdvancedSearch->SearchOperator = @$_GET["z_billing_zip"];

		// billing_country
		$this->billing_country->AdvancedSearch->SearchValue = @$_GET["x_billing_country"];
		if ($this->billing_country->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->billing_country->AdvancedSearch->SearchOperator = @$_GET["z_billing_country"];

		// billing_tel
		$this->billing_tel->AdvancedSearch->SearchValue = @$_GET["x_billing_tel"];
		if ($this->billing_tel->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->billing_tel->AdvancedSearch->SearchOperator = @$_GET["z_billing_tel"];

		// billing_email
		$this->billing_email->AdvancedSearch->SearchValue = @$_GET["x_billing_email"];
		if ($this->billing_email->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->billing_email->AdvancedSearch->SearchOperator = @$_GET["z_billing_email"];

		// delivery_name
		$this->delivery_name->AdvancedSearch->SearchValue = @$_GET["x_delivery_name"];
		if ($this->delivery_name->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->delivery_name->AdvancedSearch->SearchOperator = @$_GET["z_delivery_name"];

		// delivery_address
		$this->delivery_address->AdvancedSearch->SearchValue = @$_GET["x_delivery_address"];
		if ($this->delivery_address->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->delivery_address->AdvancedSearch->SearchOperator = @$_GET["z_delivery_address"];

		// delivery_city
		$this->delivery_city->AdvancedSearch->SearchValue = @$_GET["x_delivery_city"];
		if ($this->delivery_city->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->delivery_city->AdvancedSearch->SearchOperator = @$_GET["z_delivery_city"];

		// delivery_state
		$this->delivery_state->AdvancedSearch->SearchValue = @$_GET["x_delivery_state"];
		if ($this->delivery_state->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->delivery_state->AdvancedSearch->SearchOperator = @$_GET["z_delivery_state"];

		// delivery_zip
		$this->delivery_zip->AdvancedSearch->SearchValue = @$_GET["x_delivery_zip"];
		if ($this->delivery_zip->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->delivery_zip->AdvancedSearch->SearchOperator = @$_GET["z_delivery_zip"];

		// delivery_country
		$this->delivery_country->AdvancedSearch->SearchValue = @$_GET["x_delivery_country"];
		if ($this->delivery_country->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->delivery_country->AdvancedSearch->SearchOperator = @$_GET["z_delivery_country"];

		// delivery_tel
		$this->delivery_tel->AdvancedSearch->SearchValue = @$_GET["x_delivery_tel"];
		if ($this->delivery_tel->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->delivery_tel->AdvancedSearch->SearchOperator = @$_GET["z_delivery_tel"];

		// merchant_param1
		$this->merchant_param1->AdvancedSearch->SearchValue = @$_GET["x_merchant_param1"];
		if ($this->merchant_param1->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->merchant_param1->AdvancedSearch->SearchOperator = @$_GET["z_merchant_param1"];

		// merchant_param2
		$this->merchant_param2->AdvancedSearch->SearchValue = @$_GET["x_merchant_param2"];
		if ($this->merchant_param2->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->merchant_param2->AdvancedSearch->SearchOperator = @$_GET["z_merchant_param2"];

		// merchant_param3
		$this->merchant_param3->AdvancedSearch->SearchValue = @$_GET["x_merchant_param3"];
		if ($this->merchant_param3->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->merchant_param3->AdvancedSearch->SearchOperator = @$_GET["z_merchant_param3"];

		// merchant_param4
		$this->merchant_param4->AdvancedSearch->SearchValue = @$_GET["x_merchant_param4"];
		if ($this->merchant_param4->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->merchant_param4->AdvancedSearch->SearchOperator = @$_GET["z_merchant_param4"];

		// merchant_param5
		$this->merchant_param5->AdvancedSearch->SearchValue = @$_GET["x_merchant_param5"];
		if ($this->merchant_param5->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->merchant_param5->AdvancedSearch->SearchOperator = @$_GET["z_merchant_param5"];

		// vault
		$this->vault->AdvancedSearch->SearchValue = @$_GET["x_vault"];
		if ($this->vault->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->vault->AdvancedSearch->SearchOperator = @$_GET["z_vault"];

		// offer_type
		$this->offer_type->AdvancedSearch->SearchValue = @$_GET["x_offer_type"];
		if ($this->offer_type->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->offer_type->AdvancedSearch->SearchOperator = @$_GET["z_offer_type"];

		// offer_code
		$this->offer_code->AdvancedSearch->SearchValue = @$_GET["x_offer_code"];
		if ($this->offer_code->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->offer_code->AdvancedSearch->SearchOperator = @$_GET["z_offer_code"];

		// discount_value
		$this->discount_value->AdvancedSearch->SearchValue = @$_GET["x_discount_value"];
		if ($this->discount_value->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->discount_value->AdvancedSearch->SearchOperator = @$_GET["z_discount_value"];

		// mer_amount
		$this->mer_amount->AdvancedSearch->SearchValue = @$_GET["x_mer_amount"];
		if ($this->mer_amount->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->mer_amount->AdvancedSearch->SearchOperator = @$_GET["z_mer_amount"];

		// eci_value
		$this->eci_value->AdvancedSearch->SearchValue = @$_GET["x_eci_value"];
		if ($this->eci_value->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->eci_value->AdvancedSearch->SearchOperator = @$_GET["z_eci_value"];

		// card_holder_name
		$this->card_holder_name->AdvancedSearch->SearchValue = @$_GET["x_card_holder_name"];
		if ($this->card_holder_name->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->card_holder_name->AdvancedSearch->SearchOperator = @$_GET["z_card_holder_name"];

		// bank_qsi_no
		$this->bank_qsi_no->AdvancedSearch->SearchValue = @$_GET["x_bank_qsi_no"];
		if ($this->bank_qsi_no->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->bank_qsi_no->AdvancedSearch->SearchOperator = @$_GET["z_bank_qsi_no"];

		// bank_receipt_no
		$this->bank_receipt_no->AdvancedSearch->SearchValue = @$_GET["x_bank_receipt_no"];
		if ($this->bank_receipt_no->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->bank_receipt_no->AdvancedSearch->SearchOperator = @$_GET["z_bank_receipt_no"];

		// merchant_param6
		$this->merchant_param6->AdvancedSearch->SearchValue = @$_GET["x_merchant_param6"];
		if ($this->merchant_param6->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->merchant_param6->AdvancedSearch->SearchOperator = @$_GET["z_merchant_param6"];
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
		$this->ViewUrl = $this->GetViewUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->InlineEditUrl = $this->GetInlineEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->InlineCopyUrl = $this->GetInlineCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();

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
		} elseif ($this->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// transactionID
			$this->transactionID->EditAttrs["class"] = "form-control";
			$this->transactionID->EditCustomAttributes = "";
			$this->transactionID->EditValue = ew_HtmlEncode($this->transactionID->AdvancedSearch->SearchValue);
			$this->transactionID->PlaceHolder = ew_RemoveHtml($this->transactionID->FldCaption());

			// userID
			$this->_userID->EditAttrs["class"] = "form-control";
			$this->_userID->EditCustomAttributes = "";

			// bookingNumber
			$this->bookingNumber->EditAttrs["class"] = "form-control";
			$this->bookingNumber->EditCustomAttributes = "";
			$this->bookingNumber->EditValue = ew_HtmlEncode($this->bookingNumber->AdvancedSearch->SearchValue);
			$this->bookingNumber->PlaceHolder = ew_RemoveHtml($this->bookingNumber->FldCaption());

			// bookingModule
			$this->bookingModule->EditCustomAttributes = "";
			$this->bookingModule->EditValue = $this->bookingModule->Options(FALSE);

			// order_id
			$this->order_id->EditAttrs["class"] = "form-control";
			$this->order_id->EditCustomAttributes = "";
			$this->order_id->EditValue = ew_HtmlEncode($this->order_id->AdvancedSearch->SearchValue);
			$this->order_id->PlaceHolder = ew_RemoveHtml($this->order_id->FldCaption());

			// order_status
			$this->order_status->EditAttrs["class"] = "form-control";
			$this->order_status->EditCustomAttributes = "";
			$this->order_status->EditValue = ew_HtmlEncode($this->order_status->AdvancedSearch->SearchValue);
			$this->order_status->PlaceHolder = ew_RemoveHtml($this->order_status->FldCaption());

			// payment_mode
			$this->payment_mode->EditAttrs["class"] = "form-control";
			$this->payment_mode->EditCustomAttributes = "";
			$this->payment_mode->EditValue = ew_HtmlEncode($this->payment_mode->AdvancedSearch->SearchValue);
			$this->payment_mode->PlaceHolder = ew_RemoveHtml($this->payment_mode->FldCaption());

			// amount
			$this->amount->EditAttrs["class"] = "form-control";
			$this->amount->EditCustomAttributes = "";
			$this->amount->EditValue = ew_HtmlEncode($this->amount->AdvancedSearch->SearchValue);
			$this->amount->PlaceHolder = ew_RemoveHtml($this->amount->FldCaption());
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
		$this->transactionID->AdvancedSearch->Load();
		$this->_userID->AdvancedSearch->Load();
		$this->bookingNumber->AdvancedSearch->Load();
		$this->bookingModule->AdvancedSearch->Load();
		$this->order_id->AdvancedSearch->Load();
		$this->tracking_id->AdvancedSearch->Load();
		$this->bank_ref_no->AdvancedSearch->Load();
		$this->order_status->AdvancedSearch->Load();
		$this->failure_message->AdvancedSearch->Load();
		$this->payment_mode->AdvancedSearch->Load();
		$this->card_name->AdvancedSearch->Load();
		$this->status_code->AdvancedSearch->Load();
		$this->status_message->AdvancedSearch->Load();
		$this->currency->AdvancedSearch->Load();
		$this->amount->AdvancedSearch->Load();
		$this->billing_name->AdvancedSearch->Load();
		$this->billing_address->AdvancedSearch->Load();
		$this->billing_city->AdvancedSearch->Load();
		$this->billing_state->AdvancedSearch->Load();
		$this->billing_zip->AdvancedSearch->Load();
		$this->billing_country->AdvancedSearch->Load();
		$this->billing_tel->AdvancedSearch->Load();
		$this->billing_email->AdvancedSearch->Load();
		$this->delivery_name->AdvancedSearch->Load();
		$this->delivery_address->AdvancedSearch->Load();
		$this->delivery_city->AdvancedSearch->Load();
		$this->delivery_state->AdvancedSearch->Load();
		$this->delivery_zip->AdvancedSearch->Load();
		$this->delivery_country->AdvancedSearch->Load();
		$this->delivery_tel->AdvancedSearch->Load();
		$this->merchant_param1->AdvancedSearch->Load();
		$this->merchant_param2->AdvancedSearch->Load();
		$this->merchant_param3->AdvancedSearch->Load();
		$this->merchant_param4->AdvancedSearch->Load();
		$this->merchant_param5->AdvancedSearch->Load();
		$this->vault->AdvancedSearch->Load();
		$this->offer_type->AdvancedSearch->Load();
		$this->offer_code->AdvancedSearch->Load();
		$this->discount_value->AdvancedSearch->Load();
		$this->mer_amount->AdvancedSearch->Load();
		$this->eci_value->AdvancedSearch->Load();
		$this->card_holder_name->AdvancedSearch->Load();
		$this->bank_qsi_no->AdvancedSearch->Load();
		$this->bank_receipt_no->AdvancedSearch->Load();
		$this->merchant_param6->AdvancedSearch->Load();
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
		$item->Body = "<button id=\"emf_pg_transactions\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_pg_transactions',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.fpg_transactionslist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
		$this->AddSearchQueryString($sQry, $this->transactionID); // transactionID
		$this->AddSearchQueryString($sQry, $this->_userID); // userID
		$this->AddSearchQueryString($sQry, $this->bookingNumber); // bookingNumber
		$this->AddSearchQueryString($sQry, $this->bookingModule); // bookingModule
		$this->AddSearchQueryString($sQry, $this->order_id); // order_id
		$this->AddSearchQueryString($sQry, $this->tracking_id); // tracking_id
		$this->AddSearchQueryString($sQry, $this->bank_ref_no); // bank_ref_no
		$this->AddSearchQueryString($sQry, $this->order_status); // order_status
		$this->AddSearchQueryString($sQry, $this->failure_message); // failure_message
		$this->AddSearchQueryString($sQry, $this->payment_mode); // payment_mode
		$this->AddSearchQueryString($sQry, $this->card_name); // card_name
		$this->AddSearchQueryString($sQry, $this->status_code); // status_code
		$this->AddSearchQueryString($sQry, $this->status_message); // status_message
		$this->AddSearchQueryString($sQry, $this->currency); // currency
		$this->AddSearchQueryString($sQry, $this->amount); // amount
		$this->AddSearchQueryString($sQry, $this->billing_name); // billing_name
		$this->AddSearchQueryString($sQry, $this->billing_address); // billing_address
		$this->AddSearchQueryString($sQry, $this->billing_city); // billing_city
		$this->AddSearchQueryString($sQry, $this->billing_state); // billing_state
		$this->AddSearchQueryString($sQry, $this->billing_zip); // billing_zip
		$this->AddSearchQueryString($sQry, $this->billing_country); // billing_country
		$this->AddSearchQueryString($sQry, $this->billing_tel); // billing_tel
		$this->AddSearchQueryString($sQry, $this->billing_email); // billing_email
		$this->AddSearchQueryString($sQry, $this->delivery_name); // delivery_name
		$this->AddSearchQueryString($sQry, $this->delivery_address); // delivery_address
		$this->AddSearchQueryString($sQry, $this->delivery_city); // delivery_city
		$this->AddSearchQueryString($sQry, $this->delivery_state); // delivery_state
		$this->AddSearchQueryString($sQry, $this->delivery_zip); // delivery_zip
		$this->AddSearchQueryString($sQry, $this->delivery_country); // delivery_country
		$this->AddSearchQueryString($sQry, $this->delivery_tel); // delivery_tel
		$this->AddSearchQueryString($sQry, $this->merchant_param1); // merchant_param1
		$this->AddSearchQueryString($sQry, $this->merchant_param2); // merchant_param2
		$this->AddSearchQueryString($sQry, $this->merchant_param3); // merchant_param3
		$this->AddSearchQueryString($sQry, $this->merchant_param4); // merchant_param4
		$this->AddSearchQueryString($sQry, $this->merchant_param5); // merchant_param5
		$this->AddSearchQueryString($sQry, $this->vault); // vault
		$this->AddSearchQueryString($sQry, $this->offer_type); // offer_type
		$this->AddSearchQueryString($sQry, $this->offer_code); // offer_code
		$this->AddSearchQueryString($sQry, $this->discount_value); // discount_value
		$this->AddSearchQueryString($sQry, $this->mer_amount); // mer_amount
		$this->AddSearchQueryString($sQry, $this->eci_value); // eci_value
		$this->AddSearchQueryString($sQry, $this->card_holder_name); // card_holder_name
		$this->AddSearchQueryString($sQry, $this->bank_qsi_no); // bank_qsi_no
		$this->AddSearchQueryString($sQry, $this->bank_receipt_no); // bank_receipt_no
		$this->AddSearchQueryString($sQry, $this->merchant_param6); // merchant_param6

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
if (!isset($pg_transactions_list)) $pg_transactions_list = new cpg_transactions_list();

// Page init
$pg_transactions_list->Page_Init();

// Page main
$pg_transactions_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pg_transactions_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($pg_transactions->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = fpg_transactionslist = new ew_Form("fpg_transactionslist", "list");
fpg_transactionslist.FormKeyCountName = '<?php echo $pg_transactions_list->FormKeyCountName ?>';

// Form_CustomValidate event
fpg_transactionslist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fpg_transactionslist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fpg_transactionslist.Lists["x__userID"] = {"LinkField":"x__userID","Ajax":true,"AutoFill":false,"DisplayFields":["x_firstName","x_lastName","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"users"};
fpg_transactionslist.Lists["x__userID"].Data = "<?php echo $pg_transactions_list->_userID->LookupFilterQuery(FALSE, "list") ?>";
fpg_transactionslist.Lists["x_bookingModule"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fpg_transactionslist.Lists["x_bookingModule"].Options = <?php echo json_encode($pg_transactions_list->bookingModule->Options()) ?>;

// Form object for search
var CurrentSearchForm = fpg_transactionslistsrch = new ew_Form("fpg_transactionslistsrch");

// Validate function for search
fpg_transactionslistsrch.Validate = function(fobj) {
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
fpg_transactionslistsrch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fpg_transactionslistsrch.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fpg_transactionslistsrch.Lists["x_bookingModule"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fpg_transactionslistsrch.Lists["x_bookingModule"].Options = <?php echo json_encode($pg_transactions_list->bookingModule->Options()) ?>;
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
<?php if ($pg_transactions->Export == "") { ?>
<div class="ewToolbar">
<?php if ($pg_transactions_list->TotalRecs > 0 && $pg_transactions_list->ExportOptions->Visible()) { ?>
<?php $pg_transactions_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($pg_transactions_list->SearchOptions->Visible()) { ?>
<?php $pg_transactions_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($pg_transactions_list->FilterOptions->Visible()) { ?>
<?php $pg_transactions_list->FilterOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
	$bSelectLimit = $pg_transactions_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($pg_transactions_list->TotalRecs <= 0)
			$pg_transactions_list->TotalRecs = $pg_transactions->ListRecordCount();
	} else {
		if (!$pg_transactions_list->Recordset && ($pg_transactions_list->Recordset = $pg_transactions_list->LoadRecordset()))
			$pg_transactions_list->TotalRecs = $pg_transactions_list->Recordset->RecordCount();
	}
	$pg_transactions_list->StartRec = 1;
	if ($pg_transactions_list->DisplayRecs <= 0 || ($pg_transactions->Export <> "" && $pg_transactions->ExportAll)) // Display all records
		$pg_transactions_list->DisplayRecs = $pg_transactions_list->TotalRecs;
	if (!($pg_transactions->Export <> "" && $pg_transactions->ExportAll))
		$pg_transactions_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$pg_transactions_list->Recordset = $pg_transactions_list->LoadRecordset($pg_transactions_list->StartRec-1, $pg_transactions_list->DisplayRecs);

	// Set no record found message
	if ($pg_transactions->CurrentAction == "" && $pg_transactions_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$pg_transactions_list->setWarningMessage(ew_DeniedMsg());
		if ($pg_transactions_list->SearchWhere == "0=101")
			$pg_transactions_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$pg_transactions_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$pg_transactions_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($pg_transactions->Export == "" && $pg_transactions->CurrentAction == "") { ?>
<form name="fpg_transactionslistsrch" id="fpg_transactionslistsrch" class="form-inline ewForm ewExtSearchForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($pg_transactions_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="fpg_transactionslistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="pg_transactions">
	<div class="ewBasicSearch">
<?php
if ($gsSearchError == "")
	$pg_transactions_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$pg_transactions->RowType = EW_ROWTYPE_SEARCH;

// Render row
$pg_transactions->ResetAttrs();
$pg_transactions_list->RenderRow();
?>
<div id="xsr_1" class="ewRow">
<?php if ($pg_transactions->bookingModule->Visible) { // bookingModule ?>
	<div id="xsc_bookingModule" class="ewCell form-group">
		<label class="ewSearchCaption ewLabel"><?php echo $pg_transactions->bookingModule->FldCaption() ?></label>
		<span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_bookingModule" id="z_bookingModule" value="="></span>
		<span class="ewSearchField">
<div id="tp_x_bookingModule" class="ewTemplate"><input type="radio" data-table="pg_transactions" data-field="x_bookingModule" data-value-separator="<?php echo $pg_transactions->bookingModule->DisplayValueSeparatorAttribute() ?>" name="x_bookingModule" id="x_bookingModule" value="{value}"<?php echo $pg_transactions->bookingModule->EditAttributes() ?>></div>
<div id="dsl_x_bookingModule" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $pg_transactions->bookingModule->RadioButtonListHtml(FALSE, "x_bookingModule") ?>
</div></div>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ewRow">
	<div class="ewQuickSearch input-group">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo ew_HtmlEncode($pg_transactions_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo ew_HtmlEncode($Language->Phrase("Search")) ?>">
	<input type="hidden" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo ew_HtmlEncode($pg_transactions_list->BasicSearch->getType()) ?>">
	<div class="input-group-btn">
		<button type="button" data-toggle="dropdown" class="btn btn-default"><span id="searchtype"><?php echo $pg_transactions_list->BasicSearch->getTypeNameShort() ?></span><span class="caret"></span></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li<?php if ($pg_transactions_list->BasicSearch->getType() == "") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a></li>
			<li<?php if ($pg_transactions_list->BasicSearch->getType() == "=") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a></li>
			<li<?php if ($pg_transactions_list->BasicSearch->getType() == "AND") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a></li>
			<li<?php if ($pg_transactions_list->BasicSearch->getType() == "OR") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a></li>
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
<?php $pg_transactions_list->ShowPageHeader(); ?>
<?php
$pg_transactions_list->ShowMessage();
?>
<?php if ($pg_transactions_list->TotalRecs > 0 || $pg_transactions->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($pg_transactions_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> pg_transactions">
<?php if ($pg_transactions->Export == "") { ?>
<div class="box-header ewGridUpperPanel">
<?php if ($pg_transactions->CurrentAction <> "gridadd" && $pg_transactions->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($pg_transactions_list->Pager)) $pg_transactions_list->Pager = new cPrevNextPager($pg_transactions_list->StartRec, $pg_transactions_list->DisplayRecs, $pg_transactions_list->TotalRecs, $pg_transactions_list->AutoHidePager) ?>
<?php if ($pg_transactions_list->Pager->RecordCount > 0 && $pg_transactions_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($pg_transactions_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $pg_transactions_list->PageUrl() ?>start=<?php echo $pg_transactions_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($pg_transactions_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $pg_transactions_list->PageUrl() ?>start=<?php echo $pg_transactions_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $pg_transactions_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($pg_transactions_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $pg_transactions_list->PageUrl() ?>start=<?php echo $pg_transactions_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($pg_transactions_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $pg_transactions_list->PageUrl() ?>start=<?php echo $pg_transactions_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $pg_transactions_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $pg_transactions_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $pg_transactions_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $pg_transactions_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($pg_transactions_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpg_transactionslist" id="fpg_transactionslist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($pg_transactions_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $pg_transactions_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pg_transactions">
<div id="gmp_pg_transactions" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($pg_transactions_list->TotalRecs > 0 || $pg_transactions->CurrentAction == "gridedit") { ?>
<table id="tbl_pg_transactionslist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$pg_transactions_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$pg_transactions_list->RenderListOptions();

// Render list options (header, left)
$pg_transactions_list->ListOptions->Render("header", "left");
?>
<?php if ($pg_transactions->transactionID->Visible) { // transactionID ?>
	<?php if ($pg_transactions->SortUrl($pg_transactions->transactionID) == "") { ?>
		<th data-name="transactionID" class="<?php echo $pg_transactions->transactionID->HeaderCellClass() ?>"><div id="elh_pg_transactions_transactionID" class="pg_transactions_transactionID"><div class="ewTableHeaderCaption"><?php echo $pg_transactions->transactionID->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transactionID" class="<?php echo $pg_transactions->transactionID->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pg_transactions->SortUrl($pg_transactions->transactionID) ?>',1);"><div id="elh_pg_transactions_transactionID" class="pg_transactions_transactionID">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pg_transactions->transactionID->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($pg_transactions->transactionID->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pg_transactions->transactionID->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pg_transactions->_userID->Visible) { // userID ?>
	<?php if ($pg_transactions->SortUrl($pg_transactions->_userID) == "") { ?>
		<th data-name="_userID" class="<?php echo $pg_transactions->_userID->HeaderCellClass() ?>"><div id="elh_pg_transactions__userID" class="pg_transactions__userID"><div class="ewTableHeaderCaption"><?php echo $pg_transactions->_userID->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_userID" class="<?php echo $pg_transactions->_userID->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pg_transactions->SortUrl($pg_transactions->_userID) ?>',1);"><div id="elh_pg_transactions__userID" class="pg_transactions__userID">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pg_transactions->_userID->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($pg_transactions->_userID->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pg_transactions->_userID->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pg_transactions->bookingNumber->Visible) { // bookingNumber ?>
	<?php if ($pg_transactions->SortUrl($pg_transactions->bookingNumber) == "") { ?>
		<th data-name="bookingNumber" class="<?php echo $pg_transactions->bookingNumber->HeaderCellClass() ?>"><div id="elh_pg_transactions_bookingNumber" class="pg_transactions_bookingNumber"><div class="ewTableHeaderCaption"><?php echo $pg_transactions->bookingNumber->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bookingNumber" class="<?php echo $pg_transactions->bookingNumber->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pg_transactions->SortUrl($pg_transactions->bookingNumber) ?>',1);"><div id="elh_pg_transactions_bookingNumber" class="pg_transactions_bookingNumber">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pg_transactions->bookingNumber->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pg_transactions->bookingNumber->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pg_transactions->bookingNumber->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pg_transactions->bookingModule->Visible) { // bookingModule ?>
	<?php if ($pg_transactions->SortUrl($pg_transactions->bookingModule) == "") { ?>
		<th data-name="bookingModule" class="<?php echo $pg_transactions->bookingModule->HeaderCellClass() ?>"><div id="elh_pg_transactions_bookingModule" class="pg_transactions_bookingModule"><div class="ewTableHeaderCaption"><?php echo $pg_transactions->bookingModule->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bookingModule" class="<?php echo $pg_transactions->bookingModule->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pg_transactions->SortUrl($pg_transactions->bookingModule) ?>',1);"><div id="elh_pg_transactions_bookingModule" class="pg_transactions_bookingModule">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pg_transactions->bookingModule->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($pg_transactions->bookingModule->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pg_transactions->bookingModule->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pg_transactions->order_id->Visible) { // order_id ?>
	<?php if ($pg_transactions->SortUrl($pg_transactions->order_id) == "") { ?>
		<th data-name="order_id" class="<?php echo $pg_transactions->order_id->HeaderCellClass() ?>"><div id="elh_pg_transactions_order_id" class="pg_transactions_order_id"><div class="ewTableHeaderCaption"><?php echo $pg_transactions->order_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="order_id" class="<?php echo $pg_transactions->order_id->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pg_transactions->SortUrl($pg_transactions->order_id) ?>',1);"><div id="elh_pg_transactions_order_id" class="pg_transactions_order_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pg_transactions->order_id->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pg_transactions->order_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pg_transactions->order_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pg_transactions->order_status->Visible) { // order_status ?>
	<?php if ($pg_transactions->SortUrl($pg_transactions->order_status) == "") { ?>
		<th data-name="order_status" class="<?php echo $pg_transactions->order_status->HeaderCellClass() ?>"><div id="elh_pg_transactions_order_status" class="pg_transactions_order_status"><div class="ewTableHeaderCaption"><?php echo $pg_transactions->order_status->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="order_status" class="<?php echo $pg_transactions->order_status->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pg_transactions->SortUrl($pg_transactions->order_status) ?>',1);"><div id="elh_pg_transactions_order_status" class="pg_transactions_order_status">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pg_transactions->order_status->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pg_transactions->order_status->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pg_transactions->order_status->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pg_transactions->payment_mode->Visible) { // payment_mode ?>
	<?php if ($pg_transactions->SortUrl($pg_transactions->payment_mode) == "") { ?>
		<th data-name="payment_mode" class="<?php echo $pg_transactions->payment_mode->HeaderCellClass() ?>"><div id="elh_pg_transactions_payment_mode" class="pg_transactions_payment_mode"><div class="ewTableHeaderCaption"><?php echo $pg_transactions->payment_mode->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="payment_mode" class="<?php echo $pg_transactions->payment_mode->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pg_transactions->SortUrl($pg_transactions->payment_mode) ?>',1);"><div id="elh_pg_transactions_payment_mode" class="pg_transactions_payment_mode">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pg_transactions->payment_mode->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pg_transactions->payment_mode->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pg_transactions->payment_mode->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pg_transactions->amount->Visible) { // amount ?>
	<?php if ($pg_transactions->SortUrl($pg_transactions->amount) == "") { ?>
		<th data-name="amount" class="<?php echo $pg_transactions->amount->HeaderCellClass() ?>"><div id="elh_pg_transactions_amount" class="pg_transactions_amount"><div class="ewTableHeaderCaption"><?php echo $pg_transactions->amount->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="amount" class="<?php echo $pg_transactions->amount->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pg_transactions->SortUrl($pg_transactions->amount) ?>',1);"><div id="elh_pg_transactions_amount" class="pg_transactions_amount">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pg_transactions->amount->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pg_transactions->amount->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pg_transactions->amount->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$pg_transactions_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($pg_transactions->ExportAll && $pg_transactions->Export <> "") {
	$pg_transactions_list->StopRec = $pg_transactions_list->TotalRecs;
} else {

	// Set the last record to display
	if ($pg_transactions_list->TotalRecs > $pg_transactions_list->StartRec + $pg_transactions_list->DisplayRecs - 1)
		$pg_transactions_list->StopRec = $pg_transactions_list->StartRec + $pg_transactions_list->DisplayRecs - 1;
	else
		$pg_transactions_list->StopRec = $pg_transactions_list->TotalRecs;
}
$pg_transactions_list->RecCnt = $pg_transactions_list->StartRec - 1;
if ($pg_transactions_list->Recordset && !$pg_transactions_list->Recordset->EOF) {
	$pg_transactions_list->Recordset->MoveFirst();
	$bSelectLimit = $pg_transactions_list->UseSelectLimit;
	if (!$bSelectLimit && $pg_transactions_list->StartRec > 1)
		$pg_transactions_list->Recordset->Move($pg_transactions_list->StartRec - 1);
} elseif (!$pg_transactions->AllowAddDeleteRow && $pg_transactions_list->StopRec == 0) {
	$pg_transactions_list->StopRec = $pg_transactions->GridAddRowCount;
}

// Initialize aggregate
$pg_transactions->RowType = EW_ROWTYPE_AGGREGATEINIT;
$pg_transactions->ResetAttrs();
$pg_transactions_list->RenderRow();
while ($pg_transactions_list->RecCnt < $pg_transactions_list->StopRec) {
	$pg_transactions_list->RecCnt++;
	if (intval($pg_transactions_list->RecCnt) >= intval($pg_transactions_list->StartRec)) {
		$pg_transactions_list->RowCnt++;

		// Set up key count
		$pg_transactions_list->KeyCount = $pg_transactions_list->RowIndex;

		// Init row class and style
		$pg_transactions->ResetAttrs();
		$pg_transactions->CssClass = "";
		if ($pg_transactions->CurrentAction == "gridadd") {
		} else {
			$pg_transactions_list->LoadRowValues($pg_transactions_list->Recordset); // Load row values
		}
		$pg_transactions->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$pg_transactions->RowAttrs = array_merge($pg_transactions->RowAttrs, array('data-rowindex'=>$pg_transactions_list->RowCnt, 'id'=>'r' . $pg_transactions_list->RowCnt . '_pg_transactions', 'data-rowtype'=>$pg_transactions->RowType));

		// Render row
		$pg_transactions_list->RenderRow();

		// Render list options
		$pg_transactions_list->RenderListOptions();
?>
	<tr<?php echo $pg_transactions->RowAttributes() ?>>
<?php

// Render list options (body, left)
$pg_transactions_list->ListOptions->Render("body", "left", $pg_transactions_list->RowCnt);
?>
	<?php if ($pg_transactions->transactionID->Visible) { // transactionID ?>
		<td data-name="transactionID"<?php echo $pg_transactions->transactionID->CellAttributes() ?>>
<span id="el<?php echo $pg_transactions_list->RowCnt ?>_pg_transactions_transactionID" class="pg_transactions_transactionID">
<span<?php echo $pg_transactions->transactionID->ViewAttributes() ?>>
<?php echo $pg_transactions->transactionID->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pg_transactions->_userID->Visible) { // userID ?>
		<td data-name="_userID"<?php echo $pg_transactions->_userID->CellAttributes() ?>>
<span id="el<?php echo $pg_transactions_list->RowCnt ?>_pg_transactions__userID" class="pg_transactions__userID">
<span<?php echo $pg_transactions->_userID->ViewAttributes() ?>>
<?php echo $pg_transactions->_userID->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pg_transactions->bookingNumber->Visible) { // bookingNumber ?>
		<td data-name="bookingNumber"<?php echo $pg_transactions->bookingNumber->CellAttributes() ?>>
<span id="el<?php echo $pg_transactions_list->RowCnt ?>_pg_transactions_bookingNumber" class="pg_transactions_bookingNumber">
<span<?php echo $pg_transactions->bookingNumber->ViewAttributes() ?>>
<?php echo $pg_transactions->bookingNumber->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pg_transactions->bookingModule->Visible) { // bookingModule ?>
		<td data-name="bookingModule"<?php echo $pg_transactions->bookingModule->CellAttributes() ?>>
<span id="el<?php echo $pg_transactions_list->RowCnt ?>_pg_transactions_bookingModule" class="pg_transactions_bookingModule">
<span<?php echo $pg_transactions->bookingModule->ViewAttributes() ?>>
<?php echo $pg_transactions->bookingModule->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pg_transactions->order_id->Visible) { // order_id ?>
		<td data-name="order_id"<?php echo $pg_transactions->order_id->CellAttributes() ?>>
<span id="el<?php echo $pg_transactions_list->RowCnt ?>_pg_transactions_order_id" class="pg_transactions_order_id">
<span<?php echo $pg_transactions->order_id->ViewAttributes() ?>>
<?php echo $pg_transactions->order_id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pg_transactions->order_status->Visible) { // order_status ?>
		<td data-name="order_status"<?php echo $pg_transactions->order_status->CellAttributes() ?>>
<span id="el<?php echo $pg_transactions_list->RowCnt ?>_pg_transactions_order_status" class="pg_transactions_order_status">
<span<?php echo $pg_transactions->order_status->ViewAttributes() ?>>
<?php echo $pg_transactions->order_status->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pg_transactions->payment_mode->Visible) { // payment_mode ?>
		<td data-name="payment_mode"<?php echo $pg_transactions->payment_mode->CellAttributes() ?>>
<span id="el<?php echo $pg_transactions_list->RowCnt ?>_pg_transactions_payment_mode" class="pg_transactions_payment_mode">
<span<?php echo $pg_transactions->payment_mode->ViewAttributes() ?>>
<?php echo $pg_transactions->payment_mode->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pg_transactions->amount->Visible) { // amount ?>
		<td data-name="amount"<?php echo $pg_transactions->amount->CellAttributes() ?>>
<span id="el<?php echo $pg_transactions_list->RowCnt ?>_pg_transactions_amount" class="pg_transactions_amount">
<span<?php echo $pg_transactions->amount->ViewAttributes() ?>>
<?php echo $pg_transactions->amount->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pg_transactions_list->ListOptions->Render("body", "right", $pg_transactions_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($pg_transactions->CurrentAction <> "gridadd")
		$pg_transactions_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($pg_transactions->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($pg_transactions_list->Recordset)
	$pg_transactions_list->Recordset->Close();
?>
<?php if ($pg_transactions->Export == "") { ?>
<div class="box-footer ewGridLowerPanel">
<?php if ($pg_transactions->CurrentAction <> "gridadd" && $pg_transactions->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($pg_transactions_list->Pager)) $pg_transactions_list->Pager = new cPrevNextPager($pg_transactions_list->StartRec, $pg_transactions_list->DisplayRecs, $pg_transactions_list->TotalRecs, $pg_transactions_list->AutoHidePager) ?>
<?php if ($pg_transactions_list->Pager->RecordCount > 0 && $pg_transactions_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($pg_transactions_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $pg_transactions_list->PageUrl() ?>start=<?php echo $pg_transactions_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($pg_transactions_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $pg_transactions_list->PageUrl() ?>start=<?php echo $pg_transactions_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $pg_transactions_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($pg_transactions_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $pg_transactions_list->PageUrl() ?>start=<?php echo $pg_transactions_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($pg_transactions_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $pg_transactions_list->PageUrl() ?>start=<?php echo $pg_transactions_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $pg_transactions_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $pg_transactions_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $pg_transactions_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $pg_transactions_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($pg_transactions_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($pg_transactions_list->TotalRecs == 0 && $pg_transactions->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($pg_transactions_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($pg_transactions->Export == "") { ?>
<script type="text/javascript">
fpg_transactionslistsrch.FilterList = <?php echo $pg_transactions_list->GetFilterList() ?>;
fpg_transactionslistsrch.Init();
fpg_transactionslist.Init();
</script>
<?php } ?>
<?php
$pg_transactions_list->ShowPageFooter();
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
$pg_transactions_list->Page_Terminate();
?>
