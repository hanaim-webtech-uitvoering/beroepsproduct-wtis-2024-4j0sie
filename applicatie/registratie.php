<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzeria Sole Machina</title>
    <link rel="normalize" href="normalize.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <main>
        <div class="account">
            <h1>Registreren</h1>
            <form action="account.php">
                <label for="vnaam">Voornaam *</label><br>
                <input type="text" id="vnaam" name="vnaam" placeholder="Voer hier je voornaam in" required><br><br>

                <label for="tussenvoegsel">Tussenvoegsels</label><br>
                <input type="text" id="tussenvoegsel" name="tussenvoegsel"><br><br>

                <label for="anaam">Achternaam *</label><br>
                <input type="text" id="anaam" name="anaam" placeholder="Voer hier je achternaam in" required><br><br>

                <label for="email">e-mailadres *</label><br>
                <input type="email" id="email" name="email" placeholder="janeDoe@gmail.com" required><br><br>

                <label for="nummer">telefoon *</label><br>
                <input type="number" id="nummer" name="nummer" placeholder="06 12345678" required><br><br>

                <label for="adres">Adres *</label><br>
                <input type="text" id="adres" name="adres" placeholder="Voer hier je straat in" required><br><br>

                <label for="postcode">Postcode *</label><br>
                <input type="text" id="postcode" name="postcode" placeholder="1234 AB" required><br><br>

                <label for="stad">Stad *</label><br>
                <input type="text" id="stad" name="stad" placeholder="Vul hier uw stad in" required><br><br>

                <input type="submit" value="Maak account aan">
            </form>
        </div>
    </main>

    <footer>
        <p>© 2024 Pizzeria Sole Machina. Alle rechten voorbehouden.</p>
    </footer>

</body>

</html>