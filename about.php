<?php
ob_start();
require('connection.php');
require('date.php');
session_start();


if(empty($_SESSION['userid']) === TRUE){
        $_SESSION['userid'] = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Obaju e-commerce template">
    <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz">
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
   $cms = $conn->query("SELECT * FROM cms WHERE ID=1");
   $cmsrow = $cms->fetch_assoc();
   ?>

    <?php
    require('topbar.php');
    ?>

    <!-- *** NAVBAR ***
 _________________________________________________________ -->

    <div class="navbar navbar-default yamm" role="navigation" id="navbar">
        <div class="container">
            <div class="navbar-header">

               <a class="navbar-brand home" href="index.php" data-animate-hover="bounce">
                    <h3>LPGVILLE</h3><span class="sr-only">LPGVILLE - go to homepage</span>
                </a>
                
            </div>
            <!--/.navbar-header -->
    <div class="navbar-collapse collapse" id="navigation">
        <ul class="nav navbar-nav navbar-left">
        <li><a href="index.php">Home</a></li>
        <li><a href="shop.php">Shop</a></li>
        <li class="active"><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
        <?php 
        if(!empty($_SESSION['userid'])) {
             echo '<li><a href="customer_orders.php">My Order</a></li>';
        }
        ?>

    </ul>
    </div>
            <!--/.nav-collapse -->

    <div class="navbar-buttons">
    <?php
    $ctr = 0;
    $totalqty = 0;
    if(isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"])>0) {
        foreach ($_SESSION["cart_products"] as $cart_itm) {
            $product_qty = $cart_itm["product_qty"];
            $totalqty = $product_qty + $totalqty;
        }
    $ctr = count($_SESSION["cart_products"]);
 
    }

    if($ctr > 0) {
        echo '
        <div class="navbar-collapse collapse right" id="basket-overview">
        <a href="basket.php" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span class="hidden-sm">' .$totalqty. ' item(s)</span></a>
        </div>

    ';
    }
    ?>
    </div>

           
    <!--/.nav-collapse -->

    </div>
        <!-- /.container -->
    </div>
    <!-- /#navbar -->

    <!-- *** NAVBAR END *** -->

    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="index.php">Home</a>
                        </li>
                        <li>Contact</li>
                    </ul>

                </div>

    <div class="col-md-3">
                    <!-- *** PAGES MENU ***
 _________________________________________________________ -->
    <div class="panel panel-default sidebar-menu">

    <div class="panel-heading">
    <h3 class="panel-title">Pages</h3>
    </div>

    <div class="panel-body">
    <ul class="nav nav-pills nav-stacked">
        <li><a href="index.php">Home page</a></li>
        
        <li><a href="contact.php">Contact page</a></li>
                                
        <li><a href="about.php">About page</a></li>

    </ul>

    </div>
    </div>

    <!-- *** PAGES MENU END *** -->


                    
    </div>

    <div class="col-md-9">


    <div class="box" id="contact">
    <h1>About</h1>
    <img src="slider/blog2.jpg" class="img-responsive" alt="Example blog post alt">

    <hr>

    <?php
    echo 
    '
    <p>' .$cmsrow['about']. '</p>
    '
    ?>
   

    <hr>

   <!-- /#comments -->
	<div id="comment-form" data-animate="fadeInUp">
	<b>Comments or suggestions</b>
	
	<form method="post">
    <div class="row">
		<div class="col-sm-6">
    	<div class="form-group">
    	<label for="name">Name <span class="required">*</span></label>
    	<input type="text" class="form-control" id="name" name="fullname" required />
    	</div>
    	</div>
	</div>

    <div class="row">
        <div class="col-sm-6">
        <div class="form-group">
        <label for="email">Email <span class="required">*</span></label>
        <input type="email" class="form-control" id="email" name="email" required>
        </div>
        </div>
    </div>

    <div class="row">
    	<div class="col-sm-12">
        <div class="form-group">
        <label for="comment">Message <span class="required">*</span></label>
        <textarea class="form-control" id="comment" rows="4" name="message" required></textarea>
        </div>
        </div>
    </div>

    <div class="row">
    	<div class="col-sm-12">
    	<button type="submit" name="submit">Submit</button>
    	</div>
    </div>
    </form>
	</div>
    <!-- /#comment-form -->

                        

   </div>


                </div>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->


      
       



    </div>
    <!-- /#all -->

    <?php
    require('footer.php');
    ?>
    

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




    


</body>

</html>

<?php

if(isset($_POST['submit'])) {
	$fullname = $_POST['fullname'];
	$email = $_POST['email'];
	$message = $_POST['message'];

	$insert = $conn->query("INSERT INTO feedback(Fullname, Email, Message)
			VALUES('$fullname', '$email', '$message')");

	echo '<script>
		window.alert("We receive your feedback. Thank you for visting the LPGVILLE.");
		window.location.href="about.php";
		</script>';
}


ob_end_flush();
?>