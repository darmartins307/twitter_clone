<?php session_start();
if (!isset($_SESSION['id'])) {
	header('location:index.php?error=1');
} elseif (isset($_SESSION['id'])) {
	$_SESSION['id'] = session_regenerate_id();
}

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
			$('#btn_tweet').click(function() {

				//Funcão ajax que envia os tweet para o arquivo inclui.tweet.php
				if ($('#txt_tweet').val().length > 0) {
					$.ajax({
						url: 'inclui_tweet.php',
						method: 'POST',
						data: $('#form_tweet').serialize(),
						success: function(data) {
							atualiza_perfil();
							$('#txt_tweet').val('');
							atualiza_timeline();
						}
					});
				}

			});
			// Carregar tweet na timeline
			function atualiza_timeline() {
				$.ajax({
					url: 'time_line.php',
					success: function(data) {
						$('#tweets').html(data);
					}
				});
			}

			function atualiza_perfil() {
				$.ajax({
					url: 'DAO_profile.php',
					success: function(data) {
						$('#panel').html(data);
					}
				});
			}
			atualiza_timeline();
			atualiza_perfil();
		});
	</script>
</head>

<body>
	<!-- Static navbar -->
	<nav class="navbar navbar-default navbar-static-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<img src="imagens/icone_twitter.png" />
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li> <a href="Sair.php">Sair</a></li>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</nav>


	<div class="container-fluid">
		<div class="row">



			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<div id="panel" 2 class="list-group"> </div>
						<form method="post" enctype="multipart/form-data" action="DAOuser.php">
							<label id="label" class="custom-file-upload">
								<input name="pic" type="file">
								<input type="submit" value="Alterar -> ">foto
							</label>
							<style>
								input[type="file"] {
									display: none;
								}

								input[type="submit"] {
									background-color: white;
									border-style: none;
								}

								input[type="submit"]:hover {
									color: rgb(29, 161, 242);
									transition-duration: 0.2s;

								}

								#label:hover {
									color: rgb(29, 161, 242);
									transition-duration: 0.2s;
								}
							</style>
							<hr>
						</form>

						<?php

						include_once('DAOdb.php');

						$con = new db();

						$link = $con->connection();

						$id_user = $_SESSION['id_user'];

						$query = "SELECT COUNT(*) AS your_tweets FROM tweet WHERE id_usuario = '$id_user'";

						$result = mysqli_query($link, $query);

						$dados = mysqli_fetch_array($result, MYSQLI_ASSOC);
						echo ("<div class='col-md-3'><strong> Tweets </strong> <br/> " . $dados['your_tweets'] . " </div>");

						$query1 = "SELECT COUNT(*) AS follow_amount FROM user_follow WHERE id_user = '$id_user'";

						$result1 = mysqli_query($link, $query1);


						$dados1 = mysqli_fetch_array($result1);

						$follow = $dados1['follow_amount'];

						$query2 = "SELECT COUNT(*) AS follower_amount FROM user_follow WHERE follow_id_user = '$id_user'";

						$result2 = mysqli_query($link, $query2);

						$dados2 = mysqli_fetch_array($result2);

						$follower = $dados2['follower_amount'];



						?>
						<div class="col-md-3"> <strong>Seguindo</strong> <br /> <?php echo ($follow); ?> </div>
						<div class="col-md-3"> <strong>Seguidores</strong> <br /> <?php echo ($follower); ?> </div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-body">
						<span style="font-size: 18px;"><strong>Home</strong></span>
						<form id="form_tweet" name="form_txt" class="input-group">
							<input class="form-control" type="text" style="border-style: none; margin-top: 20px" name="txt_tweet" id="txt_tweet" placeholder="O que está acontecendo agora?" maxlength="150">
							<span class="input-group-btn">
								<button type="button" id="btn_tweet" style="margin-top: 100px; background-color: rgb(29, 161, 242);border-color: rgb(29, 161, 242) ; border-radius: 8px;" class="btn btn-primary"> <strong>Tweet </strong> </button>
							</span>
						</form>
					</div>
				</div>
				<div id="tweets" class="list-group"> </div>
			</div>
			<div class="col-md-2">
				<div class="panel panel-default">
					<div class="panel-body">
						<h5> <a href="search_user.php"> Procurar pessoas. </a> </h5>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>


<img alt="">

</html>