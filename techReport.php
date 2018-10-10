<?php
	session_start();
	include 'includes/localization.php';
	
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
						<a class="navbar-brand" href="techReport.php?lang=en"><img alt="en" src="images/gb_flag.gif" width="30" height="20"></a>
						<a class="navbar-brand" href="techReport.php?lang=sk"><img alt="sk" src="images/sk_flag.gif" width="30" height="20"></a>
					</div>
					
					<!-- Polozky v navigacii -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
							<?php require('includes/navigation.php'); ?>
						</ul>
					</div>
					
				</div>
			</nav>
			
			<div class="container">
			
				<!-- Nadpis & Breadcrumbs -->
				<div class="row">
					<div class="col-lg-12">
						<h2 class="page-header"><?php echo $loc['nav']['techSprava'][$lang]; ?></h2>
					<ol class="breadcrumb">
						<li><a href="index.php"><?php echo $loc['nav']['domov'][$lang]; ?></a>
						</li>
						<li class="active"><?php echo $loc['nav']['techSprava'][$lang]; ?></li>
					</ol>
					</div>
				</div>
				
				<!-- Obsah stranky -->
				<div class="row">
					<div class="col-lg-12">
						<div style="margin-bottom:70px;">
							<h3><small><?php echo $loc['techRep']['autori'][$lang]; ?></small></h3>
							<ul>
								<li>Marián Ivaniš</li>
								<li>Marek Uhlár</li>
								<li>Martin Molnár</li>
								<li>Milan Pižem</li>
							</ul>
							<h3><small><?php echo $loc['techRep']['adresa'][$lang]; ?></small></h3>
							<ul>
							<li>http://147.175.98.152/project/</li>
							</ul>
							<h3><small>PhpMyAdmin:</small></h3>
							<ul>
							<li>http://147.175.98.152/phpmyadmin/</li>
							</ul>
							<h3><small><?php echo $loc['techRep']['instal'][$lang]; ?></small></h3>
							<ul>
								<li><?php echo $loc['techRep']['octaveInstal'][$lang]; ?><ul>
								<li>apt-get install octave</li></ul></li>
								<li><?php echo $loc['techRep']['dovodInstal'][$lang]; ?><ul>
								<li>nutné pre výpočet hodnôt nami vytvorenej SOAP služby</li></ul></li>
							</ul>	
							
							<h3><small><?php echo $loc['techRep']['struktura'][$lang]; ?></small></h3>
							<ul>
								<li><?php echo $loc['nav']['domov'][$lang]; ?></li>
								<li><?php echo $loc['nav']['aplikacia'][$lang]; ?>
									<ul>
									<li>Podstránka obsahuje aplikáciu na vykreslenie hodnôt funkcie a jej derivácie do grafu</li>
									<li>Na výpočet hodnôt bol použitý softvér Octave</li>
									</ul>
								</li>
								<li><?php echo $loc['nav']['sluzba'][$lang]; ?>
									<ul>
									<li>Podstránka obsahuje popis nami použitej webovej služby</li>
									<li>Podstránka umožnuje vygenerovať popis webovej služby vo form PDF alebo eBooku</li>
									</ul>
								</li>
								<li><?php echo $loc['nav']['aktuality'][$lang]; ?>
								<ul>
									<li>Podstránka obsahuje aktuality pridané administrátormi</li>
									<li>Na podstránke je možné prihlásiť sa na odber aktualít pomocou e-mailu alebo RSS</li>
								</ul>
								</li>
								<li><?php echo $loc['nav']['techSprava'][$lang]; ?>
								<ul>
									<li>Nachádza sa tu základný popis stránky a jednotlivých podstránok</li>
								</ul>
								</li>
								<li><?php echo $loc['nav']['kontakt'][$lang]; ?>
								<ul>
									<li>Na podstránke sa nachádza zoznam členov tímu a úlohy, ktoré splnili</li>
								</ul>
								</li>
								<li><?php echo $loc['nav']['prihlasenie'][$lang]; ?></li>
								<ul>
									<li>Slúži na prihlásenie administrátora</li>
									<li>Po prihlásení administrátor môže:
									<ul>
									<li>Pridávať aktuality na stránku</li>
									<li>Sledovať štatistiku lokalizácie návštevníkov web stránky podľa IP adries</li>
									</ul>
									</li>
									
								</ul>
							</ul></br>
						</div>
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
