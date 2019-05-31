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
  <?php
  $table = $conn->query("SELECT ui.Fullname, ui.Contact, ui.Email, ui.Address, 
    u.Username, u.Password
    FROM user_info AS ui
    INNER JOIN user AS u ON ui.UserID=u.UserID
    AND ui.UserID='$_SESSION[userid]'
    ");
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

<div class="grid_3 grid_4">
<div class="page-header">
<b>USER ACCOUNT</b>
</div>  

<div class="bs-example">
  
  <form method="post">

  <div class="row mb40">
    <div class="col-md-2">
    <h5>Fullname: </h5>
    </div>

    <div class="col-md-4">
    <input type="text" class="form-control" name="fullname" data-parsley-length="[3, 30]" required value="<?php echo $obj['Fullname']; ?>" />
    </div>

    <div class="col-md-2">
    <h5>Contact #: </h5>
    </div>

    <div class="col-md-4">
   <input type="text" class="form-control" name="contact" required data-parsley-length="[3, 15]" value="<?php echo $obj['Contact']; ?>" />
    </div>
</div>  


<div class="row mb40">
  <div class="col-md-2">
    <h5>Email: </h5>
    </div>

    <div class="col-md-4">
    <input type="email" class="form-control" name="email" data-parsley-length="[3, 30]" required value="<?php echo $obj['Email']; ?>" />
    </div>


    <div class="col-md-2">
    <h5>Address: </h5>
    </div>

    <div class="col-md-4">
   <input type="text" class="form-control" name="address" required value="<?php echo $obj['Address']; ?>" />
    </div>
</div> 


<div class="row mb40">
  <div class="col-md-2">
    <h5>Username: </h5>
    </div>

    <div class="col-md-4">
    <input type="username" class="form-control" name="username" data-parsley-length="[3, 30]" required value="<?php echo $obj['Username']; ?>" />
    </div>

    <div class="col-md-4">
    <b><a href="changepassword.php">CHANGE PASSWORD</a></b>
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
  $fullname = $_POST['fullname'];
  $contact = $_POST['contact'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $username = $_POST['username'];
  

 

  $update1 = $conn->query("UPDATE user SET Username='$username'
      WHERE UserID='$_SESSION[userid]'");

   $update2 = $conn->query("UPDATE user_info SET Fullname='$fullname', Contact='$contact', Email='$email', Address='$address'
      WHERE UserID='$_SESSION[userid]'");

   echo '<script>
    window.alert("Successfully updated.");
    window.location.href="profile.php";
    </script>';

}


ob_end_flush();
?>
                      
						
