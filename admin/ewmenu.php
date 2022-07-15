<?php

// Menu
$RootMenu = new cMenu("RootMenu", TRUE);
$RootMenu->AddMenuItem(274, "mi_pg_transactions", $Language->MenuPhrase("274", "MenuText"), "pg_transactionslist.php", -1, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}pg_transactions'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(17, "mci_Home", $Language->MenuPhrase("17", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(15, "mi_sliders", $Language->MenuPhrase("15", "MenuText"), "sliderslist.php", 17, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}sliders'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(11, "mi_home_stats", $Language->MenuPhrase("11", "MenuText"), "home_statslist.php", 17, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}home_stats'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(25, "mi_home_apps", $Language->MenuPhrase("25", "MenuText"), "home_appslist.php", 17, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}home_apps'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(171, "mi_rental_guide", $Language->MenuPhrase("171", "MenuText"), "rental_guidelist.php", 17, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}rental_guide'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(273, "mi_home_document_required", $Language->MenuPhrase("273", "MenuText"), "home_document_requiredlist.php", 17, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}home_document_required'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(270, "mi_car_hire", $Language->MenuPhrase("270", "MenuText"), "car_hirelist.php", 17, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}car_hire'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(110, "mci_Masters", $Language->MenuPhrase("110", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(3, "mi_mtr_country", $Language->MenuPhrase("3", "MenuText"), "mtr_countrylist.php", 110, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}mtr_country'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(2, "mi_mtr_city", $Language->MenuPhrase("2", "MenuText"), "mtr_citylist.php", 110, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}mtr_city'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(84, "mi_mtr_nationality", $Language->MenuPhrase("84", "MenuText"), "mtr_nationalitylist.php", 110, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}mtr_nationality'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(74, "mi_mtr_make", $Language->MenuPhrase("74", "MenuText"), "mtr_makelist.php", 110, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}mtr_make'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(75, "mi_mtr_model", $Language->MenuPhrase("75", "MenuText"), "mtr_modellist.php", 110, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}mtr_model'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(85, "mi_mtr_transmission", $Language->MenuPhrase("85", "MenuText"), "mtr_transmissionlist.php", 110, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}mtr_transmission'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(79, "mi_mtr_year", $Language->MenuPhrase("79", "MenuText"), "mtr_yearlist.php", 110, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}mtr_year'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(78, "mi_mtr_warranty", $Language->MenuPhrase("78", "MenuText"), "mtr_warrantylist.php", 110, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}mtr_warranty'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(76, "mi_mtr_regional_spec", $Language->MenuPhrase("76", "MenuText"), "mtr_regional_speclist.php", 110, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}mtr_regional_spec'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(68, "mi_mtr_bodytype", $Language->MenuPhrase("68", "MenuText"), "mtr_bodytypelist.php", 110, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}mtr_bodytype'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(67, "mi_mtr_body_condition", $Language->MenuPhrase("67", "MenuText"), "mtr_body_conditionlist.php", 110, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}mtr_body_condition'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(73, "mi_mtr_fuel_type", $Language->MenuPhrase("73", "MenuText"), "mtr_fuel_typelist.php", 110, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}mtr_fuel_type'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(72, "mi_mtr_extra_features", $Language->MenuPhrase("72", "MenuText"), "mtr_extra_featureslist.php", 110, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}mtr_extra_features'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(71, "mi_mtr_cylinder", $Language->MenuPhrase("71", "MenuText"), "mtr_cylinderlist.php", 110, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}mtr_cylinder'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(70, "mi_mtr_color", $Language->MenuPhrase("70", "MenuText"), "mtr_colorlist.php", 110, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}mtr_color'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(215, "mci_Individual", $Language->MenuPhrase("215", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(162, "mci_Rent_Cars", $Language->MenuPhrase("162", "MenuText"), "", 215, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(81, "mi_rent_lease_cars", $Language->MenuPhrase("81", "MenuText"), "rent_lease_carslist.php", 162, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}rent_lease_cars'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(80, "mi_pickup_drop_locations", $Language->MenuPhrase("80", "MenuText"), "pickup_drop_locationslist.php", 162, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}pickup_drop_locations'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(170, "mi_lease_cars", $Language->MenuPhrase("170", "MenuText"), "lease_carslist.php", 215, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}lease_cars'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(176, "mi_pay_as_you_drive", $Language->MenuPhrase("176", "MenuText"), "pay_as_you_drivelist.php", 215, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}pay_as_you_drive'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(216, "mci_Corporate", $Language->MenuPhrase("216", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(166, "mi_corporate_leasing", $Language->MenuPhrase("166", "MenuText"), "corporate_leasinglist.php", 216, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}corporate_leasing'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(172, "mi_corporate_sidebar", $Language->MenuPhrase("172", "MenuText"), "corporate_sidebarlist.php", 216, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}corporate_sidebar'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(83, "mi_users", $Language->MenuPhrase("83", "MenuText"), "userslist.php", -1, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}users'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(18, "mci_About", $Language->MenuPhrase("18", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(10, "mi_about_us", $Language->MenuPhrase("10", "MenuText"), "about_uslist.php", 18, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}about_us'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(9, "mi_about_stats", $Language->MenuPhrase("9", "MenuText"), "about_statslist.php", 18, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}about_stats'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(62, "mci_Services", $Language->MenuPhrase("62", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(45, "mi_mtr_service_type", $Language->MenuPhrase("45", "MenuText"), "mtr_service_typelist.php", 62, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}mtr_service_type'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(46, "mi_services", $Language->MenuPhrase("46", "MenuText"), "serviceslist.php", 62, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}services'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(27, "mi_promotions", $Language->MenuPhrase("27", "MenuText"), "promotionslist.php", -1, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}promotions'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(297, "mci_Blog", $Language->MenuPhrase("297", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(13, "mi_news", $Language->MenuPhrase("13", "MenuText"), "newslist.php", 297, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}news'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(272, "mi_car_listing_blog", $Language->MenuPhrase("272", "MenuText"), "car_listing_bloglist.php", 297, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}car_listing_blog'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(42, "mci_Customer_Care", $Language->MenuPhrase("42", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(43, "mci_Locations", $Language->MenuPhrase("43", "MenuText"), "", 42, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(26, "mi_mtr_locations", $Language->MenuPhrase("26", "MenuText"), "mtr_locationslist.php", 43, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}mtr_locations'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(28, "mi_region", $Language->MenuPhrase("28", "MenuText"), "regionlist.php", 43, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}region'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(22, "mi_branches", $Language->MenuPhrase("22", "MenuText"), "brancheslist.php", 43, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}branches'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(23, "mi_faqs", $Language->MenuPhrase("23", "MenuText"), "faqslist.php", 42, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}faqs'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(271, "mi_terms_conditions", $Language->MenuPhrase("271", "MenuText"), "terms_conditionslist.php", -1, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}terms_conditions'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(19, "mci_Notifications", $Language->MenuPhrase("19", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(4, "mi_notification_options", $Language->MenuPhrase("4", "MenuText"), "notification_optionslist.php", 19, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}notification_options'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(5, "mi_notification_recipients", $Language->MenuPhrase("5", "MenuText"), "notification_recipientslist.php", 19, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}notification_recipients'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(7, "mi_smtp_details", $Language->MenuPhrase("7", "MenuText"), "smtp_detailslist.php", 19, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}smtp_details'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(20, "mci_Inbox", $Language->MenuPhrase("20", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(269, "mci_Bookings", $Language->MenuPhrase("269", "MenuText"), "", 20, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(165, "mi_inb_bookings", $Language->MenuPhrase("165", "MenuText"), "inb_bookingslist.php", 269, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}inb_bookings'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(218, "mi_inb_bookings_pay_as_you_drive", $Language->MenuPhrase("218", "MenuText"), "inb_bookings_pay_as_you_drivelist.php", 269, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}inb_bookings_pay_as_you_drive'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(24, "mi_inb_contactus", $Language->MenuPhrase("24", "MenuText"), "inb_contactuslist.php", 20, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}inb_contactus'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(12, "mi_inb_subscribe", $Language->MenuPhrase("12", "MenuText"), "inb_subscribelist.php", 20, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}inb_subscribe'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(44, "mi_inb_enquiry", $Language->MenuPhrase("44", "MenuText"), "inb_enquirylist.php", 20, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}inb_enquiry'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(87, "mi_inb_reportbreakdown", $Language->MenuPhrase("87", "MenuText"), "inb_reportbreakdownlist.php", 20, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}inb_reportbreakdown'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(299, "mi_inb_rent_cars_enquiry", $Language->MenuPhrase("299", "MenuText"), "inb_rent_cars_enquirylist.php", 20, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}inb_rent_cars_enquiry'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(298, "mi_inb_payasyoudrive_enquiry", $Language->MenuPhrase("298", "MenuText"), "inb_payasyoudrive_enquirylist.php", 20, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}inb_payasyoudrive_enquiry'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(65, "mi_inb_used_cars_enquiry", $Language->MenuPhrase("65", "MenuText"), "inb_used_cars_enquirylist.php", 20, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}inb_used_cars_enquiry'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(213, "mci_Lease_Cars", $Language->MenuPhrase("213", "MenuText"), "", 20, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(175, "mi_inb_new_vehicle_enquiry", $Language->MenuPhrase("175", "MenuText"), "inb_new_vehicle_enquirylist.php", 213, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}inb_new_vehicle_enquiry'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(169, "mi_inb_leasecars_enquiry", $Language->MenuPhrase("169", "MenuText"), "inb_leasecars_enquirylist.php", 213, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}inb_leasecars_enquiry'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(174, "mi_inb_feedbacks", $Language->MenuPhrase("174", "MenuText"), "inb_feedbackslist.php", 20, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}inb_feedbacks'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(214, "mci_Corporate", $Language->MenuPhrase("214", "MenuText"), "", 20, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(173, "mi_inb_corporate_leasing", $Language->MenuPhrase("173", "MenuText"), "inb_corporate_leasinglist.php", 214, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}inb_corporate_leasing'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(168, "mi_inb_corporate_solutions", $Language->MenuPhrase("168", "MenuText"), "inb_corporate_solutionslist.php", 214, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}inb_corporate_solutions'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(21, "mci_Others", $Language->MenuPhrase("21", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(14, "mi_pages_static", $Language->MenuPhrase("14", "MenuText"), "pages_staticlist.php", 21, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}pages_static'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(217, "mi_others", $Language->MenuPhrase("217", "MenuText"), "otherslist.php", 21, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}others'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(64, "mi_contact_map", $Language->MenuPhrase("64", "MenuText"), "contact_maplist.php", 21, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}contact_map'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(66, "mi_meta_datas", $Language->MenuPhrase("66", "MenuText"), "meta_dataslist.php", 21, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}meta_datas'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(8, "mi_socials", $Language->MenuPhrase("8", "MenuText"), "socialslist.php", 21, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}socials'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(1, "mi_cms_users", $Language->MenuPhrase("1", "MenuText"), "cms_userslist.php", 21, "", IsLoggedIn() || AllowListMenu('{F745D41A-D8C3-4E57-B065-3A7F49376673}cms_users'), FALSE, FALSE, "");
echo $RootMenu->ToScript();
?>
<div class="ewVertical" id="ewMenu"></div>
