<?php

require_once __DIR__ . "/../core/ModeloBase.php";
require_once __DIR__ . "/../core/ConnectionMSSQL.php";

class Sucursal extends ModeloBase {

    public function obtenerSucursalXempresa($empresaId) {
        $this->commandPrepare("sp_sucursal_obtenerXempresa");
        $this->commandAddParameter(":vin_empresa_id", $empresaId);
        return $this->commandGetData();
    }

    public function obtenerSucursalXcodLegado($codLegado) {
        $this->commandPrepare("sp_sucursal_obtenerXcodLegado");
        $this->commandAddParameter(":vin_cod_legado", $codLegado);
        return $this->commandGetData();
    }

    public function obtenerSucursalLegado() {
        $mssql = new ConnectionMSSQL();
        $rs = $mssql->ejecutar("exec sp_data_oficinas");
        $response = array();
        while (!$rs->EOF) {
            $val = new stdClass();
            $val->idsucursal = utf8_encode($rs->Fields->Item('idsucursal')->value);
            $val->descripcion = utf8_encode($rs->Fields->Item('descripcion')->value);
            array_push($response, $val);
            $rs->MoveNext();
        }
        $mssql->close();
        return $response;
    }

    public function insertarSucursal($empresaId, $codLegado, $descripcion, $estado, $usuCreacion) {
        $this->commandPrepare("sp_sucursal_insertar");
        $this->commandAddParameter(":vin_empresa_id", $empresaId);
        $this->commandAddParameter(":vin_cod_legado", $codLegado);
        $this->commandAddParameter(":vin_descripcion", $descripcion);
        $this->commandAddParameter(":vin_estado", $estado);
        $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
        return $this->commandGetData();
    }
}
