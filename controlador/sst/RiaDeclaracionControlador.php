<?php

require_once __DIR__ . '/../../modeloNegocio/sst/RiaNegocio.php';
require_once __DIR__ . '/../../util/Configuraciones.php';
require_once __DIR__ . '/../core/ControladorBase.php';

class RiaDeclaracionControlador extends ControladorBase {

    public function obtenerTipoEvento() {
        return RiaNegocio::create()->obtenerTipoEvento();
    }

    public function obtenerTipoParticipacion() {
        return RiaNegocio::create()->obtenerTipoParticipacion();
    }
    
    public function crearRiaDeclaracion() {
        $this->setTransaction();
        $eveFecha = $this->getParametro("eveFecha");
        $eveHora = $this->getParametro("eveHora");
        $eveTipoId = $this->getParametro("eveTipoId");
        $eveParticipacionId = $this->getParametro("eveParticipacionId");
        $reuLugar = $this->getParametro("reuLugar");
        $reuFecha = $this->getParametro("reuFecha");
        $reuHoraIni = $this->getParametro("reuHoraIni");
        $reuHoraFin = $this->getParametro("reuHoraFin");
        $decPregunta1 = $this->getParametro("decPregunta1");
        $decPregunta2 = $this->getParametro("decPregunta2");
        $decPregunta3 = $this->getParametro("decPregunta3");
        $decPregunta4 = $this->getParametro("decPregunta4");
        $decPregunta5 = $this->getParametro("decPregunta5");
        $decPregunta6 = $this->getParametro("decPregunta6");
        $decPregunta7 = $this->getParametro("decPregunta7");
        $decPregunta8 = $this->getParametro("decPregunta8");
        $regDescripcion = $this->getParametro("regDescripcion");
        $documento = $this->getParametro("documento");
        $docNombre = $this->getParametro("docNombre");
        $usuCreacion = $this->getUsuarioId();
        return RiaNegocio::create()->crearRiaDeclaracion($eveFecha, $eveHora, $eveTipoId, $eveParticipacionId, 
                $reuLugar, $reuFecha, $reuHoraIni, $reuHoraFin, $decPregunta1, $decPregunta2, $decPregunta3, 
                $decPregunta4, $decPregunta5, $decPregunta6, $decPregunta7, $decPregunta8, $regDescripcion, 
                $documento, $docNombre, $usuCreacion);
    }
}
