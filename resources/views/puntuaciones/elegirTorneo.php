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
                <?php
                foreach ($data as $torneo) {
                    ?>
                    <a href="/puntuaciones/generales/<?php echo $torneo->id ?>"><?php echo $torneo->nombre ?></a>
                <?php }
                ?>
            </div>
        </div>
    </main>


    <?php include('../resources/views/elementos_compartidos/footer.php') ?>

</div>


</body>
</html>