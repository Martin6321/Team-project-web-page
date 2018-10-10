<?php
	session_start();
	include 'includes/config.php';
	include 'includes/localization.php';
	
	if (isset($_SESSION['adminLogin'])) {
		$loggedIn = $_SESSION['adminLogin'];
	} else {
		header ('location: index.php');
		exit();
	}
	
	// pridanie clanku do DB
	if (isset($_POST['addAct'])) {
		$skHeading = $_POST['skHeading'];
		$enHeading = $_POST['enHeading'];
		$skText = $_POST['skText'];
		$enText = $_POST['enText'];
		
		$database = 'project13';
		$connection= mysql_connect(HOST, USER, PASSWORD);
		mysql_set_charset("UTF8",$connection);
		if (!$connection)
			die("Can't connect to database");
		if (!mysql_select_db($database))
			die("Can't select database");
		
		$sql = "INSERT INTO articles(skHeading,skText,enHeading,enText) VALUES('$skHeading','$skText','$enHeading','$enText')";
		$res = mysql_query($sql, $connection);

		//Uprava obsahu RSS pre odoslanie
		$xml1 = simplexml_load_file('xml/rssFeedSk.xml');
	
		$xml1->channel->item->title = $skHeading;
		$xml1->channel->item->description = $skText;
		$xml1->asXML('xml/rssFeedSk.xml');
		
		$xml2 = simplexml_load_file('xml/rssFeedEn.xml');
	
		$xml2->channel->item->title = $enHeading;
		$xml2->channel->item->description = $enText;
	
		$xml2->asXML('xml/rssFeedEn.xml');
		
		//preposielanie na subscribnute emaily
		include "sendRSS.php";
	}
	
	
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
						<a class="navbar-brand" href="addActuality.php?lang=en"><img alt="en" src="images/gb_flag.gif" width="30" height="20"></a>
						<a class="navbar-brand" href="addActuality.php?lang=sk"><img alt="sk" src="images/sk_flag.gif" width="30" height="20"></a>
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
					<h2 class="page-header"><?php echo $loc['nav']['novaAkt'][$lang]; ?></h2>
					<ol class="breadcrumb">
						<li><a href="index.php"><?php echo $loc['nav']['domov'][$lang]; ?></a>
						</li>
						<li class="active"><?php echo $loc['nav']['novaAkt'][$lang]; ?></li>
					</ol>
				</div>
			</div>
			
			<!-- Obsah stranky -->
			<div class="row">
			
				<div style="margin-bottom:30px;">
					<div class="col-md-offset-3 col-md-6">
				
						<form action="#" method="post" class="form-horizontal">
						
							<h3 class="h3-center"><?php echo $loc['novaAkt']['sk'][$lang]; ?></h3>
							<div class="control-group form-group">
								<div class="controls">
									<label><?php echo $loc['novaAkt']['nadpis'][$lang]; ?></label>
									<input type="text" class="form-control" name="skHeading" required>
								</div>
							</div>
							<div class="control-group form-group">
								<div class="controls">
									<label><?php echo $loc['novaAkt']['text'][$lang]; ?></label>
									<textarea rows="10" cols="100" class="form-control" name="skText" required maxlength="999" style="resize:none"></textarea>
								</div>
							</div>
							
							<h3 class="h3-center"><?php echo $loc['novaAkt']['en'][$lang]; ?></h3>
							<div class="control-group form-group">
								<div class="controls">
									<label><?php echo $loc['novaAkt']['nadpis'][$lang]; ?></label>
									<input type="text" class="form-control" name="enHeading">
								</div>
							</div>
							<div class="control-group form-group">
								<div class="controls">
									<label><?php echo $loc['novaAkt']['text'][$lang]; ?></label>
									<textarea rows="10" cols="100" class="form-control" name="enText" maxlength="999" style="resize:none"></textarea>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-offset-5 col-md-2">
									<button type="submit" class="btn btn-primary" name="addAct"><?php echo $loc['novaAkt']['odoslatTl'][$lang]; ?></button>
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
