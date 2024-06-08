<?php
header("Content-Type: application/json");
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
var_dump($_SESSION['api']);
?>
