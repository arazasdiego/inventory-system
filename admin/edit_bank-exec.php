<?php
ob_start();
require('../connection.php');

if(isset($_POST['submit'])) {
	$bankid = $_POST['bankid'];
	$bankname = $_POST['bankname'];
	$accountname = $_POST['accountname'];
	$accountnumber = $_POST['accountnumber'];
	$ctr = 0;

	if(empty($bankname) || empty($accountname) || empty($accountnumber)){
		echo '<script>
			window.alert("All field cannot be empty.");
			window.location.href="bank.php";
			</script>';
	}
	else {
		$ctr ++;
	}

	if($ctr == 1) {
		$update = "UPDATE bank SET BankName='$bankname', AccountName='$accountname', AccountNumber='$accountnumber'
			WHERE BankID='$bankid'";
		if($conn->query($update) === TRUE) {
			echo '<script>
			window.alert("Successfully updated.");
			window.location.href="bank.php";
			</script>';
		}
		else {
			echo 'Error ' .$update. '<br />' .$conn->error;
		}	
	}
}

ob_end_flush();
?>