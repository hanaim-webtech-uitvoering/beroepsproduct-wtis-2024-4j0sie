<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<header>
    <nav>
        <div class="Titel">Pizzeria Sole Machina</div>
        <div class="nav-items">
            <a href="index.php">Home</a>
            <a href="privacyverklaring.php">Privacyverklaring</a>
            <a href="bestellingen.php">Mijn winkelmandje</a>
            <?php if (isset($_SESSION['user']) && $_SESSION['user']['rol'] == 'Client') { ?>
                <a href="account.php">Account</a>
                <a href="logout.php">Uitloggen</a>
            <?php } else if (isset($_SESSION['user']) && $_SESSION['user']['rol'] == 'Personnel') { ?>
                    <a href="overzicht.php">Beheer Bestellingen</a>
                    <a href="logout.php">Uitloggen</a>
            <?php } else { ?>
                    <a href="login.php">Inloggen</a>
                    <a href="registratie.php">Registreren</a>
            <?php } ?>

        </div>
    </nav>
</header>