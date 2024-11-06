<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

function validarMatricula($matricula){
    //Proceso de saneo
    $matricula = trim($matricula);
    $matricula = strip_tags($matricula);
    $matricula= stripslashes($matricula);
    $matricula = htmlspecialchars($matricula);
    //Proceso de validación
    /*Se deberá comprobar la matricula*/
    $patron ="/^[0-9]{4}[A-Z]{3}$/";
    if(preg_match($patron, $matricula)){
        $resultado = $matricula;
    }else{
        $resultado = false;
    }
    return $resultado;
}


function reparacionesMarcadas($reparaciones){ 
    $vectorModulos=["aceite","filtros","distribucion","neumaticos"];
    $correcto = true;
    foreach($reparaciones as $reparacion){
        if(!in_array($reparacion,$vectorModulos)){
            $correcto = false;
        }
    }
    if($correcto){
        return $reparaciones;
    }
    else{
        return false;
    }
}


 function marcaMarcada($marca){
            if($marca == "Chrysler" || $marca== "BMW"|| $marca== "Audi"|| $marca== "Otro"){
                $marcaValida = $marca;
            }else{
                $marcaValida= false;
            }
          return  $marcaValida;
              
        }




 function validacionCadena($cadena){
          // $cadena= filter_input(INPUT_GET, stripslashes(strip_tags(htmlspecialchars($cadena))), FILTER_SANITIZE_STRING);
            $cadena= stripslashes($cadena);
            $cadena= strip_tags($cadena);
            $cadena= htmlspecialchars($cadena);
            return $cadena;
        }
        
        
function sumaReparaciones($reparaciones){
    $precio = 0.0;
    $suma = 0.0;
    foreach($reparaciones as $reparacion){
        switch($reparacion){
            case "aceite": $precio = 65;break;
            case "filtros": $precio = 87;break;
            case "distribucion": $precio = 950;break;
            case "neumaticos": $precio = 225;break;

        }
        $suma+=$precio;
        
       
    }
    return $suma;
    
}

function sumaReparacionesConIVA($reparaciones,$iva){
    $precio = 0.0;
    $suma = 0.0;
    foreach($reparaciones as $reparacion){
        switch($reparacion){
            case "aceite": $precio = 65;break;
            case "filtros": $precio = 87;break;
            case "distribucion": $precio = 950;break;
            case "neumaticos": $precio = 225;break;

        }
        $suma+=$precio;
        
       
    }
    return $suma*$iva;
    
}