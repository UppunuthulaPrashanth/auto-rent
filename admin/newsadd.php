<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "newsinfo.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$news_add = NULL; // Initialize page object first

class cnews_add extends cnews {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'news';

	// Page object name
	var $PageObjName = 'news_add';

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

		// Table object (news)
		if (!isset($GLOBALS["news"]) || get_class($GLOBALS["news"]) == "cnews") {
			$GLOBALS["news"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["news"];
		}

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'news', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("newslist.php"));
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
		$this->slug->SetVisibility();
		$this->summary->SetVisibility();
		$this->_thumbnail->SetVisibility();
		$this->largeImage->SetVisibility();
		$this->homeImage->SetVisibility();
		$this->description->SetVisibility();
		$this->postDate->SetVisibility();
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
		global $EW_EXPORT, $news;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($news);
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
					if ($pageName == "newsview.php")
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
			if (@$_GET["newsID"] != "") {
				$this->newsID->setQueryStringValue($_GET["newsID"]);
				$this->setKey("newsID", $this->newsID->CurrentValue); // Set up key
			} else {
				$this->setKey("newsID", ""); // Clear key
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
					$this->Page_Terminate("newslist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "newslist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "newsview.php")
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
		$this->largeImage->Upload->Index = $objForm->Index;
		$this->largeImage->Upload->UploadFile();
		$this->largeImage->CurrentValue = $this->largeImage->Upload->FileName;
		$this->homeImage->Upload->Index = $objForm->Index;
		$this->homeImage->Upload->UploadFile();
		$this->homeImage->CurrentValue = $this->homeImage->Upload->FileName;
	}

