<?php

namespace App\Controllers;

class HomeController extends Controller
{

    public function home(): string|false
    {
        return $this->view('home');
    }

    public function error(): string
    {
        return $this->view('error');
    }


}