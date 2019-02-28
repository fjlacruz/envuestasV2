<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<style>
    .transparente{

        opacity: 0.8;

        -moz-opacity: 0.8;

        filter: alpha(opacity=80);

        -khtml-opacity: 0.8;

    }
</style>

<div id="login">
    <div style="margin-top:50px;margin-left:450px"> 
        <section class="content transparente">

            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#logeo" data-toggle="tab">Inicio de Sesion</a></li>
                        <li><a href="#olvido" data-toggle="tab">Recuperar Contrase&ntilde;a</a></li>
                    </ul>
                    <div class="col-sm-12">&nbsp;</div>
                    <div class="tab-content">
                        <div class="active tab-pane" id="logeo">
                            <div class="box-body">

                                <?php
                                $danger = $this->session->flashdata('danger');
                                $info = $this->session->flashdata('info');
                                if ($danger) {
                                    ?>
                                    <div ><?php echo $danger ?></div>
                                    <?php
                                }
                                if ($info) {
                                    ?>
                                    <div ><?php echo $info ?></div> 
                                    <?php
                                }
                                ?>
                                <div class="col-sm-12 "  id='resultado'></div>
                                <div class="col-sm-12 "  id='alert'></div>

                                <form action='login' name="formulario" id="formulario" method="post" >
                                    <div  class="row" >
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback has-feedback-left"><label>Usuario</label>
                                                <input class="form-control " id="usuario" name="usuario" type="text " placeholder="Usuario" onkeyup="javascript:this.value = this.value.toUpperCase()" >
                                                <i class="fa fa-user form-control-feedback"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback has-feedback-left"><label>Clave</label>
                                                <input class="form-control" id="clave" name="clave" type="password" placeholder="Clave" >
                                                <i class="fa fa-lock form-control-feedback"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">&nbsp;</div>
                                    <div class="form-group col-md-6">
                                        <button  type="submit" class="btn btn-primary">
                                            <span class="ladda-label">Entrar</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="tab-pane" id="olvido">

                            <div class="box-body">

                                <form id="loginForm" method="post" class="form-horizontal">
                                    <div class="col-sm-12 "  id='resultado2'></div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-7">
                                        <div class="form-group has-feedback has-feedback-left"><label>Correo:</label>
                                            <input type="text" class="form-control"  name="correo" id="correo" autocomplete="off" onkeyup="javascript:this.value = this.value.toUpperCase()" >
                                            <i class="fa fa-envelope form-control-feedback"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-3">&nbsp;</div>
                                    <div class="col-md-12">&nbsp;</div>

                                    <div class="col-md-2">&nbsp;</div>
                                    <div class="col-md-9">
                                        Se enviaran los datos de acceso al sistema al correo asociado...
                                    </div>
                                    <div class="col-md-1">&nbsp;</div>

                                    <div class="col-md-12">&nbsp;</div>

                                    <div class="col-md-2">&nbsp;</div>
                                    <div class="col-md-9 "  id='alerta'></div>
                                    <div class="col-md-9" id='success2'> </div>
                                    <div class="col-md-1">&nbsp;</div>

                                    <div class="col-md-12">&nbsp;</div>

                                    <div class="form-group col-md-6">
                                        <button id='botones' style='display:none;' type="button" class="btn btn-primary">Enviar</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"> </div>
        </section>
    </div>
</div>

<script>

    //validacion con boostrap
    $(document).ready(function() {

        $('#loginForm').formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            fields: {
                correo: {
                    validators: {
                        notEmpty: {
                            message: 'La Direcci&oacute;n de Correo es Requerida'
                        },
                        regexp: {
                            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                            message: ' '
                        },
                        emailAddress: {
                            message: 'Direcci&oacute;n de Correo Inv&aacute;lida'
                        }
                    }
                }
            }
        });
    });
    $('#formulario').formValidation({
        framework: 'bootstrap',
        fields: {
            usuario: {
                row: '.col-md-6',
                validators: {
                    notEmpty: {
                        message: 'Nombre de Usuario Requerido'
                    }
                }
            },
            clave: {
                row: '.col-md-6',
                validators: {
                    notEmpty: {
                        message: 'La Clave es Requerida'
                    }
                }
            }

        }

    });
    //consultamos si el correo existe
    $(document).ready(function() {
        $('#correo').keyup(function() {
            var correo = $(this).val();
            var dataString = 'correo=' + correo;

            $.ajax({
                type: "POST",
                url: "consultar_correo",
                data: dataString,
                success: function(data) {
                    if (data == 1) {

                        $("#botones").show();
                        $("#resultado2").html("<div class='alert alert-success alert-dismissable'>\n\
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>\n\
                <i class='icon fa fa-check'></i>Correo <strong>validado</strong> correctamente</div>");
                    } else {

                        $("#resultado2").html("<div class='alert alert-danger alert-dismissible'>\n\
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>\n\
                <i class='icon fa fa-ban'></i><strong>Alerta! </strong>Cuenta de correo <strong>No Existente</div>");
                        document.getElementById('botones').style.display = 'none';

                    }
                }
            });
        });
    });
    // si existe enviamos el correo 
    $(document).ready(function() {
        $('#botones').click(function() {
            var correo = $('#correo').val();
            var dataString = 'correo=' + correo;
            $('#alerta').html('<label>Enviando correo ...</label>');
            $.ajax({
                data: dataString,
                type: 'POST',
                url: "recuperarClave",
                success: function(salida)
                {
                    $("#alerta").delay(1000).fadeOut(1000);
                    setTimeout(function() {
                        $('#success2').html('<label>Correo enviado con exito</label>');
                    }, 2000);
                }

            });
        });
    });

    //consultamos is el usuario existe
    $(document).on("blur", '#usuario', function()
    {
        $.ajax({
            url: "<?php echo base_url() . 'index.php/administracion/consultar_usuario2'; ?>",
            data: {usuario: $('#usuario').val()},
            dataType: 'html',
            type: 'post',
            success: function(respuesta) {

              
                if (respuesta == 0)
                {
                    $('#usuario').val('');
                    $("#resultado").html("<div class='alert alert-danger alert-dismissible'>\n\
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h>\n\
            <i class='icon fa fa-ban'></i> \n\
        <strong>Alerta! </strong>No Existe Usuario....!!!</div>");

                }
            }
        });
    });

</script>