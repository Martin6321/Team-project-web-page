<?php
	session_start();
	include 'includes/config.php';
	include 'includes/localization.php';
	include 'includes/checkIP.php';
	mysql_close($connection);
	
	$loggedIn = isset($_SESSION['adminLogin']) ? true : false;
?>				

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang']; ?>">
	
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title><?php echo $loc['page']['title'][$lang]; ?></title>
		
		<!-- CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		
		<!-- JavaScript -->
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
		
	</head>
	
	<body>
		<div class="wrapper">
		
			<!-- Navigacia -->
			<nav class="navbar navbar-inverse navbar-fixed-top">
				<div class="container">
				
					<!-- Zmensenie pre mobilne zaradenia -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only"><?php echo $loc['page']['mobileTitle'][$lang]; ?></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="index.php?lang=en"><img alt="en" src="images/gb_flag.gif" width="30" height="20"></a>
						<a class="navbar-brand" href="index.php?lang=sk"><img alt="sk" src="images/sk_flag.gif" width="30" height="20"></a>
					</div>
					
					<!-- Polozky v navigacii -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
							<?php include 'includes/navigation.php'; ?>
						</ul>
					</div>
					
				</div>
			</nav>
			
			<!-- Header -->
			<header>
				<img class="img-responsive" src="images/header.png" alt="header_img">
			</header>
			
			<!-- Obsah stranky -->
			<div class="container">
				<div class="row">
					<div class="col-lg-12" style="text-align:center;margin-top:30px;">
						<?php echo "<h1>{$loc['index']['nadpis'][$lang]}</h1>"; ?></br></br>
						<p>
							Na našej webstránke si môžete odskúšať SOAP službu, určenú na výpočet hodnôt grafov zadanej funkcie a jej derivácie.</br>
							Služba je implementovaná prostredníctvom technológie SOAP a na vypočítavanie hodnôt využíva softvér Octave.</br>
							Na uloženie vypočítaných výsledkov je možné použiť export do csv súboru.
						</p>
					</div>
				</div>
			</div>
			
			<div class="push"></div>
		</div>
		
		<!-- Footer -->
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<hr>
						<p>Copyright &copy; 2016 &middot; <?php echo "<strong>{$loc['page']['footer'][$lang]}</strong> &middot; {$loc['page']['title'][$lang]}"; ?></p>
					</div>
				</div>
			</div>
		</footer>
		
	</body>
</html>
