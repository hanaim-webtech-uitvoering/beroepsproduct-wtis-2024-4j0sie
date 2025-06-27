<?php
require_once 'functies/data_functies.php';
if (isset($_SESSION['user']) && $_SESSION['user']['rol'] === 'Personnel') {
    header('Location: overzicht.php');
    exit;
}

$statusText = '';
$bestelling = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['order_id'])) {
    $order_id = intval($_POST['order_id']);
    $db = maakVerbinding();
    $stmt = $db->prepare("SELECT * FROM Pizza_Order WHERE order_id = :order_id");
    $stmt->execute([':order_id' => $order_id]);
    $bestelling = $stmt->fetch(PDO::FETCH_ASSOC);

}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Bestelling status</title>
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <main>
        <h1>Bekijk de status van uw bestelling</h1>
        <form method="POST">
            <label for="order_id">Bestelnummer: </label>
            <p> (Deze heeft u gekregen na het plaatsen van een bestelling.)</p>
            <input type="number" name="order_id" id="order_id" required value="<?php
            if (isset($_POST['order_id'])) {
                echo htmlspecialchars($_POST['order_id']);
            } elseif (isset($_GET['order_id'])) {
                echo htmlspecialchars($_GET['order_id']);
            }
            ?>">
            <input type="submit" value="Bekijk status">
        </form>
        <?php if ($bestelling) { ?>
            <div class="bestelling">
                <p><strong>Bestelnummer:</strong> #<?php echo htmlspecialchars($bestelling['order_id']); ?></p>
                <p><strong>Status:</strong> <?php echo htmlspecialchars(statusText($bestelling['status'])); ?></p>
                <p><strong>Besteld op:</strong> <?php echo htmlspecialchars($bestelling['datetime']); ?></p>
            </div>
        <?php } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') { ?>
            <div class="error-message">Geen bestelling gevonden met dit bestelnummer.</div>
        <?php } ?>
    </main>
    <footer>
        <p>© 2024 Pizzeria Sole Machina. Alle rechten voorbehouden.</p>
    </footer>
</body>

</html>