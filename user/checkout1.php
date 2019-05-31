<?php
ob_start();
require('../connection.php');
require('session.php');
require('../format_money.php');

if(empty($_SESSION['cityname']) === TRUE){
    $_SESSION['cityname'] = '';
}

?>



<!DOCTYPE html>
<html lang="en">

 <?php
    require('head.php');
    ?>

<body>
    <?php
    require('topbar.php');
    require('shop-navbar.php');

    $sql = $conn->query("SELECT * FROM city WHERE CityDelete=0");

    ?>


    <div id="all">

        <div id="content">
            <div class="container">

    <div class="col-md-12">
    <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li><a href="basket.php">Shopping Cart</a></li>
        <li>Checkout - Address</li>
    </ul>
    </div>

                <div class="col-md-9" id="checkout">

    
    <div class="box">
    <form method="post">
    <h1>Checkout</h1>
    <ul class="nav nav-pills nav-justified">

      <li><a href="checkout1-type.php"><i class="fa fa-shopping-cart"></i><br>Transaction Method</a>
        </li>



        <li class="active"><a href="#"><i class="fa fa-map-marker"></i><br>Address</a>
        </li>
                                
      

        <li class="disabled"><a href="#"><i class="fa fa-money"></i><br>Payment Method</a>
        </li>

        <li class="disabled"><a href="#"><i class="fa fa-eye"></i><br>Order Review</a>
        </li>
        </ul>

        <div class="content">
        <center>
        <div class="row">
        <div class="col-sm-6">
        <div class="form-group">
        <label>First & Last name</label>
        <input type="text" class="form-control" name="customername" value="<?php echo $urow['Fullname'];?>" disabled />
        </div>
        </div>

        <div class="col-sm-6">
        <div class="form-group">
        <label>Mobile Number</label>
        <input type="text" class="form-control" name="mobile" value="<?php echo $urow['Contact'];?>" disabled />
        </div>
        </div>
       
        </div>
        <!-- /.row -->

        <div class="row">
        

        <div class="col-sm-6">
        <div class="form-group">
        <label>Email</label>
        <input type="text" class="form-control" name="email" value="<?php echo $urow['Email'];?>" disabled />
        </div>
        </div>




        <?php
        if($_SESSION['transactiontype'] == 'Delivery') {
        ?>


        <div class="col-sm-6">
        <div class="form-group">
        <label>City/Munipacility</label>
        <?php
        if(empty($_SESSION['cityname']) === TRUE){
            echo '
        <select class="form-control" name="cityname" required>
        <option value="" selected="selected"> - Select - </option>';
        while($row = $sql->fetch_assoc()) {
            echo '<option value="' .$row['CityName']. '">' .$row['CityName']. '</option>
            ';
        }
       
        echo '
          </select>
        ';
        }

        else {
             echo '
        <select class="form-control" name="cityname" required>
        <option value="' .$_SESSION['cityname']. '" selected="selected">' .$_SESSION['cityname']. '</option>';
        while($row = $sql->fetch_assoc()) {
            echo '<option value="' .$row['CityName']. '">' .$row['CityName']. '</option>
            ';
        }
       
        echo '
          </select>
        ';
        }

      
         ?>
        </div>
        </div>

        <?php
        }
        ?>




        <?php
        if($_SESSION['transactiontype'] == 'Pickup') {
        ?>
        <div class="col-sm-6">
        <div class="form-group">
        <label>City/Munipacility</label>
        <?php
        
            echo '
        <select class="form-control" name="cityname">
        <option value="" selected="selected"></option>';
        while($row = $sql->fetch_assoc()) {
            echo '<option value="' .$row['CityName']. '">' .$row['CityName']. '</option>
            ';
        }
       
        echo '
          </select>
        ';
        ?>

       
        </div>
        </div>
        <?php
        }
        ?>






        </div>
        <!-- /.row -->
                      

        <div class="row">
        
        <div class="col-sm-6">
        <div class="form-group">
        <label>Complete Address(House Number, Street Name, Barangay)</label>
        <input type="text" class="form-control" name="address" value="<?php echo $urow['Address'];?>" disabled />
        </div>
        </div>

       
        </div>
        <!-- /.row -->

        </div>

        <div class="box-footer">
        <div class="pull-left">
        <a href="basket.php" class="btn btn-default"><i class="fa fa-chevron-left"></i>Back to basket</a>
        </div>
        
        <div class="pull-right">
        <button type="submit" class="btn btn-primary" name="submit_detail">Continue to Payment Method<i class="fa fa-chevron-right"></i>
        </button>
        </div>
        </div>
        </form>
        </div>
        <!-- /.box -->


    </div>
    
    <!-- /.col-md-9 -->
    <?php
    require('order_summary.php');
    ?>
      <!-- /.col-md-3 -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->

     <?php
     require('footer.php');
     ?>



    </div>
    <!-- /#all -->


    

   


</body>

</html>


</html>

<?php 
if(isset($_POST['submit_detail'])) {
   
    $_SESSION['cityname'] = $_POST['cityname'];
  
    
   
    

    header('location: checkout2.php');
}
ob_end_flush();
?>