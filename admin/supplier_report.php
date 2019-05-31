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

	$table = $conn->query("SELECT * FROM Supplier WHERE SupplierDelete=0");
	?>

<div class="inner-block">

<div class="blank">
<h2>Supplier Reports</h2>

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
    <b>SUPPLIER REPORT</b>
    <table class="table" style="font-size: 18px; width: 100%; cellspacing: 20px;"> 
    <thead>
    <tr class="success">
    
      <th align="left">Supplier</th>
      <th><center>Email</th>
      <th><center>Contact</th>
     
    </tr>  
    </thead>

    <tbody>
    ';
     while($obj = $table->fetch_assoc()) {
      echo '<tr>';

     echo '<td>' .$obj['SupplierName']. '</td>';
     
     echo '<td align="center">' .$obj['Email']. '</td>';

      echo '<td align="center">' .$obj['Contact']. '</td>';

    

      echo '</tr>';

     
    }
    echo 
    '
    </tbody>
    </table>
    ';

  }

  else {
    echo 'No records of supplier.';
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
                      
						
