<html lang="es">
    <head>
        <link href="vistas/libs/imagina/assets/fullcalendar/fullcalendar.css" rel="stylesheet" />
        <script src="vistas/libs/imagina/assets/fullcalendar/moment.min.js" type="text/javascript"></script>
        <script src="vistas/libs/imagina/assets/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <script src="vistas/libs/imagina/assets/fullcalendar/lang-all.js" type="text/javascript"></script>
        <script src="vistas/com/comite/reunion.js"></script>

    </head>

    <body>
        <div class="page-title">
            <h3 class="title">Comit&eacute; SST - Reuniones</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <a id="nuevaReunion" onclick="nuevaReunionComite();" style="border-radius: 0px;" class="btn btn-info w-md"><i class="fa fa-pencil" style="font-size: 18px;"></i>&nbsp;&nbsp;<i> </i><i> </i>Nuevo</a>
                    <br><br>

                    <div class="panel panel-body">
                        <div class="row">
                            <div id="calendar" class="col-md-12 col-lg-12 fc fc-ltr fc-unthemed">
                            </div>
                        </div>
                        <input type="hidden" id="comiteCale" value="<?php echo $_GET['param'];?>"/>
                        <!-- page end-->
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>

