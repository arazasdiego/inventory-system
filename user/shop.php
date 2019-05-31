<?php
ob_start();
require('../connection.php');
require('session.php');
require('../format_money.php');
$table = $conn->query("SELECT * FROM product WHERE ProdStatus='Active' AND Stock > 0 AND ProductDelete=0
    ORDER BY ProdName");

$category = $conn->query("SELECT * FROM category WHERE CategoryDelete=0");
$count = $table->num_rows;

?>
<!DOCTYPE html>
<html lang="en">
    <?php
    require('head.php');
    ?>

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

        $check = $conn->query("SELECT * FROM cart WHERE UserID='$_SESSION[userid]' AND ProductID='$obj[ProductID]'");  
          
            echo 
            '
    <form method="post" action="cart_update.php">        
   <div class="col-md-4 col-sm-2">
    <div class="product">
        <div class="flip-container">
        <div class="flipper">
            <div class="front">
            <a href="#product_detail' .$obj['ProductID']. '" role="button" data-target = "#product_detail' .$obj['ProductID']. '" data-toggle="modal">
            <img src="../prodimage/' .$obj['ProdImage']. '" alt="" class="img-responsive">
            </a>
            </div>

            <div class="back">
            <a href="#product_detail' .$obj['ProductID']. '" role="button" data-target = "#product_detail' .$obj['ProductID']. '" data-toggle="modal">
            <img src="../prodimage/' .$obj['ProdImage']. '" alt="" class="img-responsive">
            </a>
            </div>
            </div>
        </div>
        
        <a href="#product_detail' .$obj['ProductID']. '" role="button" data-target = "#product_detail' .$obj['ProductID']. '" data-toggle="modal" class="invisible">
        <img src="../prodimage/' .$obj['ProdImage']. '" alt="" class="img-responsive">
        </a>

        <div class="text">
        <h3><a>' .$obj['ProdName']. '</a></h3>

                                    
        <p class="price">' .formatMoney($obj['RetailPrice'], true). '</p>

        <p class="buttons">';
        if($check->num_rows > 0) {
           echo '<span class="btn btn-info">Added</span>';
        }
        else {
            echo '<button type="text" class="btn btn-success" name="submit">Add to cart</button>';
        }
        

        echo '
        </p>

        </div>
        <!-- /.text -->
        </div>
        <!-- /.product -->
    </div>

    <input type="hidden" name="product_qty" value="1" />  

    <input type="hidden" name="productid" value="' .$obj['ProductID']. '" />

    <input type="hidden" name="price" value="' .$obj['RetailPrice']. '" />

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

</body>

</html>
<?php
ob_end_flush();
?>