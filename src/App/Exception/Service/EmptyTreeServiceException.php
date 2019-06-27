<?php


namespace App\Exception\Service;


use Throwable;

class EmptyTreeServiceException extends AbstractServiceException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct(empty($message) ? 'No nodes found in tree' : $message, $code, $previous);
    }
}