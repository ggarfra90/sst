<?php

require_once __DIR__."/../core/ModeloBase.php";
require_once __DIR__."/../enumeraciones/EstadoGenerico.php";
/**
 * Description of Anio
 *
 * @author Imagina03
 */
class Anio extends ModeloBase{
    //put your code here
    public function getAll(){
        $this->commandPrepare("sp_anio_getAll");
        return $this->commandGetData();
    }
}
