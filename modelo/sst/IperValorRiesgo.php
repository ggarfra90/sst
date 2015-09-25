<?php

require_once __DIR__ . "/../core/ModeloBase.php";

class IperValorRiesgo extends ModeloBase {

   

    public function insertarIperValorRiesgo($codigo,$limInfe, $limSupe, $significancia, 
            $usuCreacion) {
        $this->commandPrepare("sp_iper_valor_riesgo_insertar");
        $this->commandAddParameter(":vin_par_val_rie_tipo_codigo", $codigo);
        $this->commandAddParameter(":vin_lim_inferior", $limInfe);
        $this->commandAddParameter(":vin_lim_superior", $limSupe);
        $this->commandAddParameter(":vin_significancia", $significancia);
        $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
        return $this->commandGetData();
    }

}
