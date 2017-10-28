<?php
	//ESSE CÓDIGO RETORNA UM ARREI DE UM BANCO MYSQL//


	//CHAMA A CLASSE BD.CLASS
	require_once('php/db.class.php');



	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$sql = "SELECT * FROM usuarios";


	//EM UMA QUERY DE SELECT ELE RETORNA FALSE OU UM RESOURCE QUE É UMA REFERENCIA A UMA INFORMAÇÃO EXTERNA AO PHP, É COM ELE QUE RECUPERAMOS OS DADOS
	$resultado_id = mysqli_query($link,$sql);

	//TESTA SE A CONSULTA ESTÁ SENDO FEITA CORRETAMENTE
	if($resultado_id){

		//A FUNÇÃO MYSQLI_FETCH_ARRAY RETORNA DE FORMA NUMÉRICA E PELO NOME, COLOCANDO O SEGUNDO PARAMETRO MYSQLI_NUM ELA SÓ RETORNARÁ A FORMA NUMÉRICA, MYSQLI_ASSOC RETORNA PELO NOME
		$dados_usuario = array();


		//ENQUANTO LINHA RECEBER UM ARRAY
		while($linha = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){

			//ISSO FUNCIONA COMO UM MALLOC EM C AUTOMATICAMENTE PELO QUE ENTENDI, ELE VAI INSERIR UM ARRAY DENTRO DE UM INDICE DE DADOS_USUARIO
			$dados_usuario[] = $linha;
		}

		foreach ($dados_usuario as $usuario) {

			var_dump($usuario);
			echo "<br/>";
			echo "<br/>";
		}


	}else{

		echo "Erro na execução da consulta, favor entrar em contato com o admin da empresa!";

	}


?>