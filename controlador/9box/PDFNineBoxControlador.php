<?php

/*
 * @version 1.0
 * @copyright (c) 2015, IMAGINA TECHNOLOGIES S.A.C.
 */
require_once __DIR__ . '/../../util/Configuraciones.php';
require_once __DIR__ . '/../../modeloNegocio/9box/EvaluacionNegocio.php';
require_once __DIR__ . '/../commons/tcpdf/config/lang/eng.php';
require_once __DIR__ . '/../commons/tcpdf/tcpdf.php';

class PDFNineBoxControlador extends TCPDF {
    private $anchoCelda = 30;
    private $altoCelda = 6;
    private $posicion = "I";

//    public function Header() {
//        
//    }

    public function Footer() {
        
    }

    private function calcX($x) {
        return ($this->posicion == "D") ? ($x + 150) : $x + 20;
    }

    private function calcY($y) {
        return ($y + 20);
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
    public function dibujaEvaluacion($anio, $codAD, $evaluacionValor, $prpValor, $resultado, $titulo, $descripcion) {
        // 1ra Sección
        // 1.1 Logo
//        $this->Image(Configuraciones::url_base() . Configuraciones::IMG_PDF_DIR, $this->calcX(0), $this->calcY(-1), 40, 9);

        $this->SetY($this->calcY(10));
        $this->SetX($this->calcX(10));
        $this->Cell(25, $this->altoCelda, "Año", 1, 0, 'C', 0);
        $this->Cell(50, $this->altoCelda, "Usuario", 1, 0, 'C', 0);
        $this->Cell(25, $this->altoCelda, "Evaluación(%)", 1, 0, 'C', 0);
        $this->Cell(25, $this->altoCelda, "PRP", 1, 0, 'C', 0);
        $this->Cell(25, $this->altoCelda, "Resultado", 1, 0, 'C', 0);
        
        $this->Ln();
        
        $i += 1;
        $this->SetY($this->calcY(10) + $i * $this->altoCelda);
        $this->SetX($this->calcX(10));
        $this->Cell(25, $this->altoCelda, $anio, "LRB", 0, 'C', 0);
        $this->Cell(50, $this->altoCelda, $codAD, "RB", 0, 'C', 0);
        $this->Cell(25, $this->altoCelda, $evaluacionValor, "RB", 0, 'C', 0);
        $this->Cell(25, $this->altoCelda, $prpValor, "RB", 0, 'C', 0);
        $this->Cell(25, $this->altoCelda, $resultado, "RB", 0, 'C', 0);
        $this->Ln();
        
        // 2.3. Espacio
        $this->Ln();

        // 3ra Sección, Datos de cargo 
        // 3.1. Cabecera de tabla
        $this->SetY($this->calcY(30));
        $this->SetX($this->calcX(10));
        $this->Cell(55, $this->altoCelda*3, "Potencial alto (>80)", 0, 0, 'C', 0);
        $this->SetFillColor(34,113,179);
        $this->dibijaCuadrante("B3", $resultado);
        $this->SetFillColor(255,164,32);
        $this->dibijaCuadrante("B6", $resultado);
        $this->SetFillColor(255,164,32);
        $this->dibijaCuadrante("B9", $resultado);
        $this->Ln();
        
        $i = 0;
        $i += 1;
        $this->SetY($this->calcY(50));
        $this->SetX($this->calcX(10));
        $this->Cell(55, $this->altoCelda*3, "Potencial promedio (51-79)", 0, 0, 'C', 0);
        $this->SetFillColor(87,166,57);
        $this->dibijaCuadrante("B2", $resultado);
        $this->SetFillColor(87,166,57);
        $this->dibijaCuadrante("B5", $resultado);
        $this->SetFillColor(255,164,32);
        $this->dibijaCuadrante("B8", $resultado);
        $this->Ln();
        
        $i += 1;
//        
//        $this->SetFont("", "B");
        $this->SetY($this->calcY(70));
        $this->SetX($this->calcX(10));
        $this->Cell(55, $this->altoCelda*3, "Potencial bajo (<50)", 0, 0, 'C', 0);
        $this->SetFillColor(248, 0, 0);
        $this->dibijaCuadrante("B1", $resultado);
        $this->SetFillColor(87,166,57);
        $this->dibijaCuadrante("B4", $resultado);
        $this->SetFillColor(34,113,179);
        $this->dibijaCuadrante("B7", $resultado);
        $this->Ln();
        
        $i += 1;
        $this->SetY($this->calcY(90));
        $this->SetX($this->calcX(10));
        $this->Cell(55, $this->altoCelda, "", 0, 0, 'C', 0);

        $this->Cell($this->anchoCelda, $this->altoCelda*1.5, "Bajo (1-2)", 0, 0, 'C', 0);
        $this->Cell($this->anchoCelda, $this->altoCelda*1.5, "Promedio (3)", 0, 0, 'C', 0);
        $this->Cell($this->anchoCelda, $this->altoCelda*1.5, "Alto (4-5)", 0, 0, 'C', 0);

        $this->Ln();
        
        $i += 1;
        $this->SetY($this->calcY(100));
        $this->SetX($this->calcX(10));
        $this->Cell(55, $this->altoCelda, "", 0, 0, 'C', 0);

        $this->Cell($this->anchoCelda*3,$this->altoCelda*1.5, "Desempeño", 0, 0, 'C', 0);

        $this->Ln();
        $this->Ln();
        $this->SetFont('helvetica','b',10);
        $this->Write(10, $titulo, '', 0, 'L', true, 0, false, false, 0);
        $this->SetFont('helvetica','',10);
        $this->Write(0, $descripcion, '', 0, 'L', true, 0, false, false, 0);
    }
    
    function dibijaCuadrante($valor, $resultado){
        if ($valor == $resultado){
            $this->SetFont('helvetica','b',16); 
            $this->Cell($this->anchoCelda, $this->altoCelda*3, $valor, 1, 0, 'C', TRUE);
            $this->SetFont("helvetica", "", 10);
        }else{
            $this->Cell($this->anchoCelda, $this->altoCelda*3, $valor, 1, 0, 'C', TRUE);
        }
    }
}

function getPDFEvaluacion($anio, $codAD, $evaluacionValor, $prpValor) { // los parametros para la boleta de pago seleccionada
    // create new PDF document
    $pdf = new PDFNineBoxControlador(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Nine box", "Reporte de nine box");

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
    
    $nineBox = EvaluacionNegocio::create()->reporteGetNineBox($evaluacionValor, $prpValor);
    $valor = $nineBox->valor;
    $titulo = $nineBox->titulo;
    $descripcion = $nineBox->descripcion;

    $pdf->dibujaEvaluacion($anio, $codAD, $evaluacionValor, $prpValor, $valor, $titulo, $descripcion);
    // ---------------------------------------------------------
    // close and output PDF document
    return $pdf->Output('evaluacion.pdf', 'I');
}
