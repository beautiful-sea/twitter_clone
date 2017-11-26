<?php
	require_once '../class/db.class.php';

	session_start();

	$texto_tweet = $_POST['texto_tweet'];
    $id_usuario = $_SESSION['id'];

    if(!isset($_SESSION['usuario'])){
		header('Location: ../index.php?erro=1');
	}

	if($texto_tweet == '' || $id_usuario == ''){
		end();
	}

    $objDB = new db();

    $link = $objDB->conecta_mysql();

    $sql = "INSERT INTO tweet (id_usuario, tweet) VALUES ('$id_usuario', '$texto_tweet')";

    mysqli_query($link,$sql);


?>