<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';
require './phpmailer/src/Exception.php';

require './includes/constants.php';
require './includes/referenceDataConfig.php';

class EmailSender
{
    var $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        // $mail->SMTPDebug = 2;                                          // Enable verbose debug output
        $this->mail->IsSMTP();                                            // Set mailer to use SMTP
        $this->mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
        $this->mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $this->mail->Username   = USER_NAME;                              // SMTP username
        $this->mail->Password   = PASSWORD;                               // SMTP password
        $this->mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $this->mail->Port       = 587;                                    // TCP port to connect to
        $this->mail->addAddress(TO_EMAIL,FROM_NAME);                       // Add a recipient
        $this->mail->IsHTML(true);                                        // Set email format to HTML

    }


    function send($subject, $body, $filesToEmail, $priority, $requesterEmail)
    {
        try {

            $this->mail->setFrom(FROM_EMAIL,FROM_NAME);
            $this->mail->Priority = $priority;
            $this->mail->Subject = $subject;
            $this->mail->addReplyTo($requesterEmail);   //when added and reply-to , will reply to this address and not to the FROM address
            $this->mail->AddCC($requesterEmail);        //send a copy to requestor
            foreach ($filesToEmail as $file_name => $file_to_attach) {
                $this->mail->AddAttachment($file_to_attach, $file_name);
            }
            $this->mail->Body  = $body;
            $this->mail->send();
            
            $_POST = array();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
            error_log("Message could not be sent. Mailer Error: ", $this->mail->ErrorInfo . $e);
        }
    }
    
}
