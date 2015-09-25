<?php

require_once __DIR__ . "/../core/ModeloBase.php";

class Documento extends ModeloBase {

    public function insertarDocumento($tipo, $nombre, $extension, $url, $comentario, 
            $esListaMaestra, $flujo, $estado, $usuCreacion) {
        $this->commandPrepare("sp_documento_insertar");
        $this->commandAddParameter(":vin_tipo_documento", $tipo);
        $this->commandAddParameter(":vin_nombre", $nombre);
        $this->commandAddParameter(":vin_extension", $extension);
        $this->commandAddParameter(":vin_url", $url);
        $this->commandAddParameter(":vin_comentario", $comentario);
        $this->commandAddParameter(":vin_lis_maestra", $esListaMaestra);
        $this->commandAddParameter(":vin_flu_documento", $flujo);
        $this->commandAddParameter(":vin_estado", $estado);
        $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
        return $this->commandGetData();
    }

    public function listarDocsXrevisar($flujo) {
        $this->commandPrepare("sp_documento_listar_docsXrevisar");
        $this->commandAddParameter(":vin_flu_documento", $flujo);
        return $this->commandGetData();
    }

    public function actualizarFlujo($id, $flujo, $comentario) {
        $this->commandPrepare("sp_documento_actualizar_flujo");
        $this->commandAddParameter(":vin_documento_id", $id);
        $this->commandAddParameter(":vin_flu_documento", $flujo);
        $this->commandAddParameter(":vin_comentario", $comentario);
        return $this->commandGetData();
    }
}
