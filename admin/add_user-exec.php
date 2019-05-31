<?php
ob_start();
require('../connection.php');
require('session.php');
require('../date.php');

if(isset($_POST['submit'])) {
	$fullname = $_POST['fullname'];
	$contact = $_POST['contact'];
	$address = $_POST['address'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];


	if(!isset($_POST['inventory'])) {
		$inventory = 0;
	}	
	else {										
		$inventory = 1;
	}


	if(!isset($_POST['po'])) {
		$po = 0;
	}	
	else {										
		$po = 1;
	}


	if(!isset($_POST['orders'])) {
		$orders = 0;
	}	
	else {										
		$orders = 1;
	}


	if(!isset($_POST['reports'])) {
		$reports = 0;
	}	
	else {										
		$reports = 1;
	}


	if(!isset($_POST['settings'])) {
		$settings = 0;
	}	
	else {										
		$settings = 1;
	}

	

	$ctr = 0;

	$user_check = $conn->query("SELECT * FROM user WHERE Username='$username'");
	if($user_check->num_rows > 0) {
		echo '<script>
			window.alert("Username already used.");
			window.location.href="user.php";
			</script>';
	}
	else {
		$ctr ++;
	}

	if($ctr == 1) {
		//UserID
		$sql35 = $conn->query("SELECT * FROM user");
		$count35 = $sql35->num_rows;
		$numbers35 = rand(10,1000);
		$userid = 'USER-' .$numbers35. '-' .$count35;

		 //Trail Message
   	 	$message = 'Added a new user (' .$fullname. ').';

		$insert = "INSERT INTO user(UserID, Username, Password, Role, UserStatus, DateAdded, UserDelete)
			VALUES('$userid', '$username', '$password', 'Admin', 'Active', '$da', '0');";


		$insert .= "INSERT INTO user_info(UserID, Fullname, Contact, Email, Address)
			VALUES('$userid', '$fullname', '$contact', '$email', '$address');";	


		$insert .= "INSERT INTO user_access(UserID, Inventory, PO, Orders, Reports, Settings)
			VALUES('$userid', '$inventory', '$po', '$orders', '$reports', '$settings');";


		$insert .= "INSERT INTO trail(UserID, ID, Message, DateCreated)
    		VALUES('$_SESSION[userid]', '$userid', '$message', '$da')";

    	if($conn->multi_query($insert) === TRUE) {
    		echo '<script>
			window.alert("Successfully created a user.");
			window.location.href="user.php";
			</script>';
    	}
    	else {
    		echo 'Error: ' .$insert, '<br />' .$conn->error;
    	}	

	}

}

ob_end_flush();
?>

