<?PHP
include ("connect.php");
$conn = connect_db('minishop');
$sql = "SELECT * FROM cat";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_all($res);
?>
<head>
	<link rel="stylesheet" href="header.css">
</head>
<header>
<div class=connexion>
	<a href="#panier">Panier</a>
	<a href="connexion.php">Connexion</a>
	<a href="register.php">Inscription</a>
</div>
<table>
<td>
<a href="index.php"><img class='header_img' src="Minishop.png"></a>
</td>
<td class='container'>
<?PHP
foreach ($row as $elem)
	echo '<a class="cat" href="/categorie.php?cat='.$elem[1].'">'.strtoupper($elem[1]).'</a> ';
?>
		</td>
</table>
</header>
