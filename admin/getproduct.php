<?php

require('../connection.php');
require('../format_money.php');

$q = $_GET['q'];


	$table = $conn->query("SELECT il.TotalReceivedPO, il.TotalDamaged, il.TotalStockSold, il.TotalSales,
  
    p.ProdName, p.Stock, p.CostPrice, p.MarkUp, p.RetailPrice, p.Threshold, p.ProdDetail, p.ProdImage, p.ProdStatus, p.DateAdded, p.ProductID, p.ProdImage, p.CategoryID, p.QtyID,

    c.CategoryName,
    q.QtyName
    
    
    FROM inventorylog AS il
    INNER JOIN product AS p ON il.ProductID=p.ProductID 
    INNER JOIN category AS c ON p.CategoryID=c.CategoryID
    INNER JOIN quantity_type AS q ON p.QtyID=q.QtyID
    

    AND il.ProductID='$q'
    ");


  $sql2 = $conn->query("SELECT * FROM business_profile");
  $row2 = $sql2->fetch_assoc();


  $sql3 = $conn->query("SELECT p.ProdName, p.Stock, p.CostPrice, p.MarkUp, p.RetailPrice, p.Threshold, p.ProdDetail, p.ProdImage, p.ProdStatus, p.DateAdded, p.ProductID, p.ProdImage, p.CategoryID, p.QtyID,

    c.CategoryName,
    q.QtyName
    
    FROM product AS p 
    INNER JOIN category AS c ON p.CategoryID=c.CategoryID
    INNER JOIN quantity_type AS q ON p.QtyID=q.QtyID
   
    AND p.ProductID='$q'
    ");
  $row3 = $sql3->fetch_assoc();
	?>
<button onclick="printPage('block1');">Click Here to Print</button>

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
  <td align="center"><?php echo $row2['BusinessEmail'];?></td> 
  
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
      <b>PRODUCT INFORMATION</b>
      <table>
      <tr>
        <td><b>Name: </b>' .$row3['ProdName']. '</td>
      </tr>

      <tr>
        <td><b>Category: </b>' .$row3['CategoryName']. '</td>
      </tr>

       <tr>
        <td><b>Quantity Type: </b>' .$row3['QtyName']. '</td>
      </tr>

      
    </table>
    </div>

   
</div>
';


    echo '
   
   

    <b>INVENTORY LOG</b>
    <center><table class="table" style="font-size: 18px; width: 100%; cellspacing: 20px;"> 
    <thead>
    <tr class="success">
      
    
      <th>Product</th>
      <th><center>Received </th>
      <th><center>Sales</th>
      <th><center>Stock Sold</th>
      <th><center>Damaged</th>
      <th><center>Stock</th>
    </tr>  
    </thead>

    <tbody>
    ';
    $obj = $table->fetch_assoc();

      echo '<tr>';

      echo '<td>' .$obj['ProdName']. '</td>';
   
      echo '<td align="center">' .$obj['TotalReceivedPO']. '</td>';

      echo '<td align="center">' .formatMoney($obj['TotalSales'], true). '</td>';

      echo '<td align="center">' .$obj['TotalStockSold']. '</td>';

      echo '<td align="center">' .$obj['TotalDamaged']. '</td>';

      echo '<td align="center">' .$obj['Stock']. '</td>';

      echo '</tr>';

     
    
    echo 
    '
    </tbody>
    </table></center>

    ';

  }

  else {
    echo 'No product.';
  }
  ?>

  </div>

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