<?php


namespace Project\Validator;

class NameValidator
{
    public function validName($name): bool
    {
        if (!(preg_match('/^[A-Za-zâêîôûäëïöüÿçéèàù\-]+$/', $name))) {
            throw new NameValidatorException('Nom ou prénom entré incorrect (pas de chiffre ou de caractère spécial)');
        }
        return true;
    }
}
