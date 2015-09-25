<?php

require_once __DIR__ . '/../../modelo/sst/Comite.php';
require_once __DIR__ . '/../../modelo/sst/ComiteSstReunion.php';
require_once __DIR__ . '/../../modelo/sst/ComiteSstReuAgenda.php';
require_once __DIR__ . '/../../modelo/sst/ComiteSstReuAgeAcuerdo.php';
require_once __DIR__ . '/../../modeloNegocio/itec/UsuarioNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/sst/DocumentoNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/commons/ConstantesNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/core/ModeloNegocioBase.php';
require_once __DIR__ . '/../../modeloNegocio/sst/sstEnviarMail.php';
require_once __DIR__ . '/../../util/ConstantesMail.php';

class ComiteSstReunionNegocio extends ModeloNegocioBase {

    public function listarReunion() {
        session_start();
        unset($_SESSION['gridAgenda']);
        unset($_SESSION['gridElimina']);
        unset($_SESSION['gridAcuerdo']);
        unset($_SESSION['gridEliminaAcuerdo']);
        unset($_SESSION['gridAcuerdoPendiente']);
        unset($_SESSION['gridAcuerdoP']);
        return ComiteSstReunion::create()->listarComiteSstReunion();
    }

    public function insertarReunion($fecha, $hora, $ubicacion, $usuCreacion){
        $data = Comite::create()->obtenerComiteVigenteId();
        $comiteSst_id = $data[0]['comite_sst_id'];
        $tblReunion = ComiteSstReunion::create()->insertarComiteSstReunion($comiteSst_id, $fecha, $hora, $ubicacion, $usuCreacion);
        $comiteSstReunionId = $tblReunion[0]['comite_sst_reunion_id'];
        $tblReuTema = ComiteSstReunionNegocio::crearTemaAgenda($comiteSst_id, $comiteSstReunionId, $usuCreacion);
        
             $to = array();
             $cc='ggarcia@imaginatecperu.com';
	 //descomentar para enviar correo 
	$obtenerCorreosMiembros=  Comite::create()->obtenerMiembroXId($comiteSst_id);
        foreach ($obtenerCorreosMiembros as $value) {
            if(!is_null($value['email'])){
            array_push ($to,$value['email'] );
            }else{
                array_push ($to,$value['usu_cod_ad']."@netafim.com.pe" );
            }
        }
	
       $subject =  ConstantesMail::PARAM_SUBJECT ;
	$body = ConstantesMail::PARAM_BODY_FECHA.$fecha."\n".
                ConstantesMail::PARAM_BODY_HORA.$hora."\n".ConstantesMail::PARAM_BODY_TEMA_AGENDA."\n";
        
        $body.=$tblReuTema[0]['vout_temaAgenda'];
         sstEnviarMail::create()->enviarCorreo($to, $cc, $subject, $body);
        return $tblReuTema;
    }

