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
class ConstantesMail {
//Comite SST -> reuniones: al crear reunión, notificar vía correo electrónico 
//a los integrantes del comité con los datos de la reunión 
//(fecha, hora, lugar de reunión, temas de agenda)
    const PARAM_SUBJECT = 'Reunion de Comite';
    const PARAM_BODY_FECHA = 'Fecha:';
    const PARAM_BODY_HORA = 'Hora:';
    const PARAM_BODY_TEMA_AGENDA = 'Tema de agenda:'; 
}
