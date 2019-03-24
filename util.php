<?php
session_start();
include 'connect.php';
include 'add_user.php';


function get_ext($file) {
	return substr($file, strrpos($file, '.') + 1);
}

?>
