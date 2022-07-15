<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "inb_rent_cars_enquiryinfo.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$inb_rent_cars_enquiry_add = NULL; // Initialize page object first

class cinb_rent_cars_enquiry_add extends cinb_rent_cars_enquiry {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'inb_rent_cars_enquiry';

	// Page object name
	var $PageObjName = 'inb_rent_cars_enquiry_add';

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

		// Table object (inb_rent_cars_enquiry)
		if (!isset($GLOBALS["inb_rent_cars_enquiry"]) || get_class($GLOBALS["inb_rent_cars_enquiry"]) == "cinb_rent_cars_enquiry") {
			$GLOBALS["inb_rent_cars_enquiry"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["inb_rent_cars_enquiry"];
		}

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'inb_rent_cars_enquiry', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("inb_rent_cars_enquirylist.php"));
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
		$this->carTitle->SetVisibility();
		$this->fullName->SetVisibility();
		$this->companyName->SetVisibility();
		$this->email->SetVisibility();
		$this->phone->SetVisibility();
		$this->specificRequirement->SetVisibility();
		$this->dateCreted->SetVisibility();

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
		global $EW_EXPORT, $inb_rent_cars_enquiry;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($inb_rent_cars_enquiry);
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
					if ($pageName == "inb_rent_cars_enquiryview.php")
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
			if (@$_GET["enquiryID"] != "") {
				$this->enquiryID->setQueryStringValue($_GET["enquiryID"]);
				$this->setKey("enquiryID", $this->enquiryID->CurrentValue); // Set up key
			} else {
				$this->setKey("enquiryID", ""); // Clear key
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
					$this->Page_Terminate("inb_rent_cars_enquirylist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "inb_rent_cars_enquirylist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "inb_rent_cars_enquiryview.php")
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
		$this->enquiryID->CurrentValue = NULL;
		$this->enquiryID->OldValue = $this->enquiryID->CurrentValue;
		$this->carTitle->CurrentValue = NULL;
		$this->carTitle->OldValue = $this->carTitle->CurrentValue;
		$this->fullName->CurrentValue = NULL;
		$this->fullName->OldValue = $this->fullName->CurrentValue;
		$this->companyName->CurrentValue = NULL;
		$this->companyName->OldValue = $this->companyName->CurrentValue;
		$this->email->CurrentValue = NULL;
		$this->email->OldValue = $this->email->CurrentValue;
		$this->phone->CurrentValue = NULL;
		$this->phone->OldValue = $this->phone->CurrentValue;
		$this->specificRequirement->CurrentValue = NULL;
		$this->specificRequirement->OldValue = $this->specificRequirement->CurrentValue;
		$this->dateCreted->CurrentValue = NULL;
		$this->dateCreted->OldValue = $this->dateCreted->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->carTitle->FldIsDetailKey) {
			$this->carTitle->setFormValue($objForm->GetValue("x_carTitle"));
		}
		if (!$this->fullName->FldIsDetailKey) {
			$this->fullName->setFormValue($objForm->GetValue("x_fullName"));
		}
		if (!$this->companyName->FldIsDetailKey) {
			$this->companyName->setFormValue($objForm->GetValue("x_companyName"));
		}
		if (!$this->email->FldIsDetailKey) {
			$this->email->setFormValue($objForm->GetValue("x_email"));
		}
		if (!$this->phone->FldIsDetailKey) {
			$this->phone->setFormValue($objForm->GetValue("x_phone"));
		}
		if (!$this->specificRequirement->FldIsDetailKey) {
			$this->specificRequirement->setFormValue($objForm->GetValue("x_specificRequirement"));
		}
		if (!$this->dateCreted->FldIsDetailKey) {
			$this->dateCreted->setFormValue($objForm->GetValue("x_dateCreted"));
			$this->dateCreted->CurrentValue = ew_UnFormatDateTime($this->dateCreted->CurrentValue, 7);
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->carTitle->CurrentValue = $this->carTitle->FormValue;
		$this->fullName->CurrentValue = $this->fullName->FormValue;
		$this->companyName->CurrentValue = $this->companyName->FormValue;
		$this->email->CurrentValue = $this->email->FormValue;
		$this->phone->CurrentValue = $this->phone->FormValue;
		$this->specificRequirement->CurrentValue = $this->specificRequirement->FormValue;
		$this->dateCreted->CurrentValue = $this->dateCreted->FormValue;
		$this->dateCreted->CurrentValue = ew_UnFormatDateTime($this->dateCreted->CurrentValue, 7);
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
		$this->enquiryID->setDbValue($row['enquiryID']);
		$this->carTitle->setDbValue($row['carTitle']);
		$this->fullName->setDbValue($row['fullName']);
		$this->companyName->setDbValue($row['companyName']);
		$this->email->setDbValue($row['email']);
		$this->phone->setDbValue($row['phone']);
		$this->specificRequirement->setDbValue($row['specificRequirement']);
		$this->dateCreted->setDbValue($row['dateCreted']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['enquiryID'] = $this->enquiryID->CurrentValue;
		$row['carTitle'] = $this->carTitle->CurrentValue;
		$row['fullName'] = $this->fullName->CurrentValue;
		$row['companyName'] = $this->companyName->CurrentValue;
		$row['email'] = $this->email->CurrentValue;
		$row['phone'] = $this->phone->CurrentValue;
		$row['specificRequirement'] = $this->specificRequirement->CurrentValue;
		$row['dateCreted'] = $this->dateCreted->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->enquiryID->DbValue = $row['enquiryID'];
		$this->carTitle->DbValue = $row['carTitle'];
		$this->fullName->DbValue = $row['fullName'];
		$this->companyName->DbValue = $row['companyName'];
		$this->email->DbValue = $row['email'];
		$this->phone->DbValue = $row['phone'];
		$this->specificRequirement->DbValue = $row['specificRequirement'];
		$this->dateCreted->DbValue = $row['dateCreted'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("enquiryID")) <> "")
			$this->enquiryID->CurrentValue = $this->getKey("enquiryID"); // enquiryID
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
		// enquiryID
		// carTitle
		// fullName
		// companyName
		// email
		// phone
		// specificRequirement
		// dateCreted

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// enquiryID
		$this->enquiryID->ViewValue = $this->enquiryID->CurrentValue;
		$this->enquiryID->ViewCustomAttributes = "";

		// carTitle
		$this->carTitle->ViewValue = $this->carTitle->CurrentValue;
		$this->carTitle->ViewCustomAttributes = "";

		// fullName
		$this->fullName->ViewValue = $this->fullName->CurrentValue;
		$this->fullName->ViewCustomAttributes = "";

		// companyName
		$this->companyName->ViewValue = $this->companyName->CurrentValue;
		$this->companyName->ViewCustomAttributes = "";

		// email
		$this->email->ViewValue = $this->email->CurrentValue;
		$this->email->ViewCustomAttributes = "";

		// phone
		$this->phone->ViewValue = $this->phone->CurrentValue;
		$this->phone->ViewCustomAttributes = "";

		// specificRequirement
		$this->specificRequirement->ViewValue = $this->specificRequirement->CurrentValue;
		$this->specificRequirement->ViewCustomAttributes = "";

		// dateCreted
		$this->dateCreted->ViewValue = $this->dateCreted->CurrentValue;
		$this->dateCreted->ViewValue = ew_FormatDateTime($this->dateCreted->ViewValue, 7);
		$this->dateCreted->ViewCustomAttributes = "";

			// carTitle
			$this->carTitle->LinkCustomAttributes = "";
			$this->carTitle->HrefValue = "";
			$this->carTitle->TooltipValue = "";

			// fullName
			$this->fullName->LinkCustomAttributes = "";
			$this->fullName->HrefValue = "";
			$this->fullName->TooltipValue = "";

			// companyName
			$this->companyName->LinkCustomAttributes = "";
			$this->companyName->HrefValue = "";
			$this->companyName->TooltipValue = "";

			// email
			$this->email->LinkCustomAttributes = "";
			$this->email->HrefValue = "";
			$this->email->TooltipValue = "";

			// phone
			$this->phone->LinkCustomAttributes = "";
			$this->phone->HrefValue = "";
			$this->phone->TooltipValue = "";

			// specificRequirement
			$this->specificRequirement->LinkCustomAttributes = "";
			$this->specificRequirement->HrefValue = "";
			$this->specificRequirement->TooltipValue = "";

			// dateCreted
			$this->dateCreted->LinkCustomAttributes = "";
			$this->dateCreted->HrefValue = "";
			$this->dateCreted->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// carTitle
			$this->carTitle->EditAttrs["class"] = "form-control";
			$this->carTitle->EditCustomAttributes = "";
			$this->carTitle->EditValue = ew_HtmlEncode($this->carTitle->CurrentValue);
			$this->carTitle->PlaceHolder = ew_RemoveHtml($this->carTitle->FldCaption());

			// fullName
			$this->fullName->EditAttrs["class"] = "form-control";
			$this->fullName->EditCustomAttributes = "";
			$this->fullName->EditValue = ew_HtmlEncode($this->fullName->CurrentValue);
			$this->fullName->PlaceHolder = ew_RemoveHtml($this->fullName->FldCaption());

			// companyName
			$this->companyName->EditAttrs["class"] = "form-control";
			$this->companyName->EditCustomAttributes = "";
			$this->companyName->EditValue = ew_HtmlEncode($this->companyName->CurrentValue);
			$this->companyName->PlaceHolder = ew_RemoveHtml($this->companyName->FldCaption());

			// email
			$this->email->EditAttrs["class"] = "form-control";
			$this->email->EditCustomAttributes = "";
			$this->email->EditValue = ew_HtmlEncode($this->email->CurrentValue);
			$this->email->PlaceHolder = ew_RemoveHtml($this->email->FldCaption());

			// phone
			$this->phone->EditAttrs["class"] = "form-control";
			$this->phone->EditCustomAttributes = "";
			$this->phone->EditValue = ew_HtmlEncode($this->phone->CurrentValue);
			$this->phone->PlaceHolder = ew_RemoveHtml($this->phone->FldCaption());

			// specificRequirement
			$this->specificRequirement->EditAttrs["class"] = "form-control";
			$this->specificRequirement->EditCustomAttributes = "";
			$this->specificRequirement->EditValue = ew_HtmlEncode($this->specificRequirement->CurrentValue);
			$this->specificRequirement->PlaceHolder = ew_RemoveHtml($this->specificRequirement->FldCaption());

			// dateCreted
			$this->dateCreted->EditAttrs["class"] = "form-control";
			$this->dateCreted->EditCustomAttributes = "";
			$this->dateCreted->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->dateCreted->CurrentValue, 7));
			$this->dateCreted->PlaceHolder = ew_RemoveHtml($this->dateCreted->FldCaption());

			// Add refer script
			// carTitle

			$this->carTitle->LinkCustomAttributes = "";
			$this->carTitle->HrefValue = "";

			// fullName
			$this->fullName->LinkCustomAttributes = "";
			$this->fullName->HrefValue = "";

			// companyName
			$this->companyName->LinkCustomAttributes = "";
			$this->companyName->HrefValue = "";

			// email
			$this->email->LinkCustomAttributes = "";
			$this->email->HrefValue = "";

			// phone
			$this->phone->LinkCustomAttributes = "";
			$this->phone->HrefValue = "";

			// specificRequirement
			$this->specificRequirement->LinkCustomAttributes = "";
			$this->specificRequirement->HrefValue = "";

			// dateCreted
			$this->dateCreted->LinkCustomAttributes = "";
			$this->dateCreted->HrefValue = "";
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
		if (!ew_CheckEuroDate($this->dateCreted->FormValue)) {
			ew_AddMessage($gsFormError, $this->dateCreted->FldErrMsg());
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

		// carTitle
		$this->carTitle->SetDbValueDef($rsnew, $this->carTitle->CurrentValue, NULL, FALSE);

		// fullName
		$this->fullName->SetDbValueDef($rsnew, $this->fullName->CurrentValue, NULL, FALSE);

		// companyName
		$this->companyName->SetDbValueDef($rsnew, $this->companyName->CurrentValue, NULL, FALSE);

		// email
		$this->email->SetDbValueDef($rsnew, $this->email->CurrentValue, NULL, FALSE);

		// phone
		$this->phone->SetDbValueDef($rsnew, $this->phone->CurrentValue, NULL, FALSE);

		// specificRequirement
		$this->specificRequirement->SetDbValueDef($rsnew, $this->specificRequirement->CurrentValue, NULL, FALSE);

		// dateCreted
		$this->dateCreted->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->dateCreted->CurrentValue, 7), NULL, FALSE);

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("inb_rent_cars_enquirylist.php"), "", $this->TableVar, TRUE);
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
if (!isset($inb_rent_cars_enquiry_add)) $inb_rent_cars_enquiry_add = new cinb_rent_cars_enquiry_add();

