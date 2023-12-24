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
        <div class="titulo">
            <h1>PARTIDA 'Nombre Partida'</h1>
        </div>

        <div class="partida">
            <div class="tabla">
                <table>

                    <thead>
                    <tr>
                        <th>Jugador</th>
                        <th>Puntuacion</th>
                    </tr>

                    </thead>


                    <tbody>

                    <?php
                    foreach ($data as $partida) {


                        ?>
                        <tr>
                            <td><?php echo $partida->nick_jugador ?></td>
                            <td><?php echo $partida->puntos ?></td>
                        </tr>

                        <?php
                    }
                    ?>

                    </tbody>


                </table>
            </div>


        </div>

    </main>


    <?php include('../resources/views/elementos_compartidos/footer.php') ?>

</div>


</body>
</html>