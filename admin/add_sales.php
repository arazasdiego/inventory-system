<?php
ob_start();
require('../connection.php');
require('../format_money.php');
require('session.php');

if(empty($_SESSION['cityname']) === TRUE) {
    $_SESSION['cityname'] = '';
}

if(empty($_SESSION['customername']) === TRUE) {
    $_SESSION['customername'] = '';
}

if(empty($_SESSION['mobile']) === TRUE) {
    $_SESSION['mobile'] = '';
}

if(empty($_SESSION['completeaddress']) === TRUE) {
    $_SESSION['completeaddress'] = '';
}



 $sql = $conn->query("SELECT * FROM city WHERE CityDelete=0");
 $discount = $conn->query("SELECT * FROM discount WHERE DiscountDelete=0");

 if(!empty($_SESSION['discountid'])) {
  $discount2 = $conn->query("SELECT * FROM discount WHERE DiscountID='$_SESSION[discountid]' AND DiscountDelete=0");
  $disc2_row = $discount2->fetch_assoc();
 }


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

<div class="grid_3 grid_4">
<div class="page-header">
<b>ADD SALES</b>
</div>  

<div class="bs-example">
  
  <form method="post">

  <div class="row mb40">
    <div class="col-md-2">
    <h5>Customer: </h5>
    </div>

    <div class="col-md-4">
    <input type="text" class="form-control" name="customername" data-parsley-length="[3, 30]" required value="<?php echo $_SESSION['customername']; ?>" />
    </div>

    <div class="col-md-2">
    <h5>Contact #: </h5>
    </div>

    <div class="col-md-4">
   <input type="text" class="form-control" name="mobile" required data-parsley-length="[3, 15]" value="<?php echo $_SESSION['mobile']; ?>" />
    </div>
</div>  


<div class="row mb40">
    <div class="col-md-2">
    <h5>Complete Address: </h5>
    </div>

    <div class="col-md-4">
   <input type="text" class="form-control" name="completeaddress" required value="<?php echo $_SESSION['completeaddress']; ?>" />
    </div>

    <div class="col-md-2">
    <h5>Discount Type: </h5>
    </div>

    <div class="col-md-4">
  <?php

    if(empty($_SESSION['discountid'])) {
       echo 
    '
    <select name="discountid" class="form-control" required>
    <option value="" selected="selected"> - Select Discount - </option>
    ';
    while($row2 = $discount->fetch_assoc()) {
      echo '<option value="' .$row2['DiscountID']. '">' .$row2['DiscountName']. ' - ' .$row2['DiscountValue']. '%</option>';
    }
    echo '  
    </select>
    ';    
    }

    else {
      echo 
    '
    <select name="discountid" class="form-control" required>
    <option value="' .$_SESSION['discountid']. '" selected="selected">' .$disc2_row['DiscountName']. ' - ' .$disc2_row['DiscountValue']. '%</option>
    ';
    while($row2 = $discount->fetch_assoc()) {
      echo '<option value="' .$row2['DiscountID']. '">' .$row2['DiscountName']. ' - ' .$row2['DiscountValue']. '%</option>';
    }
    echo '  
    </select>
    ';    
    }
   
      
    ?>
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
  $_SESSION['customername'] = $_POST['customername'];
  $_SESSION['mobile'] = $_POST['mobile'];
  $_SESSION['completeaddress'] = $_POST['completeaddress'];
 
  $_SESSION['discountid'] = $_POST['discountid'];
 
 header('location: add_sales2.php');
}


ob_end_flush();
?>
                      
						
