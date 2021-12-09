<?php
session_start();

if(isset($_SESSION['id_user'])){
    header('location: home.php');
} else { 
    header('location:index.php');
}

if (isset($_SESSION['id'])) {
    session_destroy();
    header('location:index.php');
}


?>