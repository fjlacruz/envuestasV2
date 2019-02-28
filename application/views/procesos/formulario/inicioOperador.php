<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<input type="hidden" id="url_respuesta" value="<?php echo base_url() ?>index.php/Formularios/operador?&id=<?php echo $id_encuesta ?>">


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
            <h3 class="box-title">Formulario de Encuestas</h3>
        </div>
        <div class="box-body">
            <input type="hidden" id="id_encuesta" value="<?php echo $id_encuesta ?>">
            <div class="row">

                <div id="cantidades">

                </div>

            </div>


            <div class="row">
                <div class="col-md-12">

                    <?php if ($datos[0][0] != "") { ?>
                        <div class='filterable'>
                            <div class='panel-heading'>
                                <div class='pull-right'>
                                    <button class='btn btn-danger btn-xs btn-filter' title='Realizar Consultas Cruzadas'>
                                        <span class='fa fa-filter'></span>Filtrar</button>
                                </div>
                            </div>


                            <table id="nueva" class="table" >
                                <thead>
                                    <tr class="filters">
                                        <th style="display:none" onkeypress="return soloLetras(event)" >id</th>    
                                        <th onkeypress="return soloLetras(event)">Fecha de Registro</th>  
                                        <th onkeypress="return soloLetras(event)">Nombre de Encuesta</th>   
                                        <th onkeypress="return soloLetras(event)">Descripcion de la Encuesta</th> 
                                        <th>Acciones</th>        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($x = 0; $x <= count($datos) - 1; $x++) {
                                        $id_encuesta = $datos[$x][0];
                                        $nombre = $datos[$x][1];
                                        $descripcion = $datos[$x][2];
                                        $numero = $datos[$x][3];
                                        $fecha_registro = $datos[$x][4];
                                        $id_usuario = $datos[$x][5];
                                        $id_operadora = $datos[$x][6];
                                        ?>

                                        <tr>
                                            <td style="display:none"><?php echo $id_encuesta ?></td>   
                                            <td><?php echo $fecha_registro ?></td>            
                                            <td><?php echo $nombre ?></td>        
                                            <td><?php echo $descripcion ?></td>   

                                            <td>
                                                <a href="verFormularioOperador?&id=<?php echo $id_encuesta . "&numero=" . $numero . "&id_operadora=" . $id_operadora ?>">
                                                    <button type='button' class='btn btn-success btn-xs' title="Ir a la Encuesta">
                                                        <span class='fa fa-search'></span>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>

                        <div class="col-sm-12">&nbsp;</div>
                        <div class="col-sm-12">&nbsp;</div>
                        <div class="col-sm-12">&nbsp;</div>

                        <div class="col-sm-12">
                            <div class='alert alert-warning alert-dismissable'>
                                <i class='icon fa fa-warning'></i> Alerta...!    NO HAY NINGUN REGISTRO EN LA BASE DE DATOS
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <button   type="button" id="atras" class="btn btn-warning">Atras</button>
            </div>
        </div>
    </div>
</section>
<script>

    $("#atras").click(function() {
        setInterval(function() {
            window.location.href = $("#url_respuesta").val();
        }, 1500);
    });

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
    });</script>
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

