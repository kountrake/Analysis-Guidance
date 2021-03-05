<?php


namespace Project\Controller;

use GuzzleHttp\Psr7\Response;

class ScoreController extends Controller
{
    public function index()
    {
        $this->viewcontrol('score');
    }
}