	// Load default values
	function LoadDefaultValues() {
		$this->newsID->CurrentValue = NULL;
		$this->newsID->OldValue = $this->newsID->CurrentValue;
		$this->title->CurrentValue = NULL;
		$this->title->OldValue = $this->title->CurrentValue;
		$this->slug->CurrentValue = NULL;
		$this->slug->OldValue = $this->slug->CurrentValue;
		$this->summary->CurrentValue = NULL;
		$this->summary->OldValue = $this->summary->CurrentValue;
		$this->_thumbnail->Upload->DbValue = NULL;
		$this->_thumbnail->OldValue = $this->_thumbnail->Upload->DbValue;
		$this->_thumbnail->CurrentValue = NULL; // Clear file related field
		$this->largeImage->Upload->DbValue = NULL;
		$this->largeImage->OldValue = $this->largeImage->Upload->DbValue;
		$this->largeImage->CurrentValue = NULL; // Clear file related field
		$this->homeImage->Upload->DbValue = NULL;
		$this->homeImage->OldValue = $this->homeImage->Upload->DbValue;
		$this->homeImage->CurrentValue = NULL; // Clear file related field
		$this->description->CurrentValue = NULL;
		$this->description->OldValue = $this->description->CurrentValue;
		$this->postDate->CurrentValue = NULL;
		$this->postDate->OldValue = $this->postDate->CurrentValue;
		$this->active->CurrentValue = 1;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->title->FldIsDetailKey) {
			$this->title->setFormValue($objForm->GetValue("x_title"));
		}
		if (!$this->slug->FldIsDetailKey) {
			$this->slug->setFormValue($objForm->GetValue("x_slug"));
		}
		if (!$this->summary->FldIsDetailKey) {
			$this->summary->setFormValue($objForm->GetValue("x_summary"));
		}
		if (!$this->description->FldIsDetailKey) {
			$this->description->setFormValue($objForm->GetValue("x_description"));
		}
		if (!$this->postDate->FldIsDetailKey) {
			$this->postDate->setFormValue($objForm->GetValue("x_postDate"));
			$this->postDate->CurrentValue = ew_UnFormatDateTime($this->postDate->CurrentValue, 7);
		}
		if (!$this->active->FldIsDetailKey) {
			$this->active->setFormValue($objForm->GetValue("x_active"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->title->CurrentValue = $this->title->FormValue;
		$this->slug->CurrentValue = $this->slug->FormValue;
		$this->summary->CurrentValue = $this->summary->FormValue;
		$this->description->CurrentValue = $this->description->FormValue;
		$this->postDate->CurrentValue = $this->postDate->FormValue;
		$this->postDate->CurrentValue = ew_UnFormatDateTime($this->postDate->CurrentValue, 7);
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
		$this->newsID->setDbValue($row['newsID']);
		$this->title->setDbValue($row['title']);
		$this->slug->setDbValue($row['slug']);
		$this->summary->setDbValue($row['summary']);
		$this->_thumbnail->Upload->DbValue = $row['thumbnail'];
		$this->_thumbnail->setDbValue($this->_thumbnail->Upload->DbValue);
		$this->largeImage->Upload->DbValue = $row['largeImage'];
		$this->largeImage->setDbValue($this->largeImage->Upload->DbValue);
		$this->homeImage->Upload->DbValue = $row['homeImage'];
		$this->homeImage->setDbValue($this->homeImage->Upload->DbValue);
		$this->description->setDbValue($row['description']);
		$this->postDate->setDbValue($row['postDate']);
		$this->active->setDbValue($row['active']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['newsID'] = $this->newsID->CurrentValue;
		$row['title'] = $this->title->CurrentValue;
		$row['slug'] = $this->slug->CurrentValue;
		$row['summary'] = $this->summary->CurrentValue;
		$row['thumbnail'] = $this->_thumbnail->Upload->DbValue;
		$row['largeImage'] = $this->largeImage->Upload->DbValue;
		$row['homeImage'] = $this->homeImage->Upload->DbValue;
		$row['description'] = $this->description->CurrentValue;
		$row['postDate'] = $this->postDate->CurrentValue;
		$row['active'] = $this->active->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->newsID->DbValue = $row['newsID'];
		$this->title->DbValue = $row['title'];
		$this->slug->DbValue = $row['slug'];
		$this->summary->DbValue = $row['summary'];
		$this->_thumbnail->Upload->DbValue = $row['thumbnail'];
		$this->largeImage->Upload->DbValue = $row['largeImage'];
		$this->homeImage->Upload->DbValue = $row['homeImage'];
		$this->description->DbValue = $row['description'];
		$this->postDate->DbValue = $row['postDate'];
		$this->active->DbValue = $row['active'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("newsID")) <> "")
			$this->newsID->CurrentValue = $this->getKey("newsID"); // newsID
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
		// newsID
		// title
		// slug
		// summary
		// thumbnail
		// largeImage
		// homeImage
		// description
		// postDate
		// active

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// newsID
		$this->newsID->ViewValue = $this->newsID->CurrentValue;
		$this->newsID->ViewCustomAttributes = "";

		// title
		$this->title->ViewValue = $this->title->CurrentValue;
		$this->title->ViewCustomAttributes = "";

		// slug
		$this->slug->ViewValue = $this->slug->CurrentValue;
		$this->slug->ViewCustomAttributes = "";

		// summary
		$this->summary->ViewValue = $this->summary->CurrentValue;
		$this->summary->ViewCustomAttributes = "";

		// thumbnail
		$this->_thumbnail->UploadPath = 'uploads/news';
		if (!ew_Empty($this->_thumbnail->Upload->DbValue)) {
			$this->_thumbnail->ImageWidth = 100;
			$this->_thumbnail->ImageHeight = 0;
			$this->_thumbnail->ImageAlt = $this->_thumbnail->FldAlt();
			$this->_thumbnail->ViewValue = $this->_thumbnail->Upload->DbValue;
		} else {
			$this->_thumbnail->ViewValue = "";
		}
		$this->_thumbnail->ViewCustomAttributes = "";

		// largeImage
		$this->largeImage->UploadPath = 'uploads/news';
		if (!ew_Empty($this->largeImage->Upload->DbValue)) {
			$this->largeImage->ImageWidth = 100;
			$this->largeImage->ImageHeight = 0;
			$this->largeImage->ImageAlt = $this->largeImage->FldAlt();
			$this->largeImage->ViewValue = $this->largeImage->Upload->DbValue;
		} else {
			$this->largeImage->ViewValue = "";
		}
		$this->largeImage->ViewCustomAttributes = "";

		// homeImage
		$this->homeImage->UploadPath = 'uploads/news';
		if (!ew_Empty($this->homeImage->Upload->DbValue)) {
			$this->homeImage->ImageWidth = 100;
			$this->homeImage->ImageHeight = 0;
			$this->homeImage->ImageAlt = $this->homeImage->FldAlt();
			$this->homeImage->ViewValue = $this->homeImage->Upload->DbValue;
		} else {
			$this->homeImage->ViewValue = "";
		}
		$this->homeImage->ViewCustomAttributes = "";

		// description
		$this->description->ViewValue = $this->description->CurrentValue;
		$this->description->ViewCustomAttributes = "";

		// postDate
		$this->postDate->ViewValue = $this->postDate->CurrentValue;
		$this->postDate->ViewValue = ew_FormatDateTime($this->postDate->ViewValue, 7);
		$this->postDate->ViewCustomAttributes = "";

		// active
		if (strval($this->active->CurrentValue) <> "") {
			$this->active->ViewValue = $this->active->OptionCaption($this->active->CurrentValue);
		} else {
			$this->active->ViewValue = NULL;
		}
		$this->active->ViewCustomAttributes = "";

			// title
			$this->title->LinkCustomAttributes = "";
			$this->title->HrefValue = "";
			$this->title->TooltipValue = "";

			// slug
			$this->slug->LinkCustomAttributes = "";
			$this->slug->HrefValue = "";
			$this->slug->TooltipValue = "";

			// summary
			$this->summary->LinkCustomAttributes = "";
			$this->summary->HrefValue = "";
			$this->summary->TooltipValue = "";

			// thumbnail
			$this->_thumbnail->LinkCustomAttributes = "";
			$this->_thumbnail->UploadPath = 'uploads/news';
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
				$this->_thumbnail->LinkAttrs["data-rel"] = "news_x__thumbnail";
				ew_AppendClass($this->_thumbnail->LinkAttrs["class"], "ewLightbox");
			}

			// largeImage
			$this->largeImage->LinkCustomAttributes = "";
			$this->largeImage->UploadPath = 'uploads/news';
			if (!ew_Empty($this->largeImage->Upload->DbValue)) {
				$this->largeImage->HrefValue = ew_GetFileUploadUrl($this->largeImage, $this->largeImage->Upload->DbValue); // Add prefix/suffix
				$this->largeImage->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->largeImage->HrefValue = ew_FullUrl($this->largeImage->HrefValue, "href");
			} else {
				$this->largeImage->HrefValue = "";
			}
			$this->largeImage->HrefValue2 = $this->largeImage->UploadPath . $this->largeImage->Upload->DbValue;
			$this->largeImage->TooltipValue = "";
			if ($this->largeImage->UseColorbox) {
				if (ew_Empty($this->largeImage->TooltipValue))
					$this->largeImage->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->largeImage->LinkAttrs["data-rel"] = "news_x_largeImage";
				ew_AppendClass($this->largeImage->LinkAttrs["class"], "ewLightbox");
			}

			// homeImage
			$this->homeImage->LinkCustomAttributes = "";
			$this->homeImage->UploadPath = 'uploads/news';
			if (!ew_Empty($this->homeImage->Upload->DbValue)) {
				$this->homeImage->HrefValue = ew_GetFileUploadUrl($this->homeImage, $this->homeImage->Upload->DbValue); // Add prefix/suffix
				$this->homeImage->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->homeImage->HrefValue = ew_FullUrl($this->homeImage->HrefValue, "href");
			} else {
				$this->homeImage->HrefValue = "";
			}
			$this->homeImage->HrefValue2 = $this->homeImage->UploadPath . $this->homeImage->Upload->DbValue;
			$this->homeImage->TooltipValue = "";
			if ($this->homeImage->UseColorbox) {
				if (ew_Empty($this->homeImage->TooltipValue))
					$this->homeImage->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->homeImage->LinkAttrs["data-rel"] = "news_x_homeImage";
				ew_AppendClass($this->homeImage->LinkAttrs["class"], "ewLightbox");
			}

			// description
			$this->description->LinkCustomAttributes = "";
			$this->description->HrefValue = "";
			$this->description->TooltipValue = "";

			// postDate
			$this->postDate->LinkCustomAttributes = "";
			$this->postDate->HrefValue = "";
			$this->postDate->TooltipValue = "";

			// active
			$this->active->LinkCustomAttributes = "";
			$this->active->HrefValue = "";
			$this->active->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// title
			$this->title->EditAttrs["class"] = "form-control";
			$this->title->EditCustomAttributes = "";
			$this->title->EditValue = ew_HtmlEncode($this->title->CurrentValue);
			$this->title->PlaceHolder = ew_RemoveHtml($this->title->FldCaption());

			// slug
			$this->slug->EditAttrs["class"] = "form-control";
			$this->slug->EditCustomAttributes = "";
			$this->slug->EditValue = ew_HtmlEncode($this->slug->CurrentValue);
			$this->slug->PlaceHolder = ew_RemoveHtml($this->slug->FldCaption());

			// summary
			$this->summary->EditAttrs["class"] = "form-control";
			$this->summary->EditCustomAttributes = "";
			$this->summary->EditValue = ew_HtmlEncode($this->summary->CurrentValue);
			$this->summary->PlaceHolder = ew_RemoveHtml($this->summary->FldCaption());

			// thumbnail
			$this->_thumbnail->EditAttrs["class"] = "form-control";
			$this->_thumbnail->EditCustomAttributes = "";
			$this->_thumbnail->UploadPath = 'uploads/news';
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

			// largeImage
			$this->largeImage->EditAttrs["class"] = "form-control";
			$this->largeImage->EditCustomAttributes = "";
			$this->largeImage->UploadPath = 'uploads/news';
			if (!ew_Empty($this->largeImage->Upload->DbValue)) {
				$this->largeImage->ImageWidth = 100;
				$this->largeImage->ImageHeight = 0;
				$this->largeImage->ImageAlt = $this->largeImage->FldAlt();
				$this->largeImage->EditValue = $this->largeImage->Upload->DbValue;
			} else {
				$this->largeImage->EditValue = "";
			}
			if (!ew_Empty($this->largeImage->CurrentValue))
					$this->largeImage->Upload->FileName = $this->largeImage->CurrentValue;
			if (($this->CurrentAction == "I" || $this->CurrentAction == "C") && !$this->EventCancelled) ew_RenderUploadField($this->largeImage);

			// homeImage
			$this->homeImage->EditAttrs["class"] = "form-control";
			$this->homeImage->EditCustomAttributes = "";
			$this->homeImage->UploadPath = 'uploads/news';
			if (!ew_Empty($this->homeImage->Upload->DbValue)) {
				$this->homeImage->ImageWidth = 100;
				$this->homeImage->ImageHeight = 0;
				$this->homeImage->ImageAlt = $this->homeImage->FldAlt();
				$this->homeImage->EditValue = $this->homeImage->Upload->DbValue;
			} else {
				$this->homeImage->EditValue = "";
			}
			if (!ew_Empty($this->homeImage->CurrentValue))
					$this->homeImage->Upload->FileName = $this->homeImage->CurrentValue;
			if (($this->CurrentAction == "I" || $this->CurrentAction == "C") && !$this->EventCancelled) ew_RenderUploadField($this->homeImage);

			// description
			$this->description->EditAttrs["class"] = "form-control";
			$this->description->EditCustomAttributes = "";
			$this->description->EditValue = ew_HtmlEncode($this->description->CurrentValue);
			$this->description->PlaceHolder = ew_RemoveHtml($this->description->FldCaption());

			// postDate
			$this->postDate->EditAttrs["class"] = "form-control";
			$this->postDate->EditCustomAttributes = "";
			$this->postDate->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->postDate->CurrentValue, 7));
			$this->postDate->PlaceHolder = ew_RemoveHtml($this->postDate->FldCaption());

