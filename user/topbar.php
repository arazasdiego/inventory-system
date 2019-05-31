 <!-- *** TOPBAR ***
 _________________________________________________________ -->
    <div id="top">
        <div class="container">
            <div class="col-md-6 offer" data-animate="fadeInDown">
                <a href="shop.php" class="btn btn-success btn-sm" data-animate-hover="shake">Order now</a>  <a href="shop.php">Get the products with convenient for a fair price.</a>
            </div>
            <div class="col-md-6" data-animate="fadeInDown">
                <ul class="menu">
                    <li><a href="customer-account.php"><?php echo $urow['Fullname']; ?></a>
                    </li>
                    <li><a href="logout.php" onclick="return confirm('Are you sure you want to logout?')">Logout</a>
                    </li>
                   
                    
                    </li>
                </ul>
            </div>
        </div>

    <?php 
    //Check Cart
    $cart = "SELECT SUM(Qty) AS TotalQty, SUM(Total) AS TotalPrice FROM cart WHERE UserID='$_SESSION[userid]'";
    $cart_list = $conn->query($cart)->fetch_assoc();
    ?>    



    </div>

    <!-- *** TOP BAR END *** -->