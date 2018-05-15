<?php
require_once('includes/init.php');
if(!isLoggedIn()){
    header("Location:?error=1 /");
    die();
}
if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $phone_id = $_GET['id'];
    $customer_id = $_SESSION['user_id'];
    $mysql->query(
        "INSERT INTO purchase (customerId, phoneId) VALUES ($customer_id, $phone_id) ");

    $mysql->query("UPDATE phone SET in_stock=in_stock-1 WHERE id='$phone_id'");
    header("Location: /phones.php");
    die();
}
?>