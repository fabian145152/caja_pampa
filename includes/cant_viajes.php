<?php
echo "<br>Recuento de viajes";
if ($viajes_q_se_cobran == $tot_viajes) {
    echo "<br>Paga todos los viajes";
    $total_de_viajes = $tot_viajes * $paga_x_viaje;
    echo "<br>Deposito en voucher: " . $tot_voucher;
    echo "<br>Comision: " . $comision = $tot_voucher * .1;
    echo "<br>Importe de viajes: " . $total_de_viajes;
    $para_base = $comision + $total_de_viajes;
    echo "<br>Para base: " . $para_base = round($para_base);
    echo "<br>";
    echo "<br>Para el movil: " . $para_movil = $tot_voucher - $para_base;
    $viajes_semana_que_viene = 0;
    echo "<br>Saldo leido: " . $saldo_leido;
    echo "<br>Viajes semana queviene: " . $viajes_semana_qu_viene = 0;
    if ($saldo_leido < $para_movil) {
    }
    $resto_dep_mov = $para_movil;
    $saldo_a_favor = 0;

} elseif ($viajes_q_se_cobran < $tot_viajes) {
    echo "<br>Paga menos viajes guardar para la semana que viene...";
    echo "<br>Total de viajes: " . $total_de_viajes;
    echo "<br>Cantidad de viajes que se cobran: " . $viajes_q_se_cobran;
    $viajes_semana_que_viene = $total_de_viajes - $viajes_q_se_cobran;
    $total_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Deposito en voucher: " . $tot_voucher;
    echo "<br>Importe de viajes: " . $total_de_viajes;
    echo "<br>Comision: " . $comision = $tot_voucher * .1;
    $para_movil = $tot_voucher * .9 - $total_de_viajes;
    $para_base = $comision + $total_de_viajes;
    echo "<br>Para base: " . $para_base = round($para_base);
    echo "<br>Resto dep movil: " . $resto_dep_mov = $para_movil;
    echo "<br>Viajes que se cobran la semana que viene: " . $viajes_semana_que_viene;
    echo "<br><br><br>";

    echo "<br>";

    $saldo_leido = saldoCaja($con, $para_movil);
    echo "<br>Saldo leido: " . $saldo_leido;

}
echo "<br>Fin recuento de viajes";
echo "<br><br><br>";
