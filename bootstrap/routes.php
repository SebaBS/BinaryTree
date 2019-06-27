<?php

/* @var $app \Slim\App */

use App\Controller\TreeController;

$app->get('/', TreeController::class . ':getAll');
$app->post('/', TreeController::class . ':addUser');
$app->get('/del', TreeController::class . ':removeUser');