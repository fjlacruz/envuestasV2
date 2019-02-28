
<input type="hidden" id="url_respuesta" value="<?php echo base_url() ?>index.php/Formularios/operador">


<style>
    .formulario {

        background:#f5f5f7;

    }
    .titulo {

        background:#b8c7ce;

    }


</style>

<?php
for ($x = 0; $x <= count($datos) - 1; $x++) {

    $id_respuesta[] = $datos[$x][0];
    $id_pregunta[] = $datos[$x][1];
    $pregunta[] = $datos[$x][2];
    $id_encuesta = $datos[$x][3];
    $nombre = $datos[$x][4];
    $respuesta[] = $datos[$x][5];
    $tipo[] = $datos[$x][6];
}


$resultado_pregunta = array_unique($pregunta);

ksort($resultado_pregunta);

foreach ($resultado_pregunta as $indice) {
    $preguntan[] = $indice;
}


$ids_pregunta = array_unique($id_pregunta);

ksort($ids_pregunta);

foreach ($ids_pregunta as $indice) {
    $id_preguntan[] = $indice;
}


$j = 0;
$y = 0;
$a = 0;
?>
<section class="content">
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo $nombre ?></h3>

        </div>


        <div class='col-md-12'>&nbsp;</div>

        <div class='col-md-12'>&nbsp;</div>
        <div class="box-body">

            <div class="titulo col-sm-12">

                <div class="col-sm-12">
                    <label> 1-DATOS DEL ENCUESTADO</label>
                </div>
            </div>
            <div class="col-sm-12">&nbsp;</div>
            <div class="col-sm-12 formulario">
                <div class="col-sm-4">
                    <div class="titulo">
                        <center>  <label>ESTADO</label></center>
                        <select name="estados" id="estados"  class="form-control  " >
                            <option value="">SELECCIONE</option>
                            <?php
                            foreach ($lista_estados as $i => $estados) {
                                echo '<option value="' . $estados[0] . '">' . $estados[1] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="titulo">
                        <center> <label>EDAD</label></center>
                    </div>

                    <select name="edad" class="form-control"  >
                        <option value="">SELECCIONE</option>
                        <option value="25,18-30">18-30</option>
                        <option value="26,31-50">31-50</option>
                        <option value="27,51-60">51-60</option>
                        <option value="28,Mas de 65">Mas de 65</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <div class="titulo">
                        <center> <label>SEXO</label></center>
                    </div>
                    <select name="sexo" class="form-control"  >
                        <option value="">SELECCIONE</option>
                        <option value="29,M">MASCULINO</option>
                        <option value="30,F">FEMENINO</option>
                    </select>
                </div>
                <div class="col-sm-4">&nbsp;</div>
            </div>
            <div class="col-sm-12">&nbsp;</div>


            <?php for ($z = 0; $z <= count($preguntan) - 1; $z++) { ?>

                <div class="col-sm-12">&nbsp;</div>
                <div class="titulo col-sm-12">

                    <div class="col-sm-12">

                        <label > <?php echo ($z + 2) . '-' . $preguntan[$z] ?> </label>
                    </div>
                </div>
                <div class="col-sm-12">&nbsp;</div>
                <div class="col-sm-12 formulario">
                    <?php
                    $j = 0;
                    ?>
                    <?php while ($j <= count($datos) - 1) { ?>

                        <?php if (isset($pregunta[$a])) { ?>

                            <?php if ($preguntan[$y] == $pregunta[$a]) { ?>

                                <input type="hidden" value="<?php echo $tipo[$a] ?>" id="tipo" name="tipo[]">
                                <input type="hidden" value="<?php echo $id_pregunta[$a] ?>" id="id_pregunta" name="id_pregunta[]">
                                <input type="hidden" value="<?php echo $pregunta[$a] ?>" id="pregunta" name="pregunta[]">

                                <?php if ($tipo[$a] == "SIMPLE") { ?>

                                    <div class="col-sm-3">
                                        <div class="checkbox">
                                            <label><input type="radio" value="<?php echo $id_respuesta[$a] ?>" id="simple<?php echo $z ?>" name="simple<?php echo $z ?>[]"><?php echo $respuesta[$a] ?></label>
                                        </div>
                                    </div>

                                    <input type="hidden" value="<?php echo $respuesta[$a] ?>" id="respuesta" name="respuesta_simple[]">
                                    <input type="hidden" value="<?php echo $id_respuesta[$a] ?>" id="respuesta" name="id_respuesta_simple[]">

                                <?php } ?>

                                <?php if ($tipo[$a] == "MULTIPLE") { ?>
                                    <div class="col-sm-3">
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="multiple[]" value="<?php echo $id_respuesta[$a] ?>"><?php echo $respuesta[$a] ?></label>
                                        </div>
                                    </div>


                                    <input type="hidden" value="<?php echo $id_respuesta[$a] ?>" id="respuesta" name="id_respuesta_multiple[]">
                                <?php } ?> 

                                <?php if ($tipo[$a] == "CONDICIONADA" && $respuesta[$a] != "NO") { ?>

                                    <?php
                                    $array = array();
                                    $array[0] = $id_pregunta[$a];
                                    $array[1] = $id_respuesta[$a];
                                    $array[2] = $id_encuesta;

                                    $vars = $this->Pgsql->SELECTPLSQL('consultar_sub_respuestas', $array);
                                    ?> 

                                    <input type="hidden" value="<?php echo $id_pregunta[$a] ?>"  name="id_pregunta_condicionado[]">

                                    <div class="col-sm-3">
                                        <div class="checkbox">
                                            <label><input type="checkbox" id="condi<?php echo $z ?>" value="SI" name="condicionado[]">SI</label>
                                        </div>

                                        <div class="checkbox">
                                            <label><input type="checkbox" id="condib<?php echo $z ?>" value="NO" name="condicionado[]">NO</label>
                                        </div>
                                    </div>


                                    <?php if ($vars[0][0] != "") { ?>
                                        <div id='condicionado<?php echo $z ?>' style="display:none;">
                                            <?php
                                            for ($q = 0; $q <= count($vars) - 1; $q++) {

                                                $id_subrespuesta2 = $vars[$q][0];
                                                $id_respuesta2 = $vars[$q][1];
                                                $id_pregunta2 = $vars[$q][2];
                                                $id_encuesta2 = $vars[$q][3];
                                                $sub_respuesta = $vars[$q][4];
                                                ?>

                                                <div class="col-sm-3">
                                                    <div class="checkbox si">
                                                        <label><input type="checkbox" class="si<?php echo $z ?>" name="sub_respuesta[]" value="<?php echo $id_subrespuesta2 ?>"><?php echo $sub_respuesta ?></label>
                                                    </div>
                                                </div>

                                            <?php } ?>
                                        </div>
                                    <?php } ?>

                                <?php } ?>  

                            <?php } else { ?>
                                <?php
                                $j = count($datos) - 1;
                                ?>
                            <?php } ?>

                        <?php } ?>
                        <?php
                        $j = $j + 1;
                        $a = $a + 1;
                        ?>

                    <?php } ?>
                    <?php
                    $a = $a - 1;
                    $y = $y + 1;
                    ?>
                </div>
            <?php } ?>
            <div class="col-sm-12">&nbsp;</div>
            <div class="titulo col-sm-12">

                <div class="col-sm-12">
                    <label> <?php echo ($z + 2) ?>-POL&Iacute;TICA</label>
                </div>
            </div>
            <div class="col-sm-12">&nbsp;</div>
            <div class="col-sm-12 formulario">
                <div class="col-sm-6">
                    <div class="titulo">
                        <center> <label>¿CON CUAL TENDENCIA POL&Iacute;TICA USTED SE IDENTIFICA?</label></center>
                        <select name="tendencia" id="tendencia"  class="form-control  " >
                            <option value="">SELECCIONE</option>
                            <option value="31,CHAVISMO">CHAVISMO</option>
                            <option value="32,OPOSICION">OPOSICI&Oacute;N</option>
                            <option value="33,INDEPEDIENTE">INDEPEDIENTE</option>
                            <option value="34,NS/NR">NS/NR</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="titulo">
                        <center><label>¿ESTA INSCRITO EN EL REGISTRO ELECTORAL PERMANENTE?</label></center>

                        <select name="cne" class="form-control"  >
                            <option value="">SELECCIONE</option>
                            <option value="35,SI">SI</option>
                            <option value="36,NO">NO</option>
                            <option value="37,NS/NR">NS/NR</option>

                        </select> 
                    </div>
                </div>
            </div>

        </div>
        <div class="col-sm-12">&nbsp;</div>
        <div class="col-sm-12">&nbsp;</div>
    </div>
</div>

</section>

<script type="text/javascript">

    $(document).ready(function() {
        $('input[id="condi0"]').click(function() {
            document.getElementById('condicionado0').style.display = 'block';
            document.getElementById('condib0').checked = false;
        });
    });

    $(document).ready(function() {
        $('input[id="condib0"]').click(function() {
            document.getElementById('condicionado0').style.display = 'none';
            document.getElementById('condi0').checked = false;
            $('.si0').prop('checked', false);
        });
    });

    $(document).ready(function() {
        $('input[id="condi1"]').click(function() {
            document.getElementById('condicionado1').style.display = 'block';
            document.getElementById('condib1').checked = false;
        });
    });

    $(document).ready(function() {
        $('input[id="condib1"]').click(function() {
            document.getElementById('condicionado1').style.display = 'none';
            document.getElementById('condi1').checked = false;
            $('.si1').prop('checked', false);
        });
    });

    $(document).ready(function() {
        $('input[id="condi2"]').click(function() {
            document.getElementById('condicionado2').style.display = 'block';
            document.getElementById('condib2').checked = false;
        });
    });

    $(document).ready(function() {
        $('input[id="condib2"]').click(function() {
            document.getElementById('condicionado2').style.display = 'none';
            document.getElementById('condi2').checked = false;
            $('.si2').prop('checked', false);
        });
    });

    $(document).ready(function() {
        $('input[id="condi3"]').click(function() {
            document.getElementById('condicionado3').style.display = 'block';
            document.getElementById('condib3').checked = false;
        });
    });

    $(document).ready(function() {
        $('input[id="condib3"]').click(function() {
            document.getElementById('condicionado3').style.display = 'none';
            document.getElementById('condi3').checked = false;
            $('.si3').prop('checked', false);
        });
    });

    $(document).ready(function() {
        $('input[id="condi4"]').click(function() {
            document.getElementById('condicionado4').style.display = 'block';
            document.getElementById('condib4').checked = false;
        });
    });

    $(document).ready(function() {
        $('input[id="condib4"]').click(function() {
            document.getElementById('condicionado4').style.display = 'none';
            document.getElementById('condi4').checked = false;
            $('.si4').prop('checked', false);
        });
    });

    $(document).ready(function() {
        $('input[id="condi5"]').click(function() {
            document.getElementById('condicionado5').style.display = 'block';
            document.getElementById('condib5').checked = false;
        });
    });

    $(document).ready(function() {
        $('input[id="condib5"]').click(function() {
            document.getElementById('condicionado5').style.display = 'none';
            document.getElementById('condi5').checked = false;
            $('.si5').prop('checked', false);
        });
    });

    $(document).ready(function() {
        $('input[id="condi6"]').click(function() {
            document.getElementById('condicionado6').style.display = 'block';
            document.getElementById('condib6').checked = false;
        });
    });

    $(document).ready(function() {
        $('input[id="condib6"]').click(function() {
            document.getElementById('condicionado6').style.display = 'none';
            document.getElementById('condi6').checked = false;
            $('.si6').prop('checked', false);
        });
    });

    $(document).ready(function() {
        $('input[id="condi7"]').click(function() {
            document.getElementById('condicionado7').style.display = 'block';
            document.getElementById('condib7').checked = false;
        });
    });

    $(document).ready(function() {
        $('input[id="condib7"]').click(function() {
            document.getElementById('condicionado7').style.display = 'none';
            document.getElementById('condi7').checked = false;
            $('.si7').prop('checked', false);
        });
    });

    $(document).ready(function() {
        $('input[id="condi8"]').click(function() {
            document.getElementById('condicionado8').style.display = 'block';
            document.getElementById('condib8').checked = false;
        });
    });

    $(document).ready(function() {
        $('input[id="condib8"]').click(function() {
            document.getElementById('condicionado8').style.display = 'none';
            document.getElementById('condi8').checked = false;
            $('.si8').prop('checked', false);
        });
    });

    $(document).ready(function() {
        $('input[id="condi9"]').click(function() {
            document.getElementById('condicionado9').style.display = 'block';
            document.getElementById('condib9').checked = false;
        });
    });

    $(document).ready(function() {
        $('input[id="condib9"]').click(function() {
            document.getElementById('condicionado9').style.display = 'none';
            document.getElementById('condi9').checked = false;
            $('.si9').prop('checked', false);
        });
    });

    $(document).ready(function() {
        $('input[id="condi10"]').click(function() {
            document.getElementById('condicionado10').style.display = 'block';
            document.getElementById('condib10').checked = false;
        });
    });

    $(document).ready(function() {
        $('input[id="condib10"]').click(function() {
            document.getElementById('condicionado10').style.display = 'none';
            document.getElementById('condi10').checked = false;
            $('.si10').prop('checked', false);
        });
    });

    $(document).ready(function() {
        $('input[id="condi11"]').click(function() {
            document.getElementById('condicionado11').style.display = 'block';
            document.getElementById('condib11').checked = false;
        });
    });

    $(document).ready(function() {
        $('input[id="condib11"]').click(function() {
            document.getElementById('condicionado11').style.display = 'none';
            document.getElementById('condi11').checked = false;
            $('.si11').prop('checked', false);
        });
    });

    $(document).ready(function() {
        $('input[id="condi12"]').click(function() {
            document.getElementById('condicionado12').style.display = 'block';
            document.getElementById('condib12').checked = false;
        });
    });

    $(document).ready(function() {
        $('input[id="condib12"]').click(function() {
            document.getElementById('condicionado12').style.display = 'none';
            document.getElementById('condi12').checked = false;
            $('.si12').prop('checked', false);
        });
    });

    $(document).ready(function() {
        $('input[id="condi13"]').click(function() {
            document.getElementById('condicionado13').style.display = 'block';
            document.getElementById('condib13').checked = false;
        });
    });

    $(document).ready(function() {
        $('input[id="condib13"]').click(function() {
            document.getElementById('condicionado13').style.display = 'none';
            document.getElementById('condi13').checked = false;
            $('.si13').prop('checked', false);
        });
    });

    $(document).ready(function() {
        $('input[id="condi14"]').click(function() {
            document.getElementById('condicionado14').style.display = 'block';
            document.getElementById('condib14').checked = false;
        });
    });

    $(document).ready(function() {
        $('input[id="condib14"]').click(function() {
            document.getElementById('condicionado14').style.display = 'none';
            document.getElementById('condi14').checked = false;
            $('.si14').prop('checked', false);
        });
    });

    $(document).ready(function() {
        $('input[id="condi15"]').click(function() {
            document.getElementById('condicionado15').style.display = 'block';
            document.getElementById('condib15').checked = false;
        });
    });

    $(document).ready(function() {
        $('input[id="condib15"]').click(function() {
            document.getElementById('condicionado15').style.display = 'none';
            document.getElementById('condi15').checked = false;
            $('.si15').prop('checked', false);
        });
    });

    $(document).ready(function() {
        $('input[id="condi16"]').click(function() {
            document.getElementById('condicionado16').style.display = 'block';
            document.getElementById('condib16').checked = false;
        });
    });

    $(document).ready(function() {
        $('input[id="condib16"]').click(function() {
            document.getElementById('condicionado16').style.display = 'none';
            document.getElementById('condi16').checked = false;
            $('.si16').prop('checked', false);
        });
    });

    $(document).ready(function() {
        $('input[id="condi17"]').click(function() {
            document.getElementById('condicionado17').style.display = 'block';
            document.getElementById('condib17').checked = false;
        });
    });

    $(document).ready(function() {
        $('input[id="condib17"]').click(function() {
            document.getElementById('condicionado17').style.display = 'none';
            document.getElementById('condi17').checked = false;
            $('.si17').prop('checked', false);
        });
    });

    $(document).ready(function() {
        $('input[id="condi18"]').click(function() {
            document.getElementById('condicionado18').style.display = 'block';
            document.getElementById('condib18').checked = false;
        });

    });

    $(document).ready(function() {
        $('input[id="condib18"]').click(function() {
            document.getElementById('condicionado18').style.display = 'none';
            document.getElementById('condi18').checked = false;
            $('.si18').prop('checked', false);
        });

    });
    $(document).ready(function() {
        $('input[id="condi19"]').click(function() {
            document.getElementById('condicionado19').style.display = 'block';
            document.getElementById('condib19').checked = false;

        });
    });

    $(document).ready(function() {
        $('input[id="condib19"]').click(function() {

            document.getElementById('condicionado19').style.display = 'none';
            document.getElementById('condi19').checked = false;
            $('.si019').prop('checked', false);

        });
    });

    $(document).ready(function() {
        $('input[id="condi20"]').click(function() {
            document.getElementById('condicionado20').style.display = 'block';
            document.getElementById('condib20').checked = false;
        });
    });

    $(document).ready(function() {
        $('input[id="condib20"]').click(function() {
            document.getElementById('condicionado20').style.display = 'none';
            document.getElementById('condi20').checked = false;
            $('.si20').prop('checked', false);
        });
    });

</script>
<script type="text/javascript">


///////////////////////////////////////////////////////////////////////estados///////////////////////////////////////////////////////////////////////////////////////    
    $(document).on("change", '#estados', function() {

        $("#combMunicipio").load("<?php echo base_url() . 'index.php/Formularios/obtenerMunicipio?id_estado='; ?>" + $(this).val(), function() {
            //refrescar parroquia///
            $('#combParroquia').selectpicker('refresh');
            $('#combMunicipio').selectpicker('refresh');
        });
    });


    $(document).on("change", '#combMunicipio', function() {

        $("#combParroquia").load("<?php echo base_url() . 'index.php//Formularios/obtenerParroquia?id_municipio='; ?>" + $(this).val(), function() {
            $('#combParroquia').selectpicker('refresh');

        });
    });


    function soloNumeros(e)
    {
        var key = window.Event ? e.which : e.keyCode
        return ((key >= 48 && key <= 57) || (key == 8))
    }
</script>
