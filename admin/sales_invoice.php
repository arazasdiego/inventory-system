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
  //Orders Total
  $sql = $conn->query("SELECT ot.SubAmount, ot.DeliveryCharge, ot.GrandAmount, ot.AmountChange, ot.PaymentType, ot.AmountPaid, ot.DateOrdered, ot.DateFinished, ot.OrderStatus, ot.PaymentStatus, ot.DeliveryStatus, ot.TransactionType, ot.PreparedBy, ot.DiscountID, ot.DiscountedAmount, ot.AmountPayable, ot.ORNum, 

    bd.CustomerName, bd.CompleteAddress, bd.Email, bd.Mobile,

    ui.Fullname

    FROM orders_total AS ot
    INNER JOIN billing_detail AS bd ON ot.OrdersID=bd.OrdersID
    INNER JOIN user_info as ui ON ot.PreparedBy=ui.UserID
    AND ot.OrdersID='$ordersid'");

    $row = $sql->fetch_assoc();

  if($row['PaymentType'] == 'COD') {
    $payment_method = 'Cash on Delivery (COD)';
  }
  else if($row['PaymentType'] == 'Cash') {
  $payment_method = 'Cash';
  }
  else {
    $payment_method = 'Bank Deposit';
  }
   

  $sql2 = $conn->query("SELECT * FROM business_profile");
  $row2 = $sql2->fetch_assoc();



  //Orders
  $table = $conn->query("SELECT o.ID, o.OrderedQty, o.Price, o.DeliveredQty, o.DeliveryStatus, o.PaymentStatus, o.ProductID, o.TotalPrice, o.OrdersID,
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


  //VAT

  $vat = $conn->query("SELECT * FROM vat WHERE ID=1");
  $vatrow = $vat->fetch_assoc();


  $vatable = ($vatrow['Value'] / 100) + 1;
  $vatable_sales = $row['GrandAmount'] / $vatable;
  $vat = ($vatrow['Value'] / 100) * $vatable_sales; 
  ?>

<div class="inner-block">

<div class="blank">
   <?php
  echo 
  '
  <ol class="breadcrumb">
    <li><a href="sales.php">Walkin Orders</a></li>
    <li><a href="sales2.php?ordersid=' .$ordersid. '">' .$ordersid. '</a></li>
    <li class="active">Sales Invoice</li>
  </ol>
  ';
   
  ?>
<div class="grid_3 grid_4">
<div class="page-header">
 

</div>  

<div class="bs-example">

<table class="table">
  <tr>
    <td><button onclick="printPage('block1');">Click here to print</button></td>  
  </tr>
  </table>
<div id="block1">


<center>
   <table>
  <tr>
  
  <td align="center"><?php echo $row2['BusinessName'];?></td> 

  </tr>

  <tr>
  <td align="center"><?php echo $row2['BusinessAddress'];?></td> 
  
  </tr>

  
  <tr>
  <td align="center"><?php echo $row2['BusinessContact'];?></td> 
  
  </tr>

   <tr>
  <td align="center"><?php echo $row2['BusinessEmail'];?></td> 
  
  </tr>

  <tr>
  <td align="center">TIN: <?php echo $row2['TIN'];?></td> 
  
  </tr>
  </table>
  
</center>

  <hr>
  <center>
   <b>SALES INVOICE</b> 
  </center>
  <hr>

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

      <tr>
      <td><b>OR #: </b>' .$row['ORNum']. '</td>
      </tr>
      </table>
    </div>

     <div class="col-md-6">
      <b>ORDER DETAILS</b>
      <table>

      <tr>
      <td><b>Trans #: </b>' .$ordersid. '</td>
      </tr> 
     
      <tr>
      <td><b>Discount: </b>' .$discount. '</td>
      </tr>

      <tr>
      <td><b>Date Ordered: </b>' .$row['DateOrdered']. '</td>
      </tr>

      <tr>
      <td><b>Prepared By: </b>' .$row['Fullname']. '</td>
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
    <table class="table" style="font-size: 16px; width: 100%; cellspacing: 20px;">
    <tr class="success">
     <th align="left">Product</th>
      <th><center>Price</th>
      <th><center>Quantity</th>
      <th><center>Total Price</th>
      </tr>
      ';

     while($obj = $table->fetch_assoc()) {
      echo '<tr>';
      
      echo '<td>' .$obj['ProdName']. '</td>';

      echo '<td align="center">' .formatMoney($obj['Price'], true). '</td>';

      echo '<td align="center">' .$obj['OrderedQty']. '</td>';

      echo '<td align="center">' .formatMoney($obj['TotalPrice'], true). '</td>';

      echo '</tr>';
      
    }
     echo '</table>';
    
     echo 
    '
    <hr>
    <center>
    <table style="font-size: 16px; width: 50%;">
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


  if($row['AmountChange'] > 0) {
        echo '    
        <tr>
          <td>Change: </td>
          <td align="right">' .formatMoney($row['AmountChange'], true). '</td>
        </tr>
    ';
      }

       if($row['AmountPaid'] < $row['AmountPayable']) {
    echo '    
    <tr>
      <td>Balance: </td>
      <td align="right">' .formatMoney($balance, true). '</td>
    </tr>
    ';
    }
  
    echo '</table>';
 

  }

  else {
    echo 'No records available.';
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
function confirmRemove() {
  return confirm("Are you sure you want to remove this supplier?"); 
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
                      
            
