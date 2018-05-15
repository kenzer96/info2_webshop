## Sitemap - az alkalmazás struktúrája
Az alkalmazást több különböző PHP fájl valósítja meg: 
* `index.php`: ez a főoldal, ahol a felhasználó regisztrálhat- vagy bejelentkezhet az oldalra.
* `phones.php`: ez az oldal megjeleníti a telefonokat és lehetőség van rendelés leadására, ha be van jelentkezve.
* `purchases.php` : ez az oldal a felhasználó által rendelt termékeket listázza ki, valamint törölheti is itt a rendeléseit.
* `register.php` : ezen az oldalon tud a látogató a személyes adataival létrehozni egy új felhasználói fiókot.

A fentieken kívül néhány további segédfájlt is fogunk használni:
* `main.css`: közöss css fájl, amiben a stílusokat definiálhatjuk, erre minden oldal hivatkozik majd.
* `menu.html`: minden oldal tetején megjelenik majd egy menü, amely linkeket tartalmaz a telefonok- és vásárlásaim (amennyiben be van jelentkezve a felhasználó) aloldalakra. Az ezt a menüt megvalósító HTML kódrészletet - hogy ne kelljen minden oldalon külön megírni -, egy külön fájlba helyezzük, amelyet importálunk majd minden oldalon. 
* `init.php`: a felhasználói azonsítás ebben a fájlban van, erre a főoldal, valamint a menu.html hivatkoznak.
* `create_user.php`: a register.php oldalon megadott adatok alapján készít egy új felhasznnálót a customers táblába.
* `login.php`: e-mail és jelszó alapján azonosítja a felhasználót.
* `purchase.php`: phoneId és customerId alapján létrehoz egy új vásárlást a purchases táblába.

Összefoglalva tehát az odalak felépítését:
* Lesz tehát egy közös menü, amely minden oldalon megjelenik. Itt linkeket jelenítünk meg a főoldal, a telefonok és vásárlások listáira, vagyis az `index.php`, `phones.php` és `purchases.php` oldalakra. 
* Az `index.php` oldal megjeleníti a menüt és egy Regisztráció gombot tartalmaz. 

## Közös menü és index.php
Kezdjük az index.php fájl implementációjával: 
```html
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
```

A fenti  kódrészlet egy inicializációval kezd, ami megmondja, hogy be van-e jelentkezve a felhasználó. A menüt a menu.html fájlból include-olom be és benne 3 link található, egy a főoldalra mutat, kettő pedig az egyes aloldalakra. 
A főoldalon lévő tartalmat egy `home-introduction` css osztállyal ellátott `div` tartalmazza, melyet csak bejelentkezés után ér el a felhasználó.  Ez a css osztály, a hivatkozott `main.css`-ben található és egy felső margót, valamint szélseeséget definiál:

```css
/* main.css */
.home-introduction {
    marpadding-top: 3%;
    width: 70%;
    margin: auto;gin-top:1em;
}
```

A XAMPP program gyökérkönyvtárában a `htdocs` mappában találhatók azok a fájlok, amelyeket kiszolgál a webszerver. 

## Design - CSS

A főbb CSS osztályokat a különálló `main.css` fájlba helyezhetjük. 


### Védekezés SQL injection ellen

Minden szövegdoboz, ahová a felhasználó írhat, lehetősége van SQL injektálni. Ennek megelőzése képpen mindenhol $mysql->real_escape_string-et kell használnunk.

### `Adatbáziskezelő php fájlok`

Az adatbáziskezelés megkönnyítésére néhány segédfüggvényt definiálunk, amelyeket egy külön fájlokba teszünk:

### Telefonok

A phone tábla tartalmát a `phones.php` oldalon jelenítjük meg. Ez tartalmazza a következő kódot!

