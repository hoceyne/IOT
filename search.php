<?php

include 'conn.php';


$sql = "SELECT * FROM components WHERE state LIKE '%" . $_GET['state'] . "%' AND name LIKE '%" . $_GET['q'] . "%'";
if($_GET['date']!=""){
    $sql =$sql. "ORDER BY purshased_at " . $_GET['date'] . ";";
}else{
    $sql =$sql. ";";
}
$sth = $bdd->prepare($sql);
$sth->execute();
$sth->execute();
$res = $sth->fetchAll();
echo json_encode($res);
exit;
