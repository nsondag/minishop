<?php
include 'util.php';
$conn = connect_db('minishop');
$sql = "SELECT * FROM prod WHERE prod_name='".$_GET['prod']."'";
$res2 = mysqli_query($conn, $sql);
if (!mysqli_num_rows($res2)) {
	header('Location: error.php');
}
$res2 = mysqli_fetch_array($res2);
if ($_POST['add']) {
	if ($_SESSION['basket'][$_GET['prod']])
		$_SESSION['basket'][$_GET['prod']]++;
	else
		$_SESSION['basket'][$_GET['prod']] = 1;
}
?>
<html>
<head>
	<title><?php echo $res['prod_name'];?></title>
</head>
<?php
include 'header.php';
?>
<body>
<?PHP
echo "<h1>".strtoupper($_GET['prod'])."</h1>";
echo "<img class='prod_img' src='" . $res2['image'] . "'>";
?>
<form method="post" action="">
	<button type="submit" name="add">Ajouter au panier</button>
</form>
</body>
</html>