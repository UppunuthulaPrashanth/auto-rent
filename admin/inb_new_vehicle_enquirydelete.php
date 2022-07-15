<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "inb_new_vehicle_enquiryinfo.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$inb_new_vehicle_enquiry_delete = NULL; // Initialize page object first

class cinb_new_vehicle_enquiry_delete extends cinb_new_vehicle_enquiry {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'inb_new_vehicle_enquiry';

	// Page object name
	var $PageObjName = 'inb_new_vehicle_enquiry_delete';

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

		// Table object (inb_new_vehicle_enquiry)
		if (!isset($GLOBALS["inb_new_vehicle_enquiry"]) || get_class($GLOBALS["inb_new_vehicle_enquiry"]) == "cinb_new_vehicle_enquiry") {
			$GLOBALS["inb_new_vehicle_enquiry"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["inb_new_vehicle_enquiry"];
		}

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'inb_new_vehicle_enquiry', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("inb_new_vehicle_enquirylist.php"));
			else
				$this->Page_Terminate(ew_GetUrl("login.php"));
		}

		// NOTE: Security object may be needed in other part of the script, skip set to Nothing
		// 
		// Security = null;
		// 

		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->id->SetVisibility();
		$this->id->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
		$this->selectedType->SetVisibility();
		$this->individualFirstName->SetVisibility();
		$this->corporateCompanyName->SetVisibility();
		$this->corporateFullName->SetVisibility();
		$this->individualLastName->SetVisibility();
		$this->individualVehicle->SetVisibility();
		$this->corporateVehicle->SetVisibility();
		$this->_email->SetVisibility();
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
		global $EW_EXPORT, $inb_new_vehicle_enquiry;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($inb_new_vehicle_enquiry);
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
			$this->Page_Terminate("inb_new_vehicle_enquirylist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in inb_new_vehicle_enquiry class, inb_new_vehicle_enquiryinfo.php

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
				$this->Page_Terminate("inb_new_vehicle_enquirylist.php"); // Return to list
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
		$this->id->setDbValue($row['id']);
		$this->selectedType->setDbValue($row['selectedType']);
		$this->individualFirstName->setDbValue($row['individualFirstName']);
		$this->corporateCompanyName->setDbValue($row['corporateCompanyName']);
		$this->corporateFullName->setDbValue($row['corporateFullName']);
		$this->individualLastName->setDbValue($row['individualLastName']);
		$this->individualVehicle->setDbValue($row['individualVehicle']);
		$this->corporateVehicle->setDbValue($row['corporateVehicle']);
		$this->corporateNoOfVehicle->setDbValue($row['corporateNoOfVehicle']);
		$this->_email->setDbValue($row['email']);
		$this->phone->setDbValue($row['phone']);
		$this->country->setDbValue($row['country']);
		$this->city->setDbValue($row['city']);
		$this->individualSpecificRequirement->setDbValue($row['individualSpecificRequirement']);
		$this->corporateSpecificRequirement->setDbValue($row['corporateSpecificRequirement']);
		$this->dateCreated->setDbValue($row['dateCreated']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['id'] = NULL;
		$row['selectedType'] = NULL;
		$row['individualFirstName'] = NULL;
		$row['corporateCompanyName'] = NULL;
		$row['corporateFullName'] = NULL;
		$row['individualLastName'] = NULL;
		$row['individualVehicle'] = NULL;
		$row['corporateVehicle'] = NULL;
		$row['corporateNoOfVehicle'] = NULL;
		$row['email'] = NULL;
		$row['phone'] = NULL;
		$row['country'] = NULL;
		$row['city'] = NULL;
		$row['individualSpecificRequirement'] = NULL;
		$row['corporateSpecificRequirement'] = NULL;
		$row['dateCreated'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->selectedType->DbValue = $row['selectedType'];
		$this->individualFirstName->DbValue = $row['individualFirstName'];
		$this->corporateCompanyName->DbValue = $row['corporateCompanyName'];
		$this->corporateFullName->DbValue = $row['corporateFullName'];
		$this->individualLastName->DbValue = $row['individualLastName'];
		$this->individualVehicle->DbValue = $row['individualVehicle'];
		$this->corporateVehicle->DbValue = $row['corporateVehicle'];
		$this->corporateNoOfVehicle->DbValue = $row['corporateNoOfVehicle'];
		$this->_email->DbValue = $row['email'];
		$this->phone->DbValue = $row['phone'];
		$this->country->DbValue = $row['country'];
		$this->city->DbValue = $row['city'];
		$this->individualSpecificRequirement->DbValue = $row['individualSpecificRequirement'];
		$this->corporateSpecificRequirement->DbValue = $row['corporateSpecificRequirement'];
		$this->dateCreated->DbValue = $row['dateCreated'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// selectedType
		// individualFirstName
		// corporateCompanyName
		// corporateFullName
		// individualLastName
		// individualVehicle
		// corporateVehicle
		// corporateNoOfVehicle
		// email
		// phone
		// country
		// city
		// individualSpecificRequirement
		// corporateSpecificRequirement
		// dateCreated

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// selectedType
		$this->selectedType->ViewValue = $this->selectedType->CurrentValue;
		$this->selectedType->ViewCustomAttributes = "";

		// individualFirstName
		$this->individualFirstName->ViewValue = $this->individualFirstName->CurrentValue;
		$this->individualFirstName->ViewCustomAttributes = "";

		// corporateCompanyName
		$this->corporateCompanyName->ViewValue = $this->corporateCompanyName->CurrentValue;
		$this->corporateCompanyName->ViewCustomAttributes = "";

		// corporateFullName
		$this->corporateFullName->ViewValue = $this->corporateFullName->CurrentValue;
		$this->corporateFullName->ViewCustomAttributes = "";

		// individualLastName
		$this->individualLastName->ViewValue = $this->individualLastName->CurrentValue;
		$this->individualLastName->ViewCustomAttributes = "";

		// individualVehicle
		$this->individualVehicle->ViewValue = $this->individualVehicle->CurrentValue;
		$this->individualVehicle->ViewCustomAttributes = "";

		// corporateVehicle
		$this->corporateVehicle->ViewValue = $this->corporateVehicle->CurrentValue;
		$this->corporateVehicle->ViewCustomAttributes = "";

		// corporateNoOfVehicle
		$this->corporateNoOfVehicle->ViewValue = $this->corporateNoOfVehicle->CurrentValue;
		$this->corporateNoOfVehicle->ViewCustomAttributes = "";

		// email
		$this->_email->ViewValue = $this->_email->CurrentValue;
		$this->_email->ViewCustomAttributes = "";

		// phone
		$this->phone->ViewValue = $this->phone->CurrentValue;
		$this->phone->ViewCustomAttributes = "";

		// country
		$this->country->ViewValue = $this->country->CurrentValue;
		$this->country->ViewCustomAttributes = "";

		// city
		$this->city->ViewValue = $this->city->CurrentValue;
		$this->city->ViewCustomAttributes = "";

		// dateCreated
		$this->dateCreated->ViewValue = $this->dateCreated->CurrentValue;
		$this->dateCreated->ViewValue = ew_FormatDateTime($this->dateCreated->ViewValue, 0);
		$this->dateCreated->ViewCustomAttributes = "";

			// id
			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";
			$this->id->TooltipValue = "";

			// selectedType
			$this->selectedType->LinkCustomAttributes = "";
			$this->selectedType->HrefValue = "";
			$this->selectedType->TooltipValue = "";

			// individualFirstName
			$this->individualFirstName->LinkCustomAttributes = "";
			$this->individualFirstName->HrefValue = "";
			$this->individualFirstName->TooltipValue = "";

			// corporateCompanyName
			$this->corporateCompanyName->LinkCustomAttributes = "";
			$this->corporateCompanyName->HrefValue = "";
			$this->corporateCompanyName->TooltipValue = "";

			// corporateFullName
			$this->corporateFullName->LinkCustomAttributes = "";
			$this->corporateFullName->HrefValue = "";
			$this->corporateFullName->TooltipValue = "";

			// individualLastName
			$this->individualLastName->LinkCustomAttributes = "";
			$this->individualLastName->HrefValue = "";
			$this->individualLastName->TooltipValue = "";

			// individualVehicle
			$this->individualVehicle->LinkCustomAttributes = "";
			$this->individualVehicle->HrefValue = "";
			$this->individualVehicle->TooltipValue = "";

			// corporateVehicle
			$this->corporateVehicle->LinkCustomAttributes = "";
			$this->corporateVehicle->HrefValue = "";
			$this->corporateVehicle->TooltipValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";
			$this->_email->TooltipValue = "";

			// dateCreated
			$this->dateCreated->LinkCustomAttributes = "";
			$this->dateCreated->HrefValue = "";
			$this->dateCreated->TooltipValue = "";
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
				$sThisKey .= $row['id'];
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("inb_new_vehicle_enquirylist.php"), "", $this->TableVar, TRUE);
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
if (!isset($inb_new_vehicle_enquiry_delete)) $inb_new_vehicle_enquiry_delete = new cinb_new_vehicle_enquiry_delete();

// Page init
$inb_new_vehicle_enquiry_delete->Page_Init();

// Page main
$inb_new_vehicle_enquiry_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inb_new_vehicle_enquiry_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = finb_new_vehicle_enquirydelete = new ew_Form("finb_new_vehicle_enquirydelete", "delete");

// Form_CustomValidate event
finb_new_vehicle_enquirydelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
finb_new_vehicle_enquirydelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $inb_new_vehicle_enquiry_delete->ShowPageHeader(); ?>
<?php
$inb_new_vehicle_enquiry_delete->ShowMessage();
?>
<form name="finb_new_vehicle_enquirydelete" id="finb_new_vehicle_enquirydelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($inb_new_vehicle_enquiry_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $inb_new_vehicle_enquiry_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inb_new_vehicle_enquiry">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($inb_new_vehicle_enquiry_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($inb_new_vehicle_enquiry->id->Visible) { // id ?>
		<th class="<?php echo $inb_new_vehicle_enquiry->id->HeaderCellClass() ?>"><span id="elh_inb_new_vehicle_enquiry_id" class="inb_new_vehicle_enquiry_id"><?php echo $inb_new_vehicle_enquiry->id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->selectedType->Visible) { // selectedType ?>
		<th class="<?php echo $inb_new_vehicle_enquiry->selectedType->HeaderCellClass() ?>"><span id="elh_inb_new_vehicle_enquiry_selectedType" class="inb_new_vehicle_enquiry_selectedType"><?php echo $inb_new_vehicle_enquiry->selectedType->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->individualFirstName->Visible) { // individualFirstName ?>
		<th class="<?php echo $inb_new_vehicle_enquiry->individualFirstName->HeaderCellClass() ?>"><span id="elh_inb_new_vehicle_enquiry_individualFirstName" class="inb_new_vehicle_enquiry_individualFirstName"><?php echo $inb_new_vehicle_enquiry->individualFirstName->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->corporateCompanyName->Visible) { // corporateCompanyName ?>
		<th class="<?php echo $inb_new_vehicle_enquiry->corporateCompanyName->HeaderCellClass() ?>"><span id="elh_inb_new_vehicle_enquiry_corporateCompanyName" class="inb_new_vehicle_enquiry_corporateCompanyName"><?php echo $inb_new_vehicle_enquiry->corporateCompanyName->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->corporateFullName->Visible) { // corporateFullName ?>
		<th class="<?php echo $inb_new_vehicle_enquiry->corporateFullName->HeaderCellClass() ?>"><span id="elh_inb_new_vehicle_enquiry_corporateFullName" class="inb_new_vehicle_enquiry_corporateFullName"><?php echo $inb_new_vehicle_enquiry->corporateFullName->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->individualLastName->Visible) { // individualLastName ?>
		<th class="<?php echo $inb_new_vehicle_enquiry->individualLastName->HeaderCellClass() ?>"><span id="elh_inb_new_vehicle_enquiry_individualLastName" class="inb_new_vehicle_enquiry_individualLastName"><?php echo $inb_new_vehicle_enquiry->individualLastName->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->individualVehicle->Visible) { // individualVehicle ?>
		<th class="<?php echo $inb_new_vehicle_enquiry->individualVehicle->HeaderCellClass() ?>"><span id="elh_inb_new_vehicle_enquiry_individualVehicle" class="inb_new_vehicle_enquiry_individualVehicle"><?php echo $inb_new_vehicle_enquiry->individualVehicle->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->corporateVehicle->Visible) { // corporateVehicle ?>
		<th class="<?php echo $inb_new_vehicle_enquiry->corporateVehicle->HeaderCellClass() ?>"><span id="elh_inb_new_vehicle_enquiry_corporateVehicle" class="inb_new_vehicle_enquiry_corporateVehicle"><?php echo $inb_new_vehicle_enquiry->corporateVehicle->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->_email->Visible) { // email ?>
		<th class="<?php echo $inb_new_vehicle_enquiry->_email->HeaderCellClass() ?>"><span id="elh_inb_new_vehicle_enquiry__email" class="inb_new_vehicle_enquiry__email"><?php echo $inb_new_vehicle_enquiry->_email->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->dateCreated->Visible) { // dateCreated ?>
		<th class="<?php echo $inb_new_vehicle_enquiry->dateCreated->HeaderCellClass() ?>"><span id="elh_inb_new_vehicle_enquiry_dateCreated" class="inb_new_vehicle_enquiry_dateCreated"><?php echo $inb_new_vehicle_enquiry->dateCreated->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$inb_new_vehicle_enquiry_delete->RecCnt = 0;
$i = 0;
while (!$inb_new_vehicle_enquiry_delete->Recordset->EOF) {
	$inb_new_vehicle_enquiry_delete->RecCnt++;
	$inb_new_vehicle_enquiry_delete->RowCnt++;

	// Set row properties
	$inb_new_vehicle_enquiry->ResetAttrs();
	$inb_new_vehicle_enquiry->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$inb_new_vehicle_enquiry_delete->LoadRowValues($inb_new_vehicle_enquiry_delete->Recordset);

	// Render row
	$inb_new_vehicle_enquiry_delete->RenderRow();
?>
	<tr<?php echo $inb_new_vehicle_enquiry->RowAttributes() ?>>
<?php if ($inb_new_vehicle_enquiry->id->Visible) { // id ?>
		<td<?php echo $inb_new_vehicle_enquiry->id->CellAttributes() ?>>
<span id="el<?php echo $inb_new_vehicle_enquiry_delete->RowCnt ?>_inb_new_vehicle_enquiry_id" class="inb_new_vehicle_enquiry_id">
<span<?php echo $inb_new_vehicle_enquiry->id->ViewAttributes() ?>>
<?php echo $inb_new_vehicle_enquiry->id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->selectedType->Visible) { // selectedType ?>
		<td<?php echo $inb_new_vehicle_enquiry->selectedType->CellAttributes() ?>>
<span id="el<?php echo $inb_new_vehicle_enquiry_delete->RowCnt ?>_inb_new_vehicle_enquiry_selectedType" class="inb_new_vehicle_enquiry_selectedType">
<span<?php echo $inb_new_vehicle_enquiry->selectedType->ViewAttributes() ?>>
<?php echo $inb_new_vehicle_enquiry->selectedType->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->individualFirstName->Visible) { // individualFirstName ?>
		<td<?php echo $inb_new_vehicle_enquiry->individualFirstName->CellAttributes() ?>>
<span id="el<?php echo $inb_new_vehicle_enquiry_delete->RowCnt ?>_inb_new_vehicle_enquiry_individualFirstName" class="inb_new_vehicle_enquiry_individualFirstName">
<span<?php echo $inb_new_vehicle_enquiry->individualFirstName->ViewAttributes() ?>>
<?php echo $inb_new_vehicle_enquiry->individualFirstName->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->corporateCompanyName->Visible) { // corporateCompanyName ?>
		<td<?php echo $inb_new_vehicle_enquiry->corporateCompanyName->CellAttributes() ?>>
<span id="el<?php echo $inb_new_vehicle_enquiry_delete->RowCnt ?>_inb_new_vehicle_enquiry_corporateCompanyName" class="inb_new_vehicle_enquiry_corporateCompanyName">
<span<?php echo $inb_new_vehicle_enquiry->corporateCompanyName->ViewAttributes() ?>>
<?php echo $inb_new_vehicle_enquiry->corporateCompanyName->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->corporateFullName->Visible) { // corporateFullName ?>
		<td<?php echo $inb_new_vehicle_enquiry->corporateFullName->CellAttributes() ?>>
<span id="el<?php echo $inb_new_vehicle_enquiry_delete->RowCnt ?>_inb_new_vehicle_enquiry_corporateFullName" class="inb_new_vehicle_enquiry_corporateFullName">
<span<?php echo $inb_new_vehicle_enquiry->corporateFullName->ViewAttributes() ?>>
<?php echo $inb_new_vehicle_enquiry->corporateFullName->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->individualLastName->Visible) { // individualLastName ?>
		<td<?php echo $inb_new_vehicle_enquiry->individualLastName->CellAttributes() ?>>
<span id="el<?php echo $inb_new_vehicle_enquiry_delete->RowCnt ?>_inb_new_vehicle_enquiry_individualLastName" class="inb_new_vehicle_enquiry_individualLastName">
<span<?php echo $inb_new_vehicle_enquiry->individualLastName->ViewAttributes() ?>>
<?php echo $inb_new_vehicle_enquiry->individualLastName->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->individualVehicle->Visible) { // individualVehicle ?>
		<td<?php echo $inb_new_vehicle_enquiry->individualVehicle->CellAttributes() ?>>
<span id="el<?php echo $inb_new_vehicle_enquiry_delete->RowCnt ?>_inb_new_vehicle_enquiry_individualVehicle" class="inb_new_vehicle_enquiry_individualVehicle">
<span<?php echo $inb_new_vehicle_enquiry->individualVehicle->ViewAttributes() ?>>
<?php echo $inb_new_vehicle_enquiry->individualVehicle->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->corporateVehicle->Visible) { // corporateVehicle ?>
		<td<?php echo $inb_new_vehicle_enquiry->corporateVehicle->CellAttributes() ?>>
<span id="el<?php echo $inb_new_vehicle_enquiry_delete->RowCnt ?>_inb_new_vehicle_enquiry_corporateVehicle" class="inb_new_vehicle_enquiry_corporateVehicle">
<span<?php echo $inb_new_vehicle_enquiry->corporateVehicle->ViewAttributes() ?>>
<?php echo $inb_new_vehicle_enquiry->corporateVehicle->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->_email->Visible) { // email ?>
		<td<?php echo $inb_new_vehicle_enquiry->_email->CellAttributes() ?>>
<span id="el<?php echo $inb_new_vehicle_enquiry_delete->RowCnt ?>_inb_new_vehicle_enquiry__email" class="inb_new_vehicle_enquiry__email">
<span<?php echo $inb_new_vehicle_enquiry->_email->ViewAttributes() ?>>
<?php echo $inb_new_vehicle_enquiry->_email->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_new_vehicle_enquiry->dateCreated->Visible) { // dateCreated ?>
		<td<?php echo $inb_new_vehicle_enquiry->dateCreated->CellAttributes() ?>>
<span id="el<?php echo $inb_new_vehicle_enquiry_delete->RowCnt ?>_inb_new_vehicle_enquiry_dateCreated" class="inb_new_vehicle_enquiry_dateCreated">
<span<?php echo $inb_new_vehicle_enquiry->dateCreated->ViewAttributes() ?>>
<?php echo $inb_new_vehicle_enquiry->dateCreated->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$inb_new_vehicle_enquiry_delete->Recordset->MoveNext();
}
$inb_new_vehicle_enquiry_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $inb_new_vehicle_enquiry_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
finb_new_vehicle_enquirydelete.Init();
</script>
<?php
$inb_new_vehicle_enquiry_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$inb_new_vehicle_enquiry_delete->Page_Terminate();
?>
