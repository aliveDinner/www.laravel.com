<?php

return [

    //默认域名
    'app_url' => 'www.boom.com',
    //PC端域名
    'site_url' => 'www.boom.com',
    //手机域名
    'phone_url' => 'm.boom.com',
    //后台域名
    'backend_url' => 'cms.boom.com',
    //API域名
    'api_url' => 'api.boom.com',

    //默认中间路由名
    'default_middleware_name' => 'web',

    /**
     * 额外加载路由文件夹下所有的路由是，过滤的路由文件
     * 目前只接受一级文件目录
     * @var array
     */
    'except' => [
        'api.php',
        'phone.php',
        'back.php',
        'channels.php',
        'console.php',
        'web.php',
    ],

    //额外开放的模块
    'modules' => [
        //手机域名
        'm.boom.com' => [
            'namespace' => 'App\Http\Controllers\Phone',
            'middleware_name' => 'web',
            'request' => '',
        ],
        //后台域名
        'cms.boom.com' => [
            'namespace' => 'App\Http\Controllers\Back',
            'middleware_name' => 'web',
            'request' => '',
        ],
        //API域名
        'api.boom.com' => [
            'namespace' => 'App\Http\Controllers\Api',
            'middleware_name' => 'api',
            'request' => '',
        ],
    ],

    //额外不开放的模块
    'modules_except' => [
        'App\Http\Controllers\Common'
    ]
];
