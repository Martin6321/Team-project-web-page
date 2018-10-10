<?php

DEFINE('APIKEY',"B631D29C26AC4EEF58FCC8ABC94C1");
DEFINE('POINT_COUNT',"300");

function evalFunc($func, $from, $to, $key)
{
	if ( strcmp($key,APIKEY) != 0 )
		return "[]";

	$fh = fopen( 'script.m', 'w' );
	  fwrite($fh, "x = linspace(".$from.",".$to.",".POINT_COUNT.");");
	  fwrite($fh, "vys = [x;" .$func. "];");
	  fwrite($fh, "for i=1:".POINT_COUNT."; x = vys(1,i); y = vys(2,i); S=sprintf('???,%f,%f',x,y); disp(S); end");
	fclose($fh);

	$octResult = shell_exec("octave -p --eval script.m");
	$lines = explode("\n", $octResult);

	$result=array();

	for($i = 0; $i < count($lines);$i++)
	{
		$args = explode(",",$lines[$i]);
		if (count($args) != 3)
			continue;
		if (strcmp($args[0],"???") == 0)
		{
			array_push($result, array(floatVal($args[1]), floatVal($args[2])) );
		}
	}	

	return json_encode($result);
}

function evalFuncDiff($func, $from, $to, $key)
{
	if ( strcmp($key,APIKEY) != 0 )
		return "[]";

	$fh = fopen( 'script.m', 'w' );
          fwrite($fh, "step = ".(($to-$from)/POINT_COUNT).";");
	  fwrite($fh, "x = ".$from.":step:".$to.";");
	  fwrite($fh, "f = ".$func.";");
	  fwrite($fh, "vys = [x;[diff(f)/step,0]];");
	  fwrite($fh, "for i=1:".POINT_COUNT."; x = vys(1,i); y = vys(2,i); S=sprintf('???,%f,%f',x,y); disp(S); end");
	fclose($fh);

	$octResult = shell_exec("octave -p --eval script.m");
	$lines = explode("\n", $octResult);

	$result=array();

	for($i = 0; $i < count($lines);$i++)
	{
		$args = explode(",",$lines[$i]);
		if (count($args) != 3)
			continue;
		if (strcmp($args[0],"???") == 0)
		{
			array_push($result, array(floatVal($args[1]), floatVal($args[2])) );
		}
	}	

	return json_encode($result);
	
}

ini_set("soap.wsdl_cache_enabled", "0");
$server = new SoapServer("functions.wsdl");

$server->addFunction("evalFunc");
$server->addFunction("evalFuncDiff");

$server->handle();


?>