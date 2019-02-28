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
            <h3 class="box-title">Asignar Operadora a Nivel Nacional</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <div class="box-body">
            <?php if ($datos2[0][0] != 0 || $datos2[0][1] != 0 || $datos2[0][2] != 0 || $datos2[0][3] != 0) { ?>
                <table class='tabla_lista' id="tabla">

                    <thead>
                    <th>OPERADORAS</th>
                    <th>CANTIDAD ASIGNADA </th>

                    </thead>
                    <tbody>
                       <?php
                        $cantv = $datos2[0][0];
                        $digitel = $datos2[0][1];
                        $movilnet = $datos2[0][2];
                        $movistar = $datos2[0][3];
                        $total = $cantv + $digitel + $movilnet + $movistar;
                        ?>
                        <tr class='text-center'>
                            <td> CANTV</td>   
                            <td> <input id="tlf1" type="hidden"  value="<?php echo $cantv ?>" > <?php echo $cantv ?></td>   

                        </tr>
                        <tr class='text-center'>
                            <td> DIGITEL</td>   
                            <td> <input id="tlf2" type="hidden" value="<?php echo $digitel ?>" > <?php echo $digitel ?></td> 

                        </tr>
                        <tr class='text-center'>
                            <td> MOVILNET</td>   
                            <td>  <input id="tlf3" type="hidden" value="<?php echo $movilnet ?>" ><?php echo $movilnet ?> </td>  

                        </tr>
                        <tr class='text-center'>
                            <td> MOVISTAR</td>   
                            <td>  <input id="tlf4" type="hidden" value="<?php echo $movistar ?>" ><?php echo $movistar ?> </td>  

                        </tr>
                        <tr class='text-center'> 
                            <td> TOTAL</td>   
                            <td> <?php echo $total ?></td>   
                        </tr>
                    </tbody> 
                </table> 

            <?php } ?>

            <div class="box-header with-border">
                <h3 class="box-title">NOMBRE DE LA ENCUESTA: <?php echo $datos[0][4] ?></h3>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-12">&nbsp;</div>

                    <form action='' id="formulario" method="post" >
                        <div  class="col-sm-12" id="resultado" ></div>

                        <input type="hidden" name="id_encuesta" id="id_encuesta" value="<?php echo $datos[0][3] ?>" >

                        <div class="col-sm-12">&nbsp;</div>
                        <div  class="row" >
                            <div class="col-sm-4">
                                <label>OPERADORAS</label>
                                <select name="operadora" id="operadora"  class="form-control  " >
                                    <option value="0">SELECCIONE</option>
                                    <option value="1">CANTV</option>
                                    <option value="2">DIGITEL</option>
                                    <option value="3">MOVILNET</option>
                                    <option value="4">MOVISTAR</option>
                                </select>
                            </div>

                            <div class="col-sm-4">
                                <label>CANTIDAD DISPONIBLE</label>
                                <input type="text" class="form-control" name="cantidad" id="cantidad" readonly >
                            </div>

                            <div class="col-sm-4">
                                <label>ASIGNAR CANTIDAD</label>
                                <input type="text" class="form-control" autocomplete="off" maxlength="4" name="asignacion" id="asignacion" onkeypress="return soloNumeros(event)">
                            </div>  

                        </div>
                        <div class="col-sm-12">&nbsp;</div>
                        <div class="col-sm-12">&nbsp;</div>

                        <button  onclick="history.back()" type="button" class="btn btn-warning">Atras</button>
                        <button id="guardar" type="" class="btn btn-success" >
                            <span class="ladda-label">Asignar</span>
                        </button>

                        <div class="col-sm-12">&nbsp;</div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-danger collapsed-box">
        <div class="box-header with-border">
            <h3 class="box-title">Asignar Operadora por Estados</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="box-header with-border">
                <h3 class="box-title">NOMBRE DE LA ENCUESTA: <?php echo $datos[0][4] ?></h3>
            </div>
               <?php if ($datos3[0][0] != 0 || $datos3[0][1] != 0 || $datos3[0][2] != 0 || $datos3[0][3] != 0) { ?>
                
                <table class='tabla_lista' id="tabla">

                    <thead>
                    <th>OPERADORAS</th>
                    <th>CANTIDAD ASIGNADA </th>
                    <th>VER DETALLES </th>
                    </thead>
                    <tbody>
                        <?php
                        $cantv3 = $datos3[0][0];
                        $digitel3 = $datos3[0][1];
                        $movilnet3 = $datos3[0][2];
                        $movistar3 = $datos3[0][3];
                        $total3 = $cantv3 + $digitel3 + $movilnet3 + $movistar3;
                        ?>
                        <tr class='text-center'>
                            <td> CANTV</td>   
                            <td> <input id="tlf1" type="hidden"  value="<?php echo $cantv3 ?>" > <?php echo $cantv3 ?></td>   
                            <td>  <button type = "button" data-id = "1" class = "btn bg-purple btn-xs editButton" title = "VER DETALLES" >
                                    <span class = "fa  fa-pencil-square-o"></span>
                                </button></td>
                        </tr>
                        <tr class='text-center'>
                            <td> DIGITEL</td>   
                            <td> <input id="tlf2" type="hidden" value="<?php echo $digitel3 ?>" > <?php echo $digitel3 ?></td> 
                            <td>  <button type = "button" data-id = "2" class = "btn bg-purple btn-xs editButton" title = "VER DETALLES" >
                                    <span class = "fa  fa-pencil-square-o"></span>
                                </button></td>
                        </tr>
                        <tr class='text-center'>
                            <td> MOVILNET</td>   
                            <td>  <input id="tlf3" type="hidden" value="<?php echo $movilnet3 ?>" ><?php echo $movilnet3 ?> </td>  
                            <td>  <button type = "button" data-id = "3" class = "btn bg-purple btn-xs editButton" title = "VER DETALLES" >
                                    <span class = "fa  fa-pencil-square-o"></span>
                                </button></td>
                        </tr>
                        <tr class='text-center'>
                            <td> MOVISTAR</td>   
                            <td>  <input id="tlf4" type="hidden" value="<?php echo $movistar3 ?>" ><?php echo $movistar3 ?> </td>  
                            <td> <button type = "button" data-id = "4" class = "btn bg-purple btn-xs editButton" title = "VER DETALLES" >
                                    <span class = "fa  fa-pencil-square-o"></span>
                                </button></td>
                        </tr>
                        <tr class='text-center'> 
                            <td> TOTAL</td>   
                            <td> <?php echo $total3 ?></td>   
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


            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-12">&nbsp;</div>

                    <form action=''  id="formulario1" method="post" >
                        <div  class="col-sm-12" id="resul" ></div>

                        <input type="hidden" name="id_encuesta2" id="id_encuesta2" value="<?php echo $datos[0][3] ?>" >

                        <div class="col-sm-12">&nbsp;</div>
                        <div  class="row" >
                            <div class="col-sm-3">
                                <label>OPERADORAS</label>
                                <select name="operadora2" id="operadora2"  class="form-control  " >
                                    <option value="0">SELECCIONE</option>
                                    <option value="1">CANTV</option>
                                    <option value="2">DIGITEL</option>
                                    <option value="3">MOVILNET</option>
                                    <option value="4">MOVISTAR</option>
                                </select>
                            </div>

                            <div class="col-sm-3">
                                <label>ESTADO</label>
                                <select name="estados2" id="estados2"  class="form-control  " >
                                    <option value="">SELECCIONE</option>
                                    <?php
                                    foreach ($lista_estados as $i => $estados) {
                                        echo '<option value="' . $estados[1] . '">' . $estados[1] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-sm-3">
                                <label>CANTIDAD DISPONIBLE</label>
                                <input type="text" class="form-control" name="cantidad2" id="cantidad2" readonly >
                            </div>

                            <div class="col-sm-3">
                                <label>ASIGNAR CANTIDAD</label>
                                <input type="text" class="form-control" autocomplete="off" maxlength="4" name="asignacion2" id="asignacion2" onkeypress="return soloNumeros(event)">
                            </div>  

                        </div>
                        <div class="col-sm-12">&nbsp;</div>
                        <div class="col-sm-12">&nbsp;</div>

                        <button  onclick="history.back()" type="button" class="btn btn-warning">Atras</button>
                        <button id="guardar2" type="" class="btn btn-success" >
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
                "id_encuesta": $("#id_encuesta2").val()
            };

            $.ajax({
                type: "POST",
                data: dataUser,
                url: "consultar_tlf_estados",
                dataType: 'json',
                success: function(data) {

                    $('#tlf').html(data);

                    bootbox
                            .dialog({
                                title: 'Cantidad por Estados',
                                message: $('#userForm'),
                                show: false
                            })
                            .on('shown.bs.modal', function() {
                                $('#userForm')
                                        .show()
                                        .formValidation('resetForm');
                            })
                            .on('hide.bs.modal', function(e) {

                                $('#userForm').hide().appendTo('body');
                            })
                            .modal('show');
                }
            });
        });
    });

