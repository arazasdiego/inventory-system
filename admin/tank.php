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
	$table = $conn->query("SELECT tt.OrdersID, tt.DateAdded, tt.Status,
      bd.CustomerName
    FROM tanks_total AS tt
    INNER JOIN billing_detail AS bd ON tt.OrdersID=bd.OrdersID
    ORDER BY tt.DateAdded");
	?>

<div class="inner-block">

<div class="blank">
<h2>Tanks</h2>

<div class="grid_3 grid_4">
<div class="page-header">


</div>  

<div class="bs-example">
<?php
  if($table->num_rows > 0) {
    echo '
    <table class="table" id="dataTables-example" style="font-size: 18px; width: 90%;">
    <thead>
    <tr class="success">
      <th>OrdersID</th>
      <th><center>Customer</th>
      <th><center>Date Ordered</th>

       <th><center>Status</th>
    
    
      <th><center>Action</th>
    </tr>
    </thead>

    <tbody>
    ';

    while($obj = $table->fetch_assoc()) {

      echo '<tr>';

      echo '<td>' .$obj['OrdersID']. '</td>';

      echo '<td align="center">' .$obj['CustomerName']. '</td>';

      echo '<td align="center">' .$obj['DateAdded']. '</td>';

      echo '<td align="center">' .$obj['Status']. '</td>';


   

      echo '<td align="center">';

      echo '<a href="view_tank.php?ordersid=' .$obj['OrdersID']. '"><img src="icons/inventory.png" style="width: 25px; height: 25px;" title="Receive empty tank"></a> &nbsp;';

    
     

      echo '</td>';



      echo '</tr>';
    
   		
    }
    echo '
    </tbody>
    </table>
    ';  

  }

  else {
    echo 'No purchase order records available.';
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
  return confirm("Are you sure you want to remove this supplier?"); 
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
                      
						
