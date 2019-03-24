<html>
	<head>
		<title>Page d'accueil</title>
		<link rel="stylesheet" href="index.css">
	</head>
<?PHP 
include 'util.php';
include 'header.php';
$sql = "SELECT * FROM prod ORDER BY RAND () LIMIT 4";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_all($res);
?>
	<body>
		<h1>Bienvenue au</h1>
		<img class='main_img' src="Minishop.png">
		<h2>Suggestions du jour</h2>
<div class='contain'>
<?PHP
foreach ($row as $elem)
{
	echo "<div class='prod'><div class='prod_im'>";
	echo "<a href='product.php?prod=".$elem[1]."'><img class='prod_img' src='" . $elem[3] . "'></a></div>";
	echo "<p class='name'>" . $elem[1]. "</p>\n";
	echo "<p class='price'>" . $elem[2]." € </p>\n";
	echo "</div>";
}
?>
</div>
	</body>
</html>

