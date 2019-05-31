<?php
ob_start();
require('connection.php');
require('format_money.php');
session_start();

if(empty($_SESSION['delivery_fee']) === TRUE){
    $_SESSION['delivery_fee'] = 0;
}

if(empty($_SESSION['grandamount']) === TRUE){
    $_SESSION['grandamount'] = 0;
}


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
    require('shop-navbar.php');
    ?>


    <div id="all">

        <div id="content">
            <div class="container">

    <div class="col-md-12">
    <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li>Shopping cart</li>
    </ul>
    </div>

    
    <div class="col-md-9" id="basket">

    <div class="box">
    <form method="post" action="cart_update.php">
    
    <h1>Shopping cart</h1>
    <p class="text-muted">You currently have <?php echo $totalqty; ?> item(s) in your cart.</p>
    
    <div class="table-responsive">
    <table class="table">
    <thead>
    <tr>
        <th>Product</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Total</th>
        <th>Remove</th>
    </tr>
    </thead>
    
    <tbody>
    <?php
    $totalqty = 0;
    if(isset($_SESSION["cart_products"])) //check session var
    {
        $total = 0; //set initial total value
        $b = 0; //var for zebra stripe table 
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
            $totalqty = $product_qty + $totalqty;

           
            echo '<tr>';
        echo '<td>';
         echo '<img src="prodimage/' .$product_image. '" alt="Product Image" style="width: 60px; height: 60px;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        echo $product_name;

       
        echo '</td>';


echo '<td><input type="text" size="2" maxlength="2" name="product_qty['.$productid.']" value="'.$product_qty.'" class="form-control" data-parsley-type="number" required /></td>';
           
            echo '<td>'.formatMoney($product_price, true).'</td>';
            echo '<td>'.formatMoney($subtotal, true).'</td>';
            echo '<td><input type="checkbox" name="remove_code[]" value="'.$productid.'" /></td>';
            echo '</tr>';
            $total = ($total + $subtotal); //add subtotal to total var
        }
        
        $_SESSION['subamount'] = $total;
        
        
      
        
    }
    ?>
                                       
    </tbody>
    
   
    
    </table>

    <hr>
    <center>
    <table style="width: 50%; font-size: 16px;">
     
    <tr>
    <td>Subtotal (<a>vat inc.</a>)</td>
    <th align="right"><?php echo formatMoney($total, true); ?></th>
    </tr>
    </table>
    </center>

    </div>
    
    <!-- /.table-responsive -->

    <div class="box-footer">
    
  <div class="pull-left">
    <a href="shop.php" class="btn btn-default"><i class="fa fa-chevron-left"></i> Continue shopping</a>
    </div>
    
    <div class="pull-right">
    <button class="btn btn-default" type="submit"><i class="fa fa-refresh"></i> Update basket</button>

                                   <a class="btn btn-primary" href="reg.php">Proceed to checkout <i class="fa fa-chevron-right"></i></a>

<input type="hidden" name="return_url" value="<?php 
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
echo $current_url; ?>" />

</form>
    </div>
    
    </div>

    </div>
    <!-- /.box -->


                </div>
    <!-- /.col-md-9 -->
    <?php
    require('order_summary.php');
    ?>
  
    <!-- /.col-md-3 -->

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
ob_end_flush();
?>