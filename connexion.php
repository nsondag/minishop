<?PHP
function connexion()
{
	$conn = connect_db('minishop');
	$sql = "SELECT user_id, passwd FROM user WHERE login='".$_POST['login']."'";
	$res = mysqli_query($conn, $sql);
	$nb = mysqli_num_rows($res);
	if (!$nb)
	{
		return (0);
	}
	$row = mysqli_fetch_array($res);
	$sql = "SELECT admin_id FROM admin WHERE fk_user_id='".$row[0]."'";
	$res = mysqli_query($conn, $sql);
	$nb = mysqli_num_rows($res);
	if ($row[1] == hash('whirlpool', $_POST['passwd']))
	{
		$_SESSION['login'] = $_POST['login'];
		if ($nb)
			return (2);
		return (1);
	}
	else
		return (-1);
}
?>
<html>
<head>
	<title>Connexion</title>
	<link rel="stylesheet" href="connexion.css">
</head>
<?PHP
session_start();
include 'util.php';
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
				if (connexion() == 0)
					echo "<p class='error'>Cet utilisateur n'existe pas.</p>";
				if (connexion() == 1)
					echo "<p class='success'>Connexion réussie.</p>";
				if (connexion() == -1)
					echo "<p class='error'>Le mot de passe n'est pas correct.</p>";
				if (connexion() == 2)
				{
					echo "<p class='succes'>Connexion admin réussie.</p>";
					echo "<a href='admin.php'>Page d'administration et de gestion</a>";
				}
			else
			echo "<a href='../register.php'>Pas encore de compte?</a>"
			?>
		</form>
	</body>
</html>
