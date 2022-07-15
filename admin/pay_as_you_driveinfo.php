<?php

// Global variable for table object
$pay_as_you_drive = NULL;

//
// Table class for pay_as_you_drive
//
class cpay_as_you_drive extends cTable {
	var $payDriveCarID;
	var $bodyTypeID;
	var $carTitle;
	var $slug;
	var $image;
	var $extraFeatures;
	var $noOfSeats;
	var $luggage;
	var $transmissionID;
	var $ac;
	var $noOfDoors;
	var $s1DailyAED;
	var $s1DailyKM;
	var $s2DailyAED;
	var $s2DailyKM;
	var $s3DailyAED;
	var $s3DailyKM;
	var $s4DailyAED;
	var $s4DailyKM;
	var $s5DailyAED;
	var $s5DailyKM;
	var $s1WeeklyAED;
	var $s1WeeklyKM;
	var $s2WeeklyAED;
	var $s2WeeklyKM;
	var $s3WeeklyAED;
	var $s3WeeklyKM;
	var $s4WeeklyAED;
	var $s4WeeklyKM;
	var $s5WeeklyAED;
	var $s5WeeklyKM;
	var $s1MonthlyAED;
	var $s1MonthlyKM;
	var $s2MonthlyAED;
	var $s2MonthlyKM;
	var $s3MonthlyAED;
	var $s3MonthlyKM;
	var $s4MonthlyAED;
	var $s4MonthlyKM;
	var $s5MonthlyAED;
	var $s5MonthlyKM;
	var $scdwDailyAED;
	var $scdwWeeklyAED;
	var $scdwMonthlyAED;
	var $cdwDailyAED;
	var $cdwWeeklyAED;
	var $cdwMonthlyAED;
	var $paiDailyAED;
	var $paiWeeklyAED;
	var $paiMonthlyAED;
	var $gpsDailyAED;
	var $gpsWeeklyAED;
	var $gpsMonthlyAED;
	var $additionalDriverDailyAED;
	var $additionalDriverWeeklyAED;
	var $additionalDriverMonthlyAED;
	var $babySafetySeatDailyAED;
	var $babySafetySeatWeeklyAED;
	var $babySafetySeatMonthlyAED;
	var $addBabySafetySeatDailyAED;
	var $addBabySafetySeatWeeklyAED;
	var $addBabySafetySeatMonthlyAED;
	var $deliveryAED;
	var $active;
	var $phase1OrangeCard;
	var $phase1GPS;
	var $phase1DeliveryCharges;
	var $phase1CollectionCharges;
	var $addon01KM;
	var $addon01Price;
	var $addon02KM;
	var $addon02Price;
	var $addon03KM;
	var $addon03Price;
	var $addon04KM;
	var $addon04Price;
	var $addon05KM;
	var $addon05Price;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'pay_as_you_drive';
		$this->TableName = 'pay_as_you_drive';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`pay_as_you_drive`";
		$this->DBID = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = PHPExcel_Worksheet_PageSetup::ORIENTATION_DEFAULT; // Page orientation (PHPExcel only)
		$this->ExportExcelPageSize = PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4; // Page size (PHPExcel only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new cBasicSearch($this->TableVar);

		// payDriveCarID
		$this->payDriveCarID = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_payDriveCarID', 'payDriveCarID', '`payDriveCarID`', '`payDriveCarID`', 3, -1, FALSE, '`payDriveCarID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->payDriveCarID->Sortable = TRUE; // Allow sort
		$this->payDriveCarID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['payDriveCarID'] = &$this->payDriveCarID;

		// bodyTypeID
		$this->bodyTypeID = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_bodyTypeID', 'bodyTypeID', '`bodyTypeID`', '`bodyTypeID`', 3, -1, FALSE, '`bodyTypeID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->bodyTypeID->Sortable = TRUE; // Allow sort
		$this->bodyTypeID->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->bodyTypeID->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->bodyTypeID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['bodyTypeID'] = &$this->bodyTypeID;

		// carTitle
		$this->carTitle = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_carTitle', 'carTitle', '`carTitle`', '`carTitle`', 200, -1, FALSE, '`carTitle`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->carTitle->Sortable = TRUE; // Allow sort
		$this->fields['carTitle'] = &$this->carTitle;

		// slug
		$this->slug = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_slug', 'slug', '`slug`', '`slug`', 200, -1, FALSE, '`slug`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->slug->Sortable = TRUE; // Allow sort
		$this->fields['slug'] = &$this->slug;

		// image
		$this->image = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_image', 'image', '`image`', '`image`', 200, -1, TRUE, '`image`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->image->Sortable = TRUE; // Allow sort
		$this->fields['image'] = &$this->image;

		// extraFeatures
		$this->extraFeatures = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_extraFeatures', 'extraFeatures', '`extraFeatures`', '`extraFeatures`', 200, -1, FALSE, '`extraFeatures`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->extraFeatures->Sortable = TRUE; // Allow sort
		$this->fields['extraFeatures'] = &$this->extraFeatures;

		// noOfSeats
		$this->noOfSeats = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_noOfSeats', 'noOfSeats', '`noOfSeats`', '`noOfSeats`', 3, -1, FALSE, '`noOfSeats`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->noOfSeats->Sortable = TRUE; // Allow sort
		$this->noOfSeats->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['noOfSeats'] = &$this->noOfSeats;

		// luggage
		$this->luggage = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_luggage', 'luggage', '`luggage`', '`luggage`', 3, -1, FALSE, '`luggage`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->luggage->Sortable = TRUE; // Allow sort
		$this->luggage->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['luggage'] = &$this->luggage;

		// transmissionID
		$this->transmissionID = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_transmissionID', 'transmissionID', '`transmissionID`', '`transmissionID`', 3, -1, FALSE, '`transmissionID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->transmissionID->Sortable = TRUE; // Allow sort
		$this->transmissionID->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->transmissionID->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->transmissionID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['transmissionID'] = &$this->transmissionID;

		// ac
		$this->ac = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_ac', 'ac', '`ac`', '`ac`', 202, -1, FALSE, '`ac`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->ac->Sortable = TRUE; // Allow sort
		$this->ac->FldDataType = EW_DATATYPE_BOOLEAN;
		$this->ac->TrueValue = 'Y';
		$this->ac->FalseValue = 'N';
		$this->ac->OptionCount = 2;
		$this->fields['ac'] = &$this->ac;

		// noOfDoors
		$this->noOfDoors = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_noOfDoors', 'noOfDoors', '`noOfDoors`', '`noOfDoors`', 3, -1, FALSE, '`noOfDoors`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->noOfDoors->Sortable = TRUE; // Allow sort
		$this->noOfDoors->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['noOfDoors'] = &$this->noOfDoors;

		// s1DailyAED
		$this->s1DailyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s1DailyAED', 's1DailyAED', '`s1DailyAED`', '`s1DailyAED`', 131, -1, FALSE, '`s1DailyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s1DailyAED->Sortable = TRUE; // Allow sort
		$this->s1DailyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['s1DailyAED'] = &$this->s1DailyAED;

		// s1DailyKM
		$this->s1DailyKM = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s1DailyKM', 's1DailyKM', '`s1DailyKM`', '`s1DailyKM`', 3, -1, FALSE, '`s1DailyKM`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s1DailyKM->Sortable = TRUE; // Allow sort
		$this->s1DailyKM->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['s1DailyKM'] = &$this->s1DailyKM;

		// s2DailyAED
		$this->s2DailyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s2DailyAED', 's2DailyAED', '`s2DailyAED`', '`s2DailyAED`', 131, -1, FALSE, '`s2DailyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s2DailyAED->Sortable = TRUE; // Allow sort
		$this->s2DailyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['s2DailyAED'] = &$this->s2DailyAED;

		// s2DailyKM
		$this->s2DailyKM = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s2DailyKM', 's2DailyKM', '`s2DailyKM`', '`s2DailyKM`', 3, -1, FALSE, '`s2DailyKM`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s2DailyKM->Sortable = TRUE; // Allow sort
		$this->s2DailyKM->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['s2DailyKM'] = &$this->s2DailyKM;

		// s3DailyAED
		$this->s3DailyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s3DailyAED', 's3DailyAED', '`s3DailyAED`', '`s3DailyAED`', 131, -1, FALSE, '`s3DailyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s3DailyAED->Sortable = TRUE; // Allow sort
		$this->s3DailyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['s3DailyAED'] = &$this->s3DailyAED;

		// s3DailyKM
		$this->s3DailyKM = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s3DailyKM', 's3DailyKM', '`s3DailyKM`', '`s3DailyKM`', 3, -1, FALSE, '`s3DailyKM`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s3DailyKM->Sortable = TRUE; // Allow sort
		$this->s3DailyKM->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['s3DailyKM'] = &$this->s3DailyKM;

		// s4DailyAED
		$this->s4DailyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s4DailyAED', 's4DailyAED', '`s4DailyAED`', '`s4DailyAED`', 131, -1, FALSE, '`s4DailyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s4DailyAED->Sortable = TRUE; // Allow sort
		$this->s4DailyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['s4DailyAED'] = &$this->s4DailyAED;

		// s4DailyKM
		$this->s4DailyKM = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s4DailyKM', 's4DailyKM', '`s4DailyKM`', '`s4DailyKM`', 3, -1, FALSE, '`s4DailyKM`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s4DailyKM->Sortable = TRUE; // Allow sort
		$this->s4DailyKM->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['s4DailyKM'] = &$this->s4DailyKM;

		// s5DailyAED
		$this->s5DailyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s5DailyAED', 's5DailyAED', '`s5DailyAED`', '`s5DailyAED`', 131, -1, FALSE, '`s5DailyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s5DailyAED->Sortable = TRUE; // Allow sort
		$this->s5DailyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['s5DailyAED'] = &$this->s5DailyAED;

		// s5DailyKM
		$this->s5DailyKM = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s5DailyKM', 's5DailyKM', '`s5DailyKM`', '`s5DailyKM`', 3, -1, FALSE, '`s5DailyKM`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s5DailyKM->Sortable = TRUE; // Allow sort
		$this->s5DailyKM->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['s5DailyKM'] = &$this->s5DailyKM;

		// s1WeeklyAED
		$this->s1WeeklyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s1WeeklyAED', 's1WeeklyAED', '`s1WeeklyAED`', '`s1WeeklyAED`', 131, -1, FALSE, '`s1WeeklyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s1WeeklyAED->Sortable = TRUE; // Allow sort
		$this->s1WeeklyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['s1WeeklyAED'] = &$this->s1WeeklyAED;

		// s1WeeklyKM
		$this->s1WeeklyKM = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s1WeeklyKM', 's1WeeklyKM', '`s1WeeklyKM`', '`s1WeeklyKM`', 3, -1, FALSE, '`s1WeeklyKM`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s1WeeklyKM->Sortable = TRUE; // Allow sort
		$this->s1WeeklyKM->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['s1WeeklyKM'] = &$this->s1WeeklyKM;

		// s2WeeklyAED
		$this->s2WeeklyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s2WeeklyAED', 's2WeeklyAED', '`s2WeeklyAED`', '`s2WeeklyAED`', 131, -1, FALSE, '`s2WeeklyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s2WeeklyAED->Sortable = TRUE; // Allow sort
		$this->s2WeeklyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['s2WeeklyAED'] = &$this->s2WeeklyAED;

		// s2WeeklyKM
		$this->s2WeeklyKM = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s2WeeklyKM', 's2WeeklyKM', '`s2WeeklyKM`', '`s2WeeklyKM`', 3, -1, FALSE, '`s2WeeklyKM`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s2WeeklyKM->Sortable = TRUE; // Allow sort
		$this->s2WeeklyKM->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['s2WeeklyKM'] = &$this->s2WeeklyKM;

		// s3WeeklyAED
		$this->s3WeeklyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s3WeeklyAED', 's3WeeklyAED', '`s3WeeklyAED`', '`s3WeeklyAED`', 131, -1, FALSE, '`s3WeeklyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s3WeeklyAED->Sortable = TRUE; // Allow sort
		$this->s3WeeklyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['s3WeeklyAED'] = &$this->s3WeeklyAED;

		// s3WeeklyKM
		$this->s3WeeklyKM = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s3WeeklyKM', 's3WeeklyKM', '`s3WeeklyKM`', '`s3WeeklyKM`', 3, -1, FALSE, '`s3WeeklyKM`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s3WeeklyKM->Sortable = TRUE; // Allow sort
		$this->s3WeeklyKM->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['s3WeeklyKM'] = &$this->s3WeeklyKM;

		// s4WeeklyAED
		$this->s4WeeklyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s4WeeklyAED', 's4WeeklyAED', '`s4WeeklyAED`', '`s4WeeklyAED`', 131, -1, FALSE, '`s4WeeklyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s4WeeklyAED->Sortable = TRUE; // Allow sort
		$this->s4WeeklyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['s4WeeklyAED'] = &$this->s4WeeklyAED;

		// s4WeeklyKM
		$this->s4WeeklyKM = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s4WeeklyKM', 's4WeeklyKM', '`s4WeeklyKM`', '`s4WeeklyKM`', 3, -1, FALSE, '`s4WeeklyKM`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s4WeeklyKM->Sortable = TRUE; // Allow sort
		$this->s4WeeklyKM->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['s4WeeklyKM'] = &$this->s4WeeklyKM;

		// s5WeeklyAED
		$this->s5WeeklyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s5WeeklyAED', 's5WeeklyAED', '`s5WeeklyAED`', '`s5WeeklyAED`', 131, -1, FALSE, '`s5WeeklyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s5WeeklyAED->Sortable = TRUE; // Allow sort
		$this->s5WeeklyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['s5WeeklyAED'] = &$this->s5WeeklyAED;

		// s5WeeklyKM
		$this->s5WeeklyKM = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s5WeeklyKM', 's5WeeklyKM', '`s5WeeklyKM`', '`s5WeeklyKM`', 3, -1, FALSE, '`s5WeeklyKM`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s5WeeklyKM->Sortable = TRUE; // Allow sort
		$this->s5WeeklyKM->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['s5WeeklyKM'] = &$this->s5WeeklyKM;

		// s1MonthlyAED
		$this->s1MonthlyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s1MonthlyAED', 's1MonthlyAED', '`s1MonthlyAED`', '`s1MonthlyAED`', 131, -1, FALSE, '`s1MonthlyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s1MonthlyAED->Sortable = TRUE; // Allow sort
		$this->s1MonthlyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['s1MonthlyAED'] = &$this->s1MonthlyAED;

		// s1MonthlyKM
		$this->s1MonthlyKM = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s1MonthlyKM', 's1MonthlyKM', '`s1MonthlyKM`', '`s1MonthlyKM`', 3, -1, FALSE, '`s1MonthlyKM`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s1MonthlyKM->Sortable = TRUE; // Allow sort
		$this->s1MonthlyKM->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['s1MonthlyKM'] = &$this->s1MonthlyKM;

		// s2MonthlyAED
		$this->s2MonthlyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s2MonthlyAED', 's2MonthlyAED', '`s2MonthlyAED`', '`s2MonthlyAED`', 131, -1, FALSE, '`s2MonthlyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s2MonthlyAED->Sortable = TRUE; // Allow sort
		$this->s2MonthlyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['s2MonthlyAED'] = &$this->s2MonthlyAED;

		// s2MonthlyKM
		$this->s2MonthlyKM = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s2MonthlyKM', 's2MonthlyKM', '`s2MonthlyKM`', '`s2MonthlyKM`', 3, -1, FALSE, '`s2MonthlyKM`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s2MonthlyKM->Sortable = TRUE; // Allow sort
		$this->s2MonthlyKM->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['s2MonthlyKM'] = &$this->s2MonthlyKM;

		// s3MonthlyAED
		$this->s3MonthlyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s3MonthlyAED', 's3MonthlyAED', '`s3MonthlyAED`', '`s3MonthlyAED`', 131, -1, FALSE, '`s3MonthlyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s3MonthlyAED->Sortable = TRUE; // Allow sort
		$this->s3MonthlyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['s3MonthlyAED'] = &$this->s3MonthlyAED;

		// s3MonthlyKM
		$this->s3MonthlyKM = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s3MonthlyKM', 's3MonthlyKM', '`s3MonthlyKM`', '`s3MonthlyKM`', 3, -1, FALSE, '`s3MonthlyKM`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s3MonthlyKM->Sortable = TRUE; // Allow sort
		$this->s3MonthlyKM->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['s3MonthlyKM'] = &$this->s3MonthlyKM;

