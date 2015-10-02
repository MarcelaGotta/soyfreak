<?php

Route::group(['prefix' => 'activity/', 'before' => 'user-auth'], function() {
    Route::any('', [
        'as' => 'activity',
        'uses' => 'App\\Addons\\Activity\\Controller\\ActivityController@index'
    ]);

    Route::any('more', [
        'uses' => 'App\\Addons\\Activity\\Controller\\ActivityController@loadMore'
    ]);

    Route::any('check', [
        'uses' => 'App\\Addons\\Activity\\Controller\\ActivityController@check'
    ]);
});

