<?php

include 'conn.php';


$sql = "SELECT * FROM components;";
$sth = $bdd->prepare($sql);
$sth->execute();
$sth->execute();
$res = $sth->fetchAll();
echo json_encode($res);

exit;
