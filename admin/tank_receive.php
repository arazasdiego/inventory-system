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

  $table = $conn->query("SELECT t.ID, t.Qty, t.ReturnedQty, t.Status, t.ProductID, t.OrdersID, 
    p.ProdName, p.ProdImage, p.CategoryID, 
    c.CategoryName
    FROM tanks as t
    INNER JOIN product AS p ON t.ProductID=p.ProductID
    INNER JOIN category AS c ON p.CategoryID=c.CategoryID
    AND t.ID='$id'");

  $obj = $table->fetch_assoc();

  $ordersid = $obj['OrdersID'];
	?>

<div class="inner-block">

<div class="blank">
  <?php
  echo 
  '
  <ol class="breadcrumb">
        <li><a href="tank.php">Tank List</a></li>
        <li><a href="view_tank.php?ordersid=' .$ordersid. '">' .$ordersid. '</a></li>
        <li class="active">Receive Tank</li>
  </ol>
  ';

  ?>
<div class="grid_3 grid_4">
<div class="page-header">
 <b>RECEIVE TANK</b>

</div>  

<div class="bs-example">
  <form method="post" action="tank_receive-exec.php">
  <div class="row mb40">
    <div class="col-md-2">
    <h5>Product: </h5>
    </div>

    <div class="col-md-4">
    <h5><?php echo $obj['ProdName']; ?></h5>
    </div>

    <div class="col-md-2">
    <h5>Qty: </h5>
    </div>

    <div class="col-md-4">
    <h5><?php echo $obj['Qty']; ?></h5>
    </div>

  </div>    
  <?php
  $pending = $obj['Qty'] - $obj['ReturnedQty'];
  ?>
  <div class="row mb40">
    <div class="col-md-2">
    <h5>Pending: </h5>
    </div>

    <div class="col-md-4">
    <h5><?php echo $pending; ?></h5>
    </div>

  </div>

  <div class="row mb40">
  
    <div class="col-md-2">
    <h5>Returned : </h5>
    </div>

    <div class="col-md-2">
    <input type="text" class="form-control" name="qty" data-parsley-type="number" required />
    </div>

  </div>

  
  <input type="hidden" name="ordersid" value="<?php echo $ordersid; ?>">  
  <input type="hidden" name="id" value="<?php echo $obj['ID']; ?>">
  <input type="hidden" name="pending" value="<?php echo $pending; ?>">  

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
                      
						
