<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

function validarNombre($nombre){
    //Proceso de saneo
    $nombre = trim($nombre);
    $nombre = strip_tags($nombre);
    $nombre= stripslashes($nombre);
    $nombre = htmlspecialchars($nombre);
    //Proceso de validación
    /*Se deberá comprobar que el nombre únicamente contiene caracteres de la A a la Z 
     * minúscula o mayúscula y con acentos, como máximo dos palabras separadas 
     * por un espacio.*/
    $patron ="/^[A-Za-záéíóúÁÉÍÓÚ]+\s?[A-Za-záéíóúÁÉÍÓÚ]*$/";
    if(preg_match($patron, $nombre)){
        $resultado = $nombre;
    }else{
        $resultado = false;
    }
    return $resultado;
}


function validarId($id){
    //Proceso de saneo
    $id = trim($id);
    $id = strip_tags($id);
    $id= stripslashes($id);
    $id = htmlspecialchars($id);
    //Proceso de validación
    $patron ="/^[A-Za-z0-9]+$/";
    if(preg_match($patron, $id)){
        $resultado = $id;
    }else{
        $resultado = false;
    }
    return $resultado;
}


function validarPrecio($precio){
    $precio = trim($precio);
    $precio = strip_tags($precio);
    $precio= stripslashes($precio);
    $precio = htmlspecialchars($precio);
    //Verificamos si el precio es real y un valor numerico
    $resultado = filter_var($precio, FILTER_VALIDATE_FLOAT);
    return $resultado;
}

function categoriasMarcadas($categorias){ 
    $vectorCategorias=["cosmetica","hogar","alimentacion","textil","saldos"];
    $correcto = true;
    foreach($categorias as $categoria){
        if(!in_array($categoria,$vectorCategorias)){
            $correcto = false;
        }
    }
    if($correcto){
        return $categorias;
    }
    else{
        return false;
    }
}

function ivaSeleccionado($iva){
    if($iva == "0.21" || $iva == "0.18"){
        $resultado= $iva;
    }else{
        $resultado = false;
    }
    return $resultado;
}