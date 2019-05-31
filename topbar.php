 <!-- *** TOPBAR ***
 _________________________________________________________ -->
    <div id="top">
        <div class="container">
            <div class="col-md-6 offer" data-animate="fadeInDown">
                <a href="shop.php" class="btn btn-success btn-sm" data-animate-hover="shake">Order now</a>  <a href="#">Get the products with convenient for a fair price.</a>
            </div>
            <div class="col-md-6" data-animate="fadeInDown">
                <ul class="menu">
                    <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a>
                    </li>
                    <li><a href="register.php">Register</a>
                    </li>
                    <li><a href="contact.php">Contact</a>
                    </li>
                    
                    </li>
                </ul>
            </div>
        </div>



        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
            <div class="modal-dialog modal-sm">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="Login">Login</h4>
                    </div>

    <div class="modal-body">
    <form action="login-exec.php" method="post">
    <div class="form-group">
    <input type="text" class="form-control" id="email-modal" placeholder="email" name="username">
    </div>

    <div class="form-group">
    <input type="password" class="form-control" id="password-modal" placeholder="password" name="password">
    </div>

    <p class="text-center">
    <button class="btn btn-primary" name="login"><i class="fa fa-sign-in"></i> Log in</button>
    </p>

    </form>

                        <p class="text-center text-muted">Not registered yet?</p>
                        <p class="text-center text-muted"><a href="register.php"><strong>Register now</strong></a>! It is easy and done in 1&nbsp;minute and gives you access to special discounts and much more!</p>

                    </div>
                </div>
            </div>
        </div>



    </div>

    <!-- *** TOP BAR END *** -->