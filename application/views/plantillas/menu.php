<?php
$variablesSesion = $this->session->userdata('usuario');
if ($variablesSesion == "") {
    redirect('principal/session');
}
?>

<body class="skin-red sidebar-mini  pace-done sidebar-collapse">
    <div class="wrapper">
        <header class="main-header">

            <a href="#" class="logo">

                <span class="logo-mini"><b>S</b>DE</span>

                <span class="logo-lg"><b>Sistema de Encuesta</b></span>
            </a>

            <nav class="navbar navbar-static-top">

                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only"></span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="<?php echo base_url() ?>index.php/Administracion/usuarioModificar" data-toggle="tooltip" data-placement="top" class="navbar-link">Usuario:
                                <?php echo $variablesSesion['nombres'] . " " . $variablesSesion['apellidos'] ?></a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() ?>index.php/Principal/logout" data-toggle="tooltip" data-placement="top" title="Salir del Sistema"><span class="fa fa-log-in"></span> Salir</a>

                        </li>
                    </ul>
                </div>
            </nav>
        </header>
    </div>
    <aside class="main-sidebar">

        <section class="sidebar">

            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?php echo base_url(); ?>application/libraries/dist/img/90D988F6C.png" class="img-circle" alt="User Image">
                </div>

            </div>
            <ul class="sidebar-menu">
                <li class="header">SISTEMA DE ENCUESTAS</li>
                <li class="treeview">
                    <a href="<?php echo base_url() ?>index.php/Principal/bienvenida"  class="ajax">
                        <i class="fa fa-dashboard"></i> <span>Inicio</span>
                    </a>
                </li>
                <?php if ($variablesSesion['rol'] == 1) { ?>
                    <li class="treeview">
                        <a href="<?php echo BASE_URL() ?>index.php/Administracion/buscarDatos"  class="ajax">
                            <i class="fa fa-users"></i> <span>Datos Usuarios</span>
                        </a>
                    </li>

                    <li class="treeview">
                        <a href="<?php echo BASE_URL() ?>index.php/Inventario/inicio"  class="ajax">
                            <i class="fa fa-suitcase"></i> <span>Inventario Telef&oacute;nico</span>
                        </a>
                    </li>

                    <li class="treeview">
                        <a href="<?php echo BASE_URL() ?>index.php/Encuesta/inicio"  class="ajax">
                            <i class="fa fa-unlock"></i> <span>Administraci&oacute;n de Encuestas</span>
                        </a>
                    </li>

                    <li class="treeview">
                        <a href="<?php echo BASE_URL() ?>index.php/Resultados/inicio"  class="ajax">
                            <i class="fa fa-file-text-o"></i> <span>Resultadosde Encuestas</span>
                        </a>
                    </li>

                <?php } ?>

                <?php if ($variablesSesion['rol'] == 3) { ?>

                    <li class="treeview">
                        <a href="<?php echo BASE_URL() ?>index.php/Encuesta/inicio"  class="ajax">
                            <i class="fa fa-unlock"></i> <span>Administraci&oacute;n de Encuestas</span>
                        </a>
                    </li>

                <?php } ?>

                <?php if ($variablesSesion['rol'] == 4) { ?>   
                    <li class="treeview">
                        <a href="<?php echo BASE_URL() ?>index.php/Resultados/inicio"  class="ajax">
                            <i class="fa fa-file-text-o"></i> <span>Resultadosde Encuestas</span>
                        </a>
                    </li>
                <?php } ?>

                <li class="treeview">
                    <a href="<?php echo BASE_URL() ?>index.php/Formularios/inicio" class="ajax">
                        <i class="fa fa-list-ol"></i> <span>Formulario de Encuestas</span>
                    </a>
                </li>
            </ul>
        </section>
    </aside>
    <div class="content-wrapper">






