<?php
session_start();
require_once 'functies/db_connectie.php';
require_once 'functies/data_functies.php';

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
        echo "Vul alle verplichte velden in.";
        exit;
    }

    $db = maakVerbinding();

    if (getUserInfo($username)) {
        echo "Deze gebruikersnaam bestaat al, probeer een andere.";
        exit;
    }
    // Wachtwoord hashen
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