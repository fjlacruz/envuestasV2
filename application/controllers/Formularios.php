<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Formularios extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Pgsql');
        $this->load->model('Events_model');
        $this->load->library('Configemail');
    }

    public function verCantidades() {

        extract($_GET);

        $arrayData = array();
        $arrayData[0] = $id_encuesta;
        $vars = $this->Pgsql->SELECTPLSQL('contar_asignacion_telefonica', $arrayData);

        $desactivada = $vars[0][1];
        $eliminada = $vars[0][2];
        $sactifactoria = $vars[0][3];

        echo "
 
        <div class='col-lg-4 col-xs-6'>
            <div class='small-box bg-green'>
                <div class='inner'>
                    <h3>$sactifactoria</h3>
                    <p>Encuesta Efectivas</p>
                </div>
                <div class='icon'>
                    <i class='fa fa-check'></i>
                </div>
            </div>
        </div>
        <div class='col-lg-4 col-xs-6'>
            <div class='small-box bg-yellow'>
                <div class='inner'>
                    <h3>$desactivada</h3>
                    <p>Tel&eacute;fonos Desactivados</p>
                </div>
                <div class='icon'>
                    <i class='fa fa-exclamation-circle '></i>
                </div>
            </div>
        </div>

        <div class='col-lg-4 col-xs-6'>
            <div class='small-box bg-red'>
                <div class='inner'>
                    <h3>$eliminada</h3>
                    <p>Tel&eacute;fonos Eliminados</p>
                </div>
                <div class='icon'>
                    <i class='fa fa-close '></i>
                </div>
            </div>
        </div>

       
         ";
    }

    public function inicio() {
        $arrayData = array();

        $vars['datos'] = $this->Pgsql->SELECTPLSQL('consultar_encuestas_conformada2', $arrayData);

        $this->load->view('plantillas/procesos/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/formulario/inicio', $vars);
        $this->load->view('plantillas/footer');
    }

    public function verFormulario() {
        extract($_GET);

        $array = array();
        $arrayData = array();

        $data_estado['lista_estados'] = $this->Pgsql->SELECTPLSQL('consultar_estado', $array);

        $arrayData[0] = $id_encuesta;
        $vars['datos'] = $this->Pgsql->SELECTPLSQL('consultar_formulario_encuesta', $arrayData);

        $this->load->view('plantillas/procesos/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/formulario/verFormulario', $vars + $data_estado);
        $this->load->view('plantillas/footer');
    }

    public function enviar() {
        extract($_GET);

        $host = $_SERVER["HTTP_HOST"];
        $url = $_SERVER["REQUEST_URI"];

        $ruta = "http://" . $host . '/encuestaV2/index.php/Formularios/verFormulario?&id_encuesta=' . $id_encuesta;


        $configuracionSrvCorreo = $this->configemail->ConfigSrvEmail();
        $this->email->initialize($configuracionSrvCorreo);
        $this->email->from('cesppa@cesppa.gob.ve');
        $this->email->to('idsistemas15@gmail.com');
        $this->email->subject('Constancia de Pago');
        $this->email->message($ruta);

        $this->email->send();
    }

    public function operador() {

        extract($_GET);

        $array = array();
        $array_encuesta = array();

        $array[0] = $id_encuesta;
        $array_encuesta['id_encuesta'] = $id_encuesta;

        $vars['datos'] = $this->Pgsql->SELECTPLSQL('consultar_cantidad_nacional_encuesta', $array);
        $vars2['cantidadEstadal'] = $this->Pgsql->SELECTPLSQL('consultar_cantidad_operadoras_encuestas', $array);

        $this->load->view('plantillas/procesos/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/formulario/preFormulario', $vars + $vars2 + $array_encuesta);
        $this->load->view('plantillas/footer');
    }

    public function verEncuesta() {

        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario = ($variablesSesion['id_usuario']);

        extract($_GET);

        $array = array();
        $arrayData = array();
        $array_encuesta = array();

        $arrayData[0] = $id_encuesta;
//        $arrayData[1] = $id_usuario;
        $arrayData[1] = $operadora;

        $vars2['datosEncuesta'] = $this->Pgsql->SELECTPLSQL('consultar_encuestas_conformada_operador_nacional', $arrayData);

        $data_estado['lista_estados'] = $this->Pgsql->SELECTPLSQL('consultar_estado', $array);

        $array_encuesta[0] = $id_encuesta;
        $vars['datos'] = $this->Pgsql->SELECTPLSQL('consultar_formulario_encuesta', $array_encuesta);

        $this->load->view('plantillas/procesos/header');
        $this->load->view('plantillas/menu');
//        $this->load->view('procesos/formulario/inicioOperador', $vars + $arra);
        $this->load->view('procesos/formulario/verFormularioOperador', $vars + $vars2 + $data_estado);
        $this->load->view('plantillas/footer');
    }

    public function verFormularioOperador() {

        extract($_GET);
        $a['numero'] = $numero;
        $b['id_operadora'] = $id_operadora;
        $array = array();
        $arrayData = array();

        $data_estado['lista_estados'] = $this->Pgsql->SELECTPLSQL('consultar_estado', $array);

        $arrayData[0] = $id;
        $vars['datos'] = $this->Pgsql->SELECTPLSQL('consultar_formulario_encuesta', $arrayData);

        $this->load->view('plantillas/procesos/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/formulario/verFormularioOperador', $b + $vars + $data_estado + $a);
        $this->load->view('plantillas/footer');
    }

    public function verEncuesta_estadal() {

        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario = ($variablesSesion['id_usuario']);
        extract($_GET);

        $array = array();
        $arrayData = array();
        $array_encuesta = array();
        $arrayData[0] = $id_encuesta;
        //$arrayData[1] = $id_usuario;
        $arrayData[1] = $operadora;

        $vars2['datosEncuesta'] = $this->Pgsql->SELECTPLSQL('consultar_encuestas_conformada_operador', $arrayData);
        $data_estado['lista_estados'] = $this->Pgsql->SELECTPLSQL('consultar_estado', $array);

        $array_encuesta[0] = $id_encuesta;
        $vars['datos'] = $this->Pgsql->SELECTPLSQL('consultar_formulario_encuesta', $array_encuesta);

        $this->load->view('plantillas/procesos/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/formulario/verFormularioOperador', $vars + $vars2 + $data_estado);
        $this->load->view('plantillas/footer');
    }

    public function insertar_respuesta() {


        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario = ($variablesSesion['id_usuario']);
        $estatus = 1;
        setlocale(LC_ALL, 'es_VE.UTF-8');
        date_default_timezone_set('America/Caracas');
        $hoy = date("d-m-Y");
        $fecha_registro = substr($hoy, 0, 10);

        extract($_POST);

        $asimple0 = array();
        $asimple1 = array();
        $asimple2 = array();
        $asimple3 = array();
        $asimple4 = array();
        $asimple5 = array();
        $asimple6 = array();
        $asimple7 = array();
        $asimple8 = array();
        $asimple9 = array();
        $asimple10 = array();
        $asimple11 = array();
        $asimple12 = array();
        $asimple13 = array();
        $asimple14 = array();
        $asimple15 = array();
        $asimple16 = array();
        $asimple17 = array();
        $asimple18 = array();
        $asimple19 = array();
        $asimple20 = array();
        $id_multiple = array();
        $id_condicionadas = array();
        $id_sub_respuesta = array();

        if (isset($simple0)) {
            foreach ($simple0 as $indice) {
                $asimple0[] = $indice;
            }
        }
        if (isset($simple1)) {
            foreach ($simple1 as $indice) {
                $asimple1[] = $indice;
            }
        }
        if (isset($simple2)) {
            foreach ($simple2 as $indice) {
                $asimple2[] = $indice;
            }
        }
        if (isset($simple3)) {
            foreach ($simple3 as $indice) {
                $asimple3[] = $indice;
            }
        }
        if (isset($simple4)) {
            foreach ($simple4 as $indice) {
                $asimple4[] = $indice;
            }
        }
        if (isset($simple5)) {
            foreach ($simple5 as $indice) {
                $asimple5[] = $indice;
            }
        }
        if (isset($simple6)) {
            foreach ($simple6 as $indice) {
                $asimple6[] = $indice;
            }
        }
        if (isset($simple7)) {
            foreach ($simple7 as $indice) {
                $asimple7[] = $indice;
            }
        }
        if (isset($simple8)) {
            foreach ($simple8 as $indice) {
                $simple8[] = $indice;
            }
        }
        if (isset($simple9)) {
            foreach ($simple9 as $indice) {
                $asimple9[] = $indice;
            }
        }
        if (isset($simple10)) {
            foreach ($simple10 as $indice) {
                $asimple10[] = $indice;
            }
        }
        if (isset($simple11)) {
            foreach ($simple11 as $indice) {
                $asimple11[] = $indice;
            }
        }
        if (isset($simple12)) {
            foreach ($simple12 as $indice) {
                $asimple12[] = $indice;
            }
        }
        if (isset($simple13)) {
            foreach ($simple13 as $indice) {
                $asimple13[] = $indice;
            }
        }
        if (isset($simple14)) {
            foreach ($simple14 as $indice) {
                $asimple14[] = $indice;
            }
        }
        if (isset($simple15)) {
            foreach ($simple15 as $indice) {
                $asimple15[] = $indice;
            }
        }
        if (isset($simple16)) {
            foreach ($simple16 as $indice) {
                $asimple16[] = $indice;
            }
        }
        if (isset($simple17)) {
            foreach ($simple17 as $indice) {
                $asimple17[] = $indice;
            }
        }
        if (isset($simple18)) {
            foreach ($simple18 as $indice) {
                $asimple18[] = $indice;
            }
        }
        if (isset($simple19)) {
            foreach ($simple19 as $indice) {
                $asimple19[] = $indice;
            }
        }
        if (isset($simple20)) {
            foreach ($simple20 as $indice) {
                $asimple20[] = $indice;
            }
        }


        $simple = array_merge($asimple0, $asimple1, $asimple2, $asimple3, $asimple4, $asimple5, $asimple6, $asimple7, $asimple8, $asimple9, $asimple10, $asimple11, $asimple12, $asimple13, $asimple14, $asimple15, $asimple16, $asimple17, $asimple18, $asimple19, $asimple20);


        if (isset($multiple)) {
            foreach ($multiple as $indice) {
                $id_multiple[] = $indice;
            }
        }
        if (isset($condicionado)) {
            foreach ($condicionado as $indice) {
                $id_condicionadas[] = $indice;
            }
        }
        if (isset($sub_respuesta)) {
            foreach ($sub_respuesta as $indice) {
                $id_sub_respuesta[] = $indice;
            }
        }

        $n = 0;
        $j = 0;
        $a = 0;
        $b = 0;
        $c = 0;
        $d = 0;
        $f = 0;
        $g = 0;
        $contar_pregunta = count($pregunta) - 1;

        while ($j <= $contar_pregunta) {

            if ($tipo[$j] == 'SIMPLE') {

//// insertar simple 
                if (isset($simple)) {
                    while ($n <= count($simple) - 1) {

                        if ($simple[$n] == $id_respuesta_simple[$b]) {
                            $arrayA = array();
                            $array = array();
                            $arrayA[0] = $simple[$n];

                            $respuesta = $this->Pgsql->SELECTPLSQL('consultar_id_respuesta', $arrayA);

                            $array[0] = $id_encuesta; // id_encuesta
                            $array[1] = $respuesta[0][0]; //id_pregunta
                            $array[2] = mb_strtoupper($respuesta[0][1], 'UTF-8'); // pregunta
                            $array[3] = $simple[$n]; //id_respuesta
                            $array[4] = mb_strtoupper($respuesta[0][2], 'UTF-8'); // pregunta
                            $array[5] = 0; //id_sub_respuesta
                            $array[6] = ""; //sub_respuesta
                            $array[7] = $id_operadora;
                            $array[8] = $tlf;
                            $array[9] = $id_usuario;
                            $array[10] = $fecha_registro;
                            $array[11] = $id_usuario;
                            $array[12] = $estatus;

                            $this->Pgsql->SELECTPLSQL('insertar_resultados_encuesta', $array);

                            $n = $n + 1;
                        }
                        $b = $b + 1;
                    }
                }
            }
            if ($tipo[$j] == 'MULTIPLE') {

//// insertar multiple
                if (isset($multiple)) {
                    while ($c <= count($multiple) - 1) {

                        if ($multiple[$c] == $id_respuesta_multiple[$d]) {
                            $arrayAa = array();
                            $arraya = array();
                            $arrayAa[0] = $multiple[$c];

                            $respuesta = $this->Pgsql->SELECTPLSQL('consultar_id_respuesta', $arrayAa);

                            $arraya[0] = $id_encuesta; // id_encuesta
                            $arraya[1] = $respuesta[0][0]; //id_pregunta
                            $arraya[2] = mb_strtoupper($respuesta[0][1], 'UTF-8'); // pregunta
                            $arraya[3] = $multiple[$c]; //id_respuesta
                            $arraya[4] = mb_strtoupper($respuesta[0][2], 'UTF-8'); //respuesta
                            $arraya[5] = 0; //id_sub_respuesta
                            $arraya[6] = ""; //sub_respuesta
                            $arraya[7] = $id_operadora;
                            $arraya[8] = $tlf;
                            $arraya[9] = $id_usuario;
                            $arraya[10] = $fecha_registro;
                            $arraya[11] = $id_usuario;
                            $arraya[12] = $estatus;

                            $this->Pgsql->SELECTPLSQL('insertar_resultados_encuesta', $arraya);
                            $c = $c + 1;
                        }
                        $d = $d + 1;
                    }
                }
            }
            if ($tipo[$j] == 'CONDICIONADA') {

// insertar condicionada
                if (isset($condicionado)) {
                    while ($a <= count($condicionado) - 1) {

                        if ($condicionado[$a] == "SI") {

                            $arraAa = array();
                            $arraa = array();
                            $arraAa[0] = $id_pregunta_condicionado[$a];

                            $respuesta = $this->Pgsql->SELECTPLSQL('consultar_sub_respuestas_si', $arraAa);

                            while ($g < count($sub_respuesta)) {
                                $bb = array();
                                $bb[0] = $sub_respuesta[$g];

                                $sub_respuesta_id = $this->Pgsql->SELECTPLSQL('consultar_sub_respuestas_si2', $bb);

                                $arraa[0] = $id_encuesta;
                                $arraa[1] = $respuesta[0][0]; //id_pregunta
                                $arraa[2] = mb_strtoupper($respuesta[0][1], 'UTF-8'); // pregunta
                                if ($g == 0) {
                                    $arraa[3] = $respuesta[0][2]; //id_respuesta
                                    $arraa[4] = "SI";
                                } else {
                                    $arraa[3] = 0; //id_respuesta
                                    $arraa[4] = "";
                                }
                                $arraa[5] = $sub_respuesta_id[0][3]; //id_sub_respuesta
                                $arraa[6] = $sub_respuesta_id[0][4]; //$sub_respuesta;
                                $arraa[7] = $id_operadora;
                                $arraa[8] = $tlf;
                                $arraa[9] = $id_usuario;
                                $arraa[10] = $fecha_registro;
                                $arraa[11] = $id_usuario;
                                $arraa[12] = $estatus;

                                $this->Pgsql->SELECTPLSQL('insertar_resultados_encuesta', $arraa);
                                $g = $g + 1;
                            }
                            $g = 0;
                            $f = $f + 1;
                        } else {
                            $arrayAaa = array();
                            $arrayaa = array();
                            $arrayAaa[0] = $id_pregunta_condicionado[$a];
                            $arrayAaa[1] = "NO";

                            $respuesta = $this->Pgsql->SELECTPLSQL('consultar_sub_respuestas_no', $arrayAaa);

                            $arrayaa[0] = $id_encuesta;
                            $arrayaa[1] = $respuesta[0][0]; //id_pregunta
                            $arrayaa[2] = mb_strtoupper($respuesta[0][1], 'UTF-8'); // pregunta
                            $arrayaa[3] = $respuesta[0][2]; //id_respuesta
                            $arrayaa[4] = "NO";
                            $arrayaa[5] = 0; //id_sub_respuesta
                            $arrayaa[6] = ""; //$sub_respuesta;
                            $arrayaa[7] = $id_operadora;
                            $arrayaa[8] = $tlf;
                            $arrayaa[9] = $id_usuario;
                            $arrayaa[10] = $fecha_registro;
                            $arrayaa[11] = $id_usuario;
                            $arrayaa[12] = $estatus;

                            $this->Pgsql->SELECTPLSQL('insertar_resultados_encuesta', $arrayaa);
                            $f = $f + 1;
                        }

                        $a = $a + 1;
                    }
                }
            }
            $j = $j + 1;
        }
        $estado_array = array();
        $estado_array[0] = $estados;

        $estados_nombre = $this->Pgsql->SELECTPLSQL('consultar_estado_id', $estado_array);


        for ($w = 0; $w < 5; $w++) {
            $ar = array();
            reset($ar);
            //insertaremos los  campos que son fijos 
            $ar[0] = $id_encuesta;

            if ($w == 0) {
                $ar[1] = 1; //id_pregunta
                $ar[2] = '¿EN QUE ESTADO VIVE?'; // pregunta
                $ar[3] = $estados; //id_respuesta
                $ar[4] = $estados_nombre[0][0]; // respuesta
            } elseif ($w == 1) {
                $edadN = explode(",", $edad);
                $edad_id = $edadN[0];
                $edad_nombre = $edadN[1];

                $ar[1] = 2; //id_pregunta
                $ar[2] = '¿QUE EDAD TIENE?'; // pregunta
                $ar[3] = $edad_id; //id_respuesta
                $ar[4] = $edad_nombre; // respuesta
            } elseif ($w == 2) {

                $sexoN = explode(",", $sexo);
                $sexo_id = $sexoN[0];
                $sexo_nombre = $sexoN[1];

                $ar[1] = 3; //id_pregunta
                $ar[2] = '¿CUAL ES SU GENERO?'; // pregunta
                $ar[3] = $sexo_id; //id_respuesta
                $ar[4] = $sexo_nombre; // respuesta
            } elseif ($w == 3) {
                $tendenciaN = explode(",", $tendencia);
                $tendencia_id = $tendenciaN[0];
                $tendencia_nombre = $tendenciaN[1];

                $ar[1] = 4; //id_pregunta
                $ar[2] = '¿CON CUAL TENDENCIA POLITICA USTED SE IDENTIFICA?'; // pregunta
                $ar[3] = $tendencia_id; //id_respuesta
                $ar[4] = $tendencia_nombre; // respuesta
            } else {
                $cneN = explode(",", $cne);
                $cne_id = $cneN[0];
                $cne_nombre = $cneN[1];

                $ar[1] = 5; //id_pregunta
                $ar[2] = '¿ESTA INSCRITO EN EL REGISTRO ELECTORAL PERMANENTE?'; // pregunta
                $ar[3] = $cne_id; //id_respuesta
                $ar[4] = $cne_nombre; // respuesta
            }
            $ar[5] = 0; //id_sub_respuesta
            $ar[6] = ""; //$sub_respuesta;
            $ar[7] = $id_operadora;
            $ar[8] = $tlf;
            $ar[9] = $id_usuario;
            $ar[10] = $fecha_registro;
            $ar[11] = $id_usuario;
            $ar[12] = $estatus;

            $this->Pgsql->SELECTPLSQL('insertar_resultados_encuesta', $ar);
        }


        $arr = array();
        $arr[0] = $id_operadora;
        $arr[1] = $tlf;
        $this->Pgsql->SELECTPLSQL('telefono_asignado_satisfactorio', $arr);

        $arrayData = array();
        $arrayData[0] = $id_encuesta;

        $vars = $this->Pgsql->SELECTPLSQL('limite_cantidad', $arrayData);

        $cantv_efectiva = $vars[0][0];
        $digitel_efectiva = $vars[0][1];
        $movilnet_efectiva = $vars[0][2];
        $movistar_efectiva = $vars[0][3];
        $limite_cantv = $vars[0][4];
        $limite_digitel = $vars[0][5];
        $limite_movilnet = $vars[0][6];
        $limite_movistar = $vars[0][7];


        if ($cantv_efectiva >= $limite_cantv && $digitel_efectiva >= $limite_digitel && $movilnet_efectiva >= $limite_movilnet && $movistar_efectiva >= $limite_movistar) {
            $this->Pgsql->SELECTPLSQL('update_estatus_encuesta_2', $arrayData);

            $vars = $this->Pgsql->SELECTPLSQL('consultar_numeros_nousados', $arrayData);

            for ($x = 0; $x < count($vars); $x++) {
                $array[0] = $vars[$x][0];

                $this->Pgsql->SELECTPLSQL('reactivar_telefonos', $array);
            }
        }
    }

    public function desactivar_numero() {

        extract($_POST);
        $array = array();
        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario = ($variablesSesion['id_usuario']);

        $array[0] = $id_operadora;
        $array[1] = $tlf;
        $array[2] = $id_usuario;

        $this->Pgsql->SELECTPLSQL('desactivar_telefono_asignado', $array);
    }

    public function eliminar_numero() {

        extract($_POST);
        $array = array();
        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario = ($variablesSesion['id_usuario']);

        $array[0] = $id_operadora;
        $array[1] = $tlf;
        $array[2] = $id_usuario;

        $this->Pgsql->SELECTPLSQL('eliminar_telefono_asignado', $array);
    }

