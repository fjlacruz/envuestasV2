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
            <h3 class="box-title">Agregar Respuestas de la Pregunta Condicionada</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <?php if ($datos2[0][0] != "") { ?>
                        <table class='tabla_lista' >

                            <thead>
                            <th>Respuesta</th>
                            <th>Modificar</th>
                            <th>Estatus</th>
                            </thead>
                            <tbody>
                                <?php
                                for ($x = 0; $x <= count($datos2) - 1; $x++) {
                                    $id_subrespuesta = $datos2[$x][0];
                                    $id_respuesta = $datos2[$x][1];
                                    $id_pregunta = $datos2[$x][2];
                                    $id_encuesta = $datos2[$x][3];
                                    $sub_respuesta = $datos2[$x][4];
                                    $fecha_registro = $datos2[$x][5];
                                    $id_usuario = $datos2[$x][6];
                                    $estatus = $datos2[$x][7];
                                    ?>
                                    <tr> 
                                        <td> <?php echo $sub_respuesta ?> </td>   
                                        <td>
                                            <button type="button" data-id="<?php echo $id_subrespuesta ?>" class="btn bg-purple btn-xs editButton" title="Desea Modificar o Deshabilitar La Sub-Respuesta" >
                                                <span class="fa  fa-pencil-square-o"></span>
                                            </button>
                                        </td> 
                                        <td> <?php echo $estatus ?> </td>   
                                    </tr>
                                <?php } ?>
                            </tbody> 
                        </table> 

                        <form id="userForm" method="post" class="form-horizontal" style="display: none;">
                            <div class="col-sm-12">&nbsp;</div>
                            <input type="hidden"  id="id" name="id" >

                            <div class="form-group">

                                <div class="col-sm-12">
                                    <label>Sub Repuestas Condicionadas</label> 
                                    <input type="text" class="form-control text-uppercase" name="respuesta2" id="respuesta2" placeholder="Respuesta" />
                                </div>


                                <div class="col-sm-12">&nbsp;</div>


                                <div class="col-sm-12">
                                    <label>Estatus de la Respuesta</label>
                                    <select name="estatus" id="estatus"  class="form-control " required >
                                        <option value="1">HABILITAR</option>
                                        <option value="0">DESHABILITAR</option>
                                    </select>
                                </div>


                                <div class="col-sm-12">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-5 col-xs-offset-3">
                                    <button type="submit" class="btn btn-success">Actualizar</button>
                                </div>
                            </div>
                        </form>
                    <?php } ?>


                    <div class="col-sm-12">&nbsp;</div>


                    <form id="formulario" method="post" class="form-horizontal" action="">
                        <div id="resultado"></div>
                        <input type="hidden" id="id_respuesta"  value='<?php echo $datos[0][0] ?>' name="id_respuesta" >
                        <input type="hidden" id="id_pregunta"  value='<?php echo $datos[0][1] ?>' name="id_pregunta" >
                        <input type="hidden" id="id_encuesta"  value='<?php echo $datos[0][2] ?>' name="id_encuesta" >

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">&nbsp;</div>
                                <div class="col-sm-5">
                                    <label>Respuesta</label> 
                                    <input type="text" class="form-control text-uppercase" name="respuesta[]" id="respuesta" placeholder="Respuesta" />
                                </div>

                                <div class="col-sm-1">
                                    <label>Agregar</label> 
                                    <button type="button" class="btn btn-primary addButton">+</button>
                                </div>
                                <div class="col-sm-3">&nbsp;</div>

                            </div>
                        </div>

                        <!--=============================== Fila que se Clona =========================== -->
                        <div class="form-group hide" id="bookTemplate">

                            <div class="row">
                                <div class="col-sm-3">&nbsp;</div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control text-uppercase" name="respuesta[]" id="respuesta" placeholder="Respuesta" />
                                </div>

                                <div class="col-sm-1">
                                    <button type="button" class="btn btn-danger removeButton">-</button>
                                </div>
                                <div class="col-sm-3">&nbsp;</div>
                            </div> 
                        </div>
                        <div class='col-md-12'>
                            <button  onclick="history.back()" type="button" class="btn btn-warning">Atras</button>
                            <button type="" id="guardar" class="btn btn-success">Guardar</button>
                        </div>
                    </form> 
                </div> 
            </div>  
        </div>   
    </div>  

    <div class="box box-danger collapsed-box">
        <div class="box-header with-border">
            <h3 class="box-title">Sub Respuestas Condicionadas</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
            </div>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <?php if ($datos3[0][0] != "") { ?>
                        <div class='filterable'>
                            <div class='panel-heading'>
                                <div class='pull-right'>
                                    <button class='btn btn-danger btn-xs btn-filter' title='Realizar Consultas Cruzadas' >
                                        <span class='fa fa-filter'></span>Filtrar</button>
                                </div>
                            </div>
                            <form id="formulario2" method="post">
                             <input type="hidden" id="id_respuesta"  value='<?php echo $datos[0][0] ?>' name="id_respuesta" >
                        <input type="hidden" id="id_pregunta"  value='<?php echo $datos[0][1] ?>' name="id_pregunta" >
                        <input type="hidden" id="id_encuesta"  value='<?php echo $datos[0][2] ?>' name="id_encuesta" >


                                <table id="nueva" class="display" cellspacing="0" width="100%" >
                                    <thead>
                                        <tr class="filters">
                                            <th style="display:none" >id</th>  
                                            <th onkeypress="return soloLetras(event)" >Respuestas</th>   
                                            <th onkeypress="return soloLetras(event)">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        for ($x = 0; $x < count($datos3); $x++) {

                                            $id_subrespuesta2 = $datos3[$x][0];
                                            $id_respuesta2 = $datos3[$x][1];
                                            $id_pregunta2 = $datos3[$x][2];
                                            $id_encuesta2 = $datos3[$x][3];
                                            $sub_respuesta2 = $datos3[$x][4];
                                            $fecha_registro2 = $datos3[$x][5];
                                            $id_usuario2 = $datos3[$x][6];
                                            $estatus2 = $datos3[$x][7];
                                            ?>

                                            <tr class="text-center">
                                                <td style="display:none"><?php echo $id_subrespuesta2 ?></td> 
                                                <td ><?php echo $sub_respuesta2 ?></td>            

                                                <td> 
                                                    <div class="form-group">
                                                        <label class="btn btn-info btn-xs"> 
                                                            <input type="checkbox" id="respuesta2" name="respuesta[]"  value="<?php echo $sub_respuesta2 ?>">
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?> 
                                    </tbody>
                                </table>
                                <div id="resultado4"></div>
                                <div class="col-sm-12">&nbsp;</div>
                                <div class="col-sm-12">&nbsp;</div>

                                <div class='col-md-12'>
                                    <button  onclick="history.back()" type="button" class="btn btn-warning">Atras</button>
                                    <button type="button" id="tabla" class="btn btn-success">Guardar</button> 
                                </div> 
                            </form>

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

<script type="text/javascript">
    $(document).ready(function() {

        $("#tabla").click(function() {
            $("#formulario2").click(function() {
                $.ajax({
                    data: $(this).serialize(),
                    url: "<?php echo base_url() . 'index.php/Encuesta/insertarSub_tabla'; ?>",
                    type: "POST",
                    success: function(respuesta) {

                        $("#resultado4").html("<div class='alert alert-success alert-dismissable'>\n\
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>\n\
<i class='icon fa fa-check'></i> Suceso..!Los Datos Fueron registrados Exitosamente</div>");
                    }
                });
                setInterval(function() {
                    location.reload();
                }, 3000);
            });
        });
    });
</script>

<script type="text/javascript">

    $(document).ready(function() {
        $('#userForm')
                .formValidation({
                    framework: 'bootstrap',
                    fields: {
                        nombres: {
                        },
                        apellidos: {
                        },
                        estatus: {
                        },
                        rol: {
                        }
                    }
                })
                .on('success.form.fv', function(e) {
                    // Save the form data via an Ajax request
                    e.preventDefault();
                    var $form = $(e.target),
                            id = $form.find('[name="id"]').val();
                    // The url and method might be different in your application

                    $.ajax({
                        url: "<?php echo base_url() . 'index.php/Encuesta/actualizar_subrespuesta'; ?>",
                        method: 'POST',
                        data: $form.serialize()
                    }).success(function(response) {

                        $form.parents('.bootbox').modal('hide');
                        $.confirm({
                            title: 'Alerta!',
                            content: 'Estatus Actualizado',
                            type: 'red',
                            typeAnimated: true,
                            buttons: {
                                tryAgain: {
                                    text: 'Cerrar',
                                    btnClass: 'btn-red',
                                    action: function() {
                                        location.reload();
                                    }
                                }
                            }
                        });

                    });
                });
        $('.editButton').on('click', function() {
            // Get the record's ID via attribute
            var id = $(this).attr('data-id');
            $.ajax({
                url: "<?php echo base_url() . 'index.php/Encuesta/consultar_subrespuesta/'; ?>" + id,
                method: 'GET'

            }).success(function(data) {
                // Populate the form fields with the data returned from server

                var obj = JSON.parse(data);
                $('#userForm')
                        .find('[name="id"]').val(obj.id_subrespuesta).end()
                        .find('[name="respuesta2"]').val(obj.sub_respuesta).end()
                        .find('[name="estatus"]').val(obj.estatus).end();

                // Show the dialog
                bootbox
                        .dialog({
                            title: 'Editar la Respuesta',
                            message: $('#userForm'),
                            show: false // We will show it manually later
                        })
                        .on('shown.bs.modal', function() {
                            $('#userForm')
                                    .show()                             // Show the login form
                                    .formValidation('resetForm'); // Reset form
                        })
                        .on('hide.bs.modal', function(e) {
                            // Bootbox will remove the modal (including the body which contains the login form)
                            // after hiding the modal
                            // Therefor, we need to backup the form
                            $('#userForm').hide().appendTo('body');
                        })
                        .modal('show');
            });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#guardar").click(function() {
            var dataUser = {
                "respuesta": $("#respuesta").val()
            };
            //validamos que no quede ningun campo vacio
            if (dataUser.respuesta === '') {

                // mensaje en caso de que exista un campo vacio del formulario
                $("#resultado").html("<div class='alert alert-warning alert-dismissable'>\n\
    <button type='button' class='close' data-dismiss='alert'>&times;</button>\n\
<i class='icon fa fa-warning'></i> Alerta...! Informacion Incompleta, debe llenar todos los campos....</div>");
                //En caso contrario que no hayan campos vacios enviamos los parametros por ajax
            } else {
                $("#formulario").submit(function() {
                    $.ajax({
                        url: "<?php echo base_url() . 'index.php/Encuesta/insertarSub'; ?>",
                        type: "POST",
                        data: $(this).serialize(),
                        beforeSend: function() {
                            $("#resultado2").show();
                            $("#resultado2").html('<div><?php echo '<img width="2%" src="' . base_url() . 'application/recursos/imagenes/ajax-loader_1.gif">'; ?></div>');
                        },
                        //Despues de enviar los datos limpiamos los campos del formulario
                        success: function(respuesta) {
                            // Enviamos un mensaje de exito al insertar los datos
                            $("#resultado").html("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='icon fa fa-check'></i> Suceso..!Los Datos Fueron registrados Exitosamente</div>");


                        }
                    });
                    setInterval(function() {
                        location.reload();
                    }, 3000);
                });
            }
        });
    });
</script>

<script type="text/javascript">

    $(document).ready(function() {

        $('#formulario').formValidation({
            framework: 'bootstrap',
            fields: {
                'respuesta[]': {
                    // The task is placed inside a .col-xs-6 element
                    row: '.col-sm-10',
                    validators: {
                    }
                }

            }
        }).on('click', '.addButton', function() {
            var $template = $('#bookTemplate'),
                    $clone = $template
                    .clone()
                    .removeClass('hide')
                    .removeAttr('id')
                    .insertBefore($template);
            // Add new fields
            // Note that we DO NOT need to pass the set of validators
            // because the new field has the same name with the original one
            // which its validators are already set
            $('#formulario')
                    .formValidation('addField', $clone.find('[name="respuesta[]"]'));

        })
                // Remove button click handler
                .on('click', '.removeButton', function() {
                    var $row = $(this).closest('.form-group');
                    // Remove fields
                    $('#formulario')
                            .formValidation('removeField', $row.find('[name="respuesta[]"]'));
                    // Remove element containing the fields
                    $row.remove();
                });

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