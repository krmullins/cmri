<?php
// This script and data application were generated by AppGini 23.16
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/Donations.php');
	include_once(__DIR__ . '/Donations_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('Donations');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'Donations';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`Donations`.`ID`" => "ID",
		"DATE_FORMAT(`Donations`.`Date`, '%h:%i %p')" => "Date",
		"CONCAT('$', FORMAT(`Donations`.`Amount`, 2))" => "Amount",
		"`Donations`.`Description`" => "Description",
		"IF(    CHAR_LENGTH(`Supporters1`.`LastName`) || CHAR_LENGTH(`Supporters1`.`Name`), CONCAT_WS('',   `Supporters1`.`LastName`, ', ', `Supporters1`.`Name`), '') /* Supporter */" => "SupporterID",
		"IF(    CHAR_LENGTH(`Campaigns1`.`CampaignName`), CONCAT_WS('',   `Campaigns1`.`CampaignName`), '') /* Campaign */" => "CampaignID",
		"`Donations`.`Paytype`" => "Paytype",
		"concat('<i class=\"glyphicon glyphicon-', if(`Donations`.`Matching`, 'check', 'unchecked'), '\"></i>')" => "Matching",
		"concat('<i class=\"glyphicon glyphicon-', if(`Donations`.`Anonymous`, 'check', 'unchecked'), '\"></i>')" => "Anonymous",
		"concat('<i class=\"glyphicon glyphicon-', if(`Donations`.`Acknowledged`, 'check', 'unchecked'), '\"></i>')" => "Acknowledged",
		"`Donations`.`Notes`" => "Notes",
		"if(`Donations`.`DateLink`,date_format(`Donations`.`DateLink`,'%m/%d/%Y'),'')" => "DateLink",
		"`Donations`.`MemoryOf`" => "MemoryOf",
		"`Donations`.`HonorOf`" => "HonorOf",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`Donations`.`ID`',
		2 => '`Donations`.`Date`',
		3 => '`Donations`.`Amount`',
		4 => 4,
		5 => 5,
		6 => '`Campaigns1`.`CampaignName`',
		7 => 7,
		8 => '`Donations`.`Matching`',
		9 => '`Donations`.`Anonymous`',
		10 => '`Donations`.`Acknowledged`',
		11 => 11,
		12 => '`Donations`.`DateLink`',
		13 => 13,
		14 => 14,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`Donations`.`ID`" => "ID",
		"DATE_FORMAT(`Donations`.`Date`, '%h:%i %p')" => "Date",
		"CONCAT('$', FORMAT(`Donations`.`Amount`, 2))" => "Amount",
		"`Donations`.`Description`" => "Description",
		"IF(    CHAR_LENGTH(`Supporters1`.`LastName`) || CHAR_LENGTH(`Supporters1`.`Name`), CONCAT_WS('',   `Supporters1`.`LastName`, ', ', `Supporters1`.`Name`), '') /* Supporter */" => "SupporterID",
		"IF(    CHAR_LENGTH(`Campaigns1`.`CampaignName`), CONCAT_WS('',   `Campaigns1`.`CampaignName`), '') /* Campaign */" => "CampaignID",
		"`Donations`.`Paytype`" => "Paytype",
		"`Donations`.`Matching`" => "Matching",
		"`Donations`.`Anonymous`" => "Anonymous",
		"`Donations`.`Acknowledged`" => "Acknowledged",
		"`Donations`.`Notes`" => "Notes",
		"if(`Donations`.`DateLink`,date_format(`Donations`.`DateLink`,'%m/%d/%Y'),'')" => "DateLink",
		"`Donations`.`MemoryOf`" => "MemoryOf",
		"`Donations`.`HonorOf`" => "HonorOf",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`Donations`.`ID`" => "ID",
		"`Donations`.`Date`" => "Date",
		"`Donations`.`Amount`" => "Amount",
		"`Donations`.`Description`" => "Description",
		"IF(    CHAR_LENGTH(`Supporters1`.`LastName`) || CHAR_LENGTH(`Supporters1`.`Name`), CONCAT_WS('',   `Supporters1`.`LastName`, ', ', `Supporters1`.`Name`), '') /* Supporter */" => "Supporter",
		"IF(    CHAR_LENGTH(`Campaigns1`.`CampaignName`), CONCAT_WS('',   `Campaigns1`.`CampaignName`), '') /* Campaign */" => "Campaign",
		"`Donations`.`Paytype`" => "Payment Type",
		"`Donations`.`Matching`" => "Matching",
		"`Donations`.`Anonymous`" => "Anonymous",
		"`Donations`.`Acknowledged`" => "Acknowledged",
		"`Donations`.`Notes`" => "Notes",
		"`Donations`.`DateLink`" => "DateLink",
		"`Donations`.`MemoryOf`" => "In Memory Of",
		"`Donations`.`HonorOf`" => "In Honor Of",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`Donations`.`ID`" => "ID",
		"DATE_FORMAT(`Donations`.`Date`, '%h:%i %p')" => "Date",
		"CONCAT('$', FORMAT(`Donations`.`Amount`, 2))" => "Amount",
		"`Donations`.`Description`" => "Description",
		"IF(    CHAR_LENGTH(`Supporters1`.`LastName`) || CHAR_LENGTH(`Supporters1`.`Name`), CONCAT_WS('',   `Supporters1`.`LastName`, ', ', `Supporters1`.`Name`), '') /* Supporter */" => "SupporterID",
		"IF(    CHAR_LENGTH(`Campaigns1`.`CampaignName`), CONCAT_WS('',   `Campaigns1`.`CampaignName`), '') /* Campaign */" => "CampaignID",
		"`Donations`.`Paytype`" => "Paytype",
		"concat('<i class=\"glyphicon glyphicon-', if(`Donations`.`Matching`, 'check', 'unchecked'), '\"></i>')" => "Matching",
		"concat('<i class=\"glyphicon glyphicon-', if(`Donations`.`Anonymous`, 'check', 'unchecked'), '\"></i>')" => "Anonymous",
		"concat('<i class=\"glyphicon glyphicon-', if(`Donations`.`Acknowledged`, 'check', 'unchecked'), '\"></i>')" => "Acknowledged",
		"`Donations`.`Notes`" => "Notes",
		"if(`Donations`.`DateLink`,date_format(`Donations`.`DateLink`,'%m/%d/%Y'),'')" => "DateLink",
		"`Donations`.`MemoryOf`" => "MemoryOf",
		"`Donations`.`HonorOf`" => "HonorOf",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['SupporterID' => 'Supporter', 'CampaignID' => 'Campaign', ];

	$x->QueryFrom = "`Donations` LEFT JOIN `Supporters` as Supporters1 ON `Supporters1`.`ID`=`Donations`.`SupporterID` LEFT JOIN `Campaigns` as Campaigns1 ON `Campaigns1`.`ID`=`Donations`.`CampaignID` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm['view'] == 0 ? 1 : 0);
	$x->AllowDelete = $perm['delete'];
	$x->AllowMassDelete = (getLoggedAdmin() !== false);
	$x->AllowInsert = $perm['insert'];
	$x->AllowUpdate = $perm['edit'];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = 1;
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowPrintingDV = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 50;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation['quick search'];
	$x->ScriptFileName = 'Donations_view.php';
	$x->RedirectAfterInsert = 'Donations_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Donations';
	$x->TableIcon = 'resources/table_icons/32Px - 385.png';
	$x->PrimaryKey = '`Donations`.`ID`';

	$x->ColWidth = [150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 100, ];
	$x->ColCaption = ['Date', 'Amount', 'Description', 'Supporter', 'Campaign', 'Payment Type', 'Matching', 'Anonymous', 'Acknowledged', 'Notes', 'Matching Funds', ];
	$x->ColFieldName = ['Date', 'Amount', 'Description', 'SupporterID', 'CampaignID', 'Paytype', 'Matching', 'Anonymous', 'Acknowledged', 'Notes', '%MatchingFunds.DonationID%', ];
	$x->ColNumber  = [2, 3, 4, 5, 6, 7, 8, 9, 10, 11, -1, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/Donations_templateTV.html';
	$x->SelectedTemplate = 'templates/Donations_templateTVS.html';
	$x->TemplateDV = 'templates/Donations_templateDV.html';
	$x->TemplateDVP = 'templates/Donations_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = true;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: Donations_init
	$render = true;
	if(function_exists('Donations_init')) {
		$args = [];
		$render = Donations_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: Donations_header
	$headerCode = '';
	if(function_exists('Donations_header')) {
		$args = [];
		$headerCode = Donations_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: Donations_footer
	$footerCode = '';
	if(function_exists('Donations_footer')) {
		$args = [];
		$footerCode = Donations_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
