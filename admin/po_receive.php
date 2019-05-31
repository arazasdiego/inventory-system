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
 


  $table = $conn->query("SELECT po.ProductID, po.Price, po.TotalPrice, po.RequestedQty, po.POStatus, po.ReceivedQty, po.ReturnedQty, po.ID, po.POID,
    p.ProdName, p.ProdImage, p.Stock
    FROM po as po
    INNER JOIN product AS p ON po.ProductID=p.ProductID
    AND po.ID='$id'");
  $obj = $table->fetch_assoc();

  $poid = $obj['POID'];
	?>

<div class="inner-block">

<div class="blank">
  <?php
  echo 
  '
  <ol class="breadcrumb">
        <li><a href="po.php">Purchase Order</a></li>
        <li><a href="po_view2.php?poid=' .$poid. '">' .$poid. '</a></li>
        <li class="active">Receive Item</li>
  </ol>
  ';

  ?>
<div class="grid_3 grid_4">
<div class="page-header">
 <b>RECEIVE ITEM</b>

</div>  

<div class="bs-example">
  <form method="post" action="po_receive-exec.php">
  <div class="row mb40">
    <div class="col-md-2">
    <h5>Product Name: </h5>
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
  <?php
  $pending = $obj['RequestedQty'] - $obj['ReceivedQty'];
  ?>
  <div class="row mb40">
    <div class="col-md-2">
    <h5>Pending Qty: </h5>
    </div>

    <div class="col-md-4">
    <h5><?php echo $pending; ?></h5>
    </div>

  </div>

  <div class="row mb40">
  
    <div class="col-md-2">
    <h5>Received Quantity : </h5>
    </div>

    <div class="col-md-2">
    <input type="text" class="form-control" name="receiveqty" data-parsley-type="number" required />
    </div>

  </div>

  <input type="hidden" name="productid" value="<?php echo $obj['ProductID']; ?>">       
  <input type="hidden" name="pending" value="<?php echo $pending; ?>">  
  <input type="hidden" name="poid" value="<?php echo $poid; ?>">  
  <input type="hidden" name="id" value="<?php echo $obj['ID']; ?>">


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
                      
						
