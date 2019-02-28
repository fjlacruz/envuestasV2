<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<input type="hidden" id="url_respuesta" value="<?php echo base_url() ?>index.php/Encuesta/verDetalle?&id_encuesta=<?php echo $encuesta[0][0] ?>">

<script src="<?php echo base_url(); ?>application/recursos/js/bootbox.js"></script>
<style>
    .modal-header{
        background-color:#dd4b39 !important;
    }
    .modal-title{
        color:#ffffff;
    }

</style>

<section class="content">

    <input type="hidden" id="id_encuesta" value="<?php echo $encuesta[0][0] ?>">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">Estatus de la Encuesta
                    </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div id="cantidades">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Estatus-Tel&eacute;fono-Encuesta/
                <?php echo $encuesta[0][1] ?>

            </h3>
        </div>
        <div class="box-body">

            <div class="row">
                <div class="col-md-12">
                    <?php if ($datos[0][0] != "") { ?>

                        <table id="nueva"  class="display" cellspacing="0" width="100%">
                            <thead>

                            <th>Operadora</th>  
                            <th>Numero</th>   
                            <th>Estatus</th> 
                            <th>Nombres/Apellidos </th>
                            <th>Estado</th> 

                            <tr>
                                <th>Operadora</th>  
                                <th>Numero</th>   
                                <th>Estatus</th> 
                                <th>Nombres/Apellidos </th>
                                <th>Estado</th> 
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($x = 0; $x <= count($datos) - 1; $x++) {

                                    $operadora = $datos[$x][0];
                                    $numero = $datos[$x][1];
                                    $estatus = $datos[$x][2];
                                    $nombres = $datos[$x][3];
                                    $apellidos = $datos[$x][4];
                                    $estado = $datos[$x][5];
                                    ?>

                                    <tr>
                                        <td><?php echo $operadora ?></td>            
                                        <td><?php echo $numero ?></td>        
                                        <td><?php echo $estatus ?></td>   
                                        <td><?php echo $nombres . " " . $apellidos ?></td> 
                                        <td><?php echo $estado ?></td> 
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <button  onclick="history.back()" type="button" class="btn btn-warning">Atras</button>
                    </div>
                <?php } else { ?>
                    <div class="col-sm-12">
                        <div class='alert alert-warning alert-dismissable'>
                            <i class='icon fa fa-warning'></i> Alerta...!    NO HAY NINGUN REGISTRO EN LA BASE DE DATOS
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>

</section>

<script>

    $(document).ready(function() {
        var id = document.getElementById("id_encuesta").value;
        var dataString = 'id_encuesta=' + id;
        $.ajax({
            type: "GET",
            url: "<?php echo base_url() . 'index.php/Encuesta/verCantidades/'; ?>",
            data: dataString,
            dataType: 'html',
            success: function(response) {

                $("#cantidades").html(response);
            }

        });
    });
    $(document).ready(function() {
        var id_encuesta = document.getElementById("id_encuesta").value;
        var url = "<?php echo base_url() . 'index.php/Encuesta/verCantidades?id_encuesta='; ?>" + id_encuesta;
        var refreshId = setInterval(function() {
            $('#cantidades').load(url); //actualizas el div
        }, 5000);
    });


</script>



<script>


    $(document).ready(function() {
        $('#nueva').DataTable({
            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                            .appendTo($(column.header()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                        );
                                column
                                        .search(val ? '^' + val + '$' : '', true, false)
                                        .draw();
                            });
                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            }
        });
    });

</script>

