<?php
ob_start();
require('../connection.php');
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
  $table = $conn->query("SELECT * FROM vat WHERE ID=1");
  ?>

<div class="inner-block">

<div class="blank">


<div class="grid_3 grid_4">
<div class="page-header">

 <b>Value Added Tax (VAT)</b>
</div>  

<div class="bs-example">
<form method="post">
<?php
  if($table->num_rows > 0) {
    echo '
   
 <table class="table" style="font-size: 16px; width: 40%;">
    <thead>
    <tr class="success">
      
      <th>Name</th>
      <th>Value(%)</th>
      <th>Action</th>
     
    </tr>
    </thead>

    <tbody>
    ';

    $obj = $table->fetch_assoc();
      echo '<tr>';

      echo '<td>' .$obj['Name']. '</td>';

      echo '<td width="30%"><input type="text" name="value" data-parsley-type="number" required value="' .$obj['Value']. '" class="form-control" maxlength="2" /></td>';

      echo '<td><button type="submit" name="submit">Set</button></td>';

      echo '</tr>';

    
    
    echo '
    </tbody>
    </table>
  
    ';  

  }

  else {
    echo 'No record of VAT available.';
  }
  ?>
  </form>
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
if(isset($_POST['submit'])) {
  $value = $_POST['value'];
  $ctr=0;


    if($value > -1) {
      $ctr ++;
    }
    else {
      echo '
      <script>
       window.alert("Negative number is not valid.");
       </script>';
    }

    if($ctr == 1) {
        $update = $conn->query("UPDATE vat SET Value='$value'
      WHERE ID=1");

        $product = $conn->query("SELECT * FROM product WHERE ProductDelete=0");
        while($prodrow = $product->fetch_assoc()) {
          
          //FORMULA FOR MARKUP
          $MarkUpTemp1 = $prodrow['MarkUp'] / 100;
          $MarkUpTemp2 = $prodrow['CostPrice'] * $MarkUpTemp1;
          $retailprice = $prodrow['CostPrice'] + $MarkUpTemp2;

          //VAT
          $vatable = ($value / 100) + 1;
          $vatable_sales = $retailprice / $vatable;
          $vat = ($value / 100) * $vatable_sales; 

          $retailprice2 = $retailprice + $vat;

          $updateprod = $conn->query("UPDATE product SET RetailPrice='$retailprice2'
              WHERE ProductID='$prodrow[ProductID]'");
        }


  echo '<script>
    window.alert("Successfully updated.");
    window.location.href="vat.php";
    </script>';
}
    }


ob_end_flush();
?>
                      
            
