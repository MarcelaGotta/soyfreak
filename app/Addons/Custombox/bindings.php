<?php

\Menu::add('admincp-menu', 'custom-box', [
    'link' => '',
    'name' => 'Own Boxes',
]);

\Menu::add('sub-menu-custom-box', 'lists', [
    'link' => \URL::to('admincp/custom/boxes/'),
    'name' => 'Lists',
]);

\Menu::add('sub-menu-custom-box', 'add', [
    'link' => \URL::to('admincp/custom/boxes/add'),
    'name' => 'Add New Box',
]);


if (\Config::get('enable-recent-boxes')) {
    app('widget')->add('custombox::side', [
        'user-home',
        'user-search',
        'user-discover',
        'notifications',
        'user-community',
        'blank-ads'
    ], ['all' => true]);
}
