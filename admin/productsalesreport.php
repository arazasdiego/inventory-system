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

	$table = $conn->query("SELECT o.ProductID, p.ProdName, p.ProdImage, p.CategoryID, c.CategoryName, SUM(o.TotalPrice) AS Sales 
    FROM orders AS o
    INNER JOIN product AS p ON o.ProductID=p.ProductID
    INNER JOIN category AS c on p.CategoryID=c.CategoryID

    AND o.PaymentStatus='Paid' 
    GROUP BY o.ProductID");
	?>

<div class="inner-block">

<div class="blank">

  <ol class="breadcrumb">
    <li class="active">Product Sales</li>
    <li><a href="today.php">Today</a></li>
    <li><a href="lastweek.php">Last Week</a></li>
    
  </ol>

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
    <b>PRODUCT SALES</b>
    <table class="table" style="font-size: 18px; width: 100%; cellspacing: 20px;"> 
    <thead>
    <tr class="success">
    
      <th align="left">Product</th>
      <th align="left">Category</th>
      <th><center>Sales</th>
   
    </tr>  
    </thead>

    <tbody>
    ';
     while($obj = $table->fetch_assoc()) {
      echo '<tr>';

     echo '<td>' .$obj['ProdName']. '</td>';

     echo '<td>' .$obj['CategoryName']. '</td>';
     
   
     echo '<td align="center">' .formatMoney($obj['Sales'], true). '</td>';

      echo '</tr>';

     
    }
    echo 
    '
    </tbody>
    </table>
    ';

  }

  else {
    echo 'No product sales.';
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
                      
						
