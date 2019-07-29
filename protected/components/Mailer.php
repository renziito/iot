
<?php

/**
 * @author Nolberto Vilchez Moreno <jnolbertovm@gmail.com>
 * @package APP\Components
 */

Yii::import("application.extensions.Smtpmail.PHPMailer");

class Mailer {

  /**
   * 
   * @param string|array $para destinatario(s) a quien enviar el correo.
   * @param string $mensaje contenido del correo
   * @param string $asunto asunto del correo
   * @param string $de emisor del correo
   * @param int $prioridad prioridad del correo
   * @param string|array $adjunto ruta del archivo o arreglo de rutas de archivo a ser adjuntados al correo.
   * @return array Arreglo de estado y mensaje del envio del correo.
   */
  public static function send($para = "", $mensaje = "", $asunto = "", $prioridad = 3, $adjunto = false) {
    $mail = new PHPMailer();

    $mail->isSMTP();
    $mail->Host       = "mail.apptomatiza.com";
    $mail->Mailer     = 'smtp';
    $mail->Port       = 25;
    $mail->SMTPAuth   = TRUE;
    $mail->Username   = "admintemplate@apptomatiza.com";
    $mail->Password   = "admintemplate";
    $mail->CharSet    = 'UTF-8';

    $mail->SetFrom("admintemplate@apptomatiza.com", 'ADMINTEMPLATE');

    $mail->Subject = $asunto;
    
    $mail->MsgHTML($mensaje);
    if (is_array($para)) {
      foreach ($para as $destinatario) {
        $mail->AddAddress($destinatario, "");
      }
    } else {
      $mail->AddAddress($para, "");
    }
    $mail->Priority = $prioridad;
    if ($adjunto) {
      if (is_array($adjunto)) {
        foreach ($adjunto as $adj) {
          $mail->AddAttachment($adj);
        }
      } else {
        $mail->AddAttachment($adjunto);
      }
    }
    if (!$mail->Send()) {
      $data['estado']  = false;
      $data['mensaje'] = "Mailer Error: " . $mail->ErrorInfo;
    } else {
      $data['estado']  = true;
      $data['mensaje'] = "Mensaje Enviado!";
    }

    $mail->ClearAddresses();

    return $data;
  }

}
