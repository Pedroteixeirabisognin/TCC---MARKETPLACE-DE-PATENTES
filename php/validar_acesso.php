<?php

	//CHAMA A CLASSE BD.CLASS
	require_once('db.class.php');

	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' and senha = '$senha' ";


	//EM UMA QUERY DE SELECT ELE RETORNA FALSE OU UM RESOURCE QUE É UMA REFERENCIA A UMA INFORMAÇÃO EXTERNA AO PHP, É COM ELE QUE RECUPERAMOS OS DADOS
	$resultado_id = mysqli_query($link,$sql);

	if($resultado_id){

		$dados_usuario = mysqli_fetch_array($resultado_id);

		var_dump($dados_usuario);


	}else{

		echo "Erro na execução da consulta, favor entrar em contato com o admin da empresa!";

	}


?>