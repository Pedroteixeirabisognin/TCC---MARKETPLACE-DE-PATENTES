<?php
session_start();
if(!isset($_SESSION['usuario'])){

	header('Location: index.php?erro=1');

}	

	//CHAMA A CLASSE BD.CLASS
require_once('db.class.php');

$objDb = new db();

$link = $objDb->conecta_mysql();

//VIA POST OS DADOS NÃO FICAM EXPOSTOS NA URL, VIA GET SIM
$id = $_SESSION['id'];

$cpf = isset(  $_POST['cpf'])?  $_POST['cpf'] : 'NULL'; 
$telefone = isset( $_POST['telefone'])? $_POST['telefone'] : 'NULL'; 
$endereco = isset( $_POST['endereco'])? $_POST['endereco'] : 'NULL'; 
$nome = isset( $_POST['nome'])? $_POST['nome'] : 'NULL'; 
$sexo = isset( $_POST['sexo'])? $_POST['sexo'] : 'NULL'; 
$nasc = isset( $_POST['nasc'])? $_POST['nasc'] : 'NULL'; 
$foto = isset( $_POST['foto'])? $_POST['foto'] : 'NULL'; 



$objDb = new db();

$link = $objDb->conecta_mysql();
//IMAGENS

$total_arquivos = count($_FILES['arquivos']['name']);
	
	if ($total_arquivos > 1) {

		header('Location: ../editar_cliente.php?sucesso=2');
		die();
	}
	else{
	//diretório de upload
	$diretorio_upload = 'uploads/';

	//percorre cada arquivo
	for ($i=0; $i < $total_arquivos; $i++) {
				
		/* DESCOMENTAR PARA DEBUG
		echo $_FILES['arquivos']['name'][$i].' - ';
		echo $_FILES['arquivos']['type'][$i].' - ';
		echo $_FILES['arquivos']['tmp_name'][$i].' - ';
		echo $_FILES['arquivos']['error'][$i].' - ';
		echo $_FILES['arquivos']['size'][$i];
		echo '<hr />';
		*/
		
		
		//move o arquivo temporario para o destino e muda o nome do arquivo pra ter um hash na frente
		$arquivo_upload = $diretorio_upload .md5(time()).basename($_FILES['arquivos']['name'][$i]);


	
		if (move_uploaded_file($_FILES['arquivos']['tmp_name'][$i], $arquivo_upload)) {


		} else {
			if ($sexo == 'NULL') {
				echo $sexo;
				$sql = "UPDATE `cliente` SET `cpf`='$cpf',`endereco`= '$endereco',`telefone`='$telefone',`nome`='$nome',`data_nasc`='$nasc',`sexo`= NULL, `foto`= NULL WHERE id = $id";
				$resultado_id = mysqli_query($link,$sql);
				header('Location: ../editar_cliente.php?sucesso=1');
				die();
			}else{
				$arquivo_upload = 'NULL';
				$sql = "UPDATE `cliente` SET `cpf`='$cpf',`endereco`= '$endereco',`telefone`='$telefone',`nome`='$nome',`data_nasc`='$nasc',`sexo`= '$sexo', `foto`= $arquivo_upload WHERE id = $id";
				$resultado_id = mysqli_query($link,$sql);
				header('Location: ../editar_cliente.php?sucesso=1');
				die();
			}
		}
    
	}

	}

$sql = "UPDATE `cliente` SET `cpf`='$cpf',`endereco`= '$endereco',`telefone`='$telefone',`nome`='$nome',`data_nasc`='$nasc',`sexo`= '$sexo', `foto`='$arquivo_upload' WHERE id = $id";

echo $sql;
	 //VERIFICAR SE O E-MAIL JÁ EXISTE
if($resultado_id = mysqli_query($link,$sql)){

		header('Location: ../editar_cliente.php?sucesso=1');

}else{

	header('Location: ../editar_cliente.php?sucesso=2');

	
}


?>