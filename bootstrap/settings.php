<?php

define('APP_ROOT', __DIR__);

return [
    'settings' => [
        'httpVersion' => '1.1',
        'responseChunkSize' => 4096,
        'outputBuffering' => 'append',
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => true,
        'addContentLengthHeader' => true,
        'routerCacheFile' => false,

        'doctrine' => [
            // if true, metadata caching is forcefully disabled
            'dev_mode' => true,

            // path where the compiled metadata info will be cached
            // make sure the path exists and it is writable
            'cache_dir' => APP_ROOT . '/var/doctrine',

            // you should add any other path containing annotated entity classes
            'metadata_dirs' => [APP_ROOT . '/../src/App/Entity'],

            'connection' => [
                'driver' => 'pdo_mysql',
                'host' => 'localhost',
                'port' => 3306,
                'dbname' => 'binarytree',
                'user' => 'root',
                'password' => '98ubfhru4jgu89dS',
                'charset' => 'utf8'
            ]
        ]
    ]
];
