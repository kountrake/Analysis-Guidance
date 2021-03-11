<?php


namespace Project\Controller;

use Project\Middleware\UserMiddleware;

class UserStoryController extends Controller
{
    public function index()
    {
        $this->viewcontrol('userstory');
    }

    public function userstory()
    {
        $usname = $_POST['usname'];
        $entantque = $_POST['entanque'];
        $jeveux = $_POST['jeveux'];
        $desorte = $_POST['desorte'];
        $satisfait = $_POST['satisfait'];
        $user = new UserMiddleware();
        $us = $user->userstory($entantque, $jeveux, $desorte, $satisfait);
        if ($us) {
            header('Location: /usertory');
            exit();
        }
    }
}
