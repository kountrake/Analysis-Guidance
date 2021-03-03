<?php


namespace Project\Controller;

use GuzzleHttp\Psr7\Response;

class PersonnaController extends Controller
{
    public function index()
    {
        $this->view('personna');
    }
}
