<?php
require_once __DIR__.'/../util/Seguridad.php';
include_once __DIR__.'/../../../util/Configuraciones.php';     
require_once __DIR__.'/../../../controlador/9box/PDFNineBoxControlador.php';
include_once __DIR__.'/../../../util/ObjectUtil.php';

$anio = $_POST['anio'];
$codAD = $_POST['cod_ad'];
$evaluacionValor = $_POST['evaluacion_valor'];
$prpValor = $_POST['prp_valor'];

header("Content-type:application/pdf");
echo(getPDFEvaluacion($anio,$codAD,$evaluacionValor,$prpValor));
