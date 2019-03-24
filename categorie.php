<html>
	<head>
		<title></title>
		<link rel="stylesheet" href="index.css">
	</head>
<?PHP
include ("header.php");
$conn = connect_db('minishop');

$sql = "SELECT * FROM cat";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_all($res);
$sql = "SELECT * FROM prod WHERE cat='".$_GET['cat']."'";
$row = mysqli_fetch_all($res);
?>
 	<body>
		<h1><?PHP  echo $_GET['cat'] ?></h1>
	</body>
</html>
