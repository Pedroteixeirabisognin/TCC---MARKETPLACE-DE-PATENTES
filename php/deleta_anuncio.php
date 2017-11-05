<?php

	session_start();
	if(!isset($_SESSION['usuario'])){

		header('Location: index.php?erro=1');

	}	

	//CHAMA A CLASSE BD.CLASS
	require_once('db.class.php');

	//MUDAR O PARAMETRO VIA GET, POIS QUALQUER UM PODE APAGAR OU ALTERAR SE COLOCAR O VALOR NA URL


	$id = isset( $_GET['id'])? $_GET['id'] : 0;

	


	 
	$objDb = new db();

	$link = $objDb->conecta_mysql();

	$id_usuario = isset( $_SESSION['id'])? $_SESSION['id']: 0;



	//INSERINDO O USUARIO LOGADO ALI EMBAIXO IMPEDE QUE ACESSEM ESSA URL E APAGUEM O ARQUIVO POR CONTRA PRÓPRIA
	$sql = "DELETE FROM `anuncio_patente` WHERE id = '$id' and id_usuario = '$id_usuario' ";

	echo $sql;
	//EXECUTAR A QUERY (NOTA: A FUNÇÃO MYSQLI_QUERY QUANDO DA ERRO RETORNA VALOR FALSE)
	if(mysqli_query($link,$sql)){

		echo "Tudo certo!";    

	 }else{

	 	echo "ERRO";

	}
//}









?>