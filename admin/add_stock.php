<?php
ob_start();
require('../connection.php');
require('session.php');
?>

<!DOCTYPE HTML>
<html>
  <?php
  require('head.php');
  ?>
<body>
<?php
$productid = $_GET['productid'];

  $table = $conn->query("SELECT p.ProdName, p.Stock, p.CostPrice, p.MarkUp, p.RetailPrice, p.Threshold, p.ProdDetail, p.ProdImage, p.ProdStatus, p.DateAdded, p.ProductID, p.ProdImage, p.CategoryID, p.QtyID,

    c.CategoryName,
    q.QtyName
   
    FROM product AS p 
    INNER JOIN category AS c ON p.CategoryID=c.CategoryID
    INNER JOIN quantity_type AS q ON p.QtyID=q.QtyID
   
    AND p.ProductID='$productid'
    ");
  $obj = $table->fetch_assoc();
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
        <li><a href="product.php">View Product</a></li>
        <li class="active">Add Stock</li>
      </ol>
<div class="grid_3 grid_4">
<div class="page-header">

  <b>ADD STOCK</b>
 
       
 
     
  
     
  



</div>  

<div class="bs-example">

  <form method="post" action="add_stock-exec.php">
    <div class="row mb40">
  <div class="col-md-2">
    <h5>Product: </h5>
    </div>

    <div class="col-md-4">
    <h5><?php echo $obj['ProdName']; ?></h5>
    </div>

    <div class="col-md-2">
    <h5>Current Stock: </h5>
    </div>

    <div class="col-md-4">
    <h5><?php echo $obj['Stock']; ?></h5>
    </div>
  </div>    

  <div class="row mb40">
  
    <div class="col-md-2">
    <h5>Quantity : </h5>
    </div>

    <div class="col-md-2">
    <input type="text" class="form-control" name="qty" required data-parsley-type="number" />
    </div>

  </div>

  <input type="hidden" name="productid" value="<?php echo $obj['ProductID']; ?>">             
    
   <div class="row mb40">
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


</body>
</html>

<?php
ob_end_flush();
?>
                      
						
