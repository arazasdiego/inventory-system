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
<?php
$sql = $conn->query("SELECT * FROM product ORDER BY ProdName");

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
<h2>Inventory Log</h2>

<div class="grid_3 grid_4">
<div class="page-header">
<form>
    <table class="table" style="font-size: 16px; width: 50%;">
    <tr>
    <td>Search: </td>

    <td>
    <select name="productid" onchange="showProduct(this.value)" class="form-control"> 
   <option value="">Select a product:</option>
   <?php 
  while ($row = $sql->fetch_assoc()) {
    echo '<option value="' .$row['ProductID']. '">' .$row['ProdName']. '</option>';
  }
   ?> 
 
</select>
  </td>

   
    </tr>
    </form>
    <tr>
    <td></td>
    </tr>
     </table>
</div>  

<div class="bs-example">
 
 <div id="txtHint">

 <h4>Product info will be listed here...</h4>
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


<script>
function showProduct(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","getproduct.php?q="+str,true);
        xmlhttp.send();
    }
}
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
                      
						
