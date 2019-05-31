<?php
ob_start();
require('../connection.php');
require('../format_money.php');
require('session.php');

?>

<!DOCTYPE HTML>
<html>
	<?php 
	require('head.php');
	?>
<body>
<?php
$table = $conn->query("SELECT pt.POID, pt.DeliveryDate, pt.TotalAmount, pt.DateCreated, pt.Status, 

  s.SupplierName
  FROM po_total AS pt
  INNER JOIN supplier AS s ON pt.SupplierID=s.SupplierID
  ORDER BY pt.DateCreated
  ");

$sql2 = $conn->query("SELECT * FROM business_profile");
  $row2 = $sql2->fetch_assoc();
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
<h2>Purchase Report</h2>

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
  <td align="center"><?php echo $row2['BusinessEmail'];?></td> 
  
  </tr>

  <tr>
  <td align="center">TIN: <?php echo $row2['TIN'];?></td> 
  
  </tr>
  </table>
</center>
<hr>

 <?php 
  if($table->num_rows > 0) {
    echo '
    <b>PURCHASE REPORT</b>
    <table class="table" style="font-size: 18px; width: 100%; cellspacing: 20px;"> 
    <thead>
    <tr class="success">
      <th align="left">ID</th>
      <th><center>Supplier</th>
      <th><center>Delivery Date</th>
      <th><center>Total Amount</th>
      <th><center>Status</th>
      <th><center>Date Created</th>
    </tr>  
    </thead>

    <tbody>
    ';
     while($obj = $table->fetch_assoc()) {
      echo '<tr>';
      
      echo '<td>' .$obj['POID']. '</td>';

      echo '<td align="center">' .$obj['SupplierName']. '</td>';

      echo '<td align="center">' .$obj['DeliveryDate']. '</td>';

      echo '<td align="center">' .formatMoney($obj['TotalAmount'], true). '</td>';

      echo '<td align="center">' .$obj['Status']. '</td>';

      echo '<td align="center">' .$obj['DateCreated']. '</td>';

      echo '</tr>';

     
    }
    echo 
    '
    </tbody>
    </table>
    ';

  }

  else {
    echo 'No purchase record.';
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
  return confirm("Are you sure you want to remove this product?"); 
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
                      
						
