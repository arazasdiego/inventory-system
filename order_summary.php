 <?php
    $delivery_fee = 0;
    if(!empty($_SESSION['cityname'])) { 

        $fee = $conn->query("SELECT * FROM city WHERE CityName='$_SESSION[cityname]'");
        $feerow = $fee->fetch_assoc();

       $_SESSION['delivery_fee'] = $totalqty * $feerow['CityFee'];

       
       
    }
    $_SESSION['grandamount'] = $_SESSION['subamount'] + $_SESSION['delivery_fee'];
   
    ?>

  <div class="col-md-3">


  <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">Order Summary</h3>
                        </div>

    <div class="panel-body">
    <div class="table-responsive">
     <p class="text-muted">Delivery and additional costs are calculated based on the values you have entered.</p>

    <table class="table">
    <tbody>
    
    <tr>
        <td>Subtotal</td>
        <th><?php echo formatMoney($_SESSION['subamount'], true); ?></th>
    </tr>
                                   
   <?php
   if(!empty($_SESSION['delivery_fee'])) {
        echo 
        '
        <tr>
        <td>Delivery Fee</td>
        <th>' .formatMoney($_SESSION['delivery_fee'], true). '</th>
    </tr>
        ';
   }
   ?>
    
    <tr class="total">
        <td>Total</td>
        <th><?php echo formatMoney($_SESSION['grandamount'], true); ?></th>

        
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