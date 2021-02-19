<?php


namespace Project\Validator;

class PasswordValidator
{
    public function passwordTooShort(string $password):bool
    {
        if (strlen($password) < 6) {
            throw new PasswordValidatorException('Mot de passe entré trop court');
        }
        return true;
    }

    public function passwordTooLong(string $password):bool
    {
        if (strlen($password) > 25) {
            throw new PasswordValidatorException('Mot de passe entré trop long');
        }
        return true;
    }

    public function passwordHasNoNumber(string $password):bool
    {
        if (! preg_match('/(?=.*[0-9])/m', $password)) {
            throw new PasswordValidatorException('Le mot de passe doit contenir au moins un chiffre');
        }
        return true;
    }

    public function passwordHasNoMaj(string $password):bool
    {
        if (! preg_match('/(?=.*[A-Z])/m', $password)) {
            throw new PasswordValidatorException('Le mot de passe doit contenir au moins une lettre majuscule');
        }
        return true;
    }

    public function passwordHasNoMin(string $password):bool
    {
        if (! preg_match('/(?=.*[A-Z])/m', $password)) {
            throw new PasswordValidatorException('Le mot de passe doit contenir au moins une lettre minuscule');
        }
        return true;
    }

    public function passwordHasNoSpecial(string $password):bool
    {
        if (! preg_match('/(?=.*\W)/m', $password)) {
            throw new PasswordValidatorException('Le mot de passe doit contenir au moins un caractère spécial');
        }
        return true;
    }

    public function confirmPassword($password, $passwordConf)
    {
        if (!($password ===  $passwordConf)) {
            throw new PasswordValidatorException('La confirmation du mot de passe a échoué');
        }
        return true;
    }

    public function run($password)
    {
        $this->passwordTooShort($password);
        $this->passwordTooLong($password);
        $this->passwordHasNoMaj($password);
        $this->passwordHasNoMin($password);
        $this->passwordHasNoNumber($password);
        $this->passwordHasNoSpecial($password);
    }
}
