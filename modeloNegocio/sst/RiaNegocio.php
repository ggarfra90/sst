<?php

require_once __DIR__ . '/../../modelo/sst/Ria.php';
require_once __DIR__ . '/../../modeloNegocio/sst/DocumentoNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/sst/ParametroNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/sst/SucursalNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/sst/GerenciaNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/itec/UsuarioNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/sst/PuestoNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/commons/ConstantesNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/commons/SeguridadNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/core/ModeloNegocioBase.php';

class RiaNegocio extends ModeloNegocioBase {

    public function listarRiaProcedimiento() {
        return Ria::create()->listarRiaProcedimiento();
    }

    public function crearRiaProcedimiento($codigo, $version, $comentario, $docEncode, 
            $docNombre, $estado, $usuCreacion) {
        $doc = DocumentoNegocio::create()->crearDocumento(ConstantesNegocio::PAR_TIPODOC_RIAPROC, $docEncode,
                $docNombre, ConstantesNegocio::FILE_RIAPROC, ConstantesNegocio::ES_LISTA_MAESTRA, 
                ConstantesNegocio::FLUDOC_ENVIADO, $estado, $usuCreacion);
        return Ria::create()->insertarRiaProcedimiento($doc[0]["id"], $codigo, $version, $comentario, 
                $estado, $usuCreacion);
    }

    public function actualizarRiaProcedimiento($id, $codigo, $version, $comentario, $docEncode, 
                $docNombre, $docId, $estado, $usuCreacion) {
        if($docId == "" || $docId == null){
            $doc = DocumentoNegocio::create()->crearDocumento(ConstantesNegocio::PAR_TIPODOC_RIAPROC, $docEncode,
                $docNombre, ConstantesNegocio::FILE_RIAPROC, ConstantesNegocio::ES_LISTA_MAESTRA, 
                ConstantesNegocio::FLUDOC_ENVIADO, $estado, $usuCreacion);
            $docId = $doc[0]["id"];
        }
        return Ria::create()->actualizarRiaProcedimiento($id, $docId, $codigo, $version, 
                $comentario, ConstantesNegocio::FLUDOC_ENVIADO, $estado);
    }

    function cambiarEstadoProcedimiento($id, $estado){
        $tabla = ConstantesNegocio::TBL_RIAPROCEDIMIENTO;
        $campo = ConstantesNegocio::ESTADO;
        return SeguridadNegocio::create()->updateEstadoVisible($tabla, $campo, $estado, $id);
    }
    
    function obtenerRiaProcedimientoXid($id){
        return Ria::create()->obtenerRiaProcedimientoXid($id);
    }
    
    function cambiarPublicacion($documentoId, $estadoPublicacion){
        $publicado = ConstantesNegocio::FLUDOC_APROBADO;
        if($estadoPublicacion == ConstantesNegocio::PARAM_ACTIVO){
            $publicado = ConstantesNegocio::FLUDOC_PUBLICADO;
        }
        return DocumentoNegocio::create()->actualizarFlujo($documentoId, $publicado);
    }

    public function obtenerTipoEvento() {
        return ParametroNegocio::create()->obtenerParametroXparCodigo(ConstantesNegocio::PARCOD_TIPOEVENTO);
    }

    public function obtenerTipoParticipacion() {
        return ParametroNegocio::create()->obtenerParametroXparCodigo(ConstantesNegocio::PARCOD_TIPOPARTICIPACION);
    }
    
