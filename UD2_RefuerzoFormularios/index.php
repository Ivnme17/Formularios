<?php
require_once './validacionYSaneamiento.php';

$obtenerValores = filter_has_var(INPUT_GET, "dni") && filter_has_var(INPUT_GET, "modulos");

if ($obtenerValores) {
    $dni = validarDNI(filter_input(INPUT_GET, "dni"));
    $modulos = modulosMarcados($_GET["modulos"]);
    $valoresValidados = $dni && $modulos;
}


    ?>
    <!DOCTYPE html>
    <!--
    Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
    Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
    -->
    <html>
        <head>
            <meta charset="UTF-8">
            <title></title>
        </head>
        <body>
<?php if (!$obtenerValores) { ?>
            <form action="<?= $_SERVER["PHP_SELF"] ?>"  method="get">

                <label>Introduce un Dni:
                    <input type="text" name="dni" value="">  
                </label>
                
                <br><br>
                <label>Introduce una afición:</label><br><br>
                <input type="checkbox" name="modulos[]" value="DAW">DAW 
                <input type="checkbox" name="modulos[]" value="DIW">DIW 
                <input type="checkbox" name="modulos[]" value="DWES">DWES 
                <input type="checkbox" name="modulos[]" value="DWEC">DWEC
                <input type="checkbox" name="modulos[]"value="EIE">EIE
                <input type="checkbox" name="modulos[]" value="HLC">HLC
                <br><br>
                <button type="submit">Matricular</button>

            </form>


            <?php
     } 
     else { 
            if ($valoresValidados) { ?>
                <ol>
                    <?php foreach ($modulos as $nombreModulo) { ?>
                        <li><?php echo $nombreModulo ?></li>
                    <?php } ?>
                </ol>
      <?php } 
            else{ ?>
                <form action="<?= $_SERVER["PHP_SELF"] ?>"  method="get">

                    <label>Introduce un Dni:
                        <input type="text" name="dni" value="<?php if (filter_has_var(INPUT_GET, "dni")) echo filter_input(INPUT_GET, "dni") ?>">  
                    </label>
                    <?php if(!$dni){ ?>
                    <div class="dni">
                        El dni no es correcto
                    </div>
                    <?php } ?>              
                   <br><br>
                    <label>Introduce una afición:</label><br><br>
                    <input type="checkbox" name="modulos[]" value="DAW" <?= in_array("DWES",$modulos) ? "checked" : ""  ?> >DAW 
                    <input type="checkbox" name="modulos[]" value="DIW" <?= in_array("DWES",$modulos) ? "checked" : ""  ?> >DIW 
                    <input type="checkbox" name="modulos[]" value="DWES" <?= in_array("DWES",$modulos) ? "checked" : ""  ?> >DWES 
                    <input type="checkbox" name="modulos[]" value="DWEC" <?= in_array("DWES",$modulos) ? "checked" : ""  ?> >DWEC
                    <input type="checkbox" name="modulos[]"value="EIE" <?= in_array("DWES",$modulos) ? "checked" : ""  ?> >EIE
                    <input type="checkbox" name="modulos[]" value="HLC" <?= in_array("DWES",$modulos) ? "checked" : ""  ?> >HLC
                    <br><br>
                    <?php if(!$modulos){ ?>
                    <div class="modulos">
                        Debes de seleccionar al menos un módulo
                    </div>
                    <?php }?>
                    <button type="submit">Matricular</button>

                </form>
      <?php }?>
 <?php } ?>
    </body>
</html>
