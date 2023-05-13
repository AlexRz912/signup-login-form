<?php
try {
// On se connecte à MySQL
$mysqlClient = new PDO
('mysql:host=localhost;dbname=mydatabase;charset=utf8',
    'root',
    'root',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],); //Message de gestion de l'erreur
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}

// Si tout va bien, on peut continuer
if (
    isset($_POST['email'])
    // && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
    && !empty($_POST['password'])
) {
    $sqlQuery = "SELECT * FROM users WHERE email = :email";
    $userStatement = $mysqlClient->prepare($sqlQuery);
    $userStatement->execute(['email' => $_POST['email']]);
    $user = $userStatement->fetch();
    if ($user && $user['password'] === /*password_verify(*/
        $_POST['password']/*, $user['pass'])*/) {
        echo "Bienvenue sur le site";
    } else {
        echo "Veuillez indiquer une adresse mail et un mot de passe valide";
    }
}
