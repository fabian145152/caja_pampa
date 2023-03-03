<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Unidad</title>
    <link rel="styleshet" href="../css/detalles.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: yellow;
        }

        .primera_fila {
            background-color: greenyellow;
        }
    </style>
</head>

<body>
    <h1>Crear Titulares unidades y moviles</h1>
    <?php



    include("../includes/conexion.php");


    $tamagno_pagina = 100;    //cantidad de registros por pagina

    //--------------Sigue aca desde abajo de todo--------------
    if (isset($_GET["pagina"])) {
        //con el isset que se ejecute una vez pulsado el promernumero, porque si no ma da que la variable pagina no esta definida.
        if ($_GET["pagina"] == 1) {

            header("Location:index.php");
        } else {

            $pagina = $_GET["pagina"];
        }
    } else {
        $pagina = 1;
    }
    //---------------------------------------------------------

    $empezar_desde = ($pagina - 1) * $tamagno_pagina;
    //si pulso el 3 pagina =3 con el metodo get, 3-1=2 y 2*3 =6
    //guardo en la variable el numero 6 para que lo sustituya en el limit
    //limit 6, 3 

    $sql_total = "SELECT * FROM unidades";
    /*
Para paginar agrego LIMIT, 2 parametros primer registro y cantidad de registros.
Lo primero que necesito es saber cuantos registros tiene la tabla
y en cuantas paginas lo va a dividir.
Creo variable $tamagno_pagina


*/
    $resultado = $base->prepare($sql_total);
    $resultado->execute(array());
    $num_filas = $resultado->rowCount();    //cuenta la cantidad de filas
    $total_paginas = ceil($num_filas / $tamagno_pagina);  //me dice la cantidad de paginas que voy a tener
    //el ceil me da un numero entero

    //--------------------Fin Paginacion-----------------


    $registros = $base->query("SELECT id, 
                        date_format(fecha_ini, '%d-%m-%Y') AS fecha_ini,
                        tropa,
                        movil,
                        nombre_titular,
                        dir_titular,
                        cp_titular,
                        dir_titular,
                        cel_titular,
                        dni_titular,
                        email_titular,
                        nombre_chofer,
                        dir_chofer,
                        cp_chofer,
                        dir_chofer,
                        cel_chofer,
                        dni_chofer,
                        email_chofer,
                        nombre_chofer_2,
                        dir_chofer_2,
                        cp_chofer_2,
                        dir_chofer_2,
                        cel_chofer_2,
                        dni_chofer_2,
                        email_chofer_2,
                        marca_unidad,
                        modelo_unidad,
                        year_unidad,
                        dominio_unidad,
                        categoria_unidad,
                        abono_unidad


                                 FROM unidades ORDER BY movil ASC LIMIT $empezar_desde,$tamagno_pagina")->fetchAll(PDO::FETCH_OBJ);

    // parte del insert
    if (isset($_POST["cr"])) {
        $fecha_ini = $_POST['fecha_ini'];
        $tropa = $_POST['tropa'];
        $movil = $_POST["Movil"];
        $nombre_titular = $_POST["Nombre_titular"];
        $dir_titular = $_POST["Dir_titular"];
        $cp_titular = $_POST["Cp_titular"];
        $cel_titular = $_POST["Cel_titular"];
        $dni_titular = $_POST["Dni_titular"];
        $email_titular = $_POST["Email_titular"];
        $nombre_chofer = $_POST["Nombre_chofer"];
        $dir_chofer = $_POST["Dir_chofer"];
        $cp_chofer = $_POST["Cp_chofer"];
        $cel_chofer = $_POST["Cel_chofer"];
        $dni_chofer = $_POST["Dni_chofer"];
        $email_chofer = $_POST['Email_chofer'];
        $nombre_chofer_2 = $_POST['nombre_chofer_2'];
        $marca_unidad = $_POST['Marca_unidad'];
        $modelo_unidad = $_POST['Modelo_unidad'];
        $year_unidad = $_POST['Year_unidad'];
        $dominio_unidad = $_POST['Dominio_unidad'];
        $categoria_unidad = $_POST['Categoria_unidad'];
        $abono_unidad = $_POST['Abono_unidad'];

        //El id no hace falta porque es autonumerico




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
                                        nombre_chofer_2,
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
                                    :nombre_chofer_2,
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
            ":nombre_chofer_2" => $nombre_chofer_2,
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



    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table class="table table-sm" id="table_2">
            <!-- <table width="50%" border="0" align="center" > -->
            <a href="nuevo.php">Nuevo</a>

            <tr>
                <td class="primera_fila">Id</td>
                <td class="primera_fila">Fecha ini</td>
                <td class="primera_fila">Tropa</td>
                <td class="primera_fila">Movil</td>
                <td class="primera_fila">Nombre Titular</td>
                <td class="primera_fila">Direccion</td>
                <td class="primera_fila">CP</td>
                <td class="primera_fila">Celular</td>
                <td class="primera_fila">DNI</td>
                <td class="primera_fila">email</td>
                <td class="primera_fila">Nombre Chofer Dia</td>
                <td class="primera_fila">Direccion</td>
                <td class="primera_fila">CP</td>
                <td class="primera_fila">Celular</td>
                <td class="primera_fila">DNI</td>
                <td class="primera_fila">email</td>
                <td class="primera_fila">nombre_chofer Noche</td>
                <td class="primera_fila">Direccion</td>
                <td class="primera_fila">CP</td>
                <td class="primera_fila">Celular</td>
                <td class="primera_fila">DNI</td>
                <td class="primera_fila">email</td>
                <td class="primera_fila">Marca</td>
                <td class="primera_fila">Modelo</td>
                <td class="primera_fila">Año</td>
                <td class="primera_fila">Dominio</td>
                <td class="primera_fila">categoria</td>
                <td class="primera_fila">Abono</td>
            </tr>


            <!-- Esta parte es para que las lineas se repitan -->
            <?php
            //--------------------------------------------------------------------------
            // Esta parte es del READ
            foreach ($registros as $persona) :
                /*
            Este es el array donde tengo almacenados todos los objetos de mi BBDD
            $persona es una variable cualquiera
            */
                //-----------------------------------------------------------------------

            ?>

                <tr>
                    <td><?php echo $persona->id ?> </td>
                    <td><?php echo $persona->fecha_ini ?></td>
                    <td><?php echo $persona->tropa ?></td>
                    <td><?php echo $persona->movil ?></td>
                    <td><?php echo $persona->nombre_titular ?></td>
                    <td><?php echo $persona->dir_titular ?></td>
                    <td><?php echo $persona->cp_titular ?></td>
                    <td><?php echo $persona->cel_titular ?></td>
                    <td><?php echo $persona->dni_titular ?></td>
                    <td><?php echo $persona->email_titular ?></td>
                    <td><?php echo $persona->nombre_chofer ?></td>
                    <td><?php echo $persona->dir_chofer ?></td>
                    <td><?php echo $persona->cp_chofer ?></td>
                    <td><?php echo $persona->cel_chofer ?></td>
                    <td><?php echo $persona->dni_chofer ?></td>
                    <td><?php echo $persona->email_chofer ?></td>
                    <td><?php echo $persona->nombre_chofer_2 ?></td>
                    <td><?php echo $persona->dir_chofer_2 ?></td>
                    <td><?php echo $persona->cp_chofer_2 ?></td>
                    <td><?php echo $persona->cel_chofer_2 ?></td>
                    <td><?php echo $persona->dni_chofer_2 ?></td>
                    <td><?php echo $persona->email_chofer_2 ?></td>
                    <td><?php echo $persona->marca_unidad ?></td>
                    <td><?php echo $persona->modelo_unidad ?></td>
                    <td><?php echo $persona->year_unidad ?></td>
                    <td><?php echo $persona->dominio_unidad ?></td>
                    <td><?php echo $persona->categoria_unidad ?></td>
                    <td><?php echo $persona->abono_unidad ?></td>




                    <td class="bot"><a href="borrar.php?id=<?php echo $persona->id ?>"><input type='button' name='del' id='del' value='Borrar' class="button_1"></a></td>
                    <!-- ------------------------------ -->
                    <!-- Estas lineas son de la edicion -->

                    <td class='bot'><a href="editar.php?id=<?php echo $persona->id ?> 
                                                       & fecha_ini=<?php echo $persona->fecha_ini ?>
                                                       & tropa=<?php echo $persona->tropa ?>
                                                       & movil=<?php echo $persona->movil ?> 
                                                       & nombre_titular=<?php echo $persona->nombre_titular ?> 
                                                       & dir_titular=<?php echo $persona->dir_titular ?>
                                                       & cp_titular=<?php echo $persona->cp_titular ?>
                                                       & cel_titular=<?php echo $persona->cel_titular ?>
                                                       & dni_titular=<?php echo $persona->dni_titular ?>
                                                       & email_titular=<?php echo $persona->email_titular ?> 
                                                       & nombre_chofer=<?php echo $persona->nombre_chofer ?>
                                                       & dir_chofer=<?php echo $persona->dir_chofer ?> 
                                                       & cp_chofer=<?php echo $persona->cp_chofer ?>
                                                       & cel_chofer=<?php echo $persona->cel_chofer ?>
                                                       & dni_chofer=<?php echo $persona->dni_chofer ?> 
                                                       & email_chofer=<?php echo $persona->email_chofer ?>
                                                       & nombre_chofer_2=<?php echo $persona->nombre_chofer_2 ?>
                                                       & dir_chofer_2=<?php echo $persona->dir_chofer_2 ?> 
                                                       & cp_chofer_2=<?php echo $persona->cp_chofer_2 ?>
                                                       & cel_chofer_2=<?php echo $persona->cel_chofer_2 ?>
                                                       & dni_chofer_2=<?php echo $persona->dni_chofer_2 ?> 
                                                       & email_chofer_2=<?php echo $persona->email_chofer_2 ?>
                                                       & marca_unidad=<?php echo $persona->marca_unidad ?>
                                                       & modelo_unidad=<?php echo $persona->modelo_unidad ?>
                                                       & year_unidad=<?php echo $persona->year_unidad ?>
                                                       & dominio_unidad=<?php echo $persona->dominio_unidad ?>
                                                       & categoria_unidad=<?php echo $persona->categoria_unidad ?>
                                                       & abono_unidad=<?php echo $persona->abono_unidad ?>
                                                       ">


                            <input type='button' name='up' id='up' value='Actualizar' class="button_2"></a></td>
                    <!-- ------------------------------ -->
                </tr>
            <?php
            // READ-------------------------------------------------------------------------------------
            endforeach;
            //Otra forma de hacerlo es concatenando todo para que quede php dentro de cada linea de html
            //------------------------------------------------------------------------------------------

            ?>


            <tr>
                <td></td>
                <td><input type="text" name="fecha_ini" size="6" class="centrado" require disabled></td>
                <td><input type="text" name="Tropa" size="4" class="centrado" require disabled></td>
                <td><input type='text' name='Movil' size='3' class='centrado' required disabled></td>
                <td><input type='text' name='Nombre_titular' size='20' class='centrado' required disabled></td>
                <td><input type='text' name='Dir_titular' size='20' class='centrado' required disabled></td>
                <td><input type='text' name='Cp_titular' size='3' class='centrado' required disabled></td>
                <td><input type='text' name='Cel_titular' size='8' class='centrado' required disabled></td>
                <td><input type='text' name='Dni_titular' size='8' class='centrado' disabled></td>
                <td><input type='text' name='Email_titular' size='25' class='centrado' disabled></td>

                <td><input type='text' name='Nombre_chofer' size='20' class='centrado' disabled></td>
                <td><input type='text' name='Dir_chofer' size='20' class='centrado' disabled></td>
                <td><input type='text' name='Cp_chofer' size='3' class='centrado' disabled></td>
                <td><input type='text' name='Cel_chofer' size='8' class='centrado' disabled></td>
                <td><input type='text' name='Dni_chofer' size='5' class='centrado' disabled></td>
                <td><input type='text' name='Email_chofer' size='25' class='centrado' required disabled></td>

                <td><input type='text' name='Nombre_chofer_2' size='20' class='centrado' disabled></td>
                <td><input type='text' name='Dir_chofer_2' size='20' class='centrado' disabled></td>
                <td><input type='text' name='Cp_chofer_2' size='3' class='centrado' disabled></td>
                <td><input type='text' name='Cel_chofer_2' size='8' class='centrado' disabled></td>
                <td><input type='text' name='Dni_chofer_2' size='5' class='centrado' disabled></td>
                <td><input type='text' name='Email_chofer_2' size='25' class='centrado' required disabled></td>

                <td><input type='text' name='Marca_unidad' size='10' class='centrado' required disabled></td>
                <td><input type='text' name='Modelo_unidad' size='10' class='centrado' required disabled></td>
                <td><input type='text' name='Year_unidad' size='3' class='centrado' disabled></td>
                <td><input type='text' name='Dominio_unidad' size='7' class='centrado' disabled></td>
                <td><input type='text' name='Categoria_unidad' size='5' class='centrado' disabled></td>
                <td><input type='text' name='Abono_unidad' size='5' class='centrado' disabled></td>


                <!-- <td class='bot'><input type='submit' name='cr' id='cr' value='Insertar' class="button_1"></td> -->

            </tr>

            <td>

                <?php

                // --------------------------------------------------------
                //aca empieza la parte de abajo con los numeros y saltos de pagina
                echo "<br>";
                for ($i = 1; $i <= $total_paginas; $i++) {

                    echo "<a href='?pagina=" . $i . "'>" . $i . "</a> ";
                    //$i tiene que ser un link y lo paso por la url


                }


                ?>

            </td>
            </tr>
            </tr>
        </table>
    </form>

    <a href="../index.php">Salir</a>

    <p>&nbsp;</p>
</body>

</html>