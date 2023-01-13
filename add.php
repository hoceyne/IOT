<?php
include 'conn.php';

$_POST['image'] = base64_encode(file_get_contents($_FILES['photo']['tmp_name']));
$_POST['extension'] = pathinfo($_FILES['photo']['tmp_name'],PATHINFO_EXTENSION);

$keys = ['name', 'image', 'purshased_at', 'quantity', 'state', 'extension'];
$sql = "INSERT INTO components ( name, image, purshased_at, quantity, state, extension) VALUES (";
foreach ($keys as $key) {
    # code...
    $sql = $sql . " '" . $_POST[$key] . "' , ";
}
$sql = substr_replace($sql, "", -1);
$sql = substr_replace($sql, "", -1);
$sql = $sql . ") ;";
$stmt = $bdd->prepare($sql);
$stmt->execute();

header("Location: index.php");
