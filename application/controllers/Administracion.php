<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Administracion extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('Pgsql');

        $this->load->model('Events_model');
    }

    public function index() {

        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('administracion/usuarios');
        $this->load->view('plantillas/footer');
    }

//================== FUNCION QUE CONSULTA LOS DATOS DEL SAIME =============
    public function consultar() {
        $datos = $this->Events_model->get();

        //echo json_encode($datos);
        echo json_encode(array('response' => $datos));
    }

    public function consultarId($id) {
        $datos = $this->Events_model->get_id($id);

        echo json_encode($datos);
    }

    public function actualizar() {

        print_r($_POST);
        $param['id'] = $this->input->post('id');
        $param['estatus'] = $this->input->post('estatus');
        $param['rol'] = $this->input->post('rol');

        $datos = $this->Events_model->upd($param);
        echo json_encode($datos);
    }

//================== FUNCION QUE CONSULTA TODOS LOS DATOS DE LA TABLA =============
    public function buscarDatos() {

        $arrayData = array();

        $datos_usuario = $this->Pgsql->SELECTPLSQL('usuarios_todos', $arrayData);
        $vars['datos'] = $datos_usuario;

        $arrayData2 = array();
        $data2['roles'] = $this->Pgsql->SELECTPLSQL('consultar_rol', $arrayData2);

        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('administracion/tabla_usuarios', $vars + $data2);
        $this->load->view('plantillas/footer');
    }

//============== FUNCION QUE MUESTRA LOS DETALLES DE LA CONSULTA PARA EDITAR ====================     
    public function MostrarDetalle() {

        $arrayData = array();
        extract($_GET);
        $arrayData[] = $cedula;
        $arrayData2 = array();

        $data['buscar_usuario'] = $this->Pgsql->SELECTPLSQL('buscar_usuario', $arrayData);

        $data2['roles'] = $this->Pgsql->SELECTPLSQL('consultar_rol', $arrayData2);

        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('administracion/editarEstatus', $data + $data2);
        $this->load->view('plantillas/footer');
    }

//================== FUNCION QUE CONSULTA TODOS LOS DATOS DE LA TABLA =============
    public function usuarioModificar() {

        $variablesSesion = $this->session->userdata('usuario');
        $cedula = $variablesSesion['cedula'];
        $array = array();
        $array[] = $cedula;

        $data['recuperar'] = $this->Pgsql->SELECTPLSQL('buscar_usuario', $array);

        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('administracion/usuarioModificar', $data);
        $this->load->view('plantillas/footer');
    }

//================== FUNCION QUE ACTUALIZA LA CONTRASEÑA =============
    public function contrasenna_actualizar() {

        $variablesSesion = $this->session->userdata('usuario');
        $cedula = $variablesSesion['cedula'];

        $claveNueva = $_POST['clave'];
        $arrayNuevaClave = array();
        $arrayNuevaClave[] = $cedula;
        $arrayNuevaClave[] = md5($claveNueva);
        $this->Pgsql->SELECTPLSQL('actualizar_contrasenia2', $arrayNuevaClave);
    }

//================== FUNCION QUE ACTUALIZA EL CORREO =============
    function actualizarUsuario() {

        extract($_POST);
        $arrayData = array();
        $arrayData[0] = $cedula;
        $arrayData[1] = $correo;
        $arrayData[2] = $usuario;

        $this->Pgsql->SELECTPLSQL('modificar_usuario_cedula', $arrayData);
    }

//========== FUNCION QUE CONSULTA SI YA EXISTE UN NUMERO DE CEDULA REGISTRADO =========   
    public function consultar_usuario() {

        $cedula = $_POST['cedula'];
        if ($cedula == "") {
            exit();
        }
        $arrayData = array();
        $arrayData[] = $cedula;
        $consultar_cedula = $this->Pgsql->SELECTPLSQL('existe_usuario', $arrayData);
        if ($consultar_cedula[0][0] != 0) {
            echo 1;
        } else {
            echo 0;
        }
    }

//========== FUNCION QUE CONSULTA SI EXISTE UNA CUENTA DE CORREO ASOCIADA A UN USUARIO =========   
    public function consultar_correo() {

        $correo = $_POST['correo'];
        if ($correo == "") {
            exit();
        }
        $arrayData = array();
        $arrayData[] = $correo;
        $consultar_correo = $this->Pgsql->SELECTPLSQL('existe_correo', $arrayData);
        if ($consultar_correo[0][0] != 0) {
            echo 1;
        } else {
            echo 0;
        }
    }

//========== FUNCION QUE CONSULTA SI YA EXISTE UN USUARIO REGISTRADO ===============   
    public function consultar_usuario2() {

        $usuario = $_POST['usuario'];
        if ($usuario == "") {
            exit();
        }
        $arrayData = array();
        $arrayData[] = $usuario;


        $consultar_usuario = $this->Pgsql->SELECTPLSQL('existe_usuario2', $arrayData);
        if ($consultar_usuario[0][0] != 0) {
            echo 1;
        } else {
            echo 0;
        }
    }

//============== FUNCION QUE INSERTA LOS DATOS EN LA BASE DE DATOS ===============        

    public function registrar_usuario() {

        extract($_POST);

        $arrayData = array();
        $arrayData[0] = $cedula;
        $arrayData[1] = $usuario;
        $arrayData[2] = md5($clave);
        $arrayData[3] = $nombres;
        $arrayData[4] = $apellidos;
        $arrayData[5] = $correo;
        $arrayData[6] = $rol;

        $this->Pgsql->SELECTPLSQL('usuarios_guardar', $arrayData);
    }

//=========================== FUNCION PARA ACTUALIZAR EL ROL Y ESTATUS =================================================       
    public function actualizar_estatus() {

        extract($_POST);
        $arrayData = array();
        $arrayData[0] = $rol;
        $arrayData[1] = $estatus;
        $arrayData[2] = $id;

        $this->Pgsql->SELECTPLSQL('modificar_usuario', $arrayData);
    }

//====== FUNCION PARA CONSULTAR Y MOSTRAR LOS DATOS CON JSON EN LA MISMA VISTA ======================================   
    public function consultarJson() {
        extract($_POST);
        $arrayData = array();
        $arrayData[] = $cedula;
        $arrayData[] = 'V';
        $this->db_b = $this->load->database('personas', true);
        $consultaPersona = $this->Pgsql->SELECTPLSQL('consultar_datos_persona', $arrayData);
        if ($consultaPersona[0][0] != '') {

            $data['nombres'] = $consultaPersona[0][1];
            $data['apellidos'] = $consultaPersona[0][2] . ' ' . $consultaPersona[0][3];
        } else {
            $data = 0;
        }
        echo json_encode($data);
    }

}
