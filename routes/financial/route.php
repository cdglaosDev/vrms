<?php
Route::namespace('Module2')->group(function () {
Route::resource('price-item','ManagementPriceItem');
Route::delete('/price-item/{priceitem}','ManagementPriceItem@destroy')->name('priceitem.delete');
Route::get('/unit-price/{priceitem}','ManagementPriceItem@CreateUnitPrice')->name('unitprice.create');
Route::post('/pricestore','ManagementPriceItem@StoreUnitPrice')->name('pricestore.store');
Route::delete('/unit-price/{unitprice}','ManagementPriceItem@DestoryUnitPrice');
Route::patch('/update/unit-price/{id}', 'ManagementPriceItem@updateUnitPrice');
Route::resource('price-list','ManagementPriceList');
Route::resource('price-list-detail','ManagementPriceListDetail');
Route::resource('daily-report','FinancialReportsController');
Route::get('summary-report','FinancialReportsController@SummaryReport')->name('summary-report.index');
Route::Post('summary-report','FinancialReportsController@SummarySearch');
Route::resource('payment-status','PaymentStatusController');
Route::resource('reciept-status','RecieptStatusController');
Route::post('getRefno', 'SubPriceList@getRefNo')->name('getRefno');
Route::get('get-price-item','SubPriceList@priceItem')->name('item');
Route::post('add-receive-money','ManagementPriceList@receiveMoney')->name('receiveMoney');
Route::post('confirm-pay/{id}','ManagementPriceList@confirmPay');
Route::get('search-refno','ManagementPriceList@SearchRefno')->name('refno');
Route::DELETE('delete-price/{id}','ManagementPriceListDetail@delete');
Route::get('price-list-detail/{id}','ManagementPriceListDetail@priceListDetail');
Route::post('print-receipt/{id}','ManagementPriceListDetail@printReceipt')->name('getReceipt');
Route::resource('items-group','PriceItemGroupController');
Route::resource('price-item-group-detail','PriceItemGroupDetailController');
Route::resource('match-payments', 'PaymentMatch');
Route::post('store/match-payment','PaymentMatch@storeMatchPayment')->name('storeMatchPayment');
Route::post('getPriceList','ManagementPriceList@getPricelist')->name('getPriceList');
Route::get('get-price-item/{id}', 'ManagementPriceList@getPriceItem');
Route::post('/price-list/cancel-bill', 'ManagementPriceList@cancelBill')->name('cancelBill');
Route::delete('/delete-price-detail/{id}','ManagementPriceList@deletePriceDetail');
Route::post('/price-list/print/{id}','ManagementPriceList@PrintPriceList');
Route::get('/price-list/license-booking/{license}','SubPriceList@licenseBooking');
Route::post('/price-list/license-booking','SubPriceList@saveLicenseBooking')->name('licenseBooking');
//Counter matching
Route::resource('counter-matching','CounterMatchingController');
Route::post('/price-list/cancel-bill/{id}', 'SubPriceList@billCancel');
Route::get('/search-license-pricelist', 'ManagementPriceList@searchLicense');
Route::post('/print-save-pricelist', 'ManagementPriceList@savePrintPriceList');
Route::get('/get-previous-bill', 'SubPriceList@getPreviousBill');
Route::get('/get-next-bill', 'SubPriceList@getNextBill');
Route::get('/new-bill-with-old/{id}', 'ManagementPriceList@getPriceListDetailByOldData');

});
