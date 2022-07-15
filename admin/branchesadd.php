<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "branchesinfo.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$branches_add = NULL; // Initialize page object first

class cbranches_add extends cbranches {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'branches';

	// Page object name
	var $PageObjName = 'branches_add';

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

		// Table object (branches)
		if (!isset($GLOBALS["branches"]) || get_class($GLOBALS["branches"]) == "cbranches") {
			$GLOBALS["branches"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["branches"];
		}

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'branches', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("brancheslist.php"));
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
		$this->locationID->SetVisibility();
		$this->regionID->SetVisibility();
		$this->branchName->SetVisibility();
		$this->address->SetVisibility();
		$this->phone->SetVisibility();
		$this->fax->SetVisibility();
		$this->_email->SetVisibility();
		$this->map->SetVisibility();
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
		global $EW_EXPORT, $branches;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($branches);
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
					if ($pageName == "branchesview.php")
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
			if (@$_GET["branchID"] != "") {
				$this->branchID->setQueryStringValue($_GET["branchID"]);
				$this->setKey("branchID", $this->branchID->CurrentValue); // Set up key
			} else {
				$this->setKey("branchID", ""); // Clear key
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
					$this->Page_Terminate("brancheslist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "brancheslist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "branchesview.php")
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
		$this->branchID->CurrentValue = NULL;
		$this->branchID->OldValue = $this->branchID->CurrentValue;
		$this->locationID->CurrentValue = NULL;
		$this->locationID->OldValue = $this->locationID->CurrentValue;
		$this->regionID->CurrentValue = NULL;
		$this->regionID->OldValue = $this->regionID->CurrentValue;
		$this->branchName->CurrentValue = NULL;
		$this->branchName->OldValue = $this->branchName->CurrentValue;
		$this->address->CurrentValue = NULL;
		$this->address->OldValue = $this->address->CurrentValue;
		$this->phone->CurrentValue = NULL;
		$this->phone->OldValue = $this->phone->CurrentValue;
		$this->fax->CurrentValue = NULL;
		$this->fax->OldValue = $this->fax->CurrentValue;
		$this->_email->CurrentValue = NULL;
		$this->_email->OldValue = $this->_email->CurrentValue;
		$this->map->CurrentValue = NULL;
		$this->map->OldValue = $this->map->CurrentValue;
		$this->so->CurrentValue = 0;
		$this->active->CurrentValue = 1;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->locationID->FldIsDetailKey) {
			$this->locationID->setFormValue($objForm->GetValue("x_locationID"));
		}
		if (!$this->regionID->FldIsDetailKey) {
			$this->regionID->setFormValue($objForm->GetValue("x_regionID"));
		}
		if (!$this->branchName->FldIsDetailKey) {
			$this->branchName->setFormValue($objForm->GetValue("x_branchName"));
		}
		if (!$this->address->FldIsDetailKey) {
			$this->address->setFormValue($objForm->GetValue("x_address"));
		}
		if (!$this->phone->FldIsDetailKey) {
			$this->phone->setFormValue($objForm->GetValue("x_phone"));
		}
		if (!$this->fax->FldIsDetailKey) {
			$this->fax->setFormValue($objForm->GetValue("x_fax"));
		}
		if (!$this->_email->FldIsDetailKey) {
			$this->_email->setFormValue($objForm->GetValue("x__email"));
		}
		if (!$this->map->FldIsDetailKey) {
			$this->map->setFormValue($objForm->GetValue("x_map"));
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
		$this->locationID->CurrentValue = $this->locationID->FormValue;
		$this->regionID->CurrentValue = $this->regionID->FormValue;
		$this->branchName->CurrentValue = $this->branchName->FormValue;
		$this->address->CurrentValue = $this->address->FormValue;
		$this->phone->CurrentValue = $this->phone->FormValue;
		$this->fax->CurrentValue = $this->fax->FormValue;
		$this->_email->CurrentValue = $this->_email->FormValue;
		$this->map->CurrentValue = $this->map->FormValue;
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
		$this->branchID->setDbValue($row['branchID']);
		$this->locationID->setDbValue($row['locationID']);
		$this->regionID->setDbValue($row['regionID']);
		$this->branchName->setDbValue($row['branchName']);
		$this->address->setDbValue($row['address']);
		$this->phone->setDbValue($row['phone']);
		$this->fax->setDbValue($row['fax']);
		$this->_email->setDbValue($row['email']);
		$this->map->setDbValue($row['map']);
		$this->so->setDbValue($row['so']);
		$this->active->setDbValue($row['active']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['branchID'] = $this->branchID->CurrentValue;
		$row['locationID'] = $this->locationID->CurrentValue;
		$row['regionID'] = $this->regionID->CurrentValue;
		$row['branchName'] = $this->branchName->CurrentValue;
		$row['address'] = $this->address->CurrentValue;
		$row['phone'] = $this->phone->CurrentValue;
		$row['fax'] = $this->fax->CurrentValue;
		$row['email'] = $this->_email->CurrentValue;
		$row['map'] = $this->map->CurrentValue;
		$row['so'] = $this->so->CurrentValue;
		$row['active'] = $this->active->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->branchID->DbValue = $row['branchID'];
		$this->locationID->DbValue = $row['locationID'];
		$this->regionID->DbValue = $row['regionID'];
		$this->branchName->DbValue = $row['branchName'];
		$this->address->DbValue = $row['address'];
		$this->phone->DbValue = $row['phone'];
		$this->fax->DbValue = $row['fax'];
		$this->_email->DbValue = $row['email'];
		$this->map->DbValue = $row['map'];
		$this->so->DbValue = $row['so'];
		$this->active->DbValue = $row['active'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("branchID")) <> "")
			$this->branchID->CurrentValue = $this->getKey("branchID"); // branchID
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
		// branchID
		// locationID
		// regionID
		// branchName
		// address
		// phone
		// fax
		// email
		// map
		// so
		// active

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// branchID
		$this->branchID->ViewValue = $this->branchID->CurrentValue;
		$this->branchID->ViewCustomAttributes = "";

		// locationID
		if (strval($this->locationID->CurrentValue) <> "") {
			$sFilterWrk = "`locationID`" . ew_SearchString("=", $this->locationID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `locationID`, `locationName` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_locations`";
		$sWhereWrk = "";
		$this->locationID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->locationID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->locationID->ViewValue = $this->locationID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->locationID->ViewValue = $this->locationID->CurrentValue;
			}
		} else {
			$this->locationID->ViewValue = NULL;
		}
		$this->locationID->ViewCustomAttributes = "";

		// regionID
		if (strval($this->regionID->CurrentValue) <> "") {
			$sFilterWrk = "`regionID`" . ew_SearchString("=", $this->regionID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `regionID`, `regionName` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `region`";
		$sWhereWrk = "";
		$this->regionID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->regionID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->regionID->ViewValue = $this->regionID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->regionID->ViewValue = $this->regionID->CurrentValue;
			}
		} else {
			$this->regionID->ViewValue = NULL;
		}
		$this->regionID->ViewCustomAttributes = "";

		// branchName
		$this->branchName->ViewValue = $this->branchName->CurrentValue;
		$this->branchName->ViewCustomAttributes = "";

		// address
		$this->address->ViewValue = $this->address->CurrentValue;
		$this->address->ViewCustomAttributes = "";

		// phone
		$this->phone->ViewValue = $this->phone->CurrentValue;
		$this->phone->ViewCustomAttributes = "";

		// fax
		$this->fax->ViewValue = $this->fax->CurrentValue;
		$this->fax->ViewCustomAttributes = "";

		// email
		$this->_email->ViewValue = $this->_email->CurrentValue;
		$this->_email->ViewCustomAttributes = "";

		// map
		$this->map->ViewValue = $this->map->CurrentValue;
		$this->map->ViewCustomAttributes = "";

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

			// locationID
			$this->locationID->LinkCustomAttributes = "";
			$this->locationID->HrefValue = "";
			$this->locationID->TooltipValue = "";

			// regionID
			$this->regionID->LinkCustomAttributes = "";
			$this->regionID->HrefValue = "";
			$this->regionID->TooltipValue = "";

			// branchName
			$this->branchName->LinkCustomAttributes = "";
			$this->branchName->HrefValue = "";
			$this->branchName->TooltipValue = "";

			// address
			$this->address->LinkCustomAttributes = "";
			$this->address->HrefValue = "";
			$this->address->TooltipValue = "";

			// phone
			$this->phone->LinkCustomAttributes = "";
			$this->phone->HrefValue = "";
			$this->phone->TooltipValue = "";

			// fax
			$this->fax->LinkCustomAttributes = "";
			$this->fax->HrefValue = "";
			$this->fax->TooltipValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";
			$this->_email->TooltipValue = "";

			// map
			$this->map->LinkCustomAttributes = "";
			$this->map->HrefValue = "";
			$this->map->TooltipValue = "";

			// so
			$this->so->LinkCustomAttributes = "";
			$this->so->HrefValue = "";
			$this->so->TooltipValue = "";

			// active
			$this->active->LinkCustomAttributes = "";
			$this->active->HrefValue = "";
			$this->active->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// locationID
			$this->locationID->EditAttrs["class"] = "form-control";
			$this->locationID->EditCustomAttributes = "";
			if (trim(strval($this->locationID->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`locationID`" . ew_SearchString("=", $this->locationID->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `locationID`, `locationName` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `mtr_locations`";
			$sWhereWrk = "";
			$this->locationID->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->locationID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->locationID->EditValue = $arwrk;

			// regionID
			$this->regionID->EditAttrs["class"] = "form-control";
			$this->regionID->EditCustomAttributes = "";
			if (trim(strval($this->regionID->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`regionID`" . ew_SearchString("=", $this->regionID->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `regionID`, `regionName` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, `locationID` AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `region`";
			$sWhereWrk = "";
			$this->regionID->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->regionID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->regionID->EditValue = $arwrk;

			// branchName
			$this->branchName->EditAttrs["class"] = "form-control";
			$this->branchName->EditCustomAttributes = "";
			$this->branchName->EditValue = ew_HtmlEncode($this->branchName->CurrentValue);
			$this->branchName->PlaceHolder = ew_RemoveHtml($this->branchName->FldCaption());

			// address
			$this->address->EditAttrs["class"] = "form-control";
			$this->address->EditCustomAttributes = "";
			$this->address->EditValue = ew_HtmlEncode($this->address->CurrentValue);
			$this->address->PlaceHolder = ew_RemoveHtml($this->address->FldCaption());

			// phone
			$this->phone->EditAttrs["class"] = "form-control";
			$this->phone->EditCustomAttributes = "";
			$this->phone->EditValue = ew_HtmlEncode($this->phone->CurrentValue);
			$this->phone->PlaceHolder = ew_RemoveHtml($this->phone->FldCaption());

			// fax
			$this->fax->EditAttrs["class"] = "form-control";
			$this->fax->EditCustomAttributes = "";
			$this->fax->EditValue = ew_HtmlEncode($this->fax->CurrentValue);
			$this->fax->PlaceHolder = ew_RemoveHtml($this->fax->FldCaption());

			// email
			$this->_email->EditAttrs["class"] = "form-control";
			$this->_email->EditCustomAttributes = "";
			$this->_email->EditValue = ew_HtmlEncode($this->_email->CurrentValue);
			$this->_email->PlaceHolder = ew_RemoveHtml($this->_email->FldCaption());

			// map
			$this->map->EditAttrs["class"] = "form-control";
			$this->map->EditCustomAttributes = "";
			$this->map->EditValue = ew_HtmlEncode($this->map->CurrentValue);
			$this->map->PlaceHolder = ew_RemoveHtml($this->map->FldCaption());

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
			// locationID

			$this->locationID->LinkCustomAttributes = "";
			$this->locationID->HrefValue = "";

			// regionID
			$this->regionID->LinkCustomAttributes = "";
			$this->regionID->HrefValue = "";

			// branchName
			$this->branchName->LinkCustomAttributes = "";
			$this->branchName->HrefValue = "";

			// address
			$this->address->LinkCustomAttributes = "";
			$this->address->HrefValue = "";

			// phone
			$this->phone->LinkCustomAttributes = "";
			$this->phone->HrefValue = "";

			// fax
			$this->fax->LinkCustomAttributes = "";
			$this->fax->HrefValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";

			// map
			$this->map->LinkCustomAttributes = "";
			$this->map->HrefValue = "";

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
		}
		$rsnew = array();

		// locationID
		$this->locationID->SetDbValueDef($rsnew, $this->locationID->CurrentValue, NULL, FALSE);

		// regionID
		$this->regionID->SetDbValueDef($rsnew, $this->regionID->CurrentValue, NULL, FALSE);

		// branchName
		$this->branchName->SetDbValueDef($rsnew, $this->branchName->CurrentValue, NULL, FALSE);

		// address
		$this->address->SetDbValueDef($rsnew, $this->address->CurrentValue, NULL, FALSE);

		// phone
		$this->phone->SetDbValueDef($rsnew, $this->phone->CurrentValue, NULL, FALSE);

		// fax
		$this->fax->SetDbValueDef($rsnew, $this->fax->CurrentValue, NULL, FALSE);

		// email
		$this->_email->SetDbValueDef($rsnew, $this->_email->CurrentValue, NULL, FALSE);

		// map
		$this->map->SetDbValueDef($rsnew, $this->map->CurrentValue, NULL, FALSE);

		// so
		$this->so->SetDbValueDef($rsnew, $this->so->CurrentValue, NULL, strval($this->so->CurrentValue) == "");

		// active
		$this->active->SetDbValueDef($rsnew, $this->active->CurrentValue, NULL, strval($this->active->CurrentValue) == "");

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("brancheslist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_locationID":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `locationID` AS `LinkFld`, `locationName` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_locations`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`locationID` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->locationID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_regionID":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `regionID` AS `LinkFld`, `regionName` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `region`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`regionID` IN ({filter_value})', "t0" => "3", "fn0" => "", "f1" => '`locationID` IN ({filter_value})', "t1" => "3", "fn1" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->regionID, $sWhereWrk); // Call Lookup Selecting
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
if (!isset($branches_add)) $branches_add = new cbranches_add();

// Page init
$branches_add->Page_Init();

// Page main
$branches_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$branches_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = fbranchesadd = new ew_Form("fbranchesadd", "add");

// Validate form
fbranchesadd.Validate = function() {
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
				return this.OnError(elm, "<?php echo ew_JsEncode2($branches->so->FldErrMsg()) ?>");

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
fbranchesadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fbranchesadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fbranchesadd.Lists["x_locationID"] = {"LinkField":"x_locationID","Ajax":true,"AutoFill":false,"DisplayFields":["x_locationName","","",""],"ParentFields":[],"ChildFields":["x_regionID"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_locations"};
fbranchesadd.Lists["x_locationID"].Data = "<?php echo $branches_add->locationID->LookupFilterQuery(FALSE, "add") ?>";
fbranchesadd.Lists["x_regionID"] = {"LinkField":"x_regionID","Ajax":true,"AutoFill":false,"DisplayFields":["x_regionName","","",""],"ParentFields":["x_locationID"],"ChildFields":[],"FilterFields":["x_locationID"],"Options":[],"Template":"","LinkTable":"region"};
fbranchesadd.Lists["x_regionID"].Data = "<?php echo $branches_add->regionID->LookupFilterQuery(FALSE, "add") ?>";
fbranchesadd.Lists["x_active"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fbranchesadd.Lists["x_active"].Options = <?php echo json_encode($branches_add->active->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $branches_add->ShowPageHeader(); ?>
<?php
$branches_add->ShowMessage();
?>
<form name="fbranchesadd" id="fbranchesadd" class="<?php echo $branches_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($branches_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $branches_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="branches">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($branches_add->IsModal) ?>">
<div class="ewAddDiv"><!-- page* -->
<?php if ($branches->locationID->Visible) { // locationID ?>
	<div id="r_locationID" class="form-group">
		<label id="elh_branches_locationID" for="x_locationID" class="<?php echo $branches_add->LeftColumnClass ?>"><?php echo $branches->locationID->FldCaption() ?></label>
		<div class="<?php echo $branches_add->RightColumnClass ?>"><div<?php echo $branches->locationID->CellAttributes() ?>>
<span id="el_branches_locationID">
<?php $branches->locationID->EditAttrs["onchange"] = "ew_UpdateOpt.call(this); " . @$branches->locationID->EditAttrs["onchange"]; ?>
<select data-table="branches" data-field="x_locationID" data-value-separator="<?php echo $branches->locationID->DisplayValueSeparatorAttribute() ?>" id="x_locationID" name="x_locationID"<?php echo $branches->locationID->EditAttributes() ?>>
<?php echo $branches->locationID->SelectOptionListHtml("x_locationID") ?>
</select>
</span>
<?php echo $branches->locationID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($branches->regionID->Visible) { // regionID ?>
	<div id="r_regionID" class="form-group">
		<label id="elh_branches_regionID" for="x_regionID" class="<?php echo $branches_add->LeftColumnClass ?>"><?php echo $branches->regionID->FldCaption() ?></label>
		<div class="<?php echo $branches_add->RightColumnClass ?>"><div<?php echo $branches->regionID->CellAttributes() ?>>
<span id="el_branches_regionID">
<select data-table="branches" data-field="x_regionID" data-value-separator="<?php echo $branches->regionID->DisplayValueSeparatorAttribute() ?>" id="x_regionID" name="x_regionID"<?php echo $branches->regionID->EditAttributes() ?>>
<?php echo $branches->regionID->SelectOptionListHtml("x_regionID") ?>
</select>
</span>
<?php echo $branches->regionID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($branches->branchName->Visible) { // branchName ?>
	<div id="r_branchName" class="form-group">
		<label id="elh_branches_branchName" for="x_branchName" class="<?php echo $branches_add->LeftColumnClass ?>"><?php echo $branches->branchName->FldCaption() ?></label>
		<div class="<?php echo $branches_add->RightColumnClass ?>"><div<?php echo $branches->branchName->CellAttributes() ?>>
<span id="el_branches_branchName">
<input type="text" data-table="branches" data-field="x_branchName" name="x_branchName" id="x_branchName" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($branches->branchName->getPlaceHolder()) ?>" value="<?php echo $branches->branchName->EditValue ?>"<?php echo $branches->branchName->EditAttributes() ?>>
</span>
<?php echo $branches->branchName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($branches->address->Visible) { // address ?>
	<div id="r_address" class="form-group">
		<label id="elh_branches_address" for="x_address" class="<?php echo $branches_add->LeftColumnClass ?>"><?php echo $branches->address->FldCaption() ?></label>
		<div class="<?php echo $branches_add->RightColumnClass ?>"><div<?php echo $branches->address->CellAttributes() ?>>
<span id="el_branches_address">
<textarea data-table="branches" data-field="x_address" name="x_address" id="x_address" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($branches->address->getPlaceHolder()) ?>"<?php echo $branches->address->EditAttributes() ?>><?php echo $branches->address->EditValue ?></textarea>
</span>
<?php echo $branches->address->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($branches->phone->Visible) { // phone ?>
	<div id="r_phone" class="form-group">
		<label id="elh_branches_phone" for="x_phone" class="<?php echo $branches_add->LeftColumnClass ?>"><?php echo $branches->phone->FldCaption() ?></label>
		<div class="<?php echo $branches_add->RightColumnClass ?>"><div<?php echo $branches->phone->CellAttributes() ?>>
<span id="el_branches_phone">
<input type="text" data-table="branches" data-field="x_phone" name="x_phone" id="x_phone" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($branches->phone->getPlaceHolder()) ?>" value="<?php echo $branches->phone->EditValue ?>"<?php echo $branches->phone->EditAttributes() ?>>
</span>
<?php echo $branches->phone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($branches->fax->Visible) { // fax ?>
	<div id="r_fax" class="form-group">
		<label id="elh_branches_fax" for="x_fax" class="<?php echo $branches_add->LeftColumnClass ?>"><?php echo $branches->fax->FldCaption() ?></label>
		<div class="<?php echo $branches_add->RightColumnClass ?>"><div<?php echo $branches->fax->CellAttributes() ?>>
<span id="el_branches_fax">
<input type="text" data-table="branches" data-field="x_fax" name="x_fax" id="x_fax" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($branches->fax->getPlaceHolder()) ?>" value="<?php echo $branches->fax->EditValue ?>"<?php echo $branches->fax->EditAttributes() ?>>
</span>
<?php echo $branches->fax->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($branches->_email->Visible) { // email ?>
	<div id="r__email" class="form-group">
		<label id="elh_branches__email" for="x__email" class="<?php echo $branches_add->LeftColumnClass ?>"><?php echo $branches->_email->FldCaption() ?></label>
		<div class="<?php echo $branches_add->RightColumnClass ?>"><div<?php echo $branches->_email->CellAttributes() ?>>
<span id="el_branches__email">
<input type="text" data-table="branches" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($branches->_email->getPlaceHolder()) ?>" value="<?php echo $branches->_email->EditValue ?>"<?php echo $branches->_email->EditAttributes() ?>>
</span>
<?php echo $branches->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($branches->map->Visible) { // map ?>
	<div id="r_map" class="form-group">
		<label id="elh_branches_map" for="x_map" class="<?php echo $branches_add->LeftColumnClass ?>"><?php echo $branches->map->FldCaption() ?></label>
		<div class="<?php echo $branches_add->RightColumnClass ?>"><div<?php echo $branches->map->CellAttributes() ?>>
<span id="el_branches_map">
<input type="text" data-table="branches" data-field="x_map" name="x_map" id="x_map" placeholder="<?php echo ew_HtmlEncode($branches->map->getPlaceHolder()) ?>" value="<?php echo $branches->map->EditValue ?>"<?php echo $branches->map->EditAttributes() ?>>
</span>
<?php echo $branches->map->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($branches->so->Visible) { // so ?>
	<div id="r_so" class="form-group">
		<label id="elh_branches_so" for="x_so" class="<?php echo $branches_add->LeftColumnClass ?>"><?php echo $branches->so->FldCaption() ?></label>
		<div class="<?php echo $branches_add->RightColumnClass ?>"><div<?php echo $branches->so->CellAttributes() ?>>
<span id="el_branches_so">
<input type="text" data-table="branches" data-field="x_so" name="x_so" id="x_so" size="30" placeholder="<?php echo ew_HtmlEncode($branches->so->getPlaceHolder()) ?>" value="<?php echo $branches->so->EditValue ?>"<?php echo $branches->so->EditAttributes() ?>>
</span>
<?php echo $branches->so->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($branches->active->Visible) { // active ?>
	<div id="r_active" class="form-group">
		<label id="elh_branches_active" for="x_active" class="<?php echo $branches_add->LeftColumnClass ?>"><?php echo $branches->active->FldCaption() ?></label>
		<div class="<?php echo $branches_add->RightColumnClass ?>"><div<?php echo $branches->active->CellAttributes() ?>>
<span id="el_branches_active">
<select data-table="branches" data-field="x_active" data-value-separator="<?php echo $branches->active->DisplayValueSeparatorAttribute() ?>" id="x_active" name="x_active"<?php echo $branches->active->EditAttributes() ?>>
<?php echo $branches->active->SelectOptionListHtml("x_active") ?>
</select>
</span>
<?php echo $branches->active->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$branches_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $branches_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $branches_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fbranchesadd.Init();
</script>
<?php
$branches_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$branches_add->Page_Terminate();
?>
