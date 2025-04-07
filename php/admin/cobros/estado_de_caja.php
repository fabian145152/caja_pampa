<?php
session_start();
include_once "../../../funciones/funciones.php";

$con = conexion();
$con->set_charset("utf8mb4");

//----------ACTUALIZA DEL BALANCE DE CAJA------------------

$leo_caj_0 = "SELECT * FROM caja_final WHERE movil = 0 ORDER BY id DESC LIMIT 2";

$res_le_0 = $con->query($leo_caj_0);
$leo_caj_0 = $res_le_0->fetch_assoc();
echo $saldo_ft = $leo_caj_0['saldo_ft'];
echo "<br>";

$leo_caj_1 = "SELECT * FROM caja_final WHERE movil = 0 ORDER BY id DESC LIMIT 2";

$res_le_1 = $con->query($leo_caj_1);


if ($res_le_1->num_rows > 0) {
    $rows = [];
    while ($row = $res_le_1->fetch_assoc()) {
        $rows[] = $row; // Almacenar cada fila en el arreglo
    }



    $ultimo_registro = $rows[0]; // Último registro
    $registro_anterior = $rows[1]; // Registro anterior


    $haber_ant_ft = $registro_anterior["saldo_ft"];
    $haber_nuevo_ft = $ultimo_registro["haber_ft"];
    $saldo_ant_ft = $registro_anterior["saldo_ft"];

    $saldo_actualizado_ft = $saldo_ant_ft + $haber_ant_ft;

    $haber_ant_mp = $registro_anterior["saldo_mp"];
    $haber_nuevo_mp = $ultimo_registro["haber_mp"];
    $saldo_ant_mp = $registro_anterior["saldo_mp"];

    $saldo_actualizado_mp = $saldo_ant_mp + $haber_ant_mp;

    $id_ultimo = $ultimo_registro["id"];

    if ($saldo_actualizado_ft != 0 && $saldo_actualizado_mp != 0) {


        $id_ultimo;

        $sql_actualiza = "UPDATE caja_final SET saldo_ft = ?, saldo_mp = ? WHERE id = ?";
        $stmt = $con->prepare($sql_actualiza);


        $stmt->bind_param("ddi", $saldo_actualizado_ft, $saldo_actualizado_mp, $id_ultimo); // "ddi" indica los tipos: double, double, integer
        $stmt->execute();
    } else {
        echo "No se encontraron registros.";
    }
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
                    <th style="border: 1px solid black; padding: 8px;">FECHA</th>
                    <th style="border: 1px solid black; padding: 8px;">DEBE FT</th>
                    <th style="border: 1px solid black; padding: 8px;">HABER FT</th>
                    <th style="border: 1px solid black; padding: 8px; color: red;">SALDO FT</th>
                    <th style="border: 1px solid black; padding: 8px;">DEBE MP</th>
                    <th style="border: 1px solid black; padding: 8px;">HABER MP</th>
                    <th style="border: 1px solid black; padding: 8px; color: red;">SALDO MP</th>
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

                            <th style="border: 1px solid black; padding: 8px;"><?php echo $row['fecha'] ?></th>

                            <th style="border: 1px solid black; padding: 8px;"><?php echo $row['debe_ft'] ?></th>
                            <th style="border: 1px solid black; padding: 8px;"><?php echo $row['haber_ft'] ?></th>
                            <th style="border: 1px solid black; padding: 8px;"><?php echo $row['saldo_ft'] ?></th>

                            <th style="border: 1px solid black; padding: 8px;"><?php echo $row['debe_mp'] ?></th>
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