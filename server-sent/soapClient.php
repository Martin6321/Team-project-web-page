<?php

header("Content-Type: text/event-stream\n\n");

include '../includes/config.php';

$func = $_GET['func'];
$minx = floatval($_GET['minx']);
$maxx = floatval($_GET['maxx']);

ini_set("soap.wsdl_cache_enabled", "0");
$client = new SoapClient("http://147.175.98.152/project/soap-service/functions.wsdl");
   
$funcData = json_decode( $client->evalFunc($func,$minx,$maxx,APIKEY) ,true);
$diffData = json_decode( $client->evalFuncDiff($func,$minx,$maxx,APIKEY), true);
	
for($i = 0; $i < count($funcData); $i++)
{
	$x1 = $funcData[$i][0];
	$y1 = $funcData[$i][1];
	$x2 = $diffData[$i][0];
	$y2 = $diffData[$i][1];

	echo "event: newresult\n";
	echo "data: " .$x1. ":" .$y1. ":" .$x2. ":" .$y2. "\n\n";
	ob_end_flush();
	flush();
	usleep(25000);
}

echo "event: finish\n";
echo "data: 0\n\n";
ob_end_flush();
flush();


?> 

