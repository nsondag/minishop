<html>
	<head>
		<title></title>
		<link rel="stylesheet" href="index.css">
	</head>
	<?PHP 
	include 'util.php';
	include 'header.php';
	$sql = "SELECT * FROM prod";
	$res = mysqli_query($conn, $sql);
	$row = mysqli_fetch_all($res);
	?>
	<body>
		<h1>Bienvenue au</h1>
		<img class='main_img' src="Minishop.png">
		<h2>Suggestions du jour</h2>
		<table>
			<td class="prod">
			<img class='prod_img' src="<?PHP echo $row[0][3];?>">
				<p class="name"><?PHP echo $row[0][1];?></p>
				<p class="price"><?PHP echo $row[0][2]." €";?></p>
			</td>
			<td class="prod">
				<img class='prod_img' src="<?PHP echo $row[1][3];?>">
				<p class="name"><?PHP echo $row[1][1];?></p>
				<p class="price"><?PHP echo $row[1][2]." €";?></p>
			</td>
			<td class="prod">
				<img class='prod_img' src="<?PHP echo $row[2][3];?>">
				<p class="name"><?PHP echo $row[2][1];?></p>
				<p class="price"><?PHP echo $row[2][2]." €";?></p>
			</td>
			<td class="prod">
				<img class='prod_img' src="<?PHP echo $row[3][3];?>">
				<p class="name"><?PHP echo $row[3][1];?></p>
				<p class="price"><?PHP echo $row[3][2]." €";?></p>
			</td>
		</table>
	</body>
</html>

