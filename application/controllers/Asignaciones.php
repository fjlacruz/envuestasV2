<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Asignaciones extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Pgsql');
        $this->load->model('Events_model');
    }

    public function asignar_numeros() {
        extract($_GET);

        $array = array();
        $arrayData = array();
        $array[0] = $id;

        $data_estado['lista_estados'] = $this->Pgsql->SELECTPLSQL('consultar_estado', $arrayData);

        $vars['datos'] = $this->Pgsql->SELECTPLSQL('consultar_formulario_encuesta', $array);
        $vars2['datos2'] = $this->Pgsql->SELECTPLSQL('consultar_cantidad_nacional', $array);
        $vars3['datos3'] = $this->Pgsql->SELECTPLSQL('consultar_cantidad_operadoras', $array);

        $this->load->view('plantillas/procesos/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/asignaciones/asignar_operadora', $vars + $vars2 + $vars3 + $data_estado);
        $this->load->view('plantillas/footer');
    }

    public function insertar_tlf() {
        extract($_POST);

        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario = ($variablesSesion['id_usuario']);

        setlocale(LC_ALL, 'es_VE.UTF-8');
        date_default_timezone_set('America/Caracas');
        $hoy = date("d-m-Y");
        $fecha_registro = substr($hoy, 0, 10);

        $arrayData = array();
        $array = array();
        $arrayDatos = array();

        $arrayData2 = array();
        $arrayData2[0] = $operadora;

        $arrayData2[1] = $asignacion;
        if ($operadora == 1) {
            $vars = $this->Pgsql->SELECTPLSQL('consultar_telefonos_disponibles_nacional_cantv', $arrayData2);
        }
        if ($operadora == 2) {
            $vars = $this->Pgsql->SELECTPLSQL('consultar_telefonos_disponibles_nacional_digitel', $arrayData2);
        }
        if ($operadora == 3) {
            $vars = $this->Pgsql->SELECTPLSQL('consultar_telefonos_disponibles_nacional_movilnet', $arrayData2);
        }
        if ($operadora == 4) {
            $vars = $this->Pgsql->SELECTPLSQL('consultar_telefonos_disponibles_nacional_movistar', $arrayData2);
        }

        for ($i = 0; $i <= $asignacion - 1; $i++) {
            $arrayData[0] = $id_encuesta;
            $arrayData[1] = $operadora;
            $arrayData[2] = $vars[$i][1];
            $arrayData[3] = $fecha_registro;
            $arrayData[4] = $id_usuario;
            $arrayData[5] = 'NACIONAL';

            if ($operadora == 1) {
                $this->Pgsql->SELECTPLSQL('insertar_asignacion_encuesta_nacional_cantv', $arrayData);
            }
            if ($operadora == 2) {
                $this->Pgsql->SELECTPLSQL('insertar_asignacion_encuesta_nacional_digitel', $arrayData);
            }
            if ($operadora == 3) {
                $this->Pgsql->SELECTPLSQL('insertar_asignacion_encuesta_nacional_movilnet', $arrayData);
            }
            if ($operadora == 4) {
                $this->Pgsql->SELECTPLSQL('insertar_asignacion_encuesta_nacional_movistar', $arrayData);
            }
        }
//        //////////asigna los telefonos registrados a cada operador
//
//        $data_operador = $this->Pgsql->SELECTPLSQL('consultar_operador', $array);
//
//
//        $operadores = count($data_operador);
//
//// sino los numeros asignados se dividen entre lo operadores
//        $asignacion_tlf1 = ($asignacion / $operadores);
//
//        $asignacion_tlf = floor($asignacion_tlf1);
//
//// se le asigna la misma cantidad a cada operador 
//        $c = 0;
//        $b = 0;
//
//        for ($a = 0; $a <= $asignacion; $a++) {
//
//            if ($b < $asignacion_tlf) {
//
//                $arrayDatos[0] = $vars[$a][1];
//                $arrayDatos[1] = $data_operador[$c][0];
//                $arrayDatos[2] = $id_encuesta;
//                $b = $b + 1;
//                $this->Pgsql->SELECTPLSQL('asignar_telefono_operador', $arrayDatos);
//            } else {
//
//                $c = $c + 1;
//                $b = 1;
//                $arrayDatos[0] = $vars[$a][1];
//                $arrayDatos[1] = $data_operador[$c][0];
//                $arrayDatos[2] = $id_encuesta;
//                $this->Pgsql->SELECTPLSQL('asignar_telefono_operador', $arrayDatos);
        //}
        // }
    }

    public function insertar_tlf_por_estado() {
        extract($_POST);

        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario = ($variablesSesion['id_usuario']);

        setlocale(LC_ALL, 'es_VE.UTF-8');
        date_default_timezone_set('America/Caracas');
        $hoy = date("d-m-Y");
        $fecha_registro = substr($hoy, 0, 10);

        $arrayData = array();
        $arrayDatos = array();
        $array = array();

        $arrayData2 = array();
        $arrayData2[0] = $operadora2;
        $arrayData2[1] = $estados2;
        $arrayData2[2] = $asignacion2;
        if ($operadora2 == 1) {
            $vars = $this->Pgsql->SELECTPLSQL('consultar_telefonos_disponibles_lista2', $arrayData2);
        }
        if ($operadora2 == 2) {
            $vars = $this->Pgsql->SELECTPLSQL('consultar_telefonos_disponibles_lista2_digitel', $arrayData2);
        }
        if ($operadora2 == 3) {
            $vars = $this->Pgsql->SELECTPLSQL('consultar_telefonos_disponibles_lista2_movilnet', $arrayData2);
        }
        if ($operadora2 == 4) {
            $vars = $this->Pgsql->SELECTPLSQL('consultar_telefonos_disponibles_lista2_movistar', $arrayData2);
        }
        for ($i = 0; $i <= $asignacion2 - 1; $i++) {
            $arrayData[0] = $id_encuesta2;
            $arrayData[1] = $operadora2;
            $arrayData[2] = $vars[$i][1];
            $arrayData[3] = $fecha_registro;
            $arrayData[4] = $id_usuario;
            $arrayData[5] = $estados2;
            if ($operadora2 == 1) {
                $this->Pgsql->SELECTPLSQL('insertar_asignacion_encuesta_cantv', $arrayData);
            }
            if ($operadora2 == 2) {
                $this->Pgsql->SELECTPLSQL('insertar_asignacion_encuesta_digitel', $arrayData);
            }
            if ($operadora2 == 3) {
                $this->Pgsql->SELECTPLSQL('insertar_asignacion_encuesta_movilnet', $arrayData);
            }
            if ($operadora2 == 4) {
                $this->Pgsql->SELECTPLSQL('insertar_asignacion_encuesta_movistar', $arrayData);
            }
        }
//        //////////asigna los telefonos registrados a cada operador
//
//        $data_operador = $this->Pgsql->SELECTPLSQL('consultar_operador', $array);
//
//
//        $operadores = count($data_operador);
//
//// sino los numeros asignados se dividen entre lo operadores
//        $asignacion_tlf1 = ($asignacion2 / $operadores);
//
//        $asignacion_tlf = floor($asignacion_tlf1);
//
//// se le asigna la misma cantidad a cada operador 
//        $c = 0;
//        $b = 0;
//
//        for ($a = 0; $a <= $asignacion2; $a++) {
//
//            if ($b < $asignacion_tlf) {
//
//                $arrayDatos[0] = $vars[$a][1];
//                $arrayDatos[1] = $data_operador[$c][0];
//                $arrayDatos[2] = $id_encuesta2;
//                $b = $b + 1;
//                $this->Pgsql->SELECTPLSQL('asignar_telefono_operador', $arrayDatos);
//            } else {
//
//                $c = $c + 1;
//                $b = 1;
//                $arrayDatos[0] = $vars[$a][1];
//                $arrayDatos[1] = $data_operador[$c][0];
//                $arrayDatos[2] = $id_encuesta2;
//                $this->Pgsql->SELECTPLSQL('asignar_telefono_operador', $arrayDatos);
//            }
//        }
    }

    public function consultar_tlf() {
        extract($_POST);

        $arrayData = array();


        if ($operadora == 1) {
           $vars = $this->Pgsql->SELECTPLSQL('contar_cantv_disponible', $arrayData);
          //  $vars = $this->Events_model->contar_cantv_disponible();
        }
        if ($operadora == 2) {
            //$vars = $this->Events_model->contar_digitel_disponible();
              $vars = $this->Pgsql->SELECTPLSQL('contar_digitel_disponible', $arrayData);
        }
        if ($operadora == 3) {
           // $vars = $this->Events_model->contar_movilnet_disponible();
             $vars = $this->Pgsql->SELECTPLSQL('contar_movilnet_disponible', $arrayData);
        }
        if ($operadora == 4) {
           // $vars = $this->Events_model->contar_movistar_disponible();
             $vars = $this->Pgsql->SELECTPLSQL('contar_movistar_disponible', $arrayData);
        }

        $cantidad = $vars[0][0];
        echo $cantidad;
    }

    public function consultar_tlf_por_estado() {
        extract($_POST);

        $arrayData = array();
        $arrayData[0] = $operadora2;
        $arrayData[1] = $estados2;

        if ($operadora2 == 1) {
            $vars = $this->Pgsql->SELECTPLSQL('consultar_telefonos_disponibles', $arrayData);
        }
        if ($operadora2 == 2) {

            $vars = $this->Pgsql->SELECTPLSQL('consultar_telefonos_disponibles_digitel', $arrayData);
        }
        if ($operadora2 == 3) {
            $vars = $this->Pgsql->SELECTPLSQL('consultar_telefonos_disponibles_movilnet', $arrayData);
        }
        if ($operadora2 == 4) {
            $vars = $this->Pgsql->SELECTPLSQL('consultar_telefonos_disponibles_movistar', $arrayData);
        }

        $cantidad = $vars[0][0];
        echo $cantidad;
    }

    public function consultar_tlf_estados() {
        extract($_POST);

        $array = array();
        $data_estado = $this->Pgsql->SELECTPLSQL('consultar_estado', $array);
        $c = 0;
        for ($i = 0; $i <= count($data_estado) - 1; $i++) {

            $arrayData = array();
            $arrayData[0] = $id_encuesta;
            $arrayData[1] = $estado = $data_estado[$i][1];
            $arrayData[2] = $id_operadora;

            $vars = $this->Pgsql->SELECTPLSQL('consultar_telefonos_estado', $arrayData);

            if ($vars[0][0] != "") {
                $estados[$c] = $vars[0][0];
                $cantidades[$c] = $vars[0][1];
                $c = $c + 1;
            }
        }

        $resultado = " <table class='tabla_lista' ><thead><th>ESTADO</th><th>CANTIDAD ASIGNADA</th></thead><tbody>";

        for ($x = 0; $x <= count($estados) - 1; $x++) {
            $estad = $estados[$x];
            $cantidad = $cantidades[$x];

            $resultado2[$x] = "<tr class='text-center'><td> $estad </td> <td> $cantidad</td></tr>";
        }
        $variable = "";
        foreach ($resultado2 as $valor) {
            $variable = $variable . $valor;
        }
        $resultado3 = "</tbody></table> ";

        $resultado_final = $resultado . $variable . $resultado3;

        echo json_encode($resultado_final);
    }

    public function asignar_operadores() {
        extract($_GET);

        $array = array();
        $arrayData = array();
        $array[0] = $id;

        $data_estado['lista_estados'] = $this->Pgsql->SELECTPLSQL('consultar_estado', $arrayData);
        $data_operador['lista_operador'] = $this->Pgsql->SELECTPLSQL('consultar_operador', $arrayData);
        $vars['datos'] = $this->Pgsql->SELECTPLSQL('consultar_formulario_encuesta', $array);
        $vars2['datos2'] = $this->Pgsql->SELECTPLSQL('consultar_cantidad_cantv_operador', $array);
        $vars3['datos3'] = $this->Pgsql->SELECTPLSQL('consultar_cantidad_digitel_operador', $array);
        $vars4['datos4'] = $this->Pgsql->SELECTPLSQL('consultar_cantidad_movilnet_operador', $array);
        $vars5['datos5'] = $this->Pgsql->SELECTPLSQL('consultar_cantidad_movistar_operador', $array);

        $this->load->view('plantillas/procesos/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/asignaciones/asignar_usuarios', $vars + $vars2 + $vars3 + $vars4 + $vars5 + $data_estado + $data_operador);
        $this->load->view('plantillas/footer');
    }

    public function consultar_tlf_operadores() {
        extract($_POST);

        $arrayData = array();
        $arrayData[0] = $operadora;
        $arrayData[1] = $id_encuesta;
        $arrayData[2] = $estados;


        $vars = $this->Pgsql->SELECTPLSQL('consultar_telefonos_disponibles_operadores', $arrayData);

        $cantidad = $vars[0][0];
        echo $cantidad;
    }

    public function insertar_tlf_operadores() {
        extract($_POST);

        $arrayData = array();

        $array = array();
        $array[0] = $id_encuesta;
        $array[1] = $operadora;
        $array[2] = $estados;
        $vars = $this->Pgsql->SELECTPLSQL('consultar_telefonos_disponibles_lista_operadores', $array);

// se crea un nuevo arreglo que no traiga datos vacios
        foreach ($operador as $conteo) {
            if ($conteo != "") {
                $operadorN[] = $conteo;
            }
        }

// contamos los registro que tengan 
        $operadores = count($operadorN);

// si solo tiene un operador registramos normal        
        if ($operadores == 1) {
            for ($i = 0; $i <= $asignacion - 1; $i++) {

                $arrayData[0] = $vars[$i][2];
                $arrayData[1] = $operador[0];
                $arrayData[2] = $id_encuesta;

                $this->Pgsql->SELECTPLSQL('asignar_telefono_operador', $arrayData);
            }
        } else {
// sino los numeros asignados se dividen entre lo operadores
            $asignacion_tlf1 = ($asignacion / $operadores);

            $asignacion_tlf = floor($asignacion_tlf1);

// se le asigna la misma cantidad a cada operador 
            $c = 0;
            $b = 0;

            for ($a = 0; $a <= $asignacion; $a++) {

                if ($b < $asignacion_tlf) {

                    $arrayData[0] = $vars[$a][2];
                    $arrayData[1] = $operador[$c];
                    $arrayData[2] = $id_encuesta;
                    $b = $b + 1;
                    $this->Pgsql->SELECTPLSQL('asignar_telefono_operador', $arrayData);
                } else {

                    $c = $c + 1;
                    $b = 1;
                    $arrayData[0] = $vars[$a][2];
                    $arrayData[1] = $operador[$c];
                    $arrayData[2] = $id_encuesta;
                    $this->Pgsql->SELECTPLSQL('asignar_telefono_operador', $arrayData);
                }
            }
        }
    }

    public function consultar_tlf_estados_operador() {
        extract($_POST);

        $array = array();
        $data_estado = $this->Pgsql->SELECTPLSQL('consultar_estado', $array);
        $datos_operador = $this->Pgsql->SELECTPLSQL('consultar_operador', $array);

        $c = 0;

        for ($z = 0; $z <= count($datos_operador) - 1; $z++) {
            for ($i = 0; $i <= count($data_estado) - 1; $i++) {

                $arrayData = array();
                $arrayData[0] = $id_encuesta;
                $arrayData[1] = $estado = $data_estado[$i][1];
                $arrayData[2] = $id_operadora;
                $arrayData[3] = $operador = $datos_operador[$z][0];

                $vars = $this->Pgsql->SELECTPLSQL('consultar_telefonos_estado_operador', $arrayData);


                if ($vars[0][0] != "") {
                    $estados[$c] = $vars[0][0];
                    $operadores[$c] = $vars[0][1] . " " . $vars[0][2];
                    $cantidades[$c] = $vars[0][3];
                    $c = $c + 1;
                }
            }
        }

        $resultado = " <table class='tabla_lista' ><thead><th>ESTADO</th><th>CANTIDAD ASIGNADA</th><th>OPERADOR</th></thead><tbody>";

        for ($x = 0; $x <= count($estados) - 1; $x++) {
            $estad = $estados[$x];
            $cantidad = $cantidades[$x];
            $operador = $operadores[$x];

            $resultado2[$x] = "<tr class='text-center'><td> $estad </td> <td> $cantidad</td><td> $operador</td></tr>";
        }
        $variable = "";
        foreach ($resultado2 as $valor) {
            $variable = $variable . $valor;
        }
        $resultado3 = "</tbody></table> ";

        $resultado_final = $resultado . $variable . $resultado3;


        echo $resultado_final;
    }

}
