<?php

Route::group(['namespace' => 'Ekushisu\Wasabi\Http\Controllers', 'domain' => Config::get('wasabi.domain')], function() {
    Route::get('/', ['as' => 'home', 'uses' => 'WasabiController@index']);
});
