<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial- scale=1.0">
<title>Validataion</title>
</head>
<body>
<?php
$_SESSION['uname'] = "";
$_SESSION['pass'] = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
isset($_POST['username'])) {
$username = $_POST['username'];
$password = $_POST['password'];
$_SESSION['uname'] = $username;
$_SESSION['pass'] = $password;
$fdata = fopen('data.txt', "r");
$_SESSION['validated'] = false;
while (($line = fgets($fdata)) !== false) {
$data = explode(" ", $line);
if ($data[0] == $username && trim($data[1]) == $password) {
$_SESSION['validated'] = true; break;
}

}

if ($_SESSION['validated'] === true) { echo "<h2>Login Successful</h2>";
} else {
echo "<h2>Credentials incorrect</h2>";
}
}
?>
<form action="validate.php" method="post">
<label for="username">Username</label>
<input type="username" name="username" id="username" value="<?php echo $_SESSION['uname']?>"><br><br>
<label for="password">Password</label>
<input type="password" name="password" id="password" value="<?php echo $_SESSION['pass']?>"><br><br><br>
<input type="submit" value="Submit">
</form>
</body>
</html>






