<?php

require_once __DIR__ . "/../core/ModeloBase.php";

class Puesto extends ModeloBase {

    public function obtenerPuestoLegado() {
        $mssql = new ConnectionMSSQL();
        $rs = $mssql->ejecutar("exec sp_data_puestos");
        $response = array();
        while (!$rs->EOF) {
            $val = new stdClass();
            $val->idcargo = utf8_encode($rs->Fields->Item('idcargo')->value);
            $val->descripcion = utf8_encode($rs->Fields->Item('descripcion')->value);
            array_push($response, $val);
            $rs->MoveNext();
        }
        $mssql->close();
        return $response;
    }

    public function obtenerPuestoXcodLegado($codLegado) {
        $this->commandPrepare("sp_puesto_obtenerXcodLegado");
        $this->commandAddParameter(":vin_cod_legado", $codLegado);
        return $this->commandGetData();
    }

    public function insertarPuesto($puestoPadreId, $codLegado, $descripcion, $estado, $usuCreacion) {
        $this->commandPrepare("sp_puesto_insertar");
        $this->commandAddParameter(":vin_puesto_padre_id", $puestoPadreId);
        $this->commandAddParameter(":vin_cod_legado", $codLegado);
        $this->commandAddParameter(":vin_descripcion", $descripcion);
        $this->commandAddParameter(":vin_estado", $estado);
        $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
        return $this->commandGetData();
    }

    public function obtenerUsuarioPuestoId($puestoId, $usuarioId) {
        $this->commandPrepare("sp_usuariopuesto_obtener");
        $this->commandAddParameter(":vin_puesto_id", $puestoId);
        $this->commandAddParameter(":vin_usuario_id", $usuarioId);
        return $this->commandGetData();
    }

    public function insertarUsuarioPuesto($puestoId, $usuarioId, $estado, $usuCreacion) {
        $this->commandPrepare("sp_usuariopuesto_insertar");
        $this->commandAddParameter(":vin_puesto_id", $puestoId);
        $this->commandAddParameter(":vin_usuario_id", $usuarioId);
        $this->commandAddParameter(":vin_estado", $estado);
        $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
        return $this->commandGetData();
    }
}
