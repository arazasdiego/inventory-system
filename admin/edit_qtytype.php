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
$qtyid = $_GET['qtyid'];

  $table = $conn->query("SELECT QtyID, QtyName 
    FROM quantity_type WHERE QtyID='$qtyid' 
    ORDER BY QtyName");

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
        <li><a href="qtytype.php">View Quantity Type</a></li>
        <li class="active">Edit Quantity Type</li>
      </ol>
<div class="grid_3 grid_4">
<div class="page-header">

  <h4>EDIT QUANTITY TYPE</h4>
 
       
 
     
  
     
  



</div>  

<div class="bs-example">

  <form method="post" action="edit_qtytype-exec.php">
    <div class="row mb40">
  <div class="col-md-4">
    <h5>Quantity Type: </h5>
    </div>

    <div class="col-md-4">
    <input type="text" name="qtyname" class="form-control " required value="<?php echo $obj['QtyName']; ?>" />
    </div>


<input type="hidden" name="qtyid" value="<?php echo $obj['QtyID']; ?>">
 
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
                      
						
