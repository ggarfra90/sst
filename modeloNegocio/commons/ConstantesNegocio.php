<?php

/*
 * @author Geancarlo Leiva <gleiva@imaginatecperu.com>
 * @version 1.0
 * @copyright (c) 2015, IMAGINA TECHNOLOGIES S.A.C.
 * @abstract Clase donde se implementará el Componente
 */

/**
 * Description of ConstantesNegocio
 *
 * @author GC
 */
class ConstantesNegocio {
    /* ID empresa Netafim */
    const EMPRESAID = '1';
    /* ID parametro tipo DNI */
    const PAR_TIPODNIID = '1';
    /* Código de parámetro de configuración del sistema */
    const PARCOD_TIPOEVENTO = 'TIDECLAEVE';
    const PARCOD_TIPOPARTICIPACION = 'TIDECLAPARTI';
    const PARCOD_TIPOPERDIDA = 'TIEVENPERDI';
    /* ID usuario Imagina */
    const USUARIOSISTEMAID = '1';
    /* Respuestas de los procedimientos almacenados */
    const VOUT_EXITO = '1';
    const VOUT_ERROR = '0';

    /* Estado / Visible */
    const PARAM_ACTIVO = '1';
    const PARAM_NO_ACTIVO = '0';
    const PARAM_VISIBLE = '1';
    const PARAM_NO_VISIBLE = '0';
    const PARAM_NULL = '-1';

    /* Documento es parte de lista maestra */
    const ES_LISTA_MAESTRA = '1';
    const NO_LISTA_MAESTRA = '0';
    /* Flujo de estado de documentos de la lista maestra */
    const FLUDOC_GUARDADO = '0';
    const FLUDOC_ENVIADO = '1';
    const FLUDOC_APROBADO = '2';
    const FLUDOC_RECHAZADO = '3';
    const FLUDOC_PUBLICADO = '4';
    /* Documento archivado o no */
    const ARCHIVADO = '1';
    const NO_ARCHIVADO = '0';
    /* Tipos de documentos */
    const PAR_TIPODOC_PLANSST = 'Plan SST';
    const PAR_TIPODOC_POLITICASST = 'Política SST';
    const PAR_TIPODOC_REGLAMENTOSST = 'Reglamento SST';
    const PAR_TIPODOC_IPERPROCEDIMIENTO = 'Procedimiento IPER';
    const PAR_TIPODOC_MAPARIESGO = 'Mapa riesgo';
    const PAR_TIPODOC_CAPACITACION = 'Capacitaciones';
    const PAR_TIPODOC_CAPA_EVIDENCIA = 'Evidencia de capacitación';
    const PAR_TIPODOC_INSPOBSERVACION = 'Observación de inspección';
    const PAR_TIPODOC_INSPEVIDENCIA = 'Evidencia de atención de inspección';
    const PAR_TIPODOC_RIAPROC = 'Procedimiento RIA';
    const PAR_TIPODOC_RIADECLARACION = 'RIA declaración de trabajador';
    const PAR_TIPODOC_RIAINVEEVIDENCIA = 'Evidencia de atención de investigación';
    const PAR_TIPODOC_COMITESST_CONVOCATORIA='Comite SST convocatoria';
    const PAR_TIPODOC_COMITESST_ELECCION='Comite SST eleccion';
    const PAR_TIPODOC_COMITESST_REU_ACU_CIERRE='Comite SST reunión acuerdo cierre';
    /* tipo capacitacion*/
    const PAR_TIPO_CAPACITACION='TICAPA';
/* Tipos de items de entrada de matriz iper  */
    const PAR_TIPESITE='TIPESITE';
    const PAR_TIPETIAC='TIPETIAC';
    const PAR_TIPEPROB='TIPEPROB';
    const PAR_TIPEEXPO='TIPEEXPO';
    const PAR_TIPESEVE='TIPESEVE';
    /* Iper Valor Riesgo Tipos de items de entrada  */
    const PAR_VR_BAJO='VARI_RIESGO_BAJO';
    const PAR_VR_MEDIO='VARI_RIESGO_MEDIO';
    const PAR_VR_ALTO='VARI_RIESGO_ALTO';
    const PAR_VR_CRITICO='VARI_RIESGO_CRITICO';
    
    /* Carpetas para documentos */
    const FILE_PLANSST = 'plan';
    const FILE_POLITICASST = 'politica';
    const FILE_REGLAMENTOSST = 'reglamento';
    const FILE_IPER = 'iper';
    const FILE_MAPARIESGO = 'mapaRiesgo';
    const FILE_CAPACITACION = 'capacitacion';
    const FILE_CAPA_EVIDENCIA = 'capacitacion/evidencia';
    const FILE_INSPOBSERVACION = 'inspeccion';
    const FILE_INSPEVIDENCIA = 'inspeccion/evidencia';
    const FILE_RIAPROC = 'ria/procedimiento';
    const FILE_RIADECLARACION = 'ria/declaracion';
    const FILE_RIAINVEEVIDENCIA = 'ria/investigacion';
    const FILE_COMITESST_CONVOCATORIA= 'comite/convocatoria';
    const FILE_COMITESST_ELECCION = 'comite/eleccion';
    const FILE_COMITESST_REUNION_CIERRE = 'comite/acuerdo';

    /* Campos estado / visible */
    const ESTADO = "estado";
    const VISIBLE = "visible";
    /* Tablas del sistema */
    const TBL_DOCUMENTO = "documento";
    const TBL_PLANSST = "plan_sst";
    const TBL_POLITICASST = "politica_sst";
    const TBL_REGLAMENTOSST = "reglamento_sst";
    const TBL_IPERPROCEDIMIENTO = "iper_procedimiento";
    const TBL_MAPARIESGO = "mapa_riesgo";
    const TBL_CAPACITACION = "capacitacion";
    const TBL_RIAPROCEDIMIENTO = "ria_procedimiento";
    const TBL_RIADECLARACION = "ria_declaracion";
     const TBL_COMITESST = "comite_sst";
}
