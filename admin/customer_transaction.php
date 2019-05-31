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
<?php
$userid = $_GET['userid'];

  $table = $conn->query("SELECT * FROM orders_total WHERE OrderBy='$userid'");
 

  $sql = $conn->query("SELECT u.UserID, u.Username, u.Password, u.Role, u.UserStatus, u.DateAdded, u.UserDelete,
    ui.Fullname, ui.Contact, ui.Email, ui.Address
    FROM user AS u
    INNER JOIN user_info AS ui ON u.UserID=ui.UserID
    AND u.UserID='$userid'");
  $row = $sql->fetch_assoc();

  $sql2 = $conn->query("SELECT SUM(GrandAmount) AS TGA, SUM(AmountPaid) AS TAP, SUM(AmountChange) AS TAC, SUM(DiscountedAmount) AS TDA, SUM(AmountPayable) AS TAPAY FROM orders_total WHERE OrderBy='$userid'");
  $row2 = $sql2->fetch_assoc();


$sql3 = $conn->query("SELECT * FROM business_profile");
  $row3 = $sql3->fetch_assoc();

  ?>	
<div class="page-container">

<div class="left-content">
<div class="mother-grid-inner">
    <!--header start here-->
	<?php
	require('header.php');
	?>			
	<!--header end here-->

<!--inner block start here-->
	

<div class="inner-block">

<div class="blank">
     <ol class="breadcrumb">
        <li><a href="customer.php">View Customer</a></li>
        <li class="active">Customer Transactions</li>
      </ol>
<div class="grid_3 grid_4">
<div class="page-header">
  <table>
  <tr>
    <td><button onclick="printPage('block1');">Click here to print</button></td>  
  </tr>
  </table>
  <hr>
  
  

 
</div>  

<div class="bs-example">
<div id="block1">
<center>
   <table>
  <tr>
  
  <td align="center"><?php echo $row3['BusinessName'];?></td> 

  </tr>

  <tr>
  <td align="center"><?php echo $row3['BusinessAddress'];?></td> 
  
  </tr>

  
  <tr>
  <td align="center"><?php echo $row3['BusinessContact'];?></td> 
  
  </tr>

  <tr>
  <td align="center">TIN: <?php echo $row3['TIN'];?></td> 
  
  </tr>
  </table>
</center>
<hr>
   <?php 
  echo 
'
  <div class="row mb40">
    <div class="col-md-6">
      <b>CUSTOMER DETAIL</b>
      <table>
      <tr>
        <td><b>Name: </b>' .$row['Fullname']. '</td>
      </tr>

      <tr>
        <td><b>Email: </b>' .$row['Email']. '</td>
      </tr>

      <tr>
        <td><b>Contact #: </b>' .$row['Contact']. '</td>
      </tr>

        <tr>
        <td><b>Address #: </b>' .$row['Address']. '</td>
      </tr>
    
    </table>
    </div>

    <div class="col-md-6">
      <b>TRANSACTION SUMMARY</b>
      <table>
        <tr>
        <td><b>Total Amount: </b>' .formatMoney($row2['TGA'], true). '</td>
        </tr>

        <tr>
        <td><b>Total Paid: </b>' .formatMoney($row2['TAP'], true). '</td>
        </tr>

        <tr>
        <td><b>Total Payable: </b>' .formatMoney($row2['TAPAY'], true). '</td>
        </tr>

        <tr>
        <td><b>Total Discounted: </b>' .formatMoney($row2['TDA'], true). '</td>
        </tr>
      ';

     
      echo'      
      </table>
    </div>
</div>
';
?>
  <hr>

 <?php
  if($table->num_rows > 0) {
    echo '
    <table class="table" style="font-size: 18px; width: 100%;">
    <thead>
    <tr class="success">
      <th>OrdID</th>
      <th><center>Date</th>
      <th><center>Amount</th>
      <th><center>Paid</th>
      <th><center>Payable</th>
      <th><center>Status</th>
    
     
     
    </tr>
    </thead>

    <tbody>
    ';

    while($obj = $table->fetch_assoc()) {
      echo '<tr>';

      echo '<td>' .$obj['OrdersID']. '</td>';
      
      echo '<td align="center">' .$obj['DateOrdered']. '</td>';

      echo '<td align="center">' .formatMoney($obj['GrandAmount'], true). '</td>';
      
      echo '<td align="center">' .formatMoney($obj['AmountPaid'], true). '</td>';

      echo '<td align="center">' .formatMoney($obj['AmountPayable'], true). '</td>';
      
      echo '<td align="center">' .$obj['OrderStatus']. '</td>';
     
    

      echo '</tr>';
    }

    echo '
    </tbody>
    </table>
    ';  

  }

  else {
    echo 'No records of online orders.';
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
  return confirm("Are you sure you want to remove this category?"); 
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
                      
						
