<?php

namespace App\UsefulClasses;

class ContadorCoincidencias
{
    public static function contarCoincidencias(string $palabra, array $lista): int
    {
        $coincidencias = 0;

        foreach ($lista as $elemento) {
            if ($palabra == $elemento) {
                $coincidencias++;
            }
        }


        return $coincidencias;
    }
}