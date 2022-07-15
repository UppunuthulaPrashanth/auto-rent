<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "inb_leasecars_enquiryinfo.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$inb_leasecars_enquiry_edit = NULL; // Initialize page object first

class cinb_leasecars_enquiry_edit extends cinb_leasecars_enquiry {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'inb_leasecars_enquiry';

	// Page object name
	var $PageObjName = 'inb_leasecars_enquiry_edit';

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

		// Table object (inb_leasecars_enquiry)
		if (!isset($GLOBALS["inb_leasecars_enquiry"]) || get_class($GLOBALS["inb_leasecars_enquiry"]) == "cinb_leasecars_enquiry") {
			$GLOBALS["inb_leasecars_enquiry"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["inb_leasecars_enquiry"];
		}

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'inb_leasecars_enquiry', TRUE);

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
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("inb_leasecars_enquirylist.php"));
			else
				$this->Page_Terminate(ew_GetUrl("login.php"));
		}

		// NOTE: Security object may be needed in other part of the script, skip set to Nothing
		// 
		// Security = null;
		// 
		// Create form object

		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->id->SetVisibility();
		$this->id->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
		$this->selectedType->SetVisibility();
		$this->vehicleID->SetVisibility();
		$this->individualFirstName->SetVisibility();
		$this->corporateCompanyName->SetVisibility();
		$this->corporateFullName->SetVisibility();
		$this->individualLastName->SetVisibility();
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
		global $EW_EXPORT, $inb_leasecars_enquiry;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($inb_leasecars_enquiry);
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
					if ($pageName == "inb_leasecars_enquiryview.php")
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
	var $FormClassName = "form-horizontal ewForm ewEditForm";
	var $IsModal = FALSE;
	var $IsMobileOrModal = FALSE;
	var $DbMasterFilter;
	var $DbDetailFilter;
	var $MultiPages; // Multi pages object

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gbSkipHeaderFooter;

		// Check modal
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = ew_IsMobile() || $this->IsModal;
		$this->FormClassName = "ewForm ewEditForm form-horizontal";
		$sReturnUrl = "";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (@$_POST["a_edit"] <> "") {
			$this->CurrentAction = $_POST["a_edit"]; // Get action code
			if ($this->CurrentAction <> "I") // Not reload record, handle as postback
				$postBack = TRUE;

			// Load key from Form
			if ($objForm->HasValue("x_id")) {
				$this->id->setFormValue($objForm->GetValue("x_id"));
			}
		} else {
			$this->CurrentAction = "I"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (isset($_GET["id"])) {
				$this->id->setQueryStringValue($_GET["id"]);
				$loadByQuery = TRUE;
			} else {
				$this->id->CurrentValue = NULL;
			}
		}

		// Load current record
		$loaded = $this->LoadRow();

		// Process form if post back
		if ($postBack) {
			$this->LoadFormValues(); // Get form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "I": // Get a record to display
				if (!$loaded) { // Load record based on key
					if ($this->getFailureMessage() == "") $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("inb_leasecars_enquirylist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "inb_leasecars_enquirylist.php")
					$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} elseif ($this->getFailureMessage() == $Language->Phrase("NoRecord")) {
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Render the record
		$this->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->ResetAttrs();
		$this->RenderRow();
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

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->id->FldIsDetailKey)
			$this->id->setFormValue($objForm->GetValue("x_id"));
		if (!$this->selectedType->FldIsDetailKey) {
			$this->selectedType->setFormValue($objForm->GetValue("x_selectedType"));
		}
		if (!$this->vehicleID->FldIsDetailKey) {
			$this->vehicleID->setFormValue($objForm->GetValue("x_vehicleID"));
		}
		if (!$this->individualFirstName->FldIsDetailKey) {
			$this->individualFirstName->setFormValue($objForm->GetValue("x_individualFirstName"));
		}
		if (!$this->corporateCompanyName->FldIsDetailKey) {
			$this->corporateCompanyName->setFormValue($objForm->GetValue("x_corporateCompanyName"));
		}
		if (!$this->corporateFullName->FldIsDetailKey) {
			$this->corporateFullName->setFormValue($objForm->GetValue("x_corporateFullName"));
		}
		if (!$this->individualLastName->FldIsDetailKey) {
			$this->individualLastName->setFormValue($objForm->GetValue("x_individualLastName"));
		}
		if (!$this->corporateNoOfVehicle->FldIsDetailKey) {
			$this->corporateNoOfVehicle->setFormValue($objForm->GetValue("x_corporateNoOfVehicle"));
		}
		if (!$this->_email->FldIsDetailKey) {
			$this->_email->setFormValue($objForm->GetValue("x__email"));
		}
		if (!$this->phone->FldIsDetailKey) {
			$this->phone->setFormValue($objForm->GetValue("x_phone"));
		}
		if (!$this->country->FldIsDetailKey) {
			$this->country->setFormValue($objForm->GetValue("x_country"));
		}
		if (!$this->city->FldIsDetailKey) {
			$this->city->setFormValue($objForm->GetValue("x_city"));
		}
		if (!$this->individualSpecificRequirement->FldIsDetailKey) {
			$this->individualSpecificRequirement->setFormValue($objForm->GetValue("x_individualSpecificRequirement"));
		}
		if (!$this->corporateSpecificRequirement->FldIsDetailKey) {
			$this->corporateSpecificRequirement->setFormValue($objForm->GetValue("x_corporateSpecificRequirement"));
		}
		if (!$this->dateCreated->FldIsDetailKey) {
			$this->dateCreated->setFormValue($objForm->GetValue("x_dateCreated"));
			$this->dateCreated->CurrentValue = ew_UnFormatDateTime($this->dateCreated->CurrentValue, 7);
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->selectedType->CurrentValue = $this->selectedType->FormValue;
		$this->vehicleID->CurrentValue = $this->vehicleID->FormValue;
		$this->individualFirstName->CurrentValue = $this->individualFirstName->FormValue;
		$this->corporateCompanyName->CurrentValue = $this->corporateCompanyName->FormValue;
		$this->corporateFullName->CurrentValue = $this->corporateFullName->FormValue;
		$this->individualLastName->CurrentValue = $this->individualLastName->FormValue;
		$this->corporateNoOfVehicle->CurrentValue = $this->corporateNoOfVehicle->FormValue;
		$this->_email->CurrentValue = $this->_email->FormValue;
		$this->phone->CurrentValue = $this->phone->FormValue;
		$this->country->CurrentValue = $this->country->FormValue;
		$this->city->CurrentValue = $this->city->FormValue;
		$this->individualSpecificRequirement->CurrentValue = $this->individualSpecificRequirement->FormValue;
		$this->corporateSpecificRequirement->CurrentValue = $this->corporateSpecificRequirement->FormValue;
		$this->dateCreated->CurrentValue = $this->dateCreated->FormValue;
		$this->dateCreated->CurrentValue = ew_UnFormatDateTime($this->dateCreated->CurrentValue, 7);
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
		$this->vehicleID->setDbValue($row['vehicleID']);
		$this->individualFirstName->setDbValue($row['individualFirstName']);
		$this->corporateCompanyName->setDbValue($row['corporateCompanyName']);
		$this->corporateFullName->setDbValue($row['corporateFullName']);
		$this->individualLastName->setDbValue($row['individualLastName']);
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
		$row['vehicleID'] = NULL;
		$row['individualFirstName'] = NULL;
		$row['corporateCompanyName'] = NULL;
		$row['corporateFullName'] = NULL;
		$row['individualLastName'] = NULL;
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
		$this->vehicleID->DbValue = $row['vehicleID'];
		$this->individualFirstName->DbValue = $row['individualFirstName'];
		$this->corporateCompanyName->DbValue = $row['corporateCompanyName'];
		$this->corporateFullName->DbValue = $row['corporateFullName'];
		$this->individualLastName->DbValue = $row['individualLastName'];
		$this->corporateNoOfVehicle->DbValue = $row['corporateNoOfVehicle'];
		$this->_email->DbValue = $row['email'];
		$this->phone->DbValue = $row['phone'];
		$this->country->DbValue = $row['country'];
		$this->city->DbValue = $row['city'];
		$this->individualSpecificRequirement->DbValue = $row['individualSpecificRequirement'];
		$this->corporateSpecificRequirement->DbValue = $row['corporateSpecificRequirement'];
		$this->dateCreated->DbValue = $row['dateCreated'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("id")) <> "")
			$this->id->CurrentValue = $this->getKey("id"); // id
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
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// selectedType
		// vehicleID
		// individualFirstName
		// corporateCompanyName
		// corporateFullName
		// individualLastName
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

		// vehicleID
		$this->vehicleID->ViewValue = $this->vehicleID->CurrentValue;
		$this->vehicleID->ViewCustomAttributes = "";

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
		$this->dateCreated->ViewValue = ew_FormatDateTime($this->dateCreated->ViewValue, 7);
		$this->dateCreated->ViewCustomAttributes = "";

			// id
			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";
			$this->id->TooltipValue = "";

			// selectedType
			$this->selectedType->LinkCustomAttributes = "";
			$this->selectedType->HrefValue = "";
			$this->selectedType->TooltipValue = "";

			// vehicleID
			$this->vehicleID->LinkCustomAttributes = "";
			$this->vehicleID->HrefValue = "";
			$this->vehicleID->TooltipValue = "";

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
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$this->id->EditAttrs["class"] = "form-control";
			$this->id->EditCustomAttributes = "";
			$this->id->EditValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// selectedType
			$this->selectedType->EditAttrs["class"] = "form-control";
			$this->selectedType->EditCustomAttributes = "";
			$this->selectedType->EditValue = ew_HtmlEncode($this->selectedType->CurrentValue);
			$this->selectedType->PlaceHolder = ew_RemoveHtml($this->selectedType->FldCaption());

			// vehicleID
			$this->vehicleID->EditAttrs["class"] = "form-control";
			$this->vehicleID->EditCustomAttributes = "";
			$this->vehicleID->EditValue = ew_HtmlEncode($this->vehicleID->CurrentValue);
			$this->vehicleID->PlaceHolder = ew_RemoveHtml($this->vehicleID->FldCaption());

			// individualFirstName
			$this->individualFirstName->EditAttrs["class"] = "form-control";
			$this->individualFirstName->EditCustomAttributes = "";
			$this->individualFirstName->EditValue = ew_HtmlEncode($this->individualFirstName->CurrentValue);
			$this->individualFirstName->PlaceHolder = ew_RemoveHtml($this->individualFirstName->FldCaption());

			// corporateCompanyName
			$this->corporateCompanyName->EditAttrs["class"] = "form-control";
			$this->corporateCompanyName->EditCustomAttributes = "";
			$this->corporateCompanyName->EditValue = ew_HtmlEncode($this->corporateCompanyName->CurrentValue);
			$this->corporateCompanyName->PlaceHolder = ew_RemoveHtml($this->corporateCompanyName->FldCaption());

			// corporateFullName
			$this->corporateFullName->EditAttrs["class"] = "form-control";
			$this->corporateFullName->EditCustomAttributes = "";
			$this->corporateFullName->EditValue = ew_HtmlEncode($this->corporateFullName->CurrentValue);
			$this->corporateFullName->PlaceHolder = ew_RemoveHtml($this->corporateFullName->FldCaption());

			// individualLastName
			$this->individualLastName->EditAttrs["class"] = "form-control";
			$this->individualLastName->EditCustomAttributes = "";
			$this->individualLastName->EditValue = ew_HtmlEncode($this->individualLastName->CurrentValue);
			$this->individualLastName->PlaceHolder = ew_RemoveHtml($this->individualLastName->FldCaption());

			// corporateNoOfVehicle
			$this->corporateNoOfVehicle->EditAttrs["class"] = "form-control";
			$this->corporateNoOfVehicle->EditCustomAttributes = "";
			$this->corporateNoOfVehicle->EditValue = ew_HtmlEncode($this->corporateNoOfVehicle->CurrentValue);
			$this->corporateNoOfVehicle->PlaceHolder = ew_RemoveHtml($this->corporateNoOfVehicle->FldCaption());

			// email
			$this->_email->EditAttrs["class"] = "form-control";
			$this->_email->EditCustomAttributes = "";
			$this->_email->EditValue = ew_HtmlEncode($this->_email->CurrentValue);
			$this->_email->PlaceHolder = ew_RemoveHtml($this->_email->FldCaption());

			// phone
			$this->phone->EditAttrs["class"] = "form-control";
			$this->phone->EditCustomAttributes = "";
			$this->phone->EditValue = ew_HtmlEncode($this->phone->CurrentValue);
			$this->phone->PlaceHolder = ew_RemoveHtml($this->phone->FldCaption());

			// country
			$this->country->EditAttrs["class"] = "form-control";
			$this->country->EditCustomAttributes = "";
			$this->country->EditValue = ew_HtmlEncode($this->country->CurrentValue);
			$this->country->PlaceHolder = ew_RemoveHtml($this->country->FldCaption());

			// city
			$this->city->EditAttrs["class"] = "form-control";
			$this->city->EditCustomAttributes = "";
			$this->city->EditValue = ew_HtmlEncode($this->city->CurrentValue);
			$this->city->PlaceHolder = ew_RemoveHtml($this->city->FldCaption());

			// individualSpecificRequirement
			$this->individualSpecificRequirement->EditAttrs["class"] = "form-control";
			$this->individualSpecificRequirement->EditCustomAttributes = "";
			$this->individualSpecificRequirement->EditValue = ew_HtmlEncode($this->individualSpecificRequirement->CurrentValue);
			$this->individualSpecificRequirement->PlaceHolder = ew_RemoveHtml($this->individualSpecificRequirement->FldCaption());

			// corporateSpecificRequirement
			$this->corporateSpecificRequirement->EditAttrs["class"] = "form-control";
			$this->corporateSpecificRequirement->EditCustomAttributes = "";
			$this->corporateSpecificRequirement->EditValue = ew_HtmlEncode($this->corporateSpecificRequirement->CurrentValue);
			$this->corporateSpecificRequirement->PlaceHolder = ew_RemoveHtml($this->corporateSpecificRequirement->FldCaption());

			// dateCreated
			$this->dateCreated->EditAttrs["class"] = "form-control";
			$this->dateCreated->EditCustomAttributes = "";
			$this->dateCreated->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->dateCreated->CurrentValue, 7));
			$this->dateCreated->PlaceHolder = ew_RemoveHtml($this->dateCreated->FldCaption());

			// Edit refer script
			// id

			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";

			// selectedType
			$this->selectedType->LinkCustomAttributes = "";
			$this->selectedType->HrefValue = "";

			// vehicleID
			$this->vehicleID->LinkCustomAttributes = "";
			$this->vehicleID->HrefValue = "";

			// individualFirstName
			$this->individualFirstName->LinkCustomAttributes = "";
			$this->individualFirstName->HrefValue = "";

			// corporateCompanyName
			$this->corporateCompanyName->LinkCustomAttributes = "";
			$this->corporateCompanyName->HrefValue = "";

			// corporateFullName
			$this->corporateFullName->LinkCustomAttributes = "";
			$this->corporateFullName->HrefValue = "";

			// individualLastName
			$this->individualLastName->LinkCustomAttributes = "";
			$this->individualLastName->HrefValue = "";

			// corporateNoOfVehicle
			$this->corporateNoOfVehicle->LinkCustomAttributes = "";
			$this->corporateNoOfVehicle->HrefValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";

			// phone
			$this->phone->LinkCustomAttributes = "";
			$this->phone->HrefValue = "";

			// country
			$this->country->LinkCustomAttributes = "";
			$this->country->HrefValue = "";

			// city
			$this->city->LinkCustomAttributes = "";
			$this->city->HrefValue = "";

			// individualSpecificRequirement
			$this->individualSpecificRequirement->LinkCustomAttributes = "";
			$this->individualSpecificRequirement->HrefValue = "";

			// corporateSpecificRequirement
			$this->corporateSpecificRequirement->LinkCustomAttributes = "";
			$this->corporateSpecificRequirement->HrefValue = "";

			// dateCreated
			$this->dateCreated->LinkCustomAttributes = "";
			$this->dateCreated->HrefValue = "";
		}
		if ($this->RowType == EW_ROWTYPE_ADD || $this->RowType == EW_ROWTYPE_EDIT || $this->RowType == EW_ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->SetupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckEuroDate($this->dateCreated->FormValue)) {
			ew_AddMessage($gsFormError, $this->dateCreated->FldErrMsg());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$conn = &$this->Connection();
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->LoadDbValues($rsold);
			$rsnew = array();

			// selectedType
			$this->selectedType->SetDbValueDef($rsnew, $this->selectedType->CurrentValue, NULL, $this->selectedType->ReadOnly);

			// vehicleID
			$this->vehicleID->SetDbValueDef($rsnew, $this->vehicleID->CurrentValue, NULL, $this->vehicleID->ReadOnly);

			// individualFirstName
			$this->individualFirstName->SetDbValueDef($rsnew, $this->individualFirstName->CurrentValue, NULL, $this->individualFirstName->ReadOnly);

			// corporateCompanyName
			$this->corporateCompanyName->SetDbValueDef($rsnew, $this->corporateCompanyName->CurrentValue, NULL, $this->corporateCompanyName->ReadOnly);

			// corporateFullName
			$this->corporateFullName->SetDbValueDef($rsnew, $this->corporateFullName->CurrentValue, NULL, $this->corporateFullName->ReadOnly);

			// individualLastName
			$this->individualLastName->SetDbValueDef($rsnew, $this->individualLastName->CurrentValue, NULL, $this->individualLastName->ReadOnly);

			// corporateNoOfVehicle
			$this->corporateNoOfVehicle->SetDbValueDef($rsnew, $this->corporateNoOfVehicle->CurrentValue, NULL, $this->corporateNoOfVehicle->ReadOnly);

			// email
			$this->_email->SetDbValueDef($rsnew, $this->_email->CurrentValue, NULL, $this->_email->ReadOnly);

			// phone
			$this->phone->SetDbValueDef($rsnew, $this->phone->CurrentValue, NULL, $this->phone->ReadOnly);

			// country
			$this->country->SetDbValueDef($rsnew, $this->country->CurrentValue, NULL, $this->country->ReadOnly);

			// city
			$this->city->SetDbValueDef($rsnew, $this->city->CurrentValue, NULL, $this->city->ReadOnly);

			// individualSpecificRequirement
			$this->individualSpecificRequirement->SetDbValueDef($rsnew, $this->individualSpecificRequirement->CurrentValue, NULL, $this->individualSpecificRequirement->ReadOnly);

			// corporateSpecificRequirement
			$this->corporateSpecificRequirement->SetDbValueDef($rsnew, $this->corporateSpecificRequirement->CurrentValue, NULL, $this->corporateSpecificRequirement->ReadOnly);

			// dateCreated
			$this->dateCreated->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->dateCreated->CurrentValue, 7), NULL, $this->dateCreated->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $this->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				if (count($rsnew) > 0)
					$EditRow = $this->Update($rsnew, "", $rsold);
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($EditRow) {
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("inb_leasecars_enquirylist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($inb_leasecars_enquiry_edit)) $inb_leasecars_enquiry_edit = new cinb_leasecars_enquiry_edit();

// Page init
$inb_leasecars_enquiry_edit->Page_Init();

// Page main
$inb_leasecars_enquiry_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inb_leasecars_enquiry_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = finb_leasecars_enquiryedit = new ew_Form("finb_leasecars_enquiryedit", "edit");

// Validate form
finb_leasecars_enquiryedit.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
			elm = this.GetElements("x" + infix + "_dateCreated");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($inb_leasecars_enquiry->dateCreated->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ewForms[val])
			if (!ewForms[val].Validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
finb_leasecars_enquiryedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
finb_leasecars_enquiryedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Multi-Page
finb_leasecars_enquiryedit.MultiPage = new ew_MultiPage("finb_leasecars_enquiryedit");

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $inb_leasecars_enquiry_edit->ShowPageHeader(); ?>
<?php
$inb_leasecars_enquiry_edit->ShowMessage();
?>
<form name="finb_leasecars_enquiryedit" id="finb_leasecars_enquiryedit" class="<?php echo $inb_leasecars_enquiry_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($inb_leasecars_enquiry_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $inb_leasecars_enquiry_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inb_leasecars_enquiry">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($inb_leasecars_enquiry_edit->IsModal) ?>">
<div class="ewMultiPage"><!-- multi-page -->
<div class="nav-tabs-custom" id="inb_leasecars_enquiry_edit"><!-- multi-page .nav-tabs-custom -->
	<ul class="nav<?php echo $inb_leasecars_enquiry_edit->MultiPages->NavStyle() ?>">
		<li<?php echo $inb_leasecars_enquiry_edit->MultiPages->TabStyle("1") ?>><a href="#tab_inb_leasecars_enquiry1" data-toggle="tab"><?php echo $inb_leasecars_enquiry->PageCaption(1) ?></a></li>
		<li<?php echo $inb_leasecars_enquiry_edit->MultiPages->TabStyle("2") ?>><a href="#tab_inb_leasecars_enquiry2" data-toggle="tab"><?php echo $inb_leasecars_enquiry->PageCaption(2) ?></a></li>
		<li<?php echo $inb_leasecars_enquiry_edit->MultiPages->TabStyle("3") ?>><a href="#tab_inb_leasecars_enquiry3" data-toggle="tab"><?php echo $inb_leasecars_enquiry->PageCaption(3) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page .nav-tabs-custom .tab-content -->
		<div class="tab-pane<?php echo $inb_leasecars_enquiry_edit->MultiPages->PageStyle("1") ?>" id="tab_inb_leasecars_enquiry1"><!-- multi-page .tab-pane -->
<div class="ewEditDiv"><!-- page* -->
<?php if ($inb_leasecars_enquiry->id->Visible) { // id ?>
	<div id="r_id" class="form-group">
		<label id="elh_inb_leasecars_enquiry_id" class="<?php echo $inb_leasecars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_leasecars_enquiry->id->FldCaption() ?></label>
		<div class="<?php echo $inb_leasecars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_leasecars_enquiry->id->CellAttributes() ?>>
<span id="el_inb_leasecars_enquiry_id">
<span<?php echo $inb_leasecars_enquiry->id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $inb_leasecars_enquiry->id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="inb_leasecars_enquiry" data-field="x_id" data-page="1" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($inb_leasecars_enquiry->id->CurrentValue) ?>">
<?php echo $inb_leasecars_enquiry->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_leasecars_enquiry->selectedType->Visible) { // selectedType ?>
	<div id="r_selectedType" class="form-group">
		<label id="elh_inb_leasecars_enquiry_selectedType" for="x_selectedType" class="<?php echo $inb_leasecars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_leasecars_enquiry->selectedType->FldCaption() ?></label>
		<div class="<?php echo $inb_leasecars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_leasecars_enquiry->selectedType->CellAttributes() ?>>
<span id="el_inb_leasecars_enquiry_selectedType">
<input type="text" data-table="inb_leasecars_enquiry" data-field="x_selectedType" data-page="1" name="x_selectedType" id="x_selectedType" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_leasecars_enquiry->selectedType->getPlaceHolder()) ?>" value="<?php echo $inb_leasecars_enquiry->selectedType->EditValue ?>"<?php echo $inb_leasecars_enquiry->selectedType->EditAttributes() ?>>
</span>
<?php echo $inb_leasecars_enquiry->selectedType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_leasecars_enquiry->vehicleID->Visible) { // vehicleID ?>
	<div id="r_vehicleID" class="form-group">
		<label id="elh_inb_leasecars_enquiry_vehicleID" for="x_vehicleID" class="<?php echo $inb_leasecars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_leasecars_enquiry->vehicleID->FldCaption() ?></label>
		<div class="<?php echo $inb_leasecars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_leasecars_enquiry->vehicleID->CellAttributes() ?>>
<span id="el_inb_leasecars_enquiry_vehicleID">
<input type="text" data-table="inb_leasecars_enquiry" data-field="x_vehicleID" data-page="1" name="x_vehicleID" id="x_vehicleID" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_leasecars_enquiry->vehicleID->getPlaceHolder()) ?>" value="<?php echo $inb_leasecars_enquiry->vehicleID->EditValue ?>"<?php echo $inb_leasecars_enquiry->vehicleID->EditAttributes() ?>>
</span>
<?php echo $inb_leasecars_enquiry->vehicleID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_leasecars_enquiry->dateCreated->Visible) { // dateCreated ?>
	<div id="r_dateCreated" class="form-group">
		<label id="elh_inb_leasecars_enquiry_dateCreated" for="x_dateCreated" class="<?php echo $inb_leasecars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_leasecars_enquiry->dateCreated->FldCaption() ?></label>
		<div class="<?php echo $inb_leasecars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_leasecars_enquiry->dateCreated->CellAttributes() ?>>
<span id="el_inb_leasecars_enquiry_dateCreated">
<input type="text" data-table="inb_leasecars_enquiry" data-field="x_dateCreated" data-page="1" data-format="7" name="x_dateCreated" id="x_dateCreated" placeholder="<?php echo ew_HtmlEncode($inb_leasecars_enquiry->dateCreated->getPlaceHolder()) ?>" value="<?php echo $inb_leasecars_enquiry->dateCreated->EditValue ?>"<?php echo $inb_leasecars_enquiry->dateCreated->EditAttributes() ?>>
<?php if (!$inb_leasecars_enquiry->dateCreated->ReadOnly && !$inb_leasecars_enquiry->dateCreated->Disabled && !isset($inb_leasecars_enquiry->dateCreated->EditAttrs["readonly"]) && !isset($inb_leasecars_enquiry->dateCreated->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("finb_leasecars_enquiryedit", "x_dateCreated", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php echo $inb_leasecars_enquiry->dateCreated->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $inb_leasecars_enquiry_edit->MultiPages->PageStyle("2") ?>" id="tab_inb_leasecars_enquiry2"><!-- multi-page .tab-pane -->
<div class="ewEditDiv"><!-- page* -->
<?php if ($inb_leasecars_enquiry->individualFirstName->Visible) { // individualFirstName ?>
	<div id="r_individualFirstName" class="form-group">
		<label id="elh_inb_leasecars_enquiry_individualFirstName" for="x_individualFirstName" class="<?php echo $inb_leasecars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_leasecars_enquiry->individualFirstName->FldCaption() ?></label>
		<div class="<?php echo $inb_leasecars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_leasecars_enquiry->individualFirstName->CellAttributes() ?>>
<span id="el_inb_leasecars_enquiry_individualFirstName">
<input type="text" data-table="inb_leasecars_enquiry" data-field="x_individualFirstName" data-page="2" name="x_individualFirstName" id="x_individualFirstName" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_leasecars_enquiry->individualFirstName->getPlaceHolder()) ?>" value="<?php echo $inb_leasecars_enquiry->individualFirstName->EditValue ?>"<?php echo $inb_leasecars_enquiry->individualFirstName->EditAttributes() ?>>
</span>
<?php echo $inb_leasecars_enquiry->individualFirstName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_leasecars_enquiry->individualLastName->Visible) { // individualLastName ?>
	<div id="r_individualLastName" class="form-group">
		<label id="elh_inb_leasecars_enquiry_individualLastName" for="x_individualLastName" class="<?php echo $inb_leasecars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_leasecars_enquiry->individualLastName->FldCaption() ?></label>
		<div class="<?php echo $inb_leasecars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_leasecars_enquiry->individualLastName->CellAttributes() ?>>
<span id="el_inb_leasecars_enquiry_individualLastName">
<input type="text" data-table="inb_leasecars_enquiry" data-field="x_individualLastName" data-page="2" name="x_individualLastName" id="x_individualLastName" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_leasecars_enquiry->individualLastName->getPlaceHolder()) ?>" value="<?php echo $inb_leasecars_enquiry->individualLastName->EditValue ?>"<?php echo $inb_leasecars_enquiry->individualLastName->EditAttributes() ?>>
</span>
<?php echo $inb_leasecars_enquiry->individualLastName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_leasecars_enquiry->_email->Visible) { // email ?>
	<div id="r__email" class="form-group">
		<label id="elh_inb_leasecars_enquiry__email" for="x__email" class="<?php echo $inb_leasecars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_leasecars_enquiry->_email->FldCaption() ?></label>
		<div class="<?php echo $inb_leasecars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_leasecars_enquiry->_email->CellAttributes() ?>>
<span id="el_inb_leasecars_enquiry__email">
<input type="text" data-table="inb_leasecars_enquiry" data-field="x__email" data-page="2" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_leasecars_enquiry->_email->getPlaceHolder()) ?>" value="<?php echo $inb_leasecars_enquiry->_email->EditValue ?>"<?php echo $inb_leasecars_enquiry->_email->EditAttributes() ?>>
</span>
<?php echo $inb_leasecars_enquiry->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_leasecars_enquiry->phone->Visible) { // phone ?>
	<div id="r_phone" class="form-group">
		<label id="elh_inb_leasecars_enquiry_phone" for="x_phone" class="<?php echo $inb_leasecars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_leasecars_enquiry->phone->FldCaption() ?></label>
		<div class="<?php echo $inb_leasecars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_leasecars_enquiry->phone->CellAttributes() ?>>
<span id="el_inb_leasecars_enquiry_phone">
<input type="text" data-table="inb_leasecars_enquiry" data-field="x_phone" data-page="2" name="x_phone" id="x_phone" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_leasecars_enquiry->phone->getPlaceHolder()) ?>" value="<?php echo $inb_leasecars_enquiry->phone->EditValue ?>"<?php echo $inb_leasecars_enquiry->phone->EditAttributes() ?>>
</span>
<?php echo $inb_leasecars_enquiry->phone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_leasecars_enquiry->country->Visible) { // country ?>
	<div id="r_country" class="form-group">
		<label id="elh_inb_leasecars_enquiry_country" for="x_country" class="<?php echo $inb_leasecars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_leasecars_enquiry->country->FldCaption() ?></label>
		<div class="<?php echo $inb_leasecars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_leasecars_enquiry->country->CellAttributes() ?>>
<span id="el_inb_leasecars_enquiry_country">
<input type="text" data-table="inb_leasecars_enquiry" data-field="x_country" data-page="2" name="x_country" id="x_country" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_leasecars_enquiry->country->getPlaceHolder()) ?>" value="<?php echo $inb_leasecars_enquiry->country->EditValue ?>"<?php echo $inb_leasecars_enquiry->country->EditAttributes() ?>>
</span>
<?php echo $inb_leasecars_enquiry->country->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_leasecars_enquiry->city->Visible) { // city ?>
	<div id="r_city" class="form-group">
		<label id="elh_inb_leasecars_enquiry_city" for="x_city" class="<?php echo $inb_leasecars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_leasecars_enquiry->city->FldCaption() ?></label>
		<div class="<?php echo $inb_leasecars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_leasecars_enquiry->city->CellAttributes() ?>>
<span id="el_inb_leasecars_enquiry_city">
<input type="text" data-table="inb_leasecars_enquiry" data-field="x_city" data-page="2" name="x_city" id="x_city" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_leasecars_enquiry->city->getPlaceHolder()) ?>" value="<?php echo $inb_leasecars_enquiry->city->EditValue ?>"<?php echo $inb_leasecars_enquiry->city->EditAttributes() ?>>
</span>
<?php echo $inb_leasecars_enquiry->city->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_leasecars_enquiry->individualSpecificRequirement->Visible) { // individualSpecificRequirement ?>
	<div id="r_individualSpecificRequirement" class="form-group">
		<label id="elh_inb_leasecars_enquiry_individualSpecificRequirement" for="x_individualSpecificRequirement" class="<?php echo $inb_leasecars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_leasecars_enquiry->individualSpecificRequirement->FldCaption() ?></label>
		<div class="<?php echo $inb_leasecars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_leasecars_enquiry->individualSpecificRequirement->CellAttributes() ?>>
<span id="el_inb_leasecars_enquiry_individualSpecificRequirement">
<textarea data-table="inb_leasecars_enquiry" data-field="x_individualSpecificRequirement" data-page="2" name="x_individualSpecificRequirement" id="x_individualSpecificRequirement" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($inb_leasecars_enquiry->individualSpecificRequirement->getPlaceHolder()) ?>"<?php echo $inb_leasecars_enquiry->individualSpecificRequirement->EditAttributes() ?>><?php echo $inb_leasecars_enquiry->individualSpecificRequirement->EditValue ?></textarea>
</span>
<?php echo $inb_leasecars_enquiry->individualSpecificRequirement->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $inb_leasecars_enquiry_edit->MultiPages->PageStyle("3") ?>" id="tab_inb_leasecars_enquiry3"><!-- multi-page .tab-pane -->
<div class="ewEditDiv"><!-- page* -->
<?php if ($inb_leasecars_enquiry->corporateCompanyName->Visible) { // corporateCompanyName ?>
	<div id="r_corporateCompanyName" class="form-group">
		<label id="elh_inb_leasecars_enquiry_corporateCompanyName" for="x_corporateCompanyName" class="<?php echo $inb_leasecars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_leasecars_enquiry->corporateCompanyName->FldCaption() ?></label>
		<div class="<?php echo $inb_leasecars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_leasecars_enquiry->corporateCompanyName->CellAttributes() ?>>
<span id="el_inb_leasecars_enquiry_corporateCompanyName">
<input type="text" data-table="inb_leasecars_enquiry" data-field="x_corporateCompanyName" data-page="3" name="x_corporateCompanyName" id="x_corporateCompanyName" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_leasecars_enquiry->corporateCompanyName->getPlaceHolder()) ?>" value="<?php echo $inb_leasecars_enquiry->corporateCompanyName->EditValue ?>"<?php echo $inb_leasecars_enquiry->corporateCompanyName->EditAttributes() ?>>
</span>
<?php echo $inb_leasecars_enquiry->corporateCompanyName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_leasecars_enquiry->corporateFullName->Visible) { // corporateFullName ?>
	<div id="r_corporateFullName" class="form-group">
		<label id="elh_inb_leasecars_enquiry_corporateFullName" for="x_corporateFullName" class="<?php echo $inb_leasecars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_leasecars_enquiry->corporateFullName->FldCaption() ?></label>
		<div class="<?php echo $inb_leasecars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_leasecars_enquiry->corporateFullName->CellAttributes() ?>>
<span id="el_inb_leasecars_enquiry_corporateFullName">
<input type="text" data-table="inb_leasecars_enquiry" data-field="x_corporateFullName" data-page="3" name="x_corporateFullName" id="x_corporateFullName" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_leasecars_enquiry->corporateFullName->getPlaceHolder()) ?>" value="<?php echo $inb_leasecars_enquiry->corporateFullName->EditValue ?>"<?php echo $inb_leasecars_enquiry->corporateFullName->EditAttributes() ?>>
</span>
<?php echo $inb_leasecars_enquiry->corporateFullName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_leasecars_enquiry->corporateNoOfVehicle->Visible) { // corporateNoOfVehicle ?>
	<div id="r_corporateNoOfVehicle" class="form-group">
		<label id="elh_inb_leasecars_enquiry_corporateNoOfVehicle" for="x_corporateNoOfVehicle" class="<?php echo $inb_leasecars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_leasecars_enquiry->corporateNoOfVehicle->FldCaption() ?></label>
		<div class="<?php echo $inb_leasecars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_leasecars_enquiry->corporateNoOfVehicle->CellAttributes() ?>>
<span id="el_inb_leasecars_enquiry_corporateNoOfVehicle">
<input type="text" data-table="inb_leasecars_enquiry" data-field="x_corporateNoOfVehicle" data-page="3" name="x_corporateNoOfVehicle" id="x_corporateNoOfVehicle" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_leasecars_enquiry->corporateNoOfVehicle->getPlaceHolder()) ?>" value="<?php echo $inb_leasecars_enquiry->corporateNoOfVehicle->EditValue ?>"<?php echo $inb_leasecars_enquiry->corporateNoOfVehicle->EditAttributes() ?>>
</span>
<?php echo $inb_leasecars_enquiry->corporateNoOfVehicle->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_leasecars_enquiry->corporateSpecificRequirement->Visible) { // corporateSpecificRequirement ?>
	<div id="r_corporateSpecificRequirement" class="form-group">
		<label id="elh_inb_leasecars_enquiry_corporateSpecificRequirement" for="x_corporateSpecificRequirement" class="<?php echo $inb_leasecars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_leasecars_enquiry->corporateSpecificRequirement->FldCaption() ?></label>
		<div class="<?php echo $inb_leasecars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_leasecars_enquiry->corporateSpecificRequirement->CellAttributes() ?>>
<span id="el_inb_leasecars_enquiry_corporateSpecificRequirement">
<textarea data-table="inb_leasecars_enquiry" data-field="x_corporateSpecificRequirement" data-page="3" name="x_corporateSpecificRequirement" id="x_corporateSpecificRequirement" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($inb_leasecars_enquiry->corporateSpecificRequirement->getPlaceHolder()) ?>"<?php echo $inb_leasecars_enquiry->corporateSpecificRequirement->EditAttributes() ?>><?php echo $inb_leasecars_enquiry->corporateSpecificRequirement->EditValue ?></textarea>
</span>
<?php echo $inb_leasecars_enquiry->corporateSpecificRequirement->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page .nav-tabs-custom .tab-content -->
</div><!-- /multi-page .nav-tabs-custom -->
</div><!-- /multi-page -->
<?php if (!$inb_leasecars_enquiry_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $inb_leasecars_enquiry_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $inb_leasecars_enquiry_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
finb_leasecars_enquiryedit.Init();
</script>
<?php
$inb_leasecars_enquiry_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$inb_leasecars_enquiry_edit->Page_Terminate();
?>
