<?php
ob_start();
require('../connection.php');

if(isset($_POST['submit'])) {
	$bankname = $_POST['bankname'];
	$accountname = $_POST['accountname'];
	$accountnumber = $_POST['accountnumber'];

	$ctr = 0;

	$check = "SELECT * FROM bank WHERE BankName='$bankname'";
	if($conn->query($check)->num_rows > 0) {
		echo '<script>
			window.alert("Bank name is already on the records.");
			window.location.href="bank.php";
			</script>';
	}
	else{
		$ctr ++;
	}

	if($ctr == 1) {
		$insert = "INSERT INTO bank(BankName, AccountName, AccountNumber, BankDelete)
			VALUES('$bankname', '$accountname', '$accountnumber', '0')";
		if($conn->query($insert) === TRUE) {
			echo '<script>
			window.alert("Successfully added.");
			window.location.href="bank.php";
			</script>';
		}
		else {
			echo 'Error ' .$insert. '<br />' .$conn->error;
		}
	}

}


ob_end_flush();
?>