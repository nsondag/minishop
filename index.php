<?PHP
include ("connect.php");
$conn = connect_db('minishop');
$sql = "SELECT * FROM cat";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_all($res);
?>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" href="index.css">
	</head>
 	<body>
		<div class="header">
			<a href="#panier">Panier</a>
			<a href="#connexion">Connexion</a>
			<a href="#inscription">Inscription</a>
		</div>
		<h1>Bienvenue</h1>
		<div class=>
			<?PHP
				foreach ($row as $elem)
				echo '<a href="/categorie.php?cat='.$elem[1].'">'.$elem[1].'</a> ';
			?>
		</div>
	</body>
</html>
