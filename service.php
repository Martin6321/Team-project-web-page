<?php
	session_start();
	include 'includes/config.php';
	include 'includes/localization.php';
	include 'includes/checkIP.php';
	
	$loggedIn = isset($_SESSION['adminLogin']) ? true : false;
	
	mysql_close($connection);
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
						<a class="navbar-brand" href="service.php?lang=en"><img alt="en" src="images/gb_flag.gif" width="30" height="20"></a>
						<a class="navbar-brand" href="service.php?lang=sk"><img alt="sk" src="images/sk_flag.gif" width="30" height="20"></a>
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
						<h2 class="page-header"><?php echo $loc['nav']['sluzba'][$lang]; ?></h2>
					<ol class="breadcrumb">
						<li><a href="index.php"><?php echo $loc['nav']['domov'][$lang]; ?></a>
						</li>
						<li class="active"><?php echo $loc['nav']['sluzba'][$lang]; ?></li>
					</ol>
					</div>
				</div>
				
				<!-- Obsah stranky -->
				<div class="row">
					<div class="col-lg-12">
						<!-- Návod -->
						<p id="text">
							<small><h3>Umiestnenie:</small></h3>
                            <span>
							• SOAP služba: http://147.175.98.152/project/soap-service/<br>
							• WSDL dokument k službe: http://147.175.98.152/project/soap-service/functions.wsdl
                            </span>
							
							<small><h3>Operácie:</small></h3>
                            <span>
							• evalFunc(func, from, to, key) - počíta funkčné hodnoty pre danú funkciu a rozsah<br>
							• evalFuncDiff(func, from, to, key) - počíta funkčné hodnoty derivácie pre danú funkciu a rozsah
                            </span>
							
							<small><h3>Každá operácia má 4 vstupné parametre:</small></h3>
							<span>
							• func - funkcia - vyžaduje sa matlabovská syntax (napr. x.^2)<br>
							• from - počiatok rozsahu definičného oboru<br>
							• to - koniec rozsahu definičného oboru<br>
							• key - API kľúč zadaný v konfiguračnom súbore, bez ktorého nieje možné službu použiť
                            </span>
							
							<small><h3>Každá operácia vracia ako návratovú hodnotu vypočítané funkčné hodnoty v JSON formáte</small></h3>
							<span>
							• Napríklad [ [0,0], [1,2], [2,4] ] - prvá súradnica x, druhá y.<br>
							• Na výpočet hodnôt bol použitý sofvér GNU Octave.
                            </span>
							
							<small><h3>Príklad použitia služby v PHP:</small></h3>
                            <span>
							• $client = new SoapClient("http://147.175.98.152/project/soap-service/functions.wsdl");<br>
							• $funcData = json_decode( $client->evalFunc("sin(x)",-10,100,APIKEY) ,true);<br>
							• $diffData = json_decode( $client->evalFuncDiff("sin(x)",-10,100,APIKEY), true);
							</span>
						</p>
						
						<!-- Spustenie generácie do pdf -->
						<form action="genPDF.php" method="POST">
							<div class="form-group">
								<div class="col-md-12 span7 text-center" style="margin:50px 0;">
									<input class="btn btn-default" type="submit" name="submit" value="<?php echo $loc['sluzba']['pdfTl'][$lang]; ?>">
									<input class="btn btn-default" type="submit" name="submit2" value="<?php echo $loc['sluzba']['ebookTl'][$lang]; ?>">
								</div>
							</div>
						</form>
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
