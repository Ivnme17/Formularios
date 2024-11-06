<?php 
require_once './funcionesValidación.php';
$datosRecibidos = filter_has_var(INPUT_POST, "matricula") && filter_has_var(INPUT_POST, "marca") && 
        filter_has_var(INPUT_POST, "modelo") && filter_has_var(INPUT_POST, "reparaciones");


if($datosRecibidos){
    $matricula = validarMatricula(filter_input(INPUT_POST, "matricula"));
    $marca = marcaMarcada(filter_input(INPUT_POST, "marca"));
    $modelo = validacionCadena(filter_input(INPUT_POST, "modelo"));
    $reparaciones = reparacionesMarcadas($_POST["reparaciones"]);
    
    $datosValidados = $matricula && $marca && $modelo && $reparaciones;
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
        <?php if(!$datosRecibidos){ ?>
             <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
        <label>Introduce la matrícula:</label><input type="text" name="matricula" value=""><br><br>

        <label>Introduce una marca:</label><br><br>
                Chrysler <input type="radio" name="marca"  value="Chrysler">
                BMW<input type="radio" name="marca" value="BMW">
                Audi <input type="radio" name="marca"  value="Audi">
                Otro<input type="radio" name="marca" value="Otro"><br><br>
        <label>Introduce el modelo:</label><input type="text" name="modelo" value=""><br><br>

        
                        <table style="align: center; text-align: left;" border="1px">
                    <tbody>
                        <tr>
                            <th>Seleccionar</th>
                            <th>Reparacion</th>
                            <th>Precio</th>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="reparaciones[]" value="aceite"></td>
                            <td>Cambio de aceite</td>
                            <td>65€</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="reparaciones[]" value="filtros"></td>
                            <td>Cambio de filtros</td>
                            <td>87€</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="reparaciones[]" value="distribucion"></td>
                            <td>Correa de distribucion</td>
                            <td>950€</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="reparaciones[]" value="neumaticos"></td>
                            <td>Cambio de 2 neumaticos</td>
                            <td>225€</td>
                        </tr>
                    </tbody>
                </table>
                <br>            
                <br>                   
                    <button type="submit" name="calcularPrecio">Calcular precio</button> 
            </form>
        
        <?php }else { ?>
        <?php if($datosValidados){ ?>
        <?php echo "Datos funcionando" ?>
         <div>
             Importe base de la reparación (sin IVA): <?= sumaReparaciones($reparaciones) ?>€
         </div>
        <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
                        <input type="hidden" name="matricula" value="<?= $matricula ?>">
                        <input type="hidden" name="marca" value="<?= $marca ?>">
                        <input type="hidden" name="modelo" value="<?= $modelo ?>">
                        <?php foreach($reparaciones as $reparacion){ ?>
                        <input type="hidden" name="reparaciones[]" value="<?= $reparacion ?>">
                        <?php } ?>
                <label for="iva">Tipo de IVA:</label>
                    <select name="iva">
                    <option value="0" selected="true">
                        Tipo  de IVA</option>
                    <option value="1.21">Normal(se aplicará un 21%)</option>
                    <option value="1.18">Reducido(se aplicará un 18%)</option>
                </select>
                <br>  
                <br>
                <button type="submit" name="calcularPrecioIVA">Calcular precio con IVA</button>      
                </form>
        <?php $iva = filter_input(INPUT_POST, "iva") ?>
                <div>
                    Total con IVA: <?= sumaReparacionesConIVA($reparaciones, $iva) ?>€
                </div>
        <?php }else { ?>
    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
        <label>Introduce la matrícula:</label><input type="text" name="matricula" value="<?php if(filter_has_var(INPUT_POST, "matricula")) echo filter_input (INPUT_POST, "matricula")?>"><br><br>
        <?php if(!$matricula){ ?>
        <div>
         ERROR: Matrícula no valida   
        </div>
        <?php } ?>
        <label>Introduce una marca:</label><br><br>
                Chrysler <input type="radio" name="marca"  value="Chrysler">
                BMW<input type="radio" name="marca" value="BMW">
                Audi <input type="radio" name="marca"  value="Audi">
                Otro<input type="radio" name="marca" value="Otro"><br><br>
        <label>Introduce el modelo:</label><input type="text" name="modelo" value="<?php if(filter_has_var(INPUT_POST, "modelo")) echo filter_input (INPUT_POST, "modelo")?>"><br><br>
        <?php if(!$modelo){ ?>
        <div>
         ERROR: Modelo no valido   
        </div>
        <?php } ?> 
                        <table style="align: center; text-align: left;" border="1px">
                    <tbody>
                        <tr>
                            <th>Seleccionar</th>
                            <th>Reparacion</th>
                            <th>Precio</th>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="reparaciones[]" value="aceite" <?= in_array("aceite", $reparaciones) ? "checked" : "" ?>></td>
                            <td>Cambio de aceite</td>
                            <td>65€</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="reparaciones[]" value="filtros" <?= in_array("filtros", $reparaciones) ? "checked" : "" ?>></td>
                            <td>Cambio de filtros</td>
                            <td>87€</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="reparaciones[]" value="distribucion" <?= in_array("distribucion", $reparaciones) ? "checked" : "" ?>></td>
                            <td>Correa de distribucion</td>
                            <td>950€</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="reparaciones[]" value="neumaticos" <?= in_array("neumaticos", $reparaciones) ? "checked" : "" ?>></td>
                            <td>Cambio de 2 neumaticos</td>
                            <td>225€</td>
                        </tr>
                    </tbody>
                </table>
                <br>            
                <br>                   
                    <button type="submit" name="calcularPrecio">Calcular precio</button> 
            </form>
        
        <?php } ?>
    <?php } ?>
    </body>
</html>
