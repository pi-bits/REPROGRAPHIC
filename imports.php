<?php
ini_set('display_errors', false);
ini_set('error_log', '/Applications/MAMP/logs/php_error.log');
session_start();
unset($_SESSION['errors']);
require './upload.php';
require './includes/referenceDataConfig.php';
require "./login.php";
?>