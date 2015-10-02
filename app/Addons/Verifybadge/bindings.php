<?php

\Menu::add('admincp-menu', 'verify-badge', [
    'link' => '',
    'name' => 'Verify Badge',
]);

\Menu::add('sub-menu-verify-badge', 'Users', [
    'link' => \URL::to('admincp/verifybadge/users'),
    'name' => 'Users',
]);

\Menu::add('sub-menu-verify-badge', 'pages', [
    'link' => \URL::to('admincp/verifybadge/pages'),
    'name' => 'Pages',
]);

\Menu::add('sub-menu-verify-badge', 'Requests', [
    'link' => \URL::to('admincp/verifybadge/requests'),
    'name' => 'Verify Requests',
]);

\Menu::add('sub-menu-verify-badge', 'Custom-field', [
    'link' => \URL::to('admincp/verifybadge/custom-fields'),
    'name' => 'Custom Fields',
]);

if (Auth::check() and Auth::user()->verified != 1) {

    Menu::add('account-settings', 'verify-request-form', [
        'link' => \URL::to('verify/request'),
        'name' => trans('verifybadge::global.verify-request-form'),
        'ajaxify' => false
    ]);
}

Event::listen('page-side-menu-list', function() {
   echo Theme::section('verifybadge::request.page-button');
});