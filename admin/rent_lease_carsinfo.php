<?php

// Global variable for table object
$rent_lease_cars = NULL;

//
// Table class for rent_lease_cars
//
class crent_lease_cars extends cTable {
	var $rentLeaseCarID;
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
	var $deliveryAED;
	var $dailyAED;
	var $dailyDummyAED;
	var $weeklyAED;
	var $weeklyDummyAED;
	var $monthlyAED;
	var $monthlyDummyAED;
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
	var $active;
	var $phase1OrangeCard;
	var $phase1GPS;
	var $phase1DeliveryCharges;
	var $phase1CollectionCharges;
	var $weeklyDeals;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'rent_lease_cars';
		$this->TableName = 'rent_lease_cars';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`rent_lease_cars`";
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

		// rentLeaseCarID
		$this->rentLeaseCarID = new cField('rent_lease_cars', 'rent_lease_cars', 'x_rentLeaseCarID', 'rentLeaseCarID', '`rentLeaseCarID`', '`rentLeaseCarID`', 3, -1, FALSE, '`rentLeaseCarID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->rentLeaseCarID->Sortable = TRUE; // Allow sort
		$this->rentLeaseCarID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['rentLeaseCarID'] = &$this->rentLeaseCarID;

		// bodyTypeID
		$this->bodyTypeID = new cField('rent_lease_cars', 'rent_lease_cars', 'x_bodyTypeID', 'bodyTypeID', '`bodyTypeID`', '`bodyTypeID`', 3, -1, FALSE, '`bodyTypeID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->bodyTypeID->Sortable = TRUE; // Allow sort
		$this->bodyTypeID->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->bodyTypeID->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->bodyTypeID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['bodyTypeID'] = &$this->bodyTypeID;

		// carTitle
		$this->carTitle = new cField('rent_lease_cars', 'rent_lease_cars', 'x_carTitle', 'carTitle', '`carTitle`', '`carTitle`', 200, -1, FALSE, '`carTitle`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->carTitle->Sortable = TRUE; // Allow sort
		$this->fields['carTitle'] = &$this->carTitle;

		// slug
		$this->slug = new cField('rent_lease_cars', 'rent_lease_cars', 'x_slug', 'slug', '`slug`', '`slug`', 200, -1, FALSE, '`slug`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->slug->Sortable = TRUE; // Allow sort
		$this->fields['slug'] = &$this->slug;

		// image
		$this->image = new cField('rent_lease_cars', 'rent_lease_cars', 'x_image', 'image', '`image`', '`image`', 200, -1, TRUE, '`image`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->image->Sortable = TRUE; // Allow sort
		$this->fields['image'] = &$this->image;

		// extraFeatures
		$this->extraFeatures = new cField('rent_lease_cars', 'rent_lease_cars', 'x_extraFeatures', 'extraFeatures', '`extraFeatures`', '`extraFeatures`', 200, -1, FALSE, '`extraFeatures`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->extraFeatures->Sortable = TRUE; // Allow sort
		$this->fields['extraFeatures'] = &$this->extraFeatures;

		// noOfSeats
		$this->noOfSeats = new cField('rent_lease_cars', 'rent_lease_cars', 'x_noOfSeats', 'noOfSeats', '`noOfSeats`', '`noOfSeats`', 3, -1, FALSE, '`noOfSeats`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->noOfSeats->Sortable = TRUE; // Allow sort
		$this->noOfSeats->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['noOfSeats'] = &$this->noOfSeats;

		// luggage
		$this->luggage = new cField('rent_lease_cars', 'rent_lease_cars', 'x_luggage', 'luggage', '`luggage`', '`luggage`', 3, -1, FALSE, '`luggage`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->luggage->Sortable = TRUE; // Allow sort
		$this->luggage->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['luggage'] = &$this->luggage;

		// transmissionID
		$this->transmissionID = new cField('rent_lease_cars', 'rent_lease_cars', 'x_transmissionID', 'transmissionID', '`transmissionID`', '`transmissionID`', 3, -1, FALSE, '`transmissionID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->transmissionID->Sortable = TRUE; // Allow sort
		$this->transmissionID->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->transmissionID->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->transmissionID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['transmissionID'] = &$this->transmissionID;

		// ac
		$this->ac = new cField('rent_lease_cars', 'rent_lease_cars', 'x_ac', 'ac', '`ac`', '`ac`', 202, -1, FALSE, '`ac`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->ac->Sortable = TRUE; // Allow sort
		$this->ac->FldDataType = EW_DATATYPE_BOOLEAN;
		$this->ac->TrueValue = 'Y';
		$this->ac->FalseValue = 'N';
		$this->ac->OptionCount = 2;
		$this->fields['ac'] = &$this->ac;

		// noOfDoors
		$this->noOfDoors = new cField('rent_lease_cars', 'rent_lease_cars', 'x_noOfDoors', 'noOfDoors', '`noOfDoors`', '`noOfDoors`', 3, -1, FALSE, '`noOfDoors`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->noOfDoors->Sortable = TRUE; // Allow sort
		$this->noOfDoors->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['noOfDoors'] = &$this->noOfDoors;

		// deliveryAED
		$this->deliveryAED = new cField('rent_lease_cars', 'rent_lease_cars', 'x_deliveryAED', 'deliveryAED', '`deliveryAED`', '`deliveryAED`', 131, -1, FALSE, '`deliveryAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->deliveryAED->Sortable = TRUE; // Allow sort
		$this->deliveryAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['deliveryAED'] = &$this->deliveryAED;

		// dailyAED
		$this->dailyAED = new cField('rent_lease_cars', 'rent_lease_cars', 'x_dailyAED', 'dailyAED', '`dailyAED`', '`dailyAED`', 131, -1, FALSE, '`dailyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->dailyAED->Sortable = TRUE; // Allow sort
		$this->dailyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['dailyAED'] = &$this->dailyAED;

		// dailyDummyAED
		$this->dailyDummyAED = new cField('rent_lease_cars', 'rent_lease_cars', 'x_dailyDummyAED', 'dailyDummyAED', '`dailyDummyAED`', '`dailyDummyAED`', 131, -1, FALSE, '`dailyDummyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->dailyDummyAED->Sortable = TRUE; // Allow sort
		$this->dailyDummyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['dailyDummyAED'] = &$this->dailyDummyAED;

		// weeklyAED
		$this->weeklyAED = new cField('rent_lease_cars', 'rent_lease_cars', 'x_weeklyAED', 'weeklyAED', '`weeklyAED`', '`weeklyAED`', 131, -1, FALSE, '`weeklyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->weeklyAED->Sortable = TRUE; // Allow sort
		$this->weeklyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['weeklyAED'] = &$this->weeklyAED;

		// weeklyDummyAED
		$this->weeklyDummyAED = new cField('rent_lease_cars', 'rent_lease_cars', 'x_weeklyDummyAED', 'weeklyDummyAED', '`weeklyDummyAED`', '`weeklyDummyAED`', 131, -1, FALSE, '`weeklyDummyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->weeklyDummyAED->Sortable = TRUE; // Allow sort
		$this->weeklyDummyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['weeklyDummyAED'] = &$this->weeklyDummyAED;

		// monthlyAED
		$this->monthlyAED = new cField('rent_lease_cars', 'rent_lease_cars', 'x_monthlyAED', 'monthlyAED', '`monthlyAED`', '`monthlyAED`', 131, -1, FALSE, '`monthlyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->monthlyAED->Sortable = TRUE; // Allow sort
		$this->monthlyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['monthlyAED'] = &$this->monthlyAED;

		// monthlyDummyAED
		$this->monthlyDummyAED = new cField('rent_lease_cars', 'rent_lease_cars', 'x_monthlyDummyAED', 'monthlyDummyAED', '`monthlyDummyAED`', '`monthlyDummyAED`', 131, -1, FALSE, '`monthlyDummyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->monthlyDummyAED->Sortable = TRUE; // Allow sort
		$this->monthlyDummyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['monthlyDummyAED'] = &$this->monthlyDummyAED;

		// scdwDailyAED
		$this->scdwDailyAED = new cField('rent_lease_cars', 'rent_lease_cars', 'x_scdwDailyAED', 'scdwDailyAED', '`scdwDailyAED`', '`scdwDailyAED`', 131, -1, FALSE, '`scdwDailyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->scdwDailyAED->Sortable = FALSE; // Allow sort
		$this->scdwDailyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['scdwDailyAED'] = &$this->scdwDailyAED;

		// scdwWeeklyAED
		$this->scdwWeeklyAED = new cField('rent_lease_cars', 'rent_lease_cars', 'x_scdwWeeklyAED', 'scdwWeeklyAED', '`scdwWeeklyAED`', '`scdwWeeklyAED`', 131, -1, FALSE, '`scdwWeeklyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->scdwWeeklyAED->Sortable = FALSE; // Allow sort
		$this->scdwWeeklyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['scdwWeeklyAED'] = &$this->scdwWeeklyAED;

		// scdwMonthlyAED
		$this->scdwMonthlyAED = new cField('rent_lease_cars', 'rent_lease_cars', 'x_scdwMonthlyAED', 'scdwMonthlyAED', '`scdwMonthlyAED`', '`scdwMonthlyAED`', 131, -1, FALSE, '`scdwMonthlyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->scdwMonthlyAED->Sortable = FALSE; // Allow sort
		$this->scdwMonthlyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['scdwMonthlyAED'] = &$this->scdwMonthlyAED;

		// cdwDailyAED
		$this->cdwDailyAED = new cField('rent_lease_cars', 'rent_lease_cars', 'x_cdwDailyAED', 'cdwDailyAED', '`cdwDailyAED`', '`cdwDailyAED`', 131, -1, FALSE, '`cdwDailyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cdwDailyAED->Sortable = FALSE; // Allow sort
		$this->cdwDailyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['cdwDailyAED'] = &$this->cdwDailyAED;

		// cdwWeeklyAED
		$this->cdwWeeklyAED = new cField('rent_lease_cars', 'rent_lease_cars', 'x_cdwWeeklyAED', 'cdwWeeklyAED', '`cdwWeeklyAED`', '`cdwWeeklyAED`', 131, -1, FALSE, '`cdwWeeklyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cdwWeeklyAED->Sortable = FALSE; // Allow sort
		$this->cdwWeeklyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['cdwWeeklyAED'] = &$this->cdwWeeklyAED;

		// cdwMonthlyAED
		$this->cdwMonthlyAED = new cField('rent_lease_cars', 'rent_lease_cars', 'x_cdwMonthlyAED', 'cdwMonthlyAED', '`cdwMonthlyAED`', '`cdwMonthlyAED`', 131, -1, FALSE, '`cdwMonthlyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cdwMonthlyAED->Sortable = FALSE; // Allow sort
		$this->cdwMonthlyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['cdwMonthlyAED'] = &$this->cdwMonthlyAED;

		// paiDailyAED
		$this->paiDailyAED = new cField('rent_lease_cars', 'rent_lease_cars', 'x_paiDailyAED', 'paiDailyAED', '`paiDailyAED`', '`paiDailyAED`', 131, -1, FALSE, '`paiDailyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->paiDailyAED->Sortable = FALSE; // Allow sort
		$this->paiDailyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['paiDailyAED'] = &$this->paiDailyAED;

		// paiWeeklyAED
		$this->paiWeeklyAED = new cField('rent_lease_cars', 'rent_lease_cars', 'x_paiWeeklyAED', 'paiWeeklyAED', '`paiWeeklyAED`', '`paiWeeklyAED`', 131, -1, FALSE, '`paiWeeklyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->paiWeeklyAED->Sortable = FALSE; // Allow sort
		$this->paiWeeklyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['paiWeeklyAED'] = &$this->paiWeeklyAED;

		// paiMonthlyAED
		$this->paiMonthlyAED = new cField('rent_lease_cars', 'rent_lease_cars', 'x_paiMonthlyAED', 'paiMonthlyAED', '`paiMonthlyAED`', '`paiMonthlyAED`', 131, -1, FALSE, '`paiMonthlyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->paiMonthlyAED->Sortable = FALSE; // Allow sort
		$this->paiMonthlyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['paiMonthlyAED'] = &$this->paiMonthlyAED;

		// gpsDailyAED
		$this->gpsDailyAED = new cField('rent_lease_cars', 'rent_lease_cars', 'x_gpsDailyAED', 'gpsDailyAED', '`gpsDailyAED`', '`gpsDailyAED`', 131, -1, FALSE, '`gpsDailyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->gpsDailyAED->Sortable = FALSE; // Allow sort
		$this->gpsDailyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['gpsDailyAED'] = &$this->gpsDailyAED;

		// gpsWeeklyAED
		$this->gpsWeeklyAED = new cField('rent_lease_cars', 'rent_lease_cars', 'x_gpsWeeklyAED', 'gpsWeeklyAED', '`gpsWeeklyAED`', '`gpsWeeklyAED`', 131, -1, FALSE, '`gpsWeeklyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->gpsWeeklyAED->Sortable = FALSE; // Allow sort
		$this->gpsWeeklyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['gpsWeeklyAED'] = &$this->gpsWeeklyAED;

		// gpsMonthlyAED
		$this->gpsMonthlyAED = new cField('rent_lease_cars', 'rent_lease_cars', 'x_gpsMonthlyAED', 'gpsMonthlyAED', '`gpsMonthlyAED`', '`gpsMonthlyAED`', 131, -1, FALSE, '`gpsMonthlyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->gpsMonthlyAED->Sortable = FALSE; // Allow sort
		$this->gpsMonthlyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['gpsMonthlyAED'] = &$this->gpsMonthlyAED;

		// additionalDriverDailyAED
		$this->additionalDriverDailyAED = new cField('rent_lease_cars', 'rent_lease_cars', 'x_additionalDriverDailyAED', 'additionalDriverDailyAED', '`additionalDriverDailyAED`', '`additionalDriverDailyAED`', 131, -1, FALSE, '`additionalDriverDailyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->additionalDriverDailyAED->Sortable = FALSE; // Allow sort
		$this->additionalDriverDailyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['additionalDriverDailyAED'] = &$this->additionalDriverDailyAED;

		// additionalDriverWeeklyAED
		$this->additionalDriverWeeklyAED = new cField('rent_lease_cars', 'rent_lease_cars', 'x_additionalDriverWeeklyAED', 'additionalDriverWeeklyAED', '`additionalDriverWeeklyAED`', '`additionalDriverWeeklyAED`', 131, -1, FALSE, '`additionalDriverWeeklyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->additionalDriverWeeklyAED->Sortable = FALSE; // Allow sort
		$this->additionalDriverWeeklyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['additionalDriverWeeklyAED'] = &$this->additionalDriverWeeklyAED;

		// additionalDriverMonthlyAED
		$this->additionalDriverMonthlyAED = new cField('rent_lease_cars', 'rent_lease_cars', 'x_additionalDriverMonthlyAED', 'additionalDriverMonthlyAED', '`additionalDriverMonthlyAED`', '`additionalDriverMonthlyAED`', 131, -1, FALSE, '`additionalDriverMonthlyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->additionalDriverMonthlyAED->Sortable = FALSE; // Allow sort
		$this->additionalDriverMonthlyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['additionalDriverMonthlyAED'] = &$this->additionalDriverMonthlyAED;

		// babySafetySeatDailyAED
		$this->babySafetySeatDailyAED = new cField('rent_lease_cars', 'rent_lease_cars', 'x_babySafetySeatDailyAED', 'babySafetySeatDailyAED', '`babySafetySeatDailyAED`', '`babySafetySeatDailyAED`', 131, -1, FALSE, '`babySafetySeatDailyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->babySafetySeatDailyAED->Sortable = FALSE; // Allow sort
		$this->babySafetySeatDailyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['babySafetySeatDailyAED'] = &$this->babySafetySeatDailyAED;

		// babySafetySeatWeeklyAED
		$this->babySafetySeatWeeklyAED = new cField('rent_lease_cars', 'rent_lease_cars', 'x_babySafetySeatWeeklyAED', 'babySafetySeatWeeklyAED', '`babySafetySeatWeeklyAED`', '`babySafetySeatWeeklyAED`', 131, -1, FALSE, '`babySafetySeatWeeklyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->babySafetySeatWeeklyAED->Sortable = FALSE; // Allow sort
		$this->babySafetySeatWeeklyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['babySafetySeatWeeklyAED'] = &$this->babySafetySeatWeeklyAED;

		// babySafetySeatMonthlyAED
		$this->babySafetySeatMonthlyAED = new cField('rent_lease_cars', 'rent_lease_cars', 'x_babySafetySeatMonthlyAED', 'babySafetySeatMonthlyAED', '`babySafetySeatMonthlyAED`', '`babySafetySeatMonthlyAED`', 131, -1, FALSE, '`babySafetySeatMonthlyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->babySafetySeatMonthlyAED->Sortable = FALSE; // Allow sort
		$this->babySafetySeatMonthlyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['babySafetySeatMonthlyAED'] = &$this->babySafetySeatMonthlyAED;

		// addBabySafetySeatDailyAED
		$this->addBabySafetySeatDailyAED = new cField('rent_lease_cars', 'rent_lease_cars', 'x_addBabySafetySeatDailyAED', 'addBabySafetySeatDailyAED', '`addBabySafetySeatDailyAED`', '`addBabySafetySeatDailyAED`', 131, -1, FALSE, '`addBabySafetySeatDailyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->addBabySafetySeatDailyAED->Sortable = FALSE; // Allow sort
		$this->addBabySafetySeatDailyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['addBabySafetySeatDailyAED'] = &$this->addBabySafetySeatDailyAED;

		// addBabySafetySeatWeeklyAED
		$this->addBabySafetySeatWeeklyAED = new cField('rent_lease_cars', 'rent_lease_cars', 'x_addBabySafetySeatWeeklyAED', 'addBabySafetySeatWeeklyAED', '`addBabySafetySeatWeeklyAED`', '`addBabySafetySeatWeeklyAED`', 131, -1, FALSE, '`addBabySafetySeatWeeklyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->addBabySafetySeatWeeklyAED->Sortable = FALSE; // Allow sort
		$this->addBabySafetySeatWeeklyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['addBabySafetySeatWeeklyAED'] = &$this->addBabySafetySeatWeeklyAED;

		// addBabySafetySeatMonthlyAED
		$this->addBabySafetySeatMonthlyAED = new cField('rent_lease_cars', 'rent_lease_cars', 'x_addBabySafetySeatMonthlyAED', 'addBabySafetySeatMonthlyAED', '`addBabySafetySeatMonthlyAED`', '`addBabySafetySeatMonthlyAED`', 131, -1, FALSE, '`addBabySafetySeatMonthlyAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->addBabySafetySeatMonthlyAED->Sortable = FALSE; // Allow sort
		$this->addBabySafetySeatMonthlyAED->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['addBabySafetySeatMonthlyAED'] = &$this->addBabySafetySeatMonthlyAED;

		// active
		$this->active = new cField('rent_lease_cars', 'rent_lease_cars', 'x_active', 'active', '`active`', '`active`', 16, -1, FALSE, '`active`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->active->Sortable = TRUE; // Allow sort
		$this->active->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->active->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->active->OptionCount = 2;
		$this->active->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['active'] = &$this->active;

		// phase1OrangeCard
		$this->phase1OrangeCard = new cField('rent_lease_cars', 'rent_lease_cars', 'x_phase1OrangeCard', 'phase1OrangeCard', '`phase1OrangeCard`', '`phase1OrangeCard`', 131, -1, FALSE, '`phase1OrangeCard`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->phase1OrangeCard->Sortable = TRUE; // Allow sort
		$this->phase1OrangeCard->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['phase1OrangeCard'] = &$this->phase1OrangeCard;

		// phase1GPS
		$this->phase1GPS = new cField('rent_lease_cars', 'rent_lease_cars', 'x_phase1GPS', 'phase1GPS', '`phase1GPS`', '`phase1GPS`', 131, -1, FALSE, '`phase1GPS`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->phase1GPS->Sortable = TRUE; // Allow sort
		$this->phase1GPS->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['phase1GPS'] = &$this->phase1GPS;

		// phase1DeliveryCharges
		$this->phase1DeliveryCharges = new cField('rent_lease_cars', 'rent_lease_cars', 'x_phase1DeliveryCharges', 'phase1DeliveryCharges', '`phase1DeliveryCharges`', '`phase1DeliveryCharges`', 131, -1, FALSE, '`phase1DeliveryCharges`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->phase1DeliveryCharges->Sortable = TRUE; // Allow sort
		$this->phase1DeliveryCharges->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['phase1DeliveryCharges'] = &$this->phase1DeliveryCharges;

		// phase1CollectionCharges
		$this->phase1CollectionCharges = new cField('rent_lease_cars', 'rent_lease_cars', 'x_phase1CollectionCharges', 'phase1CollectionCharges', '`phase1CollectionCharges`', '`phase1CollectionCharges`', 131, -1, FALSE, '`phase1CollectionCharges`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->phase1CollectionCharges->Sortable = TRUE; // Allow sort
		$this->phase1CollectionCharges->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['phase1CollectionCharges'] = &$this->phase1CollectionCharges;

		// weeklyDeals
		$this->weeklyDeals = new cField('rent_lease_cars', 'rent_lease_cars', 'x_weeklyDeals', 'weeklyDeals', '`weeklyDeals`', '`weeklyDeals`', 16, -1, FALSE, '`weeklyDeals`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->weeklyDeals->Sortable = TRUE; // Allow sort
		$this->weeklyDeals->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->weeklyDeals->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->weeklyDeals->OptionCount = 2;
		$this->weeklyDeals->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['weeklyDeals'] = &$this->weeklyDeals;
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`rent_lease_cars`";
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
			$this->rentLeaseCarID->setDbValue($conn->Insert_ID());
			$rs['rentLeaseCarID'] = $this->rentLeaseCarID->DbValue;
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
			if (array_key_exists('rentLeaseCarID', $rs))
				ew_AddFilter($where, ew_QuotedName('rentLeaseCarID', $this->DBID) . '=' . ew_QuotedValue($rs['rentLeaseCarID'], $this->rentLeaseCarID->FldDataType, $this->DBID));
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
		return "`rentLeaseCarID` = @rentLeaseCarID@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->rentLeaseCarID->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->rentLeaseCarID->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@rentLeaseCarID@", ew_AdjustSql($this->rentLeaseCarID->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "rent_lease_carslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "rent_lease_carsview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "rent_lease_carsedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "rent_lease_carsadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "rent_lease_carslist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("rent_lease_carsview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("rent_lease_carsview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "rent_lease_carsadd.php?" . $this->UrlParm($parm);
		else
			$url = "rent_lease_carsadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("rent_lease_carsedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("rent_lease_carsadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("rent_lease_carsdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "rentLeaseCarID:" . ew_VarToJson($this->rentLeaseCarID->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->rentLeaseCarID->CurrentValue)) {
			$sUrl .= "rentLeaseCarID=" . urlencode($this->rentLeaseCarID->CurrentValue);
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
			if ($isPost && isset($_POST["rentLeaseCarID"]))
				$arKeys[] = $_POST["rentLeaseCarID"];
			elseif (isset($_GET["rentLeaseCarID"]))
				$arKeys[] = $_GET["rentLeaseCarID"];
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
			$this->rentLeaseCarID->CurrentValue = $key;
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
		$this->rentLeaseCarID->setDbValue($rs->fields('rentLeaseCarID'));
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
		$this->deliveryAED->setDbValue($rs->fields('deliveryAED'));
		$this->dailyAED->setDbValue($rs->fields('dailyAED'));
		$this->dailyDummyAED->setDbValue($rs->fields('dailyDummyAED'));
		$this->weeklyAED->setDbValue($rs->fields('weeklyAED'));
		$this->weeklyDummyAED->setDbValue($rs->fields('weeklyDummyAED'));
		$this->monthlyAED->setDbValue($rs->fields('monthlyAED'));
		$this->monthlyDummyAED->setDbValue($rs->fields('monthlyDummyAED'));
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
		$this->active->setDbValue($rs->fields('active'));
		$this->phase1OrangeCard->setDbValue($rs->fields('phase1OrangeCard'));
		$this->phase1GPS->setDbValue($rs->fields('phase1GPS'));
		$this->phase1DeliveryCharges->setDbValue($rs->fields('phase1DeliveryCharges'));
		$this->phase1CollectionCharges->setDbValue($rs->fields('phase1CollectionCharges'));
		$this->weeklyDeals->setDbValue($rs->fields('weeklyDeals'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
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
			$this->image->LinkAttrs["data-rel"] = "rent_lease_cars_x_image";
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

		// deliveryAED
		$this->deliveryAED->LinkCustomAttributes = "";
		$this->deliveryAED->HrefValue = "";
		$this->deliveryAED->TooltipValue = "";

		// dailyAED
		$this->dailyAED->LinkCustomAttributes = "";
		$this->dailyAED->HrefValue = "";
		$this->dailyAED->TooltipValue = "";

		// dailyDummyAED
		$this->dailyDummyAED->LinkCustomAttributes = "";
		$this->dailyDummyAED->HrefValue = "";
		$this->dailyDummyAED->TooltipValue = "";

		// weeklyAED
		$this->weeklyAED->LinkCustomAttributes = "";
		$this->weeklyAED->HrefValue = "";
		$this->weeklyAED->TooltipValue = "";

		// weeklyDummyAED
		$this->weeklyDummyAED->LinkCustomAttributes = "";
		$this->weeklyDummyAED->HrefValue = "";
		$this->weeklyDummyAED->TooltipValue = "";

		// monthlyAED
		$this->monthlyAED->LinkCustomAttributes = "";
		$this->monthlyAED->HrefValue = "";
		$this->monthlyAED->TooltipValue = "";

		// monthlyDummyAED
		$this->monthlyDummyAED->LinkCustomAttributes = "";
		$this->monthlyDummyAED->HrefValue = "";
		$this->monthlyDummyAED->TooltipValue = "";

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

		// weeklyDeals
		$this->weeklyDeals->LinkCustomAttributes = "";
		$this->weeklyDeals->HrefValue = "";
		$this->weeklyDeals->TooltipValue = "";

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

		// rentLeaseCarID
		$this->rentLeaseCarID->EditAttrs["class"] = "form-control";
		$this->rentLeaseCarID->EditCustomAttributes = "";
		$this->rentLeaseCarID->EditValue = $this->rentLeaseCarID->CurrentValue;
		$this->rentLeaseCarID->ViewCustomAttributes = "";

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

		// deliveryAED
		$this->deliveryAED->EditAttrs["class"] = "form-control";
		$this->deliveryAED->EditCustomAttributes = "";
		$this->deliveryAED->EditValue = $this->deliveryAED->CurrentValue;
		$this->deliveryAED->PlaceHolder = ew_RemoveHtml($this->deliveryAED->FldCaption());
		if (strval($this->deliveryAED->EditValue) <> "" && is_numeric($this->deliveryAED->EditValue)) $this->deliveryAED->EditValue = ew_FormatNumber($this->deliveryAED->EditValue, -2, -1, -2, 0);

		// dailyAED
		$this->dailyAED->EditAttrs["class"] = "form-control";
		$this->dailyAED->EditCustomAttributes = "";
		$this->dailyAED->EditValue = $this->dailyAED->CurrentValue;
		$this->dailyAED->PlaceHolder = ew_RemoveHtml($this->dailyAED->FldCaption());
		if (strval($this->dailyAED->EditValue) <> "" && is_numeric($this->dailyAED->EditValue)) $this->dailyAED->EditValue = ew_FormatNumber($this->dailyAED->EditValue, -2, -1, -2, 0);

		// dailyDummyAED
		$this->dailyDummyAED->EditAttrs["class"] = "form-control";
		$this->dailyDummyAED->EditCustomAttributes = "";
		$this->dailyDummyAED->EditValue = $this->dailyDummyAED->CurrentValue;
		$this->dailyDummyAED->PlaceHolder = ew_RemoveHtml($this->dailyDummyAED->FldCaption());
		if (strval($this->dailyDummyAED->EditValue) <> "" && is_numeric($this->dailyDummyAED->EditValue)) $this->dailyDummyAED->EditValue = ew_FormatNumber($this->dailyDummyAED->EditValue, -2, -1, -2, 0);

		// weeklyAED
		$this->weeklyAED->EditAttrs["class"] = "form-control";
		$this->weeklyAED->EditCustomAttributes = "";
		$this->weeklyAED->EditValue = $this->weeklyAED->CurrentValue;
		$this->weeklyAED->PlaceHolder = ew_RemoveHtml($this->weeklyAED->FldCaption());
		if (strval($this->weeklyAED->EditValue) <> "" && is_numeric($this->weeklyAED->EditValue)) $this->weeklyAED->EditValue = ew_FormatNumber($this->weeklyAED->EditValue, -2, -1, -2, 0);

		// weeklyDummyAED
		$this->weeklyDummyAED->EditAttrs["class"] = "form-control";
		$this->weeklyDummyAED->EditCustomAttributes = "";
		$this->weeklyDummyAED->EditValue = $this->weeklyDummyAED->CurrentValue;
		$this->weeklyDummyAED->PlaceHolder = ew_RemoveHtml($this->weeklyDummyAED->FldCaption());
		if (strval($this->weeklyDummyAED->EditValue) <> "" && is_numeric($this->weeklyDummyAED->EditValue)) $this->weeklyDummyAED->EditValue = ew_FormatNumber($this->weeklyDummyAED->EditValue, -2, -1, -2, 0);

		// monthlyAED
		$this->monthlyAED->EditAttrs["class"] = "form-control";
		$this->monthlyAED->EditCustomAttributes = "";
		$this->monthlyAED->EditValue = $this->monthlyAED->CurrentValue;
		$this->monthlyAED->PlaceHolder = ew_RemoveHtml($this->monthlyAED->FldCaption());
		if (strval($this->monthlyAED->EditValue) <> "" && is_numeric($this->monthlyAED->EditValue)) $this->monthlyAED->EditValue = ew_FormatNumber($this->monthlyAED->EditValue, -2, -1, -2, 0);

		// monthlyDummyAED
		$this->monthlyDummyAED->EditAttrs["class"] = "form-control";
		$this->monthlyDummyAED->EditCustomAttributes = "";
		$this->monthlyDummyAED->EditValue = $this->monthlyDummyAED->CurrentValue;
		$this->monthlyDummyAED->PlaceHolder = ew_RemoveHtml($this->monthlyDummyAED->FldCaption());
		if (strval($this->monthlyDummyAED->EditValue) <> "" && is_numeric($this->monthlyDummyAED->EditValue)) $this->monthlyDummyAED->EditValue = ew_FormatNumber($this->monthlyDummyAED->EditValue, -2, -1, -2, 0);

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

		// weeklyDeals
		$this->weeklyDeals->EditAttrs["class"] = "form-control";
		$this->weeklyDeals->EditCustomAttributes = "";
		$this->weeklyDeals->EditValue = $this->weeklyDeals->Options(TRUE);

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
					if ($this->rentLeaseCarID->Exportable) $Doc->ExportCaption($this->rentLeaseCarID);
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
					if ($this->deliveryAED->Exportable) $Doc->ExportCaption($this->deliveryAED);
					if ($this->dailyAED->Exportable) $Doc->ExportCaption($this->dailyAED);
					if ($this->dailyDummyAED->Exportable) $Doc->ExportCaption($this->dailyDummyAED);
					if ($this->weeklyAED->Exportable) $Doc->ExportCaption($this->weeklyAED);
					if ($this->weeklyDummyAED->Exportable) $Doc->ExportCaption($this->weeklyDummyAED);
					if ($this->monthlyAED->Exportable) $Doc->ExportCaption($this->monthlyAED);
					if ($this->monthlyDummyAED->Exportable) $Doc->ExportCaption($this->monthlyDummyAED);
					if ($this->active->Exportable) $Doc->ExportCaption($this->active);
					if ($this->phase1OrangeCard->Exportable) $Doc->ExportCaption($this->phase1OrangeCard);
					if ($this->phase1GPS->Exportable) $Doc->ExportCaption($this->phase1GPS);
					if ($this->phase1DeliveryCharges->Exportable) $Doc->ExportCaption($this->phase1DeliveryCharges);
					if ($this->phase1CollectionCharges->Exportable) $Doc->ExportCaption($this->phase1CollectionCharges);
					if ($this->weeklyDeals->Exportable) $Doc->ExportCaption($this->weeklyDeals);
				} else {
					if ($this->rentLeaseCarID->Exportable) $Doc->ExportCaption($this->rentLeaseCarID);
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
					if ($this->deliveryAED->Exportable) $Doc->ExportCaption($this->deliveryAED);
					if ($this->dailyAED->Exportable) $Doc->ExportCaption($this->dailyAED);
					if ($this->dailyDummyAED->Exportable) $Doc->ExportCaption($this->dailyDummyAED);
					if ($this->weeklyAED->Exportable) $Doc->ExportCaption($this->weeklyAED);
					if ($this->weeklyDummyAED->Exportable) $Doc->ExportCaption($this->weeklyDummyAED);
					if ($this->monthlyAED->Exportable) $Doc->ExportCaption($this->monthlyAED);
					if ($this->monthlyDummyAED->Exportable) $Doc->ExportCaption($this->monthlyDummyAED);
					if ($this->active->Exportable) $Doc->ExportCaption($this->active);
					if ($this->phase1OrangeCard->Exportable) $Doc->ExportCaption($this->phase1OrangeCard);
					if ($this->phase1GPS->Exportable) $Doc->ExportCaption($this->phase1GPS);
					if ($this->phase1DeliveryCharges->Exportable) $Doc->ExportCaption($this->phase1DeliveryCharges);
					if ($this->phase1CollectionCharges->Exportable) $Doc->ExportCaption($this->phase1CollectionCharges);
					if ($this->weeklyDeals->Exportable) $Doc->ExportCaption($this->weeklyDeals);
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
						if ($this->rentLeaseCarID->Exportable) $Doc->ExportField($this->rentLeaseCarID);
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
						if ($this->deliveryAED->Exportable) $Doc->ExportField($this->deliveryAED);
						if ($this->dailyAED->Exportable) $Doc->ExportField($this->dailyAED);
						if ($this->dailyDummyAED->Exportable) $Doc->ExportField($this->dailyDummyAED);
						if ($this->weeklyAED->Exportable) $Doc->ExportField($this->weeklyAED);
						if ($this->weeklyDummyAED->Exportable) $Doc->ExportField($this->weeklyDummyAED);
						if ($this->monthlyAED->Exportable) $Doc->ExportField($this->monthlyAED);
						if ($this->monthlyDummyAED->Exportable) $Doc->ExportField($this->monthlyDummyAED);
						if ($this->active->Exportable) $Doc->ExportField($this->active);
						if ($this->phase1OrangeCard->Exportable) $Doc->ExportField($this->phase1OrangeCard);
						if ($this->phase1GPS->Exportable) $Doc->ExportField($this->phase1GPS);
						if ($this->phase1DeliveryCharges->Exportable) $Doc->ExportField($this->phase1DeliveryCharges);
						if ($this->phase1CollectionCharges->Exportable) $Doc->ExportField($this->phase1CollectionCharges);
						if ($this->weeklyDeals->Exportable) $Doc->ExportField($this->weeklyDeals);
					} else {
						if ($this->rentLeaseCarID->Exportable) $Doc->ExportField($this->rentLeaseCarID);
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
						if ($this->deliveryAED->Exportable) $Doc->ExportField($this->deliveryAED);
						if ($this->dailyAED->Exportable) $Doc->ExportField($this->dailyAED);
						if ($this->dailyDummyAED->Exportable) $Doc->ExportField($this->dailyDummyAED);
						if ($this->weeklyAED->Exportable) $Doc->ExportField($this->weeklyAED);
						if ($this->weeklyDummyAED->Exportable) $Doc->ExportField($this->weeklyDummyAED);
						if ($this->monthlyAED->Exportable) $Doc->ExportField($this->monthlyAED);
						if ($this->monthlyDummyAED->Exportable) $Doc->ExportField($this->monthlyDummyAED);
						if ($this->active->Exportable) $Doc->ExportField($this->active);
						if ($this->phase1OrangeCard->Exportable) $Doc->ExportField($this->phase1OrangeCard);
						if ($this->phase1GPS->Exportable) $Doc->ExportField($this->phase1GPS);
						if ($this->phase1DeliveryCharges->Exportable) $Doc->ExportField($this->phase1DeliveryCharges);
						if ($this->phase1CollectionCharges->Exportable) $Doc->ExportField($this->phase1CollectionCharges);
						if ($this->weeklyDeals->Exportable) $Doc->ExportField($this->weeklyDeals);
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