			// active
			$this->active->EditAttrs["class"] = "form-control";
			$this->active->EditCustomAttributes = "";
			$this->active->EditValue = $this->active->Options(TRUE);

			// Add refer script
			// title

			$this->title->LinkCustomAttributes = "";
			$this->title->HrefValue = "";

			// slug
			$this->slug->LinkCustomAttributes = "";
			$this->slug->HrefValue = "";

			// summary
			$this->summary->LinkCustomAttributes = "";
			$this->summary->HrefValue = "";

			// thumbnail
			$this->_thumbnail->LinkCustomAttributes = "";
			$this->_thumbnail->UploadPath = 'uploads/news';
			if (!ew_Empty($this->_thumbnail->Upload->DbValue)) {
				$this->_thumbnail->HrefValue = ew_GetFileUploadUrl($this->_thumbnail, $this->_thumbnail->Upload->DbValue); // Add prefix/suffix
				$this->_thumbnail->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->_thumbnail->HrefValue = ew_FullUrl($this->_thumbnail->HrefValue, "href");
			} else {
				$this->_thumbnail->HrefValue = "";
			}
			$this->_thumbnail->HrefValue2 = $this->_thumbnail->UploadPath . $this->_thumbnail->Upload->DbValue;

			// largeImage
			$this->largeImage->LinkCustomAttributes = "";
			$this->largeImage->UploadPath = 'uploads/news';
			if (!ew_Empty($this->largeImage->Upload->DbValue)) {
				$this->largeImage->HrefValue = ew_GetFileUploadUrl($this->largeImage, $this->largeImage->Upload->DbValue); // Add prefix/suffix
				$this->largeImage->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->largeImage->HrefValue = ew_FullUrl($this->largeImage->HrefValue, "href");
			} else {
				$this->largeImage->HrefValue = "";
			}
			$this->largeImage->HrefValue2 = $this->largeImage->UploadPath . $this->largeImage->Upload->DbValue;

