<?php


namespace Project\Validator;

class EmailValidator
{
    public function validEmail($email)
    {
        if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
            throw new EmailValidatorException('Email entré incorrect');
        }
        return true;
    }
}
