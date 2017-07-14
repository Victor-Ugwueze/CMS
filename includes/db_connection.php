<?php
require_once("config.php");
$conn= mysql_connect(DB_SERVER,DB_USER,DB_PASS);
if(!$conn){
	die("database connection failed: ".mysql_error());
}

$db_select= mysql_select_db(DB_NAME,$conn);
if(!$db_select){
	die("database selection failed: ".mysql_error());
}

?>

