<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "home_appsinfo.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$home_apps_add = NULL; // Initialize page object first

class chome_apps_add extends chome_apps {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'home_apps';

	// Page object name
	var $PageObjName = 'home_apps_add';

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

		// Table object (home_apps)
		if (!isset($GLOBALS["home_apps"]) || get_class($GLOBALS["home_apps"]) == "chome_apps") {
			$GLOBALS["home_apps"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["home_apps"];
		}

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'home_apps', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("home_appslist.php"));
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
		$this->title->SetVisibility();
		$this->subTitle->SetVisibility();
		$this->buttonIcon1->SetVisibility();
		$this->buttonLinkLabel1->SetVisibility();
		$this->buttonLink1->SetVisibility();
		$this->buttonIcon2->SetVisibility();
		$this->buttonLinkLabel2->SetVisibility();
		$this->buttonLink2->SetVisibility();
		$this->image->SetVisibility();
		$this->backgroundImage->SetVisibility();

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
		global $EW_EXPORT, $home_apps;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($home_apps);
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
					if ($pageName == "home_appsview.php")
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
			if (@$_GET["appsID"] != "") {
				$this->appsID->setQueryStringValue($_GET["appsID"]);
				$this->setKey("appsID", $this->appsID->CurrentValue); // Set up key
			} else {
				$this->setKey("appsID", ""); // Clear key
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
					$this->Page_Terminate("home_appslist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "home_appslist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "home_appsview.php")
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
		$this->buttonIcon1->Upload->Index = $objForm->Index;
		$this->buttonIcon1->Upload->UploadFile();
		$this->buttonIcon1->CurrentValue = $this->buttonIcon1->Upload->FileName;
		$this->buttonIcon2->Upload->Index = $objForm->Index;
		$this->buttonIcon2->Upload->UploadFile();
		$this->buttonIcon2->CurrentValue = $this->buttonIcon2->Upload->FileName;
		$this->image->Upload->Index = $objForm->Index;
		$this->image->Upload->UploadFile();
		$this->image->CurrentValue = $this->image->Upload->FileName;
		$this->backgroundImage->Upload->Index = $objForm->Index;
		$this->backgroundImage->Upload->UploadFile();
		$this->backgroundImage->CurrentValue = $this->backgroundImage->Upload->FileName;
	}

