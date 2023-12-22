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
                <form action="reglas.php">

                    <div class="form-control">
                        <label for="primerLugar">1º puesto</label>
                        <select class="selector" name="primerLugar" id="primerLugar">
                            <option value="alberto">Alberto</option>
                            <option value="juan carlos">Juan Carlos</option>
                            <option value="gori">Gori</option>
                            <option value="victor">Victor</option>
                            <option value="mari">Mari</option>
                            <option value="jose">Jose</option>
                        </select>
                    </div>

                    <div class="form-control">
                        <label for="segundoLugar">2º puesto</label>
                        <select class="selector" name="segundoLugar" id="segundoLugar">
                            <option value="alberto">Alberto</option>
                            <option value="juan carlos">Juan Carlos</option>
                            <option value="gori">Gori</option>
                            <option value="victor">Victor</option>
                            <option value="mari">Mari</option>
                            <option value="jose">Jose</option>
                        </select>
                    </div>

                    <div class="form-control">
                        <label for="tercerLugar">3º puesto</label>
                        <select class="selector" name="tercerLugar" id="tercerLugar">
                            <option value="alberto">Alberto</option>
                            <option value="juan carlos">Juan Carlos</option>
                            <option value="gori">Gori</option>
                            <option value="victor">Victor</option>
                            <option value="mari">Mari</option>
                            <option value="jose">Jose</option>
                        </select>
                    </div>

                    <div class="form-control">
                        <label for="cuartoLugar">4º puesto</label>
                        <select class="selector" name="cuartoLugar" id="cuartoLugar">
                            <option value="alberto">Alberto</option>
                            <option value="juan carlos">Juan Carlos</option>
                            <option value="gori">Gori</option>
                            <option value="victor">Victor</option>
                            <option value="mari">Mari</option>
                            <option value="jose">Jose</option>
                        </select>
                    </div>

                    <div class="form-control">
                        <label for="quintoLugar">5º puesto</label>
                        <select class="selector" name="quintoLugar" id="quintoLugar">
                            <option value="alberto">Alberto</option>
                            <option value="juan carlos">Juan Carlos</option>
                            <option value="gori">Gori</option>
                            <option value="victor">Victor</option>
                            <option value="mari">Mari</option>
                            <option value="jose">Jose</option>
                        </select>
                    </div>

                    <div class="form-control">
                        <label for="sextoLugar">6º puesto</label>
                        <select class="selector" name="sextoLugar" id="sextoLugar">
                            <option value="alberto">Alberto</option>
                            <option value="juan carlos">Juan Carlos</option>
                            <option value="gori">Gori</option>
                            <option value="victor">Victor</option>
                            <option value="mari">Mari</option>
                            <option value="jose">Jose</option>
                        </select>
                    </div>

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