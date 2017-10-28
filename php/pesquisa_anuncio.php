<?php 
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

		//EM TESTE
		header('Location: ../home.php');

		/*foreach ($dados_anuncio as $anuncio) {


			echo "<div class='panel panel-default'>
				  	<div class='panel-heading'>
				  		<!--AQUI SERÁ INSERIDO A SESSION T-->
				    	<h3 class='panel-title'>".$anuncio['titulo']."</h3>
				  	</div>
				  <div class='panel-body'>"
				  	 .$anuncio['descricao']. 
				  "</div>
				</div>";



			var_dump($anuncio);
			echo "<br/>";
			echo "<br/>";
		}*/


	}else{

		echo "Erro na execução da consulta, favor entrar em contato com o admin da empresa!";

	}
?>