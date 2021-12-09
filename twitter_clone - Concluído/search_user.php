<?php session_start();

?>
<!DOCTYPE HTML>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">

    <title>Twitter clone</title>
    <!-- jquery - link cdn -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

    <!-- bootstrap - link cdn -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <script type="text/javascript">
        $(document).ready(function() {

            $('#btn_search').click(function() {


                if ($('#txt_search').val().length > 0) {

                    $.ajax({
                        url: 'DAOsearch_user.php',
                        method: 'POST',
                        data: $('#form_search').serialize(),
                        success: function(data) {
                         $('#users').html(data);
                         $('.btn_seguir').click(function(){
                        var id = $(this).data('id_usr');
                        
                        $('#btn_seguir_'+id).hide();
                        $('#btn_deseguir_'+id).show();

                    $.ajax({
                        url: 'DAO_seguir.php',
                        method: 'post',
                        data: {id_seguidor : id},
                        success: function(data){
                        }
                    });
                    });
                    $('.btn_deseguir').click(function(){
                           var id = $(this).data('id_usr');
                           $('#btn_seguir_'+id).show();
                           $('#btn_deseguir_'+id).hide();
                           $.ajax({
                            url: 'DAO_unfollow.php',
                            method: 'post',
                            data: {id_unfollow : id},
                            success: function(data){
                            }
                           });
                    });
                    }
                });
            };
        });

        function atualizar() {
                $.ajax({
                    url: 'DAOlist_user.php',
                    success: function(data) {
                        $('#users').html(data);
                        $('.btn_seguir').click(function(){
                        var id = $(this).data('id_usr');
                        
                        $('#btn_seguir_'+id).hide();
                        $('#btn_deseguir_'+id).show();

                    $.ajax({
                        url: 'DAO_seguir.php',
                        method: 'post',
                        data: {id_seguidor : id},
                        success: function(data){
                        }
                    });
                    });
                    $('.btn_deseguir').click(function(){
                           var id = $(this).data('id_usr');
                           $('#btn_seguir_'+id).show();
                           $('#btn_deseguir_'+id).hide();
                           $.ajax({
                            url: 'DAO_unfollow.php',
                            method: 'post',
                            data: {id_unfollow : id},
                            success: function(data){
                            }
                           });
                    });
                    }
                });
            }
        atualizar();
    });
    </script>
</head>

<body>
    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <img src="imagens/icone_twitter.png" />
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li> <a href="Sair.php">Sair</a></li>
                    <li> <a href="home.php">Home</a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>


    <div class="container">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php

                    include_once('DAOdb.php');

                    $con = new db();
                    $link = $con->connection();
                    $id_user = $_SESSION['id_user'];
                    $query = "SELECT pic,name FROM users WHERE id = '$id_user'";
                    $result = mysqli_query($link, $query);
                    if ($result) {
                        while ($dado_user = mysqli_fetch_array($result)) {
                            echo ("  <h4 class='list-group-item-heading'>" . '<img class="rounded-circle" style="border-radius: 30px; height: 40px; width: 40px;" src="./uploads/' . $dado_user['pic'] . '">                                 '   . $dado_user['name'] . " <small>  </small> </h4>");
                            break;
                        };
                    }
					
					include_once('DAOdb.php');

					$con = new db();

					$link = $con->connection();

				 $id_user = $_SESSION['id_user'];

					$query = "SELECT COUNT(*) AS your_tweets FROM tweet WHERE id_usuario = '$id_user'";

					$result = mysqli_query($link, $query);

					$dados = mysqli_fetch_array($result, MYSQLI_ASSOC);

					$query1 = "SELECT COUNT(*) AS follow_amount FROM user_follow WHERE id_user = '$id_user'";

					$result1 = mysqli_query($link, $query1);


					$dados1 = mysqli_fetch_array($result1);

					$follow = $dados1['follow_amount'];

					$query2 = "SELECT COUNT(*) AS follower_amount FROM user_follow WHERE follow_id_user = '$id_user'";

					$result2 = mysqli_query($link, $query2);

					$dados2 = mysqli_fetch_array($result2);

					$follower = $dados2['follower_amount'];
					
                   

					?> 
                    <hr />
                    <div class="col-md-3"> <strong>Seguindo</strong> <br/> <?php echo($dados['your_tweets']); ?> </div>
                    <div class="col-md-3"> <strong>Seguindo</strong> <br/> <?php echo($follow); ?> </div>
					<div class="col-md-3"> <strong>Seguidores</strong> <br/> <?php echo($follower); ?> </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form id="form_search" name="form_txt" class="input-group">
                        <input class="form-control" type="text" name="txt_search" id="txt_search" placeholder="Quem deseja procurar?" maxlength="150">
                        <span class="input-group-btn">
                            <button class="btn btn-default" id="btn_search" type="button"> Pesquisar </button>
                        </span>
                    </form>
                </div>
            </div>
            <div id="users" class="list-group"> </div>
        </div>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
<style>
    .tw-heart-box {
        position: relative;
        width: 100px;
        height: 100px;
        display: inline-block;
    }

    .tw-heart {
        background: url(http://i.imgur.com/zw8ahUb.png) no-repeat 0 0;
        display: inline-block;
        width: inherit;
        height: inherit;
        position: absolute;
        left: 0;
        top: 0;
    }

    [type="checkbox"]:checked+.tw-heart {
        transition: background .8s steps(28);
        background-position: -2800px 0;
    }

    [type="checkbox"] {
        opacity: 0;
        cursor: pointer;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }
</style>'


</html>