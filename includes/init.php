<?php

session_start();

$mysql = new mysqli('localhost', 'root', '', 'mobile_webshop');

function isLoggedIn(){
    return isset($_SESSION['user_id']) == 1;
}

?>