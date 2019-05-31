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

  $billing_detail = $conn->query("SELECT * FROM billing_detail WHERE OrdersID='$ordersid'");
  $obj2 = $billing_detail->fetch_assoc(); 

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
    <li><a href="online_sales.php">Online Orders</a></li>
    <li><a href="deliverorder.php?ordersid=' .$ordersid. '">' .$ordersid. '</a></li>
    <li class="active">Cancel Transaction</li>
  </ol>
  ';
   
  ?>
<div class="grid_3 grid_4">
<div class="page-header">

  <b>CANCEL TRANSACTION</b>
 
       
 
</div>  

<div class="bs-example">

<?php
 echo 
  ' 
  <div class="row mb40">
    <div class="col-md-6">
      
      <table>
      <tr>
        <td><b>Customer: </b>' .$obj2['CustomerName']. '</td>
      </tr>

      <tr>
        <td><b>Contact : </b>' .$obj2['Mobile']. '</td>
      </tr>

      <tr>
        <td><b>Amount Payable: </b>' .formatMoney($obj['AmountPayable'], true). '</td>
      </tr>

      <tr>
        <td><b>Amount Paid: </b>' .formatMoney($obj['AmountPaid'], true). '</td>
      </tr>

      </table>
    </div>

  </div>
  ';

?>


 <form method="post" action="deliver_cancel-exec.php">
  <div class="row mb40">
    <div class="col-md-2">
    <h5>Specific Reason: </h5>
    </div>

    <div class="col-md-4">
    <?php
    $reason = $conn->query("SELECT * FROM damaged_reason WHERE ReasonDelete=0");
    echo 
    '
    <select class="form-control" name="reasonid" required>
    <option value="" selected="selected"> - Select Reason - </option>
    ';
    while($res = $reason->fetch_assoc()) {
      echo '<option value="' .$res['ReasonID']. '">' .$res['ReasonName']. '</option>';
    }

    echo'
    </select>
    ';
    ?>
    </div>

  
  </div>

  <div class="row mb40">
   <div class="col-md-2">
    <h5>Description: </h5>
    </div>

    <div class="col-md-4">
    <input type="text" name="description" class="form-control" required />
    </div>

  </div>  




  <input type="hidden" name="ordersid" value="<?php echo $ordersid; ?>">

  

  <div class="row mb40">
  <div class="col-md-2">
  <button type="submit" name="submit">Confirm</button>
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
                      
						
