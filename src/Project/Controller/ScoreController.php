<?php


namespace Project\Controller;

use Project\Middleware\ProjectMiddleware;

class ScoreController extends Controller
{
    public function index($projectId)
    {   session_start();
        $user = $_SESSION['user'];
        $pm = new ProjectMiddleware();
        $projects=$pm->getoneProject($user->getId(),$projectId);
        $projects=$projects[0];
        $score_avg=($projects->score_moyen_personna+$projects->score_moyen_userstory+$projects->score_storymap+$projects->score_matrice);
        $pm->update_score($score_avg,$projectId);
        $projects=$pm->getoneProject($user->getId(),$projectId);
        $projects=$projects[0];
        $this->viewcontrol('score', ['projectId' => $projects]);
    }
}
