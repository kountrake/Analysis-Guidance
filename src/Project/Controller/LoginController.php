<?php


namespace Project\Controller;

use Project\Middleware\UserMiddleware;

class LoginController extends Controller
{
    public function index()
    {
        $this->view('login');
    }

    public function login()
    {
        $userMid = new UserMiddleware();
        $user = $userMid->login($_POST['email'], $_POST['password']);
        if ($user) {
            session_start();
            $_SESSION['user'] = $user;
            header('Location: /dashboard');
            exit();
        }
        $this->view('login', ["error" => "Les identifiants de connexions ne sont pas corrects",
            "prev" => $_POST['email']]);
        exit();
    }

    public function logout()
    {
        session_start();
        session_destroy();
        session_unset();
        header("Location: /");
        exit();
    }
}
