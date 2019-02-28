<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>



<section class="content">
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Cantidad de Tel&eacute;fonos Disponibles
            </h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div  class="col-sm-12" id="resultado" ></div>
                <div id="cantidades"></div>
            </div>
        </div>
    </div>
</div>

</section>

<script>
    $(document).ready(function() {

        $.ajax({
            url: "<?php echo base_url() . 'index.php/Inventario/verCantidades'; ?>",
            dataType: 'html',
            beforeSend: function() {
                $("#resultado").show();
                $("#resultado").html('<div><?php echo '<img width="2%" src="' . base_url() . 'application/recursos/imagenes/ajax-loader_1.gif"> Procesando Peticion....'; ?></div>');
            },
            success: function(response) {
                 $("#resultado").fadeOut();
                $("#cantidades").html(response);
            }

        });
    });
</script>


