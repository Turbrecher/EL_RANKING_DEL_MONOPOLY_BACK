<!doctype html>
<html lang="en">
<head>
    <?php include('../resources/views/elementos_compartidos/head.php') ?>
    <script type="module" src="<?php echo $public_folder?>/js/validarCreacionTorneo.js"></script>
    <title>Crear Torneo Monopoly Competicion</title>
</head>
<body>

<div class="container">

    <?php include('../resources/views/elementos_compartidos/header.php') ?>
    <?php include('../resources/views/elementos_compartidos/nav.php') ?>

    <main>
        <div class="titulo">
            <h1>CREAR TORNEO</h1>
        </div>


        <div class="crearTorneo">
            <div class="imagenCrearTorneo">
                <img src="<?php echo $public_folder?>/images/imagen_crear_torneo.png" alt="">
            </div>

            <div class="formTorneo">
                <form action="crearPartida.php">
                    <div class="form-control">
                        <label for="nombre">Nombre</label>
                        <input autocomplete="off" type="text" name="nombre" id="nombre">
                        <h3 class="error" id="errorNombre"></h3>
                    </div>

                    <div class="form-control">
                        <label for="fInicio">Inicio</label>
                        <input type="date" name="fInicio" id="fInicio">
                        <h3 class="error" id="errorFechaInicio"></h3>
                    </div>

                    <div class="form-control">
                        <label for="fFin">Fin</label>
                        <input type="date" name="fFin" id="fFin">
                        <h3 class="error" id="errorFechaFin"></h3>
                    </div>

                    <div class="submitBox">
                        <input class="submit" type="submit" value="Crear Torneo">
                    </div>


                </form>
            </div>
        </div>


    </main>


    <footer>
        <div class="redesSociales">
            <i class="fa-brands fa-twitter"></i>
            <i class="fa-brands fa-instagram"></i>
            <i class="fa-brands fa-tiktok"></i>
            <i class="fa-brands fa-facebook"></i>
            <i class="fa-brands fa-linkedin"></i>
        </div>
        <div class="info">
            <h3>2023. Monopoly Competición. Esta aplicación ha sido diseñada para uso exclusivamente personal.
                Bajo ningun concepto se permite la venta o comercialización de dicho producto.</h3>
        </div>
    </footer>

</div>


</body>
</html>