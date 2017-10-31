<?php

	session_start();

	//SE O USUÁRIO NÃO PASSAR PELA AUTENTIFICAÇAO RETORNARÁ AO INDEX.PHP
	if(!isset($_SESSION['usuario'])){

		header('Location: index.php?erro=1');

	}


	//CHAMA A CLASSE BD.CLASS
	require_once('php/db.class.php');

	//DEFINE O NUMERO DE ITENS POR PÁGINA
	$itens_por_pagina = 10; 


	//PEGAR A PAGINA ATUAL
	$pagina = intval($_GET['pagina']);


	$pesquisa = isset($_GET['input_pesquisa']) ? $_GET['input_pesquisa'] : 0;

	$objDb = new db();

	$link = $objDb->conecta_mysql();



 	if ($pesquisa) {
 	 	$sql = "SELECT * FROM `anuncio_patente` where (`id` LIKE '%carro%') or (`id_usuario` LIKE '%$pesquisa%') or (`titulo` LIKE '%$pesquisa%') or (`descricao` LIKE '%$pesquisa%') or (`telefone` LIKE '%$pesquisa%') or (`email_usuario` LIKE '%$pesquisa%') or (`data_inclusao` LIKE '%$pesquisa%') LIMIT $pagina, $itens_por_pagina";	


 	}
 	else{
	 	$sql = "SELECT * FROM `anuncio_patente` LIMIT $pagina, $itens_por_pagina";
	 }
	
	$execute = mysqli_query($link,$sql);
	$anuncio = $execute->fetch_assoc();
	$num = $execute->num_rows;


	//Pega A QUANTIDADE TOTAL DE OBJETOS NO BANCO DE DADOS
	$num_total = $link->query("SELECT * FROM `anuncio_patente`")->num_rows;

	//DEFINIR O NUMERO DE PAGINAS
	$num_paginas = ceil($num_total/$itens_por_pagina);



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
	    		<div class="container fluid">
	    			<div class="row">
	    				<div class="col-lg-4">
	    					
	    				
	    				<?php if($num > 0 ){?>
	    					<table class="table table-bordered table-hover">
	    					    <?php do{ ?>
									<div class="panel panel-default">
									  <div class="panel-heading"><?php echo $anuncio['titulo'];?></div>
									  <div class="panel-body">
									    <?php echo $anuncio['descricao'];?>
									  </div>
									</div>


	    						<?php }while($anuncio = $execute->fetch_assoc()); ?>

	    						</tbody>

	    					</table>
							<nav aria-label="Page navigation">
							  <ul class="pagination">
							    <li>
							      <a href="home.php?pagina=0" aria-label="Previous">
							        <span aria-hidden="true">&laquo;</span>
							      </a>
							    </li>
							    <!--FAZ A PAGINA MUDAR-->
							    <?php for($i=0;$i<$num_paginas;$i++){ ?>
							    	
							    	<!--FAZ O ESTILO DO PAGINATION MUDAR DEPENDENDO DA PAGINA-->
							    	<?php $estilo = "";
							    	 if($pagina == $i){
							    		
							    		$estilo= "class='active'";

							    	 }
							    	  ?>
							    	<li <?php echo $estilo; ?>><a href="home.php?pagina=<?php echo $i;?>"><?php echo $i+1; ?></a></li>
							    	
							    <?php } ?>
							    <li>
							      <a href="home.php?pagina=<?php echo $num_paginas-1;?>" aria-label="Next">
							        <span aria-hidden="true">&raquo;</span>
							      </a>
							    </li>
							  </ul>
							</nav>
	    					<?php }?>		
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