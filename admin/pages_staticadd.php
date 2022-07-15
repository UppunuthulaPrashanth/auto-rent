<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "pages_staticinfo.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$pages_static_add = NULL; // Initialize page object first

class cpages_static_add extends cpages_static {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'pages_static';

	// Page object name
	var $PageObjName = 'pages_static_add';

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

		// Table object (pages_static)
		if (!isset($GLOBALS["pages_static"]) || get_class($GLOBALS["pages_static"]) == "cpages_static") {
			$GLOBALS["pages_static"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["pages_static"];
		}

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pages_static', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("pages_staticlist.php"));
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
		$this->pageTitle->SetVisibility();
		$this->subTitle->SetVisibility();
		$this->headerBG->SetVisibility();
		$this->summary->SetVisibility();
		$this->image->SetVisibility();

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
		global $EW_EXPORT, $pages_static;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($pages_static);
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
					if ($pageName == "pages_staticview.php")
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
			if (@$_GET["_pageID"] != "") {
				$this->_pageID->setQueryStringValue($_GET["_pageID"]);
				$this->setKey("_pageID", $this->_pageID->CurrentValue); // Set up key
			} else {
				$this->setKey("_pageID", ""); // Clear key
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
					$this->Page_Terminate("pages_staticlist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "pages_staticlist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "pages_staticview.php")
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
		$this->headerBG->Upload->Index = $objForm->Index;
		$this->headerBG->Upload->UploadFile();
		$this->headerBG->CurrentValue = $this->headerBG->Upload->FileName;
	}

	// Load default values
	function LoadDefaultValues() {
		$this->_pageID->CurrentValue = NULL;
		$this->_pageID->OldValue = $this->_pageID->CurrentValue;
		$this->pageTitle->CurrentValue = NULL;
		$this->pageTitle->OldValue = $this->pageTitle->CurrentValue;
		$this->subTitle->CurrentValue = NULL;
		$this->subTitle->OldValue = $this->subTitle->CurrentValue;
		$this->headerBG->Upload->DbValue = NULL;
		$this->headerBG->OldValue = $this->headerBG->Upload->DbValue;
		$this->headerBG->CurrentValue = NULL; // Clear file related field
		$this->summary->CurrentValue = NULL;
		$this->summary->OldValue = $this->summary->CurrentValue;
		$this->image->CurrentValue = NULL;
		$this->image->OldValue = $this->image->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->pageTitle->FldIsDetailKey) {
			$this->pageTitle->setFormValue($objForm->GetValue("x_pageTitle"));
		}
		if (!$this->subTitle->FldIsDetailKey) {
			$this->subTitle->setFormValue($objForm->GetValue("x_subTitle"));
		}
		if (!$this->summary->FldIsDetailKey) {
			$this->summary->setFormValue($objForm->GetValue("x_summary"));
		}
		if (!$this->image->FldIsDetailKey) {
			$this->image->setFormValue($objForm->GetValue("x_image"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->pageTitle->CurrentValue = $this->pageTitle->FormValue;
		$this->subTitle->CurrentValue = $this->subTitle->FormValue;
		$this->summary->CurrentValue = $this->summary->FormValue;
		$this->image->CurrentValue = $this->image->FormValue;
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
		$this->_pageID->setDbValue($row['pageID']);
		$this->pageTitle->setDbValue($row['pageTitle']);
		$this->subTitle->setDbValue($row['subTitle']);
		$this->headerBG->Upload->DbValue = $row['headerBG'];
		$this->headerBG->setDbValue($this->headerBG->Upload->DbValue);
		$this->summary->setDbValue($row['summary']);
		$this->image->setDbValue($row['image']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['pageID'] = $this->_pageID->CurrentValue;
		$row['pageTitle'] = $this->pageTitle->CurrentValue;
		$row['subTitle'] = $this->subTitle->CurrentValue;
		$row['headerBG'] = $this->headerBG->Upload->DbValue;
		$row['summary'] = $this->summary->CurrentValue;
		$row['image'] = $this->image->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->_pageID->DbValue = $row['pageID'];
		$this->pageTitle->DbValue = $row['pageTitle'];
		$this->subTitle->DbValue = $row['subTitle'];
		$this->headerBG->Upload->DbValue = $row['headerBG'];
		$this->summary->DbValue = $row['summary'];
		$this->image->DbValue = $row['image'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("_pageID")) <> "")
			$this->_pageID->CurrentValue = $this->getKey("_pageID"); // pageID
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
		// pageID
		// pageTitle
		// subTitle
		// headerBG
		// summary
		// image

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// pageID
		$this->_pageID->ViewValue = $this->_pageID->CurrentValue;
		$this->_pageID->ViewCustomAttributes = "";

		// pageTitle
		$this->pageTitle->ViewValue = $this->pageTitle->CurrentValue;
		$this->pageTitle->ViewCustomAttributes = "";

		// subTitle
		$this->subTitle->ViewValue = $this->subTitle->CurrentValue;
		$this->subTitle->ViewCustomAttributes = "";

		// headerBG
		$this->headerBG->UploadPath = 'uploads/pages';
		if (!ew_Empty($this->headerBG->Upload->DbValue)) {
			$this->headerBG->ImageWidth = 100;
			$this->headerBG->ImageHeight = 0;
			$this->headerBG->ImageAlt = $this->headerBG->FldAlt();
			$this->headerBG->ViewValue = $this->headerBG->Upload->DbValue;
		} else {
			$this->headerBG->ViewValue = "";
		}
		$this->headerBG->ViewCustomAttributes = "";

		// summary
		$this->summary->ViewValue = $this->summary->CurrentValue;
		$this->summary->ViewCustomAttributes = "";

		// image
		$this->image->ViewValue = $this->image->CurrentValue;
		$this->image->ViewCustomAttributes = "";

			// pageTitle
			$this->pageTitle->LinkCustomAttributes = "";
			$this->pageTitle->HrefValue = "";
			$this->pageTitle->TooltipValue = "";

			// subTitle
			$this->subTitle->LinkCustomAttributes = "";
			$this->subTitle->HrefValue = "";
			$this->subTitle->TooltipValue = "";

			// headerBG
			$this->headerBG->LinkCustomAttributes = "";
			$this->headerBG->UploadPath = 'uploads/pages';
			if (!ew_Empty($this->headerBG->Upload->DbValue)) {
				$this->headerBG->HrefValue = ew_GetFileUploadUrl($this->headerBG, $this->headerBG->Upload->DbValue); // Add prefix/suffix
				$this->headerBG->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->headerBG->HrefValue = ew_FullUrl($this->headerBG->HrefValue, "href");
			} else {
				$this->headerBG->HrefValue = "";
			}
			$this->headerBG->HrefValue2 = $this->headerBG->UploadPath . $this->headerBG->Upload->DbValue;
			$this->headerBG->TooltipValue = "";
			if ($this->headerBG->UseColorbox) {
				if (ew_Empty($this->headerBG->TooltipValue))
					$this->headerBG->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->headerBG->LinkAttrs["data-rel"] = "pages_static_x_headerBG";
				ew_AppendClass($this->headerBG->LinkAttrs["class"], "ewLightbox");
			}

			// summary
			$this->summary->LinkCustomAttributes = "";
			$this->summary->HrefValue = "";
			$this->summary->TooltipValue = "";

			// image
			$this->image->LinkCustomAttributes = "";
			$this->image->HrefValue = "";
			$this->image->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// pageTitle
			$this->pageTitle->EditAttrs["class"] = "form-control";
			$this->pageTitle->EditCustomAttributes = "";
			$this->pageTitle->EditValue = ew_HtmlEncode($this->pageTitle->CurrentValue);
			$this->pageTitle->PlaceHolder = ew_RemoveHtml($this->pageTitle->FldCaption());

			// subTitle
			$this->subTitle->EditAttrs["class"] = "form-control";
			$this->subTitle->EditCustomAttributes = "";
			$this->subTitle->EditValue = ew_HtmlEncode($this->subTitle->CurrentValue);
			$this->subTitle->PlaceHolder = ew_RemoveHtml($this->subTitle->FldCaption());

			// headerBG
			$this->headerBG->EditAttrs["class"] = "form-control";
			$this->headerBG->EditCustomAttributes = "";
			$this->headerBG->UploadPath = 'uploads/pages';
			if (!ew_Empty($this->headerBG->Upload->DbValue)) {
				$this->headerBG->ImageWidth = 100;
				$this->headerBG->ImageHeight = 0;
				$this->headerBG->ImageAlt = $this->headerBG->FldAlt();
				$this->headerBG->EditValue = $this->headerBG->Upload->DbValue;
			} else {
				$this->headerBG->EditValue = "";
			}
			if (!ew_Empty($this->headerBG->CurrentValue))
					$this->headerBG->Upload->FileName = $this->headerBG->CurrentValue;
			if (($this->CurrentAction == "I" || $this->CurrentAction == "C") && !$this->EventCancelled) ew_RenderUploadField($this->headerBG);

			// summary
			$this->summary->EditAttrs["class"] = "form-control";
			$this->summary->EditCustomAttributes = "";
			$this->summary->EditValue = ew_HtmlEncode($this->summary->CurrentValue);
			$this->summary->PlaceHolder = ew_RemoveHtml($this->summary->FldCaption());

			// image
			$this->image->EditAttrs["class"] = "form-control";
			$this->image->EditCustomAttributes = "";
			$this->image->EditValue = ew_HtmlEncode($this->image->CurrentValue);
			$this->image->PlaceHolder = ew_RemoveHtml($this->image->FldCaption());

			// Add refer script
			// pageTitle

			$this->pageTitle->LinkCustomAttributes = "";
			$this->pageTitle->HrefValue = "";

			// subTitle
			$this->subTitle->LinkCustomAttributes = "";
			$this->subTitle->HrefValue = "";

			// headerBG
			$this->headerBG->LinkCustomAttributes = "";
			$this->headerBG->UploadPath = 'uploads/pages';
			if (!ew_Empty($this->headerBG->Upload->DbValue)) {
				$this->headerBG->HrefValue = ew_GetFileUploadUrl($this->headerBG, $this->headerBG->Upload->DbValue); // Add prefix/suffix
				$this->headerBG->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->headerBG->HrefValue = ew_FullUrl($this->headerBG->HrefValue, "href");
			} else {
				$this->headerBG->HrefValue = "";
			}
			$this->headerBG->HrefValue2 = $this->headerBG->UploadPath . $this->headerBG->Upload->DbValue;

			// summary
			$this->summary->LinkCustomAttributes = "";
			$this->summary->HrefValue = "";

			// image
			$this->image->LinkCustomAttributes = "";
			$this->image->HrefValue = "";
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
			$this->headerBG->OldUploadPath = 'uploads/pages';
			$this->headerBG->UploadPath = $this->headerBG->OldUploadPath;
		}
		$rsnew = array();

		// pageTitle
		$this->pageTitle->SetDbValueDef($rsnew, $this->pageTitle->CurrentValue, NULL, FALSE);

		// subTitle
		$this->subTitle->SetDbValueDef($rsnew, $this->subTitle->CurrentValue, NULL, FALSE);

		// headerBG
		if ($this->headerBG->Visible && !$this->headerBG->Upload->KeepFile) {
			$this->headerBG->Upload->DbValue = ""; // No need to delete old file
			if ($this->headerBG->Upload->FileName == "") {
				$rsnew['headerBG'] = NULL;
			} else {
				$rsnew['headerBG'] = $this->headerBG->Upload->FileName;
			}
		}

		// summary
		$this->summary->SetDbValueDef($rsnew, $this->summary->CurrentValue, NULL, FALSE);

		// image
		$this->image->SetDbValueDef($rsnew, $this->image->CurrentValue, NULL, FALSE);
		if ($this->headerBG->Visible && !$this->headerBG->Upload->KeepFile) {
			$this->headerBG->UploadPath = 'uploads/pages';
			$OldFiles = ew_Empty($this->headerBG->Upload->DbValue) ? array() : array($this->headerBG->Upload->DbValue);
			if (!ew_Empty($this->headerBG->Upload->FileName)) {
				$NewFiles = array($this->headerBG->Upload->FileName);
				$NewFileCount = count($NewFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					$fldvar = ($this->headerBG->Upload->Index < 0) ? $this->headerBG->FldVar : substr($this->headerBG->FldVar, 0, 1) . $this->headerBG->Upload->Index . substr($this->headerBG->FldVar, 1);
					if ($NewFiles[$i] <> "") {
						$file = $NewFiles[$i];
						if (file_exists(ew_UploadTempPath($fldvar, $this->headerBG->TblVar) . $file)) {
							$file1 = ew_UploadFileNameEx($this->headerBG->PhysicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(ew_UploadTempPath($fldvar, $this->headerBG->TblVar) . $file1) || file_exists($this->headerBG->PhysicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = ew_UniqueFilename($this->headerBG->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(ew_UploadTempPath($fldvar, $this->headerBG->TblVar) . $file, ew_UploadTempPath($fldvar, $this->headerBG->TblVar) . $file1);
								$NewFiles[$i] = $file1;
							}
						}
					}
				}
				$this->headerBG->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
				$this->headerBG->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
				$this->headerBG->SetDbValueDef($rsnew, $this->headerBG->Upload->FileName, NULL, FALSE);
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
				if ($this->headerBG->Visible && !$this->headerBG->Upload->KeepFile) {
					$OldFiles = ew_Empty($this->headerBG->Upload->DbValue) ? array() : array($this->headerBG->Upload->DbValue);
					if (!ew_Empty($this->headerBG->Upload->FileName)) {
						$NewFiles = array($this->headerBG->Upload->FileName);
						$NewFiles2 = array($rsnew['headerBG']);
						$NewFileCount = count($NewFiles);
						for ($i = 0; $i < $NewFileCount; $i++) {
							$fldvar = ($this->headerBG->Upload->Index < 0) ? $this->headerBG->FldVar : substr($this->headerBG->FldVar, 0, 1) . $this->headerBG->Upload->Index . substr($this->headerBG->FldVar, 1);
							if ($NewFiles[$i] <> "") {
								$file = ew_UploadTempPath($fldvar, $this->headerBG->TblVar) . $NewFiles[$i];
								if (file_exists($file)) {
									if (@$NewFiles2[$i] <> "") // Use correct file name
										$NewFiles[$i] = $NewFiles2[$i];
									if (!$this->headerBG->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
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

		// headerBG
		ew_CleanUploadTempPath($this->headerBG, $this->headerBG->Upload->Index);
		return $AddRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("pages_staticlist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
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
if (!isset($pages_static_add)) $pages_static_add = new cpages_static_add();

// Page init
$pages_static_add->Page_Init();

// Page main
$pages_static_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pages_static_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = fpages_staticadd = new ew_Form("fpages_staticadd", "add");

// Validate form
fpages_staticadd.Validate = function() {
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
fpages_staticadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fpages_staticadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $pages_static_add->ShowPageHeader(); ?>
<?php
$pages_static_add->ShowMessage();
?>
<form name="fpages_staticadd" id="fpages_staticadd" class="<?php echo $pages_static_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($pages_static_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $pages_static_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pages_static">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($pages_static_add->IsModal) ?>">
<div class="ewAddDiv"><!-- page* -->
<?php if ($pages_static->pageTitle->Visible) { // pageTitle ?>
	<div id="r_pageTitle" class="form-group">
		<label id="elh_pages_static_pageTitle" for="x_pageTitle" class="<?php echo $pages_static_add->LeftColumnClass ?>"><?php echo $pages_static->pageTitle->FldCaption() ?></label>
		<div class="<?php echo $pages_static_add->RightColumnClass ?>"><div<?php echo $pages_static->pageTitle->CellAttributes() ?>>
<span id="el_pages_static_pageTitle">
<input type="text" data-table="pages_static" data-field="x_pageTitle" name="x_pageTitle" id="x_pageTitle" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pages_static->pageTitle->getPlaceHolder()) ?>" value="<?php echo $pages_static->pageTitle->EditValue ?>"<?php echo $pages_static->pageTitle->EditAttributes() ?>>
</span>
<?php echo $pages_static->pageTitle->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pages_static->subTitle->Visible) { // subTitle ?>
	<div id="r_subTitle" class="form-group">
		<label id="elh_pages_static_subTitle" for="x_subTitle" class="<?php echo $pages_static_add->LeftColumnClass ?>"><?php echo $pages_static->subTitle->FldCaption() ?></label>
		<div class="<?php echo $pages_static_add->RightColumnClass ?>"><div<?php echo $pages_static->subTitle->CellAttributes() ?>>
<span id="el_pages_static_subTitle">
<input type="text" data-table="pages_static" data-field="x_subTitle" name="x_subTitle" id="x_subTitle" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pages_static->subTitle->getPlaceHolder()) ?>" value="<?php echo $pages_static->subTitle->EditValue ?>"<?php echo $pages_static->subTitle->EditAttributes() ?>>
</span>
<?php echo $pages_static->subTitle->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pages_static->headerBG->Visible) { // headerBG ?>
	<div id="r_headerBG" class="form-group">
		<label id="elh_pages_static_headerBG" class="<?php echo $pages_static_add->LeftColumnClass ?>"><?php echo $pages_static->headerBG->FldCaption() ?></label>
		<div class="<?php echo $pages_static_add->RightColumnClass ?>"><div<?php echo $pages_static->headerBG->CellAttributes() ?>>
<span id="el_pages_static_headerBG">
<div id="fd_x_headerBG">
<span title="<?php echo $pages_static->headerBG->FldTitle() ? $pages_static->headerBG->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($pages_static->headerBG->ReadOnly || $pages_static->headerBG->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="pages_static" data-field="x_headerBG" name="x_headerBG" id="x_headerBG"<?php echo $pages_static->headerBG->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_headerBG" id= "fn_x_headerBG" value="<?php echo $pages_static->headerBG->Upload->FileName ?>">
<input type="hidden" name="fa_x_headerBG" id= "fa_x_headerBG" value="0">
<input type="hidden" name="fs_x_headerBG" id= "fs_x_headerBG" value="255">
<input type="hidden" name="fx_x_headerBG" id= "fx_x_headerBG" value="<?php echo $pages_static->headerBG->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_headerBG" id= "fm_x_headerBG" value="<?php echo $pages_static->headerBG->UploadMaxFileSize ?>">
</div>
<table id="ft_x_headerBG" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $pages_static->headerBG->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pages_static->summary->Visible) { // summary ?>
	<div id="r_summary" class="form-group">
		<label id="elh_pages_static_summary" for="x_summary" class="<?php echo $pages_static_add->LeftColumnClass ?>"><?php echo $pages_static->summary->FldCaption() ?></label>
		<div class="<?php echo $pages_static_add->RightColumnClass ?>"><div<?php echo $pages_static->summary->CellAttributes() ?>>
<span id="el_pages_static_summary">
<textarea data-table="pages_static" data-field="x_summary" name="x_summary" id="x_summary" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($pages_static->summary->getPlaceHolder()) ?>"<?php echo $pages_static->summary->EditAttributes() ?>><?php echo $pages_static->summary->EditValue ?></textarea>
</span>
<?php echo $pages_static->summary->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pages_static->image->Visible) { // image ?>
	<div id="r_image" class="form-group">
		<label id="elh_pages_static_image" for="x_image" class="<?php echo $pages_static_add->LeftColumnClass ?>"><?php echo $pages_static->image->FldCaption() ?></label>
		<div class="<?php echo $pages_static_add->RightColumnClass ?>"><div<?php echo $pages_static->image->CellAttributes() ?>>
<span id="el_pages_static_image">
<input type="text" data-table="pages_static" data-field="x_image" name="x_image" id="x_image" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($pages_static->image->getPlaceHolder()) ?>" value="<?php echo $pages_static->image->EditValue ?>"<?php echo $pages_static->image->EditAttributes() ?>>
</span>
<?php echo $pages_static->image->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$pages_static_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $pages_static_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $pages_static_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fpages_staticadd.Init();
</script>
<?php
$pages_static_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$pages_static_add->Page_Terminate();
?>
