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
  $productid = $_GET['productid'];

  $product = $conn->query("SELECT p.ProdName, p.Stock, p.CostPrice, p.MarkUp, p.RetailPrice, p.Threshold, p.ProdDetail, p.ProdImage, p.ProdStatus, p.DateAdded, p.ProductID, p.ProdImage, p.CategoryID, p.QtyID,

    c.CategoryName,
    q.QtyName
   
    FROM product AS p 
    INNER JOIN category AS c ON p.CategoryID=c.CategoryID
    INNER JOIN quantity_type AS q ON p.QtyID=q.QtyID
    AND p.ProductDelete=0
    AND p.ProductID='$productid'");
  $row = $product->fetch_assoc();

 
	$table = $conn->query("SELECT tr.Message, tr.DateCreated, 
     ui.Fullname, tr.ID
    FROM trail AS tr
    INNER JOIN user_info AS ui ON tr.UserID=ui.UserID
    AND tr.ID='$productid'
    ORDER BY tr.DateCreated DESC");
	?>

<div class="inner-block">

<div class="blank">
 <ol class="breadcrumb">
    <li><a href="product.php">View Product</a></li>
    <li class="active">Product Trail</li>
  </ol>

<div class="grid_3 grid_4">
<div class="page-header">
<b>PRODUCT TRAIL</b>

</div>  

<div class="bs-example">
<?php
  if($table->num_rows > 0) {

     echo 
  ' 
  <div class="row mb40">
    <div class="col-md-6">
      
      <table>
      <tr>
        <td><b>Product: </b>' .$row['ProdName']. '</td>
      </tr>

      <tr>
        <td><b>Category: </b>' .$row['CategoryName']. '</td>
      </tr>

      <tr>
        <td><b>Stock: </b>' .$row['Stock']. '</td>
      </tr>

      </table>
    </div>

  </div>
  ';



    echo '
    
  
<table class="table" style="font-size: 18px; width: 100%;">
    <thead>
    <tr class="success">
      <th>Fullname</th>
      <th>Date Added</th>
      <th>Message</th>
    </tr>
    </thead>

    <tbody>
    ';

    while($obj = $table->fetch_assoc()) {

      echo '<tr>';

      echo '<td>' .$obj['Fullname']. '</td>';

      echo '<td>' .$obj['DateCreated']. '</td>';

      echo '<td>' .$obj['Message']. '</td>';

    


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
                      
						
