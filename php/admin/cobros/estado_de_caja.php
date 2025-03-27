<?php
session_start();
include_once "../../../funciones/funciones.php";

$con = conexion();
$con->set_charset("utf8mb4");


$leo_caj = "SELECT * FROM caja_final WHERE movil = 0 ORDER BY id DESC ";
$res_le = $con->query($leo_caj);



?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen de caja</title>
    <?php head() ?>
    <script>
        function cerrarPagina() {
            window.close();
        }
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .header-columns {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .header-columns div {
            margin: 0 10px;
            text-align: center;
        }

        .data-rows {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 20px;
        }

        .data-rows .row {
            display: flex;
            justify-content: space-around;
            width: 80%;
        }

        .data-rows input {
            padding: 5px;
            box-sizing: border-box;
            width: 100px;
        }
    </style>
</head>

<body>
    <div>
        <h1>Resumen de caja</h1>
        <button onclick="cerrarPagina()" class="btn btn-primary btn-sm">CERRAR PAGINA</button>

        <table style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <th style="border: 1px solid black; padding: 8px;">DEBER FT</th>
                    <th style="border: 1px solid black; padding: 8px;">HABER FT</th>
                    <th style="border: 1px solid black; padding: 8px;">SALDO FT</th>
                    <th style="border: 1px solid black; padding: 8px;">DEBER MP</th>
                    <th style="border: 1px solid black; padding: 8px;">HABER MP</th>
                    <th style="border: 1px solid black; padding: 8px;">SALDO MP</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $linea = 100;
                if ($res_le->num_rows > 0) {
                    while ($row = $res_le->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td style="border: 1px solid black; padding: 8px;">' . $linea . '</td>';
                        echo '<td style="border: 1px solid black; padding: 8px;">' . $row['dep_ft'] . '</td>';
                        echo '<td style="border: 1px solid black; padding: 8px;">' . $linea . '</td>';
                        echo '<td style="border: 1px solid black; padding: 8px;">' . $row['dep_mp'] . '</td>';
                        echo '<td style="border: 1px solid black; padding: 8px;">' . $linea . '</td>';
                        echo '<td style="border: 1px solid black; padding: 8px;">' . $linea . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="6" style="border: 1px solid black; text-align: center; padding: 8px;">No se encontraron registros: ' . $con->error . '</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>