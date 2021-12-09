<?php
session_start();

//Controle de acesso direto ao arquivo
//Incluindo o arquivo de conexão com banco de dados.
include_once('DAOdb.php');

//Pegando os dados via reponse AJAX
$tweet = isset($_POST['txt_tweet']) ? $_POST['txt_tweet'] : '';
//pegando ID via session
$id_user = $_SESSION['id_user'];

//Instanciando a classe de conexão
$con = new db();

//iniciando conexão com função connection
$link = $con->connection();


//Criando a Query insert
$query = "SELECT DATE_FORMAT(t.date, '%d %b %Y %T') AS date, t.id_usuario, t.tweet, u.name, u.pic FROM tweet AS t JOIN users AS u ON (t.id_usuario = u.id) WHERE id_usuario = '$id_user' OR id_usuario IN (SELECT follow_id_user FROM user_follow WHERE id_user = '$id_user') ORDER BY date DESC";

$result_id = mysqli_query($link, $query);


//Pegar registros gerados até o final
if ($result_id) {

    while ($dado_user = mysqli_fetch_assoc($result_id)) {



        echo ("<a href='' class='list-group-item' >");
        echo ("  <h4 class='list-group-item-heading'>" . '<img class="rounded-circle" style="border-radius: 30px; height: 40px; width: 40px;" src="./uploads/' . $dado_user['pic'] . '">                 '   . $dado_user['name'] . " <small> " . $dado_user['date'] . "  </small> </h4>");
        echo ("<p class='list-group-item-text' style='margin-left: 40px;' >" . $dado_user['tweet'] . "</p>");
        echo ("<span class:'glyphicon glyphicon-heart' ></span>");
        echo ("</a>");
    }
} else {
    echo ("deu ruim");
}
