<?PHP
include ("connect.php");

if ($_POST['submit'] == "OK")
{
	$conn = connect_db('minishop');
	$sql = "SELECT passwd FROM user WHERE login='".$_POST['login']."'";
	$res = mysqli_query($conn, $sql);
	$nb = mysqli_num_rows($res);
	if (!$nb)
		echo "User does not exist\n";
	if ($row != hash('whirlpool', $_POST['passwd']))
		echo "Incorrect password\n";
}
?>
<html>
	<body>
		<form action="" method="post">
			<input type="text" placeholder="username" name="login" value="" required/>
			<br />
			<input type="text" placeholder="password" name="passwd" value="" required/>
			<br />
			<input type="submit" name="submit" value="OK" />
		</form>
	</body>
</html>
