<?php
	
	session_start();
	if(!isset($_SESSION['usuario'])){

		header('Location: index.php?erro=1');

	}	

	//VARIAVEL PARA VERIFICAR SE O CADASTRO FOI OK
	$cadastro = intval(isset($_SESSION['cadastro']) ? $_SESSION['cadastro'] : 0) ;
	//VARIÁVEL PARA VERIFICAR SE A URL ESTÁ CERTA
	$valida_url = intval(isset($_SESSION['valida_url']) ? $_SESSION['valida_url'] : 0) ;
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
	    		<?php  echo $_SESSION['id']; ?>
	    		<!--FORM PARA CADASTRO DO ANUNCIO-->
					<form action="php/cadastrar_anuncio.php" id="form_anuncio" method="POST">
					  <div class="form-group">
					    <label for="titulo">Título</label>
					    <input type="text" class="form-control" id="titulo_id" name="titulo" placeholder="Insira um título..." required>
					  </div>
					  <div class="form-group">
					    <label for="telefone">Telefone</label>
					    <input type="tel" pattern="^\d{2} \d{5} \d{4}$" class="form-control" name="telefone" id="telefone_id" placeholder="Ex: xx xxxxx xxxx" required>
					  </div>
					  <div class="form-group">
					    <label for="registro">Numero do registro</label>
					    <input type="text" class="form-control" id="registro_id" name="registro" placeholder="Ex: BRXXXXXXXXX" required>
					  </div>
					 <div class="form-group">
					    <label for="descricao">Descrição</label>
					    <textarea class="form-control"  name="descricao" form="form_anuncio" required></textarea>
					</div>
					  <div class="form-group">
					 	<p class="help-block">Hospede a imagem no Imgur, clique com o lado direito em cima da imagem, selecione copiar endereço de imagem e insira a url copiada aqui no campo <b>Foto</b> se possuir alguma.</p>
					    <label for="imagem">Foto</label>
					    <input type="url" id="imagem_id" name="imagem">
					<?php if ($valida_url == 1){ $_SESSION['valida_url'] = 0;?>
						<span>Url de imagem inválida</span>
					<?php } ?>
					  </div>
					  <div class="checkbox">
					    <label>
					      <input type="checkbox" required> Estou de acordo com a divulgação desse anúncio.
					    </label>
					  </div>
					  <button type="submit" class="btn btn-default">Enviar</button>
					</form>
					<!--VERIFICA SE FOI CADASTRADO CORRETAMENTE-->
					<?php if ($cadastro == 1){ $_SESSION['cadastro'] = 0;?>
						<span>Cadastrado com sucesso</span>
					<?php } ?>
					<!--VERIFICA SE NÃO FOI CADASTRADO CORRETAMENTE-->
					<?php if ($cadastro == 2){ $_SESSION['cadastro'] = 0;?>
						<span>Erro ao cadastrar anuncio</span>
					<?php } ?>
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