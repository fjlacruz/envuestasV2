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
<?php
$variablesSesion = $this->session->userdata('usuario');
$rol = ($variablesSesion['rol']);
?>

<section class="content">
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Resultados de Encuestas</h3>
        </div>
        <div class="box-body">
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
                                        <th  onkeypress="return soloLetras(event)" >id</th> 

                                        <th onkeypress="return soloLetras(event)" >Nombre de Encuesta</th>   
                                        <th>Acciones</th>   
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($x = 0; $x <= count($datos) - 1; $x++) {


                                        $id_encuesta = $datos[$x][0];
                                        $nombre = $datos[$x][1];
                                        $id_pregunta = $datos[$x][2];
                                        $pregunta = $datos[$x][3];
                                        $id_respuesta = $datos[$x][4];
                                        $respuesta = $datos[$x][5];
                                        $id_sub_respuesta = $datos[$x][6];
                                        $sub_respuesta = $datos[$x][7];
                                        $id_operadora = $datos[$x][8];
                                        $numero = $datos[$x][9];
                                        $operador = $datos[$x][10];
                                        ?>

                                        <tr>
                                            <td ><?php echo $id_encuesta ?></td>  

                                            <td><?php echo $nombre ?></td>        
                                            <td>
                                                <a href="verDetalles?&id_encuesta=<?php echo $id_encuesta ?>">
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

        $('#nueva thead th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" class="form-control text-center"  placeholder="' + title + '" disabled  />');
        }
        );
        // DataTable
        var table = $('#nueva').DataTable({
            "scrollY": "500px",
            "scrollCollapse": true,
            "paging": false,
            retrieve: true
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

