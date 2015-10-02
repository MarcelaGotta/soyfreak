<?php
Route::group(['prefix' => 'admincp/', 'before' => 'admincp-auth'], function() {

    Route::any('verifybadge/custom-fields', [
        'as' => 'verifybadge-custom-fields',
        'uses' => 'App\\Addons\\Verifybadge\\Controllers\\AdmincpController@customFields'
    ]);

    Route::any('verifybadge/custom-fields/add', [
        'as' => 'verifybadge-custom-fields-add',
        'uses' => 'App\\Addons\\Verifybadge\\Controllers\\AdmincpController@addCustomFields'
    ]);

    Route::any('verifybadge/pages', [
        'as' => 'verifybadge-pages',
        'uses' => 'App\\Addons\\Verifybadge\\Controllers\\AdmincpController@pages'
    ]);

    Route::any('verifybadge/requests', [
        'as' => 'verifybadge-requests',
        'uses' => 'App\\Addons\\Verifybadge\\Controllers\\AdmincpController@requests'
    ]);

    Route::any('verifybadge/request/approve/{id}', [
        'as' => 'verifybadge-request-approve',
        'uses' => 'App\\Addons\\Verifybadge\\Controllers\\AdmincpController@approve'
    ])->where('id', '[0-9]');

    Route::any('verifybadge/request/reject/{id}', [
        'as' => 'verifybadge-request-reject',
        'uses' => 'App\\Addons\\Verifybadge\\Controllers\\AdmincpController@reject'
    ])->where('id', '[0-9]');

    Route::any('verifybadge/users', [
        'as' => 'verifybadge-users',
        'uses' => 'App\\Addons\\Verifybadge\\Controllers\\AdmincpController@users'
    ]);


    Route::any('verifybadge/custom-fields/edit/{id}', [
        'as' => 'verifybadge-custom-fields-edit',
        'uses' => 'App\\Addons\\Verifybadge\\Controllers\\AdmincpController@editCustomFields'
    ])->where('id', '[0-9]+');

    Route::any('verifybadge/custom-fields/delete/{id}', [
        'as' => 'verifybadge-custom-fields-delete',
        'uses' => 'App\\Addons\\Verifybadge\\Controllers\\AdmincpController@deleteCustomFields'
    ])->where('id', '[0-9]+');

    Route::any('verify/do/{which}/{type}/{id}', [
        'as' => 'verifybadge-award',
        'uses' => 'App\\Addons\\Verifybadge\\Controllers\\AdmincpController@doVerify'
    ])->where([
            'which' => '[a-zA-Z0-9]+',
            'type' => '[a-zA-Z0-9]+',
            'id' => '[0-9]+'
        ]);


});

Route::any('verifybadge/send/request', [
    'as' => 'verifybadge-send-request',
    'before' => 'auth',
    'uses' => 'App\\Addons\\Verifybadge\\Controllers\\RequestController@send'
]);

Route::any('verify/request', [
    'as' => 'verifybadge-request',
    'before' => 'auth',
    'uses' => 'App\\Addons\\Verifybadge\\Controllers\\AccountController@form'
]);


Route::any('page/{slug}/verify/request', [
    'uses' => 'App\\Addons\\Verifybadge\\Controllers\\PageController@form',
    'as' => 'page-get-verified',
])->where('slug', '[a-zA-Z0-9\-\_]+');
