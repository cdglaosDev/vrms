<?php


//Route::post('user/login', 'LoginController@loginByVrms2')->name('user.login');
Route::get('home', 'HomeController@homePage');
Route::resource('announcement','Vrms2\AnnouncementController');
Route::get('announcement-page-list','Vrms2\AnnouncementController@AnnouncementPageList');
Route::delete('announcement-del/{id}','Vrms2\AnnouncementController@destroy');
Route::get('module3', 'Module3\CountryController@index');

//annoucement up and down function 
Route::post('/up_pin_post','Vrms2\AnnouncementController@upPinPost');
Route::post('/down-pin','Vrms2\AnnouncementController@downPin');
Route::post('/checkPin','Vrms2\AnnouncementController@checkPinBox');
Route::post('/dropPin','Vrms2\AnnouncementController@dropPin');

Route::post('/update_up_itme','Vrms2\AnnouncementController@updateUpItem');
Route::post('/update-down','Vrms2\AnnouncementController@updateDown');