	// Load default values
	function LoadDefaultValues() {
		$this->appsID->CurrentValue = NULL;
		$this->appsID->OldValue = $this->appsID->CurrentValue;
		$this->title->CurrentValue = NULL;
		$this->title->OldValue = $this->title->CurrentValue;
		$this->subTitle->CurrentValue = NULL;
		$this->subTitle->OldValue = $this->subTitle->CurrentValue;
		$this->buttonIcon1->Upload->DbValue = NULL;
		$this->buttonIcon1->OldValue = $this->buttonIcon1->Upload->DbValue;
		$this->buttonIcon1->CurrentValue = NULL; // Clear file related field
		$this->buttonLinkLabel1->CurrentValue = NULL;
		$this->buttonLinkLabel1->OldValue = $this->buttonLinkLabel1->CurrentValue;
		$this->buttonLink1->CurrentValue = NULL;
		$this->buttonLink1->OldValue = $this->buttonLink1->CurrentValue;
		$this->buttonIcon2->Upload->DbValue = NULL;
		$this->buttonIcon2->OldValue = $this->buttonIcon2->Upload->DbValue;
		$this->buttonIcon2->CurrentValue = NULL; // Clear file related field
		$this->buttonLinkLabel2->CurrentValue = NULL;
		$this->buttonLinkLabel2->OldValue = $this->buttonLinkLabel2->CurrentValue;
		$this->buttonLink2->CurrentValue = NULL;
		$this->buttonLink2->OldValue = $this->buttonLink2->CurrentValue;
		$this->image->Upload->DbValue = NULL;
		$this->image->OldValue = $this->image->Upload->DbValue;
		$this->image->CurrentValue = NULL; // Clear file related field
		$this->backgroundImage->Upload->DbValue = NULL;
		$this->backgroundImage->OldValue = $this->backgroundImage->Upload->DbValue;
		$this->backgroundImage->CurrentValue = NULL; // Clear file related field
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->title->FldIsDetailKey) {
			$this->title->setFormValue($objForm->GetValue("x_title"));
		}
		if (!$this->subTitle->FldIsDetailKey) {
			$this->subTitle->setFormValue($objForm->GetValue("x_subTitle"));
		}
		if (!$this->buttonLinkLabel1->FldIsDetailKey) {
			$this->buttonLinkLabel1->setFormValue($objForm->GetValue("x_buttonLinkLabel1"));
		}
		if (!$this->buttonLink1->FldIsDetailKey) {
			$this->buttonLink1->setFormValue($objForm->GetValue("x_buttonLink1"));
		}
		if (!$this->buttonLinkLabel2->FldIsDetailKey) {
			$this->buttonLinkLabel2->setFormValue($objForm->GetValue("x_buttonLinkLabel2"));
		}
		if (!$this->buttonLink2->FldIsDetailKey) {
			$this->buttonLink2->setFormValue($objForm->GetValue("x_buttonLink2"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->title->CurrentValue = $this->title->FormValue;
		$this->subTitle->CurrentValue = $this->subTitle->FormValue;
		$this->buttonLinkLabel1->CurrentValue = $this->buttonLinkLabel1->FormValue;
		$this->buttonLink1->CurrentValue = $this->buttonLink1->FormValue;
		$this->buttonLinkLabel2->CurrentValue = $this->buttonLinkLabel2->FormValue;
		$this->buttonLink2->CurrentValue = $this->buttonLink2->FormValue;
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
		$this->appsID->setDbValue($row['appsID']);
		$this->title->setDbValue($row['title']);
		$this->subTitle->setDbValue($row['subTitle']);
		$this->buttonIcon1->Upload->DbValue = $row['buttonIcon1'];
		$this->buttonIcon1->setDbValue($this->buttonIcon1->Upload->DbValue);
		$this->buttonLinkLabel1->setDbValue($row['buttonLinkLabel1']);
		$this->buttonLink1->setDbValue($row['buttonLink1']);
		$this->buttonIcon2->Upload->DbValue = $row['buttonIcon2'];
		$this->buttonIcon2->setDbValue($this->buttonIcon2->Upload->DbValue);
		$this->buttonLinkLabel2->setDbValue($row['buttonLinkLabel2']);
		$this->buttonLink2->setDbValue($row['buttonLink2']);
		$this->image->Upload->DbValue = $row['image'];
		$this->image->setDbValue($this->image->Upload->DbValue);
		$this->backgroundImage->Upload->DbValue = $row['backgroundImage'];
		$this->backgroundImage->setDbValue($this->backgroundImage->Upload->DbValue);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['appsID'] = $this->appsID->CurrentValue;
		$row['title'] = $this->title->CurrentValue;
		$row['subTitle'] = $this->subTitle->CurrentValue;
		$row['buttonIcon1'] = $this->buttonIcon1->Upload->DbValue;
		$row['buttonLinkLabel1'] = $this->buttonLinkLabel1->CurrentValue;
		$row['buttonLink1'] = $this->buttonLink1->CurrentValue;
		$row['buttonIcon2'] = $this->buttonIcon2->Upload->DbValue;
		$row['buttonLinkLabel2'] = $this->buttonLinkLabel2->CurrentValue;
		$row['buttonLink2'] = $this->buttonLink2->CurrentValue;
		$row['image'] = $this->image->Upload->DbValue;
		$row['backgroundImage'] = $this->backgroundImage->Upload->DbValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->appsID->DbValue = $row['appsID'];
		$this->title->DbValue = $row['title'];
		$this->subTitle->DbValue = $row['subTitle'];
		$this->buttonIcon1->Upload->DbValue = $row['buttonIcon1'];
		$this->buttonLinkLabel1->DbValue = $row['buttonLinkLabel1'];
		$this->buttonLink1->DbValue = $row['buttonLink1'];
		$this->buttonIcon2->Upload->DbValue = $row['buttonIcon2'];
		$this->buttonLinkLabel2->DbValue = $row['buttonLinkLabel2'];
		$this->buttonLink2->DbValue = $row['buttonLink2'];
		$this->image->Upload->DbValue = $row['image'];
		$this->backgroundImage->Upload->DbValue = $row['backgroundImage'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("appsID")) <> "")
			$this->appsID->CurrentValue = $this->getKey("appsID"); // appsID
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
		// appsID
		// title
		// subTitle
		// buttonIcon1
		// buttonLinkLabel1
		// buttonLink1
		// buttonIcon2
		// buttonLinkLabel2
		// buttonLink2
		// image
		// backgroundImage

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// appsID
		$this->appsID->ViewValue = $this->appsID->CurrentValue;
		$this->appsID->ViewCustomAttributes = "";

		// title
		$this->title->ViewValue = $this->title->CurrentValue;
		$this->title->ViewCustomAttributes = "";

		// subTitle
		$this->subTitle->ViewValue = $this->subTitle->CurrentValue;
		$this->subTitle->ViewCustomAttributes = "";

		// buttonIcon1
		$this->buttonIcon1->UploadPath = 'uploads/pages';
		if (!ew_Empty($this->buttonIcon1->Upload->DbValue)) {
			$this->buttonIcon1->ImageWidth = 50;
			$this->buttonIcon1->ImageHeight = 0;
			$this->buttonIcon1->ImageAlt = $this->buttonIcon1->FldAlt();
			$this->buttonIcon1->ViewValue = $this->buttonIcon1->Upload->DbValue;
		} else {
			$this->buttonIcon1->ViewValue = "";
		}
		$this->buttonIcon1->ViewCustomAttributes = "";

		// buttonLinkLabel1
		$this->buttonLinkLabel1->ViewValue = $this->buttonLinkLabel1->CurrentValue;
		$this->buttonLinkLabel1->ViewCustomAttributes = "";

		// buttonLink1
		$this->buttonLink1->ViewValue = $this->buttonLink1->CurrentValue;
		$this->buttonLink1->ViewCustomAttributes = "";

		// buttonIcon2
		$this->buttonIcon2->UploadPath = 'uploads/pages';
		if (!ew_Empty($this->buttonIcon2->Upload->DbValue)) {
			$this->buttonIcon2->ImageWidth = 50;
			$this->buttonIcon2->ImageHeight = 0;
			$this->buttonIcon2->ImageAlt = $this->buttonIcon2->FldAlt();
			$this->buttonIcon2->ViewValue = $this->buttonIcon2->Upload->DbValue;
		} else {
			$this->buttonIcon2->ViewValue = "";
		}
		$this->buttonIcon2->ViewCustomAttributes = "";

		// buttonLinkLabel2
		$this->buttonLinkLabel2->ViewValue = $this->buttonLinkLabel2->CurrentValue;
		$this->buttonLinkLabel2->ViewCustomAttributes = "";

		// buttonLink2
		$this->buttonLink2->ViewValue = $this->buttonLink2->CurrentValue;
		$this->buttonLink2->ViewCustomAttributes = "";

		// image
		$this->image->UploadPath = 'uploads/pages';
		if (!ew_Empty($this->image->Upload->DbValue)) {
			$this->image->ImageWidth = 100;
			$this->image->ImageHeight = 0;
			$this->image->ImageAlt = $this->image->FldAlt();
			$this->image->ViewValue = $this->image->Upload->DbValue;
		} else {
			$this->image->ViewValue = "";
		}
		$this->image->ViewCustomAttributes = "";

		// backgroundImage
		$this->backgroundImage->UploadPath = 'uploads/pages';
		if (!ew_Empty($this->backgroundImage->Upload->DbValue)) {
			$this->backgroundImage->ImageWidth = 100;
			$this->backgroundImage->ImageHeight = 0;
			$this->backgroundImage->ImageAlt = $this->backgroundImage->FldAlt();
			$this->backgroundImage->ViewValue = $this->backgroundImage->Upload->DbValue;
		} else {
			$this->backgroundImage->ViewValue = "";
		}
		$this->backgroundImage->ViewCustomAttributes = "";

			// title
			$this->title->LinkCustomAttributes = "";
			$this->title->HrefValue = "";
			$this->title->TooltipValue = "";

			// subTitle
			$this->subTitle->LinkCustomAttributes = "";
			$this->subTitle->HrefValue = "";
			$this->subTitle->TooltipValue = "";

			// buttonIcon1
			$this->buttonIcon1->LinkCustomAttributes = "";
			$this->buttonIcon1->UploadPath = 'uploads/pages';
			if (!ew_Empty($this->buttonIcon1->Upload->DbValue)) {
				$this->buttonIcon1->HrefValue = ew_GetFileUploadUrl($this->buttonIcon1, $this->buttonIcon1->Upload->DbValue); // Add prefix/suffix
				$this->buttonIcon1->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->buttonIcon1->HrefValue = ew_FullUrl($this->buttonIcon1->HrefValue, "href");
			} else {
				$this->buttonIcon1->HrefValue = "";
			}
			$this->buttonIcon1->HrefValue2 = $this->buttonIcon1->UploadPath . $this->buttonIcon1->Upload->DbValue;
			$this->buttonIcon1->TooltipValue = "";
			if ($this->buttonIcon1->UseColorbox) {
				if (ew_Empty($this->buttonIcon1->TooltipValue))
					$this->buttonIcon1->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->buttonIcon1->LinkAttrs["data-rel"] = "home_apps_x_buttonIcon1";
				ew_AppendClass($this->buttonIcon1->LinkAttrs["class"], "ewLightbox");
			}

			// buttonLinkLabel1
			$this->buttonLinkLabel1->LinkCustomAttributes = "";
			$this->buttonLinkLabel1->HrefValue = "";
			$this->buttonLinkLabel1->TooltipValue = "";

			// buttonLink1
			$this->buttonLink1->LinkCustomAttributes = "";
			$this->buttonLink1->HrefValue = "";
			$this->buttonLink1->TooltipValue = "";

			// buttonIcon2
			$this->buttonIcon2->LinkCustomAttributes = "";
			$this->buttonIcon2->UploadPath = 'uploads/pages';
			if (!ew_Empty($this->buttonIcon2->Upload->DbValue)) {
				$this->buttonIcon2->HrefValue = ew_GetFileUploadUrl($this->buttonIcon2, $this->buttonIcon2->Upload->DbValue); // Add prefix/suffix
				$this->buttonIcon2->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->buttonIcon2->HrefValue = ew_FullUrl($this->buttonIcon2->HrefValue, "href");
			} else {
				$this->buttonIcon2->HrefValue = "";
			}
			$this->buttonIcon2->HrefValue2 = $this->buttonIcon2->UploadPath . $this->buttonIcon2->Upload->DbValue;
			$this->buttonIcon2->TooltipValue = "";
			if ($this->buttonIcon2->UseColorbox) {
				if (ew_Empty($this->buttonIcon2->TooltipValue))
					$this->buttonIcon2->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->buttonIcon2->LinkAttrs["data-rel"] = "home_apps_x_buttonIcon2";
				ew_AppendClass($this->buttonIcon2->LinkAttrs["class"], "ewLightbox");
			}

			// buttonLinkLabel2
			$this->buttonLinkLabel2->LinkCustomAttributes = "";
			$this->buttonLinkLabel2->HrefValue = "";
			$this->buttonLinkLabel2->TooltipValue = "";

			// buttonLink2
			$this->buttonLink2->LinkCustomAttributes = "";
			$this->buttonLink2->HrefValue = "";
			$this->buttonLink2->TooltipValue = "";

			// image
			$this->image->LinkCustomAttributes = "";
			$this->image->UploadPath = 'uploads/pages';
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
				$this->image->LinkAttrs["data-rel"] = "home_apps_x_image";
				ew_AppendClass($this->image->LinkAttrs["class"], "ewLightbox");
			}

			// backgroundImage
			$this->backgroundImage->LinkCustomAttributes = "";
			$this->backgroundImage->UploadPath = 'uploads/pages';
			if (!ew_Empty($this->backgroundImage->Upload->DbValue)) {
				$this->backgroundImage->HrefValue = ew_GetFileUploadUrl($this->backgroundImage, $this->backgroundImage->Upload->DbValue); // Add prefix/suffix
				$this->backgroundImage->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->backgroundImage->HrefValue = ew_FullUrl($this->backgroundImage->HrefValue, "href");
			} else {
				$this->backgroundImage->HrefValue = "";
			}
			$this->backgroundImage->HrefValue2 = $this->backgroundImage->UploadPath . $this->backgroundImage->Upload->DbValue;
			$this->backgroundImage->TooltipValue = "";
			if ($this->backgroundImage->UseColorbox) {
				if (ew_Empty($this->backgroundImage->TooltipValue))
					$this->backgroundImage->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->backgroundImage->LinkAttrs["data-rel"] = "home_apps_x_backgroundImage";
				ew_AppendClass($this->backgroundImage->LinkAttrs["class"], "ewLightbox");
			}
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// title
			$this->title->EditAttrs["class"] = "form-control";
			$this->title->EditCustomAttributes = "";
			$this->title->EditValue = ew_HtmlEncode($this->title->CurrentValue);
			$this->title->PlaceHolder = ew_RemoveHtml($this->title->FldCaption());

			// subTitle
			$this->subTitle->EditAttrs["class"] = "form-control";
			$this->subTitle->EditCustomAttributes = "";
			$this->subTitle->EditValue = ew_HtmlEncode($this->subTitle->CurrentValue);
			$this->subTitle->PlaceHolder = ew_RemoveHtml($this->subTitle->FldCaption());

			// buttonIcon1
			$this->buttonIcon1->EditAttrs["class"] = "form-control";
			$this->buttonIcon1->EditCustomAttributes = "";
			$this->buttonIcon1->UploadPath = 'uploads/pages';
			if (!ew_Empty($this->buttonIcon1->Upload->DbValue)) {
				$this->buttonIcon1->ImageWidth = 50;
				$this->buttonIcon1->ImageHeight = 0;
				$this->buttonIcon1->ImageAlt = $this->buttonIcon1->FldAlt();
				$this->buttonIcon1->EditValue = $this->buttonIcon1->Upload->DbValue;
			} else {
				$this->buttonIcon1->EditValue = "";
			}
			if (!ew_Empty($this->buttonIcon1->CurrentValue))
					$this->buttonIcon1->Upload->FileName = $this->buttonIcon1->CurrentValue;
			if (($this->CurrentAction == "I" || $this->CurrentAction == "C") && !$this->EventCancelled) ew_RenderUploadField($this->buttonIcon1);

			// buttonLinkLabel1
			$this->buttonLinkLabel1->EditAttrs["class"] = "form-control";
			$this->buttonLinkLabel1->EditCustomAttributes = "";
			$this->buttonLinkLabel1->EditValue = ew_HtmlEncode($this->buttonLinkLabel1->CurrentValue);
			$this->buttonLinkLabel1->PlaceHolder = ew_RemoveHtml($this->buttonLinkLabel1->FldCaption());

			// buttonLink1
			$this->buttonLink1->EditAttrs["class"] = "form-control";
			$this->buttonLink1->EditCustomAttributes = "";
			$this->buttonLink1->EditValue = ew_HtmlEncode($this->buttonLink1->CurrentValue);
			$this->buttonLink1->PlaceHolder = ew_RemoveHtml($this->buttonLink1->FldCaption());

			// buttonIcon2
			$this->buttonIcon2->EditAttrs["class"] = "form-control";
			$this->buttonIcon2->EditCustomAttributes = "";
			$this->buttonIcon2->UploadPath = 'uploads/pages';
			if (!ew_Empty($this->buttonIcon2->Upload->DbValue)) {
				$this->buttonIcon2->ImageWidth = 50;
				$this->buttonIcon2->ImageHeight = 0;
				$this->buttonIcon2->ImageAlt = $this->buttonIcon2->FldAlt();
				$this->buttonIcon2->EditValue = $this->buttonIcon2->Upload->DbValue;
			} else {
				$this->buttonIcon2->EditValue = "";
			}
			if (!ew_Empty($this->buttonIcon2->CurrentValue))
					$this->buttonIcon2->Upload->FileName = $this->buttonIcon2->CurrentValue;
			if (($this->CurrentAction == "I" || $this->CurrentAction == "C") && !$this->EventCancelled) ew_RenderUploadField($this->buttonIcon2);

			// buttonLinkLabel2
			$this->buttonLinkLabel2->EditAttrs["class"] = "form-control";
			$this->buttonLinkLabel2->EditCustomAttributes = "";
			$this->buttonLinkLabel2->EditValue = ew_HtmlEncode($this->buttonLinkLabel2->CurrentValue);
			$this->buttonLinkLabel2->PlaceHolder = ew_RemoveHtml($this->buttonLinkLabel2->FldCaption());

			// buttonLink2
			$this->buttonLink2->EditAttrs["class"] = "form-control";
			$this->buttonLink2->EditCustomAttributes = "";
			$this->buttonLink2->EditValue = ew_HtmlEncode($this->buttonLink2->CurrentValue);
			$this->buttonLink2->PlaceHolder = ew_RemoveHtml($this->buttonLink2->FldCaption());

			// image
			$this->image->EditAttrs["class"] = "form-control";
			$this->image->EditCustomAttributes = "";
			$this->image->UploadPath = 'uploads/pages';
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

			// backgroundImage
			$this->backgroundImage->EditAttrs["class"] = "form-control";
			$this->backgroundImage->EditCustomAttributes = "";
			$this->backgroundImage->UploadPath = 'uploads/pages';
			if (!ew_Empty($this->backgroundImage->Upload->DbValue)) {
				$this->backgroundImage->ImageWidth = 100;
				$this->backgroundImage->ImageHeight = 0;
				$this->backgroundImage->ImageAlt = $this->backgroundImage->FldAlt();
				$this->backgroundImage->EditValue = $this->backgroundImage->Upload->DbValue;
			} else {
				$this->backgroundImage->EditValue = "";
			}
			if (!ew_Empty($this->backgroundImage->CurrentValue))
					$this->backgroundImage->Upload->FileName = $this->backgroundImage->CurrentValue;
			if (($this->CurrentAction == "I" || $this->CurrentAction == "C") && !$this->EventCancelled) ew_RenderUploadField($this->backgroundImage);

			// Add refer script
			// title

			$this->title->LinkCustomAttributes = "";
			$this->title->HrefValue = "";

			// subTitle
			$this->subTitle->LinkCustomAttributes = "";
			$this->subTitle->HrefValue = "";

			// buttonIcon1
			$this->buttonIcon1->LinkCustomAttributes = "";
			$this->buttonIcon1->UploadPath = 'uploads/pages';
			if (!ew_Empty($this->buttonIcon1->Upload->DbValue)) {
				$this->buttonIcon1->HrefValue = ew_GetFileUploadUrl($this->buttonIcon1, $this->buttonIcon1->Upload->DbValue); // Add prefix/suffix
				$this->buttonIcon1->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->buttonIcon1->HrefValue = ew_FullUrl($this->buttonIcon1->HrefValue, "href");
			} else {
				$this->buttonIcon1->HrefValue = "";
			}
			$this->buttonIcon1->HrefValue2 = $this->buttonIcon1->UploadPath . $this->buttonIcon1->Upload->DbValue;

			// buttonLinkLabel1
			$this->buttonLinkLabel1->LinkCustomAttributes = "";
			$this->buttonLinkLabel1->HrefValue = "";

			// buttonLink1
			$this->buttonLink1->LinkCustomAttributes = "";
			$this->buttonLink1->HrefValue = "";

			// buttonIcon2
			$this->buttonIcon2->LinkCustomAttributes = "";
			$this->buttonIcon2->UploadPath = 'uploads/pages';
			if (!ew_Empty($this->buttonIcon2->Upload->DbValue)) {
				$this->buttonIcon2->HrefValue = ew_GetFileUploadUrl($this->buttonIcon2, $this->buttonIcon2->Upload->DbValue); // Add prefix/suffix
				$this->buttonIcon2->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->buttonIcon2->HrefValue = ew_FullUrl($this->buttonIcon2->HrefValue, "href");
			} else {
				$this->buttonIcon2->HrefValue = "";
			}
			$this->buttonIcon2->HrefValue2 = $this->buttonIcon2->UploadPath . $this->buttonIcon2->Upload->DbValue;

			// buttonLinkLabel2
			$this->buttonLinkLabel2->LinkCustomAttributes = "";
			$this->buttonLinkLabel2->HrefValue = "";

			// buttonLink2
			$this->buttonLink2->LinkCustomAttributes = "";
			$this->buttonLink2->HrefValue = "";

			// image
			$this->image->LinkCustomAttributes = "";
			$this->image->UploadPath = 'uploads/pages';
			if (!ew_Empty($this->image->Upload->DbValue)) {
				$this->image->HrefValue = ew_GetFileUploadUrl($this->image, $this->image->Upload->DbValue); // Add prefix/suffix
				$this->image->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->image->HrefValue = ew_FullUrl($this->image->HrefValue, "href");
			} else {
				$this->image->HrefValue = "";
			}
			$this->image->HrefValue2 = $this->image->UploadPath . $this->image->Upload->DbValue;

			// backgroundImage
			$this->backgroundImage->LinkCustomAttributes = "";
			$this->backgroundImage->UploadPath = 'uploads/pages';
			if (!ew_Empty($this->backgroundImage->Upload->DbValue)) {
				$this->backgroundImage->HrefValue = ew_GetFileUploadUrl($this->backgroundImage, $this->backgroundImage->Upload->DbValue); // Add prefix/suffix
				$this->backgroundImage->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->backgroundImage->HrefValue = ew_FullUrl($this->backgroundImage->HrefValue, "href");
			} else {
				$this->backgroundImage->HrefValue = "";
			}
			$this->backgroundImage->HrefValue2 = $this->backgroundImage->UploadPath . $this->backgroundImage->Upload->DbValue;
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
			$this->buttonIcon1->OldUploadPath = 'uploads/pages';
			$this->buttonIcon1->UploadPath = $this->buttonIcon1->OldUploadPath;
			$this->buttonIcon2->OldUploadPath = 'uploads/pages';
			$this->buttonIcon2->UploadPath = $this->buttonIcon2->OldUploadPath;
			$this->image->OldUploadPath = 'uploads/pages';
			$this->image->UploadPath = $this->image->OldUploadPath;
			$this->backgroundImage->OldUploadPath = 'uploads/pages';
			$this->backgroundImage->UploadPath = $this->backgroundImage->OldUploadPath;
		}
		$rsnew = array();

