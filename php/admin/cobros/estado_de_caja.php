<?php
session_start();
include_once "../../../funciones/funciones.php";

$con = conexion();
$con->set_charset("utf8mb4");

//----------ACTUALIZA DEL BALANCE DE CAJA------------------

$leo_caj_0 = "
    SELECT * FROM caja_final 
    WHERE movil = 0 
    ORDER BY id DESC 
    LIMIT 1 OFFSET 1
";

$res_le_0 = $con->query($leo_caj_0);
$antepenultimo = $res_le_0->fetch_assoc();

if ($antepenultimo) {
    $id = $antepenultimo['id'];

    $saldo_ft = $antepenultimo['saldo_ft'];
    $saldo_mp = $antepenultimo['saldo_mp'];
} else {
    echo "No se encontró el antepenúltimo registro.";
}



$leo_caj_1 = "SELECT * FROM caja_final WHERE movil = 0 ORDER BY id DESC LIMIT 2";

$res_le_1 = $con->query($leo_caj_1);


if ($res_le_1->num_rows > 0) {
    $rows = [];
    while ($row = $res_le_1->fetch_assoc()) {
        $rows[] = $row; // Almacenar cada fila en el arreglo
    }


    $ultimo_registro = $rows[0]; // Último registro
    $registro_anterior = $rows[1]; // Registro anterior


    $saldo_ant_ft = $registro_anterior["saldo_ft"];

    $haber_nuevo_ft = $ultimo_registro["haber_ft"];

    $haber_ant_ft = $antepenultimo['haber_ft'];

    $saldo_nuevo_ft = $ultimo_registro['saldo_ft'];

    $ft_caja = $haber_nuevo_ft + $saldo_nuevo_ft;

    if ($ft_caja == 0) {
        echo "Efectivo en caja= " . $saldo_nuevo_ft;
        echo "<br>";
    } else {
        echo "Efectivo en caja= " . $ft_caja;
        echo "<br>";
    }

    $saldo_actualizado_ft = $saldo_ant_ft + $haber_ant_ft;


    $saldo_ant_mp = $registro_anterior["saldo_mp"];

    $haber_nuevo_mp = $ultimo_registro["haber_mp"];

    $haber_ant_mp = $antepenultimo['haber_mp'];

    $saldo_nuevo_mp = $ultimo_registro['saldo_mp'];

    $mp_caja = $haber_nuevo_mp + $saldo_nuevo_mp;

    if ($mp_caja == 0) {
        echo "Mercado en caja= " . $saldo_nuevo_mp;
        echo "<br>";
    } else {
        echo "Mercado en caja= " . $mp_caja;
        echo "<br>";
    }

    $saldo_actualizado_mp = $saldo_ant_mp + $haber_ant_mp;

    $id_ultimo = $ultimo_registro["id"];


    $sql_actualiza = "UPDATE caja_final SET saldo_ft = ?, saldo_mp = ? WHERE id = ?";
    $stmt = $con->prepare($sql_actualiza);
    $stmt->bind_param("ddi", $saldo_actualizado_ft, $saldo_actualizado_mp, $id_ultimo); // "ddi" indica los tipos: double, double, integer
    $stmt->execute();
}
//exit;
//--------------------------------------------------------------------------------------


$leo_caj = "SELECT * FROM caja_final WHERE movil = 0 ORDER BY id DESC ";
$res_le = $con->query($leo_caj);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BALANCE DE CAJA</title>
    <?php head() ?>
    <script>
        function cerrarPagina() {
            window.close();
        }
    </script>

</head>

<body>
    <div>
        <h1>Resumen de caja</h1>
        <button onclick="cerrarPagina()" class="btn btn-primary btn-sm">CERRAR PAGINA</button>

        <table style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <th style="border: 1px solid black; padding: 8px;">ID</th>
                    <th style="border: 1px solid black; padding: 8px;">FECHA</th>
                    <!--  <th style="border: 1px solid black; padding: 8px;">DEBE FT</th> -->
                    <th style="border: 1px solid black; padding: 8px;">INGRESO FT</th>
                    <th style="border: 1px solid black; padding: 8px; color: red;">SUBTOTAL FT</th>
                    <!-- <th style="border: 1px solid black; padding: 8px;">DEBE MP</th> -->
                    <th style="border: 1px solid black; padding: 8px;">INGRESO MP</th>
                    <th style="border: 1px solid black; padding: 8px; color: red;">SUBTOTAL MP</th>>
                    <th style="border: 1px solid black; padding: 8px;">Retiro FT</th>
                    <th style="border: 1px solid black; padding: 8px;">Retiro MP</th>
                    <th style="border: 1px solid black; padding: 8px;">USUARIO</th>
                    <th style="border: 1px solid black; padding: 8px;">OBSERVACIONES</th>

                </tr>
            </thead>
            <tbody>

                <?php



                //if ($res_le->num_rows > 0) {

                while ($row = $res_le->fetch_assoc()) {
                    $saldo_ft = $row['haber_ft'] - $row['debe_ft'];
                    $saldo_mp = $row['haber_mp'] - $row['debe_mp'];
                ?>
                    <form action="#" method="">
                        <?php
                        ?>
                        <tr>
                            <th style="border: 1px solid black; padding: 8px;"><?php echo $row['id'] ?></th>
                            <th style="border: 1px solid black; padding: 8px;"><?php echo $row['fecha'] ?></th>

                            <!-- <th style="border: 1px solid black; padding: 8px;"><?php echo $row['debe_ft'] ?></th> -->
                            <th style="border: 1px solid black; padding: 8px;"><?php echo $row['haber_ft'] ?></th>
                            <th style="border: 1px solid black; padding: 8px;"><?php echo $row['saldo_ft'] ?></th>

                            <!-- <th style="border: 1px solid black; padding: 8px;"><?php echo $row['debe_mp'] ?></th> -->
                            <th style="border: 1px solid black; padding: 8px;"><?php echo $row['haber_mp'] ?></th>
                            <th style="border: 1px solid black; padding: 8px;"><?php echo $row['saldo_mp'] ?></th>

                            <th style="border: 1px solid black; padding: 8px;"><?php echo $row['retiro_ft'] ?></th>
                            <th style="border: 1px solid black; padding: 8px;"><?php echo $row['retiro_mp'] ?></th>

                            <th style="border: 1px solid black; padding: 8px;"><?php echo $row['usuario'] ?></th>
                            <th style="border: 1px solid black; padding: 8px;"><?php echo $row['observaciones'] ?></th>

                        </tr>
                    <?php
                }
                    ?>
            </tbody>
        </table>
    </div>
</body>

</html>