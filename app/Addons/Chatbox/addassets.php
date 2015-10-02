<?php

$chatSpeed = Config::get('chat-speed', 5000);
$chatSpeed = ($chatSpeed) ? $chatSpeed : 5000;
$userBoxes = '';

if (Auth::check()) {
    $boxes =(array) Auth::user()->present()->privacy('chatboxes', []);
    foreach($boxes as $box) {
        $theUser = app('App\\Repositories\\UserRepository')->findById($box);
        if ($theUser) {
            $userBoxes .= "[$box, '$theUser->fullname', '".$theUser->present()->url()."'],\n";
        }
    }
}

$chatDo = (preg_match('#/admincp#', URL::current())) ? 0 : 1;
Theme::asset()->beforeScriptContent(
    "
        var chatDo = ".$chatDo.";
        var chatSpeed = ".$chatSpeed.";
        var userBoxes = [".$userBoxes."];
    "
);

Theme::asset()->add('chatbox-css', 'chatbox::css/chatbox.css');
Theme::asset()->add('chatbox-js', 'chatbox::js/chatbox.js');