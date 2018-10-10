<?php
	session_start();
	
	header('Location: login.php');
		
	unset($_SESSION['adminLogin']);
	exit;
?>