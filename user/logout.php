<?php
ob_start();
session_start();


session_unset(); 
header('location: ../index.php');
ob_end_flush();
?>