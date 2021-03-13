<?php


namespace Project\Middleware;

use Exception;

class ProjectMiddlewareException extends Exception
{

    /**
     * ProjectMiddlewareException constructor.
     * @param string $string
     */
    public function __construct(string $string)
    {
        parent::__construct($string);
    }
}
