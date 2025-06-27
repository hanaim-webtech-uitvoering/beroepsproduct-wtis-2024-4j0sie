<?php
require_once 'functies/data_functies.php';
require_once 'functies/db_connectie.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
} elseif (isset($_SESSION['user']) && $_SESSION['user']['rol'] === 'Personnel') {
    header('Location: overzicht.php');
    exit;
}

$username = $_SESSION['user']['username'];
$bestellingen = getUserOrders($username);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <main>
        <h1>Mijn profiel</h1>

        <h2>Actieve bestellingen:</h2>
        <?php
        $isActief = false;
        foreach ($bestellingen as $bestelling) {
            if ($bestelling['status'] < 3) {
                $isActief = true;
                ?>
                <div class="bestelling">
                    <p><strong>Bestelnummer:</strong> #<?php echo htmlspecialchars($bestelling['order_id']); ?></p>
                    <p><strong>Status:</strong> <?php echo htmlspecialchars(statusText($bestelling['status'])); ?></p>
                    <p><strong>Besteld op:</strong> <?php echo htmlspecialchars($bestelling['datetime']); ?></p>
                    <p><strong>Naam:</strong> <?php echo htmlspecialchars($bestelling['client_name']); ?></p>
                    <p><strong>Adres:</strong> <?php echo htmlspecialchars($bestelling['address']); ?></p>
                    <p><strong>Postcode:</strong> <?php echo htmlspecialchars($bestelling['postcode']); ?></p>
                    <p><strong>Stad:</strong> <?php echo htmlspecialchars($bestelling['city'] ?? ''); ?></p>
                </div>
                <?php
            }
        }
        if (!$isActief) { ?>
            <div class="actieve-bestelling">
                <p>Geen actieve bestellingen.</p>
            </div>
        <?php }
        ?>
        <h2>Gesloten bestellingen</h2>
        <?php
        $isGesloten = false;
        foreach ($bestellingen as $bestelling) {
            if ($bestelling['status'] == 3) {
                $isGesloten = true;
                ?>
                <div class="bestelling">
                    <p><strong>Bestelnummer:</strong> #<?php echo htmlspecialchars($bestelling['order_id']); ?></p>
                    <p><strong>Status:</strong> <?php echo htmlspecialchars(statusText($bestelling['status'])); ?></p>
                    <p><strong>Besteld op:</strong> <?php echo htmlspecialchars($bestelling['datetime']); ?></p>
                    <p><strong>Naam:</strong> <?php echo htmlspecialchars($bestelling['client_name']); ?></p>
                    <p><strong>Adres:</strong> <?php echo htmlspecialchars($bestelling['address']); ?></p>
                    <p><strong>Postcode:</strong> <?php echo htmlspecialchars($bestelling['postcode']); ?></p>
                    <p><strong>Stad:</strong> <?php echo htmlspecialchars($bestelling['city'] ?? ''); ?></p>
                </div>
                <?php
            }
        }
        if (!$isGesloten) { ?>
            <div class="actieve-bestelling" <p>Geen gesloten bestellingen.</p>
            </div>
        <?php } ?>

    </main>

    <footer>
        <p>© 2024 Pizzeria Sole Machina. Alle rechten voorbehouden.</p>
    </footer>

</body>

</html>