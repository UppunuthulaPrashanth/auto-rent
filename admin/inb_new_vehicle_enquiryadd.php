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

$inb_new_vehicle_enquiry_add = NULL; // Initialize page object first

class cinb_new_vehicle_enquiry_add extends cinb_new_vehicle_enquiry {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'inb_new_vehicle_enquiry';

	// Page object name
	var $PageObjName = 'inb_new_vehicle_enquiry_add';

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

		// Table object (inb_new_vehicle_enquiry)
		if (!isset($GLOBALS["inb_new_vehicle_enquiry"]) || get_class($GLOBALS["inb_new_vehicle_enquiry"]) == "cinb_new_vehicle_enquiry") {
			$GLOBALS["inb_new_vehicle_enquiry"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["inb_new_vehicle_enquiry"];
		}

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
		if (!$Security->CanAdd()) {
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
		// Create form object

		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
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
	var $FormClassName = "form-horizontal ewForm ewAddForm";
	var $IsModal = FALSE;
	var $IsMobileOrModal = FALSE;
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;
	var $MultiPages; // Multi pages object

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError;
		global $gbSkipHeaderFooter;

		// Check modal
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = ew_IsMobile() || $this->IsModal;
		$this->FormClassName = "ewForm ewAddForm form-horizontal";

		// Set up current action
		if (@$_POST["a_add"] <> "") {
			$this->CurrentAction = $_POST["a_add"]; // Get form action
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id"] != "") {
				$this->id->setQueryStringValue($_GET["id"]);
				$this->setKey("id", $this->id->CurrentValue); // Set up key
			} else {
				$this->setKey("id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "C"; // Copy record
			} else {
				$this->CurrentAction = "I"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->LoadOldRecord();

		// Load form values
		if (@$_POST["a_add"] <> "") {
			$this->LoadFormValues(); // Load form values
		}

		// Validate form if post back
		if (@$_POST["a_add"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = "I"; // Form error, reset action
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "I": // Blank record
				break;
			case "C": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "") $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("inb_new_vehicle_enquirylist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "inb_new_vehicle_enquirylist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "inb_new_vehicle_enquiryview.php")
						$sReturnUrl = $this->GetViewUrl(); // View page, return to View page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Render row based on row type
		$this->RowType = EW_ROWTYPE_ADD; // Render add type

		// Render row
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->selectedType->CurrentValue = NULL;
		$this->selectedType->OldValue = $this->selectedType->CurrentValue;
		$this->individualFirstName->CurrentValue = NULL;
		$this->individualFirstName->OldValue = $this->individualFirstName->CurrentValue;
		$this->corporateCompanyName->CurrentValue = NULL;
		$this->corporateCompanyName->OldValue = $this->corporateCompanyName->CurrentValue;
		$this->corporateFullName->CurrentValue = NULL;
		$this->corporateFullName->OldValue = $this->corporateFullName->CurrentValue;
		$this->individualLastName->CurrentValue = NULL;
		$this->individualLastName->OldValue = $this->individualLastName->CurrentValue;
		$this->individualVehicle->CurrentValue = NULL;
		$this->individualVehicle->OldValue = $this->individualVehicle->CurrentValue;
		$this->corporateVehicle->CurrentValue = NULL;
		$this->corporateVehicle->OldValue = $this->corporateVehicle->CurrentValue;
		$this->corporateNoOfVehicle->CurrentValue = NULL;
		$this->corporateNoOfVehicle->OldValue = $this->corporateNoOfVehicle->CurrentValue;
		$this->_email->CurrentValue = NULL;
		$this->_email->OldValue = $this->_email->CurrentValue;
		$this->phone->CurrentValue = NULL;
		$this->phone->OldValue = $this->phone->CurrentValue;
		$this->country->CurrentValue = NULL;
		$this->country->OldValue = $this->country->CurrentValue;
		$this->city->CurrentValue = NULL;
		$this->city->OldValue = $this->city->CurrentValue;
		$this->individualSpecificRequirement->CurrentValue = NULL;
		$this->individualSpecificRequirement->OldValue = $this->individualSpecificRequirement->CurrentValue;
		$this->corporateSpecificRequirement->CurrentValue = NULL;
		$this->corporateSpecificRequirement->OldValue = $this->corporateSpecificRequirement->CurrentValue;
		$this->dateCreated->CurrentValue = NULL;
		$this->dateCreated->OldValue = $this->dateCreated->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->selectedType->FldIsDetailKey) {
			$this->selectedType->setFormValue($objForm->GetValue("x_selectedType"));
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
		if (!$this->individualVehicle->FldIsDetailKey) {
			$this->individualVehicle->setFormValue($objForm->GetValue("x_individualVehicle"));
		}
		if (!$this->corporateVehicle->FldIsDetailKey) {
			$this->corporateVehicle->setFormValue($objForm->GetValue("x_corporateVehicle"));
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
			$this->dateCreated->CurrentValue = ew_UnFormatDateTime($this->dateCreated->CurrentValue, 0);
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->selectedType->CurrentValue = $this->selectedType->FormValue;
		$this->individualFirstName->CurrentValue = $this->individualFirstName->FormValue;
		$this->corporateCompanyName->CurrentValue = $this->corporateCompanyName->FormValue;
		$this->corporateFullName->CurrentValue = $this->corporateFullName->FormValue;
		$this->individualLastName->CurrentValue = $this->individualLastName->FormValue;
		$this->individualVehicle->CurrentValue = $this->individualVehicle->FormValue;
		$this->corporateVehicle->CurrentValue = $this->corporateVehicle->FormValue;
		$this->corporateNoOfVehicle->CurrentValue = $this->corporateNoOfVehicle->FormValue;
		$this->_email->CurrentValue = $this->_email->FormValue;
		$this->phone->CurrentValue = $this->phone->FormValue;
		$this->country->CurrentValue = $this->country->FormValue;
		$this->city->CurrentValue = $this->city->FormValue;
		$this->individualSpecificRequirement->CurrentValue = $this->individualSpecificRequirement->FormValue;
		$this->corporateSpecificRequirement->CurrentValue = $this->corporateSpecificRequirement->FormValue;
		$this->dateCreated->CurrentValue = $this->dateCreated->FormValue;
		$this->dateCreated->CurrentValue = ew_UnFormatDateTime($this->dateCreated->CurrentValue, 0);
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
		$this->LoadDefaultValues();
		$row = array();
		$row['id'] = $this->id->CurrentValue;
		$row['selectedType'] = $this->selectedType->CurrentValue;
		$row['individualFirstName'] = $this->individualFirstName->CurrentValue;
		$row['corporateCompanyName'] = $this->corporateCompanyName->CurrentValue;
		$row['corporateFullName'] = $this->corporateFullName->CurrentValue;
		$row['individualLastName'] = $this->individualLastName->CurrentValue;
		$row['individualVehicle'] = $this->individualVehicle->CurrentValue;
		$row['corporateVehicle'] = $this->corporateVehicle->CurrentValue;
		$row['corporateNoOfVehicle'] = $this->corporateNoOfVehicle->CurrentValue;
		$row['email'] = $this->_email->CurrentValue;
		$row['phone'] = $this->phone->CurrentValue;
		$row['country'] = $this->country->CurrentValue;
		$row['city'] = $this->city->CurrentValue;
		$row['individualSpecificRequirement'] = $this->individualSpecificRequirement->CurrentValue;
		$row['corporateSpecificRequirement'] = $this->corporateSpecificRequirement->CurrentValue;
		$row['dateCreated'] = $this->dateCreated->CurrentValue;
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
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// selectedType
			$this->selectedType->EditAttrs["class"] = "form-control";
			$this->selectedType->EditCustomAttributes = "";
			$this->selectedType->EditValue = ew_HtmlEncode($this->selectedType->CurrentValue);
			$this->selectedType->PlaceHolder = ew_RemoveHtml($this->selectedType->FldCaption());

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

			// individualVehicle
			$this->individualVehicle->EditAttrs["class"] = "form-control";
			$this->individualVehicle->EditCustomAttributes = "";
			$this->individualVehicle->EditValue = ew_HtmlEncode($this->individualVehicle->CurrentValue);
			$this->individualVehicle->PlaceHolder = ew_RemoveHtml($this->individualVehicle->FldCaption());

			// corporateVehicle
			$this->corporateVehicle->EditAttrs["class"] = "form-control";
			$this->corporateVehicle->EditCustomAttributes = "";
			$this->corporateVehicle->EditValue = ew_HtmlEncode($this->corporateVehicle->CurrentValue);
			$this->corporateVehicle->PlaceHolder = ew_RemoveHtml($this->corporateVehicle->FldCaption());

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
			$this->dateCreated->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->dateCreated->CurrentValue, 8));
			$this->dateCreated->PlaceHolder = ew_RemoveHtml($this->dateCreated->FldCaption());

			// Add refer script
			// selectedType

			$this->selectedType->LinkCustomAttributes = "";
			$this->selectedType->HrefValue = "";

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

			// individualVehicle
			$this->individualVehicle->LinkCustomAttributes = "";
			$this->individualVehicle->HrefValue = "";

			// corporateVehicle
			$this->corporateVehicle->LinkCustomAttributes = "";
			$this->corporateVehicle->HrefValue = "";

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
		if (!ew_CheckDateDef($this->dateCreated->FormValue)) {
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

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;
		$conn = &$this->Connection();

		// Load db values from rsold
		$this->LoadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = array();

		// selectedType
		$this->selectedType->SetDbValueDef($rsnew, $this->selectedType->CurrentValue, NULL, FALSE);

		// individualFirstName
		$this->individualFirstName->SetDbValueDef($rsnew, $this->individualFirstName->CurrentValue, NULL, FALSE);

		// corporateCompanyName
		$this->corporateCompanyName->SetDbValueDef($rsnew, $this->corporateCompanyName->CurrentValue, NULL, FALSE);

		// corporateFullName
		$this->corporateFullName->SetDbValueDef($rsnew, $this->corporateFullName->CurrentValue, NULL, FALSE);

		// individualLastName
		$this->individualLastName->SetDbValueDef($rsnew, $this->individualLastName->CurrentValue, NULL, FALSE);

		// individualVehicle
		$this->individualVehicle->SetDbValueDef($rsnew, $this->individualVehicle->CurrentValue, NULL, FALSE);

		// corporateVehicle
		$this->corporateVehicle->SetDbValueDef($rsnew, $this->corporateVehicle->CurrentValue, NULL, FALSE);

		// corporateNoOfVehicle
		$this->corporateNoOfVehicle->SetDbValueDef($rsnew, $this->corporateNoOfVehicle->CurrentValue, NULL, FALSE);

		// email
		$this->_email->SetDbValueDef($rsnew, $this->_email->CurrentValue, NULL, FALSE);

		// phone
		$this->phone->SetDbValueDef($rsnew, $this->phone->CurrentValue, NULL, FALSE);

		// country
		$this->country->SetDbValueDef($rsnew, $this->country->CurrentValue, NULL, FALSE);

		// city
		$this->city->SetDbValueDef($rsnew, $this->city->CurrentValue, NULL, FALSE);

		// individualSpecificRequirement
		$this->individualSpecificRequirement->SetDbValueDef($rsnew, $this->individualSpecificRequirement->CurrentValue, NULL, FALSE);

		// corporateSpecificRequirement
		$this->corporateSpecificRequirement->SetDbValueDef($rsnew, $this->corporateSpecificRequirement->CurrentValue, NULL, FALSE);

		// dateCreated
		$this->dateCreated->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->dateCreated->CurrentValue, 0), NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$AddRow = $this->Insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($AddRow) {
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("inb_new_vehicle_enquirylist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
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
if (!isset($inb_new_vehicle_enquiry_add)) $inb_new_vehicle_enquiry_add = new cinb_new_vehicle_enquiry_add();

// Page init
$inb_new_vehicle_enquiry_add->Page_Init();

// Page main
$inb_new_vehicle_enquiry_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inb_new_vehicle_enquiry_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = finb_new_vehicle_enquiryadd = new ew_Form("finb_new_vehicle_enquiryadd", "add");

// Validate form
finb_new_vehicle_enquiryadd.Validate = function() {
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
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($inb_new_vehicle_enquiry->dateCreated->FldErrMsg()) ?>");

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
finb_new_vehicle_enquiryadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
finb_new_vehicle_enquiryadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Multi-Page
finb_new_vehicle_enquiryadd.MultiPage = new ew_MultiPage("finb_new_vehicle_enquiryadd");

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $inb_new_vehicle_enquiry_add->ShowPageHeader(); ?>
<?php
$inb_new_vehicle_enquiry_add->ShowMessage();
?>
<form name="finb_new_vehicle_enquiryadd" id="finb_new_vehicle_enquiryadd" class="<?php echo $inb_new_vehicle_enquiry_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($inb_new_vehicle_enquiry_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $inb_new_vehicle_enquiry_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inb_new_vehicle_enquiry">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($inb_new_vehicle_enquiry_add->IsModal) ?>">
<div class="ewMultiPage"><!-- multi-page -->
<div class="nav-tabs-custom" id="inb_new_vehicle_enquiry_add"><!-- multi-page .nav-tabs-custom -->
	<ul class="nav<?php echo $inb_new_vehicle_enquiry_add->MultiPages->NavStyle() ?>">
		<li<?php echo $inb_new_vehicle_enquiry_add->MultiPages->TabStyle("1") ?>><a href="#tab_inb_new_vehicle_enquiry1" data-toggle="tab"><?php echo $inb_new_vehicle_enquiry->PageCaption(1) ?></a></li>
		<li<?php echo $inb_new_vehicle_enquiry_add->MultiPages->TabStyle("2") ?>><a href="#tab_inb_new_vehicle_enquiry2" data-toggle="tab"><?php echo $inb_new_vehicle_enquiry->PageCaption(2) ?></a></li>
		<li<?php echo $inb_new_vehicle_enquiry_add->MultiPages->TabStyle("3") ?>><a href="#tab_inb_new_vehicle_enquiry3" data-toggle="tab"><?php echo $inb_new_vehicle_enquiry->PageCaption(3) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page .nav-tabs-custom .tab-content -->
		<div class="tab-pane<?php echo $inb_new_vehicle_enquiry_add->MultiPages->PageStyle("1") ?>" id="tab_inb_new_vehicle_enquiry1"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($inb_new_vehicle_enquiry->selectedType->Visible) { // selectedType ?>
	<div id="r_selectedType" class="form-group">
		<label id="elh_inb_new_vehicle_enquiry_selectedType" for="x_selectedType" class="<?php echo $inb_new_vehicle_enquiry_add->LeftColumnClass ?>"><?php echo $inb_new_vehicle_enquiry->selectedType->FldCaption() ?></label>
		<div class="<?php echo $inb_new_vehicle_enquiry_add->RightColumnClass ?>"><div<?php echo $inb_new_vehicle_enquiry->selectedType->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry_selectedType">
<input type="text" data-table="inb_new_vehicle_enquiry" data-field="x_selectedType" data-page="1" name="x_selectedType" id="x_selectedType" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_new_vehicle_enquiry->selectedType->getPlaceHolder()) ?>" value="<?php echo $inb_new_vehicle_enquiry->selectedType->EditValue ?>"<?php echo $inb_new_vehicle_enquiry->selectedType->EditAttributes() ?>>
</span>
<?php echo $inb_new_vehicle_enquiry->selectedType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->dateCreated->Visible) { // dateCreated ?>
	<div id="r_dateCreated" class="form-group">
		<label id="elh_inb_new_vehicle_enquiry_dateCreated" for="x_dateCreated" class="<?php echo $inb_new_vehicle_enquiry_add->LeftColumnClass ?>"><?php echo $inb_new_vehicle_enquiry->dateCreated->FldCaption() ?></label>
		<div class="<?php echo $inb_new_vehicle_enquiry_add->RightColumnClass ?>"><div<?php echo $inb_new_vehicle_enquiry->dateCreated->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry_dateCreated">
<input type="text" data-table="inb_new_vehicle_enquiry" data-field="x_dateCreated" data-page="1" name="x_dateCreated" id="x_dateCreated" placeholder="<?php echo ew_HtmlEncode($inb_new_vehicle_enquiry->dateCreated->getPlaceHolder()) ?>" value="<?php echo $inb_new_vehicle_enquiry->dateCreated->EditValue ?>"<?php echo $inb_new_vehicle_enquiry->dateCreated->EditAttributes() ?>>
</span>
<?php echo $inb_new_vehicle_enquiry->dateCreated->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $inb_new_vehicle_enquiry_add->MultiPages->PageStyle("2") ?>" id="tab_inb_new_vehicle_enquiry2"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($inb_new_vehicle_enquiry->individualFirstName->Visible) { // individualFirstName ?>
	<div id="r_individualFirstName" class="form-group">
		<label id="elh_inb_new_vehicle_enquiry_individualFirstName" for="x_individualFirstName" class="<?php echo $inb_new_vehicle_enquiry_add->LeftColumnClass ?>"><?php echo $inb_new_vehicle_enquiry->individualFirstName->FldCaption() ?></label>
		<div class="<?php echo $inb_new_vehicle_enquiry_add->RightColumnClass ?>"><div<?php echo $inb_new_vehicle_enquiry->individualFirstName->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry_individualFirstName">
<input type="text" data-table="inb_new_vehicle_enquiry" data-field="x_individualFirstName" data-page="2" name="x_individualFirstName" id="x_individualFirstName" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_new_vehicle_enquiry->individualFirstName->getPlaceHolder()) ?>" value="<?php echo $inb_new_vehicle_enquiry->individualFirstName->EditValue ?>"<?php echo $inb_new_vehicle_enquiry->individualFirstName->EditAttributes() ?>>
</span>
<?php echo $inb_new_vehicle_enquiry->individualFirstName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->individualLastName->Visible) { // individualLastName ?>
	<div id="r_individualLastName" class="form-group">
		<label id="elh_inb_new_vehicle_enquiry_individualLastName" for="x_individualLastName" class="<?php echo $inb_new_vehicle_enquiry_add->LeftColumnClass ?>"><?php echo $inb_new_vehicle_enquiry->individualLastName->FldCaption() ?></label>
		<div class="<?php echo $inb_new_vehicle_enquiry_add->RightColumnClass ?>"><div<?php echo $inb_new_vehicle_enquiry->individualLastName->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry_individualLastName">
<input type="text" data-table="inb_new_vehicle_enquiry" data-field="x_individualLastName" data-page="2" name="x_individualLastName" id="x_individualLastName" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_new_vehicle_enquiry->individualLastName->getPlaceHolder()) ?>" value="<?php echo $inb_new_vehicle_enquiry->individualLastName->EditValue ?>"<?php echo $inb_new_vehicle_enquiry->individualLastName->EditAttributes() ?>>
</span>
<?php echo $inb_new_vehicle_enquiry->individualLastName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->individualVehicle->Visible) { // individualVehicle ?>
	<div id="r_individualVehicle" class="form-group">
		<label id="elh_inb_new_vehicle_enquiry_individualVehicle" for="x_individualVehicle" class="<?php echo $inb_new_vehicle_enquiry_add->LeftColumnClass ?>"><?php echo $inb_new_vehicle_enquiry->individualVehicle->FldCaption() ?></label>
		<div class="<?php echo $inb_new_vehicle_enquiry_add->RightColumnClass ?>"><div<?php echo $inb_new_vehicle_enquiry->individualVehicle->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry_individualVehicle">
<input type="text" data-table="inb_new_vehicle_enquiry" data-field="x_individualVehicle" data-page="2" name="x_individualVehicle" id="x_individualVehicle" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_new_vehicle_enquiry->individualVehicle->getPlaceHolder()) ?>" value="<?php echo $inb_new_vehicle_enquiry->individualVehicle->EditValue ?>"<?php echo $inb_new_vehicle_enquiry->individualVehicle->EditAttributes() ?>>
</span>
<?php echo $inb_new_vehicle_enquiry->individualVehicle->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->_email->Visible) { // email ?>
	<div id="r__email" class="form-group">
		<label id="elh_inb_new_vehicle_enquiry__email" for="x__email" class="<?php echo $inb_new_vehicle_enquiry_add->LeftColumnClass ?>"><?php echo $inb_new_vehicle_enquiry->_email->FldCaption() ?></label>
		<div class="<?php echo $inb_new_vehicle_enquiry_add->RightColumnClass ?>"><div<?php echo $inb_new_vehicle_enquiry->_email->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry__email">
<input type="text" data-table="inb_new_vehicle_enquiry" data-field="x__email" data-page="2" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_new_vehicle_enquiry->_email->getPlaceHolder()) ?>" value="<?php echo $inb_new_vehicle_enquiry->_email->EditValue ?>"<?php echo $inb_new_vehicle_enquiry->_email->EditAttributes() ?>>
</span>
<?php echo $inb_new_vehicle_enquiry->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->phone->Visible) { // phone ?>
	<div id="r_phone" class="form-group">
		<label id="elh_inb_new_vehicle_enquiry_phone" for="x_phone" class="<?php echo $inb_new_vehicle_enquiry_add->LeftColumnClass ?>"><?php echo $inb_new_vehicle_enquiry->phone->FldCaption() ?></label>
		<div class="<?php echo $inb_new_vehicle_enquiry_add->RightColumnClass ?>"><div<?php echo $inb_new_vehicle_enquiry->phone->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry_phone">
<input type="text" data-table="inb_new_vehicle_enquiry" data-field="x_phone" data-page="2" name="x_phone" id="x_phone" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_new_vehicle_enquiry->phone->getPlaceHolder()) ?>" value="<?php echo $inb_new_vehicle_enquiry->phone->EditValue ?>"<?php echo $inb_new_vehicle_enquiry->phone->EditAttributes() ?>>
</span>
<?php echo $inb_new_vehicle_enquiry->phone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->country->Visible) { // country ?>
	<div id="r_country" class="form-group">
		<label id="elh_inb_new_vehicle_enquiry_country" for="x_country" class="<?php echo $inb_new_vehicle_enquiry_add->LeftColumnClass ?>"><?php echo $inb_new_vehicle_enquiry->country->FldCaption() ?></label>
		<div class="<?php echo $inb_new_vehicle_enquiry_add->RightColumnClass ?>"><div<?php echo $inb_new_vehicle_enquiry->country->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry_country">
<input type="text" data-table="inb_new_vehicle_enquiry" data-field="x_country" data-page="2" name="x_country" id="x_country" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_new_vehicle_enquiry->country->getPlaceHolder()) ?>" value="<?php echo $inb_new_vehicle_enquiry->country->EditValue ?>"<?php echo $inb_new_vehicle_enquiry->country->EditAttributes() ?>>
</span>
<?php echo $inb_new_vehicle_enquiry->country->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->city->Visible) { // city ?>
	<div id="r_city" class="form-group">
		<label id="elh_inb_new_vehicle_enquiry_city" for="x_city" class="<?php echo $inb_new_vehicle_enquiry_add->LeftColumnClass ?>"><?php echo $inb_new_vehicle_enquiry->city->FldCaption() ?></label>
		<div class="<?php echo $inb_new_vehicle_enquiry_add->RightColumnClass ?>"><div<?php echo $inb_new_vehicle_enquiry->city->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry_city">
<input type="text" data-table="inb_new_vehicle_enquiry" data-field="x_city" data-page="2" name="x_city" id="x_city" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_new_vehicle_enquiry->city->getPlaceHolder()) ?>" value="<?php echo $inb_new_vehicle_enquiry->city->EditValue ?>"<?php echo $inb_new_vehicle_enquiry->city->EditAttributes() ?>>
</span>
<?php echo $inb_new_vehicle_enquiry->city->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->individualSpecificRequirement->Visible) { // individualSpecificRequirement ?>
	<div id="r_individualSpecificRequirement" class="form-group">
		<label id="elh_inb_new_vehicle_enquiry_individualSpecificRequirement" for="x_individualSpecificRequirement" class="<?php echo $inb_new_vehicle_enquiry_add->LeftColumnClass ?>"><?php echo $inb_new_vehicle_enquiry->individualSpecificRequirement->FldCaption() ?></label>
		<div class="<?php echo $inb_new_vehicle_enquiry_add->RightColumnClass ?>"><div<?php echo $inb_new_vehicle_enquiry->individualSpecificRequirement->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry_individualSpecificRequirement">
<textarea data-table="inb_new_vehicle_enquiry" data-field="x_individualSpecificRequirement" data-page="2" name="x_individualSpecificRequirement" id="x_individualSpecificRequirement" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($inb_new_vehicle_enquiry->individualSpecificRequirement->getPlaceHolder()) ?>"<?php echo $inb_new_vehicle_enquiry->individualSpecificRequirement->EditAttributes() ?>><?php echo $inb_new_vehicle_enquiry->individualSpecificRequirement->EditValue ?></textarea>
</span>
<?php echo $inb_new_vehicle_enquiry->individualSpecificRequirement->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $inb_new_vehicle_enquiry_add->MultiPages->PageStyle("3") ?>" id="tab_inb_new_vehicle_enquiry3"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($inb_new_vehicle_enquiry->corporateCompanyName->Visible) { // corporateCompanyName ?>
	<div id="r_corporateCompanyName" class="form-group">
		<label id="elh_inb_new_vehicle_enquiry_corporateCompanyName" for="x_corporateCompanyName" class="<?php echo $inb_new_vehicle_enquiry_add->LeftColumnClass ?>"><?php echo $inb_new_vehicle_enquiry->corporateCompanyName->FldCaption() ?></label>
		<div class="<?php echo $inb_new_vehicle_enquiry_add->RightColumnClass ?>"><div<?php echo $inb_new_vehicle_enquiry->corporateCompanyName->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry_corporateCompanyName">
<input type="text" data-table="inb_new_vehicle_enquiry" data-field="x_corporateCompanyName" data-page="3" name="x_corporateCompanyName" id="x_corporateCompanyName" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_new_vehicle_enquiry->corporateCompanyName->getPlaceHolder()) ?>" value="<?php echo $inb_new_vehicle_enquiry->corporateCompanyName->EditValue ?>"<?php echo $inb_new_vehicle_enquiry->corporateCompanyName->EditAttributes() ?>>
</span>
<?php echo $inb_new_vehicle_enquiry->corporateCompanyName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->corporateFullName->Visible) { // corporateFullName ?>
	<div id="r_corporateFullName" class="form-group">
		<label id="elh_inb_new_vehicle_enquiry_corporateFullName" for="x_corporateFullName" class="<?php echo $inb_new_vehicle_enquiry_add->LeftColumnClass ?>"><?php echo $inb_new_vehicle_enquiry->corporateFullName->FldCaption() ?></label>
		<div class="<?php echo $inb_new_vehicle_enquiry_add->RightColumnClass ?>"><div<?php echo $inb_new_vehicle_enquiry->corporateFullName->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry_corporateFullName">
<input type="text" data-table="inb_new_vehicle_enquiry" data-field="x_corporateFullName" data-page="3" name="x_corporateFullName" id="x_corporateFullName" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_new_vehicle_enquiry->corporateFullName->getPlaceHolder()) ?>" value="<?php echo $inb_new_vehicle_enquiry->corporateFullName->EditValue ?>"<?php echo $inb_new_vehicle_enquiry->corporateFullName->EditAttributes() ?>>
</span>
<?php echo $inb_new_vehicle_enquiry->corporateFullName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->corporateVehicle->Visible) { // corporateVehicle ?>
	<div id="r_corporateVehicle" class="form-group">
		<label id="elh_inb_new_vehicle_enquiry_corporateVehicle" for="x_corporateVehicle" class="<?php echo $inb_new_vehicle_enquiry_add->LeftColumnClass ?>"><?php echo $inb_new_vehicle_enquiry->corporateVehicle->FldCaption() ?></label>
		<div class="<?php echo $inb_new_vehicle_enquiry_add->RightColumnClass ?>"><div<?php echo $inb_new_vehicle_enquiry->corporateVehicle->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry_corporateVehicle">
<input type="text" data-table="inb_new_vehicle_enquiry" data-field="x_corporateVehicle" data-page="3" name="x_corporateVehicle" id="x_corporateVehicle" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_new_vehicle_enquiry->corporateVehicle->getPlaceHolder()) ?>" value="<?php echo $inb_new_vehicle_enquiry->corporateVehicle->EditValue ?>"<?php echo $inb_new_vehicle_enquiry->corporateVehicle->EditAttributes() ?>>
</span>
<?php echo $inb_new_vehicle_enquiry->corporateVehicle->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->corporateNoOfVehicle->Visible) { // corporateNoOfVehicle ?>
	<div id="r_corporateNoOfVehicle" class="form-group">
		<label id="elh_inb_new_vehicle_enquiry_corporateNoOfVehicle" for="x_corporateNoOfVehicle" class="<?php echo $inb_new_vehicle_enquiry_add->LeftColumnClass ?>"><?php echo $inb_new_vehicle_enquiry->corporateNoOfVehicle->FldCaption() ?></label>
		<div class="<?php echo $inb_new_vehicle_enquiry_add->RightColumnClass ?>"><div<?php echo $inb_new_vehicle_enquiry->corporateNoOfVehicle->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry_corporateNoOfVehicle">
<input type="text" data-table="inb_new_vehicle_enquiry" data-field="x_corporateNoOfVehicle" data-page="3" name="x_corporateNoOfVehicle" id="x_corporateNoOfVehicle" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_new_vehicle_enquiry->corporateNoOfVehicle->getPlaceHolder()) ?>" value="<?php echo $inb_new_vehicle_enquiry->corporateNoOfVehicle->EditValue ?>"<?php echo $inb_new_vehicle_enquiry->corporateNoOfVehicle->EditAttributes() ?>>
</span>
<?php echo $inb_new_vehicle_enquiry->corporateNoOfVehicle->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->corporateSpecificRequirement->Visible) { // corporateSpecificRequirement ?>
	<div id="r_corporateSpecificRequirement" class="form-group">
		<label id="elh_inb_new_vehicle_enquiry_corporateSpecificRequirement" for="x_corporateSpecificRequirement" class="<?php echo $inb_new_vehicle_enquiry_add->LeftColumnClass ?>"><?php echo $inb_new_vehicle_enquiry->corporateSpecificRequirement->FldCaption() ?></label>
		<div class="<?php echo $inb_new_vehicle_enquiry_add->RightColumnClass ?>"><div<?php echo $inb_new_vehicle_enquiry->corporateSpecificRequirement->CellAttributes() ?>>
<span id="el_inb_new_vehicle_enquiry_corporateSpecificRequirement">
<textarea data-table="inb_new_vehicle_enquiry" data-field="x_corporateSpecificRequirement" data-page="3" name="x_corporateSpecificRequirement" id="x_corporateSpecificRequirement" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($inb_new_vehicle_enquiry->corporateSpecificRequirement->getPlaceHolder()) ?>"<?php echo $inb_new_vehicle_enquiry->corporateSpecificRequirement->EditAttributes() ?>><?php echo $inb_new_vehicle_enquiry->corporateSpecificRequirement->EditValue ?></textarea>
</span>
<?php echo $inb_new_vehicle_enquiry->corporateSpecificRequirement->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page .nav-tabs-custom .tab-content -->
</div><!-- /multi-page .nav-tabs-custom -->
</div><!-- /multi-page -->
<?php if (!$inb_new_vehicle_enquiry_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $inb_new_vehicle_enquiry_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $inb_new_vehicle_enquiry_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
finb_new_vehicle_enquiryadd.Init();
</script>
<?php
$inb_new_vehicle_enquiry_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$inb_new_vehicle_enquiry_add->Page_Terminate();
?>
