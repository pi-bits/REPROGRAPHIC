<?php
session_start();
unset($_SESSION['errors']);
require './upload.php';
require './includes/referenceDataConfig.php';
require "./login.php";
?>