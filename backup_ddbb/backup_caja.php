<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>

    <?php

    /**
     * Respaldar base de datos de MySQL con PHP
     * Función modificada de: https://stackoverflow.com/a/21284229/5032550
     *
     * Visita: https://parzibyte.me/blog/2018/10/22/script-respaldar-base-de-datos-mysql-php/
     */

    // Ejemplo de llamada: exportarTablas("localhost", "root", "123", "foo");

    function exportarTablas($host, $usuario, $pasword, $nombreDeBaseDeDatos)
    {
        set_time_limit(3000);
        $tablasARespaldar = [];
        $mysqli = new mysqli($host, $usuario, $pasword, $nombreDeBaseDeDatos);
        $mysqli->select_db($nombreDeBaseDeDatos);
        $mysqli->query("SET NAMES 'utf8'");
        $tablas = $mysqli->query('SHOW TABLES');
        while ($fila = $tablas->fetch_row()) {
            $tablasARespaldar[] = $fila[0];
        }
        $contenido = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\r\nSET time_zone = \"+00:00\";\r\n\r\n\r\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\r\n/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\r\n/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\r\n/*!40101 SET NAMES utf8 */;\r\n--\r\n-- Database: `" . $nombreDeBaseDeDatos . "`\r\n--\r\n\r\n\r\n";
        foreach ($tablasARespaldar as $nombreDeLaTabla) {
            if (empty($nombreDeLaTabla)) {
                continue;
            }
            $datosQueContieneLaTabla = $mysqli->query('SELECT * FROM `' . $nombreDeLaTabla . '`');
            $cantidadDeCampos = $datosQueContieneLaTabla->field_count;
            $cantidadDeFilas = $mysqli->affected_rows;
            $esquemaDeTabla = $mysqli->query('SHOW CREATE TABLE ' . $nombreDeLaTabla);
            $filaDeTabla = $esquemaDeTabla->fetch_row();
            $contenido .= "\n\n" . $filaDeTabla[1] . ";\n\n";
            for ($i = 0, $contador = 0; $i < $cantidadDeCampos; $i++, $contador = 0) {
                while ($fila = $datosQueContieneLaTabla->fetch_row()) {
                    //La primera y cada 100 veces
                    if ($contador % 100 == 0 || $contador == 0) {
                        $contenido .= "\nINSERT INTO " . $nombreDeLaTabla . " VALUES";
                    }
                    $contenido .= "\n(";
                    for ($j = 0; $j < $cantidadDeCampos; $j++) {
                        $fila[$j] = str_replace("\n", "\\n", addslashes($fila[$j]));
                        if (isset($fila[$j])) {
                            $contenido .= '"' . $fila[$j] . '"';
                        } else {
                            $contenido .= '""';
                        }
                        if ($j < ($cantidadDeCampos - 1)) {
                            $contenido .= ',';
                        }
                    }
                    $contenido .= ")";
                    # Cada 100...
                    if ((($contador + 1) % 100 == 0 && $contador != 0) || $contador + 1 == $cantidadDeFilas) {
                        $contenido .= ";";
                    } else {
                        $contenido .= ",";
                    }
                    $contador = $contador + 1;
                }
            }
            $contenido .= "\n\n\n";
        }
        $contenido .= "\r\n\r\n/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\r\n/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\r\n/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";

        # Se guardará dependiendo del directorio, en una carpeta llamada respaldos
        $carpeta = __DIR__ . "/respaldos";   //esta linea es en esta pc
        //$carpeta = "\\\server-win\server-win/01_backup_caja";

        if (!file_exists($carpeta)) {
            mkdir($carpeta);
        }

        # Calcular un ID único
        $id = uniqid();

        # También la fecha
        $fecha = date("Y-m-d");

        # Crear un archivo que tendrá un nombre como respaldo_2018-10-22_asd123.sql
        $nombreDelArchivo = sprintf('%s/acaja_%s_%s.sql', $carpeta, $fecha, $id);

        #Escribir todo el contenido. Si todo va bien, file_put_contents NO devuelve FALSE
        return file_put_contents($nombreDelArchivo, $contenido) !== false;
    }

    exportarTablas("localhost", "root", "belgrado", "acaja");

    echo "Hola";
    echo "<br>";
    $DateAndTime = date('m-d-Y h:i:s a', time());
    echo "<br>";
    echo "Backup realizado: $DateAndTime.";


    echo "<br>";
    echo "Hace backup de la BBDD remises y lo guarda en localhost/backup_ddbb/respaldos";

    

    ?>
    <script>
        window.alert("Backup del dia Realizado");
        window.location = "../php/menu.php";
    </script>
    <?php

    ?>

</body>

</html>