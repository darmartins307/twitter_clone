<?php

session_start();



include_once('DAOdb.php');

$con = new db();

$link = $con->connection();

$id_user = $_SESSION['id_user'];

$query = "SELECT u.*, us.* FROM users AS u LEFT JOIN user_follow AS us ON (us.id_user = '$id_user' AND u.id = us.follow_id_user) WHERE u.id <> '$id_user'";

$dados = mysqli_query($link, $query);

if ($dados) {

    while ($dados_consulta = mysqli_fetch_array($dados, MYSQLI_ASSOC)) {

        $is_follow_user = isset($dados_consulta['follow_id_user']) && !empty($dados_consulta['follow_id_user'] ? 'S' : 'N');

        $follow = 'block';
        $unfollow = 'block';

        if ($is_follow_user == 'N') {
            $follow = 'none';
        } else {
            $unfollow = 'none';
        }


        echo ("<div class='list-group-item' >");
        echo ("  <h4 class='list-group-item-heading'>" . '<img class="rounded-circle" style="border-radius: 30px; height: 40px; width: 40px;" src="./uploads/' . $dados_consulta['pic'] . '">                 '   . $dados_consulta['name'] . " <small> " . $dados_consulta['email'] . "  </small> <button type='button' class='btn btn-default btn_seguir' style=' margin-left: 40px; background-color: rgb(29, 161, 242); color:white;float: right; border-style: none; border-radius: 5px;display:" . $follow . ";' name='btn_seguir' id='btn_seguir_" . $dados_consulta['id'] . "' data-id_usr=" . $dados_consulta['id'] . "> Follow </button> <button type='button' style='margin-left: 40px; background-color: rgb(29, 161, 242);float: right; border-style: none; border-radius: 5px;background-color:#cc0000;display:" . $unfollow . ";' class='btn btn-primary btn_deseguir' id='btn_deseguir_" . $dados_consulta['id'] . "' name='btn_deseguir' data-id_usr=" . $dados_consulta['id'] . ">Unfollow</button> </h4>");
        echo ("</div>");
    }
} else {
    echo ("erro no banco");
}


