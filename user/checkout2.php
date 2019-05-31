<?php
ob_start();
require('../connection.php');
require('session.php');
require('../format_money.php');
if(empty($_SESSION['payment_type']) === TRUE) {
    $_SESSION['payment_type'] = '';
}
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

    $bank = $conn->query("SELECT * FROM bank");
    ?>

    <div id="all">

        <div id="content">
            <div class="container">

    <div class="col-md-12">
    <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li>Checkout - Payment method</li>
    </ul>
    </div>

    <div class="col-md-9" id="checkout">

    <div class="box">
    
    <form method="post">
    <h1>Checkout - Payment method</h1>
    <ul class="nav nav-pills nav-justified">
         <li><a href="checkout1-type.php"><i class="fa fa-shopping-cart"></i><br>Transaction Method</a>
        </li>


        <li><a href="checkout1.php"><i class="fa fa-map-marker"></i><br> Address</a>
        </li>
        
        <li class="active"><a href="checkout2.php"><i class="fa fa-money"></i><br>Payment Method</a>
        </li>
        
        <li class="disabled"><a href="checkout3.php"><i class="fa fa-eye"></i><br>Order Review</a>
        </li>
    
    </ul>

    <div class="content">
    <div class="row">
    <div class="col-sm-6">
    <?php
    if($_SESSION['transactiontype'] == 'Delivery') {
    ?>
    <div class="box payment-method">
    <h4>Cash on Delivery(COD)</h4>
    <p>You pay when you get it.</p>

    <div class="box-footer text-center">
    <?php echo "<input type='radio' name='payment_type' value='COD'"  .($_SESSION['payment_type'] == "COD" ? 'checked="checked"':'') . " required />";?>   
    </div>
    </div>
    <?php    
    }

    if($_SESSION['transactiontype'] == 'Pickup') {
    ?>
    <div class="box payment-method">
    <h4>Walikin Pay</h4>
    <p>You pay when you pickup.</p>

    <div class="box-footer text-center">
    <?php echo "<input type='radio' name='payment_type' value='Walikin Pay'"  .($_SESSION['payment_type'] == "Walikin Pay" ? 'checked="checked"':'') . " required />";?>   
    </div>
    </div>
    <?php    
    }


    ?>
   
    </div>

                                    
    <div class="col-sm-6">
    <div class="box payment-method">
    <h4>Bank Deposit</h4>
    <p>Deposit payment in the bank account.</p>
    <div class="box-footer text-center">
    <?php echo "<input type='radio' name='payment_type' value='Bank Deposit'"  .($_SESSION['payment_type'] == "Bank Deposit" ? 'checked="checked"':'') . " required/>";?>   
    </div>
    </div>
    </div>

    </div>
    <!-- /.row -->

    </div>
    <!-- /.content -->



    <div class="box-footer">
    <div class="pull-left">
    <a href="checkout1.php" class="btn btn-default"><i class="fa fa-chevron-left"></i>Back to Billing Address</a>
    </div>

    <div class="pull-right">
    <button type="submit" class="btn btn-primary" name="submit">Continue to Order review<i class="fa fa-chevron-right"></i>
    </button>
    </div>
    </div>
    </form>
                    
    </div>
    <!-- /.box -->



    </div>
    <!-- /.col-md-9 -->
        <div class="col-md-3">
                    <!-- *** BLOG MENU ***
 _________________________________________________________ -->
                    <div class="panel panel-default sidebar-menu">

    <div class="panel-heading">
    <?php
    if($_SESSION['transactiontype'] == 'Online') {
        echo 
        '
         <h3 class="panel-title">Billing Address </h3><a href="checkout1.php">Edit</a>
        ';
    }
    else {
         echo 
        '
         <h3 class="panel-title">Customer Address </h3><a href="checkout1.php">Edit</a>
        ';
    }
    ?>
   
    </div>

        <div class="panel-body">
        <?php
        echo '
        <table class="table">
        <tr>
            <th>' .$urow['Fullname']. '</th>
        </tr>


        <tr>
            <td>Transaction: ' .$_SESSION['transactiontype']. '</td>

        </tr>

        <tr>
            <td>' .$urow['Address']. '/' .$_SESSION['cityname']. '</td>
        </tr>

        <tr>
            <td>' .$urow['Contact']. '</td>
        </tr>

         <tr>
            <td>' .$urow['Email']. '</td>
        </tr>

        </table>
       
       
        ';
        ?>
        </div>

                    </div>
                    <!-- /.col-md-3 -->

                    <!-- *** BLOG MENU END *** -->

                  
                </div>

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

<?php 
if(isset($_POST['submit'])) {
    $_SESSION['payment_type'] = $_POST['payment_type']; 
    

    header('location: checkout3.php');
}
ob_end_flush();
?>