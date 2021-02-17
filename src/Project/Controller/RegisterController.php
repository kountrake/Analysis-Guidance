<?php


namespace Project\Controller;

class RegisterController extends Controller{

    public function index(){
        $this->view('register');
    }

    public function validName($name){
        if( !(preg_match('A-Za-zâêîôûäëïöüÿçéèàù\-', $name)) ){ //vérifie le format autorisé pour nom/prénom : lettres maj/min avec accents et - (pour les noms composés) autorisées
            throw new Exception('Nom ou prénom entré incorrect (pas de chiffres ou de caractères spéciaux)');
        }
        return true;
        
    }

    public function validEmail($email){
        if(!(filter_var($email, FILTER_VALIDATE_EMAIL)) ){
            throw new Exception('Email entré incorrect');
        }  
        return true;
    
    }

    public function validPassword($password){
        if( strlen($password) < 6){//si le mot de passe est trop court -> exception
            throw new Exception('Mot de passe entré trop court');

        }else if(strlen($password) > 25){//si le mot de passe est trop long -> exception
            throw new Exception('Mot de passe entré trop long');

        }else if( ! preg_match( '?=.*[0-9]', $password ) ){//si le mot de passe ne contient pas au moins un chiffre -> exception
            throw new Exception('Le mot de passe doit contenir au moins un chiffre');

        }else if( ! preg_match( '?=.*[A-Z]', $password )){//si le mot de passe ne contient pas au moins une lettre majuscule -> exception
            throw new Exception('Le mot de passe doit contenir au moins une lettre majuscule');

        }else if( ! preg_match( '?=.*[a-z]', $password )){//si le mot de passe ne contient pas au moins une lettre minuscule -> exception
            throw new Exception('Le mot de passe doit contenir au moins une lettre minuscule');

        }else if( ! preg_match( '?=.*\W', $password )){//si le mot de passe ne contient pas au moins un caractère spécial -> exception
            throw new Exception('Le mot de passe doit contenir au moins un caractère spécial');

        }
        return true;

    }

    public function confirmPassword($password, $passwordConf){
        if( !(strcmp($password, $passwordConf)) ){
            throw new Exception('La confirmation du mot de passe a échoué');
        }
        return true;
        
    }

    public function register(){
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_comfirm = $POST['password_confirm'];

        try{
            validName($lastname);
            validName($firstname);
            validEmail($email);
            validPassword($password);
            confirmPassword($password, $password_comfirm);

        }catch(Exception $e){
            echo 'Erreur : ' . e->getMessage();
        }
        
    }

}
