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

$users_delete = NULL; // Initialize page object first

class cusers_delete extends cusers {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'users';

	// Page object name
	var $PageObjName = 'users_delete';

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
			define("EW_PAGE_ID", 'delete', TRUE);

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

		// User profile
		$UserProfile = new cUserProfile();

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->CanDelete()) {
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
		$this->emiratesID->SetVisibility();
		$this->createdDate->SetVisibility();

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
			ew_SaveDebugMsg();
			header("Location: " . $url);
		}
		exit();
	}
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;
	var $StartRowCnt = 1;
	var $RowCnt = 0;

	//
	// Page main
	//
	function Page_Main() {
		global $Language;

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->GetRecordKeys(); // Load record keys
		$sFilter = $this->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("userslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in users class, usersinfo.php

		$this->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$this->CurrentAction = $_POST["a_delete"];
		} elseif (@$_GET["a_delete"] == "1") {
			$this->CurrentAction = "D"; // Delete record directly
		} else {
			$this->CurrentAction = "I"; // Display record
		}
		if ($this->CurrentAction == "D") {
			$this->SendEmail = TRUE; // Send email on delete success
			if ($this->DeleteRows()) { // Delete rows
				if ($this->getSuccessMessage() == "")
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
				$this->Page_Terminate($this->getReturnUrl()); // Return to caller
			} else { // Delete failed
				$this->CurrentAction = "I"; // Display record
			}
		}
		if ($this->CurrentAction == "I") { // Load records for display
			if ($this->Recordset = $this->LoadRecordset())
				$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
			if ($this->TotalRecs <= 0) { // No record found, exit
				if ($this->Recordset)
					$this->Recordset->Close();
				$this->Page_Terminate("userslist.php"); // Return to list
			}
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {

		// Load List page SQL
		$sSql = $this->ListSQL();
		$conn = &$this->Connection();

		// Load recordset
		$dbtype = ew_GetConnectionType($this->DBID);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			if ($dbtype == "MSSQL") {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset, array("_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())));
			} else {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = '';
		} else {
			$rs = ew_LoadRecordset($sSql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
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

			// emiratesID
			$this->emiratesID->LinkCustomAttributes = "";
			$this->emiratesID->HrefValue = "";
			$this->emiratesID->TooltipValue = "";

			// createdDate
			$this->createdDate->LinkCustomAttributes = "";
			$this->createdDate->HrefValue = "";
			$this->createdDate->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $Language, $Security;
		if (!$Security->CanDelete()) {
			$this->setFailureMessage($Language->Phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$DeleteRows = TRUE;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->GetRows() : array();
		$conn->BeginTrans();

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $this->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
				$sThisKey .= $row['userID'];
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				$DeleteRows = $this->Delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		}
		if (!$DeleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("userslist.php"), "", $this->TableVar, TRUE);
		$PageId = "delete";
		$Breadcrumb->Add("delete", $PageId, $url);
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
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($users_delete)) $users_delete = new cusers_delete();

// Page init
$users_delete->Page_Init();

// Page main
$users_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = fusersdelete = new ew_Form("fusersdelete", "delete");

// Form_CustomValidate event
fusersdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fusersdelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fusersdelete.Lists["x_nationality"] = {"LinkField":"x_nationalityID","Ajax":true,"AutoFill":false,"DisplayFields":["x_nationalityName","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_nationality"};
fusersdelete.Lists["x_nationality"].Data = "<?php echo $users_delete->nationality->LookupFilterQuery(FALSE, "delete") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $users_delete->ShowPageHeader(); ?>
<?php
$users_delete->ShowMessage();
?>
<form name="fusersdelete" id="fusersdelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($users_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $users_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($users_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($users->_userID->Visible) { // userID ?>
		<th class="<?php echo $users->_userID->HeaderCellClass() ?>"><span id="elh_users__userID" class="users__userID"><?php echo $users->_userID->FldCaption() ?></span></th>
<?php } ?>
<?php if ($users->firstName->Visible) { // firstName ?>
		<th class="<?php echo $users->firstName->HeaderCellClass() ?>"><span id="elh_users_firstName" class="users_firstName"><?php echo $users->firstName->FldCaption() ?></span></th>
<?php } ?>
<?php if ($users->lastName->Visible) { // lastName ?>
		<th class="<?php echo $users->lastName->HeaderCellClass() ?>"><span id="elh_users_lastName" class="users_lastName"><?php echo $users->lastName->FldCaption() ?></span></th>
<?php } ?>
<?php if ($users->emailID->Visible) { // emailID ?>
		<th class="<?php echo $users->emailID->HeaderCellClass() ?>"><span id="elh_users_emailID" class="users_emailID"><?php echo $users->emailID->FldCaption() ?></span></th>
<?php } ?>
<?php if ($users->mobileNo->Visible) { // mobileNo ?>
		<th class="<?php echo $users->mobileNo->HeaderCellClass() ?>"><span id="elh_users_mobileNo" class="users_mobileNo"><?php echo $users->mobileNo->FldCaption() ?></span></th>
<?php } ?>
<?php if ($users->country->Visible) { // country ?>
		<th class="<?php echo $users->country->HeaderCellClass() ?>"><span id="elh_users_country" class="users_country"><?php echo $users->country->FldCaption() ?></span></th>
<?php } ?>
<?php if ($users->city->Visible) { // city ?>
		<th class="<?php echo $users->city->HeaderCellClass() ?>"><span id="elh_users_city" class="users_city"><?php echo $users->city->FldCaption() ?></span></th>
<?php } ?>
<?php if ($users->nationality->Visible) { // nationality ?>
		<th class="<?php echo $users->nationality->HeaderCellClass() ?>"><span id="elh_users_nationality" class="users_nationality"><?php echo $users->nationality->FldCaption() ?></span></th>
<?php } ?>
<?php if ($users->emiratesID->Visible) { // emiratesID ?>
		<th class="<?php echo $users->emiratesID->HeaderCellClass() ?>"><span id="elh_users_emiratesID" class="users_emiratesID"><?php echo $users->emiratesID->FldCaption() ?></span></th>
<?php } ?>
<?php if ($users->createdDate->Visible) { // createdDate ?>
		<th class="<?php echo $users->createdDate->HeaderCellClass() ?>"><span id="elh_users_createdDate" class="users_createdDate"><?php echo $users->createdDate->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$users_delete->RecCnt = 0;
$i = 0;
while (!$users_delete->Recordset->EOF) {
	$users_delete->RecCnt++;
	$users_delete->RowCnt++;

	// Set row properties
	$users->ResetAttrs();
	$users->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$users_delete->LoadRowValues($users_delete->Recordset);

	// Render row
	$users_delete->RenderRow();
?>
	<tr<?php echo $users->RowAttributes() ?>>
<?php if ($users->_userID->Visible) { // userID ?>
		<td<?php echo $users->_userID->CellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCnt ?>_users__userID" class="users__userID">
<span<?php echo $users->_userID->ViewAttributes() ?>>
<?php echo $users->_userID->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users->firstName->Visible) { // firstName ?>
		<td<?php echo $users->firstName->CellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCnt ?>_users_firstName" class="users_firstName">
<span<?php echo $users->firstName->ViewAttributes() ?>>
<?php echo $users->firstName->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users->lastName->Visible) { // lastName ?>
		<td<?php echo $users->lastName->CellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCnt ?>_users_lastName" class="users_lastName">
<span<?php echo $users->lastName->ViewAttributes() ?>>
<?php echo $users->lastName->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users->emailID->Visible) { // emailID ?>
		<td<?php echo $users->emailID->CellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCnt ?>_users_emailID" class="users_emailID">
<span<?php echo $users->emailID->ViewAttributes() ?>>
<?php echo $users->emailID->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users->mobileNo->Visible) { // mobileNo ?>
		<td<?php echo $users->mobileNo->CellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCnt ?>_users_mobileNo" class="users_mobileNo">
<span<?php echo $users->mobileNo->ViewAttributes() ?>>
<?php echo $users->mobileNo->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users->country->Visible) { // country ?>
		<td<?php echo $users->country->CellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCnt ?>_users_country" class="users_country">
<span<?php echo $users->country->ViewAttributes() ?>>
<?php echo $users->country->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users->city->Visible) { // city ?>
		<td<?php echo $users->city->CellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCnt ?>_users_city" class="users_city">
<span<?php echo $users->city->ViewAttributes() ?>>
<?php echo $users->city->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users->nationality->Visible) { // nationality ?>
		<td<?php echo $users->nationality->CellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCnt ?>_users_nationality" class="users_nationality">
<span<?php echo $users->nationality->ViewAttributes() ?>>
<?php echo $users->nationality->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users->emiratesID->Visible) { // emiratesID ?>
		<td<?php echo $users->emiratesID->CellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCnt ?>_users_emiratesID" class="users_emiratesID">
<span<?php echo $users->emiratesID->ViewAttributes() ?>>
<?php echo $users->emiratesID->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users->createdDate->Visible) { // createdDate ?>
		<td<?php echo $users->createdDate->CellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCnt ?>_users_createdDate" class="users_createdDate">
<span<?php echo $users->createdDate->ViewAttributes() ?>>
<?php echo $users->createdDate->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$users_delete->Recordset->MoveNext();
}
$users_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $users_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
fusersdelete.Init();
</script>
<?php
$users_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$users_delete->Page_Terminate();
?>
