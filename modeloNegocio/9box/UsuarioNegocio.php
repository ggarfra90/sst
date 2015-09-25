<?php

require_once __DIR__ . '/../../modelo/itec/Usuario.php';
require_once __DIR__ . '/../../modelo/9box/UsuarioPerfil.php';
require_once __DIR__ . '/../../modeloNegocio/core/ModeloNegocioBase.php';

class UsuarioNegocio extends ModeloNegocioBase {

    public function getAll($usuarioId) {
        return Usuario::create()->getAll($usuarioId);
    }

    public function getAllHijos($usuarioId) {
        return Usuario::create()->getAllHijos($usuarioId);
    }

    public function getAllRecursos() {
        return Usuario::create()->getAllRecursos();
    }

    public function save($usuarioCodAd, $jefeCodAd, $gerenteCodAd, $perfiles, $estado, $usuarioCreacion) {
        $responseUsuario = Usuario::create()->save($usuarioCodAd, $jefeCodAd, $gerenteCodAd, $estado, $usuarioCreacion);
        if ($responseUsuario[0]['vout_estado'] == 1) {
            $usuarioId = $responseUsuario[0]['id_usuario'];

            UsuarioPerfil::create()->delete($usuarioId, $estado = 0);

            foreach ($perfiles as $perfilId) {
                UsuarioPerfil::create()->save($usuarioId, $perfilId, $estado = 1);
            }

            return $responseUsuario;
//            $this->setMensajeEmergente($responseUsuario[0]['vout_mensaje'] );
        } else {
            throw new WarningException("Error al registrar usuario");
        }
    }

    public function delete($usuarioId) {
        $responseUsuario = Usuario::create()->delete($usuarioId);
        if ($responseUsuario[0]['vout_estado'] == 1) {

            $responseUsuarioPerfil = UsuarioPerfil::create()->delete($usuarioId, $estado = 2);

            if ($responseUsuarioPerfil[0]['vout_estado'] == 1) {
                
                return $responseUsuario;
            } else {
                throw new WarningException("Error al eliminar perfil usuario");
            }
        } else {
            throw new WarningException("Error al eliminar usuario");
        }
    }
    public function getAllRegistrador() {
        return Usuario::create()->getAllRegistrador($usuarioId);
    }

}
