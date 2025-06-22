<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,
        initial-scale=1.0">


    <title>Pizzeria Sole Machina</title>
    <link rel="normalize" href="normalize.css">
    <link rel="stylesheet" href="styles.css">

</head>

<body>
    <?php include 'header.php'; ?>
    <main>
        <div class="account">
            <h2>Voer je adres in, of <a href="login.php">log in om je adres op te slaan</a>.</h2>
            <form action="betaalpagina.php">
                <label for="Straat">Straatnaam en nummer *</label><br>
                <input type="text" id="Straat" name="Straat" placeholder="Voer hier je straat in" required>
                <input type="number" id="huisnr" name="huisnr" placeholder="Straatnummer" required><br><br>

                <label for="postcode">Postcode *</label><br>
                <input type="text" id="postcode" name="postcode" placeholder="1234 AB" required><br><br>

                <label for="Stad">Stad *</label><br>
                <input type="text" id="Stad" name="Stad" placeholder="Vul hier uw stad in" required><br><br>

                <input type="submit" value="Doorgaan naar betaalpagina">
            </form>
        </div>
    </main>
    <footer>
        <p>© 2024 Pizzeria Sole Machina. Alle rechten voorbehouden.</p>
    </footer>
</body>

</html>