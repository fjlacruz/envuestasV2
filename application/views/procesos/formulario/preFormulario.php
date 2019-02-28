<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

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
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">OPERADORAS POR ENCUESTA</h3>
        </div>
        <div class="box-body">
            <input type="hidden" id="id_encuesta" value="<?php echo $id_encuesta ?>">
            <div class="row">

                <div id="cantidades">

                </div>

                <div class='col-lg-3 col-xs-6'>
                    <h3><span class='label label-default'>  L&iacute;mite m&aacute;ximo de encuestas sactifactorias:<?php echo $datos[0][16] + $datos[0][17] + $datos[0][18] + $datos[0][19] ?></span></h3>

                </div>
            </div>
            <div class="col-sm-12">&nbsp;</div>
            <div class="col-sm-12">&nbsp;</div>
            <div class="row">
                <div class="col-md-12">
                    <?php if ($datos[0][0] != 0 || $datos[0][4] != 0 || $datos[0][8] != 0 || $datos[0][12] != 0) { ?>

                        <h5 class="box-title">OPERADORAS POR ENCUESTA NACIONAL</h5>
                        <table class='table tabla_lista'>

                            <thead>
                            <th>OPERADORAS</th>
                            <th>CANT.ASIGNADA/DISPONIBLES </th>
                            <th>M&Aacute;XIMOS </th>
                            <th>EFECTIVAS </th>
                            <th> DESACTIVADOS </th>
                            <th> ELIMINADOS </th>
                            </thead>
                            <tbody>
                                <?php
                                $cantv = $datos[0][0];
                                $cantv_efectivas = $datos[0][1];
                                $cantv_desactivada = $datos[0][2];
                                $cantv_eliminada = $datos[0][3];
                                $digitel = $datos[0][4];
                                $digitel_efectivas = $datos[0][5];
                                $digitel_desactivada = $datos[0][6];
                                $digitel_eliminada = $datos[0][7];
                                $movilnet = $datos[0][8];
                                $movilnet_efectivas = $datos[0][9];
                                $movilnet_desactivada = $datos[0][10];
                                $movilnet_eliminada = $datos[0][11];
                                $movistar = $datos[0][12];
                                $movistar_efectivas = $datos[0][13];
                                $movistar_desactivada = $datos[0][14];
                                $movistar_eliminada = $datos[0][15];
                                $limite_cantv = $datos[0][16];
                                $limite_digitel = $datos[0][17];
                                $limite_movilnet = $datos[0][18];
                                $limite_movistar = $datos[0][19];
                                $cantv_restante = $datos[0][20];
                                $digitel_restante = $datos[0][21];
                                $movilnet_restante = $datos[0][22];
                                $movistar_restante = $datos[0][23];

                                $total = $cantv + $digitel + $movilnet + $movistar;
                                ?>
                                <tr class='text-center'>
                                    <td> CANTV</td>  

                                    <td> 
                                        <?php if ($cantv_restante == 0 || $cantv == 0 || $limite_cantv <= $cantv_efectivas) { ?> 
                                            <?php echo $cantv . "/" . $cantv_restante ?>
                                        <?php } else { ?>
                                            <a href="verEncuesta?&id_encuesta=<?php echo $id_encuesta . "&operadora=" . 1 ?>">
                                                <?php echo $cantv . "/" . $cantv_restante ?>
                                            </a>
                                        <?php } ?>
                                    </td>  
                                    <td> 
                                        <?php echo $limite_cantv ?>

                                    </td> 
                                    <td> 
                                        <?php echo $cantv_efectivas ?>

                                    </td> 
                                    <td> 
                                        <?php echo $cantv_desactivada ?>
                                    </td>  
                                    <td> 
                                        <?php echo $cantv_eliminada ?>
                                    </td>  

                                </tr>
                                <tr class='text-center'>
                                    <td> DIGITEL</td>   
                                    <td>
                                        <?php if ($digitel_restante == 0 || $digitel == 0 || $limite_digitel <= $digitel_efectivas) { ?>
                                            <?php echo $digitel . "/" . $digitel_restante ?>
                                        <?php } else { ?>
                                            <a href="verEncuesta?&id_encuesta=<?php echo $id_encuesta . "&operadora=" . 2 ?>">
                                                <?php echo $digitel . "/" . $digitel_restante ?>
                                            </a>
                                        <?php } ?>
                                    </td> 
                                    <td> 
                                        <?php echo $limite_digitel ?>

                                    </td> 
                                    <td> 
                                        <?php echo $digitel_efectivas ?>

                                    </td>  
                                    <td> 
                                        <?php echo $digitel_desactivada ?>
                                    </td> 
                                    <td>  
                                        <?php echo $digitel_eliminada ?>
                                    </td>  

                                </tr>
                                <tr class='text-center'>
                                    <td> MOVILNET</td>   
                                    <td> 
                                        <?php if ($movilnet_restante == 0 || $movilnet == 0 || $limite_movilnet <= $movilnet_efectivas) { ?>
                                            <?php echo $movilnet . "/" . $movilnet_restante ?>
                                        <?php } else { ?>
                                            <a href="verEncuesta?&id_encuesta=<?php echo $id_encuesta . "&operadora=" . 3 ?>">
                                                <?php echo $movilnet . "/" . $movilnet_restante ?>
                                            </a>
                                        <?php } ?>
                                    </td>   
                                    <td> 
                                        <?php echo $limite_movilnet ?>

                                    </td> 
                                    <td> 
                                        <?php echo $movilnet_efectivas ?>

                                    </td>
                                    <td> 
                                        <?php echo $movilnet_desactivada ?>
                                    </td> 
                                    <td> 
                                        <?php echo $movilnet_eliminada ?>
                                    </td>  

                                </tr>
                                <tr class='text-center'>
                                    <td> MOVISTAR</td>   
                                    <td> 
                                        <?php if ($movistar_restante == 0 || $movistar == 0 || $limite_movistar <= $movistar_efectivas) { ?>
                                            <?php echo $movistar . "/" . $movistar_restante ?>
                                        <?php } else { ?>
                                            <a href="verEncuesta?&id_encuesta=<?php echo $id_encuesta . "&operadora=" . 4 ?>">
                                                <?php echo $movistar . "/" . $movistar_restante ?>
                                            </a>
                                        <?php } ?>
                                    </td>   
                                    <td> 
                                        <?php echo $limite_movistar ?>

                                    </td> 
                                    <td> 
                                        <?php echo $movistar_efectivas ?>

                                    </td> 
                                    <td> 
                                        <?php echo $movistar_desactivada ?>
                                    </td> 
                                    <td> 
                                        <?php echo $movistar_eliminada ?>

                                    </td>  

                                </tr>
                                <tr class='text-center'> 
                                    <td> TOTAL</td>   
                                    <td><?php echo $total ?></td>   
                                    <td><?php echo $limite_movistar + $limite_movilnet + $limite_digitel + $limite_cantv ?></td>   
                                    <td><?php echo $movistar_efectivas + $movilnet_efectivas + $digitel_efectivas + $cantv_efectivas ?></td>   
                                    <td><?php echo $movistar_desactivada + $movilnet_desactivada + $digitel_desactivada + $cantv_desactivada ?></td>   
                                    <td><?php echo $movistar_eliminada + $movilnet_eliminada + $digitel_eliminada + $cantv_eliminada ?></td>   
                                </tr>
                            </tbody> 
                        </table> 
                    </div></div>
            <?php } ?>
            <?php if ($cantidadEstadal[0][0] != 0 || $cantidadEstadal[0][4] != 0 || $cantidadEstadal[0][8] != 0 || $cantidadEstadal[0][12] != 0) { ?>
                <div class="row">
                    <div class="col-md-12">  
                        <h5 class="box-title">OPERADORAS POR ENCUESTA ESTADAL</h4>
                            <table class='table tabla_lista'>

                                <thead>
                                <th>OPERADORAS</th>
                                <th>CANT.ASIGNADA/DISPONIBLES </th>
                                <th>M&Aacute;XIMOS </th>
                                <th>EFECTIVAS </th>
                                <th> DESACTIVADOS </th>
                                <th> ELIMINADOS </th>
                                </thead>
                                <tbody>
                                    <?php
                                    $cantv2 = $cantidadEstadal[0][0];
                                    $cantv_efectivas2 = $cantidadEstadal[0][1];
                                    $cantv_desactivada2 = $cantidadEstadal[0][2];
                                    $cantv_eliminada2 = $cantidadEstadal[0][3];
                                    $digitel2 = $cantidadEstadal[0][4];
                                    $digitel_efectivas2 = $cantidadEstadal[0][5];
                                    $digitel_desactivada2 = $cantidadEstadal[0][6];
                                    $digitel_eliminada2 = $cantidadEstadal[0][7];
                                    $movilnet2 = $cantidadEstadal[0][8];
                                    $movilnet_efectivas2 = $cantidadEstadal[0][9];
                                    $movilnet_desactivada2 = $cantidadEstadal[0][10];
                                    $movilnet_eliminada2 = $cantidadEstadal[0][11];
                                    $movistar2 = $cantidadEstadal[0][12];
                                    $movistar_efectivas2 = $cantidadEstadal[0][13];
                                    $movistar_desactivada2 = $cantidadEstadal[0][14];
                                    $movistar_eliminada2 = $cantidadEstadal[0][15];
                                    $limite_cantv2 = $cantidadEstadal[0][16];
                                    $limite_digitel2 = $cantidadEstadal[0][17];
                                    $limite_movilnet2 = $cantidadEstadal[0][18];
                                    $limite_movistar2 = $cantidadEstadal[0][19];
                                    $cantv_restante2 = $cantidadEstadal[0][20];
                                    $digitel_restante2 = $cantidadEstadal[0][21];
                                    $movilnet_restante2 = $cantidadEstadal[0][22];
                                    $movistar_restante2 = $cantidadEstadal[0][23];

                                    $total2 = $cantv2 + $digitel2 + $movilnet2 + $movistar2;
                                    ?>
                                    <tr class='text-center'>
                                        <td> CANTV</td>  

                                        <td>    
                                            <?php if ($cantv_restante2 == 0 || $cantv2 == 0 || $limite_cantv2 <= $cantv_efectivas2) { ?>
                                                <?php echo $cantv2 . "/" . $cantv_restante2 ?>
                                            <?php } else { ?>
                                                <a href="verEncuesta_estadal?&id_encuesta=<?php echo $id_encuesta . "&operadora=" . 1 ?>">
                                                    <?php echo $cantv2 . "/" . $cantv_restante2 ?>
                                                </a>
                                            <?php } ?>
                                        </td>  
                                        <td> 
                                            <?php echo $limite_cantv2 ?>

                                        </td> 
                                        <td> 
                                            <?php echo $cantv_efectivas2 ?>

                                        </td>  
                                        <td> 
                                            <?php echo $cantv_desactivada2 ?>
                                        </td> 
                                        <td> 
                                            <?php echo $cantv_eliminada2 ?>
                                        </td>  
                                    </tr>
                                    <tr class='text-center'>
                                        <td> DIGITEL</td>   
                                        <td>
                                            <?php if ($digitel_restante2 == 0 || $digitel2 == 0 || $limite_digitel2 <= $digitel_efectivas2) { ?>
                                                <?php echo $digitel2 . "/" . $digitel_restante2 ?>
                                            <?php } else { ?>
                                                <a href="verEncuesta_estadal?&id_encuesta=<?php echo $id_encuesta . "&operadora=" . 2 ?>">
                                                    <?php echo $digitel2 . "/" . $digitel_restante2 ?>
                                                </a>
                                            <?php } ?>
                                        </td> 
                                        <td> 
                                            <?php echo $limite_digitel2 ?>
                                        </td> 
                                        <td> 
                                            <?php echo $digitel_efectivas2 ?>
                                        </td>  
                                        <td> 
                                            <?php echo $digitel_desactivada2 ?>
                                        </td>  
                                        <td> 
                                            <?php echo $digitel_eliminada2 ?>
                                        </td>  
                                    </tr>
                                    <tr class='text-center'>
                                        <td> MOVILNET</td>   
                                        <td> 
                                            <?php if ($movilnet_restante2 == 0 || $movilnet2 == 0 || $limite_movilnet2 <= $movilnet_efectivas2) { ?>
                                                <?php echo $movilnet2 . "/" . $movilnet_restante2 ?>
                                            <?php } else { ?>
                                                <a href="verEncuesta_estadal?&id_encuesta=<?php echo $id_encuesta . "&operadora=" . 3 ?>">
                                                    <?php echo $movilnet2 . "/" . $movilnet_restante2 ?>
                                                </a>
                                            <?php } ?>
                                        </td>   
                                        <td> 
                                            <?php echo $limite_movilnet2 ?>

                                        </td> 
                                        <td> 
                                            <?php echo $movilnet_efectivas2 ?>

                                        </td>  
                                        <td> 
                                            <?php echo $movilnet_desactivada2 ?>
                                        </td>  
                                        <td> 
                                            <?php echo $movilnet_eliminada2 ?>
                                        </td>  
                                    </tr>
                                    <tr class='text-center'>
                                        <td> MOVISTAR</td>   
                                        <td> 
                                            <?php if ($movistar_restante2 == 0 || $movistar2 == 0 || $limite_movistar2 <= $movistar_efectivas2) { ?>
                                                <?php echo $movistar2 . "/" . $movistar_restante2 ?>
                                            <?php } else { ?>
                                                <a href="verEncuesta_estadal?&id_encuesta=<?php echo $id_encuesta . "&operadora=" . 4 ?>">
                                                    <?php echo $movistar2 . "/" . $movistar_restante2 ?>
                                                </a>
                                            <?php } ?>
                                        </td>   
                                        <td> 
                                            <?php echo $limite_movistar2 ?>

                                        </td> 
                                        <td> 
                                            <?php echo $movistar_efectivas2 ?>
                                        </td>  
                                        <td> 
                                            <?php echo $movistar_desactivada2 ?>
                                        </td>  
                                        <td> 
                                            <?php echo $movistar_eliminada2 ?>
                                        </td>  
                                    </tr>

                                    <tr class='text-center'> 
                                        <td> TOTAL</td>   
                                        <td><?php echo $total2 ?></td>   
                                        <td><?php echo $limite_movistar2 + $limite_movilnet2 + $limite_digitel2 + $limite_cantv2 ?></td>   
                                        <td><?php echo $movistar_efectivas2 + $movilnet_efectivas2 + $digitel_efectivas2 + $cantv_efectivas2 ?></td>   
                                        <td><?php echo $movistar_desactivada2 + $movilnet_desactivada2 + $digitel_desactivada2 + $cantv_desactivada2 ?></td>   
                                        <td><?php echo $movistar_eliminada2 + $movilnet_eliminada2 + $digitel_eliminada2 + $cantv_eliminada2 ?></td> 
                                    </tr>
                                </tbody> 
                            </table> 

                            <?php
                        } if ($datos[0][0] == 0 && $datos[0][4] == 0 && $datos[0][8] == 0 && $datos[0][12] == 0 &&
                                $cantidadEstadal[0][0] == 0 && $cantidadEstadal[0][4] == 0 && $cantidadEstadal[0][8] == 0 && $cantidadEstadal[0][12] == 0
                        ) {
                            ?>

                            <div class="col-sm-12">
                                <div class='alert alert-warning alert-dismissable'>
                                    <i class='icon fa fa-warning'></i> Alerta...!    NO HAY NINGUN REGISTRO EN LA BASE DE DATOS
                                </div>
                            </div>
                        <?php } ?>
                </div>
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
            url: "<?php echo base_url() . 'index.php/Formularios/verCantidades/'; ?>",
            data: dataString,
            dataType: 'html',
            success: function(response) {

                $("#cantidades").html(response);
            }

        });
    });
    $(document).ready(function() {
        var id_encuesta = document.getElementById("id_encuesta").value;
        var url = "<?php echo base_url() . 'index.php/Formularios/verCantidades?id_encuesta='; ?>" + id_encuesta;
        var refreshId = setInterval(function() {
            $('#cantidades').load(url); //actualizas el div
        }, 5000);
    });
