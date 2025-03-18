<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utl8mb4");


echo "ID: " . $id = $_POST['id'];
echo "<br>";
echo "Movil: " . $movil = $_POST['movil'];
echo "<br>";
echo "Nombre: " . $nombre = $_POST['nombre'];
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "Abono semana: " . $abono_semana = $_POST['abono_semana'];   //UPDatarlo en completa
echo "<br>";
echo "Abono viaje: " . $abono_viaje = $_POST['abono_viaje'];      //UPDatarlo en completa
echo "<br>";
echo $fecha_fact = $_POST['inicio_fact'];

//exit();

$sql_sem = "SELECT * FROM abono_semanal WHERE id = '$abono_semana'";
$sql_result = $con->query($sql_sem);
$row_sem = $sql_result->fetch_assoc();
echo "<br>";

$sql_paga_x_semana = "SELECT * FROM semanas WHERE movil= '$movil'";
$sql_seman = $con->query($sql_paga_x_semana);
$abono_semanal = $sql_seman->fetch_assoc();
echo "<br>";
echo "Debe en total: " . $abono_semanal['total'];
echo "<br>";
echo "Paga x semana: " . $x_semana = $abono_semanal['x_semana'];

//exit();

if ($movil == NULL || $abono_semana == NULL || $abono_viaje == NULL || $fecha_fact == NULL) {

?>
    <script>
        function redirectWithConfirmation() {
            // Variable to send
            var variableValue = '$id'; // Reemplaza con el valor de tu variable

            // Mostrar cuadro de confirmación
            var userConfirmed = window.confirm("FALTA SEMANAS o VIAJES o FECHAS",

            );


            // Si el usuario confirma, redirigir con la variable
            if (userConfirmed) {
                window.location.href = "edit_uni_comp.php?movil=" + encodeURIComponent(variableValue);
            }
        }

        // Llamar a la función al cargar la página
        window.onload = redirectWithConfirmation;
    </script>
<?php
    exit();
}


//exit();
$sql = "UPDATE completa SET fecha_facturacion = '$fecha_fact',
                            x_semana = '$abono_semana', 
                            x_viaje = '$abono_viaje'
                            WHERE id =" . $id;

$stmt_comp = $con->prepare($sql);
$stmt_comp->bind_param("dii", $fecha_fact, $abono_semana, $abono_viaje);
$stmt_comp->execute();


$sql_imp_semana = "SELECT * FROM abono_semanal WHERE id=" . $abono_semana;
$imp_semana = $con->query($sql_imp_semana);
$row_cuanto = $imp_semana->fetch_assoc();
echo "Cuanto: " . $cuanto = $row_cuanto['importe'];
echo "<br>";
echo "Abono semanal de abono_semanal: " . $row_cuanto['id'];



## antes de esto leer abono semanal para tener el importe nuevo
$actua_semana = "UPDATE semanas SET x_semana = $cuanto";
$stmt_sem = $con->prepare($actua_semana);
$stmt_sem->bind_param("i", $cuanto);
$stmt_sem->execute();




//exit();

header("Location: inicio_arma.php");
