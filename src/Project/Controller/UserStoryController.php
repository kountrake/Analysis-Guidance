<?php


namespace Project\Controller;

use Exception;
use Project\Middleware\PersonnaMiddleware;
use Project\Middleware\ProjectMiddleware;
use Project\Middleware\UserStoryMiddleware;

class UserStoryController extends Controller
{
    public function index($projectId)
    {
        try {
            session_start();
            $pm = new ProjectMiddleware();
            $pm->getProject($projectId, $_SESSION['user']->getId());
            $usMid = new UserStoryMiddleware($projectId);
            $us = $usMid->getAllUserStories();
            $persmidd = new PersonnaMiddleware($projectId);
            $roles = $persmidd->getAllRoles();
            if (count($roles) === 0) {
                $this->view('error/oops', ['error' => "Vous n'avez pas encore créé de personna. Merci de suivre ce lien : <a class='underline' href='/personna/". $projectId ."'>personna</a>"]);
                exit();
            }
            if (count($us) === 0) {
                $this->viewcontrol('userstory', ['projectId' => $projectId, 'roles' => $roles]);
            } else {
                $this->viewcontrol('userstory', ['projectId' => $projectId, 'roles' => $roles, 'userstories' => $us]);
            }
        } catch (Exception $e) {
            $this->view('error/oops', ['error' => $e->getMessage()]);
        }
    }

    public function create()
    {
        session_start();
        try {
            $idProject = $_POST['idProjet'];
            $entantque = $_POST['entantque'];
            $jeveux = $_POST['jeveux'];
            $desorte = $_POST['desorte'];
            $critere1 = $_POST['critere1'];
            $critere2 = $_POST['critere2'];
            $critere3 = $_POST['critere3'];
            $usMid = new UserStoryMiddleware($idProject);
            $usMid->create($entantque, $jeveux, $desorte, $critere1, $critere2, $critere3);
            header('Location: /userstory/' . $idProject);
            exit();
        } catch (Exception $exception) {
            $this->view('error/oops', ['error' => $exception->getMessage()]);
        }
    }

    public function change()
    {
        try {
            $idProject = $_POST['idProjet'];
            $usMid = new UserStoryMiddleware($idProject);
            $us = $usMid->getUserStory($_POST['idus']);
            $this->viewcontrol('modify/userstory', ['projectId' => $idProject, 'us' => $us]);
        } catch (Exception $exception) {
            $this->view('error/oops', ['error' => $exception->getMessage()]);
        }
    }

    public function update()
    {
        try {
            $idProject = $_POST['projectId'];
            $idUserStory = $_POST['userstoryId'];
            $entantque = $_POST['entantque'];
            $jeveux = $_POST['jeveux'];
            $desorte = $_POST['desorte'];
            $critere1 = $_POST['critere1'];
            $critere2 = $_POST['critere2'];
            $critere3 = $_POST['critere3'];
            $usMid = new UserStoryMiddleware($idProject);
            $usMid->update($entantque, $jeveux, $desorte, $critere1, $critere2, $critere3, $idUserStory);
            header('Location: /userstory/' . $idProject);
            exit();
        } catch (Exception $exception) {
            $this->view('error/oops', ['error' => $exception->getMessage()]);
        }
    }

    public function delete()
    {
        $pm = new UserStoryMiddleware($_POST['idProjet']);
        $pm->delete($_POST['idus']);
        header('Location: /userstory/' . $_POST['idProjet']);
        exit();
    }
}
