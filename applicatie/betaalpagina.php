<?php
require_once 'functies/data_functies.php';
if (isset($_SESSION['user']) && $_SESSION['user']['rol'] === 'Personnel') {
    header('Location: overzicht.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $adres = trim($_POST['adres']);
    $postcode = substr(trim($_POST['postcode']), 0, 7); // pas 7 aan naar jouw kolomgrootte
    $stad = trim($_POST['stad']);

    $order_id = processOrder($adres, $postcode, $stad);

    header("Location: betaalpagina.php?success=1&order_id=$order_id");
    exit;
}
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
        <?php if (isset($_GET['success'])) { ?>
            <h1>Uw bestelling is geplaatst!</h1>
            <div class="actieve-bestelling">
                <p>Bedankt voor uw bestelling bij Pizzeria Sole Machina!</p>
                <p>Uw bestelnummer is: #<?php echo htmlspecialchars($_GET['order_id']); ?></p>
                <?php if (isset($_SESSION['user'])) { ?>
                    <p>Om de status van uw bestelling te bekijken kunt u navigeren naar het <a href="account.php">overzicht.</a>
                    <?php } else { ?>
                    <p>Onthoud het bestelnummer als u de status wilt bekijken.</p>
                    <p> Om de status van uw bestelling te bekijken kunt u
                        <a href="bestelling_status.php?order_id=<?php echo urlencode($_GET['order_id']); ?>">hier</a>
                        uw status zien.
                    </p>
                <?php } ?>
            </div>
        <?php } ?>
    </main>

    <footer>
        <p>© 2024 Pizzeria Sole Machina. Alle rechten voorbehouden.</p>
    </footer>
</body>

</html>