		// s4MonthlyAED
		$this->s4MonthlyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s4MonthlyAED', 's4MonthlyAED', '`s4MonthlyAED`', '`s4MonthlyAED`', 131, -1, FALSE, '`s4MonthlyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s4MonthlyAED->Sortable = TRUE; // Allow sort
		$this->s4MonthlyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['s4MonthlyAED'] = &$this->s4MonthlyAED;

		// s4MonthlyKM
		$this->s4MonthlyKM = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s4MonthlyKM', 's4MonthlyKM', '`s4MonthlyKM`', '`s4MonthlyKM`', 3, -1, FALSE, '`s4MonthlyKM`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s4MonthlyKM->Sortable = TRUE; // Allow sort
		$this->s4MonthlyKM->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['s4MonthlyKM'] = &$this->s4MonthlyKM;

		// s5MonthlyAED
		$this->s5MonthlyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s5MonthlyAED', 's5MonthlyAED', '`s5MonthlyAED`', '`s5MonthlyAED`', 131, -1, FALSE, '`s5MonthlyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s5MonthlyAED->Sortable = TRUE; // Allow sort
		$this->s5MonthlyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['s5MonthlyAED'] = &$this->s5MonthlyAED;

		// s5MonthlyKM
		$this->s5MonthlyKM = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_s5MonthlyKM', 's5MonthlyKM', '`s5MonthlyKM`', '`s5MonthlyKM`', 3, -1, FALSE, '`s5MonthlyKM`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->s5MonthlyKM->Sortable = TRUE; // Allow sort
		$this->s5MonthlyKM->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['s5MonthlyKM'] = &$this->s5MonthlyKM;

		// scdwDailyAED
		$this->scdwDailyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_scdwDailyAED', 'scdwDailyAED', '`scdwDailyAED`', '`scdwDailyAED`', 131, -1, FALSE, '`scdwDailyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->scdwDailyAED->Sortable = FALSE; // Allow sort
		$this->scdwDailyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['scdwDailyAED'] = &$this->scdwDailyAED;

		// scdwWeeklyAED
		$this->scdwWeeklyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_scdwWeeklyAED', 'scdwWeeklyAED', '`scdwWeeklyAED`', '`scdwWeeklyAED`', 131, -1, FALSE, '`scdwWeeklyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->scdwWeeklyAED->Sortable = FALSE; // Allow sort
		$this->scdwWeeklyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['scdwWeeklyAED'] = &$this->scdwWeeklyAED;

		// scdwMonthlyAED
		$this->scdwMonthlyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_scdwMonthlyAED', 'scdwMonthlyAED', '`scdwMonthlyAED`', '`scdwMonthlyAED`', 131, -1, FALSE, '`scdwMonthlyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->scdwMonthlyAED->Sortable = FALSE; // Allow sort
		$this->scdwMonthlyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['scdwMonthlyAED'] = &$this->scdwMonthlyAED;

		// cdwDailyAED
		$this->cdwDailyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_cdwDailyAED', 'cdwDailyAED', '`cdwDailyAED`', '`cdwDailyAED`', 131, -1, FALSE, '`cdwDailyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cdwDailyAED->Sortable = FALSE; // Allow sort
		$this->cdwDailyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['cdwDailyAED'] = &$this->cdwDailyAED;

		// cdwWeeklyAED
		$this->cdwWeeklyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_cdwWeeklyAED', 'cdwWeeklyAED', '`cdwWeeklyAED`', '`cdwWeeklyAED`', 131, -1, FALSE, '`cdwWeeklyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cdwWeeklyAED->Sortable = FALSE; // Allow sort
		$this->cdwWeeklyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['cdwWeeklyAED'] = &$this->cdwWeeklyAED;

		// cdwMonthlyAED
		$this->cdwMonthlyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_cdwMonthlyAED', 'cdwMonthlyAED', '`cdwMonthlyAED`', '`cdwMonthlyAED`', 131, -1, FALSE, '`cdwMonthlyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cdwMonthlyAED->Sortable = FALSE; // Allow sort
		$this->cdwMonthlyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['cdwMonthlyAED'] = &$this->cdwMonthlyAED;

		// paiDailyAED
		$this->paiDailyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_paiDailyAED', 'paiDailyAED', '`paiDailyAED`', '`paiDailyAED`', 131, -1, FALSE, '`paiDailyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->paiDailyAED->Sortable = FALSE; // Allow sort
		$this->paiDailyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['paiDailyAED'] = &$this->paiDailyAED;

		// paiWeeklyAED
		$this->paiWeeklyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_paiWeeklyAED', 'paiWeeklyAED', '`paiWeeklyAED`', '`paiWeeklyAED`', 131, -1, FALSE, '`paiWeeklyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->paiWeeklyAED->Sortable = FALSE; // Allow sort
		$this->paiWeeklyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['paiWeeklyAED'] = &$this->paiWeeklyAED;

		// paiMonthlyAED
		$this->paiMonthlyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_paiMonthlyAED', 'paiMonthlyAED', '`paiMonthlyAED`', '`paiMonthlyAED`', 131, -1, FALSE, '`paiMonthlyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->paiMonthlyAED->Sortable = FALSE; // Allow sort
		$this->paiMonthlyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['paiMonthlyAED'] = &$this->paiMonthlyAED;

		// gpsDailyAED
		$this->gpsDailyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_gpsDailyAED', 'gpsDailyAED', '`gpsDailyAED`', '`gpsDailyAED`', 131, -1, FALSE, '`gpsDailyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->gpsDailyAED->Sortable = FALSE; // Allow sort
		$this->gpsDailyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['gpsDailyAED'] = &$this->gpsDailyAED;

		// gpsWeeklyAED
		$this->gpsWeeklyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_gpsWeeklyAED', 'gpsWeeklyAED', '`gpsWeeklyAED`', '`gpsWeeklyAED`', 131, -1, FALSE, '`gpsWeeklyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->gpsWeeklyAED->Sortable = FALSE; // Allow sort
		$this->gpsWeeklyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['gpsWeeklyAED'] = &$this->gpsWeeklyAED;

		// gpsMonthlyAED
		$this->gpsMonthlyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_gpsMonthlyAED', 'gpsMonthlyAED', '`gpsMonthlyAED`', '`gpsMonthlyAED`', 131, -1, FALSE, '`gpsMonthlyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->gpsMonthlyAED->Sortable = FALSE; // Allow sort
		$this->gpsMonthlyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['gpsMonthlyAED'] = &$this->gpsMonthlyAED;

		// additionalDriverDailyAED
		$this->additionalDriverDailyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_additionalDriverDailyAED', 'additionalDriverDailyAED', '`additionalDriverDailyAED`', '`additionalDriverDailyAED`', 131, -1, FALSE, '`additionalDriverDailyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->additionalDriverDailyAED->Sortable = FALSE; // Allow sort
		$this->additionalDriverDailyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['additionalDriverDailyAED'] = &$this->additionalDriverDailyAED;

		// additionalDriverWeeklyAED
		$this->additionalDriverWeeklyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_additionalDriverWeeklyAED', 'additionalDriverWeeklyAED', '`additionalDriverWeeklyAED`', '`additionalDriverWeeklyAED`', 131, -1, FALSE, '`additionalDriverWeeklyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->additionalDriverWeeklyAED->Sortable = FALSE; // Allow sort
		$this->additionalDriverWeeklyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['additionalDriverWeeklyAED'] = &$this->additionalDriverWeeklyAED;

		// additionalDriverMonthlyAED
		$this->additionalDriverMonthlyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_additionalDriverMonthlyAED', 'additionalDriverMonthlyAED', '`additionalDriverMonthlyAED`', '`additionalDriverMonthlyAED`', 131, -1, FALSE, '`additionalDriverMonthlyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->additionalDriverMonthlyAED->Sortable = FALSE; // Allow sort
		$this->additionalDriverMonthlyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['additionalDriverMonthlyAED'] = &$this->additionalDriverMonthlyAED;

		// babySafetySeatDailyAED
		$this->babySafetySeatDailyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_babySafetySeatDailyAED', 'babySafetySeatDailyAED', '`babySafetySeatDailyAED`', '`babySafetySeatDailyAED`', 131, -1, FALSE, '`babySafetySeatDailyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->babySafetySeatDailyAED->Sortable = FALSE; // Allow sort
		$this->babySafetySeatDailyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['babySafetySeatDailyAED'] = &$this->babySafetySeatDailyAED;

		// babySafetySeatWeeklyAED
		$this->babySafetySeatWeeklyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_babySafetySeatWeeklyAED', 'babySafetySeatWeeklyAED', '`babySafetySeatWeeklyAED`', '`babySafetySeatWeeklyAED`', 131, -1, FALSE, '`babySafetySeatWeeklyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->babySafetySeatWeeklyAED->Sortable = FALSE; // Allow sort
		$this->babySafetySeatWeeklyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['babySafetySeatWeeklyAED'] = &$this->babySafetySeatWeeklyAED;

		// babySafetySeatMonthlyAED
		$this->babySafetySeatMonthlyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_babySafetySeatMonthlyAED', 'babySafetySeatMonthlyAED', '`babySafetySeatMonthlyAED`', '`babySafetySeatMonthlyAED`', 131, -1, FALSE, '`babySafetySeatMonthlyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->babySafetySeatMonthlyAED->Sortable = FALSE; // Allow sort
		$this->babySafetySeatMonthlyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['babySafetySeatMonthlyAED'] = &$this->babySafetySeatMonthlyAED;

		// addBabySafetySeatDailyAED
		$this->addBabySafetySeatDailyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_addBabySafetySeatDailyAED', 'addBabySafetySeatDailyAED', '`addBabySafetySeatDailyAED`', '`addBabySafetySeatDailyAED`', 131, -1, FALSE, '`addBabySafetySeatDailyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->addBabySafetySeatDailyAED->Sortable = FALSE; // Allow sort
		$this->addBabySafetySeatDailyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['addBabySafetySeatDailyAED'] = &$this->addBabySafetySeatDailyAED;

		// addBabySafetySeatWeeklyAED
		$this->addBabySafetySeatWeeklyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_addBabySafetySeatWeeklyAED', 'addBabySafetySeatWeeklyAED', '`addBabySafetySeatWeeklyAED`', '`addBabySafetySeatWeeklyAED`', 131, -1, FALSE, '`addBabySafetySeatWeeklyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->addBabySafetySeatWeeklyAED->Sortable = FALSE; // Allow sort
		$this->addBabySafetySeatWeeklyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['addBabySafetySeatWeeklyAED'] = &$this->addBabySafetySeatWeeklyAED;

		// addBabySafetySeatMonthlyAED
		$this->addBabySafetySeatMonthlyAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_addBabySafetySeatMonthlyAED', 'addBabySafetySeatMonthlyAED', '`addBabySafetySeatMonthlyAED`', '`addBabySafetySeatMonthlyAED`', 131, -1, FALSE, '`addBabySafetySeatMonthlyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->addBabySafetySeatMonthlyAED->Sortable = FALSE; // Allow sort
		$this->addBabySafetySeatMonthlyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['addBabySafetySeatMonthlyAED'] = &$this->addBabySafetySeatMonthlyAED;

		// deliveryAED
		$this->deliveryAED = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_deliveryAED', 'deliveryAED', '`deliveryAED`', '`deliveryAED`', 131, -1, FALSE, '`deliveryAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->deliveryAED->Sortable = FALSE; // Allow sort
		$this->deliveryAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['deliveryAED'] = &$this->deliveryAED;

		// active
		$this->active = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_active', 'active', '`active`', '`active`', 16, -1, FALSE, '`active`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->active->Sortable = TRUE; // Allow sort
		$this->active->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->active->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->active->OptionCount = 2;
		$this->active->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['active'] = &$this->active;

		// phase1OrangeCard
		$this->phase1OrangeCard = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_phase1OrangeCard', 'phase1OrangeCard', '`phase1OrangeCard`', '`phase1OrangeCard`', 131, -1, FALSE, '`phase1OrangeCard`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->phase1OrangeCard->Sortable = TRUE; // Allow sort
		$this->phase1OrangeCard->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['phase1OrangeCard'] = &$this->phase1OrangeCard;

		// phase1GPS
		$this->phase1GPS = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_phase1GPS', 'phase1GPS', '`phase1GPS`', '`phase1GPS`', 131, -1, FALSE, '`phase1GPS`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->phase1GPS->Sortable = TRUE; // Allow sort
		$this->phase1GPS->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['phase1GPS'] = &$this->phase1GPS;

		// phase1DeliveryCharges
		$this->phase1DeliveryCharges = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_phase1DeliveryCharges', 'phase1DeliveryCharges', '`phase1DeliveryCharges`', '`phase1DeliveryCharges`', 131, -1, FALSE, '`phase1DeliveryCharges`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->phase1DeliveryCharges->Sortable = TRUE; // Allow sort
		$this->phase1DeliveryCharges->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['phase1DeliveryCharges'] = &$this->phase1DeliveryCharges;

		// phase1CollectionCharges
		$this->phase1CollectionCharges = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_phase1CollectionCharges', 'phase1CollectionCharges', '`phase1CollectionCharges`', '`phase1CollectionCharges`', 131, -1, FALSE, '`phase1CollectionCharges`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->phase1CollectionCharges->Sortable = TRUE; // Allow sort
		$this->phase1CollectionCharges->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['phase1CollectionCharges'] = &$this->phase1CollectionCharges;

		// addon01KM
		$this->addon01KM = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_addon01KM', 'addon01KM', '`addon01KM`', '`addon01KM`', 131, -1, FALSE, '`addon01KM`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->addon01KM->Sortable = TRUE; // Allow sort
		$this->addon01KM->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['addon01KM'] = &$this->addon01KM;

		// addon01Price
		$this->addon01Price = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_addon01Price', 'addon01Price', '`addon01Price`', '`addon01Price`', 131, -1, FALSE, '`addon01Price`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->addon01Price->Sortable = TRUE; // Allow sort
		$this->addon01Price->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['addon01Price'] = &$this->addon01Price;

		// addon02KM
		$this->addon02KM = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_addon02KM', 'addon02KM', '`addon02KM`', '`addon02KM`', 131, -1, FALSE, '`addon02KM`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->addon02KM->Sortable = TRUE; // Allow sort
		$this->addon02KM->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['addon02KM'] = &$this->addon02KM;

		// addon02Price
		$this->addon02Price = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_addon02Price', 'addon02Price', '`addon02Price`', '`addon02Price`', 131, -1, FALSE, '`addon02Price`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->addon02Price->Sortable = TRUE; // Allow sort
		$this->addon02Price->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['addon02Price'] = &$this->addon02Price;

		// addon03KM
		$this->addon03KM = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_addon03KM', 'addon03KM', '`addon03KM`', '`addon03KM`', 131, -1, FALSE, '`addon03KM`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->addon03KM->Sortable = TRUE; // Allow sort
		$this->addon03KM->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['addon03KM'] = &$this->addon03KM;

		// addon03Price
		$this->addon03Price = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_addon03Price', 'addon03Price', '`addon03Price`', '`addon03Price`', 131, -1, FALSE, '`addon03Price`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->addon03Price->Sortable = TRUE; // Allow sort
		$this->addon03Price->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['addon03Price'] = &$this->addon03Price;

		// addon04KM
		$this->addon04KM = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_addon04KM', 'addon04KM', '`addon04KM`', '`addon04KM`', 131, -1, FALSE, '`addon04KM`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->addon04KM->Sortable = TRUE; // Allow sort
		$this->addon04KM->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['addon04KM'] = &$this->addon04KM;

		// addon04Price
		$this->addon04Price = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_addon04Price', 'addon04Price', '`addon04Price`', '`addon04Price`', 131, -1, FALSE, '`addon04Price`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->addon04Price->Sortable = TRUE; // Allow sort
		$this->addon04Price->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['addon04Price'] = &$this->addon04Price;

		// addon05KM
		$this->addon05KM = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_addon05KM', 'addon05KM', '`addon05KM`', '`addon05KM`', 131, -1, FALSE, '`addon05KM`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->addon05KM->Sortable = TRUE; // Allow sort
		$this->addon05KM->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['addon05KM'] = &$this->addon05KM;

		// addon05Price
		$this->addon05Price = new cField('pay_as_you_drive', 'pay_as_you_drive', 'x_addon05Price', 'addon05Price', '`addon05Price`', '`addon05Price`', 131, -1, FALSE, '`addon05Price`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->addon05Price->Sortable = TRUE; // Allow sort
		$this->addon05Price->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['addon05Price'] = &$this->addon05Price;
	}

	// Set Field Visibility
	function SetFieldVisibility($fldparm) {
		global $Security;
		return $this->$fldparm->Visible; // Returns original value
	}

