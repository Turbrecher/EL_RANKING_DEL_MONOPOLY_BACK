<?php

namespace App\Controllers;

class HomeController extends Controller
{
    // La página principal mostrará un listado de usuarios
    public function home()
    {
        session_start();
        return $this->view('home'); // Seleccionamos una vista (método padre)
    }


}