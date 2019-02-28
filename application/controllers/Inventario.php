<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inventario extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Pgsql');
        $this->load->model('Events_model');
    }

    public function inicio() {

        $this->load->view('plantillas/procesos/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/inventario/inicio');
        $this->load->view('plantillas/footer');
    }

    public function verCantidades() {

        $arrayData = array();

        $vars = $this->Pgsql->SELECTPLSQL('contar_numeros_disponible', $arrayData);
      
        $cantv1 = $vars[0][0];
        $digitel1 = $vars[0][1];
        $movilnet1 = $vars[0][2];
        $movistar1 = $vars[0][3];

        $cantv = number_format($cantv1,0, ',', '.');
        $digitel = number_format($digitel1,0, ',', '.');
        $movilnet = number_format($movilnet1,0, ',', '.');
        $movistar = number_format($movistar1,0, ',', '.');


        echo "
            
      <div class='col-lg-3 col-xs-6'>
            <div class='small-box bg-green'>
                <div class='inner'>
                    <h3>$cantv</h3>
                    <p>Total de Cantv</p>
                </div>
                <div class='icon'>
                    <i class='fa fa-phone'></i>
                </div>
            </div>
        </div>
        <div class='col-lg-3 col-xs-6'>
            <div class='small-box bg-red'>
                <div class='inner'>
                    <h3>$digitel</h3>
                    <p>Total de Digitel</p>
                </div>
                <div class='icon'>
                    <i class='fa fa-mobile-phone'></i>
                </div>
            </div>
        </div>

        <div class='col-lg-3 col-xs-6'>
            <div class='small-box bg-orange'>
                <div class='inner'>
                    <h3>$movilnet</h3>
                    <p>Total de Movilnet</p>
                </div>
                <div class='icon'>
                    <i class='fa fa-mobile-phone'></i>
                </div>
            </div>
        </div>

        <div class='col-lg-3 col-xs-6'>
            <div class='small-box bg-blue'>
                <div class='inner'>
                    <h3>$movistar</h3>
                    <p>Total de Movistar</p>
                </div>
                <div class='icon'>
                    <i class='fa fa-mobile-phone'></i>
                </div>
            </div>
        </div>


         ";
    }

}
