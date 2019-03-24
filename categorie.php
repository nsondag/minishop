<html>
	<head>
		<title></title>
		<link rel="stylesheet" href="index.css">
	</head>
<?PHP
include ("header.php");
$conn = connect_db('minishop');
$sql = "SELECT * FROM prod WHERE prod_id IN (SELECT fk_prod_id FROM link WHERE fk_cat_id IN (SELECT cat_id FROM cat WHERE cat_name='".$_GET['cat']."'))";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);
echo $row['prod_name'];
?>
 	<body>
		<h1><?PHP  echo $_GET['cat'] ?></h1>
	</body>
</html>
