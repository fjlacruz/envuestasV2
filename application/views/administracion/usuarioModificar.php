<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>


<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Editar Usuario</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <!--                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
                    </div>
                </div>
                <div class="box-body">
                    <form action='' name="formulario" id="formulario" method="POST" >
                        <div class="col-sm-12"  id='resultado'></div>     
                        <?php
                        foreach ($recuperar as $fila) {
                            ?>
                            <div class="col-sm-12" id="alert"></div>
                            <div class="col-sm-12" id="resultado"></div>

                            <div class="col-sm-12">&nbsp;</div>
                            <div class="form-group col-sm-4">
                                <label >C&eacute;dula</label> 
                                <input type="text" value="<?php echo $fila[1] ?>" class="form-control " readonly id="cedula" name="cedula" >
                            </div>
                            <div class="form-group col-sm-4">
                                <label >Nombre</label> 
                                <input type="text" value="<?php echo $fila[2] ?>" class="form-control "  readonly id="nombre" name="nombre" >
                            </div>
                            <div class="form-group col-sm-4">
                                <label >Apellido</label>
                                <input type="text" value="<?php echo $fila[3] ?>" class="form-control " readonly id="apellido" name="apellido" >
                            </div>

                            <div class="col-sm-12"></div>

                            <div class="form-group col-sm-8">
                                <label>Correo</label> 
                                <input type="text"  value="<?php echo $fila[4] ?>" class="form-control" id="correo" name="correo" >
                            </div>

                            <div class="form-group col-sm-4">
                                <label>Usuario</label> 
                                <input type="text" value="<?php echo $fila[5] ?>" class="form-control text-uppercase" readonly id="usuario" name="usuario" >
                            </div>
                            <input type="hidden" id="url_respuesta" value="<?php echo base_url() ?>index.php/administracion/usuarioModificar">
                            <div class="form-group col-sm-12">

                                <button  type="button" class="btn btn-success" id="modificar" >
                                    <span class="ladda-label">Actualizar</span>
                                </button>
                            </div>

                            <?php
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Cambiar Contrase&ntilde;a</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <!--                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
                    </div>
                </div>
                <div class="box-body">
                    <form action='' name="formulario2" id="formulario2" method="post" >
                        <div class="col-md-12"  id='resultado2'></div>  


                        <div class="col-sm-3">&nbsp;</div>
                        <div class="col-sm-6">
                            <div class="form-group has-feedback has-feedback-left"><label>Clave</label>
                                <input class="form-control " id="confirmar_clave" name="confirmar_clave" type="password" placeholder="Clave" >
                                <i class="fa fa-lock form-control-feedback"></i>
                            </div>
                        </div>
                        <div class="col-sm-3">&nbsp;</div>

                        <div class="col-sm-12"></div>

                        <div class="col-sm-3">&nbsp;</div>
                        <div class="col-sm-6">
                            <div class="form-group has-feedback has-feedback-left"><label>Confirmar Clave</label>
                                <input class="form-control " id="clave" name="clave" type="password" placeholder="Confirmar Clave" >
                                <i class="fa fa-lock form-control-feedback"></i>
                            </div>
                        </div>
                        <div class="col-sm-3">&nbsp;</div>
                        <input type="hidden" id="url_respuesta" value="<?php echo base_url() ?>index.php/administracion/usuarioModificar">
                        <div class="col-sm-12">&nbsp;</div>
                        <div class="form-group col-sm-12">
                            <button  type="button" class="btn btn-success" id="actualizar" >
                                <span class="ladda-label">Actualizar</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>

<script>

    // funcion para poner los inpunts en mayuscula
    $(document).on("keyup", '#correo', function()
    {
        $(this).val($(this).val().toUpperCase());

    });
    $(document).ready(function() {
        $('#formulario2')
                .formValidation({
                    framework: 'bootstrap',
                    fields: {
                        confirmar_clave: {
                            row: '.col-sm-6',
                            validators: {
                                notEmpty: {
                                    message: 'CAMPO OBLIGATORIO'
                                },
                                stringLength: {
                                    //min: 8,
                                    //max: 20,
                                    message: 'La contrase&ntilde;a debe contener minimo 8 digitos'
                                },
                                /////PASSWORD = Mayuscula, Minuscula, numero, caracter especial
                                regexp: {
                                    regexp: '^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[$@!%?&*]).{8,12}$',
                                    message: 'La contrase&ntilde;a debe contener m&iacute;nimo 8 y m&aacute;ximo 12 caracteres, y por lo menos 1 may&uacute;scula del alfabeto , 1 min&uacute;sculas del alfabeto , 1 N&uacute;mero y el car&aacute;cter especial'
                                }
                            }
                        },
                        clave: {
                            row: '.col-sm-6',
                            validators: {
                                notEmpty: {
                                    message: 'CAMPO OBLIGATORIO'
                                },
                                stringLength: {
                                    //min: 8,
                                    //max: 20,
                                    message: 'La contrase&ntilde;a debe contener minimo 8 digitos'
                                },
                                /////PASSWORD = Mayuscula, Minuscula, numero, caracter especial ej: POab12@, AAbb01**
                                /////NO importa el orden de como se llenen la password puede ser al contrario ej:12@abPO

                                regexp: {
                                    regexp: '^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[$@!%?&*]).{8,12}$',
                                    message: 'La contrase&ntilde;a debe contener m&iacute;nimo 8 y m&aacute;ximo 12 caracteres, y por lo menos 1 may&uacute;scula del alfabeto , 1 min&uacute;sculas del alfabeto , 1 N&uacute;mero y el car&aacute;cter especial'
                                },
                                identical: {
                                    field: 'confirmar_clave',
                                    message: 'Las contrase&ntilde;a deben ser iguales'
                                }
                            }
                        }
                    }
                });

    });
</script>

<script>
    $(document).ready(function() {
        $('#formulario').formValidation({
            framework: 'bootstrap',
            fields: {
                correo: {
                    row: '.col-sm-8',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        },
                        regexp: {
                            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                            message: ' '
                        },
                    }
                },
                usuario: {
                    row: '.col-sm-4',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                }
            }
        });
    });
