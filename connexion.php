<html>
<head>
	<title>Connexion</title>
	<link rel="stylesheet" href="connexion.css">
</head>
<?PHP
session_start();
include 'util.php';
$con = connexion();
include 'header.php';
?>
<body>
	<h3>Page de Connexion</h3>
		<form action="" method="post">
			<input type="text" placeholder="username" name="login" value="" required/>
			<br /><br />
			<input type="password" placeholder="password" name="passwd" value="" required/>
			<br /><br />
			<input type="submit" name="submit" value="OK" />
			<br /><br />
			<?PHP
			if ($_POST['submit'] == "OK")
			{
				if ($con == 0)
					echo "<p class='error'>Cet utilisateur n'existe pas.</p>";
				if ($con == 1)
					echo "<p class='success'>Connexion réussie.</p>";
				if ($con == -1)
					echo "<p class='error'>Le mot de passe n'est pas correct.</p>";
				if ($con == 2)
					header("Location: admin.php");
			}
				echo "<a href='register.php'>Pas encore de compte?</a>"
			?>
		</form>
	</body>
</html>
