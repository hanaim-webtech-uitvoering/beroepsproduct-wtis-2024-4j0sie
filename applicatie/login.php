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

        <h1>Inloggen</h1>

        <form action="account.php">
            <label for="email">E-mailadres</label><br>
            <input type="email" id="email" name="email" placeholder="Voer je e-mailadres in" required><br><br>

            <label for="password">Wachtwoord</label><br>
            <input type="password" id="password" name="password" placeholder="Voer je wachtwoord in" required><br><br>

            <input type="submit" value="Inloggen"><br><br>

        </form>

        <div class="login-links">
            <a href="registratie.php">Account aanmaken</a><br><br>
        </div>

    </main>

    <footer>
        <p>© 2024 Pizzeria Sole Machina. Alle rechten voorbehouden.</p>
    </footer>
</body>

</html>