// Page init
$inb_rent_cars_enquiry_add->Page_Init();

// Page main
$inb_rent_cars_enquiry_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inb_rent_cars_enquiry_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = finb_rent_cars_enquiryadd = new ew_Form("finb_rent_cars_enquiryadd", "add");

// Validate form
finb_rent_cars_enquiryadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_dateCreted");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($inb_rent_cars_enquiry->dateCreted->FldErrMsg()) ?>");

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
finb_rent_cars_enquiryadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
finb_rent_cars_enquiryadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $inb_rent_cars_enquiry_add->ShowPageHeader(); ?>
<?php
$inb_rent_cars_enquiry_add->ShowMessage();
?>
<form name="finb_rent_cars_enquiryadd" id="finb_rent_cars_enquiryadd" class="<?php echo $inb_rent_cars_enquiry_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($inb_rent_cars_enquiry_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $inb_rent_cars_enquiry_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inb_rent_cars_enquiry">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($inb_rent_cars_enquiry_add->IsModal) ?>">
<div class="ewAddDiv"><!-- page* -->
<?php if ($inb_rent_cars_enquiry->carTitle->Visible) { // carTitle ?>
	<div id="r_carTitle" class="form-group">
		<label id="elh_inb_rent_cars_enquiry_carTitle" for="x_carTitle" class="<?php echo $inb_rent_cars_enquiry_add->LeftColumnClass ?>"><?php echo $inb_rent_cars_enquiry->carTitle->FldCaption() ?></label>
		<div class="<?php echo $inb_rent_cars_enquiry_add->RightColumnClass ?>"><div<?php echo $inb_rent_cars_enquiry->carTitle->CellAttributes() ?>>
<span id="el_inb_rent_cars_enquiry_carTitle">
<input type="text" data-table="inb_rent_cars_enquiry" data-field="x_carTitle" name="x_carTitle" id="x_carTitle" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_rent_cars_enquiry->carTitle->getPlaceHolder()) ?>" value="<?php echo $inb_rent_cars_enquiry->carTitle->EditValue ?>"<?php echo $inb_rent_cars_enquiry->carTitle->EditAttributes() ?>>
</span>
<?php echo $inb_rent_cars_enquiry->carTitle->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_rent_cars_enquiry->fullName->Visible) { // fullName ?>
	<div id="r_fullName" class="form-group">
		<label id="elh_inb_rent_cars_enquiry_fullName" for="x_fullName" class="<?php echo $inb_rent_cars_enquiry_add->LeftColumnClass ?>"><?php echo $inb_rent_cars_enquiry->fullName->FldCaption() ?></label>
		<div class="<?php echo $inb_rent_cars_enquiry_add->RightColumnClass ?>"><div<?php echo $inb_rent_cars_enquiry->fullName->CellAttributes() ?>>
<span id="el_inb_rent_cars_enquiry_fullName">
<input type="text" data-table="inb_rent_cars_enquiry" data-field="x_fullName" name="x_fullName" id="x_fullName" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_rent_cars_enquiry->fullName->getPlaceHolder()) ?>" value="<?php echo $inb_rent_cars_enquiry->fullName->EditValue ?>"<?php echo $inb_rent_cars_enquiry->fullName->EditAttributes() ?>>
</span>
<?php echo $inb_rent_cars_enquiry->fullName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_rent_cars_enquiry->companyName->Visible) { // companyName ?>
	<div id="r_companyName" class="form-group">
		<label id="elh_inb_rent_cars_enquiry_companyName" for="x_companyName" class="<?php echo $inb_rent_cars_enquiry_add->LeftColumnClass ?>"><?php echo $inb_rent_cars_enquiry->companyName->FldCaption() ?></label>
		<div class="<?php echo $inb_rent_cars_enquiry_add->RightColumnClass ?>"><div<?php echo $inb_rent_cars_enquiry->companyName->CellAttributes() ?>>
<span id="el_inb_rent_cars_enquiry_companyName">
<input type="text" data-table="inb_rent_cars_enquiry" data-field="x_companyName" name="x_companyName" id="x_companyName" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_rent_cars_enquiry->companyName->getPlaceHolder()) ?>" value="<?php echo $inb_rent_cars_enquiry->companyName->EditValue ?>"<?php echo $inb_rent_cars_enquiry->companyName->EditAttributes() ?>>
</span>
<?php echo $inb_rent_cars_enquiry->companyName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_rent_cars_enquiry->email->Visible) { // email ?>
	<div id="r_email" class="form-group">
		<label id="elh_inb_rent_cars_enquiry_email" for="x_email" class="<?php echo $inb_rent_cars_enquiry_add->LeftColumnClass ?>"><?php echo $inb_rent_cars_enquiry->email->FldCaption() ?></label>
		<div class="<?php echo $inb_rent_cars_enquiry_add->RightColumnClass ?>"><div<?php echo $inb_rent_cars_enquiry->email->CellAttributes() ?>>
<span id="el_inb_rent_cars_enquiry_email">
<input type="text" data-table="inb_rent_cars_enquiry" data-field="x_email" name="x_email" id="x_email" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_rent_cars_enquiry->email->getPlaceHolder()) ?>" value="<?php echo $inb_rent_cars_enquiry->email->EditValue ?>"<?php echo $inb_rent_cars_enquiry->email->EditAttributes() ?>>
</span>
<?php echo $inb_rent_cars_enquiry->email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_rent_cars_enquiry->phone->Visible) { // phone ?>
	<div id="r_phone" class="form-group">
		<label id="elh_inb_rent_cars_enquiry_phone" for="x_phone" class="<?php echo $inb_rent_cars_enquiry_add->LeftColumnClass ?>"><?php echo $inb_rent_cars_enquiry->phone->FldCaption() ?></label>
		<div class="<?php echo $inb_rent_cars_enquiry_add->RightColumnClass ?>"><div<?php echo $inb_rent_cars_enquiry->phone->CellAttributes() ?>>
<span id="el_inb_rent_cars_enquiry_phone">
<input type="text" data-table="inb_rent_cars_enquiry" data-field="x_phone" name="x_phone" id="x_phone" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_rent_cars_enquiry->phone->getPlaceHolder()) ?>" value="<?php echo $inb_rent_cars_enquiry->phone->EditValue ?>"<?php echo $inb_rent_cars_enquiry->phone->EditAttributes() ?>>
</span>
<?php echo $inb_rent_cars_enquiry->phone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_rent_cars_enquiry->specificRequirement->Visible) { // specificRequirement ?>
	<div id="r_specificRequirement" class="form-group">
		<label id="elh_inb_rent_cars_enquiry_specificRequirement" for="x_specificRequirement" class="<?php echo $inb_rent_cars_enquiry_add->LeftColumnClass ?>"><?php echo $inb_rent_cars_enquiry->specificRequirement->FldCaption() ?></label>
		<div class="<?php echo $inb_rent_cars_enquiry_add->RightColumnClass ?>"><div<?php echo $inb_rent_cars_enquiry->specificRequirement->CellAttributes() ?>>
<span id="el_inb_rent_cars_enquiry_specificRequirement">
<textarea data-table="inb_rent_cars_enquiry" data-field="x_specificRequirement" name="x_specificRequirement" id="x_specificRequirement" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($inb_rent_cars_enquiry->specificRequirement->getPlaceHolder()) ?>"<?php echo $inb_rent_cars_enquiry->specificRequirement->EditAttributes() ?>><?php echo $inb_rent_cars_enquiry->specificRequirement->EditValue ?></textarea>
</span>
<?php echo $inb_rent_cars_enquiry->specificRequirement->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_rent_cars_enquiry->dateCreted->Visible) { // dateCreted ?>
	<div id="r_dateCreted" class="form-group">
		<label id="elh_inb_rent_cars_enquiry_dateCreted" for="x_dateCreted" class="<?php echo $inb_rent_cars_enquiry_add->LeftColumnClass ?>"><?php echo $inb_rent_cars_enquiry->dateCreted->FldCaption() ?></label>
		<div class="<?php echo $inb_rent_cars_enquiry_add->RightColumnClass ?>"><div<?php echo $inb_rent_cars_enquiry->dateCreted->CellAttributes() ?>>
<span id="el_inb_rent_cars_enquiry_dateCreted">
<input type="text" data-table="inb_rent_cars_enquiry" data-field="x_dateCreted" data-format="7" name="x_dateCreted" id="x_dateCreted" placeholder="<?php echo ew_HtmlEncode($inb_rent_cars_enquiry->dateCreted->getPlaceHolder()) ?>" value="<?php echo $inb_rent_cars_enquiry->dateCreted->EditValue ?>"<?php echo $inb_rent_cars_enquiry->dateCreted->EditAttributes() ?>>
<?php if (!$inb_rent_cars_enquiry->dateCreted->ReadOnly && !$inb_rent_cars_enquiry->dateCreted->Disabled && !isset($inb_rent_cars_enquiry->dateCreted->EditAttrs["readonly"]) && !isset($inb_rent_cars_enquiry->dateCreted->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("finb_rent_cars_enquiryadd", "x_dateCreted", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php echo $inb_rent_cars_enquiry->dateCreted->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$inb_rent_cars_enquiry_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $inb_rent_cars_enquiry_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $inb_rent_cars_enquiry_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
finb_rent_cars_enquiryadd.Init();
</script>
<?php
$inb_rent_cars_enquiry_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$inb_rent_cars_enquiry_add->Page_Terminate();
?>
