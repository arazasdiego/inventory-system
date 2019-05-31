<?php
ob_start();
require('connection.php');
session_start();

echo '<script>
	window.alert("Before you proceed, register an account.");
	window.location.href="register.php";
	</script>';


ob_end_flush();
?>