<?php

session_start();

	//SE O USUÁRIO NÃO PASSAR PELA AUTENTIFICAÇAO RETORNARÁ AO INDEX.PHP
if(!isset($_SESSION['usuario'])){

	header('Location: index.php?erro=1');

}
else{
	$usuario = $_SESSION['usuario'];

}



//CHAMA A CLASSE BD.CLASS
require_once('php/db.class.php');


//DEFINE O NUMERO DE ITENS POR PÁGINA
$itens_por_pagina = 10; 

//DEFINE A VARIAVEL MEUS ANUNCIOS
$meus_anuncios = intval(isset($_GET['meus_anuncios']) ? $_GET['meus_anuncios'] : 0) ;

//PEGAR A PAGINA ATUAL //ESTÁ BUGANDO POIS ESTÁ RECEBENDO VALOR ERRADO
$pagina = intval(isset($_GET['pagina']) ? $_GET['pagina'] : 0) ;


$pesquisa = isset($_GET['input_pesquisa']) ? $_GET['input_pesquisa'] : 0;

$objDb = new db();

$link = $objDb->conecta_mysql();

/////////////FOTO PERFIL////////////////////////////////
$id_perfil = $_SESSION['id'];
$sql_perfil = "SELECT foto FROM cliente where id = '$id_perfil'";
$sql_resposta_perfil = mysqli_query($link,$sql_perfil);

$foto = $sql_resposta_perfil->fetch_assoc();



///////////////////////////////////////////////////////
//SELECIONA TODAS AS ÁREAS PARA RETORNAR DEPOIS
$query_area = "select * from area";

//PARA SER ENVIADO PARA O WHILE DA AREA
$sql_resposta = mysqli_query($link,$query_area);

$area = isset( $_GET['area'])? $_GET['area'] : 0; 



//FAZ A PESQUISA CORRETAMENTE
$item = $pagina * $itens_por_pagina;

//VERIFICA SE PESQUISA POSSUI ALGO DENTRO E MUDA A QUERY DEPENDENDO DO QUE FOR
if ($pesquisa) {
	$sql = "SELECT * FROM `anuncio_patente` where (`id` LIKE '%$pesquisa%') or (`id_conta` LIKE '%$pesquisa%') or (`titulo` LIKE '%$pesquisa%') or (`descricao` LIKE '%$pesquisa%') or (`telefone` LIKE '%$pesquisa%') or (`num_registro` LIKE '%$pesquisa%') or (`data_inclusao` LIKE '%$pesquisa%') LIMIT $itens_por_pagina OFFSET $item";	
	$num_paginas_def = 1;


}
elseif($area != FALSE && $pesquisa == FALSE && $meus_anuncios == FALSE){
	$sql = "SELECT * FROM `anuncio_patente` WHERE id_area =' $area' LIMIT $itens_por_pagina OFFSET $item";
	$num_paginas_def = 2;

}
elseif($area != FALSE && $pesquisa != FALSE && $meus_anuncios == FALSE){
	$sql = "SELECT * FROM `anuncio_patente` where id_area = '$area' and ((`id` LIKE '%$pesquisa%') or (`id_conta` LIKE '%$pesquisa%') or (`titulo` LIKE '%$pesquisa%') or (`descricao` LIKE '%$pesquisa%') or (`telefone` LIKE '%$pesquisa%') or (`num_registro` LIKE '%$pesquisa%') or (`data_inclusao` LIKE '%$pesquisa%')) LIMIT $itens_por_pagina OFFSET $item";	
	$num_paginas_def = 3;
}
elseif($meus_anuncios != FALSE){

	$sql = "SELECT * FROM `anuncio_patente` WHERE id_conta ='$meus_anuncios' LIMIT $itens_por_pagina OFFSET $item";
	$num_paginas_def = 4;
}
else{
	$sql = "SELECT * FROM `anuncio_patente` LIMIT $itens_por_pagina OFFSET $item";
	$num_paginas_def = 0;
}


//var_dump($sql);
$execute = mysqli_query($link,$sql);
$anuncio = $execute->fetch_assoc();
$num = $execute->num_rows;

