<html>
	<head>
		<title>Page d'inscription</title>
		<link rel="stylesheet" href="register.css">
	</head>
	<body>
<?PHP
include ("header.php");
include ("add_user.php");

if ($_POST['submit'] == "OK")
{
	if (!add_user($_POST['login'], $_POST['passwd']))
		echo "User is invalid or exists\n";
}
?>
	<h3>Page d'Inscription</h3>
		<form action="register.php" method="post">
			<input type="text" placeholder="username" name="login" value="" required/>
			<br />
			<input type="password" placeholder="password" name="passwd" value="" required/>
			<br /><br />
			<input type="submit" name="submit" value="OK" />
			<br /><br />
			<a href="../connexion.php">Deja un compte?</a>
		</form>
	</body>
</html>
