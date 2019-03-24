<?php
include 'util.php';
include 'header.php';
?>
<html>
<head>
	<title>Panier</title>
	<style type="text/css">
		body {
			margin: 0;
		}
		th {
			border: 1px solid black;
			padding: 3px;
		}
		td {
			border: 1px solid black;
			padding: 3px;
		}
		#dev > table {
			margin: auto;
			margin-top: 20px;
			border-collapse: collapse;
			font-size: 2em;
		}
		button {
			background-color: #62B3AD;
			border: none;
			color: white;
			padding: 15px 32px;
			border-radius: 10px;
			text-align: center;
			text-decoration: none;
			font-size: 16px;
			cursor: pointer;
			margin: auto;
			margin-top: 20px;
			display: block;
		}
	</style>
</head>
<body>
<div id='dev'>
<table>
<?PHP
session_start();
$tot=0;
if ($_SESSION['basket'])
	echo "<tr><th>produit</th><th>quantité</th><th>prix unitaire</th><th>total</th>";
foreach ($_SESSION['basket'] as $key => $value) {
	echo "<tr>";
	$sql = "SELECT price FROM prod WHERE prod_name='".$key."'";
	$res = mysqli_fetch_array(mysqli_query($conn, $sql));
	echo "<td>".$key."</td><td>".$value."</td><td>".$res['price']." €</td><td>".number_format($value*$res['price'], 2)." €</td>";
	$tot += $value*$res['price'];
	echo "</tr>";
}
echo "<tr><td colspan='3'>Total du panier </td><td>".number_format($tot, 2). "€</td></tr>";
?>
</table>
<form method="post" action="validate.php">
	<button type="submit" name="add">Valider le panier</button>
</form>
</div>
</body>
</html>