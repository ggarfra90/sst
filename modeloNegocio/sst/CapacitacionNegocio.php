<?php

require_once __DIR__ . '/../../modelo/sst/Capacitacion.php';
require_once __DIR__ . '/../../modelo/sst/CapDocumento.php';
require_once __DIR__ . '/../../modelo/sst/Parametro.php';
require_once __DIR__ . '/../../modelo/sst/CapacitacionAlumno.php';
require_once __DIR__ . '/../../modeloNegocio/sst/DocumentoNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/sst/CapacitacionNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/commons/ConstantesNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/commons/SeguridadNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/core/ModeloNegocioBase.php';

class CapacitacionNegocio extends ModeloNegocioBase {

    public function listarCapacitacion($tipo) {
        
        return Capacitacion::create()->listarCapacitacion($tipo);
    }
    public function listarVerCapacitacion($tipo,$usuId) {
        
        return Capacitacion::create()->listarVerCapacitacion($tipo,$usuId);
    }
    public function obtenerCapacitacion($id){
        return Capacitacion::create()->obtenerCapacitacionXId($id);
    }
    public function obtenerEvidencia($id){
        return Capacitacion::create()->obtenerEvidenciaCapacitacionXId($id);
    }
    public function obtenerCapacitacionAlumno($capaId) {
        $data=CapacitacionAlumno::create()->obtnerCapacitacionAlumno($capaId);
        $cantidad=  count($data);
        for ($i = 0; $i < count($data); $i++) {
        $data[$i]['total']=$cantidad;
        if(is_null($data[$i]['nom_completo']))
        {
            $data[$i]['total']=0;
        }
        }
        return $data;
    }
    public function crearCapacitacion($tema,$fconvocatoria,$finicio,$ffin,$tipo,$estado,$comentario, $docEncode, 
            $docNombre, $usuCreacion){
        $doc = DocumentoNegocio::create()->crearDocumento(ConstantesNegocio::PAR_TIPODOC_CAPACITACION, $docEncode,
                $docNombre, ConstantesNegocio::FILE_CAPACITACION, ConstantesNegocio::NO_LISTA_MAESTRA, 
                ConstantesNegocio::FLUDOC_APROBADO, ConstantesNegocio::PARAM_ACTIVO, $usuCreacion);
        
        $cap=Capacitacion::create()->insertarCapacitacion($tema,$tipo,$fconvocatoria,$finicio,$ffin,$estado,$comentario,$usuCreacion);
        
        return CapDocumento::create()->insertarCapDocumento($cap[0]['id'],$doc[0]["id"],$usuCreacion);
            }
             public function actualizarCapacitacion($id,$tema,$fconvocatoria,$finicio,$ffin,$tipo,$estado,$comentario, $docEncode, 
            $docNombre,$docId,$docId_a,$idCap, $usuCreacion) {
        if($docId == "" || $docId == null){
            
            $doc = DocumentoNegocio::create()->crearDocumento(ConstantesNegocio::PAR_TIPODOC_CAPACITACION, $docEncode,
                $docNombre, ConstantesNegocio::FILE_CAPACITACION, ConstantesNegocio::NO_LISTA_MAESTRA, 
                ConstantesNegocio::FLUDOC_APROBADO, ConstantesNegocio::PARAM_ACTIVO, $usuCreacion);
            $docId = $doc[0]["id"];
        }
                $cap=Capacitacion::create()->actualizarCapacitacion($id,$tema,$tipo,$fconvocatoria,$finicio,$ffin,$estado,$comentario,$docId,$docId_a,$idCap,$usuCreacion);
         
         if($cap[0]['vout_exito_documento']=='1'){       
        $doc_cap=CapDocumento::create()->insertarCapDocumento($id,$docId,$usuCreacion);
         $cap[1]['vout_mensaje']='Documento actualizado';
         }
         
                return $cap;
    }
    
    public function crearEvidencia($capId,$comentario,$docEncode,$docNombre,$nDocumento,$usuCreacion) {
        $doc = DocumentoNegocio::create()->crearEvidenciaDocumento(ConstantesNegocio::PAR_TIPODOC_CAPA_EVIDENCIA, $docEncode,
                $docNombre,$nDocumento,ConstantesNegocio::FILE_CAPA_EVIDENCIA,ConstantesNegocio::NO_LISTA_MAESTRA, 
                ConstantesNegocio::FLUDOC_APROBADO,ConstantesNegocio::PARAM_ACTIVO, $usuCreacion, $comentario);
            $docId = $doc[0]["id"];
             $doc_cap=CapDocumento::create()->insertarCapDocumento($capId,$docId,$usuCreacion);
             return $doc_cap;
    }
    public function eliminarEvidencia($idDoc,$idCap) {
        return Capacitacion::create()->eliminarEvidencia($idDoc,$idCap) ;
    }
    public function cambiarEstado($id, $estado){
        if($estado==ConstantesNegocio::PARAM_ACTIVO){
            $estadof=ConstantesNegocio::PARAM_NO_ACTIVO;
        }
        if($estado==ConstantesNegocio::PARAM_NO_ACTIVO){
            $estadof=ConstantesNegocio::PARAM_ACTIVO;
        }
        $tabla = ConstantesNegocio::TBL_CAPACITACION;
        $campo = ConstantesNegocio::ESTADO;
        return SeguridadNegocio::create()->updateEstadoVisible($tabla, $campo, $estadof, $id);
    }
     public function inscribirseCapa($id,$usu,$usuCreacion){
     
     $nota=null;
         return CapacitacionAlumno::create()->insertarCapacitacionAlumno($id,$usu,$nota,$usuCreacion);
        
    }
    public function obtenerTipoCapacitacion() {
        $parametroCodigo=  ConstantesNegocio::PAR_TIPO_CAPACITACION;
        return Parametro::create()->obtenerParametroXparCodigo($parametroCodigo);
    
    }

}
