<!DOCTYPE html>
<html lang="es">
<!-- Este archivo viene de cobro_con_voucher.php -
Es la calculadora de cantidad de viajes a cobrar y monto a depositar 
-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiplicación y Resta Automática</title>
    <script>
        let multiplicador; // Variable de PHP para multiplicar
        let otraVariable; // Variable de PHP para realizar la resta

        /*
        function calcularYRestar() {
            const numero = document.getElementById('numero').value; // Capturamos el número ingresado
            if (!isNaN(numero) && numero !== "") { // Verificamos que sea un número válido
                const resultadoMultiplicacion = numero * multiplicador; // Multiplicamos
                const resultadoResta = otraVariable - resultadoMultiplicacion; // Realizamos la resta
                document.getElementById('resultadoMultiplicacion').value = resultadoMultiplicacion; // Mostramos la multiplicación
                document.getElementById('resultadoResta').value = resultadoResta.toFixed(2); // Actualizamos la segunda variable

            } else {
                document.getElementById('resultadoMultiplicacion').value = ""; // Limpiamos los resultados
                document.getElementById('resultadoResta').value = "";
            }
        }
*/

        function calcularYRestar() {
            const numero = document.getElementById('numero').value; // Capturamos el número ingresado
            //const saldoAfavor = 1000; // Definimos el saldo a favor

            if (!isNaN(numero) && numero !== "") { // Verificamos que sea un número válido
                const resultadoMultiplicacion = numero * multiplicador; // Multiplicamos
                const resultadoResta = otraVariable - resultadoMultiplicacion; // Realizamos la resta
                const resultadoFinal = resultadoResta + saldoAfavor; // Sumamos el saldo a favor

                document.getElementById('resultadoMultiplicacion').value = resultadoMultiplicacion; // Mostramos la multiplicación
                document.getElementById('resultadoResta').value = resultadoFinal.toFixed(2); // Actualizamos la segunda variable con saldo a favor

            } else {
                document.getElementById('resultadoMultiplicacion').value = ""; // Limpiamos los resultados
                document.getElementById('resultadoResta').value = "";
            }
        }
    </script>
</head>

<body>
    <?php
    // Variables definidas en PHP
    $multiplicador = round($paga_x_viaje); // Valor usado para la multiplicación
    $otraVariable = round($dato_a_env); // Valor inicial para la resta
    /*
    echo "<br>multiplicador: " . $multiplicador;
    echo "<br>Otra variable: " . $otraVariable;
    echo "<br>Saldo a favor: " . $saldo_a_favor;
*/
    //$otraVariable = $dep_para_movil; // Valor inicial para la resta
    echo "<script>
            multiplicador = $multiplicador;
            otraVariable = $otraVariable;
            saldoAfavor = $saldo_a_favor;
          </script>"; // Pasamos ambas variables a JavaScript
    
    ?>

    <form>
        <label for="numero">Viajes a cobrar:</label>
        <input type="text" id="numero" name="numero" onblur="calcularYRestar()" required autofocus>
        <h6><strong>Ingrese cantidad y presione la tecla TAB</strong></h6>
        <input type="hidden" id="resultadoMultiplicacion" readonly>

        <label for="resultadoResta">Total a depositarle:</label>
        <input type="text" id="resultadoResta" name="resultadoResta" readonly style="background-color: yellow;">

    </form>
</body>

</html>