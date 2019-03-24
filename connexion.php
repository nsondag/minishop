<html>
<head>
	<title>Connexion</title>
	<link rel="stylesheet" href="connexion2.css">
</head>
<?PHP include ("header.php");?>
<body>
<?PHP
session_start();
if ($_POST['submit'] == "OK")
{
	$conn = connect_db('minishop');
	$sql = "SELECT user_id, passwd FROM user WHERE login='".$_POST['login']."'";
	$res = mysqli_query($conn, $sql);
	$nb = mysqli_num_rows($res);
	if (!$nb)
	{
		echo "User does not exist <br />";
		exit ();
	}
	$row = mysqli_fetch_array($res);
	$sql = "SELECT admin_id FROM admin WHERE fk_user_id='".$row[0]."'";
	$res = mysqli_query($conn, $sql);
	$nb = mysqli_num_rows($res);
	if ($row[1] == hash('whirlpool', $_POST['passwd']))
	{
		echo "connexion reussie <br />";
		$_SESSION['login'] = $_POST['login'];
		if ($nb)
			echo "super admin <br /n>";
	}
	else
	{
		echo "Incorrect password <br /n>";
		exit ();
	}
}
?>
	<h3>Page de Connexion</h3>
		<form action="" method="post">
			<input type="text" placeholder="username" name="login" value="" required/>
			<br />
			<input type="password" placeholder="password" name="passwd" value="" required/>
			<br /><br />
			<input type="submit" name="submit" value="OK" />
			<br /><br />
			<a href="../register.php">Pas encore de compte?</a>
		</form>
	</body>
</html>
