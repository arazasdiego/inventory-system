<?php
session_start();
if(empty($_SESSION['userid'])) {
	header('location: ../index.php');
}

$user = $conn->query("SELECT ui.Fullname, ui.Contact, ui.Email, ui.Address, 
	u.Username, u.Password, u.Role, u.UserStatus

	FROM user_info AS ui 
	INNER JOIN user AS u ON ui.UserID=u.UserID
	AND ui.UserID='$_SESSION[userid]'");
$urow = $user->fetch_assoc(); 


?>