<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

if(isset($_POST['submit'])) {
	$stock = $_POST['stock'];
	$reasonid = $_POST['reasonid'];
	$qty = $_POST['qty'];
	$description = $_POST['description'];
	$productid = $_POST['productid'];
	$poid = $_POST['poid'];
	$pending_damage = $_POST['pending_damage'];
	$supplierid = $_POST['supplierid'];
	$id = $_POST['id'];

	$ctr = 0;

	if (empty($reasonid) || empty($qty) || empty($description)) {
		echo '<script>
			window.alert("Fill up all the fields.");
			window.location.href="po_return.php?id=' .$id. '";
			</script>';
	}

	else {
		$ctr ++;
	}

	if (filter_var($qty, FILTER_VALIDATE_INT) === 1 || !filter_var($qty, FILTER_VALIDATE_INT) === false) {
   		$ctr ++;
	} 
	else {
   echo '<script>
			window.alert("Input a valid number.");
			window.location.href="po_return.php?id=' .$id. '";
			</script>';
	}

	if($qty > $pending_damage) {
		echo '<script>
			window.alert("The quantity exceeded on the received item.");
			window.location.href="po_return.php?id=' .$id. '";
			</script>';
	}

	else {
		$ctr ++;
	}

	if($qty > 0) {
		$ctr ++;
	}
	else {
		echo '<script>
			window.alert("Input a number greater than zero.");
			window.location.href="po_return.php?id=' .$id. '";
			</script>';
	}


	if($qty > $stock) {
		echo '<script>
			window.alert("This stock is not available.");
			window.location.href="po_return.php?id=' .$id. '";
			</script>';
	}
	else {
		$ctr ++;
	}


	if ($ctr == 5) {

		$check_returned = $conn->query("SELECT * FROM returned_po2 WHERE POID='$poid'");
		if($check_returned->num_rows == 0) {
			$insert = $conn->query("INSERT INTO returned_po2(POID, SupplierID, DateAdded)
				VALUES('$poid', '$supplierid', '$da')");
		}

	

		$sql = "INSERT INTO returned_po(POID, ProductID, Qty, ReasonID, Description, Status, DateAdded, AddedBy)
		VALUES('$poid', '$productid', '$qty', '$reasonid', '$description', 'Pending', '$da', '$_SESSION[userid]');";

		$sql .= "UPDATE po SET ReceivedQty=ReceivedQty-'$qty', POStatus='Partially Received', ReturnedQty=ReturnedQty+'$qty'
			WHERE POID='$poid' AND ProductID='$productid';";

		$sql .= "UPDATE product SET Stock=Stock-'$qty'
			WHERE ProductID='$productid';";

		$sql .= "UPDATE po_total SET Status='Partially Received'
			WHERE POID='$poid'";		


		if($conn->multi_query($sql) === TRUE) {
			 echo '<script>
			window.alert("Successfully return item to supplier.");
			window.location.href="po_view2.php?poid=' .$poid. '";
			</script>';
		
		}

		else {
			echo 'ERROR: ' .$sql. '<br />' .$conn->error;
		}
	}

}

ob_end_flush();
?>