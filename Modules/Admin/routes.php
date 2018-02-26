<?php

// Admin routes goes here
Route::group(['prefix' => 'admin/', 'namespace' => 'Module\Admin\Http\Controllers'], function () {

    Route::get('/', 'IndexController@index');
    Route::get('/app/performance/onboarding', 'AppPerformanceController@onboarding');
});