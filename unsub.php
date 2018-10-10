<?php
	require 'includes/config.php';
	
	$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	
	$key = $_GET["type"];
	$email = $_GET["email"];
	
	$dotaz = "SELECT * FROM security_key WHERE sec_key='$key'";
	$vysledok = mysqli_query($link, $dotaz) or die("Error: " . mysqli_error($link));
	
	if(mysqli_num_rows($vysledok) == 1){
		$dotaz = "DELETE FROM newsletter WHERE email='$email'";
		mysqli_query($link, $dotaz) or die("Error: " . mysqli_error($link));
		header("Location: actualities.php");
	}
	else{
		echo "Database error: verification problem";
	}
	
?>