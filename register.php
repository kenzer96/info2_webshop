<?php
require_once("includes/init.php");

if(isLoggedIn()){
    header("Location: /?success=1");
    die();
}

?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <title>Regisztráció</title>

    <link rel="stylesheet" href="css/main.css"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>
<body>

<?php include 'navbar.html' ?>

    <form class="form reg-form" action="create_user.php" method="POST">
        <input class="form-control" type="text" name="name" placeholder="Név"><br>
        <input class="form-control" type="text" name="address" placeholder="Lakcím"><br>
        <input class="form-control" type="password" name="password" placeholder="Jelszó"><br>
        <input class="form-control" type="text" name="phone" placeholder="Telefonszám" maxlength="10"><br>
        <input class="form-control" type="email" name="email" placeholder="Email cím"><br>
        <input class="form-control btn btn-primary" type="submit" value="Regisztráció">
    </form>
</body>
</html>
