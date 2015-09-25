<?php
require_once __DIR__ . '/../../modeloNegocio/9box/EvaluacionNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/9box/AnioNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/9box/UsuarioNegocio.php';
require_once __DIR__ . '/../../util/Configuraciones.php';
require_once __DIR__ . '/../core/ControladorBase.php';
/**
 * Description of PRPControlador
 *
 * @author CHL007
 */
class ReportesControlador extends ControladorBase{
    //put your code here
    public function reporteGetInmediato(){
        $usuarioId = $this->getUsuarioId();
        return EvaluacionNegocio::create()->reporteGetInmediato($usuarioId);
    }
    public function reporteGetTotal(){
        $usuarioId = $this->getUsuarioId();
        return EvaluacionNegocio::create()->reporteGetTotal($usuarioId);
    }
    public function reporteGetRRHH(){
        $usuarioId = $this->getUsuarioId();
        return EvaluacionNegocio::create()->reporteGetRRHH($usuarioId);
    }
    public function reporteGetNineBox(){
        $evaluacionValor = $this->getParametro("evaluacionValor");
        $prpValor = $this->getParametro("prpValor");
        return EvaluacionNegocio::create()->reporteGetNineBox($evaluacionValor, $prpValor);
    }
    public function updateComentario(){
        $evaluacionId = $this->getParametro("evaluacionId");
        $comentario = $this->getParametro("comentario");
        return EvaluacionNegocio::create()->updateComentario($evaluacionId, $comentario);
    }
    public function getAllAnios(){
        return AnioNegocio::create()->getAll();
    }
    public function graficoGetInmediato(){
        return EvaluacionNegocio::create()->graficoGetInmediato($this->getUsuarioId(), $this->getParametro("anioId"));
    }
    public function graficoGetTotal(){
        $usuarioId = $this->getParametro("usuarioId");
        if (ObjectUtil::isEmpty($usuarioId) || $usuarioId == 0){
            $usuarioId = $this->getUsuarioId();
        }
        return EvaluacionNegocio::create()->graficoGetTotal($usuarioId, $this->getParametro("anioId"));
    }
    public function getAllUsuarios(){
        return UsuarioNegocio::create()->getAllRegistrador();
    }
}
