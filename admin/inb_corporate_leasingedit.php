<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "inb_corporate_leasinginfo.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$inb_corporate_leasing_edit = NULL; // Initialize page object first

class cinb_corporate_leasing_edit extends cinb_corporate_leasing {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'inb_corporate_leasing';

	// Page object name
	var $PageObjName = 'inb_corporate_leasing_edit';

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

		// Table object (inb_corporate_leasing)
		if (!isset($GLOBALS["inb_corporate_leasing"]) || get_class($GLOBALS["inb_corporate_leasing"]) == "cinb_corporate_leasing") {
			$GLOBALS["inb_corporate_leasing"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["inb_corporate_leasing"];
		}

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'inb_corporate_leasing', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("inb_corporate_leasinglist.php"));
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
		$this->fullname->SetVisibility();
		$this->companyName->SetVisibility();
		$this->_email->SetVisibility();
		$this->phone->SetVisibility();
		$this->vehicleInterestedIn->SetVisibility();
		$this->noOfVehicles->SetVisibility();
		$this->vehicleCategory->SetVisibility();
		$this->specificRequirement->SetVisibility();
		$this->dateCreated->SetVisibility();

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
		global $EW_EXPORT, $inb_corporate_leasing;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($inb_corporate_leasing);
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
					if ($pageName == "inb_corporate_leasingview.php")
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
					$this->Page_Terminate("inb_corporate_leasinglist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "inb_corporate_leasinglist.php")
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
		if (!$this->fullname->FldIsDetailKey) {
			$this->fullname->setFormValue($objForm->GetValue("x_fullname"));
		}
		if (!$this->companyName->FldIsDetailKey) {
			$this->companyName->setFormValue($objForm->GetValue("x_companyName"));
		}
		if (!$this->_email->FldIsDetailKey) {
			$this->_email->setFormValue($objForm->GetValue("x__email"));
		}
		if (!$this->phone->FldIsDetailKey) {
			$this->phone->setFormValue($objForm->GetValue("x_phone"));
		}
		if (!$this->vehicleInterestedIn->FldIsDetailKey) {
			$this->vehicleInterestedIn->setFormValue($objForm->GetValue("x_vehicleInterestedIn"));
		}
		if (!$this->noOfVehicles->FldIsDetailKey) {
			$this->noOfVehicles->setFormValue($objForm->GetValue("x_noOfVehicles"));
		}
		if (!$this->vehicleCategory->FldIsDetailKey) {
			$this->vehicleCategory->setFormValue($objForm->GetValue("x_vehicleCategory"));
		}
		if (!$this->specificRequirement->FldIsDetailKey) {
			$this->specificRequirement->setFormValue($objForm->GetValue("x_specificRequirement"));
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
		$this->fullname->CurrentValue = $this->fullname->FormValue;
		$this->companyName->CurrentValue = $this->companyName->FormValue;
		$this->_email->CurrentValue = $this->_email->FormValue;
		$this->phone->CurrentValue = $this->phone->FormValue;
		$this->vehicleInterestedIn->CurrentValue = $this->vehicleInterestedIn->FormValue;
		$this->noOfVehicles->CurrentValue = $this->noOfVehicles->FormValue;
		$this->vehicleCategory->CurrentValue = $this->vehicleCategory->FormValue;
		$this->specificRequirement->CurrentValue = $this->specificRequirement->FormValue;
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
		$this->fullname->setDbValue($row['fullname']);
		$this->companyName->setDbValue($row['companyName']);
		$this->_email->setDbValue($row['email']);
		$this->phone->setDbValue($row['phone']);
		$this->vehicleInterestedIn->setDbValue($row['vehicleInterestedIn']);
		$this->noOfVehicles->setDbValue($row['noOfVehicles']);
		$this->vehicleCategory->setDbValue($row['vehicleCategory']);
		$this->specificRequirement->setDbValue($row['specificRequirement']);
		$this->dateCreated->setDbValue($row['dateCreated']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['id'] = NULL;
		$row['fullname'] = NULL;
		$row['companyName'] = NULL;
		$row['email'] = NULL;
		$row['phone'] = NULL;
		$row['vehicleInterestedIn'] = NULL;
		$row['noOfVehicles'] = NULL;
		$row['vehicleCategory'] = NULL;
		$row['specificRequirement'] = NULL;
		$row['dateCreated'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->fullname->DbValue = $row['fullname'];
		$this->companyName->DbValue = $row['companyName'];
		$this->_email->DbValue = $row['email'];
		$this->phone->DbValue = $row['phone'];
		$this->vehicleInterestedIn->DbValue = $row['vehicleInterestedIn'];
		$this->noOfVehicles->DbValue = $row['noOfVehicles'];
		$this->vehicleCategory->DbValue = $row['vehicleCategory'];
		$this->specificRequirement->DbValue = $row['specificRequirement'];
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
		// fullname
		// companyName
		// email
		// phone
		// vehicleInterestedIn
		// noOfVehicles
		// vehicleCategory
		// specificRequirement
		// dateCreated

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// fullname
		$this->fullname->ViewValue = $this->fullname->CurrentValue;
		$this->fullname->ViewCustomAttributes = "";

		// companyName
		$this->companyName->ViewValue = $this->companyName->CurrentValue;
		$this->companyName->ViewCustomAttributes = "";

		// email
		$this->_email->ViewValue = $this->_email->CurrentValue;
		$this->_email->ViewCustomAttributes = "";

		// phone
		$this->phone->ViewValue = $this->phone->CurrentValue;
		$this->phone->ViewCustomAttributes = "";

		// vehicleInterestedIn
		$this->vehicleInterestedIn->ViewValue = $this->vehicleInterestedIn->CurrentValue;
		$this->vehicleInterestedIn->ViewCustomAttributes = "";

		// noOfVehicles
		$this->noOfVehicles->ViewValue = $this->noOfVehicles->CurrentValue;
		$this->noOfVehicles->ViewCustomAttributes = "";

		// vehicleCategory
		if (strval($this->vehicleCategory->CurrentValue) <> "") {
			$arwrk = explode(",", $this->vehicleCategory->CurrentValue);
			$sFilterWrk = "";
			foreach ($arwrk as $wrk) {
				if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
				$sFilterWrk .= "`bodyTypeID`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_NUMBER, "");
			}
		$sSqlWrk = "SELECT `bodyTypeID`, `bodytype` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_bodytype`";
		$sWhereWrk = "";
		$this->vehicleCategory->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->vehicleCategory, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->vehicleCategory->ViewValue = "";
				$ari = 0;
				while (!$rswrk->EOF) {
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->vehicleCategory->ViewValue .= $this->vehicleCategory->DisplayValue($arwrk);
					$rswrk->MoveNext();
					if (!$rswrk->EOF) $this->vehicleCategory->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
					$ari++;
				}
				$rswrk->Close();
			} else {
				$this->vehicleCategory->ViewValue = $this->vehicleCategory->CurrentValue;
			}
		} else {
			$this->vehicleCategory->ViewValue = NULL;
		}
		$this->vehicleCategory->ViewCustomAttributes = "";

		// specificRequirement
		$this->specificRequirement->ViewValue = $this->specificRequirement->CurrentValue;
		$this->specificRequirement->ViewCustomAttributes = "";

		// dateCreated
		$this->dateCreated->ViewValue = $this->dateCreated->CurrentValue;
		$this->dateCreated->ViewValue = ew_FormatDateTime($this->dateCreated->ViewValue, 7);
		$this->dateCreated->ViewCustomAttributes = "";

			// id
			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";
			$this->id->TooltipValue = "";

			// fullname
			$this->fullname->LinkCustomAttributes = "";
			$this->fullname->HrefValue = "";
			$this->fullname->TooltipValue = "";

			// companyName
			$this->companyName->LinkCustomAttributes = "";
			$this->companyName->HrefValue = "";
			$this->companyName->TooltipValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";
			$this->_email->TooltipValue = "";

			// phone
			$this->phone->LinkCustomAttributes = "";
			$this->phone->HrefValue = "";
			$this->phone->TooltipValue = "";

			// vehicleInterestedIn
			$this->vehicleInterestedIn->LinkCustomAttributes = "";
			$this->vehicleInterestedIn->HrefValue = "";
			$this->vehicleInterestedIn->TooltipValue = "";

			// noOfVehicles
			$this->noOfVehicles->LinkCustomAttributes = "";
			$this->noOfVehicles->HrefValue = "";
			$this->noOfVehicles->TooltipValue = "";

			// vehicleCategory
			$this->vehicleCategory->LinkCustomAttributes = "";
			$this->vehicleCategory->HrefValue = "";
			$this->vehicleCategory->TooltipValue = "";

			// specificRequirement
			$this->specificRequirement->LinkCustomAttributes = "";
			$this->specificRequirement->HrefValue = "";
			$this->specificRequirement->TooltipValue = "";

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

			// fullname
			$this->fullname->EditAttrs["class"] = "form-control";
			$this->fullname->EditCustomAttributes = "";
			$this->fullname->EditValue = ew_HtmlEncode($this->fullname->CurrentValue);
			$this->fullname->PlaceHolder = ew_RemoveHtml($this->fullname->FldCaption());

			// companyName
			$this->companyName->EditAttrs["class"] = "form-control";
			$this->companyName->EditCustomAttributes = "";
			$this->companyName->EditValue = ew_HtmlEncode($this->companyName->CurrentValue);
			$this->companyName->PlaceHolder = ew_RemoveHtml($this->companyName->FldCaption());

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

			// vehicleInterestedIn
			$this->vehicleInterestedIn->EditAttrs["class"] = "form-control";
			$this->vehicleInterestedIn->EditCustomAttributes = "";
			$this->vehicleInterestedIn->EditValue = ew_HtmlEncode($this->vehicleInterestedIn->CurrentValue);
			$this->vehicleInterestedIn->PlaceHolder = ew_RemoveHtml($this->vehicleInterestedIn->FldCaption());

			// noOfVehicles
			$this->noOfVehicles->EditAttrs["class"] = "form-control";
			$this->noOfVehicles->EditCustomAttributes = "";
			$this->noOfVehicles->EditValue = ew_HtmlEncode($this->noOfVehicles->CurrentValue);
			$this->noOfVehicles->PlaceHolder = ew_RemoveHtml($this->noOfVehicles->FldCaption());

			// vehicleCategory
			$this->vehicleCategory->EditCustomAttributes = "";
			if (trim(strval($this->vehicleCategory->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$arwrk = explode(",", $this->vehicleCategory->CurrentValue);
				$sFilterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
					$sFilterWrk .= "`bodyTypeID`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_NUMBER, "");
				}
			}
			$sSqlWrk = "SELECT `bodyTypeID`, `bodytype` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `mtr_bodytype`";
			$sWhereWrk = "";
			$this->vehicleCategory->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->vehicleCategory, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->vehicleCategory->EditValue = $arwrk;

			// specificRequirement
			$this->specificRequirement->EditAttrs["class"] = "form-control";
			$this->specificRequirement->EditCustomAttributes = "";
			$this->specificRequirement->EditValue = ew_HtmlEncode($this->specificRequirement->CurrentValue);
			$this->specificRequirement->PlaceHolder = ew_RemoveHtml($this->specificRequirement->FldCaption());

			// dateCreated
			$this->dateCreated->EditAttrs["class"] = "form-control";
			$this->dateCreated->EditCustomAttributes = "";
			$this->dateCreated->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->dateCreated->CurrentValue, 7));
			$this->dateCreated->PlaceHolder = ew_RemoveHtml($this->dateCreated->FldCaption());

			// Edit refer script
			// id

			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";

			// fullname
			$this->fullname->LinkCustomAttributes = "";
			$this->fullname->HrefValue = "";

			// companyName
			$this->companyName->LinkCustomAttributes = "";
			$this->companyName->HrefValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";

			// phone
			$this->phone->LinkCustomAttributes = "";
			$this->phone->HrefValue = "";

			// vehicleInterestedIn
			$this->vehicleInterestedIn->LinkCustomAttributes = "";
			$this->vehicleInterestedIn->HrefValue = "";

			// noOfVehicles
			$this->noOfVehicles->LinkCustomAttributes = "";
			$this->noOfVehicles->HrefValue = "";

			// vehicleCategory
			$this->vehicleCategory->LinkCustomAttributes = "";
			$this->vehicleCategory->HrefValue = "";

			// specificRequirement
			$this->specificRequirement->LinkCustomAttributes = "";
			$this->specificRequirement->HrefValue = "";

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

			// fullname
			$this->fullname->SetDbValueDef($rsnew, $this->fullname->CurrentValue, NULL, $this->fullname->ReadOnly);

			// companyName
			$this->companyName->SetDbValueDef($rsnew, $this->companyName->CurrentValue, NULL, $this->companyName->ReadOnly);

			// email
			$this->_email->SetDbValueDef($rsnew, $this->_email->CurrentValue, NULL, $this->_email->ReadOnly);

			// phone
			$this->phone->SetDbValueDef($rsnew, $this->phone->CurrentValue, NULL, $this->phone->ReadOnly);

			// vehicleInterestedIn
			$this->vehicleInterestedIn->SetDbValueDef($rsnew, $this->vehicleInterestedIn->CurrentValue, NULL, $this->vehicleInterestedIn->ReadOnly);

			// noOfVehicles
			$this->noOfVehicles->SetDbValueDef($rsnew, $this->noOfVehicles->CurrentValue, NULL, $this->noOfVehicles->ReadOnly);

			// vehicleCategory
			$this->vehicleCategory->SetDbValueDef($rsnew, $this->vehicleCategory->CurrentValue, NULL, $this->vehicleCategory->ReadOnly);

			// specificRequirement
			$this->specificRequirement->SetDbValueDef($rsnew, $this->specificRequirement->CurrentValue, NULL, $this->specificRequirement->ReadOnly);

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("inb_corporate_leasinglist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_vehicleCategory":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `bodyTypeID` AS `LinkFld`, `bodytype` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_bodytype`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`bodyTypeID` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->vehicleCategory, $sWhereWrk); // Call Lookup Selecting
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
if (!isset($inb_corporate_leasing_edit)) $inb_corporate_leasing_edit = new cinb_corporate_leasing_edit();

// Page init
$inb_corporate_leasing_edit->Page_Init();

// Page main
$inb_corporate_leasing_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inb_corporate_leasing_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = finb_corporate_leasingedit = new ew_Form("finb_corporate_leasingedit", "edit");

// Validate form
finb_corporate_leasingedit.Validate = function() {
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
				return this.OnError(elm, "<?php echo ew_JsEncode2($inb_corporate_leasing->dateCreated->FldErrMsg()) ?>");

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
finb_corporate_leasingedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
finb_corporate_leasingedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
finb_corporate_leasingedit.Lists["x_vehicleCategory[]"] = {"LinkField":"x_bodyTypeID","Ajax":true,"AutoFill":false,"DisplayFields":["x_bodytype","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_bodytype"};
finb_corporate_leasingedit.Lists["x_vehicleCategory[]"].Data = "<?php echo $inb_corporate_leasing_edit->vehicleCategory->LookupFilterQuery(FALSE, "edit") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $inb_corporate_leasing_edit->ShowPageHeader(); ?>
<?php
$inb_corporate_leasing_edit->ShowMessage();
?>
<form name="finb_corporate_leasingedit" id="finb_corporate_leasingedit" class="<?php echo $inb_corporate_leasing_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($inb_corporate_leasing_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $inb_corporate_leasing_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inb_corporate_leasing">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($inb_corporate_leasing_edit->IsModal) ?>">
<div class="ewEditDiv"><!-- page* -->
<?php if ($inb_corporate_leasing->id->Visible) { // id ?>
	<div id="r_id" class="form-group">
		<label id="elh_inb_corporate_leasing_id" class="<?php echo $inb_corporate_leasing_edit->LeftColumnClass ?>"><?php echo $inb_corporate_leasing->id->FldCaption() ?></label>
		<div class="<?php echo $inb_corporate_leasing_edit->RightColumnClass ?>"><div<?php echo $inb_corporate_leasing->id->CellAttributes() ?>>
<span id="el_inb_corporate_leasing_id">
<span<?php echo $inb_corporate_leasing->id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $inb_corporate_leasing->id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="inb_corporate_leasing" data-field="x_id" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($inb_corporate_leasing->id->CurrentValue) ?>">
<?php echo $inb_corporate_leasing->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_corporate_leasing->fullname->Visible) { // fullname ?>
	<div id="r_fullname" class="form-group">
		<label id="elh_inb_corporate_leasing_fullname" for="x_fullname" class="<?php echo $inb_corporate_leasing_edit->LeftColumnClass ?>"><?php echo $inb_corporate_leasing->fullname->FldCaption() ?></label>
		<div class="<?php echo $inb_corporate_leasing_edit->RightColumnClass ?>"><div<?php echo $inb_corporate_leasing->fullname->CellAttributes() ?>>
<span id="el_inb_corporate_leasing_fullname">
<input type="text" data-table="inb_corporate_leasing" data-field="x_fullname" name="x_fullname" id="x_fullname" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_corporate_leasing->fullname->getPlaceHolder()) ?>" value="<?php echo $inb_corporate_leasing->fullname->EditValue ?>"<?php echo $inb_corporate_leasing->fullname->EditAttributes() ?>>
</span>
<?php echo $inb_corporate_leasing->fullname->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_corporate_leasing->companyName->Visible) { // companyName ?>
	<div id="r_companyName" class="form-group">
		<label id="elh_inb_corporate_leasing_companyName" for="x_companyName" class="<?php echo $inb_corporate_leasing_edit->LeftColumnClass ?>"><?php echo $inb_corporate_leasing->companyName->FldCaption() ?></label>
		<div class="<?php echo $inb_corporate_leasing_edit->RightColumnClass ?>"><div<?php echo $inb_corporate_leasing->companyName->CellAttributes() ?>>
<span id="el_inb_corporate_leasing_companyName">
<input type="text" data-table="inb_corporate_leasing" data-field="x_companyName" name="x_companyName" id="x_companyName" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_corporate_leasing->companyName->getPlaceHolder()) ?>" value="<?php echo $inb_corporate_leasing->companyName->EditValue ?>"<?php echo $inb_corporate_leasing->companyName->EditAttributes() ?>>
</span>
<?php echo $inb_corporate_leasing->companyName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_corporate_leasing->_email->Visible) { // email ?>
	<div id="r__email" class="form-group">
		<label id="elh_inb_corporate_leasing__email" for="x__email" class="<?php echo $inb_corporate_leasing_edit->LeftColumnClass ?>"><?php echo $inb_corporate_leasing->_email->FldCaption() ?></label>
		<div class="<?php echo $inb_corporate_leasing_edit->RightColumnClass ?>"><div<?php echo $inb_corporate_leasing->_email->CellAttributes() ?>>
<span id="el_inb_corporate_leasing__email">
<input type="text" data-table="inb_corporate_leasing" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_corporate_leasing->_email->getPlaceHolder()) ?>" value="<?php echo $inb_corporate_leasing->_email->EditValue ?>"<?php echo $inb_corporate_leasing->_email->EditAttributes() ?>>
</span>
<?php echo $inb_corporate_leasing->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_corporate_leasing->phone->Visible) { // phone ?>
	<div id="r_phone" class="form-group">
		<label id="elh_inb_corporate_leasing_phone" for="x_phone" class="<?php echo $inb_corporate_leasing_edit->LeftColumnClass ?>"><?php echo $inb_corporate_leasing->phone->FldCaption() ?></label>
		<div class="<?php echo $inb_corporate_leasing_edit->RightColumnClass ?>"><div<?php echo $inb_corporate_leasing->phone->CellAttributes() ?>>
<span id="el_inb_corporate_leasing_phone">
<input type="text" data-table="inb_corporate_leasing" data-field="x_phone" name="x_phone" id="x_phone" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_corporate_leasing->phone->getPlaceHolder()) ?>" value="<?php echo $inb_corporate_leasing->phone->EditValue ?>"<?php echo $inb_corporate_leasing->phone->EditAttributes() ?>>
</span>
<?php echo $inb_corporate_leasing->phone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_corporate_leasing->vehicleInterestedIn->Visible) { // vehicleInterestedIn ?>
	<div id="r_vehicleInterestedIn" class="form-group">
		<label id="elh_inb_corporate_leasing_vehicleInterestedIn" for="x_vehicleInterestedIn" class="<?php echo $inb_corporate_leasing_edit->LeftColumnClass ?>"><?php echo $inb_corporate_leasing->vehicleInterestedIn->FldCaption() ?></label>
		<div class="<?php echo $inb_corporate_leasing_edit->RightColumnClass ?>"><div<?php echo $inb_corporate_leasing->vehicleInterestedIn->CellAttributes() ?>>
<span id="el_inb_corporate_leasing_vehicleInterestedIn">
<input type="text" data-table="inb_corporate_leasing" data-field="x_vehicleInterestedIn" name="x_vehicleInterestedIn" id="x_vehicleInterestedIn" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_corporate_leasing->vehicleInterestedIn->getPlaceHolder()) ?>" value="<?php echo $inb_corporate_leasing->vehicleInterestedIn->EditValue ?>"<?php echo $inb_corporate_leasing->vehicleInterestedIn->EditAttributes() ?>>
</span>
<?php echo $inb_corporate_leasing->vehicleInterestedIn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_corporate_leasing->noOfVehicles->Visible) { // noOfVehicles ?>
	<div id="r_noOfVehicles" class="form-group">
		<label id="elh_inb_corporate_leasing_noOfVehicles" for="x_noOfVehicles" class="<?php echo $inb_corporate_leasing_edit->LeftColumnClass ?>"><?php echo $inb_corporate_leasing->noOfVehicles->FldCaption() ?></label>
		<div class="<?php echo $inb_corporate_leasing_edit->RightColumnClass ?>"><div<?php echo $inb_corporate_leasing->noOfVehicles->CellAttributes() ?>>
<span id="el_inb_corporate_leasing_noOfVehicles">
<input type="text" data-table="inb_corporate_leasing" data-field="x_noOfVehicles" name="x_noOfVehicles" id="x_noOfVehicles" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_corporate_leasing->noOfVehicles->getPlaceHolder()) ?>" value="<?php echo $inb_corporate_leasing->noOfVehicles->EditValue ?>"<?php echo $inb_corporate_leasing->noOfVehicles->EditAttributes() ?>>
</span>
<?php echo $inb_corporate_leasing->noOfVehicles->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_corporate_leasing->vehicleCategory->Visible) { // vehicleCategory ?>
	<div id="r_vehicleCategory" class="form-group">
		<label id="elh_inb_corporate_leasing_vehicleCategory" class="<?php echo $inb_corporate_leasing_edit->LeftColumnClass ?>"><?php echo $inb_corporate_leasing->vehicleCategory->FldCaption() ?></label>
		<div class="<?php echo $inb_corporate_leasing_edit->RightColumnClass ?>"><div<?php echo $inb_corporate_leasing->vehicleCategory->CellAttributes() ?>>
<span id="el_inb_corporate_leasing_vehicleCategory">
<div id="tp_x_vehicleCategory" class="ewTemplate"><input type="checkbox" data-table="inb_corporate_leasing" data-field="x_vehicleCategory" data-value-separator="<?php echo $inb_corporate_leasing->vehicleCategory->DisplayValueSeparatorAttribute() ?>" name="x_vehicleCategory[]" id="x_vehicleCategory[]" value="{value}"<?php echo $inb_corporate_leasing->vehicleCategory->EditAttributes() ?>></div>
<div id="dsl_x_vehicleCategory" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $inb_corporate_leasing->vehicleCategory->CheckBoxListHtml(FALSE, "x_vehicleCategory[]") ?>
</div></div>
</span>
<?php echo $inb_corporate_leasing->vehicleCategory->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_corporate_leasing->specificRequirement->Visible) { // specificRequirement ?>
	<div id="r_specificRequirement" class="form-group">
		<label id="elh_inb_corporate_leasing_specificRequirement" class="<?php echo $inb_corporate_leasing_edit->LeftColumnClass ?>"><?php echo $inb_corporate_leasing->specificRequirement->FldCaption() ?></label>
		<div class="<?php echo $inb_corporate_leasing_edit->RightColumnClass ?>"><div<?php echo $inb_corporate_leasing->specificRequirement->CellAttributes() ?>>
<span id="el_inb_corporate_leasing_specificRequirement">
<?php ew_AppendClass($inb_corporate_leasing->specificRequirement->EditAttrs["class"], "editor"); ?>
<textarea data-table="inb_corporate_leasing" data-field="x_specificRequirement" name="x_specificRequirement" id="x_specificRequirement" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($inb_corporate_leasing->specificRequirement->getPlaceHolder()) ?>"<?php echo $inb_corporate_leasing->specificRequirement->EditAttributes() ?>><?php echo $inb_corporate_leasing->specificRequirement->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("finb_corporate_leasingedit", "x_specificRequirement", 35, 4, <?php echo ($inb_corporate_leasing->specificRequirement->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $inb_corporate_leasing->specificRequirement->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_corporate_leasing->dateCreated->Visible) { // dateCreated ?>
	<div id="r_dateCreated" class="form-group">
		<label id="elh_inb_corporate_leasing_dateCreated" for="x_dateCreated" class="<?php echo $inb_corporate_leasing_edit->LeftColumnClass ?>"><?php echo $inb_corporate_leasing->dateCreated->FldCaption() ?></label>
		<div class="<?php echo $inb_corporate_leasing_edit->RightColumnClass ?>"><div<?php echo $inb_corporate_leasing->dateCreated->CellAttributes() ?>>
<span id="el_inb_corporate_leasing_dateCreated">
<input type="text" data-table="inb_corporate_leasing" data-field="x_dateCreated" data-format="7" name="x_dateCreated" id="x_dateCreated" placeholder="<?php echo ew_HtmlEncode($inb_corporate_leasing->dateCreated->getPlaceHolder()) ?>" value="<?php echo $inb_corporate_leasing->dateCreated->EditValue ?>"<?php echo $inb_corporate_leasing->dateCreated->EditAttributes() ?>>
<?php if (!$inb_corporate_leasing->dateCreated->ReadOnly && !$inb_corporate_leasing->dateCreated->Disabled && !isset($inb_corporate_leasing->dateCreated->EditAttrs["readonly"]) && !isset($inb_corporate_leasing->dateCreated->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("finb_corporate_leasingedit", "x_dateCreated", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php echo $inb_corporate_leasing->dateCreated->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$inb_corporate_leasing_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $inb_corporate_leasing_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $inb_corporate_leasing_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
finb_corporate_leasingedit.Init();
</script>
<?php
$inb_corporate_leasing_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$inb_corporate_leasing_edit->Page_Terminate();
?>
