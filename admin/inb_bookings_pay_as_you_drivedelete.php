<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "inb_bookings_pay_as_you_driveinfo.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$inb_bookings_pay_as_you_drive_delete = NULL; // Initialize page object first

class cinb_bookings_pay_as_you_drive_delete extends cinb_bookings_pay_as_you_drive {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'inb_bookings_pay_as_you_drive';

	// Page object name
	var $PageObjName = 'inb_bookings_pay_as_you_drive_delete';

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

		// Table object (inb_bookings_pay_as_you_drive)
		if (!isset($GLOBALS["inb_bookings_pay_as_you_drive"]) || get_class($GLOBALS["inb_bookings_pay_as_you_drive"]) == "cinb_bookings_pay_as_you_drive") {
			$GLOBALS["inb_bookings_pay_as_you_drive"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["inb_bookings_pay_as_you_drive"];
		}

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'inb_bookings_pay_as_you_drive', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("inb_bookings_pay_as_you_drivelist.php"));
			else
				$this->Page_Terminate(ew_GetUrl("login.php"));
		}

		// NOTE: Security object may be needed in other part of the script, skip set to Nothing
		// 
		// Security = null;
		// 

		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->bookingID->SetVisibility();
		$this->bookingID->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
		$this->bookingNumber->SetVisibility();
		$this->_userID->SetVisibility();
		$this->payDriveCarID->SetVisibility();
		$this->pickUpLocation->SetVisibility();
		$this->dropLocation->SetVisibility();
		$this->pickUpDate->SetVisibility();
		$this->dropDate->SetVisibility();
		$this->noOfDays->SetVisibility();
		$this->bookingTerm->SetVisibility();
		$this->rentalAmount->SetVisibility();
		$this->totalAmount->SetVisibility();
		$this->grandTotal->SetVisibility();
		$this->paymentMethod->SetVisibility();
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
		global $EW_EXPORT, $inb_bookings_pay_as_you_drive;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($inb_bookings_pay_as_you_drive);
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
			$this->Page_Terminate("inb_bookings_pay_as_you_drivelist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in inb_bookings_pay_as_you_drive class, inb_bookings_pay_as_you_driveinfo.php

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
				$this->Page_Terminate("inb_bookings_pay_as_you_drivelist.php"); // Return to list
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
		$this->bookingID->setDbValue($row['bookingID']);
		$this->bookingNumber->setDbValue($row['bookingNumber']);
		$this->_userID->setDbValue($row['userID']);
		$this->payDriveCarID->setDbValue($row['payDriveCarID']);
		$this->pickUpLocation->setDbValue($row['pickUpLocation']);
		$this->dropLocation->setDbValue($row['dropLocation']);
		$this->pickUpDate->setDbValue($row['pickUpDate']);
		$this->dropDate->setDbValue($row['dropDate']);
		$this->noOfDays->setDbValue($row['noOfDays']);
		$this->bookingTerm->setDbValue($row['bookingTerm']);
		$this->slab->setDbValue($row['slab']);
		$this->orangeCard->setDbValue($row['orangeCard']);
		$this->gps->setDbValue($row['gps']);
		$this->deliveryCharge->setDbValue($row['deliveryCharge']);
		$this->collectionCharge->setDbValue($row['collectionCharge']);
		$this->rentalAmount->setDbValue($row['rentalAmount']);
		$this->totalAmount->setDbValue($row['totalAmount']);
		$this->vat->setDbValue($row['vat']);
		$this->grandTotal->setDbValue($row['grandTotal']);
		$this->deliveryAddress->setDbValue($row['deliveryAddress']);
		$this->paymentMethod->setDbValue($row['paymentMethod']);
		$this->dateCreated->setDbValue($row['dateCreated']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['bookingID'] = NULL;
		$row['bookingNumber'] = NULL;
		$row['userID'] = NULL;
		$row['payDriveCarID'] = NULL;
		$row['pickUpLocation'] = NULL;
		$row['dropLocation'] = NULL;
		$row['pickUpDate'] = NULL;
		$row['dropDate'] = NULL;
		$row['noOfDays'] = NULL;
		$row['bookingTerm'] = NULL;
		$row['slab'] = NULL;
		$row['orangeCard'] = NULL;
		$row['gps'] = NULL;
		$row['deliveryCharge'] = NULL;
		$row['collectionCharge'] = NULL;
		$row['rentalAmount'] = NULL;
		$row['totalAmount'] = NULL;
		$row['vat'] = NULL;
		$row['grandTotal'] = NULL;
		$row['deliveryAddress'] = NULL;
		$row['paymentMethod'] = NULL;
		$row['dateCreated'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->bookingID->DbValue = $row['bookingID'];
		$this->bookingNumber->DbValue = $row['bookingNumber'];
		$this->_userID->DbValue = $row['userID'];
		$this->payDriveCarID->DbValue = $row['payDriveCarID'];
		$this->pickUpLocation->DbValue = $row['pickUpLocation'];
		$this->dropLocation->DbValue = $row['dropLocation'];
		$this->pickUpDate->DbValue = $row['pickUpDate'];
		$this->dropDate->DbValue = $row['dropDate'];
		$this->noOfDays->DbValue = $row['noOfDays'];
		$this->bookingTerm->DbValue = $row['bookingTerm'];
		$this->slab->DbValue = $row['slab'];
		$this->orangeCard->DbValue = $row['orangeCard'];
		$this->gps->DbValue = $row['gps'];
		$this->deliveryCharge->DbValue = $row['deliveryCharge'];
		$this->collectionCharge->DbValue = $row['collectionCharge'];
		$this->rentalAmount->DbValue = $row['rentalAmount'];
		$this->totalAmount->DbValue = $row['totalAmount'];
		$this->vat->DbValue = $row['vat'];
		$this->grandTotal->DbValue = $row['grandTotal'];
		$this->deliveryAddress->DbValue = $row['deliveryAddress'];
		$this->paymentMethod->DbValue = $row['paymentMethod'];
		$this->dateCreated->DbValue = $row['dateCreated'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->rentalAmount->FormValue == $this->rentalAmount->CurrentValue && is_numeric(ew_StrToFloat($this->rentalAmount->CurrentValue)))
			$this->rentalAmount->CurrentValue = ew_StrToFloat($this->rentalAmount->CurrentValue);

		// Convert decimal values if posted back
		if ($this->totalAmount->FormValue == $this->totalAmount->CurrentValue && is_numeric(ew_StrToFloat($this->totalAmount->CurrentValue)))
			$this->totalAmount->CurrentValue = ew_StrToFloat($this->totalAmount->CurrentValue);

		// Convert decimal values if posted back
		if ($this->grandTotal->FormValue == $this->grandTotal->CurrentValue && is_numeric(ew_StrToFloat($this->grandTotal->CurrentValue)))
			$this->grandTotal->CurrentValue = ew_StrToFloat($this->grandTotal->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// bookingID
		// bookingNumber
		// userID
		// payDriveCarID
		// pickUpLocation
		// dropLocation
		// pickUpDate
		// dropDate
		// noOfDays
		// bookingTerm
		// slab
		// orangeCard
		// gps
		// deliveryCharge
		// collectionCharge
		// rentalAmount
		// totalAmount
		// vat
		// grandTotal
		// deliveryAddress
		// paymentMethod
		// dateCreated

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// bookingID
		$this->bookingID->ViewValue = $this->bookingID->CurrentValue;
		$this->bookingID->ViewCustomAttributes = "";

		// bookingNumber
		$this->bookingNumber->ViewValue = $this->bookingNumber->CurrentValue;
		$this->bookingNumber->ViewCustomAttributes = "";

		// userID
		if (strval($this->_userID->CurrentValue) <> "") {
			$sFilterWrk = "`userID`" . ew_SearchString("=", $this->_userID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `userID`, `firstName` AS `DispFld`, `lastName` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `users`";
		$sWhereWrk = "";
		$this->_userID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->_userID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->_userID->ViewValue = $this->_userID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->_userID->ViewValue = $this->_userID->CurrentValue;
			}
		} else {
			$this->_userID->ViewValue = NULL;
		}
		$this->_userID->ViewCustomAttributes = "";

		// payDriveCarID
		if (strval($this->payDriveCarID->CurrentValue) <> "") {
			$sFilterWrk = "`payDriveCarID`" . ew_SearchString("=", $this->payDriveCarID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `payDriveCarID`, `carTitle` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `pay_as_you_drive`";
		$sWhereWrk = "";
		$this->payDriveCarID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->payDriveCarID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->payDriveCarID->ViewValue = $this->payDriveCarID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->payDriveCarID->ViewValue = $this->payDriveCarID->CurrentValue;
			}
		} else {
			$this->payDriveCarID->ViewValue = NULL;
		}
		$this->payDriveCarID->ViewCustomAttributes = "";

		// pickUpLocation
		if (strval($this->pickUpLocation->CurrentValue) <> "") {
			$sFilterWrk = "`pdLocationID`" . ew_SearchString("=", $this->pickUpLocation->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `pdLocationID`, `location` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `pickup_drop_locations`";
		$sWhereWrk = "";
		$this->pickUpLocation->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->pickUpLocation, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->pickUpLocation->ViewValue = $this->pickUpLocation->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->pickUpLocation->ViewValue = $this->pickUpLocation->CurrentValue;
			}
		} else {
			$this->pickUpLocation->ViewValue = NULL;
		}
		$this->pickUpLocation->ViewCustomAttributes = "";

		// dropLocation
		if (strval($this->dropLocation->CurrentValue) <> "") {
			$sFilterWrk = "`pdLocationID`" . ew_SearchString("=", $this->dropLocation->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `pdLocationID`, `location` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `pickup_drop_locations`";
		$sWhereWrk = "";
		$this->dropLocation->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->dropLocation, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->dropLocation->ViewValue = $this->dropLocation->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->dropLocation->ViewValue = $this->dropLocation->CurrentValue;
			}
		} else {
			$this->dropLocation->ViewValue = NULL;
		}
		$this->dropLocation->ViewCustomAttributes = "";

		// pickUpDate
		$this->pickUpDate->ViewValue = $this->pickUpDate->CurrentValue;
		$this->pickUpDate->ViewValue = ew_FormatDateTime($this->pickUpDate->ViewValue, 7);
		$this->pickUpDate->ViewCustomAttributes = "";

		// dropDate
		$this->dropDate->ViewValue = $this->dropDate->CurrentValue;
		$this->dropDate->ViewValue = ew_FormatDateTime($this->dropDate->ViewValue, 7);
		$this->dropDate->ViewCustomAttributes = "";

		// noOfDays
		$this->noOfDays->ViewValue = $this->noOfDays->CurrentValue;
		$this->noOfDays->ViewCustomAttributes = "";

		// bookingTerm
		$this->bookingTerm->ViewValue = $this->bookingTerm->CurrentValue;
		$this->bookingTerm->ViewCustomAttributes = "";

		// slab
		$this->slab->ViewValue = $this->slab->CurrentValue;
		$this->slab->ViewCustomAttributes = "";

		// orangeCard
		$this->orangeCard->ViewValue = $this->orangeCard->CurrentValue;
		$this->orangeCard->ViewCustomAttributes = "";

		// gps
		$this->gps->ViewValue = $this->gps->CurrentValue;
		$this->gps->ViewCustomAttributes = "";

		// deliveryCharge
		$this->deliveryCharge->ViewValue = $this->deliveryCharge->CurrentValue;
		$this->deliveryCharge->ViewCustomAttributes = "";

		// collectionCharge
		$this->collectionCharge->ViewValue = $this->collectionCharge->CurrentValue;
		$this->collectionCharge->ViewCustomAttributes = "";

		// rentalAmount
		$this->rentalAmount->ViewValue = $this->rentalAmount->CurrentValue;
		$this->rentalAmount->ViewCustomAttributes = "";

		// totalAmount
		$this->totalAmount->ViewValue = $this->totalAmount->CurrentValue;
		$this->totalAmount->ViewCustomAttributes = "";

		// vat
		$this->vat->ViewValue = $this->vat->CurrentValue;
		$this->vat->ViewCustomAttributes = "";

		// grandTotal
		$this->grandTotal->ViewValue = $this->grandTotal->CurrentValue;
		$this->grandTotal->ViewCustomAttributes = "";

		// deliveryAddress
		$this->deliveryAddress->ViewValue = $this->deliveryAddress->CurrentValue;
		$this->deliveryAddress->ViewCustomAttributes = "";

		// paymentMethod
		if (strval($this->paymentMethod->CurrentValue) <> "") {
			$this->paymentMethod->ViewValue = $this->paymentMethod->OptionCaption($this->paymentMethod->CurrentValue);
		} else {
			$this->paymentMethod->ViewValue = NULL;
		}
		$this->paymentMethod->ViewCustomAttributes = "";

		// dateCreated
		$this->dateCreated->ViewValue = $this->dateCreated->CurrentValue;
		$this->dateCreated->ViewValue = ew_FormatDateTime($this->dateCreated->ViewValue, 7);
		$this->dateCreated->ViewCustomAttributes = "";

			// bookingID
			$this->bookingID->LinkCustomAttributes = "";
			$this->bookingID->HrefValue = "";
			$this->bookingID->TooltipValue = "";

			// bookingNumber
			$this->bookingNumber->LinkCustomAttributes = "";
			$this->bookingNumber->HrefValue = "";
			$this->bookingNumber->TooltipValue = "";

			// userID
			$this->_userID->LinkCustomAttributes = "";
			$this->_userID->HrefValue = "";
			$this->_userID->TooltipValue = "";

			// payDriveCarID
			$this->payDriveCarID->LinkCustomAttributes = "";
			$this->payDriveCarID->HrefValue = "";
			$this->payDriveCarID->TooltipValue = "";

			// pickUpLocation
			$this->pickUpLocation->LinkCustomAttributes = "";
			$this->pickUpLocation->HrefValue = "";
			$this->pickUpLocation->TooltipValue = "";

			// dropLocation
			$this->dropLocation->LinkCustomAttributes = "";
			$this->dropLocation->HrefValue = "";
			$this->dropLocation->TooltipValue = "";

			// pickUpDate
			$this->pickUpDate->LinkCustomAttributes = "";
			$this->pickUpDate->HrefValue = "";
			$this->pickUpDate->TooltipValue = "";

			// dropDate
			$this->dropDate->LinkCustomAttributes = "";
			$this->dropDate->HrefValue = "";
			$this->dropDate->TooltipValue = "";

			// noOfDays
			$this->noOfDays->LinkCustomAttributes = "";
			$this->noOfDays->HrefValue = "";
			$this->noOfDays->TooltipValue = "";

			// bookingTerm
			$this->bookingTerm->LinkCustomAttributes = "";
			$this->bookingTerm->HrefValue = "";
			$this->bookingTerm->TooltipValue = "";

			// rentalAmount
			$this->rentalAmount->LinkCustomAttributes = "";
			$this->rentalAmount->HrefValue = "";
			$this->rentalAmount->TooltipValue = "";

			// totalAmount
			$this->totalAmount->LinkCustomAttributes = "";
			$this->totalAmount->HrefValue = "";
			$this->totalAmount->TooltipValue = "";

			// grandTotal
			$this->grandTotal->LinkCustomAttributes = "";
			$this->grandTotal->HrefValue = "";
			$this->grandTotal->TooltipValue = "";

			// paymentMethod
			$this->paymentMethod->LinkCustomAttributes = "";
			$this->paymentMethod->HrefValue = "";
			$this->paymentMethod->TooltipValue = "";

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
				$sThisKey .= $row['bookingID'];
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("inb_bookings_pay_as_you_drivelist.php"), "", $this->TableVar, TRUE);
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
if (!isset($inb_bookings_pay_as_you_drive_delete)) $inb_bookings_pay_as_you_drive_delete = new cinb_bookings_pay_as_you_drive_delete();

// Page init
$inb_bookings_pay_as_you_drive_delete->Page_Init();

// Page main
$inb_bookings_pay_as_you_drive_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inb_bookings_pay_as_you_drive_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = finb_bookings_pay_as_you_drivedelete = new ew_Form("finb_bookings_pay_as_you_drivedelete", "delete");

// Form_CustomValidate event
finb_bookings_pay_as_you_drivedelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
finb_bookings_pay_as_you_drivedelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
finb_bookings_pay_as_you_drivedelete.Lists["x__userID"] = {"LinkField":"x__userID","Ajax":true,"AutoFill":false,"DisplayFields":["x_firstName","x_lastName","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"users"};
finb_bookings_pay_as_you_drivedelete.Lists["x__userID"].Data = "<?php echo $inb_bookings_pay_as_you_drive_delete->_userID->LookupFilterQuery(FALSE, "delete") ?>";
finb_bookings_pay_as_you_drivedelete.Lists["x_payDriveCarID"] = {"LinkField":"x_payDriveCarID","Ajax":true,"AutoFill":false,"DisplayFields":["x_carTitle","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"pay_as_you_drive"};
finb_bookings_pay_as_you_drivedelete.Lists["x_payDriveCarID"].Data = "<?php echo $inb_bookings_pay_as_you_drive_delete->payDriveCarID->LookupFilterQuery(FALSE, "delete") ?>";
finb_bookings_pay_as_you_drivedelete.Lists["x_pickUpLocation"] = {"LinkField":"x_pdLocationID","Ajax":true,"AutoFill":false,"DisplayFields":["x_location","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"pickup_drop_locations"};
finb_bookings_pay_as_you_drivedelete.Lists["x_pickUpLocation"].Data = "<?php echo $inb_bookings_pay_as_you_drive_delete->pickUpLocation->LookupFilterQuery(FALSE, "delete") ?>";
finb_bookings_pay_as_you_drivedelete.Lists["x_dropLocation"] = {"LinkField":"x_pdLocationID","Ajax":true,"AutoFill":false,"DisplayFields":["x_location","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"pickup_drop_locations"};
finb_bookings_pay_as_you_drivedelete.Lists["x_dropLocation"].Data = "<?php echo $inb_bookings_pay_as_you_drive_delete->dropLocation->LookupFilterQuery(FALSE, "delete") ?>";
finb_bookings_pay_as_you_drivedelete.Lists["x_paymentMethod"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
finb_bookings_pay_as_you_drivedelete.Lists["x_paymentMethod"].Options = <?php echo json_encode($inb_bookings_pay_as_you_drive_delete->paymentMethod->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $inb_bookings_pay_as_you_drive_delete->ShowPageHeader(); ?>
<?php
$inb_bookings_pay_as_you_drive_delete->ShowMessage();
?>
<form name="finb_bookings_pay_as_you_drivedelete" id="finb_bookings_pay_as_you_drivedelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($inb_bookings_pay_as_you_drive_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $inb_bookings_pay_as_you_drive_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inb_bookings_pay_as_you_drive">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($inb_bookings_pay_as_you_drive_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($inb_bookings_pay_as_you_drive->bookingID->Visible) { // bookingID ?>
		<th class="<?php echo $inb_bookings_pay_as_you_drive->bookingID->HeaderCellClass() ?>"><span id="elh_inb_bookings_pay_as_you_drive_bookingID" class="inb_bookings_pay_as_you_drive_bookingID"><?php echo $inb_bookings_pay_as_you_drive->bookingID->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->bookingNumber->Visible) { // bookingNumber ?>
		<th class="<?php echo $inb_bookings_pay_as_you_drive->bookingNumber->HeaderCellClass() ?>"><span id="elh_inb_bookings_pay_as_you_drive_bookingNumber" class="inb_bookings_pay_as_you_drive_bookingNumber"><?php echo $inb_bookings_pay_as_you_drive->bookingNumber->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->_userID->Visible) { // userID ?>
		<th class="<?php echo $inb_bookings_pay_as_you_drive->_userID->HeaderCellClass() ?>"><span id="elh_inb_bookings_pay_as_you_drive__userID" class="inb_bookings_pay_as_you_drive__userID"><?php echo $inb_bookings_pay_as_you_drive->_userID->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->payDriveCarID->Visible) { // payDriveCarID ?>
		<th class="<?php echo $inb_bookings_pay_as_you_drive->payDriveCarID->HeaderCellClass() ?>"><span id="elh_inb_bookings_pay_as_you_drive_payDriveCarID" class="inb_bookings_pay_as_you_drive_payDriveCarID"><?php echo $inb_bookings_pay_as_you_drive->payDriveCarID->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->pickUpLocation->Visible) { // pickUpLocation ?>
		<th class="<?php echo $inb_bookings_pay_as_you_drive->pickUpLocation->HeaderCellClass() ?>"><span id="elh_inb_bookings_pay_as_you_drive_pickUpLocation" class="inb_bookings_pay_as_you_drive_pickUpLocation"><?php echo $inb_bookings_pay_as_you_drive->pickUpLocation->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->dropLocation->Visible) { // dropLocation ?>
		<th class="<?php echo $inb_bookings_pay_as_you_drive->dropLocation->HeaderCellClass() ?>"><span id="elh_inb_bookings_pay_as_you_drive_dropLocation" class="inb_bookings_pay_as_you_drive_dropLocation"><?php echo $inb_bookings_pay_as_you_drive->dropLocation->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->pickUpDate->Visible) { // pickUpDate ?>
		<th class="<?php echo $inb_bookings_pay_as_you_drive->pickUpDate->HeaderCellClass() ?>"><span id="elh_inb_bookings_pay_as_you_drive_pickUpDate" class="inb_bookings_pay_as_you_drive_pickUpDate"><?php echo $inb_bookings_pay_as_you_drive->pickUpDate->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->dropDate->Visible) { // dropDate ?>
		<th class="<?php echo $inb_bookings_pay_as_you_drive->dropDate->HeaderCellClass() ?>"><span id="elh_inb_bookings_pay_as_you_drive_dropDate" class="inb_bookings_pay_as_you_drive_dropDate"><?php echo $inb_bookings_pay_as_you_drive->dropDate->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->noOfDays->Visible) { // noOfDays ?>
		<th class="<?php echo $inb_bookings_pay_as_you_drive->noOfDays->HeaderCellClass() ?>"><span id="elh_inb_bookings_pay_as_you_drive_noOfDays" class="inb_bookings_pay_as_you_drive_noOfDays"><?php echo $inb_bookings_pay_as_you_drive->noOfDays->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->bookingTerm->Visible) { // bookingTerm ?>
		<th class="<?php echo $inb_bookings_pay_as_you_drive->bookingTerm->HeaderCellClass() ?>"><span id="elh_inb_bookings_pay_as_you_drive_bookingTerm" class="inb_bookings_pay_as_you_drive_bookingTerm"><?php echo $inb_bookings_pay_as_you_drive->bookingTerm->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->rentalAmount->Visible) { // rentalAmount ?>
		<th class="<?php echo $inb_bookings_pay_as_you_drive->rentalAmount->HeaderCellClass() ?>"><span id="elh_inb_bookings_pay_as_you_drive_rentalAmount" class="inb_bookings_pay_as_you_drive_rentalAmount"><?php echo $inb_bookings_pay_as_you_drive->rentalAmount->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->totalAmount->Visible) { // totalAmount ?>
		<th class="<?php echo $inb_bookings_pay_as_you_drive->totalAmount->HeaderCellClass() ?>"><span id="elh_inb_bookings_pay_as_you_drive_totalAmount" class="inb_bookings_pay_as_you_drive_totalAmount"><?php echo $inb_bookings_pay_as_you_drive->totalAmount->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->grandTotal->Visible) { // grandTotal ?>
		<th class="<?php echo $inb_bookings_pay_as_you_drive->grandTotal->HeaderCellClass() ?>"><span id="elh_inb_bookings_pay_as_you_drive_grandTotal" class="inb_bookings_pay_as_you_drive_grandTotal"><?php echo $inb_bookings_pay_as_you_drive->grandTotal->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->paymentMethod->Visible) { // paymentMethod ?>
		<th class="<?php echo $inb_bookings_pay_as_you_drive->paymentMethod->HeaderCellClass() ?>"><span id="elh_inb_bookings_pay_as_you_drive_paymentMethod" class="inb_bookings_pay_as_you_drive_paymentMethod"><?php echo $inb_bookings_pay_as_you_drive->paymentMethod->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->dateCreated->Visible) { // dateCreated ?>
		<th class="<?php echo $inb_bookings_pay_as_you_drive->dateCreated->HeaderCellClass() ?>"><span id="elh_inb_bookings_pay_as_you_drive_dateCreated" class="inb_bookings_pay_as_you_drive_dateCreated"><?php echo $inb_bookings_pay_as_you_drive->dateCreated->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$inb_bookings_pay_as_you_drive_delete->RecCnt = 0;
$i = 0;
while (!$inb_bookings_pay_as_you_drive_delete->Recordset->EOF) {
	$inb_bookings_pay_as_you_drive_delete->RecCnt++;
	$inb_bookings_pay_as_you_drive_delete->RowCnt++;

	// Set row properties
	$inb_bookings_pay_as_you_drive->ResetAttrs();
	$inb_bookings_pay_as_you_drive->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$inb_bookings_pay_as_you_drive_delete->LoadRowValues($inb_bookings_pay_as_you_drive_delete->Recordset);

	// Render row
	$inb_bookings_pay_as_you_drive_delete->RenderRow();
?>
	<tr<?php echo $inb_bookings_pay_as_you_drive->RowAttributes() ?>>
<?php if ($inb_bookings_pay_as_you_drive->bookingID->Visible) { // bookingID ?>
		<td<?php echo $inb_bookings_pay_as_you_drive->bookingID->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_delete->RowCnt ?>_inb_bookings_pay_as_you_drive_bookingID" class="inb_bookings_pay_as_you_drive_bookingID">
<span<?php echo $inb_bookings_pay_as_you_drive->bookingID->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->bookingID->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->bookingNumber->Visible) { // bookingNumber ?>
		<td<?php echo $inb_bookings_pay_as_you_drive->bookingNumber->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_delete->RowCnt ?>_inb_bookings_pay_as_you_drive_bookingNumber" class="inb_bookings_pay_as_you_drive_bookingNumber">
<span<?php echo $inb_bookings_pay_as_you_drive->bookingNumber->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->bookingNumber->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->_userID->Visible) { // userID ?>
		<td<?php echo $inb_bookings_pay_as_you_drive->_userID->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_delete->RowCnt ?>_inb_bookings_pay_as_you_drive__userID" class="inb_bookings_pay_as_you_drive__userID">
<span<?php echo $inb_bookings_pay_as_you_drive->_userID->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->_userID->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->payDriveCarID->Visible) { // payDriveCarID ?>
		<td<?php echo $inb_bookings_pay_as_you_drive->payDriveCarID->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_delete->RowCnt ?>_inb_bookings_pay_as_you_drive_payDriveCarID" class="inb_bookings_pay_as_you_drive_payDriveCarID">
<span<?php echo $inb_bookings_pay_as_you_drive->payDriveCarID->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->payDriveCarID->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->pickUpLocation->Visible) { // pickUpLocation ?>
		<td<?php echo $inb_bookings_pay_as_you_drive->pickUpLocation->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_delete->RowCnt ?>_inb_bookings_pay_as_you_drive_pickUpLocation" class="inb_bookings_pay_as_you_drive_pickUpLocation">
<span<?php echo $inb_bookings_pay_as_you_drive->pickUpLocation->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->pickUpLocation->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->dropLocation->Visible) { // dropLocation ?>
		<td<?php echo $inb_bookings_pay_as_you_drive->dropLocation->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_delete->RowCnt ?>_inb_bookings_pay_as_you_drive_dropLocation" class="inb_bookings_pay_as_you_drive_dropLocation">
<span<?php echo $inb_bookings_pay_as_you_drive->dropLocation->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->dropLocation->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->pickUpDate->Visible) { // pickUpDate ?>
		<td<?php echo $inb_bookings_pay_as_you_drive->pickUpDate->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_delete->RowCnt ?>_inb_bookings_pay_as_you_drive_pickUpDate" class="inb_bookings_pay_as_you_drive_pickUpDate">
<span<?php echo $inb_bookings_pay_as_you_drive->pickUpDate->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->pickUpDate->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->dropDate->Visible) { // dropDate ?>
		<td<?php echo $inb_bookings_pay_as_you_drive->dropDate->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_delete->RowCnt ?>_inb_bookings_pay_as_you_drive_dropDate" class="inb_bookings_pay_as_you_drive_dropDate">
<span<?php echo $inb_bookings_pay_as_you_drive->dropDate->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->dropDate->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->noOfDays->Visible) { // noOfDays ?>
		<td<?php echo $inb_bookings_pay_as_you_drive->noOfDays->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_delete->RowCnt ?>_inb_bookings_pay_as_you_drive_noOfDays" class="inb_bookings_pay_as_you_drive_noOfDays">
<span<?php echo $inb_bookings_pay_as_you_drive->noOfDays->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->noOfDays->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->bookingTerm->Visible) { // bookingTerm ?>
		<td<?php echo $inb_bookings_pay_as_you_drive->bookingTerm->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_delete->RowCnt ?>_inb_bookings_pay_as_you_drive_bookingTerm" class="inb_bookings_pay_as_you_drive_bookingTerm">
<span<?php echo $inb_bookings_pay_as_you_drive->bookingTerm->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->bookingTerm->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->rentalAmount->Visible) { // rentalAmount ?>
		<td<?php echo $inb_bookings_pay_as_you_drive->rentalAmount->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_delete->RowCnt ?>_inb_bookings_pay_as_you_drive_rentalAmount" class="inb_bookings_pay_as_you_drive_rentalAmount">
<span<?php echo $inb_bookings_pay_as_you_drive->rentalAmount->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->rentalAmount->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->totalAmount->Visible) { // totalAmount ?>
		<td<?php echo $inb_bookings_pay_as_you_drive->totalAmount->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_delete->RowCnt ?>_inb_bookings_pay_as_you_drive_totalAmount" class="inb_bookings_pay_as_you_drive_totalAmount">
<span<?php echo $inb_bookings_pay_as_you_drive->totalAmount->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->totalAmount->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->grandTotal->Visible) { // grandTotal ?>
		<td<?php echo $inb_bookings_pay_as_you_drive->grandTotal->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_delete->RowCnt ?>_inb_bookings_pay_as_you_drive_grandTotal" class="inb_bookings_pay_as_you_drive_grandTotal">
<span<?php echo $inb_bookings_pay_as_you_drive->grandTotal->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->grandTotal->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->paymentMethod->Visible) { // paymentMethod ?>
		<td<?php echo $inb_bookings_pay_as_you_drive->paymentMethod->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_delete->RowCnt ?>_inb_bookings_pay_as_you_drive_paymentMethod" class="inb_bookings_pay_as_you_drive_paymentMethod">
<span<?php echo $inb_bookings_pay_as_you_drive->paymentMethod->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->paymentMethod->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_bookings_pay_as_you_drive->dateCreated->Visible) { // dateCreated ?>
		<td<?php echo $inb_bookings_pay_as_you_drive->dateCreated->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_pay_as_you_drive_delete->RowCnt ?>_inb_bookings_pay_as_you_drive_dateCreated" class="inb_bookings_pay_as_you_drive_dateCreated">
<span<?php echo $inb_bookings_pay_as_you_drive->dateCreated->ViewAttributes() ?>>
<?php echo $inb_bookings_pay_as_you_drive->dateCreated->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$inb_bookings_pay_as_you_drive_delete->Recordset->MoveNext();
}
$inb_bookings_pay_as_you_drive_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $inb_bookings_pay_as_you_drive_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
finb_bookings_pay_as_you_drivedelete.Init();
</script>
<?php
$inb_bookings_pay_as_you_drive_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$inb_bookings_pay_as_you_drive_delete->Page_Terminate();
?>
