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

$rent_lease_cars_add = NULL; // Initialize page object first

class crent_lease_cars_add extends crent_lease_cars {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'rent_lease_cars';

	// Page object name
	var $PageObjName = 'rent_lease_cars_add';

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

		// Table object (rent_lease_cars)
		if (!isset($GLOBALS["rent_lease_cars"]) || get_class($GLOBALS["rent_lease_cars"]) == "crent_lease_cars") {
			$GLOBALS["rent_lease_cars"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["rent_lease_cars"];
		}

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("rent_lease_carslist.php"));
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
			if (@$_GET["rentLeaseCarID"] != "") {
				$this->rentLeaseCarID->setQueryStringValue($_GET["rentLeaseCarID"]);
				$this->setKey("rentLeaseCarID", $this->rentLeaseCarID->CurrentValue); // Set up key
			} else {
				$this->setKey("rentLeaseCarID", ""); // Clear key
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
					$this->Page_Terminate("rent_lease_carslist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "rent_lease_carslist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "rent_lease_carsview.php")
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
		$this->rentLeaseCarID->CurrentValue = NULL;
		$this->rentLeaseCarID->OldValue = $this->rentLeaseCarID->CurrentValue;
		$this->bodyTypeID->CurrentValue = NULL;
		$this->bodyTypeID->OldValue = $this->bodyTypeID->CurrentValue;
		$this->carTitle->CurrentValue = NULL;
		$this->carTitle->OldValue = $this->carTitle->CurrentValue;
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
		$this->deliveryAED->CurrentValue = NULL;
		$this->deliveryAED->OldValue = $this->deliveryAED->CurrentValue;
		$this->dailyAED->CurrentValue = NULL;
		$this->dailyAED->OldValue = $this->dailyAED->CurrentValue;
		$this->dailyDummyAED->CurrentValue = NULL;
		$this->dailyDummyAED->OldValue = $this->dailyDummyAED->CurrentValue;
		$this->weeklyAED->CurrentValue = NULL;
		$this->weeklyAED->OldValue = $this->weeklyAED->CurrentValue;
		$this->weeklyDummyAED->CurrentValue = NULL;
		$this->weeklyDummyAED->OldValue = $this->weeklyDummyAED->CurrentValue;
		$this->monthlyAED->CurrentValue = NULL;
		$this->monthlyAED->OldValue = $this->monthlyAED->CurrentValue;
		$this->monthlyDummyAED->CurrentValue = NULL;
		$this->monthlyDummyAED->OldValue = $this->monthlyDummyAED->CurrentValue;
		$this->scdwDailyAED->CurrentValue = NULL;
		$this->scdwDailyAED->OldValue = $this->scdwDailyAED->CurrentValue;
		$this->scdwWeeklyAED->CurrentValue = NULL;
		$this->scdwWeeklyAED->OldValue = $this->scdwWeeklyAED->CurrentValue;
		$this->scdwMonthlyAED->CurrentValue = NULL;
		$this->scdwMonthlyAED->OldValue = $this->scdwMonthlyAED->CurrentValue;
		$this->cdwDailyAED->CurrentValue = NULL;
		$this->cdwDailyAED->OldValue = $this->cdwDailyAED->CurrentValue;
		$this->cdwWeeklyAED->CurrentValue = NULL;
		$this->cdwWeeklyAED->OldValue = $this->cdwWeeklyAED->CurrentValue;
		$this->cdwMonthlyAED->CurrentValue = NULL;
		$this->cdwMonthlyAED->OldValue = $this->cdwMonthlyAED->CurrentValue;
		$this->paiDailyAED->CurrentValue = NULL;
		$this->paiDailyAED->OldValue = $this->paiDailyAED->CurrentValue;
		$this->paiWeeklyAED->CurrentValue = NULL;
		$this->paiWeeklyAED->OldValue = $this->paiWeeklyAED->CurrentValue;
		$this->paiMonthlyAED->CurrentValue = NULL;
		$this->paiMonthlyAED->OldValue = $this->paiMonthlyAED->CurrentValue;
		$this->gpsDailyAED->CurrentValue = NULL;
		$this->gpsDailyAED->OldValue = $this->gpsDailyAED->CurrentValue;
		$this->gpsWeeklyAED->CurrentValue = NULL;
		$this->gpsWeeklyAED->OldValue = $this->gpsWeeklyAED->CurrentValue;
		$this->gpsMonthlyAED->CurrentValue = NULL;
		$this->gpsMonthlyAED->OldValue = $this->gpsMonthlyAED->CurrentValue;
		$this->additionalDriverDailyAED->CurrentValue = NULL;
		$this->additionalDriverDailyAED->OldValue = $this->additionalDriverDailyAED->CurrentValue;
		$this->additionalDriverWeeklyAED->CurrentValue = NULL;
		$this->additionalDriverWeeklyAED->OldValue = $this->additionalDriverWeeklyAED->CurrentValue;
		$this->additionalDriverMonthlyAED->CurrentValue = NULL;
		$this->additionalDriverMonthlyAED->OldValue = $this->additionalDriverMonthlyAED->CurrentValue;
		$this->babySafetySeatDailyAED->CurrentValue = NULL;
		$this->babySafetySeatDailyAED->OldValue = $this->babySafetySeatDailyAED->CurrentValue;
		$this->babySafetySeatWeeklyAED->CurrentValue = NULL;
		$this->babySafetySeatWeeklyAED->OldValue = $this->babySafetySeatWeeklyAED->CurrentValue;
		$this->babySafetySeatMonthlyAED->CurrentValue = NULL;
		$this->babySafetySeatMonthlyAED->OldValue = $this->babySafetySeatMonthlyAED->CurrentValue;
		$this->addBabySafetySeatDailyAED->CurrentValue = NULL;
		$this->addBabySafetySeatDailyAED->OldValue = $this->addBabySafetySeatDailyAED->CurrentValue;
		$this->addBabySafetySeatWeeklyAED->CurrentValue = NULL;
		$this->addBabySafetySeatWeeklyAED->OldValue = $this->addBabySafetySeatWeeklyAED->CurrentValue;
		$this->addBabySafetySeatMonthlyAED->CurrentValue = NULL;
		$this->addBabySafetySeatMonthlyAED->OldValue = $this->addBabySafetySeatMonthlyAED->CurrentValue;
		$this->active->CurrentValue = 1;
		$this->phase1OrangeCard->CurrentValue = NULL;
		$this->phase1OrangeCard->OldValue = $this->phase1OrangeCard->CurrentValue;
		$this->phase1GPS->CurrentValue = NULL;
		$this->phase1GPS->OldValue = $this->phase1GPS->CurrentValue;
		$this->phase1DeliveryCharges->CurrentValue = NULL;
		$this->phase1DeliveryCharges->OldValue = $this->phase1DeliveryCharges->CurrentValue;
		$this->phase1CollectionCharges->CurrentValue = NULL;
		$this->phase1CollectionCharges->OldValue = $this->phase1CollectionCharges->CurrentValue;
		$this->weeklyDeals->CurrentValue = 0;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->bodyTypeID->FldIsDetailKey) {
			$this->bodyTypeID->setFormValue($objForm->GetValue("x_bodyTypeID"));
		}
		if (!$this->carTitle->FldIsDetailKey) {
			$this->carTitle->setFormValue($objForm->GetValue("x_carTitle"));
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
		if (!$this->deliveryAED->FldIsDetailKey) {
			$this->deliveryAED->setFormValue($objForm->GetValue("x_deliveryAED"));
		}
		if (!$this->dailyAED->FldIsDetailKey) {
			$this->dailyAED->setFormValue($objForm->GetValue("x_dailyAED"));
		}
		if (!$this->dailyDummyAED->FldIsDetailKey) {
			$this->dailyDummyAED->setFormValue($objForm->GetValue("x_dailyDummyAED"));
		}
		if (!$this->weeklyAED->FldIsDetailKey) {
			$this->weeklyAED->setFormValue($objForm->GetValue("x_weeklyAED"));
		}
		if (!$this->weeklyDummyAED->FldIsDetailKey) {
			$this->weeklyDummyAED->setFormValue($objForm->GetValue("x_weeklyDummyAED"));
		}
		if (!$this->monthlyAED->FldIsDetailKey) {
			$this->monthlyAED->setFormValue($objForm->GetValue("x_monthlyAED"));
		}
		if (!$this->monthlyDummyAED->FldIsDetailKey) {
			$this->monthlyDummyAED->setFormValue($objForm->GetValue("x_monthlyDummyAED"));
		}
		if (!$this->active->FldIsDetailKey) {
			$this->active->setFormValue($objForm->GetValue("x_active"));
		}
		if (!$this->phase1OrangeCard->FldIsDetailKey) {
			$this->phase1OrangeCard->setFormValue($objForm->GetValue("x_phase1OrangeCard"));
		}
		if (!$this->phase1GPS->FldIsDetailKey) {
			$this->phase1GPS->setFormValue($objForm->GetValue("x_phase1GPS"));
		}
		if (!$this->phase1DeliveryCharges->FldIsDetailKey) {
			$this->phase1DeliveryCharges->setFormValue($objForm->GetValue("x_phase1DeliveryCharges"));
		}
		if (!$this->phase1CollectionCharges->FldIsDetailKey) {
			$this->phase1CollectionCharges->setFormValue($objForm->GetValue("x_phase1CollectionCharges"));
		}
		if (!$this->weeklyDeals->FldIsDetailKey) {
			$this->weeklyDeals->setFormValue($objForm->GetValue("x_weeklyDeals"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->bodyTypeID->CurrentValue = $this->bodyTypeID->FormValue;
		$this->carTitle->CurrentValue = $this->carTitle->FormValue;
		$this->slug->CurrentValue = $this->slug->FormValue;
		$this->extraFeatures->CurrentValue = $this->extraFeatures->FormValue;
		$this->noOfSeats->CurrentValue = $this->noOfSeats->FormValue;
		$this->luggage->CurrentValue = $this->luggage->FormValue;
		$this->transmissionID->CurrentValue = $this->transmissionID->FormValue;
		$this->ac->CurrentValue = $this->ac->FormValue;
		$this->noOfDoors->CurrentValue = $this->noOfDoors->FormValue;
		$this->deliveryAED->CurrentValue = $this->deliveryAED->FormValue;
		$this->dailyAED->CurrentValue = $this->dailyAED->FormValue;
		$this->dailyDummyAED->CurrentValue = $this->dailyDummyAED->FormValue;
		$this->weeklyAED->CurrentValue = $this->weeklyAED->FormValue;
		$this->weeklyDummyAED->CurrentValue = $this->weeklyDummyAED->FormValue;
		$this->monthlyAED->CurrentValue = $this->monthlyAED->FormValue;
		$this->monthlyDummyAED->CurrentValue = $this->monthlyDummyAED->FormValue;
		$this->active->CurrentValue = $this->active->FormValue;
		$this->phase1OrangeCard->CurrentValue = $this->phase1OrangeCard->FormValue;
		$this->phase1GPS->CurrentValue = $this->phase1GPS->FormValue;
		$this->phase1DeliveryCharges->CurrentValue = $this->phase1DeliveryCharges->FormValue;
		$this->phase1CollectionCharges->CurrentValue = $this->phase1CollectionCharges->FormValue;
		$this->weeklyDeals->CurrentValue = $this->weeklyDeals->FormValue;
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
		$this->LoadDefaultValues();
		$row = array();
		$row['rentLeaseCarID'] = $this->rentLeaseCarID->CurrentValue;
		$row['bodyTypeID'] = $this->bodyTypeID->CurrentValue;
		$row['carTitle'] = $this->carTitle->CurrentValue;
		$row['slug'] = $this->slug->CurrentValue;
		$row['image'] = $this->image->Upload->DbValue;
		$row['extraFeatures'] = $this->extraFeatures->CurrentValue;
		$row['noOfSeats'] = $this->noOfSeats->CurrentValue;
		$row['luggage'] = $this->luggage->CurrentValue;
		$row['transmissionID'] = $this->transmissionID->CurrentValue;
		$row['ac'] = $this->ac->CurrentValue;
		$row['noOfDoors'] = $this->noOfDoors->CurrentValue;
		$row['deliveryAED'] = $this->deliveryAED->CurrentValue;
		$row['dailyAED'] = $this->dailyAED->CurrentValue;
		$row['dailyDummyAED'] = $this->dailyDummyAED->CurrentValue;
		$row['weeklyAED'] = $this->weeklyAED->CurrentValue;
		$row['weeklyDummyAED'] = $this->weeklyDummyAED->CurrentValue;
		$row['monthlyAED'] = $this->monthlyAED->CurrentValue;
		$row['monthlyDummyAED'] = $this->monthlyDummyAED->CurrentValue;
		$row['scdwDailyAED'] = $this->scdwDailyAED->CurrentValue;
		$row['scdwWeeklyAED'] = $this->scdwWeeklyAED->CurrentValue;
		$row['scdwMonthlyAED'] = $this->scdwMonthlyAED->CurrentValue;
		$row['cdwDailyAED'] = $this->cdwDailyAED->CurrentValue;
		$row['cdwWeeklyAED'] = $this->cdwWeeklyAED->CurrentValue;
		$row['cdwMonthlyAED'] = $this->cdwMonthlyAED->CurrentValue;
		$row['paiDailyAED'] = $this->paiDailyAED->CurrentValue;
		$row['paiWeeklyAED'] = $this->paiWeeklyAED->CurrentValue;
		$row['paiMonthlyAED'] = $this->paiMonthlyAED->CurrentValue;
		$row['gpsDailyAED'] = $this->gpsDailyAED->CurrentValue;
		$row['gpsWeeklyAED'] = $this->gpsWeeklyAED->CurrentValue;
		$row['gpsMonthlyAED'] = $this->gpsMonthlyAED->CurrentValue;
		$row['additionalDriverDailyAED'] = $this->additionalDriverDailyAED->CurrentValue;
		$row['additionalDriverWeeklyAED'] = $this->additionalDriverWeeklyAED->CurrentValue;
		$row['additionalDriverMonthlyAED'] = $this->additionalDriverMonthlyAED->CurrentValue;
		$row['babySafetySeatDailyAED'] = $this->babySafetySeatDailyAED->CurrentValue;
		$row['babySafetySeatWeeklyAED'] = $this->babySafetySeatWeeklyAED->CurrentValue;
		$row['babySafetySeatMonthlyAED'] = $this->babySafetySeatMonthlyAED->CurrentValue;
		$row['addBabySafetySeatDailyAED'] = $this->addBabySafetySeatDailyAED->CurrentValue;
		$row['addBabySafetySeatWeeklyAED'] = $this->addBabySafetySeatWeeklyAED->CurrentValue;
		$row['addBabySafetySeatMonthlyAED'] = $this->addBabySafetySeatMonthlyAED->CurrentValue;
		$row['active'] = $this->active->CurrentValue;
		$row['phase1OrangeCard'] = $this->phase1OrangeCard->CurrentValue;
		$row['phase1GPS'] = $this->phase1GPS->CurrentValue;
		$row['phase1DeliveryCharges'] = $this->phase1DeliveryCharges->CurrentValue;
		$row['phase1CollectionCharges'] = $this->phase1CollectionCharges->CurrentValue;
		$row['weeklyDeals'] = $this->weeklyDeals->CurrentValue;
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

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("rentLeaseCarID")) <> "")
			$this->rentLeaseCarID->CurrentValue = $this->getKey("rentLeaseCarID"); // rentLeaseCarID
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
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

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

			// carTitle
			$this->carTitle->EditAttrs["class"] = "form-control";
			$this->carTitle->EditCustomAttributes = "";
			$this->carTitle->EditValue = ew_HtmlEncode($this->carTitle->CurrentValue);
			$this->carTitle->PlaceHolder = ew_RemoveHtml($this->carTitle->FldCaption());

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

			// deliveryAED
			$this->deliveryAED->EditAttrs["class"] = "form-control";
			$this->deliveryAED->EditCustomAttributes = "";
			$this->deliveryAED->EditValue = ew_HtmlEncode($this->deliveryAED->CurrentValue);
			$this->deliveryAED->PlaceHolder = ew_RemoveHtml($this->deliveryAED->FldCaption());
			if (strval($this->deliveryAED->EditValue) <> "" && is_numeric($this->deliveryAED->EditValue)) $this->deliveryAED->EditValue = ew_FormatNumber($this->deliveryAED->EditValue, -2, -1, -2, 0);

			// dailyAED
			$this->dailyAED->EditAttrs["class"] = "form-control";
			$this->dailyAED->EditCustomAttributes = "";
			$this->dailyAED->EditValue = ew_HtmlEncode($this->dailyAED->CurrentValue);
			$this->dailyAED->PlaceHolder = ew_RemoveHtml($this->dailyAED->FldCaption());
			if (strval($this->dailyAED->EditValue) <> "" && is_numeric($this->dailyAED->EditValue)) $this->dailyAED->EditValue = ew_FormatNumber($this->dailyAED->EditValue, -2, -1, -2, 0);

			// dailyDummyAED
			$this->dailyDummyAED->EditAttrs["class"] = "form-control";
			$this->dailyDummyAED->EditCustomAttributes = "";
			$this->dailyDummyAED->EditValue = ew_HtmlEncode($this->dailyDummyAED->CurrentValue);
			$this->dailyDummyAED->PlaceHolder = ew_RemoveHtml($this->dailyDummyAED->FldCaption());
			if (strval($this->dailyDummyAED->EditValue) <> "" && is_numeric($this->dailyDummyAED->EditValue)) $this->dailyDummyAED->EditValue = ew_FormatNumber($this->dailyDummyAED->EditValue, -2, -1, -2, 0);

			// weeklyAED
			$this->weeklyAED->EditAttrs["class"] = "form-control";
			$this->weeklyAED->EditCustomAttributes = "";
			$this->weeklyAED->EditValue = ew_HtmlEncode($this->weeklyAED->CurrentValue);
			$this->weeklyAED->PlaceHolder = ew_RemoveHtml($this->weeklyAED->FldCaption());
			if (strval($this->weeklyAED->EditValue) <> "" && is_numeric($this->weeklyAED->EditValue)) $this->weeklyAED->EditValue = ew_FormatNumber($this->weeklyAED->EditValue, -2, -1, -2, 0);

			// weeklyDummyAED
			$this->weeklyDummyAED->EditAttrs["class"] = "form-control";
			$this->weeklyDummyAED->EditCustomAttributes = "";
			$this->weeklyDummyAED->EditValue = ew_HtmlEncode($this->weeklyDummyAED->CurrentValue);
			$this->weeklyDummyAED->PlaceHolder = ew_RemoveHtml($this->weeklyDummyAED->FldCaption());
			if (strval($this->weeklyDummyAED->EditValue) <> "" && is_numeric($this->weeklyDummyAED->EditValue)) $this->weeklyDummyAED->EditValue = ew_FormatNumber($this->weeklyDummyAED->EditValue, -2, -1, -2, 0);

			// monthlyAED
			$this->monthlyAED->EditAttrs["class"] = "form-control";
			$this->monthlyAED->EditCustomAttributes = "";
			$this->monthlyAED->EditValue = ew_HtmlEncode($this->monthlyAED->CurrentValue);
			$this->monthlyAED->PlaceHolder = ew_RemoveHtml($this->monthlyAED->FldCaption());
			if (strval($this->monthlyAED->EditValue) <> "" && is_numeric($this->monthlyAED->EditValue)) $this->monthlyAED->EditValue = ew_FormatNumber($this->monthlyAED->EditValue, -2, -1, -2, 0);

			// monthlyDummyAED
			$this->monthlyDummyAED->EditAttrs["class"] = "form-control";
			$this->monthlyDummyAED->EditCustomAttributes = "";
			$this->monthlyDummyAED->EditValue = ew_HtmlEncode($this->monthlyDummyAED->CurrentValue);
			$this->monthlyDummyAED->PlaceHolder = ew_RemoveHtml($this->monthlyDummyAED->FldCaption());
			if (strval($this->monthlyDummyAED->EditValue) <> "" && is_numeric($this->monthlyDummyAED->EditValue)) $this->monthlyDummyAED->EditValue = ew_FormatNumber($this->monthlyDummyAED->EditValue, -2, -1, -2, 0);

			// active
			$this->active->EditAttrs["class"] = "form-control";
			$this->active->EditCustomAttributes = "";
			$this->active->EditValue = $this->active->Options(TRUE);

			// phase1OrangeCard
			$this->phase1OrangeCard->EditAttrs["class"] = "form-control";
			$this->phase1OrangeCard->EditCustomAttributes = "";
			$this->phase1OrangeCard->EditValue = ew_HtmlEncode($this->phase1OrangeCard->CurrentValue);
			$this->phase1OrangeCard->PlaceHolder = ew_RemoveHtml($this->phase1OrangeCard->FldCaption());
			if (strval($this->phase1OrangeCard->EditValue) <> "" && is_numeric($this->phase1OrangeCard->EditValue)) $this->phase1OrangeCard->EditValue = ew_FormatNumber($this->phase1OrangeCard->EditValue, -2, -1, -2, 0);

			// phase1GPS
			$this->phase1GPS->EditAttrs["class"] = "form-control";
			$this->phase1GPS->EditCustomAttributes = "";
			$this->phase1GPS->EditValue = ew_HtmlEncode($this->phase1GPS->CurrentValue);
			$this->phase1GPS->PlaceHolder = ew_RemoveHtml($this->phase1GPS->FldCaption());
			if (strval($this->phase1GPS->EditValue) <> "" && is_numeric($this->phase1GPS->EditValue)) $this->phase1GPS->EditValue = ew_FormatNumber($this->phase1GPS->EditValue, -2, -1, -2, 0);

			// phase1DeliveryCharges
			$this->phase1DeliveryCharges->EditAttrs["class"] = "form-control";
			$this->phase1DeliveryCharges->EditCustomAttributes = "";
			$this->phase1DeliveryCharges->EditValue = ew_HtmlEncode($this->phase1DeliveryCharges->CurrentValue);
			$this->phase1DeliveryCharges->PlaceHolder = ew_RemoveHtml($this->phase1DeliveryCharges->FldCaption());
			if (strval($this->phase1DeliveryCharges->EditValue) <> "" && is_numeric($this->phase1DeliveryCharges->EditValue)) $this->phase1DeliveryCharges->EditValue = ew_FormatNumber($this->phase1DeliveryCharges->EditValue, -2, -1, -2, 0);

			// phase1CollectionCharges
			$this->phase1CollectionCharges->EditAttrs["class"] = "form-control";
			$this->phase1CollectionCharges->EditCustomAttributes = "";
			$this->phase1CollectionCharges->EditValue = ew_HtmlEncode($this->phase1CollectionCharges->CurrentValue);
			$this->phase1CollectionCharges->PlaceHolder = ew_RemoveHtml($this->phase1CollectionCharges->FldCaption());
			if (strval($this->phase1CollectionCharges->EditValue) <> "" && is_numeric($this->phase1CollectionCharges->EditValue)) $this->phase1CollectionCharges->EditValue = ew_FormatNumber($this->phase1CollectionCharges->EditValue, -2, -1, -2, 0);

			// weeklyDeals
			$this->weeklyDeals->EditAttrs["class"] = "form-control";
			$this->weeklyDeals->EditCustomAttributes = "";
			$this->weeklyDeals->EditValue = $this->weeklyDeals->Options(TRUE);

			// Add refer script
			// bodyTypeID

			$this->bodyTypeID->LinkCustomAttributes = "";
			$this->bodyTypeID->HrefValue = "";

			// carTitle
			$this->carTitle->LinkCustomAttributes = "";
			$this->carTitle->HrefValue = "";

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

			// deliveryAED
			$this->deliveryAED->LinkCustomAttributes = "";
			$this->deliveryAED->HrefValue = "";

			// dailyAED
			$this->dailyAED->LinkCustomAttributes = "";
			$this->dailyAED->HrefValue = "";

			// dailyDummyAED
			$this->dailyDummyAED->LinkCustomAttributes = "";
			$this->dailyDummyAED->HrefValue = "";

			// weeklyAED
			$this->weeklyAED->LinkCustomAttributes = "";
			$this->weeklyAED->HrefValue = "";

			// weeklyDummyAED
			$this->weeklyDummyAED->LinkCustomAttributes = "";
			$this->weeklyDummyAED->HrefValue = "";

			// monthlyAED
			$this->monthlyAED->LinkCustomAttributes = "";
			$this->monthlyAED->HrefValue = "";

			// monthlyDummyAED
			$this->monthlyDummyAED->LinkCustomAttributes = "";
			$this->monthlyDummyAED->HrefValue = "";

			// active
			$this->active->LinkCustomAttributes = "";
			$this->active->HrefValue = "";

			// phase1OrangeCard
			$this->phase1OrangeCard->LinkCustomAttributes = "";
			$this->phase1OrangeCard->HrefValue = "";

			// phase1GPS
			$this->phase1GPS->LinkCustomAttributes = "";
			$this->phase1GPS->HrefValue = "";

			// phase1DeliveryCharges
			$this->phase1DeliveryCharges->LinkCustomAttributes = "";
			$this->phase1DeliveryCharges->HrefValue = "";

			// phase1CollectionCharges
			$this->phase1CollectionCharges->LinkCustomAttributes = "";
			$this->phase1CollectionCharges->HrefValue = "";

			// weeklyDeals
			$this->weeklyDeals->LinkCustomAttributes = "";
			$this->weeklyDeals->HrefValue = "";
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
		if (!ew_CheckNumber($this->deliveryAED->FormValue)) {
			ew_AddMessage($gsFormError, $this->deliveryAED->FldErrMsg());
		}
		if (!ew_CheckNumber($this->dailyAED->FormValue)) {
			ew_AddMessage($gsFormError, $this->dailyAED->FldErrMsg());
		}
		if (!ew_CheckNumber($this->dailyDummyAED->FormValue)) {
			ew_AddMessage($gsFormError, $this->dailyDummyAED->FldErrMsg());
		}
		if (!ew_CheckNumber($this->weeklyAED->FormValue)) {
			ew_AddMessage($gsFormError, $this->weeklyAED->FldErrMsg());
		}
		if (!ew_CheckNumber($this->weeklyDummyAED->FormValue)) {
			ew_AddMessage($gsFormError, $this->weeklyDummyAED->FldErrMsg());
		}
		if (!ew_CheckNumber($this->monthlyAED->FormValue)) {
			ew_AddMessage($gsFormError, $this->monthlyAED->FldErrMsg());
		}
		if (!ew_CheckNumber($this->monthlyDummyAED->FormValue)) {
			ew_AddMessage($gsFormError, $this->monthlyDummyAED->FldErrMsg());
		}
		if (!ew_CheckNumber($this->phase1OrangeCard->FormValue)) {
			ew_AddMessage($gsFormError, $this->phase1OrangeCard->FldErrMsg());
		}
		if (!ew_CheckNumber($this->phase1GPS->FormValue)) {
			ew_AddMessage($gsFormError, $this->phase1GPS->FldErrMsg());
		}
		if (!ew_CheckNumber($this->phase1DeliveryCharges->FormValue)) {
			ew_AddMessage($gsFormError, $this->phase1DeliveryCharges->FldErrMsg());
		}
		if (!ew_CheckNumber($this->phase1CollectionCharges->FormValue)) {
			ew_AddMessage($gsFormError, $this->phase1CollectionCharges->FldErrMsg());
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

		// bodyTypeID
		$this->bodyTypeID->SetDbValueDef($rsnew, $this->bodyTypeID->CurrentValue, NULL, FALSE);

		// carTitle
		$this->carTitle->SetDbValueDef($rsnew, $this->carTitle->CurrentValue, NULL, FALSE);

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

		// deliveryAED
		$this->deliveryAED->SetDbValueDef($rsnew, $this->deliveryAED->CurrentValue, NULL, FALSE);

		// dailyAED
		$this->dailyAED->SetDbValueDef($rsnew, $this->dailyAED->CurrentValue, NULL, FALSE);

		// dailyDummyAED
		$this->dailyDummyAED->SetDbValueDef($rsnew, $this->dailyDummyAED->CurrentValue, NULL, FALSE);

		// weeklyAED
		$this->weeklyAED->SetDbValueDef($rsnew, $this->weeklyAED->CurrentValue, NULL, FALSE);

		// weeklyDummyAED
		$this->weeklyDummyAED->SetDbValueDef($rsnew, $this->weeklyDummyAED->CurrentValue, NULL, FALSE);

		// monthlyAED
		$this->monthlyAED->SetDbValueDef($rsnew, $this->monthlyAED->CurrentValue, NULL, FALSE);

		// monthlyDummyAED
		$this->monthlyDummyAED->SetDbValueDef($rsnew, $this->monthlyDummyAED->CurrentValue, NULL, FALSE);

		// active
		$this->active->SetDbValueDef($rsnew, $this->active->CurrentValue, NULL, strval($this->active->CurrentValue) == "");

		// phase1OrangeCard
		$this->phase1OrangeCard->SetDbValueDef($rsnew, $this->phase1OrangeCard->CurrentValue, NULL, FALSE);

		// phase1GPS
		$this->phase1GPS->SetDbValueDef($rsnew, $this->phase1GPS->CurrentValue, NULL, FALSE);

		// phase1DeliveryCharges
		$this->phase1DeliveryCharges->SetDbValueDef($rsnew, $this->phase1DeliveryCharges->CurrentValue, NULL, FALSE);

		// phase1CollectionCharges
		$this->phase1CollectionCharges->SetDbValueDef($rsnew, $this->phase1CollectionCharges->CurrentValue, NULL, FALSE);

		// weeklyDeals
		$this->weeklyDeals->SetDbValueDef($rsnew, $this->weeklyDeals->CurrentValue, NULL, strval($this->weeklyDeals->CurrentValue) == "");
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("rent_lease_carslist.php"), "", $this->TableVar, TRUE);
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
		$pages->Add(5);
		$this->MultiPages = $pages;
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
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
if (!isset($rent_lease_cars_add)) $rent_lease_cars_add = new crent_lease_cars_add();

// Page init
$rent_lease_cars_add->Page_Init();

// Page main
$rent_lease_cars_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rent_lease_cars_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = frent_lease_carsadd = new ew_Form("frent_lease_carsadd", "add");

// Validate form
frent_lease_carsadd.Validate = function() {
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
				return this.OnError(elm, "<?php echo ew_JsEncode2($rent_lease_cars->noOfSeats->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_luggage");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rent_lease_cars->luggage->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_noOfDoors");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rent_lease_cars->noOfDoors->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_deliveryAED");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rent_lease_cars->deliveryAED->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_dailyAED");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rent_lease_cars->dailyAED->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_dailyDummyAED");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rent_lease_cars->dailyDummyAED->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_weeklyAED");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rent_lease_cars->weeklyAED->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_weeklyDummyAED");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rent_lease_cars->weeklyDummyAED->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_monthlyAED");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rent_lease_cars->monthlyAED->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_monthlyDummyAED");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rent_lease_cars->monthlyDummyAED->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_phase1OrangeCard");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rent_lease_cars->phase1OrangeCard->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_phase1GPS");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rent_lease_cars->phase1GPS->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_phase1DeliveryCharges");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rent_lease_cars->phase1DeliveryCharges->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_phase1CollectionCharges");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rent_lease_cars->phase1CollectionCharges->FldErrMsg()) ?>");

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
frent_lease_carsadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frent_lease_carsadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Multi-Page
frent_lease_carsadd.MultiPage = new ew_MultiPage("frent_lease_carsadd");

