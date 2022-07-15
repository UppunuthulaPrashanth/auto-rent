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

$used_cars_view = NULL; // Initialize page object first

class cused_cars_view extends cused_cars {

	// Page ID
	var $PageID = 'view';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'used_cars';

	// Page object name
	var $PageObjName = 'used_cars_view';

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
		$KeyUrl = "";
		if (@$_GET["userCarID"] <> "") {
			$this->RecKey["userCarID"] = $_GET["userCarID"];
			$KeyUrl .= "&amp;userCarID=" . urlencode($this->RecKey["userCarID"]);
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
				$this->Page_Terminate(ew_GetUrl("used_carslist.php"));
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
		if (@$_GET["userCarID"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= $_GET["userCarID"];
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
		$this->userCarID->SetVisibility();
		if ($this->IsAdd() || $this->IsCopy() || $this->IsGridAdd())
			$this->userCarID->Visible = FALSE;
		$this->makeID->SetVisibility();
		$this->modelID->SetVisibility();
		$this->slug->SetVisibility();
		$this->yearID->SetVisibility();
		$this->kilometers->SetVisibility();
		$this->priceAED->SetVisibility();
		$this->priceUSD->SetVisibility();
		$this->priceOMR->SetVisibility();
		$this->priceSAR->SetVisibility();
		$this->description->SetVisibility();
		$this->fuelTypeID->SetVisibility();
		$this->regionalID->SetVisibility();
		$this->warrantyID->SetVisibility();
		$this->noOfDoors->SetVisibility();
		$this->transmissionTypeID->SetVisibility();
		$this->cylinderID->SetVisibility();
		$this->engine->SetVisibility();
		$this->colorID->SetVisibility();
		$this->bodyConditionID->SetVisibility();
		$this->summary->SetVisibility();
		$this->term->SetVisibility();
		$this->_thumbnail->SetVisibility();
		$this->img_01->SetVisibility();
		$this->img_02->SetVisibility();
		$this->img_03->SetVisibility();
		$this->img_04->SetVisibility();
		$this->img_05->SetVisibility();
		$this->img_06->SetVisibility();
		$this->img_07->SetVisibility();
		$this->img_08->SetVisibility();
		$this->img_09->SetVisibility();
		$this->img_10->SetVisibility();
		$this->img_11->SetVisibility();
		$this->img_12->SetVisibility();
		$this->extra_features->SetVisibility();
		$this->so->SetVisibility();
		$this->active->SetVisibility();

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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = ew_GetPageName($url);
				if ($pageName != $this->GetListUrl()) { // Not List page
					$row["caption"] = $this->GetModalCaption($pageName);
					if ($pageName == "used_carsview.php")
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
			if (@$_GET["userCarID"] <> "") {
				$this->userCarID->setQueryStringValue($_GET["userCarID"]);
				$this->RecKey["userCarID"] = $this->userCarID->QueryStringValue;
			} elseif (@$_POST["userCarID"] <> "") {
				$this->userCarID->setFormValue($_POST["userCarID"]);
				$this->RecKey["userCarID"] = $this->userCarID->FormValue;
			} else {
				$sReturnUrl = "used_carslist.php"; // Return to list
			}

			// Get action
			$this->CurrentAction = "I"; // Display form
			switch ($this->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "used_carslist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if ($this->CustomExport == "" && in_array($this->Export, array_keys($EW_EXPORT))) {
				$this->ExportData();
				$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "used_carslist.php"; // Not page request, return to list
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

		// summary
		$this->summary->ViewValue = $this->summary->CurrentValue;
		$this->summary->ViewCustomAttributes = "";

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

		// extra_features
		if (strval($this->extra_features->CurrentValue) <> "") {
			$arwrk = explode(",", $this->extra_features->CurrentValue);
			$sFilterWrk = "";
			foreach ($arwrk as $wrk) {
				if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
				$sFilterWrk .= "`featureID`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_NUMBER, "");
			}
		$sSqlWrk = "SELECT `featureID`, `extraFeatures` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_extra_features`";
		$sWhereWrk = "";
		$this->extra_features->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->extra_features, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->extra_features->ViewValue = "";
				$ari = 0;
				while (!$rswrk->EOF) {
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->extra_features->ViewValue .= $this->extra_features->DisplayValue($arwrk);
					$rswrk->MoveNext();
					if (!$rswrk->EOF) $this->extra_features->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
					$ari++;
				}
				$rswrk->Close();
			} else {
				$this->extra_features->ViewValue = $this->extra_features->CurrentValue;
			}
		} else {
			$this->extra_features->ViewValue = NULL;
		}
		$this->extra_features->ViewCustomAttributes = "";

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

			// priceUSD
			$this->priceUSD->LinkCustomAttributes = "";
			$this->priceUSD->HrefValue = "";
			$this->priceUSD->TooltipValue = "";

			// priceOMR
			$this->priceOMR->LinkCustomAttributes = "";
			$this->priceOMR->HrefValue = "";
			$this->priceOMR->TooltipValue = "";

			// priceSAR
			$this->priceSAR->LinkCustomAttributes = "";
			$this->priceSAR->HrefValue = "";
			$this->priceSAR->TooltipValue = "";

			// description
			$this->description->LinkCustomAttributes = "";
			$this->description->HrefValue = "";
			$this->description->TooltipValue = "";

			// fuelTypeID
			$this->fuelTypeID->LinkCustomAttributes = "";
			$this->fuelTypeID->HrefValue = "";
			$this->fuelTypeID->TooltipValue = "";

			// regionalID
			$this->regionalID->LinkCustomAttributes = "";
			$this->regionalID->HrefValue = "";
			$this->regionalID->TooltipValue = "";

			// warrantyID
			$this->warrantyID->LinkCustomAttributes = "";
			$this->warrantyID->HrefValue = "";
			$this->warrantyID->TooltipValue = "";

			// noOfDoors
			$this->noOfDoors->LinkCustomAttributes = "";
			$this->noOfDoors->HrefValue = "";
			$this->noOfDoors->TooltipValue = "";

			// transmissionTypeID
			$this->transmissionTypeID->LinkCustomAttributes = "";
			$this->transmissionTypeID->HrefValue = "";
			$this->transmissionTypeID->TooltipValue = "";

			// cylinderID
			$this->cylinderID->LinkCustomAttributes = "";
			$this->cylinderID->HrefValue = "";
			$this->cylinderID->TooltipValue = "";

			// engine
			$this->engine->LinkCustomAttributes = "";
			$this->engine->HrefValue = "";
			$this->engine->TooltipValue = "";

			// colorID
			$this->colorID->LinkCustomAttributes = "";
			$this->colorID->HrefValue = "";
			$this->colorID->TooltipValue = "";

			// bodyConditionID
			$this->bodyConditionID->LinkCustomAttributes = "";
			$this->bodyConditionID->HrefValue = "";
			$this->bodyConditionID->TooltipValue = "";

			// summary
			$this->summary->LinkCustomAttributes = "";
			$this->summary->HrefValue = "";
			$this->summary->TooltipValue = "";

			// term
			$this->term->LinkCustomAttributes = "";
			$this->term->HrefValue = "";
			$this->term->TooltipValue = "";

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
				$this->_thumbnail->LinkAttrs["data-rel"] = "used_cars_x__thumbnail";
				ew_AppendClass($this->_thumbnail->LinkAttrs["class"], "ewLightbox");
			}

			// img_01
			$this->img_01->LinkCustomAttributes = "";
			$this->img_01->UploadPath = 'uploads/usedcars';
			if (!ew_Empty($this->img_01->Upload->DbValue)) {
				$this->img_01->HrefValue = ew_GetFileUploadUrl($this->img_01, $this->img_01->Upload->DbValue); // Add prefix/suffix
				$this->img_01->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->img_01->HrefValue = ew_FullUrl($this->img_01->HrefValue, "href");
			} else {
				$this->img_01->HrefValue = "";
			}
			$this->img_01->HrefValue2 = $this->img_01->UploadPath . $this->img_01->Upload->DbValue;
			$this->img_01->TooltipValue = "";
			if ($this->img_01->UseColorbox) {
				if (ew_Empty($this->img_01->TooltipValue))
					$this->img_01->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->img_01->LinkAttrs["data-rel"] = "used_cars_x_img_01";
				ew_AppendClass($this->img_01->LinkAttrs["class"], "ewLightbox");
			}

			// img_02
			$this->img_02->LinkCustomAttributes = "";
			$this->img_02->UploadPath = 'uploads/usedcars';
			if (!ew_Empty($this->img_02->Upload->DbValue)) {
				$this->img_02->HrefValue = ew_GetFileUploadUrl($this->img_02, $this->img_02->Upload->DbValue); // Add prefix/suffix
				$this->img_02->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->img_02->HrefValue = ew_FullUrl($this->img_02->HrefValue, "href");
			} else {
				$this->img_02->HrefValue = "";
			}
			$this->img_02->HrefValue2 = $this->img_02->UploadPath . $this->img_02->Upload->DbValue;
			$this->img_02->TooltipValue = "";
			if ($this->img_02->UseColorbox) {
				if (ew_Empty($this->img_02->TooltipValue))
					$this->img_02->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->img_02->LinkAttrs["data-rel"] = "used_cars_x_img_02";
				ew_AppendClass($this->img_02->LinkAttrs["class"], "ewLightbox");
			}

			// img_03
			$this->img_03->LinkCustomAttributes = "";
			$this->img_03->UploadPath = 'uploads/usedcars';
			if (!ew_Empty($this->img_03->Upload->DbValue)) {
				$this->img_03->HrefValue = ew_GetFileUploadUrl($this->img_03, $this->img_03->Upload->DbValue); // Add prefix/suffix
				$this->img_03->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->img_03->HrefValue = ew_FullUrl($this->img_03->HrefValue, "href");
			} else {
				$this->img_03->HrefValue = "";
			}
			$this->img_03->HrefValue2 = $this->img_03->UploadPath . $this->img_03->Upload->DbValue;
			$this->img_03->TooltipValue = "";
			if ($this->img_03->UseColorbox) {
				if (ew_Empty($this->img_03->TooltipValue))
					$this->img_03->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->img_03->LinkAttrs["data-rel"] = "used_cars_x_img_03";
				ew_AppendClass($this->img_03->LinkAttrs["class"], "ewLightbox");
			}

			// img_04
			$this->img_04->LinkCustomAttributes = "";
			$this->img_04->UploadPath = 'uploads/usedcars';
			if (!ew_Empty($this->img_04->Upload->DbValue)) {
				$this->img_04->HrefValue = ew_GetFileUploadUrl($this->img_04, $this->img_04->Upload->DbValue); // Add prefix/suffix
				$this->img_04->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->img_04->HrefValue = ew_FullUrl($this->img_04->HrefValue, "href");
			} else {
				$this->img_04->HrefValue = "";
			}
			$this->img_04->HrefValue2 = $this->img_04->UploadPath . $this->img_04->Upload->DbValue;
			$this->img_04->TooltipValue = "";
			if ($this->img_04->UseColorbox) {
				if (ew_Empty($this->img_04->TooltipValue))
					$this->img_04->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->img_04->LinkAttrs["data-rel"] = "used_cars_x_img_04";
				ew_AppendClass($this->img_04->LinkAttrs["class"], "ewLightbox");
			}

			// img_05
			$this->img_05->LinkCustomAttributes = "";
			$this->img_05->UploadPath = 'uploads/usedcars';
			if (!ew_Empty($this->img_05->Upload->DbValue)) {
				$this->img_05->HrefValue = ew_GetFileUploadUrl($this->img_05, $this->img_05->Upload->DbValue); // Add prefix/suffix
				$this->img_05->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->img_05->HrefValue = ew_FullUrl($this->img_05->HrefValue, "href");
			} else {
				$this->img_05->HrefValue = "";
			}
			$this->img_05->HrefValue2 = $this->img_05->UploadPath . $this->img_05->Upload->DbValue;
			$this->img_05->TooltipValue = "";
			if ($this->img_05->UseColorbox) {
				if (ew_Empty($this->img_05->TooltipValue))
					$this->img_05->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->img_05->LinkAttrs["data-rel"] = "used_cars_x_img_05";
				ew_AppendClass($this->img_05->LinkAttrs["class"], "ewLightbox");
			}

			// img_06
			$this->img_06->LinkCustomAttributes = "";
			$this->img_06->UploadPath = 'uploads/usedcars';
			if (!ew_Empty($this->img_06->Upload->DbValue)) {
				$this->img_06->HrefValue = ew_GetFileUploadUrl($this->img_06, $this->img_06->Upload->DbValue); // Add prefix/suffix
				$this->img_06->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->img_06->HrefValue = ew_FullUrl($this->img_06->HrefValue, "href");
			} else {
				$this->img_06->HrefValue = "";
			}
			$this->img_06->HrefValue2 = $this->img_06->UploadPath . $this->img_06->Upload->DbValue;
			$this->img_06->TooltipValue = "";
			if ($this->img_06->UseColorbox) {
				if (ew_Empty($this->img_06->TooltipValue))
					$this->img_06->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->img_06->LinkAttrs["data-rel"] = "used_cars_x_img_06";
				ew_AppendClass($this->img_06->LinkAttrs["class"], "ewLightbox");
			}

			// img_07
			$this->img_07->LinkCustomAttributes = "";
			$this->img_07->UploadPath = 'uploads/usedcars';
			if (!ew_Empty($this->img_07->Upload->DbValue)) {
				$this->img_07->HrefValue = ew_GetFileUploadUrl($this->img_07, $this->img_07->Upload->DbValue); // Add prefix/suffix
				$this->img_07->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->img_07->HrefValue = ew_FullUrl($this->img_07->HrefValue, "href");
			} else {
				$this->img_07->HrefValue = "";
			}
			$this->img_07->HrefValue2 = $this->img_07->UploadPath . $this->img_07->Upload->DbValue;
			$this->img_07->TooltipValue = "";
			if ($this->img_07->UseColorbox) {
				if (ew_Empty($this->img_07->TooltipValue))
					$this->img_07->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->img_07->LinkAttrs["data-rel"] = "used_cars_x_img_07";
				ew_AppendClass($this->img_07->LinkAttrs["class"], "ewLightbox");
			}

			// img_08
			$this->img_08->LinkCustomAttributes = "";
			$this->img_08->UploadPath = 'uploads/usedcars';
			if (!ew_Empty($this->img_08->Upload->DbValue)) {
				$this->img_08->HrefValue = ew_GetFileUploadUrl($this->img_08, $this->img_08->Upload->DbValue); // Add prefix/suffix
				$this->img_08->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->img_08->HrefValue = ew_FullUrl($this->img_08->HrefValue, "href");
			} else {
				$this->img_08->HrefValue = "";
			}
			$this->img_08->HrefValue2 = $this->img_08->UploadPath . $this->img_08->Upload->DbValue;
			$this->img_08->TooltipValue = "";
			if ($this->img_08->UseColorbox) {
				if (ew_Empty($this->img_08->TooltipValue))
					$this->img_08->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->img_08->LinkAttrs["data-rel"] = "used_cars_x_img_08";
				ew_AppendClass($this->img_08->LinkAttrs["class"], "ewLightbox");
			}

			// img_09
			$this->img_09->LinkCustomAttributes = "";
			$this->img_09->UploadPath = 'uploads/usedcars';
			if (!ew_Empty($this->img_09->Upload->DbValue)) {
				$this->img_09->HrefValue = ew_GetFileUploadUrl($this->img_09, $this->img_09->Upload->DbValue); // Add prefix/suffix
				$this->img_09->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->img_09->HrefValue = ew_FullUrl($this->img_09->HrefValue, "href");
			} else {
				$this->img_09->HrefValue = "";
			}
			$this->img_09->HrefValue2 = $this->img_09->UploadPath . $this->img_09->Upload->DbValue;
			$this->img_09->TooltipValue = "";
			if ($this->img_09->UseColorbox) {
				if (ew_Empty($this->img_09->TooltipValue))
					$this->img_09->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->img_09->LinkAttrs["data-rel"] = "used_cars_x_img_09";
				ew_AppendClass($this->img_09->LinkAttrs["class"], "ewLightbox");
			}

			// img_10
			$this->img_10->LinkCustomAttributes = "";
			$this->img_10->UploadPath = 'uploads/usedcars';
			if (!ew_Empty($this->img_10->Upload->DbValue)) {
				$this->img_10->HrefValue = ew_GetFileUploadUrl($this->img_10, $this->img_10->Upload->DbValue); // Add prefix/suffix
				$this->img_10->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->img_10->HrefValue = ew_FullUrl($this->img_10->HrefValue, "href");
			} else {
				$this->img_10->HrefValue = "";
			}
			$this->img_10->HrefValue2 = $this->img_10->UploadPath . $this->img_10->Upload->DbValue;
			$this->img_10->TooltipValue = "";
			if ($this->img_10->UseColorbox) {
				if (ew_Empty($this->img_10->TooltipValue))
					$this->img_10->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->img_10->LinkAttrs["data-rel"] = "used_cars_x_img_10";
				ew_AppendClass($this->img_10->LinkAttrs["class"], "ewLightbox");
			}

			// img_11
			$this->img_11->LinkCustomAttributes = "";
			$this->img_11->UploadPath = 'uploads/usedcars';
			if (!ew_Empty($this->img_11->Upload->DbValue)) {
				$this->img_11->HrefValue = ew_GetFileUploadUrl($this->img_11, $this->img_11->Upload->DbValue); // Add prefix/suffix
				$this->img_11->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->img_11->HrefValue = ew_FullUrl($this->img_11->HrefValue, "href");
			} else {
				$this->img_11->HrefValue = "";
			}
			$this->img_11->HrefValue2 = $this->img_11->UploadPath . $this->img_11->Upload->DbValue;
			$this->img_11->TooltipValue = "";
			if ($this->img_11->UseColorbox) {
				if (ew_Empty($this->img_11->TooltipValue))
					$this->img_11->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->img_11->LinkAttrs["data-rel"] = "used_cars_x_img_11";
				ew_AppendClass($this->img_11->LinkAttrs["class"], "ewLightbox");
			}

			// img_12
			$this->img_12->LinkCustomAttributes = "";
			$this->img_12->UploadPath = 'uploads/usedcars';
			if (!ew_Empty($this->img_12->Upload->DbValue)) {
				$this->img_12->HrefValue = ew_GetFileUploadUrl($this->img_12, $this->img_12->Upload->DbValue); // Add prefix/suffix
				$this->img_12->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->img_12->HrefValue = ew_FullUrl($this->img_12->HrefValue, "href");
			} else {
				$this->img_12->HrefValue = "";
			}
			$this->img_12->HrefValue2 = $this->img_12->UploadPath . $this->img_12->Upload->DbValue;
			$this->img_12->TooltipValue = "";
			if ($this->img_12->UseColorbox) {
				if (ew_Empty($this->img_12->TooltipValue))
					$this->img_12->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->img_12->LinkAttrs["data-rel"] = "used_cars_x_img_12";
				ew_AppendClass($this->img_12->LinkAttrs["class"], "ewLightbox");
			}

			// extra_features
			$this->extra_features->LinkCustomAttributes = "";
			$this->extra_features->HrefValue = "";
			$this->extra_features->TooltipValue = "";

			// so
			$this->so->LinkCustomAttributes = "";
			$this->so->HrefValue = "";
			$this->so->TooltipValue = "";

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
		$item->Visible = TRUE;

		// Export to Email
		$item = &$this->ExportOptions->Add("email");
		$url = "";
		$item->Body = "<button id=\"emf_used_cars\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_used_cars',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.fused_carsview,key:" . ew_ArrayToJsonAttr($this->RecKey) . ",sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("used_carslist.php"), "", $this->TableVar, TRUE);
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
if (!isset($used_cars_view)) $used_cars_view = new cused_cars_view();

// Page init
$used_cars_view->Page_Init();

// Page main
$used_cars_view->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$used_cars_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($used_cars->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "view";
var CurrentForm = fused_carsview = new ew_Form("fused_carsview", "view");

// Form_CustomValidate event
fused_carsview.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fused_carsview.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Multi-Page
fused_carsview.MultiPage = new ew_MultiPage("fused_carsview");

// Dynamic selection lists
fused_carsview.Lists["x_makeID"] = {"LinkField":"x_makeID","Ajax":true,"AutoFill":false,"DisplayFields":["x_make","","",""],"ParentFields":[],"ChildFields":["x_modelID"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_make"};
fused_carsview.Lists["x_makeID"].Data = "<?php echo $used_cars_view->makeID->LookupFilterQuery(FALSE, "view") ?>";
fused_carsview.Lists["x_modelID"] = {"LinkField":"x_modelID","Ajax":true,"AutoFill":false,"DisplayFields":["x_model","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_model"};
fused_carsview.Lists["x_modelID"].Data = "<?php echo $used_cars_view->modelID->LookupFilterQuery(FALSE, "view") ?>";
fused_carsview.Lists["x_yearID"] = {"LinkField":"x_yearID","Ajax":true,"AutoFill":false,"DisplayFields":["x_year","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_year"};
fused_carsview.Lists["x_yearID"].Data = "<?php echo $used_cars_view->yearID->LookupFilterQuery(FALSE, "view") ?>";
fused_carsview.Lists["x_fuelTypeID"] = {"LinkField":"x_fuelTypeID","Ajax":true,"AutoFill":false,"DisplayFields":["x_fuelType","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_fuel_type"};
fused_carsview.Lists["x_fuelTypeID"].Data = "<?php echo $used_cars_view->fuelTypeID->LookupFilterQuery(FALSE, "view") ?>";
fused_carsview.Lists["x_regionalID"] = {"LinkField":"x_regionalID","Ajax":true,"AutoFill":false,"DisplayFields":["x_regionalSpecs","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_regional_spec"};
fused_carsview.Lists["x_regionalID"].Data = "<?php echo $used_cars_view->regionalID->LookupFilterQuery(FALSE, "view") ?>";
fused_carsview.Lists["x_warrantyID"] = {"LinkField":"x_warrantyID","Ajax":true,"AutoFill":false,"DisplayFields":["x_warrantyName","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_warranty"};
fused_carsview.Lists["x_warrantyID"].Data = "<?php echo $used_cars_view->warrantyID->LookupFilterQuery(FALSE, "view") ?>";
fused_carsview.Lists["x_transmissionTypeID"] = {"LinkField":"x_transmissionID","Ajax":true,"AutoFill":false,"DisplayFields":["x_transmission","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_transmission"};
fused_carsview.Lists["x_transmissionTypeID"].Data = "<?php echo $used_cars_view->transmissionTypeID->LookupFilterQuery(FALSE, "view") ?>";
fused_carsview.Lists["x_cylinderID"] = {"LinkField":"x_cylinderID","Ajax":true,"AutoFill":false,"DisplayFields":["x_cylinder","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_cylinder"};
fused_carsview.Lists["x_cylinderID"].Data = "<?php echo $used_cars_view->cylinderID->LookupFilterQuery(FALSE, "view") ?>";
fused_carsview.Lists["x_colorID"] = {"LinkField":"x_colorID","Ajax":true,"AutoFill":false,"DisplayFields":["x_color","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_color"};
fused_carsview.Lists["x_colorID"].Data = "<?php echo $used_cars_view->colorID->LookupFilterQuery(FALSE, "view") ?>";
fused_carsview.Lists["x_bodyConditionID"] = {"LinkField":"x_bodyConditionID","Ajax":true,"AutoFill":false,"DisplayFields":["x_bodyCondition","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_body_condition"};
fused_carsview.Lists["x_bodyConditionID"].Data = "<?php echo $used_cars_view->bodyConditionID->LookupFilterQuery(FALSE, "view") ?>";
fused_carsview.Lists["x_term"] = {"LinkField":"x_termID","Ajax":true,"AutoFill":false,"DisplayFields":["x_term","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_term"};
fused_carsview.Lists["x_term"].Data = "<?php echo $used_cars_view->term->LookupFilterQuery(FALSE, "view") ?>";
fused_carsview.Lists["x_extra_features[]"] = {"LinkField":"x_featureID","Ajax":true,"AutoFill":false,"DisplayFields":["x_extraFeatures","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_extra_features"};
fused_carsview.Lists["x_extra_features[]"].Data = "<?php echo $used_cars_view->extra_features->LookupFilterQuery(FALSE, "view") ?>";
fused_carsview.Lists["x_active"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fused_carsview.Lists["x_active"].Options = <?php echo json_encode($used_cars_view->active->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($used_cars->Export == "") { ?>
<div class="ewToolbar">
<?php $used_cars_view->ExportOptions->Render("body") ?>
<?php
	foreach ($used_cars_view->OtherOptions as &$option)
		$option->Render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $used_cars_view->ShowPageHeader(); ?>
<?php
$used_cars_view->ShowMessage();
?>
<form name="fused_carsview" id="fused_carsview" class="form-inline ewForm ewViewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($used_cars_view->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $used_cars_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="used_cars">
<input type="hidden" name="modal" value="<?php echo intval($used_cars_view->IsModal) ?>">
<?php if ($used_cars->Export == "") { ?>
<div class="ewMultiPage">
<div class="nav-tabs-custom" id="used_cars_view">
	<ul class="nav<?php echo $used_cars_view->MultiPages->NavStyle() ?>">
		<li<?php echo $used_cars_view->MultiPages->TabStyle("1") ?>><a href="#tab_used_cars1" data-toggle="tab"><?php echo $used_cars->PageCaption(1) ?></a></li>
		<li<?php echo $used_cars_view->MultiPages->TabStyle("2") ?>><a href="#tab_used_cars2" data-toggle="tab"><?php echo $used_cars->PageCaption(2) ?></a></li>
		<li<?php echo $used_cars_view->MultiPages->TabStyle("3") ?>><a href="#tab_used_cars3" data-toggle="tab"><?php echo $used_cars->PageCaption(3) ?></a></li>
		<li<?php echo $used_cars_view->MultiPages->TabStyle("4") ?>><a href="#tab_used_cars4" data-toggle="tab"><?php echo $used_cars->PageCaption(4) ?></a></li>
	</ul>
	<div class="tab-content">
<?php } ?>
<?php if ($used_cars->Export == "") { ?>
		<div class="tab-pane<?php echo $used_cars_view->MultiPages->PageStyle("1") ?>" id="tab_used_cars1">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($used_cars->userCarID->Visible) { // userCarID ?>
	<tr id="r_userCarID">
		<td class="col-sm-2"><span id="elh_used_cars_userCarID"><?php echo $used_cars->userCarID->FldCaption() ?></span></td>
		<td data-name="userCarID"<?php echo $used_cars->userCarID->CellAttributes() ?>>
<span id="el_used_cars_userCarID" data-page="1">
<span<?php echo $used_cars->userCarID->ViewAttributes() ?>>
<?php echo $used_cars->userCarID->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->makeID->Visible) { // makeID ?>
	<tr id="r_makeID">
		<td class="col-sm-2"><span id="elh_used_cars_makeID"><?php echo $used_cars->makeID->FldCaption() ?></span></td>
		<td data-name="makeID"<?php echo $used_cars->makeID->CellAttributes() ?>>
<span id="el_used_cars_makeID" data-page="1">
<span<?php echo $used_cars->makeID->ViewAttributes() ?>>
<?php echo $used_cars->makeID->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->modelID->Visible) { // modelID ?>
	<tr id="r_modelID">
		<td class="col-sm-2"><span id="elh_used_cars_modelID"><?php echo $used_cars->modelID->FldCaption() ?></span></td>
		<td data-name="modelID"<?php echo $used_cars->modelID->CellAttributes() ?>>
<span id="el_used_cars_modelID" data-page="1">
<span<?php echo $used_cars->modelID->ViewAttributes() ?>>
<?php echo $used_cars->modelID->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->slug->Visible) { // slug ?>
	<tr id="r_slug">
		<td class="col-sm-2"><span id="elh_used_cars_slug"><?php echo $used_cars->slug->FldCaption() ?></span></td>
		<td data-name="slug"<?php echo $used_cars->slug->CellAttributes() ?>>
<span id="el_used_cars_slug" data-page="1">
<span<?php echo $used_cars->slug->ViewAttributes() ?>>
<?php echo $used_cars->slug->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->yearID->Visible) { // yearID ?>
	<tr id="r_yearID">
		<td class="col-sm-2"><span id="elh_used_cars_yearID"><?php echo $used_cars->yearID->FldCaption() ?></span></td>
		<td data-name="yearID"<?php echo $used_cars->yearID->CellAttributes() ?>>
<span id="el_used_cars_yearID" data-page="1">
<span<?php echo $used_cars->yearID->ViewAttributes() ?>>
<?php echo $used_cars->yearID->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->kilometers->Visible) { // kilometers ?>
	<tr id="r_kilometers">
		<td class="col-sm-2"><span id="elh_used_cars_kilometers"><?php echo $used_cars->kilometers->FldCaption() ?></span></td>
		<td data-name="kilometers"<?php echo $used_cars->kilometers->CellAttributes() ?>>
<span id="el_used_cars_kilometers" data-page="1">
<span<?php echo $used_cars->kilometers->ViewAttributes() ?>>
<?php echo $used_cars->kilometers->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->priceAED->Visible) { // priceAED ?>
	<tr id="r_priceAED">
		<td class="col-sm-2"><span id="elh_used_cars_priceAED"><?php echo $used_cars->priceAED->FldCaption() ?></span></td>
		<td data-name="priceAED"<?php echo $used_cars->priceAED->CellAttributes() ?>>
<span id="el_used_cars_priceAED" data-page="1">
<span<?php echo $used_cars->priceAED->ViewAttributes() ?>>
<?php echo $used_cars->priceAED->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->priceUSD->Visible) { // priceUSD ?>
	<tr id="r_priceUSD">
		<td class="col-sm-2"><span id="elh_used_cars_priceUSD"><?php echo $used_cars->priceUSD->FldCaption() ?></span></td>
		<td data-name="priceUSD"<?php echo $used_cars->priceUSD->CellAttributes() ?>>
<span id="el_used_cars_priceUSD" data-page="1">
<span<?php echo $used_cars->priceUSD->ViewAttributes() ?>>
<?php echo $used_cars->priceUSD->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->priceOMR->Visible) { // priceOMR ?>
	<tr id="r_priceOMR">
		<td class="col-sm-2"><span id="elh_used_cars_priceOMR"><?php echo $used_cars->priceOMR->FldCaption() ?></span></td>
		<td data-name="priceOMR"<?php echo $used_cars->priceOMR->CellAttributes() ?>>
<span id="el_used_cars_priceOMR" data-page="1">
<span<?php echo $used_cars->priceOMR->ViewAttributes() ?>>
<?php echo $used_cars->priceOMR->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->priceSAR->Visible) { // priceSAR ?>
	<tr id="r_priceSAR">
		<td class="col-sm-2"><span id="elh_used_cars_priceSAR"><?php echo $used_cars->priceSAR->FldCaption() ?></span></td>
		<td data-name="priceSAR"<?php echo $used_cars->priceSAR->CellAttributes() ?>>
<span id="el_used_cars_priceSAR" data-page="1">
<span<?php echo $used_cars->priceSAR->ViewAttributes() ?>>
<?php echo $used_cars->priceSAR->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->so->Visible) { // so ?>
	<tr id="r_so">
		<td class="col-sm-2"><span id="elh_used_cars_so"><?php echo $used_cars->so->FldCaption() ?></span></td>
		<td data-name="so"<?php echo $used_cars->so->CellAttributes() ?>>
<span id="el_used_cars_so" data-page="1">
<span<?php echo $used_cars->so->ViewAttributes() ?>>
<?php echo $used_cars->so->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->active->Visible) { // active ?>
	<tr id="r_active">
		<td class="col-sm-2"><span id="elh_used_cars_active"><?php echo $used_cars->active->FldCaption() ?></span></td>
		<td data-name="active"<?php echo $used_cars->active->CellAttributes() ?>>
<span id="el_used_cars_active" data-page="1">
<span<?php echo $used_cars->active->ViewAttributes() ?>>
<?php echo $used_cars->active->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($used_cars->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($used_cars->Export == "") { ?>
		<div class="tab-pane<?php echo $used_cars_view->MultiPages->PageStyle("2") ?>" id="tab_used_cars2">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($used_cars->description->Visible) { // description ?>
	<tr id="r_description">
		<td class="col-sm-2"><span id="elh_used_cars_description"><?php echo $used_cars->description->FldCaption() ?></span></td>
		<td data-name="description"<?php echo $used_cars->description->CellAttributes() ?>>
<span id="el_used_cars_description" data-page="2">
<span<?php echo $used_cars->description->ViewAttributes() ?>>
<?php echo $used_cars->description->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->fuelTypeID->Visible) { // fuelTypeID ?>
	<tr id="r_fuelTypeID">
		<td class="col-sm-2"><span id="elh_used_cars_fuelTypeID"><?php echo $used_cars->fuelTypeID->FldCaption() ?></span></td>
		<td data-name="fuelTypeID"<?php echo $used_cars->fuelTypeID->CellAttributes() ?>>
<span id="el_used_cars_fuelTypeID" data-page="2">
<span<?php echo $used_cars->fuelTypeID->ViewAttributes() ?>>
<?php echo $used_cars->fuelTypeID->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->regionalID->Visible) { // regionalID ?>
	<tr id="r_regionalID">
		<td class="col-sm-2"><span id="elh_used_cars_regionalID"><?php echo $used_cars->regionalID->FldCaption() ?></span></td>
		<td data-name="regionalID"<?php echo $used_cars->regionalID->CellAttributes() ?>>
<span id="el_used_cars_regionalID" data-page="2">
<span<?php echo $used_cars->regionalID->ViewAttributes() ?>>
<?php echo $used_cars->regionalID->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->warrantyID->Visible) { // warrantyID ?>
	<tr id="r_warrantyID">
		<td class="col-sm-2"><span id="elh_used_cars_warrantyID"><?php echo $used_cars->warrantyID->FldCaption() ?></span></td>
		<td data-name="warrantyID"<?php echo $used_cars->warrantyID->CellAttributes() ?>>
<span id="el_used_cars_warrantyID" data-page="2">
<span<?php echo $used_cars->warrantyID->ViewAttributes() ?>>
<?php echo $used_cars->warrantyID->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->noOfDoors->Visible) { // noOfDoors ?>
	<tr id="r_noOfDoors">
		<td class="col-sm-2"><span id="elh_used_cars_noOfDoors"><?php echo $used_cars->noOfDoors->FldCaption() ?></span></td>
		<td data-name="noOfDoors"<?php echo $used_cars->noOfDoors->CellAttributes() ?>>
<span id="el_used_cars_noOfDoors" data-page="2">
<span<?php echo $used_cars->noOfDoors->ViewAttributes() ?>>
<?php echo $used_cars->noOfDoors->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->transmissionTypeID->Visible) { // transmissionTypeID ?>
	<tr id="r_transmissionTypeID">
		<td class="col-sm-2"><span id="elh_used_cars_transmissionTypeID"><?php echo $used_cars->transmissionTypeID->FldCaption() ?></span></td>
		<td data-name="transmissionTypeID"<?php echo $used_cars->transmissionTypeID->CellAttributes() ?>>
<span id="el_used_cars_transmissionTypeID" data-page="2">
<span<?php echo $used_cars->transmissionTypeID->ViewAttributes() ?>>
<?php echo $used_cars->transmissionTypeID->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->cylinderID->Visible) { // cylinderID ?>
	<tr id="r_cylinderID">
		<td class="col-sm-2"><span id="elh_used_cars_cylinderID"><?php echo $used_cars->cylinderID->FldCaption() ?></span></td>
		<td data-name="cylinderID"<?php echo $used_cars->cylinderID->CellAttributes() ?>>
<span id="el_used_cars_cylinderID" data-page="2">
<span<?php echo $used_cars->cylinderID->ViewAttributes() ?>>
<?php echo $used_cars->cylinderID->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->engine->Visible) { // engine ?>
	<tr id="r_engine">
		<td class="col-sm-2"><span id="elh_used_cars_engine"><?php echo $used_cars->engine->FldCaption() ?></span></td>
		<td data-name="engine"<?php echo $used_cars->engine->CellAttributes() ?>>
<span id="el_used_cars_engine" data-page="2">
<span<?php echo $used_cars->engine->ViewAttributes() ?>>
<?php echo $used_cars->engine->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->colorID->Visible) { // colorID ?>
	<tr id="r_colorID">
		<td class="col-sm-2"><span id="elh_used_cars_colorID"><?php echo $used_cars->colorID->FldCaption() ?></span></td>
		<td data-name="colorID"<?php echo $used_cars->colorID->CellAttributes() ?>>
<span id="el_used_cars_colorID" data-page="2">
<span<?php echo $used_cars->colorID->ViewAttributes() ?>>
<?php echo $used_cars->colorID->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->bodyConditionID->Visible) { // bodyConditionID ?>
	<tr id="r_bodyConditionID">
		<td class="col-sm-2"><span id="elh_used_cars_bodyConditionID"><?php echo $used_cars->bodyConditionID->FldCaption() ?></span></td>
		<td data-name="bodyConditionID"<?php echo $used_cars->bodyConditionID->CellAttributes() ?>>
<span id="el_used_cars_bodyConditionID" data-page="2">
<span<?php echo $used_cars->bodyConditionID->ViewAttributes() ?>>
<?php echo $used_cars->bodyConditionID->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->summary->Visible) { // summary ?>
	<tr id="r_summary">
		<td class="col-sm-2"><span id="elh_used_cars_summary"><?php echo $used_cars->summary->FldCaption() ?></span></td>
		<td data-name="summary"<?php echo $used_cars->summary->CellAttributes() ?>>
<span id="el_used_cars_summary" data-page="2">
<span<?php echo $used_cars->summary->ViewAttributes() ?>>
<?php echo $used_cars->summary->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->term->Visible) { // term ?>
	<tr id="r_term">
		<td class="col-sm-2"><span id="elh_used_cars_term"><?php echo $used_cars->term->FldCaption() ?></span></td>
		<td data-name="term"<?php echo $used_cars->term->CellAttributes() ?>>
<span id="el_used_cars_term" data-page="2">
<span<?php echo $used_cars->term->ViewAttributes() ?>>
<?php echo $used_cars->term->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($used_cars->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($used_cars->Export == "") { ?>
		<div class="tab-pane<?php echo $used_cars_view->MultiPages->PageStyle("3") ?>" id="tab_used_cars3">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($used_cars->_thumbnail->Visible) { // thumbnail ?>
	<tr id="r__thumbnail">
		<td class="col-sm-2"><span id="elh_used_cars__thumbnail"><?php echo $used_cars->_thumbnail->FldCaption() ?></span></td>
		<td data-name="_thumbnail"<?php echo $used_cars->_thumbnail->CellAttributes() ?>>
<span id="el_used_cars__thumbnail" data-page="3">
<span>
<?php echo ew_GetFileViewTag($used_cars->_thumbnail, $used_cars->_thumbnail->ViewValue) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->img_01->Visible) { // img_01 ?>
	<tr id="r_img_01">
		<td class="col-sm-2"><span id="elh_used_cars_img_01"><?php echo $used_cars->img_01->FldCaption() ?></span></td>
		<td data-name="img_01"<?php echo $used_cars->img_01->CellAttributes() ?>>
<span id="el_used_cars_img_01" data-page="3">
<span>
<?php echo ew_GetFileViewTag($used_cars->img_01, $used_cars->img_01->ViewValue) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->img_02->Visible) { // img_02 ?>
	<tr id="r_img_02">
		<td class="col-sm-2"><span id="elh_used_cars_img_02"><?php echo $used_cars->img_02->FldCaption() ?></span></td>
		<td data-name="img_02"<?php echo $used_cars->img_02->CellAttributes() ?>>
<span id="el_used_cars_img_02" data-page="3">
<span>
<?php echo ew_GetFileViewTag($used_cars->img_02, $used_cars->img_02->ViewValue) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->img_03->Visible) { // img_03 ?>
	<tr id="r_img_03">
		<td class="col-sm-2"><span id="elh_used_cars_img_03"><?php echo $used_cars->img_03->FldCaption() ?></span></td>
		<td data-name="img_03"<?php echo $used_cars->img_03->CellAttributes() ?>>
<span id="el_used_cars_img_03" data-page="3">
<span>
<?php echo ew_GetFileViewTag($used_cars->img_03, $used_cars->img_03->ViewValue) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->img_04->Visible) { // img_04 ?>
	<tr id="r_img_04">
		<td class="col-sm-2"><span id="elh_used_cars_img_04"><?php echo $used_cars->img_04->FldCaption() ?></span></td>
		<td data-name="img_04"<?php echo $used_cars->img_04->CellAttributes() ?>>
<span id="el_used_cars_img_04" data-page="3">
<span>
<?php echo ew_GetFileViewTag($used_cars->img_04, $used_cars->img_04->ViewValue) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->img_05->Visible) { // img_05 ?>
	<tr id="r_img_05">
		<td class="col-sm-2"><span id="elh_used_cars_img_05"><?php echo $used_cars->img_05->FldCaption() ?></span></td>
		<td data-name="img_05"<?php echo $used_cars->img_05->CellAttributes() ?>>
<span id="el_used_cars_img_05" data-page="3">
<span>
<?php echo ew_GetFileViewTag($used_cars->img_05, $used_cars->img_05->ViewValue) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->img_06->Visible) { // img_06 ?>
	<tr id="r_img_06">
		<td class="col-sm-2"><span id="elh_used_cars_img_06"><?php echo $used_cars->img_06->FldCaption() ?></span></td>
		<td data-name="img_06"<?php echo $used_cars->img_06->CellAttributes() ?>>
<span id="el_used_cars_img_06" data-page="3">
<span>
<?php echo ew_GetFileViewTag($used_cars->img_06, $used_cars->img_06->ViewValue) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->img_07->Visible) { // img_07 ?>
	<tr id="r_img_07">
		<td class="col-sm-2"><span id="elh_used_cars_img_07"><?php echo $used_cars->img_07->FldCaption() ?></span></td>
		<td data-name="img_07"<?php echo $used_cars->img_07->CellAttributes() ?>>
<span id="el_used_cars_img_07" data-page="3">
<span>
<?php echo ew_GetFileViewTag($used_cars->img_07, $used_cars->img_07->ViewValue) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->img_08->Visible) { // img_08 ?>
	<tr id="r_img_08">
		<td class="col-sm-2"><span id="elh_used_cars_img_08"><?php echo $used_cars->img_08->FldCaption() ?></span></td>
		<td data-name="img_08"<?php echo $used_cars->img_08->CellAttributes() ?>>
<span id="el_used_cars_img_08" data-page="3">
<span>
<?php echo ew_GetFileViewTag($used_cars->img_08, $used_cars->img_08->ViewValue) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->img_09->Visible) { // img_09 ?>
	<tr id="r_img_09">
		<td class="col-sm-2"><span id="elh_used_cars_img_09"><?php echo $used_cars->img_09->FldCaption() ?></span></td>
		<td data-name="img_09"<?php echo $used_cars->img_09->CellAttributes() ?>>
<span id="el_used_cars_img_09" data-page="3">
<span>
<?php echo ew_GetFileViewTag($used_cars->img_09, $used_cars->img_09->ViewValue) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->img_10->Visible) { // img_10 ?>
	<tr id="r_img_10">
		<td class="col-sm-2"><span id="elh_used_cars_img_10"><?php echo $used_cars->img_10->FldCaption() ?></span></td>
		<td data-name="img_10"<?php echo $used_cars->img_10->CellAttributes() ?>>
<span id="el_used_cars_img_10" data-page="3">
<span>
<?php echo ew_GetFileViewTag($used_cars->img_10, $used_cars->img_10->ViewValue) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->img_11->Visible) { // img_11 ?>
	<tr id="r_img_11">
		<td class="col-sm-2"><span id="elh_used_cars_img_11"><?php echo $used_cars->img_11->FldCaption() ?></span></td>
		<td data-name="img_11"<?php echo $used_cars->img_11->CellAttributes() ?>>
<span id="el_used_cars_img_11" data-page="3">
<span>
<?php echo ew_GetFileViewTag($used_cars->img_11, $used_cars->img_11->ViewValue) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($used_cars->img_12->Visible) { // img_12 ?>
	<tr id="r_img_12">
		<td class="col-sm-2"><span id="elh_used_cars_img_12"><?php echo $used_cars->img_12->FldCaption() ?></span></td>
		<td data-name="img_12"<?php echo $used_cars->img_12->CellAttributes() ?>>
<span id="el_used_cars_img_12" data-page="3">
<span>
<?php echo ew_GetFileViewTag($used_cars->img_12, $used_cars->img_12->ViewValue) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($used_cars->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($used_cars->Export == "") { ?>
		<div class="tab-pane<?php echo $used_cars_view->MultiPages->PageStyle("4") ?>" id="tab_used_cars4">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($used_cars->extra_features->Visible) { // extra_features ?>
	<tr id="r_extra_features">
		<td class="col-sm-2"><span id="elh_used_cars_extra_features"><?php echo $used_cars->extra_features->FldCaption() ?></span></td>
		<td data-name="extra_features"<?php echo $used_cars->extra_features->CellAttributes() ?>>
<span id="el_used_cars_extra_features" data-page="4">
<span<?php echo $used_cars->extra_features->ViewAttributes() ?>>
<?php echo $used_cars->extra_features->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($used_cars->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($used_cars->Export == "") { ?>
	</div>
</div>
</div>
<?php } ?>
</form>
<?php if ($used_cars->Export == "") { ?>
<script type="text/javascript">
fused_carsview.Init();
</script>
<?php } ?>
<?php
$used_cars_view->ShowPageFooter();
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
$used_cars_view->Page_Terminate();
?>
