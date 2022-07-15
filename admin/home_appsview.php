<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "home_appsinfo.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$home_apps_view = NULL; // Initialize page object first

class chome_apps_view extends chome_apps {

	// Page ID
	var $PageID = 'view';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'home_apps';

	// Page object name
	var $PageObjName = 'home_apps_view';

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

		// Table object (home_apps)
		if (!isset($GLOBALS["home_apps"]) || get_class($GLOBALS["home_apps"]) == "chome_apps") {
			$GLOBALS["home_apps"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["home_apps"];
		}
		$KeyUrl = "";
		if (@$_GET["appsID"] <> "") {
			$this->RecKey["appsID"] = $_GET["appsID"];
			$KeyUrl .= "&amp;appsID=" . urlencode($this->RecKey["appsID"]);
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
			define("EW_TABLE_NAME", 'home_apps', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("home_appslist.php"));
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
		if (@$_GET["appsID"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= $_GET["appsID"];
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
		$this->appsID->SetVisibility();
		$this->appsID->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
		$this->title->SetVisibility();
		$this->subTitle->SetVisibility();
		$this->buttonIcon1->SetVisibility();
		$this->buttonLinkLabel1->SetVisibility();
		$this->buttonLink1->SetVisibility();
		$this->buttonIcon2->SetVisibility();
		$this->buttonLinkLabel2->SetVisibility();
		$this->buttonLink2->SetVisibility();
		$this->image->SetVisibility();
		$this->backgroundImage->SetVisibility();

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
		global $EW_EXPORT, $home_apps;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($home_apps);
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
					if ($pageName == "home_appsview.php")
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
			if (@$_GET["appsID"] <> "") {
				$this->appsID->setQueryStringValue($_GET["appsID"]);
				$this->RecKey["appsID"] = $this->appsID->QueryStringValue;
			} elseif (@$_POST["appsID"] <> "") {
				$this->appsID->setFormValue($_POST["appsID"]);
				$this->RecKey["appsID"] = $this->appsID->FormValue;
			} else {
				$sReturnUrl = "home_appslist.php"; // Return to list
			}

			// Get action
			$this->CurrentAction = "I"; // Display form
			switch ($this->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "home_appslist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if ($this->CustomExport == "" && in_array($this->Export, array_keys($EW_EXPORT))) {
				$this->ExportData();
				$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "home_appslist.php"; // Not page request, return to list
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
		$this->appsID->setDbValue($row['appsID']);
		$this->title->setDbValue($row['title']);
		$this->subTitle->setDbValue($row['subTitle']);
		$this->buttonIcon1->Upload->DbValue = $row['buttonIcon1'];
		$this->buttonIcon1->setDbValue($this->buttonIcon1->Upload->DbValue);
		$this->buttonLinkLabel1->setDbValue($row['buttonLinkLabel1']);
		$this->buttonLink1->setDbValue($row['buttonLink1']);
		$this->buttonIcon2->Upload->DbValue = $row['buttonIcon2'];
		$this->buttonIcon2->setDbValue($this->buttonIcon2->Upload->DbValue);
		$this->buttonLinkLabel2->setDbValue($row['buttonLinkLabel2']);
		$this->buttonLink2->setDbValue($row['buttonLink2']);
		$this->image->Upload->DbValue = $row['image'];
		$this->image->setDbValue($this->image->Upload->DbValue);
		$this->backgroundImage->Upload->DbValue = $row['backgroundImage'];
		$this->backgroundImage->setDbValue($this->backgroundImage->Upload->DbValue);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['appsID'] = NULL;
		$row['title'] = NULL;
		$row['subTitle'] = NULL;
		$row['buttonIcon1'] = NULL;
		$row['buttonLinkLabel1'] = NULL;
		$row['buttonLink1'] = NULL;
		$row['buttonIcon2'] = NULL;
		$row['buttonLinkLabel2'] = NULL;
		$row['buttonLink2'] = NULL;
		$row['image'] = NULL;
		$row['backgroundImage'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->appsID->DbValue = $row['appsID'];
		$this->title->DbValue = $row['title'];
		$this->subTitle->DbValue = $row['subTitle'];
		$this->buttonIcon1->Upload->DbValue = $row['buttonIcon1'];
		$this->buttonLinkLabel1->DbValue = $row['buttonLinkLabel1'];
		$this->buttonLink1->DbValue = $row['buttonLink1'];
		$this->buttonIcon2->Upload->DbValue = $row['buttonIcon2'];
		$this->buttonLinkLabel2->DbValue = $row['buttonLinkLabel2'];
		$this->buttonLink2->DbValue = $row['buttonLink2'];
		$this->image->Upload->DbValue = $row['image'];
		$this->backgroundImage->Upload->DbValue = $row['backgroundImage'];
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
		// appsID
		// title
		// subTitle
		// buttonIcon1
		// buttonLinkLabel1
		// buttonLink1
		// buttonIcon2
		// buttonLinkLabel2
		// buttonLink2
		// image
		// backgroundImage

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// appsID
		$this->appsID->ViewValue = $this->appsID->CurrentValue;
		$this->appsID->ViewCustomAttributes = "";

		// title
		$this->title->ViewValue = $this->title->CurrentValue;
		$this->title->ViewCustomAttributes = "";

		// subTitle
		$this->subTitle->ViewValue = $this->subTitle->CurrentValue;
		$this->subTitle->ViewCustomAttributes = "";

		// buttonIcon1
		$this->buttonIcon1->UploadPath = 'uploads/pages';
		if (!ew_Empty($this->buttonIcon1->Upload->DbValue)) {
			$this->buttonIcon1->ImageWidth = 50;
			$this->buttonIcon1->ImageHeight = 0;
			$this->buttonIcon1->ImageAlt = $this->buttonIcon1->FldAlt();
			$this->buttonIcon1->ViewValue = $this->buttonIcon1->Upload->DbValue;
		} else {
			$this->buttonIcon1->ViewValue = "";
		}
		$this->buttonIcon1->ViewCustomAttributes = "";

		// buttonLinkLabel1
		$this->buttonLinkLabel1->ViewValue = $this->buttonLinkLabel1->CurrentValue;
		$this->buttonLinkLabel1->ViewCustomAttributes = "";

		// buttonLink1
		$this->buttonLink1->ViewValue = $this->buttonLink1->CurrentValue;
		$this->buttonLink1->ViewCustomAttributes = "";

		// buttonIcon2
		$this->buttonIcon2->UploadPath = 'uploads/pages';
		if (!ew_Empty($this->buttonIcon2->Upload->DbValue)) {
			$this->buttonIcon2->ImageWidth = 50;
			$this->buttonIcon2->ImageHeight = 0;
			$this->buttonIcon2->ImageAlt = $this->buttonIcon2->FldAlt();
			$this->buttonIcon2->ViewValue = $this->buttonIcon2->Upload->DbValue;
		} else {
			$this->buttonIcon2->ViewValue = "";
		}
		$this->buttonIcon2->ViewCustomAttributes = "";

		// buttonLinkLabel2
		$this->buttonLinkLabel2->ViewValue = $this->buttonLinkLabel2->CurrentValue;
		$this->buttonLinkLabel2->ViewCustomAttributes = "";

		// buttonLink2
		$this->buttonLink2->ViewValue = $this->buttonLink2->CurrentValue;
		$this->buttonLink2->ViewCustomAttributes = "";

		// image
		$this->image->UploadPath = 'uploads/pages';
		if (!ew_Empty($this->image->Upload->DbValue)) {
			$this->image->ImageWidth = 100;
			$this->image->ImageHeight = 0;
			$this->image->ImageAlt = $this->image->FldAlt();
			$this->image->ViewValue = $this->image->Upload->DbValue;
		} else {
			$this->image->ViewValue = "";
		}
		$this->image->ViewCustomAttributes = "";

		// backgroundImage
		$this->backgroundImage->UploadPath = 'uploads/pages';
		if (!ew_Empty($this->backgroundImage->Upload->DbValue)) {
			$this->backgroundImage->ImageWidth = 100;
			$this->backgroundImage->ImageHeight = 0;
			$this->backgroundImage->ImageAlt = $this->backgroundImage->FldAlt();
			$this->backgroundImage->ViewValue = $this->backgroundImage->Upload->DbValue;
		} else {
			$this->backgroundImage->ViewValue = "";
		}
		$this->backgroundImage->ViewCustomAttributes = "";

			// appsID
			$this->appsID->LinkCustomAttributes = "";
			$this->appsID->HrefValue = "";
			$this->appsID->TooltipValue = "";

			// title
			$this->title->LinkCustomAttributes = "";
			$this->title->HrefValue = "";
			$this->title->TooltipValue = "";

			// subTitle
			$this->subTitle->LinkCustomAttributes = "";
			$this->subTitle->HrefValue = "";
			$this->subTitle->TooltipValue = "";

			// buttonIcon1
			$this->buttonIcon1->LinkCustomAttributes = "";
			$this->buttonIcon1->UploadPath = 'uploads/pages';
			if (!ew_Empty($this->buttonIcon1->Upload->DbValue)) {
				$this->buttonIcon1->HrefValue = ew_GetFileUploadUrl($this->buttonIcon1, $this->buttonIcon1->Upload->DbValue); // Add prefix/suffix
				$this->buttonIcon1->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->buttonIcon1->HrefValue = ew_FullUrl($this->buttonIcon1->HrefValue, "href");
			} else {
				$this->buttonIcon1->HrefValue = "";
			}
			$this->buttonIcon1->HrefValue2 = $this->buttonIcon1->UploadPath . $this->buttonIcon1->Upload->DbValue;
			$this->buttonIcon1->TooltipValue = "";
			if ($this->buttonIcon1->UseColorbox) {
				if (ew_Empty($this->buttonIcon1->TooltipValue))
					$this->buttonIcon1->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->buttonIcon1->LinkAttrs["data-rel"] = "home_apps_x_buttonIcon1";
				ew_AppendClass($this->buttonIcon1->LinkAttrs["class"], "ewLightbox");
			}

			// buttonLinkLabel1
			$this->buttonLinkLabel1->LinkCustomAttributes = "";
			$this->buttonLinkLabel1->HrefValue = "";
			$this->buttonLinkLabel1->TooltipValue = "";

			// buttonLink1
			$this->buttonLink1->LinkCustomAttributes = "";
			$this->buttonLink1->HrefValue = "";
			$this->buttonLink1->TooltipValue = "";

			// buttonIcon2
			$this->buttonIcon2->LinkCustomAttributes = "";
			$this->buttonIcon2->UploadPath = 'uploads/pages';
			if (!ew_Empty($this->buttonIcon2->Upload->DbValue)) {
				$this->buttonIcon2->HrefValue = ew_GetFileUploadUrl($this->buttonIcon2, $this->buttonIcon2->Upload->DbValue); // Add prefix/suffix
				$this->buttonIcon2->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->buttonIcon2->HrefValue = ew_FullUrl($this->buttonIcon2->HrefValue, "href");
			} else {
				$this->buttonIcon2->HrefValue = "";
			}
			$this->buttonIcon2->HrefValue2 = $this->buttonIcon2->UploadPath . $this->buttonIcon2->Upload->DbValue;
			$this->buttonIcon2->TooltipValue = "";
			if ($this->buttonIcon2->UseColorbox) {
				if (ew_Empty($this->buttonIcon2->TooltipValue))
					$this->buttonIcon2->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->buttonIcon2->LinkAttrs["data-rel"] = "home_apps_x_buttonIcon2";
				ew_AppendClass($this->buttonIcon2->LinkAttrs["class"], "ewLightbox");
			}

			// buttonLinkLabel2
			$this->buttonLinkLabel2->LinkCustomAttributes = "";
			$this->buttonLinkLabel2->HrefValue = "";
			$this->buttonLinkLabel2->TooltipValue = "";

			// buttonLink2
			$this->buttonLink2->LinkCustomAttributes = "";
			$this->buttonLink2->HrefValue = "";
			$this->buttonLink2->TooltipValue = "";

			// image
			$this->image->LinkCustomAttributes = "";
			$this->image->UploadPath = 'uploads/pages';
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
				$this->image->LinkAttrs["data-rel"] = "home_apps_x_image";
				ew_AppendClass($this->image->LinkAttrs["class"], "ewLightbox");
			}

			// backgroundImage
			$this->backgroundImage->LinkCustomAttributes = "";
			$this->backgroundImage->UploadPath = 'uploads/pages';
			if (!ew_Empty($this->backgroundImage->Upload->DbValue)) {
				$this->backgroundImage->HrefValue = ew_GetFileUploadUrl($this->backgroundImage, $this->backgroundImage->Upload->DbValue); // Add prefix/suffix
				$this->backgroundImage->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->backgroundImage->HrefValue = ew_FullUrl($this->backgroundImage->HrefValue, "href");
			} else {
				$this->backgroundImage->HrefValue = "";
			}
			$this->backgroundImage->HrefValue2 = $this->backgroundImage->UploadPath . $this->backgroundImage->Upload->DbValue;
			$this->backgroundImage->TooltipValue = "";
			if ($this->backgroundImage->UseColorbox) {
				if (ew_Empty($this->backgroundImage->TooltipValue))
					$this->backgroundImage->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->backgroundImage->LinkAttrs["data-rel"] = "home_apps_x_backgroundImage";
				ew_AppendClass($this->backgroundImage->LinkAttrs["class"], "ewLightbox");
			}
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
		$item->Body = "<button id=\"emf_home_apps\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_home_apps',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.fhome_appsview,key:" . ew_ArrayToJsonAttr($this->RecKey) . ",sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("home_appslist.php"), "", $this->TableVar, TRUE);
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
if (!isset($home_apps_view)) $home_apps_view = new chome_apps_view();

// Page init
$home_apps_view->Page_Init();

// Page main
$home_apps_view->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$home_apps_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($home_apps->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "view";
var CurrentForm = fhome_appsview = new ew_Form("fhome_appsview", "view");

// Form_CustomValidate event
fhome_appsview.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fhome_appsview.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Multi-Page
fhome_appsview.MultiPage = new ew_MultiPage("fhome_appsview");

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($home_apps->Export == "") { ?>
<div class="ewToolbar">
<?php $home_apps_view->ExportOptions->Render("body") ?>
<?php
	foreach ($home_apps_view->OtherOptions as &$option)
		$option->Render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $home_apps_view->ShowPageHeader(); ?>
<?php
$home_apps_view->ShowMessage();
?>
<form name="fhome_appsview" id="fhome_appsview" class="form-inline ewForm ewViewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($home_apps_view->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $home_apps_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="home_apps">
<input type="hidden" name="modal" value="<?php echo intval($home_apps_view->IsModal) ?>">
<?php if ($home_apps->Export == "") { ?>
<div class="ewMultiPage">
<div class="nav-tabs-custom" id="home_apps_view">
	<ul class="nav<?php echo $home_apps_view->MultiPages->NavStyle() ?>">
		<li<?php echo $home_apps_view->MultiPages->TabStyle("1") ?>><a href="#tab_home_apps1" data-toggle="tab"><?php echo $home_apps->PageCaption(1) ?></a></li>
		<li<?php echo $home_apps_view->MultiPages->TabStyle("2") ?>><a href="#tab_home_apps2" data-toggle="tab"><?php echo $home_apps->PageCaption(2) ?></a></li>
		<li<?php echo $home_apps_view->MultiPages->TabStyle("3") ?>><a href="#tab_home_apps3" data-toggle="tab"><?php echo $home_apps->PageCaption(3) ?></a></li>
	</ul>
	<div class="tab-content">
<?php } ?>
<?php if ($home_apps->Export == "") { ?>
		<div class="tab-pane<?php echo $home_apps_view->MultiPages->PageStyle("1") ?>" id="tab_home_apps1">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($home_apps->appsID->Visible) { // appsID ?>
	<tr id="r_appsID">
		<td class="col-sm-2"><span id="elh_home_apps_appsID"><?php echo $home_apps->appsID->FldCaption() ?></span></td>
		<td data-name="appsID"<?php echo $home_apps->appsID->CellAttributes() ?>>
<span id="el_home_apps_appsID" data-page="1">
<span<?php echo $home_apps->appsID->ViewAttributes() ?>>
<?php echo $home_apps->appsID->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($home_apps->title->Visible) { // title ?>
	<tr id="r_title">
		<td class="col-sm-2"><span id="elh_home_apps_title"><?php echo $home_apps->title->FldCaption() ?></span></td>
		<td data-name="title"<?php echo $home_apps->title->CellAttributes() ?>>
<span id="el_home_apps_title" data-page="1">
<span<?php echo $home_apps->title->ViewAttributes() ?>>
<?php echo $home_apps->title->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($home_apps->subTitle->Visible) { // subTitle ?>
	<tr id="r_subTitle">
		<td class="col-sm-2"><span id="elh_home_apps_subTitle"><?php echo $home_apps->subTitle->FldCaption() ?></span></td>
		<td data-name="subTitle"<?php echo $home_apps->subTitle->CellAttributes() ?>>
<span id="el_home_apps_subTitle" data-page="1">
<span<?php echo $home_apps->subTitle->ViewAttributes() ?>>
<?php echo $home_apps->subTitle->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($home_apps->image->Visible) { // image ?>
	<tr id="r_image">
		<td class="col-sm-2"><span id="elh_home_apps_image"><?php echo $home_apps->image->FldCaption() ?></span></td>
		<td data-name="image"<?php echo $home_apps->image->CellAttributes() ?>>
<span id="el_home_apps_image" data-page="1">
<span>
<?php echo ew_GetFileViewTag($home_apps->image, $home_apps->image->ViewValue) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($home_apps->backgroundImage->Visible) { // backgroundImage ?>
	<tr id="r_backgroundImage">
		<td class="col-sm-2"><span id="elh_home_apps_backgroundImage"><?php echo $home_apps->backgroundImage->FldCaption() ?></span></td>
		<td data-name="backgroundImage"<?php echo $home_apps->backgroundImage->CellAttributes() ?>>
<span id="el_home_apps_backgroundImage" data-page="1">
<span>
<?php echo ew_GetFileViewTag($home_apps->backgroundImage, $home_apps->backgroundImage->ViewValue) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($home_apps->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($home_apps->Export == "") { ?>
		<div class="tab-pane<?php echo $home_apps_view->MultiPages->PageStyle("2") ?>" id="tab_home_apps2">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($home_apps->buttonIcon1->Visible) { // buttonIcon1 ?>
	<tr id="r_buttonIcon1">
		<td class="col-sm-2"><span id="elh_home_apps_buttonIcon1"><?php echo $home_apps->buttonIcon1->FldCaption() ?></span></td>
		<td data-name="buttonIcon1"<?php echo $home_apps->buttonIcon1->CellAttributes() ?>>
<span id="el_home_apps_buttonIcon1" data-page="2">
<span>
<?php echo ew_GetFileViewTag($home_apps->buttonIcon1, $home_apps->buttonIcon1->ViewValue) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($home_apps->buttonLinkLabel1->Visible) { // buttonLinkLabel1 ?>
	<tr id="r_buttonLinkLabel1">
		<td class="col-sm-2"><span id="elh_home_apps_buttonLinkLabel1"><?php echo $home_apps->buttonLinkLabel1->FldCaption() ?></span></td>
		<td data-name="buttonLinkLabel1"<?php echo $home_apps->buttonLinkLabel1->CellAttributes() ?>>
<span id="el_home_apps_buttonLinkLabel1" data-page="2">
<span<?php echo $home_apps->buttonLinkLabel1->ViewAttributes() ?>>
<?php echo $home_apps->buttonLinkLabel1->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($home_apps->buttonLink1->Visible) { // buttonLink1 ?>
	<tr id="r_buttonLink1">
		<td class="col-sm-2"><span id="elh_home_apps_buttonLink1"><?php echo $home_apps->buttonLink1->FldCaption() ?></span></td>
		<td data-name="buttonLink1"<?php echo $home_apps->buttonLink1->CellAttributes() ?>>
<span id="el_home_apps_buttonLink1" data-page="2">
<span<?php echo $home_apps->buttonLink1->ViewAttributes() ?>>
<?php echo $home_apps->buttonLink1->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($home_apps->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($home_apps->Export == "") { ?>
		<div class="tab-pane<?php echo $home_apps_view->MultiPages->PageStyle("3") ?>" id="tab_home_apps3">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($home_apps->buttonIcon2->Visible) { // buttonIcon2 ?>
	<tr id="r_buttonIcon2">
		<td class="col-sm-2"><span id="elh_home_apps_buttonIcon2"><?php echo $home_apps->buttonIcon2->FldCaption() ?></span></td>
		<td data-name="buttonIcon2"<?php echo $home_apps->buttonIcon2->CellAttributes() ?>>
<span id="el_home_apps_buttonIcon2" data-page="3">
<span>
<?php echo ew_GetFileViewTag($home_apps->buttonIcon2, $home_apps->buttonIcon2->ViewValue) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($home_apps->buttonLinkLabel2->Visible) { // buttonLinkLabel2 ?>
	<tr id="r_buttonLinkLabel2">
		<td class="col-sm-2"><span id="elh_home_apps_buttonLinkLabel2"><?php echo $home_apps->buttonLinkLabel2->FldCaption() ?></span></td>
		<td data-name="buttonLinkLabel2"<?php echo $home_apps->buttonLinkLabel2->CellAttributes() ?>>
<span id="el_home_apps_buttonLinkLabel2" data-page="3">
<span<?php echo $home_apps->buttonLinkLabel2->ViewAttributes() ?>>
<?php echo $home_apps->buttonLinkLabel2->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($home_apps->buttonLink2->Visible) { // buttonLink2 ?>
	<tr id="r_buttonLink2">
		<td class="col-sm-2"><span id="elh_home_apps_buttonLink2"><?php echo $home_apps->buttonLink2->FldCaption() ?></span></td>
		<td data-name="buttonLink2"<?php echo $home_apps->buttonLink2->CellAttributes() ?>>
<span id="el_home_apps_buttonLink2" data-page="3">
<span<?php echo $home_apps->buttonLink2->ViewAttributes() ?>>
<?php echo $home_apps->buttonLink2->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($home_apps->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($home_apps->Export == "") { ?>
	</div>
</div>
</div>
<?php } ?>
</form>
<?php if ($home_apps->Export == "") { ?>
<script type="text/javascript">
fhome_appsview.Init();
</script>
<?php } ?>
<?php
$home_apps_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($home_apps->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$home_apps_view->Page_Terminate();
?>
