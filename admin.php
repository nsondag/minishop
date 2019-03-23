<html>
<head>
	<title>Admin tools</title>
	<style type="text/css">
		.box {
			margin: 30px;
			padding: 10px;
			border: 2px solid black;
		}
		h1 {
			font-size: 1.7em;
		}
	</style>
</head>
<body>

<div id="container" style="display: flex;flex-direction: row;">


<div id="user_mgmt" class="box">
	<h1>User management</h1>
	Search user :
	<form name="search_user" method="post" action="">
		<input type="text" name="login" placeholder="login" value=""><br>
		<input type="submit" name="submit_search_user" value="search">
	</form>
	<!-- Change password :
	<form name="change_passwd" method="post" action="">
		<input type="text" name="login" placeholder="login" value="" required><br>
		<input type="passwd" name="passwd" placeholder="new password" value="" required><br>
		<input type="submit" name="submit_change_passwd" value="change">
	</form> -->
	Add user :
	<form name="add_user" method="post" action="">
		<input type="text" name="login" placeholder="login" value="" required><br>
		<input type="passwd" name="passwd" placeholder="password" value="" required><br>
		<input type="submit" name="submit_add_user" value="add">
	</form>
	Change login :
	<form name="change_passwd" method="post" action="">
		<input type="text" name="old_login" placeholder="old login" value="" required><br>
		<input type="text" name="new_login" placeholder="new login" value="" required><br>
		<input type="submit" name="submit_change_login" value="change">
	</form>
	Delete user :
	<form name="del_user" method="post" action="">
		<input type="text" name="login" placeholder="login" value="" required><br>
		<input type="submit" name="submit_delete_user" value="delete">
	</form>

	<?php
	include 'connect.php';
	include 'add_user.php';

	$conn = connect_db('minishop');
	if ($_POST['submit_search_user']) {
		$sql = "SELECT login FROM user WHERE login LIKE '".$_POST['login']."%'";
		$res = mysqli_query($conn, $sql);
		echo 'Login that start with "'.$_POST['login'].'":<br>';
		while ($row = mysqli_fetch_array($res))
			echo $row['login']."<br>";
	} elseif ($_POST['submit_add_user']) {
		if (add_user($_POST['login'], $_POST['passwd']))
			echo $_POST['login']." succesfully created<br>";
	} elseif ($_POST['submit_delete_user']) {
		$sql = "DELETE FROM user WHERE login='".$_POST['login']."'";
		mysqli_query($conn, $sql);
		if (mysqli_affected_rows($conn))
			echo $_POST['login']." deleted<br>";
	} elseif ($_POST['submit_change_passwd']) {
		echo 'add when function available please<br>';
	} elseif ($_POST['submit_change_login']) {
		$sql = "UPDATE user SET login='".$_POST['new_login']."' WHERE login='".$_POST['old_login']."'";
		mysqli_query($conn, $sql);
		if (mysqli_affected_rows($conn)) {
			echo "'".$_POST['old_login']."' changed to '".$_POST['new_login']."'<br>";
		} else {
			echo "Login not found<br>";
		}
	}
	?>
</div>

