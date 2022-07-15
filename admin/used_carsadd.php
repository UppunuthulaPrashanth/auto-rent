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

$used_cars_add = NULL; // Initialize page object first

class cused_cars_add extends cused_cars {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'used_cars';

	// Page object name
	var $PageObjName = 'used_cars_add';

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

		// Table object (used_cars)
		if (!isset($GLOBALS["used_cars"]) || get_class($GLOBALS["used_cars"]) == "cused_cars") {
			$GLOBALS["used_cars"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["used_cars"];
		}

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("used_carslist.php"));
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
			if (@$_GET["userCarID"] != "") {
				$this->userCarID->setQueryStringValue($_GET["userCarID"]);
				$this->setKey("userCarID", $this->userCarID->CurrentValue); // Set up key
			} else {
				$this->setKey("userCarID", ""); // Clear key
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
					$this->Page_Terminate("used_carslist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "used_carslist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "used_carsview.php")
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
		$this->_thumbnail->Upload->Index = $objForm->Index;
		$this->_thumbnail->Upload->UploadFile();
		$this->_thumbnail->CurrentValue = $this->_thumbnail->Upload->FileName;
		$this->img_01->Upload->Index = $objForm->Index;
		$this->img_01->Upload->UploadFile();
		$this->img_01->CurrentValue = $this->img_01->Upload->FileName;
		$this->img_02->Upload->Index = $objForm->Index;
		$this->img_02->Upload->UploadFile();
		$this->img_02->CurrentValue = $this->img_02->Upload->FileName;
		$this->img_03->Upload->Index = $objForm->Index;
		$this->img_03->Upload->UploadFile();
		$this->img_03->CurrentValue = $this->img_03->Upload->FileName;
		$this->img_04->Upload->Index = $objForm->Index;
		$this->img_04->Upload->UploadFile();
		$this->img_04->CurrentValue = $this->img_04->Upload->FileName;
		$this->img_05->Upload->Index = $objForm->Index;
		$this->img_05->Upload->UploadFile();
		$this->img_05->CurrentValue = $this->img_05->Upload->FileName;
		$this->img_06->Upload->Index = $objForm->Index;
		$this->img_06->Upload->UploadFile();
		$this->img_06->CurrentValue = $this->img_06->Upload->FileName;
		$this->img_07->Upload->Index = $objForm->Index;
		$this->img_07->Upload->UploadFile();
		$this->img_07->CurrentValue = $this->img_07->Upload->FileName;
		$this->img_08->Upload->Index = $objForm->Index;
		$this->img_08->Upload->UploadFile();
		$this->img_08->CurrentValue = $this->img_08->Upload->FileName;
		$this->img_09->Upload->Index = $objForm->Index;
		$this->img_09->Upload->UploadFile();
		$this->img_09->CurrentValue = $this->img_09->Upload->FileName;
		$this->img_10->Upload->Index = $objForm->Index;
		$this->img_10->Upload->UploadFile();
		$this->img_10->CurrentValue = $this->img_10->Upload->FileName;
		$this->img_11->Upload->Index = $objForm->Index;
		$this->img_11->Upload->UploadFile();
		$this->img_11->CurrentValue = $this->img_11->Upload->FileName;
		$this->img_12->Upload->Index = $objForm->Index;
		$this->img_12->Upload->UploadFile();
		$this->img_12->CurrentValue = $this->img_12->Upload->FileName;
	}

