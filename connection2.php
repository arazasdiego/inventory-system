<!--CONNECTION -->
<?php
$servername = '';
$username = '';
$password = '';
$database = '';

$conn = new mysqli($servername, $username, $password, $database);

//Create connection
if($conn->connect_error) {
	die('Connection failed.' .$conn->connect_error);
}

?>



<!--LOGIN USER-->
<form method="post">
<label>Username: </label>
<input type="text" name="username" />
<br />

<label>Password: </label>
<input type="password" name="password" />
<br />

<button type="submit" name="login">Sign in</button>
</form>


<?php
if(isset($_POST['login'])) {
	$username = $conn->real_escape_string($_POST['username']);
	$password = $conn->real_escape_string($_POST['password']);

	$user_check = $conn->query("SELECT * FROM user WHERE Username='$username' AND Password='$password'");
	if($user_check->num_rows > 0) {
		$userrow = $user_check->fetch_assoc();
		$fullname = $userrow['Fullname'];
		session_start();
		$_SESSION['UserID'] = $userrow['UserID'];

		if($userrow['Role'] == 'Administrator') {
			echo ("<script>
					window.alert('Welcome $fullname.');
					window.location.href='admin/dashboard.php';
					</script>");
		}
		else {
			echo ("<script>
					window.alert('Welcome $fullname.');
					window.location.href='admin/dashboard.php';
					</script>");
		}
	}
	else {
		echo ("<script>
				window.alert('Login failed.');
				window.location.href='login.php';
				</script>");

	}
}
?>



<!--REGISTER USER -->
<form method="post">
<label>Fullname</label>
<input type="text" name="fullname" value="<?=isset($_POST['fullname']) ? $_POST['fullname'] : '' ?>" required />
<br />

<label>Contact Number</label>
<input type="text" name="contactnumber" value="<?=isset($_POST['contactnumber']) ? $_POST['contactnumber'] : '' ?>" required />

<label>Email</label>
<input type="email" name="email" value="<?=isset($_POST['email']) ? $_POST['email'] : '' ?>" required />
<br />

<label>Username</label>
<input type="text" name="username" value="<?=isset($_POST['username']) ? $_POST['username'] : '' ?>" required />
<br />

<label>Password</label>
<input type="password" name="password1" required />
<br />

<label>Re-type Password</label>
<input type="password" name="password2" />
<br />

<button type="submit" name="register">Register</button>
</form>

<?php
if(isset($_POST['register'])) {
	$counter = 0;

	$email_check = $conn->query("SELECT * FROM user WHERE Email='$_POST[email]'");
	if($email_check->num_rows > 0) {
		echo ("<script>
				window.alert('This email is already taken.');
				</script>");
	}
	else {
		$counter ++;
	}

	if($_POST['password1'] == $_POST['password2']) {
		$counter ++;
	}
	else {
		echo ("<script>
				window.alert('Password does not match.')
				</script>");
	}

	if(!preg_match("/^[A-Za-z'. -]+$/", stripcslashes($_POST['fullname']))) {
		echo ("<script>
				window.alert('Fullname not valid.')
				</script>");
	}
	else {
		$counter ++;
	}

	if(!preg_match("/^[0-9]+$/", $_POST['contactnumber'])) {
		echo ("<script>
				window.alert('Contact Number not valid.')
				</script>");
	}
	else {
		$counter ++;
	}

	if($counter == 4) {
		$insert = "INSERT INTO user(Fullname, ContactNumber, Email, Username, Password)
			VALUES('$_POST[fullname]', '$_POST[contactnumber]', '$_POST[email]', '$_POST[username]', '$_POST[password1]')";

		if($conn->query($insert) === TRUE) {
			echo ("<script>
					window.alert('Succefully created. You can now login to your account.');
					window.location.href='index.php';
					</script>");
		}

		else {
			echo 'Error.' .$insert. '<br />' .$conn->error;
		}	

	}
}
?>


<!-- VIEW USER -->

<?php
$table = $conn->query("SELECT u.Fullname, u.ContactNumber, u.Email, u.Username, u.UserID
	FROM user AS u ORDER BY u.Fullname ASC");

if($table->num_rows > 0) {
	echo
	'
	<table>
	<thead>
	<tr>
	<th>Fullname</th>
	<th>Contact #</th>
	<th>Email</th>
	<th>Username</th>
	<th>Action</th>
	</tr>
	</thead>
	
	<tbody>
	';

	while($row = $table->fetch_assoc()) {
		echo '<tr>';

		echo '<td>' .$row['Fullname']. '</td>';

		echo '<td>' .$row['ContactNumber']. '</td>';

		echo '<td>' .$row['Email']. '</td>';

		echo '<td>' .$row['Username']. '</td>';

		echo '<td>';
		echo '<a href="delete_user.php?userid=' .$row['UserID']. '&fulllname=' .$row['Fullname']. '">Delete</a> &nbsp';

		echo '<a href="update_user.php?userid=' .$row['UserID']. '">Update</a>';
		echo '</td>';
	}

	echo 
	'
	</tbody>
	</table>
	';
}
else {
	echo 'No user records available.';
}
?>

