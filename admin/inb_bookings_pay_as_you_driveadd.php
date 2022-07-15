<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "inb_bookings_pay_as_you_driveinfo.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$inb_bookings_pay_as_you_drive_add = NULL; // Initialize page object first

class cinb_bookings_pay_as_you_drive_add extends cinb_bookings_pay_as_you_drive {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'inb_bookings_pay_as_you_drive';

	// Page object name
	var $PageObjName = 'inb_bookings_pay_as_you_drive_add';

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

		// Table object (inb_bookings_pay_as_you_drive)
		if (!isset($GLOBALS["inb_bookings_pay_as_you_drive"]) || get_class($GLOBALS["inb_bookings_pay_as_you_drive"]) == "cinb_bookings_pay_as_you_drive") {
			$GLOBALS["inb_bookings_pay_as_you_drive"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["inb_bookings_pay_as_you_drive"];
		}

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'inb_bookings_pay_as_you_drive', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("inb_bookings_pay_as_you_drivelist.php"));
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
		$this->bookingNumber->SetVisibility();
		$this->_userID->SetVisibility();
		$this->payDriveCarID->SetVisibility();
		$this->pickUpLocation->SetVisibility();
		$this->dropLocation->SetVisibility();
		$this->pickUpDate->SetVisibility();
		$this->dropDate->SetVisibility();
		$this->noOfDays->SetVisibility();
		$this->bookingTerm->SetVisibility();
		$this->slab->SetVisibility();
		$this->orangeCard->SetVisibility();
		$this->gps->SetVisibility();
		$this->deliveryCharge->SetVisibility();
		$this->collectionCharge->SetVisibility();
		$this->rentalAmount->SetVisibility();
		$this->totalAmount->SetVisibility();
		$this->vat->SetVisibility();
		$this->grandTotal->SetVisibility();
		$this->deliveryAddress->SetVisibility();
		$this->paymentMethod->SetVisibility();
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
		global $EW_EXPORT, $inb_bookings_pay_as_you_drive;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($inb_bookings_pay_as_you_drive);
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
					if ($pageName == "inb_bookings_pay_as_you_driveview.php")
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
			if (@$_GET["bookingID"] != "") {
				$this->bookingID->setQueryStringValue($_GET["bookingID"]);
				$this->setKey("bookingID", $this->bookingID->CurrentValue); // Set up key
			} else {
				$this->setKey("bookingID", ""); // Clear key
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
					$this->Page_Terminate("inb_bookings_pay_as_you_drivelist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "inb_bookings_pay_as_you_drivelist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "inb_bookings_pay_as_you_driveview.php")
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
		$this->bookingID->CurrentValue = NULL;
		$this->bookingID->OldValue = $this->bookingID->CurrentValue;
		$this->bookingNumber->CurrentValue = NULL;
		$this->bookingNumber->OldValue = $this->bookingNumber->CurrentValue;
		$this->_userID->CurrentValue = NULL;
		$this->_userID->OldValue = $this->_userID->CurrentValue;
		$this->payDriveCarID->CurrentValue = NULL;
		$this->payDriveCarID->OldValue = $this->payDriveCarID->CurrentValue;
		$this->pickUpLocation->CurrentValue = NULL;
		$this->pickUpLocation->OldValue = $this->pickUpLocation->CurrentValue;
		$this->dropLocation->CurrentValue = NULL;
		$this->dropLocation->OldValue = $this->dropLocation->CurrentValue;
		$this->pickUpDate->CurrentValue = NULL;
		$this->pickUpDate->OldValue = $this->pickUpDate->CurrentValue;
		$this->dropDate->CurrentValue = NULL;
		$this->dropDate->OldValue = $this->dropDate->CurrentValue;
		$this->noOfDays->CurrentValue = NULL;
		$this->noOfDays->OldValue = $this->noOfDays->CurrentValue;
		$this->bookingTerm->CurrentValue = NULL;
		$this->bookingTerm->OldValue = $this->bookingTerm->CurrentValue;
		$this->slab->CurrentValue = NULL;
		$this->slab->OldValue = $this->slab->CurrentValue;
		$this->orangeCard->CurrentValue = NULL;
		$this->orangeCard->OldValue = $this->orangeCard->CurrentValue;
		$this->gps->CurrentValue = NULL;
		$this->gps->OldValue = $this->gps->CurrentValue;
		$this->deliveryCharge->CurrentValue = NULL;
		$this->deliveryCharge->OldValue = $this->deliveryCharge->CurrentValue;
		$this->collectionCharge->CurrentValue = NULL;
		$this->collectionCharge->OldValue = $this->collectionCharge->CurrentValue;
		$this->rentalAmount->CurrentValue = NULL;
		$this->rentalAmount->OldValue = $this->rentalAmount->CurrentValue;
		$this->totalAmount->CurrentValue = NULL;
		$this->totalAmount->OldValue = $this->totalAmount->CurrentValue;
		$this->vat->CurrentValue = NULL;
		$this->vat->OldValue = $this->vat->CurrentValue;
		$this->grandTotal->CurrentValue = NULL;
		$this->grandTotal->OldValue = $this->grandTotal->CurrentValue;
		$this->deliveryAddress->CurrentValue = NULL;
		$this->deliveryAddress->OldValue = $this->deliveryAddress->CurrentValue;
		$this->paymentMethod->CurrentValue = NULL;
		$this->paymentMethod->OldValue = $this->paymentMethod->CurrentValue;
		$this->dateCreated->CurrentValue = NULL;
		$this->dateCreated->OldValue = $this->dateCreated->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->bookingNumber->FldIsDetailKey) {
			$this->bookingNumber->setFormValue($objForm->GetValue("x_bookingNumber"));
		}
		if (!$this->_userID->FldIsDetailKey) {
			$this->_userID->setFormValue($objForm->GetValue("x__userID"));
		}
		if (!$this->payDriveCarID->FldIsDetailKey) {
			$this->payDriveCarID->setFormValue($objForm->GetValue("x_payDriveCarID"));
		}
		if (!$this->pickUpLocation->FldIsDetailKey) {
			$this->pickUpLocation->setFormValue($objForm->GetValue("x_pickUpLocation"));
		}
		if (!$this->dropLocation->FldIsDetailKey) {
			$this->dropLocation->setFormValue($objForm->GetValue("x_dropLocation"));
		}
		if (!$this->pickUpDate->FldIsDetailKey) {
			$this->pickUpDate->setFormValue($objForm->GetValue("x_pickUpDate"));
			$this->pickUpDate->CurrentValue = ew_UnFormatDateTime($this->pickUpDate->CurrentValue, 7);
		}
		if (!$this->dropDate->FldIsDetailKey) {
			$this->dropDate->setFormValue($objForm->GetValue("x_dropDate"));
			$this->dropDate->CurrentValue = ew_UnFormatDateTime($this->dropDate->CurrentValue, 7);
		}
		if (!$this->noOfDays->FldIsDetailKey) {
			$this->noOfDays->setFormValue($objForm->GetValue("x_noOfDays"));
		}
		if (!$this->bookingTerm->FldIsDetailKey) {
			$this->bookingTerm->setFormValue($objForm->GetValue("x_bookingTerm"));
		}
		if (!$this->slab->FldIsDetailKey) {
			$this->slab->setFormValue($objForm->GetValue("x_slab"));
		}
		if (!$this->orangeCard->FldIsDetailKey) {
			$this->orangeCard->setFormValue($objForm->GetValue("x_orangeCard"));
		}
		if (!$this->gps->FldIsDetailKey) {
			$this->gps->setFormValue($objForm->GetValue("x_gps"));
		}
		if (!$this->deliveryCharge->FldIsDetailKey) {
			$this->deliveryCharge->setFormValue($objForm->GetValue("x_deliveryCharge"));
		}
		if (!$this->collectionCharge->FldIsDetailKey) {
			$this->collectionCharge->setFormValue($objForm->GetValue("x_collectionCharge"));
		}
		if (!$this->rentalAmount->FldIsDetailKey) {
			$this->rentalAmount->setFormValue($objForm->GetValue("x_rentalAmount"));
		}
		if (!$this->totalAmount->FldIsDetailKey) {
			$this->totalAmount->setFormValue($objForm->GetValue("x_totalAmount"));
		}
		if (!$this->vat->FldIsDetailKey) {
			$this->vat->setFormValue($objForm->GetValue("x_vat"));
		}
		if (!$this->grandTotal->FldIsDetailKey) {
			$this->grandTotal->setFormValue($objForm->GetValue("x_grandTotal"));
		}
		if (!$this->deliveryAddress->FldIsDetailKey) {
			$this->deliveryAddress->setFormValue($objForm->GetValue("x_deliveryAddress"));
		}
		if (!$this->paymentMethod->FldIsDetailKey) {
			$this->paymentMethod->setFormValue($objForm->GetValue("x_paymentMethod"));
		}
		if (!$this->dateCreated->FldIsDetailKey) {
			$this->dateCreated->setFormValue($objForm->GetValue("x_dateCreated"));
			$this->dateCreated->CurrentValue = ew_UnFormatDateTime($this->dateCreated->CurrentValue, 7);
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->bookingNumber->CurrentValue = $this->bookingNumber->FormValue;
		$this->_userID->CurrentValue = $this->_userID->FormValue;
		$this->payDriveCarID->CurrentValue = $this->payDriveCarID->FormValue;
		$this->pickUpLocation->CurrentValue = $this->pickUpLocation->FormValue;
		$this->dropLocation->CurrentValue = $this->dropLocation->FormValue;
		$this->pickUpDate->CurrentValue = $this->pickUpDate->FormValue;
		$this->pickUpDate->CurrentValue = ew_UnFormatDateTime($this->pickUpDate->CurrentValue, 7);
		$this->dropDate->CurrentValue = $this->dropDate->FormValue;
		$this->dropDate->CurrentValue = ew_UnFormatDateTime($this->dropDate->CurrentValue, 7);
		$this->noOfDays->CurrentValue = $this->noOfDays->FormValue;
		$this->bookingTerm->CurrentValue = $this->bookingTerm->FormValue;
		$this->slab->CurrentValue = $this->slab->FormValue;
		$this->orangeCard->CurrentValue = $this->orangeCard->FormValue;
		$this->gps->CurrentValue = $this->gps->FormValue;
		$this->deliveryCharge->CurrentValue = $this->deliveryCharge->FormValue;
		$this->collectionCharge->CurrentValue = $this->collectionCharge->FormValue;
		$this->rentalAmount->CurrentValue = $this->rentalAmount->FormValue;
		$this->totalAmount->CurrentValue = $this->totalAmount->FormValue;
		$this->vat->CurrentValue = $this->vat->FormValue;
		$this->grandTotal->CurrentValue = $this->grandTotal->FormValue;
		$this->deliveryAddress->CurrentValue = $this->deliveryAddress->FormValue;
		$this->paymentMethod->CurrentValue = $this->paymentMethod->FormValue;
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
		$this->bookingID->setDbValue($row['bookingID']);
		$this->bookingNumber->setDbValue($row['bookingNumber']);
		$this->_userID->setDbValue($row['userID']);
		$this->payDriveCarID->setDbValue($row['payDriveCarID']);
		$this->pickUpLocation->setDbValue($row['pickUpLocation']);
		$this->dropLocation->setDbValue($row['dropLocation']);
		$this->pickUpDate->setDbValue($row['pickUpDate']);
		$this->dropDate->setDbValue($row['dropDate']);
		$this->noOfDays->setDbValue($row['noOfDays']);
		$this->bookingTerm->setDbValue($row['bookingTerm']);
		$this->slab->setDbValue($row['slab']);
		$this->orangeCard->setDbValue($row['orangeCard']);
		$this->gps->setDbValue($row['gps']);
		$this->deliveryCharge->setDbValue($row['deliveryCharge']);
		$this->collectionCharge->setDbValue($row['collectionCharge']);
		$this->rentalAmount->setDbValue($row['rentalAmount']);
		$this->totalAmount->setDbValue($row['totalAmount']);
		$this->vat->setDbValue($row['vat']);
		$this->grandTotal->setDbValue($row['grandTotal']);
		$this->deliveryAddress->setDbValue($row['deliveryAddress']);
		$this->paymentMethod->setDbValue($row['paymentMethod']);
		$this->dateCreated->setDbValue($row['dateCreated']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['bookingID'] = $this->bookingID->CurrentValue;
		$row['bookingNumber'] = $this->bookingNumber->CurrentValue;
		$row['userID'] = $this->_userID->CurrentValue;
		$row['payDriveCarID'] = $this->payDriveCarID->CurrentValue;
		$row['pickUpLocation'] = $this->pickUpLocation->CurrentValue;
		$row['dropLocation'] = $this->dropLocation->CurrentValue;
		$row['pickUpDate'] = $this->pickUpDate->CurrentValue;
		$row['dropDate'] = $this->dropDate->CurrentValue;
		$row['noOfDays'] = $this->noOfDays->CurrentValue;
		$row['bookingTerm'] = $this->bookingTerm->CurrentValue;
		$row['slab'] = $this->slab->CurrentValue;
		$row['orangeCard'] = $this->orangeCard->CurrentValue;
		$row['gps'] = $this->gps->CurrentValue;
		$row['deliveryCharge'] = $this->deliveryCharge->CurrentValue;
		$row['collectionCharge'] = $this->collectionCharge->CurrentValue;
		$row['rentalAmount'] = $this->rentalAmount->CurrentValue;
		$row['totalAmount'] = $this->totalAmount->CurrentValue;
		$row['vat'] = $this->vat->CurrentValue;
		$row['grandTotal'] = $this->grandTotal->CurrentValue;
		$row['deliveryAddress'] = $this->deliveryAddress->CurrentValue;
		$row['paymentMethod'] = $this->paymentMethod->CurrentValue;
		$row['dateCreated'] = $this->dateCreated->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->bookingID->DbValue = $row['bookingID'];
		$this->bookingNumber->DbValue = $row['bookingNumber'];
		$this->_userID->DbValue = $row['userID'];
		$this->payDriveCarID->DbValue = $row['payDriveCarID'];
		$this->pickUpLocation->DbValue = $row['pickUpLocation'];
		$this->dropLocation->DbValue = $row['dropLocation'];
		$this->pickUpDate->DbValue = $row['pickUpDate'];
		$this->dropDate->DbValue = $row['dropDate'];
		$this->noOfDays->DbValue = $row['noOfDays'];
		$this->bookingTerm->DbValue = $row['bookingTerm'];
		$this->slab->DbValue = $row['slab'];
		$this->orangeCard->DbValue = $row['orangeCard'];
		$this->gps->DbValue = $row['gps'];
		$this->deliveryCharge->DbValue = $row['deliveryCharge'];
		$this->collectionCharge->DbValue = $row['collectionCharge'];
		$this->rentalAmount->DbValue = $row['rentalAmount'];
		$this->totalAmount->DbValue = $row['totalAmount'];
		$this->vat->DbValue = $row['vat'];
		$this->grandTotal->DbValue = $row['grandTotal'];
		$this->deliveryAddress->DbValue = $row['deliveryAddress'];
		$this->paymentMethod->DbValue = $row['paymentMethod'];
		$this->dateCreated->DbValue = $row['dateCreated'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("bookingID")) <> "")
			$this->bookingID->CurrentValue = $this->getKey("bookingID"); // bookingID
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

		if ($this->orangeCard->FormValue == $this->orangeCard->CurrentValue && is_numeric(ew_StrToFloat($this->orangeCard->CurrentValue)))
			$this->orangeCard->CurrentValue = ew_StrToFloat($this->orangeCard->CurrentValue);

		// Convert decimal values if posted back
		if ($this->deliveryCharge->FormValue == $this->deliveryCharge->CurrentValue && is_numeric(ew_StrToFloat($this->deliveryCharge->CurrentValue)))
			$this->deliveryCharge->CurrentValue = ew_StrToFloat($this->deliveryCharge->CurrentValue);

		// Convert decimal values if posted back
		if ($this->collectionCharge->FormValue == $this->collectionCharge->CurrentValue && is_numeric(ew_StrToFloat($this->collectionCharge->CurrentValue)))
			$this->collectionCharge->CurrentValue = ew_StrToFloat($this->collectionCharge->CurrentValue);

		// Convert decimal values if posted back
		if ($this->rentalAmount->FormValue == $this->rentalAmount->CurrentValue && is_numeric(ew_StrToFloat($this->rentalAmount->CurrentValue)))
			$this->rentalAmount->CurrentValue = ew_StrToFloat($this->rentalAmount->CurrentValue);

		// Convert decimal values if posted back
		if ($this->totalAmount->FormValue == $this->totalAmount->CurrentValue && is_numeric(ew_StrToFloat($this->totalAmount->CurrentValue)))
			$this->totalAmount->CurrentValue = ew_StrToFloat($this->totalAmount->CurrentValue);

		// Convert decimal values if posted back
		if ($this->vat->FormValue == $this->vat->CurrentValue && is_numeric(ew_StrToFloat($this->vat->CurrentValue)))
			$this->vat->CurrentValue = ew_StrToFloat($this->vat->CurrentValue);

		// Convert decimal values if posted back
		if ($this->grandTotal->FormValue == $this->grandTotal->CurrentValue && is_numeric(ew_StrToFloat($this->grandTotal->CurrentValue)))
			$this->grandTotal->CurrentValue = ew_StrToFloat($this->grandTotal->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// bookingID
		// bookingNumber
		// userID
		// payDriveCarID
		// pickUpLocation
		// dropLocation
		// pickUpDate
		// dropDate
		// noOfDays
		// bookingTerm
		// slab
		// orangeCard
		// gps
		// deliveryCharge
		// collectionCharge
		// rentalAmount
		// totalAmount
		// vat
		// grandTotal
		// deliveryAddress
		// paymentMethod
		// dateCreated

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// bookingID
		$this->bookingID->ViewValue = $this->bookingID->CurrentValue;
		$this->bookingID->ViewCustomAttributes = "";

		// bookingNumber
		$this->bookingNumber->ViewValue = $this->bookingNumber->CurrentValue;
		$this->bookingNumber->ViewCustomAttributes = "";

		// userID
		if (strval($this->_userID->CurrentValue) <> "") {
			$sFilterWrk = "`userID`" . ew_SearchString("=", $this->_userID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `userID`, `firstName` AS `DispFld`, `lastName` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `users`";
		$sWhereWrk = "";
		$this->_userID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->_userID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->_userID->ViewValue = $this->_userID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->_userID->ViewValue = $this->_userID->CurrentValue;
			}
		} else {
			$this->_userID->ViewValue = NULL;
		}
		$this->_userID->ViewCustomAttributes = "";

		// payDriveCarID
		if (strval($this->payDriveCarID->CurrentValue) <> "") {
			$sFilterWrk = "`payDriveCarID`" . ew_SearchString("=", $this->payDriveCarID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `payDriveCarID`, `carTitle` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `pay_as_you_drive`";
		$sWhereWrk = "";
		$this->payDriveCarID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->payDriveCarID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->payDriveCarID->ViewValue = $this->payDriveCarID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->payDriveCarID->ViewValue = $this->payDriveCarID->CurrentValue;
			}
		} else {
			$this->payDriveCarID->ViewValue = NULL;
		}
		$this->payDriveCarID->ViewCustomAttributes = "";

		// pickUpLocation
		if (strval($this->pickUpLocation->CurrentValue) <> "") {
			$sFilterWrk = "`pdLocationID`" . ew_SearchString("=", $this->pickUpLocation->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `pdLocationID`, `location` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `pickup_drop_locations`";
		$sWhereWrk = "";
		$this->pickUpLocation->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->pickUpLocation, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->pickUpLocation->ViewValue = $this->pickUpLocation->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->pickUpLocation->ViewValue = $this->pickUpLocation->CurrentValue;
			}
		} else {
			$this->pickUpLocation->ViewValue = NULL;
		}
		$this->pickUpLocation->ViewCustomAttributes = "";

		// dropLocation
		if (strval($this->dropLocation->CurrentValue) <> "") {
			$sFilterWrk = "`pdLocationID`" . ew_SearchString("=", $this->dropLocation->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `pdLocationID`, `location` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `pickup_drop_locations`";
		$sWhereWrk = "";
		$this->dropLocation->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->dropLocation, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->dropLocation->ViewValue = $this->dropLocation->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->dropLocation->ViewValue = $this->dropLocation->CurrentValue;
			}
		} else {
			$this->dropLocation->ViewValue = NULL;
		}
		$this->dropLocation->ViewCustomAttributes = "";

		// pickUpDate
		$this->pickUpDate->ViewValue = $this->pickUpDate->CurrentValue;
		$this->pickUpDate->ViewValue = ew_FormatDateTime($this->pickUpDate->ViewValue, 7);
		$this->pickUpDate->ViewCustomAttributes = "";

		// dropDate
		$this->dropDate->ViewValue = $this->dropDate->CurrentValue;
		$this->dropDate->ViewValue = ew_FormatDateTime($this->dropDate->ViewValue, 7);
		$this->dropDate->ViewCustomAttributes = "";

		// noOfDays
		$this->noOfDays->ViewValue = $this->noOfDays->CurrentValue;
		$this->noOfDays->ViewCustomAttributes = "";

		// bookingTerm
		$this->bookingTerm->ViewValue = $this->bookingTerm->CurrentValue;
		$this->bookingTerm->ViewCustomAttributes = "";

		// slab
		$this->slab->ViewValue = $this->slab->CurrentValue;
		$this->slab->ViewCustomAttributes = "";

		// orangeCard
		$this->orangeCard->ViewValue = $this->orangeCard->CurrentValue;
		$this->orangeCard->ViewCustomAttributes = "";

		// gps
		$this->gps->ViewValue = $this->gps->CurrentValue;
		$this->gps->ViewCustomAttributes = "";

		// deliveryCharge
		$this->deliveryCharge->ViewValue = $this->deliveryCharge->CurrentValue;
		$this->deliveryCharge->ViewCustomAttributes = "";

		// collectionCharge
		$this->collectionCharge->ViewValue = $this->collectionCharge->CurrentValue;
		$this->collectionCharge->ViewCustomAttributes = "";

		// rentalAmount
		$this->rentalAmount->ViewValue = $this->rentalAmount->CurrentValue;
		$this->rentalAmount->ViewCustomAttributes = "";

		// totalAmount
		$this->totalAmount->ViewValue = $this->totalAmount->CurrentValue;
		$this->totalAmount->ViewCustomAttributes = "";

		// vat
		$this->vat->ViewValue = $this->vat->CurrentValue;
		$this->vat->ViewCustomAttributes = "";

		// grandTotal
		$this->grandTotal->ViewValue = $this->grandTotal->CurrentValue;
		$this->grandTotal->ViewCustomAttributes = "";

		// deliveryAddress
		$this->deliveryAddress->ViewValue = $this->deliveryAddress->CurrentValue;
		$this->deliveryAddress->ViewCustomAttributes = "";

		// paymentMethod
		if (strval($this->paymentMethod->CurrentValue) <> "") {
			$this->paymentMethod->ViewValue = $this->paymentMethod->OptionCaption($this->paymentMethod->CurrentValue);
		} else {
			$this->paymentMethod->ViewValue = NULL;
		}
		$this->paymentMethod->ViewCustomAttributes = "";

		// dateCreated
		$this->dateCreated->ViewValue = $this->dateCreated->CurrentValue;
		$this->dateCreated->ViewValue = ew_FormatDateTime($this->dateCreated->ViewValue, 7);
		$this->dateCreated->ViewCustomAttributes = "";

			// bookingNumber
			$this->bookingNumber->LinkCustomAttributes = "";
			$this->bookingNumber->HrefValue = "";
			$this->bookingNumber->TooltipValue = "";

			// userID
			$this->_userID->LinkCustomAttributes = "";
			$this->_userID->HrefValue = "";
			$this->_userID->TooltipValue = "";

			// payDriveCarID
			$this->payDriveCarID->LinkCustomAttributes = "";
			$this->payDriveCarID->HrefValue = "";
			$this->payDriveCarID->TooltipValue = "";

			// pickUpLocation
			$this->pickUpLocation->LinkCustomAttributes = "";
			$this->pickUpLocation->HrefValue = "";
			$this->pickUpLocation->TooltipValue = "";

			// dropLocation
			$this->dropLocation->LinkCustomAttributes = "";
			$this->dropLocation->HrefValue = "";
			$this->dropLocation->TooltipValue = "";

			// pickUpDate
			$this->pickUpDate->LinkCustomAttributes = "";
			$this->pickUpDate->HrefValue = "";
			$this->pickUpDate->TooltipValue = "";

			// dropDate
			$this->dropDate->LinkCustomAttributes = "";
			$this->dropDate->HrefValue = "";
			$this->dropDate->TooltipValue = "";

			// noOfDays
			$this->noOfDays->LinkCustomAttributes = "";
			$this->noOfDays->HrefValue = "";
			$this->noOfDays->TooltipValue = "";

			// bookingTerm
			$this->bookingTerm->LinkCustomAttributes = "";
			$this->bookingTerm->HrefValue = "";
			$this->bookingTerm->TooltipValue = "";

			// slab
			$this->slab->LinkCustomAttributes = "";
			$this->slab->HrefValue = "";
			$this->slab->TooltipValue = "";

			// orangeCard
			$this->orangeCard->LinkCustomAttributes = "";
			$this->orangeCard->HrefValue = "";
			$this->orangeCard->TooltipValue = "";

			// gps
			$this->gps->LinkCustomAttributes = "";
			$this->gps->HrefValue = "";
			$this->gps->TooltipValue = "";

			// deliveryCharge
			$this->deliveryCharge->LinkCustomAttributes = "";
			$this->deliveryCharge->HrefValue = "";
			$this->deliveryCharge->TooltipValue = "";

			// collectionCharge
			$this->collectionCharge->LinkCustomAttributes = "";
			$this->collectionCharge->HrefValue = "";
			$this->collectionCharge->TooltipValue = "";

			// rentalAmount
			$this->rentalAmount->LinkCustomAttributes = "";
			$this->rentalAmount->HrefValue = "";
			$this->rentalAmount->TooltipValue = "";

			// totalAmount
			$this->totalAmount->LinkCustomAttributes = "";
			$this->totalAmount->HrefValue = "";
			$this->totalAmount->TooltipValue = "";

			// vat
			$this->vat->LinkCustomAttributes = "";
			$this->vat->HrefValue = "";
			$this->vat->TooltipValue = "";

			// grandTotal
			$this->grandTotal->LinkCustomAttributes = "";
			$this->grandTotal->HrefValue = "";
			$this->grandTotal->TooltipValue = "";

			// deliveryAddress
			$this->deliveryAddress->LinkCustomAttributes = "";
			$this->deliveryAddress->HrefValue = "";
			$this->deliveryAddress->TooltipValue = "";

			// paymentMethod
			$this->paymentMethod->LinkCustomAttributes = "";
			$this->paymentMethod->HrefValue = "";
			$this->paymentMethod->TooltipValue = "";

			// dateCreated
			$this->dateCreated->LinkCustomAttributes = "";
			$this->dateCreated->HrefValue = "";
			$this->dateCreated->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// bookingNumber
			$this->bookingNumber->EditAttrs["class"] = "form-control";
			$this->bookingNumber->EditCustomAttributes = "";
			$this->bookingNumber->EditValue = ew_HtmlEncode($this->bookingNumber->CurrentValue);
			$this->bookingNumber->PlaceHolder = ew_RemoveHtml($this->bookingNumber->FldCaption());

			// userID
			$this->_userID->EditAttrs["class"] = "form-control";
			$this->_userID->EditCustomAttributes = "";
			if (trim(strval($this->_userID->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`userID`" . ew_SearchString("=", $this->_userID->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `userID`, `firstName` AS `DispFld`, `lastName` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `users`";
			$sWhereWrk = "";
			$this->_userID->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->_userID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->_userID->EditValue = $arwrk;

			// payDriveCarID
			$this->payDriveCarID->EditAttrs["class"] = "form-control";
			$this->payDriveCarID->EditCustomAttributes = "";
			if (trim(strval($this->payDriveCarID->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`payDriveCarID`" . ew_SearchString("=", $this->payDriveCarID->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `payDriveCarID`, `carTitle` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `pay_as_you_drive`";
			$sWhereWrk = "";
			$this->payDriveCarID->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->payDriveCarID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->payDriveCarID->EditValue = $arwrk;

			// pickUpLocation
			$this->pickUpLocation->EditAttrs["class"] = "form-control";
			$this->pickUpLocation->EditCustomAttributes = "";
			if (trim(strval($this->pickUpLocation->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`pdLocationID`" . ew_SearchString("=", $this->pickUpLocation->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `pdLocationID`, `location` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `pickup_drop_locations`";
			$sWhereWrk = "";
			$this->pickUpLocation->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->pickUpLocation, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->pickUpLocation->EditValue = $arwrk;

			// dropLocation
			$this->dropLocation->EditAttrs["class"] = "form-control";
			$this->dropLocation->EditCustomAttributes = "";
			if (trim(strval($this->dropLocation->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`pdLocationID`" . ew_SearchString("=", $this->dropLocation->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `pdLocationID`, `location` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `pickup_drop_locations`";
			$sWhereWrk = "";
			$this->dropLocation->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->dropLocation, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->dropLocation->EditValue = $arwrk;

			// pickUpDate
			$this->pickUpDate->EditAttrs["class"] = "form-control";
			$this->pickUpDate->EditCustomAttributes = "";
			$this->pickUpDate->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->pickUpDate->CurrentValue, 7));
			$this->pickUpDate->PlaceHolder = ew_RemoveHtml($this->pickUpDate->FldCaption());

			// dropDate
			$this->dropDate->EditAttrs["class"] = "form-control";
			$this->dropDate->EditCustomAttributes = "";
			$this->dropDate->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->dropDate->CurrentValue, 7));
			$this->dropDate->PlaceHolder = ew_RemoveHtml($this->dropDate->FldCaption());

			// noOfDays
			$this->noOfDays->EditAttrs["class"] = "form-control";
			$this->noOfDays->EditCustomAttributes = "";
			$this->noOfDays->EditValue = ew_HtmlEncode($this->noOfDays->CurrentValue);
			$this->noOfDays->PlaceHolder = ew_RemoveHtml($this->noOfDays->FldCaption());

			// bookingTerm
			$this->bookingTerm->EditAttrs["class"] = "form-control";
			$this->bookingTerm->EditCustomAttributes = "";
			$this->bookingTerm->EditValue = ew_HtmlEncode($this->bookingTerm->CurrentValue);
			$this->bookingTerm->PlaceHolder = ew_RemoveHtml($this->bookingTerm->FldCaption());

			// slab
			$this->slab->EditAttrs["class"] = "form-control";
			$this->slab->EditCustomAttributes = "";
			$this->slab->EditValue = ew_HtmlEncode($this->slab->CurrentValue);
			$this->slab->PlaceHolder = ew_RemoveHtml($this->slab->FldCaption());

			// orangeCard
			$this->orangeCard->EditAttrs["class"] = "form-control";
			$this->orangeCard->EditCustomAttributes = "";
			$this->orangeCard->EditValue = ew_HtmlEncode($this->orangeCard->CurrentValue);
			$this->orangeCard->PlaceHolder = ew_RemoveHtml($this->orangeCard->FldCaption());
			if (strval($this->orangeCard->EditValue) <> "" && is_numeric($this->orangeCard->EditValue)) $this->orangeCard->EditValue = ew_FormatNumber($this->orangeCard->EditValue, -2, -1, -2, 0);

			// gps
			$this->gps->EditAttrs["class"] = "form-control";
			$this->gps->EditCustomAttributes = "";
			$this->gps->EditValue = ew_HtmlEncode($this->gps->CurrentValue);
			$this->gps->PlaceHolder = ew_RemoveHtml($this->gps->FldCaption());

			// deliveryCharge
			$this->deliveryCharge->EditAttrs["class"] = "form-control";
			$this->deliveryCharge->EditCustomAttributes = "";
			$this->deliveryCharge->EditValue = ew_HtmlEncode($this->deliveryCharge->CurrentValue);
			$this->deliveryCharge->PlaceHolder = ew_RemoveHtml($this->deliveryCharge->FldCaption());
			if (strval($this->deliveryCharge->EditValue) <> "" && is_numeric($this->deliveryCharge->EditValue)) $this->deliveryCharge->EditValue = ew_FormatNumber($this->deliveryCharge->EditValue, -2, -1, -2, 0);

			// collectionCharge
			$this->collectionCharge->EditAttrs["class"] = "form-control";
			$this->collectionCharge->EditCustomAttributes = "";
			$this->collectionCharge->EditValue = ew_HtmlEncode($this->collectionCharge->CurrentValue);
			$this->collectionCharge->PlaceHolder = ew_RemoveHtml($this->collectionCharge->FldCaption());
			if (strval($this->collectionCharge->EditValue) <> "" && is_numeric($this->collectionCharge->EditValue)) $this->collectionCharge->EditValue = ew_FormatNumber($this->collectionCharge->EditValue, -2, -1, -2, 0);

			// rentalAmount
			$this->rentalAmount->EditAttrs["class"] = "form-control";
			$this->rentalAmount->EditCustomAttributes = "";
			$this->rentalAmount->EditValue = ew_HtmlEncode($this->rentalAmount->CurrentValue);
			$this->rentalAmount->PlaceHolder = ew_RemoveHtml($this->rentalAmount->FldCaption());
			if (strval($this->rentalAmount->EditValue) <> "" && is_numeric($this->rentalAmount->EditValue)) $this->rentalAmount->EditValue = ew_FormatNumber($this->rentalAmount->EditValue, -2, -1, -2, 0);

			// totalAmount
			$this->totalAmount->EditAttrs["class"] = "form-control";
			$this->totalAmount->EditCustomAttributes = "";
			$this->totalAmount->EditValue = ew_HtmlEncode($this->totalAmount->CurrentValue);
			$this->totalAmount->PlaceHolder = ew_RemoveHtml($this->totalAmount->FldCaption());
			if (strval($this->totalAmount->EditValue) <> "" && is_numeric($this->totalAmount->EditValue)) $this->totalAmount->EditValue = ew_FormatNumber($this->totalAmount->EditValue, -2, -1, -2, 0);

			// vat
			$this->vat->EditAttrs["class"] = "form-control";
			$this->vat->EditCustomAttributes = "";
			$this->vat->EditValue = ew_HtmlEncode($this->vat->CurrentValue);
			$this->vat->PlaceHolder = ew_RemoveHtml($this->vat->FldCaption());
			if (strval($this->vat->EditValue) <> "" && is_numeric($this->vat->EditValue)) $this->vat->EditValue = ew_FormatNumber($this->vat->EditValue, -2, -1, -2, 0);

			// grandTotal
			$this->grandTotal->EditAttrs["class"] = "form-control";
			$this->grandTotal->EditCustomAttributes = "";
			$this->grandTotal->EditValue = ew_HtmlEncode($this->grandTotal->CurrentValue);
			$this->grandTotal->PlaceHolder = ew_RemoveHtml($this->grandTotal->FldCaption());
			if (strval($this->grandTotal->EditValue) <> "" && is_numeric($this->grandTotal->EditValue)) $this->grandTotal->EditValue = ew_FormatNumber($this->grandTotal->EditValue, -2, -1, -2, 0);

			// deliveryAddress
			$this->deliveryAddress->EditAttrs["class"] = "form-control";
			$this->deliveryAddress->EditCustomAttributes = "";
			$this->deliveryAddress->EditValue = ew_HtmlEncode($this->deliveryAddress->CurrentValue);
			$this->deliveryAddress->PlaceHolder = ew_RemoveHtml($this->deliveryAddress->FldCaption());

			// paymentMethod
			$this->paymentMethod->EditCustomAttributes = "";
			$this->paymentMethod->EditValue = $this->paymentMethod->Options(FALSE);

			// dateCreated
			$this->dateCreated->EditAttrs["class"] = "form-control";
			$this->dateCreated->EditCustomAttributes = "";
			$this->dateCreated->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->dateCreated->CurrentValue, 7));
			$this->dateCreated->PlaceHolder = ew_RemoveHtml($this->dateCreated->FldCaption());

			// Add refer script
			// bookingNumber

			$this->bookingNumber->LinkCustomAttributes = "";
			$this->bookingNumber->HrefValue = "";

			// userID
			$this->_userID->LinkCustomAttributes = "";
			$this->_userID->HrefValue = "";

			// payDriveCarID
			$this->payDriveCarID->LinkCustomAttributes = "";
			$this->payDriveCarID->HrefValue = "";

			// pickUpLocation
			$this->pickUpLocation->LinkCustomAttributes = "";
			$this->pickUpLocation->HrefValue = "";

			// dropLocation
			$this->dropLocation->LinkCustomAttributes = "";
			$this->dropLocation->HrefValue = "";

			// pickUpDate
			$this->pickUpDate->LinkCustomAttributes = "";
			$this->pickUpDate->HrefValue = "";

			// dropDate
			$this->dropDate->LinkCustomAttributes = "";
			$this->dropDate->HrefValue = "";

			// noOfDays
			$this->noOfDays->LinkCustomAttributes = "";
			$this->noOfDays->HrefValue = "";

			// bookingTerm
			$this->bookingTerm->LinkCustomAttributes = "";
			$this->bookingTerm->HrefValue = "";

			// slab
			$this->slab->LinkCustomAttributes = "";
			$this->slab->HrefValue = "";

			// orangeCard
			$this->orangeCard->LinkCustomAttributes = "";
			$this->orangeCard->HrefValue = "";

			// gps
			$this->gps->LinkCustomAttributes = "";
			$this->gps->HrefValue = "";

			// deliveryCharge
			$this->deliveryCharge->LinkCustomAttributes = "";
			$this->deliveryCharge->HrefValue = "";

			// collectionCharge
			$this->collectionCharge->LinkCustomAttributes = "";
			$this->collectionCharge->HrefValue = "";

			// rentalAmount
			$this->rentalAmount->LinkCustomAttributes = "";
			$this->rentalAmount->HrefValue = "";

			// totalAmount
			$this->totalAmount->LinkCustomAttributes = "";
			$this->totalAmount->HrefValue = "";

			// vat
			$this->vat->LinkCustomAttributes = "";
			$this->vat->HrefValue = "";

			// grandTotal
			$this->grandTotal->LinkCustomAttributes = "";
			$this->grandTotal->HrefValue = "";

			// deliveryAddress
			$this->deliveryAddress->LinkCustomAttributes = "";
			$this->deliveryAddress->HrefValue = "";

			// paymentMethod
			$this->paymentMethod->LinkCustomAttributes = "";
			$this->paymentMethod->HrefValue = "";

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
		if (!ew_CheckInteger($this->bookingNumber->FormValue)) {
			ew_AddMessage($gsFormError, $this->bookingNumber->FldErrMsg());
		}
		if (!ew_CheckEuroDate($this->pickUpDate->FormValue)) {
			ew_AddMessage($gsFormError, $this->pickUpDate->FldErrMsg());
		}
		if (!ew_CheckEuroDate($this->dropDate->FormValue)) {
			ew_AddMessage($gsFormError, $this->dropDate->FldErrMsg());
		}
		if (!ew_CheckInteger($this->noOfDays->FormValue)) {
			ew_AddMessage($gsFormError, $this->noOfDays->FldErrMsg());
		}
		if (!ew_CheckNumber($this->orangeCard->FormValue)) {
			ew_AddMessage($gsFormError, $this->orangeCard->FldErrMsg());
		}
		if (!ew_CheckNumber($this->deliveryCharge->FormValue)) {
			ew_AddMessage($gsFormError, $this->deliveryCharge->FldErrMsg());
		}
		if (!ew_CheckNumber($this->collectionCharge->FormValue)) {
			ew_AddMessage($gsFormError, $this->collectionCharge->FldErrMsg());
		}
		if (!ew_CheckNumber($this->rentalAmount->FormValue)) {
			ew_AddMessage($gsFormError, $this->rentalAmount->FldErrMsg());
		}
		if (!ew_CheckNumber($this->totalAmount->FormValue)) {
			ew_AddMessage($gsFormError, $this->totalAmount->FldErrMsg());
		}
		if (!ew_CheckNumber($this->vat->FormValue)) {
			ew_AddMessage($gsFormError, $this->vat->FldErrMsg());
		}
		if (!ew_CheckNumber($this->grandTotal->FormValue)) {
			ew_AddMessage($gsFormError, $this->grandTotal->FldErrMsg());
		}
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

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;
		$conn = &$this->Connection();

		// Load db values from rsold
		$this->LoadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = array();

		// bookingNumber
		$this->bookingNumber->SetDbValueDef($rsnew, $this->bookingNumber->CurrentValue, NULL, FALSE);

		// userID
		$this->_userID->SetDbValueDef($rsnew, $this->_userID->CurrentValue, NULL, FALSE);

		// payDriveCarID
		$this->payDriveCarID->SetDbValueDef($rsnew, $this->payDriveCarID->CurrentValue, NULL, FALSE);

		// pickUpLocation
		$this->pickUpLocation->SetDbValueDef($rsnew, $this->pickUpLocation->CurrentValue, NULL, FALSE);

		// dropLocation
		$this->dropLocation->SetDbValueDef($rsnew, $this->dropLocation->CurrentValue, NULL, FALSE);

		// pickUpDate
		$this->pickUpDate->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->pickUpDate->CurrentValue, 7), NULL, FALSE);

		// dropDate
		$this->dropDate->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->dropDate->CurrentValue, 7), NULL, FALSE);

		// noOfDays
		$this->noOfDays->SetDbValueDef($rsnew, $this->noOfDays->CurrentValue, NULL, FALSE);

		// bookingTerm
		$this->bookingTerm->SetDbValueDef($rsnew, $this->bookingTerm->CurrentValue, NULL, FALSE);

		// slab
		$this->slab->SetDbValueDef($rsnew, $this->slab->CurrentValue, NULL, FALSE);

		// orangeCard
		$this->orangeCard->SetDbValueDef($rsnew, $this->orangeCard->CurrentValue, NULL, FALSE);

		// gps
		$this->gps->SetDbValueDef($rsnew, $this->gps->CurrentValue, NULL, FALSE);

		// deliveryCharge
		$this->deliveryCharge->SetDbValueDef($rsnew, $this->deliveryCharge->CurrentValue, NULL, FALSE);

		// collectionCharge
		$this->collectionCharge->SetDbValueDef($rsnew, $this->collectionCharge->CurrentValue, NULL, FALSE);

		// rentalAmount
		$this->rentalAmount->SetDbValueDef($rsnew, $this->rentalAmount->CurrentValue, NULL, FALSE);

		// totalAmount
		$this->totalAmount->SetDbValueDef($rsnew, $this->totalAmount->CurrentValue, NULL, FALSE);

		// vat
		$this->vat->SetDbValueDef($rsnew, $this->vat->CurrentValue, NULL, FALSE);

		// grandTotal
		$this->grandTotal->SetDbValueDef($rsnew, $this->grandTotal->CurrentValue, NULL, FALSE);

		// deliveryAddress
		$this->deliveryAddress->SetDbValueDef($rsnew, $this->deliveryAddress->CurrentValue, NULL, FALSE);

		// paymentMethod
		$this->paymentMethod->SetDbValueDef($rsnew, $this->paymentMethod->CurrentValue, NULL, FALSE);

		// dateCreated
		$this->dateCreated->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->dateCreated->CurrentValue, 7), NULL, FALSE);

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("inb_bookings_pay_as_you_drivelist.php"), "", $this->TableVar, TRUE);
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
		$this->MultiPages = $pages;
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x__userID":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `userID` AS `LinkFld`, `firstName` AS `DispFld`, `lastName` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `users`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`userID` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->_userID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_payDriveCarID":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `payDriveCarID` AS `LinkFld`, `carTitle` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `pay_as_you_drive`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`payDriveCarID` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->payDriveCarID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_pickUpLocation":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `pdLocationID` AS `LinkFld`, `location` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `pickup_drop_locations`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`pdLocationID` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->pickUpLocation, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_dropLocation":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `pdLocationID` AS `LinkFld`, `location` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `pickup_drop_locations`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`pdLocationID` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->dropLocation, $sWhereWrk); // Call Lookup Selecting
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
if (!isset($inb_bookings_pay_as_you_drive_add)) $inb_bookings_pay_as_you_drive_add = new cinb_bookings_pay_as_you_drive_add();

// Page init
$inb_bookings_pay_as_you_drive_add->Page_Init();

// Page main
$inb_bookings_pay_as_you_drive_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inb_bookings_pay_as_you_drive_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = finb_bookings_pay_as_you_driveadd = new ew_Form("finb_bookings_pay_as_you_driveadd", "add");

// Validate form
finb_bookings_pay_as_you_driveadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_bookingNumber");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($inb_bookings_pay_as_you_drive->bookingNumber->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_pickUpDate");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($inb_bookings_pay_as_you_drive->pickUpDate->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_dropDate");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($inb_bookings_pay_as_you_drive->dropDate->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_noOfDays");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($inb_bookings_pay_as_you_drive->noOfDays->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_orangeCard");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($inb_bookings_pay_as_you_drive->orangeCard->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_deliveryCharge");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($inb_bookings_pay_as_you_drive->deliveryCharge->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_collectionCharge");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($inb_bookings_pay_as_you_drive->collectionCharge->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_rentalAmount");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($inb_bookings_pay_as_you_drive->rentalAmount->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_totalAmount");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($inb_bookings_pay_as_you_drive->totalAmount->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_vat");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($inb_bookings_pay_as_you_drive->vat->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_grandTotal");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($inb_bookings_pay_as_you_drive->grandTotal->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_dateCreated");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($inb_bookings_pay_as_you_drive->dateCreated->FldErrMsg()) ?>");

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
finb_bookings_pay_as_you_driveadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
finb_bookings_pay_as_you_driveadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Multi-Page
finb_bookings_pay_as_you_driveadd.MultiPage = new ew_MultiPage("finb_bookings_pay_as_you_driveadd");

