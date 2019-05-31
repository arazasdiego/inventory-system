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
    ui.Fullname, ui.Contact, ui.Email, ui.Address
    FROM user AS u
    INNER JOIN user_info AS ui ON u.UserID=ui.UserID
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
        <li><a href="customer.php">View Customer</a></li>
        <li class="active">Customer Information</li>
      </ol>
<div class="grid_3 grid_4">
<div class="page-header">

  <b>CUSTOMER INFORMATION</b>
 
  </div>  


<div class="bs-example">

 <?php 
    echo '
    <center>
    <table style="font-size: 16px;">
    <tr>
        <th>Fullname: </th>   
        <td>' .$obj['Fullname']. '</td>
    </tr>

    <tr>
        <th>Username: </th>   
        <td>' .$obj['Username']. '</td>
    </tr>

    <tr>
        <th>Contact: </th>   
        <td>' .$obj['Contact']. '</td>
    </tr>

    <tr>
        <th>Email: </th>   
        <td>' .$obj['Email']. '</td>
    </tr>
    
    <tr>
        <th>Address: </th>   
        <td>' .$obj['Address']. '</td>
    </tr>

    <tr>
        <th>Date Created: </th>   
        <td>' .$obj['DateAdded']. '</td>
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
                      
						
