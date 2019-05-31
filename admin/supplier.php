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
	$table = $conn->query("SELECT SupplierID, SupplierName, Email, Contact, SupplierStatus 
    FROM supplier WHERE SupplierDelete=0
    ORDER BY SupplierName");
	?>

<div class="inner-block">

<div class="blank">
<h2>Supplier</h2>

<div class="grid_3 grid_4">
<div class="page-header">

<b><u><a href="add_supplier.php">ADD SUPPLIER</a></u></b>
</div>  

<div class="bs-example">
<?php
  if($table->num_rows > 0) {
    echo '
    <table class="table" id="dataTables-example" style="font-size: 18px;">
    <thead>
    <tr class="success">
      <th>Supplier Name</th>
      <th>Email</th>
      <th>Contact</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
    </thead>

    <tbody>
    ';

    while($obj = $table->fetch_assoc()) {

      echo '<tr>';

      echo '<td>' .$obj['SupplierName']. '</td>';

      echo '<td>' .$obj['Email']. '</td>';

      echo '<td>' .$obj['Contact']. '</td>';

      echo '<td>';
        if($obj['SupplierStatus'] == 'Active') {
          echo '<span class="label label-success">Active</span>';
        }

        else {
           echo '<span class="label label-danger">Inactive</span>';
        }

      echo '</td>';

      echo '<td>';

          
          

           if ($obj['SupplierStatus'] == 'Active') {
            echo '<a href="status_supplier.php?supplierid=' .$obj['SupplierID']. ' &supplierstatus=' .$obj['SupplierStatus']. '">
          <img src="icons/deactivate.png" style="width: 20px; height: 20px;" title="Deactivate Supplier" />
          </a>';
          }
          else {
           echo '<a href="status_supplier.php?supplierid=' .$obj['SupplierID']. ' &supplierstatus=' .$obj['SupplierStatus']. '">
          <img src="icons/activate.png" style="width: 20px; height: 20px;" title="Activate Supplier" />
          </a>';
          }



       echo '<a href="edit_supplier.php?supplierid=' .$obj['SupplierID']. '">
          <img src="icons/edit.png" style="width: 20px; height: 20px;" title="Edit Supplier" />
          </a>';
          
           echo '<a href="supplier_addproduct.php?supplierid=' .$obj['SupplierID']. '">
          <img src="icons/add.png" style="width: 20px; height: 20px;" title="Add product to supplier" />
          </a>';


           echo '<a href="supplier_product.php?supplierid=' .$obj['SupplierID']. '">
          <img src="icons/inventory.png" style="width: 20px; height: 20px;" title="View Supply Products" />
          </a>';
          
          
          echo '<a href="delete_supplier.php?supplierid=' .$obj['SupplierID']. '&suppliername=' .$obj['SupplierName']. '" onclick="return confirmRemove()">
          <img src="icons/delete.png" style="width: 20px; height: 20px;" title="Delete Supplier" />
          </a>';

		
	
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


</body>
</html>

<?php
ob_end_flush();
?>
                      
						
