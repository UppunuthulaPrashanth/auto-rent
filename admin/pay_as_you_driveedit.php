<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "pay_as_you_driveinfo.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$pay_as_you_drive_edit = NULL; // Initialize page object first

class cpay_as_you_drive_edit extends cpay_as_you_drive {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'pay_as_you_drive';

	// Page object name
	var $PageObjName = 'pay_as_you_drive_edit';

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

		// Table object (pay_as_you_drive)
		if (!isset($GLOBALS["pay_as_you_drive"]) || get_class($GLOBALS["pay_as_you_drive"]) == "cpay_as_you_drive") {
			$GLOBALS["pay_as_you_drive"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["pay_as_you_drive"];
		}

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pay_as_you_drive', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("pay_as_you_drivelist.php"));
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
		$this->payDriveCarID->SetVisibility();
		$this->payDriveCarID->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
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
		$this->s1DailyAED->SetVisibility();
		$this->s1DailyKM->SetVisibility();
		$this->s2DailyAED->SetVisibility();
		$this->s2DailyKM->SetVisibility();
		$this->s3DailyAED->SetVisibility();
		$this->s3DailyKM->SetVisibility();
		$this->s4DailyAED->SetVisibility();
		$this->s4DailyKM->SetVisibility();
		$this->s5DailyAED->SetVisibility();
		$this->s5DailyKM->SetVisibility();
		$this->s1WeeklyAED->SetVisibility();
		$this->s1WeeklyKM->SetVisibility();
		$this->s2WeeklyAED->SetVisibility();
		$this->s2WeeklyKM->SetVisibility();
		$this->s3WeeklyAED->SetVisibility();
		$this->s3WeeklyKM->SetVisibility();
		$this->s4WeeklyAED->SetVisibility();
		$this->s4WeeklyKM->SetVisibility();
		$this->s5WeeklyAED->SetVisibility();
		$this->s5WeeklyKM->SetVisibility();
		$this->s1MonthlyAED->SetVisibility();
		$this->s1MonthlyKM->SetVisibility();
		$this->s2MonthlyAED->SetVisibility();
		$this->s2MonthlyKM->SetVisibility();
		$this->s3MonthlyAED->SetVisibility();
		$this->s3MonthlyKM->SetVisibility();
		$this->s4MonthlyAED->SetVisibility();
		$this->s4MonthlyKM->SetVisibility();
		$this->s5MonthlyAED->SetVisibility();
		$this->s5MonthlyKM->SetVisibility();
		$this->active->SetVisibility();
		$this->phase1OrangeCard->SetVisibility();
		$this->phase1GPS->SetVisibility();
		$this->phase1DeliveryCharges->SetVisibility();
		$this->phase1CollectionCharges->SetVisibility();
		$this->addon01KM->SetVisibility();
		$this->addon01Price->SetVisibility();
		$this->addon02KM->SetVisibility();
		$this->addon02Price->SetVisibility();
		$this->addon03KM->SetVisibility();
		$this->addon03Price->SetVisibility();
		$this->addon04KM->SetVisibility();
		$this->addon04Price->SetVisibility();
		$this->addon05KM->SetVisibility();
		$this->addon05Price->SetVisibility();

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
		global $EW_EXPORT, $pay_as_you_drive;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($pay_as_you_drive);
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
					if ($pageName == "pay_as_you_driveview.php")
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
			if ($objForm->HasValue("x_payDriveCarID")) {
				$this->payDriveCarID->setFormValue($objForm->GetValue("x_payDriveCarID"));
			}
		} else {
			$this->CurrentAction = "I"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (isset($_GET["payDriveCarID"])) {
				$this->payDriveCarID->setQueryStringValue($_GET["payDriveCarID"]);
				$loadByQuery = TRUE;
			} else {
				$this->payDriveCarID->CurrentValue = NULL;
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
					$this->Page_Terminate("pay_as_you_drivelist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "pay_as_you_drivelist.php")
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
		$this->image->Upload->Index = $objForm->Index;
		$this->image->Upload->UploadFile();
		$this->image->CurrentValue = $this->image->Upload->FileName;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->payDriveCarID->FldIsDetailKey)
			$this->payDriveCarID->setFormValue($objForm->GetValue("x_payDriveCarID"));
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
		if (!$this->s1DailyAED->FldIsDetailKey) {
			$this->s1DailyAED->setFormValue($objForm->GetValue("x_s1DailyAED"));
		}
		if (!$this->s1DailyKM->FldIsDetailKey) {
			$this->s1DailyKM->setFormValue($objForm->GetValue("x_s1DailyKM"));
		}
		if (!$this->s2DailyAED->FldIsDetailKey) {
			$this->s2DailyAED->setFormValue($objForm->GetValue("x_s2DailyAED"));
		}
		if (!$this->s2DailyKM->FldIsDetailKey) {
			$this->s2DailyKM->setFormValue($objForm->GetValue("x_s2DailyKM"));
		}
		if (!$this->s3DailyAED->FldIsDetailKey) {
			$this->s3DailyAED->setFormValue($objForm->GetValue("x_s3DailyAED"));
		}
		if (!$this->s3DailyKM->FldIsDetailKey) {
			$this->s3DailyKM->setFormValue($objForm->GetValue("x_s3DailyKM"));
		}
		if (!$this->s4DailyAED->FldIsDetailKey) {
			$this->s4DailyAED->setFormValue($objForm->GetValue("x_s4DailyAED"));
		}
		if (!$this->s4DailyKM->FldIsDetailKey) {
			$this->s4DailyKM->setFormValue($objForm->GetValue("x_s4DailyKM"));
		}
		if (!$this->s5DailyAED->FldIsDetailKey) {
			$this->s5DailyAED->setFormValue($objForm->GetValue("x_s5DailyAED"));
		}
		if (!$this->s5DailyKM->FldIsDetailKey) {
			$this->s5DailyKM->setFormValue($objForm->GetValue("x_s5DailyKM"));
		}
		if (!$this->s1WeeklyAED->FldIsDetailKey) {
			$this->s1WeeklyAED->setFormValue($objForm->GetValue("x_s1WeeklyAED"));
		}
		if (!$this->s1WeeklyKM->FldIsDetailKey) {
			$this->s1WeeklyKM->setFormValue($objForm->GetValue("x_s1WeeklyKM"));
		}
		if (!$this->s2WeeklyAED->FldIsDetailKey) {
			$this->s2WeeklyAED->setFormValue($objForm->GetValue("x_s2WeeklyAED"));
		}
		if (!$this->s2WeeklyKM->FldIsDetailKey) {
			$this->s2WeeklyKM->setFormValue($objForm->GetValue("x_s2WeeklyKM"));
		}
		if (!$this->s3WeeklyAED->FldIsDetailKey) {
			$this->s3WeeklyAED->setFormValue($objForm->GetValue("x_s3WeeklyAED"));
		}
		if (!$this->s3WeeklyKM->FldIsDetailKey) {
			$this->s3WeeklyKM->setFormValue($objForm->GetValue("x_s3WeeklyKM"));
		}
		if (!$this->s4WeeklyAED->FldIsDetailKey) {
			$this->s4WeeklyAED->setFormValue($objForm->GetValue("x_s4WeeklyAED"));
		}
		if (!$this->s4WeeklyKM->FldIsDetailKey) {
			$this->s4WeeklyKM->setFormValue($objForm->GetValue("x_s4WeeklyKM"));
		}
		if (!$this->s5WeeklyAED->FldIsDetailKey) {
			$this->s5WeeklyAED->setFormValue($objForm->GetValue("x_s5WeeklyAED"));
		}
		if (!$this->s5WeeklyKM->FldIsDetailKey) {
			$this->s5WeeklyKM->setFormValue($objForm->GetValue("x_s5WeeklyKM"));
		}
		if (!$this->s1MonthlyAED->FldIsDetailKey) {
			$this->s1MonthlyAED->setFormValue($objForm->GetValue("x_s1MonthlyAED"));
		}
		if (!$this->s1MonthlyKM->FldIsDetailKey) {
			$this->s1MonthlyKM->setFormValue($objForm->GetValue("x_s1MonthlyKM"));
		}
		if (!$this->s2MonthlyAED->FldIsDetailKey) {
			$this->s2MonthlyAED->setFormValue($objForm->GetValue("x_s2MonthlyAED"));
		}
		if (!$this->s2MonthlyKM->FldIsDetailKey) {
			$this->s2MonthlyKM->setFormValue($objForm->GetValue("x_s2MonthlyKM"));
		}
		if (!$this->s3MonthlyAED->FldIsDetailKey) {
			$this->s3MonthlyAED->setFormValue($objForm->GetValue("x_s3MonthlyAED"));
		}
		if (!$this->s3MonthlyKM->FldIsDetailKey) {
			$this->s3MonthlyKM->setFormValue($objForm->GetValue("x_s3MonthlyKM"));
		}
		if (!$this->s4MonthlyAED->FldIsDetailKey) {
			$this->s4MonthlyAED->setFormValue($objForm->GetValue("x_s4MonthlyAED"));
		}
		if (!$this->s4MonthlyKM->FldIsDetailKey) {
			$this->s4MonthlyKM->setFormValue($objForm->GetValue("x_s4MonthlyKM"));
		}
		if (!$this->s5MonthlyAED->FldIsDetailKey) {
			$this->s5MonthlyAED->setFormValue($objForm->GetValue("x_s5MonthlyAED"));
		}
		if (!$this->s5MonthlyKM->FldIsDetailKey) {
			$this->s5MonthlyKM->setFormValue($objForm->GetValue("x_s5MonthlyKM"));
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
		if (!$this->addon01KM->FldIsDetailKey) {
			$this->addon01KM->setFormValue($objForm->GetValue("x_addon01KM"));
		}
		if (!$this->addon01Price->FldIsDetailKey) {
			$this->addon01Price->setFormValue($objForm->GetValue("x_addon01Price"));
		}
		if (!$this->addon02KM->FldIsDetailKey) {
			$this->addon02KM->setFormValue($objForm->GetValue("x_addon02KM"));
		}
		if (!$this->addon02Price->FldIsDetailKey) {
			$this->addon02Price->setFormValue($objForm->GetValue("x_addon02Price"));
		}
		if (!$this->addon03KM->FldIsDetailKey) {
			$this->addon03KM->setFormValue($objForm->GetValue("x_addon03KM"));
		}
		if (!$this->addon03Price->FldIsDetailKey) {
			$this->addon03Price->setFormValue($objForm->GetValue("x_addon03Price"));
		}
		if (!$this->addon04KM->FldIsDetailKey) {
			$this->addon04KM->setFormValue($objForm->GetValue("x_addon04KM"));
		}
		if (!$this->addon04Price->FldIsDetailKey) {
			$this->addon04Price->setFormValue($objForm->GetValue("x_addon04Price"));
		}
		if (!$this->addon05KM->FldIsDetailKey) {
			$this->addon05KM->setFormValue($objForm->GetValue("x_addon05KM"));
		}
		if (!$this->addon05Price->FldIsDetailKey) {
			$this->addon05Price->setFormValue($objForm->GetValue("x_addon05Price"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->payDriveCarID->CurrentValue = $this->payDriveCarID->FormValue;
		$this->bodyTypeID->CurrentValue = $this->bodyTypeID->FormValue;
		$this->carTitle->CurrentValue = $this->carTitle->FormValue;
		$this->slug->CurrentValue = $this->slug->FormValue;
		$this->extraFeatures->CurrentValue = $this->extraFeatures->FormValue;
		$this->noOfSeats->CurrentValue = $this->noOfSeats->FormValue;
		$this->luggage->CurrentValue = $this->luggage->FormValue;
		$this->transmissionID->CurrentValue = $this->transmissionID->FormValue;
		$this->ac->CurrentValue = $this->ac->FormValue;
		$this->noOfDoors->CurrentValue = $this->noOfDoors->FormValue;
		$this->s1DailyAED->CurrentValue = $this->s1DailyAED->FormValue;
		$this->s1DailyKM->CurrentValue = $this->s1DailyKM->FormValue;
		$this->s2DailyAED->CurrentValue = $this->s2DailyAED->FormValue;
		$this->s2DailyKM->CurrentValue = $this->s2DailyKM->FormValue;
		$this->s3DailyAED->CurrentValue = $this->s3DailyAED->FormValue;
		$this->s3DailyKM->CurrentValue = $this->s3DailyKM->FormValue;
		$this->s4DailyAED->CurrentValue = $this->s4DailyAED->FormValue;
		$this->s4DailyKM->CurrentValue = $this->s4DailyKM->FormValue;
		$this->s5DailyAED->CurrentValue = $this->s5DailyAED->FormValue;
		$this->s5DailyKM->CurrentValue = $this->s5DailyKM->FormValue;
		$this->s1WeeklyAED->CurrentValue = $this->s1WeeklyAED->FormValue;
		$this->s1WeeklyKM->CurrentValue = $this->s1WeeklyKM->FormValue;
		$this->s2WeeklyAED->CurrentValue = $this->s2WeeklyAED->FormValue;
		$this->s2WeeklyKM->CurrentValue = $this->s2WeeklyKM->FormValue;
		$this->s3WeeklyAED->CurrentValue = $this->s3WeeklyAED->FormValue;
		$this->s3WeeklyKM->CurrentValue = $this->s3WeeklyKM->FormValue;
		$this->s4WeeklyAED->CurrentValue = $this->s4WeeklyAED->FormValue;
		$this->s4WeeklyKM->CurrentValue = $this->s4WeeklyKM->FormValue;
		$this->s5WeeklyAED->CurrentValue = $this->s5WeeklyAED->FormValue;
		$this->s5WeeklyKM->CurrentValue = $this->s5WeeklyKM->FormValue;
		$this->s1MonthlyAED->CurrentValue = $this->s1MonthlyAED->FormValue;
		$this->s1MonthlyKM->CurrentValue = $this->s1MonthlyKM->FormValue;
		$this->s2MonthlyAED->CurrentValue = $this->s2MonthlyAED->FormValue;
		$this->s2MonthlyKM->CurrentValue = $this->s2MonthlyKM->FormValue;
		$this->s3MonthlyAED->CurrentValue = $this->s3MonthlyAED->FormValue;
		$this->s3MonthlyKM->CurrentValue = $this->s3MonthlyKM->FormValue;
		$this->s4MonthlyAED->CurrentValue = $this->s4MonthlyAED->FormValue;
		$this->s4MonthlyKM->CurrentValue = $this->s4MonthlyKM->FormValue;
		$this->s5MonthlyAED->CurrentValue = $this->s5MonthlyAED->FormValue;
		$this->s5MonthlyKM->CurrentValue = $this->s5MonthlyKM->FormValue;
		$this->active->CurrentValue = $this->active->FormValue;
		$this->phase1OrangeCard->CurrentValue = $this->phase1OrangeCard->FormValue;
		$this->phase1GPS->CurrentValue = $this->phase1GPS->FormValue;
		$this->phase1DeliveryCharges->CurrentValue = $this->phase1DeliveryCharges->FormValue;
		$this->phase1CollectionCharges->CurrentValue = $this->phase1CollectionCharges->FormValue;
		$this->addon01KM->CurrentValue = $this->addon01KM->FormValue;
		$this->addon01Price->CurrentValue = $this->addon01Price->FormValue;
		$this->addon02KM->CurrentValue = $this->addon02KM->FormValue;
		$this->addon02Price->CurrentValue = $this->addon02Price->FormValue;
		$this->addon03KM->CurrentValue = $this->addon03KM->FormValue;
		$this->addon03Price->CurrentValue = $this->addon03Price->FormValue;
		$this->addon04KM->CurrentValue = $this->addon04KM->FormValue;
		$this->addon04Price->CurrentValue = $this->addon04Price->FormValue;
		$this->addon05KM->CurrentValue = $this->addon05KM->FormValue;
		$this->addon05Price->CurrentValue = $this->addon05Price->FormValue;
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
		$this->payDriveCarID->setDbValue($row['payDriveCarID']);
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
		$this->s1DailyAED->setDbValue($row['s1DailyAED']);
		$this->s1DailyKM->setDbValue($row['s1DailyKM']);
		$this->s2DailyAED->setDbValue($row['s2DailyAED']);
		$this->s2DailyKM->setDbValue($row['s2DailyKM']);
		$this->s3DailyAED->setDbValue($row['s3DailyAED']);
		$this->s3DailyKM->setDbValue($row['s3DailyKM']);
		$this->s4DailyAED->setDbValue($row['s4DailyAED']);
		$this->s4DailyKM->setDbValue($row['s4DailyKM']);
		$this->s5DailyAED->setDbValue($row['s5DailyAED']);
		$this->s5DailyKM->setDbValue($row['s5DailyKM']);
		$this->s1WeeklyAED->setDbValue($row['s1WeeklyAED']);
		$this->s1WeeklyKM->setDbValue($row['s1WeeklyKM']);
		$this->s2WeeklyAED->setDbValue($row['s2WeeklyAED']);
		$this->s2WeeklyKM->setDbValue($row['s2WeeklyKM']);
		$this->s3WeeklyAED->setDbValue($row['s3WeeklyAED']);
		$this->s3WeeklyKM->setDbValue($row['s3WeeklyKM']);
		$this->s4WeeklyAED->setDbValue($row['s4WeeklyAED']);
		$this->s4WeeklyKM->setDbValue($row['s4WeeklyKM']);
		$this->s5WeeklyAED->setDbValue($row['s5WeeklyAED']);
		$this->s5WeeklyKM->setDbValue($row['s5WeeklyKM']);
		$this->s1MonthlyAED->setDbValue($row['s1MonthlyAED']);
		$this->s1MonthlyKM->setDbValue($row['s1MonthlyKM']);
		$this->s2MonthlyAED->setDbValue($row['s2MonthlyAED']);
		$this->s2MonthlyKM->setDbValue($row['s2MonthlyKM']);
		$this->s3MonthlyAED->setDbValue($row['s3MonthlyAED']);
		$this->s3MonthlyKM->setDbValue($row['s3MonthlyKM']);
		$this->s4MonthlyAED->setDbValue($row['s4MonthlyAED']);
		$this->s4MonthlyKM->setDbValue($row['s4MonthlyKM']);
		$this->s5MonthlyAED->setDbValue($row['s5MonthlyAED']);
		$this->s5MonthlyKM->setDbValue($row['s5MonthlyKM']);
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
		$this->deliveryAED->setDbValue($row['deliveryAED']);
		$this->active->setDbValue($row['active']);
		$this->phase1OrangeCard->setDbValue($row['phase1OrangeCard']);
		$this->phase1GPS->setDbValue($row['phase1GPS']);
		$this->phase1DeliveryCharges->setDbValue($row['phase1DeliveryCharges']);
		$this->phase1CollectionCharges->setDbValue($row['phase1CollectionCharges']);
		$this->addon01KM->setDbValue($row['addon01KM']);
		$this->addon01Price->setDbValue($row['addon01Price']);
		$this->addon02KM->setDbValue($row['addon02KM']);
		$this->addon02Price->setDbValue($row['addon02Price']);
		$this->addon03KM->setDbValue($row['addon03KM']);
		$this->addon03Price->setDbValue($row['addon03Price']);
		$this->addon04KM->setDbValue($row['addon04KM']);
		$this->addon04Price->setDbValue($row['addon04Price']);
		$this->addon05KM->setDbValue($row['addon05KM']);
		$this->addon05Price->setDbValue($row['addon05Price']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['payDriveCarID'] = NULL;
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
		$row['s1DailyAED'] = NULL;
		$row['s1DailyKM'] = NULL;
		$row['s2DailyAED'] = NULL;
		$row['s2DailyKM'] = NULL;
		$row['s3DailyAED'] = NULL;
		$row['s3DailyKM'] = NULL;
		$row['s4DailyAED'] = NULL;
		$row['s4DailyKM'] = NULL;
		$row['s5DailyAED'] = NULL;
		$row['s5DailyKM'] = NULL;
		$row['s1WeeklyAED'] = NULL;
		$row['s1WeeklyKM'] = NULL;
		$row['s2WeeklyAED'] = NULL;
		$row['s2WeeklyKM'] = NULL;
		$row['s3WeeklyAED'] = NULL;
		$row['s3WeeklyKM'] = NULL;
		$row['s4WeeklyAED'] = NULL;
		$row['s4WeeklyKM'] = NULL;
		$row['s5WeeklyAED'] = NULL;
		$row['s5WeeklyKM'] = NULL;
		$row['s1MonthlyAED'] = NULL;
		$row['s1MonthlyKM'] = NULL;
		$row['s2MonthlyAED'] = NULL;
		$row['s2MonthlyKM'] = NULL;
		$row['s3MonthlyAED'] = NULL;
		$row['s3MonthlyKM'] = NULL;
		$row['s4MonthlyAED'] = NULL;
		$row['s4MonthlyKM'] = NULL;
		$row['s5MonthlyAED'] = NULL;
		$row['s5MonthlyKM'] = NULL;
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
		$row['deliveryAED'] = NULL;
		$row['active'] = NULL;
		$row['phase1OrangeCard'] = NULL;
		$row['phase1GPS'] = NULL;
		$row['phase1DeliveryCharges'] = NULL;
		$row['phase1CollectionCharges'] = NULL;
		$row['addon01KM'] = NULL;
		$row['addon01Price'] = NULL;
		$row['addon02KM'] = NULL;
		$row['addon02Price'] = NULL;
		$row['addon03KM'] = NULL;
		$row['addon03Price'] = NULL;
		$row['addon04KM'] = NULL;
		$row['addon04Price'] = NULL;
		$row['addon05KM'] = NULL;
		$row['addon05Price'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->payDriveCarID->DbValue = $row['payDriveCarID'];
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
		$this->s1DailyAED->DbValue = $row['s1DailyAED'];
		$this->s1DailyKM->DbValue = $row['s1DailyKM'];
		$this->s2DailyAED->DbValue = $row['s2DailyAED'];
		$this->s2DailyKM->DbValue = $row['s2DailyKM'];
		$this->s3DailyAED->DbValue = $row['s3DailyAED'];
		$this->s3DailyKM->DbValue = $row['s3DailyKM'];
		$this->s4DailyAED->DbValue = $row['s4DailyAED'];
		$this->s4DailyKM->DbValue = $row['s4DailyKM'];
		$this->s5DailyAED->DbValue = $row['s5DailyAED'];
		$this->s5DailyKM->DbValue = $row['s5DailyKM'];
		$this->s1WeeklyAED->DbValue = $row['s1WeeklyAED'];
		$this->s1WeeklyKM->DbValue = $row['s1WeeklyKM'];
		$this->s2WeeklyAED->DbValue = $row['s2WeeklyAED'];
		$this->s2WeeklyKM->DbValue = $row['s2WeeklyKM'];
		$this->s3WeeklyAED->DbValue = $row['s3WeeklyAED'];
		$this->s3WeeklyKM->DbValue = $row['s3WeeklyKM'];
		$this->s4WeeklyAED->DbValue = $row['s4WeeklyAED'];
		$this->s4WeeklyKM->DbValue = $row['s4WeeklyKM'];
		$this->s5WeeklyAED->DbValue = $row['s5WeeklyAED'];
		$this->s5WeeklyKM->DbValue = $row['s5WeeklyKM'];
		$this->s1MonthlyAED->DbValue = $row['s1MonthlyAED'];
		$this->s1MonthlyKM->DbValue = $row['s1MonthlyKM'];
		$this->s2MonthlyAED->DbValue = $row['s2MonthlyAED'];
		$this->s2MonthlyKM->DbValue = $row['s2MonthlyKM'];
		$this->s3MonthlyAED->DbValue = $row['s3MonthlyAED'];
		$this->s3MonthlyKM->DbValue = $row['s3MonthlyKM'];
		$this->s4MonthlyAED->DbValue = $row['s4MonthlyAED'];
		$this->s4MonthlyKM->DbValue = $row['s4MonthlyKM'];
		$this->s5MonthlyAED->DbValue = $row['s5MonthlyAED'];
		$this->s5MonthlyKM->DbValue = $row['s5MonthlyKM'];
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
		$this->deliveryAED->DbValue = $row['deliveryAED'];
		$this->active->DbValue = $row['active'];
		$this->phase1OrangeCard->DbValue = $row['phase1OrangeCard'];
		$this->phase1GPS->DbValue = $row['phase1GPS'];
		$this->phase1DeliveryCharges->DbValue = $row['phase1DeliveryCharges'];
		$this->phase1CollectionCharges->DbValue = $row['phase1CollectionCharges'];
		$this->addon01KM->DbValue = $row['addon01KM'];
		$this->addon01Price->DbValue = $row['addon01Price'];
		$this->addon02KM->DbValue = $row['addon02KM'];
		$this->addon02Price->DbValue = $row['addon02Price'];
		$this->addon03KM->DbValue = $row['addon03KM'];
		$this->addon03Price->DbValue = $row['addon03Price'];
		$this->addon04KM->DbValue = $row['addon04KM'];
		$this->addon04Price->DbValue = $row['addon04Price'];
		$this->addon05KM->DbValue = $row['addon05KM'];
		$this->addon05Price->DbValue = $row['addon05Price'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("payDriveCarID")) <> "")
			$this->payDriveCarID->CurrentValue = $this->getKey("payDriveCarID"); // payDriveCarID
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

		if ($this->s1DailyAED->FormValue == $this->s1DailyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s1DailyAED->CurrentValue)))
			$this->s1DailyAED->CurrentValue = ew_StrToFloat($this->s1DailyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->s2DailyAED->FormValue == $this->s2DailyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s2DailyAED->CurrentValue)))
			$this->s2DailyAED->CurrentValue = ew_StrToFloat($this->s2DailyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->s3DailyAED->FormValue == $this->s3DailyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s3DailyAED->CurrentValue)))
			$this->s3DailyAED->CurrentValue = ew_StrToFloat($this->s3DailyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->s4DailyAED->FormValue == $this->s4DailyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s4DailyAED->CurrentValue)))
			$this->s4DailyAED->CurrentValue = ew_StrToFloat($this->s4DailyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->s5DailyAED->FormValue == $this->s5DailyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s5DailyAED->CurrentValue)))
			$this->s5DailyAED->CurrentValue = ew_StrToFloat($this->s5DailyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->s1WeeklyAED->FormValue == $this->s1WeeklyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s1WeeklyAED->CurrentValue)))
			$this->s1WeeklyAED->CurrentValue = ew_StrToFloat($this->s1WeeklyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->s2WeeklyAED->FormValue == $this->s2WeeklyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s2WeeklyAED->CurrentValue)))
			$this->s2WeeklyAED->CurrentValue = ew_StrToFloat($this->s2WeeklyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->s3WeeklyAED->FormValue == $this->s3WeeklyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s3WeeklyAED->CurrentValue)))
			$this->s3WeeklyAED->CurrentValue = ew_StrToFloat($this->s3WeeklyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->s4WeeklyAED->FormValue == $this->s4WeeklyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s4WeeklyAED->CurrentValue)))
			$this->s4WeeklyAED->CurrentValue = ew_StrToFloat($this->s4WeeklyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->s5WeeklyAED->FormValue == $this->s5WeeklyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s5WeeklyAED->CurrentValue)))
			$this->s5WeeklyAED->CurrentValue = ew_StrToFloat($this->s5WeeklyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->s1MonthlyAED->FormValue == $this->s1MonthlyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s1MonthlyAED->CurrentValue)))
			$this->s1MonthlyAED->CurrentValue = ew_StrToFloat($this->s1MonthlyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->s2MonthlyAED->FormValue == $this->s2MonthlyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s2MonthlyAED->CurrentValue)))
			$this->s2MonthlyAED->CurrentValue = ew_StrToFloat($this->s2MonthlyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->s3MonthlyAED->FormValue == $this->s3MonthlyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s3MonthlyAED->CurrentValue)))
			$this->s3MonthlyAED->CurrentValue = ew_StrToFloat($this->s3MonthlyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->s4MonthlyAED->FormValue == $this->s4MonthlyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s4MonthlyAED->CurrentValue)))
			$this->s4MonthlyAED->CurrentValue = ew_StrToFloat($this->s4MonthlyAED->CurrentValue);

		// Convert decimal values if posted back
		if ($this->s5MonthlyAED->FormValue == $this->s5MonthlyAED->CurrentValue && is_numeric(ew_StrToFloat($this->s5MonthlyAED->CurrentValue)))
			$this->s5MonthlyAED->CurrentValue = ew_StrToFloat($this->s5MonthlyAED->CurrentValue);

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

		// Convert decimal values if posted back
		if ($this->addon01KM->FormValue == $this->addon01KM->CurrentValue && is_numeric(ew_StrToFloat($this->addon01KM->CurrentValue)))
			$this->addon01KM->CurrentValue = ew_StrToFloat($this->addon01KM->CurrentValue);

		// Convert decimal values if posted back
		if ($this->addon01Price->FormValue == $this->addon01Price->CurrentValue && is_numeric(ew_StrToFloat($this->addon01Price->CurrentValue)))
			$this->addon01Price->CurrentValue = ew_StrToFloat($this->addon01Price->CurrentValue);

		// Convert decimal values if posted back
		if ($this->addon02KM->FormValue == $this->addon02KM->CurrentValue && is_numeric(ew_StrToFloat($this->addon02KM->CurrentValue)))
			$this->addon02KM->CurrentValue = ew_StrToFloat($this->addon02KM->CurrentValue);

		// Convert decimal values if posted back
		if ($this->addon02Price->FormValue == $this->addon02Price->CurrentValue && is_numeric(ew_StrToFloat($this->addon02Price->CurrentValue)))
			$this->addon02Price->CurrentValue = ew_StrToFloat($this->addon02Price->CurrentValue);

		// Convert decimal values if posted back
		if ($this->addon03KM->FormValue == $this->addon03KM->CurrentValue && is_numeric(ew_StrToFloat($this->addon03KM->CurrentValue)))
			$this->addon03KM->CurrentValue = ew_StrToFloat($this->addon03KM->CurrentValue);

		// Convert decimal values if posted back
		if ($this->addon03Price->FormValue == $this->addon03Price->CurrentValue && is_numeric(ew_StrToFloat($this->addon03Price->CurrentValue)))
			$this->addon03Price->CurrentValue = ew_StrToFloat($this->addon03Price->CurrentValue);

		// Convert decimal values if posted back
		if ($this->addon04KM->FormValue == $this->addon04KM->CurrentValue && is_numeric(ew_StrToFloat($this->addon04KM->CurrentValue)))
			$this->addon04KM->CurrentValue = ew_StrToFloat($this->addon04KM->CurrentValue);

		// Convert decimal values if posted back
		if ($this->addon04Price->FormValue == $this->addon04Price->CurrentValue && is_numeric(ew_StrToFloat($this->addon04Price->CurrentValue)))
			$this->addon04Price->CurrentValue = ew_StrToFloat($this->addon04Price->CurrentValue);

		// Convert decimal values if posted back
		if ($this->addon05KM->FormValue == $this->addon05KM->CurrentValue && is_numeric(ew_StrToFloat($this->addon05KM->CurrentValue)))
			$this->addon05KM->CurrentValue = ew_StrToFloat($this->addon05KM->CurrentValue);

		// Convert decimal values if posted back
		if ($this->addon05Price->FormValue == $this->addon05Price->CurrentValue && is_numeric(ew_StrToFloat($this->addon05Price->CurrentValue)))
			$this->addon05Price->CurrentValue = ew_StrToFloat($this->addon05Price->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// payDriveCarID
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
		// s1DailyAED
		// s1DailyKM
		// s2DailyAED
		// s2DailyKM
		// s3DailyAED
		// s3DailyKM
		// s4DailyAED
		// s4DailyKM
		// s5DailyAED
		// s5DailyKM
		// s1WeeklyAED
		// s1WeeklyKM
		// s2WeeklyAED
		// s2WeeklyKM
		// s3WeeklyAED
		// s3WeeklyKM
		// s4WeeklyAED
		// s4WeeklyKM
		// s5WeeklyAED
		// s5WeeklyKM
		// s1MonthlyAED
		// s1MonthlyKM
		// s2MonthlyAED
		// s2MonthlyKM
		// s3MonthlyAED
		// s3MonthlyKM
		// s4MonthlyAED
		// s4MonthlyKM
		// s5MonthlyAED
		// s5MonthlyKM
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
		// deliveryAED
		// active
		// phase1OrangeCard
		// phase1GPS
		// phase1DeliveryCharges
		// phase1CollectionCharges
		// addon01KM
		// addon01Price
		// addon02KM
		// addon02Price
		// addon03KM
		// addon03Price
		// addon04KM
		// addon04Price
		// addon05KM
		// addon05Price

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// payDriveCarID
		$this->payDriveCarID->ViewValue = $this->payDriveCarID->CurrentValue;
		$this->payDriveCarID->ViewCustomAttributes = "";

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

		// s1DailyAED
		$this->s1DailyAED->ViewValue = $this->s1DailyAED->CurrentValue;
		$this->s1DailyAED->ViewCustomAttributes = "";

		// s1DailyKM
		$this->s1DailyKM->ViewValue = $this->s1DailyKM->CurrentValue;
		$this->s1DailyKM->ViewCustomAttributes = "";

		// s2DailyAED
		$this->s2DailyAED->ViewValue = $this->s2DailyAED->CurrentValue;
		$this->s2DailyAED->ViewCustomAttributes = "";

		// s2DailyKM
		$this->s2DailyKM->ViewValue = $this->s2DailyKM->CurrentValue;
		$this->s2DailyKM->ViewCustomAttributes = "";

		// s3DailyAED
		$this->s3DailyAED->ViewValue = $this->s3DailyAED->CurrentValue;
		$this->s3DailyAED->ViewCustomAttributes = "";

		// s3DailyKM
		$this->s3DailyKM->ViewValue = $this->s3DailyKM->CurrentValue;
		$this->s3DailyKM->ViewCustomAttributes = "";

		// s4DailyAED
		$this->s4DailyAED->ViewValue = $this->s4DailyAED->CurrentValue;
		$this->s4DailyAED->ViewCustomAttributes = "";

		// s4DailyKM
		$this->s4DailyKM->ViewValue = $this->s4DailyKM->CurrentValue;
		$this->s4DailyKM->ViewCustomAttributes = "";

		// s5DailyAED
		$this->s5DailyAED->ViewValue = $this->s5DailyAED->CurrentValue;
		$this->s5DailyAED->ViewCustomAttributes = "";

		// s5DailyKM
		$this->s5DailyKM->ViewValue = $this->s5DailyKM->CurrentValue;
		$this->s5DailyKM->ViewCustomAttributes = "";

		// s1WeeklyAED
		$this->s1WeeklyAED->ViewValue = $this->s1WeeklyAED->CurrentValue;
		$this->s1WeeklyAED->ViewCustomAttributes = "";

		// s1WeeklyKM
		$this->s1WeeklyKM->ViewValue = $this->s1WeeklyKM->CurrentValue;
		$this->s1WeeklyKM->ViewCustomAttributes = "";

		// s2WeeklyAED
		$this->s2WeeklyAED->ViewValue = $this->s2WeeklyAED->CurrentValue;
		$this->s2WeeklyAED->ViewCustomAttributes = "";

		// s2WeeklyKM
		$this->s2WeeklyKM->ViewValue = $this->s2WeeklyKM->CurrentValue;
		$this->s2WeeklyKM->ViewCustomAttributes = "";

		// s3WeeklyAED
		$this->s3WeeklyAED->ViewValue = $this->s3WeeklyAED->CurrentValue;
		$this->s3WeeklyAED->ViewCustomAttributes = "";

		// s3WeeklyKM
		$this->s3WeeklyKM->ViewValue = $this->s3WeeklyKM->CurrentValue;
		$this->s3WeeklyKM->ViewCustomAttributes = "";

		// s4WeeklyAED
		$this->s4WeeklyAED->ViewValue = $this->s4WeeklyAED->CurrentValue;
		$this->s4WeeklyAED->ViewCustomAttributes = "";

		// s4WeeklyKM
		$this->s4WeeklyKM->ViewValue = $this->s4WeeklyKM->CurrentValue;
		$this->s4WeeklyKM->ViewCustomAttributes = "";

		// s5WeeklyAED
		$this->s5WeeklyAED->ViewValue = $this->s5WeeklyAED->CurrentValue;
		$this->s5WeeklyAED->ViewCustomAttributes = "";

		// s5WeeklyKM
		$this->s5WeeklyKM->ViewValue = $this->s5WeeklyKM->CurrentValue;
		$this->s5WeeklyKM->ViewCustomAttributes = "";

		// s1MonthlyAED
		$this->s1MonthlyAED->ViewValue = $this->s1MonthlyAED->CurrentValue;
		$this->s1MonthlyAED->ViewCustomAttributes = "";

		// s1MonthlyKM
		$this->s1MonthlyKM->ViewValue = $this->s1MonthlyKM->CurrentValue;
		$this->s1MonthlyKM->ViewCustomAttributes = "";

		// s2MonthlyAED
		$this->s2MonthlyAED->ViewValue = $this->s2MonthlyAED->CurrentValue;
		$this->s2MonthlyAED->ViewCustomAttributes = "";

		// s2MonthlyKM
		$this->s2MonthlyKM->ViewValue = $this->s2MonthlyKM->CurrentValue;
		$this->s2MonthlyKM->ViewCustomAttributes = "";

		// s3MonthlyAED
		$this->s3MonthlyAED->ViewValue = $this->s3MonthlyAED->CurrentValue;
		$this->s3MonthlyAED->ViewCustomAttributes = "";

		// s3MonthlyKM
		$this->s3MonthlyKM->ViewValue = $this->s3MonthlyKM->CurrentValue;
		$this->s3MonthlyKM->ViewCustomAttributes = "";

		// s4MonthlyAED
		$this->s4MonthlyAED->ViewValue = $this->s4MonthlyAED->CurrentValue;
		$this->s4MonthlyAED->ViewCustomAttributes = "";

		// s4MonthlyKM
		$this->s4MonthlyKM->ViewValue = $this->s4MonthlyKM->CurrentValue;
		$this->s4MonthlyKM->ViewCustomAttributes = "";

		// s5MonthlyAED
		$this->s5MonthlyAED->ViewValue = $this->s5MonthlyAED->CurrentValue;
		$this->s5MonthlyAED->ViewCustomAttributes = "";

		// s5MonthlyKM
		$this->s5MonthlyKM->ViewValue = $this->s5MonthlyKM->CurrentValue;
		$this->s5MonthlyKM->ViewCustomAttributes = "";

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

		// addon01KM
		$this->addon01KM->ViewValue = $this->addon01KM->CurrentValue;
		$this->addon01KM->ViewCustomAttributes = "";

		// addon01Price
		$this->addon01Price->ViewValue = $this->addon01Price->CurrentValue;
		$this->addon01Price->ViewCustomAttributes = "";

		// addon02KM
		$this->addon02KM->ViewValue = $this->addon02KM->CurrentValue;
		$this->addon02KM->ViewCustomAttributes = "";

		// addon02Price
		$this->addon02Price->ViewValue = $this->addon02Price->CurrentValue;
		$this->addon02Price->ViewCustomAttributes = "";

		// addon03KM
		$this->addon03KM->ViewValue = $this->addon03KM->CurrentValue;
		$this->addon03KM->ViewCustomAttributes = "";

		// addon03Price
		$this->addon03Price->ViewValue = $this->addon03Price->CurrentValue;
		$this->addon03Price->ViewCustomAttributes = "";

		// addon04KM
		$this->addon04KM->ViewValue = $this->addon04KM->CurrentValue;
		$this->addon04KM->ViewCustomAttributes = "";

		// addon04Price
		$this->addon04Price->ViewValue = $this->addon04Price->CurrentValue;
		$this->addon04Price->ViewCustomAttributes = "";

		// addon05KM
		$this->addon05KM->ViewValue = $this->addon05KM->CurrentValue;
		$this->addon05KM->ViewCustomAttributes = "";

		// addon05Price
		$this->addon05Price->ViewValue = $this->addon05Price->CurrentValue;
		$this->addon05Price->ViewCustomAttributes = "";

			// payDriveCarID
			$this->payDriveCarID->LinkCustomAttributes = "";
			$this->payDriveCarID->HrefValue = "";
			$this->payDriveCarID->TooltipValue = "";

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
				$this->image->LinkAttrs["data-rel"] = "pay_as_you_drive_x_image";
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

			// s1DailyAED
			$this->s1DailyAED->LinkCustomAttributes = "";
			$this->s1DailyAED->HrefValue = "";
			$this->s1DailyAED->TooltipValue = "";

			// s1DailyKM
			$this->s1DailyKM->LinkCustomAttributes = "";
			$this->s1DailyKM->HrefValue = "";
			$this->s1DailyKM->TooltipValue = "";

			// s2DailyAED
			$this->s2DailyAED->LinkCustomAttributes = "";
			$this->s2DailyAED->HrefValue = "";
			$this->s2DailyAED->TooltipValue = "";

			// s2DailyKM
			$this->s2DailyKM->LinkCustomAttributes = "";
			$this->s2DailyKM->HrefValue = "";
			$this->s2DailyKM->TooltipValue = "";

			// s3DailyAED
			$this->s3DailyAED->LinkCustomAttributes = "";
			$this->s3DailyAED->HrefValue = "";
			$this->s3DailyAED->TooltipValue = "";

			// s3DailyKM
			$this->s3DailyKM->LinkCustomAttributes = "";
			$this->s3DailyKM->HrefValue = "";
			$this->s3DailyKM->TooltipValue = "";

			// s4DailyAED
			$this->s4DailyAED->LinkCustomAttributes = "";
			$this->s4DailyAED->HrefValue = "";
			$this->s4DailyAED->TooltipValue = "";

			// s4DailyKM
			$this->s4DailyKM->LinkCustomAttributes = "";
			$this->s4DailyKM->HrefValue = "";
			$this->s4DailyKM->TooltipValue = "";

			// s5DailyAED
			$this->s5DailyAED->LinkCustomAttributes = "";
			$this->s5DailyAED->HrefValue = "";
			$this->s5DailyAED->TooltipValue = "";

			// s5DailyKM
			$this->s5DailyKM->LinkCustomAttributes = "";
			$this->s5DailyKM->HrefValue = "";
			$this->s5DailyKM->TooltipValue = "";

			// s1WeeklyAED
			$this->s1WeeklyAED->LinkCustomAttributes = "";
			$this->s1WeeklyAED->HrefValue = "";
			$this->s1WeeklyAED->TooltipValue = "";

			// s1WeeklyKM
			$this->s1WeeklyKM->LinkCustomAttributes = "";
			$this->s1WeeklyKM->HrefValue = "";
			$this->s1WeeklyKM->TooltipValue = "";

			// s2WeeklyAED
			$this->s2WeeklyAED->LinkCustomAttributes = "";
			$this->s2WeeklyAED->HrefValue = "";
			$this->s2WeeklyAED->TooltipValue = "";

			// s2WeeklyKM
			$this->s2WeeklyKM->LinkCustomAttributes = "";
			$this->s2WeeklyKM->HrefValue = "";
			$this->s2WeeklyKM->TooltipValue = "";

			// s3WeeklyAED
			$this->s3WeeklyAED->LinkCustomAttributes = "";
			$this->s3WeeklyAED->HrefValue = "";
			$this->s3WeeklyAED->TooltipValue = "";

			// s3WeeklyKM
			$this->s3WeeklyKM->LinkCustomAttributes = "";
			$this->s3WeeklyKM->HrefValue = "";
			$this->s3WeeklyKM->TooltipValue = "";

			// s4WeeklyAED
			$this->s4WeeklyAED->LinkCustomAttributes = "";
			$this->s4WeeklyAED->HrefValue = "";
			$this->s4WeeklyAED->TooltipValue = "";

			// s4WeeklyKM
			$this->s4WeeklyKM->LinkCustomAttributes = "";
			$this->s4WeeklyKM->HrefValue = "";
			$this->s4WeeklyKM->TooltipValue = "";

			// s5WeeklyAED
			$this->s5WeeklyAED->LinkCustomAttributes = "";
			$this->s5WeeklyAED->HrefValue = "";
			$this->s5WeeklyAED->TooltipValue = "";

			// s5WeeklyKM
			$this->s5WeeklyKM->LinkCustomAttributes = "";
			$this->s5WeeklyKM->HrefValue = "";
			$this->s5WeeklyKM->TooltipValue = "";

			// s1MonthlyAED
			$this->s1MonthlyAED->LinkCustomAttributes = "";
			$this->s1MonthlyAED->HrefValue = "";
			$this->s1MonthlyAED->TooltipValue = "";

			// s1MonthlyKM
			$this->s1MonthlyKM->LinkCustomAttributes = "";
			$this->s1MonthlyKM->HrefValue = "";
			$this->s1MonthlyKM->TooltipValue = "";

			// s2MonthlyAED
			$this->s2MonthlyAED->LinkCustomAttributes = "";
			$this->s2MonthlyAED->HrefValue = "";
			$this->s2MonthlyAED->TooltipValue = "";

			// s2MonthlyKM
			$this->s2MonthlyKM->LinkCustomAttributes = "";
			$this->s2MonthlyKM->HrefValue = "";
			$this->s2MonthlyKM->TooltipValue = "";

			// s3MonthlyAED
			$this->s3MonthlyAED->LinkCustomAttributes = "";
			$this->s3MonthlyAED->HrefValue = "";
			$this->s3MonthlyAED->TooltipValue = "";

			// s3MonthlyKM
			$this->s3MonthlyKM->LinkCustomAttributes = "";
			$this->s3MonthlyKM->HrefValue = "";
			$this->s3MonthlyKM->TooltipValue = "";

			// s4MonthlyAED
			$this->s4MonthlyAED->LinkCustomAttributes = "";
			$this->s4MonthlyAED->HrefValue = "";
			$this->s4MonthlyAED->TooltipValue = "";

			// s4MonthlyKM
			$this->s4MonthlyKM->LinkCustomAttributes = "";
			$this->s4MonthlyKM->HrefValue = "";
			$this->s4MonthlyKM->TooltipValue = "";

			// s5MonthlyAED
			$this->s5MonthlyAED->LinkCustomAttributes = "";
			$this->s5MonthlyAED->HrefValue = "";
			$this->s5MonthlyAED->TooltipValue = "";

			// s5MonthlyKM
			$this->s5MonthlyKM->LinkCustomAttributes = "";
			$this->s5MonthlyKM->HrefValue = "";
			$this->s5MonthlyKM->TooltipValue = "";

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

			// addon01KM
			$this->addon01KM->LinkCustomAttributes = "";
			$this->addon01KM->HrefValue = "";
			$this->addon01KM->TooltipValue = "";

			// addon01Price
			$this->addon01Price->LinkCustomAttributes = "";
			$this->addon01Price->HrefValue = "";
			$this->addon01Price->TooltipValue = "";

			// addon02KM
			$this->addon02KM->LinkCustomAttributes = "";
			$this->addon02KM->HrefValue = "";
			$this->addon02KM->TooltipValue = "";

			// addon02Price
			$this->addon02Price->LinkCustomAttributes = "";
			$this->addon02Price->HrefValue = "";
			$this->addon02Price->TooltipValue = "";

			// addon03KM
			$this->addon03KM->LinkCustomAttributes = "";
			$this->addon03KM->HrefValue = "";
			$this->addon03KM->TooltipValue = "";

			// addon03Price
			$this->addon03Price->LinkCustomAttributes = "";
			$this->addon03Price->HrefValue = "";
			$this->addon03Price->TooltipValue = "";

			// addon04KM
			$this->addon04KM->LinkCustomAttributes = "";
			$this->addon04KM->HrefValue = "";
			$this->addon04KM->TooltipValue = "";

			// addon04Price
			$this->addon04Price->LinkCustomAttributes = "";
			$this->addon04Price->HrefValue = "";
			$this->addon04Price->TooltipValue = "";

			// addon05KM
			$this->addon05KM->LinkCustomAttributes = "";
			$this->addon05KM->HrefValue = "";
			$this->addon05KM->TooltipValue = "";

			// addon05Price
			$this->addon05Price->LinkCustomAttributes = "";
			$this->addon05Price->HrefValue = "";
			$this->addon05Price->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// payDriveCarID
			$this->payDriveCarID->EditAttrs["class"] = "form-control";
			$this->payDriveCarID->EditCustomAttributes = "";
			$this->payDriveCarID->EditValue = $this->payDriveCarID->CurrentValue;
			$this->payDriveCarID->ViewCustomAttributes = "";

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
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->image);

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

			// s1DailyAED
			$this->s1DailyAED->EditAttrs["class"] = "form-control";
			$this->s1DailyAED->EditCustomAttributes = "";
			$this->s1DailyAED->EditValue = ew_HtmlEncode($this->s1DailyAED->CurrentValue);
			$this->s1DailyAED->PlaceHolder = ew_RemoveHtml($this->s1DailyAED->FldCaption());
			if (strval($this->s1DailyAED->EditValue) <> "" && is_numeric($this->s1DailyAED->EditValue)) $this->s1DailyAED->EditValue = ew_FormatNumber($this->s1DailyAED->EditValue, -2, -1, -2, 0);

			// s1DailyKM
			$this->s1DailyKM->EditAttrs["class"] = "form-control";
			$this->s1DailyKM->EditCustomAttributes = "";
			$this->s1DailyKM->EditValue = ew_HtmlEncode($this->s1DailyKM->CurrentValue);
			$this->s1DailyKM->PlaceHolder = ew_RemoveHtml($this->s1DailyKM->FldCaption());

			// s2DailyAED
			$this->s2DailyAED->EditAttrs["class"] = "form-control";
			$this->s2DailyAED->EditCustomAttributes = "";
			$this->s2DailyAED->EditValue = ew_HtmlEncode($this->s2DailyAED->CurrentValue);
			$this->s2DailyAED->PlaceHolder = ew_RemoveHtml($this->s2DailyAED->FldCaption());
			if (strval($this->s2DailyAED->EditValue) <> "" && is_numeric($this->s2DailyAED->EditValue)) $this->s2DailyAED->EditValue = ew_FormatNumber($this->s2DailyAED->EditValue, -2, -1, -2, 0);

			// s2DailyKM
			$this->s2DailyKM->EditAttrs["class"] = "form-control";
			$this->s2DailyKM->EditCustomAttributes = "";
			$this->s2DailyKM->EditValue = ew_HtmlEncode($this->s2DailyKM->CurrentValue);
			$this->s2DailyKM->PlaceHolder = ew_RemoveHtml($this->s2DailyKM->FldCaption());

			// s3DailyAED
			$this->s3DailyAED->EditAttrs["class"] = "form-control";
			$this->s3DailyAED->EditCustomAttributes = "";
			$this->s3DailyAED->EditValue = ew_HtmlEncode($this->s3DailyAED->CurrentValue);
			$this->s3DailyAED->PlaceHolder = ew_RemoveHtml($this->s3DailyAED->FldCaption());
			if (strval($this->s3DailyAED->EditValue) <> "" && is_numeric($this->s3DailyAED->EditValue)) $this->s3DailyAED->EditValue = ew_FormatNumber($this->s3DailyAED->EditValue, -2, -1, -2, 0);

			// s3DailyKM
			$this->s3DailyKM->EditAttrs["class"] = "form-control";
			$this->s3DailyKM->EditCustomAttributes = "";
			$this->s3DailyKM->EditValue = ew_HtmlEncode($this->s3DailyKM->CurrentValue);
			$this->s3DailyKM->PlaceHolder = ew_RemoveHtml($this->s3DailyKM->FldCaption());

			// s4DailyAED
			$this->s4DailyAED->EditAttrs["class"] = "form-control";
			$this->s4DailyAED->EditCustomAttributes = "";
			$this->s4DailyAED->EditValue = ew_HtmlEncode($this->s4DailyAED->CurrentValue);
			$this->s4DailyAED->PlaceHolder = ew_RemoveHtml($this->s4DailyAED->FldCaption());
			if (strval($this->s4DailyAED->EditValue) <> "" && is_numeric($this->s4DailyAED->EditValue)) $this->s4DailyAED->EditValue = ew_FormatNumber($this->s4DailyAED->EditValue, -2, -1, -2, 0);

			// s4DailyKM
			$this->s4DailyKM->EditAttrs["class"] = "form-control";
			$this->s4DailyKM->EditCustomAttributes = "";
			$this->s4DailyKM->EditValue = ew_HtmlEncode($this->s4DailyKM->CurrentValue);
			$this->s4DailyKM->PlaceHolder = ew_RemoveHtml($this->s4DailyKM->FldCaption());

			// s5DailyAED
			$this->s5DailyAED->EditAttrs["class"] = "form-control";
			$this->s5DailyAED->EditCustomAttributes = "";
			$this->s5DailyAED->EditValue = ew_HtmlEncode($this->s5DailyAED->CurrentValue);
			$this->s5DailyAED->PlaceHolder = ew_RemoveHtml($this->s5DailyAED->FldCaption());
			if (strval($this->s5DailyAED->EditValue) <> "" && is_numeric($this->s5DailyAED->EditValue)) $this->s5DailyAED->EditValue = ew_FormatNumber($this->s5DailyAED->EditValue, -2, -1, -2, 0);

			// s5DailyKM
			$this->s5DailyKM->EditAttrs["class"] = "form-control";
			$this->s5DailyKM->EditCustomAttributes = "";
			$this->s5DailyKM->EditValue = ew_HtmlEncode($this->s5DailyKM->CurrentValue);
			$this->s5DailyKM->PlaceHolder = ew_RemoveHtml($this->s5DailyKM->FldCaption());

			// s1WeeklyAED
			$this->s1WeeklyAED->EditAttrs["class"] = "form-control";
			$this->s1WeeklyAED->EditCustomAttributes = "";
			$this->s1WeeklyAED->EditValue = ew_HtmlEncode($this->s1WeeklyAED->CurrentValue);
			$this->s1WeeklyAED->PlaceHolder = ew_RemoveHtml($this->s1WeeklyAED->FldCaption());
			if (strval($this->s1WeeklyAED->EditValue) <> "" && is_numeric($this->s1WeeklyAED->EditValue)) $this->s1WeeklyAED->EditValue = ew_FormatNumber($this->s1WeeklyAED->EditValue, -2, -1, -2, 0);

			// s1WeeklyKM
			$this->s1WeeklyKM->EditAttrs["class"] = "form-control";
			$this->s1WeeklyKM->EditCustomAttributes = "";
			$this->s1WeeklyKM->EditValue = ew_HtmlEncode($this->s1WeeklyKM->CurrentValue);
			$this->s1WeeklyKM->PlaceHolder = ew_RemoveHtml($this->s1WeeklyKM->FldCaption());

			// s2WeeklyAED
			$this->s2WeeklyAED->EditAttrs["class"] = "form-control";
			$this->s2WeeklyAED->EditCustomAttributes = "";
			$this->s2WeeklyAED->EditValue = ew_HtmlEncode($this->s2WeeklyAED->CurrentValue);
			$this->s2WeeklyAED->PlaceHolder = ew_RemoveHtml($this->s2WeeklyAED->FldCaption());
			if (strval($this->s2WeeklyAED->EditValue) <> "" && is_numeric($this->s2WeeklyAED->EditValue)) $this->s2WeeklyAED->EditValue = ew_FormatNumber($this->s2WeeklyAED->EditValue, -2, -1, -2, 0);

			// s2WeeklyKM
			$this->s2WeeklyKM->EditAttrs["class"] = "form-control";
			$this->s2WeeklyKM->EditCustomAttributes = "";
			$this->s2WeeklyKM->EditValue = ew_HtmlEncode($this->s2WeeklyKM->CurrentValue);
			$this->s2WeeklyKM->PlaceHolder = ew_RemoveHtml($this->s2WeeklyKM->FldCaption());

			// s3WeeklyAED
			$this->s3WeeklyAED->EditAttrs["class"] = "form-control";
			$this->s3WeeklyAED->EditCustomAttributes = "";
			$this->s3WeeklyAED->EditValue = ew_HtmlEncode($this->s3WeeklyAED->CurrentValue);
			$this->s3WeeklyAED->PlaceHolder = ew_RemoveHtml($this->s3WeeklyAED->FldCaption());
			if (strval($this->s3WeeklyAED->EditValue) <> "" && is_numeric($this->s3WeeklyAED->EditValue)) $this->s3WeeklyAED->EditValue = ew_FormatNumber($this->s3WeeklyAED->EditValue, -2, -1, -2, 0);

			// s3WeeklyKM
			$this->s3WeeklyKM->EditAttrs["class"] = "form-control";
			$this->s3WeeklyKM->EditCustomAttributes = "";
			$this->s3WeeklyKM->EditValue = ew_HtmlEncode($this->s3WeeklyKM->CurrentValue);
			$this->s3WeeklyKM->PlaceHolder = ew_RemoveHtml($this->s3WeeklyKM->FldCaption());

			// s4WeeklyAED
			$this->s4WeeklyAED->EditAttrs["class"] = "form-control";
			$this->s4WeeklyAED->EditCustomAttributes = "";
			$this->s4WeeklyAED->EditValue = ew_HtmlEncode($this->s4WeeklyAED->CurrentValue);
			$this->s4WeeklyAED->PlaceHolder = ew_RemoveHtml($this->s4WeeklyAED->FldCaption());
			if (strval($this->s4WeeklyAED->EditValue) <> "" && is_numeric($this->s4WeeklyAED->EditValue)) $this->s4WeeklyAED->EditValue = ew_FormatNumber($this->s4WeeklyAED->EditValue, -2, -1, -2, 0);

			// s4WeeklyKM
			$this->s4WeeklyKM->EditAttrs["class"] = "form-control";
			$this->s4WeeklyKM->EditCustomAttributes = "";
			$this->s4WeeklyKM->EditValue = ew_HtmlEncode($this->s4WeeklyKM->CurrentValue);
			$this->s4WeeklyKM->PlaceHolder = ew_RemoveHtml($this->s4WeeklyKM->FldCaption());

			// s5WeeklyAED
			$this->s5WeeklyAED->EditAttrs["class"] = "form-control";
			$this->s5WeeklyAED->EditCustomAttributes = "";
			$this->s5WeeklyAED->EditValue = ew_HtmlEncode($this->s5WeeklyAED->CurrentValue);
			$this->s5WeeklyAED->PlaceHolder = ew_RemoveHtml($this->s5WeeklyAED->FldCaption());
			if (strval($this->s5WeeklyAED->EditValue) <> "" && is_numeric($this->s5WeeklyAED->EditValue)) $this->s5WeeklyAED->EditValue = ew_FormatNumber($this->s5WeeklyAED->EditValue, -2, -1, -2, 0);

			// s5WeeklyKM
			$this->s5WeeklyKM->EditAttrs["class"] = "form-control";
			$this->s5WeeklyKM->EditCustomAttributes = "";
			$this->s5WeeklyKM->EditValue = ew_HtmlEncode($this->s5WeeklyKM->CurrentValue);
			$this->s5WeeklyKM->PlaceHolder = ew_RemoveHtml($this->s5WeeklyKM->FldCaption());

			// s1MonthlyAED
			$this->s1MonthlyAED->EditAttrs["class"] = "form-control";
			$this->s1MonthlyAED->EditCustomAttributes = "";
			$this->s1MonthlyAED->EditValue = ew_HtmlEncode($this->s1MonthlyAED->CurrentValue);
			$this->s1MonthlyAED->PlaceHolder = ew_RemoveHtml($this->s1MonthlyAED->FldCaption());
			if (strval($this->s1MonthlyAED->EditValue) <> "" && is_numeric($this->s1MonthlyAED->EditValue)) $this->s1MonthlyAED->EditValue = ew_FormatNumber($this->s1MonthlyAED->EditValue, -2, -1, -2, 0);

			// s1MonthlyKM
			$this->s1MonthlyKM->EditAttrs["class"] = "form-control";
			$this->s1MonthlyKM->EditCustomAttributes = "";
			$this->s1MonthlyKM->EditValue = ew_HtmlEncode($this->s1MonthlyKM->CurrentValue);
			$this->s1MonthlyKM->PlaceHolder = ew_RemoveHtml($this->s1MonthlyKM->FldCaption());

			// s2MonthlyAED
			$this->s2MonthlyAED->EditAttrs["class"] = "form-control";
			$this->s2MonthlyAED->EditCustomAttributes = "";
			$this->s2MonthlyAED->EditValue = ew_HtmlEncode($this->s2MonthlyAED->CurrentValue);
			$this->s2MonthlyAED->PlaceHolder = ew_RemoveHtml($this->s2MonthlyAED->FldCaption());
			if (strval($this->s2MonthlyAED->EditValue) <> "" && is_numeric($this->s2MonthlyAED->EditValue)) $this->s2MonthlyAED->EditValue = ew_FormatNumber($this->s2MonthlyAED->EditValue, -2, -1, -2, 0);

			// s2MonthlyKM
			$this->s2MonthlyKM->EditAttrs["class"] = "form-control";
			$this->s2MonthlyKM->EditCustomAttributes = "";
			$this->s2MonthlyKM->EditValue = ew_HtmlEncode($this->s2MonthlyKM->CurrentValue);
			$this->s2MonthlyKM->PlaceHolder = ew_RemoveHtml($this->s2MonthlyKM->FldCaption());

			// s3MonthlyAED
			$this->s3MonthlyAED->EditAttrs["class"] = "form-control";
			$this->s3MonthlyAED->EditCustomAttributes = "";
			$this->s3MonthlyAED->EditValue = ew_HtmlEncode($this->s3MonthlyAED->CurrentValue);
			$this->s3MonthlyAED->PlaceHolder = ew_RemoveHtml($this->s3MonthlyAED->FldCaption());
			if (strval($this->s3MonthlyAED->EditValue) <> "" && is_numeric($this->s3MonthlyAED->EditValue)) $this->s3MonthlyAED->EditValue = ew_FormatNumber($this->s3MonthlyAED->EditValue, -2, -1, -2, 0);

			// s3MonthlyKM
			$this->s3MonthlyKM->EditAttrs["class"] = "form-control";
			$this->s3MonthlyKM->EditCustomAttributes = "";
			$this->s3MonthlyKM->EditValue = ew_HtmlEncode($this->s3MonthlyKM->CurrentValue);
			$this->s3MonthlyKM->PlaceHolder = ew_RemoveHtml($this->s3MonthlyKM->FldCaption());

			// s4MonthlyAED
			$this->s4MonthlyAED->EditAttrs["class"] = "form-control";
			$this->s4MonthlyAED->EditCustomAttributes = "";
			$this->s4MonthlyAED->EditValue = ew_HtmlEncode($this->s4MonthlyAED->CurrentValue);
			$this->s4MonthlyAED->PlaceHolder = ew_RemoveHtml($this->s4MonthlyAED->FldCaption());
			if (strval($this->s4MonthlyAED->EditValue) <> "" && is_numeric($this->s4MonthlyAED->EditValue)) $this->s4MonthlyAED->EditValue = ew_FormatNumber($this->s4MonthlyAED->EditValue, -2, -1, -2, 0);

			// s4MonthlyKM
			$this->s4MonthlyKM->EditAttrs["class"] = "form-control";
			$this->s4MonthlyKM->EditCustomAttributes = "";
			$this->s4MonthlyKM->EditValue = ew_HtmlEncode($this->s4MonthlyKM->CurrentValue);
			$this->s4MonthlyKM->PlaceHolder = ew_RemoveHtml($this->s4MonthlyKM->FldCaption());

			// s5MonthlyAED
			$this->s5MonthlyAED->EditAttrs["class"] = "form-control";
			$this->s5MonthlyAED->EditCustomAttributes = "";
			$this->s5MonthlyAED->EditValue = ew_HtmlEncode($this->s5MonthlyAED->CurrentValue);
			$this->s5MonthlyAED->PlaceHolder = ew_RemoveHtml($this->s5MonthlyAED->FldCaption());
			if (strval($this->s5MonthlyAED->EditValue) <> "" && is_numeric($this->s5MonthlyAED->EditValue)) $this->s5MonthlyAED->EditValue = ew_FormatNumber($this->s5MonthlyAED->EditValue, -2, -1, -2, 0);

			// s5MonthlyKM
			$this->s5MonthlyKM->EditAttrs["class"] = "form-control";
			$this->s5MonthlyKM->EditCustomAttributes = "";
			$this->s5MonthlyKM->EditValue = ew_HtmlEncode($this->s5MonthlyKM->CurrentValue);
			$this->s5MonthlyKM->PlaceHolder = ew_RemoveHtml($this->s5MonthlyKM->FldCaption());

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

			// addon01KM
			$this->addon01KM->EditAttrs["class"] = "form-control";
			$this->addon01KM->EditCustomAttributes = "";
			$this->addon01KM->EditValue = ew_HtmlEncode($this->addon01KM->CurrentValue);
			$this->addon01KM->PlaceHolder = ew_RemoveHtml($this->addon01KM->FldCaption());
			if (strval($this->addon01KM->EditValue) <> "" && is_numeric($this->addon01KM->EditValue)) $this->addon01KM->EditValue = ew_FormatNumber($this->addon01KM->EditValue, -2, -1, -2, 0);

			// addon01Price
			$this->addon01Price->EditAttrs["class"] = "form-control";
			$this->addon01Price->EditCustomAttributes = "";
			$this->addon01Price->EditValue = ew_HtmlEncode($this->addon01Price->CurrentValue);
			$this->addon01Price->PlaceHolder = ew_RemoveHtml($this->addon01Price->FldCaption());
			if (strval($this->addon01Price->EditValue) <> "" && is_numeric($this->addon01Price->EditValue)) $this->addon01Price->EditValue = ew_FormatNumber($this->addon01Price->EditValue, -2, -1, -2, 0);

			// addon02KM
			$this->addon02KM->EditAttrs["class"] = "form-control";
			$this->addon02KM->EditCustomAttributes = "";
			$this->addon02KM->EditValue = ew_HtmlEncode($this->addon02KM->CurrentValue);
			$this->addon02KM->PlaceHolder = ew_RemoveHtml($this->addon02KM->FldCaption());
			if (strval($this->addon02KM->EditValue) <> "" && is_numeric($this->addon02KM->EditValue)) $this->addon02KM->EditValue = ew_FormatNumber($this->addon02KM->EditValue, -2, -1, -2, 0);

			// addon02Price
			$this->addon02Price->EditAttrs["class"] = "form-control";
			$this->addon02Price->EditCustomAttributes = "";
			$this->addon02Price->EditValue = ew_HtmlEncode($this->addon02Price->CurrentValue);
			$this->addon02Price->PlaceHolder = ew_RemoveHtml($this->addon02Price->FldCaption());
			if (strval($this->addon02Price->EditValue) <> "" && is_numeric($this->addon02Price->EditValue)) $this->addon02Price->EditValue = ew_FormatNumber($this->addon02Price->EditValue, -2, -1, -2, 0);

			// addon03KM
			$this->addon03KM->EditAttrs["class"] = "form-control";
			$this->addon03KM->EditCustomAttributes = "";
			$this->addon03KM->EditValue = ew_HtmlEncode($this->addon03KM->CurrentValue);
			$this->addon03KM->PlaceHolder = ew_RemoveHtml($this->addon03KM->FldCaption());
			if (strval($this->addon03KM->EditValue) <> "" && is_numeric($this->addon03KM->EditValue)) $this->addon03KM->EditValue = ew_FormatNumber($this->addon03KM->EditValue, -2, -1, -2, 0);

			// addon03Price
			$this->addon03Price->EditAttrs["class"] = "form-control";
			$this->addon03Price->EditCustomAttributes = "";
			$this->addon03Price->EditValue = ew_HtmlEncode($this->addon03Price->CurrentValue);
			$this->addon03Price->PlaceHolder = ew_RemoveHtml($this->addon03Price->FldCaption());
			if (strval($this->addon03Price->EditValue) <> "" && is_numeric($this->addon03Price->EditValue)) $this->addon03Price->EditValue = ew_FormatNumber($this->addon03Price->EditValue, -2, -1, -2, 0);

			// addon04KM
			$this->addon04KM->EditAttrs["class"] = "form-control";
			$this->addon04KM->EditCustomAttributes = "";
			$this->addon04KM->EditValue = ew_HtmlEncode($this->addon04KM->CurrentValue);
			$this->addon04KM->PlaceHolder = ew_RemoveHtml($this->addon04KM->FldCaption());
			if (strval($this->addon04KM->EditValue) <> "" && is_numeric($this->addon04KM->EditValue)) $this->addon04KM->EditValue = ew_FormatNumber($this->addon04KM->EditValue, -2, -1, -2, 0);

			// addon04Price
			$this->addon04Price->EditAttrs["class"] = "form-control";
			$this->addon04Price->EditCustomAttributes = "";
			$this->addon04Price->EditValue = ew_HtmlEncode($this->addon04Price->CurrentValue);
			$this->addon04Price->PlaceHolder = ew_RemoveHtml($this->addon04Price->FldCaption());
			if (strval($this->addon04Price->EditValue) <> "" && is_numeric($this->addon04Price->EditValue)) $this->addon04Price->EditValue = ew_FormatNumber($this->addon04Price->EditValue, -2, -1, -2, 0);

			// addon05KM
			$this->addon05KM->EditAttrs["class"] = "form-control";
			$this->addon05KM->EditCustomAttributes = "";
			$this->addon05KM->EditValue = ew_HtmlEncode($this->addon05KM->CurrentValue);
			$this->addon05KM->PlaceHolder = ew_RemoveHtml($this->addon05KM->FldCaption());
			if (strval($this->addon05KM->EditValue) <> "" && is_numeric($this->addon05KM->EditValue)) $this->addon05KM->EditValue = ew_FormatNumber($this->addon05KM->EditValue, -2, -1, -2, 0);

			// addon05Price
			$this->addon05Price->EditAttrs["class"] = "form-control";
			$this->addon05Price->EditCustomAttributes = "";
			$this->addon05Price->EditValue = ew_HtmlEncode($this->addon05Price->CurrentValue);
			$this->addon05Price->PlaceHolder = ew_RemoveHtml($this->addon05Price->FldCaption());
			if (strval($this->addon05Price->EditValue) <> "" && is_numeric($this->addon05Price->EditValue)) $this->addon05Price->EditValue = ew_FormatNumber($this->addon05Price->EditValue, -2, -1, -2, 0);

			// Edit refer script
			// payDriveCarID

			$this->payDriveCarID->LinkCustomAttributes = "";
			$this->payDriveCarID->HrefValue = "";

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

			// s1DailyAED
			$this->s1DailyAED->LinkCustomAttributes = "";
			$this->s1DailyAED->HrefValue = "";

			// s1DailyKM
			$this->s1DailyKM->LinkCustomAttributes = "";
			$this->s1DailyKM->HrefValue = "";

			// s2DailyAED
			$this->s2DailyAED->LinkCustomAttributes = "";
			$this->s2DailyAED->HrefValue = "";

			// s2DailyKM
			$this->s2DailyKM->LinkCustomAttributes = "";
			$this->s2DailyKM->HrefValue = "";

			// s3DailyAED
			$this->s3DailyAED->LinkCustomAttributes = "";
			$this->s3DailyAED->HrefValue = "";

			// s3DailyKM
			$this->s3DailyKM->LinkCustomAttributes = "";
			$this->s3DailyKM->HrefValue = "";

			// s4DailyAED
			$this->s4DailyAED->LinkCustomAttributes = "";
			$this->s4DailyAED->HrefValue = "";

			// s4DailyKM
			$this->s4DailyKM->LinkCustomAttributes = "";
			$this->s4DailyKM->HrefValue = "";

			// s5DailyAED
			$this->s5DailyAED->LinkCustomAttributes = "";
			$this->s5DailyAED->HrefValue = "";

			// s5DailyKM
			$this->s5DailyKM->LinkCustomAttributes = "";
			$this->s5DailyKM->HrefValue = "";

			// s1WeeklyAED
			$this->s1WeeklyAED->LinkCustomAttributes = "";
			$this->s1WeeklyAED->HrefValue = "";

			// s1WeeklyKM
			$this->s1WeeklyKM->LinkCustomAttributes = "";
			$this->s1WeeklyKM->HrefValue = "";

			// s2WeeklyAED
			$this->s2WeeklyAED->LinkCustomAttributes = "";
			$this->s2WeeklyAED->HrefValue = "";

			// s2WeeklyKM
			$this->s2WeeklyKM->LinkCustomAttributes = "";
			$this->s2WeeklyKM->HrefValue = "";

			// s3WeeklyAED
			$this->s3WeeklyAED->LinkCustomAttributes = "";
			$this->s3WeeklyAED->HrefValue = "";

			// s3WeeklyKM
			$this->s3WeeklyKM->LinkCustomAttributes = "";
			$this->s3WeeklyKM->HrefValue = "";

			// s4WeeklyAED
			$this->s4WeeklyAED->LinkCustomAttributes = "";
			$this->s4WeeklyAED->HrefValue = "";

			// s4WeeklyKM
			$this->s4WeeklyKM->LinkCustomAttributes = "";
			$this->s4WeeklyKM->HrefValue = "";

			// s5WeeklyAED
			$this->s5WeeklyAED->LinkCustomAttributes = "";
			$this->s5WeeklyAED->HrefValue = "";

			// s5WeeklyKM
			$this->s5WeeklyKM->LinkCustomAttributes = "";
			$this->s5WeeklyKM->HrefValue = "";

			// s1MonthlyAED
			$this->s1MonthlyAED->LinkCustomAttributes = "";
			$this->s1MonthlyAED->HrefValue = "";

			// s1MonthlyKM
			$this->s1MonthlyKM->LinkCustomAttributes = "";
			$this->s1MonthlyKM->HrefValue = "";

			// s2MonthlyAED
			$this->s2MonthlyAED->LinkCustomAttributes = "";
			$this->s2MonthlyAED->HrefValue = "";

			// s2MonthlyKM
			$this->s2MonthlyKM->LinkCustomAttributes = "";
			$this->s2MonthlyKM->HrefValue = "";

			// s3MonthlyAED
			$this->s3MonthlyAED->LinkCustomAttributes = "";
			$this->s3MonthlyAED->HrefValue = "";

			// s3MonthlyKM
			$this->s3MonthlyKM->LinkCustomAttributes = "";
			$this->s3MonthlyKM->HrefValue = "";

			// s4MonthlyAED
			$this->s4MonthlyAED->LinkCustomAttributes = "";
			$this->s4MonthlyAED->HrefValue = "";

			// s4MonthlyKM
			$this->s4MonthlyKM->LinkCustomAttributes = "";
			$this->s4MonthlyKM->HrefValue = "";

			// s5MonthlyAED
			$this->s5MonthlyAED->LinkCustomAttributes = "";
			$this->s5MonthlyAED->HrefValue = "";

			// s5MonthlyKM
			$this->s5MonthlyKM->LinkCustomAttributes = "";
			$this->s5MonthlyKM->HrefValue = "";

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

			// addon01KM
			$this->addon01KM->LinkCustomAttributes = "";
			$this->addon01KM->HrefValue = "";

			// addon01Price
			$this->addon01Price->LinkCustomAttributes = "";
			$this->addon01Price->HrefValue = "";

			// addon02KM
			$this->addon02KM->LinkCustomAttributes = "";
			$this->addon02KM->HrefValue = "";

			// addon02Price
			$this->addon02Price->LinkCustomAttributes = "";
			$this->addon02Price->HrefValue = "";

			// addon03KM
			$this->addon03KM->LinkCustomAttributes = "";
			$this->addon03KM->HrefValue = "";

			// addon03Price
			$this->addon03Price->LinkCustomAttributes = "";
			$this->addon03Price->HrefValue = "";

			// addon04KM
			$this->addon04KM->LinkCustomAttributes = "";
			$this->addon04KM->HrefValue = "";

			// addon04Price
			$this->addon04Price->LinkCustomAttributes = "";
			$this->addon04Price->HrefValue = "";

			// addon05KM
			$this->addon05KM->LinkCustomAttributes = "";
			$this->addon05KM->HrefValue = "";

			// addon05Price
			$this->addon05Price->LinkCustomAttributes = "";
			$this->addon05Price->HrefValue = "";
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
		if (!ew_CheckNumber($this->s1DailyAED->FormValue)) {
			ew_AddMessage($gsFormError, $this->s1DailyAED->FldErrMsg());
		}
		if (!ew_CheckInteger($this->s1DailyKM->FormValue)) {
			ew_AddMessage($gsFormError, $this->s1DailyKM->FldErrMsg());
		}
		if (!ew_CheckNumber($this->s2DailyAED->FormValue)) {
			ew_AddMessage($gsFormError, $this->s2DailyAED->FldErrMsg());
		}
		if (!ew_CheckInteger($this->s2DailyKM->FormValue)) {
			ew_AddMessage($gsFormError, $this->s2DailyKM->FldErrMsg());
		}
		if (!ew_CheckNumber($this->s3DailyAED->FormValue)) {
			ew_AddMessage($gsFormError, $this->s3DailyAED->FldErrMsg());
		}
		if (!ew_CheckInteger($this->s3DailyKM->FormValue)) {
			ew_AddMessage($gsFormError, $this->s3DailyKM->FldErrMsg());
		}
		if (!ew_CheckNumber($this->s4DailyAED->FormValue)) {
			ew_AddMessage($gsFormError, $this->s4DailyAED->FldErrMsg());
		}
		if (!ew_CheckInteger($this->s4DailyKM->FormValue)) {
			ew_AddMessage($gsFormError, $this->s4DailyKM->FldErrMsg());
		}
		if (!ew_CheckNumber($this->s5DailyAED->FormValue)) {
			ew_AddMessage($gsFormError, $this->s5DailyAED->FldErrMsg());
		}
		if (!ew_CheckInteger($this->s5DailyKM->FormValue)) {
			ew_AddMessage($gsFormError, $this->s5DailyKM->FldErrMsg());
		}
		if (!ew_CheckNumber($this->s1WeeklyAED->FormValue)) {
			ew_AddMessage($gsFormError, $this->s1WeeklyAED->FldErrMsg());
		}
		if (!ew_CheckInteger($this->s1WeeklyKM->FormValue)) {
			ew_AddMessage($gsFormError, $this->s1WeeklyKM->FldErrMsg());
		}
		if (!ew_CheckNumber($this->s2WeeklyAED->FormValue)) {
			ew_AddMessage($gsFormError, $this->s2WeeklyAED->FldErrMsg());
		}
		if (!ew_CheckInteger($this->s2WeeklyKM->FormValue)) {
			ew_AddMessage($gsFormError, $this->s2WeeklyKM->FldErrMsg());
		}
		if (!ew_CheckNumber($this->s3WeeklyAED->FormValue)) {
			ew_AddMessage($gsFormError, $this->s3WeeklyAED->FldErrMsg());
		}
		if (!ew_CheckInteger($this->s3WeeklyKM->FormValue)) {
			ew_AddMessage($gsFormError, $this->s3WeeklyKM->FldErrMsg());
		}
		if (!ew_CheckNumber($this->s4WeeklyAED->FormValue)) {
			ew_AddMessage($gsFormError, $this->s4WeeklyAED->FldErrMsg());
		}
		if (!ew_CheckInteger($this->s4WeeklyKM->FormValue)) {
			ew_AddMessage($gsFormError, $this->s4WeeklyKM->FldErrMsg());
		}
		if (!ew_CheckNumber($this->s5WeeklyAED->FormValue)) {
			ew_AddMessage($gsFormError, $this->s5WeeklyAED->FldErrMsg());
		}
		if (!ew_CheckInteger($this->s5WeeklyKM->FormValue)) {
			ew_AddMessage($gsFormError, $this->s5WeeklyKM->FldErrMsg());
		}
		if (!ew_CheckNumber($this->s1MonthlyAED->FormValue)) {
			ew_AddMessage($gsFormError, $this->s1MonthlyAED->FldErrMsg());
		}
		if (!ew_CheckInteger($this->s1MonthlyKM->FormValue)) {
			ew_AddMessage($gsFormError, $this->s1MonthlyKM->FldErrMsg());
		}
		if (!ew_CheckNumber($this->s2MonthlyAED->FormValue)) {
			ew_AddMessage($gsFormError, $this->s2MonthlyAED->FldErrMsg());
		}
		if (!ew_CheckInteger($this->s2MonthlyKM->FormValue)) {
			ew_AddMessage($gsFormError, $this->s2MonthlyKM->FldErrMsg());
		}
		if (!ew_CheckNumber($this->s3MonthlyAED->FormValue)) {
			ew_AddMessage($gsFormError, $this->s3MonthlyAED->FldErrMsg());
		}
		if (!ew_CheckInteger($this->s3MonthlyKM->FormValue)) {
			ew_AddMessage($gsFormError, $this->s3MonthlyKM->FldErrMsg());
		}
		if (!ew_CheckNumber($this->s4MonthlyAED->FormValue)) {
			ew_AddMessage($gsFormError, $this->s4MonthlyAED->FldErrMsg());
		}
		if (!ew_CheckInteger($this->s4MonthlyKM->FormValue)) {
			ew_AddMessage($gsFormError, $this->s4MonthlyKM->FldErrMsg());
		}
		if (!ew_CheckNumber($this->s5MonthlyAED->FormValue)) {
			ew_AddMessage($gsFormError, $this->s5MonthlyAED->FldErrMsg());
		}
		if (!ew_CheckInteger($this->s5MonthlyKM->FormValue)) {
			ew_AddMessage($gsFormError, $this->s5MonthlyKM->FldErrMsg());
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
		if (!ew_CheckNumber($this->addon01KM->FormValue)) {
			ew_AddMessage($gsFormError, $this->addon01KM->FldErrMsg());
		}
		if (!ew_CheckNumber($this->addon01Price->FormValue)) {
			ew_AddMessage($gsFormError, $this->addon01Price->FldErrMsg());
		}
		if (!ew_CheckNumber($this->addon02KM->FormValue)) {
			ew_AddMessage($gsFormError, $this->addon02KM->FldErrMsg());
		}
		if (!ew_CheckNumber($this->addon02Price->FormValue)) {
			ew_AddMessage($gsFormError, $this->addon02Price->FldErrMsg());
		}
		if (!ew_CheckNumber($this->addon03KM->FormValue)) {
			ew_AddMessage($gsFormError, $this->addon03KM->FldErrMsg());
		}
		if (!ew_CheckNumber($this->addon03Price->FormValue)) {
			ew_AddMessage($gsFormError, $this->addon03Price->FldErrMsg());
		}
		if (!ew_CheckNumber($this->addon04KM->FormValue)) {
			ew_AddMessage($gsFormError, $this->addon04KM->FldErrMsg());
		}
		if (!ew_CheckNumber($this->addon04Price->FormValue)) {
			ew_AddMessage($gsFormError, $this->addon04Price->FldErrMsg());
		}
		if (!ew_CheckNumber($this->addon05KM->FormValue)) {
			ew_AddMessage($gsFormError, $this->addon05KM->FldErrMsg());
		}
		if (!ew_CheckNumber($this->addon05Price->FormValue)) {
			ew_AddMessage($gsFormError, $this->addon05Price->FldErrMsg());
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
			$this->image->OldUploadPath = 'uploads/rentlease';
			$this->image->UploadPath = $this->image->OldUploadPath;
			$rsnew = array();

			// bodyTypeID
			$this->bodyTypeID->SetDbValueDef($rsnew, $this->bodyTypeID->CurrentValue, NULL, $this->bodyTypeID->ReadOnly);

			// carTitle
			$this->carTitle->SetDbValueDef($rsnew, $this->carTitle->CurrentValue, NULL, $this->carTitle->ReadOnly);

			// slug
			$this->slug->SetDbValueDef($rsnew, $this->slug->CurrentValue, NULL, $this->slug->ReadOnly);

			// image
			if ($this->image->Visible && !$this->image->ReadOnly && !$this->image->Upload->KeepFile) {
				$this->image->Upload->DbValue = $rsold['image']; // Get original value
				if ($this->image->Upload->FileName == "") {
					$rsnew['image'] = NULL;
				} else {
					$rsnew['image'] = $this->image->Upload->FileName;
				}
			}

			// extraFeatures
			$this->extraFeatures->SetDbValueDef($rsnew, $this->extraFeatures->CurrentValue, NULL, $this->extraFeatures->ReadOnly);

			// noOfSeats
			$this->noOfSeats->SetDbValueDef($rsnew, $this->noOfSeats->CurrentValue, NULL, $this->noOfSeats->ReadOnly);

			// luggage
			$this->luggage->SetDbValueDef($rsnew, $this->luggage->CurrentValue, NULL, $this->luggage->ReadOnly);

			// transmissionID
			$this->transmissionID->SetDbValueDef($rsnew, $this->transmissionID->CurrentValue, NULL, $this->transmissionID->ReadOnly);

			// ac
			$tmpBool = $this->ac->CurrentValue;
			if ($tmpBool <> "Y" && $tmpBool <> "N")
				$tmpBool = (!empty($tmpBool)) ? "Y" : "N";
			$this->ac->SetDbValueDef($rsnew, $tmpBool, NULL, $this->ac->ReadOnly);

			// noOfDoors
			$this->noOfDoors->SetDbValueDef($rsnew, $this->noOfDoors->CurrentValue, NULL, $this->noOfDoors->ReadOnly);

			// s1DailyAED
			$this->s1DailyAED->SetDbValueDef($rsnew, $this->s1DailyAED->CurrentValue, NULL, $this->s1DailyAED->ReadOnly);

			// s1DailyKM
			$this->s1DailyKM->SetDbValueDef($rsnew, $this->s1DailyKM->CurrentValue, NULL, $this->s1DailyKM->ReadOnly);

			// s2DailyAED
			$this->s2DailyAED->SetDbValueDef($rsnew, $this->s2DailyAED->CurrentValue, NULL, $this->s2DailyAED->ReadOnly);

			// s2DailyKM
			$this->s2DailyKM->SetDbValueDef($rsnew, $this->s2DailyKM->CurrentValue, NULL, $this->s2DailyKM->ReadOnly);

			// s3DailyAED
			$this->s3DailyAED->SetDbValueDef($rsnew, $this->s3DailyAED->CurrentValue, NULL, $this->s3DailyAED->ReadOnly);

			// s3DailyKM
			$this->s3DailyKM->SetDbValueDef($rsnew, $this->s3DailyKM->CurrentValue, NULL, $this->s3DailyKM->ReadOnly);

			// s4DailyAED
			$this->s4DailyAED->SetDbValueDef($rsnew, $this->s4DailyAED->CurrentValue, NULL, $this->s4DailyAED->ReadOnly);

			// s4DailyKM
			$this->s4DailyKM->SetDbValueDef($rsnew, $this->s4DailyKM->CurrentValue, NULL, $this->s4DailyKM->ReadOnly);

			// s5DailyAED
			$this->s5DailyAED->SetDbValueDef($rsnew, $this->s5DailyAED->CurrentValue, NULL, $this->s5DailyAED->ReadOnly);

			// s5DailyKM
			$this->s5DailyKM->SetDbValueDef($rsnew, $this->s5DailyKM->CurrentValue, NULL, $this->s5DailyKM->ReadOnly);

			// s1WeeklyAED
			$this->s1WeeklyAED->SetDbValueDef($rsnew, $this->s1WeeklyAED->CurrentValue, NULL, $this->s1WeeklyAED->ReadOnly);

			// s1WeeklyKM
			$this->s1WeeklyKM->SetDbValueDef($rsnew, $this->s1WeeklyKM->CurrentValue, NULL, $this->s1WeeklyKM->ReadOnly);

			// s2WeeklyAED
			$this->s2WeeklyAED->SetDbValueDef($rsnew, $this->s2WeeklyAED->CurrentValue, NULL, $this->s2WeeklyAED->ReadOnly);

			// s2WeeklyKM
			$this->s2WeeklyKM->SetDbValueDef($rsnew, $this->s2WeeklyKM->CurrentValue, NULL, $this->s2WeeklyKM->ReadOnly);

			// s3WeeklyAED
			$this->s3WeeklyAED->SetDbValueDef($rsnew, $this->s3WeeklyAED->CurrentValue, NULL, $this->s3WeeklyAED->ReadOnly);

			// s3WeeklyKM
			$this->s3WeeklyKM->SetDbValueDef($rsnew, $this->s3WeeklyKM->CurrentValue, NULL, $this->s3WeeklyKM->ReadOnly);

			// s4WeeklyAED
			$this->s4WeeklyAED->SetDbValueDef($rsnew, $this->s4WeeklyAED->CurrentValue, NULL, $this->s4WeeklyAED->ReadOnly);

			// s4WeeklyKM
			$this->s4WeeklyKM->SetDbValueDef($rsnew, $this->s4WeeklyKM->CurrentValue, NULL, $this->s4WeeklyKM->ReadOnly);

			// s5WeeklyAED
			$this->s5WeeklyAED->SetDbValueDef($rsnew, $this->s5WeeklyAED->CurrentValue, NULL, $this->s5WeeklyAED->ReadOnly);

			// s5WeeklyKM
			$this->s5WeeklyKM->SetDbValueDef($rsnew, $this->s5WeeklyKM->CurrentValue, NULL, $this->s5WeeklyKM->ReadOnly);

			// s1MonthlyAED
			$this->s1MonthlyAED->SetDbValueDef($rsnew, $this->s1MonthlyAED->CurrentValue, NULL, $this->s1MonthlyAED->ReadOnly);

			// s1MonthlyKM
			$this->s1MonthlyKM->SetDbValueDef($rsnew, $this->s1MonthlyKM->CurrentValue, NULL, $this->s1MonthlyKM->ReadOnly);

			// s2MonthlyAED
			$this->s2MonthlyAED->SetDbValueDef($rsnew, $this->s2MonthlyAED->CurrentValue, NULL, $this->s2MonthlyAED->ReadOnly);

			// s2MonthlyKM
			$this->s2MonthlyKM->SetDbValueDef($rsnew, $this->s2MonthlyKM->CurrentValue, NULL, $this->s2MonthlyKM->ReadOnly);

			// s3MonthlyAED
			$this->s3MonthlyAED->SetDbValueDef($rsnew, $this->s3MonthlyAED->CurrentValue, NULL, $this->s3MonthlyAED->ReadOnly);

			// s3MonthlyKM
			$this->s3MonthlyKM->SetDbValueDef($rsnew, $this->s3MonthlyKM->CurrentValue, NULL, $this->s3MonthlyKM->ReadOnly);

			// s4MonthlyAED
			$this->s4MonthlyAED->SetDbValueDef($rsnew, $this->s4MonthlyAED->CurrentValue, NULL, $this->s4MonthlyAED->ReadOnly);

			// s4MonthlyKM
			$this->s4MonthlyKM->SetDbValueDef($rsnew, $this->s4MonthlyKM->CurrentValue, NULL, $this->s4MonthlyKM->ReadOnly);

			// s5MonthlyAED
			$this->s5MonthlyAED->SetDbValueDef($rsnew, $this->s5MonthlyAED->CurrentValue, NULL, $this->s5MonthlyAED->ReadOnly);

			// s5MonthlyKM
			$this->s5MonthlyKM->SetDbValueDef($rsnew, $this->s5MonthlyKM->CurrentValue, NULL, $this->s5MonthlyKM->ReadOnly);

			// active
			$this->active->SetDbValueDef($rsnew, $this->active->CurrentValue, NULL, $this->active->ReadOnly);

			// phase1OrangeCard
			$this->phase1OrangeCard->SetDbValueDef($rsnew, $this->phase1OrangeCard->CurrentValue, NULL, $this->phase1OrangeCard->ReadOnly);

			// phase1GPS
			$this->phase1GPS->SetDbValueDef($rsnew, $this->phase1GPS->CurrentValue, NULL, $this->phase1GPS->ReadOnly);

			// phase1DeliveryCharges
			$this->phase1DeliveryCharges->SetDbValueDef($rsnew, $this->phase1DeliveryCharges->CurrentValue, NULL, $this->phase1DeliveryCharges->ReadOnly);

			// phase1CollectionCharges
			$this->phase1CollectionCharges->SetDbValueDef($rsnew, $this->phase1CollectionCharges->CurrentValue, NULL, $this->phase1CollectionCharges->ReadOnly);

			// addon01KM
			$this->addon01KM->SetDbValueDef($rsnew, $this->addon01KM->CurrentValue, NULL, $this->addon01KM->ReadOnly);

			// addon01Price
			$this->addon01Price->SetDbValueDef($rsnew, $this->addon01Price->CurrentValue, NULL, $this->addon01Price->ReadOnly);

			// addon02KM
			$this->addon02KM->SetDbValueDef($rsnew, $this->addon02KM->CurrentValue, NULL, $this->addon02KM->ReadOnly);

			// addon02Price
			$this->addon02Price->SetDbValueDef($rsnew, $this->addon02Price->CurrentValue, NULL, $this->addon02Price->ReadOnly);

			// addon03KM
			$this->addon03KM->SetDbValueDef($rsnew, $this->addon03KM->CurrentValue, NULL, $this->addon03KM->ReadOnly);

			// addon03Price
			$this->addon03Price->SetDbValueDef($rsnew, $this->addon03Price->CurrentValue, NULL, $this->addon03Price->ReadOnly);

			// addon04KM
			$this->addon04KM->SetDbValueDef($rsnew, $this->addon04KM->CurrentValue, NULL, $this->addon04KM->ReadOnly);

			// addon04Price
			$this->addon04Price->SetDbValueDef($rsnew, $this->addon04Price->CurrentValue, NULL, $this->addon04Price->ReadOnly);

			// addon05KM
			$this->addon05KM->SetDbValueDef($rsnew, $this->addon05KM->CurrentValue, NULL, $this->addon05KM->ReadOnly);

			// addon05Price
			$this->addon05Price->SetDbValueDef($rsnew, $this->addon05Price->CurrentValue, NULL, $this->addon05Price->ReadOnly);
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
					$this->image->SetDbValueDef($rsnew, $this->image->Upload->FileName, NULL, $this->image->ReadOnly);
				}
			}

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
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// image
		ew_CleanUploadTempPath($this->image, $this->image->Upload->Index);
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("pay_as_you_drivelist.php"), "", $this->TableVar, TRUE);
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
		$pages->Add(4);
		$pages->Add(5);
		$pages->Add(6);
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
if (!isset($pay_as_you_drive_edit)) $pay_as_you_drive_edit = new cpay_as_you_drive_edit();

