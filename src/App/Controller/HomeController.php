<?php

namespace App\Controller;

use Psr\Container\ContainerInterface;

class HomeController extends AbstractController
{
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function home($request, $response, $args) {
        // TODO
        return $response;
    }

    public function contact($request, $response, $args) {
        // TODO
        return $response;
    }

}