<?php
ob_start();
require('connection.php');
require('date.php');
session_start();

	
$passkey=$_GET['passkey'];



$sql1 = $conn->query("SELECT * FROM temp_member WHERE confirm_code='$passkey'");
$rows = $sql1->fetch_assoc(); 


$email = $rows['Email'];
$password = $rows['Password'];
$contact = $rows['Contact'];
$fullname = $rows['Fullname'];
$address = $rows['Address']; 

$sql22 =  $conn->query("SELECT * FROM user_info");
$count22 = $sql22->num_rows;
$numbers22 = rand(10,1000);
$userid = 'USER-' .$numbers22. '-' .$count22;

//CART
$total=0;
$totalqty=0;
foreach ($_SESSION["cart_products"] as $cart_itm) {
    $product_name = $cart_itm["product_name"];
    $product_qty = $cart_itm["product_qty"];
    $product_price = $cart_itm["product_price"];
    $productid = $cart_itm["productid"];
    $product_price = $cart_itm["product_price"];
    $product_image = $cart_itm["product_image"];

    $subtotal = ($product_price * $product_qty); //calculate Price x Qty

    $total = ($total + $subtotal); //add subtotal to total var
           
    $orderinsert = $conn->query("INSERT INTO cart(UserID, ProductID, Qty, Price, Total, DateCreated)

        VALUES('$userid', '$productid', '$product_qty', '$product_price', '$subtotal', '$da')");
       
       $totalqty = $product_qty + $totalqty;
            
    }
//END CART


$insert1 = $conn->query("INSERT INTO user(UserID, Username, Password, Role, UserStatus, DateAdded, UserDelete)
            VALUES('$userid', '$email', '$password', 'User', 'Active', '$da', '0')");

$insert2 = $conn->query("INSERT INTO user_info(UserID, Fullname, Contact, Email, Address)
            VALUES('$userid', '$fullname', '$contact', '$email', '$address')");
			

		unset($_SESSION['cart_products']);
        unset($_SESSION['subamount']);
        unset($_SESSION['grandamount']);

        
$delete = $conn->query("DELETE FROM temp_member WHERE confirm_code='$passkey'");

  

echo"<script>alert('Your account has been activated! You can now login.');window.location.href='index.php'; 
	
	
	</script>";












?>




<?php ob_end_flush(); ?>
	
	

	
	
	
	