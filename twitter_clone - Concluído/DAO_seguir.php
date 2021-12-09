<?php 
session_start();



include_once('DAOdb.php');

$con = new db();

$link = $con->connection();

$id_user = $_SESSION['id_user'];

$id_user_follow = $_POST['id_seguidor'];

echo($id_user_follow);
$query = "INSERT INTO user_follow(id_user, follow_id_user) VALUES ('$id_user', '$id_user_follow')";

$result = mysqli_query($link, $query);

if($result){
    echo("cadastrado");
} else{
    echo("deu ruim");
}

?> 