    public function actualizarReunion($comiteSstReuId, $comiteSst_id, $fecha, $hora, $ubicacion, $usuCreacion) {
        $tblReunion = ComiteSstReunion::create()->actualizarComiteSstReunion($comiteSstReuId, $comiteSst_id, $fecha, $hora, $ubicacion, $usuCreacion);
        if ($tblReunion[0]['vout_exito'] == ConstantesNegocio::VOUT_EXITO) {
            $tblReuTema = ComiteSstReunionNegocio::actualizarTemaAgenda($comiteSst_id, $comiteSstReuId, $usuCreacion);
            }
        if ($tblReunion[0]['vout_exito'] == ConstantesNegocio::VOUT_EXITO && $tblReuTema[0]['vout_exito'] == ConstantesNegocio::VOUT_EXITO) {
            $tblReuAcu = ComiteSstReunionNegocio::crearAgendaAcuerdo($comiteSst_id, $comiteSstReuId, $usuCreacion);
            //return $tblReuAcu;
        }
        if(isset($_SESSION['gridAcuerdoPendiente'])){
            $array = $_SESSION['gridAcuerdoPendiente'];
        for ($i = 0; $i < count($array); $i++) {
            $comiteSstReuAcuId = $array[$i]['IdAcuerdo'];
            $docEncode=$array[$i]['docEnconde'];
            $docNombre=$array[$i]['docNombre'];
            $doc = DocumentoNegocio::create()->crearDocumento(ConstantesNegocio::PAR_TIPODOC_COMITESST_REU_ACU_CIERRE, $docEncode,
                $docNombre, ConstantesNegocio::FILE_COMITESST_REUNION_CIERRE, ConstantesNegocio::NO_LISTA_MAESTRA,
                ConstantesNegocio::FLUDOC_ENVIADO, ConstantesNegocio::PARAM_ACTIVO, $usuCreacion);
                $documentoId = $doc[0]["id"];
            $evidencia = $array[$i]['evidencia'];

            $tblAcuerdoCerrado= ComiteSstReuAgeAcuerdo::create()->cumplirComiteSstReuAgeAcuerdo($comiteSstReuAcuId,$documentoId,$evidencia,$usuCreacion);
        }
        return $tblAcuerdoCerrado;
        }
        $to = array();
             $cc='ggarcia@imaginatecperu.com';
	 //descomentar para enviar correo 
	$obtenerCorreosMiembros=  Comite::create()->obtenerMiembroXId($comiteSst_id);
        foreach ($obtenerCorreosMiembros as $value) {
            if(!is_null($value['email'])){
            array_push ($to,$value['email'] );
            }else{
                array_push ($to,$value['usu_cod_ad']."@netafim.com.pe" );
            }
        }
	
       $subject =  ConstantesMail::PARAM_SUBJECT." Actualizada" ;
	$body = ConstantesMail::PARAM_BODY_FECHA.$fecha."\n".
                ConstantesMail::PARAM_BODY_HORA.$hora."\n".ConstantesMail::PARAM_BODY_TEMA_AGENDA."\n";
        
        $body.=$tblReuTema[0]['vout_temaAgenda'];
         sstEnviarMail::create()->enviarCorreo($to, $cc, $subject, $body);
        return $tblReunion;
    }

    public function crearTemaAgenda($comiteSst_id, $comiteSstReunionId, $usuCreacion) {
        session_start();
        $temaC="";
        $array = $_SESSION['gridAgenda'];
        for ($i = 0; $i < count($array); $i++) {
            $usuarioCodAd = $array[$i]['colaborador'];
            $usuario = UsuarioNegocio::create()->obtenerUsuarioId($usuarioCodAd);
            $usuarioId = $usuario[0]['usuario_id'];
            $tema = $array[$i]['tema'];
            $detalle = $array[$i]['detalle'];
            $temaC=$tema."\n\n".$temaC;    
            $responseTema = ComiteSstReuAgenda::create()->insertarComiteSstReuAgenda($comiteSst_id, $comiteSstReunionId, $usuarioId, $tema, $detalle, $usuCreacion);
        }
        $responseTema[0]['vout_temaAgenda']=$temaC;
        return $responseTema;
    }
    
    public function actualizarTemaAgenda($comiteSst_id, $comiteSstReunionId, $usuCreacion) {
        session_start();
        $array = $_SESSION['gridAgenda'];
        if (isset($_SESSION['gridElimina'])) {
            $arrayEli = $_SESSION['gridElimina'];
        }
         $temaC="";
        for ($i = 0; $i < count($array); $i++) {
            $usuarioCodAd = $array[$i]['colaborador'];
            $usuario = UsuarioNegocio::create()->obtenerUsuarioId($usuarioCodAd);
            $usuarioId = $usuario[0]['usuario_id'];
            $tema = $array[$i]['tema'];
            $detalle = $array[$i]['detalle'];
            $idBd = $array[$i]['idBd'];
            //actualizas registro existente en BD
            if ($idBd != null || $idBd != '') {
                $responseTema = ComiteSstReuAgenda::create()->actualizarComiteSstReuAgenda($idBd, $comiteSst_id, $comiteSstReunionId, $usuarioId, $tema, $detalle, $usuCreacion);
            }
            //eliminar registro de base datos
            if (isset($_SESSION['gridElimina']) && count($arrayEli) > 0) {
                for ($i = 0; $i < count($arrayEli); $i++) {
                    $idEliminar = $arrayEli[$i]['idElimina'];
                    $responseElimina = ComiteSstReuAgenda::create()->eliminarComiteSstReuAgenda($idEliminar);
                }
            }
            if (!isset($_SESSION['gridElimina']) && $idBd == null) {
                $responseTema = ComiteSstReuAgenda::create()->insertarComiteSstReuAgenda($comiteSst_id, $comiteSstReunionId, $usuarioId, $tema, $detalle, $usuCreacion);
            }
              $temaC=$tema."<br>".$temaC;   
        }
        $responseTema[0]['vout_temaAgenda']=$temaC;
        return $responseTema;
    }

