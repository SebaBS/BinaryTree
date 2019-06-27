<?php


namespace App\Exception\Service;


use App\Exception\Controller\AbstractControllerException;
use Throwable;

class BuildTreeControllerException extends AbstractControllerException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct(empty($message) ? 'Tree of nodes is empty' : $message, $code, $previous);
    }
}