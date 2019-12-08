<?php

function conectar(){
	$servidor = "localhost";
	$usuario = "root";
	$senha= "";
	$bd = "exercicio_03";
	
	$con = new mysqli($servidor, $usuario, $senha, $bd);
	return $con;
	
}

$conexao = conectar();


?>