<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;





class Mailer{
  public $mail;
 
  function __construct(){
    $this->mail = new PHPMailer(true);
    $this->mail->CharSet        = PHPMailer::CHARSET_UTF8;
    //Server settings
    $this->mail->isSMTP();
    $this->mail->SMTPAuth        = TRUE;
    $this->mail->SMTPSecure    = PHPMailer::ENCRYPTION_SMTPS;
    $this->mail->SMTPOptions    = [
          'ssl' => [
              'verify_peer'        => FALSE,
              'verify_peer_name'    => FALSE,
              'allow_self_signed'    => TRUE
          ]
      ];
    $this->mail->SMTPAuth= true;                                          //Send using SMTP
    $this->mail->Host       = EMAIL_HOST;                     //Set the SMTP server to send through
    $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $this->mail->Username   = EMAIL_EMAIL;                     //SMTP username
    $this->mail->Password   = EMAIL_PASS;                               //SMTP password
    $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $this->mail->Port       = EMAIL_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
}

  function send($assunto, $corpo, $email){
    if(!EMAIL_ATIVO){
      return true;

    }
    $this->mail->addAddress($email);
    $this->mail->setFrom("contato@sugoigame.com.br", "Sugoi Game");
    $this->mail->isHTML(true);                                  //Set email format to HTML
    $this->mail->Subject = $assunto;
    $this->mail->Body    = $corpo;
    $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    return $this->mail->send();
  }
}