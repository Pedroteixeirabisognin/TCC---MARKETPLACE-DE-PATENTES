<?php


session_start();
	//IF TERNARIO (SE CONDIÇÃO VERDADEIRA EXECUTE A ESQUERDA DOS ":" SE FOR FALSA EXECUTE A DIREITA)
$erro = isset($_GET['erro'])? $_GET['erro']:0;
	//SE O USUÁRIO JÁ ESTIVER LOGADO VAI RETORNAR PARA HOME.PHP
if(isset($_SESSION['usuario'])){

	header('Location: home.php');

}

?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">

	<title>Invector</title>

	<!-- jquery - link cdn -->
	<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

	<!-- bootstrap - link cdn -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	
	<script>
			//Verifica se meu documento já está pronto
			$(document).ready( function(){

				$('#btn_login').click( function(){


					var campo_vazio = false;
					//VERIFICA SE OS CAMPOS ESTÃO VAZIOS
					if($('#campo_usuario').val() == ''){
						//MUDA O ATRIBUTO CSS FAZENDO QUE A BORDA FIQUE VERMELHA
						$('#campo_usuario').css({'border-color': '#A94442'}); 
						campo_vazio = true;
					}else{
						//MUDA O ATRIBUTO CSS FAZENDO QUE A BORDA FIQUE CINZA
						$('#campo_usuario').css({'border-color': '#CCC'}); 						

					}


					if($('#campo_senha').val() == ''){

						$('#campo_senha').css({'border-color': '#A94442'}); 
						campo_vazio = true;

					}else{

						$('#campo_senha').css({'border-color': '#CCC'}); 						

					}

					if(campo_vazio) return false;
				})

			});						
		</script>
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
					<img src="imagens/icone_invector.png" style="width: 50px; height: 50px;" />
				</div>

				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="inscrevase.php">Inscrever-se</a></li>
						<!--IF TERNARIO PARA MUDAR A CLASSE CASO TENHA UM ERRO-->
						<li class="<?= $erro == 1 ? 'open' : '' ?>">
							<a id="entrar" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Entrar</a>
							<ul class="dropdown-menu" aria-labelledby="entrar">
								<div class="col-md-12">
									<p>Você possui uma conta?</h3>
										<br />
										<form method="post" action="php/validar_acesso.php" id="formLogin">
											<div class="form-group">
												<input type="text" class="form-control" id="campo_usuario" name="usuario" placeholder="Usuário" />
											</div>

											<div class="form-group">
												<input type="password" class="form-control red" id="campo_senha" name="senha" placeholder="Senha" />
											</div>

											<button type="buttom" class="btn btn-primary" id="btn_login">Entrar</button>

											<br /><br />

										</form>
										<?php
										//VERIFICA SE SESSION RETORNOU UM ERRO
										if ($erro == 1) {
											echo ' <font color="#FF0000">Usuario e/ou senha inválido(s)</font>';
										}



										?>
									</form>
								</ul>
							</li>
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</nav>


			<div class="container">

				<!-- Main component for a primary marketing message or call to action -->
				<div class="jumbotron">
					<h1>Bem vindo ao Invector</h1>
					<p>Venda suas ideias!</p>
				</div>

				<div class="clearfix"></div>
			</div>


		</div>
	<hr>
	<div class="container" >
		<div class="row" >
				<div class="col-md-6" align="left" style="padding-bottom: 10px;">
			

					<a href="#"><img src="imagens/facebook.ico" width="100px" height="100px" ></a>facebook/invector


					<a href="#"><img src="imagens/twitter.png" width="100px" height="100px"></a>@Invector

			</div>
			<div class="col-md-6">

				<ul>
					<h3>Links úteis</h3>
					<li><a href="http://www.inpi.gov.br/">INPI</a></li>
					<li><a href="#">Trabalhe conosco</a></li>
					<li><a href="#">Parceiros</a></li>
				</ul>



			</div>
		</div>


	</div>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

	</body>
	</html>