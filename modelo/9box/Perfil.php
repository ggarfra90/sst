<?php
require_once __DIR__."/../core/ModeloBase.php";
require_once __DIR__."/../enumeraciones/EstadoGenerico.php";

/*
 * @author Christopher Heredia <cheredia@imaginatecperu.com>
 * @version 1.0
 * @copyright (c) 2015, IMAGINA TECHNOLOGIES S.A.C.
 * @abstract Clase donde se implementará a la pregunta
 */
class Perfil extends ModeloBase {
    
    public function getAll(){
        $this->commandPrepare("sp_perfil_getAll");
        return $this->commandGetData();
    }
}
