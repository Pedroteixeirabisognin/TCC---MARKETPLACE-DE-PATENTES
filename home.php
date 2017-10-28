<?php

	session_start();

	//SE O USUÁRIO NÃO PASSAR PELA AUTENTIFICAÇAO RETORNARÁ AO INDEX.PHP
	if(!isset($_SESSION['usuario'])){

		header('Location: index.php?erro=1');

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
	
		<script type="text/javascript">
			
			$(document).ready(function(){

				//ASSOCIAR O EVENTO DE CLICK AO BOTÃO
				$('#btn_pesquisa').click( function(){



					if ($('#text_pesquisa').val().length > 0){

						alert ('Campo preenchido');

					}

				})


			})

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
	            <li><a href="php/sair.php">Sair</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>


	    <div class="container">
	    	
	    	<div class="col-md-3">
	    		<div class="panel panel-default">
					<div class="panel-body">
												
					<h4>Bem vindo!</h4>
					<h4><?= $_SESSION['usuario']?></h4>
					</div>	    			
	    		</div>	
	    	</div>
	    	<div class="col-md-6">
	    		<div class="panel panel-default">
	    			<div class="panel-body">
	    				<div class="input-group">
	    					<input type="text" class="form-control" id="text_pesquisa" placeholder="Pesquise" maxlength="140" name="">
	    					<span class="input-group-btn">
	    						
	    						<button class="btn btn-default" id="btn_pesquisa" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>
								</button>

	    					</span>
	    				</div>

	    			</div>
	    		</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-body">
						
						<h4><a href="#">Procurar por pessoas</a></h4>

					</div>

				</div>


			</div>



		</div>


	    </div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>