		// title
		$this->title->SetDbValueDef($rsnew, $this->title->CurrentValue, NULL, FALSE);

		// subTitle
		$this->subTitle->SetDbValueDef($rsnew, $this->subTitle->CurrentValue, NULL, FALSE);

		// buttonIcon1
		if ($this->buttonIcon1->Visible && !$this->buttonIcon1->Upload->KeepFile) {
			$this->buttonIcon1->Upload->DbValue = ""; // No need to delete old file
			if ($this->buttonIcon1->Upload->FileName == "") {
				$rsnew['buttonIcon1'] = NULL;
			} else {
				$rsnew['buttonIcon1'] = $this->buttonIcon1->Upload->FileName;
			}
		}

		// buttonLinkLabel1
		$this->buttonLinkLabel1->SetDbValueDef($rsnew, $this->buttonLinkLabel1->CurrentValue, NULL, FALSE);

		// buttonLink1
		$this->buttonLink1->SetDbValueDef($rsnew, $this->buttonLink1->CurrentValue, NULL, FALSE);

		// buttonIcon2
		if ($this->buttonIcon2->Visible && !$this->buttonIcon2->Upload->KeepFile) {
			$this->buttonIcon2->Upload->DbValue = ""; // No need to delete old file
			if ($this->buttonIcon2->Upload->FileName == "") {
				$rsnew['buttonIcon2'] = NULL;
			} else {
				$rsnew['buttonIcon2'] = $this->buttonIcon2->Upload->FileName;
			}
		}

