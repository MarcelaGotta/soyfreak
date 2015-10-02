<?php


//Frontend end menu event binding

app('menu')->add('site-menu', 'activity', [
    'name' => trans('activity::global.activities'),
    'link' => \URL::to('activity'),
    'ajaxify' => true,
    'icon' => '<i class="icon ion-android-forums"></i>'
]);


//Add translation string for javascript codes to use
Theme::asset()->beforeScriptContent("

");


Event::listen('post.add', function($post) {
    if ($post->type == 'user-timeline' and $post->content_type != 'auto-post') {
        app('App\\Addons\\Activity\\Classes\\ActivityRepository')->add('post', $post->id, 'activity::render.post');
    }
});

Event::listen('community.add', function($community) {
    if ($community->privacy == 1) {
        app('App\\Addons\\Activity\\Classes\\ActivityRepository')->add('community', $community->id, 'activity::render.community');
    }
});

Event::listen('game.add', function($game) {
    app('App\\Addons\\Activity\\Classes\\ActivityRepository')->add('game', $game->id, 'activity::render.game');
});

Event::listen('page.add', function($page) {
    app('App\\Addons\\Activity\\Classes\\ActivityRepository')->add('page', $page->id, 'activity::render.page');
});

Event::listen('album.add', function($album) {
    app('App\\Addons\\Activity\\Classes\\ActivityRepository')->add('album', $album->id, 'activity::render.album');
});

Event::listen('like.add', function($userid, $type, $typeId) {

    if ($type != 'comment') {
        app('App\\Addons\\Activity\\Classes\\ActivityRepository')->add('like-'.$type, $typeId, 'activity::render.like');
    }
});

Event::listen('add-album-photos', function ($id, $photos) {
    app('App\\Addons\\Activity\\Classes\\ActivityRepository')->add('add-photos', $id, 'activity::render.add-photos', [
        'count' => count($photos)
    ]);
});

Event::listen('comment.add', function($text, $userid, $type, $typeId, $comment, $image) {

    app('App\\Addons\\Activity\\Classes\\ActivityRepository')->add('comment-'.$type, $typeId, 'activity::render.comment');
});



if (Auth::check() and \Config::get('show-side-activity', true)) {
    app('widget')->add('activity::side', [
        'user-home',
        'user-search',
        'user-discover',
        'notifications',
        'user-community',
        'user-pages'
    ], []);

}