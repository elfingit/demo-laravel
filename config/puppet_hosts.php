<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-27
 * Time: 17:24
 */
return [
    'website.blvtech.net' => [
        'host' => 'website.blvtech.net',
        'protocol' => 'http://',
        'command_uri'   => 'system/command',
        'user'  => 'blv',
        'password' => env('HOST_WEBSITE_PWD', null)
    ]
];
