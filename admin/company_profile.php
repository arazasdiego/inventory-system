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
	$table = $conn->query("SELECT * FROM business_profile");
  $obj = $table->fetch_assoc();
	?>

<div class="inner-block">

<div class="blank">
<h2>Company Profile</h2>

<div class="grid_3 grid_4">
<div class="page-header">
<a class="btn btn-primary" href="edit_companyprofile.php">Edit Company Profile</a>

</div>  

<div class="bs-example">
<?php
  if($table->num_rows > 0) {
    echo '
    <table style="width: 100%;">
    <tr>
      <th>Company Name:</th>
      <td>' .$obj['BusinessName']. '</td>
    </tr>

    <tr>
      <th>Address:</th>
      <td>' .$obj['BusinessAddress']. '</td>
    </tr>

    <tr>
      <th>Contact #:</th>
      <td>' .$obj['BusinessContact']. '</td>
    </tr>

    <tr>
      <th>Email:</th>
      <td>' .$obj['BusinessEmail']. '</td>
    </tr>

    <tr>
      <th>TIN:</th>
      <td>' .$obj['TIN']. '</td>
    </tr>

    <tr>
      <th>Owner:</th>
      <td>' .$obj['BusinessOwner']. '</td>
    </tr>
    
    </table>
    ';  

  }

  else {
    echo 'No company profile record available.';
  }
  ?>
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
  return confirm("Are you sure you want to remove this supplier?"); 
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
                      
						
