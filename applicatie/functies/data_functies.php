<?php
function getUserInfo($username)
{
    $conn = maakVerbinding();
    $stmt = $conn->prepare("SELECT * FROM [User] WHERE username = :username");
    $stmt->execute([':username' => $username]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

?>