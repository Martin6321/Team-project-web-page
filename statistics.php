<?php
	session_start();
	include 'includes/config.php';
	include 'includes/localization.php';
	include 'includes/checkIP.php';
	
	if (isset($_SESSION['adminLogin'])) {
		$loggedIn = $_SESSION['adminLogin'];
		} 
	else {
		header ('location: index.php');
		exit();
	}
	
	
	// nacitanie udajov z DB
	$sql3 = "SELECT country,count(*) AS countryCnt FROM (SELECT ip,country FROM statistics GROUP BY ip) AS t GROUP BY country";
	$res3 = mysql_query($sql3, $connection);
	
	$i = 1;
	$data[0] = array('Štát', 'Počet');
	
	while($row = mysql_fetch_row($res3)){
		$data[$i] = array($row[0], intval($row[1]));
		$i++;
	}
	$data =json_encode($data);
	
	$sql6 = "SELECT city,count(*) AS cityCnt FROM (SELECT city FROM statistics GROUP BY ip) AS t GROUP BY city";
	$res6 = mysql_query($sql6, $connection);
	
	$i = 1;
	$data2[0] = array('Mesto', 'Počet');
	
	while($row4 = mysql_fetch_row($res6)){
		$data2[$i] = array($row4[0], intval($row4[1]));
		$i++;
	}
	
	$data2 =json_encode($data2);
	
	$sql4 = "SELECT IP,country,city FROM statistics";
	$res4 = mysql_query($sql4, $connection);
	$sql5 = "SELECT latitude, longitude, city FROM statistics";
	$res5 = mysql_query($sql5, $connection);

	$locations2= array();

	while($row3=mysql_fetch_assoc($res5)) {
		array_push($locations2, $row3['latitude'], $row3['longitude'], $row3['city']);
	}
	
	mysql_close($connection);
	
	
	
	function js_str($s) {
		return '"' . addcslashes($s, "\0..\37\"\\") . '"';
	}
	function js_array($array) {
		$temp = array_map('js_str', $array);
		return '[' . implode(',', $temp) . ']';
	}
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
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript">
		 google.charts.load("current", {packages:["corechart"]});    
		  google.charts.setOnLoadCallback(drawChart);
		  function drawChart() {

			var data = google.visualization.arrayToDataTable(<?php echo $data; ?>);
			var data2 = google.visualization.arrayToDataTable(<?php echo $data2; ?>);
			   
			var options = {
			  title: '<?php echo $loc['statis']['staty'][$lang]; ?>',
			  is3D: true
			};
			var options2 = {
			  title: '<?php echo $loc['statis']['mesta'][$lang]; ?>',
			  is3D: true
			};
			var chart = new google.visualization.PieChart(document.getElementById('piechart'));
			chart.draw(data, options);
			var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));
			chart2.draw(data2, options2);
		  }
		</script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="http://maps.googleapis.com/maps/api/js"></script>
		<script>
			function initialize() {	
				var mapProp = {
					center: new google.maps.LatLng(35,0),
					zoom: 3,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
				<?php echo 'var locs = ', js_array($locations2), ';'; ?>
				for (var i=0; i<locs.length; i+=3) {
					var pos = new google.maps.LatLng(locs[i],locs[i+1]);
					var marker = new google.maps.Marker({
						position: pos,
						map: map,
						title: locs[i+2]
					});
				}
			}
			google.maps.event.addDomListener(window, 'load', initialize);
		</script>
		
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
						<a class="navbar-brand" href="statistics.php?lang=en"><img alt="en" src="images/gb_flag.gif" width="30" height="20"></a>
						<a class="navbar-brand" href="statistics.php?lang=sk"><img alt="sk" src="images/sk_flag.gif" width="30" height="20"></a>
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
						<h2 class="page-header"><?php echo $loc['nav']['statistiky'][$lang]; ?></h2>
					<ol class="breadcrumb">
						<li><a href="index.php"><?php echo $loc['nav']['domov'][$lang]; ?></a>
						</li>
						<li class="active"><?php echo $loc['nav']['statistiky'][$lang]; ?></li>
					</ol>
					</div>
				</div>
				
				<!-- Obsah stranky -->
				<div class="row">
					<div class="col-lg-12">
						
						<ul id="myTab" class="nav nav-tabs nav-justified">
							<li class="active"><a href="#service-one" data-toggle="tab"><?php echo $loc['statis']['tab1'][$lang]; ?></a>
							</li>
							<li class=""><a href="#service-two" data-toggle="tab"><?php echo $loc['statis']['tab2'][$lang]; ?></a>
							</li>
						</ul>

						<div id="myTabContent" class="tab-content">
							<div class="tab-pane fade active in" id="service-one">
								<h3 style="margin-top:80px;text-align:center;"><?php echo $loc['statis']['grafy'][$lang]; ?></h3>
								<table style="margin:0 auto;">
									<tr>
										<td><div id='piechart' style="width:500px; height:350px;"></div></td>
										<td><div id='piechart2' style="width:500px; height:350px;"></div></td>
									</tr>
								</table>
								<h3 style="margin-bottom:80px;text-align:center;"><?php echo $loc['statis']['mapa'][$lang]; ?></h3>
								<p><div id="googleMap" style="margin:0 auto 120px auto;width:800px;height:400px;"></div></p>
								
							</div>
							<div class="tab-pane fade" id="service-two">
								<h3 style="margin:80px 0 80px 0;text-align:center;"><?php echo $loc['statis']['navstevy'][$lang]; ?></h3>
								<p>
									<?php
										echo"<div class='col-md-offset-3 col-md-6 text-center' style='margin-bottom:80px;'>";
										echo"<table class='table table-bordered table-striped'>";
										echo'<thead><tr><td><b>IP</b></td>
											<td><b>'.$loc['statis']['stat'][$lang].'</b></td>
											<td><b>'.$loc['statis']['mesto'][$lang].'</b></td></tr></thead>';
										
										while($row2 = mysql_fetch_row($res4)) {
											echo"<tr>";
											echo "<td>$row2[0]</td>";
											echo "<td>$row2[1]</td>";
											echo "<td>$row2[2]</td>";
											echo"</tr>";
										}
										
										echo "</table>";
										echo"</div>";
									?>
								</p>
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
