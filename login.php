<?php
require_once('includes/init.php');
if(isLoggedIn()){
    header("Location: /");
}
if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['submit'])){
    $email = $mysql->real_escape_string($_POST['email']);
    $password = $mysql->real_escape_string($_POST['password']);
    if($email != "" && $password != ""){
        $query = $mysql->query("SELECT * FROM customer WHERE email='$email'");
        if($query->num_rows <= 0){
            header("Location: /?error=1");
        }
        while($row = $query->fetch_assoc()){
            if($email = $row['email'] && sha1($password) == $row['password']){
                $_SESSION['user_id'] = $row['Id'];
                header("Location: /");
                die();
            }
        }
        header("Location: /?error=1");
    }
    header("Location: /?error=1");
}else{
    header("Location: /?error=1");
}
?>