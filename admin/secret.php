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
  $table = $conn->query("SELECT * FROM product WHERE ProductDelete=0");
   
	?>

<div class="inner-block">

<div class="blank">

<div class="grid_3 grid_4">
<div class="page-header">

</div>  

<div class="bs-example">
<?php
  if($table->num_rows > 0) {
 
 echo '
    <hr>
    <form method="post" action="secret-update.php">
    <b>SECRET</b>
    <table class="table" style="font-size: 16px; width: 50%;"> 
    <thead>
    <tr class="success">
      <th>Image</th>
      <th><center>Product</th>
      <th><center>Stock</th>
    
      
    </tr>
    </thead>

    <tbody>
    ';

    while($obj = $table->fetch_assoc()) {
      echo '<tr>';

      echo '<td>
      <a>
      <img src="../prodimage/' .$obj['ProdImage']. '" alt="Product Image" style="width: 50px; height: 50px;" />
      </a>';
     
      echo '</td>';

      echo '<td align="center">' .$obj['ProdName']. '</td>';
     
   
         echo '<td align="center"><input type="text" size="2" maxlength="3" class="form-control" name="stock[' .$obj['ProductID']. ']" value="'  .$obj['Stock']. '" data-parsley-type="number" required /></td>';

     

      echo '</tr>';
     }

   

    echo '
    </tbody>
    </table>
   
    <hr>
    <center>
<button type="submit" name="submit">Update Stock</button>
     <hr>
    
    </form>


    ';  

   
  }

  else {
    echo 'Add a product to continue.';
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
ob_end_flush();
?>
                      
						
