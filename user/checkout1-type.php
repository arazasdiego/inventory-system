<?php
ob_start();
require('../connection.php');
require('session.php');
require('../format_money.php');

if(empty($_SESSION['transactiontype']) === TRUE){
    $_SESSION['transactiontype'] = '';
}

 $pickup1 = $conn->query("SELECT * FROM transaction_setting WHERE ID=1");
 $prow = $pickup1->fetch_assoc();


 $delivery1 = $conn->query("SELECT * FROM transaction_setting WHERE ID=2");
 $drow = $delivery1->fetch_assoc();
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

    <div class="col-md-12">
    <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li><a href="basket.php">Shopping Cart</a></li>
        <li>Checkout - Address</li>
    </ul>
    </div>

                <div class="col-md-9" id="checkout">

    
    <div class="box">
    <form method="post">
    <h1>Checkout</h1>
    <ul class="nav nav-pills nav-justified">

    <li class="active"><a href="#"><i class="fa fa-shopping-cart"></i><br>Transaction Method</a>
        </li>


        <li class="disabled"><a href="#"><i class="fa fa-map-marker"></i><br>Address</a>
        </li>
                                
      

        <li class="disabled"><a href="#"><i class="fa fa-money"></i><br>Payment Method</a>
        </li>

        <li class="disabled"><a href="#"><i class="fa fa-eye"></i><br>Order Review</a>
        </li>
        </ul>

        <div class="content">
        <div class="row">

  
    <?php
    if($prow['Status'] == 1) {
    ?>

    <div class="col-sm-6">
    <div class="box payment-method">
    <h4>Pickup Orders</h4>
    <p>Pickup the orders on the shop.</p>

    <div class="box-footer text-center">
    <?php echo "<input type='radio' name='transactiontype' value='Pickup'"  .($_SESSION['transactiontype'] == "Pickup" ? 'checked="checked"':'') . " required />";?>   
    </div>
    </div>
    </div>

    <?php
    }
    ?>
   

           

    <?php
    if($drow['Status'] == 1) {
    ?>

    <div class="col-sm-6">
    <div class="box payment-method">
    <h4>Deliver Orders</h4>
    <p>The order will be deliver to you.</p>
    <div class="box-footer text-center">
    <?php echo "<input type='radio' name='transactiontype' value='Delivery'"  .($_SESSION['transactiontype'] == "Delivery" ? 'checked="checked"':'') . " required />";?>   
    </div>
    </div>
    </div>

    <?php
    }
    ?>

   

    </div>
    <!-- /.row -->

        

        </div>

        <div class="box-footer">
        <div class="pull-left">
        <a href="basket.php" class="btn btn-default"><i class="fa fa-chevron-left"></i>Back to basket</a>
        </div>
        
        <div class="pull-right">
        <button type="submit" class="btn btn-primary" name="submit_detail">Continue to Payment Method<i class="fa fa-chevron-right"></i>
        </button>
        </div>
        </div>
        </form>
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


    

   


</body>

</html>


</html>

<?php 
if(isset($_POST['submit_detail'])) {
    $_SESSION['transactiontype'] = $_POST['transactiontype'];
   
    

    header('location: checkout1.php');
}
ob_end_flush();
?>