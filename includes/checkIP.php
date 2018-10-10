<?php
	$database = 'project13';
	$connection= mysql_connect(HOST, USER, PASSWORD);
	mysql_set_charset("UTF8",$connection);
	if (!$connection)
		die("Can't connect to database");
	if (!mysql_select_db($database))
		die("Can't select database");
	
	$ip = get_client_ip();
	$sql = "SELECT IP FROM statistics WHERE IP LIKE '$ip'";
	$res = mysql_query($sql, $connection);
	$x = mysql_num_rows($res);
	
	if ($x == 0) {
		$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
		$city = $details->city;
		$country = $details->country;
		$locations = $details->loc;
		$location = explode(",", $locations);
		$lat = $location[0];
		$lon = $location[1];
		
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, "http://www.science.co.il/International/Country-codes.asp"); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);

		$DOM = new DOMDocument;
		$DOM->loadHTML($result);
		$staty= $DOM->getElementsByTagName('tr');

		foreach ($staty as $stat) {
				$s= $stat->getElementsByTagName('td');
				if ($s->item(2)->nodeValue == strtolower($country)){
					$fcountry = $s->item(0)->nodeValue;
					break;
				}
		}
		curl_close($ch);	
		
		if($fcountry == null){
			$fcountry = "Nelokalizovaný štát";
		}
		if($city == null){
			$city= "Nelokalizované mesto";
		}
		
	   $sql2 = "INSERT INTO statistics(IP,country,city,latitude,longitude) VALUES('$ip','$fcountry','$city','$lat','$lon')";
	   $res2 = mysql_query( $sql2, $connection );
	}
	
	
	function get_client_ip() {
			$ipaddress = '';
			if (getenv('HTTP_CLIENT_IP'))
				$ipaddress = getenv('HTTP_CLIENT_IP');
			else if(getenv('HTTP_X_FORWARDED_FOR'))
				$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
			else if(getenv('HTTP_X_FORWARDED'))
				$ipaddress = getenv('HTTP_X_FORWARDED');
			else if(getenv('HTTP_FORWARDED_FOR'))
				$ipaddress = getenv('HTTP_FORWARDED_FOR');
			else if(getenv('HTTP_FORWARDED'))
				$ipaddress = getenv('HTTP_FORWARDED');
			else if(getenv('REMOTE_ADDR'))
				$ipaddress = getenv('REMOTE_ADDR');
			else
				$ipaddress = 'UNKNOWN';
			return $ipaddress;
	}
?>