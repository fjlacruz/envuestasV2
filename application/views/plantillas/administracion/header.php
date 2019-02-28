<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?php echo $this->config->item('site_name') ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/bootstrap.css" >
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/bootstrap.min.css" >
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/formValidation.min.css" >
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/estilos.css" >
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/datatables.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/jquery-ui.css">
        
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/jquery-confirm.css" />

        <script src="<?php echo base_url(); ?>application/recursos/js/jquery-2.1.1.min.js"></script>
        <script src="<?php echo base_url(); ?>application/recursos/js/bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>application/recursos/js/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url(); ?>application/recursos/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>application/recursos/js/datatables.min.js"></script>
        <script  src="<?php echo base_url(); ?>application/recursos/js/formValidation.min.js"></script>
        <script  src="<?php echo base_url(); ?>application/recursos/js/f_bootstrap.min.js"></script>
        <script  src="<?php echo base_url(); ?>application/recursos/js/jquery-ui.js"></script>
        
        <script  src="<?php echo base_url(); ?>application/libraries/pace/pace.min.js"></script>
        <script  src="<?php echo base_url(); ?>application/recursos/js/jquery-confirm.js"></script>


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>application/libraries/dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>application/libraries/dist/css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>application/libraries/pace/pace.min.css">

        <script src="<?php echo base_url(); ?>application/libraries/dist/js/app.min.js"></script>
    </head>