			// homeImage
			$this->homeImage->LinkCustomAttributes = "";
			$this->homeImage->UploadPath = 'uploads/news';
			if (!ew_Empty($this->homeImage->Upload->DbValue)) {
				$this->homeImage->HrefValue = ew_GetFileUploadUrl($this->homeImage, $this->homeImage->Upload->DbValue); // Add prefix/suffix
				$this->homeImage->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->homeImage->HrefValue = ew_FullUrl($this->homeImage->HrefValue, "href");
			} else {
				$this->homeImage->HrefValue = "";
			}
			$this->homeImage->HrefValue2 = $this->homeImage->UploadPath . $this->homeImage->Upload->DbValue;

			// description
			$this->description->LinkCustomAttributes = "";
			$this->description->HrefValue = "";

			// postDate
			$this->postDate->LinkCustomAttributes = "";
			$this->postDate->HrefValue = "";

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
		if (!ew_CheckEuroDate($this->postDate->FormValue)) {
			ew_AddMessage($gsFormError, $this->postDate->FldErrMsg());
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
			$this->_thumbnail->OldUploadPath = 'uploads/news';
			$this->_thumbnail->UploadPath = $this->_thumbnail->OldUploadPath;
			$this->largeImage->OldUploadPath = 'uploads/news';
			$this->largeImage->UploadPath = $this->largeImage->OldUploadPath;
			$this->homeImage->OldUploadPath = 'uploads/news';
			$this->homeImage->UploadPath = $this->homeImage->OldUploadPath;
		}
		$rsnew = array();

		// title
		$this->title->SetDbValueDef($rsnew, $this->title->CurrentValue, NULL, FALSE);

