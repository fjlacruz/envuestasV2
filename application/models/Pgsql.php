<?php

defined('BASEPATH') OR exit('No direct script access allowed'); //Esta linea es por seguridad

class Pgsql extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    ///Desconexion de la base de datos
    function fdbDesConexion($conexion = "") {
        pg_close();
    }

    //Init pg_query
    function iniciarTransaccion() {
        return pg_query("BEGIN WORK");
    }

    //Commit
    function aceptarTransacciones() {
        return pg_query("COMMIT");
    }

    //rollback
    function cancelarTransaccion() {
        return pg_query("ROLLBACK");
    }

    //Logica del pgSql
    function SELECTPLSQL($funcion, $arrayParametros, $mostrarQuery = true) {

        $parametros = array();
        foreach ($arrayParametros as $indice => $valores) {
            array_push($parametros, $valores);
        }

        if (count($parametros) > 1) {
            $parametrosSeparados = "";

            foreach ($parametros as $indice => $datos) {
                if ($indice == 0) {
                    $parametrosSeparados.="'" . $datos . "'" . ",";
                } elseif ($indice == 1) {
                    $parametrosSeparados.="'" . $datos . "'";
                } else {
                    $parametrosSeparados.="," . "'" . $datos . "'";
                }
            }
        } elseif (count($parametros) == 1) {
            $parametrosSeparados = "'" . $parametros[0] . "'";
        } else {
            $parametrosSeparados = "";
        }

        $sql = "SELECT " . $funcion . "(" . $parametrosSeparados . ");";
        // echo "-------->" . $mostrarQuery;
        if ($mostrarQuery == true) {
            //echo '<strong>'.$sql.'</strong><br />';
        }
        $res = pg_query($sql);
        $datosSelect = pg_fetch_array($res);
        $arrayFilasColumnas = array();
        //echo "-->".$datosSelect[0];
        //separar resultado en filas
        $separarFilas = explode("|", $datosSelect[0]);

        foreach ($separarFilas as $indiceFilas => $filas) {
            $separarColumnas = explode("~", $filas);
            foreach ($separarColumnas as $indiceColumnas => $columnas) {
                $arrayFilasColumnas[$indiceFilas][$indiceColumnas] = $columnas;
            }
        }

        if (count($arrayFilasColumnas) > 0) {
            return $arrayFilasColumnas;
        } else {
            return $arrayFilasColumnas[0][0] = "";
        }
    }

//Funcion
}

/// Clase