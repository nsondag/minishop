<html>
	<head>
		<title>Page d'inscription</title>
		<link rel="stylesheet" href="register.css">
	</head>
	<body>
<?PHP
session_start();
include 'util.php';
if ($_POST['submit'] == "OK")
{
	if ($add = add_user($_POST['login'], $_POST['passwd']))
		connexion();
}
else
	$add = 2;
include 'header.php';
?>
	<h3>Page d'Inscription</h3>
		<form action="register.php" method="post">
			<input type="text" placeholder="username" name="login" value="" required/>
			<br /><br />
			<input type="password" placeholder="password" name="passwd" value="" required/>
			<br /><br />
			<input type="submit" name="submit" value="OK" />
			<br /><br />
			<?PHP
			if ($add == 1)
				echo "<p class='success'>User created.</p>";
			elseif ($add == 0)
				echo "<p class='error'>User exists already.</p>";
			?>
			<a href="../connexion.php">Déjà un compte?</a>
		</form>
	</body>
</html>
