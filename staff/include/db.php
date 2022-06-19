<!-- Base de données -->
<?php 
    $serveur = 'nom du serveur';
    $login = 'login';
    $mot_de_passe = 'mot de passe';
    $base_de_donnees = 'nom de la base de données';
    $pdo = new PDO('mysql:host='.$serveur.';dbname='.$base_de_donnees.';charset=utf8;', $login, $mot_de_passe);

?>