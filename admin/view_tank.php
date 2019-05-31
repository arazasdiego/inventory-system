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
  $ordersid = $_GET['ordersid'];

  $sql = $conn->query("SELECT tt.OrdersID, tt.DateAdded, tt.Status,
      bd.CustomerName, bd.Mobile, bd.Email, bd.CompleteAddress
    FROM tanks_total AS tt
    INNER JOIN billing_detail AS bd ON tt.OrdersID=bd.OrdersID
    AND tt.OrdersID='$ordersid'");

  $row = $sql->fetch_assoc();

  $table = $conn->query("SELECT t.ID, t.Qty, t.ReturnedQty, t.Status, t.ProductID,
    p.ProdName, p.ProdImage, p.CategoryID, 
    c.CategoryName
    FROM tanks as t
    INNER JOIN product AS p ON t.ProductID=p.ProductID
    INNER JOIN category AS c ON p.CategoryID=c.CategoryID
    AND t.OrdersID='$ordersid'
    ORDER BY p.ProdName");

	?>

<div class="inner-block">

<div class="blank">
 <?php
  echo 
  '
  <ol class="breadcrumb">
        <li><a href="tank.php">Tank List</a></li>
        <li class="active">' .$ordersid. '</li>
  </ol>
  ';

  ?>
<div class="grid_3 grid_4">
<div class="page-header">

</div>  

<div class="bs-example">



<?php
  

  if($table->num_rows > 0) {
    echo 
'
  <div class="row mb40">
    <div class="col-md-6">
      <b>CUSTOMER DETAIL</b>
      <table>
      <tr>
        <td><b>Name: </b>' .$row['CustomerName']. '</td>
      </tr>

      <tr>
        <td><b>Email: </b>' .$row['Email']. '</td>
      </tr>

      <tr>
        <td><b>Contact #: </b>' .$row['Mobile']. '</td>
      </tr>

       <tr>
        <td><b>Address: </b>' .$row['CompleteAddress']. '</td>
      </tr>
    
    </table>
    </div>

     <div class="col-md-6">
      <b>STATUS</b>
      <table>
      <tr>
        <td><b>Status: </b>' .$row['Status']. '</td>
      </tr>

      <tr>
        <td><b>Date: </b>' .$row['DateAdded']. '</td>
      </tr>

     
    
    </table>
    </div>

    
</div>
';


   echo '
   <hr>
   <b>TANKS</b>
  <table class="table" style="font-size: 16px;">
      <tr class="success">
      <th>Image</th>
      <th><center>Product</th>
      <th><center>Category</th>
      <th><center>Qty</th>
      <th><center>Returned</th>
 
      <th><center>Action</td>

    </tr>
   

   
    ';

    while($obj = $table->fetch_assoc()) {
      
    echo '<tr>';

      echo '<td>';
      echo '<a>
      <img src="../prodimage/' .$obj['ProdImage']. '" alt="Product Image" style="width: 50px; height: 50px;" />
      </a>';
      echo '</td>';
     
      echo '<td align="center">' .$obj['ProdName']. '</td>';

      echo '<td align="center">' .$obj['CategoryName']. '</td>';

      echo '<td align="center">' .$obj['Qty']. '</td>';

      echo '<td align="center">' .$obj['ReturnedQty']. '</td>';

      
      
      echo '<td align="center">';



      if($obj['Qty'] > $obj['ReturnedQty']) {
         
       echo '<a href="tank_receive.php?id=' .$obj['ID']. '">
          <img src="icons/inventory.png" style="width: 25px; height: 25px;" title="Receive tank" />
          </a>';
      }
    


      
      echo '</td>';

    
      echo '</tr>';
      
     
   		
    }
    echo '
   
    </table>
  
    ';  

  }

  else {
    echo 'No tank records available.';
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
  return confirm("Are you sure you want to remove this damaged product report from the supplier?"); 
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
                      
						
