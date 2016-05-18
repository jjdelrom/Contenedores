<?php

function rellenaSelectContenedor($contenedores) {
    for ($i = 0; $i < count($contenedores); $i++) {
        echo "<option id=" . $contenedores[$i]->{"device"} . " value=" . $contenedores[$i]->{"device"} . "> ID: " . $contenedores[$i]->{"device"} . " - UBICACION: " . $contenedores[$i]->{"uid"} . "</option>";
    }
}

function rellenaSelectHora($medidas) {
    $arrayHoras = array();
    $arrayDias = array();
    for ($c = 0; $c < count($medidas); $c++) {
        $fechaYhora = $medidas[$c]->{"date"};
        $hora = explode("T", $fechaYhora);
        if (!in_array(substr($hora[1], 0, 8), $arrayHoras)) {
            array_push($arrayHoras, substr($hora[1], 0, 8));
        }
        if (!in_array(substr($hora[0], 0, 10), $arrayDias)) {
            array_push($arrayDias, substr($hora[0], 0, 10));
        }
    }
    for ($i = 0; $i < count($arrayHoras); $i++) {

        echo "<option id=" . $arrayHoras[$i] . " value=" . $arrayHoras[$i] . "> Hora: " . $arrayHoras[$i] . "</option>";
    }
}
