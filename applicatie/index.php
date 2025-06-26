<?php require_once 'functies/data_functies.php';
if (!isset($_SESSION['winkelwagen'])) {
    $_SESSION['winkelwagen'] = [];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product'])) {
    $product = trim($_POST['product']);
    addToCart($product);
    header('Location: index.php');
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

    <title>Pizzeria Sole Machina</title>
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="styles.css">


</head>

<body>
    <?php include 'header.php'; ?>

    <main>
        <?php foreach ($menu as $categorie => $producten) { ?>
            <h1><?php echo htmlspecialchars($categorie); ?></h1>
            <div class="box-container">
                <?php foreach ($producten as $productNaam => $productInfo) { ?>
                    <div class="box">
                        <div class="aantal">
                            <p>In winkelwagen: <?php if (isset($_SESSION['winkelwagen'][$productNaam])) {
                                echo htmlspecialchars($_SESSION['winkelwagen'][$productNaam]);
                            } else {
                                echo '0';
                            } ?>
                            </p>
                        </div>
                        <img src="images/<?php echo $productNaam; ?>.png" alt="<?php echo htmlspecialchars($productNaam); ?>"
                            class="box-image">
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
                        </div>

                    </div>
                <?php } ?>
            </div>
        <?php } ?>

    </main>
    <footer>
        <p>© 2024 Pizzeria Sole Machina. Alle rechten voorbehouden.</p>

    </footer>





</body>

</html>