<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="response-form.php" method="post"> <!-- Formulaire d'inscription: prénom, nom, adresse, mot de passe' -->
    <label for="name"> Prénom</label>
    <input type="text" id="name" name="name">
    <label for="lastname"> Nom de famille</label>
    <input type="text" id="lastname" name="lastname">
    <label for="email">email</label>
    <input type="email" id="email" name="email">
    <label for="password">password</label>
    <input type="password" id="password" name="password">
    <button type="submit">Envoyer</button>
</form>


</body>
</html>