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
            $nombre=0;
            $score=0;
            $pm = new ProjectMiddleware();
            $pm->getProject($projectId, $_SESSION['user']->getId());
            $matriceMid = new MatriceMiddleware($projectId);
            $etapes = $matriceMid -> getEtapesFromStoryMap();
            $exigences = $matriceMid->getExigencesFromStoryMap();
            $couverture = $matriceMid -> getCouvertureFromStoryMap($etapes);
            echo '<pre>';
            var_dump($etapes,$exigences, $couverture);
            echo '</pre>';
            die();
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
            $exigencesbis = $matriceMid -> GetAllExigence();
            foreach ($exigencesbis as $listage) {
                $nombre=$nombre+1;
                $valide=$matriceMid ->GetnumberTrueByExigence($listage->exi);
                if ($valide->cou!=0) {
                    $score=$score+1;
                }
            }
            if ($nombre!=0) {
                $pm->update_score_matrice($score*5/$nombre, $projectId);
            } else {
                $pm->update_score_matrice(0, $projectId);
            }
        } catch (ProjectMiddlewareException $e) {
        }
    }

    public function correspond($projectId)
    {
        session_start();
        try {
            $pm = new ProjectMiddleware();
            $pm->getProject($projectId, $_SESSION['user']->getId());
            $matriceMid = new MatriceMiddleware($projectId);
            $etapes = $matriceMid->getEtapesFromStoryMap();
            $exigences = $matriceMid->getExigencesFromStoryMap();
            $couverture = $matriceMid -> getCouvertureFromStoryMap($etapes);
            //$matriceMid->createAllEtapes($etapes);
            $this -> viewcontrol('matrice/correspond', ['projectId' => $projectId, 'couverture' => $couverture]);
        } catch (\Exception $exception) {
            $this->view('error/oops', ['error' => $exception]);
        }
    }

    public function create()
    {
        echo '<pre>';
        var_dump($_POST);
        echo '</pre>';
        die();
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
