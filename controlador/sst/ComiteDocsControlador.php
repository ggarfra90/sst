<?php

require_once __DIR__ . '/../../modeloNegocio/sst/ComiteNegocio.php';
require_once __DIR__ . '/../../util/Configuraciones.php';
require_once __DIR__ . '/../core/ControladorBase.php';

class ComiteDocsControlador extends ControladorBase {

    public function listarDocsXrevisar() {
        return ComiteNegocio::create()->listarDocsXrevisar();
    }

    public function aprobarDocumento() {
        $documentoId = $this->getParametro("documentoId");
        return ComiteNegocio::create()->aprobarDocumento($documentoId);
    }

    public function rechazarDocumento() {
        $documentoId = $this->getParametro("documentoId");
        $motivoRechazo = $this->getParametro("motivoRechazo");
        return ComiteNegocio::create()->rechazarDocumento($documentoId, $motivoRechazo);
    }
}
