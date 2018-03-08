<?php

return [
    'driver' => 'rsa',
    'default' => '\App\Components\api\ApiCurl',
    'allow' => [
        'curl' => '\App\Components\api\ApiCurl',
        'rsa' => '\App\Components\api\ApiRsa',
    ],
    'options' => [
        'curl' => [
            'url' => 'http://60.205.149.5/index.php',
            'method' => 'post',
            'timeout' => '60',
            'returnCookie' => false,
            'CA' => false,
            'CAT' => '',
            'header' => [
                'content-type:application/x-www-form-urlencoded;charset=utf-8'
            ],
            'key' => 'zl6cUkhltbDXyyqf',
        ],
        'rsa' => [

        ],
    ]
];