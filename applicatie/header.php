<?php
require_once 'functies/data_functies.php';
?>
<header>
    <nav>
        <div class="Titel">Pizzeria Sole Machina</div>
        <div class="nav-items">
            <?php if (!isset($_SESSION['user'])): ?>
                <a href="index.php">Home</a>
                <a href="bestellingen.php">Mijn winkelmandje</a>
                <a href="bestelling_status.php">Status van uw bestelling</a>
                <a href="login.php">Inloggen</a>
                <a href="registratie.php">Registreren</a>

            <?php elseif ($_SESSION['user']['rol'] === 'Client'): ?>
                <a href="index.php">Home</a>
                <a href="bestellingen.php">Mijn winkelmandje</a>
                <a href="account.php">Profiel</a>
                <a href="logout.php">Uitloggen</a>

            <?php elseif ($_SESSION['user']['rol'] === 'Personnel'): ?>
                <a href="overzicht.php">Bestelling overzicht</a>
                <a href="logout.php">Uitloggen</a>
            <?php endif; ?>

            <a href="privacyverklaring.php">Privacyverklaring</a>
        </div>
    </nav>
</header>