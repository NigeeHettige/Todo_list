<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "todo";

$con = mysqli_connect($host,$username,$password,$dbname);


if(!$con){
    die("Connection Failed :".mysqli_connect_error());
}



?>