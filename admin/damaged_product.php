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
	$table = $conn->query("SELECT dp.Qty, dp.DamagedDesc, dp.DateAdded, dp.DamagedID, 

    dr.ReasonName,
    s.SupplierName,
    p.ProdName, p.ProdImage, p.ProductID

    FROM damaged_product AS dp 

    INNER JOIN damaged_reason AS dr ON dp.ReasonID=dr.ReasonID

    INNER JOIN supplier AS s ON dp.SupplierID=s.SupplierID

    INNER JOIN product AS p ON dp.ProductID=p.ProductID

    ORDER BY p.ProdName");
	?>

<div class="inner-block">

<div class="blank">
<h2>Damaged Products</h2>

<div class="grid_3 grid_4">
<div class="page-header">

</div>  

<div class="bs-example">
<?php
  if($table->num_rows > 0) {
    echo '
    <table class="table" id="dataTables-example" style="font-size: 18px;"> 
    <thead>
    <tr class="success">
      <th>Image</th>
      <th>Product Name</th>
      <th>Supplier</th>
      <th>Qty</th>
      <th>Reason</th>
      <th>Description</th>
      <th>Date Added</th>
     
      
    </tr>
    </thead>

    <tbody>
    ';

    while($obj = $table->fetch_assoc()) {
      echo '<tr>';

      echo '<td>
      <a href="#view_prodimage' .$obj['ProductID']. '" role="button" data-target = "#view_prodimage' .$obj['ProductID']. '" data-toggle="modal">
      <img src="../prodimage/' .$obj['ProdImage']. '" alt="Product Image" style="width: 50px; height: 50px;" />
      </a>';
       require('product_image-modal.php');
      echo '</td>';
     
      echo '<td>' .$obj['ProdName']. '</td>';

      echo '<td>' .$obj['SupplierName']. '</td>';

      echo '<td>' .$obj['Qty']. '</td>';

      echo '<td>' .$obj['ReasonName']. '</td>';

      echo '<td>' .$obj['DamagedDesc']. '</td>';

      echo '<td>' .$obj['DateAdded']. '</td>';

      echo '<td>';

     
          
         


      echo '</td>';
     
      echo '</tr>';

     
    }

    echo '
    </tbody>
    </table>

    ';  

  }

  else {
    echo 'No data available.';
  }
  ?>
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
  return confirm("Are you sure you want to remove this damage report?"); 
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


</body>
</html>

<?php
ob_end_flush();
?>
                      
						
