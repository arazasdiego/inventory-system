<?php
session_start();
if(empty($_SESSION['userid'])) {
	header('location: ../index.php');
}

$user = $conn->query("SELECT u.Username, u.Password, u.Role, u.UserStatus, u.DateAdded, 
		ui.Fullname, ui.Contact, ui.Email, ui.Address, 
		ua.Inventory, ua.PO, ua.Orders, ua.Reports, ua.Settings
		FROM user AS u
		INNER JOIN user_info AS ui ON u.UserID=ui.UserID
		INNER JOIN user_access AS ua ON u.UserID=ua.UserID
		AND u.UserID='$_SESSION[userid]'");
$urow = $user->fetch_assoc();
 
?>