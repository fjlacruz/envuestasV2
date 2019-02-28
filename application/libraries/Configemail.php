<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Configemail {

    function ConfigSrvEmail() {

			$email_config = Array(
				'protocol'  => 'sendmail',
				'smtp_host' => 'localhost',
				'smtp_port' => '25',
				'smtp_user' => 'waldo',
				'smtp_pass' => 'wilson1993',
				'mailtype'  => 'html',
				'starttls'  => true,
				'newline'   => "\r\n"
			);
        return $email_config;
    }

    //Ejemplo de utilizaciÃ³n para una clave de 10 caracteres: 
}
