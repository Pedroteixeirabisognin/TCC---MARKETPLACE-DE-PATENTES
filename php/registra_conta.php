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
$sql = "SELECT * FROM conta WHERE usuario = '$usuario'";

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

//DEFINE O VALOR DE ID E ID CLIENTE
$sql = "INSERT INTO conta(usuario, email, senha) VALUES ('$usuario','$email','$senha')";

	 //EXECUTAR A QUERY (NOTA: A FUNÇÃO MYSQLI_QUERY QUANDO DA ERRO RETORNA VALOR FALSE)
if(mysqli_query($link,$sql)){
	
	//SELECIONA O ÚLTIMO VALOR INSERIDO
	$sql = "SELECT MAX(id) FROM conta";
	

	$sql_resposta = mysqli_query($link,$sql);
	
	//JOGA TUDO EM UM ARRAY
	$sql_resposta = mysqli_fetch_array($sql_resposta);

	//PEGA O VALOR DO ARRAY EM $SQL_RESPOSTA[0]
	$sql = "INSERT INTO cliente(id, id_conta) VALUES ($sql_resposta[0],$sql_resposta[0])";
	
	mysqli_query($link,$sql);
	
	//JOGA O VALOR DO ULTIMO CLIENTE CRIADO DENTRO DA CONTA
	$sql = "UPDATE conta SET id_cliente = $sql_resposta[0] WHERE id = $sql_resposta[0]";

	mysqli_query($link,$sql);

	header('Location: ../inscrevase.php?sucesso=1');

}else{

	echo "Erro ao cadastrar o usuário";

}
?>