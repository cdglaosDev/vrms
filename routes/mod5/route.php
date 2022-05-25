<?php
	
Route::resource('module5app-form','Admin\AppFormController');	
Route::resource("application-form", "ApplicationFormController");
Route::resource('pre-reg-app',"Admin\AppFormController");
Route::resource('app-document',"Admin\AppDocumentController");


//new vehicle import by form
Route::group(['namespace' => 'Module5'], function () {
    //excel import
    Route::get('/excel-import-vehicle', 'ExcelImport@importForm'); 
    Route::post('/excel-import-vehicle','ExcelImport@storeData');
   
    //attach document route
    Route::post('/attach-document/{id}','AttachDocument@attchDocument');
    Route::post('/add-attach-document','AttachDocument@addNewDoc');
    //import vehicle
    Route::resource('import-vehicle','VehicleImportController');
   
    //attache app document
    Route::get('/import-vehicle/document/{id}','VehicleImportController@attachDoc');
    Route::post('/import-vehicle/document','VehicleImportController@storeDocument');
	// Route::get('editdate/{id}','RegisterVehicleController@editDate')->name('vehicle-edit');
	//Route::get('/import-vehicle/{delete}/{id}','VehicleImportController@docDelete');
    Route::post('/newdocument' ,'VehicleImportController@newDocument')->name('newdocument.add');

    //edit modal document file in detail and edit page
    Route::post('edit-document', 'AttachDocument@updateDocument');
    
    //reject app
    Route::post('/reject-app/{id}','VehicleImportController@rejectApp');
    Route::patch('/app-form-update/{id}','PreRegister@updatePreApp');
    Route::get('/import-vehicle/print/{app_number}','PreRegister@printAppForm');
    Route::get('search-app','VehicleImportController@indexFiltering');

    //check engien no and chassis no when create import vehicle
    Route::get('/check-engine-chassis-no', 'VehicleImportController@checkEngineChassis');
    Route::post('/detail-tenant', 'VehicleImportController@detailTenant')->name('vehicle-detail-tenant');

    //attached document modal after import excel
    Route::get('/attach-document-import/{id}', 'AttachDocument@attachDocumentModal');

    //for import list with datatable
    Route::get('/search-import-list' ,'VehicleImportController@searchImportList');
   
});

//module5 for admin side
//approve pre register application
Route::post('approve-importer-app/{id}', "ImporterApplication@approveApp");
Route::post('approve-all','ImporterApplication@approveAll');
Route::resource('/import-application','ImporterApplication');
Route::post('/submit-importer-app', "ImporterApplication@submitApp");
Route::post('submit-app-by-modal/{id}', "ImporterApplication@submitAppByModal");

Route::post('change-app-status', 'ImporterApplication@preAppStatus');











