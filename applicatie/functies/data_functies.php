<?php
require_once 'functies/db_connectie.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
function getUserInfo($username)
{
    $db = maakVerbinding();
    $stmt = $db->prepare("SELECT * FROM [User] WHERE username = :username");
    $stmt->execute([':username' => $username]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getMenu()
{

    $db = maakVerbinding();

    $stmt = $db->prepare("SELECT 
                P.name AS product_name,
                P.price,
                PT.name AS type_name,
                I.name AS ingredient_name
            FROM Product AS P
            JOIN ProductType AS PT ON P.type_id = PT.name
            LEFT JOIN Product_Ingredient AS PI ON p.name = PI.product_name
            LEFT JOIN Ingredient AS I ON PI.ingredient_name = I.name
            ORDER BY PT.name, P.name");

    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $menu = [];

    foreach ($results as $row) {
        $name = $row['product_name'];
        $price = $row['price'];
        $type = $row['type_name'];
        $ingredient = $row['ingredient_name'];

        if (!isset($menu[$type])) {
            $menu[$type] = [];
        }

        if (!isset($menu[$type][$name])) {
            $menu[$type][$name] = [
                'price' => $price,
                'ingredients' => []
            ];
        }

        if ($ingredient) {
            $menu[$type][$name]['ingredients'][] = $ingredient;
        }
    }
    return $menu;
}

function addToCart($product)
{
    if (!isset($_SESSION['winkelwagen'])) {
        $_SESSION['winkelwagen'] = [];
    }
    if (!isset($_SESSION['winkelwagen'][$product])) {
        $_SESSION['winkelwagen'][$product] = 1;
    } else {
        $_SESSION['winkelwagen'][$product]++;
    }
}

function removeFromCart($product)
{
    if (isset($_SESSION['winkelwagen'][$product])) {
        $_SESSION['winkelwagen'][$product]--;
        if ($_SESSION['winkelwagen'][$product] <= 0) {
            unset($_SESSION['winkelwagen'][$product]);
        }
    }
}

function getTotalPrice($menu)
{
    $totaal = 0;
    foreach ($_SESSION['winkelwagen'] as $productNaam => $aantal) {
        foreach ($menu as $categorie => $producten) {
            if (isset($producten[$productNaam])) {
                $prijs = $producten[$productNaam]['price'];
                $totaal += $prijs * $aantal;

            }
        }
    }
    return $totaal;
}

function processOrder($adres, $postcode, $stad)
{
    $winkelwagen = $_SESSION['winkelwagen'] ?? [];
    $username = null;
    $naam = 'Gast';

    if (isset($_SESSION['user'])) {
        $username = $_SESSION['user']['username'];
        $voornaam = $_SESSION['user']['voornaam'];
        $achternaam = $_SESSION['user']['achternaam'];
        $naam = trim($voornaam . ' ' . $achternaam);
    }

    $db = maakVerbinding();
    $stmt = $db->query("SELECT username FROM [User] WHERE role = 'Personnel' ORDER BY NEWID()");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $medewerker = $row ? $row['username'] : null;

    $stmt = $db->prepare("
        INSERT INTO Pizza_Order 
        (client_username, client_name, personnel_username, datetime, status, address, postcode, city)
        VALUES 
        (:client_username, :client_name, :personnel_username, GETDATE(), 1, :address, :postcode, :city)
    ");

    $stmt->execute([
        ':client_username' => $username,
        ':client_name' => $naam,
        ':personnel_username' => $medewerker,
        ':address' => $adres,
        ':postcode' => $postcode,
        ':city' => $stad
    ]);

    $order_id = $db->lastInsertId();

    $stmt = $db->prepare("
        INSERT INTO Pizza_Order_Product (order_id, product_name, quantity)
        VALUES (:order_id, :product_name, :quantity)
    ");

    foreach ($winkelwagen as $productNaam => $aantal) {
        $stmt->execute([
            ':order_id' => $order_id,
            ':product_name' => $productNaam,
            ':quantity' => $aantal
        ]);
    }

    unset($_SESSION['winkelwagen']);
    return $order_id;
}

function getUserOrders($username)
{
    if (!$username) {
        return [];
    }
    $db = maakVerbinding();
    $stmt = $db->prepare("SELECT * FROM Pizza_Order WHERE client_username = :username ORDER BY datetime DESC");
    $stmt->execute([':username' => $username]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getOrderById($order_id)
{
    $db = maakVerbinding();
    $stmt = $db->prepare("SELECT * FROM Pizza_Order WHERE order_id = :order_id");
    $stmt->execute([':order_id' => $order_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getOrderProducts($order_id)
{
    $db = maakVerbinding();
    $stmt = $db->prepare("SELECT * FROM Pizza_Order_Product WHERE order_id = :order_id");
    $stmt->execute([':order_id' => $order_id]);
    $producten = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($producten as &$product) {
        $stmt2 = $db->prepare(
            "SELECT I.name 
             FROM Product_Ingredient PI
             JOIN Ingredient I ON PI.ingredient_name = I.name
             WHERE PI.product_name = :product_name"
        );
        $stmt2->execute([':product_name' => $product['product_name']]);
        $product['ingredienten'] = $stmt2->fetchAll(PDO::FETCH_COLUMN);
    }
    return $producten;
}
function getAllOrders()
{
    $db = maakVerbinding();
    $stmt = $db->query("SELECT * FROM Pizza_Order ORDER BY datetime DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function statusText($status)
{
    if ($status == 1) {
        return 'In behandeling';
    } elseif ($status == 2) {
        return 'In bezorging';
    } elseif ($status == 3) {
        return 'Afgerond';
    } else {
        return 'Onbekend';
    }
}
?>