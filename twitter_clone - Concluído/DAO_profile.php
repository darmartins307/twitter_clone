<?php 
session_start();


include_once('DAOdb.php');

$con = new db();

$id_user = $_SESSION['id_user']; 

$link = $con ->connection();

$query = "SELECT name, pic FROM users WHERE id = '$id_user'";

$result = mysqli_query($link, $query);

if($result){
    while($dado_user = mysqli_fetch_array($result)){
        echo ("  <h4 class='list-group-item-heading'>" . '<img class="rounded-circle" style="border-radius: 30px; height: 40px; width: 40px;" src="./uploads/' . $dado_user['pic'] . '">                 '   . $dado_user['name'] . " <small>  </small> </h4>");
        break;
    };
} else {
    echo("Algo está errado");
}




?>
