<?php require_once 'functies/data_functies.php';
if (!isset($_SESSION['user']) || $_SESSION['user']['rol'] != 'Personnel') {
    header('Location: index.php');
    exit;
}

$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'], $_POST['nieuwe_status'])) {
    $db = maakVerbinding();
    $stmt = $db->prepare("UPDATE Pizza_Order SET status = :status WHERE order_id = :order_id");
    $stmt->execute([
        ':status' => intval($_POST['nieuwe_status']),
        ':order_id' => intval($_POST['order_id'])
    ]);
    header("Location: details.php?order_id=" . $order_id);
    exit;
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
        <?php
        if ($order_id <= 0) {
            echo "<p>Geen geldige bestelling geselecteerd.</p>";
        } else {
            $bestelling = getOrderById($order_id);

            if (!$bestelling) {
                echo "<p>Bestelling niet gevonden.</p>";
            } else {
                // adres verwerken, oude inserts gegevens opsplitsen 
                $postcode = $bestelling['postcode'] ?? '';
                $stad = $bestelling['city'] ?? '';
                $adres = $bestelling['address'] ?? '';
                if ((empty($postcode) || empty($stad)) && !empty($adres)) {
                    $parts = explode(',', $adres);
                    if (count($parts) >= 3) {
                        $adres = trim($parts[0]);
                        $postcode = trim($parts[1]);
                        $stad = trim($parts[2]);
                    }
                } else {
                    $parts = explode(',', $adres);
                    if (count($parts) >= 1) {
                        $adres = trim($parts[0]);
                    }
                }
                ?>
                <h1>Bestelling #<?php echo htmlspecialchars($bestelling['order_id']); ?></h1>
                <div class="bestelling">
                    <p><strong>Naam:</strong> <?php echo htmlspecialchars($bestelling['client_name']); ?></p>
                    <p><strong>Adres:</strong> <?php echo htmlspecialchars($adres); ?></p>
                    <p><strong>Postcode:</strong> <?php echo htmlspecialchars($postcode); ?></p>
                    <p><strong>Stad:</strong> <?php echo htmlspecialchars($stad); ?></p>
                    <p><strong>Status:</strong> <?php echo htmlspecialchars(statusText($bestelling['status'])); ?></p>
                </div>
                <h2>Producten</h2>
                <?php
                $producten = getOrderProducts($order_id);
                if (!$producten) {
                    echo "<p>Geen producten gevonden voor deze bestelling.</p>";
                } else {
                    foreach ($producten as $product) { ?>
                        <div class="bestelling">
                            <p><strong><?php echo htmlspecialchars($product['product_name']); ?></strong>
                                (x<?php echo (int) $product['quantity']; ?>)</p>
                            <p>Ingrediënten:
                                <?php
                                if (!empty($product['ingredienten'])) {
                                    echo htmlspecialchars(implode(', ', $product['ingredienten']));
                                } else {
                                    echo '<em>Geen ingrediënten bekend</em>';
                                }
                                ?>
                            </p>
                        </div>
                    <?php }
                }

                if ($bestelling['status'] == 1) { ?>
                    <form method="post">
                        <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($bestelling['order_id']); ?>">
                        <input type="hidden" name="nieuwe_status" value="2">
                        <button type="submit" class="details-knop">Zet op 'In bezorging'</button>
                    </form>
                <?php } elseif ($bestelling['status'] == 2) { ?>
                    <form method="post">
                        <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($bestelling['order_id']); ?>">
                        <input type="hidden" name="nieuwe_status" value="3">
                        <button type="submit" class="details-knop">Zet op 'Afgerond'</button>
                    </form>
                <?php }
            }
        }
        ?>
        <div class="lege-winkelwagen">
            <a href="overzicht.php" class="details-knop">Terug naar menu</a>
        </div>


    </main>
    <footer>
        <p>© 2024 Pizzeria Sole Machina. Alle rechten voorbehouden.</p>
    </footer>
</body>

</html>