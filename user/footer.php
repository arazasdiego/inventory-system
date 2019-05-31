 <?php
   $cms = $conn->query("SELECT * FROM cms WHERE ID=1");
   $cmsrow = $cms->fetch_assoc();
   ?>
   
  <!-- *** FOOTER ***
 _________________________________________________________ -->
  <div id="footer" data-animate="fadeInUp">
  <div class="container">
  
  <div class="row">
     <!-- /.col-md-3 -->

                    <div class="col-md-12">

                        <h4>Where to find us</h4>

                         <?php
    echo 
    '
     <p>' .$cmsrow['contact_address']. '</p>
    ';
    ?>

                        <a href="contact.html">Go to contact page</a>

                        <hr class="hidden-md hidden-lg">

                    </div>
                    <!-- /.col-md-3 -->
               

  </div>
  

  </div>
  
  </div>
      

  <!-- *** FOOTER END *** -->

  
  <!-- *** COPYRIGHT ***
 _________________________________________________________ -->
  <div id="copyright">
            <div class="container">
            
                <div class="col-md-6">
                   <?php
                   echo 
                   '
                   <p>© ' .$cmsrow['footer']. '</p>
                   ';
                   ?>
                </div>
            </div>
        </div>
        <!-- *** COPYRIGHT END *** -->



    </div>
    <!-- /#all -->


    