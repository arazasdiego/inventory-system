<?php
ob_start();
require('../connection.php');
require('session.php');
require('../format_money.php');
?>

<!DOCTYPE HTML>
<html>
  <?php
  require('head.php');
  ?>
<body>  
<div class="page-container">

<div class="left-content">
<div class="mother-grid-inner">
    <!--header start here-->
  <?php
  require('header.php');
  ?>      
  <!--header end here-->

<!--inner block start here-->
  <?php
  $ordersid = $_GET['ordersid'];

  //Order summary
  $sql = $conn->query("SELECT ot.SubAmount, ot.DeliveryCharge, ot.GrandAmount, ot.AmountChange, ot.PaymentType, ot.AmountPaid, ot.DateOrdered, ot.DateFinished, ot.OrderStatus, ot.PaymentStatus, ot.DeliveryStatus, ot.TransactionType, ot.PreparedBy, ot.DiscountID, ot.DiscountedAmount, ot.AmountPayable, 
    bd.CustomerName, bd.CompleteAddress, bd.Email, bd.Mobile
    FROM orders_total AS ot
    INNER JOIN billing_detail AS bd ON ot.OrdersID=bd.OrdersID
    AND ot.OrdersID='$ordersid'");

    $row = $sql->fetch_assoc();

  //Order list
  $table = $conn->query("SELECT o.ID, o.OrderedQty, o.Price, o.DeliveredQty, o.DeliveryStatus, o.PaymentStatus, o.ProductID, o.TotalPrice, o.OrdersID, o.ReturnedQty, 
    p.ProdName, p.ProdImage, p.Stock
    FROM orders AS o
    INNER JOIN product AS p ON o.ProductID=p.ProductID
    AND o.OrdersID='$ordersid'
    ORDER BY p.ProdName");
  
  //Balance
  $balance = $row['AmountPayable'] - $row['AmountPaid'];

  //DISCOUNT NAME
  $discountsql = $conn->query("SELECT * FROM discount WHERE DiscountID='$row[DiscountID]'");
  $dscntrw = $discountsql->fetch_assoc();
  if($discountsql->num_rows > 0) {
    $discount = $dscntrw['DiscountName']. '  (' .$dscntrw['DiscountValue']. '%)';
  }
  else {
    $discount = 'None (0%)';
  }


  //Payment list
  $payment = $conn->query("SELECT * FROM payment WHERE OrdersID='$ordersid'");

  //Returned orders
  $returned_orders = $conn->query("SELECT * FROM returned_orders WHERE OrdersID='$ordersid'");

  //Generated po
  $auto_po = $conn->query("SELECT * FROM auto_po WHERE OrdersID='$ordersid'");

  //Check purchase
  $checkpo = $conn->query("SELECT * FROM po_total WHERE OrdersID='$ordersid'");

  //deposit slip
  $payment_slip = $conn->query("SELECT * FROM payment_slip WHERE OrdersID='$ordersid'");

  ?>

<div class="inner-block">

<div class="blank">
  <?php
  echo 
  '
  <ol class="breadcrumb">
    <li><a href="online_sales.php">Online Orders</a></li>
    <li class="active">' .$ordersid. '</li>
  </ol>
  ';
   
  ?>
<div class="grid_3 grid_4">
<div class="page-header">
 
</div>  

<div class="bs-example">

<div id="block1">

  <?php
  
echo 
  ' 
  <div class="row mb40">
    <div class="col-md-6">
      <b>CUSTOMER INFORMATION</b>
      <table>
      <tr>
      <td><b>Name: </b>' .$row['CustomerName']. '</td>
      </tr>

      <tr>
      <td><b>Address: </b>' .$row['CompleteAddress']. '</td>
      </tr>

      <tr>
      <td><b>Call: </b>' .$row['Mobile']. '</td>
      </tr>

      <tr>
      <td><b>Email: </b>' .$row['Email']. '</td>
      </tr>
      </table>
    </div>

     <div class="col-md-6">
      <b>ORDER DETAILS</b>
      <table>
      <tr>
      <td><b>Payment Status: </b>' .$row['PaymentStatus']. '</td>
      </tr>

      <tr>
      <td><b>Payment Method: </b>' .$row['PaymentType']. '</td>
      </tr>

      <tr>
      <td><b>Discount: </b>' .$discount. '</td>
      </tr>

      <tr>
      <td><b>Order Status: </b>' .$row['OrderStatus']. '</td>
      </tr>

      <tr>
      <td><b>Transaction: </b>Online/' .$row['TransactionType']. '</td>
      </tr>
      </table>
    </div>


  </div>
  ';

 
  echo 
  '
  <div class="row mb40">
    <div class="col-md-6">
      <b>ACTION</b>
      <table>
      ';
   if($row['AmountPaid'] < $row['AmountPayable']) {
    echo 
    '
    <tr>
      <td><b><a href="deliver_pay.php?ordersid=' .$ordersid. '">SUBMIT PAYMENT</a></b></td>
    </tr>
    ';
   } 

   if($row['PaymentStatus'] != 'Paid') {
    echo 
    '
    <tr>
      <td><b><a href="deliver_discount.php?ordersid=' .$ordersid. '">UPDATE DISCOUNT</a></b></td>
    </tr>
    ';
   } 

   
    echo 
    '
    <tr>
      <td><b><a href="deliver_cancel.php?ordersid=' .$ordersid. '">CANCEL TRANSACTION</a></b></td>
    </tr>
    ';
 

   if($row['DeliveryStatus'] == 'Processing') {
      echo 
      '
    <tr>
      <td><b><a href="deliver_prepare.php?ordersid=' .$ordersid. '">PREPARE ITEMS</a></b></td>
    </tr>
    ';
   }

   else {
     echo 
    '
    <tr>
      <td><b><a href="deliver_set.php?ordersid=' .$ordersid. '">SET ITEMS</a></b></td>
    </tr>
    ';
   }

    if($row['DeliveryStatus'] != 'Processing') {

           echo 
    '
    <tr>
      <td><b><a href="deliver_status.php?ordersid=' .$ordersid. '">STATUS/MESSAGE</a></b></td>
    </tr>
    ';

    }

 
   

    echo
    '
    </table>
    </div>


    <div class="col-md-6">
      <b>VIEW</b>
      <table>
      ';
    if($payment->num_rows > 0) {
    echo 
    '
    <tr>
      <td><b><a href="deliver_payments.php?ordersid=' .$ordersid. '">PAYMENT LIST</a></b></td>
    </tr>
    ';
   } 

    if($returned_orders->num_rows > 0) {
    echo 
    '
    <tr>
      <td><b><a href="deliver_returnlist.php?ordersid=' .$ordersid. '">RETURNED ORDERS</a></b></td>
    </tr>
    ';
   }

    if($auto_po->num_rows > 0) {
    echo 
    '
    <tr>
      <td><b><a href="deliver_genpo.php?ordersid=' .$ordersid. '">GENERATED PURCHASE</a></b></td>
    </tr>
    ';
   }

   if($checkpo->num_rows > 0) {
    echo 
    '
    <tr>
      <td><b><a href="po.php?ordersid=' .$ordersid. '">PURCHASE LIST</a></b></td>
    </tr>
    ';
   }    

   if($payment_slip->num_rows > 0) {
    echo 
    '
    <tr>
      <td><b><a href="deliver_slip.php?ordersid=' .$ordersid. '">DEPOSIT SLIP</a></b></td>
    </tr>
    ';
   }    

    echo
    '
    <tr>
      <td><b><a href="deliver_invoice.php?ordersid=' .$ordersid. '">PRINT INVOICE</a></b></td>
    </tr>

    </table>
    </div>
  </div>
  ';

 ?>



 
  



 <?php
  if($table->num_rows > 0) {
    echo '
    <hr>
   <b>ORDER LIST</b>
    <table class="table" style="font-size: 16px; width: 100%;">
    <tr class="success">
      <th align="left">Image</th>
      <th><center>Product</th>
      <th><center>Stock</th>
      <th><center>Price</th>
      <th><center>Qty</th>
      <th><center>Total</th>';
      echo '<th><center>Deliver</th>';

       

      echo 
      '
      <th><center>Action</th>
    
       </tr>
      ';

    while($obj = $table->fetch_assoc()) {
      $pending_deliver = $obj['OrderedQty'] - $obj['DeliveredQty'];

     
      $check = $conn->query("SELECT * FROM product WHERE ProductID='$obj[ProductID]'");
      $chckrw = $check->fetch_assoc();

      echo '<tr>';
      
     echo '<td>
      <a>
      <img src="../prodimage/' .$obj['ProdImage']. '" alt="Product Image" style="width: 50px; height: 50px;" />
      </a>';
      
      echo '</td>';

      echo '<td align="center">' .$obj['ProdName']. '</td>';

      echo '<td align="center">' .$obj['Stock']. '</td>';

      echo '<td align="center">' .formatMoney($obj['Price'], true). '</td>';

      echo '<td align="center">' .$obj['OrderedQty']. '</td>';

      echo '<td align="center">' .formatMoney($obj['TotalPrice'], true). '</td>';

  
    echo '<td align="center">' .$obj['DeliveredQty']. '</td>';

    

    echo '<td align="center">';

    echo '<b><a href="deliver_update.php?id=' .$obj['ID']. '">UPDATE</a> |</b>';

     
      if($obj['DeliveredQty'] > 0) {
       echo '<b><a href="deliver_return.php?id=' .$obj['ID']. '"> RETURN</a></b>';
      }


      echo '</td>';

    echo '</tr>';
      
    
    
    
    }

    

    echo '
    </table>
    ';  


    echo 
    '
    <center>
    <table style="font-size: 16px; width: 50%;">
    ';
     echo '
    
    <tr>
   
    <td>Subtotal: </td>
    <td align="right">' .formatMoney($row['SubAmount'], true). '</td>
    </tr>';

      echo '
    
    <tr>
   
    <td>Delivery Fee: </td>
    <td align="right">' .formatMoney($row['DeliveryCharge'], true). '</td>
    </tr>';
    
  
   echo '    
   <tr>
    <th>Grandtotal: </th>
    <td align="right">' .formatMoney($row['GrandAmount'], true). '</td>
    </tr>
    ';

    echo '</table>';


    echo '
    <hr>
    <table style="font-size: 16px; width: 50%;">
    <tr>
      <td>Discounted Amount: </td>
      <td align="right">' .formatMoney($row['DiscountedAmount'], true). '</td></td>
    </tr>
  ';
    
   echo '
    <tr>
      <th>Amount Payable:</th>
      <td align="right">' .formatMoney($row['AmountPayable'], true). '</td>
    </tr>
  ';

     echo '</table>';
 

    echo '
    <hr>
    <table style="font-size: 16px; width: 50%;">    
    <tr>
      <td>Amount Paid: </td>
      <td align="right">' .formatMoney($row['AmountPaid'], true). '</td>
    </tr>
    ';

    if($row['AmountPaid'] < $row['AmountPayable']) {
    echo '    
    <tr>
      <td>Balance: </td>
      <td align="right">' .formatMoney($balance, true). '</td>
    </tr>
    ';
    }
    
      if($row['AmountChange'] > 0) {
        echo '    
        <tr>
          <td>Change: </td>
          <td align="right">' .formatMoney($row['AmountChange'], true). '</td>
        </tr>
    ';
      }
  
    echo '</table>';

    
  }

  else {
    echo 'No ordered products.';
  }
  ?>

  </div>

 

</div>


</div>
</div>

</div>
<!--inner block end here-->

<!--footer-->
<?php 
require('footer.php');
?>  
<!--footer-->

</div>
</div>


<!--slider menu-->
  <?php
  require('navigation.php');
  ?>
</div>
<!--slider bar menu end here-->



<!--scrolling js-->
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <!--//scrolling js-->
<script src="js/bootstrap.js"> </script>
<!-- mother grid end here-->

<!--Parsley script-->
<script src="../parsleyjs/dist/parsley.min.js"></script>
<script>
$(document).ready(function(){
    $('form').parsley();
});
</script>

<script>
function confirmPrepare() {
  return confirm("Are you sure you want to prepare the item for pickup? (If stock does not meet the order, it will create a purchase order to supplier.)"); 
}

function confirmDeletePending() {
  return confirm("Are you sure you want to delete this pending order.)"); 
}

function confirmDeliver() {
  return confirm("Are you sure you want now to deliver the ordered items to the billing address?"); 
}

function confirmMessage() {
  return confirm("Are you sure you want to send message to customer?"); 
}
</script>

<!-- DATA TABLE SCRIPTS -->
<script src="../plugins/dataTables/jquery.dataTables.js"></script>
<script src="../plugins/dataTables/dataTables.bootstrap.js"></script>

<script>
  $(document).ready(function () {
  $('#dataTables-example').dataTable();
  });
</script>

<script>

function printPage(id)
{
   var html="<html>";
   html+= document.getElementById(id).innerHTML;
   html+="</html>";
  
   var printWin = window.open('', 'my div', 'height=500,width=700');
   printWin.document.write(html);
   printWin.document.close();
   printWin.focus();
   printWin.print();
   printWin.close();
   

}
  </script>


</body>
</html>

<?php
ob_end_flush();
?>
                      
            
