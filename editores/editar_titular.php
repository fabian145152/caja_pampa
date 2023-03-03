<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Editar Titulares</title>
    <link rel="stylesheet" type="text/css" href="hoja.css">
</head>

<body>

    <h1>ACTUALIZAR</h1>
    <?php

    include("../includes/conexion.php");




    if (!isset($_POST["bot_actualizar"])) {
        $id = $_GET["id"];
        $movil = $_GET['movil'];
        $fecha_ini = $_GET['fecha_ini'];
        $nombre_titular = $_GET["nombre_titular"];
        $dir_titular = $_GET["dir_titular"];
        $cp_titular = $_GET['cp_titular'];
        $cel_titular = $_GET["cel_titular"];
        $dni_titular = $_GET['dni_titular'];
        $email_titular = $_GET['email_titular'];
    } else {

        $id = $_POST["id"];
        $movil = $_POST['movil'];
        $fecha_ini = $_POST['fecha_ini'];
        $nombre_titular = $_POST["nombre_titular"];
        $dir_titular = $_POST["dir_titular"];
        $cp_titular = $_POST['cp_titular'];
        $cel_titular = $_POST["cel_titular"];
        $dni_titular = $_POST['dni_titular'];
        $email_titular = $_POST['email_titular'];




        $sql = "UPDATE unidades SET movil=:miMovil,
                                    fecha_ini=:miFecha_ini,
                                    nombre_titular=:miNombre_titular, 
                                    dir_titular=:miDir_titular,
                                    cp_titular=:miCp_titular, 
                                    cel_titular=:miCel_titular,
                                    dni_titular=:miDni_titular,
                                    email_titular=:miEmail_titular 
                                    WHERE id=:miId";

        $resultado = $base->prepare($sql);

        $resultado->execute(array(
            ":miId" => $id,
            ":miMovil" => $movil,
            ":miFecha_ini" => $fecha_ini,
            ":miNombre_titular" => $nombre_titular,
            ":miDir_titular" => $dir_titular,
            ":miCp_titular" => $cp_titular,
            ":miCel_titular" => $cel_titular,
            ":miDni_titular" => $dni_titular,
            ":miEmail_titular" => $email_titular
        ));

        header("location:inicio.php?");
    }
    ?>

    <p>

    </p>
    <p>&nbsp;</p>
    <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <!--
  Para usar la linea anterior me conecte a la BBDD, y use el metodo post porque si uso el get viajan en la url y se me sobreescribirian
  con PHP_SELF Mando todo a esta misma pagina

-->

        <table width="35%" border="0" align="center">
            <tr>
                <td></td>
                <td><label for="id"></label>
                    <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
                    <!-- Si quiero no mostrar el id saco la etiqueta de php y listo -->
                </td>
            </tr>
            <tr>
                <td>Movil</td>
                <td><label for="movil"></label>
                    <input type="text" name="movil" id="movil" value="<?php echo $movil ?>">
                </td>
            </tr>
            <tr>
                <td>Fecha Inicio</td>
                <td><label for="fecha_ini"></label>
                    <input type="text" name="fecha_ini" id="fecha_ini" value="<?php echo $fecha_ini ?>">
                </td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><label for="nombre_titular"></label>
                    <input type="text" name="nombre_titular" id="nombre_titular" value="<?php echo $nombre_titular ?>">
                </td>
            </tr>
            <tr>
                <td>Direccion</td>
                <td><label for="dir_titular"></label>
                    <input type="text" name="dir_titular" id="dir_titular" value="<?php echo $dir_titular ?>">
                </td>
            </tr>
            <tr>
                <td>CP</td>
                <td><label for="cp_titular"></label>
                    <input type="text" name="cp_titular" id="cp_titular" value="<?php echo $cp_titular ?>">
                </td>
            </tr>
            <tr>
                <td>Celular</td>
                <td><label for="cel_titular"></label>
                    <input type="text" name="cel_titular" id="cel_titular" value="<?php echo $cel_titular ?>">
                </td>
            </tr>
            <tr>
                <td>DNI</td>
                <td><label for="dni_titular"></label>
                    <input type="text" name="dni_titular" id="dni_titular" value="<?php echo $dni_titular ?>">
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td><label for="email_titular"></label>
                    <input type="text" name="email_titular" id="email_titular" value="<?php echo $email_titular ?>">
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="bot_actualizar" id="bot_actualizar" value="Actualizar"></td>
            </tr>
        </table>
    </form>
    <p>&nbsp;</p>
    <a href="inicio.php">Volcer al listado</a>
    <br>
    <a href="../index.php">Salir</a>
</body>

</html>