</script>

<script type="text/javascript">

    $(document).ready(function() {

        $('#modificar').click(function() {
            var dataUser = {
                "cedula": $("#cedula").val(),
                "correo": $("#correo").val(),
                "usuario": $("#usuario").val()
            };
            if (dataUser.cedula === '' || dataUser.usuario === '' || dataUser.correo === '') {
                $("#resultado").html("<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button>Informacion Incompleta, debe llenar todos los campos....</div>");
            } else {

                $.ajax({
                    data: dataUser,
                    type: 'POST',
                    url: "actualizarUsuario",
                    success: function(data) {
                        $("#resultado").html("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button>Se han modificado exitosamente los Datos...</div>");
                    }
                });
                setInterval(function() {
                    window.location.href = $("#url_respuesta").val();
                }, 3000);
            }
        });
    });

</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#actualizar").click(function() {
            var dataUser = {
                "clave": $("#clave").val(),
                "confirmar_clave": $("#confirmar_clave").val()
            };
            if (dataUser.clave === '') {
                $("#resultado2").html("<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button>Informacion Incompleta, debe llenar todos los campos....</div>");
            } else {
                var vacio = 1;
            }
            if (dataUser.clave != dataUser.confirmar_clave) {
                $("#resultado2").html("<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button>Las contrase&ntilde;a deben ser iguales</div>");
            } else {
                var diferente = 1;
            }
            if (vacio == 1 && diferente == 1) {
                $.ajax({
                    url: "contrasenna_actualizar",
                    type: 'POST',
                    data: dataUser,
                    success: function(data) {

                        $("#resultado2").html("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button>Se han modificado exitosamente los Datos...</div>");
                    }
                });
                setInterval(function() {
                    window.location.href = $("#url_respuesta").val();
                }, 3000);
            }

        });
    });


</script>