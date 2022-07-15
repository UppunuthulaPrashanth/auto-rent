<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "cms_usersinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$default = NULL; // Initialize page object first

class cdefault {

	// Page ID
	var $PageID = 'default';

	// Project ID
	var $ProjectID = '{F745D41A-D8C3-4E57-B065-3A7F49376673}';

	// Page object name
	var $PageObjName = 'default';

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
		return "";
	}

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
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

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'default', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"]))
			$GLOBALS["gTimer"] = new cTimer();

		// Debug message
		ew_LoadDebugMsg();

		// Open connection
		if (!isset($conn))
			$conn = ew_Connect();

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

		// NOTE: Security object may be needed in other part of the script, skip set to Nothing
		// 
		// Security = null;
		// 
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

	//
	// Page main
	//
	function Page_Main() {
		global $Security, $Language, $Breadcrumb;
		$Breadcrumb = new cBreadcrumb();

		// If session expired, show session expired message
		if (@$_GET["expired"] == "1")
			$this->setFailureMessage($Language->Phrase("SessionExpired"));
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->AllowList(CurrentProjectID() . 'cms_users'))
		$this->Page_Terminate("cms_userslist.php"); // Exit and go to default page
		if ($Security->AllowList(CurrentProjectID() . 'mtr_city'))
			$this->Page_Terminate("mtr_citylist.php");
		if ($Security->AllowList(CurrentProjectID() . 'mtr_country'))
			$this->Page_Terminate("mtr_countrylist.php");
		if ($Security->AllowList(CurrentProjectID() . 'notification_options'))
			$this->Page_Terminate("notification_optionslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'notification_recipients'))
			$this->Page_Terminate("notification_recipientslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'smtp_details'))
			$this->Page_Terminate("smtp_detailslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'socials'))
			$this->Page_Terminate("socialslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'about_stats'))
			$this->Page_Terminate("about_statslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'about_us'))
			$this->Page_Terminate("about_uslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'home_stats'))
			$this->Page_Terminate("home_statslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'inb_subscribe'))
			$this->Page_Terminate("inb_subscribelist.php");
		if ($Security->AllowList(CurrentProjectID() . 'news'))
			$this->Page_Terminate("newslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'pages_static'))
			$this->Page_Terminate("pages_staticlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'sliders'))
			$this->Page_Terminate("sliderslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'branches'))
			$this->Page_Terminate("brancheslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'faqs'))
			$this->Page_Terminate("faqslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'home_apps'))
			$this->Page_Terminate("home_appslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'inb_contactus'))
			$this->Page_Terminate("inb_contactuslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'mtr_locations'))
			$this->Page_Terminate("mtr_locationslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'promotions'))
			$this->Page_Terminate("promotionslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'region'))
			$this->Page_Terminate("regionlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'inb_enquiry'))
			$this->Page_Terminate("inb_enquirylist.php");
		if ($Security->AllowList(CurrentProjectID() . 'mtr_service_type'))
			$this->Page_Terminate("mtr_service_typelist.php");
		if ($Security->AllowList(CurrentProjectID() . 'services'))
			$this->Page_Terminate("serviceslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'book_rent_vehicles'))
			$this->Page_Terminate("book_rent_vehicleslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'contact_map'))
			$this->Page_Terminate("contact_maplist.php");
		if ($Security->AllowList(CurrentProjectID() . 'inb_used_cars_enquiry'))
			$this->Page_Terminate("inb_used_cars_enquirylist.php");
		if ($Security->AllowList(CurrentProjectID() . 'meta_datas'))
			$this->Page_Terminate("meta_dataslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'mtr_body_condition'))
			$this->Page_Terminate("mtr_body_conditionlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'mtr_bodytype'))
			$this->Page_Terminate("mtr_bodytypelist.php");
		if ($Security->AllowList(CurrentProjectID() . 'mtr_color'))
			$this->Page_Terminate("mtr_colorlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'mtr_cylinder'))
			$this->Page_Terminate("mtr_cylinderlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'mtr_extra_features'))
			$this->Page_Terminate("mtr_extra_featureslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'mtr_fuel_type'))
			$this->Page_Terminate("mtr_fuel_typelist.php");
		if ($Security->AllowList(CurrentProjectID() . 'mtr_make'))
			$this->Page_Terminate("mtr_makelist.php");
		if ($Security->AllowList(CurrentProjectID() . 'mtr_model'))
			$this->Page_Terminate("mtr_modellist.php");
		if ($Security->AllowList(CurrentProjectID() . 'mtr_nationality'))
			$this->Page_Terminate("mtr_nationalitylist.php");
		if ($Security->AllowList(CurrentProjectID() . 'mtr_regional_spec'))
			$this->Page_Terminate("mtr_regional_speclist.php");
		if ($Security->AllowList(CurrentProjectID() . 'mtr_transmission'))
			$this->Page_Terminate("mtr_transmissionlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'mtr_warranty'))
			$this->Page_Terminate("mtr_warrantylist.php");
		if ($Security->AllowList(CurrentProjectID() . 'mtr_year'))
			$this->Page_Terminate("mtr_yearlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'pickup_drop_locations'))
			$this->Page_Terminate("pickup_drop_locationslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'rent_lease_cars'))
			$this->Page_Terminate("rent_lease_carslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'users'))
			$this->Page_Terminate("userslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'inb_reportbreakdown'))
			$this->Page_Terminate("inb_reportbreakdownlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'inb_bookings'))
			$this->Page_Terminate("inb_bookingslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'inb_lease_cars'))
			$this->Page_Terminate("inb_lease_carslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'corporate_leasing'))
			$this->Page_Terminate("corporate_leasinglist.php");
		if ($Security->AllowList(CurrentProjectID() . 'corporate_sidebar'))
			$this->Page_Terminate("corporate_sidebarlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'corporate_solutions'))
			$this->Page_Terminate("corporate_solutionslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'inb_corporate_leasing'))
			$this->Page_Terminate("inb_corporate_leasinglist.php");
		if ($Security->AllowList(CurrentProjectID() . 'inb_corporate_solutions'))
			$this->Page_Terminate("inb_corporate_solutionslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'inb_feedbacks'))
			$this->Page_Terminate("inb_feedbackslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'inb_leasecars_enquiry'))
			$this->Page_Terminate("inb_leasecars_enquirylist.php");
		if ($Security->AllowList(CurrentProjectID() . 'inb_new_vehicle_enquiry'))
			$this->Page_Terminate("inb_new_vehicle_enquirylist.php");
		if ($Security->AllowList(CurrentProjectID() . 'lease_cars'))
			$this->Page_Terminate("lease_carslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'pay_as_you_drive'))
			$this->Page_Terminate("pay_as_you_drivelist.php");
		if ($Security->AllowList(CurrentProjectID() . 'rental_guide'))
			$this->Page_Terminate("rental_guidelist.php");
		if ($Security->AllowList(CurrentProjectID() . 'inb_bookings_pay_as_you_drive'))
			$this->Page_Terminate("inb_bookings_pay_as_you_drivelist.php");
		if ($Security->AllowList(CurrentProjectID() . 'others'))
			$this->Page_Terminate("otherslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'car_hire'))
			$this->Page_Terminate("car_hirelist.php");
		if ($Security->AllowList(CurrentProjectID() . 'pg_transactions'))
			$this->Page_Terminate("pg_transactionslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'terms_conditions'))
			$this->Page_Terminate("terms_conditionslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'car_listing_blog'))
			$this->Page_Terminate("car_listing_bloglist.php");
		if ($Security->AllowList(CurrentProjectID() . 'home_document_required'))
			$this->Page_Terminate("home_document_requiredlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'inb_payasyoudrive_enquiry'))
			$this->Page_Terminate("inb_payasyoudrive_enquirylist.php");
		if ($Security->AllowList(CurrentProjectID() . 'inb_rent_cars_enquiry'))
			$this->Page_Terminate("inb_rent_cars_enquirylist.php");
		if ($Security->IsLoggedIn()) {
			$this->setFailureMessage(ew_DeniedMsg() . "<br><br><a href=\"logout.php\">" . $Language->Phrase("BackToLogin") . "</a>");
		} else {
			$this->Page_Terminate("login.php"); // Exit and go to login page
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
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($default)) $default = new cdefault();

// Page init
$default->Page_Init();

// Page main
$default->Page_Main();
?>
<?php include_once "header.php" ?>
<?php
$default->ShowMessage();
?>
<?php include_once "footer.php" ?>
<?php
$default->Page_Terminate();
?>
