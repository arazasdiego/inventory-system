 <?php
 	require('../connection.php');
   $cms = $conn->query("SELECT * FROM cms WHERE ID=1");
   $cmsrow = $cms->fetch_assoc();
   ?>

<div class="copyrights">
	 
 <?php
                   echo 
                   '
                   <p>© ' .$cmsrow['footer']. '</p>
                   ';
                   ?>
</div>	