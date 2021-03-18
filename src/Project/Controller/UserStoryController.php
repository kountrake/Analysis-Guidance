<?php


namespace Project\Controller;

use Exception;
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
            if (count($us) === 0) {
                $this->viewcontrol('userstory', ['projectId' => $projectId]);
            } else {
                $this->viewcontrol('userstory', ['projectId' => $projectId, 'userstories' => $us]);
            }
        } catch (Exception $e) {
            $this->view('oops', ['error' => $e->getMessage()]);
        }
    }

    public function create()
    {
        session_start();
        try {
            $idProject = $_POST['idProjet'];
            $entantque = $_POST['entanque'];
            $jeveux = $_POST['jeveux'];
            $desorte = $_POST['desorte'];
            $satisfait = $_POST['satisfait'];
            $critere1 = $_POST['critere1'];
            $critere2 = $_POST['critere2'];
            $critere3 = $_POST['critere3'];
            $usMid = new UserStoryMiddleware($idProject);
            $usMid->create($entantque, $jeveux, $desorte, $satisfait, $critere1, $critere2, $critere3);
            header('Location: /userstory/' . $idProject);
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
            $usMid = new UserStoryMiddleware($id);
            $us = $usMid->getAllUserStories();
            $this->viewcontrol('userstory', ['projectId' => $id, 'us' => $us]);
        } catch (Exception $exception) {
            $this->view('oops', ['error' => $exception->getMessage()]);
        }
    }

    public function change()
    {
        try {
            $idProject = $_POST['idProjet'];
            $usMid = new UserStoryMiddleware($idProject);
            $us = $usMid->getUserStory($_POST['idUserStory']);
            $this->viewcontrol('modify/userstory', ['projectId' => $idProject, 'userstory' => $us]);
        } catch (Exception $exception) {
            $this->view('error/oops', ['error' => $exception->getMessage()]);
        }
    }

    public function update()
    {
        try {
            $idProject = $_POST['projectId'];
            $idUserStory = $_POST['userstoryId'];
            $entantque = $_POST['entanque'];
            $jeveux = $_POST['jeveux'];
            $desorte = $_POST['desorte'];
            $satisfait = $_POST['satisfait'];
            $critere1 = $_POST['critere1'];
            $critere2 = $_POST['critere2'];
            $critere3 = $_POST['critere3'];
            $usMid = new UserStoryMiddleware($idProject);
            $usMid->update($entantque, $jeveux, $desorte, $satisfait, $critere1, $critere2, $critere3, $idUserStory);
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
