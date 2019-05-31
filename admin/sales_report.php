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
	$sql2 = $conn->query("SELECT * FROM business_profile");
  $row2 = $sql2->fetch_assoc();
	?>

<div class="inner-block">

<div class="blank">
<h2>Sales Report</h2>

<div class="grid_3 grid_4">
<div class="page-header">

<button onclick="printPage('block1');">Click here to print</button>
</div>  

<div class="bs-example">
   <form action="sales_report.php" method="post">
    <table class="table" style="font-size: 18px; width: 100%;">
    <tr>
      <td>From: </td>
      <td><input type="date" name="from" class="form-control" required /></td>

      <td>To: </td>
      <td><input type="date" name="to" class="form-control" required /></td>
    </tr>

    <tr>
      <td></td>
      <td><button type="submit" name="submit">Search</button></td>
      
    </tr>

    </table>
    </form>
    <hr>
   


  
  
    <?php
    if(isset($_POST['submit'])) {
      $table = $conn->query("SELECT ot.OrdersID, ot.DateOrdered, ot.OrderStatus, bd.CustomerName, ot.GrandAmount, ot.TransactionType, ot.DeliveryStatus, ot.PreparedBy, ot.PaymentStatus, ot.ReturnedStatus, ot.GrandAmount, ot.AmountPayable, ot.DiscountedAmount, ot.AmountPaid, ot.AmountChange, ot.OrderDate, ot.OrdersDelete,

        bd.CustomerName
        FROM orders_total as ot
        INNER JOIN billing_detail AS bd ON ot.OrdersID=bd.OrdersID
        AND ot.DateOrdered BETWEEN '$_POST[from]' AND '$_POST[to]'
        AND ot.PaymentStatus !='Not Paid' AND ot.OrdersDelete=0
        ORDER BY ot.OrderDate DESC");



        $ordsum = $conn->query("SELECT SUM(GrandAmount) AS TotalGA, SUM(AmountPayable) AS TotalAP, SUM(DiscountedAmount) AS TotalDA, SUM(AmountPaid) AS TotalPaid, SUM(AmountChange) AS TotalChange 
      FROM orders_total
      WHERE DateOrdered BETWEEN '$_POST[from]' AND '$_POST[to]'
      AND PaymentStatus !='Not Paid' AND OrdersDelete=0");
    $ordrow = $ordsum->fetch_assoc();
    $totalreceivepayment = $ordrow['TotalPaid'] - $ordrow['TotalChange'];
   

    
        ?>

     
     
     <?php   




      echo 
      '
      <div id="block1">
      ';  
      ?>

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


      <?php
      echo '


   
      <center>
      <b>TRANSACTION SUMMARY</b> (FROM: ' .$_POST['from']. ' TO: ' .$_POST['to']. ')
      
      </center>
   



  <hr>
      <b>TRANSACTION LIST</b>
    <table class="table" style="font-size: 18px; width: 100%; cellspacing: 20px;">
    <thead>
    <tr class="success">
      <th>OrdID</th>
      <th><center>Date</th>
      <th><center>Customer</th>
      <th><center>Grandtotal</th>
      <th><center>Discounted</th>
      <th><center>Payable</th>
      <th><center>Payment</th>
     
    
     
     
    </tr>
    </thead>

    <tbody>
      ';

    while($obj = $table->fetch_assoc()) {
  

      $paymentreceive = $obj['AmountPaid'] - $obj['AmountChange'];
      echo '<tr>';
      
      echo '<td>' .$obj['OrdersID']. '</td>';
      
      echo '<td align="center">' .$obj['DateOrdered']. '</td>';

      echo '<td align="center">' .$obj['CustomerName']. '</td>';
      
      echo '<td align="center">' .formatMoney($obj['GrandAmount'], true). '</td>';

      echo '<td align="center">' .formatMoney($obj['DiscountedAmount'], true). '</td>';

      echo '<td align="center">' .formatMoney($obj['AmountPayable'], true). '</td>';

      echo '<td align="center">' .formatMoney($paymentreceive, true). '</td>';

      echo '</tr>';
    
      
    }
    echo '</table>';


     echo '

    <hr>
    <center>
   <table style="font-size: 16px; width: 70%;">

     <tr>
      <td>Total Amount: </td>
      <th align="right">' .formatMoney($ordrow['TotalGA'], true). '</th>
      </tr>

      <tr>
      <td>Total Discounted Amount: </td>
      <th align="right">' .formatMoney($ordrow['TotalDA'], true). '</th>
      </tr>

      <tr>
      <td>Total Amount Payable: </td>
      <th align="right">' .formatMoney($ordrow['TotalAP'], true). '</th>
      </tr>

      <tr>
      <td>Total Received Payments: </td>
      <th align="right">' .formatMoney($totalreceivepayment, true). '</th>
      </tr>

      </table>
    </center>
      ';


     echo '</div>';
    }
    
    ?>
   
    </tbody>
    </table>
   



 
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
                      
						
