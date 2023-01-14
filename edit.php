<?php
include 'conn.php';


$keys = [ 'name', 'image', 'purshased_at', 'quantity', 'state', 'extension'];
$sql = "UPDATE components SET ";
foreach ($keys as $key) {
    # code...
    $sql = $sql . $key . "='" . $_POST[$key] . "' , ";
}
$sql = substr_replace($sql, "", -1);
$sql = substr_replace($sql, "", -1);
$sql = $sql . "WHERE id = '" . $_POST["id"] . "';";
$stmt = $bdd->prepare($sql);
$stmt->execute();



header("Location: index.php");

