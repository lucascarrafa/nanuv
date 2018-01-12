<?php

session_start();

include "config.php";
include "database.php" ;
include "ajustantes.php" ;


$protocolo = $_SESSION["id_usuario"];
$diretorio =  $_COOKIE["login"];
$local = "$diretorio/";
$tem_erros = false;
$erros_validacao = array();


	if (tem_post()){
	$usuario_id = $_POST['usuario_id'];
	
		if(isset($_FILES['anexo'])){
			
			if (tratar_anexo($_FILES['anexo'], $diretorio)){
				$anexo = array();
				$anexo['usuario_id'] = $usuario_id;
				$anexo['nome'] = $_FILES['anexo']['name'];
				$anexo['arquivo'] = $_FILES['anexo']['name'];
			}else{
				$tem_erros = true;
				$erros_validacao['anexo'] = 'Envie apenas anexos nos formatos zip ou pdf';
			}
			
			if (!$tem_erros){
					gravar_anexo($conexao, $anexo);
					header('Location: home');
					die();
				}
		}
		
	}

$anexos = buscar_anexos($conexao, $_SESSION["id_usuario"]);


if (isset($protocolo)){
	include ("homework.php");
}else{
	header("Location:index.html");
}

?>