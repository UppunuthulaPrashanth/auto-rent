<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "rent_lease_carsinfo.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$rent_lease_cars_delete = NULL; // Initialize page object first

class crent_lease_cars_delete extends crent_lease_cars {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'rent_lease_cars';

	// Page object name
	var $PageObjName = 'rent_lease_cars_delete';

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

		// Table object (rent_lease_cars)
		if (!isset($GLOBALS["rent_lease_cars"]) || get_class($GLOBALS["rent_lease_cars"]) == "crent_lease_cars") {
			$GLOBALS["rent_lease_cars"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["rent_lease_cars"];
		}

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'rent_lease_cars', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("rent_lease_carslist.php"));
			else
				$this->Page_Terminate(ew_GetUrl("login.php"));
		}

		// NOTE: Security object may be needed in other part of the script, skip set to Nothing
		// 
		// Security = null;
		// 

		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->rentLeaseCarID->SetVisibility();
		$this->rentLeaseCarID->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
		$this->bodyTypeID->SetVisibility();
		$this->carTitle->SetVisibility();
		$this->image->SetVisibility();
		$this->active->SetVisibility();
		$this->weeklyDeals->SetVisibility();

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
		global $EW_EXPORT, $rent_lease_cars;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($rent_lease_cars);
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
			$this->Page_Terminate("rent_lease_carslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in rent_lease_cars class, rent_lease_carsinfo.php

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
				$this->Page_Terminate("rent_lease_carslist.php"); // Return to list
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
		$this->rentLeaseCarID->setDbValue($row['rentLeaseCarID']);
		$this->bodyTypeID->setDbValue($row['bodyTypeID']);
		$this->carTitle->setDbValue($row['carTitle']);
		$this->slug->setDbValue($row['slug']);
		$this->image->Upload->DbValue = $row['image'];
		$this->image->setDbValue($this->image->Upload->DbValue);
		$this->extraFeatures->setDbValue($row['extraFeatures']);
		$this->noOfSeats->setDbValue($row['noOfSeats']);
		$this->luggage->setDbValue($row['luggage']);
		$this->transmissionID->setDbValue($row['transmissionID']);
		$this->ac->setDbValue($row['ac']);
		$this->noOfDoors->setDbValue($row['noOfDoors']);
		$this->deliveryAED->setDbValue($row['deliveryAED']);
		$this->dailyAED->setDbValue($row['dailyAED']);
		$this->dailyDummyAED->setDbValue($row['dailyDummyAED']);
		$this->weeklyAED->setDbValue($row['weeklyAED']);
		$this->weeklyDummyAED->setDbValue($row['weeklyDummyAED']);
		$this->monthlyAED->setDbValue($row['monthlyAED']);
		$this->monthlyDummyAED->setDbValue($row['monthlyDummyAED']);
		$this->scdwDailyAED->setDbValue($row['scdwDailyAED']);
		$this->scdwWeeklyAED->setDbValue($row['scdwWeeklyAED']);
		$this->scdwMonthlyAED->setDbValue($row['scdwMonthlyAED']);
		$this->cdwDailyAED->setDbValue($row['cdwDailyAED']);
		$this->cdwWeeklyAED->setDbValue($row['cdwWeeklyAED']);
		$this->cdwMonthlyAED->setDbValue($row['cdwMonthlyAED']);
		$this->paiDailyAED->setDbValue($row['paiDailyAED']);
		$this->paiWeeklyAED->setDbValue($row['paiWeeklyAED']);
		$this->paiMonthlyAED->setDbValue($row['paiMonthlyAED']);
		$this->gpsDailyAED->setDbValue($row['gpsDailyAED']);
		$this->gpsWeeklyAED->setDbValue($row['gpsWeeklyAED']);
		$this->gpsMonthlyAED->setDbValue($row['gpsMonthlyAED']);
		$this->additionalDriverDailyAED->setDbValue($row['additionalDriverDailyAED']);
		$this->additionalDriverWeeklyAED->setDbValue($row['additionalDriverWeeklyAED']);
		$this->additionalDriverMonthlyAED->setDbValue($row['additionalDriverMonthlyAED']);
		$this->babySafetySeatDailyAED->setDbValue($row['babySafetySeatDailyAED']);
		$this->babySafetySeatWeeklyAED->setDbValue($row['babySafetySeatWeeklyAED']);
		$this->babySafetySeatMonthlyAED->setDbValue($row['babySafetySeatMonthlyAED']);
		$this->addBabySafetySeatDailyAED->setDbValue($row['addBabySafetySeatDailyAED']);
		$this->addBabySafetySeatWeeklyAED->setDbValue($row['addBabySafetySeatWeeklyAED']);
		$this->addBabySafetySeatMonthlyAED->setDbValue($row['addBabySafetySeatMonthlyAED']);
		$this->active->setDbValue($row['active']);
		$this->phase1OrangeCard->setDbValue($row['phase1OrangeCard']);
		$this->phase1GPS->setDbValue($row['phase1GPS']);
		$this->phase1DeliveryCharges->setDbValue($row['phase1DeliveryCharges']);
		$this->phase1CollectionCharges->setDbValue($row['phase1CollectionCharges']);
		$this->weeklyDeals->setDbValue($row['weeklyDeals']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['rentLeaseCarID'] = NULL;
		$row['bodyTypeID'] = NULL;
		$row['carTitle'] = NULL;
		$row['slug'] = NULL;
		$row['image'] = NULL;
		$row['extraFeatures'] = NULL;
		$row['noOfSeats'] = NULL;
		$row['luggage'] = NULL;
		$row['transmissionID'] = NULL;
		$row['ac'] = NULL;
		$row['noOfDoors'] = NULL;
		$row['deliveryAED'] = NULL;
		$row['dailyAED'] = NULL;
		$row['dailyDummyAED'] = NULL;
		$row['weeklyAED'] = NULL;
		$row['weeklyDummyAED'] = NULL;
		$row['monthlyAED'] = NULL;
		$row['monthlyDummyAED'] = NULL;
		$row['scdwDailyAED'] = NULL;
		$row['scdwWeeklyAED'] = NULL;
		$row['scdwMonthlyAED'] = NULL;
		$row['cdwDailyAED'] = NULL;
		$row['cdwWeeklyAED'] = NULL;
		$row['cdwMonthlyAED'] = NULL;
		$row['paiDailyAED'] = NULL;
		$row['paiWeeklyAED'] = NULL;
		$row['paiMonthlyAED'] = NULL;
		$row['gpsDailyAED'] = NULL;
		$row['gpsWeeklyAED'] = NULL;
		$row['gpsMonthlyAED'] = NULL;
		$row['additionalDriverDailyAED'] = NULL;
		$row['additionalDriverWeeklyAED'] = NULL;
		$row['additionalDriverMonthlyAED'] = NULL;
		$row['babySafetySeatDailyAED'] = NULL;
		$row['babySafetySeatWeeklyAED'] = NULL;
		$row['babySafetySeatMonthlyAED'] = NULL;
		$row['addBabySafetySeatDailyAED'] = NULL;
		$row['addBabySafetySeatWeeklyAED'] = NULL;
		$row['addBabySafetySeatMonthlyAED'] = NULL;
		$row['active'] = NULL;
		$row['phase1OrangeCard'] = NULL;
		$row['phase1GPS'] = NULL;
		$row['phase1DeliveryCharges'] = NULL;
		$row['phase1CollectionCharges'] = NULL;
		$row['weeklyDeals'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->rentLeaseCarID->DbValue = $row['rentLeaseCarID'];
		$this->bodyTypeID->DbValue = $row['bodyTypeID'];
		$this->carTitle->DbValue = $row['carTitle'];
		$this->slug->DbValue = $row['slug'];
		$this->image->Upload->DbValue = $row['image'];
		$this->extraFeatures->DbValue = $row['extraFeatures'];
		$this->noOfSeats->DbValue = $row['noOfSeats'];
		$this->luggage->DbValue = $row['luggage'];
		$this->transmissionID->DbValue = $row['transmissionID'];
		$this->ac->DbValue = $row['ac'];
		$this->noOfDoors->DbValue = $row['noOfDoors'];
		$this->deliveryAED->DbValue = $row['deliveryAED'];
		$this->dailyAED->DbValue = $row['dailyAED'];
		$this->dailyDummyAED->DbValue = $row['dailyDummyAED'];
		$this->weeklyAED->DbValue = $row['weeklyAED'];
		$this->weeklyDummyAED->DbValue = $row['weeklyDummyAED'];
		$this->monthlyAED->DbValue = $row['monthlyAED'];
		$this->monthlyDummyAED->DbValue = $row['monthlyDummyAED'];
		$this->scdwDailyAED->DbValue = $row['scdwDailyAED'];
		$this->scdwWeeklyAED->DbValue = $row['scdwWeeklyAED'];
		$this->scdwMonthlyAED->DbValue = $row['scdwMonthlyAED'];
		$this->cdwDailyAED->DbValue = $row['cdwDailyAED'];
		$this->cdwWeeklyAED->DbValue = $row['cdwWeeklyAED'];
		$this->cdwMonthlyAED->DbValue = $row['cdwMonthlyAED'];
		$this->paiDailyAED->DbValue = $row['paiDailyAED'];
		$this->paiWeeklyAED->DbValue = $row['paiWeeklyAED'];
		$this->paiMonthlyAED->DbValue = $row['paiMonthlyAED'];
		$this->gpsDailyAED->DbValue = $row['gpsDailyAED'];
		$this->gpsWeeklyAED->DbValue = $row['gpsWeeklyAED'];
		$this->gpsMonthlyAED->DbValue = $row['gpsMonthlyAED'];
		$this->additionalDriverDailyAED->DbValue = $row['additionalDriverDailyAED'];
		$this->additionalDriverWeeklyAED->DbValue = $row['additionalDriverWeeklyAED'];
		$this->additionalDriverMonthlyAED->DbValue = $row['additionalDriverMonthlyAED'];
		$this->babySafetySeatDailyAED->DbValue = $row['babySafetySeatDailyAED'];
		$this->babySafetySeatWeeklyAED->DbValue = $row['babySafetySeatWeeklyAED'];
		$this->babySafetySeatMonthlyAED->DbValue = $row['babySafetySeatMonthlyAED'];
		$this->addBabySafetySeatDailyAED->DbValue = $row['addBabySafetySeatDailyAED'];
		$this->addBabySafetySeatWeeklyAED->DbValue = $row['addBabySafetySeatWeeklyAED'];
		$this->addBabySafetySeatMonthlyAED->DbValue = $row['addBabySafetySeatMonthlyAED'];
		$this->active->DbValue = $row['active'];
		$this->phase1OrangeCard->DbValue = $row['phase1OrangeCard'];
		$this->phase1GPS->DbValue = $row['phase1GPS'];
		$this->phase1DeliveryCharges->DbValue = $row['phase1DeliveryCharges'];
		$this->phase1CollectionCharges->DbValue = $row['phase1CollectionCharges'];
		$this->weeklyDeals->DbValue = $row['weeklyDeals'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// rentLeaseCarID
		// bodyTypeID
		// carTitle
		// slug
		// image
		// extraFeatures
		// noOfSeats
		// luggage
		// transmissionID
		// ac
		// noOfDoors
		// deliveryAED
		// dailyAED
		// dailyDummyAED
		// weeklyAED
		// weeklyDummyAED
		// monthlyAED
		// monthlyDummyAED
		// scdwDailyAED

		$this->scdwDailyAED->CellCssStyle = "white-space: nowrap;";

		// scdwWeeklyAED
		$this->scdwWeeklyAED->CellCssStyle = "white-space: nowrap;";

		// scdwMonthlyAED
		$this->scdwMonthlyAED->CellCssStyle = "white-space: nowrap;";

		// cdwDailyAED
		$this->cdwDailyAED->CellCssStyle = "white-space: nowrap;";

		// cdwWeeklyAED
		$this->cdwWeeklyAED->CellCssStyle = "white-space: nowrap;";

		// cdwMonthlyAED
		$this->cdwMonthlyAED->CellCssStyle = "white-space: nowrap;";

		// paiDailyAED
		$this->paiDailyAED->CellCssStyle = "white-space: nowrap;";

		// paiWeeklyAED
		$this->paiWeeklyAED->CellCssStyle = "white-space: nowrap;";

		// paiMonthlyAED
		$this->paiMonthlyAED->CellCssStyle = "white-space: nowrap;";

		// gpsDailyAED
		$this->gpsDailyAED->CellCssStyle = "white-space: nowrap;";

		// gpsWeeklyAED
		$this->gpsWeeklyAED->CellCssStyle = "white-space: nowrap;";

		// gpsMonthlyAED
		$this->gpsMonthlyAED->CellCssStyle = "white-space: nowrap;";

		// additionalDriverDailyAED
		$this->additionalDriverDailyAED->CellCssStyle = "white-space: nowrap;";

		// additionalDriverWeeklyAED
		$this->additionalDriverWeeklyAED->CellCssStyle = "white-space: nowrap;";

		// additionalDriverMonthlyAED
		$this->additionalDriverMonthlyAED->CellCssStyle = "white-space: nowrap;";

		// babySafetySeatDailyAED
		$this->babySafetySeatDailyAED->CellCssStyle = "white-space: nowrap;";

		// babySafetySeatWeeklyAED
		$this->babySafetySeatWeeklyAED->CellCssStyle = "white-space: nowrap;";

		// babySafetySeatMonthlyAED
		$this->babySafetySeatMonthlyAED->CellCssStyle = "white-space: nowrap;";

		// addBabySafetySeatDailyAED
		$this->addBabySafetySeatDailyAED->CellCssStyle = "white-space: nowrap;";

		// addBabySafetySeatWeeklyAED
		$this->addBabySafetySeatWeeklyAED->CellCssStyle = "white-space: nowrap;";

		// addBabySafetySeatMonthlyAED
		$this->addBabySafetySeatMonthlyAED->CellCssStyle = "white-space: nowrap;";

		// active
		// phase1OrangeCard
		// phase1GPS
		// phase1DeliveryCharges
		// phase1CollectionCharges
		// weeklyDeals

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// rentLeaseCarID
		$this->rentLeaseCarID->ViewValue = $this->rentLeaseCarID->CurrentValue;
		$this->rentLeaseCarID->ViewCustomAttributes = "";

		// bodyTypeID
		if (strval($this->bodyTypeID->CurrentValue) <> "") {
			$sFilterWrk = "`bodyTypeID`" . ew_SearchString("=", $this->bodyTypeID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `bodyTypeID`, `bodytype` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_bodytype`";
		$sWhereWrk = "";
		$this->bodyTypeID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->bodyTypeID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->bodyTypeID->ViewValue = $this->bodyTypeID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->bodyTypeID->ViewValue = $this->bodyTypeID->CurrentValue;
			}
		} else {
			$this->bodyTypeID->ViewValue = NULL;
		}
		$this->bodyTypeID->ViewCustomAttributes = "";

		// carTitle
		$this->carTitle->ViewValue = $this->carTitle->CurrentValue;
		$this->carTitle->ViewCustomAttributes = "";

		// slug
		$this->slug->ViewValue = $this->slug->CurrentValue;
		$this->slug->ViewCustomAttributes = "";

		// image
		$this->image->UploadPath = 'uploads/rentlease';
		if (!ew_Empty($this->image->Upload->DbValue)) {
			$this->image->ImageWidth = 100;
			$this->image->ImageHeight = 0;
			$this->image->ImageAlt = $this->image->FldAlt();
			$this->image->ViewValue = $this->image->Upload->DbValue;
		} else {
			$this->image->ViewValue = "";
		}
		$this->image->ViewCustomAttributes = "";

		// extraFeatures
		if (strval($this->extraFeatures->CurrentValue) <> "") {
			$arwrk = explode(",", $this->extraFeatures->CurrentValue);
			$sFilterWrk = "";
			foreach ($arwrk as $wrk) {
				if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
				$sFilterWrk .= "`featureID`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_NUMBER, "");
			}
		$sSqlWrk = "SELECT `featureID`, `extraFeatures` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_extra_features`";
		$sWhereWrk = "";
		$this->extraFeatures->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->extraFeatures, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->extraFeatures->ViewValue = "";
				$ari = 0;
				while (!$rswrk->EOF) {
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->extraFeatures->ViewValue .= $this->extraFeatures->DisplayValue($arwrk);
					$rswrk->MoveNext();
					if (!$rswrk->EOF) $this->extraFeatures->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
					$ari++;
				}
				$rswrk->Close();
			} else {
				$this->extraFeatures->ViewValue = $this->extraFeatures->CurrentValue;
			}
		} else {
			$this->extraFeatures->ViewValue = NULL;
		}
		$this->extraFeatures->ViewCustomAttributes = "";

		// noOfSeats
		$this->noOfSeats->ViewValue = $this->noOfSeats->CurrentValue;
		$this->noOfSeats->ViewCustomAttributes = "";

		// luggage
		$this->luggage->ViewValue = $this->luggage->CurrentValue;
		$this->luggage->ViewCustomAttributes = "";

		// transmissionID
		if (strval($this->transmissionID->CurrentValue) <> "") {
			$sFilterWrk = "`transmissionID`" . ew_SearchString("=", $this->transmissionID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `transmissionID`, `transmission` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_transmission`";
		$sWhereWrk = "";
		$this->transmissionID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->transmissionID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->transmissionID->ViewValue = $this->transmissionID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->transmissionID->ViewValue = $this->transmissionID->CurrentValue;
			}
		} else {
			$this->transmissionID->ViewValue = NULL;
		}
		$this->transmissionID->ViewCustomAttributes = "";

		// ac
		if (ew_ConvertToBool($this->ac->CurrentValue)) {
			$this->ac->ViewValue = $this->ac->FldTagCaption(1) <> "" ? $this->ac->FldTagCaption(1) : "Y";
		} else {
			$this->ac->ViewValue = $this->ac->FldTagCaption(2) <> "" ? $this->ac->FldTagCaption(2) : "N";
		}
		$this->ac->ViewCustomAttributes = "";

		// noOfDoors
		$this->noOfDoors->ViewValue = $this->noOfDoors->CurrentValue;
		$this->noOfDoors->ViewCustomAttributes = "";

		// deliveryAED
		$this->deliveryAED->ViewValue = $this->deliveryAED->CurrentValue;
		$this->deliveryAED->ViewCustomAttributes = "";

		// dailyAED
		$this->dailyAED->ViewValue = $this->dailyAED->CurrentValue;
		$this->dailyAED->ViewCustomAttributes = "";

		// dailyDummyAED
		$this->dailyDummyAED->ViewValue = $this->dailyDummyAED->CurrentValue;
		$this->dailyDummyAED->ViewCustomAttributes = "";

		// weeklyAED
		$this->weeklyAED->ViewValue = $this->weeklyAED->CurrentValue;
		$this->weeklyAED->ViewCustomAttributes = "";

		// weeklyDummyAED
		$this->weeklyDummyAED->ViewValue = $this->weeklyDummyAED->CurrentValue;
		$this->weeklyDummyAED->ViewCustomAttributes = "";

		// monthlyAED
		$this->monthlyAED->ViewValue = $this->monthlyAED->CurrentValue;
		$this->monthlyAED->ViewCustomAttributes = "";

		// monthlyDummyAED
		$this->monthlyDummyAED->ViewValue = $this->monthlyDummyAED->CurrentValue;
		$this->monthlyDummyAED->ViewCustomAttributes = "";

		// active
		if (strval($this->active->CurrentValue) <> "") {
			$this->active->ViewValue = $this->active->OptionCaption($this->active->CurrentValue);
		} else {
			$this->active->ViewValue = NULL;
		}
		$this->active->ViewCustomAttributes = "";

		// phase1OrangeCard
		$this->phase1OrangeCard->ViewValue = $this->phase1OrangeCard->CurrentValue;
		$this->phase1OrangeCard->ViewCustomAttributes = "";

		// phase1GPS
		$this->phase1GPS->ViewValue = $this->phase1GPS->CurrentValue;
		$this->phase1GPS->ViewCustomAttributes = "";

		// phase1DeliveryCharges
		$this->phase1DeliveryCharges->ViewValue = $this->phase1DeliveryCharges->CurrentValue;
		$this->phase1DeliveryCharges->ViewCustomAttributes = "";

		// phase1CollectionCharges
		$this->phase1CollectionCharges->ViewValue = $this->phase1CollectionCharges->CurrentValue;
		$this->phase1CollectionCharges->ViewCustomAttributes = "";

		// weeklyDeals
		if (strval($this->weeklyDeals->CurrentValue) <> "") {
			$this->weeklyDeals->ViewValue = $this->weeklyDeals->OptionCaption($this->weeklyDeals->CurrentValue);
		} else {
			$this->weeklyDeals->ViewValue = NULL;
		}
		$this->weeklyDeals->ViewCustomAttributes = "";

			// rentLeaseCarID
			$this->rentLeaseCarID->LinkCustomAttributes = "";
			$this->rentLeaseCarID->HrefValue = "";
			$this->rentLeaseCarID->TooltipValue = "";

			// bodyTypeID
			$this->bodyTypeID->LinkCustomAttributes = "";
			$this->bodyTypeID->HrefValue = "";
			$this->bodyTypeID->TooltipValue = "";

			// carTitle
			$this->carTitle->LinkCustomAttributes = "";
			$this->carTitle->HrefValue = "";
			$this->carTitle->TooltipValue = "";

			// image
			$this->image->LinkCustomAttributes = "";
			$this->image->UploadPath = 'uploads/rentlease';
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
				$this->image->LinkAttrs["data-rel"] = "rent_lease_cars_x_image";
				ew_AppendClass($this->image->LinkAttrs["class"], "ewLightbox");
			}

			// active
			$this->active->LinkCustomAttributes = "";
			$this->active->HrefValue = "";
			$this->active->TooltipValue = "";

			// weeklyDeals
			$this->weeklyDeals->LinkCustomAttributes = "";
			$this->weeklyDeals->HrefValue = "";
			$this->weeklyDeals->TooltipValue = "";
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
				$sThisKey .= $row['rentLeaseCarID'];
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("rent_lease_carslist.php"), "", $this->TableVar, TRUE);
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
if (!isset($rent_lease_cars_delete)) $rent_lease_cars_delete = new crent_lease_cars_delete();

// Page init
$rent_lease_cars_delete->Page_Init();

// Page main
$rent_lease_cars_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rent_lease_cars_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = frent_lease_carsdelete = new ew_Form("frent_lease_carsdelete", "delete");

// Form_CustomValidate event
frent_lease_carsdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frent_lease_carsdelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
frent_lease_carsdelete.Lists["x_bodyTypeID"] = {"LinkField":"x_bodyTypeID","Ajax":true,"AutoFill":false,"DisplayFields":["x_bodytype","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_bodytype"};
frent_lease_carsdelete.Lists["x_bodyTypeID"].Data = "<?php echo $rent_lease_cars_delete->bodyTypeID->LookupFilterQuery(FALSE, "delete") ?>";
frent_lease_carsdelete.Lists["x_active"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
frent_lease_carsdelete.Lists["x_active"].Options = <?php echo json_encode($rent_lease_cars_delete->active->Options()) ?>;
frent_lease_carsdelete.Lists["x_weeklyDeals"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
frent_lease_carsdelete.Lists["x_weeklyDeals"].Options = <?php echo json_encode($rent_lease_cars_delete->weeklyDeals->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $rent_lease_cars_delete->ShowPageHeader(); ?>
<?php
$rent_lease_cars_delete->ShowMessage();
?>
<form name="frent_lease_carsdelete" id="frent_lease_carsdelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($rent_lease_cars_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $rent_lease_cars_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rent_lease_cars">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($rent_lease_cars_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($rent_lease_cars->rentLeaseCarID->Visible) { // rentLeaseCarID ?>
		<th class="<?php echo $rent_lease_cars->rentLeaseCarID->HeaderCellClass() ?>"><span id="elh_rent_lease_cars_rentLeaseCarID" class="rent_lease_cars_rentLeaseCarID"><?php echo $rent_lease_cars->rentLeaseCarID->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rent_lease_cars->bodyTypeID->Visible) { // bodyTypeID ?>
		<th class="<?php echo $rent_lease_cars->bodyTypeID->HeaderCellClass() ?>"><span id="elh_rent_lease_cars_bodyTypeID" class="rent_lease_cars_bodyTypeID"><?php echo $rent_lease_cars->bodyTypeID->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rent_lease_cars->carTitle->Visible) { // carTitle ?>
		<th class="<?php echo $rent_lease_cars->carTitle->HeaderCellClass() ?>"><span id="elh_rent_lease_cars_carTitle" class="rent_lease_cars_carTitle"><?php echo $rent_lease_cars->carTitle->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rent_lease_cars->image->Visible) { // image ?>
		<th class="<?php echo $rent_lease_cars->image->HeaderCellClass() ?>"><span id="elh_rent_lease_cars_image" class="rent_lease_cars_image"><?php echo $rent_lease_cars->image->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rent_lease_cars->active->Visible) { // active ?>
		<th class="<?php echo $rent_lease_cars->active->HeaderCellClass() ?>"><span id="elh_rent_lease_cars_active" class="rent_lease_cars_active"><?php echo $rent_lease_cars->active->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rent_lease_cars->weeklyDeals->Visible) { // weeklyDeals ?>
		<th class="<?php echo $rent_lease_cars->weeklyDeals->HeaderCellClass() ?>"><span id="elh_rent_lease_cars_weeklyDeals" class="rent_lease_cars_weeklyDeals"><?php echo $rent_lease_cars->weeklyDeals->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$rent_lease_cars_delete->RecCnt = 0;
$i = 0;
while (!$rent_lease_cars_delete->Recordset->EOF) {
	$rent_lease_cars_delete->RecCnt++;
	$rent_lease_cars_delete->RowCnt++;

	// Set row properties
	$rent_lease_cars->ResetAttrs();
	$rent_lease_cars->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$rent_lease_cars_delete->LoadRowValues($rent_lease_cars_delete->Recordset);

	// Render row
	$rent_lease_cars_delete->RenderRow();
?>
	<tr<?php echo $rent_lease_cars->RowAttributes() ?>>
<?php if ($rent_lease_cars->rentLeaseCarID->Visible) { // rentLeaseCarID ?>
		<td<?php echo $rent_lease_cars->rentLeaseCarID->CellAttributes() ?>>
<span id="el<?php echo $rent_lease_cars_delete->RowCnt ?>_rent_lease_cars_rentLeaseCarID" class="rent_lease_cars_rentLeaseCarID">
<span<?php echo $rent_lease_cars->rentLeaseCarID->ViewAttributes() ?>>
<?php echo $rent_lease_cars->rentLeaseCarID->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rent_lease_cars->bodyTypeID->Visible) { // bodyTypeID ?>
		<td<?php echo $rent_lease_cars->bodyTypeID->CellAttributes() ?>>
<span id="el<?php echo $rent_lease_cars_delete->RowCnt ?>_rent_lease_cars_bodyTypeID" class="rent_lease_cars_bodyTypeID">
<span<?php echo $rent_lease_cars->bodyTypeID->ViewAttributes() ?>>
<?php echo $rent_lease_cars->bodyTypeID->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rent_lease_cars->carTitle->Visible) { // carTitle ?>
		<td<?php echo $rent_lease_cars->carTitle->CellAttributes() ?>>
<span id="el<?php echo $rent_lease_cars_delete->RowCnt ?>_rent_lease_cars_carTitle" class="rent_lease_cars_carTitle">
<span<?php echo $rent_lease_cars->carTitle->ViewAttributes() ?>>
<?php echo $rent_lease_cars->carTitle->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rent_lease_cars->image->Visible) { // image ?>
		<td<?php echo $rent_lease_cars->image->CellAttributes() ?>>
<span id="el<?php echo $rent_lease_cars_delete->RowCnt ?>_rent_lease_cars_image" class="rent_lease_cars_image">
<span>
<?php echo ew_GetFileViewTag($rent_lease_cars->image, $rent_lease_cars->image->ListViewValue()) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($rent_lease_cars->active->Visible) { // active ?>
		<td<?php echo $rent_lease_cars->active->CellAttributes() ?>>
<span id="el<?php echo $rent_lease_cars_delete->RowCnt ?>_rent_lease_cars_active" class="rent_lease_cars_active">
<span<?php echo $rent_lease_cars->active->ViewAttributes() ?>>
<?php echo $rent_lease_cars->active->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rent_lease_cars->weeklyDeals->Visible) { // weeklyDeals ?>
		<td<?php echo $rent_lease_cars->weeklyDeals->CellAttributes() ?>>
<span id="el<?php echo $rent_lease_cars_delete->RowCnt ?>_rent_lease_cars_weeklyDeals" class="rent_lease_cars_weeklyDeals">
<span<?php echo $rent_lease_cars->weeklyDeals->ViewAttributes() ?>>
<?php echo $rent_lease_cars->weeklyDeals->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$rent_lease_cars_delete->Recordset->MoveNext();
}
$rent_lease_cars_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $rent_lease_cars_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
frent_lease_carsdelete.Init();
</script>
<?php
$rent_lease_cars_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$rent_lease_cars_delete->Page_Terminate();
?>
