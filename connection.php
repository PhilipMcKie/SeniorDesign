<?php


function dbaseconn(){

	$dbhost = "wveistest.cy7som93vukv.us-east-2.rds.amazonaws.com";
	$dbname = "TEIS";

	$dsn = "sqlsrv:Server={$dbhost};database={$dbname};";
	$p = new PDO($dsn, "Broker", "EKMiNDqSslt4kWtS3HmKcfziwGTqNmm0");

	return $p;


}



?>
