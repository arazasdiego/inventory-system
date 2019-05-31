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
$userid = $_GET['userid'];

  $table = $conn->query("SELECT u.UserID, u.Username, u.Password, u.Role, u.UserStatus, u.DateAdded, u.UserDelete,
    ui.Fullname, ui.Contact, ui.Email, ui.Address, 
    ua.Inventory, ua.PO, ua.Orders, ua.Reports, ua.Settings
    FROM user AS u
    INNER JOIN user_info AS ui ON u.UserID=ui.UserID
    INNER JOIN user_access AS ua ON u.UserID=ua.UserID
    AND u.UserID='$userid'");

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
        <li><a href="user.php">View User</a></li>
        <li class="active">Edit User</li>
      </ol>
<div class="grid_3 grid_4">
<div class="page-header">

  <b>EDIT USER</b>
 
       
 
</div>  

<div class="bs-example">

  <form method="post" action="edit_user-exec.php">
   
  <h5>User Information</h5>
  <hr>
  <div class="row mb40">
  
    <div class="col-md-2">
    <h5>Fullname: </h5>
    </div>

    <div class="col-md-4">
    <input type="text" name="fullname" class="form-control" required data-parsley-length="[3, 50]" value="<?php echo $obj['Fullname']; ?>" />
    </div>


    <div class="col-md-2">
    <h5>Contact #: </h5>
    </div>

    <div class="col-md-4">
    <input type="text" name="contact" class="form-control" required data-parsley-length="[7, 30]" value="<?php echo $obj['Contact']; ?>" />
    </div>

  </div>  

  <div class="row mb40">
  
    <div class="col-md-2">
    <h5>Address: </h5>
    </div>

    <div class="col-md-4">
    <input type="text" name="address" class="form-control" required data-parsley-length="[3, 50]" value="<?php echo $obj['Address']; ?>" />
    </div>


    <div class="col-md-2">
    <h5>Email: </h5>
    </div>

    <div class="col-md-4">
    <input type="email" name="email" class="form-control" required data-parsley-length="[3, 50]" value="<?php echo $obj['Email']; ?>" />
    </div>

  </div>  

  <div class="row mb40">

    <div class="col-md-2">
    <h5>Username: </h5>
    </div>

    <div class="col-md-4">
    <input type="text" name="username" class="form-control" required data-parsley-length="[6, 20]" value="<?php echo $obj['Username']; ?>" />
    </div>

  </div>

  <h5>User Access</h5>
  <hr>
  <div class="row mb40">
  
    <div class="col-md-2">
    <h5>Inventory: </h5>
    </div>

    <div class="col-md-2">
    <?php echo "<input type='checkbox' name='inventory' value='1'"  .($obj['Inventory'] == 1 ? 'checked="checked"':'') . "/>";
    ?>
    
    </div>

    <div class="col-md-2">
    <h5>Purchase Order: </h5>
    </div>

    <div class="col-md-2">
    <?php echo "<input type='checkbox' name='po' value='1'"  .($obj['PO'] == 1 ? 'checked="checked"':'') . "/>";
    ?>
    
    </div>

    <div class="col-md-2">
    <h5>Order: </h5>
    </div>

    <div class="col-md-2">
    <?php echo "<input type='checkbox' name='orders' value='1'"  .($obj['Orders'] == 1 ? 'checked="checked"':'') . "/>";
    ?>
    
    </div>

  </div>

  <div class="row mb40">
  

    <div class="col-md-2">
    <h5>Reports: </h5>
    </div>

    <div class="col-md-2">
    <?php echo "<input type='checkbox' name='reports' value='1'"  .($obj['Reports'] == 1 ? 'checked="checked"':'') . "/>";
    ?>
    </div>

    <div class="col-md-2">
    <h5>Settings: </h5>
    </div>

    <div class="col-md-2">
    <?php echo "<input type='checkbox' name='settings' value='1'"  .($obj['Settings'] == 1 ? 'checked="checked"':'') . "/>";
    ?>
    </div>
  </div>




    <input type="hidden" name="userid" value="<?php echo $obj['UserID']; ?>" />


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
                      
						
