<?php require_once 'functies/data_functies.php';
if (!isset($_SESSION['user']) || $_SESSION['user']['rol'] != 'Personnel') {
    header('Location: index.php');
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'], $_POST['nieuwe_status'])) {
    $db = maakVerbinding();
    $stmt = $db->prepare("UPDATE Pizza_Order SET status = :status WHERE order_id = :order_id");
    $stmt->execute([
        ':status' => intval($_POST['nieuwe_status']),
        ':order_id' => intval($_POST['order_id'])
    ]);

    header("Location: overzicht.php");
    exit;
}

$bestellingen = getAllOrders();


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
        <h1>Overzicht bestellingen</h1>
        <h2>In behandeling</h2>

        <?php
        $inBehandeling = false;
        foreach ($bestellingen as $bestelling) {
            if ($bestelling['status'] == 1) {
                $inBehandeling = true; ?>
                <div class="bestelling">
                    <div class="bestelling-header">
                        <div></div>
                        <div class="status-actions">
                            <span>Pas status aan naar:</span>
                            <?php
                            $statusOpties = [
                                1 => 'In behandeling',
                                2 => 'In bezorging',
                                3 => 'Afgerond'
                            ];
                            foreach ($statusOpties as $statusWaarde => $statusNaam) {
                                if ($statusWaarde != $bestelling['status']) { ?>
                                    <form method="post" style="display:inline;">
                                        <input type="hidden" name="order_id"
                                            value="<?php echo htmlspecialchars($bestelling['order_id']); ?>">
                                        <input type="hidden" name="nieuwe_status" value="<?php echo $statusWaarde; ?>">
                                        <button type="submit" class="status-knop"><?php echo $statusNaam; ?></button>
                                    </form>
                                <?php }
                            }
                            ?>
                        </div>
                    </div>
                    <p><strong>Bestelnummer:</strong> #<?php echo htmlspecialchars($bestelling['order_id']); ?></p>
                    <p><strong>Aangewezen aan:</strong> <?php echo htmlspecialchars($bestelling['personnel_username']); ?></p>
                    <p><strong>Status:</strong> <?php echo htmlspecialchars(statusText($bestelling['status'])); ?></p>
                    <p><strong>Besteld op:</strong> <?php echo htmlspecialchars($bestelling['datetime']); ?></p>

                    <form action="details.php" method="get" class="details-form">
                        <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($bestelling['order_id']); ?>">
                        <button type="submit" class="details-knop">Bekijk details</button>
                    </form>
                </div>
                <?php
            }
        }
        if (!$inBehandeling) { ?>
            <div class="actieve-bestelling" <p>Geen bestellingen in behandeling.</p>
            </div>
        <?php }
        ?>
        <h2>In bezorging</h2>
        <?php
        $inBezorging = false;
        foreach ($bestellingen as $bestelling) {
            if ($bestelling['status'] == 2) {
                $inBezorging = true; ?>
                <div class="bestelling">
                    <div class="bestelling-header">
                        <div></div> <!-- lege div voor ruimte links -->
                        <div class="status-actions">
                            <span>Pas status aan naar:</span>
                            <?php
                            $statusOpties = [
                                1 => 'In behandeling',
                                2 => 'In bezorging',
                                3 => 'Afgerond'
                            ];
                            foreach ($statusOpties as $statusWaarde => $statusNaam) {
                                if ($statusWaarde != $bestelling['status']) { ?>
                                    <form method="post" style="display:inline;">
                                        <input type="hidden" name="order_id"
                                            value="<?php echo htmlspecialchars($bestelling['order_id']); ?>">
                                        <input type="hidden" name="nieuwe_status" value="<?php echo $statusWaarde; ?>">
                                        <button type="submit" class="status-knop"><?php echo $statusNaam; ?></button>
                                    </form>
                                <?php }
                            }
                            ?>
                        </div>
                    </div>
                    <p><strong>Bestelnummer:</strong> #<?php echo htmlspecialchars($bestelling['order_id']); ?></p>
                    <p><strong>Aangewezen aan:</strong> <?php echo htmlspecialchars($bestelling['personnel_username']); ?></p>
                    <p><strong>Status:</strong> <?php echo htmlspecialchars(statusText($bestelling['status'])); ?></p>
                    <p><strong>Besteld op:</strong> <?php echo htmlspecialchars($bestelling['datetime']); ?></p>
                    <form action="details.php" method="get" class="details-form">
                        <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($bestelling['order_id']); ?>">
                        <button type="submit" class="details-knop">Bekijk details</button>
                    </form>
                </div>
                <?php
            }
        }
        if (!$inBezorging) { ?>
            <div class="actieve-bestelling" <p>Geen bestellingen in behandeling.</p>
            </div>
        <?php }
        ?>
        <h2>Gesloten bestellingen</h2>
        <?php
        $afgerond = false;
        foreach ($bestellingen as $bestelling) {
            if ($bestelling['status'] == 3) {
                $afgerond = true; ?>
                <div class="bestelling">
                    <div class="bestelling-header">
                        <div></div> <!-- lege div voor ruimte links -->
                        <div class="status-actions">
                            <span>Pas status aan naar:</span>
                            <?php
                            $statusOpties = [
                                1 => 'In behandeling',
                                2 => 'In bezorging',
                                3 => 'Afgerond'
                            ];
                            foreach ($statusOpties as $statusWaarde => $statusNaam) {
                                if ($statusWaarde != $bestelling['status']) { ?>
                                    <form method="post" style="display:inline;">
                                        <input type="hidden" name="order_id"
                                            value="<?php echo htmlspecialchars($bestelling['order_id']); ?>">
                                        <input type="hidden" name="nieuwe_status" value="<?php echo $statusWaarde; ?>">
                                        <button type="submit" class="status-knop"><?php echo $statusNaam; ?></button>
                                    </form>
                                <?php }
                            }
                            ?>
                        </div>
                    </div>
                    <p><strong>Bestelnummer:</strong> #<?php echo htmlspecialchars($bestelling['order_id']); ?></p>
                    <p><strong>Aangewezen aan:</strong> <?php echo htmlspecialchars($bestelling['personnel_username']); ?></p>
                    <p><strong>Status:</strong> <?php echo htmlspecialchars(statusText($bestelling['status'])); ?></p>
                    <p><strong>Besteld op:</strong> <?php echo htmlspecialchars($bestelling['datetime']); ?></p>
                    <form action="details.php" method="get" class="details-form">
                        <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($bestelling['order_id']); ?>">
                        <button type="submit" class="details-knop">Bekijk details</button>
                    </form>
                </div>
                <?php
            }
        }
        if (!$afgerond) { ?>
            <div class="actieve-bestelling" <p>Geen gesloten bestellingen.</p>
            </div>
        <?php }
        ?>


    </main>

    <footer>
        <p>© 2024 Pizzeria Sole Machina. Alle rechten voorbehouden.</p>
    </footer>

</body>

</html>