//var_dump($area);

//PEGA A QUANTIDADE MAXIMA DE VALORES DO BANCO DE DADOS DEFININDO O TIPO DE QUERY
if ($num_paginas_def == 1) {
	$num_total = $link->query("SELECT * FROM `anuncio_patente` where (`id` LIKE '%$pesquisa%') or (`id_conta` LIKE '%$pesquisa%') or (`titulo` LIKE '%$pesquisa%') or (`descricao` LIKE '%$pesquisa%') or (`telefone` LIKE '%$pesquisa%') or (`data_inclusao` LIKE '%$pesquisa%')")->num_rows;
}
elseif ($num_paginas_def == 2) {
		$num_total = $link->query("SELECT * FROM `anuncio_patente` WHERE id_area ='$area'")->num_rows;
}
elseif ($num_paginas_def == 3) {
	$num_total = $link->query("SELECT * FROM `anuncio_patente` where id_area = '$area' and ((`id` LIKE '%$pesquisa%') or (`id_conta` LIKE '%$pesquisa%') or (`titulo` LIKE '%$pesquisa%') or (`descricao` LIKE '%$pesquisa%') or (`telefone` LIKE '%$pesquisa%') or (`num_registro` LIKE '%$pesquisa%') or (`data_inclusao` LIKE '%$pesquisa%')) ")->num_rows;
}elseif ($num_paginas_def == 4){

	$num_total = $link->query("SELECT * FROM `anuncio_patente` WHERE id_conta = '$meus_anuncios'")->num_rows;	

}else{
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
	<script>
		$(document).ready(function(){
			$("#hide").click(function(){
				$("#deletar").hide();
			});
			$("#show").click(function(){
				$("#deletar").show();
			});
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
					<li><a href="php/sair.php">Sair</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>


	<div class="container">

		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-body">
					<h4 align="center">Bem vindo</h4>
					<h4 align="center"><?= $_SESSION['usuario']?></h4>
					<br>
					<div align="center">

						<?php if(!is_null($foto['foto'])){?>
							<a href="home.php"><img src="php/<?php echo $foto['foto']?>" class="img-thumbnail" width="200px" height="100px"></a>
						<?php }else{ ?>

							<a href="home.php"><img src="imagens/sem_imagem.png" class="img-thumbnail" width="200px" height="100px"></a>

						<?php  }?>
					</div>
					<ul class="nav nav-pills nav-stacked">
						<li role="presentation" class="active"><a href="home.php?meus_anuncios=<?php echo $_SESSION['id'];?>">Meus Anúncios</a></li>
						<li role="presentation" ><a href="editar_cliente.php">Adicionar/Editar dados do cliente</a></li>
						<li role="presentation" ><a href="cadastrar_anuncio.php">Cadastrar Anúncio</a></li>  
						<li role="presentation" ><a href="#" id="show"><b style="color: red;">Excluir Conta</b></a></li> 
						<div id="deletar" style="display: none;">
							<br>
							<p>Tem certeza?</p>
							<br>
							<!-- Botão para apagar a conta -->
							<a href="php/deleta_conta.php"><button type="button"  class="btn btn-danger">Sim</button></a>

							<!-- Standard button -->
							<button type="button" id="hide" class="btn btn-default">Não</button>
						</div>
					</ul>
				</div>	    			
			</div>	
		</div>
		<div class="col-md-6">

			<form action="home.php" style="padding-right: 4px;">
				<div class="panel panel-default" >
					<div class="panel-body" >
						<div class="input-group" >


							<!--MODIFICANDO PARA PESQUISAR ANUNCIOS EM PESQUISA_ANUNCIO.PHP, COLOQUEI NOME INPUT_PESQUISA-->
							<input type="text" class="form-control" id="text_pesquisa" placeholder="Pesquise" maxlength="140" name="input_pesquisa" >
							<span class="input-group-btn">
							
								<button class="btn btn-default" id="btn_pesquisa" type="submit" ><span class="glyphicon glyphicon-search" aria-hidden="true"></span>
							<?php if($area != false){?>
								<input type="hidden" value="<?php echo $area;?>" name="area"/>
							<?php } ?>
								</button>

							</span>

						</div>

					</div>
				</div>
			</form>

			<!--EM TESTE-->
			
			<div class="row">
				<div class="col-ls-4" style="padding-left: 10px; padding-right: 10px;">


					<?php if($num > 0 ){?>
					<table class="table table-bordered table-hover">
						<?php }?>	
						<?php do{ ?>
						<!--VERIFICA SE É NULL SE FOR NÃO FAZ O QUE ESTÁ ENTRE O IF-->
						<?php if(!is_null($anuncio)){?>
						<div class="panel panel-default">
							
							<div class="panel-heading"><a href="php/valida_anuncio.php?id=<?php echo $anuncio['id'];?>"><?php echo $anuncio['titulo'];?></a></div>
							<div class="row">
								
								<div class="panel-body" style=" height: 200px;">

									<div class="row">
										<div class="col-lg-4">	

											<?php if(!is_null($anuncio['imagem'])){ ?>
											<a href="php/valida_anuncio.php?id=<?php echo $anuncio['id'];?>"><img src="<?php echo "php/".$anuncio['imagem'];?>" class="img-thumbnail" style="margin-left: 10px; width: 100px; height: 100px;"></a>


											<?php }else{ ?>
											<a href="php/valida_anuncio.php?id=<?php echo $anuncio['id'];?>"><img src="imagens/sem_imagem.png" width="100px" height="100px" class="img-thumbnail" style="margin-left: 10px; "></a>
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
					<?php }?>

					<?php }while($anuncio = $execute->fetch_assoc()); ?>

				</tbody>

			</table>
			<!--AINDA HÁ UM BUG QUE PAGINATION FICA MESMO COM 1 ANUNCIO(corrigido) E QUE QUANDO SELECIONA O SEGUNDO INDICE ELE VIRA UM SELECT ALL-->
			<!--MAIS UM BUG QUE QUANDO MOSTRA -->

			<?php if ($num > 9 || $pagina > 0) {

				?>
				<nav aria-label="Page navigation" style="text-align: center;">
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
						<!--ALTERA O ESTILO DO ÍNDICE, CRIA CADA INDICE DO PAGINATION, SE PESQUISA ESTIVER SETADO, MANDA POR GET A PESQUISA E A PAGINA, CASO CONTRÁRIO SÓ A PAGINA // BUG, SE NO IF DE PESQUISA FOR COLOCADO A STRING 0 ELE VAI RECONHECER COMO FALSO E NÃO VAI FAZER AQUILO-->
						<li <?php echo $estilo; ?>><a href="home.php?<?php 

							if($pesquisa != false && $area == false){
								echo "pagina=".$i."&input_pesquisa=".$pesquisa;
								}elseif ($pesquisa!=false && $area != false) {
								echo "pagina=".$i."&input_pesquisa=".$pesquisa."&area=".$area;	
								}elseif ($pesquisa == false && $area != false) {
								echo "pagina=".$i."&area=".$area;	
								}else{
								echo "pagina=".$i;}?>"><?php echo $i+1; ?></a></li>

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
	<div class="col-md-3">
	
	<form action="home.php" id="form_anuncio" method="GET">
		<label>Área</label>
		<select class="form-control input-sm" name="area">
			<option value="0">---</option>
			<?php while($area = $sql_resposta->fetch_assoc()){ ?>
			<option value="<?php echo $area['id'];?>"><?php echo $area['nome'];?></option>
			<?php }?>						        
		</select>
		<br>
		<input type="submit" value="Filtrar">
	</form>
	</div>

</div>
</div>
<hr>
<div class="container" >
	<div class="row" >
		<div class="col-md-4" align="left" style="padding-bottom: 100px;">
			
			<div style="padding-bottom: 50px;">
				<a href="#"><img src="imagens/facebook.ico" width="100px" height="100px" ></a>facebook/invector
			</div>
			<div>
				<a href="#"><img src="imagens/twitter.png" width="100px" height="100px"></a>@Invector
			</div>
		</div>
		<div class="col-md-8">

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