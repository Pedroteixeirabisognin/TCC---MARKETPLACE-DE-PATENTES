<?php

	//CHAMA A CLASSE BD.CLASS
	require_once('db.class.php');

	 //VIA POST OS DADOS NÃO FICAM EXPOSTOS NA URL, VIA GET SIM
	 $usuario = $_POST['usuario'];
	 $email = $_POST['email'];
	 $senha = md5($_POST['senha']);

	 $objDb = new db();

	 $link = $objDb->conecta_mysql();

	 $usuario_existe = false;
	 $email_existe = false;
	 // VERIFICAR SE O USUÁRIO JÁ EXISTE
	 $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";

	if($resultado_id = mysqli_query($link,$sql)){

		$dados_usuario = mysqli_fetch_array($resultado_id);

		if(isset($dados_usuario['usuario'])){

			$usuario_existe = true; 

		}

	}else{

		echo "Erro ao tentar localizar o registro de usuário";


	}



	 //VERIFICAR SE O E-MAIL JÁ EXISTE
	if($resultado_id = mysqli_query($link,$sql)){

		$dados_usuario = mysqli_fetch_array($resultado_id);

		if(isset($dados_usuario['email'])){

			$email_existe = true; 

		}

	}else{

		echo "Erro ao tentar localizar o registro de email";

	
	}

	if ($usuario_existe || $email_existe ) {

		$retorno_get = '';

		if($usuario_existe){

			$retorno_get.= "erro_usuario=1&";

		}
		if($usuario_existe){

			$retorno_get.= "erro_email=1&";

		}
		//A INTERROGAÇÃO DEFINE O QUE É SCRIPT E O QUE É PARAMETRO
		header('Location: ../inscrevase.php?'.$retorno_get);
		
		//INTERROMPE A EXECUÇÃO DO SCRIPT
		die();
	}




	 // QUERY SQL (NOTA: QUANDO SE UTILIZA ASPAS DUPLAS " O PHP JÁ TENTA ENCONTRAR ALGUMA VARIÁVEL NO MEIO E TENTA ATRIBUIR O VALOR REFERENTE A ELA AO EXECUTAR A STRING)
	 $sql = "INSERT INTO usuarios(usuario, email, senha) VALUES ('$usuario','$email','$senha')";

	 //EXECUTAR A QUERY (NOTA: A FUNÇÃO MYSQLI_QUERY QUANDO DA ERRO RETORNA VALOR FALSE)
	 if(mysqli_query($link,$sql)){

	 	echo "Usuário registrado com sucesso!";

	 }else{

	 	echo "Erro ao cadastrar o usuário";

	 }
?>