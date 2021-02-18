<?php


namespace Project\Validator;

class PasswordValidatorException extends \Exception
{

    /**
     * PasswordValidatorException constructor.
     * @param string $string
     */
    public function __construct(string $string)
    {
        parent::__construct($string);
    }
}