    public function crearGrid($tema, $detalle, $colaborador, $idBb) {

        $array = array();
        session_start();
        if (isset($_SESSION['gridAgenda'])) {

            $array = $_SESSION['gridAgenda'];

            if (count($array) > 0) {
                $i = count($array);
            }
        } else {
            $i = 0;
        }
        $array[$i] = array('tema' => $tema, 'detalle' => $detalle, 'colaborador' => $colaborador, 'id' => $i, 'idBd' => $idBb);
        $array[0]['vout_exito'] = ConstantesNegocio::VOUT_EXITO;
        $_SESSION['gridAgenda'] = $array;

        $arreglo = $_SESSION['gridAgenda'];

        return $arreglo;
    }

    public function obtenerXIdGrid($id) {
        session_start();
        $array = $_SESSION['gridAgenda'];
        $valor = $array[$id];
        return $valor;
    }

    public function editarGrid($id, $tema, $detalle, $colaborador) {
        session_start();
        $array = $_SESSION['gridAgenda'];
        for ($i = 0; $i < count($array); $i++) {
            if ($i == intval($id)) {
                $array[$id]['tema'] = $tema;
                $array[$id]['detalle'] = $detalle;
                $array[$id]['colaborador'] = $colaborador;
            }
        }

        unset($_SESSION['gridAgenda']);
        $_SESSION['gridAgenda'] = $array;
        return $array;
    }

    public function eliminarGrid($id) {
        session_start();
        $array2 = $_SESSION['gridAgenda'];
        if (!is_null($array2[$id]['idBd'])) {
            $array = array();
            session_start();
            if (isset($_SESSION['gridElimina'])) {

                $array = $_SESSION['gridElimina'];

                if (count($array) > 0) {
                    $i = count($array);
                }
            } else {
                $i = 0;
            }
            $arrayElimina[$i] = array('idElimina' => $array2[$id]['idBd']);
            $i = $i + 1;
        }
        $_SESSION['gridElimina'] = $arrayElimina;
        unset($array2[$id]);

        $array = array_values($array2);
        if (count($array) > 0) {
            $_SESSION['gridAgenda'] = $array;
        } else {
            $_SESSION['gridAgenda'] = null;
        }
        $arreglo = $_SESSION['gridAgenda'];
        return $arreglo;
    }
    public function crearAgendaAcuerdo($comiteSstId, $comiteSstReuId, $usuCreacion) {
        session_start();
        $array = $_SESSION['gridAcuerdo'];
        $arrayEli=$_SESSION['gridEliminaAcuerdo'];
        for ($i = 0; $i < count($array); $i++) {
            $usuarioCodAd = $array[$i]['colaborador'];
            $usuario = UsuarioNegocio::create()->obtenerUsuarioId($usuarioCodAd);
             $colaboradorId = $usuario[0]['usuario_id'];
            $comiteSstReuAgeId = $array[$i]['temaId'];
            $detalle = $array[$i]['detalle'];
            $fecPropuesto=$array[$i]['fechaVen'];
             $idBd = $array[$i]['idBd'];
            //actualizas registro existente en BD
            if ($idBd != null || $idBd != '') {
                $responseAcu = ComiteSstReuAgeAcuerdo::create()->actualizarComiteSstReuAgeAcuerdo($idBd,$comiteSstId, $comiteSstReuId,$comiteSstReuAgeId,
                    $colaboradorId,$fecPropuesto, $detalle,$usuCreacion);
            }
            //eliminar registro de base datos
            if (isset($_SESSION['gridEliminaAcuerdo']) && count($arrayEli) > 0) {
                for ($i = 0; $i < count($arrayEli); $i++) {
                    $idEliminar = $arrayEli[$i]['idEliminaAcu'];
                    $responseEliminaAcu = ComiteSstReuAgeAcuerdo::create()->eliminarComiteSstReuAgeAcuerdo($idEliminar);
                }
            }
            if (!isset($_SESSION['gridEliminaAcuerdo']) && $idBd == null) {
                    $responseAgeAcu = ComiteSstReuAgeAcuerdo::create()->insertarComiteSstReuAgeAcuerdo($comiteSstId, $comiteSstReuId,$comiteSstReuAgeId,
                    $colaboradorId,$fecPropuesto, $detalle,$usuCreacion); 
                    }

        }
        return $responseAgeAcu;
    }
    public function crearGridAcuerdo($tema, $temaId, $colaborador, $fechaVen, $detalle, $idBb,$fecCumplido) {
        if(is_null($fecCumplido)){
            $fecCumplido='#';
        }
        $array = array();
        session_start();
        if (isset($_SESSION['gridAcuerdo'])) {

            $array = $_SESSION['gridAcuerdo'];

            if (count($array) > 0) {
                $i = count($array);
            }
        } else {
            $i = 0;
        }
        $array[$i] = array('tema' => $tema, 'temaId' => $temaId, 'colaborador' => $colaborador, 'fechaVen' => $fechaVen, 'detalle' => $detalle, 'id' => $i, 'idBd' => $idBb,'fec_cumplido'=>$fecCumplido);
        $array[0]['vout_exito'] = ConstantesNegocio::VOUT_EXITO;
        $_SESSION['gridAcuerdo'] = $array;

        $arreglo = $_SESSION['gridAcuerdo'];

        return $arreglo;
    }

