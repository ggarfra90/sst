<?php

require_once __DIR__ . "/../core/ModeloBase.php";
require_once __DIR__ . "/../core/ConnectionMSSQL.php";

/*
 * @author Christopher Heredia <cheredia@imaginatecperu.com>
 * @version 1.0
 * @copyright (c) 2015, IMAGINA TECHNOLOGIES S.A.C.
 * @abstract Clase donde se implementará el Componente
 */

class Usuario extends ModeloBase {

    const DEFAULT_ALIAS = "usuario";

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @return Usuario
     */
    static function create() {
        return parent::create();
    }

    public function obtenerUsuarioId($usuarioCodAd) {
        $this->commandPrepare("sp_usuario_obtener_id");
        $this->commandAddParameter(":vin_usu_cod_ad", $usuarioCodAd);
        return $this->commandGetData();
    }

    public function obtenerUsuarioLegadoXcodAd($usuarioCodAd) {
        $mssql = new ConnectionMSSQL();
        $sql = "select pg.IDDOCIDENTIDAD as dni_cod_legado, di.DESCRIPCION as dni_descripcion, "
                . "di.DESCR_CORTO as dni_abreviatura, "
                . "(pg.NOMBRES + ' ' +  pg.A_PATERNO + ' ' + pg.A_MATERNO) as per_nom_completo, "
                . "pg.NRODOCUMENTO as per_nro_documento, pg.FECHA_NACIMIENTO as per_fec_nacimiento, pg.SEXO as per_sexo "
                . "from PERSONAL_GENERAL pg, DOC_IDENTIDAD di, PERSONAL_VARIABLES pv "
                . "where pg.IDDOCIDENTIDAD = di.IDDOCIDENTIDAD "
                . "and pg.IDCODIGOGENERAL = pv.IDCODIGOGENERAL "
                . "and pv.IDVARIABLE = 'USR' "
                . "and pv.VALOR = '" . $usuarioCodAd . "';";
        $rs = $mssql->ejecutar($sql);
        $response = array();
        while (!$rs->EOF) {
            $val = new stdClass();
            $val->dni_cod_legado = utf8_encode($rs->Fields->Item('dni_cod_legado')->value);
            $val->dni_descripcion = utf8_encode($rs->Fields->Item('dni_descripcion')->value);
            $val->dni_abreviatura = utf8_encode($rs->Fields->Item('dni_abreviatura')->value);
            $val->per_nom_completo = utf8_encode($rs->Fields->Item('per_nom_completo')->value);
            $val->per_nro_documento = utf8_encode($rs->Fields->Item('per_nro_documento')->value);
            $val->per_fec_nacimiento = utf8_encode($rs->Fields->Item('per_fec_nacimiento')->value);
            $val->per_sexo = utf8_encode($rs->Fields->Item('per_sexo')->value);
            array_push($response, $val);
            $rs->MoveNext();
        }
        $mssql->close();
        return $response;
    }

    public function insertarUsuario($usuarioCodAd, $tipoDocumento, $nomCompleto,
            $nroDocumento, $fecNacimiento, $sexo) {
        $this->commandPrepare("sp_usuario_insertar");
        $this->commandAddParameter(":vin_usu_cod_ad", $usuarioCodAd);
        $this->commandAddParameter(":vin_tipo_documento", $tipoDocumento);
        $this->commandAddParameter(":vin_nom_completo", $nomCompleto);
        $this->commandAddParameter(":vin_nro_documento", $nroDocumento);
        $this->commandAddParameter(":vin_fec_nacimiento", $fecNacimiento);
        $this->commandAddParameter(":vin_sexo", $sexo);
        return $this->commandGetData();
    }

    public function listarMenuPadre($perfilId) {
        $this->commandPrepare("sp_opcion_listar_menu_padre");
        $this->commandAddParameter(":vin_perfil_id", $perfilId);
        return $this->commandGetData();
    }

    public function listarMenuHijo($perfilId, $opcionId) {
        $this->commandPrepare("sp_opcion_listar_menu_hijo");
        $this->commandAddParameter(":vin_perfil_id", $perfilId);
        $this->commandAddParameter(":vin_opcion_padre_id", $opcionId);
        return $this->commandGetData();
    }

    public function obtenerUsuarioLegado() {
        $mssql = new ConnectionMSSQL();
        $sql = "select pv.VALOR as per_cod_ad, isnull((pg.NOMBRES + ' ' +  pg.A_PATERNO + "
                . "' ' + pg.A_MATERNO), '-') as per_nom_completo "
                . "from PERSONAL_GENERAL pg, PERSONAL_VARIABLES pv "
                . "where pg.IDCODIGOGENERAL = pv.IDCODIGOGENERAL "
                . "and pv.IDVARIABLE = 'USR';";
        $rs = $mssql->ejecutar($sql);
        $response = array();
        while (!$rs->EOF) {
            $val = new stdClass();
            $val->per_cod_ad = utf8_encode($rs->Fields->Item('per_cod_ad')->value);
            $val->per_nom_completo = utf8_encode($rs->Fields->Item('per_nom_completo')->value);
            array_push($response, $val);
            $rs->MoveNext();
        }
        $mssql->close();
        return $response;
    }

}
