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
        <li class="active">Add Product</li>
      </ol>
<div class="grid_3 grid_4">
<div class="page-header">

  <b>ADD PRODUCT</b>
 
</div>  

<div class="bs-example">

  <form method="post" action="add_product-exec.php" enctype="multipart/form-data">
 <div class="row mb40">
  
    <div class="col-md-2">
    <h5>Product Name: </h5>
    </div>

    <div class="col-md-4">
    <input type="text" name="prodname" class="form-control" required data-parsley-length="[3, 30]" />
    </div>


    <div class="col-md-2">
    <h5>Category: </h5>
    </div>

    <div class="col-md-4">
    <select class="form-control" name="categoryid" required>
    <option value="" selected="selected"> - Select Category - </option>
    <?php
    $sql1 = $conn->query("SELECT CategoryName, CategoryID 
      FROM category WHERE CategoryDelete=0
      ORDER BY CategoryName");
    while($row1 = $sql1->fetch_assoc()) {
      echo '<option value="' .$row1['CategoryID']. '">' .$row1['CategoryName']. '</option>';
    }
    ?>
    </select> 
    </div>

  </div>  

  <div class="row mb40">
    <div class="col-md-2">
    <h5>Quantity Type: </h5>
    </div>

    <div class="col-md-4">
    <select class="form-control" name="qtyid" required>
    <option value="" selected="selected"> - Select Qty Type - </option>
    <?php
    $sql2 = $conn->query("SELECT QtyName, QtyID 
      FROM quantity_type WHERE QtyDelete=0
      ORDER BY QtyName");
    while($row2 = $sql2->fetch_assoc()) {
      echo '<option value="' .$row2['QtyID']. '">' .$row2['QtyName']. '</option>';
    }
    ?>
    </select> 
    </div>

     <div class="col-md-2">
    <h5>Description: </h5>
    </div>

    <div class="col-md-4">
    <textarea required class="form-control" name="proddetail"></textarea>
    </div>
    
  </div>  

  <div class="row mb40">
    <div class="col-md-2">
    <h5>Cost Price: </h5>
    </div>

    <div class="col-md-4">
    <input type="text" class="form-control" data-parsley-type="number" name="costprice" />
    </div>

    <div class="col-md-2">
    <h5>Mark Up(%): </h5>
    </div>

    <div class="col-md-4">
    <input type="text" class="form-control" required data-parsley-type="number" name="markup" />
    </div>

  </div>

    <div class="row mb40">
    <div class="col-md-2">
    <h5>Threshold: </h5>
    </div>

    <div class="col-md-4">
    <input type="text" class="form-control" required data-parsley-type="number" name="threshold" />
    </div>

  </div>


  <div class="row mb40">
    <div class="col-md-2">
    <h5>Upload Image: </h5>
    </div>

    <div class="col-md-4">
    <input type="file" name="prod_image" class="form-control" required>
    </div>

   

  </div>

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
                      
						