// Dynamic selection lists
finb_bookings_pay_as_you_driveadd.Lists["x__userID"] = {"LinkField":"x__userID","Ajax":true,"AutoFill":false,"DisplayFields":["x_firstName","x_lastName","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"users"};
finb_bookings_pay_as_you_driveadd.Lists["x__userID"].Data = "<?php echo $inb_bookings_pay_as_you_drive_add->_userID->LookupFilterQuery(FALSE, "add") ?>";
finb_bookings_pay_as_you_driveadd.Lists["x_payDriveCarID"] = {"LinkField":"x_payDriveCarID","Ajax":true,"AutoFill":false,"DisplayFields":["x_carTitle","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"pay_as_you_drive"};
finb_bookings_pay_as_you_driveadd.Lists["x_payDriveCarID"].Data = "<?php echo $inb_bookings_pay_as_you_drive_add->payDriveCarID->LookupFilterQuery(FALSE, "add") ?>";
finb_bookings_pay_as_you_driveadd.Lists["x_pickUpLocation"] = {"LinkField":"x_pdLocationID","Ajax":true,"AutoFill":false,"DisplayFields":["x_location","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"pickup_drop_locations"};
finb_bookings_pay_as_you_driveadd.Lists["x_pickUpLocation"].Data = "<?php echo $inb_bookings_pay_as_you_drive_add->pickUpLocation->LookupFilterQuery(FALSE, "add") ?>";
finb_bookings_pay_as_you_driveadd.Lists["x_dropLocation"] = {"LinkField":"x_pdLocationID","Ajax":true,"AutoFill":false,"DisplayFields":["x_location","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"pickup_drop_locations"};
finb_bookings_pay_as_you_driveadd.Lists["x_dropLocation"].Data = "<?php echo $inb_bookings_pay_as_you_drive_add->dropLocation->LookupFilterQuery(FALSE, "add") ?>";
finb_bookings_pay_as_you_driveadd.Lists["x_paymentMethod"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
finb_bookings_pay_as_you_driveadd.Lists["x_paymentMethod"].Options = <?php echo json_encode($inb_bookings_pay_as_you_drive_add->paymentMethod->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $inb_bookings_pay_as_you_drive_add->ShowPageHeader(); ?>
<?php
$inb_bookings_pay_as_you_drive_add->ShowMessage();
?>
<form name="finb_bookings_pay_as_you_driveadd" id="finb_bookings_pay_as_you_driveadd" class="<?php echo $inb_bookings_pay_as_you_drive_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($inb_bookings_pay_as_you_drive_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $inb_bookings_pay_as_you_drive_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inb_bookings_pay_as_you_drive">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($inb_bookings_pay_as_you_drive_add->IsModal) ?>">
<div class="ewMultiPage"><!-- multi-page -->
<div class="nav-tabs-custom" id="inb_bookings_pay_as_you_drive_add"><!-- multi-page .nav-tabs-custom -->
	<ul class="nav<?php echo $inb_bookings_pay_as_you_drive_add->MultiPages->NavStyle() ?>">
		<li<?php echo $inb_bookings_pay_as_you_drive_add->MultiPages->TabStyle("1") ?>><a href="#tab_inb_bookings_pay_as_you_drive1" data-toggle="tab"><?php echo $inb_bookings_pay_as_you_drive->PageCaption(1) ?></a></li>
		<li<?php echo $inb_bookings_pay_as_you_drive_add->MultiPages->TabStyle("2") ?>><a href="#tab_inb_bookings_pay_as_you_drive2" data-toggle="tab"><?php echo $inb_bookings_pay_as_you_drive->PageCaption(2) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page .nav-tabs-custom .tab-content -->
		<div class="tab-pane<?php echo $inb_bookings_pay_as_you_drive_add->MultiPages->PageStyle("1") ?>" id="tab_inb_bookings_pay_as_you_drive1"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($inb_bookings_pay_as_you_drive->bookingNumber->Visible) { // bookingNumber ?>
	<div id="r_bookingNumber" class="form-group">
		<label id="elh_inb_bookings_pay_as_you_drive_bookingNumber" for="x_bookingNumber" class="<?php echo $inb_bookings_pay_as_you_drive_add->LeftColumnClass ?>"><?php echo $inb_bookings_pay_as_you_drive->bookingNumber->FldCaption() ?></label>
		<div class="<?php echo $inb_bookings_pay_as_you_drive_add->RightColumnClass ?>"><div<?php echo $inb_bookings_pay_as_you_drive->bookingNumber->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_bookingNumber">
<input type="text" data-table="inb_bookings_pay_as_you_drive" data-field="x_bookingNumber" data-page="1" name="x_bookingNumber" id="x_bookingNumber" size="30" placeholder="<?php echo ew_HtmlEncode($inb_bookings_pay_as_you_drive->bookingNumber->getPlaceHolder()) ?>" value="<?php echo $inb_bookings_pay_as_you_drive->bookingNumber->EditValue ?>"<?php echo $inb_bookings_pay_as_you_drive->bookingNumber->EditAttributes() ?>>
</span>
<?php echo $inb_bookings_pay_as_you_drive->bookingNumber->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->_userID->Visible) { // userID ?>
	<div id="r__userID" class="form-group">
		<label id="elh_inb_bookings_pay_as_you_drive__userID" for="x__userID" class="<?php echo $inb_bookings_pay_as_you_drive_add->LeftColumnClass ?>"><?php echo $inb_bookings_pay_as_you_drive->_userID->FldCaption() ?></label>
		<div class="<?php echo $inb_bookings_pay_as_you_drive_add->RightColumnClass ?>"><div<?php echo $inb_bookings_pay_as_you_drive->_userID->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive__userID">
<select data-table="inb_bookings_pay_as_you_drive" data-field="x__userID" data-page="1" data-value-separator="<?php echo $inb_bookings_pay_as_you_drive->_userID->DisplayValueSeparatorAttribute() ?>" id="x__userID" name="x__userID"<?php echo $inb_bookings_pay_as_you_drive->_userID->EditAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->_userID->SelectOptionListHtml("x__userID") ?>
</select>
</span>
<?php echo $inb_bookings_pay_as_you_drive->_userID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->payDriveCarID->Visible) { // payDriveCarID ?>
	<div id="r_payDriveCarID" class="form-group">
		<label id="elh_inb_bookings_pay_as_you_drive_payDriveCarID" for="x_payDriveCarID" class="<?php echo $inb_bookings_pay_as_you_drive_add->LeftColumnClass ?>"><?php echo $inb_bookings_pay_as_you_drive->payDriveCarID->FldCaption() ?></label>
		<div class="<?php echo $inb_bookings_pay_as_you_drive_add->RightColumnClass ?>"><div<?php echo $inb_bookings_pay_as_you_drive->payDriveCarID->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_payDriveCarID">
<select data-table="inb_bookings_pay_as_you_drive" data-field="x_payDriveCarID" data-page="1" data-value-separator="<?php echo $inb_bookings_pay_as_you_drive->payDriveCarID->DisplayValueSeparatorAttribute() ?>" id="x_payDriveCarID" name="x_payDriveCarID"<?php echo $inb_bookings_pay_as_you_drive->payDriveCarID->EditAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->payDriveCarID->SelectOptionListHtml("x_payDriveCarID") ?>
</select>
</span>
<?php echo $inb_bookings_pay_as_you_drive->payDriveCarID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->pickUpLocation->Visible) { // pickUpLocation ?>
	<div id="r_pickUpLocation" class="form-group">
		<label id="elh_inb_bookings_pay_as_you_drive_pickUpLocation" for="x_pickUpLocation" class="<?php echo $inb_bookings_pay_as_you_drive_add->LeftColumnClass ?>"><?php echo $inb_bookings_pay_as_you_drive->pickUpLocation->FldCaption() ?></label>
		<div class="<?php echo $inb_bookings_pay_as_you_drive_add->RightColumnClass ?>"><div<?php echo $inb_bookings_pay_as_you_drive->pickUpLocation->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_pickUpLocation">
<select data-table="inb_bookings_pay_as_you_drive" data-field="x_pickUpLocation" data-page="1" data-value-separator="<?php echo $inb_bookings_pay_as_you_drive->pickUpLocation->DisplayValueSeparatorAttribute() ?>" id="x_pickUpLocation" name="x_pickUpLocation"<?php echo $inb_bookings_pay_as_you_drive->pickUpLocation->EditAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->pickUpLocation->SelectOptionListHtml("x_pickUpLocation") ?>
</select>
</span>
<?php echo $inb_bookings_pay_as_you_drive->pickUpLocation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->dropLocation->Visible) { // dropLocation ?>
	<div id="r_dropLocation" class="form-group">
		<label id="elh_inb_bookings_pay_as_you_drive_dropLocation" for="x_dropLocation" class="<?php echo $inb_bookings_pay_as_you_drive_add->LeftColumnClass ?>"><?php echo $inb_bookings_pay_as_you_drive->dropLocation->FldCaption() ?></label>
		<div class="<?php echo $inb_bookings_pay_as_you_drive_add->RightColumnClass ?>"><div<?php echo $inb_bookings_pay_as_you_drive->dropLocation->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_dropLocation">
<select data-table="inb_bookings_pay_as_you_drive" data-field="x_dropLocation" data-page="1" data-value-separator="<?php echo $inb_bookings_pay_as_you_drive->dropLocation->DisplayValueSeparatorAttribute() ?>" id="x_dropLocation" name="x_dropLocation"<?php echo $inb_bookings_pay_as_you_drive->dropLocation->EditAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->dropLocation->SelectOptionListHtml("x_dropLocation") ?>
</select>
</span>
<?php echo $inb_bookings_pay_as_you_drive->dropLocation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->pickUpDate->Visible) { // pickUpDate ?>
	<div id="r_pickUpDate" class="form-group">
		<label id="elh_inb_bookings_pay_as_you_drive_pickUpDate" for="x_pickUpDate" class="<?php echo $inb_bookings_pay_as_you_drive_add->LeftColumnClass ?>"><?php echo $inb_bookings_pay_as_you_drive->pickUpDate->FldCaption() ?></label>
		<div class="<?php echo $inb_bookings_pay_as_you_drive_add->RightColumnClass ?>"><div<?php echo $inb_bookings_pay_as_you_drive->pickUpDate->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_pickUpDate">
<input type="text" data-table="inb_bookings_pay_as_you_drive" data-field="x_pickUpDate" data-page="1" data-format="7" name="x_pickUpDate" id="x_pickUpDate" placeholder="<?php echo ew_HtmlEncode($inb_bookings_pay_as_you_drive->pickUpDate->getPlaceHolder()) ?>" value="<?php echo $inb_bookings_pay_as_you_drive->pickUpDate->EditValue ?>"<?php echo $inb_bookings_pay_as_you_drive->pickUpDate->EditAttributes() ?>>
<?php if (!$inb_bookings_pay_as_you_drive->pickUpDate->ReadOnly && !$inb_bookings_pay_as_you_drive->pickUpDate->Disabled && !isset($inb_bookings_pay_as_you_drive->pickUpDate->EditAttrs["readonly"]) && !isset($inb_bookings_pay_as_you_drive->pickUpDate->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("finb_bookings_pay_as_you_driveadd", "x_pickUpDate", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php echo $inb_bookings_pay_as_you_drive->pickUpDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->dropDate->Visible) { // dropDate ?>
	<div id="r_dropDate" class="form-group">
		<label id="elh_inb_bookings_pay_as_you_drive_dropDate" for="x_dropDate" class="<?php echo $inb_bookings_pay_as_you_drive_add->LeftColumnClass ?>"><?php echo $inb_bookings_pay_as_you_drive->dropDate->FldCaption() ?></label>
		<div class="<?php echo $inb_bookings_pay_as_you_drive_add->RightColumnClass ?>"><div<?php echo $inb_bookings_pay_as_you_drive->dropDate->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_dropDate">
<input type="text" data-table="inb_bookings_pay_as_you_drive" data-field="x_dropDate" data-page="1" data-format="7" name="x_dropDate" id="x_dropDate" placeholder="<?php echo ew_HtmlEncode($inb_bookings_pay_as_you_drive->dropDate->getPlaceHolder()) ?>" value="<?php echo $inb_bookings_pay_as_you_drive->dropDate->EditValue ?>"<?php echo $inb_bookings_pay_as_you_drive->dropDate->EditAttributes() ?>>
<?php if (!$inb_bookings_pay_as_you_drive->dropDate->ReadOnly && !$inb_bookings_pay_as_you_drive->dropDate->Disabled && !isset($inb_bookings_pay_as_you_drive->dropDate->EditAttrs["readonly"]) && !isset($inb_bookings_pay_as_you_drive->dropDate->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("finb_bookings_pay_as_you_driveadd", "x_dropDate", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php echo $inb_bookings_pay_as_you_drive->dropDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->noOfDays->Visible) { // noOfDays ?>
	<div id="r_noOfDays" class="form-group">
		<label id="elh_inb_bookings_pay_as_you_drive_noOfDays" for="x_noOfDays" class="<?php echo $inb_bookings_pay_as_you_drive_add->LeftColumnClass ?>"><?php echo $inb_bookings_pay_as_you_drive->noOfDays->FldCaption() ?></label>
		<div class="<?php echo $inb_bookings_pay_as_you_drive_add->RightColumnClass ?>"><div<?php echo $inb_bookings_pay_as_you_drive->noOfDays->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_noOfDays">
<input type="text" data-table="inb_bookings_pay_as_you_drive" data-field="x_noOfDays" data-page="1" name="x_noOfDays" id="x_noOfDays" size="30" placeholder="<?php echo ew_HtmlEncode($inb_bookings_pay_as_you_drive->noOfDays->getPlaceHolder()) ?>" value="<?php echo $inb_bookings_pay_as_you_drive->noOfDays->EditValue ?>"<?php echo $inb_bookings_pay_as_you_drive->noOfDays->EditAttributes() ?>>
</span>
<?php echo $inb_bookings_pay_as_you_drive->noOfDays->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->bookingTerm->Visible) { // bookingTerm ?>
	<div id="r_bookingTerm" class="form-group">
		<label id="elh_inb_bookings_pay_as_you_drive_bookingTerm" for="x_bookingTerm" class="<?php echo $inb_bookings_pay_as_you_drive_add->LeftColumnClass ?>"><?php echo $inb_bookings_pay_as_you_drive->bookingTerm->FldCaption() ?></label>
		<div class="<?php echo $inb_bookings_pay_as_you_drive_add->RightColumnClass ?>"><div<?php echo $inb_bookings_pay_as_you_drive->bookingTerm->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_bookingTerm">
<input type="text" data-table="inb_bookings_pay_as_you_drive" data-field="x_bookingTerm" data-page="1" name="x_bookingTerm" id="x_bookingTerm" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_bookings_pay_as_you_drive->bookingTerm->getPlaceHolder()) ?>" value="<?php echo $inb_bookings_pay_as_you_drive->bookingTerm->EditValue ?>"<?php echo $inb_bookings_pay_as_you_drive->bookingTerm->EditAttributes() ?>>
</span>
<?php echo $inb_bookings_pay_as_you_drive->bookingTerm->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->slab->Visible) { // slab ?>
	<div id="r_slab" class="form-group">
		<label id="elh_inb_bookings_pay_as_you_drive_slab" for="x_slab" class="<?php echo $inb_bookings_pay_as_you_drive_add->LeftColumnClass ?>"><?php echo $inb_bookings_pay_as_you_drive->slab->FldCaption() ?></label>
		<div class="<?php echo $inb_bookings_pay_as_you_drive_add->RightColumnClass ?>"><div<?php echo $inb_bookings_pay_as_you_drive->slab->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_slab">
<input type="text" data-table="inb_bookings_pay_as_you_drive" data-field="x_slab" data-page="1" name="x_slab" id="x_slab" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_bookings_pay_as_you_drive->slab->getPlaceHolder()) ?>" value="<?php echo $inb_bookings_pay_as_you_drive->slab->EditValue ?>"<?php echo $inb_bookings_pay_as_you_drive->slab->EditAttributes() ?>>
</span>
<?php echo $inb_bookings_pay_as_you_drive->slab->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->rentalAmount->Visible) { // rentalAmount ?>
	<div id="r_rentalAmount" class="form-group">
		<label id="elh_inb_bookings_pay_as_you_drive_rentalAmount" for="x_rentalAmount" class="<?php echo $inb_bookings_pay_as_you_drive_add->LeftColumnClass ?>"><?php echo $inb_bookings_pay_as_you_drive->rentalAmount->FldCaption() ?></label>
		<div class="<?php echo $inb_bookings_pay_as_you_drive_add->RightColumnClass ?>"><div<?php echo $inb_bookings_pay_as_you_drive->rentalAmount->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_rentalAmount">
<input type="text" data-table="inb_bookings_pay_as_you_drive" data-field="x_rentalAmount" data-page="1" name="x_rentalAmount" id="x_rentalAmount" size="30" placeholder="<?php echo ew_HtmlEncode($inb_bookings_pay_as_you_drive->rentalAmount->getPlaceHolder()) ?>" value="<?php echo $inb_bookings_pay_as_you_drive->rentalAmount->EditValue ?>"<?php echo $inb_bookings_pay_as_you_drive->rentalAmount->EditAttributes() ?>>
</span>
<?php echo $inb_bookings_pay_as_you_drive->rentalAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->totalAmount->Visible) { // totalAmount ?>
	<div id="r_totalAmount" class="form-group">
		<label id="elh_inb_bookings_pay_as_you_drive_totalAmount" for="x_totalAmount" class="<?php echo $inb_bookings_pay_as_you_drive_add->LeftColumnClass ?>"><?php echo $inb_bookings_pay_as_you_drive->totalAmount->FldCaption() ?></label>
		<div class="<?php echo $inb_bookings_pay_as_you_drive_add->RightColumnClass ?>"><div<?php echo $inb_bookings_pay_as_you_drive->totalAmount->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_totalAmount">
<input type="text" data-table="inb_bookings_pay_as_you_drive" data-field="x_totalAmount" data-page="1" name="x_totalAmount" id="x_totalAmount" size="30" placeholder="<?php echo ew_HtmlEncode($inb_bookings_pay_as_you_drive->totalAmount->getPlaceHolder()) ?>" value="<?php echo $inb_bookings_pay_as_you_drive->totalAmount->EditValue ?>"<?php echo $inb_bookings_pay_as_you_drive->totalAmount->EditAttributes() ?>>
</span>
<?php echo $inb_bookings_pay_as_you_drive->totalAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->vat->Visible) { // vat ?>
	<div id="r_vat" class="form-group">
		<label id="elh_inb_bookings_pay_as_you_drive_vat" for="x_vat" class="<?php echo $inb_bookings_pay_as_you_drive_add->LeftColumnClass ?>"><?php echo $inb_bookings_pay_as_you_drive->vat->FldCaption() ?></label>
		<div class="<?php echo $inb_bookings_pay_as_you_drive_add->RightColumnClass ?>"><div<?php echo $inb_bookings_pay_as_you_drive->vat->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_vat">
<input type="text" data-table="inb_bookings_pay_as_you_drive" data-field="x_vat" data-page="1" name="x_vat" id="x_vat" size="30" placeholder="<?php echo ew_HtmlEncode($inb_bookings_pay_as_you_drive->vat->getPlaceHolder()) ?>" value="<?php echo $inb_bookings_pay_as_you_drive->vat->EditValue ?>"<?php echo $inb_bookings_pay_as_you_drive->vat->EditAttributes() ?>>
</span>
<?php echo $inb_bookings_pay_as_you_drive->vat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->grandTotal->Visible) { // grandTotal ?>
	<div id="r_grandTotal" class="form-group">
		<label id="elh_inb_bookings_pay_as_you_drive_grandTotal" for="x_grandTotal" class="<?php echo $inb_bookings_pay_as_you_drive_add->LeftColumnClass ?>"><?php echo $inb_bookings_pay_as_you_drive->grandTotal->FldCaption() ?></label>
		<div class="<?php echo $inb_bookings_pay_as_you_drive_add->RightColumnClass ?>"><div<?php echo $inb_bookings_pay_as_you_drive->grandTotal->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_grandTotal">
<input type="text" data-table="inb_bookings_pay_as_you_drive" data-field="x_grandTotal" data-page="1" name="x_grandTotal" id="x_grandTotal" size="30" placeholder="<?php echo ew_HtmlEncode($inb_bookings_pay_as_you_drive->grandTotal->getPlaceHolder()) ?>" value="<?php echo $inb_bookings_pay_as_you_drive->grandTotal->EditValue ?>"<?php echo $inb_bookings_pay_as_you_drive->grandTotal->EditAttributes() ?>>
</span>
<?php echo $inb_bookings_pay_as_you_drive->grandTotal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->deliveryAddress->Visible) { // deliveryAddress ?>
	<div id="r_deliveryAddress" class="form-group">
		<label id="elh_inb_bookings_pay_as_you_drive_deliveryAddress" for="x_deliveryAddress" class="<?php echo $inb_bookings_pay_as_you_drive_add->LeftColumnClass ?>"><?php echo $inb_bookings_pay_as_you_drive->deliveryAddress->FldCaption() ?></label>
		<div class="<?php echo $inb_bookings_pay_as_you_drive_add->RightColumnClass ?>"><div<?php echo $inb_bookings_pay_as_you_drive->deliveryAddress->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_deliveryAddress">
<input type="text" data-table="inb_bookings_pay_as_you_drive" data-field="x_deliveryAddress" data-page="1" name="x_deliveryAddress" id="x_deliveryAddress" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_bookings_pay_as_you_drive->deliveryAddress->getPlaceHolder()) ?>" value="<?php echo $inb_bookings_pay_as_you_drive->deliveryAddress->EditValue ?>"<?php echo $inb_bookings_pay_as_you_drive->deliveryAddress->EditAttributes() ?>>
</span>
<?php echo $inb_bookings_pay_as_you_drive->deliveryAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->paymentMethod->Visible) { // paymentMethod ?>
	<div id="r_paymentMethod" class="form-group">
		<label id="elh_inb_bookings_pay_as_you_drive_paymentMethod" class="<?php echo $inb_bookings_pay_as_you_drive_add->LeftColumnClass ?>"><?php echo $inb_bookings_pay_as_you_drive->paymentMethod->FldCaption() ?></label>
		<div class="<?php echo $inb_bookings_pay_as_you_drive_add->RightColumnClass ?>"><div<?php echo $inb_bookings_pay_as_you_drive->paymentMethod->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_paymentMethod">
<div id="tp_x_paymentMethod" class="ewTemplate"><input type="radio" data-table="inb_bookings_pay_as_you_drive" data-field="x_paymentMethod" data-page="1" data-value-separator="<?php echo $inb_bookings_pay_as_you_drive->paymentMethod->DisplayValueSeparatorAttribute() ?>" name="x_paymentMethod" id="x_paymentMethod" value="{value}"<?php echo $inb_bookings_pay_as_you_drive->paymentMethod->EditAttributes() ?>></div>
<div id="dsl_x_paymentMethod" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $inb_bookings_pay_as_you_drive->paymentMethod->RadioButtonListHtml(FALSE, "x_paymentMethod", 1) ?>
</div></div>
</span>
<?php echo $inb_bookings_pay_as_you_drive->paymentMethod->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->dateCreated->Visible) { // dateCreated ?>
	<div id="r_dateCreated" class="form-group">
		<label id="elh_inb_bookings_pay_as_you_drive_dateCreated" for="x_dateCreated" class="<?php echo $inb_bookings_pay_as_you_drive_add->LeftColumnClass ?>"><?php echo $inb_bookings_pay_as_you_drive->dateCreated->FldCaption() ?></label>
		<div class="<?php echo $inb_bookings_pay_as_you_drive_add->RightColumnClass ?>"><div<?php echo $inb_bookings_pay_as_you_drive->dateCreated->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_dateCreated">
<input type="text" data-table="inb_bookings_pay_as_you_drive" data-field="x_dateCreated" data-page="1" data-format="7" name="x_dateCreated" id="x_dateCreated" placeholder="<?php echo ew_HtmlEncode($inb_bookings_pay_as_you_drive->dateCreated->getPlaceHolder()) ?>" value="<?php echo $inb_bookings_pay_as_you_drive->dateCreated->EditValue ?>"<?php echo $inb_bookings_pay_as_you_drive->dateCreated->EditAttributes() ?>>
<?php if (!$inb_bookings_pay_as_you_drive->dateCreated->ReadOnly && !$inb_bookings_pay_as_you_drive->dateCreated->Disabled && !isset($inb_bookings_pay_as_you_drive->dateCreated->EditAttrs["readonly"]) && !isset($inb_bookings_pay_as_you_drive->dateCreated->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("finb_bookings_pay_as_you_driveadd", "x_dateCreated", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php echo $inb_bookings_pay_as_you_drive->dateCreated->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $inb_bookings_pay_as_you_drive_add->MultiPages->PageStyle("2") ?>" id="tab_inb_bookings_pay_as_you_drive2"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($inb_bookings_pay_as_you_drive->orangeCard->Visible) { // orangeCard ?>
	<div id="r_orangeCard" class="form-group">
		<label id="elh_inb_bookings_pay_as_you_drive_orangeCard" for="x_orangeCard" class="<?php echo $inb_bookings_pay_as_you_drive_add->LeftColumnClass ?>"><?php echo $inb_bookings_pay_as_you_drive->orangeCard->FldCaption() ?></label>
		<div class="<?php echo $inb_bookings_pay_as_you_drive_add->RightColumnClass ?>"><div<?php echo $inb_bookings_pay_as_you_drive->orangeCard->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_orangeCard">
<input type="text" data-table="inb_bookings_pay_as_you_drive" data-field="x_orangeCard" data-page="2" name="x_orangeCard" id="x_orangeCard" size="30" placeholder="<?php echo ew_HtmlEncode($inb_bookings_pay_as_you_drive->orangeCard->getPlaceHolder()) ?>" value="<?php echo $inb_bookings_pay_as_you_drive->orangeCard->EditValue ?>"<?php echo $inb_bookings_pay_as_you_drive->orangeCard->EditAttributes() ?>>
</span>
<?php echo $inb_bookings_pay_as_you_drive->orangeCard->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->gps->Visible) { // gps ?>
	<div id="r_gps" class="form-group">
		<label id="elh_inb_bookings_pay_as_you_drive_gps" for="x_gps" class="<?php echo $inb_bookings_pay_as_you_drive_add->LeftColumnClass ?>"><?php echo $inb_bookings_pay_as_you_drive->gps->FldCaption() ?></label>
		<div class="<?php echo $inb_bookings_pay_as_you_drive_add->RightColumnClass ?>"><div<?php echo $inb_bookings_pay_as_you_drive->gps->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_gps">
<input type="text" data-table="inb_bookings_pay_as_you_drive" data-field="x_gps" data-page="2" name="x_gps" id="x_gps" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_bookings_pay_as_you_drive->gps->getPlaceHolder()) ?>" value="<?php echo $inb_bookings_pay_as_you_drive->gps->EditValue ?>"<?php echo $inb_bookings_pay_as_you_drive->gps->EditAttributes() ?>>
</span>
<?php echo $inb_bookings_pay_as_you_drive->gps->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->deliveryCharge->Visible) { // deliveryCharge ?>
	<div id="r_deliveryCharge" class="form-group">
		<label id="elh_inb_bookings_pay_as_you_drive_deliveryCharge" for="x_deliveryCharge" class="<?php echo $inb_bookings_pay_as_you_drive_add->LeftColumnClass ?>"><?php echo $inb_bookings_pay_as_you_drive->deliveryCharge->FldCaption() ?></label>
		<div class="<?php echo $inb_bookings_pay_as_you_drive_add->RightColumnClass ?>"><div<?php echo $inb_bookings_pay_as_you_drive->deliveryCharge->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_deliveryCharge">
<input type="text" data-table="inb_bookings_pay_as_you_drive" data-field="x_deliveryCharge" data-page="2" name="x_deliveryCharge" id="x_deliveryCharge" size="30" placeholder="<?php echo ew_HtmlEncode($inb_bookings_pay_as_you_drive->deliveryCharge->getPlaceHolder()) ?>" value="<?php echo $inb_bookings_pay_as_you_drive->deliveryCharge->EditValue ?>"<?php echo $inb_bookings_pay_as_you_drive->deliveryCharge->EditAttributes() ?>>
</span>
<?php echo $inb_bookings_pay_as_you_drive->deliveryCharge->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->collectionCharge->Visible) { // collectionCharge ?>
	<div id="r_collectionCharge" class="form-group">
		<label id="elh_inb_bookings_pay_as_you_drive_collectionCharge" for="x_collectionCharge" class="<?php echo $inb_bookings_pay_as_you_drive_add->LeftColumnClass ?>"><?php echo $inb_bookings_pay_as_you_drive->collectionCharge->FldCaption() ?></label>
		<div class="<?php echo $inb_bookings_pay_as_you_drive_add->RightColumnClass ?>"><div<?php echo $inb_bookings_pay_as_you_drive->collectionCharge->CellAttributes() ?>>
<span id="el_inb_bookings_pay_as_you_drive_collectionCharge">
<input type="text" data-table="inb_bookings_pay_as_you_drive" data-field="x_collectionCharge" data-page="2" name="x_collectionCharge" id="x_collectionCharge" size="30" placeholder="<?php echo ew_HtmlEncode($inb_bookings_pay_as_you_drive->collectionCharge->getPlaceHolder()) ?>" value="<?php echo $inb_bookings_pay_as_you_drive->collectionCharge->EditValue ?>"<?php echo $inb_bookings_pay_as_you_drive->collectionCharge->EditAttributes() ?>>
</span>
<?php echo $inb_bookings_pay_as_you_drive->collectionCharge->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page .nav-tabs-custom .tab-content -->
</div><!-- /multi-page .nav-tabs-custom -->
</div><!-- /multi-page -->
<?php if (!$inb_bookings_pay_as_you_drive_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $inb_bookings_pay_as_you_drive_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $inb_bookings_pay_as_you_drive_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
finb_bookings_pay_as_you_driveadd.Init();
</script>
<?php
$inb_bookings_pay_as_you_drive_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$inb_bookings_pay_as_you_drive_add->Page_Terminate();
?>
