<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*user Login */

 Route::get('/','LoginController@loginForm');
 Route::get('/customer/login','LoginController@customerLoginForm');
 Route::post('/user-login','LoginController@authenticate')->name('user-login');
 Route::post('/protected-login', 'LoginController@protectedLogin');
 Route::post('/user/logout', 'LoginController@getLogout')->name('user.logout');
Auth::routes();

/* Create password by customer and staff  */
    Route::get('create-new-password/{id}','HomeController@newPassBystaff');
    Route::post('create-new-password/{id}','HomeController@saveNewPassBystaff');

    Route::group(['middleware' => ['auth','admin']], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::resource('api-user','ApiUserController');
    Route::get('customer-list','UserController@customerList');
    Route::resource('permission','PermissionController');
    Route::post('user/reset/{id}','UserController@resetPassword')->name('users.reset');
    Route::get('change-password','ChangePassword@passForm');
    Route::post('change-password','ChangePassword@saveNewPassword');
    Route::post("change-status/{id}/status/{status}","UserController@customerStatus");


    include __DIR__."/car-register/route.php";
    include __DIR__."/admin/route.php";
    include __DIR__."/financial/route.php";
    include __DIR__."/mod4/route.php";
    include __DIR__."/mod5/route.php";
    include __DIR__."/mod6/route.php";
    //start vrms version2 route
    include __DIR__."/vrms2.php";
Route::resource('app-status','AppStatusController');
//Route::resource('app-form','AppFormController');
Route::resource('app-document','AppDocumentController');
Route::resource('app-item-detail','AppItemDetailController');
Route::resource('color','ColorController');
Route::resource('inspect-place', 'InspectPlaceController');
Route::resource('import-company','ImporterCompany');
Route::resource('importer','ManageImporter');
Route::resource('action-log','ActionLogController');

Route::get('send', 'HomeController@sendNotification');

// Route::resource('license-no-control','LicenseNoConrolController');
Route::resource('gas','ManageGas');
Route::resource('standard','ManageStandard');
Route::resource('check-result','ManageCheckResult');

//route for report
Route::resource('registration-report','RegistrationTransferReports');
Route::Post('registration-report','RegistrationTransferReports@RegistrationReportSearch');
Route::get('pre-registration-report','RegistrationTransferReports@PreRegReport')->name('pre-registration-report.index');
Route::Post('pre-registration-report','RegistrationTransferReports@PreRegReportSearch');
Route::get('transfer-change-report','RegistrationTransferReports@TranChangeReport')->name('transfer-change-report.index');
Route::Post('transfer-change-report','RegistrationTransferReports@TranChangeReportSearch');
Route::get('print-passport-report','RegistrationTransferReports@PrintPassportReport')->name('print-passport-report.index');
Route::Post('print-passport-report','RegistrationTransferReports@PrintPassportReportSearch');
Route::resource('user-report','UserReportController');
Route::Post('user-report','UserReportController@UserReportSearch');
Route::get('print-card-report','RegistrationTransferReports@printCardReport');
Route::Post('print-card-report','RegistrationTransferReports@printCardReportSearch');

//route for display screen 
Route::resource('display','DisplayController');
Route::post('display','DisplayController@Search');
Route::post('display/update','DisplayController@update');
Route::get('display/delete/{app_number}','DisplayController@destroy')->name('display.delete');
Route::get('display-screen/{id}','DisplayScreenController@DisplayScreen')->name('display-screen.display-screen');
Route::get('manage-screen-display', 'DisplayScreenController@ManageScreenDisplay')->name('manage-display-screen.index');
Route::get('/manage-screen-display/{display_screen}','DisplayScreenController@destroy');
//end

//route for Price List display screen 
/*
Route::resource('display','DisplayController');
Route::post('display','DisplayController@Search');
Route::post('display/update','DisplayController@update');
Route::get('display/delete/{app_number}','DisplayController@destroy')->name('display.delete');
*/
Route::get('price-list-display-screen/{pcode}/{cid}','PriceListDisplayScreenController@PriceListDisplayScreen')->name('price-list-display-screen.display-screen');
//end

});

//Forgot password link by admin
Route::get('password-reset/{email}', 'UserPassword@resetPasswordForm');
Route::post('password-reset/{email}','UserPassword@saveResetPassword');

//forgot password link guest user
Route::get('password/reset/', 'UserPassword@resetEmailForm');
Route::post('password/reset/', 'UserPassword@ToSendResetMail');


//dropdown list route
Route::get('getPtype/{name}','GetDropdownList@getPermissionType');
Route::get('getdistrict/{code}', 'GetDropdownList@getDistrict');
Route::get('getVmodel/{brand}', 'GetDropdownList@getVmodel');
Route::get('/get-service-counter/{province_code}', 'GetDropdownList@getServiceCounter');
Route::get('/get-app-form', 'GetDropdownList@getAppFormByProvince');
Route::get('/get-alphabet', 'GetDropdownList@getAlphabet');
Route::get('/get-alphabet-next', 'GetDropdownList@getAlphabetNext');
Route::get('/check-license-booking', 'GetDropdownList@checkLicenseBooking');
Route::get('/check-province-control', 'GetDropdownList@checkProvinceStatus');
Route::get('/get-bill-no', 'GetDropdownList@getBillNo');
Route::get('lang/{locale}','HomeController@lang');
Route::get('/get_alphabet_control', 'GetDropdownList@getAlphabetControl');

include __DIR__."/customer/route.php";
include __DIR__."/notification.php";

Route::get('userAccess',function(){
    return view('unauthorized');
});

// testing import and export
Route::get('/testing-import', 'TestingController@index'); 
Route::post('/uploadFile', 'TestingController@uploadFile')->name('import');
Route::post('save-table','TestingController@saveOtherDB');
Route::get('test-qr','TestingController@qrCode');
Route::get('get-vehicle-id','TestingController@getVehicleId');
Route::post('/store-vehicle-id', 'TestingController@addVehilceId')->name('save.vehicleId');
// end testing route

//route for user guide
Route::get('api-guide','HomeController@apiGuide');	
Route::get('smart-card-api-guide','HomeController@smartcardGuide');

//technical inspect
Route::resource('technical-inspect','TechnicalInspectController');

//setting route for display and smartcard
Route::resource('display-setting','Setting\DisplaySettingController');
Route::get('smartcard-setting', 'Setting\DisplaySettingController@smartCardSetting');
Route::post('smartcard-setting/{id}', 'Setting\DisplaySettingController@updateSmartCartSetting');
Route::get('/smart-card-sign', 'Setting\SmartCardSign@smartCard');
Route::post('/smart-card-sign', 'Setting\SmartCardSign@uploadsmartCard')->name('smartCard.store');

Route::get('/price-list-display-setting', 'Setting\PriceListDisplaySettingController@priceListDisplaySetting');
Route::post('/price-list-display-setting', 'Setting\PriceListDisplaySettingController@uploadPriceListDisplaySetting')->name('priceListDisplaySetting.store');
Route::post('/save-price-list-display', 'Setting\PriceListDisplaySettingController@savePriceListDisplay')->name('priceListDisplay.store');



Route::get('retrieve-data', 'HomeController@retrieveData');






























