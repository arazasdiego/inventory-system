<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

if(isset($_POST['submit'])) {

    error_reporting( ~E_NOTICE ); // avoid notice

    $prodname = ucwords($_POST['prodname']);
    $categoryid = $_POST['categoryid'];
   
    $qtyid = $_POST['qtyid'];
    $threshold = $_POST['threshold'];
    $costprice = $_POST['costprice'];
    $markup = $_POST['markup'];
    $proddetail = $_POST['proddetail'];
    


    if(empty($costprice)) {
        $costprice = 0;
    }

    //FORMULA FOR MARKUP
    $MarkUpTemp1 = $markup / 100;
    $MarkUpTemp2 = $costprice * $MarkUpTemp1;
    $retailprice = $costprice + $MarkUpTemp2;

    //VAT
    $vat = $conn->query("SELECT * FROM vat WHERE ID=1");
    $vatrow = $vat->fetch_assoc();

    $vatable = ($vatrow['Value'] / 100) + 1;
    $vatable_sales = $retailprice / $vatable;
    $vat = ($vatrow['Value'] / 100) * $vatable_sales; 

    $retailprice2 = $retailprice + $vat;


    //Trail Message
    $message = 'Added a new product (' .$prodname. ').';

    //ProductID
    $sql_query = $conn->query("SELECT * FROM product");
    $count = $sql_query->num_rows;
    $numbers = rand(10, 100);
    $productid = 'PROD-' .$numbers. '-' .$count;


    //Image File
    $imgFile = $_FILES['prod_image']['name'];
    $tmp_dir = $_FILES['prod_image']['tmp_name'];
    $imgSize = $_FILES['prodimage']['size'];
    $errMSG = 0;

    $upload_dir = '../prodimage/'; //upload directory

    $img_ext = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); //get image extension

    $valid_extensions = array('jpeg', 'gif', 'png', 'jpg'); //valid extensions

    //rename uploading image
    $prod_image = rand(100, 1000000) .'.'. $img_ext; 

    //allow valid image format
    if (in_array($img_ext, $valid_extensions)) {
        //Check file size 5mb
        if ($imgSize < 5000000) {
            move_uploaded_file($tmp_dir, $upload_dir. $prod_image);
        }
        else {
            $errMSG++;
            echo '<script>
            window.alert("Sorry, your file is too large.");
            window.location.href="product.php";
            </script>';
        }
    }    

    else {
        $errMSG++;
         echo '<script>
            window.alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            window.location.href="product.php";
            </script>';
    }

    $check = $conn->query("SELECT * FROM product WHERE ProdName='$prodname' AND ProductDelete=0");
    if ($check->num_rows > 0) {
        $errMSG++;

         echo '<script>
            window.alert("The product name already used.");
            window.location.href="product.php";
            </script>';
    }


    if($costprice > -1) {

    }
    else {
        $errMSG++;
         echo '<script>
            window.alert("The costprice cannot be negative.");
            window.location.href="product.php";
            </script>';
    }

   

    if($threshold > 0) {

    }
    else {
        $errMSG++;
         echo '<script>
            window.alert("The threshold must be greater than zero.");
            window.location.href="product.php";
            </script>';
    }

    if($markup > 0) {

    }
    else {
        $errMSG++;
         echo '<script>
            window.alert("The markup must be greater than zero.");
            window.location.href="product.php";
            </script>';
    }


    if ($errMSG == 0) {

        $insert = "INSERT INTO product(ProductID, ProdName, CategoryID, ProdDetail, Threshold, CostPrice, MarkUp, RetailPrice, ProdImage, DateAdded, QtyID, ProdStatus, Stock, ProductDelete)
    VALUES('$productid', '$prodname', '$categoryid', '$proddetail', '$threshold', '$costprice', '$markup', '$retailprice2', '$prod_image', '$da', '$qtyid', 'Active', '0', '0');";

    $insert .= "INSERT INTO inventorylog(ProductID, TotalStock, DateCreated, CreatedBy, TotalReceivedPO, TotalDamaged, TotalStockSold, TotalSales)
    	VALUES('$productid', '0', '$da', '$_SESSION[userid]', '0', '0', '0', '0');";
    
    $insert .= "INSERT INTO trail(UserID, ID, Message, DateCreated)
    VALUES('$_SESSION[userid]', '$productid', '$message', '$da')";

    if($conn->multi_query($insert) === TRUE) {
        echo '<script>
        window.alert("Product successfully added.");
        window.location.href="product.php";
        </script>';
    }

    else {
        echo 'Error: ' .$insert. '<br />' .$conn->error;
    }
    }

    
}


ob_end_flush();
?>
                      
            