    public function crearRiaDeclaracion($eveFecha, $eveHora, $eveTipoId, $eveParticipacionId, $reuLugar, $reuFecha, 
            $reuHoraIni, $reuHoraFin, $decPregunta1, $decPregunta2, $decPregunta3, $decPregunta4, $decPregunta5, 
            $decPregunta6, $decPregunta7, $decPregunta8, $regDescripcion, $docEncode, $docNombre, $usuCreacion){
        $estado = ConstantesNegocio::PARAM_ACTIVO;
        $doc = DocumentoNegocio::create()->crearDocumento(ConstantesNegocio::PAR_TIPODOC_RIADECLARACION, $docEncode,
                $docNombre, ConstantesNegocio::FILE_RIADECLARACION, ConstantesNegocio::NO_LISTA_MAESTRA, 
                ConstantesNegocio::FLUDOC_APROBADO, $estado, $usuCreacion);
        if($doc[0]['vout_exito'] == ConstantesNegocio::VOUT_EXITO){
            $riaDeclaracion = $this->insertarRiaDeclaracion($doc[0]["id"], $eveFecha, $eveHora, $reuLugar, $reuFecha, 
                    $reuHoraIni, $reuHoraFin, $regDescripcion, ConstantesNegocio::NO_ARCHIVADO, $estado, $usuCreacion);
            if($riaDeclaracion[0]['vout_exito'] == ConstantesNegocio::VOUT_EXITO){
                $riaDecDetEve = $this->insertarRiaDecDetalle($riaDeclaracion[0]['id'], $eveTipoId, $estado, $usuCreacion);
                $riaDecDetPar = $this->insertarRiaDecDetalle($riaDeclaracion[0]['id'], $eveParticipacionId, $estado, $usuCreacion);
                $riaDecPreRpta = $this->insertarRiaDecPreRespuesta($riaDeclaracion[0]['id'], $decPregunta1, $decPregunta2,
                        $decPregunta3, $decPregunta4, $decPregunta5, $decPregunta6, $decPregunta7, $decPregunta8, $estado, $usuCreacion);
            }
            return $riaDeclaracion;
        }
        return $doc;
    }
    
    public function insertarRiaDeclaracion ($documentoId, $eveFecha, $eveHora, $reuLugar, $reuFecha, $reuHoraIni, 
            $reuHoraFin, $regDescripcion, $archivado, $estado, $usuCreacion){
        return Ria::create()->insertarRiaDeclaracion($documentoId, $eveFecha, $eveHora, $reuLugar, $reuFecha,
            $reuHoraIni, $reuHoraFin, $regDescripcion, $archivado, $estado, $usuCreacion);
    }
    
    public function insertarRiaDecDetalle ($riaDeclaracionId, $parDecDetId, $estado, $usuCreacion){
        return Ria::create()->insertarRiaDecDetalle ($riaDeclaracionId, $parDecDetId, $estado, $usuCreacion);
    }
    
    public function insertarRiaDecPreRespuesta ($riaDeclaracionId, $decPregunta1, $decPregunta2, $decPregunta3, 
            $decPregunta4, $decPregunta5, $decPregunta6, $decPregunta7, $decPregunta8, $estado, $usuCreacion){
        return Ria::create()->insertarRiaDecPreRespuesta ($riaDeclaracionId, $decPregunta1, $decPregunta2, $decPregunta3, 
            $decPregunta4, $decPregunta5, $decPregunta6, $decPregunta7, $decPregunta8, $estado, $usuCreacion);
    }

    public function listarRiaDeclaracion() {
        return Ria::create()->listarRiaDeclaracion();
    }

    function cambiarEstadoDeclaracion($id, $estado){
        $tabla = ConstantesNegocio::TBL_RIADECLARACION;
        $campo = ConstantesNegocio::ESTADO;
        return SeguridadNegocio::create()->updateEstadoVisible($tabla, $campo, $estado, $id);
    }
    
    public function obtenerRiaDeclaracionXid($id){
        return Ria::create()->obtenerRiaDeclaracionXid($id);
    }

    public function obtenerSucursalLegado() {
        return SucursalNegocio::create()->obtenerSucursalLegado();
    }

    public function obtenerGerenciaLegado() {
        return GerenciaNegocio::create()->obtenerGerenciaLegado();
    }

    public function obtenerTipoPerdida() {
        return ParametroNegocio::create()->obtenerParametroXparCodigo(ConstantesNegocio::PARCOD_TIPOPERDIDA);
    }

    public function obtenerColaboradorLegado() {
        return UsuarioNegocio::create()->obtenerUsuarioLegado();
    }

