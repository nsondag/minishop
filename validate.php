<html>
<head>
	<title>Panier validé</title>
	<style type="text/css">
		body {
			display: table-cell;
			vertical-align: middle;
			height: 100vh;
			width: 100vw;
		}
	</style>
</head>
<?php
include 'util.php';
include 'header.php';
?>
<body>
<?php
session_start();
if (!$_SESSION['login'] || $_SESSION['login'] == '')
	header('Location: connexion.php');
else {
	$conn = connect_db('minishop');
	$sql = "SELECT user_id FROM user WHERE login='".$_SESSION['login']."'";
	$user_id = mysqli_fetch_array(mysqli_query($conn, $sql));
	foreach ($_SESSION['basket'] as $key => $value) {
		$sql = "INSERT INTO basket VALUES (NULL, ".$user_id['user_id'].", (SELECT prod_id FROM prod WHERE prod_name='".$key."' LIMIT 1), ".$value.")";
		echo $sql."<br>";
		mysqli_query($conn, $sql);
	}
}
?>
<h1 style="text-align: center;font-size: 10em">
<?php
if ($_SESSION['basket'])
	echo "Validated !";
else
	echo "Empty basket !";
unset($_SESSION['basket']);
?>
</h1>
<p style="text-align: center;font-size: 3em">
	<a href=".">Back to main page</a>
</p>
</body>
</html>