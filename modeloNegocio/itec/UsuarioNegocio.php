<?php

require_once __DIR__ . '/../../modelo/itec/Usuario.php';
require_once __DIR__ . '/../../modeloNegocio/sst/ParametroNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/core/ModeloNegocioBase.php';
require_once __DIR__ . '/../../modeloNegocio/commons/ConstantesNegocio.php';

class UsuarioNegocio extends ModeloNegocioBase {

    public function obtenerUsuarioId($usuarioCodAd){
        $response = Usuario::create()->obtenerUsuarioId($usuarioCodAd);
        if ($response[0]['vout_exito'] == ConstantesNegocio::VOUT_ERROR) {
            $usuario = $this->obtenerUsuarioLegadoXcodAd($usuarioCodAd);
            if($usuario[0]->per_nom_completo != null){
                $tipoDoc = ParametroNegocio::create()->obtenerParametroLegadoId(ConstantesNegocio::PAR_TIPODNIID, 
                        $usuario[0]->dni_cod_legado, $usuario[0]->dni_abreviatura, $usuario[0]->dni_descripcion,
                        ConstantesNegocio::PARAM_ACTIVO, ConstantesNegocio::USUARIOSISTEMAID);
                $response = $this->insertarUsuario($usuarioCodAd, $tipoDoc[0]['id'], 
                        $usuario[0]->per_nom_completo, $usuario[0]->per_nro_documento,
                        $usuario[0]->per_fec_nacimiento, $usuario[0]->per_sexo);
            }
        }
        return $response;
    }

    public function obtenerUsuarioLegadoXcodAd($usuarioCodAd) {
        return Usuario::create()->obtenerUsuarioLegadoXcodAd($usuarioCodAd);
    }

    public function insertarUsuario($usuarioCodAd, $tipoDocumento, $nomCompleto, 
            $nroDocumento, $fecNacimiento, $sexo) {
        return Usuario::create()->insertarUsuario($usuarioCodAd, $tipoDocumento, 
                $nomCompleto, $nroDocumento, $fecNacimiento, $sexo);
    }

    public function listarMenuPadre($perfilId) {
        return Usuario::create()->listarMenuPadre($perfilId);
    }

    public function listarMenuHijo($perfilId, $opcionId) {
        return Usuario::create()->listarMenuHijo($perfilId, $opcionId);
    }

    public function obtenerUsuarioLegado() {
        return Usuario::create()->obtenerUsuarioLegado();
    }

    public function obtenerPuestoXusuCodAd($usuarioCodAd) {
        return Usuario::create()->obtenerPuestoXusuCodAd($usuarioCodAd);
    }
}
