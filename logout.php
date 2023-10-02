<?php 
	
	session_start();
	unset($_SESSION["id"]);
	unset($_SESSION["role"]);
	echo "<script>window.location.replace('home.php');</script>";

?>