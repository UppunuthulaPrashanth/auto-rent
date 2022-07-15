<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "lease_carsinfo.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$lease_cars_add = NULL; // Initialize page object first

class clease_cars_add extends clease_cars {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'lease_cars';

	// Page object name
	var $PageObjName = 'lease_cars_add';

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

		// Table object (lease_cars)
		if (!isset($GLOBALS["lease_cars"]) || get_class($GLOBALS["lease_cars"]) == "clease_cars") {
			$GLOBALS["lease_cars"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["lease_cars"];
		}

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'lease_cars', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("lease_carslist.php"));
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
		$this->makeID->SetVisibility();
		$this->modelID->SetVisibility();
		$this->bodyTypeID->SetVisibility();
		$this->slug->SetVisibility();
		$this->image->SetVisibility();
		$this->extraFeatures->SetVisibility();
		$this->noOfSeats->SetVisibility();
		$this->luggage->SetVisibility();
		$this->transmissionID->SetVisibility();
		$this->ac->SetVisibility();
		$this->noOfDoors->SetVisibility();
		$this->monthlyAED->SetVisibility();
		$this->deliveryAED->SetVisibility();
		$this->so->SetVisibility();
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
		global $EW_EXPORT, $lease_cars;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($lease_cars);
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
					if ($pageName == "lease_carsview.php")
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
			if (@$_GET["leaseCarID"] != "") {
				$this->leaseCarID->setQueryStringValue($_GET["leaseCarID"]);
				$this->setKey("leaseCarID", $this->leaseCarID->CurrentValue); // Set up key
			} else {
				$this->setKey("leaseCarID", ""); // Clear key
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
					$this->Page_Terminate("lease_carslist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "lease_carslist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "lease_carsview.php")
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
		$this->image->Upload->Index = $objForm->Index;
		$this->image->Upload->UploadFile();
		$this->image->CurrentValue = $this->image->Upload->FileName;
	}

