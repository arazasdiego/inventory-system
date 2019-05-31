<?php
ob_start();
require('../connection.php');
require('session.php');
require('../format_money.php');
?>
<!DOCTYPE html>
<html lang="en">

<?php
require('head.php');
?>

<body>
    <?php
    require('topbar.php');

    $table = $conn->query("SELECT * FROM orders_total WHERE OrderBy='$_SESSION[userid]'");

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
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li class="active"><a href="customer_orders.php">My Orders</a></li>
        
    </div>
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
        <li><a href="index.php">Home</a></li>
        <li>My account</li>
    </ul>
    </div>

    <div class="col-md-3">
    <!-- *** CUSTOMER MENU ***
 _________________________________________________________ -->
    <div class="panel panel-default sidebar-menu">

    <div class="panel-heading">
    <h3 class="panel-title">Customer section</h3>
    </div>

    <div class="panel-body">

    <ul class="nav nav-pills nav-stacked">
        <li>
        <a href="customer_orders.php"><i class="fa fa-list"></i> My orders</a>
        </li>
                               
        <li class="active">
        <a href="customer-account.php"><i class="fa fa-user"></i> My account</a>
        </li>

        <li>
        <a href="logout.php" onclick="return confirm('Are you sure you want to logout?')"><i class="fa fa-sign-out"></i> Logout</a>
        </li>
    </ul>
    </div>

    </div>
    <!-- /.col-md-3 -->

    <!-- *** CUSTOMER MENU END *** -->
    </div>

    <div class="col-md-9" id="customer-orders">
    <div class="box">
    <h1>My account</h1>
    <p class="text-muted">This is your personal information. Make sure to update us if you need help.</p>
   
    <hr>

    <?php
    if($user->num_rows > 0) {
        echo 
    '
    <div class="table-responsive">
    <table class="table table-hover">
    <thead>
    <tr class="success">
        <th>Fullname</th>
        <th>Contact #</th>
        <th>Complete Address</th>
    </tr>
    </thead>
    
    <tbody>
    ';
    
        echo '<tr>';   

        echo '<td>' .$urow['Fullname']. '</td>';

        echo '<td>';
        if(empty($urow['Contact'])) {
            echo 'Empty';
        }
        else {
            echo $urow['Contact'];
        } 
 
        echo '</td>';

        echo '<td>';
        if(empty($urow['Address'])) {
            echo 'Empty';
        }
        else {
            echo $urow['Address'];
        } 
 
        echo '</td>';


       
        echo '</tr>';
    
    
    echo 
    '
    </tbody>
    </table>
    </div>
    ';
    }
    else {
        echo '<h5>No user record.</h5>';
    }
    
    ?>
    <hr>

    <h3>Change Password</h3>
    <form method="post" action="customer-account-exec.php">
     <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_old">Old password</label>
                                        <input type="password" class="form-control" name="old_password" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_1">New password</label>
                                        <input type="password" class="form-control" name="new_password" id="pass2" class="form-control" required data-parsley-length="[6, 15]" data-parsley-trigger="keyup" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_2">Retype new password</label>
                                        <input type="password" class="form-control" data-parsley-equalto="#pass2" data-parsley-trigger="keyup" required />
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                             <div class="col-sm-12 text-center">
                              <button type="submit" name="save_password"><i class="fa fa-save"></i> Save new password</button>
                            </div>
    </form>

    <hr>


     <h3>Personal Detail</h3>
   <form method="post" action="customer-account-exec.php">
     <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_old">Fullname</label>
                                        <input type="text" class="form-control" name="fullname" value="<?php echo $urow['Fullname']; ?>" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_1">Contact</label>
                                        <input type="text" class="form-control" name="contact" placeholder="e.g. 9231234342" value="<?php echo $urow['Contact']; ?>" required />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_2">Complete Address</label>
                                        <input type="text" class="form-control" name="address" required value="<?php echo $urow['Address']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                             <div class="col-sm-12 text-center">
                               <button type="submit" name="save_detail"><i class="fa fa-save"></i> Save changes</button>
                            </div>
    </form>
    <hr>

   
   
         
    </div>
    </div>

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

<?php
ob_end_flush();
?>