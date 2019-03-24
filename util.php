<?php
session_start();
include 'connect.php';
include 'add_user.php';


function get_ext($file) {
	return substr($file, strrpos($file, '.') + 1);
}

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
