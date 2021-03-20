<?php


namespace Project\Controller;

use Exception;
use Project\Middleware\PersonnaMiddleware;
use Project\Middleware\ProjectMiddleware;

class PersonnaController extends Controller
{
    public function index($projectId)
    {
        session_start();
        $pm = new ProjectMiddleware();
        $personnaMid = new PersonnaMiddleware($projectId);
        $personnas = $personnaMid->getAllPersonnas();
        if (count($personnas) === 0) {
            $this->viewcontrol('personna', ['projectId' => $projectId]);
            $pm->update_score_persona(0,$projectId);
        } else {
            $this->viewcontrol('personna', ['projectId' => $projectId, 'personnas' => $personnas]);
            foreach($personnas as $value){
                if((strlen($value->objectif)>50) and (strlen($value->caractéristiques)>50) and (strlen($value->scénario)>50))
                {$personnaMid->update_score($value->idpersonna,5);}
                else
                $personnaMid->update_score($value->idpersonna,2);
            } 
            $pm->update_score_persona($personnaMid->getscore_moyen()[0]->sco,$projectId);
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
                ->create($name, $firstname, intval($age), $role, $caracteristique, $objectifs, $scenario);
            header('Location: /personna/' . $_POST['projectId']);
            exit();
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

    public function change()
    {
        try {
            $idProject = $_POST['idProjet'];
            $personnaMid = new PersonnaMiddleware($idProject);
            $personna = $personnaMid->getPersonna($_POST['idPersonna']);
            $this->viewcontrol('modify/personna', ['projectId' => $idProject, 'personna' => $personna]);
        } catch (Exception $exception) {
            $this->view('error/oops', ['error' => $exception->getMessage()]);
        }
    }

    public function update()
    {
        try {
            $idProject = $_POST['projectId'];
            $idPersonna = $_POST['personnaId'];
            $name = $_POST['name'];
            $firstname = $_POST['firstname'];
            $age = $_POST['age'];
            $role = $_POST['role'];
            $caracteristique = $_POST['description'];
            $objectifs = $_POST['objectifs'];
            $scenario = $_POST['scenario'];
            $personnaMid = new PersonnaMiddleware($idProject);
            $personnaMid->update($name, $firstname, $age, $role, $caracteristique, $objectifs, $scenario, $idPersonna);
            header('Location: /personna/' . $idProject);
            exit();
        } catch (Exception $exception) {
            $this->view('error/oops', ['error' => $exception->getMessage()]);
        }
    }

    public function delete()
    {
        $pm = new PersonnaMiddleware($_POST['idProjet']);
        $pm->delete($_POST['id']);
        header('Location: /personna/' . $_POST['idProjet']);
        exit();
    }

    public function redirect($idProjet)
    {
        $pm = new PersonnaMiddleware($_POST['idProjet']);
        $pm->getAllPersonnas();
        header('Location: /personna/' . $_POST['idProjet']);
        exit();
    }
}
