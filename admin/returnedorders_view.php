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

  $sql = $conn->query("SELECT ro2.OrdersID, ro2.DateAdded, 
    bd.CustomerName
    FROM returned_orders2 as ro2
    INNER JOIN billing_detail AS bd ON ro2.OrdersID=bd.OrdersID
    ");

  $row = $sql->fetch_assoc();

  $table = $conn->query("SELECT ro.Qty, ro.DateAdded, ro.Status, ro.ID, ro.ProductID, ro.OrdersID, 
    p.ProdName, p.ProdImage,
    dr.ReasonName,
    ui.Fullname,
    bd.CustomerName
  FROM returned_orders AS ro 
  INNER JOIN product AS p ON ro.ProductID=p.ProductID
  INNER JOIN damaged_reason AS dr ON ro.ReasonID=dr.ReasonID
  INNER JOIN user_info AS ui ON ro.Received=ui.UserID
  INNER JOIN billing_detail AS bd ON ro.OrdersID=bd.OrdersID
  AND ro.OrdersID='$ordersid'
  ORDER BY ro.DateAdded DESC");

	?>

<div class="inner-block">

<div class="blank">
 <?php
  echo 
  '
  <ol class="breadcrumb">
        <li><a href="returnedorders.php">Returned Orders</a></li>
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
      <b>RETURN DETAILS</b>
      <table>
      <tr>
        <td><b>Customer: </b>' .$row['CustomerName']. '</td>
      </tr>

      <tr>
        <td><b>Date: </b>' .$row['DateAdded']. '</td>
      </tr>

      </table>
    </div>
</div>
';


   echo '
   <b>RETURNED ORDERS</b>
  <table class="table" style="font-size: 16px;">
      <tr class="success">
      <th>Image</th>
      <th><center>Product</th>
      <th><center>Qty</th>
      <th><center>Reason</th>
      <th><center>Date</th>
      
      <th><center>Action</th>

    </tr>
   

   
    ';

    while($obj = $table->fetch_assoc()) {
      
    echo '<tr>';
      echo '<td>
      <a>
      <img src="../prodimage/' .$obj['ProdImage']. '" alt="Product Image" style="width: 50px; height: 50px;" />
      </a>';
      
      echo '</td>';
    
      
      echo '<td align="center">' .$obj['ProdName']. '</td>';

      echo '<td align="center">' .$obj['Qty']. '</td>';

      echo '<td align="center">' .$obj['ReasonName']. '</td>';

     
      echo '<td align="center">' .$obj['DateAdded']. '</td>';

     

      echo '<td align="center">';

      if($obj['Status'] == 'Pending') {

        echo '<a href="returnedorders-inventory.php?id=' .$obj['ID']. '">
        <img src="icons/inventory.png" style="width: 25px; height: 25px;" title="RETURN TO INVENTORY" /></a> ';

       echo '<a href="returnedorders-damage.php?id=' .$obj['ID']. '">
        <img src="icons/damage.png" style="width: 25px; height: 25px;" title="REPORT AS DAMAGE" /></a>';
      }
      else if($obj['Status'] == 'Returned to inventory') {
          echo 'Returned to inventory';
      }
      else {
        echo 'Reported as damaged';
      } 

      echo '</td>';
      
      echo '</tr>';
      
     
   		
    }
    echo '
   
    </table>
    ';
    


   

  }

  else {
    echo 'No records.';
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
                      
						
