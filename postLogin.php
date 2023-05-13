<?php

require __DIR__ . '/tools.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    $_SESSION['errors'][] = "L'email et le mot de passe sont obligatoires";
}

$reqUser = $db->prepare('select id, name, last_name, email, password from users where email = :email');
$reqUser->execute(['email' => $email]);
$user = $reqUser->fetch();

if ($user === false || !password_verify($password, $user['password'])) {
    $_SESSION['errors'][] = "L'email ou le mot de passe est incorrect";
}

if (!empty($_SESSION['errors'])) {
    $_SESSION['errors'] = $errors;
    redirectTo('/login.php');
}

$_SESSION['user'] = [
    'id' => $user['id'],
    'name' => $user['name'],
    'last_name' => $user['last_name'],
    'email' => $user['email'],
];
redirectTo('/index.php');