		// slug
		$this->slug->SetDbValueDef($rsnew, $this->slug->CurrentValue, NULL, FALSE);

		// summary
		$this->summary->SetDbValueDef($rsnew, $this->summary->CurrentValue, NULL, FALSE);

		// thumbnail
		if ($this->_thumbnail->Visible && !$this->_thumbnail->Upload->KeepFile) {
			$this->_thumbnail->Upload->DbValue = ""; // No need to delete old file
			if ($this->_thumbnail->Upload->FileName == "") {
				$rsnew['thumbnail'] = NULL;
			} else {
				$rsnew['thumbnail'] = $this->_thumbnail->Upload->FileName;
			}
		}

		// largeImage
		if ($this->largeImage->Visible && !$this->largeImage->Upload->KeepFile) {
			$this->largeImage->Upload->DbValue = ""; // No need to delete old file
			if ($this->largeImage->Upload->FileName == "") {
				$rsnew['largeImage'] = NULL;
			} else {
				$rsnew['largeImage'] = $this->largeImage->Upload->FileName;
			}
		}

		// homeImage
		if ($this->homeImage->Visible && !$this->homeImage->Upload->KeepFile) {
			$this->homeImage->Upload->DbValue = ""; // No need to delete old file
			if ($this->homeImage->Upload->FileName == "") {
				$rsnew['homeImage'] = NULL;
			} else {
				$rsnew['homeImage'] = $this->homeImage->Upload->FileName;
			}
		}

		// description
		$this->description->SetDbValueDef($rsnew, $this->description->CurrentValue, NULL, FALSE);

