<?php
	
	session_start();

	require_once('../class/db.class.php');

	$usuario = $_POST['usuario'];
	$senha   = md5($_POST['senha']);

	$sql = "SELECT id,usuario, email FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha' ";

	$objDb = new db();
	$link  = $objDb->conecta_mysql();

	$resultado_id = mysqli_query($link,$sql);

	if($resultado_id){
		$dados_usuarios = mysqli_fetch_array($resultado_id);

		if (isset($dados_usuarios['usuario'])) {
			$_SESSION['id'] = $dados_usuarios['id'];
			$_SESSION['usuario'] = $dados_usuarios['usuario'];
			$_SESSION['email'] = $dados_usuarios['email'];

			header('Location: ../home.php');
		}else{
			header('Location: ../index.php?erro=1');
		}
	}else{
		echo "Erro na execucao da consulta, favor entrar em contato com o admin do site";
	}


?>