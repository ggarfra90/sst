<?php

require_once __DIR__ . '/../../modeloNegocio/9box/PRPNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/9box/UsuarioNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/9box/AnioNegocio.php';
require_once __DIR__ . '/../../util/Configuraciones.php';
require_once __DIR__ . '/../../util/ImportacionExcel.php';
require_once __DIR__ . '/../core/ControladorBase.php';

/**
 * Description of PRPControlador
 *
 * @author CHL007
 */
class PRPControlador extends ControladorBase {

    public function getAll() {

        $usuarioCreacion = $this->getUsuarioId();
        return PRPNegocio::create()->getAll(0, $usuarioCreacion);
    }

    public function getAllUsuarios() {
        return UsuarioNegocio::create()->getAll(0);
    }

    public function getAllAnios() {
        return AnioNegocio::create()->getAll();
    }

    public function save() {
        $anioId = $this->getParametro("anio_id");
        $usuarioId = $this->getParametro("usuario");
        $valor = $this->getParametro("valor");
        $usuarioCreacion = $this->getUsuarioId();
        
        $this->setCommitTransaction();
        $this->setMensajeEmergente(PRPNegocio::create()->save($anioId, $usuarioId, $valor,1, $usuarioCreacion));
    }
    
    public function delete(){
        $id = $this->getParametro("id");
        $this->setMensajeEmergente(PRPNegocio::create()->delete($id));
    }
    
    public function importPRP() {
        $error_xml = false; 
        $file = $this->getParametro("file");
        $usuarioCreacion = $this->getUsuarioId();
        
        $decode = Util::base64ToImage($file);
        
        $direccion = __DIR__.'/../../util/formatos/subida.xlsx';
        if(file_exists($direccion))
        {
            unlink($direccion);
        }
        file_put_contents($direccion, $decode);
        
        
        if (strlen($file) < 1)
            throw new WarningException("No se ha seleccionado ningun archivo.");
        else {
            $xml = ImportacionExcel::parseExcelToXML("formatos/subida.xlsx", $usuarioCreacion, "PRP");
            $result = PRPNegocio::create()->importPRP($xml,$usuarioCreacion);
            $errores = "";
            if (is_array($result)) {
                foreach ($result as $array) {
                    if (array_key_exists("cause", $array))
                        $errores .= "<li>Fila ".$array["row"].": ".$array["cause"]."</li>";
                }
            }
            if ($errores !== "") {
                $errores = "No fue posible importar una o varias filas: <br><ul>$errores</ul>";
                throw new WarningException($errores);
            }
//            else {
//                $this->setMensajeEmergente("OK");
//            }
        }
    }

}
