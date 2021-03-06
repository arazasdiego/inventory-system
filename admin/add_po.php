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

<div class="inner-block">

<div class="blank">
<h2>Add Purchase Order</h2>

<div class="grid_3 grid_4">
<div class="page-header">

</div>  

<div class="bs-example">
<form method="post">
<div class="row mb40">
  
    <div class="col-md-2">
    <h5>Supplier Name: </h5>
    </div>

   <div class="col-md-4">
    <select class="form-control" name="supplierid" required>
    <option value="" selected="selected"> - Select Supplier - </option>
    <?php
    $sql3 = $conn->query("SELECT SupplierName, SupplierID 
      FROM supplier WHERE SupplierStatus='Active' AND SupplierDelete=0  
      ORDER BY SupplierName");
    while($row3 = $sql3->fetch_assoc()) {
      echo '<option value="' .$row3['SupplierID']. '">' .$row3['SupplierName']. '</option>';
    }
    ?>
    </select> 
    </div>

    <div class="col-md-2">
    <button type="submit" name="submit">Submit</button>
    </div>


    
  </div>  


</form>


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


</body>
</html>

<?php
if(isset($_POST['submit'])) {

    $supplierid = $_POST['supplierid'];
    
    $check = $conn->query("SELECT * FROM supplier_product WHERE SupplierID='$supplierid'");
    if($check->num_rows > 0) {
       header('location: po_order.php?supplierid=' .$supplierid. '');
      }


    else {
      echo '<script>
      window.alert("This supplier has no supply products yet.");
      window.location.href="add_po.php";
      </script>';
    } 

    

    }
ob_end_flush();
?>
                      
						
