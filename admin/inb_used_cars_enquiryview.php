<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "inb_used_cars_enquiryinfo.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$inb_used_cars_enquiry_view = NULL; // Initialize page object first

class cinb_used_cars_enquiry_view extends cinb_used_cars_enquiry {

	// Page ID
	var $PageID = 'view';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'inb_used_cars_enquiry';

	// Page object name
	var $PageObjName = 'inb_used_cars_enquiry_view';

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

		// Table object (inb_used_cars_enquiry)
		if (!isset($GLOBALS["inb_used_cars_enquiry"]) || get_class($GLOBALS["inb_used_cars_enquiry"]) == "cinb_used_cars_enquiry") {
			$GLOBALS["inb_used_cars_enquiry"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["inb_used_cars_enquiry"];
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
			define("EW_TABLE_NAME", 'inb_used_cars_enquiry', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("inb_used_cars_enquirylist.php"));
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
		$this->firstName->SetVisibility();
		$this->lastName->SetVisibility();
		$this->_email->SetVisibility();
		$this->mobileNumber->SetVisibility();
		$this->country->SetVisibility();
		$this->city->SetVisibility();
		$this->nationality->SetVisibility();
		$this->address->SetVisibility();
		$this->message->SetVisibility();
		$this->carUsedType->SetVisibility();
		$this->carName->SetVisibility();
		$this->price->SetVisibility();
		$this->kilometer->SetVisibility();
		$this->regionalSpec->SetVisibility();
		$this->transmission->SetVisibility();
		$this->fuel->SetVisibility();
		$this->newsletter->SetVisibility();
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
		global $EW_EXPORT, $inb_used_cars_enquiry;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($inb_used_cars_enquiry);
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
					if ($pageName == "inb_used_cars_enquiryview.php")
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
				$sReturnUrl = "inb_used_cars_enquirylist.php"; // Return to list
			}

			// Get action
			$this->CurrentAction = "I"; // Display form
			switch ($this->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "inb_used_cars_enquirylist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if ($this->CustomExport == "" && in_array($this->Export, array_keys($EW_EXPORT))) {
				$this->ExportData();
				$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "inb_used_cars_enquirylist.php"; // Not page request, return to list
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
		$this->firstName->setDbValue($row['firstName']);
		$this->lastName->setDbValue($row['lastName']);
		$this->_email->setDbValue($row['email']);
		$this->mobileNumber->setDbValue($row['mobileNumber']);
		$this->country->setDbValue($row['country']);
		$this->city->setDbValue($row['city']);
		$this->nationality->setDbValue($row['nationality']);
		$this->address->setDbValue($row['address']);
		$this->message->setDbValue($row['message']);
		$this->carUsedType->setDbValue($row['carUsedType']);
		$this->carName->setDbValue($row['carName']);
		$this->price->setDbValue($row['price']);
		$this->kilometer->setDbValue($row['kilometer']);
		$this->regionalSpec->setDbValue($row['regionalSpec']);
		$this->transmission->setDbValue($row['transmission']);
		$this->fuel->setDbValue($row['fuel']);
		$this->newsletter->setDbValue($row['newsletter']);
		$this->dateCreated->setDbValue($row['dateCreated']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['id'] = NULL;
		$row['firstName'] = NULL;
		$row['lastName'] = NULL;
		$row['email'] = NULL;
		$row['mobileNumber'] = NULL;
		$row['country'] = NULL;
		$row['city'] = NULL;
		$row['nationality'] = NULL;
		$row['address'] = NULL;
		$row['message'] = NULL;
		$row['carUsedType'] = NULL;
		$row['carName'] = NULL;
		$row['price'] = NULL;
		$row['kilometer'] = NULL;
		$row['regionalSpec'] = NULL;
		$row['transmission'] = NULL;
		$row['fuel'] = NULL;
		$row['newsletter'] = NULL;
		$row['dateCreated'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->firstName->DbValue = $row['firstName'];
		$this->lastName->DbValue = $row['lastName'];
		$this->_email->DbValue = $row['email'];
		$this->mobileNumber->DbValue = $row['mobileNumber'];
		$this->country->DbValue = $row['country'];
		$this->city->DbValue = $row['city'];
		$this->nationality->DbValue = $row['nationality'];
		$this->address->DbValue = $row['address'];
		$this->message->DbValue = $row['message'];
		$this->carUsedType->DbValue = $row['carUsedType'];
		$this->carName->DbValue = $row['carName'];
		$this->price->DbValue = $row['price'];
		$this->kilometer->DbValue = $row['kilometer'];
		$this->regionalSpec->DbValue = $row['regionalSpec'];
		$this->transmission->DbValue = $row['transmission'];
		$this->fuel->DbValue = $row['fuel'];
		$this->newsletter->DbValue = $row['newsletter'];
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
		// firstName
		// lastName
		// email
		// mobileNumber
		// country
		// city
		// nationality
		// address
		// message
		// carUsedType
		// carName
		// price
		// kilometer
		// regionalSpec
		// transmission
		// fuel
		// newsletter
		// dateCreated

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// firstName
		$this->firstName->ViewValue = $this->firstName->CurrentValue;
		$this->firstName->ViewCustomAttributes = "";

		// lastName
		$this->lastName->ViewValue = $this->lastName->CurrentValue;
		$this->lastName->ViewCustomAttributes = "";

		// email
		$this->_email->ViewValue = $this->_email->CurrentValue;
		$this->_email->ViewCustomAttributes = "";

		// mobileNumber
		$this->mobileNumber->ViewValue = $this->mobileNumber->CurrentValue;
		$this->mobileNumber->ViewCustomAttributes = "";

		// country
		$this->country->ViewValue = $this->country->CurrentValue;
		$this->country->ViewCustomAttributes = "";

		// city
		$this->city->ViewValue = $this->city->CurrentValue;
		$this->city->ViewCustomAttributes = "";

		// nationality
		$this->nationality->ViewValue = $this->nationality->CurrentValue;
		$this->nationality->ViewCustomAttributes = "";

		// address
		$this->address->ViewValue = $this->address->CurrentValue;
		$this->address->ViewCustomAttributes = "";

		// message
		$this->message->ViewValue = $this->message->CurrentValue;
		$this->message->ViewCustomAttributes = "";

		// carUsedType
		$this->carUsedType->ViewValue = $this->carUsedType->CurrentValue;
		$this->carUsedType->ViewCustomAttributes = "";

		// carName
		$this->carName->ViewValue = $this->carName->CurrentValue;
		$this->carName->ViewCustomAttributes = "";

		// price
		$this->price->ViewValue = $this->price->CurrentValue;
		$this->price->ViewCustomAttributes = "";

		// kilometer
		$this->kilometer->ViewValue = $this->kilometer->CurrentValue;
		$this->kilometer->ViewCustomAttributes = "";

		// regionalSpec
		$this->regionalSpec->ViewValue = $this->regionalSpec->CurrentValue;
		$this->regionalSpec->ViewCustomAttributes = "";

		// transmission
		$this->transmission->ViewValue = $this->transmission->CurrentValue;
		$this->transmission->ViewCustomAttributes = "";

		// fuel
		$this->fuel->ViewValue = $this->fuel->CurrentValue;
		$this->fuel->ViewCustomAttributes = "";

		// newsletter
		$this->newsletter->ViewValue = $this->newsletter->CurrentValue;
		$this->newsletter->ViewCustomAttributes = "";

		// dateCreated
		$this->dateCreated->ViewValue = $this->dateCreated->CurrentValue;
		$this->dateCreated->ViewValue = ew_FormatDateTime($this->dateCreated->ViewValue, 7);
		$this->dateCreated->ViewCustomAttributes = "";

			// id
			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";
			$this->id->TooltipValue = "";

			// firstName
			$this->firstName->LinkCustomAttributes = "";
			$this->firstName->HrefValue = "";
			$this->firstName->TooltipValue = "";

			// lastName
			$this->lastName->LinkCustomAttributes = "";
			$this->lastName->HrefValue = "";
			$this->lastName->TooltipValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";
			$this->_email->TooltipValue = "";

			// mobileNumber
			$this->mobileNumber->LinkCustomAttributes = "";
			$this->mobileNumber->HrefValue = "";
			$this->mobileNumber->TooltipValue = "";

			// country
			$this->country->LinkCustomAttributes = "";
			$this->country->HrefValue = "";
			$this->country->TooltipValue = "";

			// city
			$this->city->LinkCustomAttributes = "";
			$this->city->HrefValue = "";
			$this->city->TooltipValue = "";

			// nationality
			$this->nationality->LinkCustomAttributes = "";
			$this->nationality->HrefValue = "";
			$this->nationality->TooltipValue = "";

			// address
			$this->address->LinkCustomAttributes = "";
			$this->address->HrefValue = "";
			$this->address->TooltipValue = "";

			// message
			$this->message->LinkCustomAttributes = "";
			$this->message->HrefValue = "";
			$this->message->TooltipValue = "";

			// carUsedType
			$this->carUsedType->LinkCustomAttributes = "";
			$this->carUsedType->HrefValue = "";
			$this->carUsedType->TooltipValue = "";

			// carName
			$this->carName->LinkCustomAttributes = "";
			$this->carName->HrefValue = "";
			$this->carName->TooltipValue = "";

			// price
			$this->price->LinkCustomAttributes = "";
			$this->price->HrefValue = "";
			$this->price->TooltipValue = "";

			// kilometer
			$this->kilometer->LinkCustomAttributes = "";
			$this->kilometer->HrefValue = "";
			$this->kilometer->TooltipValue = "";

			// regionalSpec
			$this->regionalSpec->LinkCustomAttributes = "";
			$this->regionalSpec->HrefValue = "";
			$this->regionalSpec->TooltipValue = "";

			// transmission
			$this->transmission->LinkCustomAttributes = "";
			$this->transmission->HrefValue = "";
			$this->transmission->TooltipValue = "";

			// fuel
			$this->fuel->LinkCustomAttributes = "";
			$this->fuel->HrefValue = "";
			$this->fuel->TooltipValue = "";

			// newsletter
			$this->newsletter->LinkCustomAttributes = "";
			$this->newsletter->HrefValue = "";
			$this->newsletter->TooltipValue = "";

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
		$item->Body = "<button id=\"emf_inb_used_cars_enquiry\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_inb_used_cars_enquiry',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.finb_used_cars_enquiryview,key:" . ew_ArrayToJsonAttr($this->RecKey) . ",sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("inb_used_cars_enquirylist.php"), "", $this->TableVar, TRUE);
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
if (!isset($inb_used_cars_enquiry_view)) $inb_used_cars_enquiry_view = new cinb_used_cars_enquiry_view();

// Page init
$inb_used_cars_enquiry_view->Page_Init();

// Page main
$inb_used_cars_enquiry_view->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inb_used_cars_enquiry_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($inb_used_cars_enquiry->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "view";
var CurrentForm = finb_used_cars_enquiryview = new ew_Form("finb_used_cars_enquiryview", "view");

// Form_CustomValidate event
finb_used_cars_enquiryview.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
finb_used_cars_enquiryview.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Multi-Page
finb_used_cars_enquiryview.MultiPage = new ew_MultiPage("finb_used_cars_enquiryview");

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($inb_used_cars_enquiry->Export == "") { ?>
<div class="ewToolbar">
<?php $inb_used_cars_enquiry_view->ExportOptions->Render("body") ?>
<?php
	foreach ($inb_used_cars_enquiry_view->OtherOptions as &$option)
		$option->Render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $inb_used_cars_enquiry_view->ShowPageHeader(); ?>
<?php
$inb_used_cars_enquiry_view->ShowMessage();
?>
<form name="finb_used_cars_enquiryview" id="finb_used_cars_enquiryview" class="form-inline ewForm ewViewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($inb_used_cars_enquiry_view->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $inb_used_cars_enquiry_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inb_used_cars_enquiry">
<input type="hidden" name="modal" value="<?php echo intval($inb_used_cars_enquiry_view->IsModal) ?>">
<?php if ($inb_used_cars_enquiry->Export == "") { ?>
<div class="ewMultiPage">
<div class="nav-tabs-custom" id="inb_used_cars_enquiry_view">
	<ul class="nav<?php echo $inb_used_cars_enquiry_view->MultiPages->NavStyle() ?>">
		<li<?php echo $inb_used_cars_enquiry_view->MultiPages->TabStyle("1") ?>><a href="#tab_inb_used_cars_enquiry1" data-toggle="tab"><?php echo $inb_used_cars_enquiry->PageCaption(1) ?></a></li>
		<li<?php echo $inb_used_cars_enquiry_view->MultiPages->TabStyle("2") ?>><a href="#tab_inb_used_cars_enquiry2" data-toggle="tab"><?php echo $inb_used_cars_enquiry->PageCaption(2) ?></a></li>
	</ul>
	<div class="tab-content">
<?php } ?>
<?php if ($inb_used_cars_enquiry->Export == "") { ?>
		<div class="tab-pane<?php echo $inb_used_cars_enquiry_view->MultiPages->PageStyle("1") ?>" id="tab_inb_used_cars_enquiry1">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($inb_used_cars_enquiry->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="col-sm-2"><span id="elh_inb_used_cars_enquiry_id"><?php echo $inb_used_cars_enquiry->id->FldCaption() ?></span></td>
		<td data-name="id"<?php echo $inb_used_cars_enquiry->id->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_id" data-page="1">
<span<?php echo $inb_used_cars_enquiry->id->ViewAttributes() ?>>
<?php echo $inb_used_cars_enquiry->id->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_used_cars_enquiry->firstName->Visible) { // firstName ?>
	<tr id="r_firstName">
		<td class="col-sm-2"><span id="elh_inb_used_cars_enquiry_firstName"><?php echo $inb_used_cars_enquiry->firstName->FldCaption() ?></span></td>
		<td data-name="firstName"<?php echo $inb_used_cars_enquiry->firstName->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_firstName" data-page="1">
<span<?php echo $inb_used_cars_enquiry->firstName->ViewAttributes() ?>>
<?php echo $inb_used_cars_enquiry->firstName->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_used_cars_enquiry->lastName->Visible) { // lastName ?>
	<tr id="r_lastName">
		<td class="col-sm-2"><span id="elh_inb_used_cars_enquiry_lastName"><?php echo $inb_used_cars_enquiry->lastName->FldCaption() ?></span></td>
		<td data-name="lastName"<?php echo $inb_used_cars_enquiry->lastName->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_lastName" data-page="1">
<span<?php echo $inb_used_cars_enquiry->lastName->ViewAttributes() ?>>
<?php echo $inb_used_cars_enquiry->lastName->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_used_cars_enquiry->_email->Visible) { // email ?>
	<tr id="r__email">
		<td class="col-sm-2"><span id="elh_inb_used_cars_enquiry__email"><?php echo $inb_used_cars_enquiry->_email->FldCaption() ?></span></td>
		<td data-name="_email"<?php echo $inb_used_cars_enquiry->_email->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry__email" data-page="1">
<span<?php echo $inb_used_cars_enquiry->_email->ViewAttributes() ?>>
<?php echo $inb_used_cars_enquiry->_email->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_used_cars_enquiry->mobileNumber->Visible) { // mobileNumber ?>
	<tr id="r_mobileNumber">
		<td class="col-sm-2"><span id="elh_inb_used_cars_enquiry_mobileNumber"><?php echo $inb_used_cars_enquiry->mobileNumber->FldCaption() ?></span></td>
		<td data-name="mobileNumber"<?php echo $inb_used_cars_enquiry->mobileNumber->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_mobileNumber" data-page="1">
<span<?php echo $inb_used_cars_enquiry->mobileNumber->ViewAttributes() ?>>
<?php echo $inb_used_cars_enquiry->mobileNumber->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_used_cars_enquiry->country->Visible) { // country ?>
	<tr id="r_country">
		<td class="col-sm-2"><span id="elh_inb_used_cars_enquiry_country"><?php echo $inb_used_cars_enquiry->country->FldCaption() ?></span></td>
		<td data-name="country"<?php echo $inb_used_cars_enquiry->country->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_country" data-page="1">
<span<?php echo $inb_used_cars_enquiry->country->ViewAttributes() ?>>
<?php echo $inb_used_cars_enquiry->country->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_used_cars_enquiry->city->Visible) { // city ?>
	<tr id="r_city">
		<td class="col-sm-2"><span id="elh_inb_used_cars_enquiry_city"><?php echo $inb_used_cars_enquiry->city->FldCaption() ?></span></td>
		<td data-name="city"<?php echo $inb_used_cars_enquiry->city->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_city" data-page="1">
<span<?php echo $inb_used_cars_enquiry->city->ViewAttributes() ?>>
<?php echo $inb_used_cars_enquiry->city->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_used_cars_enquiry->nationality->Visible) { // nationality ?>
	<tr id="r_nationality">
		<td class="col-sm-2"><span id="elh_inb_used_cars_enquiry_nationality"><?php echo $inb_used_cars_enquiry->nationality->FldCaption() ?></span></td>
		<td data-name="nationality"<?php echo $inb_used_cars_enquiry->nationality->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_nationality" data-page="1">
<span<?php echo $inb_used_cars_enquiry->nationality->ViewAttributes() ?>>
<?php echo $inb_used_cars_enquiry->nationality->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_used_cars_enquiry->address->Visible) { // address ?>
	<tr id="r_address">
		<td class="col-sm-2"><span id="elh_inb_used_cars_enquiry_address"><?php echo $inb_used_cars_enquiry->address->FldCaption() ?></span></td>
		<td data-name="address"<?php echo $inb_used_cars_enquiry->address->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_address" data-page="1">
<span<?php echo $inb_used_cars_enquiry->address->ViewAttributes() ?>>
<?php echo $inb_used_cars_enquiry->address->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_used_cars_enquiry->message->Visible) { // message ?>
	<tr id="r_message">
		<td class="col-sm-2"><span id="elh_inb_used_cars_enquiry_message"><?php echo $inb_used_cars_enquiry->message->FldCaption() ?></span></td>
		<td data-name="message"<?php echo $inb_used_cars_enquiry->message->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_message" data-page="1">
<span<?php echo $inb_used_cars_enquiry->message->ViewAttributes() ?>>
<?php echo $inb_used_cars_enquiry->message->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_used_cars_enquiry->newsletter->Visible) { // newsletter ?>
	<tr id="r_newsletter">
		<td class="col-sm-2"><span id="elh_inb_used_cars_enquiry_newsletter"><?php echo $inb_used_cars_enquiry->newsletter->FldCaption() ?></span></td>
		<td data-name="newsletter"<?php echo $inb_used_cars_enquiry->newsletter->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_newsletter" data-page="1">
<span<?php echo $inb_used_cars_enquiry->newsletter->ViewAttributes() ?>>
<?php echo $inb_used_cars_enquiry->newsletter->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_used_cars_enquiry->dateCreated->Visible) { // dateCreated ?>
	<tr id="r_dateCreated">
		<td class="col-sm-2"><span id="elh_inb_used_cars_enquiry_dateCreated"><?php echo $inb_used_cars_enquiry->dateCreated->FldCaption() ?></span></td>
		<td data-name="dateCreated"<?php echo $inb_used_cars_enquiry->dateCreated->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_dateCreated" data-page="1">
<span<?php echo $inb_used_cars_enquiry->dateCreated->ViewAttributes() ?>>
<?php echo $inb_used_cars_enquiry->dateCreated->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($inb_used_cars_enquiry->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($inb_used_cars_enquiry->Export == "") { ?>
		<div class="tab-pane<?php echo $inb_used_cars_enquiry_view->MultiPages->PageStyle("2") ?>" id="tab_inb_used_cars_enquiry2">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($inb_used_cars_enquiry->carUsedType->Visible) { // carUsedType ?>
	<tr id="r_carUsedType">
		<td class="col-sm-2"><span id="elh_inb_used_cars_enquiry_carUsedType"><?php echo $inb_used_cars_enquiry->carUsedType->FldCaption() ?></span></td>
		<td data-name="carUsedType"<?php echo $inb_used_cars_enquiry->carUsedType->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_carUsedType" data-page="2">
<span<?php echo $inb_used_cars_enquiry->carUsedType->ViewAttributes() ?>>
<?php echo $inb_used_cars_enquiry->carUsedType->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_used_cars_enquiry->carName->Visible) { // carName ?>
	<tr id="r_carName">
		<td class="col-sm-2"><span id="elh_inb_used_cars_enquiry_carName"><?php echo $inb_used_cars_enquiry->carName->FldCaption() ?></span></td>
		<td data-name="carName"<?php echo $inb_used_cars_enquiry->carName->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_carName" data-page="2">
<span<?php echo $inb_used_cars_enquiry->carName->ViewAttributes() ?>>
<?php echo $inb_used_cars_enquiry->carName->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_used_cars_enquiry->price->Visible) { // price ?>
	<tr id="r_price">
		<td class="col-sm-2"><span id="elh_inb_used_cars_enquiry_price"><?php echo $inb_used_cars_enquiry->price->FldCaption() ?></span></td>
		<td data-name="price"<?php echo $inb_used_cars_enquiry->price->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_price" data-page="2">
<span<?php echo $inb_used_cars_enquiry->price->ViewAttributes() ?>>
<?php echo $inb_used_cars_enquiry->price->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_used_cars_enquiry->kilometer->Visible) { // kilometer ?>
	<tr id="r_kilometer">
		<td class="col-sm-2"><span id="elh_inb_used_cars_enquiry_kilometer"><?php echo $inb_used_cars_enquiry->kilometer->FldCaption() ?></span></td>
		<td data-name="kilometer"<?php echo $inb_used_cars_enquiry->kilometer->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_kilometer" data-page="2">
<span<?php echo $inb_used_cars_enquiry->kilometer->ViewAttributes() ?>>
<?php echo $inb_used_cars_enquiry->kilometer->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_used_cars_enquiry->regionalSpec->Visible) { // regionalSpec ?>
	<tr id="r_regionalSpec">
		<td class="col-sm-2"><span id="elh_inb_used_cars_enquiry_regionalSpec"><?php echo $inb_used_cars_enquiry->regionalSpec->FldCaption() ?></span></td>
		<td data-name="regionalSpec"<?php echo $inb_used_cars_enquiry->regionalSpec->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_regionalSpec" data-page="2">
<span<?php echo $inb_used_cars_enquiry->regionalSpec->ViewAttributes() ?>>
<?php echo $inb_used_cars_enquiry->regionalSpec->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_used_cars_enquiry->transmission->Visible) { // transmission ?>
	<tr id="r_transmission">
		<td class="col-sm-2"><span id="elh_inb_used_cars_enquiry_transmission"><?php echo $inb_used_cars_enquiry->transmission->FldCaption() ?></span></td>
		<td data-name="transmission"<?php echo $inb_used_cars_enquiry->transmission->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_transmission" data-page="2">
<span<?php echo $inb_used_cars_enquiry->transmission->ViewAttributes() ?>>
<?php echo $inb_used_cars_enquiry->transmission->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inb_used_cars_enquiry->fuel->Visible) { // fuel ?>
	<tr id="r_fuel">
		<td class="col-sm-2"><span id="elh_inb_used_cars_enquiry_fuel"><?php echo $inb_used_cars_enquiry->fuel->FldCaption() ?></span></td>
		<td data-name="fuel"<?php echo $inb_used_cars_enquiry->fuel->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_fuel" data-page="2">
<span<?php echo $inb_used_cars_enquiry->fuel->ViewAttributes() ?>>
<?php echo $inb_used_cars_enquiry->fuel->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($inb_used_cars_enquiry->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($inb_used_cars_enquiry->Export == "") { ?>
	</div>
</div>
</div>
<?php } ?>
</form>
<?php if ($inb_used_cars_enquiry->Export == "") { ?>
<script type="text/javascript">
finb_used_cars_enquiryview.Init();
</script>
<?php } ?>
<?php
$inb_used_cars_enquiry_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($inb_used_cars_enquiry->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$inb_used_cars_enquiry_view->Page_Terminate();
?>
