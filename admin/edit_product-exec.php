<?php
ob_start();
require('../connection.php');

if(isset($_POST['submit'])) {

    $productid = $_POST['productid'];

    $prodname = ucwords($_POST['prodname']);
    $categoryid = $_POST['categoryid'];
  
    $qtyid = $_POST['qtyid'];
    $threshold = $_POST['threshold'];
    $costprice = $_POST['costprice'];
    $markup = $_POST['markup'];
    $proddetail = $_POST['proddetail'];
    $old_pic = $_POST['old_pic'];

    
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

    //Image File
    $imgFile = $_FILES['prod_image']['name'];
    $tmp_dir = $_FILES['prod_image']['tmp_name'];
    $imgSize = $_FILES['prod_image']['size'];
    $errMSG = 0;

 if($imgFile)
        {
            $upload_dir = '../prodimage/'; // upload directory   
            $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
            $prod_image = rand(1000,1000000).".".$imgExt;
            if(in_array($imgExt, $valid_extensions))
            {           
                if($imgSize < 5000000)
                {
                    unlink($upload_dir.$old_pic);
                    move_uploaded_file($tmp_dir,$upload_dir.$prod_image);
                }
                else
                {
                     $errMSG++;
                    echo '<script>
                window.alert("Sorry, your file is too large it should be less then 5MB.");
                 window.location.href="product.php";
                </script>';

                   
                }
            }
            else
            {
                  $errMSG++;
                    echo '<script>
                window.alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
                 window.location.href="product.php";
                </script>';

                 
            }   
        }
        else
        {
            // if no image selected the old image remain as it is.
            $prod_image = $old_pic; // old image from database
        }   
        



    if ($errMSG == 0) {

    $update = "UPDATE product SET ProdName='$prodname', CategoryID='$categoryid', ProdDetail='$proddetail', Threshold='$threshold', CostPrice='$costprice', MarkUp='$markup', RetailPrice='$retailprice2', ProdImage='$prod_image', QtyID='$qtyid' WHERE ProductID='$productid'";


     if($conn->query($update) === TRUE) {
        echo '<script>
        window.alert("Successfully updated.");
        window.location.href="product.php";
        </script>';
    }

    else {
        echo 'Error: ' .$update. '<br />' .$conn->error;
    }
    }

    
}




ob_end_flush();
?>
                      
            
