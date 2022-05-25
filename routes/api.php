<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');

Route::apiResource('/testing', 'Api\TestingController')->middleware('auth:api');
Route::get('/vehicle-by-division-license','Api\VehicleController@index');
Route::get('/accident-type','Api\VehicleController@getAccident');
Route::post('/traffic-accident','Api\VehicleController@postTrafficAccident');
Route::get('/traffic-accident','Api\VehicleController@getTrafficAccident');
Route::get('/vehicle-inspection','Api\VehicleController@getVehicleInspect');
Route::get('/vehicle-by-license','Api\VehicleController@getVehicleByLicense');
Route::get('/vehicle-by-license-province-purpose', 'Api\VehicleController@getVehicleByProvince');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
 
//api route for card system
Route::get('/card-vehicle','Api\CardController@getVehicleInfo');
Route::get('/read-card','Api\CardController@readCard');
Route::post('/write-card','Api\CardController@writeCard');
Route::patch('/terminate-card','Api\CardController@terminateCard');
Route::get('/smart-card-code', 'Api\CardController@getCode');

//api route for card logo and sign
Route::get('/smart-card-sign', 'Api\SmartCardSign@getLogo');

//save print log api
Route::post('/save-print-log', 'Api\SmartCardSign@savePrintLog');

//scan module api
Route::post('/scan-files-upload', 'Api\ScanModuleController@uploadFile');


