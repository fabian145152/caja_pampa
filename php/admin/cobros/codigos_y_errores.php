<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CODIGOS</title>
    <style>
        .contenedor {
            display: flex;
        }

        .columna {
            flex: 1;
            /* cada columna ocupa la mitad del contenedor */
            padding: 20px;
            border: 1px solid #ccc;
        }
    </style>
</head>


<body>
    <ul>
        <div class="contenedor">
            <div class="columna">
                <h2>
                    Sin Voucher</h2>
                <li><b>OK OK (err 1) Error deuda anterior menor a cero</b></li>
                <li><b>OK OK (err 2) Error saldo a favor menor que cero</b></li>
                <li><b>OK OK (err 3) Error efectivo menor que cero</b></li>
                <li><b>OK OK (err 4) Error Saldo a favor - deuda anterior mayores a 0</b></li>
                <li><b>OK OK (cod 5) Solo ventas</b></li>
                <li><b>OK OK (cod 6) Solo saldo a favor</b></li>
                <li><b>OK OK (cod 7) Saldo a favor - Ventas</b></li>
                <li><b>OK OK (cod 8) Solo deuda anterior</b></li>
                <li><b>OK OK (cod 9) Deuda anterior - ventas</b></li>
                <li><b>OK OK (cod 10) Solo semanas</b></li>
                <li><b>OK OK (cod 11) Ventas - Semanas</b></li>
                <li><b>OK OK (cod 12) Semanas - Saldo a favor</b></li>
                <li><b>OK OK (cod 13) Semanas - Saldo a favor - Ventas</b></li>
                <li><b>OK OK (cod 14) Semanas - Deuda anterior</b></li>
                <li><b>OK OK (cod 15) Semanas - deuda anterior - ventas</b></li>
                <li><b>OK OK (cod 16) Deposito Solo</b></li>
                <li><b>OK OK (cod 17) Deposito - Ventas</b></li>
                <li><b>OK OK (cod 18) Deposito - saldo a favor</b></li>
                <li><b>OK OK (cod 19) Deposito - saldo a favor - Ventas</b></li>
                <li><b>OK OK (cod 20) Deposito - Deuda anterior</b></li>
                <li><b>OK OK (cod 21) Deposito - Deuda anterior - Ventas</b></li>
                <li><b>OK OK (cod 22) Deposito - semanas</b></li>
                <li><b>(cod 23) Deposito - Semanas - Ventas</b></li>
                <li><b>(cod 24) Deposito - Semanas - Saldo a favor</b></li>
                <li><b>(cod 25) Deposito - semanas - saldo a favor - ventas</b></li>
                <li><b>(cod 26) Deposito - Semanas - Deuda anterior</b></li>
                <li><b>(cod 27) eposito - Semanas - Deuda anterior - Ventas</b></li>
            </div>
            <div class="columna">
                <h2>Con Voucher</h2>
                <li><b>(cod 29) Voucher solo</b></li>
                <li><b>(cod 30) Voucher - Ventas</b></li>
                <li><b>(cod 31) Voucher - saldo a favor</b></li>
                <li><b>(cod 32) Voucher - Saldo a favor - Ventas</b></li>
                <li><b>(cod 33) voucher - Deuda anterior</b></li>
                <li><b>(cod 34) voucher - Deuda anterior - ventas</b></li>
                <li><b>(err 35) voucher - Deuda anterior - saldo a favor</b></li>
                <li><b>(err 36) voucher - Deuda anterior - saldo a favor - ventas</b></li>
                <li><b>(cod 37) voucher semanas</b></li>
                <li><b>(cod 38) voucher - semanas - ventas</b></li>
                <li><b>(cod 39) voucher - semanas - saldo_a_favor</b></li>
                <li><b>(cod 40) voucher - semanas - saldo a favor - ventas</b></li>
                <li><b>(cod 41) voucher - semanas - Deuda anterior</b></li>
                <li><b>(cod 42) voucher - Semanas - deuda anterior - ventas</b></li>
                <li><b>(err 43) voucher - Semanas - deuda anterior - Saldo a favor</b></li>
                <li><b>(err 44) voucher - semanas - deuda anterior - Saldo a favor - ventas</b></li>
                <li><b>(cod 45) voucher - Deposito</b></li>
                <li><b>(cod 46) voucher - Deposito - Ventas</b></li>
                <li><b>(cod 47) voucher - deposito - saldo a favor</b></li>
                <li><b>(cod 48) voucher - deposito - saldo a favor - ventas</b></li>
                <li><b>(cod 49) voucher - deposito - deuda anterior</b></li>
                <li><b>(cod 50) voucher - deposito - deuda anterior - ventas</b></li>
                <li><b>(err 51) voucher - deposito - deuda anterior - saldo a favor</b></li>
                <li><b>(err 52) voucher - deposito - deuda anterior - saldo a favor - ventas</b></li>
                <li><b>(cod 53) voucher - deposito - semanas</b></li>
                <li><b>(cod 54) voucher - deposito - semanas - ventas</b></li>
                <li><b>(cod 55) voucher - deposito - semanas - saldo a favor - ventas</b></li>
                <li><b>(cod 56) voucher - deposito - semanas - saldo a favor - ventas</b></li>
                <li><b>(cod 57) voucher - deposito - semanas - deuda anterior</b></li>
                <li><b>(cod 58) voucher - deposito - semanas - deuda anterior - ventas</b></li>
                <li><b>(err 59) voucher - deposito - semanas - deuda anterior - saldo a favor</b></li>
                <li><b>(err 60) voucher - deposito - semanas- deuda anterior - saldo a favor - ventas</b></li>
                <li><b>OK OK (cod 61) no voucher - no semanas - no deuda anterior - no Saldo a favor - no ventas - no deposito</b></li>
            </div>
        </div>
        <br>
    </ul>


</body>

</html>