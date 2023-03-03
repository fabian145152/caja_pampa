<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>
    <a href="inicio.php">Volver</a>
    <?php

    include("../includes/conexion.php");





    if (!isset($_POST["bot_actualizar"])) {
        $fecha_ini = $_GET['fecha_ini'];
        $id = $_GET['id'];
        $tropa = $_GET['tropa'];
        $movil = $_GET['movil'];
        $nombre_titular = $_GET['nombre_titular'];
        $dir_titular = $_GET['dir_titular'];
        $cp_titular = $_GET['cp_titular'];
        $cel_titular = $_GET['cel_titular'];
        $dni_titular = $_GET['dni_titular'];
        $email_titular = $_GET['email_titular'];
        $nombre_chofer = $_GET['nombre_chofer'];
        $dir_chofer = $_GET['dir_chofer'];
        $cp_chofer = $_GET['cp_chofer'];
        $cel_chofer = $_GET['cel_chofer'];
        $dni_chofer = $_GET['dni_chofer'];
        $email_chofer = $_GET['email_chofer'];
        $nombre_chofer_2 = $_GET['nombre_chofer_2'];
        $dir_chofer_2 = $_GET['dir_chofer_2'];
        $cp_chofer_2 = $_GET['cp_chofer_2'];
        $cel_chofer_2 = $_GET['cel_chofer_2'];
        $dni_chofer_2 = $_GET['dni_chofer_2'];
        $email_chofer_2 = $_GET['email_chofer_2'];
        $marca_unidad = $_GET['marca_unidad'];
        $modelo_unidad = $_GET['modelo_unidad'];
        $year_unidad = $_GET['year_unidad'];
        $dominio_unidad = $_GET['dominio_unidad'];
        $categoria_unidad = $_GET['categoria_unidad'];
        $abono_unidad = $_GET['abono_unidad'];
    } else {

        $id = $_POST['id'];
        $fecha_ini = $_POST['fecha_ini'];
        $tropa = $_POST['tropa'];
        $movil = $_POST['movil'];
        $nombre_titular = $_POST['nombre_titular'];
        $dir_titular = $_POST['dir_titular'];
        $cp_titular = $_POST['cp_titular'];
        $cel_titular = $_POST['cel_titular'];
        $dni_titular = $_POST['dni_titular'];
        $email_titular = $_POST['email_titular'];
        $nombre_chofer = $_POST['nombre_chofer'];
        $dir_chofer = $_POST['dir_chofer'];
        $cp_chofer = $_POST['cp_chofer'];
        $cel_chofer = $_POST['cel_chofer'];
        $dni_chofer = $_POST['dni_chofer'];
        $email_chofer = $_POST['email_chofer'];
        $nombre_chofer_2 = $_POST['nombre_chofer_2'];
        $dir_chofer_2 = $_POST['dir_chofer_2'];
        $cp_chofer_2 = $_POST['cp_chofer_2'];
        $cel_chofer_2 = $_POST['cel_chofer_2'];
        $dni_chofer_2 = $_POST['dni_chofer_2'];
        $email_chofer_2 = $_POST['email_chofer_2'];
        $marca_unidad = $_POST['marca_unidad'];
        $modelo_unidad = $_POST['modelo_unidad'];
        $year_unidad = $_POST['year_unidad'];
        $dominio_unidad = $_POST['dominio_unidad'];
        $categoria_unidad = $_POST['categoria_unidad'];
        $abono_unidad = $_POST['abono_unidad'];




        $sql = "UPDATE unidades SET fecha_ini=:miFecha_ini,
                                    tropa=:miTropa,
                                    movil=:miMovil,
                                    nombre_titular=:miNombre_titular, 
                                    dir_titular=:miDir_titular,
                                    cp_titular=:miCp_titular, 
                                    cel_titular=:miCel_titular,
                                    dni_titular=:miDni_titular,
                                    email_titular=:miEmail_titular, 
                                    nombre_chofer=:miNombre_chofer, 
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
                                    email_chofer_2=:miEmail_chofer_2,
                                    marca_unidad=:miMarca_unidad,
                                    modelo_unidad=:miModelo_unidad,
                                    year_unidad=:miYear_unidad,
                                    categoria_unidad=:miCategoria_unidad,
                                    abono_unidad=:miAbono_unidad
                                    WHERE id=:miId";

        $resultado = $base->prepare($sql);

        $resultado->execute(array(
            ":miFecha_ini" => $fecha_ini,
            ":miTropa" => $tropa,
            ":miId" => $id,
            ":miMovil" => $movil,
            ":miNombre_titular" => $nombre_titular,
            ":miDir_titular" => $dir_titular,
            ":miCp_titular" => $cp_titular,
            ":miCel_titular" => $cel_titular,
            ":miDni_titular" => $dni_titular,
            ":miEmail_titular" => $email_titular,
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
            ":miEmail_chofer_2" => $email_chofer_2,
            ":miMarca_unidad" => $marca_unidad,
            ":miModelo_unidad" => $modelo_unidad,
            ":miYear_unidad" => $year_unidad,
            ":miCategoria_unidad" => $categoria_unidad,
            ":miAbono_unidad" => $abono_unidad,
        ));

        header("location:inicio.php?");
    }
    ?>

    <p>
        <?php echo "Unidad: " . $movil; ?>
    </p>
    <p>&nbsp;</p>
    <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">



        <table width="35%" border="1" align="center">
            <tr>
                <td></td>
                <td><label for="id"></label>
                    <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
                </td>
            </tr>
            <tr>
                <td>Tropa</td>
                <td><label for="tropa"></label>

                    <select name="tropa" id="tropa">
                        <option value="elija"><?php echo $tropa ?></option>
                        <option value="titular">titular</option>
                        <option value="tropa">Tropa</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Movil</td>
                <td><label for="movil"></label>
                    <input type="text" name="movil" id="movil" value="<?php echo $movil ?>">
                </td>
            </tr>
            <tr>
                <td>Fecha inicio</td>
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

        </table>


        <table width="35%" border="1" align="center">
            <tr>
                <td>Nombre Chofer</td>
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

        <table width="35%" border="1" align="center">

            <tr>

                <td>Nombre Chofer Noche</td>
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
        </table>
        <table width="35%" border="1" align="center">
            <tr>
                <td>Marca</td>
                <td><label for="marca_unidad"></label>
                    <input type="text" name="marca_unidad" id="marca_unidad" value="<?php echo $marca_unidad ?>">
                </td>
            </tr>
            <tr>
                <td>Modelo</td>
                <td><label for="modelo_unidad"></label>
                    <input type="text" name="modelo_unidad" id="modelo_unidad" value="<?php echo $modelo_unidad ?>">
                </td>
            </tr>
            <tr>
                <td>Año</td>
                <td><label for="year_unidad"></label>
                    <input type="text" name="year_unidad" id="year_unidad" value="<?php echo $year_unidad ?>">
                </td>
            </tr>
            <tr>
                <td>Dominio</td>
                <td><label for="dominio_unidad"></label>
                    <input type="text" name="dominio_unidad" id="dominio_unidad" value="<?php echo $dominio_unidad ?>">
                </td>
            </tr>
            <tr>
                <td>Categoria</td>
                <td><label for="categoria_unidad"></label>
                    <input type="text" name="categoria_unidad" id="categoria_unidad" value="<?php echo $categoria_unidad ?>">
                </td>
            </tr>
            <tr>
                <td>Abono</td>
                <td><label for="abono_unidad"></label>
                    <input type="text" name="abono_unidad" id="abono_unidad" value="<?php echo $abono_unidad ?>">
                </td>
            </tr>
        </table>
        <tr>
            <td colspan="2"><input type="submit" name="bot_actualizar" id="bot_actualizar" value="Actualizar"></td>
        </tr>
    </form>
    <p>&nbsp;</p>


</body>

</html>