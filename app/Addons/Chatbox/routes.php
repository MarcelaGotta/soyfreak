<?php

Route::group(['prefix' => 'chatbox'], function() {
    Route::any('send', [
        'uses' => 'App\\Addons\\Chatbox\\Controllers\\ChatboxController@send'
    ]);


    Route::any('update/opened', [
        'uses' => 'App\\Addons\\Chatbox\\Controllers\\ChatboxController@updateOpened'
    ]);

    Route::any('load/emoticon', [
        'uses' => 'App\\Addons\\Chatbox\\Controllers\\ChatboxController@loadEmoticon'
    ]);

    Route::any('load/old', [
        'uses' => 'App\\Addons\\Chatbox\\Controllers\\ChatboxController@loadOld'
    ]);

    Route::any('load/older', [
        'uses' => 'App\\Addons\\Chatbox\\Controllers\\ChatboxController@loadOlder'
    ]);

    Route::any('check', [
        'uses' => 'App\\Addons\\Chatbox\\Controllers\\ChatboxController@checkUpdate',
        'before' => 'user-auth'
    ]);

    Route::any('typing', [
        'uses' => 'App\\Addons\\Chatbox\\Controllers\\ChatboxController@typing'
    ]);

    Route::any('offtyping', [
        'uses' => 'App\\Addons\\Chatbox\\Controllers\\ChatboxController@offtyping'
    ]);

    Route::any('unread/count', [
        'uses' => 'App\\Addons\\Chatbox\\Controllers\\ChatboxController@countUnread'
    ]);
});