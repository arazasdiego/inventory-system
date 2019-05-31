<?php
ob_start();
require('../connection.php');
require('session.php');
?>

<!DOCTYPE html>
<html lang="en">

    <?php
    require('head.php');
    ?>

<body>
    <?php
    require('topbar.php');
    ?>

    <?php
   $cms = $conn->query("SELECT * FROM cms WHERE ID=1");
   $cmsrow = $cms->fetch_assoc();
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
   <div class="navbar-collapse collapse" id="navigation">
    <ul class="nav navbar-nav navbar-left">
        <li><a href="index.php">Home</a></li>
        <li><a href="shop.php">Shop</a></li>
        <li class="active"><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
        
        <li><a href="customer_orders.php">My Orders</a></li>
    </ul>    
        
    </div>
    </div>
            <!--/.nav-collapse -->

    <div class="navbar-buttons">
    <?php
    if($cart_list['TotalQty'] > 0) {
        echo 
        '
        <div class="navbar-collapse collapse right" id="basket-overview">
        <a href="basket.php" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span class="hidden-sm">' .$cart_list['TotalQty']. ' item(s)</span></a>
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


 <img src="../slider/blog2.jpg" class="img-responsive" alt="Example blog post alt">

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
        <input type="text" class="form-control" id="name" name="fullname" value="<?php echo $urow['Fullname']; ?>" required />
        </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
        <div class="form-group">
        <label for="email">Email <span class="required">*</span></label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $urow['Email']; ?>" required>
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