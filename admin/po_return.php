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
  $id = $_GET['id'];
 
  $table = $conn->query("SELECT po.ProductID, po.Price, po.TotalPrice, po.RequestedQty, po.POStatus, po.ReceivedQty, po.ReturnedQty, po.POID, 
    p.ProdName, p.ProdImage, p.Stock
    FROM po as po
    INNER JOIN product AS p ON po.ProductID=p.ProductID
    AND po.ID='$id'");

  $obj = $table->fetch_assoc();


    $sql = $conn->query("SELECT pot.DeliveryDate, pot.TotalAmount, pot.Status, 
    s.SupplierName, s.SupplierID
    FROM po_total AS pot
    INNER JOIN supplier AS s ON pot.SupplierID=s.SupplierID
    AND pot.POID='$obj[POID]'");

  $row = $sql->fetch_assoc();

	?>

<div class="inner-block">

<div class="blank">
  <?php
  echo 
  '
  <ol class="breadcrumb">
        <li><a href="po.php">Purchase Order</a></li>
        <li><a href="po_view2.php?poid=' .$obj['POID']. '">' .$obj['POID']. '</a></li>
        <li class="active">Return Item</li>
  </ol>
  ';

  ?>
<div class="grid_3 grid_4">
<div class="page-header">
 <b>RETURN ITEM</b>

</div>  

<div class="bs-example">
  <form method="post" action="po_return-exec.php">
  <div class="row mb40">
    <div class="col-md-2">
    <h5>Product: </h5>
    </div>

    <div class="col-md-4">
    <h5><?php echo $obj['ProdName']; ?></h5>
    </div>

    <div class="col-md-2">
    <h5>Requested Qty: </h5>
    </div>

    <div class="col-md-4">
    <h5><?php echo $obj['RequestedQty']; ?></h5>
    </div>

  </div>


  
  <div class="row mb40">
    <div class="col-md-2">
    <h5>Received Qty: </h5>
    </div>

    <div class="col-md-4">
    <h5><?php echo $obj['ReceivedQty']; ?></h5>
    </div>

    <div class="col-md-2">
    <h5>Supplier</h5>
    </div>

    <div class="col-md-4">
    <h5><?php echo $row['SupplierName']; ?></h5>
    </div>

  </div>

    <div class="row mb40">
    <div class="col-md-2">
    <h5>Reason: </h5>
    </div>

    <div class="col-md-4">
    <select class="form-control" name="reasonid" required>
    
    <?php
    $sql1 = $conn->query("SELECT ReasonName, ReasonID 
      FROM damaged_reason WHERE ReasonDelete=0
      ORDER BY ReasonName");
    while($row1 = $sql1->fetch_assoc()) {
      echo '<option value="' .$row1['ReasonID']. '">' .$row1['ReasonName']. '</option>';
    }
    ?>
    </select> 
    </div>

    <div class="col-md-2">
    <h5>Description: </h5>
    </div>

    <div class="col-md-4">
    <input type="text" name="description" class="form-control" required />
  
    </div>

    
  </div>  
  <?php
  $pending_damage = $obj['ReceivedQty'];
  ?>

  <div class="row mb40">
  
    <div class="col-md-2">
    <h5>Quantity: </h5>
    </div>

    <div class="col-md-2">
    <input type="text" class="form-control" name="qty" data-parsley-type="number" required />
    </div>

  </div>

  <input type="hidden" name="stock" value="<?php echo $obj['Stock']; ?>">

  <input type="hidden" name="productid" value="<?php echo $obj['ProductID']; ?>"> 

  <input type="hidden" name="poid" value="<?php echo $obj['POID']; ?>">  

  <input type="hidden" name="pending_damage" value="<?php echo $pending_damage; ?>">  

  <input type="hidden" name="supplierid" value="<?php echo $row['SupplierID']; ?>">
  
  <input type="hidden" name="id" value="<?php echo $id; ?>">  

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
  return confirm("Are you sure you want to remove this damaged product report from the supplier?"); 
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
                      
						
