<?php

$host = 'localhost';
$bdd_name = 'IOT';
$login = 'admin';
$mdp = 'Admin+2001';

try {
    $bdd = new PDO('mysql:host=' . $host . ';dbname=' . $bdd_name . ';charset=utf8', $login, $mdp);
    
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
