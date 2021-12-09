<?php
session_start();

require_once('DAOdb.php');

$user = $_POST['name'];
$email = $_POST['email'];
$password = hash('sha256', $_POST['password']);
$imagem = 'user.png';


$objDb = new db();
$link = $objDb->connection();

$query2 = "SELECT name FROM users WHERE name='$user'";

$query1 = "SELECT email FROM users WHERE email='$email'";

$user_found = '';
$email_found = '';


if ($user_id1 = mysqli_query($link, $query1)) {
    $dados_user1 = mysqli_fetch_array($user_id1);
    if (isset($dados_user1['email'])) {
        $email_found = true;
    }
}



if ($user_id = mysqli_query($link, $query2)) {
    $dados_user = mysqli_fetch_array($user_id);

    if (isset($dados_user['name'])) {
        $user_found = true;
    }
}


if ($email_found || $user_found) {
    $retorno_get = '';

    if ($email_found) {
        $retorno_get .= "emailerror=1&";
    }

    if ($user_found) {
        $retorno_get .= "usererror=1$";
    }

    header('location: inscrevase.php?' . $retorno_get);
    die();
} else {
    $query = "INSERT INTO users(name,email,password, pic) VALUES ('$user', '$email', '$password','$imagem')";

    mysqli_query($link, $query);

    header('location:index.php');
}

die();
