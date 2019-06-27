<?php

use DI\Bridge\Slim\App;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

/** @var App $app */
$app = require_once 'bootstrap/app.php';

$entityManager = $app->getContainer()->get(EntityManager::class);

$helper = ConsoleRunner::createHelperSet($entityManager);