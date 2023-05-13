<?php

require __DIR__ . '/tools.php';

$errors = [];

$firstName = $_POST['firstname'] ?? '';
$lastName = $_POST['lastname'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($email)) {
    $errors['email'][] = "L'email est obligatoire";
}
if (empty($errors['email'])) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'][] = "L'email n'est pas valide";
    }

    $reqUser = $db->prepare('select id from users where email = :email');
    $reqUser->execute(['email' => $email]);
    $user = $reqUser->fetch();
    if ($user) {
        $errors['email'][] = "L'email est déjà utilisé";
    }
}

if (empty($password)) {
    $errors['password'][] = "Le mot de passe est obligatoire";
}
if (empty($errors['password']) && mb_strlen($password) < 12) {
    $errors['password'][] = "Le mot de passe doit faire au moins 12 caractères";
}

if (empty($firstName)) {
    $errors['firstname'][] = "Le prénom est obligatoire";
}
if (empty($errors['firstname']) && mb_strlen($firstName) < 2) {
    $errors['firstname'][] = "Le prénom doit faire au moins 2 caractères";
}

if (empty($lastName)) {
    $errors['lastname'][] = "Le nom est obligatoire";
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = [
        'firstname' => $firstName,
        'lastname' => $lastName,
        'email' => $email,
    ];
    redirectTo('/register.php');
}

$reqInsertUser = $db->prepare('insert into users (name, last_name, email, password)
    values (:firstname, :lastname, :email, :password)');
$reqInsertUser->execute([
    'firstname' => $firstName,
    'lastname' => $lastName,
    'email' => $email,
    'password' => password_hash($password, PASSWORD_BCRYPT), // Hash the password before storing it
]);

redirectTo('/login.php');
