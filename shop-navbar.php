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
        <li><a href="index.php">Home</a></li>
        <li class="active"><a href="shop.php">Shop</a></li>
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