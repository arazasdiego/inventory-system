<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

if(isset($_POST['submit'])) {
    $suppliername = ucwords($_POST['suppliername']);
    $contact = $_POST['contact'];
    $email = $_POST['email'];

    //SupplierID
    $sql_query = $conn->query("SELECT * FROM supplier");
    $count = $sql_query->num_rows;
    $numbers = rand(10, 100);
    $supplierid = 'SUP-' .$numbers. '-' .$count;

    //Trail Message
    $message = 'Added a supplier (' .$suppliername. ').';

    $check = $conn->query("SELECT * FROM supplier WHERE SupplierName='$suppliername' AND SupplierDelete=0");


    if($check->num_rows > 0) {
        echo '<script>
        window.alert("Supplier already exist.");
        window.location.href="supplier.php"
        </script>';
    }

    else {

        $insert = "INSERT INTO supplier(SupplierID, SupplierName, Contact, Email, SupplierStatus, SupplierDelete)
        VALUES('$supplierid', '$suppliername', '$contact', '$email', 'Active', '0');";

        $insert .= "INSERT INTO trail(ID, UserID, Message, DateCreated)
        VALUES('$supplierid', '$_SESSION[userid]', '$message', '$da')";

        if($conn->multi_query($insert) === TRUE) {
            echo '<script>
            window.alert("Successfully added.");
            window.location.href="supplier.php";
            </script>';
        }
        else {
            echo 'ERROR: ' .$insert. '<br />'. $conn->error;
        }
    }
}

ob_end_flush();
?>