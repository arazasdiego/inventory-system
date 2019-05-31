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
        <li><a href="supplier.php">View Supplier</a></li>
        <li class="active">Add Supplier</li>
      </ol>
<div class="grid_3 grid_4">
<div class="page-header">

  <b>ADD SUPPLIER</b>
 
       
</div>  

<div class="bs-example">

  <form method="post" action="add_supplier-exec.php">
  
    <div class="row mb40">
  
    <div class="col-md-2">
    <h5>Supplier Name: </h5>
    </div>

    <div class="col-md-4">
    <input type="text" name="suppliername" class="form-control" required data-parsley-length="[3, 30]" />
    </div>


    <div class="col-md-2">
    <h5>Email: </h5>
    </div>

    <div class="col-md-4">
    <input type="email" class="form-control" required data-parsley-type="email" data-parsley-trigger="keyup" name="email" />
    </div>

  </div>  

  <div class="row mb40">
    <div class="col-md-2">
    <h5>Contact: </h5>
    </div>

    <div class="col-md-4">
    <input type="text" name="contact" class="form-control" required />
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
                      
						
