<?PHP
include ("connect.php");
session_start();
if ($_POST['submit'] == "OK")
{
	$conn = connect_db('minishop');
	$sql = "SELECT passwd FROM user WHERE login='".$_POST['login']."'";
	$res = mysqli_query($conn, $sql);
	$nb = mysqli_num_rows($res);
	if (!$nb)
	{
		echo "User does not exist";
		exit ();
	}
	$row = mysqli_fetch_array($res);
	if ($row[0] == hash('whirlpool', $_POST['passwd']))
	{
		echo "connexion reussie\n";
		$_SESSION['login'] = $_POST['login'];
	}
	else
	{
		echo "Incorrect password\n";
		exit ();
	}
}
?>
<html>
	<body>
		<form action="" method="post">
			<input type="text" placeholder="username" name="login" value="" required/>
			<br />
			<input type="password" placeholder="password" name="passwd" value="" required/>
			<br />
			<input type="submit" name="submit" value="OK" />
		</form>
	</body>
</html>
