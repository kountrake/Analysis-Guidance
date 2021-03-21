<?php


namespace Project\Controller;

use Exception;
use Project\Middleware\PersonnaMiddleware;
use Project\Middleware\ProjectMiddleware;
use Project\Middleware\UserStoryMiddleware;

class ProjectController extends Controller
{
    public function index()
    {
        session_start();
        $user = $_SESSION['user'];
        $pm = new ProjectMiddleware();
        $projects = $pm->getAllProjects($user->getId());
        $this->viewcontrol('projects', ['projects' => $projects]);
    }

    public function show(int $id)
    {
        session_start();
        try {
            $user = $_SESSION['user'];
            $pm = new ProjectMiddleware();
            $pm->getProject($id, $user->getId());
            $personnaMiddleware = new PersonnaMiddleware($id);
            $personnas = $personnaMiddleware->getAllPersonnas();
            $usMiddleware = new UserStoryMiddleware($id);
            $userstories = $usMiddleware->getAllUserStories();
            $this->viewcontrol('project', ['projectId' => $id, 'personnas' => $personnas, 'userstories' => $userstories, 'id' => $id]);
        } catch (Exception $exception) {
            $this->view('error/oops', ['error' => $exception->getMessage()]);
            die();
        }
    }

    public function create()
    {
        session_start();
        try {
            $user = $_SESSION['user'];
            $pm = new ProjectMiddleware();
            $pm->create($user->getId());
            header('Location: /personna/' . $pm->getLastProjectId($user->getId()));
            exit();
        } catch (Exception $exception) {
            $this->view('oops');
            die();
        }

    }

    public function delete()
    {
        $pm = new ProjectMiddleware();
        $pm->delete($_POST['id']);
        header('Location: /myprojects');
        exit();
    }
}
