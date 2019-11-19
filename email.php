<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './phpmailer/src/Exception.php';
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';
require './includes/constants.php';

class EmailSender
{
    var $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        // $mail->SMTPDebug = 2;                                          // Enable verbose debug output
        $this->mail->isSMTP();                                            // Set mailer to use SMTP
        $this->mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
        $this->mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $this->mail->Username   = USER_NAME;                              // SMTP username
        $this->mail->Password   = PASSWORD;                               // SMTP password
        $this->mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $this->mail->Port       = 587;                                    // TCP port to connect to
        $this->mail->addAddress(TO_EMAIL, TO_NAME);                       // Add a recipient
        $this->mail->setFrom(FROM_EMAIL, 'donotreply@thehazeleyacademy.com');
        $this->mail->isHTML(true);                                        // Set email format to HTML

    }


    function sendEmail($subject,$body,$filesToEmail,$priority)
    {
        try {


            $this->mail->Priority = $priority;
            $this->mail->Subject = $subject;
            foreach ($filesToEmail as $file_name => $file_to_attach) {
                $this->mail->AddAttachment($file_to_attach, $file_name);
            }
            $this->mail->Body  = $body;
            $this->mail->send();
            echo 'Message has been sent';
            $_POST = array();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
            error_log("Message could not be sent. Mailer Error: ", $this->mail->ErrorInfo . $e);
        }
    }
}
