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
  $poid = $_GET['poid'];

  $sql = $conn->query("SELECT pot.DeliveryDate, pot.TotalAmount, pot.Status, 
    s.SupplierName, s.SupplierID, s.Email, s.Contact, 
    ui.Fullname
    FROM po_total AS pot
    INNER JOIN supplier AS s ON pot.SupplierID=s.SupplierID
    INNER JOIN user_info AS ui ON pot.UserID=ui.UserID
    AND pot.POID='$poid'");

  $row = $sql->fetch_assoc();

  $table = $conn->query("SELECT po.ProductID, po.Price, po.TotalPrice, po.RequestedQty, po.POStatus, po.ReceivedQty, po.ReturnedQty, po.ID,
    p.ProdName, p.ProdImage, p.Stock
    FROM po as po
    INNER JOIN product AS p ON po.ProductID=p.ProductID
    AND po.POID='$poid'
    ORDER BY p.ProdName");

  $returned_po = $conn->query("SELECT * FROM returned_po WHERE POID='$poid'");

	?>

<div class="inner-block">

<div class="blank">
 <?php
  echo 
  '
  <ol class="breadcrumb">
        <li><a href="po.php">Purchase Order</a></li>
        <li class="active">' .$poid. '</li>
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
      <b>SUPPLIER DETAIL</b>
      <table>
      <tr>
        <td><b>Name: </b>' .$row['SupplierName']. '</td>
      </tr>

      <tr>
        <td><b>Email: </b>' .$row['Email']. '</td>
      </tr>

      <tr>
        <td><b>Contact #: </b>' .$row['Contact']. '</td>
      </tr>
    
    </table>
    </div>

    <div class="col-md-6">
      <b>PURCHASE DETAIL</b>
      <table>
      <tr>
        <td><b>Delivery Date: </b>' .$row['DeliveryDate']. '</td>
      </tr>

      <tr>
        <td><b>Requested By: </b>' .$row['Fullname']. '</td>
      </tr>

        <tr>
        <td><b>Status: </b>' .$row['Status']. '</td>
      </tr>
      ';

      if($returned_po->num_rows > 0) {
        echo 
        '
        <tr>
        <td><b>VIEW: <a href="po_returnlist.php?poid=' .$poid. '">RETURN REPORT</a></b></td>
      </tr>
        ';
      }
      echo'      
      </table>
    </div>
</div>
';


   echo '
   <b>PURCHASE PRODUCTS</b>
  <table class="table" style="font-size: 16px;">
      <tr class="success">
      <th>Image</th>
      <th><center>Product</th>
      <th><center>Stock</th>
      <th><center>Price</th>
      <th><center>Requested</th>
      <th><center>Total</th>
      <th><center>Received</th>

      <th><center>Action</td>

    </tr>
   

   
    ';

    while($obj = $table->fetch_assoc()) {
      
    echo '<tr>';

      echo '<td>';
      echo '<a>
      <img src="../prodimage/' .$obj['ProdImage']. '" alt="Product Image" style="width: 50px; height: 50px;" />
      </a> &nbsp;';
      echo '</td>';
     
      echo '<td align="center">' .$obj['ProdName']. '</td>';

      echo '<td align="center">' .$obj['Stock']. '</td>';

      echo '<td align="center">' .formatMoney($obj['Price'], true). '</td>';

      echo '<td align="center">' .$obj['RequestedQty']. '</td>';

      echo '<td align="center">' .formatMoney($obj['TotalPrice'], true). '</td>';

      echo '<td align="center">' .$obj['ReceivedQty']. '</td>';

    
     
      
      echo '<td align="center">';



      if($obj['ReceivedQty'] < $obj['RequestedQty']) {
         
       echo '<a href="po_receive.php?id=' .$obj['ID']. '">
          <img src="icons/inventory.png" style="width: 25px; height: 25px;" title="Receive item" />
          </a>';
      }
    


    
      if($obj['ReceivedQty'] > 0 && $obj['Stock'] > 0) {

         echo '<a href="po_return.php?id=' .$obj['ID']. '">
          <img src="icons/damage.png" style="width: 25px; height: 25px;" title="Return item to supplier" />
          </a>';
       }

    
      
      echo '</td>';

    
      echo '</tr>';
      
     
   		
    }
    echo '
   
    </table>
   <center>
    <table style="font-size: 16px; width: 50%;">
    <tr>
      <th>Total Amount:</th>
      <td>' .formatMoney($row['TotalAmount'], true). '</td>
    </tr>
    ';
    


    echo '
    </table>
    </center>
    ';  

  }

  else {
    echo 'No purchase records available.';
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
                      
						
