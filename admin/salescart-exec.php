<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

if(isset($_POST['submit'])) {
	$amountpaid = $_POST['amountpaid'];
	$subamount = $_POST['subamount'];
	$grandamount = $_POST['grandamount'];
	$discountedamount = $_POST['discountedamount'];
	$amountpayable = $_POST['amountpayable'];

	$tankctr = 0;

	if(empty($_SESSION['mobile'])) {
		$_SESSION['mobile'] = 'Null';
	}

	if(empty($_SESSION['completeaddress'])) {
		$_SESSION['completeaddress'] = 'Null';
	}

	$ctr = 0;
	$pctr = 0;

	if (filter_var($amountpaid, FILTER_VALIDATE_INT) === 0 || !filter_var($amountpaid, FILTER_VALIDATE_INT) === false) {
   		$ctr ++;
	} 
	else {
    	echo '<script>
			window.alert("Please enter a valid number.");
			window.location.href="salescart.php";
			</script>';
	}

	if($amountpaid >= 0) {
		$ctr ++;
	}
	else {
		echo '<script>
			window.alert("Do not input negative value.");
			window.location.href="salescart.php";
			</script>';
	}

	if($ctr == 2) {

	//OrdersID
	$sql = $conn->query("SELECT * FROM orders_total
		");
	$count = $sql->num_rows;
	$numbers = rand(1,100);
	$ordersid = 'ORD-' .$numbers. '-' .$count;

	//BillingID
    $sql3 = $conn->query("SELECT * FROM billing_detail
        ");
    $count3 = $sql3->num_rows;
    $numbers3 = rand(10,100);
    $billingid = 'BILL-' .$numbers3. '-' .$count3;

    //ORNum
    $ornumctr = $year * 1000;
    $ornum = $ornumctr + $count;



    if($amountpaid >= $amountpayable) {
    	$paymentstatus = 'Paid';
    	$amountchange = $amountpaid - $amountpayable;
    	$orderstatus = 'Completed';
    	$pctr++;

    }
    else if ($amountpaid == 0){
    	$paymentstatus = 'Not Paid';
    	$amountchange = 0;
    	$orderstatus = 'Pending'; 
    }
    else {
    	$paymentstatus = 'Partially Paid';
    	$amountchange = 0; 
    	$orderstatus = 'Being Prepared';
    	$pctr++;
    }

    $ordtotal = $conn->query("INSERT INTO orders_total(OrdersID, SubAmount, DiscountedAmount, GrandAmount, AmountPayable, AmountChange, BillingID, PaymentType, AmountPaid, DiscountID, DateOrdered, OrderStatus, PaymentStatus, DeliveryStatus, TransactionType, PreparedBy, OrderBy, OrderType, PickedupStatus, WalkinStatus, ReturnedStatus, DeliveryCharge, OrdersDelete, DateFinished, ORNum)


		VALUES('$ordersid', '$subamount', '$discountedamount', '$grandamount', '$amountpayable', '$amountchange', '$billingid', 'Cash', '$amountpaid', '$_SESSION[discountid]', '$da', '$orderstatus', '$paymentstatus', 'Null', 'Walkin', '$_SESSION[userid]', '$billingid', 'Walkin', 'Null', 'Completed', '0', '0', '0', 'Null', '$ornum')");

   

    if($pctr > 0) {
    	 $payment_insert = $conn->query("INSERT INTO payment(OrdersID, Amount, PaymentType, DatePaid, ReceivedBy)
    	 	VALUES('$ordersid', '$amountpaid', 'Cash', '$da', '$_SESSION[userid]')");
    }
   


		//Insert cart items to orders
		$cart = $conn->query("SELECT sc.ID, sc.ProductID, sc.Price, sc.Qty, sc.TotalPrice, sc.UserID, 
			p.CategoryID,
			c.CategoryReturned
		 	FROM sales_cart AS sc
		 	INNER JOIN product AS p ON sc.ProductID=p.ProductID
		 	INNER JOIN category AS c ON p.CategoryID=c.CategoryID
		 	AND sc.UserID='$_SESSION[userid]'");
	

		while($cart_item = $cart->fetch_assoc()) {
			//tanks insert
			if($cart_item['CategoryReturned'] == 1) {
				
				$tankctr ++;

				$tankscheck = $conn->query("SELECT * FROM tanks 
				WHERE OrdersID='$ordersid' AND ProductID='$cart_item[ProductID]'");
					if($tankscheck->num_rows > 0) {
						$update_tanks = $conn->query("UPDATE tanks SET Qty='$cart_item[Qty]'
						WHERE OrdersID='$ordersid' AND ProductID='$cart_item[ProductID]'");
					}
					else {
						$tank_insert = $conn->query("INSERT INTO tanks(OrdersID, ProductID, Qty, Status, ReturnedQty)
						VALUES('$ordersid', '$cart_item[ProductID]', '$cart_item[Qty]', 'Pending', '0')");
					}
			}

			$orders_insert = $conn->query("INSERT INTO orders(OrdersID, ProductID, OrderedQty, Price, TotalPrice, WalkinQty, WalkinStatus, PaymentStatus, DeliveredQty, PickedupQty, DeliveryStatus, PickedupStatus, ReturnedQty)


				VALUES('$ordersid', '$cart_item[ProductID]', '$cart_item[Qty]', '$cart_item[Price]', '$cart_item[TotalPrice]', '$cart_item[Qty]', 'Completed', '$paymentstatus', '0', '0', 'Null', 'Null', '0')");

			$update_stock= $conn->query("UPDATE product SET Stock=Stock-'$cart_item[Qty]'
				WHERE ProductID='$cart_item[ProductID]'");
			if($amountpaid >= $amountpayable) {

				$log_update = $conn->query("UPDATE inventorylog SET TotalStockSold=TotalStockSold + '$cart_item[Qty]', TotalSales=TotalSales + '$cart_item[TotalPrice]'
				WHERE ProductID='$cart_item[ProductID]'");	
			}

		}


		$deletecart = $conn->query("DELETE FROM sales_cart WHERE UserID='$_SESSION[userid]'");

		if($tankctr > 0) {
			
			$tanks_total = $conn->query("INSERT INTO tanks_total(OrdersID, DateAdded, Status)
		VALUES('$ordersid', '$da', 'Pending')");
		}
		

		 $billing_detail = "INSERT INTO billing_detail(BillingID, CustomerName, Mobile, Email, CompleteAddress, OrdersID)
    	VALUES('$billingid', '$_SESSION[customername]', '$_SESSION[mobile]', 'Null', '$_SESSION[completeaddress]', '$ordersid')";

    	if($conn->query($billing_detail) === TRUE) {

    		unset($_SESSION['customername']);
		unset($_SESSION['cityname']);
		unset($_SESSION['mobile']);
		unset($_SESSION['completeaddress']);
		
		unset($_SESSION['discountid']);

		echo '<script>
				window.alert("Successfully ordered.");
				window.location.href="sales.php";
				</script>';

    	}

    	else {
    		echo 'Error: ' .$billing_detail. '<br />' .$conn->error;
    	}


		

	}

}


ob_end_flush();
?>