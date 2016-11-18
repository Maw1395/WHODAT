<?php

Define('DB_USER', 'root');
Define('DB_PSWD', '');
Define('DB_HOST', 'localhost');
Define('DB_NAME', 'newdatabase');

$dbcon = mysqli_connect(DB_HOST, DB_USER, DB_PSWD, DB_NAME, 3307);
if(!$dbcon)
{
	die('could not connect');
}


?>