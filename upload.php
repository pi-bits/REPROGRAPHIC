<?php

include 'email.php';
require './includes/constants.php';
require './includes/referenceDataConfig.php';

$emailSender  = new EmailSender();
$filesToEmail = array();

if (isset($_POST["submit"])) {

   if (!hasErrors($filesToEmail)) {
      sendEmail($PRINT_TYPE_CONFIG, $DEPARTMENT_CONFIG, $PERIOD_CONFIG, $emailSender, $filesToEmail);
   } 
}

function sendEmail($PRINT_TYPE_CONFIG, $DEPARTMENT_CONFIG, $PERIOD_CONFIG, &$emailSender, &$filesToEmail)
{
   $printType = "";
   if (!empty($_POST['check_list'])) {
      foreach ($_POST['check_list'] as $selected) {
         $printType = $printType . $PRINT_TYPE_CONFIG[$selected] . ",";
      }
   } else {
      $printType = "Default Prints";
   }

   $firstName =  $_POST["firstname"];
   $fromEmail =  $_POST["fromEmail"];
   $department = $DEPARTMENT_CONFIG[$_POST["department"]];
   $printCopies =  $_POST["printCopies"];
   $dateRequired  = date("d-M-Y", strtotime($_POST["Dates"]));
   $period = $PERIOD_CONFIG[$_POST["period"]];
   $urgentlyRequired = $_POST["urgentlyRequired"];
   /**
    * Options: null (default), 1 = High, 3 = Normal, 5 = low. When null, the header is not set at all.
    */
   $priority = $urgentlyRequired == 'Yes' ? 1 : 3;

   $specialRequirement = $_POST["specialRequirement"];
   $body = buildEmailBody($firstName, $department, $printCopies, $dateRequired, $period, $urgentlyRequired, $printType, $specialRequirement, $fromEmail);
   $subject = 'Reprographic Requirement for : ' . $firstName;
   $emailSender->sendEmail($subject, $body, $filesToEmail, $priority, $fromEmail);
}

function buildEmailBody($firstName, $department, $printCopies, $dateRequired, $period, $urgentlyRequired, $printType, $specialRequirement, $fromEmail)
{
   return '<html>
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
                   <th>Email</th>
                   <td>' . $fromEmail . '</td>
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
}
function hasErrors(&$filesToEmail)
{
   $maxNumberOfFiles = 10;
   $errors = array();

   if (!empty($_FILES['uploadDocument']['name'][0])) {

      $files = $_FILES['uploadDocument'];
      $failed = array();

      if (count($_FILES['uploadDocument']['name']) > $maxNumberOfFiles) {
         $errors['uploadDocumentError'] = "Cannot upload more than {$maxNumberOfFiles} files at one time. Please try again.";
         return;
      } else {
         foreach ($files['name'] as $position => $fileName) {

            $file_tmp = $files['tmp_name'][$position];
            $file_error = $files['error'][$position];
            $file_size = $files['size'][$position];
            $file_type = $files['type'][$position];
            /**
             * extract the file extension
             */
            $file_ext = strtolower(end(explode('.', $fileName)));

            $extensions = array("jpeg", "jpg", "png", "docx", "pdf", "xlsx");
            if (!in_array($file_ext, $extensions) === false) {
               if ($file_error === 0) {
                     /** 10MB Max file size*/
                  if ($file_size <= 10485760) {

                     $file_name_new = uniqid('', true) . '.' . $file_ext;
                     $fileDestination = "uploads/" . $file_name_new;

                     if (move_uploaded_file($file_tmp, $fileDestination)) {
                        $filesToEmail[$fileName] = $fileDestination;
                     } else {
                        $failed[$position] = "[{$file_name}] failed to upload.";
                     }
                  } else {

                     $failed[$position] = "[{$fileName}]  $file_size file is too large.";
                  }
               } else {
                  $failed[$position] = "[{$fileName}] failed to upload. {$file_error}";
               }
            } else {
               $failed[$position] = "[{$fileName}] file extension '{$file_ext}' is not allowed.";
            }
         }
      }
      if (!empty($failed)) {
         foreach ($failed as $key => $value) {
            $errors['uploadDocumentError'] = $failed[$key];
         }
      }
   }



   if (empty($_POST['fromEmail'])) {
      $errors['fromEmailError'] = "Email address is required.";
   } else {
      $fromEmail = test_input($_POST["fromEmail"]);
      if (!emailValidation($fromEmail)) {
         $errors['fromEmailError'] = "Enter a valid email address.";
      }
   }


   if (empty($_POST['firstname'])) {
      $errors['firstnameError'] = "Name is required.";
   } else {
      $firstname = test_input($_POST["firstname"]);
      if (!preg_match("/^[a-zA-Z ]*$/", $firstname)) {
         $errors['firstnameError'] = "Only letters and white space allowed.";
      }
   }

   if (empty($_POST['department'])) {
      $errors['departmentError'] = "Department/Budget is required.";
   }

   if (empty($_POST['printCopies'])) {
      $errors['printCopiesError'] = "Number of copy is required.";
   }
   if (empty($_POST['Dates'])) {
      $errors['printDateError'] = "Print Date is required.";
   } else {
      $printDate = date("m-d-Y", strtotime($_POST["Dates"]));
      $printDate_arr  = explode('-', $printDate);
      if (count($printDate_arr) == 3) {
         if (!checkdate($printDate_arr[0], $printDate_arr[1], $printDate_arr[2])) {
            $errors['printDateError'] = "Invalid Print Date.";
         }
      } else {
         $errors['printDateError'] = "Print Date is required.";
      }
   }

   if (empty($_POST['period'])) {
      $errors['periodError'] = "Period is required.";
   }



   if (empty($_POST['urgentlyRequired'])) {
      $errors['urgentlyRequiredError'] = "Required";
   }

   if (count($errors) > 0) {
      $_SESSION['errors'] = $errors;
      return TRUE;
   } else {
      unset($_SESSION['errors']);
      return FALSE;
   }
}

function test_input($data)
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
function emailValidation($email)
{
   $regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,10})$/";
   $email = strtolower($email);
   return preg_match($regex, $email);
}
