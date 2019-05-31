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
  $table = $conn->query("SELECT * FROM discount WHERE DiscountDelete=0
    ORDER BY DiscountName");
  ?>

<div class="inner-block">

<div class="blank">
<h2>Discount Type List</h2>

<div class="grid_3 grid_4">
<div class="page-header">
<b><u><a href="add_discount.php">ADD DISCOUNT TYPE</a></u></b>

</div>  

<div class="bs-example">
<?php
  if($table->num_rows > 0) {
    echo '
    <table class="table" id="dataTables-example" style="font-size: 18px; width: 90%"> 
    <thead>
    <tr class="success">
      <th>Discount</th>
      <th>Value(%)</th>
      <th>Action</th>
      
    </tr>
    </thead>

    <tbody>
    ';

    while($obj = $table->fetch_assoc()) {
      echo '<tr>';

      echo '<td>' .$obj['DiscountName']. '</td>';

      echo '<td>' .$obj['DiscountValue']. '</td>';

      echo '<td>';
       echo '<a href="edit_discount.php?discountid=' .$obj['DiscountID']. '">
          <img src="icons/edit.png" style="width: 25px; height: 25px;" title="Edit Discount Type" />
          </a>';

            echo '<a href="delete_discount.php?discountid=' .$obj['DiscountID']. '&discountname=' .$obj['DiscountName']. '" onclick="return confirmRemove()">
          <img src="icons/delete.png" style="width: 25px; height: 25px;" title="Delete Discount" />
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
    echo 'No discount type records available.';
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
  return confirm("Are you sure you want to remove this discount type?"); 
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
                      
            
