<?php
include 'conn.php';

$sql = "DELETE FROM components WHERE id=" . $_GET["id"] . ";";
$stmt = $bdd->prepare($sql);
$stmt->execute();

header("Location: index.php");
