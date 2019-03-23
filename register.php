<?PHP
include ("connect.php");
include ("add_user.php");

if ($_POST['submit'] == "OK")
{
	if (!add_user($_POST['login'], $_POST['passwd']))
		echo "User is invalid or exists\n";
}
?>
