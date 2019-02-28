<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Resultados extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Pgsql');
        $this->load->model('Events_model');
    }

    public function inicio() {

        $arrayData = array();

        $vars['datos'] = $this->Pgsql->SELECTPLSQL('consultar_lista_resultados', $arrayData);

        $this->load->view('plantillas/procesos/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/resultados/inicio', $vars);
        $this->load->view('plantillas/footer');
    }

    public function verDetalles() {

        $arrayData = array();
        extract($_GET);
        $arrayData[0] = $id_encuesta;

        $vars['datos'] = $this->Pgsql->SELECTPLSQL('consultar_resultados', $arrayData);
        $vars2['nombre'] = $this->Pgsql->SELECTPLSQL('nombre_encuesta', $arrayData);

        $this->load->view('plantillas/procesos/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/resultados/detalles', $vars + $vars2);
        $this->load->view('plantillas/footer');
    }

}
