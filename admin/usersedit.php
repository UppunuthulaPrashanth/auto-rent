<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "usersinfo.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$users_edit = NULL; // Initialize page object first

class cusers_edit extends cusers {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'users';

	// Page object name
	var $PageObjName = 'users_edit';

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

		// Table object (users)
		if (!isset($GLOBALS["users"]) || get_class($GLOBALS["users"]) == "cusers") {
			$GLOBALS["users"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["users"];
		}

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'users', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("userslist.php"));
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
		$this->_userID->SetVisibility();
		$this->_userID->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
		$this->firstName->SetVisibility();
		$this->lastName->SetVisibility();
		$this->emailID->SetVisibility();
		$this->mobileNo->SetVisibility();
		$this->country->SetVisibility();
		$this->city->SetVisibility();
		$this->nationality->SetVisibility();
		$this->address->SetVisibility();
		$this->state->SetVisibility();
		$this->pincode->SetVisibility();
		$this->emiratesID->SetVisibility();
		$this->visaStatus->SetVisibility();
		$this->licenseNumber->SetVisibility();
		$this->licenseExpiry->SetVisibility();
		$this->licensePlaceOfIssue->SetVisibility();
		$this->licenseAttachment->SetVisibility();
		$this->passportNumber->SetVisibility();
		$this->passportExpiry->SetVisibility();
		$this->passportPlaceOfIssue->SetVisibility();
		$this->passportAttachment->SetVisibility();
		$this->signUpNewsletter->SetVisibility();
		$this->password->SetVisibility();
		$this->currentCurrency->SetVisibility();
		$this->currentLanguage->SetVisibility();
		$this->createdDate->SetVisibility();

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
		global $EW_EXPORT, $users;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($users);
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
					if ($pageName == "usersview.php")
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
			if ($objForm->HasValue("x__userID")) {
				$this->_userID->setFormValue($objForm->GetValue("x__userID"));
			}
		} else {
			$this->CurrentAction = "I"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (isset($_GET["_userID"])) {
				$this->_userID->setQueryStringValue($_GET["_userID"]);
				$loadByQuery = TRUE;
			} else {
				$this->_userID->CurrentValue = NULL;
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
					$this->Page_Terminate("userslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "userslist.php")
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
		$this->licenseAttachment->Upload->Index = $objForm->Index;
		$this->licenseAttachment->Upload->UploadFile();
		$this->licenseAttachment->CurrentValue = $this->licenseAttachment->Upload->FileName;
		$this->passportAttachment->Upload->Index = $objForm->Index;
		$this->passportAttachment->Upload->UploadFile();
		$this->passportAttachment->CurrentValue = $this->passportAttachment->Upload->FileName;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->_userID->FldIsDetailKey)
			$this->_userID->setFormValue($objForm->GetValue("x__userID"));
		if (!$this->firstName->FldIsDetailKey) {
			$this->firstName->setFormValue($objForm->GetValue("x_firstName"));
		}
		if (!$this->lastName->FldIsDetailKey) {
			$this->lastName->setFormValue($objForm->GetValue("x_lastName"));
		}
		if (!$this->emailID->FldIsDetailKey) {
			$this->emailID->setFormValue($objForm->GetValue("x_emailID"));
		}
		if (!$this->mobileNo->FldIsDetailKey) {
			$this->mobileNo->setFormValue($objForm->GetValue("x_mobileNo"));
		}
		if (!$this->country->FldIsDetailKey) {
			$this->country->setFormValue($objForm->GetValue("x_country"));
		}
		if (!$this->city->FldIsDetailKey) {
			$this->city->setFormValue($objForm->GetValue("x_city"));
		}
		if (!$this->nationality->FldIsDetailKey) {
			$this->nationality->setFormValue($objForm->GetValue("x_nationality"));
		}
		if (!$this->address->FldIsDetailKey) {
			$this->address->setFormValue($objForm->GetValue("x_address"));
		}
		if (!$this->state->FldIsDetailKey) {
			$this->state->setFormValue($objForm->GetValue("x_state"));
		}
		if (!$this->pincode->FldIsDetailKey) {
			$this->pincode->setFormValue($objForm->GetValue("x_pincode"));
		}
		if (!$this->emiratesID->FldIsDetailKey) {
			$this->emiratesID->setFormValue($objForm->GetValue("x_emiratesID"));
		}
		if (!$this->visaStatus->FldIsDetailKey) {
			$this->visaStatus->setFormValue($objForm->GetValue("x_visaStatus"));
		}
		if (!$this->licenseNumber->FldIsDetailKey) {
			$this->licenseNumber->setFormValue($objForm->GetValue("x_licenseNumber"));
		}
		if (!$this->licenseExpiry->FldIsDetailKey) {
			$this->licenseExpiry->setFormValue($objForm->GetValue("x_licenseExpiry"));
			$this->licenseExpiry->CurrentValue = ew_UnFormatDateTime($this->licenseExpiry->CurrentValue, 7);
		}
		if (!$this->licensePlaceOfIssue->FldIsDetailKey) {
			$this->licensePlaceOfIssue->setFormValue($objForm->GetValue("x_licensePlaceOfIssue"));
		}
		if (!$this->passportNumber->FldIsDetailKey) {
			$this->passportNumber->setFormValue($objForm->GetValue("x_passportNumber"));
		}
		if (!$this->passportExpiry->FldIsDetailKey) {
			$this->passportExpiry->setFormValue($objForm->GetValue("x_passportExpiry"));
			$this->passportExpiry->CurrentValue = ew_UnFormatDateTime($this->passportExpiry->CurrentValue, 7);
		}
		if (!$this->passportPlaceOfIssue->FldIsDetailKey) {
			$this->passportPlaceOfIssue->setFormValue($objForm->GetValue("x_passportPlaceOfIssue"));
		}
		if (!$this->signUpNewsletter->FldIsDetailKey) {
			$this->signUpNewsletter->setFormValue($objForm->GetValue("x_signUpNewsletter"));
		}
		if (!$this->password->FldIsDetailKey) {
			$this->password->setFormValue($objForm->GetValue("x_password"));
		}
		if (!$this->currentCurrency->FldIsDetailKey) {
			$this->currentCurrency->setFormValue($objForm->GetValue("x_currentCurrency"));
		}
		if (!$this->currentLanguage->FldIsDetailKey) {
			$this->currentLanguage->setFormValue($objForm->GetValue("x_currentLanguage"));
		}
		if (!$this->createdDate->FldIsDetailKey) {
			$this->createdDate->setFormValue($objForm->GetValue("x_createdDate"));
			$this->createdDate->CurrentValue = ew_UnFormatDateTime($this->createdDate->CurrentValue, 7);
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->_userID->CurrentValue = $this->_userID->FormValue;
		$this->firstName->CurrentValue = $this->firstName->FormValue;
		$this->lastName->CurrentValue = $this->lastName->FormValue;
		$this->emailID->CurrentValue = $this->emailID->FormValue;
		$this->mobileNo->CurrentValue = $this->mobileNo->FormValue;
		$this->country->CurrentValue = $this->country->FormValue;
		$this->city->CurrentValue = $this->city->FormValue;
		$this->nationality->CurrentValue = $this->nationality->FormValue;
		$this->address->CurrentValue = $this->address->FormValue;
		$this->state->CurrentValue = $this->state->FormValue;
		$this->pincode->CurrentValue = $this->pincode->FormValue;
		$this->emiratesID->CurrentValue = $this->emiratesID->FormValue;
		$this->visaStatus->CurrentValue = $this->visaStatus->FormValue;
		$this->licenseNumber->CurrentValue = $this->licenseNumber->FormValue;
		$this->licenseExpiry->CurrentValue = $this->licenseExpiry->FormValue;
		$this->licenseExpiry->CurrentValue = ew_UnFormatDateTime($this->licenseExpiry->CurrentValue, 7);
		$this->licensePlaceOfIssue->CurrentValue = $this->licensePlaceOfIssue->FormValue;
		$this->passportNumber->CurrentValue = $this->passportNumber->FormValue;
		$this->passportExpiry->CurrentValue = $this->passportExpiry->FormValue;
		$this->passportExpiry->CurrentValue = ew_UnFormatDateTime($this->passportExpiry->CurrentValue, 7);
		$this->passportPlaceOfIssue->CurrentValue = $this->passportPlaceOfIssue->FormValue;
		$this->signUpNewsletter->CurrentValue = $this->signUpNewsletter->FormValue;
		$this->password->CurrentValue = $this->password->FormValue;
		$this->currentCurrency->CurrentValue = $this->currentCurrency->FormValue;
		$this->currentLanguage->CurrentValue = $this->currentLanguage->FormValue;
		$this->createdDate->CurrentValue = $this->createdDate->FormValue;
		$this->createdDate->CurrentValue = ew_UnFormatDateTime($this->createdDate->CurrentValue, 7);
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
		$this->_userID->setDbValue($row['userID']);
		$this->firstName->setDbValue($row['firstName']);
		$this->lastName->setDbValue($row['lastName']);
		$this->emailID->setDbValue($row['emailID']);
		$this->mobileNo->setDbValue($row['mobileNo']);
		$this->country->setDbValue($row['country']);
		$this->city->setDbValue($row['city']);
		$this->nationality->setDbValue($row['nationality']);
		$this->address->setDbValue($row['address']);
		$this->state->setDbValue($row['state']);
		$this->pincode->setDbValue($row['pincode']);
		$this->emiratesID->setDbValue($row['emiratesID']);
		$this->visaStatus->setDbValue($row['visaStatus']);
		$this->licenseNumber->setDbValue($row['licenseNumber']);
		$this->licenseExpiry->setDbValue($row['licenseExpiry']);
		$this->licensePlaceOfIssue->setDbValue($row['licensePlaceOfIssue']);
		$this->licenseAttachment->Upload->DbValue = $row['licenseAttachment'];
		$this->licenseAttachment->setDbValue($this->licenseAttachment->Upload->DbValue);
		$this->passportNumber->setDbValue($row['passportNumber']);
		$this->passportExpiry->setDbValue($row['passportExpiry']);
		$this->passportPlaceOfIssue->setDbValue($row['passportPlaceOfIssue']);
		$this->passportAttachment->Upload->DbValue = $row['passportAttachment'];
		$this->passportAttachment->setDbValue($this->passportAttachment->Upload->DbValue);
		$this->signUpNewsletter->setDbValue($row['signUpNewsletter']);
		$this->password->setDbValue($row['password']);
		$this->currentCurrency->setDbValue($row['currentCurrency']);
		$this->currentLanguage->setDbValue($row['currentLanguage']);
		$this->createdDate->setDbValue($row['createdDate']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['userID'] = NULL;
		$row['firstName'] = NULL;
		$row['lastName'] = NULL;
		$row['emailID'] = NULL;
		$row['mobileNo'] = NULL;
		$row['country'] = NULL;
		$row['city'] = NULL;
		$row['nationality'] = NULL;
		$row['address'] = NULL;
		$row['state'] = NULL;
		$row['pincode'] = NULL;
		$row['emiratesID'] = NULL;
		$row['visaStatus'] = NULL;
		$row['licenseNumber'] = NULL;
		$row['licenseExpiry'] = NULL;
		$row['licensePlaceOfIssue'] = NULL;
		$row['licenseAttachment'] = NULL;
		$row['passportNumber'] = NULL;
		$row['passportExpiry'] = NULL;
		$row['passportPlaceOfIssue'] = NULL;
		$row['passportAttachment'] = NULL;
		$row['signUpNewsletter'] = NULL;
		$row['password'] = NULL;
		$row['currentCurrency'] = NULL;
		$row['currentLanguage'] = NULL;
		$row['createdDate'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->_userID->DbValue = $row['userID'];
		$this->firstName->DbValue = $row['firstName'];
		$this->lastName->DbValue = $row['lastName'];
		$this->emailID->DbValue = $row['emailID'];
		$this->mobileNo->DbValue = $row['mobileNo'];
		$this->country->DbValue = $row['country'];
		$this->city->DbValue = $row['city'];
		$this->nationality->DbValue = $row['nationality'];
		$this->address->DbValue = $row['address'];
		$this->state->DbValue = $row['state'];
		$this->pincode->DbValue = $row['pincode'];
		$this->emiratesID->DbValue = $row['emiratesID'];
		$this->visaStatus->DbValue = $row['visaStatus'];
		$this->licenseNumber->DbValue = $row['licenseNumber'];
		$this->licenseExpiry->DbValue = $row['licenseExpiry'];
		$this->licensePlaceOfIssue->DbValue = $row['licensePlaceOfIssue'];
		$this->licenseAttachment->Upload->DbValue = $row['licenseAttachment'];
		$this->passportNumber->DbValue = $row['passportNumber'];
		$this->passportExpiry->DbValue = $row['passportExpiry'];
		$this->passportPlaceOfIssue->DbValue = $row['passportPlaceOfIssue'];
		$this->passportAttachment->Upload->DbValue = $row['passportAttachment'];
		$this->signUpNewsletter->DbValue = $row['signUpNewsletter'];
		$this->password->DbValue = $row['password'];
		$this->currentCurrency->DbValue = $row['currentCurrency'];
		$this->currentLanguage->DbValue = $row['currentLanguage'];
		$this->createdDate->DbValue = $row['createdDate'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("_userID")) <> "")
			$this->_userID->CurrentValue = $this->getKey("_userID"); // userID
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
		// userID
		// firstName
		// lastName
		// emailID
		// mobileNo
		// country
		// city
		// nationality
		// address
		// state
		// pincode
		// emiratesID
		// visaStatus
		// licenseNumber
		// licenseExpiry
		// licensePlaceOfIssue
		// licenseAttachment
		// passportNumber
		// passportExpiry
		// passportPlaceOfIssue
		// passportAttachment
		// signUpNewsletter
		// password
		// currentCurrency
		// currentLanguage
		// createdDate

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// userID
		$this->_userID->ViewValue = $this->_userID->CurrentValue;
		$this->_userID->ViewCustomAttributes = "";

		// firstName
		$this->firstName->ViewValue = $this->firstName->CurrentValue;
		$this->firstName->ViewCustomAttributes = "";

		// lastName
		$this->lastName->ViewValue = $this->lastName->CurrentValue;
		$this->lastName->ViewCustomAttributes = "";

		// emailID
		$this->emailID->ViewValue = $this->emailID->CurrentValue;
		$this->emailID->ViewCustomAttributes = "";

		// mobileNo
		$this->mobileNo->ViewValue = $this->mobileNo->CurrentValue;
		$this->mobileNo->ViewCustomAttributes = "";

		// country
		$this->country->ViewValue = $this->country->CurrentValue;
		$this->country->ViewCustomAttributes = "";

		// city
		$this->city->ViewValue = $this->city->CurrentValue;
		$this->city->ViewCustomAttributes = "";

		// nationality
		if (strval($this->nationality->CurrentValue) <> "") {
			$sFilterWrk = "`nationalityID`" . ew_SearchString("=", $this->nationality->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `nationalityID`, `nationalityName` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_nationality`";
		$sWhereWrk = "";
		$this->nationality->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->nationality, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->nationality->ViewValue = $this->nationality->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->nationality->ViewValue = $this->nationality->CurrentValue;
			}
		} else {
			$this->nationality->ViewValue = NULL;
		}
		$this->nationality->ViewCustomAttributes = "";

		// address
		$this->address->ViewValue = $this->address->CurrentValue;
		$this->address->ViewCustomAttributes = "";

		// state
		$this->state->ViewValue = $this->state->CurrentValue;
		$this->state->ViewCustomAttributes = "";

		// pincode
		$this->pincode->ViewValue = $this->pincode->CurrentValue;
		$this->pincode->ViewCustomAttributes = "";

		// emiratesID
		$this->emiratesID->ViewValue = $this->emiratesID->CurrentValue;
		$this->emiratesID->ViewCustomAttributes = "";

		// visaStatus
		$this->visaStatus->ViewValue = $this->visaStatus->CurrentValue;
		$this->visaStatus->ViewCustomAttributes = "";

		// licenseNumber
		$this->licenseNumber->ViewValue = $this->licenseNumber->CurrentValue;
		$this->licenseNumber->ViewCustomAttributes = "";

		// licenseExpiry
		$this->licenseExpiry->ViewValue = $this->licenseExpiry->CurrentValue;
		$this->licenseExpiry->ViewValue = ew_FormatDateTime($this->licenseExpiry->ViewValue, 7);
		$this->licenseExpiry->ViewCustomAttributes = "";

		// licensePlaceOfIssue
		$this->licensePlaceOfIssue->ViewValue = $this->licensePlaceOfIssue->CurrentValue;
		$this->licensePlaceOfIssue->ViewCustomAttributes = "";

		// licenseAttachment
		$this->licenseAttachment->UploadPath = 'uploads/documents';
		if (!ew_Empty($this->licenseAttachment->Upload->DbValue)) {
			$this->licenseAttachment->ViewValue = $this->licenseAttachment->Upload->DbValue;
		} else {
			$this->licenseAttachment->ViewValue = "";
		}
		$this->licenseAttachment->ViewCustomAttributes = "";

		// passportNumber
		$this->passportNumber->ViewValue = $this->passportNumber->CurrentValue;
		$this->passportNumber->ViewCustomAttributes = "";

		// passportExpiry
		$this->passportExpiry->ViewValue = $this->passportExpiry->CurrentValue;
		$this->passportExpiry->ViewValue = ew_FormatDateTime($this->passportExpiry->ViewValue, 7);
		$this->passportExpiry->ViewCustomAttributes = "";

		// passportPlaceOfIssue
		$this->passportPlaceOfIssue->ViewValue = $this->passportPlaceOfIssue->CurrentValue;
		$this->passportPlaceOfIssue->ViewCustomAttributes = "";

		// passportAttachment
		$this->passportAttachment->UploadPath = 'uploads/documents';
		if (!ew_Empty($this->passportAttachment->Upload->DbValue)) {
			$this->passportAttachment->ViewValue = $this->passportAttachment->Upload->DbValue;
		} else {
			$this->passportAttachment->ViewValue = "";
		}
		$this->passportAttachment->ViewCustomAttributes = "";

		// signUpNewsletter
		if (strval($this->signUpNewsletter->CurrentValue) <> "") {
			$this->signUpNewsletter->ViewValue = $this->signUpNewsletter->OptionCaption($this->signUpNewsletter->CurrentValue);
		} else {
			$this->signUpNewsletter->ViewValue = NULL;
		}
		$this->signUpNewsletter->ViewCustomAttributes = "";

		// password
		$this->password->ViewValue = $this->password->CurrentValue;
		$this->password->ViewCustomAttributes = "";

		// currentCurrency
		$this->currentCurrency->ViewValue = $this->currentCurrency->CurrentValue;
		$this->currentCurrency->ViewCustomAttributes = "";

		// currentLanguage
		$this->currentLanguage->ViewValue = $this->currentLanguage->CurrentValue;
		$this->currentLanguage->ViewCustomAttributes = "";

		// createdDate
		$this->createdDate->ViewValue = $this->createdDate->CurrentValue;
		$this->createdDate->ViewValue = ew_FormatDateTime($this->createdDate->ViewValue, 7);
		$this->createdDate->ViewCustomAttributes = "";

			// userID
			$this->_userID->LinkCustomAttributes = "";
			$this->_userID->HrefValue = "";
			$this->_userID->TooltipValue = "";

			// firstName
			$this->firstName->LinkCustomAttributes = "";
			$this->firstName->HrefValue = "";
			$this->firstName->TooltipValue = "";

			// lastName
			$this->lastName->LinkCustomAttributes = "";
			$this->lastName->HrefValue = "";
			$this->lastName->TooltipValue = "";

			// emailID
			$this->emailID->LinkCustomAttributes = "";
			$this->emailID->HrefValue = "";
			$this->emailID->TooltipValue = "";

			// mobileNo
			$this->mobileNo->LinkCustomAttributes = "";
			$this->mobileNo->HrefValue = "";
			$this->mobileNo->TooltipValue = "";

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

			// state
			$this->state->LinkCustomAttributes = "";
			$this->state->HrefValue = "";
			$this->state->TooltipValue = "";

			// pincode
			$this->pincode->LinkCustomAttributes = "";
			$this->pincode->HrefValue = "";
			$this->pincode->TooltipValue = "";

			// emiratesID
			$this->emiratesID->LinkCustomAttributes = "";
			$this->emiratesID->HrefValue = "";
			$this->emiratesID->TooltipValue = "";

			// visaStatus
			$this->visaStatus->LinkCustomAttributes = "";
			$this->visaStatus->HrefValue = "";
			$this->visaStatus->TooltipValue = "";

			// licenseNumber
			$this->licenseNumber->LinkCustomAttributes = "";
			$this->licenseNumber->HrefValue = "";
			$this->licenseNumber->TooltipValue = "";

			// licenseExpiry
			$this->licenseExpiry->LinkCustomAttributes = "";
			$this->licenseExpiry->HrefValue = "";
			$this->licenseExpiry->TooltipValue = "";

			// licensePlaceOfIssue
			$this->licensePlaceOfIssue->LinkCustomAttributes = "";
			$this->licensePlaceOfIssue->HrefValue = "";
			$this->licensePlaceOfIssue->TooltipValue = "";

			// licenseAttachment
			$this->licenseAttachment->LinkCustomAttributes = "";
			$this->licenseAttachment->UploadPath = 'uploads/documents';
			if (!ew_Empty($this->licenseAttachment->Upload->DbValue)) {
				$this->licenseAttachment->HrefValue = ew_GetFileUploadUrl($this->licenseAttachment, $this->licenseAttachment->Upload->DbValue); // Add prefix/suffix
				$this->licenseAttachment->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->licenseAttachment->HrefValue = ew_FullUrl($this->licenseAttachment->HrefValue, "href");
			} else {
				$this->licenseAttachment->HrefValue = "";
			}
			$this->licenseAttachment->HrefValue2 = $this->licenseAttachment->UploadPath . $this->licenseAttachment->Upload->DbValue;
			$this->licenseAttachment->TooltipValue = "";

			// passportNumber
			$this->passportNumber->LinkCustomAttributes = "";
			$this->passportNumber->HrefValue = "";
			$this->passportNumber->TooltipValue = "";

			// passportExpiry
			$this->passportExpiry->LinkCustomAttributes = "";
			$this->passportExpiry->HrefValue = "";
			$this->passportExpiry->TooltipValue = "";

			// passportPlaceOfIssue
			$this->passportPlaceOfIssue->LinkCustomAttributes = "";
			$this->passportPlaceOfIssue->HrefValue = "";
			$this->passportPlaceOfIssue->TooltipValue = "";

			// passportAttachment
			$this->passportAttachment->LinkCustomAttributes = "";
			$this->passportAttachment->UploadPath = 'uploads/documents';
			if (!ew_Empty($this->passportAttachment->Upload->DbValue)) {
				$this->passportAttachment->HrefValue = ew_GetFileUploadUrl($this->passportAttachment, $this->passportAttachment->Upload->DbValue); // Add prefix/suffix
				$this->passportAttachment->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->passportAttachment->HrefValue = ew_FullUrl($this->passportAttachment->HrefValue, "href");
			} else {
				$this->passportAttachment->HrefValue = "";
			}
			$this->passportAttachment->HrefValue2 = $this->passportAttachment->UploadPath . $this->passportAttachment->Upload->DbValue;
			$this->passportAttachment->TooltipValue = "";

			// signUpNewsletter
			$this->signUpNewsletter->LinkCustomAttributes = "";
			$this->signUpNewsletter->HrefValue = "";
			$this->signUpNewsletter->TooltipValue = "";

			// password
			$this->password->LinkCustomAttributes = "";
			$this->password->HrefValue = "";
			$this->password->TooltipValue = "";

			// currentCurrency
			$this->currentCurrency->LinkCustomAttributes = "";
			$this->currentCurrency->HrefValue = "";
			$this->currentCurrency->TooltipValue = "";

			// currentLanguage
			$this->currentLanguage->LinkCustomAttributes = "";
			$this->currentLanguage->HrefValue = "";
			$this->currentLanguage->TooltipValue = "";

			// createdDate
			$this->createdDate->LinkCustomAttributes = "";
			$this->createdDate->HrefValue = "";
			$this->createdDate->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// userID
			$this->_userID->EditAttrs["class"] = "form-control";
			$this->_userID->EditCustomAttributes = "";
			$this->_userID->EditValue = $this->_userID->CurrentValue;
			$this->_userID->ViewCustomAttributes = "";

			// firstName
			$this->firstName->EditAttrs["class"] = "form-control";
			$this->firstName->EditCustomAttributes = "";
			$this->firstName->EditValue = ew_HtmlEncode($this->firstName->CurrentValue);
			$this->firstName->PlaceHolder = ew_RemoveHtml($this->firstName->FldCaption());

			// lastName
			$this->lastName->EditAttrs["class"] = "form-control";
			$this->lastName->EditCustomAttributes = "";
			$this->lastName->EditValue = ew_HtmlEncode($this->lastName->CurrentValue);
			$this->lastName->PlaceHolder = ew_RemoveHtml($this->lastName->FldCaption());

			// emailID
			$this->emailID->EditAttrs["class"] = "form-control";
			$this->emailID->EditCustomAttributes = "";
			$this->emailID->EditValue = ew_HtmlEncode($this->emailID->CurrentValue);
			$this->emailID->PlaceHolder = ew_RemoveHtml($this->emailID->FldCaption());

			// mobileNo
			$this->mobileNo->EditAttrs["class"] = "form-control";
			$this->mobileNo->EditCustomAttributes = "";
			$this->mobileNo->EditValue = ew_HtmlEncode($this->mobileNo->CurrentValue);
			$this->mobileNo->PlaceHolder = ew_RemoveHtml($this->mobileNo->FldCaption());

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

			// nationality
			$this->nationality->EditAttrs["class"] = "form-control";
			$this->nationality->EditCustomAttributes = "";
			if (trim(strval($this->nationality->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`nationalityID`" . ew_SearchString("=", $this->nationality->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `nationalityID`, `nationalityName` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `mtr_nationality`";
			$sWhereWrk = "";
			$this->nationality->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->nationality, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->nationality->EditValue = $arwrk;

			// address
			$this->address->EditAttrs["class"] = "form-control";
			$this->address->EditCustomAttributes = "";
			$this->address->EditValue = ew_HtmlEncode($this->address->CurrentValue);
			$this->address->PlaceHolder = ew_RemoveHtml($this->address->FldCaption());

			// state
			$this->state->EditAttrs["class"] = "form-control";
			$this->state->EditCustomAttributes = "";
			$this->state->EditValue = ew_HtmlEncode($this->state->CurrentValue);
			$this->state->PlaceHolder = ew_RemoveHtml($this->state->FldCaption());

			// pincode
			$this->pincode->EditAttrs["class"] = "form-control";
			$this->pincode->EditCustomAttributes = "";
			$this->pincode->EditValue = ew_HtmlEncode($this->pincode->CurrentValue);
			$this->pincode->PlaceHolder = ew_RemoveHtml($this->pincode->FldCaption());

			// emiratesID
			$this->emiratesID->EditAttrs["class"] = "form-control";
			$this->emiratesID->EditCustomAttributes = "";
			$this->emiratesID->EditValue = ew_HtmlEncode($this->emiratesID->CurrentValue);
			$this->emiratesID->PlaceHolder = ew_RemoveHtml($this->emiratesID->FldCaption());

			// visaStatus
			$this->visaStatus->EditAttrs["class"] = "form-control";
			$this->visaStatus->EditCustomAttributes = "";
			$this->visaStatus->EditValue = ew_HtmlEncode($this->visaStatus->CurrentValue);
			$this->visaStatus->PlaceHolder = ew_RemoveHtml($this->visaStatus->FldCaption());

			// licenseNumber
			$this->licenseNumber->EditAttrs["class"] = "form-control";
			$this->licenseNumber->EditCustomAttributes = "";
			$this->licenseNumber->EditValue = ew_HtmlEncode($this->licenseNumber->CurrentValue);
			$this->licenseNumber->PlaceHolder = ew_RemoveHtml($this->licenseNumber->FldCaption());

			// licenseExpiry
			$this->licenseExpiry->EditAttrs["class"] = "form-control";
			$this->licenseExpiry->EditCustomAttributes = "";
			$this->licenseExpiry->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->licenseExpiry->CurrentValue, 7));
			$this->licenseExpiry->PlaceHolder = ew_RemoveHtml($this->licenseExpiry->FldCaption());

			// licensePlaceOfIssue
			$this->licensePlaceOfIssue->EditAttrs["class"] = "form-control";
			$this->licensePlaceOfIssue->EditCustomAttributes = "";
			$this->licensePlaceOfIssue->EditValue = ew_HtmlEncode($this->licensePlaceOfIssue->CurrentValue);
			$this->licensePlaceOfIssue->PlaceHolder = ew_RemoveHtml($this->licensePlaceOfIssue->FldCaption());

			// licenseAttachment
			$this->licenseAttachment->EditAttrs["class"] = "form-control";
			$this->licenseAttachment->EditCustomAttributes = "";
			$this->licenseAttachment->UploadPath = 'uploads/documents';
			if (!ew_Empty($this->licenseAttachment->Upload->DbValue)) {
				$this->licenseAttachment->EditValue = $this->licenseAttachment->Upload->DbValue;
			} else {
				$this->licenseAttachment->EditValue = "";
			}
			if (!ew_Empty($this->licenseAttachment->CurrentValue))
					$this->licenseAttachment->Upload->FileName = $this->licenseAttachment->CurrentValue;
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->licenseAttachment);

			// passportNumber
			$this->passportNumber->EditAttrs["class"] = "form-control";
			$this->passportNumber->EditCustomAttributes = "";
			$this->passportNumber->EditValue = ew_HtmlEncode($this->passportNumber->CurrentValue);
			$this->passportNumber->PlaceHolder = ew_RemoveHtml($this->passportNumber->FldCaption());

			// passportExpiry
			$this->passportExpiry->EditAttrs["class"] = "form-control";
			$this->passportExpiry->EditCustomAttributes = "";
			$this->passportExpiry->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->passportExpiry->CurrentValue, 7));
			$this->passportExpiry->PlaceHolder = ew_RemoveHtml($this->passportExpiry->FldCaption());

			// passportPlaceOfIssue
			$this->passportPlaceOfIssue->EditAttrs["class"] = "form-control";
			$this->passportPlaceOfIssue->EditCustomAttributes = "";
			$this->passportPlaceOfIssue->EditValue = ew_HtmlEncode($this->passportPlaceOfIssue->CurrentValue);
			$this->passportPlaceOfIssue->PlaceHolder = ew_RemoveHtml($this->passportPlaceOfIssue->FldCaption());

			// passportAttachment
			$this->passportAttachment->EditAttrs["class"] = "form-control";
			$this->passportAttachment->EditCustomAttributes = "";
			$this->passportAttachment->UploadPath = 'uploads/documents';
			if (!ew_Empty($this->passportAttachment->Upload->DbValue)) {
				$this->passportAttachment->EditValue = $this->passportAttachment->Upload->DbValue;
			} else {
				$this->passportAttachment->EditValue = "";
			}
			if (!ew_Empty($this->passportAttachment->CurrentValue))
					$this->passportAttachment->Upload->FileName = $this->passportAttachment->CurrentValue;
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->passportAttachment);

			// signUpNewsletter
			$this->signUpNewsletter->EditAttrs["class"] = "form-control";
			$this->signUpNewsletter->EditCustomAttributes = "";
			$this->signUpNewsletter->EditValue = $this->signUpNewsletter->Options(TRUE);

			// password
			$this->password->EditAttrs["class"] = "form-control";
			$this->password->EditCustomAttributes = "";
			$this->password->EditValue = ew_HtmlEncode($this->password->CurrentValue);
			$this->password->PlaceHolder = ew_RemoveHtml($this->password->FldCaption());

			// currentCurrency
			$this->currentCurrency->EditAttrs["class"] = "form-control";
			$this->currentCurrency->EditCustomAttributes = "";
			$this->currentCurrency->EditValue = ew_HtmlEncode($this->currentCurrency->CurrentValue);
			$this->currentCurrency->PlaceHolder = ew_RemoveHtml($this->currentCurrency->FldCaption());

			// currentLanguage
			$this->currentLanguage->EditAttrs["class"] = "form-control";
			$this->currentLanguage->EditCustomAttributes = "";
			$this->currentLanguage->EditValue = ew_HtmlEncode($this->currentLanguage->CurrentValue);
			$this->currentLanguage->PlaceHolder = ew_RemoveHtml($this->currentLanguage->FldCaption());

			// createdDate
			$this->createdDate->EditAttrs["class"] = "form-control";
			$this->createdDate->EditCustomAttributes = "";
			$this->createdDate->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->createdDate->CurrentValue, 7));
			$this->createdDate->PlaceHolder = ew_RemoveHtml($this->createdDate->FldCaption());

			// Edit refer script
			// userID

			$this->_userID->LinkCustomAttributes = "";
			$this->_userID->HrefValue = "";

			// firstName
			$this->firstName->LinkCustomAttributes = "";
			$this->firstName->HrefValue = "";

			// lastName
			$this->lastName->LinkCustomAttributes = "";
			$this->lastName->HrefValue = "";

			// emailID
			$this->emailID->LinkCustomAttributes = "";
			$this->emailID->HrefValue = "";

			// mobileNo
			$this->mobileNo->LinkCustomAttributes = "";
			$this->mobileNo->HrefValue = "";

			// country
			$this->country->LinkCustomAttributes = "";
			$this->country->HrefValue = "";

			// city
			$this->city->LinkCustomAttributes = "";
			$this->city->HrefValue = "";

			// nationality
			$this->nationality->LinkCustomAttributes = "";
			$this->nationality->HrefValue = "";

			// address
			$this->address->LinkCustomAttributes = "";
			$this->address->HrefValue = "";

			// state
			$this->state->LinkCustomAttributes = "";
			$this->state->HrefValue = "";

			// pincode
			$this->pincode->LinkCustomAttributes = "";
			$this->pincode->HrefValue = "";

			// emiratesID
			$this->emiratesID->LinkCustomAttributes = "";
			$this->emiratesID->HrefValue = "";

			// visaStatus
			$this->visaStatus->LinkCustomAttributes = "";
			$this->visaStatus->HrefValue = "";

			// licenseNumber
			$this->licenseNumber->LinkCustomAttributes = "";
			$this->licenseNumber->HrefValue = "";

			// licenseExpiry
			$this->licenseExpiry->LinkCustomAttributes = "";
			$this->licenseExpiry->HrefValue = "";

			// licensePlaceOfIssue
			$this->licensePlaceOfIssue->LinkCustomAttributes = "";
			$this->licensePlaceOfIssue->HrefValue = "";

			// licenseAttachment
			$this->licenseAttachment->LinkCustomAttributes = "";
			$this->licenseAttachment->UploadPath = 'uploads/documents';
			if (!ew_Empty($this->licenseAttachment->Upload->DbValue)) {
				$this->licenseAttachment->HrefValue = ew_GetFileUploadUrl($this->licenseAttachment, $this->licenseAttachment->Upload->DbValue); // Add prefix/suffix
				$this->licenseAttachment->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->licenseAttachment->HrefValue = ew_FullUrl($this->licenseAttachment->HrefValue, "href");
			} else {
				$this->licenseAttachment->HrefValue = "";
			}
			$this->licenseAttachment->HrefValue2 = $this->licenseAttachment->UploadPath . $this->licenseAttachment->Upload->DbValue;

			// passportNumber
			$this->passportNumber->LinkCustomAttributes = "";
			$this->passportNumber->HrefValue = "";

			// passportExpiry
			$this->passportExpiry->LinkCustomAttributes = "";
			$this->passportExpiry->HrefValue = "";

			// passportPlaceOfIssue
			$this->passportPlaceOfIssue->LinkCustomAttributes = "";
			$this->passportPlaceOfIssue->HrefValue = "";

			// passportAttachment
			$this->passportAttachment->LinkCustomAttributes = "";
			$this->passportAttachment->UploadPath = 'uploads/documents';
			if (!ew_Empty($this->passportAttachment->Upload->DbValue)) {
				$this->passportAttachment->HrefValue = ew_GetFileUploadUrl($this->passportAttachment, $this->passportAttachment->Upload->DbValue); // Add prefix/suffix
				$this->passportAttachment->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->passportAttachment->HrefValue = ew_FullUrl($this->passportAttachment->HrefValue, "href");
			} else {
				$this->passportAttachment->HrefValue = "";
			}
			$this->passportAttachment->HrefValue2 = $this->passportAttachment->UploadPath . $this->passportAttachment->Upload->DbValue;

			// signUpNewsletter
			$this->signUpNewsletter->LinkCustomAttributes = "";
			$this->signUpNewsletter->HrefValue = "";

			// password
			$this->password->LinkCustomAttributes = "";
			$this->password->HrefValue = "";

			// currentCurrency
			$this->currentCurrency->LinkCustomAttributes = "";
			$this->currentCurrency->HrefValue = "";

			// currentLanguage
			$this->currentLanguage->LinkCustomAttributes = "";
			$this->currentLanguage->HrefValue = "";

			// createdDate
			$this->createdDate->LinkCustomAttributes = "";
			$this->createdDate->HrefValue = "";
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
		if (!ew_CheckInteger($this->mobileNo->FormValue)) {
			ew_AddMessage($gsFormError, $this->mobileNo->FldErrMsg());
		}
		if (!ew_CheckEuroDate($this->licenseExpiry->FormValue)) {
			ew_AddMessage($gsFormError, $this->licenseExpiry->FldErrMsg());
		}
		if (!ew_CheckEuroDate($this->passportExpiry->FormValue)) {
			ew_AddMessage($gsFormError, $this->passportExpiry->FldErrMsg());
		}
		if (!ew_CheckEuroDate($this->createdDate->FormValue)) {
			ew_AddMessage($gsFormError, $this->createdDate->FldErrMsg());
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
			$this->licenseAttachment->OldUploadPath = 'uploads/documents';
			$this->licenseAttachment->UploadPath = $this->licenseAttachment->OldUploadPath;
			$this->passportAttachment->OldUploadPath = 'uploads/documents';
			$this->passportAttachment->UploadPath = $this->passportAttachment->OldUploadPath;
			$rsnew = array();

			// firstName
			$this->firstName->SetDbValueDef($rsnew, $this->firstName->CurrentValue, NULL, $this->firstName->ReadOnly);

			// lastName
			$this->lastName->SetDbValueDef($rsnew, $this->lastName->CurrentValue, NULL, $this->lastName->ReadOnly);

			// emailID
			$this->emailID->SetDbValueDef($rsnew, $this->emailID->CurrentValue, NULL, $this->emailID->ReadOnly);

			// mobileNo
			$this->mobileNo->SetDbValueDef($rsnew, $this->mobileNo->CurrentValue, NULL, $this->mobileNo->ReadOnly);

			// country
			$this->country->SetDbValueDef($rsnew, $this->country->CurrentValue, NULL, $this->country->ReadOnly);

			// city
			$this->city->SetDbValueDef($rsnew, $this->city->CurrentValue, NULL, $this->city->ReadOnly);

			// nationality
			$this->nationality->SetDbValueDef($rsnew, $this->nationality->CurrentValue, NULL, $this->nationality->ReadOnly);

			// address
			$this->address->SetDbValueDef($rsnew, $this->address->CurrentValue, NULL, $this->address->ReadOnly);

			// state
			$this->state->SetDbValueDef($rsnew, $this->state->CurrentValue, NULL, $this->state->ReadOnly);

			// pincode
			$this->pincode->SetDbValueDef($rsnew, $this->pincode->CurrentValue, NULL, $this->pincode->ReadOnly);

			// emiratesID
			$this->emiratesID->SetDbValueDef($rsnew, $this->emiratesID->CurrentValue, NULL, $this->emiratesID->ReadOnly);

			// visaStatus
			$this->visaStatus->SetDbValueDef($rsnew, $this->visaStatus->CurrentValue, NULL, $this->visaStatus->ReadOnly);

			// licenseNumber
			$this->licenseNumber->SetDbValueDef($rsnew, $this->licenseNumber->CurrentValue, NULL, $this->licenseNumber->ReadOnly);

			// licenseExpiry
			$this->licenseExpiry->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->licenseExpiry->CurrentValue, 7), NULL, $this->licenseExpiry->ReadOnly);

			// licensePlaceOfIssue
			$this->licensePlaceOfIssue->SetDbValueDef($rsnew, $this->licensePlaceOfIssue->CurrentValue, NULL, $this->licensePlaceOfIssue->ReadOnly);

			// licenseAttachment
			if ($this->licenseAttachment->Visible && !$this->licenseAttachment->ReadOnly && !$this->licenseAttachment->Upload->KeepFile) {
				$this->licenseAttachment->Upload->DbValue = $rsold['licenseAttachment']; // Get original value
				if ($this->licenseAttachment->Upload->FileName == "") {
					$rsnew['licenseAttachment'] = NULL;
				} else {
					$rsnew['licenseAttachment'] = $this->licenseAttachment->Upload->FileName;
				}
			}

			// passportNumber
			$this->passportNumber->SetDbValueDef($rsnew, $this->passportNumber->CurrentValue, NULL, $this->passportNumber->ReadOnly);

			// passportExpiry
			$this->passportExpiry->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->passportExpiry->CurrentValue, 7), NULL, $this->passportExpiry->ReadOnly);

			// passportPlaceOfIssue
			$this->passportPlaceOfIssue->SetDbValueDef($rsnew, $this->passportPlaceOfIssue->CurrentValue, NULL, $this->passportPlaceOfIssue->ReadOnly);

			// passportAttachment
			if ($this->passportAttachment->Visible && !$this->passportAttachment->ReadOnly && !$this->passportAttachment->Upload->KeepFile) {
				$this->passportAttachment->Upload->DbValue = $rsold['passportAttachment']; // Get original value
				if ($this->passportAttachment->Upload->FileName == "") {
					$rsnew['passportAttachment'] = NULL;
				} else {
					$rsnew['passportAttachment'] = $this->passportAttachment->Upload->FileName;
				}
			}

			// signUpNewsletter
			$this->signUpNewsletter->SetDbValueDef($rsnew, $this->signUpNewsletter->CurrentValue, NULL, $this->signUpNewsletter->ReadOnly);

			// password
			$this->password->SetDbValueDef($rsnew, $this->password->CurrentValue, NULL, $this->password->ReadOnly);

			// currentCurrency
			$this->currentCurrency->SetDbValueDef($rsnew, $this->currentCurrency->CurrentValue, NULL, $this->currentCurrency->ReadOnly);

			// currentLanguage
			$this->currentLanguage->SetDbValueDef($rsnew, $this->currentLanguage->CurrentValue, NULL, $this->currentLanguage->ReadOnly);

			// createdDate
			$this->createdDate->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->createdDate->CurrentValue, 7), NULL, $this->createdDate->ReadOnly);
			if ($this->licenseAttachment->Visible && !$this->licenseAttachment->Upload->KeepFile) {
				$this->licenseAttachment->UploadPath = 'uploads/documents';
				$OldFiles = ew_Empty($this->licenseAttachment->Upload->DbValue) ? array() : array($this->licenseAttachment->Upload->DbValue);
				if (!ew_Empty($this->licenseAttachment->Upload->FileName)) {
					$NewFiles = array($this->licenseAttachment->Upload->FileName);
					$NewFileCount = count($NewFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						$fldvar = ($this->licenseAttachment->Upload->Index < 0) ? $this->licenseAttachment->FldVar : substr($this->licenseAttachment->FldVar, 0, 1) . $this->licenseAttachment->Upload->Index . substr($this->licenseAttachment->FldVar, 1);
						if ($NewFiles[$i] <> "") {
							$file = $NewFiles[$i];
							if (file_exists(ew_UploadTempPath($fldvar, $this->licenseAttachment->TblVar) . $file)) {
								$file1 = ew_UploadFileNameEx($this->licenseAttachment->PhysicalUploadPath(), $file); // Get new file name
								if ($file1 <> $file) { // Rename temp file
									while (file_exists(ew_UploadTempPath($fldvar, $this->licenseAttachment->TblVar) . $file1) || file_exists($this->licenseAttachment->PhysicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = ew_UniqueFilename($this->licenseAttachment->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
									rename(ew_UploadTempPath($fldvar, $this->licenseAttachment->TblVar) . $file, ew_UploadTempPath($fldvar, $this->licenseAttachment->TblVar) . $file1);
									$NewFiles[$i] = $file1;
								}
							}
						}
					}
					$this->licenseAttachment->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
					$this->licenseAttachment->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
					$this->licenseAttachment->SetDbValueDef($rsnew, $this->licenseAttachment->Upload->FileName, NULL, $this->licenseAttachment->ReadOnly);
				}
			}
			if ($this->passportAttachment->Visible && !$this->passportAttachment->Upload->KeepFile) {
				$this->passportAttachment->UploadPath = 'uploads/documents';
				$OldFiles = ew_Empty($this->passportAttachment->Upload->DbValue) ? array() : array($this->passportAttachment->Upload->DbValue);
				if (!ew_Empty($this->passportAttachment->Upload->FileName)) {
					$NewFiles = array($this->passportAttachment->Upload->FileName);
					$NewFileCount = count($NewFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						$fldvar = ($this->passportAttachment->Upload->Index < 0) ? $this->passportAttachment->FldVar : substr($this->passportAttachment->FldVar, 0, 1) . $this->passportAttachment->Upload->Index . substr($this->passportAttachment->FldVar, 1);
						if ($NewFiles[$i] <> "") {
							$file = $NewFiles[$i];
							if (file_exists(ew_UploadTempPath($fldvar, $this->passportAttachment->TblVar) . $file)) {
								$file1 = ew_UploadFileNameEx($this->passportAttachment->PhysicalUploadPath(), $file); // Get new file name
								if ($file1 <> $file) { // Rename temp file
									while (file_exists(ew_UploadTempPath($fldvar, $this->passportAttachment->TblVar) . $file1) || file_exists($this->passportAttachment->PhysicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = ew_UniqueFilename($this->passportAttachment->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
									rename(ew_UploadTempPath($fldvar, $this->passportAttachment->TblVar) . $file, ew_UploadTempPath($fldvar, $this->passportAttachment->TblVar) . $file1);
									$NewFiles[$i] = $file1;
								}
							}
						}
					}
					$this->passportAttachment->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
					$this->passportAttachment->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
					$this->passportAttachment->SetDbValueDef($rsnew, $this->passportAttachment->Upload->FileName, NULL, $this->passportAttachment->ReadOnly);
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
					if ($this->licenseAttachment->Visible && !$this->licenseAttachment->Upload->KeepFile) {
						$OldFiles = ew_Empty($this->licenseAttachment->Upload->DbValue) ? array() : array($this->licenseAttachment->Upload->DbValue);
						if (!ew_Empty($this->licenseAttachment->Upload->FileName)) {
							$NewFiles = array($this->licenseAttachment->Upload->FileName);
							$NewFiles2 = array($rsnew['licenseAttachment']);
							$NewFileCount = count($NewFiles);
							for ($i = 0; $i < $NewFileCount; $i++) {
								$fldvar = ($this->licenseAttachment->Upload->Index < 0) ? $this->licenseAttachment->FldVar : substr($this->licenseAttachment->FldVar, 0, 1) . $this->licenseAttachment->Upload->Index . substr($this->licenseAttachment->FldVar, 1);
								if ($NewFiles[$i] <> "") {
									$file = ew_UploadTempPath($fldvar, $this->licenseAttachment->TblVar) . $NewFiles[$i];
									if (file_exists($file)) {
										if (@$NewFiles2[$i] <> "") // Use correct file name
											$NewFiles[$i] = $NewFiles2[$i];
										if (!$this->licenseAttachment->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
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
					if ($this->passportAttachment->Visible && !$this->passportAttachment->Upload->KeepFile) {
						$OldFiles = ew_Empty($this->passportAttachment->Upload->DbValue) ? array() : array($this->passportAttachment->Upload->DbValue);
						if (!ew_Empty($this->passportAttachment->Upload->FileName)) {
							$NewFiles = array($this->passportAttachment->Upload->FileName);
							$NewFiles2 = array($rsnew['passportAttachment']);
							$NewFileCount = count($NewFiles);
							for ($i = 0; $i < $NewFileCount; $i++) {
								$fldvar = ($this->passportAttachment->Upload->Index < 0) ? $this->passportAttachment->FldVar : substr($this->passportAttachment->FldVar, 0, 1) . $this->passportAttachment->Upload->Index . substr($this->passportAttachment->FldVar, 1);
								if ($NewFiles[$i] <> "") {
									$file = ew_UploadTempPath($fldvar, $this->passportAttachment->TblVar) . $NewFiles[$i];
									if (file_exists($file)) {
										if (@$NewFiles2[$i] <> "") // Use correct file name
											$NewFiles[$i] = $NewFiles2[$i];
										if (!$this->passportAttachment->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
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

		// licenseAttachment
		ew_CleanUploadTempPath($this->licenseAttachment, $this->licenseAttachment->Upload->Index);

		// passportAttachment
		ew_CleanUploadTempPath($this->passportAttachment, $this->passportAttachment->Upload->Index);
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("userslist.php"), "", $this->TableVar, TRUE);
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
		case "x_nationality":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `nationalityID` AS `LinkFld`, `nationalityName` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_nationality`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`nationalityID` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->nationality, $sWhereWrk); // Call Lookup Selecting
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
if (!isset($users_edit)) $users_edit = new cusers_edit();

// Page init
$users_edit->Page_Init();

// Page main
$users_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = fusersedit = new ew_Form("fusersedit", "edit");

// Validate form
fusersedit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_mobileNo");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($users->mobileNo->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_licenseExpiry");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($users->licenseExpiry->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_passportExpiry");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($users->passportExpiry->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_createdDate");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($users->createdDate->FldErrMsg()) ?>");

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
fusersedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fusersedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Multi-Page
fusersedit.MultiPage = new ew_MultiPage("fusersedit");

// Dynamic selection lists
fusersedit.Lists["x_nationality"] = {"LinkField":"x_nationalityID","Ajax":true,"AutoFill":false,"DisplayFields":["x_nationalityName","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_nationality"};
fusersedit.Lists["x_nationality"].Data = "<?php echo $users_edit->nationality->LookupFilterQuery(FALSE, "edit") ?>";
fusersedit.Lists["x_signUpNewsletter"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fusersedit.Lists["x_signUpNewsletter"].Options = <?php echo json_encode($users_edit->signUpNewsletter->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $users_edit->ShowPageHeader(); ?>
<?php
$users_edit->ShowMessage();
?>
<form name="fusersedit" id="fusersedit" class="<?php echo $users_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($users_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $users_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($users_edit->IsModal) ?>">
<div class="ewMultiPage"><!-- multi-page -->
<div class="nav-tabs-custom" id="users_edit"><!-- multi-page .nav-tabs-custom -->
	<ul class="nav<?php echo $users_edit->MultiPages->NavStyle() ?>">
		<li<?php echo $users_edit->MultiPages->TabStyle("1") ?>><a href="#tab_users1" data-toggle="tab"><?php echo $users->PageCaption(1) ?></a></li>
		<li<?php echo $users_edit->MultiPages->TabStyle("2") ?>><a href="#tab_users2" data-toggle="tab"><?php echo $users->PageCaption(2) ?></a></li>
		<li<?php echo $users_edit->MultiPages->TabStyle("3") ?>><a href="#tab_users3" data-toggle="tab"><?php echo $users->PageCaption(3) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page .nav-tabs-custom .tab-content -->
		<div class="tab-pane<?php echo $users_edit->MultiPages->PageStyle("1") ?>" id="tab_users1"><!-- multi-page .tab-pane -->
<div class="ewEditDiv"><!-- page* -->
<?php if ($users->_userID->Visible) { // userID ?>
	<div id="r__userID" class="form-group">
		<label id="elh_users__userID" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->_userID->FldCaption() ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->_userID->CellAttributes() ?>>
<span id="el_users__userID">
<span<?php echo $users->_userID->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $users->_userID->EditValue ?></p></span>
</span>
<input type="hidden" data-table="users" data-field="x__userID" data-page="1" name="x__userID" id="x__userID" value="<?php echo ew_HtmlEncode($users->_userID->CurrentValue) ?>">
<?php echo $users->_userID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->firstName->Visible) { // firstName ?>
	<div id="r_firstName" class="form-group">
		<label id="elh_users_firstName" for="x_firstName" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->firstName->FldCaption() ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->firstName->CellAttributes() ?>>
<span id="el_users_firstName">
<input type="text" data-table="users" data-field="x_firstName" data-page="1" name="x_firstName" id="x_firstName" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($users->firstName->getPlaceHolder()) ?>" value="<?php echo $users->firstName->EditValue ?>"<?php echo $users->firstName->EditAttributes() ?>>
</span>
<?php echo $users->firstName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->lastName->Visible) { // lastName ?>
	<div id="r_lastName" class="form-group">
		<label id="elh_users_lastName" for="x_lastName" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->lastName->FldCaption() ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->lastName->CellAttributes() ?>>
<span id="el_users_lastName">
<input type="text" data-table="users" data-field="x_lastName" data-page="1" name="x_lastName" id="x_lastName" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($users->lastName->getPlaceHolder()) ?>" value="<?php echo $users->lastName->EditValue ?>"<?php echo $users->lastName->EditAttributes() ?>>
</span>
<?php echo $users->lastName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->emailID->Visible) { // emailID ?>
	<div id="r_emailID" class="form-group">
		<label id="elh_users_emailID" for="x_emailID" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->emailID->FldCaption() ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->emailID->CellAttributes() ?>>
<span id="el_users_emailID">
<input type="text" data-table="users" data-field="x_emailID" data-page="1" name="x_emailID" id="x_emailID" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($users->emailID->getPlaceHolder()) ?>" value="<?php echo $users->emailID->EditValue ?>"<?php echo $users->emailID->EditAttributes() ?>>
</span>
<?php echo $users->emailID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->mobileNo->Visible) { // mobileNo ?>
	<div id="r_mobileNo" class="form-group">
		<label id="elh_users_mobileNo" for="x_mobileNo" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->mobileNo->FldCaption() ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->mobileNo->CellAttributes() ?>>
<span id="el_users_mobileNo">
<input type="text" data-table="users" data-field="x_mobileNo" data-page="1" name="x_mobileNo" id="x_mobileNo" size="30" placeholder="<?php echo ew_HtmlEncode($users->mobileNo->getPlaceHolder()) ?>" value="<?php echo $users->mobileNo->EditValue ?>"<?php echo $users->mobileNo->EditAttributes() ?>>
</span>
<?php echo $users->mobileNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->country->Visible) { // country ?>
	<div id="r_country" class="form-group">
		<label id="elh_users_country" for="x_country" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->country->FldCaption() ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->country->CellAttributes() ?>>
<span id="el_users_country">
<input type="text" data-table="users" data-field="x_country" data-page="1" name="x_country" id="x_country" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($users->country->getPlaceHolder()) ?>" value="<?php echo $users->country->EditValue ?>"<?php echo $users->country->EditAttributes() ?>>
</span>
<?php echo $users->country->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->city->Visible) { // city ?>
	<div id="r_city" class="form-group">
		<label id="elh_users_city" for="x_city" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->city->FldCaption() ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->city->CellAttributes() ?>>
<span id="el_users_city">
<input type="text" data-table="users" data-field="x_city" data-page="1" name="x_city" id="x_city" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($users->city->getPlaceHolder()) ?>" value="<?php echo $users->city->EditValue ?>"<?php echo $users->city->EditAttributes() ?>>
</span>
<?php echo $users->city->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->nationality->Visible) { // nationality ?>
	<div id="r_nationality" class="form-group">
		<label id="elh_users_nationality" for="x_nationality" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->nationality->FldCaption() ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->nationality->CellAttributes() ?>>
<span id="el_users_nationality">
<select data-table="users" data-field="x_nationality" data-page="1" data-value-separator="<?php echo $users->nationality->DisplayValueSeparatorAttribute() ?>" id="x_nationality" name="x_nationality"<?php echo $users->nationality->EditAttributes() ?>>
<?php echo $users->nationality->SelectOptionListHtml("x_nationality") ?>
</select>
</span>
<?php echo $users->nationality->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->address->Visible) { // address ?>
	<div id="r_address" class="form-group">
		<label id="elh_users_address" for="x_address" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->address->FldCaption() ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->address->CellAttributes() ?>>
<span id="el_users_address">
<input type="text" data-table="users" data-field="x_address" data-page="1" name="x_address" id="x_address" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($users->address->getPlaceHolder()) ?>" value="<?php echo $users->address->EditValue ?>"<?php echo $users->address->EditAttributes() ?>>
</span>
<?php echo $users->address->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->state->Visible) { // state ?>
	<div id="r_state" class="form-group">
		<label id="elh_users_state" for="x_state" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->state->FldCaption() ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->state->CellAttributes() ?>>
<span id="el_users_state">
<input type="text" data-table="users" data-field="x_state" data-page="1" name="x_state" id="x_state" size="30" maxlength="250" placeholder="<?php echo ew_HtmlEncode($users->state->getPlaceHolder()) ?>" value="<?php echo $users->state->EditValue ?>"<?php echo $users->state->EditAttributes() ?>>
</span>
<?php echo $users->state->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->pincode->Visible) { // pincode ?>
	<div id="r_pincode" class="form-group">
		<label id="elh_users_pincode" for="x_pincode" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->pincode->FldCaption() ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->pincode->CellAttributes() ?>>
<span id="el_users_pincode">
<input type="text" data-table="users" data-field="x_pincode" data-page="1" name="x_pincode" id="x_pincode" size="30" maxlength="12" placeholder="<?php echo ew_HtmlEncode($users->pincode->getPlaceHolder()) ?>" value="<?php echo $users->pincode->EditValue ?>"<?php echo $users->pincode->EditAttributes() ?>>
</span>
<?php echo $users->pincode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->emiratesID->Visible) { // emiratesID ?>
	<div id="r_emiratesID" class="form-group">
		<label id="elh_users_emiratesID" for="x_emiratesID" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->emiratesID->FldCaption() ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->emiratesID->CellAttributes() ?>>
<span id="el_users_emiratesID">
<input type="text" data-table="users" data-field="x_emiratesID" data-page="1" name="x_emiratesID" id="x_emiratesID" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($users->emiratesID->getPlaceHolder()) ?>" value="<?php echo $users->emiratesID->EditValue ?>"<?php echo $users->emiratesID->EditAttributes() ?>>
</span>
<?php echo $users->emiratesID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->visaStatus->Visible) { // visaStatus ?>
	<div id="r_visaStatus" class="form-group">
		<label id="elh_users_visaStatus" for="x_visaStatus" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->visaStatus->FldCaption() ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->visaStatus->CellAttributes() ?>>
<span id="el_users_visaStatus">
<input type="text" data-table="users" data-field="x_visaStatus" data-page="1" name="x_visaStatus" id="x_visaStatus" size="30" maxlength="12" placeholder="<?php echo ew_HtmlEncode($users->visaStatus->getPlaceHolder()) ?>" value="<?php echo $users->visaStatus->EditValue ?>"<?php echo $users->visaStatus->EditAttributes() ?>>
</span>
<?php echo $users->visaStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->signUpNewsletter->Visible) { // signUpNewsletter ?>
	<div id="r_signUpNewsletter" class="form-group">
		<label id="elh_users_signUpNewsletter" for="x_signUpNewsletter" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->signUpNewsletter->FldCaption() ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->signUpNewsletter->CellAttributes() ?>>
<span id="el_users_signUpNewsletter">
<select data-table="users" data-field="x_signUpNewsletter" data-page="1" data-value-separator="<?php echo $users->signUpNewsletter->DisplayValueSeparatorAttribute() ?>" id="x_signUpNewsletter" name="x_signUpNewsletter"<?php echo $users->signUpNewsletter->EditAttributes() ?>>
<?php echo $users->signUpNewsletter->SelectOptionListHtml("x_signUpNewsletter") ?>
</select>
</span>
<?php echo $users->signUpNewsletter->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->password->Visible) { // password ?>
	<div id="r_password" class="form-group">
		<label id="elh_users_password" for="x_password" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->password->FldCaption() ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->password->CellAttributes() ?>>
<span id="el_users_password">
<input type="text" data-table="users" data-field="x_password" data-page="1" name="x_password" id="x_password" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($users->password->getPlaceHolder()) ?>" value="<?php echo $users->password->EditValue ?>"<?php echo $users->password->EditAttributes() ?>>
</span>
<?php echo $users->password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->currentCurrency->Visible) { // currentCurrency ?>
	<div id="r_currentCurrency" class="form-group">
		<label id="elh_users_currentCurrency" for="x_currentCurrency" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->currentCurrency->FldCaption() ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->currentCurrency->CellAttributes() ?>>
<span id="el_users_currentCurrency">
<input type="text" data-table="users" data-field="x_currentCurrency" data-page="1" name="x_currentCurrency" id="x_currentCurrency" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($users->currentCurrency->getPlaceHolder()) ?>" value="<?php echo $users->currentCurrency->EditValue ?>"<?php echo $users->currentCurrency->EditAttributes() ?>>
</span>
<?php echo $users->currentCurrency->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->currentLanguage->Visible) { // currentLanguage ?>
	<div id="r_currentLanguage" class="form-group">
		<label id="elh_users_currentLanguage" for="x_currentLanguage" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->currentLanguage->FldCaption() ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->currentLanguage->CellAttributes() ?>>
<span id="el_users_currentLanguage">
<input type="text" data-table="users" data-field="x_currentLanguage" data-page="1" name="x_currentLanguage" id="x_currentLanguage" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($users->currentLanguage->getPlaceHolder()) ?>" value="<?php echo $users->currentLanguage->EditValue ?>"<?php echo $users->currentLanguage->EditAttributes() ?>>
</span>
<?php echo $users->currentLanguage->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->createdDate->Visible) { // createdDate ?>
	<div id="r_createdDate" class="form-group">
		<label id="elh_users_createdDate" for="x_createdDate" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->createdDate->FldCaption() ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->createdDate->CellAttributes() ?>>
<span id="el_users_createdDate">
<input type="text" data-table="users" data-field="x_createdDate" data-page="1" data-format="7" name="x_createdDate" id="x_createdDate" placeholder="<?php echo ew_HtmlEncode($users->createdDate->getPlaceHolder()) ?>" value="<?php echo $users->createdDate->EditValue ?>"<?php echo $users->createdDate->EditAttributes() ?>>
<?php if (!$users->createdDate->ReadOnly && !$users->createdDate->Disabled && !isset($users->createdDate->EditAttrs["readonly"]) && !isset($users->createdDate->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("fusersedit", "x_createdDate", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php echo $users->createdDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $users_edit->MultiPages->PageStyle("2") ?>" id="tab_users2"><!-- multi-page .tab-pane -->
<div class="ewEditDiv"><!-- page* -->
<?php if ($users->licenseNumber->Visible) { // licenseNumber ?>
	<div id="r_licenseNumber" class="form-group">
		<label id="elh_users_licenseNumber" for="x_licenseNumber" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->licenseNumber->FldCaption() ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->licenseNumber->CellAttributes() ?>>
<span id="el_users_licenseNumber">
<input type="text" data-table="users" data-field="x_licenseNumber" data-page="2" name="x_licenseNumber" id="x_licenseNumber" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($users->licenseNumber->getPlaceHolder()) ?>" value="<?php echo $users->licenseNumber->EditValue ?>"<?php echo $users->licenseNumber->EditAttributes() ?>>
</span>
<?php echo $users->licenseNumber->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->licenseExpiry->Visible) { // licenseExpiry ?>
	<div id="r_licenseExpiry" class="form-group">
		<label id="elh_users_licenseExpiry" for="x_licenseExpiry" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->licenseExpiry->FldCaption() ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->licenseExpiry->CellAttributes() ?>>
<span id="el_users_licenseExpiry">
<input type="text" data-table="users" data-field="x_licenseExpiry" data-page="2" data-format="7" name="x_licenseExpiry" id="x_licenseExpiry" placeholder="<?php echo ew_HtmlEncode($users->licenseExpiry->getPlaceHolder()) ?>" value="<?php echo $users->licenseExpiry->EditValue ?>"<?php echo $users->licenseExpiry->EditAttributes() ?>>
<?php if (!$users->licenseExpiry->ReadOnly && !$users->licenseExpiry->Disabled && !isset($users->licenseExpiry->EditAttrs["readonly"]) && !isset($users->licenseExpiry->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("fusersedit", "x_licenseExpiry", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php echo $users->licenseExpiry->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->licensePlaceOfIssue->Visible) { // licensePlaceOfIssue ?>
	<div id="r_licensePlaceOfIssue" class="form-group">
		<label id="elh_users_licensePlaceOfIssue" for="x_licensePlaceOfIssue" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->licensePlaceOfIssue->FldCaption() ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->licensePlaceOfIssue->CellAttributes() ?>>
<span id="el_users_licensePlaceOfIssue">
<input type="text" data-table="users" data-field="x_licensePlaceOfIssue" data-page="2" name="x_licensePlaceOfIssue" id="x_licensePlaceOfIssue" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($users->licensePlaceOfIssue->getPlaceHolder()) ?>" value="<?php echo $users->licensePlaceOfIssue->EditValue ?>"<?php echo $users->licensePlaceOfIssue->EditAttributes() ?>>
</span>
<?php echo $users->licensePlaceOfIssue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->licenseAttachment->Visible) { // licenseAttachment ?>
	<div id="r_licenseAttachment" class="form-group">
		<label id="elh_users_licenseAttachment" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->licenseAttachment->FldCaption() ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->licenseAttachment->CellAttributes() ?>>
<span id="el_users_licenseAttachment">
<div id="fd_x_licenseAttachment">
<span title="<?php echo $users->licenseAttachment->FldTitle() ? $users->licenseAttachment->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($users->licenseAttachment->ReadOnly || $users->licenseAttachment->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="users" data-field="x_licenseAttachment" data-page="2" name="x_licenseAttachment" id="x_licenseAttachment"<?php echo $users->licenseAttachment->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_licenseAttachment" id= "fn_x_licenseAttachment" value="<?php echo $users->licenseAttachment->Upload->FileName ?>">
<?php if (@$_POST["fa_x_licenseAttachment"] == "0") { ?>
<input type="hidden" name="fa_x_licenseAttachment" id= "fa_x_licenseAttachment" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_licenseAttachment" id= "fa_x_licenseAttachment" value="1">
<?php } ?>
<input type="hidden" name="fs_x_licenseAttachment" id= "fs_x_licenseAttachment" value="255">
<input type="hidden" name="fx_x_licenseAttachment" id= "fx_x_licenseAttachment" value="<?php echo $users->licenseAttachment->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_licenseAttachment" id= "fm_x_licenseAttachment" value="<?php echo $users->licenseAttachment->UploadMaxFileSize ?>">
</div>
<table id="ft_x_licenseAttachment" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $users->licenseAttachment->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $users_edit->MultiPages->PageStyle("3") ?>" id="tab_users3"><!-- multi-page .tab-pane -->
<div class="ewEditDiv"><!-- page* -->
<?php if ($users->passportNumber->Visible) { // passportNumber ?>
	<div id="r_passportNumber" class="form-group">
		<label id="elh_users_passportNumber" for="x_passportNumber" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->passportNumber->FldCaption() ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->passportNumber->CellAttributes() ?>>
<span id="el_users_passportNumber">
<input type="text" data-table="users" data-field="x_passportNumber" data-page="3" name="x_passportNumber" id="x_passportNumber" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($users->passportNumber->getPlaceHolder()) ?>" value="<?php echo $users->passportNumber->EditValue ?>"<?php echo $users->passportNumber->EditAttributes() ?>>
</span>
<?php echo $users->passportNumber->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->passportExpiry->Visible) { // passportExpiry ?>
	<div id="r_passportExpiry" class="form-group">
		<label id="elh_users_passportExpiry" for="x_passportExpiry" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->passportExpiry->FldCaption() ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->passportExpiry->CellAttributes() ?>>
<span id="el_users_passportExpiry">
<input type="text" data-table="users" data-field="x_passportExpiry" data-page="3" data-format="7" name="x_passportExpiry" id="x_passportExpiry" placeholder="<?php echo ew_HtmlEncode($users->passportExpiry->getPlaceHolder()) ?>" value="<?php echo $users->passportExpiry->EditValue ?>"<?php echo $users->passportExpiry->EditAttributes() ?>>
<?php if (!$users->passportExpiry->ReadOnly && !$users->passportExpiry->Disabled && !isset($users->passportExpiry->EditAttrs["readonly"]) && !isset($users->passportExpiry->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("fusersedit", "x_passportExpiry", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php echo $users->passportExpiry->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->passportPlaceOfIssue->Visible) { // passportPlaceOfIssue ?>
	<div id="r_passportPlaceOfIssue" class="form-group">
		<label id="elh_users_passportPlaceOfIssue" for="x_passportPlaceOfIssue" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->passportPlaceOfIssue->FldCaption() ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->passportPlaceOfIssue->CellAttributes() ?>>
<span id="el_users_passportPlaceOfIssue">
<input type="text" data-table="users" data-field="x_passportPlaceOfIssue" data-page="3" name="x_passportPlaceOfIssue" id="x_passportPlaceOfIssue" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($users->passportPlaceOfIssue->getPlaceHolder()) ?>" value="<?php echo $users->passportPlaceOfIssue->EditValue ?>"<?php echo $users->passportPlaceOfIssue->EditAttributes() ?>>
</span>
<?php echo $users->passportPlaceOfIssue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->passportAttachment->Visible) { // passportAttachment ?>
	<div id="r_passportAttachment" class="form-group">
		<label id="elh_users_passportAttachment" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->passportAttachment->FldCaption() ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->passportAttachment->CellAttributes() ?>>
<span id="el_users_passportAttachment">
<div id="fd_x_passportAttachment">
<span title="<?php echo $users->passportAttachment->FldTitle() ? $users->passportAttachment->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($users->passportAttachment->ReadOnly || $users->passportAttachment->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="users" data-field="x_passportAttachment" data-page="3" name="x_passportAttachment" id="x_passportAttachment"<?php echo $users->passportAttachment->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_passportAttachment" id= "fn_x_passportAttachment" value="<?php echo $users->passportAttachment->Upload->FileName ?>">
<?php if (@$_POST["fa_x_passportAttachment"] == "0") { ?>
<input type="hidden" name="fa_x_passportAttachment" id= "fa_x_passportAttachment" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_passportAttachment" id= "fa_x_passportAttachment" value="1">
<?php } ?>
<input type="hidden" name="fs_x_passportAttachment" id= "fs_x_passportAttachment" value="255">
<input type="hidden" name="fx_x_passportAttachment" id= "fx_x_passportAttachment" value="<?php echo $users->passportAttachment->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_passportAttachment" id= "fm_x_passportAttachment" value="<?php echo $users->passportAttachment->UploadMaxFileSize ?>">
</div>
<table id="ft_x_passportAttachment" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $users->passportAttachment->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page .nav-tabs-custom .tab-content -->
</div><!-- /multi-page .nav-tabs-custom -->
</div><!-- /multi-page -->
<?php if (!$users_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $users_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $users_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fusersedit.Init();
</script>
<?php
$users_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$users_edit->Page_Terminate();
?>
