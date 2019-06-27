<?php


namespace App\Exception\Service;


use Throwable;

class UserNotFoundServiceException extends AbstractServiceException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct(empty($message) ? 'User not found' : $message, $code, $previous);
    }
}