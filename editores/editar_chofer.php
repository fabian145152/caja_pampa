<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Editar Choferes</title>
    <link rel="stylesheet" type="text/css" href="hoja.css">
    <style>
        table {
            width: 100%;
        }

        th
        td {
            width: 25%;
        }
    </style>
</head>

<body>

    <h1>ACTUALIZAR</h1>
    <?php

    include("../includes/conexion.php");




    if (!isset($_POST["bot_actualizar"])) {
        $id = $_GET["id"];
        $nombre_chofer = $_GET["nombre_chofer"];
        $dir_chofer = $_GET["dir_chofer"];
        $cp_chofer = $_GET['cp_chofer'];
        $cel_chofer = $_GET["cel_chofer"];
        $dni_chofer = $_GET['dni_chofer'];
        $email_chofer = $_GET['email_chofer'];

        $nombre_chofer_2 = $_GET["nombre_chofer_2"];
        $dir_chofer_2 = $_GET["dir_chofer_2"];
        $cp_chofer_2 = $_GET['cp_chofer_2'];
        $cel_chofer_2 = $_GET["cel_chofer_2"];
        $dni_chofer_2 = $_GET['dni_chofer_2'];
        $email_chofer_2 = $_GET['email_chofer_2'];
    } else {

        $id = $_POST["id"];
        $nombre_chofer = $_POST["nombre_chofer"];
        $dir_chofer = $_POST["dir_chofer"];
        $cp_chofer = $_POST['cp_chofer'];
        $cel_chofer = $_POST["cel_chofer"];
        $dni_chofer = $_POST['dni_chofer'];
        $email_chofer = $_POST['email_chofer'];

        $nombre_chofer_2 = $_POST["nombre_chofer_2"];
        $dir_chofer_2 = $_POST["dir_chofer_2"];
        $cp_chofer_2 = $_POST['cp_chofer_2'];
        $cel_chofer_2 = $_POST["cel_chofer_2"];
        $dni_chofer_2 = $_POST['dni_chofer_2'];
        $email_chofer_2 = $_POST['email_chofer_2'];




        $sql = "UPDATE unidades SET nombre_chofer=:miNombre_chofer, 
                                    dir_chofer=:miDir_chofer,
                                    cp_chofer=:miCp_chofer, 
                                    cel_chofer=:miCel_chofer,
                                    dni_chofer=:miDni_chofer,
                                    email_chofer=:miEmail_chofer,

                                    nombre_chofer_2=:miNombre_chofer_2, 
                                    dir_chofer_2=:miDir_chofer_2,
                                    cp_chofer_2=:miCp_chofer_2, 
                                    cel_chofer_2=:miCel_chofer_2,
                                    dni_chofer_2=:miDni_chofer_2,
                                    email_chofer_2=:miEmail_chofer_2

                                    WHERE id=:miId";

        $resultado = $base->prepare($sql);

        $resultado->execute(array(
            ":miId" => $id,
            ":miNombre_chofer" => $nombre_chofer,
            ":miDir_chofer" => $dir_chofer,
            ":miCp_chofer" => $cp_chofer,
            ":miCel_chofer" => $cel_chofer,
            ":miDni_chofer" => $dni_chofer,
            ":miEmail_chofer" => $email_chofer,

            ":miNombre_chofer_2" => $nombre_chofer_2,
            ":miDir_chofer_2" => $dir_chofer_2,
            ":miCp_chofer_2" => $cp_chofer_2,
            ":miCel_chofer_2" => $cel_chofer_2,
            ":miDni_chofer_2" => $dni_chofer_2,
            ":miEmail_chofer_2" => $email_chofer_2
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
                <td>Nombre</td>
                <td><label for="nombre_chofer"></label>
                    <input type="text" name="nombre_chofer" id="nombre_chofer" value="<?php echo $nombre_chofer ?>">
                </td>
            </tr>
            <tr>
                <td>Direccion</td>
                <td><label for="dir_chofer"></label>
                    <input type="text" name="dir_chofer" id="dir_chofer" value="<?php echo $dir_chofer ?>">
                </td>
            </tr>
            <tr>
                <td>CP</td>
                <td><label for="cp_chofer"></label>
                    <input type="text" name="cp_chofer" id="cp_chofer" value="<?php echo $cp_chofer ?>">
                </td>
            </tr>
            <tr>
                <td>Celular</td>
                <td><label for="cel_chofer"></label>
                    <input type="text" name="cel_chofer" id="cel_chofer" value="<?php echo $cel_chofer ?>">
                </td>
            </tr>
            <tr>
                <td>DNI</td>
                <td><label for="dni_chofer"></label>
                    <input type="text" name="dni_chofer" id="dni_chofer" value="<?php echo $dni_chofer ?>">
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td><label for="email_chofer"></label>
                    <input type="text" name="email_chofer" id="email_chofer" value="<?php echo $email_chofer ?>">
                </td>
            </tr>
        </table>
        <table width="35%" border="0" align="center">
            <tr>
                <td>Nombre Chofer noche</td>
                <td><label for="nombre_chofer_2"></label>
                    <input type="text" name="nombre_chofer_2" id="nombre_chofer_2" value="<?php echo $nombre_chofer_2 ?>">
                </td>
            </tr>
            <tr>
                <td>Direccion</td>
                <td><label for="dir_chofer_2"></label>
                    <input type="text" name="dir_chofer_2" id="dir_chofer_2" value="<?php echo $dir_chofer_2 ?>">
                </td>
            </tr>
            <tr>
                <td>CP</td>
                <td><label for="cp_chofer_2"></label>
                    <input type="text" name="cp_chofer_2" id="cp_chofer_2" value="<?php echo $cp_chofer_2 ?>">
                </td>
            </tr>
            <tr>
                <td>Celular</td>
                <td><label for="cel_chofer_2"></label>
                    <input type="text" name="cel_chofer_2" id="cel_chofer_2" value="<?php echo $cel_chofer_2 ?>">
                </td>
            </tr>
            <tr>
                <td>DNI</td>
                <td><label for="dni_chofer_2"></label>
                    <input type="text" name="dni_chofer_2" id="dni_chofer_2" value="<?php echo $dni_chofer_2 ?>">
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td><label for="email_chofer_2"></label>
                    <input type="text" name="email_chofer_2" id="email_chofer_2" value="<?php echo $email_chofer_2 ?>">
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