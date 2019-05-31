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
  $table = $conn->query("SELECT * FROM transaction_setting");
  ?>

<div class="inner-block">

<div class="blank">


<div class="grid_3 grid_4">
<div class="page-header">

 <b>TRANSACTION ORDER SETTING</b>
</div>  

<div class="bs-example">

<?php
  if($table->num_rows > 0) {
    echo '
   
 <table class="table" style="font-size: 16px; width: 50%;">
    <thead>
    <tr class="success">
      
      <th>Transaction</th>
      <th>Status</th>
      <th>Action</th>
     
     
    </tr>
    </thead>

    <tbody>
    ';
    while($obj = $table->fetch_assoc()) {
        echo '<tr>';

      echo '<td>' .$obj['TransactionName']. '</td>';


    echo '<td>';
        if($obj['Status'] == 1) {
          echo '<span class="label label-success">On</span>';
        }

        else {
           echo '<span class="label label-danger">Off</span>';
        }

      echo '</td>';


       echo '<td>';

          
          

           if ($obj['Status'] == 1) {
            echo '<a href="status_transaction.php?id=' .$obj['ID']. '&status=' .$obj['Status']. '">
          <img src="icons/deactivate.png" style="width: 20px; height: 20px;" title="Turn off" />
          </a>';
          }
          else {
           echo '<a href="status_transaction.php?id=' .$obj['ID']. '&status=' .$obj['Status']. '">
          <img src="icons/activate.png" style="width: 20px; height: 20px;" title="Turn on" />
          </a>';
          }



      echo '</tr>';

    }
    
    
    
    
    echo '
    </tbody>
    </table>
  
    ';  

  }

  else {
    echo 'No record of transaction setting.';
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
                      
            