    public function obtenerXIdGridAcuerdo($id) {
        session_start();
        $array = $_SESSION['gridAcuerdo'];
        $valor = $array[$id];
        return $valor;
    }

    public function editarGridAcuerdo($id, $tema, $idtema, $colaborador, $fecVen, $detalle) {
        session_start();
        $array = $_SESSION['gridAcuerdo'];
        for ($i = 0; $i < count($array); $i++) {
            if ($i == intval($id)) {
                $array[$id]['tema'] = $tema;
                $array[$id]['temaId'] = $idtema;
                $array[$id]['colaborador'] = $colaborador;
                $array[$id]['fechaVen'] = $fecVen;
                $array[$id]['detalle'] = $detalle;
            }
        }

        unset($_SESSION['gridAcuerdo']);
        $_SESSION['gridAcuerdo'] = $array;
        return $array;
    }

    public function eliminarGridAcuerdo($id) {
        session_start();
        $array2 = $_SESSION['gridAcuerdo'];
        if (!is_null($array2[$id]['idBd'])) {
            $array = array();
            session_start();
            if (isset($_SESSION['gridEliminaAcuerdo'])) {

                $array = $_SESSION['gridEliminaAcuerdo'];

                if (count($array) > 0) {
                    $i = count($array);
                }
            } else {
                $i = 0;
            }
            $arrayElimina[$i] = array('idEliminaAcu' => $array2[$id]['idBd']);
            $i = $i + 1;
        }
        $_SESSION['gridEliminaAcuerdo'] = $arrayElimina;
        unset($array2[$id]);

        $array = array_values($array2);
        if (count($array) > 0) {
            $_SESSION['gridAcuerdo'] = $array;
        } else {
            $_SESSION['gridAcuerdo'] = null;
        }
        $arreglo = $_SESSION['gridAcuerdo'];
        return $arreglo;
    }
    
    //crea el acuerdo ya resuelto
    public function crearGridAcuerdoPendiente($idReuAcuerdo,$docEncode,$docNombre,$evidencia) {
        
        $array = array();
        session_start();
        if (isset($_SESSION['gridAcuerdoPendiente'])) {

            $array = $_SESSION['gridAcuerdoPendiente'];

            if (count($array) > 0) {
                $i = count($array);
            }
        } else {
            $i = 0;
        }
        $array[$i] = array('IdAcuerdo'=>$idReuAcuerdo,'docEnconde' => $docEncode,
            'docNombre' => $docNombre, 'evidencia' => $evidencia, 'id' => $i);
        $arreglo[0]['vout_exito'] = ConstantesNegocio::VOUT_EXITO;
        $_SESSION['gridAcuerdoPendiente'] = $array;

        $arreglo = $_SESSION['gridAcuerdoP'];
        
        for ($i = 0; $i < count($arreglo); $i++) {
            if ($arreglo[$i]['acuId']==$idReuAcuerdo) {
                unset($arreglo[$i]);
            }
                
        }
        

        $array = array_values($arreglo);
        if (count($array) > 0) {
            $_SESSION['gridAcuerdoP'] = $array;
        } else {
            $_SESSION['gridAcuerdoP'] = null;
        }
        $arreglo = $_SESSION['gridAcuerdoP'];
        
        return $arreglo;
    }
    public function cambiarEstado($id, $estado) {
        $tabla = ConstantesNegocio::TBL_COMITESST;
        $campo = ConstantesNegocio::ESTADO;
        return SeguridadNegocio::create()->updateEstadoVisible($tabla, $campo, intval($estado), $id);
    }

