<?php
return [
    'url' => env('UPLINK_URL', 'https://postback-sms.com/api/'),
    'allowed_actions' => [
        'getNumber',
        'getSms',
        'cancelNumber',
        'getStatus',
    ]
];
