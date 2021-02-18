<?php

namespace Project\Validator;

class RegisterValidator
{
    private $passwordValidator;
    private $emailValidator;
    private $nameValidator;

    /**
     * RegisterValidator constructor
     */
    public function __construct()
    {
        $this->passwordValidator = new PasswordValidator();
        $this->emailValidator = new EmailValidator();
        $this->nameValidator = new NameValidator();
    }

    /**
     * @param string $lastname
     * @param string $firstname
     * @param string $email
     * @param string $password
     * @param string $confirm
     * @throws EmailValidatorException
     * @throws NameValidatorException
     * @throws PasswordValidatorException
     */
    public function run(string $lastname, string $firstname, string $email, string $password, string $confirm)
    {
        $this->nameValidator->validName($lastname);
        $this->nameValidator->validName($firstname);
        $this->emailValidator->validEmail($email);
        $this->passwordValidator->run($password);
        $this->passwordValidator->confirmPassword($password, $confirm);
    }
}
