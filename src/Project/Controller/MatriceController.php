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

            $matriceMid -> create($etapes, $exigences);
            $matriceMid -> initiateMatrixValues($couverture);
            $matriceMid -> getMatrix();

            $this->viewcontrol('matrice', ['projectId' => $projectId, 'matriceHtml' => $matriceHtml]);
        } catch (ProjectMiddlewareException $e) {
        }
    }

    //


    //charge l'affichage de la matrice dans l'index html
    public function loadMatrix($matrice)
    {
        foreach ($matrice as $row) {
            echo('<tr> \n');
            foreach ($row as $case) {
                echo('<td>'.$case.'</td>\n');
            }
            echo('</tr>\n');
        }
    }

}