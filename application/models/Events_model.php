<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Events_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get() {

        $query = $this->db->query("select * from t_usuarios");

        return $query->result();
    }

    public function contar_cantv_disponible() {

        $query = $this->db->query("select count(*) as cantv from t_numeros_telefonicos where  estatus='D'");

        return $query->result();
    }

    public function contar_digitel_disponible() {

        $query = $this->db->query("select count(*) as digitel from t_numeros_telefonicos_digitel where  estatus='D'");

        return $query->result();
    }

    public function contar_movilnet_disponible() {

        $query = $this->db->query("select count(*) as movilnet from t_numeros_telefonicos_movilnet where  estatus='D'");

        return $query->result();
    }

    public function contar_movistar_disponible() {

        $query = $this->db->query("select count(*) as movistar from t_numeros_telefonicos_movistar where  estatus='D'");

        return $query->result();
    }

    public function get_id($id = null) {


        if (!is_null($id)) {
            $query = $this->db->query("select * from t_usuarios where id_usuario = '{$id}' ");

            if ($query->num_rows() === 1) {
                return $query->row_array();
            }

            return null;
        }
    }

    public function upd($param) {
        $campos = array(
            'rol' => $param['rol'],
            'estatus' => $param['estatus'],
        );

        $this->db->where('id_usuario', $param['id']);
        $this->db->update('t_usuarios', $campos);


        $query = $this->db->query("select * from t_usuarios");

        return $query->result();
    }

    public function consultar_encuesta($id = null) {


        if (!is_null($id)) {
            $query = $this->db->query("select * from t_encuestas where id_encuesta = '{$id}' ");

            if ($query->num_rows() === 1) {
                return $query->row_array();
            }

            return null;
        }
    }

    public function actualizar_encuesta($param) {
        $campos = array(
            'nombre' => $param['nombre'],
            'descripcion' => $param['descripcion'],
            'limite_cantv' => $param['cantv'],
            'limite_digitel' => $param['digitel'],
            'limite_movistar' => $param['movistar'],
            'limite_movilnet' => $param['movilnet'],
            'estatus' => $param['estatus'],
        );

        $this->db->where('id_encuesta', $param['id']);
        $this->db->update('t_encuestas', $campos);


        $query = $this->db->query("select * from t_encuestas");

        return $query->result();
    }

    public function consultar_pregunta($id = null) {


        if (!is_null($id)) {
            $query = $this->db->query("select * from t_preguntas where id_pregunta = '{$id}' ");

            if ($query->num_rows() === 1) {
                return $query->row_array();
            }

            return null;
        }
    }

    public function actualizar_pregunta($param) {
        $campos = array(
            'pregunta' => $param['pregunta'],
            'tipo_pregunta' => $param['tipo_pregunta'],
            'categoria' => $param['categoria'],
            'estatus' => $param['estatus'],
        );

        $this->db->where('id_pregunta', $param['id']);
        $this->db->update('t_preguntas', $campos);


        $query = $this->db->query("select * from t_preguntas");

        return $query->result();
    }

    public function consultar_respuesta($id = null) {


        if (!is_null($id)) {
            $query = $this->db->query("select * from t_respuestas where id_respuesta = '{$id}' ");

            if ($query->num_rows() === 1) {
                return $query->row_array();
            }

            return null;
        }
    }

    public function actualizar_respuesta($param) {
        $campos = array(
            'respuesta' => $param['respuesta'],
            'estatus' => $param['estatus'],
        );

        $this->db->where('id_respuesta', $param['id']);
        $this->db->update('t_respuestas', $campos);


        $query = $this->db->query("select * from t_respuestas");

        return $query->result();
    }

    public function consultar_subrespuesta($id = null) {


        if (!is_null($id)) {
            $query = $this->db->query("select * from t_sub_respuestas where id_subrespuesta = '{$id}' ");

            if ($query->num_rows() === 1) {
                return $query->row_array();
            }

            return null;
        }
    }

    public function actualizar_subrespuesta($param) {
        $campos = array(
            'sub_respuesta' => $param['respuesta'],
            'estatus' => $param['estatus'],
        );

        $this->db->where('id_subrespuesta', $param['id']);
        $this->db->update('t_sub_respuestas', $campos);


        $query = $this->db->query("select * from t_sub_respuestas");

        return $query->result();
    }

}

/* End of file events_model.php */
/* Location: ./application/models/events_model.php */