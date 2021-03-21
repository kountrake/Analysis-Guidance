<?php


namespace Project\Controller;


use Project\Middleware\ProjectMiddleware;
use Project\Middleware\ProjectMiddlewareException;
use Project\Middleware\MatriceMiddleware;

class MatriceController extends Controller
{
    public function index(string $projectId)
    {
        session_start();
        try {
            $pm = new ProjectMiddleware();
            $pm->getProject($projectId, $_SESSION['user']->getId());
            $matriceMid = new MatriceMiddleware($projectId);
            $etapes = $matriceMid -> getEtapesFromStoryMap();
            $exigences = $matriceMid -> getExigencesFromStoryMap();
            $couverture = $matriceMid -> getCouvertureFromStoryMap($etapes);

            $this->viewcontrol('matrice', ['projectId' => $projectId]);
        } catch (ProjectMiddlewareException $e) {
        }
    }


}