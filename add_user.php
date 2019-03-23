<?PHP
include ("connect.php");

function add_user($user, $passwd)
{
	$conn = connect_db('minishop');
	if ($user == "" || $passwd == "")
	{
		echo "Empty login or password";
		return (0);
	}
	$sql = "SELECT login FROM user WHERE login='".$user."'";
	$res = mysqli_query($conn, $sql);
	$nb = mysqli_num_rows($res);
	if ($nb)
		return (0);
	$sql = "INSERT INTO `user` VALUES (NULL, '".$user."','" .hash('whirlpool', $passwd)."')";
	$res = mysqli_query($conn, $sql);
	return (1);
}
?>
