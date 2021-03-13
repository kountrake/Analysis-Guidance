<?php


namespace Project\Controller;

use Project\Middleware\UserMiddleware;
use Project\Validator\EmailValidatorException;
use Project\Validator\NameValidatorException;
use Project\Validator\PasswordValidatorException;
use Project\Validator\RegisterValidator;

class RegisterController extends Controller
{

    public function index()
    {
        $this->view('register');
    }

    public function register()
    {
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];

        try {
            $registerValidator = new RegisterValidator();
            $registerValidator->run($lastname, $firstname, $email, $password, $password_confirm);
            $userMid = new UserMiddleware();
            $userMid->register($lastname, $firstname, $email, $password);
            session_start();
            $_SESSION['user'] = $userMid->login($email, $password);
            header('Location: /dashboard');
            die();
        } catch (PasswordValidatorException | NameValidatorException | EmailValidatorException $e) {
            $this->view('register', ["error" => $e->getMessage(),
                "prevEmail" => $_POST['email'], "prevNom" => $_POST['lastname'], "prevPrenom" => $_POST['firstname']]);
            exit();
        }
    }
}
