<?php require_once 'functies/data_functies.php';
if (!isset($_SESSION['winkelwagen'])) {
    $_SESSION['winkelwagen'] = [];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product'])) {
    $product = trim($_POST['product']);
    addToCart($product);
    header('Location: bestellingen.php');
    exit;

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['verwijder'])) {
    $product = trim($_POST['verwijder']);
    removeFromCart($product);
    header('Location: bestellingen.php');
    exit;
}
$menu = getMenu();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, 
        initial-scale=1.0">

    <title>Winkelmandje</title>
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="styles.css">

</head>

<body>
    <?php include 'header.php'; ?>


    <main>
        <h2>In mijn winkelwagen:</h2>

        <?php if (empty($_SESSION['winkelwagen'])) { ?>
            <h1> Uw winkelwagen is leeg </h1>
        <?php } else { ?>
            <div class="box-container">
                <?php
                foreach ($_SESSION['winkelwagen'] as $productNaam => $aantal) {
                    foreach ($menu as $categorie => $producten) {
                        if (isset($producten[$productNaam])) {
                            $productInfo = $producten[$productNaam];
                            ?>
                            <div class="box">
                                <div class="aantal">
                                    <p>In winkelwagen: <?php if (isset($_SESSION['winkelwagen'][$productNaam])) {
                                        echo htmlspecialchars($_SESSION['winkelwagen'][$productNaam]);
                                    } else {
                                        echo '0';
                                    } ?>
                                    </p>
                                </div>
                                <img src="images/<?php echo htmlspecialchars($productNaam); ?>.png"
                                    alt="<?php echo htmlspecialchars($productNaam); ?>" class="box-image">
                                <p style="font-weight:bold;"><?php echo htmlspecialchars($productNaam); ?></p>
                                <p class="ingredienten">Ingrediënten:
                                    <?php if (empty(implode(', ', $productInfo['ingredients']))) {
                                        echo 'Geen ingrediënten beschikbaar';
                                    } else {
                                        echo htmlspecialchars(implode(', ', $productInfo['ingredients']));
                                    } ?>
                                </p>
                                <p>€<?php echo htmlspecialchars($productInfo['price']); ?></p>
                                <div class="toevoegen">
                                    <form method="POST">
                                        <input type="hidden" name="product" value="<?php echo htmlspecialchars($productNaam); ?>" />
                                        <button type="submit">Toevoegen</button>
                                    </form>
                                    <form method="POST">
                                        <input type="hidden" name="verwijder" value="<?php echo htmlspecialchars($productNaam); ?>" />
                                        <button type="submit">Verwijderen</button>
                                    </form>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
            </div><br>
            <div class="totaalmenu">
                <div class="totaal">
                    <?php
                    $totaalPrijs = getTotalPrice($menu);
                    $totaalAantal = array_sum($_SESSION['winkelwagen']);
                    ?>
                    <p>Totaal: €<?php echo htmlspecialchars($totaalPrijs); ?>
                        (<?php echo htmlspecialchars($totaalAantal); ?> items.)</p>
                    <p>Let op: Afrekenen kan alleen aan de deur.</p>
                </div>
                <div class="button-link">
                    <a href="index.php">Verder winkelen</a>
                </div>
                <div class="button-link">
                    <a href="betaling.php">Afrekenen</a>
                </div>
            </div>
        <?php } ?>
    </main>

    <footer>
        <p>© 2024 Pizzeria Sole Machina. Alle rechten voorbehouden.</p>
    </footer>
</body>

</html>