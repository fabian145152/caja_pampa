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
        $marca_unidad = $_GET["marca_unidad"];
        $modelo_unidad = $_GET["modelo_unidad"];
        $year_unidad = $_GET['year_unidad'];
        $dominio_unidad = $_GET["dominio_unidad"];
        $categoria_unidad = $_GET['categoria_unidad'];
        $abono_unidad = $_GET['abono_unidad'];
    } else {

        $id = $_POST["id"];
        $marca_unidad = $_POST["marca_unidad"];
        $modelo_unidad = $_POST["modelo_unidad"];
        $year_unidad = $_POST['year_unidad'];
        $dominio_unidad = $_POST["dominio_unidad"];
        $categoria_unidad = $_POST['categoria_unidad'];
        $abono_unidad = $_POST['abono_unidad'];




        $sql = "UPDATE unidades SET marca_unidad=:miMarca_unidad, 
                                    modelo_unidad=:miModelo_unidad,
                                    year_unidad=:miYear_unidad, 
                                    dominio_unidad=:miDominio_unidad,
                                    categoria_unidad=:miCategoria_unidad,
                                    abono_unidad=:miAbono_unidad 
                                    WHERE id=:miId";

        $resultado = $base->prepare($sql);

        $resultado->execute(array(
            ":miId" => $id,
            ":miMarca_unidad" => $marca_unidad,
            ":miModelo_unidad" => $modelo_unidad,
            ":miYear_unidad" => $year_unidad,
            ":miDominio_unidad" => $dominio_unidad,
            ":miCategoria_unidad" => $categoria_unidad,
            ":miAbono_unidad" => $abono_unidad
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
                <td>Abono </td>
                <td><label for="abono_unidad"></label>
                    <input type="text" name="abono_unidad" id="abono_unidad" value="<?php echo $abono_unidad ?>">
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