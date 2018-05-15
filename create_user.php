<?php
require_once('includes/init.php');

if(isLoggedIn()){
    header("Location: /?success=1");
    die();
}

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['password']) && isset($_POST['phone'])){
    $name = $mysql->real_escape_string($_POST['name']);
    $email = $mysql->real_escape_string($_POST['email']);
    $address = $mysql->real_escape_string($_POST['address']);
    $phone = $mysql->real_escape_string($_POST['phone']);
    $password = $mysql->real_escape_string($_POST['password']);

    if($name != "" && $email != "" && $address != "" && $phone != "" && $password != ""){
        $password = sha1($password);
        $query = $mysql->query("SELECT * FROM customer WHERE email='$email'");

        if($query->num_rows == 0){
          $mysql->query("INSERT INTO customer (name, email, address, phone_number, password) VALUES ('$name', '$email', '$address', '$phone', '$password')");
        }else{
            header("Location: /?error=1");
            die();
        }


        header("Location: /?success=2");
        die();
    }
}
header("Location: /register.php");