<?php
	
	session_start();
	if(!isset($_SESSION['usuario'])){

		header('Location: index.php?erro=1');

	}	

	//CHAMA A CLASSE BD.CLASS
	require_once('db.class.php');

	 //VIA POST OS DADOS NÃO FICAM EXPOSTOS NA URL, VIA GET SIM


	 $usuario = isset( $_SESSION['usuario'])? $_SESSION['usuario'] : 0; 
	 $titulo = isset( $_POST['titulo'])? $_POST['titulo'] : 0; 
	 $telefone = isset( $_POST['telefone'])? $_POST['telefone'] : 0; 
	 $registro = isset( $_POST['registro'])? $_POST['registro'] : 0; 
	 $descricao = isset( $_POST['descricao'])? $_POST['descricao'] : 0; 
	 $imagem = isset( $_POST['imagem'])? $_POST['imagem'] : 0; 
	 $id = isset( $_SESSION['id'])? $_SESSION['id'] : 0;

	 $url = "https://i.imgur.com/";

	 $testa_url = strripos($imagem,$url);


	 
	$objDb = new db();

	$link = $objDb->conecta_mysql();





	 // QUERY SQL (NOTA: QUANDO SE UTILIZA ASPAS DUPLAS " O PHP JÁ TENTA ENCONTRAR ALGUMA VARIÁVEL NO MEIO E TENTA ATRIBUIR O VALOR REFERENTE A ELA AO EXECUTAR A STRING)
if ($testa_url === false and $imagem === false) {
	
	$_SESSION['valida_url'] = 1;
	header("Location: ../cadastrar_anuncio.php");

}elseif ($titulo != FALSE and $telefone != FALSE and $registro != FALSE and $descricao != FALSE and $id != FALSE) {
		# code...
	
	 $sql = "INSERT INTO `anuncio_patente`(`id_usuario`, `titulo`, `descricao`, `telefone`, `registro`, `data_inclusao`, `imagem`) VALUES ('$id','$titulo','$descricao','$telefone','$registro',CURRENT_TIMESTAMP,'$imagem')";

	 echo $sql;
	 //EXECUTAR A QUERY (NOTA: A FUNÇÃO MYSQLI_QUERY QUANDO DA ERRO RETORNA VALOR FALSE)
	 if(mysqli_query($link,$sql)){

		$_SESSION['cadastro'] = 1; 
	 	header("Location: ../cadastrar_anuncio.php");    

	 }else{
		$_SESSION['cadastro'] = 2; 
	 	header("Location: ../cadastrar_anuncio.php"); 

	 }
}


?>








