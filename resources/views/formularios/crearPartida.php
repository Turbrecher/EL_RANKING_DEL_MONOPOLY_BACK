<!doctype html>
<html lang="en">
<head>
    <?php include('../resources/views/elementos_compartidos/head.php') ?>
    <script type="module" src="<?php echo $public_folder?>/js/validarCreacionPartida.js"></script>
    <title>Crear Partida Monopoly Competicion</title>
</head>
<body>

<div class="container">

    <?php include('../resources/views/elementos_compartidos/header.php') ?>
    <?php include('../resources/views/elementos_compartidos/nav.php') ?>

    <main>
        <div class="titulo">
            <h1>CREAR PARTIDA</h1>
        </div>

        <div class="crearPartida">
            <div class="imagenCrearPartida">
                <img src="<?php echo $public_folder?>/images/imagen_crear_partida.png" alt="">
            </div>

            <div class="formPartida">
                <form action="/crear/partida/posiciones">
                    <div class="form-control">
                        <label for="nombre">Nombre</label>
                        <input autocomplete="off" type="text" name="nombre" id="nombre">
                        <h3 class="error" id="errorNombre"></h3>
                    </div>


                    <div class="form-control">
                        <label for="nJugadores">Jugadores</label>
                        <select name="nJugadores" id="nJugadores">
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                        </select>
                    </div>

                    <div class="form-control">
                        <label for="torneo">Torneo</label>
                        <select name="torneo" id="torneo">
                            <option value="1">Torneo 1</option>
                            <option value="2">Torneo 2</option>
                            <option value="3">Torneo 3</option>
                            <option value="4">Torneo 4</option>
                            <option value="5">Torneo 5</option>
                            <option value="6">Torneo 6</option>
                        </select>
                    </div>

                    <div class="form-control">
                        <label for="fecha">Fecha</label>
                        <input autocomplete="off" type="date" name="fecha" id="fecha">
                        <h3 class="error" id="errorFecha"></h3>
                    </div>

                    <div class="submitBox">
                        <input class="submit" type="submit" value="Siguiente paso">
                    </div>


                </form>
            </div>
        </div>

    </main>


    <?php include('../resources/views/elementos_compartidos/footer.php') ?>

</div>


</body>
</html>