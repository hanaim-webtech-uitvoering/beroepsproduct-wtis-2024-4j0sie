<?php require_once 'functies/data_functies.php';

$adres = '';
$postcode = '';
$stad = '';

if (isset($_SESSION['user'])) {
    $adres = $_SESSION['user']['adres'];
    $postcode = $_SESSION['user']['postcode'];
    $stad = $_SESSION['user']['stad'];
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
        <div class="account">
            <?php if (isset($_SESSION['user'])) { ?>
                <h2>Uw adres is automatisch ingevuld. Pas eventueel de gegevens aan.</a></h2>
            <?php } else { ?>
                <h2>Voer je adres in, of <a href="login.php">log in om je adres op te slaan</a></h2>
            <?php } ?>
            <form method="POST" action="betaalpagina.php">
                <label for="adres">Adres *</label><br>
                <input type="text" id="adres" name="adres" placeholder="Voer hier je straat in"
                    value="<?php echo htmlspecialchars($adres) ?>" required><br><br>

                <label for="postcode">Postcode *</label><br>
                <input type="text" id="postcode" name="postcode" placeholder="1234 AB"
                    value="<?php echo htmlspecialchars($postcode) ?>" required><br><br>

                <label for="Stad">Stad *</label><br>
                <input type="text" id="Stad" name="Stad" placeholder="Vul hier uw stad in"
                    value="<?php echo htmlspecialchars($stad) ?>" required><br><br>

                <input type="submit" value="Doorgaan naar betaalpagina">
            </form>
        </div>
    </main>
    <footer>
        <p>© 2024 Pizzeria Sole Machina. Alle rechten voorbehouden.</p>
    </footer>
</body>

</html>