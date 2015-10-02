<?php

Route::group(['prefix' => 'admincp/blog/', 'before' => 'admincp-auth'], function() {

    Route::any('categories', [
        'as' => 'admincp-blog-categories',
        'uses' => 'App\\Addons\\Blog\\Controllers\\AdmincpController@categories'
    ]);

    Route::any('posts', [
        'as' => 'admincp-blog-posts',
        'uses' => 'App\\Addons\\Blog\\Controllers\\AdmincpController@posts'
    ]);

    Route::any('add', [
        'as' => 'admincp-blog-post-add',
        'uses' => 'App\\Addons\\Blog\\Controllers\\AdmincpController@addPost'
    ]);

    Route::any('posts/edit/{id}', [
        'as' => 'admincp-blog-posts-edit',
        'uses' => 'App\\Addons\\Blog\\Controllers\\AdmincpController@editPost'
    ])->where('id', '[0-9]+');

    Route::any('posts/delete/{id}', [
        'as' => 'admincp-blog-posts-delete',
        'uses' => 'App\\Addons\\Blog\\Controllers\\AdmincpController@deletePost'
    ])->where('id', '[0-9]+');

    Route::any('categories/add', [
        'as' => 'admincp-blog-categories-add',
        'uses' => 'App\\Addons\\Blog\\Controllers\\AdmincpController@addCategory'
    ]);

    Route::any('categories/edit/{id}', [
        'as' => 'admincp-blog-categories-edit',
        'uses' => 'App\\Addons\\Blog\\Controllers\\AdmincpController@editCategory'
    ])->where('id', '[0-9]+');

    Route::any('categories/delete/{id}', [
        'as' => 'admincp-blog-categories-delete',
        'uses' => 'App\\Addons\\Blog\\Controllers\\AdmincpController@deleteCategory'
    ])->where('id', '[0-9]+');

});

Route::any('blogs', [
    'uses' => 'App\\Addons\\Blog\\Controllers\\BlogController@index',
    'as' => 'blogs'
]);

Route::any('blog/{slug}', [
    'uses' => 'App\\Addons\\Blog\\Controllers\\BlogController@page',
    'as' => 'blog-page'
])->where('slug', '[a-zA-Z0-9\-\_]+');

Route::any('blog/{slug}/edit', [
    'uses' => 'App\\Addons\\Blog\\Controllers\\BlogController@edit',
    'as' => 'blog-edit'
])->where('slug', '[a-zA-Z0-9\-\_]+');


Route::any('blog/{slug}/delete', [
    'uses' => 'App\\Addons\\Blog\\Controllers\\BlogController@delete',
    'as' => 'blog-delete'
])->where('slug', '[a-zA-Z0-9\-\_]+');

Route::any('{id}/blogs', [
    'as' => 'profile-blogs',
    'uses' => 'App\Addons\\Blog\\Controllers\\ProfileController@lists'
])->where(['id' => '[a-zA-Z0-9\_\-]+']);


Route::group(['prefix' => 'blogs/', 'before' => 'user-auth'], function () {
   Route::any('add', [
       'as' => 'blog-add',
       'uses' => 'App\\Addons\\Blog\\Controllers\\BlogController@add',
   ]);
});

