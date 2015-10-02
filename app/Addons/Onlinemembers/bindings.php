<?php

\Menu::add('admincp-menu', 'online-members', [
    'link' => URL::to('admincp/online/members'),
    'name' => 'Online Members',
]);

if (Config::get('onlinemember-seen-by-users', 1)) {
    app('menu')->add('menu-barra', 'onlines', [
        'link' => \URL::to('onlines'),
        'ajaxify' => true,
        'icon' => '<i class="icon ion-ios-people"></i>',
        'title' => 'Miembros en Línea'
    ]);
}

