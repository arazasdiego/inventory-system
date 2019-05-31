<?php
ob_start();
require('connection.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
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



</head>

<body>
    <?php
    require('topbar.php');
    ?>
   

   <?php
   $cms = $conn->query("SELECT * FROM cms WHERE ID=1");
   $cmsrow = $cms->fetch_assoc();
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
if(empty($_SESSION['userid'])) {
   
}
else {
    echo '<li><a href="customer_orders.php">My Order</a></li>';
}

?>

    </ul>
    </div>
    
    <!--/.nav-collapse -->
    <!--Shopping Cart-->
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

          
    </div>
        <!-- /.container -->
    </div>
    <!-- /#navbar -->

    <!-- *** NAVBAR END *** -->



    <div id="all">

    <div id="content">

    <div class="container">
    
    <div class="col-md-12">
    <?php
    echo 
    '
    <div id="main-slider">
        <div class="item">
        <img class="img-responsive" src="slider/' .$cmsrow['slider1']. '" alt="Slider1" />
        </div>
        
         <div class="item">
        <img class="img-responsive" src="slider/' .$cmsrow['slider2']. '" alt="Slider2" />
        </div>
                       
        </div>

    ';    
    ?>    
        <!-- /#main-slider -->
    </div>
    </div>

            <!-- *** ADVANTAGES HOMEPAGE ***
 _________________________________________________________ -->
    <div id="advantages">

    <div class="container">
    <div class="same-height-row">
        <?php
        echo 
        '
        <div class="col-sm-4">
        <div class="box same-height clickable">
        <div class="icon"><i class="fa fa-heart"></i>
        </div>

        <h3><a href="index.php">' .$cmsrow['home_title1']. '</a></h3>
        <p>' .$cmsrow['home_text1']. '</p>
        </div>
        </div>
        ';
        ?>
       

       <?php
        echo 
        '
        <div class="col-sm-4">
        <div class="box same-height clickable">
        <div class="icon"><i class="fa fa-heart"></i>
        </div>

        <h3><a href="index.php">' .$cmsrow['home_title2']. '</a></h3>
        <p>' .$cmsrow['home_text2']. '</p>
        </div>
        </div>
        ';
        ?>

        <?php
        echo 
        '
        <div class="col-sm-4">
        <div class="box same-height clickable">
        <div class="icon"><i class="fa fa-heart"></i>
        </div>

        <h3><a href="index.php">' .$cmsrow['home_title3']. '</a></h3>
        <p>' .$cmsrow['home_text3']. '</p>
        </div>
        </div>
        ';
        ?>
        </div>
                    <!-- /.row -->

                </div>
                <!-- /.container -->

            </div>
            <!-- /#advantages -->

            <!-- *** ADVANTAGES END *** -->

           </div>
        <!-- /#content -->

        <?php
        require('footer.php');
        ?>


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


</body>

</html>



<?php
ob_end_flush();
?>