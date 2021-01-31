<?php

namespace Project\Validator;

class RegisterValidator
{

    public function isValidName(string $name): bool
    {
        $res = filter_var($name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z][a-z]+$/")));
        return  $res ? true : false;
    }

    public function isValidEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) ? true : false;
    }

    public function isValidPassword(string $password): bool
    {
        //One upper, on lower, one number, maybe one special
        // $regexp = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d@$!%*?&.;:,ùµ£çéè'\)\(\\\{\}=+°~²]{8,}$/"
        // One upper, one lower, one number, no special
        $regexp = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/";
        $res = filter_var($password, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=> $regexp)));
        return $res ? true : false;
    }
}
