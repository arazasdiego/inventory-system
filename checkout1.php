<?php
ob_start();
require('connection.php');
require('format_money.php');
session_start();
$sql = $conn->query("SELECT * FROM city");

if(empty($_SESSION['cityname']) === TRUE){
    $_SESSION['cityname'] = '';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="keywords" content="">

    <title>
        LPG Ville Trading Shop
    </title>

    <meta name="keywords" content="">

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>

    <!-- styles -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">

    <!-- theme stylesheet -->
    <link href="css/style.default.css" rel="stylesheet" id="theme-stylesheet">

    <!-- your stylesheet with modifications -->
    <link href="css/custom.css" rel="stylesheet">

    <script src="js/respond.min.js"></script>

    <link rel="shortcut icon" href="favicon.png">

    <style type="text/css">
        
.wrapper{
    //padding-top: 20px;
    padding-top: 50px;
}

input.parsley-error,
select.parsley-error,
textarea.parsley-error {    
    border-color:#843534;
    box-shadow: none;
}


input.parsley-error:focus,
select.parsley-error:focus,
textarea.parsley-error:focus {    
    border-color:#843534;
    box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 6px #ce8483
}


.parsley-errors-list {
    list-style-type: none;
    opacity: 0;
    transition: all .3s ease-in;

    color: #d16e6c;
    margin-top: 5px;
    margin-bottom: 0;
  padding-left: 0;
}

.parsley-errors-list.filled {
    opacity: 1;
    color: #a94442;
}
</style>


</head>

<body>
    <?php
    require('topbar.php');
    require('shop-navbar.php');
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
        <li class="active"><a href="#"><i class="fa fa-map-marker"></i><br>Billing Address</a>
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
        <input type="text" class="form-control" name="customername" value="<?=isset($_SESSION['customername']) ? $_SESSION['customername'] :'' ?>" required />
        </div>
        </div>

        <div class="col-sm-6">
        <div class="form-group">
        <label>Mobile Number</label>
        <input type="text" class="form-control" name="mobile" value="<?=isset($_SESSION['mobile']) ? $_SESSION['mobile'] :'' ?>" required />
        </div>
        </div>
       
        </div>
        <!-- /.row -->

        <div class="row">
        

        <div class="col-sm-6">
        <div class="form-group">
        <label>Email</label>
        <input type="text" class="form-control" name="email" value="<?=isset($_SESSION['email']) ? $_SESSION['email'] :'' ?>" required />
        </div>
        </div>

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


        </div>
        <!-- /.row -->
                      

        <div class="row">
        
        <div class="col-sm-6">
        <div class="form-group">
        <label>Complete Address(House Number, Street Name, Barangay)</label>
        <input type="text" class="form-control" name="address" value="<?=isset($_SESSION['address']) ? $_SESSION['address'] :'' ?>" required />
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


    

    <!-- *** SCRIPTS TO INCLUDE ***
 _________________________________________________________ -->
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap-hover-dropdown.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/front.js"></script>

    <!--Parsley -->
<script src="parsleyjs/dist/parsley.min.js"></script>
<script>
$(document).ready(function(){
    $('form').parsley();
});
</script>




</body>

</html>


</html>

<?php 
if(isset($_POST['submit_detail'])) {
    $_SESSION['customername'] = $_POST['customername']; 
    $_SESSION['mobile'] = $_POST['mobile'];
    $_SESSION['cityname'] = $_POST['cityname'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['address'] = $_POST['address'];
   
    

    header('location: checkout2.php');
}
ob_end_flush();
?>