<?php


namespace Project\Controller;

use Exception;
use Project\Middleware\PersonnaMiddleware;
use Project\Middleware\ProjectMiddleware;

class PersonnaController extends Controller
{
    public function index()
    {
        session_start();
        $pm = new ProjectMiddleware();
        $projetId = $pm->getLastProjectId($_SESSION['user']->getId());
        $personnaMid = new PersonnaMiddleware($projetId);
        $personnas = $personnaMid->getAllPersonnas();
        if (count($personnas) === 0) {
            $this->viewcontrol('personna', ['projectId' => $projetId]);
        } else {
            $this->viewcontrol('personna', ['projectId' => $projetId, 'personnas' => $personnas]);
        }
    }

    public function create()
    {
        session_start();
        try {
            $name = $_POST['name'];
            $firstname = $_POST['firstname'];
            $age = $_POST['age'];
            $role = $_POST['role'];
            $caracteristique = $_POST['description'];
            $objectifs = $_POST['objectifs'];
            $scenario = $_POST['scenario'];
            $personnaMid = new PersonnaMiddleware($_POST['projectId']);
            $personnaMid
                ->create($name, $firstname, $age, $role, $caracteristique, $objectifs, $scenario);
            $personnas = $personnaMid->getAllPersonnas();
            $this->viewcontrol('personna', ['projectId' => $_POST['projectId'], 'personnas' => $personnas]);
        } catch (Exception $exception) {
            $this->view('oops', ['error' => $exception->getMessage()]);
        }
    }

    public function modify($id)
    {
        session_start();
        try {
            $user = $_SESSION['user'];
            $pm = new ProjectMiddleware();
            $pm->getProject($id, $user->getId());
            $personnaMid = new PersonnaMiddleware($id);
            $personnas = $personnaMid->getAllPersonnas();
            $this->viewcontrol('personna', ['projectId' => $id, 'personnas' => $personnas]);
        } catch (Exception $exception) {
            $this->view('oops', ['error' => $exception->getMessage()]);
        }
    }
}
