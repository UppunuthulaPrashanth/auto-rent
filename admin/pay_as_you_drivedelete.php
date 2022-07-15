<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "pay_as_you_driveinfo.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$pay_as_you_drive_delete = NULL; // Initialize page object first

class cpay_as_you_drive_delete extends cpay_as_you_drive {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'pay_as_you_drive';

	// Page object name
	var $PageObjName = 'pay_as_you_drive_delete';

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

		// Table object (pay_as_you_drive)
		if (!isset($GLOBALS["pay_as_you_drive"]) || get_class($GLOBALS["pay_as_you_drive"]) == "cpay_as_you_drive") {
			$GLOBALS["pay_as_you_drive"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["pay_as_you_drive"];
		}

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pay_as_you_drive', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("pay_as_you_drivelist.php"));
			else
				$this->Page_Terminate(ew_GetUrl("login.php"));
		}

		// NOTE: Security object may be needed in other part of the script, skip set to Nothing
		// 
		// Security = null;
		// 

		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->payDriveCarID->SetVisibility();
		$this->payDriveCarID->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
		$this->bodyTypeID->SetVisibility();
		$this->carTitle->SetVisibility();
		$this->image->SetVisibility();
		$this->noOfSeats->SetVisibility();
		$this->transmissionID->SetVisibility();
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
		global $EW_EXPORT, $pay_as_you_drive;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($pay_as_you_drive);
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
			$this->Page_Terminate("pay_as_you_drivelist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in pay_as_you_drive class, pay_as_you_driveinfo.php

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
				$this->Page_Terminate("pay_as_you_drivelist.php"); // Return to list
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
		$this->payDriveCarID->setDbValue($row['payDriveCarID']);
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
		$this->s1DailyAED->setDbValue($row['s1DailyAED']);
		$this->s1DailyKM->setDbValue($row['s1DailyKM']);
		$this->s2DailyAED->setDbValue($row['s2DailyAED']);
		$this->s2DailyKM->setDbValue($row['s2DailyKM']);
		$this->s3DailyAED->setDbValue($row['s3DailyAED']);
		$this->s3DailyKM->setDbValue($row['s3DailyKM']);
		$this->s4DailyAED->setDbValue($row['s4DailyAED']);
		$this->s4DailyKM->setDbValue($row['s4DailyKM']);
		$this->s5DailyAED->setDbValue($row['s5DailyAED']);
		$this->s5DailyKM->setDbValue($row['s5DailyKM']);
		$this->s1WeeklyAED->setDbValue($row['s1WeeklyAED']);
		$this->s1WeeklyKM->setDbValue($row['s1WeeklyKM']);
		$this->s2WeeklyAED->setDbValue($row['s2WeeklyAED']);
		$this->s2WeeklyKM->setDbValue($row['s2WeeklyKM']);
		$this->s3WeeklyAED->setDbValue($row['s3WeeklyAED']);
		$this->s3WeeklyKM->setDbValue($row['s3WeeklyKM']);
		$this->s4WeeklyAED->setDbValue($row['s4WeeklyAED']);
		$this->s4WeeklyKM->setDbValue($row['s4WeeklyKM']);
		$this->s5WeeklyAED->setDbValue($row['s5WeeklyAED']);
		$this->s5WeeklyKM->setDbValue($row['s5WeeklyKM']);
		$this->s1MonthlyAED->setDbValue($row['s1MonthlyAED']);
		$this->s1MonthlyKM->setDbValue($row['s1MonthlyKM']);
		$this->s2MonthlyAED->setDbValue($row['s2MonthlyAED']);
		$this->s2MonthlyKM->setDbValue($row['s2MonthlyKM']);
		$this->s3MonthlyAED->setDbValue($row['s3MonthlyAED']);
		$this->s3MonthlyKM->setDbValue($row['s3MonthlyKM']);
		$this->s4MonthlyAED->setDbValue($row['s4MonthlyAED']);
		$this->s4MonthlyKM->setDbValue($row['s4MonthlyKM']);
		$this->s5MonthlyAED->setDbValue($row['s5MonthlyAED']);
		$this->s5MonthlyKM->setDbValue($row['s5MonthlyKM']);
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
		$this->deliveryAED->setDbValue($row['deliveryAED']);
		$this->active->setDbValue($row['active']);
		$this->phase1OrangeCard->setDbValue($row['phase1OrangeCard']);
		$this->phase1GPS->setDbValue($row['phase1GPS']);
		$this->phase1DeliveryCharges->setDbValue($row['phase1DeliveryCharges']);
		$this->phase1CollectionCharges->setDbValue($row['phase1CollectionCharges']);
		$this->addon01KM->setDbValue($row['addon01KM']);
		$this->addon01Price->setDbValue($row['addon01Price']);
		$this->addon02KM->setDbValue($row['addon02KM']);
		$this->addon02Price->setDbValue($row['addon02Price']);
		$this->addon03KM->setDbValue($row['addon03KM']);
		$this->addon03Price->setDbValue($row['addon03Price']);
		$this->addon04KM->setDbValue($row['addon04KM']);
		$this->addon04Price->setDbValue($row['addon04Price']);
		$this->addon05KM->setDbValue($row['addon05KM']);
		$this->addon05Price->setDbValue($row['addon05Price']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['payDriveCarID'] = NULL;
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
		$row['s1DailyAED'] = NULL;
		$row['s1DailyKM'] = NULL;
		$row['s2DailyAED'] = NULL;
		$row['s2DailyKM'] = NULL;
		$row['s3DailyAED'] = NULL;
		$row['s3DailyKM'] = NULL;
		$row['s4DailyAED'] = NULL;
		$row['s4DailyKM'] = NULL;
		$row['s5DailyAED'] = NULL;
		$row['s5DailyKM'] = NULL;
		$row['s1WeeklyAED'] = NULL;
		$row['s1WeeklyKM'] = NULL;
		$row['s2WeeklyAED'] = NULL;
		$row['s2WeeklyKM'] = NULL;
		$row['s3WeeklyAED'] = NULL;
		$row['s3WeeklyKM'] = NULL;
		$row['s4WeeklyAED'] = NULL;
		$row['s4WeeklyKM'] = NULL;
		$row['s5WeeklyAED'] = NULL;
		$row['s5WeeklyKM'] = NULL;
		$row['s1MonthlyAED'] = NULL;
		$row['s1MonthlyKM'] = NULL;
		$row['s2MonthlyAED'] = NULL;
		$row['s2MonthlyKM'] = NULL;
		$row['s3MonthlyAED'] = NULL;
		$row['s3MonthlyKM'] = NULL;
		$row['s4MonthlyAED'] = NULL;
		$row['s4MonthlyKM'] = NULL;
		$row['s5MonthlyAED'] = NULL;
		$row['s5MonthlyKM'] = NULL;
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
		$row['deliveryAED'] = NULL;
		$row['active'] = NULL;
		$row['phase1OrangeCard'] = NULL;
		$row['phase1GPS'] = NULL;
		$row['phase1DeliveryCharges'] = NULL;
		$row['phase1CollectionCharges'] = NULL;
		$row['addon01KM'] = NULL;
		$row['addon01Price'] = NULL;
		$row['addon02KM'] = NULL;
		$row['addon02Price'] = NULL;
		$row['addon03KM'] = NULL;
		$row['addon03Price'] = NULL;
		$row['addon04KM'] = NULL;
		$row['addon04Price'] = NULL;
		$row['addon05KM'] = NULL;
		$row['addon05Price'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->payDriveCarID->DbValue = $row['payDriveCarID'];
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
		$this->s1DailyAED->DbValue = $row['s1DailyAED'];
		$this->s1DailyKM->DbValue = $row['s1DailyKM'];
		$this->s2DailyAED->DbValue = $row['s2DailyAED'];
		$this->s2DailyKM->DbValue = $row['s2DailyKM'];
		$this->s3DailyAED->DbValue = $row['s3DailyAED'];
		$this->s3DailyKM->DbValue = $row['s3DailyKM'];
		$this->s4DailyAED->DbValue = $row['s4DailyAED'];
		$this->s4DailyKM->DbValue = $row['s4DailyKM'];
		$this->s5DailyAED->DbValue = $row['s5DailyAED'];
		$this->s5DailyKM->DbValue = $row['s5DailyKM'];
		$this->s1WeeklyAED->DbValue = $row['s1WeeklyAED'];
		$this->s1WeeklyKM->DbValue = $row['s1WeeklyKM'];
		$this->s2WeeklyAED->DbValue = $row['s2WeeklyAED'];
		$this->s2WeeklyKM->DbValue = $row['s2WeeklyKM'];
		$this->s3WeeklyAED->DbValue = $row['s3WeeklyAED'];
		$this->s3WeeklyKM->DbValue = $row['s3WeeklyKM'];
		$this->s4WeeklyAED->DbValue = $row['s4WeeklyAED'];
		$this->s4WeeklyKM->DbValue = $row['s4WeeklyKM'];
		$this->s5WeeklyAED->DbValue = $row['s5WeeklyAED'];
		$this->s5WeeklyKM->DbValue = $row['s5WeeklyKM'];
		$this->s1MonthlyAED->DbValue = $row['s1MonthlyAED'];
		$this->s1MonthlyKM->DbValue = $row['s1MonthlyKM'];
		$this->s2MonthlyAED->DbValue = $row['s2MonthlyAED'];
		$this->s2MonthlyKM->DbValue = $row['s2MonthlyKM'];
		$this->s3MonthlyAED->DbValue = $row['s3MonthlyAED'];
		$this->s3MonthlyKM->DbValue = $row['s3MonthlyKM'];
		$this->s4MonthlyAED->DbValue = $row['s4MonthlyAED'];
		$this->s4MonthlyKM->DbValue = $row['s4MonthlyKM'];
		$this->s5MonthlyAED->DbValue = $row['s5MonthlyAED'];
		$this->s5MonthlyKM->DbValue = $row['s5MonthlyKM'];
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
		$this->deliveryAED->DbValue = $row['deliveryAED'];
		$this->active->DbValue = $row['active'];
		$this->phase1OrangeCard->DbValue = $row['phase1OrangeCard'];
		$this->phase1GPS->DbValue = $row['phase1GPS'];
		$this->phase1DeliveryCharges->DbValue = $row['phase1DeliveryCharges'];
		$this->phase1CollectionCharges->DbValue = $row['phase1CollectionCharges'];
		$this->addon01KM->DbValue = $row['addon01KM'];
		$this->addon01Price->DbValue = $row['addon01Price'];
		$this->addon02KM->DbValue = $row['addon02KM'];
		$this->addon02Price->DbValue = $row['addon02Price'];
		$this->addon03KM->DbValue = $row['addon03KM'];
		$this->addon03Price->DbValue = $row['addon03Price'];
		$this->addon04KM->DbValue = $row['addon04KM'];
		$this->addon04Price->DbValue = $row['addon04Price'];
		$this->addon05KM->DbValue = $row['addon05KM'];
		$this->addon05Price->DbValue = $row['addon05Price'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// payDriveCarID
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
		// s1DailyAED
		// s1DailyKM
		// s2DailyAED
		// s2DailyKM
		// s3DailyAED
		// s3DailyKM
		// s4DailyAED
		// s4DailyKM
		// s5DailyAED
		// s5DailyKM
		// s1WeeklyAED
		// s1WeeklyKM
		// s2WeeklyAED
		// s2WeeklyKM
		// s3WeeklyAED
		// s3WeeklyKM
		// s4WeeklyAED
		// s4WeeklyKM
		// s5WeeklyAED
		// s5WeeklyKM
		// s1MonthlyAED
		// s1MonthlyKM
		// s2MonthlyAED
		// s2MonthlyKM
		// s3MonthlyAED
		// s3MonthlyKM
		// s4MonthlyAED
		// s4MonthlyKM
		// s5MonthlyAED
		// s5MonthlyKM
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

		// deliveryAED
		$this->deliveryAED->CellCssStyle = "white-space: nowrap;";

		// active
		// phase1OrangeCard
		// phase1GPS
		// phase1DeliveryCharges
		// phase1CollectionCharges
		// addon01KM
		// addon01Price
		// addon02KM
		// addon02Price
		// addon03KM
		// addon03Price
		// addon04KM
		// addon04Price
		// addon05KM
		// addon05Price

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// payDriveCarID
		$this->payDriveCarID->ViewValue = $this->payDriveCarID->CurrentValue;
		$this->payDriveCarID->ViewCustomAttributes = "";

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

		// s1DailyAED
		$this->s1DailyAED->ViewValue = $this->s1DailyAED->CurrentValue;
		$this->s1DailyAED->ViewCustomAttributes = "";

		// s1DailyKM
		$this->s1DailyKM->ViewValue = $this->s1DailyKM->CurrentValue;
		$this->s1DailyKM->ViewCustomAttributes = "";

		// s2DailyAED
		$this->s2DailyAED->ViewValue = $this->s2DailyAED->CurrentValue;
		$this->s2DailyAED->ViewCustomAttributes = "";

		// s2DailyKM
		$this->s2DailyKM->ViewValue = $this->s2DailyKM->CurrentValue;
		$this->s2DailyKM->ViewCustomAttributes = "";

		// s3DailyAED
		$this->s3DailyAED->ViewValue = $this->s3DailyAED->CurrentValue;
		$this->s3DailyAED->ViewCustomAttributes = "";

		// s3DailyKM
		$this->s3DailyKM->ViewValue = $this->s3DailyKM->CurrentValue;
		$this->s3DailyKM->ViewCustomAttributes = "";

		// s4DailyAED
		$this->s4DailyAED->ViewValue = $this->s4DailyAED->CurrentValue;
		$this->s4DailyAED->ViewCustomAttributes = "";

		// s4DailyKM
		$this->s4DailyKM->ViewValue = $this->s4DailyKM->CurrentValue;
		$this->s4DailyKM->ViewCustomAttributes = "";

		// s5DailyAED
		$this->s5DailyAED->ViewValue = $this->s5DailyAED->CurrentValue;
		$this->s5DailyAED->ViewCustomAttributes = "";

		// s5DailyKM
		$this->s5DailyKM->ViewValue = $this->s5DailyKM->CurrentValue;
		$this->s5DailyKM->ViewCustomAttributes = "";

		// s1WeeklyAED
		$this->s1WeeklyAED->ViewValue = $this->s1WeeklyAED->CurrentValue;
		$this->s1WeeklyAED->ViewCustomAttributes = "";

		// s1WeeklyKM
		$this->s1WeeklyKM->ViewValue = $this->s1WeeklyKM->CurrentValue;
		$this->s1WeeklyKM->ViewCustomAttributes = "";

		// s2WeeklyAED
		$this->s2WeeklyAED->ViewValue = $this->s2WeeklyAED->CurrentValue;
		$this->s2WeeklyAED->ViewCustomAttributes = "";

		// s2WeeklyKM
		$this->s2WeeklyKM->ViewValue = $this->s2WeeklyKM->CurrentValue;
		$this->s2WeeklyKM->ViewCustomAttributes = "";

		// s3WeeklyAED
		$this->s3WeeklyAED->ViewValue = $this->s3WeeklyAED->CurrentValue;
		$this->s3WeeklyAED->ViewCustomAttributes = "";

		// s3WeeklyKM
		$this->s3WeeklyKM->ViewValue = $this->s3WeeklyKM->CurrentValue;
		$this->s3WeeklyKM->ViewCustomAttributes = "";

		// s4WeeklyAED
		$this->s4WeeklyAED->ViewValue = $this->s4WeeklyAED->CurrentValue;
		$this->s4WeeklyAED->ViewCustomAttributes = "";

		// s4WeeklyKM
		$this->s4WeeklyKM->ViewValue = $this->s4WeeklyKM->CurrentValue;
		$this->s4WeeklyKM->ViewCustomAttributes = "";

		// s5WeeklyAED
		$this->s5WeeklyAED->ViewValue = $this->s5WeeklyAED->CurrentValue;
		$this->s5WeeklyAED->ViewCustomAttributes = "";

		// s5WeeklyKM
		$this->s5WeeklyKM->ViewValue = $this->s5WeeklyKM->CurrentValue;
		$this->s5WeeklyKM->ViewCustomAttributes = "";

		// s1MonthlyAED
		$this->s1MonthlyAED->ViewValue = $this->s1MonthlyAED->CurrentValue;
		$this->s1MonthlyAED->ViewCustomAttributes = "";

		// s1MonthlyKM
		$this->s1MonthlyKM->ViewValue = $this->s1MonthlyKM->CurrentValue;
		$this->s1MonthlyKM->ViewCustomAttributes = "";

		// s2MonthlyAED
		$this->s2MonthlyAED->ViewValue = $this->s2MonthlyAED->CurrentValue;
		$this->s2MonthlyAED->ViewCustomAttributes = "";

		// s2MonthlyKM
		$this->s2MonthlyKM->ViewValue = $this->s2MonthlyKM->CurrentValue;
		$this->s2MonthlyKM->ViewCustomAttributes = "";

		// s3MonthlyAED
		$this->s3MonthlyAED->ViewValue = $this->s3MonthlyAED->CurrentValue;
		$this->s3MonthlyAED->ViewCustomAttributes = "";

		// s3MonthlyKM
		$this->s3MonthlyKM->ViewValue = $this->s3MonthlyKM->CurrentValue;
		$this->s3MonthlyKM->ViewCustomAttributes = "";

		// s4MonthlyAED
		$this->s4MonthlyAED->ViewValue = $this->s4MonthlyAED->CurrentValue;
		$this->s4MonthlyAED->ViewCustomAttributes = "";

		// s4MonthlyKM
		$this->s4MonthlyKM->ViewValue = $this->s4MonthlyKM->CurrentValue;
		$this->s4MonthlyKM->ViewCustomAttributes = "";

		// s5MonthlyAED
		$this->s5MonthlyAED->ViewValue = $this->s5MonthlyAED->CurrentValue;
		$this->s5MonthlyAED->ViewCustomAttributes = "";

		// s5MonthlyKM
		$this->s5MonthlyKM->ViewValue = $this->s5MonthlyKM->CurrentValue;
		$this->s5MonthlyKM->ViewCustomAttributes = "";

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

		// addon01KM
		$this->addon01KM->ViewValue = $this->addon01KM->CurrentValue;
		$this->addon01KM->ViewCustomAttributes = "";

		// addon01Price
		$this->addon01Price->ViewValue = $this->addon01Price->CurrentValue;
		$this->addon01Price->ViewCustomAttributes = "";

		// addon02KM
		$this->addon02KM->ViewValue = $this->addon02KM->CurrentValue;
		$this->addon02KM->ViewCustomAttributes = "";

		// addon02Price
		$this->addon02Price->ViewValue = $this->addon02Price->CurrentValue;
		$this->addon02Price->ViewCustomAttributes = "";

		// addon03KM
		$this->addon03KM->ViewValue = $this->addon03KM->CurrentValue;
		$this->addon03KM->ViewCustomAttributes = "";

		// addon03Price
		$this->addon03Price->ViewValue = $this->addon03Price->CurrentValue;
		$this->addon03Price->ViewCustomAttributes = "";

		// addon04KM
		$this->addon04KM->ViewValue = $this->addon04KM->CurrentValue;
		$this->addon04KM->ViewCustomAttributes = "";

		// addon04Price
		$this->addon04Price->ViewValue = $this->addon04Price->CurrentValue;
		$this->addon04Price->ViewCustomAttributes = "";

		// addon05KM
		$this->addon05KM->ViewValue = $this->addon05KM->CurrentValue;
		$this->addon05KM->ViewCustomAttributes = "";

		// addon05Price
		$this->addon05Price->ViewValue = $this->addon05Price->CurrentValue;
		$this->addon05Price->ViewCustomAttributes = "";

			// payDriveCarID
			$this->payDriveCarID->LinkCustomAttributes = "";
			$this->payDriveCarID->HrefValue = "";
			$this->payDriveCarID->TooltipValue = "";

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
				$this->image->LinkAttrs["data-rel"] = "pay_as_you_drive_x_image";
				ew_AppendClass($this->image->LinkAttrs["class"], "ewLightbox");
			}

			// noOfSeats
			$this->noOfSeats->LinkCustomAttributes = "";
			$this->noOfSeats->HrefValue = "";
			$this->noOfSeats->TooltipValue = "";

			// transmissionID
			$this->transmissionID->LinkCustomAttributes = "";
			$this->transmissionID->HrefValue = "";
			$this->transmissionID->TooltipValue = "";

			// active
			$this->active->LinkCustomAttributes = "";
			$this->active->HrefValue = "";
			$this->active->TooltipValue = "";
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
				$sThisKey .= $row['payDriveCarID'];
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("pay_as_you_drivelist.php"), "", $this->TableVar, TRUE);
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
if (!isset($pay_as_you_drive_delete)) $pay_as_you_drive_delete = new cpay_as_you_drive_delete();

// Page init
$pay_as_you_drive_delete->Page_Init();

// Page main
$pay_as_you_drive_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pay_as_you_drive_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = fpay_as_you_drivedelete = new ew_Form("fpay_as_you_drivedelete", "delete");

// Form_CustomValidate event
fpay_as_you_drivedelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fpay_as_you_drivedelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fpay_as_you_drivedelete.Lists["x_bodyTypeID"] = {"LinkField":"x_bodyTypeID","Ajax":true,"AutoFill":false,"DisplayFields":["x_bodytype","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_bodytype"};
fpay_as_you_drivedelete.Lists["x_bodyTypeID"].Data = "<?php echo $pay_as_you_drive_delete->bodyTypeID->LookupFilterQuery(FALSE, "delete") ?>";
fpay_as_you_drivedelete.Lists["x_transmissionID"] = {"LinkField":"x_transmissionID","Ajax":true,"AutoFill":false,"DisplayFields":["x_transmission","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_transmission"};
fpay_as_you_drivedelete.Lists["x_transmissionID"].Data = "<?php echo $pay_as_you_drive_delete->transmissionID->LookupFilterQuery(FALSE, "delete") ?>";
fpay_as_you_drivedelete.Lists["x_active"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fpay_as_you_drivedelete.Lists["x_active"].Options = <?php echo json_encode($pay_as_you_drive_delete->active->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $pay_as_you_drive_delete->ShowPageHeader(); ?>
<?php
$pay_as_you_drive_delete->ShowMessage();
?>
<form name="fpay_as_you_drivedelete" id="fpay_as_you_drivedelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($pay_as_you_drive_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $pay_as_you_drive_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pay_as_you_drive">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($pay_as_you_drive_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($pay_as_you_drive->payDriveCarID->Visible) { // payDriveCarID ?>
		<th class="<?php echo $pay_as_you_drive->payDriveCarID->HeaderCellClass() ?>"><span id="elh_pay_as_you_drive_payDriveCarID" class="pay_as_you_drive_payDriveCarID"><?php echo $pay_as_you_drive->payDriveCarID->FldCaption() ?></span></th>
<?php } ?>
<?php if ($pay_as_you_drive->bodyTypeID->Visible) { // bodyTypeID ?>
		<th class="<?php echo $pay_as_you_drive->bodyTypeID->HeaderCellClass() ?>"><span id="elh_pay_as_you_drive_bodyTypeID" class="pay_as_you_drive_bodyTypeID"><?php echo $pay_as_you_drive->bodyTypeID->FldCaption() ?></span></th>
<?php } ?>
<?php if ($pay_as_you_drive->carTitle->Visible) { // carTitle ?>
		<th class="<?php echo $pay_as_you_drive->carTitle->HeaderCellClass() ?>"><span id="elh_pay_as_you_drive_carTitle" class="pay_as_you_drive_carTitle"><?php echo $pay_as_you_drive->carTitle->FldCaption() ?></span></th>
<?php } ?>
<?php if ($pay_as_you_drive->image->Visible) { // image ?>
		<th class="<?php echo $pay_as_you_drive->image->HeaderCellClass() ?>"><span id="elh_pay_as_you_drive_image" class="pay_as_you_drive_image"><?php echo $pay_as_you_drive->image->FldCaption() ?></span></th>
<?php } ?>
<?php if ($pay_as_you_drive->noOfSeats->Visible) { // noOfSeats ?>
		<th class="<?php echo $pay_as_you_drive->noOfSeats->HeaderCellClass() ?>"><span id="elh_pay_as_you_drive_noOfSeats" class="pay_as_you_drive_noOfSeats"><?php echo $pay_as_you_drive->noOfSeats->FldCaption() ?></span></th>
<?php } ?>
<?php if ($pay_as_you_drive->transmissionID->Visible) { // transmissionID ?>
		<th class="<?php echo $pay_as_you_drive->transmissionID->HeaderCellClass() ?>"><span id="elh_pay_as_you_drive_transmissionID" class="pay_as_you_drive_transmissionID"><?php echo $pay_as_you_drive->transmissionID->FldCaption() ?></span></th>
<?php } ?>
<?php if ($pay_as_you_drive->active->Visible) { // active ?>
		<th class="<?php echo $pay_as_you_drive->active->HeaderCellClass() ?>"><span id="elh_pay_as_you_drive_active" class="pay_as_you_drive_active"><?php echo $pay_as_you_drive->active->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$pay_as_you_drive_delete->RecCnt = 0;
$i = 0;
while (!$pay_as_you_drive_delete->Recordset->EOF) {
	$pay_as_you_drive_delete->RecCnt++;
	$pay_as_you_drive_delete->RowCnt++;

	// Set row properties
	$pay_as_you_drive->ResetAttrs();
	$pay_as_you_drive->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$pay_as_you_drive_delete->LoadRowValues($pay_as_you_drive_delete->Recordset);

	// Render row
	$pay_as_you_drive_delete->RenderRow();
?>
	<tr<?php echo $pay_as_you_drive->RowAttributes() ?>>
<?php if ($pay_as_you_drive->payDriveCarID->Visible) { // payDriveCarID ?>
		<td<?php echo $pay_as_you_drive->payDriveCarID->CellAttributes() ?>>
<span id="el<?php echo $pay_as_you_drive_delete->RowCnt ?>_pay_as_you_drive_payDriveCarID" class="pay_as_you_drive_payDriveCarID">
<span<?php echo $pay_as_you_drive->payDriveCarID->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->payDriveCarID->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pay_as_you_drive->bodyTypeID->Visible) { // bodyTypeID ?>
		<td<?php echo $pay_as_you_drive->bodyTypeID->CellAttributes() ?>>
<span id="el<?php echo $pay_as_you_drive_delete->RowCnt ?>_pay_as_you_drive_bodyTypeID" class="pay_as_you_drive_bodyTypeID">
<span<?php echo $pay_as_you_drive->bodyTypeID->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->bodyTypeID->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pay_as_you_drive->carTitle->Visible) { // carTitle ?>
		<td<?php echo $pay_as_you_drive->carTitle->CellAttributes() ?>>
<span id="el<?php echo $pay_as_you_drive_delete->RowCnt ?>_pay_as_you_drive_carTitle" class="pay_as_you_drive_carTitle">
<span<?php echo $pay_as_you_drive->carTitle->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->carTitle->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pay_as_you_drive->image->Visible) { // image ?>
		<td<?php echo $pay_as_you_drive->image->CellAttributes() ?>>
<span id="el<?php echo $pay_as_you_drive_delete->RowCnt ?>_pay_as_you_drive_image" class="pay_as_you_drive_image">
<span>
<?php echo ew_GetFileViewTag($pay_as_you_drive->image, $pay_as_you_drive->image->ListViewValue()) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($pay_as_you_drive->noOfSeats->Visible) { // noOfSeats ?>
		<td<?php echo $pay_as_you_drive->noOfSeats->CellAttributes() ?>>
<span id="el<?php echo $pay_as_you_drive_delete->RowCnt ?>_pay_as_you_drive_noOfSeats" class="pay_as_you_drive_noOfSeats">
<span<?php echo $pay_as_you_drive->noOfSeats->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->noOfSeats->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pay_as_you_drive->transmissionID->Visible) { // transmissionID ?>
		<td<?php echo $pay_as_you_drive->transmissionID->CellAttributes() ?>>
<span id="el<?php echo $pay_as_you_drive_delete->RowCnt ?>_pay_as_you_drive_transmissionID" class="pay_as_you_drive_transmissionID">
<span<?php echo $pay_as_you_drive->transmissionID->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->transmissionID->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pay_as_you_drive->active->Visible) { // active ?>
		<td<?php echo $pay_as_you_drive->active->CellAttributes() ?>>
<span id="el<?php echo $pay_as_you_drive_delete->RowCnt ?>_pay_as_you_drive_active" class="pay_as_you_drive_active">
<span<?php echo $pay_as_you_drive->active->ViewAttributes() ?>>
<?php echo $pay_as_you_drive->active->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$pay_as_you_drive_delete->Recordset->MoveNext();
}
$pay_as_you_drive_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $pay_as_you_drive_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
fpay_as_you_drivedelete.Init();
</script>
<?php
$pay_as_you_drive_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$pay_as_you_drive_delete->Page_Terminate();
?>
