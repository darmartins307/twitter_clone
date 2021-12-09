<?php
session_start();


require_once('DAOdb.php');

$objDB = new db();

$link = $objDB->connection();

$user = $_POST['usuario'];
$password = hash('sha256', $_POST['senha']);

$query = "SELECT * FROM users WHERE name = '$user' AND password = '$password'";

$user_id = mysqli_query($link, $query);

if ($user_id) {
    $array_fetch = mysqli_fetch_array($user_id);

    if (isset($array_fetch['name'])) {
        $_SESSION['name'] = $array_fetch['name'];
        $_SESSION['id_user'] = $array_fetch['id'];
        $_SESSION['id'] = session_create_id();
        header('location: home.php');
    } else {
        header('location: index.php?error=1');
    }
} else {
    echo ("erro ao executar, entre em contato com o admin do site");
}
