<script type="text/javascript">
    // To make Pace works on Ajax calls
    $(document).ajaxStart(function() {
        Pace.restart();
    });
    $('.ajax').click(function() {
        $.ajax({url: '#', success: function(result) {
                $('.ajax-content').html('<hr>Ajax Request Completed !');
            }});
    });</script>

<div class="ajax-content">
</div>
<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>


<section class="content">

    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">SDE</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
     </div>
        </div>
      
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
<!--                    El Sistema de Registro y Control de Actividades y Proyectos permite el registro, presentación, seguimiento y gestión digital de las fases del desarrollo un proyecto.             -->

                </div>
                <div class="col-md-12">&nbsp;</div>
                <div class="col-md-12" align="center"><?php echo '<img width="10%" src="' . base_url() . 'application/recursos/imagenes/LogoCesppa.png">'; ?></div> 
                <div class="col-md-12">&nbsp;</div>
                <div class="col-md-12">&nbsp;</div> 
                <div class="col-md-12">&nbsp;</div>
            </div>
        </div>
    </div>
</section>



