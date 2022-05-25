<?php
// vehicle passport route
Route::group(['namespace' => 'Module6'], function () {
Route::resource('vehicle-passport','VehiclePassport');
Route::get('search','VehiclePassport@search');
Route::any('getData','VehiclePassport@getData')->name('getData');
Route::any('getSearchData','VehiclePassport@searchlist')->name('getSearchData');

});