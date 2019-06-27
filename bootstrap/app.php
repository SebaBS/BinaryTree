<?php

$container = require_once __DIR__.'/di.php';

$app = new \Slim\App($container);

return $app;
