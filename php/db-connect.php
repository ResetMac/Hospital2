<?php

$server = 'localhost';
$username = 'root';
$password = '';
$dbname = 'med_organisations';

$connect = mysqli_connect($server, $username, $password, $dbname);

if(!mysqli_select_db($connect, $dbname)){
	//echo "<h1>error</h1>";
	return json_encode(array('status' => 'false', 'msg' => 'error db connect'));
}