    public function obtenerMiembroXid() {
        $data = Comite::create()->obtenerComiteVigenteId();
        $comiteSst_id = $data[0]['comite_sst_id'];
        $array = Comite::create()->obtenerMiembroXId($comiteSst_id);
        for ($i = 0; $i < count($array); $i++) {
            if ($array[$i]['cargo'] == '1') {
                $array[$i]['cargoN'] = 'Presidente';
            }
            if ($array[$i]['cargo'] == '2') {
                $array[$i]['cargoN'] = 'Secretario';
            }
            if ($array[$i]['cargo'] == '3') {
                $array[$i]['cargoN'] = 'Vocal';
            }
        }
        return $array;
    }

    public function obtenerReunionXId($comiteSstReuId) {
        return ComiteSstReunion::create()->obtenerReunionXId($comiteSstReuId);
    }

    public function obtenerReunionAgendaXId($comiteSstReuId) {
        session_start();
        unset($_SESSION['gridAgenda']);
        $array = ComiteSstReunion::create()->obtenerReunionAgendaXId($comiteSstReuId);
        for ($i = 0; $i < count($array); $i++) {
            $arrayR = ComiteSstReunionNegocio::crearGrid($array[$i]['tema'], $array[$i]['detalle'], $array[$i]['colaborador'], $array[$i]['id']);
        }
        return $arrayR;
    }
     public function obtenerReunionAcuerdoXId($comiteSstReuId) {
        session_start();
        unset($_SESSION['gridAcuerdo']);
        $array = ComiteSstReuAgeAcuerdo::create()->obtenerXIdReuAcuerdo($comiteSstReuId);
        for ($i = 0; $i < count($array); $i++) {
          $arrayR = ComiteSstReunionNegocio::crearGridAcuerdo($array[$i]['tema'], $array[$i]['temaId'], $array[$i]['colaborador'],$array[$i]['fec_propuesto'],
                    $array[$i]['acuerdo'],$array[$i]['id'],$array[$i]['fec_cumplido']);
        }
        return $arrayR;
    }

    public function obtenerReunionTemaXId($comiteSstReuId) {
        return ComiteSstReunion::create()->obtenerReunionTemaXId($comiteSstReuId);
    }
     public function obtenerReunionPendienteXId($comiteSstReuId) {
         session_start();
         $arrayS=$_SESSION['gridAcuerdo'];
         $array= ComiteSstReuAgeAcuerdo::create()->obtenerXIdReuAcuerdoPendiente($comiteSstReuId);
         for ($i = 0; $i < count($array); $i++) {
             $array[$i]['id']=$arrayS[$i]['id'];
         }
         $_SESSION['gridAcuerdoP']=$array;
         return $array;
    }
   public function obtenerMiembroXidAsistencia($id,$comiteSstReuId){
       $arrayA=  ComiteSstReunion::create()->obtenerAsistenciaReunionXId($comiteSstReuId);
       $array=Comite::create()->obtenerMiembroXId($id);
       for ($i = 0; $i < count($array); $i++) {
           $array[$i]['asistencia']='0';
           if($array[$i]['id']==$arrayA[$i]['comite_sst_miembro_id'] && count($arrayA)>0){
               $array[$i]['asistencia']=$arrayA[$i]['asistencia'];
           }
       }
       
       return $array;
    }
    public function asistenciaComiteSstReunion($comiteSstReuId,$miembroId,$usuCreacion){
        
        return ComiteSstReunion::create()->asistenciaComiteSstReunion($comiteSstReuId,$miembroId,$usuCreacion);
    }
}
