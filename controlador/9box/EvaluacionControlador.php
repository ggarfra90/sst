<?php
require_once __DIR__ . '/../../modeloNegocio/9box/EvaluacionNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/9box/UsuarioNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/9box/AnioNegocio.php';
require_once __DIR__ . '/../../util/Configuraciones.php';
require_once __DIR__ . '/../core/ControladorBase.php';
/**
 * Description of PRPControlador
 *
 * @author CHL007
 */
class EvaluacionControlador extends ControladorBase{
    public function getAllUsuarios(){
        $usuarioId = $this->getUsuarioId();
        return UsuarioNegocio::create()->getAllHijos($usuarioId);
    }
    public function getAllAnios(){
        return AnioNegocio::create()->getAll();
    }
    public function getAll(){
        $usuarioId = $this->getUsuarioId();
        return EvaluacionNegocio::create()->getAll(0, $usuarioId);
    }
    public function save(){
        $anioId = $this->getParametro("anioId");
        $usuarioId = $this->getParametro("usuarioId");
        $estado= $this->getParametro("estado");
        $usuarioCreacion = $this->getUsuarioId();
        
        $this->setCommitTransaction();
        return $this->validateResponse(EvaluacionNegocio::create()->save($anioId, $usuarioId, $estado, $usuarioCreacion));
    }
    public function delete(){
        $id = $this->getParametro("id");
        $this->validateResponse(EvaluacionNegocio::create()->delete($id));
    }
    public function getAllPreguntas(){
        $evaluacionId = $this->getParametro("evaluacionId");
        return EvaluacionNegocio::create()->getAllPreguntas($evaluacionId);
    }
    public function savePreguntas(){
        $preguntas = $this->getParametro("preguntas");
        $evaluacionId = $this->getParametro("evaluacionId");
        $enviar = $this->getParametro("enviar");
        $usuarioCreacion = $this->getUsuarioId();
        return EvaluacionNegocio::savePreguntas($evaluacionId, $preguntas, $enviar, $usuarioCreacion);
    }
}
