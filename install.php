<?php
include 'util.php';

$conn = connect();

# database creation

$req = "DROP DATABASE IF EXISTS minishop;";
mysqli_query($conn, $req);
$req = "CREATE DATABASE minishop";
mysqli_query($conn, $req);
$conn = connect_db('minishop');

# table creation

$req = "CREATE TABLE user (user_id INT NOT NULL AUTO_INCREMENT , login VARCHAR(50) NOT NULL , passwd CHAR(128) NOT NULL , PRIMARY KEY (`user_id`))";
mysqli_query($conn, $req);
$req = "CREATE TABLE prod (prod_id INT NOT NULL AUTO_INCREMENT , prod_name VARCHAR(100) NOT NULL , price DECIMAL(9,2) NOT NULL , image VARCHAR(100), PRIMARY KEY (`prod_id`))";
mysqli_query($conn, $req);
$req = "CREATE TABLE cat (cat_id INT NOT NULL AUTO_INCREMENT , cat_name VARCHAR(100) NOT NULL , PRIMARY KEY (`cat_id`))";
mysqli_query($conn, $req);
$req = "CREATE TABLE admin (admin_id INT NOT NULL AUTO_INCREMENT , fk_user_id INT NOT NULL , PRIMARY KEY (`admin_id`) , FOREIGN KEY (fk_user_id) REFERENCES user(user_id))";
mysqli_query($conn, $req);
$req = "CREATE TABLE link (link_id INT NOT NULL AUTO_INCREMENT , fk_cat_id INT NOT NULL , fk_prod_id INT NOT NULL , PRIMARY KEY (`link_id`) , FOREIGN KEY (fk_cat_id) REFERENCES cat(cat_id) , FOREIGN KEY (fk_prod_id) REFERENCES prod(prod_id))";
mysqli_query($conn, $req);
$req = "CREATE TABLE basket (basket_id INT NOT NULL AUTO_INCREMENT , fk_user_id INT NOT NULL , fk_prod_id INT NOT NULL , nb_prod INT NOT NULL DEFAULT 1 , PRIMARY KEY (`basket_id`) , FOREIGN KEY (fk_user_id) REFERENCES user(user_id) , FOREIGN KEY (fk_prod_id) REFERENCES prod(prod_id))";
mysqli_query($conn, $req);

# category creation

$req = "INSERT INTO cat VALUES
	(NULL, 'fruits'),
	(NULL, 'legumes'),
	(NULL, 'viandes'),
	(NULL, 'produits laitiers'),
	(NULL, 'frais'),
	(NULL, 'conserves'),
	(NULL, 'boulangerie'),
	(NULL, 'non-perissables'),
	(NULL, 'plats prepares');";
mysqli_query($conn, $req);

# admin creation

$req = "INSERT INTO user VALUES
	(NULL, 'root', '".hash('whirlpool', 'root')."'),
	(NULL, 'admin', '".hash('whirlpool', 'admin')."');";
mysqli_query($conn, $req);
$req = "INSERT INTO admin VALUES
	(NULL, 1),
	(NULL, 2);";
mysqli_query($conn, $req);

# article creation

$dir = $_SERVER['DOCUMENT_ROOT']."/image/";
if (file_exists($dir)) {
	$files = glob($dir . '*', GLOB_MARK);
	foreach ($files as $file) {
		unlink($file);
	}
	rmdir($dir);
}
mkdir($dir);
$res = shell_exec('ls -1 articles');
$res = explode("\n", $res);
array_pop($res);
foreach ($res as $key => $value) {
	$key ++;
	copy('articles/'.$value, $dir.$key.'.'.get_ext($value));
	$sql = "INSERT INTO prod VALUES (NULL, '".substr($value, 0, strrpos($value, '.'))."', ".rand (1, 10).", 'image/".$key.'.'.get_ext($value)."')";
	mysqli_query($conn, $sql);
}
?>
