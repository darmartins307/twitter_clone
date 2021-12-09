<?php 
session_start();


include_once('DAOdb.php');

$con = new db();

$link = $con->connection();

$id_user = $_SESSION['id_user'];

$id_user_unfollow = $_POST['id_unfollow'];


$query = "DELETE FROM user_follow WHERE id_user = '$id_user' AND follow_id_user = '$id_user_unfollow'";

$result = mysqli_query($link, $query);

if($result){
    echo("cadastrado");
} else{
    echo("deu ruim");
}

?> 