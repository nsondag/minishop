<?php
function connect() {
	$host = '127.0.0.1';
	$user = 'root';
	$passwd = 'hubert';
	$db = 'minishop';

	global $conn;
	$conn = mysqli_connect($host, $user, $passwd, $db);
	if (!$conn) {
		echo "connect error\n";
		exit();
	}
}
?>
Search user :
<form name="search_user" method="post" action="">
	<input type="text" name="user" placeholder="username" value=""><input type="submit" name="submit" value="search">
</form>
Delete user :
<form name="del_user" method="post" action="">
	<input type="text" name="user" placeholder="username" value=""><input type="submit" name="submit" value="delete">
</form>
<?php
	connect();
	if ($_POST['submit'] == 'search') {
		$sql = "SELECT * FROM user WHERE login LIKE '%".$_POST['user']."%'";
		// echo $sql;
		// $sql = "SELECT * FROM user";
		$res = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_array($res))
			echo 'login: '.$row['login'].' passwd: '.$row['passwd']."\n";
	} elseif ($_POST['submit'] == 'delete') {
		$sql = "DELETE FROM user WHERE login='".$_POST['user']."'";
		$res = mysqli_query($conn, $sql);
		if ($res)
			echo "user deleted\n";
	}
?>