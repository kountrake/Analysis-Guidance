<?php


namespace Project\Validator;

class NameValidatorException extends \Exception
{

    /**
     * NameValidatorException constructor.
     * @param string $string
     */
    public function __construct(string $string)
    {
        parent::__construct($string);
    }
}
