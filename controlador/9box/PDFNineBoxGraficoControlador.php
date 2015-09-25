<?php

/*
 * @version 1.0
 * @copyright (c) 2015, IMAGINA TECHNOLOGIES S.A.C.
 */
require_once __DIR__ . '/../../util/Configuraciones.php';
require_once __DIR__ . '/../../modeloNegocio/9box/EvaluacionNegocio.php';
require_once __DIR__ . '/../../modelo/itec/Usuario.php';
require_once __DIR__ . '/../commons/tcpdf/config/lang/eng.php';
require_once __DIR__ . '/../commons/tcpdf/tcpdf.php';

class PDFNineBoxGraficoControlador extends TCPDF {
    private $anchoCelda = 30;
    private $altoCelda = 6;
    private $altoCeldaNB = 25;
    private $nineBox = null; 
    private $usuariosTotal = null;
    private $posicion = "I";

    public function Footer() {
        
    }

    private function calcX($x) {
        return ($this->posicion == "D") ? ($x + 150) : $x + 20;
    }

    private function calcY($y) {
        return ($y - 10);
    }

    public function dibujaFondo($oficial) {
        if ($oficial) {
            $this->SetFillColor(240);
            $this->Rect(160, $this->calcY(-10), 130, 180, 'DF', "L");
        } else {
            $this->Image(Configuraciones::url_base() . '/vistas/images/copia_no_oficial_copia.jpg', 160, 10, 152, 210, '', '', '', false, 300, '', false, false, 0);
        }
    }

    // Colored table
    public function dibujaContenido($data) {
        // 1ra Sección

        $this->nineBox = $data->nineBox;
        $this->usuariosTotal = $data->usuariosTotal;
        
        // 2.3. Espacio
        $this->Ln();

        // 3ra Sección, Datos de cargo 
        // 3.1. Cabecera de tabla
        $this->SetY($this->calcY(30));
        $this->SetX($this->calcX(10));
        $this->Cell(55, $this->altoCeldaNB, "Potencial alto (>80)", 0, 0, 'C', 0);
        $this->SetFillColor(34,113,179);
        $this->dibijaCuadrante("B3");
        $this->SetFillColor(255,164,32);
        $this->dibijaCuadrante("B6");
        $this->SetFillColor(255,164,32);
        $this->dibijaCuadrante("B9");
        $this->Ln();
        
        $i = 0;
        $i += 1;
        $this->SetY($this->calcY(55));
        $this->SetX($this->calcX(10));
        $this->Cell(55, $this->altoCeldaNB, "Potencial promedio (51-79)", 0, 0, 'C', 0);
        $this->SetFillColor(87,166,57);
        $this->dibijaCuadrante("B2");
        $this->SetFillColor(87,166,57);
        $this->dibijaCuadrante("B5");
        $this->SetFillColor(255,164,32);
        $this->dibijaCuadrante("B8");
        $this->Ln();
        
        $i += 1;
//        
//        $this->SetFont("", "B");
        $this->SetY($this->calcY(80));
        $this->SetX($this->calcX(10));
        $this->Cell(55, $this->altoCeldaNB, "Potencial bajo (<50)", 0, 0, 'C', 0);
        $this->SetFillColor(248, 0, 0);
        $this->dibijaCuadrante("B1");
        $this->SetFillColor(87,166,57);
        $this->dibijaCuadrante("B4");
        $this->SetFillColor(34,113,179);
        $this->dibijaCuadrante("B7");
        $this->Ln();
        
        $i += 1;
        $this->SetY($this->calcY(107));
        $this->SetX($this->calcX(10));
        $this->Cell(55, $this->altoCelda, "", 0, 0, 'C', 0);

        $this->Cell($this->anchoCelda, $this->altoCelda, "Bajo (1-2)", 0, 0, 'C', 0);
        $this->Cell($this->anchoCelda, $this->altoCelda, "Promedio (3)", 0, 0, 'C', 0);
        $this->Cell($this->anchoCelda, $this->altoCelda, "Alto (4-5)", 0, 0, 'C', 0);

        $i += 1;
        $this->SetY($this->calcY(113));
        $this->SetX($this->calcX(10));
        $this->Cell(55, $this->altoCelda, "", 0, 0, 'C', 0);

        $this->Cell($this->anchoCelda*3,$this->altoCelda*1.5, "Desempeño", 0, 0, 'C', 0);
        $this->Ln();
        foreach ($this->nineBox as $itemBox){
            $this->Ln();
            $this->SetFont('helvetica','b',10);
            $this->Write(10, "Usuarios en ".$itemBox["valor"]." (". $this->getPorcentaje($itemBox["cantidad"])."%): ", '', 0, 'L', true, 0, false, false, 0);
            $this->SetFont('helvetica','',10);
            foreach ($itemBox["usuarios"] as $usuario){
                $this->Write(0, $usuario["cod_ad"], '', 0, 'L', true, 0, false, false, 0);
            }
        }
        
        if (!ObjectUtil::isEmpty($data->usuariosFaltantes)){
            $this->Ln();
            $this->SetFont('helvetica','b',10);
            $this->Write(10, "Usuarios pendientes de evaluacion y/o PRP (". $this->getPorcentaje(count($data->usuariosFaltantes))."%):", '', 0, 'L', true, 0, false, false, 0);
            $this->SetFont('helvetica','',10);
            foreach ($data->usuariosFaltantes as $usuario){
                $this->Write(0, $usuario, '', 0, 'L', true, 0, false, false, 0);
            }
        }
    }
    
