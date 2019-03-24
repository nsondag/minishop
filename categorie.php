<html>
	<head>
		<title><?PHP echo ucfirst($_GET['cat']);?></title>
		<link rel="stylesheet" href="index.css">
		<link rel="stylesheet" href="categorie.css">
	</head>
<?PHP
include 'util.php';
include 'header.php';
$conn = connect_db('minishop');
$sql = "SELECT * FROM cat WHERE cat_name='".$_GET['cat']."'";
$res2 = mysqli_query($conn, $sql);
if (!mysqli_num_rows($res2)) {
	header('Location: error.php');
}
$sql = "SELECT * FROM prod WHERE prod_id IN (SELECT fk_prod_id FROM link WHERE fk_cat_id IN (SELECT cat_id FROM cat WHERE cat_name='".$_GET['cat']."'))";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_all($res);
?>
	<body>
		<h1><?PHP echo strtoupper($_GET['cat']) ?></h1>
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
