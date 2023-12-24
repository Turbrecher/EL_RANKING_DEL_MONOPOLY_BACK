<!doctype html>
<html lang="en">
<head>
    <?php include('../resources/views/elementos_compartidos/head.php') ?>
    <title>Puestos Partida Monopoly Competicion</title>
</head>
<body>

<div class="container">

    <?php include('../resources/views/elementos_compartidos/header.php') ?>
    <?php include('../resources/views/elementos_compartidos/nav.php') ?>

    <main>
        <div class="titulo">
            <h1>¿COMO HABEIS QUEDADO?</h1>
        </div>

        <div class="posicionesPartida">

            <div class="formPosicionesPartida">
                <form method="post" action="/crear/partida">


                    <?php
                    for ($i = 0; $i < $data[0]['nJugadores']; $i++) { ?>


                        <div class="form-control">
                            <label for=<?php echo('posicion' . $i) ?>><?php echo $i + 1 ?>º puesto</label>
                            <select class="selector"
                                    name=<?php echo($i+1) ?> id=<?php echo('posicion' . $i) ?>>
                                <option selected>Elija jugador</option>
                                <?php
                                foreach ($data[1] as $jugador) {
                                    echo "<option value='$jugador->nick'>$jugador->nick</option>";
                                }
                                ?>>
                            </select>
                        </div>

                    <?php }
                    ?>


                    <input type="hidden" name="nombre" value='<?php echo($data[0]['nombre'])?>'>
                    <input type="hidden" name="torneo" value=<?php echo($data[0]['torneo']) ?>>
                    <input type="hidden" name="fecha" value=<?php echo($data[0]['fecha']) ?>>
                    <input type="hidden" name="nJugadores" value=<?php echo($data[0]['nJugadores']) ?>>

                    <div class="submitBox">
                        <input class="submit" type="submit" value="Crear Partida">
                    </div>

                </form>

            </div>
            <h2 style="text-align: center" id="errorSelectores" class="error"></h2>
        </div>

    </main>


    <?php include('../resources/views/elementos_compartidos/footer.php') ?>

</div>


</body>
</html>