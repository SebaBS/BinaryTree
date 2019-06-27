<?php

declare(strict_types=1);

chdir(__DIR__ . "/../");

require './vendor/autoload.php';

try {
    $app = require_once __DIR__ . '/../bootstrap/app.php';

    require_once __DIR__ . '/../bootstrap/routes.php';
    $app->run();
} catch (\Throwable $t) {
    // TODO logger
    echo json_encode([
        'errors' => [
            ['message' => 'critical error occured', 'code' => $t->getCode()]
        ]
    ]);
}
