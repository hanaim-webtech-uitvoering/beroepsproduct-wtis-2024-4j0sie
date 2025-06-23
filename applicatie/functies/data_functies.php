<?php
function getUserInfo($username)
{
    $db = maakVerbinding();
    $stmt = $db->prepare("SELECT * FROM [User] WHERE username = :username");
    $stmt->execute([':username' => $username]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>