<?php
include 'util.php';
include 'header.php';
?>
<html>
<head>
	<title>Panier</title>
</head>
<body>
<table>
<tr><th>produit</th><th>quantité</th><th>prix unitaire</th><th>total</th>
<?PHP
session_start();
$tot=0;
foreach ($_SESSION['basket'] as $key => $value) {
	echo "<tr>";
	$sql = "SELECT price FROM prod WHERE prod_name='".$key."'";
	$res = mysqli_fetch_array(mysqli_query($conn, $sql));
	echo "<td>".$key."</td><td>".$value."</td><td>".$res['price']."€</td><td>".$value*$res['price']."€</td>";
	$tot += $value*$res['price'];
	echo "</tr>";
}
?>
</table>
<form method="post" action="validate.php">
	<button type="submit" name="add">Valider le panier</button>
</form>
</body>
</html>