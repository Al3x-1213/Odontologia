<?php

function ordenarFecha($fechaOrdenada){
    $fecha = explode("-", $fechaOrdenada);
    return $fechaOrdenada = $fecha[2]."-".$fecha[1]."-".$fecha[0];
}

function diaSemana($dia){
    $dias = array('', 'Lunes ','Martes ','Miercoles ','Jueves ','Viernes ','Sabado ', 'Domingo ');
    $fecha = $dias[date('N', strtotime($dia))];
    return $fecha;
}

function mesAño($mes){
    if ($mes == 1){
        $mesAño = "Enero ";
    }
    elseif ($mes == 2){
        $mesAño = "Febrero ";
    }
    elseif ($mes == 3){
        $mesAño = "Marzo ";
    }
    elseif ($mes == 4){
        $mesAño = "Abril ";
    }
    elseif ($mes == 5){
        $mesAño = "Mayo ";
    }
    elseif ($mes == 6){
        $mesAño = "Junio ";
    }
    elseif ($mes == 7){
        $mesAño = "Julio ";
    }
    elseif ($mes == 8){
        $mesAño = "Agosto ";
    }
    elseif ($mes == 9){
        $mesAño = "Septiembre ";
    }
    elseif ($mes == 10){
        $mesAño = "Octubre ";
    }
    elseif ($mes == 11){
        $mesAño = "Noviembre ";
    }
    elseif ($mes == 12){
        $mesAño = "Diciembre ";
    }
    else{
        $mesAño = "Error";
    }
    return $mesAño;
}

?>