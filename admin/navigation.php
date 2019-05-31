<!--slider menu-->
<div class="sidebar-menu">
<div class="logo"> <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="#"> <span id="logo" ></span> 
<!--<img id="logo" src="" alt="Logo"/>--> 
</a> 
</div>  


<div class="menu">
<ul id="menu" >
    <li id="menu-home" ><a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>

    <?php
    if($urow['Inventory'] == 1) {
      echo 
      '
        <li><a href="product.php"><i class="fa fa-list"></i><span>Inventory</span><span class="fa fa-angle-right" style="float: right"></span></a>
        <ul>
            <li><a href="product.php">Products</a></li>
            
            <li><a href="category.php">Category</a></li>
            
            <li><a href="qtytype.php">Quantity Type</a></li>

             <li><a href="supplier.php">Supplier</a></li>

 <li><a href="damaged_reason.php">Reason</a></li>       


             <li><a href="tank.php">Tanks</a></li>

                
        </ul>
    </li>

      ';
    }



    if($urow['PO'] == 1) {
      echo 
      '
      <li id="menu-comunicacao" ><a href="po.php"><i class="fa fa-truck nav_icon"></i><span>Purchase</span><span class="fa fa-angle-right" style="float: right"></span></a>
        <ul id="menu-comunicacao-sub" >
           
        <li id="menu-arquivos" ><a href="add_po.php">Add Purchase</a></li>
        
        <li id="menu-arquivos" ><a href="po.php">Purchase List</a></li>

             <li id="menu-academico-avaliacoes" ><a href="returnedpo.php">Returned Purchase</a></li>

        </ul>
    </li>
      ';
    }




    if($urow['Orders'] == 1) {
      echo 
      '
     <li><a href="online_sales.php"><i class="fa fa-shopping-cart"></i><span>Sales</span><span class="fa fa-angle-right" style="float: right"></span></a>
        <ul id="menu-academico-sub" >
            <li id="menu-academico-avaliacoes" ><a href="online_sales.php">Online Orders</a></li>

            <li id="menu-academico-avaliacoes" ><a href="sales.php">Walkin Orders</a></li>

            <li id="menu-academico-avaliacoes" ><a href="cancelled_order.php">Cancelled Orders</a></li>

            <li id="menu-academico-avaliacoes" ><a href="add_sales.php">Add Walkin Order</a></li>

            <li id="menu-academico-avaliacoes" ><a href="returnedorders.php">Return Orders</a></li>

            
           
        </ul>
    </li>
     
    </li>
      ';
    }

    if($urow['Reports'] == 1) {
      echo 
      '
      
      <li><a href="threshold.php"><i class="fa fa-file-text"></i><span>Reports</span><span class="fa fa-angle-right" style="float: right"></span></a>
        <ul id="menu-academico-sub" >
            <li id="menu-academico-avaliacoes" ><a href="threshold.php">Product Alerts</a></li>

          

           
             <li id="menu-academico-boletim" ><a href="purchase.php">Purchase Report</a></li>

          <li id="menu-academico-boletim" ><a href="product_report.php">Product Report</a></li>

           <li id="menu-academico-boletim" ><a href="supplier_report.php">Supplier Report</a></li>


               <li id="menu-academico-avaliacoes" ><a href="inventory_log.php">Inventory Log</a></li>
                 
    <li id="menu-academico-avaliacoes" ><a href="productsalesreport.php">Product Sales</a></li>

      <li id="menu-academico-avaliacoes" ><a href="daily.php">Daily Product Sales</a></li>



              <li id="menu-academico-boletim" ><a href="sales_report.php">Sales Report</a></li>
        </ul>
    </li>
      ';
    }

    if($urow['Settings'] == 1) {
      echo 
      '
       <li><a href="user.php"><i class="fa fa-cogs"></i><span>Settings</span><span class="fa fa-angle-right" style="float: right"></span></a>

     <ul id="menu-academico-sub"> ';
          if($urow['Role'] == 'Superadmin') {
            echo 
            '
            <li id="menu-academico-avaliacoes" ><a href="user.php">Manage Users</a></li>

              <li id="menu-academico-boletim" ><a href="trail.php">View Trail</a></li>


             
            ';
          }
            echo '
            <li id="menu-academico-avaliacoes" ><a href="city.php">Delivery Fee</a></li>

            
           
           
             <li id="menu-academico-avaliacoes" ><a href="customer.php">Customer Accounts</a></li>

          
            <li id="menu-academico-avaliacoes" ><a href="bank.php">Bank Accounts</a></li>

           


            <li id="menu-academico-avaliacoes" ><a href="vat.php">VAT</a></li>

            <li id="menu-academico-boletim" ><a href="company_profile.php">Company Profile</a></li>

             <li id="menu-academico-boletim" ><a href="discount.php">Price Discount</a></li>


             
               <li id="menu-academico-boletim" ><a href="cms.php">CMS</a></li>

              
        </ul>
      
    </li>
      ';
    }

     if($urow['Settings'] == 1) {
     echo 
      '
        <li><a href="databasebackup.php"><i class="fa fa-cogs"></i><span>Settings2</span><span class="fa fa-angle-right" style="float: right"></span></a>
        <ul>
            <li><a href="databasebackup.php">Database Backup</a></li>

             <li><a href="transaction_setting.php">Transaction Setting</a></li>
            
              <li><a href="limit_orders.php">Order Limit</a></li>

              <li><a href="feedback.php">Feedbacks</a></li>
                
        </ul>
    </li>

      ';

    }
    ?>
  
 

   


    

    



    
    


   
    </ul>
</div>
     
</div>
    
<div class="clearfix"> </div>

<!--slide bar menu end here-->

<script>
var toggle = true;
            
$(".sidebar-icon").click(function() {                
  if (toggle)
  {
    $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
    $("#menu span").css({"position":"absolute"});
  }
  else
  {
    $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
    setTimeout(function() {
      $("#menu span").css({"position":"relative"});
    }, 400);
  }               
                toggle = !toggle;
            });
</script>