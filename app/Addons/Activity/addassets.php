<?php

$time = Config::get('realtime-activity-time', 60000);
$time = (empty($time)) ? 60000 : $time;

Theme::asset()->beforeScriptContent(
    "
        var activityTime = ".$time."
    "
);
Theme::asset()->add('activity-css', 'activity::css/activity.css');
Theme::asset()->add('activity-js', 'activity::js/activity.js');