<?php
require_once('includes/init.php');

if(isset($_GET['success']) && $_GET['success'] == 1) {
    echo "<script type='text/javascript'>alert('Sikeres regisztráció!');</script>";
}

if(isset($_GET['error']) && $_GET['error'] == 1) {
    echo "<script type='text/javascript'>alert('Bejelentkezés sikertelen!');</script>";
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <title>Webáruház</title>
    <link rel="stylesheet" href="css/main.css"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">
</head>
<body>

<?php include 'navbar.html'; ?>

<?php if (!isLoggedIn()) { ?>
    <div class="reg-div">
        <a class="btn btn-primary reg" href="register.php">
            Regisztráció  <i class="fa fa-user-plus"></i>
        </a>
    </div>

<?php } else { ?>
    <div class="home-introduction">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>
    </div>
<?php } ?>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"
        integrity="sha384-u/bQvRA/1bobcXlcEYpsEdFVK/vJs3+T+nXLsBYJthmdBuavHvAW6UsmqO2Gd/F9"
        crossorigin="anonymous"></script>
</body>
</html>