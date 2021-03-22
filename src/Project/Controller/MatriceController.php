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
            $etapes = $matriceMid->getEtapesFromStoryMap();
            $couverture = $matriceMid -> getCouvertureFromStoryMap($etapes);
            $couvertureId = $matriceMid->getCouvertureIdFromCorrespond($couverture);
            $correspond = $matriceMid->getCorrespond();

            $this -> viewcontrol(
                'matrice',
                [
                    'projectId' => $projectId,
                    'couverture' => $couverture,
                    'couvertureId' => $couvertureId,
                    'correspond' => $correspond
                ]
            );
//            $exigencesbis = $matriceMid -> GetAllExigence();
//            foreach ($exigencesbis as $listage) {
//                $nombre=$nombre+1;
//                $valide=$matriceMid ->GetnumberTrueByExigence($listage->exi);
//                if ($valide->cou!=0) {
//                    $score=$score+1;
//                }
//            }
//            if ($nombre!=0) {
//                $pm->update_score_matrice($score*5/$nombre, $projectId);
//            } else {
//                $pm->update_score_matrice(0, $projectId);
//            }
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

            if ($matriceMid->protection() === false) {
                $matriceMid->createAllEtapes($etapes, $projectId);
                $matriceMid->createAllExigences($exigences, $projectId);
            }

            $couvertureId = $matriceMid->getCouvertureIdFromCorrespond($couverture);


            $this -> viewcontrol(
                'matrice/correspond',
                [
                    'projectId' => $projectId,
                    'couverture' => $couverture,
                    'couvertureId' => $couvertureId
                ]
            );
        } catch (\Exception $exception) {
            $this->view('error/oops', ['error' => $exception]);
        }
    }

    public function create()
    {
        try {
            $projectId = $_POST['projectId'];
            $matriceMid = new MatriceMiddleware($projectId);
            $etapes = $matriceMid->getEtapesFromStoryMap();
            $exigences = $matriceMid->getExigencesFromStoryMap();

            $couverture = $matriceMid -> getCouvertureFromStoryMap($etapes);
            $etapesId = $matriceMid->getEtapesIdFromCouverture($couverture);

            foreach ($etapesId as $etapeId) {
                foreach ($_POST[$etapeId] as $exigenceId) {
                    $matriceMid->createCorrespond($etapeId, $exigenceId);
                }
            }
            header('Location: /matrice/'. $projectId);
            exit();
        } catch (\Exception $exception) {
            $this->view('error/oops', ['error' => $exception]);
        }

    }

    //charge l'affichage de la matrice dans l'index html
    public function loadMatrix($matrice)
    {
        foreach ($matrice as $key => $values) {
            echo('<tr> \n<tr>\n'.$key.'\n</tr>\n');
            foreach ($values as $case) {
                echo('<td> test </td>\n');
            }
            echo('</tr>\n');
        }
    }
}

/*
 * etapes -> [etape1, etape2]
 * exigence1 -> ['', 'x', ...;]
 * exigence2 -> ['', '', 'x', ...]
 */