<?php
	require 'includes/config.php';
	
	$db_name = "project13";
	$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	
	if (is_string($_GET['type']) && is_string($_GET['email'])) {
		$key = $_GET["type"];
		$email = $_GET["email"];
	}
	
	$dotaz = "SELECT * FROM security_key WHERE sec_key='$key'";
	$vysledok = mysqli_query($link, $dotaz) or die("Error: " . mysqli_error($link));
	
	if(mysqli_num_rows($vysledok) == 1){
		$ver = 1;
		$dotaz = "UPDATE newsletter SET verification=$ver WHERE email='$email'";
		mysqli_query($link, $dotaz) or die("Error: " . mysqli_error($link));
		header("Location: actualities.php");
	}
	else{
		echo "Database error: verification problem";
	}
	
?>