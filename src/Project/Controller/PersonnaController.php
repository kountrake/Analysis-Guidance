<?php


namespace Project\Controller;

use Exception;
use Project\Middleware\ProjectMiddleware;

class PersonnaController extends Controller
{
    public function index()
    {
        $this->view('personna');
    }

    public function create()
    {
        session_start();
        try {
            var_dump($_POST);
            $name = $_POST['name'];
            $firstname = $_POST['firstname'];
            $role = $_POST['entantque'];
            $jeveux = $_POST['jeveux'];
            $caracteristique = $_POST['description'];
            $objectifs = $_POST['objectifs'];
            $scenario = $_POST['scenario'];
            $projet = new ProjectMiddleware();
            $projectId = $projet->create($_SESSION['user']->getId());
            $personnaMid = new PersonnaMiddleware();
            $personnaMid
                ->create($name, $firstname, $role, $jeveux, $caracteristique, $objectifs, $scenario, $projectId);
            $personnas = $personnaMid->getAllPersonnas($projectId);
        } catch (Exception $exception) {
            var_dump($exception);
        }
        $this->viewcontrol();
    }
}
