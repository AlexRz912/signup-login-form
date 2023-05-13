<?php

// It's better to use absolute paths to include files
require __DIR__ . '/tools.php';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mon site</title>
</head>
<body>

<h1>Bienvenue sur "Mon site"</h1>

<?php if (isset($_SESSION['user'])): ?>
    <p>Bonjour <?= $_SESSION['user']['name'] ?></p>
    <!-- Logout need to do after -->
    <a href="">Déconnexion</a>
<?php else: ?>
    <a href="/login.php">Connexion</a>
    <a href="/register.php">Inscription</a>
<?php endif; ?>

</body>
</html>
