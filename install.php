<?php
include ("connect.php");

$conn = connect();
$req = "CREATE DATABASE minishop";
mysqli_query($conn, $req);
$conn = connect_db($db);
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
?>
