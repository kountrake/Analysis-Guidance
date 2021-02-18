<?php


namespace Project\Validator;

class EmailValidatorException extends \Exception
{

    /**
     * EmailValidatorException constructor.
     * @param string $string
     */
    public function __construct(string $string)
    {
        parent::__construct($string);
    }
}
