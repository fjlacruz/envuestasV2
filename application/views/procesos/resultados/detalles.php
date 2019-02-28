<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<section class="content">
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo $nombre[0][1] ?></h3>
        </div>
        <div class="box-body">

            <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>


            <table id='datatable'>
                <thead>
                    <tr>
                        <th></th> 
                        <?php
                        for ($x = 0; $x <= count($datos) - 1; $x++) {
                            $pregunta = $datos[$x][1];
                            ?>
                            <th><?php echo $pregunta ?></th>  
                        <?php }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($x = 0; $x <= count($datos) - 1; $x++) {

                        $id_pregunta = $datos[$x][0];
                        $pregunta = $datos[$x][1];
                        $id_respuesta = $datos[$x][2];
                        $respuesta = $datos[$x][3];
                        $id_respuesta_conteo = $datos[$x][4];
                        ?>
                        <tr>
                            <th><?php echo $respuesta ?></th>  

                            <td><?php echo $id_respuesta_conteo ?></td> 

                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>



</section>
<script type="text/javascript">
    Highcharts.chart('container', {
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Data extracted from a HTML table in the page'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Units'
            }
        },
        tooltip: {
            formatter: function() {
                return '<b>' + this.series.name + '</b><br/>' +
                        this.point.y + ' ' + this.point.name.toLowerCase();
            }
        }
    });
</script>

