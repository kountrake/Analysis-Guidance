<?php


namespace Project\Controller;


class HomeController extends Controller
{
    public function index()
    {
        $this->view('home');
    }
}
