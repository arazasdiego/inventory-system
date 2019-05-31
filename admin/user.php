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
  <?php
  $table = $conn->query("SELECT u.UserID, u.Username, u.Password, u.Role, u.UserStatus, u.DateAdded, u.UserDelete,
    ui.Fullname, ui.Contact, ui.Email, ui.Address, 
    ua.Inventory, ua.PO, ua.Orders, ua.Reports, ua.Settings
    FROM user AS u
    INNER JOIN user_info AS ui ON u.UserID=ui.UserID
    INNER JOIN user_access AS ua ON u.UserID=ua.UserID
    AND u.Role='Admin' AND u.UserDelete=0
    ORDER BY ui.Fullname");
  ?>

<div class="inner-block">

<div class="blank">
<h2>Users</h2>

<div class="grid_3 grid_4">
<div class="page-header">
<b><u><a href="add_user.php">ADD USER</a></u></b>


</div>  

<div class="bs-example">
<?php
  if($table->num_rows > 0) {
    echo '
    <table class="table" id="dataTables-example" style="font-size: 18px; width: 85%"> 
    <thead>
    <tr class="success">
      <th>Fullname</th>
      <th>Username</th>
      <th>Status</th>
      <th>Action</th>
      
    </tr>
    </thead>

    <tbody>
    ';

    while($obj = $table->fetch_assoc()) {
      echo '<tr>';

      echo '<td>'; 
     echo '<a href="user_detail.php?userid=' .$obj['UserID']. '">';
     echo $obj['Fullname'];
     echo '</a>';
     
      echo '</td>';

      echo '<td>' .$obj['Username']. '</td>';

     echo '<td>';
        if($obj['UserStatus'] == 'Active') {
          echo '<span class="label label-success">Active</span>';
        }

        else {
           echo '<span class="label label-danger">Inactive</span>';
        }

      echo '</td>';

   


      echo '<td>';

       if ($obj['UserStatus'] == 'Active') {
            echo '<a href="status_user.php?userid=' .$obj['UserID']. ' &userstatus=' .$obj['UserStatus']. '">
          <img src="icons/deactivate.png" style="width: 20px; height: 20px;" title="Deactivate User" />
          </a>';
          }
          else {
           echo '<a href="status_user.php?userid=' .$obj['UserID']. ' &userstatus=' .$obj['UserStatus']. '">
          <img src="icons/activate.png" style="width: 20px; height: 20px;" title="Activate User" />
          </a>';
          }


       echo '<a href="edit_user.php?userid=' .$obj['UserID']. '">
          <img src="icons/edit.png" style="width: 20px; height: 20px;" title="Edit User" />
          </a>';

          

       echo '<a href="delete_user.php?userid=' .$obj['UserID']. '&fullname=' .$obj['Fullname']. '" onclick="return confirmRemove()"><img src="icons/delete.png" style="width: 25px; height: 25px;" title="Delete user" /></a>';



      echo '</td>';

      echo '</tr>';
     
     
    }

    echo '
    </tbody>
    </table>

    ';  

  }

  else {
    echo 'No user records available.';
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
  return confirm("Are you sure you want to remove this user?"); 
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
                      
            
