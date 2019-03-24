<?php
include 'util.php';
$conn = connect_db('minishop');
$sql = "SELECT * FROM prod WHERE prod_name='".$_GET['prod']."'";
$res = mysqli_query($conn, $sql);
if (!mysqli_num_rows($res)) {
	header('Location: error.php');
}
$res = mysqli_fetch_array($res);
?>
<html>
<head>
	<title><?php echo $res['prod_name'];?></title>
</head>
<?php
include 'header.php';
?>
<body>

</body>
</html>