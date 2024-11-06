<?php 
require_once './funcionesValidacion.php';

$valoresRecibidos = filter_has_var(INPUT_POST, "nombre") && filter_has_var(INPUT_POST, "id") &&
        filter_has_var(INPUT_POST, "categorias") && filter_has_var(INPUT_POST, "precio") &&
        filter_has_var(INPUT_POST, "IVA");


if($valoresRecibidos){
    $nombre = validarNombre(filter_input(INPUT_POST, "nombre"));
    $id = validarId(filter_input(INPUT_POST, "id"));
    $categoria = categoriasMarcadas($_POST["categorias"]);
    $precio = validarPrecio(filter_input(INPUT_POST, "precio"));
    $iva = ivaSeleccionado(filter_input(INPUT_POST, "IVA"));
   
    
    $valoresValidados = $nombre && $id && $categoria && $precio && $iva;
    
}
?>





<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php if(!$valoresRecibidos){ ?>
            <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
            <label>Introduce el nombre:</label><input type="text" name="nombre" value=""><br><br>
            <label>Introduce el id:</label><input type="text" name="id" value=""><br><br>
          <label>Elige una o varias categoría:</label><br><br>
                <input type="checkbox" name="categorias[]" value="cosmetica">Cosmética 
                <input type="checkbox" name="cateogiras[]" value="hogar">Hogar
                <input type="checkbox" name="categorias[]" value="alimentacion">Alimentación
                <input type="checkbox" name="categorias[]" value="textil">Textil
                <input type="checkbox" name="categorias[]" value="saldos">Saldos
                <br><br>
            <label>Introduce el precio:</label><input type="text" name="precio" value=""><br><br>

             <label>Introduce un IVA:</label><br><br>
                0.21 <input type="radio" name="IVA"  value="0.21"><br><br> 
                0.18<input type="radio" name="IVA" value="0.18"><br><br> 

                    <button type="submit">Guardar</button>

            </form>
        
        <?php }else{ ?>
        <?php if($valoresValidados){ ?>
        <?php echo "El producto con id $id se ha dado de alta correctamente." ?>
        <?php }else{ ?>
        <?php echo "ERROR:Datos no introducidos o no validos"; ?>
           <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
               <label>Introduce el nombre:</label><input type="text" name="nombre" value="<?php if(filter_has_var(INPUT_POST, "nombre")) echo filter_input(INPUT_POST, "nombre") ?>"><br><br>
               <?php if(!$nombre){ ?>
               <div class="nombre">
                   El nombre no es válido
               </div>
               <?php } ?>
            <label>Introduce el id:</label><input type="text" name="id" value="<?php if(filter_has_var(INPUT_POST, "id")) echo filter_input(INPUT_POST, "id") ?>"><br><br>
          <?php if(!$id){ ?>
               <div class="id">
                   El id no es válido
               </div>
               <?php } ?>
            <label>Elige una o varias categoría:</label><br><br>
                <input type="checkbox" name="categorias[]" value="cosmetica" <?= in_array("cosmetica",$categoria) ? "checked" : ""  ?> >Cosmética 
                <input type="checkbox" name="cateogiras[]" value="hogar" <?= in_array("hogar",$categoria) ? "checked" : ""  ?>>Hogar
                <input type="checkbox" name="categorias[]" value="alimentacion" <?= in_array("alimentacion",$categoria) ? "checked" : ""  ?>>Alimentación
                <input type="checkbox" name="categorias[]" value="textil" <?= in_array("textil",$categoria) ? "checked" : ""  ?>>Textil
                <input type="checkbox" name="categorias[]" value="saldos" <?= in_array("saldos",$categoria) ? "checked" : ""  ?>>Saldos
                <br><br>
            <label>Introduce el precio:</label><input type="text" name="precio" value="<?php if(filter_has_var(INPUT_POST, "precio")) echo filter_input(INPUT_POST, "precio") ?>"><br><br>
             <?php if(!$precio){ ?>
               <div class="precio">
                   El precio no es válido
               </div>
               <?php } ?>
             <label>Introduce un IVA:</label><br><br>
                0.21 <input type="radio" name="IVA"  value="0.21"><br><br> 
                0.18<input type="radio" name="IVA" value="0.18"><br><br> 
                 <?php if(!$iva){ ?>
               <div class="iva">
                   El iva no se ha seleccionado
               </div>
               <?php } ?>
                    <button type="submit">Guardar</button>

            </form>
        <?php } ?>
    <?php } ?>
    </body>
</html>
