<?PHP
	session_start();
	unset($_SESSION['login']);
	unset($_SESSION['basket']);
	header("Location: index.php");
?>
