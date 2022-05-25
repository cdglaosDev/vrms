<?php
	Route::get('district/{code}', function($code){
		$district = \App\Model\District::where("province_code",$code)->pluck("name","district_code");
	 	return response()->json($district);
	});

	Route::group(['prefix' => 'customer','namespace' => 'Customer'], function () {
	Route::get('/','Dashboard@customer');
 	Route::get('register','Register@registerCustomer');
 	Route::post('register','Register@storeCustomer')->name('customer.register');
 	Route::resource('company','Company');
 	Route::resource('app','Application');
 	Route::get('apps/{status}','Application@allApp');
 	Route::resource('staff','StaffController');
 	Route::get('profile','AccountSetting@profile')->name('profile');
 	Route::get('profile/edit','AccountSetting@editProfile')->name('editProfile');
	Route::post('profile/edit/','AccountSetting@updateProfile')->name('updateProfile');
	
	Route::resource('vehicle-detail','VehicleDetailController');
	Route::get('appform/{id}','VehicleDetailController@appformDetail');
	Route::get('print/{id}','VehicleDetailController@printForm');
	

	Route::get('/vehicle-detail/{delete}/{id}','VehicleDetailController@docDelete');
	Route::post('adddocument' ,'VehicleDetailController@newDocument')->name('add-document');
	Route::get('search-vehicle','VehicleDetailController@searchVehicle');
	Route::get('search','VehicleDetailController@resultVehicle')->name('search');

	Route::patch('/app-form-update/{id}','VehicleDetailController@updateAppform');

	Route::get('/excel-import-vehicle', 'CustomerExcelImport@importForm')->name('excel-import.index'); 
	Route::post('/excel-import-vehicle','CustomerExcelImport@storeData');

	Route::get('/attach-doc/{id}','VehicleDetailController@attachDoc');
	Route::post('/attach-doc','VehicleDetailController@storeDocument');

	 // add tenant
	Route::post('/detail-tenant', 'VehicleDetailController@detailTenant');
	Route::post('/update-detail-tenant', 'VehicleDetailController@updateDetailTenant');

	Route::post('/excel-attach-doc','VehicleDetailController@ExcelstoreDocument');
	Route::post('/show-attach-doc','VehicleDetailController@ShowstoreDocument');
	
	Route::get('/attach-doc/{id}/edit','VehicleDetailController@EditattachDoc');
	// Route::patch('/update-attach-doc/{id}','VehicleDetailController@UpdateDocument')->name('updateAttachDoc.update');
	Route::post('edit-document', 'AttachDocument@UpdateDocument');

	Route::get('change-password','Register@ChangePassword');
	Route::post('change-password','Register@savePassword');

	Route::post('submit-importer-app', "VehicleDetailController@submitApp");
	Route::post('/attach-document/{id}','AttachDocument@attchDocument');
	Route::post('/add-attach-document','AttachDocument@addNewDoc');
	Route::get('search-app','VehicleDetailController@indexFiltering');
	
	Route::get('/attach-document-import/{id}', 'AttachDocument@attachDocumentModal');

});

