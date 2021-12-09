<?php session_start();

$error_user = isset($_GET['usererror']) ? $_GET['usererror'] : '';
$error_email = isset($_GET['emailerror']) ? $_GET['emailerror'] : '';

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

</head>

<body>
	<!-- Static navbar -->
	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<img src="imagens/icone_twitter.png" />
			</div>

			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="index.php">Voltar para Home</a></li>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</nav>
	<div class="container">

		<br /><br />

		<div class="col-md-4"></div>
		<div class="col-md-4">
			<h3>Inscreva-se já.</h3>
			<br />
			<form method="post" action="DAOregistra.php" id="formCadastrarse">
				<div class="form-group">
					<input type="text" class="form-control" id="usuario" name="name" value="<?php isset($_SESSION['user']) ? $_SESSION['user'] : ''; ?>" placeholder="Usuário" required="requiored">
				</div>

				<div class="form-group">
					<input type="email" class="form-control" id="email" name="email" placeholder="Email" required="requiored">
				</div>

				<div class="form-group">
					<input type="password" class="form-control" id="senha" name="password" placeholder="Senha" required="requiored">
				</div>

				<button type="submit" class="btn btn-primary form-control">Inscreva-se</button>

				<?php

				if (($error_email) == 1 && ($error_user) == 1) {
					echo ("<p style='color: red;  margin-left: 23%; '> Usuário e senha ja cadastrados</p>");
				} elseif (isset($error_email)) {
					echo ("<p style='color: red; margin-left: 33%;' >Email ja cadastrado</p>");
				} elseif (isset($error_user)) {
					echo ("<p style='color: red; margin-left: 31%; ' >Usuário ja cadastrado</p>");
				}

				?>

			</form>
		</div>
		<div class="col-md-4"></div>

		<div class="clearfix"></div>
		<br />
		<div class="col-md-4"></div>
		<div class="col-md-4"></div>
		<div class="col-md-4"></div>

	</div>


	</div>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>

</html>