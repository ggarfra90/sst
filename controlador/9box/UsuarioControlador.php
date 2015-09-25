<?php

require_once __DIR__ . '/../../modeloNegocio/9box/UsuarioNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/9box/PerfilNegocio.php';
require_once __DIR__ . '/../../util/Configuraciones.php';
require_once __DIR__ . '/../core/ControladorBase.php';


/**
 * Description of UsuarioControlador
 *
 * @author CHL007
 */
class UsuarioControlador extends ControladorBase{
    public function getAll(){
        return UsuarioNegocio::create()->getAll(0);
    }
    public function getAllRecursos(){
        return UsuarioNegocio::create()->getAllRecursos();
    }
    public function getUsuario(){
        $usuarioId = $this->getParametro("id");
        return UsuarioNegocio::create()->getAll($usuarioId);
    }
    public function save(){
        $usuarioCodAd = $this->getParametro("cod_ad");
        $jefeCodAd= $this->getParametro("jefe_cod_ad");
        $gerenteCodAd = $this->getParametro("gerente_cod_ad");
        $perfiles = $this->getParametro("perfiles");
        $estado= $this->getParametro("estado");
        $usuarioCreacion = $this->getUsuarioId();
        
        $this->setCommitTransaction();
        $data = UsuarioNegocio::create()->save($usuarioCodAd, $jefeCodAd, $gerenteCodAd, $perfiles, $estado, $usuarioCreacion);
        $this->validateResponse($data);
    }
    public function delete(){
        $id = $this->getParametro("id");
        
        $this->validateResponse(UsuarioNegocio::create()->delete($id));
    }
    
    public function getAllPerfil(){
        return PerfilNegocio::create()->getAll();
    }
}
