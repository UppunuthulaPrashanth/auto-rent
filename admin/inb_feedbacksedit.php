<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "inb_feedbacksinfo.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$inb_feedbacks_edit = NULL; // Initialize page object first

class cinb_feedbacks_edit extends cinb_feedbacks {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'inb_feedbacks';

	// Page object name
	var $PageObjName = 'inb_feedbacks_edit';

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

		// Table object (inb_feedbacks)
		if (!isset($GLOBALS["inb_feedbacks"]) || get_class($GLOBALS["inb_feedbacks"]) == "cinb_feedbacks") {
			$GLOBALS["inb_feedbacks"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["inb_feedbacks"];
		}

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'inb_feedbacks', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("inb_feedbackslist.php"));
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
		$this->feedbackID->SetVisibility();
		$this->feedbackID->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
		$this->firstName->SetVisibility();
		$this->lastName->SetVisibility();
		$this->emailAddress->SetVisibility();
		$this->phoneNumber->SetVisibility();
		$this->feedback->SetVisibility();
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
		global $EW_EXPORT, $inb_feedbacks;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($inb_feedbacks);
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
					if ($pageName == "inb_feedbacksview.php")
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
			if ($objForm->HasValue("x_feedbackID")) {
				$this->feedbackID->setFormValue($objForm->GetValue("x_feedbackID"));
			}
		} else {
			$this->CurrentAction = "I"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (isset($_GET["feedbackID"])) {
				$this->feedbackID->setQueryStringValue($_GET["feedbackID"]);
				$loadByQuery = TRUE;
			} else {
				$this->feedbackID->CurrentValue = NULL;
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
					$this->Page_Terminate("inb_feedbackslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "inb_feedbackslist.php")
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
		if (!$this->feedbackID->FldIsDetailKey)
			$this->feedbackID->setFormValue($objForm->GetValue("x_feedbackID"));
		if (!$this->firstName->FldIsDetailKey) {
			$this->firstName->setFormValue($objForm->GetValue("x_firstName"));
		}
		if (!$this->lastName->FldIsDetailKey) {
			$this->lastName->setFormValue($objForm->GetValue("x_lastName"));
		}
		if (!$this->emailAddress->FldIsDetailKey) {
			$this->emailAddress->setFormValue($objForm->GetValue("x_emailAddress"));
		}
		if (!$this->phoneNumber->FldIsDetailKey) {
			$this->phoneNumber->setFormValue($objForm->GetValue("x_phoneNumber"));
		}
		if (!$this->feedback->FldIsDetailKey) {
			$this->feedback->setFormValue($objForm->GetValue("x_feedback"));
		}
		if (!$this->dateCreated->FldIsDetailKey) {
			$this->dateCreated->setFormValue($objForm->GetValue("x_dateCreated"));
			$this->dateCreated->CurrentValue = ew_UnFormatDateTime($this->dateCreated->CurrentValue, 7);
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->feedbackID->CurrentValue = $this->feedbackID->FormValue;
		$this->firstName->CurrentValue = $this->firstName->FormValue;
		$this->lastName->CurrentValue = $this->lastName->FormValue;
		$this->emailAddress->CurrentValue = $this->emailAddress->FormValue;
		$this->phoneNumber->CurrentValue = $this->phoneNumber->FormValue;
		$this->feedback->CurrentValue = $this->feedback->FormValue;
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
		$this->feedbackID->setDbValue($row['feedbackID']);
		$this->firstName->setDbValue($row['firstName']);
		$this->lastName->setDbValue($row['lastName']);
		$this->emailAddress->setDbValue($row['emailAddress']);
		$this->phoneNumber->setDbValue($row['phoneNumber']);
		$this->feedback->setDbValue($row['feedback']);
		$this->dateCreated->setDbValue($row['dateCreated']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['feedbackID'] = NULL;
		$row['firstName'] = NULL;
		$row['lastName'] = NULL;
		$row['emailAddress'] = NULL;
		$row['phoneNumber'] = NULL;
		$row['feedback'] = NULL;
		$row['dateCreated'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->feedbackID->DbValue = $row['feedbackID'];
		$this->firstName->DbValue = $row['firstName'];
		$this->lastName->DbValue = $row['lastName'];
		$this->emailAddress->DbValue = $row['emailAddress'];
		$this->phoneNumber->DbValue = $row['phoneNumber'];
		$this->feedback->DbValue = $row['feedback'];
		$this->dateCreated->DbValue = $row['dateCreated'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("feedbackID")) <> "")
			$this->feedbackID->CurrentValue = $this->getKey("feedbackID"); // feedbackID
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
		// feedbackID
		// firstName
		// lastName
		// emailAddress
		// phoneNumber
		// feedback
		// dateCreated

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// feedbackID
		$this->feedbackID->ViewValue = $this->feedbackID->CurrentValue;
		$this->feedbackID->ViewCustomAttributes = "";

		// firstName
		$this->firstName->ViewValue = $this->firstName->CurrentValue;
		$this->firstName->ViewCustomAttributes = "";

		// lastName
		$this->lastName->ViewValue = $this->lastName->CurrentValue;
		$this->lastName->ViewCustomAttributes = "";

		// emailAddress
		$this->emailAddress->ViewValue = $this->emailAddress->CurrentValue;
		$this->emailAddress->ViewCustomAttributes = "";

		// phoneNumber
		$this->phoneNumber->ViewValue = $this->phoneNumber->CurrentValue;
		$this->phoneNumber->ViewCustomAttributes = "";

		// feedback
		$this->feedback->ViewValue = $this->feedback->CurrentValue;
		$this->feedback->ViewCustomAttributes = "";

		// dateCreated
		$this->dateCreated->ViewValue = $this->dateCreated->CurrentValue;
		$this->dateCreated->ViewValue = ew_FormatDateTime($this->dateCreated->ViewValue, 7);
		$this->dateCreated->ViewCustomAttributes = "";

			// feedbackID
			$this->feedbackID->LinkCustomAttributes = "";
			$this->feedbackID->HrefValue = "";
			$this->feedbackID->TooltipValue = "";

			// firstName
			$this->firstName->LinkCustomAttributes = "";
			$this->firstName->HrefValue = "";
			$this->firstName->TooltipValue = "";

			// lastName
			$this->lastName->LinkCustomAttributes = "";
			$this->lastName->HrefValue = "";
			$this->lastName->TooltipValue = "";

			// emailAddress
			$this->emailAddress->LinkCustomAttributes = "";
			$this->emailAddress->HrefValue = "";
			$this->emailAddress->TooltipValue = "";

			// phoneNumber
			$this->phoneNumber->LinkCustomAttributes = "";
			$this->phoneNumber->HrefValue = "";
			$this->phoneNumber->TooltipValue = "";

			// feedback
			$this->feedback->LinkCustomAttributes = "";
			$this->feedback->HrefValue = "";
			$this->feedback->TooltipValue = "";

			// dateCreated
			$this->dateCreated->LinkCustomAttributes = "";
			$this->dateCreated->HrefValue = "";
			$this->dateCreated->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// feedbackID
			$this->feedbackID->EditAttrs["class"] = "form-control";
			$this->feedbackID->EditCustomAttributes = "";
			$this->feedbackID->EditValue = $this->feedbackID->CurrentValue;
			$this->feedbackID->ViewCustomAttributes = "";

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

			// emailAddress
			$this->emailAddress->EditAttrs["class"] = "form-control";
			$this->emailAddress->EditCustomAttributes = "";
			$this->emailAddress->EditValue = ew_HtmlEncode($this->emailAddress->CurrentValue);
			$this->emailAddress->PlaceHolder = ew_RemoveHtml($this->emailAddress->FldCaption());

			// phoneNumber
			$this->phoneNumber->EditAttrs["class"] = "form-control";
			$this->phoneNumber->EditCustomAttributes = "";
			$this->phoneNumber->EditValue = ew_HtmlEncode($this->phoneNumber->CurrentValue);
			$this->phoneNumber->PlaceHolder = ew_RemoveHtml($this->phoneNumber->FldCaption());

			// feedback
			$this->feedback->EditAttrs["class"] = "form-control";
			$this->feedback->EditCustomAttributes = "";
			$this->feedback->EditValue = ew_HtmlEncode($this->feedback->CurrentValue);
			$this->feedback->PlaceHolder = ew_RemoveHtml($this->feedback->FldCaption());

			// dateCreated
			$this->dateCreated->EditAttrs["class"] = "form-control";
			$this->dateCreated->EditCustomAttributes = "";
			$this->dateCreated->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->dateCreated->CurrentValue, 7));
			$this->dateCreated->PlaceHolder = ew_RemoveHtml($this->dateCreated->FldCaption());

			// Edit refer script
			// feedbackID

			$this->feedbackID->LinkCustomAttributes = "";
			$this->feedbackID->HrefValue = "";

			// firstName
			$this->firstName->LinkCustomAttributes = "";
			$this->firstName->HrefValue = "";

			// lastName
			$this->lastName->LinkCustomAttributes = "";
			$this->lastName->HrefValue = "";

			// emailAddress
			$this->emailAddress->LinkCustomAttributes = "";
			$this->emailAddress->HrefValue = "";

			// phoneNumber
			$this->phoneNumber->LinkCustomAttributes = "";
			$this->phoneNumber->HrefValue = "";

			// feedback
			$this->feedback->LinkCustomAttributes = "";
			$this->feedback->HrefValue = "";

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

			// firstName
			$this->firstName->SetDbValueDef($rsnew, $this->firstName->CurrentValue, NULL, $this->firstName->ReadOnly);

			// lastName
			$this->lastName->SetDbValueDef($rsnew, $this->lastName->CurrentValue, NULL, $this->lastName->ReadOnly);

			// emailAddress
			$this->emailAddress->SetDbValueDef($rsnew, $this->emailAddress->CurrentValue, NULL, $this->emailAddress->ReadOnly);

			// phoneNumber
			$this->phoneNumber->SetDbValueDef($rsnew, $this->phoneNumber->CurrentValue, NULL, $this->phoneNumber->ReadOnly);

			// feedback
			$this->feedback->SetDbValueDef($rsnew, $this->feedback->CurrentValue, NULL, $this->feedback->ReadOnly);

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("inb_feedbackslist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
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
if (!isset($inb_feedbacks_edit)) $inb_feedbacks_edit = new cinb_feedbacks_edit();

// Page init
$inb_feedbacks_edit->Page_Init();

// Page main
$inb_feedbacks_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inb_feedbacks_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = finb_feedbacksedit = new ew_Form("finb_feedbacksedit", "edit");

// Validate form
finb_feedbacksedit.Validate = function() {
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
				return this.OnError(elm, "<?php echo ew_JsEncode2($inb_feedbacks->dateCreated->FldErrMsg()) ?>");

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
finb_feedbacksedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
finb_feedbacksedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $inb_feedbacks_edit->ShowPageHeader(); ?>
<?php
$inb_feedbacks_edit->ShowMessage();
?>
<form name="finb_feedbacksedit" id="finb_feedbacksedit" class="<?php echo $inb_feedbacks_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($inb_feedbacks_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $inb_feedbacks_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inb_feedbacks">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($inb_feedbacks_edit->IsModal) ?>">
<div class="ewEditDiv"><!-- page* -->
<?php if ($inb_feedbacks->feedbackID->Visible) { // feedbackID ?>
	<div id="r_feedbackID" class="form-group">
		<label id="elh_inb_feedbacks_feedbackID" class="<?php echo $inb_feedbacks_edit->LeftColumnClass ?>"><?php echo $inb_feedbacks->feedbackID->FldCaption() ?></label>
		<div class="<?php echo $inb_feedbacks_edit->RightColumnClass ?>"><div<?php echo $inb_feedbacks->feedbackID->CellAttributes() ?>>
<span id="el_inb_feedbacks_feedbackID">
<span<?php echo $inb_feedbacks->feedbackID->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $inb_feedbacks->feedbackID->EditValue ?></p></span>
</span>
<input type="hidden" data-table="inb_feedbacks" data-field="x_feedbackID" name="x_feedbackID" id="x_feedbackID" value="<?php echo ew_HtmlEncode($inb_feedbacks->feedbackID->CurrentValue) ?>">
<?php echo $inb_feedbacks->feedbackID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_feedbacks->firstName->Visible) { // firstName ?>
	<div id="r_firstName" class="form-group">
		<label id="elh_inb_feedbacks_firstName" for="x_firstName" class="<?php echo $inb_feedbacks_edit->LeftColumnClass ?>"><?php echo $inb_feedbacks->firstName->FldCaption() ?></label>
		<div class="<?php echo $inb_feedbacks_edit->RightColumnClass ?>"><div<?php echo $inb_feedbacks->firstName->CellAttributes() ?>>
<span id="el_inb_feedbacks_firstName">
<input type="text" data-table="inb_feedbacks" data-field="x_firstName" name="x_firstName" id="x_firstName" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_feedbacks->firstName->getPlaceHolder()) ?>" value="<?php echo $inb_feedbacks->firstName->EditValue ?>"<?php echo $inb_feedbacks->firstName->EditAttributes() ?>>
</span>
<?php echo $inb_feedbacks->firstName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_feedbacks->lastName->Visible) { // lastName ?>
	<div id="r_lastName" class="form-group">
		<label id="elh_inb_feedbacks_lastName" for="x_lastName" class="<?php echo $inb_feedbacks_edit->LeftColumnClass ?>"><?php echo $inb_feedbacks->lastName->FldCaption() ?></label>
		<div class="<?php echo $inb_feedbacks_edit->RightColumnClass ?>"><div<?php echo $inb_feedbacks->lastName->CellAttributes() ?>>
<span id="el_inb_feedbacks_lastName">
<input type="text" data-table="inb_feedbacks" data-field="x_lastName" name="x_lastName" id="x_lastName" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_feedbacks->lastName->getPlaceHolder()) ?>" value="<?php echo $inb_feedbacks->lastName->EditValue ?>"<?php echo $inb_feedbacks->lastName->EditAttributes() ?>>
</span>
<?php echo $inb_feedbacks->lastName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_feedbacks->emailAddress->Visible) { // emailAddress ?>
	<div id="r_emailAddress" class="form-group">
		<label id="elh_inb_feedbacks_emailAddress" for="x_emailAddress" class="<?php echo $inb_feedbacks_edit->LeftColumnClass ?>"><?php echo $inb_feedbacks->emailAddress->FldCaption() ?></label>
		<div class="<?php echo $inb_feedbacks_edit->RightColumnClass ?>"><div<?php echo $inb_feedbacks->emailAddress->CellAttributes() ?>>
<span id="el_inb_feedbacks_emailAddress">
<input type="text" data-table="inb_feedbacks" data-field="x_emailAddress" name="x_emailAddress" id="x_emailAddress" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_feedbacks->emailAddress->getPlaceHolder()) ?>" value="<?php echo $inb_feedbacks->emailAddress->EditValue ?>"<?php echo $inb_feedbacks->emailAddress->EditAttributes() ?>>
</span>
<?php echo $inb_feedbacks->emailAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_feedbacks->phoneNumber->Visible) { // phoneNumber ?>
	<div id="r_phoneNumber" class="form-group">
		<label id="elh_inb_feedbacks_phoneNumber" for="x_phoneNumber" class="<?php echo $inb_feedbacks_edit->LeftColumnClass ?>"><?php echo $inb_feedbacks->phoneNumber->FldCaption() ?></label>
		<div class="<?php echo $inb_feedbacks_edit->RightColumnClass ?>"><div<?php echo $inb_feedbacks->phoneNumber->CellAttributes() ?>>
<span id="el_inb_feedbacks_phoneNumber">
<input type="text" data-table="inb_feedbacks" data-field="x_phoneNumber" name="x_phoneNumber" id="x_phoneNumber" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_feedbacks->phoneNumber->getPlaceHolder()) ?>" value="<?php echo $inb_feedbacks->phoneNumber->EditValue ?>"<?php echo $inb_feedbacks->phoneNumber->EditAttributes() ?>>
</span>
<?php echo $inb_feedbacks->phoneNumber->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_feedbacks->feedback->Visible) { // feedback ?>
	<div id="r_feedback" class="form-group">
		<label id="elh_inb_feedbacks_feedback" class="<?php echo $inb_feedbacks_edit->LeftColumnClass ?>"><?php echo $inb_feedbacks->feedback->FldCaption() ?></label>
		<div class="<?php echo $inb_feedbacks_edit->RightColumnClass ?>"><div<?php echo $inb_feedbacks->feedback->CellAttributes() ?>>
<span id="el_inb_feedbacks_feedback">
<?php ew_AppendClass($inb_feedbacks->feedback->EditAttrs["class"], "editor"); ?>
<textarea data-table="inb_feedbacks" data-field="x_feedback" name="x_feedback" id="x_feedback" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($inb_feedbacks->feedback->getPlaceHolder()) ?>"<?php echo $inb_feedbacks->feedback->EditAttributes() ?>><?php echo $inb_feedbacks->feedback->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("finb_feedbacksedit", "x_feedback", 35, 4, <?php echo ($inb_feedbacks->feedback->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $inb_feedbacks->feedback->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_feedbacks->dateCreated->Visible) { // dateCreated ?>
	<div id="r_dateCreated" class="form-group">
		<label id="elh_inb_feedbacks_dateCreated" for="x_dateCreated" class="<?php echo $inb_feedbacks_edit->LeftColumnClass ?>"><?php echo $inb_feedbacks->dateCreated->FldCaption() ?></label>
		<div class="<?php echo $inb_feedbacks_edit->RightColumnClass ?>"><div<?php echo $inb_feedbacks->dateCreated->CellAttributes() ?>>
<span id="el_inb_feedbacks_dateCreated">
<input type="text" data-table="inb_feedbacks" data-field="x_dateCreated" data-format="7" name="x_dateCreated" id="x_dateCreated" placeholder="<?php echo ew_HtmlEncode($inb_feedbacks->dateCreated->getPlaceHolder()) ?>" value="<?php echo $inb_feedbacks->dateCreated->EditValue ?>"<?php echo $inb_feedbacks->dateCreated->EditAttributes() ?>>
<?php if (!$inb_feedbacks->dateCreated->ReadOnly && !$inb_feedbacks->dateCreated->Disabled && !isset($inb_feedbacks->dateCreated->EditAttrs["readonly"]) && !isset($inb_feedbacks->dateCreated->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("finb_feedbacksedit", "x_dateCreated", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php echo $inb_feedbacks->dateCreated->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$inb_feedbacks_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $inb_feedbacks_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $inb_feedbacks_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
finb_feedbacksedit.Init();
</script>
<?php
$inb_feedbacks_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$inb_feedbacks_edit->Page_Terminate();
?>