	// Column CSS classes
	var $LeftColumnClass = "col-sm-2 control-label ewLabel";
	var $RightColumnClass = "col-sm-10";
	var $OffsetColumnClass = "col-sm-10 col-sm-offset-2";

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function SetLeftColumnClass($class) {
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " control-label ewLabel";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - intval($match[2]));
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace($match[1], $match[1] + "-offset", $class);
		}
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`pay_as_you_drive`";
	}

	function SqlFrom() { // For backward compatibility
		return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
		$this->_SqlFrom = $v;
	}
	var $_SqlSelect = "";

	function getSqlSelect() { // Select
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}

	function SqlSelect() { // For backward compatibility
		return $this->getSqlSelect();
	}

	function setSqlSelect($v) {
		$this->_SqlSelect = $v;
	}
	var $_SqlWhere = "";

	function getSqlWhere() { // Where
		$sWhere = ($this->_SqlWhere <> "") ? $this->_SqlWhere : "";
		$this->TableFilter = "";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
	}

	function SqlWhere() { // For backward compatibility
		return $this->getSqlWhere();
	}

	function setSqlWhere($v) {
		$this->_SqlWhere = $v;
	}
	var $_SqlGroupBy = "";

	function getSqlGroupBy() { // Group By
		return ($this->_SqlGroupBy <> "") ? $this->_SqlGroupBy : "";
	}

	function SqlGroupBy() { // For backward compatibility
		return $this->getSqlGroupBy();
	}

	function setSqlGroupBy($v) {
		$this->_SqlGroupBy = $v;
	}
	var $_SqlHaving = "";

	function getSqlHaving() { // Having
		return ($this->_SqlHaving <> "") ? $this->_SqlHaving : "";
	}

	function SqlHaving() { // For backward compatibility
		return $this->getSqlHaving();
	}

	function setSqlHaving($v) {
		$this->_SqlHaving = $v;
	}
	var $_SqlOrderBy = "";

	function getSqlOrderBy() { // Order By
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "";
	}

	function SqlOrderBy() { // For backward compatibility
		return $this->getSqlOrderBy();
	}

	function setSqlOrderBy($v) {
		$this->_SqlOrderBy = $v;
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Check if User ID security allows view all
	function UserIDAllow($id = "") {
		$allow = EW_USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$filter = $this->CurrentFilter;
		$filter = $this->ApplyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->GetSQL($filter, $sort);
	}

	// Table SQL with List page filter
	var $UseSessionForListSQL = TRUE;

	function ListSQL() {
		$sFilter = $this->UseSessionForListSQL ? $this->getSessionWhere() : "";
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$this->Recordset_Selecting($sFilter);
		$sSelect = $this->getSqlSelect();
		$sSort = $this->UseSessionForListSQL ? $this->getSessionOrderBy() : "";
		return ew_BuildSelectSql($sSelect, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
	}

	// Get ORDER BY clause
	function GetOrderBy() {
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sql) {
		$cnt = -1;
		$pattern = "/^SELECT \* FROM/i";
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') && preg_match($pattern, $sql)) {
			$sql = "SELECT COUNT(*) FROM" . preg_replace($pattern, "", $sql);
		} else {
			$sql = "SELECT COUNT(*) FROM (" . $sql . ") EW_COUNT_TABLE";
		}
		$conn = &$this->Connection();
		if ($rs = $conn->Execute($sql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($filter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sql = ew_BuildSelectSql("SELECT * FROM " . $this->getSqlFrom(), $this->getSqlWhere(), "", "", "", $this->CurrentFilter, "");
		$cnt = $this->TryGetRecordCount($sql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function ListRecordCount() {
		$filter = $this->getSessionWhere();
		ew_AddFilter($filter, $this->CurrentFilter);
		$filter = $this->ApplyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$sql = ew_BuildSelectSql("SELECT * FROM " . $this->getSqlFrom(), $this->getSqlWhere(), "", "", "", $filter, "");
		$cnt = $this->TryGetRecordCount($sql);
		if ($cnt == -1) {
			$conn = &$this->Connection();
			if ($rs = $conn->Execute($sql)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	function Insert(&$rs) {
		$conn = &$this->Connection();
		$bInsert = $conn->Execute($this->InsertSQL($rs));
		if ($bInsert) {

			// Get insert id if necessary
			$this->payDriveCarID->setDbValue($conn->Insert_ID());
			$rs['payDriveCarID'] = $this->payDriveCarID->DbValue;
		}
		return $bInsert;
	}

	// UPDATE statement
	function UpdateSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$sql .= $this->fields[$name]->FldExpression . "=";
			$sql .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		ew_AddFilter($filter, $where);
		if ($filter <> "")	$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	function Update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE) {
		$conn = &$this->Connection();
		$bUpdate = $conn->Execute($this->UpdateSQL($rs, $where, $curfilter));
		return $bUpdate;
	}

	// DELETE statement
	function DeleteSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		if ($rs) {
			if (array_key_exists('payDriveCarID', $rs))
				ew_AddFilter($where, ew_QuotedName('payDriveCarID', $this->DBID) . '=' . ew_QuotedValue($rs['payDriveCarID'], $this->payDriveCarID->FldDataType, $this->DBID));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		ew_AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	function Delete(&$rs, $where = "", $curfilter = TRUE) {
		$bDelete = TRUE;
		$conn = &$this->Connection();
		if ($bDelete)
			$bDelete = $conn->Execute($this->DeleteSQL($rs, $where, $curfilter));
		return $bDelete;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`payDriveCarID` = @payDriveCarID@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->payDriveCarID->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->payDriveCarID->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@payDriveCarID@", ew_AdjustSql($this->payDriveCarID->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "pay_as_you_drivelist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "pay_as_you_driveview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "pay_as_you_driveedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "pay_as_you_driveadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "pay_as_you_drivelist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("pay_as_you_driveview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("pay_as_you_driveview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "pay_as_you_driveadd.php?" . $this->UrlParm($parm);
		else
			$url = "pay_as_you_driveadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("pay_as_you_driveedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("pay_as_you_driveadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("pay_as_you_drivedelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "payDriveCarID:" . ew_VarToJson($this->payDriveCarID->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->payDriveCarID->CurrentValue)) {
			$sUrl .= "payDriveCarID=" . urlencode($this->payDriveCarID->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&amp;ordertype=" . $fld->ReverseSort());
			return $this->AddMasterUrl(ew_CurrentPage() . "?" . $sUrlParm);
		} else {
			return "";
		}
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		global $EW_COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = $_POST["key_m"];
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = $_GET["key_m"];
			$cnt = count($arKeys);
		} elseif (!empty($_GET) || !empty($_POST)) {
			$isPost = ew_IsPost();
			if ($isPost && isset($_POST["payDriveCarID"]))
				$arKeys[] = $_POST["payDriveCarID"];
			elseif (isset($_GET["payDriveCarID"]))
				$arKeys[] = $_GET["payDriveCarID"];
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$this->payDriveCarID->CurrentValue = $key;
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($filter) {

		// Set up filter (SQL WHERE clause) and get return SQL
		//$this->CurrentFilter = $filter;
		//$sql = $this->SQL();

		$sql = $this->GetSQL($filter, "");
		$conn = &$this->Connection();
		$rs = $conn->Execute($sql);
		return $rs;
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->payDriveCarID->setDbValue($rs->fields('payDriveCarID'));
		$this->bodyTypeID->setDbValue($rs->fields('bodyTypeID'));
		$this->carTitle->setDbValue($rs->fields('carTitle'));
		$this->slug->setDbValue($rs->fields('slug'));
		$this->image->Upload->DbValue = $rs->fields('image');
		$this->extraFeatures->setDbValue($rs->fields('extraFeatures'));
		$this->noOfSeats->setDbValue($rs->fields('noOfSeats'));
		$this->luggage->setDbValue($rs->fields('luggage'));
		$this->transmissionID->setDbValue($rs->fields('transmissionID'));
		$this->ac->setDbValue($rs->fields('ac'));
		$this->noOfDoors->setDbValue($rs->fields('noOfDoors'));
		$this->s1DailyAED->setDbValue($rs->fields('s1DailyAED'));
		$this->s1DailyKM->setDbValue($rs->fields('s1DailyKM'));
		$this->s2DailyAED->setDbValue($rs->fields('s2DailyAED'));
		$this->s2DailyKM->setDbValue($rs->fields('s2DailyKM'));
		$this->s3DailyAED->setDbValue($rs->fields('s3DailyAED'));
		$this->s3DailyKM->setDbValue($rs->fields('s3DailyKM'));
		$this->s4DailyAED->setDbValue($rs->fields('s4DailyAED'));
		$this->s4DailyKM->setDbValue($rs->fields('s4DailyKM'));
		$this->s5DailyAED->setDbValue($rs->fields('s5DailyAED'));
		$this->s5DailyKM->setDbValue($rs->fields('s5DailyKM'));
		$this->s1WeeklyAED->setDbValue($rs->fields('s1WeeklyAED'));
		$this->s1WeeklyKM->setDbValue($rs->fields('s1WeeklyKM'));
		$this->s2WeeklyAED->setDbValue($rs->fields('s2WeeklyAED'));
		$this->s2WeeklyKM->setDbValue($rs->fields('s2WeeklyKM'));
		$this->s3WeeklyAED->setDbValue($rs->fields('s3WeeklyAED'));
		$this->s3WeeklyKM->setDbValue($rs->fields('s3WeeklyKM'));
		$this->s4WeeklyAED->setDbValue($rs->fields('s4WeeklyAED'));
		$this->s4WeeklyKM->setDbValue($rs->fields('s4WeeklyKM'));
		$this->s5WeeklyAED->setDbValue($rs->fields('s5WeeklyAED'));
		$this->s5WeeklyKM->setDbValue($rs->fields('s5WeeklyKM'));
		$this->s1MonthlyAED->setDbValue($rs->fields('s1MonthlyAED'));
		$this->s1MonthlyKM->setDbValue($rs->fields('s1MonthlyKM'));
		$this->s2MonthlyAED->setDbValue($rs->fields('s2MonthlyAED'));
		$this->s2MonthlyKM->setDbValue($rs->fields('s2MonthlyKM'));
		$this->s3MonthlyAED->setDbValue($rs->fields('s3MonthlyAED'));
		$this->s3MonthlyKM->setDbValue($rs->fields('s3MonthlyKM'));
		$this->s4MonthlyAED->setDbValue($rs->fields('s4MonthlyAED'));
		$this->s4MonthlyKM->setDbValue($rs->fields('s4MonthlyKM'));
		$this->s5MonthlyAED->setDbValue($rs->fields('s5MonthlyAED'));
		$this->s5MonthlyKM->setDbValue($rs->fields('s5MonthlyKM'));
		$this->scdwDailyAED->setDbValue($rs->fields('scdwDailyAED'));
		$this->scdwWeeklyAED->setDbValue($rs->fields('scdwWeeklyAED'));
		$this->scdwMonthlyAED->setDbValue($rs->fields('scdwMonthlyAED'));
		$this->cdwDailyAED->setDbValue($rs->fields('cdwDailyAED'));
		$this->cdwWeeklyAED->setDbValue($rs->fields('cdwWeeklyAED'));
		$this->cdwMonthlyAED->setDbValue($rs->fields('cdwMonthlyAED'));
		$this->paiDailyAED->setDbValue($rs->fields('paiDailyAED'));
		$this->paiWeeklyAED->setDbValue($rs->fields('paiWeeklyAED'));
		$this->paiMonthlyAED->setDbValue($rs->fields('paiMonthlyAED'));
		$this->gpsDailyAED->setDbValue($rs->fields('gpsDailyAED'));
		$this->gpsWeeklyAED->setDbValue($rs->fields('gpsWeeklyAED'));
		$this->gpsMonthlyAED->setDbValue($rs->fields('gpsMonthlyAED'));
		$this->additionalDriverDailyAED->setDbValue($rs->fields('additionalDriverDailyAED'));
		$this->additionalDriverWeeklyAED->setDbValue($rs->fields('additionalDriverWeeklyAED'));
		$this->additionalDriverMonthlyAED->setDbValue($rs->fields('additionalDriverMonthlyAED'));
		$this->babySafetySeatDailyAED->setDbValue($rs->fields('babySafetySeatDailyAED'));
		$this->babySafetySeatWeeklyAED->setDbValue($rs->fields('babySafetySeatWeeklyAED'));
		$this->babySafetySeatMonthlyAED->setDbValue($rs->fields('babySafetySeatMonthlyAED'));
		$this->addBabySafetySeatDailyAED->setDbValue($rs->fields('addBabySafetySeatDailyAED'));
		$this->addBabySafetySeatWeeklyAED->setDbValue($rs->fields('addBabySafetySeatWeeklyAED'));
		$this->addBabySafetySeatMonthlyAED->setDbValue($rs->fields('addBabySafetySeatMonthlyAED'));
		$this->deliveryAED->setDbValue($rs->fields('deliveryAED'));
		$this->active->setDbValue($rs->fields('active'));
		$this->phase1OrangeCard->setDbValue($rs->fields('phase1OrangeCard'));
		$this->phase1GPS->setDbValue($rs->fields('phase1GPS'));
		$this->phase1DeliveryCharges->setDbValue($rs->fields('phase1DeliveryCharges'));
		$this->phase1CollectionCharges->setDbValue($rs->fields('phase1CollectionCharges'));
		$this->addon01KM->setDbValue($rs->fields('addon01KM'));
		$this->addon01Price->setDbValue($rs->fields('addon01Price'));
		$this->addon02KM->setDbValue($rs->fields('addon02KM'));
		$this->addon02Price->setDbValue($rs->fields('addon02Price'));
		$this->addon03KM->setDbValue($rs->fields('addon03KM'));
		$this->addon03Price->setDbValue($rs->fields('addon03Price'));
		$this->addon04KM->setDbValue($rs->fields('addon04KM'));
		$this->addon04Price->setDbValue($rs->fields('addon04Price'));
		$this->addon05KM->setDbValue($rs->fields('addon05KM'));
		$this->addon05Price->setDbValue($rs->fields('addon05Price'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
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

		// scdwDailyAED
		$this->scdwDailyAED->ViewValue = $this->scdwDailyAED->CurrentValue;
		$this->scdwDailyAED->ViewCustomAttributes = "";

		// scdwWeeklyAED
		$this->scdwWeeklyAED->ViewValue = $this->scdwWeeklyAED->CurrentValue;
		$this->scdwWeeklyAED->ViewCustomAttributes = "";

		// scdwMonthlyAED
		$this->scdwMonthlyAED->ViewValue = $this->scdwMonthlyAED->CurrentValue;
		$this->scdwMonthlyAED->ViewCustomAttributes = "";

		// cdwDailyAED
		$this->cdwDailyAED->ViewValue = $this->cdwDailyAED->CurrentValue;
		$this->cdwDailyAED->ViewCustomAttributes = "";

		// cdwWeeklyAED
		$this->cdwWeeklyAED->ViewValue = $this->cdwWeeklyAED->CurrentValue;
		$this->cdwWeeklyAED->ViewCustomAttributes = "";

		// cdwMonthlyAED
		$this->cdwMonthlyAED->ViewValue = $this->cdwMonthlyAED->CurrentValue;
		$this->cdwMonthlyAED->ViewCustomAttributes = "";

		// paiDailyAED
		$this->paiDailyAED->ViewValue = $this->paiDailyAED->CurrentValue;
		$this->paiDailyAED->ViewCustomAttributes = "";

		// paiWeeklyAED
		$this->paiWeeklyAED->ViewValue = $this->paiWeeklyAED->CurrentValue;
		$this->paiWeeklyAED->ViewCustomAttributes = "";

		// paiMonthlyAED
		$this->paiMonthlyAED->ViewValue = $this->paiMonthlyAED->CurrentValue;
		$this->paiMonthlyAED->ViewCustomAttributes = "";

		// gpsDailyAED
		$this->gpsDailyAED->ViewValue = $this->gpsDailyAED->CurrentValue;
		$this->gpsDailyAED->ViewCustomAttributes = "";

		// gpsWeeklyAED
		$this->gpsWeeklyAED->ViewValue = $this->gpsWeeklyAED->CurrentValue;
		$this->gpsWeeklyAED->ViewCustomAttributes = "";

		// gpsMonthlyAED
		$this->gpsMonthlyAED->ViewValue = $this->gpsMonthlyAED->CurrentValue;
		$this->gpsMonthlyAED->ViewCustomAttributes = "";

		// additionalDriverDailyAED
		$this->additionalDriverDailyAED->ViewValue = $this->additionalDriverDailyAED->CurrentValue;
		$this->additionalDriverDailyAED->ViewCustomAttributes = "";

		// additionalDriverWeeklyAED
		$this->additionalDriverWeeklyAED->ViewValue = $this->additionalDriverWeeklyAED->CurrentValue;
		$this->additionalDriverWeeklyAED->ViewCustomAttributes = "";

		// additionalDriverMonthlyAED
		$this->additionalDriverMonthlyAED->ViewValue = $this->additionalDriverMonthlyAED->CurrentValue;
		$this->additionalDriverMonthlyAED->ViewCustomAttributes = "";

		// babySafetySeatDailyAED
		$this->babySafetySeatDailyAED->ViewValue = $this->babySafetySeatDailyAED->CurrentValue;
		$this->babySafetySeatDailyAED->ViewCustomAttributes = "";

		// babySafetySeatWeeklyAED
		$this->babySafetySeatWeeklyAED->ViewValue = $this->babySafetySeatWeeklyAED->CurrentValue;
		$this->babySafetySeatWeeklyAED->ViewCustomAttributes = "";

		// babySafetySeatMonthlyAED
		$this->babySafetySeatMonthlyAED->ViewValue = $this->babySafetySeatMonthlyAED->CurrentValue;
		$this->babySafetySeatMonthlyAED->ViewCustomAttributes = "";

		// addBabySafetySeatDailyAED
		$this->addBabySafetySeatDailyAED->ViewValue = $this->addBabySafetySeatDailyAED->CurrentValue;
		$this->addBabySafetySeatDailyAED->ViewCustomAttributes = "";

		// addBabySafetySeatWeeklyAED
		$this->addBabySafetySeatWeeklyAED->ViewValue = $this->addBabySafetySeatWeeklyAED->CurrentValue;
		$this->addBabySafetySeatWeeklyAED->ViewCustomAttributes = "";

		// addBabySafetySeatMonthlyAED
		$this->addBabySafetySeatMonthlyAED->ViewValue = $this->addBabySafetySeatMonthlyAED->CurrentValue;
		$this->addBabySafetySeatMonthlyAED->ViewCustomAttributes = "";

		// deliveryAED
		$this->deliveryAED->ViewValue = $this->deliveryAED->CurrentValue;
		$this->deliveryAED->ViewCustomAttributes = "";

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

		// slug
		$this->slug->LinkCustomAttributes = "";
		$this->slug->HrefValue = "";
		$this->slug->TooltipValue = "";

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

		// extraFeatures
		$this->extraFeatures->LinkCustomAttributes = "";
		$this->extraFeatures->HrefValue = "";
		$this->extraFeatures->TooltipValue = "";

		// noOfSeats
		$this->noOfSeats->LinkCustomAttributes = "";
		$this->noOfSeats->HrefValue = "";
		$this->noOfSeats->TooltipValue = "";

		// luggage
		$this->luggage->LinkCustomAttributes = "";
		$this->luggage->HrefValue = "";
		$this->luggage->TooltipValue = "";

		// transmissionID
		$this->transmissionID->LinkCustomAttributes = "";
		$this->transmissionID->HrefValue = "";
		$this->transmissionID->TooltipValue = "";

		// ac
		$this->ac->LinkCustomAttributes = "";
		$this->ac->HrefValue = "";
		$this->ac->TooltipValue = "";

		// noOfDoors
		$this->noOfDoors->LinkCustomAttributes = "";
		$this->noOfDoors->HrefValue = "";
		$this->noOfDoors->TooltipValue = "";

		// s1DailyAED
		$this->s1DailyAED->LinkCustomAttributes = "";
		$this->s1DailyAED->HrefValue = "";
		$this->s1DailyAED->TooltipValue = "";

		// s1DailyKM
		$this->s1DailyKM->LinkCustomAttributes = "";
		$this->s1DailyKM->HrefValue = "";
		$this->s1DailyKM->TooltipValue = "";

		// s2DailyAED
		$this->s2DailyAED->LinkCustomAttributes = "";
		$this->s2DailyAED->HrefValue = "";
		$this->s2DailyAED->TooltipValue = "";

		// s2DailyKM
		$this->s2DailyKM->LinkCustomAttributes = "";
		$this->s2DailyKM->HrefValue = "";
		$this->s2DailyKM->TooltipValue = "";

		// s3DailyAED
		$this->s3DailyAED->LinkCustomAttributes = "";
		$this->s3DailyAED->HrefValue = "";
		$this->s3DailyAED->TooltipValue = "";

		// s3DailyKM
		$this->s3DailyKM->LinkCustomAttributes = "";
		$this->s3DailyKM->HrefValue = "";
		$this->s3DailyKM->TooltipValue = "";

		// s4DailyAED
		$this->s4DailyAED->LinkCustomAttributes = "";
		$this->s4DailyAED->HrefValue = "";
		$this->s4DailyAED->TooltipValue = "";

		// s4DailyKM
		$this->s4DailyKM->LinkCustomAttributes = "";
		$this->s4DailyKM->HrefValue = "";
		$this->s4DailyKM->TooltipValue = "";

		// s5DailyAED
		$this->s5DailyAED->LinkCustomAttributes = "";
		$this->s5DailyAED->HrefValue = "";
		$this->s5DailyAED->TooltipValue = "";

		// s5DailyKM
		$this->s5DailyKM->LinkCustomAttributes = "";
		$this->s5DailyKM->HrefValue = "";
		$this->s5DailyKM->TooltipValue = "";

		// s1WeeklyAED
		$this->s1WeeklyAED->LinkCustomAttributes = "";
		$this->s1WeeklyAED->HrefValue = "";
		$this->s1WeeklyAED->TooltipValue = "";

		// s1WeeklyKM
		$this->s1WeeklyKM->LinkCustomAttributes = "";
		$this->s1WeeklyKM->HrefValue = "";
		$this->s1WeeklyKM->TooltipValue = "";

		// s2WeeklyAED
		$this->s2WeeklyAED->LinkCustomAttributes = "";
		$this->s2WeeklyAED->HrefValue = "";
		$this->s2WeeklyAED->TooltipValue = "";

		// s2WeeklyKM
		$this->s2WeeklyKM->LinkCustomAttributes = "";
		$this->s2WeeklyKM->HrefValue = "";
		$this->s2WeeklyKM->TooltipValue = "";

		// s3WeeklyAED
		$this->s3WeeklyAED->LinkCustomAttributes = "";
		$this->s3WeeklyAED->HrefValue = "";
		$this->s3WeeklyAED->TooltipValue = "";

		// s3WeeklyKM
		$this->s3WeeklyKM->LinkCustomAttributes = "";
		$this->s3WeeklyKM->HrefValue = "";
		$this->s3WeeklyKM->TooltipValue = "";

		// s4WeeklyAED
		$this->s4WeeklyAED->LinkCustomAttributes = "";
		$this->s4WeeklyAED->HrefValue = "";
		$this->s4WeeklyAED->TooltipValue = "";

		// s4WeeklyKM
		$this->s4WeeklyKM->LinkCustomAttributes = "";
		$this->s4WeeklyKM->HrefValue = "";
		$this->s4WeeklyKM->TooltipValue = "";

		// s5WeeklyAED
		$this->s5WeeklyAED->LinkCustomAttributes = "";
		$this->s5WeeklyAED->HrefValue = "";
		$this->s5WeeklyAED->TooltipValue = "";

		// s5WeeklyKM
		$this->s5WeeklyKM->LinkCustomAttributes = "";
		$this->s5WeeklyKM->HrefValue = "";
		$this->s5WeeklyKM->TooltipValue = "";

		// s1MonthlyAED
		$this->s1MonthlyAED->LinkCustomAttributes = "";
		$this->s1MonthlyAED->HrefValue = "";
		$this->s1MonthlyAED->TooltipValue = "";

		// s1MonthlyKM
		$this->s1MonthlyKM->LinkCustomAttributes = "";
		$this->s1MonthlyKM->HrefValue = "";
		$this->s1MonthlyKM->TooltipValue = "";

		// s2MonthlyAED
		$this->s2MonthlyAED->LinkCustomAttributes = "";
		$this->s2MonthlyAED->HrefValue = "";
		$this->s2MonthlyAED->TooltipValue = "";

		// s2MonthlyKM
		$this->s2MonthlyKM->LinkCustomAttributes = "";
		$this->s2MonthlyKM->HrefValue = "";
		$this->s2MonthlyKM->TooltipValue = "";

		// s3MonthlyAED
		$this->s3MonthlyAED->LinkCustomAttributes = "";
		$this->s3MonthlyAED->HrefValue = "";
		$this->s3MonthlyAED->TooltipValue = "";

		// s3MonthlyKM
		$this->s3MonthlyKM->LinkCustomAttributes = "";
		$this->s3MonthlyKM->HrefValue = "";
		$this->s3MonthlyKM->TooltipValue = "";

		// s4MonthlyAED
		$this->s4MonthlyAED->LinkCustomAttributes = "";
		$this->s4MonthlyAED->HrefValue = "";
		$this->s4MonthlyAED->TooltipValue = "";

		// s4MonthlyKM
		$this->s4MonthlyKM->LinkCustomAttributes = "";
		$this->s4MonthlyKM->HrefValue = "";
		$this->s4MonthlyKM->TooltipValue = "";

		// s5MonthlyAED
		$this->s5MonthlyAED->LinkCustomAttributes = "";
		$this->s5MonthlyAED->HrefValue = "";
		$this->s5MonthlyAED->TooltipValue = "";

		// s5MonthlyKM
		$this->s5MonthlyKM->LinkCustomAttributes = "";
		$this->s5MonthlyKM->HrefValue = "";
		$this->s5MonthlyKM->TooltipValue = "";

		// scdwDailyAED
		$this->scdwDailyAED->LinkCustomAttributes = "";
		$this->scdwDailyAED->HrefValue = "";
		$this->scdwDailyAED->TooltipValue = "";

		// scdwWeeklyAED
		$this->scdwWeeklyAED->LinkCustomAttributes = "";
		$this->scdwWeeklyAED->HrefValue = "";
		$this->scdwWeeklyAED->TooltipValue = "";

		// scdwMonthlyAED
		$this->scdwMonthlyAED->LinkCustomAttributes = "";
		$this->scdwMonthlyAED->HrefValue = "";
		$this->scdwMonthlyAED->TooltipValue = "";

		// cdwDailyAED
		$this->cdwDailyAED->LinkCustomAttributes = "";
		$this->cdwDailyAED->HrefValue = "";
		$this->cdwDailyAED->TooltipValue = "";

		// cdwWeeklyAED
		$this->cdwWeeklyAED->LinkCustomAttributes = "";
		$this->cdwWeeklyAED->HrefValue = "";
		$this->cdwWeeklyAED->TooltipValue = "";

		// cdwMonthlyAED
		$this->cdwMonthlyAED->LinkCustomAttributes = "";
		$this->cdwMonthlyAED->HrefValue = "";
		$this->cdwMonthlyAED->TooltipValue = "";

		// paiDailyAED
		$this->paiDailyAED->LinkCustomAttributes = "";
		$this->paiDailyAED->HrefValue = "";
		$this->paiDailyAED->TooltipValue = "";

		// paiWeeklyAED
		$this->paiWeeklyAED->LinkCustomAttributes = "";
		$this->paiWeeklyAED->HrefValue = "";
		$this->paiWeeklyAED->TooltipValue = "";

		// paiMonthlyAED
		$this->paiMonthlyAED->LinkCustomAttributes = "";
		$this->paiMonthlyAED->HrefValue = "";
		$this->paiMonthlyAED->TooltipValue = "";

		// gpsDailyAED
		$this->gpsDailyAED->LinkCustomAttributes = "";
		$this->gpsDailyAED->HrefValue = "";
		$this->gpsDailyAED->TooltipValue = "";

		// gpsWeeklyAED
		$this->gpsWeeklyAED->LinkCustomAttributes = "";
		$this->gpsWeeklyAED->HrefValue = "";
		$this->gpsWeeklyAED->TooltipValue = "";

		// gpsMonthlyAED
		$this->gpsMonthlyAED->LinkCustomAttributes = "";
		$this->gpsMonthlyAED->HrefValue = "";
		$this->gpsMonthlyAED->TooltipValue = "";

		// additionalDriverDailyAED
		$this->additionalDriverDailyAED->LinkCustomAttributes = "";
		$this->additionalDriverDailyAED->HrefValue = "";
		$this->additionalDriverDailyAED->TooltipValue = "";

		// additionalDriverWeeklyAED
		$this->additionalDriverWeeklyAED->LinkCustomAttributes = "";
		$this->additionalDriverWeeklyAED->HrefValue = "";
		$this->additionalDriverWeeklyAED->TooltipValue = "";

		// additionalDriverMonthlyAED
		$this->additionalDriverMonthlyAED->LinkCustomAttributes = "";
		$this->additionalDriverMonthlyAED->HrefValue = "";
		$this->additionalDriverMonthlyAED->TooltipValue = "";

		// babySafetySeatDailyAED
		$this->babySafetySeatDailyAED->LinkCustomAttributes = "";
		$this->babySafetySeatDailyAED->HrefValue = "";
		$this->babySafetySeatDailyAED->TooltipValue = "";

		// babySafetySeatWeeklyAED
		$this->babySafetySeatWeeklyAED->LinkCustomAttributes = "";
		$this->babySafetySeatWeeklyAED->HrefValue = "";
		$this->babySafetySeatWeeklyAED->TooltipValue = "";

		// babySafetySeatMonthlyAED
		$this->babySafetySeatMonthlyAED->LinkCustomAttributes = "";
		$this->babySafetySeatMonthlyAED->HrefValue = "";
		$this->babySafetySeatMonthlyAED->TooltipValue = "";

		// addBabySafetySeatDailyAED
		$this->addBabySafetySeatDailyAED->LinkCustomAttributes = "";
		$this->addBabySafetySeatDailyAED->HrefValue = "";
		$this->addBabySafetySeatDailyAED->TooltipValue = "";

		// addBabySafetySeatWeeklyAED
		$this->addBabySafetySeatWeeklyAED->LinkCustomAttributes = "";
		$this->addBabySafetySeatWeeklyAED->HrefValue = "";
		$this->addBabySafetySeatWeeklyAED->TooltipValue = "";

		// addBabySafetySeatMonthlyAED
		$this->addBabySafetySeatMonthlyAED->LinkCustomAttributes = "";
		$this->addBabySafetySeatMonthlyAED->HrefValue = "";
		$this->addBabySafetySeatMonthlyAED->TooltipValue = "";

		// deliveryAED
		$this->deliveryAED->LinkCustomAttributes = "";
		$this->deliveryAED->HrefValue = "";
		$this->deliveryAED->TooltipValue = "";

		// active
		$this->active->LinkCustomAttributes = "";
		$this->active->HrefValue = "";
		$this->active->TooltipValue = "";

		// phase1OrangeCard
		$this->phase1OrangeCard->LinkCustomAttributes = "";
		$this->phase1OrangeCard->HrefValue = "";
		$this->phase1OrangeCard->TooltipValue = "";

		// phase1GPS
		$this->phase1GPS->LinkCustomAttributes = "";
		$this->phase1GPS->HrefValue = "";
		$this->phase1GPS->TooltipValue = "";

		// phase1DeliveryCharges
		$this->phase1DeliveryCharges->LinkCustomAttributes = "";
		$this->phase1DeliveryCharges->HrefValue = "";
		$this->phase1DeliveryCharges->TooltipValue = "";

		// phase1CollectionCharges
		$this->phase1CollectionCharges->LinkCustomAttributes = "";
		$this->phase1CollectionCharges->HrefValue = "";
		$this->phase1CollectionCharges->TooltipValue = "";

		// addon01KM
		$this->addon01KM->LinkCustomAttributes = "";
		$this->addon01KM->HrefValue = "";
		$this->addon01KM->TooltipValue = "";

		// addon01Price
		$this->addon01Price->LinkCustomAttributes = "";
		$this->addon01Price->HrefValue = "";
		$this->addon01Price->TooltipValue = "";

		// addon02KM
		$this->addon02KM->LinkCustomAttributes = "";
		$this->addon02KM->HrefValue = "";
		$this->addon02KM->TooltipValue = "";

		// addon02Price
		$this->addon02Price->LinkCustomAttributes = "";
		$this->addon02Price->HrefValue = "";
		$this->addon02Price->TooltipValue = "";

		// addon03KM
		$this->addon03KM->LinkCustomAttributes = "";
		$this->addon03KM->HrefValue = "";
		$this->addon03KM->TooltipValue = "";

		// addon03Price
		$this->addon03Price->LinkCustomAttributes = "";
		$this->addon03Price->HrefValue = "";
		$this->addon03Price->TooltipValue = "";

		// addon04KM
		$this->addon04KM->LinkCustomAttributes = "";
		$this->addon04KM->HrefValue = "";
		$this->addon04KM->TooltipValue = "";

		// addon04Price
		$this->addon04Price->LinkCustomAttributes = "";
		$this->addon04Price->HrefValue = "";
		$this->addon04Price->TooltipValue = "";

		// addon05KM
		$this->addon05KM->LinkCustomAttributes = "";
		$this->addon05KM->HrefValue = "";
		$this->addon05KM->TooltipValue = "";

		// addon05Price
		$this->addon05Price->LinkCustomAttributes = "";
		$this->addon05Price->HrefValue = "";
		$this->addon05Price->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->CustomTemplateFieldValues();
	}

	// Render edit row values
	function RenderEditRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// payDriveCarID
		$this->payDriveCarID->EditAttrs["class"] = "form-control";
		$this->payDriveCarID->EditCustomAttributes = "";
		$this->payDriveCarID->EditValue = $this->payDriveCarID->CurrentValue;
		$this->payDriveCarID->ViewCustomAttributes = "";

		// bodyTypeID
		$this->bodyTypeID->EditAttrs["class"] = "form-control";
		$this->bodyTypeID->EditCustomAttributes = "";

		// carTitle
		$this->carTitle->EditAttrs["class"] = "form-control";
		$this->carTitle->EditCustomAttributes = "";
		$this->carTitle->EditValue = $this->carTitle->CurrentValue;
		$this->carTitle->PlaceHolder = ew_RemoveHtml($this->carTitle->FldCaption());

		// slug
		$this->slug->EditAttrs["class"] = "form-control";
		$this->slug->EditCustomAttributes = "";
		$this->slug->EditValue = $this->slug->CurrentValue;
		$this->slug->PlaceHolder = ew_RemoveHtml($this->slug->FldCaption());

		// image
		$this->image->EditAttrs["class"] = "form-control";
		$this->image->EditCustomAttributes = "";
		$this->image->UploadPath = 'uploads/rentlease';
		if (!ew_Empty($this->image->Upload->DbValue)) {
			$this->image->ImageWidth = 100;
			$this->image->ImageHeight = 0;
			$this->image->ImageAlt = $this->image->FldAlt();
			$this->image->EditValue = $this->image->Upload->DbValue;
		} else {
			$this->image->EditValue = "";
		}
		if (!ew_Empty($this->image->CurrentValue))
				$this->image->Upload->FileName = $this->image->CurrentValue;

		// extraFeatures
		$this->extraFeatures->EditCustomAttributes = "";

		// noOfSeats
		$this->noOfSeats->EditAttrs["class"] = "form-control";
		$this->noOfSeats->EditCustomAttributes = "";
		$this->noOfSeats->EditValue = $this->noOfSeats->CurrentValue;
		$this->noOfSeats->PlaceHolder = ew_RemoveHtml($this->noOfSeats->FldCaption());

		// luggage
		$this->luggage->EditAttrs["class"] = "form-control";
		$this->luggage->EditCustomAttributes = "";
		$this->luggage->EditValue = $this->luggage->CurrentValue;
		$this->luggage->PlaceHolder = ew_RemoveHtml($this->luggage->FldCaption());

		// transmissionID
		$this->transmissionID->EditAttrs["class"] = "form-control";
		$this->transmissionID->EditCustomAttributes = "";

		// ac
		$this->ac->EditCustomAttributes = "";
		$this->ac->EditValue = $this->ac->Options(FALSE);

		// noOfDoors
		$this->noOfDoors->EditAttrs["class"] = "form-control";
		$this->noOfDoors->EditCustomAttributes = "";
		$this->noOfDoors->EditValue = $this->noOfDoors->CurrentValue;
		$this->noOfDoors->PlaceHolder = ew_RemoveHtml($this->noOfDoors->FldCaption());

		// s1DailyAED
		$this->s1DailyAED->EditAttrs["class"] = "form-control";
		$this->s1DailyAED->EditCustomAttributes = "";
		$this->s1DailyAED->EditValue = $this->s1DailyAED->CurrentValue;
		$this->s1DailyAED->PlaceHolder = ew_RemoveHtml($this->s1DailyAED->FldCaption());
		if (strval($this->s1DailyAED->EditValue) <> "" && is_numeric($this->s1DailyAED->EditValue)) $this->s1DailyAED->EditValue = ew_FormatNumber($this->s1DailyAED->EditValue, -2, -1, -2, 0);

		// s1DailyKM
		$this->s1DailyKM->EditAttrs["class"] = "form-control";
		$this->s1DailyKM->EditCustomAttributes = "";
		$this->s1DailyKM->EditValue = $this->s1DailyKM->CurrentValue;
		$this->s1DailyKM->PlaceHolder = ew_RemoveHtml($this->s1DailyKM->FldCaption());

		// s2DailyAED
		$this->s2DailyAED->EditAttrs["class"] = "form-control";
		$this->s2DailyAED->EditCustomAttributes = "";
		$this->s2DailyAED->EditValue = $this->s2DailyAED->CurrentValue;
		$this->s2DailyAED->PlaceHolder = ew_RemoveHtml($this->s2DailyAED->FldCaption());
		if (strval($this->s2DailyAED->EditValue) <> "" && is_numeric($this->s2DailyAED->EditValue)) $this->s2DailyAED->EditValue = ew_FormatNumber($this->s2DailyAED->EditValue, -2, -1, -2, 0);

		// s2DailyKM
		$this->s2DailyKM->EditAttrs["class"] = "form-control";
		$this->s2DailyKM->EditCustomAttributes = "";
		$this->s2DailyKM->EditValue = $this->s2DailyKM->CurrentValue;
		$this->s2DailyKM->PlaceHolder = ew_RemoveHtml($this->s2DailyKM->FldCaption());

		// s3DailyAED
		$this->s3DailyAED->EditAttrs["class"] = "form-control";
		$this->s3DailyAED->EditCustomAttributes = "";
		$this->s3DailyAED->EditValue = $this->s3DailyAED->CurrentValue;
		$this->s3DailyAED->PlaceHolder = ew_RemoveHtml($this->s3DailyAED->FldCaption());
		if (strval($this->s3DailyAED->EditValue) <> "" && is_numeric($this->s3DailyAED->EditValue)) $this->s3DailyAED->EditValue = ew_FormatNumber($this->s3DailyAED->EditValue, -2, -1, -2, 0);

		// s3DailyKM
		$this->s3DailyKM->EditAttrs["class"] = "form-control";
		$this->s3DailyKM->EditCustomAttributes = "";
		$this->s3DailyKM->EditValue = $this->s3DailyKM->CurrentValue;
		$this->s3DailyKM->PlaceHolder = ew_RemoveHtml($this->s3DailyKM->FldCaption());

		// s4DailyAED
		$this->s4DailyAED->EditAttrs["class"] = "form-control";
		$this->s4DailyAED->EditCustomAttributes = "";
		$this->s4DailyAED->EditValue = $this->s4DailyAED->CurrentValue;
		$this->s4DailyAED->PlaceHolder = ew_RemoveHtml($this->s4DailyAED->FldCaption());
		if (strval($this->s4DailyAED->EditValue) <> "" && is_numeric($this->s4DailyAED->EditValue)) $this->s4DailyAED->EditValue = ew_FormatNumber($this->s4DailyAED->EditValue, -2, -1, -2, 0);

		// s4DailyKM
		$this->s4DailyKM->EditAttrs["class"] = "form-control";
		$this->s4DailyKM->EditCustomAttributes = "";
		$this->s4DailyKM->EditValue = $this->s4DailyKM->CurrentValue;
		$this->s4DailyKM->PlaceHolder = ew_RemoveHtml($this->s4DailyKM->FldCaption());

		// s5DailyAED
		$this->s5DailyAED->EditAttrs["class"] = "form-control";
		$this->s5DailyAED->EditCustomAttributes = "";
		$this->s5DailyAED->EditValue = $this->s5DailyAED->CurrentValue;
		$this->s5DailyAED->PlaceHolder = ew_RemoveHtml($this->s5DailyAED->FldCaption());
		if (strval($this->s5DailyAED->EditValue) <> "" && is_numeric($this->s5DailyAED->EditValue)) $this->s5DailyAED->EditValue = ew_FormatNumber($this->s5DailyAED->EditValue, -2, -1, -2, 0);

		// s5DailyKM
		$this->s5DailyKM->EditAttrs["class"] = "form-control";
		$this->s5DailyKM->EditCustomAttributes = "";
		$this->s5DailyKM->EditValue = $this->s5DailyKM->CurrentValue;
		$this->s5DailyKM->PlaceHolder = ew_RemoveHtml($this->s5DailyKM->FldCaption());

		// s1WeeklyAED
		$this->s1WeeklyAED->EditAttrs["class"] = "form-control";
		$this->s1WeeklyAED->EditCustomAttributes = "";
		$this->s1WeeklyAED->EditValue = $this->s1WeeklyAED->CurrentValue;
		$this->s1WeeklyAED->PlaceHolder = ew_RemoveHtml($this->s1WeeklyAED->FldCaption());
		if (strval($this->s1WeeklyAED->EditValue) <> "" && is_numeric($this->s1WeeklyAED->EditValue)) $this->s1WeeklyAED->EditValue = ew_FormatNumber($this->s1WeeklyAED->EditValue, -2, -1, -2, 0);

		// s1WeeklyKM
		$this->s1WeeklyKM->EditAttrs["class"] = "form-control";
		$this->s1WeeklyKM->EditCustomAttributes = "";
		$this->s1WeeklyKM->EditValue = $this->s1WeeklyKM->CurrentValue;
		$this->s1WeeklyKM->PlaceHolder = ew_RemoveHtml($this->s1WeeklyKM->FldCaption());

		// s2WeeklyAED
		$this->s2WeeklyAED->EditAttrs["class"] = "form-control";
		$this->s2WeeklyAED->EditCustomAttributes = "";
		$this->s2WeeklyAED->EditValue = $this->s2WeeklyAED->CurrentValue;
		$this->s2WeeklyAED->PlaceHolder = ew_RemoveHtml($this->s2WeeklyAED->FldCaption());
		if (strval($this->s2WeeklyAED->EditValue) <> "" && is_numeric($this->s2WeeklyAED->EditValue)) $this->s2WeeklyAED->EditValue = ew_FormatNumber($this->s2WeeklyAED->EditValue, -2, -1, -2, 0);

		// s2WeeklyKM
		$this->s2WeeklyKM->EditAttrs["class"] = "form-control";
		$this->s2WeeklyKM->EditCustomAttributes = "";
		$this->s2WeeklyKM->EditValue = $this->s2WeeklyKM->CurrentValue;
		$this->s2WeeklyKM->PlaceHolder = ew_RemoveHtml($this->s2WeeklyKM->FldCaption());

		// s3WeeklyAED
		$this->s3WeeklyAED->EditAttrs["class"] = "form-control";
		$this->s3WeeklyAED->EditCustomAttributes = "";
		$this->s3WeeklyAED->EditValue = $this->s3WeeklyAED->CurrentValue;
		$this->s3WeeklyAED->PlaceHolder = ew_RemoveHtml($this->s3WeeklyAED->FldCaption());
		if (strval($this->s3WeeklyAED->EditValue) <> "" && is_numeric($this->s3WeeklyAED->EditValue)) $this->s3WeeklyAED->EditValue = ew_FormatNumber($this->s3WeeklyAED->EditValue, -2, -1, -2, 0);

		// s3WeeklyKM
		$this->s3WeeklyKM->EditAttrs["class"] = "form-control";
		$this->s3WeeklyKM->EditCustomAttributes = "";
		$this->s3WeeklyKM->EditValue = $this->s3WeeklyKM->CurrentValue;
		$this->s3WeeklyKM->PlaceHolder = ew_RemoveHtml($this->s3WeeklyKM->FldCaption());

		// s4WeeklyAED
		$this->s4WeeklyAED->EditAttrs["class"] = "form-control";
		$this->s4WeeklyAED->EditCustomAttributes = "";
		$this->s4WeeklyAED->EditValue = $this->s4WeeklyAED->CurrentValue;
		$this->s4WeeklyAED->PlaceHolder = ew_RemoveHtml($this->s4WeeklyAED->FldCaption());
		if (strval($this->s4WeeklyAED->EditValue) <> "" && is_numeric($this->s4WeeklyAED->EditValue)) $this->s4WeeklyAED->EditValue = ew_FormatNumber($this->s4WeeklyAED->EditValue, -2, -1, -2, 0);

		// s4WeeklyKM
		$this->s4WeeklyKM->EditAttrs["class"] = "form-control";
		$this->s4WeeklyKM->EditCustomAttributes = "";
		$this->s4WeeklyKM->EditValue = $this->s4WeeklyKM->CurrentValue;
		$this->s4WeeklyKM->PlaceHolder = ew_RemoveHtml($this->s4WeeklyKM->FldCaption());

		// s5WeeklyAED
		$this->s5WeeklyAED->EditAttrs["class"] = "form-control";
		$this->s5WeeklyAED->EditCustomAttributes = "";
		$this->s5WeeklyAED->EditValue = $this->s5WeeklyAED->CurrentValue;
		$this->s5WeeklyAED->PlaceHolder = ew_RemoveHtml($this->s5WeeklyAED->FldCaption());
		if (strval($this->s5WeeklyAED->EditValue) <> "" && is_numeric($this->s5WeeklyAED->EditValue)) $this->s5WeeklyAED->EditValue = ew_FormatNumber($this->s5WeeklyAED->EditValue, -2, -1, -2, 0);

		// s5WeeklyKM
		$this->s5WeeklyKM->EditAttrs["class"] = "form-control";
		$this->s5WeeklyKM->EditCustomAttributes = "";
		$this->s5WeeklyKM->EditValue = $this->s5WeeklyKM->CurrentValue;
		$this->s5WeeklyKM->PlaceHolder = ew_RemoveHtml($this->s5WeeklyKM->FldCaption());

		// s1MonthlyAED
		$this->s1MonthlyAED->EditAttrs["class"] = "form-control";
		$this->s1MonthlyAED->EditCustomAttributes = "";
		$this->s1MonthlyAED->EditValue = $this->s1MonthlyAED->CurrentValue;
		$this->s1MonthlyAED->PlaceHolder = ew_RemoveHtml($this->s1MonthlyAED->FldCaption());
		if (strval($this->s1MonthlyAED->EditValue) <> "" && is_numeric($this->s1MonthlyAED->EditValue)) $this->s1MonthlyAED->EditValue = ew_FormatNumber($this->s1MonthlyAED->EditValue, -2, -1, -2, 0);

		// s1MonthlyKM
		$this->s1MonthlyKM->EditAttrs["class"] = "form-control";
		$this->s1MonthlyKM->EditCustomAttributes = "";
		$this->s1MonthlyKM->EditValue = $this->s1MonthlyKM->CurrentValue;
		$this->s1MonthlyKM->PlaceHolder = ew_RemoveHtml($this->s1MonthlyKM->FldCaption());

		// s2MonthlyAED
		$this->s2MonthlyAED->EditAttrs["class"] = "form-control";
		$this->s2MonthlyAED->EditCustomAttributes = "";
		$this->s2MonthlyAED->EditValue = $this->s2MonthlyAED->CurrentValue;
		$this->s2MonthlyAED->PlaceHolder = ew_RemoveHtml($this->s2MonthlyAED->FldCaption());
		if (strval($this->s2MonthlyAED->EditValue) <> "" && is_numeric($this->s2MonthlyAED->EditValue)) $this->s2MonthlyAED->EditValue = ew_FormatNumber($this->s2MonthlyAED->EditValue, -2, -1, -2, 0);

		// s2MonthlyKM
		$this->s2MonthlyKM->EditAttrs["class"] = "form-control";
		$this->s2MonthlyKM->EditCustomAttributes = "";
		$this->s2MonthlyKM->EditValue = $this->s2MonthlyKM->CurrentValue;
		$this->s2MonthlyKM->PlaceHolder = ew_RemoveHtml($this->s2MonthlyKM->FldCaption());

		// s3MonthlyAED
		$this->s3MonthlyAED->EditAttrs["class"] = "form-control";
		$this->s3MonthlyAED->EditCustomAttributes = "";
		$this->s3MonthlyAED->EditValue = $this->s3MonthlyAED->CurrentValue;
		$this->s3MonthlyAED->PlaceHolder = ew_RemoveHtml($this->s3MonthlyAED->FldCaption());
		if (strval($this->s3MonthlyAED->EditValue) <> "" && is_numeric($this->s3MonthlyAED->EditValue)) $this->s3MonthlyAED->EditValue = ew_FormatNumber($this->s3MonthlyAED->EditValue, -2, -1, -2, 0);

		// s3MonthlyKM
		$this->s3MonthlyKM->EditAttrs["class"] = "form-control";
		$this->s3MonthlyKM->EditCustomAttributes = "";
		$this->s3MonthlyKM->EditValue = $this->s3MonthlyKM->CurrentValue;
		$this->s3MonthlyKM->PlaceHolder = ew_RemoveHtml($this->s3MonthlyKM->FldCaption());

		// s4MonthlyAED
		$this->s4MonthlyAED->EditAttrs["class"] = "form-control";
		$this->s4MonthlyAED->EditCustomAttributes = "";
		$this->s4MonthlyAED->EditValue = $this->s4MonthlyAED->CurrentValue;
		$this->s4MonthlyAED->PlaceHolder = ew_RemoveHtml($this->s4MonthlyAED->FldCaption());
		if (strval($this->s4MonthlyAED->EditValue) <> "" && is_numeric($this->s4MonthlyAED->EditValue)) $this->s4MonthlyAED->EditValue = ew_FormatNumber($this->s4MonthlyAED->EditValue, -2, -1, -2, 0);

		// s4MonthlyKM
		$this->s4MonthlyKM->EditAttrs["class"] = "form-control";
		$this->s4MonthlyKM->EditCustomAttributes = "";
		$this->s4MonthlyKM->EditValue = $this->s4MonthlyKM->CurrentValue;
		$this->s4MonthlyKM->PlaceHolder = ew_RemoveHtml($this->s4MonthlyKM->FldCaption());

		// s5MonthlyAED
		$this->s5MonthlyAED->EditAttrs["class"] = "form-control";
		$this->s5MonthlyAED->EditCustomAttributes = "";
		$this->s5MonthlyAED->EditValue = $this->s5MonthlyAED->CurrentValue;
		$this->s5MonthlyAED->PlaceHolder = ew_RemoveHtml($this->s5MonthlyAED->FldCaption());
		if (strval($this->s5MonthlyAED->EditValue) <> "" && is_numeric($this->s5MonthlyAED->EditValue)) $this->s5MonthlyAED->EditValue = ew_FormatNumber($this->s5MonthlyAED->EditValue, -2, -1, -2, 0);

		// s5MonthlyKM
		$this->s5MonthlyKM->EditAttrs["class"] = "form-control";
		$this->s5MonthlyKM->EditCustomAttributes = "";
		$this->s5MonthlyKM->EditValue = $this->s5MonthlyKM->CurrentValue;
		$this->s5MonthlyKM->PlaceHolder = ew_RemoveHtml($this->s5MonthlyKM->FldCaption());

		// scdwDailyAED
		$this->scdwDailyAED->EditAttrs["class"] = "form-control";
		$this->scdwDailyAED->EditCustomAttributes = "";
		$this->scdwDailyAED->EditValue = $this->scdwDailyAED->CurrentValue;
		$this->scdwDailyAED->PlaceHolder = ew_RemoveHtml($this->scdwDailyAED->FldCaption());
		if (strval($this->scdwDailyAED->EditValue) <> "" && is_numeric($this->scdwDailyAED->EditValue)) $this->scdwDailyAED->EditValue = ew_FormatNumber($this->scdwDailyAED->EditValue, -2, -1, -2, 0);

		// scdwWeeklyAED
		$this->scdwWeeklyAED->EditAttrs["class"] = "form-control";
		$this->scdwWeeklyAED->EditCustomAttributes = "";
		$this->scdwWeeklyAED->EditValue = $this->scdwWeeklyAED->CurrentValue;
		$this->scdwWeeklyAED->PlaceHolder = ew_RemoveHtml($this->scdwWeeklyAED->FldCaption());
		if (strval($this->scdwWeeklyAED->EditValue) <> "" && is_numeric($this->scdwWeeklyAED->EditValue)) $this->scdwWeeklyAED->EditValue = ew_FormatNumber($this->scdwWeeklyAED->EditValue, -2, -1, -2, 0);

		// scdwMonthlyAED
		$this->scdwMonthlyAED->EditAttrs["class"] = "form-control";
		$this->scdwMonthlyAED->EditCustomAttributes = "";
		$this->scdwMonthlyAED->EditValue = $this->scdwMonthlyAED->CurrentValue;
		$this->scdwMonthlyAED->PlaceHolder = ew_RemoveHtml($this->scdwMonthlyAED->FldCaption());
		if (strval($this->scdwMonthlyAED->EditValue) <> "" && is_numeric($this->scdwMonthlyAED->EditValue)) $this->scdwMonthlyAED->EditValue = ew_FormatNumber($this->scdwMonthlyAED->EditValue, -2, -1, -2, 0);

		// cdwDailyAED
		$this->cdwDailyAED->EditAttrs["class"] = "form-control";
		$this->cdwDailyAED->EditCustomAttributes = "";
		$this->cdwDailyAED->EditValue = $this->cdwDailyAED->CurrentValue;
		$this->cdwDailyAED->PlaceHolder = ew_RemoveHtml($this->cdwDailyAED->FldCaption());
		if (strval($this->cdwDailyAED->EditValue) <> "" && is_numeric($this->cdwDailyAED->EditValue)) $this->cdwDailyAED->EditValue = ew_FormatNumber($this->cdwDailyAED->EditValue, -2, -1, -2, 0);

		// cdwWeeklyAED
		$this->cdwWeeklyAED->EditAttrs["class"] = "form-control";
		$this->cdwWeeklyAED->EditCustomAttributes = "";
		$this->cdwWeeklyAED->EditValue = $this->cdwWeeklyAED->CurrentValue;
		$this->cdwWeeklyAED->PlaceHolder = ew_RemoveHtml($this->cdwWeeklyAED->FldCaption());
		if (strval($this->cdwWeeklyAED->EditValue) <> "" && is_numeric($this->cdwWeeklyAED->EditValue)) $this->cdwWeeklyAED->EditValue = ew_FormatNumber($this->cdwWeeklyAED->EditValue, -2, -1, -2, 0);

		// cdwMonthlyAED
		$this->cdwMonthlyAED->EditAttrs["class"] = "form-control";
		$this->cdwMonthlyAED->EditCustomAttributes = "";
		$this->cdwMonthlyAED->EditValue = $this->cdwMonthlyAED->CurrentValue;
		$this->cdwMonthlyAED->PlaceHolder = ew_RemoveHtml($this->cdwMonthlyAED->FldCaption());
		if (strval($this->cdwMonthlyAED->EditValue) <> "" && is_numeric($this->cdwMonthlyAED->EditValue)) $this->cdwMonthlyAED->EditValue = ew_FormatNumber($this->cdwMonthlyAED->EditValue, -2, -1, -2, 0);

		// paiDailyAED
		$this->paiDailyAED->EditAttrs["class"] = "form-control";
		$this->paiDailyAED->EditCustomAttributes = "";
		$this->paiDailyAED->EditValue = $this->paiDailyAED->CurrentValue;
		$this->paiDailyAED->PlaceHolder = ew_RemoveHtml($this->paiDailyAED->FldCaption());
		if (strval($this->paiDailyAED->EditValue) <> "" && is_numeric($this->paiDailyAED->EditValue)) $this->paiDailyAED->EditValue = ew_FormatNumber($this->paiDailyAED->EditValue, -2, -1, -2, 0);

		// paiWeeklyAED
		$this->paiWeeklyAED->EditAttrs["class"] = "form-control";
		$this->paiWeeklyAED->EditCustomAttributes = "";
		$this->paiWeeklyAED->EditValue = $this->paiWeeklyAED->CurrentValue;
		$this->paiWeeklyAED->PlaceHolder = ew_RemoveHtml($this->paiWeeklyAED->FldCaption());
		if (strval($this->paiWeeklyAED->EditValue) <> "" && is_numeric($this->paiWeeklyAED->EditValue)) $this->paiWeeklyAED->EditValue = ew_FormatNumber($this->paiWeeklyAED->EditValue, -2, -1, -2, 0);

		// paiMonthlyAED
		$this->paiMonthlyAED->EditAttrs["class"] = "form-control";
		$this->paiMonthlyAED->EditCustomAttributes = "";
		$this->paiMonthlyAED->EditValue = $this->paiMonthlyAED->CurrentValue;
		$this->paiMonthlyAED->PlaceHolder = ew_RemoveHtml($this->paiMonthlyAED->FldCaption());
		if (strval($this->paiMonthlyAED->EditValue) <> "" && is_numeric($this->paiMonthlyAED->EditValue)) $this->paiMonthlyAED->EditValue = ew_FormatNumber($this->paiMonthlyAED->EditValue, -2, -1, -2, 0);

		// gpsDailyAED
		$this->gpsDailyAED->EditAttrs["class"] = "form-control";
		$this->gpsDailyAED->EditCustomAttributes = "";
		$this->gpsDailyAED->EditValue = $this->gpsDailyAED->CurrentValue;
		$this->gpsDailyAED->PlaceHolder = ew_RemoveHtml($this->gpsDailyAED->FldCaption());
		if (strval($this->gpsDailyAED->EditValue) <> "" && is_numeric($this->gpsDailyAED->EditValue)) $this->gpsDailyAED->EditValue = ew_FormatNumber($this->gpsDailyAED->EditValue, -2, -1, -2, 0);

		// gpsWeeklyAED
		$this->gpsWeeklyAED->EditAttrs["class"] = "form-control";
		$this->gpsWeeklyAED->EditCustomAttributes = "";
		$this->gpsWeeklyAED->EditValue = $this->gpsWeeklyAED->CurrentValue;
		$this->gpsWeeklyAED->PlaceHolder = ew_RemoveHtml($this->gpsWeeklyAED->FldCaption());
		if (strval($this->gpsWeeklyAED->EditValue) <> "" && is_numeric($this->gpsWeeklyAED->EditValue)) $this->gpsWeeklyAED->EditValue = ew_FormatNumber($this->gpsWeeklyAED->EditValue, -2, -1, -2, 0);

		// gpsMonthlyAED
		$this->gpsMonthlyAED->EditAttrs["class"] = "form-control";
		$this->gpsMonthlyAED->EditCustomAttributes = "";
		$this->gpsMonthlyAED->EditValue = $this->gpsMonthlyAED->CurrentValue;
		$this->gpsMonthlyAED->PlaceHolder = ew_RemoveHtml($this->gpsMonthlyAED->FldCaption());
		if (strval($this->gpsMonthlyAED->EditValue) <> "" && is_numeric($this->gpsMonthlyAED->EditValue)) $this->gpsMonthlyAED->EditValue = ew_FormatNumber($this->gpsMonthlyAED->EditValue, -2, -1, -2, 0);

		// additionalDriverDailyAED
		$this->additionalDriverDailyAED->EditAttrs["class"] = "form-control";
		$this->additionalDriverDailyAED->EditCustomAttributes = "";
		$this->additionalDriverDailyAED->EditValue = $this->additionalDriverDailyAED->CurrentValue;
		$this->additionalDriverDailyAED->PlaceHolder = ew_RemoveHtml($this->additionalDriverDailyAED->FldCaption());
		if (strval($this->additionalDriverDailyAED->EditValue) <> "" && is_numeric($this->additionalDriverDailyAED->EditValue)) $this->additionalDriverDailyAED->EditValue = ew_FormatNumber($this->additionalDriverDailyAED->EditValue, -2, -1, -2, 0);

		// additionalDriverWeeklyAED
		$this->additionalDriverWeeklyAED->EditAttrs["class"] = "form-control";
		$this->additionalDriverWeeklyAED->EditCustomAttributes = "";
		$this->additionalDriverWeeklyAED->EditValue = $this->additionalDriverWeeklyAED->CurrentValue;
		$this->additionalDriverWeeklyAED->PlaceHolder = ew_RemoveHtml($this->additionalDriverWeeklyAED->FldCaption());
		if (strval($this->additionalDriverWeeklyAED->EditValue) <> "" && is_numeric($this->additionalDriverWeeklyAED->EditValue)) $this->additionalDriverWeeklyAED->EditValue = ew_FormatNumber($this->additionalDriverWeeklyAED->EditValue, -2, -1, -2, 0);

		// additionalDriverMonthlyAED
		$this->additionalDriverMonthlyAED->EditAttrs["class"] = "form-control";
		$this->additionalDriverMonthlyAED->EditCustomAttributes = "";
		$this->additionalDriverMonthlyAED->EditValue = $this->additionalDriverMonthlyAED->CurrentValue;
		$this->additionalDriverMonthlyAED->PlaceHolder = ew_RemoveHtml($this->additionalDriverMonthlyAED->FldCaption());
		if (strval($this->additionalDriverMonthlyAED->EditValue) <> "" && is_numeric($this->additionalDriverMonthlyAED->EditValue)) $this->additionalDriverMonthlyAED->EditValue = ew_FormatNumber($this->additionalDriverMonthlyAED->EditValue, -2, -1, -2, 0);

		// babySafetySeatDailyAED
		$this->babySafetySeatDailyAED->EditAttrs["class"] = "form-control";
		$this->babySafetySeatDailyAED->EditCustomAttributes = "";
		$this->babySafetySeatDailyAED->EditValue = $this->babySafetySeatDailyAED->CurrentValue;
		$this->babySafetySeatDailyAED->PlaceHolder = ew_RemoveHtml($this->babySafetySeatDailyAED->FldCaption());
		if (strval($this->babySafetySeatDailyAED->EditValue) <> "" && is_numeric($this->babySafetySeatDailyAED->EditValue)) $this->babySafetySeatDailyAED->EditValue = ew_FormatNumber($this->babySafetySeatDailyAED->EditValue, -2, -1, -2, 0);

		// babySafetySeatWeeklyAED
		$this->babySafetySeatWeeklyAED->EditAttrs["class"] = "form-control";
		$this->babySafetySeatWeeklyAED->EditCustomAttributes = "";
		$this->babySafetySeatWeeklyAED->EditValue = $this->babySafetySeatWeeklyAED->CurrentValue;
		$this->babySafetySeatWeeklyAED->PlaceHolder = ew_RemoveHtml($this->babySafetySeatWeeklyAED->FldCaption());
		if (strval($this->babySafetySeatWeeklyAED->EditValue) <> "" && is_numeric($this->babySafetySeatWeeklyAED->EditValue)) $this->babySafetySeatWeeklyAED->EditValue = ew_FormatNumber($this->babySafetySeatWeeklyAED->EditValue, -2, -1, -2, 0);

		// babySafetySeatMonthlyAED
		$this->babySafetySeatMonthlyAED->EditAttrs["class"] = "form-control";
		$this->babySafetySeatMonthlyAED->EditCustomAttributes = "";
		$this->babySafetySeatMonthlyAED->EditValue = $this->babySafetySeatMonthlyAED->CurrentValue;
		$this->babySafetySeatMonthlyAED->PlaceHolder = ew_RemoveHtml($this->babySafetySeatMonthlyAED->FldCaption());
		if (strval($this->babySafetySeatMonthlyAED->EditValue) <> "" && is_numeric($this->babySafetySeatMonthlyAED->EditValue)) $this->babySafetySeatMonthlyAED->EditValue = ew_FormatNumber($this->babySafetySeatMonthlyAED->EditValue, -2, -1, -2, 0);

		// addBabySafetySeatDailyAED
		$this->addBabySafetySeatDailyAED->EditAttrs["class"] = "form-control";
		$this->addBabySafetySeatDailyAED->EditCustomAttributes = "";
		$this->addBabySafetySeatDailyAED->EditValue = $this->addBabySafetySeatDailyAED->CurrentValue;
		$this->addBabySafetySeatDailyAED->PlaceHolder = ew_RemoveHtml($this->addBabySafetySeatDailyAED->FldCaption());
		if (strval($this->addBabySafetySeatDailyAED->EditValue) <> "" && is_numeric($this->addBabySafetySeatDailyAED->EditValue)) $this->addBabySafetySeatDailyAED->EditValue = ew_FormatNumber($this->addBabySafetySeatDailyAED->EditValue, -2, -1, -2, 0);

		// addBabySafetySeatWeeklyAED
		$this->addBabySafetySeatWeeklyAED->EditAttrs["class"] = "form-control";
		$this->addBabySafetySeatWeeklyAED->EditCustomAttributes = "";
		$this->addBabySafetySeatWeeklyAED->EditValue = $this->addBabySafetySeatWeeklyAED->CurrentValue;
		$this->addBabySafetySeatWeeklyAED->PlaceHolder = ew_RemoveHtml($this->addBabySafetySeatWeeklyAED->FldCaption());
		if (strval($this->addBabySafetySeatWeeklyAED->EditValue) <> "" && is_numeric($this->addBabySafetySeatWeeklyAED->EditValue)) $this->addBabySafetySeatWeeklyAED->EditValue = ew_FormatNumber($this->addBabySafetySeatWeeklyAED->EditValue, -2, -1, -2, 0);

		// addBabySafetySeatMonthlyAED
		$this->addBabySafetySeatMonthlyAED->EditAttrs["class"] = "form-control";
		$this->addBabySafetySeatMonthlyAED->EditCustomAttributes = "";
		$this->addBabySafetySeatMonthlyAED->EditValue = $this->addBabySafetySeatMonthlyAED->CurrentValue;
		$this->addBabySafetySeatMonthlyAED->PlaceHolder = ew_RemoveHtml($this->addBabySafetySeatMonthlyAED->FldCaption());
		if (strval($this->addBabySafetySeatMonthlyAED->EditValue) <> "" && is_numeric($this->addBabySafetySeatMonthlyAED->EditValue)) $this->addBabySafetySeatMonthlyAED->EditValue = ew_FormatNumber($this->addBabySafetySeatMonthlyAED->EditValue, -2, -1, -2, 0);

		// deliveryAED
		$this->deliveryAED->EditAttrs["class"] = "form-control";
		$this->deliveryAED->EditCustomAttributes = "";
		$this->deliveryAED->EditValue = $this->deliveryAED->CurrentValue;
		$this->deliveryAED->PlaceHolder = ew_RemoveHtml($this->deliveryAED->FldCaption());
		if (strval($this->deliveryAED->EditValue) <> "" && is_numeric($this->deliveryAED->EditValue)) $this->deliveryAED->EditValue = ew_FormatNumber($this->deliveryAED->EditValue, -2, -1, -2, 0);

		// active
		$this->active->EditAttrs["class"] = "form-control";
		$this->active->EditCustomAttributes = "";
		$this->active->EditValue = $this->active->Options(TRUE);

		// phase1OrangeCard
		$this->phase1OrangeCard->EditAttrs["class"] = "form-control";
		$this->phase1OrangeCard->EditCustomAttributes = "";
		$this->phase1OrangeCard->EditValue = $this->phase1OrangeCard->CurrentValue;
		$this->phase1OrangeCard->PlaceHolder = ew_RemoveHtml($this->phase1OrangeCard->FldCaption());
		if (strval($this->phase1OrangeCard->EditValue) <> "" && is_numeric($this->phase1OrangeCard->EditValue)) $this->phase1OrangeCard->EditValue = ew_FormatNumber($this->phase1OrangeCard->EditValue, -2, -1, -2, 0);

		// phase1GPS
		$this->phase1GPS->EditAttrs["class"] = "form-control";
		$this->phase1GPS->EditCustomAttributes = "";
		$this->phase1GPS->EditValue = $this->phase1GPS->CurrentValue;
		$this->phase1GPS->PlaceHolder = ew_RemoveHtml($this->phase1GPS->FldCaption());
		if (strval($this->phase1GPS->EditValue) <> "" && is_numeric($this->phase1GPS->EditValue)) $this->phase1GPS->EditValue = ew_FormatNumber($this->phase1GPS->EditValue, -2, -1, -2, 0);

		// phase1DeliveryCharges
		$this->phase1DeliveryCharges->EditAttrs["class"] = "form-control";
		$this->phase1DeliveryCharges->EditCustomAttributes = "";
		$this->phase1DeliveryCharges->EditValue = $this->phase1DeliveryCharges->CurrentValue;
		$this->phase1DeliveryCharges->PlaceHolder = ew_RemoveHtml($this->phase1DeliveryCharges->FldCaption());
		if (strval($this->phase1DeliveryCharges->EditValue) <> "" && is_numeric($this->phase1DeliveryCharges->EditValue)) $this->phase1DeliveryCharges->EditValue = ew_FormatNumber($this->phase1DeliveryCharges->EditValue, -2, -1, -2, 0);

		// phase1CollectionCharges
		$this->phase1CollectionCharges->EditAttrs["class"] = "form-control";
		$this->phase1CollectionCharges->EditCustomAttributes = "";
		$this->phase1CollectionCharges->EditValue = $this->phase1CollectionCharges->CurrentValue;
		$this->phase1CollectionCharges->PlaceHolder = ew_RemoveHtml($this->phase1CollectionCharges->FldCaption());
		if (strval($this->phase1CollectionCharges->EditValue) <> "" && is_numeric($this->phase1CollectionCharges->EditValue)) $this->phase1CollectionCharges->EditValue = ew_FormatNumber($this->phase1CollectionCharges->EditValue, -2, -1, -2, 0);

		// addon01KM
		$this->addon01KM->EditAttrs["class"] = "form-control";
		$this->addon01KM->EditCustomAttributes = "";
		$this->addon01KM->EditValue = $this->addon01KM->CurrentValue;
		$this->addon01KM->PlaceHolder = ew_RemoveHtml($this->addon01KM->FldCaption());
		if (strval($this->addon01KM->EditValue) <> "" && is_numeric($this->addon01KM->EditValue)) $this->addon01KM->EditValue = ew_FormatNumber($this->addon01KM->EditValue, -2, -1, -2, 0);

		// addon01Price
		$this->addon01Price->EditAttrs["class"] = "form-control";
		$this->addon01Price->EditCustomAttributes = "";
		$this->addon01Price->EditValue = $this->addon01Price->CurrentValue;
		$this->addon01Price->PlaceHolder = ew_RemoveHtml($this->addon01Price->FldCaption());
		if (strval($this->addon01Price->EditValue) <> "" && is_numeric($this->addon01Price->EditValue)) $this->addon01Price->EditValue = ew_FormatNumber($this->addon01Price->EditValue, -2, -1, -2, 0);

		// addon02KM
		$this->addon02KM->EditAttrs["class"] = "form-control";
		$this->addon02KM->EditCustomAttributes = "";
		$this->addon02KM->EditValue = $this->addon02KM->CurrentValue;
		$this->addon02KM->PlaceHolder = ew_RemoveHtml($this->addon02KM->FldCaption());
		if (strval($this->addon02KM->EditValue) <> "" && is_numeric($this->addon02KM->EditValue)) $this->addon02KM->EditValue = ew_FormatNumber($this->addon02KM->EditValue, -2, -1, -2, 0);

		// addon02Price
		$this->addon02Price->EditAttrs["class"] = "form-control";
		$this->addon02Price->EditCustomAttributes = "";
		$this->addon02Price->EditValue = $this->addon02Price->CurrentValue;
		$this->addon02Price->PlaceHolder = ew_RemoveHtml($this->addon02Price->FldCaption());
		if (strval($this->addon02Price->EditValue) <> "" && is_numeric($this->addon02Price->EditValue)) $this->addon02Price->EditValue = ew_FormatNumber($this->addon02Price->EditValue, -2, -1, -2, 0);

		// addon03KM
		$this->addon03KM->EditAttrs["class"] = "form-control";
		$this->addon03KM->EditCustomAttributes = "";
		$this->addon03KM->EditValue = $this->addon03KM->CurrentValue;
		$this->addon03KM->PlaceHolder = ew_RemoveHtml($this->addon03KM->FldCaption());
		if (strval($this->addon03KM->EditValue) <> "" && is_numeric($this->addon03KM->EditValue)) $this->addon03KM->EditValue = ew_FormatNumber($this->addon03KM->EditValue, -2, -1, -2, 0);

		// addon03Price
		$this->addon03Price->EditAttrs["class"] = "form-control";
		$this->addon03Price->EditCustomAttributes = "";
		$this->addon03Price->EditValue = $this->addon03Price->CurrentValue;
		$this->addon03Price->PlaceHolder = ew_RemoveHtml($this->addon03Price->FldCaption());
		if (strval($this->addon03Price->EditValue) <> "" && is_numeric($this->addon03Price->EditValue)) $this->addon03Price->EditValue = ew_FormatNumber($this->addon03Price->EditValue, -2, -1, -2, 0);

		// addon04KM
		$this->addon04KM->EditAttrs["class"] = "form-control";
		$this->addon04KM->EditCustomAttributes = "";
		$this->addon04KM->EditValue = $this->addon04KM->CurrentValue;
		$this->addon04KM->PlaceHolder = ew_RemoveHtml($this->addon04KM->FldCaption());
		if (strval($this->addon04KM->EditValue) <> "" && is_numeric($this->addon04KM->EditValue)) $this->addon04KM->EditValue = ew_FormatNumber($this->addon04KM->EditValue, -2, -1, -2, 0);

		// addon04Price
		$this->addon04Price->EditAttrs["class"] = "form-control";
		$this->addon04Price->EditCustomAttributes = "";
		$this->addon04Price->EditValue = $this->addon04Price->CurrentValue;
		$this->addon04Price->PlaceHolder = ew_RemoveHtml($this->addon04Price->FldCaption());
		if (strval($this->addon04Price->EditValue) <> "" && is_numeric($this->addon04Price->EditValue)) $this->addon04Price->EditValue = ew_FormatNumber($this->addon04Price->EditValue, -2, -1, -2, 0);

		// addon05KM
		$this->addon05KM->EditAttrs["class"] = "form-control";
		$this->addon05KM->EditCustomAttributes = "";
		$this->addon05KM->EditValue = $this->addon05KM->CurrentValue;
		$this->addon05KM->PlaceHolder = ew_RemoveHtml($this->addon05KM->FldCaption());
		if (strval($this->addon05KM->EditValue) <> "" && is_numeric($this->addon05KM->EditValue)) $this->addon05KM->EditValue = ew_FormatNumber($this->addon05KM->EditValue, -2, -1, -2, 0);

		// addon05Price
		$this->addon05Price->EditAttrs["class"] = "form-control";
		$this->addon05Price->EditCustomAttributes = "";
		$this->addon05Price->EditValue = $this->addon05Price->CurrentValue;
		$this->addon05Price->PlaceHolder = ew_RemoveHtml($this->addon05Price->FldCaption());
		if (strval($this->addon05Price->EditValue) <> "" && is_numeric($this->addon05Price->EditValue)) $this->addon05Price->EditValue = ew_FormatNumber($this->addon05Price->EditValue, -2, -1, -2, 0);

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {

		// Call Row Rendered event
		$this->Row_Rendered();
	}
	var $ExportDoc;

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;
		if (!$Doc->ExportCustom) {

			// Write header
			$Doc->ExportTableHeader();
			if ($Doc->Horizontal) { // Horizontal format, write header
				$Doc->BeginExportRow();
				if ($ExportPageType == "view") {
					if ($this->payDriveCarID->Exportable) $Doc->ExportCaption($this->payDriveCarID);
					if ($this->bodyTypeID->Exportable) $Doc->ExportCaption($this->bodyTypeID);
					if ($this->carTitle->Exportable) $Doc->ExportCaption($this->carTitle);
					if ($this->slug->Exportable) $Doc->ExportCaption($this->slug);
					if ($this->image->Exportable) $Doc->ExportCaption($this->image);
					if ($this->extraFeatures->Exportable) $Doc->ExportCaption($this->extraFeatures);
					if ($this->noOfSeats->Exportable) $Doc->ExportCaption($this->noOfSeats);
					if ($this->luggage->Exportable) $Doc->ExportCaption($this->luggage);
					if ($this->transmissionID->Exportable) $Doc->ExportCaption($this->transmissionID);
					if ($this->ac->Exportable) $Doc->ExportCaption($this->ac);
					if ($this->noOfDoors->Exportable) $Doc->ExportCaption($this->noOfDoors);
					if ($this->s1DailyAED->Exportable) $Doc->ExportCaption($this->s1DailyAED);
					if ($this->s1DailyKM->Exportable) $Doc->ExportCaption($this->s1DailyKM);
					if ($this->s2DailyAED->Exportable) $Doc->ExportCaption($this->s2DailyAED);
					if ($this->s2DailyKM->Exportable) $Doc->ExportCaption($this->s2DailyKM);
					if ($this->s3DailyAED->Exportable) $Doc->ExportCaption($this->s3DailyAED);
					if ($this->s3DailyKM->Exportable) $Doc->ExportCaption($this->s3DailyKM);
					if ($this->s4DailyAED->Exportable) $Doc->ExportCaption($this->s4DailyAED);
					if ($this->s4DailyKM->Exportable) $Doc->ExportCaption($this->s4DailyKM);
					if ($this->s5DailyAED->Exportable) $Doc->ExportCaption($this->s5DailyAED);
					if ($this->s5DailyKM->Exportable) $Doc->ExportCaption($this->s5DailyKM);
					if ($this->s1WeeklyAED->Exportable) $Doc->ExportCaption($this->s1WeeklyAED);
					if ($this->s1WeeklyKM->Exportable) $Doc->ExportCaption($this->s1WeeklyKM);
					if ($this->s2WeeklyAED->Exportable) $Doc->ExportCaption($this->s2WeeklyAED);
					if ($this->s2WeeklyKM->Exportable) $Doc->ExportCaption($this->s2WeeklyKM);
					if ($this->s3WeeklyAED->Exportable) $Doc->ExportCaption($this->s3WeeklyAED);
					if ($this->s3WeeklyKM->Exportable) $Doc->ExportCaption($this->s3WeeklyKM);
					if ($this->s4WeeklyAED->Exportable) $Doc->ExportCaption($this->s4WeeklyAED);
					if ($this->s4WeeklyKM->Exportable) $Doc->ExportCaption($this->s4WeeklyKM);
					if ($this->s5WeeklyAED->Exportable) $Doc->ExportCaption($this->s5WeeklyAED);
					if ($this->s5WeeklyKM->Exportable) $Doc->ExportCaption($this->s5WeeklyKM);
					if ($this->s1MonthlyAED->Exportable) $Doc->ExportCaption($this->s1MonthlyAED);
					if ($this->s1MonthlyKM->Exportable) $Doc->ExportCaption($this->s1MonthlyKM);
					if ($this->s2MonthlyAED->Exportable) $Doc->ExportCaption($this->s2MonthlyAED);
					if ($this->s2MonthlyKM->Exportable) $Doc->ExportCaption($this->s2MonthlyKM);
					if ($this->s3MonthlyAED->Exportable) $Doc->ExportCaption($this->s3MonthlyAED);
					if ($this->s3MonthlyKM->Exportable) $Doc->ExportCaption($this->s3MonthlyKM);
					if ($this->s4MonthlyAED->Exportable) $Doc->ExportCaption($this->s4MonthlyAED);
					if ($this->s4MonthlyKM->Exportable) $Doc->ExportCaption($this->s4MonthlyKM);
					if ($this->s5MonthlyAED->Exportable) $Doc->ExportCaption($this->s5MonthlyAED);
					if ($this->s5MonthlyKM->Exportable) $Doc->ExportCaption($this->s5MonthlyKM);
					if ($this->active->Exportable) $Doc->ExportCaption($this->active);
					if ($this->phase1OrangeCard->Exportable) $Doc->ExportCaption($this->phase1OrangeCard);
					if ($this->phase1GPS->Exportable) $Doc->ExportCaption($this->phase1GPS);
					if ($this->phase1DeliveryCharges->Exportable) $Doc->ExportCaption($this->phase1DeliveryCharges);
					if ($this->phase1CollectionCharges->Exportable) $Doc->ExportCaption($this->phase1CollectionCharges);
					if ($this->addon01KM->Exportable) $Doc->ExportCaption($this->addon01KM);
					if ($this->addon01Price->Exportable) $Doc->ExportCaption($this->addon01Price);
					if ($this->addon02KM->Exportable) $Doc->ExportCaption($this->addon02KM);
					if ($this->addon02Price->Exportable) $Doc->ExportCaption($this->addon02Price);
					if ($this->addon03KM->Exportable) $Doc->ExportCaption($this->addon03KM);
					if ($this->addon03Price->Exportable) $Doc->ExportCaption($this->addon03Price);
					if ($this->addon04KM->Exportable) $Doc->ExportCaption($this->addon04KM);
					if ($this->addon04Price->Exportable) $Doc->ExportCaption($this->addon04Price);
					if ($this->addon05KM->Exportable) $Doc->ExportCaption($this->addon05KM);
					if ($this->addon05Price->Exportable) $Doc->ExportCaption($this->addon05Price);
				} else {
					if ($this->payDriveCarID->Exportable) $Doc->ExportCaption($this->payDriveCarID);
					if ($this->bodyTypeID->Exportable) $Doc->ExportCaption($this->bodyTypeID);
					if ($this->carTitle->Exportable) $Doc->ExportCaption($this->carTitle);
					if ($this->slug->Exportable) $Doc->ExportCaption($this->slug);
					if ($this->image->Exportable) $Doc->ExportCaption($this->image);
					if ($this->extraFeatures->Exportable) $Doc->ExportCaption($this->extraFeatures);
					if ($this->noOfSeats->Exportable) $Doc->ExportCaption($this->noOfSeats);
					if ($this->luggage->Exportable) $Doc->ExportCaption($this->luggage);
					if ($this->transmissionID->Exportable) $Doc->ExportCaption($this->transmissionID);
					if ($this->ac->Exportable) $Doc->ExportCaption($this->ac);
					if ($this->noOfDoors->Exportable) $Doc->ExportCaption($this->noOfDoors);
					if ($this->s1DailyAED->Exportable) $Doc->ExportCaption($this->s1DailyAED);
					if ($this->s1DailyKM->Exportable) $Doc->ExportCaption($this->s1DailyKM);
					if ($this->s2DailyAED->Exportable) $Doc->ExportCaption($this->s2DailyAED);
					if ($this->s2DailyKM->Exportable) $Doc->ExportCaption($this->s2DailyKM);
					if ($this->s3DailyAED->Exportable) $Doc->ExportCaption($this->s3DailyAED);
					if ($this->s3DailyKM->Exportable) $Doc->ExportCaption($this->s3DailyKM);
					if ($this->s4DailyAED->Exportable) $Doc->ExportCaption($this->s4DailyAED);
					if ($this->s4DailyKM->Exportable) $Doc->ExportCaption($this->s4DailyKM);
					if ($this->s5DailyAED->Exportable) $Doc->ExportCaption($this->s5DailyAED);
					if ($this->s5DailyKM->Exportable) $Doc->ExportCaption($this->s5DailyKM);
					if ($this->s1WeeklyAED->Exportable) $Doc->ExportCaption($this->s1WeeklyAED);
					if ($this->s1WeeklyKM->Exportable) $Doc->ExportCaption($this->s1WeeklyKM);
					if ($this->s2WeeklyAED->Exportable) $Doc->ExportCaption($this->s2WeeklyAED);
					if ($this->s2WeeklyKM->Exportable) $Doc->ExportCaption($this->s2WeeklyKM);
					if ($this->s3WeeklyAED->Exportable) $Doc->ExportCaption($this->s3WeeklyAED);
					if ($this->s3WeeklyKM->Exportable) $Doc->ExportCaption($this->s3WeeklyKM);
					if ($this->s4WeeklyAED->Exportable) $Doc->ExportCaption($this->s4WeeklyAED);
					if ($this->s4WeeklyKM->Exportable) $Doc->ExportCaption($this->s4WeeklyKM);
					if ($this->s5WeeklyAED->Exportable) $Doc->ExportCaption($this->s5WeeklyAED);
					if ($this->s5WeeklyKM->Exportable) $Doc->ExportCaption($this->s5WeeklyKM);
					if ($this->s1MonthlyAED->Exportable) $Doc->ExportCaption($this->s1MonthlyAED);
					if ($this->s1MonthlyKM->Exportable) $Doc->ExportCaption($this->s1MonthlyKM);
					if ($this->s2MonthlyAED->Exportable) $Doc->ExportCaption($this->s2MonthlyAED);
					if ($this->s2MonthlyKM->Exportable) $Doc->ExportCaption($this->s2MonthlyKM);
					if ($this->s3MonthlyAED->Exportable) $Doc->ExportCaption($this->s3MonthlyAED);
					if ($this->s3MonthlyKM->Exportable) $Doc->ExportCaption($this->s3MonthlyKM);
					if ($this->s4MonthlyAED->Exportable) $Doc->ExportCaption($this->s4MonthlyAED);
					if ($this->s4MonthlyKM->Exportable) $Doc->ExportCaption($this->s4MonthlyKM);
					if ($this->s5MonthlyAED->Exportable) $Doc->ExportCaption($this->s5MonthlyAED);
					if ($this->s5MonthlyKM->Exportable) $Doc->ExportCaption($this->s5MonthlyKM);
					if ($this->active->Exportable) $Doc->ExportCaption($this->active);
					if ($this->phase1OrangeCard->Exportable) $Doc->ExportCaption($this->phase1OrangeCard);
					if ($this->phase1GPS->Exportable) $Doc->ExportCaption($this->phase1GPS);
					if ($this->phase1DeliveryCharges->Exportable) $Doc->ExportCaption($this->phase1DeliveryCharges);
					if ($this->phase1CollectionCharges->Exportable) $Doc->ExportCaption($this->phase1CollectionCharges);
					if ($this->addon01KM->Exportable) $Doc->ExportCaption($this->addon01KM);
					if ($this->addon01Price->Exportable) $Doc->ExportCaption($this->addon01Price);
					if ($this->addon02KM->Exportable) $Doc->ExportCaption($this->addon02KM);
					if ($this->addon02Price->Exportable) $Doc->ExportCaption($this->addon02Price);
					if ($this->addon03KM->Exportable) $Doc->ExportCaption($this->addon03KM);
					if ($this->addon03Price->Exportable) $Doc->ExportCaption($this->addon03Price);
					if ($this->addon04KM->Exportable) $Doc->ExportCaption($this->addon04KM);
					if ($this->addon04Price->Exportable) $Doc->ExportCaption($this->addon04Price);
					if ($this->addon05KM->Exportable) $Doc->ExportCaption($this->addon05KM);
					if ($this->addon05Price->Exportable) $Doc->ExportCaption($this->addon05Price);
				}
				$Doc->EndExportRow();
			}
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				if (!$Doc->ExportCustom) {
					$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
					if ($ExportPageType == "view") {
						if ($this->payDriveCarID->Exportable) $Doc->ExportField($this->payDriveCarID);
						if ($this->bodyTypeID->Exportable) $Doc->ExportField($this->bodyTypeID);
						if ($this->carTitle->Exportable) $Doc->ExportField($this->carTitle);
						if ($this->slug->Exportable) $Doc->ExportField($this->slug);
						if ($this->image->Exportable) $Doc->ExportField($this->image);
						if ($this->extraFeatures->Exportable) $Doc->ExportField($this->extraFeatures);
						if ($this->noOfSeats->Exportable) $Doc->ExportField($this->noOfSeats);
						if ($this->luggage->Exportable) $Doc->ExportField($this->luggage);
						if ($this->transmissionID->Exportable) $Doc->ExportField($this->transmissionID);
						if ($this->ac->Exportable) $Doc->ExportField($this->ac);
						if ($this->noOfDoors->Exportable) $Doc->ExportField($this->noOfDoors);
						if ($this->s1DailyAED->Exportable) $Doc->ExportField($this->s1DailyAED);
						if ($this->s1DailyKM->Exportable) $Doc->ExportField($this->s1DailyKM);
						if ($this->s2DailyAED->Exportable) $Doc->ExportField($this->s2DailyAED);
						if ($this->s2DailyKM->Exportable) $Doc->ExportField($this->s2DailyKM);
						if ($this->s3DailyAED->Exportable) $Doc->ExportField($this->s3DailyAED);
						if ($this->s3DailyKM->Exportable) $Doc->ExportField($this->s3DailyKM);
						if ($this->s4DailyAED->Exportable) $Doc->ExportField($this->s4DailyAED);
						if ($this->s4DailyKM->Exportable) $Doc->ExportField($this->s4DailyKM);
						if ($this->s5DailyAED->Exportable) $Doc->ExportField($this->s5DailyAED);
						if ($this->s5DailyKM->Exportable) $Doc->ExportField($this->s5DailyKM);
						if ($this->s1WeeklyAED->Exportable) $Doc->ExportField($this->s1WeeklyAED);
						if ($this->s1WeeklyKM->Exportable) $Doc->ExportField($this->s1WeeklyKM);
						if ($this->s2WeeklyAED->Exportable) $Doc->ExportField($this->s2WeeklyAED);
						if ($this->s2WeeklyKM->Exportable) $Doc->ExportField($this->s2WeeklyKM);
						if ($this->s3WeeklyAED->Exportable) $Doc->ExportField($this->s3WeeklyAED);
						if ($this->s3WeeklyKM->Exportable) $Doc->ExportField($this->s3WeeklyKM);
						if ($this->s4WeeklyAED->Exportable) $Doc->ExportField($this->s4WeeklyAED);
						if ($this->s4WeeklyKM->Exportable) $Doc->ExportField($this->s4WeeklyKM);
						if ($this->s5WeeklyAED->Exportable) $Doc->ExportField($this->s5WeeklyAED);
						if ($this->s5WeeklyKM->Exportable) $Doc->ExportField($this->s5WeeklyKM);
						if ($this->s1MonthlyAED->Exportable) $Doc->ExportField($this->s1MonthlyAED);
						if ($this->s1MonthlyKM->Exportable) $Doc->ExportField($this->s1MonthlyKM);
						if ($this->s2MonthlyAED->Exportable) $Doc->ExportField($this->s2MonthlyAED);
						if ($this->s2MonthlyKM->Exportable) $Doc->ExportField($this->s2MonthlyKM);
						if ($this->s3MonthlyAED->Exportable) $Doc->ExportField($this->s3MonthlyAED);
						if ($this->s3MonthlyKM->Exportable) $Doc->ExportField($this->s3MonthlyKM);
						if ($this->s4MonthlyAED->Exportable) $Doc->ExportField($this->s4MonthlyAED);
						if ($this->s4MonthlyKM->Exportable) $Doc->ExportField($this->s4MonthlyKM);
						if ($this->s5MonthlyAED->Exportable) $Doc->ExportField($this->s5MonthlyAED);
						if ($this->s5MonthlyKM->Exportable) $Doc->ExportField($this->s5MonthlyKM);
						if ($this->active->Exportable) $Doc->ExportField($this->active);
						if ($this->phase1OrangeCard->Exportable) $Doc->ExportField($this->phase1OrangeCard);
						if ($this->phase1GPS->Exportable) $Doc->ExportField($this->phase1GPS);
						if ($this->phase1DeliveryCharges->Exportable) $Doc->ExportField($this->phase1DeliveryCharges);
						if ($this->phase1CollectionCharges->Exportable) $Doc->ExportField($this->phase1CollectionCharges);
						if ($this->addon01KM->Exportable) $Doc->ExportField($this->addon01KM);
						if ($this->addon01Price->Exportable) $Doc->ExportField($this->addon01Price);
						if ($this->addon02KM->Exportable) $Doc->ExportField($this->addon02KM);
						if ($this->addon02Price->Exportable) $Doc->ExportField($this->addon02Price);
						if ($this->addon03KM->Exportable) $Doc->ExportField($this->addon03KM);
						if ($this->addon03Price->Exportable) $Doc->ExportField($this->addon03Price);
						if ($this->addon04KM->Exportable) $Doc->ExportField($this->addon04KM);
						if ($this->addon04Price->Exportable) $Doc->ExportField($this->addon04Price);
						if ($this->addon05KM->Exportable) $Doc->ExportField($this->addon05KM);
						if ($this->addon05Price->Exportable) $Doc->ExportField($this->addon05Price);
					} else {
						if ($this->payDriveCarID->Exportable) $Doc->ExportField($this->payDriveCarID);
						if ($this->bodyTypeID->Exportable) $Doc->ExportField($this->bodyTypeID);
						if ($this->carTitle->Exportable) $Doc->ExportField($this->carTitle);
						if ($this->slug->Exportable) $Doc->ExportField($this->slug);
						if ($this->image->Exportable) $Doc->ExportField($this->image);
						if ($this->extraFeatures->Exportable) $Doc->ExportField($this->extraFeatures);
						if ($this->noOfSeats->Exportable) $Doc->ExportField($this->noOfSeats);
						if ($this->luggage->Exportable) $Doc->ExportField($this->luggage);
						if ($this->transmissionID->Exportable) $Doc->ExportField($this->transmissionID);
						if ($this->ac->Exportable) $Doc->ExportField($this->ac);
						if ($this->noOfDoors->Exportable) $Doc->ExportField($this->noOfDoors);
						if ($this->s1DailyAED->Exportable) $Doc->ExportField($this->s1DailyAED);
						if ($this->s1DailyKM->Exportable) $Doc->ExportField($this->s1DailyKM);
						if ($this->s2DailyAED->Exportable) $Doc->ExportField($this->s2DailyAED);
						if ($this->s2DailyKM->Exportable) $Doc->ExportField($this->s2DailyKM);
						if ($this->s3DailyAED->Exportable) $Doc->ExportField($this->s3DailyAED);
						if ($this->s3DailyKM->Exportable) $Doc->ExportField($this->s3DailyKM);
						if ($this->s4DailyAED->Exportable) $Doc->ExportField($this->s4DailyAED);
						if ($this->s4DailyKM->Exportable) $Doc->ExportField($this->s4DailyKM);
						if ($this->s5DailyAED->Exportable) $Doc->ExportField($this->s5DailyAED);
						if ($this->s5DailyKM->Exportable) $Doc->ExportField($this->s5DailyKM);
						if ($this->s1WeeklyAED->Exportable) $Doc->ExportField($this->s1WeeklyAED);
						if ($this->s1WeeklyKM->Exportable) $Doc->ExportField($this->s1WeeklyKM);
						if ($this->s2WeeklyAED->Exportable) $Doc->ExportField($this->s2WeeklyAED);
						if ($this->s2WeeklyKM->Exportable) $Doc->ExportField($this->s2WeeklyKM);
						if ($this->s3WeeklyAED->Exportable) $Doc->ExportField($this->s3WeeklyAED);
						if ($this->s3WeeklyKM->Exportable) $Doc->ExportField($this->s3WeeklyKM);
						if ($this->s4WeeklyAED->Exportable) $Doc->ExportField($this->s4WeeklyAED);
						if ($this->s4WeeklyKM->Exportable) $Doc->ExportField($this->s4WeeklyKM);
						if ($this->s5WeeklyAED->Exportable) $Doc->ExportField($this->s5WeeklyAED);
						if ($this->s5WeeklyKM->Exportable) $Doc->ExportField($this->s5WeeklyKM);
						if ($this->s1MonthlyAED->Exportable) $Doc->ExportField($this->s1MonthlyAED);
						if ($this->s1MonthlyKM->Exportable) $Doc->ExportField($this->s1MonthlyKM);
						if ($this->s2MonthlyAED->Exportable) $Doc->ExportField($this->s2MonthlyAED);
						if ($this->s2MonthlyKM->Exportable) $Doc->ExportField($this->s2MonthlyKM);
						if ($this->s3MonthlyAED->Exportable) $Doc->ExportField($this->s3MonthlyAED);
						if ($this->s3MonthlyKM->Exportable) $Doc->ExportField($this->s3MonthlyKM);
						if ($this->s4MonthlyAED->Exportable) $Doc->ExportField($this->s4MonthlyAED);
						if ($this->s4MonthlyKM->Exportable) $Doc->ExportField($this->s4MonthlyKM);
						if ($this->s5MonthlyAED->Exportable) $Doc->ExportField($this->s5MonthlyAED);
						if ($this->s5MonthlyKM->Exportable) $Doc->ExportField($this->s5MonthlyKM);
						if ($this->active->Exportable) $Doc->ExportField($this->active);
						if ($this->phase1OrangeCard->Exportable) $Doc->ExportField($this->phase1OrangeCard);
						if ($this->phase1GPS->Exportable) $Doc->ExportField($this->phase1GPS);
						if ($this->phase1DeliveryCharges->Exportable) $Doc->ExportField($this->phase1DeliveryCharges);
						if ($this->phase1CollectionCharges->Exportable) $Doc->ExportField($this->phase1CollectionCharges);
						if ($this->addon01KM->Exportable) $Doc->ExportField($this->addon01KM);
						if ($this->addon01Price->Exportable) $Doc->ExportField($this->addon01Price);
						if ($this->addon02KM->Exportable) $Doc->ExportField($this->addon02KM);
						if ($this->addon02Price->Exportable) $Doc->ExportField($this->addon02Price);
						if ($this->addon03KM->Exportable) $Doc->ExportField($this->addon03KM);
						if ($this->addon03Price->Exportable) $Doc->ExportField($this->addon03Price);
						if ($this->addon04KM->Exportable) $Doc->ExportField($this->addon04KM);
						if ($this->addon04Price->Exportable) $Doc->ExportField($this->addon04Price);
						if ($this->addon05KM->Exportable) $Doc->ExportField($this->addon05KM);
						if ($this->addon05Price->Exportable) $Doc->ExportField($this->addon05Price);
					}
					$Doc->EndExportRow($RowCnt);
				}
			}

			// Call Row Export server event
			if ($Doc->ExportCustom)
				$this->Row_Export($Recordset->fields);
			$Recordset->MoveNext();
		}
		if (!$Doc->ExportCustom) {
			$Doc->ExportTableFooter();
		}
	}

	// Get auto fill value
	function GetAutoFill($id, $val) {
		$rsarr = array();
		$rowcnt = 0;

		// Output
		if (is_array($rsarr) && $rowcnt > 0) {
			$fldcnt = count($rsarr[0]);
			for ($i = 0; $i < $rowcnt; $i++) {
				for ($j = 0; $j < $fldcnt; $j++) {
					$str = strval($rsarr[$i][$j]);
					$str = ew_ConvertToUtf8($str);
					if (isset($post["keepCRLF"])) {
						$str = str_replace(array("\r", "\n"), array("\\r", "\\n"), $str);
					} else {
						$str = str_replace(array("\r", "\n"), array(" ", " "), $str);
					}
					$rsarr[$i][$j] = $str;
				}
			}
			return ew_ArrayToJson($rsarr);
		} else {
			return FALSE;
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->FldName, $fld->LookupFilters, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>
