<?php
ob_start();
require('../connection.php');
require('session.php');
require('../date.php');
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
  

<div class="inner-block">

<div class="blank">


<div class="grid_3 grid_4">
<div class="page-header">

 <b>DATABASE BACKUP</b>
</div>  

<div class="bs-example">
<form method="post">
<button type="submit" name="submit" onclick="return confirm('Do you want to backup the database?')">Backup database</button>
  </form>

  <hr>

 <?php
  if (isset($_POST['submit'])) {
  define('BACKUP_DIR', '../backupdb' ) ;

// Define  Database Credentials

  define('HOST', 'localhost' ) ;

  define('USER', 'root' ) ;

  define('PASSWORD', '' ) ;

  define('DB_NAME', 'thesis' ) ;
  
    


/*
014.
Define the filename for the sql file
015.
If you plan to upload the  file to Amazon's S3 service , use only lower-case letters
016.
*/

$fileName = 'LPGVILLE_DATABASE(' . date('d-m-Y') . '@'.date('h.i.s').').sql' ;

// Set execution time limit
if(function_exists('max_execution_time')) {
if( ini_get('max_execution_time') > 0 )  set_time_limit(0) ;

}
// Check if directory is already created and has the proper permissions

if (!file_exists(BACKUP_DIR)) mkdir(BACKUP_DIR , 0700) ;

if (!is_writable(BACKUP_DIR)) chmod(BACKUP_DIR , 0700) ;

 

// Create an ".htaccess" file , it will restrict direct accss to the backup-directory .

$content = 'deny from all' ;

$file = new SplFileObject(BACKUP_DIR . '/.htaccess', "w") ;

$file->fwrite($content) ;

 

$mysqli = new mysqli(HOST , USER, PASSWORD , DB_NAME) ;


if (mysqli_connect_errno())

{
printf("Connect failed: %s", mysqli_connect_error());

exit();

}

// Introduction information

$return = "--\n";

$return .= "-- A Mysql Backup System \n";

$return .= "--\n";
$return .= '-- Export created: ' . date("m/d/Y") . ' on ' . date("h:i") . "\n\n\n";

$return = "--\n";

$return .= "-- Database : " . DB_NAME . "\n";
$return .= "--\n";

$return .= "-- --------------------------------------------------\n";

$return .= "-- ---------------------------------------------------\n";

$return .= 'SET AUTOCOMMIT = 0 ;' ."\n" ;

$return .= 'SET FOREIGN_KEY_CHECKS=0 ;' ."\n" ;

$tables = array() ;

// Exploring what tables this database has

$result = $mysqli->query('SHOW TABLES' ) ;

// Cycle through "$result" and put content into an array
while ($row = $result->fetch_row())

{

$tables[] = $row[0] ;

}

// Cycle through each  table

foreach($tables as $table)

{

// Get content of each table

$result = $mysqli->query('SELECT * FROM '. $table) ;

// Get number of fields (columns) of each table

$num_fields = $mysqli->field_count  ;

// Add table information

$return .= "--\n" ;

$return .= '-- Tabel structure for table `' . $table . '`' . "\n" ;

$return .= "--\n" ;

$return.= 'DROP TABLE  IF EXISTS `'.$table.'`;' . "\n" ;

// Get the table-shema

$shema = $mysqli->query('SHOW CREATE TABLE '.$table) ;

// Extract table shema

$tableshema = $shema->fetch_row() ;

// Append table-shema into code

$return.= $tableshema[1].";" . "\n\n" ;

// Cyle through each table-row

while($rowdata = $result->fetch_row())

{

// Prepare code that will insert data into table

$return .= 'INSERT INTO `'.$table .'`  VALUES ( '  ;

// Extract data of each row

for($i=0; $i<$num_fields; $i++)

{

$return .= '"'.$rowdata[$i] . "\"," ;

}

// Let's remove the last comma

$return = substr("$return", 0, -1) ;

$return .= ");" ."\n" ;

}

$return .= "\n\n" ;

}

// Close the connection

$mysqli->close() ;

$return .= 'SET FOREIGN_KEY_CHECKS = 1 ; '  . "\n" ;

$return .= 'COMMIT ; '  . "\n" ;

$return .= 'SET AUTOCOMMIT = 1 ; ' . "\n"  ;

//$file = file_put_contents($fileName , $return) ;

$zip = new ZipArchive() ;

$resOpen = $zip->open(BACKUP_DIR . '/' .$fileName.".zip" , ZIPARCHIVE::CREATE) ;

if( $resOpen ){

$zip->addFromString( $fileName , "$return" ) ;

}

$zip->close() ;

$fileSize = (BACKUP_DIR . "/". $fileName . '.zip');
        
echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Database has been backup Succesfully.!')
    
    </SCRIPT>");
        
$message = <<<msg

<b>Backed up the database successfully!</b>
<hr>
<p>
The name of the database is: <b>  $fileName  </b> and the file location is at:   $fileSize.
</p>
msg;

echo $message ;

 

// Function to append proper Unit after file-size .

function get_file_size_unit($file_size){

switch (true) {

case ($file_size/1024 < 1) :

return intval($file_size ) ." Bytes" ;

break;

case ($file_size/1024 >= 1 && $file_size/(1024*1024) < 1)  :

return intval($file_size/1024) ." KB" ;

break;

default:

return intval($file_size/(1024*1024)) ." MB" ;

}

}

    $message = 'Backed up the database.';
    $insert = $conn->query("INSERT INTO trail(UserID, ID, Message, DateCreated)
    VALUES('$_SESSION[userid]', 'bd', '$message', '$da')");
  
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
                      
            
