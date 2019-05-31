<?php
// Establish connection
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'thesis';

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error) {
	die('Connectionn failed. ' .$conn->connect_error);
}


?>
<!DOCTYPE HTML>
<html>
<head>
<title>Practice</title>
</head>
<body>
<h1>Product List</h1>

<form method="post">
<table>
<thead>
	<tr>
	<th>Product ID</th>
	<th>Product Name</th>
	<th>Stock</th>
	<th>Remove</th>
	</tr>	
</thead>

<tbody>
	<?php
	$sql = $conn->query("SELECT p.ProdName, p.Stock, p.ProductID 
		FROM product AS p ORDER BY p.ProdName");
	
	while($row = $sql->fetch_assoc()) {
		echo '<tr>';

		echo '<td>' .$row['ProductID']. '</td>';

		echo '<td>' .$row['ProdName']. '</td>';

		echo '<td><input type="text" name="stock[' .$row['ProductID']. ']" value="' .$row['Stock']. '"></td>';

		echo '<td><input type="checkbox" name="remove_product[]" value="' .$row['ProductID']. '"></td>';

		echo '</tr>';
	}
	?>
</tbody>	
</table>
<button type="submit">Update Stock / Remove Product</button>
</form>	

<br/>
</body>
</html>

<?php
if(isset($_POST['stock']) && is_array($_POST['stock'])) {
	echo '<h2>Updated stock</h2>';
	$ctr = 1;
	foreach($_POST['stock'] as $key => $value) {
		if(is_numeric($value)) {
			echo $ctr. '.)';
			
			echo 'Key: ' .$key;
		
			echo ' Value: ' .$value;

			echo '<br />';
			$ctr ++;
		}
		
	}
	echo '<br/>';
}

if(isset($_POST['remove_product']) && is_array($_POST['remove_product'])) {
	echo '<h2>Removed product</h2>';
	$ctr = 1;
	foreach($_POST['remove_product'] as $key) {
		echo $ctr. '.)';

		echo $key;

		echo '<br />';
			$ctr ++;
	}
}


?>