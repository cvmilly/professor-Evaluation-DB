<?php

$user = 'root';
$password = 'root';
$db = 'ReviewDB';
$host = 'localhost';
$connect = mysqli_connect($host,$user,$password,$db);
if ( mysqli_connect_errno() )
{
    echo "failed connection " . mysqli_connect_error();
}

?>
