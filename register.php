<?PHP

?>

<html>
	<head>
		<title>Page d'inscription</title>
		<link rel="stylesheet" href="register.css">
	</head>
	<body>
<?PHP
include 'util.php';
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
			if ($_POST['submit'] == "OK")
			{
			if (!add_user($_POST['login'], $_POST['passwd']))
				echo "<p class='error'>User exists already.</p>";
			else
				echo "<p class='success'>User created.</p>";

			}
			?>
			<a href="../connexion.php">Déjà un compte?</a>
		</form>
	</body>
</html>
