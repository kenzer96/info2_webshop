<?php
require_once('includes/init.php');

if(!isLoggedIn()){
    header("Location: /?error=1");
    die();
}

if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $purchase_id = $_GET['id'];
    $query = $mysql->query("SELECT * FROM purchase WHERE id='$purchase_id' AND customerId='{$_SESSION['user_id']}'");

    $result = $query->fetch_assoc();
    $phone_id = $result['phoneId'];

    $mysql->query("DELETE FROM purchase WHERE id='$purchase_id'");

    $mysql->query("UPDATE phone SET in_stock = in_stock + 1 WHERE id='$phone_id'");
    header("Location: /purchases.php");
    die();
}

