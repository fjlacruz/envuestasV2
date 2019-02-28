
<script src="<?php echo base_url(); ?>application/recursos/js/bootbox.js"></script>


<section class="content">
    <div class="box box-danger collapsed-box">
        <div class="box-header with-border">
            <h3 class="box-title">Crear Nuevo Usuario</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
<!--                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <form id="formulario" action="" method="POST" name="formulario" >

                        <div class="col-sm-12"  id='resultado'></div>

                        <div class="form-group col-sm-6">
                            <label>C&eacute;dula</label> 
                            <input type="text" autocomplete="off" class="form-control" id="cedula" maxlength="8" onKeyPress="return soloNumeros(event)" name="cedula" placeholder="C&eacute;dula">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Nombres</label> 
                            <input type="text"  class="form-control" id="nombres" onKeyPress="return soloLetras(event)" name="nombres" placeholder="Nombres" onkeyup="javascript:this.value = this.value.toUpperCase()">
                        </div>
                        <div class="col-sm-12"></div>
                        <div class="form-group col-sm-6">
                            <label>Apellidos</label> 
                            <input type="text" class="form-control" id="apellidos" onKeyPress="return soloLetras(event)" name="apellidos" placeholder="Apellidos" onkeyup="javascript:this.value = this.value.toUpperCase()">
                        </div>

                        <div class="form-group col-sm-6">
                            <label>Correo</label> 
                            <input type="text" class="form-control" id="correo" name="correo" onkeyup="javascript:this.value = this.value.toUpperCase()" placeholder="Correo El&eacute;ctronico">
                        </div>
                        <div class="col-sm-12"></div>
                        <div class="form-group col-sm-6">
                            <label>Usuario</label> 
                            <input type="text"  class="form-control" id="usuario" onkeyup="javascript:this.value = this.value.toUpperCase()" onKeyPress="return soloLetras(event)" name="usuario" placeholder="Nombre de Usuario">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Rol</label> 
                            <select name="rol" id="rol"  class="form-control">
                                <option value="">Selecione...</option>
                                <?php
                                foreach ($roles as $i => $rol) {
                                    echo '<option value = "' . $rol[1] . '">' . $rol[0] . '</option>';
                                }
                                ?>          
                            </select>
                        </div>
                        <div class="col-sm-12"></div>
                        <div class="form-group col-sm-6">
                            <label>Clave</label>
                            <input type="password" name="confirmar_clave" id="confirmar_clave" class="form-control" placeholder="Clave de Acceso">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Confirmar Clave</label> 
                            <input type="password" name="clave" id="clave" class="form-control" placeholder="Confirme su Clave de Acceso">
                        </div>
                        <div class="col-sm-12">&nbsp;</div>

                        <div class="form-group col-sm-6">
                            <button  type="" class="btn btn-success" id="guardar">
                                <span class="ladda-label">Registrar</span>
                            </button>
                        </div>
                        <div id='resultado2'></div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Administraci&oacute;n de Usuarios</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">

                    <div class='filterable'>
                        <div class='panel-heading'>
                            <div class='pull-right'>
                                <button class='btn btn-danger btn-xs btn-filter' data-content='Realizar Consultas Cruzadas' data-toggle='popover' data-trigger='hover' data-placement='top'><span class='fa fa-filter'></span>Filtrar</button>
                            </div>
                        </div>


                        <table id="nueva" class="table" >
                            <thead>
                                <tr class="filters">
                                    <th onkeypress="return soloLetras(event)" >Rol</th>   
                                    <th onkeypress="return soloNumeros(event)">Cedula</th>
                                    <th onkeypress="return soloLetras(event)">Nombre</th>
                                    <th onkeypress="return soloLetras(event)">Apellido</th>
                                    <th onkeypress="return soloLetras(event)">Estatus</th>
                                    <th>Editar</th>        
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($x = 0; $x <= count($datos) - 1; $x++) {
                                    $cedula = $datos[$x][0];
                                    $rol = $datos[$x][1];
                                    $nombre = $datos[$x][2];
                                    $apellido = $datos[$x][3];
                                    $estatus = $datos[$x][6];
                                    $id_usuario = $datos[$x][7];
                                    $i = $x + 1;
                                    ?>
                                    <tr>
                                        <td><?php echo $rol ?></td>  
                                        <td><?php echo $cedula ?></td>            
                                        <td><?php echo $nombre ?></td>               
                                        <td><?php echo $apellido ?> </td>
                                        <td><?php echo $estatus ?></td>                
                                        <td><button type="button" data-id="<?php echo $id_usuario ?>" class="btn btn-default editButton">Editar</button></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                    <form id="userForm" method="post" class="form-horizontal" style="display: none;">
                        <div class="col-sm-12"></div>
                        <input type="hidden"  id="id" name="id" >
                        <div class="form-group col-sm-12">
                            <label >Nombre</label> 
                            <input type="text"  class="form-control " id="nombres" name="nombres" readonly>
                        </div>
                        <div class="form-group col-sm-4"></div>

                        <div class="form-group col-sm-12">
                            <label>Apellido</label>
                            <input type="text"  class="form-control " id="apellidos" name="apellidos" readonly>

                        </div>

                        <div class="form-group col-sm-12">
                            <label>Rol</label>
                            <select name="rol" id="rol"  class="form-control " required >
                                <?php
                                foreach ($roles as $i => $rol) {
                                    echo '<option value = "' . $rol[1] . '">' . $rol[0] . '</option>';
                                }
                                ?>  
                            </select>
                        </div>

                        <div class="form-group col-sm-12">
                            <label>Estatus del Usuario</label>

                            <select name="estatus" id="estatus"  class="form-control " required >
                                <option value="TRUE">HABILITAR</option>
                                <option value="FALSE">DESHABILITAR</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-5 col-xs-offset-3">
                                <button type="submit" class="btn btn-success">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>




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
                        url: "<?php echo base_url() . 'index.php/administracion/actualizar_estatus'; ?>",
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
                url: "<?php echo base_url() . 'index.php/administracion/consultarId/'; ?>" + id,
                method: 'GET'

            }).success(function(data) {
                // Populate the form fields with the data returned from server

                var obj = JSON.parse(data);
                $('#userForm')
                        .find('[name="id"]').val(obj.id_usuario).end()
                        .find('[name="nombres"]').val(obj.nombres).end()
                        .find('[name="apellidos"]').val(obj.apellidos).end()
                        .find('[name="rol"]').val(obj.rol).end()
                        .find('[name="estatus"]').val(obj.estatus).end();
                // Show the dialog
                bootbox
                        .dialog({
                            title: 'Editar el Estatus del Usuario',
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
    //------------------------------------------------- Solo Letra-------------------------------------------------//

    function soloLetras(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " qwertyuiopñlkjhgfdsazxcvbnm";
        especiales = "8-37-39-46";
        tecla_especial = false
        for (var i in especiales) {
            if (key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }

        if (letras.indexOf(tecla) == -1 && !tecla_especial) {
            return false;
        }
    }

    function soloNumeros(e)
    {
        var key = window.Event ? e.which : e.keyCode
        return ((key >= 48 && key <= 57) || (key == 8))
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  </script>

<!--============= script para registar usuarios ============================================== -->
<script>
    $(document).ready(function() {


        $('#formulario').formValidation({
            framework: 'bootstrap',
            fields: {
                cedula: {
                    row: '.col-sm-6',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        },
                        stringLength: {
                            min: 6,
                            max: 8,
                            message: 'M&iacute;nimo 6 m&aacute;ximo 8 d&iacute;gitos'
                        }

                    }
                },
                nombre: {
                    row: '.col-sm-6',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                apellido: {
                    row: '.col-sm-6',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                correo: {
                    row: '.col-sm-6',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        },
                        regexp: {
                            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                            message: ' '
                        }
                    }
                },
                usuario: {
                    row: '.col-sm-6',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                rol: {
                    row: '.col-sm-6',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
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
    });</script>


<script>
    $(document).on("keyup", '#cedula', function()
    {
        $.ajax({
            url: "<?php echo base_url() . 'index.php/administracion/consultar_usuario'; ?>",
            data: {cedula: $('#cedula').val()},
            dataType: 'html',
            type: 'post',
            success: function(respuesta) {

                if (respuesta == 1)
                {
                    $('#cedula').val('');
                    $("#nombres").val('');
                    $("#apellidos").val('');
                    $("#resultado").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='icon fa fa-ban'></i> Alerta...!     Nro de C&eacute;dula YA registrado</div>");
                }
            }
        });
    });
    $(document).on("keyup", '#usuario', function()
    {
        $.ajax({
            url: "<?php echo base_url() . 'index.php/administracion/consultar_usuario2'; ?>",
            data: {usuario: $('#usuario').val()},
            dataType: 'html',
            type: 'post',
            success: function(respuesta) {

                if (respuesta == 1)
                {
                    $('#usuario').val('');
                    $("#resultado").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h4><i class='icon fa fa-ban'></i> Alert!</h4> Nombre de Usuario No Disponible</div>");
                }
            }
        });
    });</script>


<script>
    //======================= Funcion para registrar usuarios============= 
    $(document).ready(function() {
        $("#guardar").click(function() {//evento javascript onclick
            // Declaracion de variables

            var dataUser = {
                "cedula": $("#cedula").val(),
                "usuario": $("#usuario").val(),
                "clave": $("#clave").val(),
                "confirmar_clave": $("#confirmar_clave").val(),
                "nombres": $("#nombres").val(),
                "apellidos": $("#apellidos").val(),
                "correo": $("#correo").val(),
                "rol": $("#rol").val()
            };
            //validamos que no quede ningun campo vacio
            if (dataUser.cedula === '' || dataUser.usuario === '' || dataUser.clave === '' || dataUser.nombres === '' || dataUser.apellidos === '' || dataUser.correo === '' || dataUser.rol === '') {
                // mensaje en caso de que exista un campo vacio del formulario
                $("#resultado").html("<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='icon fa fa-warning'></i> Alerta...! Informacion Incompleta, debe llenar todos los campos....</div>");
                //En caso contrario que no hayan campos vacios enviamos los parametros por ajax
            } else {
                var user = 1;
            }
            if (dataUser.clave !== dataUser.confirmar_clave) {
                $("#resultado2").html("<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button>Las contrase&ntilde;a deben ser iguales</div>");
            } else {
                var cont = 1;
            }

            if (user === 1 && cont === 1) {
                $.ajax({
                    type: 'POST',
                    dataType: 'html',
                    data: dataUser,
                    url: "<?php echo base_url() . 'index.php/administracion/registrar_usuario'; ?>",
                    // mostramos un loader antes de enviar los datos
                    beforeSend: function() {
                        $("#resultado2").show();
                        $("#resultado2").html('<div><?php echo '<img width="2%" src="' . base_url() . 'application/recursos/imagenes/ajax-loader_1.gif">'; ?></div>');
                    },
                    //Despues de enviar los datos limpiamos los campos del formulario
                    success: function(respuesta) {

                        $("#cedula").val(''),
                                $("#usuario").val(''),
                                $("#clave").val(''),
                                $("#confirmar_clave").val(''),
                                $("#nombres").val(''),
                                $("#apellidos").val(''),
                                $("#correo").val(''),
                                $("#rol").val(''),
                                // Enviamos un mensaje de exito al insertar los datos
                                $("#resultado").html("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='icon fa fa-check'></i> Suceso..!Los Datos Fueron registrados Exitosamente</div>");
                    }
                });
                //Redirijimos luego de enviar los datos 
                setInterval(function() {
                    location.reload();
                }, 3000); //Lo temporizamos a 3 segundos para mostrar el mensaje al usuario
            }
        });
    });
</script>



<script>
    $(document).ready(function() {
        $("#cedula").keyup(function()
        {
            if ($("#cedula").val() != '' && $("#cedula").val().length > 6)
            {
                var cedula = document.getElementById("cedula").value;
                $.ajax({
                    type: "GET",
                    url: "http://192.168.10.219/api-services/index.php/personas/cedula/" + cedula,
                    dataType: "json",
                    success: function(data) {

                        if (data == 404) {

                            $("#nombres").val('');
                            $("#apellidos").val('');
                            $('#nombres').removeAttr("readonly");
                            $('#apellidos').removeAttr("readonly");
                        } else {

                            var obj = eval("(" + JSON.stringify(data) + ")");
                            $('#nombres').attr("readonly", true);
                            $('#apellidos').attr("readonly", true);
                            $("#nombres").val(obj.response.nombres);
                            if (obj.response.segundo_apellido == null) {
                                $("#apellidos").val(obj.response.primer_apellido);
                            } else {
                                $("#apellidos").val((obj.response.primer_apellido) + ' ' + (obj.response.segundo_apellido));
                            }

                        }
                    }
                });
            }
        });
    });

</script>
