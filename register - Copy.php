<?php
ob_start();
require('connection.php');
require('date.php');
session_start();


if(empty($_SESSION['userid']) === TRUE){
        $_SESSION['userid'] = '';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Obaju e-commerce template">
    <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz">
    <meta name="keywords" content="">

    <title>
       LPG Ville Trading Shop
    </title>


    <meta name="keywords" content="">

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>

    <!-- styles -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">

    <!-- theme stylesheet -->
    <link href="css/style.default.css" rel="stylesheet" id="theme-stylesheet">

    <!-- your stylesheet with modifications -->
    <link href="css/custom.css" rel="stylesheet">

    <script src="js/respond.min.js"></script>

    <link rel="shortcut icon" href="favicon.png">

 
    <style type="text/css">
        
.wrapper{
    //padding-top: 20px;
    padding-top: 50px;
}

input.parsley-error,
select.parsley-error,
textarea.parsley-error {    
    border-color:#843534;
    box-shadow: none;
}


input.parsley-error:focus,
select.parsley-error:focus,
textarea.parsley-error:focus {    
    border-color:#843534;
    box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 6px #ce8483
}


.parsley-errors-list {
    list-style-type: none;
    opacity: 0;
    transition: all .3s ease-in;

    color: #d16e6c;
    margin-top: 5px;
    margin-bottom: 0;
  padding-left: 0;
}

.parsley-errors-list.filled {
    opacity: 1;
    color: #a94442;
}
</style>

</head>

<body>
   <?php
    require('topbar.php');
    ?>

    <!-- *** NAVBAR ***
 _________________________________________________________ -->

    <div class="navbar navbar-default yamm" role="navigation" id="navbar">
        <div class="container">
            <div class="navbar-header">

                <a class="navbar-brand home" href="index.php" data-animate-hover="bounce">
                    <h3>LPGVILLE</h3><span class="sr-only">LPGVILLE - go to homepage</span>
                </a>
               
            </div>
            <!--/.navbar-header -->

    <div class="navbar-collapse collapse" id="navigation">
    <ul class="nav navbar-nav navbar-left">
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="shop.php">Shop</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
        <?php 
        if(!empty($_SESSION['userid'])) {
             echo '<li><a href="customer_orders.php">My Order</a></li>';
        }
        ?>

    </ul>
    </div>
    <!--/.nav-collapse -->

    <div class="navbar-buttons">
     <?php

$ctr = 0;
$totalqty = 0;
if(isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"])>0) {

        foreach ($_SESSION["cart_products"] as $cart_itm)
        {
            //set variables to use in content below
           
            $product_qty = $cart_itm["product_qty"];
          
            $totalqty = $product_qty + $totalqty;

        }
$ctr = count($_SESSION["cart_products"]);
 
}

    if($ctr > 0) {
        echo '

<div class="navbar-collapse collapse right" id="basket-overview">
<a href="basket.php" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span class="hidden-sm">' .$totalqty. ' item(s)</span></a>
</div>

';
    }
    ?>
    </div>

          
            <!--/.nav-collapse -->

        </div>
        <!-- /.container -->
    </div>
    <!-- /#navbar -->

    <!-- *** NAVBAR END *** -->

    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="index.php">Home</a>
                        </li>
                        <li>New account / Sign in</li>
                    </ul>

                </div>

                <div class="col-md-6">
                    <div class="box">
                        <h1>New account</h1>

                        <p class="lead">Not our registered customer yet?</p>
                        <p>With registration with us! A new possible way of ordering of LPG, online shopping. The whole process will not take you more than a minute!</p>
                        <p class="text-muted">If you have any questions, please feel free to <a href="contact.php">contact us</a>, our customer service center is working for you 24/7.</p>

                        <hr>

    <form method="post">
    <div class="form-group">
     <label>First & Last name</label>
    <input type="text" class="form-control" name="customername" value="<?=isset($_SESSION['customername']) ? $_SESSION['customername'] : '' ?>" data-parsley-length="[6, 30]" required />
    </div>
    
    <div class="form-group">
    <label>Email</label>
    <input type="email" class="form-control" name="email" value="<?=isset($_SESSION['email']) ? $_SESSION['email'] : '' ?>" required />
    </div>

    <div class="form-group">
    <label>Mobile</label>
    <input type="text" class="form-control" name="contact" required placeholder="e.g. 9155253008" maxlength="10" data-parsley-pattern="^[0-9]+$" />
    </div>

    <div class="form-group">
    <label>Address</label>
    <input type="text" class="form-control" name="address" required />
    </div>
    
    <div class="form-group">
    <label>Password</label>
    <input type="password" name="password" class="form-control" id="pass2" class="form-control" required data-parsley-length="[6, 15]" data-parsley-trigger="keyup" />
    </div>

    <div class="form-group">
    <label>Re-Type Password</label>
   <input type="password" class="form-control" required data-parsley-equalto="#pass2" data-parsley-trigger="keyup" />    
    </div>
                            
    <div class="text-center">
    <button type="submit" class="btn btn-primary" name="register"><i class="fa fa-user-md"></i> Register</button>
    </div>
    
    </form>
    
    </div>
    </div>

            


    </div>
    <!-- /.container -->
     </div>
        <!-- /#content -->

    <?php
     require('footer.php');
     ?>
    

    </div>
    <!-- /#all -->


    

    <!-- *** SCRIPTS TO INCLUDE ***
 _________________________________________________________ -->
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap-hover-dropdown.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/front.js"></script>

 <!--Parsley -->
<script src="parsleyjs/dist/parsley.min.js"></script>
<script>
$(document).ready(function(){
    $('form').parsley();
});
</script>

</body>

</html>

<?php
if(isset($_POST['register'])) {
    $_SESSION['customername'] = $_POST['customername'];
    $_SESSION['email'] = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $ctr = 0;

    $mobile = '63' .$contact; 
    
    $check_email = $conn->query("SELECT * FROM user WHERE Username='$_SESSION[email]'");
    if($check_email->num_rows > 0) {
        echo '<script>
            window.alert("This email is already used.")
            </script>';
    }
    else {
        $ctr ++;
    }

    if($ctr == 1) {
  
        //CustomerID
        if(empty($_SESSION['userid'])) {
            $sql22 =  $conn->query("SELECT * FROM user_info
            ");
            $count22 = $sql22->num_rows;
            $numbers22 = rand(10,1000);
            $_SESSION['userid'] = 'USER-' .$numbers22. '-' .$count22;

        }

        //CART
        $total=0;
        $totalqty=0;
        foreach ($_SESSION["cart_products"] as $cart_itm)
        {
            //set variables to use in content below
            $product_name = $cart_itm["product_name"];
            $product_qty = $cart_itm["product_qty"];
            $product_price = $cart_itm["product_price"];
            $productid = $cart_itm["productid"];
            $product_price = $cart_itm["product_price"];
            $product_image = $cart_itm["product_image"];

            $subtotal = ($product_price * $product_qty); //calculate Price x Qty

            $total = ($total + $subtotal); //add subtotal to total var
           
            $query = $conn->query("INSERT INTO cart(UserID, ProductID, Qty, Price, Total, DateCreated)

                VALUES('$_SESSION[userid]', '$productid', '$product_qty', '$product_price', '$subtotal', '$da')");
            if($query === FALSE) {
                echo 'Error: ' .$query. '<br />' .$conn->error;
            }

             $totalqty = $product_qty + $totalqty;
            
        }
        //END CART

        $insert = "INSERT INTO user(UserID, Username, Password, Role, UserStatus, DateAdded, UserDelete)
            VALUES('$_SESSION[userid]', '$_SESSION[email]', '$_POST[password]', 'User', 'Active', '$da', '0');";

        $insert .= "INSERT INTO user_info(UserID, Fullname, Contact, Email, Address)
            VALUES('$_SESSION[userid]', '$_SESSION[customername]', '$mobile', '$_SESSION[email]', '$address')";
        if($conn->multi_query($insert) === TRUE) {
            unset($_SESSION['cart_products']);
            unset($_SESSION['subamount']);
            unset($_SESSION['grandamount']);
            


            echo '<script>
                window.alert("Successfully created an account.");
                window.location.href="register_update-exec.php";
                </script>';
        }
        else {
            echo 'Error ' .$insert. '<br />' .$conn->error;
        }       

    }

}
ob_end_flush();
?>