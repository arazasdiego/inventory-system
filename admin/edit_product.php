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
 $productid = $_GET['productid'];

  $table = $conn->query("SELECT p.ProdName, p.Stock, p.CostPrice, p.MarkUp, p.RetailPrice, p.Threshold, p.ProdDetail, p.ProdImage, p.ProdStatus, p.DateAdded, p.ProductID, p.ProdImage, p.CategoryID, p.QtyID,

    c.CategoryName,
    q.QtyName
    
    
    FROM product AS p 
    INNER JOIN category AS c ON p.CategoryID=c.CategoryID
    INNER JOIN quantity_type AS q ON p.QtyID=q.QtyID
    AND p.ProductDelete=0
    AND p.ProductID='$productid'");




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
        <li class="active">Edit Product</li>
      </ol>
<div class="grid_3 grid_4">
<div class="page-header">

  <b>EDIT PRODUCT</b>
 
       
 
</div>  

<div class="bs-example">

  <form method="post" action="edit_product-exec.php" enctype="multipart/form-data">
    <div class="row mb40">
  
    <div class="col-md-2">
    <h5>Product Name: </h5>
    </div>

    <div class="col-md-4">
    <input type="text" name="prodname" class="form-control" required data-parsley-pattern="^[a-zA-Z 0-9]+$" data-parsley-length="[3, 30]" value="<?php echo $obj['ProdName']; ?>" />
    </div>


    <div class="col-md-2">
    <h5>Category: </h5>
    </div>

    <div class="col-md-4">

    <select class="form-control" name="categoryid" required>
    <?php
    $sql1 = $conn->query("SELECT * FROM category 
      WHERE CategoryDelete=0");
    while($row1 = $sql1->fetch_assoc()) {
      if($row1['CategoryID'] == $obj['CategoryID']) {
        echo '<option value="' .$row1['CategoryID']. '" selected="selected">' .$row1['CategoryName']. '</option>';
      }
      else {
        echo '<option value="' .$row1['CategoryID']. '">' .$row1['CategoryName']. '</option>';
      }
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
    
   <?php
    $sql2 = $conn->query("SELECT * FROM quantity_type 
      WHERE QtyDelete=0");
    while($row2 = $sql2->fetch_assoc()) {
      if($row2['QtyID'] == $obj['QtyID']) {
        echo '<option value="' .$row2['QtyID']. '" selected="selected">' .$row2['QtyName']. '</option>';
      }
      else {
        echo '<option value="' .$row2['QtyID']. '">' .$row2['QtyName']. '</option>';
      }
    }
    ?>
    </select> 
    </div>

      <div class="col-md-2">
    <h5>Description: </h5>
    </div>

    <div class="col-md-4">
    <textarea required class="form-control" name="proddetail"><?php echo $obj['ProdDetail']; ?>
    </textarea>
    </div>


  </div>


<div class="row mb40">
    <div class="col-md-2">
    <h5>Cost Price: </h5>
    </div>

    <div class="col-md-4">
    <input type="text" class="form-control" required data-parsley-type="number" name="costprice" value="<?php echo $obj['CostPrice']; ?>" />
    </div>

    <div class="col-md-2">
    <h5>Mark Up(%): </h5>
    </div>

    <div class="col-md-4">
    <input type="text" class="form-control" required data-parsley-type="number" name="markup" value="<?php echo $obj['MarkUp']; ?>" />
    </div>

  </div>


  <div class="row mb40">
 

    <div class="col-md-2">
    <h5>Threshold: </h5>
    </div>

    <div class="col-md-4">
    <input type="text" class="form-control" required data-parsley-type="number" name="threshold" value="<?php echo $obj['Threshold']; ?>" />
    </div>

  </div>


  <div class="row mb40">
    <div class="col-md-2">
    <h5>Upload Image: </h5>
    </div>

    <div class="col-md-4">
    <input type="file" name="prod_image" class="form-control">
    </div>

  <div class="col-md-4">
   <img src="../prodimage/<?php echo $obj['ProdImage']; ?>" alt="Product Image" style="width: 100px; height: 100px;"/>
    </div>


  

  </div>


  <input type="hidden" name="productid" value="<?php echo $obj['ProductID']; ?>">

  <input type="hidden" name="old_pic" value="<?php echo $obj['ProdImage']; ?>">


   <div class="row mb40">
    <div class="col-md-2">
    <button type="submit" name="submit">Update</button>
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
                      
						
