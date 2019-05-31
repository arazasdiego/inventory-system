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
        <li class="active">User's Detail</li>
      </ol>
<div class="grid_3 grid_4">
<div class="page-header">

  <h4>USER DETAILS</h4>
 
  </div>  


<div class="bs-example">

 <?php 
    if ($obj['UserStatus'] == 'Active') {
        $userstatus = '<span class="label label-success">Active</span>';

    }

    else {
        $userstatus = '<span class="label label-danger">Inactive</span>';
    }

    if ($obj['Inventory'] == 1) {
        $inventory = '<span class="label label-success">Access</span>';

    }

    else {
        $inventory = '<span class="label label-danger">No Access</span>';
    }

    if ($obj['PO'] == 1) {
        $po = '<span class="label label-success">Access</span>';

    }

    else {
        $po = '<span class="label label-danger">No Access</span>';
    }

    if ($obj['Orders'] == 1) {
        $orders = '<span class="label label-success">Access</span>';

    }

    else {
        $orders = '<span class="label label-danger">No Access</span>';
    }

    if ($obj['Reports'] == 1) {
        $reports = '<span class="label label-success">Access</span>';

    }

    else {
        $reports = '<span class="label label-danger">No Access</span>';
    }

    if ($obj['Settings'] == 1) {
        $settings = '<span class="label label-success">Access</span>';

    }

    else {
        $settings = '<span class="label label-danger">No Access</span>';
    }

    echo '
    <table class="table table-striped" style="font-size: 18px;">
    <tr>
        <th>Fullname: </th>   
        <td>' .$obj['Fullname']. '</td>

        <th>Username: </th>   
        <td>' .$obj['Username']. '</td>
    </tr>

    <tr>
        <th>Contact: </th>   
        <td>' .$obj['Contact']. '</td>

        <th>Email: </th>   
        <td>' .$obj['Email']. '</td>

    </tr>
    
    <tr>
        <th>Address: </th>   
        <td>' .$obj['Address']. '</td>

        <th>Date Added: </th>   
        <td>' .$obj['DateAdded']. '</td>
    </tr>
    </table>
    
    <hr>
    <h4>User Access</h4>
    <table class="table table-striped" style="font-size: 18px;">
    <tr>
        <th>Inventory Module: </th>   
        <td>' .$inventory. '</td>

        <th>Purchase Order Module: </th>   
        <td>' .$po. '</td>
        
    </tr>

    <tr>
        <th>Order Module: </th>   
        <td>' .$orders. '</td>

      
        <th>Settings Module: </th>   
        <td>' .$settings. '</td>

    </tr>

    <tr>
        <th>Reports Module: </th>   
        <td>' .$reports. '</td>


    </tr>

   

    </table>

    ';
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
                      
						
