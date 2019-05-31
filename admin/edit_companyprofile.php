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
  $table = $conn->query("SELECT * FROM business_profile");
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
        <li><a href="company_profile.php">View Company Profile</a></li>
        <li class="active">Edit Company Profile</li>
      </ol>
<div class="grid_3 grid_4">
<div class="page-header">

  <h4>EDIT COMPANY PROFILE</h4>
 
       
 
</div>  

<div class="bs-example">

 <form method="post" action="edit_companyprofile-exec.php">
  <div class="row mb40">
    <div class="col-md-2">
    <h5>Company Name: </h5>
    </div>

    <div class="col-md-4">
    <input type="text" name="businessname" class="form-control " value="<?php echo $obj['BusinessName']; ?>" required />
    </div>

     <div class="col-md-2">
    <h5>Contact #: </h5>
    </div>

    <div class="col-md-4">
    <input type="text" name="businesscontact" class="form-control " value="<?php echo $obj['BusinessContact']; ?>" required />
    </div>
  </div>

  <div class="row mb40">
   <div class="col-md-2">
    <h5>Email: </h5>
    </div>

    <div class="col-md-4">
    <input type="text" name="businessemail" class="form-control " value="<?php echo $obj['BusinessEmail']; ?>" required />
    </div>

    <div class="col-md-2">
    <h5>Owner: </h5>
    </div>

    <div class="col-md-4">
    <input type="text" name="businessowner" class="form-control " value="<?php echo $obj['BusinessOwner']; ?>" required />
    </div>


  </div>  


  <div class="row mb40">
   <div class="col-md-2">
    <h5>TIN: </h5>
    </div>

    <div class="col-md-4">
    <input type="text" name="tin" class="form-control " value="<?php echo $obj['TIN']; ?>" required />
    </div>

    <div class="col-md-2">
    <h5>ORNumber: </h5>
    </div>

    <div class="col-md-4">
    <input type="text" name="ornumber" class="form-control " value="<?php echo $obj['ORNumber']; ?>" required />
    </div>
</div> 


<div class="row mb40">
    <div class="col-md-2">
    <h5>Company Address: </h5>
    </div>

    <div class="col-md-4">
    <input type="text" name="businessaddress" class="form-control " value="<?php echo $obj['BusinessAddress']; ?>" required />
    </div>
</div>



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
                      
						
