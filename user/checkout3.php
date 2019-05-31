<?php
ob_start();
require('../connection.php');
require('session.php');
require('../format_money.php');
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

    $table = $conn->query("SELECT c.Qty, c.Price, c.Total, c.ProductID,   
        p.ProdName, p.ProdImage
        FROM cart AS c
        INNER JOIN product AS p ON c.ProductID=p.ProductID
        AND UserID='$_SESSION[userid]'
        ORDER BY p.ProdName");

    $bank = $conn->query("SELECT * FROM bank WHERE BankDelete=0");
    ?>

    <div id="all">

        <div id="content">
            <div class="container">

    <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="index.php">Home</a>
                        </li>
                         <li><a href="basket.php">Shopping Cart</a>
                        </li>
                        <li>Checkout - Order review</li>
                    </ul>
    </div>

    <div class="col-md-9" id="checkout">

    <div class="box">
    <form method="post" action="checkout3-exec.php" enctype="multipart/form-data">
    <h1>Checkout - Order review</h1>
    <ul class="nav nav-pills nav-justified">
        <li><a href="checkout1.php"><i class="fa fa-map-marker"></i><br>Billing Address</a>
        </li>

        <li><a href="checkout2.php"><i class="fa fa-money"></i><br>Payment Method</a>
        </li>

        <li class="active"><a href="checkout3.php"><i class="fa fa-eye"></i><br>Order Review</a>
        </li>
    </ul>

    <div class="content">
    <div class="table-responsive">
    <table class="table">
    <thead>
    <tr>

        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    <?php
    while($obj = $table->fetch_assoc()) {
        echo '<tr>';

       echo '<td>';
        echo '<img src="../prodimage/' .$obj['ProdImage']. '" alt="Product Image" style="width: 60px; height: 60px;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        echo $obj['ProdName'];
        echo '</td>';


        echo '<td>' .formatMoney($obj['Price'], true). '</td>';

        echo '<td>' .$obj['Qty']. '</td>';

        echo '<td>' .formatMoney($obj['Total'], true). '</td>';
        echo '</tr>';
    }
    ?>   


    </tbody>


    </table>

    <input type="hidden" name="subamount" value="<?php echo $cart_list['TotalPrice']; ?>">

    <?php
    if($_SESSION['payment_type'] == 'Bank Deposit') {
        echo 
        '
    <div class="panel panel-info sidebar-menu">
    <div class="panel-heading">
    Bank Deposit
    </div>

    <div class="panel-body">
         <p>You can deposit your payment on one of this bank accounts.</p>
    <table class="table">
    <thead>
    <tr class="success">
        <th>Bank Name</th>
        <th>Account Name</th>
        <th>Account Number</th>
    </tr>
    </thead>

    <tbody>';
   
    while($brow = $bank->fetch_assoc()) {
        echo '<tr>';

        echo '<td>' .$brow['BankName']. '</td>';

        echo '<td>' .$brow['AccountName']. '</td>';

        echo '<td>' .$brow['AccountNumber']. '</td>';

        echo '</tr>';
    }

    echo '
    </tbody>
     
        
    </table>
    

        <div class="row">
        <div class="col-sm-6">
        <div class="form-group">
        <label>Upload Deposit Slip(Image for proof)</label>
        <input type="file" name="deposit_slip" class="form-control" required />
        </div>
        </div>

        
       
        </div>
        <!-- /.row -->
    </div>
   


    </div>
      
   
        ';
    }
    ?>

   

    </div>
    <!-- /.table-responsive -->
    </div>
    <!-- /.content -->

    <div class="box-footer">
    <div class="pull-left">
    <a href="checkout2.php" class="btn btn-default"><i class="fa fa-chevron-left"></i>Back to Payment Method</a>
    </div>

    <div class="pull-right">
    <button type="submit" class="btn btn-primary" name="submit">Place an order<i class="fa fa-chevron-right"></i>
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
                            <h3 class="panel-title">Shipping and Billing Address </h3><a href="checkout1.php">Edit</a>
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
ob_end_flush();
?>