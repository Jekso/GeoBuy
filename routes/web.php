<?php

// login routes
Route::group(['middleware' => 'guest'], function(){
    Route::get('/',['as' => 'login', 'uses' => 'AppController@getLogin']);
    Route::get('redirect',['as' => 'fb_redirect', 'uses' =>  'AppController@redirect']);
    Route::get('callback', ['as' => 'fb_callback', 'uses' =>  'AppController@callback']);
});

// dashboard routes
Route::group(['middleware' => 'auth'], function(){
    Route::get('payment',['as' => 'payment', 'uses' => 'AppController@getPaymentForm']);
    Route::post('payment',['as' => 'payment.post', 'uses' => 'AppController@postPaymentWithStripe']);
    Route::get('logout',['as' => 'logout', 'uses' => 'AppController@getLogout']);
});
