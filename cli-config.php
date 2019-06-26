<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

/** @var \Slim\Container $container */
$container = require_once 'app/bootstrap.php';

$entityManager = $container->get(EntityManager::class);

return ConsoleRunner::createHelperSet($entityManager);