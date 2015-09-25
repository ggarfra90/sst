<?php

require_once __DIR__ . '/../../modelo/9box/PRP.php';
require_once __DIR__ . '/../../modeloNegocio/core/ModeloNegocioBase.php';

class PRPNegocio extends ModeloNegocioBase {

    public function getAll($prpId, $usuarioId) {
        return PRP::create()->getAll($prpId, $usuarioId);
    }

    public function save($anioId, $usuarioId, $valor, $estado, $usuarioCreacion) {
        return PRP::create()->save($anioId, $usuarioId, $valor, $estado, $usuarioCreacion);
    }

    public function delete($usuarioId) {
        return PRP::create()->delete($usuarioId);
    }

    public function getAllAnios() {
        return PRP::create()->getAllAnios();
    }

    public function importPRP($xml,$usuarioCreacion) {
        $array = $this->importaPRPXML($xml, $usuarioCreacion);
        return $array;
    }

    private function importaPRPXML($xml, $usuarioCreacion) {
        $filasImportadas = 0;
        $row = 3;
        $errors = array();
        $dom = new DOMDocument;
        $xml = "<root>" . $xml . "</root>";
        $xml = str_replace("datos prp", "datos_prp", $xml);
        $xml = str_replace("año", "anio", $xml);
        $dom->loadXML($xml);
        $prp = simplexml_import_dom($dom);
        for ($i = 0; $i < count($prp); $i++) {
            $p = $prp->prp[$i];
            $anio = trim((string) $p->anio);
            $usuario = trim((string) $p->usuario);
            $valor = trim((string) $p->valor);
            $v_anio = $this->isValid($anio, "anio");
            $v_usuario = $this->isValid($usuario, "usuario");
            $v_valor = $this->isValid($valor, "valor");
            if (!($v_anio && $v_usuario && $v_valor)) {
                $cause = $v_anio ? "" : "Año erroneo \n";
                $cause .= $v_usuario ? "" : "Usuario erroneo \n";
                $cause .= $v_valor ? "" : "Valor erroneo \n";
                $errors[] = array("row" => $row, "cause" => $cause);
            }else{
                // si todo esta bien tratamos de insertar
                $response = PRP::create()->saveImporta($anio, $usuario, $valor, $usuarioCreacion);
                if ($response[0]["vout_estado"] == 0) {
                    $cause = $response[0]["vout_mensaje"];
                    $errors[] = array("row" => $row, "cause" => $cause);
                } else {
                    $filasImportadas ++;
                }
            }
            $row++;
        }
        if ($row == $filasImportadas +2){
            $this->setMensajeEmergente("Importacion finalizada. Se procesaron $filasImportadas de ".($row-2)." filas.");
        }
        
        return $errors;
    }

    public function isValid($value, $type) {
        $valid = true;
        switch ($type) {
            case "anio":
                if (strlen($value) != 4 || !is_numeric($value)) {
                    $valid = false;
                }
                break;
            case "usuario":
                if (strlen($value) == 0 || is_numeric($value)) {
                    $valid = false;
                }
                break;
            case "valor":
                if (strlen($value) != 1 || !is_numeric($value) || ($value < 1 || $value > 5)) {
                    $valid = false;
                }
                break;
        }
        return $valid;
    }

}
