<?php
ob_start();
require('../connection.php');
require('session.php');
?>
<!DOCTYPE html>
<html lang="en">
    <?php
    require('head.php');
    ?>

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
       <li><a href="customer_orders.php">My Orders</a></li>
    </ul>    
        
    </div>
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



    <div id="all">

        <div id="content">

            <div class="container">
                <div class="col-md-12">
                    <?php
    echo 
    '
    <div id="main-slider">
        <div class="item">
        <img class="img-responsive" src="../slider/' .$cmsrow['slider1']. '" alt="Slider1" />
        </div>
        
         <div class="item">
        <img class="img-responsive" src="../slider/' .$cmsrow['slider2']. '" alt="Slider2" />
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


    


</body>

</html>
<?php
ob_end_flush();
?>