<?php

session_start();
if(!isset($_SESSION['usuario'])){

	header('Location: index.php?erro=1');

}	

//CHAMA A CLASSE BD.CLASS
require_once('db.class.php');


$objDb = new db();

$link = $objDb->conecta_mysql();

$id_usuario = isset( $_SESSION['id'])? $_SESSION['id']: 0;



	//INSERINDO O USUARIO LOGADO ALI EMBAIXO IMPEDE QUE ACESSEM ESSA URL E APAGUEM O ARQUIVO POR CONTRA
$sql = "DELETE FROM `conta` WHERE id = '$id_usuario' ";

echo $sql;
	//EXECUTAR A QUERY (NOTA: A FUNÇÃO MYSQLI_QUERY QUANDO DA ERRO RETORNA VALOR FALSE)
if(mysqli_query($link,$sql)){

	session_destroy();
	header('Location: ../index.php'); 

}
//}









?>