<!doctype html>
<html lang="en">
<head>
    <?php include('../resources/views/elementos_compartidos/head.php') ?>
    <title>Puntuaciones Monopoly Competicion</title>
</head>
<body>

<div class="container">

    <?php include('../resources/views/elementos_compartidos/header.php') ?>
    <?php include('../resources/views/elementos_compartidos/nav.php') ?>

    <main>
        <div class="puntuaciones">

            <?php
            if (sizeof($data[0]) > 0){
            ?>

            <div class="titulo">
                <h1>PUNTUACIONES TORNEO <?php ?></h1>
            </div>

            <div class="torneo">
                <table>
                    <thead>
                    <tr>
                        <th>Jugador</th>
                        <th>Puntos</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    foreach ($data[0] as $jugador) {


                        ?>
                        <tr>
                            <td><?php echo $jugador->nick_jugador ?></td>
                            <td><?php echo $jugador->puntos ?></td>
                        </tr>

                        <?php
                    }
                    ?>
                    </tbody>


                </table>
            </div>


            <div class="titulo">
                <h1>PARTIDAS</h1>
            </div>

            <?php
            foreach ($data[1] as $partida){


            ?>
            <div class="partidas">
                <a href="/puntuaciones/partida/<?php echo $partida->id ?>">
                    <table>

                        <thead>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Ganador</th>
                        </thead>


                        <tbody>
                        <td><?php echo $partida->nombre ?></td>
                        <td><?php echo $partida->fecha ?></td>
                        <td><?php echo $partida->ganador ?></td>
                        </tbody>


                    </table>
                </a>

                <?php
                }
                ?>

                <?php
                }else{
                //LE DECIMOS AL USUARIO QUE CREE UNA PARTIDA.
                echo "<h1>Aun no se han creado partidas, crea una!</h1>";
                echo "<form action='/crear/partida'>
                        <div class='submitBox'>
                            <input class='submit' type='submit' value='Crear Partida'></form>
                        </div>";
                }
                ?>
            </div>

        </div>

    </main>


    <?php include('../resources/views/elementos_compartidos/footer.php') ?>

</div>


</body>
</html>