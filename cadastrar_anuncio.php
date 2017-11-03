<?php
	
	//SE O USUÁRIO NÃO PASSAR PELA AUTENTIFICAÇAO RETORNARÁ AO INDEX.PHP
	if(!isset($_GET['usuario'])){

		header('Location: index.php?erro=1');

	}
	//CHAMA A CLASSE BD.CLASS
	require_once('php/db.class.php');

	 //VIA POST OS DADOS NÃO FICAM EXPOSTOS NA URL, VIA GET SIM


	 $usuario = isset( $_GET['usuario'])? $_GET['usuario'] : 0; 
	 $titulo = isset( $_POST['titulo'])? $_POST['titulo'] : 0; 
	 $telefone = isset( $_POST['telefone'])? $_POST['telefone'] : 0; 
	 $registro = isset( $_POST['registro'])? $_POST['registro'] : 0; 
	 $descricao = isset( $_POST['descricao'])? $_POST['descricao'] : 0; 
	 $imagem = isset( $_POST['imagem'])? $_POST['imagem'] : 0; 


if($usuario != 0 and $titulo != 0 and $telefone != 0 and $registro != 0 and $descricao != 0 and $imagem != 0){
	 
	$objDb = new db();

	$link = $objDb->conecta_mysql();

	$sql = "SELECT id FROM usuarios WHERE usuario = '$usuario'";
	$execute = mysqli_query($link,$sql);
	$dados_usuario = mysqli_fetch_array($resultado_id);
	$id = $dados_usuario['id_usuario'];



	 // QUERY SQL (NOTA: QUANDO SE UTILIZA ASPAS DUPLAS " O PHP JÁ TENTA ENCONTRAR ALGUMA VARIÁVEL NO MEIO E TENTA ATRIBUIR O VALOR REFERENTE A ELA AO EXECUTAR A STRING)
	 $sql = "INSERT INTO `anuncio_patente`(`id_usuario`, `titulo`, `descricao`, `telefone`, `registro`, `data_inclusao`, `imagem`) VALUES ('$id','$titulo','$descricao','$telefone','$registro',CURRENT_TIMESTAMP,'$imagem')";

	 //EXECUTAR A QUERY (NOTA: A FUNÇÃO MYSQLI_QUERY QUANDO DA ERRO RETORNA VALOR FALSE)
	 if(mysqli_query($link,$sql)){

	 	echo "Anuncio registrado com sucesso!";

	 }else{

	 	echo "Erro ao cadastrar o Anuncio";

	 }
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
					<form action="cadastrar_anuncio.php">
					  <div class="form-group">
					    <label for="titulo">Título</label>
					    <input type="text" class="form-control" id="titulo" placeholder="Insira um título..." required>
					  </div>
					  <div class="form-group">
					    <label for="telefone">Telefone</label>
					    <input type="tel" pattern="^\d{2} \d{5} \d{4}$" class="form-control" id="telefone" placeholder="Ex: xx xxxxx xxxx" required>
					  </div>
					  <div class="form-group">
					    <label for="registro">Numero do registro</label>
					    <input type="text" class="form-control" id="registro" placeholder="Ex: BRXXXXXXXXX" required>
					  </div>
					  <div class="form-group">
					    <label for="descricao">Descrição</label>
					    <textarea class="form-control" rows="3" id="descricao" placeholder="Insira uma descrição" required></textarea>
					  </div>
					  <div class="form-group">
					    <label for="imagem">Foto</label>
					    <input type="url" id="imagem">
					    <p class="help-block">Insira a url da imagem do seu anuncio no imgur aqui!</p>
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