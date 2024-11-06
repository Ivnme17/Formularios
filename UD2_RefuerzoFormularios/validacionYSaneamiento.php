<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */


function validarDNI($dni){
    //Proceso de saneo
    $dni = trim($dni);
    $dni = strip_tags($dni);
    $dni= stripslashes($dni);
    $dni = htmlspecialchars($dni);
    //Proceso de validación
    $patron ="/^[0-9]{8}[A-Z]$/";
    if(preg_match($patron, $dni)){
        $resultado = $dni;
    }else{
        $resultado = false;
    }
    return $resultado;
}









function modulosMarcados($modulos){ 
    $vectorModulos=["DAW","DIW","DWES","DWEC","EIE","HLC"];
    $correcto = true;
    foreach($modulos as $modulo){
        if(!in_array($modulo,$vectorModulos)){
            $correcto = false;
        }
    }
    if($correcto){
        return $modulos;
    }
    else{
        return false;
    }
}