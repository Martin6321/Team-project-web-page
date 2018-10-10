<?php
	session_start();
	include 'includes/localization.php';
	include 'includes/config.php';
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
		<script type="text/javascript" src="js/jsapi"></script>
		<script>
			google.load("visualization", "1", {packages:["corechart", "table"]}); 
		</script>
		<script>
		    var source;
      	var graphFuncData;
		    var graphDerivData;
      
		    var minX;            
		    var maxX;
		    var minY;
		    var maxY;    
      
		    var pom=0;


		    function resetujGrafy()
		    {            
				graphFuncData = new google.visualization.DataTable();
				graphFuncData.addColumn('number', 'X');
				graphFuncData.addColumn('number', 'Y'); 

				graphDerivData = new google.visualization.DataTable();
				graphDerivData.addColumn('number', 'X');
				graphDerivData.addColumn('number', 'Y'); 
         
		    }
      
		    function spustiVypocet()
		    {
				funcText = document.getElementById("function").value;
				minX = parseInt(document.getElementById("xMin").value);            
				maxX = parseInt(document.getElementById("xMax").value);
				minY = parseInt(document.getElementById("yMin").value);
				maxY = parseInt(document.getElementById("yMax").value); 

				var obj = { func: funcText, minx: minX, maxx: maxX, miny: minY, maxy: maxY };  
				var urlParams = serializeHeader(obj) ;
				
				source = new EventSource("server-sent/soapClient.php?" + urlParams);

				source.onopen = function ()
				{
					 document.getElementById('start').disabled = true;
					 document.getElementById('stop').disabled = false;
				};

				source.onerror = function () {
					;
				};
             

				source.addEventListener("newresult", function (e) {                    
						var arg = e.data.split(":");

						pridajBod(parseFloat(arg[0]), parseFloat(arg[1]), parseFloat(arg[2]), parseFloat(arg[3]));
						pom++;

						if (pom%8 == 0)
							zobrazGrafy();  
				  },false);

				source.addEventListener("finish", function (e) { ukonciVypocet(); },false);               
		    }
        
		    function ukonciVypocet()
		    {
				source.close();
				document.getElementById('stop').disabled = true;               
				document.getElementById('start').disabled = false;
		    }

	            function csvExport()
		    {
                    
				var csvContent = "data:text/csv;charset=utf-8,";
				for (var j=0; j < graphFuncData.getNumberOfRows(); j++)
				{
					csvContent += graphFuncData.getValue(j,0) + "," +  graphFuncData.getValue(j,1) + "," + graphDerivData.getValue(j,0) + "," +  graphDerivData.getValue(j,1) +"\n";

				}

				var encodedUri = encodeURI(csvContent);

				var link = document.createElement("a");
				link.setAttribute("href", encodedUri);
				link.setAttribute("download", "csv_export.csv");

				document.body.appendChild(link);
				link.click();
				document.body.removeChild(link);         
	        }
        
	        function serializeHeader(obj)
	        {
				var str = "";

				for (var key in obj) {
					if (str != "") {
						str += "&";
					}
					str += key + "=" + encodeURIComponent(obj[key]);
				}
				return str;
			}
      
	        function pridajBod(x1, y1, x2, y2)
		{
				//alert("nah");
				graphFuncData.addRow ( [ x1,  y1 ] );
				graphDerivData.addRow ( [ x2,  y2 ] ); 
             
		}      

	        function zobrazGrafy()
	        {          
				var moznosti = { vAxis: { viewWindow: {min: minY,max: maxY} , title: '<?php echo $loc['aplikacia']['osY'][$lang]; ?>'}, hAxis: { viewWindow: {min: minX,max: maxX},title: '<?php echo $loc['aplikacia']['osX'][$lang]; ?>'}, pointSize: 1};
				var grafFunc = new google.visualization.LineChart(document.getElementById('grafFunc'));
				var grafDeriv = new google.visualization.LineChart(document.getElementById('grafDeriv'));

				grafFunc.draw(graphFuncData, moznosti);
				grafDeriv.draw(graphDerivData, moznosti);
       		 }
		</script> 
		
	</head>
	
	<body onload="resetujGrafy(); zobrazGrafy();">
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
						<a class="navbar-brand" href="application.php?lang=en"><img alt="en" src="images/gb_flag.gif" width="30" height="20"></a>
						<a class="navbar-brand" href="application.php?lang=sk"><img alt="sk" src="images/sk_flag.gif" width="30" height="20"></a>
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
						<h2 class="page-header"><?php echo $loc['nav']['aplikacia'][$lang]; ?></h2>
					<ol class="breadcrumb">
						<li><a href="index.php"><?php echo $loc['nav']['domov'][$lang]; ?></a>
						</li>
						<li class="active"><?php echo $loc['nav']['aplikacia'][$lang]; ?></li>
					</ol>
					</div>
				</div>
				
				<!-- Obsah stránky -->
				<div class="row" style="margin-bottom:100px;">
				
					<div class="col-lg-7 vcenter">
						
						<h3 class="h3-center"><?php echo $loc['aplikacia']['grafFun'][$lang]; ?></h3>
						<div id="grafFunc" class="graph-size"></div>
						
						<h3 class="h3-center"><?php echo $loc['aplikacia']['grafDer'][$lang]; ?></h3>
						<div id="grafDeriv" class="graph-size"></div> 	
						
					</div>
					
					<div class="col-lg-4 vcenter" style="margin-left:70px;">
						
						<form>
							<div class="form-group">
								<div class="col-md-12">
									<label class="control-label" style="margin-top:17px;"><?php echo $loc['aplikacia']['funkcia'][$lang]; ?></label>
									<input id="function" type="text"  value="2*cos(x/5)" class="form-control">
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-12">
									<label class="control-label" style="margin-top:17px;"><?php echo $loc['aplikacia']['rozsahX'][$lang]; ?></label></br>
									<div class="col-md-6">
										<input id="xMin" type="number" value="0" class="form-control">
									</div>
									<div class="col-md-6">
										<input id="xMax" type="number" value="100" class="form-control">
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-12">
									<label class="control-label" style="margin-top:17px;"><?php echo $loc['aplikacia']['rozsahY'][$lang]; ?></label></br>
									<div class="col-md-6">
										<input id="yMin" type="number" value="-2" class="form-control">
									</div>
									<div class="col-md-6">
										<input id="yMax" type="number" value="2" class="form-control">
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-12 span7 text-center" style="margin:35px 0 15px 0;">
									<input class="btn btn-primary" id="start" type="button" value="<?php echo $loc['aplikacia']['startTl'][$lang]; ?>" onclick="resetujGrafy(); spustiVypocet();">
									<input class="btn btn-default" id="stop" type="button" value="<?php echo $loc['aplikacia']['stopTl'][$lang]; ?>" disabled onclick="ukonciVypocet();">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12 center-block">
									<input class="btn btn-default center-block" type="button" value="<?php echo $loc['aplikacia']['exportTl'][$lang]; ?>" onclick="csvExport();">
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
