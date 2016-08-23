<?php

Route::group(['namespace' => 'Ekushisu\Wasabi\Http\Controllers', 'prefix' => 'wasabi'], function() {
    Route::get('/', ['as' => 'home', 'uses' => 'WasabiController@index']);
});
