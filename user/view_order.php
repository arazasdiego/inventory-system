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
    $ordersid = $_GET['ordersid'];

    $table = $conn->query("SELECT o.OrderedQty, o.Price, o.TotalPrice, o.DeliveredQty, o.DeliveryStatus, o.PaymentStatus, o.PickedupQty, o.PickedupStatus,
        p.ProdName, p.ProdImage
        FROM orders AS o
        INNER JOIN product AS p ON o.ProductID=p.ProductID

        AND OrdersID='$ordersid'
        ORDER BY p.ProdName");

    $sql = $conn->query("SELECT * FROM orders_total WHERE OrdersID='$ordersid'");
    $row = $sql->fetch_assoc();

    $billing = $conn->query("SELECT * FROM billing_detail WHERE OrdersID='$ordersid'");
    $row2 = $billing->fetch_assoc();

    $balance = $row['AmountPayable'] - $row['AmountPaid'];



    //VAT
$vat = $conn->query("SELECT * FROM vat WHERE ID=1");
  $vatrow = $vat->fetch_assoc();


  $vatable = ($vatrow['Value'] / 100) + 1;
  $vatable_sales = $row['SubAmount'] / $vatable;
  $vat = ($vatrow['Value'] / 100) * $vatable_sales; 
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
        <li><a href="index.php">Home</a></li>
        <li><a href="shop.php">Shop</a></li>
        <li><a href="about.php">About</a></li>
        <li class="active"><a href="customer_orders.php">My Orders</a></li>
        
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

                    <ul class="breadcrumb">
                        <li><a href="index.php">Home</a>
                        </li>
                        <li><a href="customer_orders.php">My orders</a>
                        </li>
                        <li><?php echo $ordersid; ?></li>
                    </ul>

                </div>

    <div class="col-md-3">
    <!-- *** CUSTOMER MENU ***
 _________________________________________________________ -->
    <div class="panel panel-default sidebar-menu">

    <div class="panel-heading">
    <h3 class="panel-title">Customer section</h3>
    </div>

    <div class="panel-body">

    <ul class="nav nav-pills nav-stacked">
        <li class="active">
        <a href="customer_orders.php"><i class="fa fa-list"></i> My orders</a>
        </li>
                               
        <li>
        <a href="customer-account.php"><i class="fa fa-user"></i> My account</a>
        </li>

        <li>
        <a href="logout.php" onclick="return confirm('Are you sure you want to logout?')"><i class="fa fa-sign-out"></i> Logout</a>
        </li>
    </ul>
    </div>

    </div>
    <!-- /.col-md-3 -->

    <!-- *** CUSTOMER MENU END *** -->
    </div>

    <div class="col-md-9" id="customer-order">
    <div class="box">
    <?php
    if($table->num_rows > 0) {
        echo 
        '
        <div class="row">
        <div class="col-sm-6">
        <h4>CUSTOMER DETAIL</h4>
        <table style="font-size: 16px;">
      <tr>
        <td><b>Customer: </b>' .$row2['CustomerName']. '</td>
      </tr>

      <tr>
        <td><b>Complete Address: </b>' .$row2['CompleteAddress']. '</td>
      </tr>

      <tr>
        <td><b>Mobile: </b>' .$row2['Mobile']. '</td>
      </tr>

       <tr>
        <td><b>Email: </b>' .$row2['Email']. '</td>
      </tr>

      </table>
        </div>

        <div class="col-sm-6">
        <h4>ORDER DETAIL</h4>
        <table style="font-size: 16px;">
      <tr>
        <td><b>ORDID: </b>' .$ordersid. '</td>
      </tr>

      <tr>
        <td><b>Order Date: </b>' .$row['DateOrdered']. '</td>
      </tr>

      <tr>
        <td><b>Payment Method: </b>' .$row['PaymentType']. '</td>
      </tr>

       <tr>
        <td><b>Payment Status: </b>' .$row['PaymentStatus']. '</td>
      </tr>

      </table>
        </div>


        </div>

        ';

        echo 
        '
        

    <hr>

  <div class="table-responsive">
  <h4>ORDER LIST</h4>
    <table class="table" style="width: 100%;">
    <thead>
    <tr class="success">
        <th>Product</th>
        <th>Unit Price</th>
        <th>Quantity</th>
        <th>Total</th>
        ';
      

    echo '    
    </tr>
    </thead>
    <tbody>
    ';

    while ($obj = $table->fetch_assoc()) {
        echo '<tr>';

        echo '<td>';
        echo '<img src="../prodimage/' .$obj['ProdImage']. '" alt="Product Image" style="width: 60px; height: 60px;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        echo $obj['ProdName'];
        echo '</td>';


        echo '<td>' .formatMoney($obj['Price'], true). '</td>';

        echo '<td>' .$obj['OrderedQty']. '</td>';

        echo '<td>' .formatMoney($obj['TotalPrice'], true). '</td>';

     

         echo '</tr>';                           
    }

    echo '
    </tbody>
    </table>
    ';

    echo 
    '
    <hr>
    <center>

    <table style="width: 70%; font-size: 16px;">
    ';

    echo '    
   <tr>
    <td>Vatable Sales: </td>
    <td align="right">' .formatMoney($vatable_sales, true). '</td>
    </tr>
    ';

    echo '    
   <tr>
    <td>VAT: </td>
    <td align="right">' .formatMoney($vat, true). '</td>
    </tr>
    ';
    
    echo '
    <tr>
        <td>Subtotal: </td>
        <td align="right">' .formatMoney($row['SubAmount'], true). '</td>
    </tr>
    ';
    if($row['TransactionType'] == 'Delivery') {
        echo 
        '
        <tr>
            <td>Delivery Fee: </td>
            <td align="right">' .formatMoney($row['DeliveryCharge'], true). '</td>
        </tr>
        ';
    }
   
    

    echo '
    <tr>
        <th>Grandtotal: </th>
        <td align="right">' .formatMoney($row['GrandAmount'], true). '</td>
    </tr>
    ';

    echo '</table>';


    echo '
    <hr>
   <table style="width: 70%; font-size: 16px;">

    <tr>
        <td>Discounted Amount: </td>
        <td align="right">' .formatMoney($row['DiscountedAmount'], true). '</td>
    </tr>


    <tr>
        <th>Amount Payable: </th>
        <td align="right">' .formatMoney($row['AmountPayable'], true). '</td>
    </tr>

    </table>
    ';

    echo '
    <hr>
    <table style="width: 70%; font-size: 16px;">
    <tr>
        <td>Amount Paid</td>
        <td align="right">' .formatMoney($row['AmountPaid'], true). '</td>
    </tr>
    ';
    
    if($row['AmountPaid'] < $row['AmountPayable']) {
        echo 
        '
        <tr>
            <td>Balance</td>
            <td align="right">' .formatMoney($balance, true). '</td>
        </tr>
        ';
    }




    echo 
    '
    </table>
    </center>
    </div>
   
        ';
    }
    ?>  

   
                      


    </div>
    </div>

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
