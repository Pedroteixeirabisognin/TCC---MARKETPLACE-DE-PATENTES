<?php
	//ISSET VERIFICA SE EXISTE ALGO DENTRO DA VARIÁVEL
	$erro_usuario = isset($_GET['erro_usuario'])? $_GET['erro_usuario'] : 0;
	$erro_email	=  isset($_GET['erro_email'])? $_GET['erro_email'] : 0;
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
	            <li><a href="index.php">Voltar para Home</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>


	    <div class="container">
	    	
	    	<br /><br />

	    	<div class="col-md-4"></div>
	    	<div class="col-md-4">
	    		<h3>Anuncie sua idéia</h3>
	    		<br />

	    		<!--FORM PARA CADASTRO DO ANUNCIO-->
					<form>
					  <div class="form-group">
					    <label for="titulo">Título</label>
					    <input type="text" class="form-control" id="titulo" placeholder="Insira um título..." required>
					  </div>
					  <div class="form-group">
					    <label for="telefone">Telefone</label>
					    <input type="tel" pattern="^\d{2} \d{5} \d{4}$" class="form-control" id="telefone" placeholder="Ex: xx xxxxx xxxx" required>
					  </div>
					  <div class="form-group">
					    <label for="titulo">Numero do registro</label>
					    <input type="text" class="form-control" id="titulo" placeholder="Insira o número do registro..." required>
					  </div>
					  <div class="form-group">
					    <label for="descricao">Descrição</label>
					    <textarea class="form-control" rows="3" id="descricao" placeholder="Insira uma descrição" required></textarea>
					  </div>
					  <div class="form-group">
					    <label for="imagem">Foto</label>
					    <input type="file" id="imagem">
					    <p class="help-block">Insira uma imagem do anuncio aqui!</p>
					  </div>
					  <div class="checkbox">
					    <label>
					      <input type="checkbox" required> Estou de acordo com a divulgação desse anúncio.
					    </label>
					  </div>
					  <button type="submit" class="btn btn-default">Enviar</button>
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