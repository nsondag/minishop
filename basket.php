<?php
include 'util.php';
include 'header.php';
?>
<html>
<head>
	<title>Panier</title>
</head>
<body>
<?PHP
session_start();
foreach ($_SESSION['basket'] as $key => $value) {
	echo $key.": ".$value."<br>";
}
?>
<form method="post" action="validate.php">
	<button type="submit" name="add">Valider le panier</button>
</form>
</body>
</html>