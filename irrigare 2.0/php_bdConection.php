<?php

	$db_host = "sql10.freemysqlhosting.net";
	$db_name = "sql10356326";
	$db_user = "sql10356326";
	$db_pass = "tZILkdCzfS";
	
	$mysqli = new mysqli($db_host, $db_user,$db_pass,$db_name);

if ($mysqli -> connect_error)
    die("connection failed: ".mysqli_connect_error())
/*/

	$db_host = "www.db4free.net";
	$db_name = "irrigare";
	$db_user = "irrigare";
	$db_pass = "#SaraEBiel123";
	
	$mysqli = new mysqli($db_host, $db_user,$db_pass,$db_name);

if ($mysqli -> connect_error)
    die("connection failed: ".mysqli_connect_error())
/*/

?>