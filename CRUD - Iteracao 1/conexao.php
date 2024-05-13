<?php
$hostname="viaduct.proxy.rlwy.net";
$username="root";
$password="NiSNqFEZKvMKrfSwIzQnKTrhiuQbgTxj";
$dbname = "railway";
$port = 58592;
global $conn;
$conn = mysqli_connect($hostname, $username, $password, $dbname, $port);

//if(!$conn){
////    die("Connection failed ".mysqli_connect_error());
////}else{
////    echo "conexao feita";
////}