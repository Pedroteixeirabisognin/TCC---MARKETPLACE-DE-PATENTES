<?php

session_start();
if(!isset($_SESSION['usuario'])){

	header('Location: index.php?erro=1');

}	

	//VARIAVEL PARA VERIFICAR SE O CADASTRO FOI OK
$cadastro = intval(isset($_SESSION['cadastro']) ? $_SESSION['cadastro'] : 0) ;
	//VARIÁVEL PARA VERIFICAR SE A URL ESTÁ CERTA
$valida_url = intval(isset($_SESSION['valida_url']) ? $_SESSION['valida_url'] : 0) ;

$sucesso = isset($_GET['sucesso']) ? $_GET['sucesso'] : 0 ;
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
		<!-- bootstrap - link cdn -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link href="./css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="./js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
	<script src="./js/plugins/sortable.min.js" type="text/javascript"></script>
	<script src="./js/plugins/purify.min.js" type="text/javascript"></script>
	<script src="./js/fileinput.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="./themes/fa/theme.js"></script>
	<script src="./js/locales/<lang>.js"></script>	

			<script type="text/javascript">
			$(document).ready( function() {
			
				// initialize with defaults
				$("#arquivos").fileinput();

				// with plugin options
				$("#arquivos").fileinput({'showUpload':false, 'previewFileType':'any' });
				
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
				<a href="home.php"><img src="imagens/icone_invector.png" style="width: 50px; height: 50px;" /></a>
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
			<h3>Informe seus dados</h3>		
			<form action="php/editar_cliente.php" id="form_anuncio" method="POST" enctype="multipart/form-data">			  <div class="form-group">
			    <label for="telefone">Telefone</label>
			    <input type="numeric" class="form-control" id="telefone" name="telefone" placeholder="Telefone">
			  </div>
			  <div class="form-group">
			    <label for="cpf">CPF</label>
			    <input type="numeric" class="form-control" id="cpf" name="cpf" placeholder="CPF">
			  </div>
			  <div class="form-group">
			    <label for="endereco">Endereço</label>
			    <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereço">
			  </div>
			  <div class="form-group">
			    <label for="nome">Nome</label>
			    <input type="text" class="form-control" id="nome" name="nome" placeholder="nome">
			  </div>
			  
				<div class="form-group">
				
					
						<div style="width: 400px; padding-left: 0;">
							<label class="control-label">Selecione o arquivo desejado:</label>
							<input id="arquivos" name="arquivos[]" type="file" class="file" multiple data-show-upload="false" data-show-caption="true" >
						</div>
					
				
				</div>

			  <label for="nasc">Data de nascimento</label>
			  <input type="data" class="form-control" id="nasc" name="nasc" placeholder="xx/xx/xxxx">
			  <label for="sexo">Sexo</label>
			  <br>
			  <input type="RADIO" id="sexo" name="sexo" value="f"> Feminino</input> 
			  <input type="RADIO" id="sexo" name="sexo" value="m"> Masculino</input>
			  <br>
			  <br>
			  <button type="submit" class="btn btn-default">Enviar</button>
			
			</form>
			<?php if($sucesso == 1){?>

				<p style="color: green;">Dados adicionados com sucesso!</p>

			<?php }if($sucesso == 2){?>
				<p style="color: red;">Falha ao adicionar dados!</p>

			<?php }if($sucesso == 3){?>
				<p style="color: red;">Data invalida!</p>
			<?php }?>
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