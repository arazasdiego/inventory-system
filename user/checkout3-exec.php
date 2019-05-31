<?php
ob_start();
require('../connection.php');
require('session.php');
require('../date.php');

if(isset($_POST['submit'])) {
    $subamount = $_POST['subamount'];
    $complete_address = $urow['Address']. '-' .$_SESSION['cityname'];
    
    //OrdersID
    $sql = $conn->query("SELECT * FROM orders_total
        ");
    $count = $sql->num_rows;
    $numbers = rand(10,100);
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

    if($_SESSION['transactiontype'] == 'Delivery') {
        $deliverystatus = 'Processing';
        $pickedupstatus = 'Null';
        $deliverystatus2 = 'Pending';
        $pickedupstatus2 = 'Null';
    }   

    if($_SESSION['transactiontype'] == 'Pickup') {
        $deliverystatus = 'Null';
        $pickedupstatus = 'Processing';
        $deliverystatus2 = 'Null';
        $pickedupstatus2 = 'Pending';
    }

    //For bank deposit
    if($_SESSION['payment_type'] == 'Bank Deposit') {
        //Image File
        $imgFile = $_FILES['deposit_slip']['name'];
        $tmp_dir = $_FILES['deposit_slip']['tmp_name'];
        $imgSize = $_FILES['deposit_slip']['size'];
        $errMSG = 0;

        $upload_dir = '../deposit slip/'; //upload directory

        $img_ext = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); //get image extension

        $valid_extensions = array('jpeg', 'gif', 'png', 'jpg'); //valid extensions

        //rename uploading image
        $deposit_slip = rand(100, 1000000) .'.'. $img_ext; 

        //allow valid image format
        if (in_array($img_ext, $valid_extensions)) {
        //Check file size 5mb
            if ($imgSize < 5000000) {
                move_uploaded_file($tmp_dir, $upload_dir. $deposit_slip);
            }
            else {
                $errMSG++;
                echo '<script>
                window.alert("Sorry, your file is too large.");
                window.location.href="checkout3.php";
                </script>';
            }
        }    

        else {
            $errMSG++;
            echo '<script>
            window.alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            window.location.href="checkout3.php";
            </script>';


        }
        //IMAGE END UPLOAD

      
        if($errMSG == 0) {
         //INSERT deposit_slip
        $insert = $conn->query("INSERT INTO payment_slip(OrdersID, DepositSlip, DatePaid)
            VALUES('$ordersid', '$deposit_slip', '$da')");
        }


    }



    //Insert cart items to orders
    $cart = $conn->query("SELECT * FROM cart 
        WHERE UserID='$_SESSION[userid]'");
    while($cart_item = $cart->fetch_assoc()) {


        $query = $conn->query("INSERT INTO orders(OrdersID, ProductID, OrderedQty, Price, TotalPrice, PaymentStatus, DeliveryStatus, PickedupStatus, DeliveredQty, PickedupQty, WalkinQty, ReturnedQty, WalkinStatus)
                VALUES('$ordersid', '$cart_item[ProductID]', '$cart_item[Qty]', '$cart_item[Price]', '$cart_item[Total]', 'Not Paid', '$deliverystatus2', '$pickedupstatus2', '0', '0', '0', '0', 'Null')");



            if($query === FALSE) {
                echo 'Error ' .$query. '<br />' .$conn->error;
            }
    }


        //INSERT BILLING
         $insert1 = $conn->query("INSERT INTO billing_detail(BillingID, CustomerName, Email, Mobile, CompleteAddress, OrdersID)
        VALUES('$billingid', '$urow[Fullname]', '$urow[Email]', '$urow[Contact]', '$complete_address', '$ordersid')");
        

       
         //DELETE CART
        $delete = $conn->query("DELETE FROM cart
        WHERE UserID='$_SESSION[userid]'");

       


             //INSERT Orders ToTAL
        $insert2 = "INSERT INTO orders_total(OrdersID, SubAmount, DeliveryCharge, GrandAmount, OrderBy, PaymentType, OrderStatus, PaymentStatus, DeliveryStatus, TransactionType, BillingID, AmountPayable, OrderType, PickedupStatus, AmountChange, AmountPaid, ReturnedStatus, WalkinStatus, DiscountID, DiscountedAmount, PreparedBy, OrdersDelete, DateOrdered, DateFinished, ORNum)

        VALUES('$ordersid', '$subamount', '$_SESSION[delivery_fee]', '$_SESSION[grandamount]', '$_SESSION[userid]', '$_SESSION[payment_type]', 'Pending', 'Not Paid', '$deliverystatus', '$_SESSION[transactiontype]', '$billingid', '$_SESSION[amountpayable]', 'Online', '$pickedupstatus', '0', '0', '0', 'Null', '3', '0', 'SUPERADMIN', '0', '$da', 'Null', '$ornum')";

        if($conn->query($insert2) == TRUE) {
            unset($_SESSION['grandamount']);
            unset($_SESSION['delivery_fee']);
            unset($_SESSION['payment_type']);
            unset($_SESSION['transactiontype']);
            unset($_SESSION['cityname']);



            echo '<script>
        window.alert("Successfully placed an order. Please make sure that you give the correct information. Check online for your order.");
        window.location.href="customer_orders.php";
        </script>
        ';
        }

        else {
            echo 'Error: ' .$insert2. '<br />' .$conn->error;
        }



            


    
  
    
   
    
    



   

    
   
}

ob_end_flush();
?>