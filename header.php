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
	<a href="#panier">Panier</a>
	<a href="#connexion">Connexion</a>
	<a href="#inscription">Inscription</a>
<div class='container'>
<?PHP
foreach ($row as $elem)
	echo '<a class="cat" href="/categorie.php?cat='.$elem[1].'">'.strtoupper($elem[1]).'</a> ';
?>
		</div>
</header>
