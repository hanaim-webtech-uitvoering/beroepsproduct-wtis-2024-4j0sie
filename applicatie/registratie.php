<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzeria Sole Machina</title>
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <main>
        <div class="account">
            <h1>Registreren</h1>
            <form method="POST" action="registratieverwerken.php">
                <label for="vnaam">Voornaam *</label><br>
                <input type="text" id="vnaam" name="vnaam" placeholder="Voer hier uw voornaam in" required><br><br>

                <label for="anaam">Achternaam *</label><br>
                <input type="text" id="anaam" name="anaam" placeholder="Inclusief tussenvoegsels" required><br><br>

                <label for="username">Gebruikersnaam *</label><br>
                <input type="text" id="username" name="username" placeholder="JaneDoe123" required><br><br>

                <label for="adres">Adres *</label><br>
                <input type="text" id="adres" name="adres" placeholder="Voer hier uw adres in" required><br><br>

                <label for="postcode">Postcode *</label><br>
                <input type="text" id="postcode" name="postcode" placeholder="1234 AB" required><br><br>

                <label for="stad">Stad *</label><br>
                <input type="text" id="stad" name="stad" placeholder="Vul hier uw stad in" required><br><br>

                <label for="password">Wachtwoord *</label><br>
                <input type="password" id="password" name="password" placeholder="Min. 8 karakters" required><br><br>

                <input type="submit" value="Maak account aan">
            </form>
        </div>
    </main>

    <footer>
        <p>© 2024 Pizzeria Sole Machina. Alle rechten voorbehouden.</p>
    </footer>

</body>

</html>