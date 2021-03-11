<?php


namespace Project\Controller;

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
        $this->viewcontrol('project', ['id' => $id]);
    }
}
