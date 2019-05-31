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
$cityid = $_GET['cityid'];

  $table = $conn->query("SELECT * FROM city WHERE CityID='$cityid'");

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
        <li><a href="bank.php">View City Fees</a></li>
        <li class="active">Edit City/Fee</li>
      </ol>
<div class="grid_3 grid_4">
<div class="page-header">

  <h4>EDIT CITY AND FEE</h4>
 
       
 
</div>  

<div class="bs-example">

 <form method="post" action="edit_city-exec.php">
  <div class="row mb40">
    <div class="col-md-2">
    <h5>City Name: </h5>
    </div>

    <div class="col-md-4">
    <input type="text" name="cityname" value="<?php echo $obj['CityName']; ?>" class="form-control" required />
    </div>

    <div class="col-md-2">
    <h5>Delivery Fee (per unit): </h5>
    </div>

    <div class="col-md-4">
    <input type="text" name="cityfee" value="<?php echo $obj['CityFee']; ?>" class="form-control" data-parsley-type="number" />
    </div>
  </div>

 
  <input type="hidden" name="cityid" value="<?php echo $obj['CityID']; ?>"> 
  
  <div class="row mb40">
  <div class="col-md-2">
  <button type="submit" name="submit">SAVE</button>
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
                      
						
