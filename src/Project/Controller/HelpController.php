<?php


namespace Project\Controller;

use GuzzleHttp\Psr7\Response;

class HelpController extends Controller
{
    public function index()
    {
        $this->view('help');
    }
}
