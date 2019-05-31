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
  $poid = $_GET['poid'];

 $sql = $conn->query("SELECT pot.DeliveryDate, pot.TotalAmount, pot.Status, 
    s.SupplierName, s.SupplierID, s.Email, s.Contact, 
    ui.Fullname
    FROM po_total AS pot
    INNER JOIN supplier AS s ON pot.SupplierID=s.SupplierID
    INNER JOIN user_info AS ui ON pot.UserID=ui.UserID
    AND pot.POID='$poid'");
  $row = $sql->fetch_assoc();


  $sql2 = $conn->query("SELECT * FROM business_profile");
  $row2 = $sql2->fetch_assoc();


	$table = $conn->query("SELECT po.ProductID, po.Price, po.TotalPrice, po.RequestedQty, po.ReceivedQty, po.ReturnedQty,
    p.ProdName, p.Stock

    FROM po as po
    INNER JOIN product AS p ON po.ProductID=p.ProductID

    AND po.POID='$poid'

    ORDER BY p.ProdName");

	?>

<div class="inner-block">

<div class="blank">
   <?php
  echo 
  '
  <ol class="breadcrumb">
        <li><a href="po.php">Purchase Order List</a></li>
        <li class="active">Print Purchase Order</li>
  </ol>
  ';

  ?>
<div class="grid_3 grid_4">
<div class="page-header">
 <table>
  <tr>
    <td><button onclick="printPage('block1');">Click here to print</button></td>  
  </tr>
  </table>
</div>  

<div class="bs-example">

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
  <td align="center">TIN: <?php echo $row2['TIN'];?></td> 
  
  </tr>

  </table>
</center>
<hr>
<?php


  if($table->num_rows > 0) {
echo 
'
  <div class="row mb40">
    <div class="col-md-6">
      <b>SUPPLIER DETAIL</b>
      <table>
      <tr>
        <td><b>Name: </b>' .$row['SupplierName']. '</td>
      </tr>

      <tr>
        <td><b>Email: </b>' .$row['Email']. '</td>
      </tr>

      <tr>
        <td><b>Contact #: </b>' .$row['Contact']. '</td>
      </tr>
    
    </table>
    </div>

    <div class="col-md-6">
      <b>PURCHASE DETAIL</b>
      <table>
      <tr>
        <td><b>Delivery Date: </b>' .$row['DeliveryDate']. '</td>
      </tr>

      <tr>
        <td><b>Requested By: </b>' .$row['Fullname']. '</td>
      </tr>

        <tr>
        <td><b>Status: </b>' .$row['Status']. '</td>
      </tr>
      </table>
    </div>
</div>
';

    echo '
<hr>
    <b>PURCHASED PRODUCTS</b>
    <table class="table" style="font-size: 16px; width: 100%; cellspacing: 20px;">

   <tr class="success">
      <th>Product</th>
      <th><center>Cost Price</th>
      <th><center>Requested Qty</th>
      <th><center>Total</th>
    </tr>
   

   
    ';

    while($obj = $table->fetch_assoc()) {

      echo '<tr>';

      echo '<td>' .$obj['ProdName']. '</td>';

      echo '<td align="center">' .formatMoney($obj['Price'], true). '</td>';

      echo '<td align="center">' .$obj['RequestedQty']. '</td>';

      echo '<td align="center">' .formatMoney($obj['TotalPrice'], true). '</td>';

      echo '</tr>';
      
     
    }
    echo '
    </table>
    <hr>
    <center>
    <table style="font-size: 16px; width: 50%;">
    <tr>
      <th>Total Amount:</th>
      <td align="right">' .formatMoney($row['TotalAmount'], true). '</td>
    </tr>
    </table>  

  ';  

 

  }

  else {
    echo 'No purchase records available.';
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
                      
						
