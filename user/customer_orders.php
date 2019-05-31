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

    $table = $conn->query("SELECT * FROM orders_total WHERE OrderBy='$_SESSION[userid]'
        ORDER BY DateOrdered DESC");

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
        <li><a href="contact.php">Contact</a></li>
       
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
        <li><a href="index.php">Home</a></li>
        <li>My orders</li>
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

    <div class="col-md-9" id="customer-orders">
    <div class="box">
    <h1>My orders</h1>
    
    <p class="text-muted">If you have any questions, please feel free to <a href="contact.php">contact us</a>, our shop is working for you 8-6.</p>

    <hr>

    <?php
    if($table->num_rows > 0) {
        echo 
    '
    <div class="table-responsive">
    <table class="table table-hover">
    <thead>
    <tr class="success">
        <th>ID</th>
        <th>Date</th>
        <th>Amount</th>
        <th>Payment</th>
        <th>Status</th>
        <th>Type</th>
       
        <th>Action</th>
    </tr>
    </thead>
    
    <tbody>
    ';
    while($obj = $table->fetch_assoc()) {

      
        echo '<tr>';   

        echo '<td>' .$obj['OrdersID']. '</td>';

        echo '<td>' .$obj['DateOrdered']. '</td>';

        echo '<td>' .formatMoney($obj['GrandAmount'], true). '</td>';

        echo '<td>' .$obj['PaymentStatus']. '</td>';

        echo '<td>' .$obj['OrderStatus']. '</td>';    

        echo '<td>' .$obj['TransactionType']. '</td>';

        echo '<td><a href="view_order.php?ordersid=' .$obj['OrdersID']. '" class="btn btn-primary btn-sm">View</a>';

        echo '</tr>';
    }
    
    echo 
    '
    </tbody>
    </table>
    </div>
    ';
    }
    else {
        echo '<h5>No orders made.</h5>';
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