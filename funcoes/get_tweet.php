<?php
	session_start();

	$id_usuario = $_SESSION['id'];

	 if(!isset($_SESSION['usuario'])){
			header('Location: ../index.php?erro=1');
		}
		
	require_once '../class/db.class.php';

	$objDB = new db();
	$link = $objDB->conecta_mysql();

	$sql = " SELECT t.data_tweet, t.tweet, u.usuario FROM tweet AS t JOIN usuarios AS u ON(t.id_usuario = u.id) WHERE id_usuario = $id_usuario ORDER BY data_tweet DESC";

	$resultado_id = mysqli_query($link, $sql);

	while ($resultado = mysqli_fetch_array($resultado_id,MYSQLI_ASSOC)) {
		echo "<a class= 'list-group-item'>";
			echo "<h4 class='list-group-heading'>".$resultado['usuario']."<small> / ".$resultado['data_tweet']."</small></h4>";
			echo "<h3 class= 'list-group-item-text'>".$resultado['tweet']."</h3>";
		echo "</a>";

    	
	}

?>