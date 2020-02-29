<?php

Route::group(['prefix' => 'customers'], function() {
   Route::post('/', 'Api\CustomerController@store');
   Route::patch('/{customer_id}', 'Api\CustomerController@update');
   Route::get('/details', 'Api\CustomerController@getCustomer');

   Route::group(['prefix' => '/{customer_id}/transactions'], function() {
       Route::post('/', 'Api\TransactionController@store');
   });
});
Route::get('/transactions', 'Api\TransactionController@list');
