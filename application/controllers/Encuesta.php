<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Encuesta extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Pgsql');
        $this->load->model('Events_model');
    }

    public function duplicar() {

        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario = ($variablesSesion['id_usuario']);
        $estatus = 1;
        setlocale(LC_ALL, 'es_VE.UTF-8');
        date_default_timezone_set('America/Caracas');
        $hoy = date("d-m-Y");
        $fecha_registro = substr($hoy, 0, 10);
        extract($_POST);

        $array = array();
        $array2 = array();
        $array3 = array();
        $array4 = array();
        $array5 = array();
        $array6 = array();
        $b = 0;
        $x = 0;
        $j = 0;

        $c = 0;
        $arrayVacio = array();

        $arrayData = array();
        $arrayData[0] = $id_encuesta;
        $encuesta = $this->Pgsql->SELECTPLSQL('duplicar_encuesta', $arrayData);
        $pregunta = $this->Pgsql->SELECTPLSQL('duplicar_pregunta', $arrayData);

        $respuesta = $this->Pgsql->SELECTPLSQL('duplicar_repuesta', $arrayData);
        $sub_respuesta = $this->Pgsql->SELECTPLSQL('duplicar_sub_respuesta', $arrayData);


        $arrayEncuesta = array();
        $arrayEncuesta[0] = $encuesta[0][1]; //nombre de la encuesta
        $arrayEncuesta[1] = $encuesta[0][2]; // descripcion
        $arrayEncuesta[2] = $fecha_registro;
        $arrayEncuesta[3] = $id_usuario;
        $arrayEncuesta[4] = $estatus;
        $arrayEncuesta[5] = $encuesta[0][3]; //limite cantv
        $arrayEncuesta[6] = $encuesta[0][4]; // limite digitel
        $arrayEncuesta[7] = $encuesta [0][5]; // limite movilnet 
        $arrayEncuesta[8] = $encuesta[0][6]; // limite movistar
        $this->Pgsql->SELECTPLSQL('insertar_encuesta', $arrayEncuesta);

        $id_encuestaN = $this->Pgsql->SELECTPLSQL('duplicar_encuesta_id', $arrayVacio);

        for ($i = 0; $i < count($pregunta); $i++) {
            $array[0] = $pregunta[$i][0];
            $datos = $this->Pgsql->SELECTPLSQL('consultar_preguntas_id', $array);

            $arrayData[0] = $id_encuestaN[0][0];
            $arrayData[1] = $datos[0][2];
            $arrayData[2] = $datos[0][3];
            $arrayData[3] = $datos[0][4];
            $arrayData[4] = $fecha_registro;
            $arrayData[5] = $id_usuario;
            $arrayData[6] = $estatus;

            $this->Pgsql->SELECTPLSQL('insertar_pregunta', $arrayData);
        }


        while ($b < count($pregunta)) {

            $array[0] = $pregunta[$b][0];
            $datos2 = $this->Pgsql->SELECTPLSQL('consultar_preguntas_id', $array);

            $array5[0] = $id_encuestaN[0][0];
            $id_pregunta = $this->Pgsql->SELECTPLSQL('consultar_preguntas_id_pregunta', $array5);

            while ($x <= count($datos2) - 1) {
                if ($datos2[$x][3] != "CONDICIONADA") {

                    while ($c < count($id_pregunta)) {
                        if ($datos2[$x][2] == $id_pregunta[$c][1]) {

                            $array2[0] = $id_pregunta[$c][0];
                            $array2[1] = $id_encuestaN[0][0];
                            $array2[2] = mb_strtoupper($datos2[$x][5], 'UTF-8');
                            $array2[3] = $fecha_registro;
                            $array2[4] = $id_usuario;
                            $array2[5] = $estatus;
                            $this->Pgsql->SELECTPLSQL('insertar_respuesta', $array2);
                        }
                        $c = $c + 1;
                    }
                    $c = 0;
                } else {
                    while ($c < count($id_pregunta)) {

                        if ($datos2[$x][2] == $id_pregunta[$c][1]) {

                            if ($datos2[$x][5] == "NO") {

                                $array2[0] = $id_pregunta[$c][0];
                                $array2[1] = $id_encuestaN[0][0];
                                $array2[2] = "NO";
                                $array2[3] = $fecha_registro;
                                $array2[4] = $id_usuario;
                                $array2[5] = $estatus;

                                $this->Pgsql->SELECTPLSQL('insertar_respuesta', $array2);
                            } else {
                                $array2[0] = $id_pregunta[$c][0];
                                $array2[1] = $id_encuestaN[0][0];
                                $array2[2] = "SI";
                                $array2[3] = $fecha_registro;
                                $array2[4] = $id_usuario;
                                $array2[5] = $estatus;

                                $this->Pgsql->SELECTPLSQL('insertar_respuesta', $array2);

                                $array4[0] = $datos2[$x][0];
                                $array4[1] = $datos2[$x][1];

                                $sub = $this->Pgsql->SELECTPLSQL('consultar_sub_respuestas_insertar', $array4);


                                $array6[0] = $id_pregunta[$c][0];
                                $id_respuest = $this->Pgsql->SELECTPLSQL('consultar_preguntas_id_encuesta2', $array6);

                                while ($j < count($sub)) {
                                    $array3[0] = $id_respuest[0][0];
                                    $array3[1] = $id_pregunta[$c][0];
                                    $array3[2] = $id_encuestaN[0][0];
                                    $array3[3] = mb_strtoupper($sub[$j][4], 'UTF-8');
                                    $array3[4] = $fecha_registro;
                                    $array3[5] = $id_usuario;
                                    $array3[6] = $estatus;

                                    $this->Pgsql->SELECTPLSQL('insertar_sub_respuesta', $array3);
                                    $j = $j + 1;
                                }
                                $j = 0;
                            }
                        }
                        $c = $c + 1;
                    }
                    $c = 0;
                }
                $x = $x + 1;
            }

            $x = 0;
            $b = $b + 1;
        }
        redirect('Encuesta/inicio', 'refresh');
    }

    public function inicio() {
        $arrayData = array();

        $vars['datos'] = $this->Pgsql->SELECTPLSQL('consultar_encuestas', $arrayData);
        $data_estado['lista_estados'] = $this->Pgsql->SELECTPLSQL('consultar_estado', $arrayData);
        $data_operador['lista_operador'] = $this->Pgsql->SELECTPLSQL('consultar_operador', $arrayData);

        $this->load->view('plantillas/procesos/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/encuestas/inicio', $vars + $data_estado + $data_operador);
        $this->load->view('plantillas/footer');
    }

    public function verDetalle() {

        extract($_GET);

        $arrayData = array();
        $id = array();
        $arrayData[0] = $id_encuesta;

        $vars['datos'] = $this->Pgsql->SELECTPLSQL('consultar_estatus_telefonos_encuestas', $arrayData);

        $vars3['encuesta'] = $this->Pgsql->SELECTPLSQL('nombre_encuesta', $arrayData);
        $vars6['muestra'] = $this->Pgsql->SELECTPLSQL('consultar_muestra2', $arrayData);

        $this->load->view('plantillas/procesos/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/encuestas/verDetalles', $vars + $vars3 + $vars6 + $id);
        $this->load->view('plantillas/footer');
    }

    public function verCantidades() {

        extract($_GET);

        $arrayData = array();
        $arrayData[0] = $id_encuesta;

        $datos = $this->Pgsql->SELECTPLSQL('contar_asignacion_telefonica2', $arrayData);

        $vars5 = $this->Pgsql->SELECTPLSQL('consultar_estatus_encuesta', $arrayData);

        $cantv = $datos[0][0];
        $cantv_efectivas = $datos[0][1];
        $cantv_desactivada = $datos[0][2];
        $cantv_eliminada = $datos[0][3];
        $digitel = $datos[0][4];
        $digitel_efectivas = $datos[0][5];
        $digitel_desactivada = $datos[0][6];
        $digitel_eliminada = $datos[0][7];
        $movilnet = $datos[0][8];
        $movilnet_efectivas = $datos[0][9];
        $movilnet_desactivada = $datos[0][10];
        $movilnet_eliminada = $datos[0][11];
        $movistar = $datos[0][12];
        $movistar_efectivas = $datos[0][13];
        $movistar_desactivada = $datos[0][14];
        $movistar_eliminada = $datos[0][15];
        $limite_cantv = $datos[0][16];
        $limite_digitel = $datos[0][17];
        $limite_movilnet = $datos[0][18];
        $limite_movistar = $datos[0][19];
        $cantv_restante = $datos[0][20];
        $digitel_restante = $datos[0][21];
        $movilnet_restante = $datos[0][22];
        $movistar_restante = $datos[0][23];

        $total = $cantv + $digitel + $movilnet + $movistar;
        $total_efectivas = $cantv_efectivas + $digitel_efectivas + $movilnet_efectivas + $movistar_efectivas;
        $total_desactivada = $cantv_desactivada + $digitel_desactivada + $movilnet_desactivada + $movistar_desactivada;
        $total_eliminada = $cantv_eliminada + $digitel_eliminada + $movilnet_eliminada + $movistar_eliminada;
        $boton = "";

        if ($vars5[0][0] == 2) {
            $boton = "   
                  
<div class='col-sm-12'>&nbsp;</div>
     <div class='col-lg-12'>
            <div class='small-box bg-red'>
                <div class='inner text-center'>
                    <h4>Encuesta Finalizada</h4>
                    <p>Esta Encuesta ya fue cerrada</p>
                </div>
                <div class='icon'>
                    <i class='ion ion-pie-graph'></i>
                </div>
            </div>
        </div>
        
    <div class='col-sm-12'>&nbsp;</div>";
        }


        echo "
       <div class = 'row'>
        <div class = 'col-md-3 col-sm-6 col-xs-12'>
            <div class = 'info-box bg-aqua'>
                <span class = 'info-box-icon'><i class = 'fa fa-mobile'></i></span>
                <div class = 'info-box-content'>
                    <span class = 'info-box-text'>CANT.ASIGNADA CANTV</span>
                    <span class = 'info-box-number'><h3>$cantv/$cantv_restante</h3></span>
                </div>
            </div>
        </div>

        <div class = 'col-md-3 col-sm-6 col-xs-12'>
            <div class = 'info-box bg-green'>
                <span class = 'info-box-icon'><i class = 'fa  fa-check'></i></span>
                <div class = 'info-box-content'>
                    <span class = 'info-box-text'>EFECTIVAS CANTV</span>
                    <span class = 'info-box-number'><h3>$limite_cantv/$cantv_efectivas</h3></span>
                </div>
            </div>
        </div>

        <div class = 'col-md-3 col-sm-6 col-xs-12'>
            <div class = 'info-box bg-yellow'>
                <span class = 'info-box-icon'><i class = 'fa fa-refresh'></i></span>
                <div class = 'info-box-content'>
                    <span class = 'info-box-text'>DESACTIVADOS CANTV</span>
                    <span class = 'info-box-number'><h3>$cantv_desactivada</h3></span>
                </div>
            </div>
        </div>
        <div class = 'col-md-3 col-sm-6 col-xs-12'>
            <div class = 'info-box bg-red'>
                <span class = 'info-box-icon'><i class = 'fa fa-close'></i></span>
                <div class = 'info-box-content'>
                    <span class = 'info-box-text'>ELIMINADOS CANTV</span>
                    <span class = 'info-box-number'><h3>$cantv_eliminada</h3></span>
                </div>
            </div>
        </div>
    </div>
 <div class = 'row'>
        <div class = 'col-md-3 col-sm-6 col-xs-12'>
            <div class = 'info-box bg-aqua'>
                <span class = 'info-box-icon'><i class = 'fa fa-mobile'></i></span>
                <div class = 'info-box-content'>
                    <span class = 'info-box-text'>CANT.ASIGNADA DIGITEL</span>
                    <span class = 'info-box-number'><h3>$digitel/$digitel_restante</h3></span>
                </div>
            </div>
        </div>

        <div class = 'col-md-3 col-sm-6 col-xs-12'>
            <div class = 'info-box bg-green'>
                <span class = 'info-box-icon'><i class = 'fa  fa-check'></i></span>
                <div class = 'info-box-content'>
                    <span class = 'info-box-text'>EFECTIVAS DIGITEL</span>
                    <span class = 'info-box-number'><h3>$limite_digitel/$digitel_efectivas</h3></span>
                </div>
            </div>
        </div>

        <div class = 'col-md-3 col-sm-6 col-xs-12'>
            <div class = 'info-box bg-yellow'>
                <span class = 'info-box-icon'><i class = 'fa fa-refresh'></i></span>
                <div class = 'info-box-content'>
                    <span class = 'info-box-text'>DESACTIVADOS DIGITEL</span>
                    <span class = 'info-box-number'><h3>$digitel_desactivada</h3></span>
                </div>
            </div>
        </div>
        <div class = 'col-md-3 col-sm-6 col-xs-12'>
            <div class = 'info-box bg-red'>
                <span class = 'info-box-icon'><i class = 'fa fa-close'></i></span>
                <div class = 'info-box-content'>
                    <span class = 'info-box-text'>ELIMINADOS DIGITEL</span>
                    <span class = 'info-box-number'><h3>$digitel_eliminada</h3></span>
                </div>
            </div>
        </div>
    </div>
     <div class = 'row'>
        <div class = 'col-md-3 col-sm-6 col-xs-12'>
            <div class = 'info-box bg-aqua'>
                <span class = 'info-box-icon'><i class = 'fa fa-mobile'></i></span>
                <div class = 'info-box-content'>
                    <span class = 'info-box-text'>CANT.ASIGNADA MOVILNET</span>
                    <span class = 'info-box-number'><h3>$movilnet/$movilnet_restante</h3></span>
                </div>
            </div>
        </div>

        <div class = 'col-md-3 col-sm-6 col-xs-12'>
            <div class = 'info-box bg-green'>
                <span class = 'info-box-icon'><i class = 'fa  fa-check'></i></span>
                <div class = 'info-box-content'>
                    <span class = 'info-box-text'>EFECTIVAS MOVILNET</span>
                    <span class = 'info-box-number'><h3>$limite_movilnet/$movilnet_efectivas</h3></span>
                </div>
            </div>
        </div>

        <div class = 'col-md-3 col-sm-6 col-xs-12'>
            <div class = 'info-box bg-yellow'>
                <span class = 'info-box-icon'><i class = 'fa fa-refresh'></i></span>
                <div class = 'info-box-content'>
                    <span class = 'info-box-text'>DESACTIVADOS MOVILNET</span>
                    <span class = 'info-box-number'><h3>$movilnet_desactivada</h3></span>
                </div>
            </div>
        </div>
        <div class = 'col-md-3 col-sm-6 col-xs-12'>
            <div class = 'info-box bg-red'>
                <span class = 'info-box-icon'><i class = 'fa fa-close'></i></span>
                <div class = 'info-box-content'>
                    <span class = 'info-box-text'>ELIMINADOS MOVILNET</span>
                    <span class = 'info-box-number'><h3>$movilnet_eliminada</span>
                </div>
            </div>
        </div>
    </div>
     <div class = 'row'>
        <div class = 'col-md-3 col-sm-6 col-xs-12'>
            <div class = 'info-box bg-aqua'>
                <span class = 'info-box-icon'><i class = 'fa fa-mobile'></i></span>
                <div class = 'info-box-content'>
                    <span class = 'info-box-text'>CANT.ASIGNADA MOVISTAR</span>
                    <span class = 'info-box-number'><h3>$movistar/$movistar_restante</h3></span>
                </div>
            </div>
        </div>

        <div class = 'col-md-3 col-sm-6 col-xs-12'>
            <div class = 'info-box bg-green'>
                <span class = 'info-box-icon'><i class = 'fa  fa-check'></i></span>
                <div class = 'info-box-content'>
                    <span class = 'info-box-text'>EFECTIVAS MOVISTAR</span>
                    <span class = 'info-box-number'><h3>$limite_movistar/$movistar_efectivas</h3></span>
                </div>
            </div>
        </div>

        <div class = 'col-md-3 col-sm-6 col-xs-12'>
            <div class = 'info-box bg-yellow'>
                <span class = 'info-box-icon'><i class = 'fa fa-refresh'></i></span>
                <div class = 'info-box-content'>
                    <span class = 'info-box-text'>DESACTIVADOS MOVISTAR</span>
                    <span class = 'info-box-number'><h3>$movistar_desactivada</h3></span>
                </div>
            </div>
        </div>
        <div class = 'col-md-3 col-sm-6 col-xs-12'>
            <div class = 'info-box bg-red'>
                <span class = 'info-box-icon'><i class = 'fa fa-close'></i></span>
                <div class = 'info-box-content'>
                    <span class = 'info-box-text'>ELIMINADOS MOVISTAR</span>
                    <span class = 'info-box-number'><h3>$movistar_eliminada</h3></span>
                </div>
            </div>
        </div>
    </div>
    
    <div class = 'row'>
        <div class = 'col-md-3 col-sm-6 col-xs-12'>
            <div class = 'info-box bg-aqua'>
                <span class = 'info-box-icon'><i class = 'fa fa-mobile'></i></span>
                <div class = 'info-box-content'>
                    <span class = 'info-box-text'>TOTAL ASIGNADA </span>
                    <span class = 'info-box-number'><h3>$total</h3></span>
                </div>
            </div>
        </div>

        <div class = 'col-md-3 col-sm-6 col-xs-12'>
            <div class = 'info-box bg-green'>
                <span class = 'info-box-icon'><i class = 'fa  fa-check'></i></span>
                <div class = 'info-box-content'>
                    <span class = 'info-box-text'>TOTAL EFECTIVAS </span>
                    <span class = 'info-box-number'><h3>$total_efectivas</h3></span>
                </div>
            </div>
        </div>

        <div class = 'col-md-3 col-sm-6 col-xs-12'>
            <div class = 'info-box bg-yellow'>
                <span class = 'info-box-icon'><i class = 'fa fa-refresh'></i></span>
                <div class = 'info-box-content'>
                    <span class = 'info-box-text'>TOTAL DESACTIVADOS </span>
                    <span class = 'info-box-number'><h3>$total_desactivada</h3></span>
                </div>
            </div>
        </div>
        <div class = 'col-md-3 col-sm-6 col-xs-12'>
            <div class = 'info-box bg-red'>
                <span class = 'info-box-icon'><i class = 'fa fa-close'></i></span>
                <div class = 'info-box-content'>
                    <span class = 'info-box-text'>TOTAL ELIMINADOS </span>
                    <span class = 'info-box-number'><h3>$total_eliminada</h3></span>
                </div>
            </div>
        </div>
    </div>
$boton
";
    }

    public function insertarEncuesta() {

        extract($_POST);

        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario = ($variablesSesion['id_usuario']);
        $estatus = 1;
        setlocale(LC_ALL, 'es_VE.UTF-8');
        date_default_timezone_set('America/Caracas');
        $hoy = date("d-m-Y");
        $fecha_registro = substr($hoy, 0, 10);

        $arrayData = array();
        $arrayData[0] = mb_strtoupper($nombre, 'UTF-8');
        $arrayData[1] = mb_strtoupper($descripcion, 'UTF-8');
        $arrayData[2] = $fecha_registro;
        $arrayData[3] = $id_usuario;
        $arrayData[4] = $estatus;
        if ($cantv == "") {
            $arrayData[5] = 0;
        } else {
            $arrayData[5] = $cantv;
        }
        if ($digitel == "") {
            $arrayData[6] = 0;
        } else {
            $arrayData[6] = $digitel;
        }
        if ($movistar == "") {
            $arrayData[7] = 0;
        } else {
            $arrayData[7] = $movistar;
        }
        if ($movilnet == "") {
            $arrayData[8] = 0;
        } else {
            $arrayData[8] = $movilnet;
        }

        $this->Pgsql->SELECTPLSQL('insertar_encuesta', $arrayData);
    }

    public function consultar_encuesta($id) {
        $datos = $this->Events_model->consultar_encuesta($id);

        echo json_encode($datos);
    }

    public function actualizar_encuesta() {

        $arrayData = array();
        $arrayData[0] = $this->input->post('id');

        $param['id'] = $this->input->post('id');
        $param['nombre'] = mb_strtoupper($this->input->post('nombre'), 'UTF-8');
        $param['descripcion'] = mb_strtoupper($this->input->post('descripcion'), 'UTF-8');
        $param['cantv'] = $this->input->post('cantv');
        $param['digitel'] = $this->input->post('digitel');
        $param['movistar'] = $this->input->post('movistar');
        $param['movilnet'] = $this->input->post('movilnet');
        $param['estatus'] = $this->input->post('estatus');

        $datos = $this->Events_model->actualizar_encuesta($param);

        echo json_encode($datos);
    }

    public function agregar_pregunta() {

        extract($_GET);
        $variable['id'] = $id;

        $array = array();
        $array[] = $id;
        $vars['datos'] = $this->Pgsql->SELECTPLSQL('consultar_preguntas', $array);
        $vars2['datos2'] = $this->Pgsql->SELECTPLSQL('consultar_preguntas2', $array);

        $this->load->view('plantillas/procesos/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/encuestas/agregar_preguntas', $variable + $vars + $vars2);
        $this->load->view('plantillas/footer');
    }

    public function insertarPreguntas() {

        extract($_POST);

        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario = ($variablesSesion['id_usuario']);
        $estatus = 1;
        setlocale(LC_ALL, 'es_VE.UTF-8');
        date_default_timezone_set('America/Caracas');
        $hoy = date("d-m-Y");
        $fecha_registro = substr($hoy, 0, 10);

        $arrayData = array();
        for ($i = 0; $i <= count($pregunta) - 2; $i++) {
            $arrayData[0] = $id;
            $arrayData[1] = mb_strtoupper($pregunta[$i], 'UTF-8');
            $arrayData[2] = $tipo[$i];
            $arrayData[3] = $categoria[$i];
            $arrayData[4] = $fecha_registro;
            $arrayData[5] = $id_usuario;
            $arrayData[6] = $estatus;

            $this->Pgsql->SELECTPLSQL('insertar_pregunta', $arrayData);
        }
    }

    public function insertarPreguntas_tabla() {

        extract($_POST);

        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario = ($variablesSesion['id_usuario']);
        $estatus = 1;
        setlocale(LC_ALL, 'es_VE.UTF-8');
        date_default_timezone_set('America/Caracas');
        $hoy = date("d-m-Y");
        $fecha_registro = substr($hoy, 0, 10);

        $array = array();
        $arrayData = array();
        $array2 = array();
        $array3 = array();
        $array4 = array();
        $array5 = array();
        $array6 = array();
        $b = 0;
        $x = 0;
        $j = 0;
        $a = 0;
        $c = 0;
        for ($i = 0; $i <= count($pregunta) - 1; $i++) {
            $array[0] = $pregunta[$i];
            $datos = $this->Pgsql->SELECTPLSQL('consultar_preguntas_id', $array);

            $arrayData[0] = $id;
            $arrayData[1] = $datos[0][2];
            $arrayData[2] = $datos[0][3];
            $arrayData[3] = $datos[0][4];
            $arrayData[4] = $fecha_registro;
            $arrayData[5] = $id_usuario;
            $arrayData[6] = $estatus;

            $this->Pgsql->SELECTPLSQL('insertar_pregunta', $arrayData);
        }


        while ($b < count($pregunta)) {

            $array[0] = $pregunta[$b];
            $datos2 = $this->Pgsql->SELECTPLSQL('consultar_preguntas_id', $array);

            $array5[0] = $id;
            $id_pregunta = $this->Pgsql->SELECTPLSQL('consultar_preguntas_id_pregunta', $array5);


            while ($x <= count($datos2) - 1) {
                if ($datos2[$x][3] != "CONDICIONADA") {

                    while ($c < count($id_pregunta)) {
                        if ($datos2[$x][2] == $id_pregunta[$c][1]) {

                            $array2[0] = $id_pregunta[$c][0];
                            $array2[1] = $id;
                            $array2[2] = mb_strtoupper($datos2[$x][5], 'UTF-8');
                            $array2[3] = $fecha_registro;
                            $array2[4] = $id_usuario;
                            $array2[5] = $estatus;
                            $this->Pgsql->SELECTPLSQL('insertar_respuesta', $array2);
                        }
                        $c = $c + 1;
                    }
                    $c = 0;
                } else {
                    while ($c < count($id_pregunta)) {

                        if ($datos2[$x][2] == $id_pregunta[$c][1]) {

                            if ($datos2[$x][5] == "NO") {

                                $array2[0] = $id_pregunta[$c][0];
                                $array2[1] = $id;
                                $array2[2] = "NO";
                                $array2[3] = $fecha_registro;
                                $array2[4] = $id_usuario;
                                $array2[5] = $estatus;

                                $this->Pgsql->SELECTPLSQL('insertar_respuesta', $array2);
                            } else {
                                $array2[0] = $id_pregunta[$c][0];
                                $array2[1] = $id;
                                $array2[2] = "SI";
                                $array2[3] = $fecha_registro;
                                $array2[4] = $id_usuario;
                                $array2[5] = $estatus;

                                $this->Pgsql->SELECTPLSQL('insertar_respuesta', $array2);



                                $array4[0] = $datos2[$x][0];
                                $array4[1] = $datos2[$x][1];

                                $sub = $this->Pgsql->SELECTPLSQL('consultar_sub_respuestas_insertar', $array4);


                                $array6[0] = $id_pregunta[$c][0];
// $id_preg = $this->Pgsql->SELECTPLSQL('consultar_preguntas_id_encuesta', $array6);
                                $id_respuest = $this->Pgsql->SELECTPLSQL('consultar_preguntas_id_encuesta2', $array6);

                                while ($j < count($sub)) {
                                    $array3[0] = $id_respuest[0][0];
                                    $array3[1] = $id_pregunta[$c][0];
                                    $array3[2] = $id;
                                    $array3[3] = mb_strtoupper($sub[$j][4], 'UTF-8');
                                    $array3[4] = $fecha_registro;
                                    $array3[5] = $id_usuario;
                                    $array3[6] = $estatus;
//print_r($array3);
                                    $this->Pgsql->SELECTPLSQL('insertar_sub_respuesta', $array3);
                                    $j = $j + 1;
                                }
                                $j = 0;
                            }
                        }
                        $c = $c + 1;
                    }
                    $c = 0;
                }
                $x = $x + 1;
            }

            $x = 0;
            $b = $b + 1;
        }
    }

    public function insertarRespuesta_tabla() {

        extract($_POST);

        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario = ($variablesSesion['id_usuario']);
        $estatus = 1;
        setlocale(LC_ALL, 'es_VE.UTF-8');
        date_default_timezone_set('America/Caracas');
        $hoy = date("d-m-Y");
        $fecha_registro = substr($hoy, 0, 10);

        $arrayData = array();
        for ($i = 0; $i < count($respuesta); $i++) {
            if ($respuesta[$i] != "") {
                $arrayData[0] = $id_pregunta;
                $arrayData[1] = $id_encuesta;
                $arrayData[2] = mb_strtoupper($respuesta[$i], 'UTF-8');
                $arrayData[3] = $fecha_registro;
                $arrayData[4] = $id_usuario;
                $arrayData[5] = $estatus;

                $this->Pgsql->SELECTPLSQL('insertar_respuesta', $arrayData);
            }
        }
    }

    public function consultar_pregunta($id) {
        $datos = $this->Events_model->consultar_pregunta($id);

        echo json_encode($datos);
    }

    public function actualizar_pregunta() {

        print_r($_POST);
        $param['id'] = $this->input->post('id');
        $param['pregunta'] = mb_strtoupper($this->input->post('pregunta'), 'UTF-8');
        $param['tipo_pregunta'] = $this->input->post('tipo');
        $param['categoria'] = $this->input->post('categoria');
        $param['estatus'] = $this->input->post('estatus');

        $datos = $this->Events_model->actualizar_pregunta($param);
        echo json_encode($datos);
    }

    public function agregar_respuestas() {

        extract($_GET);
        $id1['id_pregunta'] = $id_pregunta;
        $id2['id_encuesta'] = $id_encuesta;

        $arrayData = array();
        $array = array();
        $arrayData[0] = $id_pregunta;

        $vars['datos'] = $this->Pgsql->SELECTPLSQL('consultar_respuestas', $arrayData);
        $vars2['datos2'] = $this->Pgsql->SELECTPLSQL('consultar_respuestas_duplicar', $array);

        $this->load->view('plantillas/procesos/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/encuestas/agregar_respuestas', $id1 + $id2 + $vars + $vars2);
        $this->load->view('plantillas/footer');
    }

    public function insertarRespuestas() {

        extract($_POST);

        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario = ($variablesSesion['id_usuario']);
        $estatus = 1;
        setlocale(LC_ALL, 'es_VE.UTF-8');
        date_default_timezone_set('America/Caracas');
        $hoy = date("d-m-Y");
        $fecha_registro = substr($hoy, 0, 10);

        $arrayData = array();
        for ($i = 0; $i <= count($respuesta) - 2; $i++) {
            if ($respuesta[$i] != "") {
                $arrayData[0] = $id_pregunta;
                $arrayData[1] = $id_encuesta;
                $arrayData[2] = mb_strtoupper($respuesta[$i], 'UTF-8');
                $arrayData[3] = $fecha_registro;
                $arrayData[4] = $id_usuario;
                $arrayData[5] = $estatus;

                $this->Pgsql->SELECTPLSQL('insertar_respuesta', $arrayData);
            }
        }
    }

    public function consultar_respuesta($id) {
        $datos = $this->Events_model->consultar_respuesta($id);

        echo json_encode($datos);
    }

    public function actualizar_respuesta() {


        $param['id'] = $this->input->post('id');
        $param['respuesta'] = mb_strtoupper($this->input->post('respuesta2'), 'UTF-8');
        $param['estatus'] = $this->input->post('estatus');

        $datos = $this->Events_model->actualizar_respuesta($param);
        echo json_encode($datos);
    }

    public function agregar_respuesta_condicionada() {

        extract($_GET);
        $id1['id_pregunta'] = $id_pregunta;
        $id2['id_encuesta'] = $id_encuesta;

        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario = ($variablesSesion['id_usuario']);
        $estatus = 1;
        setlocale(LC_ALL, 'es_VE.UTF-8');
        date_default_timezone_set('America/Caracas');
        $hoy = date("d-m-Y");
        $fecha_registro = substr($hoy, 0, 10);

        $arrayData = array();
        $arrayData[0] = $id_pregunta;
        $vars['datos'] = $this->Pgsql->SELECTPLSQL('consultar_respuestas', $arrayData);

        if ($vars['datos'][0][0] == "") {
            $array = array();

            $array[0] = $id_pregunta;
            $array[1] = $id_encuesta;
            $array[2] = "SI";
            $array[3] = $fecha_registro;
            $array[4] = $id_usuario;
            $array[5] = $estatus;

            $this->Pgsql->SELECTPLSQL('insertar_respuesta', $array);


            $array[0] = $id_pregunta;
            $array[1] = $id_encuesta;
            $array[2] = "NO";
            $array[3] = $fecha_registro;
            $array[4] = $id_usuario;
            $array[5] = $estatus;

            $this->Pgsql->SELECTPLSQL('insertar_respuesta', $array);
        } else {

            $vars['datos'] = $this->Pgsql->SELECTPLSQL('consultar_respuestas', $arrayData);
        }

        $vars['datos'] = $this->Pgsql->SELECTPLSQL('consultar_respuestas', $arrayData);
        $id_respuesta = $vars['datos'][0][0];

        $array = array();
        $arrayVacio = array();
        $array[0] = $id_pregunta;
        $array[1] = $id_respuesta;
        $array[2] = $id_encuesta;
        $vars2['datos2'] = $this->Pgsql->SELECTPLSQL('consultar_sub_respuestas', $array);
        $vars3['datos3'] = $this->Pgsql->SELECTPLSQL('consultar_sub_respuestas_duplicar', $arrayVacio);

        $this->load->view('plantillas/procesos/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/encuestas/agregar_respuesta_condicionada', $vars + $vars2 + $vars3);
        $this->load->view('plantillas/footer');
    }

    public function insertarSub_tabla() {

        extract($_POST);

        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario = ($variablesSesion['id_usuario']);
        $estatus = 1;
        setlocale(LC_ALL, 'es_VE.UTF-8');
        date_default_timezone_set('America/Caracas');
        $hoy = date("d-m-Y");
        $fecha_registro = substr($hoy, 0, 10);

        $arrayData = array();

        for ($i = 0; $i < count($respuesta); $i++) {
            if ($respuesta[$i] != "") {
                $arrayData[0] = $id_respuesta;
                $arrayData[1] = $id_pregunta;
                $arrayData[2] = $id_encuesta;
                $arrayData[3] = mb_strtoupper($respuesta[$i], 'UTF-8');
                $arrayData[4] = $fecha_registro;
                $arrayData[5] = $id_usuario;
                $arrayData[6] = $estatus;

                $this->Pgsql->SELECTPLSQL('insertar_sub_respuesta', $arrayData);
            }
        }
    }

    public function insertarSub() {

        extract($_POST);

        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario = ($variablesSesion['id_usuario']);
        $estatus = 1;
        setlocale(LC_ALL, 'es_VE.UTF-8');
        date_default_timezone_set('America/Caracas');
        $hoy = date("d-m-Y");
        $fecha_registro = substr($hoy, 0, 10);

        $arrayData = array();

        for ($i = 0; $i <= count($respuesta) - 2; $i++) {
            if ($respuesta[$i] != "") {
                $arrayData[0] = $id_respuesta;
                $arrayData[1] = $id_pregunta;
                $arrayData[2] = $id_encuesta;
                $arrayData[3] = mb_strtoupper($respuesta[$i], 'UTF-8');
                $arrayData[4] = $fecha_registro;
                $arrayData[5] = $id_usuario;
                $arrayData[6] = $estatus;


                $this->Pgsql->SELECTPLSQL('insertar_sub_respuesta', $arrayData);
            }
        }
    }

    public function consultar_subrespuesta($id) {
        $datos = $this->Events_model->consultar_subrespuesta($id);

        echo json_encode($datos);
    }

    public function actualizar_subrespuesta() {

        $param['id'] = $this->input->post('id');
        $param['respuesta'] = mb_strtoupper($this->input->post('respuesta2'), 'UTF-8');
        $param['estatus'] = $this->input->post('estatus');

        $datos = $this->Events_model->actualizar_subrespuesta($param);
        echo json_encode($datos);
    }

}
