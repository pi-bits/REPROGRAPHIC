<?php
require './email.php';
require './includes/constants.php';
require './includes/referenceDataConfig.php';

$filesToEmail = array();
if (isset($_POST["submit"])) {
   $GLOBALS['IsEmailSent'] = false;
   if (!hasErrors($filesToEmail,$PRINT_TYPE_CONFIG, $DEPARTMENT_CONFIG, $PERIOD_CONFIG)) {
         sendEmail($filesToEmail);
   }
}

function sendEmail(&$filesToEmail)
{ 
   $printType = "Default Prints";

   if (!empty($_POST['check_list'])) {
      $printType="";
      foreach ($_POST['check_list'] as $selected) {
         $printType .=  $selected . ",";
      }
   } 
   $firstName =  $_POST["firstname"];
   $fromEmail =  $_POST["fromEmail"];
   $department = $_POST["department"];
   $printCopies =  $_POST["printCopies"];
   $dateRequired  = date("d-M-Y", strtotime($_POST["Dates"]));
   $period = $_POST["period"];
   $urgentlyRequired = $_POST["urgentlyRequired"];

   /**
    * Options: null (default), 1 = High, 3 = Normal, 5 = low. When null, the header is not set at all.
    */
   $priority = $urgentlyRequired == 'Yes' ? 1 : 3;
   $specialRequirement = $_POST["specialRequirement"];
   $url = $_POST["url"];
   $body = buildEmailBody($firstName, $department, $printCopies, $dateRequired, $period, $urgentlyRequired, $printType, $specialRequirement, $url, $fromEmail);
   $subject = 'Reprographic Requirement for : ' . $firstName;

   $emailSender  = new EmailSender();
   try{
      $emailSender->send($subject, $body, $filesToEmail, $priority, $fromEmail);
      $GLOBALS['IsEmailSent'] = true;
   }
   catch(Exception $e){
         $GLOBALS['IsEmailSent'] = false;
   }
}
function buildEmailBody($firstName, $department, $printCopies, $dateRequired, $period, $urgentlyRequired, $printType, $specialRequirement, $url, $fromEmail)
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
                   <tr>
                     <th>URL for print copies</th>
                     <td>' . $url . '</td>
                   </tr>
                 </table>
                 <br/>
                 </body>
                           </html>';
}
function hasErrors(&$filesToEmail,$PRINT_TYPE_CONFIG, $DEPARTMENT_CONFIG, $PERIOD_CONFIG)
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
            $tmp =explode('.', $fileName);
            $file_ext = strtolower(end($tmp));
            $extensions = array("jpeg", "xlsm", "jpg", "png", "docx", "pdf", "xlsx", "pptx", "ppt", "pub", "odt", "doc", "rtf", "tex", "txt", "wks", "wps", "wpd", "ods", "xlr", "xls", "key", "odp", "pps", "ai", "bmp", "gif", "ico", "ps", "psd", "svg", "tif", "tiff", "fnt", "fon", "otf", "ttf", "csv", "dat", "db", "dbf", "log", "mdb", "sav", "sql", "tar", "xml", "zip", "z", "rpm", "rar", "pkg", "deb", "arj", "7z");
            if (!in_array($file_ext, $extensions) === false) {
               if ($file_error === 0) {
                  /** 10MB Max file size*/
                  error_log("File size  : ".$file_size. " for file :" .$fileName);
                  if ($file_size <= 10485760) {
                     $file_name_new = uniqid('', true) . '.' . $file_ext;
                     $destinationPath = getcwd() . DIRECTORY_SEPARATOR . 'uploads';
                     if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                     }

                     $fileDestination =  getcwd() . DIRECTORY_SEPARATOR . 'uploads/' . $file_name_new;
                     if (move_uploaded_file($file_tmp, $fileDestination)) {
                        $filesToEmail[$fileName] = $fileDestination;
                     } else {
                        $failed[$position] = "[{$fileName}] failed to upload.";
                        error_log("[{$fileName}] failed move file - check permissions.");
                     }
                  } else {
                     $failed[$position] = "[{$fileName}]  $file_size file is too large.";
                     error_log("[{$fileName}]  $file_size file is too large.");
                  }
               } else {
                  $failed[$position] = "[{$fileName}] failed to upload. {$file_error}";
                  error_log("[{$fileName}] failed to upload. {$file_error}");
               }
            } else {
               $failed[$position] = "[{$fileName}] file extension '{$file_ext}' is not allowed.";
               error_log("[{$fileName}] file extension '{$file_ext}' is not allowed.");
            }
         }
      }
      if (!empty($failed)) {
         foreach ($failed as $key => $value) {
            $errors['uploadDocumentError'] = $failed[$key];
         }
      }
   }

   if (empty($_POST['department']) &&  !in_array($_POST['department'], $DEPARTMENT_CONFIG)) {
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
   
   if (!isset($_POST['check_list[]'])) {
      foreach ( (array)isset($_POST['check_list[]']) as $value){
         if(!in_array($value, $PRINT_TYPE_CONFIG)){
            $errors['printConfiguration'] = "Invalid Selection for Print Types.";
            return;
         }
      }

      
   }
   if (empty($_POST['period']) && !in_array($_POST['period'], $PERIOD_CONFIG)) {
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
