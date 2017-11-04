<?php
	
	//INICIA UMA SESSION
	session_start();

	//CHAMA A CLASSE BD.CLASS
	require_once('db.class.php');

	$id = $_GET['id'];


	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$sql = "SELECT * FROM anuncio_patente WHERE id = '$id'";


	//EM UMA QUERY DE SELECT ELE RETORNA FALSE OU UM RESOURCE QUE É UMA REFERENCIA A UMA INFORMAÇÃO EXTERNA AO PHP, É COM ELE QUE RECUPERAMOS OS DADOS
	$resultado_id = mysqli_query($link,$sql);

	echo $sql;
	//TESTA SE A CONSULTA ESTÁ SENDO FEITA CORRETAMENTE
	if($resultado_id){

		$dados_usuario = mysqli_fetch_array($resultado_id);

		echo $dados_usuario['id'];
		//TESTA SE O $DADOS_USUARIO POSSUI DADOS VÁLIDOS
		if(isset($dados_usuario['id'])){

			$_SESSION['id'] = $dados_usuario['id'];
			$_SESSION['id_usuario'] = $dados_usuario['id_usuario'];
			$_SESSION['titulo'] = $dados_usuario['titulo'];
			$_SESSION['descricao'] = $dados_usuario['descricao'];
			$_SESSION['telefone'] = $dados_usuario['telefone'];
			$_SESSION['registro'] = $dados_usuario['registro'];
			$_SESSION['data_inclusao'] = $dados_usuario['data_inclusao'];
			$_SESSION['imagem'] = $dados_usuario['imagem'];
			header('Location: ../anuncio_tela.php');

		}else{

			echo("erro");

		}


	}else{

		echo "Erro na execução da consulta, favor entrar em contato com o admin da empresa!";

	}


?>