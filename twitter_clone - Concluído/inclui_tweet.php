<?php
session_start();

//Controle de acesso direto ao arquivo


//Incluindo o arquivo de conexão com banco de dados.
include_once('DAOdb.php');

//Pegando os dados via reponse AJAX
$tweet = $_POST['txt_tweet'];
//pegando ID via session
$id_user = $_SESSION['id_user'];

//Instanciando a classe de conexão
$con = new db();

//iniciando conexão com função connection
$link = $con->connection();

//Testando se os form's vieram vazios
if ($tweet != '' && $id_user != '') {

    //Criando a Query insert
    $query = "INSERT INTO tweet(id_usuario, tweet) VALUES ('$id_user', '$tweet')";

    //executando Query
    if (mysqli_query($link, $query)) {
        echo ("Cadastrado");
    } else {
        echo ("não cadastrado");
    }
}