		// postDate
		$this->postDate->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->postDate->CurrentValue, 7), NULL, FALSE);

		// active
		$this->active->SetDbValueDef($rsnew, $this->active->CurrentValue, NULL, strval($this->active->CurrentValue) == "");
		if ($this->_thumbnail->Visible && !$this->_thumbnail->Upload->KeepFile) {
			$this->_thumbnail->UploadPath = 'uploads/news';
			$OldFiles = ew_Empty($this->_thumbnail->Upload->DbValue) ? array() : array($this->_thumbnail->Upload->DbValue);
			if (!ew_Empty($this->_thumbnail->Upload->FileName)) {
				$NewFiles = array($this->_thumbnail->Upload->FileName);
				$NewFileCount = count($NewFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					$fldvar = ($this->_thumbnail->Upload->Index < 0) ? $this->_thumbnail->FldVar : substr($this->_thumbnail->FldVar, 0, 1) . $this->_thumbnail->Upload->Index . substr($this->_thumbnail->FldVar, 1);
					if ($NewFiles[$i] <> "") {
						$file = $NewFiles[$i];
						if (file_exists(ew_UploadTempPath($fldvar, $this->_thumbnail->TblVar) . $file)) {
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
		if ($this->largeImage->Visible && !$this->largeImage->Upload->KeepFile) {
			$this->largeImage->UploadPath = 'uploads/news';
			$OldFiles = ew_Empty($this->largeImage->Upload->DbValue) ? array() : array($this->largeImage->Upload->DbValue);
			if (!ew_Empty($this->largeImage->Upload->FileName)) {
				$NewFiles = array($this->largeImage->Upload->FileName);
				$NewFileCount = count($NewFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					$fldvar = ($this->largeImage->Upload->Index < 0) ? $this->largeImage->FldVar : substr($this->largeImage->FldVar, 0, 1) . $this->largeImage->Upload->Index . substr($this->largeImage->FldVar, 1);
					if ($NewFiles[$i] <> "") {
						$file = $NewFiles[$i];
						if (file_exists(ew_UploadTempPath($fldvar, $this->largeImage->TblVar) . $file)) {
							$file1 = ew_UploadFileNameEx($this->largeImage->PhysicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(ew_UploadTempPath($fldvar, $this->largeImage->TblVar) . $file1) || file_exists($this->largeImage->PhysicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = ew_UniqueFilename($this->largeImage->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(ew_UploadTempPath($fldvar, $this->largeImage->TblVar) . $file, ew_UploadTempPath($fldvar, $this->largeImage->TblVar) . $file1);
								$NewFiles[$i] = $file1;
							}
						}
					}
				}
				$this->largeImage->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
				$this->largeImage->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
				$this->largeImage->SetDbValueDef($rsnew, $this->largeImage->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->homeImage->Visible && !$this->homeImage->Upload->KeepFile) {
			$this->homeImage->UploadPath = 'uploads/news';
			$OldFiles = ew_Empty($this->homeImage->Upload->DbValue) ? array() : array($this->homeImage->Upload->DbValue);
			if (!ew_Empty($this->homeImage->Upload->FileName)) {
				$NewFiles = array($this->homeImage->Upload->FileName);
				$NewFileCount = count($NewFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					$fldvar = ($this->homeImage->Upload->Index < 0) ? $this->homeImage->FldVar : substr($this->homeImage->FldVar, 0, 1) . $this->homeImage->Upload->Index . substr($this->homeImage->FldVar, 1);
					if ($NewFiles[$i] <> "") {
						$file = $NewFiles[$i];
						if (file_exists(ew_UploadTempPath($fldvar, $this->homeImage->TblVar) . $file)) {
							$file1 = ew_UploadFileNameEx($this->homeImage->PhysicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(ew_UploadTempPath($fldvar, $this->homeImage->TblVar) . $file1) || file_exists($this->homeImage->PhysicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = ew_UniqueFilename($this->homeImage->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(ew_UploadTempPath($fldvar, $this->homeImage->TblVar) . $file, ew_UploadTempPath($fldvar, $this->homeImage->TblVar) . $file1);
								$NewFiles[$i] = $file1;
							}
						}
					}
				}
				$this->homeImage->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
				$this->homeImage->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
				$this->homeImage->SetDbValueDef($rsnew, $this->homeImage->Upload->FileName, NULL, FALSE);
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
				}
				if ($this->largeImage->Visible && !$this->largeImage->Upload->KeepFile) {
					$OldFiles = ew_Empty($this->largeImage->Upload->DbValue) ? array() : array($this->largeImage->Upload->DbValue);
					if (!ew_Empty($this->largeImage->Upload->FileName)) {
						$NewFiles = array($this->largeImage->Upload->FileName);
						$NewFiles2 = array($rsnew['largeImage']);
						$NewFileCount = count($NewFiles);
						for ($i = 0; $i < $NewFileCount; $i++) {
							$fldvar = ($this->largeImage->Upload->Index < 0) ? $this->largeImage->FldVar : substr($this->largeImage->FldVar, 0, 1) . $this->largeImage->Upload->Index . substr($this->largeImage->FldVar, 1);
							if ($NewFiles[$i] <> "") {
								$file = ew_UploadTempPath($fldvar, $this->largeImage->TblVar) . $NewFiles[$i];
								if (file_exists($file)) {
									if (@$NewFiles2[$i] <> "") // Use correct file name
										$NewFiles[$i] = $NewFiles2[$i];
									if (!$this->largeImage->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
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
				if ($this->homeImage->Visible && !$this->homeImage->Upload->KeepFile) {
					$OldFiles = ew_Empty($this->homeImage->Upload->DbValue) ? array() : array($this->homeImage->Upload->DbValue);
					if (!ew_Empty($this->homeImage->Upload->FileName)) {
						$NewFiles = array($this->homeImage->Upload->FileName);
						$NewFiles2 = array($rsnew['homeImage']);
						$NewFileCount = count($NewFiles);
						for ($i = 0; $i < $NewFileCount; $i++) {
							$fldvar = ($this->homeImage->Upload->Index < 0) ? $this->homeImage->FldVar : substr($this->homeImage->FldVar, 0, 1) . $this->homeImage->Upload->Index . substr($this->homeImage->FldVar, 1);
							if ($NewFiles[$i] <> "") {
								$file = ew_UploadTempPath($fldvar, $this->homeImage->TblVar) . $NewFiles[$i];
								if (file_exists($file)) {
									if (@$NewFiles2[$i] <> "") // Use correct file name
										$NewFiles[$i] = $NewFiles2[$i];
									if (!$this->homeImage->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
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

		// thumbnail
		ew_CleanUploadTempPath($this->_thumbnail, $this->_thumbnail->Upload->Index);

		// largeImage
		ew_CleanUploadTempPath($this->largeImage, $this->largeImage->Upload->Index);

		// homeImage
		ew_CleanUploadTempPath($this->homeImage, $this->homeImage->Upload->Index);
		return $AddRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("newslist.php"), "", $this->TableVar, TRUE);
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
if (!isset($news_add)) $news_add = new cnews_add();

// Page init
$news_add->Page_Init();

// Page main
$news_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$news_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = fnewsadd = new ew_Form("fnewsadd", "add");

// Validate form
fnewsadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_postDate");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($news->postDate->FldErrMsg()) ?>");

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
fnewsadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fnewsadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Multi-Page
fnewsadd.MultiPage = new ew_MultiPage("fnewsadd");

// Dynamic selection lists
fnewsadd.Lists["x_active"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fnewsadd.Lists["x_active"].Options = <?php echo json_encode($news_add->active->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $news_add->ShowPageHeader(); ?>
<?php
$news_add->ShowMessage();
?>
<form name="fnewsadd" id="fnewsadd" class="<?php echo $news_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($news_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $news_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="news">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($news_add->IsModal) ?>">
<div class="ewMultiPage"><!-- multi-page -->
<div class="nav-tabs-custom" id="news_add"><!-- multi-page .nav-tabs-custom -->
	<ul class="nav<?php echo $news_add->MultiPages->NavStyle() ?>">
		<li<?php echo $news_add->MultiPages->TabStyle("1") ?>><a href="#tab_news1" data-toggle="tab"><?php echo $news->PageCaption(1) ?></a></li>
		<li<?php echo $news_add->MultiPages->TabStyle("2") ?>><a href="#tab_news2" data-toggle="tab"><?php echo $news->PageCaption(2) ?></a></li>
		<li<?php echo $news_add->MultiPages->TabStyle("3") ?>><a href="#tab_news3" data-toggle="tab"><?php echo $news->PageCaption(3) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page .nav-tabs-custom .tab-content -->
		<div class="tab-pane<?php echo $news_add->MultiPages->PageStyle("1") ?>" id="tab_news1"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($news->title->Visible) { // title ?>
	<div id="r_title" class="form-group">
		<label id="elh_news_title" for="x_title" class="<?php echo $news_add->LeftColumnClass ?>"><?php echo $news->title->FldCaption() ?></label>
		<div class="<?php echo $news_add->RightColumnClass ?>"><div<?php echo $news->title->CellAttributes() ?>>
<span id="el_news_title">
<input type="text" data-table="news" data-field="x_title" data-page="1" name="x_title" id="x_title" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($news->title->getPlaceHolder()) ?>" value="<?php echo $news->title->EditValue ?>"<?php echo $news->title->EditAttributes() ?>>
</span>
<?php echo $news->title->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($news->slug->Visible) { // slug ?>
	<div id="r_slug" class="form-group">
		<label id="elh_news_slug" for="x_slug" class="<?php echo $news_add->LeftColumnClass ?>"><?php echo $news->slug->FldCaption() ?></label>
		<div class="<?php echo $news_add->RightColumnClass ?>"><div<?php echo $news->slug->CellAttributes() ?>>
<span id="el_news_slug">
<input type="text" data-table="news" data-field="x_slug" data-page="1" name="x_slug" id="x_slug" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($news->slug->getPlaceHolder()) ?>" value="<?php echo $news->slug->EditValue ?>"<?php echo $news->slug->EditAttributes() ?>>
</span>
<?php echo $news->slug->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($news->summary->Visible) { // summary ?>
	<div id="r_summary" class="form-group">
		<label id="elh_news_summary" for="x_summary" class="<?php echo $news_add->LeftColumnClass ?>"><?php echo $news->summary->FldCaption() ?></label>
		<div class="<?php echo $news_add->RightColumnClass ?>"><div<?php echo $news->summary->CellAttributes() ?>>
<span id="el_news_summary">
<input type="text" data-table="news" data-field="x_summary" data-page="1" name="x_summary" id="x_summary" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($news->summary->getPlaceHolder()) ?>" value="<?php echo $news->summary->EditValue ?>"<?php echo $news->summary->EditAttributes() ?>>
</span>
<?php echo $news->summary->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($news->postDate->Visible) { // postDate ?>
	<div id="r_postDate" class="form-group">
		<label id="elh_news_postDate" for="x_postDate" class="<?php echo $news_add->LeftColumnClass ?>"><?php echo $news->postDate->FldCaption() ?></label>
		<div class="<?php echo $news_add->RightColumnClass ?>"><div<?php echo $news->postDate->CellAttributes() ?>>
<span id="el_news_postDate">
<input type="text" data-table="news" data-field="x_postDate" data-page="1" data-format="7" name="x_postDate" id="x_postDate" placeholder="<?php echo ew_HtmlEncode($news->postDate->getPlaceHolder()) ?>" value="<?php echo $news->postDate->EditValue ?>"<?php echo $news->postDate->EditAttributes() ?>>
<?php if (!$news->postDate->ReadOnly && !$news->postDate->Disabled && !isset($news->postDate->EditAttrs["readonly"]) && !isset($news->postDate->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("fnewsadd", "x_postDate", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php echo $news->postDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($news->active->Visible) { // active ?>
	<div id="r_active" class="form-group">
		<label id="elh_news_active" for="x_active" class="<?php echo $news_add->LeftColumnClass ?>"><?php echo $news->active->FldCaption() ?></label>
		<div class="<?php echo $news_add->RightColumnClass ?>"><div<?php echo $news->active->CellAttributes() ?>>
<span id="el_news_active">
<select data-table="news" data-field="x_active" data-page="1" data-value-separator="<?php echo $news->active->DisplayValueSeparatorAttribute() ?>" id="x_active" name="x_active"<?php echo $news->active->EditAttributes() ?>>
<?php echo $news->active->SelectOptionListHtml("x_active") ?>
</select>
</span>
<?php echo $news->active->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $news_add->MultiPages->PageStyle("2") ?>" id="tab_news2"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($news->_thumbnail->Visible) { // thumbnail ?>
	<div id="r__thumbnail" class="form-group">
		<label id="elh_news__thumbnail" class="<?php echo $news_add->LeftColumnClass ?>"><?php echo $news->_thumbnail->FldCaption() ?></label>
		<div class="<?php echo $news_add->RightColumnClass ?>"><div<?php echo $news->_thumbnail->CellAttributes() ?>>
<span id="el_news__thumbnail">
<div id="fd_x__thumbnail">
<span title="<?php echo $news->_thumbnail->FldTitle() ? $news->_thumbnail->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($news->_thumbnail->ReadOnly || $news->_thumbnail->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="news" data-field="x__thumbnail" data-page="2" name="x__thumbnail" id="x__thumbnail"<?php echo $news->_thumbnail->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x__thumbnail" id= "fn_x__thumbnail" value="<?php echo $news->_thumbnail->Upload->FileName ?>">
<input type="hidden" name="fa_x__thumbnail" id= "fa_x__thumbnail" value="0">
<input type="hidden" name="fs_x__thumbnail" id= "fs_x__thumbnail" value="255">
<input type="hidden" name="fx_x__thumbnail" id= "fx_x__thumbnail" value="<?php echo $news->_thumbnail->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x__thumbnail" id= "fm_x__thumbnail" value="<?php echo $news->_thumbnail->UploadMaxFileSize ?>">
</div>
<table id="ft_x__thumbnail" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $news->_thumbnail->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($news->largeImage->Visible) { // largeImage ?>
	<div id="r_largeImage" class="form-group">
		<label id="elh_news_largeImage" class="<?php echo $news_add->LeftColumnClass ?>"><?php echo $news->largeImage->FldCaption() ?></label>
		<div class="<?php echo $news_add->RightColumnClass ?>"><div<?php echo $news->largeImage->CellAttributes() ?>>
<span id="el_news_largeImage">
<div id="fd_x_largeImage">
<span title="<?php echo $news->largeImage->FldTitle() ? $news->largeImage->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($news->largeImage->ReadOnly || $news->largeImage->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="news" data-field="x_largeImage" data-page="2" name="x_largeImage" id="x_largeImage"<?php echo $news->largeImage->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_largeImage" id= "fn_x_largeImage" value="<?php echo $news->largeImage->Upload->FileName ?>">
<input type="hidden" name="fa_x_largeImage" id= "fa_x_largeImage" value="0">
<input type="hidden" name="fs_x_largeImage" id= "fs_x_largeImage" value="255">
<input type="hidden" name="fx_x_largeImage" id= "fx_x_largeImage" value="<?php echo $news->largeImage->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_largeImage" id= "fm_x_largeImage" value="<?php echo $news->largeImage->UploadMaxFileSize ?>">
</div>
<table id="ft_x_largeImage" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $news->largeImage->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($news->homeImage->Visible) { // homeImage ?>
	<div id="r_homeImage" class="form-group">
		<label id="elh_news_homeImage" class="<?php echo $news_add->LeftColumnClass ?>"><?php echo $news->homeImage->FldCaption() ?></label>
		<div class="<?php echo $news_add->RightColumnClass ?>"><div<?php echo $news->homeImage->CellAttributes() ?>>
<span id="el_news_homeImage">
<div id="fd_x_homeImage">
<span title="<?php echo $news->homeImage->FldTitle() ? $news->homeImage->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($news->homeImage->ReadOnly || $news->homeImage->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="news" data-field="x_homeImage" data-page="2" name="x_homeImage" id="x_homeImage"<?php echo $news->homeImage->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_homeImage" id= "fn_x_homeImage" value="<?php echo $news->homeImage->Upload->FileName ?>">
<input type="hidden" name="fa_x_homeImage" id= "fa_x_homeImage" value="0">
<input type="hidden" name="fs_x_homeImage" id= "fs_x_homeImage" value="255">
<input type="hidden" name="fx_x_homeImage" id= "fx_x_homeImage" value="<?php echo $news->homeImage->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_homeImage" id= "fm_x_homeImage" value="<?php echo $news->homeImage->UploadMaxFileSize ?>">
</div>
<table id="ft_x_homeImage" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $news->homeImage->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $news_add->MultiPages->PageStyle("3") ?>" id="tab_news3"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($news->description->Visible) { // description ?>
	<div id="r_description" class="form-group">
		<label id="elh_news_description" class="<?php echo $news_add->LeftColumnClass ?>"><?php echo $news->description->FldCaption() ?></label>
		<div class="<?php echo $news_add->RightColumnClass ?>"><div<?php echo $news->description->CellAttributes() ?>>
<span id="el_news_description">
<?php ew_AppendClass($news->description->EditAttrs["class"], "editor"); ?>
<textarea data-table="news" data-field="x_description" data-page="3" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($news->description->getPlaceHolder()) ?>"<?php echo $news->description->EditAttributes() ?>><?php echo $news->description->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fnewsadd", "x_description", 35, 4, <?php echo ($news->description->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $news->description->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page .nav-tabs-custom .tab-content -->
</div><!-- /multi-page .nav-tabs-custom -->
</div><!-- /multi-page -->
<?php if (!$news_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $news_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $news_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fnewsadd.Init();
</script>
<?php
$news_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$news_add->Page_Terminate();
?>
