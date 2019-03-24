<?php
include 'connect.php';

function get_ext($file) {
	return substr($file, strrpos($file, '.') + 1);
}

?>