<?php


/* receive lists */

Route::get('receive/{id}','ReceiveController@receive');
Route::post('receive','ReceiveController@storeReceive');
Route::get('receive','ReceiveController@allReceive');
Route::delete('receive/{id}','ReceiveController@destroy');
Route::get('print/{id}','ReceiveController@Print');
Route::get('report','ReceiveController@getReport');
Route::get('/report/result','ReceiveController@searchResult');

Route::get('getPrint/{id}/{page}','ReceiveController@getPrint');

Route::get('getDistrict/{code}','GetDropdownList@getDistrict');
Route::get('getVillage/{code}','GetDropdownList@getVillage');
/* car registration */
Route::resource('car-register','CarRegister');
//Route::get('search','CarRegister@search');
//Route::get('getData','CarRegister@getData');
Route::get('getCode/{code}','Module6\VehiclePassport@getCode');
Route::get('getVmodel/{brand}','GetDropdownList@getVmodel');