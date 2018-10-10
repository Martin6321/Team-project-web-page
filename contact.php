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
						<a class="navbar-brand" href="contact.php?lang=en"><img alt="en" src="images/gb_flag.gif" width="30" height="20"></a>
						<a class="navbar-brand" href="contact.php?lang=sk"><img alt="sk" src="images/sk_flag.gif" width="30" height="20"></a>
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
					<h2 class="page-header"><?php echo $loc['nav']['kontakt'][$lang]; ?></h2>
					<ol class="breadcrumb">
						<li><a href="index.php"><?php echo $loc['nav']['domov'][$lang]; ?></a>
						</li>
						<li class="active"><?php echo $loc['nav']['kontakt'][$lang]; ?></li>
					</ol>
				</div>
			</div>
			
			<!-- Obsah stranky -->
				<div class="row">
					
					<div class="col-md-offset-2 col-md-4 text-center">
						<div class="thumbnail" style="margin:25px 0 50px 0;">
							<img class="img-responsive" src="images/ivanis.jpg" alt="ivanis_img">
							<div class="caption">
								<h3>Marián Ivaniš<br>
									<small>B-API MASUS</small></br>
									<small>xivanis@stuba.sk</small>
								</h3>
								
								<hr>
								<?php
									echo '<h3><small>'.$loc['ulohy']['ulohy'][$lang].'</small></h3>';
									echo 'HTML + CSS</br>';
									echo $loc['ulohy']['lokalizacia'][$lang] . '</br>';
									echo $loc['ulohy']['admin'][$lang] . '</br>';
								?>
							</div>
						</div>
					</div>
					<div class="col-md-4 text-center">
						<div class="thumbnail" style="margin:25px 0 50px 0;">
							<img class="img-responsive" src="images/uhlar.jpg" alt="uhlar_img">
							<div class="caption">
								<h3>Marek Uhlár<br>
									<small>B-API MASUS</small></br>
									<small>xuhlarm@stuba.sk</small>
								</h3>
								
								<hr>
								<?php
									echo '<h3><small>'.$loc['ulohy']['ulohy'][$lang].'</small></h3>';
									echo $loc['ulohy']['statistiky'][$lang] . '</br>';
									echo $loc['ulohy']['aktuality'][$lang] . '</br></br>';
								?>
							</div>
						</div>
					</div>
					
				</div>
				<div class="row">
					
					<div class="col-md-offset-2 col-md-4 text-center">
						<div class="thumbnail" style="margin-bottom:70px;">
							<img class="img-responsive" src="images/molnar.jpg" alt="">
							<div class="caption">
								<h3>Martin Molnár<br>
									<small>B-API MASUS</small></br>
									<small>xmolnarz@stuba.sk</small>
								</h3>
								
								<hr>
								<?php
									echo '<h3><small>'.$loc['ulohy']['ulohy'][$lang].'</small></h3>';
									echo $loc['ulohy']['sluzba'][$lang] . '</br>';
									echo $loc['ulohy']['graf'][$lang] . '</br>';
								?>
							</div>
						</div>
					</div>
					<div class="col-md-4 text-center">
						<div class="thumbnail" style="margin-bottom:70px;">
							<img class="img-responsive" src="images/pizem.jpg" alt="">
							<div class="caption">
								<h3>Milan Pižem<br>
									<small>B-API MASUS</small></br>
									<small>xpizem@stuba.sk</small>
								</h3>
								
								<hr>
								<?php
									echo '<h3><small>'.$loc['ulohy']['ulohy'][$lang].'</small></h3>';
									echo $loc['ulohy']['novinky'][$lang] . '</br>';
									echo $loc['ulohy']['generovanie'][$lang] . '</br>';
								?>
							</div>
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