</script>
<script >

    $(document).ready(function() {

        $("#operadora").change(function() {

            $('#estados').val('');
            $("#cantidad").val('');
        });
    });

    $(document).ready(function() {

        $("#operadora2").change(function() {

            $('#estados2').val('');
            $("#cantidad2").val('');
        });
    });
</script>
<script>
    $(document).ready(function() {

        $('#formulario').formValidation({
            framework: 'bootstrap',
            fields: {
                operadora: {
                    row: '.col-sm-4',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                asignacion: {
                    row: '.col-sm-4',
                    validators: {
                        between: {
                            min: 1,
                            max: 5001,
                            message: 'VALOR MINIMO 1 Y MAXIMO 5000'
                        }
                    }
                }

            }
        });
    });

    $(document).ready(function() {

        $('#formulario1').formValidation({
            framework: 'bootstrap',
            fields: {
                operadora2: {
                    row: '.col-sm-4',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                estados2: {
                    row: '.col-sm-4',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                asignacion2: {
                    row: '.col-sm-3',
                    validators: {
                        between: {
                            min: 1,
                            max: 3501,
                            message: 'VALOR MINIMO 1 Y MAXIMO 3500'
                        }
                    }
                }

            }
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
            var cantidad = $("#cantidad").val();
            var asignacion = $("#asignacion").val();



            if (parseInt(asignacion) > parseInt(cantidad)) {

                $('#asignacion').val('');
                $("#resultado").show();
                $("#resultado").html("<div class='alert alert-danger alert-dismissible'>\n\
    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>\n\
    <h5><i class='icon fa fa-ban'></i> Alert! LA ASIGNACION NO PUEDE SER MAYOR A LA CANTIDAD</h5></div>");

            }

            if (parseInt(asignacion) > 5000) {

                $('#asignacion').val('');
                $("#resultado").show();
                $("#resultado").html("<div class='alert alert-warning alert-dismissible'>\n\
    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>\n\
    <h5><i class='icon fa fa-ban'></i> Alert! LA ASIGNACION NO PUEDE SER MAYOR A 3500</h5></div>");

            }

        });
    });
</script>
<script >
    $(document).ready(function() {
        $("#asignacion2").keyup(function()
        {
            var cantidad2 = $("#cantidad2").val();
            var asignacion2 = $("#asignacion2").val();

            if (parseInt(asignacion2) > parseInt(cantidad2)) {

                $('#asignacion2').val('');
                $("#resul").show();
                $("#resul").html("<div class='alert alert-danger alert-dismissible'>\n\
    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>\n\
    <h5><i class='icon fa fa-ban'></i> Alert! LA ASIGNACION NO PUEDE SER MAYOR A LA CANTIDAD</h5></div>");

            }

            if (parseInt(asignacion2) > 3500) {

                $('#asignacion2').val('');
                $("#resul").show();
                $("#resul").html("<div class='alert alert-warning alert-dismissible'>\n\
    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>\n\
    <h5><i class='icon fa fa-ban'></i> Alert! LA ASIGNACION NO PUEDE SER MAYOR A 1594</h5></div>");

            }

        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#guardar").click(function() {

            var dataUser = {
                "id_encuesta": $("#id_encuesta").val(),
                "operadora": $("#operadora").val(),
                "asignacion": $("#asignacion").val(),
                "estados": $("#estados").val(),
                "cantidad": $("#cantidad").val()
            };

            //validamos que no quede ningun campo vacio
            if (dataUser.operadora === '' || dataUser.asignacion === '' || dataUser.cantidad === '' || dataUser.estados === '') {

                // mensaje en caso de que exista un campo vacio del formulario
                $("#resultado").html("<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='icon fa fa-warning'></i> Alerta...! Informacion Incompleta, debe llenar todos los campos....</div>");
                //En caso contrario que no hayan campos vacios enviamos los parametros por ajax
            } else {
                $("#formulario").submit(function() {
                    $.ajax({
                        url: "<?php echo base_url() . 'index.php/Asignaciones/insertar_tlf'; ?>",
                        type: "POST",
                        data: dataUser,
                        beforeSend: function() {
                            $("#resultado").show();
                            $("#resultado").html('<div><?php echo '<img width="2%" src="' . base_url() . 'application/recursos/imagenes/ajax-loader_1.gif"> Asignando Numeros...'; ?></div>');
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
                    },5000); //Lo temporizamos a 3 segundos para mostrar el mensaje al usuario
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#guardar2").click(function() {

            var dataUser = {
                "id_encuesta2": $("#id_encuesta2").val(),
                "operadora2": $("#operadora2").val(),
                "asignacion2": $("#asignacion2").val(),
                "estados2": $("#estados2").val(),
                "cantidad2": $("#cantidad2").val()
            };

            //validamos que no quede ningun campo vacio
            if (dataUser.operadora2 === '' || dataUser.asignacion2 === '' || dataUser.cantidad2 === '' || dataUser.estados2 === '') {

                // mensaje en caso de que exista un campo vacio del formulario
                $("#resul").html("<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='icon fa fa-warning'></i> Alerta...! Informacion Incompleta, debe llenar todos los campos....</div>");
                //En caso contrario que no hayan campos vacios enviamos los parametros por ajax
            } else {
                $("#formulario1").submit(function() {
                    $.ajax({
                        url: "<?php echo base_url() . 'index.php/Asignaciones/insertar_tlf_por_estado'; ?>",
                        type: "POST",
                        data: dataUser,
                        beforeSend: function() {
                            $("#resul").show();
                            $("#resul").html('<div><?php echo '<img width="2%" src="' . base_url() . 'application/recursos/imagenes/ajax-loader_1.gif"> Asignando Numeros...'; ?></div>');
                        },
                        //Despues de enviar los datos limpiamos los campos del formulario
                        success: function(respuesta) {
                            // Enviamos un mensaje de exito al insertar los datos
                            $("#resul").html("<div class='alert alert-success alert-dismissable'>\n\
        <button type='button' class='close' data-dismiss='alert'>&times;</button>\n\
<i class='icon fa fa-check'></i> Suceso..!Los Datos Fueron registrados Exitosamente</div>");
                        }
                    });

                    //Redirijimos luego de enviar los datos 
                    setInterval(function() {
                        location.reload();
                    }, 30000); //Lo temporizamos a 3 segundos para mostrar el mensaje al usuario
                });
            }
        });
    });
</script>
<script>

    $(document).ready(function() {

        $("#estados2").change(function()
        {
            var dataUser = {
                "operadora2": $("#operadora2").val(),
                "estados2": $("#estados2").val()
            };
            if (dataUser.operadora2 != '' && dataUser.estados2 != '') {
                $.ajax({
                    type: "POST",
                    data: dataUser,
                    url: "consultar_tlf_por_estado",
                    beforeSend: function() {
                        $("#resul").show();
                        $("#resul").html('<div><?php echo '<img width="2%" src="' . base_url() . 'application/recursos/imagenes/ajax-loader_1.gif"> Procesando Peticion....'; ?></div>');
                    },
                    success: function(data) {
                        $("#resul").fadeOut();

                        $("#cantidad2").val(data);
                    }
                });
            }
        });

    });


</script>
<script>

    $(document).ready(function() {

        $("#operadora").change(function()
        {
            var dataUser = {
                "operadora": $("#operadora").val()
            };
            if (dataUser.operadora != '') {
                $.ajax({
                    type: "POST",
                    data: dataUser,
                    url: "consultar_tlf",
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