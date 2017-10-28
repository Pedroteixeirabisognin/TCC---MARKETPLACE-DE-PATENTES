<?php

/**
* 
*/
class bd{
		
		//HOST
		private $host = 'localhost';
		//USUARIO
		private $usuario = 'root';
		//SENHA
		private $senha = '';
		//BANCO DE DADOS
		private $database = 'invector';



		public function conecta_mysql(){


			//CRIAR A CONEXAO
			$con = mysqli_connect(this->host, this->usuario, this->senha, this->database);

			//AJUSTA O CHARSET DE COMUNICAÇÃO ENTRE A APLICAÇÃO E O BANCO DE DADOS
			mysqli_set_charset($con, 'utf8');

			//VERIFICAR SE HOUVE ERRO DE CONEXÃO
			if(mysqli_connect_errno()){

				echo 'Erro ao tentar se conectar com o BD MySQL:'.mysqli_connect_error();

			}


			return $con;
		}
}



?>