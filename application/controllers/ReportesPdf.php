<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ReportesPdf extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->model('Pgsql');
    }

    public function imprimirPDF() {
        $this->load->library('Pdf');
        $pdf = $this->pdf->load();
        extract($_GET);

        $arrayData = array();
        $array = array();
        $array[] = $id_proyecto;
        $direcciones['datos'] = $this->Pgsql->SELECTPLSQL('consulta_datos_proyectos', $array);
        $coordinacion['datos_coordinacion'] = $this->Pgsql->SELECTPLSQL('consulta_administrador_actividad', $array);

        $html = $this->load->view('pdf/registroProyectoPDF', $direcciones + $coordinacion, true);

        $pdf->SetHtmlHeader('<img width="100%" src="' . base_url() . 'application/recursos/imagenes/headerAuditoria.png">');
        $pdf->SetHTMLFooter('<img width="80%" height="7%" align="center" src="' . base_url() . 'application/recursos/imagenes/cintillo_gobierno.jpg">');

        $pdfFilePath = "DatosDeProyecto.pdf";

        $pdf->AddPage('', '', '', '', '', 20, 20, 20, 35, 10, 10);
        $pdf->WriteHTML($html);

        $pdf->Output($pdfFilePath, "I");
    }

}
