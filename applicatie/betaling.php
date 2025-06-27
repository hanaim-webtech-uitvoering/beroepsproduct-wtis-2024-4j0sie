<?php require_once 'functies/data_functies.php';
if (isset($_SESSION['user']) && $_SESSION['user']['rol'] === 'Personnel') {
    header('Location: overzicht.php');
    exit;
}
$foutmelding = '';
$adres = '';
$postcode = '';
$stad = '';

if (isset($_SESSION['user'])) {
    $adres = $_SESSION['user']['adres'];
    $postcode = $_SESSION['user']['postcode'];
    $stad = $_SESSION['user']['stad'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adres = $_POST['adres'] ?? '';
    $postcode = $_POST['postcode'] ?? '';
    $stad = $_POST['stad'] ?? '';

    if (strlen($adres) > 50) {
        $foutmelding = "Adres mag niet langer zijn dan 50 tekens.";
    } else if (!preg_match("/^[a-zA-Z0-9\s\-\.'']+$/", $adres)) {
        $foutmelding = "Adres mag alleen letters, cijfers, spaties, koppeltekens, apostroffen en punten bevatten.";
    } else if (!preg_match('/^[0-9]{4}\s?[A-Za-z]{2}$/', $postcode)) {
        $foutmelding = "Postcode moet in het formaat 1234 AB zijn.";
    } else if (strlen($stad) > 50) {
        $foutmelding = "Stad mag niet langer zijn dan 50 tekens.";
    } else if (!preg_match("/^[a-zA-Z-' ]+$/", $stad)) {
        $foutmelding = "Stad mag alleen letters, spaties, koppeltekens en apostroffen bevatten.";
    }
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
                    value="<?php echo htmlspecialchars($adres) ?>" maxlength="50" required
                    pattern="[a-zA-Z0-9\s\-\.']+"><br><br>

                <label for="postcode">Postcode *</label><br>
                <input type="text" id="postcode" name="postcode" placeholder="1234 AB" maxlength="7"
                    value="<?php echo htmlspecialchars($postcode) ?>" required pattern="[0-9]{4}\s?[A-Za-z]{2}"><br><br>

                <label for="stad">Stad *</label><br>
                <input type="text" id="stad" name="stad" placeholder="Vul hier uw stad in"
                    value="<?php echo htmlspecialchars($stad) ?>" maxlength="50" required
                    pattern="[a-zA-Z\s\-']+"><br><br>
                <?php if (!empty($foutmelding)) { ?>
                    <div class="error-message">
                        <?php echo htmlspecialchars($foutmelding); ?>
                    </div>
                <?php } ?>
                <input type="submit" value="Doorgaan naar betaalpagina">
            </form>
        </div>
    </main>
    <footer>
        <p>© 2024 Pizzeria Sole Machina. Alle rechten voorbehouden.</p>
    </footer>
</body>

</html>