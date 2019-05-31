<?php
ob_start();
require('../connection.php');
require('../format_money.php');
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
        <li><a href="profile.php">Update Account</a></li>
        <li class="active">Change Password</li>
      </ol>
<div class="grid_3 grid_4">
<div class="page-header">

<b>CHANGE PASSWORD</b>
</div>  

<div class="bs-example">
  
  <form method="post">


<div class="row mb40">
  <div class="col-md-2">
    <h5>Old Password: </h5>
    </div>

    <div class="col-md-4">
    <input type="password" name="old_password" class="form-control" required />
    </div>
</div> 


<div class="row mb40">
    <div class="col-md-2">
    <h5>New Password: </h5>
    </div>

    <div class="col-md-4">
     <input type="password" name="password" class="form-control" id="pass2" class="form-control" required data-parsley-length="[6, 15]" data-parsley-trigger="keyup" />
    </div>


    <div class="col-md-2">
    <h5>Re-Type Password: </h5>
    </div>

    <div class="col-md-4">
    <input type="password" class="form-control" required data-parsley-equalto="#pass2" data-parsley-trigger="keyup" />
    </div>

  </div>





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
  $old_password = $_POST['old_password'];
  $password = $_POST['password'];
  
  $checkpass = $conn->query("SELECT Password FROM user WHERE UserID='$_SESSION[userid]'");

  $row = $checkpass->fetch_assoc();

  if($row['Password'] == $old_password) {

     $update1 = $conn->query("UPDATE user SET Password='$password'
      WHERE UserID='$_SESSION[userid]'");

      echo '<script>
    window.alert("Successfully changed password.");
    window.location.href="changepassword.php";
    </script>';
  }


  else {

      echo '<script>
    window.alert("Old password incorrect.");
    window.location.href="changepassword.php";
    </script>';
  }

 

 
   
  

}


ob_end_flush();
?>
                      
						
