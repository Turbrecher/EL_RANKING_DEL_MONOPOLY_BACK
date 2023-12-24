<?php

namespace App\UsefulClasses;

class CalculadoraPuntos
{
    public static function calcularPuntos(int $njugadores, int $puesto): int
    {
        $arrayPuntos = [];
        $puntos = 0;

        for ($i = $njugadores; $i >= 1; $i--) {
                $arrayPuntos[] = $i;
        }

        for ($i = ($puesto - 1); $i < sizeof($arrayPuntos); $i++) {
            $puntos += $arrayPuntos[$i];
        }


        return $puntos;
    }
}