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
  $table = $conn->query("SELECT p.ProdName, p.Stock, p.CostPrice, p.MarkUp, p.RetailPrice, p.Threshold, p.ProdDetail, p.ProdImage, p.ProdStatus, p.DateAdded, p.ProductID, p.ProdImage, p.CategoryID, p.QtyID, 

    c.CategoryName,
    q.QtyName
    FROM product AS p 
    INNER JOIN category AS c ON p.CategoryID=c.CategoryID
    INNER JOIN quantity_type AS q ON p.QtyID=q.QtyID
    AND p.ProductDelete=0
    ORDER BY p.ProdName");
  ?>

<div class="inner-block">

<div class="blank">
<h2>Product</h2>

<div class="grid_3 grid_4">
<div class="page-header">

<b><u><a href="add_product.php">ADD PRODUCT</a></u></b>

</div>  

<div class="bs-example">

<?php
  if($table->num_rows > 0) {
    echo '
    <table class="table" id="dataTables-example" style="font-size: 16px;"> 
    <thead>
    <tr class="success">
      <th>Image</th>
      <th>Name</th>
      <th><center>Category</th>
      
      <th><center>Stock</th>
      <th><center>Cost</th>
      <th><center>Mark(%)</th>
      <th><center>Retail</th>
      <th><center>Threshold</th>
      <th><center>Status</th>
      <th><center>Action</th>
      
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
      echo '<td><a href="product_detail.php?productid=' .$obj['ProductID']. '">' .$obj['ProdName']. '</a></td>';

      echo '<td align="center">' .$obj['CategoryName']. '</td>';

     
      echo '<td align="center">' .$obj['Stock']. '</td>';

      echo '<td align="center">' .formatMoney($obj['CostPrice'], true). '</td>';

      echo '<td align="center">' .$obj['MarkUp']. '</td>';

      echo '<td align="center">' .formatMoney($obj['RetailPrice'], true). '</td>';

      echo '<td align="center">' .$obj['Threshold']. '</td>';

      echo '<td>';
        if($obj['ProdStatus'] == 'Active') {
          echo '<span class="label label-success">Active</span>';
        }

        else {
           echo '<span class="label label-danger">Inactive</span>';
        }

      echo '</td>';



      echo '<td>';

      if ($obj['ProdStatus'] == 'Active') {
            echo '<a href="status_product.php?productid=' .$obj['ProductID']. ' &prodstatus=' .$obj['ProdStatus']. '">
          <img src="icons/deactivate.png" style="width: 20px; height: 20px;" title="Deactivate Product" />
          </a>';
          }
          else {
           echo '<a href="status_product.php?productid=' .$obj['ProductID']. ' &prodstatus=' .$obj['ProdStatus']. '">
          <img src="icons/activate.png" style="width: 20px; height: 20px;" title="Activate Product" />
          </a>';
          }


       echo '<a href="edit_product.php?productid=' .$obj['ProductID']. '">
          <img src="icons/edit.png" style="width: 20px; height: 20px;" title="Edit Product" />
          </a>';
         
           echo '<a href="add_stock.php?productid=' .$obj['ProductID']. '">
          <img src="icons/add.png" style="width: 20px; height: 20px;" title="Add Stock" />
          </a>';

          echo '<a href="product_trail.php?productid=' .$obj['ProductID']. '">
          <img src="icons/report.png" style="width: 20px; height: 20px;" title="View Product Trail" />
          </a>';

           
          
          echo '<a href="delete_product.php?productid=' .$obj['ProductID']. '&prodname=' .$obj['ProdName']. '" onclick="return confirmRemove()">
          <img src="icons/delete.png" style="width: 20px; height: 20px;" title="Delete Product" />
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
    echo 'No products yet.';
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
                      
						
