<?php


namespace Project\Controller;

use GuzzleHttp\Psr7\Response;
use Project\Middleware\UserMiddleware;

class UserStoryController extends Controller
{
    public function index()
    {
        $this->view('userstory');

    }
   public function userstory()
    {
        $usname = $_POST['usname'];
        $entantque = $_POST['entanque'];
        $jeveux = $_POST['jeveux'];
        $desorte = $_POST['desorte'];
        $satisfait = $_POST['satisfait'];
        
        //var_dump($usname);
        $user = new UserMiddleware();
        $us = $user->userstory($usname,$entantque,$jeveux,$desorte,$satisfait);
         // var_dump($us);
        if($us)
        {
            header('Location: /usertory');
            exit();
        }
      
    }
}
