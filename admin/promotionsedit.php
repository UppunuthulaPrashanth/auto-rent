<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "promotionsinfo.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$promotions_edit = NULL; // Initialize page object first

class cpromotions_edit extends cpromotions {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'promotions';

	// Page object name
	var $PageObjName = 'promotions_edit';

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

		// Table object (promotions)
		if (!isset($GLOBALS["promotions"]) || get_class($GLOBALS["promotions"]) == "cpromotions") {
			$GLOBALS["promotions"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["promotions"];
		}

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'promotions', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("promotionslist.php"));
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
		$this->promotionID->SetVisibility();
		$this->promotionID->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
		$this->title->SetVisibility();
		$this->subTitle->SetVisibility();
		$this->image->SetVisibility();
		$this->homeImage->SetVisibility();
		$this->summary->SetVisibility();
		$this->createdDate->SetVisibility();
		$this->so->SetVisibility();
		$this->active->SetVisibility();

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
		global $EW_EXPORT, $promotions;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($promotions);
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
					if ($pageName == "promotionsview.php")
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
			if ($objForm->HasValue("x_promotionID")) {
				$this->promotionID->setFormValue($objForm->GetValue("x_promotionID"));
			}
		} else {
			$this->CurrentAction = "I"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (isset($_GET["promotionID"])) {
				$this->promotionID->setQueryStringValue($_GET["promotionID"]);
				$loadByQuery = TRUE;
			} else {
				$this->promotionID->CurrentValue = NULL;
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
					$this->Page_Terminate("promotionslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "promotionslist.php")
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
		$this->homeImage->Upload->Index = $objForm->Index;
		$this->homeImage->Upload->UploadFile();
		$this->homeImage->CurrentValue = $this->homeImage->Upload->FileName;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->promotionID->FldIsDetailKey)
			$this->promotionID->setFormValue($objForm->GetValue("x_promotionID"));
		if (!$this->title->FldIsDetailKey) {
			$this->title->setFormValue($objForm->GetValue("x_title"));
		}
		if (!$this->subTitle->FldIsDetailKey) {
			$this->subTitle->setFormValue($objForm->GetValue("x_subTitle"));
		}
		if (!$this->summary->FldIsDetailKey) {
			$this->summary->setFormValue($objForm->GetValue("x_summary"));
		}
		if (!$this->createdDate->FldIsDetailKey) {
			$this->createdDate->setFormValue($objForm->GetValue("x_createdDate"));
			$this->createdDate->CurrentValue = ew_UnFormatDateTime($this->createdDate->CurrentValue, 7);
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
		$this->promotionID->CurrentValue = $this->promotionID->FormValue;
		$this->title->CurrentValue = $this->title->FormValue;
		$this->subTitle->CurrentValue = $this->subTitle->FormValue;
		$this->summary->CurrentValue = $this->summary->FormValue;
		$this->createdDate->CurrentValue = $this->createdDate->FormValue;
		$this->createdDate->CurrentValue = ew_UnFormatDateTime($this->createdDate->CurrentValue, 7);
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
		$this->promotionID->setDbValue($row['promotionID']);
		$this->title->setDbValue($row['title']);
		$this->subTitle->setDbValue($row['subTitle']);
		$this->image->Upload->DbValue = $row['image'];
		$this->image->setDbValue($this->image->Upload->DbValue);
		$this->homeImage->Upload->DbValue = $row['homeImage'];
		$this->homeImage->setDbValue($this->homeImage->Upload->DbValue);
		$this->summary->setDbValue($row['summary']);
		$this->createdDate->setDbValue($row['createdDate']);
		$this->so->setDbValue($row['so']);
		$this->active->setDbValue($row['active']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['promotionID'] = NULL;
		$row['title'] = NULL;
		$row['subTitle'] = NULL;
		$row['image'] = NULL;
		$row['homeImage'] = NULL;
		$row['summary'] = NULL;
		$row['createdDate'] = NULL;
		$row['so'] = NULL;
		$row['active'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->promotionID->DbValue = $row['promotionID'];
		$this->title->DbValue = $row['title'];
		$this->subTitle->DbValue = $row['subTitle'];
		$this->image->Upload->DbValue = $row['image'];
		$this->homeImage->Upload->DbValue = $row['homeImage'];
		$this->summary->DbValue = $row['summary'];
		$this->createdDate->DbValue = $row['createdDate'];
		$this->so->DbValue = $row['so'];
		$this->active->DbValue = $row['active'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("promotionID")) <> "")
			$this->promotionID->CurrentValue = $this->getKey("promotionID"); // promotionID
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
		// promotionID
		// title
		// subTitle
		// image
		// homeImage
		// summary
		// createdDate
		// so
		// active

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// promotionID
		$this->promotionID->ViewValue = $this->promotionID->CurrentValue;
		$this->promotionID->ViewCustomAttributes = "";

		// title
		$this->title->ViewValue = $this->title->CurrentValue;
		$this->title->ViewCustomAttributes = "";

		// subTitle
		$this->subTitle->ViewValue = $this->subTitle->CurrentValue;
		$this->subTitle->ViewCustomAttributes = "";

		// image
		$this->image->UploadPath = 'uploads/promotions';
		if (!ew_Empty($this->image->Upload->DbValue)) {
			$this->image->ImageWidth = 100;
			$this->image->ImageHeight = 0;
			$this->image->ImageAlt = $this->image->FldAlt();
			$this->image->ViewValue = $this->image->Upload->DbValue;
		} else {
			$this->image->ViewValue = "";
		}
		$this->image->ViewCustomAttributes = "";

		// homeImage
		$this->homeImage->UploadPath = 'uploads/promotions';
		if (!ew_Empty($this->homeImage->Upload->DbValue)) {
			$this->homeImage->ImageWidth = 100;
			$this->homeImage->ImageHeight = 0;
			$this->homeImage->ImageAlt = $this->homeImage->FldAlt();
			$this->homeImage->ViewValue = $this->homeImage->Upload->DbValue;
		} else {
			$this->homeImage->ViewValue = "";
		}
		$this->homeImage->ViewCustomAttributes = "";

		// summary
		$this->summary->ViewValue = $this->summary->CurrentValue;
		$this->summary->ViewCustomAttributes = "";

		// createdDate
		$this->createdDate->ViewValue = $this->createdDate->CurrentValue;
		$this->createdDate->ViewValue = ew_FormatDateTime($this->createdDate->ViewValue, 7);
		$this->createdDate->ViewCustomAttributes = "";

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

			// promotionID
			$this->promotionID->LinkCustomAttributes = "";
			$this->promotionID->HrefValue = "";
			$this->promotionID->TooltipValue = "";

			// title
			$this->title->LinkCustomAttributes = "";
			$this->title->HrefValue = "";
			$this->title->TooltipValue = "";

			// subTitle
			$this->subTitle->LinkCustomAttributes = "";
			$this->subTitle->HrefValue = "";
			$this->subTitle->TooltipValue = "";

			// image
			$this->image->LinkCustomAttributes = "";
			$this->image->UploadPath = 'uploads/promotions';
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
				$this->image->LinkAttrs["data-rel"] = "promotions_x_image";
				ew_AppendClass($this->image->LinkAttrs["class"], "ewLightbox");
			}

			// homeImage
			$this->homeImage->LinkCustomAttributes = "";
			$this->homeImage->UploadPath = 'uploads/promotions';
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
				$this->homeImage->LinkAttrs["data-rel"] = "promotions_x_homeImage";
				ew_AppendClass($this->homeImage->LinkAttrs["class"], "ewLightbox");
			}

			// summary
			$this->summary->LinkCustomAttributes = "";
			$this->summary->HrefValue = "";
			$this->summary->TooltipValue = "";

			// createdDate
			$this->createdDate->LinkCustomAttributes = "";
			$this->createdDate->HrefValue = "";
			$this->createdDate->TooltipValue = "";

			// so
			$this->so->LinkCustomAttributes = "";
			$this->so->HrefValue = "";
			$this->so->TooltipValue = "";

			// active
			$this->active->LinkCustomAttributes = "";
			$this->active->HrefValue = "";
			$this->active->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// promotionID
			$this->promotionID->EditAttrs["class"] = "form-control";
			$this->promotionID->EditCustomAttributes = "";
			$this->promotionID->EditValue = $this->promotionID->CurrentValue;
			$this->promotionID->ViewCustomAttributes = "";

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

			// image
			$this->image->EditAttrs["class"] = "form-control";
			$this->image->EditCustomAttributes = "";
			$this->image->UploadPath = 'uploads/promotions';
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

			// homeImage
			$this->homeImage->EditAttrs["class"] = "form-control";
			$this->homeImage->EditCustomAttributes = "";
			$this->homeImage->UploadPath = 'uploads/promotions';
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
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->homeImage);

			// summary
			$this->summary->EditAttrs["class"] = "form-control";
			$this->summary->EditCustomAttributes = "";
			$this->summary->EditValue = ew_HtmlEncode($this->summary->CurrentValue);
			$this->summary->PlaceHolder = ew_RemoveHtml($this->summary->FldCaption());

			// createdDate
			$this->createdDate->EditAttrs["class"] = "form-control";
			$this->createdDate->EditCustomAttributes = "";
			$this->createdDate->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->createdDate->CurrentValue, 7));
			$this->createdDate->PlaceHolder = ew_RemoveHtml($this->createdDate->FldCaption());

			// so
			$this->so->EditAttrs["class"] = "form-control";
			$this->so->EditCustomAttributes = "";
			$this->so->EditValue = ew_HtmlEncode($this->so->CurrentValue);
			$this->so->PlaceHolder = ew_RemoveHtml($this->so->FldCaption());

			// active
			$this->active->EditAttrs["class"] = "form-control";
			$this->active->EditCustomAttributes = "";
			$this->active->EditValue = $this->active->Options(TRUE);

			// Edit refer script
			// promotionID

			$this->promotionID->LinkCustomAttributes = "";
			$this->promotionID->HrefValue = "";

			// title
			$this->title->LinkCustomAttributes = "";
			$this->title->HrefValue = "";

			// subTitle
			$this->subTitle->LinkCustomAttributes = "";
			$this->subTitle->HrefValue = "";

			// image
			$this->image->LinkCustomAttributes = "";
			$this->image->UploadPath = 'uploads/promotions';
			if (!ew_Empty($this->image->Upload->DbValue)) {
				$this->image->HrefValue = ew_GetFileUploadUrl($this->image, $this->image->Upload->DbValue); // Add prefix/suffix
				$this->image->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->image->HrefValue = ew_FullUrl($this->image->HrefValue, "href");
			} else {
				$this->image->HrefValue = "";
			}
			$this->image->HrefValue2 = $this->image->UploadPath . $this->image->Upload->DbValue;

			// homeImage
			$this->homeImage->LinkCustomAttributes = "";
			$this->homeImage->UploadPath = 'uploads/promotions';
			if (!ew_Empty($this->homeImage->Upload->DbValue)) {
				$this->homeImage->HrefValue = ew_GetFileUploadUrl($this->homeImage, $this->homeImage->Upload->DbValue); // Add prefix/suffix
				$this->homeImage->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->homeImage->HrefValue = ew_FullUrl($this->homeImage->HrefValue, "href");
			} else {
				$this->homeImage->HrefValue = "";
			}
			$this->homeImage->HrefValue2 = $this->homeImage->UploadPath . $this->homeImage->Upload->DbValue;

			// summary
			$this->summary->LinkCustomAttributes = "";
			$this->summary->HrefValue = "";

			// createdDate
			$this->createdDate->LinkCustomAttributes = "";
			$this->createdDate->HrefValue = "";

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
		if (!ew_CheckEuroDate($this->createdDate->FormValue)) {
			ew_AddMessage($gsFormError, $this->createdDate->FldErrMsg());
		}
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
			$this->image->OldUploadPath = 'uploads/promotions';
			$this->image->UploadPath = $this->image->OldUploadPath;
			$this->homeImage->OldUploadPath = 'uploads/promotions';
			$this->homeImage->UploadPath = $this->homeImage->OldUploadPath;
			$rsnew = array();

			// title
			$this->title->SetDbValueDef($rsnew, $this->title->CurrentValue, NULL, $this->title->ReadOnly);

			// subTitle
			$this->subTitle->SetDbValueDef($rsnew, $this->subTitle->CurrentValue, NULL, $this->subTitle->ReadOnly);

			// image
			if ($this->image->Visible && !$this->image->ReadOnly && !$this->image->Upload->KeepFile) {
				$this->image->Upload->DbValue = $rsold['image']; // Get original value
				if ($this->image->Upload->FileName == "") {
					$rsnew['image'] = NULL;
				} else {
					$rsnew['image'] = $this->image->Upload->FileName;
				}
			}

			// homeImage
			if ($this->homeImage->Visible && !$this->homeImage->ReadOnly && !$this->homeImage->Upload->KeepFile) {
				$this->homeImage->Upload->DbValue = $rsold['homeImage']; // Get original value
				if ($this->homeImage->Upload->FileName == "") {
					$rsnew['homeImage'] = NULL;
				} else {
					$rsnew['homeImage'] = $this->homeImage->Upload->FileName;
				}
			}

			// summary
			$this->summary->SetDbValueDef($rsnew, $this->summary->CurrentValue, NULL, $this->summary->ReadOnly);

			// createdDate
			$this->createdDate->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->createdDate->CurrentValue, 7), NULL, $this->createdDate->ReadOnly);

			// so
			$this->so->SetDbValueDef($rsnew, $this->so->CurrentValue, NULL, $this->so->ReadOnly);

			// active
			$this->active->SetDbValueDef($rsnew, $this->active->CurrentValue, NULL, $this->active->ReadOnly);
			if ($this->image->Visible && !$this->image->Upload->KeepFile) {
				$this->image->UploadPath = 'uploads/promotions';
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
			if ($this->homeImage->Visible && !$this->homeImage->Upload->KeepFile) {
				$this->homeImage->UploadPath = 'uploads/promotions';
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
					$this->homeImage->SetDbValueDef($rsnew, $this->homeImage->Upload->FileName, NULL, $this->homeImage->ReadOnly);
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

		// homeImage
		ew_CleanUploadTempPath($this->homeImage, $this->homeImage->Upload->Index);
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("promotionslist.php"), "", $this->TableVar, TRUE);
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
if (!isset($promotions_edit)) $promotions_edit = new cpromotions_edit();

// Page init
$promotions_edit->Page_Init();

// Page main
$promotions_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$promotions_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = fpromotionsedit = new ew_Form("fpromotionsedit", "edit");

// Validate form
fpromotionsedit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_createdDate");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($promotions->createdDate->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_so");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($promotions->so->FldErrMsg()) ?>");

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
fpromotionsedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fpromotionsedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fpromotionsedit.Lists["x_active"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fpromotionsedit.Lists["x_active"].Options = <?php echo json_encode($promotions_edit->active->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $promotions_edit->ShowPageHeader(); ?>
<?php
$promotions_edit->ShowMessage();
?>
<form name="fpromotionsedit" id="fpromotionsedit" class="<?php echo $promotions_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($promotions_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $promotions_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="promotions">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($promotions_edit->IsModal) ?>">
<div class="ewEditDiv"><!-- page* -->
<?php if ($promotions->promotionID->Visible) { // promotionID ?>
	<div id="r_promotionID" class="form-group">
		<label id="elh_promotions_promotionID" class="<?php echo $promotions_edit->LeftColumnClass ?>"><?php echo $promotions->promotionID->FldCaption() ?></label>
		<div class="<?php echo $promotions_edit->RightColumnClass ?>"><div<?php echo $promotions->promotionID->CellAttributes() ?>>
<span id="el_promotions_promotionID">
<span<?php echo $promotions->promotionID->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $promotions->promotionID->EditValue ?></p></span>
</span>
<input type="hidden" data-table="promotions" data-field="x_promotionID" name="x_promotionID" id="x_promotionID" value="<?php echo ew_HtmlEncode($promotions->promotionID->CurrentValue) ?>">
<?php echo $promotions->promotionID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($promotions->title->Visible) { // title ?>
	<div id="r_title" class="form-group">
		<label id="elh_promotions_title" for="x_title" class="<?php echo $promotions_edit->LeftColumnClass ?>"><?php echo $promotions->title->FldCaption() ?></label>
		<div class="<?php echo $promotions_edit->RightColumnClass ?>"><div<?php echo $promotions->title->CellAttributes() ?>>
<span id="el_promotions_title">
<input type="text" data-table="promotions" data-field="x_title" name="x_title" id="x_title" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($promotions->title->getPlaceHolder()) ?>" value="<?php echo $promotions->title->EditValue ?>"<?php echo $promotions->title->EditAttributes() ?>>
</span>
<?php echo $promotions->title->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($promotions->subTitle->Visible) { // subTitle ?>
	<div id="r_subTitle" class="form-group">
		<label id="elh_promotions_subTitle" for="x_subTitle" class="<?php echo $promotions_edit->LeftColumnClass ?>"><?php echo $promotions->subTitle->FldCaption() ?></label>
		<div class="<?php echo $promotions_edit->RightColumnClass ?>"><div<?php echo $promotions->subTitle->CellAttributes() ?>>
<span id="el_promotions_subTitle">
<input type="text" data-table="promotions" data-field="x_subTitle" name="x_subTitle" id="x_subTitle" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($promotions->subTitle->getPlaceHolder()) ?>" value="<?php echo $promotions->subTitle->EditValue ?>"<?php echo $promotions->subTitle->EditAttributes() ?>>
</span>
<?php echo $promotions->subTitle->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($promotions->image->Visible) { // image ?>
	<div id="r_image" class="form-group">
		<label id="elh_promotions_image" class="<?php echo $promotions_edit->LeftColumnClass ?>"><?php echo $promotions->image->FldCaption() ?></label>
		<div class="<?php echo $promotions_edit->RightColumnClass ?>"><div<?php echo $promotions->image->CellAttributes() ?>>
<span id="el_promotions_image">
<div id="fd_x_image">
<span title="<?php echo $promotions->image->FldTitle() ? $promotions->image->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($promotions->image->ReadOnly || $promotions->image->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="promotions" data-field="x_image" name="x_image" id="x_image"<?php echo $promotions->image->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_image" id= "fn_x_image" value="<?php echo $promotions->image->Upload->FileName ?>">
<?php if (@$_POST["fa_x_image"] == "0") { ?>
<input type="hidden" name="fa_x_image" id= "fa_x_image" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_image" id= "fa_x_image" value="1">
<?php } ?>
<input type="hidden" name="fs_x_image" id= "fs_x_image" value="255">
<input type="hidden" name="fx_x_image" id= "fx_x_image" value="<?php echo $promotions->image->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_image" id= "fm_x_image" value="<?php echo $promotions->image->UploadMaxFileSize ?>">
</div>
<table id="ft_x_image" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $promotions->image->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($promotions->homeImage->Visible) { // homeImage ?>
	<div id="r_homeImage" class="form-group">
		<label id="elh_promotions_homeImage" class="<?php echo $promotions_edit->LeftColumnClass ?>"><?php echo $promotions->homeImage->FldCaption() ?></label>
		<div class="<?php echo $promotions_edit->RightColumnClass ?>"><div<?php echo $promotions->homeImage->CellAttributes() ?>>
<span id="el_promotions_homeImage">
<div id="fd_x_homeImage">
<span title="<?php echo $promotions->homeImage->FldTitle() ? $promotions->homeImage->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($promotions->homeImage->ReadOnly || $promotions->homeImage->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="promotions" data-field="x_homeImage" name="x_homeImage" id="x_homeImage"<?php echo $promotions->homeImage->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_homeImage" id= "fn_x_homeImage" value="<?php echo $promotions->homeImage->Upload->FileName ?>">
<?php if (@$_POST["fa_x_homeImage"] == "0") { ?>
<input type="hidden" name="fa_x_homeImage" id= "fa_x_homeImage" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_homeImage" id= "fa_x_homeImage" value="1">
<?php } ?>
<input type="hidden" name="fs_x_homeImage" id= "fs_x_homeImage" value="255">
<input type="hidden" name="fx_x_homeImage" id= "fx_x_homeImage" value="<?php echo $promotions->homeImage->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_homeImage" id= "fm_x_homeImage" value="<?php echo $promotions->homeImage->UploadMaxFileSize ?>">
</div>
<table id="ft_x_homeImage" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $promotions->homeImage->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($promotions->summary->Visible) { // summary ?>
	<div id="r_summary" class="form-group">
		<label id="elh_promotions_summary" for="x_summary" class="<?php echo $promotions_edit->LeftColumnClass ?>"><?php echo $promotions->summary->FldCaption() ?></label>
		<div class="<?php echo $promotions_edit->RightColumnClass ?>"><div<?php echo $promotions->summary->CellAttributes() ?>>
<span id="el_promotions_summary">
<textarea data-table="promotions" data-field="x_summary" name="x_summary" id="x_summary" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($promotions->summary->getPlaceHolder()) ?>"<?php echo $promotions->summary->EditAttributes() ?>><?php echo $promotions->summary->EditValue ?></textarea>
</span>
<?php echo $promotions->summary->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($promotions->createdDate->Visible) { // createdDate ?>
	<div id="r_createdDate" class="form-group">
		<label id="elh_promotions_createdDate" for="x_createdDate" class="<?php echo $promotions_edit->LeftColumnClass ?>"><?php echo $promotions->createdDate->FldCaption() ?></label>
		<div class="<?php echo $promotions_edit->RightColumnClass ?>"><div<?php echo $promotions->createdDate->CellAttributes() ?>>
<span id="el_promotions_createdDate">
<input type="text" data-table="promotions" data-field="x_createdDate" data-format="7" name="x_createdDate" id="x_createdDate" placeholder="<?php echo ew_HtmlEncode($promotions->createdDate->getPlaceHolder()) ?>" value="<?php echo $promotions->createdDate->EditValue ?>"<?php echo $promotions->createdDate->EditAttributes() ?>>
<?php if (!$promotions->createdDate->ReadOnly && !$promotions->createdDate->Disabled && !isset($promotions->createdDate->EditAttrs["readonly"]) && !isset($promotions->createdDate->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("fpromotionsedit", "x_createdDate", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php echo $promotions->createdDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($promotions->so->Visible) { // so ?>
	<div id="r_so" class="form-group">
		<label id="elh_promotions_so" for="x_so" class="<?php echo $promotions_edit->LeftColumnClass ?>"><?php echo $promotions->so->FldCaption() ?></label>
		<div class="<?php echo $promotions_edit->RightColumnClass ?>"><div<?php echo $promotions->so->CellAttributes() ?>>
<span id="el_promotions_so">
<input type="text" data-table="promotions" data-field="x_so" name="x_so" id="x_so" size="30" placeholder="<?php echo ew_HtmlEncode($promotions->so->getPlaceHolder()) ?>" value="<?php echo $promotions->so->EditValue ?>"<?php echo $promotions->so->EditAttributes() ?>>
</span>
<?php echo $promotions->so->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($promotions->active->Visible) { // active ?>
	<div id="r_active" class="form-group">
		<label id="elh_promotions_active" for="x_active" class="<?php echo $promotions_edit->LeftColumnClass ?>"><?php echo $promotions->active->FldCaption() ?></label>
		<div class="<?php echo $promotions_edit->RightColumnClass ?>"><div<?php echo $promotions->active->CellAttributes() ?>>
<span id="el_promotions_active">
<select data-table="promotions" data-field="x_active" data-value-separator="<?php echo $promotions->active->DisplayValueSeparatorAttribute() ?>" id="x_active" name="x_active"<?php echo $promotions->active->EditAttributes() ?>>
<?php echo $promotions->active->SelectOptionListHtml("x_active") ?>
</select>
</span>
<?php echo $promotions->active->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$promotions_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $promotions_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $promotions_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fpromotionsedit.Init();
</script>
<?php
$promotions_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$promotions_edit->Page_Terminate();
?>
