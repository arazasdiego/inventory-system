<?php
ob_start();
require('../connection.php');
require('session.php');
require('../format_money.php');

if(empty($_SESSION['transactiontype'])) {
    $_SESSION['transactiontype'] = '';
}   
?>
<!DOCTYPE html>
<html lang="en">
<?php
require('head.php');
?>


<body>
    <?php
    $table = $conn->query("SELECT c.Qty, c.Price, c.Total, c.ProductID,   
        p.ProdName, p.ProdImage
        FROM cart AS c
        INNER JOIN product AS p ON c.ProductID=p.ProductID
        AND UserID='$_SESSION[userid]'
        ORDER BY p.ProdName");

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
   
    
    <form method="post" action="basket_update.php">
    <?php
    echo 
    '
    <h1>Shopping cart</h1>
    <p class="text-muted">You currently have ' .$cart_list['TotalQty']. ' item(s) in your cart.</p>
    ';
    
    ?>
    <div class="table-responsive">
    <table class="table">
    <thead>
    <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Remove</th>
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

        echo '<td><input type="text" size="2" maxlength="2" class="form-control" name="qty[' .$obj['ProductID']. ']" value="'  .$obj['Qty']. '" data-parsley-type="number" required /></td>';

        echo '<td>' .formatMoney($obj['Total'], true). '</td>';

        echo '<td><input type="checkbox" name="remove_product[]" value="'.$obj['ProductID'].'" /></td>';



        echo '</tr>';
    }    
    ?>
    
    
                                  
    </tbody>
 
    
    </table>


     <hr>
    <center>
    <table style="width: 60%; font-size: 16px;">
     
    <tr>
    <td>Subtotal (<a>vat inc.</a>)</td>
    <th align="right"><?php echo formatMoney($cart_list['TotalPrice'], true); ?></th>
   
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
    <button class="btn btn-default" type="submit" name="submit"><i class="fa fa-refresh"></i> Update basket</button>

    <a class="btn btn-primary" href="checkorder.php">Proceed to checkout <i class="fa fa-chevron-right"></i></a>



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

</body>

</html>
<?php
ob_end_flush();
?>