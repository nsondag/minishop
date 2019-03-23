<?PHP
include ("connect.php");
include ("add_user.php");

if ($_POST['submit'] == "OK")
{
	if (!add_user($_POST['login'], $_POST['passwd']))
		echo "User is invalid or exists\n";
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