//======= FUNCION QUE RETORNA LOS MUNICIPIOS  SEGUN EL ESTADO =========
    public function obtenerMunicipio() {
        extract($_GET);

        $arrayData = array();
        $arrayData[] = $id_estado;

        $datos_municipio = $this->Pgsql->SELECTPLSQL('consultar_municipio', $arrayData);
        $comboMunicipio = "<select name='municipio' id='municipio' required='required' class='form-control'>";
        $comboMunicipio.="<option value=''>SELECCIONE</option>";
        foreach ($datos_municipio as $municipio) {
            $comboMunicipio.="<option value='" . $municipio[0] . "'>$municipio[1]</option>";
        }
        $comboMunicipio.="</select>";

        echo $comboMunicipio;
    }

//======= FUNCION QUE RETORNA LAS PARROQUIAS SEGUN EL MUNICIPIO =========
    public function obtenerParroquia() {

        extract($_GET);

        $arrayData = array();
        $arrayData[] = $id_municipio;

        $datos_parroquia = $this->Pgsql->SELECTPLSQL('consultar_parroquia', $arrayData);
        $comboParroquia = "<select name='parroquia' id='parroquia' required='required' class='form-control'>";
        $comboParroquia.="<option value=''>SELECCIONE</option>";
        foreach ($datos_parroquia as $parroquia) {
            $comboParroquia.="<option value='" . $parroquia[0] . "'>$parroquia[1]</option>";
        }
        $comboParroquia.="</select>";

        echo $comboParroquia;
    }

}
