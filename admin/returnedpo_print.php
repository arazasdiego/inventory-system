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

 $sql = $conn->query("SELECT rpoo.POID, rpoo.SupplierID, rpoo.DateAdded,
    s.SupplierName, s.Email, s.Contact
    
    FROM returned_po2 AS rpoo
    INNER JOIN supplier AS s ON rpoo.SupplierID=s.SupplierID
    AND rpoo.POID='$poid'");
  $row = $sql->fetch_assoc();


  $sql2 = $conn->query("SELECT * FROM business_profile");
  $row2 = $sql2->fetch_assoc();


	$table = $conn->query("SELECT rpo.ID, rpo.Qty, rpo.Description, rpo.Status, rpo.DateAdded, rpo.POID, rpo.ReasonID, rpo.AddedBy, rpo.ProductID, 
  p.ProdName, p.ProdImage,
  dr.ReasonName,
  ui.Fullname

  FROM returned_po AS rpo
  INNER JOIN product AS p ON rpo.ProductID=p.ProductID
  INNER JOIN damaged_reason AS dr ON rpo.ReasonID=dr.ReasonID 
  INNER JOIN user_info AS ui ON rpo.AddedBy=ui.UserID
  AND rpo.POID='$poid'
  ORDER BY p.ProdName");
	?>

<div class="inner-block">

<div class="blank">
   <?php
  echo 
  '
  <ol class="breadcrumb">
        <li><a href="returnedpo.php">Returned Purchase</a></li>
        <li class="active">Print Returned Purchase</li>
  </ol>
  ';

  ?>
<div class="grid_3 grid_4">
<div class="page-header">
 <table>
  <tr>
    <td><button onclick="printPage('block1');">Click here to print</button></td>  
  </tr>
  </table>
</div>  

<div class="bs-example">

<div id="block1">
<center>
   <table>
  <tr>
  
  <td align="center"><?php echo $row2['BusinessName'];?></td> 

  </tr>

  <tr>
  <td align="center"><?php echo $row2['BusinessAddress'];?></td> 
  
  </tr>

  
  <tr>
  <td align="center"><?php echo $row2['BusinessContact'];?></td> 
  
  </tr>

   <tr>
  <td align="center">TIN: <?php echo $row2['TIN'];?></td> 
  
  </tr>

  </table>
</center>
<hr>
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
      <b>RETURN PURCHASE DETAIL</b>
      <table>
      <tr>
        <td><b>Date: </b>' .$row['DateAdded']. '</td>
      </tr>
      </table>
    </div>
</div>
';

    echo '
<hr>
    <b>RETURNED PRODUCTS</b>
    <table class="table" style="font-size: 16px; width: 100%; cellspacing: 20px;">

   <tr class="success">
     <th>Product</th>
      <th><center>Qty</th>
      <th><center>Reason</th>
      <th><center>Description</th>
    </tr>
   

   
    ';

    while($obj = $table->fetch_assoc()) {

      echo '<tr>';

      echo '<td>' .$obj['ProdName']. '</td>';

      echo '<td align="center">' .$obj['Qty']. '</td>';

      echo '<td align="center">' .$obj['ReasonName']. '</td>';

      echo '<td align="center">' .$obj['Description']. '</td>';

      echo '</tr>';
      
     
    }
    echo '
    </table>
  

  ';  

 

  }

  else {
    echo 'No returned records available.';
  }
  ?>

  </div>

  
  
 
 
 
  

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

<script>

function printPage(id)
{
   var html="<html>";
   html+= document.getElementById(id).innerHTML;
   html+="</html>";
  
   var printWin = window.open('', 'my div', 'height=500,width=700');
   printWin.document.write(html);
   printWin.document.close();
   printWin.focus();
   printWin.print();
   printWin.close();
   

}
  </script>


</body>
</html>

<?php
ob_end_flush();
?>
                      
						
