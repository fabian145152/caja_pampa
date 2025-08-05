<?php

//session_start();
include_once "../../../funciones/funciones.php";



$con = conexion();
$con->set_charset("utf8mb4");

$archivo = "semana.txt";




$semana_actual = date('W');

$fecha = date("Y-m-d");




// Verificar si el archivo existe
if (file_exists($archivo)) {
    // Si el archivo existe, leer el contenido para obtener la última semana registrada
    echo "Semana leida del archivo: " . $semana_anterior = file_get_contents($archivo);
    echo "<br>";

    //exit;




    // Verificar si la semana actual es diferente a la semana anterior
    if ($semana_actual != $semana_anterior) {
        // Si la semana ha cambiado, incrementar la variable
        $variable = 1; // Puedes cambiar este valor según tus necesidades
        // Nombre del archivo donde se guarda la semana
        // Guardar la semana actual en el archivo para futuras comparaciones

        //procesarCobroSemanas($con, $movil);



        file_put_contents($archivo, $semana_actual);
        // Mostrar un mensaje o realizar cualquier otra acción cuando cambia la semana
        echo "¡La semana se ha incrementado!... " . $variable;

        $sql_3 = "SELECT * FROM semanas WHERE 1";
        $listarla = $con->query($sql_3);
        while ($verla = $listarla->fetch_assoc()) {
            $movil = $verla['movil'];
            $x_semana = $verla['x_semana'];
            $total = $verla['total'];

            $suma = $x_semana + $total;
            $fecha = date("Y-m-d");
            $inc_semana = "UPDATE semanas SET total = '$suma', fecha = '$fecha' WHERE movil = '$movil'";

            $con->query($inc_semana);
        }
    } else {

        $variable = file_get_contents("semana.txt");

        //echo "Variable actual: " . $variable;
    }
}


    


//echo "Semana anterior:" . $semana_anterior;
//exit;
//header("Location: ../menu.php");
