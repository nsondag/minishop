<html>
<head>
	<title><?php
		if ($_SESSION['basket'])
			echo "Panier validé !";
		else
			echo "Panier vide !";
	?></title>
	<style type="text/css">
		body {
			margin: 0;
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
		$sql = "INSERT INTO command VALUES (NULL, ".$user_id['user_id'].", (SELECT prod_id FROM prod WHERE prod_name='".$key."' LIMIT 1), ".$value.")";
		mysqli_query($conn, $sql);
	}
echo '<h1 style="text-align: center;font-size: 10em">';
if ($_SESSION['basket'])
	echo "Validated !";
else
	echo "Empty basket !";
echo '</h1>';
	unset($_SESSION['basket']);
}
?>
<p style="text-align: center;font-size: 3em">
	<a href=".">Back to main page</a>
</p>
</body>
</html>
