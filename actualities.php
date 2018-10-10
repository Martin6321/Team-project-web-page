<?php
	session_start();
	include 'includes/localization.php';
	include 'includes/config.php';
	include 'includes/checkIP.php';
	
	$loggedIn = isset($_SESSION['adminLogin']) ? true : false;
	
	$page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 0;
	
	$rowCnt = "SELECT count(*) FROM articles";
	$rowCntRes = mysql_query($rowCnt, $connection);
	$cnt = mysql_fetch_object($rowCntRes);
	
	if ($page > round($cnt/3)+1)
		$page = 0;
	$offset = $page * 3;
	
	// vyber clankov z DB
	$sql3 = "SELECT skHeading, skText, enHeading, enText, time FROM articles LIMIT 3 OFFSET $offset";
	$res3 = mysql_query($sql3, $connection);
	$i = 0;
	
	// nacitanie clanku, podla aktualneho jazyka stranky
	$articles = array();
	while($row2 = mysql_fetch_row($res3)) {
		if ($lang == 0) {
			$articles[$i][0] = $row2[0];
			$articles[$i][1] = $row2[1];
		} else {
			if ($row2[2] != "" && $row2[3] != "") {
				$articles[$i][0] = $row2[2];
				$articles[$i][1] = $row2[3];
			} else {
				$articles[$i][0] = $row2[0];
				$articles[$i][1] = $row2[1];
			}
		}
		
		$articles[$i][2] = $row2[4];
		$i++;
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
						<a class="navbar-brand" href="actualities.php?lang=en"><img alt="en" src="images/gb_flag.gif" width="30" height="20"></a>
						<a class="navbar-brand" href="actualities.php?lang=sk"><img alt="sk" src="images/sk_flag.gif" width="30" height="20"></a>
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
						<h2 class="page-header"><?php echo $loc['nav']['aktuality'][$lang]; ?></h2>
					<ol class="breadcrumb">
						<li><a href="index.php"><?php echo $loc['nav']['domov'][$lang]; ?></a>
						</li>
						<li class="active"><?php echo $loc['nav']['aktuality'][$lang]; ?></li>
					</ol>
					</div>
				</div>
				
				<!-- Obsah stranky -->
				<div class="row">

					<!-- Aktuality -->
					<div class="col-md-8">
						
						<?php
							for ($i=0; $i<count($articles); $i++) {
								echo '<div class="article">';
									echo '<h3>'.$articles[$i][0].'</h3>';
									echo '<p>';
										echo "{$loc['aktual']['pridany'][$lang]}&nbsp;&nbsp;".$articles[$i][2];
									echo '</p>
									
									<hr>
									
									<p class="article-text">'.$articles[$i][1].'</p>
									<hr>
								</div>';
							}
						?>
						
						<!-- Strankovac -->
						<ul class="pager">
							<li class="previous">
								<?php
									if ($page>0) {
										$val = strval($page-1);
										echo "<a href='actualities.php?page={$val}'>&larr;&nbsp;{$loc['aktual']['pred'][$lang]}</a>";
									} else {
										echo "<a href='#'>&larr;&nbsp;{$loc['aktual']['pred'][$lang]}</a>";
									}
								?>
							</li>
							<li class="next">
								<?php
									if (round($cnt/3)+1 > $page) {
										$val = strval($page+1);
										echo "<a href='actualities.php?page={$val}'>{$loc['aktual']['nasl'][$lang]}&nbsp;&rarr;</a>";
									} else {
										echo "<a href='#'>{$loc['aktual']['nasl'][$lang]}&nbsp;&rarr;</a>";
									}
								?>
							</li>
						</ul>

					</div>

					<!-- Prihlasenie na odber cez Newsletter -->
					<div class="col-md-4">
					
						<form action="newsletter.php" method="post" class="form-horizontal">
							<div class="panel panel-default">
							
								<div class="panel-heading">
									
									<div class="form-group">
										<div class="col-md-offset-1 col-md-10">
											<h4><i class="glyphicon glyphicon-list-alt"></i>&nbsp;&nbsp;<?php echo $loc['aktual']['newsletter'][$lang]; ?></h4>
											<input type="text" class="form-control" name="email" placeholder="Email...">
											
											<div class="col-md-12 span7 text-center" style="margin-top:15px;">
												<div class="btn-group" data-toggle="buttons">
													<label class="btn btn-default active">
														<input type="radio" id="option1" name= "gender" value="sk" checked style="margin-left:18px;" autocomplete="off">SK
													</label>
													<label class="btn btn-default">
														<input type="radio" id="option2" name= "gender" value="en" style="margin-left:15px;" autocomplete="off">EN
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="panel-body" style="padding-bottom:5px;">
									<div class="form-group" style="margin-bottom:0px;">
										<div class="col-md-12 span7 text-center">
											<button class="btn btn-primary" type="submit" name="subscribe"><?php echo $loc['aktual']['prihlasitTl'][$lang]; ?></button>
											<button class="btn btn-default" type="submit" name="unsubscribe"><?php echo $loc['aktual']['zrusitTl'][$lang]; ?></button></br>
											<a href="http://feeds.feedburner.com/Tm13Project">
											<img src="images/pic_rss.gif" width="45" height="21" style="margin-top:15px;"></a>
										</div>
									</div>
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
