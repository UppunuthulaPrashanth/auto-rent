<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "inb_bookingsinfo.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$inb_bookings_delete = NULL; // Initialize page object first

class cinb_bookings_delete extends cinb_bookings {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'inb_bookings';

	// Page object name
	var $PageObjName = 'inb_bookings_delete';

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

		// Table object (inb_bookings)
		if (!isset($GLOBALS["inb_bookings"]) || get_class($GLOBALS["inb_bookings"]) == "cinb_bookings") {
			$GLOBALS["inb_bookings"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["inb_bookings"];
		}

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'inb_bookings', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("inb_bookingslist.php"));
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
		$this->rentLeaseCarID->SetVisibility();
		$this->pickUpLocation->SetVisibility();
		$this->dropLocation->SetVisibility();
		$this->pickUpDate->SetVisibility();
		$this->noOfDays->SetVisibility();
		$this->bookingTerm->SetVisibility();
		$this->grandTotal->SetVisibility();
		$this->totalAmount->SetVisibility();
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
		global $EW_EXPORT, $inb_bookings;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($inb_bookings);
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
			$this->Page_Terminate("inb_bookingslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in inb_bookings class, inb_bookingsinfo.php

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
				$this->Page_Terminate("inb_bookingslist.php"); // Return to list
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
		$this->rentLeaseCarID->setDbValue($row['rentLeaseCarID']);
		$this->pickUpLocation->setDbValue($row['pickUpLocation']);
		$this->dropLocation->setDbValue($row['dropLocation']);
		$this->pickUpDate->setDbValue($row['pickUpDate']);
		$this->dropDate->setDbValue($row['dropDate']);
		$this->noOfDays->setDbValue($row['noOfDays']);
		$this->bookingTerm->setDbValue($row['bookingTerm']);
		$this->orangeCard->setDbValue($row['orangeCard']);
		$this->gps->setDbValue($row['gps']);
		$this->deliveryCharge->setDbValue($row['deliveryCharge']);
		$this->collectionCharge->setDbValue($row['collectionCharge']);
		$this->rentalAmount->setDbValue($row['rentalAmount']);
		$this->vat->setDbValue($row['vat']);
		$this->grandTotal->setDbValue($row['grandTotal']);
		$this->totalAmount->setDbValue($row['totalAmount']);
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
		$row['rentLeaseCarID'] = NULL;
		$row['pickUpLocation'] = NULL;
		$row['dropLocation'] = NULL;
		$row['pickUpDate'] = NULL;
		$row['dropDate'] = NULL;
		$row['noOfDays'] = NULL;
		$row['bookingTerm'] = NULL;
		$row['orangeCard'] = NULL;
		$row['gps'] = NULL;
		$row['deliveryCharge'] = NULL;
		$row['collectionCharge'] = NULL;
		$row['rentalAmount'] = NULL;
		$row['vat'] = NULL;
		$row['grandTotal'] = NULL;
		$row['totalAmount'] = NULL;
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
		$this->rentLeaseCarID->DbValue = $row['rentLeaseCarID'];
		$this->pickUpLocation->DbValue = $row['pickUpLocation'];
		$this->dropLocation->DbValue = $row['dropLocation'];
		$this->pickUpDate->DbValue = $row['pickUpDate'];
		$this->dropDate->DbValue = $row['dropDate'];
		$this->noOfDays->DbValue = $row['noOfDays'];
		$this->bookingTerm->DbValue = $row['bookingTerm'];
		$this->orangeCard->DbValue = $row['orangeCard'];
		$this->gps->DbValue = $row['gps'];
		$this->deliveryCharge->DbValue = $row['deliveryCharge'];
		$this->collectionCharge->DbValue = $row['collectionCharge'];
		$this->rentalAmount->DbValue = $row['rentalAmount'];
		$this->vat->DbValue = $row['vat'];
		$this->grandTotal->DbValue = $row['grandTotal'];
		$this->totalAmount->DbValue = $row['totalAmount'];
		$this->deliveryAddress->DbValue = $row['deliveryAddress'];
		$this->paymentMethod->DbValue = $row['paymentMethod'];
		$this->dateCreated->DbValue = $row['dateCreated'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->grandTotal->FormValue == $this->grandTotal->CurrentValue && is_numeric(ew_StrToFloat($this->grandTotal->CurrentValue)))
			$this->grandTotal->CurrentValue = ew_StrToFloat($this->grandTotal->CurrentValue);

		// Convert decimal values if posted back
		if ($this->totalAmount->FormValue == $this->totalAmount->CurrentValue && is_numeric(ew_StrToFloat($this->totalAmount->CurrentValue)))
			$this->totalAmount->CurrentValue = ew_StrToFloat($this->totalAmount->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// bookingID
		// bookingNumber
		// userID
		// rentLeaseCarID
		// pickUpLocation
		// dropLocation
		// pickUpDate
		// dropDate
		// noOfDays
		// bookingTerm
		// orangeCard
		// gps
		// deliveryCharge
		// collectionCharge
		// rentalAmount
		// vat
		// grandTotal
		// totalAmount
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

		// rentLeaseCarID
		if (strval($this->rentLeaseCarID->CurrentValue) <> "") {
			$sFilterWrk = "`rentLeaseCarID`" . ew_SearchString("=", $this->rentLeaseCarID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `rentLeaseCarID`, `carTitle` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rent_lease_cars`";
		$sWhereWrk = "";
		$this->rentLeaseCarID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->rentLeaseCarID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->rentLeaseCarID->ViewValue = $this->rentLeaseCarID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->rentLeaseCarID->ViewValue = $this->rentLeaseCarID->CurrentValue;
			}
		} else {
			$this->rentLeaseCarID->ViewValue = NULL;
		}
		$this->rentLeaseCarID->ViewCustomAttributes = "";

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

		// vat
		$this->vat->ViewValue = $this->vat->CurrentValue;
		$this->vat->ViewCustomAttributes = "";

		// grandTotal
		$this->grandTotal->ViewValue = $this->grandTotal->CurrentValue;
		$this->grandTotal->ViewCustomAttributes = "";

		// totalAmount
		$this->totalAmount->ViewValue = $this->totalAmount->CurrentValue;
		$this->totalAmount->ViewCustomAttributes = "";

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

			// rentLeaseCarID
			$this->rentLeaseCarID->LinkCustomAttributes = "";
			$this->rentLeaseCarID->HrefValue = "";
			$this->rentLeaseCarID->TooltipValue = "";

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

			// noOfDays
			$this->noOfDays->LinkCustomAttributes = "";
			$this->noOfDays->HrefValue = "";
			$this->noOfDays->TooltipValue = "";

			// bookingTerm
			$this->bookingTerm->LinkCustomAttributes = "";
			$this->bookingTerm->HrefValue = "";
			$this->bookingTerm->TooltipValue = "";

			// grandTotal
			$this->grandTotal->LinkCustomAttributes = "";
			$this->grandTotal->HrefValue = "";
			$this->grandTotal->TooltipValue = "";

			// totalAmount
			$this->totalAmount->LinkCustomAttributes = "";
			$this->totalAmount->HrefValue = "";
			$this->totalAmount->TooltipValue = "";

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("inb_bookingslist.php"), "", $this->TableVar, TRUE);
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
if (!isset($inb_bookings_delete)) $inb_bookings_delete = new cinb_bookings_delete();

// Page init
$inb_bookings_delete->Page_Init();

// Page main
$inb_bookings_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inb_bookings_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = finb_bookingsdelete = new ew_Form("finb_bookingsdelete", "delete");

// Form_CustomValidate event
finb_bookingsdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
finb_bookingsdelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
finb_bookingsdelete.Lists["x__userID"] = {"LinkField":"x__userID","Ajax":true,"AutoFill":false,"DisplayFields":["x_firstName","x_lastName","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"users"};
finb_bookingsdelete.Lists["x__userID"].Data = "<?php echo $inb_bookings_delete->_userID->LookupFilterQuery(FALSE, "delete") ?>";
finb_bookingsdelete.Lists["x_rentLeaseCarID"] = {"LinkField":"x_rentLeaseCarID","Ajax":true,"AutoFill":false,"DisplayFields":["x_carTitle","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rent_lease_cars"};
finb_bookingsdelete.Lists["x_rentLeaseCarID"].Data = "<?php echo $inb_bookings_delete->rentLeaseCarID->LookupFilterQuery(FALSE, "delete") ?>";
finb_bookingsdelete.Lists["x_pickUpLocation"] = {"LinkField":"x_pdLocationID","Ajax":true,"AutoFill":false,"DisplayFields":["x_location","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"pickup_drop_locations"};
finb_bookingsdelete.Lists["x_pickUpLocation"].Data = "<?php echo $inb_bookings_delete->pickUpLocation->LookupFilterQuery(FALSE, "delete") ?>";
finb_bookingsdelete.Lists["x_dropLocation"] = {"LinkField":"x_pdLocationID","Ajax":true,"AutoFill":false,"DisplayFields":["x_location","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"pickup_drop_locations"};
finb_bookingsdelete.Lists["x_dropLocation"].Data = "<?php echo $inb_bookings_delete->dropLocation->LookupFilterQuery(FALSE, "delete") ?>";
finb_bookingsdelete.Lists["x_paymentMethod"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
finb_bookingsdelete.Lists["x_paymentMethod"].Options = <?php echo json_encode($inb_bookings_delete->paymentMethod->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $inb_bookings_delete->ShowPageHeader(); ?>
<?php
$inb_bookings_delete->ShowMessage();
?>
<form name="finb_bookingsdelete" id="finb_bookingsdelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($inb_bookings_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $inb_bookings_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inb_bookings">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($inb_bookings_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($inb_bookings->bookingID->Visible) { // bookingID ?>
		<th class="<?php echo $inb_bookings->bookingID->HeaderCellClass() ?>"><span id="elh_inb_bookings_bookingID" class="inb_bookings_bookingID"><?php echo $inb_bookings->bookingID->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_bookings->bookingNumber->Visible) { // bookingNumber ?>
		<th class="<?php echo $inb_bookings->bookingNumber->HeaderCellClass() ?>"><span id="elh_inb_bookings_bookingNumber" class="inb_bookings_bookingNumber"><?php echo $inb_bookings->bookingNumber->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_bookings->_userID->Visible) { // userID ?>
		<th class="<?php echo $inb_bookings->_userID->HeaderCellClass() ?>"><span id="elh_inb_bookings__userID" class="inb_bookings__userID"><?php echo $inb_bookings->_userID->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_bookings->rentLeaseCarID->Visible) { // rentLeaseCarID ?>
		<th class="<?php echo $inb_bookings->rentLeaseCarID->HeaderCellClass() ?>"><span id="elh_inb_bookings_rentLeaseCarID" class="inb_bookings_rentLeaseCarID"><?php echo $inb_bookings->rentLeaseCarID->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_bookings->pickUpLocation->Visible) { // pickUpLocation ?>
		<th class="<?php echo $inb_bookings->pickUpLocation->HeaderCellClass() ?>"><span id="elh_inb_bookings_pickUpLocation" class="inb_bookings_pickUpLocation"><?php echo $inb_bookings->pickUpLocation->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_bookings->dropLocation->Visible) { // dropLocation ?>
		<th class="<?php echo $inb_bookings->dropLocation->HeaderCellClass() ?>"><span id="elh_inb_bookings_dropLocation" class="inb_bookings_dropLocation"><?php echo $inb_bookings->dropLocation->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_bookings->pickUpDate->Visible) { // pickUpDate ?>
		<th class="<?php echo $inb_bookings->pickUpDate->HeaderCellClass() ?>"><span id="elh_inb_bookings_pickUpDate" class="inb_bookings_pickUpDate"><?php echo $inb_bookings->pickUpDate->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_bookings->noOfDays->Visible) { // noOfDays ?>
		<th class="<?php echo $inb_bookings->noOfDays->HeaderCellClass() ?>"><span id="elh_inb_bookings_noOfDays" class="inb_bookings_noOfDays"><?php echo $inb_bookings->noOfDays->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_bookings->bookingTerm->Visible) { // bookingTerm ?>
		<th class="<?php echo $inb_bookings->bookingTerm->HeaderCellClass() ?>"><span id="elh_inb_bookings_bookingTerm" class="inb_bookings_bookingTerm"><?php echo $inb_bookings->bookingTerm->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_bookings->grandTotal->Visible) { // grandTotal ?>
		<th class="<?php echo $inb_bookings->grandTotal->HeaderCellClass() ?>"><span id="elh_inb_bookings_grandTotal" class="inb_bookings_grandTotal"><?php echo $inb_bookings->grandTotal->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_bookings->totalAmount->Visible) { // totalAmount ?>
		<th class="<?php echo $inb_bookings->totalAmount->HeaderCellClass() ?>"><span id="elh_inb_bookings_totalAmount" class="inb_bookings_totalAmount"><?php echo $inb_bookings->totalAmount->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_bookings->paymentMethod->Visible) { // paymentMethod ?>
		<th class="<?php echo $inb_bookings->paymentMethod->HeaderCellClass() ?>"><span id="elh_inb_bookings_paymentMethod" class="inb_bookings_paymentMethod"><?php echo $inb_bookings->paymentMethod->FldCaption() ?></span></th>
<?php } ?>
<?php if ($inb_bookings->dateCreated->Visible) { // dateCreated ?>
		<th class="<?php echo $inb_bookings->dateCreated->HeaderCellClass() ?>"><span id="elh_inb_bookings_dateCreated" class="inb_bookings_dateCreated"><?php echo $inb_bookings->dateCreated->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$inb_bookings_delete->RecCnt = 0;
$i = 0;
while (!$inb_bookings_delete->Recordset->EOF) {
	$inb_bookings_delete->RecCnt++;
	$inb_bookings_delete->RowCnt++;

	// Set row properties
	$inb_bookings->ResetAttrs();
	$inb_bookings->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$inb_bookings_delete->LoadRowValues($inb_bookings_delete->Recordset);

	// Render row
	$inb_bookings_delete->RenderRow();
?>
	<tr<?php echo $inb_bookings->RowAttributes() ?>>
<?php if ($inb_bookings->bookingID->Visible) { // bookingID ?>
		<td<?php echo $inb_bookings->bookingID->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_delete->RowCnt ?>_inb_bookings_bookingID" class="inb_bookings_bookingID">
<span<?php echo $inb_bookings->bookingID->ViewAttributes() ?>>
<?php echo $inb_bookings->bookingID->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_bookings->bookingNumber->Visible) { // bookingNumber ?>
		<td<?php echo $inb_bookings->bookingNumber->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_delete->RowCnt ?>_inb_bookings_bookingNumber" class="inb_bookings_bookingNumber">
<span<?php echo $inb_bookings->bookingNumber->ViewAttributes() ?>>
<?php echo $inb_bookings->bookingNumber->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_bookings->_userID->Visible) { // userID ?>
		<td<?php echo $inb_bookings->_userID->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_delete->RowCnt ?>_inb_bookings__userID" class="inb_bookings__userID">
<span<?php echo $inb_bookings->_userID->ViewAttributes() ?>>
<?php echo $inb_bookings->_userID->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_bookings->rentLeaseCarID->Visible) { // rentLeaseCarID ?>
		<td<?php echo $inb_bookings->rentLeaseCarID->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_delete->RowCnt ?>_inb_bookings_rentLeaseCarID" class="inb_bookings_rentLeaseCarID">
<span<?php echo $inb_bookings->rentLeaseCarID->ViewAttributes() ?>>
<?php echo $inb_bookings->rentLeaseCarID->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_bookings->pickUpLocation->Visible) { // pickUpLocation ?>
		<td<?php echo $inb_bookings->pickUpLocation->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_delete->RowCnt ?>_inb_bookings_pickUpLocation" class="inb_bookings_pickUpLocation">
<span<?php echo $inb_bookings->pickUpLocation->ViewAttributes() ?>>
<?php echo $inb_bookings->pickUpLocation->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_bookings->dropLocation->Visible) { // dropLocation ?>
		<td<?php echo $inb_bookings->dropLocation->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_delete->RowCnt ?>_inb_bookings_dropLocation" class="inb_bookings_dropLocation">
<span<?php echo $inb_bookings->dropLocation->ViewAttributes() ?>>
<?php echo $inb_bookings->dropLocation->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_bookings->pickUpDate->Visible) { // pickUpDate ?>
		<td<?php echo $inb_bookings->pickUpDate->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_delete->RowCnt ?>_inb_bookings_pickUpDate" class="inb_bookings_pickUpDate">
<span<?php echo $inb_bookings->pickUpDate->ViewAttributes() ?>>
<?php echo $inb_bookings->pickUpDate->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_bookings->noOfDays->Visible) { // noOfDays ?>
		<td<?php echo $inb_bookings->noOfDays->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_delete->RowCnt ?>_inb_bookings_noOfDays" class="inb_bookings_noOfDays">
<span<?php echo $inb_bookings->noOfDays->ViewAttributes() ?>>
<?php echo $inb_bookings->noOfDays->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_bookings->bookingTerm->Visible) { // bookingTerm ?>
		<td<?php echo $inb_bookings->bookingTerm->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_delete->RowCnt ?>_inb_bookings_bookingTerm" class="inb_bookings_bookingTerm">
<span<?php echo $inb_bookings->bookingTerm->ViewAttributes() ?>>
<?php echo $inb_bookings->bookingTerm->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_bookings->grandTotal->Visible) { // grandTotal ?>
		<td<?php echo $inb_bookings->grandTotal->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_delete->RowCnt ?>_inb_bookings_grandTotal" class="inb_bookings_grandTotal">
<span<?php echo $inb_bookings->grandTotal->ViewAttributes() ?>>
<?php echo $inb_bookings->grandTotal->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_bookings->totalAmount->Visible) { // totalAmount ?>
		<td<?php echo $inb_bookings->totalAmount->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_delete->RowCnt ?>_inb_bookings_totalAmount" class="inb_bookings_totalAmount">
<span<?php echo $inb_bookings->totalAmount->ViewAttributes() ?>>
<?php echo $inb_bookings->totalAmount->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_bookings->paymentMethod->Visible) { // paymentMethod ?>
		<td<?php echo $inb_bookings->paymentMethod->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_delete->RowCnt ?>_inb_bookings_paymentMethod" class="inb_bookings_paymentMethod">
<span<?php echo $inb_bookings->paymentMethod->ViewAttributes() ?>>
<?php echo $inb_bookings->paymentMethod->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inb_bookings->dateCreated->Visible) { // dateCreated ?>
		<td<?php echo $inb_bookings->dateCreated->CellAttributes() ?>>
<span id="el<?php echo $inb_bookings_delete->RowCnt ?>_inb_bookings_dateCreated" class="inb_bookings_dateCreated">
<span<?php echo $inb_bookings->dateCreated->ViewAttributes() ?>>
<?php echo $inb_bookings->dateCreated->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$inb_bookings_delete->Recordset->MoveNext();
}
$inb_bookings_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $inb_bookings_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
finb_bookingsdelete.Init();
</script>
<?php
$inb_bookings_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$inb_bookings_delete->Page_Terminate();
?>
