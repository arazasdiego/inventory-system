<?php
ob_start();
require('../connection.php');
require('session.php');
?>

<!DOCTYPE HTML>
<html>
  <?php
  require('head.php');
  ?>
<body>  
<div class="page-container">

<div class="left-content">
<div class="mother-grid-inner">
    <!--header start here-->
  <?php
  require('header.php');
  ?>      
  <!--header end here-->

<!--inner block start here-->
  <?php
  $table = $conn->query("SELECT * FROM cms WHERE ID=1");
  $obj = $table->fetch_assoc();
  ?>

<div class="inner-block">

<div class="blank">


<div class="grid_3 grid_4">
<div class="page-header">

 <b>CMS</b>
</div>  

<div class="bs-example">

<?php
  if($table->num_rows > 0) {
    echo 
    '
     <form method="post" action="cms-exec.php" enctype="multipart/form-data">

<div class="row mb40">
  <div class="col-md-2">
    <h5>Footer: </h5>
    </div>

  <div class="col-md-6">
    <textarea name="footer" class="form-control" required>'.$obj['footer'].'
    </textarea>
  </div>
</div>  


<div class="row mb40">
  <div class="col-md-2">
    <h5>Contact Address: </h5>
    </div>

    <div class="col-md-6">
     <textarea name="contact_address" class="form-control" required>'.$obj['contact_address'].'
    </textarea>
    </div>
</div>  


<div class="row mb40">
  <div class="col-md-2">
    <h5>Contact MainText: </h5>
    </div>

     <div class="col-md-6">
     <textarea name="contact_text" class="form-control" required>'.$obj['contact_text'].'
    </textarea>
    </div>
</div>  

<div class="row mb40">
  <div class="col-md-2">
    <h5>About: </h5>
    </div>

     <div class="col-md-6">
     <textarea name="about" class="form-control" required>'.$obj['about'].'
    </textarea>
    </div>
</div>  





 

<div class="row mb40">
  <div class="col-md-2">
    <h5>Home (Title 1): </h5>
    </div>

   <div class="col-md-6">
     <textarea name="home_title1" class="form-control" required>'.$obj['home_title1'].'
    </textarea>
  </div>
</div>


<div class="row mb40">
  <div class="col-md-2">
    <h5>Home (Text 1): </h5>
    </div>

   <div class="col-md-6">
     <textarea name="home_text1" class="form-control" required>'.$obj['home_text1'].'
    </textarea>
  </div>
</div>

<div class="row mb40">
  <div class="col-md-2">
    <h5>Home (Title 2): </h5>
    </div>

   <div class="col-md-6">
     <textarea name="home_title2" class="form-control" required>'.$obj['home_title2'].'
    </textarea>
  </div>
</div>

<div class="row mb40">
  <div class="col-md-2">
    <h5>Home (Text 2): </h5>
    </div>

   <div class="col-md-6">
     <textarea name="home_text2" class="form-control" required>'.$obj['home_text2'].'
    </textarea>
  </div>
</div>



<div class="row mb40">
  <div class="col-md-2">
    <h5>Home (Title 3): </h5>
    </div>

   <div class="col-md-6">
     <textarea name="home_title3" class="form-control" required>'.$obj['home_title3'].'
    </textarea>
  </div>
</div>
	
	<hr>

<div class="row mb40">
  <div class="col-md-2">
    <h5>Home (Text 3): </h5>
    </div>

   <div class="col-md-6">
     <textarea name="home_text3" class="form-control" required>'.$obj['home_text3'].'
    </textarea>
  </div>
</div>
<hr>
 <div class="row mb40">
    <div class="col-md-2">
    <h5>Slider 1: </h5>
    </div>

    <div class="col-md-4">
    <input type="file" name="slider1" class="form-control" />
    </div>

    <div class="col-md-4">
   <img src="../slider/' .$obj['slider1']. '" alt="Slider Image 1" style="width: 300px; height: 100px;" />
    </div>
</div>

   <div class="row mb40">
    <div class="col-md-2">
    <h5>Slider 2: </h5>
    </div>

    <div class="col-md-4">
    <input type="file" name="slider2" class="form-control" />
    </div>

     <div class="col-md-4">
   <img src="../slider/' .$obj['slider2']. '" alt="Slider Image 2" style="width: 300px; height: 100px;" />
    </div>
</div>
	<input type="hidden" name="old_slider1" value="' .$obj['slider1']. '">
	<input type="hidden" name="old_slider2" value="' .$obj['slider2']. '">
	
   <div class="row mb40">
    <div class="col-md-2">
    <button type="submit" name="submit">Update</button>
    </div>


  </div>
  </form>
    ';
  

  }

  else {
    echo 'No record of cms';
  }
  ?>
  </div>


</div>
</div>

</div>
<!--inner block end here-->

<!--footer-->
<?php 
require('footer.php');
?>  
<!--footer-->

</div>
</div>


<!--slider menu-->
  <?php
  require('navigation.php');
  ?>
</div>
<!--slider bar menu end here-->



<!--scrolling js-->
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <!--//scrolling js-->
<script src="js/bootstrap.js"> </script>
<!-- mother grid end here-->

<!--Parsley script-->
<script src="../parsleyjs/dist/parsley.min.js"></script>
<script>
$(document).ready(function(){
    $('form').parsley();
});
</script>

<script>
function confirmRemove() {
  return confirm("Are you sure you want to remove this category?"); 
}
</script>

<!-- DATA TABLE SCRIPTS -->
<script src="../plugins/dataTables/jquery.dataTables.js"></script>
<script src="../plugins/dataTables/dataTables.bootstrap.js"></script>

<script>
  $(document).ready(function () {
  $('#dataTables-example').dataTable();
  });
</script>


</body>
</html>

<?php

ob_end_flush();
?>
                      
            
