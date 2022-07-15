<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "inb_used_cars_enquiryinfo.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$inb_used_cars_enquiry_edit = NULL; // Initialize page object first

class cinb_used_cars_enquiry_edit extends cinb_used_cars_enquiry {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Table name
	var $TableName = 'inb_used_cars_enquiry';

	// Page object name
	var $PageObjName = 'inb_used_cars_enquiry_edit';

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

		// Table object (inb_used_cars_enquiry)
		if (!isset($GLOBALS["inb_used_cars_enquiry"]) || get_class($GLOBALS["inb_used_cars_enquiry"]) == "cinb_used_cars_enquiry") {
			$GLOBALS["inb_used_cars_enquiry"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["inb_used_cars_enquiry"];
		}

		// Table object (cms_users)
		if (!isset($GLOBALS['cms_users'])) $GLOBALS['cms_users'] = new ccms_users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'inb_used_cars_enquiry', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("inb_used_cars_enquirylist.php"));
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
		$this->id->SetVisibility();
		$this->id->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
		$this->firstName->SetVisibility();
		$this->lastName->SetVisibility();
		$this->_email->SetVisibility();
		$this->mobileNumber->SetVisibility();
		$this->country->SetVisibility();
		$this->city->SetVisibility();
		$this->nationality->SetVisibility();
		$this->address->SetVisibility();
		$this->message->SetVisibility();
		$this->carUsedType->SetVisibility();
		$this->carName->SetVisibility();
		$this->price->SetVisibility();
		$this->kilometer->SetVisibility();
		$this->regionalSpec->SetVisibility();
		$this->transmission->SetVisibility();
		$this->fuel->SetVisibility();
		$this->newsletter->SetVisibility();
		$this->dateCreated->SetVisibility();

