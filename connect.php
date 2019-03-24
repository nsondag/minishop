<?PHP

function connect()
{
	$host = '127.0.0.1';
	$user = 'root';
	$passwd = 'kz11hxmPIT';
	$conn = mysqli_connect($host, $user, $passwd);
	if (!$conn) 
	{
		echo "connection error\n";
		exit ();
	}
	return ($conn);
}

function connect_db($db)
{
	$host = '127.0.0.1';
	$user = 'root';
	$passwd = 'kz11hxmPIT';
	$conn = mysqli_connect($host, $user, $passwd, $db);
	if (!$conn)
	{
		echo "connect error\n";
		exit();
	}
	return ($conn);
}
?>