// Dynamic selection lists
frent_lease_carsadd.Lists["x_bodyTypeID"] = {"LinkField":"x_bodyTypeID","Ajax":true,"AutoFill":false,"DisplayFields":["x_bodytype","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_bodytype"};
frent_lease_carsadd.Lists["x_bodyTypeID"].Data = "<?php echo $rent_lease_cars_add->bodyTypeID->LookupFilterQuery(FALSE, "add") ?>";
frent_lease_carsadd.Lists["x_extraFeatures[]"] = {"LinkField":"x_featureID","Ajax":true,"AutoFill":false,"DisplayFields":["x_extraFeatures","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_extra_features"};
frent_lease_carsadd.Lists["x_extraFeatures[]"].Data = "<?php echo $rent_lease_cars_add->extraFeatures->LookupFilterQuery(FALSE, "add") ?>";
frent_lease_carsadd.Lists["x_transmissionID"] = {"LinkField":"x_transmissionID","Ajax":true,"AutoFill":false,"DisplayFields":["x_transmission","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_transmission"};
frent_lease_carsadd.Lists["x_transmissionID"].Data = "<?php echo $rent_lease_cars_add->transmissionID->LookupFilterQuery(FALSE, "add") ?>";
frent_lease_carsadd.Lists["x_ac[]"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
frent_lease_carsadd.Lists["x_ac[]"].Options = <?php echo json_encode($rent_lease_cars_add->ac->Options()) ?>;
frent_lease_carsadd.Lists["x_active"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
frent_lease_carsadd.Lists["x_active"].Options = <?php echo json_encode($rent_lease_cars_add->active->Options()) ?>;
frent_lease_carsadd.Lists["x_weeklyDeals"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
frent_lease_carsadd.Lists["x_weeklyDeals"].Options = <?php echo json_encode($rent_lease_cars_add->weeklyDeals->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $rent_lease_cars_add->ShowPageHeader(); ?>
<?php
$rent_lease_cars_add->ShowMessage();
?>
<form name="frent_lease_carsadd" id="frent_lease_carsadd" class="<?php echo $rent_lease_cars_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($rent_lease_cars_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $rent_lease_cars_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rent_lease_cars">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($rent_lease_cars_add->IsModal) ?>">
<div class="ewMultiPage"><!-- multi-page -->
<div class="nav-tabs-custom" id="rent_lease_cars_add"><!-- multi-page .nav-tabs-custom -->
	<ul class="nav<?php echo $rent_lease_cars_add->MultiPages->NavStyle() ?>">
		<li<?php echo $rent_lease_cars_add->MultiPages->TabStyle("1") ?>><a href="#tab_rent_lease_cars1" data-toggle="tab"><?php echo $rent_lease_cars->PageCaption(1) ?></a></li>
		<li<?php echo $rent_lease_cars_add->MultiPages->TabStyle("2") ?>><a href="#tab_rent_lease_cars2" data-toggle="tab"><?php echo $rent_lease_cars->PageCaption(2) ?></a></li>
		<li<?php echo $rent_lease_cars_add->MultiPages->TabStyle("3") ?>><a href="#tab_rent_lease_cars3" data-toggle="tab"><?php echo $rent_lease_cars->PageCaption(3) ?></a></li>
		<li<?php echo $rent_lease_cars_add->MultiPages->TabStyle("4") ?>><a href="#tab_rent_lease_cars4" data-toggle="tab"><?php echo $rent_lease_cars->PageCaption(4) ?></a></li>
		<li<?php echo $rent_lease_cars_add->MultiPages->TabStyle("5") ?>><a href="#tab_rent_lease_cars5" data-toggle="tab"><?php echo $rent_lease_cars->PageCaption(5) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page .nav-tabs-custom .tab-content -->
		<div class="tab-pane<?php echo $rent_lease_cars_add->MultiPages->PageStyle("1") ?>" id="tab_rent_lease_cars1"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($rent_lease_cars->bodyTypeID->Visible) { // bodyTypeID ?>
	<div id="r_bodyTypeID" class="form-group">
		<label id="elh_rent_lease_cars_bodyTypeID" for="x_bodyTypeID" class="<?php echo $rent_lease_cars_add->LeftColumnClass ?>"><?php echo $rent_lease_cars->bodyTypeID->FldCaption() ?></label>
		<div class="<?php echo $rent_lease_cars_add->RightColumnClass ?>"><div<?php echo $rent_lease_cars->bodyTypeID->CellAttributes() ?>>
<span id="el_rent_lease_cars_bodyTypeID">
<select data-table="rent_lease_cars" data-field="x_bodyTypeID" data-page="1" data-value-separator="<?php echo $rent_lease_cars->bodyTypeID->DisplayValueSeparatorAttribute() ?>" id="x_bodyTypeID" name="x_bodyTypeID"<?php echo $rent_lease_cars->bodyTypeID->EditAttributes() ?>>
<?php echo $rent_lease_cars->bodyTypeID->SelectOptionListHtml("x_bodyTypeID") ?>
</select>
</span>
<?php echo $rent_lease_cars->bodyTypeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_lease_cars->carTitle->Visible) { // carTitle ?>
	<div id="r_carTitle" class="form-group">
		<label id="elh_rent_lease_cars_carTitle" for="x_carTitle" class="<?php echo $rent_lease_cars_add->LeftColumnClass ?>"><?php echo $rent_lease_cars->carTitle->FldCaption() ?></label>
		<div class="<?php echo $rent_lease_cars_add->RightColumnClass ?>"><div<?php echo $rent_lease_cars->carTitle->CellAttributes() ?>>
<span id="el_rent_lease_cars_carTitle">
<input type="text" data-table="rent_lease_cars" data-field="x_carTitle" data-page="1" name="x_carTitle" id="x_carTitle" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($rent_lease_cars->carTitle->getPlaceHolder()) ?>" value="<?php echo $rent_lease_cars->carTitle->EditValue ?>"<?php echo $rent_lease_cars->carTitle->EditAttributes() ?>>
</span>
<?php echo $rent_lease_cars->carTitle->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_lease_cars->slug->Visible) { // slug ?>
	<div id="r_slug" class="form-group">
		<label id="elh_rent_lease_cars_slug" for="x_slug" class="<?php echo $rent_lease_cars_add->LeftColumnClass ?>"><?php echo $rent_lease_cars->slug->FldCaption() ?></label>
		<div class="<?php echo $rent_lease_cars_add->RightColumnClass ?>"><div<?php echo $rent_lease_cars->slug->CellAttributes() ?>>
<span id="el_rent_lease_cars_slug">
<input type="text" data-table="rent_lease_cars" data-field="x_slug" data-page="1" name="x_slug" id="x_slug" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($rent_lease_cars->slug->getPlaceHolder()) ?>" value="<?php echo $rent_lease_cars->slug->EditValue ?>"<?php echo $rent_lease_cars->slug->EditAttributes() ?>>
</span>
<?php echo $rent_lease_cars->slug->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_lease_cars->image->Visible) { // image ?>
	<div id="r_image" class="form-group">
		<label id="elh_rent_lease_cars_image" class="<?php echo $rent_lease_cars_add->LeftColumnClass ?>"><?php echo $rent_lease_cars->image->FldCaption() ?></label>
		<div class="<?php echo $rent_lease_cars_add->RightColumnClass ?>"><div<?php echo $rent_lease_cars->image->CellAttributes() ?>>
<span id="el_rent_lease_cars_image">
<div id="fd_x_image">
<span title="<?php echo $rent_lease_cars->image->FldTitle() ? $rent_lease_cars->image->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($rent_lease_cars->image->ReadOnly || $rent_lease_cars->image->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="rent_lease_cars" data-field="x_image" data-page="1" name="x_image" id="x_image"<?php echo $rent_lease_cars->image->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_image" id= "fn_x_image" value="<?php echo $rent_lease_cars->image->Upload->FileName ?>">
<input type="hidden" name="fa_x_image" id= "fa_x_image" value="0">
<input type="hidden" name="fs_x_image" id= "fs_x_image" value="255">
<input type="hidden" name="fx_x_image" id= "fx_x_image" value="<?php echo $rent_lease_cars->image->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_image" id= "fm_x_image" value="<?php echo $rent_lease_cars->image->UploadMaxFileSize ?>">
</div>
<table id="ft_x_image" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $rent_lease_cars->image->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_lease_cars->extraFeatures->Visible) { // extraFeatures ?>
	<div id="r_extraFeatures" class="form-group">
		<label id="elh_rent_lease_cars_extraFeatures" class="<?php echo $rent_lease_cars_add->LeftColumnClass ?>"><?php echo $rent_lease_cars->extraFeatures->FldCaption() ?></label>
		<div class="<?php echo $rent_lease_cars_add->RightColumnClass ?>"><div<?php echo $rent_lease_cars->extraFeatures->CellAttributes() ?>>
<span id="el_rent_lease_cars_extraFeatures">
<div id="tp_x_extraFeatures" class="ewTemplate"><input type="checkbox" data-table="rent_lease_cars" data-field="x_extraFeatures" data-page="1" data-value-separator="<?php echo $rent_lease_cars->extraFeatures->DisplayValueSeparatorAttribute() ?>" name="x_extraFeatures[]" id="x_extraFeatures[]" value="{value}"<?php echo $rent_lease_cars->extraFeatures->EditAttributes() ?>></div>
<div id="dsl_x_extraFeatures" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $rent_lease_cars->extraFeatures->CheckBoxListHtml(FALSE, "x_extraFeatures[]", 1) ?>
</div></div>
</span>
<?php echo $rent_lease_cars->extraFeatures->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_lease_cars->noOfSeats->Visible) { // noOfSeats ?>
	<div id="r_noOfSeats" class="form-group">
		<label id="elh_rent_lease_cars_noOfSeats" for="x_noOfSeats" class="<?php echo $rent_lease_cars_add->LeftColumnClass ?>"><?php echo $rent_lease_cars->noOfSeats->FldCaption() ?></label>
		<div class="<?php echo $rent_lease_cars_add->RightColumnClass ?>"><div<?php echo $rent_lease_cars->noOfSeats->CellAttributes() ?>>
<span id="el_rent_lease_cars_noOfSeats">
<input type="text" data-table="rent_lease_cars" data-field="x_noOfSeats" data-page="1" name="x_noOfSeats" id="x_noOfSeats" size="30" placeholder="<?php echo ew_HtmlEncode($rent_lease_cars->noOfSeats->getPlaceHolder()) ?>" value="<?php echo $rent_lease_cars->noOfSeats->EditValue ?>"<?php echo $rent_lease_cars->noOfSeats->EditAttributes() ?>>
</span>
<?php echo $rent_lease_cars->noOfSeats->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_lease_cars->luggage->Visible) { // luggage ?>
	<div id="r_luggage" class="form-group">
		<label id="elh_rent_lease_cars_luggage" for="x_luggage" class="<?php echo $rent_lease_cars_add->LeftColumnClass ?>"><?php echo $rent_lease_cars->luggage->FldCaption() ?></label>
		<div class="<?php echo $rent_lease_cars_add->RightColumnClass ?>"><div<?php echo $rent_lease_cars->luggage->CellAttributes() ?>>
<span id="el_rent_lease_cars_luggage">
<input type="text" data-table="rent_lease_cars" data-field="x_luggage" data-page="1" name="x_luggage" id="x_luggage" size="30" placeholder="<?php echo ew_HtmlEncode($rent_lease_cars->luggage->getPlaceHolder()) ?>" value="<?php echo $rent_lease_cars->luggage->EditValue ?>"<?php echo $rent_lease_cars->luggage->EditAttributes() ?>>
</span>
<?php echo $rent_lease_cars->luggage->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_lease_cars->transmissionID->Visible) { // transmissionID ?>
	<div id="r_transmissionID" class="form-group">
		<label id="elh_rent_lease_cars_transmissionID" for="x_transmissionID" class="<?php echo $rent_lease_cars_add->LeftColumnClass ?>"><?php echo $rent_lease_cars->transmissionID->FldCaption() ?></label>
		<div class="<?php echo $rent_lease_cars_add->RightColumnClass ?>"><div<?php echo $rent_lease_cars->transmissionID->CellAttributes() ?>>
<span id="el_rent_lease_cars_transmissionID">
<select data-table="rent_lease_cars" data-field="x_transmissionID" data-page="1" data-value-separator="<?php echo $rent_lease_cars->transmissionID->DisplayValueSeparatorAttribute() ?>" id="x_transmissionID" name="x_transmissionID"<?php echo $rent_lease_cars->transmissionID->EditAttributes() ?>>
<?php echo $rent_lease_cars->transmissionID->SelectOptionListHtml("x_transmissionID") ?>
</select>
</span>
<?php echo $rent_lease_cars->transmissionID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_lease_cars->ac->Visible) { // ac ?>
	<div id="r_ac" class="form-group">
		<label id="elh_rent_lease_cars_ac" class="<?php echo $rent_lease_cars_add->LeftColumnClass ?>"><?php echo $rent_lease_cars->ac->FldCaption() ?></label>
		<div class="<?php echo $rent_lease_cars_add->RightColumnClass ?>"><div<?php echo $rent_lease_cars->ac->CellAttributes() ?>>
<span id="el_rent_lease_cars_ac">
<?php
$selwrk = (ew_ConvertToBool($rent_lease_cars->ac->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="rent_lease_cars" data-field="x_ac" data-page="1" name="x_ac[]" id="x_ac[]" value="1"<?php echo $selwrk ?><?php echo $rent_lease_cars->ac->EditAttributes() ?>>
</span>
<?php echo $rent_lease_cars->ac->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_lease_cars->noOfDoors->Visible) { // noOfDoors ?>
	<div id="r_noOfDoors" class="form-group">
		<label id="elh_rent_lease_cars_noOfDoors" for="x_noOfDoors" class="<?php echo $rent_lease_cars_add->LeftColumnClass ?>"><?php echo $rent_lease_cars->noOfDoors->FldCaption() ?></label>
		<div class="<?php echo $rent_lease_cars_add->RightColumnClass ?>"><div<?php echo $rent_lease_cars->noOfDoors->CellAttributes() ?>>
<span id="el_rent_lease_cars_noOfDoors">
<input type="text" data-table="rent_lease_cars" data-field="x_noOfDoors" data-page="1" name="x_noOfDoors" id="x_noOfDoors" size="30" placeholder="<?php echo ew_HtmlEncode($rent_lease_cars->noOfDoors->getPlaceHolder()) ?>" value="<?php echo $rent_lease_cars->noOfDoors->EditValue ?>"<?php echo $rent_lease_cars->noOfDoors->EditAttributes() ?>>
</span>
<?php echo $rent_lease_cars->noOfDoors->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_lease_cars->deliveryAED->Visible) { // deliveryAED ?>
	<div id="r_deliveryAED" class="form-group">
		<label id="elh_rent_lease_cars_deliveryAED" for="x_deliveryAED" class="<?php echo $rent_lease_cars_add->LeftColumnClass ?>"><?php echo $rent_lease_cars->deliveryAED->FldCaption() ?></label>
		<div class="<?php echo $rent_lease_cars_add->RightColumnClass ?>"><div<?php echo $rent_lease_cars->deliveryAED->CellAttributes() ?>>
<span id="el_rent_lease_cars_deliveryAED">
<input type="text" data-table="rent_lease_cars" data-field="x_deliveryAED" data-page="1" name="x_deliveryAED" id="x_deliveryAED" size="30" placeholder="<?php echo ew_HtmlEncode($rent_lease_cars->deliveryAED->getPlaceHolder()) ?>" value="<?php echo $rent_lease_cars->deliveryAED->EditValue ?>"<?php echo $rent_lease_cars->deliveryAED->EditAttributes() ?>>
</span>
<?php echo $rent_lease_cars->deliveryAED->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_lease_cars->active->Visible) { // active ?>
	<div id="r_active" class="form-group">
		<label id="elh_rent_lease_cars_active" for="x_active" class="<?php echo $rent_lease_cars_add->LeftColumnClass ?>"><?php echo $rent_lease_cars->active->FldCaption() ?></label>
		<div class="<?php echo $rent_lease_cars_add->RightColumnClass ?>"><div<?php echo $rent_lease_cars->active->CellAttributes() ?>>
<span id="el_rent_lease_cars_active">
<select data-table="rent_lease_cars" data-field="x_active" data-page="1" data-value-separator="<?php echo $rent_lease_cars->active->DisplayValueSeparatorAttribute() ?>" id="x_active" name="x_active"<?php echo $rent_lease_cars->active->EditAttributes() ?>>
<?php echo $rent_lease_cars->active->SelectOptionListHtml("x_active") ?>
</select>
</span>
<?php echo $rent_lease_cars->active->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_lease_cars->weeklyDeals->Visible) { // weeklyDeals ?>
	<div id="r_weeklyDeals" class="form-group">
		<label id="elh_rent_lease_cars_weeklyDeals" for="x_weeklyDeals" class="<?php echo $rent_lease_cars_add->LeftColumnClass ?>"><?php echo $rent_lease_cars->weeklyDeals->FldCaption() ?></label>
		<div class="<?php echo $rent_lease_cars_add->RightColumnClass ?>"><div<?php echo $rent_lease_cars->weeklyDeals->CellAttributes() ?>>
<span id="el_rent_lease_cars_weeklyDeals">
<select data-table="rent_lease_cars" data-field="x_weeklyDeals" data-page="1" data-value-separator="<?php echo $rent_lease_cars->weeklyDeals->DisplayValueSeparatorAttribute() ?>" id="x_weeklyDeals" name="x_weeklyDeals"<?php echo $rent_lease_cars->weeklyDeals->EditAttributes() ?>>
<?php echo $rent_lease_cars->weeklyDeals->SelectOptionListHtml("x_weeklyDeals") ?>
</select>
</span>
<?php echo $rent_lease_cars->weeklyDeals->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $rent_lease_cars_add->MultiPages->PageStyle("2") ?>" id="tab_rent_lease_cars2"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($rent_lease_cars->dailyAED->Visible) { // dailyAED ?>
	<div id="r_dailyAED" class="form-group">
		<label id="elh_rent_lease_cars_dailyAED" for="x_dailyAED" class="<?php echo $rent_lease_cars_add->LeftColumnClass ?>"><?php echo $rent_lease_cars->dailyAED->FldCaption() ?></label>
		<div class="<?php echo $rent_lease_cars_add->RightColumnClass ?>"><div<?php echo $rent_lease_cars->dailyAED->CellAttributes() ?>>
<span id="el_rent_lease_cars_dailyAED">
<input type="text" data-table="rent_lease_cars" data-field="x_dailyAED" data-page="2" name="x_dailyAED" id="x_dailyAED" size="30" placeholder="<?php echo ew_HtmlEncode($rent_lease_cars->dailyAED->getPlaceHolder()) ?>" value="<?php echo $rent_lease_cars->dailyAED->EditValue ?>"<?php echo $rent_lease_cars->dailyAED->EditAttributes() ?>>
</span>
<?php echo $rent_lease_cars->dailyAED->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_lease_cars->dailyDummyAED->Visible) { // dailyDummyAED ?>
	<div id="r_dailyDummyAED" class="form-group">
		<label id="elh_rent_lease_cars_dailyDummyAED" for="x_dailyDummyAED" class="<?php echo $rent_lease_cars_add->LeftColumnClass ?>"><?php echo $rent_lease_cars->dailyDummyAED->FldCaption() ?></label>
		<div class="<?php echo $rent_lease_cars_add->RightColumnClass ?>"><div<?php echo $rent_lease_cars->dailyDummyAED->CellAttributes() ?>>
<span id="el_rent_lease_cars_dailyDummyAED">
<input type="text" data-table="rent_lease_cars" data-field="x_dailyDummyAED" data-page="2" name="x_dailyDummyAED" id="x_dailyDummyAED" size="30" placeholder="<?php echo ew_HtmlEncode($rent_lease_cars->dailyDummyAED->getPlaceHolder()) ?>" value="<?php echo $rent_lease_cars->dailyDummyAED->EditValue ?>"<?php echo $rent_lease_cars->dailyDummyAED->EditAttributes() ?>>
</span>
<?php echo $rent_lease_cars->dailyDummyAED->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $rent_lease_cars_add->MultiPages->PageStyle("3") ?>" id="tab_rent_lease_cars3"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($rent_lease_cars->weeklyAED->Visible) { // weeklyAED ?>
	<div id="r_weeklyAED" class="form-group">
		<label id="elh_rent_lease_cars_weeklyAED" for="x_weeklyAED" class="<?php echo $rent_lease_cars_add->LeftColumnClass ?>"><?php echo $rent_lease_cars->weeklyAED->FldCaption() ?></label>
		<div class="<?php echo $rent_lease_cars_add->RightColumnClass ?>"><div<?php echo $rent_lease_cars->weeklyAED->CellAttributes() ?>>
<span id="el_rent_lease_cars_weeklyAED">
<input type="text" data-table="rent_lease_cars" data-field="x_weeklyAED" data-page="3" name="x_weeklyAED" id="x_weeklyAED" size="30" placeholder="<?php echo ew_HtmlEncode($rent_lease_cars->weeklyAED->getPlaceHolder()) ?>" value="<?php echo $rent_lease_cars->weeklyAED->EditValue ?>"<?php echo $rent_lease_cars->weeklyAED->EditAttributes() ?>>
</span>
<?php echo $rent_lease_cars->weeklyAED->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_lease_cars->weeklyDummyAED->Visible) { // weeklyDummyAED ?>
	<div id="r_weeklyDummyAED" class="form-group">
		<label id="elh_rent_lease_cars_weeklyDummyAED" for="x_weeklyDummyAED" class="<?php echo $rent_lease_cars_add->LeftColumnClass ?>"><?php echo $rent_lease_cars->weeklyDummyAED->FldCaption() ?></label>
		<div class="<?php echo $rent_lease_cars_add->RightColumnClass ?>"><div<?php echo $rent_lease_cars->weeklyDummyAED->CellAttributes() ?>>
<span id="el_rent_lease_cars_weeklyDummyAED">
<input type="text" data-table="rent_lease_cars" data-field="x_weeklyDummyAED" data-page="3" name="x_weeklyDummyAED" id="x_weeklyDummyAED" size="30" placeholder="<?php echo ew_HtmlEncode($rent_lease_cars->weeklyDummyAED->getPlaceHolder()) ?>" value="<?php echo $rent_lease_cars->weeklyDummyAED->EditValue ?>"<?php echo $rent_lease_cars->weeklyDummyAED->EditAttributes() ?>>
</span>
<?php echo $rent_lease_cars->weeklyDummyAED->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $rent_lease_cars_add->MultiPages->PageStyle("4") ?>" id="tab_rent_lease_cars4"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($rent_lease_cars->monthlyAED->Visible) { // monthlyAED ?>
	<div id="r_monthlyAED" class="form-group">
		<label id="elh_rent_lease_cars_monthlyAED" for="x_monthlyAED" class="<?php echo $rent_lease_cars_add->LeftColumnClass ?>"><?php echo $rent_lease_cars->monthlyAED->FldCaption() ?></label>
		<div class="<?php echo $rent_lease_cars_add->RightColumnClass ?>"><div<?php echo $rent_lease_cars->monthlyAED->CellAttributes() ?>>
<span id="el_rent_lease_cars_monthlyAED">
<input type="text" data-table="rent_lease_cars" data-field="x_monthlyAED" data-page="4" name="x_monthlyAED" id="x_monthlyAED" size="30" placeholder="<?php echo ew_HtmlEncode($rent_lease_cars->monthlyAED->getPlaceHolder()) ?>" value="<?php echo $rent_lease_cars->monthlyAED->EditValue ?>"<?php echo $rent_lease_cars->monthlyAED->EditAttributes() ?>>
</span>
<?php echo $rent_lease_cars->monthlyAED->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_lease_cars->monthlyDummyAED->Visible) { // monthlyDummyAED ?>
	<div id="r_monthlyDummyAED" class="form-group">
		<label id="elh_rent_lease_cars_monthlyDummyAED" for="x_monthlyDummyAED" class="<?php echo $rent_lease_cars_add->LeftColumnClass ?>"><?php echo $rent_lease_cars->monthlyDummyAED->FldCaption() ?></label>
		<div class="<?php echo $rent_lease_cars_add->RightColumnClass ?>"><div<?php echo $rent_lease_cars->monthlyDummyAED->CellAttributes() ?>>
<span id="el_rent_lease_cars_monthlyDummyAED">
<input type="text" data-table="rent_lease_cars" data-field="x_monthlyDummyAED" data-page="4" name="x_monthlyDummyAED" id="x_monthlyDummyAED" size="30" placeholder="<?php echo ew_HtmlEncode($rent_lease_cars->monthlyDummyAED->getPlaceHolder()) ?>" value="<?php echo $rent_lease_cars->monthlyDummyAED->EditValue ?>"<?php echo $rent_lease_cars->monthlyDummyAED->EditAttributes() ?>>
</span>
<?php echo $rent_lease_cars->monthlyDummyAED->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $rent_lease_cars_add->MultiPages->PageStyle("5") ?>" id="tab_rent_lease_cars5"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($rent_lease_cars->phase1OrangeCard->Visible) { // phase1OrangeCard ?>
	<div id="r_phase1OrangeCard" class="form-group">
		<label id="elh_rent_lease_cars_phase1OrangeCard" for="x_phase1OrangeCard" class="<?php echo $rent_lease_cars_add->LeftColumnClass ?>"><?php echo $rent_lease_cars->phase1OrangeCard->FldCaption() ?></label>
		<div class="<?php echo $rent_lease_cars_add->RightColumnClass ?>"><div<?php echo $rent_lease_cars->phase1OrangeCard->CellAttributes() ?>>
<span id="el_rent_lease_cars_phase1OrangeCard">
<input type="text" data-table="rent_lease_cars" data-field="x_phase1OrangeCard" data-page="5" name="x_phase1OrangeCard" id="x_phase1OrangeCard" size="30" placeholder="<?php echo ew_HtmlEncode($rent_lease_cars->phase1OrangeCard->getPlaceHolder()) ?>" value="<?php echo $rent_lease_cars->phase1OrangeCard->EditValue ?>"<?php echo $rent_lease_cars->phase1OrangeCard->EditAttributes() ?>>
</span>
<?php echo $rent_lease_cars->phase1OrangeCard->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_lease_cars->phase1GPS->Visible) { // phase1GPS ?>
	<div id="r_phase1GPS" class="form-group">
		<label id="elh_rent_lease_cars_phase1GPS" for="x_phase1GPS" class="<?php echo $rent_lease_cars_add->LeftColumnClass ?>"><?php echo $rent_lease_cars->phase1GPS->FldCaption() ?></label>
		<div class="<?php echo $rent_lease_cars_add->RightColumnClass ?>"><div<?php echo $rent_lease_cars->phase1GPS->CellAttributes() ?>>
<span id="el_rent_lease_cars_phase1GPS">
<input type="text" data-table="rent_lease_cars" data-field="x_phase1GPS" data-page="5" name="x_phase1GPS" id="x_phase1GPS" size="30" placeholder="<?php echo ew_HtmlEncode($rent_lease_cars->phase1GPS->getPlaceHolder()) ?>" value="<?php echo $rent_lease_cars->phase1GPS->EditValue ?>"<?php echo $rent_lease_cars->phase1GPS->EditAttributes() ?>>
</span>
<?php echo $rent_lease_cars->phase1GPS->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_lease_cars->phase1DeliveryCharges->Visible) { // phase1DeliveryCharges ?>
	<div id="r_phase1DeliveryCharges" class="form-group">
		<label id="elh_rent_lease_cars_phase1DeliveryCharges" for="x_phase1DeliveryCharges" class="<?php echo $rent_lease_cars_add->LeftColumnClass ?>"><?php echo $rent_lease_cars->phase1DeliveryCharges->FldCaption() ?></label>
		<div class="<?php echo $rent_lease_cars_add->RightColumnClass ?>"><div<?php echo $rent_lease_cars->phase1DeliveryCharges->CellAttributes() ?>>
<span id="el_rent_lease_cars_phase1DeliveryCharges">
<input type="text" data-table="rent_lease_cars" data-field="x_phase1DeliveryCharges" data-page="5" name="x_phase1DeliveryCharges" id="x_phase1DeliveryCharges" size="30" placeholder="<?php echo ew_HtmlEncode($rent_lease_cars->phase1DeliveryCharges->getPlaceHolder()) ?>" value="<?php echo $rent_lease_cars->phase1DeliveryCharges->EditValue ?>"<?php echo $rent_lease_cars->phase1DeliveryCharges->EditAttributes() ?>>
</span>
<?php echo $rent_lease_cars->phase1DeliveryCharges->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_lease_cars->phase1CollectionCharges->Visible) { // phase1CollectionCharges ?>
	<div id="r_phase1CollectionCharges" class="form-group">
		<label id="elh_rent_lease_cars_phase1CollectionCharges" for="x_phase1CollectionCharges" class="<?php echo $rent_lease_cars_add->LeftColumnClass ?>"><?php echo $rent_lease_cars->phase1CollectionCharges->FldCaption() ?></label>
		<div class="<?php echo $rent_lease_cars_add->RightColumnClass ?>"><div<?php echo $rent_lease_cars->phase1CollectionCharges->CellAttributes() ?>>
<span id="el_rent_lease_cars_phase1CollectionCharges">
<input type="text" data-table="rent_lease_cars" data-field="x_phase1CollectionCharges" data-page="5" name="x_phase1CollectionCharges" id="x_phase1CollectionCharges" size="30" placeholder="<?php echo ew_HtmlEncode($rent_lease_cars->phase1CollectionCharges->getPlaceHolder()) ?>" value="<?php echo $rent_lease_cars->phase1CollectionCharges->EditValue ?>"<?php echo $rent_lease_cars->phase1CollectionCharges->EditAttributes() ?>>
</span>
<?php echo $rent_lease_cars->phase1CollectionCharges->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page .nav-tabs-custom .tab-content -->
</div><!-- /multi-page .nav-tabs-custom -->
</div><!-- /multi-page -->
<?php if (!$rent_lease_cars_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $rent_lease_cars_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $rent_lease_cars_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
frent_lease_carsadd.Init();
</script>
<?php
$rent_lease_cars_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$rent_lease_cars_add->Page_Terminate();
?>
