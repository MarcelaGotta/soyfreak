<?php

return [

    'activities-per-page' => [
        'type' => 'text',
        'title' => 'Set Number Of Activities To Show Per Page',
        'description' => 'This option allow you to control the number of activities to show per page',
        'value' => '10',
    ],


    'show-side-activity' => [
        'type' => 'boolean',
        'title' => 'Show Activities On Side Layout',
        'description' => 'Option to set if you want to show activities on the side layout',
        'value' => '1',
    ],

    'enable-realtime-activity' => [
        'type' => 'boolean',
        'title' => 'Enable RealTime Activity',
        'description' => 'Option to enable or disable realtime user activities check',
        'value' => '1',
    ],

    'realtime-activity-time' => [
        'type' => 'dropdown',
        'title' => 'Activity RealTime Check Time',
        'description' => 'Option to set the time interval to check for new activities',
        'value' => '60000',
        'data' => [
            '5000' => '5 Seconds',
            '10000' => '10 Seconds',
            '20000' => '20 Seconds',
            '30000' => '30 Seconds',
            '40000' => '40 Seconds',
            '50000' => '50 Seconds',
            '60000' => '1 Minute',
        ]
    ],
];