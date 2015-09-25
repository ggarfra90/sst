<?php

require_once __DIR__ . '/../../modelo/sst/Comite.php';
require_once __DIR__ . '/../../modelo/sst/ComiteSstConvoca.php';
require_once __DIR__ . '/../../modelo/sst/ComiteSstMiembro.php';
require_once __DIR__ . '/../../modeloNegocio/itec/UsuarioNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/sst/DocumentoNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/commons/ConstantesNegocio.php';
//require_once __DIR__ . '/../../modeloNegocio/commons/SeguridadNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/core/ModeloNegocioBase.php';

class ComiteNegocio extends ModeloNegocioBase {

    public function listarDocsXrevisar() {

        return DocumentoNegocio::create()->listarDocsXrevisar(ConstantesNegocio::FLUDOC_ENVIADO);
    }

    public function aprobarDocumento($documentoId) {
        return DocumentoNegocio::create()->actualizarFlujo($documentoId, ConstantesNegocio::FLUDOC_APROBADO);
    }

    public function rechazarDocumento($documentoId, $motivoRechazo) {
        return DocumentoNegocio::create()->actualizarFlujo($documentoId, ConstantesNegocio::FLUDOC_RECHAZADO, $motivoRechazo);
    }

    public function listarComite() {
       
        session_start();
        unset($_SESSION['grid']);
        $c = 0;
        $nombre = "";
        $array = Comite::create()->listarComite();
        $m=1;
        for ($i = 0; $i < count($array); $i++) {
            $puntos="";
            if ($array[$i]['id'] == $array[$i + 1]['id'] || $array[$i]['id'] == $array[$i - 1]['id'] && $m<5) {
               
                $nombre = $array[$i]['nom_completo'] . '<br>' . $nombre.$puntos;
                $id = $array[$i]['id'];
            }
            if ($array[$i]['id'] != $array[$i + 1]['id'] && $nombre != "" ) {
               
                $arrayf[$c] = array('id' => $id, 'nombreMiembro' => $nombre);
                $c++;
                $nombre = "";
                $id = "";
            }
        }

        $array_sr = ComiteNegocio::unique_multidim_array($array, 'id');
        $array_sr = array_values($array_sr);
        for ($i = 0; $i < count($array_sr); $i++) {
            for ($j = 0; $j < count($arrayf); $j++) {
                if ($arrayf[$j]['id'] == $array_sr[$i]['id']) {
                    $array_sr[$i]['miembros'] = $arrayf[$j]['nombreMiembro'];
                }
            }
        }

        return $array_sr;
    }

