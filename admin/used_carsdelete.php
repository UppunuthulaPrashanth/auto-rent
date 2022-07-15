<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "used_carsinfo.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$used_cars_delete = NULL; // Initialize page object first

class cused_cars_delete extends cused_cars {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'used_cars';

	// Page object name
	var $PageObjName = 'used_cars_delete';

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

		// Table object (used_cars)
		if (!isset($GLOBALS["used_cars"]) || get_class($GLOBALS["used_cars"]) == "cused_cars") {
			$GLOBALS["used_cars"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["used_cars"];
		}

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'used_cars', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("used_carslist.php"));
			else
				$this->Page_Terminate(ew_GetUrl("login.php"));
		}

		// NOTE: Security object may be needed in other part of the script, skip set to Nothing
		// 
		// Security = null;
		// 

		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->userCarID->SetVisibility();
		if ($this->IsAdd() || $this->IsCopy() || $this->IsGridAdd())
			$this->userCarID->Visible = FALSE;
		$this->makeID->SetVisibility();
		$this->modelID->SetVisibility();
		$this->slug->SetVisibility();
		$this->yearID->SetVisibility();
		$this->kilometers->SetVisibility();
		$this->priceAED->SetVisibility();
		$this->transmissionTypeID->SetVisibility();
		$this->_thumbnail->SetVisibility();
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
		global $EW_EXPORT, $used_cars;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($used_cars);
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
			$this->Page_Terminate("used_carslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in used_cars class, used_carsinfo.php

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
				$this->Page_Terminate("used_carslist.php"); // Return to list
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
		$this->userCarID->setDbValue($row['userCarID']);
		$this->makeID->setDbValue($row['makeID']);
		$this->modelID->setDbValue($row['modelID']);
		$this->slug->setDbValue($row['slug']);
		$this->yearID->setDbValue($row['yearID']);
		$this->kilometers->setDbValue($row['kilometers']);
		$this->priceAED->setDbValue($row['priceAED']);
		$this->priceUSD->setDbValue($row['priceUSD']);
		$this->priceOMR->setDbValue($row['priceOMR']);
		$this->priceSAR->setDbValue($row['priceSAR']);
		$this->description->setDbValue($row['description']);
		$this->fuelTypeID->setDbValue($row['fuelTypeID']);
		$this->regionalID->setDbValue($row['regionalID']);
		$this->warrantyID->setDbValue($row['warrantyID']);
		$this->noOfDoors->setDbValue($row['noOfDoors']);
		$this->transmissionTypeID->setDbValue($row['transmissionTypeID']);
		$this->cylinderID->setDbValue($row['cylinderID']);
		$this->engine->setDbValue($row['engine']);
		$this->colorID->setDbValue($row['colorID']);
		$this->bodyConditionID->setDbValue($row['bodyConditionID']);
		$this->summary->setDbValue($row['summary']);
		$this->term->setDbValue($row['term']);
		$this->_thumbnail->Upload->DbValue = $row['thumbnail'];
		$this->_thumbnail->setDbValue($this->_thumbnail->Upload->DbValue);
		$this->img_01->Upload->DbValue = $row['img_01'];
		$this->img_01->setDbValue($this->img_01->Upload->DbValue);
		$this->img_02->Upload->DbValue = $row['img_02'];
		$this->img_02->setDbValue($this->img_02->Upload->DbValue);
		$this->img_03->Upload->DbValue = $row['img_03'];
		$this->img_03->setDbValue($this->img_03->Upload->DbValue);
		$this->img_04->Upload->DbValue = $row['img_04'];
		$this->img_04->setDbValue($this->img_04->Upload->DbValue);
		$this->img_05->Upload->DbValue = $row['img_05'];
		$this->img_05->setDbValue($this->img_05->Upload->DbValue);
		$this->img_06->Upload->DbValue = $row['img_06'];
		$this->img_06->setDbValue($this->img_06->Upload->DbValue);
		$this->img_07->Upload->DbValue = $row['img_07'];
		$this->img_07->setDbValue($this->img_07->Upload->DbValue);
		$this->img_08->Upload->DbValue = $row['img_08'];
		$this->img_08->setDbValue($this->img_08->Upload->DbValue);
		$this->img_09->Upload->DbValue = $row['img_09'];
		$this->img_09->setDbValue($this->img_09->Upload->DbValue);
		$this->img_10->Upload->DbValue = $row['img_10'];
		$this->img_10->setDbValue($this->img_10->Upload->DbValue);
		$this->img_11->Upload->DbValue = $row['img_11'];
		$this->img_11->setDbValue($this->img_11->Upload->DbValue);
		$this->img_12->Upload->DbValue = $row['img_12'];
		$this->img_12->setDbValue($this->img_12->Upload->DbValue);
		$this->extra_features->setDbValue($row['extra_features']);
		$this->so->setDbValue($row['so']);
		$this->active->setDbValue($row['active']);
		$this->regionalSpec->setDbValue($row['regionalSpec']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['userCarID'] = NULL;
		$row['makeID'] = NULL;
		$row['modelID'] = NULL;
		$row['slug'] = NULL;
		$row['yearID'] = NULL;
		$row['kilometers'] = NULL;
		$row['priceAED'] = NULL;
		$row['priceUSD'] = NULL;
		$row['priceOMR'] = NULL;
		$row['priceSAR'] = NULL;
		$row['description'] = NULL;
		$row['fuelTypeID'] = NULL;
		$row['regionalID'] = NULL;
		$row['warrantyID'] = NULL;
		$row['noOfDoors'] = NULL;
		$row['transmissionTypeID'] = NULL;
		$row['cylinderID'] = NULL;
		$row['engine'] = NULL;
		$row['colorID'] = NULL;
		$row['bodyConditionID'] = NULL;
		$row['summary'] = NULL;
		$row['term'] = NULL;
		$row['thumbnail'] = NULL;
		$row['img_01'] = NULL;
		$row['img_02'] = NULL;
		$row['img_03'] = NULL;
		$row['img_04'] = NULL;
		$row['img_05'] = NULL;
		$row['img_06'] = NULL;
		$row['img_07'] = NULL;
		$row['img_08'] = NULL;
		$row['img_09'] = NULL;
		$row['img_10'] = NULL;
		$row['img_11'] = NULL;
		$row['img_12'] = NULL;
		$row['extra_features'] = NULL;
		$row['so'] = NULL;
		$row['active'] = NULL;
		$row['regionalSpec'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->userCarID->DbValue = $row['userCarID'];
		$this->makeID->DbValue = $row['makeID'];
		$this->modelID->DbValue = $row['modelID'];
		$this->slug->DbValue = $row['slug'];
		$this->yearID->DbValue = $row['yearID'];
		$this->kilometers->DbValue = $row['kilometers'];
		$this->priceAED->DbValue = $row['priceAED'];
		$this->priceUSD->DbValue = $row['priceUSD'];
		$this->priceOMR->DbValue = $row['priceOMR'];
		$this->priceSAR->DbValue = $row['priceSAR'];
		$this->description->DbValue = $row['description'];
		$this->fuelTypeID->DbValue = $row['fuelTypeID'];
		$this->regionalID->DbValue = $row['regionalID'];
		$this->warrantyID->DbValue = $row['warrantyID'];
		$this->noOfDoors->DbValue = $row['noOfDoors'];
		$this->transmissionTypeID->DbValue = $row['transmissionTypeID'];
		$this->cylinderID->DbValue = $row['cylinderID'];
		$this->engine->DbValue = $row['engine'];
		$this->colorID->DbValue = $row['colorID'];
		$this->bodyConditionID->DbValue = $row['bodyConditionID'];
		$this->summary->DbValue = $row['summary'];
		$this->term->DbValue = $row['term'];
		$this->_thumbnail->Upload->DbValue = $row['thumbnail'];
		$this->img_01->Upload->DbValue = $row['img_01'];
		$this->img_02->Upload->DbValue = $row['img_02'];
		$this->img_03->Upload->DbValue = $row['img_03'];
		$this->img_04->Upload->DbValue = $row['img_04'];
		$this->img_05->Upload->DbValue = $row['img_05'];
		$this->img_06->Upload->DbValue = $row['img_06'];
		$this->img_07->Upload->DbValue = $row['img_07'];
		$this->img_08->Upload->DbValue = $row['img_08'];
		$this->img_09->Upload->DbValue = $row['img_09'];
		$this->img_10->Upload->DbValue = $row['img_10'];
		$this->img_11->Upload->DbValue = $row['img_11'];
		$this->img_12->Upload->DbValue = $row['img_12'];
		$this->extra_features->DbValue = $row['extra_features'];
		$this->so->DbValue = $row['so'];
		$this->active->DbValue = $row['active'];
		$this->regionalSpec->DbValue = $row['regionalSpec'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// userCarID
		// makeID
		// modelID
		// slug
		// yearID
		// kilometers
		// priceAED
		// priceUSD
		// priceOMR
		// priceSAR
		// description
		// fuelTypeID
		// regionalID
		// warrantyID
		// noOfDoors
		// transmissionTypeID
		// cylinderID
		// engine
		// colorID
		// bodyConditionID
		// summary
		// term
		// thumbnail
		// img_01
		// img_02
		// img_03
		// img_04
		// img_05
		// img_06
		// img_07
		// img_08
		// img_09
		// img_10
		// img_11
		// img_12
		// extra_features
		// so
		// active
		// regionalSpec

		$this->regionalSpec->CellCssStyle = "white-space: nowrap;";
		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// userCarID
		$this->userCarID->ViewValue = $this->userCarID->CurrentValue;
		$this->userCarID->ViewCustomAttributes = "";

		// makeID
		if (strval($this->makeID->CurrentValue) <> "") {
			$sFilterWrk = "`makeID`" . ew_SearchString("=", $this->makeID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `makeID`, `make` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_make`";
		$sWhereWrk = "";
		$this->makeID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->makeID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->makeID->ViewValue = $this->makeID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->makeID->ViewValue = $this->makeID->CurrentValue;
			}
		} else {
			$this->makeID->ViewValue = NULL;
		}
		$this->makeID->ViewCustomAttributes = "";

		// modelID
		if (strval($this->modelID->CurrentValue) <> "") {
			$sFilterWrk = "`modelID`" . ew_SearchString("=", $this->modelID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `modelID`, `model` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_model`";
		$sWhereWrk = "";
		$this->modelID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->modelID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->modelID->ViewValue = $this->modelID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->modelID->ViewValue = $this->modelID->CurrentValue;
			}
		} else {
			$this->modelID->ViewValue = NULL;
		}
		$this->modelID->ViewCustomAttributes = "";

		// slug
		$this->slug->ViewValue = $this->slug->CurrentValue;
		$this->slug->ViewCustomAttributes = "";

		// yearID
		if (strval($this->yearID->CurrentValue) <> "") {
			$sFilterWrk = "`yearID`" . ew_SearchString("=", $this->yearID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `yearID`, `year` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_year`";
		$sWhereWrk = "";
		$this->yearID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->yearID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->yearID->ViewValue = $this->yearID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->yearID->ViewValue = $this->yearID->CurrentValue;
			}
		} else {
			$this->yearID->ViewValue = NULL;
		}
		$this->yearID->ViewCustomAttributes = "";

		// kilometers
		$this->kilometers->ViewValue = $this->kilometers->CurrentValue;
		$this->kilometers->ViewCustomAttributes = "";

		// priceAED
		$this->priceAED->ViewValue = $this->priceAED->CurrentValue;
		$this->priceAED->ViewCustomAttributes = "";

		// priceUSD
		$this->priceUSD->ViewValue = $this->priceUSD->CurrentValue;
		$this->priceUSD->ViewCustomAttributes = "";

		// priceOMR
		$this->priceOMR->ViewValue = $this->priceOMR->CurrentValue;
		$this->priceOMR->ViewCustomAttributes = "";

		// priceSAR
		$this->priceSAR->ViewValue = $this->priceSAR->CurrentValue;
		$this->priceSAR->ViewCustomAttributes = "";

		// description
		$this->description->ViewValue = $this->description->CurrentValue;
		$this->description->ViewCustomAttributes = "";

		// fuelTypeID
		if (strval($this->fuelTypeID->CurrentValue) <> "") {
			$sFilterWrk = "`fuelTypeID`" . ew_SearchString("=", $this->fuelTypeID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `fuelTypeID`, `fuelType` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_fuel_type`";
		$sWhereWrk = "";
		$this->fuelTypeID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->fuelTypeID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->fuelTypeID->ViewValue = $this->fuelTypeID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->fuelTypeID->ViewValue = $this->fuelTypeID->CurrentValue;
			}
		} else {
			$this->fuelTypeID->ViewValue = NULL;
		}
		$this->fuelTypeID->ViewCustomAttributes = "";

		// regionalID
		if (strval($this->regionalID->CurrentValue) <> "") {
			$sFilterWrk = "`regionalID`" . ew_SearchString("=", $this->regionalID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `regionalID`, `regionalSpecs` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_regional_spec`";
		$sWhereWrk = "";
		$this->regionalID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->regionalID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->regionalID->ViewValue = $this->regionalID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->regionalID->ViewValue = $this->regionalID->CurrentValue;
			}
		} else {
			$this->regionalID->ViewValue = NULL;
		}
		$this->regionalID->ViewCustomAttributes = "";

		// warrantyID
		if (strval($this->warrantyID->CurrentValue) <> "") {
			$sFilterWrk = "`warrantyID`" . ew_SearchString("=", $this->warrantyID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `warrantyID`, `warrantyName` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_warranty`";
		$sWhereWrk = "";
		$this->warrantyID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->warrantyID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->warrantyID->ViewValue = $this->warrantyID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->warrantyID->ViewValue = $this->warrantyID->CurrentValue;
			}
		} else {
			$this->warrantyID->ViewValue = NULL;
		}
		$this->warrantyID->ViewCustomAttributes = "";

		// noOfDoors
		$this->noOfDoors->ViewValue = $this->noOfDoors->CurrentValue;
		$this->noOfDoors->ViewCustomAttributes = "";

		// transmissionTypeID
		if (strval($this->transmissionTypeID->CurrentValue) <> "") {
			$sFilterWrk = "`transmissionID`" . ew_SearchString("=", $this->transmissionTypeID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `transmissionID`, `transmission` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_transmission`";
		$sWhereWrk = "";
		$this->transmissionTypeID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->transmissionTypeID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->transmissionTypeID->ViewValue = $this->transmissionTypeID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->transmissionTypeID->ViewValue = $this->transmissionTypeID->CurrentValue;
			}
		} else {
			$this->transmissionTypeID->ViewValue = NULL;
		}
		$this->transmissionTypeID->ViewCustomAttributes = "";

		// cylinderID
		if (strval($this->cylinderID->CurrentValue) <> "") {
			$sFilterWrk = "`cylinderID`" . ew_SearchString("=", $this->cylinderID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `cylinderID`, `cylinder` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_cylinder`";
		$sWhereWrk = "";
		$this->cylinderID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->cylinderID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->cylinderID->ViewValue = $this->cylinderID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->cylinderID->ViewValue = $this->cylinderID->CurrentValue;
			}
		} else {
			$this->cylinderID->ViewValue = NULL;
		}
		$this->cylinderID->ViewCustomAttributes = "";

		// engine
		$this->engine->ViewValue = $this->engine->CurrentValue;
		$this->engine->ViewCustomAttributes = "";

		// colorID
		if (strval($this->colorID->CurrentValue) <> "") {
			$sFilterWrk = "`colorID`" . ew_SearchString("=", $this->colorID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `colorID`, `color` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_color`";
		$sWhereWrk = "";
		$this->colorID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->colorID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->colorID->ViewValue = $this->colorID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->colorID->ViewValue = $this->colorID->CurrentValue;
			}
		} else {
			$this->colorID->ViewValue = NULL;
		}
		$this->colorID->ViewCustomAttributes = "";

		// bodyConditionID
		if (strval($this->bodyConditionID->CurrentValue) <> "") {
			$sFilterWrk = "`bodyConditionID`" . ew_SearchString("=", $this->bodyConditionID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `bodyConditionID`, `bodyCondition` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_body_condition`";
		$sWhereWrk = "";
		$this->bodyConditionID->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->bodyConditionID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->bodyConditionID->ViewValue = $this->bodyConditionID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->bodyConditionID->ViewValue = $this->bodyConditionID->CurrentValue;
			}
		} else {
			$this->bodyConditionID->ViewValue = NULL;
		}
		$this->bodyConditionID->ViewCustomAttributes = "";

		// term
		if (strval($this->term->CurrentValue) <> "") {
			$sFilterWrk = "`termID`" . ew_SearchString("=", $this->term->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `termID`, `term` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_term`";
		$sWhereWrk = "";
		$this->term->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->term, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->term->ViewValue = $this->term->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->term->ViewValue = $this->term->CurrentValue;
			}
		} else {
			$this->term->ViewValue = NULL;
		}
		$this->term->ViewCustomAttributes = "";

		// thumbnail
		$this->_thumbnail->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->_thumbnail->Upload->DbValue)) {
			$this->_thumbnail->ImageWidth = 100;
			$this->_thumbnail->ImageHeight = 0;
			$this->_thumbnail->ImageAlt = $this->_thumbnail->FldAlt();
			$this->_thumbnail->ViewValue = $this->_thumbnail->Upload->DbValue;
		} else {
			$this->_thumbnail->ViewValue = "";
		}
		$this->_thumbnail->ViewCustomAttributes = "";

		// img_01
		$this->img_01->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_01->Upload->DbValue)) {
			$this->img_01->ImageWidth = 100;
			$this->img_01->ImageHeight = 0;
			$this->img_01->ImageAlt = $this->img_01->FldAlt();
			$this->img_01->ViewValue = $this->img_01->Upload->DbValue;
		} else {
			$this->img_01->ViewValue = "";
		}
		$this->img_01->ViewCustomAttributes = "";

		// img_02
		$this->img_02->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_02->Upload->DbValue)) {
			$this->img_02->ImageWidth = 100;
			$this->img_02->ImageHeight = 0;
			$this->img_02->ImageAlt = $this->img_02->FldAlt();
			$this->img_02->ViewValue = $this->img_02->Upload->DbValue;
		} else {
			$this->img_02->ViewValue = "";
		}
		$this->img_02->ViewCustomAttributes = "";

		// img_03
		$this->img_03->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_03->Upload->DbValue)) {
			$this->img_03->ImageWidth = 100;
			$this->img_03->ImageHeight = 0;
			$this->img_03->ImageAlt = $this->img_03->FldAlt();
			$this->img_03->ViewValue = $this->img_03->Upload->DbValue;
		} else {
			$this->img_03->ViewValue = "";
		}
		$this->img_03->ViewCustomAttributes = "";

		// img_04
		$this->img_04->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_04->Upload->DbValue)) {
			$this->img_04->ImageWidth = 100;
			$this->img_04->ImageHeight = 0;
			$this->img_04->ImageAlt = $this->img_04->FldAlt();
			$this->img_04->ViewValue = $this->img_04->Upload->DbValue;
		} else {
			$this->img_04->ViewValue = "";
		}
		$this->img_04->ViewCustomAttributes = "";

		// img_05
		$this->img_05->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_05->Upload->DbValue)) {
			$this->img_05->ImageWidth = 100;
			$this->img_05->ImageHeight = 0;
			$this->img_05->ImageAlt = $this->img_05->FldAlt();
			$this->img_05->ViewValue = $this->img_05->Upload->DbValue;
		} else {
			$this->img_05->ViewValue = "";
		}
		$this->img_05->ViewCustomAttributes = "";

		// img_06
		$this->img_06->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_06->Upload->DbValue)) {
			$this->img_06->ImageWidth = 100;
			$this->img_06->ImageHeight = 0;
			$this->img_06->ImageAlt = $this->img_06->FldAlt();
			$this->img_06->ViewValue = $this->img_06->Upload->DbValue;
		} else {
			$this->img_06->ViewValue = "";
		}
		$this->img_06->ViewCustomAttributes = "";

		// img_07
		$this->img_07->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_07->Upload->DbValue)) {
			$this->img_07->ImageWidth = 100;
			$this->img_07->ImageHeight = 0;
			$this->img_07->ImageAlt = $this->img_07->FldAlt();
			$this->img_07->ViewValue = $this->img_07->Upload->DbValue;
		} else {
			$this->img_07->ViewValue = "";
		}
		$this->img_07->ViewCustomAttributes = "";

		// img_08
		$this->img_08->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_08->Upload->DbValue)) {
			$this->img_08->ImageWidth = 100;
			$this->img_08->ImageHeight = 0;
			$this->img_08->ImageAlt = $this->img_08->FldAlt();
			$this->img_08->ViewValue = $this->img_08->Upload->DbValue;
		} else {
			$this->img_08->ViewValue = "";
		}
		$this->img_08->ViewCustomAttributes = "";

		// img_09
		$this->img_09->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_09->Upload->DbValue)) {
			$this->img_09->ImageWidth = 100;
			$this->img_09->ImageHeight = 0;
			$this->img_09->ImageAlt = $this->img_09->FldAlt();
			$this->img_09->ViewValue = $this->img_09->Upload->DbValue;
		} else {
			$this->img_09->ViewValue = "";
		}
		$this->img_09->ViewCustomAttributes = "";

		// img_10
		$this->img_10->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_10->Upload->DbValue)) {
			$this->img_10->ImageWidth = 100;
			$this->img_10->ImageHeight = 0;
			$this->img_10->ImageAlt = $this->img_10->FldAlt();
			$this->img_10->ViewValue = $this->img_10->Upload->DbValue;
		} else {
			$this->img_10->ViewValue = "";
		}
		$this->img_10->ViewCustomAttributes = "";

		// img_11
		$this->img_11->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_11->Upload->DbValue)) {
			$this->img_11->ImageWidth = 100;
			$this->img_11->ImageHeight = 0;
			$this->img_11->ImageAlt = $this->img_11->FldAlt();
			$this->img_11->ViewValue = $this->img_11->Upload->DbValue;
		} else {
			$this->img_11->ViewValue = "";
		}
		$this->img_11->ViewCustomAttributes = "";

		// img_12
		$this->img_12->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_12->Upload->DbValue)) {
			$this->img_12->ImageWidth = 100;
			$this->img_12->ImageHeight = 0;
			$this->img_12->ImageAlt = $this->img_12->FldAlt();
			$this->img_12->ViewValue = $this->img_12->Upload->DbValue;
		} else {
			$this->img_12->ViewValue = "";
		}
		$this->img_12->ViewCustomAttributes = "";

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

			// userCarID
			$this->userCarID->LinkCustomAttributes = "";
			$this->userCarID->HrefValue = "";
			$this->userCarID->TooltipValue = "";

			// makeID
			$this->makeID->LinkCustomAttributes = "";
			$this->makeID->HrefValue = "";
			$this->makeID->TooltipValue = "";

			// modelID
			$this->modelID->LinkCustomAttributes = "";
			$this->modelID->HrefValue = "";
			$this->modelID->TooltipValue = "";

			// slug
			$this->slug->LinkCustomAttributes = "";
			$this->slug->HrefValue = "";
			$this->slug->TooltipValue = "";

			// yearID
			$this->yearID->LinkCustomAttributes = "";
			$this->yearID->HrefValue = "";
			$this->yearID->TooltipValue = "";

			// kilometers
			$this->kilometers->LinkCustomAttributes = "";
			$this->kilometers->HrefValue = "";
			$this->kilometers->TooltipValue = "";

			// priceAED
			$this->priceAED->LinkCustomAttributes = "";
			$this->priceAED->HrefValue = "";
			$this->priceAED->TooltipValue = "";

			// transmissionTypeID
			$this->transmissionTypeID->LinkCustomAttributes = "";
			$this->transmissionTypeID->HrefValue = "";
			$this->transmissionTypeID->TooltipValue = "";

			// thumbnail
			$this->_thumbnail->LinkCustomAttributes = "";
			$this->_thumbnail->UploadPath = 'uploads/usedcars';
			if (!ew_Empty($this->_thumbnail->Upload->DbValue)) {
				$this->_thumbnail->HrefValue = ew_GetFileUploadUrl($this->_thumbnail, $this->_thumbnail->Upload->DbValue); // Add prefix/suffix
				$this->_thumbnail->LinkAttrs["target"] = ""; // Add target
				if ($this->Export <> "") $this->_thumbnail->HrefValue = ew_FullUrl($this->_thumbnail->HrefValue, "href");
			} else {
				$this->_thumbnail->HrefValue = "";
			}
			$this->_thumbnail->HrefValue2 = $this->_thumbnail->UploadPath . $this->_thumbnail->Upload->DbValue;
			$this->_thumbnail->TooltipValue = "";
			if ($this->_thumbnail->UseColorbox) {
				if (ew_Empty($this->_thumbnail->TooltipValue))
					$this->_thumbnail->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->_thumbnail->LinkAttrs["data-rel"] = "used_cars_x__thumbnail";
				ew_AppendClass($this->_thumbnail->LinkAttrs["class"], "ewLightbox");
			}

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
				$sThisKey .= $row['userCarID'];

				// Delete old files
				$this->LoadDbValues($row);
				$this->_thumbnail->OldUploadPath = 'uploads/usedcars';
				$OldFiles = ew_Empty($row['thumbnail']) ? array() : array($row['thumbnail']);
				$OldFileCount = count($OldFiles);
				for ($i = 0; $i < $OldFileCount; $i++) {
					if (file_exists($this->_thumbnail->OldPhysicalUploadPath() . $OldFiles[$i]))
						@unlink($this->_thumbnail->OldPhysicalUploadPath() . $OldFiles[$i]);
				}
				$this->img_01->OldUploadPath = 'uploads/usedcars';
				$OldFiles = ew_Empty($row['img_01']) ? array() : array($row['img_01']);
				$OldFileCount = count($OldFiles);
				for ($i = 0; $i < $OldFileCount; $i++) {
					if (file_exists($this->img_01->OldPhysicalUploadPath() . $OldFiles[$i]))
						@unlink($this->img_01->OldPhysicalUploadPath() . $OldFiles[$i]);
				}
				$this->img_02->OldUploadPath = 'uploads/usedcars';
				$OldFiles = ew_Empty($row['img_02']) ? array() : array($row['img_02']);
				$OldFileCount = count($OldFiles);
				for ($i = 0; $i < $OldFileCount; $i++) {
					if (file_exists($this->img_02->OldPhysicalUploadPath() . $OldFiles[$i]))
						@unlink($this->img_02->OldPhysicalUploadPath() . $OldFiles[$i]);
				}
				$this->img_03->OldUploadPath = 'uploads/usedcars';
				$OldFiles = ew_Empty($row['img_03']) ? array() : array($row['img_03']);
				$OldFileCount = count($OldFiles);
				for ($i = 0; $i < $OldFileCount; $i++) {
					if (file_exists($this->img_03->OldPhysicalUploadPath() . $OldFiles[$i]))
						@unlink($this->img_03->OldPhysicalUploadPath() . $OldFiles[$i]);
				}
				$this->img_04->OldUploadPath = 'uploads/usedcars';
				$OldFiles = ew_Empty($row['img_04']) ? array() : array($row['img_04']);
				$OldFileCount = count($OldFiles);
				for ($i = 0; $i < $OldFileCount; $i++) {
					if (file_exists($this->img_04->OldPhysicalUploadPath() . $OldFiles[$i]))
						@unlink($this->img_04->OldPhysicalUploadPath() . $OldFiles[$i]);
				}
				$this->img_05->OldUploadPath = 'uploads/usedcars';
				$OldFiles = ew_Empty($row['img_05']) ? array() : array($row['img_05']);
				$OldFileCount = count($OldFiles);
				for ($i = 0; $i < $OldFileCount; $i++) {
					if (file_exists($this->img_05->OldPhysicalUploadPath() . $OldFiles[$i]))
						@unlink($this->img_05->OldPhysicalUploadPath() . $OldFiles[$i]);
				}
				$this->img_06->OldUploadPath = 'uploads/usedcars';
				$OldFiles = ew_Empty($row['img_06']) ? array() : array($row['img_06']);
				$OldFileCount = count($OldFiles);
				for ($i = 0; $i < $OldFileCount; $i++) {
					if (file_exists($this->img_06->OldPhysicalUploadPath() . $OldFiles[$i]))
						@unlink($this->img_06->OldPhysicalUploadPath() . $OldFiles[$i]);
				}
				$this->img_07->OldUploadPath = 'uploads/usedcars';
				$OldFiles = ew_Empty($row['img_07']) ? array() : array($row['img_07']);
				$OldFileCount = count($OldFiles);
				for ($i = 0; $i < $OldFileCount; $i++) {
					if (file_exists($this->img_07->OldPhysicalUploadPath() . $OldFiles[$i]))
						@unlink($this->img_07->OldPhysicalUploadPath() . $OldFiles[$i]);
				}
				$this->img_08->OldUploadPath = 'uploads/usedcars';
				$OldFiles = ew_Empty($row['img_08']) ? array() : array($row['img_08']);
				$OldFileCount = count($OldFiles);
				for ($i = 0; $i < $OldFileCount; $i++) {
					if (file_exists($this->img_08->OldPhysicalUploadPath() . $OldFiles[$i]))
						@unlink($this->img_08->OldPhysicalUploadPath() . $OldFiles[$i]);
				}
				$this->img_09->OldUploadPath = 'uploads/usedcars';
				$OldFiles = ew_Empty($row['img_09']) ? array() : array($row['img_09']);
				$OldFileCount = count($OldFiles);
				for ($i = 0; $i < $OldFileCount; $i++) {
					if (file_exists($this->img_09->OldPhysicalUploadPath() . $OldFiles[$i]))
						@unlink($this->img_09->OldPhysicalUploadPath() . $OldFiles[$i]);
				}
				$this->img_10->OldUploadPath = 'uploads/usedcars';
				$OldFiles = ew_Empty($row['img_10']) ? array() : array($row['img_10']);
				$OldFileCount = count($OldFiles);
				for ($i = 0; $i < $OldFileCount; $i++) {
					if (file_exists($this->img_10->OldPhysicalUploadPath() . $OldFiles[$i]))
						@unlink($this->img_10->OldPhysicalUploadPath() . $OldFiles[$i]);
				}
				$this->img_11->OldUploadPath = 'uploads/usedcars';
				$OldFiles = ew_Empty($row['img_11']) ? array() : array($row['img_11']);
				$OldFileCount = count($OldFiles);
				for ($i = 0; $i < $OldFileCount; $i++) {
					if (file_exists($this->img_11->OldPhysicalUploadPath() . $OldFiles[$i]))
						@unlink($this->img_11->OldPhysicalUploadPath() . $OldFiles[$i]);
				}
				$this->img_12->OldUploadPath = 'uploads/usedcars';
				$OldFiles = ew_Empty($row['img_12']) ? array() : array($row['img_12']);
				$OldFileCount = count($OldFiles);
				for ($i = 0; $i < $OldFileCount; $i++) {
					if (file_exists($this->img_12->OldPhysicalUploadPath() . $OldFiles[$i]))
						@unlink($this->img_12->OldPhysicalUploadPath() . $OldFiles[$i]);
				}
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("used_carslist.php"), "", $this->TableVar, TRUE);
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
if (!isset($used_cars_delete)) $used_cars_delete = new cused_cars_delete();

// Page init
$used_cars_delete->Page_Init();

// Page main
$used_cars_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$used_cars_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = fused_carsdelete = new ew_Form("fused_carsdelete", "delete");

// Form_CustomValidate event
fused_carsdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fused_carsdelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fused_carsdelete.Lists["x_makeID"] = {"LinkField":"x_makeID","Ajax":true,"AutoFill":false,"DisplayFields":["x_make","","",""],"ParentFields":[],"ChildFields":["x_modelID"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_make"};
fused_carsdelete.Lists["x_makeID"].Data = "<?php echo $used_cars_delete->makeID->LookupFilterQuery(FALSE, "delete") ?>";
fused_carsdelete.Lists["x_modelID"] = {"LinkField":"x_modelID","Ajax":true,"AutoFill":false,"DisplayFields":["x_model","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_model"};
fused_carsdelete.Lists["x_modelID"].Data = "<?php echo $used_cars_delete->modelID->LookupFilterQuery(FALSE, "delete") ?>";
fused_carsdelete.Lists["x_yearID"] = {"LinkField":"x_yearID","Ajax":true,"AutoFill":false,"DisplayFields":["x_year","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_year"};
fused_carsdelete.Lists["x_yearID"].Data = "<?php echo $used_cars_delete->yearID->LookupFilterQuery(FALSE, "delete") ?>";
fused_carsdelete.Lists["x_transmissionTypeID"] = {"LinkField":"x_transmissionID","Ajax":true,"AutoFill":false,"DisplayFields":["x_transmission","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"mtr_transmission"};
fused_carsdelete.Lists["x_transmissionTypeID"].Data = "<?php echo $used_cars_delete->transmissionTypeID->LookupFilterQuery(FALSE, "delete") ?>";
fused_carsdelete.Lists["x_active"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fused_carsdelete.Lists["x_active"].Options = <?php echo json_encode($used_cars_delete->active->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $used_cars_delete->ShowPageHeader(); ?>
<?php
$used_cars_delete->ShowMessage();
?>
<form name="fused_carsdelete" id="fused_carsdelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($used_cars_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $used_cars_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="used_cars">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($used_cars_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($used_cars->userCarID->Visible) { // userCarID ?>
		<th class="<?php echo $used_cars->userCarID->HeaderCellClass() ?>"><span id="elh_used_cars_userCarID" class="used_cars_userCarID"><?php echo $used_cars->userCarID->FldCaption() ?></span></th>
<?php } ?>
<?php if ($used_cars->makeID->Visible) { // makeID ?>
		<th class="<?php echo $used_cars->makeID->HeaderCellClass() ?>"><span id="elh_used_cars_makeID" class="used_cars_makeID"><?php echo $used_cars->makeID->FldCaption() ?></span></th>
<?php } ?>
<?php if ($used_cars->modelID->Visible) { // modelID ?>
		<th class="<?php echo $used_cars->modelID->HeaderCellClass() ?>"><span id="elh_used_cars_modelID" class="used_cars_modelID"><?php echo $used_cars->modelID->FldCaption() ?></span></th>
<?php } ?>
<?php if ($used_cars->slug->Visible) { // slug ?>
		<th class="<?php echo $used_cars->slug->HeaderCellClass() ?>"><span id="elh_used_cars_slug" class="used_cars_slug"><?php echo $used_cars->slug->FldCaption() ?></span></th>
<?php } ?>
<?php if ($used_cars->yearID->Visible) { // yearID ?>
		<th class="<?php echo $used_cars->yearID->HeaderCellClass() ?>"><span id="elh_used_cars_yearID" class="used_cars_yearID"><?php echo $used_cars->yearID->FldCaption() ?></span></th>
<?php } ?>
<?php if ($used_cars->kilometers->Visible) { // kilometers ?>
		<th class="<?php echo $used_cars->kilometers->HeaderCellClass() ?>"><span id="elh_used_cars_kilometers" class="used_cars_kilometers"><?php echo $used_cars->kilometers->FldCaption() ?></span></th>
<?php } ?>
<?php if ($used_cars->priceAED->Visible) { // priceAED ?>
		<th class="<?php echo $used_cars->priceAED->HeaderCellClass() ?>"><span id="elh_used_cars_priceAED" class="used_cars_priceAED"><?php echo $used_cars->priceAED->FldCaption() ?></span></th>
<?php } ?>
<?php if ($used_cars->transmissionTypeID->Visible) { // transmissionTypeID ?>
		<th class="<?php echo $used_cars->transmissionTypeID->HeaderCellClass() ?>"><span id="elh_used_cars_transmissionTypeID" class="used_cars_transmissionTypeID"><?php echo $used_cars->transmissionTypeID->FldCaption() ?></span></th>
<?php } ?>
<?php if ($used_cars->_thumbnail->Visible) { // thumbnail ?>
		<th class="<?php echo $used_cars->_thumbnail->HeaderCellClass() ?>"><span id="elh_used_cars__thumbnail" class="used_cars__thumbnail"><?php echo $used_cars->_thumbnail->FldCaption() ?></span></th>
<?php } ?>
<?php if ($used_cars->active->Visible) { // active ?>
		<th class="<?php echo $used_cars->active->HeaderCellClass() ?>"><span id="elh_used_cars_active" class="used_cars_active"><?php echo $used_cars->active->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$used_cars_delete->RecCnt = 0;
$i = 0;
while (!$used_cars_delete->Recordset->EOF) {
	$used_cars_delete->RecCnt++;
	$used_cars_delete->RowCnt++;

	// Set row properties
	$used_cars->ResetAttrs();
	$used_cars->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$used_cars_delete->LoadRowValues($used_cars_delete->Recordset);

	// Render row
	$used_cars_delete->RenderRow();
?>
	<tr<?php echo $used_cars->RowAttributes() ?>>
<?php if ($used_cars->userCarID->Visible) { // userCarID ?>
		<td<?php echo $used_cars->userCarID->CellAttributes() ?>>
<span id="el<?php echo $used_cars_delete->RowCnt ?>_used_cars_userCarID" class="used_cars_userCarID">
<span<?php echo $used_cars->userCarID->ViewAttributes() ?>>
<?php echo $used_cars->userCarID->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($used_cars->makeID->Visible) { // makeID ?>
		<td<?php echo $used_cars->makeID->CellAttributes() ?>>
<span id="el<?php echo $used_cars_delete->RowCnt ?>_used_cars_makeID" class="used_cars_makeID">
<span<?php echo $used_cars->makeID->ViewAttributes() ?>>
<?php echo $used_cars->makeID->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($used_cars->modelID->Visible) { // modelID ?>
		<td<?php echo $used_cars->modelID->CellAttributes() ?>>
<span id="el<?php echo $used_cars_delete->RowCnt ?>_used_cars_modelID" class="used_cars_modelID">
<span<?php echo $used_cars->modelID->ViewAttributes() ?>>
<?php echo $used_cars->modelID->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($used_cars->slug->Visible) { // slug ?>
		<td<?php echo $used_cars->slug->CellAttributes() ?>>
<span id="el<?php echo $used_cars_delete->RowCnt ?>_used_cars_slug" class="used_cars_slug">
<span<?php echo $used_cars->slug->ViewAttributes() ?>>
<?php echo $used_cars->slug->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($used_cars->yearID->Visible) { // yearID ?>
		<td<?php echo $used_cars->yearID->CellAttributes() ?>>
<span id="el<?php echo $used_cars_delete->RowCnt ?>_used_cars_yearID" class="used_cars_yearID">
<span<?php echo $used_cars->yearID->ViewAttributes() ?>>
<?php echo $used_cars->yearID->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($used_cars->kilometers->Visible) { // kilometers ?>
		<td<?php echo $used_cars->kilometers->CellAttributes() ?>>
<span id="el<?php echo $used_cars_delete->RowCnt ?>_used_cars_kilometers" class="used_cars_kilometers">
<span<?php echo $used_cars->kilometers->ViewAttributes() ?>>
<?php echo $used_cars->kilometers->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($used_cars->priceAED->Visible) { // priceAED ?>
		<td<?php echo $used_cars->priceAED->CellAttributes() ?>>
<span id="el<?php echo $used_cars_delete->RowCnt ?>_used_cars_priceAED" class="used_cars_priceAED">
<span<?php echo $used_cars->priceAED->ViewAttributes() ?>>
<?php echo $used_cars->priceAED->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($used_cars->transmissionTypeID->Visible) { // transmissionTypeID ?>
		<td<?php echo $used_cars->transmissionTypeID->CellAttributes() ?>>
<span id="el<?php echo $used_cars_delete->RowCnt ?>_used_cars_transmissionTypeID" class="used_cars_transmissionTypeID">
<span<?php echo $used_cars->transmissionTypeID->ViewAttributes() ?>>
<?php echo $used_cars->transmissionTypeID->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($used_cars->_thumbnail->Visible) { // thumbnail ?>
		<td<?php echo $used_cars->_thumbnail->CellAttributes() ?>>
<span id="el<?php echo $used_cars_delete->RowCnt ?>_used_cars__thumbnail" class="used_cars__thumbnail">
<span>
<?php echo ew_GetFileViewTag($used_cars->_thumbnail, $used_cars->_thumbnail->ListViewValue()) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($used_cars->active->Visible) { // active ?>
		<td<?php echo $used_cars->active->CellAttributes() ?>>
<span id="el<?php echo $used_cars_delete->RowCnt ?>_used_cars_active" class="used_cars_active">
<span<?php echo $used_cars->active->ViewAttributes() ?>>
<?php echo $used_cars->active->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$used_cars_delete->Recordset->MoveNext();
}
$used_cars_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $used_cars_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
fused_carsdelete.Init();
</script>
<?php
$used_cars_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$used_cars_delete->Page_Terminate();
?>
