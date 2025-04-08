<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

$deposito_en_pesos = 0;

$movil = $_POST['movil'];

$falta = 0;
$sobra = 0;

// CONSULTAS


// Lee la deuda anterior de la tabla completa
$sql_comple = "SELECT * FROM completa WHERE movil=" . $movil;
$con_co = $con->query($sql_comple);
$row_comp = $con_co->fetch_assoc();

$sql_caja_mov = "SELECT * FROM caja_movil WHERE movil =" . $movil;
$con_caja_m = $con->query($sql_caja_mov);
$row_caja_movil = $con_caja_m->fetch_assoc();

$sql_semana = "SELECT * FROM semanas WHERE movil =" . $movil;
$con_sem = $con->query($sql_semana);
$row_semanas = $con_sem->fetch_assoc();

$deuda_anterior = $row_comp['deuda_anterior'];

$deuda_ant = $_POST['deuda_ant'];

if (!isset($_POST['dep_ft']) === FALSE) {
    $deposito_en_pesos = $_POST['dep_ft'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php



    $total_de_viajes = $_POST['viajes'];
    $tot_voucher = $_POST['tot_voucher'];
    $para_el_movil = $_POST['para_movil'];
    $comisiones = $_POST['comi'];
    $productos_vendidos = $_POST['prod'];
    $debe_sem_ant = $_POST['debe_ant'];

    $debe_abonar = $_POST['debe_abonar'];

    $total_de_viajes = intval($total_de_viajes);
    $tot_voucher = intval($tot_voucher);
    $para_el_movil = intval($para_el_movil);
    $comisiones = intval($comisiones);
    $productos_vendidos = intval($productos_vendidos);
    $deuda_ant = intval($deuda_ant);
    $deposito_en_pesos = intval($deposito_en_pesos);

    $deu_total = $deuda_ant + $comisiones + $productos_vendidos + $debe_sem_ant;

    echo "<br>";
    echo "Movil:" . $movil;
    echo "<br>";
    echo $fecha = date('Y-m-d H:i:s');
    echo "<br>";
    echo "Comision a cobrarle: " . $comisiones;
    echo "<br>";
    echo "Deuda_anterior: " . $deuda_anterior;
    echo "<br>";
    echo "Debe de semanas anteriores: " . $debe_sem_ant;
    echo "<br>";
    echo "Productos que compro:" . $productos_vendidos;
    echo "<br>";
    echo "Calculo de deuda: " . $deu_total;
    echo "<br>";
    echo "Total en voucher: " . $tot_voucher;
    echo "<br>";
    echo "Deposito en pesos: " . $deposito_en_pesos;
    echo "<br>";
    echo "Depositarle al movil: " . $depositarle = $tot_voucher - $deu_total;
    echo "<br>";
    echo "Voucher en caja: " . $voucher_en_caja = $tot_voucher - $depositarle;
    echo "<br>";
    echo "FT en caja: " . $deposito_en_pesos;
    echo "<br>";

    echo "<br>";

    echo $row_caja_movil['comisiones'];
    echo "<br>";

    echo "Debe abonar: " . $debe_pagar = $debe_abonar * -1;
    echo "<br>";

    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";




    if ($debe_pagar > $deposito_en_pesos) {
        echo "Falta depositar: " . $falta = $deposito_en_pesos - $debe_pagar;
        echo "<br>"; ?>
        <script>
            var falta_depositar = "<?php echo "Falta depositar: " . "$" . $falta * -1 . "-" . " " . "Queda pendiente para la semana siguiente..." ?>"
            alert(falta_depositar);
        </script>
    <?php
    } else {
        echo "Sobran: " . $sobra = $deposito_en_pesos - $debe_pagar;
    ?>
        <script>
            var sobran = "<?php echo "Sobran: " . "$" . $sobra . "-" . " quedan a cuenta de la semana siguiente..." ?>"
            alert(sobran);
        </script>
    <?php
    }

    //exit;

    $stmt_caja_movil = $con->prepare("INSERT INTO caja_movil 
                                        (movil,    
                                        comisiones, 
                                        deuda_anterior,
                                        debe_sem_ant,
                                        prod_vendidos,
                                        calculo_deuda,
                                        deposito_voucher,
                                        dep_ft,
                                        para_el_movil,
                                        voucher_en_caja,
                                        ft_en_caja,
                                        fecha
                                        ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");

    if ($stmt_caja_movil === false) {
        die('Error al preparar la consulta: ' . $con->error);
    }

    $stmt_caja_movil->bind_param(
        "iiiiiiiiiiis",
        $movil,
        $comisiones,
        $deuda_anterior,
        $debe_sem_ant,
        $productos_vendidos,
        $deu_total,
        $tot_voucher,
        $deposito_en_pesos,
        $depositarle,
        $voucher_en_caja,
        $deposito_en_pesos,
        $fecha
    );

    if ($stmt_caja_movil->execute()) {
        echo "Nuevo registro creado exitosamente";
        echo "<br>";
    } else {
        echo "Error al ejecutar la consulta: " . $stmt->error;
        exit;
    }

    //Borra deuda anterior
    $sql_borra_deuda_ant = "UPDATE `completa` SET `deuda_anterior` = 0 WHERE movil =" . $movil;



    if ($con->query($sql_borra_deuda_ant) === TRUE) {
        echo "Deuda anterior editada correctamente";
        echo "<br>";
    } else {
        echo "Error deuda anterior...";
        exit();
    }
    $falta = $falta * -1;
    if ($falta >= 0) {

        //echo "Falta depositar: " . $falta;
        $sql_actualiza_deuda = "UPDATE completa SET deuda_anterior = '$falta', fe_pago = '$fecha' WHERE movil =" . $movil;;
        if ($con->query($sql_actualiza_deuda) === TRUE) {
            echo "Nueva deuda anterior cargada ";
            echo "<br>";
        } else {
            echo "Error deuda nueva...";
            exit();
        }
    } else {

        $sql_sobra_plata = "UPDATE caja_movil SET pesos_a_favor = '$sobra' WHERE movil =" . $movil;

        if ($con->query($sql_sobra_plata) === TRUE) {
            echo "Se guardo FT sobrante ";
            echo "<br>";
        } else {
            echo "Error de plata que le dobro...";
            exit;
        }
    }
    //exit;
    echo $row_semanas['total'];
    echo "<br>";
    if ($row_semanas['total'] > 0) {
        $sql_sem = "UPDATE semanas SET total = 0 WHERE movil =" . $movil;
        if ($con->query($sql_sem) === TRUE) {
            echo "Deuda de semanas anteriores borrada";
            echo "<br>";
        } else {
            echo "Error semanas...";
            exit();
        }
    }

    $venta_1 = $row_comp['venta_1'];
    $venta_2 = $row_comp['venta_2'];
    $venta_3 = $row_comp['venta_3'];
    $venta_4 = $row_comp['venta_4'];
    $venta_5 = $row_comp['venta_5'];


    if ($venta_1 > 0) {
        $sql_venta_1 = "UPDATE completa SET venta_1 = 0 WHERE movil=" . $movil;
        if ($con->query($sql_venta_1) === TRUE) {
            echo "Venta 1 borrada";
            echo "<br>";
        } else {
            echo "Error de borrado de venta_1";
            exit;
        }
    }
    if ($venta_2 > 0) {
        $sql_venta_2 = "UPDATE completa SET venta_2 = 0 WHERE movil=" . $movil;
        if ($con->query($sql_venta_2) === TRUE) {
            echo "Venta 2 borrada";
            echo "<br>";
        } else {
            echo "Error de borrado de venta_2";
            exit;
        }
    }
    if ($venta_3 > 0) {
        $sql_venta_3 = "UPDATE completa SET venta_3 = 0 WHERE movil=" . $movil;
        if ($con->query($sql_venta_3) === TRUE) {
            echo "Venta 3 borrada";
            echo "<br>";
        } else {
            echo "Error de borrado de venta_3";
            exit;
        }
    }
    if ($venta_4 > 0) {
        $sql_venta_4 = "UPDATE completa SET venta_4 = 0 WHERE movil=" . $movil;
        if ($con->query($sql_venta_4) === TRUE) {
            echo "Venta 4 borrada";
            echo "<br>";
        } else {
            echo "Error de borrado de venta_4";
            exit;
        }
    }
    if ($venta_5 > 0) {
        $sql_venta_5 = "UPDATE completa SET venta_5 = 0 WHERE movil=" . $movil;
        if ($con->query($sql_venta_5) === TRUE) {
            echo "Venta 5 borrada";
            echo "<br>";
        } else {
            echo "Error de borrado de venta_5";
            exit;
        }
    }

    header('Location: inicio_cobros.php');

    ?>


</body>

</html>