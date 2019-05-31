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

<?php
  $poid = $_GET['poid'];

  $table = $conn->query("SELECT rpo.ID, rpo.Qty, rpo.Description, rpo.Status, rpo.DateAdded,
  p.ProdName, p.ProdImage,
  dr.ReasonName,
  ui.Fullname

  FROM returned_po AS rpo
  INNER JOIN product AS p ON rpo.ProductID=p.ProductID
  INNER JOIN damaged_reason AS dr ON rpo.ReasonID=dr.ReasonID 
  INNER JOIN user_info AS ui ON rpo.AddedBy=ui.UserID
  AND rpo.POID='$poid'");


   $sql = $conn->query("SELECT pot.DeliveryDate, pot.TotalAmount, pot.Status, 
    s.SupplierName, s.SupplierID, s.Email, s.Contact, 
    ui.Fullname
    FROM po_total AS pot
    INNER JOIN supplier AS s ON pot.SupplierID=s.SupplierID
    INNER JOIN user_info AS ui ON pot.UserID=ui.UserID
    AND pot.POID='$poid'");

  $row = $sql->fetch_assoc();


?>
<div class="page-container">

<div class="left-content">
<div class="mother-grid-inner">
    <!--header start here-->
	<?php
	require('header.php');
	?>			
	<!--header end here-->

<!--inner block start here-->
	

<div class="inner-block">

<div class="blank">
 <?php
  echo 
  '
  <ol class="breadcrumb">
        <li><a href="po.php">Purchase List</a></li>
        <li><a href="po_view2.php?poid=' .$poid. '">' .$poid. '</a></li>
        <li class="active">Return Reports</li>
  </ol>
  ';

  ?>
<div class="grid_3 grid_4">
<div class="page-header">

  <b>RETURN REPORTS</b>
 
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

  </div>
  ';


   echo '
   <b>REPORTED ITEMS</b>
    <table class="table" style="font-size: 18px;">
    <thead>
    <tr class="success">
      <th>Image</th>
      <th>Product</th>
      <th>Qty</th>
      <th>Reason</th>
      <th>Description</th>
     
      <th>Date</th>

      <th>Action</th>

    </tr>
    </thead>

    <tbody>
    ';

    while($obj = $table->fetch_assoc()) {
      echo '<tr>';
      
     echo '<td>';
      echo '<a>
      <img src="../prodimage/' .$obj['ProdImage']. '" alt="Product Image" style="width: 50px; height: 50px;" />
      </a> &nbsp;';
      echo '</td>';
      
      

      echo '<td>' .$obj['ProdName']. '</td>';

      echo '<td>' .$obj['Qty']. '</td>';

      echo '<td>' .$obj['ReasonName']. '</td>';

      echo '<td>' .$obj['Description']. '</td>';

    

      echo '<td>' .$obj['DateAdded']. '</td>';

      echo '<td>';

      if($obj['Status'] == 'Pending') {
        echo '<b><a href="po_cancelreturn.php?id=' .$obj['ID']. '">CANCEL</a></b>';
      
      }



      echo '</td>';

      
      echo '</tr>';
    
    
    }
    echo '
    </tbody>
    </table>
    ';  

  }

  else {
    echo 'No records of return items.';
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
                      
						
