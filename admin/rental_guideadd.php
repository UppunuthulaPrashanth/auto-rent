<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "rental_guideinfo.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$rental_guide_add = NULL; // Initialize page object first

class crental_guide_add extends crental_guide {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'rental_guide';

	// Page object name
	var $PageObjName = 'rental_guide_add';

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

		// Table object (rental_guide)
		if (!isset($GLOBALS["rental_guide"]) || get_class($GLOBALS["rental_guide"]) == "crental_guide") {
			$GLOBALS["rental_guide"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["rental_guide"];
		}

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'rental_guide', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("rental_guidelist.php"));
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
		$this->slug->SetVisibility();
		$this->image->SetVisibility();
		$this->headerImage->SetVisibility();
		$this->description->SetVisibility();
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
		global $EW_EXPORT, $rental_guide;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($rental_guide);
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
					if ($pageName == "rental_guideview.php")
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
			if (@$_GET["rentalGuideID"] != "") {
				$this->rentalGuideID->setQueryStringValue($_GET["rentalGuideID"]);
				$this->setKey("rentalGuideID", $this->rentalGuideID->CurrentValue); // Set up key
			} else {
				$this->setKey("rentalGuideID", ""); // Clear key
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
					$this->Page_Terminate("rental_guidelist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "rental_guidelist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "rental_guideview.php")
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
		$this->headerImage->Upload->Index = $objForm->Index;
		$this->headerImage->Upload->UploadFile();
		$this->headerImage->CurrentValue = $this->headerImage->Upload->FileName;
	}