	// Load default values
	function LoadDefaultValues() {
		$this->userCarID->CurrentValue = NULL;
		$this->userCarID->OldValue = $this->userCarID->CurrentValue;
		$this->makeID->CurrentValue = NULL;
		$this->makeID->OldValue = $this->makeID->CurrentValue;
		$this->modelID->CurrentValue = NULL;
		$this->modelID->OldValue = $this->modelID->CurrentValue;
		$this->slug->CurrentValue = NULL;
		$this->slug->OldValue = $this->slug->CurrentValue;
		$this->yearID->CurrentValue = NULL;
		$this->yearID->OldValue = $this->yearID->CurrentValue;
		$this->kilometers->CurrentValue = NULL;
		$this->kilometers->OldValue = $this->kilometers->CurrentValue;
		$this->priceAED->CurrentValue = NULL;
		$this->priceAED->OldValue = $this->priceAED->CurrentValue;
		$this->priceUSD->CurrentValue = NULL;
		$this->priceUSD->OldValue = $this->priceUSD->CurrentValue;
		$this->priceOMR->CurrentValue = NULL;
		$this->priceOMR->OldValue = $this->priceOMR->CurrentValue;
		$this->priceSAR->CurrentValue = NULL;
		$this->priceSAR->OldValue = $this->priceSAR->CurrentValue;
		$this->description->CurrentValue = NULL;
		$this->description->OldValue = $this->description->CurrentValue;
		$this->fuelTypeID->CurrentValue = NULL;
		$this->fuelTypeID->OldValue = $this->fuelTypeID->CurrentValue;
		$this->regionalID->CurrentValue = NULL;
		$this->regionalID->OldValue = $this->regionalID->CurrentValue;
		$this->warrantyID->CurrentValue = NULL;
		$this->warrantyID->OldValue = $this->warrantyID->CurrentValue;
		$this->noOfDoors->CurrentValue = NULL;
		$this->noOfDoors->OldValue = $this->noOfDoors->CurrentValue;
		$this->transmissionTypeID->CurrentValue = NULL;
		$this->transmissionTypeID->OldValue = $this->transmissionTypeID->CurrentValue;
		$this->cylinderID->CurrentValue = NULL;
		$this->cylinderID->OldValue = $this->cylinderID->CurrentValue;
		$this->engine->CurrentValue = NULL;
		$this->engine->OldValue = $this->engine->CurrentValue;
		$this->colorID->CurrentValue = NULL;
		$this->colorID->OldValue = $this->colorID->CurrentValue;
		$this->bodyConditionID->CurrentValue = NULL;
		$this->bodyConditionID->OldValue = $this->bodyConditionID->CurrentValue;
		$this->summary->CurrentValue = NULL;
		$this->summary->OldValue = $this->summary->CurrentValue;
		$this->term->CurrentValue = NULL;
		$this->term->OldValue = $this->term->CurrentValue;
		$this->_thumbnail->Upload->DbValue = NULL;
		$this->_thumbnail->OldValue = $this->_thumbnail->Upload->DbValue;
		$this->_thumbnail->CurrentValue = NULL; // Clear file related field
		$this->img_01->Upload->DbValue = NULL;
		$this->img_01->OldValue = $this->img_01->Upload->DbValue;
		$this->img_01->CurrentValue = NULL; // Clear file related field
		$this->img_02->Upload->DbValue = NULL;
		$this->img_02->OldValue = $this->img_02->Upload->DbValue;
		$this->img_02->CurrentValue = NULL; // Clear file related field
		$this->img_03->Upload->DbValue = NULL;
		$this->img_03->OldValue = $this->img_03->Upload->DbValue;
		$this->img_03->CurrentValue = NULL; // Clear file related field
		$this->img_04->Upload->DbValue = NULL;
		$this->img_04->OldValue = $this->img_04->Upload->DbValue;
		$this->img_04->CurrentValue = NULL; // Clear file related field
		$this->img_05->Upload->DbValue = NULL;
		$this->img_05->OldValue = $this->img_05->Upload->DbValue;
		$this->img_05->CurrentValue = NULL; // Clear file related field
		$this->img_06->Upload->DbValue = NULL;
		$this->img_06->OldValue = $this->img_06->Upload->DbValue;
		$this->img_06->CurrentValue = NULL; // Clear file related field
		$this->img_07->Upload->DbValue = NULL;
		$this->img_07->OldValue = $this->img_07->Upload->DbValue;
		$this->img_07->CurrentValue = NULL; // Clear file related field
		$this->img_08->Upload->DbValue = NULL;
		$this->img_08->OldValue = $this->img_08->Upload->DbValue;
		$this->img_08->CurrentValue = NULL; // Clear file related field
		$this->img_09->Upload->DbValue = NULL;
		$this->img_09->OldValue = $this->img_09->Upload->DbValue;
		$this->img_09->CurrentValue = NULL; // Clear file related field
		$this->img_10->Upload->DbValue = NULL;
		$this->img_10->OldValue = $this->img_10->Upload->DbValue;
		$this->img_10->CurrentValue = NULL; // Clear file related field
		$this->img_11->Upload->DbValue = NULL;
		$this->img_11->OldValue = $this->img_11->Upload->DbValue;
		$this->img_11->CurrentValue = NULL; // Clear file related field
		$this->img_12->Upload->DbValue = NULL;
		$this->img_12->OldValue = $this->img_12->Upload->DbValue;
		$this->img_12->CurrentValue = NULL; // Clear file related field
		$this->extra_features->CurrentValue = NULL;
		$this->extra_features->OldValue = $this->extra_features->CurrentValue;
		$this->so->CurrentValue = 0;
		$this->active->CurrentValue = 1;
		$this->regionalSpec->CurrentValue = NULL;
		$this->regionalSpec->OldValue = $this->regionalSpec->CurrentValue;
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
		if (!$this->slug->FldIsDetailKey) {
			$this->slug->setFormValue($objForm->GetValue("x_slug"));
		}
		if (!$this->yearID->FldIsDetailKey) {
			$this->yearID->setFormValue($objForm->GetValue("x_yearID"));
		}
		if (!$this->kilometers->FldIsDetailKey) {
			$this->kilometers->setFormValue($objForm->GetValue("x_kilometers"));
		}
		if (!$this->priceAED->FldIsDetailKey) {
			$this->priceAED->setFormValue($objForm->GetValue("x_priceAED"));
		}
		if (!$this->priceUSD->FldIsDetailKey) {
			$this->priceUSD->setFormValue($objForm->GetValue("x_priceUSD"));
		}
		if (!$this->priceOMR->FldIsDetailKey) {
			$this->priceOMR->setFormValue($objForm->GetValue("x_priceOMR"));
		}
		if (!$this->priceSAR->FldIsDetailKey) {
			$this->priceSAR->setFormValue($objForm->GetValue("x_priceSAR"));
		}
		if (!$this->description->FldIsDetailKey) {
			$this->description->setFormValue($objForm->GetValue("x_description"));
		}
		if (!$this->fuelTypeID->FldIsDetailKey) {
			$this->fuelTypeID->setFormValue($objForm->GetValue("x_fuelTypeID"));
		}
		if (!$this->regionalID->FldIsDetailKey) {
			$this->regionalID->setFormValue($objForm->GetValue("x_regionalID"));
		}
		if (!$this->warrantyID->FldIsDetailKey) {
			$this->warrantyID->setFormValue($objForm->GetValue("x_warrantyID"));
		}
		if (!$this->noOfDoors->FldIsDetailKey) {
			$this->noOfDoors->setFormValue($objForm->GetValue("x_noOfDoors"));
		}
		if (!$this->transmissionTypeID->FldIsDetailKey) {
			$this->transmissionTypeID->setFormValue($objForm->GetValue("x_transmissionTypeID"));
		}
		if (!$this->cylinderID->FldIsDetailKey) {
			$this->cylinderID->setFormValue($objForm->GetValue("x_cylinderID"));
		}
		if (!$this->engine->FldIsDetailKey) {
			$this->engine->setFormValue($objForm->GetValue("x_engine"));
		}
		if (!$this->colorID->FldIsDetailKey) {
			$this->colorID->setFormValue($objForm->GetValue("x_colorID"));
		}
		if (!$this->bodyConditionID->FldIsDetailKey) {
			$this->bodyConditionID->setFormValue($objForm->GetValue("x_bodyConditionID"));
		}
		if (!$this->summary->FldIsDetailKey) {
			$this->summary->setFormValue($objForm->GetValue("x_summary"));
		}
		if (!$this->term->FldIsDetailKey) {
			$this->term->setFormValue($objForm->GetValue("x_term"));
		}
		if (!$this->extra_features->FldIsDetailKey) {
			$this->extra_features->setFormValue($objForm->GetValue("x_extra_features"));
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
		$this->slug->CurrentValue = $this->slug->FormValue;
		$this->yearID->CurrentValue = $this->yearID->FormValue;
		$this->kilometers->CurrentValue = $this->kilometers->FormValue;
		$this->priceAED->CurrentValue = $this->priceAED->FormValue;
		$this->priceUSD->CurrentValue = $this->priceUSD->FormValue;
		$this->priceOMR->CurrentValue = $this->priceOMR->FormValue;
		$this->priceSAR->CurrentValue = $this->priceSAR->FormValue;
		$this->description->CurrentValue = $this->description->FormValue;
		$this->fuelTypeID->CurrentValue = $this->fuelTypeID->FormValue;
		$this->regionalID->CurrentValue = $this->regionalID->FormValue;
		$this->warrantyID->CurrentValue = $this->warrantyID->FormValue;
		$this->noOfDoors->CurrentValue = $this->noOfDoors->FormValue;
		$this->transmissionTypeID->CurrentValue = $this->transmissionTypeID->FormValue;
		$this->cylinderID->CurrentValue = $this->cylinderID->FormValue;
		$this->engine->CurrentValue = $this->engine->FormValue;
		$this->colorID->CurrentValue = $this->colorID->FormValue;
		$this->bodyConditionID->CurrentValue = $this->bodyConditionID->FormValue;
		$this->summary->CurrentValue = $this->summary->FormValue;
		$this->term->CurrentValue = $this->term->FormValue;
		$this->extra_features->CurrentValue = $this->extra_features->FormValue;
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
		$this->LoadDefaultValues();
		$row = array();
		$row['userCarID'] = $this->userCarID->CurrentValue;
		$row['makeID'] = $this->makeID->CurrentValue;
		$row['modelID'] = $this->modelID->CurrentValue;
		$row['slug'] = $this->slug->CurrentValue;
		$row['yearID'] = $this->yearID->CurrentValue;
		$row['kilometers'] = $this->kilometers->CurrentValue;
		$row['priceAED'] = $this->priceAED->CurrentValue;
		$row['priceUSD'] = $this->priceUSD->CurrentValue;
		$row['priceOMR'] = $this->priceOMR->CurrentValue;
		$row['priceSAR'] = $this->priceSAR->CurrentValue;
		$row['description'] = $this->description->CurrentValue;
		$row['fuelTypeID'] = $this->fuelTypeID->CurrentValue;
		$row['regionalID'] = $this->regionalID->CurrentValue;
		$row['warrantyID'] = $this->warrantyID->CurrentValue;
		$row['noOfDoors'] = $this->noOfDoors->CurrentValue;
		$row['transmissionTypeID'] = $this->transmissionTypeID->CurrentValue;
		$row['cylinderID'] = $this->cylinderID->CurrentValue;
		$row['engine'] = $this->engine->CurrentValue;
		$row['colorID'] = $this->colorID->CurrentValue;
		$row['bodyConditionID'] = $this->bodyConditionID->CurrentValue;
		$row['summary'] = $this->summary->CurrentValue;
		$row['term'] = $this->term->CurrentValue;
		$row['thumbnail'] = $this->_thumbnail->Upload->DbValue;
		$row['img_01'] = $this->img_01->Upload->DbValue;
		$row['img_02'] = $this->img_02->Upload->DbValue;
		$row['img_03'] = $this->img_03->Upload->DbValue;
		$row['img_04'] = $this->img_04->Upload->DbValue;
		$row['img_05'] = $this->img_05->Upload->DbValue;
		$row['img_06'] = $this->img_06->Upload->DbValue;
		$row['img_07'] = $this->img_07->Upload->DbValue;
		$row['img_08'] = $this->img_08->Upload->DbValue;
		$row['img_09'] = $this->img_09->Upload->DbValue;
		$row['img_10'] = $this->img_10->Upload->DbValue;
		$row['img_11'] = $this->img_11->Upload->DbValue;
		$row['img_12'] = $this->img_12->Upload->DbValue;
		$row['extra_features'] = $this->extra_features->CurrentValue;
		$row['so'] = $this->so->CurrentValue;
		$row['active'] = $this->active->CurrentValue;
		$row['regionalSpec'] = $this->regionalSpec->CurrentValue;
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

			// slug
			$this->slug->EditAttrs["class"] = "form-control";
			$this->slug->EditCustomAttributes = "";
			$this->slug->EditValue = ew_HtmlEncode($this->slug->CurrentValue);
			$this->slug->PlaceHolder = ew_RemoveHtml($this->slug->FldCaption());

			// yearID
			$this->yearID->EditAttrs["class"] = "form-control";
			$this->yearID->EditCustomAttributes = "";
			if (trim(strval($this->yearID->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`yearID`" . ew_SearchString("=", $this->yearID->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `yearID`, `year` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `mtr_year`";
			$sWhereWrk = "";
			$this->yearID->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->yearID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->yearID->EditValue = $arwrk;

			// kilometers
			$this->kilometers->EditAttrs["class"] = "form-control";
			$this->kilometers->EditCustomAttributes = "";
			$this->kilometers->EditValue = ew_HtmlEncode($this->kilometers->CurrentValue);
			$this->kilometers->PlaceHolder = ew_RemoveHtml($this->kilometers->FldCaption());

			// priceAED
			$this->priceAED->EditAttrs["class"] = "form-control";
			$this->priceAED->EditCustomAttributes = "";
			$this->priceAED->EditValue = ew_HtmlEncode($this->priceAED->CurrentValue);
			$this->priceAED->PlaceHolder = ew_RemoveHtml($this->priceAED->FldCaption());

			// priceUSD
			$this->priceUSD->EditAttrs["class"] = "form-control";
			$this->priceUSD->EditCustomAttributes = "";
			$this->priceUSD->EditValue = ew_HtmlEncode($this->priceUSD->CurrentValue);
			$this->priceUSD->PlaceHolder = ew_RemoveHtml($this->priceUSD->FldCaption());

			// priceOMR
			$this->priceOMR->EditAttrs["class"] = "form-control";
			$this->priceOMR->EditCustomAttributes = "";
			$this->priceOMR->EditValue = ew_HtmlEncode($this->priceOMR->CurrentValue);
			$this->priceOMR->PlaceHolder = ew_RemoveHtml($this->priceOMR->FldCaption());

			// priceSAR
			$this->priceSAR->EditAttrs["class"] = "form-control";
			$this->priceSAR->EditCustomAttributes = "";
			$this->priceSAR->EditValue = ew_HtmlEncode($this->priceSAR->CurrentValue);
			$this->priceSAR->PlaceHolder = ew_RemoveHtml($this->priceSAR->FldCaption());

			// description
			$this->description->EditAttrs["class"] = "form-control";
			$this->description->EditCustomAttributes = "";
			$this->description->EditValue = ew_HtmlEncode($this->description->CurrentValue);
			$this->description->PlaceHolder = ew_RemoveHtml($this->description->FldCaption());

			// fuelTypeID
			$this->fuelTypeID->EditAttrs["class"] = "form-control";
			$this->fuelTypeID->EditCustomAttributes = "";
			if (trim(strval($this->fuelTypeID->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`fuelTypeID`" . ew_SearchString("=", $this->fuelTypeID->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `fuelTypeID`, `fuelType` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `mtr_fuel_type`";
			$sWhereWrk = "";
			$this->fuelTypeID->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->fuelTypeID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->fuelTypeID->EditValue = $arwrk;

			// regionalID
			$this->regionalID->EditAttrs["class"] = "form-control";
			$this->regionalID->EditCustomAttributes = "";
			if (trim(strval($this->regionalID->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`regionalID`" . ew_SearchString("=", $this->regionalID->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `regionalID`, `regionalSpecs` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `mtr_regional_spec`";
			$sWhereWrk = "";
			$this->regionalID->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->regionalID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->regionalID->EditValue = $arwrk;

			// warrantyID
			$this->warrantyID->EditAttrs["class"] = "form-control";
			$this->warrantyID->EditCustomAttributes = "";
			if (trim(strval($this->warrantyID->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`warrantyID`" . ew_SearchString("=", $this->warrantyID->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `warrantyID`, `warrantyName` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `mtr_warranty`";
			$sWhereWrk = "";
			$this->warrantyID->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->warrantyID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->warrantyID->EditValue = $arwrk;

			// noOfDoors
			$this->noOfDoors->EditAttrs["class"] = "form-control";
			$this->noOfDoors->EditCustomAttributes = "";
			$this->noOfDoors->EditValue = ew_HtmlEncode($this->noOfDoors->CurrentValue);
			$this->noOfDoors->PlaceHolder = ew_RemoveHtml($this->noOfDoors->FldCaption());

			// transmissionTypeID
			$this->transmissionTypeID->EditAttrs["class"] = "form-control";
			$this->transmissionTypeID->EditCustomAttributes = "";
			if (trim(strval($this->transmissionTypeID->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`transmissionID`" . ew_SearchString("=", $this->transmissionTypeID->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `transmissionID`, `transmission` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `mtr_transmission`";
			$sWhereWrk = "";
			$this->transmissionTypeID->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->transmissionTypeID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->transmissionTypeID->EditValue = $arwrk;

			// cylinderID
			$this->cylinderID->EditAttrs["class"] = "form-control";
			$this->cylinderID->EditCustomAttributes = "";
			if (trim(strval($this->cylinderID->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`cylinderID`" . ew_SearchString("=", $this->cylinderID->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `cylinderID`, `cylinder` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `mtr_cylinder`";
			$sWhereWrk = "";
			$this->cylinderID->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->cylinderID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->cylinderID->EditValue = $arwrk;

			// engine
			$this->engine->EditAttrs["class"] = "form-control";
			$this->engine->EditCustomAttributes = "";
			$this->engine->EditValue = ew_HtmlEncode($this->engine->CurrentValue);
			$this->engine->PlaceHolder = ew_RemoveHtml($this->engine->FldCaption());

			// colorID
			$this->colorID->EditAttrs["class"] = "form-control";
			$this->colorID->EditCustomAttributes = "";
			if (trim(strval($this->colorID->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`colorID`" . ew_SearchString("=", $this->colorID->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `colorID`, `color` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `mtr_color`";
			$sWhereWrk = "";
			$this->colorID->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->colorID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->colorID->EditValue = $arwrk;

			// bodyConditionID
			$this->bodyConditionID->EditAttrs["class"] = "form-control";
			$this->bodyConditionID->EditCustomAttributes = "";
			if (trim(strval($this->bodyConditionID->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`bodyConditionID`" . ew_SearchString("=", $this->bodyConditionID->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `bodyConditionID`, `bodyCondition` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `mtr_body_condition`";
			$sWhereWrk = "";
			$this->bodyConditionID->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->bodyConditionID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->bodyConditionID->EditValue = $arwrk;

			// summary
			$this->summary->EditAttrs["class"] = "form-control";
			$this->summary->EditCustomAttributes = "";
			$this->summary->EditValue = ew_HtmlEncode($this->summary->CurrentValue);
			$this->summary->PlaceHolder = ew_RemoveHtml($this->summary->FldCaption());

			// term
			$this->term->EditAttrs["class"] = "form-control";
			$this->term->EditCustomAttributes = "";
			if (trim(strval($this->term->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`termID`" . ew_SearchString("=", $this->term->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `termID`, `term` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `mtr_term`";
			$sWhereWrk = "";
			$this->term->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->term, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->term->EditValue = $arwrk;

			// thumbnail
			$this->_thumbnail->EditAttrs["class"] = "form-control";
			$this->_thumbnail->EditCustomAttributes = "";
			$this->_thumbnail->UploadPath = 'uploads/usedcars';
			if (!ew_Empty($this->_thumbnail->Upload->DbValue)) {
				$this->_thumbnail->ImageWidth = 100;
				$this->_thumbnail->ImageHeight = 0;
				$this->_thumbnail->ImageAlt = $this->_thumbnail->FldAlt();
				$this->_thumbnail->EditValue = $this->_thumbnail->Upload->DbValue;
			} else {
				$this->_thumbnail->EditValue = "";
			}
			if (!ew_Empty($this->_thumbnail->CurrentValue))
					$this->_thumbnail->Upload->FileName = $this->_thumbnail->CurrentValue;
			if (($this->CurrentAction == "I" || $this->CurrentAction == "C") && !$this->EventCancelled) ew_RenderUploadField($this->_thumbnail);

			// img_01
			$this->img_01->EditAttrs["class"] = "form-control";
			$this->img_01->EditCustomAttributes = "";
			$this->img_01->UploadPath = 'uploads/usedcars';
			if (!ew_Empty($this->img_01->Upload->DbValue)) {
				$this->img_01->ImageWidth = 100;
				$this->img_01->ImageHeight = 0;
				$this->img_01->ImageAlt = $this->img_01->FldAlt();
				$this->img_01->EditValue = $this->img_01->Upload->DbValue;
			} else {
				$this->img_01->EditValue = "";
			}
			if (!ew_Empty($this->img_01->CurrentValue))
					$this->img_01->Upload->FileName = $this->img_01->CurrentValue;
			if (($this->CurrentAction == "I" || $this->CurrentAction == "C") && !$this->EventCancelled) ew_RenderUploadField($this->img_01);

			// img_02
			$this->img_02->EditAttrs["class"] = "form-control";
			$this->img_02->EditCustomAttributes = "";
			$this->img_02->UploadPath = 'uploads/usedcars';
			if (!ew_Empty($this->img_02->Upload->DbValue)) {
				$this->img_02->ImageWidth = 100;
				$this->img_02->ImageHeight = 0;
				$this->img_02->ImageAlt = $this->img_02->FldAlt();
				$this->img_02->EditValue = $this->img_02->Upload->DbValue;
			} else {
				$this->img_02->EditValue = "";
			}
			if (!ew_Empty($this->img_02->CurrentValue))
					$this->img_02->Upload->FileName = $this->img_02->CurrentValue;
			if (($this->CurrentAction == "I" || $this->CurrentAction == "C") && !$this->EventCancelled) ew_RenderUploadField($this->img_02);

			// img_03
			$this->img_03->EditAttrs["class"] = "form-control";
			$this->img_03->EditCustomAttributes = "";
			$this->img_03->UploadPath = 'uploads/usedcars';
			if (!ew_Empty($this->img_03->Upload->DbValue)) {
				$this->img_03->ImageWidth = 100;
				$this->img_03->ImageHeight = 0;
				$this->img_03->ImageAlt = $this->img_03->FldAlt();
				$this->img_03->EditValue = $this->img_03->Upload->DbValue;
			} else {
				$this->img_03->EditValue = "";
			}
			if (!ew_Empty($this->img_03->CurrentValue))
					$this->img_03->Upload->FileName = $this->img_03->CurrentValue;
			if (($this->CurrentAction == "I" || $this->CurrentAction == "C") && !$this->EventCancelled) ew_RenderUploadField($this->img_03);

			// img_04
			$this->img_04->EditAttrs["class"] = "form-control";
			$this->img_04->EditCustomAttributes = "";
			$this->img_04->UploadPath = 'uploads/usedcars';
			if (!ew_Empty($this->img_04->Upload->DbValue)) {
				$this->img_04->ImageWidth = 100;
				$this->img_04->ImageHeight = 0;
				$this->img_04->ImageAlt = $this->img_04->FldAlt();
				$this->img_04->EditValue = $this->img_04->Upload->DbValue;
			} else {
				$this->img_04->EditValue = "";
			}
			if (!ew_Empty($this->img_04->CurrentValue))
					$this->img_04->Upload->FileName = $this->img_04->CurrentValue;
			if (($this->CurrentAction == "I" || $this->CurrentAction == "C") && !$this->EventCancelled) ew_RenderUploadField($this->img_04);

			// img_05
			$this->img_05->EditAttrs["class"] = "form-control";
			$this->img_05->EditCustomAttributes = "";
			$this->img_05->UploadPath = 'uploads/usedcars';
			if (!ew_Empty($this->img_05->Upload->DbValue)) {
				$this->img_05->ImageWidth = 100;
				$this->img_05->ImageHeight = 0;
				$this->img_05->ImageAlt = $this->img_05->FldAlt();
				$this->img_05->EditValue = $this->img_05->Upload->DbValue;
			} else {
				$this->img_05->EditValue = "";
			}
			if (!ew_Empty($this->img_05->CurrentValue))
					$this->img_05->Upload->FileName = $this->img_05->CurrentValue;
			if (($this->CurrentAction == "I" || $this->CurrentAction == "C") && !$this->EventCancelled) ew_RenderUploadField($this->img_05);

			// img_06
			$this->img_06->EditAttrs["class"] = "form-control";
			$this->img_06->EditCustomAttributes = "";
			$this->img_06->UploadPath = 'uploads/usedcars';
			if (!ew_Empty($this->img_06->Upload->DbValue)) {
				$this->img_06->ImageWidth = 100;
				$this->img_06->ImageHeight = 0;
				$this->img_06->ImageAlt = $this->img_06->FldAlt();
				$this->img_06->EditValue = $this->img_06->Upload->DbValue;
			} else {
				$this->img_06->EditValue = "";
			}
			if (!ew_Empty($this->img_06->CurrentValue))
					$this->img_06->Upload->FileName = $this->img_06->CurrentValue;
			if (($this->CurrentAction == "I" || $this->CurrentAction == "C") && !$this->EventCancelled) ew_RenderUploadField($this->img_06);

			// img_07
			$this->img_07->EditAttrs["class"] = "form-control";
			$this->img_07->EditCustomAttributes = "";
			$this->img_07->UploadPath = 'uploads/usedcars';
			if (!ew_Empty($this->img_07->Upload->DbValue)) {
				$this->img_07->ImageWidth = 100;
				$this->img_07->ImageHeight = 0;
				$this->img_07->ImageAlt = $this->img_07->FldAlt();
				$this->img_07->EditValue = $this->img_07->Upload->DbValue;
			} else {
				$this->img_07->EditValue = "";
			}
			if (!ew_Empty($this->img_07->CurrentValue))
					$this->img_07->Upload->FileName = $this->img_07->CurrentValue;
			if (($this->CurrentAction == "I" || $this->CurrentAction == "C") && !$this->EventCancelled) ew_RenderUploadField($this->img_07);

			// img_08
			$this->img_08->EditAttrs["class"] = "form-control";
			$this->img_08->EditCustomAttributes = "";
			$this->img_08->UploadPath = 'uploads/usedcars';
			if (!ew_Empty($this->img_08->Upload->DbValue)) {
				$this->img_08->ImageWidth = 100;
				$this->img_08->ImageHeight = 0;
				$this->img_08->ImageAlt = $this->img_08->FldAlt();
				$this->img_08->EditValue = $this->img_08->Upload->DbValue;
			} else {
				$this->img_08->EditValue = "";
			}
			if (!ew_Empty($this->img_08->CurrentValue))
					$this->img_08->Upload->FileName = $this->img_08->CurrentValue;
			if (($this->CurrentAction == "I" || $this->CurrentAction == "C") && !$this->EventCancelled) ew_RenderUploadField($this->img_08);

			// img_09
			$this->img_09->EditAttrs["class"] = "form-control";
			$this->img_09->EditCustomAttributes = "";
			$this->img_09->UploadPath = 'uploads/usedcars';
			if (!ew_Empty($this->img_09->Upload->DbValue)) {
				$this->img_09->ImageWidth = 100;
				$this->img_09->ImageHeight = 0;
				$this->img_09->ImageAlt = $this->img_09->FldAlt();
				$this->img_09->EditValue = $this->img_09->Upload->DbValue;
			} else {
				$this->img_09->EditValue = "";
			}
			if (!ew_Empty($this->img_09->CurrentValue))
					$this->img_09->Upload->FileName = $this->img_09->CurrentValue;
			if (($this->CurrentAction == "I" || $this->CurrentAction == "C") && !$this->EventCancelled) ew_RenderUploadField($this->img_09);

			// img_10
			$this->img_10->EditAttrs["class"] = "form-control";
			$this->img_10->EditCustomAttributes = "";
			$this->img_10->UploadPath = 'uploads/usedcars';
			if (!ew_Empty($this->img_10->Upload->DbValue)) {
				$this->img_10->ImageWidth = 100;
				$this->img_10->ImageHeight = 0;
				$this->img_10->ImageAlt = $this->img_10->FldAlt();
				$this->img_10->EditValue = $this->img_10->Upload->DbValue;
			} else {
				$this->img_10->EditValue = "";
			}
			if (!ew_Empty($this->img_10->CurrentValue))
					$this->img_10->Upload->FileName = $this->img_10->CurrentValue;
			if (($this->CurrentAction == "I" || $this->CurrentAction == "C") && !$this->EventCancelled) ew_RenderUploadField($this->img_10);

			// img_11
			$this->img_11->EditAttrs["class"] = "form-control";
			$this->img_11->EditCustomAttributes = "";
			$this->img_11->UploadPath = 'uploads/usedcars';
			if (!ew_Empty($this->img_11->Upload->DbValue)) {
				$this->img_11->ImageWidth = 100;
				$this->img_11->ImageHeight = 0;
				$this->img_11->ImageAlt = $this->img_11->FldAlt();
				$this->img_11->EditValue = $this->img_11->Upload->DbValue;
			} else {
				$this->img_11->EditValue = "";
			}
			if (!ew_Empty($this->img_11->CurrentValue))
					$this->img_11->Upload->FileName = $this->img_11->CurrentValue;
			if (($this->CurrentAction == "I" || $this->CurrentAction == "C") && !$this->EventCancelled) ew_RenderUploadField($this->img_11);

			// img_12
			$this->img_12->EditAttrs["class"] = "form-control";
			$this->img_12->EditCustomAttributes = "";
			$this->img_12->UploadPath = 'uploads/usedcars';
			if (!ew_Empty($this->img_12->Upload->DbValue)) {
				$this->img_12->ImageWidth = 100;
				$this->img_12->ImageHeight = 0;
				$this->img_12->ImageAlt = $this->img_12->FldAlt();
				$this->img_12->EditValue = $this->img_12->Upload->DbValue;
			} else {
				$this->img_12->EditValue = "";
			}
			if (!ew_Empty($this->img_12->CurrentValue))
					$this->img_12->Upload->FileName = $this->img_12->CurrentValue;
			if (($this->CurrentAction == "I" || $this->CurrentAction == "C") && !$this->EventCancelled) ew_RenderUploadField($this->img_12);

			// extra_features
			$this->extra_features->EditCustomAttributes = "";
			if (trim(strval($this->extra_features->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$arwrk = explode(",", $this->extra_features->CurrentValue);
				$sFilterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
					$sFilterWrk .= "`featureID`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_NUMBER, "");
				}
			}
			$sSqlWrk = "SELECT `featureID`, `extraFeatures` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `mtr_extra_features`";
			$sWhereWrk = "";
			$this->extra_features->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->extra_features, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->extra_features->EditValue = $arwrk;

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

			// slug
			$this->slug->LinkCustomAttributes = "";
			$this->slug->HrefValue = "";

			// yearID
			$this->yearID->LinkCustomAttributes = "";
			$this->yearID->HrefValue = "";

			// kilometers
			$this->kilometers->LinkCustomAttributes = "";
			$this->kilometers->HrefValue = "";

			// priceAED
			$this->priceAED->LinkCustomAttributes = "";
			$this->priceAED->HrefValue = "";

			// priceUSD
			$this->priceUSD->LinkCustomAttributes = "";
			$this->priceUSD->HrefValue = "";

			// priceOMR
			$this->priceOMR->LinkCustomAttributes = "";
			$this->priceOMR->HrefValue = "";

			// priceSAR
			$this->priceSAR->LinkCustomAttributes = "";
			$this->priceSAR->HrefValue = "";

			// description
			$this->description->LinkCustomAttributes = "";
			$this->description->HrefValue = "";

			// fuelTypeID
			$this->fuelTypeID->LinkCustomAttributes = "";
			$this->fuelTypeID->HrefValue = "";

			// regionalID
			$this->regionalID->LinkCustomAttributes = "";
			$this->regionalID->HrefValue = "";

			// warrantyID
			$this->warrantyID->LinkCustomAttributes = "";
			$this->warrantyID->HrefValue = "";

			// noOfDoors
			$this->noOfDoors->LinkCustomAttributes = "";
			$this->noOfDoors->HrefValue = "";

			// transmissionTypeID
			$this->transmissionTypeID->LinkCustomAttributes = "";
			$this->transmissionTypeID->HrefValue = "";

			// cylinderID
			$this->cylinderID->LinkCustomAttributes = "";
			$this->cylinderID->HrefValue = "";

			// engine
			$this->engine->LinkCustomAttributes = "";
			$this->engine->HrefValue = "";

			// colorID
			$this->colorID->LinkCustomAttributes = "";
			$this->colorID->HrefValue = "";

			// bodyConditionID
			$this->bodyConditionID->LinkCustomAttributes = "";
			$this->bodyConditionID->HrefValue = "";

			// summary
			$this->summary->LinkCustomAttributes = "";
			$this->summary->HrefValue = "";

			// term
			$this->term->LinkCustomAttributes = "";
			$this->term->HrefValue = "";

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

			// extra_features
			$this->extra_features->LinkCustomAttributes = "";
			$this->extra_features->HrefValue = "";

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
		if (!$this->slug->FldIsDetailKey && !is_null($this->slug->FormValue) && $this->slug->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->slug->FldCaption(), $this->slug->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->kilometers->FormValue)) {
			ew_AddMessage($gsFormError, $this->kilometers->FldErrMsg());
		}
		if (!ew_CheckInteger($this->priceAED->FormValue)) {
			ew_AddMessage($gsFormError, $this->priceAED->FldErrMsg());
		}
		if (!ew_CheckInteger($this->priceUSD->FormValue)) {
			ew_AddMessage($gsFormError, $this->priceUSD->FldErrMsg());
		}
		if (!ew_CheckInteger($this->priceOMR->FormValue)) {
			ew_AddMessage($gsFormError, $this->priceOMR->FldErrMsg());
		}
		if (!ew_CheckInteger($this->priceSAR->FormValue)) {
			ew_AddMessage($gsFormError, $this->priceSAR->FldErrMsg());
		}
		if (!ew_CheckInteger($this->noOfDoors->FormValue)) {
			ew_AddMessage($gsFormError, $this->noOfDoors->FldErrMsg());
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
			$this->_thumbnail->OldUploadPath = 'uploads/usedcars';
			$this->_thumbnail->UploadPath = $this->_thumbnail->OldUploadPath;
			$this->img_01->OldUploadPath = 'uploads/usedcars';
			$this->img_01->UploadPath = $this->img_01->OldUploadPath;
			$this->img_02->OldUploadPath = 'uploads/usedcars';
			$this->img_02->UploadPath = $this->img_02->OldUploadPath;
			$this->img_03->OldUploadPath = 'uploads/usedcars';
			$this->img_03->UploadPath = $this->img_03->OldUploadPath;
			$this->img_04->OldUploadPath = 'uploads/usedcars';
			$this->img_04->UploadPath = $this->img_04->OldUploadPath;
			$this->img_05->OldUploadPath = 'uploads/usedcars';
			$this->img_05->UploadPath = $this->img_05->OldUploadPath;
			$this->img_06->OldUploadPath = 'uploads/usedcars';
			$this->img_06->UploadPath = $this->img_06->OldUploadPath;
			$this->img_07->OldUploadPath = 'uploads/usedcars';
			$this->img_07->UploadPath = $this->img_07->OldUploadPath;
			$this->img_08->OldUploadPath = 'uploads/usedcars';
			$this->img_08->UploadPath = $this->img_08->OldUploadPath;
			$this->img_09->OldUploadPath = 'uploads/usedcars';
			$this->img_09->UploadPath = $this->img_09->OldUploadPath;
			$this->img_10->OldUploadPath = 'uploads/usedcars';
			$this->img_10->UploadPath = $this->img_10->OldUploadPath;
			$this->img_11->OldUploadPath = 'uploads/usedcars';
			$this->img_11->UploadPath = $this->img_11->OldUploadPath;
			$this->img_12->OldUploadPath = 'uploads/usedcars';
			$this->img_12->UploadPath = $this->img_12->OldUploadPath;
		}
		$rsnew = array();

		// makeID
		$this->makeID->SetDbValueDef($rsnew, $this->makeID->CurrentValue, NULL, FALSE);

		// modelID
		$this->modelID->SetDbValueDef($rsnew, $this->modelID->CurrentValue, NULL, FALSE);

		// slug
		$this->slug->SetDbValueDef($rsnew, $this->slug->CurrentValue, "", FALSE);

		// yearID
		$this->yearID->SetDbValueDef($rsnew, $this->yearID->CurrentValue, NULL, FALSE);

		// kilometers
		$this->kilometers->SetDbValueDef($rsnew, $this->kilometers->CurrentValue, NULL, FALSE);

		// priceAED
		$this->priceAED->SetDbValueDef($rsnew, $this->priceAED->CurrentValue, NULL, FALSE);

		// priceUSD
		$this->priceUSD->SetDbValueDef($rsnew, $this->priceUSD->CurrentValue, NULL, FALSE);

		// priceOMR
		$this->priceOMR->SetDbValueDef($rsnew, $this->priceOMR->CurrentValue, NULL, FALSE);

		// priceSAR
		$this->priceSAR->SetDbValueDef($rsnew, $this->priceSAR->CurrentValue, NULL, FALSE);

		// description
		$this->description->SetDbValueDef($rsnew, $this->description->CurrentValue, NULL, FALSE);

		// fuelTypeID
		$this->fuelTypeID->SetDbValueDef($rsnew, $this->fuelTypeID->CurrentValue, NULL, FALSE);

		// regionalID
		$this->regionalID->SetDbValueDef($rsnew, $this->regionalID->CurrentValue, NULL, FALSE);

		// warrantyID
		$this->warrantyID->SetDbValueDef($rsnew, $this->warrantyID->CurrentValue, NULL, FALSE);

		// noOfDoors
		$this->noOfDoors->SetDbValueDef($rsnew, $this->noOfDoors->CurrentValue, NULL, FALSE);

		// transmissionTypeID
		$this->transmissionTypeID->SetDbValueDef($rsnew, $this->transmissionTypeID->CurrentValue, NULL, FALSE);

		// cylinderID
		$this->cylinderID->SetDbValueDef($rsnew, $this->cylinderID->CurrentValue, NULL, FALSE);

		// engine
		$this->engine->SetDbValueDef($rsnew, $this->engine->CurrentValue, NULL, FALSE);

		// colorID
		$this->colorID->SetDbValueDef($rsnew, $this->colorID->CurrentValue, NULL, FALSE);

		// bodyConditionID
		$this->bodyConditionID->SetDbValueDef($rsnew, $this->bodyConditionID->CurrentValue, NULL, FALSE);

		// summary
		$this->summary->SetDbValueDef($rsnew, $this->summary->CurrentValue, NULL, FALSE);

		// term
		$this->term->SetDbValueDef($rsnew, $this->term->CurrentValue, NULL, FALSE);

		// thumbnail
		if ($this->_thumbnail->Visible && !$this->_thumbnail->Upload->KeepFile) {
			$this->_thumbnail->Upload->DbValue = ""; // No need to delete old file
			if ($this->_thumbnail->Upload->FileName == "") {
				$rsnew['thumbnail'] = NULL;
			} else {
				$rsnew['thumbnail'] = $this->_thumbnail->Upload->FileName;
			}
		}

		// img_01
		if ($this->img_01->Visible && !$this->img_01->Upload->KeepFile) {
			$this->img_01->Upload->DbValue = ""; // No need to delete old file
			if ($this->img_01->Upload->FileName == "") {
				$rsnew['img_01'] = NULL;
			} else {
				$rsnew['img_01'] = $this->img_01->Upload->FileName;
			}
		}

		// img_02
		if ($this->img_02->Visible && !$this->img_02->Upload->KeepFile) {
			$this->img_02->Upload->DbValue = ""; // No need to delete old file
			if ($this->img_02->Upload->FileName == "") {
				$rsnew['img_02'] = NULL;
			} else {
				$rsnew['img_02'] = $this->img_02->Upload->FileName;
			}
		}

		// img_03
		if ($this->img_03->Visible && !$this->img_03->Upload->KeepFile) {
			$this->img_03->Upload->DbValue = ""; // No need to delete old file
			if ($this->img_03->Upload->FileName == "") {
				$rsnew['img_03'] = NULL;
			} else {
				$rsnew['img_03'] = $this->img_03->Upload->FileName;
			}
		}

		// img_04
		if ($this->img_04->Visible && !$this->img_04->Upload->KeepFile) {
			$this->img_04->Upload->DbValue = ""; // No need to delete old file
			if ($this->img_04->Upload->FileName == "") {
				$rsnew['img_04'] = NULL;
			} else {
				$rsnew['img_04'] = $this->img_04->Upload->FileName;
			}
		}

		// img_05
		if ($this->img_05->Visible && !$this->img_05->Upload->KeepFile) {
			$this->img_05->Upload->DbValue = ""; // No need to delete old file
			if ($this->img_05->Upload->FileName == "") {
				$rsnew['img_05'] = NULL;
			} else {
				$rsnew['img_05'] = $this->img_05->Upload->FileName;
			}
		}

		// img_06
		if ($this->img_06->Visible && !$this->img_06->Upload->KeepFile) {
			$this->img_06->Upload->DbValue = ""; // No need to delete old file
			if ($this->img_06->Upload->FileName == "") {
				$rsnew['img_06'] = NULL;
			} else {
				$rsnew['img_06'] = $this->img_06->Upload->FileName;
			}
		}

		// img_07
		if ($this->img_07->Visible && !$this->img_07->Upload->KeepFile) {
			$this->img_07->Upload->DbValue = ""; // No need to delete old file
			if ($this->img_07->Upload->FileName == "") {
				$rsnew['img_07'] = NULL;
			} else {
				$rsnew['img_07'] = $this->img_07->Upload->FileName;
			}
		}

		// img_08
		if ($this->img_08->Visible && !$this->img_08->Upload->KeepFile) {
			$this->img_08->Upload->DbValue = ""; // No need to delete old file
			if ($this->img_08->Upload->FileName == "") {
				$rsnew['img_08'] = NULL;
			} else {
				$rsnew['img_08'] = $this->img_08->Upload->FileName;
			}
		}

		// img_09
		if ($this->img_09->Visible && !$this->img_09->Upload->KeepFile) {
			$this->img_09->Upload->DbValue = ""; // No need to delete old file
			if ($this->img_09->Upload->FileName == "") {
				$rsnew['img_09'] = NULL;
			} else {
				$rsnew['img_09'] = $this->img_09->Upload->FileName;
			}
		}

		// img_10
		if ($this->img_10->Visible && !$this->img_10->Upload->KeepFile) {
			$this->img_10->Upload->DbValue = ""; // No need to delete old file
			if ($this->img_10->Upload->FileName == "") {
				$rsnew['img_10'] = NULL;
			} else {
				$rsnew['img_10'] = $this->img_10->Upload->FileName;
			}
		}

		// img_11
		if ($this->img_11->Visible && !$this->img_11->Upload->KeepFile) {
			$this->img_11->Upload->DbValue = ""; // No need to delete old file
			if ($this->img_11->Upload->FileName == "") {
				$rsnew['img_11'] = NULL;
			} else {
				$rsnew['img_11'] = $this->img_11->Upload->FileName;
			}
		}

		// img_12
		if ($this->img_12->Visible && !$this->img_12->Upload->KeepFile) {
			$this->img_12->Upload->DbValue = ""; // No need to delete old file
			if ($this->img_12->Upload->FileName == "") {
				$rsnew['img_12'] = NULL;
			} else {
				$rsnew['img_12'] = $this->img_12->Upload->FileName;
			}
		}

		// extra_features
		$this->extra_features->SetDbValueDef($rsnew, $this->extra_features->CurrentValue, NULL, FALSE);

		// so
		$this->so->SetDbValueDef($rsnew, $this->so->CurrentValue, NULL, strval($this->so->CurrentValue) == "");

		// active
		$this->active->SetDbValueDef($rsnew, $this->active->CurrentValue, NULL, strval($this->active->CurrentValue) == "");
		if ($this->_thumbnail->Visible && !$this->_thumbnail->Upload->KeepFile) {
			$this->_thumbnail->UploadPath = 'uploads/usedcars';
			$OldFiles = ew_Empty($this->_thumbnail->Upload->DbValue) ? array() : array($this->_thumbnail->Upload->DbValue);
			if (!ew_Empty($this->_thumbnail->Upload->FileName)) {
				$NewFiles = array($this->_thumbnail->Upload->FileName);
				$NewFileCount = count($NewFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					$fldvar = ($this->_thumbnail->Upload->Index < 0) ? $this->_thumbnail->FldVar : substr($this->_thumbnail->FldVar, 0, 1) . $this->_thumbnail->Upload->Index . substr($this->_thumbnail->FldVar, 1);
					if ($NewFiles[$i] <> "") {
						$file = $NewFiles[$i];
						if (file_exists(ew_UploadTempPath($fldvar, $this->_thumbnail->TblVar) . $file)) {
							$OldFileFound = FALSE;
							$OldFileCount = count($OldFiles);
							for ($j = 0; $j < $OldFileCount; $j++) {
								$file1 = $OldFiles[$j];
								if ($file1 == $file) { // Old file found, no need to delete anymore
									unset($OldFiles[$j]);
									$OldFileFound = TRUE;
									break;
								}
							}
							if ($OldFileFound) // No need to check if file exists further
								continue;
							$file1 = ew_UploadFileNameEx($this->_thumbnail->PhysicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(ew_UploadTempPath($fldvar, $this->_thumbnail->TblVar) . $file1) || file_exists($this->_thumbnail->PhysicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = ew_UniqueFilename($this->_thumbnail->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(ew_UploadTempPath($fldvar, $this->_thumbnail->TblVar) . $file, ew_UploadTempPath($fldvar, $this->_thumbnail->TblVar) . $file1);
								$NewFiles[$i] = $file1;
							}
						}
					}
				}
				$this->_thumbnail->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
				$this->_thumbnail->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
				$this->_thumbnail->SetDbValueDef($rsnew, $this->_thumbnail->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->img_01->Visible && !$this->img_01->Upload->KeepFile) {
			$this->img_01->UploadPath = 'uploads/usedcars';
			$OldFiles = ew_Empty($this->img_01->Upload->DbValue) ? array() : array($this->img_01->Upload->DbValue);
			if (!ew_Empty($this->img_01->Upload->FileName)) {
				$NewFiles = array($this->img_01->Upload->FileName);
				$NewFileCount = count($NewFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					$fldvar = ($this->img_01->Upload->Index < 0) ? $this->img_01->FldVar : substr($this->img_01->FldVar, 0, 1) . $this->img_01->Upload->Index . substr($this->img_01->FldVar, 1);
					if ($NewFiles[$i] <> "") {
						$file = $NewFiles[$i];
						if (file_exists(ew_UploadTempPath($fldvar, $this->img_01->TblVar) . $file)) {
							$OldFileFound = FALSE;
							$OldFileCount = count($OldFiles);
							for ($j = 0; $j < $OldFileCount; $j++) {
								$file1 = $OldFiles[$j];
								if ($file1 == $file) { // Old file found, no need to delete anymore
									unset($OldFiles[$j]);
									$OldFileFound = TRUE;
									break;
								}
							}
							if ($OldFileFound) // No need to check if file exists further
								continue;
							$file1 = ew_UploadFileNameEx($this->img_01->PhysicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(ew_UploadTempPath($fldvar, $this->img_01->TblVar) . $file1) || file_exists($this->img_01->PhysicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = ew_UniqueFilename($this->img_01->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(ew_UploadTempPath($fldvar, $this->img_01->TblVar) . $file, ew_UploadTempPath($fldvar, $this->img_01->TblVar) . $file1);
								$NewFiles[$i] = $file1;
							}
						}
					}
				}
				$this->img_01->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
				$this->img_01->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
				$this->img_01->SetDbValueDef($rsnew, $this->img_01->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->img_02->Visible && !$this->img_02->Upload->KeepFile) {
			$this->img_02->UploadPath = 'uploads/usedcars';
			$OldFiles = ew_Empty($this->img_02->Upload->DbValue) ? array() : array($this->img_02->Upload->DbValue);
			if (!ew_Empty($this->img_02->Upload->FileName)) {
				$NewFiles = array($this->img_02->Upload->FileName);
				$NewFileCount = count($NewFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					$fldvar = ($this->img_02->Upload->Index < 0) ? $this->img_02->FldVar : substr($this->img_02->FldVar, 0, 1) . $this->img_02->Upload->Index . substr($this->img_02->FldVar, 1);
					if ($NewFiles[$i] <> "") {
						$file = $NewFiles[$i];
						if (file_exists(ew_UploadTempPath($fldvar, $this->img_02->TblVar) . $file)) {
							$OldFileFound = FALSE;
							$OldFileCount = count($OldFiles);
							for ($j = 0; $j < $OldFileCount; $j++) {
								$file1 = $OldFiles[$j];
								if ($file1 == $file) { // Old file found, no need to delete anymore
									unset($OldFiles[$j]);
									$OldFileFound = TRUE;
									break;
								}
							}
							if ($OldFileFound) // No need to check if file exists further
								continue;
							$file1 = ew_UploadFileNameEx($this->img_02->PhysicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(ew_UploadTempPath($fldvar, $this->img_02->TblVar) . $file1) || file_exists($this->img_02->PhysicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = ew_UniqueFilename($this->img_02->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(ew_UploadTempPath($fldvar, $this->img_02->TblVar) . $file, ew_UploadTempPath($fldvar, $this->img_02->TblVar) . $file1);
								$NewFiles[$i] = $file1;
							}
						}
					}
				}
				$this->img_02->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
				$this->img_02->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
				$this->img_02->SetDbValueDef($rsnew, $this->img_02->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->img_03->Visible && !$this->img_03->Upload->KeepFile) {
			$this->img_03->UploadPath = 'uploads/usedcars';
			$OldFiles = ew_Empty($this->img_03->Upload->DbValue) ? array() : array($this->img_03->Upload->DbValue);
			if (!ew_Empty($this->img_03->Upload->FileName)) {
				$NewFiles = array($this->img_03->Upload->FileName);
				$NewFileCount = count($NewFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					$fldvar = ($this->img_03->Upload->Index < 0) ? $this->img_03->FldVar : substr($this->img_03->FldVar, 0, 1) . $this->img_03->Upload->Index . substr($this->img_03->FldVar, 1);
					if ($NewFiles[$i] <> "") {
						$file = $NewFiles[$i];
						if (file_exists(ew_UploadTempPath($fldvar, $this->img_03->TblVar) . $file)) {
							$OldFileFound = FALSE;
							$OldFileCount = count($OldFiles);
							for ($j = 0; $j < $OldFileCount; $j++) {
								$file1 = $OldFiles[$j];
								if ($file1 == $file) { // Old file found, no need to delete anymore
									unset($OldFiles[$j]);
									$OldFileFound = TRUE;
									break;
								}
							}
							if ($OldFileFound) // No need to check if file exists further
								continue;
							$file1 = ew_UploadFileNameEx($this->img_03->PhysicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(ew_UploadTempPath($fldvar, $this->img_03->TblVar) . $file1) || file_exists($this->img_03->PhysicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = ew_UniqueFilename($this->img_03->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(ew_UploadTempPath($fldvar, $this->img_03->TblVar) . $file, ew_UploadTempPath($fldvar, $this->img_03->TblVar) . $file1);
								$NewFiles[$i] = $file1;
							}
						}
					}
				}
				$this->img_03->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
				$this->img_03->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
				$this->img_03->SetDbValueDef($rsnew, $this->img_03->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->img_04->Visible && !$this->img_04->Upload->KeepFile) {
			$this->img_04->UploadPath = 'uploads/usedcars';
			$OldFiles = ew_Empty($this->img_04->Upload->DbValue) ? array() : array($this->img_04->Upload->DbValue);
			if (!ew_Empty($this->img_04->Upload->FileName)) {
				$NewFiles = array($this->img_04->Upload->FileName);
				$NewFileCount = count($NewFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					$fldvar = ($this->img_04->Upload->Index < 0) ? $this->img_04->FldVar : substr($this->img_04->FldVar, 0, 1) . $this->img_04->Upload->Index . substr($this->img_04->FldVar, 1);
					if ($NewFiles[$i] <> "") {
						$file = $NewFiles[$i];
						if (file_exists(ew_UploadTempPath($fldvar, $this->img_04->TblVar) . $file)) {
							$OldFileFound = FALSE;
							$OldFileCount = count($OldFiles);
							for ($j = 0; $j < $OldFileCount; $j++) {
								$file1 = $OldFiles[$j];
								if ($file1 == $file) { // Old file found, no need to delete anymore
									unset($OldFiles[$j]);
									$OldFileFound = TRUE;
									break;
								}
							}
							if ($OldFileFound) // No need to check if file exists further
								continue;
							$file1 = ew_UploadFileNameEx($this->img_04->PhysicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(ew_UploadTempPath($fldvar, $this->img_04->TblVar) . $file1) || file_exists($this->img_04->PhysicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = ew_UniqueFilename($this->img_04->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(ew_UploadTempPath($fldvar, $this->img_04->TblVar) . $file, ew_UploadTempPath($fldvar, $this->img_04->TblVar) . $file1);
								$NewFiles[$i] = $file1;
							}
						}
					}
				}
				$this->img_04->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
				$this->img_04->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
				$this->img_04->SetDbValueDef($rsnew, $this->img_04->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->img_05->Visible && !$this->img_05->Upload->KeepFile) {
			$this->img_05->UploadPath = 'uploads/usedcars';
			$OldFiles = ew_Empty($this->img_05->Upload->DbValue) ? array() : array($this->img_05->Upload->DbValue);
			if (!ew_Empty($this->img_05->Upload->FileName)) {
				$NewFiles = array($this->img_05->Upload->FileName);
				$NewFileCount = count($NewFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					$fldvar = ($this->img_05->Upload->Index < 0) ? $this->img_05->FldVar : substr($this->img_05->FldVar, 0, 1) . $this->img_05->Upload->Index . substr($this->img_05->FldVar, 1);
					if ($NewFiles[$i] <> "") {
						$file = $NewFiles[$i];
						if (file_exists(ew_UploadTempPath($fldvar, $this->img_05->TblVar) . $file)) {
							$OldFileFound = FALSE;
							$OldFileCount = count($OldFiles);
							for ($j = 0; $j < $OldFileCount; $j++) {
								$file1 = $OldFiles[$j];
								if ($file1 == $file) { // Old file found, no need to delete anymore
									unset($OldFiles[$j]);
									$OldFileFound = TRUE;
									break;
								}
							}
							if ($OldFileFound) // No need to check if file exists further
								continue;
							$file1 = ew_UploadFileNameEx($this->img_05->PhysicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(ew_UploadTempPath($fldvar, $this->img_05->TblVar) . $file1) || file_exists($this->img_05->PhysicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = ew_UniqueFilename($this->img_05->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(ew_UploadTempPath($fldvar, $this->img_05->TblVar) . $file, ew_UploadTempPath($fldvar, $this->img_05->TblVar) . $file1);
								$NewFiles[$i] = $file1;
							}
						}
					}
				}
				$this->img_05->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
				$this->img_05->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
				$this->img_05->SetDbValueDef($rsnew, $this->img_05->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->img_06->Visible && !$this->img_06->Upload->KeepFile) {
			$this->img_06->UploadPath = 'uploads/usedcars';
			$OldFiles = ew_Empty($this->img_06->Upload->DbValue) ? array() : array($this->img_06->Upload->DbValue);
			if (!ew_Empty($this->img_06->Upload->FileName)) {
				$NewFiles = array($this->img_06->Upload->FileName);
				$NewFileCount = count($NewFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					$fldvar = ($this->img_06->Upload->Index < 0) ? $this->img_06->FldVar : substr($this->img_06->FldVar, 0, 1) . $this->img_06->Upload->Index . substr($this->img_06->FldVar, 1);
					if ($NewFiles[$i] <> "") {
						$file = $NewFiles[$i];
						if (file_exists(ew_UploadTempPath($fldvar, $this->img_06->TblVar) . $file)) {
							$OldFileFound = FALSE;
							$OldFileCount = count($OldFiles);
							for ($j = 0; $j < $OldFileCount; $j++) {
								$file1 = $OldFiles[$j];
								if ($file1 == $file) { // Old file found, no need to delete anymore
									unset($OldFiles[$j]);
									$OldFileFound = TRUE;
									break;
								}
							}
							if ($OldFileFound) // No need to check if file exists further
								continue;
							$file1 = ew_UploadFileNameEx($this->img_06->PhysicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(ew_UploadTempPath($fldvar, $this->img_06->TblVar) . $file1) || file_exists($this->img_06->PhysicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = ew_UniqueFilename($this->img_06->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(ew_UploadTempPath($fldvar, $this->img_06->TblVar) . $file, ew_UploadTempPath($fldvar, $this->img_06->TblVar) . $file1);
								$NewFiles[$i] = $file1;
							}
						}
					}
				}
				$this->img_06->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
				$this->img_06->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
				$this->img_06->SetDbValueDef($rsnew, $this->img_06->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->img_07->Visible && !$this->img_07->Upload->KeepFile) {
			$this->img_07->UploadPath = 'uploads/usedcars';
			$OldFiles = ew_Empty($this->img_07->Upload->DbValue) ? array() : array($this->img_07->Upload->DbValue);
			if (!ew_Empty($this->img_07->Upload->FileName)) {
				$NewFiles = array($this->img_07->Upload->FileName);
				$NewFileCount = count($NewFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					$fldvar = ($this->img_07->Upload->Index < 0) ? $this->img_07->FldVar : substr($this->img_07->FldVar, 0, 1) . $this->img_07->Upload->Index . substr($this->img_07->FldVar, 1);
					if ($NewFiles[$i] <> "") {
						$file = $NewFiles[$i];
						if (file_exists(ew_UploadTempPath($fldvar, $this->img_07->TblVar) . $file)) {
							$OldFileFound = FALSE;
							$OldFileCount = count($OldFiles);
							for ($j = 0; $j < $OldFileCount; $j++) {
								$file1 = $OldFiles[$j];
								if ($file1 == $file) { // Old file found, no need to delete anymore
									unset($OldFiles[$j]);
									$OldFileFound = TRUE;
									break;
								}
							}
							if ($OldFileFound) // No need to check if file exists further
								continue;
							$file1 = ew_UploadFileNameEx($this->img_07->PhysicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(ew_UploadTempPath($fldvar, $this->img_07->TblVar) . $file1) || file_exists($this->img_07->PhysicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = ew_UniqueFilename($this->img_07->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(ew_UploadTempPath($fldvar, $this->img_07->TblVar) . $file, ew_UploadTempPath($fldvar, $this->img_07->TblVar) . $file1);
								$NewFiles[$i] = $file1;
							}
						}
					}
				}
				$this->img_07->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
				$this->img_07->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
				$this->img_07->SetDbValueDef($rsnew, $this->img_07->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->img_08->Visible && !$this->img_08->Upload->KeepFile) {
			$this->img_08->UploadPath = 'uploads/usedcars';
			$OldFiles = ew_Empty($this->img_08->Upload->DbValue) ? array() : array($this->img_08->Upload->DbValue);
			if (!ew_Empty($this->img_08->Upload->FileName)) {
				$NewFiles = array($this->img_08->Upload->FileName);
				$NewFileCount = count($NewFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					$fldvar = ($this->img_08->Upload->Index < 0) ? $this->img_08->FldVar : substr($this->img_08->FldVar, 0, 1) . $this->img_08->Upload->Index . substr($this->img_08->FldVar, 1);
					if ($NewFiles[$i] <> "") {
						$file = $NewFiles[$i];
						if (file_exists(ew_UploadTempPath($fldvar, $this->img_08->TblVar) . $file)) {
							$OldFileFound = FALSE;
							$OldFileCount = count($OldFiles);
							for ($j = 0; $j < $OldFileCount; $j++) {
								$file1 = $OldFiles[$j];
								if ($file1 == $file) { // Old file found, no need to delete anymore
									unset($OldFiles[$j]);
									$OldFileFound = TRUE;
									break;
								}
							}
							if ($OldFileFound) // No need to check if file exists further
								continue;
							$file1 = ew_UploadFileNameEx($this->img_08->PhysicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(ew_UploadTempPath($fldvar, $this->img_08->TblVar) . $file1) || file_exists($this->img_08->PhysicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = ew_UniqueFilename($this->img_08->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(ew_UploadTempPath($fldvar, $this->img_08->TblVar) . $file, ew_UploadTempPath($fldvar, $this->img_08->TblVar) . $file1);
								$NewFiles[$i] = $file1;
							}
						}
					}
				}
				$this->img_08->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
				$this->img_08->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
				$this->img_08->SetDbValueDef($rsnew, $this->img_08->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->img_09->Visible && !$this->img_09->Upload->KeepFile) {
			$this->img_09->UploadPath = 'uploads/usedcars';
			$OldFiles = ew_Empty($this->img_09->Upload->DbValue) ? array() : array($this->img_09->Upload->DbValue);
			if (!ew_Empty($this->img_09->Upload->FileName)) {
				$NewFiles = array($this->img_09->Upload->FileName);
				$NewFileCount = count($NewFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					$fldvar = ($this->img_09->Upload->Index < 0) ? $this->img_09->FldVar : substr($this->img_09->FldVar, 0, 1) . $this->img_09->Upload->Index . substr($this->img_09->FldVar, 1);
					if ($NewFiles[$i] <> "") {
						$file = $NewFiles[$i];
						if (file_exists(ew_UploadTempPath($fldvar, $this->img_09->TblVar) . $file)) {
							$OldFileFound = FALSE;
							$OldFileCount = count($OldFiles);
							for ($j = 0; $j < $OldFileCount; $j++) {
								$file1 = $OldFiles[$j];
								if ($file1 == $file) { // Old file found, no need to delete anymore
									unset($OldFiles[$j]);
									$OldFileFound = TRUE;
									break;
								}
							}
							if ($OldFileFound) // No need to check if file exists further
								continue;
							$file1 = ew_UploadFileNameEx($this->img_09->PhysicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(ew_UploadTempPath($fldvar, $this->img_09->TblVar) . $file1) || file_exists($this->img_09->PhysicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = ew_UniqueFilename($this->img_09->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(ew_UploadTempPath($fldvar, $this->img_09->TblVar) . $file, ew_UploadTempPath($fldvar, $this->img_09->TblVar) . $file1);
								$NewFiles[$i] = $file1;
							}
						}
					}
				}
				$this->img_09->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
				$this->img_09->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
				$this->img_09->SetDbValueDef($rsnew, $this->img_09->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->img_10->Visible && !$this->img_10->Upload->KeepFile) {
			$this->img_10->UploadPath = 'uploads/usedcars';
			$OldFiles = ew_Empty($this->img_10->Upload->DbValue) ? array() : array($this->img_10->Upload->DbValue);
			if (!ew_Empty($this->img_10->Upload->FileName)) {
				$NewFiles = array($this->img_10->Upload->FileName);
				$NewFileCount = count($NewFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					$fldvar = ($this->img_10->Upload->Index < 0) ? $this->img_10->FldVar : substr($this->img_10->FldVar, 0, 1) . $this->img_10->Upload->Index . substr($this->img_10->FldVar, 1);
					if ($NewFiles[$i] <> "") {
						$file = $NewFiles[$i];
						if (file_exists(ew_UploadTempPath($fldvar, $this->img_10->TblVar) . $file)) {
							$OldFileFound = FALSE;
							$OldFileCount = count($OldFiles);
							for ($j = 0; $j < $OldFileCount; $j++) {
								$file1 = $OldFiles[$j];
								if ($file1 == $file) { // Old file found, no need to delete anymore
									unset($OldFiles[$j]);
									$OldFileFound = TRUE;
									break;
								}
							}
							if ($OldFileFound) // No need to check if file exists further
								continue;
							$file1 = ew_UploadFileNameEx($this->img_10->PhysicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(ew_UploadTempPath($fldvar, $this->img_10->TblVar) . $file1) || file_exists($this->img_10->PhysicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = ew_UniqueFilename($this->img_10->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(ew_UploadTempPath($fldvar, $this->img_10->TblVar) . $file, ew_UploadTempPath($fldvar, $this->img_10->TblVar) . $file1);
								$NewFiles[$i] = $file1;
							}
						}
					}
				}
				$this->img_10->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
				$this->img_10->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
				$this->img_10->SetDbValueDef($rsnew, $this->img_10->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->img_11->Visible && !$this->img_11->Upload->KeepFile) {
			$this->img_11->UploadPath = 'uploads/usedcars';
			$OldFiles = ew_Empty($this->img_11->Upload->DbValue) ? array() : array($this->img_11->Upload->DbValue);
			if (!ew_Empty($this->img_11->Upload->FileName)) {
				$NewFiles = array($this->img_11->Upload->FileName);
				$NewFileCount = count($NewFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					$fldvar = ($this->img_11->Upload->Index < 0) ? $this->img_11->FldVar : substr($this->img_11->FldVar, 0, 1) . $this->img_11->Upload->Index . substr($this->img_11->FldVar, 1);
					if ($NewFiles[$i] <> "") {
						$file = $NewFiles[$i];
						if (file_exists(ew_UploadTempPath($fldvar, $this->img_11->TblVar) . $file)) {
							$OldFileFound = FALSE;
							$OldFileCount = count($OldFiles);
							for ($j = 0; $j < $OldFileCount; $j++) {
								$file1 = $OldFiles[$j];
								if ($file1 == $file) { // Old file found, no need to delete anymore
									unset($OldFiles[$j]);
									$OldFileFound = TRUE;
									break;
								}
							}
							if ($OldFileFound) // No need to check if file exists further
								continue;
							$file1 = ew_UploadFileNameEx($this->img_11->PhysicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(ew_UploadTempPath($fldvar, $this->img_11->TblVar) . $file1) || file_exists($this->img_11->PhysicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = ew_UniqueFilename($this->img_11->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(ew_UploadTempPath($fldvar, $this->img_11->TblVar) . $file, ew_UploadTempPath($fldvar, $this->img_11->TblVar) . $file1);
								$NewFiles[$i] = $file1;
							}
						}
					}
				}
				$this->img_11->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
				$this->img_11->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
				$this->img_11->SetDbValueDef($rsnew, $this->img_11->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->img_12->Visible && !$this->img_12->Upload->KeepFile) {
			$this->img_12->UploadPath = 'uploads/usedcars';
			$OldFiles = ew_Empty($this->img_12->Upload->DbValue) ? array() : array($this->img_12->Upload->DbValue);
			if (!ew_Empty($this->img_12->Upload->FileName)) {
				$NewFiles = array($this->img_12->Upload->FileName);
				$NewFileCount = count($NewFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					$fldvar = ($this->img_12->Upload->Index < 0) ? $this->img_12->FldVar : substr($this->img_12->FldVar, 0, 1) . $this->img_12->Upload->Index . substr($this->img_12->FldVar, 1);
					if ($NewFiles[$i] <> "") {
						$file = $NewFiles[$i];
						if (file_exists(ew_UploadTempPath($fldvar, $this->img_12->TblVar) . $file)) {
							$OldFileFound = FALSE;
							$OldFileCount = count($OldFiles);
							for ($j = 0; $j < $OldFileCount; $j++) {
								$file1 = $OldFiles[$j];
								if ($file1 == $file) { // Old file found, no need to delete anymore
									unset($OldFiles[$j]);
									$OldFileFound = TRUE;
									break;
								}
							}
							if ($OldFileFound) // No need to check if file exists further
								continue;
							$file1 = ew_UploadFileNameEx($this->img_12->PhysicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(ew_UploadTempPath($fldvar, $this->img_12->TblVar) . $file1) || file_exists($this->img_12->PhysicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = ew_UniqueFilename($this->img_12->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(ew_UploadTempPath($fldvar, $this->img_12->TblVar) . $file, ew_UploadTempPath($fldvar, $this->img_12->TblVar) . $file1);
								$NewFiles[$i] = $file1;
							}
						}
					}
				}
				$this->img_12->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
				$this->img_12->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
				$this->img_12->SetDbValueDef($rsnew, $this->img_12->Upload->FileName, NULL, FALSE);
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
				if ($this->_thumbnail->Visible && !$this->_thumbnail->Upload->KeepFile) {
					$OldFiles = ew_Empty($this->_thumbnail->Upload->DbValue) ? array() : array($this->_thumbnail->Upload->DbValue);
					if (!ew_Empty($this->_thumbnail->Upload->FileName)) {
						$NewFiles = array($this->_thumbnail->Upload->FileName);
						$NewFiles2 = array($rsnew['thumbnail']);
						$NewFileCount = count($NewFiles);
						for ($i = 0; $i < $NewFileCount; $i++) {
							$fldvar = ($this->_thumbnail->Upload->Index < 0) ? $this->_thumbnail->FldVar : substr($this->_thumbnail->FldVar, 0, 1) . $this->_thumbnail->Upload->Index . substr($this->_thumbnail->FldVar, 1);
							if ($NewFiles[$i] <> "") {
								$file = ew_UploadTempPath($fldvar, $this->_thumbnail->TblVar) . $NewFiles[$i];
								if (file_exists($file)) {
									if (@$NewFiles2[$i] <> "") // Use correct file name
										$NewFiles[$i] = $NewFiles2[$i];
									if (!$this->_thumbnail->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->Phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$NewFiles = array();
					}
					$OldFileCount = count($OldFiles);
					for ($i = 0; $i < $OldFileCount; $i++) {
						if ($OldFiles[$i] <> "" && !in_array($OldFiles[$i], $NewFiles))
							@unlink($this->_thumbnail->OldPhysicalUploadPath() . $OldFiles[$i]);
					}
				}
				if ($this->img_01->Visible && !$this->img_01->Upload->KeepFile) {
					$OldFiles = ew_Empty($this->img_01->Upload->DbValue) ? array() : array($this->img_01->Upload->DbValue);
					if (!ew_Empty($this->img_01->Upload->FileName)) {
						$NewFiles = array($this->img_01->Upload->FileName);
						$NewFiles2 = array($rsnew['img_01']);
						$NewFileCount = count($NewFiles);
						for ($i = 0; $i < $NewFileCount; $i++) {
							$fldvar = ($this->img_01->Upload->Index < 0) ? $this->img_01->FldVar : substr($this->img_01->FldVar, 0, 1) . $this->img_01->Upload->Index . substr($this->img_01->FldVar, 1);
							if ($NewFiles[$i] <> "") {
								$file = ew_UploadTempPath($fldvar, $this->img_01->TblVar) . $NewFiles[$i];
								if (file_exists($file)) {
									if (@$NewFiles2[$i] <> "") // Use correct file name
										$NewFiles[$i] = $NewFiles2[$i];
									if (!$this->img_01->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->Phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$NewFiles = array();
					}
					$OldFileCount = count($OldFiles);
					for ($i = 0; $i < $OldFileCount; $i++) {
						if ($OldFiles[$i] <> "" && !in_array($OldFiles[$i], $NewFiles))
							@unlink($this->img_01->OldPhysicalUploadPath() . $OldFiles[$i]);
					}
				}
				if ($this->img_02->Visible && !$this->img_02->Upload->KeepFile) {
					$OldFiles = ew_Empty($this->img_02->Upload->DbValue) ? array() : array($this->img_02->Upload->DbValue);
					if (!ew_Empty($this->img_02->Upload->FileName)) {
						$NewFiles = array($this->img_02->Upload->FileName);
						$NewFiles2 = array($rsnew['img_02']);
						$NewFileCount = count($NewFiles);
						for ($i = 0; $i < $NewFileCount; $i++) {
							$fldvar = ($this->img_02->Upload->Index < 0) ? $this->img_02->FldVar : substr($this->img_02->FldVar, 0, 1) . $this->img_02->Upload->Index . substr($this->img_02->FldVar, 1);
							if ($NewFiles[$i] <> "") {
								$file = ew_UploadTempPath($fldvar, $this->img_02->TblVar) . $NewFiles[$i];
								if (file_exists($file)) {
									if (@$NewFiles2[$i] <> "") // Use correct file name
										$NewFiles[$i] = $NewFiles2[$i];
									if (!$this->img_02->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->Phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$NewFiles = array();
					}
					$OldFileCount = count($OldFiles);
					for ($i = 0; $i < $OldFileCount; $i++) {
						if ($OldFiles[$i] <> "" && !in_array($OldFiles[$i], $NewFiles))
							@unlink($this->img_02->OldPhysicalUploadPath() . $OldFiles[$i]);
					}
				}
				if ($this->img_03->Visible && !$this->img_03->Upload->KeepFile) {
					$OldFiles = ew_Empty($this->img_03->Upload->DbValue) ? array() : array($this->img_03->Upload->DbValue);
					if (!ew_Empty($this->img_03->Upload->FileName)) {
						$NewFiles = array($this->img_03->Upload->FileName);
						$NewFiles2 = array($rsnew['img_03']);
						$NewFileCount = count($NewFiles);
						for ($i = 0; $i < $NewFileCount; $i++) {
							$fldvar = ($this->img_03->Upload->Index < 0) ? $this->img_03->FldVar : substr($this->img_03->FldVar, 0, 1) . $this->img_03->Upload->Index . substr($this->img_03->FldVar, 1);
							if ($NewFiles[$i] <> "") {
								$file = ew_UploadTempPath($fldvar, $this->img_03->TblVar) . $NewFiles[$i];
								if (file_exists($file)) {
									if (@$NewFiles2[$i] <> "") // Use correct file name
										$NewFiles[$i] = $NewFiles2[$i];
									if (!$this->img_03->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->Phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$NewFiles = array();
					}
					$OldFileCount = count($OldFiles);
					for ($i = 0; $i < $OldFileCount; $i++) {
						if ($OldFiles[$i] <> "" && !in_array($OldFiles[$i], $NewFiles))
							@unlink($this->img_03->OldPhysicalUploadPath() . $OldFiles[$i]);
					}
				}
				if ($this->img_04->Visible && !$this->img_04->Upload->KeepFile) {
					$OldFiles = ew_Empty($this->img_04->Upload->DbValue) ? array() : array($this->img_04->Upload->DbValue);
					if (!ew_Empty($this->img_04->Upload->FileName)) {
						$NewFiles = array($this->img_04->Upload->FileName);
						$NewFiles2 = array($rsnew['img_04']);
						$NewFileCount = count($NewFiles);
						for ($i = 0; $i < $NewFileCount; $i++) {
							$fldvar = ($this->img_04->Upload->Index < 0) ? $this->img_04->FldVar : substr($this->img_04->FldVar, 0, 1) . $this->img_04->Upload->Index . substr($this->img_04->FldVar, 1);
							if ($NewFiles[$i] <> "") {
								$file = ew_UploadTempPath($fldvar, $this->img_04->TblVar) . $NewFiles[$i];
								if (file_exists($file)) {
									if (@$NewFiles2[$i] <> "") // Use correct file name
										$NewFiles[$i] = $NewFiles2[$i];
									if (!$this->img_04->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->Phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$NewFiles = array();
					}
					$OldFileCount = count($OldFiles);
					for ($i = 0; $i < $OldFileCount; $i++) {
						if ($OldFiles[$i] <> "" && !in_array($OldFiles[$i], $NewFiles))
							@unlink($this->img_04->OldPhysicalUploadPath() . $OldFiles[$i]);
					}
				}
				if ($this->img_05->Visible && !$this->img_05->Upload->KeepFile) {
					$OldFiles = ew_Empty($this->img_05->Upload->DbValue) ? array() : array($this->img_05->Upload->DbValue);
					if (!ew_Empty($this->img_05->Upload->FileName)) {
						$NewFiles = array($this->img_05->Upload->FileName);
						$NewFiles2 = array($rsnew['img_05']);
						$NewFileCount = count($NewFiles);
						for ($i = 0; $i < $NewFileCount; $i++) {
							$fldvar = ($this->img_05->Upload->Index < 0) ? $this->img_05->FldVar : substr($this->img_05->FldVar, 0, 1) . $this->img_05->Upload->Index . substr($this->img_05->FldVar, 1);
							if ($NewFiles[$i] <> "") {
								$file = ew_UploadTempPath($fldvar, $this->img_05->TblVar) . $NewFiles[$i];
								if (file_exists($file)) {
									if (@$NewFiles2[$i] <> "") // Use correct file name
										$NewFiles[$i] = $NewFiles2[$i];
									if (!$this->img_05->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->Phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$NewFiles = array();
					}
					$OldFileCount = count($OldFiles);
					for ($i = 0; $i < $OldFileCount; $i++) {
						if ($OldFiles[$i] <> "" && !in_array($OldFiles[$i], $NewFiles))
							@unlink($this->img_05->OldPhysicalUploadPath() . $OldFiles[$i]);
					}
				}
				if ($this->img_06->Visible && !$this->img_06->Upload->KeepFile) {
					$OldFiles = ew_Empty($this->img_06->Upload->DbValue) ? array() : array($this->img_06->Upload->DbValue);
					if (!ew_Empty($this->img_06->Upload->FileName)) {
						$NewFiles = array($this->img_06->Upload->FileName);
						$NewFiles2 = array($rsnew['img_06']);
						$NewFileCount = count($NewFiles);
						for ($i = 0; $i < $NewFileCount; $i++) {
							$fldvar = ($this->img_06->Upload->Index < 0) ? $this->img_06->FldVar : substr($this->img_06->FldVar, 0, 1) . $this->img_06->Upload->Index . substr($this->img_06->FldVar, 1);
							if ($NewFiles[$i] <> "") {
								$file = ew_UploadTempPath($fldvar, $this->img_06->TblVar) . $NewFiles[$i];
								if (file_exists($file)) {
									if (@$NewFiles2[$i] <> "") // Use correct file name
										$NewFiles[$i] = $NewFiles2[$i];
									if (!$this->img_06->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->Phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$NewFiles = array();
					}
					$OldFileCount = count($OldFiles);
					for ($i = 0; $i < $OldFileCount; $i++) {
						if ($OldFiles[$i] <> "" && !in_array($OldFiles[$i], $NewFiles))
							@unlink($this->img_06->OldPhysicalUploadPath() . $OldFiles[$i]);
					}
				}
				if ($this->img_07->Visible && !$this->img_07->Upload->KeepFile) {
					$OldFiles = ew_Empty($this->img_07->Upload->DbValue) ? array() : array($this->img_07->Upload->DbValue);
					if (!ew_Empty($this->img_07->Upload->FileName)) {
						$NewFiles = array($this->img_07->Upload->FileName);
						$NewFiles2 = array($rsnew['img_07']);
						$NewFileCount = count($NewFiles);
						for ($i = 0; $i < $NewFileCount; $i++) {
							$fldvar = ($this->img_07->Upload->Index < 0) ? $this->img_07->FldVar : substr($this->img_07->FldVar, 0, 1) . $this->img_07->Upload->Index . substr($this->img_07->FldVar, 1);
							if ($NewFiles[$i] <> "") {
								$file = ew_UploadTempPath($fldvar, $this->img_07->TblVar) . $NewFiles[$i];
								if (file_exists($file)) {
									if (@$NewFiles2[$i] <> "") // Use correct file name
										$NewFiles[$i] = $NewFiles2[$i];
									if (!$this->img_07->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->Phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$NewFiles = array();
					}
					$OldFileCount = count($OldFiles);
					for ($i = 0; $i < $OldFileCount; $i++) {
						if ($OldFiles[$i] <> "" && !in_array($OldFiles[$i], $NewFiles))
							@unlink($this->img_07->OldPhysicalUploadPath() . $OldFiles[$i]);
					}
				}
				if ($this->img_08->Visible && !$this->img_08->Upload->KeepFile) {
					$OldFiles = ew_Empty($this->img_08->Upload->DbValue) ? array() : array($this->img_08->Upload->DbValue);
					if (!ew_Empty($this->img_08->Upload->FileName)) {
						$NewFiles = array($this->img_08->Upload->FileName);
						$NewFiles2 = array($rsnew['img_08']);
						$NewFileCount = count($NewFiles);
						for ($i = 0; $i < $NewFileCount; $i++) {
							$fldvar = ($this->img_08->Upload->Index < 0) ? $this->img_08->FldVar : substr($this->img_08->FldVar, 0, 1) . $this->img_08->Upload->Index . substr($this->img_08->FldVar, 1);
							if ($NewFiles[$i] <> "") {
								$file = ew_UploadTempPath($fldvar, $this->img_08->TblVar) . $NewFiles[$i];
								if (file_exists($file)) {
									if (@$NewFiles2[$i] <> "") // Use correct file name
										$NewFiles[$i] = $NewFiles2[$i];
									if (!$this->img_08->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->Phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$NewFiles = array();
					}
					$OldFileCount = count($OldFiles);
					for ($i = 0; $i < $OldFileCount; $i++) {
						if ($OldFiles[$i] <> "" && !in_array($OldFiles[$i], $NewFiles))
							@unlink($this->img_08->OldPhysicalUploadPath() . $OldFiles[$i]);
					}
				}
				if ($this->img_09->Visible && !$this->img_09->Upload->KeepFile) {
					$OldFiles = ew_Empty($this->img_09->Upload->DbValue) ? array() : array($this->img_09->Upload->DbValue);
					if (!ew_Empty($this->img_09->Upload->FileName)) {
						$NewFiles = array($this->img_09->Upload->FileName);
						$NewFiles2 = array($rsnew['img_09']);
						$NewFileCount = count($NewFiles);
						for ($i = 0; $i < $NewFileCount; $i++) {
							$fldvar = ($this->img_09->Upload->Index < 0) ? $this->img_09->FldVar : substr($this->img_09->FldVar, 0, 1) . $this->img_09->Upload->Index . substr($this->img_09->FldVar, 1);
							if ($NewFiles[$i] <> "") {
								$file = ew_UploadTempPath($fldvar, $this->img_09->TblVar) . $NewFiles[$i];
								if (file_exists($file)) {
									if (@$NewFiles2[$i] <> "") // Use correct file name
										$NewFiles[$i] = $NewFiles2[$i];
									if (!$this->img_09->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->Phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$NewFiles = array();
					}
					$OldFileCount = count($OldFiles);
					for ($i = 0; $i < $OldFileCount; $i++) {
						if ($OldFiles[$i] <> "" && !in_array($OldFiles[$i], $NewFiles))
							@unlink($this->img_09->OldPhysicalUploadPath() . $OldFiles[$i]);
					}
				}
				if ($this->img_10->Visible && !$this->img_10->Upload->KeepFile) {
					$OldFiles = ew_Empty($this->img_10->Upload->DbValue) ? array() : array($this->img_10->Upload->DbValue);
					if (!ew_Empty($this->img_10->Upload->FileName)) {
						$NewFiles = array($this->img_10->Upload->FileName);
						$NewFiles2 = array($rsnew['img_10']);
						$NewFileCount = count($NewFiles);
						for ($i = 0; $i < $NewFileCount; $i++) {
							$fldvar = ($this->img_10->Upload->Index < 0) ? $this->img_10->FldVar : substr($this->img_10->FldVar, 0, 1) . $this->img_10->Upload->Index . substr($this->img_10->FldVar, 1);
							if ($NewFiles[$i] <> "") {
								$file = ew_UploadTempPath($fldvar, $this->img_10->TblVar) . $NewFiles[$i];
								if (file_exists($file)) {
									if (@$NewFiles2[$i] <> "") // Use correct file name
										$NewFiles[$i] = $NewFiles2[$i];
									if (!$this->img_10->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->Phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$NewFiles = array();
					}
					$OldFileCount = count($OldFiles);
					for ($i = 0; $i < $OldFileCount; $i++) {
						if ($OldFiles[$i] <> "" && !in_array($OldFiles[$i], $NewFiles))
							@unlink($this->img_10->OldPhysicalUploadPath() . $OldFiles[$i]);
					}
				}
				if ($this->img_11->Visible && !$this->img_11->Upload->KeepFile) {
					$OldFiles = ew_Empty($this->img_11->Upload->DbValue) ? array() : array($this->img_11->Upload->DbValue);
					if (!ew_Empty($this->img_11->Upload->FileName)) {
						$NewFiles = array($this->img_11->Upload->FileName);
						$NewFiles2 = array($rsnew['img_11']);
						$NewFileCount = count($NewFiles);
						for ($i = 0; $i < $NewFileCount; $i++) {
							$fldvar = ($this->img_11->Upload->Index < 0) ? $this->img_11->FldVar : substr($this->img_11->FldVar, 0, 1) . $this->img_11->Upload->Index . substr($this->img_11->FldVar, 1);
							if ($NewFiles[$i] <> "") {
								$file = ew_UploadTempPath($fldvar, $this->img_11->TblVar) . $NewFiles[$i];
								if (file_exists($file)) {
									if (@$NewFiles2[$i] <> "") // Use correct file name
										$NewFiles[$i] = $NewFiles2[$i];
									if (!$this->img_11->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->Phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$NewFiles = array();
					}
					$OldFileCount = count($OldFiles);
					for ($i = 0; $i < $OldFileCount; $i++) {
						if ($OldFiles[$i] <> "" && !in_array($OldFiles[$i], $NewFiles))
							@unlink($this->img_11->OldPhysicalUploadPath() . $OldFiles[$i]);
					}
				}
				if ($this->img_12->Visible && !$this->img_12->Upload->KeepFile) {
					$OldFiles = ew_Empty($this->img_12->Upload->DbValue) ? array() : array($this->img_12->Upload->DbValue);
					if (!ew_Empty($this->img_12->Upload->FileName)) {
						$NewFiles = array($this->img_12->Upload->FileName);
						$NewFiles2 = array($rsnew['img_12']);
						$NewFileCount = count($NewFiles);
						for ($i = 0; $i < $NewFileCount; $i++) {
							$fldvar = ($this->img_12->Upload->Index < 0) ? $this->img_12->FldVar : substr($this->img_12->FldVar, 0, 1) . $this->img_12->Upload->Index . substr($this->img_12->FldVar, 1);
							if ($NewFiles[$i] <> "") {
								$file = ew_UploadTempPath($fldvar, $this->img_12->TblVar) . $NewFiles[$i];
								if (file_exists($file)) {
									if (@$NewFiles2[$i] <> "") // Use correct file name
										$NewFiles[$i] = $NewFiles2[$i];
									if (!$this->img_12->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->Phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$NewFiles = array();
					}
					$OldFileCount = count($OldFiles);
					for ($i = 0; $i < $OldFileCount; $i++) {
						if ($OldFiles[$i] <> "" && !in_array($OldFiles[$i], $NewFiles))
							@unlink($this->img_12->OldPhysicalUploadPath() . $OldFiles[$i]);
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

		// thumbnail
		ew_CleanUploadTempPath($this->_thumbnail, $this->_thumbnail->Upload->Index);

		// img_01
		ew_CleanUploadTempPath($this->img_01, $this->img_01->Upload->Index);

		// img_02
		ew_CleanUploadTempPath($this->img_02, $this->img_02->Upload->Index);

		// img_03
		ew_CleanUploadTempPath($this->img_03, $this->img_03->Upload->Index);

		// img_04
		ew_CleanUploadTempPath($this->img_04, $this->img_04->Upload->Index);

		// img_05
		ew_CleanUploadTempPath($this->img_05, $this->img_05->Upload->Index);

		// img_06
		ew_CleanUploadTempPath($this->img_06, $this->img_06->Upload->Index);

		// img_07
		ew_CleanUploadTempPath($this->img_07, $this->img_07->Upload->Index);

		// img_08
		ew_CleanUploadTempPath($this->img_08, $this->img_08->Upload->Index);

		// img_09
		ew_CleanUploadTempPath($this->img_09, $this->img_09->Upload->Index);

		// img_10
		ew_CleanUploadTempPath($this->img_10, $this->img_10->Upload->Index);

		// img_11
		ew_CleanUploadTempPath($this->img_11, $this->img_11->Upload->Index);

		// img_12
		ew_CleanUploadTempPath($this->img_12, $this->img_12->Upload->Index);
		return $AddRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("used_carslist.php"), "", $this->TableVar, TRUE);
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
		$pages->Add(4);
		$this->MultiPages = $pages;
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
		case "x_yearID":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `yearID` AS `LinkFld`, `year` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_year`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`yearID` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->yearID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_fuelTypeID":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `fuelTypeID` AS `LinkFld`, `fuelType` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_fuel_type`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`fuelTypeID` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->fuelTypeID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_regionalID":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `regionalID` AS `LinkFld`, `regionalSpecs` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_regional_spec`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`regionalID` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->regionalID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_warrantyID":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `warrantyID` AS `LinkFld`, `warrantyName` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_warranty`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`warrantyID` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->warrantyID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_transmissionTypeID":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `transmissionID` AS `LinkFld`, `transmission` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_transmission`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`transmissionID` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->transmissionTypeID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_cylinderID":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `cylinderID` AS `LinkFld`, `cylinder` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_cylinder`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`cylinderID` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->cylinderID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_colorID":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `colorID` AS `LinkFld`, `color` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_color`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`colorID` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->colorID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_bodyConditionID":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `bodyConditionID` AS `LinkFld`, `bodyCondition` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_body_condition`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`bodyConditionID` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->bodyConditionID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_term":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `termID` AS `LinkFld`, `term` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_term`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`termID` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->term, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_extra_features":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `featureID` AS `LinkFld`, `extraFeatures` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_extra_features`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`featureID` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->extra_features, $sWhereWrk); // Call Lookup Selecting
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
if (!isset($used_cars_add)) $used_cars_add = new cused_cars_add();

// Page init
$used_cars_add->Page_Init();

// Page main
$used_cars_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$used_cars_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = fused_carsadd = new ew_Form("fused_carsadd", "add");

// Validate form
fused_carsadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_slug");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $used_cars->slug->FldCaption(), $used_cars->slug->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_kilometers");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($used_cars->kilometers->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_priceAED");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($used_cars->priceAED->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_priceUSD");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($used_cars->priceUSD->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_priceOMR");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($used_cars->priceOMR->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_priceSAR");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($used_cars->priceSAR->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_noOfDoors");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($used_cars->noOfDoors->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_so");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($used_cars->so->FldErrMsg()) ?>");

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
fused_carsadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fused_carsadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Multi-Page
fused_carsadd.MultiPage = new ew_MultiPage("fused_carsadd");

// Dynamic selection lists
fused_carsadd.Lists["x_makeID"] = {"LinkField":"x_makeID","Ajax":true,"AutoFill":false,"DisplayFields":["x_make","","",""],"ParentFields":[],"ChildFields":["x_modelID"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_make"};
fused_carsadd.Lists["x_makeID"].Data = "<?php echo $used_cars_add->makeID->LookupFilterQuery(FALSE, "add") ?>";
fused_carsadd.Lists["x_modelID"] = {"LinkField":"x_modelID","Ajax":true,"AutoFill":false,"DisplayFields":["x_model","","",""],"ParentFields":["x_makeID"],"ChildFields":[],"FilterFields":["x_makeID"],"Options":[],"Template":"","LinkTable":"mtr_model"};
fused_carsadd.Lists["x_modelID"].Data = "<?php echo $used_cars_add->modelID->LookupFilterQuery(FALSE, "add") ?>";
fused_carsadd.Lists["x_yearID"] = {"LinkField":"x_yearID","Ajax":true,"AutoFill":false,"DisplayFields":["x_year","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_year"};
fused_carsadd.Lists["x_yearID"].Data = "<?php echo $used_cars_add->yearID->LookupFilterQuery(FALSE, "add") ?>";
fused_carsadd.Lists["x_fuelTypeID"] = {"LinkField":"x_fuelTypeID","Ajax":true,"AutoFill":false,"DisplayFields":["x_fuelType","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_fuel_type"};
fused_carsadd.Lists["x_fuelTypeID"].Data = "<?php echo $used_cars_add->fuelTypeID->LookupFilterQuery(FALSE, "add") ?>";
fused_carsadd.Lists["x_regionalID"] = {"LinkField":"x_regionalID","Ajax":true,"AutoFill":false,"DisplayFields":["x_regionalSpecs","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_regional_spec"};
fused_carsadd.Lists["x_regionalID"].Data = "<?php echo $used_cars_add->regionalID->LookupFilterQuery(FALSE, "add") ?>";
fused_carsadd.Lists["x_warrantyID"] = {"LinkField":"x_warrantyID","Ajax":true,"AutoFill":false,"DisplayFields":["x_warrantyName","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_warranty"};
fused_carsadd.Lists["x_warrantyID"].Data = "<?php echo $used_cars_add->warrantyID->LookupFilterQuery(FALSE, "add") ?>";
fused_carsadd.Lists["x_transmissionTypeID"] = {"LinkField":"x_transmissionID","Ajax":true,"AutoFill":false,"DisplayFields":["x_transmission","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_transmission"};
fused_carsadd.Lists["x_transmissionTypeID"].Data = "<?php echo $used_cars_add->transmissionTypeID->LookupFilterQuery(FALSE, "add") ?>";
fused_carsadd.Lists["x_cylinderID"] = {"LinkField":"x_cylinderID","Ajax":true,"AutoFill":false,"DisplayFields":["x_cylinder","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_cylinder"};
fused_carsadd.Lists["x_cylinderID"].Data = "<?php echo $used_cars_add->cylinderID->LookupFilterQuery(FALSE, "add") ?>";
fused_carsadd.Lists["x_colorID"] = {"LinkField":"x_colorID","Ajax":true,"AutoFill":false,"DisplayFields":["x_color","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_color"};
fused_carsadd.Lists["x_colorID"].Data = "<?php echo $used_cars_add->colorID->LookupFilterQuery(FALSE, "add") ?>";
fused_carsadd.Lists["x_bodyConditionID"] = {"LinkField":"x_bodyConditionID","Ajax":true,"AutoFill":false,"DisplayFields":["x_bodyCondition","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_body_condition"};
fused_carsadd.Lists["x_bodyConditionID"].Data = "<?php echo $used_cars_add->bodyConditionID->LookupFilterQuery(FALSE, "add") ?>";
fused_carsadd.Lists["x_term"] = {"LinkField":"x_termID","Ajax":true,"AutoFill":false,"DisplayFields":["x_term","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_term"};
fused_carsadd.Lists["x_term"].Data = "<?php echo $used_cars_add->term->LookupFilterQuery(FALSE, "add") ?>";
fused_carsadd.Lists["x_extra_features[]"] = {"LinkField":"x_featureID","Ajax":true,"AutoFill":false,"DisplayFields":["x_extraFeatures","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_extra_features"};
fused_carsadd.Lists["x_extra_features[]"].Data = "<?php echo $used_cars_add->extra_features->LookupFilterQuery(FALSE, "add") ?>";
fused_carsadd.Lists["x_active"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fused_carsadd.Lists["x_active"].Options = <?php echo json_encode($used_cars_add->active->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $used_cars_add->ShowPageHeader(); ?>
<?php
$used_cars_add->ShowMessage();
?>
<form name="fused_carsadd" id="fused_carsadd" class="<?php echo $used_cars_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($used_cars_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $used_cars_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="used_cars">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($used_cars_add->IsModal) ?>">
<div class="ewMultiPage"><!-- multi-page -->
<div class="nav-tabs-custom" id="used_cars_add"><!-- multi-page .nav-tabs-custom -->
	<ul class="nav<?php echo $used_cars_add->MultiPages->NavStyle() ?>">
		<li<?php echo $used_cars_add->MultiPages->TabStyle("1") ?>><a href="#tab_used_cars1" data-toggle="tab"><?php echo $used_cars->PageCaption(1) ?></a></li>
		<li<?php echo $used_cars_add->MultiPages->TabStyle("2") ?>><a href="#tab_used_cars2" data-toggle="tab"><?php echo $used_cars->PageCaption(2) ?></a></li>
		<li<?php echo $used_cars_add->MultiPages->TabStyle("3") ?>><a href="#tab_used_cars3" data-toggle="tab"><?php echo $used_cars->PageCaption(3) ?></a></li>
		<li<?php echo $used_cars_add->MultiPages->TabStyle("4") ?>><a href="#tab_used_cars4" data-toggle="tab"><?php echo $used_cars->PageCaption(4) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page .nav-tabs-custom .tab-content -->
		<div class="tab-pane<?php echo $used_cars_add->MultiPages->PageStyle("1") ?>" id="tab_used_cars1"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($used_cars->makeID->Visible) { // makeID ?>
	<div id="r_makeID" class="form-group">
		<label id="elh_used_cars_makeID" for="x_makeID" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->makeID->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->makeID->CellAttributes() ?>>
<span id="el_used_cars_makeID">
<?php $used_cars->makeID->EditAttrs["onchange"] = "ew_UpdateOpt.call(this); " . @$used_cars->makeID->EditAttrs["onchange"]; ?>
<select data-table="used_cars" data-field="x_makeID" data-page="1" data-value-separator="<?php echo $used_cars->makeID->DisplayValueSeparatorAttribute() ?>" id="x_makeID" name="x_makeID"<?php echo $used_cars->makeID->EditAttributes() ?>>
<?php echo $used_cars->makeID->SelectOptionListHtml("x_makeID") ?>
</select>
</span>
<?php echo $used_cars->makeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->modelID->Visible) { // modelID ?>
	<div id="r_modelID" class="form-group">
		<label id="elh_used_cars_modelID" for="x_modelID" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->modelID->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->modelID->CellAttributes() ?>>
<span id="el_used_cars_modelID">
<select data-table="used_cars" data-field="x_modelID" data-page="1" data-value-separator="<?php echo $used_cars->modelID->DisplayValueSeparatorAttribute() ?>" id="x_modelID" name="x_modelID"<?php echo $used_cars->modelID->EditAttributes() ?>>
<?php echo $used_cars->modelID->SelectOptionListHtml("x_modelID") ?>
</select>
</span>
<?php echo $used_cars->modelID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->slug->Visible) { // slug ?>
	<div id="r_slug" class="form-group">
		<label id="elh_used_cars_slug" for="x_slug" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->slug->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->slug->CellAttributes() ?>>
<span id="el_used_cars_slug">
<input type="text" data-table="used_cars" data-field="x_slug" data-page="1" name="x_slug" id="x_slug" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($used_cars->slug->getPlaceHolder()) ?>" value="<?php echo $used_cars->slug->EditValue ?>"<?php echo $used_cars->slug->EditAttributes() ?>>
</span>
<?php echo $used_cars->slug->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->yearID->Visible) { // yearID ?>
	<div id="r_yearID" class="form-group">
		<label id="elh_used_cars_yearID" for="x_yearID" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->yearID->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->yearID->CellAttributes() ?>>
<span id="el_used_cars_yearID">
<select data-table="used_cars" data-field="x_yearID" data-page="1" data-value-separator="<?php echo $used_cars->yearID->DisplayValueSeparatorAttribute() ?>" id="x_yearID" name="x_yearID"<?php echo $used_cars->yearID->EditAttributes() ?>>
<?php echo $used_cars->yearID->SelectOptionListHtml("x_yearID") ?>
</select>
</span>
<?php echo $used_cars->yearID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->kilometers->Visible) { // kilometers ?>
	<div id="r_kilometers" class="form-group">
		<label id="elh_used_cars_kilometers" for="x_kilometers" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->kilometers->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->kilometers->CellAttributes() ?>>
<span id="el_used_cars_kilometers">
<input type="text" data-table="used_cars" data-field="x_kilometers" data-page="1" name="x_kilometers" id="x_kilometers" size="30" placeholder="<?php echo ew_HtmlEncode($used_cars->kilometers->getPlaceHolder()) ?>" value="<?php echo $used_cars->kilometers->EditValue ?>"<?php echo $used_cars->kilometers->EditAttributes() ?>>
</span>
<?php echo $used_cars->kilometers->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->priceAED->Visible) { // priceAED ?>
	<div id="r_priceAED" class="form-group">
		<label id="elh_used_cars_priceAED" for="x_priceAED" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->priceAED->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->priceAED->CellAttributes() ?>>
<span id="el_used_cars_priceAED">
<input type="text" data-table="used_cars" data-field="x_priceAED" data-page="1" name="x_priceAED" id="x_priceAED" size="30" placeholder="<?php echo ew_HtmlEncode($used_cars->priceAED->getPlaceHolder()) ?>" value="<?php echo $used_cars->priceAED->EditValue ?>"<?php echo $used_cars->priceAED->EditAttributes() ?>>
</span>
<?php echo $used_cars->priceAED->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->priceUSD->Visible) { // priceUSD ?>
	<div id="r_priceUSD" class="form-group">
		<label id="elh_used_cars_priceUSD" for="x_priceUSD" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->priceUSD->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->priceUSD->CellAttributes() ?>>
<span id="el_used_cars_priceUSD">
<input type="text" data-table="used_cars" data-field="x_priceUSD" data-page="1" name="x_priceUSD" id="x_priceUSD" size="30" placeholder="<?php echo ew_HtmlEncode($used_cars->priceUSD->getPlaceHolder()) ?>" value="<?php echo $used_cars->priceUSD->EditValue ?>"<?php echo $used_cars->priceUSD->EditAttributes() ?>>
</span>
<?php echo $used_cars->priceUSD->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->priceOMR->Visible) { // priceOMR ?>
	<div id="r_priceOMR" class="form-group">
		<label id="elh_used_cars_priceOMR" for="x_priceOMR" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->priceOMR->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->priceOMR->CellAttributes() ?>>
<span id="el_used_cars_priceOMR">
<input type="text" data-table="used_cars" data-field="x_priceOMR" data-page="1" name="x_priceOMR" id="x_priceOMR" size="30" placeholder="<?php echo ew_HtmlEncode($used_cars->priceOMR->getPlaceHolder()) ?>" value="<?php echo $used_cars->priceOMR->EditValue ?>"<?php echo $used_cars->priceOMR->EditAttributes() ?>>
</span>
<?php echo $used_cars->priceOMR->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->priceSAR->Visible) { // priceSAR ?>
	<div id="r_priceSAR" class="form-group">
		<label id="elh_used_cars_priceSAR" for="x_priceSAR" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->priceSAR->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->priceSAR->CellAttributes() ?>>
<span id="el_used_cars_priceSAR">
<input type="text" data-table="used_cars" data-field="x_priceSAR" data-page="1" name="x_priceSAR" id="x_priceSAR" size="30" placeholder="<?php echo ew_HtmlEncode($used_cars->priceSAR->getPlaceHolder()) ?>" value="<?php echo $used_cars->priceSAR->EditValue ?>"<?php echo $used_cars->priceSAR->EditAttributes() ?>>
</span>
<?php echo $used_cars->priceSAR->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->so->Visible) { // so ?>
	<div id="r_so" class="form-group">
		<label id="elh_used_cars_so" for="x_so" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->so->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->so->CellAttributes() ?>>
<span id="el_used_cars_so">
<input type="text" data-table="used_cars" data-field="x_so" data-page="1" name="x_so" id="x_so" size="30" placeholder="<?php echo ew_HtmlEncode($used_cars->so->getPlaceHolder()) ?>" value="<?php echo $used_cars->so->EditValue ?>"<?php echo $used_cars->so->EditAttributes() ?>>
</span>
<?php echo $used_cars->so->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->active->Visible) { // active ?>
	<div id="r_active" class="form-group">
		<label id="elh_used_cars_active" for="x_active" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->active->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->active->CellAttributes() ?>>
<span id="el_used_cars_active">
<select data-table="used_cars" data-field="x_active" data-page="1" data-value-separator="<?php echo $used_cars->active->DisplayValueSeparatorAttribute() ?>" id="x_active" name="x_active"<?php echo $used_cars->active->EditAttributes() ?>>
<?php echo $used_cars->active->SelectOptionListHtml("x_active") ?>
</select>
</span>
<?php echo $used_cars->active->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $used_cars_add->MultiPages->PageStyle("2") ?>" id="tab_used_cars2"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($used_cars->description->Visible) { // description ?>
	<div id="r_description" class="form-group">
		<label id="elh_used_cars_description" for="x_description" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->description->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->description->CellAttributes() ?>>
<span id="el_used_cars_description">
<input type="text" data-table="used_cars" data-field="x_description" data-page="2" name="x_description" id="x_description" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($used_cars->description->getPlaceHolder()) ?>" value="<?php echo $used_cars->description->EditValue ?>"<?php echo $used_cars->description->EditAttributes() ?>>
</span>
<?php echo $used_cars->description->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->fuelTypeID->Visible) { // fuelTypeID ?>
	<div id="r_fuelTypeID" class="form-group">
		<label id="elh_used_cars_fuelTypeID" for="x_fuelTypeID" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->fuelTypeID->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->fuelTypeID->CellAttributes() ?>>
<span id="el_used_cars_fuelTypeID">
<select data-table="used_cars" data-field="x_fuelTypeID" data-page="2" data-value-separator="<?php echo $used_cars->fuelTypeID->DisplayValueSeparatorAttribute() ?>" id="x_fuelTypeID" name="x_fuelTypeID"<?php echo $used_cars->fuelTypeID->EditAttributes() ?>>
<?php echo $used_cars->fuelTypeID->SelectOptionListHtml("x_fuelTypeID") ?>
</select>
</span>
<?php echo $used_cars->fuelTypeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->regionalID->Visible) { // regionalID ?>
	<div id="r_regionalID" class="form-group">
		<label id="elh_used_cars_regionalID" for="x_regionalID" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->regionalID->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->regionalID->CellAttributes() ?>>
<span id="el_used_cars_regionalID">
<select data-table="used_cars" data-field="x_regionalID" data-page="2" data-value-separator="<?php echo $used_cars->regionalID->DisplayValueSeparatorAttribute() ?>" id="x_regionalID" name="x_regionalID"<?php echo $used_cars->regionalID->EditAttributes() ?>>
<?php echo $used_cars->regionalID->SelectOptionListHtml("x_regionalID") ?>
</select>
</span>
<?php echo $used_cars->regionalID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->warrantyID->Visible) { // warrantyID ?>
	<div id="r_warrantyID" class="form-group">
		<label id="elh_used_cars_warrantyID" for="x_warrantyID" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->warrantyID->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->warrantyID->CellAttributes() ?>>
<span id="el_used_cars_warrantyID">
<select data-table="used_cars" data-field="x_warrantyID" data-page="2" data-value-separator="<?php echo $used_cars->warrantyID->DisplayValueSeparatorAttribute() ?>" id="x_warrantyID" name="x_warrantyID"<?php echo $used_cars->warrantyID->EditAttributes() ?>>
<?php echo $used_cars->warrantyID->SelectOptionListHtml("x_warrantyID") ?>
</select>
</span>
<?php echo $used_cars->warrantyID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->noOfDoors->Visible) { // noOfDoors ?>
	<div id="r_noOfDoors" class="form-group">
		<label id="elh_used_cars_noOfDoors" for="x_noOfDoors" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->noOfDoors->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->noOfDoors->CellAttributes() ?>>
<span id="el_used_cars_noOfDoors">
<input type="text" data-table="used_cars" data-field="x_noOfDoors" data-page="2" name="x_noOfDoors" id="x_noOfDoors" size="30" placeholder="<?php echo ew_HtmlEncode($used_cars->noOfDoors->getPlaceHolder()) ?>" value="<?php echo $used_cars->noOfDoors->EditValue ?>"<?php echo $used_cars->noOfDoors->EditAttributes() ?>>
</span>
<?php echo $used_cars->noOfDoors->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->transmissionTypeID->Visible) { // transmissionTypeID ?>
	<div id="r_transmissionTypeID" class="form-group">
		<label id="elh_used_cars_transmissionTypeID" for="x_transmissionTypeID" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->transmissionTypeID->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->transmissionTypeID->CellAttributes() ?>>
<span id="el_used_cars_transmissionTypeID">
<select data-table="used_cars" data-field="x_transmissionTypeID" data-page="2" data-value-separator="<?php echo $used_cars->transmissionTypeID->DisplayValueSeparatorAttribute() ?>" id="x_transmissionTypeID" name="x_transmissionTypeID"<?php echo $used_cars->transmissionTypeID->EditAttributes() ?>>
<?php echo $used_cars->transmissionTypeID->SelectOptionListHtml("x_transmissionTypeID") ?>
</select>
</span>
<?php echo $used_cars->transmissionTypeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->cylinderID->Visible) { // cylinderID ?>
	<div id="r_cylinderID" class="form-group">
		<label id="elh_used_cars_cylinderID" for="x_cylinderID" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->cylinderID->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->cylinderID->CellAttributes() ?>>
<span id="el_used_cars_cylinderID">
<select data-table="used_cars" data-field="x_cylinderID" data-page="2" data-value-separator="<?php echo $used_cars->cylinderID->DisplayValueSeparatorAttribute() ?>" id="x_cylinderID" name="x_cylinderID"<?php echo $used_cars->cylinderID->EditAttributes() ?>>
<?php echo $used_cars->cylinderID->SelectOptionListHtml("x_cylinderID") ?>
</select>
</span>
<?php echo $used_cars->cylinderID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->engine->Visible) { // engine ?>
	<div id="r_engine" class="form-group">
		<label id="elh_used_cars_engine" for="x_engine" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->engine->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->engine->CellAttributes() ?>>
<span id="el_used_cars_engine">
<input type="text" data-table="used_cars" data-field="x_engine" data-page="2" name="x_engine" id="x_engine" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($used_cars->engine->getPlaceHolder()) ?>" value="<?php echo $used_cars->engine->EditValue ?>"<?php echo $used_cars->engine->EditAttributes() ?>>
</span>
<?php echo $used_cars->engine->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->colorID->Visible) { // colorID ?>
	<div id="r_colorID" class="form-group">
		<label id="elh_used_cars_colorID" for="x_colorID" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->colorID->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->colorID->CellAttributes() ?>>
<span id="el_used_cars_colorID">
<select data-table="used_cars" data-field="x_colorID" data-page="2" data-value-separator="<?php echo $used_cars->colorID->DisplayValueSeparatorAttribute() ?>" id="x_colorID" name="x_colorID"<?php echo $used_cars->colorID->EditAttributes() ?>>
<?php echo $used_cars->colorID->SelectOptionListHtml("x_colorID") ?>
</select>
</span>
<?php echo $used_cars->colorID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->bodyConditionID->Visible) { // bodyConditionID ?>
	<div id="r_bodyConditionID" class="form-group">
		<label id="elh_used_cars_bodyConditionID" for="x_bodyConditionID" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->bodyConditionID->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->bodyConditionID->CellAttributes() ?>>
<span id="el_used_cars_bodyConditionID">
<select data-table="used_cars" data-field="x_bodyConditionID" data-page="2" data-value-separator="<?php echo $used_cars->bodyConditionID->DisplayValueSeparatorAttribute() ?>" id="x_bodyConditionID" name="x_bodyConditionID"<?php echo $used_cars->bodyConditionID->EditAttributes() ?>>
<?php echo $used_cars->bodyConditionID->SelectOptionListHtml("x_bodyConditionID") ?>
</select>
</span>
<?php echo $used_cars->bodyConditionID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->summary->Visible) { // summary ?>
	<div id="r_summary" class="form-group">
		<label id="elh_used_cars_summary" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->summary->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->summary->CellAttributes() ?>>
<span id="el_used_cars_summary">
<?php ew_AppendClass($used_cars->summary->EditAttrs["class"], "editor"); ?>
<textarea data-table="used_cars" data-field="x_summary" data-page="2" name="x_summary" id="x_summary" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($used_cars->summary->getPlaceHolder()) ?>"<?php echo $used_cars->summary->EditAttributes() ?>><?php echo $used_cars->summary->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fused_carsadd", "x_summary", 35, 4, <?php echo ($used_cars->summary->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $used_cars->summary->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->term->Visible) { // term ?>
	<div id="r_term" class="form-group">
		<label id="elh_used_cars_term" for="x_term" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->term->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->term->CellAttributes() ?>>
<span id="el_used_cars_term">
<select data-table="used_cars" data-field="x_term" data-page="2" data-value-separator="<?php echo $used_cars->term->DisplayValueSeparatorAttribute() ?>" id="x_term" name="x_term"<?php echo $used_cars->term->EditAttributes() ?>>
<?php echo $used_cars->term->SelectOptionListHtml("x_term") ?>
</select>
</span>
<?php echo $used_cars->term->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $used_cars_add->MultiPages->PageStyle("3") ?>" id="tab_used_cars3"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($used_cars->_thumbnail->Visible) { // thumbnail ?>
	<div id="r__thumbnail" class="form-group">
		<label id="elh_used_cars__thumbnail" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->_thumbnail->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->_thumbnail->CellAttributes() ?>>
<span id="el_used_cars__thumbnail">
<div id="fd_x__thumbnail">
<span title="<?php echo $used_cars->_thumbnail->FldTitle() ? $used_cars->_thumbnail->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($used_cars->_thumbnail->ReadOnly || $used_cars->_thumbnail->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="used_cars" data-field="x__thumbnail" data-page="3" name="x__thumbnail" id="x__thumbnail"<?php echo $used_cars->_thumbnail->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x__thumbnail" id= "fn_x__thumbnail" value="<?php echo $used_cars->_thumbnail->Upload->FileName ?>">
<input type="hidden" name="fa_x__thumbnail" id= "fa_x__thumbnail" value="0">
<input type="hidden" name="fs_x__thumbnail" id= "fs_x__thumbnail" value="255">
<input type="hidden" name="fx_x__thumbnail" id= "fx_x__thumbnail" value="<?php echo $used_cars->_thumbnail->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x__thumbnail" id= "fm_x__thumbnail" value="<?php echo $used_cars->_thumbnail->UploadMaxFileSize ?>">
</div>
<table id="ft_x__thumbnail" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $used_cars->_thumbnail->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->img_01->Visible) { // img_01 ?>
	<div id="r_img_01" class="form-group">
		<label id="elh_used_cars_img_01" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->img_01->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->img_01->CellAttributes() ?>>
<span id="el_used_cars_img_01">
<div id="fd_x_img_01">
<span title="<?php echo $used_cars->img_01->FldTitle() ? $used_cars->img_01->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($used_cars->img_01->ReadOnly || $used_cars->img_01->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="used_cars" data-field="x_img_01" data-page="3" name="x_img_01" id="x_img_01"<?php echo $used_cars->img_01->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img_01" id= "fn_x_img_01" value="<?php echo $used_cars->img_01->Upload->FileName ?>">
<input type="hidden" name="fa_x_img_01" id= "fa_x_img_01" value="0">
<input type="hidden" name="fs_x_img_01" id= "fs_x_img_01" value="255">
<input type="hidden" name="fx_x_img_01" id= "fx_x_img_01" value="<?php echo $used_cars->img_01->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img_01" id= "fm_x_img_01" value="<?php echo $used_cars->img_01->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img_01" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $used_cars->img_01->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->img_02->Visible) { // img_02 ?>
	<div id="r_img_02" class="form-group">
		<label id="elh_used_cars_img_02" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->img_02->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->img_02->CellAttributes() ?>>
<span id="el_used_cars_img_02">
<div id="fd_x_img_02">
<span title="<?php echo $used_cars->img_02->FldTitle() ? $used_cars->img_02->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($used_cars->img_02->ReadOnly || $used_cars->img_02->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="used_cars" data-field="x_img_02" data-page="3" name="x_img_02" id="x_img_02"<?php echo $used_cars->img_02->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img_02" id= "fn_x_img_02" value="<?php echo $used_cars->img_02->Upload->FileName ?>">
<input type="hidden" name="fa_x_img_02" id= "fa_x_img_02" value="0">
<input type="hidden" name="fs_x_img_02" id= "fs_x_img_02" value="255">
<input type="hidden" name="fx_x_img_02" id= "fx_x_img_02" value="<?php echo $used_cars->img_02->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img_02" id= "fm_x_img_02" value="<?php echo $used_cars->img_02->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img_02" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $used_cars->img_02->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->img_03->Visible) { // img_03 ?>
	<div id="r_img_03" class="form-group">
		<label id="elh_used_cars_img_03" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->img_03->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->img_03->CellAttributes() ?>>
<span id="el_used_cars_img_03">
<div id="fd_x_img_03">
<span title="<?php echo $used_cars->img_03->FldTitle() ? $used_cars->img_03->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($used_cars->img_03->ReadOnly || $used_cars->img_03->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="used_cars" data-field="x_img_03" data-page="3" name="x_img_03" id="x_img_03"<?php echo $used_cars->img_03->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img_03" id= "fn_x_img_03" value="<?php echo $used_cars->img_03->Upload->FileName ?>">
<input type="hidden" name="fa_x_img_03" id= "fa_x_img_03" value="0">
<input type="hidden" name="fs_x_img_03" id= "fs_x_img_03" value="255">
<input type="hidden" name="fx_x_img_03" id= "fx_x_img_03" value="<?php echo $used_cars->img_03->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img_03" id= "fm_x_img_03" value="<?php echo $used_cars->img_03->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img_03" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $used_cars->img_03->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->img_04->Visible) { // img_04 ?>
	<div id="r_img_04" class="form-group">
		<label id="elh_used_cars_img_04" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->img_04->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->img_04->CellAttributes() ?>>
<span id="el_used_cars_img_04">
<div id="fd_x_img_04">
<span title="<?php echo $used_cars->img_04->FldTitle() ? $used_cars->img_04->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($used_cars->img_04->ReadOnly || $used_cars->img_04->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="used_cars" data-field="x_img_04" data-page="3" name="x_img_04" id="x_img_04"<?php echo $used_cars->img_04->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img_04" id= "fn_x_img_04" value="<?php echo $used_cars->img_04->Upload->FileName ?>">
<input type="hidden" name="fa_x_img_04" id= "fa_x_img_04" value="0">
<input type="hidden" name="fs_x_img_04" id= "fs_x_img_04" value="255">
<input type="hidden" name="fx_x_img_04" id= "fx_x_img_04" value="<?php echo $used_cars->img_04->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img_04" id= "fm_x_img_04" value="<?php echo $used_cars->img_04->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img_04" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $used_cars->img_04->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->img_05->Visible) { // img_05 ?>
	<div id="r_img_05" class="form-group">
		<label id="elh_used_cars_img_05" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->img_05->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->img_05->CellAttributes() ?>>
<span id="el_used_cars_img_05">
<div id="fd_x_img_05">
<span title="<?php echo $used_cars->img_05->FldTitle() ? $used_cars->img_05->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($used_cars->img_05->ReadOnly || $used_cars->img_05->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="used_cars" data-field="x_img_05" data-page="3" name="x_img_05" id="x_img_05"<?php echo $used_cars->img_05->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img_05" id= "fn_x_img_05" value="<?php echo $used_cars->img_05->Upload->FileName ?>">
<input type="hidden" name="fa_x_img_05" id= "fa_x_img_05" value="0">
<input type="hidden" name="fs_x_img_05" id= "fs_x_img_05" value="255">
<input type="hidden" name="fx_x_img_05" id= "fx_x_img_05" value="<?php echo $used_cars->img_05->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img_05" id= "fm_x_img_05" value="<?php echo $used_cars->img_05->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img_05" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $used_cars->img_05->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->img_06->Visible) { // img_06 ?>
	<div id="r_img_06" class="form-group">
		<label id="elh_used_cars_img_06" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->img_06->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->img_06->CellAttributes() ?>>
<span id="el_used_cars_img_06">
<div id="fd_x_img_06">
<span title="<?php echo $used_cars->img_06->FldTitle() ? $used_cars->img_06->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($used_cars->img_06->ReadOnly || $used_cars->img_06->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="used_cars" data-field="x_img_06" data-page="3" name="x_img_06" id="x_img_06"<?php echo $used_cars->img_06->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img_06" id= "fn_x_img_06" value="<?php echo $used_cars->img_06->Upload->FileName ?>">
<input type="hidden" name="fa_x_img_06" id= "fa_x_img_06" value="0">
<input type="hidden" name="fs_x_img_06" id= "fs_x_img_06" value="255">
<input type="hidden" name="fx_x_img_06" id= "fx_x_img_06" value="<?php echo $used_cars->img_06->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img_06" id= "fm_x_img_06" value="<?php echo $used_cars->img_06->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img_06" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $used_cars->img_06->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->img_07->Visible) { // img_07 ?>
	<div id="r_img_07" class="form-group">
		<label id="elh_used_cars_img_07" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->img_07->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->img_07->CellAttributes() ?>>
<span id="el_used_cars_img_07">
<div id="fd_x_img_07">
<span title="<?php echo $used_cars->img_07->FldTitle() ? $used_cars->img_07->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($used_cars->img_07->ReadOnly || $used_cars->img_07->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="used_cars" data-field="x_img_07" data-page="3" name="x_img_07" id="x_img_07"<?php echo $used_cars->img_07->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img_07" id= "fn_x_img_07" value="<?php echo $used_cars->img_07->Upload->FileName ?>">
<input type="hidden" name="fa_x_img_07" id= "fa_x_img_07" value="0">
<input type="hidden" name="fs_x_img_07" id= "fs_x_img_07" value="255">
<input type="hidden" name="fx_x_img_07" id= "fx_x_img_07" value="<?php echo $used_cars->img_07->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img_07" id= "fm_x_img_07" value="<?php echo $used_cars->img_07->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img_07" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $used_cars->img_07->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->img_08->Visible) { // img_08 ?>
	<div id="r_img_08" class="form-group">
		<label id="elh_used_cars_img_08" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->img_08->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->img_08->CellAttributes() ?>>
<span id="el_used_cars_img_08">
<div id="fd_x_img_08">
<span title="<?php echo $used_cars->img_08->FldTitle() ? $used_cars->img_08->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($used_cars->img_08->ReadOnly || $used_cars->img_08->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="used_cars" data-field="x_img_08" data-page="3" name="x_img_08" id="x_img_08"<?php echo $used_cars->img_08->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img_08" id= "fn_x_img_08" value="<?php echo $used_cars->img_08->Upload->FileName ?>">
<input type="hidden" name="fa_x_img_08" id= "fa_x_img_08" value="0">
<input type="hidden" name="fs_x_img_08" id= "fs_x_img_08" value="255">
<input type="hidden" name="fx_x_img_08" id= "fx_x_img_08" value="<?php echo $used_cars->img_08->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img_08" id= "fm_x_img_08" value="<?php echo $used_cars->img_08->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img_08" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $used_cars->img_08->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->img_09->Visible) { // img_09 ?>
	<div id="r_img_09" class="form-group">
		<label id="elh_used_cars_img_09" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->img_09->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->img_09->CellAttributes() ?>>
<span id="el_used_cars_img_09">
<div id="fd_x_img_09">
<span title="<?php echo $used_cars->img_09->FldTitle() ? $used_cars->img_09->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($used_cars->img_09->ReadOnly || $used_cars->img_09->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="used_cars" data-field="x_img_09" data-page="3" name="x_img_09" id="x_img_09"<?php echo $used_cars->img_09->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img_09" id= "fn_x_img_09" value="<?php echo $used_cars->img_09->Upload->FileName ?>">
<input type="hidden" name="fa_x_img_09" id= "fa_x_img_09" value="0">
<input type="hidden" name="fs_x_img_09" id= "fs_x_img_09" value="255">
<input type="hidden" name="fx_x_img_09" id= "fx_x_img_09" value="<?php echo $used_cars->img_09->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img_09" id= "fm_x_img_09" value="<?php echo $used_cars->img_09->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img_09" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $used_cars->img_09->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->img_10->Visible) { // img_10 ?>
	<div id="r_img_10" class="form-group">
		<label id="elh_used_cars_img_10" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->img_10->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->img_10->CellAttributes() ?>>
<span id="el_used_cars_img_10">
<div id="fd_x_img_10">
<span title="<?php echo $used_cars->img_10->FldTitle() ? $used_cars->img_10->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($used_cars->img_10->ReadOnly || $used_cars->img_10->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="used_cars" data-field="x_img_10" data-page="3" name="x_img_10" id="x_img_10"<?php echo $used_cars->img_10->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img_10" id= "fn_x_img_10" value="<?php echo $used_cars->img_10->Upload->FileName ?>">
<input type="hidden" name="fa_x_img_10" id= "fa_x_img_10" value="0">
<input type="hidden" name="fs_x_img_10" id= "fs_x_img_10" value="255">
<input type="hidden" name="fx_x_img_10" id= "fx_x_img_10" value="<?php echo $used_cars->img_10->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img_10" id= "fm_x_img_10" value="<?php echo $used_cars->img_10->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img_10" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $used_cars->img_10->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->img_11->Visible) { // img_11 ?>
	<div id="r_img_11" class="form-group">
		<label id="elh_used_cars_img_11" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->img_11->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->img_11->CellAttributes() ?>>
<span id="el_used_cars_img_11">
<div id="fd_x_img_11">
<span title="<?php echo $used_cars->img_11->FldTitle() ? $used_cars->img_11->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($used_cars->img_11->ReadOnly || $used_cars->img_11->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="used_cars" data-field="x_img_11" data-page="3" name="x_img_11" id="x_img_11"<?php echo $used_cars->img_11->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img_11" id= "fn_x_img_11" value="<?php echo $used_cars->img_11->Upload->FileName ?>">
<input type="hidden" name="fa_x_img_11" id= "fa_x_img_11" value="0">
<input type="hidden" name="fs_x_img_11" id= "fs_x_img_11" value="255">
<input type="hidden" name="fx_x_img_11" id= "fx_x_img_11" value="<?php echo $used_cars->img_11->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img_11" id= "fm_x_img_11" value="<?php echo $used_cars->img_11->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img_11" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $used_cars->img_11->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($used_cars->img_12->Visible) { // img_12 ?>
	<div id="r_img_12" class="form-group">
		<label id="elh_used_cars_img_12" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->img_12->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->img_12->CellAttributes() ?>>
<span id="el_used_cars_img_12">
<div id="fd_x_img_12">
<span title="<?php echo $used_cars->img_12->FldTitle() ? $used_cars->img_12->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($used_cars->img_12->ReadOnly || $used_cars->img_12->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="used_cars" data-field="x_img_12" data-page="3" name="x_img_12" id="x_img_12"<?php echo $used_cars->img_12->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img_12" id= "fn_x_img_12" value="<?php echo $used_cars->img_12->Upload->FileName ?>">
<input type="hidden" name="fa_x_img_12" id= "fa_x_img_12" value="0">
<input type="hidden" name="fs_x_img_12" id= "fs_x_img_12" value="255">
<input type="hidden" name="fx_x_img_12" id= "fx_x_img_12" value="<?php echo $used_cars->img_12->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img_12" id= "fm_x_img_12" value="<?php echo $used_cars->img_12->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img_12" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $used_cars->img_12->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $used_cars_add->MultiPages->PageStyle("4") ?>" id="tab_used_cars4"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($used_cars->extra_features->Visible) { // extra_features ?>
	<div id="r_extra_features" class="form-group">
		<label id="elh_used_cars_extra_features" class="<?php echo $used_cars_add->LeftColumnClass ?>"><?php echo $used_cars->extra_features->FldCaption() ?></label>
		<div class="<?php echo $used_cars_add->RightColumnClass ?>"><div<?php echo $used_cars->extra_features->CellAttributes() ?>>
<span id="el_used_cars_extra_features">
<div id="tp_x_extra_features" class="ewTemplate"><input type="checkbox" data-table="used_cars" data-field="x_extra_features" data-page="4" data-value-separator="<?php echo $used_cars->extra_features->DisplayValueSeparatorAttribute() ?>" name="x_extra_features[]" id="x_extra_features[]" value="{value}"<?php echo $used_cars->extra_features->EditAttributes() ?>></div>
<div id="dsl_x_extra_features" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $used_cars->extra_features->CheckBoxListHtml(FALSE, "x_extra_features[]", 4) ?>
</div></div>
</span>
<?php echo $used_cars->extra_features->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page .nav-tabs-custom .tab-content -->
</div><!-- /multi-page .nav-tabs-custom -->
</div><!-- /multi-page -->
<?php if (!$used_cars_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $used_cars_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $used_cars_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fused_carsadd.Init();
</script>
<?php
$used_cars_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$used_cars_add->Page_Terminate();
?>