</script>

<script>
    $(document).ready(function() {

        $('#nueva thead th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" class="form-control text-center"  placeholder="' + title + '" disabled  />');
        }
        );
        // DataTable
        var table = $('#nueva').DataTable({
        });
        //Apply the search
        table.columns().every(function() {
            var that = this;
            $('input', this.header()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that
                            .search(this.value)
                            .draw();
                }
            });
        });
    });

    $(document).ready(function() {
        $('.filterable .btn-filter').click(function() {
            var $panel = $(this).parents('.filterable'),
                    $filters = $panel.find('.filters input'),
                    $tbody = $panel.find('.table tbody');
            if ($filters.prop('disabled') == true) {
                $filters.prop('disabled', false);
                $filters.first().focus();
            } else {
                $filters.val('').prop('disabled', true);
                $tbody.find('.no-result').remove();
                $tbody.find('tr').show();
            }
        });
        $('.filterable .filters input').keyup(function(e) {
            /* Ignore tab key */
            var code = e.keyCode || e.which;
            if (code == '9')
                return;
            /* Useful DOM data and selectors */
            var $input = $(this),
                    inputContent = $input.val().toLowerCase(),
                    $panel = $input.parents('.filterable'),
                    column = $panel.find('.filters th').index($input.parents('th')),
                    $table = $panel.find('.table'),
                    $rows = $table.find('tbody tr');
            /* Dirtiest filter function ever ;) */
            var $filteredRows = $rows.filter(function() {
                var value = $(this).find('td').eq(column).text().toLowerCase();
                return value.indexOf(inputContent) === -1;
            });
            /* Clean previous no-result if exist */
            $table.find('tbody .no-result').remove();
            /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
            $rows.show();
            $filteredRows.hide();
            /* Prepend no-result row if all rows are filtered */
            if ($filteredRows.length === $rows.length) {
                $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="' + $table.find('.filters th').length + '">No se encontraron Registros con ese Parametro</td></tr>'));
            }
        });
    });
</script>

