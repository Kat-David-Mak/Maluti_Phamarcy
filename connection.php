<?php

$databasehost='localhost';
$databaseusername='root';
$databasepassword='';
$databasename='maluti_pharmacy';

$conn = mysqli_connect($databasehost,$databaseusername,$databasepassword,$databasename);
if(!$conn)
{
	die('Could not connect My SQL:' .mysql_error());
}

?>