    public function unique_multidim_array($array, $key) {
        $temp_array = array();
        $i = 0;
        $key_array = array();

        foreach ($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }

    public function obtenerComiteColaborador() {
        return UsuarioNegocio::create()->obtenerUsuarioLegado();
    }

    public function obtenerComiteCargo() {
        return Comite::create()->obtenerComiteCargo();
    }

    public function crearMiembrosDoc($docEncodeEleccion, $docEleccionNombre, $usuCreacion, $comiteSstId) {
        session_start();
        $doc = DocumentoNegocio::create()->crearDocumento(ConstantesNegocio::PAR_TIPODOC_COMITESST_ELECCION, $docEncodeEleccion, $docEleccionNombre, ConstantesNegocio::FILE_COMITESST_ELECCION, ConstantesNegocio::NO_LISTA_MAESTRA, ConstantesNegocio::FLUDOC_ENVIADO, ConstantesNegocio::PARAM_ACTIVO, $usuCreacion);
        $documentoId = $doc[0]["id"];
        $responseDoc = ComiteSstMiembro::create()->insertarComiteSstMiembro($comiteSstId, $documentoId, "", "", $usuCreacion, ConstantesNegocio::PARAM_ACTIVO);
        $array = $_SESSION['grid'];
        for ($i = 0; $i < count($array); $i++) {
            $usuarioCodAd = $array[$i]['usuario'];
            $usuario = UsuarioNegocio::create()->obtenerUsuarioId($usuarioCodAd);
            $usuarioId = $usuario[0]['usuario_id'];
            $miembroCarId = $array[$i]['cargo'];

            $responseMiem = ComiteSstMiembro::create()->insertarComiteSstMiembro($comiteSstId, $documentoId, $usuarioId, $miembroCarId, $usuCreacion, ConstantesNegocio::PARAM_NO_ACTIVO);
        }
        if (count($array) == intval(ConstantesNegocio::PARAM_NO_ACTIVO)) {
            return $responseDoc;
        } else {
            if ($responseMiem[0]['vout_exito'] == ConstantesNegocio::VOUT_EXITO && $responseDoc[0]['vout_exito'] == ConstantesNegocio::VOUT_EXITO) {
                $response[0]['vout_exito'] = ConstantesNegocio::VOUT_EXITO;
                $response[0]['vout_mensaje'] = $responseMiem[0]['vout_mensaje'] . "," . $responseDoc[0]['vout_mensaje'];
                return $response;
            } else {
                $response[0]['vout_exito'] = ConstantesNegocio::VOUT_ERROR;
                $response[0]['vout_mensaje'] = $responseMiem[0]['vout_mensaje'] . "," . $responseDoc[0]['vout_mensaje'];
                return $response;
            }
        }
    }
     public function actualizarMiembrosDoc( $usuCreacion,$docIdEleccion, $docEncodeEleccion, $docEleccionNombre,$comiteSstId,$bandera) {
        session_start();
        
        //crea un nuevo documento
        if(($docIdEleccion == "" || $docIdEleccion == null)&& ( $bandera==null || $bandera=="")){
            $doc = DocumentoNegocio::create()->crearDocumento(ConstantesNegocio::PAR_TIPODOC_COMITESST_ELECCION, $docEncodeEleccion,
                $docEleccionNombre, ConstantesNegocio::FILE_COMITESST_ELECCION, ConstantesNegocio::NO_LISTA_MAESTRA,
                ConstantesNegocio::FLUDOC_ENVIADO, ConstantesNegocio::PARAM_ACTIVO, $usuCreacion);
                $documentoId = $doc[0]["id"];
                        $responseDoc = ComiteSstMiembro::create()->insertarComiteSstMiembro($comiteSstId, $documentoId, "", "", $usuCreacion, ConstantesNegocio::PARAM_ACTIVO);
                
        }
        //actualizar
        if(($docIdEleccion == "" || $docIdEleccion == null)&& ( $bandera!=""|| $bandera!=null)){
             $doc = DocumentoNegocio::create()->crearDocumento(ConstantesNegocio::PAR_TIPODOC_COMITESST_ELECCION, $docEncodeEleccion,
                $docEleccionNombre, ConstantesNegocio::FILE_COMITESST_ELECCION, ConstantesNegocio::NO_LISTA_MAESTRA,
                ConstantesNegocio::FLUDOC_ENVIADO, ConstantesNegocio::PARAM_ACTIVO, $usuCreacion);
                $documentoId = $doc[0]["id"];
                        $responseAct = ComiteSstMiembro::create()->actualizarComiteSstMiembro($comiteSstId, $documentoId);
                        if($responseAct[0]['vout_exito']==ConstantesNegocio::VOUT_EXITO){
                        $responseDoc = ComiteSstMiembro::create()->insertarComiteSstMiembro($comiteSstId, $documentoId, "", "", $usuCreacion, ConstantesNegocio::PARAM_ACTIVO);
                        }
        }
        // mantener
        if(($docIdEleccion != "" || $docIdEleccion != null)&& ($bandera!=""|| $bandera!=null)){
                 $responseDoc = ComiteSstMiembro::create()->insertarComiteSstMiembro($comiteSstId, $docIdEleccion, "", "", $usuCreacion, ConstantesNegocio::PARAM_ACTIVO);
             
        }
                 
        $array = $_SESSION['grid'];
        for ($i = 0; $i < count($array); $i++) {
            $usuarioCodAd = $array[$i]['usuario'];
            $usuario = UsuarioNegocio::create()->obtenerUsuarioId($usuarioCodAd);
            $usuarioId = $usuario[0]['usuario_id'];
            $miembroCarId = $array[$i]['cargo'];

            $responseMiem = ComiteSstMiembro::create()->insertarComiteSstMiembro($comiteSstId, $documentoId, $usuarioId, $miembroCarId, $usuCreacion, ConstantesNegocio::PARAM_NO_ACTIVO);
        }
        if (count($array) == intval(ConstantesNegocio::PARAM_NO_ACTIVO)) {
            return $responseDoc;
        } else {
            if ($responseMiem[0]['vout_exito'] == ConstantesNegocio::VOUT_EXITO && $responseDoc[0]['vout_exito'] == ConstantesNegocio::VOUT_EXITO) {
                $response[0]['vout_exito'] = ConstantesNegocio::VOUT_EXITO;
                $response[0]['vout_mensaje'] = $responseMiem[0]['vout_mensaje'] . "," . $responseDoc[0]['vout_mensaje'];
                return $response;
            } else {
                $response[0]['vout_exito'] = ConstantesNegocio::VOUT_ERROR;
                $response[0]['vout_mensaje'] = $responseMiem[0]['vout_mensaje'] . "," . $responseDoc[0]['vout_mensaje'];
                return $response;
            }
        }
    }
    public function crearComite($fecEleccion, $fecInicio, $fecFin, $docEncode, $docConvocatoriaNombre, $fecConvotarioa, $comentario, $usuCreacion, $docEncodeEleccion, $docEleccionNombre) {

        $doc = DocumentoNegocio::create()->crearDocumento(ConstantesNegocio::PAR_TIPODOC_COMITESST_CONVOCATORIA, $docEncode, $docConvocatoriaNombre, ConstantesNegocio::FILE_COMITESST_CONVOCATORIA, ConstantesNegocio::NO_LISTA_MAESTRA, ConstantesNegocio::FLUDOC_ENVIADO, ConstantesNegocio::PARAM_ACTIVO, $usuCreacion);
        $documentoId = $doc[0]["id"];
        $fecha = str_replace('-', '', $fecInicio);
        $codigo = substr($fecha, 0, 6);
        $tblComite = Comite::create()->insertarComite($codigo, $fecEleccion, $fecInicio, $fecFin, $usuCreacion);
        $comiteSstId = $tblComite[0]["id_comitesst"];
        if($comiteSstId!=null || $comiteSstId!=""){
        $tblConvocatoria = ComiteSstConvoca::create()->insertarComiteSstConvoca($documentoId, $comiteSstId, $fecConvotarioa, $comentario, $usuCreacion);
        }else{
            $tblComite[0]['vout_exito'] = ConstantesNegocio::VOUT_ERROR;
        }
        if($docEncodeEleccion!="" && $docEleccionNombre!=""){
        $tblMiembro = ComiteNegocio::crearMiembrosDoc($docEncodeEleccion, $docEleccionNombre, $usuCreacion, $comiteSstId);
        }else{
            $tblMiembro[0]['vout_exito']=  ConstantesNegocio::VOUT_EXITO;
        }
        if ($tblComite[0]['vout_exito'] == ConstantesNegocio::VOUT_ERROR) {
            return $tblComite;
        }
        if ($tblConvocatoria[0]['vout_exito'] == ConstantesNegocio::VOUT_ERROR) {
            return $tblConvocatoria;
        }
        if ($tblMiembro[0]['vout_exito'] == ConstantesNegocio::VOUT_ERROR) {
            return $tblMiembro;
        }
        if ($tblComite[0]['vout_exito'] == ConstantesNegocio::VOUT_EXITO && $tblConvocatoria[0]['vout_exito'] == ConstantesNegocio::VOUT_EXITO &&
                $tblMiembro[0]['vout_exito'] == ConstantesNegocio::VOUT_EXITO) {
            $response[0]['vout_exito'] = ConstantesNegocio::VOUT_EXITO;
            $response[0]['vout_mensaje'] = $tblComite[0]['vout_mensaje'] . ' ' . $tblConvocatoria[0]['vout_mensaje'] . ' ' . $tblMiembro[0]['vout_mensaje'];
            return $response;
        }
    }
    
public function actualizarComite($idComite,$IdConv,$fecEleccion, $fecInicio, $fecFin,$docIdConvocatoria,$docEncodeConvocatoria, $docConvocatoriaNombre, 
        $fecConvotarioa, $comentario, $usuCreacion,$docIdEleccion, $docEncodeEleccion, $docEleccionNombre,$bandera) {
        $docIdC=$docIdConvocatoria;
        if($docIdConvocatoria == "" || $docIdConvocatoria == null){
            $doc = DocumentoNegocio::create()->crearDocumento(ConstantesNegocio::PAR_TIPODOC_COMITESST_CONVOCATORIA, $docEncodeConvocatoria,
                $docConvocatoriaNombre, ConstantesNegocio::FILE_COMITESST_CONVOCATORIA, ConstantesNegocio::NO_LISTA_MAESTRA,
                ConstantesNegocio::FLUDOC_ENVIADO, ConstantesNegocio::PARAM_ACTIVO, $usuCreacion);
            $docIdC = $doc[0]["id"];
        }
        $fecha = str_replace('-', '', $fecInicio);
        $codigo = substr($fecha, 0, 6);
        $tblComite = Comite::create()->actualizarComite($idComite,$codigo, $fecEleccion, $fecInicio, $fecFin, $usuCreacion);
        
        $tblConvocatoria = ComiteSstConvoca::create()->actualizarComiteSstConvoca($IdConv,$docIdC, $idComite, $fecConvotarioa, $comentario, $usuCreacion);
             

        $tblMiembro = ComiteNegocio::actualizarMiembrosDoc($usuCreacion,$docIdEleccion, $docEncodeEleccion, $docEleccionNombre,$idComite,$bandera);
        if ($tblComite[0]['vout_exito'] == ConstantesNegocio::VOUT_ERROR) {
            return $tblComite;
        }
        if ($tblConvocatoria[0]['vout_exito'] == ConstantesNegocio::VOUT_ERROR) {
            return $tblConvocatoria;
        }
        if ($tblMiembro[0]['vout_exito'] == ConstantesNegocio::VOUT_ERROR) {
            return $tblMiembro;
        }
        if ($tblComite[0]['vout_exito'] == ConstantesNegocio::VOUT_EXITO && $tblConvocatoria[0]['vout_exito'] == ConstantesNegocio::VOUT_EXITO &&
                $tblMiembro[0]['vout_exito'] == ConstantesNegocio::VOUT_EXITO) {
            $response[0]['vout_exito'] = ConstantesNegocio::VOUT_EXITO;
            $response[0]['vout_mensaje'] = $tblComite[0]['vout_mensaje'] . ' ' . $tblConvocatoria[0]['vout_mensaje'] . ' ' . $tblMiembro[0]['vout_mensaje'];
            return $response;
        }
    }
    public function crearGrid($usuarioId, $cargoId, $i) {
        $i = 0;
        $array = array();
        session_start();
        if (isset($_SESSION['grid'])) {
            $array = $_SESSION['grid'];
            for ($i = 0; $i < count($array); $i++) {
                if ($array[$i]['usuario'] == $usuarioId) {
                    $array[0]['vout_exito'] = ConstantesNegocio::VOUT_ERROR;
                    $array[0]['vout_mensaje'] = "El colaborador " . $usuarioId . " ya tiene asignado un cargo.";
                    return $array;
                }
                if ($array[$i]['cargo'] == $cargoId && $cargoId == ConstantesNegocio::PARAM_ACTIVO) {
                    $array[0]['vout_exito'] = ConstantesNegocio::VOUT_ERROR;
                    $array[0]['vout_mensaje'] = "El cargo Presidente ya tiene asignado un colaborador.";
                    return $array;
                }
            }
            if (count($array) > 0) {
                $i = count($array);
            }
        } else {
            $i = 0;
        }

        $array[$i] = array('usuario' => $usuarioId, 'cargo' => $cargoId, 'id' => $i);
        $array[0]['vout_exito'] = ConstantesNegocio::VOUT_EXITO;
        $_SESSION['grid'] = $array;

        $arreglo = $_SESSION['grid'];

        return $arreglo;
    }

    public function eliminarGrid($id) {
        session_start();
        $array = $_SESSION['grid'];
        unset($array[$id]);

        $array = array_values($array);
        if (count($array) > 0) {
            $_SESSION['grid'] = $array;
        } else {
            $_SESSION['grid'] = null;
        }
        $arreglo = $_SESSION['grid'];
        return $arreglo;
    }

    
    function cambiarEstado($id, $estado) {
        $tabla = ConstantesNegocio::TBL_COMITESST;
        $campo = ConstantesNegocio::ESTADO;
        return SeguridadNegocio::create()->updateEstadoVisible($tabla, $campo, intval($estado), $id);
    }

    function obtenerComiteXid($id){
        return Comite::create()->obtenerComiteXid($id);
    }
    
    function obtenerMiembroXid($id){
       return Comite::create()->obtenerMiembroXId($id);
    }
    public function obtenerOrganigrama() {
        $array=Comite::create()->obtenerOrganigrama();
        for ($i = 0; $i < count($array); $i++) {
            if($array[$i]['cargo']=='1'){
                $array[$i]['cargoN']='Presidente';
            }
            if($array[$i]['cargo']=='2'){
                $array[$i]['cargoN']='Secretario';
            }
            if($array[$i]['cargo']=='3'){
                $array[$i]['cargoN']='Vocal';
            }
            
            
        }
        return $array;
    }
}
