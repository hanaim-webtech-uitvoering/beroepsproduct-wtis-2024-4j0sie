<?php require_once 'functies/data_functies.php';

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
                        <button class="voeg-toe">+</button>
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