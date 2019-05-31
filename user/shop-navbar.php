 <!-- *** NAVBAR ***
 _________________________________________________________ -->

    <div class="navbar navbar-default yamm" role="navigation" id="navbar">
        <div class="container">
            <div class="navbar-header">

                <a class="navbar-brand home" href="index.html" data-animate-hover="bounce">
                     <h3>LPGVILLE</h3><span class="sr-only">LPGVILLE - go to homepage</span>
                </a>
                <div class="navbar-buttons">
                
             
                   
                </div>
            </div>
            <!--/.navbar-header -->

    <div class="navbar-collapse collapse" id="navigation">
    <ul class="nav navbar-nav navbar-left">
        <li><a href="index.php">Home</a></li>
        <li class="active"><a href="shop.php">Shop</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
       <li><a href="customer_orders.php">My Orders</a></li>
        
    </ul>
    </div>
    
    <!--/.nav-collapse -->
    <!--Shopping Cart-->
    <div class="navbar-buttons">
    <?php
    if($cart_list['TotalQty'] > 0) {
        echo 
        '
        <div class="navbar-collapse collapse right" id="basket-overview">
        <a href="basket.php" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span class="hidden-sm">' .$cart_list['TotalQty']. ' item(s)</span></a>
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