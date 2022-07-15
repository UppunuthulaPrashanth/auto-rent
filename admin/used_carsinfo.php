<?php

// Global variable for table object
$used_cars = NULL;

//
// Table class for used_cars
//
class cused_cars extends cTable {
	var $userCarID;
	var $makeID;
	var $modelID;
	var $slug;
	var $yearID;
	var $kilometers;
	var $priceAED;
	var $priceUSD;
	var $priceOMR;
	var $priceSAR;
	var $description;
	var $fuelTypeID;
	var $regionalID;
	var $warrantyID;
	var $noOfDoors;
	var $transmissionTypeID;
	var $cylinderID;
	var $engine;
	var $colorID;
	var $bodyConditionID;
	var $summary;
	var $term;
	var $_thumbnail;
	var $img_01;
	var $img_02;
	var $img_03;
	var $img_04;
	var $img_05;
	var $img_06;
	var $img_07;
	var $img_08;
	var $img_09;
	var $img_10;
	var $img_11;
	var $img_12;
	var $extra_features;
	var $so;
	var $active;
	var $regionalSpec;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'used_cars';
		$this->TableName = 'used_cars';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`used_cars`";
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
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new cBasicSearch($this->TableVar);

		// userCarID
		$this->userCarID = new cField('used_cars', 'used_cars', 'x_userCarID', 'userCarID', '`userCarID`', '`userCarID`', 3, -1, FALSE, '`userCarID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->userCarID->Sortable = TRUE; // Allow sort
		$this->userCarID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['userCarID'] = &$this->userCarID;

		// makeID
		$this->makeID = new cField('used_cars', 'used_cars', 'x_makeID', 'makeID', '`makeID`', '`makeID`', 3, -1, FALSE, '`makeID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->makeID->Sortable = TRUE; // Allow sort
		$this->makeID->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->makeID->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->makeID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['makeID'] = &$this->makeID;

		// modelID
		$this->modelID = new cField('used_cars', 'used_cars', 'x_modelID', 'modelID', '`modelID`', '`modelID`', 3, -1, FALSE, '`modelID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->modelID->Sortable = TRUE; // Allow sort
		$this->modelID->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->modelID->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->modelID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['modelID'] = &$this->modelID;

		// slug
		$this->slug = new cField('used_cars', 'used_cars', 'x_slug', 'slug', '`slug`', '`slug`', 200, -1, FALSE, '`slug`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->slug->Sortable = TRUE; // Allow sort
		$this->fields['slug'] = &$this->slug;

		// yearID
		$this->yearID = new cField('used_cars', 'used_cars', 'x_yearID', 'yearID', '`yearID`', '`yearID`', 3, -1, FALSE, '`yearID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->yearID->Sortable = TRUE; // Allow sort
		$this->yearID->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->yearID->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->yearID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['yearID'] = &$this->yearID;

		// kilometers
		$this->kilometers = new cField('used_cars', 'used_cars', 'x_kilometers', 'kilometers', '`kilometers`', '`kilometers`', 3, -1, FALSE, '`kilometers`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kilometers->Sortable = TRUE; // Allow sort
		$this->kilometers->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['kilometers'] = &$this->kilometers;

		// priceAED
		$this->priceAED = new cField('used_cars', 'used_cars', 'x_priceAED', 'priceAED', '`priceAED`', '`priceAED`', 3, -1, FALSE, '`priceAED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->priceAED->Sortable = TRUE; // Allow sort
		$this->priceAED->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['priceAED'] = &$this->priceAED;

		// priceUSD
		$this->priceUSD = new cField('used_cars', 'used_cars', 'x_priceUSD', 'priceUSD', '`priceUSD`', '`priceUSD`', 3, -1, FALSE, '`priceUSD`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->priceUSD->Sortable = TRUE; // Allow sort
		$this->priceUSD->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['priceUSD'] = &$this->priceUSD;

		// priceOMR
		$this->priceOMR = new cField('used_cars', 'used_cars', 'x_priceOMR', 'priceOMR', '`priceOMR`', '`priceOMR`', 3, -1, FALSE, '`priceOMR`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->priceOMR->Sortable = TRUE; // Allow sort
		$this->priceOMR->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['priceOMR'] = &$this->priceOMR;

		// priceSAR
		$this->priceSAR = new cField('used_cars', 'used_cars', 'x_priceSAR', 'priceSAR', '`priceSAR`', '`priceSAR`', 3, -1, FALSE, '`priceSAR`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->priceSAR->Sortable = TRUE; // Allow sort
		$this->priceSAR->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['priceSAR'] = &$this->priceSAR;

		// description
		$this->description = new cField('used_cars', 'used_cars', 'x_description', 'description', '`description`', '`description`', 200, -1, FALSE, '`description`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->description->Sortable = TRUE; // Allow sort
		$this->fields['description'] = &$this->description;

		// fuelTypeID
		$this->fuelTypeID = new cField('used_cars', 'used_cars', 'x_fuelTypeID', 'fuelTypeID', '`fuelTypeID`', '`fuelTypeID`', 3, -1, FALSE, '`fuelTypeID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->fuelTypeID->Sortable = TRUE; // Allow sort
		$this->fuelTypeID->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->fuelTypeID->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->fuelTypeID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['fuelTypeID'] = &$this->fuelTypeID;

		// regionalID
		$this->regionalID = new cField('used_cars', 'used_cars', 'x_regionalID', 'regionalID', '`regionalID`', '`regionalID`', 3, -1, FALSE, '`regionalID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->regionalID->Sortable = TRUE; // Allow sort
		$this->regionalID->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->regionalID->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->regionalID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['regionalID'] = &$this->regionalID;

		// warrantyID
		$this->warrantyID = new cField('used_cars', 'used_cars', 'x_warrantyID', 'warrantyID', '`warrantyID`', '`warrantyID`', 3, -1, FALSE, '`warrantyID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->warrantyID->Sortable = TRUE; // Allow sort
		$this->warrantyID->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->warrantyID->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->warrantyID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['warrantyID'] = &$this->warrantyID;

		// noOfDoors
		$this->noOfDoors = new cField('used_cars', 'used_cars', 'x_noOfDoors', 'noOfDoors', '`noOfDoors`', '`noOfDoors`', 3, -1, FALSE, '`noOfDoors`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->noOfDoors->Sortable = TRUE; // Allow sort
		$this->noOfDoors->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['noOfDoors'] = &$this->noOfDoors;

		// transmissionTypeID
		$this->transmissionTypeID = new cField('used_cars', 'used_cars', 'x_transmissionTypeID', 'transmissionTypeID', '`transmissionTypeID`', '`transmissionTypeID`', 3, -1, FALSE, '`transmissionTypeID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->transmissionTypeID->Sortable = TRUE; // Allow sort
		$this->transmissionTypeID->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->transmissionTypeID->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->transmissionTypeID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['transmissionTypeID'] = &$this->transmissionTypeID;

		// cylinderID
		$this->cylinderID = new cField('used_cars', 'used_cars', 'x_cylinderID', 'cylinderID', '`cylinderID`', '`cylinderID`', 3, -1, FALSE, '`cylinderID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->cylinderID->Sortable = TRUE; // Allow sort
		$this->cylinderID->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->cylinderID->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->cylinderID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['cylinderID'] = &$this->cylinderID;

		// engine
		$this->engine = new cField('used_cars', 'used_cars', 'x_engine', 'engine', '`engine`', '`engine`', 200, -1, FALSE, '`engine`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->engine->Sortable = TRUE; // Allow sort
		$this->fields['engine'] = &$this->engine;

		// colorID
		$this->colorID = new cField('used_cars', 'used_cars', 'x_colorID', 'colorID', '`colorID`', '`colorID`', 3, -1, FALSE, '`colorID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->colorID->Sortable = TRUE; // Allow sort
		$this->colorID->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->colorID->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->colorID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['colorID'] = &$this->colorID;

		// bodyConditionID
		$this->bodyConditionID = new cField('used_cars', 'used_cars', 'x_bodyConditionID', 'bodyConditionID', '`bodyConditionID`', '`bodyConditionID`', 3, -1, FALSE, '`bodyConditionID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->bodyConditionID->Sortable = TRUE; // Allow sort
		$this->bodyConditionID->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->bodyConditionID->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->bodyConditionID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['bodyConditionID'] = &$this->bodyConditionID;

		// summary
		$this->summary = new cField('used_cars', 'used_cars', 'x_summary', 'summary', '`summary`', '`summary`', 201, -1, FALSE, '`summary`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->summary->Sortable = TRUE; // Allow sort
		$this->fields['summary'] = &$this->summary;

		// term
		$this->term = new cField('used_cars', 'used_cars', 'x_term', 'term', '`term`', '`term`', 200, -1, FALSE, '`term`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->term->Sortable = TRUE; // Allow sort
		$this->term->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->term->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->fields['term'] = &$this->term;

		// thumbnail
		$this->_thumbnail = new cField('used_cars', 'used_cars', 'x__thumbnail', 'thumbnail', '`thumbnail`', '`thumbnail`', 200, -1, TRUE, '`thumbnail`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->_thumbnail->Sortable = TRUE; // Allow sort
		$this->fields['thumbnail'] = &$this->_thumbnail;

		// img_01
		$this->img_01 = new cField('used_cars', 'used_cars', 'x_img_01', 'img_01', '`img_01`', '`img_01`', 200, -1, TRUE, '`img_01`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->img_01->Sortable = TRUE; // Allow sort
		$this->fields['img_01'] = &$this->img_01;

		// img_02
		$this->img_02 = new cField('used_cars', 'used_cars', 'x_img_02', 'img_02', '`img_02`', '`img_02`', 200, -1, TRUE, '`img_02`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->img_02->Sortable = TRUE; // Allow sort
		$this->fields['img_02'] = &$this->img_02;

		// img_03
		$this->img_03 = new cField('used_cars', 'used_cars', 'x_img_03', 'img_03', '`img_03`', '`img_03`', 200, -1, TRUE, '`img_03`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->img_03->Sortable = TRUE; // Allow sort
		$this->fields['img_03'] = &$this->img_03;

		// img_04
		$this->img_04 = new cField('used_cars', 'used_cars', 'x_img_04', 'img_04', '`img_04`', '`img_04`', 200, -1, TRUE, '`img_04`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->img_04->Sortable = TRUE; // Allow sort
		$this->fields['img_04'] = &$this->img_04;

		// img_05
		$this->img_05 = new cField('used_cars', 'used_cars', 'x_img_05', 'img_05', '`img_05`', '`img_05`', 200, -1, TRUE, '`img_05`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->img_05->Sortable = TRUE; // Allow sort
		$this->fields['img_05'] = &$this->img_05;

		// img_06
		$this->img_06 = new cField('used_cars', 'used_cars', 'x_img_06', 'img_06', '`img_06`', '`img_06`', 200, -1, TRUE, '`img_06`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->img_06->Sortable = TRUE; // Allow sort
		$this->fields['img_06'] = &$this->img_06;

		// img_07
		$this->img_07 = new cField('used_cars', 'used_cars', 'x_img_07', 'img_07', '`img_07`', '`img_07`', 200, -1, TRUE, '`img_07`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->img_07->Sortable = TRUE; // Allow sort
		$this->fields['img_07'] = &$this->img_07;

		// img_08
		$this->img_08 = new cField('used_cars', 'used_cars', 'x_img_08', 'img_08', '`img_08`', '`img_08`', 200, -1, TRUE, '`img_08`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->img_08->Sortable = TRUE; // Allow sort
		$this->fields['img_08'] = &$this->img_08;

		// img_09
		$this->img_09 = new cField('used_cars', 'used_cars', 'x_img_09', 'img_09', '`img_09`', '`img_09`', 200, -1, TRUE, '`img_09`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->img_09->Sortable = TRUE; // Allow sort
		$this->fields['img_09'] = &$this->img_09;

		// img_10
		$this->img_10 = new cField('used_cars', 'used_cars', 'x_img_10', 'img_10', '`img_10`', '`img_10`', 200, -1, TRUE, '`img_10`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->img_10->Sortable = TRUE; // Allow sort
		$this->fields['img_10'] = &$this->img_10;

		// img_11
		$this->img_11 = new cField('used_cars', 'used_cars', 'x_img_11', 'img_11', '`img_11`', '`img_11`', 200, -1, TRUE, '`img_11`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->img_11->Sortable = TRUE; // Allow sort
		$this->fields['img_11'] = &$this->img_11;

		// img_12
		$this->img_12 = new cField('used_cars', 'used_cars', 'x_img_12', 'img_12', '`img_12`', '`img_12`', 200, -1, TRUE, '`img_12`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->img_12->Sortable = TRUE; // Allow sort
		$this->fields['img_12'] = &$this->img_12;

		// extra_features
		$this->extra_features = new cField('used_cars', 'used_cars', 'x_extra_features', 'extra_features', '`extra_features`', '`extra_features`', 201, -1, FALSE, '`extra_features`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->extra_features->Sortable = TRUE; // Allow sort
		$this->fields['extra_features'] = &$this->extra_features;

		// so
		$this->so = new cField('used_cars', 'used_cars', 'x_so', 'so', '`so`', '`so`', 16, -1, FALSE, '`so`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->so->Sortable = TRUE; // Allow sort
		$this->so->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['so'] = &$this->so;

		// active
		$this->active = new cField('used_cars', 'used_cars', 'x_active', 'active', '`active`', '`active`', 16, -1, FALSE, '`active`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->active->Sortable = TRUE; // Allow sort
		$this->active->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->active->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->active->OptionCount = 2;
		$this->active->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['active'] = &$this->active;

		// regionalSpec
		$this->regionalSpec = new cField('used_cars', 'used_cars', 'x_regionalSpec', 'regionalSpec', '`regionalSpec`', '`regionalSpec`', 200, -1, FALSE, '`regionalSpec`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->regionalSpec->Sortable = FALSE; // Allow sort
		$this->regionalSpec->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->regionalSpec->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->fields['regionalSpec'] = &$this->regionalSpec;
	}

	// Field Visibility
	function GetFieldVisibility($fldparm) {
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`used_cars`";
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
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = ew_BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
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
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = ew_BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
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
			$this->userCarID->setDbValue($conn->Insert_ID());
			$rs['userCarID'] = $this->userCarID->DbValue;
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
			if (array_key_exists('userCarID', $rs))
				ew_AddFilter($where, ew_QuotedName('userCarID', $this->DBID) . '=' . ew_QuotedValue($rs['userCarID'], $this->userCarID->FldDataType, $this->DBID));
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
		return "`userCarID` = @userCarID@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->userCarID->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->userCarID->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@userCarID@", ew_AdjustSql($this->userCarID->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "used_carslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "used_carsview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "used_carsedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "used_carsadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "used_carslist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("used_carsview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("used_carsview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "used_carsadd.php?" . $this->UrlParm($parm);
		else
			$url = "used_carsadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("used_carsedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("used_carsadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("used_carsdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "userCarID:" . ew_VarToJson($this->userCarID->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->userCarID->CurrentValue)) {
			$sUrl .= "userCarID=" . urlencode($this->userCarID->CurrentValue);
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
			if ($isPost && isset($_POST["userCarID"]))
				$arKeys[] = $_POST["userCarID"];
			elseif (isset($_GET["userCarID"]))
				$arKeys[] = $_GET["userCarID"];
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
			$this->userCarID->CurrentValue = $key;
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
		$this->userCarID->setDbValue($rs->fields('userCarID'));
		$this->makeID->setDbValue($rs->fields('makeID'));
		$this->modelID->setDbValue($rs->fields('modelID'));
		$this->slug->setDbValue($rs->fields('slug'));
		$this->yearID->setDbValue($rs->fields('yearID'));
		$this->kilometers->setDbValue($rs->fields('kilometers'));
		$this->priceAED->setDbValue($rs->fields('priceAED'));
		$this->priceUSD->setDbValue($rs->fields('priceUSD'));
		$this->priceOMR->setDbValue($rs->fields('priceOMR'));
		$this->priceSAR->setDbValue($rs->fields('priceSAR'));
		$this->description->setDbValue($rs->fields('description'));
		$this->fuelTypeID->setDbValue($rs->fields('fuelTypeID'));
		$this->regionalID->setDbValue($rs->fields('regionalID'));
		$this->warrantyID->setDbValue($rs->fields('warrantyID'));
		$this->noOfDoors->setDbValue($rs->fields('noOfDoors'));
		$this->transmissionTypeID->setDbValue($rs->fields('transmissionTypeID'));
		$this->cylinderID->setDbValue($rs->fields('cylinderID'));
		$this->engine->setDbValue($rs->fields('engine'));
		$this->colorID->setDbValue($rs->fields('colorID'));
		$this->bodyConditionID->setDbValue($rs->fields('bodyConditionID'));
		$this->summary->setDbValue($rs->fields('summary'));
		$this->term->setDbValue($rs->fields('term'));
		$this->_thumbnail->Upload->DbValue = $rs->fields('thumbnail');
		$this->img_01->Upload->DbValue = $rs->fields('img_01');
		$this->img_02->Upload->DbValue = $rs->fields('img_02');
		$this->img_03->Upload->DbValue = $rs->fields('img_03');
		$this->img_04->Upload->DbValue = $rs->fields('img_04');
		$this->img_05->Upload->DbValue = $rs->fields('img_05');
		$this->img_06->Upload->DbValue = $rs->fields('img_06');
		$this->img_07->Upload->DbValue = $rs->fields('img_07');
		$this->img_08->Upload->DbValue = $rs->fields('img_08');
		$this->img_09->Upload->DbValue = $rs->fields('img_09');
		$this->img_10->Upload->DbValue = $rs->fields('img_10');
		$this->img_11->Upload->DbValue = $rs->fields('img_11');
		$this->img_12->Upload->DbValue = $rs->fields('img_12');
		$this->extra_features->setDbValue($rs->fields('extra_features'));
		$this->so->setDbValue($rs->fields('so'));
		$this->active->setDbValue($rs->fields('active'));
		$this->regionalSpec->setDbValue($rs->fields('regionalSpec'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
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

		// summary
		$this->summary->ViewValue = $this->summary->CurrentValue;
		$this->summary->ViewCustomAttributes = "";

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

		// extra_features
		if (strval($this->extra_features->CurrentValue) <> "") {
			$arwrk = explode(",", $this->extra_features->CurrentValue);
			$sFilterWrk = "";
			foreach ($arwrk as $wrk) {
				if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
				$sFilterWrk .= "`featureID`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_NUMBER, "");
			}
		$sSqlWrk = "SELECT `featureID`, `extraFeatures` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_extra_features`";
		$sWhereWrk = "";
		$this->extra_features->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->extra_features, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->extra_features->ViewValue = "";
				$ari = 0;
				while (!$rswrk->EOF) {
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->extra_features->ViewValue .= $this->extra_features->DisplayValue($arwrk);
					$rswrk->MoveNext();
					if (!$rswrk->EOF) $this->extra_features->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
					$ari++;
				}
				$rswrk->Close();
			} else {
				$this->extra_features->ViewValue = $this->extra_features->CurrentValue;
			}
		} else {
			$this->extra_features->ViewValue = NULL;
		}
		$this->extra_features->ViewCustomAttributes = "";

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

		// regionalSpec
		if (strval($this->regionalSpec->CurrentValue) <> "") {
			$sFilterWrk = "`regionalID`" . ew_SearchString("=", $this->regionalSpec->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `regionalID`, `regionalSpecs` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `mtr_regional_spec`";
		$sWhereWrk = "";
		$this->regionalSpec->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->regionalSpec, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->regionalSpec->ViewValue = $this->regionalSpec->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->regionalSpec->ViewValue = $this->regionalSpec->CurrentValue;
			}
		} else {
			$this->regionalSpec->ViewValue = NULL;
		}
		$this->regionalSpec->ViewCustomAttributes = "";

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

		// priceUSD
		$this->priceUSD->LinkCustomAttributes = "";
		$this->priceUSD->HrefValue = "";
		$this->priceUSD->TooltipValue = "";

		// priceOMR
		$this->priceOMR->LinkCustomAttributes = "";
		$this->priceOMR->HrefValue = "";
		$this->priceOMR->TooltipValue = "";

		// priceSAR
		$this->priceSAR->LinkCustomAttributes = "";
		$this->priceSAR->HrefValue = "";
		$this->priceSAR->TooltipValue = "";

		// description
		$this->description->LinkCustomAttributes = "";
		$this->description->HrefValue = "";
		$this->description->TooltipValue = "";

		// fuelTypeID
		$this->fuelTypeID->LinkCustomAttributes = "";
		$this->fuelTypeID->HrefValue = "";
		$this->fuelTypeID->TooltipValue = "";

		// regionalID
		$this->regionalID->LinkCustomAttributes = "";
		$this->regionalID->HrefValue = "";
		$this->regionalID->TooltipValue = "";

		// warrantyID
		$this->warrantyID->LinkCustomAttributes = "";
		$this->warrantyID->HrefValue = "";
		$this->warrantyID->TooltipValue = "";

		// noOfDoors
		$this->noOfDoors->LinkCustomAttributes = "";
		$this->noOfDoors->HrefValue = "";
		$this->noOfDoors->TooltipValue = "";

		// transmissionTypeID
		$this->transmissionTypeID->LinkCustomAttributes = "";
		$this->transmissionTypeID->HrefValue = "";
		$this->transmissionTypeID->TooltipValue = "";

		// cylinderID
		$this->cylinderID->LinkCustomAttributes = "";
		$this->cylinderID->HrefValue = "";
		$this->cylinderID->TooltipValue = "";

		// engine
		$this->engine->LinkCustomAttributes = "";
		$this->engine->HrefValue = "";
		$this->engine->TooltipValue = "";

		// colorID
		$this->colorID->LinkCustomAttributes = "";
		$this->colorID->HrefValue = "";
		$this->colorID->TooltipValue = "";

		// bodyConditionID
		$this->bodyConditionID->LinkCustomAttributes = "";
		$this->bodyConditionID->HrefValue = "";
		$this->bodyConditionID->TooltipValue = "";

		// summary
		$this->summary->LinkCustomAttributes = "";
		$this->summary->HrefValue = "";
		$this->summary->TooltipValue = "";

		// term
		$this->term->LinkCustomAttributes = "";
		$this->term->HrefValue = "";
		$this->term->TooltipValue = "";

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

		// img_01
		$this->img_01->LinkCustomAttributes = "";
		$this->img_01->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_01->Upload->DbValue)) {
			$this->img_01->HrefValue = ew_GetFileUploadUrl($this->img_01, $this->img_01->Upload->DbValue); // Add prefix/suffix
			$this->img_01->LinkAttrs["target"] = ""; // Add target
			if ($this->Export <> "") $this->img_01->HrefValue = ew_FullUrl($this->img_01->HrefValue, "href");
		} else {
			$this->img_01->HrefValue = "";
		}
		$this->img_01->HrefValue2 = $this->img_01->UploadPath . $this->img_01->Upload->DbValue;
		$this->img_01->TooltipValue = "";
		if ($this->img_01->UseColorbox) {
			if (ew_Empty($this->img_01->TooltipValue))
				$this->img_01->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
			$this->img_01->LinkAttrs["data-rel"] = "used_cars_x_img_01";
			ew_AppendClass($this->img_01->LinkAttrs["class"], "ewLightbox");
		}

		// img_02
		$this->img_02->LinkCustomAttributes = "";
		$this->img_02->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_02->Upload->DbValue)) {
			$this->img_02->HrefValue = ew_GetFileUploadUrl($this->img_02, $this->img_02->Upload->DbValue); // Add prefix/suffix
			$this->img_02->LinkAttrs["target"] = ""; // Add target
			if ($this->Export <> "") $this->img_02->HrefValue = ew_FullUrl($this->img_02->HrefValue, "href");
		} else {
			$this->img_02->HrefValue = "";
		}
		$this->img_02->HrefValue2 = $this->img_02->UploadPath . $this->img_02->Upload->DbValue;
		$this->img_02->TooltipValue = "";
		if ($this->img_02->UseColorbox) {
			if (ew_Empty($this->img_02->TooltipValue))
				$this->img_02->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
			$this->img_02->LinkAttrs["data-rel"] = "used_cars_x_img_02";
			ew_AppendClass($this->img_02->LinkAttrs["class"], "ewLightbox");
		}

		// img_03
		$this->img_03->LinkCustomAttributes = "";
		$this->img_03->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_03->Upload->DbValue)) {
			$this->img_03->HrefValue = ew_GetFileUploadUrl($this->img_03, $this->img_03->Upload->DbValue); // Add prefix/suffix
			$this->img_03->LinkAttrs["target"] = ""; // Add target
			if ($this->Export <> "") $this->img_03->HrefValue = ew_FullUrl($this->img_03->HrefValue, "href");
		} else {
			$this->img_03->HrefValue = "";
		}
		$this->img_03->HrefValue2 = $this->img_03->UploadPath . $this->img_03->Upload->DbValue;
		$this->img_03->TooltipValue = "";
		if ($this->img_03->UseColorbox) {
			if (ew_Empty($this->img_03->TooltipValue))
				$this->img_03->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
			$this->img_03->LinkAttrs["data-rel"] = "used_cars_x_img_03";
			ew_AppendClass($this->img_03->LinkAttrs["class"], "ewLightbox");
		}

		// img_04
		$this->img_04->LinkCustomAttributes = "";
		$this->img_04->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_04->Upload->DbValue)) {
			$this->img_04->HrefValue = ew_GetFileUploadUrl($this->img_04, $this->img_04->Upload->DbValue); // Add prefix/suffix
			$this->img_04->LinkAttrs["target"] = ""; // Add target
			if ($this->Export <> "") $this->img_04->HrefValue = ew_FullUrl($this->img_04->HrefValue, "href");
		} else {
			$this->img_04->HrefValue = "";
		}
		$this->img_04->HrefValue2 = $this->img_04->UploadPath . $this->img_04->Upload->DbValue;
		$this->img_04->TooltipValue = "";
		if ($this->img_04->UseColorbox) {
			if (ew_Empty($this->img_04->TooltipValue))
				$this->img_04->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
			$this->img_04->LinkAttrs["data-rel"] = "used_cars_x_img_04";
			ew_AppendClass($this->img_04->LinkAttrs["class"], "ewLightbox");
		}

		// img_05
		$this->img_05->LinkCustomAttributes = "";
		$this->img_05->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_05->Upload->DbValue)) {
			$this->img_05->HrefValue = ew_GetFileUploadUrl($this->img_05, $this->img_05->Upload->DbValue); // Add prefix/suffix
			$this->img_05->LinkAttrs["target"] = ""; // Add target
			if ($this->Export <> "") $this->img_05->HrefValue = ew_FullUrl($this->img_05->HrefValue, "href");
		} else {
			$this->img_05->HrefValue = "";
		}
		$this->img_05->HrefValue2 = $this->img_05->UploadPath . $this->img_05->Upload->DbValue;
		$this->img_05->TooltipValue = "";
		if ($this->img_05->UseColorbox) {
			if (ew_Empty($this->img_05->TooltipValue))
				$this->img_05->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
			$this->img_05->LinkAttrs["data-rel"] = "used_cars_x_img_05";
			ew_AppendClass($this->img_05->LinkAttrs["class"], "ewLightbox");
		}

		// img_06
		$this->img_06->LinkCustomAttributes = "";
		$this->img_06->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_06->Upload->DbValue)) {
			$this->img_06->HrefValue = ew_GetFileUploadUrl($this->img_06, $this->img_06->Upload->DbValue); // Add prefix/suffix
			$this->img_06->LinkAttrs["target"] = ""; // Add target
			if ($this->Export <> "") $this->img_06->HrefValue = ew_FullUrl($this->img_06->HrefValue, "href");
		} else {
			$this->img_06->HrefValue = "";
		}
		$this->img_06->HrefValue2 = $this->img_06->UploadPath . $this->img_06->Upload->DbValue;
		$this->img_06->TooltipValue = "";
		if ($this->img_06->UseColorbox) {
			if (ew_Empty($this->img_06->TooltipValue))
				$this->img_06->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
			$this->img_06->LinkAttrs["data-rel"] = "used_cars_x_img_06";
			ew_AppendClass($this->img_06->LinkAttrs["class"], "ewLightbox");
		}

		// img_07
		$this->img_07->LinkCustomAttributes = "";
		$this->img_07->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_07->Upload->DbValue)) {
			$this->img_07->HrefValue = ew_GetFileUploadUrl($this->img_07, $this->img_07->Upload->DbValue); // Add prefix/suffix
			$this->img_07->LinkAttrs["target"] = ""; // Add target
			if ($this->Export <> "") $this->img_07->HrefValue = ew_FullUrl($this->img_07->HrefValue, "href");
		} else {
			$this->img_07->HrefValue = "";
		}
		$this->img_07->HrefValue2 = $this->img_07->UploadPath . $this->img_07->Upload->DbValue;
		$this->img_07->TooltipValue = "";
		if ($this->img_07->UseColorbox) {
			if (ew_Empty($this->img_07->TooltipValue))
				$this->img_07->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
			$this->img_07->LinkAttrs["data-rel"] = "used_cars_x_img_07";
			ew_AppendClass($this->img_07->LinkAttrs["class"], "ewLightbox");
		}

		// img_08
		$this->img_08->LinkCustomAttributes = "";
		$this->img_08->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_08->Upload->DbValue)) {
			$this->img_08->HrefValue = ew_GetFileUploadUrl($this->img_08, $this->img_08->Upload->DbValue); // Add prefix/suffix
			$this->img_08->LinkAttrs["target"] = ""; // Add target
			if ($this->Export <> "") $this->img_08->HrefValue = ew_FullUrl($this->img_08->HrefValue, "href");
		} else {
			$this->img_08->HrefValue = "";
		}
		$this->img_08->HrefValue2 = $this->img_08->UploadPath . $this->img_08->Upload->DbValue;
		$this->img_08->TooltipValue = "";
		if ($this->img_08->UseColorbox) {
			if (ew_Empty($this->img_08->TooltipValue))
				$this->img_08->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
			$this->img_08->LinkAttrs["data-rel"] = "used_cars_x_img_08";
			ew_AppendClass($this->img_08->LinkAttrs["class"], "ewLightbox");
		}

		// img_09
		$this->img_09->LinkCustomAttributes = "";
		$this->img_09->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_09->Upload->DbValue)) {
			$this->img_09->HrefValue = ew_GetFileUploadUrl($this->img_09, $this->img_09->Upload->DbValue); // Add prefix/suffix
			$this->img_09->LinkAttrs["target"] = ""; // Add target
			if ($this->Export <> "") $this->img_09->HrefValue = ew_FullUrl($this->img_09->HrefValue, "href");
		} else {
			$this->img_09->HrefValue = "";
		}
		$this->img_09->HrefValue2 = $this->img_09->UploadPath . $this->img_09->Upload->DbValue;
		$this->img_09->TooltipValue = "";
		if ($this->img_09->UseColorbox) {
			if (ew_Empty($this->img_09->TooltipValue))
				$this->img_09->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
			$this->img_09->LinkAttrs["data-rel"] = "used_cars_x_img_09";
			ew_AppendClass($this->img_09->LinkAttrs["class"], "ewLightbox");
		}

		// img_10
		$this->img_10->LinkCustomAttributes = "";
		$this->img_10->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_10->Upload->DbValue)) {
			$this->img_10->HrefValue = ew_GetFileUploadUrl($this->img_10, $this->img_10->Upload->DbValue); // Add prefix/suffix
			$this->img_10->LinkAttrs["target"] = ""; // Add target
			if ($this->Export <> "") $this->img_10->HrefValue = ew_FullUrl($this->img_10->HrefValue, "href");
		} else {
			$this->img_10->HrefValue = "";
		}
		$this->img_10->HrefValue2 = $this->img_10->UploadPath . $this->img_10->Upload->DbValue;
		$this->img_10->TooltipValue = "";
		if ($this->img_10->UseColorbox) {
			if (ew_Empty($this->img_10->TooltipValue))
				$this->img_10->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
			$this->img_10->LinkAttrs["data-rel"] = "used_cars_x_img_10";
			ew_AppendClass($this->img_10->LinkAttrs["class"], "ewLightbox");
		}

		// img_11
		$this->img_11->LinkCustomAttributes = "";
		$this->img_11->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_11->Upload->DbValue)) {
			$this->img_11->HrefValue = ew_GetFileUploadUrl($this->img_11, $this->img_11->Upload->DbValue); // Add prefix/suffix
			$this->img_11->LinkAttrs["target"] = ""; // Add target
			if ($this->Export <> "") $this->img_11->HrefValue = ew_FullUrl($this->img_11->HrefValue, "href");
		} else {
			$this->img_11->HrefValue = "";
		}
		$this->img_11->HrefValue2 = $this->img_11->UploadPath . $this->img_11->Upload->DbValue;
		$this->img_11->TooltipValue = "";
		if ($this->img_11->UseColorbox) {
			if (ew_Empty($this->img_11->TooltipValue))
				$this->img_11->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
			$this->img_11->LinkAttrs["data-rel"] = "used_cars_x_img_11";
			ew_AppendClass($this->img_11->LinkAttrs["class"], "ewLightbox");
		}

		// img_12
		$this->img_12->LinkCustomAttributes = "";
		$this->img_12->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_12->Upload->DbValue)) {
			$this->img_12->HrefValue = ew_GetFileUploadUrl($this->img_12, $this->img_12->Upload->DbValue); // Add prefix/suffix
			$this->img_12->LinkAttrs["target"] = ""; // Add target
			if ($this->Export <> "") $this->img_12->HrefValue = ew_FullUrl($this->img_12->HrefValue, "href");
		} else {
			$this->img_12->HrefValue = "";
		}
		$this->img_12->HrefValue2 = $this->img_12->UploadPath . $this->img_12->Upload->DbValue;
		$this->img_12->TooltipValue = "";
		if ($this->img_12->UseColorbox) {
			if (ew_Empty($this->img_12->TooltipValue))
				$this->img_12->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
			$this->img_12->LinkAttrs["data-rel"] = "used_cars_x_img_12";
			ew_AppendClass($this->img_12->LinkAttrs["class"], "ewLightbox");
		}

		// extra_features
		$this->extra_features->LinkCustomAttributes = "";
		$this->extra_features->HrefValue = "";
		$this->extra_features->TooltipValue = "";

		// so
		$this->so->LinkCustomAttributes = "";
		$this->so->HrefValue = "";
		$this->so->TooltipValue = "";

		// active
		$this->active->LinkCustomAttributes = "";
		$this->active->HrefValue = "";
		$this->active->TooltipValue = "";

		// regionalSpec
		$this->regionalSpec->LinkCustomAttributes = "";
		$this->regionalSpec->HrefValue = "";
		$this->regionalSpec->TooltipValue = "";

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

		// userCarID
		$this->userCarID->EditAttrs["class"] = "form-control";
		$this->userCarID->EditCustomAttributes = "";
		$this->userCarID->EditValue = $this->userCarID->CurrentValue;
		$this->userCarID->ViewCustomAttributes = "";

		// makeID
		$this->makeID->EditAttrs["class"] = "form-control";
		$this->makeID->EditCustomAttributes = "";

		// modelID
		$this->modelID->EditAttrs["class"] = "form-control";
		$this->modelID->EditCustomAttributes = "";

		// slug
		$this->slug->EditAttrs["class"] = "form-control";
		$this->slug->EditCustomAttributes = "";
		$this->slug->EditValue = $this->slug->CurrentValue;
		$this->slug->PlaceHolder = ew_RemoveHtml($this->slug->FldCaption());

		// yearID
		$this->yearID->EditAttrs["class"] = "form-control";
		$this->yearID->EditCustomAttributes = "";

		// kilometers
		$this->kilometers->EditAttrs["class"] = "form-control";
		$this->kilometers->EditCustomAttributes = "";
		$this->kilometers->EditValue = $this->kilometers->CurrentValue;
		$this->kilometers->PlaceHolder = ew_RemoveHtml($this->kilometers->FldCaption());

		// priceAED
		$this->priceAED->EditAttrs["class"] = "form-control";
		$this->priceAED->EditCustomAttributes = "";
		$this->priceAED->EditValue = $this->priceAED->CurrentValue;
		$this->priceAED->PlaceHolder = ew_RemoveHtml($this->priceAED->FldCaption());

		// priceUSD
		$this->priceUSD->EditAttrs["class"] = "form-control";
		$this->priceUSD->EditCustomAttributes = "";
		$this->priceUSD->EditValue = $this->priceUSD->CurrentValue;
		$this->priceUSD->PlaceHolder = ew_RemoveHtml($this->priceUSD->FldCaption());

		// priceOMR
		$this->priceOMR->EditAttrs["class"] = "form-control";
		$this->priceOMR->EditCustomAttributes = "";
		$this->priceOMR->EditValue = $this->priceOMR->CurrentValue;
		$this->priceOMR->PlaceHolder = ew_RemoveHtml($this->priceOMR->FldCaption());

		// priceSAR
		$this->priceSAR->EditAttrs["class"] = "form-control";
		$this->priceSAR->EditCustomAttributes = "";
		$this->priceSAR->EditValue = $this->priceSAR->CurrentValue;
		$this->priceSAR->PlaceHolder = ew_RemoveHtml($this->priceSAR->FldCaption());

		// description
		$this->description->EditAttrs["class"] = "form-control";
		$this->description->EditCustomAttributes = "";
		$this->description->EditValue = $this->description->CurrentValue;
		$this->description->PlaceHolder = ew_RemoveHtml($this->description->FldCaption());

		// fuelTypeID
		$this->fuelTypeID->EditAttrs["class"] = "form-control";
		$this->fuelTypeID->EditCustomAttributes = "";

		// regionalID
		$this->regionalID->EditAttrs["class"] = "form-control";
		$this->regionalID->EditCustomAttributes = "";

		// warrantyID
		$this->warrantyID->EditAttrs["class"] = "form-control";
		$this->warrantyID->EditCustomAttributes = "";

		// noOfDoors
		$this->noOfDoors->EditAttrs["class"] = "form-control";
		$this->noOfDoors->EditCustomAttributes = "";
		$this->noOfDoors->EditValue = $this->noOfDoors->CurrentValue;
		$this->noOfDoors->PlaceHolder = ew_RemoveHtml($this->noOfDoors->FldCaption());

		// transmissionTypeID
		$this->transmissionTypeID->EditAttrs["class"] = "form-control";
		$this->transmissionTypeID->EditCustomAttributes = "";

		// cylinderID
		$this->cylinderID->EditAttrs["class"] = "form-control";
		$this->cylinderID->EditCustomAttributes = "";

		// engine
		$this->engine->EditAttrs["class"] = "form-control";
		$this->engine->EditCustomAttributes = "";
		$this->engine->EditValue = $this->engine->CurrentValue;
		$this->engine->PlaceHolder = ew_RemoveHtml($this->engine->FldCaption());

		// colorID
		$this->colorID->EditAttrs["class"] = "form-control";
		$this->colorID->EditCustomAttributes = "";

		// bodyConditionID
		$this->bodyConditionID->EditAttrs["class"] = "form-control";
		$this->bodyConditionID->EditCustomAttributes = "";

		// summary
		$this->summary->EditAttrs["class"] = "form-control";
		$this->summary->EditCustomAttributes = "";
		$this->summary->EditValue = $this->summary->CurrentValue;
		$this->summary->PlaceHolder = ew_RemoveHtml($this->summary->FldCaption());

		// term
		$this->term->EditAttrs["class"] = "form-control";
		$this->term->EditCustomAttributes = "";

		// thumbnail
		$this->_thumbnail->EditAttrs["class"] = "form-control";
		$this->_thumbnail->EditCustomAttributes = "";
		$this->_thumbnail->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->_thumbnail->Upload->DbValue)) {
			$this->_thumbnail->ImageWidth = 100;
			$this->_thumbnail->ImageHeight = 0;
			$this->_thumbnail->ImageAlt = $this->_thumbnail->FldAlt();
			$this->_thumbnail->EditValue = $this->_thumbnail->Upload->DbValue;
		} else {
			$this->_thumbnail->EditValue = "";
		}
		if (!ew_Empty($this->_thumbnail->CurrentValue))
				$this->_thumbnail->Upload->FileName = $this->_thumbnail->CurrentValue;

		// img_01
		$this->img_01->EditAttrs["class"] = "form-control";
		$this->img_01->EditCustomAttributes = "";
		$this->img_01->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_01->Upload->DbValue)) {
			$this->img_01->ImageWidth = 100;
			$this->img_01->ImageHeight = 0;
			$this->img_01->ImageAlt = $this->img_01->FldAlt();
			$this->img_01->EditValue = $this->img_01->Upload->DbValue;
		} else {
			$this->img_01->EditValue = "";
		}
		if (!ew_Empty($this->img_01->CurrentValue))
				$this->img_01->Upload->FileName = $this->img_01->CurrentValue;

		// img_02
		$this->img_02->EditAttrs["class"] = "form-control";
		$this->img_02->EditCustomAttributes = "";
		$this->img_02->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_02->Upload->DbValue)) {
			$this->img_02->ImageWidth = 100;
			$this->img_02->ImageHeight = 0;
			$this->img_02->ImageAlt = $this->img_02->FldAlt();
			$this->img_02->EditValue = $this->img_02->Upload->DbValue;
		} else {
			$this->img_02->EditValue = "";
		}
		if (!ew_Empty($this->img_02->CurrentValue))
				$this->img_02->Upload->FileName = $this->img_02->CurrentValue;

		// img_03
		$this->img_03->EditAttrs["class"] = "form-control";
		$this->img_03->EditCustomAttributes = "";
		$this->img_03->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_03->Upload->DbValue)) {
			$this->img_03->ImageWidth = 100;
			$this->img_03->ImageHeight = 0;
			$this->img_03->ImageAlt = $this->img_03->FldAlt();
			$this->img_03->EditValue = $this->img_03->Upload->DbValue;
		} else {
			$this->img_03->EditValue = "";
		}
		if (!ew_Empty($this->img_03->CurrentValue))
				$this->img_03->Upload->FileName = $this->img_03->CurrentValue;

		// img_04
		$this->img_04->EditAttrs["class"] = "form-control";
		$this->img_04->EditCustomAttributes = "";
		$this->img_04->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_04->Upload->DbValue)) {
			$this->img_04->ImageWidth = 100;
			$this->img_04->ImageHeight = 0;
			$this->img_04->ImageAlt = $this->img_04->FldAlt();
			$this->img_04->EditValue = $this->img_04->Upload->DbValue;
		} else {
			$this->img_04->EditValue = "";
		}
		if (!ew_Empty($this->img_04->CurrentValue))
				$this->img_04->Upload->FileName = $this->img_04->CurrentValue;

		// img_05
		$this->img_05->EditAttrs["class"] = "form-control";
		$this->img_05->EditCustomAttributes = "";
		$this->img_05->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_05->Upload->DbValue)) {
			$this->img_05->ImageWidth = 100;
			$this->img_05->ImageHeight = 0;
			$this->img_05->ImageAlt = $this->img_05->FldAlt();
			$this->img_05->EditValue = $this->img_05->Upload->DbValue;
		} else {
			$this->img_05->EditValue = "";
		}
		if (!ew_Empty($this->img_05->CurrentValue))
				$this->img_05->Upload->FileName = $this->img_05->CurrentValue;

		// img_06
		$this->img_06->EditAttrs["class"] = "form-control";
		$this->img_06->EditCustomAttributes = "";
		$this->img_06->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_06->Upload->DbValue)) {
			$this->img_06->ImageWidth = 100;
			$this->img_06->ImageHeight = 0;
			$this->img_06->ImageAlt = $this->img_06->FldAlt();
			$this->img_06->EditValue = $this->img_06->Upload->DbValue;
		} else {
			$this->img_06->EditValue = "";
		}
		if (!ew_Empty($this->img_06->CurrentValue))
				$this->img_06->Upload->FileName = $this->img_06->CurrentValue;

		// img_07
		$this->img_07->EditAttrs["class"] = "form-control";
		$this->img_07->EditCustomAttributes = "";
		$this->img_07->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_07->Upload->DbValue)) {
			$this->img_07->ImageWidth = 100;
			$this->img_07->ImageHeight = 0;
			$this->img_07->ImageAlt = $this->img_07->FldAlt();
			$this->img_07->EditValue = $this->img_07->Upload->DbValue;
		} else {
			$this->img_07->EditValue = "";
		}
		if (!ew_Empty($this->img_07->CurrentValue))
				$this->img_07->Upload->FileName = $this->img_07->CurrentValue;

		// img_08
		$this->img_08->EditAttrs["class"] = "form-control";
		$this->img_08->EditCustomAttributes = "";
		$this->img_08->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_08->Upload->DbValue)) {
			$this->img_08->ImageWidth = 100;
			$this->img_08->ImageHeight = 0;
			$this->img_08->ImageAlt = $this->img_08->FldAlt();
			$this->img_08->EditValue = $this->img_08->Upload->DbValue;
		} else {
			$this->img_08->EditValue = "";
		}
		if (!ew_Empty($this->img_08->CurrentValue))
				$this->img_08->Upload->FileName = $this->img_08->CurrentValue;

		// img_09
		$this->img_09->EditAttrs["class"] = "form-control";
		$this->img_09->EditCustomAttributes = "";
		$this->img_09->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_09->Upload->DbValue)) {
			$this->img_09->ImageWidth = 100;
			$this->img_09->ImageHeight = 0;
			$this->img_09->ImageAlt = $this->img_09->FldAlt();
			$this->img_09->EditValue = $this->img_09->Upload->DbValue;
		} else {
			$this->img_09->EditValue = "";
		}
		if (!ew_Empty($this->img_09->CurrentValue))
				$this->img_09->Upload->FileName = $this->img_09->CurrentValue;

		// img_10
		$this->img_10->EditAttrs["class"] = "form-control";
		$this->img_10->EditCustomAttributes = "";
		$this->img_10->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_10->Upload->DbValue)) {
			$this->img_10->ImageWidth = 100;
			$this->img_10->ImageHeight = 0;
			$this->img_10->ImageAlt = $this->img_10->FldAlt();
			$this->img_10->EditValue = $this->img_10->Upload->DbValue;
		} else {
			$this->img_10->EditValue = "";
		}
		if (!ew_Empty($this->img_10->CurrentValue))
				$this->img_10->Upload->FileName = $this->img_10->CurrentValue;

		// img_11
		$this->img_11->EditAttrs["class"] = "form-control";
		$this->img_11->EditCustomAttributes = "";
		$this->img_11->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_11->Upload->DbValue)) {
			$this->img_11->ImageWidth = 100;
			$this->img_11->ImageHeight = 0;
			$this->img_11->ImageAlt = $this->img_11->FldAlt();
			$this->img_11->EditValue = $this->img_11->Upload->DbValue;
		} else {
			$this->img_11->EditValue = "";
		}
		if (!ew_Empty($this->img_11->CurrentValue))
				$this->img_11->Upload->FileName = $this->img_11->CurrentValue;

		// img_12
		$this->img_12->EditAttrs["class"] = "form-control";
		$this->img_12->EditCustomAttributes = "";
		$this->img_12->UploadPath = 'uploads/usedcars';
		if (!ew_Empty($this->img_12->Upload->DbValue)) {
			$this->img_12->ImageWidth = 100;
			$this->img_12->ImageHeight = 0;
			$this->img_12->ImageAlt = $this->img_12->FldAlt();
			$this->img_12->EditValue = $this->img_12->Upload->DbValue;
		} else {
			$this->img_12->EditValue = "";
		}
		if (!ew_Empty($this->img_12->CurrentValue))
				$this->img_12->Upload->FileName = $this->img_12->CurrentValue;

		// extra_features
		$this->extra_features->EditCustomAttributes = "";

		// so
		$this->so->EditAttrs["class"] = "form-control";
		$this->so->EditCustomAttributes = "";
		$this->so->EditValue = $this->so->CurrentValue;
		$this->so->PlaceHolder = ew_RemoveHtml($this->so->FldCaption());

		// active
		$this->active->EditAttrs["class"] = "form-control";
		$this->active->EditCustomAttributes = "";
		$this->active->EditValue = $this->active->Options(TRUE);

		// regionalSpec
		$this->regionalSpec->EditAttrs["class"] = "form-control";
		$this->regionalSpec->EditCustomAttributes = "";

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
					if ($this->userCarID->Exportable) $Doc->ExportCaption($this->userCarID);
					if ($this->makeID->Exportable) $Doc->ExportCaption($this->makeID);
					if ($this->modelID->Exportable) $Doc->ExportCaption($this->modelID);
					if ($this->slug->Exportable) $Doc->ExportCaption($this->slug);
					if ($this->yearID->Exportable) $Doc->ExportCaption($this->yearID);
					if ($this->kilometers->Exportable) $Doc->ExportCaption($this->kilometers);
					if ($this->priceAED->Exportable) $Doc->ExportCaption($this->priceAED);
					if ($this->priceUSD->Exportable) $Doc->ExportCaption($this->priceUSD);
					if ($this->priceOMR->Exportable) $Doc->ExportCaption($this->priceOMR);
					if ($this->priceSAR->Exportable) $Doc->ExportCaption($this->priceSAR);
					if ($this->description->Exportable) $Doc->ExportCaption($this->description);
					if ($this->fuelTypeID->Exportable) $Doc->ExportCaption($this->fuelTypeID);
					if ($this->regionalID->Exportable) $Doc->ExportCaption($this->regionalID);
					if ($this->warrantyID->Exportable) $Doc->ExportCaption($this->warrantyID);
					if ($this->noOfDoors->Exportable) $Doc->ExportCaption($this->noOfDoors);
					if ($this->transmissionTypeID->Exportable) $Doc->ExportCaption($this->transmissionTypeID);
					if ($this->cylinderID->Exportable) $Doc->ExportCaption($this->cylinderID);
					if ($this->engine->Exportable) $Doc->ExportCaption($this->engine);
					if ($this->colorID->Exportable) $Doc->ExportCaption($this->colorID);
					if ($this->bodyConditionID->Exportable) $Doc->ExportCaption($this->bodyConditionID);
					if ($this->summary->Exportable) $Doc->ExportCaption($this->summary);
					if ($this->term->Exportable) $Doc->ExportCaption($this->term);
					if ($this->_thumbnail->Exportable) $Doc->ExportCaption($this->_thumbnail);
					if ($this->img_01->Exportable) $Doc->ExportCaption($this->img_01);
					if ($this->img_02->Exportable) $Doc->ExportCaption($this->img_02);
					if ($this->img_03->Exportable) $Doc->ExportCaption($this->img_03);
					if ($this->img_04->Exportable) $Doc->ExportCaption($this->img_04);
					if ($this->img_05->Exportable) $Doc->ExportCaption($this->img_05);
					if ($this->img_06->Exportable) $Doc->ExportCaption($this->img_06);
					if ($this->img_07->Exportable) $Doc->ExportCaption($this->img_07);
					if ($this->img_08->Exportable) $Doc->ExportCaption($this->img_08);
					if ($this->img_09->Exportable) $Doc->ExportCaption($this->img_09);
					if ($this->img_10->Exportable) $Doc->ExportCaption($this->img_10);
					if ($this->img_11->Exportable) $Doc->ExportCaption($this->img_11);
					if ($this->img_12->Exportable) $Doc->ExportCaption($this->img_12);
					if ($this->extra_features->Exportable) $Doc->ExportCaption($this->extra_features);
					if ($this->so->Exportable) $Doc->ExportCaption($this->so);
					if ($this->active->Exportable) $Doc->ExportCaption($this->active);
				} else {
					if ($this->userCarID->Exportable) $Doc->ExportCaption($this->userCarID);
					if ($this->makeID->Exportable) $Doc->ExportCaption($this->makeID);
					if ($this->modelID->Exportable) $Doc->ExportCaption($this->modelID);
					if ($this->slug->Exportable) $Doc->ExportCaption($this->slug);
					if ($this->yearID->Exportable) $Doc->ExportCaption($this->yearID);
					if ($this->kilometers->Exportable) $Doc->ExportCaption($this->kilometers);
					if ($this->priceAED->Exportable) $Doc->ExportCaption($this->priceAED);
					if ($this->priceUSD->Exportable) $Doc->ExportCaption($this->priceUSD);
					if ($this->priceOMR->Exportable) $Doc->ExportCaption($this->priceOMR);
					if ($this->priceSAR->Exportable) $Doc->ExportCaption($this->priceSAR);
					if ($this->description->Exportable) $Doc->ExportCaption($this->description);
					if ($this->fuelTypeID->Exportable) $Doc->ExportCaption($this->fuelTypeID);
					if ($this->regionalID->Exportable) $Doc->ExportCaption($this->regionalID);
					if ($this->warrantyID->Exportable) $Doc->ExportCaption($this->warrantyID);
					if ($this->noOfDoors->Exportable) $Doc->ExportCaption($this->noOfDoors);
					if ($this->transmissionTypeID->Exportable) $Doc->ExportCaption($this->transmissionTypeID);
					if ($this->cylinderID->Exportable) $Doc->ExportCaption($this->cylinderID);
					if ($this->engine->Exportable) $Doc->ExportCaption($this->engine);
					if ($this->colorID->Exportable) $Doc->ExportCaption($this->colorID);
					if ($this->bodyConditionID->Exportable) $Doc->ExportCaption($this->bodyConditionID);
					if ($this->term->Exportable) $Doc->ExportCaption($this->term);
					if ($this->_thumbnail->Exportable) $Doc->ExportCaption($this->_thumbnail);
					if ($this->img_01->Exportable) $Doc->ExportCaption($this->img_01);
					if ($this->img_02->Exportable) $Doc->ExportCaption($this->img_02);
					if ($this->img_03->Exportable) $Doc->ExportCaption($this->img_03);
					if ($this->img_04->Exportable) $Doc->ExportCaption($this->img_04);
					if ($this->img_05->Exportable) $Doc->ExportCaption($this->img_05);
					if ($this->img_06->Exportable) $Doc->ExportCaption($this->img_06);
					if ($this->img_07->Exportable) $Doc->ExportCaption($this->img_07);
					if ($this->img_08->Exportable) $Doc->ExportCaption($this->img_08);
					if ($this->img_09->Exportable) $Doc->ExportCaption($this->img_09);
					if ($this->img_10->Exportable) $Doc->ExportCaption($this->img_10);
					if ($this->img_11->Exportable) $Doc->ExportCaption($this->img_11);
					if ($this->img_12->Exportable) $Doc->ExportCaption($this->img_12);
					if ($this->so->Exportable) $Doc->ExportCaption($this->so);
					if ($this->active->Exportable) $Doc->ExportCaption($this->active);
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
						if ($this->userCarID->Exportable) $Doc->ExportField($this->userCarID);
						if ($this->makeID->Exportable) $Doc->ExportField($this->makeID);
						if ($this->modelID->Exportable) $Doc->ExportField($this->modelID);
						if ($this->slug->Exportable) $Doc->ExportField($this->slug);
						if ($this->yearID->Exportable) $Doc->ExportField($this->yearID);
						if ($this->kilometers->Exportable) $Doc->ExportField($this->kilometers);
						if ($this->priceAED->Exportable) $Doc->ExportField($this->priceAED);
						if ($this->priceUSD->Exportable) $Doc->ExportField($this->priceUSD);
						if ($this->priceOMR->Exportable) $Doc->ExportField($this->priceOMR);
						if ($this->priceSAR->Exportable) $Doc->ExportField($this->priceSAR);
						if ($this->description->Exportable) $Doc->ExportField($this->description);
						if ($this->fuelTypeID->Exportable) $Doc->ExportField($this->fuelTypeID);
						if ($this->regionalID->Exportable) $Doc->ExportField($this->regionalID);
						if ($this->warrantyID->Exportable) $Doc->ExportField($this->warrantyID);
						if ($this->noOfDoors->Exportable) $Doc->ExportField($this->noOfDoors);
						if ($this->transmissionTypeID->Exportable) $Doc->ExportField($this->transmissionTypeID);
						if ($this->cylinderID->Exportable) $Doc->ExportField($this->cylinderID);
						if ($this->engine->Exportable) $Doc->ExportField($this->engine);
						if ($this->colorID->Exportable) $Doc->ExportField($this->colorID);
						if ($this->bodyConditionID->Exportable) $Doc->ExportField($this->bodyConditionID);
						if ($this->summary->Exportable) $Doc->ExportField($this->summary);
						if ($this->term->Exportable) $Doc->ExportField($this->term);
						if ($this->_thumbnail->Exportable) $Doc->ExportField($this->_thumbnail);
						if ($this->img_01->Exportable) $Doc->ExportField($this->img_01);
						if ($this->img_02->Exportable) $Doc->ExportField($this->img_02);
						if ($this->img_03->Exportable) $Doc->ExportField($this->img_03);
						if ($this->img_04->Exportable) $Doc->ExportField($this->img_04);
						if ($this->img_05->Exportable) $Doc->ExportField($this->img_05);
						if ($this->img_06->Exportable) $Doc->ExportField($this->img_06);
						if ($this->img_07->Exportable) $Doc->ExportField($this->img_07);
						if ($this->img_08->Exportable) $Doc->ExportField($this->img_08);
						if ($this->img_09->Exportable) $Doc->ExportField($this->img_09);
						if ($this->img_10->Exportable) $Doc->ExportField($this->img_10);
						if ($this->img_11->Exportable) $Doc->ExportField($this->img_11);
						if ($this->img_12->Exportable) $Doc->ExportField($this->img_12);
						if ($this->extra_features->Exportable) $Doc->ExportField($this->extra_features);
						if ($this->so->Exportable) $Doc->ExportField($this->so);
						if ($this->active->Exportable) $Doc->ExportField($this->active);
					} else {
						if ($this->userCarID->Exportable) $Doc->ExportField($this->userCarID);
						if ($this->makeID->Exportable) $Doc->ExportField($this->makeID);
						if ($this->modelID->Exportable) $Doc->ExportField($this->modelID);
						if ($this->slug->Exportable) $Doc->ExportField($this->slug);
						if ($this->yearID->Exportable) $Doc->ExportField($this->yearID);
						if ($this->kilometers->Exportable) $Doc->ExportField($this->kilometers);
						if ($this->priceAED->Exportable) $Doc->ExportField($this->priceAED);
						if ($this->priceUSD->Exportable) $Doc->ExportField($this->priceUSD);
						if ($this->priceOMR->Exportable) $Doc->ExportField($this->priceOMR);
						if ($this->priceSAR->Exportable) $Doc->ExportField($this->priceSAR);
						if ($this->description->Exportable) $Doc->ExportField($this->description);
						if ($this->fuelTypeID->Exportable) $Doc->ExportField($this->fuelTypeID);
						if ($this->regionalID->Exportable) $Doc->ExportField($this->regionalID);
						if ($this->warrantyID->Exportable) $Doc->ExportField($this->warrantyID);
						if ($this->noOfDoors->Exportable) $Doc->ExportField($this->noOfDoors);
						if ($this->transmissionTypeID->Exportable) $Doc->ExportField($this->transmissionTypeID);
						if ($this->cylinderID->Exportable) $Doc->ExportField($this->cylinderID);
						if ($this->engine->Exportable) $Doc->ExportField($this->engine);
						if ($this->colorID->Exportable) $Doc->ExportField($this->colorID);
						if ($this->bodyConditionID->Exportable) $Doc->ExportField($this->bodyConditionID);
						if ($this->term->Exportable) $Doc->ExportField($this->term);
						if ($this->_thumbnail->Exportable) $Doc->ExportField($this->_thumbnail);
						if ($this->img_01->Exportable) $Doc->ExportField($this->img_01);
						if ($this->img_02->Exportable) $Doc->ExportField($this->img_02);
						if ($this->img_03->Exportable) $Doc->ExportField($this->img_03);
						if ($this->img_04->Exportable) $Doc->ExportField($this->img_04);
						if ($this->img_05->Exportable) $Doc->ExportField($this->img_05);
						if ($this->img_06->Exportable) $Doc->ExportField($this->img_06);
						if ($this->img_07->Exportable) $Doc->ExportField($this->img_07);
						if ($this->img_08->Exportable) $Doc->ExportField($this->img_08);
						if ($this->img_09->Exportable) $Doc->ExportField($this->img_09);
						if ($this->img_10->Exportable) $Doc->ExportField($this->img_10);
						if ($this->img_11->Exportable) $Doc->ExportField($this->img_11);
						if ($this->img_12->Exportable) $Doc->ExportField($this->img_12);
						if ($this->so->Exportable) $Doc->ExportField($this->so);
						if ($this->active->Exportable) $Doc->ExportField($this->active);
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
