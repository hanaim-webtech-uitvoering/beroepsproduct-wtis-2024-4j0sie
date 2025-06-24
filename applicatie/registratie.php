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
    $voornaam = trim($_POST['vnaam']);
    $achternaam = trim($_POST['anaam']);
    $adres = trim($_POST['adres']);
    $rol = 'Client';
    $postcode = trim($_POST['postcode']);
    $stad = trim($_POST['stad']);



    if (empty($voornaam) || empty($achternaam) || empty($username) || empty($adres) || empty($postcode) || empty($stad) || empty($wachtwoord)) {
        $foutmelding = "Vul alle verplichte velden in.";
        exit;
    }

    $db = maakVerbinding();

    if (getUserInfo($username)) {
        $foutmelding = "Deze gebruikersnaam is al in gebruik, probeer een andere.";
    } else if (strlen($voornaam) > 50) {
        $foutmelding = "Voornaam mag niet langer zijn dan 50 tekens.";
    } else if (!preg_match("/^[a-zA-Z-' ]+$/", $voornaam)) {
        $foutmelding = "Voornaam mag alleen letters, spaties, koppeltekens en apostroffen bevatten.";
    } else if (strlen($achternaam) > 50) {
        $foutmelding = "Achternaam mag niet langer zijn dan 50 tekens.";
    } else if (!preg_match("/^[a-zA-Z-' ]+$/", $achternaam)) {
        $foutmelding = "Achternaam mag alleen letters, spaties, koppeltekens en apostroffen bevatten.";
    } else if (strlen($username) < 4 || strlen($username) > 20) {
        $foutmelding = "Gebruikersnaam moet tussen de 4 en 20 tekens zijn.";
    } else if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $foutmelding = "Gebruikersnaam mag alleen letters, cijfers en underscores bevatten.";
    } else if (strlen($adres) > 50) {
        $foutmelding = "Adres mag niet langer zijn dan 50 tekens.";
    } else if (!preg_match("/^[a-zA-Z0-9\s\-\.'']+$/", $adres)) {
        $foutmelding = "Adres mag alleen letters, cijfers, spaties, koppeltekens, apostroffen en punten bevatten.";
    } else if (!preg_match('/^[0-9]{4}\s?[A-Za-z]{2}$/', $postcode)) {
        $foutmelding = "Postcode moet in het formaat 1234 AB zijn.";
    } else if (strlen($stad) > 50) {
        $foutmelding = "Stad mag niet langer zijn dan 50 tekens.";
    } else if (!preg_match("/^[a-zA-Z-' ]+$/", $stad)) {
        $foutmelding = "Stad mag alleen letters, spaties, koppeltekens en apostroffen bevatten.";
    } else if (strlen($wachtwoord) < 8) {
        $foutmelding = "Wachtwoord moet minimaal 8 tekens zijn.";
    } else {

        $hash = password_hash($wachtwoord, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO [User] ([username], [password], [first_name], [last_name], [address], [role], [postcode], [city]) 
   VALUES (:username, :password, :voornaam, :achternaam, :adres, :rol, :postcode, :stad)");

        $stmt->execute([
            ':username' => $username,
            ':password' => $hash,
            ':voornaam' => $voornaam,
            ':achternaam' => $achternaam,
            ':adres' => $adres,
            ':rol' => $rol,
            ':postcode' => $postcode,
            ':stad' => $stad
        ]);
        $_SESSION['user'] = [
            'username' => $username,
            'voornaam' => $voornaam,
            'achternaam' => $achternaam,
            'adres' => $adres,
            'rol' => $rol,
            'postcode' => $postcode,
            'stad' => $stad
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
            <form method="POST" action="registratie.php">
                <label for="vnaam">Voornaam *</label><br>
                <input type="text" id="vnaam" name="vnaam" maxlength="50" placeholder="Voer hier uw voornaam in"
                    required><br><br>

                <label for="anaam">Achternaam *</label><br>
                <input type="text" id="anaam" name="anaam" maxlength="50" placeholder="Inclusief tussenvoegsels"
                    required><br><br>

                <label for="username">Gebruikersnaam *</label><br>
                <input type="text" id="username" name="username" minlength="4" maxlength="20" placeholder="JaneDoe123"
                    required><br><br>

                <label for="adres">Adres *</label><br>
                <input type="text" id="adres" name="adres" maxlength="50" placeholder="Voer hier uw adres in"
                    required><br><br>

                <label for="postcode">Postcode *</label><br>
                <input type="text" id="postcode" name="postcode" pattern="^[0-9]{4}\s?[A-Za-z]{2}$" maxlength="7"
                    placeholder="1234 AB" required><br><br>

                <label for="stad">Stad *</label><br>
                <input type="text" id="stad" name="stad" maxlength="50" placeholder="Vul hier uw stad in"
                    required><br><br>

                <label for="password">Wachtwoord *</label><br>
                <input type="password" id="password" name="password" minlength="8" placeholder="Min. 8 karakters"
                    required><br><br>

                <?php if (!empty($foutmelding)) { ?>
                    <div class="error-message">
                        <?php echo htmlspecialchars($foutmelding); ?>
                    </div>
                <?php } ?>
                <input type="submit" value="Maak account aan">
            </form>
        </div>
    </main>

    <footer>
        <p>© 2024 Pizzeria Sole Machina. Alle rechten voorbehouden.</p>
    </footer>

</body>

</html>