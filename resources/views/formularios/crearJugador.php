<!doctype html>
<html lang="en">
<head>
    <?php include('../resources/views/elementos_compartidos/head.php') ?>
    <script type="module" src="<?php echo $public_folder?>/js/validarCreacionJugador.js"></script>
    <title>Crear Jugador Monopoly Competicion</title>
</head>
<body>

<div class="container">


    <?php include('../resources/views/elementos_compartidos/header.php') ?>
    <?php include('../resources/views/elementos_compartidos/nav.php') ?>

    <main>
        <div class="titulo">
            <h1>CREAR JUGADOR</h1>
        </div>

        <div class="crearJugador">


            <div class="formJugador">
                <form action="crearPartida.php">
                    <div class="form-control">
                        <label for="nombre">Nombre</label>
                        <input autocomplete="off" type="text" name="nombre" id="nombre">
                        <h3 class="error" id="errorNombre"></h3>
                    </div>

                    <div class="form-control">
                        <label for="apellidos">Apellidos</label>
                        <input autocomplete="off" type="text" name="apellidos" id="apellidos">
                        <h3 class="error" id="errorApellidos"></h3>
                    </div>

                    <div class="form-control">
                        <label for="nick">Nick</label>
                        <input autocomplete="off" type="text" name="nick" id="nick">
                        <h3 class="error" id="errorNick"></h3>
                    </div>

                    <div class="submitBox">
                        <input class="submit" type="submit" value="Crear Jugador">
                    </div>


                </form>
            </div>

            <div class="imagenCrearJugador">
                <img src="<?php echo $public_folder?>/images/imagen_crear_jugador.png" alt="">
            </div>
        </div>

    </main>


    <?php include('../resources/views/elementos_compartidos/footer.php') ?>

</div>


</body>
</html>