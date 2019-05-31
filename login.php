<?php
ob_start();
require('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Guest | Login</title>
<meta charset="UTF-8">
</head>
<body>
<header>
<h2>Login</h2>	
</header>

<section>
<form method="post" action="login-exec.php">
<label>Username</label>
<input type="text" name="username" />
<br />

<label>Password</label>
<input type="password" name="password" />
<br />

<input type="submit" name="login" value="Login" />
</form>
</section>

<footer>
<p>Created and Design by : FEU Diliman IT </p>
</footer>
</body>
</html>

<?php
ob_end_flush();
?>