// Page init
$pay_as_you_drive_edit->Page_Init();

// Page main
$pay_as_you_drive_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pay_as_you_drive_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = fpay_as_you_driveedit = new ew_Form("fpay_as_you_driveedit", "edit");

// Validate form
fpay_as_you_driveedit.Validate = function() {
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
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->noOfSeats->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_luggage");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->luggage->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_noOfDoors");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->noOfDoors->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s1DailyAED");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s1DailyAED->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s1DailyKM");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s1DailyKM->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s2DailyAED");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s2DailyAED->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s2DailyKM");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s2DailyKM->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s3DailyAED");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s3DailyAED->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s3DailyKM");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s3DailyKM->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s4DailyAED");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s4DailyAED->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s4DailyKM");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s4DailyKM->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s5DailyAED");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s5DailyAED->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s5DailyKM");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s5DailyKM->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s1WeeklyAED");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s1WeeklyAED->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s1WeeklyKM");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s1WeeklyKM->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s2WeeklyAED");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s2WeeklyAED->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s2WeeklyKM");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s2WeeklyKM->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s3WeeklyAED");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s3WeeklyAED->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s3WeeklyKM");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s3WeeklyKM->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s4WeeklyAED");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s4WeeklyAED->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s4WeeklyKM");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s4WeeklyKM->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s5WeeklyAED");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s5WeeklyAED->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s5WeeklyKM");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s5WeeklyKM->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s1MonthlyAED");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s1MonthlyAED->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s1MonthlyKM");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s1MonthlyKM->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s2MonthlyAED");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s2MonthlyAED->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s2MonthlyKM");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s2MonthlyKM->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s3MonthlyAED");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s3MonthlyAED->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s3MonthlyKM");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s3MonthlyKM->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s4MonthlyAED");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s4MonthlyAED->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s4MonthlyKM");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s4MonthlyKM->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s5MonthlyAED");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s5MonthlyAED->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_s5MonthlyKM");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->s5MonthlyKM->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_phase1OrangeCard");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->phase1OrangeCard->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_phase1GPS");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->phase1GPS->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_phase1DeliveryCharges");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->phase1DeliveryCharges->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_phase1CollectionCharges");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->phase1CollectionCharges->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_addon01KM");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->addon01KM->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_addon01Price");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->addon01Price->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_addon02KM");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->addon02KM->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_addon02Price");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->addon02Price->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_addon03KM");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->addon03KM->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_addon03Price");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->addon03Price->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_addon04KM");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->addon04KM->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_addon04Price");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->addon04Price->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_addon05KM");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->addon05KM->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_addon05Price");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pay_as_you_drive->addon05Price->FldErrMsg()) ?>");

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
fpay_as_you_driveedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fpay_as_you_driveedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Multi-Page
fpay_as_you_driveedit.MultiPage = new ew_MultiPage("fpay_as_you_driveedit");