    public function obtenerPuestoXusuCodAd($usuarioCodAd) {
        return UsuarioNegocio::create()->obtenerPuestoXusuCodAd($usuarioCodAd);
    }

    public function crearRiaRie($eveFecha, $eveHora, $sucCodLegado, $sucDescripcion, $gerCodLegado,
            $gerDescripcion, $tipEventoId, $tipPerdidaId, $usuCodAd, $usuCodCargo, $usuDesCargo, 
            $descripcion, $respuesta, $comentario, $usuCreacion, $lstTestigoCodAd) {
        $estado = ConstantesNegocio::PARAM_ACTIVO;
        
        $suc = SucursalNegocio::create()->crearSucursal(ConstantesNegocio::EMPRESAID, $sucCodLegado, 
                $sucDescripcion, $estado, $usuCreacion);
        $ger = GerenciaNegocio::create()->crearGerencia(ConstantesNegocio::EMPRESAID, $gerCodLegado, 
                $gerDescripcion, $estado, $usuCreacion);
        $usu = UsuarioNegocio::create()->obtenerUsuarioId($usuCodAd);
        
        if(isset($suc) && isset($ger) && $usu[0]['vout_exito'] == ConstantesNegocio::VOUT_EXITO){
            $usuPues = PuestoNegocio::create()->crearObtenerUsuarioPuestoId($usu[0]['usuario_id'], $usuCodCargo, $usuDesCargo,
                $estado, $usuCreacion, $puestoPadreId = null);
            
            if(isset($usuPues)){
                $riaRie = $this->insertarRiaRie($suc[0]['id'], $ger[0]['id'], $usuPues[0]['id'], $eveFecha, $eveHora,
                    $descripcion, $respuesta, $comentario, ConstantesNegocio::NO_ARCHIVADO, $estado, $usuCreacion);
                
                if($riaRie[0]['vout_exito'] == ConstantesNegocio::VOUT_EXITO){
                    $tipEve = $this->insertarRiaRieDetalle($riaRie[0]['id'], $tipEventoId, $estado, $usuCreacion);
                    $tipPer = $this->insertarRiaRieDetalle($riaRie[0]['id'], $tipPerdidaId, $estado, $usuCreacion);

                    foreach ($lstTestigoCodAd as $tes) {
                        $testId = UsuarioNegocio::create()->obtenerUsuarioId($tes);
                        $r = $this->insertarRiaRieTestigo($riaRie[0]['id'], $testId[0]['usuario_id'], $estado, $usuCreacion);
                    }
                }
                return $riaRie;
            }
            return $usuPues;
        }
    }
    
    public function insertarRiaRie($sucursalId, $gerenciaId, $usuarioPuestoId, $eveFecha, $eveHora,
            $descripcion, $respuesta, $comentario, $archivado, $estado, $usuCreacion){
        return Ria::create()->insertarRiaRie($sucursalId, $gerenciaId, $usuarioPuestoId, $eveFecha, $eveHora,
            $descripcion, $respuesta, $comentario, $archivado, $estado, $usuCreacion);
    }
    
    public function insertarRiaRieDetalle($riaRieId, $parDetId, $estado, $usuCreacion){
        return Ria::create()->insertarRiaRieDetalle($riaRieId, $parDetId, $estado, $usuCreacion);
    }
    
    public function insertarRiaRieTestigo($riaRieId, $usuarioId, $estado, $usuCreacion){
        return Ria::create()->insertarRiaRieTestigo($riaRieId, $usuarioId, $estado, $usuCreacion);
    }

    public function listarRiaRie() {
        return Ria::create()->listarRiaRie();
    }

    function cambiarEstadoRie($id, $estado){
        $tabla = ConstantesNegocio::TBL_RIARIE;
        $campo = ConstantesNegocio::ESTADO;
        return SeguridadNegocio::create()->updateEstadoVisible($tabla, $campo, $estado, $id);
    }
    
    public function obtenerRiaRieXid($id){
        return Ria::create()->obtenerRiaRieXid($id);
    }
}