```html
<?php require_once("includes/init.php"); ?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <title>Telefonok</title>

    <link rel="stylesheet" href="css/main.css"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">
</head>
<body>

<?php include 'navbar.html'; ?>

<div id="content">
    <table class="table">
        <?php
        $query = $mysql->query("SELECT * FROM phone");
        while ($row = $query->fetch_assoc()) {
        ?>
        <tr>
            <td>
                <img class="product-image" src="<?= $row['image'] ?>">
            </td>
            <td>
                <ul class="list-group">
                    <li class="list-group-item product-name"><?= $row['manufacturer'], " ", $row['name'] ?></li>
                    <li class="list-group-item"><?= "ROM: ", $row['ROM'], "GB" ?></li>
                    <li class="list-group-item"><?= "RAM: ", $row['RAM'], "GB" ?></li>
                    <li class="list-group-item"><?= "Kijelző: ", $row['display'] ?></li>
                    <li class="list-group-item"><?= "Garanciaidő: ", $row['guarantee_length'], " hónap" ?></li>
                    <li class="list-group-item">
                        <?php if ($row['in_stock'] > 0) {
                            echo "Készleten";
                        } else {
                            echo "Megrendelésre";
                        }
                        ?>
                    </li>
                    <?php if (isLoggedIn()) { ?>
                        <li class="list-group-item">
                            <a class="btn btn-primary" id="buy" href="purchase.php?id=<?= $row['Id'] ?>">
                                Megrendelem <i class="fa fa-angle-double-right"></i>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </td>
            <?php } ?>
        </tr>
    </table>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"
        integrity="sha384-u/bQvRA/1bobcXlcEYpsEdFVK/vJs3+T+nXLsBYJthmdBuavHvAW6UsmqO2Gd/F9"
        crossorigin="anonymous"></script>
</body>
</html>
```
A telefonok kilistázása egy egyszerű táblázat, amit a `main.css` és Bootstrap segítségével formázunk meg. A táblázat a phone adatbázistábla alapján írja ki, hogy az adott telefon készleten van-e. Ezt a következő kódrészlet vizsgálja:
```html
<?php if ($row['in_stock'] > 0) {
    echo "Készleten";
} else {
    echo "Megrendelésre";
}
?>
```
Az oldal felhasználja a `purchase.php` fájlt, ami az adatbázissal kommunikál. Ezt a fájlt a Megrendelem gomb megnyomásával tudjuk elérni. A `purchase.php` fájl kódja:
```html
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
```
A bejelentkezett felhasználó és a kiválasztott telefon Id-ja alapján létrehoz egy új sort a purchase adatbázistáblában, valamint az adott telefon készletét csökkenti eggyel.

## Vásárlásaim
A felhasználó ezen az oldalon tekintheti meg az általa megrendelt termékeket, valamint törölheti a megrendeléseit. 
Az oldal kódja:
```html
<?php
require_once('includes/init.php');

if(!isLoggedIn()){
    header("Location: /?error=1");
}

?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <title>Vásárlásaim</title>

    <link rel="stylesheet" href="css/main.css"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">
</head>
<body>

<?php include 'navbar.html'; ?>

<div class="purchase-table">
    <table class="table">
        <?php
        $customer_id = $_SESSION['user_id'];
        $query = $mysql->query("SELECT * FROM purchase WHERE customerId='$customer_id'");
        while($row = $query->fetch_assoc()){
            $phone_id = $row['phoneId'];
            $query2 = $mysql->query("SELECT * FROM phone WHERE id='$phone_id'");
            $results = $query2->fetch_assoc();

            ?>
            <tr>
                <td><img src="<?= $results['image'] ?>"></td>
                <td>
                    <ul class="list-group">
                        <li class="list-group-item product-name"><?= $results['manufacturer'], " ", $results['name'] ?></li>
                        <li class="list-group-item"><?= "ROM: ", $results['ROM'], "GB" ?></li>
                        <li class="list-group-item"><?= "RAM: ", $results['RAM'], "GB" ?></li>
                        <li class="list-group-item"><?= "Kijelző: ", $results['display'] ?></li>
                </td>

                <td class="purchase-date"><?= 'Vásárlás dátuma: ', $row['purchase_date'] ?></td>
                <td>
                    <a class="btn btn-primary" id="buy" href="remove_purchase.php?id=<?= $row['Id'] ?>">Törlés <i class="fa fa-times"></i></a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>

</body>
</html>
```
Itt először ellenőrizzük, hogy ki mi a belépett felhasználó Id-ja, majd ez alapján listázzuk ki a vásárlásait. A kilistázott tételek mindegyikéhez tartozik egy Törlés gomb, amely a `remove_purchase.php` fájra mutat. A `remove_purchase.php` fájl kódja:
```html
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
```
A felhasználó Id-ja alapján megkeressük a törölni kívánt tételt, majd töröljük is az adatbázisból, valamint növeljük a készleten lévő termékek számát.
