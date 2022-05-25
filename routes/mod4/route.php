<?php

Route::namespace('Module4')->group(function () {
//Route::resource("all-vehicles", "VehicleController");
Route::get('all-vehicle','VehicleController@allVehicleList')->name("allVehicles");
Route::get('/load-vehicles','VehicleController@loadVehicles')->name('loadVehicles');
Route::get('/search-vehicles','VehicleController@searchVehicles')->name('searchVehicles');
Route::get('/load-vehicle-stats','VehicleController@loadVehicleStats')->name('loadVehicleStats');
Route::get('/new-vehicle','VehicleController@newVehicle')->name('newVehicle');
Route::get('/all-vehicles/edit/{id}','VehicleController@edit');
Route::get('/edit-vehicle/{id}','VehicleController@editVehicle')->name('editVehicle');
Route::get('/edit-engine/{id}','VehicleController@editEngine')->name('editEngine');
Route::get('/searchLicenseNo','VehicleController@searchLicenseNo')->name('searchLicenseNo');
Route::get('/show_vehicle/{id}','VehicleController@showVehicle')->name('showVehicle');

Route::post('/update-vehicle/{id}','VehicleController@updateVehicle')->name('updateVehicle');
Route::post('/add_village_color_model', 'VehicleController@addVillageColorModel')->name('addVillageColorModel');

/*====================== Vehicle Print pages ======================*/
Route::get('/document_certificate/{id}','VehicleController@documentCertificate');
Route::get('/print-pink2/{id}','VehicleController@printPink2');
Route::get('/pink2/{id}','VehicleController@pink2');
Route::get('/book/{id}','VehicleController@book');
Route::get('/print-transfer/{id}','VehicleController@printTransfer');
Route::get('/eliminate-license/{id}','VehicleController@eliminateLicense');
Route::get('/certificate-used/{id}','VehicleController@certificateUsed');
Route::get('/certificate/{id}','VehicleController@certificate');
Route::get('/damaged-certificate/{id}','VehicleController@damagedCertificate');
Route::get('/document-certificate/{id}','VehicleController@documentCertificate');

/*====================== Vehicle Modals ======================*/
Route::get('/transfer-modal/{id}','VehicleController@transferModal');
Route::get('/pink-paper-modal','VehicleController@pinkPaperModal');
Route::get('/add_vehicle_modal','VehicleController@add_vehicle_modal')->name('add_vehicle_modal');
Route::get('/card_modal','VehicleController@card_modal')->name('card_modal');
/*====================== Print Button Modal Pages ======================*/
Route::get('/print-buttons-modal','VehicleController@printButtonsModal');
Route::post('/save-vehicle_print_detail','VehiclePrintDetailController@saveVehiclePrintDetail')->name('saveVehiclePrintDetail');
Route::post('/vehicle_prints','VehiclePrintDetailController@vehiclePrints');

/*====================== Vehicle Over System Controller ======================*/
Route::get('/vehicle-over-system-modal','VehicleOverSystemController@vehicleOverSystemModal')->name('vehicleOverSystemModal');
Route::get('/load_vehicle_over_system','VehicleOverSystemController@loadVehicleOverSystem')->name('loadVehicleOverSystem');
Route::post('/save_vehicle_over_system','VehicleOverSystemController@saveVehicleOverSystem')->name('saveVehicleOverSystem');
Route::get('/document_certificate_over_system/{id}','VehicleOverSystemController@documentCertificateOverSystem');

Route::resource("vehicle-transfer", "VehicleTransfer");
Route::get('/transfer-info/{action}/{tranid}',"VehicleTransfer@transferInfo");
Route::get('/transfer-out-action/{action}/{appformid}/{tranno}',"VehicleTransfer@transferOutAction");
Route::get('/transfer-in-action/{action}/{appformid}/{tranno}/{tranto}',"VehicleTransfer@transferInAction");
Route::post('/transfer-in-actions',"VehicleTransfer@transferInActions");
Route::post('/transfer-approve-all','VehicleTransfer@approveAllTransfers');
Route::get('/search-transfer','VehicleTransfer@searchTransfer')->name('searchTransfer');
Route::get('/vehicle-transfer-list/{type}','VehicleTransfer@transferList');
Route::resource("applications","ApplicationController");
Route::get('/search-app-number','ApplicationController@SearchAppNo')->name('app-number');
Route::get('/search-app-number/{app_no}',"ApplicationController@scanQrCode");
Route::post('/application/vehicle-document','ApplicationController@addDocument')->name('addDocument');
Route::delete('/application/delete/document/{id}',"ApplicationController@deleteVehDocument");
Route::get('/search-licence','VehicleTransfer@searchLicence');

//Route::resource('vehicle-inspection','VehicleInspectionController');
Route::get('vehicle-inspection','VehicleInspectionController@index')->name('vehicle-inspection.index');
Route::get('/search-vehicle-inspection','VehicleInspectionController@searchVehicleInspection')->name('searchVehicleInspection');
Route::get('/vehicle-inspection-modal/{id}','VehicleInspectionController@vehicleInspectionModal')->name('vehicleInspectionModal');
Route::get('/add-vehicle-inspection-modal/{id}','VehicleInspectionController@addVehicleInspectionModal')->name('addVehicleInspectionModal');
Route::get('/update-vehicle-inspection-modal/{id}/{v_id}','VehicleInspectionController@updateVehicleInspectionModal')->name('updateVehicleInspectionModal');
Route::post('/save-vehicle-inspection','VehicleInspectionController@saveVehicleInspection')->name('saveVehicleInspection');

Route::get('/change-info','ChangeInformation@changeInfo');
Route::post('/change-info','ChangeInformation@saveVehiceInfo');
Route::post('/store-app-form-detail','ApplicationController@storeAppFormDetail');
// Route::get('/request-approve','VehicleTransfer@approveTransfer')->name('vehicle-transfer.request');
Route::resource('document-management',"DocumentManagementController");
Route::post('vehicle/change-info/{licence}','VehicleController@changeInfo');
Route::resource('license-history',"LicenseHistoryController");
Route::resource('division-no-control',"DivisionControlController");	
Route::resource('division-no-sub-control',"DivisionSubControlController");	
Route::resource('province-no-control',"ProvinceNocontrolController");
Route::resource('division-no-sub-control',"DivisionNosubControlController");

//write at thai team	
Route::resource('registraion-number-control','RegistrationNumberController');
Route::resource('sub-license-number-control','SubLicenseNumberController');
Route::get('sub-license-number-control-1/{province}/{vehicle_kind}/{alphabet}','SubLicenseNumberController@sub1');
Route::get('sub-license-number-control-2/{province}/{vehicle_kind}/{alphabet}/{licensepresent}','SubLicenseNumberController@sub2');
Route::get('sub-license-number-control-detail/{province}/{vehicle_kind}/{alphabet}/{licensepresent}','SubLicenseNumberController@subdetail');
//end thai team
Route::resource('license-alphabet',"LicenseAlphabet");
Route::resource('alphabet-control','AlphabetControlController');
Route::resource('license-number-sale','LicenseNumberSaleController');
Route::resource('license-number-not-sale','LicenseNumberNotSaleController');
Route::resource('license-number-booking','LicenseNumberBookingController');
Route::resource('license-no-present','LicenseNoPresentController');
Route::post('/change_alert_at','LicenseNoPresentController@changeAlertAt');

Route::post('/new-appform/{vehicle_id}','VehicleButton@newAppForm');
Route::post('/new-form-pink-paper/{vehicle_id}', 'VehicleButton@newFormWithPinkpaper');
Route::post('/book-print/{vehicle_id}', 'VehicleButton@bookPrint');
Route::get('/get-new-form-pink-paper/{id}', 'VehicleButton@getNewPrintPaper');

Route::resource('vehicle-tenant', 'VehicleTenant');
Route::post('/veh-document/{id}','VehDocument@attchDocument');
Route::post('/update-vdocument', 'VehDocument@updateDocument')->name('updatevDocument');

Route::get('/getLicenceNo/{id}', 'VehicleController@getLicenceNo');
Route::get('/getDivNo/{pro_code}/{pro_Name}', 'VehicleController@getDivAndProNo');
Route::resource('traffic-police','TrafficPoliceController');
Route::get('/show-traffic-police/{id}','TrafficPoliceController@showTrafficPolice')->name('showTrafficPolice');
Route::get('/search-traffic-police','TrafficPoliceController@searchTrafficPolice')->name('searchTrafficPolice');
Route::post('/division-traffic', 'TrafficPoliceController@SearchDivision'); 
Route::get('/fetch', 'VehicleController@vehicleList')->name('vehicleList');
Route::get('/check-license', 'LicenseNumberBookingController@checkRecord');
Route::get('/appList','ApplicationController@applicationList')->name('appList');
Route::get('/get-unit-price/{price_item_id}','LicenseNumberSaleController@getUnitPrice');
Route::post('/check-vehicle-type/{vehicle_type_id}','VehicleButton@checkLicenseAndVehType');
Route::get('/getBuyLicenseNo/{app_id}','VehicleController@getLicNoChangeVehicleKind');
Route::get('/search-license','VehicleButton@searchLicense');
Route::get('/get-customer-name/{app_id}', 'LicenseNumberBookingController@geCustomerName');

Route::get('/getNotSale','LicenseNumberNotSaleController@getNumber');
Route::get('/getLicSale','LicenseNumberSaleController@getNumber');
Route::get('/check-license-alphabet', 'AlphabetControlController@checkLicense');
Route::get('/check-division', 'DivisionControlController@checkDivision');
Route::get('/check-division-status/', 'DivisionControlController@checkDivisionStatus');
Route::get('/get-license-present', 'LicenseNoPresentController@checkPresentStatus');
Route::get('/check-alphabet', 'LicenseAlphabet@checkAlphabet');
Route::post('/save-license-not-sale', 'LicenseNumberNotSaleController@saveFromOtherForm');

/*====================== Vehicle History ======================*/
Route::resource('vehicle_history','VehicleHistoryController');
Route::get('/search_vehicle_history','VehicleHistoryController@searchVehicleHistory')->name('searchVehicleHistory');
Route::get('/edit_vehicle_history','VehicleHistoryController@editVehicleHistory')->name('editVehicleHistory');

});
