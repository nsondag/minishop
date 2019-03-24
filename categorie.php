<html>
	<head>
		<title><?PHP echo $_GET['cat']?></title>
		<link rel="stylesheet" href="index.css">
	</head>
<?PHP
include 'util.php';
include 'header.php';
$conn = connect_db('minishop');
$sql = "SELECT * FROM prod WHERE prod_id IN (SELECT fk_prod_id FROM link WHERE fk_cat_id IN (SELECT cat_id FROM cat WHERE cat_name='".$_GET['cat']."'))";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_all($res);
?>
	<body>
		<h1><?PHP  echo strtoupper($_GET['cat']) ?></h1>
		<table>
<?PHP
foreach ($row as $elem)
{
			echo "<td class='prod'>\n";
			echo "<a href='product.php?prod=".$elem[1]."'><img class='prod_img' src='" . $elem[3] . "'></a>\n";
			echo "<p class='name'>" . $elem[1]. "</p>\n";
			echo "<p class='price'>" . $elem[2]." € </p>\n";
			echo "</td>";
}
?>
		</table>
	</body>
</html>
