<?php
try
{
	// On se connecte à MySQL
	$mysqlClient = new PDO('mysql:host=localhost;dbname=mydatabase;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
} ?>

<?php  /*
setcookie() {

    'LOGGED_USER',
    $loggedIn, 
    [
        'expires' => time() + 365*24*3600,
        'secure' => true,
        'httponly' => true,
    ]
}  */ ?>



    <?php

$missingFields = [];

switch(true) {
    case empty($_POST['name']):
        $missingFields[] = 'prénom'; #Si le champ prénom n'est pas indiqué alors 'prénom' est stocké dans missingFields
        break;
    case empty($_POST['lastname']):
        $missingFields[] = 'nom'; #Si le champ nom n'est pas indiqué, alors 'nom' est stocké dans missingFields
        break;
    case empty($_POST['email']):
        $missingFields[] = 'email'; #Si le champ email n'est pas indiqué, alors 'email' est stocké dans missingFields
        break;
    case empty($_POST['password']):
        $missingFields[] = 'mot de passe'; #Si le champ mdp n'est pas indiqué, alors 'mot de passe' est stocké dans missingFields
        break;
}

if(!empty($missingFields)) {
    $errorMessage = "Veuillez indiquer votre ";
    if(count($missingFields) > 1) { #Si il y a plus d'un champ manquant alors
        $errorMessage .= implode(', ', $missingFields) . "."; #alors on rajoute au message la concaténation de tout les champs manquant séparés par une virgule et un espace, et terminer la phrase par un point
    } else { #Sinon 
        $errorMessage .= $missingFields[0] . "."; 
    }
    echo $errorMessage;
    include_once('signup-form.php');
} else {
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $sqlQuery = 'INSERT INTO users(name, last_name, email, password) VALUES (:name, :last_name, :email, :password)';

        $newUserUpload = $mysqlClient->prepare($sqlQuery);
        $newUserUpload->execute(['name' => $_POST['name'],
        'last_name' => $_POST['lastname'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
    ]);

    echo "Votre compte à bien été crée !";
    include_once('login-form.php');

    } else {
        echo 'Veuillez indiquer une addresse mail valide.';
        include_once('signup-form.php');
    }

    
}

?>
        