	// Load default values
	function LoadDefaultValues() {
		$this->rentalGuideID->CurrentValue = NULL;
		$this->rentalGuideID->OldValue = $this->rentalGuideID->CurrentValue;
		$this->title->CurrentValue = NULL;
		$this->title->OldValue = $this->title->CurrentValue;
		$this->subTitle->CurrentValue = NULL;
		$this->subTitle->OldValue = $this->subTitle->CurrentValue;
		$this->slug->CurrentValue = NULL;
		$this->slug->OldValue = $this->slug->CurrentValue;
		$this->image->Upload->DbValue = NULL;
		$this->image->OldValue = $this->image->Upload->DbValue;
		$this->image->CurrentValue = NULL; // Clear file related field
		$this->headerImage->Upload->DbValue = NULL;
		$this->headerImage->OldValue = $this->headerImage->Upload->DbValue;
		$this->headerImage->CurrentValue = NULL; // Clear file related field
		$this->description->CurrentValue = NULL;
		$this->description->OldValue = $this->description->CurrentValue;
		$this->so->CurrentValue = 0;
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
		if (!$this->subTitle->FldIsDetailKey) {
			$this->subTitle->setFormValue($objForm->GetValue("x_subTitle"));
		}
		if (!$this->slug->FldIsDetailKey) {
			$this->slug->setFormValue($objForm->GetValue("x_slug"));
		}
		if (!$this->description->FldIsDetailKey) {
			$this->description->setFormValue($objForm->GetValue("x_description"));
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
		$this->title->CurrentValue = $this->title->FormValue;
		$this->subTitle->CurrentValue = $this->subTitle->FormValue;
		$this->slug->CurrentValue = $this->slug->FormValue;
		$this->description->CurrentValue = $this->description->FormValue;
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
		$this->rentalGuideID->setDbValue($row['rentalGuideID']);
		$this->title->setDbValue($row['title']);
		$this->subTitle->setDbValue($row['subTitle']);
		$this->slug->setDbValue($row['slug']);
		$this->image->Upload->DbValue = $row['image'];
		$this->image->setDbValue($this->image->Upload->DbValue);
		$this->headerImage->Upload->DbValue = $row['headerImage'];
		$this->headerImage->setDbValue($this->headerImage->Upload->DbValue);
		$this->description->setDbValue($row['description']);
		$this->so->setDbValue($row['so']);
		$this->active->setDbValue($row['active']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['rentalGuideID'] = $this->rentalGuideID->CurrentValue;
		$row['title'] = $this->title->CurrentValue;
		$row['subTitle'] = $this->subTitle->CurrentValue;
		$row['slug'] = $this->slug->CurrentValue;
		$row['image'] = $this->image->Upload->DbValue;
		$row['headerImage'] = $this->headerImage->Upload->DbValue;
		$row['description'] = $this->description->CurrentValue;
		$row['so'] = $this->so->CurrentValue;
		$row['active'] = $this->active->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->rentalGuideID->DbValue = $row['rentalGuideID'];
		$this->title->DbValue = $row['title'];
		$this->subTitle->DbValue = $row['subTitle'];
		$this->slug->DbValue = $row['slug'];
		$this->image->Upload->DbValue = $row['image'];
		$this->headerImage->Upload->DbValue = $row['headerImage'];
		$this->description->DbValue = $row['description'];
		$this->so->DbValue = $row['so'];
		$this->active->DbValue = $row['active'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("rentalGuideID")) <> "")
			$this->rentalGuideID->CurrentValue = $this->getKey("rentalGuideID"); // rentalGuideID
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
		// rentalGuideID
		// title
		// subTitle
		// slug
		// image
		// headerImage
		// description
		// so
		// active

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// rentalGuideID
		$this->rentalGuideID->ViewValue = $this->rentalGuideID->CurrentValue;
		$this->rentalGuideID->ViewCustomAttributes = "";

		// title
		$this->title->ViewValue = $this->title->CurrentValue;
		$this->title->ViewCustomAttributes = "";

		// subTitle
		$this->subTitle->ViewValue = $this->subTitle->CurrentValue;
		$this->subTitle->ViewCustomAttributes = "";

		// slug
		$this->slug->ViewValue = $this->slug->CurrentValue;
		$this->slug->ViewCustomAttributes = "";

		// image
		$this->image->UploadPath = 'uploads/rental_guide';
		if (!ew_Empty($this->image->Upload->DbValue)) {
			$this->image->ImageWidth = 100;
			$this->image->ImageHeight = 0;
			$this->image->ImageAlt = $this->image->FldAlt();
			$this->image->ViewValue = $this->image->Upload->DbValue;
		} else {
			$this->image->ViewValue = "";
		}
		$this->image->ViewCustomAttributes = "";

		// headerImage
		$this->headerImage->UploadPath = 'uploads/rental_guide';
		if (!ew_Empty($this->headerImage->Upload->DbValue)) {
			$this->headerImage->ImageWidth = 100;
			$this->headerImage->ImageHeight = 0;
			$this->headerImage->ImageAlt = $this->headerImage->FldAlt();
			$this->headerImage->ViewValue = $this->headerImage->Upload->DbValue;
		} else {
			$this->headerImage->ViewValue = "";
		}
		$this->headerImage->ViewCustomAttributes = "";

		// description
		$this->description->ViewValue = $this->description->CurrentValue;
		$this->description->ViewCustomAttributes = "";

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

			// title
			$this->title->LinkCustomAttributes = "";
			$this->title->HrefValue = "";
			$this->title->TooltipValue = "";

			// subTitle
			$this->subTitle->LinkCustomAttributes = "";
			$this->subTitle->HrefValue = "";
			$this->subTitle->TooltipValue = "";

			// slug
			$this->slug->LinkCustomAttributes = "";
			$this->slug->HrefValue = "";
			$this->slug->TooltipValue = "";

			// image
			$this->image->LinkCustomAttributes = "";
			$this->image->UploadPath = 'uploads/rental_guide';
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
				$this->image->LinkAttrs["data-rel"] = "rental_guide_x_image";
				ew_AppendClass($this->image->LinkAttrs["class"], "ewLightbox");
			}

			// headerImage
			$this->headerImage->LinkCustomAttributes = "";
			$this->headerImage->UploadPath = 'uploads/rental_guide';
			if (!ew_Empty($this->headerImage->Upload->DbValue)) {
				$this->headerImage->HrefValue = ew_GetFileUploadUrl($this->headerImage, $this->headerImage->Upload->DbValue); // Add prefix/suffix
				$this->headerImage->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->headerImage->HrefValue = ew_FullUrl($this->headerImage->HrefValue, "href");
			} else {
				$this->headerImage->HrefValue = "";
			}
			$this->headerImage->HrefValue2 = $this->headerImage->UploadPath . $this->headerImage->Upload->DbValue;
			$this->headerImage->TooltipValue = "";
			if ($this->headerImage->UseColorbox) {
				if (ew_Empty($this->headerImage->TooltipValue))
					$this->headerImage->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->headerImage->LinkAttrs["data-rel"] = "rental_guide_x_headerImage";
				ew_AppendClass($this->headerImage->LinkAttrs["class"], "ewLightbox");
			}

			// description
			$this->description->LinkCustomAttributes = "";
			$this->description->HrefValue = "";
			$this->description->TooltipValue = "";

			// so
			$this->so->LinkCustomAttributes = "";
			$this->so->HrefValue = "";
			$this->so->TooltipValue = "";

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

			// subTitle
			$this->subTitle->EditAttrs["class"] = "form-control";
			$this->subTitle->EditCustomAttributes = "";
			$this->subTitle->EditValue = ew_HtmlEncode($this->subTitle->CurrentValue);
			$this->subTitle->PlaceHolder = ew_RemoveHtml($this->subTitle->FldCaption());

			// slug
			$this->slug->EditAttrs["class"] = "form-control";
			$this->slug->EditCustomAttributes = "";
			$this->slug->EditValue = ew_HtmlEncode($this->slug->CurrentValue);
			$this->slug->PlaceHolder = ew_RemoveHtml($this->slug->FldCaption());

			// image
			$this->image->EditAttrs["class"] = "form-control";
			$this->image->EditCustomAttributes = "";
			$this->image->UploadPath = 'uploads/rental_guide';
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

			// headerImage
			$this->headerImage->EditAttrs["class"] = "form-control";
			$this->headerImage->EditCustomAttributes = "";
			$this->headerImage->UploadPath = 'uploads/rental_guide';
			if (!ew_Empty($this->headerImage->Upload->DbValue)) {
				$this->headerImage->ImageWidth = 100;
				$this->headerImage->ImageHeight = 0;
				$this->headerImage->ImageAlt = $this->headerImage->FldAlt();
				$this->headerImage->EditValue = $this->headerImage->Upload->DbValue;
			} else {
				$this->headerImage->EditValue = "";
			}
			if (!ew_Empty($this->headerImage->CurrentValue))
					$this->headerImage->Upload->FileName = $this->headerImage->CurrentValue;
			if (($this->CurrentAction == "I" || $this->CurrentAction == "C") && !$this->EventCancelled) ew_RenderUploadField($this->headerImage);

			// description
			$this->description->EditAttrs["class"] = "form-control";
			$this->description->EditCustomAttributes = "";
			$this->description->EditValue = ew_HtmlEncode($this->description->CurrentValue);
			$this->description->PlaceHolder = ew_RemoveHtml($this->description->FldCaption());

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
			// title

			$this->title->LinkCustomAttributes = "";
			$this->title->HrefValue = "";

			// subTitle
			$this->subTitle->LinkCustomAttributes = "";
			$this->subTitle->HrefValue = "";

			// slug
			$this->slug->LinkCustomAttributes = "";
			$this->slug->HrefValue = "";

			// image
			$this->image->LinkCustomAttributes = "";
			$this->image->UploadPath = 'uploads/rental_guide';
			if (!ew_Empty($this->image->Upload->DbValue)) {
				$this->image->HrefValue = ew_GetFileUploadUrl($this->image, $this->image->Upload->DbValue); // Add prefix/suffix
				$this->image->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->image->HrefValue = ew_FullUrl($this->image->HrefValue, "href");
			} else {
				$this->image->HrefValue = "";
			}
			$this->image->HrefValue2 = $this->image->UploadPath . $this->image->Upload->DbValue;

			// headerImage
			$this->headerImage->LinkCustomAttributes = "";
			$this->headerImage->UploadPath = 'uploads/rental_guide';
			if (!ew_Empty($this->headerImage->Upload->DbValue)) {
				$this->headerImage->HrefValue = ew_GetFileUploadUrl($this->headerImage, $this->headerImage->Upload->DbValue); // Add prefix/suffix
				$this->headerImage->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->headerImage->HrefValue = ew_FullUrl($this->headerImage->HrefValue, "href");
			} else {
				$this->headerImage->HrefValue = "";
			}
			$this->headerImage->HrefValue2 = $this->headerImage->UploadPath . $this->headerImage->Upload->DbValue;

			// description
			$this->description->LinkCustomAttributes = "";
			$this->description->HrefValue = "";

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
			$this->image->OldUploadPath = 'uploads/rental_guide';
			$this->image->UploadPath = $this->image->OldUploadPath;
			$this->headerImage->OldUploadPath = 'uploads/rental_guide';
			$this->headerImage->UploadPath = $this->headerImage->OldUploadPath;
		}
		$rsnew = array();