<div id="article_mgmt" class="box">
	<h1>Article management</h1>
	Search article :
	<form name="search_article" method="post" action="">
		<input type="text" name="name" placeholder="name" value=""><br>
		<input type="submit" name="submit_search_article" value="search">
	</form>
	Add article :
	<form name="add_article" method="post" action="" enctype="multipart/form-data">
		<input type="text" name="name" placeholder="name" value="" required><br>
		<input type="text" name="price" placeholder="price" value="" required><br>
		<input type="text" name="cat" placeholder="cat (, separated)" value=""><br>
		Image : <input type="file" name="image" value="" accept="image/png, image/jpeg"><br>
		<input type="submit" name="submit_add_article" value="add">
	</form>
	Change article value (enter NULL to delete an info) :
	<form name="change_price" method="post" action="" enctype="multipart/form-data">
		<input type="text" name="name" placeholder="name" value="" required><br>
		<input type="text" name="new_name" placeholder="new name" value=""><br>
		<input type="text" name="new_price" placeholder="new price" value=""><br>
		<input type="text" name="new_cat" placeholder="new cat (, separated)" value=""><br>
		Delete current image : <input type="checkbox" name="delete_img"><br>
		New image : <input type="file" name="new_image" value="" accept="image/png, image/jpeg"><br>
		<input type="submit" name="submit_change_article" value="change">
	</form>
	Delete article :
	<form name="del_article" method="post" action="">
		<input type="text" name="name" placeholder="name" value="" required><br>
		<input type="submit" name="submit_delete_article" value="delete">
	</form>
	
	<?php
	$dir = $_SERVER['DOCUMENT_ROOT']."/image";
	if (!file_exists($dir))
		mkdir($dir);

	if ($_POST['submit_search_article']) {
		$sql = "SELECT prod_name, price FROM prod WHERE prod_name LIKE '".$_POST['name']."%'";
		$res = mysqli_query($conn, $sql);
		echo 'Article that start with "'.$_POST['name'].'":<br>';
		while ($row = mysqli_fetch_array($res))
			echo $row['prod_name'].": ".$row['price']."<br>";
	} elseif ($_POST['submit_add_article']) {
		$sql = "SELECT prod_name FROM prod WHERE prod_name='".$_POST['name']."'";
		if (mysqli_num_rows(mysqli_query($conn, $sql))) {
			echo "'".$_POST['name']."' already exists<br>";
		} else {
			$sql = "INSERT INTO prod VALUES (NULL, '".$_POST['name']."', ".floatval($_POST['price']).", NULL)";
			mysqli_query($conn, $sql);
			$last_id = mysqli_insert_id($conn);
			if ($_POST['cat'] != '') {
				$cat = explode(',', $_POST['cat']);
				foreach ($cat as $value) {
					$sql = "SELECT cat_id FROM cat WHERE cat_name='".trim($value)."'";
					$res = mysqli_query($conn, $sql);
					if ($row = mysqli_fetch_array($res)) {
						$sql = "INSERT INTO link VALUES (NULL, ".$row['cat_id'].", ".$last_id.")";
						mysqli_query($conn, $sql);
					} else {
						echo "'".$value."' not found<br>";
					}
					
				}
			}
			if ($_FILES['image']['name'] != '') {
				$target_file = $dir."/".$last_id.".".substr($_FILES['image']['name'], strrpos($_FILES['image']['name'], '.') + 1);
				echo $target_file;
				if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
					$sql = "UPDATE prod SET image='".$target_file."' WHERE prod_id=".$last_id;
					mysqli_query($conn, $sql);
					echo "file uploaded<br>";
				} else
					echo "error while uploading image<br>";
			}
			echo "'".$_POST['name']."' added<br>";
		}
	} elseif ($_POST['submit_change_article']) {
		$sql = "SELECT prod_name FROM prod WHERE prod_name='".$_POST['name']."'";
		if (mysqli_num_rows(mysqli_query($conn, $sql))) {
			echo "'".$_POST['name']."' already exists<br>";
		} else {
			echo "'".$_POST['name']."' not found<br>";
		}
	} elseif ($_POST['submit_delete_article']) {
		$sql = "DELETE FROM link WHERE fk_prod_id IN (SELECT prod_id FROM prod WHERE prod_name='".$_POST['name']."')";
		mysqli_query($conn, $sql);
		$sql = "DELETE FROM prod WHERE prod_name='".$_POST['name']."'";
		mysqli_query($conn, $sql);
		if (mysqli_affected_rows($conn))
			echo $_POST['name']." deleted<br>";
	}
	?>
</div>

<div id="cat_mgmt" class="box">
	<h1>Categorie management</h1>
	Search categorie :
	<form name="search_categorie" method="post" action="">
		<input type="text" name="name" placeholder="name" value=""><br>
		<input type="submit" name="submit_search_categorie" value="search">
	</form>
	Add categorie :
	<form name="add_categorie" method="post" action="">
		<input type="text" name="name" placeholder="name" value="" required><br>
		<input type="submit" name="submit_add_categorie" value="add">
	</form>
	Rename categorie :
	<form name="change_categorie" method="post" action="">
		<input type="text" name="old_name" placeholder="old name" value="" required><br>
		<input type="text" name="new_name" placeholder="new name" value="" required><br>
		<input type="submit" name="submit_change_categorie" value="change">
	</form>
	Delete categorie :
	<form name="del_categorie" method="post" action="">
		<input type="text" name="name" placeholder="name" value="" required><br>
		<input type="submit" name="submit_delete_categorie" value="delete">
	</form>
	
	<?php
	$dir = $_SERVER['DOCUMENT_ROOT']."/image";
	if (!file_exists($dir))
		mkdir($dir);

	if ($_POST['submit_search_categorie']) {
		$sql = "SELECT cat_name FROM cat WHERE cat_name LIKE '".$_POST['name']."%'";
		$res = mysqli_query($conn, $sql);
		echo 'Categorie that start with "'.$_POST['name'].'":<br>';
		while ($row = mysqli_fetch_array($res))
			echo $row['cat_name']."<br>";
	} elseif ($_POST['submit_add_categorie']) {
		$sql = "SELECT cat_name FROM cat WHERE cat_name='".$_POST['name']."'";
		if (mysqli_num_rows(mysqli_query($conn, $sql))) {
			echo "'".$_POST['name']."' already exists<br>";
		} else {
			$sql = "INSERT INTO cat VALUES (NULL, '".$_POST['name']."');";
			echo $sql."<br>";
			mysqli_query($conn, $sql);
			echo "'".$_POST['name']."' added<br>";
		}
	} elseif ($_POST['submit_change_categorie']) {
		$sql = "UPDATE cat SET cat_name='".$_POST['new_name']. "' WHERE cat_name='".$_POST['old_name']."'";
		echo $sql."<br>";
		mysqli_query($conn, $sql);
		if (mysqli_affected_rows($conn)) {
			echo "'".$_POST['old_name']."' changed to '".$_POST['new_name']."'<br>";
		} else {
			echo "'".$_POST['name']."' not found<br>";
		}
	} elseif ($_POST['submit_delete_categorie']) {
		$sql = "DELETE FROM link WHERE fk_cat_id IN (SELECT cat_id FROM cat WHERE cat_name='".$_POST['name']."')";
		mysqli_query($conn, $sql);
		$sql = "DELETE FROM cat WHERE cat_name='".$_POST['name']."'";
		mysqli_query($conn, $sql);
		if (mysqli_affected_rows($conn))
			echo $_POST['name']." deleted<br>";
	}
	?>
</div>


</div>

</body>
</html>