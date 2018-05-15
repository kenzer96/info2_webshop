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
