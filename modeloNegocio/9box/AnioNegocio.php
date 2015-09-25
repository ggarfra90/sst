<?php

require_once __DIR__ . '/../../modelo/9box/Anio.php';
require_once __DIR__ . '/../../modeloNegocio/core/ModeloNegocioBase.php';

class AnioNegocio extends ModeloNegocioBase{
    //put your code here
    public function getAll(){
        return Anio::create()->getAll();
    }
}
