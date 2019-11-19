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


    function sendEmail($firstName, $department, $printCopies, $dateRequired, $period, $urgentlyRequired, $printType, $specialRequirement, $filesToEmail,$priority)
    {
        try {


            $this->mail->Priority = $priority;
            $this->mail->Subject = 'Reprographic Requirement for : ' . $firstName;
            foreach ($filesToEmail as $file_name => $file_to_attach) {
                $this->mail->AddAttachment($file_to_attach, $file_name);
            }
            $this->mail->Body  = '<html>
               <head>
               <style>
                           th, td {
                 padding: 5px;
                 text-align: left;
               }
               </style>
               </head>
               <body>
                           <table style="width:100%" border="1">
                   <tr>
                     <th>Name</th>
                     <td>' . $firstName . '</td>
                   </tr>
                   <tr>
                     <th>Department</th>
                     <td>' . $department . '</td>
                   </tr>
                   <tr>
                   <th>Number of Copies</th>
                   <td>' . $printCopies . '</td>
                   </tr>
                   <tr>
                     <th>Date Required</th>
                     <td>' . $dateRequired . '</td>
                   </tr>
                   <tr>
                     <th>Period</th>
                     <td>' . $period . '</td>
                   </tr>
                   <tr>
                     <th>Urgently required</th>
                     <td>' . $urgentlyRequired . '</td>
                   </tr>
                   <tr>
                     <th>Print Requirements</th>
                     <td>' . $printType . '</td>
                   </tr>
                   <tr>
                     <th>Special Requirements (if any)</th>
                     <td>' . $specialRequirement . '</td>
                   </tr>
                 </table>
                 <br/>
                 </body>
                           </html>';
            $this->mail->send();
            echo 'Message has been sent';
            $_POST = array();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            error_log("Message could not be sent. Mailer Error: ", $mail->ErrorInfo . $e);
        }
    }
}
