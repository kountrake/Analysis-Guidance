<?php


namespace Project\Controller;

use Exception;
use Project\Item\User;
use Project\Middleware\UserMiddleware;
use Project\Validator\EmailValidator;
use Project\Validator\EmailValidatorException;
use Project\Validator\NameValidator;
use Project\Validator\NameValidatorException;
use Project\Validator\PasswordValidator;
use Project\Validator\PasswordValidatorException;

class DashboardController extends Controller
{
    public function index()
    {
        $this->viewcontrol('dashboard');
    }

    public function updatePassword()
    {
        $userMid = new UserMiddleware();
        $id = $_POST['id'];
        try {
            if (isset($_POST['previous'])) {
                $previous = $_POST['previous'];
                $new = $_POST['new'];
                $confirm = $_POST['confirm'];
                $validator = new PasswordValidator();
                $validator->confirmPassword($new, $confirm);
                $validator->run($new);
                $userMid->updatePassword($previous, $new, $confirm, $id);
            }
        } catch (PasswordValidatorException $e) {
            //TODO Ajouter un systeme de traitement des erreurs
        }
        header('Location: /dashboard');
        die();
    }

    public function updateInfo()
    {
        try {
            $userMid = new UserMiddleware();
            $id = $_POST['id'];
            if (isset($_POST['lastname'])) {
                $lastname = $_POST['lastname'];
                $firstname = $_POST['firstname'];
                $email = $_POST['email'];
                $validator = new NameValidator();
                $validator->validName($lastname);
                $validator->validName($firstname);
                $validator = new EmailValidator();
                $validator->validEmail($email);
                $userMid->updateInfo($lastname, $firstname, $email, $id);
                session_start();
                $user = new User($firstname, $lastname, $email);
                $user->setId($id);
                $_SESSION['user'] = $user;
            }
        } catch (NameValidatorException | EmailValidatorException $e) {
            //TODO Ajouter un systeme de traitement des erreurs
        }
        header('Location: /dashboard');
        die();
    }

    public function delete()
    {
        try {
            $userMid = new UserMiddleware();
            $userMid->deleteAccount($_POST['id']);
        } catch (Exception $e) {
            //TODO Ajouter un systeme de traitement des erreurs
        }
        session_start();
        session_destroy();
        header('Location: /');
        exit();
    }
}