		// Set up multi page object
		$this->SetupMultiPages();

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
		global $EW_EXPORT, $inb_used_cars_enquiry;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($inb_used_cars_enquiry);
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
					if ($pageName == "inb_used_cars_enquiryview.php")
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
	var $MultiPages; // Multi pages object

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
			if ($objForm->HasValue("x_id")) {
				$this->id->setFormValue($objForm->GetValue("x_id"));
			}
		} else {
			$this->CurrentAction = "I"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (isset($_GET["id"])) {
				$this->id->setQueryStringValue($_GET["id"]);
				$loadByQuery = TRUE;
			} else {
				$this->id->CurrentValue = NULL;
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
					$this->Page_Terminate("inb_used_cars_enquirylist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "inb_used_cars_enquirylist.php")
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
		if (!$this->id->FldIsDetailKey)
			$this->id->setFormValue($objForm->GetValue("x_id"));
		if (!$this->firstName->FldIsDetailKey) {
			$this->firstName->setFormValue($objForm->GetValue("x_firstName"));
		}
		if (!$this->lastName->FldIsDetailKey) {
			$this->lastName->setFormValue($objForm->GetValue("x_lastName"));
		}
		if (!$this->_email->FldIsDetailKey) {
			$this->_email->setFormValue($objForm->GetValue("x__email"));
		}
		if (!$this->mobileNumber->FldIsDetailKey) {
			$this->mobileNumber->setFormValue($objForm->GetValue("x_mobileNumber"));
		}
		if (!$this->country->FldIsDetailKey) {
			$this->country->setFormValue($objForm->GetValue("x_country"));
		}
		if (!$this->city->FldIsDetailKey) {
			$this->city->setFormValue($objForm->GetValue("x_city"));
		}
		if (!$this->nationality->FldIsDetailKey) {
			$this->nationality->setFormValue($objForm->GetValue("x_nationality"));
		}
		if (!$this->address->FldIsDetailKey) {
			$this->address->setFormValue($objForm->GetValue("x_address"));
		}
		if (!$this->message->FldIsDetailKey) {
			$this->message->setFormValue($objForm->GetValue("x_message"));
		}
		if (!$this->carUsedType->FldIsDetailKey) {
			$this->carUsedType->setFormValue($objForm->GetValue("x_carUsedType"));
		}
		if (!$this->carName->FldIsDetailKey) {
			$this->carName->setFormValue($objForm->GetValue("x_carName"));
		}
		if (!$this->price->FldIsDetailKey) {
			$this->price->setFormValue($objForm->GetValue("x_price"));
		}
		if (!$this->kilometer->FldIsDetailKey) {
			$this->kilometer->setFormValue($objForm->GetValue("x_kilometer"));
		}
		if (!$this->regionalSpec->FldIsDetailKey) {
			$this->regionalSpec->setFormValue($objForm->GetValue("x_regionalSpec"));
		}
		if (!$this->transmission->FldIsDetailKey) {
			$this->transmission->setFormValue($objForm->GetValue("x_transmission"));
		}
		if (!$this->fuel->FldIsDetailKey) {
			$this->fuel->setFormValue($objForm->GetValue("x_fuel"));
		}
		if (!$this->newsletter->FldIsDetailKey) {
			$this->newsletter->setFormValue($objForm->GetValue("x_newsletter"));
		}
		if (!$this->dateCreated->FldIsDetailKey) {
			$this->dateCreated->setFormValue($objForm->GetValue("x_dateCreated"));
			$this->dateCreated->CurrentValue = ew_UnFormatDateTime($this->dateCreated->CurrentValue, 7);
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->firstName->CurrentValue = $this->firstName->FormValue;
		$this->lastName->CurrentValue = $this->lastName->FormValue;
		$this->_email->CurrentValue = $this->_email->FormValue;
		$this->mobileNumber->CurrentValue = $this->mobileNumber->FormValue;
		$this->country->CurrentValue = $this->country->FormValue;
		$this->city->CurrentValue = $this->city->FormValue;
		$this->nationality->CurrentValue = $this->nationality->FormValue;
		$this->address->CurrentValue = $this->address->FormValue;
		$this->message->CurrentValue = $this->message->FormValue;
		$this->carUsedType->CurrentValue = $this->carUsedType->FormValue;
		$this->carName->CurrentValue = $this->carName->FormValue;
		$this->price->CurrentValue = $this->price->FormValue;
		$this->kilometer->CurrentValue = $this->kilometer->FormValue;
		$this->regionalSpec->CurrentValue = $this->regionalSpec->FormValue;
		$this->transmission->CurrentValue = $this->transmission->FormValue;
		$this->fuel->CurrentValue = $this->fuel->FormValue;
		$this->newsletter->CurrentValue = $this->newsletter->FormValue;
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
		$this->id->setDbValue($row['id']);
		$this->firstName->setDbValue($row['firstName']);
		$this->lastName->setDbValue($row['lastName']);
		$this->_email->setDbValue($row['email']);
		$this->mobileNumber->setDbValue($row['mobileNumber']);
		$this->country->setDbValue($row['country']);
		$this->city->setDbValue($row['city']);
		$this->nationality->setDbValue($row['nationality']);
		$this->address->setDbValue($row['address']);
		$this->message->setDbValue($row['message']);
		$this->carUsedType->setDbValue($row['carUsedType']);
		$this->carName->setDbValue($row['carName']);
		$this->price->setDbValue($row['price']);
		$this->kilometer->setDbValue($row['kilometer']);
		$this->regionalSpec->setDbValue($row['regionalSpec']);
		$this->transmission->setDbValue($row['transmission']);
		$this->fuel->setDbValue($row['fuel']);
		$this->newsletter->setDbValue($row['newsletter']);
		$this->dateCreated->setDbValue($row['dateCreated']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['id'] = NULL;
		$row['firstName'] = NULL;
		$row['lastName'] = NULL;
		$row['email'] = NULL;
		$row['mobileNumber'] = NULL;
		$row['country'] = NULL;
		$row['city'] = NULL;
		$row['nationality'] = NULL;
		$row['address'] = NULL;
		$row['message'] = NULL;
		$row['carUsedType'] = NULL;
		$row['carName'] = NULL;
		$row['price'] = NULL;
		$row['kilometer'] = NULL;
		$row['regionalSpec'] = NULL;
		$row['transmission'] = NULL;
		$row['fuel'] = NULL;
		$row['newsletter'] = NULL;
		$row['dateCreated'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->firstName->DbValue = $row['firstName'];
		$this->lastName->DbValue = $row['lastName'];
		$this->_email->DbValue = $row['email'];
		$this->mobileNumber->DbValue = $row['mobileNumber'];
		$this->country->DbValue = $row['country'];
		$this->city->DbValue = $row['city'];
		$this->nationality->DbValue = $row['nationality'];
		$this->address->DbValue = $row['address'];
		$this->message->DbValue = $row['message'];
		$this->carUsedType->DbValue = $row['carUsedType'];
		$this->carName->DbValue = $row['carName'];
		$this->price->DbValue = $row['price'];
		$this->kilometer->DbValue = $row['kilometer'];
		$this->regionalSpec->DbValue = $row['regionalSpec'];
		$this->transmission->DbValue = $row['transmission'];
		$this->fuel->DbValue = $row['fuel'];
		$this->newsletter->DbValue = $row['newsletter'];
		$this->dateCreated->DbValue = $row['dateCreated'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("id")) <> "")
			$this->id->CurrentValue = $this->getKey("id"); // id
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
		// id
		// firstName
		// lastName
		// email
		// mobileNumber
		// country
		// city
		// nationality
		// address
		// message
		// carUsedType
		// carName
		// price
		// kilometer
		// regionalSpec
		// transmission
		// fuel
		// newsletter
		// dateCreated

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// firstName
		$this->firstName->ViewValue = $this->firstName->CurrentValue;
		$this->firstName->ViewCustomAttributes = "";

		// lastName
		$this->lastName->ViewValue = $this->lastName->CurrentValue;
		$this->lastName->ViewCustomAttributes = "";

		// email
		$this->_email->ViewValue = $this->_email->CurrentValue;
		$this->_email->ViewCustomAttributes = "";

		// mobileNumber
		$this->mobileNumber->ViewValue = $this->mobileNumber->CurrentValue;
		$this->mobileNumber->ViewCustomAttributes = "";

		// country
		$this->country->ViewValue = $this->country->CurrentValue;
		$this->country->ViewCustomAttributes = "";

		// city
		$this->city->ViewValue = $this->city->CurrentValue;
		$this->city->ViewCustomAttributes = "";

		// nationality
		$this->nationality->ViewValue = $this->nationality->CurrentValue;
		$this->nationality->ViewCustomAttributes = "";

		// address
		$this->address->ViewValue = $this->address->CurrentValue;
		$this->address->ViewCustomAttributes = "";

		// message
		$this->message->ViewValue = $this->message->CurrentValue;
		$this->message->ViewCustomAttributes = "";

		// carUsedType
		$this->carUsedType->ViewValue = $this->carUsedType->CurrentValue;
		$this->carUsedType->ViewCustomAttributes = "";

		// carName
		$this->carName->ViewValue = $this->carName->CurrentValue;
		$this->carName->ViewCustomAttributes = "";

		// price
		$this->price->ViewValue = $this->price->CurrentValue;
		$this->price->ViewCustomAttributes = "";

		// kilometer
		$this->kilometer->ViewValue = $this->kilometer->CurrentValue;
		$this->kilometer->ViewCustomAttributes = "";

		// regionalSpec
		$this->regionalSpec->ViewValue = $this->regionalSpec->CurrentValue;
		$this->regionalSpec->ViewCustomAttributes = "";

		// transmission
		$this->transmission->ViewValue = $this->transmission->CurrentValue;
		$this->transmission->ViewCustomAttributes = "";

		// fuel
		$this->fuel->ViewValue = $this->fuel->CurrentValue;
		$this->fuel->ViewCustomAttributes = "";

		// newsletter
		$this->newsletter->ViewValue = $this->newsletter->CurrentValue;
		$this->newsletter->ViewCustomAttributes = "";

		// dateCreated
		$this->dateCreated->ViewValue = $this->dateCreated->CurrentValue;
		$this->dateCreated->ViewValue = ew_FormatDateTime($this->dateCreated->ViewValue, 7);
		$this->dateCreated->ViewCustomAttributes = "";

			// id
			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";
			$this->id->TooltipValue = "";

			// firstName
			$this->firstName->LinkCustomAttributes = "";
			$this->firstName->HrefValue = "";
			$this->firstName->TooltipValue = "";

			// lastName
			$this->lastName->LinkCustomAttributes = "";
			$this->lastName->HrefValue = "";
			$this->lastName->TooltipValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";
			$this->_email->TooltipValue = "";

			// mobileNumber
			$this->mobileNumber->LinkCustomAttributes = "";
			$this->mobileNumber->HrefValue = "";
			$this->mobileNumber->TooltipValue = "";

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

			// address
			$this->address->LinkCustomAttributes = "";
			$this->address->HrefValue = "";
			$this->address->TooltipValue = "";

			// message
			$this->message->LinkCustomAttributes = "";
			$this->message->HrefValue = "";
			$this->message->TooltipValue = "";

			// carUsedType
			$this->carUsedType->LinkCustomAttributes = "";
			$this->carUsedType->HrefValue = "";
			$this->carUsedType->TooltipValue = "";

			// carName
			$this->carName->LinkCustomAttributes = "";
			$this->carName->HrefValue = "";
			$this->carName->TooltipValue = "";

			// price
			$this->price->LinkCustomAttributes = "";
			$this->price->HrefValue = "";
			$this->price->TooltipValue = "";

			// kilometer
			$this->kilometer->LinkCustomAttributes = "";
			$this->kilometer->HrefValue = "";
			$this->kilometer->TooltipValue = "";

			// regionalSpec
			$this->regionalSpec->LinkCustomAttributes = "";
			$this->regionalSpec->HrefValue = "";
			$this->regionalSpec->TooltipValue = "";

			// transmission
			$this->transmission->LinkCustomAttributes = "";
			$this->transmission->HrefValue = "";
			$this->transmission->TooltipValue = "";

			// fuel
			$this->fuel->LinkCustomAttributes = "";
			$this->fuel->HrefValue = "";
			$this->fuel->TooltipValue = "";

			// newsletter
			$this->newsletter->LinkCustomAttributes = "";
			$this->newsletter->HrefValue = "";
			$this->newsletter->TooltipValue = "";

			// dateCreated
			$this->dateCreated->LinkCustomAttributes = "";
			$this->dateCreated->HrefValue = "";
			$this->dateCreated->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$this->id->EditAttrs["class"] = "form-control";
			$this->id->EditCustomAttributes = "";
			$this->id->EditValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

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

			// email
			$this->_email->EditAttrs["class"] = "form-control";
			$this->_email->EditCustomAttributes = "";
			$this->_email->EditValue = ew_HtmlEncode($this->_email->CurrentValue);
			$this->_email->PlaceHolder = ew_RemoveHtml($this->_email->FldCaption());

			// mobileNumber
			$this->mobileNumber->EditAttrs["class"] = "form-control";
			$this->mobileNumber->EditCustomAttributes = "";
			$this->mobileNumber->EditValue = ew_HtmlEncode($this->mobileNumber->CurrentValue);
			$this->mobileNumber->PlaceHolder = ew_RemoveHtml($this->mobileNumber->FldCaption());

			// country
			$this->country->EditAttrs["class"] = "form-control";
			$this->country->EditCustomAttributes = "";
			$this->country->EditValue = ew_HtmlEncode($this->country->CurrentValue);
			$this->country->PlaceHolder = ew_RemoveHtml($this->country->FldCaption());

			// city
			$this->city->EditAttrs["class"] = "form-control";
			$this->city->EditCustomAttributes = "";
			$this->city->EditValue = ew_HtmlEncode($this->city->CurrentValue);
			$this->city->PlaceHolder = ew_RemoveHtml($this->city->FldCaption());

			// nationality
			$this->nationality->EditAttrs["class"] = "form-control";
			$this->nationality->EditCustomAttributes = "";
			$this->nationality->EditValue = ew_HtmlEncode($this->nationality->CurrentValue);
			$this->nationality->PlaceHolder = ew_RemoveHtml($this->nationality->FldCaption());

			// address
			$this->address->EditAttrs["class"] = "form-control";
			$this->address->EditCustomAttributes = "";
			$this->address->EditValue = ew_HtmlEncode($this->address->CurrentValue);
			$this->address->PlaceHolder = ew_RemoveHtml($this->address->FldCaption());

			// message
			$this->message->EditAttrs["class"] = "form-control";
			$this->message->EditCustomAttributes = "";
			$this->message->EditValue = ew_HtmlEncode($this->message->CurrentValue);
			$this->message->PlaceHolder = ew_RemoveHtml($this->message->FldCaption());

			// carUsedType
			$this->carUsedType->EditAttrs["class"] = "form-control";
			$this->carUsedType->EditCustomAttributes = "";
			$this->carUsedType->EditValue = ew_HtmlEncode($this->carUsedType->CurrentValue);
			$this->carUsedType->PlaceHolder = ew_RemoveHtml($this->carUsedType->FldCaption());

			// carName
			$this->carName->EditAttrs["class"] = "form-control";
			$this->carName->EditCustomAttributes = "";
			$this->carName->EditValue = ew_HtmlEncode($this->carName->CurrentValue);
			$this->carName->PlaceHolder = ew_RemoveHtml($this->carName->FldCaption());

			// price
			$this->price->EditAttrs["class"] = "form-control";
			$this->price->EditCustomAttributes = "";
			$this->price->EditValue = ew_HtmlEncode($this->price->CurrentValue);
			$this->price->PlaceHolder = ew_RemoveHtml($this->price->FldCaption());

			// kilometer
			$this->kilometer->EditAttrs["class"] = "form-control";
			$this->kilometer->EditCustomAttributes = "";
			$this->kilometer->EditValue = ew_HtmlEncode($this->kilometer->CurrentValue);
			$this->kilometer->PlaceHolder = ew_RemoveHtml($this->kilometer->FldCaption());

			// regionalSpec
			$this->regionalSpec->EditAttrs["class"] = "form-control";
			$this->regionalSpec->EditCustomAttributes = "";
			$this->regionalSpec->EditValue = ew_HtmlEncode($this->regionalSpec->CurrentValue);
			$this->regionalSpec->PlaceHolder = ew_RemoveHtml($this->regionalSpec->FldCaption());

			// transmission
			$this->transmission->EditAttrs["class"] = "form-control";
			$this->transmission->EditCustomAttributes = "";
			$this->transmission->EditValue = ew_HtmlEncode($this->transmission->CurrentValue);
			$this->transmission->PlaceHolder = ew_RemoveHtml($this->transmission->FldCaption());

			// fuel
			$this->fuel->EditAttrs["class"] = "form-control";
			$this->fuel->EditCustomAttributes = "";
			$this->fuel->EditValue = ew_HtmlEncode($this->fuel->CurrentValue);
			$this->fuel->PlaceHolder = ew_RemoveHtml($this->fuel->FldCaption());

			// newsletter
			$this->newsletter->EditAttrs["class"] = "form-control";
			$this->newsletter->EditCustomAttributes = "";
			$this->newsletter->EditValue = ew_HtmlEncode($this->newsletter->CurrentValue);
			$this->newsletter->PlaceHolder = ew_RemoveHtml($this->newsletter->FldCaption());

			// dateCreated
			$this->dateCreated->EditAttrs["class"] = "form-control";
			$this->dateCreated->EditCustomAttributes = "";
			$this->dateCreated->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->dateCreated->CurrentValue, 7));
			$this->dateCreated->PlaceHolder = ew_RemoveHtml($this->dateCreated->FldCaption());

			// Edit refer script
			// id

			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";

			// firstName
			$this->firstName->LinkCustomAttributes = "";
			$this->firstName->HrefValue = "";

			// lastName
			$this->lastName->LinkCustomAttributes = "";
			$this->lastName->HrefValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";

			// mobileNumber
			$this->mobileNumber->LinkCustomAttributes = "";
			$this->mobileNumber->HrefValue = "";

			// country
			$this->country->LinkCustomAttributes = "";
			$this->country->HrefValue = "";

			// city
			$this->city->LinkCustomAttributes = "";
			$this->city->HrefValue = "";

			// nationality
			$this->nationality->LinkCustomAttributes = "";
			$this->nationality->HrefValue = "";

			// address
			$this->address->LinkCustomAttributes = "";
			$this->address->HrefValue = "";

			// message
			$this->message->LinkCustomAttributes = "";
			$this->message->HrefValue = "";

			// carUsedType
			$this->carUsedType->LinkCustomAttributes = "";
			$this->carUsedType->HrefValue = "";

			// carName
			$this->carName->LinkCustomAttributes = "";
			$this->carName->HrefValue = "";

			// price
			$this->price->LinkCustomAttributes = "";
			$this->price->HrefValue = "";

			// kilometer
			$this->kilometer->LinkCustomAttributes = "";
			$this->kilometer->HrefValue = "";

			// regionalSpec
			$this->regionalSpec->LinkCustomAttributes = "";
			$this->regionalSpec->HrefValue = "";

			// transmission
			$this->transmission->LinkCustomAttributes = "";
			$this->transmission->HrefValue = "";

			// fuel
			$this->fuel->LinkCustomAttributes = "";
			$this->fuel->HrefValue = "";

			// newsletter
			$this->newsletter->LinkCustomAttributes = "";
			$this->newsletter->HrefValue = "";

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

			// email
			$this->_email->SetDbValueDef($rsnew, $this->_email->CurrentValue, NULL, $this->_email->ReadOnly);

			// mobileNumber
			$this->mobileNumber->SetDbValueDef($rsnew, $this->mobileNumber->CurrentValue, NULL, $this->mobileNumber->ReadOnly);

			// country
			$this->country->SetDbValueDef($rsnew, $this->country->CurrentValue, NULL, $this->country->ReadOnly);

			// city
			$this->city->SetDbValueDef($rsnew, $this->city->CurrentValue, NULL, $this->city->ReadOnly);

			// nationality
			$this->nationality->SetDbValueDef($rsnew, $this->nationality->CurrentValue, NULL, $this->nationality->ReadOnly);

			// address
			$this->address->SetDbValueDef($rsnew, $this->address->CurrentValue, NULL, $this->address->ReadOnly);

			// message
			$this->message->SetDbValueDef($rsnew, $this->message->CurrentValue, NULL, $this->message->ReadOnly);

			// carUsedType
			$this->carUsedType->SetDbValueDef($rsnew, $this->carUsedType->CurrentValue, NULL, $this->carUsedType->ReadOnly);

			// carName
			$this->carName->SetDbValueDef($rsnew, $this->carName->CurrentValue, NULL, $this->carName->ReadOnly);

			// price
			$this->price->SetDbValueDef($rsnew, $this->price->CurrentValue, NULL, $this->price->ReadOnly);

			// kilometer
			$this->kilometer->SetDbValueDef($rsnew, $this->kilometer->CurrentValue, NULL, $this->kilometer->ReadOnly);

			// regionalSpec
			$this->regionalSpec->SetDbValueDef($rsnew, $this->regionalSpec->CurrentValue, NULL, $this->regionalSpec->ReadOnly);

			// transmission
			$this->transmission->SetDbValueDef($rsnew, $this->transmission->CurrentValue, NULL, $this->transmission->ReadOnly);

			// fuel
			$this->fuel->SetDbValueDef($rsnew, $this->fuel->CurrentValue, NULL, $this->fuel->ReadOnly);

			// newsletter
			$this->newsletter->SetDbValueDef($rsnew, $this->newsletter->CurrentValue, NULL, $this->newsletter->ReadOnly);

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("inb_used_cars_enquirylist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Set up multi pages
	function SetupMultiPages() {
		$pages = new cSubPages();
		$pages->Style = "tabs";
		$pages->Add(0);
		$pages->Add(1);
		$pages->Add(2);
		$this->MultiPages = $pages;
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
if (!isset($inb_used_cars_enquiry_edit)) $inb_used_cars_enquiry_edit = new cinb_used_cars_enquiry_edit();

// Page init
$inb_used_cars_enquiry_edit->Page_Init();

// Page main
$inb_used_cars_enquiry_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inb_used_cars_enquiry_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = finb_used_cars_enquiryedit = new ew_Form("finb_used_cars_enquiryedit", "edit");

// Validate form
finb_used_cars_enquiryedit.Validate = function() {
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
				return this.OnError(elm, "<?php echo ew_JsEncode2($inb_used_cars_enquiry->dateCreated->FldErrMsg()) ?>");

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
finb_used_cars_enquiryedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
finb_used_cars_enquiryedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Multi-Page
finb_used_cars_enquiryedit.MultiPage = new ew_MultiPage("finb_used_cars_enquiryedit");

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $inb_used_cars_enquiry_edit->ShowPageHeader(); ?>
<?php
$inb_used_cars_enquiry_edit->ShowMessage();
?>
<form name="finb_used_cars_enquiryedit" id="finb_used_cars_enquiryedit" class="<?php echo $inb_used_cars_enquiry_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($inb_used_cars_enquiry_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $inb_used_cars_enquiry_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inb_used_cars_enquiry">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($inb_used_cars_enquiry_edit->IsModal) ?>">
<div class="ewMultiPage"><!-- multi-page -->
<div class="nav-tabs-custom" id="inb_used_cars_enquiry_edit"><!-- multi-page .nav-tabs-custom -->
	<ul class="nav<?php echo $inb_used_cars_enquiry_edit->MultiPages->NavStyle() ?>">
		<li<?php echo $inb_used_cars_enquiry_edit->MultiPages->TabStyle("1") ?>><a href="#tab_inb_used_cars_enquiry1" data-toggle="tab"><?php echo $inb_used_cars_enquiry->PageCaption(1) ?></a></li>
		<li<?php echo $inb_used_cars_enquiry_edit->MultiPages->TabStyle("2") ?>><a href="#tab_inb_used_cars_enquiry2" data-toggle="tab"><?php echo $inb_used_cars_enquiry->PageCaption(2) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page .nav-tabs-custom .tab-content -->
		<div class="tab-pane<?php echo $inb_used_cars_enquiry_edit->MultiPages->PageStyle("1") ?>" id="tab_inb_used_cars_enquiry1"><!-- multi-page .tab-pane -->
<div class="ewEditDiv"><!-- page* -->
<?php if ($inb_used_cars_enquiry->id->Visible) { // id ?>
	<div id="r_id" class="form-group">
		<label id="elh_inb_used_cars_enquiry_id" class="<?php echo $inb_used_cars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_used_cars_enquiry->id->FldCaption() ?></label>
		<div class="<?php echo $inb_used_cars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_used_cars_enquiry->id->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_id">
<span<?php echo $inb_used_cars_enquiry->id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $inb_used_cars_enquiry->id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="inb_used_cars_enquiry" data-field="x_id" data-page="1" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($inb_used_cars_enquiry->id->CurrentValue) ?>">
<?php echo $inb_used_cars_enquiry->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_used_cars_enquiry->firstName->Visible) { // firstName ?>
	<div id="r_firstName" class="form-group">
		<label id="elh_inb_used_cars_enquiry_firstName" for="x_firstName" class="<?php echo $inb_used_cars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_used_cars_enquiry->firstName->FldCaption() ?></label>
		<div class="<?php echo $inb_used_cars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_used_cars_enquiry->firstName->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_firstName">
<input type="text" data-table="inb_used_cars_enquiry" data-field="x_firstName" data-page="1" name="x_firstName" id="x_firstName" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_used_cars_enquiry->firstName->getPlaceHolder()) ?>" value="<?php echo $inb_used_cars_enquiry->firstName->EditValue ?>"<?php echo $inb_used_cars_enquiry->firstName->EditAttributes() ?>>
</span>
<?php echo $inb_used_cars_enquiry->firstName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_used_cars_enquiry->lastName->Visible) { // lastName ?>
	<div id="r_lastName" class="form-group">
		<label id="elh_inb_used_cars_enquiry_lastName" for="x_lastName" class="<?php echo $inb_used_cars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_used_cars_enquiry->lastName->FldCaption() ?></label>
		<div class="<?php echo $inb_used_cars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_used_cars_enquiry->lastName->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_lastName">
<input type="text" data-table="inb_used_cars_enquiry" data-field="x_lastName" data-page="1" name="x_lastName" id="x_lastName" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_used_cars_enquiry->lastName->getPlaceHolder()) ?>" value="<?php echo $inb_used_cars_enquiry->lastName->EditValue ?>"<?php echo $inb_used_cars_enquiry->lastName->EditAttributes() ?>>
</span>
<?php echo $inb_used_cars_enquiry->lastName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_used_cars_enquiry->_email->Visible) { // email ?>
	<div id="r__email" class="form-group">
		<label id="elh_inb_used_cars_enquiry__email" for="x__email" class="<?php echo $inb_used_cars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_used_cars_enquiry->_email->FldCaption() ?></label>
		<div class="<?php echo $inb_used_cars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_used_cars_enquiry->_email->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry__email">
<input type="text" data-table="inb_used_cars_enquiry" data-field="x__email" data-page="1" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_used_cars_enquiry->_email->getPlaceHolder()) ?>" value="<?php echo $inb_used_cars_enquiry->_email->EditValue ?>"<?php echo $inb_used_cars_enquiry->_email->EditAttributes() ?>>
</span>
<?php echo $inb_used_cars_enquiry->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_used_cars_enquiry->mobileNumber->Visible) { // mobileNumber ?>
	<div id="r_mobileNumber" class="form-group">
		<label id="elh_inb_used_cars_enquiry_mobileNumber" for="x_mobileNumber" class="<?php echo $inb_used_cars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_used_cars_enquiry->mobileNumber->FldCaption() ?></label>
		<div class="<?php echo $inb_used_cars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_used_cars_enquiry->mobileNumber->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_mobileNumber">
<input type="text" data-table="inb_used_cars_enquiry" data-field="x_mobileNumber" data-page="1" name="x_mobileNumber" id="x_mobileNumber" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_used_cars_enquiry->mobileNumber->getPlaceHolder()) ?>" value="<?php echo $inb_used_cars_enquiry->mobileNumber->EditValue ?>"<?php echo $inb_used_cars_enquiry->mobileNumber->EditAttributes() ?>>
</span>
<?php echo $inb_used_cars_enquiry->mobileNumber->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_used_cars_enquiry->country->Visible) { // country ?>
	<div id="r_country" class="form-group">
		<label id="elh_inb_used_cars_enquiry_country" for="x_country" class="<?php echo $inb_used_cars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_used_cars_enquiry->country->FldCaption() ?></label>
		<div class="<?php echo $inb_used_cars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_used_cars_enquiry->country->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_country">
<input type="text" data-table="inb_used_cars_enquiry" data-field="x_country" data-page="1" name="x_country" id="x_country" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_used_cars_enquiry->country->getPlaceHolder()) ?>" value="<?php echo $inb_used_cars_enquiry->country->EditValue ?>"<?php echo $inb_used_cars_enquiry->country->EditAttributes() ?>>
</span>
<?php echo $inb_used_cars_enquiry->country->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_used_cars_enquiry->city->Visible) { // city ?>
	<div id="r_city" class="form-group">
		<label id="elh_inb_used_cars_enquiry_city" for="x_city" class="<?php echo $inb_used_cars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_used_cars_enquiry->city->FldCaption() ?></label>
		<div class="<?php echo $inb_used_cars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_used_cars_enquiry->city->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_city">
<input type="text" data-table="inb_used_cars_enquiry" data-field="x_city" data-page="1" name="x_city" id="x_city" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_used_cars_enquiry->city->getPlaceHolder()) ?>" value="<?php echo $inb_used_cars_enquiry->city->EditValue ?>"<?php echo $inb_used_cars_enquiry->city->EditAttributes() ?>>
</span>
<?php echo $inb_used_cars_enquiry->city->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_used_cars_enquiry->nationality->Visible) { // nationality ?>
	<div id="r_nationality" class="form-group">
		<label id="elh_inb_used_cars_enquiry_nationality" for="x_nationality" class="<?php echo $inb_used_cars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_used_cars_enquiry->nationality->FldCaption() ?></label>
		<div class="<?php echo $inb_used_cars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_used_cars_enquiry->nationality->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_nationality">
<input type="text" data-table="inb_used_cars_enquiry" data-field="x_nationality" data-page="1" name="x_nationality" id="x_nationality" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_used_cars_enquiry->nationality->getPlaceHolder()) ?>" value="<?php echo $inb_used_cars_enquiry->nationality->EditValue ?>"<?php echo $inb_used_cars_enquiry->nationality->EditAttributes() ?>>
</span>
<?php echo $inb_used_cars_enquiry->nationality->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_used_cars_enquiry->address->Visible) { // address ?>
	<div id="r_address" class="form-group">
		<label id="elh_inb_used_cars_enquiry_address" for="x_address" class="<?php echo $inb_used_cars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_used_cars_enquiry->address->FldCaption() ?></label>
		<div class="<?php echo $inb_used_cars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_used_cars_enquiry->address->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_address">
<textarea data-table="inb_used_cars_enquiry" data-field="x_address" data-page="1" name="x_address" id="x_address" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($inb_used_cars_enquiry->address->getPlaceHolder()) ?>"<?php echo $inb_used_cars_enquiry->address->EditAttributes() ?>><?php echo $inb_used_cars_enquiry->address->EditValue ?></textarea>
</span>
<?php echo $inb_used_cars_enquiry->address->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_used_cars_enquiry->message->Visible) { // message ?>
	<div id="r_message" class="form-group">
		<label id="elh_inb_used_cars_enquiry_message" class="<?php echo $inb_used_cars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_used_cars_enquiry->message->FldCaption() ?></label>
		<div class="<?php echo $inb_used_cars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_used_cars_enquiry->message->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_message">
<?php ew_AppendClass($inb_used_cars_enquiry->message->EditAttrs["class"], "editor"); ?>
<textarea data-table="inb_used_cars_enquiry" data-field="x_message" data-page="1" name="x_message" id="x_message" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($inb_used_cars_enquiry->message->getPlaceHolder()) ?>"<?php echo $inb_used_cars_enquiry->message->EditAttributes() ?>><?php echo $inb_used_cars_enquiry->message->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("finb_used_cars_enquiryedit", "x_message", 35, 4, <?php echo ($inb_used_cars_enquiry->message->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $inb_used_cars_enquiry->message->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_used_cars_enquiry->newsletter->Visible) { // newsletter ?>
	<div id="r_newsletter" class="form-group">
		<label id="elh_inb_used_cars_enquiry_newsletter" for="x_newsletter" class="<?php echo $inb_used_cars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_used_cars_enquiry->newsletter->FldCaption() ?></label>
		<div class="<?php echo $inb_used_cars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_used_cars_enquiry->newsletter->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_newsletter">
<input type="text" data-table="inb_used_cars_enquiry" data-field="x_newsletter" data-page="1" name="x_newsletter" id="x_newsletter" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_used_cars_enquiry->newsletter->getPlaceHolder()) ?>" value="<?php echo $inb_used_cars_enquiry->newsletter->EditValue ?>"<?php echo $inb_used_cars_enquiry->newsletter->EditAttributes() ?>>
</span>
<?php echo $inb_used_cars_enquiry->newsletter->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_used_cars_enquiry->dateCreated->Visible) { // dateCreated ?>
	<div id="r_dateCreated" class="form-group">
		<label id="elh_inb_used_cars_enquiry_dateCreated" for="x_dateCreated" class="<?php echo $inb_used_cars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_used_cars_enquiry->dateCreated->FldCaption() ?></label>
		<div class="<?php echo $inb_used_cars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_used_cars_enquiry->dateCreated->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_dateCreated">
<input type="text" data-table="inb_used_cars_enquiry" data-field="x_dateCreated" data-page="1" data-format="7" name="x_dateCreated" id="x_dateCreated" placeholder="<?php echo ew_HtmlEncode($inb_used_cars_enquiry->dateCreated->getPlaceHolder()) ?>" value="<?php echo $inb_used_cars_enquiry->dateCreated->EditValue ?>"<?php echo $inb_used_cars_enquiry->dateCreated->EditAttributes() ?>>
<?php if (!$inb_used_cars_enquiry->dateCreated->ReadOnly && !$inb_used_cars_enquiry->dateCreated->Disabled && !isset($inb_used_cars_enquiry->dateCreated->EditAttrs["readonly"]) && !isset($inb_used_cars_enquiry->dateCreated->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("finb_used_cars_enquiryedit", "x_dateCreated", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php echo $inb_used_cars_enquiry->dateCreated->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $inb_used_cars_enquiry_edit->MultiPages->PageStyle("2") ?>" id="tab_inb_used_cars_enquiry2"><!-- multi-page .tab-pane -->
<div class="ewEditDiv"><!-- page* -->
<?php if ($inb_used_cars_enquiry->carUsedType->Visible) { // carUsedType ?>
	<div id="r_carUsedType" class="form-group">
		<label id="elh_inb_used_cars_enquiry_carUsedType" for="x_carUsedType" class="<?php echo $inb_used_cars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_used_cars_enquiry->carUsedType->FldCaption() ?></label>
		<div class="<?php echo $inb_used_cars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_used_cars_enquiry->carUsedType->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_carUsedType">
<input type="text" data-table="inb_used_cars_enquiry" data-field="x_carUsedType" data-page="2" name="x_carUsedType" id="x_carUsedType" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_used_cars_enquiry->carUsedType->getPlaceHolder()) ?>" value="<?php echo $inb_used_cars_enquiry->carUsedType->EditValue ?>"<?php echo $inb_used_cars_enquiry->carUsedType->EditAttributes() ?>>
</span>
<?php echo $inb_used_cars_enquiry->carUsedType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_used_cars_enquiry->carName->Visible) { // carName ?>
	<div id="r_carName" class="form-group">
		<label id="elh_inb_used_cars_enquiry_carName" for="x_carName" class="<?php echo $inb_used_cars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_used_cars_enquiry->carName->FldCaption() ?></label>
		<div class="<?php echo $inb_used_cars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_used_cars_enquiry->carName->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_carName">
<input type="text" data-table="inb_used_cars_enquiry" data-field="x_carName" data-page="2" name="x_carName" id="x_carName" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_used_cars_enquiry->carName->getPlaceHolder()) ?>" value="<?php echo $inb_used_cars_enquiry->carName->EditValue ?>"<?php echo $inb_used_cars_enquiry->carName->EditAttributes() ?>>
</span>
<?php echo $inb_used_cars_enquiry->carName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_used_cars_enquiry->price->Visible) { // price ?>
	<div id="r_price" class="form-group">
		<label id="elh_inb_used_cars_enquiry_price" for="x_price" class="<?php echo $inb_used_cars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_used_cars_enquiry->price->FldCaption() ?></label>
		<div class="<?php echo $inb_used_cars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_used_cars_enquiry->price->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_price">
<input type="text" data-table="inb_used_cars_enquiry" data-field="x_price" data-page="2" name="x_price" id="x_price" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_used_cars_enquiry->price->getPlaceHolder()) ?>" value="<?php echo $inb_used_cars_enquiry->price->EditValue ?>"<?php echo $inb_used_cars_enquiry->price->EditAttributes() ?>>
</span>
<?php echo $inb_used_cars_enquiry->price->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_used_cars_enquiry->kilometer->Visible) { // kilometer ?>
	<div id="r_kilometer" class="form-group">
		<label id="elh_inb_used_cars_enquiry_kilometer" for="x_kilometer" class="<?php echo $inb_used_cars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_used_cars_enquiry->kilometer->FldCaption() ?></label>
		<div class="<?php echo $inb_used_cars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_used_cars_enquiry->kilometer->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_kilometer">
<input type="text" data-table="inb_used_cars_enquiry" data-field="x_kilometer" data-page="2" name="x_kilometer" id="x_kilometer" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_used_cars_enquiry->kilometer->getPlaceHolder()) ?>" value="<?php echo $inb_used_cars_enquiry->kilometer->EditValue ?>"<?php echo $inb_used_cars_enquiry->kilometer->EditAttributes() ?>>
</span>
<?php echo $inb_used_cars_enquiry->kilometer->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_used_cars_enquiry->regionalSpec->Visible) { // regionalSpec ?>
	<div id="r_regionalSpec" class="form-group">
		<label id="elh_inb_used_cars_enquiry_regionalSpec" for="x_regionalSpec" class="<?php echo $inb_used_cars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_used_cars_enquiry->regionalSpec->FldCaption() ?></label>
		<div class="<?php echo $inb_used_cars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_used_cars_enquiry->regionalSpec->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_regionalSpec">
<input type="text" data-table="inb_used_cars_enquiry" data-field="x_regionalSpec" data-page="2" name="x_regionalSpec" id="x_regionalSpec" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_used_cars_enquiry->regionalSpec->getPlaceHolder()) ?>" value="<?php echo $inb_used_cars_enquiry->regionalSpec->EditValue ?>"<?php echo $inb_used_cars_enquiry->regionalSpec->EditAttributes() ?>>
</span>
<?php echo $inb_used_cars_enquiry->regionalSpec->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_used_cars_enquiry->transmission->Visible) { // transmission ?>
	<div id="r_transmission" class="form-group">
		<label id="elh_inb_used_cars_enquiry_transmission" for="x_transmission" class="<?php echo $inb_used_cars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_used_cars_enquiry->transmission->FldCaption() ?></label>
		<div class="<?php echo $inb_used_cars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_used_cars_enquiry->transmission->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_transmission">
<input type="text" data-table="inb_used_cars_enquiry" data-field="x_transmission" data-page="2" name="x_transmission" id="x_transmission" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_used_cars_enquiry->transmission->getPlaceHolder()) ?>" value="<?php echo $inb_used_cars_enquiry->transmission->EditValue ?>"<?php echo $inb_used_cars_enquiry->transmission->EditAttributes() ?>>
</span>
<?php echo $inb_used_cars_enquiry->transmission->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inb_used_cars_enquiry->fuel->Visible) { // fuel ?>
	<div id="r_fuel" class="form-group">
		<label id="elh_inb_used_cars_enquiry_fuel" for="x_fuel" class="<?php echo $inb_used_cars_enquiry_edit->LeftColumnClass ?>"><?php echo $inb_used_cars_enquiry->fuel->FldCaption() ?></label>
		<div class="<?php echo $inb_used_cars_enquiry_edit->RightColumnClass ?>"><div<?php echo $inb_used_cars_enquiry->fuel->CellAttributes() ?>>
<span id="el_inb_used_cars_enquiry_fuel">
<input type="text" data-table="inb_used_cars_enquiry" data-field="x_fuel" data-page="2" name="x_fuel" id="x_fuel" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($inb_used_cars_enquiry->fuel->getPlaceHolder()) ?>" value="<?php echo $inb_used_cars_enquiry->fuel->EditValue ?>"<?php echo $inb_used_cars_enquiry->fuel->EditAttributes() ?>>
</span>
<?php echo $inb_used_cars_enquiry->fuel->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page .nav-tabs-custom .tab-content -->
</div><!-- /multi-page .nav-tabs-custom -->
</div><!-- /multi-page -->
<?php if (!$inb_used_cars_enquiry_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $inb_used_cars_enquiry_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $inb_used_cars_enquiry_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
finb_used_cars_enquiryedit.Init();
</script>
<?php
$inb_used_cars_enquiry_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$inb_used_cars_enquiry_edit->Page_Terminate();
?>
