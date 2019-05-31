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
  $table = $conn->query("SELECT * FROM bank WHERE BankDelete=0");
  ?>

<div class="inner-block">

<div class="blank">
<h2>Bank Accounts</h2>

<div class="grid_3 grid_4">
<div class="page-header">
<b><u><a href="add_bank.php">ADD BANK</a></u></b>
</div>  

<div class="bs-example">
<?php
  if($table->num_rows > 0) {
    echo '
    <table class="table" id="dataTables-example" style="font-size: 18px; width: 90%"> 
    <thead>
    <tr class="success">
      <th>Bank</th>
      <th>Account Name</th>
      <th>Account Number</th>
      <th>Action</th>
      
    </tr>
    </thead>

    <tbody>
    ';

    while($obj = $table->fetch_assoc()) {
      echo '<tr>';

      echo '<td>' .$obj['BankName']. '</td>';

      echo '<td>' .$obj['AccountName']. '</td>';

      echo '<td>' .$obj['AccountNumber']. '</td>';

      echo '<td>';
      
      echo '<a href="edit_bank.php?bankid=' .$obj['BankID']. '">
          <img src="icons/edit.png" style="width: 25px; height: 25px;" title="Edit Bank" />
          </a>';


      echo '<a href="delete_bank.php?bankid=' .$obj['BankID']. '&bankname=' .$obj['BankName']. '" onclick="return confirmRemove()">
          <img src="icons/delete.png" style="width: 25px; height: 25px;" title="Delete Bank Account" />
          </a>';


      echo '</td>';

      echo '</tr>';
     
    }

    echo '
    </tbody>
    </table>

    ';  

  }

  else {
    echo 'No bank account records available.';
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
  return confirm("Are you sure you want to remove this bank account?"); 
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
                      
            
