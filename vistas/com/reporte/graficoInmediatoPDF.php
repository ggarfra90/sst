<?php
require_once __DIR__.'/../util/Seguridad.php';
include_once __DIR__.'/../../../util/Configuraciones.php';     
require_once __DIR__.'/../../../controlador/9box/PDFNineBoxGraficoControlador.php';
include_once __DIR__.'/../../../util/ObjectUtil.php';

$anio = $_POST['anio'];

header("Content-type:application/pdf");
echo(getPDFGraficoInmediato($anio));