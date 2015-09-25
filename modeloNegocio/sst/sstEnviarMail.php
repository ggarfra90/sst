<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sstEnviarMail
 *
 * @author Imagina
 */

include_once __DIR__ . '/../sst/util/Util.php';
require_once __DIR__ . '/../../vistas/libs/imagina/phpMailer/class.phpmailer.php';
class sstEnviarMail  extends ModeloNegocioBase{
    //put your code here
        public function enviarCorreo($to, $cc, $subject, $body, $attachString = NULL, $attachFilename = NULL) {
        $mail = new PHPMailer;
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->Host = 'mocha3017.mochahost.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'no-reply@imaginatecperu.com';
        $mail->Password = 'no-reply';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->From = 'no-reply@imaginatecperu.com';
        $mail->FromName = 'Imagina Technologies';
        $mail->AddAddress($to);
        $mail->AddCC($cc);
        $mail->WordWrap = 90;
        $mail->IsHTML(false);
        $mail->Subject = "[SGA] " . $subject;
        $mail->Body = $body;
        if (!$mail->Send()) {
            $this->setMensajeEmergente($mail->ErrorInfo, null, Configuraciones::MENSAJE_WARNING);
        }
    }

}
