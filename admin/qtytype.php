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
	$table = $conn->query("SELECT QtyID, QtyName 
    FROM quantity_type WHERE QtyDelete=0 
    ORDER BY QtyName");
	?>

<div class="inner-block">

<div class="blank">
<h2>Quantity Type</h2>

<div class="grid_3 grid_4">
<div class="page-header">

<b><u><a href="add_qtytype.php">ADD QUANTITY TYPE</a></u></b>

</div>  

<div class="bs-example">
<?php
  if($table->num_rows > 0) {
    echo '
    <table class="table table-striped" id="dataTables-example" style="font-size: 16px; width: 90%;">
    <thead>
    <tr class="success">
      <th>Quantity Name</th>
      <th>Action</th>
    </tr>
    </thead>

    <tbody>
    ';

    while($obj = $table->fetch_assoc()) {
      echo '<tr>';

      echo '<td>' .$obj['QtyName']. '</td>';

      echo '<td>';

       echo '<a href="edit_qtytype.php?qtyid=' .$obj['QtyID']. '">
          <img src="icons/edit.png" style="width: 25px; height: 25px;" title="Edit Quantity Type" />
          </a>';

        

          echo '<a href="delete_qtytype.php?qtyid=' .$obj['QtyID']. '&qtyname=' .$obj['QtyName']. '" onclick="return confirmRemove()">
          <img src="icons/delete.png" style="width: 25px; height: 25px;" title="Delete Quantity Type" />
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
    echo 'No data available.';
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
  return confirm("Are you sure you want to remove this quantity type?"); 
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
                      
						
