<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "inb_new_vehicle_enquiryinfo.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$inb_new_vehicle_enquiry_view = NULL; // Initialize page object first

class cinb_new_vehicle_enquiry_view extends cinb_new_vehicle_enquiry {

	// Page ID
	var $PageID = 'view';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'inb_new_vehicle_enquiry';

	// Page object name
	var $PageObjName = 'inb_new_vehicle_enquiry_view';

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

		// Table object (inb_new_vehicle_enquiry)
		if (!isset($GLOBALS["inb_new_vehicle_enquiry"]) || get_class($GLOBALS["inb_new_vehicle_enquiry"]) == "cinb_new_vehicle_enquiry") {
			$GLOBALS["inb_new_vehicle_enquiry"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["inb_new_vehicle_enquiry"];
		}
		$KeyUrl = "";
		if (@$_GET["id"] <> "") {
			$this->RecKey["id"] = $_GET["id"];
			$KeyUrl .= "&amp;id=" . urlencode($this->RecKey["id"]);
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
			define("EW_TABLE_NAME", 'inb_new_vehicle_enquiry', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("inb_new_vehicle_enquirylist.php"));
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
		if (@$_GET["id"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= $_GET["id"];
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
		$this->id->SetVisibility();
		$this->id->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
		$this->selectedType->SetVisibility();
		$this->individualFirstName->SetVisibility();
		$this->corporateCompanyName->SetVisibility();
		$this->corporateFullName->SetVisibility();
		$this->individualLastName->SetVisibility();
		$this->individualVehicle->SetVisibility();
		$this->corporateVehicle->SetVisibility();
		$this->corporateNoOfVehicle->SetVisibility();
		$this->_email->SetVisibility();
		$this->phone->SetVisibility();
		$this->country->SetVisibility();
		$this->city->SetVisibility();
		$this->individualSpecificRequirement->SetVisibility();
		$this->corporateSpecificRequirement->SetVisibility();
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
		global $EW_EXPORT, $inb_new_vehicle_enquiry;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($inb_new_vehicle_enquiry);
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
					if ($pageName == "inb_new_vehicle_enquiryview.php")
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
			if (@$_GET["id"] <> "") {
				$this->id->setQueryStringValue($_GET["id"]);
				$this->RecKey["id"] = $this->id->QueryStringValue;
			} elseif (@$_POST["id"] <> "") {
				$this->id->setFormValue($_POST["id"]);
				$this->RecKey["id"] = $this->id->FormValue;
			} else {
				$sReturnUrl = "inb_new_vehicle_enquirylist.php"; // Return to list
			}

			// Get action
			$this->CurrentAction = "I"; // Display form
			switch ($this->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "inb_new_vehicle_enquirylist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if ($this->CustomExport == "" && in_array($this->Export, array_keys($EW_EXPORT))) {
				$this->ExportData();
				$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "inb_new_vehicle_enquirylist.php"; // Not page request, return to list
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
		$this->id->setDbValue($row['id']);
		$this->selectedType->setDbValue($row['selectedType']);
		$this->individualFirstName->setDbValue($row['individualFirstName']);
		$this->corporateCompanyName->setDbValue($row['corporateCompanyName']);
		$this->corporateFullName->setDbValue($row['corporateFullName']);
		$this->individualLastName->setDbValue($row['individualLastName']);
		$this->individualVehicle->setDbValue($row['individualVehicle']);
		$this->corporateVehicle->setDbValue($row['corporateVehicle']);
		$this->corporateNoOfVehicle->setDbValue($row['corporateNoOfVehicle']);
		$this->_email->setDbValue($row['email']);
		$this->phone->setDbValue($row['phone']);
		$this->country->setDbValue($row['country']);
		$this->city->setDbValue($row['city']);
		$this->individualSpecificRequirement->setDbValue($row['individualSpecificRequirement']);
		$this->corporateSpecificRequirement->setDbValue($row['corporateSpecificRequirement']);
		$this->dateCreated->setDbValue($row['dateCreated']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['id'] = NULL;
		$row['selectedType'] = NULL;
		$row['individualFirstName'] = NULL;
		$row['corporateCompanyName'] = NULL;
		$row['corporateFullName'] = NULL;
		$row['individualLastName'] = NULL;
		$row['individualVehicle'] = NULL;
		$row['corporateVehicle'] = NULL;
		$row['corporateNoOfVehicle'] = NULL;
		$row['email'] = NULL;
		$row['phone'] = NULL;
		$row['country'] = NULL;
		$row['city'] = NULL;
		$row['individualSpecificRequirement'] = NULL;
		$row['corporateSpecificRequirement'] = NULL;
		$row['dateCreated'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->selectedType->DbValue = $row['selectedType'];
		$this->individualFirstName->DbValue = $row['individualFirstName'];
		$this->corporateCompanyName->DbValue = $row['corporateCompanyName'];
		$this->corporateFullName->DbValue = $row['corporateFullName'];
		$this->individualLastName->DbValue = $row['individualLastName'];
		$this->individualVehicle->DbValue = $row['individualVehicle'];
		$this->corporateVehicle->DbValue = $row['corporateVehicle'];
		$this->corporateNoOfVehicle->DbValue = $row['corporateNoOfVehicle'];
		$this->_email->DbValue = $row['email'];
		$this->phone->DbValue = $row['phone'];
		$this->country->DbValue = $row['country'];
		$this->city->DbValue = $row['city'];
		$this->individualSpecificRequirement->DbValue = $row['individualSpecificRequirement'];
		$this->corporateSpecificRequirement->DbValue = $row['corporateSpecificRequirement'];
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

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// selectedType
		// individualFirstName
		// corporateCompanyName
		// corporateFullName
		// individualLastName
		// individualVehicle
		// corporateVehicle
		// corporateNoOfVehicle
		// email
		// phone
		// country
		// city
		// individualSpecificRequirement
		// corporateSpecificRequirement
		// dateCreated

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// selectedType
		$this->selectedType->ViewValue = $this->selectedType->CurrentValue;
		$this->selectedType->ViewCustomAttributes = "";

		// individualFirstName
		$this->individualFirstName->ViewValue = $this->individualFirstName->CurrentValue;
		$this->individualFirstName->ViewCustomAttributes = "";

		// corporateCompanyName
		$this->corporateCompanyName->ViewValue = $this->corporateCompanyName->CurrentValue;
		$this->corporateCompanyName->ViewCustomAttributes = "";

		// corporateFullName
		$this->corporateFullName->ViewValue = $this->corporateFullName->CurrentValue;
		$this->corporateFullName->ViewCustomAttributes = "";

		// individualLastName
		$this->individualLastName->ViewValue = $this->individualLastName->CurrentValue;
		$this->individualLastName->ViewCustomAttributes = "";

		// individualVehicle
		$this->individualVehicle->ViewValue = $this->individualVehicle->CurrentValue;
		$this->individualVehicle->ViewCustomAttributes = "";

		// corporateVehicle
		$this->corporateVehicle->ViewValue = $this->corporateVehicle->CurrentValue;
		$this->corporateVehicle->ViewCustomAttributes = "";

		// corporateNoOfVehicle
		$this->corporateNoOfVehicle->ViewValue = $this->corporateNoOfVehicle->CurrentValue;
		$this->corporateNoOfVehicle->ViewCustomAttributes = "";

		// email
		$this->_email->ViewValue = $this->_email->CurrentValue;
		$this->_email->ViewCustomAttributes = "";

		// phone
		$this->phone->ViewValue = $this->phone->CurrentValue;
		$this->phone->ViewCustomAttributes = "";

		// country
		$this->country->ViewValue = $this->country->CurrentValue;
		$this->country->ViewCustomAttributes = "";

		// city
		$this->city->ViewValue = $this->city->CurrentValue;
		$this->city->ViewCustomAttributes = "";

		// individualSpecificRequirement
		$this->individualSpecificRequirement->ViewValue = $this->individualSpecificRequirement->CurrentValue;
		$this->individualSpecificRequirement->ViewCustomAttributes = "";

		// corporateSpecificRequirement
		$this->corporateSpecificRequirement->ViewValue = $this->corporateSpecificRequirement->CurrentValue;
		$this->corporateSpecificRequirement->ViewCustomAttributes = "";

		// dateCreated
		$this->dateCreated->ViewValue = $this->dateCreated->CurrentValue;
		$this->dateCreated->ViewValue = ew_FormatDateTime($this->dateCreated->ViewValue, 0);
		$this->dateCreated->ViewCustomAttributes = "";

			// id
			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";
			$this->id->TooltipValue = "";

			// selectedType
			$this->selectedType->LinkCustomAttributes = "";
			$this->selectedType->HrefValue = "";
			$this->selectedType->TooltipValue = "";

			// individualFirstName
			$this->individualFirstName->LinkCustomAttributes = "";
			$this->individualFirstName->HrefValue = "";
			$this->individualFirstName->TooltipValue = "";

			// corporateCompanyName
			$this->corporateCompanyName->LinkCustomAttributes = "";
			$this->corporateCompanyName->HrefValue = "";
			$this->corporateCompanyName->TooltipValue = "";

			// corporateFullName
			$this->corporateFullName->LinkCustomAttributes = "";
			$this->corporateFullName->HrefValue = "";
			$this->corporateFullName->TooltipValue = "";

			// individualLastName
			$this->individualLastName->LinkCustomAttributes = "";
			$this->individualLastName->HrefValue = "";
			$this->individualLastName->TooltipValue = "";

			// individualVehicle
			$this->individualVehicle->LinkCustomAttributes = "";
			$this->individualVehicle->HrefValue = "";
			$this->individualVehicle->TooltipValue = "";

			// corporateVehicle
			$this->corporateVehicle->LinkCustomAttributes = "";
			$this->corporateVehicle->HrefValue = "";
			$this->corporateVehicle->TooltipValue = "";

			// corporateNoOfVehicle
			$this->corporateNoOfVehicle->LinkCustomAttributes = "";
			$this->corporateNoOfVehicle->HrefValue = "";
			$this->corporateNoOfVehicle->TooltipValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";
			$this->_email->TooltipValue = "";

			// phone
			$this->phone->LinkCustomAttributes = "";
			$this->phone->HrefValue = "";
			$this->phone->TooltipValue = "";

			// country
			$this->country->LinkCustomAttributes = "";
			$this->country->HrefValue = "";
			$this->country->TooltipValue = "";

			// city
			$this->city->LinkCustomAttributes = "";
			$this->city->HrefValue = "";
			$this->city->TooltipValue = "";

			// individualSpecificRequirement
			$this->individualSpecificRequirement->LinkCustomAttributes = "";
			$this->individualSpecificRequirement->HrefValue = "";
			$this->individualSpecificRequirement->TooltipValue = "";

			// corporateSpecificRequirement
			$this->corporateSpecificRequirement->LinkCustomAttributes = "";
			$this->corporateSpecificRequirement->HrefValue = "";
			$this->corporateSpecificRequirement->TooltipValue = "";

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
		$item->Body = "<button id=\"emf_inb_new_vehicle_enquiry\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_inb_new_vehicle_enquiry',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.finb_new_vehicle_enquiryview,key:" . ew_ArrayToJsonAttr($this->RecKey) . ",sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("inb_new_vehicle_enquirylist.php"), "", $this->TableVar, TRUE);
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
if (!isset($inb_new_vehicle_enquiry_view)) $inb_new_vehicle_enquiry_view = new cinb_new_vehicle_enquiry_view();

// Page init
$inb_new_vehicle_enquiry_view->Page_Init();

// Page main
$inb_new_vehicle_enquiry_view->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inb_new_vehicle_enquiry_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($inb_new_vehicle_enquiry->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "view";
var CurrentForm = finb_new_vehicle_enquiryview = new ew_Form("finb_new_vehicle_enquiryview", "view");

// Form_CustomValidate event
finb_new_vehicle_enquiryview.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
finb_new_vehicle_enquiryview.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Multi-Page
finb_new_vehicle_enquiryview.MultiPage = new ew_MultiPage("finb_new_vehicle_enquiryview");

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->Export == "") { ?>
<div class="ewToolbar">
<?php $inb_new_vehicle_enquiry_view->ExportOptions->Render("body") ?>
<?php
	foreach ($inb_new_vehicle_enquiry_view->OtherOptions as &$option)
		$option->Render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $inb_new_vehicle_enquiry_view->ShowPageHeader(); ?>
<?php
$inb_new_vehicle_enquiry_view->ShowMessage();
?>
<form name="finb_new_vehicle_enquiryview" id="finb_new_vehicle_enquiryview" class="form-inline ewForm ewViewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($inb_new_vehicle_enquiry_view->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $inb_new_vehicle_enquiry_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inb_new_vehicle_enquiry">
<input type="hidden" name="modal" value="<?php echo intval($inb_new_vehicle_enquiry_view->IsModal) ?>">
<?php if ($inb_new_vehicle_enquiry->Export == "") { ?>
<div class="ewMultiPage">
<div class="nav-tabs-custom" id="inb_new_vehicle_enquiry_view">
	<ul class="nav<?php echo $inb_new_vehicle_enquiry_view->MultiPages->NavStyle() ?>">
		<li<?php echo $inb_new_vehicle_enquiry_view->MultiPages->TabStyle("1") ?>><a href="#tab_inb_new_vehicle_enquiry1" data-toggle="tab"><?php echo $inb_new_vehicle_enquiry->PageCaption(1) ?></a></li>
		<li<?php echo $inb_new_vehicle_enquiry_view->MultiPages->TabStyle("2") ?>><a href="#tab_inb_new_vehicle_enquiry2" data-toggle="tab"><?php echo $inb_new_vehicle_enquiry->PageCaption(2) ?></a></li>
		<li<?php echo $inb_new_vehicle_enquiry_view->MultiPages->TabStyle("3") ?>><a href="#tab_inb_new_vehicle_enquiry3" data-toggle="tab"><?php echo $inb_new_vehicle_enquiry->PageCaption(3) ?></a></li>
	</ul>
	<div class="tab-content">
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->Export == "") { ?>
		<div class="tab-pane<?php echo $inb_new_vehicle_enquiry_view->MultiPages->PageStyle("1") ?>" id="tab_inb_new_vehicle_enquiry1">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($inb_new_vehicle_enquiry->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="col-sm-2"><span id="elh_inb_new_vehicle_enquiry_id"><?php echo $inb_new_vehicle_enquiry->id->FldCaption() ?></span></td>
		<td data-name="id"<?php echo $inb_new_vehicle_enquiry->id->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry_id" data-page="1">
<span<?php echo $inb_new_vehicle_enquiry->id->ViewAttributes() ?>>
<?php echo $inb_new_vehicle_enquiry->id->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->selectedType->Visible) { // selectedType ?>
	<tr id="r_selectedType">
		<td class="col-sm-2"><span id="elh_inb_new_vehicle_enquiry_selectedType"><?php echo $inb_new_vehicle_enquiry->selectedType->FldCaption() ?></span></td>
		<td data-name="selectedType"<?php echo $inb_new_vehicle_enquiry->selectedType->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry_selectedType" data-page="1">
<span<?php echo $inb_new_vehicle_enquiry->selectedType->ViewAttributes() ?>>
<?php echo $inb_new_vehicle_enquiry->selectedType->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->dateCreated->Visible) { // dateCreated ?>
	<tr id="r_dateCreated">
		<td class="col-sm-2"><span id="elh_inb_new_vehicle_enquiry_dateCreated"><?php echo $inb_new_vehicle_enquiry->dateCreated->FldCaption() ?></span></td>
		<td data-name="dateCreated"<?php echo $inb_new_vehicle_enquiry->dateCreated->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry_dateCreated" data-page="1">
<span<?php echo $inb_new_vehicle_enquiry->dateCreated->ViewAttributes() ?>>
<?php echo $inb_new_vehicle_enquiry->dateCreated->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($inb_new_vehicle_enquiry->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->Export == "") { ?>
		<div class="tab-pane<?php echo $inb_new_vehicle_enquiry_view->MultiPages->PageStyle("2") ?>" id="tab_inb_new_vehicle_enquiry2">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($inb_new_vehicle_enquiry->individualFirstName->Visible) { // individualFirstName ?>
	<tr id="r_individualFirstName">
		<td class="col-sm-2"><span id="elh_inb_new_vehicle_enquiry_individualFirstName"><?php echo $inb_new_vehicle_enquiry->individualFirstName->FldCaption() ?></span></td>
		<td data-name="individualFirstName"<?php echo $inb_new_vehicle_enquiry->individualFirstName->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry_individualFirstName" data-page="2">
<span<?php echo $inb_new_vehicle_enquiry->individualFirstName->ViewAttributes() ?>>
<?php echo $inb_new_vehicle_enquiry->individualFirstName->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->individualLastName->Visible) { // individualLastName ?>
	<tr id="r_individualLastName">
		<td class="col-sm-2"><span id="elh_inb_new_vehicle_enquiry_individualLastName"><?php echo $inb_new_vehicle_enquiry->individualLastName->FldCaption() ?></span></td>
		<td data-name="individualLastName"<?php echo $inb_new_vehicle_enquiry->individualLastName->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry_individualLastName" data-page="2">
<span<?php echo $inb_new_vehicle_enquiry->individualLastName->ViewAttributes() ?>>
<?php echo $inb_new_vehicle_enquiry->individualLastName->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->individualVehicle->Visible) { // individualVehicle ?>
	<tr id="r_individualVehicle">
		<td class="col-sm-2"><span id="elh_inb_new_vehicle_enquiry_individualVehicle"><?php echo $inb_new_vehicle_enquiry->individualVehicle->FldCaption() ?></span></td>
		<td data-name="individualVehicle"<?php echo $inb_new_vehicle_enquiry->individualVehicle->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry_individualVehicle" data-page="2">
<span<?php echo $inb_new_vehicle_enquiry->individualVehicle->ViewAttributes() ?>>
<?php echo $inb_new_vehicle_enquiry->individualVehicle->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->_email->Visible) { // email ?>
	<tr id="r__email">
		<td class="col-sm-2"><span id="elh_inb_new_vehicle_enquiry__email"><?php echo $inb_new_vehicle_enquiry->_email->FldCaption() ?></span></td>
		<td data-name="_email"<?php echo $inb_new_vehicle_enquiry->_email->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry__email" data-page="2">
<span<?php echo $inb_new_vehicle_enquiry->_email->ViewAttributes() ?>>
<?php echo $inb_new_vehicle_enquiry->_email->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->phone->Visible) { // phone ?>
	<tr id="r_phone">
		<td class="col-sm-2"><span id="elh_inb_new_vehicle_enquiry_phone"><?php echo $inb_new_vehicle_enquiry->phone->FldCaption() ?></span></td>
		<td data-name="phone"<?php echo $inb_new_vehicle_enquiry->phone->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry_phone" data-page="2">
<span<?php echo $inb_new_vehicle_enquiry->phone->ViewAttributes() ?>>
<?php echo $inb_new_vehicle_enquiry->phone->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->country->Visible) { // country ?>
	<tr id="r_country">
		<td class="col-sm-2"><span id="elh_inb_new_vehicle_enquiry_country"><?php echo $inb_new_vehicle_enquiry->country->FldCaption() ?></span></td>
		<td data-name="country"<?php echo $inb_new_vehicle_enquiry->country->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry_country" data-page="2">
<span<?php echo $inb_new_vehicle_enquiry->country->ViewAttributes() ?>>
<?php echo $inb_new_vehicle_enquiry->country->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->city->Visible) { // city ?>
	<tr id="r_city">
		<td class="col-sm-2"><span id="elh_inb_new_vehicle_enquiry_city"><?php echo $inb_new_vehicle_enquiry->city->FldCaption() ?></span></td>
		<td data-name="city"<?php echo $inb_new_vehicle_enquiry->city->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry_city" data-page="2">
<span<?php echo $inb_new_vehicle_enquiry->city->ViewAttributes() ?>>
<?php echo $inb_new_vehicle_enquiry->city->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->individualSpecificRequirement->Visible) { // individualSpecificRequirement ?>
	<tr id="r_individualSpecificRequirement">
		<td class="col-sm-2"><span id="elh_inb_new_vehicle_enquiry_individualSpecificRequirement"><?php echo $inb_new_vehicle_enquiry->individualSpecificRequirement->FldCaption() ?></span></td>
		<td data-name="individualSpecificRequirement"<?php echo $inb_new_vehicle_enquiry->individualSpecificRequirement->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry_individualSpecificRequirement" data-page="2">
<span<?php echo $inb_new_vehicle_enquiry->individualSpecificRequirement->ViewAttributes() ?>>
<?php echo $inb_new_vehicle_enquiry->individualSpecificRequirement->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($inb_new_vehicle_enquiry->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->Export == "") { ?>
		<div class="tab-pane<?php echo $inb_new_vehicle_enquiry_view->MultiPages->PageStyle("3") ?>" id="tab_inb_new_vehicle_enquiry3">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($inb_new_vehicle_enquiry->corporateCompanyName->Visible) { // corporateCompanyName ?>
	<tr id="r_corporateCompanyName">
		<td class="col-sm-2"><span id="elh_inb_new_vehicle_enquiry_corporateCompanyName"><?php echo $inb_new_vehicle_enquiry->corporateCompanyName->FldCaption() ?></span></td>
		<td data-name="corporateCompanyName"<?php echo $inb_new_vehicle_enquiry->corporateCompanyName->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry_corporateCompanyName" data-page="3">
<span<?php echo $inb_new_vehicle_enquiry->corporateCompanyName->ViewAttributes() ?>>
<?php echo $inb_new_vehicle_enquiry->corporateCompanyName->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->corporateFullName->Visible) { // corporateFullName ?>
	<tr id="r_corporateFullName">
		<td class="col-sm-2"><span id="elh_inb_new_vehicle_enquiry_corporateFullName"><?php echo $inb_new_vehicle_enquiry->corporateFullName->FldCaption() ?></span></td>
		<td data-name="corporateFullName"<?php echo $inb_new_vehicle_enquiry->corporateFullName->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry_corporateFullName" data-page="3">
<span<?php echo $inb_new_vehicle_enquiry->corporateFullName->ViewAttributes() ?>>
<?php echo $inb_new_vehicle_enquiry->corporateFullName->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->corporateVehicle->Visible) { // corporateVehicle ?>
	<tr id="r_corporateVehicle">
		<td class="col-sm-2"><span id="elh_inb_new_vehicle_enquiry_corporateVehicle"><?php echo $inb_new_vehicle_enquiry->corporateVehicle->FldCaption() ?></span></td>
		<td data-name="corporateVehicle"<?php echo $inb_new_vehicle_enquiry->corporateVehicle->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry_corporateVehicle" data-page="3">
<span<?php echo $inb_new_vehicle_enquiry->corporateVehicle->ViewAttributes() ?>>
<?php echo $inb_new_vehicle_enquiry->corporateVehicle->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->corporateNoOfVehicle->Visible) { // corporateNoOfVehicle ?>
	<tr id="r_corporateNoOfVehicle">
		<td class="col-sm-2"><span id="elh_inb_new_vehicle_enquiry_corporateNoOfVehicle"><?php echo $inb_new_vehicle_enquiry->corporateNoOfVehicle->FldCaption() ?></span></td>
		<td data-name="corporateNoOfVehicle"<?php echo $inb_new_vehicle_enquiry->corporateNoOfVehicle->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry_corporateNoOfVehicle" data-page="3">
<span<?php echo $inb_new_vehicle_enquiry->corporateNoOfVehicle->ViewAttributes() ?>>
<?php echo $inb_new_vehicle_enquiry->corporateNoOfVehicle->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->corporateSpecificRequirement->Visible) { // corporateSpecificRequirement ?>
	<tr id="r_corporateSpecificRequirement">
		<td class="col-sm-2"><span id="elh_inb_new_vehicle_enquiry_corporateSpecificRequirement"><?php echo $inb_new_vehicle_enquiry->corporateSpecificRequirement->FldCaption() ?></span></td>
		<td data-name="corporateSpecificRequirement"<?php echo $inb_new_vehicle_enquiry->corporateSpecificRequirement->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry_corporateSpecificRequirement" data-page="3">
<span<?php echo $inb_new_vehicle_enquiry->corporateSpecificRequirement->ViewAttributes() ?>>
<?php echo $inb_new_vehicle_enquiry->corporateSpecificRequirement->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($inb_new_vehicle_enquiry->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->Export == "") { ?>
	</div>
</div>
</div>
<?php } ?>
</form>
<?php if ($inb_new_vehicle_enquiry->Export == "") { ?>
<script type="text/javascript">
finb_new_vehicle_enquiryview.Init();
</script>
<?php } ?>
<?php
$inb_new_vehicle_enquiry_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($inb_new_vehicle_enquiry->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$inb_new_vehicle_enquiry_view->Page_Terminate();
?>
