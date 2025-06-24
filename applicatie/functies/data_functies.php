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



?>