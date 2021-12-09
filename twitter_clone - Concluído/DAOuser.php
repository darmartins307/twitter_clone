<?php
session_start();



include_once('DAOdb.php');


$connection = new db();

$id_user = $_SESSION['id_user'];

$link = $connection->connection();

if (isset($_FILES['pic'])) {
    $imagem = $_FILES['pic'];
    $extension = strtolower(substr($FILES['pic']['name'], -4));

    $new_name = time() . $extension;

    $directory = "uploads/";

    move_uploaded_file($_FILES['pic']['tmp_name'], $directory . $new_name);

    $query = "UPDATE users SET pic = '$new_name' WHERE id = '$id_user'";
    $result = mysqli_query($link, $query);
    header('location: home.php');

    if ($result) {
        echo("erro");
    }
} else {
    echo(header('location: home.php'));
}
