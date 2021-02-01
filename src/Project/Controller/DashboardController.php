<?php


namespace Project\Controller;

use GuzzleHttp\Psr7\Response;

class DashboardController extends Controller
{
    public function index()
    {
        $this->view('dashboard');
    }
}
