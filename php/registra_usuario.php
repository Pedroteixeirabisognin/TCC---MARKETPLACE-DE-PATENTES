<?php

	//CHAMA A CLASSE BD.CLASS
	require_once('db.class.php');

	 //VIA POST OS DADOS NÃO FICAM EXPOSTOS NA URL, VIA GET SIM
	 $usuario = $_POST['usuario'];
	 $email = $_POST['email'];
	 $senha = md5($_POST['senha']);

	 $objDb = new db();

	 $link = $objDb->conecta_mysql();

	 // QUERY SQL (NOTA: QUANDO SE UTILIZA ASPAS DUPLAS " O PHP JÁ TENTA ENCONTRAR ALGUMA VARIÁVEL NO MEIO E TENTA ATRIBUIR O VALOR REFERENTE A ELA AO EXECUTAR A STRING)
	 $sql = "INSERT INTO usuarios(usuario, email, senha) VALUES ('$usuario','$email','$senha')";

	 //EXECUTAR A QUERY (NOTA: A FUNÇÃO MYSQLI_QUERY QUANDO DA ERRO RETORNA VALOR FALSE)
	 if(mysqli_query($link,$sql)){

	 	echo "Usuário registrado com sucesso!";

	 }else{

	 	echo "Erro ao cadastrar o usuário";

	 }
?>