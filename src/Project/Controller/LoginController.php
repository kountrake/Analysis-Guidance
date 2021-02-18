<?php


namespace Project\Controller;

class LoginController extends Controller
{
    public function index()
    {
        $this->view('login');
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
