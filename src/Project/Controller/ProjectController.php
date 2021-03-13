<?php


namespace Project\Controller;

use Exception;
use Project\Middleware\ProjectMiddleware;

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
        $this->view('project', ['id' => $id]);
    }

    public function create()
    {
        session_start();
        try {
            $user = $_SESSION['user'];
            $pm = new ProjectMiddleware();
            $pm->create($user->getId());
        } catch (Exception $exception) {
            $this->view('oops');
            die();
        }
        header('Location: /personna');
        die();
    }
}
