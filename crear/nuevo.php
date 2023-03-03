<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php

    include("../includes/conexion.php");

    if (!isset($_POST['bot_nuevo'])) {
        echo "Hola";
        echo "<br>";
    } else {
        $tropa = $_POST['tropa'];
        $fecha_ini = $_POST['fecha_ini'];
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
        $marca_unidad = $_POST['marca_unidad'];
        $modelo_unidad = $_POST['modelo_unidad'];
        $year_unidad = $_POST['year_unidad'];
        $dominio_unidad = $_POST['dominio_unidad'];
        $categoria_unidad = $_POST['categoria_unidad'];
        $abono_unidad = $_POST['abono_unidad'];


        $sql = "INSERT INTO unidades (fecha_ini,
                                        tropa, 
                                        movil, 
                                        nombre_titular, 
                                        dir_titular, 
                                        cp_titular, 
                                        cel_titular, 
                                        dni_titular, 
                                        email_titular, 
                                        nombre_chofer, 
                                        dir_chofer, 
                                        cp_chofer, 
                                        cel_chofer, 
                                        dni_chofer,
                                        email_chofer,
                                        marca_unidad,
                                        modelo_unidad,
                                        year_unidad,
                                        dominio_unidad,
                                        categoria_unidad,
                                        abono_unidad) 
                             VALUES (:fecha_ini,
                                    :tropa,
                                    :movil,
                                    :nombre_titular, 
                                    :dir_titular, 
                                    :cp_titular, 
                                    :cel_titular, 
                                    :dni_titular, 
                                    :email_titular, 
                                    :nombre_chofer, 
                                    :dir_chofer,
                                    :cp_chofer, 
                                    :cel_chofer, 
                                    :dni_chofer, 
                                    :email_chofer, 
                                    :marca_unidad,
                                    :modelo_unidad,
                                    :year_unidad,
                                    :dominio_unidad,
                                    :categoria_unidad,
                                    :abono_unidad)";

        $resultado = $base->prepare($sql);

        $resultado->execute(array(
            ":fecha_ini" => $fecha_ini,
            ":tropa" => $tropa,
            ":movil" => $movil,
            ":nombre_titular" => $nombre_titular,
            ":dir_titular" => $dir_titular,
            ":cp_titular" => $cp_titular,
            ":cel_titular" => $cel_titular,
            ":dni_titular" => $dni_titular,
            ":email_titular" => $email_titular,
            ":nombre_chofer" => $nombre_chofer,
            ":dir_chofer" => $dir_chofer,
            ":cp_chofer" => $cp_chofer,
            ":cel_chofer" => $cel_chofer,
            ":dni_chofer" => $dni_chofer,
            ":email_chofer" => $email_chofer,
            ":marca_unidad" => $marca_unidad,
            ":modelo_unidad" => $modelo_unidad,
            ":year_unidad" => $year_unidad,
            ":dominio_unidad" => $dominio_unidad,
            ":categoria_unidad" => $categoria_unidad,
            ":abono_unidad" => $abono_unidad
        ));
        header("location:inicio.php");
    }

    ?>
    <a href="inicio.php">Salir</a>
    <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <table width="65%" border="0" align="center" class="">
            <td>
                <tr>
                    <td><label for="movil">Movil</label>
                    <td><label for="movil"></label>
                        <input type="text" name="movil" id="movil">
                    </td>
                </tr>
                <tr>
                    <td><label for="fecha_ini">Fecha de inicio</label>
                    <td><label for="fecha_ini"></label>
                        <input type="text" name="fecha_ini" id="fecha_ini">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="radio" id="tropa" name="tropa" value="tropa" require>
                        <label for="tropa">TROPA</label><br>
                        <input type="radio" id="tropa" name="tropa" value="titular" require>
                        <label for="tropa">TITULAR</label><br>
                    </td>
                </tr>
                <tr>
                    <td><label for="nombre_titular">Nombre del Titular / Tropa</label>
                    <td><label for="nombre_titular"></label>
                        <input type="" name="nombre_titular" id="nombre_titular">
                        <!-- si le agrego en el input un value="cualquier cosa"
                            y abajo un <input type="reset"> me aparece un botor de reestablecer y me borra todos los campos  -->
                    </td>
                </tr>
                <tr>
                    <td><label for="dir_titular">Direccion</label>
                    <td><label for="dir_titular"></label>
                        <input type="text" name="dir_titular" id="dir_titular">
                    </td>
                </tr>
                <tr>
                    <td><label for="cp_titular">Cp</label>
                    <td><label for="cp_titular"></label>
                        <input type="text" name="cp_titular" id="cp_titular">
                    </td>
                </tr>
                <tr>
                    <td><label for="cel_titular">Celular</label>
                    <td><label for="cel_titular"></label>
                        <input type="text" name="cel_titular" id="cel_titular">
                    </td>
                </tr>
                <tr>
                    <td><label for="dni_titular">DNI</label>
                    <td><label for="dni_titular"></label>
                        <input type="text" name="dni_titular" id="dni_titular">
                    </td>
                </tr>
                <tr>
                    <td><label for="email_titular">E-mail</label>
                    <td><label for="email_titular"></label>
                        <input type="email" name="email_titular" id="email_titular">
                    </td>
                </tr>
                <br>
                <tr>
                    <td><label for="nombre_chofer">Nombre del Chofer</label>
                    <td><label for="nombre_chofer"></label>
                        <input type="text" name="nombre_chofer" id="nombre_chofer">
                    </td>
                </tr>
                <tr>
                    <td><label for="dir_chofer">Direccion</label>
                    <td><label for="dir_chofer"></label>
                        <input type="text" name="dir_chofer" id="dir_chofer">
                    </td>
                </tr>
                <tr>
                    <td><label for="cp_chofer">Cp</label>
                    <td><label for="cp_chofer"></label>
                        <input type="text" name="cp_chofer" id="cp_chofer">
                    </td>
                </tr>
                <tr>
                    <td><label for="cel_chofer">Celular</label>
                    <td><label for="cel_chofer"></label>
                        <input type="text" name="cel_chofer" id="cel_chofer">
                    </td>
                </tr>
                <tr>
                    <td><label for="dni_chofer">DNI</label>
                    <td><label for="dni_chofer"></label>
                        <input type="text" name="dni_chofer" id="dni_chofer">
                    </td>
                </tr>
                <tr>
                    <td><label for="email_chofer">E-mail</label>
                    <td><label for="email_chofer"></label>
                        <input type="email" name="email_chofer" id="email_chofer">
                    </td>
                </tr>
                <tr>
                    <td><label for="marca_unidad">Marca Unidad</label>
                    <td><label for="marca_unidad"></label>
                        <input type="text" name="marca_unidad" id="marca_unidad">
                    </td>
                </tr>
                <tr>
                    <td><label for="modelo_unidad">Modelo</label>
                    <td><label for="modelo_unidad"></label>
                        <input type="text" name="modelo_unidad" id="modelo_unidad">
                    </td>
                </tr>
                <tr>
                    <td><label for="year_unidad">Año</label>
                    <td><label for="year_unidad"></label>
                        <input type="text" name="year_unidad" id="year_unidad">
                    </td>
                </tr>
                <tr>
                    <td><label for="dominio_unidad">Dominio</label>
                    <td><label for="dominio_unidad"></label>
                        <input type="text" name="dominio_unidad" id="dominio_unidad">
                    </td>
                </tr>
                <tr>
                    <td><label for="categoria_unidad">Categoria</label>
                    <td><label for="categoria_unidad"></label>
                        <select name="categoria_unidad" id="categoria_unidad">
                            <option value="">Elija</option>
                            <option value="porteño">Porteño</option>
                            <option value="bsas">Buenos Aires</option>
                            <option value="pampa">Pampa</option>
                            <option value="baet">Baet</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="abono_unidad">Abono</label>
                    <td><label for="abono_unidad"></label>
                        <input type="text" name="abono_unidad" id="abono_unidad">
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" name="bot_nuevo" id="bot_nuevo" value="Crear"></td>
                </tr>
            </td>
</body>

</html>