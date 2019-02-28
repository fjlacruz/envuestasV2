<style type="text/css">
    .Estilo1 {font-size: 12px}

</style>
<style type="text/css">
    .Estilo2 {font-size: 9px}

</style>
<?php
setlocale(LC_ALL, 'es_VE.UTF-8');
date_default_timezone_set('America/Caracas');

$mes_hoy = array("Enero", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$fecha = date("j") . " de " . $mes_hoy[date("n")] . " de " . date("Y");
?>


<!--===================================================================================================================================================-->
<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<html>
    <body>
    <center>
        <div class="container">            
            <p align="right" class="Estilo1">Caracas,<?php echo $fecha ?></p>
            <p align="center" class="Estilo1"><h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Datos del Proyecto</h3> 
            </p>

            <?php
            foreach ($datos as $direcciones) {
                ?>
                <!--================ Datos del Usuario======================== -->
                </br>
                <p align="center" >
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-success">

                            <div class="panel-body">

                                <div align="justify" class="form-group col-sm-6">
                                    <strong><label>Nombre de Proyecto: </label></strong> 				 
                                    <?php echo $direcciones[1] ?>
                                </div>	
                                <div class="col-sm-12">&nbsp;</div>
                                <div align="justify" class="form-group col-sm-6">
                                    <strong><label>Descripci&oacute;n: </label> </strong>
                                    <?php echo $direcciones[2] ?>
                                </div> 
                                <div class="col-sm-12">&nbsp;</div>						
                                <div align="justify" class="form-group col-sm-12">
                                    <strong><label for="shortname">Coordinaci&oacute;n Responsable:</label></strong>		
                                    <?php echo $direcciones[4] ?>
                                </div>	
                                <div class="col-sm-12">&nbsp;</div>
                                <div align="justify" class="form-group col-sm-6">
                                    <strong><label>Fecha de Inicio: </label></strong> 
                                    <?php echo $direcciones[5] ?>
                                </div> 
                                <div class="col-sm-12">&nbsp;</div>
                                <div align="justify" class="form-group col-sm-6">
                                    <strong><label>Fecha Fin: </label> </strong>                   
                                    <?php echo $direcciones[6] ?>
                                </div>  

                                <?php
                            }
                            ?>		 		 
                        </div>              
                    </div>  
                </div>              
            </div></p>
            <p>&nbsp;</p>
            <!--================ Datos del Equipo ======================== -->
            <div class="row">        
                <div class="col-md-12">
                    <div class="panel panel-success">
                        <div class="panel-heading"> <h3 class="panel-title"> Actividades del Proyecto </h3> </div>
                        <div class="col-sm-12">&nbsp;</div>
                        <div class="panel-body">
                            <!-- <?php
                            //foreach ($datos_coordinacion as $coordinacion) {
                            ?> -->
                            <table  class="table table-bordered" width="640" height="75" border="0">
                                <thead>

                                    <tr bgcolor='#F5F6F8' >
                                        <th class='text-center'>Nombre de la Actividad</th>
                                        <th class='text-center'>Responsable</th>
                                        <th class='text-center'>Fecha de Inicio</th>
                                        <th class='text-center'>Fecha Fin</th>								
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $contar = count($datos_coordinacion) - 1;

                                    for ($x = 0; $x <= $contar; $x++) {
                                        $id_actividad = $datos_coordinacion[$x][0];
                                        $descripcion = $datos_coordinacion[$x][1];
                                        $responsable = $datos_coordinacion[$x][2];
                                        $fecha_inicio = $datos_coordinacion[$x][3];
                                        $fecha_fin = $datos_coordinacion[$x][4];
                                        $nombre_proyec = $datos_coordinacion[$x][9];
                                        $nombre = $datos_coordinacion[$x][10];
                                        $apellido = $datos_coordinacion[$x][11];
                                        //print_r($datos_sistemas)	;					
                                        echo "
                <tr>  
                <td> $descripcion  </td>              
                <td>$nombre  $apellido </td>   
                <td><div class='col-sm-6 '> $fecha_inicio   </div> </td>                 
                <td> <div class='col-sm-6 '> $fecha_fin  </div> </td> 
                </tr>";
                                    }
                                    ?>

                                </tbody>
                            </table>	

                            <!-- <?php
                            //  }
                            ?> -->
                        </div>
                    </div>			
                </div> 
            </div>
            <p>&nbsp;</p>


            <p>&nbsp;</p>


            </body>
            <html>