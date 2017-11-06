<?php

session_start();

	//SE O USUÁRIO NÃO PASSAR PELA AUTENTIFICAÇAO RETORNARÁ AO INDEX.PHP
if(!isset($_SESSION['usuario'])){

	header('Location: index.php?erro=1');

}
else{
	$usuario=$_SESSION['usuario'];

}

//CHAMA A CLASSE BD.CLASS
require_once('php/db.class.php');


//DEFINE O NUMERO DE ITENS POR PÁGINA
$itens_por_pagina = 10; 


//PEGAR A PAGINA ATUAL //ESTÁ BUGANDO POIS ESTÁ RECEBENDO VALOR ERRADO
$pagina = intval(isset($_GET['pagina']) ? $_GET['pagina'] : 0) ;


$pesquisa = isset($_GET['input_pesquisa']) ? $_GET['input_pesquisa'] : 0;

$objDb = new db();

$link = $objDb->conecta_mysql();

//FAZ A PESQUISA CORRETAMENTE
$item = $pagina * $itens_por_pagina;

//VERIFICA SE PESQUISA POSSUI ALGO DENTRO E MUDA A QUERY DEPENDENDO DO QUE FOR
if ($pesquisa) {
	$sql = "SELECT * FROM `anuncio_patente` where (`id` LIKE '%$pesquisa%') or (`id_usuario` LIKE '%$pesquisa%') or (`titulo` LIKE '%$pesquisa%') or (`descricao` LIKE '%$pesquisa%') or (`telefone` LIKE '%$pesquisa%') or (`registro` LIKE '%$pesquisa%') or (`data_inclusao` LIKE '%$pesquisa%') LIMIT $item, $itens_por_pagina";	
	$num_paginas_def = 1;


}
else{
	$sql = "SELECT * FROM `anuncio_patente` LIMIT $item, $itens_por_pagina";
	$num_paginas_def = 0;
}
//var_dump($sql);
$execute = mysqli_query($link,$sql);
$anuncio = $execute->fetch_assoc();
$num = $execute->num_rows;

//var_dump($anuncio);

//PEGA A QUANTIDADE MAXIMA DE VALORES DO BANCO DE DADOS DEFININDO O TIPO DE QUERY
if ($num_paginas_def == 1) {
	$num_total = $link->query("SELECT * FROM `anuncio_patente` where (`id` LIKE '%$pesquisa%') or (`id_usuario` LIKE '%$pesquisa%') or (`titulo` LIKE '%$pesquisa%') or (`descricao` LIKE '%$pesquisa%') or (`telefone` LIKE '%$pesquisa%') or (`data_inclusao` LIKE '%$pesquisa%')")->num_rows;
}
else{
	$num_total = $link->query("SELECT * FROM `anuncio_patente`")->num_rows;
}
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
			<form action="home.php">
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
							<?php }?>	
							<?php do{ ?>
							<div class="panel panel-default">
								
								<div class="panel-heading"><a href="php/valida_anuncio.php?id=<?php echo $anuncio['id'];?>"><?php echo $anuncio['titulo'];?></a></div>
								<div class="row">
									
									<div class="panel-body">

										<div class="row">
											<div class="col-lg-4">	
												
												<?php if(!is_null($anuncio['imagem']) or $anuncio['imagem'] == ''){ ?>
												<img src="<?php echo $anuncio['imagem'];?>" width="100px" height="100px" class="img-thumbnail" style="margin-left: 10px; ">


												<?php }else{ ?>
												<img src="imagens/sem_imagem.jpg" width="100px" height="100px" class="img-thumbnail" style="margin-left: 10px; ">
												<?php  }?>


											</div>
											<div class="col-lg-8">	
												<?php echo $anuncio['descricao'];?>
											</div>
										</div>
									</div>	
								</div>
							</div>
						</div>


						<?php }while($anuncio = $execute->fetch_assoc()); ?>

					</tbody>

				</table>
				<!--AINDA HÁ UM BUG QUE PAGINATION FICA MESMO COM 1 ANUNCIO(corrigido) E QUE QUANDO SELECIONA O SEGUNDO INDICE ELE VIRA UM SELECT ALL-->
				<!--MAIS UM BUG QUE QUANDO MOSTRA -->

				<?php if ($num > 9 || $pagina > 0) {

					?>
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
							<!--ALTERA O ESTILO DO ÍNDICE, CRIA CADA INDICE DO PAGINATION, SE PESQUISA ESTIVER SETADO, MANDA POR GET A PESQUISA E A PAGINA, CASO CONTRÁRIO SÓ A PAGINA -->
							<li <?php echo $estilo; ?>><a href="home.php?<?php if($pesquisa!= false){echo "pagina=".$i."&input_pesquisa=".$pesquisa;}else{ echo "pagina=".$i;}?>"><?php echo $i+1; ?></a></li>

							<?php } ?>
							<li>
								<a href="home.php?pagina=<?php echo $num_paginas-1;?>" aria-label="Next">
									<span aria-hidden="true">&raquo;</span>
								</a>
							</li>
						</ul>
					</nav>
					<?php } ?>
				</div>


			</div>


		</div>

	</div>
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-body">

				<h4><a href="cadastrar_anuncio.php">Cadastrar Anuncio</a></h4>

			</div>

		</div>


	</div>



</div>


</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>
</html>