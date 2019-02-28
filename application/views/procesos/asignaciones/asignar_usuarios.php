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
    .modal-dialog{
        width: 900px;
    }


</style>

<section class="content">
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Asignar Operadoradores</h3>
        </div>

        <?php if ($datos2[0][0] != 0 || $datos3[0][0] != 0 || $datos4[0][0] != 0 || $datos5[0][0] != 0) { ?>
            <table class='tabla_lista' id="tabla">
             
                <thead>
                <th>OPERADORAS</th>
         
                <th>POR OPERADOR</th>
                <th>VER DETALLES </th>
                </thead>
                <tbody>
                    <?php
                    $cantidad2 = $datos2[0][0];
                    $cantidad3 = $datos3[0][0];
                    $cantidad4 = $datos4[0][0];
                    $cantidad5 = $datos5[0][0];
                    $total = $cantidad2 + $cantidad3 + $cantidad4 + $cantidad5;
                    ?>
                    <tr class='text-center'>
                        <td> CANTV</td>   
                       
                        <td> <?php echo $cantidad2 ?></td>   
                        <td>  <button type = "button" data-id = "1" class = "btn bg-purple btn-xs editButton" title = "VER DETALLES" >
                                <span class = "fa  fa-pencil-square-o"></span>
                            </button></td>
                    </tr>
                    <tr class='text-center'>
                        <td> DIGITEL</td>   
                      
                        <td>  <?php echo $cantidad3 ?></td> 
                        <td>  <button type = "button" data-id = "2" class = "btn bg-purple btn-xs editButton" title = "VER DETALLES" >
                                <span class = "fa  fa-pencil-square-o"></span>
                            </button></td>
                    </tr>
                    <tr class='text-center'>
                        <td> MOVILNET</td>   
                      
                        <td><?php echo $cantidad4 ?> </td>  
                        <td>  <button type = "button" data-id = "3" class = "btn bg-purple btn-xs editButton" title = "VER DETALLES" >
                                <span class = "fa  fa-pencil-square-o"></span>
                            </button></td>
                    </tr>
                    <tr class='text-center'>
                        <td> MOVISTAR</td>   
                    
                        <td> <?php echo $cantidad5 ?> </td> 
                        <td> <button type = "button" data-id = "4" class = "btn bg-purple btn-xs editButton" title = "VER DETALLES" >
                                <span class = "fa  fa-pencil-square-o"></span>
                            </button></td>
                    </tr>
                    <tr class='text-center'> 
                        <td> TOTAL</td>   
                       
                        <td> <?php echo $total ?></td>  
                    </tr>
                </tbody> 
            </table> 
            <form id="userForm" method="post" class="form-horizontal" style="display: none;">
                <div class="col-sm-12">&nbsp;</div>
                <div class="row">
                    <div class="col-sm-12">
                        <div id="tlf" ></div>
                    </div>
                </div>

            </form>
        <?php } ?>

        <div class="box-body">
            <div class="box-header with-border">
                <h3 class="box-title">NOMBRE DE LA ENCUESTA: <?php echo $datos[0][4] ?></h3>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-12">&nbsp;</div>

                    <form action=''  id="formulario" method="post" >
                        <div  class="col-sm-12" id="resultado" ></div>
                        <input type="hidden" name="id_encuesta" id="id_encuesta" value="<?php echo $datos[0][3] ?>" >

                        <div class="col-sm-12">&nbsp;</div>
                        <div  class="row" >

                            <div class="col-sm-1">&nbsp;</div>

                            <div class="col-sm-2">
                                <label>OPERADORAS</label>
                                <select name="operadora" id="operadora"  class="form-control  " >
                                    <option value="0">SELECCIONE</option>
                                    <option value="1">CANTV</option>
                                    <option value="2">DIGITEL</option>
                                    <option value="3">MOVILNET</option>
                                    <option value="4">MOVISTAR</option>
                                </select>
                            </div>

                            <div class="col-sm-3">
                                <label>ESTADO</label>
                                <select name="estados" id="estados"  class="form-control  " >
                                    <option value="">SELECCIONE</option>
                                    <?php
                                    foreach ($lista_estados as $i => $estados) {
                                        echo '<option value="' . $estados[1] . '">' . $estados[1] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-sm-2">
                                <label>CANT. DISPONIBLE</label>
                                <input type="text" class="form-control" name="cantidad" id="cantidad" readonly >
                            </div>

                            <div class="col-sm-2">
                                <label>ASIGNAR CANTIDAD</label>
                                <input type="text" class="form-control"  autocomplete="off" maxlength="4" name="asignacion" id="asignacion" onkeypress="return soloNumeros(event)">
                            </div>  


                        </div>
                        <div class="col-sm-12">&nbsp;</div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">&nbsp;</div>

                                <div class="col-sm-6">
                                    <label>OPERADORES</label>
                                    <select name="operador[]" id="operador"   class="form-control text-center " >
                                        <option value="">SELECCIONE</option>
                                        <?php
                                        foreach ($lista_operador as $i => $operador) {
                                            echo '<option value="' . $operador[0] . '">' . $operador[1] . " " . $operador[2] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-sm-1">
                                    <label>Agregar</label> 
                                    <button type="button" class="btn btn-primary addButton" >+</button>
                                </div>

                            </div> 
                        </div>

                        <div class="form-group hide" id="bookTemplate">
                            <div class="row">
                                <div class="col-sm-2">&nbsp;</div>

                                <div class="col-sm-6">
                                    <select name="operador[]" id="operador"  class="form-control text-center " >
                                        <option value="">SELECCIONE</option>
                                        <?php
                                        foreach ($lista_operador as $i => $operador) {
                                            echo '<option value="' . $operador[0] . '">' . $operador[1] . " " . $operador[2] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-sm-1">
                                    <button type="button" class="btn btn-danger removeButton" >-</button>
                                </div>

                            </div> 
                        </div> 

                        <div class="col-sm-12">&nbsp;</div>
                        <div class="col-sm-12">&nbsp;</div>
                        <button  onclick="history.back()" type="button" class="btn btn-warning">Atras</button>
                        <button type="" id="guardar" class="btn btn-success" >
                            <span class="ladda-label">Asignar</span>
                        </button>
                        <div class="col-sm-12">&nbsp;</div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
<script>
    $(document).ready(function() {

        $('.editButton').on('click', function() {
            var dataUser = {
                "id_operadora": $(this).attr('data-id'),
                "id_encuesta": $("#id_encuesta").val()
            };

            $.ajax({
                type: "POST",
                data: dataUser,
                url: "consultar_tlf_estados_operador",
                dataType: 'html',
                success: function(data) {

                    $('#tlf').html(data);

                    bootbox
                            .dialog({
                                title: 'Cantidad por Estados y Operador',
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
                    //recorre el arreglo y lo imprime

                }
            });
        });
    });

</script>


<script>
    $(document).ready(function() {

        $('#formulario').formValidation({
            framework: 'bootstrap',
            fields: {
                operadora: {
                    row: '.col-sm-2',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                estados: {
                    row: '.col-sm-3',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                asignacion: {
                    row: '.col-sm-2',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                'operador[]': {
                    // The task is placed inside a .col-xs-6 element
                    row: '.col-sm-6',
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
            $('#formulario')
                    .formValidation('addField', $clone.find('[name="operador[]"]'));
        })
                .on('click', '.removeButton', function() {
                    var $row = $(this).closest('.form-group');
                    $('#formulario')
                            .formValidation('removeField', $row.find('[name="operador[]"]'));
                    $row.remove();
                });

    });
</script>

<script>
    $(document).ready(function() {
        $("#guardar").click(function() {

            var dataUser = {
                "id_encuesta": $("#id_encuesta").val(),
                "operador": $("#operador").val(),
                "estado": $("#estado").val(),
                "asignacion": $("#asignacion").val()
            };

            //validamos que no quede ningun campo vacio
            if (dataUser.operador === '' || dataUser.asignacion === '' || dataUser.estado === '') {

                // mensaje en caso de que exista un campo vacio del formulario
                $("#resultado").html("<div class='alert alert-warning alert-dismissable'>\n\
    <button type='button' class='close' data-dismiss='alert'>&times;</button><i class='icon fa fa-warning'>\n\
</i> Alerta...! Informacion Incompleta, debe llenar todos los campos....</div>");
                //En caso contrario que no hayan campos vacios enviamos los parametros por ajax
            } else {
                $("#formulario").submit(function() {
                    $.ajax({
                        url: "<?php echo base_url() . 'index.php/Asignaciones/insertar_tlf_operadores'; ?>",
                        type: "POST",
                        data: $(this).serialize(),
                        beforeSend: function() {
                            $("#resultado").show();
                            $("#resultado").html('<div><?php echo '<img width="2%" src="' . base_url() . 'application/recursos/imagenes/ajax-loader_1.gif">Asignando Numeros...'; ?></div>');
                        },
                        //Despues de enviar los datos limpiamos los campos del formulario
                        success: function(respuesta) {
                            // Enviamos un mensaje de exito al insertar los datos
                            $("#resultado").html("<div class='alert alert-success alert-dismissable'>\n\
    <button type='button' class='close' data-dismiss='alert'>&times;</button>\n\
<i class='icon fa fa-check'></i> Suceso..!Los Datos Fueron registrados Exitosamente</div>");
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

        $("#estados").change(function()
        {
            var dataUser = {
                "id_encuesta": $("#id_encuesta").val(),
                "operadora": $("#operadora").val(),
                "estados": $("#estados").val()
            };
            if (dataUser.operadora != '' && dataUser.estados != '') {
                $.ajax({
                    type: "POST",
                    data: dataUser,
                    url: "consultar_tlf_operadores",
                    beforeSend: function() {
                        $("#resultado").show();
                        $("#resultado").html('<div><?php echo '<img width="2%" src="' . base_url() . 'application/recursos/imagenes/ajax-loader_1.gif"> Procesando Peticion....'; ?></div>');
                    },
                    success: function(data) {
                        $("#resultado").fadeOut();
                        $("#cantidad").val(data);

                    }
                });
            }
        });

    });


</script>

<script>

    $(document).ready(function() {

        $("#operadora").change(function() {

            $('#estados').val('');
            $("#cantidad").val('');
            $("#operador").val('');
        });
    });
</script>
<script>

    function soloNumeros(e)
    {
        var key = window.Event ? e.which : e.keyCode
        return ((key >= 48 && key <= 57) || (key == 8))
    }
</script>
<script >

    $(document).ready(function() {

        $("#asignacion").keyup(function()
        {
            var asignacion = $("#asignacion").val();
            var cantidad = $("#cantidad").val();

            if (parseInt(asignacion) > parseInt(cantidad)) {
                $('#asignacion').val('');
                $("#resultado").show();
                $("#resultado").html("<div class='alert alert-danger alert-dismissible'>\n\
    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>\n\
    <h5><i class='icon fa fa-ban'></i> Alert! LA ASIGNACION NO PUEDE SER MAYOR A LA CANTIDAD</h5></div>");
            }

        });
    });
</script>