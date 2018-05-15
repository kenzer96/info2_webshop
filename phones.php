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
