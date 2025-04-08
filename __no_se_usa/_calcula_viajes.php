<script>
    let multiplicador; // Variable para el valor de PHP

    function calcularResultado() {
        const numero = document.getElementById('numero').value; // Capturamos el número ingresado
        if (!isNaN(numero) && numero !== "") { // Verificar que sea un número válido
            const resultado = numero * multiplicador; // Multiplicamos por la variable PHP
            document.getElementById('resultado').value = resultado; // Mostramos el resultado
        } else {
            document.getElementById('resultado').value = ""; // Limpiamos si no es válido
        }
    }
</script>
</head>

<body>
    <?php
    // Variable PHP
    $multiplicador = $paga_x_viaje; // Cambia este valor según lo que desees
    echo "<script>multiplicador = $multiplicador;</script>"; // Pasamos la variable PHP a JavaScript
    ?>

    
    <form>
        <label for="numero">Ingrese cantidad de viajes y presion TAB:</label>
        <input type="number" id="numero" onblur="calcularResultado()" required>
        <br><br>
        <label for="resultado">Resultado:</label>
        <input type="text" id="resultado" readonly>
    </form>