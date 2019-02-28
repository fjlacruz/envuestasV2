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

    <div class="box box-danger ">
        <div class="box-header with-border">
            <h3 class="box-title">Preguntas en la Encuesta</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div><button type="submit" class="btn btn-primary" data-target='#modal' data-toggle='modal'>Crear Preguntas</button>
                    </div>
                    <div class="modal fade" id="modal" >
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-red">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <form id="insertar" action="" method="post">
                                        <div id="resultado"></div>
                                        <div class="form-group">
                                            <input type="hidden" name="id" id="id" value="<?php echo $id ?>" >

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <label>Pregunta</label> 
                                                        <input type="text" class="form-control text-uppercase" name="pregunta[]" id="pregunta" placeholder="Pregunta" />
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <label>Tipo de Pregunta</label> 
                                                        <select name="tipo[]" id="tipo"  class="form-control " >
                                                            <option value="">Seleccione...</option>
                                                            <option value="SIMPLE">SIMPLE</option>
                                                            <option value="MULTIPLE">MULTIPLE</option>
                                                            <option value="CONDICIONADA">CONDICIONADA</option>

                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label>Categoria de la Pregunta</label> 
                                                        <select name="categoria[]" id="categoria"  class="form-control " >
                                                            <option value="">Seleccione...</option>
                                                            <option value="CULTURA">CULTURA</option>
                                                            <option value="DEPORTE">DEPORTE</option>
                                                            <option value="ECONOMIA">ECONOMIA</option>
                                                            <option value="RELIGION">RELIGION</option>
                                                            <option value="SOCIAL">SOCIAL</option>
                                                            <option value="POLITICA">POLITICA</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <label>Agregar</label> 
                                                        <button type="button" class="btn btn-primary addButton" >+</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--=============================== Fila que se Clona =========================== -->
                                            <div class="form-group hide" id="bookTemplate">
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <input type="text" class="form-control text-uppercase" name="pregunta[]" id="pregunta" placeholder="Pregunta" />
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <select name="tipo[]" id="tipo"  class="form-control "  >
                                                            <option value="">Seleccione...</option>
                                                            <option value="SIMPLE">SIMPLE</option>
                                                            <option value="MULTIPLE">MULTIPLE</option>
                                                            <option value="CONDICIONADA">CONDICIONADA</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <select name="categoria[]" id="categoria"  class="form-control "  >
                                                            <option value="">Seleccione...</option>
                                                            <option value="CULTURA">CULTURA</option>
                                                            <option value="DEPORTE">DEPORTE</option>
                                                            <option value="ECONOMIA">ECONOMIA</option>
                                                            <option value="RELIGION">RELIGION</option>
                                                            <option value="SOCIAL">SOCIAL</option>
                                                            <option value="POLITICA">POLITICA</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" class="btn btn-danger removeButton" >-</button>
                                                    </div>
                                                </div> 
                                            </div> 

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                            <button type="" id="guardarModal"  class="btn btn-danger">Guardar</button>
                                        </div>
                                    </form> 
                                </div>
                            </div>
                        </div>
                    </div> 
                </div> 
            </div>
            <div class="col-sm-12">&nbsp;</div>
            <div class="col-sm-12">&nbsp;</div>
            <div class="row">
                <div class="col-md-12">
                    <?php if ($datos2[0][0] != "") { ?>
                        <div class='filterable'>
                            <div class='panel-heading'>
                                <div class='pull-right'>
                                    <button class='btn btn-danger btn-xs btn-filter' title='Realizar Consultas Cruzadas' >
                                        <span class='fa fa-filter'></span>Filtrar</button>
                                </div>
                            </div>

                            <table id="nueva2" class="display" cellspacing="0" width="100%" >
                                <thead>
                                    <tr class="filters">
                                        <th onkeypress="return soloLetras(event)" >Pregunta</th>   
                                        <th onkeypress="return soloLetras(event)" >Tipo de Pregunta</th> 
                                        <th onkeypress="return soloLetras(event)">Categoria</th>
                                        <th onkeypress="return soloLetras(event)">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 0; $i <= count($datos2) - 1; $i++) {

                                        $id_pregunta2 = $datos2[$i][0];
                                        $id_encuesta2 = $datos2[$i][1];
                                        $pregunta2 = $datos2[$i][2];
                                        $tipo_pregunta2 = $datos2[$i][3];
                                        $categoria2 = $datos2[$i][4];
                                        $fecha_registro2 = $datos2[$i][5];
                                        $id_usuario2 = $datos2[$i][6];
                                        $estatus2 = $datos2[$i][7];


                                        $arrayData2 = array();
                                        $arrayData2[0] = $id_pregunta2;

                                        $existe2 = $this->Pgsql->SELECTPLSQL('existe_respuesta2', $arrayData2);


                                        $array2 = array();
                                        $array2[0] = $id_pregunta2;
                                        $array2[1] = $id;
                                        $existe_preguntas2 = $this->Pgsql->SELECTPLSQL('existe_pregunta', $array2);
                                        ?>

                                        <tr class="text-center">
                                            <td><?php echo $pregunta2 ?></td>            
                                            <td><?php echo $tipo_pregunta2 ?></td>        
                                            <td><?php echo $categoria2 ?></td>   
                                            <td> <div class="form-group">

                                                    <? if ($existe2[0][0] != 0) { ?>

                                                        <?php if ($tipo_pregunta2 != "CONDICIONADA") { ?>
                                                            <a href="agregar_respuestas?&id_pregunta=<?php echo $id_pregunta2 . "&id_encuesta=" . $id_encuesta2 ?>">
                                                                <button type='button' class='btn bg-maroon btn-xs' title='Modificar Respuestas' >
                                                                    <span class='fa fa-pencil'></span>
                                                                </button>
                                                            </a>
                                                        <?php } else { ?>
                                                            <a href="agregar_respuesta_condicionada?&id_pregunta=<?php echo $id_pregunta2 . "&id_encuesta=" . $id_encuesta2 ?>">
                                                                <button type='button' class='btn bg-maroon btn-xs' title='Modificar Respuestas' >
                                                                    <span class='fa fa-pencil'></span>
                                                                </button>
                                                            </a>
                                                        <?php } ?>
                                                    <?php } else { ?>

                                                        <?php if ($tipo_pregunta2 != "CONDICIONADA") { ?>
                                                            <a href="agregar_respuestas?&id_pregunta=<?php echo $id_pregunta2 . "&id_encuesta=" . $id_encuesta2 ?>">
                                                                <button type='button' class='btn btn-primary btn-xs' title='Agregar Respuestas' >
                                                                    <span class='fa fa-upload'></span>
                                                                </button>
                                                            </a>

                                                        <?php } else { ?>
                                                            <a href="agregar_respuesta_condicionada?&id_pregunta=<?php echo $id_pregunta2 . "&id_encuesta=" . $id_encuesta2 ?>">
                                                                <button type='button' class='btn btn-primary btn-xs' title='Agregar Respuestas' >
                                                                    <span class='fa fa-upload'></span>
                                                                </button>
                                                            </a>
                                                        <?php } ?>

                                                    <?php } ?>

                                                    <?php if ($existe_preguntas2[0][0] == 0) { ?>
                                                        <?php if ($existe2[0][0] != 0) { ?>
                                                            <label class="btn btn-info btn-xs"> 
                                                                <input type="hidden" name="id" id="id" value="<?php echo $id ?>" >
                                                                <input type="checkbox" id="pregunta" name="pregunta[]"  value="<?php echo $id_pregunta2 ?>">
                                                            </label>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <button type="button" data-id="<?php echo $id_pregunta2 ?>" class="btn bg-purple btn-xs editButton" title="Desea Modificar o Deshabilitar La Pregunta">
                                                        <span class="fa fa-pencil-square-o"></span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="col-sm-12">&nbsp;</div>
                            <div class="col-sm-12">&nbsp;</div>


                            <form id="userForm" method="post" class="form-horizontal" style="display: none;">
                                <div class="col-sm-12">&nbsp;</div>
                                <input type="hidden"  id="id" name="id" >

                                <div class="form-group">

                                    <div class="col-sm-12">
                                        <label>Pregunta</label> 
                                        <input type="text" class="form-control text-uppercase" name="pregunta" id="pregunta" placeholder="Pregunta" />
                                    </div>

                                    <div class="col-sm-12">&nbsp;</div>

                                    <div class="col-sm-12">
                                        <label>Tipo</label> 
                                        <select name="tipo" id="tipo"  class="form-control "  >
                                            <option value="">Seleccione...</option>
                                            <option value="SIMPLE">SIMPLE</option>
                                            <option value="MULTIPLE">MULTIPLE</option>
                                            <option value="CONDICIONADA">CONDICIONADA</option>
                                        </select> 
                                    </div>

                                    <div class="col-sm-12">&nbsp;</div>

                                    <div class="col-sm-12">
                                        <label>Categoria</label>
                                        <select name="categoria" id="categoria"  class="form-control "  >
                                            <option value="">Seleccione...</option>
                                            <option value="CULTURA">CULTURA</option>
                                            <option value="DEPORTE">DEPORTE</option>
                                            <option value="ECONOMIA">ECONOMIA</option>
                                            <option value="RELIGION">RELIGION</option>
                                            <option value="SOCIAL">SOCIAL</option>
                                            <option value="POLITICA">POLITICA</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-12">&nbsp;</div>

                                    <div class="col-sm-12">
                                        <label>Estatus de la Pregunta</label>
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
    <div class="box box-danger collapsed-box">
        <div class="box-header with-border">
            <h3 class="box-title">Preguntas</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
            </div>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <?php if ($datos[0][0] != "") { ?>
                        <div class='filterable'>
                            <div class='panel-heading'>
                                <div class='pull-right'>
                                    <button class='btn btn-danger btn-xs btn-filter' title='Realizar Consultas Cruzadas' >
                                        <span class='fa fa-filter'></span>Filtrar</button>
                                </div>
                            </div>
                            <form id="formulario2" action="" method="post">
                                
                                <table id="nueva" class="display" cellspacing="0" width="100%" >
                                    <thead>
                                        <tr class="filters">
                                            <th onkeypress="return soloLetras(event)" >Pregunta</th>   
                                            <th onkeypress="return soloLetras(event)" >Tipo de Pregunta</th> 
                                            <th onkeypress="return soloLetras(event)">Categoria</th>
                                            <th onkeypress="return soloLetras(event)">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        for ($x = 0; $x <= count($datos) - 1; $x++) {

                                            $id_pregunta = $datos[$x][0];
                                            $id_encuesta = $datos[$x][1];
                                            $pregunta = $datos[$x][2];
                                            $tipo_pregunta = $datos[$x][3];
                                            $categoria = $datos[$x][4];
                                            $fecha_registro = $datos[$x][5];
                                            $id_usuario = $datos[$x][6];
                                            $estatus = $datos[$x][7];


                                            $arrayData = array();
                                            $arrayData[0] = $id_pregunta;

                                            $existe = $this->Pgsql->SELECTPLSQL('existe_respuesta2', $arrayData);


                                            $array = array();
                                            $array[0] = $id_pregunta;
                                            $array[1] = $id;
                                            $existe_preguntas = $this->Pgsql->SELECTPLSQL('existe_pregunta', $array);
                                            ?>

                                            <?php $clave = in_array($pregunta, array_column($datos2, 2)); ?>

                                            <?php if ($clave == NULL) { ?>
                                                <tr class = "text-center">
                                                    <td><?php echo $pregunta ?></td>            
                                                    <td><?php echo $tipo_pregunta ?></td>        
                                                    <td><?php echo $categoria ?></td>   
                                                    <td> <div class="form-group">
                                                            <?php if ($existe_preguntas[0][0] == 0) { ?>
                                                                <?php if ($existe[0][0] != 0) { ?>
                                                                    <label class="btn btn-info btn-xs"> 
                                                                        <input type="hidden" name="id" id="id" value="<?php echo $id ?>" >
                                                                        <input type="checkbox" id="pregunta" name="pregunta[]"  value="<?php echo $id_pregunta ?>">
                                                                    </label>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
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
                    url: "<?php echo base_url() . 'index.php/Encuesta/insertarPreguntas_tabla'; ?>",
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
                        url: "<?php echo base_url() . 'index.php/Encuesta/actualizar_pregunta'; ?>",
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
                url: "<?php echo base_url() . 'index.php/Encuesta/consultar_pregunta/'; ?>" + id,
                method: 'GET'

            }).success(function(data) {
                // Populate the form fields with the data returned from server

                var obj = JSON.parse(data);
                $('#userForm')
                        .find('[name="id"]').val(obj.id_pregunta).end()
                        .find('[name="pregunta"]').val(obj.pregunta).end()
                        .find('[name="tipo"]').val(obj.tipo_pregunta).end()
                        .find('[name="categoria"]').val(obj.categoria).end()
                        .find('[name="estatus"]').val(obj.estatus).end();

                // Show the dialog
                bootbox
                        .dialog({
                            title: 'Editar la Pregunta',
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
        $("#guardarModal").click(function() {
            var dataUser = {
                "pregunta": $("#pregunta").val(),
                "tipo": $("#tipo").val(),
                "categoria": $("#categoria").val()
            };
            //validamos que no quede ningun campo vacio
            if (dataUser.pregunta === '' || dataUser.tipo === '' || dataUser.categoria === '') {

                // mensaje en caso de que exista un campo vacio del formulario
                $("#resultado").html("<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='icon fa fa-warning'></i> Alerta...! Informacion Incompleta, debe llenar todos los campos....</div>");
                //En caso contrario que no hayan campos vacios enviamos los parametros por ajax
            } else {
                $("#insertar").submit(function() {
                    $.ajax({
                        url: "<?php echo base_url() . 'index.php/Encuesta/insertarPreguntas'; ?>",
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
                    //Redirijimos luego de enviar los datos 
                    setInterval(function() {
                        location.reload();
                    }, 3000); //Lo temporizamos a 3 segundos para mostrar el mensaje al usuario
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function() {

        $('#insertar').formValidation({
            framework: 'bootstrap',
            fields: {
                'pregunta[]': {
                    // The task is placed inside a .col-xs-6 element
                    row: '.col-sm-5',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                'tipo[]': {
                    // The due date is placed inside a .col-xs-4 element
                    row: '.col-sm-3',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }

                },
                'categoria[]': {
                    // The due date is placed inside a .col-xs-4 element
                    row: '.col-sm-3',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
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
            $('#insertar')
                    .formValidation('addField', $clone.find('[name="pregunta[]"]'))

                    .formValidation('addField', $clone.find('[name="tipo[]"]'))
                    .formValidation('addField', $clone.find('[name="categoria[]"]'));

        })
                // Remove button click handler
                .on('click', '.removeButton', function() {
                    var $row = $(this).closest('.form-group');
                    // Remove fields
                    $('#insertar')
                            .formValidation('removeField', $row.find('[name="pregunta[]"]'))

                            .formValidation('removeField', $row.find('[name="tipo[]"]'))
                            .formValidation('removeField', $row.find('[name="categoria[]"]'));
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
            "paging": true

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

        $('#nueva2 thead th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" class="form-control text-center"  placeholder="' + title + '" disabled  />');
        }
        );
        // DataTable
        var table = $('#nueva2').DataTable({
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

