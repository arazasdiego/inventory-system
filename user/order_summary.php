 <?php
 $crtsmmry = $conn->query("SELECT c.Qty, c.Price, c.Total, c.ProductID,   
        p.ProdName, p.ProdImage
        FROM cart AS c
        INNER JOIN product AS p ON c.ProductID=p.ProductID
        AND UserID='$_SESSION[userid]'
        ORDER BY p.ProdName");

?>
  <div class="col-md-3">


  <div class="panel panel-default sidebar-menu">

    <div class="panel-heading">
    <h3 class="panel-title">Order Summary</h3>
    </div>

    <div class="panel-body">
    <div class="table-responsive">
     <p class="text-muted">Additional costs are calculated based on the values you have entered.</p>

    <table class="table">
    <tbody>
  
   
    <?php
    while ($crtitm = $crtsmmry->fetch_assoc()) {
        echo '<tr>';

        echo '<td>' .$crtitm['ProdName']. ' (' .$crtitm['Qty']. 'pcs.)</td>';

        echo '<td align="right">' .formatMoney($crtitm['Total'], true). '</td>';

        echo '</tr>';
    }
    ?>   

    <tr>
        <th>Subtotal: </th>
        <td><?php echo formatMoney($cart_list['TotalPrice'], true); ?></td>
    </tr>
    <?php
    $delivery_fee = 0;
    if(!empty($_SESSION['cityname'])) {

        if($_SESSION['transactiontype'] == 'Delivery') {

            $fee = $conn->query("SELECT * FROM city WHERE CityName='$_SESSION[cityname]'");
        $feerow = $fee->fetch_assoc();

        $delivery_fee = $cart_list['TotalQty'] * $feerow['CityFee'];
      
        echo 
        '
        <tr>
            <td>Delivery Fee: </td>
            <td align="right">' .formatMoney($delivery_fee, true). '
            </td>
        </tr>
        ';  



        }
        
    
    }
    
    if($_SESSION['transactiontype'] == 'Pickup') {
         $delivery_fee = 0;
    }


    $_SESSION['delivery_fee'] = $delivery_fee;
    $grandamount = $cart_list['TotalPrice'] + $delivery_fee;
    $_SESSION['grandamount'] = $grandamount;
    $_SESSION['amountpayable'] = $grandamount - 0;
    ?>      	                         
   
    
    <tr class="total">
        <td>Total: </td>
        <th align="right"><?php echo formatMoney($grandamount, true); ?></th>

        
    </tr>

    <tr>

        <td><a>(VAT included)</a></td>

    </tr>
    
    </tbody>
    </table>
    </div>
        </div>

        </div>


    

    </div>