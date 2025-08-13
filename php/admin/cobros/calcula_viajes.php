<!DOCTYPE html>
<html lang="es">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiplicación y Resta Automática</title>
    <script>
        let multiplicador; // Variable de PHP para multiplicar
        let otraVariable; // Variable de PHP para realizar la resta


        function calcularYRestar() {
            const numero = document.getElementById('numero').value; // Capturamos el número ingresado


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

    $multiplicador = round($paga_x_viaje);
    $otraVariable = round($dato_a_env);


    echo "<script>
            multiplicador = $multiplicador;
            otraVariable = $otraVariable;
            saldoAfavor = $saldo_a_favor;
          </script>";

    ?>

    <form>
        <label for="numero">Viajes a cobrar:</label>
        <input type="text" id="numero" name="numero" onblur="calcularYRestar()" required autofocus>
        <h6><strong>Ingrese cantidad y presione la tecla TAB</strong></h6>
        <input type="hidden" id="resultadoMultiplicacion" readonly>
        <label for="resultadoResta">Total a depositarle:</label>
        <input type="text" id="resultadoResta" name="resultadoResta" style="background-color: yellow;">
    </form>
</body>

</html>