		// title
		$this->title->SetDbValueDef($rsnew, $this->title->CurrentValue, NULL, FALSE);

		// subTitle
		$this->subTitle->SetDbValueDef($rsnew, $this->subTitle->CurrentValue, NULL, FALSE);

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

		// headerImage
		if ($this->headerImage->Visible && !$this->headerImage->Upload->KeepFile) {
			$this->headerImage->Upload->DbValue = ""; // No need to delete old file
			if ($this->headerImage->Upload->FileName == "") {
				$rsnew['headerImage'] = NULL;
			} else {
				$rsnew['headerImage'] = $this->headerImage->Upload->FileName;
			}
		}

		// description
		$this->description->SetDbValueDef($rsnew, $this->description->CurrentValue, NULL, FALSE);

		// so
		$this->so->SetDbValueDef($rsnew, $this->so->CurrentValue, NULL, strval($this->so->CurrentValue) == "");

		// active
		$this->active->SetDbValueDef($rsnew, $this->active->CurrentValue, NULL, strval($this->active->CurrentValue) == "");
		if ($this->image->Visible && !$this->image->Upload->KeepFile) {
			$this->image->UploadPath = 'uploads/rental_guide';
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
		if ($this->headerImage->Visible && !$this->headerImage->Upload->KeepFile) {
			$this->headerImage->UploadPath = 'uploads/rental_guide';
			$OldFiles = ew_Empty($this->headerImage->Upload->DbValue) ? array() : array($this->headerImage->Upload->DbValue);
			if (!ew_Empty($this->headerImage->Upload->FileName)) {
				$NewFiles = array($this->headerImage->Upload->FileName);
				$NewFileCount = count($NewFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					$fldvar = ($this->headerImage->Upload->Index < 0) ? $this->headerImage->FldVar : substr($this->headerImage->FldVar, 0, 1) . $this->headerImage->Upload->Index . substr($this->headerImage->FldVar, 1);
					if ($NewFiles[$i] <> "") {
						$file = $NewFiles[$i];
						if (file_exists(ew_UploadTempPath($fldvar, $this->headerImage->TblVar) . $file)) {
							$file1 = ew_UploadFileNameEx($this->headerImage->PhysicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(ew_UploadTempPath($fldvar, $this->headerImage->TblVar) . $file1) || file_exists($this->headerImage->PhysicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = ew_UniqueFilename($this->headerImage->PhysicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(ew_UploadTempPath($fldvar, $this->headerImage->TblVar) . $file, ew_UploadTempPath($fldvar, $this->headerImage->TblVar) . $file1);
								$NewFiles[$i] = $file1;
							}
						}
					}
				}
				$this->headerImage->Upload->DbValue = empty($OldFiles) ? "" : implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $OldFiles);
				$this->headerImage->Upload->FileName = implode(EW_MULTIPLE_UPLOAD_SEPARATOR, $NewFiles);
				$this->headerImage->SetDbValueDef($rsnew, $this->headerImage->Upload->FileName, NULL, FALSE);
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
				if ($this->headerImage->Visible && !$this->headerImage->Upload->KeepFile) {
					$OldFiles = ew_Empty($this->headerImage->Upload->DbValue) ? array() : array($this->headerImage->Upload->DbValue);
					if (!ew_Empty($this->headerImage->Upload->FileName)) {
						$NewFiles = array($this->headerImage->Upload->FileName);
						$NewFiles2 = array($rsnew['headerImage']);
						$NewFileCount = count($NewFiles);
						for ($i = 0; $i < $NewFileCount; $i++) {
							$fldvar = ($this->headerImage->Upload->Index < 0) ? $this->headerImage->FldVar : substr($this->headerImage->FldVar, 0, 1) . $this->headerImage->Upload->Index . substr($this->headerImage->FldVar, 1);
							if ($NewFiles[$i] <> "") {
								$file = ew_UploadTempPath($fldvar, $this->headerImage->TblVar) . $NewFiles[$i];
								if (file_exists($file)) {
									if (@$NewFiles2[$i] <> "") // Use correct file name
										$NewFiles[$i] = $NewFiles2[$i];
									if (!$this->headerImage->Upload->SaveToFile($NewFiles[$i], TRUE, $i)) { // Just replace
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

		// headerImage
		ew_CleanUploadTempPath($this->headerImage, $this->headerImage->Upload->Index);
		return $AddRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("rental_guidelist.php"), "", $this->TableVar, TRUE);
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
if (!isset($rental_guide_add)) $rental_guide_add = new crental_guide_add();

// Page init
$rental_guide_add->Page_Init();

// Page main
$rental_guide_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rental_guide_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = frental_guideadd = new ew_Form("frental_guideadd", "add");

// Validate form
frental_guideadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_so");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rental_guide->so->FldErrMsg()) ?>");

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
frental_guideadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frental_guideadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Multi-Page
frental_guideadd.MultiPage = new ew_MultiPage("frental_guideadd");

// Dynamic selection lists
frental_guideadd.Lists["x_active"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
frental_guideadd.Lists["x_active"].Options = <?php echo json_encode($rental_guide_add->active->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $rental_guide_add->ShowPageHeader(); ?>
<?php
$rental_guide_add->ShowMessage();
?>
<form name="frental_guideadd" id="frental_guideadd" class="<?php echo $rental_guide_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($rental_guide_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $rental_guide_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rental_guide">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($rental_guide_add->IsModal) ?>">
<div class="ewMultiPage"><!-- multi-page -->
<div class="nav-tabs-custom" id="rental_guide_add"><!-- multi-page .nav-tabs-custom -->
	<ul class="nav<?php echo $rental_guide_add->MultiPages->NavStyle() ?>">
		<li<?php echo $rental_guide_add->MultiPages->TabStyle("1") ?>><a href="#tab_rental_guide1" data-toggle="tab"><?php echo $rental_guide->PageCaption(1) ?></a></li>
		<li<?php echo $rental_guide_add->MultiPages->TabStyle("2") ?>><a href="#tab_rental_guide2" data-toggle="tab"><?php echo $rental_guide->PageCaption(2) ?></a></li>
		<li<?php echo $rental_guide_add->MultiPages->TabStyle("3") ?>><a href="#tab_rental_guide3" data-toggle="tab"><?php echo $rental_guide->PageCaption(3) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page .nav-tabs-custom .tab-content -->
		<div class="tab-pane<?php echo $rental_guide_add->MultiPages->PageStyle("1") ?>" id="tab_rental_guide1"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($rental_guide->title->Visible) { // title ?>
	<div id="r_title" class="form-group">
		<label id="elh_rental_guide_title" for="x_title" class="<?php echo $rental_guide_add->LeftColumnClass ?>"><?php echo $rental_guide->title->FldCaption() ?></label>
		<div class="<?php echo $rental_guide_add->RightColumnClass ?>"><div<?php echo $rental_guide->title->CellAttributes() ?>>
<span id="el_rental_guide_title">
<input type="text" data-table="rental_guide" data-field="x_title" data-page="1" name="x_title" id="x_title" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($rental_guide->title->getPlaceHolder()) ?>" value="<?php echo $rental_guide->title->EditValue ?>"<?php echo $rental_guide->title->EditAttributes() ?>>
</span>
<?php echo $rental_guide->title->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rental_guide->subTitle->Visible) { // subTitle ?>
	<div id="r_subTitle" class="form-group">
		<label id="elh_rental_guide_subTitle" for="x_subTitle" class="<?php echo $rental_guide_add->LeftColumnClass ?>"><?php echo $rental_guide->subTitle->FldCaption() ?></label>
		<div class="<?php echo $rental_guide_add->RightColumnClass ?>"><div<?php echo $rental_guide->subTitle->CellAttributes() ?>>
<span id="el_rental_guide_subTitle">
<input type="text" data-table="rental_guide" data-field="x_subTitle" data-page="1" name="x_subTitle" id="x_subTitle" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($rental_guide->subTitle->getPlaceHolder()) ?>" value="<?php echo $rental_guide->subTitle->EditValue ?>"<?php echo $rental_guide->subTitle->EditAttributes() ?>>
</span>
<?php echo $rental_guide->subTitle->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rental_guide->slug->Visible) { // slug ?>
	<div id="r_slug" class="form-group">
		<label id="elh_rental_guide_slug" for="x_slug" class="<?php echo $rental_guide_add->LeftColumnClass ?>"><?php echo $rental_guide->slug->FldCaption() ?></label>
		<div class="<?php echo $rental_guide_add->RightColumnClass ?>"><div<?php echo $rental_guide->slug->CellAttributes() ?>>
<span id="el_rental_guide_slug">
<input type="text" data-table="rental_guide" data-field="x_slug" data-page="1" name="x_slug" id="x_slug" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($rental_guide->slug->getPlaceHolder()) ?>" value="<?php echo $rental_guide->slug->EditValue ?>"<?php echo $rental_guide->slug->EditAttributes() ?>>
</span>
<?php echo $rental_guide->slug->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rental_guide->so->Visible) { // so ?>
	<div id="r_so" class="form-group">
		<label id="elh_rental_guide_so" for="x_so" class="<?php echo $rental_guide_add->LeftColumnClass ?>"><?php echo $rental_guide->so->FldCaption() ?></label>
		<div class="<?php echo $rental_guide_add->RightColumnClass ?>"><div<?php echo $rental_guide->so->CellAttributes() ?>>
<span id="el_rental_guide_so">
<input type="text" data-table="rental_guide" data-field="x_so" data-page="1" name="x_so" id="x_so" size="30" placeholder="<?php echo ew_HtmlEncode($rental_guide->so->getPlaceHolder()) ?>" value="<?php echo $rental_guide->so->EditValue ?>"<?php echo $rental_guide->so->EditAttributes() ?>>
</span>
<?php echo $rental_guide->so->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rental_guide->active->Visible) { // active ?>
	<div id="r_active" class="form-group">
		<label id="elh_rental_guide_active" for="x_active" class="<?php echo $rental_guide_add->LeftColumnClass ?>"><?php echo $rental_guide->active->FldCaption() ?></label>
		<div class="<?php echo $rental_guide_add->RightColumnClass ?>"><div<?php echo $rental_guide->active->CellAttributes() ?>>
<span id="el_rental_guide_active">
<select data-table="rental_guide" data-field="x_active" data-page="1" data-value-separator="<?php echo $rental_guide->active->DisplayValueSeparatorAttribute() ?>" id="x_active" name="x_active"<?php echo $rental_guide->active->EditAttributes() ?>>
<?php echo $rental_guide->active->SelectOptionListHtml("x_active") ?>
</select>
</span>
<?php echo $rental_guide->active->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $rental_guide_add->MultiPages->PageStyle("2") ?>" id="tab_rental_guide2"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($rental_guide->image->Visible) { // image ?>
	<div id="r_image" class="form-group">
		<label id="elh_rental_guide_image" class="<?php echo $rental_guide_add->LeftColumnClass ?>"><?php echo $rental_guide->image->FldCaption() ?></label>
		<div class="<?php echo $rental_guide_add->RightColumnClass ?>"><div<?php echo $rental_guide->image->CellAttributes() ?>>
<span id="el_rental_guide_image">
<div id="fd_x_image">
<span title="<?php echo $rental_guide->image->FldTitle() ? $rental_guide->image->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($rental_guide->image->ReadOnly || $rental_guide->image->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="rental_guide" data-field="x_image" data-page="2" name="x_image" id="x_image"<?php echo $rental_guide->image->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_image" id= "fn_x_image" value="<?php echo $rental_guide->image->Upload->FileName ?>">
<input type="hidden" name="fa_x_image" id= "fa_x_image" value="0">
<input type="hidden" name="fs_x_image" id= "fs_x_image" value="255">
<input type="hidden" name="fx_x_image" id= "fx_x_image" value="<?php echo $rental_guide->image->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_image" id= "fm_x_image" value="<?php echo $rental_guide->image->UploadMaxFileSize ?>">
</div>
<table id="ft_x_image" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $rental_guide->image->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rental_guide->headerImage->Visible) { // headerImage ?>
	<div id="r_headerImage" class="form-group">
		<label id="elh_rental_guide_headerImage" class="<?php echo $rental_guide_add->LeftColumnClass ?>"><?php echo $rental_guide->headerImage->FldCaption() ?></label>
		<div class="<?php echo $rental_guide_add->RightColumnClass ?>"><div<?php echo $rental_guide->headerImage->CellAttributes() ?>>
<span id="el_rental_guide_headerImage">
<div id="fd_x_headerImage">
<span title="<?php echo $rental_guide->headerImage->FldTitle() ? $rental_guide->headerImage->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($rental_guide->headerImage->ReadOnly || $rental_guide->headerImage->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="rental_guide" data-field="x_headerImage" data-page="2" name="x_headerImage" id="x_headerImage"<?php echo $rental_guide->headerImage->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_headerImage" id= "fn_x_headerImage" value="<?php echo $rental_guide->headerImage->Upload->FileName ?>">
<input type="hidden" name="fa_x_headerImage" id= "fa_x_headerImage" value="0">
<input type="hidden" name="fs_x_headerImage" id= "fs_x_headerImage" value="255">
<input type="hidden" name="fx_x_headerImage" id= "fx_x_headerImage" value="<?php echo $rental_guide->headerImage->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_headerImage" id= "fm_x_headerImage" value="<?php echo $rental_guide->headerImage->UploadMaxFileSize ?>">
</div>
<table id="ft_x_headerImage" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $rental_guide->headerImage->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $rental_guide_add->MultiPages->PageStyle("3") ?>" id="tab_rental_guide3"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($rental_guide->description->Visible) { // description ?>
	<div id="r_description" class="form-group">
		<label id="elh_rental_guide_description" class="<?php echo $rental_guide_add->LeftColumnClass ?>"><?php echo $rental_guide->description->FldCaption() ?></label>
		<div class="<?php echo $rental_guide_add->RightColumnClass ?>"><div<?php echo $rental_guide->description->CellAttributes() ?>>
<span id="el_rental_guide_description">
<?php ew_AppendClass($rental_guide->description->EditAttrs["class"], "editor"); ?>
<textarea data-table="rental_guide" data-field="x_description" data-page="3" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($rental_guide->description->getPlaceHolder()) ?>"<?php echo $rental_guide->description->EditAttributes() ?>><?php echo $rental_guide->description->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("frental_guideadd", "x_description", 35, 4, <?php echo ($rental_guide->description->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $rental_guide->description->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page .nav-tabs-custom .tab-content -->
</div><!-- /multi-page .nav-tabs-custom -->
</div><!-- /multi-page -->
<?php if (!$rental_guide_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $rental_guide_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $rental_guide_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
frental_guideadd.Init();
</script>
<?php
$rental_guide_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$rental_guide_add->Page_Terminate();
?>
