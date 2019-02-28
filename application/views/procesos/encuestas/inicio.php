<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<script src="<?php echo base_url(); ?>application/recursos/js/bootbox.js"></script>
<style>

    .modal-dialog{
        width: 700px
    }

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
            <h3 class="box-title">Encuestas</h3>
        </div>
        <div class="box-body">


            <div><button type="submit" class="btn btn-primary" data-target='#modal' data-toggle='modal'>Nueva Encuesta</button>
            </div>


            <div class="modal fade" id="modal" >
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-red">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4>Crear Encuesta </h4>
                        </div>
                        <div class="modal-body">
                            <form id="insertar" action="" method="post">
                                <div id="resultado"></div>
                                <div class="form-group">
                                    <div class="row">

                                        <div class="col-sm-6">
                                            <label>Nombre de la Encuesta</label> 
                                            <input type="text" class="form-control text-uppercase" name="nombre" id="nombre" placeholder="Nombre de la Encuesta" />
                                        </div>

                                        <div class="col-sm-6">
                                            <label>Descripci&oacute;n</label> 
                                            <textarea class="form-control text-uppercase" name="descripcion" id="descripcion" placeholder="Descripcion de la Encuesta" ></textarea>
                                        </div>

                                    </div>
                                    <div class="col-sm-12">&nbsp;</div>
                                    <div class="col-sm-12">&nbsp;</div>
                                    <div class="row">

                                        <div class="col-sm-3">
                                            <label>Limite Cantv</label> 
                                            <input type="text" class="form-control" name="cantv" id="cantv" onKeyPress="return soloNumeros(event)" >
                                        </div>

                                        <div class="col-sm-3">
                                            <label>Limite Digitel</label> 
                                            <input class="form-control " name="digitel" id="digitel" onKeyPress="return soloNumeros(event)">
                                        </div>

                                        <div class="col-sm-3">
                                            <label>Limite Movistar</label>  
                                            <input type="text" class="form-control " name="movistar" id="movistar" onKeyPress="return soloNumeros(event)" >
                                        </div>

                                        <div class="col-sm-3">
                                            <label>Limite Movilnet</label> 
                                            <input class="form-control " name="movilnet" id="movilnet" onKeyPress="return soloNumeros(event)" >
                                        </div>
                                    </div>

                                    <div class="col-sm-12">&nbsp;</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="button" id="guardarModal"  class="btn btn-danger">Guardar</button>
                                </div>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">&nbsp;</div>
            <div class="col-sm-12">&nbsp;</div>
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


                            <table id="nueva" class="display" cellspacing="0" width="100%" >
                                <thead>
                                    <tr class="filters">
                                        <th style="display:none" onkeypress="return soloLetras(event)" >id</th>  
                                        <th>Fecha/Registro</th>  
                                        <th onkeypress="return soloLetras(event)" >Nombre de Encuesta</th>   
                                        <th onkeypress="return soloLetras(event)" >Descripci&oacute;n de la Encuesta</th> 
                                        <th>Cantv</th> 
                                        <th>Digitel</th> 
                                        <th>Movistar</th> 
                                        <th>Movilnet</th> 
                                        <th onkeypress="return soloLetras(event)">Total</th>
                                        <th>Acciones</th>        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total = 0;
                                    for ($x = 0; $x <= count($datos) - 1; $x++) {
                                        $id_encuesta = $datos[$x][0];
                                        $nombre = $datos[$x][1];
                                        $descripcion = $datos[$x][2];
                                        $fecha_registro = $datos[$x][3];
                                        $id_usuario = $datos[$x][4];
                                        $estatus = $datos[$x][5];
                                        $limite_cantv = $datos[$x][6];
                                        $limite_digitel = $datos[$x][7];
                                        $limite_movistar = $datos[$x][8];
                                        $limite_movilnet = $datos[$x][9];

                                        $total = $limite_cantv + $limite_digitel + $limite_movistar + $limite_movilnet;
                                        $array = array();
                                        $array[0] = $id_encuesta;

                                        $existe_preguntas = $this->Pgsql->SELECTPLSQL('consultar_formulario_encuesta', $array);
                                        $existe_numeros = $this->Pgsql->SELECTPLSQL('existe_asignacion_telefonica', $array);

                                        $vars = $this->Pgsql->SELECTPLSQL('limite_cantidad', $array);

                                        $cantv_efectiva = $vars[0][0];
                                        $digitel_efectiva = $vars[0][1];
                                        $movilnet_efectiva = $vars[0][2];
                                        $movistar_efectiva = $vars[0][3];
                                        ?>
                                        <tr class="text-center">
                                            <td style="display:none"><?php echo $id_encuesta ?></td> 
                                            <td><?php echo $fecha_registro ?></td>            
                                            <td><?php echo $nombre ?></td>        
                                            <td><?php echo $descripcion ?></td> 
                                            <td><?php echo $limite_cantv ?></td> 
                                            <td><?php echo $limite_digitel ?></td> 
                                            <td><?php echo $limite_movistar ?></td> 
                                            <td><?php echo $limite_movilnet ?></td> 
                                            <td><?php echo $total ?></td> 
                                            <td class="col-sm-2" >
                                                <a href="agregar_pregunta?&id=<?php echo $id_encuesta ?>">
                                                    <button type='button' class='btn btn-primary btn-xs' title="Agregar Preguntas">
                                                        <span class='fa  fa-plus'></span>
                                                    </button>
                                                </a>
                                                <?php if ($existe_preguntas[0][0] != "") { ?>
                                                    <a href = "../Asignaciones/asignar_numeros?&id=<?php echo $id_encuesta ?>">
                                                        <button type = 'button' class = 'btn bg-olive btn-xs' title = "Agregar Numeros Telefonicos">
                                                            <span class = 'fa fa-phone'></span>
                                                        </button>
                                                    </a>
                                                <?php } ?>
                                                <?php //if ($existe_numeros[0][0] != 0) {   ?>
        <!--                                                    <a href = "../Asignaciones/asignar_operadores?&id=<?php echo $id_encuesta ?>">
        <button type = 'button' class = 'btn bg-maroon  btn-xs' title = "Agregar Numeros Telefonicos">
        <span class = 'fa fa-users'></span>
        </button>
        </a>-->
                                                <?php //}    ?>
                                                <a href="verDetalle?&id_encuesta=<?php echo $id_encuesta ?>">
                                                    <button type='button' class='btn btn-success btn-xs' title="Ver Detalles">
                                                        <span class='fa fa-search'></span>
                                                    </button>
                                                </a>

                                                <?php if ($cantv_efectiva >= $limite_cantv && $digitel_efectiva >= $limite_digitel && $movilnet_efectiva >= $limite_movilnet && $movistar_efectiva >= $limite_movistar) { ?>


                                                    <button type = "button" data-id = "<?php echo $id_encuesta ?>" class = "btn bg-purple btn-xs editButton" title = "Desea Modificar o Deshabilitar La Encuesta" >
                                                        <span class = "fa  fa-pencil-square-o"></span>
                                                    </button>
                                                <?php } ?>
                                                <button type = "button" data-id = "<?php echo $id_encuesta ?>" class = "btn bg-orange btn-xs editButton2" title="Duplicar Encuesta" >
                                                    <span class = "fa  fa-object-group"></span>
                                                </button>

                                                </a>
                                            </td>

                                        </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                            <form id="userForm2" method="post" class="form-horizontal" style="display: none;">
                                <div class="col-sm-12">&nbsp;</div>
                                <input type="hidden"  id="id_encuesta" name="id_encuesta" >

                                <div class="form-group">
                                    <div class="col-sm-12"> <label>DESEA DUPLICAR LA ENCUESTA?</label></div>
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-block btn-success btn-lg">SI</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <button type='button' class='btn btn-block btn-warning btn-lg' data-dismiss='modal'>NO</button>
                                    </div>
                                </div>
                            </form>

                            <form id="userForm" method="post" class="form-horizontal" style="display: none;">
                                <div class="col-sm-12">&nbsp;</div>
                                <input type="hidden"  id="id" name="id" >

                                <div class="form-group">

                                    <div class="col-sm-6">
                                        <label>Nombre de la Encuesta</label> 
                                        <input type="text" class="form-control text-uppercase" name="nombre" id="nombre"  />
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Descripcion</label> 
                                        <textarea class="form-control text-uppercase" name="descripcion" id="descripcion" ></textarea>
                                    </div>

                                    <div class="col-sm-12">&nbsp;</div>


                                    <div class="col-sm-3">
                                        <label>Limite Cantv</label> 
                                        <input type="text" class="form-control" name="cantv" id="cantv" onKeyPress="return soloNumeros(event)" >
                                    </div>

                                    <div class="col-sm-3">
                                        <label>Limite Digitel</label> 
                                        <input class="form-control " name="digitel" id="digitel" onKeyPress="return soloNumeros(event)">
                                    </div>

                                    <div class="col-sm-3">
                                        <label>Limite Movistar</label>  
                                        <input type="text" class="form-control " name="movistar" id="movistar" onKeyPress="return soloNumeros(event)" >
                                    </div>

                                    <div class="col-sm-3">
                                        <label>Limite Movilnet</label> 
                                        <input class="form-control " name="movilnet" id="movilnet" onKeyPress="return soloNumeros(event)" >
                                    </div>
                                    <div class="col-sm-12">&nbsp;</div>
                                    <div class="col-sm-6">
                                        <label>Estatus de la Encuesta</label>
                                        <select name="estatus" id="estatus"  class="form-control " required >
                                            <option value="1">HABILITAR</option>
                                            <option value="0">DESHABILITAR</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-12">&nbsp;</div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success">Actualizar</button>
                                    </div>
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
        $('#userForm2')
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
                            id = $form.find('[name="id_encuesta"]').val();
                    // The url and method might be different in your application
                    $.ajax({
                        url: "<?php echo base_url() . 'index.php/Encuesta/duplicar'; ?>",
                        method: 'POST',
                        data: $form.serialize()
                    }).success(function(response) {

                        $form.parents('.bootbox').modal('hide');
                        $.confirm({
                            title: 'Alerta!',
                            content: 'Encuesta Duplicada',
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
        $('.editButton2').on('click', function() {
            // Get the record's ID via attribute
            var id = $(this).attr('data-id');
            $.ajax({
                url: "<?php echo base_url() . 'index.php/Encuesta/consultar_encuesta/'; ?>" + id,
                method: 'GET'

            }).success(function(data) {
                // Populate the form fields with the data returned from server

                var obj = JSON.parse(data);
                $('#userForm2')
                        .find('[name="id_encuesta"]').val(obj.id_encuesta).end();

                // Show the dialog
                bootbox
                        .dialog({
                            title: 'Duplicar la Encuesta',
                            message: $('#userForm2'),
                            show: false // We will show it manually later
                        })
                        .on('shown.bs.modal', function() {
                            $('#userForm2')
                                    .show()                             // Show the login form
                                    .formValidation('resetForm'); // Reset form
                        })
                        .on('hide.bs.modal', function(e) {
                            // Bootbox will remove the modal (including the body which contains the login form)
                            // after hiding the modal
                            // Therefor, we need to backup the form
                            $('#userForm2').hide().appendTo('body');
                        })
                        .modal('show');
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
                        url: "<?php echo base_url() . 'index.php/Encuesta/actualizar_encuesta'; ?>",
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
                url: "<?php echo base_url() . 'index.php/Encuesta/consultar_encuesta/'; ?>" + id,
                method: 'GET'

            }).success(function(data) {
                // Populate the form fields with the data returned from server

                var obj = JSON.parse(data);
                $('#userForm')
                        .find('[name="id"]').val(obj.id_encuesta).end()
                        .find('[name="nombre"]').val(obj.nombre).end()
                        .find('[name="descripcion"]').val(obj.descripcion).end()
                        .find('[name="cantv"]').val(obj.limite_cantv).end()
                        .find('[name="digitel"]').val(obj.limite_digitel).end()
                        .find('[name="movistar"]').val(obj.limite_movilnet).end()
                        .find('[name="movilnet"]').val(obj.limite_movistar).end()
                        .find('[name="estatus"]').val(obj.estatus).end();




                // Show the dialog
                bootbox
                        .dialog({
                            title: 'Editar la Encuesta',
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

<script>
    $(document).ready(function() {
        $("#guardarModal").click(function() {
            var dataUser = {
                "nombre": $("#nombre").val(),
                "descripcion": $("#descripcion").val(),
                "cantv": $("#cantv").val(),
                "digitel": $("#digitel").val(),
                "movistar": $("#movistar").val(),
                "movilnet": $("#movilnet").val()
            };

            //validamos que no quede ningun campo vacio
            if (dataUser.nombre === '' || dataUser.descripcion === '') {

                // mensaje en caso de que exista un campo vacio del formulario
                $("#resultado").html("<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='icon fa fa-warning'></i> Alerta...! Informacion Incompleta, debe llenar todos los campos....</div>");
                //En caso contrario que no hayan campos vacios enviamos los parametros por ajax
            } else {
                $.ajax({
                    url: "<?php echo base_url() . 'index.php/Encuesta/insertarEncuesta'; ?>",
                    type: "POST",
                    data: dataUser,
                    beforeSend: function() {
                        $("#resultado").show();
                        $("#resultado").html('<div><?php echo '<img width="2%" src="' . base_url() . 'application/recursos/imagenes/ajax-loader_1.gif">'; ?></div>');
                    },
                    //Despues de enviar los datos limpiamos los campos del formulario
                    success: function(respuesta) {
                        // Enviamos un mensaje de exito al insertar los datos
                        $("#resultado").html("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='icon fa fa-check'></i> Suceso..!Los Datos Fueron registrados Exitosamente</div>");
                        //Redirijimos luego de enviar los datos 
                        setInterval(function() {
                            location.reload();
                        }, 3000); //Lo temporizamos a 3 segundos para mostrar el mensaje al usuario
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function() {

        $('#guardarModal').formValidation({
            framework: 'bootstrap',
            fields: {
                nombre: {
                    row: '.col-sm-6',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                descripcion: {
                    row: '.col-sm-6',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                }

            }
        });
    });


    function soloNumeros(e)
    {
        var key = window.Event ? e.which : e.keyCode
        return ((key >= 48 && key <= 57) || (key == 8))
    }
</script>
