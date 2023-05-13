<?php

require __DIR__ . '/tools.php';

$oldFields = $_SESSION['old'] ?? [];
unset($_SESSION['old']);

$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mon site</title>
    <style>
        .form-error {
            color: #e53e3e;
        }
    </style>
</head>
<body>

<h1>S'inscrire</h1>

<form action="/postRegister.php" method="post">
    <div>
        <label for="email">Adresse mail</label>
        <input type="text" name="email" id="email" value="<?= $oldFields['email'] ?? '' ?>">
        <div class="form-error">
            <?php foreach($errors['email'] ?? [] as $error): ?>
            <p>- <?= $error ?></p>
            <?php endforeach; ?>
        </div>
    </div>
    <div>
        <label for="firstname">Votre prénom</label>
        <input type="text" name="firstname" id="firstname" value="<?= $oldFields['firstname'] ?? '' ?>">
        <div class="form-error">
            <?php foreach($errors['firstname'] ?? [] as $error): ?>
            <p>- <?= $error ?></p>
            <?php endforeach; ?>
        </div>
    </div>
    <div>
        <label for="lastname">Votre nom</label>
        <input type="text" name="lastname" id="lastname" value="<?= $oldFields['lastname'] ?? '' ?>">
        <div class="form-error">
            <?php foreach($errors['lastname'] ?? [] as $error): ?>
            <p>- <?= $error ?></p>
            <?php endforeach; ?>
        </div>
    </div>
    <div>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">
        <div class="form-error">
            <?php foreach($errors['password'] ?? [] as $error): ?>
            <p>- <?= $error ?></p>
            <?php endforeach; ?>
        </div>
    </div>
    <button type="submit">S'inscrire</button>
</form>

</body>
</html>
