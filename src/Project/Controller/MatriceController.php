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

            $etapes = pg_fetch_array( $matriceMid -> getEtapesFromStoryMap() );
            $exigences = $matriceMid -> getExigencesFromStoryMap();
            $couverture = $matriceMid -> getCouvertureFromStoryMap($etapes);

            $matriceMid -> create($etapes, $exigences);
            $matriceMid -> initiateMatrixValues($couverture);

            $matrix = $matriceMid -> matrixDataToToArray($etapes, $exigences, $couverture);
            $this->loadMatrix($matrix);
            $this->viewcontrol('matrice', [
                'projectId' => $projectId,
                'etapes' => $etapes,
                'exigences' => $exigences,
                'couverture' => $couverture,
                'matrix' => $matrix
                ]);
        } catch (ProjectMiddlewareException $e) {
        }
    }


    //charge l'affichage de la matrice dans l'index html
    public function loadMatrix($matrice)
    {
        foreach ($matrice as $key => $values) {
            echo('<tr> \n<tr>\n'.$key.'\n</tr>\n');
            foreach ($values as $case) {
                echo('<td>'.$case.'</td>\n');
            }
            echo('</tr>\n');
        }
    }

}