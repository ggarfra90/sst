<?php

require_once __DIR__ . "/../core/ModeloBase.php";
require_once __DIR__ . "/../core/ConnectionMSSQL.php";

class Gerencia extends ModeloBase {

    public function obtenerGerenciaXempresa($empresaId) {
        $this->commandPrepare("sp_gerencia_obtenerXempresa");
        $this->commandAddParameter(":vin_empresa_id", $empresaId);
        return $this->commandGetData();
    }

    public function obtenerGerenciaXcodLegado($codLegado) {
        $this->commandPrepare("sp_gerencia_obtenerXcodLegado");
        $this->commandAddParameter(":vin_cod_legado", $codLegado);
        return $this->commandGetData();
    }

    public function obtenerGerenciaLegado() {
        $mssql = new ConnectionMSSQL();
        $rs = $mssql->ejecutar("exec sp_data_areas");
        $response = array();
        while (!$rs->EOF) {
            $val = new stdClass();
            $val->idgerencia = utf8_encode($rs->Fields->Item('idgrupotrabajo')->value);
            $val->descripcion = utf8_encode($rs->Fields->Item('descripcion')->value);
            array_push($response, $val);
            $rs->MoveNext();
        }
        $mssql->close();
        return $response;
    }

    public function insertarGerencia($empresaId, $gerenciaId, $codLegado, $descripcion, $estado, $usuCreacion) {
        $this->commandPrepare("sp_gerencia_insertar");
        $this->commandAddParameter(":vin_empresa_id", $empresaId);
        $this->commandAddParameter(":vin_gerencia_id", $gerenciaId);
        $this->commandAddParameter(":vin_cod_legado", $codLegado);
        $this->commandAddParameter(":vin_descripcion", $descripcion);
        $this->commandAddParameter(":vin_estado", $estado);
        $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
        return $this->commandGetData();
    }
}
