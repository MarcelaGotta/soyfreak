<?php

Route::group(['prefix' => 'admincp/custom/boxes/', 'before' => 'admincp-auth'], function() {

    Route::any('', [
        'as' => 'admincp-custom-boxes',
        'uses' => 'App\\Addons\\Custombox\\Controllers\\AdmincpController@index'
    ]);

    Route::any('add', [
        'as' => 'admincp-custom-boxes-add',
        'uses' => 'App\\Addons\\Custombox\\Controllers\\AdmincpController@add'
    ]);

    Route::any('add/special', [
        'as' => 'admincp-custom-boxes-add-special',
        'uses' => 'App\\Addons\\Custombox\\Controllers\\AdmincpController@addspecial'
    ]);

    Route::any('edit/{slug}', [
        'as' => 'admincp-custom-boxes-edit',
        'uses' => 'App\\Addons\\Custombox\\Controllers\\AdmincpController@edit'
    ])->where('slug', '[a-zA-Z0-9\_\-]+');

    Route::any('delete/{slug}', [
        'as' => 'admincp-custom-boxes-delete',
        'uses' => 'App\\Addons\\Custombox\\Controllers\\AdmincpController@delete'
    ])->where('slug', '[a-zA-Z0-9\_\-]+');

});

Route::any('_{slug}', [
    'as' => 'custom-box',
    'uses' => 'App\\Addons\\Custombox\\Controllers\\CustomBoxController@index'
])->where('slug', '[a-zA-Z0-9\_\-]+');