    function getPorcentaje($cantidad){
        return number_format(($cantidad*100/$this->usuariosTotal),2);
    }
    
    function dibijaCuadrante($valor){
        foreach($this->nineBox as $itemBox){
            if ($valor == $itemBox["valor"]){
                $this->SetFont('helvetica','b',12); 
                $porcentaje = $this->getPorcentaje($itemBox["cantidad"]);
                $this->Cell($this->anchoCelda, $this->altoCeldaNB, "$valor ($porcentaje%)", 1, 0, 'C', TRUE);
                $this->SetFont("helvetica", "", 10);
                return;
            }
        }
        $this->Cell($this->anchoCelda, $this->altoCeldaNB, $valor, 1, 0, 'C', TRUE);
    }
}

function getPDFGraficoInmediato($anio){
    $cookie = $_COOKIE[Configuraciones::COOKIE_NAME_SID];
    if (isset($cookie)) {
        $codAd = Util::desencripta($cookie);
        $usuBD = Usuario::create()->getUsuarioID($codAd);
        $id = $usuBD[0]["id"];
        
        $data = EvaluacionNegocio::create()->graficoGetInmediato($id, $anio);
        $titulo = "Gráfico inmediato de $codAd";
        getPDFGrafico($data, $titulo);
    }
}

function getPDFGraficoTotal($id, $codAd, $anio){
    if (ObjectUtil::isEmpty($id)){
        $cookie = $_COOKIE[Configuraciones::COOKIE_NAME_SID];
        if (isset($cookie)) {
            $codAd = Util::desencripta($cookie);
            $usuBD = Usuario::create()->getUsuarioID($codAd);
            $id = $usuBD[0]["id"];
        }
    }
    $data = EvaluacionNegocio::create()->graficoGetTotal($id, $anio);
    $titulo = "Gráfico total de $codAd";
    getPDFGrafico($data, $titulo);
}

function getPDFGrafico($data, $titulo) { // los parametros para la boleta de pago seleccionada
    // create new PDF document
    $pdf = new PDFNineBoxGraficoControlador(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Nine box", "Reporte de nine box: $titulo");

    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    $pdf->SetMargins(30, 30, 10, true);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Imagina Technologies S.A.C.');
    $pdf->SetTitle('Reporte');

    // set font
    $pdf->SetFont('helvetica', '', 10);

    // add a page
    $pdf->AddPage('A4');
    
    $pdf->dibujaContenido($data);
    // ---------------------------------------------------------
    // close and output PDF document
    return $pdf->Output('evaluacion.pdf', 'I');
}
