<?php require_once 'functies/db_connectie.php';
require_once 'functies/data_functies.php';

$foutmelding = '';

if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $wachtwoord = $_POST['password'];

    // Error melding moet ff mooier
    if (empty($username) || empty($wachtwoord)) {
        $foutmelding = "Vul alle verplichte velden in.";
        exit;
    }

    $db = maakVerbinding();
    $user = getUserInfo($username);

    if (!$user || !password_verify($wachtwoord, $user['password'])) {
        $foutmelding = "Ongeldige gebruikersnaam of wachtwoord.";
    } else {
        $_SESSION['user'] = [
            'username' => $user['username'],
            'voornaam' => $user['first_name'],
            'achternaam' => $user['last_name'],
            'adres' => $user['address'],
            'rol' => $user['role'],
            'postcode' => $user['postcode'],
            'stad' => $user['city']
        ];

        header('Location: index.php');
        exit;
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
        <h1>Inloggen</h1>
        <form method="POST" action="login.php">
            <label for="username">Gebruikersnaam *</label><br>
            <input type="text" id="username" name="username" placeholder="Voer uw gebruikersnaam in" required><br><br>

            <label for="password">Wachtwoord *</label><br>
            <input type="password" id="password" name="password" placeholder="Voer uw wachtwoord in" required><br><br>

            <?php if (!empty($foutmelding)) { ?>
                <div class="error-message">
                    <?php echo htmlspecialchars($foutmelding); ?>
                </div>
            <?php } ?>
            <input type="submit" value="Inloggen"><br><br>

        </form>

        <div class="login-links">
            <a href="registratie.php">Nog geen account? Maak hier een account aan</a><br><br>
        </div>

    </main>

    <footer>
        <p>© 2024 Pizzeria Sole Machina. Alle rechten voorbehouden.</p>
    </footer>
</body>

</html>