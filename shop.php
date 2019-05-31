<?php
ob_start();
require('connection.php');
require('format_money.php');
session_start();
$table = $conn->query("SELECT * FROM product WHERE ProdStatus='Active' AND Stock > 0 AND ProductDelete=0

    ORDER BY ProdName");

$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

$category = $conn->query("SELECT * FROM category WHERE CategoryDelete=0");
$count = $table->num_rows;

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
    require('shop-navbar.php');
    ?>

    <div id="all">

        <div id="content">
            <div class="container">
                 <div class="col-md-3">
                    <!-- *** MENUS AND FILTERS ***
 _________________________________________________________ -->
    <div class="panel panel-default sidebar-menu">

    <div class="panel-heading">
    <h3 class="panel-title">Categories</h3>
    </div>
    <?php
    echo 
    '
    <div class="panel-body">
    <ul class="nav nav-pills nav-stacked category-menu">
        <li class="active">
        <a href="shop.php">All<span class="badge pull-right">' .$count. '</span></a>
        <ul>
    ';
    while($row = $category->fetch_assoc()) {
        echo '<li><a href="shop_category.php?categoryid=' .$row['CategoryID']. '">' .$row['CategoryName']. '</a></li>';
    }
    echo '        
        </ul>
        </li>
    </ul>

    </div>
    ';

    ?>

    </div>

                 
                   

                    <!-- *** MENUS AND FILTERS END *** -->
                  
                </div>
                <div class="col-md-9">

                    <ul class="breadcrumb">
                        <li><a href="index.php">Home</a>
                        </li>
                        <li>Shop</li>
                    </ul>

                    <div class="box">
                        <h4>Catagory: All Products</h4>
                      
                    </div>

                  

    <div class="row products">

    <?php
    if($table->num_rows > 0){
        while($obj = $table->fetch_assoc()) {

            echo 
            '
    <form method="post" action="cart_update.php">        
    <div class="col-md-4 col-sm-2">
    <div class="product">
        <div class="flip-container">
        <div class="flipper">
            <div class="front">
            <a>
            <img src="prodimage/' .$obj['ProdImage']. '" alt="" class="img-responsive">
            </a>
            </div>

            <div class="back">
            <a>
            <img src="prodimage/' .$obj['ProdImage']. '" alt="" class="img-responsive">
            </a>
            </div>
            </div>
        </div>
        
        <a class="invisible">
        <img src="prodimage/' .$obj['ProdImage']. '" alt="" class="img-responsive">
        </a>

        <div class="text">
        <h3><a>' .$obj['ProdName']. '</a></h3>
                                    
        <p class="price">' .formatMoney($obj['RetailPrice'], true). '</p>

        <p class="buttons">
        
         <button type="text" class="btn btn-success">Add to cart</button>
        </p>

        </div>
        <!-- /.text -->
        </div>
        <!-- /.product -->
    </div>

    <input type="hidden" name="product_qty" value="1" />    
    <input type="hidden" name="type" value="add" />
    
    <input type="hidden" name="return_url" value="' .$current_url. '" />

    <input type="hidden" name="productid" value="' .$obj['ProductID']. '" />

    </form>
    ';

   
        }

    }
   
    ?>

    </div>
    <!-- /.products -->

             

    </div>
                <!-- /.col-md-9 -->

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






</body>

</html>

<?php
ob_end_flush();
?>