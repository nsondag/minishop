<?PHP
include ("connect.php");
session_start();
if ($_POST['submit'] == "OK")
{
	$conn = connect_db('minishop');
	$sql = "SELECT user_id, passwd FROM user WHERE login='".$_POST['login']."'";
	$res = mysqli_query($conn, $sql);
	$nb = mysqli_num_rows($res);
	if (!$nb)
	{
		echo "User does not exist";
		exit ();
	}
	$row = mysqli_fetch_array($res);
	$sql = "SELECT admin_id FROM admin WHERE fk_user_id='".$row[0]."'";
	$res = mysqli_query($conn, $sql);
	$nb = mysqli_num_rows($res);
	if ($row[1] == hash('whirlpool', $_POST['passwd']))
	{
		echo "connexion reussie\n";
		$_SESSION['login'] = $_POST['login'];
		if ($nb)
			echo "super admin\n";
	}
	else
	{
		echo "Incorrect password\n";
		exit ();
	}
}
?>
