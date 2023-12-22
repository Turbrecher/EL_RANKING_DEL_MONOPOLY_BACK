<!doctype html>
<html lang="en">
<head>
    <?php include('../resources/views/elementos_compartidos/head.php') ?>
    <title>Elegir Torneo Monopoly Competicion</title>
</head>
<body>

<div class="container">

    <?php include('../resources/views/elementos_compartidos/header.php') ?>
    <?php include('../resources/views/elementos_compartidos/nav.php') ?>

    <main>


        <div class="titulo">
            <h1>ELECCION DE TORNEO</h1>
        </div>
        <div class="eleccionTorneo">
            <div class="imgDecoracion">
                <img src=<?php $public_folder ?>"/images/torneo.png" alt="">
            </div>

            <div class="torneos">
                <a href="/puntuaciones/generales">Torneo 1</a>
                <a href="/puntuaciones/generales">Torneo 2</a>
                <a href="/puntuaciones/generales">Torneo 3</a>
                <a href="/puntuaciones/generales">Torneo 4</a>
                <a href="/puntuaciones/generales">Torneo 5</a>
                <a href="/puntuaciones/generales">Torneo 6</a>
                <a href="/puntuaciones/generales">Torneo 7</a>
                <a href="/puntuaciones/generales">Torneo 8</a>
                <a href="/puntuaciones/generales">Torneo 9</a>
                <a href="/puntuaciones/generales">Torneo 10</a>
                <a href="/puntuaciones/generales">Torneo 11</a>
            </div>
        </div>
    </main>


    <?php include('../resources/views/elementos_compartidos/footer.php') ?>

</div>


</body>
</html>