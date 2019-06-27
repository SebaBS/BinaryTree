<?php

$builder = new \DI\ContainerBuilder();

$config = require_once __DIR__.'/settings.php';
$array = new \ArrayObject($config);

$defaultServicesProvider = new \Slim\DefaultServicesProvider();
$defaultServicesProvider->register($array);

$builder->addDefinitions($array->getArrayCopy());
$builder->addDefinitions(__DIR__.'/../bootstrap/services.php');

return $builder->build();
