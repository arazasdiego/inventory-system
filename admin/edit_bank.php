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
$bankid = $_GET['bankid'];

  $table = $conn->query("SELECT * FROM bank WHERE BankID='$bankid'");

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
        <li><a href="bank.php">View Bank Accounts</a></li>
        <li class="active">Edit Bank Account</li>
      </ol>
<div class="grid_3 grid_4">
<div class="page-header">

  <h4>EDIT BANK ACCOUNT</h4>
 
       
 
</div>  

<div class="bs-example">

 <form method="post" action="edit_bank-exec.php">
  <div class="row mb40">
    <div class="col-md-2">
    <h5>Bank Name: </h5>
    </div>

    <div class="col-md-4">
    <input type="text" name="bankname" class="form-control " value="<?php echo $obj['BankName']; ?>" required />
    </div>

     <div class="col-md-2">
    <h5>Account Name: </h5>
    </div>

    <div class="col-md-4">
    <input type="text" name="accountname" class="form-control " value="<?php echo $obj['AccountName']; ?>" required />
    </div>
  </div>

  <div class="row mb40">
   <div class="col-md-2">
    <h5>Account Number: </h5>
    </div>

    <div class="col-md-4">
    <input type="text" name="accountnumber" class="form-control " value="<?php echo $obj['AccountNumber']; ?>" required />
    </div>
  </div>  

  <input type="hidden" name="bankid" value="<?php echo $obj['BankID']; ?>"> 
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
                      
						
