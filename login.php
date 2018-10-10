<?php
	session_start();
	include 'includes/config.php';
	include 'includes/localization.php';
	include 'includes/checkIP.php';
	mysql_close($connection);
	
	if (isset($_SESSION['adminLogin'])) {
		header('Location: index.php');
		exit();
	}
	
	$loggedIn = false;
	
	$conn = mysqli_connect(HOST, USER, PASSWORD, DATABASE) or die("Chyba pripojenia!" . mysqli_connect_error());
	mysqli_set_charset($conn, "utf8");
	
	if (isset($_POST['logIn'])) {
		$adminLogin = is_string($_POST['adminLogin']) ? $_POST['adminLogin'] : "";
		$adminPass = is_string($_POST['password']) ? $_POST['password'] : "";
		
		$adminData = mysqli_query($conn, "SELECT login, password FROM administrator WHERE login = '$adminLogin' AND password = '$adminPass'");
										
		while ($row = mysqli_fetch_assoc($adminData)) {
			$dbAdminLogin = $row['login'];
			$dbPassword = $row['password'];
		}
		
		if ($adminLogin == $dbAdminLogin && $adminPass == $dbPassword) {
			$_SESSION['adminLogin'] = $adminLogin;
			
			header('Location: index.php');
		} else {
			header('Location: login.php?badInput');
		}
		mysqli_close($conn);
		exit();
	}
	
	mysqli_close($conn);
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
						<a class="navbar-brand" href="login.php?lang=en"><img alt="en" src="images/gb_flag.gif" width="30" height="20"></a>
						<a class="navbar-brand" href="login.php?lang=sk"><img alt="sk" src="images/sk_flag.gif" width="30" height="20"></a>
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
						<h2 class="page-header"><?php echo $loc['nav']['prihlasenie'][$lang]; ?></h2>
					<ol class="breadcrumb">
						<li><a href="index.php"><?php echo $loc['nav']['domov'][$lang]; ?></a>
						</li>
						<li class="active"><?php echo $loc['nav']['prihlasenie'][$lang]; ?></li>
					</ol>
					</div>
				</div>
				
				<!-- Obsah stranky -->
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
					
						<div class="login_form">
							<form action="#" method="post" class="form-horizontal">
							
								<div class="panel panel-default">
									
									<div class="panel-heading">
										<h3 style="margin:0;"><i class="fa fa-lock"></i>&nbsp;&nbsp;<small><?php echo $loc['login']['prihlasenie'][$lang]; ?></small></h3>
									</div>
									
									<div class="panel-body text-center">
										<div class="form-group">
											<label for="login" class="col-md-3 control-label"><?php echo $loc['login']['meno'][$lang]; ?></label>
											<div class="col-md-9">
												<input type="login" class="form-control" name="adminLogin" required="">
											</div>
										</div>
										<div class="form-group">
											<label for="password" class="col-md-3 control-label"><?php echo $loc['login']['heslo'][$lang]; ?></label>
											<div class="col-md-9">
												<input type="password" class="form-control" name="password" required="">
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-offset-3 col-md-9">
												<button type="reset" class="btn btn-default"><?php echo $loc['login']['zmazatTl'][$lang]; ?></button>
												<button type="submit" class="btn btn-primary" name="logIn"><?php echo $loc['login']['prihlasitTl'][$lang]; ?></button>
											</div>
										</div>
										<?php
											if (isset($_GET['badInput'])) {
												echo '<div style="color:red;">Zle zadané prihlasovacie údaje!</div>';
											}
										?>
									</div>
									
								</div>
									
							</form>
						</div>
						
					</div>
				</div>
			
				<div class="push"></div>
			</div>
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
