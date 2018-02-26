<?php

// User module routes goes here
Route::group(['namespace' => 'Module\User\Http\Controllers'], function () {

    Route::get('/', 'IndexController@index');
});