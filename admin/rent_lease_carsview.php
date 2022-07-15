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

$rent_lease_cars_view = NULL; // Initialize page object first

class crent_lease_cars_view extends crent_lease_cars {

	// Page ID
	var $PageID = 'view';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'rent_lease_cars';

	// Page object name
	var $PageObjName = 'rent_lease_cars_view';

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
		$KeyUrl = "";
		if (@$_GET["rentLeaseCarID"] <> "") {
			$this->RecKey["rentLeaseCarID"] = $_GET["rentLeaseCarID"];
			$KeyUrl .= "&amp;rentLeaseCarID=" . urlencode($this->RecKey["rentLeaseCarID"]);
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
				$this->Page_Terminate(ew_GetUrl("rent_lease_carslist.php"));
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
		if (@$_GET["rentLeaseCarID"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= $_GET["rentLeaseCarID"];
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
		$this->rentLeaseCarID->SetVisibility();
		$this->rentLeaseCarID->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
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
		$this->deliveryAED->SetVisibility();
		$this->dailyAED->SetVisibility();
		$this->dailyDummyAED->SetVisibility();
		$this->weeklyAED->SetVisibility();
		$this->weeklyDummyAED->SetVisibility();
		$this->monthlyAED->SetVisibility();
		$this->monthlyDummyAED->SetVisibility();
		$this->active->SetVisibility();
		$this->phase1OrangeCard->SetVisibility();
		$this->phase1GPS->SetVisibility();
		$this->phase1DeliveryCharges->SetVisibility();
		$this->phase1CollectionCharges->SetVisibility();
		$this->weeklyDeals->SetVisibility();

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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = ew_GetPageName($url);
				if ($pageName != $this->GetListUrl()) { // Not List page
					$row["caption"] = $this->GetModalCaption($pageName);
					if ($pageName == "rent_lease_carsview.php")
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
			if (@$_GET["rentLeaseCarID"] <> "") {
				$this->rentLeaseCarID->setQueryStringValue($_GET["rentLeaseCarID"]);
				$this->RecKey["rentLeaseCarID"] = $this->rentLeaseCarID->QueryStringValue;
			} elseif (@$_POST["rentLeaseCarID"] <> "") {
				$this->rentLeaseCarID->setFormValue($_POST["rentLeaseCarID"]);
				$this->RecKey["rentLeaseCarID"] = $this->rentLeaseCarID->FormValue;
			} else {
				$sReturnUrl = "rent_lease_carslist.php"; // Return to list
			}

			// Get action
			$this->CurrentAction = "I"; // Display form
			switch ($this->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "rent_lease_carslist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if ($this->CustomExport == "" && in_array($this->Export, array_keys($EW_EXPORT))) {
				$this->ExportData();
				$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "rent_lease_carslist.php"; // Not page request, return to list
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
		if ($this->deliveryAED->FormValue == $this->deliveryAED->CurrentValue && is_numeric(ew_StrToFloat($this->deliveryAED->CurrentValue)))
			$this->deliveryAED->CurrentValue = ew_StrToFloat($this->deliveryAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->dailyAED->FormValue == $this->dailyAED->CurrentValue && is_numeric(ew_StrToFloat($this->dailyAED->CurrentValue)))
			$this->dailyAED->CurrentValue = ew_StrToFloat($this->dailyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->dailyDummyAED->FormValue == $this->dailyDummyAED->CurrentValue && is_numeric(ew_StrToFloat($this->dailyDummyAED->CurrentValue)))
			$this->dailyDummyAED->CurrentValue = ew_StrToFloat($this->dailyDummyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->weeklyAED->FormValue == $this->weeklyAED->CurrentValue && is_numeric(ew_StrToFloat($this->weeklyAED->CurrentValue)))
			$this->weeklyAED->CurrentValue = ew_StrToFloat($this->weeklyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->weeklyDummyAED->FormValue == $this->weeklyDummyAED->CurrentValue && is_numeric(ew_StrToFloat($this->weeklyDummyAED->CurrentValue)))
			$this->weeklyDummyAED->CurrentValue = ew_StrToFloat($this->weeklyDummyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->monthlyAED->FormValue == $this->monthlyAED->CurrentValue && is_numeric(ew_StrToFloat($this->monthlyAED->CurrentValue)))
			$this->monthlyAED->CurrentValue = ew_StrToFloat($this->monthlyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->monthlyDummyAED->FormValue == $this->monthlyDummyAED->CurrentValue && is_numeric(ew_StrToFloat($this->monthlyDummyAED->CurrentValue)))
			$this->monthlyDummyAED->CurrentValue = ew_StrToFloat($this->monthlyDummyAED->CurrentValue);

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
				$this->image->LinkAttrs["data-rel"] = "rent_lease_cars_x_image";
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

			// deliveryAED
			$this->deliveryAED->LinkCustomAttributes = "";
			$this->deliveryAED->HrefValue = "";
			$this->deliveryAED->TooltipValue = "";

			// dailyAED
			$this->dailyAED->LinkCustomAttributes = "";
			$this->dailyAED->HrefValue = "";
			$this->dailyAED->TooltipValue = "";

			// dailyDummyAED
			$this->dailyDummyAED->LinkCustomAttributes = "";
			$this->dailyDummyAED->HrefValue = "";
			$this->dailyDummyAED->TooltipValue = "";

			// weeklyAED
			$this->weeklyAED->LinkCustomAttributes = "";
			$this->weeklyAED->HrefValue = "";
			$this->weeklyAED->TooltipValue = "";

			// weeklyDummyAED
			$this->weeklyDummyAED->LinkCustomAttributes = "";
			$this->weeklyDummyAED->HrefValue = "";
			$this->weeklyDummyAED->TooltipValue = "";

			// monthlyAED
			$this->monthlyAED->LinkCustomAttributes = "";
			$this->monthlyAED->HrefValue = "";
			$this->monthlyAED->TooltipValue = "";

			// monthlyDummyAED
			$this->monthlyDummyAED->LinkCustomAttributes = "";
			$this->monthlyDummyAED->HrefValue = "";
			$this->monthlyDummyAED->TooltipValue = "";

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
		$item->Visible = TRUE;

		// Export to Email
		$item = &$this->ExportOptions->Add("email");
		$url = "";
		$item->Body = "<button id=\"emf_rent_lease_cars\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_rent_lease_cars',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.frent_lease_carsview,key:" . ew_ArrayToJsonAttr($this->RecKey) . ",sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("rent_lease_carslist.php"), "", $this->TableVar, TRUE);
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
if (!isset($rent_lease_cars_view)) $rent_lease_cars_view = new crent_lease_cars_view();

// Page init
$rent_lease_cars_view->Page_Init();

// Page main
$rent_lease_cars_view->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rent_lease_cars_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($rent_lease_cars->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "view";
var CurrentForm = frent_lease_carsview = new ew_Form("frent_lease_carsview", "view");

// Form_CustomValidate event
frent_lease_carsview.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frent_lease_carsview.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Multi-Page
frent_lease_carsview.MultiPage = new ew_MultiPage("frent_lease_carsview");

// Dynamic selection lists
frent_lease_carsview.Lists["x_bodyTypeID"] = {"LinkField":"x_bodyTypeID","Ajax":true,"AutoFill":false,"DisplayFields":["x_bodytype","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_bodytype"};
frent_lease_carsview.Lists["x_bodyTypeID"].Data = "<?php echo $rent_lease_cars_view->bodyTypeID->LookupFilterQuery(FALSE, "view") ?>";
frent_lease_carsview.Lists["x_extraFeatures[]"] = {"LinkField":"x_featureID","Ajax":true,"AutoFill":false,"DisplayFields":["x_extraFeatures","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_extra_features"};
frent_lease_carsview.Lists["x_extraFeatures[]"].Data = "<?php echo $rent_lease_cars_view->extraFeatures->LookupFilterQuery(FALSE, "view") ?>";
frent_lease_carsview.Lists["x_transmissionID"] = {"LinkField":"x_transmissionID","Ajax":true,"AutoFill":false,"DisplayFields":["x_transmission","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_transmission"};
frent_lease_carsview.Lists["x_transmissionID"].Data = "<?php echo $rent_lease_cars_view->transmissionID->LookupFilterQuery(FALSE, "view") ?>";
frent_lease_carsview.Lists["x_ac[]"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
frent_lease_carsview.Lists["x_ac[]"].Options = <?php echo json_encode($rent_lease_cars_view->ac->Options()) ?>;
frent_lease_carsview.Lists["x_active"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
frent_lease_carsview.Lists["x_active"].Options = <?php echo json_encode($rent_lease_cars_view->active->Options()) ?>;
frent_lease_carsview.Lists["x_weeklyDeals"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
frent_lease_carsview.Lists["x_weeklyDeals"].Options = <?php echo json_encode($rent_lease_cars_view->weeklyDeals->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($rent_lease_cars->Export == "") { ?>
<div class="ewToolbar">
<?php $rent_lease_cars_view->ExportOptions->Render("body") ?>
<?php
	foreach ($rent_lease_cars_view->OtherOptions as &$option)
		$option->Render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $rent_lease_cars_view->ShowPageHeader(); ?>
<?php
$rent_lease_cars_view->ShowMessage();
?>
<form name="frent_lease_carsview" id="frent_lease_carsview" class="form-inline ewForm ewViewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($rent_lease_cars_view->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $rent_lease_cars_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rent_lease_cars">
<input type="hidden" name="modal" value="<?php echo intval($rent_lease_cars_view->IsModal) ?>">
<?php if ($rent_lease_cars->Export == "") { ?>
<div class="ewMultiPage">
<div class="nav-tabs-custom" id="rent_lease_cars_view">
	<ul class="nav<?php echo $rent_lease_cars_view->MultiPages->NavStyle() ?>">
		<li<?php echo $rent_lease_cars_view->MultiPages->TabStyle("1") ?>><a href="#tab_rent_lease_cars1" data-toggle="tab"><?php echo $rent_lease_cars->PageCaption(1) ?></a></li>
		<li<?php echo $rent_lease_cars_view->MultiPages->TabStyle("2") ?>><a href="#tab_rent_lease_cars2" data-toggle="tab"><?php echo $rent_lease_cars->PageCaption(2) ?></a></li>
		<li<?php echo $rent_lease_cars_view->MultiPages->TabStyle("3") ?>><a href="#tab_rent_lease_cars3" data-toggle="tab"><?php echo $rent_lease_cars->PageCaption(3) ?></a></li>
		<li<?php echo $rent_lease_cars_view->MultiPages->TabStyle("4") ?>><a href="#tab_rent_lease_cars4" data-toggle="tab"><?php echo $rent_lease_cars->PageCaption(4) ?></a></li>
		<li<?php echo $rent_lease_cars_view->MultiPages->TabStyle("5") ?>><a href="#tab_rent_lease_cars5" data-toggle="tab"><?php echo $rent_lease_cars->PageCaption(5) ?></a></li>
	</ul>
	<div class="tab-content">
<?php } ?>
<?php if ($rent_lease_cars->Export == "") { ?>
		<div class="tab-pane<?php echo $rent_lease_cars_view->MultiPages->PageStyle("1") ?>" id="tab_rent_lease_cars1">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($rent_lease_cars->rentLeaseCarID->Visible) { // rentLeaseCarID ?>
	<tr id="r_rentLeaseCarID">
		<td class="col-sm-2"><span id="elh_rent_lease_cars_rentLeaseCarID"><?php echo $rent_lease_cars->rentLeaseCarID->FldCaption() ?></span></td>
		<td data-name="rentLeaseCarID"<?php echo $rent_lease_cars->rentLeaseCarID->CellAttributes() ?>>
<span id="el_rent_lease_cars_rentLeaseCarID" data-page="1">
<span<?php echo $rent_lease_cars->rentLeaseCarID->ViewAttributes() ?>>
<?php echo $rent_lease_cars->rentLeaseCarID->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_lease_cars->bodyTypeID->Visible) { // bodyTypeID ?>
	<tr id="r_bodyTypeID">
		<td class="col-sm-2"><span id="elh_rent_lease_cars_bodyTypeID"><?php echo $rent_lease_cars->bodyTypeID->FldCaption() ?></span></td>
		<td data-name="bodyTypeID"<?php echo $rent_lease_cars->bodyTypeID->CellAttributes() ?>>
<span id="el_rent_lease_cars_bodyTypeID" data-page="1">
<span<?php echo $rent_lease_cars->bodyTypeID->ViewAttributes() ?>>
<?php echo $rent_lease_cars->bodyTypeID->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_lease_cars->carTitle->Visible) { // carTitle ?>
	<tr id="r_carTitle">
		<td class="col-sm-2"><span id="elh_rent_lease_cars_carTitle"><?php echo $rent_lease_cars->carTitle->FldCaption() ?></span></td>
		<td data-name="carTitle"<?php echo $rent_lease_cars->carTitle->CellAttributes() ?>>
<span id="el_rent_lease_cars_carTitle" data-page="1">
<span<?php echo $rent_lease_cars->carTitle->ViewAttributes() ?>>
<?php echo $rent_lease_cars->carTitle->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_lease_cars->slug->Visible) { // slug ?>
	<tr id="r_slug">
		<td class="col-sm-2"><span id="elh_rent_lease_cars_slug"><?php echo $rent_lease_cars->slug->FldCaption() ?></span></td>
		<td data-name="slug"<?php echo $rent_lease_cars->slug->CellAttributes() ?>>
<span id="el_rent_lease_cars_slug" data-page="1">
<span<?php echo $rent_lease_cars->slug->ViewAttributes() ?>>
<?php echo $rent_lease_cars->slug->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_lease_cars->image->Visible) { // image ?>
	<tr id="r_image">
		<td class="col-sm-2"><span id="elh_rent_lease_cars_image"><?php echo $rent_lease_cars->image->FldCaption() ?></span></td>
		<td data-name="image"<?php echo $rent_lease_cars->image->CellAttributes() ?>>
<span id="el_rent_lease_cars_image" data-page="1">
<span>
<?php echo ew_GetFileViewTag($rent_lease_cars->image, $rent_lease_cars->image->ViewValue) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_lease_cars->extraFeatures->Visible) { // extraFeatures ?>
	<tr id="r_extraFeatures">
		<td class="col-sm-2"><span id="elh_rent_lease_cars_extraFeatures"><?php echo $rent_lease_cars->extraFeatures->FldCaption() ?></span></td>
		<td data-name="extraFeatures"<?php echo $rent_lease_cars->extraFeatures->CellAttributes() ?>>
<span id="el_rent_lease_cars_extraFeatures" data-page="1">
<span<?php echo $rent_lease_cars->extraFeatures->ViewAttributes() ?>>
<?php echo $rent_lease_cars->extraFeatures->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_lease_cars->noOfSeats->Visible) { // noOfSeats ?>
	<tr id="r_noOfSeats">
		<td class="col-sm-2"><span id="elh_rent_lease_cars_noOfSeats"><?php echo $rent_lease_cars->noOfSeats->FldCaption() ?></span></td>
		<td data-name="noOfSeats"<?php echo $rent_lease_cars->noOfSeats->CellAttributes() ?>>
<span id="el_rent_lease_cars_noOfSeats" data-page="1">
<span<?php echo $rent_lease_cars->noOfSeats->ViewAttributes() ?>>
<?php echo $rent_lease_cars->noOfSeats->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_lease_cars->luggage->Visible) { // luggage ?>
	<tr id="r_luggage">
		<td class="col-sm-2"><span id="elh_rent_lease_cars_luggage"><?php echo $rent_lease_cars->luggage->FldCaption() ?></span></td>
		<td data-name="luggage"<?php echo $rent_lease_cars->luggage->CellAttributes() ?>>
<span id="el_rent_lease_cars_luggage" data-page="1">
<span<?php echo $rent_lease_cars->luggage->ViewAttributes() ?>>
<?php echo $rent_lease_cars->luggage->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_lease_cars->transmissionID->Visible) { // transmissionID ?>
	<tr id="r_transmissionID">
		<td class="col-sm-2"><span id="elh_rent_lease_cars_transmissionID"><?php echo $rent_lease_cars->transmissionID->FldCaption() ?></span></td>
		<td data-name="transmissionID"<?php echo $rent_lease_cars->transmissionID->CellAttributes() ?>>
<span id="el_rent_lease_cars_transmissionID" data-page="1">
<span<?php echo $rent_lease_cars->transmissionID->ViewAttributes() ?>>
<?php echo $rent_lease_cars->transmissionID->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_lease_cars->ac->Visible) { // ac ?>
	<tr id="r_ac">
		<td class="col-sm-2"><span id="elh_rent_lease_cars_ac"><?php echo $rent_lease_cars->ac->FldCaption() ?></span></td>
		<td data-name="ac"<?php echo $rent_lease_cars->ac->CellAttributes() ?>>
<span id="el_rent_lease_cars_ac" data-page="1">
<span<?php echo $rent_lease_cars->ac->ViewAttributes() ?>>
<?php if (ew_ConvertToBool($rent_lease_cars->ac->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $rent_lease_cars->ac->ViewValue ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $rent_lease_cars->ac->ViewValue ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_lease_cars->noOfDoors->Visible) { // noOfDoors ?>
	<tr id="r_noOfDoors">
		<td class="col-sm-2"><span id="elh_rent_lease_cars_noOfDoors"><?php echo $rent_lease_cars->noOfDoors->FldCaption() ?></span></td>
		<td data-name="noOfDoors"<?php echo $rent_lease_cars->noOfDoors->CellAttributes() ?>>
<span id="el_rent_lease_cars_noOfDoors" data-page="1">
<span<?php echo $rent_lease_cars->noOfDoors->ViewAttributes() ?>>
<?php echo $rent_lease_cars->noOfDoors->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_lease_cars->deliveryAED->Visible) { // deliveryAED ?>
	<tr id="r_deliveryAED">
		<td class="col-sm-2"><span id="elh_rent_lease_cars_deliveryAED"><?php echo $rent_lease_cars->deliveryAED->FldCaption() ?></span></td>
		<td data-name="deliveryAED"<?php echo $rent_lease_cars->deliveryAED->CellAttributes() ?>>
<span id="el_rent_lease_cars_deliveryAED" data-page="1">
<span<?php echo $rent_lease_cars->deliveryAED->ViewAttributes() ?>>
<?php echo $rent_lease_cars->deliveryAED->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_lease_cars->active->Visible) { // active ?>
	<tr id="r_active">
		<td class="col-sm-2"><span id="elh_rent_lease_cars_active"><?php echo $rent_lease_cars->active->FldCaption() ?></span></td>
		<td data-name="active"<?php echo $rent_lease_cars->active->CellAttributes() ?>>
<span id="el_rent_lease_cars_active" data-page="1">
<span<?php echo $rent_lease_cars->active->ViewAttributes() ?>>
<?php echo $rent_lease_cars->active->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_lease_cars->weeklyDeals->Visible) { // weeklyDeals ?>
	<tr id="r_weeklyDeals">
		<td class="col-sm-2"><span id="elh_rent_lease_cars_weeklyDeals"><?php echo $rent_lease_cars->weeklyDeals->FldCaption() ?></span></td>
		<td data-name="weeklyDeals"<?php echo $rent_lease_cars->weeklyDeals->CellAttributes() ?>>
<span id="el_rent_lease_cars_weeklyDeals" data-page="1">
<span<?php echo $rent_lease_cars->weeklyDeals->ViewAttributes() ?>>
<?php echo $rent_lease_cars->weeklyDeals->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($rent_lease_cars->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($rent_lease_cars->Export == "") { ?>
		<div class="tab-pane<?php echo $rent_lease_cars_view->MultiPages->PageStyle("2") ?>" id="tab_rent_lease_cars2">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($rent_lease_cars->dailyAED->Visible) { // dailyAED ?>
	<tr id="r_dailyAED">
		<td class="col-sm-2"><span id="elh_rent_lease_cars_dailyAED"><?php echo $rent_lease_cars->dailyAED->FldCaption() ?></span></td>
		<td data-name="dailyAED"<?php echo $rent_lease_cars->dailyAED->CellAttributes() ?>>
<span id="el_rent_lease_cars_dailyAED" data-page="2">
<span<?php echo $rent_lease_cars->dailyAED->ViewAttributes() ?>>
<?php echo $rent_lease_cars->dailyAED->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_lease_cars->dailyDummyAED->Visible) { // dailyDummyAED ?>
	<tr id="r_dailyDummyAED">
		<td class="col-sm-2"><span id="elh_rent_lease_cars_dailyDummyAED"><?php echo $rent_lease_cars->dailyDummyAED->FldCaption() ?></span></td>
		<td data-name="dailyDummyAED"<?php echo $rent_lease_cars->dailyDummyAED->CellAttributes() ?>>
<span id="el_rent_lease_cars_dailyDummyAED" data-page="2">
<span<?php echo $rent_lease_cars->dailyDummyAED->ViewAttributes() ?>>
<?php echo $rent_lease_cars->dailyDummyAED->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($rent_lease_cars->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($rent_lease_cars->Export == "") { ?>
		<div class="tab-pane<?php echo $rent_lease_cars_view->MultiPages->PageStyle("3") ?>" id="tab_rent_lease_cars3">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($rent_lease_cars->weeklyAED->Visible) { // weeklyAED ?>
	<tr id="r_weeklyAED">
		<td class="col-sm-2"><span id="elh_rent_lease_cars_weeklyAED"><?php echo $rent_lease_cars->weeklyAED->FldCaption() ?></span></td>
		<td data-name="weeklyAED"<?php echo $rent_lease_cars->weeklyAED->CellAttributes() ?>>
<span id="el_rent_lease_cars_weeklyAED" data-page="3">
<span<?php echo $rent_lease_cars->weeklyAED->ViewAttributes() ?>>
<?php echo $rent_lease_cars->weeklyAED->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_lease_cars->weeklyDummyAED->Visible) { // weeklyDummyAED ?>
	<tr id="r_weeklyDummyAED">
		<td class="col-sm-2"><span id="elh_rent_lease_cars_weeklyDummyAED"><?php echo $rent_lease_cars->weeklyDummyAED->FldCaption() ?></span></td>
		<td data-name="weeklyDummyAED"<?php echo $rent_lease_cars->weeklyDummyAED->CellAttributes() ?>>
<span id="el_rent_lease_cars_weeklyDummyAED" data-page="3">
<span<?php echo $rent_lease_cars->weeklyDummyAED->ViewAttributes() ?>>
<?php echo $rent_lease_cars->weeklyDummyAED->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($rent_lease_cars->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($rent_lease_cars->Export == "") { ?>
		<div class="tab-pane<?php echo $rent_lease_cars_view->MultiPages->PageStyle("4") ?>" id="tab_rent_lease_cars4">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($rent_lease_cars->monthlyAED->Visible) { // monthlyAED ?>
	<tr id="r_monthlyAED">
		<td class="col-sm-2"><span id="elh_rent_lease_cars_monthlyAED"><?php echo $rent_lease_cars->monthlyAED->FldCaption() ?></span></td>
		<td data-name="monthlyAED"<?php echo $rent_lease_cars->monthlyAED->CellAttributes() ?>>
<span id="el_rent_lease_cars_monthlyAED" data-page="4">
<span<?php echo $rent_lease_cars->monthlyAED->ViewAttributes() ?>>
<?php echo $rent_lease_cars->monthlyAED->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_lease_cars->monthlyDummyAED->Visible) { // monthlyDummyAED ?>
	<tr id="r_monthlyDummyAED">
		<td class="col-sm-2"><span id="elh_rent_lease_cars_monthlyDummyAED"><?php echo $rent_lease_cars->monthlyDummyAED->FldCaption() ?></span></td>
		<td data-name="monthlyDummyAED"<?php echo $rent_lease_cars->monthlyDummyAED->CellAttributes() ?>>
<span id="el_rent_lease_cars_monthlyDummyAED" data-page="4">
<span<?php echo $rent_lease_cars->monthlyDummyAED->ViewAttributes() ?>>
<?php echo $rent_lease_cars->monthlyDummyAED->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($rent_lease_cars->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($rent_lease_cars->Export == "") { ?>
		<div class="tab-pane<?php echo $rent_lease_cars_view->MultiPages->PageStyle("5") ?>" id="tab_rent_lease_cars5">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($rent_lease_cars->phase1OrangeCard->Visible) { // phase1OrangeCard ?>
	<tr id="r_phase1OrangeCard">
		<td class="col-sm-2"><span id="elh_rent_lease_cars_phase1OrangeCard"><?php echo $rent_lease_cars->phase1OrangeCard->FldCaption() ?></span></td>
		<td data-name="phase1OrangeCard"<?php echo $rent_lease_cars->phase1OrangeCard->CellAttributes() ?>>
<span id="el_rent_lease_cars_phase1OrangeCard" data-page="5">
<span<?php echo $rent_lease_cars->phase1OrangeCard->ViewAttributes() ?>>
<?php echo $rent_lease_cars->phase1OrangeCard->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_lease_cars->phase1GPS->Visible) { // phase1GPS ?>
	<tr id="r_phase1GPS">
		<td class="col-sm-2"><span id="elh_rent_lease_cars_phase1GPS"><?php echo $rent_lease_cars->phase1GPS->FldCaption() ?></span></td>
		<td data-name="phase1GPS"<?php echo $rent_lease_cars->phase1GPS->CellAttributes() ?>>
<span id="el_rent_lease_cars_phase1GPS" data-page="5">
<span<?php echo $rent_lease_cars->phase1GPS->ViewAttributes() ?>>
<?php echo $rent_lease_cars->phase1GPS->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_lease_cars->phase1DeliveryCharges->Visible) { // phase1DeliveryCharges ?>
	<tr id="r_phase1DeliveryCharges">
		<td class="col-sm-2"><span id="elh_rent_lease_cars_phase1DeliveryCharges"><?php echo $rent_lease_cars->phase1DeliveryCharges->FldCaption() ?></span></td>
		<td data-name="phase1DeliveryCharges"<?php echo $rent_lease_cars->phase1DeliveryCharges->CellAttributes() ?>>
<span id="el_rent_lease_cars_phase1DeliveryCharges" data-page="5">
<span<?php echo $rent_lease_cars->phase1DeliveryCharges->ViewAttributes() ?>>
<?php echo $rent_lease_cars->phase1DeliveryCharges->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_lease_cars->phase1CollectionCharges->Visible) { // phase1CollectionCharges ?>
	<tr id="r_phase1CollectionCharges">
		<td class="col-sm-2"><span id="elh_rent_lease_cars_phase1CollectionCharges"><?php echo $rent_lease_cars->phase1CollectionCharges->FldCaption() ?></span></td>
		<td data-name="phase1CollectionCharges"<?php echo $rent_lease_cars->phase1CollectionCharges->CellAttributes() ?>>
<span id="el_rent_lease_cars_phase1CollectionCharges" data-page="5">
<span<?php echo $rent_lease_cars->phase1CollectionCharges->ViewAttributes() ?>>
<?php echo $rent_lease_cars->phase1CollectionCharges->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($rent_lease_cars->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($rent_lease_cars->Export == "") { ?>
	</div>
</div>
</div>
<?php } ?>
</form>
<?php if ($rent_lease_cars->Export == "") { ?>
<script type="text/javascript">
frent_lease_carsview.Init();
</script>
<?php } ?>
<?php
$rent_lease_cars_view->ShowPageFooter();
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
$rent_lease_cars_view->Page_Terminate();
?>
