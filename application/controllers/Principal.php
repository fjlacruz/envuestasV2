<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Principal extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('email');
        $this->load->model('Pgsql');
        $this->load->library('Configemail');
    }

    public function index() {

        redirect('principal/inicio', 'refresh');
    }

    function inicio() {
        $this->load->view('plantillas/login/header');
        $this->load->view('login');
        $this->load->view('plantillas/footer');
    }

    function login() {

        $this->load->view('plantillas/login/header');
        $this->load->view('login');
        $this->load->view('plantillas/footer');

        if (isset($_POST['usuario'])) {

//Recogemos las variables 'usuario' y 'contrasena'
            $usuario = $this->input->post('usuario');
            $clave = md5($this->input->post('clave'));


            $arrayValidar = array();
            $arrayValidar[] = $usuario;
            $arrayValidar[] = $clave;

// cargamos el modelo para verificar el usuario/contraseña
// si el usuario y contraseña son correctos
            $consultarUsuario = $this->Pgsql->SELECTPLSQL('usuarios', $arrayValidar);

            if ($consultarUsuario[0][0] != "") {

//Creamos las variables de Sesión
                $datasession = array(
                    'cedula' => $consultarUsuario[0][0],
                    'nombres' => $consultarUsuario[0][1],
                    'apellidos' => $consultarUsuario[0][2],
                    'rol' => $consultarUsuario[0][3],
                    'id_usuario' => $consultarUsuario[0][4],
                   
                );

                $this->session->set_userdata('usuario', $datasession);
                $variablesSesion = $this->session->userdata('usuario');

                redirect('principal/bienvenida', 'refresh');
            } else {
// si el usuario y contraseña son incorrectos
                $this->session->set_flashdata('danger', '<div class="alert alert-danger alert-dismissable fade in" style="display:block" >
                                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                         <i class="icon fa fa-ban"></i> <strong>Alerta! </strong>Clave Incorrecta....!!!</div>');
                redirect('principal/inicio', 'refresh');
            }
        } else {
            // SI NO EXISTE LA VARIABLE SESION REFRESCAMO EL INICIO
            redirect('principal/inicio', 'refresh');
        }
    }

    // MENSAJE QUE APARECE CUANDO SE CIERRA EL SISTEMA POR INACTIVIDAD
    function session() {

        $this->session->set_flashdata('info', '<div class="alert alert-info alert-dismissable fade in" style="display:block" >
                                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                         <i class="icon fa fa-info"></i> <strong>Informacion! </strong>Sesion Cerrada por Inactividad....!!!</div>');
        redirect('principal/inicio', 'refresh');
    }

    // PAGINA CUANDO INICIAMOS SESION
    function bienvenida() {
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('bienvenida');
        $this->load->view('plantillas/footer');
    }

// Función logout. Elimina las variables de sesión y redirige al controlador principal

    function logout() {

        $this->session->sess_destroy();
// redirigimos al controlador principal
        redirect('principal/login', 'refresh');
    }

    ///CLAVES DE USUARIO recibe el tama�o de la clave
    function generarClaveAleatoria($tamanio) {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charsLength = strlen($chars);
        $randomString = '';
        for ($i = 0; $i < $tamanio; $i++) {
            $randomString .= $chars[rand(0, $charsLength - 1)];
        }
        return $randomString;
    }

    // CONSULTAMOS SI EXISTE EL CORREO 
    function consultar_correo() {
        extract($_POST);

        $arrayData = array();
        $arrayData[] = $correo;

        $consultaUsuario = $this->Pgsql->SELECTPLSQL('existe_correo', $arrayData);

        if ($consultaUsuario[0][0] != '0') {
            echo 1;
        } else {
            echo 2;
        }
    }

    // ENVIAMOS LA CONTRASE�A ALEATORIA, AL CORREO REGISTRADO
    function recuperarClave() {
        extract($_POST);

        $claveNueva = $this->generarClaveAleatoria(8);
        $arrayNuevaClave = array();
        $arrayNuevaClave[] = $correo;
        $arrayNuevaClave[] = md5($claveNueva);


        $this->Pgsql->SELECTPLSQL('actualizar_contrasenia', $arrayNuevaClave);

        $msje = "Reciba un cordial saludo sr(a)  ud, a solicitado sus datos de acceso al sistema. 
    A continuaci�n los <b>datos de ingreso</b>: <br>

    Contrase�a: <b>" . $claveNueva . "</b>";

        $configuracionSrvCorreo = $this->configemail->ConfigSrvEmail();
        $this->email->initialize($configuracionSrvCorreo);
        $this->email->from('cesppa@cesppa.gob.ve');
        $this->email->to($correo);
        $this->email->subject('Recuperación de Contraseña');
        $this->email->message($msje);
        $this->email->message($msje);
        $this->email->send();
    }
    
     function backup() {
         
         
    function dl_file($file){
   if (!is_file($file)) { die("<b>404 Archivo No Encontrado!</b>"); }
   $len = filesize($file);
   $filename = basename($file);
   $file_extension = strtolower(substr(strrchr($filename,"."),1));
   $ctype="application/force-download";
   header("Pragma: public");
   header("Expires: 0");
   header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
   header("Cache-Control: public");
   header("Content-Description: File Transfer");
   header("Content-Type: $ctype");
   $header="Content-Disposition: attachment; filename=".$filename.";";
   header($header );
   header("Content-Transfer-Encoding: binary");
   header("Content-Length: ".$len);
   @readfile($file);
   exit;
}

$action  = $_POST["actionButton"];
$ficheiro=$_FILES["path"]["name"];
switch ($action) {
    case "Import":
      $dbname = "encuesta"; //database name
      $dbconn = pg_pconnect("host=localhost port=5432 dbname=$dbname 
user=postgres password=rularv"); //connectionstring
      if (!$dbconn) {
        echo "No se ha podido conctar......!!!!\n";
        exit;
      }
      $back = fopen($ficheiro,"r");
      $contents = fread($back, filesize($ficheiro));
      $res = pg_query(utf8_encode($contents));
      echo "Upload Ok";
      fclose($back);
  break;
  case "Export":
  $dbname = "estadisticas"; //database name
  $dbconn = pg_pconnect("host=192.168.10.219 port=5432 dbname=$dbname user=postgres password=adm805ce"); //connectionstring
  if (!$dbconn) {
    echo "No se ha podido conctar......!!!!\n";
  exit;
  }
  $back = fopen("$dbname.backup","w");
  $res = pg_query(" select relname as tablename
                    from pg_class where relkind in ('r')
                    and relname not like 'pg_%' and relname not like 
'sql_%' order by tablename");
  $str="";
  while($row = pg_fetch_row($res))
  {
    $table = $row[0];
    $str .= "\n--\n";
    $str .= "-- Estrutura da tabela '$table'";
    $str .= "\n--\n";
    $str .= "\nDROP TABLE $table CASCADE;";
    $str .= "\nCREATE TABLE $table (";
    $res2 = pg_query("
    SELECT  attnum,attname , typname , atttypmod-4 , attnotnull 
,atthasdef ,adsrc AS def
    FROM pg_attribute, pg_class, pg_type, pg_attrdef WHERE 
pg_class.oid=attrelid
    AND pg_type.oid=atttypid AND attnum>0 AND pg_class.oid=adrelid AND 
adnum=attnum
    AND atthasdef='t' AND lower(relname)='$table' UNION
    SELECT attnum,attname , typname , atttypmod-4 , attnotnull , 
atthasdef ,'' AS def
    FROM pg_attribute, pg_class, pg_type WHERE pg_class.oid=attrelid
    AND pg_type.oid=atttypid AND attnum>0 AND atthasdef='f' AND 
lower(relname)='$table' ");                                             
    while($r = pg_fetch_row($res2))
    {
    $str .= "\n" . $r[1]. " " . $r[2];
     if ($r[2]=="varchar")
    {
    $str .= "(".$r[3] .")";
    }
    if ($r[4]=="t")
    {
    $str .= " NOT NULL";
    }
    if ($r[5]=="t")
    {
    $str .= " DEFAULT ".$r[6];
    }
    $str .= ",";
    }
    $str=rtrim($str, ",");  
    $str .= "\n);\n";
    $str .= "\n--\n";
    $str .= "-- Creating data for '$table'";
    $str .= "\n--\n\n";

    
    $res3 = pg_query("SELECT * FROM $table");
    while($r = pg_fetch_row($res3))
    {
      $sql = "INSERT INTO $table VALUES ('";
      $sql .= utf8_decode(implode("','",$r));
      $sql .= "');";
      $str = str_replace("''","NULL",$str);
      $str .= $sql;  
      $str .= "\n";
    }
    
     $res1 = pg_query("SELECT pg_index.indisprimary,
            pg_catalog.pg_get_indexdef(pg_index.indexrelid)
        FROM pg_catalog.pg_class c, pg_catalog.pg_class c2,
            pg_catalog.pg_index AS pg_index
        WHERE c.relname = '$table'
            AND c.oid = pg_index.indrelid
            AND pg_index.indexrelid = c2.oid
            AND pg_index.indisprimary");
    while($r = pg_fetch_row($res1))
    {
    $str .= "\n\n--\n";
    $str .= "-- Creating index for '$table'";
    $str .= "\n--\n\n";
    $t = str_replace("CREATE UNIQUE INDEX", "", $r[1]);
    $t = str_replace("USING btree", "|", $t);
    // Next Line Can be improved!!!
    $t = str_replace("ON", "|", $t);
    $Temparray = explode("|", $t);
    $str .= "ALTER TABLE ONLY ". $Temparray[1] . " ADD CONSTRAINT " . 
$Temparray[0] . " PRIMARY KEY " . $Temparray[2] .";\n";
    }   
  }
  $res = pg_query(" SELECT
  cl.relname AS tabela,ct.conname,
   pg_get_constraintdef(ct.oid)
   FROM pg_catalog.pg_attribute a
   JOIN pg_catalog.pg_class cl ON (a.attrelid = cl.oid AND cl.relkind = 'r')
   JOIN pg_catalog.pg_namespace n ON (n.oid = cl.relnamespace)
   JOIN pg_catalog.pg_constraint ct ON (a.attrelid = ct.conrelid AND
   ct.confrelid != 0 AND ct.conkey[1] = a.attnum)
   JOIN pg_catalog.pg_class clf ON (ct.confrelid = clf.oid AND 
clf.relkind = 'r')
   JOIN pg_catalog.pg_namespace nf ON (nf.oid = clf.relnamespace)
   JOIN pg_catalog.pg_attribute af ON (af.attrelid = ct.confrelid AND
   af.attnum = ct.confkey[1]) order by cl.relname ");
  while($row = pg_fetch_row($res))
  {
    $str .= "\n\n--\n";
    $str .= "-- Creating relacionships for '".$row[0]."'";
    $str .= "\n--\n\n";
    $str .= "ALTER TABLE ONLY ".$row[0] . " ADD CONSTRAINT " . $row[1] . 
" " . $row[2] . ";";
  }       
  fwrite($back,$str);
  fclose($back);
  dl_file("$dbname.backup");
  break;
}
        
 }
}
