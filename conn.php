<?php

$host = 'containers-us-west-126.railway.app:7695';
$bdd_name = 'railway';
$login = 'root';
$mdp = '2rvhj1QXzVPd2mkYHqj7';

try {
    $bdd = new PDO('mysql:host=' . $host . ';dbname=' . $bdd_name . ';charset=utf8', $login, $mdp);
    $sql = "CREATE TABLE 'components' (
            'id' int NOT NULL AUTO_INCREMENT,
            'name' varchar(45) DEFAULT NULL,
            'image' mediumblob,
            'purshased_at' date DEFAULT NULL,
            'quantity' int DEFAULT NULL,
            'state' varchar(45) DEFAULT NULL,
            'extension' varchar(45) DEFAULT NULL,
            PRIMARY KEY ('id')
          ) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
          ";
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
