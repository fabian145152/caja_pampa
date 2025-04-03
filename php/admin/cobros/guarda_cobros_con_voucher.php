<?php
session_start();
include_once "../../../funciones/funciones.php";

$con = conexion();
$con->set_charset("utf8mb4");
$movil = $_POST['movil'];

$obs_deu = "";
$obs_ven = "";
$vou_con_dec = "";
$obs_ft = "";
$obs_merc = "";
$obs_sem = "";
$sobra_plata = 0;
$pesos = 0;

// Cuenta la cantidad de viajes de la semana antyerior
// Lee saldo a favor de la semana anterior

$sql_com = "SELECT * FROM completa WHERE movil = " . $movil;
$res_com = $con->query($sql_com);
$row_com = $res_com->fetch_assoc();
$viaj_sem_ant = $row_com['viajes_semana_actual'];
$saldo_fav_sem_ant = $row_com['saldo_a_favor_ft'];


if (!$res_com) {
    die("Error en la consulta viajes de la semana anterior : " . $con->error);
    exit;
}

$sql_sem = "SELECT * FROM semanas WHERE movil = " . $movil;
$res_sem = $con->query($sql_sem);
$row_sem = $res_sem->fetch_assoc();
$paga_x_semana = $row_sem['x_semana'];
$tot_semanas = $row_sem['total'];

if (!$res_sem) {
    die("Error en la consulta de paga x semana : " . $con->error);
    exit;
}

?>


<a href="inicio_cobros.php">SALIR</a>
<br>
<?php
echo "<br>";
$_SESSION['uname'];
$_SESSION['time'] . '<br>';
echo "<br>";
echo "Usuario: " . $usuario = $_SESSION['uname'];
echo "<br>";
echo "Movil: " . $movil;
echo "<br>";
echo $fecha = date("Y-m-d H:i:s");
echo "<br>";

echo "Paga x semana: " . $paga_x_semana;
echo "<br>";


echo "Debe sumado: " . $debe_sumado = $_POST['debe_sumado'];
echo "<br>";
echo "Depositarle al movil: " . $noventa = $_POST['comiaaa'];
echo "<br>";
echo "Descuentos de voucher: " . $comision = $_POST['comi'];
echo "<br>";
echo "Total depositado en voucher: " . $total_vou = $_POST['to_vou'];
echo "<br>";
echo "Deposito en efectivo: " . $dep_ft = $_POST['dep_ft'];
echo "<br>";
echo "Deposito MP: " . $dep_mp = $_POST['dep_mp'];
echo "<br>";
echo "Deposito total: " . $dep_plata = $dep_ft + $dep_mp;
echo "<br>";
echo "Debe abonar: " . $debe_abonar = $_POST['paga_mov'];
echo "<br>";
echo "Deuda anterior leida de la ddbb: " . $deud_ant_ddbb = $row_com['deuda_anterior'];
echo "<br>";
echo "su_pago; " . $su_pago = $dep_mp + $dep_ft;
echo "<br>";


$act_deu_ant = $deud_ant_ddbb + $paga_x_semana;

$actualiza_deudas = $act_deu_ant - $debe_abonar;

$act_semanas = $tot_semanas - $paga_x_semana;

echo $falto_pagar = $debe_abonar - $su_pago;

//exit;

if ($actualiza_deudas == 0) {
    echo "Actualiza semanas: " . $act_semanas = $paga_x_semana;

    $act_sem = $con->prepare("UPDATE semanas SET total = ? WHERE movil = ?");
    $act_sem->bind_param("di", $act_semanas, $movil);

    if ($act_sem->execute()) {
        echo "Semanas adeudadas actualizadas correctamente";
        echo "<br>";
    } else {
        echo "Error al actualizar la deuda de semana anterior: " . $act_semanas->error;
        exit;
    }

    $actualiza = $actualiza_deudas; //aca esta el importe actualizado de la deuda anterior

    $sql_deu_ant = $con->prepare("UPDATE completa SET deuda_anterior = ? WHERE movil = ?");
    $sql_deu_ant->bind_param("di", $actualiza, $movil);

    if ($sql_deu_ant->execute()) {
        echo "Deuda anterior actualizada correctamente";
        echo "<br>";
    } else {
        echo "Error al actualizar cantidad de viajes de la semana anterior: " . $stmt->error;
        exit;
    }
}

/*
Hacer otro if si la qoe pago es menor a lo que debe
*/

echo "<br>";
echo "si tiene deuda anterior y/o debe semanas y paga en ft con cambio exacto esta andando....";
echo "<br>";
echo "Cuando paga de menos, revisarlo.lo tine que guardar en deuda anterior en la tabla completa...";
echo "<br>";
echo "hacer para cuando paga de más";
echo "<br>";
echo "<br>";




exit;



$sql_ca = "INSERT INTO caja_final (movil, fecha, depositarle, usuario, diez, dep_ft, dep_mp, dep_voucher) VALUES (?,?,?,?,?,?,?,?)";
$stmt_ca = $con->prepare($sql_ca);
$stmt_ca->bind_param('isdsdddd', $movil, $fecha, $depositarle, $usuario, $comision, $dep_ft, $dep_mp, $total_vou);


if ($stmt_ca->execute() == TRUE) {
    echo "Nuevo registro creado exitosamente.";
    echo "<br>";
} else {
    echo "Error al guardar los datos del pago: " . $stmt_ca->error;
    exit;
}


exit;




$leo_caj = "SELECT * FROM caja_final ORDER BY id DESC LIMIT 1";
$res_le = $con->query($leo_caj);

if ($res_le->num_rows > 0) {
    $registro = $res_le->fetch_assoc();
    $ftd_caja = $registro['dep_ft'];
    $mpd_caja = $registro['dep_mp'];

    echo "<br>";
} else {
    echo "Error en la lectura"  . $con->error;
    exit;
}


//--------------------------------------------------------------------------------------
// Guardo el efectivo en la caja.
//--------------------------------------------------------------------------------------

$movil = 'caja';

$guar_ft = "INSERT INTO caja_final (movil, fecha, ing_ft_a_caja, ing_mp_a_caja, usuario) VALUES (?,?,?,?,?)";
$stmt_2 = $con->prepare($guar_ft);
$stmt_2->bind_param('isdds', $movil, $fecha, $ftd_caja, $mpd_caja, $usuario);

if ($stmt_2->execute() == TRUE) {
    echo "Moviliento de caja correcto..";
    echo "<br>";
} else {
    echo "Error al guardar el movimiento de caja: " . $stmt_2->error;
    exit;
}

//--------------------------------------------------------------------------------------
// Actualizo caja_final y boro el ft que deposito antes.
//--------------------------------------------------------------------------------------

?>