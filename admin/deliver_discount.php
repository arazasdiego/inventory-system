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
  $ordersid = $_GET['ordersid'];
  $table = $conn->query("SELECT * FROM orders_total WHERE OrdersID='$ordersid'");
  $obj = $table->fetch_assoc();

  $balance = $obj['AmountPayable'] - $obj['AmountPaid'];
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
 <?php
  echo 
  '
  <ol class="breadcrumb">
    <li><a href="online_sales.php">Online Order List</a></li>
    <li><a href="deliverorder.php?ordersid=' .$ordersid. '">' .$ordersid. '</a></li>
    <li class="active">Update Discount</li>
  </ol>
  ';
   
  ?>
<div class="grid_3 grid_4">
<div class="page-header">

  <b>UPDATE DISCOUNT</b>
 
       
 
</div>  

<div class="bs-example">

 <form method="post" action="deliver_discount-exec.php">
  <div class="row mb40">
    <div class="col-md-2">
    <h5>Grandtotal: </h5>
    </div>

    <div class="col-md-4">
    <h5><?php echo formatMoney($obj['GrandAmount'], true); ?></h5>
    </div>

    <div class="col-md-2">
    <h5>Discounted Amount: </h5>
    </div>

    <div class="col-md-4">
    <h5><?php echo formatMoney($obj['DiscountedAmount'], true); ?></h5>
    </div>

  </div>

 <div class="row mb40">
    <div class="col-md-2">
    <h5>Discount : </h5>
    </div>

    <div class="col-md-4">
    
    <?php
    $disc = $conn->query("SELECT * FROM discount WHERE DiscountDelete=0 
      ORDER BY DiscountName");

    $disc2 = $conn->query("SELECT * FROM discount 
      WHERE DiscountID='$obj[DiscountID]' AND DiscountDelete=0");
    $discrow2 = $disc2->fetch_assoc();

    if(empty($obj['DiscountID'])) {
      echo '<select name="discountid" class="form-control" required>';
      echo '<option value="" selected="selected"> - Select Discount - </option>';
      while($discrow = $disc->fetch_assoc()) {
        
        echo '<option value="' .$discrow['DiscountID']. '">' .$discrow['DiscountName']. ' - ' .$discrow['DiscountValue']. '%</option>';
      }
      echo '</select>';
    }

    else {
      echo '<select name="discountid" class="form-control" required>';
      echo '<option value="' .$obj['DiscountID']. '" selected="selected">' .$discrow2['DiscountName']. ' - ' .$discrow2['DiscountValue']. '%</option>';
      while($discrow = $disc->fetch_assoc()) {
        
        echo '<option value="' .$discrow['DiscountID']. '">' .$discrow['DiscountName']. ' - ' .$discrow['DiscountValue']. '%</option>';
      }
      echo '</select>';
    }
    
    
    ?>
    </select>
    </div>

  </div>



    <input type="hidden" name="ordersid" value="<?php echo $ordersid; ?>">

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
                      
						
