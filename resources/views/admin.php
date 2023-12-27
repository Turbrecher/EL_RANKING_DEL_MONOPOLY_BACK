<!doctype html>
<html lang="en">
<head>
    <?php include('../resources/views/elementos_compartidos/head.php') ?>
    <title>Reglas Monopoly Competicion</title>
</head>
<body>

<div class="container">

    <?php include('../resources/views/elementos_compartidos/header.php') ?>
    <?php include('../resources/views/elementos_compartidos/nav.php') ?>

    <main>

        <?php
        //Guardamos los datos en 3 arrays diferentes.
        $partidas = $data[0];
        $jugadores = $data[1];
        $torneos = $data[2];
        ?>
        <div class="titulo">
            <h1>Partidas</h1>
        </div>

        <div class="listaPartidas">
            <table>
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Ganador</th>
                    <th>Torneo</th>
                </tr>
                </thead>

                <tbody>
                <?php
                foreach ($partidas as $partida) {
                    ?>

                    <tr>
                        <td><?php echo $partida->nombre ?></td>
                        <td><?php echo $partida->fecha ?></td>
                        <td><?php echo $partida->ganador ?></td>
                        <td><?php echo $partida->id_torneo ?></td>
                        <td class="trash">
                            <a href="/admin/eliminar/partida/<?php echo $partida->id?>">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>

                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>


        <div class="titulo">
            <h1>Jugadores</h1>
        </div>

        <div class="listaJugadores">
            <table>
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Nick</th>
                </tr>
                </thead>

                <tbody>
                <?php
                foreach ($jugadores as $jugador) {
                    ?>

                    <tr>
                        <td><?php echo $jugador->nombre ?></td>
                        <td><?php echo $jugador->apellidos ?></td>
                        <td><?php echo $jugador->nick ?></td>
                        <td class="trash">
                            <a href="/admin/eliminar/jugador/<?php echo $jugador->nick?>">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>

                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>


        <div class="titulo">
            <h1>Torneos</h1>
        </div>


        <div class="listaTorneos">
            <table>
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                </tr>
                </thead>

                <tbody>
                <?php
                foreach ($data[2] as $torneo) {
                    ?>

                    <tr>
                        <td><?php echo $torneo->nombre ?></td>
                        <td><?php echo $torneo->fecha_inicio ?></td>
                        <td><?php echo $torneo->fecha_fin ?></td>

                        <td class="trash">
                            <a href="/admin/eliminar/torneo/<?php echo $torneo->id?>">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>

                    </tr>

                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </main>


    <?php include('../resources/views/elementos_compartidos/footer.php') ?>

</div>


</body>
</html>