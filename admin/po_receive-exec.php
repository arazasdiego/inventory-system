<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

if(isset($_POST['submit'])) {
	$productid = $_POST['productid'];
	$poid = $_POST['poid'];
	$id = $_POST['id'];
	$pending = $_POST['pending'];
	$receiveqty = $_POST['receiveqty'];

	$ctr = 0;

	if (filter_var($receiveqty, FILTER_VALIDATE_INT) === 1 || !filter_var($receiveqty, FILTER_VALIDATE_INT) === false) {
   		$ctr ++;
	} 
	else {
    echo '<script>
			window.alert("Input a valid number.");
			window.location.href="po_receive.php?id=' .$id. '&poid=' .$poid. '";
			</script>';
	}

	

	if($receiveqty > 0) {
		$ctr ++;
	}
	else {
		echo '<script>
			window.alert("Input a number greater than zero.");
			window.location.href="po_receive.php?id=' .$id. '&poid=' .$poid. '";
			</script>';
	}


	if($ctr == 2) {

		$product = $conn->query("SELECT * FROM product WHERE ProductID='$productid'");
		$prodrow = $product->fetch_assoc();

		$pototal = $conn->query("SELECT 
		pot.POID, pot.SupplierID, s.SupplierName
		FROM po_total AS pot
		INNER JOIN supplier AS s ON pot.SupplierID=s.SupplierID
		AND pot.POID='$poid'");
		$potrow = $pototal->fetch_assoc();


		//Trail Message
   	 	$message = 'Received ' .$receiveqty. ' unit(s) of ' .$prodrow['ProdName']. ' from ' .$potrow['SupplierName']. '.';

   	 	$trailinsert = $conn->query("INSERT INTO trail(UserID, ID, Message, DateCreated)
   	 		VALUES('$_SESSION[userid]', '$productid', '$message', '$da')");

		if($receiveqty >= $pending) {
			$update = "UPDATE product SET Stock=Stock + '$receiveqty'
			WHERE ProductID='$productid';";

			$update .= "UPDATE inventorylog SET TotalReceivedPO=TotalReceivedPO + '$receiveqty'
				WHERE ProductID='$productid';";

			$update .="UPDATE po SET ReceivedQty=ReceivedQty+ '$receiveqty', POStatus='Completed'
			WHERE ID='$id'";

			if($conn->multi_query($update) === TRUE) {
			echo '<script>
			window.alert("Received.");
			window.location.href="po_receive-exec2.php?poid=' .$poid. '&id=' .$id. '";
			</script>';
			}
			else {
			echo 'ERROR: ' .$update. '<br />'. $conn->error;
			}
		}


		else {
			$update = "UPDATE product SET Stock=Stock + '$receiveqty'
			WHERE ProductID='$productid';";

			$update .= "UPDATE inventorylog SET TotalReceivedPO=TotalReceivedPO + '$receiveqty'
				WHERE ProductID='$productid';";
			
			$update .="UPDATE po SET ReceivedQty=ReceivedQty+ '$receiveqty', POStatus='Partially Received'
			WHERE ID='$id'";

			if($conn->multi_query($update) === TRUE) {
			echo '<script>
			window.alert("Partially received.");
			window.location.href="po_receive-exec2.php?id=' .$id. '&poid=' .$poid. '";
			</script>';
			}
			else {
			echo 'ERROR: ' .$update. '<br />'. $conn->error;
			}
		}

		
	}
}


ob_end_flush();
?>