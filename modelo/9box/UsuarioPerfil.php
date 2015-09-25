<?php
require_once __DIR__."/../core/ModeloBase.php";
require_once __DIR__."/../enumeraciones/EstadoGenerico.php";

/*
 * @author Christopher Heredia <cheredia@imaginatecperu.com>
 * @version 1.0
 * @copyright (c) 2015, IMAGINA TECHNOLOGIES S.A.C.
 * @abstract Clase donde se implementará a la pregunta
 */
class UsuarioPerfil extends ModeloBase {
     
    public function save($usuarioId, $perfilId, $estado){
        $this->commandPrepare("sp_usuario_perfil_save");
        $this->commandAddParameter(":vin_usuario_id", $usuarioId);
        $this->commandAddParameter(":vin_perfil_id", $perfilId); 
        $this->commandAddParameter(":vin_estado", $estado); 
        return $this->commandGetData();
    }
    
    public function delete($usuarioId,$estado){
        $this->commandPrepare("sp_usuario_perfil_delete");
        $this->commandAddParameter(":vin_usuario_id", $usuarioId);
        $this->commandAddParameter(":vin_estado", $estado); 
        return $this->commandGetData();
    }
}