// Dynamic selection lists
fpay_as_you_driveedit.Lists["x_bodyTypeID"] = {"LinkField":"x_bodyTypeID","Ajax":true,"AutoFill":false,"DisplayFields":["x_bodytype","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_bodytype"};
fpay_as_you_driveedit.Lists["x_bodyTypeID"].Data = "<?php echo $pay_as_you_drive_edit->bodyTypeID->LookupFilterQuery(FALSE, "edit") ?>";
fpay_as_you_driveedit.Lists["x_extraFeatures[]"] = {"LinkField":"x_featureID","Ajax":true,"AutoFill":false,"DisplayFields":["x_extraFeatures","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_extra_features"};
fpay_as_you_driveedit.Lists["x_extraFeatures[]"].Data = "<?php echo $pay_as_you_drive_edit->extraFeatures->LookupFilterQuery(FALSE, "edit") ?>";
fpay_as_you_driveedit.Lists["x_transmissionID"] = {"LinkField":"x_transmissionID","Ajax":true,"AutoFill":false,"DisplayFields":["x_transmission","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_transmission"};
fpay_as_you_driveedit.Lists["x_transmissionID"].Data = "<?php echo $pay_as_you_drive_edit->transmissionID->LookupFilterQuery(FALSE, "edit") ?>";
fpay_as_you_driveedit.Lists["x_ac[]"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fpay_as_you_driveedit.Lists["x_ac[]"].Options = <?php echo json_encode($pay_as_you_drive_edit->ac->Options()) ?>;
fpay_as_you_driveedit.Lists["x_active"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fpay_as_you_driveedit.Lists["x_active"].Options = <?php echo json_encode($pay_as_you_drive_edit->active->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $pay_as_you_drive_edit->ShowPageHeader(); ?>
<?php
$pay_as_you_drive_edit->ShowMessage();
?>
<form name="fpay_as_you_driveedit" id="fpay_as_you_driveedit" class="<?php echo $pay_as_you_drive_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($pay_as_you_drive_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $pay_as_you_drive_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pay_as_you_drive">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($pay_as_you_drive_edit->IsModal) ?>">
<div class="ewMultiPage"><!-- multi-page -->
<div class="nav-tabs-custom" id="pay_as_you_drive_edit"><!-- multi-page .nav-tabs-custom -->
	<ul class="nav<?php echo $pay_as_you_drive_edit->MultiPages->NavStyle() ?>">
		<li<?php echo $pay_as_you_drive_edit->MultiPages->TabStyle("1") ?>><a href="#tab_pay_as_you_drive1" data-toggle="tab"><?php echo $pay_as_you_drive->PageCaption(1) ?></a></li>
		<li<?php echo $pay_as_you_drive_edit->MultiPages->TabStyle("2") ?>><a href="#tab_pay_as_you_drive2" data-toggle="tab"><?php echo $pay_as_you_drive->PageCaption(2) ?></a></li>
		<li<?php echo $pay_as_you_drive_edit->MultiPages->TabStyle("3") ?>><a href="#tab_pay_as_you_drive3" data-toggle="tab"><?php echo $pay_as_you_drive->PageCaption(3) ?></a></li>
		<li<?php echo $pay_as_you_drive_edit->MultiPages->TabStyle("4") ?>><a href="#tab_pay_as_you_drive4" data-toggle="tab"><?php echo $pay_as_you_drive->PageCaption(4) ?></a></li>
		<li<?php echo $pay_as_you_drive_edit->MultiPages->TabStyle("5") ?>><a href="#tab_pay_as_you_drive5" data-toggle="tab"><?php echo $pay_as_you_drive->PageCaption(5) ?></a></li>
		<li<?php echo $pay_as_you_drive_edit->MultiPages->TabStyle("6") ?>><a href="#tab_pay_as_you_drive6" data-toggle="tab"><?php echo $pay_as_you_drive->PageCaption(6) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page .nav-tabs-custom .tab-content -->
		<div class="tab-pane<?php echo $pay_as_you_drive_edit->MultiPages->PageStyle("1") ?>" id="tab_pay_as_you_drive1"><!-- multi-page .tab-pane -->
<div class="ewEditDiv"><!-- page* -->
<?php if ($pay_as_you_drive->payDriveCarID->Visible) { // payDriveCarID ?>
	<div id="r_payDriveCarID" class="form-group">
		<label id="elh_pay_as_you_drive_payDriveCarID" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->payDriveCarID->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->payDriveCarID->CellAttributes() ?>>
<span id="el_pay_as_you_drive_payDriveCarID">
<span<?php echo $pay_as_you_drive->payDriveCarID->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pay_as_you_drive->payDriveCarID->EditValue ?></p></span>
</span>
<input type="hidden" data-table="pay_as_you_drive" data-field="x_payDriveCarID" data-page="1" name="x_payDriveCarID" id="x_payDriveCarID" value="<?php echo ew_HtmlEncode($pay_as_you_drive->payDriveCarID->CurrentValue) ?>">
<?php echo $pay_as_you_drive->payDriveCarID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->bodyTypeID->Visible) { // bodyTypeID ?>
	<div id="r_bodyTypeID" class="form-group">
		<label id="elh_pay_as_you_drive_bodyTypeID" for="x_bodyTypeID" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->bodyTypeID->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->bodyTypeID->CellAttributes() ?>>
<span id="el_pay_as_you_drive_bodyTypeID">
<select data-table="pay_as_you_drive" data-field="x_bodyTypeID" data-page="1" data-value-separator="<?php echo $pay_as_you_drive->bodyTypeID->DisplayValueSeparatorAttribute() ?>" id="x_bodyTypeID" name="x_bodyTypeID"<?php echo $pay_as_you_drive->bodyTypeID->EditAttributes() ?>>
<?php echo $pay_as_you_drive->bodyTypeID->SelectOptionListHtml("x_bodyTypeID") ?>
</select>
</span>
<?php echo $pay_as_you_drive->bodyTypeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->carTitle->Visible) { // carTitle ?>
	<div id="r_carTitle" class="form-group">
		<label id="elh_pay_as_you_drive_carTitle" for="x_carTitle" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->carTitle->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->carTitle->CellAttributes() ?>>
<span id="el_pay_as_you_drive_carTitle">
<input type="text" data-table="pay_as_you_drive" data-field="x_carTitle" data-page="1" name="x_carTitle" id="x_carTitle" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->carTitle->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->carTitle->EditValue ?>"<?php echo $pay_as_you_drive->carTitle->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->carTitle->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->slug->Visible) { // slug ?>
	<div id="r_slug" class="form-group">
		<label id="elh_pay_as_you_drive_slug" for="x_slug" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->slug->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->slug->CellAttributes() ?>>
<span id="el_pay_as_you_drive_slug">
<input type="text" data-table="pay_as_you_drive" data-field="x_slug" data-page="1" name="x_slug" id="x_slug" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->slug->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->slug->EditValue ?>"<?php echo $pay_as_you_drive->slug->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->slug->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->image->Visible) { // image ?>
	<div id="r_image" class="form-group">
		<label id="elh_pay_as_you_drive_image" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->image->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->image->CellAttributes() ?>>
<span id="el_pay_as_you_drive_image">
<div id="fd_x_image">
<span title="<?php echo $pay_as_you_drive->image->FldTitle() ? $pay_as_you_drive->image->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($pay_as_you_drive->image->ReadOnly || $pay_as_you_drive->image->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="pay_as_you_drive" data-field="x_image" data-page="1" name="x_image" id="x_image"<?php echo $pay_as_you_drive->image->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_image" id= "fn_x_image" value="<?php echo $pay_as_you_drive->image->Upload->FileName ?>">
<?php if (@$_POST["fa_x_image"] == "0") { ?>
<input type="hidden" name="fa_x_image" id= "fa_x_image" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_image" id= "fa_x_image" value="1">
<?php } ?>
<input type="hidden" name="fs_x_image" id= "fs_x_image" value="255">
<input type="hidden" name="fx_x_image" id= "fx_x_image" value="<?php echo $pay_as_you_drive->image->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_image" id= "fm_x_image" value="<?php echo $pay_as_you_drive->image->UploadMaxFileSize ?>">
</div>
<table id="ft_x_image" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $pay_as_you_drive->image->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->extraFeatures->Visible) { // extraFeatures ?>
	<div id="r_extraFeatures" class="form-group">
		<label id="elh_pay_as_you_drive_extraFeatures" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->extraFeatures->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->extraFeatures->CellAttributes() ?>>
<span id="el_pay_as_you_drive_extraFeatures">
<div id="tp_x_extraFeatures" class="ewTemplate"><input type="checkbox" data-table="pay_as_you_drive" data-field="x_extraFeatures" data-page="1" data-value-separator="<?php echo $pay_as_you_drive->extraFeatures->DisplayValueSeparatorAttribute() ?>" name="x_extraFeatures[]" id="x_extraFeatures[]" value="{value}"<?php echo $pay_as_you_drive->extraFeatures->EditAttributes() ?>></div>
<div id="dsl_x_extraFeatures" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $pay_as_you_drive->extraFeatures->CheckBoxListHtml(FALSE, "x_extraFeatures[]", 1) ?>
</div></div>
</span>
<?php echo $pay_as_you_drive->extraFeatures->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->noOfSeats->Visible) { // noOfSeats ?>
	<div id="r_noOfSeats" class="form-group">
		<label id="elh_pay_as_you_drive_noOfSeats" for="x_noOfSeats" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->noOfSeats->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->noOfSeats->CellAttributes() ?>>
<span id="el_pay_as_you_drive_noOfSeats">
<input type="text" data-table="pay_as_you_drive" data-field="x_noOfSeats" data-page="1" name="x_noOfSeats" id="x_noOfSeats" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->noOfSeats->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->noOfSeats->EditValue ?>"<?php echo $pay_as_you_drive->noOfSeats->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->noOfSeats->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->luggage->Visible) { // luggage ?>
	<div id="r_luggage" class="form-group">
		<label id="elh_pay_as_you_drive_luggage" for="x_luggage" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->luggage->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->luggage->CellAttributes() ?>>
<span id="el_pay_as_you_drive_luggage">
<input type="text" data-table="pay_as_you_drive" data-field="x_luggage" data-page="1" name="x_luggage" id="x_luggage" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->luggage->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->luggage->EditValue ?>"<?php echo $pay_as_you_drive->luggage->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->luggage->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->transmissionID->Visible) { // transmissionID ?>
	<div id="r_transmissionID" class="form-group">
		<label id="elh_pay_as_you_drive_transmissionID" for="x_transmissionID" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->transmissionID->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->transmissionID->CellAttributes() ?>>
<span id="el_pay_as_you_drive_transmissionID">
<select data-table="pay_as_you_drive" data-field="x_transmissionID" data-page="1" data-value-separator="<?php echo $pay_as_you_drive->transmissionID->DisplayValueSeparatorAttribute() ?>" id="x_transmissionID" name="x_transmissionID"<?php echo $pay_as_you_drive->transmissionID->EditAttributes() ?>>
<?php echo $pay_as_you_drive->transmissionID->SelectOptionListHtml("x_transmissionID") ?>
</select>
</span>
<?php echo $pay_as_you_drive->transmissionID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->ac->Visible) { // ac ?>
	<div id="r_ac" class="form-group">
		<label id="elh_pay_as_you_drive_ac" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->ac->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->ac->CellAttributes() ?>>
<span id="el_pay_as_you_drive_ac">
<?php
$selwrk = (ew_ConvertToBool($pay_as_you_drive->ac->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="pay_as_you_drive" data-field="x_ac" data-page="1" name="x_ac[]" id="x_ac[]" value="1"<?php echo $selwrk ?><?php echo $pay_as_you_drive->ac->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->ac->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->noOfDoors->Visible) { // noOfDoors ?>
	<div id="r_noOfDoors" class="form-group">
		<label id="elh_pay_as_you_drive_noOfDoors" for="x_noOfDoors" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->noOfDoors->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->noOfDoors->CellAttributes() ?>>
<span id="el_pay_as_you_drive_noOfDoors">
<input type="text" data-table="pay_as_you_drive" data-field="x_noOfDoors" data-page="1" name="x_noOfDoors" id="x_noOfDoors" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->noOfDoors->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->noOfDoors->EditValue ?>"<?php echo $pay_as_you_drive->noOfDoors->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->noOfDoors->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->active->Visible) { // active ?>
	<div id="r_active" class="form-group">
		<label id="elh_pay_as_you_drive_active" for="x_active" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->active->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->active->CellAttributes() ?>>
<span id="el_pay_as_you_drive_active">
<select data-table="pay_as_you_drive" data-field="x_active" data-page="1" data-value-separator="<?php echo $pay_as_you_drive->active->DisplayValueSeparatorAttribute() ?>" id="x_active" name="x_active"<?php echo $pay_as_you_drive->active->EditAttributes() ?>>
<?php echo $pay_as_you_drive->active->SelectOptionListHtml("x_active") ?>
</select>
</span>
<?php echo $pay_as_you_drive->active->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $pay_as_you_drive_edit->MultiPages->PageStyle("2") ?>" id="tab_pay_as_you_drive2"><!-- multi-page .tab-pane -->
<div class="ewEditDiv"><!-- page* -->
<?php if ($pay_as_you_drive->s1DailyAED->Visible) { // s1DailyAED ?>
	<div id="r_s1DailyAED" class="form-group">
		<label id="elh_pay_as_you_drive_s1DailyAED" for="x_s1DailyAED" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s1DailyAED->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s1DailyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s1DailyAED">
<input type="text" data-table="pay_as_you_drive" data-field="x_s1DailyAED" data-page="2" name="x_s1DailyAED" id="x_s1DailyAED" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s1DailyAED->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s1DailyAED->EditValue ?>"<?php echo $pay_as_you_drive->s1DailyAED->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s1DailyAED->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->s1DailyKM->Visible) { // s1DailyKM ?>
	<div id="r_s1DailyKM" class="form-group">
		<label id="elh_pay_as_you_drive_s1DailyKM" for="x_s1DailyKM" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s1DailyKM->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s1DailyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s1DailyKM">
<input type="text" data-table="pay_as_you_drive" data-field="x_s1DailyKM" data-page="2" name="x_s1DailyKM" id="x_s1DailyKM" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s1DailyKM->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s1DailyKM->EditValue ?>"<?php echo $pay_as_you_drive->s1DailyKM->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s1DailyKM->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->s2DailyAED->Visible) { // s2DailyAED ?>
	<div id="r_s2DailyAED" class="form-group">
		<label id="elh_pay_as_you_drive_s2DailyAED" for="x_s2DailyAED" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s2DailyAED->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s2DailyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s2DailyAED">
<input type="text" data-table="pay_as_you_drive" data-field="x_s2DailyAED" data-page="2" name="x_s2DailyAED" id="x_s2DailyAED" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s2DailyAED->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s2DailyAED->EditValue ?>"<?php echo $pay_as_you_drive->s2DailyAED->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s2DailyAED->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->s2DailyKM->Visible) { // s2DailyKM ?>
	<div id="r_s2DailyKM" class="form-group">
		<label id="elh_pay_as_you_drive_s2DailyKM" for="x_s2DailyKM" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s2DailyKM->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s2DailyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s2DailyKM">
<input type="text" data-table="pay_as_you_drive" data-field="x_s2DailyKM" data-page="2" name="x_s2DailyKM" id="x_s2DailyKM" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s2DailyKM->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s2DailyKM->EditValue ?>"<?php echo $pay_as_you_drive->s2DailyKM->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s2DailyKM->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->s3DailyAED->Visible) { // s3DailyAED ?>
	<div id="r_s3DailyAED" class="form-group">
		<label id="elh_pay_as_you_drive_s3DailyAED" for="x_s3DailyAED" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s3DailyAED->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s3DailyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s3DailyAED">
<input type="text" data-table="pay_as_you_drive" data-field="x_s3DailyAED" data-page="2" name="x_s3DailyAED" id="x_s3DailyAED" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s3DailyAED->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s3DailyAED->EditValue ?>"<?php echo $pay_as_you_drive->s3DailyAED->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s3DailyAED->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->s3DailyKM->Visible) { // s3DailyKM ?>
	<div id="r_s3DailyKM" class="form-group">
		<label id="elh_pay_as_you_drive_s3DailyKM" for="x_s3DailyKM" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s3DailyKM->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s3DailyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s3DailyKM">
<input type="text" data-table="pay_as_you_drive" data-field="x_s3DailyKM" data-page="2" name="x_s3DailyKM" id="x_s3DailyKM" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s3DailyKM->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s3DailyKM->EditValue ?>"<?php echo $pay_as_you_drive->s3DailyKM->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s3DailyKM->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->s4DailyAED->Visible) { // s4DailyAED ?>
	<div id="r_s4DailyAED" class="form-group">
		<label id="elh_pay_as_you_drive_s4DailyAED" for="x_s4DailyAED" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s4DailyAED->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s4DailyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s4DailyAED">
<input type="text" data-table="pay_as_you_drive" data-field="x_s4DailyAED" data-page="2" name="x_s4DailyAED" id="x_s4DailyAED" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s4DailyAED->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s4DailyAED->EditValue ?>"<?php echo $pay_as_you_drive->s4DailyAED->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s4DailyAED->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->s4DailyKM->Visible) { // s4DailyKM ?>
	<div id="r_s4DailyKM" class="form-group">
		<label id="elh_pay_as_you_drive_s4DailyKM" for="x_s4DailyKM" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s4DailyKM->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s4DailyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s4DailyKM">
<input type="text" data-table="pay_as_you_drive" data-field="x_s4DailyKM" data-page="2" name="x_s4DailyKM" id="x_s4DailyKM" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s4DailyKM->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s4DailyKM->EditValue ?>"<?php echo $pay_as_you_drive->s4DailyKM->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s4DailyKM->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->s5DailyAED->Visible) { // s5DailyAED ?>
	<div id="r_s5DailyAED" class="form-group">
		<label id="elh_pay_as_you_drive_s5DailyAED" for="x_s5DailyAED" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s5DailyAED->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s5DailyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s5DailyAED">
<input type="text" data-table="pay_as_you_drive" data-field="x_s5DailyAED" data-page="2" name="x_s5DailyAED" id="x_s5DailyAED" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s5DailyAED->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s5DailyAED->EditValue ?>"<?php echo $pay_as_you_drive->s5DailyAED->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s5DailyAED->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->s5DailyKM->Visible) { // s5DailyKM ?>
	<div id="r_s5DailyKM" class="form-group">
		<label id="elh_pay_as_you_drive_s5DailyKM" for="x_s5DailyKM" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s5DailyKM->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s5DailyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s5DailyKM">
<input type="text" data-table="pay_as_you_drive" data-field="x_s5DailyKM" data-page="2" name="x_s5DailyKM" id="x_s5DailyKM" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s5DailyKM->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s5DailyKM->EditValue ?>"<?php echo $pay_as_you_drive->s5DailyKM->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s5DailyKM->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $pay_as_you_drive_edit->MultiPages->PageStyle("3") ?>" id="tab_pay_as_you_drive3"><!-- multi-page .tab-pane -->
<div class="ewEditDiv"><!-- page* -->
<?php if ($pay_as_you_drive->s1WeeklyAED->Visible) { // s1WeeklyAED ?>
	<div id="r_s1WeeklyAED" class="form-group">
		<label id="elh_pay_as_you_drive_s1WeeklyAED" for="x_s1WeeklyAED" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s1WeeklyAED->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s1WeeklyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s1WeeklyAED">
<input type="text" data-table="pay_as_you_drive" data-field="x_s1WeeklyAED" data-page="3" name="x_s1WeeklyAED" id="x_s1WeeklyAED" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s1WeeklyAED->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s1WeeklyAED->EditValue ?>"<?php echo $pay_as_you_drive->s1WeeklyAED->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s1WeeklyAED->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->s1WeeklyKM->Visible) { // s1WeeklyKM ?>
	<div id="r_s1WeeklyKM" class="form-group">
		<label id="elh_pay_as_you_drive_s1WeeklyKM" for="x_s1WeeklyKM" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s1WeeklyKM->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s1WeeklyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s1WeeklyKM">
<input type="text" data-table="pay_as_you_drive" data-field="x_s1WeeklyKM" data-page="3" name="x_s1WeeklyKM" id="x_s1WeeklyKM" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s1WeeklyKM->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s1WeeklyKM->EditValue ?>"<?php echo $pay_as_you_drive->s1WeeklyKM->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s1WeeklyKM->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->s2WeeklyAED->Visible) { // s2WeeklyAED ?>
	<div id="r_s2WeeklyAED" class="form-group">
		<label id="elh_pay_as_you_drive_s2WeeklyAED" for="x_s2WeeklyAED" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s2WeeklyAED->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s2WeeklyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s2WeeklyAED">
<input type="text" data-table="pay_as_you_drive" data-field="x_s2WeeklyAED" data-page="3" name="x_s2WeeklyAED" id="x_s2WeeklyAED" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s2WeeklyAED->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s2WeeklyAED->EditValue ?>"<?php echo $pay_as_you_drive->s2WeeklyAED->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s2WeeklyAED->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->s2WeeklyKM->Visible) { // s2WeeklyKM ?>
	<div id="r_s2WeeklyKM" class="form-group">
		<label id="elh_pay_as_you_drive_s2WeeklyKM" for="x_s2WeeklyKM" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s2WeeklyKM->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s2WeeklyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s2WeeklyKM">
<input type="text" data-table="pay_as_you_drive" data-field="x_s2WeeklyKM" data-page="3" name="x_s2WeeklyKM" id="x_s2WeeklyKM" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s2WeeklyKM->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s2WeeklyKM->EditValue ?>"<?php echo $pay_as_you_drive->s2WeeklyKM->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s2WeeklyKM->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->s3WeeklyAED->Visible) { // s3WeeklyAED ?>
	<div id="r_s3WeeklyAED" class="form-group">
		<label id="elh_pay_as_you_drive_s3WeeklyAED" for="x_s3WeeklyAED" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s3WeeklyAED->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s3WeeklyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s3WeeklyAED">
<input type="text" data-table="pay_as_you_drive" data-field="x_s3WeeklyAED" data-page="3" name="x_s3WeeklyAED" id="x_s3WeeklyAED" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s3WeeklyAED->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s3WeeklyAED->EditValue ?>"<?php echo $pay_as_you_drive->s3WeeklyAED->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s3WeeklyAED->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->s3WeeklyKM->Visible) { // s3WeeklyKM ?>
	<div id="r_s3WeeklyKM" class="form-group">
		<label id="elh_pay_as_you_drive_s3WeeklyKM" for="x_s3WeeklyKM" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s3WeeklyKM->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s3WeeklyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s3WeeklyKM">
<input type="text" data-table="pay_as_you_drive" data-field="x_s3WeeklyKM" data-page="3" name="x_s3WeeklyKM" id="x_s3WeeklyKM" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s3WeeklyKM->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s3WeeklyKM->EditValue ?>"<?php echo $pay_as_you_drive->s3WeeklyKM->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s3WeeklyKM->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->s4WeeklyAED->Visible) { // s4WeeklyAED ?>
	<div id="r_s4WeeklyAED" class="form-group">
		<label id="elh_pay_as_you_drive_s4WeeklyAED" for="x_s4WeeklyAED" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s4WeeklyAED->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s4WeeklyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s4WeeklyAED">
<input type="text" data-table="pay_as_you_drive" data-field="x_s4WeeklyAED" data-page="3" name="x_s4WeeklyAED" id="x_s4WeeklyAED" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s4WeeklyAED->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s4WeeklyAED->EditValue ?>"<?php echo $pay_as_you_drive->s4WeeklyAED->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s4WeeklyAED->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->s4WeeklyKM->Visible) { // s4WeeklyKM ?>
	<div id="r_s4WeeklyKM" class="form-group">
		<label id="elh_pay_as_you_drive_s4WeeklyKM" for="x_s4WeeklyKM" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s4WeeklyKM->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s4WeeklyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s4WeeklyKM">
<input type="text" data-table="pay_as_you_drive" data-field="x_s4WeeklyKM" data-page="3" name="x_s4WeeklyKM" id="x_s4WeeklyKM" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s4WeeklyKM->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s4WeeklyKM->EditValue ?>"<?php echo $pay_as_you_drive->s4WeeklyKM->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s4WeeklyKM->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->s5WeeklyAED->Visible) { // s5WeeklyAED ?>
	<div id="r_s5WeeklyAED" class="form-group">
		<label id="elh_pay_as_you_drive_s5WeeklyAED" for="x_s5WeeklyAED" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s5WeeklyAED->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s5WeeklyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s5WeeklyAED">
<input type="text" data-table="pay_as_you_drive" data-field="x_s5WeeklyAED" data-page="3" name="x_s5WeeklyAED" id="x_s5WeeklyAED" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s5WeeklyAED->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s5WeeklyAED->EditValue ?>"<?php echo $pay_as_you_drive->s5WeeklyAED->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s5WeeklyAED->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->s5WeeklyKM->Visible) { // s5WeeklyKM ?>
	<div id="r_s5WeeklyKM" class="form-group">
		<label id="elh_pay_as_you_drive_s5WeeklyKM" for="x_s5WeeklyKM" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s5WeeklyKM->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s5WeeklyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s5WeeklyKM">
<input type="text" data-table="pay_as_you_drive" data-field="x_s5WeeklyKM" data-page="3" name="x_s5WeeklyKM" id="x_s5WeeklyKM" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s5WeeklyKM->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s5WeeklyKM->EditValue ?>"<?php echo $pay_as_you_drive->s5WeeklyKM->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s5WeeklyKM->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $pay_as_you_drive_edit->MultiPages->PageStyle("4") ?>" id="tab_pay_as_you_drive4"><!-- multi-page .tab-pane -->
<div class="ewEditDiv"><!-- page* -->
<?php if ($pay_as_you_drive->s1MonthlyAED->Visible) { // s1MonthlyAED ?>
	<div id="r_s1MonthlyAED" class="form-group">
		<label id="elh_pay_as_you_drive_s1MonthlyAED" for="x_s1MonthlyAED" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s1MonthlyAED->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s1MonthlyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s1MonthlyAED">
<input type="text" data-table="pay_as_you_drive" data-field="x_s1MonthlyAED" data-page="4" name="x_s1MonthlyAED" id="x_s1MonthlyAED" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s1MonthlyAED->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s1MonthlyAED->EditValue ?>"<?php echo $pay_as_you_drive->s1MonthlyAED->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s1MonthlyAED->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->s1MonthlyKM->Visible) { // s1MonthlyKM ?>
	<div id="r_s1MonthlyKM" class="form-group">
		<label id="elh_pay_as_you_drive_s1MonthlyKM" for="x_s1MonthlyKM" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s1MonthlyKM->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s1MonthlyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s1MonthlyKM">
<input type="text" data-table="pay_as_you_drive" data-field="x_s1MonthlyKM" data-page="4" name="x_s1MonthlyKM" id="x_s1MonthlyKM" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s1MonthlyKM->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s1MonthlyKM->EditValue ?>"<?php echo $pay_as_you_drive->s1MonthlyKM->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s1MonthlyKM->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->s2MonthlyAED->Visible) { // s2MonthlyAED ?>
	<div id="r_s2MonthlyAED" class="form-group">
		<label id="elh_pay_as_you_drive_s2MonthlyAED" for="x_s2MonthlyAED" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s2MonthlyAED->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s2MonthlyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s2MonthlyAED">
<input type="text" data-table="pay_as_you_drive" data-field="x_s2MonthlyAED" data-page="4" name="x_s2MonthlyAED" id="x_s2MonthlyAED" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s2MonthlyAED->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s2MonthlyAED->EditValue ?>"<?php echo $pay_as_you_drive->s2MonthlyAED->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s2MonthlyAED->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->s2MonthlyKM->Visible) { // s2MonthlyKM ?>
	<div id="r_s2MonthlyKM" class="form-group">
		<label id="elh_pay_as_you_drive_s2MonthlyKM" for="x_s2MonthlyKM" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s2MonthlyKM->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s2MonthlyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s2MonthlyKM">
<input type="text" data-table="pay_as_you_drive" data-field="x_s2MonthlyKM" data-page="4" name="x_s2MonthlyKM" id="x_s2MonthlyKM" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s2MonthlyKM->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s2MonthlyKM->EditValue ?>"<?php echo $pay_as_you_drive->s2MonthlyKM->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s2MonthlyKM->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->s3MonthlyAED->Visible) { // s3MonthlyAED ?>
	<div id="r_s3MonthlyAED" class="form-group">
		<label id="elh_pay_as_you_drive_s3MonthlyAED" for="x_s3MonthlyAED" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s3MonthlyAED->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s3MonthlyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s3MonthlyAED">
<input type="text" data-table="pay_as_you_drive" data-field="x_s3MonthlyAED" data-page="4" name="x_s3MonthlyAED" id="x_s3MonthlyAED" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s3MonthlyAED->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s3MonthlyAED->EditValue ?>"<?php echo $pay_as_you_drive->s3MonthlyAED->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s3MonthlyAED->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->s3MonthlyKM->Visible) { // s3MonthlyKM ?>
	<div id="r_s3MonthlyKM" class="form-group">
		<label id="elh_pay_as_you_drive_s3MonthlyKM" for="x_s3MonthlyKM" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s3MonthlyKM->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s3MonthlyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s3MonthlyKM">
<input type="text" data-table="pay_as_you_drive" data-field="x_s3MonthlyKM" data-page="4" name="x_s3MonthlyKM" id="x_s3MonthlyKM" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s3MonthlyKM->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s3MonthlyKM->EditValue ?>"<?php echo $pay_as_you_drive->s3MonthlyKM->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s3MonthlyKM->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->s4MonthlyAED->Visible) { // s4MonthlyAED ?>
	<div id="r_s4MonthlyAED" class="form-group">
		<label id="elh_pay_as_you_drive_s4MonthlyAED" for="x_s4MonthlyAED" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s4MonthlyAED->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s4MonthlyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s4MonthlyAED">
<input type="text" data-table="pay_as_you_drive" data-field="x_s4MonthlyAED" data-page="4" name="x_s4MonthlyAED" id="x_s4MonthlyAED" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s4MonthlyAED->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s4MonthlyAED->EditValue ?>"<?php echo $pay_as_you_drive->s4MonthlyAED->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s4MonthlyAED->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->s4MonthlyKM->Visible) { // s4MonthlyKM ?>
	<div id="r_s4MonthlyKM" class="form-group">
		<label id="elh_pay_as_you_drive_s4MonthlyKM" for="x_s4MonthlyKM" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s4MonthlyKM->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s4MonthlyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s4MonthlyKM">
<input type="text" data-table="pay_as_you_drive" data-field="x_s4MonthlyKM" data-page="4" name="x_s4MonthlyKM" id="x_s4MonthlyKM" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s4MonthlyKM->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s4MonthlyKM->EditValue ?>"<?php echo $pay_as_you_drive->s4MonthlyKM->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s4MonthlyKM->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->s5MonthlyAED->Visible) { // s5MonthlyAED ?>
	<div id="r_s5MonthlyAED" class="form-group">
		<label id="elh_pay_as_you_drive_s5MonthlyAED" for="x_s5MonthlyAED" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s5MonthlyAED->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s5MonthlyAED->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s5MonthlyAED">
<input type="text" data-table="pay_as_you_drive" data-field="x_s5MonthlyAED" data-page="4" name="x_s5MonthlyAED" id="x_s5MonthlyAED" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s5MonthlyAED->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s5MonthlyAED->EditValue ?>"<?php echo $pay_as_you_drive->s5MonthlyAED->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s5MonthlyAED->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->s5MonthlyKM->Visible) { // s5MonthlyKM ?>
	<div id="r_s5MonthlyKM" class="form-group">
		<label id="elh_pay_as_you_drive_s5MonthlyKM" for="x_s5MonthlyKM" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->s5MonthlyKM->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->s5MonthlyKM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_s5MonthlyKM">
<input type="text" data-table="pay_as_you_drive" data-field="x_s5MonthlyKM" data-page="4" name="x_s5MonthlyKM" id="x_s5MonthlyKM" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->s5MonthlyKM->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->s5MonthlyKM->EditValue ?>"<?php echo $pay_as_you_drive->s5MonthlyKM->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->s5MonthlyKM->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $pay_as_you_drive_edit->MultiPages->PageStyle("5") ?>" id="tab_pay_as_you_drive5"><!-- multi-page .tab-pane -->
<div class="ewEditDiv"><!-- page* -->
<?php if ($pay_as_you_drive->phase1OrangeCard->Visible) { // phase1OrangeCard ?>
	<div id="r_phase1OrangeCard" class="form-group">
		<label id="elh_pay_as_you_drive_phase1OrangeCard" for="x_phase1OrangeCard" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->phase1OrangeCard->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->phase1OrangeCard->CellAttributes() ?>>
<span id="el_pay_as_you_drive_phase1OrangeCard">
<input type="text" data-table="pay_as_you_drive" data-field="x_phase1OrangeCard" data-page="5" name="x_phase1OrangeCard" id="x_phase1OrangeCard" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->phase1OrangeCard->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->phase1OrangeCard->EditValue ?>"<?php echo $pay_as_you_drive->phase1OrangeCard->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->phase1OrangeCard->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->phase1GPS->Visible) { // phase1GPS ?>
	<div id="r_phase1GPS" class="form-group">
		<label id="elh_pay_as_you_drive_phase1GPS" for="x_phase1GPS" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->phase1GPS->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->phase1GPS->CellAttributes() ?>>
<span id="el_pay_as_you_drive_phase1GPS">
<input type="text" data-table="pay_as_you_drive" data-field="x_phase1GPS" data-page="5" name="x_phase1GPS" id="x_phase1GPS" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->phase1GPS->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->phase1GPS->EditValue ?>"<?php echo $pay_as_you_drive->phase1GPS->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->phase1GPS->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->phase1DeliveryCharges->Visible) { // phase1DeliveryCharges ?>
	<div id="r_phase1DeliveryCharges" class="form-group">
		<label id="elh_pay_as_you_drive_phase1DeliveryCharges" for="x_phase1DeliveryCharges" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->phase1DeliveryCharges->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->phase1DeliveryCharges->CellAttributes() ?>>
<span id="el_pay_as_you_drive_phase1DeliveryCharges">
<input type="text" data-table="pay_as_you_drive" data-field="x_phase1DeliveryCharges" data-page="5" name="x_phase1DeliveryCharges" id="x_phase1DeliveryCharges" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->phase1DeliveryCharges->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->phase1DeliveryCharges->EditValue ?>"<?php echo $pay_as_you_drive->phase1DeliveryCharges->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->phase1DeliveryCharges->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->phase1CollectionCharges->Visible) { // phase1CollectionCharges ?>
	<div id="r_phase1CollectionCharges" class="form-group">
		<label id="elh_pay_as_you_drive_phase1CollectionCharges" for="x_phase1CollectionCharges" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->phase1CollectionCharges->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->phase1CollectionCharges->CellAttributes() ?>>
<span id="el_pay_as_you_drive_phase1CollectionCharges">
<input type="text" data-table="pay_as_you_drive" data-field="x_phase1CollectionCharges" data-page="5" name="x_phase1CollectionCharges" id="x_phase1CollectionCharges" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->phase1CollectionCharges->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->phase1CollectionCharges->EditValue ?>"<?php echo $pay_as_you_drive->phase1CollectionCharges->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->phase1CollectionCharges->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $pay_as_you_drive_edit->MultiPages->PageStyle("6") ?>" id="tab_pay_as_you_drive6"><!-- multi-page .tab-pane -->
<div class="ewEditDiv"><!-- page* -->
<?php if ($pay_as_you_drive->addon01KM->Visible) { // addon01KM ?>
	<div id="r_addon01KM" class="form-group">
		<label id="elh_pay_as_you_drive_addon01KM" for="x_addon01KM" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->addon01KM->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->addon01KM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_addon01KM">
<input type="text" data-table="pay_as_you_drive" data-field="x_addon01KM" data-page="6" name="x_addon01KM" id="x_addon01KM" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->addon01KM->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->addon01KM->EditValue ?>"<?php echo $pay_as_you_drive->addon01KM->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->addon01KM->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->addon01Price->Visible) { // addon01Price ?>
	<div id="r_addon01Price" class="form-group">
		<label id="elh_pay_as_you_drive_addon01Price" for="x_addon01Price" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->addon01Price->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->addon01Price->CellAttributes() ?>>
<span id="el_pay_as_you_drive_addon01Price">
<input type="text" data-table="pay_as_you_drive" data-field="x_addon01Price" data-page="6" name="x_addon01Price" id="x_addon01Price" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->addon01Price->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->addon01Price->EditValue ?>"<?php echo $pay_as_you_drive->addon01Price->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->addon01Price->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->addon02KM->Visible) { // addon02KM ?>
	<div id="r_addon02KM" class="form-group">
		<label id="elh_pay_as_you_drive_addon02KM" for="x_addon02KM" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->addon02KM->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->addon02KM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_addon02KM">
<input type="text" data-table="pay_as_you_drive" data-field="x_addon02KM" data-page="6" name="x_addon02KM" id="x_addon02KM" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->addon02KM->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->addon02KM->EditValue ?>"<?php echo $pay_as_you_drive->addon02KM->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->addon02KM->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->addon02Price->Visible) { // addon02Price ?>
	<div id="r_addon02Price" class="form-group">
		<label id="elh_pay_as_you_drive_addon02Price" for="x_addon02Price" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->addon02Price->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->addon02Price->CellAttributes() ?>>
<span id="el_pay_as_you_drive_addon02Price">
<input type="text" data-table="pay_as_you_drive" data-field="x_addon02Price" data-page="6" name="x_addon02Price" id="x_addon02Price" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->addon02Price->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->addon02Price->EditValue ?>"<?php echo $pay_as_you_drive->addon02Price->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->addon02Price->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->addon03KM->Visible) { // addon03KM ?>
	<div id="r_addon03KM" class="form-group">
		<label id="elh_pay_as_you_drive_addon03KM" for="x_addon03KM" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->addon03KM->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->addon03KM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_addon03KM">
<input type="text" data-table="pay_as_you_drive" data-field="x_addon03KM" data-page="6" name="x_addon03KM" id="x_addon03KM" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->addon03KM->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->addon03KM->EditValue ?>"<?php echo $pay_as_you_drive->addon03KM->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->addon03KM->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->addon03Price->Visible) { // addon03Price ?>
	<div id="r_addon03Price" class="form-group">
		<label id="elh_pay_as_you_drive_addon03Price" for="x_addon03Price" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->addon03Price->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->addon03Price->CellAttributes() ?>>
<span id="el_pay_as_you_drive_addon03Price">
<input type="text" data-table="pay_as_you_drive" data-field="x_addon03Price" data-page="6" name="x_addon03Price" id="x_addon03Price" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->addon03Price->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->addon03Price->EditValue ?>"<?php echo $pay_as_you_drive->addon03Price->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->addon03Price->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->addon04KM->Visible) { // addon04KM ?>
	<div id="r_addon04KM" class="form-group">
		<label id="elh_pay_as_you_drive_addon04KM" for="x_addon04KM" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->addon04KM->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->addon04KM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_addon04KM">
<input type="text" data-table="pay_as_you_drive" data-field="x_addon04KM" data-page="6" name="x_addon04KM" id="x_addon04KM" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->addon04KM->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->addon04KM->EditValue ?>"<?php echo $pay_as_you_drive->addon04KM->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->addon04KM->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->addon04Price->Visible) { // addon04Price ?>
	<div id="r_addon04Price" class="form-group">
		<label id="elh_pay_as_you_drive_addon04Price" for="x_addon04Price" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->addon04Price->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->addon04Price->CellAttributes() ?>>
<span id="el_pay_as_you_drive_addon04Price">
<input type="text" data-table="pay_as_you_drive" data-field="x_addon04Price" data-page="6" name="x_addon04Price" id="x_addon04Price" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->addon04Price->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->addon04Price->EditValue ?>"<?php echo $pay_as_you_drive->addon04Price->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->addon04Price->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->addon05KM->Visible) { // addon05KM ?>
	<div id="r_addon05KM" class="form-group">
		<label id="elh_pay_as_you_drive_addon05KM" for="x_addon05KM" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->addon05KM->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->addon05KM->CellAttributes() ?>>
<span id="el_pay_as_you_drive_addon05KM">
<input type="text" data-table="pay_as_you_drive" data-field="x_addon05KM" data-page="6" name="x_addon05KM" id="x_addon05KM" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->addon05KM->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->addon05KM->EditValue ?>"<?php echo $pay_as_you_drive->addon05KM->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->addon05KM->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pay_as_you_drive->addon05Price->Visible) { // addon05Price ?>
	<div id="r_addon05Price" class="form-group">
		<label id="elh_pay_as_you_drive_addon05Price" for="x_addon05Price" class="<?php echo $pay_as_you_drive_edit->LeftColumnClass ?>"><?php echo $pay_as_you_drive->addon05Price->FldCaption() ?></label>
		<div class="<?php echo $pay_as_you_drive_edit->RightColumnClass ?>"><div<?php echo $pay_as_you_drive->addon05Price->CellAttributes() ?>>
<span id="el_pay_as_you_drive_addon05Price">
<input type="text" data-table="pay_as_you_drive" data-field="x_addon05Price" data-page="6" name="x_addon05Price" id="x_addon05Price" size="30" placeholder="<?php echo ew_HtmlEncode($pay_as_you_drive->addon05Price->getPlaceHolder()) ?>" value="<?php echo $pay_as_you_drive->addon05Price->EditValue ?>"<?php echo $pay_as_you_drive->addon05Price->EditAttributes() ?>>
</span>
<?php echo $pay_as_you_drive->addon05Price->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page .nav-tabs-custom .tab-content -->
</div><!-- /multi-page .nav-tabs-custom -->
</div><!-- /multi-page -->
<?php if (!$pay_as_you_drive_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $pay_as_you_drive_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $pay_as_you_drive_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fpay_as_you_driveedit.Init();
</script>
<?php
$pay_as_you_drive_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$pay_as_you_drive_edit->Page_Terminate();
?>