	// Load default values
	function LoadDefaultValues() {
		$this->leaseCarID->CurrentValue = NULL;
		$this->leaseCarID->OldValue = $this->leaseCarID->CurrentValue;
		$this->makeID->CurrentValue = 0;
		$this->modelID->CurrentValue = 0;
		$this->bodyTypeID->CurrentValue = NULL;
		$this->bodyTypeID->OldValue = $this->bodyTypeID->CurrentValue;
		$this->slug->CurrentValue = NULL;
		$this->slug->OldValue = $this->slug->CurrentValue;
		$this->image->Upload->DbValue = NULL;
		$this->image->OldValue = $this->image->Upload->DbValue;
		$this->image->CurrentValue = NULL; // Clear file related field
		$this->extraFeatures->CurrentValue = NULL;
		$this->extraFeatures->OldValue = $this->extraFeatures->CurrentValue;
		$this->noOfSeats->CurrentValue = NULL;
		$this->noOfSeats->OldValue = $this->noOfSeats->CurrentValue;
		$this->luggage->CurrentValue = NULL;
		$this->luggage->OldValue = $this->luggage->CurrentValue;
		$this->transmissionID->CurrentValue = NULL;
		$this->transmissionID->OldValue = $this->transmissionID->CurrentValue;
		$this->ac->CurrentValue = NULL;
		$this->ac->OldValue = $this->ac->CurrentValue;
		$this->noOfDoors->CurrentValue = NULL;
		$this->noOfDoors->OldValue = $this->noOfDoors->CurrentValue;
		$this->monthlyAED->CurrentValue = NULL;
		$this->monthlyAED->OldValue = $this->monthlyAED->CurrentValue;
		$this->deliveryAED->CurrentValue = NULL;
		$this->deliveryAED->OldValue = $this->deliveryAED->CurrentValue;
		$this->so->CurrentValue = 0;
		$this->active->CurrentValue = 1;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->makeID->FldIsDetailKey) {
			$this->makeID->setFormValue($objForm->GetValue("x_makeID"));
		}
		if (!$this->modelID->FldIsDetailKey) {
			$this->modelID->setFormValue($objForm->GetValue("x_modelID"));
		}
		if (!$this->bodyTypeID->FldIsDetailKey) {
			$this->bodyTypeID->setFormValue($objForm->GetValue("x_bodyTypeID"));
		}
		if (!$this->slug->FldIsDetailKey) {
			$this->slug->setFormValue($objForm->GetValue("x_slug"));
		}
		if (!$this->extraFeatures->FldIsDetailKey) {
			$this->extraFeatures->setFormValue($objForm->GetValue("x_extraFeatures"));
		}
		if (!$this->noOfSeats->FldIsDetailKey) {
			$this->noOfSeats->setFormValue($objForm->GetValue("x_noOfSeats"));
		}
		if (!$this->luggage->FldIsDetailKey) {
			$this->luggage->setFormValue($objForm->GetValue("x_luggage"));
		}
		if (!$this->transmissionID->FldIsDetailKey) {
			$this->transmissionID->setFormValue($objForm->GetValue("x_transmissionID"));
		}
		if (!$this->ac->FldIsDetailKey) {
			$this->ac->setFormValue($objForm->GetValue("x_ac"));
		}
		if (!$this->noOfDoors->FldIsDetailKey) {
			$this->noOfDoors->setFormValue($objForm->GetValue("x_noOfDoors"));
		}
		if (!$this->monthlyAED->FldIsDetailKey) {
			$this->monthlyAED->setFormValue($objForm->GetValue("x_monthlyAED"));
		}
		if (!$this->deliveryAED->FldIsDetailKey) {
			$this->deliveryAED->setFormValue($objForm->GetValue("x_deliveryAED"));
		}
		if (!$this->so->FldIsDetailKey) {
			$this->so->setFormValue($objForm->GetValue("x_so"));
		}
		if (!$this->active->FldIsDetailKey) {
			$this->active->setFormValue($objForm->GetValue("x_active"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->makeID->CurrentValue = $this->makeID->FormValue;
		$this->modelID->CurrentValue = $this->modelID->FormValue;
		$this->bodyTypeID->CurrentValue = $this->bodyTypeID->FormValue;
		$this->slug->CurrentValue = $this->slug->FormValue;
		$this->extraFeatures->CurrentValue = $this->extraFeatures->FormValue;
		$this->noOfSeats->CurrentValue = $this->noOfSeats->FormValue;
		$this->luggage->CurrentValue = $this->luggage->FormValue;
		$this->transmissionID->CurrentValue = $this->transmissionID->FormValue;
		$this->ac->CurrentValue = $this->ac->FormValue;
		$this->noOfDoors->CurrentValue = $this->noOfDoors->FormValue;
		$this->monthlyAED->CurrentValue = $this->monthlyAED->FormValue;
		$this->deliveryAED->CurrentValue = $this->deliveryAED->FormValue;
		$this->so->CurrentValue = $this->so->FormValue;
		$this->active->CurrentValue = $this->active->FormValue;
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
		$this->leaseCarID->setDbValue($row['leaseCarID']);
		$this->makeID->setDbValue($row['makeID']);
		$this->modelID->setDbValue($row['modelID']);
		$this->bodyTypeID->setDbValue($row['bodyTypeID']);
		$this->slug->setDbValue($row['slug']);
		$this->image->Upload->DbValue = $row['image'];
		$this->image->setDbValue($this->image->Upload->DbValue);
		$this->extraFeatures->setDbValue($row['extraFeatures']);
		$this->noOfSeats->setDbValue($row['noOfSeats']);
		$this->luggage->setDbValue($row['luggage']);
		$this->transmissionID->setDbValue($row['transmissionID']);
		$this->ac->setDbValue($row['ac']);
		$this->noOfDoors->setDbValue($row['noOfDoors']);
		$this->monthlyAED->setDbValue($row['monthlyAED']);
		$this->deliveryAED->setDbValue($row['deliveryAED']);
		$this->so->setDbValue($row['so']);
		$this->active->setDbValue($row['active']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['leaseCarID'] = $this->leaseCarID->CurrentValue;
		$row['makeID'] = $this->makeID->CurrentValue;
		$row['modelID'] = $this->modelID->CurrentValue;
		$row['bodyTypeID'] = $this->bodyTypeID->CurrentValue;
		$row['slug'] = $this->slug->CurrentValue;
		$row['image'] = $this->image->Upload->DbValue;
		$row['extraFeatures'] = $this->extraFeatures->CurrentValue;
		$row['noOfSeats'] = $this->noOfSeats->CurrentValue;
		$row['luggage'] = $this->luggage->CurrentValue;
		$row['transmissionID'] = $this->transmissionID->CurrentValue;
		$row['ac'] = $this->ac->CurrentValue;
		$row['noOfDoors'] = $this->noOfDoors->CurrentValue;
		$row['monthlyAED'] = $this->monthlyAED->CurrentValue;
		$row['deliveryAED'] = $this->deliveryAED->CurrentValue;
		$row['so'] = $this->so->CurrentValue;
		$row['active'] = $this->active->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->leaseCarID->DbValue = $row['leaseCarID'];
		$this->makeID->DbValue = $row['makeID'];
		$this->modelID->DbValue = $row['modelID'];
		$this->bodyTypeID->DbValue = $row['bodyTypeID'];
		$this->slug->DbValue = $row['slug'];
		$this->image->Upload->DbValue = $row['image'];
		$this->extraFeatures->DbValue = $row['extraFeatures'];
		$this->noOfSeats->DbValue = $row['noOfSeats'];
		$this->luggage->DbValue = $row['luggage'];
		$this->transmissionID->DbValue = $row['transmissionID'];
		$this->ac->DbValue = $row['ac'];
		$this->noOfDoors->DbValue = $row['noOfDoors'];
		$this->monthlyAED->DbValue = $row['monthlyAED'];
		$this->deliveryAED->DbValue = $row['deliveryAED'];
		$this->so->DbValue = $row['so'];
		$this->active->DbValue = $row['active'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("leaseCarID")) <> "")
			$this->leaseCarID->CurrentValue = $this->getKey("leaseCarID"); // leaseCarID
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
		// Convert decimal values if posted back

		if ($this->monthlyAED->FormValue == $this->monthlyAED->CurrentValue && is_numeric(ew_StrToFloat($this->monthlyAED->CurrentValue)))
			$this->monthlyAED->CurrentValue = ew_StrToFloat($this->monthlyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->deliveryAED->FormValue == $this->deliveryAED->CurrentValue && is_numeric(ew_StrToFloat($this->deliveryAED->CurrentValue)))
			$this->deliveryAED->CurrentValue = ew_StrToFloat($this->deliveryAED->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// leaseCarID
		// makeID
		// modelID
		// bodyTypeID
		// slug
		// image
		// extraFeatures
		// noOfSeats
		// luggage
		// transmissionID
		// ac
		// noOfDoors
		// monthlyAED
		// deliveryAED
		// so
		// active

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// leaseCarID
		$this->leaseCarID->ViewValue = $this->leaseCarID->CurrentValue;
		$this->leaseCarID->ViewCustomAttributes = "";

		// makeID
		if (strval($this->makeID->CurrentValue) <> "") {
			$sFilterWrk = "`makeID`" . ew_SearchString("=", $this->makeID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `makeID`, `make` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_make`";
		$sWhereWrk = "";
		$this->makeID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->makeID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `make` ASC";
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

		// monthlyAED
		$this->monthlyAED->ViewValue = $this->monthlyAED->CurrentValue;
		$this->monthlyAED->ViewCustomAttributes = "";

		// deliveryAED
		$this->deliveryAED->ViewValue = $this->deliveryAED->CurrentValue;
		$this->deliveryAED->ViewCustomAttributes = "";

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

			// makeID
			$this->makeID->LinkCustomAttributes = "";
			$this->makeID->HrefValue = "";
			$this->makeID->TooltipValue = "";

			// modelID
			$this->modelID->LinkCustomAttributes = "";
			$this->modelID->HrefValue = "";
			$this->modelID->TooltipValue = "";

			// bodyTypeID
			$this->bodyTypeID->LinkCustomAttributes = "";
			$this->bodyTypeID->HrefValue = "";
			$this->bodyTypeID->TooltipValue = "";

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
				$this->image->LinkAttrs["data-rel"] = "lease_cars_x_image";
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

			// monthlyAED
			$this->monthlyAED->LinkCustomAttributes = "";
			$this->monthlyAED->HrefValue = "";
			$this->monthlyAED->TooltipValue = "";

			// deliveryAED
			$this->deliveryAED->LinkCustomAttributes = "";
			$this->deliveryAED->HrefValue = "";
			$this->deliveryAED->TooltipValue = "";

			// so
			$this->so->LinkCustomAttributes = "";
			$this->so->HrefValue = "";
			$this->so->TooltipValue = "";

			// active
			$this->active->LinkCustomAttributes = "";
			$this->active->HrefValue = "";
			$this->active->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// makeID
			$this->makeID->EditAttrs["class"] = "form-control";
			$this->makeID->EditCustomAttributes = "";
			if (trim(strval($this->makeID->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`makeID`" . ew_SearchString("=", $this->makeID->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `makeID`, `make` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `mtr_make`";
			$sWhereWrk = "";
			$this->makeID->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->makeID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `make` ASC";
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->makeID->EditValue = $arwrk;

			// modelID
			$this->modelID->EditAttrs["class"] = "form-control";
			$this->modelID->EditCustomAttributes = "";
			if (trim(strval($this->modelID->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`modelID`" . ew_SearchString("=", $this->modelID->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `modelID`, `model` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, `makeID` AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `mtr_model`";
			$sWhereWrk = "";
			$this->modelID->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->modelID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->modelID->EditValue = $arwrk;

			// bodyTypeID
			$this->bodyTypeID->EditAttrs["class"] = "form-control";
			$this->bodyTypeID->EditCustomAttributes = "";
			if (trim(strval($this->bodyTypeID->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`bodyTypeID`" . ew_SearchString("=", $this->bodyTypeID->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `bodyTypeID`, `bodytype` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `mtr_bodytype`";
			$sWhereWrk = "";
			$this->bodyTypeID->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->bodyTypeID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->bodyTypeID->EditValue = $arwrk;

			// slug
			$this->slug->EditAttrs["class"] = "form-control";
			$this->slug->EditCustomAttributes = "";
			$this->slug->EditValue = ew_HtmlEncode($this->slug->CurrentValue);
			$this->slug->PlaceHolder = ew_RemoveHtml($this->slug->FldCaption());

			// image
			$this->image->EditAttrs["class"] = "form-control";
			$this->image->EditCustomAttributes = "";
			$this->image->UploadPath = 'uploads/rentlease';
			if (!ew_Empty($this->image->Upload->DbValue)) {
				$this->image->ImageWidth = 100;
				$this->image->ImageHeight = 0;
				$this->image->ImageAlt = $this->image->FldAlt();
				$this->image->EditValue = $this->image->Upload->DbValue;
			} else {
				$this->image->EditValue = "";
			}
			if (!ew_Empty($this->image->CurrentValue))
					$this->image->Upload->FileName = $this->image->CurrentValue;
			if (($this->CurrentAction == "I" || $this->CurrentAction == "C") && !$this->EventCancelled) ew_RenderUploadField($this->image);

			// extraFeatures
			$this->extraFeatures->EditCustomAttributes = "";
			if (trim(strval($this->extraFeatures->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$arwrk = explode(",", $this->extraFeatures->CurrentValue);
				$sFilterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
					$sFilterWrk .= "`featureID`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_NUMBER, "");
				}
			}
			$sSqlWrk = "SELECT `featureID`, `extraFeatures` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `mtr_extra_features`";
			$sWhereWrk = "";
			$this->extraFeatures->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->extraFeatures, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->extraFeatures->EditValue = $arwrk;

			// noOfSeats
			$this->noOfSeats->EditAttrs["class"] = "form-control";
			$this->noOfSeats->EditCustomAttributes = "";
			$this->noOfSeats->EditValue = ew_HtmlEncode($this->noOfSeats->CurrentValue);
			$this->noOfSeats->PlaceHolder = ew_RemoveHtml($this->noOfSeats->FldCaption());

			// luggage
			$this->luggage->EditAttrs["class"] = "form-control";
			$this->luggage->EditCustomAttributes = "";
			$this->luggage->EditValue = ew_HtmlEncode($this->luggage->CurrentValue);
			$this->luggage->PlaceHolder = ew_RemoveHtml($this->luggage->FldCaption());

			// transmissionID
			$this->transmissionID->EditAttrs["class"] = "form-control";
			$this->transmissionID->EditCustomAttributes = "";
			if (trim(strval($this->transmissionID->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`transmissionID`" . ew_SearchString("=", $this->transmissionID->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `transmissionID`, `transmission` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `mtr_transmission`";
			$sWhereWrk = "";
			$this->transmissionID->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->transmissionID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->transmissionID->EditValue = $arwrk;

			// ac
			$this->ac->EditCustomAttributes = "";
			$this->ac->EditValue = $this->ac->Options(FALSE);

			// noOfDoors
			$this->noOfDoors->EditAttrs["class"] = "form-control";
			$this->noOfDoors->EditCustomAttributes = "";
			$this->noOfDoors->EditValue = ew_HtmlEncode($this->noOfDoors->CurrentValue);
			$this->noOfDoors->PlaceHolder = ew_RemoveHtml($this->noOfDoors->FldCaption());

			// monthlyAED
			$this->monthlyAED->EditAttrs["class"] = "form-control";
			$this->monthlyAED->EditCustomAttributes = "";
			$this->monthlyAED->EditValue = ew_HtmlEncode($this->monthlyAED->CurrentValue);
			$this->monthlyAED->PlaceHolder = ew_RemoveHtml($this->monthlyAED->FldCaption());
			if (strval($this->monthlyAED->EditValue) <> "" && is_numeric($this->monthlyAED->EditValue)) $this->monthlyAED->EditValue = ew_FormatNumber($this->monthlyAED->EditValue, -2, -1, -2, 0);

			// deliveryAED
			$this->deliveryAED->EditAttrs["class"] = "form-control";
			$this->deliveryAED->EditCustomAttributes = "";
			$this->deliveryAED->EditValue = ew_HtmlEncode($this->deliveryAED->CurrentValue);
			$this->deliveryAED->PlaceHolder = ew_RemoveHtml($this->deliveryAED->FldCaption());
			if (strval($this->deliveryAED->EditValue) <> "" && is_numeric($this->deliveryAED->EditValue)) $this->deliveryAED->EditValue = ew_FormatNumber($this->deliveryAED->EditValue, -2, -1, -2, 0);

			// so
			$this->so->EditAttrs["class"] = "form-control";
			$this->so->EditCustomAttributes = "";
			$this->so->EditValue = ew_HtmlEncode($this->so->CurrentValue);
			$this->so->PlaceHolder = ew_RemoveHtml($this->so->FldCaption());

			// active
			$this->active->EditAttrs["class"] = "form-control";
			$this->active->EditCustomAttributes = "";
			$this->active->EditValue = $this->active->Options(TRUE);

			// Add refer script
			// makeID

			$this->makeID->LinkCustomAttributes = "";
			$this->makeID->HrefValue = "";

			// modelID
			$this->modelID->LinkCustomAttributes = "";
			$this->modelID->HrefValue = "";

			// bodyTypeID
			$this->bodyTypeID->LinkCustomAttributes = "";
			$this->bodyTypeID->HrefValue = "";

			// slug
			$this->slug->LinkCustomAttributes = "";
			$this->slug->HrefValue = "";

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

			// extraFeatures
			$this->extraFeatures->LinkCustomAttributes = "";
			$this->extraFeatures->HrefValue = "";

			// noOfSeats
			$this->noOfSeats->LinkCustomAttributes = "";
			$this->noOfSeats->HrefValue = "";

			// luggage
			$this->luggage->LinkCustomAttributes = "";
			$this->luggage->HrefValue = "";

			// transmissionID
			$this->transmissionID->LinkCustomAttributes = "";
			$this->transmissionID->HrefValue = "";

			// ac
			$this->ac->LinkCustomAttributes = "";
			$this->ac->HrefValue = "";

			// noOfDoors
			$this->noOfDoors->LinkCustomAttributes = "";
			$this->noOfDoors->HrefValue = "";

			// monthlyAED
			$this->monthlyAED->LinkCustomAttributes = "";
			$this->monthlyAED->HrefValue = "";

			// deliveryAED
			$this->deliveryAED->LinkCustomAttributes = "";
			$this->deliveryAED->HrefValue = "";

			// so
			$this->so->LinkCustomAttributes = "";
			$this->so->HrefValue = "";

			// active
			$this->active->LinkCustomAttributes = "";
			$this->active->HrefValue = "";
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
		if (!ew_CheckInteger($this->noOfSeats->FormValue)) {
			ew_AddMessage($gsFormError, $this->noOfSeats->FldErrMsg());
		}
		if (!ew_CheckInteger($this->luggage->FormValue)) {
			ew_AddMessage($gsFormError, $this->luggage->FldErrMsg());
		}
		if (!ew_CheckInteger($this->noOfDoors->FormValue)) {
			ew_AddMessage($gsFormError, $this->noOfDoors->FldErrMsg());
		}
		if (!ew_CheckNumber($this->monthlyAED->FormValue)) {
			ew_AddMessage($gsFormError, $this->monthlyAED->FldErrMsg());
		}
		if (!ew_CheckNumber($this->deliveryAED->FormValue)) {
			ew_AddMessage($gsFormError, $this->deliveryAED->FldErrMsg());
		}
		if (!ew_CheckInteger($this->so->FormValue)) {
			ew_AddMessage($gsFormError, $this->so->FldErrMsg());
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
			$this->image->OldUploadPath = 'uploads/rentlease';
			$this->image->UploadPath = $this->image->OldUploadPath;
		}
		$rsnew = array();

		// makeID
		$this->makeID->SetDbValueDef($rsnew, $this->makeID->CurrentValue, 0, strval($this->makeID->CurrentValue) == "");

		// modelID
		$this->modelID->SetDbValueDef($rsnew, $this->modelID->CurrentValue, 0, strval($this->modelID->CurrentValue) == "");

		// bodyTypeID
		$this->bodyTypeID->SetDbValueDef($rsnew, $this->bodyTypeID->CurrentValue, NULL, FALSE);

		// slug
		$this->slug->SetDbValueDef($rsnew, $this->slug->CurrentValue, NULL, FALSE);

		// image
		if ($this->image->Visible && !$this->image->Upload->KeepFile) {
			$this->image->Upload->DbValue = ""; // No need to delete old file
			if ($this->image->Upload->FileName == "") {
				$rsnew['image'] = NULL;
			} else {
				$rsnew['image'] = $this->image->Upload->FileName;
			}
		}

		// extraFeatures
		$this->extraFeatures->SetDbValueDef($rsnew, $this->extraFeatures->CurrentValue, NULL, FALSE);

		// noOfSeats
		$this->noOfSeats->SetDbValueDef($rsnew, $this->noOfSeats->CurrentValue, NULL, FALSE);

		// luggage
		$this->luggage->SetDbValueDef($rsnew, $this->luggage->CurrentValue, NULL, FALSE);

		// transmissionID
		$this->transmissionID->SetDbValueDef($rsnew, $this->transmissionID->CurrentValue, NULL, FALSE);

		// ac
		$tmpBool = $this->ac->CurrentValue;
		if ($tmpBool <> "Y" && $tmpBool <> "N")
			$tmpBool = (!empty($tmpBool)) ? "Y" : "N";
		$this->ac->SetDbValueDef($rsnew, $tmpBool, NULL, FALSE);

		// noOfDoors
		$this->noOfDoors->SetDbValueDef($rsnew, $this->noOfDoors->CurrentValue, NULL, FALSE);

		// monthlyAED
		$this->monthlyAED->SetDbValueDef($rsnew, $this->monthlyAED->CurrentValue, NULL, FALSE);

		// deliveryAED
		$this->deliveryAED->SetDbValueDef($rsnew, $this->deliveryAED->CurrentValue, NULL, FALSE);

		// so
		$this->so->SetDbValueDef($rsnew, $this->so->CurrentValue, NULL, strval($this->so->CurrentValue) == "");

		// active
		$this->active->SetDbValueDef($rsnew, $this->active->CurrentValue, NULL, strval($this->active->CurrentValue) == "");
		if ($this->image->Visible && !$this->image->Upload->KeepFile) {
			$this->image->UploadPath = 'uploads/rentlease';
			$OldFiles = ew_Empty($this->image->Upload->DbValue) ? array() : array($this->image->Upload->DbValue);
			if (!ew_Empty($this->image->Upload->FileName)) {
				$NewFiles = array($this->image->Upload->FileName);
				$NewFileCount = count($NewFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					$fldvar = ($this->image->Upload->Index < 0) ? $this->image->FldVar : substr($this->image->FldVar, 0, 1) . $this->image->Upload->Index . substr($this->image->FldVar, 1);
					if ($NewFiles[$i] <> "") {
						$file = $NewFiles[$i];
						if (file_exists(ew_UploadTempPath($fldvar, $this->image->TblVar) . $file)) {
							$file1 = ew_UploadFileNameEx($this->image->PhysicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(ew_UploadTempPath($fldvar, $this->image->TblVar) . $file1) || file_exists($this->image->PhysicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = ew_UniqueFilename($this->image->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(ew_UploadTempPath($fldvar, $this->image->TblVar) . $file, ew_UploadTempPath($fldvar, $this->image->TblVar) . $file1);
								$NewFiles[$i] = $file1;
							}
						}
					}
				}
				$this->image->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
				$this->image->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
				$this->image->SetDbValueDef($rsnew, $this->image->Upload->FileName, NULL, FALSE);
			}
		}

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$AddRow = $this->Insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($AddRow) {
				if ($this->image->Visible && !$this->image->Upload->KeepFile) {
					$OldFiles = ew_Empty($this->image->Upload->DbValue) ? array() : array($this->image->Upload->DbValue);
					if (!ew_Empty($this->image->Upload->FileName)) {
						$NewFiles = array($this->image->Upload->FileName);
						$NewFiles2 = array($rsnew['image']);
						$NewFileCount = count($NewFiles);
						for ($i = 0; $i < $NewFileCount; $i++) {
							$fldvar = ($this->image->Upload->Index < 0) ? $this->image->FldVar : substr($this->image->FldVar, 0, 1) . $this->image->Upload->Index . substr($this->image->FldVar, 1);
							if ($NewFiles[$i] <> "") {
								$file = ew_UploadTempPath($fldvar, $this->image->TblVar) . $NewFiles[$i];
								if (file_exists($file)) {
									if (@$NewFiles2[$i] <> "") // Use correct file name
										$NewFiles[$i] = $NewFiles2[$i];
									if (!$this->image->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->Phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$NewFiles = array();
					}
				}
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

		// image
		ew_CleanUploadTempPath($this->image, $this->image->Upload->Index);
		return $AddRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("lease_carslist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_makeID":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `makeID` AS `LinkFld`, `make` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_make`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`makeID` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->makeID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `make` ASC";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_modelID":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `modelID` AS `LinkFld`, `model` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_model`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`modelID` IN ({filter_value})', "t0" => "3", "fn0" => "", "f1" => '`makeID` IN ({filter_value})', "t1" => "3", "fn1" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->modelID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_bodyTypeID":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `bodyTypeID` AS `LinkFld`, `bodytype` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_bodytype`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`bodyTypeID` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->bodyTypeID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_extraFeatures":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `featureID` AS `LinkFld`, `extraFeatures` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_extra_features`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`featureID` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->extraFeatures, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_transmissionID":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `transmissionID` AS `LinkFld`, `transmission` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_transmission`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`transmissionID` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->transmissionID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
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
if (!isset($lease_cars_add)) $lease_cars_add = new clease_cars_add();

// Page init
$lease_cars_add->Page_Init();

// Page main
$lease_cars_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$lease_cars_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = flease_carsadd = new ew_Form("flease_carsadd", "add");

// Validate form
flease_carsadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_noOfSeats");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($lease_cars->noOfSeats->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_luggage");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($lease_cars->luggage->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_noOfDoors");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($lease_cars->noOfDoors->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_monthlyAED");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($lease_cars->monthlyAED->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_deliveryAED");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($lease_cars->deliveryAED->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_so");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($lease_cars->so->FldErrMsg()) ?>");

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
flease_carsadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
flease_carsadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
flease_carsadd.Lists["x_makeID"] = {"LinkField":"x_makeID","Ajax":true,"AutoFill":false,"DisplayFields":["x_make","","",""],"ParentFields":[],"ChildFields":["x_modelID"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_make"};
flease_carsadd.Lists["x_makeID"].Data = "<?php echo $lease_cars_add->makeID->LookupFilterQuery(FALSE, "add") ?>";
flease_carsadd.Lists["x_modelID"] = {"LinkField":"x_modelID","Ajax":true,"AutoFill":false,"DisplayFields":["x_model","","",""],"ParentFields":["x_makeID"],"ChildFields":[],"FilterFields":["x_makeID"],"Options":[],"Template":"","LinkTable":"mtr_model"};
flease_carsadd.Lists["x_modelID"].Data = "<?php echo $lease_cars_add->modelID->LookupFilterQuery(FALSE, "add") ?>";
flease_carsadd.Lists["x_bodyTypeID"] = {"LinkField":"x_bodyTypeID","Ajax":true,"AutoFill":false,"DisplayFields":["x_bodytype","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_bodytype"};
flease_carsadd.Lists["x_bodyTypeID"].Data = "<?php echo $lease_cars_add->bodyTypeID->LookupFilterQuery(FALSE, "add") ?>";
flease_carsadd.Lists["x_extraFeatures[]"] = {"LinkField":"x_featureID","Ajax":true,"AutoFill":false,"DisplayFields":["x_extraFeatures","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_extra_features"};
flease_carsadd.Lists["x_extraFeatures[]"].Data = "<?php echo $lease_cars_add->extraFeatures->LookupFilterQuery(FALSE, "add") ?>";
flease_carsadd.Lists["x_transmissionID"] = {"LinkField":"x_transmissionID","Ajax":true,"AutoFill":false,"DisplayFields":["x_transmission","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_transmission"};
flease_carsadd.Lists["x_transmissionID"].Data = "<?php echo $lease_cars_add->transmissionID->LookupFilterQuery(FALSE, "add") ?>";
flease_carsadd.Lists["x_ac[]"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
flease_carsadd.Lists["x_ac[]"].Options = <?php echo json_encode($lease_cars_add->ac->Options()) ?>;
flease_carsadd.Lists["x_active"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
flease_carsadd.Lists["x_active"].Options = <?php echo json_encode($lease_cars_add->active->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $lease_cars_add->ShowPageHeader(); ?>
<?php
$lease_cars_add->ShowMessage();
?>
<form name="flease_carsadd" id="flease_carsadd" class="<?php echo $lease_cars_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($lease_cars_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $lease_cars_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="lease_cars">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($lease_cars_add->IsModal) ?>">
<div class="ewAddDiv"><!-- page* -->
<?php if ($lease_cars->makeID->Visible) { // makeID ?>
	<div id="r_makeID" class="form-group">
		<label id="elh_lease_cars_makeID" for="x_makeID" class="<?php echo $lease_cars_add->LeftColumnClass ?>"><?php echo $lease_cars->makeID->FldCaption() ?></label>
		<div class="<?php echo $lease_cars_add->RightColumnClass ?>"><div<?php echo $lease_cars->makeID->CellAttributes() ?>>
<span id="el_lease_cars_makeID">
<?php $lease_cars->makeID->EditAttrs["onchange"] = "ew_UpdateOpt.call(this); " . @$lease_cars->makeID->EditAttrs["onchange"]; ?>
<select data-table="lease_cars" data-field="x_makeID" data-value-separator="<?php echo $lease_cars->makeID->DisplayValueSeparatorAttribute() ?>" id="x_makeID" name="x_makeID"<?php echo $lease_cars->makeID->EditAttributes() ?>>
<?php echo $lease_cars->makeID->SelectOptionListHtml("x_makeID") ?>
</select>
</span>
<?php echo $lease_cars->makeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lease_cars->modelID->Visible) { // modelID ?>
	<div id="r_modelID" class="form-group">
		<label id="elh_lease_cars_modelID" for="x_modelID" class="<?php echo $lease_cars_add->LeftColumnClass ?>"><?php echo $lease_cars->modelID->FldCaption() ?></label>
		<div class="<?php echo $lease_cars_add->RightColumnClass ?>"><div<?php echo $lease_cars->modelID->CellAttributes() ?>>
<span id="el_lease_cars_modelID">
<select data-table="lease_cars" data-field="x_modelID" data-value-separator="<?php echo $lease_cars->modelID->DisplayValueSeparatorAttribute() ?>" id="x_modelID" name="x_modelID"<?php echo $lease_cars->modelID->EditAttributes() ?>>
<?php echo $lease_cars->modelID->SelectOptionListHtml("x_modelID") ?>
</select>
</span>
<?php echo $lease_cars->modelID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lease_cars->bodyTypeID->Visible) { // bodyTypeID ?>
	<div id="r_bodyTypeID" class="form-group">
		<label id="elh_lease_cars_bodyTypeID" for="x_bodyTypeID" class="<?php echo $lease_cars_add->LeftColumnClass ?>"><?php echo $lease_cars->bodyTypeID->FldCaption() ?></label>
		<div class="<?php echo $lease_cars_add->RightColumnClass ?>"><div<?php echo $lease_cars->bodyTypeID->CellAttributes() ?>>
<span id="el_lease_cars_bodyTypeID">
<select data-table="lease_cars" data-field="x_bodyTypeID" data-value-separator="<?php echo $lease_cars->bodyTypeID->DisplayValueSeparatorAttribute() ?>" id="x_bodyTypeID" name="x_bodyTypeID"<?php echo $lease_cars->bodyTypeID->EditAttributes() ?>>
<?php echo $lease_cars->bodyTypeID->SelectOptionListHtml("x_bodyTypeID") ?>
</select>
</span>
<?php echo $lease_cars->bodyTypeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lease_cars->slug->Visible) { // slug ?>
	<div id="r_slug" class="form-group">
		<label id="elh_lease_cars_slug" for="x_slug" class="<?php echo $lease_cars_add->LeftColumnClass ?>"><?php echo $lease_cars->slug->FldCaption() ?></label>
		<div class="<?php echo $lease_cars_add->RightColumnClass ?>"><div<?php echo $lease_cars->slug->CellAttributes() ?>>
<span id="el_lease_cars_slug">
<input type="text" data-table="lease_cars" data-field="x_slug" name="x_slug" id="x_slug" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($lease_cars->slug->getPlaceHolder()) ?>" value="<?php echo $lease_cars->slug->EditValue ?>"<?php echo $lease_cars->slug->EditAttributes() ?>>
</span>
<?php echo $lease_cars->slug->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lease_cars->image->Visible) { // image ?>
	<div id="r_image" class="form-group">
		<label id="elh_lease_cars_image" class="<?php echo $lease_cars_add->LeftColumnClass ?>"><?php echo $lease_cars->image->FldCaption() ?></label>
		<div class="<?php echo $lease_cars_add->RightColumnClass ?>"><div<?php echo $lease_cars->image->CellAttributes() ?>>
<span id="el_lease_cars_image">
<div id="fd_x_image">
<span title="<?php echo $lease_cars->image->FldTitle() ? $lease_cars->image->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($lease_cars->image->ReadOnly || $lease_cars->image->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="lease_cars" data-field="x_image" name="x_image" id="x_image"<?php echo $lease_cars->image->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_image" id= "fn_x_image" value="<?php echo $lease_cars->image->Upload->FileName ?>">
<input type="hidden" name="fa_x_image" id= "fa_x_image" value="0">
<input type="hidden" name="fs_x_image" id= "fs_x_image" value="255">
<input type="hidden" name="fx_x_image" id= "fx_x_image" value="<?php echo $lease_cars->image->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_image" id= "fm_x_image" value="<?php echo $lease_cars->image->UploadMaxFileSize ?>">
</div>
<table id="ft_x_image" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $lease_cars->image->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lease_cars->extraFeatures->Visible) { // extraFeatures ?>
	<div id="r_extraFeatures" class="form-group">
		<label id="elh_lease_cars_extraFeatures" class="<?php echo $lease_cars_add->LeftColumnClass ?>"><?php echo $lease_cars->extraFeatures->FldCaption() ?></label>
		<div class="<?php echo $lease_cars_add->RightColumnClass ?>"><div<?php echo $lease_cars->extraFeatures->CellAttributes() ?>>
<span id="el_lease_cars_extraFeatures">
<div id="tp_x_extraFeatures" class="ewTemplate"><input type="checkbox" data-table="lease_cars" data-field="x_extraFeatures" data-value-separator="<?php echo $lease_cars->extraFeatures->DisplayValueSeparatorAttribute() ?>" name="x_extraFeatures[]" id="x_extraFeatures[]" value="{value}"<?php echo $lease_cars->extraFeatures->EditAttributes() ?>></div>
<div id="dsl_x_extraFeatures" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $lease_cars->extraFeatures->CheckBoxListHtml(FALSE, "x_extraFeatures[]") ?>
</div></div>
</span>
<?php echo $lease_cars->extraFeatures->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lease_cars->noOfSeats->Visible) { // noOfSeats ?>
	<div id="r_noOfSeats" class="form-group">
		<label id="elh_lease_cars_noOfSeats" for="x_noOfSeats" class="<?php echo $lease_cars_add->LeftColumnClass ?>"><?php echo $lease_cars->noOfSeats->FldCaption() ?></label>
		<div class="<?php echo $lease_cars_add->RightColumnClass ?>"><div<?php echo $lease_cars->noOfSeats->CellAttributes() ?>>
<span id="el_lease_cars_noOfSeats">
<input type="text" data-table="lease_cars" data-field="x_noOfSeats" name="x_noOfSeats" id="x_noOfSeats" size="30" placeholder="<?php echo ew_HtmlEncode($lease_cars->noOfSeats->getPlaceHolder()) ?>" value="<?php echo $lease_cars->noOfSeats->EditValue ?>"<?php echo $lease_cars->noOfSeats->EditAttributes() ?>>
</span>
<?php echo $lease_cars->noOfSeats->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lease_cars->luggage->Visible) { // luggage ?>
	<div id="r_luggage" class="form-group">
		<label id="elh_lease_cars_luggage" for="x_luggage" class="<?php echo $lease_cars_add->LeftColumnClass ?>"><?php echo $lease_cars->luggage->FldCaption() ?></label>
		<div class="<?php echo $lease_cars_add->RightColumnClass ?>"><div<?php echo $lease_cars->luggage->CellAttributes() ?>>
<span id="el_lease_cars_luggage">
<input type="text" data-table="lease_cars" data-field="x_luggage" name="x_luggage" id="x_luggage" size="30" placeholder="<?php echo ew_HtmlEncode($lease_cars->luggage->getPlaceHolder()) ?>" value="<?php echo $lease_cars->luggage->EditValue ?>"<?php echo $lease_cars->luggage->EditAttributes() ?>>
</span>
<?php echo $lease_cars->luggage->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lease_cars->transmissionID->Visible) { // transmissionID ?>
	<div id="r_transmissionID" class="form-group">
		<label id="elh_lease_cars_transmissionID" for="x_transmissionID" class="<?php echo $lease_cars_add->LeftColumnClass ?>"><?php echo $lease_cars->transmissionID->FldCaption() ?></label>
		<div class="<?php echo $lease_cars_add->RightColumnClass ?>"><div<?php echo $lease_cars->transmissionID->CellAttributes() ?>>
<span id="el_lease_cars_transmissionID">
<select data-table="lease_cars" data-field="x_transmissionID" data-value-separator="<?php echo $lease_cars->transmissionID->DisplayValueSeparatorAttribute() ?>" id="x_transmissionID" name="x_transmissionID"<?php echo $lease_cars->transmissionID->EditAttributes() ?>>
<?php echo $lease_cars->transmissionID->SelectOptionListHtml("x_transmissionID") ?>
</select>
</span>
<?php echo $lease_cars->transmissionID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lease_cars->ac->Visible) { // ac ?>
	<div id="r_ac" class="form-group">
		<label id="elh_lease_cars_ac" class="<?php echo $lease_cars_add->LeftColumnClass ?>"><?php echo $lease_cars->ac->FldCaption() ?></label>
		<div class="<?php echo $lease_cars_add->RightColumnClass ?>"><div<?php echo $lease_cars->ac->CellAttributes() ?>>
<span id="el_lease_cars_ac">
<?php
$selwrk = (ew_ConvertToBool($lease_cars->ac->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="lease_cars" data-field="x_ac" name="x_ac[]" id="x_ac[]" value="1"<?php echo $selwrk ?><?php echo $lease_cars->ac->EditAttributes() ?>>
</span>
<?php echo $lease_cars->ac->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lease_cars->noOfDoors->Visible) { // noOfDoors ?>
	<div id="r_noOfDoors" class="form-group">
		<label id="elh_lease_cars_noOfDoors" for="x_noOfDoors" class="<?php echo $lease_cars_add->LeftColumnClass ?>"><?php echo $lease_cars->noOfDoors->FldCaption() ?></label>
		<div class="<?php echo $lease_cars_add->RightColumnClass ?>"><div<?php echo $lease_cars->noOfDoors->CellAttributes() ?>>
<span id="el_lease_cars_noOfDoors">
<input type="text" data-table="lease_cars" data-field="x_noOfDoors" name="x_noOfDoors" id="x_noOfDoors" size="30" placeholder="<?php echo ew_HtmlEncode($lease_cars->noOfDoors->getPlaceHolder()) ?>" value="<?php echo $lease_cars->noOfDoors->EditValue ?>"<?php echo $lease_cars->noOfDoors->EditAttributes() ?>>
</span>
<?php echo $lease_cars->noOfDoors->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lease_cars->monthlyAED->Visible) { // monthlyAED ?>
	<div id="r_monthlyAED" class="form-group">
		<label id="elh_lease_cars_monthlyAED" for="x_monthlyAED" class="<?php echo $lease_cars_add->LeftColumnClass ?>"><?php echo $lease_cars->monthlyAED->FldCaption() ?></label>
		<div class="<?php echo $lease_cars_add->RightColumnClass ?>"><div<?php echo $lease_cars->monthlyAED->CellAttributes() ?>>
<span id="el_lease_cars_monthlyAED">
<input type="text" data-table="lease_cars" data-field="x_monthlyAED" name="x_monthlyAED" id="x_monthlyAED" size="30" placeholder="<?php echo ew_HtmlEncode($lease_cars->monthlyAED->getPlaceHolder()) ?>" value="<?php echo $lease_cars->monthlyAED->EditValue ?>"<?php echo $lease_cars->monthlyAED->EditAttributes() ?>>
</span>
<?php echo $lease_cars->monthlyAED->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lease_cars->deliveryAED->Visible) { // deliveryAED ?>
	<div id="r_deliveryAED" class="form-group">
		<label id="elh_lease_cars_deliveryAED" for="x_deliveryAED" class="<?php echo $lease_cars_add->LeftColumnClass ?>"><?php echo $lease_cars->deliveryAED->FldCaption() ?></label>
		<div class="<?php echo $lease_cars_add->RightColumnClass ?>"><div<?php echo $lease_cars->deliveryAED->CellAttributes() ?>>
<span id="el_lease_cars_deliveryAED">
<input type="text" data-table="lease_cars" data-field="x_deliveryAED" name="x_deliveryAED" id="x_deliveryAED" size="30" placeholder="<?php echo ew_HtmlEncode($lease_cars->deliveryAED->getPlaceHolder()) ?>" value="<?php echo $lease_cars->deliveryAED->EditValue ?>"<?php echo $lease_cars->deliveryAED->EditAttributes() ?>>
</span>
<?php echo $lease_cars->deliveryAED->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lease_cars->so->Visible) { // so ?>
	<div id="r_so" class="form-group">
		<label id="elh_lease_cars_so" for="x_so" class="<?php echo $lease_cars_add->LeftColumnClass ?>"><?php echo $lease_cars->so->FldCaption() ?></label>
		<div class="<?php echo $lease_cars_add->RightColumnClass ?>"><div<?php echo $lease_cars->so->CellAttributes() ?>>
<span id="el_lease_cars_so">
<input type="text" data-table="lease_cars" data-field="x_so" name="x_so" id="x_so" size="30" placeholder="<?php echo ew_HtmlEncode($lease_cars->so->getPlaceHolder()) ?>" value="<?php echo $lease_cars->so->EditValue ?>"<?php echo $lease_cars->so->EditAttributes() ?>>
</span>
<?php echo $lease_cars->so->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lease_cars->active->Visible) { // active ?>
	<div id="r_active" class="form-group">
		<label id="elh_lease_cars_active" for="x_active" class="<?php echo $lease_cars_add->LeftColumnClass ?>"><?php echo $lease_cars->active->FldCaption() ?></label>
		<div class="<?php echo $lease_cars_add->RightColumnClass ?>"><div<?php echo $lease_cars->active->CellAttributes() ?>>
<span id="el_lease_cars_active">
<select data-table="lease_cars" data-field="x_active" data-value-separator="<?php echo $lease_cars->active->DisplayValueSeparatorAttribute() ?>" id="x_active" name="x_active"<?php echo $lease_cars->active->EditAttributes() ?>>
<?php echo $lease_cars->active->SelectOptionListHtml("x_active") ?>
</select>
</span>
<?php echo $lease_cars->active->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$lease_cars_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $lease_cars_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $lease_cars_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
flease_carsadd.Init();
</script>
<?php
$lease_cars_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$lease_cars_add->Page_Terminate();
?>
