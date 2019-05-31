<!--header start here-->
<div class="header-main">
<div class="header-left">
<div class="logo-name">
<a href="dashboard.php"> <h1>LPGVILLE</h1> 
<!--<img id="logo" src="" alt="Logo"/>--> 
</a>                              
</div>
<div class="clearfix"> </div>
</div>


<div class="header-right">
    

    <div class="profile_details_left">
  
    <div class="clearfix"> </div>
    </div>

<div class="profile_details_left"><!--notifications of menu start -->

<div class="clearfix"> </div>
</div>
<!--notification menu end -->



<div class="profile_details">       
<ul>
    <li class="dropdown profile_details_drop">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <div class="profile_img">   
       
        <div class="user-name">
       <?php
        echo '<p>' .$urow['Fullname']. '</p>';
        echo '<span>' .$_SESSION['role']. '</span>';
        ?> 
        

        </div>
        <i class="fa fa-angle-down lnr"></i>
        <i class="fa fa-angle-up lnr"></i>
        <div class="clearfix"></div>    
        </div>  
        </a>
        
        <ul class="dropdown-menu drp-mnu">
           
            <li> <a href="profile.php"><i class="fa fa-user"></i> Account</a> </li> 
            <li> <a href="logout.php" onclick="return confirm('Are you sure you want to logout?')"><i class="fa fa-sign-out"></i> Logout</a> </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="clearfix"> </div>               
                        </div>
                     <div class="clearfix"> </div>  
                </div>
<!--heder end here-->




    
    <!-- script-for sticky-nav  -->
        <script>
        $(document).ready(function() {
             var navoffeset=$(".header-main").offset().top;
             $(window).scroll(function(){
                var scrollpos=$(window).scrollTop(); 
                if(scrollpos >=navoffeset){
                    $(".header-main").addClass("fixed");
                }else{
                    $(".header-main").removeClass("fixed");
                }
             });
             
        });
        </script>

       