		// buttonLinkLabel2
		$this->buttonLinkLabel2->SetDbValueDef($rsnew, $this->buttonLinkLabel2->CurrentValue, NULL, FALSE);

		// buttonLink2
		$this->buttonLink2->SetDbValueDef($rsnew, $this->buttonLink2->CurrentValue, NULL, FALSE);

		// image
		if ($this->image->Visible && !$this->image->Upload->KeepFile) {
			$this->image->Upload->DbValue = ""; // No need to delete old file
			if ($this->image->Upload->FileName == "") {
				$rsnew['image'] = NULL;
			} else {
				$rsnew['image'] = $this->image->Upload->FileName;
			}
		}

		// backgroundImage
		if ($this->backgroundImage->Visible && !$this->backgroundImage->Upload->KeepFile) {
			$this->backgroundImage->Upload->DbValue = ""; // No need to delete old file
			if ($this->backgroundImage->Upload->FileName == "") {
				$rsnew['backgroundImage'] = NULL;
			} else {
				$rsnew['backgroundImage'] = $this->backgroundImage->Upload->FileName;
			}
		}
		if ($this->buttonIcon1->Visible && !$this->buttonIcon1->Upload->KeepFile) {
			$this->buttonIcon1->UploadPath = 'uploads/pages';
			$OldFiles = ew_Empty($this->buttonIcon1->Upload->DbValue) ? array() : array($this->buttonIcon1->Upload->DbValue);
			if (!ew_Empty($this->buttonIcon1->Upload->FileName)) {
				$NewFiles = array($this->buttonIcon1->Upload->FileName);
				$NewFileCount = count($NewFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					$fldvar = ($this->buttonIcon1->Upload->Index < 0) ? $this->buttonIcon1->FldVar : substr($this->buttonIcon1->FldVar, 0, 1) . $this->buttonIcon1->Upload->Index . substr($this->buttonIcon1->FldVar, 1);
					if ($NewFiles[$i] <> "") {
						$file = $NewFiles[$i];
						if (file_exists(ew_UploadTempPath($fldvar, $this->buttonIcon1->TblVar) . $file)) {
							$file1 = ew_UploadFileNameEx($this->buttonIcon1->PhysicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(ew_UploadTempPath($fldvar, $this->buttonIcon1->TblVar) . $file1) || file_exists($this->buttonIcon1->PhysicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = ew_UniqueFilename($this->buttonIcon1->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(ew_UploadTempPath($fldvar, $this->buttonIcon1->TblVar) . $file, ew_UploadTempPath($fldvar, $this->buttonIcon1->TblVar) . $file1);
								$NewFiles[$i] = $file1;
							}
						}
					}
				}
				$this->buttonIcon1->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
				$this->buttonIcon1->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
				$this->buttonIcon1->SetDbValueDef($rsnew, $this->buttonIcon1->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->buttonIcon2->Visible && !$this->buttonIcon2->Upload->KeepFile) {
			$this->buttonIcon2->UploadPath = 'uploads/pages';
			$OldFiles = ew_Empty($this->buttonIcon2->Upload->DbValue) ? array() : array($this->buttonIcon2->Upload->DbValue);
			if (!ew_Empty($this->buttonIcon2->Upload->FileName)) {
				$NewFiles = array($this->buttonIcon2->Upload->FileName);
				$NewFileCount = count($NewFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					$fldvar = ($this->buttonIcon2->Upload->Index < 0) ? $this->buttonIcon2->FldVar : substr($this->buttonIcon2->FldVar, 0, 1) . $this->buttonIcon2->Upload->Index . substr($this->buttonIcon2->FldVar, 1);
					if ($NewFiles[$i] <> "") {
						$file = $NewFiles[$i];
						if (file_exists(ew_UploadTempPath($fldvar, $this->buttonIcon2->TblVar) . $file)) {
							$file1 = ew_UploadFileNameEx($this->buttonIcon2->PhysicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(ew_UploadTempPath($fldvar, $this->buttonIcon2->TblVar) . $file1) || file_exists($this->buttonIcon2->PhysicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = ew_UniqueFilename($this->buttonIcon2->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(ew_UploadTempPath($fldvar, $this->buttonIcon2->TblVar) . $file, ew_UploadTempPath($fldvar, $this->buttonIcon2->TblVar) . $file1);
								$NewFiles[$i] = $file1;
							}
						}
					}
				}
				$this->buttonIcon2->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
				$this->buttonIcon2->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
				$this->buttonIcon2->SetDbValueDef($rsnew, $this->buttonIcon2->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->image->Visible && !$this->image->Upload->KeepFile) {
			$this->image->UploadPath = 'uploads/pages';
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
		if ($this->backgroundImage->Visible && !$this->backgroundImage->Upload->KeepFile) {
			$this->backgroundImage->UploadPath = 'uploads/pages';
			$OldFiles = ew_Empty($this->backgroundImage->Upload->DbValue) ? array() : array($this->backgroundImage->Upload->DbValue);
			if (!ew_Empty($this->backgroundImage->Upload->FileName)) {
				$NewFiles = array($this->backgroundImage->Upload->FileName);
				$NewFileCount = count($NewFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					$fldvar = ($this->backgroundImage->Upload->Index < 0) ? $this->backgroundImage->FldVar : substr($this->backgroundImage->FldVar, 0, 1) . $this->backgroundImage->Upload->Index . substr($this->backgroundImage->FldVar, 1);
					if ($NewFiles[$i] <> "") {
						$file = $NewFiles[$i];
						if (file_exists(ew_UploadTempPath($fldvar, $this->backgroundImage->TblVar) . $file)) {
							$file1 = ew_UploadFileNameEx($this->backgroundImage->PhysicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(ew_UploadTempPath($fldvar, $this->backgroundImage->TblVar) . $file1) || file_exists($this->backgroundImage->PhysicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = ew_UniqueFilename($this->backgroundImage->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(ew_UploadTempPath($fldvar, $this->backgroundImage->TblVar) . $file, ew_UploadTempPath($fldvar, $this->backgroundImage->TblVar) . $file1);
								$NewFiles[$i] = $file1;
							}
						}
					}
				}
				$this->backgroundImage->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
				$this->backgroundImage->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
				$this->backgroundImage->SetDbValueDef($rsnew, $this->backgroundImage->Upload->FileName, NULL, FALSE);
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
				if ($this->buttonIcon1->Visible && !$this->buttonIcon1->Upload->KeepFile) {
					$OldFiles = ew_Empty($this->buttonIcon1->Upload->DbValue) ? array() : array($this->buttonIcon1->Upload->DbValue);
					if (!ew_Empty($this->buttonIcon1->Upload->FileName)) {
						$NewFiles = array($this->buttonIcon1->Upload->FileName);
						$NewFiles2 = array($rsnew['buttonIcon1']);
						$NewFileCount = count($NewFiles);
						for ($i = 0; $i < $NewFileCount; $i++) {
							$fldvar = ($this->buttonIcon1->Upload->Index < 0) ? $this->buttonIcon1->FldVar : substr($this->buttonIcon1->FldVar, 0, 1) . $this->buttonIcon1->Upload->Index . substr($this->buttonIcon1->FldVar, 1);
							if ($NewFiles[$i] <> "") {
								$file = ew_UploadTempPath($fldvar, $this->buttonIcon1->TblVar) . $NewFiles[$i];
								if (file_exists($file)) {
									if (@$NewFiles2[$i] <> "") // Use correct file name
										$NewFiles[$i] = $NewFiles2[$i];
									if (!$this->buttonIcon1->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
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
				if ($this->buttonIcon2->Visible && !$this->buttonIcon2->Upload->KeepFile) {
					$OldFiles = ew_Empty($this->buttonIcon2->Upload->DbValue) ? array() : array($this->buttonIcon2->Upload->DbValue);
					if (!ew_Empty($this->buttonIcon2->Upload->FileName)) {
						$NewFiles = array($this->buttonIcon2->Upload->FileName);
						$NewFiles2 = array($rsnew['buttonIcon2']);
						$NewFileCount = count($NewFiles);
						for ($i = 0; $i < $NewFileCount; $i++) {
							$fldvar = ($this->buttonIcon2->Upload->Index < 0) ? $this->buttonIcon2->FldVar : substr($this->buttonIcon2->FldVar, 0, 1) . $this->buttonIcon2->Upload->Index . substr($this->buttonIcon2->FldVar, 1);
							if ($NewFiles[$i] <> "") {
								$file = ew_UploadTempPath($fldvar, $this->buttonIcon2->TblVar) . $NewFiles[$i];
								if (file_exists($file)) {
									if (@$NewFiles2[$i] <> "") // Use correct file name
										$NewFiles[$i] = $NewFiles2[$i];
									if (!$this->buttonIcon2->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
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
				if ($this->backgroundImage->Visible && !$this->backgroundImage->Upload->KeepFile) {
					$OldFiles = ew_Empty($this->backgroundImage->Upload->DbValue) ? array() : array($this->backgroundImage->Upload->DbValue);
					if (!ew_Empty($this->backgroundImage->Upload->FileName)) {
						$NewFiles = array($this->backgroundImage->Upload->FileName);
						$NewFiles2 = array($rsnew['backgroundImage']);
						$NewFileCount = count($NewFiles);
						for ($i = 0; $i < $NewFileCount; $i++) {
							$fldvar = ($this->backgroundImage->Upload->Index < 0) ? $this->backgroundImage->FldVar : substr($this->backgroundImage->FldVar, 0, 1) . $this->backgroundImage->Upload->Index . substr($this->backgroundImage->FldVar, 1);
							if ($NewFiles[$i] <> "") {
								$file = ew_UploadTempPath($fldvar, $this->backgroundImage->TblVar) . $NewFiles[$i];
								if (file_exists($file)) {
									if (@$NewFiles2[$i] <> "") // Use correct file name
										$NewFiles[$i] = $NewFiles2[$i];
									if (!$this->backgroundImage->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
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

		// buttonIcon1
		ew_CleanUploadTempPath($this->buttonIcon1, $this->buttonIcon1->Upload->Index);

		// buttonIcon2
		ew_CleanUploadTempPath($this->buttonIcon2, $this->buttonIcon2->Upload->Index);

		// image
		ew_CleanUploadTempPath($this->image, $this->image->Upload->Index);

		// backgroundImage
		ew_CleanUploadTempPath($this->backgroundImage, $this->backgroundImage->Upload->Index);
		return $AddRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("home_appslist.php"), "", $this->TableVar, TRUE);
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
if (!isset($home_apps_add)) $home_apps_add = new chome_apps_add();

// Page init
$home_apps_add->Page_Init();

// Page main
$home_apps_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$home_apps_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = fhome_appsadd = new ew_Form("fhome_appsadd", "add");

// Validate form
fhome_appsadd.Validate = function() {
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
fhome_appsadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fhome_appsadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Multi-Page
fhome_appsadd.MultiPage = new ew_MultiPage("fhome_appsadd");

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $home_apps_add->ShowPageHeader(); ?>
<?php
$home_apps_add->ShowMessage();
?>
<form name="fhome_appsadd" id="fhome_appsadd" class="<?php echo $home_apps_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($home_apps_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $home_apps_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="home_apps">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($home_apps_add->IsModal) ?>">
<div class="ewMultiPage"><!-- multi-page -->
<div class="nav-tabs-custom" id="home_apps_add"><!-- multi-page .nav-tabs-custom -->
	<ul class="nav<?php echo $home_apps_add->MultiPages->NavStyle() ?>">
		<li<?php echo $home_apps_add->MultiPages->TabStyle("1") ?>><a href="#tab_home_apps1" data-toggle="tab"><?php echo $home_apps->PageCaption(1) ?></a></li>
		<li<?php echo $home_apps_add->MultiPages->TabStyle("2") ?>><a href="#tab_home_apps2" data-toggle="tab"><?php echo $home_apps->PageCaption(2) ?></a></li>
		<li<?php echo $home_apps_add->MultiPages->TabStyle("3") ?>><a href="#tab_home_apps3" data-toggle="tab"><?php echo $home_apps->PageCaption(3) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page .nav-tabs-custom .tab-content -->
		<div class="tab-pane<?php echo $home_apps_add->MultiPages->PageStyle("1") ?>" id="tab_home_apps1"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($home_apps->title->Visible) { // title ?>
	<div id="r_title" class="form-group">
		<label id="elh_home_apps_title" for="x_title" class="<?php echo $home_apps_add->LeftColumnClass ?>"><?php echo $home_apps->title->FldCaption() ?></label>
		<div class="<?php echo $home_apps_add->RightColumnClass ?>"><div<?php echo $home_apps->title->CellAttributes() ?>>
<span id="el_home_apps_title">
<input type="text" data-table="home_apps" data-field="x_title" data-page="1" name="x_title" id="x_title" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($home_apps->title->getPlaceHolder()) ?>" value="<?php echo $home_apps->title->EditValue ?>"<?php echo $home_apps->title->EditAttributes() ?>>
</span>
<?php echo $home_apps->title->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($home_apps->subTitle->Visible) { // subTitle ?>
	<div id="r_subTitle" class="form-group">
		<label id="elh_home_apps_subTitle" for="x_subTitle" class="<?php echo $home_apps_add->LeftColumnClass ?>"><?php echo $home_apps->subTitle->FldCaption() ?></label>
		<div class="<?php echo $home_apps_add->RightColumnClass ?>"><div<?php echo $home_apps->subTitle->CellAttributes() ?>>
<span id="el_home_apps_subTitle">
<input type="text" data-table="home_apps" data-field="x_subTitle" data-page="1" name="x_subTitle" id="x_subTitle" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($home_apps->subTitle->getPlaceHolder()) ?>" value="<?php echo $home_apps->subTitle->EditValue ?>"<?php echo $home_apps->subTitle->EditAttributes() ?>>
</span>
<?php echo $home_apps->subTitle->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($home_apps->image->Visible) { // image ?>
	<div id="r_image" class="form-group">
		<label id="elh_home_apps_image" class="<?php echo $home_apps_add->LeftColumnClass ?>"><?php echo $home_apps->image->FldCaption() ?></label>
		<div class="<?php echo $home_apps_add->RightColumnClass ?>"><div<?php echo $home_apps->image->CellAttributes() ?>>
<span id="el_home_apps_image">
<div id="fd_x_image">
<span title="<?php echo $home_apps->image->FldTitle() ? $home_apps->image->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($home_apps->image->ReadOnly || $home_apps->image->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="home_apps" data-field="x_image" data-page="1" name="x_image" id="x_image"<?php echo $home_apps->image->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_image" id= "fn_x_image" value="<?php echo $home_apps->image->Upload->FileName ?>">
<input type="hidden" name="fa_x_image" id= "fa_x_image" value="0">
<input type="hidden" name="fs_x_image" id= "fs_x_image" value="255">
<input type="hidden" name="fx_x_image" id= "fx_x_image" value="<?php echo $home_apps->image->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_image" id= "fm_x_image" value="<?php echo $home_apps->image->UploadMaxFileSize ?>">
</div>
<table id="ft_x_image" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $home_apps->image->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($home_apps->backgroundImage->Visible) { // backgroundImage ?>
	<div id="r_backgroundImage" class="form-group">
		<label id="elh_home_apps_backgroundImage" class="<?php echo $home_apps_add->LeftColumnClass ?>"><?php echo $home_apps->backgroundImage->FldCaption() ?></label>
		<div class="<?php echo $home_apps_add->RightColumnClass ?>"><div<?php echo $home_apps->backgroundImage->CellAttributes() ?>>
<span id="el_home_apps_backgroundImage">
<div id="fd_x_backgroundImage">
<span title="<?php echo $home_apps->backgroundImage->FldTitle() ? $home_apps->backgroundImage->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($home_apps->backgroundImage->ReadOnly || $home_apps->backgroundImage->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="home_apps" data-field="x_backgroundImage" data-page="1" name="x_backgroundImage" id="x_backgroundImage"<?php echo $home_apps->backgroundImage->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_backgroundImage" id= "fn_x_backgroundImage" value="<?php echo $home_apps->backgroundImage->Upload->FileName ?>">
<input type="hidden" name="fa_x_backgroundImage" id= "fa_x_backgroundImage" value="0">
<input type="hidden" name="fs_x_backgroundImage" id= "fs_x_backgroundImage" value="255">
<input type="hidden" name="fx_x_backgroundImage" id= "fx_x_backgroundImage" value="<?php echo $home_apps->backgroundImage->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_backgroundImage" id= "fm_x_backgroundImage" value="<?php echo $home_apps->backgroundImage->UploadMaxFileSize ?>">
</div>
<table id="ft_x_backgroundImage" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $home_apps->backgroundImage->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $home_apps_add->MultiPages->PageStyle("2") ?>" id="tab_home_apps2"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($home_apps->buttonIcon1->Visible) { // buttonIcon1 ?>
	<div id="r_buttonIcon1" class="form-group">
		<label id="elh_home_apps_buttonIcon1" class="<?php echo $home_apps_add->LeftColumnClass ?>"><?php echo $home_apps->buttonIcon1->FldCaption() ?></label>
		<div class="<?php echo $home_apps_add->RightColumnClass ?>"><div<?php echo $home_apps->buttonIcon1->CellAttributes() ?>>
<span id="el_home_apps_buttonIcon1">
<div id="fd_x_buttonIcon1">
<span title="<?php echo $home_apps->buttonIcon1->FldTitle() ? $home_apps->buttonIcon1->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($home_apps->buttonIcon1->ReadOnly || $home_apps->buttonIcon1->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="home_apps" data-field="x_buttonIcon1" data-page="2" name="x_buttonIcon1" id="x_buttonIcon1"<?php echo $home_apps->buttonIcon1->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_buttonIcon1" id= "fn_x_buttonIcon1" value="<?php echo $home_apps->buttonIcon1->Upload->FileName ?>">
<input type="hidden" name="fa_x_buttonIcon1" id= "fa_x_buttonIcon1" value="0">
<input type="hidden" name="fs_x_buttonIcon1" id= "fs_x_buttonIcon1" value="255">
<input type="hidden" name="fx_x_buttonIcon1" id= "fx_x_buttonIcon1" value="<?php echo $home_apps->buttonIcon1->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_buttonIcon1" id= "fm_x_buttonIcon1" value="<?php echo $home_apps->buttonIcon1->UploadMaxFileSize ?>">
</div>
<table id="ft_x_buttonIcon1" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $home_apps->buttonIcon1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($home_apps->buttonLinkLabel1->Visible) { // buttonLinkLabel1 ?>
	<div id="r_buttonLinkLabel1" class="form-group">
		<label id="elh_home_apps_buttonLinkLabel1" for="x_buttonLinkLabel1" class="<?php echo $home_apps_add->LeftColumnClass ?>"><?php echo $home_apps->buttonLinkLabel1->FldCaption() ?></label>
		<div class="<?php echo $home_apps_add->RightColumnClass ?>"><div<?php echo $home_apps->buttonLinkLabel1->CellAttributes() ?>>
<span id="el_home_apps_buttonLinkLabel1">
<input type="text" data-table="home_apps" data-field="x_buttonLinkLabel1" data-page="2" name="x_buttonLinkLabel1" id="x_buttonLinkLabel1" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($home_apps->buttonLinkLabel1->getPlaceHolder()) ?>" value="<?php echo $home_apps->buttonLinkLabel1->EditValue ?>"<?php echo $home_apps->buttonLinkLabel1->EditAttributes() ?>>
</span>
<?php echo $home_apps->buttonLinkLabel1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($home_apps->buttonLink1->Visible) { // buttonLink1 ?>
	<div id="r_buttonLink1" class="form-group">
		<label id="elh_home_apps_buttonLink1" for="x_buttonLink1" class="<?php echo $home_apps_add->LeftColumnClass ?>"><?php echo $home_apps->buttonLink1->FldCaption() ?></label>
		<div class="<?php echo $home_apps_add->RightColumnClass ?>"><div<?php echo $home_apps->buttonLink1->CellAttributes() ?>>
<span id="el_home_apps_buttonLink1">
<input type="text" data-table="home_apps" data-field="x_buttonLink1" data-page="2" name="x_buttonLink1" id="x_buttonLink1" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($home_apps->buttonLink1->getPlaceHolder()) ?>" value="<?php echo $home_apps->buttonLink1->EditValue ?>"<?php echo $home_apps->buttonLink1->EditAttributes() ?>>
</span>
<?php echo $home_apps->buttonLink1->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $home_apps_add->MultiPages->PageStyle("3") ?>" id="tab_home_apps3"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($home_apps->buttonIcon2->Visible) { // buttonIcon2 ?>
	<div id="r_buttonIcon2" class="form-group">
		<label id="elh_home_apps_buttonIcon2" class="<?php echo $home_apps_add->LeftColumnClass ?>"><?php echo $home_apps->buttonIcon2->FldCaption() ?></label>
		<div class="<?php echo $home_apps_add->RightColumnClass ?>"><div<?php echo $home_apps->buttonIcon2->CellAttributes() ?>>
<span id="el_home_apps_buttonIcon2">
<div id="fd_x_buttonIcon2">
<span title="<?php echo $home_apps->buttonIcon2->FldTitle() ? $home_apps->buttonIcon2->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($home_apps->buttonIcon2->ReadOnly || $home_apps->buttonIcon2->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="home_apps" data-field="x_buttonIcon2" data-page="3" name="x_buttonIcon2" id="x_buttonIcon2"<?php echo $home_apps->buttonIcon2->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_buttonIcon2" id= "fn_x_buttonIcon2" value="<?php echo $home_apps->buttonIcon2->Upload->FileName ?>">
<input type="hidden" name="fa_x_buttonIcon2" id= "fa_x_buttonIcon2" value="0">
<input type="hidden" name="fs_x_buttonIcon2" id= "fs_x_buttonIcon2" value="255">
<input type="hidden" name="fx_x_buttonIcon2" id= "fx_x_buttonIcon2" value="<?php echo $home_apps->buttonIcon2->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_buttonIcon2" id= "fm_x_buttonIcon2" value="<?php echo $home_apps->buttonIcon2->UploadMaxFileSize ?>">
</div>
<table id="ft_x_buttonIcon2" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $home_apps->buttonIcon2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($home_apps->buttonLinkLabel2->Visible) { // buttonLinkLabel2 ?>
	<div id="r_buttonLinkLabel2" class="form-group">
		<label id="elh_home_apps_buttonLinkLabel2" for="x_buttonLinkLabel2" class="<?php echo $home_apps_add->LeftColumnClass ?>"><?php echo $home_apps->buttonLinkLabel2->FldCaption() ?></label>
		<div class="<?php echo $home_apps_add->RightColumnClass ?>"><div<?php echo $home_apps->buttonLinkLabel2->CellAttributes() ?>>
<span id="el_home_apps_buttonLinkLabel2">
<input type="text" data-table="home_apps" data-field="x_buttonLinkLabel2" data-page="3" name="x_buttonLinkLabel2" id="x_buttonLinkLabel2" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($home_apps->buttonLinkLabel2->getPlaceHolder()) ?>" value="<?php echo $home_apps->buttonLinkLabel2->EditValue ?>"<?php echo $home_apps->buttonLinkLabel2->EditAttributes() ?>>
</span>
<?php echo $home_apps->buttonLinkLabel2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($home_apps->buttonLink2->Visible) { // buttonLink2 ?>
	<div id="r_buttonLink2" class="form-group">
		<label id="elh_home_apps_buttonLink2" for="x_buttonLink2" class="<?php echo $home_apps_add->LeftColumnClass ?>"><?php echo $home_apps->buttonLink2->FldCaption() ?></label>
		<div class="<?php echo $home_apps_add->RightColumnClass ?>"><div<?php echo $home_apps->buttonLink2->CellAttributes() ?>>
<span id="el_home_apps_buttonLink2">
<input type="text" data-table="home_apps" data-field="x_buttonLink2" data-page="3" name="x_buttonLink2" id="x_buttonLink2" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($home_apps->buttonLink2->getPlaceHolder()) ?>" value="<?php echo $home_apps->buttonLink2->EditValue ?>"<?php echo $home_apps->buttonLink2->EditAttributes() ?>>
</span>
<?php echo $home_apps->buttonLink2->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page .nav-tabs-custom .tab-content -->
</div><!-- /multi-page .nav-tabs-custom -->
</div><!-- /multi-page -->
<?php if (!$home_apps_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $home_apps_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $home_apps_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fhome_appsadd.Init();
</script>
<?php
$home_apps_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$home_apps_add->Page_Terminate();
?>
