<?php

	session_start();

	//SE O USUÁRIO NÃO PASSAR PELA AUTENTIFICAÇAO RETORNARÁ AO INDEX.PHP
	if(!isset($_SESSION['usuario'])){

		header('Location: index.php?erro=1');

	}


	//CHAMA A CLASSE BD.CLASS
	require_once('db.class.php');

	$pesquisa = $_GET['input_pesquisa'];

	$objDb = new db();

	$link = $objDb->conecta_mysql();


 	$sql = "SELECT * FROM `anuncio_patente` where (`id` LIKE '%carro%') or (`id_usuario` LIKE '%$pesquisa%') or (`titulo` LIKE '%$pesquisa%') or (`descricao` LIKE '%$pesquisa%') or (`telefone` LIKE '%$pesquisa%') or (`email_usuario` LIKE '%$pesquisa%') or (`data_inclusao` LIKE '%$pesquisa%')";

	//EM UMA QUERY DE SELECT ELE RETORNA FALSE OU UM RESOURCE QUE É UMA REFERENCIA A UMA INFORMAÇÃO EXTERNA AO PHP, É COM ELE QUE RECUPERAMOS OS DADOS
	$resultado_id = mysqli_query($link,$sql);

	//TESTA SE A CONSULTA ESTÁ SENDO FEITA CORRETAMENTE
	if($resultado_id){

		//A FUNÇÃO MYSQLI_FETCH_ARRAY RETORNA DE FORMA NUMÉRICA E PELO NOME, COLOCANDO O SEGUNDO PARAMETRO MYSQLI_NUM ELA SÓ RETORNARÁ A FORMA NUMÉRICA, MYSQLI_ASSOC RETORNA PELO NOME
		$dados_anuncio = array();


		//ENQUANTO LINHA RECEBER UM ARRAY
		while($linha = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){

			//ISSO FUNCIONA COMO UM MALLOC EM C AUTOMATICAMENTE PELO QUE ENTENDI, ELE VAI INSERIR UM ARRAY DENTRO DE UM INDICE DE DADOS_USUARIO
			$_SESSION[] = $linha;

			//$dados_anuncio[] = $linha;
		}


		foreach ($dados_anuncio as $anuncio) {


			echo "<div class='panel panel-default'>
				  	<div class='panel-heading'>
				  		<!--AQUI SERÁ INSERIDO A SESSION T-->
				    	<h3 class='panel-title'>".$anuncio['titulo']."</h3>
				  	</div>
				  <div class='panel-body'>"
				  	 .$anuncio['descricao']. 
				  "</div>
				</div>";
			echo "<br/>";
			echo "<br/>";
		}


	}else{

		echo "Erro na execução da consulta, favor entrar em contato com o admin da empresa!";

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
	    		<form action="php/pesquisa_anuncio.php">
		    		<div class="panel panel-default">
		    			<div class="panel-body">
		    				<div class="input-group">
		    					

		    					<!--MODIFICANDO PARA PESQUISAR ANUNCIOS EM PESQUISA_ANUNCIO.PHP, COLOQUEI NOME INPUT_PESQUISA-->
		    					<input type="text" class="form-control" id="text_pesquisa" placeholder="Pesquise" maxlength="140" name="input_pesquisa">
		    					<span class="input-group-btn">
		    						
		    						<button class="btn btn-default" id="btn_pesquisa" type="submit" ><span class="glyphicon glyphicon-search" aria-hidden="true"></span>
									</button>

		    					</span>
		    				</div>

		    			</div>
		    		</div>
	    		</form>

	    		<!--EM TESTE-->


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