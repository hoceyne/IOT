<?php

$host = 'containers-us-west-126.railway.app:7695';
$bdd_name = 'railway';
$login = 'root';
$mdp = '2rvhj1QXzVPd2mkYHqj7';

try {
    $bdd = new PDO('mysql:host=' . $host . ';dbname=' . $bdd_name . ';charset=utf8', $login, $mdp);
    
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
